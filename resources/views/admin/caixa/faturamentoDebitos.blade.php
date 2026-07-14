@extends('layouts.template')
@section('titulo')
    Debitos de clientes
@endsection

@section('conteudo')
    <style>
        .pagination .page-item .page-link {
            color: #ffffff;
            background-color: #343a40;
            border: 1px solid #343a40;
        }

        .pagination .page-item.active .page-link,
        .pagination .page-item .page-link:hover {
            background-color: #6f42c1;
            border-color: #6f42c1;
            color: #ffffff;
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #343a40;
            border-color: #343a40;
        }

        .table-responsive .pagination {
            flex-wrap: wrap;
        }

        body {
            background-color: #121212;
            color: #ffffff;
            color-scheme: dark;
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
        }

        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 1rem;
        }

        .search-form input {
            width: 100%;
            padding: 0.75rem 1rem;
            background-color: #2a2a3b;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            color-scheme: dark;
            font-size: 1rem;
        }

        .search-form input::placeholder {
            color: #cccccc;
            opacity: 1;
        }

        .search-form input:focus {
            outline: none;
            background-color: #343a40;
        }

        .search-form input[type="date"]::-webkit-calendar-picker-indicator {
            cursor: pointer;
            filter: invert(1);
            opacity: 0.8;
        }

        .search-form button {
            padding: 0.75rem 1rem;
            background-color: #6f42c1;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-form button:hover {
            background-color: #6f42c1;
        }

        @media (min-width: 576px) {
            .search-form input,
            .search-form button {
                width: auto;
                margin-bottom: 0;
            }
        }

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
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        a.btn-primary:hover {
            background-color: #6f42c1;
            transform: scale(1.05);
        }

        a.btn-primary:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.5);
        }

        @media (max-width: 576px) {
            .card-header h4 {
                font-size: 1.5rem;
            }
        }
    </style>

    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center flex-column flex-sm-row">
            <h4 class="fw-bold"><i class="fa-solid fa-receipt"></i> Debitos de clientes</h4>
        </div>
        <div class="card-body">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <form action="{{ route('faturamento.debitos') }}" method="post" class="search-form">
                                @csrf
                                <input name="cliente" class="form-control" type="text"
                                    value="{{ $cliente ?? '' }}" placeholder="Pesquise por um cliente">
                                <input name="dataIni" class="form-control" type="date" value="{{ $dataIni }}">
                                <input name="dataFim" class="form-control" type="date" value="{{ $dataFim }}">
                                <button class="btn btn-primary" type="submit">Enviar</button>
                                <button type="button"
                                    onclick="window.location.href='{{ route('faturamento.debitos') }}'">Limpar Filtro</button>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-dark">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nome do cliente</th>
                                        <th class="text-center">Saldo anterior</th>
                                        <th class="text-center">Novos debitos</th>
                                        <th class="text-center">Recebimentos</th>
                                        <th class="text-center">Saldo final</th>
                                        <th class="text-center">Detalhes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paginatedDebitos as $debito)
                                        <tr>
                                            <td>{{ $debito->nomecliente }}</td>
                                            <td class="text-center">{{ "R$ " . money($debito->saldoAnterior ?? 0) }}</td>
                                            <td class="text-center">{{ "R$ " . money($debito->novosDebitos ?? 0) }}</td>
                                            <td class="text-center">{{ "R$ " . money($debito->recebimentos ?? 0) }}</td>
                                            <td class="text-center">{{ "R$ " . money($debito->saldoFinal ?? 0) }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-primary"
                                                    href="{{ route('faturamento.cliente', [$debito->codcliente]) }}">Detalhes</a>
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
        {{ $paginatedDebitos->links() }}
    </div>
@endsection
