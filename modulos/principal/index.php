<?php 
    session_start();
    include_once "../php_conexion.php";
    include_once "../funciones.php";
    
    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        
    }else{
        header('Location: ../error.php');
    }
    if(consultar('cargo','username'," usu='".$_SESSION['cod_user']."'")=='Administrador'){
        $ncargo='Administrador';
    }else{
        $ncargo=consultar('nombre','cargo',"id='".consultar('cargo','username'," usu='".$_SESSION['cod_user']."'")."'");           
    }
     $usuario=$_SESSION['cod_user'];
     $id_sucursal=consultar('sucursal','username',"usu='$usuario'");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="../../assets/images/favicon_1.ico">

        <title>Bienvenidos</title>

        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="../../assets/js/modernizr.min.js"></script>


    </head>


    <body>


        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- Logo container-->
                    <div class="logo">
                         <a href="#" class="logo"><span> <?php include_once "../cabeza.php"; ?></span> </a>
                    </div>
                    <!-- End Logo container-->

                    <div class="menu-extras">

                        <ul class="nav navbar-nav navbar-right pull-right">                           
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"> <?php include_once "../img.php"; ?> </a>
                                <ul class="dropdown-menu">
                                    <!--<li><a href="javascript:void(0)"><i class="ti-user m-r-5"></i> Perfil</a></li>-->            
                                    <li><a href="../../php_cerrar.php"><i class="ti-power-off m-r-5"></i> Salir</a></li>
                                </ul>
                            </li>
                        </ul>

                        <div class="menu-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </div>
                    </div>

                </div>
            </div>
            <!-- End topbar -->
            <!-- Navbar Start -->
             <?php include_once "../menu.php"; ?>
         
        </header>
        <!-- End Navigation Bar-->


        <!-- =======================
             ===== START PAGE ======
             ======================= -->

        <div class="wrapper" align="center">
            <div class="container">

                 <div class="row">
                    <a tabindex="-1" href="../cliente/consultar.php">
					<div class="col-sm-6 col-lg-3">
                        <div class="card-box widget-icon">
                            <div>
                                <i class="md md-account-child text-primary"></i>
                                <div class="wid-icon-info">
                                <?php
                                    // primero conectamos siempre a la base de datos mysql
                                    $sql = "SELECT * FROM cliente WHERE sucursal='$id_sucursal'";  // sentencia sql
                                    $result = mysql_query($sql);
                                    $numero = mysql_num_rows($result); // obtenemos el número de filas
                                    
                                    ?>
                                   <p class="text-muted m-b-5 font-13 text-uppercase">Clientes Registrados</p>
                                    <h4 class="m-t-0 m-b-5 counter text-purple counter"><?php echo "$numero" ?></h4>
                                </div>
                            </div>
                        </div>
                    </div></a>
					<a tabindex="-1" href="../venta/consultar.php">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card-box widget-icon">
                            <div>
                                <i class="md-attach-money"></i>
                                <div class="wid-icon-success">
                                <?php
                                   $total=0;$bono=0;$tgen=0;
                                   $cred=mysql_query("SELECT SUM(valor) AS net FROM factura_pago WHERE tipo='Contado' AND date_format(fecha,'%Y%m%d')=date_format(curdate(),'%Y%m%d') AND sucursal=$id_sucursal");
                                        if($rr=mysql_fetch_array($cred)){
                                           $total=$rr['net'];
                                        }
                                    $bonos=mysql_query("SELECT SUM(valor) AS t FROM abono WHERE date_format(fecha,'%Y%m%d')=date_format(curdate(),'%Y%m%d')");
                                        if($dato=mysql_fetch_array($bonos)){
                                           $bono=$dato['t'];
                                        }
                                        $tgen=$total+$bono;                        
                                    ?>
                                    <p class="text-muted m-b-5 font-13 text-uppercase">Ingreso del Dia</p>
                                    <h4 class="m-t-0 m-b-5 counter text-success counter"><?php echo $s.' '.formato($tgen); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div></a>                    

                    <a tabindex="-1" href="../servicios/control.php"><div class="col-sm-6 col-lg-3">
                        <div class="card-box widget-icon">
                            <div>
                                <i class="fa fa-arrow-circle-down text-danger counter"></i>
                                <div class="wid-icon-info">                              
									 <?php
                                    // primero conectamos siempre a la base de datos mysql
                                    $sql = "SELECT * FROM producto WHERE  status ='OCUPADA' AND control='s'";  // sentencia sql
                                    $sqlx = "SELECT * FROM producto WHERE status =''";  // sentencia sql
                                    $result = mysql_query($sql);
                                    $resultx = mysql_query($sqlx);
                                    $ocupadas = mysql_num_rows($result); // obtenemos el número de filas
                                    $disponibles = mysql_num_rows($resultx); // obtenemos el número de filas
                                    
                                    ?>
                                    <p class="text-muted m-b-5 font-13 text-uppercase"> Servicios Ocupados</p>
                                    <h4 class="m-t-0 m-b-5 counter text-danger counter"><?php echo "$ocupadas" ?></h4>
                                </div>
                            </div>
                        </div>
                    </div></a>
					 <a tabindex="-1" href="../venta/"><div class="col-sm-6 col-lg-3">
                        <div class="card-box widget-icon">
                            <div>
                                <i class="fa fa-arrow-circle-up text-success counter"></i>
                                <div class="wid-icon-info">
                                    <p class="text-muted m-b-5 font-13 text-uppercase">Servicios Disponibles</p>
                                    <h4 class="m-t-0 m-b-5 counter text-priary counter"><?php echo "$disponibles" ?></h4>
                                </div>
                            </div>
                        </div></a>
                    </div>
                </div>
                <!-- end row -->

                 <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box" align="center">
                        <div class="table-responsive"
                            <table class="table table-bordered">
                            <tr>
                                <td>
                                    <div class="row-fluid">
                                        <div class="col-md-4"><br>
                                            <h3 align="center">Bienvenido al Sistemas<br>
                                            <span class="text-info"><?php echo nombre($_SESSION['cod_user']); ?></span></h3>
                                        </div>
                                        <div class="col-md-4" align="center">                                         
                                            <img src="../../img/softunicorn<?php echo consultar('sucursal','username',"usu='".$_SESSION['cod_user']."'"); ?>.png" width="360" height="300">                              
                                        </div>
                                        <div class="col-md-4"><br>
                                            <h3 align="center">Tipo de Usuario<br>
                                            <span class="text-info"><?php echo $ncargo; ?></span></h3>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        </div>
                        <!--<div class="btn-group btn-group-justified m-b-10">
                                <?php if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Recepción','1')==true){ ?>
                                <a  href="../venta/admin.php?x=sin" class="btn btn-danger waves-effect waves-light" role="button">Recepción Cliente sin Registro</a>
                                <?php }if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Recepción','1')==true){ ?>
                                <a  href="#" class="btn btn-warning waves-effect waves-light" role="button"></a>
                                <?php }if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Recepción','1')==true){ ?>
                                <a href="../venta/" class="btn btn-primary waves-effect waves-light" role="button">Recepción Cliente con Registro</a>
                                 <?php } ?>  
                        </div>-->
                        </div>
                    </div>
                </div>
                 <!-- end row -->



                <!-- Footer -->
                 <?php include_once "../pie.php"; ?>
                <!-- End Footer -->

            </div> <!-- end container -->
        </div>
        <!-- End wrapper -->



        <!-- jQuery  -->
        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/js/bootstrap.min.js"></script>
        <script src="../../assets/js/detect.js"></script>
        <script src="../../assets/js/fastclick.js"></script>
        <script src="../../assets/js/jquery.blockUI.js"></script>
        <script src="../../assets/js/waves.js"></script>
        <script src="../../assets/js/wow.min.js"></script>
        <script src="../../assets/js/jquery.nicescroll.js"></script>
        <script src="../../assets/js/jquery.scrollTo.min.js"></script>

        <!-- Custom main Js -->
        <script src="../../assets/js/jquery.core.js"></script>
        <script src="../../assets/js/jquery.app.js"></script>


    </body>
</html>