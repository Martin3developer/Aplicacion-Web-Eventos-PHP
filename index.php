<?php  
	session_start();
//_____________________________________________________________________
// Aplicacion Eventos___________________Desarrollo de aplicaciones Web |
// Sesiones y Cookies_____________________________Martín Carmona López |
// Fecha de Modificación____________________________________24/01/2017 |
//_____________________________________________________________________|	

	//En caso de que haya una cookie la cogemos
		if (isset($_COOKIE['Sesion'])) {
			session_decode($_COOKIE['Sesion']);
		}
	include('php/funciones.php');

	$activo=comprobarSesion();

	if (isset($_GET['error'])) { 
			echo "<a href='index.php'><div class='alerta'><i class='fa fa-exclamation-triangle fa-2x aria-hidden='true' ></i><br>¡NECESITAS PERMISOS PARA ACCEDER A LA DIRECCIÓN! </div></a>";
		}

// ________________________Cabecera ________________________________________________________________________

	include('php/codigohtml.php');
	
	cabecera($_SESSION['tipo'],$activo);
	
	
	$conexion=conexion();
	if (!isset($conexion)) {
		die();
	}
//Imagen aleatoria de un evento y su descripción
	
	$cons="SELECT imagen , nombre FROM servicios";
	$resul=mysqli_query($conexion,$cons);
	$cantidad=mysqli_num_rows($resul);
	//Comprobar que siempre hay una imagen en el jumbotron
	if ($cantidad!=0) {
		while ($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)) {
			$img[]=$fila['imagen'];
			$nombre[]=$fila['nombre'];
		}
		mysqli_close($conexion);
		
		$random=rand(0,count($img)-1);
		echo "<div class='imagent' style='background-image:url($img[$random]); '>

				<div class='textosuperpuesto'><br><br>Disfruta del servicio:<br> <strong>$nombre[$random]</strong><br><br>
					<a href='php/contacto.php' >
						<div class='selfecha' style='margin-top:-20px'><input type=submit value='Pídelo' style=' height:50px;font-size:20px'></div>
					</a>
				</div>
		</div>";
	}else{
		echo "<div class='imagent' style='background-color:#F78181'>
			<div class='textosuperpuesto'><br><br>Aún no hay ningun servicio registrado:<br> <strong>Sea paciente :)</strong>
			</div>
		</div>";
	}
	

 	?>
<!-- ________________________Cuerpo ___________________________________________________________________________-->
		

	<div class="contenido">

		<div class="noticias">

			<div class="titulopag">Últimas noticias</div>
				<?php 
				
					$conexion=conexion();

					if ($conexion==true) {
					$fechadehoy=fechactual();
					
					//Esta consulta nos devolvera solo las 3 ultimas noticias anteriores al día de hoy.
					$cons="SELECT * FROM noticias WHERE fecha <= '".$fechadehoy."' ORDER BY fecha DESC LIMIT 4;";
					$resul=mysqli_query($conexion,$cons);
					$cantidad=mysqli_num_rows($resul);
					//Comprobar que siempre hay una imagen en el jumbotron
					if ($cantidad!=0) {
						while ($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)) {
						$fecha1=voltearfecha($fila["fecha"]);
						$cont=substr($fila["contenido"], 0, 300); 

						echo "<div class='noticia'>";
						echo "	<div class='titulo'>".$fila["titular"]."</div>";
						echo "	<div class='subtitulo'><i><b>".$fecha1."</b></i></div>";
						echo "	<img src='".$fila["imagen"]."'>";
						
						echo "	<div class='cuerpo'>".$cont."...</div>";
						echo "	<a href='../php/noticias_S.php?id=".$fila['id']."'>
									<div class='boton'><i><b>Leer Más  >></b></i></div>
								</a>
							</div>";
						
						}
					}else{
						echo "<div class='noticia'>";
						echo "	<div class='titulo'>Todabía no tenemos noticias que mostrar</div>";
						echo "	<div class='subtitulo'><i><b>Pronto actualizaremos la página </b></i></div>";
						
						
						echo "	<div class='cuerpo'>Esta página está aún en fase de desarrollo...</div>";
						echo "	<a href='#'>
									<div class='boton'><i><b>Leer Más  >></b></i></div>
								</a>
							</div>";
					}
					mysqli_close($conexion);
				
					}
				?>
			
		</div>	
					
	</div>	
</div> <!--Cierre del contenedor-->


<!-- ________________________pie de Pagia ___________________________________________________________________________-->

	<?php 
	pie();
 	?>
 	

</body>
</html>