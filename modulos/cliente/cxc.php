<?php 
    session_start();
    include_once "../php_conexion.php";
    include_once "../funciones.php";
    include_once "class/class.php";
    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Clientes','1')==true){
        }else{
            header('Location: ../error500.php');
        }
    }else{
        header('Location: ../error500.php');
    }
     $usuario=$_SESSION['cod_user'];
     $cajero=consultar('nom','persona',"cod='$usuario'");
    $id_sucursal=consultar('sucursal','username',"usu='$usuario'");
    $empresa=consultar('nom','sucursal',"id='$id_sucursal'");
    if(!empty($_GET['id'])){
        $id=limpiar($_GET['id']);   
        $sql=mysql_query("SELECT * FROM contable WHERE id='$id' and tipo='CXC'");
        if($row=mysql_fetch_array($sql)){
            $concepto1=$row['concepto1'];   
            $fecha=$row['fecha'];
            $concepto2=$row['concepto2'];   
            $hora=$row['hora'];
            $deuda=$row['valor'];
            
        }else{
            return header('Location: cobros.php');
        }
    }else{
        return header('Location: cobros.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="../../assets/images/favicon.ico">

        <title>Listado de Clientes</title>
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
                       <a href="#" class="logo"> <span><?php include_once "../cabeza.php"; ?></span> </a>
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
                          <?php
                        if(!empty($_POST['valor'])){
                            $valor=limpiar($_POST['valor']);
                            if(!empty($_POST['nota'])){
                                $nota=limpiar($_POST['nota']);
                            }else{
                                $nota='Sin Observaciones';
                            }
                            
                            $fecha=date('Y-m-d');
                            $hora=date('H:i:s');
                            
                            mysql_query("INSERT INTO abono (cuenta,valor,fecha,hora,nota,usu) VALUES ('$id','$valor','$fecha','$hora','$nota','$usuario')");
                            mysql_query("INSERT INTO contable (concepto1,concepto2,tipo,valor,fecha,hora,usu,consultorio,clase) 
                                VALUES ('$concepto1','Sin Observaciones','ENTRADA','$valor','$fecha','$hora','$usuario','$id_sucursal','CXC')");
                            echo mensajes("El Abono a la Cuenta por Cobrar No. ".$id." por valor de ".$s." ".formato($valor)." ha sido registrado con exito","verde");
                        }
                        ?>                                      
            <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                              <table class="table table-bordered">
                                <tr class="info">
                                    <td><strong>Cuenta por Cobrar: </strong> <span class="badge"><?php echo $id; ?></span><br></td>
                                    <td><strong>Cliente: </strong> <?php echo consultar('nom','cliente',' id='.$row['concepto1']); ?><br></td>
                                    <td><strong>Fecha: </strong> <?php echo fecha($fecha).' '.$hora; ?></td>
                                </tr>
                            </table>
                            <div class="row-fluid">
                            <div class="col-md-4 text-danger" align="center" style="font-size:16px">
                                <strong>Total Deuda</strong><br>
                                <strong> <?php echo $s.' '.formato($deuda); ?></strong>
                            </div>
                            <div class="col-md-4 text-info" align="center" style="font-size:16px">
                                <strong>Total Abonado</strong><br>
                                <strong><?php echo $s.' '.formato(abonos_saldo($id)); ?></strong>
                            </div>
                            <div class="col-md-4 text-success" align="center" style="font-size:16px">
                                <strong>Saldo Faltante</strong><br>
                                <strong><?php echo $s.' '.formato($deuda-abonos_saldo($id)); ?></strong>
                            </div>
                        </div><br><br><br>
                          <?php 
                                $por=abonos_saldo($id)*100/$deuda;
                            ?>
                            <strong><center><?php echo 'Total Abonado: '.formato($por).'% || Total Saldo '.formato(100-$por).'%'; ?></center></strong>
                            <div class="progress progress-striped active">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo $por; ?>%;"></div>
                            </div>
                             <div class="col-md-2"></div>
                             <div class="col-md-6">
                                     <div class="panel-body" align="center">                                                                                 
                                       <a href="cobros.php">
                                        <button type="button" class="btn btn-primary btn-circle"><i class="fa fa-arrow-left fa-2x" title="Regresar"></i>
                                        </button></a>
                                     <?php 
                                        if($deuda-abonos_saldo($id)<>0){ 
                                            echo ' <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#abono"><i class="fa fa-plus fa-2x" title="Agregar Nuevo Abono"></i>
                                                  </button>';
                                        }
                                    ?>
                                    <button onclick="imprimir();" class="btn btn-deafult btn-circle"><i class=" fa fa-print fa-2x"></i></button>                                                                                                              
                              </div>
                            </div>
                            <div id="imprimeme">
                         <div class="hidden">
                                     <table  width="100%" style="border: 1px solid #660000; -moz-border-radius: 13px;-webkit-border-radius: 12px;padding: 10px;">
                                     <tr>
                                        <td>
                                            <center>
                                            <img src="../../img/softunicorn.png" width="75px" height="75px"><br>
                                            <!--<strong><?php echo $nombre_empresa; ?></strong><br>-->
                                            </center>                                                    
                                        </td>
                                        <td align="center">                     
                                            <div style="font-size: 25px;"><strong><em><?php echo $empresa; ?></em></strong></div>
                                                   Usuario: <?php echo $cajero; ?>
                                                        Fecha y Hora: <?php echo fecha($fecha); ?> <?php echo date($hora); ?><br>
                                            <!--<strong><?php echo $nombre_empresa; ?></strong><br>-->                                                 
                                        </td>
                                        <td>
                                        </td>
                                     </tr>                          
                                    </table><br>
                                      <hr/>
                                          <div style="font-size: 14px;"align="center">
                                             <strong>REPORTE DE ABONOS</strong><br>                              
                                        </div> 
                                        <hr/>
                                    </div>
                         <div class="col-md-4"></div>
                          
                           <!-- Advanced Tables -->
                           <table class="table table-striped table-bordered table-hover"  width="100%" style="border: 1px solid #660000;">                                    
                                    <thead>
                                        <tr>
                                            <th>FECHA</th>
                                            <th>OBSERVACION</th>
                                            <th>RESPONSABLE</th>                                                                                                                                 
                                            <th><div align="right"><strong>VALOR</strong></div></th>                                                                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql=mysql_query("SELECT * FROM abono WHERE cuenta='$id'");
                                            while($row=mysql_fetch_array($sql)){
                                        ?>
                                            <tr>
                                                <td><center><?php echo fecha($row['fecha']).' - '.$row['hora']; ?></center></td>
                                                <td><?php echo $row['nota']; ?></td>
                                                <td><?php echo consultar('nom','persona',' cod='.$row['usu']); ?></td>
                                                <td><div align="right"><?php echo $s.' '.formato($row['valor']) ?></div></td>
                                            </tr>
                                        <?php } ?>                                                              
                                    </tbody>                                    
                                </table>                                                                
                                 </div>                      
                        
                    
                    <!--End Advanced Tables -->
                           <!--  Modals-->
                         <div class="modal fade" id="abono" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <form name="forms" method="post" action="">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        
                                            <h3 align="center" class="modal-title" id="myModalLabel">Registrar<br><?php echo 'Cuenta por Cobrar No. '.$id; ?></h3>
                                        </div>
                                        <div class="panel-body">
                                        <div class="row">                                       
                                            <div class="col-md-6">                                          
                                                <label>Valor del Abono:</label>                                             
                                                <input type="text" name="valor" value="1" min="1" max="<?php echo $deuda-abonos_saldo($id); ?>" autocomplete="off" required class="form-control"><br><br>
                                            </div>
                                            <div class="col-md-6">                                                                                          
                                                 <label>Observaciones</label>
                                                <input type="text" name="nota" autocomplete="off" class="form-control">
                                            </div>                                                                        
                                        </div> 
                                        </div> 
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Registrar</button>
                                        </div>                                       
                                    </div>
                                </div>
                                </form>
                            </div>
                     <!-- End Modals-->
    


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