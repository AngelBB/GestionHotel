<?php session_start();
 if (empty($_SESSION['restaurante'])){
	header ("Location: ../../../login.html");
}else{
include '../../herramientas/conexion.php';//Para abrir conexion con la BD

//Datos de conexion
$conex=conectarServidor();
$bd=elegirBD($conex);

$consulta="select codigo, nombre from comida";
$res=mysqli_query($conex,$consulta);
$num_filas=mysqli_num_rows($res);
$cadena="";

for($i=0;$i<$num_filas;$i++){
	$datos=mysqli_fetch_array($res);
	
	$cadena.="<option value=".$datos['codigo'].">".utf8_encode($datos['nombre'])."</option>";
}
	mysqli_close($conex);//Cerramos la conexion

	echo $cadena;
}//else de sesion
?>