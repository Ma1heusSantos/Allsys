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
    </style>

    <div class="container mt-5">
        <div class="row">
            @foreach ($paginatedBicos as $bico)
                <div class="col-lg-3 col-md-12 mb-3">
                    <div class="card text-light mb-3" style="min-width: 12rem; height: 18rem; background-color:#29292e;">
                        <div class="d-flex align-items-center justify-content-between p-4">
                            <i class="fa-solid fa-gas-pump  fa-2xl" style="color: {{ $bico['icon-color'] }};"></i>
                            <h6 class="mt-3 font-weight-bold text-{{ $bico['color'] }}">BICO: {{ $bico['codbico'] }}</h6>
                            <button type="button"
                                class="btn btn-outline-{{ $bico['color'] }}">{{ $bico['status'] }}</button>
                        </div>
                        <div class="card-body text-light">
                            <h6 class="card-title text-{{ $bico['color'] }} fw-bold">
                                {{ $bico['dscprod'] }}
                            </h6>
                            <ul class="list-unstyled">
                                <li><strong>Encerrante:</strong> <span
                                        class="text-{{ $bico['color'] }} fw-bold">{{ $bico['encerrantebico'] }}</span></li>
                                <li><strong>Volume:</strong> <span
                                        class="text-{{ $bico['color'] }} fw-bold">{{ $bico['volumeatualbico'] }}
                                        L</span></li>
                                <li><strong>Valor atual:</strong> <span class="text-{{ $bico['color'] }} fw-bold">R$
                                        {{ money($bico['valoratualbico']) }}</span></li>
                                <li>
                                    <strong>À vista:</strong> <span class="text-{{ $bico['color'] }} fw-bold">R$
                                        {{ money($bico['avista']) }}</span>
                                    <strong>À prazo:</strong> <span class="text-{{ $bico['color'] }} fw-bold">R$
                                        {{ money($bico['aprazo']) }}</span>
                                </li>
                                <li><strong>Status:</strong> <span
                                        class="fw-bold text-{{ $bico['color'] }}">{{ $bico['status'] }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $paginatedBicos->links() }}
    </div>
@endsection
