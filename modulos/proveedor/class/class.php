<?php
class Proceso_Proveedor{
	var $id;	
	var $documento;
	var $nombre;
    var $direccion;			
	var $telefono;		
	var $celular;		
	var $email;
	var $web;
	var $contacto;
	
	function __construct($id, $documento,$nombre,$direccion,$telefono,$celular,$email,$web,$contacto){
		$this->id=$id;		
		$this->documento=$documento;		
		$this->nombre=$nombre;		
		$this->direccion=$direccion;	
		$this->telefono=$telefono;
		$this->celular=$celular;			
		$this->email=$email;	
		$this->web=$web;	
		$this->contacto=$contacto;	
	}
	
	function crear(){
		$id=$this->id;		
		$documento=$this->documento;		
		$nombre=$this->nombre;		
		$direccion=$this->direccion;	
		$telefono=$this->telefono;	
		$celular=$this->celular;		
		$email=$this->email;	
		$web=$this->web;	
		$contacto=$this->contacto;	
							
		mysql_query("INSERT INTO proveedor (codigo, cedula, nombre, tel, cel, correo, dir, pagina, contacto) 
					                VALUES ('$documento','','$nombre','$telefono','$celular','$email','$direccion','$web','$contacto')");
	}
	
	function actualizar(){
		$id=$this->id;		
		$documento=$this->documento;		
		$nombre=$this->nombre;		
		$direccion=$this->direccion;	
		$telefono=$this->telefono;	
		$celular=$this->celular;		
		$email=$this->email;	
		$web=$this->web;	
		$contacto=$this->contacto;	
		
		mysql_query("UPDATE proveedor SET codigo='$documento', 
										nombre='$nombre',
										tel='$telefono',
										cel='$celular',
										correo='$email',																			
										dir='$direccion',
										pagina='$web',
										contacto='$contacto'
									WHERE id='$id'");
}
}
?>