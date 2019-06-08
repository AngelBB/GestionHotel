<?php
session_start();
 if (empty($_SESSION['administracion'])){
	header ("Location: ../../../login.html");
}else{

include '../../herramientas/conexion.php';//Para abrir conexion con la BD

$devolver="Error al liberar la habitacion";
if(isset($_POST['informacion']) && !empty($_POST['informacion'])){

$datos=json_decode($_POST['informacion'],true);

//Parametros de conexion
	$conex=conectarServidor();
	$bd=elegirBD($conex);
	
		$cod_cliente=$datos['cod_cliente'];
		$f_salida=$datos['f_salida'];
		
		//Convertimos la fecha
		$aux=explode("-",$f_salida);
		$f_salida=$aux[2]."-".$aux[1]."-".$aux[0];
		
		//Actualizamos el estado de la habitación
			$consulta="update habitacion 
			set ocupada='libre' , disponibilidad='fuera_servicio'
			where numero in (select numero_hab
							from alojado
							where codigo_cliente=$cod_cliente)";
		
		$res=mysqli_query($conex,$consulta);
		
		/*
		*	Al liberar la habitacion vamos a cerrar la fecha del cliente de la habitacion liberada. 
		*	Es decir que cuando se valla el cliente y le demos al boton liberar habitacion la fecha la pondremos 
		*	al dia en el que hayamos pulsado el boton. Esto nos servira si por ejemplo el cliente quiere irse 	
		*	antes del dia estipulado, con su correspondiente bajada y/o ajuste de precio 	
		*/
		//fecha de hoy
		$fecha_hoy=date("Y-m-d");
		$consulta="update alojado
					set f_salida='$fecha_hoy'
					where codigo_cliente=$cod_cliente";
					
		$res=mysqli_query($conex,$consulta);
		if($res){ $devolver="La habitación ha sido liberada"; }
		
		mysqli_close($conex);//Cerramos la conexion
	}//if
		echo $devolver;
}//else de la sesion
?>