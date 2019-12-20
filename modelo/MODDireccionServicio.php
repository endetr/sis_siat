<?php
/**
*@package pXP
*@file gen-MODDireccionServicio.php
*@author  (jrivera)
*@date 16-12-2019 11:32:48
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				16-12-2019 11:32:48								CREACION

*/

class MODDireccionServicio extends MODbase{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarDireccionServicio(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='siat.ft_direccion_servicio_sel';
		$this->transaccion='SIA_DIRSER_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_direccion_servicio','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_documento_sector','int4');
		$this->captura('validacion','varchar');
		$this->captura('id_documento_fiscal','int4');
		$this->captura('subtipo','varchar');
		$this->captura('validacion_anulacion','varchar');
		$this->captura('url','varchar');
		$this->captura('tipo','varchar');
		$this->captura('recepcion','varchar');
		$this->captura('recepcion_anulacion','varchar');
		$this->captura('usuario_ai','varchar');
		$this->captura('fecha_reg','timestamp');
		$this->captura('id_usuario_reg','int4');
		$this->captura('id_usuario_ai','int4');
		$this->captura('id_usuario_mod','int4');
		$this->captura('fecha_mod','timestamp');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');
		$this->captura('desc_documento_fiscal','text');
		$this->captura('desc_documento_sector','text');
		
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();
		
		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function insertarDireccionServicio(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_direccion_servicio_ime';
		$this->transaccion='SIA_DIRSER_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_documento_sector','id_documento_sector','int4');
		$this->setParametro('validacion','validacion','varchar');
		$this->setParametro('id_documento_fiscal','id_documento_fiscal','int4');
		$this->setParametro('subtipo','subtipo','varchar');
		$this->setParametro('validacion_anulacion','validacion_anulacion','varchar');
		$this->setParametro('url','url','varchar');
		$this->setParametro('tipo','tipo','varchar');
		$this->setParametro('recepcion','recepcion','varchar');
		$this->setParametro('recepcion_anulacion','recepcion_anulacion','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarDireccionServicio(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_direccion_servicio_ime';
		$this->transaccion='SIA_DIRSER_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_direccion_servicio','id_direccion_servicio','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_documento_sector','id_documento_sector','int4');
		$this->setParametro('validacion','validacion','varchar');
		$this->setParametro('id_documento_fiscal','id_documento_fiscal','int4');
		$this->setParametro('subtipo','subtipo','varchar');
		$this->setParametro('validacion_anulacion','validacion_anulacion','varchar');
		$this->setParametro('url','url','varchar');
		$this->setParametro('tipo','tipo','varchar');
		$this->setParametro('recepcion','recepcion','varchar');
		$this->setParametro('recepcion_anulacion','recepcion_anulacion','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarDireccionServicio(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_direccion_servicio_ime';
		$this->transaccion='SIA_DIRSER_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_direccion_servicio','id_direccion_servicio','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
}
?>