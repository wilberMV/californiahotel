<?php 
session_start();
    include_once "../php_conexion.php";
    include_once "../funciones.php";
    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Venta','1')==true){
        }else{
header('Location:../error500.php');
        }
    }else{
header('Location:../error500.php');
    }
    $usuario=$_SESSION['cod_user'];
    if(!empty($_GET['x'])){
        mysql_query("DELETE FROM venta_info_tmp WHERE usu='$usuario'");
        mysql_query("DELETE FROM venta_caja_tmp WHERE usu='$usuario'");
        mysql_query("INSERT INTO venta_info_tmp (usu,cliente) VALUES ('$usuario','cliente')");
        header('Location:admin.php');
    }else{
        if(!empty($_GET['i'])){
            $id_cliente=get(limpiar($_GET['i']),'cliente','id');
            mysql_query("DELETE FROM venta_info_tmp WHERE usu='$usuario'");
            mysql_query("DELETE FROM venta_caja_tmp WHERE usu='$usuario' and mesa=''");
            mysql_query("INSERT INTO venta_info_tmp (usu,cliente) VALUES ('$usuario','$id_cliente')");
            header('Location:admin.php');
        }else{
            $ss=mysql_query("SELECT * FROM venta_info_tmp WHERE usu='$usuario'");
            if($tmp=mysql_fetch_array($ss)){
            }else{
header('Location:index.php');  
            }
            if(!empty($_GET['c'])){
                $id_categoria=get(limpiar($_GET['c']),'confi','id');
                if(!empty($_GET['p'])){
                    $cod=get(limpiar($_GET['p']),'producto','id');
                    $nom=consultar('nombre','producto',"id='$cod'");
                    $val=consultar('valor','producto',"id='$cod'");
                    $control=consultar('control','producto',"id='$cod'");
                    $d='0';
                    $f='0';

                    $ss=mysql_query("SELECT id FROM venta_caja_tmp WHERE cod='$cod' and usu='$usuario'");
                    if($rr=mysql_fetch_array($ss)){
                        if ($control == 's') {
                            # code...
                        }
                        else{
                           mysql_query("UPDATE venta_caja_tmp SET cant=cant+1 WHERE cod='$cod' and usu='$usuario'"); 
                        }
                    }else{
                        if ($control == 's') {
                            mysql_query("INSERT INTO venta_caja_tmp (cod,nom,cant,val,usu,control,descto,flete) VALUES ('$cod','$nom','0','$val','$usuario','$control','$d','$f')");
                        }
                        else{
                        mysql_query("INSERT INTO venta_caja_tmp (cod,nom,cant,val,usu,control,descto,flete) VALUES ('$cod','$nom','1','$val','$usuario','$control','$d','$f')");
                    }
                    }
header('Location:admin.php?c='.claves($id_categoria)); 
                }
            }else{
                $id_categoria='';   
            }
        }
    }    
    if(!empty($_GET['remove'])){
        $id_remove=get(limpiar($_GET['remove']),'venta_caja_tmp','id');
        mysql_query("DELETE FROM venta_caja_tmp WHERE id='$id_remove'");
        if(!empty($_GET['c'])){
            header('Location:admin.php?c='.limpiar($_GET['c']));   
        }else{
            header('Location:admin.php');  
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

        <title>Pos</title>
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
                    <div class="col-lg-5">
                        <div class="panel panel-purple panel-border">
                            <div class="panel-heading" align="center">
                                <h3 class="panel-title">TIPO DE SERVICIO</h3>                              
                            </div>
                            <div class="panel-body">
                                <table class="table">
                                    <?php 
                                        $ss=mysql_query("SELECT * FROM confi WHERE tabla='categoria' ORDER BY nombre");
                                        while($rr=mysql_fetch_array($ss)){
                                            if($id_categoria==$rr[0]){
                                                $class='btn-warning';
                                            }else{
                                                $class='btn-default';
                                            }
                                    ?>
                                <tr>
                                    <td align="center"><a href="admin.php?c=<?php echo claves($rr[0]); ?>" class="btn btn-block btn-lg  waves-effect waves-light <?php echo $class; ?>" style="width:90%">
                                    <strong><?php echo $rr['nombre']; ?></strong></a></a></td>
                                </tr>
                                <?php } ?>
                            </table>
                            <div class="table-responsive">
                            <?php 
                                  if(!empty($_POST['fechai'])){
                                        $ncodigo=limpiar($_POST['ncodigo']);
                                        $fechai=limpiar($_POST['fechai']);
                                        $fechaf=limpiar($_POST['fechaf']);

                                        $segundos=strtotime($fechaf) - strtotime($fechai);
                                        $diferencia_dias=intval($segundos/60/60/24);
                                        echo mensajes("La cantidad de días es <b>".$diferencia_dias."</b>","rojo");

                                        mysql_query("UPDATE venta_caja_tmp SET cant='$diferencia_dias', fecha_in='$fechai', fech_entrega='$fechaf' WHERE cod='$ncodigo'");
                                        
                                    }
                                    elseif(!empty($_POST['new_cant'])){ 
                                            $ncod=limpiar($_POST['ncod']);
                                            $new_cant=limpiar($_POST['new_cant']);
                                            $fechaf=limpiar($_POST['fechaf']);
                                            $fecha=date('Y-m-d');
											$hora=limpiar($_POST['hora']);
											
                                       
                                        mysql_query("UPDATE venta_caja_tmp SET cant='$new_cant',fecha_in='$fecha', fech_entrega='$fechaf',hora='$hora' WHERE cod='$ncod'");
                                        }

                                        elseif(!empty($_POST['new_des'])){ 
                                            $dcod=limpiar($_POST['dcod']);
                                            $new_des=limpiar($_POST['new_des']);
                                       
                                        mysql_query("UPDATE venta_caja_tmp SET descto='$new_des' WHERE cod='$dcod'");
                                        }

                                        elseif(!empty($_POST['new_fle'])){ 
                                            $fcod=limpiar($_POST['fcod']);
                                            $new_fle=limpiar($_POST['new_fle']);
                                       
                                        mysql_query("UPDATE venta_caja_tmp SET flete='$new_fle' WHERE cod='$fcod'");
                                        }
                                         elseif(!empty($_POST['cant'])){ 
                                            $ccod=limpiar($_POST['ccod']);
                                            $cant=limpiar($_POST['cant']);
                                       
                                        mysql_query("UPDATE venta_caja_tmp SET cant='$cant' WHERE cod='$ccod'");
                                        }
                                 
                                    ?>
                                  <table class="table m-0" style="font-size:11px;">
                                            <tr>
                                                <td colspan="7"><strong><center>INFORMACION DE LA VENTA</center></strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Producto</strong></td>
                                                <td align="center"><strong>P.U</div></strong></td>
                                                <td align="center"><strong>Cant</strong></td>
                                                <td align="center"><strong>%</strong></td>
                                                <td align="center"><strong>Fle</strong></td>
                                                <td align="center"><strong>Total</strong></td>
                                                <td width="5%"></td>
                                            </tr>
                                            <?php 
                                                $subtotal=0;
                                                $ss=mysql_query("SELECT * FROM venta_caja_tmp WHERE usu='$usuario'");
                                                while($rr=mysql_fetch_array($ss)){
                                                    $descuento=$rr['descto'];
                                                    $tdes=$rr['cant']*$rr['val']*$descuento/100;
                                                    $importe=$rr['cant']*$rr['val']-$tdes+$rr['flete'];
                                                    $subtotal=$subtotal+$importe;
                                                    $cod=claves($rr[0]);
                                                    $canti=$rr['cant'];
                                                    if ($rr['control'] == 's') {
                                                                $boton='<a href="#fecha'.$cod.'" class="btn btn-success btn-xs waves-effect waves-light" role="button" data-toggle="modal"><i class="fa fa-calendar"></i> '.$canti.'</a>';
                                                            }
                                                     elseif ($rr['control'] == 'c') {
                                                                $boton='<a href="#cant'.$cod.'" class="btn btn-danger btn-xs waves-effect waves-light" role="button" data-toggle="modal"><i class="fa fa-dashboard"></i> '.$canti.'</a>';
                                                            }
                                                    else {
                                                        $boton='<a href="#fechax'.$cod.'" class="btn btn-primary btn-xs waves-effect waves-light" role="button" data-toggle="modal"><i class="fa fa-dashboard"></i> '.$canti.'</a>';
                                                    }
                                            ?>
                                            <tr>
                                                <td><?php echo $rr['nom']; ?></td>
                                                <td><div align="right"><?php echo $s.formato($rr['val']); ?></div></td>
                                                <td>
                                                    <center>
                                                    <?php echo $boton; ?>
                                                    </center>
                                                </td>
                                                <td><div align="center"><a href="#des<?php echo claves($rr[0]); ?>" class="btn btn-default btn-xs waves-effect waves-light" role="button" data-toggle="modal"><?php echo $rr['descto']; ?></a></div></td>
                                                <td><div align="center"><a href="#fle<?php echo claves($rr[0]); ?>" class="btn btn-default btn-xs waves-effect waves-light" role="button" data-toggle="modal"><?php echo $rr['flete']; ?></a></div></td>
                                                <td><div align="right"><?php echo $s.formato($importe); ?></div></td>
                                                <td align="center">
                                                    
                                                        <?php 
                                                            if(!empty($_GET['c'])){ 
                                                                $url='&c='.limpiar($_GET['c']);
                                                            }else{
                                                                $url='';
                                                            }
                                                        ?>
                                                        <a href="admin.php?remove=<?php echo claves($rr[0]).$url; ?>" class="btn btn-icon btn-xs waves-effect waves-light btn-danger m-b-5"><i class="fa fa-remove"></i></a>
                                                  
                                                </td>
                                            </tr>
                                            <div id="fecha<?php echo claves($rr[0]); ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <form action="" name="form1" method="post">
                                            <input type="hidden" name="ncodigo" value="<?php echo $rr['cod']; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" align="center">Check in</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                               <div class="row" align="center">                                       
                                                               <!--<div class="col-md-12" >                                         
                                                                <strong>Dias</strong><br>
                                                                <input type="number" class="form-control" name="new_cant" min="1" value="<?php echo $rr['cant'] ?>" autocomplete="off" required>
                                                                </div>-->
                                                                <div class="col-md-4" >                                         
                                                                <strong>Fecha Inicial</strong><br>
                                                                <input type="date" class="form-control" name="fechai" value="<?php echo $rr['fecha_in'] ?>" autocomplete="off" required>
                                                                </div>
                                                                <div class="col-md-4" >                                         
                                                                <strong>Fecha de Entrega</strong><br>
                                                                <input type="date" class="form-control" name="fechaf" value="<?php echo $rr['fech_entrega'] ?>" autocomplete="off" required>
                                                                </div>
                                                                <div class="col-md-4" >                                         
                                                                <strong>Hora de Entrega</strong><br>
                                                                <input type="time" class="form-control" name="hora" value="<?php echo $rr['hora'] ?>" autocomplete="off" required>
                                                                </div>                                                                                                                                                                                                                                                                                                                                                                                                                                 
                                                            </div>                          
                                                                                                                            
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-info waves-effect waves-light">Proceder</button>
                                                            </div>                                  
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div><!-- /.modal -->
                                                 <div id="fechax<?php echo claves($rr[0]); ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <form action="" name="form1" method="post">
                                                    <input type="hidden" name="ncod" value="<?php echo $rr['cod']; ?>">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        <h4 class="modal-title" align="center">Modificar Cantidad</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                       <div class="row" align="center">
                                                                       <div class="col-md-4" >                                         
                                                                         <label>Horas</label>
                                                                        <input type="number" class="form-control" name="new_cant" min="1" value="<?php echo $rr['cant'] ?>" autocomplete="off" required>
                                                                        </div>
                                                                        <div class="col-md-4" >                                         
                                                                         <label>Fecha Entrega</label>
                                                                        <input type="date" class="form-control" name="fechaf" value="<?php echo $rr['fech_entrega'] ?>" autocomplete="off" required>
                                                                        </div>
																		<div class="col-md-4" >
                                                                        <label>Hora Entrega</label>
                                                                        <input type="time" class="form-control" name="hora" value="<?php echo $rr['hora'] ?>" autocomplete="off" required>
                                                                        <!--<label>Hora Entrega</label>
																		  <div class="input-group m-b-15">
                                                                            <div class="bootstrap-timepicker">
                                                                                <input id="timepicker2" type="text" class="form-control" name="hora">
                                                                            </div>
                                                                            <span class="input-group-addon bg-primary b-0 text-white"><i class="glyphicon glyphicon-time"></i></span>
                                                                        </div>-->
                                                                        <!-- input-group -->
																		</div>
                                                                        <div class="col-md-4" >                                         
                                                                        <input type="hidden" class="form-control" name="fecha" value="">
                                                                        </div>                                                                                                                                                                                                                                                                                                                                                                                                                                 
                                                                    </div>                          
                                                                                                                                    
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                                                        <button type="submit" class="btn btn-info waves-effect waves-light">Proceder</button>
                                                                    </div>                                  
                                                                </div>
                                                            </div>
                                                            </form>
                                                    </div><!-- /.modal --> 
                                                    <div id="des<?php echo claves($rr[0]); ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <form action="" name="form1" method="post">
                                                    <input type="hidden" name="dcod" value="<?php echo $rr['cod']; ?>">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        <h4 class="modal-title" align="center">Descuento [ <?php echo $rr['nom']; ?> ]</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                       <div class="row" align="center">
                                                                       <div class="col-md-4" >                                         
                                                                        
                                                                        </div>                                                       
                                                                       <div class="col-md-4" >                                         
                                                                        <strong>Descuento</strong><br>
                                                                        <input type="number" class="form-control" name="new_des" min="1" value="<?php echo $rr['descto'] ?>" autocomplete="off" required>
                                                                        </div>
                                                                        <div class="col-md-4" >                                         
                                                                        
                                                                        </div>                                                                                                                                                                                                                                                                                                                                                                                                                                 
                                                                    </div>                          
                                                                                                                                    
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                                                        <button type="submit" class="btn btn-info waves-effect waves-light">Proceder</button>
                                                                    </div>                                  
                                                                </div>
                                                            </div>
                                                            </form>
                                                    </div><!-- /.modal -->
                                                        <div id="fle<?php echo claves($rr[0]); ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <form action="" name="form1" method="post">
                                                    <input type="hidden" name="fcod" value="<?php echo $rr['cod']; ?>">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        <h4 class="modal-title" align="center">Fletes [ <?php echo $rr['nom']; ?> ]</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                       <div class="row" align="center">
                                                                       <div class="col-md-4" >                                         
                                                                        
                                                                        </div>                                                       
                                                                       <div class="col-md-4" >                                         
                                                                        <strong>Cantidad</strong><br>
                                                                        <input type="number" class="form-control" name="new_fle" min="1" value="<?php echo $rr['flete'] ?>" autocomplete="off" required>
                                                                        </div>
                                                                        <div class="col-md-4" >                                         
                                                                        
                                                                        </div>                                                                                                                                                                                                                                                                                                                                                                                                                                 
                                                                    </div>                          
                                                                                                                                    
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                                                        <button type="submit" class="btn btn-info waves-effect waves-light">Proceder</button>
                                                                    </div>                                  
                                                                </div>
                                                            </div>
                                                            </form>
                                                    </div><!-- /.modal -->
                                                    <div id="cant<?php echo claves($rr[0]); ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <form action="" name="form1" method="post">
                                                    <input type="hidden" name="ccod" value="<?php echo $rr['cod']; ?>">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        <h4 class="modal-title" align="center"> Servicio [ <?php echo $rr['nom']; ?> ]</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                       <div class="row" align="center">
                                                                       <div class="col-md-4" >                                         
                                                                        
                                                                        </div>                                                       
                                                                       <div class="col-md-4" >                                         
                                                                        <strong>Cantidad</strong><br>
                                                                        <input type="number" class="form-control" name="cant" min="1" value="<?php echo $rr['flete'] ?>" autocomplete="off" required>
                                                                        </div>
                                                                        <div class="col-md-4" >                                         
                                                                    </div>                          
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                                                        <button type="submit" class="btn btn-info waves-effect waves-light">Proceder</button>
                                                                    </div>                                  
                                                                </div>
                                                            </div>
                                                            </form>
                                                    </div><!-- /.modal -->          
                                            <?php } ?>
                                            <tr>
                                                <td colspan="7"><h3 class="text-success" align="right"><?php echo $s.formato($subtotal); ?></h3></td>
                                            </tr>
                                        </table>
                                        </div><br>
                                        <div class="row-fluid">
                                            <div class="span6" align="center">
                                                <?php 
                                                    if($subtotal<>0){
                                                        echo '<a href="facturar.php" style="width:80%" class="btn btn-danger waves-effect w-md waves-light m-b-5"><strong>PAGAR</strong></a>';
                                                    }
                                                ?> 
                                            </div>
                                            <div class="span6" align="center">
                                                <a href="index.php" style="width:80%" class="btn btn-default waves-effect w-md waves-light m-b-5"><strong>Cancelar</strong></a>
                                            </div>
                                        </div>  
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="panel panel-success panel-border">
                            <div class="panel-heading" align="center">
                                <h3 class="panel-title">SERVICIOS</h3>                                
                            </div>
                            <div class="panel-body">
                                  <?php if($id_categoria<>''){ ?>
                
                                    <?php 
                                        $n=0;
                                        $hab=mysql_query("SELECT * FROM producto WHERE categoria='$id_categoria' and estado='s' ORDER BY nombre");
                                        while($rr=mysql_fetch_array($hab)){
                                            
                    #                        if (file_exists('../producto/img/'.$rr['codigo'].'.jpg')){
                     #                           $img='../producto/img/'.$rr['codigo'].'.jpg';
                      #                      }else{
                       #                         $img='../producto/img/defecto.jpg';
                        #                    }
                                            if ($rr['status']=='OCUPADA' and $rr['control']=='s') {
                                                $boton='<a href="#" class="btn btn-block btn-lg btn btn-danger waves-effect w-md waves-light m-b-5">
                                                            <strong>'.$rr['nombre'].'<br> OCUPADA</strong></a>';
                                            }
                                            ################ este se Modifico en el archivo php Facturar ###########
                                            if ($rr['status']=='OCUPADA' and $rr['control']=='n') {
                                                $boton='<a href="#" class="btn btn-block btn-lg btn btn-danger waves-effect w-md waves-light m-b-5">
                                                            <strong>'.$rr['nombre'].'<br> OCUPADA</strong></a>';
                                            }
                                           elseif ($rr['status']=='OCUPADA' and $rr['control']=='c'){
                                                $boton='<a href="admin.php?c='.claves($id_categoria).'&p='.claves($rr['id']).'" class="btn btn-block btn-lg btn btn-purple waves-effect w-md waves-light m-b-5">
                                                            <strong>'.$rr['nombre'].'<br>'.$s.formato($rr['valor']).'</strong></a>';
                                            }
                                           
                                             elseif ($rr['status']=='' and $rr['control']=='s'){
                                                $boton='<a href="admin.php?c='.claves($id_categoria).'&p='.claves($rr['id']).'" class="btn btn-block btn-lg btn btn-success waves-effect w-md waves-light m-b-5">
                                                            <strong>'.$rr['nombre'].'<br>'.$s.formato($rr['valor']).'</strong></a>';
                                            }
                                            elseif ($rr['status']=='' and $rr['control']=='n'){
                                                $boton='<a href="admin.php?c='.claves($id_categoria).'&p='.claves($rr['id']).'" class="btn btn-block btn-lg btn btn-purple waves-effect w-md waves-light m-b-5">
                                                            <strong>'.$rr['nombre'].'<br>'.$s.formato($rr['valor']).'</strong></a>';
                                            }
                                            elseif ($rr['status']=='' and $rr['control']=='c'){
                                                $boton='<a href="admin.php?c='.claves($id_categoria).'&p='.claves($rr['id']).'" class="btn btn-block btn-lg btn btn-purple waves-effect w-md waves-light m-b-5">
                                                            <strong>'.$rr['nombre'].'<br>'.$s.formato($rr['valor']).'</strong></a>';
                                            }
                                            $n++;
                                            echo '  <div style="float:left;width:33%">
                                                        <table class="table m-0">
                                                        <tr>
                                                            <td align="center">
                                                            '.$boton.'
                                                            </td>
                                                        </tr>
                                                        </table>
                                                       
                                                    </div>';
                                                    
                                            if($n==3){  $n=0;   echo '<br>';    }
                                        }
                                    ?>
                                    <?php }else{ echo mensajes("Seleccione alguna categoria para visualizar Habitación","azul"); } ?>                               
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
		
		<!-- CALENDARIO SCRIPTS -->
		<script src="../../assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>

        <!-- Custom main Js -->
        <script src="../../assets/js/jquery.core.js"></script>
        <script src="../../assets/js/jquery.app.js"></script>

         <script>
                  // Time Picker
                jQuery('#timepicker').timepicker({
                    defaultTIme : false
                });
                jQuery('#timepicker2').timepicker({
                    showMeridian : false
                });
                jQuery('#timepicker3').timepicker({
                    minuteStep : 15
                });               

            </script>

    </body>
</html>