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
            $listaUusuarios=$usuari["id"].$usuari["nom"].$usuari["email"].$usuari["password"].$usuari["tipoCuenta"];
        }
    }
    $datos->free();
    $baseDatos->clone();
}
function autenticacion ($email="",$pass=""){
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
    $datos->free();
    $baseDatos->clone();
}
function altaUsuario ($nom="",$email="",$pass=""){
    $pass=sha1($pass);
    $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
    $sql = "INSERT INTO usuaris (id, nom, email, password, tipoCuenta) VALUES (NULL,'$nom', '$email', '$pass','user')";
    if ($baseDatos->query($sql) === TRUE) {
        echo "Te has registrado";
      } else {
        echo "Error: " . $sql . "<br>" . $baseDatos->error;
      }

}
function editarNombre($nombre=""){
    $conn = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
    $email=$_SESSION["email"];
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT id FROM usuaris WHERE email='$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $id=$row["id"];
        $sql = "UPDATE usuaris SET nom='$nombre' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            header("location: editarUsuario.php?edi=ok");
          } else {
            header("location: editarUsuario.php?error=1");
          }
      }
    } else {
      header("locaion: login.php?error=2");
    }
    $conn->close();
}

function editarEmail($emailN=""){
    $conn = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
    $email=$_SESSION["email"];
    $_SESSION["email"]="$email";
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT id FROM usuaris WHERE email='$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $id=$row["id"];
        $sql = "UPDATE usuaris SET email='$emailN' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            header("location: editarUsuario.php?edi=ok");
          } else {
            header("location: editarUsuario.php?error=1");
          }
      }
    } else {
      header("locaion: login.php?error=2");
    }
    $conn->close();
}
function editarPassword($pass=""){
    $conn = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
    $email=$_SESSION["email"];
    $passC=sha1($pass);
    $_SESSION["passC"]=$passC;
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT id FROM usuaris WHERE email='$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $id=$row["id"];
        $sql = "UPDATE usuaris SET password=='$passC' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            header("location: editarUsuario.php?edi=ok");
          } else {
            header("location: editarUsuario.php?error=1");
          }
      }
    } else {
      header("locaion: login.php?error=2");
    }
    $conn->close();
}
?>