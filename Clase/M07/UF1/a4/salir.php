<?php 
if ($_REQUEST["salir"]=="salir"){
    session_unset();
    session_destroy();
    $_SESSION=null;
    header('Location: login.php');
}

?>