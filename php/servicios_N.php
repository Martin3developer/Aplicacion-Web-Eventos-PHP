<!DOCTYPE html>
<html
<head>
	<title>Servicios</title>
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
				<a href="../php/servicios_N.php"><div class="botones3pag"><h3>Crear Servicio</h3></div></a>
				<a href="../php/servicios_F.php"><div class="botones3pag"><h3>Buscar Servicio</h3></div></a>
			<?php 
				include('../php/conexion.php');
				$conexion=conexion();
				

				
				if ($conexion==true) {
					
						echo "<div class='titulopag'><h1>Añadir Servicio</h1></div>
							  <div class='noticia'><form action='#' method='post' enctype='multipart/form-data'>
							  Nombre<br>
							  <input type='text' name='nombre' value='' placeholder='nombre'><br>
							  Descripcion<br>
							  <input type='text' name='descripcion' value='' placeholder='Descripcion'><br>
							  Precio<br>
							  <input type='text' name='precio' value='' placeholder='Precio'><br>
							  Imagen<br>
							  <input type='file' name='imagen' value=''><br>
							  <input type='submit' name='enviar' value='enviar'><br>
							  </form></div>";


						if(isset($_POST['enviar'])==TRUE){
							$nombre=$_POST['nombre'];
							$descripcion=$_POST['descripcion'];
							$precio=$_POST['precio'];
							$nombretemporal=$_FILES["imagen"]["tmp_name"];
							$tipo= $_FILES["imagen"]["type"];
							$nombre1=$nombre;
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
							if ($nombre1!="no") {
								$ruta=$carpeta."/$nombre1";
								move_uploaded_file($nombretemporal, $ruta);
							}

							$cons="INSERT INTO servicios VALUES ('','$nombre','$descripcion','$precio','$ruta');";
							
							$resul=mysqli_query($conexion,$cons);
							$num = mysqli_affected_rows($conexion);
							if($num == 1)
							echo "Servicio creado con exito";
							else
							echo "No se ha insertado el servicio";

						}
							
						//echo"<meta http-equiv='REFRESH' content='5';URL=noticias.php?bien=true'>";
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