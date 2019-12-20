<?php
/**
*@package pXP
*@file gen-ACTMotivoAnulacion.php
*@author  (ana.villegas)
*@date 31-01-2019 16:28:10
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/
class ACTMotivoAnulacion extends ACTbase{    
			
	function listarMotivoAnulacion(){
		$this->objParam->defecto('ordenacion','id_motivo_anulacion');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODMotivoAnulacion','listarMotivoAnulacion');
		} else{
			$this->objFunc=$this->create('MODMotivoAnulacion');
			
			$this->res=$this->objFunc->listarMotivoAnulacion($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarMotivoAnulacion(){
		$this->objFunc=$this->create('MODMotivoAnulacion');	
		if($this->objParam->insertar('id_motivo_anulacion')){
			$this->res=$this->objFunc->insertarMotivoAnulacion($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarMotivoAnulacion($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarMotivoAnulacion(){
			$this->objFunc=$this->create('MODMotivoAnulacion');	
		$this->res=$this->objFunc->eliminarMotivoAnulacion($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	function sincronizarMotivoAnulacion(){
		$this->objFunc=$this->create('MODMotivoAnulacion');	
		$this->res=$this->objFunc->sincronizarMotivoAnulacion($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
	
			
}

?>