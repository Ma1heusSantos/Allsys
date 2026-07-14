@extends('layouts.template')

@section('titulo')
    Compras - {{ $grupo }}
@endsection

@section('conteudo')
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            color-scheme: dark;
            font-family: 'Roboto', sans-serif;
        }

        .details-header,
        .summary-card {
            background-color: #1f1f2f;
            border: 1px solid #252638;
            border-radius: 8px;
            color: #ffffff;
        }

        .details-header {
            margin-top: 2rem;
            padding: 1.5rem;
        }

        .page-title {
            color: #6f42c1;
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
        }

        .filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
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

        .filter-form button,
        .back-link {
            align-items: center;
            background-color: #6f42c1;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            display: inline-flex;
            font-size: 1rem;
            justify-content: center;
            min-height: 46px;
            padding: 0.75rem 1rem;
            text-decoration: none;
        }

        .back-link {
            background-color: #2a2a3b;
        }

        .cards-grid {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            margin-top: 2rem;
        }

        .summary-card {
            padding: 1.25rem;
        }

        .summary-card h5 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: center;
        }

        .summary-line {
            align-items: center;
            display: flex;
            gap: 1rem;
            justify-content: space-between;
            margin-bottom: 0.85rem;
        }

        .summary-line strong {
            color: #ffffff;
            font-size: 1rem;
        }

        .summary-line span:last-child {
            color: #e6e6ef;
            text-align: right;
        }

        .empty-state {
            background-color: #1f1f2f;
            border: 1px solid #252638;
            border-radius: 8px;
            color: #cfcfe1;
            margin-top: 2rem;
            padding: 2rem;
            text-align: center;
        }

        @media (max-width: 768px) {
            .details-header {
                margin-top: 1rem;
                padding: 1rem;
            }

            .page-title {
                font-size: 1.45rem;
                margin-bottom: 1rem;
                width: 100%;
            }

            .filter-form,
            .filter-form input,
            .filter-form button,
            .back-link {
                width: 100%;
            }

            .cards-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .summary-card {
                padding: 1rem;
            }

            .summary-line {
                align-items: flex-start;
                gap: 0.5rem;
            }

            .summary-line strong,
            .summary-line span:last-child {
                font-size: 0.95rem;
            }
        }
    </style>

    @php
        $formatMoney = function ($value) {
            return 'R$ ' . number_format((float) ($value ?? 0), 2, ',', '.');
        };

        $formatNumber = function ($value, $decimals = 3) {
            return number_format((float) ($value ?? 0), $decimals, ',', '.');
        };

        $totalGrupo = collect($compras)->sum(function ($item) {
            return (float) ($item->total ?? $item->valortotal ?? $item->valor ?? 0);
        });
    @endphp

    <div class="details-header">
        <div class="d-flex justify-content-between align-items-center flex-column flex-lg-row">
            <h4 class="page-title"><i class="fa-solid fa-chart-column"></i> {{ $grupo }}</h4>

            <form action="{{ route('compras.grupo', $codgrupo) }}" method="get" class="filter-form">
                <input type="hidden" name="grupo" value="{{ $grupo }}">
                <input name="dataIni" type="date" value="{{ $dataIni }}">
                <input name="dataFim" type="date" value="{{ $dataFim }}">
                <button type="submit">Enviar</button>
                <a class="back-link"
                    href="{{ route('dashboard.compras', ['dataIni' => $dataIni, 'dataFim' => $dataFim]) }}">Voltar</a>
            </form>
        </div>
    </div>

    @if (count($compras))
        <div class="details-header">
            <div class="summary-line mb-0">
                <strong>Total do grupo:</strong>
                <span>{{ $formatMoney($totalGrupo) }}</span>
            </div>
        </div>

        <div class="cards-grid">
            @foreach ($compras as $compra)
                @php
                    $nome = $compra->dscprod ?? $compra->dscproduto ?? $compra->descricao ?? $compra->nomeproduto ?? $compra->nome ?? 'Produto';
                    $quantidade = $compra->qtde ?? $compra->quantidade ?? 0;
                    $precoMedio = $compra->precomedio ?? $compra->preco_medio ?? 0;
                    $total = $compra->total ?? $compra->valortotal ?? $compra->valor ?? 0;
                @endphp

                <div class="summary-card">
                    <h5>{{ $nome }}</h5>

                    <div class="summary-line">
                        <strong>Quantidade:</strong>
                        <span>{{ $formatNumber($quantidade) }}</span>
                    </div>

                    <div class="summary-line">
                        <strong>Preco Medio:</strong>
                        <span>{{ $formatMoney($precoMedio) }}</span>
                    </div>

                    <div class="summary-line mb-0">
                        <strong>Total:</strong>
                        <span>{{ $formatMoney($total) }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            Nenhuma compra encontrada para {{ $grupo }} no periodo selecionado.
        </div>
    @endif
@endsection
