<?php 
include ("funcciones.php");
$controlUs=true;
if (!isset($_SESSION["control"])){
    header("Location: login.php?error=1");
}else{
    if (isset($_REQUEST["edit"])){
        $_SESSION["editPro"]=$_REQUEST["edit"];
        header("location:?");
    }
    if(adminUser()=="admin" || PropitarioPro(IdUss($_SESSION["email"]),$_SESSION["editPro"])== true){
        if ($_SERVER['REQUEST_METHOD']== 'POST'){
            $error=false;
            if (isset($_FILES)){
                $direccionImgSunida=SubirImgPro();  
                if(isset($_REQUEST["nompi"])){
                    ImagenUpdateInfo($_SESSION["editPro"],$direccionImgSunida,$_REQUEST["nompi"]);
                }
                if(isset($_REQUEST["nomp"])){
                    if(!empty($_REQUEST["nomp"])){
                        CNom($_SESSION["editPro"],$_REQUEST["nomp"]);
                    }else{
                        $_SESSION["msgNom"]="*";
                        $error=true;
                    }
                }
                if(isset($_REQUEST["desp"])){
                    if(!empty($_REQUEST["desp"])){
                        CDes($_SESSION["editPro"],$_REQUEST["desp"]);
                    }else{ 
                        $_SESSION["msgDesp"]="*";
                        $error=true;
                    }
                }
                if(isset($_REQUEST["preup"])){
                    if(!empty($_REQUEST["preup"])){
                        CDes($_SESSION["editPro"],$_REQUEST["preup"]);
                    }else{ 
                        $_SESSION["msgPreu"]="*";
                        $error=true;
                    }
                }
                if(isset($_REQUEST["nompi"])){
                    if(!empty($_REQUEST["nompi"])){
                        CDes($_SESSION["editPro"],$_REQUEST["nompi"]);
                    }else{ 
                        $_SESSION["msgNomI"]="*";
                        $error=true;
                    }
                }
                if($error==true){
                    header ("location: ?alerta=0002");
                }
                if(isset($_REQUEST["categoria"])){
                    if($_REQUEST["categoria"]==1){
                        Cambiar($_SESSION["editPro"],1);
                    }else if($_REQUEST["categoria"]==2){
                        Cambiar($_SESSION["editPro"],2);
                    }else if($_REQUEST["categoria"]==3){
                        Cambiar($_SESSION["editPro"],3);
                    }else if($_REQUEST["categoria"]==4){
                        Cambiar($_SESSION["editPro"],4);
                    }
                }
            }
            
        }
    }else{
        echo '<p style="color:red;">Que cachondo quieres borrar algo que no es tuyo...</p>';
        $controlUs=false;
    }    
    if(isset($_REQUEST["delete"])){
        EliminiarPro($_REQUEST["delete"]);
    }
    if(isset($_REQUEST["alerta"])){
        if($_REQUEST["alerta"]=="0002"){
            echo '<p style="color:red;">* Campos obligatios.</p>';
        }
    }
    if($controlUs==true){

    ?>
    
    <form method="post" enctype="multipart/form-data">
    <label for="nomProducte">Nom del producte:</label> <?if (isset($_SESSION["msgNom"])){echo $_SESSION["msgNom"];}?>
    <input type="text" id="nomProducte" name="nomp">
    <label for="Descripcion">Descripcion del producto:</label>
    <textarea type="textbox" id="Descripcion" name="desp"></textarea><?if (isset($_SESSION["msgDesp"])){echo $_SESSION["msgDesp"];}?><br><br>
    <label for="preup">Preu del producte:</label> <?if (isset($_SESSION["msgPreu"])){echo $_SESSION["msgPreu"];}?>
    <input type="text" name="preup">
    <input type="radio"name="categoria" value="1">
    <label for="male">TECNOLOGIA</label>
    <input type="radio" name="categoria" value="2">
    <label for="female">COMIDA</label>
    <input type="radio" name="categoria" value="3">
    <label for="other">INTERNET</label>
    <input type="radio"name="categoria" value="4">
    <label for="other">OTRO</label></br><br>
    <input type="file" name="imagenp"></label> <?if (isset($_SESSION["msgImg"])){echo $_SESSION["msgImg"];}?>
    <label for="nomProducte">Nom de la imatge:</label> <?if (isset($_SESSION["msgNomI"])){echo $_SESSION["msgNomI"];}?>
    <input type="text" name="nompi">
    <input type="submit" value="Submit">
    </form>


    <?php
    }
}
?>
    <form action="productos.php">
        <input type="submit" value="Volver  ">
    </form>