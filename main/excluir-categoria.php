<?php
session_start();
require 'autenticacao.php';

if(!autenticado() || !isAdmin()){
    $_SESSION['restrito'] = true;
    redireciona();
    die();
  }
  

require 'conexao.php';

$id = filter_input(INPUT_GET,"id", FILTER_SANITIZE_NUMBER_INT);

$sql = "DELETE FROM CATEGORIAS WHERE id = ?";
try{
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$id]);
} catch(Exception $e) {
    $result = false;
    $error = $e->getMessage();
}
// $count = $stmt->rowCount();
if($result == true){
    // && $count >= 1
    $_SESSION['result'] = true;
    $_SESSION['mensagem_sucesso'] = "Dados excluídos com sucesso";
} else{

    if (
        stripos($error, "fk_produtos_categoria") != false
    ) {
        $error = "ATENÇÃO:Não é possível excluir uma categoria que possui produtos cadastrados.";
    }

    $_SESSION['result'] = false;
    $_SESSION['mensagem_erro'] = "Erro ao excluir categoria";
    $_SESSION['erro'] = $error;
}
redireciona("formulario-categorias.php");
