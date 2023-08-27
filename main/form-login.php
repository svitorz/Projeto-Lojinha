<?php
session_start();
require 'autenticacao.php';

if(autenticado()){
  redireciona();
  die();
}

$titulo_pagina = "Identifique-se";
require_once 'header.php';
?>
<form action="login.php" method="post">
<div class="row">
  <div class="col-4 offset-4">
    <div class="form-floating">
      <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
      <label for="floatingInput">Endereço de Email:</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
      <label for="floatingPassword">Senha:</label>
    </div>    
    <button class="btn btn-primary w-100 py-2" type="submit">Entrar</button>    
    </div>
  </div>
</form>

<?php
require_once 'footer.php';
?>            