<?php 
include("funciones.php");
    echo '</br><strong style="color:red;">Debe de cambiar las password<strong>';
    if($_SERVER["REQUEST_METHOD"]== "POST"){
        if(isset($_REQUEST["pass1"]) && isset($_REQUEST["pass2"])){
            if($_REQUEST["pass1"] == $_REQUEST["pass2"]){
                if (!preg_match("/^[a-zA-Z0-9' ]*$/",$_REQUEST["pass1"])) {
                    $_SESSION["passnwwError"].= "Solo se permite letras y numeros como contrasñea.";
                }else{
                    cambiarpass(md5($_REQUEST["pass1"]),$_SESSION["emailSession"],"noauto");
                    header("location: index.php");
                }
            }else{
                $_SESSION["passnwwError"]="     ------------>la password no son las mismas.<--------------";
            }
        }
    }
    echo $_SESSION["passnwwError"];
?>
<form method="post" name="myform">
    <label>Nova pass</label>
    <input type="password" name="pass1" id=""></br>
    <label>Confirm pass</label><input type="password" name="pass2" id="">
    <input type="submit" value="Guardar">
</form>
<?php

?>