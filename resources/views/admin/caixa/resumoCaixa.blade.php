@extends('layouts.template')
@section('conteudo')
    <style>
        /* Estilos gerais */
        body {
            background-color: #f5f5f5;
        }

        .card {
            border-radius: 10px;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .carousel-inner {
                height: 30rem;
                margin-left: 1rem;
            }

            .btn {
                margin-bottom: 1rem;
                font-size: 1.2rem;
            }
        }

        @media (min-width: 1024px) {
            .carousel-inner {
                height: 18rem;
                margin-left: 2rem;
            }
        }

        /* Estilo dos botões */
        .btn-primary,
        .btn-success {
            border-radius: 20px;
            padding: 5px 10px;
            font-size: 1rem;
        }

        /* Estilo dos cards */
        .card {
            background-color: #2b2b3d;
            color: #ffffff;
            border: none;
        }

        /* Estilo do gráfico */
        #recebimentos {
            background-color: #2b2b3d;
            border-radius: 10px;
        }

        /* Carrossel */
        .carousel-item {
            transition: transform 0.5s ease;
        }
    </style>
    <div class="card mt-5" style="background-color:#1e1e2f; color:#fff;">
        <div class="card-header mt-3 d-flex justify-content-between flex-column flex-sm-row">
            <div class="col-md-3">
                <h4>
                    <span class="span-title text-primary fw-bold">Resumo do Caixa</span>
                </h4>
            </div>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="d-flex justify-content-center">
                        <div class="col-lg-6 col-md-12 mb-3 w-100">
                            <div class="card dark text-light shadow" style="background-color:#1e1e2f;">
                                <div id="recebimentos" class="chart-container"></div>
                            </div>
                        </div>
                    </div>

                    <div class="container mt-5">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Botão de navegação anterior -->
                            <button class="carousel-control-prev " style="margin-bottom:8rem" type="button"
                                data-bs-target="#cardCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Anterior</span>
                            </button>

                            <!-- Carrossel -->
                            <div id="cardCarousel" class="carousel slide w-100" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach (array_chunk($formaDePagamento, 3) as $chunk)
                                        <!-- Exibe 3 cards por slide -->
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <div class="row justify-content-center">
                                                @foreach ($chunk as $forma)
                                                    <div class="col-lg-4 col-md-6 mb-3">
                                                        <div class="card text-light mb-3"
                                                            style="max-width: 18rem; background-color:{{ $forma->cor }};">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between p-4">
                                                                <div class="h3">{{ $forma->nome }}</div>
                                                                <i class="{{ $forma->icone }} fa-2xl"
                                                                    style="color: #fff;"></i>
                                                            </div>
                                                            <div class="card-body text-light">
                                                                <p class="card-text text-light h3">
                                                                    <strong>{{ 'R$ ' . $forma->valor }}</strong>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Botão de navegação próximo -->
                            <button class="carousel-control-next" style="margin-bottom:8rem"type="button"
                                data-bs-target="#cardCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Próximo</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                recebimentos();
            });

            function recebimentos() {
                var dados = <?php echo json_encode($vendas); ?>;
                var total = new Intl.NumberFormat('pt-BR', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(dados.total)
                var categories = Object.keys(dados); // Pega as chaves, como 'cartao', 'notas', etc.
                var data = categories.map(function(key) {
                    return {
                        name: key, // Nome do item (ex: 'cartao')
                        y: dados[key] // Valor referente ao item    
                    };
                });
                data = data.filter(item => item.name !== 'total');
                renderGraphic(data, total)
            }

            function renderGraphic(data, total) {

                Highcharts.chart('recebimentos', {
                    chart: {
                        type: 'pie',
                        backgroundColor: '#1e1e2f',
                        custom: {},
                        events: {
                            render() {
                                const chart = this,
                                    series = chart.series[0];
                                let customLabel = chart.options.chart.custom.label;

                                if (!customLabel) {
                                    customLabel = chart.options.chart.custom.label =
                                        chart.renderer.label(
                                            'Total<br/>' +
                                            'R$ ' +
                                            total
                                        )
                                        .css({
                                            color: '#ffffff',
                                            textAnchor: 'middle'
                                        })
                                        .add();
                                }

                                const x = series.center[0] + chart.plotLeft,
                                    y = series.center[1] + chart.plotTop -
                                    (customLabel.attr('height') / 2);

                                customLabel.attr({
                                    x,
                                    y
                                });

                                customLabel.css({
                                    fontSize: `${series.center[2] / 12}px`
                                });
                            }
                        }
                    },
                    title: {
                        text: 'Vendas',
                        style: {
                            color: '#ffffff'
                        }
                    },
                    subtitle: {
                        text: 'Vendas por categoria',
                        style: {
                            color: '#ffffff'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1e1e2f',
                        style: {
                            color: '#ffffff'
                        },
                        pointFormat: '{series.name}: <b>R$ {point.y:.2f}</b>'
                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        pie: {
                            innerSize: '75%',
                            dataLabels: {
                                enabled: false,
                                style: {
                                    color: '#ffffff',
                                    fontWeight: 'bold'
                                },
                                format: '<b>{point.name}</b>: {point.y:.2f}'
                            },
                            // Evento de clique nas fatias do gráfico
                            point: {
                                events: {
                                    click: function() {
                                        var categoria = this
                                            .name; // Nome da fatia (pode ser usado para redirecionamento)

                                        if (categoria === 'Combustivel') {
                                            window.location.href = '/caixa';
                                        } else if (categoria === 'Produtos') {
                                            window.location.href = '/monitor';
                                        }
                                    }
                                }
                            }
                        }
                    },
                    series: [{
                        name: 'Valor',
                        colorByPoint: true,
                        data: data
                    }],
                    credits: {
                        enabled: false
                    }
                });


            }
        </script>
    </div>
@endsection
