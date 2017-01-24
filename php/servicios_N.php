<?php  
	session_start();

	include('../php/funciones.php');

	$activo=comprobarSesion();
	//Restringir acceso
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
		<!-- Botones de navegación por la sección de servicios-->
				<a href="../php/servicios_N.php"><div class="botones3pag" style='margin-left: 10%'><h3>Crear Servicio</h3></div></a>
				<a href="../php/servicios_F.php"><div class="botones3pag"><h3>Buscar Servicio</h3></div></a>
				<div class='titulopag'>Añadir Servicio</div>
			<?php 
				
				$conexion=conexion();
				
				
				if ($conexion==true) {
					//la siguiente consulta nos devolverá el número de id que se le asignará al nuevo campo

					$cons="SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA =  'agenda' and TABLE_NAME = 'servicios';";
					$resul=mysqli_query($conexion,$cons);
					while ($fila=mysqli_fetch_array($resul, MYSQLI_NUM)) {
						$id=$fila[0];
						echo "
							  <div class='formulario'><form action='#' method='post' enctype='multipart/form-data'>
							   ID<br>
							  <input type='text' name='nombre' value='$id' readonly ><br>
							  Nombre<br>
							  <input type='text' name='nombre' value='' placeholder='Nombre' required><br>
							  Descripcion<br>
							  <input type='text' name='descripcion' value='' placeholder='Descripcion' required><br>
							  Precio<br>
							  <input type='text' name='precio' value='' placeholder='Precio' required><br>
							  Imagen<br>
							  <input type='file' name='imagen' value='' required><br>
							  <input type='text' name='id' value='".$id."' hidden>
							  <input type='submit' name='enviar' value='Enviar'><br>
							  </form></div>";
						}

						if(isset($_POST['enviar'])==TRUE){
							$id=$_POST['id'];
							$nombre=$_POST['nombre'];
							$descripcion=$_POST['descripcion'];
							$precio=$_POST['precio'];
							$nombretemporal=$_FILES["imagen"]["tmp_name"];
							$tipo= $_FILES["imagen"]["type"];
							$nombre1=$id;
							$carpeta='../images/servicios';
							if (!file_exists($carpeta)) {//si no existe crearemos la carpeta que contendrá las imagenes
								mkdir($carpeta);
							}

							switch ($tipo) {//Comprobamos que el tipo de las imagenes sea válido
								case 'image/jpeg': $nombre1.=".jpg";
									break;
								case 'image/png': $nombre1.=".png";
									break;
								default:
									$nombre1="no";
									break;
							}
							if ($nombre1!="no") {
								$ruta=$carpeta."/$nombre1";
								move_uploaded_file($nombretemporal, $ruta);

								$cons="INSERT INTO servicios VALUES ('','$nombre','$descripcion','$precio','$ruta');";
							
								$resul=mysqli_query($conexion,$cons);
								echo "<div class='noticiamini'><img src='../images/giphy.gif'></div>";
								echo"<meta http-equiv='REFRESH' content='3;URL=servicios.php?bien=true'>";

							}else{//Si la imagen no es correcta se le da otra oportunidad para subirla
								 echo "<div class='noticiamini'>Lo sentimos<br> pero el formato de la imagen <br>es incorrecto<br>Intentelo de nuevo.</div>";
							}

							

						}
							
							mysqli_close($conexion);
						}
						
					
			
				
			
				
			?>
			

			
				

			
	</div>
	
	<div class="columna">
			
		</div>	

</div>	
</div>

<!-- ________________________pie de Pagia ___________________________________________________________________________-->

<?php 
	pie();
 	?>
		
</body>
</html>