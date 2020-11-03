<?php
include ("funcciones.php");
if ($_SERVER["REQUEST_METHOD"]== "POST"){
    $_SESSION["validacion"]=0;
    if (isset($_REQUEST["register"])){
        if (isset($_REQUEST["contra"])){
            if ($_REQUEST["contra"] == $_REQUEST["contraR"]){
                if (!preg_match("/^[a-zA-Z0-9' ]*$/",$_REQUEST["contra"])) {
                    $_SESSION["errorcontra"].= "Solo se permite letras y numeros como contrasñea.";
                    header("location: registro.php");
                }else{
                    $_SESSION["errorcontra"]= "";
                    $_SESSION["validacion"]+=1;
                }  
            }else{
                $_SESSION["errorcontra"]= "Las contrasñenas son diferentes.";
            }
        }
        if (!filter_var($_REQUEST["email"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["errormail"]="Correo no valido.";
            header("location: registro.php");
        }else{
            $_SESSION["errormail"]= "";
            $_SESSION["validacion"]+=1;
        }
    }if (isset($_SESSION["validacion"])){
        if($_SESSION["validacion"]==2){
            if (!exsiste($_REQUEST["email"])){
                altaUsuario($_REQUEST["nom"],$_REQUEST["email"],$_REQUEST["contra"],$_REQUEST["rol"]);
            }else{
                echo '<div style:"background-color:gold;"><h3 style="color:red;">ESE CORREO NO SE ENCUETRA DISPONIBLE</h3></div>';
            }
        }
    }
}
?>
<form method="post">
  <div class="container">
    <h1>Registro</h1>
    <p>Rellene el formulario para continuar con el registro.</p>
    <hr>
    <div style="text-align:auto">
    <label for="nombre" ><b>Nombre</b></label>
        <input type="text" placeholder="Escriba su nombre." name="nom" required>
        </br>
        </br>
        <label for="email" ><b>Email</b></label>
        <input type="text" placeholder="Escriba su email aqui." name="email" id="email" required><?if (isset($_SESSION["errormail"])){echo $_SESSION["errormail"];}?>
        </br>
        </br>
        <label for="psw"><b>Contraseña</b></label>
        <input type="password" placeholder="Escriba su contraseña aqui." name="contra" id="psw" required><?if (isset($_SESSION["errorcontra"])){echo $_SESSION["errorcontra"];}?>
        </br>
        </br>
        <label for="psw-repeat"><b>Repita contraseña</b></label>
        <input type="password" placeholder="Repeat Password" name="contraR" id="psw-repeat" required><?if (isset($_SESSION["errorcontra"])){echo $_SESSION["errorcontra"];}?>
        </br>
        </br>
        <?php
        if(isset($_SESSION["email"])){
            if(adminUser()=="admin"){
        ?>
        <h5>Tipo de cuenta</h5>
        <label>Admin</label><input type="checkbox" name="rol" value="99"></br>
        <label> Usuario:</label><input type="checkbox" name="rol" value="98" checked>
        <?php
            }
        }
        ?>
    </div>
    <hr>

    <button type="submit" name="register">Register</button>
  </div>
  <?php 
  if(!isset($_SESSION["email"])){
  ?>
  <div class="container signin">
    <p>Already have an account? <a href="login.php" name="tengoCuenta">Sign in</a>.</p>
  </div>
  <?php
    
}
  ?>
</form>