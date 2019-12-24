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

include dirname(__FILE__).'/MODBaseSiat.php';
class MODGestorDocumento extends MODBaseSiat{
	
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

		$this->captura('razon_social','varchar');
		$this->captura('nro_factura','integer');
		$this->captura('monto_total','numeric');
		$this->captura('moneda','varchar');
		$this->captura('motivo_anulacion','varchar');
		$this->captura('fecha_hora_factura','varchar');
		
		
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();
		
		//Devuelve la respuesta
		return $this->respuesta;
	}
	
				
	function procesarGestorDocumento($p_id_gestor_documento = null){
		$cone = new conexion();
		$link = $cone->conectarpdo(); 
		try {
			if (isset($p_id_gestor_documento)) {
				$id_gestor_documento = $p_id_gestor_documento;
			} else {
				$id_gestor_documento = $this->objParam->getParametro('id_gestor_documento');
			}
			$nit = MODFunBasicas::getVariableGlobal('siat_nit');
			$cuis = $this->getCuis($link);
			$cufd = $this->getCufd($link);
			$documento_fiscal = $this->getDocumentoFiscalDeMapeo($link, $id_gestor_documento);
			$cabecera = $this->getDatosCabecera($link, $id_gestor_documento, $nit, $cufd);
			$detalle = $this->getDatosDetalle($link, $id_gestor_documento);
			$datos_gestor = $this->getDatosGestor($link, $id_gestor_documento);			
			$modalidad = MODFunBasicas::getVariableGlobal('siat_modalidad');
			$modalidad_texto = $modalidad == '1' ? 'Electronica' : 'Computarizada';
			
			$urlMetodo = $this->getUrlMetodoFacturacion($link, $datos_gestor['tipo'], $cabecera['codigoDocumentoSector'], $documento_fiscal);
			
			if ($datos_gestor['tipo'] == 'documento') {
				$tipo_emision = '1';
			} else if ($datos_gestor['tipo'] == 'paquete') {
				$tipo_emision = '2';
			} else {//masivo
				$tipo_emision = '3';
			}

			if ($cabecera['codigoDocumentoSector'] == '18') {
				$factura = new Factura("FAC_{$cabecera['cuf']}", dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',$modalidad_texto,"CreditoDebito");
		   	} else if ($cabecera['codigoDocumentoSector'] == '3') {
			   	$factura = new Factura("FAC_{$cabecera['cuf']}", dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',$modalidad_texto,"AlquilerBienInmueble");
		   	} else {
			   	$factura = new Factura("FAC_{$cabecera['cuf']}", dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',$modalidad_texto);	
		   	}	
		   
		   $factura->loadXml($cabecera,$detalle);
		   $factura->sign(dirname(__FILE__).'/../firma_digital/server.p12'); //@todo modificar para obtener dinamicamente la firma	
		   $factura->crearArchivoBase64();
		   $factura->crearArchivoGZIP();
		   $archivo_envio = $factura->convertirArchivoGZIPABase64();	
		   //si es paquete o masivo
		   if ($datos_gestor['tipo'] == 'paquete' || $datos_gestor['tipo'] == 'masivo') {
			   $name = 'PAQ_'.$cabecera['cuf'];
			   
			   $a = new PharData(dirname(__FILE__)."/../../uploaded_files/archivos_facturacion_xml/{$name}.tar");
			   $a->addFile(realpath(dirname(__FILE__)."/../../uploaded_files/archivos_facturacion_xml/FAC_{$cabecera['cuf']}_FirmadoB64.txt"),"FAC_{$cabecera['cuf']}_FirmadoB64.txt");
			   Factura::crearArchivoGZIPMasivo(dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/'. $name,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/{$name}.tar.gz');
			   $archivo_envio = Factura::convertirArchivoGZIPABase64Masivo(dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/{$name}.tar.gz',dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/{$name}GzipB64.txt');
		   } 
		   $hash = hash ( "sha256" , $archivo_envio );
		   
		   $wsOperaciones= new WsFacturacion(
				$urlMetodo[0],
				MODFunBasicas::getVariableGlobal('siat_ambiente'),
				$documento_fiscal,
				$cabecera['codigoDocumentoSector'],
				$tipo_emision,//tipo emision 1 online 2 paquete 3 masivo
				$modalidad,
				$cabecera['codigoPuntoVenta'],//punto de venta
				MODFunBasicas::getVariableGlobal('siat_codigo_sistema'),
				$cabecera['codigoSucursal'], 
				$cufd,
				$cuis,
				$nit,
				$datos_gestor['fechaFormato1'],
				$hash,
				$archivo_envio);	   
		   
		    $resultop = $wsOperaciones->{$urlMetodo[1]}();
		    $rop = $wsOperaciones->ConvertObjectToArray($resultop);
			$codigo_recepcion = $rop['RespuestaServicioFacturacion']['codigoRecepcion'];
			//actualziar el estado y el codigo de recepcion en el gestor
			$this->setGestorEstado($link, $id_gestor_documento, '', $rop['RespuestaServicioFacturacion']['codigoRecepcion']);

			$this->respuesta=new Mensaje();
            $this->respuesta->setMensaje('EXITO',$this->nombre_archivo,'Procesamiento exitoso ','Procesamiento exitoso ','modelo',$this->nombre_archivo,'procesarServices','IME','');
           
		} catch (Exception $e) {			
			$this->respuesta=new Mensaje();
			$this->respuesta->setMensaje('ERROR',$this->nombre_archivo,$e->getMessage(),$e->getMessage(),'modelo','','','','');
		}		
		return $this->respuesta;		
	}

	function getDocumentoFiscalDeMapeo($link, $id_gestor_documento){
		$codigo = '';
		$sql = "SELECT  df.codigo
				FROM siat.tgestor_documento gd 
				INNER JOIN vef.tventa v on gd.id_venta = v.id_venta
				INNER JOIN vef.ttipo_venta tv on tv.codigo = v.codigo
				INNER JOIN siat.tmapeo_tipo_venta mtv on mtv.id_tipo_venta = tv.id_tipo_venta
				INNER JOIN siat.tdocumento_fiscal df on df.id_documento_fiscal = mtv.id_documento_fiscal
				WHERE id_gestor_documento = {$id_gestor_documento}";

        foreach ($link->query($sql) as $row) {
            $codigo = $row['codigo'];
		}
		if ($codigo == '') {
			throw new Exception("No existe mapeo para tipo venta del gestor {$id_gestor_documento}");
	   	}
		return $codigo;
	}

	function getDatosGestor($link, $id_gestor_documento){
		$encuentra = false;
		$sql = "SELECT  gd.*, 
				to_char (gd.fecha_hora_factura, ''YYYY-MM-DD'') || ''T'' || 
				to_char(''HH24:MI:SS.000'') as fechaFormato1
				FROM siat.tgestor_documento gd 							
				WHERE id_gestor_documento = {$id_gestor_documento}";

        foreach ($link->query($sql) as $row) {
            $codigo = $row['codigo'];
		}
		if (!$encuentra) {
			throw new Exception("No se encontro el gestor documento {$id_gestor_documento}");
	   	}
		return $codigo;
	}

	function getDatosCabecera($link, $id_gestor_documento, $nit, $cufd){
		$encuentra = false;
		$sql = "SELECT  gd.*, 
				to_char (gd.fecha_hora_factura, ''YYYY-MM-DD'') || ''T'' || 
				to_char(''HH24:MI:SS.000'') as fechaFormato1
				FROM siat.tgestor_documento gd 	
				INNER JOIN vef.tventa v
				INNER JOIN vef.tsucursal s
				INNER JOIN param.tmoneda mon
				INNER JOIN vef.tforma_pago
				LEFT JOIN vef.tpunto_venta pv
				LEFT JOIN vef.tcliente cl
				LEFT JOIN param.vproveedor pro				
				WHERE id_gestor_documento = {$id_gestor_documento}";

        foreach ($link->query($sql) as $row) {
            $codigo = $row['codigo'];
		}
		if (!$encuentra) {
			throw new Exception("No se encontro los datos de cabecera para gestor documento {$id_gestor_documento}");
	   	}
		return $codigo;
	}

	function getDatosDetalle($link, $id_gestor_documento){
		$encuentra = false;
		$sql = "SELECT  gd.*, 
				to_char (gd.fecha_hora_factura, ''YYYY-MM-DD'') || ''T'' || 
				to_char(''HH24:MI:SS.000'') as fechaFormato1
				FROM siat.tgestor_documento gd 				
				WHERE id_gestor_documento = {$id_gestor_documento}";

        foreach ($link->query($sql) as $row) {
            $codigo = $row['codigo'];
		}
		if (!$encuentra) {
			throw new Exception("No se encontro los datos de cabecera para gestor documento {$id_gestor_documento}");
	   	}
		return $codigo;
	}
			
}
?>