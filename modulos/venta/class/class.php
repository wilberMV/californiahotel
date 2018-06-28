<?php
class Proceso_Cliente{
	var $id;	
	var $documento;
	var $nombre;
    var $direccion;			
	var $telefono;		
	var $celular;		
	var $estado;
	var $sucursal;
	var $nitt;
	var $giro;
	var $email;
	
	function __construct($id, $documento,$nombre,$direccion,$telefono,$celular,$estado,$sucursal,$nitt,$giro,$email){
		$this->id=$id;		
		$this->documento=$documento;		
		$this->nombre=$nombre;		
		$this->direccion=$direccion;	
		$this->telefono=$telefono;
		$this->celular=$celular;			
		$this->estado=$estado;	
		$this->sucursal=$sucursal;
		$this->nitt=$nitt;
		$this->giro=$giro;
		$this->email=$email;	
	}
	
	function crear(){
		$id=$this->id;		
		$documento=$this->documento;		
		$nombre=$this->nombre;		
		$direccion=$this->direccion;	
		$telefono=$this->telefono;	
		$celular=$this->celular;		
		$estado=$this->estado;	
		$sucursal=$this->sucursal;
		$nitt=$this->nitt;
		$giro=$this->giro;
		$email=$this->email;	
							
		mysql_query("INSERT INTO cliente (nit, nom, dir, tel, cel, descuento, lcredito, sucursal, estado, nitt, giro, email) 
					VALUES ('$documento','$nombre','$direccion','$telefono','$celular','','','$sucursal','$estado','$nitt','$giro','$email')");
	}
	
	function actualizar(){
		$id=$this->id;		
		$documento=$this->documento;		
		$nombre=$this->nombre;		
		$direccion=$this->direccion;	
		$telefono=$this->telefono;	
		$celular=$this->celular;		
		$estado=$this->estado;	
		$sucursal=$this->sucursal;
		$nitt=$this->nitt;
		$giro=$this->giro;
		$email=$this->email;
		
		mysql_query("UPDATE cliente SET nit='$documento', 
										nom='$nombre',
										dir='$direccion',
										tel='$telefono',
										cel='$celular',																			
										sucursal='$sucursal',
										estado='$estado',
										nitt='$nitt',
										giro='$giro',
										email='$email'
									WHERE id='$id'");
}
}
?>