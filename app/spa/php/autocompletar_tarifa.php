<?php session_start();
if(empty($_SESSION['masajista'])){
	header ("Location: ../../../login.html");
}else{
include '../../herramientas/conexion.php';//Para abrir conexion con la BD

if(isset($_POST['tarifa_seleccionada']) && !empty($_POST['tarifa_seleccionada'])){
	//Datos de conexion
	$conex=conectarServidor();
	$bd=elegirBD($conex);

	$consulta="select nombre, precio, descripcion from tarifa where cod_tarifa=".$_POST['tarifa_seleccionada'];
	$cadena="";
	$res=mysqli_query($conex,$consulta);
	$num_filas=mysqli_num_rows($res);
	$arrayCadenas="";
	
	for($i=0;$i<$num_filas;$i++){
		$datos=mysqli_fetch_array($res);
		$arrayCadenas[$i]=Array(
			"nombre"=>utf8_encode($datos['nombre']),
			"precio"=>$datos['precio'],
			"desc"=>utf8_encode($datos['descripcion'])
		);
	}
	$cadenapadre=json_encode($arrayCadenas[0]);
	mysqli_close($conex);//Cerramos la conexion
	echo $cadenapadre;
	}

}//else sesion
?>