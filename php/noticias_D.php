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
					
						echo "<div class='titulopag'><h1>Borrar Noticia</h1></div>
							  <div class='noticia'><form action='#' method='post'>
							  Introduce el Titulo<br>
							  <input type='text' name='titulo' value='' placeholder='Titulo'><br>
							  <input type='submit' name='enviar' value='enviar'><br>
							  </form></div>";


						if(isset($_POST['enviar'])==TRUE){
							$titulo=$_POST['titulo'];
							$selector="";
						
							$cons="SELECT * FROM noticias WHERE titular like '%$titulo%';" ;
							$resul=mysqli_query($conexion,$cons) or die(mysqli_error());
							while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){

							echo "<br><div class='noticia'>";
							echo "<div class='titulo'>".$fila["titular"]."</div>";
							echo "<div class='subtitulo'><i><b>".$fila["subtitulo"]." / ".$fila["fecha"]."</b></i></div>";
							echo "<img src='../".$fila["imagen"]."'>";
							
							echo "<div class='cuerpo'>".$fila["contenido"]."</div>";
							echo "<a href='noticias_D.php?selector=".$fila['imagen']."'><div class='boton'><i><b>borrar  >></b></i></div></a></div>";
							}
							
						}
						
						
						

						if(isset($_GET['selector'])==TRUE){ // Eliminar la imagen de la carpeta
							$ruta1=$_GET['selector'];

							if (file_exists("../".$ruta1)==true) {
							    unlink($ruta1);
							    echo 'El archivo '.$ruta1.' ha sido borrado';
							  } else {
							    echo 'no se ha borrado '.$ruta1;
							  }
						
							$cons="DELETE FROM noticias WHERE imagen = '$ruta1';" ;
							echo "Noticia borrada satisfactoriamente.";
							$resul=mysqli_query($conexion,$cons) or die(mysqli_error());
						}
						

					

						
						//echo"<meta http-equiv='REFRESH' content='5';URL=noticias.php?bien=true'>";
					
						}
				mysqli_close($conexion);
				
			?>
			

			
				

			
	</div>
	<div class="columna">
			
			<div class="cajavip">
				<a href="#"><iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showNav=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;ctz=Europe%2FMadrid" style="border-width:0" width="300" height="300" frameborder="0" scrolling="no"></iframe></a>
			</div>
			<div class="caja">LOGIN
				<div class="login">
					Username<br>
					<input type="text" class="texto"><BR>
					Password<br>
					<input type="text" class="texto"><BR>
					<input type="checkbox" class="otro">Remember me<br>
					<input type="submit" value="Login-->" class="otro">
				</div>
					<ul>
						<a href="#"><li>Register</li></a>
						<a href="#"><li>Lost password</li></a>
					</ul>
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