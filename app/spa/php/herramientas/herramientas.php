<?php
session_start();
include "conexiones.php";//Importamos el fichero de conexiones

//Esta funcion nos ayudará a validar la sesion en cualquier documento que la llamemos 
function comprobar_sesion(){

$usuario=$_SESSION['usuario'];
$pass=$_SESSION['pass'];
$control=false;

	if(!empty($usuario) && !empty($pass)){//Comprobamos que este creado
		if(isset($usuario) && isset($pass)){//Comprobamos que 
			//Creamos la conexión
				$base='agenda_personal';
				$conex=conectarServidor();
				$bd=elegirBD($base, $conex);
			//Creamos la consulta
			$consulta="select * from login where usuario='$usuario' and contrasenia='$pass'";
			$res=mysqli_query($consulta,$conex);
			$num_filas=mysqli_num_rows($res);
				
			if($num_filas>0){//Si devuelve algo, sera válido
				$control=true;
			}
		}
	}
	return $control;
}

//Funcion para comprobar el dni

function comprobar_documento_identificacion($dni){
	$control=false;
	if(strlen($dni)<9) {
		return "DNI demasiado corto.";
	}
 
	$dni = strtoupper($dni);
 
	$letra = substr($dni, -1, 1);
	$numero = substr($dni, 0, 8);
 
	// Si es un NIE hay que cambiar la primera letra por 0, 1 ó 2 dependiendo de si es X, Y o Z.
	$numero = str_replace(array('X', 'Y', 'Z'), array(0, 1, 2), $numero);	
 
	$modulo = $numero % 23;
	$letras_validas = "TRWAGMYFPDXBNJZSQVHLCKE";
	$letra_correcta = substr($letras_validas, $modulo, 1);
 
	if($letra_correcta!=$letra){
		return "Letra incorrecta, la letra deber&iacute;a ser la $letra_correcta.";
	}
	else {
		return "OK";
	}
}







?>