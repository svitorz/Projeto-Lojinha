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
      <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required />
      <label for="floatingInput">Endereço de Email:</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required />
      <label for="floatingPassword">Senha:</label>
    </div>    
    <button class="btn btn-primary w-100 py-2" type="submit">Entrar</button>    
    </div>
  </div>
</form>
<div class="row">
  <div class="col-4 offset-4">
    <?php 
      if(isset($_SESSION['result_login'])){
        if($_SESSION['result_login']){
          
          
        }else{
          $erro = $_SESSION['erro'];
          unset($_SESSION['erro']);
          ?>
          <div class="alert alert-success">
            <h4>Falha ao realizar autenticação!</h4>
            <p>
              echo $erro;
            </p>
          </div>
          <?php
        }
        unset($_SESSION['result_login']);
      }
    ?>
  </div>
</div>
<?php
require_once 'footer.php';
?>            