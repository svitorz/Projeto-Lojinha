<?php
session_start();
require 'autenticacao.php';


$titulo_pagina = "Formulário de inserção de dados";
require_once 'header.php';
?>
<form action="" method="post">
<div class="row">
    <div class="col-8">
        <div class="mb-3">
          <label for="nome_prod" class="form-label">Nome do produto:</label>
          <input type="email" class="form-control" name="nome_prod" id="nome_prod" required/>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Descrição do produto:</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">URL da imagem do produto:</label>
          <input type="url" class="form-control" id="exampleFormControlTextarea1" rows="3" required></input>
        </div>
        <div class="mb-3">
        <button type="submit" class="btn btn-success">
            Enviar
        </button>
          <button type="submit" class="btn btn-warning">
            Limpar
          </button>
        </div>
    </div>
</div>
</form>
<?php
require_once 'footer.php';
?>            