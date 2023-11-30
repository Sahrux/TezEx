<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\Sack;
use App\Models\Branch;
use Illuminate\Http\Request;

class SortingController extends Controller
{
    public function index(){
        $branches = Branch::where("deleted_at",null)->get()->toArray();
        $sorted_packs = Pack::where(["deleted_at" => null,"status" => 1,"sack_id" => null])->with(["branch","customer","category.type"])->get()->toArray();
        $branch_pack_counter = $packs = [];
        if($sorted_packs){
            foreach($sorted_packs as $pack){
                $branch_pack_counter[$pack["branch_id"]] = isset($branch_pack_counter[$pack["branch_id"]]) ? $branch_pack_counter[$pack["branch_id"]] + 1 : 1;
                $packs[$pack["branch_id"]][] = $pack;
            }
        }
        return view("sorting",["branches" => $branches,"packs" => $packs,"branch_pack_counter" => $branch_pack_counter]);
    }


    public function makeSack(){
    
        $packs = Pack::where(["deleted_at" => null,"status" => 1,"sack_id" => null])->with(["category.type","branch"])->get();
        $type_id = $sack_id = null;
        if ($packs) {
            foreach($packs as $key => $pack){
                if($key === 0){
                    $type_id = $pack->category->type_id;
                    $branch_id = $pack->branch->id;
                    $branch_name = $pack->branch->name;
                    $sack_name = $branch_name . "_" . $pack->category->type->value;
                    $sack = Sack::create([
                        "code" => "0000" . rand(10,99) . rand(10,99),
                        "name" => $sack_name,
                        "branch_id" => $branch_id,
                        "type_id" => $type_id,
                        "created_at" => now()
                    ]);

                    $sack_id = $sack->id;

                }

                $pack->sack_id = $sack_id;
                $pack->save();

            }
        }
        
        return response()->json([
            "code" => 201,
            "message" => "Sack created successfully",
            "data" => []
        ]);
    }
}
