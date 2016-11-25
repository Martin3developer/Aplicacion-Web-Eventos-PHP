<?php
function cabecera(){
echo"<header>
		
		<nav class='navegador'>
			<div class='izq'>
				<ul>
					<a href='/index.php'><li class='iconazul'>
						&nbsp;&nbsp;<img src='../images/home.png'>
					</li></a>
					<a href='../php/noticias.php'><li class='flecha'>
						Noticias&nbsp;&nbsp;
						<ul class='submenu'>
							<li><a href='../php/noticias_N.php'>Añadir Nueva</a></li>
							<li><a href='../php/noticias_F.php'>Buscar</a></li>
							<li><a href='../php/noticias_D.php'>Borrar</a></li>
						</ul>
					</li></a>
					<a href='../php/clientes.php'><li class='flecha'>
						Clientes&nbsp;&nbsp;
						<ul class='submenu'>
							<li><a href='../php/clientes_N.php'>Añadir Nuevo</a></li>
							<li><a href='../php/clientes_F.php'>Buscar</a></li>
						</ul>
					</li></a>
					<a href='../php/servicios.php'><li class='flecha'>
						Servicios&nbsp;&nbsp;
						<ul class='submenu'>
							<li><a href='../php/servicios_N.php'>Añadir Nuevo</a></li>
							<li><a href='../php/servicios_F.php?opcion3=buscar'>Buscar</a></li>
						</ul>
					</li></a>
					<a href='../php/eventos.php'><li class='flecha'>
						Eventos&nbsp;&nbsp;
						<ul class='submenu'>
							<li><a href='../php/eventos_N.php'>Añadir Nuevo</a></li>
							<li><a href='../php/eventos_F.php'>Buscar</a></li>
							<li><a href='../php/eventos_D.php'>Borrar</a></li>
						</ul>
					</li></a>
					<a href='#'><li>
						Contacto&nbsp;&nbsp;
					</li></a>
					<a href='#'><li>
						Acceder&nbsp;&nbsp;
					</li></a>
				</ul>
			</div>
			<div class='der'>
				<ul>
					<li class='iconazul'>
						&nbsp;&nbsp;&nbsp;&nbsp;
					</li>
					<li>
						<input type='text' name='buscar' placeholder='Buscar Noticia' width='50px' >
					</li>
					<a href='#'><li>
						<img src='../images/pinterest.png' height='20px'>
					</li></a>
				</ul>
			</div>
		</nav>
	</header>";
}

function pie(){

	echo "<footer>
			<div class='estilo1'>
				<input type='button' name=''></input>
			</div>
			<div class='estilo2'>
			<div>© Copyright 2016, All Rights Reserved Martín Carmona </div>
				
				<div class='redes'>
				<ul>
					</li>

							<a href='#'><li>
								Martín Carmona López
							</li></a>

							<a href='#'><li>
								Práctica Entorno Servidor
							</li></a>
						

				</ul>
				</div>
			</div>
			
		</footer>";
}


?>