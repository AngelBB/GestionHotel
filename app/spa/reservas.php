<?php session_start();
 if (empty($_SESSION['masajista'])){
	header ("Location: ../../login.html");
}else{
?> 
<!doctype html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Reservas</title>
    <noscript><meta http-equiv="Refresh" content="0;url=../aviso.html"></noscript>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
				<li><a href="#">Realizar reservas</a></li>
				<li><a href="calendario.php">Calendario</a></li>
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
        <div class="col-md-3">
			<h2>Crear reserva</h2>
			<form action="#" name='crear_reserva' method='POST'>
				<div class="form-group">
					<label>Codigo cliente :</label> 
					<select class="form-control" id='cod_cliente' required></select>
				</div>
				
				<div class="form-group">
					<label>Servicio elegido :</label>
					<select class="form-control" id='servicios' required></select>
				</div>
				
				<div class="form-group">
					<label>Elegir fecha :</label>
					<div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" id="fecha" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" required data-mask/>
                    </div><!-- /.input group -->
				</div>
				
				<div class="form-group">
					<label>Introducir Hora :</label>
					<div class="input-group">
                        <input id="hora" type="text" class="form-control timepicker" required placeholder="HH:mm"/>
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                    </div><!-- /.input group -->
				</div>
				
				<button id='enviar' type='button' class="btn btn-primary">Aceptar</button>
			</form>
		</div>
		</div>
	</div>
</section><!-- /.content -->
<!-- Main Footer -->
      <footer class="main-footer text-center">
        <!-- To the right -->
        	<strong>Hotel el Partal&trade; <a href="#"></a></strong>
       </footer>
	 </div><!-- /.wrapper -->

	 <!-- REQUIRED JS SCRIPTS -->
    
    <!-- jQuery 2.1.3 -->
    <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
	<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
	<script src='js/reservas.js'></script>
	<!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	
	<!-- InputMask -->
    <script src="../plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="../plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
	<!-- date-range-picker -->
    <script src="../plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap time picker -->
    <script src="../plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
	<!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>
    
    <script type="text/javascript">
      $(function () {
        //Datemask dd/mm/yyyy
        $("#fecha").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
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
		 	$("#fecha").datepicker();
		});
	        
      });
    </script>
  </body>
</html>
<?php }//Se cierra else ?>
