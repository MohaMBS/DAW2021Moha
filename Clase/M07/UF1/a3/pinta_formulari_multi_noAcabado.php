<?php
if ($_SERVER['REQUEST_METHOD']== 'POST'){
    if (isset($_FILES)){
        $dir_subida = 'imatges/';
        $totaldeAr=count($_FILES['arxiu']['name']);
        $fichero_subido = $dir_subida . basename($_FILES['arxiu']['name'][$totaldeAr]);
        $imageFileType = strtolower(pathinfo($fichero_subido,PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
            echo "Error de formato, solo se admiten JPG, JPEG, PNG & GIF.</br>";
        }else{
            if (move_uploaded_file($_FILES['arxiu']['tmp_name'], $fichero_subido)) {
                echo "El fichero es válido y se subió con éxito.</br>";
                echo "Puedes ver el fichero haciendo click "."<a href=\"".$fichero_subido."\">aqui</a>";
            } else {
                echo "No se pudo subir el fichero </br>";
            }
        }
    }
    if (isset($_REQUEST["mytext"]))
        echo "</br>Tu texto es: ";
        print_r($_REQUEST["mytext"]);
    if (isset($_REQUEST["myradio"]))
        echo "<br>Tu radio buton es: ";
        print_r($_REQUEST["myradio"]);
    if (isset($_REQUEST["mycheckbox"]))
        echo "<br>Has marcado los siguentes checkbox: ";
        print_r($_REQUEST["mycheckbox"]);
    if (isset($_REQUEST["myselect"]))
        echo "<br>Has seleccionado el siguente item: ";
        print_r($_REQUEST["myselect"]);
    if (isset($_REQUEST["mytextarea"]))
        echo "<br>Has escrito el siguente texto: ";
        print_r($_REQUEST["mytextarea"]);
}
else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Exemple de formulari</title>

</head>

<body>

<div style="margin: 30px 10%;">
<h3>My form</h3>
<form action="pinta_formulari.php" method="post" id="myform" name="myform" enctype="multipart/form-data">

    <label>Text</label> <input type="text" value="" size="30" maxlength="100" name="mytext" id="" /><br /><br />

    <input type="radio" name="myradio" value="1" /> First radio
    <input type="radio" checked="checked" name="myradio" value="2" /> Second radio<br /><br />

    <input type="checkbox" name="mycheckbox[]" value="1" /> First checkbox
    <input type="checkbox" checked="checked" name="mycheckbox[]" value="2" /> Second checkbox<br /><br />

    <label>Select ... </label>
    <select name="myselect" id="">
        <optgroup label="group 1">
            <option value="1" selected="selected">item one</option>
        </optgroup>
        <optgroup label="group 2" >
            <option value="2">item two</option>
        </optgroup>
    </select><br /><br />
    

    <textarea name="mytextarea" id="" rows="3" cols="30">Text area</textarea> <br /><br />
    <label for="arxiu">Arxiu  </label><input type="file" name="arxiu[]" multiple="multiple"></br> </br>
    <button id="mysubmit" type="submit">Submit</button><br /><br />

</form>
</div>
</body>
</html>
<?php   
}
?>