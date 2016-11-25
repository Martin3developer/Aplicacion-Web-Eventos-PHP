<!DOCTYPE html>
<html
<head>
	<title>Eventos</title>
	<meta charset="utf-8">
	<link href="../estilos/style.css" rel="stylesheet" type="text/css">
</head>
<body>

 <div class="centro">
 	<img src="../images/imghead.gif" width="100%">
 </div>

<div class="contenedor">
<!-- ________________________Cabecera ___________________________________________________________________________-->
	<?php 
	include('../php/codigohtml.php');
	cabecera();
 	?>

 	
<!-- ________________________Cuerpo ___________________________________________________________________________-->
	<div class="contenido">
		
		<div class="noticias">
				<a href="../php/eventos_N.php"><div class="botones3pag"><h3>Crear Evento</h3></div></a>
				<a href="../php/eventos_F.php"><div class="botones3pag"><h3>Buscar Evento</h3></div></a>
				<a href="../php/eventos_D.php"><div class="botones3pag"><h3>Borrar Evento</h3></div></a>
			

			<?php 
				include('../php/conexion.php');
				$conexion=conexion();
				
				if ($conexion==true) {

					$cons="SELECT * FROM eventos" ;
						
						$resul=mysqli_query($conexion,$cons);

						while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){
								$event[]=$fila['fecha'];
						}

					echo "<div class='titulopag'><h1>Eventos</h1></div>";
					
					include('../php/calendario.php');

					if(!isset($_GET['fecha'])){
						$tiempo_actual = time();
						
						$mes = date("n", $tiempo_actual);
						$anio = date("Y", $tiempo_actual);
						$dia=date("d");
						$fecha=$anio . "-" . $mes . "-" . $dia;

					}else{
						$fecha = $_GET['fecha'];

						$anio = substr($fecha, 0, 4);    
						$mes = substr($fecha, 5, 2);    
						$dia = substr($fecha, 8, 2); 
						
						$fecha=$anio."-".$mes."-".$dia;
					}
					echo"<table><tr><td><form action=# method=get>
					Fecha </td>
					<td><input type=date name=fecha value=$fecha><br><td>
					<td><input type=submit name=enviar><td></tr></form></table><br><br>";
					echo "<div>";
					mostrar_calendario($dia,$mes,$anio,$event);
					echo "</div>";

					$cons="SELECT s.nombre , c.nombre, e.lugar , e.fecha, e.hora 
						FROM eventos e, clientes c, servicios s
						WHERE 
						s.id = e.id_servicio
						AND 
						c.id = e.id_cliente ;";
						
						$resul=mysqli_query($conexion,$cons);
						echo "<div class='titulopag'><h3>Últimos eventos</h3></div>";
						echo "<table>
									<tr>
										<th>Servicio</th>
										<th>Cliente</th>
										<th>Lugar</th>
										<th>Fecha</th>
										<th>Hora</th>
									</tr>";

						while($fila=mysqli_fetch_array($resul, MYSQLI_NUM)){
								echo "<tr>
										<td>".$fila[0]."</td>
										<td>".$fila[1]."</td>
										<td>".$fila[2]."</td>
										<td>".$fila[3]."</td>
										<td>".$fila[4]."</td>
										
									  </tr>";
						}

						echo"</table></div>";

					
	  
						
					}

					
			
				mysqli_close($conexion);
			
				
			?>	
</div>	
</div>

<!-- ________________________pie de Pagia ___________________________________________________________________________-->

<?php 
	pie();
 	?>
		
</body>
</html>