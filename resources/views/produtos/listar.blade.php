@extends('layouts.template')
@section('titulo')
LIstagem de Produtos
@endsection

@section('conteudo')

<div class="card mx-auto shadow w-100 p-0">
    <h2 class="card-title p-3 text-primary">
        Produtos
    </h2>
    <div class="card-body">
        <div class="table-responsive">
            @isset($produtos)
            <table id="table">
                <thead>
                    <tr>
                        <th class="col-1">Cód.do prod</th>
                        <th style="width: 40%">Produto</th>
                        <th class="text-center">Valor de compra</th>
                        <th class="text-center">Valor de venda</th>
                        <th class="text-center">ultima data de venda</th>
                        <th class="text-center">ultima data de venda</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $produto)
                    <tr>
                        <td class="text-center">{{ $produto->codprod }}</td>
                        <td>{{ $produto->dscprod }}</td>
                        <td class="text-center">R$ {{ money($produto->valorcompraprod)}}</td>
                        <td class="text-center">R$ {{ money($produto->valorvendaprod)}}</td>
                        <td class="text-center">{{ formatDate($produto->dataultcompraprod)}}</td>
                        <td class="text-center">{{ formatDate($produto->dataultvendaprod) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>Nenhum produto encontrado!</p>
            @endisset
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let table = new DataTable('#table');
</script>
@endsection