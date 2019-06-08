<?php
session_start();
 if (empty($_SESSION['administracion'])){
	header ("Location: ../../../login.html");
}else{

include '../../herramientas/conexion.php';//Para abrir conexion con la BD


if(isset($_POST['dni']) && isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['telefono']) && isset($_POST['fecha_salida']) && isset($_POST['numero_habitacion']) && isset($_POST['num_personas'])){

	//Funcion para sacar el codido del cliente mas alto
	function cod_cliente($conex){
		$consulta="select max(cod_cliente) total from cliente";
		$resultado=mysqli_query($conex,$consulta);//Solo devolvera uno 
		$datos=mysqli_fetch_array($resultado);
		$resultado=$datos['total'] + 1;
			return $resultado; //Devolvemos el mayor del los IDs
	}


	//Parametros de conexion
	$conex=conectarServidor();
	$bd=elegirBD($conex);


	/*******************************INSERTAR CLIENTE*************************************/
	//Recibimos los datos del formulario sobre el cliente
	$dni=$_POST['dni'];
	$nombre=utf8_decode($_POST['nombre']);
	$apellidos=utf8_decode($_POST['apellidos']);
	$telefono=$_POST['telefono'];
	$aDevolver='No ha hecho nada';

	//Sobre la estancia 
	$fecha_salida=$_POST['fecha_salida'];
	$num_habitaciones=$_POST['numero_habitacion'];
	$num_personas=$_POST['num_personas'];
	$fecha_entrada=date("Y-m-d");//Lo ponemos en formato ingles

	//Modificamos el formato de la fecha_salida para la BD
	$fecha_salida=explode('/',$fecha_salida);//devuelve un array

	//Formato YYYY/MM/DD
	$fecha_salida_modificada=$fecha_salida[2]."-".$fecha_salida[1]."-".$fecha_salida[0];


	//Llamamos a la funcion exportada

			//Generamos el codigo del cliente
			$cod_cliente=cod_cliente($conex);
			//Consulta que vamos a hacer 
			$consulta="insert into cliente values($cod_cliente,'$dni','$apellidos','$nombre',$telefono)";
			$res=mysqli_query($conex,$consulta);//devolvera true o false si se han metido bien los datos o no 
			
			if($res){
			
				/*******************************INSERTAR ALOJAMIENTO*************************************/
				$consulta="insert into alojado values($cod_cliente,$num_habitaciones,'$fecha_entrada','$fecha_salida_modificada',$num_personas)";
				$res=mysqli_query($conex,$consulta);		
				
				if($res){
					$consulta = "update habitacion set ocupada='ocupada' where numero = $num_habitaciones";//Cambiamos el estado de la habitacion en la BD para que no haya incongluencias
					$res=mysqli_query($conex,$consulta);
					mysqli_close($conex);//cerramos la conexion
					if($res) $aDevolver='¡Cliente insertado con exito!';//Devolvemos true
				}else{
					$aDevolver='Ha ocurrido un error al insertar el cliente';
				}
			}
			echo $aDevolver;//Lo metemos en el div respuesta
}//if de los isset
}//else de sesion
?>