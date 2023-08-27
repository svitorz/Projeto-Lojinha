<?php

session_start();
require 'autenticacao.php';

if(!autenticado()){
    $_SESSION['restrito'] = true;
    redireciona();
    die();
}

$titulo_pagina = "Página protegida";
require_once 'header.php';
//include 'conexao.php';

?>
<p class="display-2">
    Olá <b class="text-capitalize"><?= nome_usuario() ?></b>, Seja bem vindo(a)!
</p>
<div class="text-center">
    <div class="display-4 fw-bold">
        Aula de sessões
    </div>
    <div class="display-4">
        Está é uma página <span class="bg-danger text-warning">PROTEGIDA</span>
    </div>
    <div class="display-4">
        só deve ser possível acessa-lá,
    </div>
    <div class="display-4">
        <span class="bg-warning text-danger">
            após ter se autênticado.
        </span>
    </div>
</div>

<?php
require_once 'footer.php';
?>            