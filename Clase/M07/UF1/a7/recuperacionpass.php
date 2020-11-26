<?php
include ("./funcciones.php");
$_SESSION["errorPass"]= "";
if ($_SERVER["REQUEST_METHOD"]== "POST"){
        if($_POST["contraC"]==$_POST["contra"]){
            if (!preg_match("/^[a-zA-Z0-9' ]*$/",$_POST["contraC"])) {
                $_SESSION["errorPass"].= "Solo se permite letras y numeros como contrasñea.";
            }else{
                recuperacionPass($_COOKIE["email"],$_POST["contraC"],$_GET["token"]);
                estadoRecuperacion(false);
                unset($_COOKIE["emailToken"]);
                unset($_COOKIE["email"]);
                $_SESSION["edi"]="ok";
            } 
        }else{
            $_SESSION["errorPass"].= "Las contraseñas no coicieden.";
    } 
}
if($_SERVER["REQUEST_METHOD"]== "GET" || $_SERVER["REQUEST_METHOD"]== "POST"){
        if (isset($_GET["email"]) && isset($_GET["token"])){
            if(permisoRecuperacion($_GET["token"],$_GET["email"],true)){
                if (permisoRecuperacion($_GET["token"],$_GET["email"])){
                    if (filter_var($_GET["email"], FILTER_VALIDATE_EMAIL)) {
                        if (isset($_SESSION["errorPass"])){
                            echo '<h3 style="color:red;">'.$_SESSION["errorPass"].'</h3>';
                        }
                        echo '<form method="post">
                        <h3>Entroduce la nueva contraseña:</h3>
                        <input type="password" name="contra">
                        <h3>Confirme la contraseña:</h3>
                        <input type="password" name="contraC">
                        <button type="submit">Registrar.</button>
                    </form>';
                    }else{
                        header("location: login.php");
                    }
                }else{
                    echo '<h1 style="color:red;">Usted no ha solicitado ninguna recuperacion. Haga click <a href="login.php">aqui</a> para volver a inicio.</h1>';
                }   
            }else{
                echo '<h1 style="color:red;">Usted no ha solicitado ninguna recuperacion. Haga click <a href="login.php">aqui</a> para volver a inicio.</h1>';
            }
            
        }
    }else{
        echo '<h1 style="color:red;">Usted no ha solicitado ninguna recuperacion. Haga click <a href="login.php">aqui</a> para volver a inicio.</h1>';
    }
?>