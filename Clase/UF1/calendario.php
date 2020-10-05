<?php

$mes=date("n");
$ano=date("Y");
$diaActual=date("j");
 
# Obtenemos el dia de la semana del primer dia
# Devuelve 0 para domingo, 6 para sabado
$diaSemana=date("w",mktime(0,0,0,$mes,1,$ano))+7;
# Obtenemos el ultimo dia del mes
$ultimoDiaMes=date("d",(mktime(0,0,0,$mes+1,1,$ano)-1));
 
$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
?>
 
<!DOCTYPE html>
<html>
<head>
	<title>Calendario DAW2</title>
</head>
 
<body>
<table >
	<caption><?php echo $meses[$mes]." ".$ano?></caption>
	<tr>
		<th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
		<th>Vie</th><th>Sab</th><th>Dom</th>
	</tr>
	<tr>
		<?php
		$cleda=$diaSemana+$ultimoDiaMes;
		// hacemos un bucle hasta 42, para asi sa que es el máximo de valores que puede que puede haber en una tabla de 6x7
		for($i=1;$i<=42;$i++)
		{
			if($i==$diaSemana)
			{
				// Aqui guardamos el dia que empieza
				$dia=1;
			}
			if($i<$diaSemana || $i>=$cleda)
			{
				//Aqui generamos una celda vacia
				echo "<td></td>";
			}else{
				//Aqui ya empezamos a scar los dias del mes 
				if($dia==$diaActual)
					echo "<td class='hoy'>$dia</td>";
				else
					echo "<td>$dia</td>";
				$dia++;
			}
			// Aqui cuando se acaba el mes empezamos otra fila 
			if($i%7==0)
			{
				echo "</tr><tr>\n";
			}
		}
	?>
	</tr>
</table>
</body>
</html>