<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/cylinder.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <title>Graficos</title>
</head>

<body>
    <div class="d-flex">
        <x-Sidebar>
            <div id="grafico" style="width: 800px; height: 800px"></div>
        </x-Sidebar>
    </div>

</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://code.highcharts.com/modules/cylinder.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", getDados);

    function getDados() {
        axios
            .get("/getData").then(function(response) {
                console.log(response.data)
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
            dado.cod = dado.dsctanque
            dado.y = Math.abs(dado.estatualtanque).toFixed(0);
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
                color: dado.color
            };
        });
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
                text: 'Nível dos Tanques'
            },
            xAxis: {
                type: 'category',
                title: {
                    text: 'Tanque'
                }
            },
            yAxis: {
                title: {
                    text: 'Em Litros (L)'
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>' + this.point.name + '</b><br/>' +
                        'Nível: <b>' + this.point.y.toLocaleString('pt-BR') + '</b>L';
                }
            },
            plotOptions: {
                series: {
                    depth: 200,
                    colorByPoint: true
                }
            },
            series: [{
                name: 'Níveis',
                data: processedData.map(item => {
                    return {
                        name: item.name,
                        y: parseFloat(item.y),
                        color: item.color
                    };
                })
            }]
        });
    }
</script>
