<!DOCTYPE html>
<html
<head>
	<title>Noticias</title>
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
				<a href="../php/noticias_N.php"><div class="botones3pag"><h3>Crear Noticia</h3></div></a>
				<a href="../php/noticias_F.php"><div class="botones3pag"><h3>Buscar Noticia</h3></div></a>
				<a href="../php/noticias_D.php"><div class="botones3pag"><h3>Borrar Noticia</h3></div></a>
			<?php 
				include('../php/conexion.php');
				$conexion=conexion();
				

				
				if ($conexion==true) {
					
						echo "<div class='titulopag'><h1>Añadir Noticia</h1></div>
							  <div class='noticia'><form action='#' method='post' enctype='multipart/form-data'>
							  Titulo<br>
							  <input type='text' name='titulo' value='' placeholder='Titulo'><br>
							  Subtitulo<br>
							  <input type='text' name='apellidos' value='' placeholder='Apellidos'><br>
							  Cuerpo<br>
							  <textarea name='cuerpo' >Escribe la noticia aquí</textarea><br>
							  Imagen<br>
							  <input type='file' name='imagen' value=''><br>
							  Fecha de activación<br>
							  <input type='date' name='fecha' value='' placeholder=''><br>
							  <input type='submit' name='enviar' value='enviar'><br>
							  </form></div>";


						if(isset($_POST['enviar'])==TRUE){
							$titulo=$_POST['titulo'];
							$subtitulo=$_POST['subtitulo'];
							$cuerpo=$_POST['cuerpo'];
							$nombretemporal=$_FILES["imagen"]["tmp_name"];
							$fecha=$_POST['fecha'];
							$tipo= $_FILES["imagen"]["type"];

							$carpeta='../images/noticias';
							$nombre=$titulo;
							if (!file_exists($carpeta)) {
								mkdir($carpeta);
							}

							switch ($tipo) {
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
							}
							$ruta="images/noticias/$nombre";
							$cons="INSERT INTO noticias VALUES ('', '$titulo', '$subtitulo', '$cuerpo', '$ruta', '$fecha');" ;
							echo "Noticia creada con exito";
								$resul=mysqli_query($conexion,$cons) or die(mysqli_error());


						}
							
						//echo"<meta http-equiv='REFRESH' content='5';URL=noticias.php?bien=true'>";
							
						}
						
					mysqli_close($conexion);
			
				
			
				
			?>
			

			
				

			
	</div>
	<div class="columna">
			
			<div class="cajavip">
				
			</div>

		</div>		
</div>	
</div>

<!-- ________________________pie de Pagia ___________________________________________________________________________-->

<?php 
	pie();
 	?>
		
</body>
</html>