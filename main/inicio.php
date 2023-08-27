<?php

session_start();
require 'autenticacao.php';


$titulo_pagina = "Ínicio";
require_once 'header.php';
include 'conexao.php';
?>
    <p class="display-4">
        Seja bem vindo a aplicação <strong>"Lojinha"</strong>.
    </p>
    <p class="display-4">
        Esta é a página inicial.
    </p>
<?php
if(isset($_SESSION['restrito']) && $_SESSION['restrito']){
    ?>
    <div class="alert alert-danger" role="alert">
        <h4>Está é uma página protegida!</h4>
        <p>Você está tentando acessar conteúdo restrito!</p>
    </div>    
    <?php
    unset($_SESSION['restrito']);
}

require_once 'footer.php';
?>            