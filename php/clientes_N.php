<!DOCTYPE html>
<html
<head>
	<title>Clientes</title>
	<meta charset="utf-8">
	<link href="../estilos/style.css" rel="stylesheet" type="text/css">
</head>
<body>

 <div class="centro">
 	<img src="../images/imghead.gif" width="100%">
 </div>

<div class="contenedor">
<!-- ________________________Cabecera ___________________________________________________________________________-->
	<?php 
	include('../php/codigohtml.php');
	cabecera();
 	?>

 	
<!-- ________________________Cuerpo ___________________________________________________________________________-->
	<div class="contenido">
		
		<div class="noticias">
				<a href="../php/clientes_N.php"><div class="botones3pag"><h3>Añadir Nuevo</h3></div></a>
				<a href="../php/clientes_F.php"><div class="botones3pag"><h3>Buscar</h3></div></a>
			

			<?php 
				include('../php/conexion.php');
				$conexion=conexion();
				

				
				if ($conexion==true) {

					$cons="SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA =  'practica' and TABLE_NAME = 'clientes';";
					$resul=mysqli_query($conexion,$cons) or die(mysqli_error());
					while ($fila=mysqli_fetch_array($resul, MYSQLI_NUM)) {

					
						echo "<div class='titulopag'><h1>Añadir Cliente</h1></div>
							  <div class='noticia'><form action='#' method='post'>
							  ID<br>
							  <input type='text' name='nombre' value='".$fila[0]."' disabled  ><br>
							  Nombre<br>
							  <input type='text' name='nombre' value='' placeholder='Nombre'><br>
							  Apellidos<br>
							  <input type='text' name='apellidos' value='' placeholder='Apellidos'><br>
							  Dirección<br>
							  <input type='text' name='direccion' value='' placeholder='Direccion'><br>
							  Teléfono 1<br>
							  <input type='text' name='telefono1' value='' placeholder='Teléfono'><br>
							  Teléfono 2 (Opcional)<br>
							  <input type='text' name='telefono2' value='' placeholder='Teléfono(Opcional)'><br><br>
							  Nombre de usuario<br>
							  <input type='text' name='nick' value=''><br>
							  Contraseña<br>
							  <input type='text' name='pass' value=''><br>
							 
							  <input type='submit' name='enviar' value='enviar'><br>
							  </form></div>";
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
							echo "$telefono2";
							$nick=$_POST['nick'];
							$pass=$_POST['pass'];

							$cons="INSERT INTO clientes VALUES (NULL, '$nombre', '$apellidos', '$direccion', '$telefono1','$telefono3','$nick','$pass');";
							
								$resul=mysqli_query($conexion,$cons) or die(mysqli_error());
								echo "Cliente $nombre creado exitosamente";


						}
							
						//echo"<meta http-equiv='REFRESH' content='5';URL=noticias.php?bien=true'>";
							
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