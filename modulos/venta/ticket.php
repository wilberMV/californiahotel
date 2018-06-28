<?php 
	session_start();
	include_once "../php_conexion.php";
	include_once "../funciones.php";
	if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
		if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Recepción','1')==true){
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
	width: 377px;
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
<table width="<?php echo $tama; ?>px">
    <tr>
        <td>
              <table width="100%" style="font-size:<?php echo $letra; ?>px; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif">
                 <tr>
                    <td colspan="6">                                                
                    <div align="center" style="font-size:20px"><strong> <?php echo consultar('nom','sucursal',"id='".$factura['sucursal']."'"); ?></strong><br></div>
                    <div align="center"><strong>TEL: </strong> <?php echo consultar('tel','sucursal',"id='".$factura['sucursal']."'"); ?><br></div>
                    <div align="center"><strong>NIT: </strong> <?php echo consultar('nitt','sucursal',"id='".$factura['sucursal']."'"); ?><br></div>                                                 
                    <div align="center"><strong>GIRO: </strong> <?php echo consultar('giro','sucursal',"id='".$factura['sucursal']."'"); ?><br></div>                                                 
                    <div align="center"><strong>SUCURSAL </strong><?php echo consultar('nom','sucursal',"id='".$factura['sucursal']."'").', 
                        '.consultar('ciudad','sucursal',"id='".$factura['sucursal']."'"); ?><br></div>
                    <div align="center"><strong>TICKET: </strong><?php echo formato_factura($id_factura); ?></div>
                    <div align="center"><strong>CAJERO: </strong><?php echo nombre($factura['usuario']); ?><br></div>
                    <div align="center"><strong>FECHA: </strong><?php echo fechal($factura['fecha']).', '.$factura['hora']; ?><br></div>    
                    </td>
                    </tr>     
                    <tr>
                        <td colspan="6"><center>==================================</center></td>
                    </tr>
                        <tr>
                        <td>Cant</td>
                        <td>Descripción</td>
                        <td>p/u</td>
                        <td>%</td>
                        <td>Fle</td>
                        <td>Total</td>
                        </tr>
                    <tr>
                        <td colspan="6"><center>==================================</center></td>
                    </tr>
                            
                           <?php
                                 $tur=0;$t_impuestos=0; 
                                $ss=mysql_query("SELECT * FROM factura_detalle WHERE factura='$id_factura'");
                                while($rr=mysql_fetch_array($ss)){
                                    $tur=$factura['subtotal']*15/100;
                                    $iva=$factura['subtotal']*13/100;
                                    $iv=$factura['neto']/13;                              
                                    $t_impuestos=$iva+$tur;
                                    $descuento=$rr['descto'];
                                    $tdes=$rr['cant']*$rr['val']*$descuento/100;
                                    $importe=$rr['val']*$rr['cant']-$tdes+$rr['flete'];
                            ?>
                        <tr>
                            <td><div align="center"><?php echo $rr['cant']; ?><div></td>                                                                                              
                            <td><?php echo $rr['nom']; ?></td>
                            <td ><div align="left"><?php echo $s.formato($rr['val']); ?></div></td>                                            
                            <td><div align="center"><?php echo $s.formato($tdes); ?></div></td>
                            <td><div align="center"><?php echo $rr['flete']; ?></div></td>
                            <td><div align="center"><?php echo $s.formato($importe); ?></div></td>
                        </tr>
                           <?php } ?>                 
                        <tr>
                            <td colspan="6"><center>-------------------------------------------</center></td>
                        </tr>                                                  
                        <tr>
                            <td colspan="4">
                                <div align="right">SUB TOTAL: <?php echo $s.formato($factura['neto']-$iv); ?></div>                                                           
                            </td>
                        </tr><br>
                         <tr>
                            <td colspan="4">
                               <div align="right"> IVA: <?php echo $s.formato($iv); ?></div>                                                             
                            </td>
                        </tr><br>
                         <!--<tr>
                            <td colspan="4">
                               <div align="right"> IMPUESTO TURISMO: <?php echo $s.formato($tur); ?></div>                                                             
                            </td>
                        </tr><br>
                         <tr>
                            <td colspan="4">
							<div align="right">SUB TOTAL: <?php echo $s.formato($factura['subtotal']); ?></div>  
                               <div align="right"> TOTAL IMPUESTOS: <?php echo $s.formato($t_impuestos); ?></div>                                                             
                            </td>
                        </tr><br>-->
                        <tr>
                            <td colspan="6">
                               <div align="right"><strong>TOTAL A PAGAR: <?php echo $s.formato($factura['neto']); ?></strong><br></div>                                                              
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6"><center><strong>* VENTA A CONTADO *</strong></center></td>                                              
                        </tr>
                        <tr>
                            <td colspan="6"><center>-------------------------------------------</center></td>
                        </tr>
                        <!--<tr>                                                
                            <td colspan="4"><center><strong> PAGO CONTADO: </strong></center></td>                                             
                        </tr>
                        <tr>                                                
                            <td colspan="4"><center><strong> CAMBIO: $ </strong></center></td>
                        </tr>     
                        <tr>
                            <td colspan="4">&nbsp;</td>
                        </tr>-->
                        <tr>
                            <td colspan="6"><center>GRACIAS POR SU COMPRA<br> www.rentacar.com</center></td>
                        </tr>
                        <tr>
                            <td colspan="6"><center></center></td>
                        </tr><br>
                                          
                     </table>
          </td>
       </tr>
    </table>

</body>
</html>