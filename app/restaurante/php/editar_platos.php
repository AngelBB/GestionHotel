<?php session_start();
 if (empty($_SESSION['restaurante'])){
	header ("Location: ../../../login.html");
}else{


include '../../herramientas/conexion.php';
$devolver='Error al procesar la información';

	
if(isset($_POST['plato_elegido']) && isset($_POST['nombre_nuevo']) && isset($_POST['precio_nuevo']) && isset($_POST['nuevo_plato']))
{  
	
	/////////////
	//Funciones//
	/////////////
	
	function cod_plato($conex){
		$consulta="select max(codigo) as codigo from comida";
		$resultado=mysqli_query($conex,$consulta);//Solo devolvera uno 
		$datos=mysqli_fetch_array($resultado);
		$resultado=$datos['codigo'] + 1;
			return $resultado; //Devolvemos el mayor del los IDs
	}//funcion


   //Parametros de conexion    
    $conex=conectarServidor();
    $bd=elegirBD($conex);

    //Sacamos los datos del formulario
    $plato_elegido=utf8_encode($_POST['plato_elegido']);//Es el codigo del plato 
    $nombre_nuevo=utf8_decode($_POST['nombre_nuevo']);
    $precio_nuevo=$_POST['precio_nuevo'];
    //$borrar=$_POST['borrar'];
	$nuevo_plato=$_POST['nuevo_plato'];
	//Defino variable info
	$info="";
	
	if(!empty($nombre_nuevo) && !empty($precio_nuevo) && !empty($nuevo_plato) && $nuevo_plato==='true'){
		$codigo=cod_plato($conex);
		$consulta="insert into comida values($codigo,'$nombre_nuevo',$precio_nuevo)";
		$res=mysqli_query($conex,$consulta);
		$info.= ($res) ? '¡Plato insertado correctamente!' : 'Error al insertar plato'; //if-else simplificado (operador ternario)
	}else
	{
	
		/*if(!empty($plato_elegido) && !empty($borrar) && $borrar==='true')
		{//Si borrar es true 
			$consulta="delete from comida where codigo=$plato_elegido";  
			$res=mysqli_query($conex,$consulta);
			$info.=($res) ? "¡Plato borrado correctamente!\n" : "Error al borrar el plato\n";
		}
		else
		{*/	
			//Actualizar nombre
			if(!empty($plato_elegido) && !empty($nombre_nuevo)){
				$consulta="update comida set nombre='$nombre_nuevo' where codigo=$plato_elegido"; 
				$res=mysqli_query($conex,$consulta);
				$info.=($res) ? "¡Nombre del plato actualizado correctamente!\n" : "Error al actualizar el nombre del plato\n";
			}
			
			//Actualizar precio
			if(!empty($plato_elegido) && !empty($precio_nuevo)){
				$consulta="update comida set precio=$precio_nuevo where codigo=$plato_elegido";
				$res=mysqli_query($conex,$consulta);
				$info.=($res) ? "¡Precio del plato actualizado correctamente!\n" : "Error al actualizar el precio del plato" ;
			}
		//}//else de borrar plato
	}//else de nuevo plato
	   
	mysqli_close($conex);//Cerramos la conexion
	$devolver=$info;
}//if de comprobacion
	echo $devolver;
}//else de sesion
?>