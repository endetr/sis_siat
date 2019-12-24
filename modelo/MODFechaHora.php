<?php
/**
*@package pXP
*@file gen-MODFechaHora.php
*@author  (jrivera)
*@date 20-12-2019 22:16:04
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				20-12-2019 22:16:04								CREACION

*/
include dirname(__FILE__).'/MODBaseSiat.php';
class MODFechaHora extends MODBaseSiat{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarFechaHora(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='siat.ft_fecha_hora_sel';
		$this->transaccion='SIA_FEHO_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_fecha_hora','int4');
		$this->captura('fecha_hora','varchar');
		$this->captura('estado_reg','varchar');
		$this->captura('fecha_reg','timestamp');
		$this->captura('usuario_ai','varchar');
		$this->captura('id_usuario_reg','int4');
		$this->captura('id_usuario_ai','int4');
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
			
	function insertarFechaHora($link, $fecha_hora ){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_fecha_hora_ime';
		$this->transaccion='SIA_FEHO_INS';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->resetParametros();		
		$this->addParametro('fecha_hora',$fecha_hora,'varchar');
		
		//Ejecuta la instruccion
		$this->armarConsulta();		
		$stmt = $link->prepare($this->consulta);          
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);               
		
		//recupera parametros devuelto depues de insertar 
		$resp_procedimiento = $this->divRespuesta($result['f_intermediario_ime']);		
		if ($resp_procedimiento['tipo_respuesta']=='ERROR') {			
			throw new Exception("Error al sincronizar fecha y hora  en la bd");
		}
	}
			
	function modificarFechaHora(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_fecha_hora_ime';
		$this->transaccion='SIA_FEHO_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_fecha_hora','id_fecha_hora','int4');
		$this->setParametro('fecha_hora','fecha_hora','varchar');
		$this->setParametro('estado_reg','estado_reg','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarFechaHora(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_fecha_hora_ime';
		$this->transaccion='SIA_FEHO_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_fecha_hora','id_fecha_hora','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function sincronizarFechaHora(){
		$cone = new conexion();
		$link = $cone->conectarpdo(); 
		try {
			$urlMetodo = $this->getUrlMetodoSincronizacion($link, 'sincronizacion', 'fecha_hora');			
			$cuis = $this->getCuis($link);
			$wsOperaciones= new WsFacturacionSincroniza(
				$urlMetodo[0],
				MODFunBasicas::getVariableGlobal('siat_ambiente'),//get config ambiente
				MODFunBasicas::getVariableGlobal('siat_codigo_sistema'), //get config codigo sistema 
				MODFunBasicas::getVariableGlobal('siat_nit'), //get config nit
				$cuis, // get cuis				
				0,//sucursal
				0 //punto venta
				);
			$resultop = $wsOperaciones->{$urlMetodo[1]}();
			$rop = $wsOperaciones->ConvertObjectToArray($resultop);			
			
			if (isset($rop['RespuestaFechaHora']['fechaHora'])) {
				
				$this->insertarFechaHora($link, $rop['RespuestaFechaHora']['fechaHora']);
			} else {
				throw new Exception("Ha ocurrido un error al sincronizar la fecha y hora ");
			}
			
			$this->respuesta=new Mensaje();
            $this->respuesta->setMensaje('EXITO',$this->nombre_archivo,'Procesamiento exitoso ','Procesamiento exitoso ','modelo',$this->nombre_archivo,'procesarServices','IME','');
           
		} catch (Exception $e) {			
			$this->respuesta=new Mensaje();
			$this->respuesta->setMensaje('ERROR',$this->nombre_archivo,$e->getMessage(),$e->getMessage(),'modelo','','','','');
		}		
		return $this->respuesta;
	}
			
}
?>