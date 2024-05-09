<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class homeController extends Controller
{
    public function home(){
        return view("home");
    }
    public function getData(){
        // $token  = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE3MTUyODI3NzUsImlkIjoiODkyMiIsIm5hbWUiOiJDQUlYQSJ9.Fnn3wvFRXM_lfs6n-J0mcHcUi_r8ModSITqjYdNOggc";
        $dados = [
            'usuario' => 'CAIXA',
            'senha' => '123'
        ];
    
        $token = Http::put('http://vltsvr.ddns.net:8098/api/svrpista/login', $dados);   
        $token = json_decode($token,false);
        $response = Http::withToken($token->token)->get('http://vltsvr.ddns.net:8098/api/svrpista/tanques');
        $responseArray = json_decode($response, true);


        return $responseArray;
    }
}