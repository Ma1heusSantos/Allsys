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
    protected $user; 
    public function __construct() {
        $this->user = Auth::user();
        $this->url = "http://{$this->user->cnpj}.ddns.net:8098/api/svrpista/";
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
    public function atualizaPreco(Request $request){
        try {
            $data = formatDate($request->data);

            $dados = [
                "codprod"=> $request->codigo,
                "avista" => (float)$request->avista,
                "aprazo" => (float)$request->aprazo,
                "datatroca"=> $data,
                "codemp"=> $request->codemp,
                "usuario"=> $this->user->email,
                "terminal"=> $request->terminal
            ];

            $url = $this->url."bicos/trocapreco";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->user->token,
            ])->put($url,[$dados]);
            
            if ($response->successful()) {
                return redirect()->back()->with('success', 'A troca do preço será efetuada na data '.formatDate($request->data));
            } else {
                $errors = 'Não foi possível trocar o preço. Código de status: ' . $response->status();
                return redirect()->back()->withErrors(['msg' => $errors]);
            }
            

        
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }
}   