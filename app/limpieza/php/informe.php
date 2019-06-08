<?php session_start();
if (empty($_SESSION['limpieza'])){
	header ("Location: ../../../login.html");
}else{
include '../../herramientas/conexion.php';//Para abrir conexion con la BD


if(isset($_POST['dni_trabajador']) && isset($_POST['numero_habitacion']) && isset($_POST['incidencias']) && isset($_POST['disponible']))
{
	//Datos de conexion
	
	$conex=conectarServidor();
	$bd=elegirBD($conex);

	//Datos del formulario
	$dni=$_POST['dni_trabajador'];
	$habitacion=$_POST['numero_habitacion'];
	$desperfectos=utf8_decode($_POST['incidencias']);
	$finalizada=$_POST['disponible'];
	$aDevolver="Error al insertar informe";//Por defecto


	//Fecha y hora 
	$dia=date("Y/m/d");
	$hora=date("H:i:s");

		$consulta="insert into limpia values('$dni',$habitacion,'$hora','$dia','$desperfectos')";
		$res1=mysqli_query($conex,$consulta);
	
		$consulta="update habitacion set disponibilidad='preparada' where numero=$habitacion";//Lo ponemos a preparada pero no a libre.
		$res2=mysqli_query($conex,$consulta);
		
		mysqli_close($conex);

		if($res1 && $res2){
			$aDevolver='¡ Datos insertados con éxito !';
		}
		echo $aDevolver;//Creamos una sesion en donde indicamos el estado de nuestro informe
}//if de comprobacion de los $_post
}//else de sesion
?>