@extends('layouts.template')
@section('titulo')
    Monitor
@endsection

@section('conteudo')
    <style>
        /* Estilo da Paginação */
        .pagination .page-item .page-link {
            color: #ffffff;
            /* Cor do texto */
            background-color: #343a40;
            /* Cor de fundo cinza */
            border: 1px solid #343a40;
            /* Cor da borda cinza */
        }

        .pagination .page-item.active .page-link {
            background-color: #6f42c1;
            /* Cor de fundo roxo para o item ativo */
            border-color: #6f42c1;
            /* Cor da borda roxo para o item ativo */
            color: #ffffff;
            /* Cor do texto branco */
        }

        .pagination .page-item .page-link:hover {
            background-color: #6f42c1;
            /* Cor de fundo roxo ao passar o mouse */
            border-color: #6f42c1;
            /* Cor da borda roxo ao passar o mouse */
            color: #ffffff;
            /* Cor do texto branco */
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            /* Cor do texto para itens desabilitados */
            background-color: #343a40;
            /* Cor de fundo cinza para itens desabilitados */
            border-color: #343a40;
            /* Cor da borda cinza para itens desabilitados */
        }

        .table-responsive .pagination {
            flex-wrap: wrap;
        }

        /* Estilo Geral */
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: 'Roboto', sans-serif;
        }

        .card {
            background-color: #1f1f2f;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            flex-direction: column;
            flex-direction: row;
            background-color: #27293d;
            border-bottom: none;
            border-radius: 8px 8px 0 0;
            padding: 1.5rem 2rem;
        }

        .card-header h4 {
            font-size: 1.75rem;
            margin-bottom: 0;
            color: #6f42c1;
            /* primary do Bootstrap */
        }

        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 1rem;
        }

        .search-form input[type="text"] {
            width: 100%;
            padding: 0.75rem 1rem;
            background-color: #2a2a3b;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            font-size: 1rem;
        }

        .search-form input[type="text"]::placeholder {
            color: #cccccc;
            /* Cor desejada para o placeholder */
            opacity: 1;
            /* Garante que a cor definida será aplicada completamente */
        }

        .search-form input[type="text"]:focus {
            outline: none;
            background-color: #343a40;
        }

        .search-form button {
            padding: 0.75rem 1rem;
            background-color: #6f42c1;
            /* primary do Bootstrap */
            border: none;
            border-radius: 5px;
            color: #ffffff;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-form button:hover {
            background-color: #6f42c1;
            /* primary do Bootstrap escuro */
        }

        @media (min-width: 576px) {

            .search-form input[type="text"],
            .search-form button {
                width: auto;
                margin-bottom: 0;
            }
        }

        /* Estilo da Tabela */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
        }

        th,
        td {
            white-space: nowrap;
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid #343a40;
        }

        th {
            background-color: #343a40;
            font-weight: bold;
        }

        td {
            background-color: #2a2a3b;
        }

        a.btn-primary {
            background-color: #6f42c1;
            /* primary do Bootstrap */
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        a.btn-primary:hover {
            background-color: #6f42c1;
            /* primary do Bootstrap escuro */
            transform: scale(1.05);
        }

        a.btn-primary:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.5);
        }

        /* Responsividade para dispositivos móveis */
        @media (max-width: 576px) {
            .card-header h4 {
                font-size: 1.5rem;
            }
        }
    </style>

    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center flex-column flex-sm-row">
            <h4 class="fw-bold"><i class="fa-solid fa-receipt"></i> Notas de clientes</h4>
        </div>
        <div class="card-body">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <form action="{{ route('faturamento') }}" method="post" class="search-form">
                                @csrf
                                <input name="cliente" class="form-control" type="text"
                                    placeholder="Pesquise por um cliente">
                                <button class="btn btn-primary" type="submit">Enviar</button>
                                <button onclick="window.location.href='{{ route('faturamento') }}'">Limpar Filtro</button>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-dark">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nome do cliente</th>
                                        <th class="text-center">Notas</th>
                                        <th class="text-center">Faturas</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Detalhes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paginatedFaturamento as $faturamento)
                                        <tr>
                                            <td>{{ $faturamento->nomecliente }}</td>
                                            <td class="text-center">{{ $faturamento->notas }}</td>
                                            <td class="text-center">{{ "R$ " . money($faturamento->faturas) }}</td>
                                            <td class="text-center">{{ "R$ " . money($faturamento->total) }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-primary"
                                                    href="{{ route('faturamento.cliente', [$faturamento->codcliente]) }}">Detalhes</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center table-responsive">
        {{ $paginatedFaturamento->links() }}
    </div>
@endsection
