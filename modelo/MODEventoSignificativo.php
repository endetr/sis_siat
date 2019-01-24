<?php
/**
*@package pXP
*@file gen-MODEventoSignificativo.php
*@author  (admin)
*@date 21-01-2019 22:24:59
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/

class MODEventoSignificativo extends MODbase{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarEventoSignificativo(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='siat.ft_evento_significativo_sel';
		$this->transaccion='SIA_EVSI_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_evento_significativo','int4');
		$this->captura('fk_sucursal','int4');
		$this->captura('description','varchar');
		$this->captura('estado_reg','varchar');
		$this->captura('fecha_fin','timestamp');
		$this->captura('codigo_evento','varchar');
		$this->captura('fecha_ini','timestamp');
		$this->captura('usuario_ai','varchar');
		$this->captura('fecha_reg','timestamp');
		$this->captura('id_usuario_reg','int4');
		$this->captura('id_usuario_ai','int4');
		$this->captura('fecha_mod','timestamp');
		$this->captura('id_usuario_mod','int4');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');
		$this->captura('nombre','varchar');
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();
		
		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function insertarEventoSignificativo(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_evento_significativo_ime';
		$this->transaccion='SIA_EVSI_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('fk_sucursal','fk_sucursal','int4');
		$this->setParametro('description','description','varchar');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('fecha_fin','fecha_fin','timestamp');
		$this->setParametro('codigo_evento','codigo_evento','varchar');
		$this->setParametro('fecha_ini','fecha_ini','timestamp');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarEventoSignificativo(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_evento_significativo_ime';
		$this->transaccion='SIA_EVSI_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_evento_significativo','id_evento_significativo','int4');
		$this->setParametro('fk_sucursal','fk_sucursal','int4');
		$this->setParametro('description','description','varchar');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('fecha_fin','fecha_fin','timestamp');
		$this->setParametro('codigo_evento','codigo_evento','varchar');
		$this->setParametro('fecha_ini','fecha_ini','timestamp');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarEventoSignificativo(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_evento_significativo_ime';
		$this->transaccion='SIA_EVSI_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_evento_significativo','id_evento_significativo','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
}
?>