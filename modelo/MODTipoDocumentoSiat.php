<?php
/**
*@package pXP
*@file gen-MODTipoDocumentoSiat.php
*@author  (admin)
*@date 18-01-2019 14:58:05
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/

class MODTipoDocumentoSiat extends MODbase{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarTipoDocumentoSiat(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='siat.ft_tipo_documento_siat_sel';
		$this->transaccion='SIA_DOCSIA_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_tipo_documento','int4');
		$this->captura('codigo','numeric');
		$this->captura('descripcion','varchar');
		$this->captura('estado_reg','varchar');
		$this->captura('tipo','varchar');
		$this->captura('fecha_reg','timestamp');
		$this->captura('id_usuario_ai','int4');
		$this->captura('id_usuario_reg','int4');
		$this->captura('usuario_ai','varchar');
		$this->captura('fecha_mod','timestamp');
		$this->captura('id_usuario_mod','int4');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');
		$this->captura('desc_tipo','text');
		
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();
		
		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function insertarTipoDocumentoSiat(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_tipo_documento_siat_ime';
		$this->transaccion='SIA_DOCSIA_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('codigo','codigo','numeric');
		$this->setParametro('descripcion','descripcion','varchar');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('tipo','tipo','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarTipoDocumentoSiat(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_tipo_documento_siat_ime';
		$this->transaccion='SIA_DOCSIA_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_tipo_documento','id_tipo_documento','int4');
		$this->setParametro('codigo','codigo','numeric');
		$this->setParametro('descripcion','descripcion','varchar');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('tipo','tipo','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarTipoDocumentoSiat(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_tipo_documento_siat_ime';
		$this->transaccion='SIA_DOCSIA_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_tipo_documento','id_tipo_documento','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
}
?>