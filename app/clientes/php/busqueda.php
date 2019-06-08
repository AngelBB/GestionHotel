<?php 
session_start();
 if (empty($_SESSION['administracion'])){
	header ("Location: ../../../login.html ");
}else{

include '../../herramientas/conexion.php';//Para abrir conexion con la BD

//*****Funcion para recorrer el resultado***** 
function recorrerResultado($num_cols,$arrResultado){

	if($num_cols>0){
	//Sacamos un array con las filas y su informacion
			//****Cliente**** 
			$resultado="";
			$resultado.="
			<table id='resultado' class='table table-bordered table-hover'><thead>
			<tr>
				<th>Codigo cliente</th>
				<th>Dni/Nie</th>
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Tlf</th>
				<th>Numero hab.</th>
				<th>Fecha entrada</th>
				<th>Fecha salida</th>
				<th>Imprimir</th>
				<th>Avisar limpieza</th>
				<th>Liberar habitacion</th>
			</tr></thead><tbody>";
			
			for($i=0;$i<$num_cols;$i++){
				$datos=mysqli_fetch_array($arrResultado);
				
				//Revisar las variables
				$urlFactura="php/calcular_factura.php?dni=".$datos['dni']."&cod_cliente=".$datos['cod_cliente']."&f_entrada=".$datos['f_entrada']."&f_salida=".$datos['f_salida'];
				
				//NOTA: $urlLibre y $urlLimpieza los he dejado como texto , ya es mas facil para trabajarlo con JS 
				//Estas dos variables las pasare como un value de un button y le asignare unos ids para mayor comodidad a la 
				//hora de extraerlos, tratarlos y enviarlos cada uno a su parte correspondiente.
				
				//Vamos a convertir a json estas cadenas
				$jsonLibre['cod_cliente']=$datos['cod_cliente'];
				$jsonLibre['f_salida']=$datos['f_salida'];
				$jsonLimpieza['cod_cliente']=$datos['cod_cliente'];
				
				//He decido hacerlas a json para que sea mas facil en JQuery
				$cadenaLibre=json_encode($jsonLibre);
				$cadenaLimpieza=json_encode($jsonLimpieza);
				
				//Cambio de formato las fechas para que tengan un formato 'amigable'
				$aux_entrada=explode("-",$datos['f_entrada']);
				$fecha_entrada=$aux_entrada[2]."/".$aux_entrada[1]."/".$aux_entrada[0];
							
				$aux_salida=explode("-",$datos['f_salida']);
				$fecha_salida=$aux_salida[2]."/".$aux_salida[1]."/".$aux_salida[0];
				
				$resultado.="<tr>
					<td>".$datos['cod_cliente']."</td>
					<td>".$datos['dni']."</td>
					<td>".utf8_encode($datos['nombre'])."</td>
					<td>".utf8_encode($datos['apellidos'])."</td>
					<td>".$datos['tlf']."</td>
					<td>".$datos['numero_hab']."</td>
					<td>".$fecha_entrada."</td>
					<td>".$fecha_salida."</td>
					<td><a class='factura btn btn-default btn-xs' href='#' onclick=window.open('$urlFactura','','width=1024,height=800')>Imprimir factura</td>
					<td><button class='limpieza btn btn-success btn-xs' value='$cadenaLimpieza' type='button'>Limpiar</button></td>
					<td><button class='liberar btn btn-warning btn-xs' value='$cadenaLibre' type='button'>Liberar</button></td>
					</tr>";
			}
			$resultado.="</tbody><tfoot></tfoot></table>";
	}else{
		$resultado="";
	}		
		return $resultado;
}//cierre funcion



//*****************************************
				///////////////
				// Principal //
				///////////////
//*****************************************

if(isset($_POST['busqueda']) && !empty($_POST['busqueda'])){
$b=$_POST['busqueda'];

	//Parametros de conexion
		$conex=conectarServidor();
		$bd=elegirBD($conex);
		$resultado="";//En donde se guardara la tabla con los resultados de la consulta	
		
	//Para convertir las fechas a formato ingles
		/*$aux_salida=explode("/",$b);
		$fecha=$aux_salida[2]."-".$aux_salida[1]."-".$aux_salida[0];	*/
	

	


	
	//Consulta base
		$consulta_base="select cli.cod_cliente, cli.dni, cli.nombre, cli.apellidos, cli.tlf,  alo.numero_hab, alo.f_entrada, alo.f_salida, alo.num_personas 
		from cliente cli
		inner join alojado alo
		on cli.cod_cliente=alo.codigo_cliente 
		where cli.cod_cliente LIKE '%".$b."%' OR
		cli.dni LIKE '%".$b."%' OR
		cli.nombre LIKE '%".$b."%' OR
		cli.apellidos LIKE '%".$b."%' OR
		cli.tlf LIKE '%".$b."%' OR
		alo.numero_hab LIKE '%".$b."%' OR
		alo.f_entrada LIKE '%".$b."%' OR
		alo.f_salida LIKE '%".$b."%'";
		
		
		
		
		//Realizamos la consulta
		$resultado_cliente=mysqli_query($conex,$consulta_base);
		
		//Sacamos los numeros de columnas
		$numero_columnas=mysqli_num_rows($resultado_cliente);//Hay que tener ciudado con num_cols ya que puede ser vacio y daria un error
		
		//Guardamos la tabla generada por la funcion
		$tabla=recorrerResultado($numero_columnas,$resultado_cliente);//Guardamos lo que nos devuelva
		
		mysqli_close($conex);//cerramos la conexion
		
		echo $tabla; //Devolvemos por pantalla, la tabla generada por la función recorrerResultado() 
	}
	
//Para sacar lista completa	
if(isset($_POST['lista_completa']) && !empty($_POST['lista_completa']) && $_POST['lista_completa']=='true'){
	
	//Parametros de conexion
		$conex=conectarServidor();
		$bd=elegirBD($conex);
		$resultado="";//En donde se guardara la tabla con los resultados de la consulta	
		
	//Consulta base
		$consulta_base="select cli.cod_cliente, cli.dni, cli.nombre, cli.apellidos, cli.tlf,  alo.numero_hab, alo.f_entrada, alo.f_salida, alo.num_personas 
		from cliente cli, alojado alo
		where cli.cod_cliente=alo.codigo_cliente";
		
		//Realizamos la consulta
		$resultado_cliente=mysqli_query($conex,$consulta_base);
		
		//Sacamos los numeros de columnas
		$numero_columnas=mysqli_num_rows($resultado_cliente);//Hay que tener ciudado con num_cols ya que puede ser vacio y daria un error
		
		//Guardamos la tabla generada por la funcion
		$tabla=recorrerResultado($numero_columnas,$resultado_cliente);//Guardamos lo que nos devuelva
		
		mysqli_close($conex);//cerramos la conexion
		
		echo $tabla; //Devolvemos por pantalla, la tabla generada por la función recorrerResultado() 
}
	
	
	
}//else de sesion
?>
