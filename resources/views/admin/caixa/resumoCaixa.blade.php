@extends('layouts.template')
@section('conteudo')
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
                    <div class="row">
                        <div class="col-lg-6 col-md-12 mb-3">
                            <div class="card dark text-light" style="background-color:#1e1e2f;">
                                <div class="card-body d-flex justify-content-center align-items-center"
                                    style="height: 100%;">
                                    <div id="recebimentos" class="chart-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="card bg-success text-light mb-3" style="min-width: 12rem;">
                            <div class="d-flex align-items-center justify-content-between p-4">
                                <div class="h3">Valor total</div>
                                <i class="fa-solid fa-dollar-sign fa-2xl" style="color: #fff;"></i>
                            </div>
                            <div class="card-body text-light">
                                <p class="card-text text-light h3"><strong>R$ total de grana</strong></p>
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
                                <p class="card-text text-light h3"><strong>R$ total bruto</strong></p>
                            </div>
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
                var dados = <?php echo json_encode($recebimentos); ?>;
                var total = dados.total
                var categories = Object.keys(dados); // Pega as chaves, como 'cartao', 'notas', etc.
                var data = categories.map(function(key) {
                    return {
                        name: key, // Nome do item (ex: 'cartao')
                        y: parseFloat(dados[key]) // Valor correspondente (ex: 21186.88)
                    };
                });
                data = data.filter(item => item.name !== 'total');
                renderGraphic(data, total)
            }

            function renderGraphic(data, total) {

                Highcharts.chart('recebimentos', {
                    chart: {
                        type: 'pie',
                        backgroundColor: '#1e1e2f', // Cor do fundo do gráfico
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
                                            total // Valor total no centro
                                        )
                                        .css({
                                            color: '#ffffff', // Altere a cor do texto no centro para branco
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
                        text: 'Recebimentos',
                        style: {
                            color: '#ffffff' // Cor do texto do título
                        }
                    },
                    subtitle: {
                        text: 'Recebimentos',
                        style: {
                            color: '#ffffff' // Cor do texto do subtítulo
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1e1e2f', // Cor de fundo da tooltip
                        style: {
                            color: '#ffffff' // Cor do texto da tooltip
                        },
                        pointFormat: '{series.name}: <b>R$ {point.y:.2f}</b>'
                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        pie: {
                            innerSize: '75%', // Mesma proporção interna do segundo gráfico
                            dataLabels: {
                                enabled: false,
                                style: {
                                    color: '#ffffff', // Cor das labels
                                    fontWeight: 'bold'
                                },
                                format: '<b>{point.name}</b>: {point.y:.2f}'
                            }
                        }
                    },
                    series: [{
                        name: 'Valor',
                        colorByPoint: true,
                        data: data // Use o mesmo 'data' do primeiro gráfico
                    }],
                    credits: {
                        enabled: false // Desabilitar o logo do Highcharts
                    }
                });

            }
        </script>
    </div>
@endsection
