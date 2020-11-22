<head>
<style>
    img{
        width: 100px;
        high:75px;
    }
</style>
</head>
<?php 
require_once ("funcciones.php");
$_SESSION["precioPagar"]=0;
if (isset($_SESSION["carritoUser"])){
    if(empty($_SESSION["carritoUser"])){
        ?>
        <h1 style="color:red;">No tienes nada en tu carrito :...</h1>
        <?php
    }else{
        ?>
        <table>
        <tr>
            <td><h3>Nom</h3></td>
            <td><h3>descripcio</h3></td>
            <td><h3>Imatge</h3></td>
            <td><h3>Preu</h3></td>
            <td><h3>Categoria</h3></td>
        </tr>
        <tr>
        <?php
        foreach ($_SESSION["carritoUser"] as &$value) {
            echo (BuscarPro("",true,$value));
            $_SESSION["precioPagar"]+=buscarPrecio($value);
        }
        ?>
        </tr>
        <tr>
            <td colspan=5><p>Precio a pagar: <?echo $_SESSION["precioPagar"];?>€</p></td>
        </tr>
        </table>
        <?php
    }
}else{
    echo('<h1 style="color:red;">No tienes nada en tu carrito :...</h1>');
}
?>