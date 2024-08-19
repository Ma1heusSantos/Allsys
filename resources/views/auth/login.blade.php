@extends('layouts.auth')
<!---cor tela de inicio-->
@section('css')
    <style>
        .bg-gradient-primary {
            background-color: #28361d !important;
            background-image: linear-gradient(180deg, #535361 10%, #222524 100%) !important;
            background-size: cover;
        }
    </style>
@endsection
<!---cor tela de inicio fim-->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="{{ asset('img/logovlt.svg') }}" style="width: 100%" />
                            </div>
                            <div class="col-md-6" style="color: #bab0b0">
                                <h1 class="text-center">Entrar</h1>
                                <div class="p-5">
                                    @if ($errors->any())
                                        <div class="alert alert-danger border-left-danger" role="alert">
                                            <ul class="pl-4 my-2">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="" role="alert">
                                        {{-- @include('flash::message') --}}
                                    </div>
                                    <form method="POST" id="form" action="{{ route('autenticaUsuario') }}">
                                        @csrf

                                        <div class="container">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-dark border-secondary"
                                                            id="basic-addon1">
                                                            <i class="fa-solid fa-building" style="color: #fff;"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text"
                                                        class="form-control text-white bg-dark p-4 border-secondary"
                                                        name="cnpj" placeholder="CNPJ" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="container">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-dark  border-secondary"
                                                            id="basic-addon1">
                                                            <i class="fa-solid fa-user" style="color: #fff;"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text"
                                                        class="form-control text-white bg-dark p-4  border-secondary"
                                                        name="email" placeholder="E-Mail" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="container">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-dark  border-secondary"
                                                            id="basic-addon1">
                                                            <i class="fa-solid fa-key" style="color: #fff;"></i>
                                                        </span>
                                                    </div>
                                                    <input type="password"
                                                        class="form-control text-white bg-dark p-4 border-secondary"
                                                        name="password" placeholder="Digite sua Senha" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group ml-4">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label"
                                                    for="remember">{{ __('Manter conectado') }}</label>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="form-group">
                                                <button id="btn" type="submit" class="btn btn-primary w-100"
                                                    onclick="disableButton()">Enviar</button>
                                            </div>
                                        </div>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 10%;">
                    <div class="col-md-12">
                        <h5 class="text-center text-white">Desenvolvido por Geniusis Sistemas</h5>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function disableButton() {
                let button = document.querySelector('#btn');
                button.disabled = true;
                document.getElementById('form').submit();
            }
        </script>
@endsection
