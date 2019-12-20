<?php
/**
*@package pXP
*@file gen-ACTTipoEmision.php
*@author  (admin)
*@date 18-01-2019 14:57:49
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTTipoEmision extends ACTbase{    
			
	function listarTipoEmision(){
		$this->objParam->defecto('ordenacion','id_tipo_emision');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODTipoEmision','listarTipoEmision');
		} else{
			$this->objFunc=$this->create('MODTipoEmision');
			
			$this->res=$this->objFunc->listarTipoEmision($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarTipoEmision(){
		$this->objFunc=$this->create('MODTipoEmision');	
		if($this->objParam->insertar('id_tipo_emision')){
			$this->res=$this->objFunc->insertarTipoEmision($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarTipoEmision($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarTipoEmision(){
			$this->objFunc=$this->create('MODTipoEmision');	
		$this->res=$this->objFunc->eliminarTipoEmision($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
	function sincronizarTipoEmision(){
		$this->objFunc=$this->create('MODTipoEmision');	
		$this->res=$this->objFunc->sincronizarTipoEmision($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
    				
}

?>