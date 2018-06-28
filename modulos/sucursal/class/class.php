<?php
class Proceso_Suscursal{
	var $id;	
	var $codigo;
	var $nombre;
    var $direccion;			
	var $telefono;		
	var $ciudad;		
	var $distrito;
	var $nom_imp;
	var $val_imp;
	var $tama;
	var $letra;
	var $giro;
	var $nrc;
	var $nitt;
	
	function __construct($id,$codigo,$nombre,$direccion,$telefono,$ciudad,$distrito,$nom_imp,$val_imp,$tama,$letra,$giro,$nrc,$nitt){
		$this->id=$id;		
		$this->codigo=$codigo;		
		$this->nombre=$nombre;		
		$this->direccion=$direccion;	
		$this->telefono=$telefono;
		$this->ciudad=$ciudad;			
		$this->distrito=$distrito;	
		$this->nom_imp=$nom_imp;	
		$this->val_imp=$val_imp;	
		$this->tama=$tama;	
		$this->letra=$letra;	
		$this->giro=$giro;	
		$this->nrc=$nrc;	
		$this->nitt=$nitt;	
	}
	
	function crear(){
		$id=$this->id;		
		$codigo=$this->codigo;		
		$nombre=$this->nombre;		
		$direccion=$this->direccion;	
		$telefono=$this->telefono;	
		$ciudad=$this->ciudad;		
		$distrito=$this->distrito;	
		$nom_imp=$this->nom_imp;	
		$val_imp=$this->val_imp;	
		$tama=$this->tama;	
		$letra=$this->letra;	
		$giro=$this->giro;	
		$nrc=$this->nrc;	
		$nitt=$this->nitt;	
							
		mysql_query("INSERT INTO sucursal (nit,nom,municipio,dpto,ciudad,dir,tel,correo,web,pais,nom_imp,val_imp,cp,tama,letra,giro,nrc,nitt) VALUES 
						         ('$codigo','$nombre','','$distrito','$ciudad','$direccion','$telefono','','','','$nom_imp','$val_imp','','$tama','$letra','$giro','$nrc','$nitt')");
	}
	
	function actualizar(){
		$id=$this->id;		
		$codigo=$this->codigo;		
		$nombre=$this->nombre;		
		$direccion=$this->direccion;	
		$telefono=$this->telefono;	
		$ciudad=$this->ciudad;		
		$distrito=$this->distrito;	
		$nom_imp=$this->nom_imp;	
		$val_imp=$this->val_imp;	
		$tama=$this->tama;	
		$letra=$this->letra;
		$giro=$this->giro;	
		$nrc=$this->nrc;	
		$nitt=$this->nitt;	
		
		mysql_query("UPDATE sucursal SET nit='$codigo', 									    
									    ciudad='$ciudad', 
									    tel='$telefono', 									    
									    val_imp='$val_imp',						                
						                letra='$letra', 
						                nom='$nombre', 
						                dpto='$distrito', 
						                dir='$direccion', 						               
						                nom_imp='$nom_imp', 
						                tama='$tama',
						                giro='$giro',
						                nrc='$nrc',
						                nitt='$nitt'
									where id='$id'");
}
}
?>