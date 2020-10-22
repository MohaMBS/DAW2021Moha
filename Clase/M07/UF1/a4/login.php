<?php
session_start();
$errormail="";
$errorcontra="";

if(!isset($_COOKIE["datos"]) || $_COOKIE["datos"]=="no"){
    echo'<form action="" method="post">
        <h3>Acceptas nuestras coockies?</h3>
        <input type="radio" name="aceptadocookie" value="si">
        <label for="aceptadocookie">Si.</label><br>
        <input type="radio" name="aceptadocookie" value="no">
        <label for="aceptadocookie">No.</label><br>
        <button type="submit">Inicicar.</button>
    </form>';
    if ($_SERVER["REQUEST_METHOD"]== "POST"){
        if ($_REQUEST["aceptadocookie"]=="no"){
            header('location: www.google.com');
        }else{
            setcookie("datos","si", time() + 86400 * 30);
        }
    }
}else{
    if ($_SERVER["REQUEST_METHOD"]== "POST"){
        include ("auten.php");
    }
    if (isset($_REQUEST["error"])==1 ){
    echo "Error de usuario o contraseña.";
    }
    ?>
    <form action="" method="post" name="myform">
    <label for="usu">Email: </label> <input type="text" name="email"><?=$errormail;?> 
    <label for="pass">Password: </label> <input type="password" name="contra"><?=$errorcontra;?> 
    <button type="submit">Inicicar.</button>
    </form>
    <?php
} 
    ?>
