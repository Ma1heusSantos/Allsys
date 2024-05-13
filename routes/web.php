<?php
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\authController;
use App\Http\Middleware\adminAcess;
use App\Http\Middleware\Authorization;



Route::get('/', function () {
    return view('auth.login');
});
Route::middleware(Authorization::class)->group( function () {
    Route::get('/home',[homeController::class,"home"])->name("home");
    Route::get('/getData',[homeController::class,"getData"])->name("getData");

});
Route::post('/autenticaUsuario',[authController::class,'autenticaUsuario'])->name('autenticaUsuario');
Route::get('/deslogar',[authController::class,'deslogar'])->name('deslogar');
Route::get('/login',[authController::class,"login"])->name("login");

//rotas admin
Route::middleware(adminAcess::class)->group(function () {
    Route::get('/teste', [authController::class, 'teste'])->name('teste');
    Route::get('/createUser', [userController::class, 'createUser'])->name('create.user');
    Route::post('/storeUser',[userController::class,'storeUser'])->name('store.user');
});