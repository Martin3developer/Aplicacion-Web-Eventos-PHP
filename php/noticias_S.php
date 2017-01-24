 <?php @session_start(); //Aquí da un error de header arleady exist. ponemos el arroba para que no se vea.

 ?>

 <?php


	include('../php/funciones.php');
	$activo=comprobarSesion();


//________________________Cabecera ___________________________________________________________________________
	include('../php/codigohtml.php');
	cabecera($_SESSION['tipo'],$activo);
 ?>

 	
<!-- ________________________Cuerpo______________________________-->
	<div class="contenido">
		
		<div class="noticias">
		<!-- Botones de navegación por la sección de noticias-->
			
				<div class='titulopag'>Noticias</div>
			

			<?php 
		
				$conexion=conexion();
				
				if ($conexion==true) {
					
					if(isset($_GET['id'])==TRUE){//Tras recibir el id buscamos el resto de información
						$id=$_GET['id'];
						
						
						$cons="SELECT * FROM noticias WHERE id=$id;" ;
					
						
						$resul=mysqli_query($conexion,$cons);
						$cantidad=mysqli_num_rows($resul);

						if ($cantidad!=0) {

							$fila=mysqli_fetch_array($resul, MYSQLI_ASSOC);

							$fecha1=voltearfecha($fila['fecha']);//ponemos la fecha en formato español

								echo "<div class='noticia' style='width:80%'>";
								echo "<div class='titulo'>".$fila["titular"]."</div>";
								echo "<div class='subtitulo'><i><b>".$fecha1."</b></i></div>";
								echo "<img src='../".$fila["imagen"]."'>";
								
								echo "<div class='cuerpo'>".$fila["contenido"]."</div>
								<a href='../index.php'>
										<div class='boton'><i><b><< Volver atrás</b></i></div>
									</a>
								</div>";
								
						}else{
							echo"<meta http-equiv='REFRESH' content='0;URL=../index.php?error=true'>";
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