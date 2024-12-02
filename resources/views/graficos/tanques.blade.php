@extends('layouts.template')

@section('title')
    Tanques
@endsection

@section('conteudo')
    <style>
        .highcharts-background {
            fill: #1e1e2f !important;
        }

        .highcharts-title {
            fill: #ffffff !important;
            color: #ffffff !important;
        }

        .highcharts-axis-title {
            fill: #ffffff !important;
            color: #ffffff !important;
        }

        .highcharts-axis-line {
            stroke: #ffffff !important;
        }

        .highcharts-tick {
            stroke: #ffffff !important;
        }

        .highcharts-label {
            color: #ffffff !important;
        }

        .highcharts-yaxis .highcharts-axis-labels text {
            fill: #ffffff !important;
        }
    </style>

    <div class="container text-light" id="grafico"
        style="width: 800px; height: 800px; width: auto; text-align: center; padding: 40px 20px; align-items: center;">
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.highcharts.com/modules/cylinder.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", getDados);

        function getDados() {
            axios
                .get("/getData").then(function(response) {
                    let dados = response.data;
                    let processedData = treatDados(dados);
                    renderGraphic(processedData);
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        function treatDados(dados) {
            return dados.map(dado => {
                let color;
                dado.name = dado.dscprod;
                dado.cod = dado.dsctanque;
                dado.y = Math.abs(dado.estatualtanque).toFixed(0);
                dado.estado = Math.abs(dado.estatualtanque).toFixed(0);

                switch (dado.cod) {
                    case "TQ03-ALC":
                        dado.color = "rgba(0,255,63,1)";
                        break;
                    case "TQ02-GAS":
                        dado.color = "rgba(255,0,63,1)";
                        break;
                    case "TQ05-S10":
                        dado.color = "rgba(180,180,180,1)";
                        break;
                    case "TQ01-DIE":
                        dado.color = "rgba(0,120,63,1)";
                        break;
                    case "TQ04-GRID":
                        dado.color = "rgba(0, 205, 63, 1)";
                        break;
                    case "TQ07-ARLA":
                        dado.color = "rgba(0, 0, 255, 1)";
                        break;
                    case "TQ06-S10":
                        dado.color = "rgba(180, 180, 230, 1)";
                        break;
                }
                return {
                    name: dado.name,
                    y: dado.y,
                    color: dado.color,
                    estado: dado.estado
                };
            });
        }

        function formatNumber(number) {
            let numStr = number.toString();
            let [integerPart, decimalPart] = numStr.split('.');
            let formattedIntegerPart = parseInt(integerPart, 10).toLocaleString('pt-BR');
            return decimalPart ? `${formattedIntegerPart}.${decimalPart}` : formattedIntegerPart;
        }

        function renderGraphic(processedData) {
            Highcharts.chart('grafico', {
                chart: {
                    type: 'cylinder',
                    options3d: {
                        enabled: true,
                        alpha: 15,
                        beta: 15,
                        depth: 200,
                        viewDistance: 25
                    }
                },
                title: {
                    text: 'Nível dos Tanques',
                    style: {
                        color: '#ffffff'
                    }
                },
                xAxis: {
                    type: 'category',
                    title: {
                        text: 'Tanque',
                        style: {
                            color: '#ffffff'
                        }
                    },
                    labels: {
                        style: {
                            color: '#ffffff'
                        }
                    },
                    lineColor: '#ffffff',
                    tickColor: '#ffffff'
                },
                yAxis: {
                    title: {
                        text: 'Em Litros (L)',
                        style: {
                            color: '#ffffff'
                        }
                    },
                    labels: {
                        style: {
                            color: '#ffffff'
                        }
                    },
                    gridLineColor: '#505050'
                },
                tooltip: {
                    style: {
                        color: '#ffffff'
                    },
                    formatter: function() {
                        return '<b>' + this.point.name + '</b><br/>' +
                            'Nível: <b>' + this.point.y + '</b>L<br/>' +
                            'Estado Atual: <b>' + formatNumber(this.point.estado) + 'L</b>';
                    }
                },
                plotOptions: {
                    series: {
                        depth: 200,
                        colorByPoint: true,
                        dataLabels: {
                            enabled: true,
                            formatter: function() {
                                return formatNumber(this.point.estado) + ' L';
                            },
                            style: {
                                color: '#ffffff',
                                fontSize: '24px'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Níveis',
                    data: processedData.map(item => {
                        return {
                            name: item.name,
                            y: parseFloat(item.y),
                            color: item.color,
                            estado: item.estado
                        };
                    })
                }]
            });
        }
    </script>
@endsection
