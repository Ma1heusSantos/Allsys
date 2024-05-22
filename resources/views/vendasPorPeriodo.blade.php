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
                        <form action="{{ route('getVendasDia') }}" method="post">
                            @csrf
                            <div class='row d-flex align-items-center'>
                                <div class="col-md-3">
                                    <div class="form-group p-2">
                                        <label for="dataini">Data de inicio</label>
                                        <input required name="dataini" class="form-control" type="date">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group p-2">
                                        <label for="datafim">Data de Fim</label>
                                        <input required name="datafim" class="form-control" type="date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group p-2 mt-4">
                                        <button class="w-50 btn btn-primary">Enviar</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    @endsection
