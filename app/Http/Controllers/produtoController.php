<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;


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
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        $dataIni = formatDate($request->dataini);
        $dataFim = formatDate($request->datafim);
        if(!isset($dataIni)| !isset($dataFim)){
            $dataIni = Carbon::now();
            $dataFim = Carbon::now();
        }
        $dados =[
            "dataini"=>$dataIni,
            "datafim"=>$dataFim
        ];
        try {
            $url = "http://{$user->cnpj}.ddns.net:8098/api/svrpista/vendas/combsintetico";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer' . $user->token,
            ])->put($url,$dados);
            $data = json_decode($response, false);
            dd($data);
            return view("dashboard", ["data" => $data]);
        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('Error', $e->getMessage());
        }
    }
}
