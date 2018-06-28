<?php
class Proceso_Producto{
	var $id;	
	var $codigo;
	var $nombre;
    var $categoria;			
	#var $proveedor;		
	#var $inventario;		
	var $nchasis;
	var $nplaca;
	var $valor;
	var $estado;
	var $control;
	
	function __construct($id,$codigo,$nombre,$categoria,$nchasis,$nplaca,$valor,$estado,$control){
		$this->id=$id;		
		$this->codigo=$codigo;		
		$this->nombre=$nombre;		
		$this->categoria=$categoria;	
		#$this->proveedor=$proveedor;
		#$this->inventario=$inventario;			
		$this->nchasis=$nchasis;	
		$this->nplaca=$nplaca;	
		$this->valor=$valor;	
		$this->estado=$estado;	
		$this->control=$control;	
	}
	
	function crear(){
		$id=$this->id;		
		$codigo=$this->codigo;		
		$nombre=$this->nombre;		
		$categoria=$this->categoria;	
		#$proveedor=$this->proveedor;	
		#$inventario=$this->inventario;		
		$nchasis=$this->nchasis;	
		$nplaca=$this->nplaca;	
		$valor=$this->valor;	
		$estado=$this->estado;	
		$control=$this->control;	
							
		mysql_query("INSERT INTO producto (codigo, nombre, categoria, inv, estado, nchasis, nplaca, valor, prov,control) 
					                VALUES ('$codigo','$nombre','$categoria','','$estado','$nchasis','$nplaca','$valor','','$control')");
	}
	
	function actualizar(){
		$id=$this->id;		
		$codigo=$this->codigo;		
		$nombre=$this->nombre;		
		$categoria=$this->categoria;	
		#$proveedor=$this->proveedor;	
		#$inventario=$this->inventario;		
		$nchasis=$this->nchasis;	
		$nplaca=$this->nplaca;	
		$valor=$this->valor;	
		$estado=$this->estado;
		$control=$this->control;
		
		mysql_query("UPDATE producto SET codigo='$codigo', 
										nombre='$nombre',
										categoria='$categoria',
										inv='',
										estado='$estado',																			
										nchasis='$nchasis',
										nplaca='$nplaca',
										valor='$valor',
										prov='',
										control='$control'
									WHERE id='$id'");
}
}
?>