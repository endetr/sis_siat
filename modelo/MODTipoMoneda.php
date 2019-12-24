<?php
/**
*@package pXP
*@file gen-MODTipoMoneda.php
*@author  (admin)
*@date 18-01-2019 13:59:47
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/
include dirname(__FILE__).'/MODBaseSiat.php';
class MODTipoMoneda extends MODBaseSiat{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarTipoMoneda(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='siat.ft_tipo_moneda_sel';
		$this->transaccion='SIA_MONSIA_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_tipo_moneda','int4');
		$this->captura('codigo','numeric');
		$this->captura('descripcion','varchar');
		$this->captura('estado_reg','varchar');
		$this->captura('id_usuario_ai','int4');
		$this->captura('id_usuario_reg','int4');
		$this->captura('usuario_ai','varchar');
		$this->captura('fecha_reg','timestamp');
		$this->captura('fecha_mod','timestamp');
		$this->captura('id_usuario_mod','int4');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');
		$this->captura('codigo_pxp','varchar');
		
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();
		
		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function insertarTipoMoneda(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_tipo_moneda_ime';
		$this->transaccion='SIA_MONSIA_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('codigo','codigo','numeric');
		$this->setParametro('descripcion','descripcion','varchar');
		$this->setParametro('estado_reg','estado_reg','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarTipoMoneda(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_tipo_moneda_ime';
		$this->transaccion='SIA_MONSIA_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_tipo_moneda','id_tipo_moneda','int4');
		$this->setParametro('codigo_pxp','codigo_pxp','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarTipoMoneda(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_tipo_moneda_ime';
		$this->transaccion='SIA_MONSIA_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_tipo_moneda','id_tipo_moneda','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function sincronizarTipoMoneda(){
		$this->respuesta = $this->sincronizar('sincronizacion','tipo_moneda','ttipo_moneda');
		return $this->respuesta;
	}
			
}
?>