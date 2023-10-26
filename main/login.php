<?php
session_start();
require 'autenticacao.php';

require 'conexao.php';

$email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_SPECIAL_CHARS);

$sql = "SELECT nome,senha,id FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$email]);

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
}
redireciona('form-login.php');