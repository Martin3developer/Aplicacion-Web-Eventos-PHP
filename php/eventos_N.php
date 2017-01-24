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
				<div class='titulopag'>Añadir Evento</div>
			<?php 
				
				$conexion=conexion();
				
				if ($conexion==true) {//Pintamos el formulario 
					
						echo "<div class='formulario'><form action='#' method='post' >
							  Cliente<br>
							  <select name='id_cliente' required>";//Mostramos el nombre y apellidos de los clientes
								$cons="SELECT id, nombre, apellidos FROM clientes Where id <> 0";
								$resul=mysqli_query($conexion,$cons);

								while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){
								echo "<option value=".$fila['id'].">".$fila['nombre']." , ".$fila['apellidos']."</option>";
								}


								echo"</select><br><br>Servicio<br>
								<select name='id_servicio' required>";//Mostramos el nombre de los servicios
								$cons="SELECT id, nombre FROM servicios";
								$resul=mysqli_query($conexion,$cons);

								while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){
								echo "<option value=".$fila['id'].">".$fila['nombre']."</option>";
								}
							 	
							  echo "</select><br><br>
							  Lugar<br>
							  <input type='text' name='lugar' value='' required><br>
							  Fecha<br>
							  <input type='date' name='fecha'value='' required><br>
							  Hora<br>
							  <input type='time' name='hora' value='' required><br>
							  <input type='submit' name='enviar' value='Enviar'><br>
							  </form></div>";


						if(isset($_POST['enviar'])==TRUE){
							$id_servicio=$_POST['id_servicio'];
							$id_cliente=$_POST['id_cliente'];
							$lugar=$_POST['lugar'];
							$fecha=$_POST['fecha'];
							$hora=$_POST['hora'].":00";//añadimos el formato que utiliza mysql
							
							
							$cons="INSERT INTO eventos VALUES ($id_servicio, $id_cliente, '$lugar','$fecha','$hora');" ;
										
							$resul=mysqli_query($conexion,$cons);
							
							//Mensaje de validación de la creacion del evento
								echo "<div class='noticiamini'>Evento creado exitosamente<br><img src='../images/giphy.gif'><br>Espere...</div>";
								echo"<meta http-equiv='REFRESH' content='3;URL=eventos.php?bien=true'>";
						
						}
									
					}	
					mysqli_close($conexion) 
	
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