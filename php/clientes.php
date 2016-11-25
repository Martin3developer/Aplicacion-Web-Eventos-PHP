<!DOCTYPE html>
<html
<head>
	<title>Clientes</title>
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
				<a href="../php/clientes_N.php"><div class="botones3pag"><h3>Añadir Nuevo</h3></div></a>
				<a href="../php/clientes_F.php"><div class="botones3pag"><h3>Buscar</h3></div></a>
			

			<?php 
				include('../php/conexion.php');
				$conexion=conexion();
				
				if ($conexion==true) {
					
						$cons="SELECT * FROM clientes ORDER BY id ASC" ;
						
						$resul=mysqli_query($conexion,$cons) or die(mysqli_error());
						echo "<div class='titulopag'><h1>Clientes</h1></div>";
						echo "<table>
									<tr>
										<th>ID</th>
										<th>Nombre</th>
										<th>Apellidos</th>
										<th>Dirección</th>
										<th>Teléfono1</th>
										<th>Teléfono2</th>
										<th>Nick</th>
										<th>Contraseña</th>
									</tr>";

						while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){
								echo "<tr>
										<td>".$fila['id']."</td>
										<td>".$fila['nombre']."</td>
										<td>".$fila['apellidos']."</td>
										<td>".$fila['direccion']."</td>
										<td>".$fila['telefono1']."</td>
										<td>".$fila['telefono2']."</td>
										<td>".$fila['nick']."</td>
										<td>".$fila['pass']."</td>
										<td><a href='clientes_E.php?id=".$fila['id']."'>editar</a></td>
									  </tr>";
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