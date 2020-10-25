<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$usuarios=array("mohamoha144@gmail.com"=>"moha","javi@gmail.com"=>"javipuit","noelia@gmail.com"=>"noelia","rosa@gmail.com"=>"rosa","andreu@gmail.com"=>"andreu");
    //verificar($session,$_REQUEST["email"],$_REQUEST["contra"]);
    if (empty($_REQUEST["email"]) && empty($_REQUEST["contra"])){
        echo"en auten";die;
        header('Location: login.php?error=a1');
    }else {
        $_SESSION["control"]=FALSE;
        $_SESSION["email"]=test_input($_REQUEST["email"]);
        $_SESSION["contra"]=test_input($_REQUEST["contra"]);
        if (!filter_var($_SESSION["email"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["errormail"]="Correo no valido.";
        }
        if (!preg_match("/^[a-zA-Z1-9' ]*$/",$_SESSION["contra"])) {
            $_SESSION["errorcontra"]= "Solo se permite letras y numeros como contrasñea.";
          }
        foreach($usuarios as $uss => $pass){
            if ($_SESSION["email"]== $uss && $_SESSION["contra"] == $pass){
                echo $uss; echo $pass;
                $_SESSION["control"]==TRUE;
            }
        }
        header('Location: privada.php'); 
    } 

?>
