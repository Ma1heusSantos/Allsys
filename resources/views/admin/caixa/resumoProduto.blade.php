@extends('layouts.template')
@section('conteudo')
    @foreach ($dados as $dado)
        @foreach ($dado->g01 as $grupo)

            <body style="background-color: #f5f5f5;">
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="card shadow-lg border-0"
                                style="border-radius: 10px; background-color: #2b2b3d; color: white;">
                                <div class="card-body">
                                    <h5 class="card-title text-center fw-bold">{{ $grupo->dscprod }}</h5>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span><strong>Código do Produto:</strong></span>
                                        <span>{{ $grupo->codprod }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span><strong>Quantidade Total:</strong></span>
                                        <span>{{ "R$ " . money($grupo->qtdtotal) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span><strong>Valor Total:</strong></span>
                                        <span>{{ "R$ " . money($grupo->valor) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span><strong>Preço Médio:</strong></span>
                                        <span>{{ "R$ " . money($grupo->precomedio) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach

        @foreach ($dado->g02 as $grupo)

            <body style="background-color: #f5f5f5;">
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="card shadow-lg border-0"
                                style="border-radius: 10px; background-color: #2b2b3d; color: white;">
                                <div class="card-body">
                                    <h5 class="card-title text-center fw-bold">{{ $grupo->dscprod }}</h5>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span><strong>Código do Produto:</strong></span>
                                        <span>{{ $grupo->codprod }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span><strong>Quantidade Total:</strong></span>
                                        <span>{{ "R$ " . money($grupo->qtdtotal) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span><strong>Valor Total:</strong></span>
                                        <span>{{ "R$ " . money($grupo->valor) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span><strong>Preço Médio:</strong></span>
                                        <span>{{ "R$ " . money($grupo->precomedio) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach

        @foreach ($dado->g03 as $grupo)

            <body style="background-color: #f5f5f5;">
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="card shadow-lg border-0"
                                style="border-radius: 10px; background-color: #2b2b3d; color: white;">
                                <div class="card-body">
                                    <h5 class="card-title text-center fw-bold">{{ $grupo->dscprod }}</h5>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span><strong>Código do Produto:</strong></span>
                                        <span>{{ $grupo->codprod }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span><strong>Quantidade Total:</strong></span>
                                        <span>{{ "R$ " . money($grupo->qtdtotal) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span><strong>Valor Total:</strong></span>
                                        <span>{{ "R$ " . money($grupo->valor) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span><strong>Preço Médio:</strong></span>
                                        <span>{{ "R$ " . money($grupo->precomedio) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach




        <!-- Total Card -->
        <div class="row justify-content-center mt-3">
            <div class="col-lg-8 mb-4">
                <div class="card shadow-lg border-0 text-center"
                    style="border-radius: 10px; background-color: #2b2b3d; color: white;">
                    <div class="card-body">
                        <h5><strong>Total Produtos:</strong> {{ $dado->totalprod }}</h5>
                    </div>
                </div>
            </div>
        </div>

        </div>
    @endforeach
@endsection
