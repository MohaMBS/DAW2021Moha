<?php 
require ("funcciones.php");
if (!isset($_SESSION["control"])){
    header("Location: login.php?error=1");
}
if(isset($_REQUEST["id_comanda"])){
    $seguridad=count($_SESSION["carritoUser"]);
    
    $seguridadRegistro=0;
    if($_SESSION["identificadorCompraPrivada"]==$_REQUEST["id_comanda"]){
        foreach ($_SESSION["carritoUser"] as $value) {
            registrarCompra($value,IdUss($_SESSION["email"]));;
            $seguridadRegistro+=1;
        }    
        if($seguridadRegistro==$seguridad){
            $_SESSION["carritoUser"]=[];
    ?>
    <div>
        <h1>SU COMPRA HA SIDO REALIZADA DE FORMA CORRECTA</h1>
            <small> GRACIAS POR CONFIAR EN NOSTROS EL IDENTIFICADADOR DE SU COMPRA ES:<? echo $_SESSION["identificadorCompraPublica"];?> </small>
        <a href="privada.php">Volver a la tienda.</a>
    </div>

    <?php
            $_SESSION["identificadorCompraPrivada"]=[];
            $_SESSION["identificadorCompraPublica"]=[];
        }
    }
}

?>