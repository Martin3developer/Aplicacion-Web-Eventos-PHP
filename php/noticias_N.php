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
		<!-- Botones de navegación por la sección de noticias-->
				<a href="../php/noticias_N.php"><div class="botones3pag" style='margin-left: 5%'><h3>Crear Noticia</h3></div></a>
				<a href="../php/noticias_F.php"><div class="botones3pag"><h3>Buscar Noticia</h3></div></a>
				<a href="../php/noticias_D.php"><div class="botones3pag"><h3>Borrar Noticia</h3></div></a>
				<div class='titulopag'>Añadir Noticia</div>

			<?php 
				$conexion=conexion();
				

				
				if ($conexion==true) {
					//la siguiente consulta nos devolverá el número de id que se le asignará al nuevo campo

					$cons="SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA =  'agenda' and TABLE_NAME = 'noticias';";


					$resul=mysqli_query($conexion,$cons);
					$fila=mysqli_fetch_array($resul, MYSQLI_NUM);
						$id=$fila[0];
					
						echo "<div class='formulario'><form action='#' method='post' enctype='multipart/form-data'>
						 		ID<br>
							  <input type='text' name='id' value='$id' readonly ><br>
							  Titulo<br>
							  <input type='text' name='titulo' value='' placeholder='Titulo' required><br>
							  Cuerpo<br>
							  <textarea name='cuerpo' required>Escribe la noticia aquí</textarea><br>
							  Imagen<br>
							  <input type='file' name='imagen' value='' required><br>
							  Fecha de activación<br>
							  <input type='date' name='fecha' value='' placeholder='' required><br>
							  <input type='submit' name='enviar' value='Enviar'><br>
							  </form></div>";

						//tras recoger la información la guardamos en las diferentes variables
						if(isset($_POST['enviar'])){
							$id=$_POST['id'];
							$titulo=$_POST['titulo'];
							$subtitulo="";
							$cuerpo= $_POST['cuerpo'];
							$nombretemporal=$_FILES["imagen"]["tmp_name"];
							$fecha=$_POST['fecha'];
							$tipo= $_FILES["imagen"]["type"];

							$carpeta='../images/noticias';
							$nombre=$id;
							if (!file_exists($carpeta)) {//si no existe creamos la carpeta donde se almacenarán las imagenes
								mkdir($carpeta);
							}

							switch ($tipo) {//comprobamos la extension de las imagenes
								case 'image/jpeg': $nombre.=".jpg";
									break;
								case 'image/png': $nombre.=".png";
									break;
								default:
									$nombre="no";
									break;
							}
							if ($nombre!="no") {
								$ruta=$carpeta."/$nombre";
								move_uploaded_file($nombretemporal, $ruta);
								$ruta="images/noticias/$nombre";
								$cons="INSERT INTO noticias VALUES ('', '$titulo', '$cuerpo', '$ruta', '$fecha');" ;
							
						
								$resul1=mysqli_query($conexion,$cons);
								//hacemos como que se carga el nuevo campo y redireccionamos a la pagina principal de la seccion
								echo "<div class='noticiamini'>Noticia creada exitosamente<br><img src='../images/giphy.gif'><br>Espere...</div>";
								echo"<meta http-equiv='REFRESH' content='3;URL=noticias.php?bien=true'>";

							}else{
								 echo "<div class='noticiamini'>El formato de la imagen es incorrecto<br>Intentelo de nuevo.</div>";
							}
							

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