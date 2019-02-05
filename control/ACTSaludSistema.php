<?php
/**
*@package pXP
*@file gen-ACTSaludSistema.php
*@author  (admin)
*@date 24-01-2019 19:34:45
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTSaludSistema extends ACTbase{    
			
	function listarSaludSistema(){
		$this->objParam->defecto('ordenacion','id_salud_sistema');
		
		
		                if ($this->objParam->getParametro('desde') != '') {
        	            $this->objParam->addFiltro(" evsa.fecha_salud::date >= ''" .  $this->objParam->getParametro('desde')."''::date ");   
                        }   
                        if ($this->objParam->getParametro('hasta') != '') {
       		            $this->objParam->addFiltro(" evsa.fecha_salud::date <= ''" .  $this->objParam->getParametro('hasta')."''::date ");
	                    }	
		
		
		                if ($this->objParam->getParametro('codigo_evento') != '') {
                         $this->objParam->addFiltro(" evsa.codigo_evento = ''" .  $this->objParam->getParametro('codigo_evento')."''");
				  
				         }
					   
					   
				        if ($this->objParam->getParametro('id_sucursal') != '') {
                        $this->objParam->addFiltro(" fk_sucursal = " .  $this->objParam->getParametro('id_sucursal')." ");
				  
				        }
		

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODSaludSistema','listarSaludSistema');
		} else{
			$this->objFunc=$this->create('MODSaludSistema');
			
			$this->res=$this->objFunc->listarSaludSistema($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarSaludSistema(){
		$this->objFunc=$this->create('MODSaludSistema');	
		if($this->objParam->insertar('id_salud_sistema')){
			$this->res=$this->objFunc->insertarSaludSistema($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarSaludSistema($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarSaludSistema(){
			$this->objFunc=$this->create('MODSaludSistema');	
		$this->res=$this->objFunc->eliminarSaludSistema($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>