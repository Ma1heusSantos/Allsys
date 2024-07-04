<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


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
            $url = $this->url."venda/combsintetico";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer' . $this->user->token,
            ])->put($url,$datas);

            $dados = json_decode($response, false);

            foreach($dados as $dado){
                $totalbruto += $dado->lucrobruto;
                $valorAbastecido += $dado->valorabast;
            }

            $jsonDados = json_encode($dados);

            $dadosFuncionario = $this->getFuncionarios($this->user,$datas);

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
            $url = $this->url."itensvenda/prodfunc";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$user->token, 
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
            $url = $this->url."bico/trocapreco";
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
            $avista = (float)str_replace(',', '.', $request->avista);
            $aprazo = (float)str_replace(',', '.', $request->aprazo);

            $dados = [
                "codprod"=> $request->codigo,
                "avista" => $avista? $avista:null,
                "aprazo" => $aprazo? $aprazo:null,
                "datatroca"=> $data,
                "codemp"=> $request->codemp,
                "usuario"=> $this->user->email,
                "terminal"=> $request->terminal
            ];

            $url = $this->url."bico/trocapreco";

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
    function paginateArray($items, $perPage = 10, $page = null, $options = []){
        $page = $page ?: (LengthAwarePaginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $currentPageItems = $items->slice(($page - 1) * $perPage, $perPage)->values();
        return new LengthAwarePaginator($currentPageItems, $items->count(), $perPage, $page, $options);
    }
    public function monitor(){
        try {
            $url = $this->url."bico/monitor";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->user->token, 
            ])->get($url);

            $bicos = json_decode($response->body(), true);

            foreach ($bicos as &$bico) {
                switch ($bico['status']) {
                    case 'ABASTECENDO':
                        $bico['color'] = 'success';  
                        break;
                    case 'DESLIGADO':
                        $bico['color'] = 'secondary';  
                        break;
                    case 'DESATIVADO':
                        $bico['color'] = 'secondary';  
                        break;
                    case 'AFERINDO':
                        $bico['color'] = 'warning';  
                        break;
                    case 'DESCONECTADO':
                        $bico['color'] = 'danger';  
                        break;
                    case 'AFERINDO MANUAL':
                        $bico['color'] = 'warning';  
                        break;
                    case 'BLOQUEADA ':
                        $bico['color'] = 'danger';  
                        break;
                    case 'AGUARDANDO':
                        $bico['color'] = 'warning';  
                    case 'FIM ABASTECIMENTO':
                        $bico['color'] = 'success';  
                        break;
                    default:
                        $bico['color'] = 'secondary';  
                        break;
                }
            }

            $qtdPag = 8; 
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $paginatedBicos = $this->paginateArray($bicos, $qtdPag, $currentPage, [
                'path' => LengthAwarePaginator::resolveCurrentPath()
            ]);

            return view('monitor', ['paginatedBicos' => $paginatedBicos]);
        
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }

    
}   