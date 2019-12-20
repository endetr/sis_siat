<?php
/**
*@package pXP
*@file gen-MODGestorDocumento.php
*@author  (jrivera)
*@date 16-12-2019 11:32:11
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				16-12-2019 11:32:11								CREACION

*/

class MODGestorDocumento extends MODbase{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarGestorDocumento(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='siat.ft_gestor_documento_sel';
		$this->transaccion='SIA_GESDOC_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_gestor_documento','int4');
		$this->captura('tipo','varchar');
		$this->captura('contenido_base64_corrida1','text');
		$this->captura('hash','varchar');
		$this->captura('metodo_servicio','varchar');
		$this->captura('id_venta','int4');
		$this->captura('url_servicio','varchar');
		$this->captura('estado_reg','varchar');
		$this->captura('estado','varchar');
		$this->captura('contenido_base64_corrida2','text');
		$this->captura('id_usuario_ai','int4');
		$this->captura('usuario_ai','varchar');
		$this->captura('fecha_reg','timestamp');
		$this->captura('id_usuario_reg','int4');
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
			
	function insertarGestorDocumento(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_gestor_documento_ime';
		$this->transaccion='SIA_GESDOC_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('tipo','tipo','varchar');
		$this->setParametro('contenido_base64_corrida1','contenido_base64_corrida1','text');
		$this->setParametro('hash','hash','varchar');
		$this->setParametro('metodo_servicio','metodo_servicio','varchar');
		$this->setParametro('id_venta','id_venta','int4');
		$this->setParametro('url_servicio','url_servicio','varchar');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('estado','estado','varchar');
		$this->setParametro('contenido_base64_corrida2','contenido_base64_corrida2','text');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarGestorDocumento(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_gestor_documento_ime';
		$this->transaccion='SIA_GESDOC_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_gestor_documento','id_gestor_documento','int4');
		$this->setParametro('tipo','tipo','varchar');
		$this->setParametro('contenido_base64_corrida1','contenido_base64_corrida1','text');
		$this->setParametro('hash','hash','varchar');
		$this->setParametro('metodo_servicio','metodo_servicio','varchar');
		$this->setParametro('id_venta','id_venta','int4');
		$this->setParametro('url_servicio','url_servicio','varchar');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('estado','estado','varchar');
		$this->setParametro('contenido_base64_corrida2','contenido_base64_corrida2','text');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarGestorDocumento(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_gestor_documento_ime';
		$this->transaccion='SIA_GESDOC_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_gestor_documento','id_gestor_documento','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
}
?>