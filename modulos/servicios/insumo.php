<?php 
    session_start();
    include_once "../php_conexion.php";
    include_once "../funciones.php";
    include_once "class/class.php";
    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Productos','3')==true){
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

        <title>Listado de Productos</title>
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
                                            <h4 class="modal-title" align="center">Registrar Insumos</h4>
                                        </div>
                                        <div class="modal-body">
                                        
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-1" class="control-label">Codigo</label>
                                                        <input type="text" name="codigo"  required  class="form-control" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Descripción</label>
                                                        <input type="text" name="nombre"  required class="form-control" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Medida</label>
                                                        <select class="form-control select2" name="medida" required>
                                                                    <option>Seleccionar</option>                                       
                                                                <?php 
                                                                    $sql=mysql_query("SELECT * FROM confi WHERE tabla='medida' ORDER BY nombre");
                                                                    while($row=mysql_fetch_array($sql)){
                                                                        echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
                                                                    }
                                                                ?>                                                    
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-6" class="control-label">Proveedor</label>
                                                        <select class="form-control select2" name="proveedor" required>
                                                                <option>Seleccionar</option>
                                                               <?php 
                                                                    $sql=mysql_query("SELECT * FROM proveedor ORDER BY nombre");
                                                                    while($row=mysql_fetch_array($sql)){
                                                                        echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';  
                                                                    }
                                                                ?>                                         
                                                            </select>
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Contenido</label>
                                                        <input type="text" name="contenido"  required class="form-control" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Costo</label>
                                                        <input type="number" name="costo"  required class="form-control" autocomplete="off" required min="0" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="row">
                                                 
                                                
                                                
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
                $codigo=limpiar($_POST['codigo']);
                $contenido=limpiar($_POST['contenido']);
                $costo=limpiar($_POST['costo']);
                $medida=limpiar($_POST['medida']);
                $proveedor=limpiar($_POST['proveedor']);
                
                if(!empty($_POST['id'])){
                    mysql_query("UPDATE insumo SET nombre='$nombre', contenido='$contenido', medida='$medida', costo='$costo', proveedor='$proveedor' 
                    WHERE codigo='$codigo'");
                    
                    $ss=mysql_query("SELECT id FROM sucursal");
                    while($rr=mysql_fetch_array($ss)){
                        $id_sucursal=$rr[0];
                        if(consultar('cant','insumo_contenido',"sucursal='$id_sucursal' and producto='$codigo'")==NULL){
                            mysql_query("INSERT INTO insumo_contenido (sucursal,insumo,cant) VALUES ('$id_sucursal','$codigo','0')");
                        }
                    }
                    
                    echo mensajes("Se ha Actualizado la informacion con exito","verde");
                }else{
                    $ss=mysql_query("SELECT id FROM insumo WHERE nombre='$nombre' or codigo='$codigo'");
                    if($rr=mysql_fetch_array($ss)){
                        echo mensajes("No se permiten datos duplicados en la base de datos","rojo");
                    }else{
                        mysql_query("INSERT INTO insumo (codigo,nombre,medida,contenido,costo,proveedor) 
                        VALUES ('$codigo','$nombre','$medida','$contenido','$costo','$proveedor')");
                        
                        $ss=mysql_query("SELECT id FROM sucursal");
                        while($rr=mysql_fetch_array($ss)){
                            $id_sucursal=$rr[0];
                            if(consultar('cant','insumo_contenido',"sucursal='$id_sucursal' and producto='$codigo'")==NULL){
                                mysql_query("INSERT INTO insumo_contenido (sucursal,insumo,cant) VALUES ('$id_sucursal','$codigo','0')");
                            }
                        }
                        
                        echo mensajes("Se ha Registrado el Insumo con Exito","verde");
                    }
                }
            }
        ?>        
            <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title" align="center"><b>Administración de Insumos</b></h4>
                             <div align="center"><button class="btn btn-icon waves-effect waves-light btn-success m-b-5" data-toggle="modal" data-target="#nuevo" > <i class="fa fa-plus" ></i> Nuevo</button></div>                       
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>                                       
                                        <th>Codigo</th>
                                        <th>Descripción</th>                                       
                                        <th align="center">Contenido</th>                                       
                                        <th align="center">Sistema de Medida</th>                                       
                                        <th>Proveedor</th>                                       
                                        <th align="right">costo</th>                                                                                                                 
                                        <th width="5%"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                   <?php 
                                        $ss=mysql_query("SELECT * FROM insumo ORDER BY nombre");
                                        while($rr=mysql_fetch_array($ss)){                  
                                    ?>
                                    <tr>                                       
                                        <td><?php echo $rr['codigo']; ?></td>
                                        <td><?php echo $rr['nombre']; ?></td>
                                        <td align="center"><?php echo $rr['contenido'];?></td>
                                        <td align="center"><?php echo consultar('nombre','confi',"id='".$rr['medida']."'"); ?></td>
                                        <td align="center"><?php echo consultar('nombre','proveedor',"id='".$rr['proveedor']."'"); ?></td>                                    
                                        <td align="right"><strong><?php echo $s.formato($rr['costo']); ?></strong></td>                                    
                                        <td align="center">
                                            <a href="#a<?php echo $rr[0]; ?>" role="button" class="btn btn-icon btn-ms waves-effect waves-light btn-warning m-b-5" data-toggle="modal"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    <div id="editar<?php echo $rr['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <form action="" name="form1" method="post">
                                    <input type="hidden" name="id" value="<?php echo $rr['id']; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" align="center">Editar Producto</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                   <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="field-1" class="control-label">Codigo</label>
                                                                                <input type="text" name="cod" value="<?php echo $rr['codigo']; ?>"   class="form-control" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="field-2" class="control-label">Descripción</label>
                                                                                <input type="text" name="nom" value="<?php echo $rr['nombre']; ?>"  class="form-control" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="field-2" class="control-label">Estado</label>
                                                                                <select class="form-control select2" name="estado" >                                               
                                                                                         <option value="s" <?php if($estado=='s'){ echo 'selected'; }?>>Activo</option>
                                                                                         <option value="n" <?php if($estado=='n'){ echo 'selected'; }?>>No Activo</option>                                                    
                                                                                    </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="field-6" class="control-label">Categoria</label>
                                                                                <select class="form-control select2" name="categoria" >
                                                                                        
                                                                                       <?php 
                                                                                            $ssc=mysql_query("SELECT * FROM confi WHERE tabla='categoria' ORDER BY nombre");
                                                                                            while($rr=mysql_fetch_array($ssc)){
                                                                                                echo '<option value="'.$rr[0].'">'.$rr['nombre'].'</option>';
                                                                                            }
                                                                                        ?>                                               
                                                                                    </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <div class="row">
                                                                         <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="field-6" class="control-label">Proveedor</label>
                                                                                <select class="form-control select2" name="prov" >
                                                                                       
                                                                                        <?php 
                                                                                            $ssp=mysql_query("SELECT codigo,nombre FROM proveedor ORDER BY nombre");
                                                                                            while($rr=mysql_fetch_array($ssp)){
                                                                                                if($prov==$rr['codigo']){
                                                                                                    echo '<option value="'.$rr['codigo'].'" selected>'.$rr['nombre'].'</option>';
                                                                                                }else{
                                                                                                    echo '<option value="'.$rr['codigo'].'">'.$rr['nombre'].'</option>';
                                                                                                }
                                                                                            }
                                                                                        ?>                                                  
                                                                                    </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="field-6" class="control-label">Inventario</label>
                                                                                <select class="form-control select2" name="inv" >
                                                                                        <option value="s" <?php if($inv=='s'){ echo 'selected'; }?>>Maneja Inventario</option>
                                                                                        <option value="n" <?php if($inv=='n'){ echo 'selected'; }?>>No Maneja Inventario</option>                                   
                                                                                    </select>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="field-2" class="control-label">IVA</label>
                                                                                <select class="form-control select2" name="iva" >                                               
                                                                                         <option value="s" <?php if($iva=='s'){ echo 'selected'; }?>>Activo</option>
                                                                                         <option value="n" <?php if($iva=='n'){ echo 'selected'; }?>>No Activo</option>                                                    
                                                                                    </select>
                                                                            </div>
                                                                        </div>
                                                                         <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="field-4" class="control-label">Costo</label>
                                                                                <input type="number" name="costo" value="<?php echo $costo; ?>"  min="0" step="any" required class="form-control" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="field-4" class="control-label">Valor</label>
                                                                                <input type="number" name="valor" value="<?php echo $valor; ?>"  min="0" step="any" required class="form-control" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="field-3" class="control-label">Asignar Imagen</label>
                                                                                <input type="file" name="imagen" class="form-control" id="imagen">
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
                <footer class="footer text-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                2016 © ste Soluciones Tecnológicas y Empresariales.
                            </div>
                        </div>
                    </div>
                </footer>
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