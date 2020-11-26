<?php 
include ("funcciones.php");
if ($_SERVER["REQUEST_METHOD"]== "GET"){
    if (isset($_REQUEST["id"])){
        $posi=buscadorLista($_SESSION["carritoUser"],$_REQUEST["id"]);
        unset($_SESSION["carritoUser"],$posi);
        header("Location: carrito.php");
    }else{
        header("Location: privada.php");
    }
}else{
    header("Location: privada.php");
}
?>