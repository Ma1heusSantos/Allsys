<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class vendasController extends Controller
{
    protected $url;
    protected $user;
    public function __construct() {
        $this->user = Auth::user();
        $this->url = "http://{$this->user->cnpj}.ddns.net:8098/api/svrpista/";
    }
    public function vendasDia(){
        return view('relatorios/vendasPorPeriodo');
    }
    public function getVendasDia(Request $request){
        try{
            $dataIni = formatDate($request->dataini);
            $dataFim = formatDate($request->datafim);
            $datas =[
                "dataini"=>$dataIni,
                "datafim"=>$dataFim
            ];
            $url = $this->url."itensvenda/venda";
            $response = putResponse($url,$this->user->token, $datas);
            $dados = json_decode($response, false); 
            return view("relatorios/vendasPorPeriodo",['dados'=>$dados]);
            
        }catch(Exception $e){
            Log::info('mensagem de erro:', [$e->getMessage()]);
            return redirect()->route('vendas.dia')->with('Error', $e->getMessage());
        }

    }

    public function caixa(){

        $url = $this->url . "caixa/resumo/1";
        $totalComb = 0;
        try {
            $response = getResponse($url, $this->user->token);
            $encerrantes = json_decode($response); 
            foreach ($encerrantes->resumocomb as $encerrante) {
                $totalComb += $encerrante->valor;
            }
            try{
                $recebimentos = array(
                    "dinheiro" => $encerrantes->caixa->recebimentos->ltipovendadinheiro ?? 0,
                    "chequeVista" => $encerrantes->caixa->recebimentos->ltipovendachequeavista ?? 0,
                    "chequePrazo" =>$encerrantes->caixa->recebimentos->ltipovendachequeaprazo ?? 0,
                    "pix" => $encerrantes->caixa->recebimentos->ltipovendapix ?? 0,
                    "valeFrete"=> $encerrantes->caixa->recebimentos->ltipovendavalefrete ?? 0,
                    "ticketVale"=>$encerrantes->caixa->recebimentos->ltipovendaticketvalecliente ?? 0,
                    "suprimento"=>$encerrantes->caixa->recebimentos->suprimento ?? 0,
                    "trocoCH"=> $encerrantes->caixa->recebimentos->ltipovendanotas ?? 0,
                    "total"=>$encerrantes->caixa->recebimentos->total ?? 0,
                );

                $retiradas = array(
                    "sangria"=> $encerrantes->caixa->retiradas->sangria ?? 0,
                    "valefunc"=> $encerrantes->caixa->retiradas->valefunc ?? 0,
                    "valecliente"=> $encerrantes->caixa->retiradas->valecliente ?? 0,
                    "trococh"=> $encerrantes->caixa->retiradas->trococh ?? 0,
                    "total"=> $encerrantes->caixa->retiradas->total ?? 0,
                );
                $totalVenda = $encerrantes->caixa->totalvenda;
                $fechamento = $encerrantes->caixa->fechamento;
            }
            catch(Exception $e){
                Log::info($e->getMessage());
            }
            
            return view("admin/caixa/caixa", [
                'encerrantes' => $encerrantes,
                'totalComb' => $totalComb,
                'recebimentos' => $recebimentos,
                'retiradas' => $retiradas,
                'totalVenda' => $totalVenda,
                'fechamento' => $fechamento
            ]);
        } catch (Exception $e) {
            Log::info('mensagem de erro:', [$e->getMessage()]);
            return redirect()->route('caixa')->with('Error', $e->getMessage());
        }
    }
    public function faturamento(){
        $url = $this->url.'faturamento/cliente';
        try{
            $response = getResponse($url, $this->user->token);
            $faturamento = json_decode($response->body());
            // dd($faturamento);

            $qtdPag = 30; 
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $paginatedFaturamento = $this->paginateArray($faturamento, $qtdPag, $currentPage, [
                'path' => LengthAwarePaginator::resolveCurrentPath()
            ]);
            return view('admin/caixa/faturamento',['paginatedFaturamento'=>$paginatedFaturamento]);
        }catch(Exception $e){
            Log::info($e->getMessage());
        }

    }
    function paginateArray($items, $perPage = 10, $page = null, $options = []){
        $page = $page ?: (LengthAwarePaginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $currentPageItems = $items->slice(($page - 1) * $perPage, $perPage)->values();
        return new LengthAwarePaginator($currentPageItems, $items->count(), $perPage, $page, $options);
    }

    
}