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
    <div class="card mt-5" style="background-color: #1e1e2f; color: #fff; border: none;">
        <div class="card-header mt-3 d-flex justify-content-between align-items-center flex-column flex-sm-row">
            <h4 class="text-primary fw-bold h1"><i class="fa-solid fa-wallet"></i> Caixa</h4>
        </div>
        <div class="card-body">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-12">
                        <h2 class="mb-4">Relatório</h2>

                        <h4 class="mb-3"><i class="fas fa-list-alt"></i> Resumo de Encerrantes</h4>
                        <div class="table-responsive mb-5">
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
                    </div>
                    <h4 class="mb-3"><i class="fa-solid fa-sack-dollar"></i> Recebimentos do caixa</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-dark">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Dinheiro</th>
                                    <th>Cheque a vista</th>
                                    <th>Cheque a prazo</th>
                                    <th>Pix</th>
                                    <th>Vale frete</th>
                                    <th>Ticket vale</th>
                                    <th>suprimento</th>
                                    <th>Troco CH Rec.</th>
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
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="7">Total Combustíveis</th>
                                    <th>{{ "R$ " . money($recebimentos['total']) }}</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
