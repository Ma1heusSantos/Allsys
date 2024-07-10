@extends('layouts.auth')
<!---cor tela de inicio-->
@section("css")
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
                                <img src="{{ asset('img/login.png') }}" style="width: 100%" />
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
                                    <form method="POST" action="{{ route('autenticaUsuario') }}" id='cnpj'
                                        class="user">
                                        @csrf

                                        <div class="form-group" >
                                            <input type="text" class="form-control bg-dark text-white form-control-user cnpj" name="cnpj"
                                                placeholder="CNPJ" required > 
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control bg-dark form-control-user" name="email"
                                                placeholder="E-Mail" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control bg-dark form-control-user" name="password"
                                                placeholder="Digite sua Senha" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label"
                                                    for="remember">{{ __('Manter conectado') }}</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Entrar
                                            </button>
                                        </div>
                                        <hr>
                                    </form>
                                </div>
                            </div>
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
@endsection
