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
@endsection
