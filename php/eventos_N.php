<!DOCTYPE html>
<html
<head>
	<title>Eventos</title>
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
				<a href="../php/eventos_N.php"><div class="botones3pag"><h3>Crear Evento</h3></div></a>
				<a href="../php/eventos_F.php"><div class="botones3pag"><h3>Buscar Evento</h3></div></a>
				<a href="../php/eventos_D.php"><div class="botones3pag"><h3>Borrar Evento</h3></div></a>
			<?php 
				include('../php/conexion.php');
				$conexion=conexion();
				

				
				if ($conexion==true) {
					
						echo "<div class='titulopag'><h1>Añadir Evento</h1></div>
							  <div class='noticia'><form action='#' method='post' >
							  Cliente<br>
							  <select name='id_cliente'>";
								$cons="SELECT id, nombre, apellidos FROM clientes";
								$resul=mysqli_query($conexion,$cons) or die(mysqli_error());

								while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){
								echo "<option value=".$fila['id'].">".$fila['nombre']." , ".$fila['apellidos']."</option>";
								}

						echo"</select><br><br>Servicio<br>
								<select name='id_servicio'>";
								$cons="SELECT id, nombre FROM servicios";
								$resul=mysqli_query($conexion,$cons) or die(mysqli_error());

								while($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)){
								echo "<option value=".$fila['id'].">".$fila['nombre']."</option>";
								}
							 	
							  echo "</select><br><br>
							  Lugar<br>
							  <input type='text' name='lugar' value=''><br>
							  Fecha<br>
							  <input type='date' name='fecha'value=''><br>
							  Hora<br>
							  <input type='text' name='hora' value='00:00'><br>
							  <input type='submit' name='enviar' value='enviar'><br>
							  </form></div>";


						if(isset($_POST['enviar'])==TRUE){
							$id_servicio=$_POST['id_servicio'];
							$id_cliente=$_POST['id_cliente'];
							$lugar=$_POST['lugar'];
							$fecha=$_POST['fecha'];
							$hora=$_POST['hora'];
							print_r($_POST);
							
							$cons="INSERT INTO eventos VALUES ($id_servicio, $id_cliente, '$lugar','$fecha','$hora');" ;
							
								$resul=mysqli_query($conexion,$cons) or die(mysqli_error());

						echo "Noticia creada con exito";
						}
							
						//echo"<meta http-equiv='REFRESH' content='5';URL=noticias.php?bien=true'>";
							
						}
						
					mysqli_close($conexion) 
			
				
			
				
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