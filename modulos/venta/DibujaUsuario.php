<?php
	session_start();
	include_once('../php_conexion.php');
  	include_once('../funciones.php');
		
	$filtro=$_GET['filtro'];
	
	if($filtro<>''){
		echo '<select name="usuario">';
		$ss=mysql_query("SELECT * FROM username,persona WHERE username.sucursal='$filtro' and username.usu=persona.cod ORDER BY persona.nom");
		while($rr=mysql_fetch_array($ss)){
			echo '<option value="'.$rr['usu'].'">'.$rr['nom'].'</option>';
		}
		echo '</select>';
	}else{
		echo '	<select name="usuario" disabled>
					<option value="">Seleccionar Sucursal</option>
				</select>';	
	}
?>

