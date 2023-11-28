<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $admins = User::where("deleted_at",null)->with("role")->get()->toArray();
        $roles = Role::where("deleted_at",null)->get()->toArray();
        return view("admins",["admins" => $admins,"roles" => $roles]);
    }
}
