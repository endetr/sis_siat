<?php
/**
*@package pXP
*@file gen-ACTDepartamento.php
*@author  (jrivera)
*@date 20-12-2019 22:16:01
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				20-12-2019 22:16:01								CREACION

*/

class ACTDepartamento extends ACTbase{    
			
	function listarDepartamento(){
		$this->objParam->defecto('ordenacion','id_departamento');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODDepartamento','listarDepartamento');
		} else{
			$this->objFunc=$this->create('MODDepartamento');
			
			$this->res=$this->objFunc->listarDepartamento($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarDepartamento(){
		$this->objFunc=$this->create('MODDepartamento');	
		if($this->objParam->insertar('id_departamento')){
			$this->res=$this->objFunc->insertarDepartamento($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarDepartamento($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarDepartamento(){
			$this->objFunc=$this->create('MODDepartamento');	
		$this->res=$this->objFunc->eliminarDepartamento($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	function sincronizarDepartamento(){
		$this->objFunc=$this->create('MODDepartamento');	
		$this->res=$this->objFunc->sincronizarDepartamento($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>