<?php
/**
*@package pXP
*@file gen-ACTTipoMoneda.php
*@author  (admin)
*@date 18-01-2019 13:59:47
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/
class ACTTipoMoneda extends ACTbase{    
			
	function listarTipoMoneda(){
		$this->objParam->defecto('ordenacion','id_tipo_moneda');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODTipoMoneda','listarTipoMoneda');
		} else{
			$this->objFunc=$this->create('MODTipoMoneda');
			
			$this->res=$this->objFunc->listarTipoMoneda($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarTipoMoneda(){
		$this->objFunc=$this->create('MODTipoMoneda');	
		if($this->objParam->insertar('id_tipo_moneda')){
			$this->res=$this->objFunc->insertarTipoMoneda($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarTipoMoneda($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarTipoMoneda(){
			$this->objFunc=$this->create('MODTipoMoneda');	
		$this->res=$this->objFunc->eliminarTipoMoneda($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
	
	function sincronizarTipoMoneda(){
		$this->objFunc=$this->create('MODTipoMoneda');	
		$this->res=$this->objFunc->sincronizarTipoMoneda($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
}
	
?>