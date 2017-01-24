<?php  
	session_start();

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
		<!-- Botones de navegación por la sección de servicios-->
				<a href="../php/servicios_N.php"><div class="botones3pag" style='margin-left: 10%'><h3>Crear Servicio</h3></div></a>
				<a href="../php/servicios_F.php"><div class="botones3pag"><h3>Buscar Servicio</h3></div></a>
				<div class='titulopag'>Buscar Servicio</div>
			<?php 
		
				$conexion=conexion();
					
				if ($conexion==true) {//formulario de búsqueda
					
						echo "
							  <div class='formulario'><form action='#' method='get'>
							  Introduce el Nombre del Servicio o Precio<br>
							  <input type='text' name='nombre' value='' required><br>
							  <input type='submit' name='enviar' value='Enviar'><br>
							  <input type='text' name='order' value='1' hidden>
							  </form></div>";


						if(isset($_GET['enviar'])==TRUE){
							$nombre=$_GET['nombre'];
							$order=$_GET['order'];//variable que especifica el orden en el que se mostrarán los datos
							if ($order=="1") {
								$cons="SELECT * FROM servicios WHERE nombre like '%$nombre%' || precio like '%$nombre%' ORDER BY nombre;" ;
							}else{
								$cons="SELECT * FROM servicios WHERE nombre like '%$nombre%' || precio like '%$nombre%' ORDER BY precio;" ;
							}
						
						

							$resul=mysqli_query($conexion,$cons);//Mostramos los datos resultantes de la consulta
								$cantidad=mysqli_num_rows($resul);

					if ($cantidad!=0) {//Comprobaremos que hay algún campo que mostrar


								echo "<div class='tablasgeneral'><table>
									<tr>
										<th>ID</th>
										<th ><a href='../php/servicios_F.php?enviar=enviar&order=1&nombre=$nombre'>Nombre 
										";
										if ($order=="1") {
											echo "<br>&#9660;";
										}else{ //Flechas arriba o abajo
											echo "<br>&#9650";
										}
								
								echo "  </a></th>
										<th>Descripción</th>";
								echo" 	<th><a href='../php/servicios_F.php?enviar=enviar&order=2&nombre=$nombre'>
										Precio";
										if ($order=="2") {
											echo "<br>&#9660;";
										}else{//flechas arriba o abajo
											echo "<br>&#9650";
										}
								echo"	<th>Imagen</th>
										<th></th>
									</tr>";

						while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){
								echo "<tr>
										<td>".$fila['id']."</td>
										<td>".$fila['nombre']."</td>
										<td>".$fila['descripcion']."</td>
										<td>".$fila['precio']." €</td>
										<td><img src=".$fila['imagen']." width='50px;'></td>
										<td><a href='servicios_E.php?id=".$fila['id']."'><img src='../images/edit.png' width='30px'></a></td> 
										</tr>";//Añadimos el boton de editar
									  
						}

						echo"</table></div>";	

						}else{
						echo"<div class='tablasgeneral'>
								<table>
									<tr>
										<th>No hay resultados que coincidan con la búsqueda</th>
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