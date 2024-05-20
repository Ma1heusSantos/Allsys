<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class authController extends Controller
{
    public function login(){
        return view ('auth.login');
    }
    public function autenticaUsuario(Request $request){
        // endpoint teste: http://19979567000180.ddns.net:8098/api/svrpista/login
        // Validator::make($request->all(), [
        //     'cnpj' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required|min:8',
        // ]);
            
        $cnpj = $this->limparCNPJ($request->cnpj);
        $dados =[
            "usuario"=>$request->email,
            "senha"=> $request->password
        ];
       try{
        $url = "http://{$cnpj}.ddns.net:8097/api/svrpista/login";
        $response = Http::put($url, $dados);
        $data = json_decode($response,false);
        if ($data->msg == 'usuario cadastrado.') {
            $user = User::firstOrCreate(
                ['email' => $request->email],
                [
                    'nivel' => $data->nivel,
                    'password' => $request->password
                ]
            );
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('home')->with('success', 'Autenticação bem-sucedida!');
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