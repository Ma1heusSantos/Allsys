@extends('layouts.template')

@section('title')
    Empresa
@endsection

@section('conteudo')
    <div class="card mt-5">
        <div class="card-header" style="background-color: #29292e">
            <section>
                <div class="row px-4 pt-4">
                    <h1 class="text-lg text-indigo" style="font-weight: 500">
                        <span class="fw-bold text-primary">{{ $empresa->fantasiaposto ?? 'Não informado' }}</span>
                    </h1>
                </div>
            </section>
        </div>
        <div class="card-body" style="background-color: #29292e">
            <ul class="list-group list-group-horizontal-sn">
                <li class="list-group-item d-flex flex-row justify-content-around" style="background-color: #47444e;">
                    <div class="m-0">
                        <p class="text-white fw-bold d-inline mr-2" style="font-size: 14px;">Razão Social:</p>
                        <p class="d-inline text-white font-weight-normal" style="font-size: 11px;">
                            {{ $empresa->nomeposto ?? 'Não informado' }}</p>
                    </div>
                    <div class="m-auto">
                        <p class="text-white fw-bold d-inline mr-2" style="font-size: 14px;">CNPJ:</p>
                        <p class="d-inline text-white font-weight-normal" style="font-size: 11px;">
                            {{ $empresa->contabilidadeCnpj ?? 'Não informado' }}</p>
                    </div>
                </li>
                <li class="list-group-item" style="background-color: #47444e;">
                    <p class="text-white fw-bold d-inline mr-2" style="font-size: 14px;">Endereço:</p>
                    <p class="d-inline text-white font-weight-normal" style="font-size: 11px;">
                        {{ $empresa->endposto ?? 'Não informado' }}</p>
                </li>
                <li class="list-group-item d-flex flex-row justify-content-around" style="background-color: #47444e;">
                    <div class="m-0">
                        <p class="text-white fw-bold d-inline mr-2" style="font-size: 14px;">CEP:</p>
                        <p class="d-inline text-white font-weight-normal" style="font-size: 11px;">
                            {{ $empresa->cepposto ?? 'Não informado' }}</p>
                    </div>
                    <div class="m-auto">
                        <p class="text-white fw-bold d-inline mr-2" style="font-size: 14px;">E-mail:</p>
                        <p class="d-inline text-white font-weight-normal" style="font-size: 11px;">
                            {{ $empresa->emailposto ?? 'Não informado' }}</p>
                    </div>
                </li>
                <li class="list-group-item" style="background-color: #47444e;">
                    <p class="text-white fw-bold d-inline mr-2" style="font-size: 14px;">Inscrição Estadual:</p>
                    <p class="d-inline text-white font-weight-normal" style="font-size: 11px;">
                        {{ $empresa->ieposto ?? 'Não informado' }}</p>
                </li>
                <li class="list-group-item" style="background-color: #47444e;">
                    <p class="text-white fw-bold d-inline mr-2" style="font-size: 14px;">Responsável:</p>
                    <p class="d-inline text-white font-weight-normal" style="font-size: 11px;">
                        {{ $empresa->responsavel ?? 'Não informado' }}</p>
                </li>
                <li class="list-group-item" style="background-color: #47444e;">
                    <h2 class="text-white fw-bold d-inline mr-2" style="font-size: 14px;">Telefone:</h2>
                    <p class="d-inline text-white font-weight-normal" style="font-size: 11px;">
                        {{ $empresa->telposto ?? 'Não informado' }}</p>
                </li>
            </ul>
        </div>
    </div>
@endsection
