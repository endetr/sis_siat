<?php
/**
*@package pXP
*@file gen-ACTComponente.php
*@author  (jrivera)
*@date 20-12-2019 22:15:56
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				20-12-2019 22:15:56								CREACION

*/

class ACTComponente extends ACTbase{    
			
	function listarComponente(){
		$this->objParam->defecto('ordenacion','id_componente');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODComponente','listarComponente');
		} else{
			$this->objFunc=$this->create('MODComponente');
			
			$this->res=$this->objFunc->listarComponente($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarComponente(){
		$this->objFunc=$this->create('MODComponente');	
		if($this->objParam->insertar('id_componente')){
			$this->res=$this->objFunc->insertarComponente($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarComponente($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarComponente(){
			$this->objFunc=$this->create('MODComponente');	
		$this->res=$this->objFunc->eliminarComponente($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	function sincronizarComponente(){
		$this->objFunc=$this->create('MODComponente');	
		$this->res=$this->objFunc->sincronizarComponente($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	
			
}

?>