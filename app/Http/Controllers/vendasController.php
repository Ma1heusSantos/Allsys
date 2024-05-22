<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Exception;

class vendasController extends Controller
{
    public function vendasDia(){
        return view('vendasPorPeriodo');
    }
    public function getVendasDia(Request $request){
        try{
            $user = Auth::user();
            $dataIni = Carbon::parse($request->dataini)->format('d/m/Y');
            $dataFim = Carbon::parse($request->datafim)->format('d/m/Y');
            $dados =[
                "dataini"=>$dataIni,
                "datafim"=>$dataFim
            ];
            $url = "http://19979567000180.ddns.net:8098/api/svrpista/itensvenda";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer' . $user->token,
            ])->put($url, $dados);
            $data = json_decode($response,false);
            return view('vendasPorPeriodo',['data'=>$data]);
        }catch(Exception $e){
            return redirect()->route('vendasPorPeriodo')->with('Error', $e->getMessage());
        }

    }
}