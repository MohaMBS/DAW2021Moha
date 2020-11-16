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

function IdUss($email){
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
  $usId=-1;
  if ($baseDatos->connect_error ){
      die ("FALLO AL CONNECTAR". $conn->connect_error);
  }
  $sql ="SELECT id FROM usuaris WHERE email='$email'";
  if (!$datos = $baseDatos->query($sql)){
      die ("error al relizar la consulta ".$baseDatos->error);
  }
  if ($datos->num_rows>=0){
      while ($usuari = $datos->fetch_assoc()){
        $usId=$usuari["id"];
      }
  }return $usId;
  $baseDatos->close();
}

function ProductosUs($idUs="null",$accion="ver",$rol="user"){ 
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5'); 
  $listaProductos=(null);
  if ($baseDatos->connect_error ){
    die ("FALLO AL CONNECTAR". $conn->connect_error);
  }
  if($rol="admin"){
    $sql="SELECT productes.nom,productes.descripcio,imatges.ruta,productes.preu,productes.id FROM imatges INNER JOIN productes on productes.id = imatges.id_producto";
  }else{
    if ($idUs!="null"){
      $sql="SELECT productes.nom,productes.descripcio,imatges.ruta,productes.preu,productes.id FROM imatges INNER JOIN productes on productes.id = imatges.id_producto WHERE productes.id_usuari=$idUs";
    }else{
      $sql="SELECT productes.nom,productes.descripcio,imatges.ruta,productes.preu,productes.id FROM imatges INNER JOIN productes on productes.id = imatges.id_producto";
    }
  }
  if (!$datos = $baseDatos->query($sql)){
    die ("error al relizar la consulta ".$baseDatos->error);
  }
  if ($datos->num_rows>0){
    while ($usuari = $datos->fetch_assoc()){
      if ($accion=="ver"){
        $listaProductos.="<tr><td>".$usuari["nom"]."</td>"."<td>".$usuari["descripcio"]."</td>"."<td> <img src='".$usuari["ruta"]."'></td>"."<td>".$usuari["preu"]."€"."</td>"."<td>".SaberCate($usuari["id"])."</td></tr>";
      }else{
        $listaProductos.="<tr><td>".$usuari["nom"]."</td>"."<td>".$usuari["descripcio"]."</td>"."<td> <img src='".$usuari["ruta"]."'></td>"."<td>".$usuari["preu"]."€"."</td>"."<td>".$usuari["id"]."</td>"."<td>".SaberCate($usuari["id"])."</td>".'<td><a style="color: red;" name="deleteId" href="eliminarp.php?delete='.$usuari["id"].'">Borrar</a>'.'<td><a style="color: green;" name="ediId" href="eliminarp.php?edit='.$usuari["id"].'">Edit</a>'."</td>"."</tr>";  
      } 
    }
  }else{
    $listaProductos=false;
  }
  return $listaProductos;
  $baseDatos->close();
}

function BuscarPro($nom){ 
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5'); 
  $listaProductos=(null);
  if ($baseDatos->connect_error ){
    die ("FALLO AL CONNECTAR". $conn->connect_error);
  }
  $sql="SELECT productes.nom, productes.descripcio, imatges.ruta,productes.preu, productes.id,categorias.nom as nomc from imatges INNER JOIN productes on productes.id=imatges.id_producto INNER JOIN categoriaProducto on categoriaProducto.id_producto=productes.id INNER JOIN categorias on categorias.id=categoriaProducto.id_categoria WHERE productes.nom like '%".$nom."%' or productes.descripcio like '%".$nom."%' or categorias.nom like '%".$nom."%'";
  if (!$datos = $baseDatos->query($sql)){
    die ("error al relizar la consulta ".$baseDatos->error);
  }
  if ($datos->num_rows>0){
    while ($usuari = $datos->fetch_assoc()){
      $listaProductos.='<tr style="background-color:grey;"><td>'.$usuari["nom"]."</td>"."<td>".$usuari["descripcio"]."</td>"."<td> <img src='".$usuari["ruta"]."'></td>"."<td>".$usuari["preu"]."€"."</td>"."<td>".$usuari["nomc"]."</td></tr>";
    }
  }else{
    $listaProductos=false;
  }
  return $listaProductos;
  $baseDatos->close();
}

