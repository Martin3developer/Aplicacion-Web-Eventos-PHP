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
					
					if(isset($_GET['pag'])==TRUE){
						$pag=$_GET['pag'];
						$pag=$pag*5;
					}else{
						$pag=0;
					}
						echo "<div class='titulopag'><h1>Noticias</h1></div>";
						$cons="SELECT * FROM noticias ORDER BY fecha DESC LIMIT $pag, 5" ;
						
						$resul=mysqli_query($conexion,$cons) or die(mysqli_error());

						while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){

							echo "<br><div class='noticia'>";
							echo "<div class='titulo'>".$fila["titular"]."</div>";
							echo "<div class='subtitulo'><i><b>".$fila["subtitulo"]." | <span class='fecha'>".$fila["fecha"]."</span></b></i></div>";
							echo "<img src='../".$fila["imagen"]."'>";
							
							echo "<div class='cuerpo'>".$fila["contenido"]."</div>";
							echo "<a href='#'><div class='boton'><i><b>Ver Más  >></b></i></div></a></div>";
						}

						$cons1="SELECT COUNT(*) cantidad FROM noticias ";
						$resul1=mysqli_query($conexion,$cons1);
						$fila = mysqli_fetch_array($resul1, MYSQLI_NUM);
						$contadorpag=($fila[0]/5)+1;

						echo "<div class='pagina'><ul>";

						for($i=1;$i<$contadorpag;$i++){
							$j=$i-1;
							echo "<a href='noticias.php?pag=$j'><li class='sel'>$i</li></a>";
						}		
						
						echo "</ul></div>";
						
					}
			
				mysqli_close($conexion);
			
				
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