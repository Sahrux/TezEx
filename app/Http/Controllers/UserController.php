<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $admins = User::with("role")->get()->toArray();
        return view("admins",["admins" => $admins]);
    }
}
