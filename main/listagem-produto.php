<?php
session_start();
require 'autenticacao.php';

$titulo_pagina = "Listagem dos itens inseridos";

require_once 'header.php';

require 'conexao.php';

if (isset($_GET["ordem"]) && !empty($_GET["ordem"])) {
  $ordem = filter_input(INPUT_GET, "ordem", FILTER_SANITIZE_SPECIAL_CHARS);
} else {
  $ordem = "nome";
}

$tipo_busca = filter_input(INPUT_POST, "tipo_busca", FILTER_SANITIZE_SPECIAL_CHARS);
$busca = filter_input(INPUT_POST, "busca", FILTER_SANITIZE_SPECIAL_CHARS);
 if (isset($busca) && !empty($busca)) {

   if ($tipo_busca == "id") {

     $sql = "SELECT produtos.*, categorias.nome AS nome_categoria FROM produtos INNER JOIN categorias ON categorias.id = produtos.id_categoria 
     WHERE id = ? ORDER BY {$ordem}";
     $stmt = $conn->prepare($sql);
     $stmt->execute([$busca]);

   } elseif ($tipo_busca == "nome") {

     $sql = "SELECT produtos.*, categorias.nome AS nome_categoria FROM produtos INNER JOIN categorias ON categorias.id = produtos.id_categoria 
     WHERE nome ilike ? ORDER BY {$ordem}";
     $busca_banco = "%" . $busca . "%";
     $busca_banco = str_replace(" ", "%", $busca_banco);

     $stmt = $conn->prepare($sql);
     $stmt->execute([$busca_banco]);

   } elseif ($tipo_busca == "descr") {

     $sql = "SELECT produtos.*, categorias.nome AS nome_categoria FROM produtos INNER JOIN categorias ON categorias.id = produtos.id_categoria 
     WHERE descricao ilike ? ORDER BY {$ordem}";
     $busca_banco = "%" . $busca . "%";
     $busca_banco = str_replace(" ", "%", $busca_banco);


     $stmt = $conn->prepare($sql);
     $stmt->execute([$busca_banco]);

   } else {

     $sql = "SELECT PRODUTOS.*, CATEGORIAS.NOME AS NOME_CATEGORIA FROM produtos INNER JOIN CATEGORIAS ON CATEGORIAS.ID = PRODUTOS.ID_CATEGORIA 
     WHERE PRODUTOS.descricao ilike ? 
       OR PRODUTOS.nome ilike ? 
         OR PRODUTOS.id = ? 
           ORDER BY {$ordem}";

     $buscaInt = intval($busca);
     $busca_banco = "%" . $busca . "%";
     $busca_banco = str_replace(" ", "%", $busca_banco);

     $stmt = $conn->prepare($sql);
     $stmt->execute([$busca_banco, $busca_banco, $buscaInt]);

   }

 } else {
   $tipo_busca = null;
   $busca = null;

   $sql = "SELECT produtos.*, categorias.nome AS nome_categoria FROM produtos INNER JOIN categorias ON categorias.id = produtos.id_categoria 
   ORDER BY {$ordem}";
   $stmt = $conn->query($sql);

 }
?>
<div class="row">
  <div class="col">
    <form action="?ordem=<?= $ordem ?>" role="search" method="POST" class="row">

      <label for="tipo_busca" class="col-2">
        Buscar por
      </label>
      <div class="col-sm-2">
        <select class="form-select" name="tipo_busca" id="tipo_busca">
          <option value="">Todos os campos</option>
          <option value="id" <?php if ($tipo_busca == "id")
            echo "selected"; ?>>Id</option>
          <option value="nome" <?php if ($tipo_busca == "nome")
            echo "selected"; ?>>Nome</option>
          <option value="descr" <?php if ($tipo_busca == "descr")
            echo "selected"; ?>>Descrição</option>
        </select>
      </div>
      <div class="col-sm-6">
        <input class="form-control me-2" type="search" id="busca" name="busca" placeholder="Search" aria-label="Search"
          value="<?php if(isset($busca)){ echo $busca; } else {echo ""; }   ?>" />
      </div>
      <div class="col-sm-2">
        <button type="submit" class="btn btn-outline-success">
          Pesquisar
        </button>
      </div>
    </form>
  </div>
</div>

<hr />

<?php
if (!empty($busca)) {
  ?>
  <div class="row">
    <div class="row">
      <div class="alert alert-light" role="alert">
        <h4>Você está buscando por "<mark class="fst-italic">
            <?= $busca; ?>
          </mark>" ,<a href="?ordem=<?= $ordem ?>">Limpar</a> </h4>
      </div>
    </div>
  </div>
  <?php
}
?>


<table class="table table-striped table-hover">
  <thead>
    <tr>
      <?php
      if ($ordem == "nome") {
        ?>
        <th scope="col" style="width: 5%;">
          <a href="?ordem=id">
            ID
          </a>
        </th>
        <th scope="col" style="width: 20%;">
          Nome do Produto
          <span data-feather="chevron-down"></span>
        </th>
        <?php
      } else {
        ?>
        <th scope="col" style="width: 5%;">
          ID
          <span data-feather="chevron-down"></span>
        </th>
        <th scope="col" style="width: 15%;">
          <a href="?ordem=nome">
            Nome do Produto
          </a>
        </th>
        <?php
      }
      ?>


      <th scope="col" style="width: 25%;">Descrição</th>
      <th scope="col" style="width: 25%;">Categoria</th>
      <th scope="col" style="width: 15%;">Link da imagem do produto</th>
      <?php
      if (autenticado()) {
        ?>
        <th scope="col" style="width:5%;"></th>
        <th scope="col" style="width:5%;"></th>
        <?php
      }
      ?>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($row = $stmt->fetch()) {
      ?>
      <tr>
        <th scope="row">
          <?= $row["id"] ?>
        </th>
        <td>
          <?= $row["nome"] ?>
        </td>
        <td>
          <?= $row["descricao"] ?>
        </td>
        <td>
          <?= $row["nome_categoria"] ?>
        </td>
        <td>
          <a href="<?= $row["urlfoto"] ?>">
            LINK
          </a>
        </td>
        <td>
          <?php
          if(autenticado() && isAdmin()){
            ?>
            <a href="excluir-produto.php?id=<?= $row['id']; ?>" onclick="if(!confirm('Deseja excluir?')) return false;"
              class=" btn btn-sm btn-danger">
              <span data-feather="trash-2"></span>
              Excluir
            </a>
          </td>
          <?php 
          }
          if(autenticado()){
          ?>
          <td>
            <a href="editar-produto.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-primary">
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