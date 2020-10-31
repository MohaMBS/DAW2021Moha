<?php
session_start(); 
$contrl="";
if(isset($_SESSION["control"])){
    $contrl=$_SESSION["control"];
}else if(isset($_COOKIE["control"])){
    $contrl=$_COOKIE["control"];
}
if ($_SERVER["REQUEST_METHOD"]== "POST"){
    if (isset($_REQUEST["salgo"])){
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
</head>

<body>
    <header>cabecera</header>
    <form action="privada.php" method="post" name="paginaprivada">
    <button name="salir" type="submit" value="salir">Logout.</button>
    <button name="editar" type="submit" value="true">Editar mi cuenta.</button>
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
    <footer> © pie de la página </footer>
</body>

</html>
<?php
}
?>