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

    public function caixa(){
        $url = $this->url."caixa/resumo/1";
        try{
            $response = getResponse($url,$this->user->token);
            $dados = json_decode($response, false); 
            return view("caixa",['dados'=>$dados]);
        }catch(Exception $e){
            Log::info('mensagem de erro:', [$e->getMessage()]);
            return redirect()->route('vendas.dia')->with('Error', $e->getMessage());
        }
    }
    
}