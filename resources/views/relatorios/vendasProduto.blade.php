@extends('layouts.template')
@section('conteudo')
    @foreach ($dados as $dado)

        <body style="background-color: #f5f5f5;">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card shadow-lg border-0"
                            style="border-radius: 10px; background-color: #2b2b3d; color: white;">
                            <div class="card-body">
                                <h5 class="card-title text-center fw-bold">{{ $dado->dscprod }}</h5>
                                <div class="d-flex justify-content-between mb-3">
                                    <span><strong> Quantidade:</strong></span>
                                    <span>{{ $dado->qtdeitens }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span><strong>Valor Bruto:</strong></span>
                                    <span>{{ "R$ " . money($dado->valorbruto) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span><strong>Valor Liquido:</strong></span>
                                    <span>{{ money($dado->valorliquido) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span><strong>Custo:</strong></span>
                                    <span>{{ "R$ " . money($dado->custo) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span><strong>Lucro Bruto:</strong></span>
                                    <span>{{ "R$ " . money($dado->lucrobruto) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span><strong>Margem:</strong></span>
                                    <span>{{ "R$ " . money($dado->margem) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
@endsection
