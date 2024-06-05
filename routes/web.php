<?php

use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\authController;
use App\Http\Controllers\produtoController;
use App\Http\Controllers\vendasController;
use App\Http\Middleware\adminAcess;
use App\Http\Middleware\Authorization;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::user()->nivel == "Admin" ? redirect()->route("dashboard") : redirect()->route("home");
})->name('/');

Route::middleware(Authorization::class)->group(function () {
    Route::get('/tanques', [homeController::class, "tanques"])->name("tanques");
    Route::get('/getData', [homeController::class, "getData"])->name("getData");
    Route::get('/home', [homeController::class, "home"])->name("home");
    Route::get('/vendasDia', [vendasController::class, "vendasDia"])->name('vendas.dia');
    Route::post('getVendasDia', [vendasController::class, "getVendasDia"])->name('getVendasDia');
});
Route::post('/autenticaUsuario', [authController::class, 'autenticaUsuario'])->name('autenticaUsuario');
Route::get('/deslogar', [authController::class, 'deslogar'])->name('deslogar');
Route::get('/login', [authController::class, "login"])->name("login");

//rotas admin
Route::middleware(adminAcess::class)->group(function () {
    Route::get('/showCompany', [adminController::class, 'showCompany'])->name("show.company");
    Route::get('/createUser', [adminController::class, 'createUser'])->name('create.user');
    Route::post('/storeUser', [adminController::class, 'storeUser'])->name('store.user');
    Route::get('/showUser', [adminController::class, 'show'])->name('show.user');
    Route::get('/destroyUser/{id}', [adminController::class, 'destroy'])->name('destroy.user');
    Route::get('/editUser/{id}', [adminController::class, 'edit'])->name('edit.user');
    Route::get('/updateUser/{id}', [adminController::class, 'editUser'])->name('update.user');
    Route::get('/listProduct', [produtoController::class, 'listar'])->name("produto.listar");
    Route::any('/dashboard', [produtoController::class, "dashboard"])->name("dashboard");
});
