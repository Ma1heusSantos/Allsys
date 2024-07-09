@extends('layouts.template')
@section('titulo')
    Monitor
@endsection

@section('conteudo')
    <div class="container">
        <div class="row">
            @foreach ($paginatedBicos as $bico)
                <div class="col-lg-3 col-md-12 mb-3">
                    <div class="card shadow text-light mb-3"
                        style="min-width: 12rem; height: 18rem; background-color:#121214;">
                        <div class="d-flex align-items-center justify-content-between p-4">
                            <i class="fa-solid fa-gas-pump  fa-2xl" style="color: {{ $bico['icon-color'] }};"></i>
                            <button type="button" class="btn btn-outline-{{ $bico['color'] }}">{{ $bico['status'] }}</button>
                        </div>
                        <div class="card-body text-light">
                            <h6 class="card-title text-{{ $bico['color'] }} fw-bold">
                                {{ $bico['dscprod'] }} - BICO: {{ $bico['codbico'] }}
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
                                    <strong>A prazo:</strong> <span class="text-{{ $bico['color'] }} fw-bold">R$
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
