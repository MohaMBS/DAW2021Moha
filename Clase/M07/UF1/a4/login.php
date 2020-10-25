<?php
session_start();
$errormail="";
$errorcontra="";
$emailRecoradado="";
$passRecordado="";
if (isset($_REQUEST["aceptadocookie"]) ){
    if ($_REQUEST["aceptadocookie"]="si"){
        setcookie("datos","si", time() + 86400 * 30);
        header('location:login.php');
    }
}else if (isset($_REQUEST["aceptadocookie"])){
    if ($_REQUEST["aceptadocookie"]="no"){
        header('location:http://www.google.com');
    }
}
if(!isset($_COOKIE["datos"])){
    echo'<form method="post">
        <h3>Acceptas nuestras coockies?</h3>
        <input type="radio" name="aceptadocookie" value="si">
        <label for="aceptadocookie">Si.</label><br>
        <input type="radio" name="aceptadocookie" value="no">
        <label for="aceptadocookie">No.</label><br>
        <button type="submit">Inicicar.</button>
    </form>';
 
}else{
    if ($_SERVER["REQUEST_METHOD"]== "POST"){
        if (isset($_REQUEST["recordarUs"])){
            if ($_REQUEST["recordarUs"]){
                $usPass=sha1($_REQUEST["contra"]);
                $_SESSION["passRecordado"]=$usPass;
                $_SESSION["emailRecordado"]=$usMail=$_REQUEST["email"];
                $passRecordado="noesnada";
                setcookie("pass",$usPass, time() + 86400 * 30);
                sleep(0.5);
                
            }
        } 
        include ("auten.php");
    }
    if (isset($_REQUEST["error"])){
        if ($_REQUEST["error"]==1){
            echo "Error de usuario o contraseña.";
            echo"en auten";die;
        }
    }
    ?>
    <html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <title>Container</title>
        <style>
        body{
            background-color:grey;
        }
        </style>
    </head>
    <body>
    <div class="row">
        <div class="col-4">
            <form class="form-horizontal" method="post">
                <div class="form-group">
                    <label for="inputEmail3" class="col-2 control-label" >Email</label>
                    <div class="col-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email"><?=$errormail;?>
                    </div >
                </div>
                <div class="form-group ">
                    <label for="inputPass3" class="col-2 control-label">Password</label>
                    <div class="col-10">
                        <input type="password" class="form-control" id="inputEmail3" placeholder="Password" name="contra" value="<?=$errorcontra;?>"><?=$errorcontra;?>
                    </div >
                    </br>
                </div>
                <div class="offset-1">
                    <label calss="offset-1">Recordar inicio.
                    <input type="radio" name="recordarUs" value="si">
                    <label for="recordarUs">Si</label>
                    <input type="radio" name="recordarUs" value="no">
                    <label for="recordarUs">No</label>
                    <button type="submit" class="">Inicicar.</button>
                </div>
            </from>
        </div>
    </div>
    </body>
    </html>
    <?php
} 
    ?>