<?php 
    session_start();
    include_once "modulos/php_conexion.php";
    include_once "modulos/funciones.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>LOGIN</title>

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/core.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/components.css" rel="stylesheet" type="text/css">
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css">
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css">
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">

        <script src="assets/js/modernizr.min.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        
    </head>
    <body>


        <div class="wrapper-page">
            <div class="text-center">
                <a href="index.php"  class="logo logo-lg"><center><img src="img/hotelc.png" width="260" height="200"> </a>               
            </div>

            <form class="form-horizontal m-t-20"  method="post" action="">
                    <?php 
                        if(!empty($_POST['usu']) and !empty($_POST['con'])){ 
                            $usu=limpiar($_POST['usu']);    
                            $con=limpiar($_POST['con']);
                            $con=claves($con);
                            
                            
                            $pa=mysql_query("SELECT * FROM username WHERE usu='$usu' and con='$con'");  
                            if($row=mysql_fetch_array($pa)){
                                if($row['estado']=='s'){
                                    $_SESSION['tipo_user']=$row['tipo'];
                                    $_SESSION['cod_user']=$usu;
                                    $_SESSION['seguridad'.$usu]=claves($usu);
                                    $_SESSION['desc'.$usu]=0;
                                    
                                    if($row['tipo']=='a' or $row['tipo']=='u'){
                                        $nombre=consultar('nom','persona',"cod='".$usu."'");
                                        $nombre=explode(" ", $nombre);
                                        $nombre=$nombre[0];
                                        $_SESSION['user_name']=$nombre;
                                        echo '<div class="alert alert-success" align="center"><strong>Bienvenido<br>'.consultar('nom','persona',"cod='".$usu."'").'<br>
                                        '.consultar('nom','sucursal'," id='".$row['sucursal']."'").'</strong></div>';
                                        echo '<center><img src="img/ajax-loader.gif"></center><br>';
                                        echo '<meta http-equiv="refresh" content="2;url=modulos/principal">';
                                    }elseif($row['tipo']=='c'){
                                        $nombre=consultar('nombre','cliente',"codigo='".$usu."'");
                                        $nombre=explode(" ", $nombre);
                                        $nombre=$nombre[0];
                                        $_SESSION['user_name']=$nombre;
                                        echo '<div class="alert alert-success" align="center"><strong>Bienvenido
                                        <br>'.consultar('nombre','cliente',"codigo='".$usu."'").'<br></div>';
                                        echo '<center><img src="img/ajax-loader.gif"></center><br>';
                                        echo '<meta http-equiv="refresh" content="2;url=modulos/modtienda">';
                                    }
                                }else{
                                    echo '<div class="alert alert-warning">
                                        <strong>Ojo!</strong> Usted no se encuentra Activo en la base de datos<br>Consulte con su Administrador de Sistema.
                                       </div>';                     
                                    echo '<center><a href="index.php" class="btn btn-danger btn-custom w-md waves-effect waves-light"><strong>Intentar de Nuevo</strong></a></center>'; 
                                }
                            }else{
                                echo   '<div class="alert alert-danger">
                                        <strong>Ojo!</strong> Usuario y Contraseña Incorrecto.
                                       </div>';
                                echo '<center><a href="index.php" class="btn btn-danger btn-custom w-md waves-effect waves-light"><strong>Intentar de Nuevo</strong></a></center>';
                            }
                        }else{
                            echo '  
                                  <div class="form-group">
                                    <div class="col-xs-12">
                                        <input class="form-control" type="text" name="usu" required autocomplete="off" placeholder="Documento" autofocus>                                    
                                        <i class="md md-account-circle form-control-feedback l-h-34"></i>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input class="form-control" type="password" name="con" required autocomplete="off" placeholder="Password">
                                        <i class="md md-vpn-key form-control-feedback l-h-34"></i>
                                    </div>
                                </div>
                                <div class="form-group text-right m-t-20">
                                    <div class="col-xs-12">
                                        <button class="btn btn-primary btn-custom w-md waves-effect waves-light" type="submit">Ingresar
                                        </button>
                                    </div>
                                </div>';                                                                    
                        }
                      ?>
              
            </form>
        </div>

        
    	<script>
            var resizefunc = [];
        </script>

        <!-- Main  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- Custom main Js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
	
	</body>
</html>