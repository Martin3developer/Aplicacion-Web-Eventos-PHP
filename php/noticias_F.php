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
					
						echo "<div class='titulopag'><h1>Buscar Noticia</h1></div>
							  <div class='noticia'><form action='#' method='post'>
							  Introduce el Titulo<br>
							  <input type='text' name='titulo' value='' placeholder='Titulo'><br>
							  <input type='submit' name='enviar' value='enviar'><br>
							  </form></div>";


						if(isset($_POST['enviar'])==TRUE){
							$titulo=$_POST['titulo'];
						
							$cons="SELECT * FROM noticias WHERE titular like '%$titulo%';" ;
							$resul=mysqli_query($conexion,$cons) or die(mysqli_error());

							while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){

							echo "<br><div class='noticia'>";
							echo "<div class='titulo'>".$fila["titular"]."</div>";
							echo "<div class='subtitulo'><i><b>".$fila["subtitulo"]."  ".$fila["fecha"]."</b></i></div>";
							echo "<img src='../".$fila["imagen"]."'>";
							
							echo "<div class='cuerpo'>".$fila["contenido"]."</div>";
							echo "<a href='#'><div class='boton'><i><b>Ver Más  >></b></i></div></a></div>";
							}
						}
				
						//echo"<meta http-equiv='REFRESH' content='5';URL=noticias.php?bien=true'>";
							mysqli_close($conexion);	

						}
		
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