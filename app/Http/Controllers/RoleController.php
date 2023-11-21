<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getPrivileges($id){
        $data = Role::with("privileges")->find($id)->toArray();
        $role_privs = $data["privileges"] ?? [];
        $data = Role::with("privileges")->where("key","developer")->first()->toArray();
        $all_privs = $data["privileges"] ?? [];

        $current_roles = array_map(function($i){ return $i["id"]; },$role_privs);
        foreach($all_privs as $key => $item){
            $all_privs[$key]["status"] = in_array($item["id"],$current_roles);
        }
        
        return response()->json([
            "code" => $all_privs ? 200 : 204,
            "data" => $all_privs
        ]);
    }
}
