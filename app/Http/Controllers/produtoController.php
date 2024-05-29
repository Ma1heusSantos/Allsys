<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class produtoController extends Controller
{
    public function listar()
    {
        $user = Auth::user();
        try {
            $url = "http://{$user->cnpj}.ddns.net:8098/api/svrpista/produto/list";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer' . $user->token,
            ])->get($url);
            $produtos = json_decode($response, false);
            return view("produtos.listar", ["produtos" => $produtos]);
        } catch (Exception $e) {
            return redirect()->route('home')->with('Error', $e->getMessage());
        }
    }
    public function dashboard()
    {
        return view("dashboard");
    }
}
