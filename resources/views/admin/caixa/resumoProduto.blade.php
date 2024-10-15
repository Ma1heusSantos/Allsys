@extends('layouts.template')
@section('conteudo')
    @foreach ($dados as $dado)

        <body style="background-color: #f5f5f5;">
            <div class="container mt-5">
                <h3 class="text-center mb-4">Resumo de Produtos</h3>

                <!-- G01 Card -->
                <div class="row justify-content-center">
                    <div class="col-lg-8 mb-4">
                        <div class="card shadow-lg border-0"
                            style="border-radius: 10px; background-color: #2b2b3d; color: white;">
                            <div class="card-header text-center">
                                <h5>Grupo: ADITIVO</h5>
                            </div>
                            <div class="card-body">
                                <!-- Produto 1 -->
                                <div class="mb-3">
                                    <h6><strong>Produto:</strong> ADITIVO MIX PARA COMBUSTIVEL DIESEL REDNAQ 200 ML</h6>
                                    <p><strong>Código:</strong> 3871 | <strong>Quantidade:</strong> 2 |
                                        <strong>Valor:</strong> R$ 54 | <strong>Preço Médio:</strong> R$ 27
                                    </p>
                                </div>
                                <!-- Produto 2 -->
                                <div class="mb-3">
                                    <h6><strong>Produto:</strong> ADITIVO WURTH DE RADIADOR ORGANICO ROSA 1 LT</h6>
                                    <p><strong>Código:</strong> 5388 | <strong>Quantidade:</strong> 1 |
                                        <strong>Valor:</strong> R$ 30 | <strong>Preço Médio:</strong> R$ 30
                                    </p>
                                </div>
                                <!-- Produto 3 -->
                                <div class="mb-3">
                                    <h6><strong>Produto:</strong> ADITIVO WURTH LIMPA PARA BRISA</h6>
                                    <p><strong>Código:</strong> 472 | <strong>Quantidade:</strong> 1 |
                                        <strong>Valor:</strong> R$ 6 | <strong>Preço Médio:</strong> R$ 6
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- G02 Card -->
                <div class="row justify-content-center">
                    <div class="col-lg-8 mb-4">
                        <div class="card shadow-lg border-0"
                            style="border-radius: 10px; background-color: #2b2b3d; color: white;">
                            <div class="card-header text-center">
                                <h5>Grupo: DIVERSOS</h5>
                            </div>
                            <div class="card-body">
                                <!-- Produto 1 -->
                                <div class="mb-3">
                                    <h6><strong>Produto:</strong> ARLA REDUX 32 GRANEL LT</h6>
                                    <p><strong>Código:</strong> 4046 | <strong>Quantidade:</strong> 122.15 |
                                        <strong>Valor:</strong> R$ 487.35 | <strong>Preço Médio:</strong> R$ 3.99
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- G03 Card -->
                <div class="row justify-content-center">
                    <div class="col-lg-8 mb-4">
                        <div class="card shadow-lg border-0"
                            style="border-radius: 10px; background-color: #2b2b3d; color: white;">
                            <div class="card-header text-center">
                                <h5>Grupo: LUBRIFICANTE</h5>
                            </div>
                            <div class="card-body">
                                <!-- Produto 1 -->
                                <div class="mb-3">
                                    <h6><strong>Produto:</strong> LUBRAX ATF TA 1/2LT</h6>
                                    <p><strong>Código:</strong> 631 | <strong>Quantidade:</strong> 2 |
                                        <strong>Valor:</strong> R$ 45 | <strong>Preço Médio:</strong> R$ 22.5
                                    </p>
                                </div>
                                <!-- Produto 2 -->
                                <div class="mb-3">
                                    <h6><strong>Produto:</strong> LUBRAX ESSENCIAL 2T 200 ML</h6>
                                    <p><strong>Código:</strong> 35 | <strong>Quantidade:</strong> 2 |
                                        <strong>Valor:</strong> R$ 20 | <strong>Preço Médio:</strong> R$ 10
                                    </p>
                                </div>
                                <!-- Produto 3 -->
                                <div class="mb-3">
                                    <h6><strong>Produto:</strong> LUBRAX ESSENCIAL SL 20W50 1LT</h6>
                                    <p><strong>Código:</strong> 981 | <strong>Quantidade:</strong> 1 |
                                        <strong>Valor:</strong> R$ 30 | <strong>Preço Médio:</strong> R$ 30
                                    </p>
                                </div>
                                <!-- Produto 4 -->
                                <div class="mb-3">
                                    <h6><strong>Produto:</strong> LUBRAX EXTRA TURBO CH-4 15W40 1LT</h6>
                                    <p><strong>Código:</strong> 2505 | <strong>Quantidade:</strong> 1 |
                                        <strong>Valor:</strong> R$ 30 | <strong>Preço Médio:</strong> R$ 30
                                    </p>
                                </div>
                                <!-- Produto 5 -->
                                <div class="mb-3">
                                    <h6><strong>Produto:</strong> LUBRAX NAUTICA GASOLINA 2T 500 ML</h6>
                                    <p><strong>Código:</strong> 453 | <strong>Quantidade:</strong> 1 |
                                        <strong>Valor:</strong> R$ 35 | <strong>Preço Médio:</strong> R$ 35
                                    </p>
                                </div>
                                <!-- Produto 6 -->
                                <div class="mb-3">
                                    <h6><strong>Produto:</strong> LUBRAX TECNO PRO 15W40 1/2LT</h6>
                                    <p><strong>Código:</strong> 451 | <strong>Quantidade:</strong> 1 |
                                        <strong>Valor:</strong> R$ 20 | <strong>Preço Médio:</strong> R$ 20
                                    </p>
                                </div>
                                <!-- Produto 7 -->
                                <div class="mb-3">
                                    <h6><strong>Produto:</strong> LUBRAX VALORA OFFROAD 5W30 1LT</h6>
                                    <p><strong>Código:</strong> 5583 | <strong>Quantidade:</strong> 1 |
                                        <strong>Valor:</strong> R$ 43.20 | <strong>Preço Médio:</strong> R$ 43.20
                                    </p>
                                </div>
                                <!-- Produto 8 -->
                                <div class="mb-3">
                                    <h6><strong>Produto:</strong> LUBRAX VALORA OFFROAD 5W30 3LT</h6>
                                    <p><strong>Código:</strong> 5577 | <strong>Quantidade:</strong> 2 |
                                        <strong>Valor:</strong> R$ 252 | <strong>Preço Médio:</strong> R$ 126
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Card -->
                <div class="row justify-content-center">
                    <div class="col-lg-8 mb-4">
                        <div class="card shadow-lg border-0 text-center"
                            style="border-radius: 10px; background-color: #2b2b3d; color: white;">
                            <div class="card-body">
                                <h5><strong>Total Produtos:</strong> R$ 1052.55</h5>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    @endforeach
@endsection
