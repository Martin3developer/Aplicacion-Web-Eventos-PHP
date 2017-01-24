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

 
<!-- ________________________Cabecera ___________________________________________________________________________-->
	<?php 
	include('../php/codigohtml.php');
	cabecera($_SESSION['tipo'],$activo);
 	?>

 	
<!-- ________________________Cuerpo ___________________________________________________________________________-->
	<div class="contenido">
		
		<div class="noticias">
		<!-- Botones de navegación por la sección de clientes-->
				<a href="../php/clientes_N.php"><div class="botones3pag" style='margin-left: 10%'><h3>Crear Cliente</h3></div></a>
				<a href="../php/clientes_F.php"><div class="botones3pag"><h3>Buscar Cliente</h3></div></a>
				<div class='titulopag'>Buscar Cliente</div>

			<?php 
				
				$conexion=conexion();
					
				if ($conexion==true) {//formulario de busqueda
					
						echo "
							  <div class='formulario'><form action='#' method='get'>
							  Introduce el Nombre, Apellido o Teléfono<br>
							  <input type='text' name='nombre' value='' required><br>
							  <input type='text' name='order' value='1' hidden>
							  <input type='submit' name='enviar' value='Enviar'>
							  <br>
							  </form></div>";


						if(isset($_GET['enviar'])==TRUE){
							$nombre=$_GET['nombre'];
							$order=$_GET['order'];//variable que define el orden
							if ($order=="1") {
								$cons="SELECT * FROM clientes WHERE ((nombre like '%$nombre%' || apellidos like '%$nombre%' || telefono1 like '%$nombre%' || telefono2 like '%$nombre%') AND (id <>0)) ORDER BY nombre ASC;" ;
							}else{
								$cons="SELECT * FROM clientes WHERE ((nombre like '%$nombre%' || apellidos like '%$nombre%' || telefono1 like '%$nombre%' || telefono2 ) AND (id <>0))like '%$nombre%' ORDER BY apellidos ASC;" ;

							}
						
							
							$resul=mysqli_query($conexion,$cons);//pintamos la tabla con los resultados
							$cantidad=mysqli_num_rows($resul);

					if ($cantidad!=0) {//Comprobaremos que hay algún campo que mostrar



								echo "<div class='tablasgeneral'><table>
									<tr>
										<th>ID</th>
										<th ><a href='../php/clientes_F.php?enviar=enviar&order=1&nombre=$nombre'>Nombre 
										";
										if ($order=="1") {
											echo "<br>&#9660;";
										}else{           //direccion de las flechas
											echo "<br>&#9650";
										}
								echo"</a></th>
										<th><a href='../php/clientes_F.php?enviar=enviar&order=2&nombre=$nombre'>
										Apellidos";
										if ($order=="2") {
											echo "<br>&#9660;";
										}else{//direccion de las flechas
											echo "<br>&#9650";
										}
								echo "  </a></th>
										<th>Dirección</th>
										<th>Teléfono1</th>
										<th>Teléfono2</th>
										<th>Nick</th>
										<th>Contraseña</th>
										<th></th>
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
										<td><a href='clientes_E.php?id=".$fila['id']."'><img src='../images/edit.png' width='30px'></a></td>
									  </tr>"; //al final se le pone el boton de modificar
						}

						echo"</table></div>";

						}else{
							echo "<div class='tablasgeneral'><table>
									<tr>
										<th >No hay resultados que coincidan con la búsqueda</th>
									</tr>
									</table>
								  </div>";
						}
						
					}
					mysqli_close($conexion);	

				}
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