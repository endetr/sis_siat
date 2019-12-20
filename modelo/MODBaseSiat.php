<?php
/**
*@package pXP
*@file MODBaseSiat.php
*@author  (jrivera)
*@date 17-12-2019 10:42:00
*@description Clase con funcionalidades genericas siat
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				17-12-2019 10:42:00								CREACION

*/
include dirname(__FILE__).'/../lib/SiatClassWs.inc';
class MODBaseSiat extends MODbase{
    function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
	function sincronizar($tipo, $subtipo, $tabla){
		$cone = new conexion();
		$link = $cone->conectarpdo(); 
		                  
        try {
			$urlMetodo = $this->getUrlMetodoSincronizacion($link, $tipo, $subtipo);
			$cantidadRegistros = $this->getCantidadRegistrosTabla($link, $tabla);
			$cuis = $this->getCuis($link);			
			$autorizacion = $cantidadRegistros != '0' ? '0' : '1000000';
			$wsOperaciones= new WsFacturacionSincroniza(
				$urlMetodo[0],
				MODFunBasicas::getVariableGlobal('siat_ambiente'),//get config ambiente
				MODFunBasicas::getVariableGlobal('siat_codigo_sistema'), //get config codigo sistema 
				MODFunBasicas::getVariableGlobal('siat_nit'), //get config nit
				$cuis, // get cuis
				0,
				0,
				$autorizacion);
			$resultop = $wsOperaciones->{$urlMetodo[1]}();
			$rop = $wsOperaciones->ConvertObjectToArray($resultop);
			//var_dump($rop);
			if (isset($rop['RespuestaListaParametricas']['listaCodigos'])) {
				$this->insertaTablaSincronizacion($link, $tabla, $rop['RespuestaListaParametricas']['listaCodigos']);
			} else if (isset($rop['RespuestaListaParametricas']['listaCodigosRespuestas']['codigoMensaje'])) {
				$mensaje = $this->getMensajeSoap($link, $rop['RespuestaListaParametricas']['listaCodigosRespuestas']['codigoMensaje']);
				throw new Exception("{$mensaje} para : {$tipo} , {$subtipo} ");
			} else {
				throw new Exception("Ha ocurrido un error al sincronizar el catalogo ");
			}
			
			$this->respuesta=new Mensaje();
            $this->respuesta->setMensaje('EXITO',$this->nombre_archivo,'Procesamiento exitoso ','Procesamiento exitoso ','modelo',$this->nombre_archivo,'procesarServices','IME','');
           
		} catch (Exception $e) {			
			$this->respuesta=new Mensaje();
			$this->respuesta->setMensaje('ERROR',$this->nombre_archivo,$e->getMessage(),$e->getMessage(),'modelo','','','','');
		}
		return $this->respuesta;
	}
	function getUrlMetodoSincronizacion($link, $tipo, $subtipo){
		$resArray = array();
		$sql = "SELECT  url, recepcion
				FROM siat.tdireccion_servicio 
				WHERE tipo = '{$tipo}' and subtipo = '{$subtipo}'";

        foreach ($link->query($sql) as $row) {
            $resArray = array($row['url'],$row['recepcion']);
		}
		if (empty($resArray)) {
			throw new Exception("No existe direccion configurada para la sincronizacion: {$tipo} , {$subtipo} ");
	   	}
		return $resArray;
	}

	function getCuis($link){
		$codigo = '';
		$sql = "SELECT  codigo
				FROM siat.tcuis 
				WHERE now() between fecha_inicio and fecha_fin";

        foreach ($link->query($sql) as $row) {
            $codigo = $row['codigo'];
		}
		if ($codigo == '') {
			throw new Exception("No existe codigo cuis valido en este momento");
	   	}
		return $codigo;
	}

	function getMensajeSoap($link, $codigo){
		$mensaje = '';
		$sql = "SELECT  descripcion
				FROM siat.tmensaje_soap 
				WHERE codigo = {$codigo}";

        foreach ($link->query($sql) as $row) {
            $mensaje = $row['descripcion'];
		}
		if ($mensaje == '') {
			throw new Exception("No existe mensaje soap para codigo: {$codigo}");
	   	}
		return $mensaje;
	}

	function getCantidadRegistrosTabla($link, $tabla){
		$sql = "SELECT  count(*) as cantidad
				FROM siat.{$tabla}";

        foreach ($link->query($sql) as $row) {
            $cantidad = $row['cantidad'];
		}
		return $cantidad;
	}
	function verificarProcesamiento($link) {
        $sql = "SELECT  valor
				FROM pxp.variable_global 
				WHERE variable = 'siat_processing'";
        foreach ($link->query($sql) as $row) {
            $valor = $row['valor'];
        }
        if ($valor == 'si') {
            return $valor;
        } else {
            $this->modificaProcesamiento($link,'si');
            return 'no';
        }
    }
    function modificaProcesamiento($link, $valor) {
        $sql = "UPDATE  pxp.variable_global 
				SET valor = '" . $valor . "'
				WHERE variable = 'sigep_processing'";
        $stmt = $link->prepare($sql);
        $stmt->execute();
	}
	
	function insertaTablaSincronizacion($link, $tabla, $datos) {
		
		foreach ($datos as $key => $value) {
			$sql = "INSERT INTO siat.{$tabla} (id_usuario_reg,codigo, descripcion)
					VALUES ({$_SESSION["ss_id_usuario"]}, '{$value['codigoClasificador']}','{$value['descripcion']}')
					ON CONFLICT (codigo) DO UPDATE SET descripcion = EXCLUDED.descripcion;";
			
			$stmt = $link->prepare($sql);
			$stmt->execute();
		}
		
    }
}