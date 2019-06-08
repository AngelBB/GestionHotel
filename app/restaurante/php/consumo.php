<?php session_start();
 if (empty($_SESSION['restaurante'])){
	header ("Location: ../../../login.html");
}else{

include '../../herramientas/conexion.php';
$devolver='Error al insertar el gasto';

if(isset($_POST['cod_cliente']) && isset($_POST['cod_plato']) && !empty($_POST['cod_cliente']) && !empty($_POST['cod_plato'])){
    //Parametros de conexion    
    $conex=conectarServidor();
    $bd=elegirBD($conex);
    
    /*******************************INSERTAR GASTO*************************************/
    //Recibimos los datos de lo formulario
   $codigo_cliente=$_POST['cod_cliente'];
   $codigo_plato=unserialize(stripslashes($_POST['cod_plato']));//Deserializamos la cadena enviada por AJAX
   //Y se convierte en un array. Este array contiene los codigos de las comidas
	
	//Recorremos el array e insertamos cada codigo como un nuevo gasto del cliente
	foreach($codigo_plato as $j){
		//Fecha y hora
		$hora=date("H:i:s");
		$fecha=date("Y/m/d");
	  
		//Hacemos la consulta
	  	$consulta="insert into come value($codigo_cliente,$j,'$hora','$fecha')";
		$res=mysqli_query($conex,$consulta);
	}
	mysqli_close($conex);
	
    if($res){
        $devolver='¡El gasto ha sido insertado correctamente!';
    }
}//If de comprobaciones de variables 
	echo $devolver;
}//else de sesion
?>