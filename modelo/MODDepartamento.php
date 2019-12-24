<?php
/**
*@package pXP
*@file gen-MODDepartamento.php
*@author  (jrivera)
*@date 20-12-2019 22:16:01
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				20-12-2019 22:16:01								CREACION

*/
include dirname(__FILE__).'/MODBaseSiat.php';
class MODDepartamento extends MODBaseSiat{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarDepartamento(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='siat.ft_departamento_sel';
		$this->transaccion='SIA_DEPA_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_departamento','int4');
		$this->captura('codigo','varchar');
		$this->captura('descripcion','text');
		$this->captura('estado_reg','varchar');
		$this->captura('id_usuario_ai','int4');
		$this->captura('id_usuario_reg','int4');
		$this->captura('fecha_reg','timestamp');
		$this->captura('usuario_ai','varchar');
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
			
	function insertarDepartamento(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_departamento_ime';
		$this->transaccion='SIA_DEPA_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('codigo','codigo','varchar');
		$this->setParametro('descripcion','descripcion','text');
		$this->setParametro('estado_reg','estado_reg','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarDepartamento(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_departamento_ime';
		$this->transaccion='SIA_DEPA_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_departamento','id_departamento','int4');
		$this->setParametro('codigo','codigo','varchar');
		$this->setParametro('descripcion','descripcion','text');
		$this->setParametro('estado_reg','estado_reg','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarDepartamento(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_departamento_ime';
		$this->transaccion='SIA_DEPA_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_departamento','id_departamento','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function sincronizarDepartamento(){
		$this->respuesta = $this->sincronizar('sincronizacion','tipo_departamento','tdepartamento');
		return $this->respuesta;
	}
			
}
?>