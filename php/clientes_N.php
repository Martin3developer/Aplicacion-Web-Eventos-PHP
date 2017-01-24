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
				<div class='titulopag'>Añadir Cliente</div>
			

			<?php 
			
				$conexion=conexion();
				

				
				if ($conexion==true) {
					//la siguiente consulta nos devolverá el número de id que se le asignará al nuevo campo
					$cons="SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA =  'agenda' and TABLE_NAME = 'clientes';";
					$resul=mysqli_query($conexion,$cons);
					while ($fila=mysqli_fetch_array($resul, MYSQLI_NUM)) {
						$id=$fila[0];
					//pintamos el formulario para la creación de clientes
						echo "
							  <div class='formulario'><form action='#' method='post'>
							  ID<br>
							  <input type='text' name='nombre' value='$id' readonly ><br>
							  Nombre<br>
							  <input type='text' name='nombre' value='' placeholder='Nombre' required><br>
							  Apellidos<br>
							  <input type='text' name='apellidos' value='' placeholder='Apellidos' required><br>
							  Dirección<br>
							  <input type='text' name='direccion' value='' placeholder='Direccion' required><br>
							  Teléfono 1<br>
							  <input type='number' name='telefono1' min='600000000' max='999999999' value='' placeholder='Teléfono' required><br>
							  Teléfono 2 (Opcional)<br>
							  <input type='number' name='telefono2' min='600000000' max='999999999' value='' placeholder='Teléfono(Opcional)'><br><br>
							  Nombre de usuario<br>
							  <input type='text' name='nick' value='' required><br>
							  Contraseña<br>
							  <input type='text' name='pass' value='' required><br>
							 
							  <input type='submit' name='enviar' value='Enviar'><br>
							  </form></div>";
					}
							  //Comprobamos que el nick no esta siendo usado por otro cliente ya que este tiene que ser unico
						if(isset($_POST['enviar'])==TRUE){
							$cons="SELECT nick FROM clientes;";

							$resul=mysqli_query($conexion,$cons);
							$nickv=true;
							while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){

									$nombre=$_POST['nombre'];
									$apellidos=$_POST['apellidos'];
									$direccion=$_POST['direccion'];
									$telefono1=$_POST['telefono1'];
									$telefono2=$_POST['telefono2'];
									if($telefono2==""){
										$telefono3= NULL;
									}else{
										$telefono3=$telefono2;
									}
									$nick=$_POST['nick'];
								if ($nick==$fila['nick']) {
									$nickv=false;
								}
									$pass=$_POST['pass'];
							}
							if ($nickv==true) {
								$cons="INSERT INTO clientes VALUES (NULL, '$nombre', '$apellidos', '$direccion', '$telefono1','$telefono3','$nick','$pass');";
							
								$resul=mysqli_query($conexion,$cons);
								//Mensaje de confirmacion
								echo "<div class='noticiamini'>Cliente creado satisfactoriamente.<br><img src='../images/giphy.gif'><br>Espere...</div>";
								echo"<meta http-equiv='REFRESH' content='3;URL=clientes.php?bien=true'>";
							}else{
								echo "<div class='noticiamini'><br><- El nombre de usuario está actualmente en uso.<br><br>Intentelo de nuevo.</div>";
							}
							
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