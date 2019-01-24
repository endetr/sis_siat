<?php
/**
*@package pXP
*@file gen-MODSaludSistema.php
*@author  (admin)
*@date 24-01-2019 19:34:45
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/

class MODSaludSistema extends MODbase{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarSaludSistema(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='siat.ft_salud_sistema_sel';
		$this->transaccion='SIA_EVSA_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_salud_sistema','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('codigo_evento','varchar');
		$this->captura('description_salud','varchar');
		$this->captura('fecha_salud','timestamp');
		$this->captura('fk_sucursal','int4');
		$this->captura('nombre_sucursal','varchar');
		$this->captura('usuario_ai','varchar');
		$this->captura('fecha_reg','timestamp');
		$this->captura('id_usuario_reg','int4');
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
			
	function insertarSaludSistema(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_salud_sistema_ime';
		$this->transaccion='SIA_EVSA_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('codigo_evento','codigo_evento','varchar');
		$this->setParametro('description_salud','description_salud','varchar');
		$this->setParametro('fecha_salud','fecha_salud','timestamp');
		$this->setParametro('fk_sucursal','fk_sucursal','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarSaludSistema(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_salud_sistema_ime';
		$this->transaccion='SIA_EVSA_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_salud_sistema','id_salud_sistema','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('codigo_evento','codigo_evento','varchar');
		$this->setParametro('description_salud','description_salud','varchar');
		$this->setParametro('fecha_salud','fecha_salud','timestamp');
		$this->setParametro('fk_sucursal','fk_sucursal','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarSaludSistema(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_salud_sistema_ime';
		$this->transaccion='SIA_EVSA_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_salud_sistema','id_salud_sistema','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
}
?>