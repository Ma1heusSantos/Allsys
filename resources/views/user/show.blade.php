@extends('layouts.template')

@section('title')
    Usuarios
@endsection

@section('conteudo')
    <style>
        /* Estilo para a tabela */
        .table-custom {
            width: 100%;
            border-collapse: collapse;
            background-color: #1e1e2f;
            color: #fff;
        }

        .table-custom th,
        .table-custom td {
            padding: 12px;
            border: 1px solid #2c2c3e;
        }

        .table-custom thead th {
            background-color: #1e1e2f;
            color: #fff;
        }

        .table-custom tbody tr {
            background-color: #1e1e2f;
        }

        .table-custom tbody tr:hover {
            background-color: #33334a;
        }

        .table-custom a {
            color: inherit;
            text-decoration: none;
        }

        .table-custom i {
            padding: 8px;
        }

        .table-custom .edit-icon {
            color: #FFD43B;
        }

        .table-custom .delete-icon {
            color: #f72626;
        }
    </style>
    <div class="card shadow-lg" style="background-color:#1e1e2f; color:#fff; border:none;">
        <div class="card-header mt-3 d-flex justify-content-between flex-column flex-sm-row">
            <div>
                <h4 class="text-primary fw-bold">Usuários</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="container mt-4">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Função</th>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->nivel }}</td>
                                        <td>
                                            <a href="{{ route('edit.user', [$user->id]) }}">
                                                <i class="fa-regular fa-pen-to-square fa-xl p-3 edit-icon"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('destroy.user', [$user->id]) }}">
                                                <i class="fa-solid fa-trash-can fa-xl delete-icon"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
