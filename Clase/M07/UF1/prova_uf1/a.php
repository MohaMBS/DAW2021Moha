<h1><span style="color:green;">HORA:</span>
<?php
ini_set('date.timezone','Europe/Madrid'); 
for ($i = 0; $i < 24; $i++) {
    echo $i." ";
    if($i==strftime("%H")){
        echo '<strong style="color:green;">'.strftime("%H")."</strong> ";
    }
}
echo "</br>";
?>
</h1> 
<h3><span style="color:blue;">MINS:</span>
<?php
for ($i = 0; $i < 60; $i++) {
    echo $i." ";
    if($i==strftime("%M")){
        echo '<strong style="color:blue;">'.strftime("%M")."</strong> ";
    }
}
echo "</br>";
?>
</h3>
<h4><span style="color:#0080FF;">SEGO:</span>
<?php
for ($i = 0; $i < 60; $i++) {
    echo $i." ";
    if($i==strftime("%S")){
        echo '<strong style="color:#0080FF;">'.strftime("%S")."</strong> ";
    }
}
?>
</h4>