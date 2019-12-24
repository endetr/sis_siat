<?php
/**
*@package pXP
*@file gen-ACTCufd.php
*@author  (admin)
*@date 22-01-2019 02:23:54
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/


class ACTCufd extends ACTbase{    
			
	function listarCufd(){
			
		$this->objParam->defecto('ordenacion','id_cufd');
		
		if($this->objParam->getParametro('id_cuis') != '') {
                $this->objParam->addFiltro(" cufd.id_cuis = " . $this->objParam->getParametro('id_cuis'));
        }
		

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODCufd','listarCufd');
		} else{
			$this->objFunc=$this->create('MODCufd');
			
			$this->res=$this->objFunc->listarCufd($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
		
	function registrarCufd() {		
		$this->objFunc=$this->create('MODCufd');	
		$this->respuesta=$this->objFunc->registrarCufd($this->objParam);		
		$this->respuesta->imprimirRespuesta($this->respuesta->generarJson());		
	}	
	
						
	function eliminarCufd(){
			$this->objFunc=$this->create('MODCufd');	
		$this->res=$this->objFunc->eliminarCufd($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>