<?php
/**
*@package pXP
*@file gen-ACTEnvioDocumento.php
*@author  (admin)
*@date 31-01-2019 13:06:14
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTEnvioDocumento extends ACTbase{    
			
	function listarEnvioDocumento(){
		$this->objParam->defecto('ordenacion','id_envio_documento');
		
		if ($this->objParam->getParametro('desde') != '') {
        	$this->objParam->addFiltro(" endocf.fecha_emision::date >= ''" .  $this->objParam->getParametro('desde')."''::date ");   
        }   
        if ($this->objParam->getParametro('hasta') != '') {
       		$this->objParam->addFiltro(" endocf.fecha_emision::date <= ''" .  $this->objParam->getParametro('hasta')."''::date ");
	    }	 
	    if ($this->objParam->getParametro('nro_documento') != '') {
       		$this->objParam->addFiltro(" endocf.nro_documento = ''" .  $this->objParam->getParametro('nro_documento')."''");  
        }	   
	   

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODEnvioDocumento','listarEnvioDocumento');
		} else{
			$this->objFunc=$this->create('MODEnvioDocumento');
			
			$this->res=$this->objFunc->listarEnvioDocumento($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarEnvioDocumento(){
		$this->objFunc=$this->create('MODEnvioDocumento');	
		if($this->objParam->insertar('id_envio_documento')){
			$this->res=$this->objFunc->insertarEnvioDocumento($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarEnvioDocumento($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarEnvioDocumento(){
			$this->objFunc=$this->create('MODEnvioDocumento');	
		$this->res=$this->objFunc->eliminarEnvioDocumento($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>