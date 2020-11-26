<?php
include ("./funcciones.php");
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';
require './phpmailer/src/Exception.php';
require './phpmailer/src/OAuth.php';
ini_set('date.timezone','Europe/Madrid');
if ($_SERVER["REQUEST_METHOD"]== "POST"){ 

    if (isset($_REQUEST["emailR"])){
        if (exsiste($_REQUEST["emailR"])){
            $token=randomPassword();
            while (noRepetirToken($token)==false){
                $token=randomPassword();
            } 
            setcookie("email",$_REQUEST['emailR'], time() +7200);
            setcookie("emailToken",$token, time() +7200);
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
            $mail->Body = '<html><body>Hola,'.$_REQUEST['emailR'].'</br> para poder recuperar la contraseña debes hacer click <a href="https://dawjavi.insjoaquimmir.cat/mboughima/Clase/M07/UF1/a7/recuperacionpass.php?email='.$_REQUEST['emailR'].'&token='.$token.'">aquí</a>, usted dispone de 2 horas para poder recuperar la contraseña.</body></html>';
            $mail->CharSet = 'UTF-8'; // Con esto ya funcionan los acentos
            $mail->IsHTML(true);
            if ($mail->send()){
                if(guardarRecuperacion($_REQUEST['emailR'],$token)==false){
                    echo 'Algo fallo por favor vuela a solicitar la recuperacion de su contraseña haciendo click <a href="?recuperar.php">aqui</a>';
                }else{
                header("location: login.php?enviado=ok");}
                }
            else{
                die ("Error al enviar el E-Mail: ".$mail->ErrorInfo);
            }
            if(isset($_REQUEST["contraC"])){
            
            }
        }else{
            header("location: recuperar.php");
            $_SESSION["errormailR"]="Ese correo, no esta registrado.";
        }
        if (strlen($_REQUEST["emailR"])<=1){
            header("location: recuperar.php");
            $_SESSION["errormailR"]="Debe introducir el correo.";        
        }
    }
}
else{
    ?>
        <form method="post">
            <label for="emailE">Email de la cuenta para recupera: </label> <input type="text" name="emailR" require><?if (isset($_SESSION["errormailR"])){echo '<h3 style="color:red;">'.$_SESSION["errormailR"].'</h3>';}?>
            </br><input type="submit" value="Enviar.">
            <div style="background-color:gold;"><p>Haz click <a href="login.php">aqui</a> para cancelar.</p></div>
        </form>
    <?php
    }
    ?>