function EliminiarPro($idProEliminar){
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5'); 
  if ($baseDatos->connect_error ){
    die ("FALLO AL CONNECTAR". $conn->connect_error);
  }
  $sql="DELETE FROM `productes` WHERE `productes`.`id` = $idProEliminar";
  if ($baseDatos->query($sql) === TRUE) {
    header("location: productos.php?estado=01");
  }else{
    header("location: productos.php?estado=001");
  }
  $baseDatos->close();
}

function ProductoAlta($nomPro,$desPro,$preP,$idUss){
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5'); 
  if ($baseDatos->connect_error ){
    die ("FALLO AL CONNECTAR". $conn->connect_error);
  }
  $sql="INSERT INTO `productes`(`id`, `nom`, `descripcio`, `preu`, `id_usuari`) VALUES (NULL,'$nomPro','$desPro','$preP',$idUss)";
  if ($baseDatos->query($sql) === TRUE) {
    $idCreada=$baseDatos->insert_id;
  } else {
    die ("Error: " . $sql . "<br>" . $baseDatos->error);
  }
  return  $idCreada;
  $baseDatos->close();
}

function ImagenSubidaInfo($idProNuevo,$direcionSubida,$nombre){
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5'); 
  if ($baseDatos->connect_error ){
    die ("FALLO AL CONNECTAR". $conn->connect_error);
  }
  $sql="INSERT INTO `imatges` (`id`, `nom`, `ruta`, `id_producto`) VALUES (NULL, '$nombre', '$direcionSubida', '$idProNuevo')";
  if ($baseDatos->query($sql) === TRUE) {
  } else {
    die ("Error Imagen info: " . $sql . "<br>" . $baseDatos->error);
  }
  return  $baseDatos->insert_id;
  $baseDatos->close();

}
function ImagenUpdateInfo($idIMG,$direcionSubida,$nombre){
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5'); 
  if ($baseDatos->connect_error ){
    die ("FALLO AL CONNECTAR". $conn->connect_error);
  }
  $sql="UPDATE `imatges` SET `nom` = '$nombre' , ruta='$direcionSubida'  WHERE `imatges`.`id_producto` = $idIMG ";
  if ($baseDatos->query($sql) === TRUE) {
  } else {
    die ("Error Imagen info: " . $sql . "<br>" . $baseDatos->error);
  }
  return  $baseDatos->insert_id;
  $baseDatos->close();

}

function CNom($idPro,$Nnom){
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5'); 
  $resultado=false;
  if ($baseDatos->connect_error ){
    die ("FALLO AL CONNECTAR". $conn->connect_error);
  }
  $sql="UPDATE `productes` SET `nom` = '$Nnom' WHERE `productes`.`id` = $idPro";
  if ($baseDatos->query($sql) === TRUE) {
    $resultado=true;
  } else {
    die ("Error: " . $sql . "<br>" . $baseDatos->error);
  }
  return $resultado;
  $baseDatos->close();
}

function CDes($idPro,$NDes){
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5'); 
  $resultado=false;
  if ($baseDatos->connect_error ){
    die ("FALLO AL CONNECTAR". $conn->connect_error);
  }
  $sql="UPDATE `productes` SET `descripcio` = '$NDes' WHERE `productes`.`id` =$idPro ";
  if ($baseDatos->query($sql) === TRUE) {
    $resultado=true;
  } else {
    die ("Error: " . $sql . "<br>" . $baseDatos->error);
  }
  return $resultado;
  $baseDatos->close();
}

function CPreu($idPro,$NPreu){
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5'); 
  $resultado=false;
  if ($baseDatos->connect_error ){
    die ("FALLO AL CONNECTAR". $conn->connect_error);
  }
  $sql="UPDATE `productes` SET `preu` = '$NPreu' WHERE `productes`.`id` =$idPro ";
  if ($baseDatos->query($sql) === TRUE) {
    $resultado=true;
  } else {
    die ("Error: " . $sql . "<br>" . $baseDatos->error);
  }
  return $resultado;
  $baseDatos->close();
}

