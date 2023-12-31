<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SackController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\SortingController;
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
    Route::get("sacks",[SackController::class,"index"])->name("sacks");
    Route::get("packs/live",[PackController::class,"live"])->name("packs-live");
    Route::get("packs/{id}/get-by-tracking-id",[PackController::class,"getByTrackingId"])->name("get_by_tracking_id");

    Route::get("roles",[RoleController::class,"index"])->name("roles");
    Route::post("roles/add",[RoleController::class,"addRole"])->name("add_role");
    Route::post("privileges/add",[RoleController::class,"addPrivilege"])->name("add_role");

    Route::post("sorting/make-sack",[SortingController::class,"makeSack"])->name("make_sack");

    Route::get("sorting",[SortingController::class,"index"])->name("sorting");

    Route::get("role/{id}/privileges",[RoleController::class,"getPrivileges"])->name("role_privileges");
    Route::put("role/{id}/set-privilege",[RoleController::class,"setPrivileges"])->name("set_privileges");

    Route::delete("roles/{id}/delete",[RoleController::class,"delete"])->name("delete_role");
    Route::delete("privileges/{id}/delete",[RoleController::class,"delete"])->name("delete_privilege");
});

