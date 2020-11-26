<?php 
include ("funcciones.php");
if (!isset($_SESSION["control"])){
    header("Location: login.php?error=1");
}
$_SESSION["obligatorios"]=false;
if ($_SERVER['REQUEST_METHOD']== 'POST'){
    if(isset($_REQUEST["nomp"])){
        if(!empty($_REQUEST["nomp"])){
            if(isset($_REQUEST["desp"])){
                if(!empty($_REQUEST["desp"])){
                    if(isset($_REQUEST["preup"])){
                        if(!empty($_REQUEST["preup"])){
                            $idProductoSubio=ProductoAlta($_REQUEST["nomp"],$_REQUEST["desp"],$_REQUEST["preup"],IdUss($_SESSION["email"]));
                        }else{
                            $_SESSION["msgNCat"]="*";
                            $_SESSION["msgNNom"]="*";
                            $_SESSION["msgNPre"]="*";
                            $_SESSION["msgNDes"]="*";
                            $_SESSION["msgNImg"]="*";
                        }
                    }
                }else{
                    $_SESSION["msgNCat"]="*";
                    $_SESSION["msgNNom"]="*";
                    $_SESSION["msgNPre"]="*";
                    $_SESSION["msgNDes"]="*";
                    $_SESSION["msgNImg"]="*";
                }
            }
        }else{
            $_SESSION["msgNCat"]="*";
            $_SESSION["msgNNom"]="*";
            $_SESSION["msgNPre"]="*";
            $_SESSION["msgNDes"]="*";
            $_SESSION["msgNImg"]="*";
            $_SESSION["obligatorios"]=true;
        }
    }
    if(isset($_REQUEST["categoria"])){
        AsignarCategoria($_REQUEST["categoria"],$idProductoSubio);
    }
    if (isset($_FILES)){
        $direccionImgSunida=SubirImgPro();  
        if(isset($_REQUEST["nompi"])){
            if(!empty($_REQUEST["nompi"])){
                ImagenSubidaInfo($idProductoSubio,$direccionImgSunida,$_REQUEST["nompi"]);
            }else{
                $_SESSION["msgNImgNom"]="*";
            }
        }
    }else{
        $_SESSION["msgNCat"]="*";
        $_SESSION["msgNNom"]="*";
        $_SESSION["msgNPre"]="*";
        $_SESSION["msgNDes"]="*";
        $_SESSION["msgNImg"]="*";
    }
}
?>
<style>
    div{
        margin: auto;
        width: 50%;
        border: 3px solid green;
        padding: 10px;
    }
</style>
<div>
    <? if(isset($_SESSION["obligatorios"])){
        if($_SESSION["obligatorios"]=true){
            echo'<p style="color:red;">* Los campos son obligatorios.</p>';
        } }?>
    <form action="privada.php">
        <input type="submit" value="Volver">
    </form>
    <form method="post" enctype="multipart/form-data">
    <label for="nomProducte">Nom del producte:</label><?if (isset($_SESSION["msgNNom"])){echo $_SESSION["msgNNom"];}?>
    <input type="text" id="nomProducte" name="nomp">
    <label for="Descripcion">Descripcion del producto:</label></textarea><?if (isset($_SESSION["msgNDes"])){echo $_SESSION["msgNDes"];}?>
    <textarea type="textbox" id="Descripcion" name="desp"></textarea><br><br>
    <label for="preup">Preu del producte:</label><?if (isset($_SESSION["msgNPre"])){echo $_SESSION["msgNPre"];}?>
    <input type="number" name="preup" min="0" step="0.01">
    <label>Categoria</label><?if (isset($_SESSION["msgNCat"])){echo $_SESSION["msgNCat"];}?>
    <input type="radio"name="categoria" value="1">
    <label for="male">TECNOLOGIA</label>
    <input type="radio" name="categoria" value="2">
    <label for="female">COMIDA</label>
    <input type="radio" name="categoria" value="3">
    <label for="other">INTERNET</label>
    <input type="radio"name="categoria" value="4">
    <label for="other">OTRO</label></br><br>
    <input type="file" name="imagenp"></label> <?if (isset($_SESSION["msgNImg"])){echo $_SESSION["msgNImg"];}?>
    <label for="nomProducte">Nom de la imatge:</label></label> <?if (isset($_SESSION["msgNImgNom"])){echo $_SESSION["msgNImgNom"];}?>
    <input type="text" name="nompi">
    <input type="submit" value="Submit">
    </form>
</div>