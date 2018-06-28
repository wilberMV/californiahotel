<?php 
    include_once ("funciones.php");   
?>
<!-- Navbar Start -->
            <div class="navbar-custom">
                <div class="container">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
                        <li class="has-submenu active">
                            <a href="../principal/"><i class="md md-dashboard"></i>Inicio</a>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="md md-person"></i>Clientes</a>
                            <ul class="submenu">
                                <?php 
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Clientes','1')==true){
                                            echo '  <li><a tabindex="-1" href="../cliente/consultar.php">Administrar Cliente</a></li>';                                           
                                        }                                       
                                    ?>
                                    
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="md md-markunread-mailbox"></i> Servicios </a>
                            <ul class="submenu">                       
                                <?php 
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Servicios','1')==true){
                                            echo '  <li><a tabindex="-1" href="../servicios/consultar.php">Administrar Servicios</a></li>';                      
                                        }
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Servicios','2')==true){
                                            echo '  <li><a tabindex="-1" href="../servicios/control.php">Control de Servicios</a></li>';
                                        }
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Servicios','3')==true){
                                            echo '  <li class="divider"></li>
                                                    <li><a tabindex="-1" href="../servicios/categoria.php">Administrar Categorias</a></li>';
                                        }                                       
                                    ?>                                
                            </ul>
                        </li>

                         <li class="has-submenu">
                        <a href="#"><i class="md  md-storage"></i> Informes</a>
                        <ul class="submenu">
                            <?php 
                                                               
                                if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Informe','1')==true){
                                    echo '  <li><a tabindex="-1" href="../venta/consultar.php">Consultar Facturas</a></li>';
                                }
                                 if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Informe','2')==true){
                                    echo '  <li><a tabindex="-1" href="../reportes/financiero.php">Reporte Financiero</a></li>';
                                }
                                if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Informe','3')==true){
                                    echo '  <li><a tabindex="-1" href="../reportes/reporte_cliente.php">Reporte de Clientes</a></li>';
                                }
                                 if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Informe','4')==true){
                                    echo '  <li><a tabindex="-1" href="../reportes/reporte_servicios.php">Reporte de Servicios</a></li>';
                                }
								if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Informe','5')==true){
                                    echo '  <li><a tabindex="-1" href="../reportes/reporte_tipodepago.php">Reporte de Tipo de Pago</a></li>';
                                }
                            ?>
                        </ul>
                    </li>

                        <li class="has-submenu">
                            <a href="#"><i class="md md-settings"></i>Administración</a>
                            <ul class="submenu">
                                <li class="has-submenu">
                                    <a href="#">Usuarios</a>
                                   <ul class="submenu">                           
                                        <?php 
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Usuarios','1')==true){
                                           
                                            echo '  <li><a tabindex="-1" href="../usuario/consultar.php">Administrar Usuarios</a></li>';          
                                        }
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Usuarios','2')==true){
                                            echo '  <li><a tabindex="-1" href="../usuario/cambiar_contra.php">Administrar Contraseñas</a></li>';
                                        }
                                       
                                    ?>
                                    </ul>
                                </li>

                                <li class="has-submenu">
                                    <a href="#">Sucursales</a>
                                    <ul class="submenu">                                        
                                        <?php 
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Sucursales','1')==true){
                                            echo '  <li><a tabindex="-1" href="../sucursal/consultar.php">Administrar Sucursales</a></li>';
                                            
                                        }
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Sucursales','2')==true){
                                            echo '  <li class="divider"></li>
                                                    <li><a tabindex="-1" href="../sucursal/imagen.php">Imagen de Presentacion</a></li>';
                                        }                                       
                                    ?>                            
                                    </ul>
                                </li>
                                                      
                            </ul>
                        </li>                       
                        <?php                        
                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Venta','1')==true){
                            echo '  <li class="has-submenu">
                                        <a href="#"><i class="md md-add-shopping-cart"></i>Facturación</a>
                                        <ul class="submenu">
                                           <!--<li><a href="../venta/admin.php?x=sin">Cliente sin Registro</a></li> -->                           
                                            <li><a href="../venta/">Facturar Cliente</a></li>                               
                                        </ul>
                                    </li>';
                        }
                       ?>
                    </ul>
                    <!-- End navigation menu -->
                </div>
            </div>
            </div>