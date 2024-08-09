@extends('layouts.template')
@section('title')
    faturamento por cliente
@endsection
@section('conteudo')
    <div class="card mt-5">
        <div class="card-header" style="background-color: #29292e">
            <section>
                <div class="row px-4 pt-4">
                    <h1 class="text-lg text-indigo" style="font-weight: 500">
                        <span class="fw-bold text-primary">Contas</span>
                    </h1>
                </div>
            </section>
        </div>
        <div class="card-body" style="background-color: #29292e">
            <table class="table table-bordered table-striped table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th>Nome do cliente</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Data da Emissão</th>
                        <th class="text-center">Data de Vencimento</th>
                        <th class="text-center">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contas as $conta)
                        <tr>
                            <td>{{ $conta->nomecliente }}</td>
                            <td class="text-center">{{ $conta->tipo }}</td>
                            <td class="text-center">{{ formatDate($conta->dataemissao) }}</td>
                            <td class="text-center">{{ formatDate($conta->datavencimento) }}</td>
                            <td class="text-center">{{ "R$ " . money($conta->valor) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total</th>
                        <th class="text-center">{{ "R$ " . money($total) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
