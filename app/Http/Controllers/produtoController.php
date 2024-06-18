<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class produtoController extends Controller
{
    protected $url; 
    public function __construct() {
        $user = Auth::user();
        $this->url = "http://{$user->cnpj}.ddns.net:8098/api/svrpista/";
    }
    public function listar(){
        $user = Auth::user();
        try {
            $url = $this->url. "produto/list";
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
        $dataIni = formatDate($request->dataIni);
        $dataFim = formatDate($request->dataFim);
        $totalbruto = 0;
        $valorAbastecido = 0;
        
        if (!isset($request->dataIni) || !isset($request->dataFim)) {
            $dataIni = "01/05/2023";
            $dataFim = "01/05/2023";
        }
        
        $datas = [
            "dataini" => $dataIni,
            "datafim" => $dataFim
        ];

        try {
            $url = $this->url."vendas/combsintetico";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer' . $user->token,
            ])->put($url,$datas);

            $dados = json_decode($response, false);

            foreach($dados as $dado){
                $totalbruto += $dado->lucrobruto;
                $valorAbastecido += $dado->valorabast;
            }

            $jsonDados = json_encode($dados);

            $dadosFuncionario = $this->getFuncionarios($user,$datas);

            $jsonFuncionario = json_encode($dadosFuncionario);

            return view("dashboard", ["totalbruto"=>$totalbruto,
                                      "dados"=>$dados,
                                      "valorAbastecido"=>$valorAbastecido,
                                      "jsonDados"=>$jsonDados,
                                      "jsonFuncionario"=>$jsonFuncionario
                                    ]);

        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }
    public function getFuncionarios($user,$datas){

        try {
            $url = $this->url."itensvendaprodfunc";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $user->token, 
            ])->put($url, $datas);

            $dadosResponse = json_decode($response, false); 

            return ($dadosResponse);
        
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
        
    }

    public function trocaPreco(){
        $usuario = Auth::user();
        try {
            $url = $this->url."bicos/trocapreco";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $usuario->token, 
            ])->get($url);
            $dadosResponse = json_decode($response, false); 
            $dadosJson = json_encode($dadosResponse);

            return view("produtos.trocaPreco",['dadosResponse'=>$dadosResponse,'dadosJson'=>$dadosJson,'usuario'=>$usuario]);
        
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }
}   