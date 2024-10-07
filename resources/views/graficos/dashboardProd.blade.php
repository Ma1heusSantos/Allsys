@extends('layouts.template')

@section('title')
    Dashboard Produtos
@endsection

@section('conteudo')
    <div class="card mt-5" style="background-color:#1e1e2f; color:#fff;">
        <div class="card-header mt-3 d-flex justify-content-between flex-column flex-sm-row">
            <div class="col-md-3">
                <h4>
                    <span class="span-title text-primary fw-bold">Resumo de Produtos</span>
                </h4>
            </div>
            <div class="form">
                <form action="{{ route('dashboard.produto') }}" method="post">
                    @csrf
                    <div class="container">
                        <div class="d-flex flex-column flex-sm-row">
                            <div class="row g-3 align-items-center mx-1">
                                <div class="col-12 col-sm-auto">
                                    <label for="dataInicio" class="col-form-label text-light">Data de início:</label>
                                </div>
                                <div class="col-12 col-sm-auto">
                                    <input type="date" id="dataInicio" value="{{ $dataIni }}" name="dataIni"
                                        class="form-control bg-dark text-light">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mx-1">
                                <div class="col-12 col-sm-auto">
                                    <label for="dataFim" class="col-form-label text-light">Data de fim:</label>
                                </div>
                                <div class="col-12 col-sm-auto d-flex">
                                    <input type="date" id="dataFim" value="{{ $dataFim }}" name="dataFim"
                                        class="form-control bg-dark text-light">
                                    <button type="submit" id="btn-form" class="input-group-addon btn btn-primary"
                                        style="background-color: rgb(13, 110, 253); color: #fff; width: 3rem; height: 2.3rem; border-radius: 0px 5px 5px 0px !important; margin-right: 2%">
                                        <i class="fas fa-search" style="color: #fff"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="card bg-success text-light mb-3" style="min-width: 12rem;">
                            <div class="d-flex align-items-center justify-content-between p-4">
                                <div class="h3">Venda total</div>
                                <i class="fa-solid fa-dollar-sign fa-2xl" style="color: #fff;"></i>
                            </div>
                            <div class="card-body text-light">
                                <p class="card-text text-light h3"><strong>R$ {{ money($valorVenda) }}</strong></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="card bg-primary text-light mb-3" style="min-width: 12rem;">
                            <div class="d-flex align-items-center justify-content-between p-4">
                                <div class="h3">Total de Lucro Bruto</div>
                                <i class="fa-regular fa-handshake fa-2xl" style="color: #fff;"></i>
                            </div>
                            <div class="card-body text-light">
                                <p class="card-text text-light h3"><strong>R$ {{ money($totalbruto) }}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="card dark text-light" style="background-color:#1e1e2f;">
                            <div class="card-body">
                                <div id="valorTotalPorProduto" class="chart-container"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="card text-light" style="background-color:#1e1e2f;">
                            <div class="card-body">
                                <div id="lucroBrutoPorProduto" class="chart-container"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="card text-light" style="background-color:#1e1e2f;">
                            <div class="card-body">
                                <div id="vendasPorVendedores" class="chart-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                valorTotalPorProduto();
                totalPorFuncionario();
                lucroBrutoPorProduto();
            });

            function valorTotalPorProduto() {
                var dados = <?php echo $jsonDados; ?>;
                var categories = [];
                var data = [];
                let configs = [{
                    id: 'valorTotalPorProduto',
                    title: 'Venda total por Produto em (R$)',
                    yText: 'Venda total por Produto em (R$)',
                    seriesName: 'Venda total por produto em (R$)',
                    color: "#dc3545"
                }];

                dados.forEach(function(dado) {
                    categories.push(dado.dscprod);
                    data.push(parseFloat(dado.valorvenda.toFixed(2)));
                });
                renderGraphic(categories, data, configs[0]);
            }

            function lucroBrutoPorProduto() {
                var dados = <?php echo $jsonDados; ?>;
                var categories = [];
                var data = [];
                let configs = [{
                    id: 'lucroBrutoPorProduto',
                    title: 'Lucro bruto em Produto em (R$)',
                    yText: 'Lucro bruto por Produto em (R$)',
                    seriesName: 'Lucro bruto por Produto em (R$)',
                    color: '#007bff'
                }];

                dados.forEach(function(dado) {
                    categories.push(dado.dscprod);
                    data.push(parseFloat(dado.lucrobruto.toFixed(2)));
                });
                renderGraphic(categories, data, configs[0]);
            }

            function totalPorFuncionario() {
                var dados = <?php echo $jsonFuncionario; ?>;
                var categories = [];
                var data = [];
                let configs = [{
                    id: 'vendasPorVendedores',
                    title: 'Vendas por Frentista (Produto)',
                    yText: 'Vendas por Frentista (Produto)',
                    seriesName: 'total vendido (Produto)',
                    color: '#28a745'
                }];

                dados.forEach(function(dado) {
                    categories.push(dado.nomefunc);
                    data.push(parseFloat(dado.valortotal));
                });

                renderGraphic(categories, data, configs[0]);
            }

            function renderGraphic(categories, data, config) {
                Highcharts.setOptions({
                    chart: {
                        backgroundColor: '#1e1e2f',
                        style: {
                            fontFamily: '\'Unica One\', sans-serif'
                        },
                        plotBorderColor: '#606063'
                    },
                    title: {
                        style: {
                            color: '#E0E0E3',
                            textTransform: 'uppercase',
                            fontSize: '20px'
                        }
                    },
                    xAxis: {
                        gridLineColor: '#707073',
                        labels: {
                            style: {
                                color: '#E0E0E3'
                            }
                        },
                        lineColor: '#707073',
                        minorGridLineColor: '#505053',
                        tickColor: '#707073',
                        title: {
                            style: {
                                color: '#A0A0A3'

                            }
                        }
                    },
                    yAxis: {
                        gridLineColor: '#707073',
                        labels: {
                            style: {
                                color: '#E0E0E3'
                            }
                        },
                        lineColor: '#707073',
                        minorGridLineColor: '#505053',
                        tickColor: '#707073',
                        tickWidth: 1,
                        title: {
                            style: {
                                color: '#A0A0A3'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.85)',
                        style: {
                            color: '#F0F0F0'
                        }
                    },
                    plotOptions: {
                        series: {
                            dataLabels: {
                                color: '#B0B0B3'
                            },
                            marker: {
                                lineColor: '#333'
                            }
                        },
                        boxplot: {
                            fillColor: '#505053'
                        },
                        candlestick: {
                            lineColor: 'white'
                        },
                        errorbar: {
                            color: 'white'
                        }
                    },
                    legend: {
                        itemStyle: {
                            color: '#E0E0E3'
                        },
                        itemHoverStyle: {
                            color: '#FFF'
                        },
                        itemHiddenStyle: {
                            color: '#606063'
                        }
                    },
                    credits: {
                        style: {
                            color: '#666'
                        }
                    },
                    labels: {
                        style: {
                            color: '#707073'
                        }
                    },

                    navigation: {
                        buttonOptions: {
                            symbolStroke: '#DDDDDD',
                            theme: {
                                fill: '#505053'
                            }
                        }
                    },

                    rangeSelector: {
                        buttonTheme: {
                            fill: '#505053',
                            stroke: '#000000',
                            style: {
                                color: '#CCC'
                            },
                            states: {
                                hover: {
                                    fill: '#707073',
                                    stroke: '#000000',
                                    style: {
                                        color: 'white'
                                    }
                                },
                                select: {
                                    fill: '#000003',
                                    stroke: '#000000',
                                    style: {
                                        color: 'white'
                                    }
                                }
                            }
                        },
                        inputBoxBorderColor: '#505053',
                        inputStyle: {
                            backgroundColor: '#333',
                            color: 'silver'
                        },
                        labelStyle: {
                            color: 'silver'
                        }
                    },

                    navigator: {
                        handles: {
                            backgroundColor: '#666',
                            borderColor: '#AAA'
                        },
                        outlineColor: '#CCC',
                        maskFill: 'rgba(255,255,255,0.1)',
                        series: {
                            color: '#7798BF',
                            lineColor: '#A6C7ED'
                        },
                        xAxis: {
                            gridLineColor: '#505053'
                        }
                    },

                    scrollbar: {
                        barBackgroundColor: '#808083',
                        barBorderColor: '#808083',
                        buttonArrowColor: '#CCC',
                        buttonBackgroundColor: '#606063',
                        buttonBorderColor: '#606063',
                        rifleColor: '#FFF',
                        trackBackgroundColor: '#404043',
                        trackBorderColor: '#404043'
                    },

                    // special colors for some of the
                    legendBackgroundColor: 'rgba(0, 0, 0, 0.5)',
                    background2: '#505053',
                    dataLabelsColor: '#B0B0B3',
                    textColor: '#C0C0C0',
                    contrastTextColor: '#F0F0F3',
                    maskColor: 'rgba(255,255,255,0.3)'
                });

                Highcharts.chart(config.id, {
                    chart: {
                        type: 'column',
                        backgroundColor: '#1e1e2f'
                    },
                    title: {
                        text: config.title,
                        style: {
                            color: '#E0E0E3'
                        }
                    },
                    xAxis: {
                        categories: categories,
                        title: {
                            text: null
                        },
                        labels: {
                            style: {
                                color: '#E0E0E3'
                            }
                        },
                        gridLineColor: '#707073'
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: config.yText,
                            align: 'high',
                            style: {
                                color: '#A0A0A3'
                            }
                        },
                        labels: {
                            overflow: 'justify',
                            style: {
                                color: '#E0E0E3'
                            }
                        },
                        gridLineColor: '#707073'
                    },
                    tooltip: {
                        valueSuffix: ' R$',
                        backgroundColor: 'rgba(0, 0, 0, 0.85)',
                        style: {
                            color: '#F0F0F0'
                        }
                    },
                    plotOptions: {
                        column: {
                            dataLabels: {
                                enabled: true,
                                style: {
                                    color: '#B0B0B3'
                                }
                            }
                        }
                    },
                    series: [{
                        name: config.seriesName,
                        data: data,
                        color: config.color
                    }],
                    legend: {
                        itemStyle: {
                            color: '#E0E0E3'
                        },
                        itemHoverStyle: {
                            color: '#FFF'
                        },
                        itemHiddenStyle: {
                            color: '#606063'
                        }
                    },
                    credits: {
                        enabled: false
                    },
                });
            }
        </script>
    </div>
@endsection
