<?php
include ("funcciones.php");
//include ("auten.php");
$errormail="";
$errorcontra="";
if (isset($_REQUEST["salir"])){
    if($_REQUEST["salir"] == "cookie"){
        unset($_COOKIE["email"]);
        unset($_COOKIE["contra"]);
    }
}
if (isset($_REQUEST["aceptadocookie"])){
    if($_REQUEST["aceptadocookie"]=="si"){
        setcookie("datos","si", time() + 86400 * 30);
        header('location:login.php');
    }
}else if (isset($_REQUEST["aceptadocookie"]) && $_REQUEST["aceptadocookie"]=="no"){
    header('location:http://www.google.com');
}
if(!isset($_COOKIE["datos"])){
    echo'<form method="post">
        <h3>Acceptas nuestras coockies?</h3>
        <input type="radio" name="aceptadocookie" value="si">
        <label for="aceptadocookie">Si.</label><br>
        <input type="radio" name="aceptadocookie" value="no">
        <label for="aceptadocookie">No.</label><br>
        <button type="submit">Inicicar.</button>
    </form>';
 
}else{
    if (isset($_COOKIE["contra"])){
        header('location:privada.php');
    }else{
        if ($_SERVER["REQUEST_METHOD"]== "POST"){
            if (isset($_REQUEST["registrarse"])){
                header("location: registro.php");
            }
            if (isset($_REQUEST["iniciar"])){
                if(autenticacion($_REQUEST["email"],sha1($_REQUEST["contra"]))==true){
                    $_SESSION["email"]=$_REQUEST["email"];
                    $_SESSION["control"]=true;
                    header ("location: privada.php");
                }else{
                    header ("location: privada.php?error=1");
                }
            }
        }
        if (isset($_REQUEST["error"]) ){
            if ($_REQUEST["error"]==1){
                echo "Error de usuario o contraseña.";
            }
        }
    if(isset($_REQUEST["registro"])){
        if($_REQUEST["registro"]=="ok"){
            echo '<div style="background-color:#A9F5A9;"><h3>Has compleado de forma correcta el regitro, inicia session.</h3>';
        }
    }
    if(isset($_SESSION["edi"])){
        if($_SESSION["edi"]=="ok"){
            setcookie("recuperacionActiva","", time() - 3600); 
            unset($_COOKIE["recuperacionActiva"]);
            echo '<div style="background-color:#A9F5A9;"><h3>Se ha cambiado la contraseña de forma correcta.</h3>';
        }
    }
    if(isset($_REQUEST["enviado"])){
        if($_REQUEST["enviado"]=="ok"){
            echo '<div style="background-color:#A9F5A9;"><h3>Revisa tu email, para seguir con el proceso de recuperacion.</h3>';
        }
    }
    ?>
    <div style="margin:15% 0% 0% 25%;border:5pxsolid#FFFF00;">
        <form method="post" name="myform">
        <label for="usu">Email: </label> <input type="text" name="email"><?if (isset($_SESSION["errormail"])){echo $_SESSION["errormail"];}?>
        <label for="pass">Password: </label> <input type="password" name="contra"><?if (isset($_SESSION["errorcontra"])){echo $_SESSION["errorcontra"];}?>
        Recordar<input type="checkbox" name="recordar" id="recordar"><button type="submit" value="true" name="iniciar">Inicicar.</button> 
        <button type="submit" value="true" name="registrarse">Registrarse.</button> 
        </br>
        <p>Haz click <a href="recuperar.php">aqui</a> si has olvidado tu contraseña.</p>
        </form>
    </div>
    <?php
    }
} 
?>
