<?php
include("funcciones.php");
$contrl="";
if(isset($_SESSION["control"])){
    $contrl=$_SESSION["control"];
}else if(isset($_COOKIE["control"])){
    $contrl=$_COOKIE["control"];
}
if ($_SERVER["REQUEST_METHOD"]== "POST"){
    if (isset($_REQUEST["productos"])){
        if($_REQUEST["productos"]=="mp"){
            header("location: productos.php");
        }if($_REQUEST["productos"]=="ap"){
            header("location: noup.php");
        }
    }
    else if (isset($_REQUEST["salgo"])){
        include("salir.php"); 
    }
}
if ($contrl==false){
    header('Location: login.php?error=1');
}else{
    echo "Bienvenido "; 
    $registrado="si";
?>
<html>
<head>
   <meta charset="utf-8"/>
   <meta name="description" content="Resumen del contenido de la página">   
   <title>Título de la página</title>
   <style>
        img{
            width: 100px;
            height: 75px;
        }
        table{
            width: 65%;
        }
   </style>
</head>

<body>
    <header>cabecera</header>
    <form action="privada.php" method="post" name="paginaprivada">
    <button name="salir" type="submit" value="salir">Logout.</button>
    <button name="editar" type="submit" value="true">Editar.</button>
    <button name="productos" type="submit" value="mp">Productos.</button>
    <button name="productos" type="submit" value="ap">Alto a nuevo producto.</button>
    <input type="hidden" id ="salir" name="salgo" value="salir">
    </form>
    <? if(adminUser()=="admin"){
        echo "<a href=\"movimentos.php\">ver movimientos</a>";
    }?>
    <nav>
        enlace1
        enlace2
    </nav>
    <main>
       <section>
          <article> contenido </article>
          <article> contenido </article>
       </section>
    </main>
    <section>
        <h3><a href="carrito.php">Ver carrito.</a></h3>
        <table>
            <tr>
                    <td colspan=5 style="text-align:center;"><h2 style="color:grey;">Buscador</h2></td>
            </tr>
            <tr style="background-color:grey;">
                <td><p style="font-weight: bold;">Vols buscar un producte:</p></td>
                <td colspan="4"><form method="post"> 
                    <input style="" type="text" name="buscarP" placeholder="Escriu el nom...">
                    <label for="BuscadorCategoria">O PUEDES BUSCAR POR SOLO CATERGORIA</label>
                    <select name="buscarPc">
                        <option value="">Selecionar...</option>
                        <option value="TECNOLOGIA">TECNOLOGIA</option>
                        <option value="COMIDA">COMIDA</option>
                        <option value="INTERNET">INTERNET</option>
                        <option value="OTRO">OTRO</option>
                    </select>
                    <input style="margin-left:15px;" type="submit"value="Buscar."><input style="margin-left:15px;" type="submit"value="Borrar busqueda." name="borarB">
                    </form></td>
                    <?if ($_SERVER["REQUEST_METHOD"]== "POST"){
                        $flag=false;
                        if (isset($_REQUEST["buscarPc"])){
                            if($_REQUEST["buscarPc"]!=""){
                                $flag=true;
                                echo '<tr style="background-color:grey;"><td><h3>Nom</h3></td>
                                <td><h3>descripcio</h3></td>
                                <td><h3>Imatge</h3></td>
                                <td><h3>Preu</h3></td>
                                <td><h3>Categoria</h3></td></tr>'.BuscarPro($_REQUEST["buscarPc"]);
                            }
                        }if(isset($_REQUEST["buscarP"])){   
                            if(!empty($_REQUEST["buscarP"])){
                                echo '<tr style="background-color:grey;"><td><h3>Nom</h3></td>
                                <td><h3>descripcio</h3></td>
                                <td><h3>Imatge</h3></td>
                                <td><h3>Preu</h3></td>
                                <td><h3>Categoria</h3></td></tr>'.BuscarPro($_REQUEST["buscarP"]);
                                if (BuscarPro($_REQUEST["buscarP"])==false){
                                    echo '<p style="color:red;">Es articulo no esta en nuestra basde de datos</p>';
                                };
                            }else if (empty($_REQUEST["buscarP"])){
                                if($flag==false && !isset($_REQUEST["borarB"])){
                                    echo '<p style="color:orange;">Escriba el nombre o seleccione la categoria para poder relizar la busqueda.<p>';
                                }
                                
                            }
                        }
                    }?>
            </tr>
            <tr>
                    <td colspan=5 style="text-align:center;"><h2 style="color:green;">Product Disponibles</h2></td>
            </tr>
            </br></br>
            <tr>
                <td><h3>Nom</h3></td>
                <td><h3>descripcio</h3></td>
                <td><h3>Imatge</h3></td>
                <td><h3>Preu</h3></td>
                <td><h3>Categoria</h3></td>
            </tr>
            <form action="guradaCarrito.php" method="post">
        <?echo(ProductosUs($registrado));?></table>
        <tr>
                    <td><input type="submit" value="Guardar en carrito."></td></form>
        <tr>
    </section>
    <footer> © pie de la página </footer>
</body>

</html>
<?php
}
?>