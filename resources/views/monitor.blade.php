@extends('layouts.template')
@section('titulo')
    Monitor
@endsection

@section('conteudo')
    <div class="container">
        <div class="row">
            @foreach ($paginatedBicos as $bico)
                <div class="col-lg-3 col-md-6 mb-3 d-flex">
                    <div class="pb-2 bg-{{ $bico['color'] }} card-model"
                        style="cursor: pointer; border-radius: 1.2rem 1.2rem 0.5rem 0.5rem !important; width: 100%; height: 31.5rem">
                        <div class="card bg-white w-100 h-100" style="border-radius: inherit">
                            <div class="card-header p-0 w-100"
                                style="border-radius: inherit; position: relative; z-index: 0; height: 15rem">
                                <div style="border-radius: 1.2rem 1.2rem 0 0 !important; height: 12rem">
                                    {{-- <img class="img-fluid img-{{ $bico['color'] }}"
                                        src="{{ asset('img/gas-pump-solid.svg') }}" alt="Imagem do Card do Produto"
                                        style="width: inherit; height: inherit; object-fit: cover; border-radius: inherit; margin-left:4.0rem; margin-top:1.2rem;" /> --}}
                                    <x-Img-bomba />
                                </div>
                            </div>
                            <div class="card-body bg-white"
                                style="position: relative; z-index: 1; overflow-y: hidden !important">
                                <div>
                                    <h2 class="text-primary text-center font-weight-bolder" style="font-size: 18px">
                                        {{ $bico['dscprod'] }} - CODIGO: {{ $bico['codbico'] }} </h2>
                                </div>
                                <div style="overflow: hidden !important">
                                    <p class="" style="overflow: hidden !important">encerrante do bico: <span
                                            class="text-secondary"
                                            style="overflow: hidden !important">{{ $bico['encerrantebico'] }}</span>
                                    </p>
                                    <p class="text-dark font-weight-bold" style="overflow: hidden !important">volume atual
                                        do
                                        bico:
                                        <span class="text-secondary"
                                            style="overflow: hidden !important">{{ $bico['volumeatualbico'] }}</span>
                                    </p>
                                    <p class="text-dark font-weight-bold" style="overflow: hidden !important">valor atual do
                                        bico: <span class="text-secondary" style="overflow: hidden !important">R$
                                            {{ money($bico['valoratualbico']) }}</span>
                                    </p>
                                    <p class="text-dark font-weight-bold" style="overflow: hidden !important">avista: <span
                                            class="text-secondary" style="overflow: hidden !important">R$
                                            {{ money($bico['avista']) }}</span>
                                    </p>
                                    <p class="text-dark font-weight-bold" style="overflow: hidden !important">aprazo: <span
                                            class="text-secondary" style="overflow: hidden !important">R$
                                            {{ money($bico['aprazo']) }}</span>
                                    </p>
                                    <p class="text-dark font-weight-bold" style="overflow: hidden !important">Status: <span
                                            class="font-weight-bolder text-{{ $bico['color'] }}"
                                            style="overflow: hidden !important">{{ $bico['status'] }}</span>
                                    </p>
                                </div>
                            </div>
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
