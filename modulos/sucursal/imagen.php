<?php 
    session_start();
    include_once "../php_conexion.php";
    include_once "../funciones.php";
    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Sucursales','2')==true){
        }else{
            header('Location: ../error500.php');
        }
    }else{
        header('Location: ../error500.php');
    }
    
    if(!empty($_GET['s'])){
        $id_sucursal=get(limpiar($_GET['s']),'sucursal','id');
        $clasx='btn-success';
    }else{
        $clasx='btn-warning';
        $id_sucursal='';
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

        <title>Administrar Imagenes de Presentacion</title>

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
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title" align="center"><b>Administrar Imagenes de Presentacion</b></h4>
                            <strong><center>CTRL + F5 para re cargar la pagina y ver la imagen subida en pantalla</center></strong>
                      <br>
                        <?php
                            echo '<center>';
                            $ss=mysql_query("SELECT id,nom,ciudad FROM sucursal ORDER BY nom");
                            while($rr=mysql_fetch_array($ss)){
                                if($id_sucursal==$rr[0]){
                                    $class='btn-warning';
                                }else{
                                    $class='btn-default';
                                }
                                echo '<a href="imagen.php?s='.claves($rr[0]).'" class="btn waves-effect waves-light '.$class.'"><strong>'.$rr['nom'].'</strong></a> ';
                            }
                            echo '<a href="imagen.php" class="btn waves-effect waves-light '.$clasx.'"><strong>Presentacion</strong></a> ';
                            echo '</center><br>';
                            if($id_sucursal<>''){ 
                                if(!empty($_POST['v'])){ 
                                    //subir la imagen del articulo
                                    $nameimagen = $_FILES['imagen']['name'];
                                    $tmpimagen = $_FILES['imagen']['tmp_name'];
                                    $extimagen = pathinfo($nameimagen);
                                    $ext = array("png","jpg");
                                    $urlnueva1 = "../../img/ticket".$id_sucursal.".jpg";            
                                    if(is_uploaded_file($tmpimagen)){
                                        if(array_search($extimagen['extension'],$ext)){
                                            copy($tmpimagen,$urlnueva1);    
                                            echo mensajes("Se ha Actualizado la Imagen del TICKET con exito","verde");      
                                        }else{
                                            echo mensajes("Error al Subir la Imagen, solo se acepta JPG","rojo");   
                                        }
                                    }else{
                                        echo mensajes("Error al Subir la Imagen, solo se acepta JPG","rojo");
                                    }
                                }
                                if(!empty($_POST['x'])){ 
                                    //subir la imagen del articulo
                                    $nameimagen = $_FILES['imagen']['name'];
                                    $tmpimagen = $_FILES['imagen']['tmp_name'];
                                    $extimagen = pathinfo($nameimagen);
                                    $ext = array("png","jpg");
                                    $urlnueva1 = "../../img/softunicorn".$id_sucursal.".png";   
                                    $urlnueva2 = "../../img/logo".$id_sucursal.".jpg";          
                                    if(is_uploaded_file($tmpimagen)){
                                        if(array_search($extimagen['extension'],$ext)){
                                            copy($tmpimagen,$urlnueva1);    
                                            copy($tmpimagen,$urlnueva2);    
                                            echo mensajes("Se ha Actualizado la Imagen de Presentacion con Exito","verde");
                                        }else{
                                            echo mensajes("Error al Subir la Imagen, solo se acepta JPG","rojo");
                                        }
                                    }else{
                                        echo mensajes("Error al Subir la Imagen, solo se acepta JPG","rojo");
                                    }
                                }
                            
                            ?>
                              </div>
                    </div>
                </div>

                  <div class="row">
                    <div class="col-lg-6">
                        <div class="card-box" align="center">
                            <h4 class="text-dark  header-title m-t-0 m-b-30">Imagen Ticket</h4>

                            <div class="widget-chart text-center">
                                <div id="sparkline1"></div>
                                <center>
                                    <img src="../../img/ticket<?php echo $id_sucursal; ?>.jpg?t<?php echo date('time'); ?>" class="img-polaroid" width="300" height="300">
                                        <br><br>
                                        <form name="gorm" action="" method="post" class="form-inline" enctype="multipart/form-data">
                                            <input type="hidden" name="v" value="si">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="file" name="imagen" id="imagen" required class="form-control">
                                                    </div>
                                                </div>
                                            </div><br>   
                                             <div class="modal-footer">
                                                 <button type="submit" class="btn btn-info waves-effect waves-light">Actualizar</button>
                                            </div>                                               
                                        </form>
                                </center>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <div class="card-box" align="center">
                            <h4 class="text-dark  header-title m-t-0 m-b-30">Imagen Logo</h4>

                            <div class="widget-chart text-center">
                                <div id="sparkline2"></div>
                                <center>
                                    <img src="../../img/softunicorn<?php echo $id_sucursal; ?>.png?t<?php echo date('time'); ?>" class="img-polaroid" width="300" height="300">
                                    <br><br>
                                        <form name="gorm" action="" method="post" class="form-inline" enctype="multipart/form-data">
                                            <input type="hidden" name="x" value="si">
                                           <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="file" name="imagen" id="imagen" required class="form-control">
                                                    </div>
                                                </div>
                                            </div><br>   
                                             <div class="modal-footer">
                                                 <button type="submit" class="btn btn-info waves-effect waves-light">Actualizar</button>
                                            </div> 
                                        </form>
                                </center>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- end row -->

               
                 <?php }else{ 
                        
                            if(!empty($_POST['x'])){ 
                                //subir la imagen del articulo
                                $nameimagen = $_FILES['imagen']['name'];
                                $tmpimagen = $_FILES['imagen']['tmp_name'];
                                $extimagen = pathinfo($nameimagen);
                                $ext = array("png","jpg");
                                $urlnueva1 = "../../img/softunicorn.png";   
                                $urlnueva2 = "../../img/logo.jpg";          
                                if(is_uploaded_file($tmpimagen)){
                                    if(array_search($extimagen['extension'],$ext)){
                                        copy($tmpimagen,$urlnueva1);    
                                        copy($tmpimagen,$urlnueva2);    
                                        echo mensajes("Se ha Actualizado la Imagen de Presentacion con Exito","verde");
                                    }else{
                                        echo mensajes("Error al Subir la Imagen, solo se acepta JPG","rojo");
                                    }
                                }else{
                                    echo mensajes("Error al Subir la Imagen, solo se acepta JPG","rojo");
                                }
                            }
                        ?>
                     <div class="row">    
                    <div class="col-lg-12">
                        <div class="card-box" align="center">
                            <h4 class="text-dark  header-title m-t-0 m-b-30">Imagen Ticket</h4>

                            <div class="widget-chart text-center">
                                <div id="sparkline1"></div>
                                <center>
                                   <img src="../../img/softunicorn.png?<?php echo date('time'); ?>" class="img-polaroid" width="300" height="300">
                                        <br><br>
                                        <form name="gorm" action="" method="post" class="form-inline" enctype="multipart/form-data">
                                            <input type="hidden" name="v" value="si">
                                            <input type="hidden" name="x" value="si">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="file" name="imagen" id="imagen" required class="form-control">
                                                    </div>
                                                </div>
                                            </div><br>   
                                             <div class="modal-footer">
                                                 <button type="submit" class="btn btn-info waves-effect waves-light">Actualizar</button>
                                            </div>                                               
                                        </form>
                                </center>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- end row -->
                 <?php } ?>
   
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