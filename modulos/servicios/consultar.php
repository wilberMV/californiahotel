<?php 
    session_start();
    include_once "../php_conexion.php";
    include_once "../funciones.php";
    include_once "../class_buscar.php";
    include_once "class/class.php";
    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Habitaciones','1')==true){
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

        <title>Listado de Servicios</title>
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
                                            <h4 class="modal-title" align="center">Nuevo Servicio</h4>
                                        </div>
                                        <div class="modal-body">
                                        
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-1" class="control-label">Codigo</label>
                                                        <input type="text" name="cod"  required  class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Descripción</label>
                                                        <input type="text" name="nom"  required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                              
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">Valor</label>
                                                        <input type="number" name="valor" required min="0" step="any" required class="form-control" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-6" class="control-label">Categoria</label>
                                                        <select class="form-control select2" name="categoria" required>
                                                                <option>Seleccionar</option>
                                                               <?php 
                                                                    $ssx=mysql_query("SELECT * FROM confi WHERE tabla='categoria' ORDER BY nombre");
                                                                        while($rr=mysql_fetch_array($ssx)){
                                                                            if($prov==$rr['id']){
                                                                                echo '<option value="'.$rr['id'].'" selected>'.$rr['nombre'].'</option>';
                                                                            }else{
                                                                                echo '<option value="'.$rr['id'].'">'.$rr['nombre'].'</option>';
                                                                             }
                                                                             }
                                                                ?>                                                   
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="row">
                                              
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">TIPO DE ALQUILER</label>
                                                        <select class="form-control select2" name="control" required>
                                                                 <option value="s">DIA</option>                                               
                                                                <option value="n">HORA</option>
                                                                <option value="c">CANTIDAD</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Estado</label>
                                                        <select class="form-control select2" name="estado" required>                                               
                                                                <option value="s">Activo</option>
                                                                 <option value="n">No Activo</option>                                                    
                                                            </select>
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
                                        $categoria=limpiar($_POST['categoria']);
                                        #$proveedor=limpiar($_POST['prov']);
                                        #$inventario=limpiar($_POST['inv']);
                                        $nchasis='';                                                                                           
                                        $nplaca='';                                                                                           
                                        $valor=limpiar($_POST['valor']);                                                                                           
                                        $estado=limpiar($_POST['estado']);                                                                                                                                                                                      
                                        $control=limpiar($_POST['control']);                                                                                                                                                                                      
                                                                            
                                                                    
                                        if(empty($_POST['id'])){
                                            $oProducto=new Proceso_Producto('',$codigo,$nombre,$categoria,$nchasis,$nplaca,$valor,$estado,$control);
                                            $ssx=mysql_query("SELECT codigo, nombre FROM producto WHERE nombre='$nombre' or codigo='$codigo'");
                                                if($rr=mysql_fetch_array($ssx)){
                                                    echo 
                                                    '<div class="alert alert-danger alert-dismissable" align="center">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        No se Permiten Datos Duplicados, el Actual Registro le Pertenece a <strong>'.$rr['nombre'].' </strong> Identificado con el Codigo 
                                                           <strong> '.$rr['codigo'].' </strong>
                                                    </div>';
                                                }
                                                else{
                                                    $oProducto->crear();
                                                     $ss=mysql_query("SELECT MAX(id)as id_maximo FROM producto");
                                                    if($rr=mysql_fetch_array($ss)){
                                                        $id=$rr['id_maximo'];
                                                    }

                                            echo mensajes('Producto "'.$nombre.'" Creado con Exito, con codigo '.cb($id),'verde'); 
                                                }
                                           
                                           
                                        }else{
                                            $id=limpiar($_POST['id']);
                                            $oProducto=new Proceso_Producto($id,$codigo,$nombre,$categoria,$nchasis,$nplaca,$valor,$estado,$control);
                                            $oProducto->actualizar();
                                            echo mensajes('Producto "'.$nombre.'" Actualizado con Exito, con la ID de '.cb($id),'verde');
                                        }
                                            //subir la imagen del articulo
                                        /*$nameimagen = $_FILES['imagen']['name'];
                                        $tmpimagen = $_FILES['imagen']['tmp_name'];
                                        $extimagen = pathinfo($nameimagen);
                                        $ext = array("png","jpg");
                                        $urlnueva1 = "../../producto/".$codigo.".jpg";   
                                        if(is_uploaded_file($tmpimagen)){
                                            if(array_search($extimagen['extension'],$ext)){
                                                copy($tmpimagen,$urlnueva1);    
                                                echo mensajes("Se ha Actualizado la Imagen de Presentacion con Exito","verde");
                                            }else{
                                                echo mensajes("Error al Subir la Imagen, solo se acepta JPG","rojo");
                                            }
                                        }else{
                                            echo mensajes("Error al Subir la Imagen, solo se acepta JPG","rojo");
                                        }*/
                                    }            
                            ?>                                      
            <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title" align="center"><b>Administrar Habitación/Servicios</b></h4>
                             <div align="center"><button class="btn btn-icon waves-effect waves-light btn-success m-b-5" data-toggle="modal" data-target="#nuevo" > <i class="fa fa-user-plus" ></i> Nuevo</button></div>                       
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>                                       
                                        <th>Codigo</th>
                                        <th>Descripción</th>                                       
                                        <th>Categoria</th>   
                                        <th>Tipo</th>   
										<th>Estado</th> 										
                                        <!--<th>IVA</th>-->                                       
                                        <th>Valor</th>                                                                                                                 
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                        $ss=mysql_query("SELECT * FROM producto ORDER BY nombre");
                                        while($rr=mysql_fetch_array($ss)){
                                            $inv=$rr['inv'];
                                            $estado=$rr['estado'];
                                            $iva=$rr['iva'];
                                            $cont=$rr['control'];
                                            $valor=$rr['valor'];
                                            $cat=$rr['categoria'];
                                            $nchasis=$rr['nchasis'];
                                            $nplaca=$rr['nplaca'];
                                            $oTipo=new Consultar_Categoria($rr['categoria']);
											if($rr['control']=='s'){
												$control='DIAS';
											}
                                            elseif($rr['control']=='n'){
                                                $control='HORAS';
                                            }
											else{
												$control='CANTIDAD';
											}
											        
											?>
                                    <tr>                                       
                                        <td><?php echo $rr['codigo']; ?></td>
                                        <td><?php echo $rr['nombre']; ?></td>
                                        <td><?php echo $oTipo->consultar('nombre');  ?></td>
                                        <td><?php echo $control; ?></td>
                                        <td align="center"><?php echo estado($rr['estado']); ?></td>
                                        <!--<td align="center"><?php echo estado($rr['inv']); ?></td>
                                        <td align="center"><?php echo estado($rr['iva']); ?></td>-->                                    
                                        <td align="center"><strong><?php echo $s.formato($rr['valor']); ?></strong></td>                                    
                                        <td align="center">
                                                <div  class="btn-group btn-group m-b-10">
                                                    <a href="#editar<?php echo $rr['id']; ?>" class="btn btn-primary btn-sm waves-effect waves-light" role="button" data-toggle="modal"> <i class="fa  fa-pencil-square-o"></i> Editar</a>
                                                </div>
                                            <?php 
                                                if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Productos','4')==true){
                                                    if($rr['inv']==''){
                                                ?>                                       
                                                <div  class="btn-group btn-group m-b-10">
                                                    <a href="#editar<?php echo $rr['id']; ?>" class="btn btn-primary btn-sm waves-effect waves-light" role="button" data-toggle="modal"> <i class="fa  fa-pencil-square-o"></i> Editar</a>
                                                </div>
                                            <?php }} ?>
                                        </td>
                                    </tr>
                                    <div id="editar<?php echo $rr['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <form action="" name="form1" method="post">
                                    <input type="hidden" name="id" value="<?php echo $rr['id']; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" align="center">Editar Servicio</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                   <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="field-1" class="control-label">Codigo</label>
                                                                                <input type="text" name="cod" value="<?php echo $rr['codigo']; ?>"   class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="field-2" class="control-label">Descripción</label>
                                                                                <input type="text" name="nom" value="<?php echo $rr['nombre']; ?>"  class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="field-4" class="control-label">Valor</label>
                                                                                <input type="number" name="valor" value="<?php echo $valor; ?>"  min="0" step="any" required class="form-control" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="field-6" class="control-label">Categoria</label>
                                                                                <select class="form-control select2" name="categoria" >                                                                
                                                                                      
                                                                                         <?php 
                                                                                            $ct=mysql_query("SELECT * FROM confi ORDER BY nombre");
                                                                                            while($rr=mysql_fetch_array($ct)){
                                                                                                if($cat==$rr['id']){
                                                                                                    echo '<option value="'.$rr['id'].'" selected>'.$rr['nombre'].'</option>';
                                                                                                }else{
                                                                                                    echo '<option value="'.$rr['id'].'">'.$rr['nombre'].'</option>';
                                                                                                }
                                                                                            }
                                                                                        ?>                                        
                                                                                    </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="field-2" class="control-label">Tipo de Servicio</label>
                                                                                <select class="form-control select2" name="control" >                                               
                                                                                         <option value="s" <?php if($cont=='s'){ echo 'selected'; }?>>DIA</option>
                                                                                         <option value="n" <?php if($cont=='n'){ echo 'selected'; }?>>HORA</option>
                                                                                         <option value="c" <?php if($cont=='c'){ echo 'selected'; }?>>CANTIDAD</option>                                                    
                                                                                    </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="field-2" class="control-label">Estado</label>
                                                                                <select class="form-control select2" name="estado" >                                               
                                                                                         <option value="s" <?php if($estado=='s'){ echo 'selected'; }?>>Activo</option>
                                                                                         <option value="n" <?php if($estado=='n'){ echo 'selected'; }?>>No Activo</option>                                                    
                                                                                    </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                         
                                                                        
                                                                    </div>
                                                                    <!--<div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="field-3" class="control-label">Asignar Imagen</label>
                                                                                <input type="file" name="imagen" class="form-control" id="imagen">
                                                                            </div>
                                                                        </div>
                                                                    </div>-->                                      
                                                                                                                            
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