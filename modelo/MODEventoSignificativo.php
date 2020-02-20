<?php
/**
*@package pXP
*@file gen-MODEventoSignificativo.php
*@author  (admin)
*@date 21-01-2019 22:24:59
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/
include dirname(__FILE__).'/MODBaseSiat.php';
class MODEventoSignificativo extends MODBaseSiat{
	
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
		$this->captura('codigo_sucursal','varchar');
		
		$this->captura('codigo_punto_venta','varchar');
		$this->captura('description','varchar');
		$this->captura('estado_reg','varchar');
		$this->captura('fecha_fin','date');
		$this->captura('id_evento','int4');
		$this->captura('fecha_ini','date');
		$this->captura('usuario_ai','varchar');
		$this->captura('fecha_reg','timestamp');
		$this->captura('id_usuario_reg','int4');
		$this->captura('id_usuario_ai','int4');
		$this->captura('fecha_mod','timestamp');
		$this->captura('id_usuario_mod','int4');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');
		$this->captura('hora_ini','varchar');
		$this->captura('hora_fin','varchar');
		$this->captura('desc_evento','varchar');
		$this->captura('codigo_evento','varchar');
		
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

		$cone = new conexion();
		$link = $cone->conectarpdo(); 
		try {
			$urlMetodoIni = $this->getUrlMetodoSincronizacion($link, 'eventos', 'evento_significativo_inicio');
			$urlMetodoFin = $this->getUrlMetodoSincronizacion($link, 'eventos', 'evento_significativo_fin');			
			$cuis = $this->getCuis($link);
			$codigo_sucursal = $this->objParam->getParametro('codigo_sucursal');
			$codigo_punto_venta = $this->objParam->getParametro('codigo_punto_venta');
			$descripcion = $this->objParam->getParametro('codigo_sucursal');
			$codigo_tipo_evento = $this->getCodigoTipoEvento($link, $this->objParam->getParametro('id_evento'));
			$fecha_ini = DateTime::createFromFormat('d/m/Y G:i:s', $this->objParam->getParametro('fecha_ini') . ' ' . $this->objParam->getParametro('hora_ini'));
			$fecha_ini_formato = $fecha_ini->format('Y-m-dH:i:s.000');
			$fecha_ini_formato = substr($fecha_ini_formato, 0, 10) . 'T' . substr($fecha_ini_formato, 10);
			$fecha_fin = DateTime::createFromFormat('d/m/Y G:i:s', $this->objParam->getParametro('fecha_fin') . ' ' . $this->objParam->getParametro('hora_fin'));			
			$fecha_fin_formato = $fecha_fin->format('Y-m-dH:i:s.000');
			$fecha_fin_formato = substr($fecha_fin_formato, 0, 10) . 'T' . substr($fecha_fin_formato, 10);
			$cufd = $this->getCufd($link, $codigo_sucursal, $codigo_punto_venta);
			
			//inicio de evento
			$wsOperaciones= new WsFacturacionOperaciones(
				$urlMetodoIni[0],
				MODFunBasicas::getVariableGlobal('siat_ambiente'),//get config ambiente
				MODFunBasicas::getVariableGlobal('siat_codigo_sistema'), //get config codigo sistema 
				MODFunBasicas::getVariableGlobal('siat_modalidad'), 
				MODFunBasicas::getVariableGlobal('siat_nit'), //get config nit
				$cuis, // get cuis				
				$codigo_sucursal,//sucursal
				$codigo_punto_venta, //punto venta
				'',//nombre punto de venta no es util para este servicio
				0,//codigo punto de venta no es util para este servicio
				$descripcion,//descripcion evento
				$codigo_tipo_evento,//codigo evento significativo
				$fecha_ini_formato,//"2019-11-22T08:53:16.987",
				$cufd
				);
			$resultop = $wsOperaciones->{$urlMetodoIni[1]}();
			$rop = $wsOperaciones->ConvertObjectToArray($resultop);	
			
			if (isset($rop['RespuestaListaEventos']['codigoRecepcionEventoSignificativo'])) {				
				$codigo_evento = $rop['RespuestaListaEventos']['codigoRecepcionEventoSignificativo'];
				//fin evento
				$wsOperaciones= new WsFacturacionOperaciones(
					$urlMetodoFin[0],
					MODFunBasicas::getVariableGlobal('siat_ambiente'),//get config ambiente
					MODFunBasicas::getVariableGlobal('siat_codigo_sistema'), //get config codigo sistema 
					MODFunBasicas::getVariableGlobal('siat_modalidad'), 
					MODFunBasicas::getVariableGlobal('siat_nit'), //get config nit
					$cuis, // get cuis				
					$codigo_sucursal,//sucursal
					$codigo_punto_venta, //punto venta
					'',//nombre punto de venta no es util para este servicio
					0,//codigo punto de venta no es util para este servicio
					$descripcion,//descripcion evento
					$codigo_tipo_evento,//codigo evento significativo
					$fecha_ini_formato,//"2019-11-22T08:53:16.987",
					$cufd,
					$fecha_fin_formato,
					$codigo_evento
					);
				
				$resultop = $wsOperaciones->{$urlMetodoFin[1]}();
				$rop = $wsOperaciones->ConvertObjectToArray($resultop);
				//registro de inicio y fin exitoso ahora se puede registrar en la bd
				if ($rop['RespuestaListaEventos']['transaccion']) {	
					$this->setParametro('description','description','varchar');	
					$this->setParametro('codigo_sucursal','codigo_sucursal','varchar');
					$this->setParametro('codigo_punto_venta','codigo_punto_venta','varchar');
					$this->setParametro('id_evento','id_evento','integer');	
					$this->setParametro('fecha_fin','fecha_fin','date');		
					$this->setParametro('fecha_ini','fecha_ini','date');
					$this->setParametro('hora_ini','hora_ini','varchar');		
					$this->setParametro('hora_fin','hora_fin','varchar');

					$this->addParametro('codigo_evento',$codigo_evento,'varchar');
		
					//Ejecuta la instruccion
					$this->armarConsulta();		
					$stmt = $link->prepare($this->consulta);          
					$stmt->execute();
					$result = $stmt->fetch(PDO::FETCH_ASSOC);               
					
					//recupera parametros devuelto depues de insertar 
					$resp_procedimiento = $this->divRespuesta($result['f_intermediario_ime']);	
					
					if ($resp_procedimiento['tipo_respuesta']=='ERROR') {			
						throw new Exception("Error al insertar el evento significativo en la bd");
					}
				}				

			} else {
				throw new Exception("Ha ocurrido un error al llamar al servicio para insertar el evento significativo en impuestos");
			}
			
			$this->respuesta=new Mensaje();
            $this->respuesta->setMensaje('EXITO',$this->nombre_archivo,'Procesamiento exitoso ','Procesamiento exitoso ','modelo',$this->nombre_archivo,'procesarServices','IME','');
           
		} catch (Exception $e) {			
			$this->respuesta=new Mensaje();
			$this->respuesta->setMensaje('ERROR',$this->nombre_archivo,$e->getMessage(),$e->getMessage(),'modelo','','','','');
		}		
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