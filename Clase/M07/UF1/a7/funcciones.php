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

function recuperacionPass($email,$pass,$token){
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
          $sql2 = "UPDATE recuperacionUser SET usado=1 WHERE token_user='$token'";
          $baseDatos->query($sql2);
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

function ProductosUs($userRegsitrado="no",$idUs="null",$accion="ver",$rol="user"){ 
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5'); 
  $listaProductos=(null);
  if ($baseDatos->connect_error ){
    die ("FALLO AL CONNECTAR". $conn->connect_error);
  }
  if($userRegsitrado==true){
    $sql="SELECT productes.nom,productes.descripcio,imatges.ruta,productes.preu,productes.id FROM imatges INNER JOIN productes on productes.id = imatges.id_producto";
  }else{
    if($rol="admin"){
      $sql="SELECT productes.nom,productes.descripcio,imatges.ruta,productes.preu,productes.id FROM imatges INNER JOIN productes on productes.id = imatges.id_producto";
    }else{
      if ($idUs!="null"){
        $sql="SELECT productes.nom,productes.descripcio,imatges.ruta,productes.preu,productes.id FROM imatges INNER JOIN productes on productes.id = imatges.id_producto WHERE productes.id_usuari=$idUs";
      }else{
        $sql="SELECT productes.nom,productes.descripcio,imatges.ruta,productes.preu,productes.id FROM imatges INNER JOIN productes on productes.id = imatges.id_producto";
      }
    }
  }
  if (!$datos = $baseDatos->query($sql)){
    die ("error al relizar la consulta ".$baseDatos->error);
  }
  if ($datos->num_rows>0){
    while ($usuari = $datos->fetch_assoc()){
      if($userRegsitrado=="si"){
        if(Stock($usuari["id"])==true){
          $listaProductos.="<tr><td>".$usuari["nom"]."</td>"."<td>".$usuari["descripcio"]."</td>"."<td> <img src='".$usuari["ruta"]."'></td>"."<td>".$usuari["preu"]."€"."</td>"."<td>".SaberCate($usuari["id"])."</td>".'<td><input type="checkbox" name="carrito[]" value="'.$usuari["id"].'">
          <label for="carrito">Guardar en carrito.</label></td>'."</tr>";
        }else{
          $listaProductos.="<tr><td>".$usuari["nom"]."</td>"."<td>".$usuari["descripcio"]."</td>"."<td> <img src='".$usuari["ruta"]."'></td>"."<td>".$usuari["preu"]."€"."</td>"."<td>".SaberCate($usuari["id"])."</td>".'<td> <small style="color:red;">Fuera de stock</small></td>'."</tr>";
        }
        
      }else{
        if ($accion=="ver" ){
          if(Stock($usuari["id"])==true){
            $listaProductos.="<tr><td>".$usuari["nom"]."</td>"."<td>".$usuari["descripcio"]."</td>"."<td> <img src='".$usuari["ruta"]."'></td>"."<td>".$usuari["preu"]."€"."</td>"."<td>".SaberCate($usuari["id"])."</td>".'<td> <small style="color:green;">Disponible.</small></td>'."</tr>";
          }else{
            $listaProductos.="<tr><td>".$usuari["nom"]."</td>"."<td>".$usuari["descripcio"]."</td>"."<td> <img src='".$usuari["ruta"]."'></td>"."<td>".$usuari["preu"]."€"."</td>"."<td>".SaberCate($usuari["id"])."</td>".'<td> <small style="color:red;">Fuera de stock</small></td>'."</tr>";
          }
        }else{
          if(Stock($usuari["id"])==true){
            $listaProductos.="<tr><td>".$usuari["nom"]."</td>"."<td>".$usuari["descripcio"]."</td>"."<td> <img src='".$usuari["ruta"]."'></td>"."<td>".$usuari["preu"]."€"."</td>"."<td>".$usuari["id"]."</td>"."<td>".SaberCate($usuari["id"])."</td>".'<td><a style="color: red;" name="deleteId" href="eliminarp.php?delete='.$usuari["id"].'">Borrar</a>'.'<td><a style="color: green;" name="ediId" href="eliminarp.php?edit='.$usuari["id"].'">Edit</a>'."</td>"."</tr>";  
          }else{
            $listaProductos.="<tr><td>".$usuari["nom"]."</td>"."<td>".$usuari["descripcio"]."</td>"."<td> <img src='".$usuari["ruta"]."'></td>"."<td>".$usuari["preu"]."€"."</td>"."<td>".$usuari["id"]."</td>"."<td>".SaberCate($usuari["id"])."</td>".'<td>Vendido'."</td>"."</tr>";
          }
        }
      } 
    }
  }else{
    $listaProductos=false;
  }
  return $listaProductos;
  $baseDatos->close();
}

function BuscarPro($nom="",$userRegsitrado=false,$idPro=""){ 
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5'); 
  $listaProductos=(null);
  if ($baseDatos->connect_error ){
    die ("FALLO AL CONNECTAR". $conn->connect_error);
  }
  if($userRegsitrado==true){
    $sql="SELECT productes.nom, productes.descripcio, imatges.ruta,productes.preu, productes.id,categorias.nom as nomc from imatges INNER JOIN productes on productes.id=imatges.id_producto INNER JOIN categoriaProducto on categoriaProducto.id_producto=productes.id INNER JOIN categorias on categorias.id=categoriaProducto.id_categoria WHERE productes.id =$idPro";
  }else{
    $sql="SELECT productes.nom, productes.descripcio, imatges.ruta,productes.preu, productes.id,categorias.nom as nomc from imatges INNER JOIN productes on productes.id=imatges.id_producto INNER JOIN categoriaProducto on categoriaProducto.id_producto=productes.id INNER JOIN categorias on categorias.id=categoriaProducto.id_categoria WHERE productes.nom like '%".$nom."%' or productes.descripcio like '%".$nom."%' or categorias.nom like '%".$nom."%'";
  }
  if (!$datos = $baseDatos->query($sql)){
    die ("error al relizar la consulta ".$baseDatos->error);
  }
  if ($datos->num_rows>0){
    while ($usuari = $datos->fetch_assoc()){
      if($userRegsitrado==true){
        $listaProductos.='<tr style="background-color:grey;"><td>'.$usuari["nom"]."</td>"."<td>".$usuari["descripcio"]."</td>"."<td> <img src='".$usuari["ruta"]."'></td>"."<td>".$usuari["preu"]."€"."</td>"."<td>".$usuari["nomc"]."</td><td><a href=\"bc.php?id=".$idPro."\">Borrar</a></td></tr>";
      }else{
        $listaProductos.='<tr style="background-color:grey;"><td>'.$usuari["nom"]."</td>"."<td>".$usuari["descripcio"]."</td>"."<td> <img src='".$usuari["ruta"]."'></td>"."<td>".$usuari["preu"]."€"."</td>"."<td>".$usuari["nomc"]."</td></tr>";  
      }
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
  $baseDatos->close();
  return $resultado;
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

function buscarNombre($idPro){
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5'); 
  $sql="SELECT nom FROM productes where id=$idPro";
  if (!$datos = $baseDatos->query($sql)){
    die ("error al relizar la consulta ".$baseDatos->error);
  }
  if ($datos->num_rows>0){
      while ($usuari = $datos->fetch_assoc()){
        $res=$usuari["nom"];
      }
  }
  $baseDatos->close();
  return $res;
}
function buscarPrecio($idPro){
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5'); 
  $sql="SELECT preu FROM productes where id=$idPro";
  if (!$datos = $baseDatos->query($sql)){
    die ("error al relizar la consulta ".$baseDatos->error);
  }
  if ($datos->num_rows>0){
      while ($usuari = $datos->fetch_assoc()){
        $res=$usuari["preu"];
      }
  }
  $baseDatos->close();
  return $res;
}
function registrarCompra($idPro,$idUser){
  $resultado=false;
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5'); 
  $precio=buscarPrecio($idPro);
  $nom=buscarNombre($idPro);
  $cp=$_SESSION["identificadorCompraPrivada"];
  $cpu=$_SESSION["identificadorCompraPublica"];
  if ($baseDatos->connect_error ){
    die ("FALLO AL CONNECTAR". $conn->connect_error);
  }
  $sql="INSERT INTO comprasRelizadas (id_producto_c,id_usuari_c, data,hora, preu, nom, id_compra_privada, id_compra_publica) VALUES ($idPro, $idUser, CURRENT_DATE(),CURRENT_TIME(),$precio,'$nom', '$cp','$cpu')";
  if ($baseDatos->query($sql) === TRUE) {
    $resultado=true;
  } else {
    $resultado=false;
  }
  $baseDatos->close();
  return $resultado;
}

function Stock ($idPro){
  $res=false;
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5'); 
  $sql="SELECT * FROM comprasRelizadas where id_producto_c = $idPro";
  if (!$datos = $baseDatos->query($sql)){
    die ("error al relizar la consulta ".$baseDatos->error);
  }
  if ($datos->num_rows==0){
      $res=true;
  }
  $baseDatos->close();
  return $res;
}

function noRepetirToken($token){
  $res=false;
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
  $sql="SELECT email_us FROM recuperacionUser WHERE token_user='$token'";
  if (!$datos = $baseDatos->query($sql)){
    die ("error al relizar la consulta ".$baseDatos->error);
  }
  if ($datos->num_rows==0){
    $res=true;
  }
  $baseDatos->close();
  return $res;
}


function temps($fecha){
  $res=0;
  $dataActual=date("Y-m-d H:i:s");
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
  $sql="SELECT TIMESTAMPDIFF(MINUTE,'$fecha','$dataActual') as date_difference";
  if (!$datos = $baseDatos->query($sql)){
    die ("error al relizar la consulta ".$baseDatos->error);
  }
  if (!$datos = $baseDatos->query($sql)){
    die ("error al relizar la consulta ".$baseDatos->error);
  }
  if ($datos->num_rows==1){
    while ($usuari = $datos->fetch_assoc()){
      $res=$usuari["date_difference"];
    }
  }
  return $res;
}

function permisoRecuperacion($token,$email,$hora=false){
  $res=false;
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
  if($hora==false){
    $sql="SELECT * FROM recuperacionUser WHERE token_user='$token' and email_us ='$email'";  
  }else{
    $sql="SELECT fecha FROM recuperacionUser WHERE token_user='$token' and email_us ='$email' and usado=0";
  }
  if (!$datos = $baseDatos->query($sql)){
    die ("error al relizar la consulta ".$baseDatos->error);
  }
  if ($datos->num_rows==1){
    if($hora==false){
      $res=true;
    }else{
      while ($usuari = $datos->fetch_assoc()){
        $hora=$usuari["fecha"];
        if(temps($hora)>120){
          $res=false;
        }else{
          $res=true;
        }
      }
    }
  }
  $baseDatos->close();
  return $res;
}

function guardarRecuperacion($email,$token){
  $resultado=false;
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
  $sql="INSERT INTO recuperacionUser (email_us, token_user, fecha) VALUES ('$email', '$token', CURRENT_TIMESTAMP)";
  if ($baseDatos->connect_error ){
    die ("FALLO AL CONNECTAR". $conn->connect_error);
  }
  if ($baseDatos->query($sql) === TRUE) {
    $resultado=true;
  } else {
    $resultado=false;
  }
  $baseDatos->close();
  return $resultado;
}

function registroCompraFallida($idUss,$idPro){
  $resultado=false;
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
  $precio=buscarPrecio($idPro);
  $nom=buscarNombre($idPro);
  $ko=$_SESSION["identificadorCompraPrivadaKo"];
  $priv=$_SESSION["identificadorCompraPrivada"];
  $pub=$_SESSION["identificadorCompraPublica"];
  $sql="INSERT INTO comprasFallidas(id_usuari_f, id_producto_f,precio_pro, clavePublica, clavePrivada, clave_f, dataF) VALUES ($idUss,$idPro,$precio,'$pub','$priv','$ko',CURRENT_TIMESTAMP)";
  if ($baseDatos->connect_error ){
    die ("FALLO AL CONNECTAR". $conn->connect_error);
  }
  if ($baseDatos->query($sql) === TRUE) {
    $resultado=true;
  } else {
    $resultado=false;
  }
  $baseDatos->close();
  return $resultado;
}

function comprovarIdPrivado($token){
  $res=false;
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
  $sql="SELECT * FROM `comprasRelizadas` WHERE id_compra_privada='$token'";
  if (!$datos = $baseDatos->query($sql)){
    die ("error al relizar la consulta ".$baseDatos->error);
  }
  if ($datos->num_rows==1){
    $res=true;
  }
  $baseDatos->close();
  return $res;
}

function comprovarVentas($tabla,$ganado=false){
  $x;
  $dinero=0;
  $listaProductos=(null);
  $baseDatos = new mysqli('localhost', 'mboughima', 'mboughima', 'mboughima_a5');
  if ($tabla=="fallidas"){
    $sql="SELECT * FROM `comprasFallidas`";
  }else if($tabla=="correctas") {
    $sql="SELECT 	id_producto_c,	id_usuari_c,hora,preu,nom,	id_compra_privada,	id_compra_publica FROM `comprasRelizadas`";
  }
  if (!$datos = $baseDatos->query($sql)){
    die ("error al relizar la consulta ".$baseDatos->error);
  }
  if ($datos->num_rows>0){
    while ($usuari = $datos->fetch_assoc()){
      if($ganado==true){
        $dinero+=$usuari["preu"];
      }else{
        if($tabla=="correctas"){
          $listaProductos.='<tr>'.'<td>'.$usuari["id_producto_c"].'</td>'.'<td>'.$usuari["id_usuari_c"].'</td>'.'<td>'.$usuari["hora"].'</td>'.'<td>'.$usuari["preu"].'</td>'.'<td><small>'.$usuari["nom"].'</small></td>'.'<td><small>'.$usuari["id_compra_privada"].'</small></td>'.'<td><small>'.$usuari["id_compra_publica"].'</small></td>'.'</tr>';
        }
        else if ($tabla=="fallidas"){
          $listaProductos.='<tr>'.'<td>'.$usuari["id_producto_f"].'</td>'.'<td>'.$usuari["id_usuari_f"].'</td>'.'<td>'.$usuari["dataF"].'</td>'.'<td>'.$usuari["precio_pro"].'</td>'.'<td><small>'.$usuari["clavePrivada"].'</small></td>'.'<td><small>'.$usuari["clavePublica"].'</small></td>'.'<td><small>'.$usuari["clave_f"].'</small></td>'.'</tr>';
        }
      }
    }
  }
  if($ganado==true){
    $x=$dinero;
  }else{
    $x=$listaProductos;
  }
  return $x;
}

function buscadorLista($lista,$valor){
  $pos = strrpos($lista, $valor);
  return $pos;
}
?>