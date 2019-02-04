<?php
/**
*@package pXP
*@file gen-ACTMotivoAnulacion.php
*@author  (ana.villegas)
*@date 31-01-2019 16:28:10
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/
include "SiatClassWs.inc";

session_start();

class ACTMotivoAnulacion extends ACTbase{    
			
	function listarMotivoAnulacion(){
		$this->objParam->defecto('ordenacion','id_motivo_anulacion');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODMotivoAnulacion','listarMotivoAnulacion');
		} else{
			$this->objFunc=$this->create('MODMotivoAnulacion');
			
			$this->res=$this->objFunc->listarMotivoAnulacion($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarMotivoAnulacion(){
		$this->objFunc=$this->create('MODMotivoAnulacion');	
		if($this->objParam->insertar('id_motivo_anulacion')){
			$this->res=$this->objFunc->insertarMotivoAnulacion($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarMotivoAnulacion($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarMotivoAnulacion(){
			$this->objFunc=$this->create('MODMotivoAnulacion');	
		$this->res=$this->objFunc->eliminarMotivoAnulacion($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
  
	function insertarMotivoAnulacionWS(){
        // Obtengo los datos que serviran de parametro para el WS
         $cone = new conexion();
			$this->link = $cone->conectarpdo();
			$copiado = false;	
			$sql = "select e.nit,s.codigo as codigo_sucursal,
       						(select codigo from siat.tambiente where estado_reg ='activo' limit 1) as codigo_ambiente,
       						(select codigo from siat.tmodalidad where estado_reg ='activo' limit 1) as codigo_modalidad
					from param.tentidad e
					left join vef.tsucursal s on s.id_entidad=e.id_entidad
					where e.estado_reg='activo' limit 1";
			$res = $this->link->prepare($sql);
			$res->execute();
			$result = $res->fetchAll(PDO::FETCH_ASSOC);
			$nit=$result[0]['nit'];
			$codigo_sucursal=$result[0]['codigo_sucursal'];
			$codigo_ambiente=$result[0]['codigo_ambiente'];
			$codigo_modalidad=$result[0]['codigo_modalidad'];	
					
		// Acceso al web service.
		$wsSincroniza= new WsFacturacionSincroniza($_SESSION["_URLWS_SINCRONIZA"],2,'2E07180BA7E','',1009393025,'713E32B4',0);
		//$wsSincroniza= new WsFacturacionSincroniza($_SESSION["_URLWS_SINCRONIZA"],$codigo_ambiente,$codigo_sistema,$codigo_modalidad,$nit,$codigo_cuis,$codigo_sucursal);
		
		//ejemplo de solicitud de tipos de moneda
		$resultsinc = $wsSincroniza->ParametricaMotivoAnulacion();
		
		//inserto los datos a las tablas
		//convierte resultado en array
        $r = $wsSincroniza->ConvertObjectToArray($resultsinc);
     
 				foreach($r['return']['listaCodigos'] as $r2)
			 	{
			 	  $codigo= $r2[codigoClasificador];
				  $descripcion= $r2[descripcion];
				  $this->objParam->addParametro('codigo',$codigo);
		 		  $this->objParam->addParametro('descripcion',$descripcion);		
		    	  $this->objFunc=$this->create('MODMotivoAnulacion');	
				  $this->res=$this->objFunc->insertarMotivoAnulacion($this->objParam);			
		        }
                $this->res->imprimirRespuesta($this->res->generarJson());
	    }
			
}

?>