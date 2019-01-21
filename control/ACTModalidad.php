<?php
/**
*@package pXP
*@file gen-ACTModalidad.php
*@author  (admin)
*@date 18-01-2019 14:57:53
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTModalidad extends ACTbase{    
			
	function listarModalidad(){
		$this->objParam->defecto('ordenacion','id_modalidad');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODModalidad','listarModalidad');
		} else{
			$this->objFunc=$this->create('MODModalidad');
			
			$this->res=$this->objFunc->listarModalidad($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarModalidad(){
		$this->objFunc=$this->create('MODModalidad');	
		if($this->objParam->insertar('id_modalidad')){
			$this->res=$this->objFunc->insertarModalidad($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarModalidad($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarModalidad(){
			$this->objFunc=$this->create('MODModalidad');	
		$this->res=$this->objFunc->eliminarModalidad($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>