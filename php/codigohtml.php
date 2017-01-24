<?php
function cabecera($user , $activo){

	//Método para pintar el navegador dependiendo de la página en la que esté.
$url1 = parse_url($_SERVER['REQUEST_URI']);
$url=$url1['path'];


 if (isset($_GET['LaCuriosidadMatoAlGato'])) {//botón del pie de página
			echo "<div class='yo'></div>";;
		}

$usuario=$user;

echo"

<!DOCTYPE html>
<html>
	<head>
	<title>Nuestro evento</title>
	<meta charset='utf-8'>
	<meta name='theme-color' content='#1D1D1D'>
	<meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0;'>   

	<link  rel='stylesheet' href='../estilos/style.css'>
	<link rel='stylesheet' href='../estilos/font-awesome.min.css' >
	</head>
<body>


<header id='header' class='cabecera'>
	

			<a href='/index.php' ><div class='logogrande'></div></a>
 			<a href='/index.php' ><div src='../images/imghead1.gif' class='logo'></div></a>
 			<div class='usuario'>";

 		if ($_SESSION['tipo']=="I") {
 			echo"<a href=../php/acceder.php><div class='circulo'><i class='fa fa-user' ></i></div></a>
 			<br>";
 		}else{
 			echo "<a href=../php/perfil.php ><div class='circulo registrado'>".ucfirst($_SESSION['nick'])."</div></a><br>";
 		}
 			echo"
 			<div class='btn-menu' id='btn-menu'><i class='icono  fa fa-bars ' aria-hidden='true'></i> </div>
 			<br><b style='margin-left:-15px; '>$activo</b>
 		</div>


 		<div class='enlaces' id='enlaces'>"; 
		//---------INVITADO----------------------------------------------------------------	
if ($usuario=='I') {
		//-------------------------------------------Inicio

	echo"<a href='/index.php' ";
	if ($url=="/index.php") {
		echo " class='sel'";
	}
	echo"><i class='fa fa-home fa-3x'></i>
	</a>";	

	//-------------------------------------------Servicios
	echo"<a href='../php/servicios.php' ";
	if ($url=="/php/servicios.php" || $url=="/php/servicios_E.php" || $url=="/php/servicios_N.php"  || $url=="/php/servicios_F.php") {
		echo " class='sel'";
	}
	echo">
		Servicios&nbsp;&nbsp;
	</a>";

	echo" <a href='../php/contacto.php' ";
	if ($url=="/php/contacto.php") {
		echo " class='sel'";
	}
	echo">Contacto&nbsp;&nbsp;
	 </a>";


			
	}

		//---------REGISTRADO----------------------------------------------------------------	
		if ($usuario=='R') {



					//-------------------------------------------Servicios
					echo"<a href='../php/servicios.php'";
					if ($url=="/php/servicios.php" || $url=="/php/servicios_E.php" || $url=="/php/servicios_N.php"  || $url=="/php/servicios_F.php") {
						echo " class='sel'";
					}
					echo">
						Servicios&nbsp;&nbsp;
					</a>";

					//-------------------------------------------Mis Datos
					echo"<a href='../php/perfil.php'";
					if ($url=="/php/perfil.php") {
						echo " class='sel'";
					}
					echo">
						Perfil&nbsp;&nbsp;
					</a>";

					//-------------------------------------------Eventos
					
					$fecha2=getdate();
					if ($fecha2['mon']<10) {
						$fecha2['mon']="0".$fecha2['mon'];
					}
					echo"<a href='../php/eventos.php?mes=".$fecha2['mon']."&anio=".$fecha2['year']."&mostrar=Mostrar#'";
					if ($url=="/php/eventos.php" || $url=="/php/eventos_D.php" || $url=="/php/eventos_F.php" || $url=="/php/eventos_N.php") {
						echo " class='sel'";
					}
					echo">Eventos&nbsp;&nbsp;
					 </a>";

					 echo" <a href='../php/contacto.php' ";
					if ($url=="/php/contacto.php") {
						echo " class='sel'";
					}
					echo">Contacto&nbsp;&nbsp;
					 </a>";

				
		}	

		//---------ADMINISTRADOR----------------------------------------------------------------	
		if ($usuario=='A') {


					//-------------------------------------------Noticias
					echo"<a href='../php/noticias.php'";
					if ($url=="/php/noticias.php" || $url=="/php/noticias_D.php" || $url=="/php/noticias_F.php" || $url=="/php/noticias_N.php" || $url=="/php/noticias_S.php") {
						echo " class='sel'";
					}
					echo">Noticias&nbsp;&nbsp;
					 </a>";

					//-------------------------------------------Clientes
					
						echo"<a href='../php/clientes.php' ";
						if ($url=="/php/clientes.php" || $url=="/php/clientes_E.php" || $url=="/php/clientes_F.php" || $url=="/php/clientes_N.php") {
							echo " class='sel'";
						}
						echo">Clientes&nbsp;&nbsp;
						 </a>";
					
				
					
					//-------------------------------------------Servicios
					echo"<a href='../php/servicios.php' ";
					if ($url=="/php/servicios.php" || $url=="/php/servicios_E.php" || $url=="/php/servicios_N.php"  || $url=="/php/servicios_F.php") {
						echo " class='sel'";
					}
					echo">
						Servicios&nbsp;&nbsp;
					 </a>";
					
					//-------------------------------------------Eventos
					
					echo"<a href='../php/eventos.php' ";
					if ($url=="/php/eventos.php" || $url=="/php/eventos_D.php" || $url=="/php/eventos_F.php" || $url=="/php/eventos_N.php") {
						echo " class='sel'";
					}
					echo">Eventos&nbsp;&nbsp;
					 </a></div>";
				

					
			}
	
	
echo"</header>";




					
			echo "<div class='contenedor'>";
}

function pie(){
		//metodo que pinta el pie de página

	echo "	
	
	<footer>
			<div class='estilo1'>
				<form action='#' method='get' ><input type='submit' name='LaCuriosidadMatoAlGato' value=''></input></form>
			</div>

			<div class='estilo2'>
				<div>© Copyright 2016, All Rights Reserved Martín Carmona </div>
				
				<div class='redes'>
				<ul>

							<a href='../php/contacto.php' ><li>
								Martín Carmona López
							</li></a>

							<a href='../php/contacto.php' ><li>
								Práctica Entorno Servidor
							</li></a>
						

				</ul>
				</div>
			</div>
			
			
		</footer>

	<script src='../js/headroom.min.js'></script>
	<script src='../js/jquery.min.js'></script>	
	<script src='../js/menu.js'></script>		
";
}


?>