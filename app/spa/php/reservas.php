<?php session_start();
 if (empty($_SESSION['masajista'])){
	header ("Location: ../../../login.html");
}else{


include '../../herramientas/conexion.php';//Para abrir conexion con la BD
$devolver='Error al realizar la reserva';
if(isset($_POST['cod_cliente']) && isset($_POST['servicios']) && isset($_POST['fecha']) && isset($_POST['hora'])){
	function cod_cita($conex){
		$consulta="select max(cod_cita) from citas";
		$resultado=mysqli_query($conex,$consulta);//Solo devolvera uno 
		$datos=mysqli_fetch_array($resultado);
		$resultado=$datos[0] + 1;
			return $resultado; //Devolvemos el mayor del los IDs
	}

	//Datos de conexion
	$conex=conectarServidor();
	$bd=elegirBD($conex);
		
	//Datos del formulario	
	$codigo_cliente=$_POST['cod_cliente'];
	$codigo_tarifa=$_POST['servicios'];
	$fecha=$_POST['fecha'];
	$hora=$_POST['hora'];
	$dni_masajista=$_SESSION['masajista'];
	
	//Modificamos la fecha para que el formato de la BD sea compatible
	$fecha_modificada=explode("/",$fecha);
	$fecha=$fecha_modificada[2]."/".$fecha_modificada[1]."/".$fecha_modificada[0];
	
	$codigo_cita=cod_cita($conex);
		$consulta="insert into citas values ($codigo_cita,$codigo_tarifa,$codigo_cliente,'$dni_masajista','$hora','$fecha')";
		$res=mysqli_query($conex,$consulta);
		mysqli_close($conex);
		if($res){
			$devolver='¡Reserva hecha con exito!';
		}
}

echo $devolver;
}//else de session
?>
