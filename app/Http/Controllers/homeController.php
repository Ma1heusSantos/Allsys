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
        $response = Http::get("http://vltsvr.ddns.net:8097/api/svrpista/tanques");
        $responseArray = json_decode($response, true);

        return $responseArray;
    }
}