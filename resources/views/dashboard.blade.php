@extends('layouts.template')

@section('title')
    Dashboard
@endsection

@section('conteudo')

<div class="card">
    <div class="card-header mt-3 d-flex justify-content-between flex-column flex-sm-row">
        <div class="col-md-3">
            <h4>
                <span class="span-title text-primary">Dashboard</span>
            </h4>
        </div>
        <div class="form">
            <form action="#" method="post">
                @csrf
                <div class="d-flex flex-column flex-sm-row">
                    <div class="row g-3 align-items-center mx-1 ">
                        <div class="col-auto">
                            <label for="dataInicio" class="col-form-label">Data de inicio:
                            </label>
                        </div>
                        <div class="col-auto">
                            <input type="date" id="dataInicio" name="dataIni" class="form-control" aria-describedby="passwordHelpInline">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mx-1">
                        <div class="col-auto">
                            <label for="dataFim" class="col-form-label">Data de fim:</label>
                        </div>
                        <div class="col-auto d-flex">
                            <input type="date" id="dataFim" name="dataFim" class="form-control">
                            <button type="submit" id="btn-form" class="input-group-addon btn btn-primary" style="background-color: rgb(13, 110, 253); color: #fff; width: 3rem; height: 2.3rem; border-radius: 0px 5px 5px 0px !important; margin-right: 2%">
                                <i class="fas fa-search" style="color: #fff"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-around flex-wrap">
                    <div class="card text-bg-primary bg-primary text-light mb-3" style="min-width: 12rem; width: 32rem;">
                        <div class="d-flex align-items-center justify-content-between p-4">
                            <div class="h3">Total de vendas</div>
                            <i class="fa-regular fa-handshake fa-2xl" style="color: #fff;"></i>
                        </div>
                        <div class="card-body text-light">
                            <p class="card-text text-light h3"><strong>total de vendas</strong></p>
                        </div>
                    </div>

                    <div class="card text-bg-primary bg-success text-light mb-3" style="min-width: 12rem; width: 32rem;">
                        <div class="d-flex align-items-center justify-content-between p-4">
                            <div class="h3">Total de Entradas</div>
                            <i class="fa-solid fa-dollar-sign fa-2xl" style="color: #fff;"></i>
                        </div>
                        <div class="card-body text-light">
                            <p class="card-text text-light h3"><strong>Total de entradas</strong>
                            </p>
                        </div>
                    </div>

                    <div class="card text-bg-primary bg-danger text-light mb-3" style="min-width: 12rem; width: 32rem;">
                        <div class="d-flex align-items-center justify-content-between p-4">
                            <div class="h3">Total de Saídas</div>
                            <i class="fa-solid fa-hand-holding-dollar fa-2xl" style="color: #fff;"></i>
                        </div>
                        <div class="card-body text-light">
                            <p class="card-text text-light h3"><strong>total de saidas</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 d-flex justify-content-between align-items-center flex-wrap">
            <div class="col-lg-4 col-md-12 mb-3">
                <div style="max-width: 100%; height: auto;">
                    <div id="formaPagamento"></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 mb-3">
                <div style="max-width: 100%; height: auto;">
                    <div id="container"></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 mb-3">
                <div style="max-width: 100%; height: auto;">
                    <div id="vendasPorVendedores"></div>
                </div>
            </div>
        </div>

        <!-- <script>
            let dataFim = document.getElementById('dataFim');
            dataFim.addEventListener('change', function() {
                porcentagemPorFormaDePagamento();
                calculaPorcentagem();
                vendasPorVendedores();
            });

            document.addEventListener('DOMContentLoaded', function() {
                porcentagemPorFormaDePagamento()
                calculaPorcentagem()
                vendasPorVendedores()
            });

            function porcentagemPorFormaDePagamento() {
                let dataInicio = document.getElementById('dataInicio').value;
                let dataFim = document.getElementById('dataFim').value;

                axios.post('/admin/relatórios/dashboard-pagamento', {
                        dataInicio: dataInicio,
                        dataFim: dataFim
                    })
                    .then(function(response) {
                        var seriesData = [];
                        response.data.original.forEach(function(item) {
                            seriesData.push({
                                name: item.nome_forma_pagamento,
                                y: item.total
                            });
                        });
                        Highcharts.chart('formaPagamento', {
                            chart: {
                                type: 'pie'
                            },
                            title: {
                                text: 'Formas de Pagamento'
                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: {
                                        enabled: true,
                                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                    }
                                }
                            },
                            series: [{
                                name: 'Total',
                                colorByPoint: true,
                                data: seriesData
                            }]
                        });
                    })
                    .catch(function(error) {
                        console.error(error);
                    });
            }

            function vendasPorVendedores() {
                let dataInicio = document.getElementById('dataInicio').value;
                let dataFim = document.getElementById('dataFim').value;


                axios.post('/admin/relatórios/dashboard-vendedores', {
                        dataInicio: dataInicio,
                        dataFim: dataFim
                    })
                    .then(function(response) {
                        var seriesData = [];
                        response.data.original.forEach(function(item) {
                            seriesData.push({
                                name: item.nome_vendedor,
                                y: item.vendedor.vendas_count
                            });
                        });

                        Highcharts.chart('vendasPorVendedores', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Vendas por vendedor'
                            },
                            xAxis: {
                                type: 'category',
                                title: {
                                    text: 'Vendedor'
                                }
                            },
                            yAxis: {
                                title: {
                                    text: 'Total de Vendas'
                                }
                            },
                            series: [{
                                name: 'Total',
                                colorByPoint: true,
                                data: seriesData
                            }],
                            plotOptions: {
                                column: {
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y}'
                                    }
                                }
                            }
                        });
                    })
                    .catch(function(error) {
                        console.error(error);
                    });
            }

            function calculaPorcentagem() {
                let dataInicio = document.getElementById('dataInicio').value;
                let dataFim = document.getElementById('dataFim').value;

                axios.post('/admin/relatórios/dashboard-info', {
                        dataInicio: dataInicio,
                        dataFim: dataFim
                    })
                    .then(function(response) {
                        let entrada = response.data.totalDeEntradas
                        let saida = response.data.totalDeSaidas

                        var total = parseFloat(entrada) + parseFloat(saida)

                        entrada = (entrada / total) * 100
                        saida = (saida / total) * 100
                        graphicEntradas(entrada, saida)

                    }).catch(function(error) {
                        console.error(error);
                    });
            }

            function graphicEntradas(entrada, saida) {


                Highcharts.chart('container', {
                    colors: ['#28a745', '#dc3545'],
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie',

                    },
                    title: {
                        text: 'Relação entre Entradas e Saidas',
                        align: 'center'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: false
                            },
                            showInLegend: true
                        }
                    },
                    series: [{
                        name: 'Brands',
                        colorByPoint: true,
                        data: [{
                            name: 'Entradas',
                            y: entrada,
                            sliced: true,
                            selected: true
                        }, {
                            name: 'Saídas',
                            y: saida
                        }]
                    }]
                });
            }
        </script> -->

    </div>
    @endsection