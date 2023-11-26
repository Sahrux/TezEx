<?php

namespace App\Http\Controllers;

use App\Models\Privilege;
use App\Models\Role;
use App\Models\RolePrivilege;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::where("deleted_at",null)->with("user")->get()->toArray();
        return view("roles",["roles" => $roles]);
    }

    public function addRole(Request $request){
        $data = [
            "key" => $request->key,
            "value" => $request->value,
            "creator_id" => auth()->user()->id,
            "created_at" => now()
        ];
        $exist_roles_arr = Role::get()->toArray();
        $exist_roles = array_map(function($i){ return $i["key"]; },$exist_roles_arr);

        if(in_array($data["key"],$exist_roles)){
            return response()->json([
                "code" => 400,
                "message" => "Role already exists",
                "data" => []
            ]);
        }

        $inserted = Role::create($data);

        if($inserted){
            $inserted_id = $inserted->id;

            $privileges = $request->privileges;
            $priv_data = [];
            foreach($privileges as $key => $item){
                $priv_data[] = [
                    "role_id" => $inserted_id,
                    "privilege_id" => $item,
                    "creator_id" => auth()->user()->id,
                    "created_at" => now()
                ];
            }

            RolePrivilege::insert($priv_data);
        }

        return response()->json([
            "code" => $inserted ? 201 : 400,
            "message" => $inserted ? "Role created successfully" : "Problem appeared",
            "data" =>  $inserted ? ["id" => $inserted_id] : []
        ]);
    }

    public function addPrivilege(Request $request){
        $data = [
            "key" => $request->key,
            "value" => $request->value,
            "creator_id" => auth()->user()->id,
            "created_at" => now()
        ];
        $exist_privileges_arr = Privilege::get()->toArray();
        $exist_privileges = array_map(function($i){ return $i["key"]; },$exist_privileges_arr);

        if(in_array($data["key"],$exist_privileges)){
            return response()->json([
                "code" => 400,
                "message" => "Privilege already exists",
                "data" => []
            ]);
        }

        $inserted = Privilege::create($data);


        return response()->json([
            "code" => $inserted ? 201 : 400,
            "message" => $inserted ? "Privilege created successfully" : "Problem appeared",
            "data" =>  []
        ]);
    }


    function delete(Request $request,$id){

        $deleting = $request->type === "role" ? Role::find($id) : Privilege::find($id);
        $is_deleted = false;
        if($deleting){
            $is_deleted = $deleting->delete();
        }

        return response()->json([
            "code" => $is_deleted ? 202 : 400,
            "message" => $is_deleted ? "Successfully deleted" : "Problem appeared",
            "data" => []
        ]);
    }


    public function getPrivileges($id){
        $all_privs = [];
        if((int)$id > 0){
            $data = Role::with("privileges")->find($id)->toArray();
            $role_privs = $data["privileges"] ?? [];
            $data = Role::with("privileges")->where("key","developer")->first()->toArray();
            $all_privs = $data["privileges"] ?? [];
    
            $current_roles = array_map(function($i){ return $i["id"]; },$role_privs);
            foreach($all_privs as $key => $item){
                $all_privs[$key]["status"] = in_array($item["id"],$current_roles);
            }
        }else{
            $all_privs = Privilege::all()->toArray();
        }
      
        
        return response()->json([
            "code" => $all_privs ? 200 : 204,
            "data" => $all_privs
        ]);
    }

    public function setPrivileges(Request $request,$id){
        $privileges = $request->privileges;
        $role = Role::find($id);
        if($role->toArray() && $role->toArray()["key"] === "developer"){
            return response()->json([
                "code" =>  204,
                "message" => "Developer's privileges cant be updated",
                "data" => []
            ]);
        }
        $updated = $role->privileges()->sync($privileges);
        
        return response()->json([
            "code" => $updated ? 202 : 400,
            "message" => $updated ? "Role privileges udpated successfully" : "Problem appeared",
            "data" => []
        ]);
    }
}
