<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet"  href="{{ asset('css/pace-theme-minimal.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    @yield('style')

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}" />
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/apple-touch-icon-57x57.png') }}" />
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/apple-touch-icon-72x72.png') }}" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-touch-icon-76x76.png') }}" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/apple-touch-icon-114x114.png') }}" />
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/apple-touch-icon-120x120.png') }}" />
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/apple-touch-icon-152x152.png') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon-180x180.png') }}" />

    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.min.css">-->
	<link href="{{ asset('css/tagsinput.css') }}" rel="stylesheet" type="text/css">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    <style>
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        ::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: #b7c6f4;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
        }
        .td-campo-data {
            left: 0;
            position: sticky;
            z-index: 0;
            background-color: #fff
        }
        .td-data {
            z-index: -1;
        }
    </style>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script>
        $(document).ready(function ($) {
            var $seuCampoCpf = $(".cpf");
            $seuCampoCpf.mask('000.000.000-00', {reverse: true});
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function($){
            var $tel = $(".tel");
            $tel.mask("(99)99999-9999");
        });
    </script>

    <script>
        $(document).ready(function($){
            var $cnpj = $(".cnpj");
            $cnpj.mask("99.999.999/9999-99");
        });
    </script>
</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
            <!--div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Geniusis</div>-->
            <img src="{{ asset('img/LogoHBranco.png') }}" style="width: 100%" />
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Nav::isRoute('home') }}">

        </li>
        <li class="nav-item {{ Nav::isRoute('home') }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-chart-line"></i>
                <span>{{ __('Dashboard') }}</span>
            </a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            {{ __('Listas') }}
        </div>
        @if(Auth::user()->tipo != 'admin')
            <li class="nav-item {{ Nav::isRoute('profile') }}">
                <a class="nav-link" href="{{ route('empresa.show') }}">
                    <i class="fas fa-building"></i>
                    <span>Minha Empresa</span>
                </a>
            </li>
            <li class="nav-item {{ Nav::isRoute('profile') }}">
                <a class="nav-link" href="{{ route('produto.show') }}">
                    <i class="fab fa-product-hunt"></i>
                    <span>Produtos</span>
                </a>
            </li>
            <li class="nav-item {{ Nav::isRoute('profile') }}">
                <a class="nav-link" href="{{ route('vendas.painel') }}">
                    <i class="fas fa-dollar-sign"></i>
                    <span style="margin-left: 2%">Vendas</span>
                </a>
            </li>
            <li class="nav-item {{ Nav::isRoute('profile') }}">
                <a class="nav-link" href="{{ route('financeiro.despesas') }}">
                    <i class="fas fa-chart-line"></i>
                    <span style="margin-left: 2%">Financeiro</span>
                </a>
            </li>
            <li class="nav-item {{ Nav::isRoute('profile') }}">
                <a class="nav-link" href="{{ route('financeiro.contas') }}">
                    <i class="fas fa-chart-line"></i>
                    <span style="margin-left: 2%">Contas</span>
                </a>
            </li>
            <li class="nav-item {{ Nav::isRoute('profile') }}">
                <a class="nav-link" href="{{ route('abastecimento.painel') }}">
                    <i class="far fa-clock"></i>
                    <span style="margin-left: 2%">Abast. Por Hora</span>
                </a>
            </li>
            <li class="nav-item {{ Nav::isRoute('profile') }}">
                <a class="nav-link" href="{{ route('bico.status') }}">
                    <i class="fas fa-oil-can"></i>
                    <span style="margin-left: 2%">Status Bico</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" id="usuarios-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-oil-can"></i>
                    <span style="margin-left: 2%">Combustível</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="usuarios-drop">
                    <a class="dropdown-item" href="{{ route('preco.show') }}">Preços</a>
                    <a class="dropdown-item" href="{{ route('estoque.tanque.show') }}">Estoque</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" id="usuarios-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-users"></i>
                    <span style="margin-left: 2%">Usuários</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="usuarios-drop">
                    <a class="dropdown-item" href="#">Novo</a>
                    <a class="dropdown-item" href="{{ route('usuario.show') }}">Listar</a>
                </div>
            </li>
        @else
            <li class="nav-item {{ Nav::isRoute('profile') }}">
                <a class="nav-link" href="{{ route('admin.home') }}">
                    <i class="fas fa-user-alt"></i>
                    <span style="margin-left: 2%">Clientes</span>
                </a>
            </li>
            <li class="nav-item {{ Nav::isRoute('profile') }}">
                <a class="nav-link" href="{{ route('posto.show') }}">
                    <i class="fas fa-oil-can"></i>
                    <span style="margin-left: 2%">Postos</span>
                </a>
            </li>
            <li class="nav-item {{ Nav::isRoute('profile') }}">
                <a class="nav-link" href="{{ route('user.show') }}">
                    <i class="fas fa-users"></i>
                    <span style="margin-left: 2%">Usuários</span>
                </a>
            </li>
        @endif
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <!--form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>-->

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <!--a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                    <li class="nav-item dropdown no-arrow">
                        @if(Auth::user()->tipo != 'admin')
                            <a class="nav-link" href="" data-toggle="modal" data-target="#postos" style="color: blue">
                                <span>Meus postos</span>
                            </a>
                        @endif
                        <div class="modal fade" id="postos" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Selecione o Posto</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @php
                                            use App\Posto;
                                            use App\Cliente;

                                            $cliente =  Cliente::where('user_id', Auth::id())->get();

                                            if(count($cliente) > 0)
                                                $postos = $cliente[0]->postos;
                                        @endphp
                                        <div class="card card-body" style="width: 100%;">
                                            <ul class="list-group list-group-flush">
                                                @if(isset($postos) and Auth::user()->tipo != 'admin')
                                                    @foreach($postos as $posto)
                                                        <li class="list-group-item">
                                                            <a href="{{ route('define.posto', $posto->codigo) }}">{{ $posto->nome_fantasia }}</a>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <!-- Nav Item - User Information -->
                    <!--li class="nav-item dropdown no-arrow">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: gray">
                            <strong>Sair</strong>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>-->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                            <figure class="img-profile rounded-circle avatar font-weight-bold" data-initial="{{ Auth::user()->name[0] }}"></figure>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Perfil') }}
                            </a>
                            <!--a class="dropdown-item" href="javascript:void(0)">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Configurações') }}
                            </a>-->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Sair') }}
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                @include('flash::message')
                    @if(Auth::user()->tipo != 'admin')
                        <div class="alert border-info text-center">
                            <strong>{{ session('FANTASIA') ?? ''}}</strong>
                        </div>
                    @endif
                @yield('content')
            </div>
            <!-- /.container-fluid -->
        </div>
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Geniusis &copy; Desenvolvimento de Sistemas</span>
                    <br /><br />
                    <span>{{ date('Y') }}</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Deseja Sair?') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Clique em sair se estiver pronto para encerrar sua sessão.</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="http://localhost:35729/livereload.js"></script>
<script>
    function setIcon(nome_categoria)
    {
        idUp = 'iconUp'+nome_categoria;
        idDown = 'iconDown'+nome_categoria;

        if(document.getElementById(idDown).style.display == 'none') {
            document.getElementById(idUp).style.display = 'none';
            document.getElementById(idDown).style.display = 'block';
        } else {
            document.getElementById(idUp).style.display = 'block';
            document.getElementById(idDown).style.display = 'none';
        }
    }

    function activeMenu()
    {
        document.getElementById('accordionSidebar').classList.add('toggled');
    }

    var width = window.innerWidth
    var height = window.innerHeight

    if(width <= 400 && height <= 800){
        activeMenu();
    }
</script>
<script src="{{ asset('js/taginput.js') }}"></script>
<script src="{{ asset('js/pace.min.js') }}"></script>
@yield('script')
</body>
</html>
