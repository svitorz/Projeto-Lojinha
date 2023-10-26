<?php
session_start();
require 'autenticacao.php';

if(!autenticado()){
  $_SESSION['restrito'] = true;
  redireciona();
  die();
}


$titulo_pagina = "Listagem dos usuários";

require_once 'header.php';

require 'conexao.php';

$sql = "SELECT id,nome,email FROM usuarios ORDER BY nome";
$stmt = $conn->query($sql);
?>

<table class="table table-striped table-hover">
    <thead>
        <tr>
          <th scope="col" style="width: 5%;">ID</th>
          <th scope="col" style="width: 15%;">Nome </th>
          <th scope="col" style="width: 25%;">Email</th>
          <?php
          if(autenticado()){
          ?> 
          <th scope="col" style="width:20%;"></th><th scope="col" style="width:20%;"></th>
          <?php 
          }
          ?>
        </tr>
    </thead>
    <tbody>
      <?php 
      while($row = $stmt->fetch()){
      ?>
        <tr>
          <th scope="row"> <?= $row["id"]?> </th>
          <td><?= $row["nome"]?></td>
          <td><?= $row["email"]?></td>  
          <td>
            <?php 
            if(idUsuario() == $row['id']){
            ?>
            <a href="excluir-usuario.php?id=<?=$row['id'];?>" onclick="if(!confirm('Deseja excluir?')) return false;" class=" btn btn-sm btn-danger">
              <span data-feather="trash-2"></span>
                Excluir 
            </a>
          </td>
        </tr>
        <?php
        }
        }
        ?>
    </tbody>
</table>
<?php

        if(isset($_SESSION['result'])){
            if(!$_SESSION['result']){

              $erro = $_SESSION['erro'];
              unset($_SESSION['erro']);
              ?>
              <div class="alert alert-danger" role="alert">
                <h4>Falha ao realizar exclusão</h4>
                <p><?php echo $erro; ?></p>
              </div>
            <?php
            }
            unset($_SESSION['result']);
          }
require_once 'footer.php';
?>            