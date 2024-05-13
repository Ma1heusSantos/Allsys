<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class userController extends Controller
{
    public function createUser(){
        return view("user.create");
    }
    public function storeUser(Request $request){
        $user = new User();

        Log::info("---Cadastro de produto-----");
        Log::info($request->all());
        Log::info("---- Cadastrado por: ".Auth::user()->name."-----");

        try {
            validator([
                'email' =>'required|unique:users',
                'password'=> '',
                'role' => ''
            ]);

        } catch(Exception $e) {
            Log::warning("Erro ao cadastrar novo usuário [ ... ] Erro: ".$e->getMessage());
            flash("Não foi possível cadastrar novo usuário")->error();
            return redirect()
                ->back()
                ->withErrors([
                'codigo' => 'código já cadastrado',
                'codigo_barras' => 'código de barras já cadastrado'
            ])
            ->withInput();

        }
    }
}