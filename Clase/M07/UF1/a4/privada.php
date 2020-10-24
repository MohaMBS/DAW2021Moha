<?php
session_start(); 
include("salir.php"); 
if ($_SESSION["control"]==FALSE){
    header('Location: login.php?error=1');
}else{
    echo "Bienvenido ".$_SESSION["email"]; 

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
    <button id="inicio" type="submit" value="salir">Logout.</button>
    <input type="hidden" id ="salgo" name="salgo" value="salir">
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