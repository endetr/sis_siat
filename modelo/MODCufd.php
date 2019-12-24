<?php
/**
*@package pXP
*@file gen-MODCufd.php
*@author  (admin)
*@date 22-01-2019 02:23:54
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/
include dirname(__FILE__).'/MODBaseSiat.php';
class MODCufd extends MODBaseSiat{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarCufd(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='siat.ft_cufd_sel';
		$this->transaccion='SIA_CUFD_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_cufd','int4');
		$this->captura('codigo','varchar');
		$this->captura('fecha_inicio','timestamp');
		$this->captura('fecha_fin','timestamp');
		$this->captura('estado_reg','varchar');
		$this->captura('id_cuis','int4');
		$this->captura('id_usuario_ai','int4');
		$this->captura('id_usuario_reg','int4');
		$this->captura('usuario_ai','varchar');
		$this->captura('fecha_reg','timestamp');
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
		
		
	
	function insertarCufd($link, $codigo, $fecha_vigencia){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_cufd_ime';
		$this->transaccion='SIA_CUFD_INS';
		$this->tipo_procedimiento='IME';				
		
		//Define los parametros para la funcion
		$this->resetParametros();		
		$this->addParametro('codigo',$codigo,'varchar');
		$this->addParametro('fecha_fin',$fecha_vigencia,'varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$stmt = $link->prepare($this->consulta);          
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);               
		
		//recupera parametros devuelto depues de insertar 
		$resp_procedimiento = $this->divRespuesta($result['f_intermediario_ime']);	
		var_dump($resp_procedimiento);	
		exit;
		if ($resp_procedimiento['tipo_respuesta']=='ERROR') {			
			throw new Exception("Error al registrar cufd");
		}
	}
			
	function modificarCufd(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_cufd_ime';
		$this->transaccion='SIA_CUFD_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_cufd','id_cufd','int4');
		$this->setParametro('codigo','codigo','varchar');
		$this->setParametro('fecha_inicio','fecha_inicio','timestamp');
		$this->setParametro('fecha_fin','fecha_fin','timestamp');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_cuis','id_cuis','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarCufd(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_cufd_ime';
		$this->transaccion='SIA_CUFD_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_cufd','id_cufd','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
	

	function registrarCufd(){
		$cone = new conexion();
		$link = $cone->conectarpdo(); 
		try {
			$urlMetodo = $this->getUrlMetodoSincronizacion($link, 'cufd', 'cufd');			
			$cuis = $this->getCuis($link);
			$wsOperaciones= new WsFacturacionOperaciones(
				$urlMetodo[0],
				MODFunBasicas::getVariableGlobal('siat_ambiente'),//get config ambiente
				MODFunBasicas::getVariableGlobal('siat_codigo_sistema'), //get config codigo sistema 
				MODFunBasicas::getVariableGlobal('siat_modalidad'), //get config modalidad
				MODFunBasicas::getVariableGlobal('siat_nit'), //get config nit
				$cuis, // get cuis				
				0,//sucursal
				0 //punto venta
				);
			$resultop = $wsOperaciones->{$urlMetodo[1]}();
			$rop = $wsOperaciones->ConvertObjectToArray($resultop);			
			
			if (isset($rop['RespuestaCufd'])) {
				
				$this->insertarCufd($link, $rop['RespuestaCufd']['codigo'], $rop['RespuestaCufd']['fechaVigencia']);
			} else {
				throw new Exception("Ha ocurrido un error al obtener cufd ");
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