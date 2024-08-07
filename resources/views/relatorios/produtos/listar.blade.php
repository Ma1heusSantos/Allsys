@extends('layouts.template')

@section('titulo')
    Listagem de Produtos
@endsection

@section('conteudo')

    <style>
        /* Estilo para o card */
        .card-dark {
            background-color: #1e1e2f;
            color: #fff;
            border: none;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Estilo para o cabeçalho do card */
        .card-dark .card-title {
            color: #007bff;
            margin-bottom: 20px;
        }

        /* Estilo para a tabela */
        .table-dark {
            width: 100%;
            border-collapse: collapse;
            background-color: #1e1e2f;
            color: #fff;
        }

        .table-dark th,
        .table-dark td {
            padding: 12px;
            border: 1px solid #2c2c3e;
            text-align: center;
        }

        .table-dark thead th {
            background-color: #2c2c3e;
            color: #fff;
        }

        .table-dark tbody tr {
            background-color: #1e1e2f;
        }

        .table-dark tbody tr:hover {
            background-color: #33334a;
        }

        .table-dark tbody td {
            text-align: center;
        }

        /* Estilo para mensagens de texto */
        .text-primary {
            color: #007bff !important;
        }

        /* Estilo para mensagens de erro */
        .text-danger {
            color: #f72626 !important;
        }

        select[name="table_length"] {
            background-color: #f0f0f0;
            /* Cor de fundo do select */
            color: #333;
            /* Cor do texto do select */
        }

        /* Estilizando as options */
        select[name="table_length"] option {
            background-color: #e0e0e0;
            /* Cor de fundo das opções */
            color: #000;
            /* Cor do texto das opções */
        }
    </style>

    <div class="card card-dark mx-auto mt-5 w-100 p-0">
        <h2 class="card-title p-3 text-primary">
            Produtos
        </h2>
        <div class="card-body">
            <div class="table-responsive">
                @isset($produtos)
                    <table id="table" class="table-dark">
                        <thead>
                            <tr>
                                <th class="col-1">Cód. do prod</th>
                                <th style="width: 40%">Produto</th>
                                <th>Valor de compra</th>
                                <th>Valor de venda</th>
                                <th>Última data de compra</th>
                                <th>Última data de venda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produtos as $produto)
                                <tr>
                                    <td>{{ $produto->codprod }}</td>
                                    <td>{{ $produto->dscprod }}</td>
                                    <td>R$ {{ money($produto->valorcompraprod) }}</td>
                                    <td>R$ {{ money($produto->valorvendaprod) }}</td>
                                    <td>{{ formatDate($produto->dataultcompraprod) }}</td>
                                    <td>{{ formatDate($produto->dataultvendaprod) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-danger">Nenhum produto encontrado!</p>
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
