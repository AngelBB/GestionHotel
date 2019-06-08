<?php
session_start();
 if (empty($_SESSION['administracion'])){
	header ("Location: ../../../login.html");
}else{
//Segun la habitacion elegida sacaremos el numero de habitaciones disponibles en la BD

if(isset($_POST['habitacion'])){
	$habitaciones=$_POST['habitacion'];
	include '../../herramientas/conexion.php';
	
	$conex=conectarServidor();
	$bd=elegirBD($conex);
	
	$consulta="SELECT numero
				FROM habitacion
				WHERE ocupada='libre' and tipo='$habitaciones'";
	$res=mysqli_query($conex,$consulta);
	$cols=mysqli_num_rows($res);
	$cadena="";
	
	
	for($i=0;$i<$cols;$i++){
		$datos=mysqli_fetch_array($res);
			$cadena.="<option>".$datos['numero']."</option>";
	}
	mysqli_close($conex);
	echo $cadena;
}
}//else de sesion
?>