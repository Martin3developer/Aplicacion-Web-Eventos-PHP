<?php  
	session_start();
		//En caso de que haya una cookie la cogemos
		if (isset($_COOKIE['Sesion'])) {
			session_decode($_COOKIE['Sesion']);
		}
	include('../php/funciones.php');

	$activo=comprobarSesion();

?>



<!-- ________________________Cabecera ___________________________________________________________________________-->
	<?php 
	include('../php/codigohtml.php');
	cabecera($_SESSION['tipo'],$activo);
	$conexion=conexion();
 	?>

 	
<!-- ________________________Cuerpo ___________________________________________________________________________-->
	<div class="contenido">
		
		<div class="noticias">
			
				<div class='titulopag'>Contacto</div>
			<?php 
			
				
				

				
				if ($conexion==true) {
				
					
						echo "<div class='formulario'><form action='#' method='post'>
							  Nombre<br>
							  <input type='text' name='titulo' value='' placeholder='' required><br>
							  Email<br>
							  <input type='email' name='email' value='' placeholder='ejemplo@evento.com' required><br>
							  Consulta<br>
							  <textarea name='cuerpo' required>Escribe tu consulta aquí.</textarea><br>
							  <input type='submit' name='enviar' value='Enviar'><br>
							  </form></div>";

						
						if(isset($_POST['enviar'])){
							
							
							
								
								
								echo "<div class='noticiamini'>Mensaje enviado exitosamente<br><img src='../images/giphy.gif'><br>Espere...</div>";
								echo"<meta http-equiv='REFRESH' content='3;URL=contacto.php?bien=true'>";

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