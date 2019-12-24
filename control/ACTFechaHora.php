<?php
/**
*@package pXP
*@file gen-ACTFechaHora.php
*@author  (jrivera)
*@date 20-12-2019 22:16:04
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				20-12-2019 22:16:04								CREACION

*/

class ACTFechaHora extends ACTbase{    
			
	function listarFechaHora(){
		$this->objParam->defecto('ordenacion','id_fecha_hora');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODFechaHora','listarFechaHora');
		} else{
			$this->objFunc=$this->create('MODFechaHora');
			
			$this->res=$this->objFunc->listarFechaHora($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarFechaHora(){
		$this->objFunc=$this->create('MODFechaHora');	
		if($this->objParam->insertar('id_fecha_hora')){
			$this->res=$this->objFunc->insertarFechaHora($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarFechaHora($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarFechaHora(){
			$this->objFunc=$this->create('MODFechaHora');	
		$this->res=$this->objFunc->eliminarFechaHora($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	function sincronizarFechaHora(){
		$this->objFunc=$this->create('MODFechaHora');	
		$this->res=$this->objFunc->sincronizarFechaHora($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>