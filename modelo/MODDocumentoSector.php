<?php
/**
*@package pXP
*@file gen-MODDocumentoSector.php
*@author  (jrivera)
*@date 17-12-2019 10:41:56
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				17-12-2019 10:41:56								CREACION

*/
include dirname(__FILE__).'/MODBaseSiat.php';
class MODDocumentoSector extends MODBaseSiat{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarDocumentoSector(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='siat.ft_documento_sector_sel';
		$this->transaccion='SIA_DCOSEC_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_documento_sector','int4');
		$this->captura('codigo','varchar');
		$this->captura('estado_reg','varchar');
		$this->captura('descripcion','text');
		$this->captura('id_usuario_reg','int4');
		$this->captura('fecha_reg','timestamp');
		$this->captura('usuario_ai','varchar');
		$this->captura('id_usuario_ai','int4');
		$this->captura('id_usuario_mod','int4');
		$this->captura('fecha_mod','timestamp');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');
		
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();
		
		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function insertarDocumentoSector(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_documento_sector_ime';
		$this->transaccion='SIA_DCOSEC_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('codigo','codigo','varchar');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('descripcion','descripcion','text');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarDocumentoSector(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_documento_sector_ime';
		$this->transaccion='SIA_DCOSEC_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_documento_sector','id_documento_sector','int4');
		$this->setParametro('codigo','codigo','varchar');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('descripcion','descripcion','text');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarDocumentoSector(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_documento_sector_ime';
		$this->transaccion='SIA_DCOSEC_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_documento_sector','id_documento_sector','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function sincronizarDocumentoSector(){
		$this->respuesta = $this->sincronizar('sincronizacion','tipo_documento_sector','tdocumento_sector');
		return $this->respuesta;
	}
			
}
?>