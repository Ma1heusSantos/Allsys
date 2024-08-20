@extends('layouts.template')

@section('titulo')
    Troca Preço
@endsection

@section('conteudo')
    <style>
        .custom-alert {
            background-color: transparent !important;
            border: 2px solid;
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
        }

        .alert-success.custom-alert {
            border-color: #28a745 !important;
            color: #28a745 !important;
        }

        .alert-danger.custom-alert {
            border-color: #dc3545 !important;
            color: #dc3545 !important;
        }
    </style>

    {{-- @if (session('success'))
        <div class="alert alert-success text-success text-center mt-4 custom-alert">
            {{ session('success') }}
        </div>
    @endif --}}

    @if ($errors->any())
        <div class="alert alert-danger text-danger text-center mt-4 custom-alert">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif


    <div class="card mt-5" style="background-color: #1e1e2f; color: #fff; border-radius: 10px;">
        <div class="card-header d-flex justify-content-between align-items-center"
            style="background-color: #27293d; border-bottom: 1px solid #444;">
            <h4 class="text-primary m-0">Troca de Preço</h4>
        </div>
        <div class="card-body">
            <div class="container mt-4">
                <div class="row">
                    @foreach ($dadosResponse as $dado)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow text-white text-center h-100"
                                style="background-color: #464555; border-radius: 10px;">
                                <div class="card-body d-flex flex-column">
                                    <h3 class="mb-3">{{ $dado->dscprod }}</h3>
                                    <p>À vista - R$ {{ $dado->avista }}</p>
                                    <p>À Prazo - R$ {{ $dado->aprazo }}</p>
                                    <p>Terminal - {{ $dado->terminal }}</p>
                                    <button type="button" class="btn btn-outline-light w-100 mt-auto"
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
@endsection
