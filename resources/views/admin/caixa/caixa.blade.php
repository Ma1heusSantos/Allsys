@extends('layouts.template')

@section('titulo')
    Caixa
@endsection

@section('conteudo')
    <style>
        th.sticky-col,
        td.sticky-col {
            position: -webkit-sticky;
            position: sticky;
            left: 0;
            background-color: #343a40;
            z-index: 1;
        }

        th.sticky-col {
            z-index: 2;
            /* para ficar acima das células de dados */
        }
    </style>
    @if ($errors->any())
        <div class=" mt-4 alert alert-danger text-danger text-center">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    <div class="card mt-5" style="background-color: #1e1e2f; color: #fff; border: none;">
        <div class="card-header mt-3 d-flex justify-content-between align-items-center flex-column flex-sm-row">
            <h4 class="text-primary fw-bold h1"><i class="fa-solid fa-wallet"></i> Caixa</h4>
        </div>
        <div class="card-body">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-12">
                        <h2 class="mb-4">Relatório</h2>
                        <div class="d-flex justify-content-between">
                            <h4 class="mb-3"><i class="fas fa-list-alt"></i> Resumo de Encerrantes</h4>
                            <form action="{{ route('caixa') }}" method="post">
                                @csrf
                                <div class="row g-3 align-items-center mx-1">
                                    <div class="col-12 col-sm-auto">
                                        <label for="dataFim" class="col-form-label text-light">Informe um terminal:</label>
                                    </div>
                                    <div class="col-12 col-sm-auto d-flex">
                                        <input type="text" name="terminal" class="form-control bg-dark text-light">
                                        <button type="submit" id="btn-form" class="input-group-addon btn btn-primary"
                                            style="background-color: rgb(13, 110, 253); color: #fff; width: 3rem; height: 2.3rem; border-radius: 0px 5px 5px 0px !important; margin-right: 2%">
                                            <i class="fas fa-search" style="color: #fff"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive mt-4 mb-5">
                            <table class="table table-bordered table-striped table-dark">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="sticky-col">Bico</th>
                                        <th>Abertura</th>
                                        <th>Fechamento</th>
                                        <th>Afer.</th>
                                        <th>Volume</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($encerrantes->resumoenc as $encerrante)
                                        <tr>
                                            <td class="sticky-col">{{ $encerrante->bico }}</td>
                                            <td>{{ $encerrante->abertura }}</td>
                                            <td>{{ $encerrante->fechamento }}</td>
                                            <td>{{ $encerrante->afericao }}</td>
                                            <td>{{ $encerrante->volume . 'L' }}</td>
                                            <td>{{ "R$ " . money($encerrante->valor) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <h4 class="mb-3"><i class="fas fa-gas-pump"></i> Resumo de Combustíveis</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-dark">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Combustível</th>
                                        <th>Volume</th>
                                        <th>Desc.</th>
                                        <th>P. Med</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($encerrantes->resumocomb as $comb)
                                        <tr>
                                            <td>{{ $comb->dscprod }}</td>
                                            <td>{{ $comb->volume . 'L' }}</td>
                                            <td>{{ "R$ " . money($comb->desconto) }}</td>
                                            <td>{{ $comb->preco }}</td>
                                            <td>{{ "R$ " . money($comb->valor) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">Total Combustíveis</th>
                                        <th>{{ "R$ " . money($totalComb) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <h4 class="mb-3 mt-3"><i class="fa-solid fa-sack-dollar"></i> Recebimentos do caixa</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-dark">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Dinheiro</th>
                                        <th>Cheque à vista</th>
                                        <th>Cheque à prazo</th>
                                        <th>Pix</th>
                                        <th>Vale frete</th>
                                        <th>Ticket vale</th>
                                        <th>Suprimento</th>
                                        <th>Notas</th>
                                        <th>Cartão</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ "R$ " . money($recebimentos['dinheiro']) }}</td>
                                        <td>{{ "R$ " . money($recebimentos['chequeVista']) }}</td>
                                        <td>{{ "R$ " . money($recebimentos['chequePrazo']) }}</td>
                                        <td>{{ "R$ " . money($recebimentos['pix']) }}</td>
                                        <td>{{ "R$ " . money($recebimentos['valeFrete']) }}</td>
                                        <td>{{ "R$ " . money($recebimentos['ticketVale']) }}</td>
                                        <td>{{ "R$ " . money($recebimentos['suprimento']) }}</td>
                                        <td>{{ "R$ " . money($recebimentos['trocoCH']) }}</td>
                                        <td>{{ "R$ " . money($recebimentos['cartao']) }}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="7">Total Recebimentos</th>
                                        <th>{{ "R$ " . money($recebimentos['total']) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <h4 class="mb-3 mt-3"><i class="fa-solid fa-money-bill-transfer"></i> Retiradas do caixa</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-dark">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Sangria</th>
                                        <th>Valefunc</th>
                                        <th>Valecliente</th>
                                        <th>Trococh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ "R$ " . money($retiradas['sangria']) }}</td>
                                        <td>{{ "R$ " . money($retiradas['valefunc']) }}</td>
                                        <td>{{ "R$ " . money($retiradas['valecliente']) }}</td>
                                        <td>{{ "R$ " . money($retiradas['trococh']) }}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">Total Retiradas</th>
                                        <th>{{ "R$ " . money($retiradas['total']) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <h4 class="mb-3 mt-3"><i class="fa-solid fa-box"></i> Resumo do caixa</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-dark">
                                <thead class="thead-dark">
                                    <tr>
                                        <th colspan="3">Total vendido</th>
                                        <th>{{ "R$ " . money($totalVenda) }}</th>
                                        <th colspan="3">Fechamento</th>
                                        <th>{{ "R$ " . money($fechamento) }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
