@extends('layouts.template')
@section('titulo')
    Monitor
@endsection

@section('conteudo')
    <style>
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
    </style>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
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
                                    {{-- <td>{{ $faturamento->codcliente }}</td> --}}
                                    <td>{{ $faturamento->nomecliente }}</td>
                                    <td class="text-center">{{ $faturamento->notas }}</td>
                                    <td class="text-center">{{ "R$ " . money($faturamento->faturas) }}</td>
                                    <td class="text-center">{{ "R$ " . money($faturamento->total) }}</td>
                                    <td class="text-center"> <a class="btn btn-primary"
                                            href="{{ route('faturamento.cliente', [$faturamento->codcliente]) }}">Detalhes</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center table-responsive">
                    {{ $paginatedFaturamento->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
