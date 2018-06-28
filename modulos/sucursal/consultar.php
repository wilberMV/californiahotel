<?php 
    session_start();
    include_once "../php_conexion.php";
    include_once "../funciones.php";
    include_once "class/class.php";
    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Usuarios','1')==true){
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

        <title>Administración de Sucursales</title>
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
                                            <h4 class="modal-title" align="center">Nueva Sucursal</h4>
                                        </div>
                                        <div class="modal-body">
                                        
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-1" class="control-label">Codigo/Documento</label>
                                                        <input type="text" name="cod"  required  class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Nombre</label>
                                                        <input type="text" name="nom"  required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-1" class="control-label">Distrito</label>
                                                        <input type="text" name="distrito"  required  class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Ciudad</label>
                                                        <input type="text" name="ciudad"  required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Dirección</label>
                                                        <input type="text" name="dir"  required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">Telefono</label>
                                                        <input type="text" name="tel"  required class="form-control" data-mask="9999-9999" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">Descripcion Impuesto</label>
                                                        <input type="text" name="nom_imp"  required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">Valor del Impuesto</label>
                                                        <input type="number" name="val_imp" step="any" min="0" required class="form-control" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">Tamaño del Ticket</label>
                                                        <input type="number" name="tama" step="any" min="0" required class="form-control"  autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">Tamaño de la Letra</label>
                                                        <input type="number" name="letra" step="any" min="0" required class="form-control"  autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Giro</label>
                                                        <input type="text" name="giro"  required class="form-control" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">NIT</label>
                                                        <input type="text" name="nitt" required class="form-control" data-mask="9999-999999-999-9" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">NRC</label>
                                                        <input type="text" name="nrc" required class="form-control" data-mask="999999-9" autocomplete="off">
                                                    </div>
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
                                   if(!empty($_POST['nom'])){ 
                                        $codigo=limpiar($_POST['cod']);       
                                        $nombre=limpiar($_POST['nom']);      
                                        $direccion=limpiar($_POST['dir']);
                                        $telefono=limpiar($_POST['tel']);
                                        $ciudad=limpiar($_POST['ciudad']);
                                        $distrito=limpiar($_POST['distrito']);                                                                                           
                                        $nom_imp=limpiar($_POST['nom_imp']);        
                                        $val_imp=limpiar($_POST['val_imp']);                
                                        $tama=limpiar($_POST['tama']);      
                                        $letra=limpiar($_POST['letra']);
                                        $giro=limpiar($_POST['giro']);
                                        $nrc=limpiar($_POST['nrc']);
                                        $nitt=limpiar($_POST['nitt']);
                                                                                                                                                                                                                                                                                                                                                                                                 
                                                                    
                                        if(empty($_POST['id'])){
                                            $oSucursal=new Proceso_Suscursal('',$codigo,$nombre,$direccion,$telefono,$ciudad,$distrito,$nom_imp,$val_imp,$tama,$letra,$giro,$nrc,$nitt);
                                            $ssx=mysql_query("SELECT nit, nom FROM sucursal WHERE nom='$nombre' or nit='$codigo'");
                                                if($rr=mysql_fetch_array($ssx)){
                                                    echo 
                                                    '<div class="alert alert-danger alert-dismissable" align="center">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        No se Permiten Datos Duplicados, el Actual Registro le Pertenece a <strong>'.$rr['nom'].' </strong> Identificado con el Documento/Codigo 
                                                           <strong> '.$rr['nit'].' </strong>
                                                    </div>';
                                                }
                                                else{
                                                    $oSucursal->crear();
                                                     $ss=mysql_query("SELECT MAX(id)as id_maximo FROM sucursal");
                                                    if($rr=mysql_fetch_array($ss)){
                                                        $id=$rr['id_maximo'];
                                                    }

                                            echo mensajes('Sucursal "'.$nombre.'" Creado con Exito, con codigo '.cb($id),'verde'); 
                                                }
                                           
                                           
                                        }else{
                                            $id=limpiar($_POST['id']);
                                            $oSucursal=new Proceso_Suscursal($id,$codigo,$nombre,$direccion,$telefono,$ciudad,$distrito,$nom_imp,$val_imp,$tama,$letra,$giro,$nrc,$nitt);
                                            $oSucursal->actualizar();
                                            echo mensajes('Sucursal "'.$nombre.'" Actualizado con Exito, con la ID de '.cb($id),'verde');
                                        }
                                    }            
                            ?>                                      
            <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title" align="center"><b>Consultar Sucursal</b></h4>
                             <div align="center"><button class="btn btn-icon waves-effect waves-light btn-success m-b-5" data-toggle="modal" data-target="#nuevo"> <i class="fa fa-plus"></i> Nueva</button></div>                       
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>                                       
                                        <th>Codigo</th>
                                        <th>Nombre</th>                                       
                                        <th>Telefono</th>                                                                                                                                                                                                                                                                      
                                        <th>Distrito</th>                                                                                                                 
                                        <th>Ciudad</th>                                                                                                                 
                                        <th>Direccón</th>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                        $ss=mysql_query("SELECT * FROM sucursal ORDER BY nom");
                                        while($rr=mysql_fetch_array($ss)){
                                    ?>
                                    <tr>                                       
                                        <td><?php echo $rr['nit']; ?></td>
                                        <td><?php echo $rr['nom']; ?></td>
                                        <td><?php echo $rr['tel']; ?></td>                                                                             
                                        <td><?php echo $rr['dpto']; ?></td>
                                        <td><?php echo $rr['ciudad']; ?></td>
                                        <td><?php echo $rr['dir']; ?></td>                                                                          
                                        <td align="center">                                                                                 
                                                <div  class="btn-group btn-group m-b-10">
                                                    <a href="#editar<?php echo $rr['id']; ?>" class="btn btn-primary btn-sm waves-effect waves-light" role="button" data-toggle="modal"> <i class="fa  fa-pencil-square-o"></i> Editar</a>
                                                </div>                                           
                                        </td>
                                    </tr>
                                    <div id="editar<?php echo $rr['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <form action="" name="form1" method="post">
                                    <input type="hidden" name="id" value="<?php echo $rr['id']; ?>">
                                    <input type="hidden" name="existe" value="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" align="center">Editar Sucursal</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                   <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-1" class="control-label">Codigo/Documento</label>
                                                        <input type="text" name="cod"  required  class="form-control" value="<?php echo $rr['nit']; ?>" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Nombre</label>
                                                        <input type="text" name="nom"  required class="form-control" value="<?php echo $rr['nom']; ?>" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-1" class="control-label">Distrito</label>
                                                        <input type="text" name="distrito"  required  class="form-control" value="<?php echo $rr['dpto']; ?>" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Ciudad</label>
                                                        <input type="text" name="ciudad"  required class="form-control" value="<?php echo $rr['ciudad']; ?>" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Dirección</label>
                                                        <input type="text" name="dir"  required class="form-control" value="<?php echo $rr['dir']; ?>" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">Telefono</label>
                                                        <input type="text" name="tel"  required class="form-control" data-mask="9999-9999" value="<?php echo $rr['tel']; ?>" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">Descripcion Impuesto</label>
                                                        <input type="text" name="nom_imp"  required class="form-control" value="<?php echo $rr['nom_imp']; ?>" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">Valor del Impuesto</label>
                                                        <input type="number" name="val_imp" step="any" min="0" required class="form-control" value="<?php echo $rr['val_imp']; ?>" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">Tamaño del Ticket</label>
                                                        <input type="number" name="tama" step="any" min="0" required class="form-control" value="<?php echo $rr['tama']; ?>" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">Tamaño de la Letra</label>
                                                        <input type="number" name="letra" step="any" min="0" required class="form-control" value="<?php echo $rr['letra']; ?>" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Giro</label>
                                                        <input type="text" name="giro"  required class="form-control" value="<?php echo $rr['giro']; ?>" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">NIT</label>
                                                        <input type="text" name="nitt" required class="form-control" data-mask="9999-999999-999-9" value="<?php echo $rr['nitt']; ?>" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">NRC</label>
                                                        <input type="text" name="nrc" required class="form-control" data-mask="999999-9" value="<?php echo $rr['nrc']; ?>" autocomplete="off">
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