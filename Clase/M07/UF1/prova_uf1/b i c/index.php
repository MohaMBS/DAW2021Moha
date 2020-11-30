<?php 
    include("funciones.php");
    if ($_SERVER["REQUEST_METHOD"]== "POST"){
        if (isset($_REQUEST["iniciar"])){
            if(autenticacion($_REQUEST["email"],md5($_REQUEST["contra"])) == true){
                $_SESSION["controlSession"]=true;
                $_SESSION["emailSession"]=$_REQUEST["email"];
                header ("location: home.php");
            }else{
                header ("location: ?error=1");
            }
        }
    }    
?>
<div style="margin:15% 0% 0% 25%;border:5pxsolid#FFFF00;">
    <form method="post" name="myform">
    <label for="usu">Email: </label> <input type="text" name="email"><?if (isset($_SESSION["errormail"])){echo $_SESSION["errormail"];}?>
    <label for="pass">Password: </label> <input type="password" name="contra"><?if (isset($_SESSION["errorcontra"])){echo $_SESSION["errorcontra"];}?>
    <button type="submit" value="true" name="iniciar">Inicicar.</button> 
    </br>
    <p>Haz click <a href="recuperar.php">aqui</a> si has olvidado tu contraseña.</p>
    </form>
</div>