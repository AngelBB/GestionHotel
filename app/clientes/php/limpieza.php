<?php 
session_start();
 if (empty($_SESSION['administracion'])){
	header ("Location: ../../../login.html ");
}else{
include '../../herramientas/conexion.php';//Para abrir conexion con la BD

$devolver="Error al solicitar la limpieza";
if(isset($_POST['informacion']) && !empty($_POST['informacion'])){
//Parametros de conexion
	
	$conex=conectarServidor();
	$bd=elegirBD($conex);
	$datos=json_decode($_POST['informacion'],true);

	//Codigo de cliente	
	$cod_cliente=$datos['cod_cliente'];
	
	//Actualizamos el estado de la habitación
	$consulta="update habitacion 
	set disponibilidad='fuera_servicio'
	where numero in (select numero_hab
					from alojado
					where codigo_cliente=$cod_cliente)";
		
	$res=mysqli_query($conex,$consulta);
	if($res){ $devolver="El servicio de limpieza ha sido informado"; }
	mysqli_close($conex);//Cerramos la conexion
}//if
		echo $devolver;
}//else sesion
?>