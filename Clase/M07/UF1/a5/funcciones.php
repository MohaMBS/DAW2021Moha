<?php
function consultarDatos($baseDatos=""){
    //$baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
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
}
?>