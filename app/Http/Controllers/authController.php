<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class authController extends Controller
{
    public function login(){
        return view ('auth.login');
    }
    public function autenticaUsuario(Request $request){
        // endpoint teste: http://19979567000180.ddns.net:8098/api/svrpista/login 
        
    
        $cnpj = $this->limparCNPJ($request->cnpj);
        $dados =[
            "usuario"=>$request->email,
            "senha"=> $request->password
        ];
       try{
        $url = "http://{$cnpj}.ddns.net:8098/api/svrpista/login";
        $response = Http::put($url, $dados);
        $data = json_decode($response,false);
        if ($data->msg == 'usuario cadastrado.') {
            $user = User::updateOrCreate(
                ['email' => $request->email],
                [
                    'nivel' => ($data->nivel == "5") ? "Admin":"User",
                    'password' => $request->password,
                    'token' => $data->token,
                    'empresa'=>$data->empresa,
                    'cnpj'=>$cnpj
                ]
            );
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('home')->with('success', 'Autenticação bem-sucedida!');
        }else{
            $erros = 'usuario ou senha incorretos';
            return redirect()->back()->withErrors(['msg' => $erros]);
        }

       }catch(Exception $e){
            return redirect()->route('login')->with('Error', $e->getMessage());
       }
        
    }
    public function limparCNPJ($cnpj) {
        return preg_replace('/\D/', '', $cnpj);
    }
    

    public function deslogar(){
        Auth::logout();
        return view('auth.login');
    }
}