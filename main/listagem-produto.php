<?php
session_start();
require 'autenticacao.php';


$titulo_pagina = "Listagem dos itens inseridos";

require_once 'header.php';

require 'conexao.php';

$sql = "SELECT id,nome,urlfoto,descricao FROM produtos ORDER BY nome";
$stmt = $conn->query($sql);
?>

<table class="table table-striped table-hover">
    <thead>
        <tr>
          <th scope="col" style="width: 5%;">ID</th>
          <th scope="col" style="width: 15%;">Nome do Produto</th>
          <th scope="col" style="width: 25%;">Descrição</th>
          <th scope="col" style="width: 15%;">Link da imagem do produto</th>
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
          <td><?= $row["descricao"]?></td>
          <td>
            <a href="<?= $row["urlfoto"]?>">
              LINK
            </a>
          </td>
          <td>
            <?php 
            if(autenticado()){

             
            ?>
            <a href="excluir-produto.php?id=<?=$row['id'];?>" onclick="if(!confirm('Deseja excluir?')) return false;" class=" btn btn-sm btn-danger">
              <span data-feather="trash-2"></span>
                Excluir 
            </a>
          </td>
          <td>
            <a href="editar-produto.php?id=<?=$row['id'];?>" class="btn btn-sm btn-primary">
                <span data-feather="edit"></span>
                Editar
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
require_once 'footer.php';
?>            