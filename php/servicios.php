<?php  
	session_start();

	include('../php/funciones.php');

	$activo=comprobarSesion();
?>


<!-- ________________________Cabecera ___________________________________________________________________________-->
	<?php 
	include('../php/codigohtml.php');
	cabecera($_SESSION['tipo'],$activo);
	$conexion=conexion();
 	?>

 	
<!-- ________________________Cuerpo ___________________________________________________________________________-->
	<div class="contenido">
		
		<div class="noticias">
		<!-- Botones de navegación por la sección de servicios-->
		<?php 
		if ($_SESSION['tipo']=="A") {
			echo"<a href='../php/servicios_N.php'><div class='botones3pag' style='margin-left: 10%'><h3>Crear Servicio</h3></div></a>
				<a href='../php/servicios_F.php'><div class='botones3pag'><h3>Buscar Servicio</h3></div></a>
			    ";
		}
		echo "<div class='titulopag'>Servicios</div>";
				

			
				
				
				
				if ($conexion==true) {
						
						$cons="SELECT * FROM servicios ORDER BY id ASC" ;//Mostramos la información de todos los servicios
						
						$resul=mysqli_query($conexion,$cons);
							$cantidad=mysqli_num_rows($resul);

					if ($cantidad!=0) {//Comprobaremos que hay algún campo que mostrar

						echo "<div class='tablasgeneral'><table>
									<tr>
										<th>ID</th>
										<th>Nombre</th>
										<th>Descripción</th>
										<th>Precio</th>
										<th>Imagen</th>
										<th></th>
										
									</tr>";

						while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){
								echo "<tr>
										<td>".$fila['id']."</td>
										<td>".$fila['nombre']."</td>
										<td>".$fila['descripcion']."</td>
										<td>".$fila['precio']." €</td>
										<td><img src=".$fila['imagen']." width='100px;'></td>";
										if ($_SESSION['tipo']=="A") {
											echo"<td><a href='servicios_E.php?id=".$fila['id']."'>
											<img src='../images/edit.png' width='30px'></a></td></tr>";
										}else{
											echo "<td></td>";
										}
						}

						echo"</table></div>";

						}else{
						echo"<div class='tablasgeneral'>
								<table>
									<tr>
										<th>Aún no hay servicios registrados</th>
									</tr>
								</table>
							</div>";
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