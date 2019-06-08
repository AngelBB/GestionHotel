<?php
function conectarServidor(){
	$conex=mysqli_connect('localhost','root',''); //localhost, nombre de usuario, contraseña
		if(!$conex){
			echo "No estás conectado";
		}
	return $conex;
}

function elegirBD($conex){
$base='hotel';
	$bd=mysqli_select_db($conex, $base);
	if(!$bd){
		echo "Error al conectar a la base de datos";
	}
	return $bd;
}
?>