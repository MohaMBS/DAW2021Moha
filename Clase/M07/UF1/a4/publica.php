<?php
session_start();
$_SESSION["email"]=$_REQUEST["email"];
$_SESSION["contra"]=$_REQUEST["contra"];
if ($_SERVER["REQUEST_METHOD"]== "POST"){
    if (!isset($_REQUEST["email"]) || empty($_REQUEST["email"]) && empty($_REQUEST["contra"]) || !isset($_REQUEST["contra"])){
        header('Location: login.php');
        echo"Usuario o contraseña incorrecta.";
    }else {
        header('Location: privada.php');
    }
}
?>