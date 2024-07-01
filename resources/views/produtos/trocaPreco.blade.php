@extends('layouts.template')
@section('titulo')
    Troca Preço
@endsection
@section('conteudo')
    @if (session('success'))
        <div class="alert alert-success text-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger text-danger text-center">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    <div class="card shadow">
        <div class="card-header mt-3 d-flex justify-content-between flex-column flex-sm-row">
            <div class="col-md-3">
                <h4>
                    <span class="span-title text-primary">Troca Preço</span>
                </h4>
            </div>
        </div>
        <div class="card-body">
            <div class="container mt-4">
                <div class="row">
                    <div class="container">
                        <div class="row" id="inputs-container">
                            @foreach ($dadosResponse as $dado)
                                <div class="col-md-4 mb-3 d-flex">
                                    <div class="card shadow text-center h-100 d-flex flex-column text-primary"
                                        style="width: 20rem; background-color: #ccc; background-size: cover;">
                                        <div class="card-body d-flex flex-column">
                                            <h3>{{ $dado->dscprod }}</h3>
                                            <p>A Vista - R$ {{ $dado->avista }}</p>
                                            <p>A Prazo - R$ {{ $dado->aprazo }}</p>
                                            <button type="button" class="btn btn-primary w-100 mt-auto"
                                                data-bs-toggle="modal" data-bs-target="#editPreco-{{ $loop->index }}">
                                                Trocar Preço
                                            </button>
                                            <x-Modal-edit-preco :dado="$dado" :index="$loop->index" />
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
