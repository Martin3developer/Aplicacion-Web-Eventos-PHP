<?
function calcula_numero_dia_semana($dia,$mes,$anio){
	$numerodiasemana = date('w', mktime(0,0,0,$mes,$dia,$anio));
	if ($numerodiasemana == 0) 
		$numerodiasemana = 6;
	else
		$numerodiasemana--;
	return $numerodiasemana;
}


//funcion que devuelve el último día de un mes y año dados
function ultimoDia($mes,$anio){ 
    $ultimo_dia=28; 
    while (checkdate($mes,$ultimo_dia + 1,$anio)){ 
       $ultimo_dia++; 
    } 
    return $ultimo_dia; 
} 
function Dia($dia){ 
   
    echo "<td>$dia_actual
    </td>"; 
} 

function dame_nombre_mes($mes){
	 switch ($mes){
	 	case 1:
			$nombre_mes="Enero";
			break;
	 	case 2:
			$nombre_mes="Febrero";
			break;
	 	case 3:
			$nombre_mes="Marzo";
			break;
	 	case 4:
			$nombre_mes="Abril";
			break;
	 	case 5:
			$nombre_mes="Mayo";
			break;
	 	case 6:
			$nombre_mes="Junio";
			break;
	 	case 7:
			$nombre_mes="Julio";
			break;
	 	case 8:
			$nombre_mes="Agosto";
			break;
	 	case 9:
			$nombre_mes="Septiembre";
			break;
	 	case 10:
			$nombre_mes="Octubre";
			break;
	 	case 11:
			$nombre_mes="Noviembre";
			break;
	 	case 12:
			$nombre_mes="Diciembre";
			break;
	}
	return $nombre_mes;
}
function eventocoloreado($anio, $mes , $dia_actual, $eventos){

	for ($i=0; $i < count($eventos); $i++) { 
					if ($dia_actual<10) {
						$dia2d="0"."$dia_actual";
					}else{$dia2d=$dia_actual;}
					$dia1="$anio-$mes-$dia2d";
					if ($eventos[$i] == $dia1) {$eve=true; $i=count($eventos)+1;}
					else {$eve=false;}
	}
	return $eve;
}

function mostrar_calendario($dia,$mes,$anio,$eventos){

$mes_hoy=date("m");
$anio_hoy=date("Y");
if (($mes_hoy <> $mes) || ($anio_hoy <> $anio))
{
	$hoy=0;
}
else
{
	$hoy=date("d");
}
	//tomo el nombre del mes que hay que imprimir
	$nombre_mes = dame_nombre_mes($mes);
	
	//construyo la cabecera de la tabla
	echo "<table width=800 cellspacing=3 cellpadding=2 >";
	   echo "<tr><th align=center colspan=7>$nombre_mes $anio</th></tr>";
	echo '	<tr>
			    <td width=15% align=center >Lu</td>
			    <td width=15% align=center >Ma</td>
			    <td width=15% align=center >Mi</td>
			    <td width=15% align=center >Ju</td>
			    <td width=15% align=center >Vi</td>
			    <td width=15% align=center >Sa</td>
			    <td width=15% align=center >Do</td>
			</tr>';
	
	//Variable para llevar la cuenta del dia actual
	$dia_actual = 1;
	
	//calculo el numero del dia de la semana del primer dia
	$numero_dia = calcula_numero_dia_semana(1,$mes,$anio);
	//echo "Numero del dia de demana del primer: $numero_dia <br>";
	
	//calculo el último dia del mes
	$ultimo_dia = ultimoDia($mes,$anio);
	
//escribo la primera fila de la semana
	echo "<tr>";
	for ($i=0;$i<7;$i++){
		if ($i < $numero_dia){
			//si el dia de la semana i es menor que el numero del primer dia de la semana no pongo nada en la celda
			echo "<td></td>";
		} else {
		if (($i == 5) || ($i == 6))
		{
				if(eventocoloreado($anio, $mes, $dia_actual ,$eventos)==true){
					echo "<td><a href=index.php?dia=$dia_actual&mes=$mes&anio=$anio>$dia_actual</a></td>";
				}else{echo "<td>$dia_actual</td>";}
				
		}
		else
		{			
				if(eventocoloreado($anio, $mes, $dia_actual,$eventos)==true){
					echo "<td><a href=index.php?dia=$dia_actual&nuevo_mes=$mes&nuevo_anio=$anio>$dia_actual</a></td>";
				}else{echo "<td>$dia_actual</td>";}
				
		}
			$dia_actual++;
		}
	}
	echo "</tr>";
	
	//recorro todos los demás días hasta el final del mes
	$numero_dia = 0;
	while ($dia_actual <= $ultimo_dia){
		//si estamos a principio de la semana escribo el <TR>
		if ($numero_dia == 0)
			echo "<tr>";
		//si es el ultimo de la semana, me pongo al principio de la semana y escribo el </tr>

			if (($numero_dia == 5) || ($numero_dia == 6))
			{
				if(eventocoloreado($anio, $mes, $dia_actual ,$eventos)==true){
					echo "<td><a href=index.php?dia=$dia_actual&nuevo_mes=$mes&nuevo_anio=$anio>$dia_actual</a></td>";
				}else{echo "<td>$dia_actual</td>";}
			}
			else
			{		
				if(eventocoloreado($anio, $mes, $dia_actual ,$eventos)==true){
					echo "<td><a href=index.php?dia=$dia_actual&nuevo_mes=$mes&nuevo_anio=$anio>$dia_actual</a></td>";
				}else{echo "<td>$dia_actual</td>";}
			}

			$dia_actual++;
			$numero_dia++;
			if ($numero_dia == 7)
			{
				$numero_dia = 0;
				echo "</tr>";
			}

	}
	
	//compruebo que celdas me faltan por escribir vacias de la última semana del mes
	for ($i=$numero_dia;$i<7;$i++){
		echo "<td></td>";
	}
	
	echo "</tr>";
	echo "</table>";
}	
