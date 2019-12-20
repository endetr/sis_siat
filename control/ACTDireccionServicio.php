<?php
/**
*@package pXP
*@file gen-ACTDireccionServicio.php
*@author  (jrivera)
*@date 16-12-2019 11:32:48
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				16-12-2019 11:32:48								CREACION

*/

class ACTDireccionServicio extends ACTbase{    
			
	function listarDireccionServicio(){
		$this->objParam->defecto('ordenacion','id_direccion_servicio');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODDireccionServicio','listarDireccionServicio');
		} else{
			$this->objFunc=$this->create('MODDireccionServicio');
			
			$this->res=$this->objFunc->listarDireccionServicio($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarDireccionServicio(){
		$this->objFunc=$this->create('MODDireccionServicio');	
		if($this->objParam->insertar('id_direccion_servicio')){
			$this->res=$this->objFunc->insertarDireccionServicio($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarDireccionServicio($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarDireccionServicio(){
			$this->objFunc=$this->create('MODDireccionServicio');	
		$this->res=$this->objFunc->eliminarDireccionServicio($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>