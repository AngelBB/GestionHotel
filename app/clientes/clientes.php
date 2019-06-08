<?php session_start();
 if (empty($_SESSION['administracion'])){
	header ("Location: ../../login.html");
}else{
?> 
<!doctype html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<noscript><meta http-equiv="Refresh" content="0;url=../aviso.html"></noscript>
	<title>Registro de cliente</title>
	
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	
	<!--JQuery ui -->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
	
	<!-- Bootstrap 3.3.2 -->
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	
	<!-- Font Awesome Icons -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	
	<!-- Ionicons -->
	<link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	
	<!-- Theme style -->
	<link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<link href="../dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
	
	<!--Para el datepicker-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
	

</head>  

<body class="skin-blue">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="" class="logo"><b>Habitaciones</b></a>

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
                  <span class="hidden-xs"><?php echo $_SESSION['administracion'];?></span>
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
              <a href="#"><span>Gestión habitaciones</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="clientes.php">Resgistrar cliente</a></li>
				<li><a href="busqueda.php">Búsqueda de cliente</a></li>
				<li><a href="disponibilidad_habitaciones.php">Comprobrar disponobilidad</a></li>
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
					<div class="col-md-3">
						<form action="#" method="POST" name="nuevo_cliente">
							   
							<h2>Nuevo cliente</h2>		
							<div class="form-group">
								<label>DNI/NIE :</label>
								<input class="form-control" type="text" id='dni' name="dni">
							</div>
							<div class="form-group">						
								<label>Nombre :</label>
								<input class="form-control" type="text" id='nombre' name="nombre">
							</div>
							<div class="form-group">	
								<label>Apellidos :</label>
								<input class="form-control" type="text" id='apellidos' name="apellidos">
							</div>	
							<div class="form-group">	
								<label>Teléfono :</label>
								<input class="form-control" type='text' id='telefono' name='telefono'>
							</div>        
						
							<h2>Asignación de habitación</h2>
							<div class="form-group">
							<label>Escoge tipo de habitación :</label>
							<select class="form-control" name='habitaciones' id='habitaciones' required>
								<option value='' selected>Seleccciona una Habitación</option>
								<option value='doble'>Habitación doble</option>
								<option value='individual'>Habitación individual</option>
								<option value='deluxe_suite'>Suite Deluxe</option>
								<option value='royal_suite'>Suite Royal</option>
							</select>  
							</div> 
							
							<div class="form-group">
								<!--Se rellenará mediate ajax -->
								<label>Numeros de habitación disponibles :</label>
								<select class="form-control" name='num_habitaciones' id='num_habitaciones' disabled required>
									<option value=''selected>Escoge numero de habitación</option>
								</select>
							</div>  
							
							<div class="form-group">  
							<label>Fecha de salida</label>  
							<input class="form-control" type='text' name='fecha_salida' id='fecha_salida' readonly>
							</div> 
							
							<div class="form-group">  
								<label>Numero personas</label>
								<input class="form-control" type='text' name='numero_personas' id='numero_personas' required>
							</div> 
					
							<button class="btn btn-primary" id='enviar' type='submit' >Registrar</button>
						</form>
						<div id='resultado'>
							<label id='informacion'></label>
						</div>
					</div>
				</div>
			</section><!-- /.content -->
		</div>
	
		<!-- Main Footer -->
		<footer class="main-footer text-center">
			<!-- To the right -->
			<strong>Hotel el Partal&trade; <a href="#"></a></strong>
		</footer>
	</div><!-- /.content-wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 2.1.3 -->
    <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
	<script src="js/clientes.js"></script>
	<script type="text/javascript">
      $(function () {
			//Para iniciar el datepicker	
			$(function($){
				$.datepicker.regional['es'] = {
					closeText: 'Cerrar',
					prevText: '<Ant',
					nextText: 'Sig>',
					currentText: 'Hoy',
					monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
					monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
					dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
					dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
					dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
					weekHeader: 'Sm',
					dateFormat: 'dd/mm/yy',
					firstDay: 1,
					isRTL: false,
					showMonthAfterYear: false,
					yearSuffix: ''
				};
				$.datepicker.setDefaults($.datepicker.regional['es']);
			});
			
			$(function() {
				$("#fecha_salida").datepicker();
			});
		});
	</script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>
    
    <!-- Optionally, you can add Slimscroll and FastClick plugins. 
          Both of these plugins are recommended to enhance the 
          user experience -->
  </body>
</html>
<?php }//Se cierra else?>