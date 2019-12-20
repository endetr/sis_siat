<?php
/**
*@package pXP
*@file gen-ACTMensajeSoap.php
*@author  (admin)
*@date 18-01-2019 14:58:00
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTMensajeSoap extends ACTbase{    
			
	function listarMensajeSoap(){
		$this->objParam->defecto('ordenacion','id_mensaje_soap');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODMensajeSoap','listarMensajeSoap');
		} else{
			$this->objFunc=$this->create('MODMensajeSoap');
			
			$this->res=$this->objFunc->listarMensajeSoap($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarMensajeSoap(){
		$this->objFunc=$this->create('MODMensajeSoap');	
		if($this->objParam->insertar('id_mensaje_soap')){
			$this->res=$this->objFunc->insertarMensajeSoap($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarMensajeSoap($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarMensajeSoap(){
			$this->objFunc=$this->create('MODMensajeSoap');	
		$this->res=$this->objFunc->eliminarMensajeSoap($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
	function sincronizarMensajeSoap(){
		$this->objFunc=$this->create('MODMensajeSoap');	
		$this->res=$this->objFunc->sincronizarMensajeSoap($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>