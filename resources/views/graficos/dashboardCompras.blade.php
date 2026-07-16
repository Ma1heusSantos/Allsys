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
            width: 100%;
        }

        .chart-card {
            min-width: 0;
            overflow: hidden;
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

        @media (max-width: 576px) {
            .dashboard-card {
                margin-top: 1rem;
                padding: 1rem;
            }

            .chart-container {
                min-height: 360px;
                min-width: 0;
            }

            .filter-form,
            .filter-form input,
            .filter-form button {
                width: 100%;
            }

            .page-title {
                font-size: 1.5rem;
                margin-bottom: 0.75rem;
                width: 100%;
            }
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

    <div class="dashboard-card chart-card">
        <div id="comprasPorGrupo" class="chart-container"></div>
    </div>

    <script>
        const compras = @json($compras);
        const dataIni = @json($dataIni);
        const dataFim = @json($dataFim);
        const comprasGrupoUrl = @json(route('compras.grupo', ['codgrupo' => '__CODGRUPO__']));

        function moeda(valor) {
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(Number(valor || 0));
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
                    backgroundColor: '#1f1f2f',
                    reflow: true,
                    spacing: [10, 8, 15, 8]
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
                        autoRotation: [-45, -90],
                        overflow: 'justify',
                        style: {
                            color: '#ffffff',
                            fontSize: '11px'
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
                                    abrirGrupo(this.options.custom);
                                }
                            }
                        }
                    }
                },
                series: [{
                    name: 'Compras',
                    data: compras.map(item => ({
                        y: valorTotal(item),
                        name: item.dscgrupo,
                        custom: item
                    }))
                }],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 576
                        },
                        chartOptions: {
                            chart: {
                                height: 390
                            },
                            title: {
                                style: {
                                    fontSize: '15px'
                                }
                            },
                            yAxis: {
                                title: {
                                    text: null
                                },
                                labels: {
                                    style: {
                                        fontSize: '10px'
                                    }
                                }
                            },
                            plotOptions: {
                                column: {
                                    dataLabels: {
                                        enabled: false
                                    }
                                }
                            }
                        }
                    }]
                },
                credits: {
                    enabled: false
                }
            });
        }

        function abrirGrupo(grupo) {
            if (!grupo || grupo.codgrupo === undefined || grupo.codgrupo === null) {
                return;
            }

            const params = new URLSearchParams({
                dataIni,
                dataFim,
                grupo: grupo.dscgrupo || `Grupo ${grupo.codgrupo}`
            });
            const url = comprasGrupoUrl.replace('__CODGRUPO__', encodeURIComponent(grupo.codgrupo));
            window.location.assign(`${url}?${params.toString()}`);
        }

        document.addEventListener('DOMContentLoaded', renderGrupoChart);
    </script>
@endsection
