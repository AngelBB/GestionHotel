<?php 
session_start();
 if (empty($_SESSION['administracion'])){
	header ("Location: ../../../login.html ");
}else{

include '../../herramientas/conexion.php';//Para abrir conexion con la BD

	//Datos de conexión
	$conex=conectarServidor();
	$bd=elegirBD($conex);
	
	//Variables recibidas
	$cod_cliente=$_GET['cod_cliente'];//Para poder calcular cualquier factura debemos saber el codigo del cliente OBLIGATORIAMENTE.
	
	//Fecha salida y entrada debemos sacar los ultimos valores , es decir los mas modernos 
	//en caso de que halla varias veces el mismo cliente en diferentes fechas. Esto lo necesitamos para poder calcular los gastos
	//producidos en cada venida al hotel y no hacerlo en el total de las veces que ha venido.
	$fecha_entrada=$_GET['f_entrada'];
	$fecha_salida=$_GET['f_salida'];
	$dni=$_GET['dni'];
	
//***********************************************************************
//***********************************************************************	
							////////////////
							//Sacar Nombre//
							////////////////
//***********************************************************************
//***********************************************************************	


$consulta="select nombre, apellidos
			from cliente
			where dni='$dni'";
$res=mysqli_query($conex,$consulta);
$n_col=mysqli_num_rows($res);
$nombre_completo=mysqli_fetch_array($res);

$nombre=$nombre_completo['nombre'];
$apellidos=$nombre_completo['apellidos'];

mysqli_free_result($res);


//***********************************************************************
//***********************************************************************	
							///////////////
							//FACTURA SPA//
							///////////////
//***********************************************************************
//***********************************************************************


	//Para sacar el nombre de la tarifa y su precio a modo de factura
	$consulta1="select nombre, precio, ci.hora, ci.dia 
				from tarifa ta, citas ci
				where ta.cod_tarifa=ci.cod_tarifa and ci.cod_cliente=$cod_cliente and ci.dia>='$fecha_entrada' and ci.dia<='$fecha_salida'";
	
	
	
	
	//Con esta consulta sacamos el total de todo o contratado
	$consulta2="select sum(ta.precio) as total 
				from citas ci, tarifa ta
				where ci.cod_tarifa=ta.cod_tarifa and ci.cod_cliente=$cod_cliente and ci.dia>='$fecha_entrada' and ci.dia<='$fecha_salida'";
	
	
	$res1=mysqli_query($conex,$consulta1);
	$res2=mysqli_query($conex,$consulta2);
	
	$n_col1=mysqli_num_rows($res1);
	
	
	if($n_col1<1)//Si la columna es cero nos indicara que no hay gastos
	{
		$tabla_spa="No hay gastos";
	}else
	{
		$tabla_spa="";
		$tabla_spa.="<table id=factura_spa><tr><th>Nombre tarifa</th><th>Precio €</th><th>Hora</th><th>Dia</th></tr>";
		for($i=0;$i<$n_col1;$i++)
		{
			if($i==0)
			{
				$datos2=mysqli_fetch_array($res2);
				$total_spa=$datos2['total'];
			}
				$datos1=mysqli_fetch_array($res1);
				$tabla_spa.="<tr><td>".utf8_encode($datos1['nombre'])."</td>
				<td>".$datos1['precio']."</td>
				<td>".$datos1['hora']."</td>
				<td>".$datos1['dia']."</td>
				</tr>";
			
		}
		$tabla_spa.="<tr><th colspan='3'>Total</th><th>".$total_spa."</th></tr></table>";
	}
	
	//Limpiamos las variables (excepto $tabla_spa)
	mysqli_free_result($res1);
	mysqli_free_result($res2);
	$consulta1="";
	$consulta2="";
	$n_col1="";
	$datos1="";
	$datos2="";
	
//***********************************************************************
//***********************************************************************	
						///////////////////////														
						//FACTURA RESTAURANTE//
						///////////////////////
//***********************************************************************	
//***********************************************************************	


	//Para sacar el nombre de la tarifa y su precio a modo de factura
	$consulta1="select com.nombre, com.precio, co.hora, co.fecha
				from comida com, come co
				where com.codigo=co.codigo_plato AND co.codigo_cli=$cod_cliente AND co.fecha>='$fecha_entrada' and co.fecha<='$fecha_salida'";
	
	
	
	
	//Con esta consulta sacamos el total de todo o contratado
	$consulta2="select sum(co.precio) as total 
				from comida co, come com
				where co.codigo=com.codigo_plato and com.codigo_cli=$cod_cliente and com.fecha>='$fecha_entrada' and com.fecha<='$fecha_salida'";
	
	
	$res1=mysqli_query($conex,$consulta1);
	$res2=mysqli_query($conex,$consulta2);
	
	$n_col1=mysqli_num_rows($res1);
	
	if($n_col1<1)//Si la columna es cero nos indicara que no hay gastos
	{
		$tabla_restaurante="No hay gastos";
	}else
	{
		$tabla_restaurante="";
		$tabla_restaurante.="<table id=factura_rest><tr><th>Nombre plato</th><th>Precio €</th><th>Hora</th><th>Fecha</th></tr>";
		for($i=0;$i<$n_col1;$i++)
		{
			if($i==0)
			{
				$datos2=mysqli_fetch_array($res2);
				$total_restaurante=$datos2['total'];
			}
				$datos1=mysqli_fetch_array($res1);
				$tabla_restaurante.="<tr><td>".utf8_encode($datos1['nombre'])."</td>
				<td>".$datos1['precio']."</td>
				<td>".$datos1['hora']."</td>
				<td>".$datos1['fecha']."</td></tr>";
			
		}
		$tabla_restaurante.="<tr><th colspan='3'>Total</th><th>".$total_restaurante."</th></tr></table>";
	}
	
	//Limpiamos las variables (excepto $tabla_restaurante)
	mysqli_free_result($res1);
	mysqli_free_result($res2);
	$consulta1="";
	$consulta2="";
	$n_col1="";
	$datos1="";
	$datos2="";
	
//***********************************************************************
//***********************************************************************	
						///////////////////////														
						//FACTURA ALOJAMIENTO//
						///////////////////////
//***********************************************************************	
//***********************************************************************	



//Para sacar la habitacion escogida y su precio
	$consulta1="select hab.tipo, hab.precio, alo.f_entrada, alo.f_salida
				from habitacion hab, alojado alo
				where hab.numero=alo.numero_hab AND alo.codigo_cliente=$cod_cliente AND alo.f_entrada>='$fecha_entrada' and alo.f_salida>='$fecha_salida'";
	
	$res1=mysqli_query($conex,$consulta1);
	
	$n_col1=mysqli_num_rows($res1);
	
	if($n_col1<1)//Si la columna es cero nos indicara que no hay gastos
	{
		$tabla_alojamiento="No se ha alojado";
	}else
	{
		$tabla_alojamiento="";
		$tabla_alojamiento.="<table id=factura_aloj><tr><th>Tipo habitación</th><th>Precio/dia €</th><th>Fecha de entrada</th><th>Fecha de salida</th><th>Numero de dias alojado</th></tr>";
		for($i=0;$i<$n_col1;$i++)
		{
			
				$datos1=mysqli_fetch_array($res1);
				//Para calcular los dias que ha estado alojado
				$aux_fecha_entrada=explode("-",$datos1['f_entrada']);
				$aux_fecha_salida=explode("-",$datos1['f_salida']);
				
				//Las fechas las guardamos con formato europeo DD/MM/YYYY
				$fecha_entrada=$aux_fecha_entrada[2]."-".$aux_fecha_entrada[1]."-".$aux_fecha_entrada[0];
				$fecha_salida=$aux_fecha_salida[2]."-".$aux_fecha_salida[1]."-".$aux_fecha_salida[0];
				
				//Para sacar el total de dias alojado
				//if($aux_fecha_entrada[2]<$aux_fecha_salida[2]){
					//$totaldias=$aux_fecha_entrada[2]-$aux_fecha_salida[2];
					$dias	= (strtotime($datos1['f_entrada'])-strtotime($datos1['f_salida']))/86400;//lo dividimos en el numero de segundos que tiene un dia
					$dias 	= abs($dias); $dias = floor($dias);		
					$totaldias=$dias;
				//}
				
				$tabla_alojamiento.="<tr><td>".$datos1['tipo']."</td>
				<td>".$datos1['precio']."</td>
				<td>".$fecha_entrada."</td>
				<td>".$fecha_salida."</td>
				<td>".$totaldias."</td>
				</tr>";
				if($totaldias==0){
					$totaldias=1;
					$total_alojamiento=($datos1['precio']*$totaldias);
				}else{
					$total_alojamiento=($datos1['precio']*$totaldias);
				}
		}
		$tabla_alojamiento.="<tr><th colspan='4'>Total</th><th>".($datos1['precio']*$totaldias)."€</th></tr></table>";
	}

	//Limpiamos las variables (excepto $tabla_alojamiento)
	mysqli_free_result($res1);
	$consulta1="";
	$n_col1="";
	$datos1="";
	

	//Cerramos la conexion al terminar todas las operaciones
	mysqli_close($conex);
	
	
	//Concatenamos los resultados de las diferentes partes
	
	if(isset($total_restaurante) && isset($total_spa)){
		$resultado=$total_restaurante+$total_spa+$total_alojamiento;
	}else if(isset($total_restaurante)){
		$resultado=$total_restaurante+$total_alojamiento;
	}else if(isset($total_spa)){
		$resultado=$total_spa+$total_alojamiento;
	}else{
		$resultado=$total_alojamiento;
	}

	
?>
<!doctype html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link href="css/factura.css" type="text/css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Montez' rel='stylesheet' type='text/css'>
	<noscript><meta http-equiv="Refresh" content="0;url=../aviso.html"></noscript>
	<title>Facturas</title>
	<link rel="stylesheet" href="" />
	<link href='http://fonts.googleapis.com/css?family=Alegreya' rel='stylesheet' type='text/css'>
</head>

<body>
<header>
	<img class='logo' src='logo/logo.png'/>
	
	<span id='cif'>CIF: G40579641</span>
</header>

	<div id='contenedor'>
		<h4>Nombre cliente: <?php echo utf8_encode($nombre." ".$apellidos); ?></h4> 
		<h4>Dni/Nie: <?php echo utf8_encode($dni); ?></h4>
		<hr noshade="noshade" />
		<h3>Factura Spa</h3>
		<?php echo $tabla_spa; ?>
		<hr/>
		<h3>Factura Restaurante</h3>
		<?php echo $tabla_restaurante; ?>
		<hr/>
		<h3>Factura Hospedaje</h3>
		<?php echo $tabla_alojamiento; ?>
		<hr/>
		<h3>Total a pagar: <?php echo ($resultado); ?>€</h3>
		<button id='imprimir' type='submit'>Imprimir Factura</button>
	</div>
	<script>
	
		function accionBoton(){
				document.getElementById("imprimir").style.visibility="hidden";//Ocultamos para que no aparezca el boton al imprimir
				window.print();//E imprimimos
				document.getElementById("imprimir").style.visibility="visible";//Y despues lo volvemos a mostrar
		}
		window.onload=function(){
			document.getElementById("imprimir").onclick=accionBoton;
		}
	</script>
</body>
</html>
<?php }//else de sesion ?>