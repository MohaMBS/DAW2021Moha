<?php
session_start();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (!filter_var($_COOKIE["email"], FILTER_VALIDATE_EMAIL)) {
    die("filtro de email");
    $_SESSION["errormail"]="Correo no valido.";
    unset($_COOKIE["email"]);
    unset($_COOKIE["contra"]);
    header("location: login.php?error=1");
}else{
    $_SESSION["errormail"]= "";
}
if (!preg_match("/^[a-zA-Z0-9' ]*$/",$_COOKIE["contra"])) {
    $_SESSION["errorcontra"]= "Solo se permite letras y numeros como contrasñea.";
    header("location: login.php?error=1");
}else{
    $_SESSION["errorcontra"]= "";
}
?>























<!-- /* $usuarios=array("mohamoha144@gmail.com"=>"moha","javi@gmail.com"=>"javipuit","noelia@gmail.com"=>"noelia","rosa@gmail.com"=>"rosa","andreu@gmail.com"=>"andreu");
    //verificar($session,$_REQUEST["email"],$_REQUEST["contra"]);
    if (empty($_REQUEST["email"]) && empty($_REQUEST["contra"])){
        header('Location: login.php?error=1');
    }else {
        if (isset($_COOKIE["contra"])){
            $_SESSION["control"]="KO";
            $pass=sha1("moha");
            $_COOKIE["email"]=test_input($_REQUEST["email"]);
            if (!filter_var($_COOKIE["email"], FILTER_VALIDATE_EMAIL)) {
                die("filtro de email");
                $_SESSION["errormail"]="Correo no valido.";
                unset($_COOKIE["email"]);
                unset($_COOKIE["contra"]);
                header("location: login.php?error=1");
            }else{
                $_SESSION["errormail"]= "";
            }
            if (!preg_match("/^[a-zA-Z0-9' ]*$/",$_COOKIE["contra"])) {
                $_SESSION["errorcontra"]= "Solo se permite letras y numeros como contrasñea.";
                unset($_COOKIE["email"]);
                unset($_COOKIE["contra"]);
                header("location: login.php?error=1");
            }else{
                $_SESSION["errorcontra"]= "";
            }
            if ($_COOKIE["email"]=="mohamoha144@gmail.com" && $_COOKIE["email"]==$pass){
                $_SESSION["control"]="OK";
                $control="OK";
                setcookie("contra",$control, time() + 86400 * 30);
            }else{
                unset($_COOKIE["email"]);
                unset($_COOKIE["contra"]);
            }
            
        }else{
            $_SESSION["control"]="KO";
            $_SESSION["email"]=test_input($_REQUEST["email"]);
            $_SESSION["contra"]=test_input($_REQUEST["contra"]);
            if (!filter_var($_SESSION["email"], FILTER_VALIDATE_EMAIL)) {
                $_SESSION["errormail"]="Correo no valido.";
            }else{
                $_SESSION["errormail"]= "";
            }
            if (!preg_match("/^[a-zA-Z1-9' ]*$/",$_SESSION["contra"])) {
                $_SESSION["errorcontra"]= "Solo se permite letras y numeros como contrasñea.";
              }else{
                $_SESSION["errorcontra"]= "";
            }
            foreach($usuarios as $uss => $pass){
                if ($_SESSION["email"] == $uss && $_SESSION["contra"] == $pass){
                    $_SESSION["control"]="OK";
                }
            }
            header('Location: privada.php');
        }
    } 
 */ -->