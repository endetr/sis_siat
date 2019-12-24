<?php
/**
*@package pXP
*@file gen-ACTLeyenda.php
*@author  (jrivera)
*@date 20-12-2019 22:15:53
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				20-12-2019 22:15:53								CREACION

*/

class ACTLeyenda extends ACTbase{    
			
	function listarLeyenda(){
		$this->objParam->defecto('ordenacion','id_leyenda');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODLeyenda','listarLeyenda');
		} else{
			$this->objFunc=$this->create('MODLeyenda');
			
			$this->res=$this->objFunc->listarLeyenda($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarLeyenda(){
		$this->objFunc=$this->create('MODLeyenda');	
		if($this->objParam->insertar('id_leyenda')){
			$this->res=$this->objFunc->insertarLeyenda($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarLeyenda($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarLeyenda(){
			$this->objFunc=$this->create('MODLeyenda');	
		$this->res=$this->objFunc->eliminarLeyenda($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	function sincronizarLeyenda(){
		$this->objFunc=$this->create('MODLeyenda');	
		$this->res=$this->objFunc->sincronizarLeyenda($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>