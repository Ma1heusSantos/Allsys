@extends('layouts.template')
@section('titulo')
    data period
@endsection
@section('conteudo')

<div class="card mx-auto shadow" style="width: 65%;">
    <h2 class="card-title p-3">
        Relatório por período
    </h2>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <form action="{{ route('store.user') }}" method="post">
                        @csrf
                        <div class='row'>
                            <div class="col-md-6">
                                <div class="form-group p-2">
                                    <label for="name">Nome</label>
                                    <input required name="name" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group p-2">
                                    <label for="name">Email</label>
                                    <input required name="email" class="form-control" type="email">
                                    <x-Input-error :messages="$errors->get('email')" class="mt-1" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
