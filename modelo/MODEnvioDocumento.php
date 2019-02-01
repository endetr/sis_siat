<?php
/**
*@package pXP
*@file gen-MODEnvioDocumento.php
*@author  (admin)
*@date 31-01-2019 13:06:14
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/

class MODEnvioDocumento extends MODbase{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarEnvioDocumento(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='siat.ft_envio_documento_sel';
		$this->transaccion='SIA_ENDOCF_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_envio_documento','int4');
		$this->captura('nro_documento','int4');
		$this->captura('fecha_emision','timestamp');
		$this->captura('cuf','varchar');
		$this->captura('estado_reg','varchar');
		$this->captura('monto','numeric');
		$this->captura('estado','varchar');
		$this->captura('modo_envio','varchar');
		$this->captura('id_usuario_ai','int4');
		$this->captura('fecha_reg','timestamp');
		$this->captura('usuario_ai','varchar');
		$this->captura('id_usuario_reg','int4');
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
			
	function insertarEnvioDocumento(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_envio_documento_ime';
		$this->transaccion='SIA_ENDOCF_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('nro_documento','nro_documento','int4');
		$this->setParametro('fecha_emision','fecha_emision','timestamp');
		$this->setParametro('cuf','cuf','varchar');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('monto','monto','numeric');
		$this->setParametro('estado','estado','varchar');
		$this->setParametro('modo_envio','modo_envio','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarEnvioDocumento(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_envio_documento_ime';
		$this->transaccion='SIA_ENDOCF_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_envio_documento','id_envio_documento','int4');
		$this->setParametro('nro_documento','nro_documento','int4');
		$this->setParametro('fecha_emision','fecha_emision','timestamp');
		$this->setParametro('cuf','cuf','varchar');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('monto','monto','numeric');
		$this->setParametro('estado','estado','varchar');
		$this->setParametro('modo_envio','modo_envio','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarEnvioDocumento(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_envio_documento_ime';
		$this->transaccion='SIA_ENDOCF_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_envio_documento','id_envio_documento','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
}
?>