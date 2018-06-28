<?php 
	session_start();
	include_once "../php_conexion.php";
	include_once "../funciones.php";
	if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
		if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Venta','1')==true){
		}else{
			header('Location: ../error.php');
		}
	}else{
		header('Location: ../error.php');
	}
	
	if(!empty($_POST['subtotal']) and !empty($_POST['neto'])){
		
		$neto=limpiar($_POST['neto']);		$subtotal=limpiar($_POST['subtotal']);
		$fecha=date('Y-m-d');				$impuesto=limpiar($_POST['impuesto']);
		$hora=date('H:i:s');				$cambio=limpiar($_POST['cambio']);	
		
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
		VALUES ('$cod_cliente','$nom_cliente','0','$subtotal','$impuesto','$neto','$fecha','$hora','$usuario','$id_sucursal','$mmetodopago','$nom_impuesto')");
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
			$valor=$rr['valor'];			$n++;
			
			if($tipo=='Contado'){
				$contado=$contado+$valor;
			}elseif($tipo=='Credito'){
				$credito=$credito+$valor;
			}
			
			mysql_query("INSERT INTO factura_pago (factura,metodopago,tipo,valor) 
			VALUES ('$id_maximo','$metodopago','$tipo','$valor')");
			
			$nmetodopago=consultar('nombre','metodopago',"id='$metodopago'");
			
			if($tipo=='Contado'){
				$valor=$valor-$cambio;
			}
		}
		
		
		
		mysql_query("INSERT INTO comandas (factura,estado,sucursal) VALUES ('$id_maximo','PENDIENTE','$id_sucursal')");
		
		$ss=mysql_query("SELECT * FROM venta_caja_tmp WHERE usu='$usuario'");
		while($rr=mysql_fetch_array($ss)){
			$cod=$rr['cod'];	$val=$rr['val'];
			$nom=$rr['nom'];	$cant=$rr['cant'];
			$inv=consultar('inv','producto',"codigo='$cod'");
			$cat=consultar('categoria','producto',"codigo='$cod'");
			if(consultar('iva','producto',"codigo='".$rr['cod']."'")=='n'){
				$valor_iva=0;
			}else{
				$valor_iva=($rr['val']*$rr['cant'])*(($por_iva/100));
			}
			
			mysql_query("INSERT INTO factura_detalle (factura,cod,nom,cant,inv,iva,val,cat) 
			VALUES ('$id_maximo','$cod','$nom','$cant','$inv','$valor_iva','$val','$cat')");
			
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