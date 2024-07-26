@extends('layouts.template')
@section('titulo')
    Caixa
@endsection
@section('conteudo')
    <style>
        /* Estilo para a tabela */
        .table-custom {
            width: 15%;
            border-collapse: collapse;
            background-color: #1e1e2f;
            color: #fff;
        }

        .table-custom th,
        .table-custom td {
            padding: 12px;
            border: 1px solid #2c2c3e;
        }

        .table-custom thead th {
            background-color: #1e1e2f;
            color: #fff;
        }

        .table-custom tbody tr {
            background-color: #1e1e2f;
        }

        .table-custom tbody tr:hover {
            background-color: #33334a;
        }

        .table-custom a {
            color: inherit;
            text-decoration: none;
        }

        .table-custom i {
            padding: 8px;
        }

        .table-custom .edit-icon {
            color: #FFD43B;
        }

        .table-custom .delete-icon {
            color: #f72626;
        }
    </style>
    <div class="card mt-5" style="background-color:#1e1e2f; color:#fff; border:none;">
        <div class="card-header mt-3 d-flex justify-content-between flex-column flex-sm-row">
            <div>
                <h4 class="text-primary fw-bold h1">Caixa</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="container mt-4">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th scope="col">Bico</th>
                                    <th scope="col">Abertura</th>
                                    <th scope="col">fechamento</th>
                                    <th scope="col">Volume</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Aferição</th>
                                </tr>
                            </thead>
                            <tbody>
                                @dd($dados)
                                @foreach ($dados->resumoenc as $dado)
                                    <tr>
                                        <td>{{ $dado->bico }}</td>
                                        <td>{{ $dado->abertura }}</td>
                                        <td>{{ $dado->fechamento }}</td>
                                        <td>{{ $dado->volume }}</td>
                                        <td>{{ "R$ " . money((float) $dado->valor) }}</td>
                                        <td>{{ $dado->afericao }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