function AsignarCategoria($idCat,$idPro){
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5'); 
  if ($baseDatos->connect_error ){
    die ("FALLO AL CONNECTAR". $conn->connect_error);
  }
  $sql="INSERT INTO `categoriaProducto` (`id_categoria`, `id_producto`) VALUES ($idCat, $idPro)";
  if ($baseDatos->query($sql) === TRUE) {
    header ("location= ?estado=01");
  } else {
    die ("Error: " . $sql . "<br>" . $baseDatos->error);
  }
  $baseDatos->close();
}

// function BuscarProCat($idCat){
//   $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5'); 
//   $resultado=(null);
//   $sql="SELECT productes.nom,productes.descripcio,productes.preu,productes.id,categorias.nom as nomc FROM categorias INNER JOIN productes WHERE categorias.id=$idCat";
//   if (!$datos = $baseDatos->query($sql)){
//     die ("error al relizar la busquedas por categorias BuscarProCat()".$baseDatos->error);
//   }
//   if ($datos->num_rows>0){
//     while ($usuari = $datos->fetch_assoc()){
//       $resultado.='<tr>'.'<td>'.$usuari["nom"].'</td>'.'<td>'.$usuari["nom"].'</td>'.'<td>'.'</td>'.'<td>'.'</td>'.'<td>'.'</td>'.'<td>'.'</td>'.'<td>'.'</td>'.'<td>'.'</td>'.'</tr>'
//     }
//   }
//   return $resultado;
// }

function SaberCate($idPro=""){
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
  $usId=-1;
  if ($baseDatos->connect_error ){
      die ("FALLO AL CONNECTAR". $conn->connect_error);
  }
  $sql ="SELECT categorias.nom FROM categorias INNER JOIN categoriaProducto on categoriaProducto.id_categoria=categorias.id WHERE categoriaProducto.id_producto=$idPro";
  if (!$datos = $baseDatos->query($sql)){
      die ("error al relizar la consulta categorias nom".$baseDatos->error);
  }
  if ($datos->num_rows>0){
      while ($usuari = $datos->fetch_assoc()){
        $usId=$usuari["nom"];
      }
  }return $usId;
  $baseDatos->close();
}

function SubirImgPro(){
  if (isset($_FILES)){
    $direActual='imatges/'.IdUss($_SESSION["email"]);
    if (!file_exists($direActual)){
        mkdir("imatges/" . IdUss($_SESSION["email"]), 0777);
    }
    $dir_subida = 'imatges/'.IdUss($_SESSION["email"]).'/';
    $fichero_subido = $dir_subida . basename($_FILES['imagenp']['name']);
    $imageFileType = strtolower(pathinfo($fichero_subido,PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
    }else{
        if (move_uploaded_file($_FILES['imagenp']['tmp_name'], $fichero_subido)) {
          return $dir_subida.basename($_FILES['imagenp']['name']);
        }
    }
  }

  function IdImagenPr($IdImg){
    $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
    $usId=-1;
    if ($baseDatos->connect_error ){
        die ("FALLO AL CONNECTAR". $conn->connect_error);
    }
    $sql ="SELECT id FROM `imatges` WHERE id_producto=$IdImg";
    if (!$datos = $baseDatos->query($sql)){
        die ("error al relizar la consulta ".$baseDatos->error);
    }
    if ($datos->num_rows>=0){
        while ($usuari = $datos->fetch_assoc()){
          $usId=$usuari["id"];
        }
    }return $usId;
    $baseDatos->close();
  }
}

function Cambiar($idPro,$idCat){
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5'); 
  if ($baseDatos->connect_error ){
    die ("FALLO AL CONNECTAR". $conn->connect_error);
  }
  $sql="UPDATE `categoriaProducto` SET `id_categoria`=$idCat where id_producto=$idPro";
  if ($baseDatos->query($sql) === TRUE) {
    header ("location= ?estado=01");
  } else {
    die ("Error: " . $sql . "<br>" . $baseDatos->error);
  }
  $baseDatos->close();
}

function PropitarioPro($idUs,$idPro){
  $resultado=false;
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5'); 
  $sql="SELECT * FROM `productes` WHERE id=$idPro and id_usuari=$idUs";
  if(!$datos = $baseDatos->query($sql)){
    die("Error al ejecujtar la funcion de PropitarioPro, el resultado genera es mensaje: ".$baseDatos->error);
  }
  if ($datos->num_rows==1){
    $resultado=true;
  }
  return $resultado;
  $baseDatos->close();
}
?>