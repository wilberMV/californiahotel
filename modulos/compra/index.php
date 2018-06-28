<?php 
    session_start();
    include_once "../php_conexion.php";
    include_once "../funciones.php";
    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Compras','1')==true){
        }else{
            header('Location: ../error500.php');
        }
    }else{
        header('Location: ../error500.php');
    }
    $id_proveedor='';
    $usuario=$_SESSION['cod_user'];
    if(!empty($_GET['p'])){
        $id_proveedor=get(limpiar($_GET['p']),'proveedor','id');
        $ss=mysql_query("SELECT * FROM proveedor WHERE id='$id_proveedor'");
        $proveedor=mysql_fetch_array($ss);
        
        if(!empty($_GET['d'])){
            $d=get(limpiar($_GET['d']),'compra_tmp','id');
            mysql_query("DELETE FROM compra_tmp WHERE id='$d'");
            header('Location: index.php?p='.claves($id_proveedor)); 
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

        <link rel="shortcut icon" href="../../assets/images/favicon_1.ico">

        <title>Realizar Compra</title>

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

        <div class="wrapper">
            <div class="container">

                 <div class="col-lg-12">
                        <div class="panel panel-success panel-border">
                            <div class="panel-heading" align="center">
                                <h3 class="panel-title">Realizar Compra</h3>                                
                            </div>
                        <div class="panel-body">
                            <?php if($id_proveedor==''){ ?>
                            <div align="center">                              
                                  <label for="field-4" class="control-label">Seleccionar Proveedor</label>
                                    <select name="p" class="form-control select2" onChange="location.href=this.value">
                                        <option value="">-- Seleccionar --</option>
                                        <?php 
                                            $ss=mysql_query("SELECT id,nombre FROM proveedor ORDER BY nombre");
                                            while($rr=mysql_fetch_array($ss)){
                                                echo '<option value="index.php?p='.claves($rr['id']).'">'.$rr['nombre'].'</option>';
                                            }
                                        ?>
                                    </select>
                            </div>      
                            <?php }elseif($id_proveedor<>''){ ?>
                             <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <h3 align="center">Proveedor: "<?php echo $proveedor['nombre']; ?>"</h3>
                                        <center><a href="index.php" class="btn btn-info waves-effect waves-light"><strong>Nueva Busqueda</strong></a></center>
                                    </td>
                                </tr>
                            </table>
                             <div align="right">
                                <form name="gor" action="" method="post" class="form-inline">
                                    <input type="text" name="b" class="form-control" autocomplete="off" autofocus required autocomplete="off" value="" class="input-xlarge" list="browsers">
                                    <datalist id="browsers">
                                        <?php 
                                            $ss=mysql_query("SELECT nombre FROM producto WHERE prov='$id_proveedor' ORDER BY nombre");
                                            while($rr=mysql_fetch_array($ss)){
                                                echo '<option value="'.$rr['nombre'].'">';
                                            }
                                        ?>
                                    </datalist>
                                    <button type="submit" class="btn btn-success waves-effect waves-light"><strong>Agregar</strong></button>
                                </form>
                            </div>
                            <?php

                                if(!empty($_POST['metodopago'])){
                                        $prov=limpiar($_POST['prov']);                  
                                        $fecha=date('Y-m-d');
                                        $metodopago=limpiar($_POST['metodopago']);      
                                        $hora=date('H:i:s');
                                        $usuario=$_SESSION['cod_user'];                 
                                        $sucursal=limpiar($_POST['sucursal']);
                                        
                                        mysql_query("INSERT INTO compra (proveedor,usuario,sucursal,fecha,hora,formapago) 
                                        VALUES ('$prov','$usuario','$sucursal','$fecha','$hora','$metodopago')");
                                        
                                        $ss=mysql_query("SELECT MAX(id) as id_maximo FROM compra WHERE usuario='$usuario'");
                                        if($rr=mysql_fetch_array($ss)){
                                            $id_maximo=$rr['id_maximo'];
                                        }
                                        $neto=0;
                                        $ss=mysql_query("SELECT * FROM compra_tmp WHERE usuario='$usuario'");
                                        while($rr=mysql_fetch_array($ss)){
                                            $codigo=$rr['codigo'];  
                                            $nombre=$rr['nombre'];
                                            $cant=$rr['cant'];      
                                            $valor=$rr['valor'];
                                            
                                            $neto=$neto+($valor*$cant);
                                            
                                            mysql_query("INSERT INTO compra_detalle (compra,codigo,nombre,cant,valor) 
                                            VALUES ('$id_maximo','$codigo','$nombre','$cant','$valor')");
                                            mysql_query("UPDATE contenido SET cant=cant+$cant WHERE sucursal='$sucursal' and producto='$codigo'");
                                        }
                                        
                                        mysql_query("DELETE FROM compra_tmp WHERE usuario='$usuario' and proveedor='$prov'");
                                        #header('Location: index.php?i='.claves($id_maximo));
                                         echo mensajes('Compra Finalizada con Exito','verde'); 
                                    }
                                             
                                ?>                      
                            <?php 
                                if(!empty($_POST['b'])){
                                    $b=limpiar($_POST['b']);
                                    $ss=mysql_query("SELECT * FROM producto WHERE (nombre='$b' or codigo='$b') and (inv='s' and prov='$id_proveedor')");
                                    if($rr=mysql_fetch_array($ss)){
                                        $cod=$rr['codigo'];
                                        $nom=$rr['nombre'];
                                        $val=$rr['costo'];
                                        $ss=mysql_query("SELECT * FROM compra_tmp WHERE proveedor='$id_proveedor' and usuario='$usuario' and codigo='$cod'");
                                        if($rr=mysql_fetch_array($ss)){
                                            mysql_query("UPDATE compra_tmp SET cant=cant+1 WHERE proveedor='$id_proveedor' and usuario='$usuario' and codigo='$cod'");
                                        }else{
                                            mysql_query("INSERT INTO compra_tmp (proveedor,codigo,nombre,cant,valor,usuario) 
                                            VALUES ('$id_proveedor','$cod','$nom','1','$val','$usuario')");
                                        }
                                    }else{
                                        echo mensajes('El Producto Ingresado no se encuentra disponible o cumple con las caracteristicas','rojo');  
                                    }
                                }
                                if(!empty($_POST['id'])){
                                    $id=limpiar($_POST['id']);
                                    $cant=limpiar($_POST['cant']);
                                    $valor=limpiar($_POST['valor']);
                                    mysql_query("UPDATE compra_tmp SET valor='$valor', cant='$cant' WHERE id='$id'");
                                }
                            ?>

                        </div>
                    </div>
                </div>

                 <!-- end row -->
                 <div class="col-lg-8">
                      <div class="panel panel-success panel-border">
                        <div class="panel-body">
                          <div class="table-responsive">
                         <table class="table table-bordered">
                            <tr class="well">
                                <td><strong>Codigo</strong></td>
                                <td><strong>Descripcion</strong></td>
                                <td><strong><div align="right">Valor</div></strong></td>
                                <td><strong><center>Cant</center></strong></td>
                                <td><strong><div align="right">Importe</div></strong></td>
                                <td width="10%"></td>
                            </tr>
                            <?php 
                                $subtotal=0;
                                $ss=mysql_query("SELECT * FROM compra_tmp WHERE proveedor='$id_proveedor' and usuario='$usuario'");
                                while($rr=mysql_fetch_array($ss)){
                                    $importe=$rr['cant']*$rr['valor'];
                                    $subtotal=$subtotal+$importe;
                            ?>
                            <tr>
                                <td><?php echo $rr['codigo']; ?></td>
                                <td><?php echo $rr['nombre']; ?></td>
                                <td><div align="right"><?php echo $s.formato($rr['valor']); ?></div></td>
                                <td><center><?php echo $rr['cant']; ?></center></td>
                                <td><div align="right"><?php echo $s.formato($importe); ?></div></td>
                                <td>
                                    <center>
                                        <a href="index.php?p=<?php echo claves($id_proveedor).'&d='.claves($rr[0]); ?>" class="btn btn-danger btn-xs waves-effect waves-light">
                                        <i class="fa fa-remove"></i></a>
                                        <a href="#a<?php echo $rr[0]; ?>" role="button" class="btn btn-primary btn-xs waves-effect waves-light" data-toggle="modal"><i class="fa fa-edit"></i></a>
                                    </center>
                                </td>
                            </tr>
                              <div id="a<?php echo $rr[0]; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <form action="" name="form1" method="post">
                                    <input type="hidden" name="id" value="<?php echo $rr[0]; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" align="center">Actualizar Informacion<br><?php echo $rr['nombre']; ?></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="field-1" class="control-label">Cantidad</label>
                                                                                <input type="number" name="cant" value="<?php echo $rr['cant']; ?>"   class="form-control" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="field-2" class="control-label">Nuevo Valor</label>
                                                                                <input type="number" name="valor" min="0" step="any" value="<?php echo $rr['valor']; ?>"  class="form-control" autocomplete="off">
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
                        </table>
                        </div>

                       </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="col-lg-4">
                      <div class="panel panel-success panel-border">
                        <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <center>
                                        <strong>SubTotal</strong><br>
                                        <h2 class="text-success"><?php echo $s.formato($subtotal); ?></h2>
                                    </center>
                                </td>
                            </tr>
                        </table>
                        <center>
                            <a href="#myModal" role="button" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-toggle="modal">
                            <strong>Finalizar Compra</strong></a>
                        </center>
                             <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <form action="" name="form1" method="post" enctype="multipart/form-data">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title" align="center">Finalizar Compra</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                         <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="field-1" class="control-label">Proveedor</label>
                                                                    <input type="text" readonly value="<?php echo $proveedor['nombre']; ?>" required  class="form-control" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="field-2" class="control-label">Total Compra</label>
                                                                    <input type="text" readonly value="<?php echo $s.formato($subtotal); ?>"  required class="form-control" autocomplete="off">
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="field-2" class="control-label">Metodo de Pago</label>
                                                                    <input type="hidden" name="prov" value="<?php echo $id_proveedor; ?>">
                                                                    <select class="form-control select2" name="metodopago" required>                                               
                                                                            <option value="CXP">Cuentas por Pagar</option>
                                                                                <?php 
                                                                                    $ss=mysql_query("SELECT * FROM metodopago ORDER BY tipo,nombre");
                                                                                    while($rr=mysql_fetch_array($ss)){
                                                                                        echo '<option value="'.$rr['id'].'">'.$rr['tipo'].', '.$rr['nombre'].'</option>';
                                                                                    }
                                                                                ?>                                                  
                                                                        </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="field-6" class="control-label">Sucursal</label>
                                                                    <select class="form-control select2" name="sucursal" required>
                                                                           <?php 
                                                                                $ss=mysql_query("SELECT id,nom FROM sucursal ORDER BY nom");
                                                                                while($rr=mysql_fetch_array($ss)){
                                                                                    if(consultar('sucursal','username',"usu='$usuario'")==$rr['id']){
                                                                                        echo '<option value="'.$rr['id'].'" selected>'.$rr['nom'].'</option>';
                                                                                    }else{
                                                                                        echo '<option value="'.$rr['id'].'">'.$rr['nom'].'</option>';
                                                                                    }
                                                                                }
                                                                            ?>                                           
                                                                        </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                                                                                                                               
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-info waves-effect waves-light">Finalizar</button>
                                                        </div>                                  
                                                    </div>
                                                </div>
                                                </form>
                                            </div><!-- /.modal -->  
                


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
                <?php } ?>

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