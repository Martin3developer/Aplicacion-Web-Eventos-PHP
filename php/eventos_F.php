<?php  
	session_start();
	//En caso de que haya una cookie la cogemos
		if (isset($_COOKIE['Sesion'])) {
			session_decode($_COOKIE['Sesion']);
		}
	include('../php/funciones.php');

	$activo=comprobarSesion();
	if ($_SESSION['tipo']=="I" || $_SESSION['tipo']=="R") {
		echo"<meta http-equiv='REFRESH' content='0;URL=../index.php?error=true'>";
			die();
	}
?>


<!-- ________________________Cabecera ___________________________________________________________________________-->
	<?php 
	include('../php/codigohtml.php');
	cabecera($_SESSION['tipo'],$activo);
 	?>

 	
<!-- ________________________Cuerpo ___________________________________________________________________________-->
	<div class="contenido">
		
		<div class="noticias">
		<!-- Botones de navegación por la sección de eventos-->
				<a href="../php/eventos_N.php"><div class="botones3pag" style='margin-left: 5%'><h3>Crear Evento</h3></div></a>
				<a href="../php/eventos_F.php"><div class="botones3pag"><h3>Buscar Evento</h3></div></a>
				<a href="../php/eventos_D.php"><div class="botones3pag"><h3>Borrar Evento</h3></div></a>
				<div class='titulopag'>Buscar Evento</div>
			<?php 
				
				$conexion=conexion();
			
				if ($conexion==true) {//Pintamos el formulario de búsqueda
					
						echo "<div class='formulario'><form action='#' method='get'>
							  Introduce el Nombre del Servicio, Cliente o la Fecha<br>
							  <input type='text' name='nombre' value=''><br>
							  <input type='text' name='order' value='1' hidden>
							  <input type='submit' name='enviar' value='Enviar'><br>
							  </form></div>";


						if(isset($_GET['enviar'])==TRUE){
							$nombre=$_GET['nombre'];
							$order=$_GET['order'];//variable que indica el orden
						
						
								
								$cons="SELECT s.nombre snombre, c.nombre cnombre, e.fecha efecha, e.lugar elugar, e.hora ehora, e.id_servicio eid, e.id_cliente cid
										FROM eventos e, clientes c, servicios s
										WHERE 
										s.id = e.id_servicio
										AND 
										c.id = e.id_cliente
										AND 
										(s.nombre LIKE '%$nombre%' || c.nombre LIKE '%$nombre%' || e.fecha LIKE '%$nombre%')					
										ORDER BY";
										if ($order=="1") {//se le añade a la consulta la referencia de orden
											$cons.=" s.nombre ASC;"; }
										if ($order=="2") {
											$cons.=" c.nombre ASC;"; }
										if ($order=="3") {
											$cons.=" e.fecha ASC;"; }
						
						$resul=mysqli_query($conexion,$cons);//Mostramos los resultados de la consulta
						$cantidad=mysqli_num_rows($resul);

				if ($cantidad!=0) {//Comprobaremos que hay algún campo que mostrar

				
					
							
						echo "<div class='tablasgeneral'><table>
									<tr>
										<th ><a href='../php/eventos_F.php?enviar=Enviar&order=1&nombre=$nombre'>Servicios ";
										if ($order=="1") {
											echo "<br>&#9660;";
										}else{//flechas
											echo "<br>&#9650";
										}
						echo"			<th ><a href='../php/eventos_F.php?enviar=Enviar&order=2&nombre=$nombre'>Clientes ";
										if ($order=="2") {
											echo "<br>&#9660;";
										}else{//flechas
											echo "<br>&#9650";
										}
						echo"				
										<th>Lugar</th>
										<th ><a href='../php/eventos_F.php?enviar=Enviar&order=3&nombre=$nombre'>Fecha ";
										if ($order=="3") {
											echo "<br>&#9660;";
										}else{//flechas
											echo "<br>&#9650";
										}
						echo"			<th>Hora</th>
										
									</tr>";

						
							
						while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){
							
							$fecha=voltearfecha($fila['efecha']);
							$hora=substr($fila['ehora'], 0, 5); 
								echo "<tr>
										<td>".$fila['snombre']."</td>
										<td>".$fila['cnombre']."</td>
										<td>".$fila['elugar']."</td>
										<td>".$fecha."</td>
										<td>".$hora."</td>";

										
									  echo "</tr>";
						}

						echo"</table></div>";

						}else{
							echo "<div class='tablasgeneral'><table>
									<tr>
										<th >No hay resultados que coincidan con la búsqueda</th>
									</tr>
									</table>
								  </div>";
						}
					}
			
					mysqli_close($conexion);	

				}
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