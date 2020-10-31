<?php 
include ("funcciones.php");
if ($_SERVER["REQUEST_METHOD"]== "POST"){
    if(isset($_REQUEST["nom"])){
      if(isset($_REQUEST["email"])){
        if(isset($_REQUEST["contra"])){
          if($_REQUEST["contra"]==$_REQUEST["contraR"]){
            if (isset($_REQUEST["emailSuper"])){
              if(!empty($_REQUEST["emailSuper"])){
                $_SESSION["emailSuper"]=$_REQUEST["emailSuper"];
                editarNombre($_REQUEST["nom"],adminUser());
                editarEmail($_REQUEST["email"],adminUser());
                editarPassword($_REQUEST["contra"],adminUser());
                $_SESSION["errorEdicion"]="";
              }else{
                editarNombre($_REQUEST["nom"]);
                editarEmail($_REQUEST["email"]);
                editarPassword($_REQUEST["contra"]);
                $_SESSION["email"]=$_REQUEST["email"];
                $_SESSION["errorEdicion"]="";
              }
          }else{
              editarNombre($_REQUEST["nom"]);
              editarEmail($_REQUEST["email"]);
              editarPassword($_REQUEST["contra"]);
              $_SESSION["email"]=$_REQUEST["email"];
              $_SESSION["errorEdicion"]="";
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
      if (adminUser()=="admin"){
        echo '<div style="background-color:#A9F5A9;"><h3>Lista de usuarios</h3>
        '.consultarDatos().'</div>';
        echo '<div style="background-color:gold;"> <h3>ERES ADMIN</h3>
        <h4 style="color:red;">Si quieres modificar tus propios datos, deja este campo vacio</h4>
        <form method="post">
        <label for="email" ><b>Email del usuario que quieres editar.</b></label>
        <input type="text" placeholder="Escriba su email aqui." name="emailSuper" id="email" >
        </form></div>';
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