<?php 

if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['user'])){
    die ("vc nao esta logado <p><a href=\"index.php\">fazer login</a></p>");
}


?>