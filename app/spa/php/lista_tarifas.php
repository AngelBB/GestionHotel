<?php session_start();
 if (empty($_SESSION['masajista'])){
	header ("Location: ../../../login.html");
}else{
include '../../herramientas/conexion.php';//Para abrir conexion con la BD

//Datos de conexion

$conex=conectarServidor();
$bd=elegirBD($conex);

$consulta="select cod_tarifa, nombre from tarifa";
$cadena="";

$res=mysqli_query($conex,$consulta);

$num_filas=mysqli_num_rows($res);

for($i=0;$i<$num_filas;$i++){
	$datos=mysqli_fetch_array($res);
	$datos['cod_tarifa'];
	$datos['nombre'];
	
	$cadena.="<option value=".$datos['cod_tarifa'].">".utf8_encode($datos['nombre'])."</option>";

}
	mysqli_close($conex);//Cerramos la conexion

	echo $cadena;
}//else sesion
?>