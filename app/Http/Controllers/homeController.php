<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    protected $url;
    protected $user;
    public function __construct() {
        $this->user = Auth::user();
        $this->url = "http://{$this->user->cnpj}.ddns.net:8098/api/svrpista/";
    }
    public function tanques(){
        return view("tanques");
    }

    public function home(){
        return view("home");
    }
    
    public function getData(){
        $url = $this->url."tanque/list";
        $response = getResponse($url,$this->user->token);
        $responseArray = json_decode($response, true);
        return $responseArray;
    }
}