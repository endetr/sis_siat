<?php
/**
*@package pXP
*@file gen-ACTUnidadMedida.php
*@author  (jrivera)
*@date 20-12-2019 22:12:50
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				20-12-2019 22:12:50								CREACION

*/

class ACTUnidadMedida extends ACTbase{    
			
	function listarUnidadMedida(){
		$this->objParam->defecto('ordenacion','id_unidad_medida');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODUnidadMedida','listarUnidadMedida');
		} else{
			$this->objFunc=$this->create('MODUnidadMedida');
			
			$this->res=$this->objFunc->listarUnidadMedida($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarUnidadMedida(){
		$this->objFunc=$this->create('MODUnidadMedida');	
		if($this->objParam->insertar('id_unidad_medida')){
			$this->res=$this->objFunc->insertarUnidadMedida($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarUnidadMedida($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarUnidadMedida(){
			$this->objFunc=$this->create('MODUnidadMedida');	
		$this->res=$this->objFunc->eliminarUnidadMedida($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	function sincronizarUnidadMedida(){
		$this->objFunc=$this->create('MODUnidadMedida');	
		$this->res=$this->objFunc->sincronizarUnidadMedida($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>