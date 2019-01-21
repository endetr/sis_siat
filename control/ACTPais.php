<?php
/**
*@package pXP
*@file gen-ACTPais.php
*@author  (admin)
*@date 17-01-2019 22:29:35
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTPais extends ACTbase{    
			
	function listarPais(){
		$this->objParam->defecto('ordenacion','id_pais');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODPais','listarPais');
		} else{
			$this->objFunc=$this->create('MODPais');
			
			$this->res=$this->objFunc->listarPais($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarPais(){
		$this->objFunc=$this->create('MODPais');	
		if($this->objParam->insertar('id_pais')){
			$this->res=$this->objFunc->insertarPais($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarPais($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarPais(){
			$this->objFunc=$this->create('MODPais');	
		$this->res=$this->objFunc->eliminarPais($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>