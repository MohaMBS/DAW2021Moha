<?php 
if ($_SERVER["REQUEST_METHOD"]== "POST"){
    if (isset($_REQUEST["salgo"])){
        if ($_REQUEST["salgo"]="salir"){
            session_unset();
            session_destroy();
            $_SESSION=null;
            header('Location: login.php');
        }else{
            header('Location: privada.php');
        }
    }
}
?>