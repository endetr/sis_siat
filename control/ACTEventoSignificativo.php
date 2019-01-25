<?php
/**
*@package pXP
*@file gen-ACTEventoSignificativo.php
*@author  (admin)
*@date 21-01-2019 22:24:59
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTEventoSignificativo extends ACTbase{    
			
	function listarEventoSignificativo(){
		
		$this->objParam->defecto('ordenacion','id_evento_significativo');
		
	    if ($this->objParam->getParametro('fecha_ini') != '') {
        	$this->objParam->addFiltro(" evsi.fecha_ini::date >= ''" .  $this->objParam->getParametro('fecha_ini')."''::date ");   
        }   
       if ($this->objParam->getParametro('fecha_fin') != '') {
       		$this->objParam->addFiltro(" evsi.fecha_ini::date <= ''" .  $this->objParam->getParametro('fecha_fin')."''::date ");
	   }	 
	   if ($this->objParam->getParametro('codigo_evento') != '') {
       		$this->objParam->addFiltro(" evsi.codigo_evento = ''" .  $this->objParam->getParametro('codigo_evento')."''");  
       }	   
	   
       if ($this->objParam->getParametro('id_sucursal') != '') {
       		$this->objParam->addFiltro(" fk_sucursal = " .  $this->objParam->getParametro('id_sucursal')." ");  
       }			

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODEventoSignificativo','listarEventoSignificativo');
			
		} else{
			
			$this->objFunc=$this->create('MODEventoSignificativo');    
	        $this->res=$this->objFunc->listarEventoSignificativo($this->objParam);
		}
		    $this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarEventoSignificativo(){
		$this->objFunc=$this->create('MODEventoSignificativo');	
		if($this->objParam->insertar('id_evento_significativo')){
			$this->res=$this->objFunc->insertarEventoSignificativo($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarEventoSignificativo($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarEventoSignificativo(){
			$this->objFunc=$this->create('MODEventoSignificativo');	
		$this->res=$this->objFunc->eliminarEventoSignificativo($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>