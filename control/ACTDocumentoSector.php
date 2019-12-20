<?php
/**
*@package pXP
*@file gen-ACTDocumentoSector.php
*@author  (jrivera)
*@date 17-12-2019 10:41:56
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				17-12-2019 10:41:56								CREACION

*/

class ACTDocumentoSector extends ACTbase{    
			
	function listarDocumentoSector(){
		$this->objParam->defecto('ordenacion','id_documento_sector');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODDocumentoSector','listarDocumentoSector');
		} else{
			$this->objFunc=$this->create('MODDocumentoSector');
			
			$this->res=$this->objFunc->listarDocumentoSector($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarDocumentoSector(){
		$this->objFunc=$this->create('MODDocumentoSector');	
		if($this->objParam->insertar('id_documento_sector')){
			$this->res=$this->objFunc->insertarDocumentoSector($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarDocumentoSector($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarDocumentoSector(){
			$this->objFunc=$this->create('MODDocumentoSector');	
		$this->res=$this->objFunc->eliminarDocumentoSector($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	function sincronizarDocumentoSector(){
		$this->objFunc=$this->create('MODDocumentoSector');	
		$this->res=$this->objFunc->sincronizarDocumentoSector($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>