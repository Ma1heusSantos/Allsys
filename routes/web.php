<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\authController;
use App\Http\Middleware\adminAcess;

Route::get('/', function () {
    return view('auth.login');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home',[homeController::class,"home"])->name("home");
    Route::get('/getData',[homeController::class,"getData"])->name("getData");

});
Route::post('/autenticaUsuario',[authController::class,'autenticaUsuario'])->name('autenticaUsuario');
Route::get('/deslogar',[authController::class,'deslogar'])->name('deslogar');
Route::get('/login',[authController::class,"login"])->name("login");

//rotas admin
Route::get('/teste',[authController::class,'teste'])->name('teste')->middleware(adminAcess::class);