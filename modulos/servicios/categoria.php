<?php 
    session_start();
    include_once "../php_conexion.php";
    include_once "../funciones.php";
    include_once "class/class_cat.php";
    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Servicios','3')==true){
        }else{
            header('Location:../error500.php');
        }
    }else{
        header('Location:../error500.php');
    }
    
    if(!empty($_GET['i'])){
        $i=limpiar($_GET['i']);
        $sql=mysql_query("SELECT id FROM producto WHERE categoria='$i'");
        if($row=mysql_fetch_array($sql)){}else{
            mysql_query("DELETE FROM confi WHERE id='$i'");
        }
        header('Location:categoria.php');
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

        <title>Categorias</title>
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
              <div id="nuevo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <form action="" name="form1" method="post" enctype="multipart/form-data">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" align="center">Nueva Categoria</h4>
                                        </div>
                                        <div class="modal-body">
                                        
                                            <div class="row" align="center">                                               
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Descripción</label>
                                                        <input type="text" name="nombre"  required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>                                               
                                            </div>                                                                                                                                  
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Registrar</button>
                                        </div>                                  
                                    </div>
                                </div>
                                </form>
                            </div><!-- /.modal -->   

        <div class="wrapper">
            <div class="container">
                         <?php
                                   if(!empty($_POST['nombre'])){      
                                        $nombre=limpiar($_POST['nombre']);                                                                                                                                                                                         
                                                                                                                                              
                                        if(empty($_POST['id'])){
                                            $oProducto=new Proceso_Categoria('',$nombre);
                                            $ssx=mysql_query("SELECT id FROM confi WHERE nombre='$nombre' and tabla='categoria'");
                                                if($rr=mysql_fetch_array($ssx)){
                                                    echo 
                                                    '<div class="alert alert-danger alert-dismissable" align="center">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        No se Permiten Datos Duplicados, el Actual Registro le Pertenece a <strong>'.$rr['nombre'].' </strong> Identificada con el Codigo 
                                                           <strong> '.$rr['id'].' </strong>
                                                    </div>';
                                                }
                                                else{
                                                    $oProducto->crear();
                                                     $ss=mysql_query("SELECT MAX(id)as id_maximo FROM producto");
                                                    if($rr=mysql_fetch_array($ss)){
                                                        $id=$rr['id_maximo'];
                                                    }

                                            echo mensajes('Categoria "'.$nombre.'" Creada con Exito, con codigo '.cb($id),'verde'); 
                                                }
                                           
                                           
                                        }else{
                                            $id=limpiar($_POST['id']);
                                            $oProducto=new Proceso_Categoria($id,$nombre);
                                            $oProducto->actualizar();
                                            echo mensajes('Categoria "'.$nombre.'" Actualizada con Exito, con la ID de '.cb($id),'verde');
                                        }
                                    }            
                            ?>                                      
            <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title" align="center"><b>Administración de Categorias</b></h4>
                             <div align="center"><button class="btn btn-icon waves-effect waves-light btn-success m-b-5" data-toggle="modal" data-target="#nuevo"> <i class="fa fa-plus" ></i> Nueva</button></div>                       
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>                                       
                                        <th>ID</th>
                                        <th>Descripción</th>                                                                                                                                                   
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                   <?php 
                                        $ss=mysql_query("SELECT * FROM confi WHERE tabla='categoria'");
                                        while($rr=mysql_fetch_array($ss)){
                                    ?>
                                    <tr>                                       
                                       <td align="center"><?php echo $rr[0]; ?></td>
                                        <td><?php echo $rr[1]; ?></td>
                                        <td>
                                            <!-- Button to trigger modal -->
                                            <center>
                                                <a href="#m<?php echo $rr[0]; ?>" role="button" class="btn btn-primary waves-effect w-md waves-light m-b-5" data-toggle="modal">
                                                <i class="fa fa-pencil-square-o"></i> <strong>Editar</strong></a>
                                                <?php 
                                                    $sql=mysql_query("SELECT id FROM producto WHERE categoria='".$rr['id']."'");
                                                    if($row=mysql_fetch_array($sql)){}else{
                                                        echo '<a href="categoria.php?i='.$rr[0].'" class="btn btn-danger waves-effect w-md waves-light m-b-5">
                                                        <i class="fa fa-trash-o"></i> <strong>Eliminar</strong></a>';
                                                    }
                                                ?>
                                            </center>                                            
                                           <div id="m<?php echo $rr[0]; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                               <form action="" name="form1" method="post">                          
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" align="center">Editar Categoria</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                   <div class="row">
                                                                        <div class="col-md-8">
                                                                            <div class="form-group">
                                                                                <label for="field-1" class="control-label">Descripción</label>
                                                                                <input type="hidden" name="id" value="<?php echo $rr[0]; ?>">
                                                                                <input type="text" name="nombre" value="<?php echo $rr[1]; ?>" class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                                            </div>
                                                                        </div>                                                                       
                                                                    </div>                                                                                                                                                                                                                                                                                          
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-info waves-effect waves-light">Actualizar</button>
                                                            </div>                                  
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div><!-- /.modal -->           
                                        </td>
                                    </tr>
                                                
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