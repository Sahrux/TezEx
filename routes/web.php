<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
    dd(has_access_to("edit_roles"));
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

    Route::get("admins",function(){
        return view("admins");
    })->name("admins");
    Route::get("customers",function(){
        return view("customers");
    })->name("customers");
    Route::get("packs",function(){
        return view("packs");
    })->name("packs");
    Route::get("roles",function(){
        return view("roles");
    })->name("roles");
    Route::get("branches",function(){
        return view("branches");
    })->name("branches");
    Route::get("sorting",function(){
        return view("sorting");
    })->name("sorting");
});
