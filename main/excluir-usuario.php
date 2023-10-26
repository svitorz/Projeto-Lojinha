<?php
session_start();
require 'autenticacao.php';

if(!autenticado()){
    $_SESSION['restrito'] = true;
    redireciona();
    die();
}

require 'conexao.php';

$id = filter_input(INPUT_GET,"id", FILTER_SANITIZE_NUMBER_INT);

if(idUsuario() != $id){
    $_SESSION['result'] = false;
    $_SESSION['erro'] = "Você não tem permissão para excluir este usuário!";
    redireciona('listagem-usuario.php');
    die();
}

$sql = "DELETE FROM usuarios WHERE id = ?";
try{
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$id]);
    $count = $stmt->rowCount();
} catch(Exception $e) {
    $result = false;
    echo $e->getMessage();
}
if($result == true && $count >= 1){
 redireciona("sair.php");
 die();
}elseif($count == 0){
    $_SERVER["result"] = false;
    $_SESSION['erro'] = "Não foi encontrado nenhum usuário com o ID ($id)";
    redireciona("listagem-usuario.php");
    die();
}
else{
    $_SESSION['erro'] = $erro;
    $_SESSION['result'] = false;
    redireciona('listagem-usuario.php');
    die();
}
