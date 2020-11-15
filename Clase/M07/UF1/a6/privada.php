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
            width: 45%;
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
        <table>
            <tr>
                    <td colspan=5 style="text-align:center;"><h2 style="color:grey;">Buscador</h2></td>
            </tr>
            <tr style="background-color:grey;">
                <td><p style="font-weight: bold;">Vols buscar un producte:</p></td>
                <td colspan="3"><form method="post"> <input style="width: 50%;" type="text" name="buscarP" placeholder="Escriu el nom...">
                    <input style="margin-left:15px;" type="submit"value="Buscar."><input style="margin-left:15px;" type="submit"value="Borrar busqueda." name="borarB"><form></td>
                    <?if ($_SERVER["REQUEST_METHOD"]== "POST"){
                        if(isset($_REQUEST["buscarP"])){
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
                                if(!isset($_REQUEST["borarB"])){
                                    echo '<p style="color:orange;">Escriba el nombre para poder relizar la busqueda.<p>';
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
        <?echo(ProductosUs());?></table>
    </section>
    <footer> © pie de la página </footer>
</body>

</html>
<?php
}
?>