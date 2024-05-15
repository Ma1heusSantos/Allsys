@extends('layouts.template')
@section('title')
    Listagem de usuários
@endsection
@section('conteudo')
    <div class="card mx-auto shadow" style="width: 85%">
        <h2 class="card-title p-3">
            Listagem Usuário
        </h2>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <hr>
                    <table class="table m-3">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Função</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <a href="{{ route('destroy.user', [$user->id]) }}">
                                            <i class="fa-regular fa-pen-to-square fa-xl p-3" style="color: #FFD43B;"></i>
                                        </a>
                                    </td>

                                    <td>
                                        <a href="{{ route('destroy.user', [$user->id]) }}"><i
                                                class="fa-solid fa-trash-can fa-xl " style="color: #f72626;"></i></a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
