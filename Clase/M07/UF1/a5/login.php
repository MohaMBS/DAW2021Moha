<?php
session_start();
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
    ?>
    <form method="post" name="myform">
    <label for="usu">Email: </label> <input type="text" name="email"><?if (isset($_SESSION["errormail"])){echo $_SESSION["errormail"];}?>
    <label for="pass">Password: </label> <input type="password" name="contra"><?if (isset($_SESSION["errorcontra"])){echo $_SESSION["errorcontra"];}?>
    Recordar<input type="checkbox" name="recordar" id="recordar"><button type="submit" value="true" name="iniciar">Inicicar.</button> 
    <button type="submit" value="true" name="registrarse">Registrarse.</button> 
    </form>
    <?php
    }
} 





/* if ($_SERVER["REQUEST_METHOD"]== "POST"){
            if (isset($_REQUEST["recordar"])){
                $contra=sha1($_REQUEST["contra"]);
                $email=$_REQUEST["email"];
                setcookie("contra",$contra, time() + 86400 * 30);
                setcookie("email",$email, time() + 86400 * 30);
                include ("auten.php");
            }else{
                setcookie("contra",null, time() + 86400 * 30);
                setcookie("email",null, time() + 86400 * 30);
                include ("auten.php");
            }
        }
        if (isset($_REQUEST["error"]) ){
            if ($_REQUEST["error"]==1){
                echo "Error de usuario o contraseña.";
            }
        } 
=================================

$baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
        if ($baseDatos->connect_error ){
            die ("FALLO AL CONNECTAR". $conn->connect_error);
        }
        $sql ="SELECT * FROM usuaris where email='mohamoha144@gmail.com' and password='9517e4957aac995ccc075fbe352e16d4e60a1087'";
        if (!$datos = $baseDatos->query($sql)){
            die ("error al relizar la consulta".$baseDatos->error);
        }
        if ($datos->num_rows>=0){
            while ($usuari = $datos->fetch_assoc()){
                echo $usuari["id"].$usuari["nom"].$usuari["email"].$usuari["password"].$usuari["tipoCuenta"]."<br>";
            }
        }
        
*/    ?>
