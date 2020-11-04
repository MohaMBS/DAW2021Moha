<?php
session_start();
function consultarDatos(){
    $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
    $baseDatos=$baseDatos;
    $listaUusuarios=(null);
    if ($baseDatos->connect_error ){
        die ("FALLO AL CONNECTAR". $conn->connect_error);
    }
    $sql ="SELECT * FROM usuaris";
    if (!$datos = $baseDatos->query($sql)){
        die ("error al relizar la consulta".$baseDatos->error);
    }
    if ($datos->num_rows>=0){
        while ($usuari = $datos->fetch_assoc()){
          if($usuari["tipoCuenta"]=="99"){
            $tipo="admin";
          }else{
            $tipo="user";
          }
            $listaUusuarios.="<strong>ID ususario: </strong>".$usuari["id"]." <strong>Nombre: </strong> ".$usuari["nom"]." <strong>Email: </strong> ".$usuari["email"]." <strong>Contraseña: </strong>".$usuari["password"]." <strong>Rol: </strong> ".$tipo."</br>";
        }
    }return $listaUusuarios;
    $datos->free();
    $baseDatos->clone();
}

function exsiste ($email){
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
  if ($baseDatos->connect_error ){
      die ("FALLO AL CONNECTAR". $baseDatos->connect_error);
  }
  $control ="SELECT * FROM usuaris where email='$email'";
  if (!$datos = $baseDatos->query($control)){
      die ("error al relizar la consulta".$baseDatos->error);
  }
  if ($datos->num_rows == 1){
      return true;
  }else{
      return false;
  }
  
  $baseDatos->clone();
}

function eliminar($email){
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
    if ($baseDatos->connect_error ){
        die ("FALLO AL CONNECTAR". $baseDatos->connect_error);
    }
    $control ="SELECT * FROM usuaris where email='$email'";
    if (!$datos = $baseDatos->query($control)){
        die ("error al relizar la consulta".$baseDatos->error);
    }
    $result = $baseDatos->query($control);
    if ($result->num_rows == 1){
      while ($usuari = $datos->fetch_assoc()){  
        $id=$usuari["id"];
        if($id>=0){
          $sql = "DELETE FROM usuaris WHERE id=$id";
          if ($baseDatos->query($sql) === TRUE) {
            return true;
          } else {
            die("Error al cambiar las contraseña");
          }
        }
      }
    }else{
      die("Error al cambiar las contraseña");
    }
    $baseDatos->close();
}

function autenticacion ($email,$pass){
    $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
    if ($baseDatos->connect_error ){
        die ("FALLO AL CONNECTAR". $baseDatos->connect_error);
    }
    $control ="SELECT * FROM usuaris where email='$email' and password='$pass'";
    if (!$datos = $baseDatos->query($control)){
        die ("error al relizar la consulta".$baseDatos->error);
    }
    if ($datos->num_rows == 1){
        return true;
    }else{
        return false;
    }
    
    $baseDatos->close();
}
function altaUsuario ($nom,$email,$pass,$rol="98"){
    $pass=sha1($pass);
    $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
    $sql = "INSERT INTO usuaris (id, nom, email, password, tipoCuenta) VALUES (NULL,'$nom', '$email', '$pass','$rol')";
    if ($baseDatos->query($sql) === TRUE) {
        header("location: login.php?registro=ok");
      } else {
        echo "Error: " . $sql . "<br>" . $baseDatos->error;
      }

}
function adminUser(){
  $conn = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
  $email = $_SESSION["email"];
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT id FROM usuaris WHERE email='$email'";
  $result = $conn->query($sql);  
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $id=$row["id"];
    }
  }
  $sql ="SELECT usuaris.id, rols.nom_rol FROM rols INNER JOIN usuaris on rols.id_rol = usuaris.tipoCuenta WHERE usuaris.id = $id";
  $result = $conn->query($sql); 
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $tipoCuenta=$row["nom_rol"];
    }return ($tipoCuenta);
  } else {
    header("locaion: login.php?error=2");
  }
  $conn->close();
}
function editarCuenta($nom,$emailN,$pass,$tipoUs=""){
  $conn = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
  $passC=sha1($pass);
  if ($tipoUs=="admin"){
    $email=$_SESSION["emailSuper"];
  }else{
    $email=$_SESSION["email"];
  }
  if ($conn->connect_error) {
    die("Fallo al ejecutar, recargue la pagina inical. " . $conn->connect_error);
  }
  $sql = "SELECT id FROM usuaris WHERE email='$email'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $id=$row["id"];
      $sql = "UPDATE usuaris SET nom='$nom',email='$emailN', password='$passC' WHERE id=$id";
      if ($conn->query($sql) === TRUE) {
        header("location: editarUsuario.php?edi=ok");
        } else {
          header("location: editarUsuario.php?error=1");
        }
    }
  }$conn->close();
}

function recuperacionPass($email,$pass){
  $passC=sha1($pass);
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
    if ($baseDatos->connect_error ){
        die ("FALLO AL CONNECTAR". $baseDatos->connect_error);
    }
    $control ="SELECT * FROM usuaris where email='$email'";
    if (!$datos = $baseDatos->query($control)){
        die ("error al relizar la consulta".$baseDatos->error);
    }
    $result = $baseDatos->query($control);
    if ($result->num_rows == 1){
      while ($usuari = $datos->fetch_assoc()){  
        $id=$usuari["id"];
        if($id>=0){
          $sql = "UPDATE usuaris SET password='$passC' WHERE id=$id";
          if ($baseDatos->query($sql) === TRUE) {
            header("location: login.php?edi=ok");
          } else {
            die("Error al cambiar las contraseña");
          }
        }
      }
    }else{
      die("Error al cambiar las contraseña");
    }
    $baseDatos->close();
}
?>