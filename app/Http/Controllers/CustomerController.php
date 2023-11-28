<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::where("deleted_at",null)->with("pack")->get()->toArray();
        return view("customers",["customers" => $customers]);
    }
}
