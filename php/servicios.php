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
					
					if(isset($_GET['pag'])==TRUE){
						$pag=$_GET['pag'];
						$pag=$pag*5;
					}else{
						$pag=0;
					}
						echo "<div class='titulopag'><h1>Servicios</h1></div>";
						$cons="SELECT * FROM servicios ORDER BY id ASC" ;
						
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
										<td><img src=".$fila['imagen']." width='100px;'></td>
										<td><a href='servicios_E.php?id=".$fila['id']."'>editar</a></td></tr>";
						}

						echo"</table>";
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