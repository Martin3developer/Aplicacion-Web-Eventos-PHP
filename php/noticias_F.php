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
		<!-- Botones de navegación por la sección de noticias-->
				<a href="../php/noticias_N.php"><div class="botones3pag" style='margin-left: 5%'><h3>Crear Noticia</h3></div></a>
				<a href="../php/noticias_F.php"><div class="botones3pag"><h3>Buscar Noticia</h3></div></a>
				<a href="../php/noticias_D.php"><div class="botones3pag"><h3>Borrar Noticia</h3></div></a>
				<div class='titulopag'>Buscar Noticia</div>
			<?php 
				
				$conexion=conexion();
				

				
				if ($conexion==true) {//Formulario de búsqueda
					
						echo "<div class='formulario'><form action='#' method='get'>
							  Introduce el Título o la Fecha de activación<br>
							  <input type='text' name='titulo' value='' required><br>
							    <input type='text' name='order' value='1' hidden>
							  <input type='submit' name='enviar' value='Enviar'><br>
							  </form></div>";

 
						if(isset($_GET['enviar'])==TRUE){


							$titulo=$_GET['titulo'];
							$order=$_GET['order'];//variable que indicará el orden por el que se muestran las noticias
						
							if ($order=="1") {
								$cons="SELECT * FROM noticias WHERE titular like '%$titulo%' || fecha like '%$titulo%' ORDER BY titular;" ;
							}else{
								$cons="SELECT * FROM noticias WHERE titular like '%$titulo%' || fecha like '%$titulo%' ORDER BY fecha;" ;
							}
							$resul=mysqli_query($conexion,$cons);
							$cantidad=mysqli_num_rows($resul);

				if ($cantidad!=0) {//Comprobaremos que hay algún campo que mostrar

								echo "<div class='tablasgeneral'><table>
									<tr>
									<th ><a href='../php/noticias_F.php?enviar=enviar&order=1&titulo=$titulo'>Título";
										if ($order=="1") {
											echo "<br>&#9660;";
										}else{
											echo "<br>&#9650";
										}
								echo "  </a></th>
										<th ><a href='../php/noticias_F.php?enviar=enviar&order=2&titulo=$titulo'>Fecha";
										if ($order=="2") {
											echo "<br>&#9660;";
										}else{
											echo "<br>&#9650";
										}
								echo "  </a></th>
										<th>Imagen</th>
										<th>Cuerpo</th>
										<th></th>
									</tr>";

						

						while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){
						$fecha1=voltearfecha($fila['fecha']);//volteamos la fecha en formato español
						$cont=substr($fila["contenido"], 0, 30); //Reducimos el contenido para que se observe mejor en la tabla y en caso de querer verlo entero pulsar el boton de ver más
						echo "<tr>
										<td>".$fila['titular']."</td>
										<td>".$fecha1."</td>
										<td><img src=../".$fila['imagen']." width='100px;'></td>
										<td>".$cont."...</td>
										<td><a href='noticias_S.php?id=".$fila['id']."'><img src='../images/lupa.png' width='20px'></a></td>
							</tr>";

						}
						echo "</table></div>";
					}else{
						echo "<div class='tablasgeneral'><table>
									<tr>
									<th>No hay noticias que coincidan</th>
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