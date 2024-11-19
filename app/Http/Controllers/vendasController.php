<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use stdClass;
use Carbon\Carbon;

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

    public function caixa(Request $request) {
        $terminal = isset($request->terminal) ? $request->terminal : 1;
        $url = $this->url . "caixa/resumo/" . $terminal;
        $totalComb = 0;
        $errors = null;
    
        try {
            $response = getResponse($url, $this->user->token);
            $encerrantes = json_decode($response); 
            foreach ($encerrantes->resumocomb as $encerrante) {
                $totalComb += $encerrante->valor;
            }

            $recebimentos = [
                "dinheiro" => $encerrantes->caixa->recebimentos->ltipovendadinheiro ?? 0,
                "chequeVista" => $encerrantes->caixa->recebimentos->ltipovendachequeavista ?? 0,
                "chequePrazo" => $encerrantes->caixa->recebimentos->ltipovendachequeaprazo ?? 0,
                "pix" => $encerrantes->caixa->recebimentos->ltipovendapix ?? 0,
                "valeFrete" => $encerrantes->caixa->recebimentos->ltipovendavalefrete ?? 0,
                "ticketVale" => $encerrantes->caixa->recebimentos->ltipovendaticketvalecliente ?? 0,
                "suprimento" => $encerrantes->caixa->recebimentos->suprimento ?? 0,
                "trocoCH" => $encerrantes->caixa->recebimentos->ltipovendanotas ?? 0,
                "total" => $encerrantes->caixa->recebimentos->total ?? 0,
                "cartao" => $encerrantes->caixa->recebimentos->ltipovendacartao ?? 0,
            ];

            $retiradas = [
                "sangria" => $encerrantes->caixa->retiradas->sangria ?? 0,
                "valefunc" => $encerrantes->caixa->retiradas->valefunc ?? 0,
                "valecliente" => $encerrantes->caixa->retiradas->valecliente ?? 0,
                "trococh" => $encerrantes->caixa->retiradas->trococh ?? 0,
                "total" => $encerrantes->caixa->retiradas->total ?? 0,
            ];

            $totalVenda = $encerrantes->caixa->totalvenda;
            $fechamento = $encerrantes->caixa->fechamento;
            $resumoProdutos = $encerrantes->resumoprod;
            
            
            return view("admin/caixa/caixa", [
                'encerrantes' => $encerrantes,
                'totalComb' => $totalComb,
                'recebimentos' => $recebimentos,
                'retiradas' => $retiradas,
                'totalVenda' => $totalVenda,
                'fechamento' => $fechamento,
                'resumoProdutos' => $resumoProdutos
            ]);
    
        } catch (Exception $e) {
            Log::info('mensagem de erro:', [$e->getMessage()]);
            $errors = 'informe um terminal válido, código do erro:';
            return redirect()->back()->withErrors(['msg' => $errors]);
        }
    }

    public function resumoCaixa(Request $request){
        $terminal = isset($request->terminal) ? $request->terminal:1;
        $url = $this->url.'caixa/totais/'.$terminal;

        $response = getResponse($url, $this->user->token);
        $dados = json_decode($response);
        $codigo = $dados->funcionario->codcaixa;
        $formaDePagamento = [];
        $vendas = [
            'Combustivel' => $dados->caixa->totalComb ?? 0,
            'Produtos' => $dados->caixa->totalProd ?? 0,
            'total'=> $dados->caixa->totalvenda ?? 0,
        ];
        
        $recebimentos = [
            'cartao'=> $dados->caixa->recebimentos->ltipovendacartao ?? 0,
            'notas'=> $dados->caixa->recebimentos->ltipovendanotas ?? 0,
            'ticket'=> $dados->caixa->recebimentos->ltipovendaticket ?? 0,
            'valeFrete'=> $dados->caixa->recebimentos->ltipovendavalefrete ?? 0,
            'chequeAVista'=> $dados->caixa->recebimentos->ltipovendachequeavista ?? 0,
            'chequeAPrazo'=> $dados->caixa->recebimentos->ltipovendachequeaprazo ?? 0,
            'valeCliente'=> $dados->caixa->recebimentos->ltipovendaticketvalecliente ?? 0,
            'pix'=> $dados->caixa->recebimentos->ltipovendapix ?? 0,
            'suprimento'=> $dados->caixa->recebimentos->suprimento ?? 0,
            'dinheiro'=> $dados->caixa->recebimentos->ltipovendadinheiro ?? 0,
            'total'=> $dados->caixa->recebimentos->total ?? 0,
        ];

        foreach ($recebimentos as $tipo => $valor) {
            $pagamento = new stdClass(); 
            $pagamento->nome = ucfirst($tipo); 
            $pagamento->valor = money($valor); 
            switch($tipo){
                
                case 'cartao':
                    $pagamento->cor = '#40B6E8';
                    $pagamento->icone = 'fa-solid fa-credit-card';
                break;
                case 'notas':
                    $pagamento->cor = '#6460CA';
                    $pagamento->icone = 'fa-solid fa-note-sticky';
                break;
                case 'ticket':
                    $pagamento->cor = '#19E47F';
                    $pagamento->icone = 'fa-solid fa-ticket';
                break;
                case 'valeFrete':
                    $pagamento->cor = '#E87848';
                    $pagamento->icone = 'fa-regular fa-clipboard';
                break;
                case 'chequeAVista':
                    $pagamento->cor = '#7995C2';
                    $pagamento->icone = 'fa-solid fa-money-check';
                break;
                case 'chequeAPrazo':
                    $pagamento->cor = '#D976E8';
                    $pagamento->icone = 'fa-solid fa-money-check-dollar';
                break;
                case 'valeCliente':
                    $pagamento->cor = '#42E3CF';
                    $pagamento->icone = 'fa-solid fa-person-circle-check';
                break;
                case 'pix':
                    $pagamento->cor = '#E85C54';
                    $pagamento->icone = 'fa-brands fa-pix';
                break;
                case 'suprimento':
                    $pagamento->cor = '#E8BC78';
                    $pagamento->icone = 'fa-solid fa-truck-field';
                break;
                case 'dinheiro':
                    $pagamento->cor = '#9BE8E3';
                    $pagamento->icone = 'fa-solid fa-money-bill';
                break;
                case 'total':
                    $pagamento->cor = '#f00';
                    $pagamento->icone = 'fa-solid fa-money-bill';
                break;
                default:
                    $pagamento->cor = 'secondary'; 
                    $pagamento->icone = 'fa-solid fa-question'; 
                break;
            }
        
            $formaDePagamento[] = $pagamento;
        }

        return view('admin.caixa.resumoCaixa',['recebimentos'=>$recebimentos,'formaDePagamento'=>$formaDePagamento,'vendas'=>$vendas,'codigo'=>$codigo,'terminal'=>$terminal]);
    }
    
    public function faturamento(request $request){

        $url = $this->url.'faturamento/cliente';
        try{
            if ($request->filled('cliente')) {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $this->user->token,
                ])->get($url . '?find=' . $request->cliente);
            } else {
                $response = getResponse($url, $this->user->token);
            }
            $faturamento = json_decode($response->body());


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


    public function faturamentoPorCliente($id){
        $url = $this->url.'faturamento/cliente/'.$id;
        $total = 0;
        try{
            $response = getResponse($url, $this->user->token);
            $contas = json_decode($response->body());
            foreach ($contas as $conta) {
                $total += $conta->valor;
            }

            return view('admin/caixa/faturamentoPorCliente',['contas'=>$contas,'total'=>$total]);
        }catch(Exception $e){
            Log::info($e->getMessage());
        }

    }
    public function resumoCombustivel(Request $request){
        $terminal = $request->has('terminal') ? $request->terminal: 1;
        $codigo = $request->codigo;
        $url = $this->url.'caixa/rescomb/'.$terminal.'/'.$codigo;
        $response = getResponse($url, $this->user->token);
        $dados = json_decode($response);
        return view('admin.caixa.resumoCombustivel',['dados'=>$dados]);
    }

    public function resumoProduto(Request $request)
    {
        $terminal = $request->has('terminal') ? $request->terminal: 1;
        $codigo = $request->codigo;
        $url = $this->url.'caixa/resprod/'.$terminal.'/'.$codigo;
        $response = getResponse($url, $this->user->token);
        $dados = json_decode($response);
        return view('admin.caixa.resumoProduto',['dados'=>$dados]);
    }

    public function vendasGerais(Request $request)
    {
        try{
            $dataIni = $request->has('dataIni') ? formatDate($request->dataIni) : Carbon::now()->format("d/m/Y");
            $dataFim = $request->has('dataFim') ? formatDate($request->dataFim) : Carbon::now()->format("d/m/Y");
            $datas =[
                "dataini"=>$dataIni,
                "datafim"=>$dataFim
            ];
            $url = $this->url.'venda/totais';
            $response = putResponse($url,$this->user->token, $datas);
            $dados = json_decode($response,false);
            $recebimentos = [
                'cartao'=> $dados->TipoPag->ltipovendacartao ?? 0,
                'notas'=> $dados->TipoPag->ltipovendanotas?? 0,
                'ticket'=> $dados->TipoPag->ltipovendaticket ?? 0,
                'valeFrete'=>$dados->TipoPag->ltipovendavalefrete?? 0,
                'chequeAVista'=> $dados->TipoPag->ltipovendachequeavista ?? 0,
                'chequeAPrazo'=> $dados->TipoPag->ltipovendachequeaprazo ?? 0,
                'valeCliente'=> $dados->TipoPag->ltipovendaticketvalecliente ?? 0,
                'pix'=> $dados->TipoPag->ltipovendapix ?? 0,
                'dinheiro'=> $dados->TipoPag->ltipovendadinheiro ?? 0,
            ];
    
            $formaDePagamento = []; 

            foreach ($recebimentos as $tipo => $valor) {
                $pagamento = new stdClass(); 
                $pagamento->nome = ucfirst($tipo); 
                $pagamento->valor = money($valor); 
            
                switch($tipo){
                    case 'cartao':
                        $pagamento->cor = '#40B6E8';
                        $pagamento->icone = 'fa-solid fa-credit-card';
                        break;
                    case 'notas':
                        $pagamento->cor = '#6460CA';
                        $pagamento->icone = 'fa-solid fa-note-sticky';
                        break;
                    case 'ticket':
                        $pagamento->cor = '#19E47F';
                        $pagamento->icone = 'fa-solid fa-ticket';
                        break;
                    case 'valeFrete':
                        $pagamento->cor = '#E87848';
                        $pagamento->icone = 'fa-regular fa-clipboard';
                        break;
                    case 'chequeAVista':
                        $pagamento->cor = '#7995C2';
                        $pagamento->icone = 'fa-solid fa-money-check';
                        break;
                    case 'chequeAPrazo':
                        $pagamento->cor = '#D976E8';
                        $pagamento->icone = 'fa-solid fa-money-check-dollar';
                        break;
                    case 'valeCliente':
                        $pagamento->cor = '#42E3CF';
                        $pagamento->icone = 'fa-solid fa-person-circle-check';
                        break;
                    case 'pix':
                        $pagamento->cor = '#E85C54';
                        $pagamento->icone = 'fa-brands fa-pix';
                        break;
                    case 'dinheiro':
                        $pagamento->cor = '#9BE8E3';
                        $pagamento->icone = 'fa-solid fa-money-bill';
                        break;
                    default:
                        $pagamento->cor = 'secondary'; 
                        $pagamento->icone = 'fa-solid fa-question'; 
                        break;
                }
            
                $formaDePagamento[] = $pagamento;
                $dataIniFormatted = Carbon::createFromFormat('d/m/Y', $dataIni)->format('Y-m-d');
                $dataFimFormatted = Carbon::createFromFormat('d/m/Y', $dataFim)->format('Y-m-d');
            }
            
            return view("relatorios/vendasGerais",['dados'=>$dados,'formaDePagamento'=>$formaDePagamento,"dataIni"=>$dataIniFormatted,
                                      "dataFim"=>$dataFimFormatted,]);
            
        }catch(Exception $e){
            Log::info('mensagem de erro:', [$e->getMessage()]);
            return redirect()->route('vendas.dia')->with('Error', $e->getMessage());
        }
    }

    public function vendasCombustivel(Request $request)
    {
        $dataIni = $request->has('dataIni') ?  formatDate($request->dataIni) : Carbon::now()->format("d/m/Y");
        $dataFim = $request->has('dataFim') ?  formatDate($request->dataFim) : Carbon::now()->format("d/m/Y");
        $datas =[
            "dataini"=>$dataIni,
            "datafim"=>$dataFim
        ];
        try{
            $url = $this->url.'venda/combanalitico';
            $response = putResponse($url,$this->user->token, $datas);
            $dados = json_decode($response,false);
            return view('relatorios.vendasCombustivel',['dados'=>$dados]);
        }catch(Exception $e){
            Log::info("erro :",[$e->getMessage()]);
        }
    }
    public function vendasProduto(Request $request)
    {
        $dataIni = $request->has('dataIni') ?  formatDate($request->dataIni) : Carbon::now()->format("d/m/Y");
        $dataFim = $request->has('dataFim') ?  formatDate($request->dataFim) : Carbon::now()->format("d/m/Y");
        $datas =[
            "dataini"=>$dataIni,
            "datafim"=>$dataFim
        ];
        try{
            $url = $this->url.'venda/prodanalitico';
            $response = putResponse($url,$this->user->token, $datas);
            $dados = json_decode($response,false);
            // dd($dados);
            return view('relatorios.vendasProduto',['dados'=>$dados]);
        }catch(Exception $e){
            Log::info("erro :",[$e->getMessage()]);
        }
    }
}