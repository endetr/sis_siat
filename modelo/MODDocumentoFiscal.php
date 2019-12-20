<?php
/**
*@package pXP
*@file gen-MODDocumentoFiscal.php
*@author  (jrivera)
*@date 17-12-2019 10:42:00
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				17-12-2019 10:42:00								CREACION

*/
include dirname(__FILE__).'/MODBaseSiat.php';
class MODDocumentoFiscal extends MODBaseSiat{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarDocumentoFiscal(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='siat.ft_documento_fiscal_sel';
		$this->transaccion='SIA_DOCFIS_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_documento_fiscal','int4');
		$this->captura('codigo','varchar');
		$this->captura('estado_reg','varchar');
		$this->captura('descripcion','text');
		$this->captura('id_usuario_reg','int4');
		$this->captura('usuario_ai','varchar');
		$this->captura('fecha_reg','timestamp');
		$this->captura('id_usuario_ai','int4');
		$this->captura('fecha_mod','timestamp');
		$this->captura('id_usuario_mod','int4');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');
		
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();
		
		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function insertarDocumentoFiscal(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_documento_fiscal_ime';
		$this->transaccion='SIA_DOCFIS_INS';
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
			
	function modificarDocumentoFiscal(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_documento_fiscal_ime';
		$this->transaccion='SIA_DOCFIS_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_documento_fiscal','id_documento_fiscal','int4');
		$this->setParametro('codigo','codigo','varchar');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('descripcion','descripcion','text');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarDocumentoFiscal(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_documento_fiscal_ime';
		$this->transaccion='SIA_DOCFIS_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_documento_fiscal','id_documento_fiscal','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function sincronizarDocumentoFiscal(){
		$this->respuesta = $this->sincronizar('sincronizacion','tipo_documento_fiscal','tdocumento_fiscal');
		return $this->respuesta;
	}
			
}
?>