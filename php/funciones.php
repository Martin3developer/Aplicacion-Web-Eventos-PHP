
<?php	

function conexion(){
		$conexion=@mysqli_connect('localhost','root','root','agenda')or die("
			<img style='width:100%' src='../images/error.jpg'>");
		    return $conexion;
}

function comprobarSesion(){

	if (isset($_SESSION['sesion'])) {	
			$activo="<a href='../php/acceder.php?sesion=off' class='usu'>Cerrar Sesión</a>";	
		return $activo;
	}else{
			$activo="<a href='../php/acceder.php' class='usu'>Iniciar Sesión</a>";
			$_SESSION['tipo']="I";
		return $activo;
	}
}



function voltearfecha($fecha){
	$fecha1=$fecha;
	$anio = substr($fecha1, 0, 4);    
	$mes = substr($fecha1, 5, 2);    
	$dia = substr($fecha1, 8, 2); 		
	$fecha1=$dia."/".$mes."/".$anio;

	return $fecha1;
}

function fechactual(){

	$hoy=date('Y-m-d');

	return $hoy;
}

	 
?>
