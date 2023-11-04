<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Lojinha</title>
    <!-- Bootstrap core CSS -->
    <link href="dist/bootstrap.min.css" rel="stylesheet"/>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .font-1 {
            color: #000 !important;
            font-weight: bolder;
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="dist/dashboard.css" rel="stylesheet"/>
</head>
<body>
    <?php 
        if(!function_exists("autenticado")){
            ?>
            <br>
            <h1>Atenção! Você esqueceu o require do arquivo <strong>autenticacao.php</strong>!</h1>
            <?php 
                die();    
                } 
            ?>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">
            Lojinha
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarsExample03">
            <ul class="navbar-nav mr-auto px-3 pb-2">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="formulario-produto.php">Produtos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="formulario-categorias.php">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listagem-produto.php">Listagem de produtos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pagina-protegida.php">Página protegida</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-light btn-sm btn-block font-1 my-1">Entrar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-danger btn-sm btn-block font-1 my-1">Sair</a>
                </li>
            </ul>
        </div>
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start pe-3 d-none d-sm-block">
            <div class="text-end">
                <?php if(!autenticado()){
                    ?>
                    <a href="formulario-usuarios.php" class="btn btn-info me-2 text-light">
                        <span data-feather="user-plus"></span>
                        Cadastrar
                    </a>
                    <a href="form-login.php" class="btn btn-light me-2">
                        <span data-feather="log-in"></span>
                        Entrar
                    </a>
                <?php    
                } else {
                    if(isAdmin()){
                        ?>
                <span class="mx-2 btn-dark text-capitalize text-warning ">  
                    <span data-feather="user"></span>
                            #<?= nome_usuario() ?>
                </span>
                <a href="sair.php" class="btn btn-danger me-2">
                    <span data-feather="log-out"></span>
                    Sair
                </a>
                <?php
                    }else {
                ?>
                <span class="mx-2 btn-dark text-capitalize">  
                    <span data-feather="user"></span>
                            <?= nome_usuario() ?>
                </span>
                <a href="sair.php" class="btn btn-danger me-2">
                    <span data-feather="log-out"></span>
                    Sair
                </a>
                <?php
                    }
                 } 
                ?>
            </div>
        </div>

    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky mt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">
                                <span data-feather="home"></span>
                                Início
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="formulario-produto.php">
                                <span data-feather="file-text"></span>
                                Formulário
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="formulario-categorias.php">
                                <span data-feather="file-text"></span>
                                Categorias
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="listagem-produto.php">
                                <span data-feather="list"></span>
                                Listagem de produtos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="listagem-usuario.php">
                                <span data-feather="users"></span>
                                Listagem de usuários
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="pagina-protegida.php">
                                <span data-feather="lock"></span>
                                Página protegida
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><?= $titulo_pagina; ?></h1>
                </div>
                <br>