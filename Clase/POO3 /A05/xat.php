<?php
            error_reporting(0);
            if ($_REQUEST["enviar"]== true){
                $chat = fopen("xat.txt","a");
                fwrite($chat, "<strong>".$_REQUEST["nombre"]."</strong>"." ".$_REQUEST["mensaje"].PHP_EOL);
                fclose($chat);
            }
            if ($_REQUEST["borrar"]== true){
                $chat = fopen("xat.txt","w");
                fwrite($chat,"");
                fclose($chat);
            }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="xat.css" />
    <title>Document</title>
<script>
</script>
</head>
<body>
<div class="caja">
  <div>
</br>
        <p class="chat">Chat: <b></b></p>
        <div style="clear:both"></div>
    </div>
     
    <div id="cajachat">
        <?php
            $chat = fopen("xat.txt","r");
            while(!feof($chat)) {
                echo fgets($chat)."<br>";
            }
            fclose($chat);
        ?>
           </div>
    <form name="message" action="xat.php" method="get">
        <label for="nombre" size="15">Nombre:</label>
        <input name="nombre" type="text" id="nombre" size="10" />
        </br>
        <input name="mensaje" type="text" id="mensaje" size="63" />
        <input name="enviar" type="submit"  id="submitmsg" value="Enviar" />
        <input name="borrar" type="submit"  id="submitmsg" value="Borrar" />
    </form>
        </br>

</div>
</body>
</html>