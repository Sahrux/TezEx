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
        return view("sorting",["branches" => $branches]);
    }


    public function makeSack(){
        $packs = Pack::where(["deleted_at" => null,"status" => 1,"sack_id" => null])->with(["category"])->get();
        $type_id = $sack_id = null;
        if ($packs) {
            foreach($packs as $key => $pack){
                if($key === 0){
                    $type_id = $pack->category->type_id;
                    $branch_id = $pack->branch->id;
                    $sack = Sack::create([
                        "code" => "0000" . rand(10,99) . rand(10,99),
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
