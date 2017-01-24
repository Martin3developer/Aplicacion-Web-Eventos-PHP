<?php  
	session_start();
	//En caso de que haya una cookie la cogemos
		if (isset($_COOKIE['Sesion'])) {
			session_decode($_COOKIE['Sesion']);
		}

	include('../php/funciones.php');

	$activo=comprobarSesion();
	//Restringir acceso
	if ($_SESSION['tipo']=="I" || $_SESSION['tipo']=="R") {
		echo"<meta http-equiv='REFRESH' content='0;URL=../index.php?error=true'>";
		die();

	}
?>

<!-- ________________________Cabecera ___________________________________-->
	<?php 
	include('../php/codigohtml.php');
	cabecera($_SESSION['tipo'],$activo);
 	?>

<!-- ________________________Cuerpo ____________________________________-->
	<div class="contenido">
		
		<div class="noticias">
		<!-- Botones de navegación por la sección de clientes-->
				<a href="../php/clientes_N.php"><div class="botones3pag" style='margin-left: 10%'><h3>Crear Cliente</h3></div></a>
				<a href="../php/clientes_F.php"><div class="botones3pag"><h3>Buscar Cliente</h3></div></a>
				<div class='titulopag'>Clientes</div>

			<?php 
				
				$conexion=conexion();
				
				if ($conexion==true) {
					
						$cons="SELECT * FROM clientes WHERE id <> 0 ORDER BY id ASC " ;//mostramos la información de todos los clientes
						
						$resul=mysqli_query($conexion,$cons);

						$cantidad=mysqli_num_rows($resul);
					
						if ($cantidad!=0) {//Comprobaremos que hay algún campo que mostrar

						echo "<div class='tablasgeneral'>
								<table>
									<tr>
										
										<th>Nombre</th>
										<th>Apellidos</th>
										<th>Dirección</th>
										<th>Teléfono</th>
										
										<th>Nick</th>
										<th>Contraseña</th>
										<th></th>
									</tr>";

						while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){
								if ($fila['id']!=0) {
									echo "<tr>
									
										<td>".$fila['nombre']."</td>
										<td>".$fila['apellidos']."</td>
										<td>".$fila['direccion']."</td>
										<td>".$fila['telefono1']." / ".$fila['telefono2']."</td>
										<td>".$fila['nick']."</td>
										<td>".$fila['pass']."</td>
										<td><a href='clientes_E.php?id=".$fila['id']."'><img src='../images/edit.png' width='30px'></a></td>
									  </tr>";//añadimos el botón de modificar al final de cada uno.
								}
								
						}

						echo"</table></div>";
					}else{
						echo"<div class='tablasgeneral'>
								<table>
									<tr>
										<th>Aún no hay clientes registrados</th>
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