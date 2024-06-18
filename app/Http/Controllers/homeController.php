<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    protected $url;
    public function __construct() {
        $user = Auth::user();
        $this->url = "http://{$user->cnpj}.ddns.net:8098/api/svrpista/";
    }
    public function tanques(){
        return view("tanques");
    }

    public function home(){
        return view("home");
    }
    
    public function getData(){
        $dados = [
            'usuario' => 'CAIXA',
            'senha' => '123'
        ];
    
        $token = Http::put($this->url.'login', $dados);   
        $token = json_decode($token,false);
        $response = Http::withToken($token->token)->get($this->url.'tanques');
        $responseArray = json_decode($response, true);


        return $responseArray;
    }
}