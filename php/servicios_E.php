<!DOCTYPE html>
<html
<head>
	<title>Servicios</title>
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
				<a href="../php/servicios_N.php"><div class="botones3pag"><h3>Crear Servicio</h3></div></a>
				<a href="../php/servicios_F.php"><div class="botones3pag"><h3>Buscar Servicio</h3></div></a>
			

			<?php 
				include('../php/conexion.php');
				$conexion=conexion();

				
				if ($conexion==true) {


					if(isset($_GET['id'])==TRUE){

					$cons= "SELECT * FROM servicios WHERE id = ".$_GET['id'].";";
						
					$resul=mysqli_query($conexion,$cons) or die(mysqli_error());

					while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){
							
						echo "<div class='titulopag'><h1>Editar Servicio con ID =  ".$fila['id']."</h1></div>
							  <div class='noticia'><form action='servicios_E.php?id=".$fila['id']."' method='post' enctype='multipart/form-data'>
							  Nombre<br>
							  <input type='text' name='nombre' value='' placeholder='nombre'><br>
							  Descripcion<br>
							  <input type='text' name='descripcion' value='' placeholder='Descripcion'><br>
							  Precio<br>
							  <input type='text' name='precio' value='' placeholder='Precio'><br>
							  Imagen<br>
							  <input type='file' name='imagen' value=''><br>
							  <input type='submit' name='enviar' value='enviar'><br>
							  </form></div>";

						echo "<div class='titulopag'><h1>Editar Cliente con ID = ".$fila['id']."</h1></div>
							  <div class='noticia'><form action='clientes_E.php?id=".$fila['id']."' method='post'>
							  Nombre<br>
							  <input type='text' name='nombre' value='".$fila['nombre']."' placeholder='Nombre'><br>
							  Apellidos<br>
							  <input type='text' name='apellidos' value='".$fila['apellidos']."' placeholder='Apellidos'><br>
							  Dirección<br>
							  <input type='text' name='direccion' value='".$fila['direccion']."' placeholder='Direccion'><br>
							  Teléfono 1<br>
							  <input type='text' name='telefono1' value='".$fila['telefono1']."' placeholder='Teléfono'><br>
							  Teléfono 2 (Opcional)<br>
							  <input type='text' name='telefono2' value='".$fila['telefono2']."' placeholder='Teléfono(Opcional)'><br><br>
							  Nombre de usuario<br>
							  <input type='text' name='nick' value='".$fila['nick']."'><br>
							  Contraseña<br>
							  <input type='text' name='pass' value='".$fila['pass']."'><br>
							 
							  <input type='submit' name='enviar' value='enviar'><br>
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
							$nick=$_POST['nick'];
							$pass=$_POST['pass'];

						

							$cons="UPDATE clientes SET nombre = '$nombre' , apellidos = '$apellidos', direccion = '$direccion', telefono1='$telefono1' , telefono2='$telefono3' , nick = '$nick' WHERE id =  ".$_GET['id'].";";
							
							
								$resul=mysqli_query($conexion,$cons) or die(mysqli_error());
								//echo "Cliente $nombre actualizado exitosamente";
								echo"<meta http-equiv='REFRESH' content='1';URL=clientes.php?bien=true'>";
						
								

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