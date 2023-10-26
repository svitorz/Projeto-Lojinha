<?php
session_start();
require 'autenticacao.php';

require 'conexao.php';

$nome = filter_input(INPUT_POST,"nome", FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST,"senha");

$insert = "INSERT INTO usuarios(nome, email, senha) VALUES (?,?,crypt(?, gen_salt('bf',8)))";
    
try{
    $stmt = $conn->prepare($insert);
    $result = $stmt->execute([$nome,$email,$senha]);
}catch(Exception $e){
    $_SESSION['resut'] = false;
    $erro = $e->getMessage();
    }

    if($result == true){
        $_SESSION['result'] = true;
    }else{
        if(stripos($erro,'duplicate key') != false){
            $erro = "O erro <b>\"$email\"</b> já está registrado. <br><br> $erro";
        }
        $_SESSION['erro'] =  $erro;
        $_SESSION['result'] = false;
    }
redireciona('formulario-usuarios.php');    
?>