<?php
session_start();//Inicializamos la sesion	

include 'herramientas/conexion.php';//Para abrir conexion con la BD
include 'herramientas/validacion_dni_nie.php';//Para validar dni-nie

	//Variable del form
	$dni_trabajador=$_POST['usuario'];
	
	//Comprobamos que el dni tenga un formato válido
	if(comprobar_documento_identificacion($dni_trabajador)){

		//Conexion
		//$base='hotel';
		$conex=conectarServidor();
		$bd=elegirBD($conex);		
		
		// ***Si pertenece a limpieza*** 
		$consulta="select * from trabajador where dni='$dni_trabajador' and especialidad='limpieza'";
		$res=mysqli_query($conex,$consulta);//Resultado
		$columnas=mysqli_num_rows($res);//Numero de filas
		$datos=mysqli_fetch_array($res);
		
		if($columnas == 1){
			$_SESSION['limpieza']=$dni_trabajador;//Creamos la sesion del usuario actual
			$_SESSION['nombre']=utf8_encode($datos['nombre']);
			$_SESSION['apellidos']=utf8_encode($datos['apellidos']);
			header ("Location: limpieza/informe.php ");
			
		}else{
			// *** Si pertenece a masajista ***
			$columnas=0; //Lo ponemos a cero por seguridad
			$datos=0;
			mysqli_free_result($res);//Liberamos el resultado
			$consulta="select * from trabajador where dni='$dni_trabajador' and especialidad='masajista'";
			$res=mysqli_query($conex,$consulta);
			$columnas=mysqli_num_rows($res);
			$datos=mysqli_fetch_array($res);
			
			if($columnas == 1){
				$_SESSION['masajista']=$dni_trabajador;//Creamos la sesion del usuario actual
				$_SESSION['nombre']=utf8_encode($datos['nombre']);
				$_SESSION['apellidos']=utf8_encode($datos['apellidos']);
				header ("Location: spa/reservas.php ");
			}else{
				// ***Si pertenece al restaurante*** 
				$columnas=0; //Lo ponemos a cero por seguridad
				$datos=0;
				mysqli_free_result($res);//Liberamos el resultado
				$consulta="select nombre, apellidos,especialidad from trabajador where dni='$dni_trabajador'";
				$res=mysqli_query($conex,$consulta);
				$datos=mysqli_fetch_array($res);
				
				if($datos['especialidad'] == 'restaurante'){
					$_SESSION['restaurante']=$dni_trabajador;
					$_SESSION['nombre']=utf8_encode($datos['nombre']);
					$_SESSION['apellidos']=utf8_encode($datos['apellidos']);
					header ("Location: restaurante/consumo.php");
					
				}else{
					// ***Si pertenece a administracion***
					mysqli_free_result($res);//Liberamos el resultado
					$datos=0;
					$consulta="select nombre, apellidos, especialidad from trabajador where dni='$dni_trabajador'";
					$res=mysqli_query($conex,$consulta);
					$datos=mysqli_fetch_array($res);
					
					if($datos['especialidad']=='administrativo'){
						$_SESSION['administracion']=$dni_trabajador;
						$_SESSION['nombre']=utf8_encode($datos['nombre']);
						$_SESSION['apellidos']=utf8_encode($datos['apellidos']);
						header ("Location: clientes/clientes.php");
						
					}else{
						header ("Location: ../login.html");//Si ninguna de las otras comprobaciones son validas nos llevara al login
					}	
				}
			}
		}//else
				mysqli_free_result($res);//Liberamos el resultado
				mysqli_close($conex);//Cerramos la conexion	
	}else{
	
		header ("Location: ../login.html");
	}

?>