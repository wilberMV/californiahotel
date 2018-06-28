<?php 	
	session_start();
	//Configuracion de la conexion a base de datos
	include_once('../php_conexion.php');
 	include_once('../funciones.php');
	//Variables recibidas por POST de nuestra conexión AJAX
	$codigo = $_POST['codigo'];
	$valor = $_POST['valor'];
	$usuario=$_SESSION['cod_user'];
	
	$ss=mysql_query("SELECT * FROM venta_pago_tmp WHERE usuario='$usuario' and metodopago='$codigo'");
	if($rr=mysql_fetch_array($ss)){
		mysql_query("UPDATE venta_pago_tmp SET valor='$valor' WHERE usuario='$usuario' and metodopago='$codigo'");
	}
	
 	
	
?>