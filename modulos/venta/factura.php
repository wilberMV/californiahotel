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
	if(!empty($_GET['i'])){
		$id_factura=get(limpiar($_GET['i']),'factura','id');
		$usuario=$_SESSION['cod_user'];
		$id_sucursal=consultar('sucursal','username'," usu='$usuario'");
		$tama=consultar('tama','sucursal'," id='$id_sucursal'");
		$letra=consultar('letra','sucursal'," id='$id_sucursal'");
		$ss=mysql_query("SELECT * FROM factura WHERE id='$id_factura'");
		if($factura=mysql_fetch_array($ss)){
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ticket No. <?php echo formato_factura($id_factura); ?></title>
</head>
<style type="text/css" media="print">
#Imprime {
	height: auto;
	width: 600px;
	margin: 0px;
	padding: 0px;
	float: left;
	font-family: "Comic Sans MS", cursive;
	font-size: 7px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	color: #000;
}
@page{
   margin: 0;
}
</style>
<body>
<div id="Imprime">

                            <table width="75%" rules="all" border="1" style="font-size:<?php echo $letra; ?>px; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif">
                                        <tr>
                                             <td colspan="4">                                                
                                            <div align="center" style="font-size:20px"><strong> <?php echo consultar('nom','sucursal',"id='".$factura['sucursal']."'"); ?></strong><br></div>
                                            <div align="center"><strong>TEL: </strong> <?php echo consultar('tel','sucursal',"id='".$factura['sucursal']."'"); ?><br></div>
                                            <div align="center"><strong>NIT: </strong> <?php echo consultar('nitt','sucursal',"id='".$factura['sucursal']."'"); ?><br></div>                                                 
                                            <div align="center"><strong>GIRO: </strong> <?php echo consultar('giro','sucursal',"id='".$factura['sucursal']."'"); ?><br></div>                                                 
                                            <div align="center"><strong>SUCURSAL </strong><?php echo consultar('nom','sucursal',"id='".$factura['sucursal']."'").', 
                                                '.consultar('ciudad','sucursal',"id='".$factura['sucursal']."'"); ?><br></div>
                                            <div align="center"><strong>FACTURA: </strong><?php echo formato_factura($id_factura); ?></div>
                                            <div align="center"><strong>CAJERO: </strong><?php echo nombre($factura['usuario']); ?><br></div>
                                            <div align="center"><strong>FECHA: </strong><?php echo fechal($factura['fecha']).', '.$factura['hora']; ?><br></div>    
                                            </td>
                                         </tr>
                                         <tr>
                                            <td><strong>Cant</strong></td>                                              
                                            <td><strong>Descripcion</strong></td>
                                            <td><div align="right"><strong>Valor Unitario</strong></div></td>
                                            <td><div align="right"><strong>Total</strong></div></td>
                                        </tr>
                                             <?php 
                                                $ss=mysql_query("SELECT * FROM factura_detalle WHERE factura='$id_factura'");
                                                while($rr=mysql_fetch_array($ss)){
                                                     $tur=$factura['subtotal']*15/100;
                          													 $iva=$factura['subtotal']*13/100;
                                                     $iv=$factura['neto']/13; 
                          													 $t_impuestos=$iva+$tur;
                                                     $total=$rr['cant']*$rr['val'];
                                                    ?>
                                        <tr>
                                            <td><?php echo $rr['cant']; ?></td>                                                
                                            <td><?php echo $rr['nom']; ?></td>
                                            <td><div align="right"><?php echo $s.formato($rr['val']); ?></div></td>
                                            <td><div align="right"><?php echo $s.formato($total); ?></div></td>
                                        </tr>
                                        <?php } ?>
                                           <tr>
                                              <td colspan="4"></td><br>
                                            </tr>   
                                            <tr>
                                              <td colspan="3"><div align="right"><strong>Sub Total</strong></div></td>
                                              <td><div align="right"><strong><?php echo $s.formato($factura['neto']-$iv); ?></strong></div></td>
                                            </tr>
                                             <tr>
                                              <td colspan="3"><div align="right"><strong>IVA:</strong></div></td>
                                              <td> <div align="right"><strong><?php echo $s.formato($iv); ?></strong></div></td>
                                            </tr>
                                            <!--<tr>
                                              <td colspan="3"><div align="right"><strong>IMPUESTO TURISMO:</strong></div></td>
                                              <td> <div align="right"><strong><?php echo $s.formato($tur); ?></strong></div></td>
                                            </tr>
                                            <tr>
                                              <td colspan="3"><div align="right"><strong>SUB - TOTAL:</strong></div></td>
                                              <td><div align="right"><strong><?php echo $s.formato($factura['subtotal']-$t_impuestos); ?></strong></div> </td>
                                            </tr>-->
                                            <tr>
                                              <td colspan="3"><div align="right"><strong>TOTAL A PAGAR:</strong></div></td>
                                              <td><div align="right"><strong><?php echo $s.formato($factura['neto']); ?></strong></div></td>
                                            </tr>
                            </table><br>

</body>
</html>