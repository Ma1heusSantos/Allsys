@extends('layouts.template')

@section('titulo', 'Débitos de clientes')

@section('conteudo')
    <style>
        body {
            background-color: #121212;
            color: #fff;
            color-scheme: dark;
            font-family: 'Roboto', sans-serif;
        }

        .debitos-panel,
        .debito-card {
            background-color: #1f1f2f;
            border: 1px solid #2b2c42;
            border-radius: 12px;
            color: #fff;
        }

        .debitos-panel {
            margin-top: 2rem;
            padding: 1.5rem;
        }

        .page-title {
            color: #6f42c1;
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
        }

        .search-form {
            display: grid;
            gap: .75rem;
            grid-template-columns: minmax(220px, 1fr) repeat(2, minmax(150px, auto)) auto auto;
            margin-top: 1.25rem;
        }

        .search-form input,
        .search-form button,
        .search-form a {
            border: 0;
            border-radius: 6px;
            min-height: 46px;
            padding: .7rem 1rem;
        }

        .search-form input {
            background-color: #2a2a3b;
            color: #fff;
        }

        .search-form input:focus {
            background-color: #343447;
            box-shadow: 0 0 0 2px #6f42c1;
            outline: 0;
        }

        .filter-button,
        .details-button {
            align-items: center;
            background-color: #6f42c1;
            color: #fff;
            display: inline-flex;
            justify-content: center;
            text-decoration: none;
        }

        .clear-button {
            align-items: center;
            background-color: #343447;
            color: #fff;
            display: inline-flex;
            justify-content: center;
            text-decoration: none;
        }

        .filter-button:hover,
        .details-button:hover,
        .clear-button:hover {
            color: #fff;
            filter: brightness(1.12);
        }

        .debitos-grid {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
            margin-top: 1.5rem;
        }

        .debitos-chart {
            background-color: #1f1f2f;
            border: 1px solid #2b2c42;
            border-radius: 12px;
            margin-top: 1.5rem;
            min-height: 420px;
            padding: 1rem;
            width: 100%;
        }

        .totais-grid {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            margin-top: 1.5rem;
        }

        .total-card {
            border-radius: 12px;
            color: #fff;
            min-height: 165px;
            overflow: hidden;
            padding: 1.4rem;
            position: relative;
        }

        .total-card.saldo-anterior { background: #3fa7d1; }
        .total-card.novos-debitos { background: #ca3146; }
        .total-card.recebimentos { background: #18c978; }
        .total-card.saldo-final { background: #6259c2; }

        .total-card-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin: 0;
            padding-right: 2.75rem;
        }

        .total-card-icon {
            font-size: 2rem;
            opacity: .9;
            position: absolute;
            right: 1.4rem;
            top: 1.4rem;
        }

        .total-card-value {
            bottom: 1.25rem;
            font-size: clamp(1.15rem, 1.5vw, 1.55rem);
            font-weight: 800;
            left: 1.4rem;
            letter-spacing: -.02em;
            line-height: 1.1;
            margin: 0;
            white-space: nowrap;
            position: absolute;
            right: 1.4rem;
        }

        .debito-card {
            display: flex;
            flex-direction: column;
            padding: 1.25rem;
        }

        .client-name {
            border-bottom: 1px solid #35364d;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1rem;
            overflow-wrap: anywhere;
            padding-bottom: .75rem;
        }

        .value-row {
            align-items: center;
            color: #cfcfe1;
            display: flex;
            gap: 1rem;
            justify-content: space-between;
            margin-bottom: .65rem;
        }

        .value-row strong {
            color: #fff;
            text-align: right;
        }

        .value-row.total {
            border-top: 1px solid #35364d;
            color: #fff;
            font-size: 1.05rem;
            margin-top: .25rem;
            padding-top: .8rem;
        }

        .value-row.total strong {
            color: #b995ff;
        }

        .details-button {
            margin-top: auto;
            min-height: 42px;
            padding: .65rem 1rem;
        }

        .empty-state {
            background: #1f1f2f;
            border: 1px solid #2b2c42;
            border-radius: 12px;
            color: #cfcfe1;
            grid-column: 1 / -1;
            padding: 2rem;
            text-align: center;
        }

        .pagination {
            flex-wrap: wrap;
        }

        .pagination .page-link {
            background-color: #2a2a3b;
            border-color: #343447;
            color: #fff;
        }

        .pagination .page-item.active .page-link,
        .pagination .page-link:hover {
            background-color: #6f42c1;
            border-color: #6f42c1;
            color: #fff;
        }

        @media (max-width: 991px) {
            .search-form {
                grid-template-columns: 1fr 1fr;
            }

            .search-form input[name="cliente"] {
                grid-column: 1 / -1;
            }

            .totais-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 576px) {
            .debitos-panel {
                margin-top: 1rem;
                padding: 1rem;
            }

            .page-title {
                font-size: 1.45rem;
            }

            .search-form {
                grid-template-columns: 1fr;
            }

            .search-form input[name="cliente"] {
                grid-column: auto;
            }

            .debitos-grid {
                grid-template-columns: 1fr;
            }

            .debitos-chart {
                min-height: 360px;
                padding: .5rem;
            }

            .totais-grid {
                grid-template-columns: 1fr;
            }

            .total-card {
                min-height: 145px;
            }
        }
    </style>

    <section class="debitos-panel">
        <h1 class="page-title"><i class="fa-solid fa-receipt"></i> Débitos de clientes</h1>

        <form action="{{ route('faturamento.debitos') }}" method="post" class="search-form">
            @csrf
            <input name="cliente" type="search" value="{{ $cliente ?? '' }}"
                placeholder="Pesquise por um cliente" aria-label="Pesquisar cliente">
            <input name="dataIni" type="date" value="{{ $dataIni }}" aria-label="Data inicial">
            <input name="dataFim" type="date" value="{{ $dataFim }}" aria-label="Data final">
            <button class="filter-button" type="submit"><i class="fa-solid fa-magnifying-glass me-2"></i>Pesquisar</button>
            <a class="clear-button" href="{{ route('faturamento.debitos') }}">Limpar filtro</a>
        </form>
    </section>

    <section aria-label="Resumo dos débitos">
        <div id="debitosTotais" class="debitos-chart"></div>

        <div class="totais-grid">
            <article class="total-card saldo-anterior">
                <h2 class="total-card-title">Saldo anterior</h2>
                <i class="fa-solid fa-clock-rotate-left total-card-icon" aria-hidden="true"></i>
                <p id="totalSaldoAnterior" class="total-card-value">R$ 0,00</p>
            </article>
            <article class="total-card novos-debitos">
                <h2 class="total-card-title">Novos débitos</h2>
                <i class="fa-solid fa-file-invoice-dollar total-card-icon" aria-hidden="true"></i>
                <p id="totalNovosDebitos" class="total-card-value">R$ 0,00</p>
            </article>
            <article class="total-card recebimentos">
                <h2 class="total-card-title">Recebimentos</h2>
                <i class="fa-solid fa-hand-holding-dollar total-card-icon" aria-hidden="true"></i>
                <p id="totalRecebimentos" class="total-card-value">R$ 0,00</p>
            </article>
            <article class="total-card saldo-final">
                <h2 class="total-card-title">Saldo final</h2>
                <i class="fa-solid fa-wallet total-card-icon" aria-hidden="true"></i>
                <p id="totalSaldoFinal" class="total-card-value">R$ 0,00</p>
            </article>
        </div>
    </section>

    <section class="debitos-grid" aria-live="polite">
        @forelse ($paginatedDebitos as $debito)
            <article class="debito-card">
                <h2 class="client-name">{{ $debito->nomecliente ?? 'Cliente sem nome' }}</h2>
                <div class="value-row"><span>Saldo anterior</span><strong>R$ {{ money($debito->saldoAnterior ?? 0) }}</strong></div>
                <div class="value-row"><span>Novos débitos</span><strong>R$ {{ money($debito->novosDebitos ?? 0) }}</strong></div>
                <div class="value-row"><span>Recebimentos</span><strong>R$ {{ money($debito->recebimentos ?? 0) }}</strong></div>
                <div class="value-row total"><span>Saldo final</span><strong>R$ {{ money($debito->saldoFinal ?? 0) }}</strong></div>
                <a class="details-button" href="{{ route('faturamento.cliente', [$debito->codcliente]) }}">Ver detalhes</a>
            </article>
        @empty
            <div class="empty-state">Nenhum débito encontrado para os filtros selecionados.</div>
        @endforelse
    </section>

    <div class="d-flex justify-content-center mt-4">
        {{ $paginatedDebitos->appends(request()->except('page', '_token'))->links() }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const resumo = @json($resumoDebitos);

            function numero(...campos) {
                for (const campo of campos) {
                    if (resumo && resumo[campo] !== undefined && resumo[campo] !== null) {
                        return Number(resumo[campo]) || 0;
                    }
                }
                return 0;
            }

            function moeda(valor) {
                return new Intl.NumberFormat('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                }).format(valor);
            }

            const totais = {
                saldoAnterior: numero('saldoAnterior', 'saldoanterior', 'saldo_anterior'),
                novosDebitos: numero('novosDebitos', 'novosdebitos', 'novos_debitos'),
                recebimentos: numero('recebimentos'),
                saldoFinal: numero('saldoFinal', 'saldofinal', 'saldo_final')
            };

            document.getElementById('totalSaldoAnterior').textContent = moeda(totais.saldoAnterior);
            document.getElementById('totalNovosDebitos').textContent = moeda(totais.novosDebitos);
            document.getElementById('totalRecebimentos').textContent = moeda(totais.recebimentos);
            document.getElementById('totalSaldoFinal').textContent = moeda(totais.saldoFinal);

            Highcharts.chart('debitosTotais', {
                chart: {
                    type: 'column',
                    backgroundColor: '#1f1f2f',
                    reflow: true
                },
                title: {
                    text: 'RESUMO DE DÉBITOS',
                    style: { color: '#fff', fontWeight: '700' }
                },
                xAxis: {
                    categories: ['Saldo anterior', 'Novos débitos', 'Recebimentos', 'Saldo final'],
                    labels: { style: { color: '#fff' } }
                },
                yAxis: {
                    title: { text: null },
                    labels: {
                        formatter: function() { return moeda(this.value); },
                        style: { color: '#fff' }
                    },
                    gridLineColor: '#444459'
                },
                legend: { enabled: false },
                tooltip: {
                    formatter: function() { return `<b>${this.key}</b><br>${moeda(this.y)}`; }
                },
                plotOptions: {
                    column: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            formatter: function() { return moeda(this.y); },
                            style: { color: '#fff', textOutline: 'none' }
                        }
                    }
                },
                series: [{
                    name: 'Total',
                    colorByPoint: true,
                    colors: ['#6f42c1', '#ca3146', '#2f9e78', '#b995ff'],
                    data: [
                        totais.saldoAnterior,
                        totais.novosDebitos,
                        totais.recebimentos,
                        totais.saldoFinal
                    ]
                }],
                responsive: {
                    rules: [{
                        condition: { maxWidth: 576 },
                        chartOptions: {
                            chart: { height: 360 },
                            xAxis: { labels: { rotation: -35 } },
                            plotOptions: { column: { dataLabels: { enabled: false } } }
                        }
                    }]
                },
                credits: { enabled: false }
            });
        });
    </script>
@endsection
