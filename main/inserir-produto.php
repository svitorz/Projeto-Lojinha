<?php
session_start();
require 'autenticacao.php';


$titulo_pagina = "Página de inserção de produtos inserção de dados";

require_once 'header.php';

require 'conexao.php';

$nome = filter_input(INPUT_POST,"nome", FILTER_SANITIZE_SPECIAL_CHARS);
$urlfoto = filter_input(INPUT_POST,"urlfoto", FILTER_SANITIZE_URL);
$descricao = filter_input(INPUT_POST,"descricao", FILTER_SANITIZE_SPECIAL_CHARS);

echo "<p>Nome: $nome";
echo "<p>Descrição: $descricao";
echo "<p>Link:<a href='$urlfoto' target='_blank'> $urlfoto</a>";

/**
 *  INSERT INTO produtos(id, nome, urlfoto, descricao) 
 * VALUES ('[value-1]','[value-2]','[value-3]','[value-4]')
 * 
 */

$sql = "INSERT INTO produtos(nome, urlfoto, descricao) VALUES (?,?,?)";

$stmt = $conn->prepare($sql);
$result = $stmt->execute([$nome,$urlfoto,$descricao]);

if($result == true){
?>
<div class="alert alert-success" role="alert">
    <h4>Dados gravados com sucesso!</h4>
</div>
<?php
}else {
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