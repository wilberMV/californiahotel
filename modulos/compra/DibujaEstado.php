<?php
	session_start();
	include_once('../php_conexion.php');
  
	$filtro=$_GET['filtro'];
	if($filtro!=''){
		echo '<select name="refe">';
		$sql = "SELECT * FROM $filtro ORDER BY nombre";
		$rs  = mysql_query($sql,$conexion);
		if(mysql_num_rows($rs)!=0){
			while($row=mysql_fetch_assoc($rs)){                              
				echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
			}
		}
		echo '</select>';
	}else{
		echo '<select name="subcategoria" disabled>';
		echo '	<option value="0">Seleccionar</option>';
		echo '</select>';
	}

?>


