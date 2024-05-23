@extends('layouts.template')
@section('titulo')
    data period
@endsection
@section('conteudo')
    <div class="card mx-auto shadow w-75 w-md-50">
        <h2 class="card-title p-3 text-primary">
            Relatório por período
        </h2>
        <div class="card-body">
            <div class="row">
                <div class="row col-12">
                    <div class="row form-group">
                        <form action="{{ route('getVendasDia') }}" method="post">
                            @csrf
                            <div class="row d-flex flex-row">
                                <div class="col-md-5">
                                    <div class="form-group p-2">
                                        <label for="dataini">Data de Início</label>
                                        <input required name="dataini" class="form-control" type="date">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group p-2">
                                        <label for="datafim">Data de Fim</label>
                                        <input required name="datafim" class="form-control" type="date">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button class="btn btn-primary w-100" style="margin-top: 30px;">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div>
                        @isset($dados)
                            <table class="table table-hover mt-5">
                                <thead>
                                    <tr>
                                        <th>Cód.de venda</th>
                                        <th>Produto</th>
                                        <th>Preço de Venda</th>
                                        <th>Total da venda</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dados as $dado)
                                        <tr>
                                            <td>{{ $dado->codvenda }}</td>
                                            <td>{{ $dado->dscprod }}</td>
                                            <td>{{ $dado->precoitemvenda }}</td>
                                            <td>{{ $dado->totalitemvenda }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Nenhum produto foi vendido nesse dia</p>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
