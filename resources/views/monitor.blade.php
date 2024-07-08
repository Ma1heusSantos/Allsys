@extends('layouts.template')
@section('titulo')
    Monitor
@endsection

@section('conteudo')
    <div class="container">
        <div class="row">
            @foreach ($paginatedBicos as $bico)
                <div class="col-lg-3 col-md-6 mb-4 d-flex">
                    <div class="card bg-light shadow-sm w-100" style="border-radius: 1.2rem; cursor: pointer;">
                        <div class="card-header bg-{{ $bico['color'] }} p-0" style="border-radius: 1.2rem 1.2rem 0 0;">
                            <div style="height: 12rem; overflow: hidden; border-radius: 1.2rem 1.2rem 0 0;">
                                <x-Img-bomba />
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-primary text-center font-weight-bold">
                                {{ $bico['dscprod'] }} - CODIGO: {{ $bico['codbico'] }}
                            </h5>
                            <ul class="list-unstyled">
                                <li><strong>Encerrante do bico:</strong> <span
                                        class="text-secondary">{{ $bico['encerrantebico'] }}</span></li>
                                <li><strong>Volume atual do bico:</strong> <span
                                        class="text-secondary">{{ $bico['volumeatualbico'] }}</span></li>
                                <li><strong>Valor atual do bico:</strong> <span class="text-secondary">R$
                                        {{ money($bico['valoratualbico']) }}</span></li>
                                <li><strong>À vista:</strong> <span class="text-secondary">R$
                                        {{ money($bico['avista']) }}</span></li>
                                <li><strong>A prazo:</strong> <span class="text-secondary">R$
                                        {{ money($bico['aprazo']) }}</span></li>
                                <li><strong>Status:</strong> <span
                                        class="font-weight-bold text-{{ $bico['color'] }}">{{ $bico['status'] }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div>
            {{ $paginatedBicos->links() }}
        </div>
    </div>
@endsection
