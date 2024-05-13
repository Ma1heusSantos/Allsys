@extends('layouts.template')
@section('titulo')
    create user
@endsection
@section('conteudo')
    <div class="card mx-auto shadow" style="width: 85%">
        <h4 class="card-title p-3" >
            <span>Criar Usuário</span>
        </h4>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- {{ Form::model( Auth::user(), ['route' => 'user.update.profile', 'method' => 'POST']) }} --}}
                        <div class='row'>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Nome*</label>
                                    <div class="form-control">

                                    </div>
                                    {{-- {{ Form::label('name', 'Nome *') }}
                                    {{ Form::text('name', 'old'('name'), ['class' => 'form-control', 'required']) }} --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Email*</label>
                                    <div class="form-control">

                                    </div>
                                    {{-- {{ Form::label('email', 'E-mail *') }}
                                    {{ Form::email('email', 'old'('email'), ['class' => 'form-control', 'required']) }} --}}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button>salvar</button>
                                    {{-- {{ Form::submit('Salvar', ['class' => 'btn btn-success w-100']) }} --}}
                                </div>
                            </div>
                            {{-- {{ Form::close() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
