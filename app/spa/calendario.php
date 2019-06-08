<?php session_start();
if (empty($_SESSION['masajista'])){
	header ("Location: ../../login.html");
}else{
?>
<?php
include '../herramientas/conexion.php';

function comprobarFecha($mes,$arrcita,$diasMes){
if(is_array($arrcita)){
	//Con el foreach recorreremos el array 
	foreach($arrcita as $j){
		
		$aux=substr($mes,5);
		//Con ltrim() retiramos los ceros de los dias iniciales del mes (del 01  al 09).Estan con ceros porque en la BD utiliza ese formato.
		if($j[1]==$aux && ltrim($j[2],0)==$diasMes){
			
			return true;
		
		}//if
 
	}//foreach
}		
}//Se cierra funcion 
  
		$conex=conectarServidor();
		$bd=elegirBD($conex);
		$consulta="SELECT cli.nombre, cli.apellidos, tar.nombre as nombre_tarifa, ci.dni_masajista as masajista, ci.hora, ci.dia
					FROM citas ci, tarifa tar, cliente cli 
					WHERE ci.cod_tarifa=tar.cod_tarifa and ci.cod_cliente=cli.cod_cliente and (ci.dia>=current_date);";	//Solo sacaremos las citas que tengan una fecha mayor que la de hoy
			
		$res=mysqli_query($conex,$consulta);
		mysqli_close($conex);
		$num_filas=mysqli_num_rows($res);
		$arrcita="";
		
		for($i=0;$i<$num_filas;$i++){
			$datos=mysqli_fetch_array($res);
 			$cita=$datos['dia'];
			$arrcita[$i]=explode('-',$cita);//Creamos un array Bidimensional. Cada vualta que de el bucle, será una cita 
			// y esa cita contendra un dia y un mes .
			
			//Sacamos el resto de datos
			$arrCliente[$i]=$datos['nombre']." ".$datos['apellidos'];
			$arrNombreTarifa[$i]=$datos['nombre_tarifa'];
			$arrMasajista[$i]=$datos['masajista'];
			$arrHora[$i]=$datos['hora'];
		}


/*Con setlocale pondremos la fecha en español .Ya que las fechas estan en ingles .
* Esto lo haremos para strftime() que muestre la fecha en español
*/
setlocale( LC_TIME, 'spanish' );

/*$_GET[ 'month' ] devuelve el año y el mes que se ha seleccionado con este formato: yyyy-mm
* Si no se ha seleccionado mes, ponemos el mes actual y el año*/
$mes = !empty( $_GET[ 'mes' ] ) ? $_GET[ 'mes' ] : date( 'Y-n' );


$semana=1;
/*La función strtotime devuelve un timestamp, y toma como parámetro una fecha en un determinado formato.
Los formatos compatibles son :
	mm/dd/yyyy
	mm/dd/yy
	yyyy/mm/dd
	dd-mm-yyyy
	yy-mm-dd
	yyyy-mm-dd
*/

/*date( 't', strtotime( $mes ) ) Esto nos va a dar los numeros de dias del mes que le hemos pasado */

		for ( $i=1;$i<=date( 't', strtotime( $mes ) );$i++ ) {
			
			//Esto va dando los dias de la semana desde 1 a 7
			$dia_semana = date( 'N', strtotime( $mes.'-'.$i )  );
			
			//formamos un array que  por cada semana del mes($semana) almacenamos y dia del 1 al 7($dia_semana) almacenamos el dia correspondiente del mes ($i) 
			$calendario[ $semana ][ $dia_semana ] = $i;

			//cuando los dias de la semana lleguen a 7 sumaremos una semana mas al mes correspondiente
			if ( $dia_semana == 7 ){
					$semana++;
			}
		}
?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<noscript><meta http-equiv="Refresh" content="0;url=../aviso.html"></noscript>
	<title>Consulta de citas</title>
		
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	
	<!--Para darle estilo a la tabla-->
    <link href="../bootstrap/css/consulta_fechas.css" rel="stylesheet" type="text/css" />
	
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<link href="../dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
</head>


<body class="skin-blue">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="" class="logo"><b>Spa</b></a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo $_SESSION['masajista'];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <p>	Trabajador : 
						<small><?php echo $_SESSION['nombre']." ".$_SESSION['apellidos']; ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="php/desconectar.php" class="btn btn-default btn-flat">Desconectar</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- /.search form -->
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
           <!-- Optionally, you can add icons to the links -->
            <li class="treeview">
              <a href="#"><span>Gestión spa</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="editartarifa.php">Editar tarifas</a></li>
				<li><a href="reservas.php">Realizar reservas</a></li>
				<li><a href="#">Calendario</a></li>
				<li><a href="vertarifas.php">Consultar tarifas</a></li>
              </ul>
            </li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
		<div class="row">
        <div class="col-md-6">
		        <table border=1>
               
                        <thead>
                
                                <tr>
                                
                                        <td colspan="7"><?php echo strftime('%B %Y',strtotime( $mes )); ?></td>
                                
                                </tr>
                        
                                <tr>
                                
                                        <th>Lunes</th>
                                        <th>Martes</th>                        
                                        <th>Miércoles</th>                        
                                        <th>Jueves</th>                        
                                        <th>Viernes</th>                        
                                        <th>Sábado</th>                        
                                        <th>Domingo</th>                        
                                
                                </tr>
                                
                        </thead>
                        
                        <tbody>
                
                                <?php foreach ( $calendario as $dias ) : ?>
                                
                                        <tr>
                                        
                                                <?php 
												
														for( $i=1;$i<=7;$i++ ){   
												
															 if(isset($dias[ $i ]) && comprobarFecha($mes,$arrcita,$dias[ $i ])){
																		
																		echo "<td id='cita'>".$dias[ $i ]."</td>";
																	
															    }elseif(isset($dias[ $i ])){
																		
																		echo "<td class='normal'>".$dias[ $i ]."</td>";
																	
																	}else{
																	
																		echo "<td class='vacio'>&nbsp</td>";
																	
																	}
														}												
												?>
												
                                        </tr>
                                
                                <?php endforeach; ?>
                                
                        </tbody>
                        
                        <tfoot>
                        
                                <tr>
                                
                                        <td colspan="7">
                                               <form method="get">
														<select name="mes">
															<option value=''>--Escoge el mes--</option>
															<?php 
															for($i=1;$i<13;$i++){
																if($i<10){
																	$i_mod='0'.$i;
																	$i_mod=date('Y')."-".$i_mod;
																}else{
																	$i_mod=$i;
																	$i_mod=date('Y')."-".$i_mod;
																}	
																echo "<option value='$i_mod'>$i</option>";
															}//for
															?>
														</select>
														<button class="btn btn-primary" type="submit">Elegir</button>
														
                                                </form>
                                            
                                        </td>
                                </tr>
                        </tfoot>
				</table>	
			
	<?php
	//echo "<p>".strftime('%B %Y',strtotime( $mes ))."</p>
	echo "<ul>";
	$comprobar=true;
	$dia = 0;
	if(is_array($arrcita)){
		for($i=0;$i<count($arrcita);$i++){
			if((date('Y')."-".$arrcita[$i][1])==$mes && $dia!=$arrcita[$i][2])
			{
				$dia=$arrcita[$i][2];
				echo "<br>Dia <b>$dia</b>";
			}
			
			if((date('Y')."-".$arrcita[$i][1])==$mes){ 
				echo "<li><strong>Cliente:</strong> ".utf8_encode($arrCliente[$i])." <strong>- Nombre tarifa:</strong> ".utf8_encode($arrNombreTarifa[$i])." <strong>- Masajista:</strong> ".utf8_encode($arrMasajista[$i])." <strong>- Hora:</strong> ".$arrHora[$i]."</li>";
				$comprobar=false;
			}elseif($comprobar && $i<0 ){
				echo "<li>No hay ningun evento</li>";
			}
			
		}
	}
	echo "</ul>";
?>
</div>
</section><!-- /.content -->
</div>
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer text-center">
        <!-- To the right -->
        	<strong>Hotel el Partal&trade; <a href="#"></a></strong>
        
        <!-- Default to the left --> 
        
      </footer>

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    
    <!-- jQuery 2.1.3 -->
    <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>
    
    <!-- Optionally, you can add Slimscroll and FastClick plugins. 
          Both of these plugins are recommended to enhance the 
          user experience -->
</body>
</html>
<?php }//else ?>