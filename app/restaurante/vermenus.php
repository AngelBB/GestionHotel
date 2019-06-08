<?php session_start();
if (empty($_SESSION['restaurante'])){
	header ("Location: ../../login.html");
}else{


include '../herramientas/conexion.php';//Para abrir conexion con la BD

/* TABLA Tarifas */
//Datos de conexion
	$conex=conectarServidor();
	$bd=elegirBD($conex);

	$consulta="SELECT * FROM comida";
		
	$res=mysqli_query($conex,$consulta);
	$cols=mysqli_num_rows($res);
	$resultado="";
	$resultado.="<thead><tr><th>Codigo</th><th>Nombre</th><th>Precio</th></tr></thead><tbody>";	
	
	for($i=0;$i<$cols;$i++){
		$datos=mysqli_fetch_array($res);
		$resultado.="<tr>
						<td>".$datos['codigo']."</td>
						<td>".utf8_encode($datos['nombre'])."</td>
						<td>".$datos['precio']."</td>
					</tr>";
	}
$resultado.="</tbody><tfoot></tfoot></table>";
		
	mysqli_free_result($res);
	mysqli_close($conex);

?> 
<!doctype html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Consultar Menus</title>
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
	
	<!-- DATA TABLES -->
    <link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
</head>


<body class="skin-blue">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="" class="logo"><b>Restaurante</b></a>

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
                  <span class="hidden-xs"><?php echo $_SESSION['restaurante'];?></span>
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
              <a href="#"><span>Gestión restaurante</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
               <li><a href="consumo.php">Recargar consumo</a></li>
				<li><a href="editar_platos.php">Editar platos</a></li>
				<li><a href="#">Consultar menús</a></li>
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
					<div class="col-md-12">
					  <div class="box">
						<div class="box-header">
						  <h3 class="box-title">Lista menus</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
						  <table id="habitaciones" class="table table-bordered table-hover">
							<?php echo  $resultado; ?>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
		</section><!-- /.content -->
   	</div><!-- ./wrapper -->
	
      <!-- Main Footer -->
      <footer class="main-footer text-center">
        <!-- To the right -->
        	<strong>Hotel el Partal&trade; <a href="#"></a></strong>
        <!-- Default to the left --> 
     </footer>

   
	</div>
     <!-- jQuery 2.1.3 -->
    <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="../plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $('#habitaciones').dataTable({
          "bPaginate": false,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
		  "bInfo": false,
          "bAutoWidth": true
        });
      });
    </script>
  </body>
</html>
<?php }//else de sesion ?>
