<?php 
include("funciones.php");
if(isset($_SESSION["controlSession"]) && $_SESSION["controlSession"]==true){
    $_SESSION["passnwwError"]="";
    if(!cambiopass()){  
        echo "Bienvenido ",home();
        ?>
         <form>
            <a href="salir.php">Cerrar Sesión</a>
        </form>
        <?php
    }else if(!cambiopass("new")){
        updateEstadoPass($_SESSION["emailSession"]);
        echo "Bienvenido ",home();
        echo '</br><strong style="color:red;">Debe de cambiar las password, ya se solicito un cambio previo.Puedes cambiar haciendo click <a href ="cambio.php">aqui</a><strong>';
    }else{
        echo '</br><strong style="color:red;">Debe de cambiar las password, ya se solicito un cambio previo.Puedes cambiar haciendo click <a href ="cambio.php">aqui</a><strong>';
    }
}else{
    header("Location: index.php");
}
?>

