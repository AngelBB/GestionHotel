<?php session_start();
if (empty($_SESSION['masajista'])){
	header ("Location: ../../../login.html");
}else{

include '../../herramientas/conexion.php';//Para abrir conexion con la BD
$devolver='Error al procesar la informacion';
if(isset($_POST['tarifa']) && isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['descripcion']) && isset($_POST['nuevo'])){
		
	function cod_tarifa($conex){
		$consulta="select max(cod_tarifa) as codigo from tarifa";
		$resultado=mysqli_query($conex,$consulta);//Solo devolvera uno 
		$datos=mysqli_fetch_array($resultado);
		$resultado=$datos['codigo'] + 1;
			return $resultado; //Devolvemos el mayor del los IDs
	}//funcion
	
	
	//Datos de conexion
	
	$conex=conectarServidor();
	$bd=elegirBD($conex);

	//Sacar los datos
	$tarifa=$_POST['tarifa'];//Sera el id
	$nombre=utf8_decode($_POST['nombre']);
	$precio=$_POST['precio'];
	//$borrar=$_POST['borrar'];
	$nuevo=$_POST['nuevo'];
	$descripcion=utf8_decode($_POST['descripcion']);
	$info="";
	
	//Nueva tarifa
	if(!empty($nuevo) && !empty($nombre) && !empty($precio) && !empty($descripcion) && $nuevo==='true'){
		$codigo=cod_tarifa($conex);
		$consulta="insert into tarifa values($codigo,'$nombre',$precio,'$descripcion')";
		$res=mysqli_query($conex,$consulta);
		$info.= ($res) ? '¡Tarifa insertada correctamente!' : 'Error al insertar tarifa'; //if-else simplificado (operador ternario)
	}else
	{
		//Borrar
		/*if(!empty($borrar)&& !empty($tarifa) && $borrar==='true'){
			$consulta="delete from tarifa where cod_tarifa=$tarifa";
			$res=mysqli_query($conex,$consulta);
			$info.=($res) ? "¡Tarifa borrada correctamente!\n" : "Error al borrar la tarifa";// No puedo borrar las claves foraneas
		}else{*/
			//Nombre
			if(!empty($tarifa) && !empty($nombre)){
				$consulta="update tarifa set nombre='$nombre' where cod_tarifa=$tarifa";//Para actualizar el nombre
				$res=mysqli_query($conex,$consulta);
				$info.=($res) ? "¡Nombre actualizado correctamente!\n" : "Error al actualizar nombre";
			}
			//Precio
			if(!empty($tarifa) && !empty($precio)){
				$consulta="update tarifa set precio=$precio where cod_tarifa=$tarifa";//Para actualizar el precio
				$res=mysqli_query($conex,$consulta);
				$info.=($res) ? "¡Precio actualizado correctamente!\n" : "Error al actualizar el precio";
			}
			//Descripcion
			if(!empty($tarifa) && !empty($descripcion)){
				$consulta="update tarifa set descripcion='$descripcion' where cod_tarifa=$tarifa";//Para actualizar el precio	
				$res=mysqli_query($conex,$consulta);
				$info.=($res) ? "¡Descripcion actualizada correctamente!" : "Error al actualizar la descripcion";
			}
		//}//else de borrar
	}//else de nueva tarifa
	
	mysqli_close($conex);//Cerramos la conexion
	
	$devolver=$info;
}
	echo $devolver;
}//else sesion
?>