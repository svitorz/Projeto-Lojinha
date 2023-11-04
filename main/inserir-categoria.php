<?php
session_start();
require 'autenticacao.php';

if(!autenticado() || !isAdmin()){
    $_SESSION['restrito'] = true;
    redireciona();
    die();
  }
  

require 'conexao.php';

$nome = filter_input(INPUT_POST,"nome", FILTER_SANITIZE_SPECIAL_CHARS);

$insert = "INSERT INTO categorias(nome) VALUES (?)";
    
try{
    $stmt = $conn->prepare($insert);
    $result = $stmt->execute([$nome]);
}catch(Exception $e){
    $_SESSION['result'] = false;
    $erro = $e->getMessage();
    }

    if($result == true){
        $_SESSION['result'] = true;
        $_SESSION['mensagem_sucesso'] = "Dados gravados com sucesso";
    }else{
        $_SESSION['erro'] =  $erro;
        $_SESSION['result'] = false;
        $_SESSION['mensagem_erro'] = "Erro ao cadastrar categoria";
    }
redireciona('formulario-categorias.php');    
?>