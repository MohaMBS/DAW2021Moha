<?php 
include ("funcciones.php");
$_SESSION["errorEdicion"]="";
$_SESSION["msgEdi"]="";
if ($_SERVER["REQUEST_METHOD"]== "POST"){
    if(isset($_REQUEST["emailF"])){
      if($_REQUEST["emailF"]!=$_SESSION["email"]){
        if(exsiste($_REQUEST["emailF"])){
          $_SESSION["msgEdi"]="Se ha eliminado la cuenta con el siguente email: ".$_REQUEST["emailF"];
          eliminar($_REQUEST["emailF"]);
        }else{
          $_SESSION["errorEdicion"].="No se encuentra el correo que desea elimnar...";
        } 
      }else{
        $_SESSION["msgEdi"].="No no te puedes auto eliminar";
      }
    }else if(isset($_REQUEST["nom"])){
      if(isset($_REQUEST["email"])){
        if(isset($_REQUEST["contra"])){
          if($_REQUEST["contra"]==$_REQUEST["contraR"]){
            if (isset($_REQUEST["emailSuper"])){
              if(!empty($_REQUEST["emailSuper"])){
                $_SESSION["emailSuper"]=$_REQUEST["emailSuper"];
                if(!exsiste($_REQUEST["email"]) || $_REQUEST["email"]==$_REQUEST["emailSuper"]){
                  if(!$_REQUEST["email"]==""){
                    editarCuenta($_REQUEST["nom"],$_REQUEST["email"],$_REQUEST["contra"],adminUser());
                    $_SESSION["errorEdicion"]="";
                  }else{
                    $_SESSION["errorEdicion"]="Debes de introducir un email valido...";
                  }
                }else{
                  $_SESSION["errorEdicion"]="No puedes usar un correo que ya se este usando...";
                }
              }
          }else{
            if(!exsiste($_REQUEST["email"]) || $_REQUEST["email"]==$_SESSION["email"]){
              editarCuenta($_REQUEST["nom"],$_REQUEST["email"],$_REQUEST["contra"],adminUser());
              $_SESSION["email"]=$_REQUEST["email"];
              $_SESSION["errorEdicion"]="";
            }else{
              $_SESSION["errorEdicion"]="No puedes usar un correo que ya se este usando...";
            }
              
          }
        }else{
            $_SESSION["errorEdicion"]="Algun campo esta mal, escriba de nueva y fijese.";
          }
        }else{
          $_SESSION["errorEdicion"]="Algun campo esta mal, escriba de nueva y fijese.";
        }
      }else{
        $_SESSION["errorEdicion"]="Algun campo esta mal, escriba de nueva y fijese.";
      }
    }else{
      $_SESSION["errorEdicion"]="Algun campo esta mal, escriba de nueva y fijese.";
    }
}if(isset($_SESSION["passC"])){
  echo $_SESSION["passC"];
}
?>
<form method="post">
  <div class="container">
    <h1>Edicion de cuenta.</h1>
    <p>Modifique sus datos aqui abajo.</p>
    <?php 
      if (isset($_SESSION["errorEdicion"])){
        if(strlen($_SESSION["errorEdicion"])>0){
          echo '<div style="background-color:orange;">
          <p style="color:black;">'.$_SESSION["errorEdicion"].'</p> 
          </div>';
        }
      }
      if (isset($_SESSION["msgEdi"])){
        if(strlen($_SESSION["msgEdi"])>0){
          echo '<div style="background-color:green;">
          <p style="color:black;">'.$_SESSION["msgEdi"].'</p> 
          </div>';
        }
      }
      if (adminUser()=="admin"){
        echo '<div style="background-color:#A9F5A9;"><h3>Lista de usuarios</h3>
        '.consultarDatos().'</div>';
        echo '<div style="background-color:gold;"> <h3>ERES ADMIN</h3>
        <h4 style="color:red;">Si quieres modificar tus propios datos, deja este campo vacio</h4>
        <form method="post">
        <label for="email" ><b>Email del usuario que quieres editar.</b></label>
        <input type="text" placeholder="Escriba su email aqui." name="emailSuper" id="email" >
        </form></div>'.'<div style="background-color:orange;">
        <h4 style="color:red;">Seccion para eliminar:</h4>
        <form method="post">
        <label for="email" ><b>Email del usuario que quieres elimnar.</b></label>
        <input type="text" placeholder="Escriba su email aqui." name="emailF" id="email" ><input type="submit" value="Eliminar">
        </form></div>';
        ?>
        <div style="background-color:aqua;"><h4>Haz click <a href="registro.php">aqui</a> para poder dar de alta a un nuevo ususario.</h4></div>
      <?php
      };
    ?>
    <hr>
    <div style="text-align:auto">
    <label for="nombre" ><b>Nuevo nombre</b></label>
        <input type="text" placeholder="Escriba su nombre." name="nom" >
        </br>
        </br>
        <label for="email" ><b>Nuveo Email</b></label>
        <input type="text" placeholder="Escriba su email aqui." name="email" id="email" ><?if (isset($_SESSION["errormail"])){echo $_SESSION["errormail"];}?>
        </br>
        </br>
        <label for="psw"><b>Nueva Contraseña</b></label>
        <input type="password" placeholder="Escriba su contraseña aqui." name="contra" id="psw" ><?if (isset($_SESSION["errorcontra"])){echo $_SESSION["errorcontra"];}?>
        </br>
        </br>
        <label for="psw-repeat"><b>Repita contraseña</b></label>
        <input type="password" placeholder="Repeat Password" name="contraR" id="psw-repeat" ><?if (isset($_SESSION["errorcontra"])){echo $_SESSION["errorcontra"];}?>
    </div>
    <hr>

    <button type="submit" name="register">Register</button>
  </div>
  
  <div class="container signin">
    <p>Haga click <a href="privada.php" name="tengoCuenta">aquí</a> para cancelar.</p>
  </div>
</form>