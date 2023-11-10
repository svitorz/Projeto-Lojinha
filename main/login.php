<?php
session_start();
require 'autenticacao.php';

require 'conexao.php';

$email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_SPECIAL_CHARS);


//Verifica se existem adminsitradores
$sql = "SELECT nome,senha,id FROM administradores WHERE email = ?";

try {
    //code...
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$email]);
    $_SESSION['tipo_user'] = 'admin';
} catch (Exception $e) {
    $result = false;
    $error = $e->getMessage();
}

$count = $stmt->rowCount();
if ($count == 0 ) {
    //Verifica se existem usuarios
    $sql = "SELECT nome,senha,id FROM usuarios WHERE email = ?";
    try {
        //code...
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        $_SESSION['tipo_user'] = 'user';
    } catch (Exception $e) {
        $result = false;
        $error = $e->getMessage();
    }

}
    

$row = $stmt->fetch();

if(password_verify($senha, $row['senha'])){
    // Deu certo
    $_SESSION['email'] = $email;
    $_SESSION['nome'] = $row['nome'];
    $_SESSION['idUsuario'] = $row['id'];
    $_SESSION['result_login'] = true;
} else {
    $_SESSION['result_login'] = false;    
    unset($_SESSION['email']);
    unset($_SESSION['nome']);
    unset($_SESSION['tipo_user']);
}
redireciona('form-login.php');