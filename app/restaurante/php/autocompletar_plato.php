<?php session_start();
if(empty($_SESSION['restaurante'])){
	header ("Location: ../../../login.html");
}else{
include '../../herramientas/conexion.php';//Para abrir conexion con la BD

if(isset($_POST['plato_seleccionado']) && !empty($_POST['plato_seleccionado'])){
	//Datos de conexion
	$conex=conectarServidor();
	$bd=elegirBD($conex);

	$consulta="select nombre, precio from comida where codigo=".$_POST['plato_seleccionado'];
	$cadena="";
	$res=mysqli_query($conex,$consulta);
	$num_filas=mysqli_num_rows($res);
	$arrayCadenas="";
	
	for($i=0;$i<$num_filas;$i++){
		$datos=mysqli_fetch_array($res);
		$arrayCadenas[$i]=Array(
			"nombre"=>utf8_encode($datos['nombre']),
			"precio"=>$datos['precio'],
		);
	}
	$cadenapadre=json_encode($arrayCadenas[0]);
	mysqli_close($conex);//Cerramos la conexion
	echo $cadenapadre;
	}

}//else sesion
?>