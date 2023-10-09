<?php

function autenticado(){
    if(isset($_SESSION['email'])){
        return true;
    }else {
        return false;
    }
}

function nome_usuario(){
    return $_SESSION['nome'];
}

function email_usuario(){
    return $_SESSION['email'];
}
function idUsuario(){
    return $_SESSION['idUsuario'];
}

function redireciona($pagina = null){
    if(empty($pagina)){
        $pagina = 'index.php';
    }
    header('Location:' . $pagina);
}
