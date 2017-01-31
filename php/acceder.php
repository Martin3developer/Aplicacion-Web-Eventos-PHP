<?php  
	session_start();
	//En caso de que quiera RECORDAR la sesión al cerrar el navegador
		if (isset($_GET['recordar'])) {
					$cookiesesion=session_encode();
					setcookie("Sesion", $cookiesesion, time()+86400*365,"/");
					echo"<meta http-equiv='REFRESH' content='0;URL=../index.php'>";
					die(); //Esto lo ponemos para que no lea mas de la página ya que si no
						   // se vería por una milésima de segundo
		}
		
	//En caso de que haya una COOKIE la cogemos
		if (isset($_COOKIE['Sesion'])) {
			session_decode($_COOKIE['Sesion']);
		}
		
	//En caso de que quiera CERRAR SESION y borrar las cookies que tenga
		if (isset($_GET['sesion'])) {
				$_SESSION= array();
				session_destroy();
				//unset($_COOKIE['Sesion']);     -> Descubriendo si funciona
				setcookie("Sesion", "", time()-2,"/");
					echo"<meta http-equiv='REFRESH' content='0;URL=../index.php'>";
					die();
	
		}
		
	include('../php/funciones.php');

	$activo=comprobarSesion();

//--------------CABECERA--------------------------------

	include('../php/codigohtml.php');
	cabecera($_SESSION['tipo'], $activo);
	$conexion=conexion();

	//si mandamos nombre y usuario lo comprobará para que se pueda loguear
	if(isset($_POST['enviar'])){
						
		$cons="SELECT nick , pass , id FROM clientes" ;
		$resul=mysqli_query($conexion,$cons);
		$valido=0;

		
		//Buscamos entre todos los usuarios, si hay coincidencias será valido
		while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){
				
			if ($_POST['nick']==$fila['nick'] && $_POST['pass']==$fila['pass']) {

				$_SESSION['nick']=$_POST['nick'];
				$_SESSION['id']=$fila['id'];
				$_SESSION['sesion']=true;

				if ($fila['id']==0) { //Si el id es 0 es el administrador
					$_SESSION['tipo']="A";
				}else{
					$_SESSION['tipo']="R";
				}

				$valido=1;

			}
		}

		//si pulsa recordar recargaremos esta página, si no redirigirá al index
		if ($valido==1) {
			if (isset($_POST['recordar'])) {
			echo"<meta http-equiv='REFRESH' content='0;URL=../php/acceder.php?recordar=true'>";
			}else{
				echo"<meta http-equiv='REFRESH' content='0;URL=../index.php'>";
			}

		}
			
	}

//----------------------CUERPO------------------------

		if ($conexion==true) {
			echo "

<div class='contenido'>
		
		<div class='noticias'>
		
				<div class='titulopag'>Acceder</div>";
		
			//Pintamos el formulario
				echo "<div class='formulario'><form action='#' method='post'>
					  Nombre de Usuario<br>
					  <input type='text' name='nick' value='' placeholder='' required><br>
					  Contraseña<br>
					  <input type='password' name='pass' value='' required><br>";
					  if(isset($_POST['enviar'])){
							if ($valido==0) {
							echo "<span style='color: #C71609'>Usuario y contraseña Incorrectos</span><br>";
							}
						}
						echo"<br>Recuerdame
					  <div class='custom-checkbox'>
					  <input name='recordar' class='custom-checkbox-input' type='checkbox' id='custom-checkbox-discovery' value='1' checked/>
					  <label class='custom-checkbox-label' for='custom-checkbox-discovery'>
					  <label class='custom-checkbox-label-aux' for='custom-checkbox-discovery'>
					  </label></div>
					  <input type='submit' name='enviar' value='Enviar'><br>
					  </form></div>

					  <div class='noticiamini' style='text-align:center;'>(Solo para Chari)<br><br>Usuario / contraseña <br><br><strong>Administrador</strong><br> admin / admin<br><strong>Usuario</strong><br> martin / 11111111<br></div>
					  </div>
	</div>	
</div>";
					
		}
		
		mysqli_close($conexion);
	
	 
	pie();
 	?>
		
</body>
</html>