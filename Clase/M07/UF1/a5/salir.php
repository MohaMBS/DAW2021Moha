<?php 
if ($_SERVER["REQUEST_METHOD"]== "POST"){
    if (isset($_REQUEST["editar"])){
        if ($_REQUEST["editar"]==true ){
            header("location: editarUsuario.php");
        }
    }else if (isset($_REQUEST["salgo"])){
        if(isset($_COOKIE)){
            session_unset();
            session_destroy();
            $_SESSION=null;
            header('Location: login.php?salir=cookie');
        }
        else if ($_REQUEST["salgo"]="salir"){
            session_unset();
            session_destroy();
            $_SESSION=null;
            header('Location: login.php');
        }
        else{
            header('Location: privada.php');
        }
    }
}
?>