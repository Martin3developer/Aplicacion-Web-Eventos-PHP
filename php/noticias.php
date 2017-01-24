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

<!-- ________________________Cabecera ____________________________________-->
	<?php 
	include('../php/codigohtml.php');
	cabecera($_SESSION['tipo'],$activo);
 	?>

 	
<!-- ________________________Cuerpo ______________________________________-->
	<div class="contenido">
		
		<div class="noticias">
		<!-- Botones de navegación por la sección de noticias-->
				<a href="../php/noticias_N.php" ><div class="botones3pag" style='margin-left: 5%'><h3>Crear Noticia</h3></div></a>
				<a href="../php/noticias_F.php"><div class="botones3pag"><h3>Buscar Noticia</h3></div></a>
				<a href="../php/noticias_D.php"><div class="botones3pag"><h3>Borrar Noticia</h3></div></a>
				<div class='titulopag'>Noticias</div>
			

			<?php 
			
				$conexion=conexion();
				
				if ($conexion==true) {
					
					if(isset($_GET['pag'])==TRUE){
						$pag=$_GET['pag'];//para la lista de la paginación
						$pag1=$pag*5; //la noticia correspondera a la página multiplicada por 5
					}else{
						$pag1=0;
						$pag=0;
					}	//se pintarán solo 5 noticias respectivas a su página
						$cons="SELECT * FROM noticias ORDER BY fecha DESC LIMIT $pag1, 5" ;
						
						$resul=mysqli_query($conexion,$cons);

						$cantidad=mysqli_num_rows($resul);
					
						if ($cantidad!=0) {//Comprobaremos que hay algún campo que mostrar


							echo "<div class='tablasgeneral'><table>
									<tr>
										<th>Título</th>
										<th>Fecha</th>
										<th>Imagen</th>
										<th>Cuerpo</th>
										<th></th>
									</tr>";

							while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){
							$fecha1=voltearfecha($fila['fecha']);
							$cont=substr($fila["contenido"], 0, 30); 
							
							echo "<tr>
									<td>".$fila['titular']."</td>
									<td>".$fecha1."</td>
									<td>
										<div class='imnoticias' 
										style=
											'background-image:url(../".$fila['imagen'].");
											 background-size: auto 100px;'>
										</div></td>
									<td>".$cont."...</td>
									<td><a href='noticias_S.php?id=".$fila['id']."'><img src='../images/lupa.png' width='40px'></a></td></tr>";

						}//Cada noticia tendrá el botón de ver mas que lo mandará a la noticia completa.
						echo "</table></div>";

// -------------PAGINACIÓN--------------------------------------

						$cons1="SELECT COUNT(*) cantidad FROM noticias ";
						$resul1=mysqli_query($conexion,$cons1);
						$fila = mysqli_fetch_array($resul1, MYSQLI_NUM);
						$contadorpag=($fila[0]/5)+1;
						
						echo "<div class='pagina'><ul>";
						$paga=$pag-1;
						$pags=$pag+1;

						//Pagina anterior
						if ($paga>=0) {
							echo "<a href='noticias.php?pag=$paga'><li> < </li></a>";
						
						}

						//enumeración de las páginas
						for($i=1;$i<$contadorpag;$i++){
							$j=$i-1;
							echo "<a href='noticias.php?pag=$j'><li ";
							if ($j==$pag) { //Se marca la página en la que estamos
								echo "class='sel'";
							}
							
							echo ">$i</li></a>";
						}		
						//Pagina siguiente
						if ($pags<($contadorpag-1)) {
							echo "<a href='noticias.php?pag=$pags'><li> > </li></a>
						";
						}
						
						echo "</ul></div></div>";


						}else{
							echo"<div class='tablasgeneral'><table>
									<tr>
										<th>Aún no hay noticias registradas</th>
									</tr>
									</table>
								</div>	";
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