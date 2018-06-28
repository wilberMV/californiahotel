<?php 
    session_start();
    include_once "../php_conexion.php";
    include_once "../class_buscar.php";
    include_once "../funciones.php";
    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Informe','2')==true){
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

        <title>Rep. Ventas a Clientes</title>
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
         <script>
        function imprimir(){
          var objeto=document.getElementById('imprimeme');  //obtenemos el objeto a imprimir
          var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
          ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
          ventana.document.close();  //cerramos el documento
          ventana.print();  //imprimimos la ventana
          ventana.close();  //cerramos la ventana
        }
    </script>

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
                            <h4 class="m-t-0 header-title" align="center"><b>Reporte de Clientes por fecha</b></h4>                         
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
                            </div>  
                            </form><br><br>
                            <center><button onclick="imprimir();" class="btn btn-success"><i class=" fa fa-print "></i> Imprimir</button></center><br><br>                      
                            <div style="width:100%; height:700px; overflow: auto;">
                            <div id="imprimeme">
                            <div class="hidden">
                                      <hr/>
                                          <div style="font-size: 14px;"align="center">
                                             <strong>REPORTE DE KARDEX DE CLIENTES</strong><br>                              
                                        </div> 
                                        <hr/>
                                    </div>
                            <table class="table table-striped table-bordered table-responsive" width="100%" style="font-size: 14px;"  border="0">
                                <thead>
                                    <tr>                                       
                                        <th><div align="center">Cliente</div></th>
                                        <th><div align="center">Nº Servicios</div></th>
                                        <th><div align="right">Total Acomulado</div></th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                        $ss=mysql_query("SELECT SUM(neto) as netototal,cod_cliente,neto FROM factura WHERE sucursal='$id_sucursal' and fecha between '$fechai' AND '$fechaf' group by cod_cliente");
                                        while($rr=mysql_fetch_array($ss)){
                                            $oCliente=new Consultar_Cliente($rr['cod_cliente']);
                                            $cod_cliente=$rr['cod_cliente'];
                                            ###################################################################
                                            $sql = "SELECT * FROM factura WHERE cod_cliente='$cod_cliente' and fecha between '$fechai' AND '$fechaf'";
                                            $result = mysql_query($sql);
                                            $numero = mysql_num_rows($result); // obtenemos el número de filas 
                                    ?>
                                    <tr>                                       
                                        <td><?php echo $oCliente->consultar('nom');  ?></td>
                                        <td align="center"><?php echo $numero; ?></td>
                                        <td align="right"><strong><?php echo $s.formato($rr['netototal']); ?></strong></td>                                    
                                    </tr>
                                     <?php } ?>
                                     <tr>
                                      <?php 
                                        $t=mysql_query("SELECT sum(neto) as total FROM factura WHERE sucursal='$id_sucursal' and fecha between '$fechai' AND '$fechaf'");
                                        if($tt=mysql_fetch_array($t)){
                                    ?>
                                    <?php } ?>
                                        <td colspan="2"><div align="right"><strong><h4>Total General</h4></strong></div></td>
                                        <td><div align="right"><strong><h4>$ <?php echo formato($tt['total']); ?></h4></strong></div></td>
                                    </tr>                                                               
                                </tbody>
                            </table>
                            </div>
                            </div>
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