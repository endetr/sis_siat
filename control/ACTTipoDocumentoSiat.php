<?php
/**
*@package pXP
*@file gen-ACTTipoDocumentoSiat.php
*@author  (admin)
*@date 18-01-2019 14:58:05
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTTipoDocumentoSiat extends ACTbase{    
			
	function listarTipoDocumentoSiat(){
		$this->objParam->defecto('ordenacion','id_tipo_documento');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODTipoDocumentoSiat','listarTipoDocumentoSiat');
		} else{
			$this->objFunc=$this->create('MODTipoDocumentoSiat');
			
			$this->res=$this->objFunc->listarTipoDocumentoSiat($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarTipoDocumentoSiat(){
		$this->objFunc=$this->create('MODTipoDocumentoSiat');	
		if($this->objParam->insertar('id_tipo_documento')){
			$this->res=$this->objFunc->insertarTipoDocumentoSiat($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarTipoDocumentoSiat($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarTipoDocumentoSiat(){
			$this->objFunc=$this->create('MODTipoDocumentoSiat');	
		$this->res=$this->objFunc->eliminarTipoDocumentoSiat($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>