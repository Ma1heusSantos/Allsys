@extends('layouts.template')
@section('title')
    Empresa
@endsection
@section('conteudo')
    <div class="card">
        <div class="card-header">
            <section>
                <div class="row px-4 pt-4">
                    <h1 class="text-lg text-indigo" style="font-weight: 500">
                        <span class="fw-bold text-primary">{{ $empresa->fantasiaposto }}</span>
                    </h1>
                </div>
                <div class="row d-flex justify-content-between">
                    <div class="col-md-8 d-flex justify-content-between">
                        <p class="text-indigo font-weight-normal px-4 fs-6">Nome da empresa: {{ $empresa->nomeposto }}
                        </p>
                        <p class="text-indigo font-weight-normal ml-2">
                            CNPJ: <span class="text-dark font-weight-normal">{{ $empresa->contabilidadeCnpj }}</span>
                        </p>
                    </div>
                </div>
            </section>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h2 class="text-dark font-weight-bold d-inline mr-2" style="font-size: 20px">Endereço: </h2>
                    <p class="d-inline text-dark font-weight-normal">{{ $empresa->endposto }}</p>
                </li>
                <li class="list-group-item d-flex flex-row justify-content-around">
                    <div class="m-0">
                        <h2 class="text-dark font-weight-bold d-inline mr-2" style="font-size: 20px">CEP: </h2>
                        <p class="d-inline text-dark font-weight-normal">{{ $empresa->cepposto }}</p>
                    </div>
                    <div class="m-auto">
                        <h2 class="text-dark font-weight-bold d-inline mr-2" style="font-size: 20px">E-mail: </h2>
                        <p class="d-inline text-dark font-weight-normal">{{ $empresa->emailposto }}</p>
                    </div>
                </li>
                <li class="list-group-item">
                    <h2 class="text-dark font-weight-bold d-inline mr-2" style="font-size: 20px">Inscrição Estadual </h2>
                    <p class="d-inline text-dark font-weight-normal">{{ $empresa->ieposto }}</p>
                </li>
                <li class="list-group-item">
                    <h2 class="text-dark font-weight-bold d-inline mr-2" style="font-size: 20px">Responsavel: </h2>
                    <p class="d-inline text-dark font-weight-normal">{{ $empresa->responsavel }}</p>
                </li>
                <li class="list-group-item">
                    <h2 class="text-dark font-weight-bold d-inline mr-2" style="font-size: 20px">Telefone: </h2>
                    <p class="d-inline text-dark font-weight-normal">{{ $empresa->telposto }}</p>
                </li>
            </ul>
        </div>
    </div>
@endsection
