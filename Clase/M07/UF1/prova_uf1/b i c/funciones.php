<?php 
session_start();
function autenticacion ($email,$pass){
    $res=false;
    $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_uf1prova');
    if ($baseDatos->connect_error ){
        die ("FALLO AL CONNECTAR". $baseDatos->connect_error);
    }
    $control ="SELECT * FROM usuaris_examen where username='$email' and password='$pass'";
    if (!$datos = $baseDatos->query($control)){
        die ("error al relizar la consulta".$baseDatos->error);
    }
    if ($datos->num_rows == 1){
        $res=true;
    }else{
        $res=false;
    }
    $baseDatos->close();
    return $res;
}

function home(){
    $email=$_SESSION["emailSession"];
    $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_uf1prova');
    $listaUusuarios=(null);
    if ($baseDatos->connect_error ){
        die ("FALLO AL CONNECTAR". $conn->connect_error);
    }
    $sql ="SELECT nom FROM usuaris_examen Where username='$email'";
    if (!$datos = $baseDatos->query($sql)){
        die ("error al relizar la consulta".$baseDatos->error);
    }
    if ($datos->num_rows>0){
        while ($usuari = $datos->fetch_assoc()){
            $listaUusuarios.=$usuari["nom"];
        }
    }
    $datos->free();
    return $listaUusuarios;
}

function randomPassword($longi=99,$hard=false) {
    if($hard==false){
      $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    }else if ($hard==true){
      $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789@#)(¡¿!";
    }
    $pass=("");
    for ($i = 0; $i < $longi; $i++) {
        $n = rand(0, strlen($alphabet)-1);
        $pass.= $alphabet[$n];
    }
    return $pass;
}

function cambiarpass($newpass,$email,$forma="auto"){
    $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_uf1prova');
    if ($baseDatos->connect_error ){
        die ("FALLO AL CONNECTAR". $conn->connect_error);
    }
    if($forma=="auto"){
        $sql="UPDATE `usuaris_examen` SET password='$newpass', nueva=1 WHERE username = '$email'";
    }else{
        $sql="UPDATE `usuaris_examen` SET password='$newpass', nueva=0 ,usoNewPass =0 WHERE username = '$email'";
    }
    if ($baseDatos->query($sql) === TRUE) {
        $res=true;
    }else{
        $res=false;
    }
    $baseDatos->close();
    return $res;
}

function updateEstadoPass($email){
    $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_uf1prova');
    if ($baseDatos->connect_error ){
        die ("FALLO AL CONNECTAR". $conn->connect_error);
    }
    $sql="UPDATE `usuaris_examen` SET usoNewPass=1 and nueva=1 WHERE username = '$email'";
    if ($baseDatos->query($sql) === TRUE) {
        $res=true;
    }else{
        $res=false;
    }
    $baseDatos->close();
    return $res;
}

function cambiopass($plus="old"){
    $res=true;
    $email=$_SESSION["emailSession"];
    $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_uf1prova');
    if ($baseDatos->connect_error ){
        die ("FALLO AL CONNECTAR". $conn->connect_error);
    }
    if($plus == "old"){
        $sql ="SELECT nom FROM usuaris_examen Where username='$email' and nueva=0 ";
    }else{
        $sql ="SELECT nom FROM usuaris_examen Where username='$email' and nueva=0 and usoNewPass =0";
    }
    if (!$datos = $baseDatos->query($sql)){
        die ("error al relizar la consulta".$baseDatos->error);
    }
    if ($datos->num_rows!=0){
        $res=false;
    }else{
        $res=true;
    }
    $datos->free();
    return $res;
}

?>