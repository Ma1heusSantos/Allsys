<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/sidebars.css') }}" rel="stylesheet">
    <style>
        body {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            opacity: 0.9;

        }

        .custom-dropdown-item:hover {
            background-color: #6f42c1;
            color: #fff;
        }
    </style>
</head>

<body>
    <!---Navbar horizontal-->
    <nav class="navbar navbar backgroud_sidemenu shadow fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="modal"
                data-bs-target="#modal-lateral" id="btmenu">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>
            <span> <a class="text-decoration-none mb-0 fw-bold  text-white"
                    href="{{ route('home') }}">{{ Auth::user()->empresa ?? 'Gerencial AllSYS X' }}</a></span>
            <!-- button loggar -->
            <!-- Button -->
            <div class="btn-group dropstart">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false" id="btlogar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                        class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                        <path fill-rule="evenodd"
                            d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                    </svg>
                </button>

                <ul class="dropdown-menu" style="background-color:#121214">
                    <li><a class="dropdown-item text-white custom-dropdown-item" href="#">Perfil</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item text-white custom-dropdown-item" data-bs-toggle="modal"
                            data-bs-target="#teste">Sair</a></li>
                </ul>
            </div>
            <!-- Button fim -->
        </div>
    </nav>
    <!--- fim Navbar vertical-->
    <!---modal-->
    <div class="modal true backgroud_sidemenu" id="modal-lateral" tabindex="-1" aria-labelledby="modal-lateralLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" id="listmenu">
                <!---cabecalho do modal botao fechar e nome Menu-->
                <div class="modal-header" data-bs-theme="dark">
                    <h5 class="modal-title text-white" id="menu-titulo">MENU</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>

                </div>
                <!--- fim cabecalho do modal botao fechar e nome Menu-->
                <div class="modal-body ">
                    <!--- lista do menu-->
                    <ul class="list-unstyled ps-0">
                        <li class="mb-1">
                            <i class="fa-solid fa-user-tie" style="color: #ffffff;"></i>
                            <button
                                class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white"
                                data-bs-toggle="collapse" data-bs-target="#menu3-collapse" aria-expanded="false"
                                aria-controls=" menu3-collapse">
                                Administrador
                            </button>
                            <div class="collapse" id="menu3-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="{{ route('show.company') }}"
                                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white">Empresa</a>
                                    </li>
                                    <li><a href="{{ route('show.user') }}"
                                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white">Usuarios</a>
                                    </li>
                                    <li><a href="{{ route('trocar.preco') }}"
                                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white">Troca
                                            Preco</a></li>
                                    <li><a href="{{ route('monitor') }}"
                                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white">Monitor</a>
                                    </li>
                                    <li><a href="{{ route('caixa') }}"
                                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white">Caixa</a>
                                    </li>

                                </ul>
                            </div>

                        </li>
                        <li class="mb-1">
                            <i class="fa-solid fa-chart-simple" style="color: #ffffff;"></i>
                            <button
                                class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white"
                                data-bs-toggle="collapse" data-bs-target="#menu1-collapse" aria-expanded="false"
                                aria-controls=" menu1-collapse">
                                Gráficos
                            </button>
                            <div class="collapse" id="menu1-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="{{ route('tanques') }}"
                                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white">Tanques</a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="mb-1">
                            <i class="fa-solid fa-print" style="color: #ffffff;"></i>
                            <button
                                class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white"
                                data-bs-toggle="collapse" data-bs-target="#menu2-collapse" aria-expanded="false"
                                aria-controls=" menu2-collapse">
                                Dashboard
                            </button>
                            <div class="collapse" id="menu2-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">

                                    <li><a href="{{ route('dashboard.combustivel') }}"
                                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white">Combustiveis</a>
                                    </li>
                                    <li><a href="{{ route('dashboard.produto') }}"
                                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white">Produtos</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="mb-1">
                            <i class="fa-solid fa-print" style="color: #ffffff;"></i>
                            <button
                                class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white"
                                data-bs-toggle="collapse" data-bs-target="#menu2-collapse" aria-expanded="false"
                                aria-controls=" menu2-collapse">
                                Relatórios
                            </button>
                            <div class="collapse" id="menu2-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">

                                    <li><a href="{{ route('produto.listar') }}"
                                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white">Produtos</a>
                                    </li>
                                    <li><a href="{{ route('vendas.dia') }}"
                                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white">Cupons</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                    </ul>
                    <!--- fim lista do menu-->
                </div>
                <div class="modal-footer " id="footeruser">

                    <a type="button" class="btn btn-secondary" id="btuser"> <svg
                            xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                            class="bi bi-person-check-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        </svg> </a>
                    <h5> {{ Auth::user()->email }}</h5>

                </div>
            </div>
        </div>
    </div>
    <!---fim modal vertical-->
    <div class="container text-center">
        <h1 class="text-uppercase"></h1>
    </div>
    <div class="col py-3" id="conteudo_backgroud">
        {{ $slot }}
    </div>
    <!-- Modal -->
    <div class="modal fade" id="teste" tabindex="-1" aria-labelledby="testeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:#121214">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                        Olá! {{ Auth::user()->email }}
                    </h1>
                </div>
                <div class="modal-body text-white">
                    Deseja Sair do Sistema?
                </div>
                <div class="modal-footer" style="border: 5px solid #121214">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                    <a type="button" class="btn btn-danger" href="{{ route('deslogar') }}">Sim</a>
                </div>
            </div>
        </div>
    </div>
    <!-- fin modal -->



</body>

</html>
