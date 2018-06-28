<?php
	session_start();
	include_once('../php_conexion.php');
  	include_once('../funciones.php');
	$usuario=$_SESSION['cod_user'];
	$id_sucursal=consultar('sucursal','username',"usu='$usuario'");
	$por_iva=consultar('val_imp','sucursal',"id='$id_sucursal'");
	$nom_iva=consultar('nom_imp','sucursal',"id='$id_sucursal'");
	
	$filtro=$_GET['filtro'];
	$pago=$_GET['pago'];
	
	if($pago!=''){
		mysql_query("UPDATE venta_pago_tmp SET valor='$filtro' WHERE metodopago='$pago' and usuario='$usuario'");
	}
	
	$subtotal=0;$total_iva=0;$t_impuestos=0;$impuesto=0;
    $ss=mysql_query("SELECT * FROM venta_caja_tmp WHERE usu='$usuario'");
    while($rr=mysql_fetch_array($ss)){
                                
    if(consultar('iva','producto',"codigo='".$rr['cod']."'")=='n'){
		$valor_iva=0;
	}else{
		$valor_iva=($rr['val']*$rr['cant'])*(($por_iva/100));
	}
	$descuento=$rr['descto'];
	$tdes=$rr['cant']*$rr['val']*$descuento/100;
	$importe=$rr['val']*$rr['cant']-$tdes+$rr['flete'];
	$subtotal=$subtotal+$importe;
	$total_iva=$total_iva+$valor_iva;
	$impuesto=$subtotal*15/100;
	$t_impuestos=$total_iva+$impuesto;
	}
	$neto=$subtotal;
	
	$contado=0;$credito=0;$ncontado=0;
	$ss=mysql_query("SELECT * FROM venta_pago_tmp WHERE usuario='$usuario'");
	while($rr=mysql_fetch_array($ss)){
		if($rr['tipo']=='Contado'){
			$contado=$contado+$rr['valor'];		
			$ncontado++;
		}elseif($rr['tipo']=='Credito'){
			$credito=$credito+$rr['valor'];
		}
	}
	
	$cambio=$contado-($neto-$credito);
	$acomulado=$contado+$credito;
	$error='';
	
	if($ncontado>1 and ($neto-$credito)<$contado){
		$estado1=false;
		$error.='<br>El Valor en Efectivo es suficiente pagarlo con un solo Metodo de Pago<br>';
	}else{
		$estado1=true;
	}
	
	if($acomulado>=$neto){
		$estado_neto=true;
	}else{
		$estado_neto=false;
		 #echo mensajes('Valor Ingresado debe superar o igualar el Valor a Pagar','verde');
		$error.='<br>Valor Ingresado debe superar o igualar el Valor a Pagar<br>';
	}
	
	if($credito<=$neto){
		$estado_credito=true;
		$class_credito='text-success';
	}else{
		$estado_credito=false;
		$class_credito='text-error';
		$error.='<br>El Valor en Tarjeta no puede superar el Valor a Pagar<br>';
	}
	if(($credito==$neto and $contado<>0)){
		$estado_contado=false;
		$error.='<br>Si la Tarjeta supera el Valor a Pagar no permite Valores en Efectivo<br>';
	}else{
		$estado_contado=true;
	}
	
	echo '
		<div class="row">
            <div class="col-sm-6 col-lg-12">
              <div class="widget-simple text-center card-box bg-danger">
                <h4 class="text-white counter">CAMBIO</h4>
                <h1 class="text-white">'.$s.formato($cambio).'</h1>
              </div>
            </div>
        </div>
		<br>
		<input type="hidden" name="cambio" value="'.$cambio.'">
	';
	
	if($estado_contado==true and $estado_credito==true and $estado_neto==true and $estado1==true){
		echo '<center><button type="submit" class="btn btn-block btn-lg btn-primary">
		<i class="fa  fa-newspaper-o"></i> <strong>Facturar</strong></button></center>';
	}else{
		echo '<center><strong>'.$error.'</strong></center>';
	}
?>

