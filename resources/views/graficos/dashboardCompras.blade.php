@extends('layouts.template')
@section('titulo')
    Compras
@endsection

@section('conteudo')
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            color-scheme: dark;
            font-family: 'Roboto', sans-serif;
        }

        .dashboard-card {
            background-color: #1f1f2f;
            border: 1px solid #252638;
            border-radius: 8px;
            color: #ffffff;
            margin-top: 2rem;
            padding: 1.5rem;
        }

        .chart-container {
            min-height: 420px;
        }

        .filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 1rem;
        }

        .filter-form input {
            background-color: #2a2a3b;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            color-scheme: dark;
            font-size: 1rem;
            padding: 0.75rem 1rem;
        }

        .filter-form input[type="date"]::-webkit-calendar-picker-indicator {
            cursor: pointer;
            filter: invert(1);
            opacity: 0.8;
        }

        .filter-form button {
            background-color: #6f42c1;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            cursor: pointer;
            font-size: 1rem;
            padding: 0.75rem 1rem;
        }

        .page-title {
            color: #6f42c1;
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
        }

        .empty-state {
            color: #cfcfe1;
            padding: 2rem;
            text-align: center;
        }
    </style>

    <div class="dashboard-card">
        <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row">
            <h4 class="page-title"><i class="fa-solid fa-chart-column"></i> Compras</h4>
            <form action="{{ route('dashboard.compras') }}" method="post" class="filter-form">
                @csrf
                <input name="dataIni" type="date" value="{{ $dataIni }}">
                <input name="dataFim" type="date" value="{{ $dataFim }}">
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>

    <div class="dashboard-card">
        <div id="comprasPorGrupo" class="chart-container"></div>
    </div>

    <div class="dashboard-card" id="detalheGrupoCard" style="display: none;">
        <div id="comprasPorProduto" class="chart-container"></div>
    </div>

    <script>
        const compras = @json($compras);
        const dataIni = @json($dataIni);
        const dataFim = @json($dataFim);

        function moeda(valor) {
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(Number(valor || 0));
        }

        function nomeProduto(item) {
            return item.dscproduto || item.descricao || item.nomeproduto || item.nome || item.dscgrupo ||
                `Codigo ${item.codprod || item.codproduto || item.codgrupo || ''}`;
        }

        function valorTotal(item) {
            return Number(item.total || item.valortotal || item.valor || 0);
        }

        function renderEmpty(containerId, text) {
            document.getElementById(containerId).innerHTML = `<div class="empty-state">${text}</div>`;
        }

        function renderGrupoChart() {
            if (!compras.length) {
                renderEmpty('comprasPorGrupo', 'Nenhuma compra encontrada para o periodo selecionado.');
                return;
            }

            Highcharts.chart('comprasPorGrupo', {
                chart: {
                    type: 'column',
                    backgroundColor: '#1f1f2f'
                },
                title: {
                    text: 'COMPRA TOTAL POR GRUPO',
                    style: {
                        color: '#ffffff',
                        fontWeight: '700'
                    }
                },
                xAxis: {
                    categories: compras.map(item => item.dscgrupo),
                    labels: {
                        style: {
                            color: '#ffffff'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Compra total por grupo',
                        style: {
                            color: '#cfcfe1'
                        }
                    },
                    labels: {
                        formatter: function() {
                            return moeda(this.value);
                        },
                        style: {
                            color: '#ffffff'
                        }
                    },
                    gridLineColor: '#444459'
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    backgroundColor: '#2a2a3b',
                    borderColor: '#6f42c1',
                    style: {
                        color: '#ffffff'
                    },
                    formatter: function() {
                        const item = compras[this.point.index];
                        return `<b>${item.dscgrupo}</b><br>Total: ${moeda(item.total)}<br>Quantidade: ${item.qtde || 0}<br>Preco medio: ${moeda(item.precomedio)}`;
                    }
                },
                plotOptions: {
                    column: {
                        cursor: 'pointer',
                        color: '#ca3146',
                        borderColor: '#f06b7b',
                        dataLabels: {
                            enabled: true,
                            formatter: function() {
                                return moeda(this.y);
                            },
                            style: {
                                color: '#ffffff',
                                textOutline: 'none'
                            }
                        },
                        point: {
                            events: {
                                click: function() {
                                    carregarGrupo(compras[this.index]);
                                }
                            }
                        }
                    }
                },
                series: [{
                    name: 'Compras',
                    data: compras.map(item => ({
                        y: valorTotal(item),
                        codgrupo: item.codgrupo
                    }))
                }],
                credits: {
                    enabled: false
                }
            });
        }

        async function carregarGrupo(grupo) {
            const card = document.getElementById('detalheGrupoCard');
            card.style.display = 'block';
            renderEmpty('comprasPorProduto', `Carregando ${grupo.dscgrupo}...`);

            try {
                const params = new URLSearchParams({
                    dataIni,
                    dataFim
                });
                const response = await fetch(`/comprasGrupo/${grupo.codgrupo}?${params.toString()}`);

                if (!response.ok) {
                    throw new Error('Erro ao buscar compras do grupo.');
                }

                const produtos = await response.json();
                renderProdutoChart(grupo, Array.isArray(produtos) ? produtos : []);
            } catch (error) {
                renderEmpty('comprasPorProduto', error.message);
            }
        }

        function renderProdutoChart(grupo, produtos) {
            if (!produtos.length) {
                renderEmpty('comprasPorProduto', `Nenhuma compra encontrada para ${grupo.dscgrupo}.`);
                return;
            }

            Highcharts.chart('comprasPorProduto', {
                chart: {
                    type: 'column',
                    backgroundColor: '#1f1f2f'
                },
                title: {
                    text: `COMPRA TOTAL - ${grupo.dscgrupo}`,
                    style: {
                        color: '#ffffff',
                        fontWeight: '700'
                    }
                },
                xAxis: {
                    categories: produtos.map(nomeProduto),
                    labels: {
                        style: {
                            color: '#ffffff'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Compra total por produto',
                        style: {
                            color: '#cfcfe1'
                        }
                    },
                    labels: {
                        formatter: function() {
                            return moeda(this.value);
                        },
                        style: {
                            color: '#ffffff'
                        }
                    },
                    gridLineColor: '#444459'
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    backgroundColor: '#2a2a3b',
                    borderColor: '#6f42c1',
                    style: {
                        color: '#ffffff'
                    },
                    formatter: function() {
                        const item = produtos[this.point.index];
                        return `<b>${nomeProduto(item)}</b><br>Total: ${moeda(valorTotal(item))}<br>Quantidade: ${item.qtde || 0}<br>Preco medio: ${moeda(item.precomedio)}`;
                    }
                },
                plotOptions: {
                    column: {
                        color: '#ca3146',
                        borderColor: '#f06b7b',
                        dataLabels: {
                            enabled: true,
                            formatter: function() {
                                return moeda(this.y);
                            },
                            style: {
                                color: '#ffffff',
                                textOutline: 'none'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Compras',
                    data: produtos.map(valorTotal)
                }],
                credits: {
                    enabled: false
                }
            });
        }

        document.addEventListener('DOMContentLoaded', renderGrupoChart);
    </script>
@endsection
