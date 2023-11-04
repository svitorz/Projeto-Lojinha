<?php

session_start();
require 'autenticacao.php';

if(!autenticado() || !isAdmin()){
  $_SESSION['restrito'] = true;
  redireciona();
  die();
}

require 'conexao.php';

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET,"id", FILTER_SANITIZE_NUMBER_INT);

    $sql = "SELECT nome FROM CATEGORIAS WHERE id = ?";
    try{
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        $rowCategoria = $stmt->fetch();

        $nome = $rowCategoria['nome'];

        $action = "alterar-categoria.php";
    } catch(Exception $e) {
        $result = false;
        $error = $e->getMessage();
    }
} else {
    $id = null;
    $nome = null;
    $action = "inserir-categoria.php";
}


$sql = "SELECT id, nome FROM CATEGORIAS ORDER BY nome";
$stmt = $conn->query($sql);


$titulo_pagina = "Formulário de cadastro de categorias";

require_once 'header.php';
?>
<form action="<?= $action; ?>" method="post">
<div class="row">
    <input type="hidden" name="id" id="id" value="<?= $id ?>" />
    <div class="col-8">
        <div class="mb-3">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" class="form-control" name="nome" id="nome" value="<?= $nome ?>" required/>
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
 if(isset($_SESSION['result'])){
    if($_SESSION['result']){
?>
<div class="row">
    <div class="col-md-8">
        <div class="alert alert-success">
            <h4> <?= $_SESSION['mensagem_sucesso'] ?> </h4>
        </div>
    </div>
</div>
<?php
    unset ($_SESSION['mensagem_sucesso']);
    } else {
      ?>
      <div class="alert alert-danger" role="alert">
        <h4><?= $_SESSION['mensagem_erro']; ?> </h4>
        <p> <?= $_SESSION['erro']; ?> </p>
      </div>
    <?php    
    unset($_SESSION['mensagem_erro']);
    unset($_SESSION['erro']);
    }
    unset($_SESSION['result']);
}
?>
<div class="row">
    <div class="col-md-8">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
              <th scope="col" style="width: 5%;">ID</th>
              <th scope="col" style="width: 50%;">Nome </th>
              <?php if(autenticado()){ ?> 
              <th scope="col" style="width:5%;"> </th>
              <th scope="col" style="width:5%;"></th>
              <?php } ?>
            </tr>
        </thead>
        <tbody>
          <?php while($row = $stmt->fetch()){ ?>
            <tr>
              <th scope="row"> <?= $row["id"]?> </th>
              <td><?= $row["nome"]?></td>
              <td>
                <a href="formulario-categorias.php?id=<?=$row['id'];?>" class="btn btn-sm btn-warning">
                  <span data-feather="edit"></span>
                    Editar 
                </a>
              </td>
              <td>
                <a href="excluir-categoria.php?id=<?=$row['id'];?>" onclick="if(!confirm('Deseja excluir?')) return false;" class=" btn btn-sm btn-danger">
                  <span data-feather="trash-2"></span>
                    Excluir 
                </a>
              </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>        
    </div>
</div>

<?php 
require_once 'footer.php';
?>            