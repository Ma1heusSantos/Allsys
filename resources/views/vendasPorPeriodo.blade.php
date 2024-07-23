@extends('layouts.template')
@section('titulo')
    data period
@endsection

@section('conteudo')
    <style>
        /* Estilos gerais para o tema escuro */
        body {
            background-color: #1e1e2f;
            color: #fff;
        }

        /* Card escuro */
        .card {
            background-color: #2c2c3e;
            border: none;
            color: #fff;
        }

        /* Estilo para inputs e botões */
        input[type="date"],
        button {
            background-color: #3a3a4a;
            border: 1px solid #3a3a4a;
            color: #fff;
        }

        button:hover {
            background-color: #4a4a5a;
        }

        /* Estilo para a tabela */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #444;
            background-color: #2c2c3e;
            color: #fff;
            padding: 10px;
        }

        th {
            background-color: #333;
        }

        /* Estilo para o dropdown */
        .dataTables_length select {
            background-color: #2c2c3e;
            /* Fundo escuro */
            color: #fff;
            /* Texto branco */
            border: 1px solid #2c2c3e;
            padding: 5px;
            border-radius: 4px;
        }

        /* Estilo para as opções do dropdown */
        .dataTables_length select option {
            background-color: #2c2c3e;
            /* Fundo escuro */
            color: #000;
            /* Texto preto para contraste */
        }

        /* Estilo para as opções do dropdown quando abertas */
        .dataTables_length select:focus {
            outline: none;
            background-color: #2c2c3e;
            color: #fff;
        }
    </style>

    @if ($errors->any())
        <div class="alert alert-danger text-danger text-center">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
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
                                <label for="dataini">Data de Início: </label>
                                <input required name="dataini" class="form-control" type="date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group p-2">
                                <label for="datafim">Data de Fim: </label>
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
                    <p class="text-danger">Nenhum produto foi vendido nesse dia</p>
                @endisset
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json"
                }
            });
        });
    </script>
@endsection
