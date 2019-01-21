<?php
/**
*@package pXP
*@file gen-ACTAmbiente.php
*@author  (admin)
*@date 18-01-2019 14:57:46
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTAmbiente extends ACTbase{    
			
	function listarAmbiente(){
		$this->objParam->defecto('ordenacion','id_ambiente');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODAmbiente','listarAmbiente');
		} else{
			$this->objFunc=$this->create('MODAmbiente');
			
			$this->res=$this->objFunc->listarAmbiente($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarAmbiente(){
		$this->objFunc=$this->create('MODAmbiente');	
		if($this->objParam->insertar('id_ambiente')){
			$this->res=$this->objFunc->insertarAmbiente($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarAmbiente($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarAmbiente(){
			$this->objFunc=$this->create('MODAmbiente');	
		$this->res=$this->objFunc->eliminarAmbiente($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>