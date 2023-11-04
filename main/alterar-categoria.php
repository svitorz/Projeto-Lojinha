<?php
session_start();
require 'autenticacao.php';

if(!autenticado() || !isAdmin()){
    $_SESSION['restrito'] = true;
    redireciona();
    die();
  }
  
require 'conexao.php';

$id = filter_input(INPUT_POST,"id", FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST,"nome", FILTER_SANITIZE_SPECIAL_CHARS);

$sql = "UPDATE categorias SET nome = ? WHERE id = ?";
    
try{
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$nome, $id]);
    echo $result;
}catch(Exception $e){
    $_SESSION['result'] = false;
    $erro = $e->getMessage();
    }

    if($result == true){
        $_SESSION['result'] = true;
        $_SESSION['mensagem_sucesso'] = "Dados alterados com sucesso";
    }else{
        $_SESSION['erro'] =  $erro;
        $_SESSION['result'] = false;
        $_SESSION['mensagem_erro'] = "Erro ao alterar categoria";
    }
redireciona('formulario-categorias.php');    