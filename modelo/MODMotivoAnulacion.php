<?php
/**
*@package pXP
*@file gen-MODMotivoAnulacion.php
*@author  (ana.villegas)
*@date 31-01-2019 16:28:10
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/
include dirname(__FILE__).'/MODBaseSiat.php';
class MODMotivoAnulacion extends MODBaseSiat{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarMotivoAnulacion(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='siat.ft_motivo_anulacion_sel';
		$this->transaccion='SIA_MOTANU_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_motivo_anulacion','int4');
		$this->captura('codigo','numeric');
		$this->captura('estado_reg','varchar');
		$this->captura('descripcion','varchar');
		$this->captura('id_usuario_reg','int4');
		$this->captura('usuario_ai','varchar');
		$this->captura('fecha_reg','timestamp');
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
			
	function insertarMotivoAnulacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_motivo_anulacion_ime';
		$this->transaccion='SIA_MOTANU_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('codigo','codigo','numeric');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('descripcion','descripcion','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarMotivoAnulacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_motivo_anulacion_ime';
		$this->transaccion='SIA_MOTANU_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_motivo_anulacion','id_motivo_anulacion','int4');
		$this->setParametro('codigo','codigo','numeric');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('descripcion','descripcion','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarMotivoAnulacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_motivo_anulacion_ime';
		$this->transaccion='SIA_MOTANU_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_motivo_anulacion','id_motivo_anulacion','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function sincronizarMotivoAnulacion(){
		$this->respuesta = $this->sincronizar('sincronizacion','motivos_anulacion','tmotivo_anulacion');
		return $this->respuesta;
	}
			
}
?>