<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\Type;
use App\Models\Branch;
use App\Models\Customer;
use Illuminate\Http\Request;

class PackController extends Controller
{
    public function index(){
        $packs = Pack::where("deleted_at",null)->with(["customer","branch","category"])->get()->toArray();
        $customers = [];
        $branches =  [];
        foreach($packs as $pack){
            $customers[$pack["customer_id"]] = $pack["customer"];
            $branches[$pack["branch_id"]] = $pack["branch"];
        }
        $customers = array_values($customers);
        $branches = array_values($branches);

        // $customers = Customer::whereHas('pack', function ($query) {
        //     $query->where('customer_id', '=', 'customers.id');
        // })->where("deleted_at",null)->get();

        $data = ["customers" => $customers,"branches" => $branches];
        return view("packs",$data);
    }

    public function live(Request $request){
        $branch_id = $request->branch_id ?: null;
        $customer_id = $request->customer_id ?: null;
        $where_clause = ["deleted_at" => null] + ($branch_id ? ["branch_id" => $branch_id] : []) + ($customer_id ? ["customer_id" => $customer_id] : []);
        $packs = Pack::where($where_clause)->with(["customer","branch","category"])->get()->toArray();
        $statuses = ["Not sorted","Sorted"];

        foreach($packs as $key => $pack){
            $packs[$key]["status"] = $statuses[$pack["status"]];
        }
        
        return response()->json([
            "code" => 200,
            "message" => "Success",
            "data" => $packs
        ]);
    }

    function getByTrackingId($id){
        $pack = Pack::where(["deleted_at" => null,"tracking_id" => $id])->with(["customer","branch","category"])->first();
        $pack_arr = [];
        if($pack){
            $pack_arr = $pack->toArray();
            if((int)$pack_arr["status"] === 1){
                return response()->json([
                    "code" => 400,
                    "message" => "This pack is already sorted",
                    "data" => []
                ]);
            }
            $pack_arr["type"] = Type::find($pack_arr["category"]["type_id"]) ? Type::find($pack_arr["category"]["type_id"])->toArray() : null;
            $pack_arr["created_at"] = date("Y-m-d H:i:s",strtotime($pack_arr["created_at"]));
            $pack->status = 1;
            $pack->save();
            
        }
        return response()->json([
            "code" => $pack ? 200 : 204,
            "message" => $pack ? "Success" : "Error",
            "data" => $pack ? $pack_arr : []
        ]);
    }
}
