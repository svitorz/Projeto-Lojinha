<?php

session_start();
require 'autenticacao.php';

if(!autenticado()){
  $_SESSION['restrito'] = true;
  redireciona();
  die();
}

$titulo_pagina = "Formulário de inserção de dados";
require_once 'header.php';

if(!isset($_SESSION["email"])){
  ?>
  <div class="alert alert-danger">
      <h4>Esta é uma página protegida</h4>
      <p>Você está tentando acessar conteúdo restrito.</p>
  </div>    
  <?php
  }else{
?>
<form action="inserir-produto.php" method="post">
<div class="row">
    <div class="col-8">
        <div class="mb-3">
          <label for="nome" class="form-label">Nome do produto:</label>
          <input type="text" class="form-control" name="nome" id="nome" required/>
        </div>
        <div class="mb-3">
          <label for="descricao" class="form-label">Descrição do produto:</label>
          <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
        </div>
        <div class="mb-3">
          <label for="urlfoto" class="form-label">URL da imagem do produto:</label>
          <input type="url" class="form-control" id="urlfoto" name="urlfoto" required></input>
        </div>
        <div class="mb-3">
        <button type="submit" class="btn btn-success">
            Enviar
        </button>
          <button type="reset" class="btn btn-warning">
            Limpar
          </button>
        </div>
    </div>
</div>
</form>
<?php
  }
require_once 'footer.php';
?>            