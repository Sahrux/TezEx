<?php

namespace App\Http\Controllers;

use App\Models\Sack;
use Illuminate\Http\Request;

class SackController extends Controller
{
    public function index(){
        $sacks = Sack::where("deleted_at",null)->with(["branch","type"])->get()->toArray();
        return view("sacks",["sacks" => $sacks]);
    }
}
