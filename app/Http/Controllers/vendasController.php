<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class vendasController extends Controller
{
    protected $url;
    protected $user;
    public function __construct() {
        $user = Auth::user();
        $this->url = "http://{$user->cnpj}.ddns.net:8098/api/svrpista/";
    }
    public function vendasDia(){
        return view('vendasPorPeriodo');
    }
    public function getVendasDia(Request $request){
        $user = Auth::user();
        try{
            $dataIni = formatDate($request->dataini);
            $dataFim = formatDate($request->datafim);
            $datas =[
                "dataini"=>$dataIni,
                "datafim"=>$dataFim
            ];
            $url = $this->url."itensvenda/venda";
            $response = putResponse($url,$user->token, $datas);
            $dados = json_decode($response, false); 
            return view("vendasPorPeriodo",['dados'=>$dados]);
            
        }catch(Exception $e){
            Log::info('mensagem de erro:', [$e->getMessage()]);
            return redirect()->route('vendas.dia')->with('Error', $e->getMessage());
        }

    }
    
}