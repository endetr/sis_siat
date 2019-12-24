<?php
/**
*@package pXP
*@file gen-MODUnidadMedida.php
*@author  (jrivera)
*@date 20-12-2019 22:12:50
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				20-12-2019 22:12:50								CREACION

*/
include dirname(__FILE__).'/MODBaseSiat.php';
class MODUnidadMedida extends MODBaseSiat{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarUnidadMedida(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='siat.ft_unidad_medida_sel';
		$this->transaccion='SIA_UNIMED_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_unidad_medida','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('codigo','varchar');
		$this->captura('descripcion','text');
		$this->captura('id_usuario_reg','int4');
		$this->captura('fecha_reg','timestamp');
		$this->captura('id_usuario_ai','int4');
		$this->captura('usuario_ai','varchar');
		$this->captura('id_usuario_mod','int4');
		$this->captura('fecha_mod','timestamp');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');
		$this->captura('codigo_pxp','varchar');
		
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();
		
		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function insertarUnidadMedida(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_unidad_medida_ime';
		$this->transaccion='SIA_UNIMED_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('codigo','codigo','varchar');
		$this->setParametro('descripcion','descripcion','text');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarUnidadMedida(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_unidad_medida_ime';
		$this->transaccion='SIA_UNIMED_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_unidad_medida','id_unidad_medida','int4');		
		$this->setParametro('codigo_pxp','codigo_pxp','varchar');
		

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarUnidadMedida(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_unidad_medida_ime';
		$this->transaccion='SIA_UNIMED_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_unidad_medida','id_unidad_medida','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function sincronizarUnidadMedida(){
		$this->respuesta = $this->sincronizar('sincronizacion','unidad_medida','tunidad_medida');
		return $this->respuesta;
	}
			
}
?>