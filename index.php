<!DOCTYPE html>
<html
	<head>
	<title>My event</title>
	<meta charset="utf-8">
	<link href="estilos/style.css" rel="stylesheet" type="text/css">
	</head>
<body>


 <div class="centro">
 	<img src="../images/imghead.gif" width="100%">
 </div>

<div class="contenedor">

<!-- ________________________Cabecera ___________________________________________________________________________-->

	<?php 

	include('php/codigohtml.php');
	cabecera();
	include('php/conexion.php');
	$conexion=conexion();
//Imagen aleatoria de un evento
				$cons="SELECT imagen FROM servicios";
				$resul=mysqli_query($conexion,$cons);
				while ($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)) {
					$img[]=$fila['imagen'];
				}
				mysqli_close($conexion);
				
	$random=random_int(0,count($img)-1);
	echo "<div class='imagent' style='background-image:url($img[$random]); width:1045px;'>";

 	?>
<!-- ________________________Cuerpo ___________________________________________________________________________-->
</div>
	<div class="contenido">

		<div class="noticias">

		<b>Ultimas noticias</b><br>
			<?php 
				
				$conexion=conexion();

				if ($conexion==true) {

				$cons="SELECT * FROM noticias ORDER BY FECHA DESC LIMIT 3";
				$resul=mysqli_query($conexion,$cons);
				while ($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)) {

				echo "<br><div class='noticia'>";
				echo "<div class='titulo'>".$fila["titular"]."</div>";
				echo "<div class='subtitulo'><i><b>".$fila["fecha"]."</b></i></div>";
				echo "<img src='".$fila["imagen"]."'>";
				
				echo "<div class='cuerpo'>".$fila["contenido"]."</div>";
				echo "<a href='#'><div class='boton'><i><b>Leer Más  >></b></i></div></a></div>";
				
				}

				mysqli_close($conexion);
			
				}
			?>
			
		</div>	
			
				

			
	<div class="columna">
			
			<div class="cajavip">
				<a href="#"><iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showNav=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;ctz=Europe%2FMadrid" style="border-width:0" width="300" height="300"></iframe></a>
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