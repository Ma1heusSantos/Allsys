@extends('layouts.template')
@section('titulo')
    create user
@endsection
@section('conteudo')
    <div class="card mx-auto shadow" style="width: 85%">
        <h2 class="card-title p-3">
            Criar Usuário
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
                                <div class="col-md-6">
                                    <div class="form-group p-2">
                                        <label for="password">Senha</label>
                                        <input required name='password'class="form-control" type="password">
                                        <x-Input-error :messages="$errors->get('password')" class="mt-1" />

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group p-2">
                                        <label for="confirmePassword">Confirme sua senha:</label>
                                        <input required name="confirmePassword" class="form-control" type="password">
                                        <x-Input-error :messages="$errors->get('confirmePassword')" class="mt-1" />

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group p-3 pb-4">
                                        <label for="name">Tipo de Usuário</label>
                                        <select required name="role" class="form-select"
                                            aria-label="Default select example">
                                            <option selected>Selecione o tipo de usuário</option>
                                            <option value="User">User</option>
                                            <option value="Admin">Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-2">
                                        <button class="btn btn-primary w-100">Salvar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    @endsection
