<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if(!Auth::check()){
        return redirect("/login");
    }
    // dd(Auth::user()->role->load("privileges")->toArray());
    // dd(has_access_to("edit_roles"));
    return view('index');
})->name("home");

Route::middleware("auth.check")->group(function(){
    Route::get("login",function(){
        return view("login");
    });

    Route::get("logout",function(){
        Auth::logout();
        return redirect("/");
    })->name("logout");
    Route::post("login",[AuthController::class,"login"])->name("login");

    Route::get("admins",[UserController::class,"index"])->name("admins");
    Route::get("customers",[CustomerController::class,"index"])->name("customers");
    Route::get("branches",[BranchController::class,"index"])->name("branches");
    Route::get("packs",[PackController::class,"index"])->name("packs");

    
    Route::get("roles",function(){
        return view("roles");
    })->name("roles");

    Route::get("sorting",function(){
        return view("sorting");
    })->name("sorting");

    Route::get("role/{id}/privileges",[RoleController::class,"getPrivileges"])->name("role_privileges");
});

