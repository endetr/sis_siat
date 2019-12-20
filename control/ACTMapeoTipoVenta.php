<?php
/**
*@package pXP
*@file gen-ACTMapeoTipoVenta.php
*@author  (jrivera)
*@date 17-12-2019 02:51:47
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				17-12-2019 02:51:47								CREACION

*/

class ACTMapeoTipoVenta extends ACTbase{    
			
	function listarMapeoTipoVenta(){
		$this->objParam->defecto('ordenacion','id_mapeo_tipo_venta');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODMapeoTipoVenta','listarMapeoTipoVenta');
		} else{
			$this->objFunc=$this->create('MODMapeoTipoVenta');
			
			$this->res=$this->objFunc->listarMapeoTipoVenta($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarMapeoTipoVenta(){
		$this->objFunc=$this->create('MODMapeoTipoVenta');	
		if($this->objParam->insertar('id_mapeo_tipo_venta')){
			$this->res=$this->objFunc->insertarMapeoTipoVenta($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarMapeoTipoVenta($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarMapeoTipoVenta(){
			$this->objFunc=$this->create('MODMapeoTipoVenta');	
		$this->res=$this->objFunc->eliminarMapeoTipoVenta($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>