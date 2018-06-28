<?php 
    session_start();
    include_once "../php_conexion.php";
    include_once "../funciones.php";
    include_once "class/class.php";
    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Informe','1')==true){
        }else{
            header('Location: ../error500.php');
        }
    }else{
        header('Location: ../error500.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="../../assets/images/favicon_1.ico">

        <title>Facturas</title>
         <!-- DataTables -->
        <link href="../../assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- Validaciones-->
        <link href="../../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="../../assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="../../assets/plugins/select2/select2.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
        <link href="../../assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="../../assets/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="../../assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <link href="../../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- Generales-->
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
                                     <!-- <li><a href="javascript:void(0)"><i class="ti-user m-r-5"></i> Perfil</a></li> -->           
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
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title" align="center"><b>Consultar Facturas Registradas</b></h4>                         
                             <?php 
                                    if(!empty($_POST['i'])){
                                        echo mensajes("En Desarrollo","azul");
                                    }
                                ?>
                             <?php 
                                if(!empty($_GET['fechaf']) and !empty($_GET['fechai']) and !empty($_GET['s'])){
                                    $fechai=limpiar($_GET['fechai']);
                                    $fechaf=limpiar($_GET['fechaf']);
                                    $id_sucursal=limpiar($_GET['s']);
                                }else{
                                    $fechai=date('Y-m-d');
                                    $fechaf=date('Y-m-d');
                                    $id_sucursal='';
                                }
                            ?>
                            <form name="gor" action="" method="get" class="form-inline">
                            <div class="row-fluid">
                                <div class="col-md-4" align="center">
                                    <strong>Fecha Inicial</strong><br>
                                    <input type="date" class="form-control" name="fechai" autocomplete="off" required value="<?php echo $fechai; ?>">
                                </div>
                                <div class="col-md-4" align="center">
                                    <strong>Fecha Finalizar</strong><br>
                                    <input type="date" class="form-control" name="fechaf" autocomplete="off" required value="<?php echo $fechaf; ?>">
                                </div>
                                <div class="col-md-4" align="center">
                                    <strong>Seleccionar Sucursal</strong><br>
                                    <select name="s" class="form-control select2">
                                        <?php 
                                            $ss=mysql_query("SELECT id,nom FROM sucursal ORDER BY nom");
                                            while($rr=mysql_fetch_array($ss)){
                                                if($id_sucursal==$rr['id']){
                                                    echo '<option value="'.$rr['id'].'" selected>'.$rr['nom'].'</option>';
                                                }else{
                                                    echo '<option value="'.$rr['id'].'">'.$rr['nom'].'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                    <button type="submit" class="btn btn-icon waves-effect waves-light btn-primary m-b-5"><strong>Consultar</strong></button>
                                </div>
                            </div><br>  
                            </form>                      
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>                                       
                                        <th>Factura</th>
                                        <th>Cliente</th>                                       
                                        <th>Fecha y Hora</th>                                       
                                        <th>Sucursal</th>                                       
                                        <th>Vendedor</th>                                                                                                                 
                                       <th>Tipo de Pago</th>                                                                                                     
                                        <th>Valor</th>
                                        <th>  </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                        $ss=mysql_query("SELECT * FROM factura INNER JOIN factura_pago ON factura_pago.factura=factura.id WHERE factura.sucursal='$id_sucursal' and factura.fecha between '$fechai' AND '$fechaf'");
                                        while($rr=mysql_fetch_array($ss)){
										//$oMetodopago=new Consultar_Metodopago($rr['metodopago']);
										//$metodopago=$rr['metodopago'];

                                    ?>
                                    <tr>                                       
                                        <td><?php echo formato_factura($rr[0]); ?></td>
                                        <td><?php echo consultar('nom','cliente',"id='".$rr['cod_cliente']."'"); ?></td>
                                        <td align="center"><?php echo fechal($rr['fecha']).' '.$rr['hora']; ?></td>
                                        <td align="center"><?php echo consultar('nom','sucursal',"id='".$rr['sucursal']."'"); ?></td>                                                              
                                        <td align="center"><strong><?php echo nombre($rr['usuario']); ?></strong></td>                                    
                                        <td align="center"><strong>  <?php echo consultar('nombre','metodopago',"id='".$rr['metodopago']."'"); ?></strong></td>                                    
                                        <td align="center"><strong><?php echo $s.formato($rr['valor']); ?></strong></td>                                    
                                        <td align="center">
                                                <div  class="btn-group btn-group m-b-10">
                                                    <a href="ticket.php?i=<?php echo claves($rr[0]); ?>" class="btn btn-primary btn-sm waves-effect waves-light" target="_blank" role="button" data-toggle="tooltip" data-placement="top" data-original-title="Detalle Tickete"> <i class="fa fa-print"></i></a>
                                                </div>												
												<div  class="btn-group btn-group m-b-10">
                                                    <a href="factura.php?i=<?php echo claves($rr[0]); ?>" class="btn btn-danger btn-sm waves-effect waves-light" target="_blank" role="button" data-toggle="tooltip" data-placement="top" data-original-title="Detalle Factura"> <i class="fa fa-print"></i></a>
                                                </div>
												
                                                  <?php if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Sistema','3')==true){ ?>            
                                                <div  class="btn-group btn-group m-b-10">
                                                    <a href="#a<?php echo $rr[0]; ?>" class="btn btn-danger btn-sm waves-effect waves-light" role="button" data-toggle="modal"> <i class="fa fa-trash-o"></i> Anular</a>
                                                </div>											
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <div id="a<?php echo $rr[0]; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <form action="" name="form1" method="post">
                                    <input type="hidden" name="i" value="<?php echo claves($rr[0]); ?>">
                                    <input type="hidden" name="id" value="<?php echo $rr['id']; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" align="center">Anular Factura</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                   <div class="row" align="center">                                                                       
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">                       
                                                                                <textarea name="nota" class="form-control" style="width:90%; height:80px"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                                                                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-info waves-effect waves-light"> Anular</button>
                                                            </div>                                  
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div><!-- /.modal -->                       
                                     <?php } ?>                                                               
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


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

        <!-- Datatables-->
        <script src="../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../../assets/plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="../../assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="../../assets/plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="../../assets/plugins/datatables/jszip.min.js"></script>
        <script src="../../assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="../../assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="../../assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="../../assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="../../assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="../../assets/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="../../assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../../assets/plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="../../assets/plugins/datatables/dataTables.scroller.min.js"></script>

        <!-- Validaciones-->
        <script src="../../assets/plugins/switchery/switchery.min.js"></script>
        <script src="../../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script type="../../text/javascript" src="assets/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="../../text/javascript" src="assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="../../assets/plugins/select2/select2.min.js" type="text/javascript"></script>
        <script src="../../assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="../../assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>


        <!-- Datatable init js -->
        <script src="../../assets/pages/datatables.init.js"></script>

        <!-- Custom main Js -->
        <script src="../../assets/js/jquery.core.js"></script>
        <script src="../../assets/js/jquery.app.js"></script>     

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "../../assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
            } );
            TableManageButtons.init();

        </script>
         <script>
            jQuery(document).ready(function() {

                // Select2
                $(".select2").select2();

                $(".select2-limiting").select2({
                  maximumSelectionLength: 2
                });

                });               

            </script>


    </body>
</html>