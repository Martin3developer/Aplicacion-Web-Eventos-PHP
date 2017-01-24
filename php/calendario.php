<?php

function eventocoloreado($anio, $mes , $dia_actual, $eventos){
	$eve=false;
	for ($i=0; $i < count($eventos); $i++) { 
					if ($dia_actual<10) {//Se le pone un 0 a la izquierda a los días de un solo dígito
						$dia2d="0"."$dia_actual";
					}else{
						$dia2d=$dia_actual;
					}

					$dia1="$anio-$mes-$dia2d";
					
					if ($eventos[$i] == $dia1) {
						$eve=true; 
						$i=count($eventos)+1;
					}
					else {
						$eve=false;
					}
	}
	return $eve;
}

//Esta función nos devuelve el numero de espacios que añadiremos al principio del calendario.
function calcula_espacios($dia,$mes,$anio){
	$numerodiasemana = date('w', mktime(0,0,0,$mes,$dia,$anio));
	if ($numerodiasemana == 0) //Si 
		$numerodiasemana = 6;
	else
		$numerodiasemana--;
	return $numerodiasemana;
}


//funcion que calcula el ultimo dia del mes
function ultimoDia($mes,$anio){ 
    $ultimo_dia=28; 
    while (checkdate($mes,$ultimo_dia + 1,$anio)){ 
       $ultimo_dia++; 
    } 
    return $ultimo_dia; 
} 

//funcion que devuelve el nombre del mes
function nombredelmes($dia,$mes,$anio){
	setlocale(LC_TIME, 'es_ES.UTF-8','spanish'); // Arreglado antes era necesario un switch
	$nmes=strftime("%B",date(mktime(0,0,0,$mes,$dia,$anio)));
	$nmes=ucfirst($nmes); 
		
	return $nmes;
}

function mostrar_calendario($dia,$mes,$anio,$eventos){
	echo "<div class='tablacal'>";

	$nombre_mes = nombredelmes($dia,$mes,$anio);

	$mesanterior=$mes-1;
	$anioanterior=$anio;

	//si el mes es 0 cambiamos de año y vicebersa
	if($mesanterior==0){
		$mesanterior=12;
		$anioanterior=$anio-1;
	}
	if ($mesanterior<10) {//en el caso de que tenga una sola cifra se le añadirá un 0 a la izquierda
		$mesanterior='0'.$mesanterior;
	}

	$mesprox=$mes+1;
	$anioprox=$anio;
	if($mesprox==13){
		$mesprox=1;
		$anioprox=$anio+1;
	}
	if ($mesprox<10) {//en el caso de que tenga una sola cifra se le añadirá un 0 a la izquierda
		$mesprox='0'.$mesprox;
	}

	//construyo la cabecera de la tabla
	echo "<table width=800 cellspacing=3 cellpadding=2 >";
	   echo "<tr>
	   
	   <th align=center colspan=7>
	   <a href='eventos.php?mes=$mesanterior&anio=$anioanterior&mostrar=Mostrar#'><<&nbsp;&nbsp;&nbsp;</a>
	    $nombre_mes $anio 
	    <a href='eventos.php?mes=$mesprox&anio=$anioprox&mostrar=Mostrar#'>&nbsp;&nbsp;>></a>
	    </th>
	   

	   		</tr>";
	echo '	<tr>
			    <td width=15% align=center >Lu</td>
			    <td width=15% align=center >Ma</td>
			    <td width=15% align=center >Mi</td>
			    <td width=15% align=center >Ju</td>
			    <td width=15% align=center >Vi</td>
			    <td width=15% align=center >Sa</td>
			    <td width=15% align=center >Do</td>
			</tr>';
	
	//Número que pinta en la tabla
	$dia_actual = 1;
	
	//calculo el primer dia de la semana
	$espaciosprincipio = calcula_espacios(1,$mes,$anio);
	
	//calculo el último dia del mes
	$ultimo_dia = ultimoDia($mes,$anio);
	
//escribo la primera fila de la semana
	echo "<tr>";
	for ($i=0;$i<7;$i++){
		if ($i < $espaciosprincipio){
			//si el dia de la semana i es menor que el numero del primer dia de la semana no pongo nada en la celda
			echo "<td></td>";
		} else {
			
					if(eventocoloreado($anio, $mes, $dia_actual ,$eventos)==true){
						echo "<td class='eve'><a href='../php/eventos.php?dia=$dia_actual&mes=$mes&anio=$anio&mostrar=mostrar'>$dia_actual</a></td>";
					}else{echo "<td>$dia_actual</td>";}
					
			
				$dia_actual++;
		}
	}
	echo "</tr>";
	
	//recorro todos los demás días hasta el final del mes
	$numero_dia = 0;
	while ($dia_actual <= $ultimo_dia){
		if ($numero_dia == 0)
			echo "<tr>";
				if(eventocoloreado($anio, $mes, $dia_actual ,$eventos)==true){
					echo "<td class='eve'><a href='../php/eventos.php?dia=$dia_actual&mes=$mes&anio=$anio&mostrar=mostrar'>$dia_actual</a></td>";
				}else{echo "<td>$dia_actual</td>";}
			

			$dia_actual++;
			$numero_dia++;

			if ($numero_dia == 7)
			{
				$numero_dia = 0;
				echo "</tr>";
			}

	}
	//rellenamos las celdas vacias de la última semana del mes
	for ($i=$numero_dia;$i<7;$i++){
		echo "<td></td>";
	}
	echo "</tr>";
	echo "</table>";
	echo "</div>";
}	
