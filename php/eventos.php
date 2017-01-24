<?php  
	session_start();
	//En caso de que haya una cookie la cogemos
		if (isset($_COOKIE['Sesion'])) {
			session_decode($_COOKIE['Sesion']);
		}
	include('../php/funciones.php');

	$activo=comprobarSesion();
	//Restringir acceso
	if ($_SESSION['tipo']=="I") {
		echo"<meta http-equiv='REFRESH' content='0;URL=../index.php?error=true'>";
			die();
	}


?>


 
<!-- ________________________Cabecera ___________________________________________________________________________-->
	<?php 
	include('../php/codigohtml.php');
	cabecera($_SESSION['tipo'],$activo);
			$conexion=conexion();
 	?>

 	
<!-- ________________________Cuerpo ___________________________________________________________________________-->
	<div class="contenido">
		
		<div class="noticias">
		<?php 
			if ($_SESSION['tipo']=="A") {
				echo"
				<a href='../php/eventos_N.php'><div class='botones3pag' style='margin-left: 5%'><h3>Crear Evento</h3></div></a>
				<a href='../php/eventos_F.php'><div class='botones3pag'><h3>Buscar Evento</h3></div></a>
				<a href='../php/eventos_D.php'><div class='botones3pag'><h3>Borrar Evento</h3></div></a>";
			}
			echo"<div class='titulopag'>Eventos</div>";

			
			
		
				
				if ($conexion==true) {
					$event=array(); //en el caso de que no tenga eventos inicializamos la variable
					if ($_SESSION['tipo']=="A") {
						$cons="SELECT fecha FROM eventos" ;//tomamos la fecha de los eventos para mostrarlos marcados en el calendario
							
							$resul=mysqli_query($conexion,$cons);

							while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){
									$event[]=$fila['fecha'];
							}
					}else{
						$cons="SELECT fecha FROM eventos WHERE id_cliente=".$_SESSION['id'].";";
						//tomamos la fecha de los eventos para mostrarlos marcados en el calendario
							
							$resul=mysqli_query($conexion,$cons);

							while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){
									$event[]=$fila['fecha'];
							}
					}



					include('../php/calendario.php');

					if(!isset($_GET['mostrar'])){//si entras por primera vez aparecerá el mes actual en el calendario
						$tiempo_actual = time();

						$anio = date("Y", $tiempo_actual);

						$mes = date("n", $tiempo_actual);
						if ($mes<10) {
							$mes= "0".$mes;
						}
						
						$dia=date("d");
						$fecha=$anio . "-" . $mes . "-" . $dia;

					}else{ //una vez navegas por la página tendremos el control del mes que muestre el calendario
						$fecha = $_GET['mostrar'];

						$anio = $_GET['anio'];    
						$mes = $_GET['mes'];    
						$dia = 01;
						
						$fecha=$anio."-".$mes."-".$dia;
					}
					

						//puede elegir el mes que quiere mostrar
					echo"<div class='selfecha' style='text-align:center'><form action=# method=get>
					<b>FECHA QUE DESEA MOSTRAR:</b><br><br>Mes:
					<select class='selector' name='mes' required>
					<option value='$mes'>-- Mes --</option>
					<option value='01'>Enero</option>
					<option value='02'>Febrero</option>
					<option value='03'>Marzo</option>
					<option value='04'>Abril</option>
					<option value='05'>Mayo</option>
					<option value='06'>Junio</option>
					<option value='07'>Julio</option>
					<option value='08'>Agosto</option>
					<option value='09'>Septiembre</option>
					<option value='10'>Octubre</option>
					<option value='11'>Noviembre</option>
					<option value='12'>Diciembre</option>
					</select>
					Año:
					<select name='anio' required>
					<option value='$anio'>-- Año --</option>";
					//Esto nos permite acceder solo al año de la fecha que nos devuelve
					$cons="SELECT DISTINCT year(fecha)  FROM eventos ORDER BY fecha DESC;";
					
					$resul=mysqli_query($conexion,$cons);
							$anios1=3;
							$i=0;
								while($fila=mysqli_fetch_array($resul, MYSQLI_NUM)){
									
									echo "<option value='".$fila[0]."'>".$fila[0]."</option>";
									
								}
					echo "</select>
					<br><br><input type=submit name='mostrar' value='Mostrar'></input>
					</form></div>";

					
					
					mostrar_calendario($dia,$mes,$anio,$event);//funcion que muestra el calendario



				if(isset($_GET['dia'])){//si le mandamos un día especifico mostrará el evento que ocurre ese dia
					$dia=$_GET['dia'];
					$mes=$_GET['mes'];
					$anio=$_GET['anio'];
					$fechasel=$anio."-".$mes."-".$dia;
					//mostramos el nombre del servicio y del cliente en vez de su id para que el administrador lo pueda manejar con facilidad.
					
				if ($_SESSION['tipo']=="A") {

					$cons="SELECT s.nombre snombre, c.nombre cnombre, e.fecha efecha, e.lugar elugar, e.hora ehora, e.id_servicio eid, e.id_cliente cid
						FROM eventos e, clientes c, servicios s
						WHERE 
						s.id = e.id_servicio
						AND 
						c.id = e.id_cliente 
						AND
						e.fecha = '$fechasel'
						ORDER BY 
						e.fecha DESC;";
					}else{
						$cons="SELECT s.nombre snombre, c.nombre cnombre, e.fecha efecha, e.lugar elugar, e.hora ehora, e.id_servicio eid, e.id_cliente cid
						FROM eventos e, clientes c, servicios s
						WHERE 
						s.id = e.id_servicio
						AND 
						c.id = e.id_cliente 
						AND
						e.fecha = '$fechasel'
						AND
						id_cliente = ".$_SESSION['id']."
						ORDER BY 
						e.fecha DESC;";
					}	
						$resul=mysqli_query($conexion,$cons);
						
						echo "<div class='tablacal' style='margin-left:10px;'><table>
									<tr>
										<th>Servicio</th>
										<th>Cliente</th>
										<th>Lugar</th>
										<th >Fecha</th>
										<th>Hora</th>
									
									</tr>";

						$fechahoy=fechactual();//Nos devuelve el dia actual
						while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){
							$fecha=voltearfecha($fila['efecha']);
							$hora=substr($fila['ehora'], 0, 5); 
								echo "<tr>
										<td>".$fila['snombre']."</td>
										<td>".$fila['cnombre']."</td>
										<td>".$fila['elugar']."</td>
										<td>  ".$fecha."</td>
										<td>".$hora."</td>";

									  echo "</tr>";
						}

						echo"</table></div>";
					}
				
				}
				mysqli_close($conexion);
			
				
			?>
	</div>	
</div>	
</div>

<!-- ________________________pie de Pagia ___________________________________________________________________________-->

<?php 
	pie();
 	?>
		
</body>
</html>