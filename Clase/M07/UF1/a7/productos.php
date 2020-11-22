<?php 
include ("funcciones.php");
    if (!isset($_SESSION["control"])){
        header("Location: login.php?error=1");
    }
?>
<head>
    <style>
        table{
            width:40%;
            text-align:center;
        }
        img{
            height:50px;
            width:50px;
        }
    </style>
</head>
<table>
<?php 
    if (isset($_REQUEST["estado"])){
        if ($_REQUEST["estado"]=="01"){
            echo '<div style="background-color:aqua;"><h3>Operacion realizada de forma correcta.</h3></div>';
        }else if ($_REQUEST["estado"]=="001"){
            echo '<div style="background-color:orange;"><h3>Error al relizar la operación.</h3></div>';
        }
    }
?>
<form action="privada.php">
    <input type="submit" value="Volver  ">
</form>
<tr>
    <td><strong>NOM</strong></td>
    <td><strong>DESCRIPCIO</strong></td>
    <td><strong>IMATGE</strong></td>
    <td><strong>PREU</strong></td>
    <td><strong>ID PRODUCTO</strong></td>
    <td><strong>CATEGORIA</strong></td>
</tr>
<?php
    if(adminUser()=="admin"){
        echo '<p style="color:green;">Eres admins y este es el lista de todos los productos</p>';
    }
    if(ProductosUs(IdUss($_SESSION["email"]))==false){
        echo '<h3 style="color:red;">NO TIENES NINGUN PRODUCTO</h3>';
    }else{
        echo ProductosUs(IdUss($_SESSION["email"]),"masquever",adminUser());
    }
?>
</table>
<?php
?>