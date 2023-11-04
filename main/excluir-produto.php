<?php
session_start();
require 'autenticacao.php';

if(!autenticado() || !isAdmin()){
    header('location: login.php');
    exit();
}

$titulo_pagina = "Página de exclusão de produtos";
require_once 'header.php';

require 'conexao.php';

$id = filter_input(INPUT_GET,"id", FILTER_SANITIZE_NUMBER_INT);

if(idUsuario() != $id){
    $_SESSION['result'] = false;
    $_SESSION['erro'] = true;
    redireciona('listagem-usuario.php');
    exit();
}

echo "<p class='fs-2'>Registro excluído: $id</p>";
$sql = "DELETE FROM produtos WHERE id = ?";

$stmt = $conn->prepare($sql);
$result = $stmt->execute([$id]);

$count = $stmt->rowCount();

if($result == true && $count >= 1){
?>
<div class="alert alert-success" role="alert">
    <h4>Registro excluído com sucesso!</h4>
</div>
<?php
}elseif($count == 0){
?>
<div class="alert alert-warning" role="alert">
    <h4>Nenhum registro encontrado com o id <?=$id?>!</h4>
<?php 
}
else{
    $errorArray = $stmt->errorInfo();    
?>
<div class="alert alert-danger" role="alert">
    <h4>Erro ao gravar dados</h4>
    <p><?= $errorArray[2]; ?></p>
</div>
<?php 
}
?>
<?php
require_once 'footer.php';
?>            