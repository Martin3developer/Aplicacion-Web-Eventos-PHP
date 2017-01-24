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
			

			<?php 
				
				$conexion=conexion();

				
				if ($conexion==true) {


					if(isset($_GET['id'])==TRUE){ //tomamos la información del cliente con el id aportado

					$cons= "SELECT * FROM clientes WHERE id = ".$_GET['id'].";";
						
					$resul=mysqli_query($conexion,$cons);

					while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){//mostramos la información en el formulario
							

						echo "<div class='titulopag'>Editar Cliente </div>
							  <div class='formulario'><form action='clientes_E.php?id=".$fila['id']."' method='post'>
							  Nombre<br>
							  <input type='text' name='nombre' value='".$fila['nombre']."' placeholder='Nombre' required><br>
							  Apellidos<br>
							  <input type='text' name='apellidos' value='".$fila['apellidos']."' placeholder='Apellidos' required><br>
							  Dirección<br>
							  <input type='text' name='direccion' value='".$fila['direccion']."' placeholder='Direccion' required><br>
							  Teléfono 1<br>
							  <input type='number' name='telefono1' min='100000000' max='999999999' value='".$fila['telefono1']."' placeholder='Teléfono' required><br>
							  Teléfono 2 (Opcional)<br>
							  <input type='number' name='telefono2' min='100000000' max='999999999' value='".$fila['telefono2']."' placeholder='Teléfono(Opcional)'><br><br>
							  Nombre de usuario (no se puede modificar)<br>
							  <input type='text' name='nick' value='".$fila['nick']."' required readonly><br>
							  Contraseña<br>
							  <input type='text' name='pass' value='".$fila['pass']."' required><br>
							 
							  <input type='submit' name='enviar' value='Enviar'><br>
							  </form></div>";
						}	
					}
					
					
							  
						if(isset($_POST['enviar'])==TRUE){
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
							$pass=$_POST['pass'];

						

							$cons="UPDATE clientes SET nombre = '$nombre' , apellidos = '$apellidos', direccion = '$direccion', telefono1='$telefono1' , telefono2='$telefono3' , pass = '$pass' WHERE id =  ".$_GET['id'].";";
							
							
								$resul=mysqli_query($conexion,$cons);

								//mensaje de confirmación con gif de loading
								echo "<div class='noticiamini'>Cliente modificado satisfactoriamente.<br><img src='../images/giphy.gif'><br>Espere...</div>";
								
								echo"<meta http-equiv='REFRESH' content='1;URL=clientes.php'>";
						
								

						}
							
						
							
					}
						
					mysqli_close($conexion);
			?>
	
			
		</div>
	<div class="columna">
	
	</div>		
</div>	
</div>

<!-- ________________________pie de Pagia ___________________________________________________________________________-->

<?php 
	pie();
 	?>
		
</body>
</html>