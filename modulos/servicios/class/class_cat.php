<?php
class Proceso_Categoria{
	var $id;		
	var $nombre;
	function __construct($id,$nombre){
		$this->id=$id;						
		$this->nombre=$nombre;		
		
	}
	function crear(){
		$id=$this->id;					
		$nombre=$this->nombre;							
		mysql_query("INSERT INTO confi (nombre,tabla) VALUES ('$nombre','categoria')");
	}
	function actualizar(){
		$id=$this->id;					
		$nombre=$this->nombre;		
		mysql_query("UPDATE confi SET nombre='$nombre' WHERE id='$id'");
}
}
?>