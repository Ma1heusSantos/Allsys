<head>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="{{ asset('css/sidebars.css') }}" rel="stylesheet">
  <style>
    body {
      background-image: url('{{ asset('img/bomba.svg') }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
    }
  </style>
</head>

<body>

  <!---Navbar horizontal-->
  <nav class="navbar navbar backgroud_sidemenu shadow">
    <div class="container-fluid">
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" id="btmenu">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
        </svg>
      </button>
      <span class="navbar-brand mb-0 h1 text-white">Gerencial AllSYS X</span>
      <!-- button loggar -->
      <div class="btn-group dropstart">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="btlogar">
          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
          </svg>
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Perfil</a></li>
          <li><a class="dropdown-item" href="#">Configuracoes</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="#">Sair</a></li>
        </ul>
      </div>
      <!-- button loggar fim -->     
    </div>

  </nav>

  <!--- fim Navbar vertical-->
  <!---modal-->
  <div class="modal true backgroud_sidemenu" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content" id="listmenu">
        <!---cabecalho do modal botao fechar e nome Menu-->
        <div class="modal-header">
          <h5 class="modal-title text-white" id="exampleModalLabel">MENU</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!--- fim cabecalho do modal botao fechar e nome Menu-->
        <div class="modal-body ">
          <!--- lista do menu-->
          <ul class="list-unstyled ps-0">
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white" data-bs-toggle="collapse" data-bs-target="#menu1-collapse" aria-expanded="false" aria-controls=" menu1-collapse">
                Graficos
              </button>
              <div class="collapse" id="menu1-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="{{route('tanques')}}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white">Tanques</a></li>
                  <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white">Vendas dia</a></li>
                  <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white">Vendas Mes</a></li>
                  <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white">Vendas Frentista</a></li>
                  <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white">Troca Preco</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white" data-bs-toggle="collapse" data-bs-target="#menu2-collapse" aria-expanded="false" aria-controls=" menu2-collapse">
                Admin
              </button>
              <div class="collapse" id="menu2-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white">Empresa</a></li>
                  <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white">Usuarios</a></li>

                </ul>
              </div>

            </li>
          </ul>
          <!--- fim lista do menu-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!---fim modal-->
  <div class="container text-center">
    <h1 class="text-uppercase"></h1>
  </div>
  <div class="col py-3" id="conteudo_backgroud">
    {{ $slot }}
  </div>
</body>

</html>