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
});

