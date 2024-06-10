@extends('layouts.template')

@section('title')
    Dashboard
@endsection

@section('conteudo')

<div class="card shadow">
    <div class="card-header mt-3 d-flex justify-content-between flex-column flex-sm-row">
        <div class="col-md-3">
            <h4>
                <span class="span-title text-primary">Dashboard</span>
            </h4>
        </div>
       
        
    </div>
    <div class="card-body">
        <div class="container mt-4">
            <div class="row">
                   <div class="col-lg-6 col-md-12 mb-3">
                    <div class="card text-bg-primary bg-success text-light mb-3" style="min-width: 12rem;">
                        <div class="d-flex align-items-center justify-content-between p-4">
                            <div class="h3">Valor total</div>
                            <i class="fa-solid fa-dollar-sign fa-2xl" style="color: #fff;"></i>
                        </div>
                        <div class="card-body text-light">
                            <p class="card-text text-light h3"><strong>R$ {{money($valorAbastecido)}}</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 mb-3">
                    <div class="card text-bg-primary bg-primary text-light mb-3" style="min-width: 12rem;">
                        <div class="d-flex align-items-center justify-content-between p-4">
                            <div class="h3">Total de Lucro Bruto</div>
                            <i class="fa-regular fa-handshake fa-2xl" style="color: #fff;"></i>
                        </div>
                        <div class="card-body text-light">
                            <p class="card-text text-light h3"><strong>R$ {{money($totalbruto)}}</strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-4 col-md-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div id="valorTotalPorProduto" class="chart-container"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div id="lucroBrutoPorProduto" class="chart-container"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 mb-3">
                    <div class="card">
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

           function valorTotalPorProduto(){
            var dados = <?php echo $jsonDados; ?>;
            var categories = [];
            var data = [];
            let configs = [
                {
                    id: 'valorTotalPorProduto',
                    title:'Valor total por Produto em (R$)',
                    yText: 'valor total por produto em (R$)',
                    seriesName: 'valor total por produto em (R$)',
                    color: "#dc3545"
                }
            ];

            dados.forEach(function(dado) {
                categories.push(dado.dscprod);
                data.push(parseFloat(dado.valorbruto.toFixed(2)));
            });
            renderGraphic(categories,data,configs[0]);
           }

           function lucroBrutoPorProduto(){
            var dados = <?php echo $jsonDados; ?>;
            var categories = [];
            var data = [];
            let configs = [
                {
                    id: 'lucroBrutoPorProduto',
                    title:'Lucro bruto por Produto em (R$)',
                    yText: 'Lucro bruto por Produto em (R$)',
                    seriesName: 'Lucro bruto por Produto em (R$)',
                    color: '#007bff'
                }
            ];

            dados.forEach(function(dado) {
                categories.push(dado.dscprod);
                data.push(parseFloat(dado.lucrobruto.toFixed(2)));
            });
            renderGraphic(categories,data,configs[0]);
           }
           
           function totalPorFuncionario(){
            var dados = <?php echo $jsonFuncionario; ?>;
            var categories = [];
            var data = [];
            let configs = [
                {
                    id: 'vendasPorVendedores',
                    title:'Vendas por Frentista',
                    yText: 'Vendas por Frentista',
                    seriesName: 'total vendido',
                    color: '#28a745'
                }
            ];

            dados.forEach(function(dado) {
                categories.push(dado.nomefunc);
                data.push(parseFloat(dado.valortotal));
            });
            
            renderGraphic(categories,data,configs[0]);
           }

           function renderGraphic(categories, data, config){
            console.log(config.id,config.yText,config.title,config.seriesName)
            Highcharts.chart(config.id, {
                chart: {
                    type: 'column'
                },
                title: {
                    text: config.title
                },
                xAxis: {
                    categories: categories,
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: config.yText,
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    }
                },
                plotOptions: {
                    column: {
                        color: config.color, 
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                series: [{
                    name: config.seriesName,
                    data: data
                }]
            }); 
}

        </script>
    </div>
    @endsection