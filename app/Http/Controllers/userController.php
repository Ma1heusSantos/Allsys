<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
            $validate = Validator::make($request->all(),[
                'email' =>'required|unique:users|email:rfc,dns',
                'password'=> 'required|min:8',
                'confirmePassword'=> 'required|same:password',
            ],[
                'email.required' => 'O campo E-mail é obrigatório.',
                'email.unique' => 'Este endereço de e-mail já está em uso.',
                'email.email' => 'Por favor, insira um endereço de e-mail válido.', // Mensagem padrão para o email:rfc,dns
                'password.required' => 'O campo Senha é obrigatório.',
                'password.min' => 'A senha deve ter no mínimo :min caracteres.',
                'confirmePassword.required' => 'Por favor, confirme sua senha.',
                'confirmePassword.same' => 'As senhas informadas não coincidem.',
            ]);

           if($validate->fails()){
            return redirect()->back()->withErrors($validate);
            
           }
           $user->create([
            'name' => $request->input('name'), 
            'password' => $request->input('password'),
            'email' => $request->input('email'),
            'email_verified_at'=>now(),
            'role' => $request->input('role')
        ]);
        $user->save();
        return redirect()->back()->with('success', 'Usuário criado com sucesso!');

        } catch(Exception $e) {
            Log::warning("Erro ao cadastrar novo usuário [ ... ] Erro: ".$e->getMessage());
            return redirect()
                ->back()
                ->withErrors($e->getMessage())
            ->withInput();

        }
    }
}