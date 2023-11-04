<?php
session_start();
require 'autenticacao.php';


$titulo_pagina = "Página de alteração de produtos";
require_once 'header.php';

require 'conexao.php';

$id = filter_input(INPUT_POST,"id", FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_POST,"nome", FILTER_SANITIZE_SPECIAL_CHARS);
$urlfoto = filter_input(INPUT_POST,"urlfoto", FILTER_SANITIZE_URL);
$descricao = filter_input(INPUT_POST,"descricao", FILTER_SANITIZE_SPECIAL_CHARS);
$categoria = filter_input(INPUT_POST,"categoria", FILTER_SANITIZE_NUMBER_INT);


/**
 *  UPDATE produtos SET id='[value-1]',nome='[value-2]',urlfoto='[value-3]',descricao='[value-4]' WHERE 1
 * 
 */

$sql = "UPDATE produtos SET nome = ?, urlfoto = ?,descricao = ?, id_categoria = ? WHERE id = ?";

$stmt = $conn->prepare($sql);
$result = $stmt->execute([$nome,$urlfoto,$descricao,$categoria,$id]);

$count = $stmt->rowCount();

if($result == true &&  $count >= 1 ){
?>
<div class="alert alert-success" role="alert">
    <h4>Dados alterados com sucesso!</h4>
</div>
<?php
}elseif($result == true &&  $count == 0 ) {
    $errorArray = $stmt->errorInfo();
?>
<div class="alert alert-secondary" role="alert">
    <h4>Nenhum dado foi alterado!</h4>
</div>
<?php 
}else{
    $errorArray = $stmt->errorInfo();
}
require_once 'footer.php';
?>            