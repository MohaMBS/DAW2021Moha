<?php 
require ("funcciones.php");
if (!isset($_SESSION["control"])){
    header("Location: login.php?error=1");
}
if(!isset($_SESSION["carritoUser"])){
    $_SESSION["carritoUser"]=[];
}
if(isset($_REQUEST["carrito"])){
    if(!empty($_REQUEST["carrito"])){
        foreach ($_REQUEST["carrito"] as $value){
            if(empty($_SESSION["carritoUser"])){
                $_SESSION["carritoUser"][]=$value;
            }else{
                if(!in_array($value, $_SESSION["carritoUser"])){
                    $_SESSION["carritoUser"][]=$value;
                }else{
                header("Location:privada.php?errorCarrito"); 
                }
            }
        }
    }
    header("Location:privada.php");   
}else{
    header("Location:privada.php");
}
?>