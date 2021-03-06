<?php
/**
*@package pXP
*@file gen-ACTTipoDocumentoSiat.php
*@author  (admin)
*@date 18-01-2019 14:58:05
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/
include "SiatClassWs.inc";

session_start();
class ACTTipoDocumentoSiat extends ACTbase{    
			
	function listarTipoDocumentoSiat(){
		$this->objParam->defecto('ordenacion','id_tipo_documento');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODTipoDocumentoSiat','listarTipoDocumentoSiat');
		} else{
			$this->objFunc=$this->create('MODTipoDocumentoSiat');
			
			$this->res=$this->objFunc->listarTipoDocumentoSiat($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarTipoDocumentoSiat(){
		$this->objFunc=$this->create('MODTipoDocumentoSiat');	
		if($this->objParam->insertar('id_tipo_documento')){
			$this->res=$this->objFunc->insertarTipoDocumentoSiat($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarTipoDocumentoSiat($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarTipoDocumentoSiat(){
			$this->objFunc=$this->create('MODTipoDocumentoSiat');	
		$this->res=$this->objFunc->eliminarTipoDocumentoSiat($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
	function insertarTipoDocumentoSiatWS(){
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
		$resultsinc = $wsSincroniza->ParametricaTipoDocumentoFiscal();
		$resultsinc_doc_identidad = $wsSincroniza->ParametricaTipoDocumentoIdentidad();
		$tipo='1';
		$tipo_identidad='2';
		
		//inserto los datos a las tablas
		//convierte resultado en array
        $r = $wsSincroniza->ConvertObjectToArray($resultsinc);
     
 				foreach($r['return']['listaCodigos'] as $r2)
			 	{
			 	  $codigo= $r2[codigoClasificador];
				  $descripcion= $r2[descripcion];
				  $this->objParam->addParametro('codigo',$codigo);
		 		  $this->objParam->addParametro('descripcion',$descripcion);	
				   $this->objParam->addParametro('tipo',$tipo);		
		    	  $this->objFunc=$this->create('MODTipoDocumentoSiat');	
				  $this->res=$this->objFunc->insertarTipoDocumentoSiat($this->objParam);			
		        }
         $r_identidad = $wsSincroniza->ConvertObjectToArray($resultsinc_doc_identidad);
     
 				foreach($r_identidad['return']['listaCodigos'] as $r21)
			 	{
			 	  $codigo1= $r21[codigoClasificador];
				  $descripcion1= $r21[descripcion];
				  $this->objParam->addParametro('codigo',$codigo1);
		 		  $this->objParam->addParametro('descripcion',$descripcion1);
				  $this->objParam->addParametro('tipo',$tipo_identidad);		
		    	  $this->objFunc=$this->create('MODTipoDocumentoSiat');	
				  $this->res=$this->objFunc->insertarTipoDocumentoSiat($this->objParam);			
		        }
		 

                $this->res->imprimirRespuesta($this->res->generarJson());
	    }
    				
}

?>