<?php   
include("funciones.php");
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';
require './phpmailer/src/Exception.php';
require './phpmailer/src/OAuth.php';
if ($_SERVER["REQUEST_METHOD"]== "POST"){ 
    if (isset($_REQUEST["emailR"]) && isset($_REQUEST["suma"])){
        if($_REQUEST["suma"] == 10){
            $newpass=randomPassword(8);
            cambiarpass(md5($newpass),$_REQUEST["emailR"]);
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = "mboughima@fp.insjoaquimmir.cat";
            $mail->Password = "MohaBou19";
            $mail->setFrom('no-replay@moha.com', 'Servicio automatico de recuperacion.');
            $mail->addAddress($_REQUEST["emailR"], 'Sr/ra');
            $mail->Subject = 'Recuperacion de contraseña.';
            $mail->Body = '<html><body>Hola,'.$_REQUEST['emailR'].'tu nueva password es :'.$newpass;
            $mail->CharSet = 'UTF-8'; // Con esto ya funcionan los acentos
            $mail->IsHTML(true);
            if ($mail->send()){
                    header("location: index.php?enviado=ok");
                }
            else{
                die ("Error al enviar el E-Mail: ".$mail->ErrorInfo);
            }
            if(isset($_REQUEST["contraC"])){
            
            }
        }
    }
}else{

    ?>
        <form method="post">
            <label for="emailE">Email de la cuenta para recupera: </label> <input type="text" name="emailR" require><?if (isset($_SESSION["errormailR"])){echo '<h3 style="color:red;">'.$_SESSION["errormailR"].'</h3>';}?>
            </br> <label>5+5</label> <input type="text" name="suma" id=""> <input type="submit" value="Enviar.">
            <div style="background-color:gold;"><p>Haz click <a href="index.php">aqui</a> para cancelar.</p></div>
        </form>
    <?php
    }
?>