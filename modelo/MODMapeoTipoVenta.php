<?php
/**
*@package pXP
*@file gen-MODMapeoTipoVenta.php
*@author  (jrivera)
*@date 17-12-2019 02:51:47
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				17-12-2019 02:51:47								CREACION

*/

class MODMapeoTipoVenta extends MODbase{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarMapeoTipoVenta(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='siat.ft_mapeo_tipo_venta_sel';
		$this->transaccion='SIA_MATV_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_mapeo_tipo_venta','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_documento_fiscal','int4');
		$this->captura('id_documento_sector','int4');
		$this->captura('id_tipo_venta','int4');
		$this->captura('id_usuario_reg','int4');
		$this->captura('fecha_reg','timestamp');
		$this->captura('id_usuario_ai','int4');
		$this->captura('usuario_ai','varchar');
		$this->captura('id_usuario_mod','int4');
		$this->captura('fecha_mod','timestamp');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');
		$this->captura('desc_documento_fiscal','text');
		$this->captura('desc_documento_sector','text');
		$this->captura('desc_tipo_venta','text');
		
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();
		
		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function insertarMapeoTipoVenta(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_mapeo_tipo_venta_ime';
		$this->transaccion='SIA_MATV_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_documento_fiscal','id_documento_fiscal','int4');
		$this->setParametro('id_documento_sector','id_documento_sector','int4');
		$this->setParametro('id_tipo_venta','id_tipo_venta','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarMapeoTipoVenta(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_mapeo_tipo_venta_ime';
		$this->transaccion='SIA_MATV_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_mapeo_tipo_venta','id_mapeo_tipo_venta','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_documento_fiscal','id_documento_fiscal','int4');
		$this->setParametro('id_documento_sector','id_documento_sector','int4');
		$this->setParametro('id_tipo_venta','id_tipo_venta','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarMapeoTipoVenta(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_mapeo_tipo_venta_ime';
		$this->transaccion='SIA_MATV_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_mapeo_tipo_venta','id_mapeo_tipo_venta','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
}
?>