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
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Cliente','1')==true){
                                            echo '  <li><a tabindex="-1" href="../cliente/consultar.php">Administrar Cliente</a></li>';                                           
                                        }                                       
                                    ?>
                            </ul>
                        </li>

                       <li class="has-submenu">
                            <a href="#"><i class="md md-people"></i>Proveedores</a>
                            <ul class="submenu">
                                <?php 
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Proveedor','1')==true){
                                            echo '  <li><a tabindex="-1" href="../proveedor/consultar.php">Administrar Proveedores</a></li>';
                                        }                                   
                                    ?>                               
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="md md-markunread-mailbox"></i>Habitaciones</a>
                            <ul class="submenu">                       
                                <?php 
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Productos','1')==true){
                                            echo '  <li><a tabindex="-1" href="../habitacion/consultar.php">Administrar Habitaciones</a></li>';                      
                                        }
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Productos','5')==true){
                                            echo '  <li><a tabindex="-1" href="../habitacion/existencia.php">Administrar Existencias de Productos</a></li>';
                                        }
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Compras','1')==true){
                                            echo '  <li><a tabindex="-1" href="../compra/index.php">Realizar Compras</a></li>';
                                        }
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Productos','3')==true){
                                            echo '  <li class="divider"></li>';
                                            echo '  <li><a tabindex="-1" href="../habitacion/insumo.php">Administrar Insumos</a></li>';
                                        }
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Productos','6')==true){
                                            echo '  <li><a tabindex="-1" href="../habitacion/insumo_existencia.php">
                                            Administrar Existencias de Insumos</a></li>';
                                        }
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Productos','2')==true){
                                            echo '  <li class="divider"></li>
                                                    <li><a tabindex="-1" href="../habitacion/categoria.php">Administrar Categorias</a></li>';
                                        }                                       
                                    ?>                                
                            </ul>
                        </li>

                         <li class="has-submenu">
                        <a href="#"><i class="md  md-storage"></i> Informes</a>
                        <ul class="submenu">
                            <?php 
                                if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Reportes','1')==true){
                                    echo '  <li><a tabindex="-1" href="../contable/index.php">Cierre de Caja</a></li>';
                                    echo '  <li><a tabindex="-1" href="../contable/cierre.php">Cierre de Caja x Horarios</a></li>';
                                }                                      
                                if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Venta','2')==true){
                                    echo '  <li><a tabindex="-1" href="../venta/consultar.php">Consultar Facturas</a></li>';
                                }
                                if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Sistema','3')==true){
                                    echo '  <li><a tabindex="-1" href="../anula/">Consultar Facturas Anuladas</a></li>';
                                }
                                
                            ?>
                            <li class="has-submenu">
                                    <a href="#">Productos</a>
                                    <ul class="submenu">                           
                                        <?php 
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Sistema','3')==true){
                                           
                                            echo '  <li><a tabindex="-1" href="../reportes/cat.php">Productos por Categoria</a></li>';          
                                        }
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Sistema','3')==true){
                                            echo '  <li class="divider"></li>
                                                    <li><a tabindex="-1" href="../reportes/dep.php">Productos por Sucursal</a></li>';
                                        }
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Sistema','3')==true){
                                            echo '  <li><a tabindex="-1" href="../reportes/venta_dia.php">Venta de Productos por Fecha</a></li>';
                                        }
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Sistema','3')==true){
                                           echo '  <li><a tabindex="-1" href="../reportes/venta_gen.php"> Venta Genral de Productos</a></li>';
                                        }
                                        
                                    ?>
                                    </ul>
                                </li>
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
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Usuarios','3')==true){
                                            echo '  <li class="divider"></li>
                                                    <li><a tabindex="-1" href="../usuario/cargo.php">Administrar Cargos y Sus Permisos</a></li>';
                                        }
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Usuarios','4')==true){
                                            echo '  <li><a tabindex="-1" href="../usuario/cambiar_contra.php">Administrar Contraseñas</a></li>';
                                        }
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Usuarios','5')==true){
                                           echo '  <li><a tabindex="-1" href="../venta/apertura.php">Realizar Apertura de Caja</a></li>';
                                        }
                                        
                                    ?>
                                    </ul>
                                </li>

                                <li class="has-submenu">
                                    <a href="#">Sucursales</a>
                                    <ul class="submenu">                                        
                                        <?php 
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Sucursal','1')==true){
                                            echo '  <li><a tabindex="-1" href="../sucursal/consultar.php">Administrar Sucursales</a></li>';
                                            
                                        }
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Sucursal','2')==true){
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
                                        <a href="#"><i class="md md-add-shopping-cart"></i>Recepción</a>
                                        <ul class="submenu">
                                            <li><a href="../venta/admin.php?x=sin"> Contado</a></li>                               
                                            <li><a href="../venta/"> Crédito</a></li>                               
                                        </ul>
                                    </li>';
                        }
                       ?>
                    </ul>
                    <!-- End navigation menu -->
                </div>
            </div>
            </div>