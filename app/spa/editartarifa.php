<?php session_start();
 if (empty($_SESSION['masajista'])){
	header ("Location: ../../login.html");
}else{
?> 
<!doctype html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Modificación de tarifas</title>
<noscript><meta http-equiv="Refresh" content="0;url=../aviso.html"></noscript>
<script src='js/editar_tarifa.js'></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />

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
        <div class="col-md-3">
		<h2>Modificación de las tarifas</h2>
		<form action='#' name='modificacion_tarifa' method='POST'>
        <div class="form-group">
			<label>Selecciona la tarifa a editar</label>
			<select  class="form-control" id='tarifa' required>
				<option value='' selected>Escoge una tarifa</option>
			</select>
		</div>
		
		<div class="form-group">
			<label>Nuevo nombre :</label>
			<input class="form-control" id='nombre' type="text" placeholder="nombre tarifa">
        </div>
		
		<div class="form-group">
			<label>Nuevo precio :</label>
			<input class="form-control" id='precio' type='text' placeholder='precio'>
		</div>
		
		<div class="form-group">
			<label>Nueva Descripción</label>
			<textarea class="form-control" id='descripcion' type='text' placeholder='descripcion'></textarea>
		</div>
		
		<div class="form-group">
			<label>Nueva tarifa</label>
			<input id='nuevo' type="checkbox">
        </div>
        <!--<span>¿Borrar la tarifa elegida?</span>
            <input id='borrar' type="checkbox" value='true'> -->
        
        <button  class="btn btn-primary" id='enviar' type='button'>Aceptar</button>
    </form>
	
</div>
</section><!-- /.content -->
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
	
<?php }//Se cierra else?>
