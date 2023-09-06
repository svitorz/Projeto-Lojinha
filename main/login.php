<?php
session_start();
require 'autenticacao.php';

$titulo_pagina = "Página destino da autênticação";
require_once 'header.php';

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
    $_SESSION['id'] = $row['id'];
    ?>
<div class="alert alert-success" role="alert">
    <h4>Autenticado com sucesso.</h4>
</div>
<?php
} else {
    //Não deu certo
    unset($_SESSION['email']);
    unset($_SESSION['nome']);
    
?>
<div class="alert alert-danger">
    <h4>Falha ao efetuar autenticação</h4>
    <p>Usuário ou senha incorretos
    </p>
</div>
<?php
}
require_once 'footer.php';
?>            