<?php

use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\authController;
use App\Http\Controllers\produtoController;
use App\Http\Controllers\vendasController;
use App\Http\Middleware\adminAcess;
use App\Http\Middleware\authorization;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(authorization::class)->group(function () {
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
Route::middleware([adminAcess::class])->group(function () {
    Route::get('/showCompany', [adminController::class, 'showCompany'])->name("show.company");
    Route::get('/createUser', [adminController::class, 'createUser'])->name('create.user');
    Route::post('/storeUser', [adminController::class, 'storeUser'])->name('store.user');
    Route::get('/showUser', [adminController::class, 'show'])->name('show.user');
    Route::get('/destroyUser/{id}', [adminController::class, 'destroy'])->name('destroy.user');
    Route::get('/editUser/{id}', [adminController::class, 'edit'])->name('edit.user');
    Route::get('/updateUser/{id}', [adminController::class, 'editUser'])->name('update.user');
    Route::any('/faturamento',[vendasController::class,'faturamento'])->name('faturamento');
    Route::get("/faturamento/{id}",[vendasController::class,"faturamentoPorCliente"])->name("faturamento.cliente");
    Route::get('/listProduct', [produtoController::class, 'listar'])->name("produto.listar");
    Route::any('/dashboardCombustivel', [produtoController::class, "dashboardCombustivel"])->name("dashboard.combustivel");
    Route::any('/dashboardProduto', [produtoController::class, "dashboardProduto"])->name("dashboard.produto");
    Route::get('/trocaPreco',[produtoController::class,'trocaPreco'])->name("trocar.preco");
    Route::post('/atualizaPreco',[produtoController::class,'atualizaPreco'])->name("atualiza.preco");
    Route::get('/monitor',[produtoController::class,'monitor'])->name("monitor");
    Route::any('/caixa',[vendasController::class,'caixa'])->name("caixa");
    Route::get('resumoCaixa',[vendasController::class,'resumoCaixa'])->name('resumo.caixa');
});