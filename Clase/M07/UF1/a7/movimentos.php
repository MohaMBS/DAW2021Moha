<?php 
include_once("funcciones.php");
if (!isset($_SESSION["control"]) && adminUser()!="admin"){
    header("Location: login.php?error=1");
}
?>
<head>
   <meta charset="utf-8"/>
   <meta name="description" content="Movimientos">   
   <title>Título de la página</title>
   <style>
        table{
            width: 65%!important;
        }
        small{
            font-size:10px;
        }
   </style>
</head> 
<table style="background-color:aqua;">
    <h1>Ventras realizadas de forma correcta:<h1>
    <tr>
        <td>ID Producto</td>
        <td>ID Usuario</td>
        <td>Fecha completa</td>
        <td>Precio €</td>
        <td>Nombre</td>
        <td>Clave privada de compra.</td>
        <td>Clave publica de compra.</td>
    </tr>
    <? echo comprovarVentas("correctas");?>
</table>
<table style="background-color:yellow;">
    <h1>Ventras realizadas de forma fallida:</h1>
    <tr>
        <td>ID Producto</td>
        <td>ID Usuario</td>
        <td>Fecha completa</td>
        <td>Precio €</td>
        <td>Clave privada de compra.</td>
        <td>Clave publica de compra.</td>
        <td>Clave de compra fallida.</td>
    </tr>
    <? echo comprovarVentas("fallidas");?>
</table>
<h1 style="color:green;">En ventas tenemos un total de <?echo comprovarVentas("correctas",true);?>€ y no llevamos una comision de 2% en total al ganacia de la web es de <?echo (comprovarVentas("correctas",true)*0.02);?>€.</h1>
<form action="privada.php">
</br>
<input type="submit" value="Volver" style="color:red;">
</form>
