<?php
session_start();
require 'autenticacao.php';

if(!autenticado()){
    $_SESSION['restrito'] = true;
    redireciona();
    die();
}

$titulo_pagina = "Página de exclusão de produtos";
require_once 'header.php';

require 'conexao.php';

$id = filter_input(INPUT_GET,"id", FILTER_SANITIZE_NUMBER_INT);
if(idUsuario() != $id){
    $_SESSION['erro'] = "Você não tem permissão para excluir este usuário!";
    redireciona();
    die();
}

/**
 *  DELETE FROM produtos WHERE 0
 * 
 */
echo "<p class='fs-2'>Registro excluído: $id</p>";
$sql = "DELETE FROM usuarios WHERE id = ?";
try{
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$id]);
    $count = $stmt->rowCount();
    ?>
<div class="alert alert-success" role="alert">
    <h4>Registro excluído com sucesso!</h4>
</div>
<?php
} catch(Exception $e) {
    echo $e->getMessage();
}

    

if($result == true && $count >= 1){
 redireciona("sair.php");
 die();
}elseif($count == 0){
    $_SERVER["result"] = false;
    $_SESSION['erro'] = "Não foi possível excluir o registro!";
    redireciona("listagem-usuario.php");
    die();
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