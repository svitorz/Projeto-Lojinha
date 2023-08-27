<?php
session_start();
require 'autenticacao.php';


$titulo_pagina = "Formulário de inserção de dados";
require_once 'header.php';
require 'conexao.php';

$id = filter_input(INPUT_GET,"id", FILTER_SANITIZE_NUMBER_INT);

if(empty($id)){
?>
<div class="alert alert-danger" role="alert">
    <h4>Falha ao abrir formulário!</h4>
    <p>O id está vazio</p>
</div>
<?php
    exit;
}

$sql = "SELECT nome,urlfoto,descricao FROM produtos WHERE id = ?";

$stmt = $conn->prepare($sql);
$result = $stmt->execute([$id]);

$rowProduto = $stmt->fetch();
?>

<form action="alterar-produto.php" method="post">
    <input type="hidden" name="id" id="id" value="<?=$id;?>" />
<div class="row">
    <div class="col-8">
        <div class="mb-3">
          <label for="nome" class="form-label">Nome do produto:</label>
          <input type="text" class="form-control" name="nome" id="nome" value="<?=$rowProduto['nome']?>" required/>
        </div>
        <div class="mb-3">
          <label for="descricao" class="form-label">Descrição do produto:</label>
          <textarea class="form-control" id="descricao" name="descricao" rows="3"> <?=$rowProduto['descricao']?></textarea>
        </div>
        <div class="mb-3">
          <label for="urlfoto" class="form-label">URL da imagem do produto:</label>
          <input type="url" class="form-control" id="urlfoto" name="urlfoto" value="<?=$rowProduto['urlfoto']?>" required></input>
        </div>
        <div class="mb-3">
        <button type="submit" class="btn btn-success">
            Atualizar
        </button>
          <button type="reset" class="btn btn-warning">
            Cancelar
          </button>
        </div>
    </div>
    <div class="col-3">
      <img src="<?= $rowProduto['urlfoto'];?>" alt="<?= $rowProduto['nome'];?>" class="img-thumbnail" id="image-preview">
    </div>
</div>
</form>
<?php
require_once 'footer.php';
?>            