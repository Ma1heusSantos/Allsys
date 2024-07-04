<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Exception;

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
        try{
            $dataIni = Carbon::parse($request->dataini)->format('d/m/Y');
            $dataFim = Carbon::parse($request->datafim)->format('d/m/Y');
            $dados =[
                "dataini"=>$dataIni,
                "datafim"=>$dataFim
            ];
            $url = $this->url."itensvenda";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer' . $this->user->token,
            ])->put($url, $dados);
            $dados = json_decode($response,false);
            return view('vendasPorPeriodo',['dados'=>$dados]);
            
        }catch(Exception $e){
            return redirect()->route('vendas.dia')->with('Error', $e->getMessage());
        }

    }
}