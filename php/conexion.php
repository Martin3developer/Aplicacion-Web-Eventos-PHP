
<?php	function conexion(){

		$conexion=mysqli_connect('localhost','root','root','practica');
		return $conexion;
	
}

/*
	
	if ($conexion==true) {
		$cons="SELECT nombre FROM ALUMNOS";
		

		$resul=mysqli_query($conexion,$cons);
		$num_campos=mysqli_num_rows($resul);
		echo "hay un total de $num_campos alumnos";
		echo "<h1>Nombre de alumnos:</h1>";
		while ($fila=mysqli_fetch_array($resul, MYSQLI_ASSOC)) {
			echo "<br>".$fila["nombre"];
		}

	}else{
		echo "maaaaaal";
	}
	mysqli_close($conexion);
	*/
?>
