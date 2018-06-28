<?php 
    session_start();
    include_once "../php_conexion.php";
    include_once "../funciones.php";
    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Venta','1')==true){
        }else{
            header('Location: ../error500.php');
        }
    }else{
        header('Location: ../error500.php');
    }
    
    if(!empty($_POST['subtotal']) and !empty($_POST['neto'])){
        
        $neto=limpiar($_POST['neto']);      
        $subtotal=limpiar($_POST['subtotal']);
        $fecha=date('Y-m-d');               
        $impuesto=limpiar($_POST['impuesto']);
        $hora=date('H:i:s');                
        $cambio=limpiar($_POST['cambio']);  
        
        $usuario=$_SESSION['cod_user'];
        $id_sucursal=consultar('sucursal','username',"usu='$usuario'");
        $nom_impuesto=consultar('nom_imp','sucursal',"id='$id_sucursal'");
        $por_iva=consultar('val_imp','sucursal',"id='$id_sucursal'");
        
        $ss=mysql_query("SELECT * FROM venta_info_tmp WHERE usu='$usuario'");
        if($rr=mysql_fetch_array($ss)){
            $cod_cliente=$rr['cliente'];
            if($cod_cliente=='cliente'){
                $nom_cliente=limpiar($_POST['nombre']);
            }else{
                $nom_cliente=consultar('nom','cliente',"id='$cod_cliente'");
            }
            
        }
        
        mysql_query("INSERT INTO factura (cod_cliente,nom_cliente,pagocon,subtotal,impuesto,neto,fecha,hora,usuario,sucursal,metodopago,nom_impuesto) 
        VALUES ('$cod_cliente','$nom_cliente','0','$subtotal','$impuesto','$neto','$fecha','$hora','$usuario','$id_sucursal','','$nom_impuesto')");
        ###########3id maximo de la factura
        $ss=mysql_query("SELECT MAX(id) as id_maximo FROM factura WHERE usuario='$usuario'");
        if($rr=mysql_fetch_array($ss)){
            $id_maximo=$rr['id_maximo'];
        }
        
        
        $contado=0;$credito=0;$n=0;
        $ss=mysql_query("SELECT * FROM venta_pago_tmp WHERE usuario='$usuario'");
        while($rr=mysql_fetch_array($ss)){
            $metodopago=$rr['metodopago'];      
            $tipo=$rr['tipo'];      
            $valor=$rr['valor'];            $n++;
            //MODIFICAR AQUI PARA QUE GUARDE LOS DATOS DIFERENTES
            if($tipo=='Contado'){
                $contado=$contado+$valor;
                     mysql_query("INSERT INTO factura_pago (factura,metodopago,tipo,valor,fecha,sucursal) 
                                                    VALUES ('$id_maximo','$metodopago','$tipo','$contado','$fecha','$id_sucursal')"); 
            }elseif($tipo=='Credito'){
                $credito=$credito+$valor;
                    mysql_query("INSERT INTO factura_pago (factura,metodopago,tipo,valor,fecha,sucursal) 
                                                    VALUES ('$id_maximo','$metodopago','$tipo','$credito','$fecha','$id_sucursal')");

                mysql_query("INSERT INTO contable (concepto1,concepto2,tipo,valor,fecha,hora,usu,consultorio) 
                        VALUES ('$cod_cliente','$factura','CXC','$valor','$fecha','$hora','$usuario','$id_sucursal')");
            }
            
            #mysql_query("INSERT INTO factura_pago (factura,metodopago,tipo,valor,fecha,sucursal) 
            #VALUES ('$id_maximo','$metodopago','$tipo','$neto','$fecha','$id_sucursal')");
            
            $nmetodopago=consultar('nombre','metodopago',"id='$metodopago'");
            
            if($tipo=='Contado'){
                $valor=$valor-$cambio;
            }
        }
        
        
        
        $ss=mysql_query("SELECT * FROM venta_caja_tmp WHERE usu='$usuario'");
        while($rr=mysql_fetch_array($ss)){
            $cod=$rr['cod'];    
            $val=$rr['val'];
            $nom=$rr['nom'];    
            $cant=$rr['cant'];
            $mesa=$rr['mesa'];
            $fech_entrega=$rr['fech_entrega'];
            $fecha_in=$rr['fecha_in'];
            $h_entrega=$rr['hora'];
            $descto=$rr['descto'];
			$flete=$rr['flete'];
            $inv=consultar('inv','producto',"codigo='$cod'");
            $cat=consultar('categoria','producto',"codigo='$cod'");
            if(consultar('iva','producto',"codigo='".$rr['cod']."'")=='n'){
                $valor_iva=0;
            }else{
                $valor_iva=($rr['val']*$rr['cant'])*(($por_iva/100));
            }
            
            mysql_query("INSERT INTO factura_detalle (factura,cod,nom,cant,inv,iva,val,cat,fecha,hora,sucursal,descto,flete) 
            VALUES ('$id_maximo','$cod','$nom','$cant','$inv','$valor_iva','$val','$cat','$fecha','$hora','$id_sucursal','$descto','$flete')");
            
            if($inv=='s'){
                #prodctos
                mysql_query("UPDATE contenido SET cant=cant-$cant WHERE sucursal='$id_sucursal' and producto='$cod'");
            }else{
                #insumos
                $s1=mysql_query("SELECT * FROM prod_insumo WHERE producto='$cod'");
                while($r1=mysql_fetch_array($s1)){
                    $insumo_cod=$r1['insumo'];
                    $insumo_cant=$r1['cant'];
                    mysql_query("UPDATE insumo_contenido SET contenido=contenido-$insumo_cant 
                    WHERE insumo='$insumo_cod' and sucursal='$id_sucursal'");
                }

            }
             mysql_query("UPDATE producto SET status='OCUPADA', cliente_tmp='$nom_cliente', fech_entrega='$fech_entrega', fecha_in='$fecha_in',hora='$h_entrega' WHERE id='$cod'");
        }
        if($mesa=='no'){
            mysql_query("INSERT INTO comandas (factura,estado,sucursal) VALUES ('$id_maximo','PENDIENTE','$id_sucursal')");
        }
        mysql_query("DELETE FROM venta_caja_tmp WHERE usu='$usuario'");
        mysql_query("DELETE FROM venta_info_tmp WHERE usu='$usuario'");
        mysql_query("DELETE FROM venta_pago_tmp WHERE usuario='$usuario'");
        header('Location: proceso.php?i='.claves($id_maximo));
    }
    if(!empty($_GET['i'])){
        $id_factura=get(limpiar($_GET['i']),'factura','id');
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

        <title>Proceso</title>

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
                                <h3 class="panel-title">Proceso de Facturacion Terminado</h3>                                
                            </div>
                            <div class="panel-body" align="center">
                                <a href="ticket.php?i=<?php echo claves($id_factura); ?>" target="_blank" class="btn btn-danger waves-effect waves-light btn-lg m-b-5"><i class="fa fa-print m-r-5"></i> <strong>Imprimir Ticket </strong></a><br><br>
								<a href="factura.php?i=<?php echo claves($id_factura); ?>" target="_blank" class="btn btn-success waves-effect waves-light btn-lg m-b-5"><i class="fa fa-print m-r-5"></i> <strong>Imprimir Factura </strong></a><br><br>
                            <!--<a href="admin.php?x=sin" class="btn btn-purple waves-effect waves-light btn-lg m-b-5"><i class="fa fa-shopping-basket m-r-5"></i> <strong>Realizar Mas Ventas Contado</strong></a><br><br>
                                <a href="index.php" class="btn btn-success waves-effect waves-light btn-lg m-b-5"><i class="fa fa-user m-r-5"></i> <strong>Realizar Mas Ventas Clientes</strong></a>-->                                                                                                                      
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

        <!-- Custom main Js -->
        <script src="../../assets/js/jquery.core.js"></script>
        <script src="../../assets/js/jquery.app.js"></script>


    </body>
</html>