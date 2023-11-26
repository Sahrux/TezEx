<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use Illuminate\Http\Request;

class PackController extends Controller
{
    public function index(){
        $packs = Pack::where("deleted_at",null)->with(["customer","branch"])->get()->toArray();
        $statuses = ["Not sorted","Sorted"];
        $data = ["packs" => $packs,"statuses" => $statuses];
        return view("packs",$data);
    }
}
