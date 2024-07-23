@extends('layouts.template')
@section('title')
    Empresa
@endsection
@section('conteudo')
    <div class="card shadow">
        <div class="card-header" style="background-color: #29292e">
            <section>
                <div class="row px-4 pt-4">
                    <h1 class="text-lg text-indigo" style="font-weight: 500">
                        <span class="fw-bold text-primary">{{ $empresa->fantasiaposto ?? 'não informado' }}</span>
                    </h1>
                </div>
            </section>
        </div>
        <div class="card-body" style="background-color: #29292e">
            <ul class="list-group llist-group-horizontal-sn">
                <li class="list-group-item d-flex flex-row justify-content-around " style="background-color:#47444E;">
                    <div class="m-0">
                        <p class="text-white fw-bold d-inline mr-2" style="font-size:14px">Razao Social: </p>
                        <p class="d-inline text-white font-weight-normal" style="font-size:11px">
                            {{ $empresa->nomeposto ?? 'não informado' }}</p>
                    </div>
                    <div class="m-auto">
                        <p class="text-white fw-bold d-inline mr-2" style="font-size: 14px">Cnpj: </p>
                        <p class="d-inline text-white font-weight-normal"style="font-size:11px">
                            {{ $empresa->contabilidadeCnpj ?? 'não informado' }}</p>
                    </div>
                </li>
                <li class="list-group-item" style="background-color:#47444E;">
                    <p class="text-white fw-bold   d-inline mr-2" style="font-size:14px">Endereço: </p>
                    <p class="d-inline text-white font-weight-normal" style="font-size:11px">
                        {{ $empresa->endposto ?? 'não informado' }}</p>
                </li>
                <li class="list-group-item d-flex flex-row justify-content-around" style="background-color:#47444E;">
                    <div class="m-0">
                        <p class="text-white fw-bold   d-inline mr-2" style="font-size: 14px">Cep: </p>
                        <p class="d-inline text-white font-weight-normal" style="font-size:11px">
                            {{ $empresa->cepposto ?? 'não informado' }}</p>
                    </div>
                    <div class="m-auto" style="background-color:#47444E;">
                        <p class="text-white fw-bold   d-inline mr-2" style="font-size: 14px">E-mail: </p>
                        <p class="d-inline text-white font-weight-normal"style="font-size:11px">
                            {{ $empresa->emailposto ?? 'não informado' }}</p>
                    </div>
                </li>
                <li class="list-group-item" style="background-color:#47444E;">
                    <p class="text-white fw-bold   d-inline mr-2" style="font-size: 14px">Inscrição Estadual </p>
                    <p class="d-inline text-white font-weight-normal"style="font-size:11px">
                        {{ $empresa->ieposto ?? 'não informado' }}</p>
                </li>
                <li class="list-group-item" style="background-color:#47444E;">
                    <p class="text-white fw-bold   d-inline mr-2" style="font-size: 14px">Responsavel: </p>
                    <p class="d-inline text-white font-weight-normal"style="font-size:11px">
                        {{ $empresa->responsavel ?? 'não informado' }}</p>
                </li>
                <li class="list-group-item" style="background-color:#47444E;">
                    <h2 class="text-white fw-bold   d-inline mr-2" style="font-size: 14px">Telefone: </h2>
                    <p class="d-inline text-white font-weight-normal"style="font-size:11px">
                        {{ $empresa->telposto ?? 'não informado' }}</p>
                </li>
            </ul>
        </div>
    </div>
@endsection
