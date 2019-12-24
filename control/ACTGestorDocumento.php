<?php
/**
*@package pXP
*@file gen-ACTGestorDocumento.php
*@author  (jrivera)
*@date 16-12-2019 11:32:11
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				16-12-2019 11:32:11								CREACION

*/

class ACTGestorDocumento extends ACTbase{    
			
	function listarGestorDocumento(){
		$this->objParam->defecto('ordenacion','id_gestor_documento');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODGestorDocumento','listarGestorDocumento');
		} else{
			$this->objFunc=$this->create('MODGestorDocumento');
			
			$this->res=$this->objFunc->listarGestorDocumento($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarGestorDocumento(){
		$this->objFunc=$this->create('MODGestorDocumento');	
		if($this->objParam->insertar('id_gestor_documento')){
			$this->res=$this->objFunc->insertarGestorDocumento($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarGestorDocumento($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarGestorDocumento(){
			$this->objFunc=$this->create('MODGestorDocumento');	
		$this->res=$this->objFunc->eliminarGestorDocumento($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	function procesarGestorDocumento(){
		$this->objFunc=$this->create('MODGestorDocumento');	
	$this->res=$this->objFunc->procesarGestorDocumento($this->objParam);
	$this->res->imprimirRespuesta($this->res->generarJson());
}
			
}

?>