<?php 
    session_start();
    include_once "../php_conexion.php";
    include_once "../funciones.php";
    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Usuarios','2')==true){
        }else{
            header('Location: ../error500.php');
        }
    }else{
        header('Location: ../error500.php');
    }
    
    if(!empty($_GET['u'])){
        $url_doc=limpiar($_GET['u']);
        $id_doc=get($url_doc,'username',"usu");

        $pa=mysql_query("SELECT * FROM persona, username WHERE username.usu='$id_doc' and persona.cod='$id_doc'");              
        if($row=mysql_fetch_array($pa)){
            $usuario=$row['nom'];
            $tipo_usu=$row['cargo'];
            
            $direccion=$row['dir'];
            $tel=$row['tel'];
            $cel=$row['cel'];
            
            $id_sucursal=$row['sucursal'];
            $no_sucursal=consultar('nom','sucursal'," id='$id_sucursal'");
        }
        
        $ss=mysql_query("SELECT id FROM seg_nom");
        while($rr=mysql_fetch_array($ss)){
            #permisos($id_doc,$rr[0]);
        }
        
        if(!empty($_GET['i'])){
            $id_pe=get(limpiar($_GET['i']),'seg_per','id');
            
            $pa=mysql_query("SELECT * FROM seg_per WHERE id='$id_pe' and estado='s'");              
            if($row=mysql_fetch_array($pa)){
                mysql_query("UPDATE seg_per SET estado='n' WHERE id='$id_pe'");
            }else{
                mysql_query("UPDATE seg_per SET estado='s' WHERE id='$id_pe'");
            }
            header('Location: permiso.php?u='.claves($id_doc));
        }
    }
    
    $ss=mysql_query("SELECT * FROM seg_nom");
    while($rr=mysql_fetch_array($ss)){
        $modulo=$rr['grupo'];
        $cod=$rr['cod'];
        
        $sql=mysql_query("SELECT * FROM seg_per WHERE modulo='$modulo' and permiso='$cod' and usu='$id_doc'");
        if($row=mysql_fetch_array($sql)){
        }else{
            mysql_query("INSERT INTO seg_per (usu,modulo,permiso,estado) VALUES ('$id_doc','$modulo','$cod','n')");
        }
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>Administrar Permisos</title>

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
                                <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><?php include_once "../img.php"; ?> </a>
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

        <div class="wrapper">
            <div class="container">

             
          <div class="row">
          <div class="col-lg-12">
                        <div class="panel panel-danger panel-border">
                            <div class="panel-heading" align="center">
                                <h1 class="panel-title">Administrar Permisos - <?php echo $usuario; ?></h1>                               
                            </div>
                            <div class="panel-body">                                      
                                            <center>
                                             <a href="consultar.php" class="btn btn-info waves-effect waves-light" title="Regresar a Consultas de Usuarios"><i class="fa fa-users"></i> Usuarios</a>                                                                   
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-warning panel-border">
                            <div class="panel-heading">
                                <h3 class="panel-title">Administar Permiso</h3>
                                
                            </div>
                            <div class="panel-body">
                                  <table class="table table-bordered">
                                    <?php 
                                        $ss=mysql_query("SELECT * FROM seg_nom GROUP BY grupo ORDER BY grupo");
                                        while($rr=mysql_fetch_array($ss)){
                                    ?>
                                    <tr class="well">
                                        <td colspan="2"><strong><?php echo $rr['grupo']; ?></strong></td>
                                    </tr>
                                    <?php 
                                        $n=0;
                                        $sql=mysql_query("SELECT * FROM seg_per WHERE modulo='".$rr['grupo']."' and usu='$id_doc'");
                                        while($row=mysql_fetch_array($sql)){
                                            
                                            $url='?i='.claves($row['id']).'&u='.claves($id_doc);
                                            if($row['estado']=='s'){
                                                $estado='<center><span class="label label-success">PERMITIDO</span></center>';
                                            }elseif($row['estado']=='n'){
                                                $estado='<center><span class="label label-danger">NO PERMITIDO</span></center>';
                                            }   
                                    ?>
                                    <tr>
                                        <td><?php echo consultar('nombre','seg_nom',"grupo='".$row['modulo']."' and cod='".$row['permiso']."'"); ?></td>
                                        <td>
                                            <?php if($rr['estado']=='s'){ ?>
                                            <a href="permiso.php<?php echo $url; ?>" title="Cambiar Estado">
                                                <?php echo $estado; ?>
                                            </a>
                                            <?php }else{ ?>
                                            <center><strong>Consulte con el<br>Administrador</strong></center>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-warning panel-border">
                            <div class="panel-heading">
                                <h3 class="panel-title">Detalle de Usuario</h3>
                                
                            </div>
                            <div class="panel-body" align="center">
                                 <a href="#excel" role="button" class="btn btn-default waves-effect waves-light" data-toggle="modal"><i class="fa fa-user-plus"></i> <strong>Imprimir Reporte</strong></a><br><br>
                                    <i class="icon-ok"></i> <strong>Documento o Codigo: </strong><?php echo $id_doc; ?><br><br>
                                    <i class="icon-ok"></i> <strong>Tipo de Usuario: </strong><?php echo $tipo_usu; ?><br><br>
                                    <i class="icon-ok"></i> <strong>Pertenece al Deposito: </strong><?php echo $no_sucursal; ?><br><br>
                                    <i class="icon-ok"></i> <strong>Direccion del Cajero: </strong><?php echo $direccion; ?><br><br>
                                    <i class="icon-ok"></i> <strong>Telefono: </strong><?php echo $tel; ?><br><br>                                   
                            </div>
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