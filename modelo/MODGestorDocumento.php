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
	
				
	function procesarGestorDocumento(){
		$cone = new conexion();
		$link = $cone->conectarpdo(); 
		try {
			
			$id_gestor_documento = $this->objParam->getParametro('id_gestor_documento');
			
			$nit = MODFunBasicas::getVariableGlobal('siat_nit');
			$codigo_punto_venta = $this->getPuntoVenta($link, $id_gestor_documento);
			$codigo_sucursal = $this->getSucursal($link, $id_gestor_documento);			
			
			$cuis = $this->getCuis($link);
			$cufd = $this->getCufd($link, $codigo_sucursal, $codigo_punto_venta);
			
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
				$codigo_punto_venta,//punto de venta
				MODFunBasicas::getVariableGlobal('siat_codigo_sistema'),
				$codigo_sucursal, 
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
				INNER JOIN vef.ttipo_venta tv on tv.codigo = v.tipo_factura
				INNER JOIN siat.tmapeo_tipo_venta mtv on mtv.id_tipo_venta = tv.id_tipo_venta
				INNER JOIN siat.tdocumento_fiscal df on df.id_documento_fiscal = mtv.id_documento_fiscal
				WHERE id_gestor_documento = {$id_gestor_documento}";
		
		$stm = $link->query($sql);
		$rows = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $codigo = $row['codigo'];
		}
		if ($codigo == '') {
			throw new Exception("No existe mapeo para tipo venta del gestor {$id_gestor_documento}");
	   	}
		return $codigo;
	}

	function getPuntoVenta($link, $id_gestor_documento){
		$codigo = '';
		$sql = "SELECT  coalesce(pv.codigo,'0') as codigo
				FROM siat.tgestor_documento gd 
				INNER JOIN vef.tventa v on gd.id_venta = v.id_venta
				LEFT JOIN vef.tpunto_venta pv on pv.id_punto_venta = v.id_punto_venta				
				WHERE id_gestor_documento = {$id_gestor_documento}";

        foreach ($link->query($sql) as $row) {
            $codigo = $row['codigo'];
		}
		if ($codigo == '') {
			throw new Exception("No existe punto de venta para el gestor {$id_gestor_documento}");
	   	}
		return $codigo;
	}

	function getSucursal($link, $id_gestor_documento){
		$codigo = '';
		$sql = "SELECT  suc.codigo
				FROM siat.tgestor_documento gd 
				INNER JOIN vef.tventa v on gd.id_venta = v.id_venta
				LEFT JOIN vef.tsucursal suc on v.id_sucursal = suc.id_sucursal				
				WHERE id_gestor_documento = {$id_gestor_documento}";

        foreach ($link->query($sql) as $row) {
            $codigo = $row['codigo'];
		}
		if ($codigo == '') {
			throw new Exception("No existe sucursal para el gestor {$id_gestor_documento}");
	   	}
		return $codigo;
	}

	function getDatosGestor($link, $id_gestor_documento){
		$encuentra = false;
		$sql = "SELECT  
					gd.*, 
					to_char (gd.fecha_hora_factura, 'YYYY-MM-DD') || 'T' || 
					to_char(gd.fecha_hora_factura, 'HH24:MI:SS.000') as \"fechaFormato1\"
				FROM siat.tgestor_documento gd							
				WHERE id_gestor_documento = {$id_gestor_documento}";

        $stm = $link->query($sql);
		$rows = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
			$datos = $row;
			$encuentra = true;
		}
		if (!$encuentra) {
			throw new Exception("No se encontro el gestor documento {$id_gestor_documento}");
	   	}
		return $datos;
	}

	function getDatosCabecera($link, $id_gestor_documento, $nit, $cufd){
		$encuentra = false;
		$sql = "SELECT '{$nit}' as nit,
						v.nro_factura as \"numeroFactura\", 
						'{$cufd}' as cufd, 						
						suc.codigo as \"codigoSucursal\",
						suc.direccion,
						pv.codigo as \"codigoPuntoVenta\",				
						to_char (gd.fecha_hora_factura, 'YYYY-MM-DD') || 'T' || 
						to_char(gd.fecha_hora_factura, 'HH24:MI:SS.000') as \"fechaEmision\",
						v.nombre_factura as \"nombreRazonSocial\", 
						'1' as \"codigoTipoDocumentoIdentidad\", --@todo tipo documento identidad carnet o nit anadir en cliente, proveedor
						v.nit as \"numeroDocumento\",
						null as complemento, --@todo sacar complemento en caso de q sea de ci
						coalesce(cl.codigo, pro.codigo) as \"codigoCliente\",
						mp.codigo as \"codigoMetodoPago\",
						vfp.numero_tarjeta as \"numeroTarjeta\",
						v.total_venta as \"montoTotal\", --@todo monto moneda base
						null as \"montoDescuento\", --@todo descuento
						tmon.codigo as \"codigoMoneda\",
						v.tipo_cambio_venta as \"tipoCambio\",
						v.total_venta_msuc as \"montoTotalMoneda\",--@todo monto moneda transaccion
						'El proveedor debera suministrar el servicio en las modalidades y terminos ofertados o convenidos' as leyenda, --@todo random leyenda
						usu.cuenta as usuario,
						dsec.codigo as \"codigoDocumentoSector\",
						null as \"codigoExcepcionDocumento\"--@todo verificar posibles codigo excepcion documento
				FROM siat.tgestor_documento gd 	
				INNER JOIN vef.tventa v on v.id_venta = gd.id_venta
				INNER JOIN vef.ttipo_venta tv on tv.codigo = v.tipo_factura
				INNER JOIN siat.tmapeo_tipo_venta mtv on mtv.id_tipo_venta = tv.id_tipo_venta
				INNER JOIN siat.tdocumento_sector dsec on dsec.id_documento_sector = mtv.id_documento_sector
				INNER JOIN vef.tsucursal suc on suc.id_sucursal = v.id_sucursal				
				INNER JOIN param.tmoneda mon on v.id_moneda = mon.id_moneda
				INNER JOIN siat.ttipo_moneda tmon on tmon.codigo_pxp = mon.codigo
				INNER JOIN vef.tventa_forma_pago vfp on vfp.id_venta = v.id_venta
				INNER JOIN vef.tforma_pago fp on fp.id_forma_pago = vfp.id_forma_pago
				INNER JOIN siat.tmetodo_pago mp on mp.codigo_pxp = fp.codigo
				INNER JOIN segu.tusuario usu on usu.id_usuario = v.id_usuario_reg				
				LEFT JOIN vef.tpunto_venta pv on pv.id_punto_venta = v.id_punto_venta
				LEFT JOIN vef.tcliente cl on cl.id_cliente = v.id_cliente
				LEFT JOIN param.vproveedor pro on pro.id_proveedor = v.id_proveedor			
				WHERE id_gestor_documento = {$id_gestor_documento}";

		$stm = $link->query($sql);
		$rows = $stm->fetchAll(PDO::FETCH_ASSOC);
		foreach ($rows as $row) {
			$encuentra = true;
            $cabecera = $row;
		}
		if (!$encuentra) {
			throw new Exception("No se encontro los datos de cabecera para gestor documento {$id_gestor_documento}");
	   	}
		return $cabecera;
	}

	function getDatosDetalle($link, $id_gestor_documento){		
		$detalle = array();
		$sql = "SELECT 
					prod.actividad as \"actividadEconomica\",
					prod.codigo as \"codigoProductoSin\",
					cig.codigo as \"codigoProducto\",
					vd.descripcion as descripcion,
					vd.cantidad as cantidad,
					sum.codigo as \"unidadMedida\",
					vd.precio as \"precioUnitario\",
					null as \"montoDescuento\", --@todo hacer descuentos
					round(vd.precio * vd.cantidad) as \"subTotal\",
					null as \"numeroSerie\", --@todo anadir serie
					null as \"numeroImei\" --@todo anadir imei
				FROM siat.tgestor_documento gd 	
				INNER JOIN vef.tventa v on v.id_venta = gd.id_venta
				INNER JOIN vef.tventa_detalle vd on v.id_venta = vd.id_venta
				INNER JOIN vef.tsucursal_producto sp on sp.id_sucursal_producto = vd.id_sucursal_producto
				INNER JOIN param.tconcepto_ingas cig on cig.id_concepto_ingas = sp.id_concepto_ingas
				INNER JOIN siat.tproducto prod on prod.codigo_concepto_ingas = cig.codigo
				INNER JOIN param.tunidad_medida um on um.id_unidad_medida = cig.id_unidad_medida
				INNER JOIN siat.tunidad_medida sum on sum.codigo_pxp = um.codigo				
				WHERE id_gestor_documento = {$id_gestor_documento}";

		$stm = $link->query($sql);
		$rows = $stm->fetchAll(PDO::FETCH_ASSOC);
		
		if (count($rows) == 0) {
			throw new Exception("No se encontro los datos de detalle para gestor documento {$id_gestor_documento}");
	   	}
		return $rows;
	}
			
}
?>