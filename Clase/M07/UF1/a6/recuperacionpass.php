<?php
include ("./funcciones.php");
$_SESSION["errorPass"]= "";
if ($_SERVER["REQUEST_METHOD"]== "POST"){
    if (isset($_REQUEST["contraC"])){
        if($_REQUEST["contraC"]==$_REQUEST["contra"]){
            if (!preg_match("/^[a-zA-Z0-9' ]*$/",$_REQUEST["contraC"])) {
                $_SESSION["errorPass"].= "Solo se permite letras y numeros como contrasñea.";
            }else{
                recuperacionPass($_COOKIE["recuperacionActiva"],$_REQUEST["contraC"]);
                unset($_COOKIE["recuperacionActiva"]);
                $_SESSION["edi"]="ok";
            } 
        }else{
            $_SESSION["errorPass"].= "Las contraseñas no coicieden.";
        }
    } 
} 
if (isset($_COOKIE["recuperacionActiva"])){
    if (filter_var($_COOKIE["recuperacionActiva"], FILTER_VALIDATE_EMAIL)) {
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
}
?>