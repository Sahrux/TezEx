<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(){
        $branches = Branch::where("deleted_at",null)->get()->toArray();
        return view("branches",["branches" => $branches]);
    }
}
