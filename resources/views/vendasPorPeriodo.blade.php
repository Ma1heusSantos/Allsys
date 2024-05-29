@extends('layouts.template')
@section('titulo')
    data period
@endsection

@section('conteudo')

    <div class="card mx-auto shadow w-100 p-0">
        <h2 class="card-title p-3 text-primary">
            Relatório por período
        </h2>
        <div class="card-body">
            <div class="form-group">
                <form action="{{ route('getVendasDia') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group p-2">
                                <label for="dataini">Data de Início</label>
                                <input required name="dataini" class="form-control" type="date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group p-2">
                                <label for="datafim">Data de Fim</label>
                                <input required name="datafim" class="form-control" type="date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group p-2 mt-2">
                                <button class="btn btn-primary w-100">Enviar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <hr>
            <div class="table-responsive">
                @isset($dados)
                    <table id="table">
                        <thead>
                            <tr>
                                <th class="col-1">Cód.de venda</th>
                                <th style="width: 40%">Produto</th>
                                <th class="text-center">Preço de Venda</th>
                                <th class="text-center">Total da venda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dados as $dado)
                                <tr>
                                    <td>{{ $dado->codvenda }}</td>
                                    <td>{{ $dado->dscprod }}</td>
                                    <td class="text-center">{{ $dado->precoitemvenda }}</td>
                                    <td class="text-center">{{ $dado->totalitemvenda }}</td>
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
@endsection
@section('script')
    <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let table = new DataTable('#table');
    </script>
@endsection
