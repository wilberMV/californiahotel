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
    $id_sucursal=consultar('sucursal','username',"usu='$usuario'");
     #paginar
        $maximo=10;
        if(!empty($_GET['pag'])){
            $pag=limpiar($_GET['pag']);
        }else{
            $pag=1;
        }
        $inicio=($pag-1)*$maximo;
        
        $cans=mysql_query("SELECT COUNT(concepto1)as total FROM contable");
        if($dat=mysql_fetch_array($cans)){
            $total=$dat['total']; #inicializo la variable en 0
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
                if(!empty($_POST['trans']) and !empty($_POST['concepto1'])){
                    $tipo=limpiar($_POST['trans']);                 
                    $valor=limpiar($_POST['valor']);
                    $concepto1=limpiar($_POST['concepto1']);        
                    $fecha=date('Y-m-d');
                    $concepto2=limpiar($_POST['concepto2']);        
                    $hora=date('H:i:s');
                    
                    $sql=mysql_query("SELECT * FROM contable WHERE concepto1='$concepto1' and concepto2='$concepto2' and fecha='$fecha' and valor='$valor' and tipo='$tipo'");
                    if($row=mysql_fetch_array($sql)){
                        echo mensajes('No se permiten datos duplicados en la base de datos','rojo');
                    }else{
                        mysql_query("INSERT INTO contable (concepto1,concepto2,tipo,valor,fecha,hora,usu,consultorio) 
                        VALUES ('$concepto1','$concepto2','$tipo','$valor','$fecha','$hora','$usu','$id_almacen')");
                        echo mensajes('El Registro Contable ha sido Registrado con Exito','verde');
                    }
                }
            ?>
           
              <?php 
                if(!empty($_GET['fechai']) and !empty($_GET['fechaf'])){
                    $fechai=limpiar($_GET['fechai']);
                    $fechaf=limpiar($_GET['fechaf']);
                }else{
                    $fechai=date('Y-m-d');  
                    $fechaf=date('Y-m-d');  
                }
                $usu='';    $trans='';      $where='';
                $act_trans='active';$act_usu='';
                if(!empty($_GET['trans'])){
                    $trans=limpiar($_GET['trans']);
                    $act_trans='active';
                    $act_usu='';
                    if($trans<>'TODOS'){
                        $where="WHERE tipo='".$trans."' and fecha between '$fechai' AND '$fechaf' LIMIT $inicio, $maximo";
                    }else{
                        $where='';  
                    }
                }elseif(!empty($_GET['usu'])){
                    $usu=limpiar($_GET['usu']);
                    $act_usu='active';
                    $act_trans='';  
                    $where="WHERE usu='".$usu."' and fecha between '$fechai' AND '$fechaf' LIMIT $inicio, $maximo";
                }
                            $venta_total=0;$entrada=0;$cxp=0;$cxc=0;
                            $sqlx=mysql_query("SELECT * FROM contable WHERE consultorio='$id_sucursal' AND fecha between '$fechai' AND '$fechaf'");
                            while($row=mysql_fetch_array($sqlx)){
                                if($row['tipo']=='COMPRA'){
                                    $entrada=$entrada+$row['valor'];
                                }
                                elseif($row['tipo']=='ENTRADA'){
                                    $venta_total=$venta_total+$row['valor'];
                                    
                                }
                                elseif($row['tipo']=='CXP'){
                                    
                                }
                            }
            ?>                                    
            <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title" align="center"><b>CUENTAS POR COBRAR</b></h4>
                            <div class="panel panel-default">                      
                        <div class="panel-body">
                            <ul class="nav nav-pills">
                                <li class="active"><a href="#transaccion" data-toggle="tab">Consultar por Tipo de Transaccion</a>
                                </li>
                                 <li class=""><a href="#usuario" data-toggle="tab">Consultar por Usuario</a>
                                </li>  
                            </ul>

                            <div class="tab-content">
                               <div class="tab-pane fade active in" id="transaccion">
                                <form name="form1" action="" method="get" class="form-inline">
                           <div class="panel-body">
                           <div class="row"> 
                                <div class="col-md-4">
                                    <strong>Fecha Inicial</strong><br>
                                    <input class="form-control" value="<?php echo $fechai; ?>" name="fechai" type="date" autocomplete="off" required>
                                </div>
                                <div class="col-md-4">
                                    <strong>Fecha Finalizacion</strong><br>
                                    <input class="form-control" value="<?php echo $fechaf; ?>" name="fechaf" type="date" autocomplete="off" required>
                                </div>
                                <div class="col-md-4">
                                    <strong>Tipo de Transaccion</strong><br>
                                    <select class="form-control" name="trans">
                                        <option value="TODOS" <?php if($trans=='TODOS'){ echo 'selected'; } ?>>TODOS</option>                                       
                                        <option value="ENTRADA" <?php if($trans=='VENTA'){ echo 'selected'; } ?>>ENTRADA</option>
                                        <!--<option value="SALIDA" <?php if($trans=='SALIDA'){ echo 'selected'; } ?>>SALIDA</option>-->
                                        <option value="CXC" <?php if($trans=='CXC'){ echo 'selected'; } ?>>Cuentas por Cobrar</option>
                                        <!--<option value="CXP" <?php if($trans=='CXP'){ echo 'selected'; } ?>>Cuentas por Pagar</option>-->                                       
                                    </select>
                                     <button type="submit"  class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                           </div>
                        </form>
                                                                 
                                </div>
                                <div class="tab-pane fade fade" id="usuario">
                                <form name="form2" action="" method="get" class="form-inline">
                            <div class="panel-body">
                            <div class="row"> 
                                <div class="col-md-4">  
                                    <strong>Fecha Inicial</strong><br>
                                    <input class="form-control" value="<?php echo $fechai; ?>" name="fechai" type="date" autocomplete="off" required>
                                </div>
                                <div class="col-md-4">  
                                    <strong>Fecha Finalizacion</strong><br>
                                    <input class="form-control" value="<?php echo $fechaf; ?>" name="fechaf" type="date" autocomplete="off" required>
                                </div>
                                <div class="col-md-4">  
                                    <strong>Usuario</strong><br>
                                    <select class="form-control" name="usu">
                                        <?php 
                                            $sql=mysql_query("SELECT * FROM persona ORDER BY nom");
                                            while($row=mysql_fetch_array($sql)){
                                                if($row['doc']==$usu){
                                                    echo '<option value="'.$row['doc'].'" selected>'.$row['nom'].'</option>';
                                                }else{
                                                    echo '<option value="'.$row['doc'].'">'.$row['nom'].'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                    <button type="submit"  class="btn btn-primary"><i class="icon-search"></i> <strong>Consultar</strong></button>
                                </div>
                            </div>
                            </div>
                        </form>
                                                                                             
                                </div>         
                                                        
                            </div>
                        </div>
                    </div>
                     <div class="row">
                                             <div class="col-md-3" align="right">
                                                   
                                            </div>
                                            <?php 
                                            if(!empty($_GET['buscar'])){
                                                $buscar=limpiar($_GET['buscar']);
                                            }else{
                                               
                                                $buscar='';
                                            }
                                        ?>
                                            <form name="form1" method="post" action="">
                                                <div class="col-md-6">
                                                         <div class="input-group">
                                                        <span class="input-group-addon">CLIENTE:</span>
                                                        <input type="text" list="browsers1" name="buscary" autocomplete="off" class="form-control" required>
                                                        <datalist id="browsers1">
                                                            <?php
                                                                $pa=mysql_query("SELECT * FROM cliente 
                                                                WHERE cliente.id");                
                                                                while($row=mysql_fetch_array($pa)){
                                                                    echo '<option value="'.$row['nom'].'">';                                          
                                                                }
                                                            ?> 
                                                        </datalist>
                                                        </div>
                                                    <br>
                                                </div>
                                                 <div class="col-md-3">
                                                        <div class="input-append">
                                                        <button type="submit" class="btn btn-icon waves-effect waves-light btn-default m-b-5"><strong><i class="fa fa-search"></i> Buscar</strong></button>
                                                        </div>
                                                </div>
                                            </div>
                                            </form><br>
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>CLIENTE</th>                                                                                      
                                            <th>TIPO</th>                                                                                     
                                            <th>FECHA REGISTRO</th>
                                            <th>VALOR</th>
                                            <th>RESPONSABLE</th>
                                            <th></th>                                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                   <?php 
                                                #$sql=mysql_query("SELECT * FROM contable ".$where);
                                                  if(!empty($_POST['buscary'])){
                                                    $buscary=limpiar($_POST['buscary']);
                                                    $ver=consultar('id','cliente',"nom='".$buscary."'");
                                                    $sql=mysql_query("SELECT * FROM contable WHERE concepto1 LIKE '%$ver%' LIMIT $inicio, $maximo");                 
                                                }else{
                                                    $sql=mysql_query("SELECT * FROM contable ".$where);               
                                                }
                                                while($row=mysql_fetch_array($sql)){
                                                    if($row['tipo']=='ENTRADA'){
                                                        $tipo='<span class="label label-success">Entrada</span>';
                                                    }elseif($row['tipo']=='SALIDA'){
                                                        $tipo='<span class="label label-danger">SALIDA</span>';
                                                    }elseif($row['tipo']=='CXC'){
                                                        $tipo='<span class="label label-danger">Cuentas por Cobrar</span>';
                                                    }elseif($row['tipo']=='CXP'){
                                                        $tipo='<span class="label label-warning">Cuentas por Pagar</span>';
                                                    }
                                            ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo consultar('nom','cliente',' id='.$row['concepto1']); ?></td>
                                            <td><center><?php echo $tipo; ?></center></td>
                                            <td><center><?php echo fecha($row['fecha']).' '.$row['hora']; ?></center></td>
                                            <td><div align="right"><?php echo $s.' '.formato($row['valor']); ?></div></td>
                                            <td><?php echo consultar('nom','persona',' cod='.$row['usu']); ?></td>
                                            <td>
                                                <center>
                                                <?php if($row['tipo']=='CXC'){ ?>
                                                    <a href="cxc.php?id=<?php echo $row[0]; ?>" class="btn btn btn-danger btn-xs"><strong>Abonar</strong></a>
                                                <?php }elseif($row['tipo']=='CXP'){ ?>
                                                    <a href="cxp.php?id=<?php echo $row[0]; ?>" class="btn btn btn-danger btn-xs"><strong>Abonar</strong></a>
                                                <?php } ?>
                                                </center>
                                            </td>
                                        </tr> 
                                        <?php } ?>                                                                             
                                    </tbody>
                                </table>
                                  <div align="center">
                                    <ul class="pagination pagination-split" >
                                        <?php
                                        if(empty($_POST['bus'])){
                                            $tp = ceil($total/$maximo);#funcion que devuelve entero redondeado
                                            for ($n=1; $n<=$tp ; $n++){
                                                if($pag==$n){
                                                    echo '<li class="active"><a href="materia.php?pag='.$n.'"><strong>'.$n.'</strong></a></li>';   
                                                }else{
                                                    echo '<li><a href="materia.php?pag='.$n.'"><strong>'.$n.'</strong></a></li>';  
                                                }
                                            }
                                        }
                                        ?>
                                    </ul>
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