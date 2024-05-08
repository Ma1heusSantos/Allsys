<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\authController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[homeController::class,"home"])->name("home");
Route::get('/getData',[homeController::class,"getData"])->name("getData");
Route::get('/login',[authController::class,"login"])->name("login");
Route::get('/register',[authController::class,"register"])->name("register");