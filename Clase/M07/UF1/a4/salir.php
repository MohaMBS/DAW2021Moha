<?php 
if (isset($_REQUEST["salgo"]) && $_REQUEST["salgo"]=="salir"){
    session_unset();
    session_destroy();
    $_SESSION=null;
    header('Location: login.php');
}
?>