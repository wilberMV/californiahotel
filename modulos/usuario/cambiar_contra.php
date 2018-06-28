<?php 
    session_start();
    include_once "../php_conexion.php";
    include_once "../funciones.php";
    include_once "../class_buscar.php";
    include_once "class/class.php";
    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Usuarios','2')==true){
        }else{
            header('Location: ../error500.php');
        }
    }else{
        header('Location: ../error500.php');
    }
    $usuario=$_SESSION['cod_user'];
    $id_sucursal=consultar('sucursal','username',"usu='$usuario'");
    $fecha=date('Y-m-d');
    $hora=date('H:i:s'); 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="../../assets/images/favicon_1.ico">

        <title>Cambios de Contraseñas</title>
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
                            <li>
                                <form role="search" class="navbar-left app-search pull-left hidden-xs">
                                     <h3 class="panel-title text-white">Usuario: <?php echo nombre($usuario); ?></h3>
                                </form>
                            </li>                           
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><?php include_once "../img.php"; ?> </a>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)"><i class="ti-user m-r-5"></i> Perfil</a></li>            
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
                        <?php 
                            if(!empty($_POST['usu']) and !empty($_POST['nueva'])){
                                $usu=limpiar($_POST['usu']);
                                $nnueva=limpiar($_POST['nueva']);
                                $con=claves($nnueva);
                                
                                mysql_query("UPDATE username SET con='$con' WHERE usu='$usu'");
                                echo mensajes("Se ha Actualizado con Exito la Contraseña del Usuario ".nombre($usu)." 
                                Con Exito<br>Le ha Asignado la contraseña ".$nnueva,"verde");
                                
                            }
                        ?>           
            <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title" align="center"><b>Administración de Contraseñas</b></h4>
                             <!--<div align="center"><button class="btn btn-icon waves-effect waves-light btn-success m-b-5"  data-toggle="modal" data-target="#nuevo"> <i class="fa fa-plus" ></i> Nueva</button></div>-->                       
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <td><strong>Codigo</strong></td>
                                        <td><strong>Nombre del Usuario</strong></td>
                                        <td><strong>Cargo</strong></td>
                                        <td></td>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                        $ss=mysql_query("SELECT * FROM username WHERE tipo<>'c'");          
                                        while($rr=mysql_fetch_array($ss)){
                                            if($rr['tipo']=='a'){
                                                $cargo='Administrador';
                                            }else{
                                                $cargo=consultar('nombre','cargo'," id='".$rr['cargo']."'");
                                            }
                                    ?>
                                    <tr>
                                        <td><?php echo $rr['usu']; ?></td>
                                        <td><?php echo nombre($rr['usu']); ?></td>
                                        <td><?php echo $cargo; ?></td>
                                        <td>
                                        <?php if($_SESSION['cod_user']=='123456789' or $rr['usu']<>'123456789'){ ?>   
                                            <center>
                                                <a href="#m<?php echo $rr[0]; ?>" role="button" class="btn btn-danger waves-effect waves-light" data-toggle="modal">
                                                <i class="fa  fa-pencil-square-o"></i> <strong>Editar Contraseña</strong></a>
                                            </center>
                                            
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <div id="m<?php echo $rr['0']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <form action="" name="form1" method="post">
                                                <input type="hidden" name="usu" value="<?php echo $rr['usu']; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content p-0 b-0">
                                                        <div class="panel panel-color panel-primary">
                                                            <div class="panel-heading" align="center">
                                                                <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h3 class="panel-title">Editar Contraseña</h3>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="row" align="center">
                                                                <strong>Codigo del Usuario: </strong><?php echo $rr['usu']; ?><br>
                                                                <strong>Nombre del Usuario: </strong><?php echo nombre($rr['usu']); ?><br>
                                                                <strong>Cargo que Desempeña: </strong><?php echo $cargo; ?><br><br>
                                                               </div>
                                                                <div class="row">
                                                                <div class="col-md-3">
                                                                    
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="field-1" class="control-label">Nueva Contraseña</label>
                                                                        <input type="text" name="nueva" class="form-control" id="field-1">
                                                                    </div>
                                                                </div>
                                                               </div>
                                                               <div class="modal-footer">
                                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-info waves-effect waves-light">Cambiar</button>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
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

         <script src="../../assets/plugins/moment/moment.js"></script>
        <script src="../../assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <script src="../../assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
        <script src="../../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>



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
                // Date Picker
                jQuery('#datepicker').datepicker();
                jQuery('#datepicker-autoclose').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });
                jQuery('#datepicker-autoclosex').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });
                jQuery('#datepicker-inline').datepicker();
                jQuery('#datepicker-multiple-date').datepicker({
                    format: "mm/dd/yyyy",
                    clearBtn: true,
                    multidate: true,
                    multidateSeparator: ","
                });
                jQuery('#date-range').datepicker({
                    toggleActive: true
                });               

            </script>


    </body>
</html>