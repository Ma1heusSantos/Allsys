<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;

class vendasController extends Controller
{
    protected $url;
    protected $user;
    public function __construct() {
        $this->user = Auth::user();
        $this->url = "http://{$this->user->cnpj}.ddns.net:8098/api/svrpista/";
    }
    public function vendasDia(){
        return view('vendasPorPeriodo');
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
            return view("vendasPorPeriodo",['dados'=>$dados]);
            
        }catch(Exception $e){
            Log::info('mensagem de erro:', [$e->getMessage()]);
            return redirect()->route('vendas.dia')->with('Error', $e->getMessage());
        }

    }

    public function caixa()
{
    $url = $this->url . "caixa/resumo/1";
    $totalComb = 0;
    try {
        $response = getResponse($url, $this->user->token);
        $encerrantes = json_decode($response->body()); 
        foreach ($encerrantes->resumocomb as $encerrante) {
            $totalComb += $encerrante->valor;
        }
        foreach ($encerrantes->caixa as $caixa) {
            if (is_object($caixa) && property_exists($caixa, 'ltipovendacartao')) {
                $recebimentos = array(
                    "dinheiro" => $caixa->ltipovendacartao,
                    "chequeVista" => $caixa->ltipovendachequeavista,
                    "chequePrazo" =>$caixa->ltipovendachequeaprazo,
                    "pix" => $caixa->ltipovendapix,
                    "valeFrete"=> $caixa->ltipovendavalefrete,
                    "ticketVale"=>$caixa->ltipovendaticketvalecliente,
                    "suprimento"=>$caixa->suprimento,
                    "trocoCH"=> $caixa->ltipovendanotas,
                    "total"=>$caixa->total,
                );
            } else {
                Log::info('Propriedade ltipovendacartao não existe ou $caixa não é um objeto', ['caixa' => $caixa]);
            }
        }
        return view("caixa", ['encerrantes' => $encerrantes, 'totalComb' => $totalComb, 'recebimentos'=>$recebimentos]);
    } catch (Exception $e) {
        Log::info('mensagem de erro:', [$e->getMessage()]);
        return redirect()->route('caixa')->with('Error', $e->getMessage());
    }
}

    
}