<?php
/**
*@package pXP
*@file gen-ACTMetodoPago.php
*@author  (admin)
*@date 18-01-2019 14:57:57
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTMetodoPago extends ACTbase{    
			
	function listarMetodoPago(){
		$this->objParam->defecto('ordenacion','id_metodo_pago');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODMetodoPago','listarMetodoPago');
		} else{
			$this->objFunc=$this->create('MODMetodoPago');
			
			$this->res=$this->objFunc->listarMetodoPago($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarMetodoPago(){
		$this->objFunc=$this->create('MODMetodoPago');	
		if($this->objParam->insertar('id_metodo_pago')){
			$this->res=$this->objFunc->insertarMetodoPago($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarMetodoPago($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarMetodoPago(){
			$this->objFunc=$this->create('MODMetodoPago');	
		$this->res=$this->objFunc->eliminarMetodoPago($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>