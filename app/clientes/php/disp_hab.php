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
	
	$consulta="SELECT numero, tipo
				FROM habitacion
				WHERE ocupada='libre' and tipo='$habitaciones'";
	$res=mysqli_query($conex,$consulta);
	$cols=mysqli_num_rows($res);
	$cadena="";
	
	if($cols>=1){
		for($i=0;$i<$cols;$i++){
		
			$datos=mysqli_fetch_array($res);
			if($i==0){
				$cadena.="<h2>".$datos['tipo']."</h2><p>Total habitaciones: ".$cols."</p><ul>";
			}
				$cadena.="<li>".$datos['numero']."</li>";
		}
		$cadena.="</ul>";
	}else{
		$cadena="No hay habitaciones disponibles";
	}
	mysqli_close($conex);
	echo $cadena;
}
else
	echo "error";
}//else de sesion
?>