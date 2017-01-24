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
				<div class='titulopag'>Editar Servicio </div>
			

			<?php 
				
				$conexion=conexion();

				
				if ($conexion==true) {


					if(isset($_GET['id'])==TRUE){//buscamos todos los datos del servicio con el id dado.

					$cons= "SELECT * FROM servicios WHERE id = ".$_GET['id'].";";
					$id=$_GET['id'];
					$resul=mysqli_query($conexion,$cons) or die(mysqli_error());

					while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){ //Mostramos los datos en el formulario
							
						echo "
							  <div class='formulario'><form action='servicios_E.php?id=".$fila['id']."' method='post' enctype='multipart/form-data'>
							  Nombre<br>
							  <input type='text' name='nombre' value='".$fila['nombre']."' placeholder='nombre' required><br>
							  Descripcion<br>
							  <input type='text' name='descripcion' value='".$fila['descripcion']."' placeholder='Descripcion' required><br>
							  Precio<br>
							  <input type='text' name='precio' value='".$fila['precio']."' placeholder='Precio' required><br>
							  Imagen<br>
							  <img src=".$fila['imagen']." width=80%><input type='file' name='imagen' value=''><br>
							  <input type='submit' name='enviar' value='Enviar'><br>
							  </form></div>";

						
						}	
					}
					
					
							  
						if(isset($_POST['enviar'])==TRUE){
							$nombre=$_POST['nombre'];
							$descripcion=$_POST['descripcion'];
							$precio=$_POST['precio'];

							if($_FILES['imagen']['error']==0){//Si la imagen no da ningun error o esta vacia se modificará o
								$nombretemporal=$_FILES["imagen"]["tmp_name"];
								$tipo= $_FILES["imagen"]["type"];
								$nombre1=$id;
								$carpeta='../images/servicios';
								if (!file_exists($carpeta)) {
									mkdir($carpeta);
								}

								switch ($tipo) {
									case 'image/jpeg': $nombre1.=".jpg";
										break;
									case 'image/png': $nombre1.=".png";
										break;
									default:
										$nombre1="no";
										break;
								}
								if ($nombre1!="no") {//Si la imagen tiene el formato correcto la ingresamos
									$ruta=$carpeta."/$nombre1";
									move_uploaded_file($nombretemporal, $ruta);

									$cons="UPDATE servicios SET nombre = '$nombre' , descripcion = '$descripcion', precio = '$precio', imagen = '$ruta' WHERE id =".$_GET['id'].";";

									$resul=mysqli_query($conexion,$cons)or die (mysqli_error());
								
									echo "<div class='noticiamini'><img src='../images/giphy.gif'></div>";
									echo"<meta http-equiv='REFRESH' content='3;URL=servicios.php?bien=true'>";

								}else{ //si no lo tiene le damos otra oportunidad
									echo "<div class='noticiamini'>Lo sentimos<br> pero el formato de la imagen <br>es incorrecto<br>Intentelo de nuevo.</div>";
								}

								
							}else{ //Si la imagen está vacía o da error se actualiza solo la información
								$cons="UPDATE servicios SET nombre = '$nombre' , descripcion = '$descripcion', precio = '$precio' WHERE id =".$_GET['id'].";";
								$resul=mysqli_query($conexion,$cons)or die (mysqli_error());
								
								echo "<div class='noticiamini'><img src='../images/giphy.gif'></div>";
								echo"<meta http-equiv='REFRESH' content='3;URL=servicios.php?bien=true'>";
							}
													
							
								
								
						mysqli_close($conexion);		

						}

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