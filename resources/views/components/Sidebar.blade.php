<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-2 col-lg-1 px-sm-0 px-0" style="background-color:#0087F9;">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <img style="width: 100%;" src="/img/LogoHBranco.png" alt="Logo">
                <a href="/"
                    class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <i class="fa-solid fa-chart-line"></i>
                    <span class="fs-5 d-none d-sm-inline ms-2">Dashboard</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                    id="menu">
                    <li class="nav-item">
                        <a class="nav-link d-flex justify-content-center align-items-center text-white">
                            <i class="fas fa-user-alt"></i>
                            <span class="ms-2">Clientes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex justify-content-center align-items-center text-white">
                            <i class="fas fa-oil-can"></i>
                            <span class="ms-2">Postos</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link d-flex justify-content-center align-items-center text-white">
                            <i class="fas fa-users"></i>
                            <span class="ms-2">Usuário</span>
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="row-gap-2 text-center mb-3" style='margin-left: 20%'>
                    <a class="text-decoration-none text-light" href="#">
                        <i class="fa-solid fa-arrow-right-from-bracket" style="color: #ffffff;"></i>
                        Sair
                    </a>
                </div>

            </div>
        </div>
        <div class="col py-3">
            {{ $slot }}
        </div>
    </div>
</div>
