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
					
						echo "<div class='titulopag'><h1>Buscar Servicio</h1></div>
							  <div class='noticia'><form action='#' method='post'>
							  Introduce el Nombre del servicio<br>
							  <input type='text' name='nombre' value='' placeholder='nombre'><br>
							  <input type='submit' name='enviar' value='enviar'><br>
							  </form></div>";


						if(isset($_POST['enviar'])==TRUE){
							$nombre=$_POST['nombre'];
						
							$cons="SELECT * FROM servicios WHERE nombre like '%$nombre%';" ;

							$resul=mysqli_query($conexion,$cons) or die(mysqli_error());


								echo "<table>
									<tr>
										<th>ID</th>
										<th>Nombre</th>
										<th>Descripción</th>
										<th>Precio</th>
										<th>Imagen</th>
									</tr>";

						while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){
								echo "<tr>
										<td>".$fila['id']."</td>
										<td>".$fila['nombre']."</td>
										<td>".$fila['descripcion']."</td>
										<td>".$fila['precio']."</td>
										<td><img src=".$fila['imagen']." width='50px;'></td>
										<td><a href='servicios_E.php?id=".$fila['id']."'>editar</a></td>
										</tr>";
									  
						}

						echo"</table>";
						
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