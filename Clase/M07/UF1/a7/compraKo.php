<?php 
include_once ("funcciones.php");
if (!isset($_SESSION["control"])){
    header("Location: login.php?error=1");
}
if($_SERVER["REQUEST_METHOD"]=="GET"){
    if(isset($_GET["id_comanda"]) && isset($_SESSION["identificadorCompraPrivadaKo"])){
        if( $_SESSION["identificadorCompraPrivadaKo"]==$_GET["ko_id"]){
            foreach ($_SESSION["carritoUser"] as $value) {
                registroCompraFallida(IdUss($_SESSION["email"]),$value);
            }
        } 
    }
}
echo '<h1 style="color:red;">Compra fallida, referencia del problema es '.$_SESSION["identificadorCompraPrivadaKo"].'. Guarde el id y posgase en contacto.';
?>