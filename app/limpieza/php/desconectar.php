<?php 
session_start();
//Para borrar sesiones
$_SESSION[]=array();
$comprobacion=session_destroy();
if ($comprobacion) { 
	header ("Location: ../../../login.html"); 
}else{  echo "<!DOCTYPE html> 
				<html>
					<head>
						<title>Error de desconexión</title>
						<link rel='stylesheet' type='text/css' href='estilos.css'>
						<meta charset='UTF-8'>
					</head>
					<body>
						<p>Ha ocurrido un error de desconexión</p>
						<p>Por favor, intentalo de nuevo</p>
					</body>
				</html>";
}
?>