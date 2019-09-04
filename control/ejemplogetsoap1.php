<pre>
<?php
//referencia a clase ws
//------------------------
ini_set('display_errors', 1);
include dirname(__FILE__).'/../lib/SiatClassWs.inc';
include_once(dirname(__FILE__).'/../lib/cls_Factura.php');
require(dirname(__FILE__).'/../../lib/lib_modelo/driver.php');
require(dirname(__FILE__).'/../../lib/lib_modelo/MODbase.php');
require(dirname(__FILE__).'/../modelo/MODCuf.php');


session_start();
/***************************************
 * ************************************
 * ************************************
 * *************************************
 * OPERACIONES*******************
 * ************************************
 * ************************************
 * ************************************/
	/* PARAMETROS PARA TODAS LAS SINCRONIZACIONES*/
	
	//codigo ambiente : 1 produccion 2 pruebas
	//codigo sistema
	//modalidad compuitarizada :1 electronica  2 computarizada 0 si es pedido en las pruebas
	//nit 
	//cuis
	//sucursal
	//punto venta
	//nombre punto de venta
	//codigoTipoPuntoVenta: 1 fijo 2 movil 3 conjunto
	//descripcion: descripcion de punto de venta o del evento
	//codigoEvento
	//fechaHoraEvento
	//cufd
	//fechaHoraFinEvento,
	//codigoRecepcionEvento
	 
/*************
 * GENERAR CUFD
 * **************/	
	/*$wsOperaciones= new WsFacturacionOperaciones('https://presiatservicios.impuestos.gob.bo:39268/FacturacionSolicitudCufd?wsdl',2,'5D778EC73EF',1,196560027,'9081F4D2',0,0);
	$resultop = $wsOperaciones->solicitudCufdOp();
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/*************
 * GENERAR CUIS
 * **************/	
	
	/*$wsOperaciones= new WsFacturacionOperaciones('https://presiatservicios.impuestos.gob.bo:39117/FacturacionOperaciones?wsdl',2,'5D778EC73EF',2,196560027,NULL,0,0);
	$resultop = $wsOperaciones->solicitudCuisOp();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	 
/*************
 * REGISTRAR PUNTO VENTA  esta dando error
 * **************/	
 
	/*$wsOperaciones= new WsFacturacionOperaciones('https://presiatservicios.impuestos.gob.bo:39117/FacturacionOperaciones?wsdl',2,'5D778EC73EF',2,196560027,'E9EB25AC',0,0,'PUNTO1',1,"Descripcion punto venta");
	$resultop = $wsOperaciones->registroPuntoVentaOp();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/*************
 * INICIO EVENTO SIGNIFICATIVO
 * **************/	
 
	/*$wsOperaciones= new WsFacturacionOperaciones('https://presiatservicios.impuestos.gob.bo:39127/FacturacionEventosSignificativos?wsdl',2,'5D778EC73EF',2,196560027,'E9EB25AC',0,0,'PUNTO1',1,
								"Descripcion inicio evento","972","2019-07-31T23:53:16.987-04:00","B528C2CCE3EC3BA3FBE44C565FD092CE");
	$resultop = $wsOperaciones->inicioEventoSignificativoOP();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/*************
 * FIN EVENTO SIGNIFICATIVO codigo 63 error
 * **************/	
 
	/*$wsOperaciones= new WsFacturacionOperaciones('https://presiatservicios.impuestos.gob.bo:39127/FacturacionEventosSignificativos?wsdl',2,'5D778EC73EF',2,196560027,'E9EB25AC',0,0,'PUNTO1',1,
								"Descripcion inicio evento",NULL,NULL,"B528C2CCE3EC3BA3FBE44C565FD092CE","2019-07-31T23:53:16.987-04:00",442);
	$resultop = $wsOperaciones->inicioEventoSignificativoOP();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/***************************************
 * ************************************
 * ************************************
 * *************************************
 * SINCRONIZACIONES*******************
 * ************************************
 * ************************************
 * ************************************/	
	
/* PARAMETROS PARA TODAS LAS SINCRONIZACIONES*/

	//Facturacion Operaciones
	//codigo ambiente : 1 produccion 2 pruebas
	//codigo sistema	
	//nit 
	//cuis
	//sucursal
	//punto venta	
	//codigo autorizacion
	
/*************
 * SINCRONIZACION TIPO MONEDA
 * **************/
	/*$wsOperaciones= new WsFacturacionSincroniza('https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl',2,'5D778EC73EF',196560027,'E9EB25AC',0,0);
	$resultop = $wsOperaciones->ParametricaTipoMoneda();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/*************
 * SINCRONIZACION EVENTOS SIGNIFICATIVOS
 * **************/
	/*$wsOperaciones= new WsFacturacionSincroniza('https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl',2,'5D778EC73EF',196560027,'E9EB25AC',0,0);
	$resultop = $wsOperaciones->ParametricaEventosSignificativos();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/*************
 * SINCRONIZACION MOTIVO ANULACION
 * **************/
	/*$wsOperaciones= new WsFacturacionSincroniza('https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl',2,'5D778EC73EF',196560027,'E9EB25AC',0,0);
	$resultop = $wsOperaciones->ParametricaMotivoAnulacion();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/*************
 * SINCRONIZACION ACTIVIDADES
 * **************/
		
	/*$wsOperaciones= new WsFacturacionSincroniza('https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl',2,'5D778EC73EF',196560027,'E9EB25AC',0,0);
	$resultop = $wsOperaciones->ParametricaActividades();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/*************
 * SINCRONIZACION PAIS ORIGEN
 * **************/	
	/*$wsOperaciones= new WsFacturacionSincroniza('https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl',2,'5D778EC73EF',196560027,'E9EB25AC',0,0);
	$resultop = $wsOperaciones->ParametricaPaisOrigen();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/*************
 * SINCRONIZACION TIPO DEPARTAMENTO
 * **************/		
	/*$wsOperaciones= new WsFacturacionSincroniza('https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl',2,'5D778EC73EF',196560027,'E9EB25AC',0,0);
	$resultop = $wsOperaciones->sincronizarParametricaTipoDepartamento();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/*************
 * SINCRONIZACION MENSAJES SERVICIOS
 * **************/		
	/*$wsOperaciones= new WsFacturacionSincroniza('https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl',2,'5D778EC73EF',196560027,'E9EB25AC',0,0);
	$resultop = $wsOperaciones->ParametricaMensajesServicios();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/*************
 * SINCRONIZACION TIPO AMBIENTE
 * **************/
	/*$wsOperaciones= new WsFacturacionSincroniza('https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl',2,'5D778EC73EF',196560027,'E9EB25AC',0,0);
	$resultop = $wsOperaciones->ParametricaTipoAmbiente();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/*************
 * SINCRONIZACION TIPO EMISION
 * **************/		
	/*$wsOperaciones= new WsFacturacionSincroniza('https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl',2,'5D778EC73EF',196560027,'E9EB25AC',0,0);
	$resultop = $wsOperaciones->ParametricaTipoEmision();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/*************
 * SINCRONIZACION TIPO MODALIDAD
 * **************/		
	/*$wsOperaciones= new WsFacturacionSincroniza('https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl',2,'5D778EC73EF',196560027,'E9EB25AC',0,0);
	$resultop = $wsOperaciones->ParametricaTipoModalidad();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/*************
 * SINCRONIZACION TIPO DOC IDENTIDAD
 * **************/		
	/*$wsOperaciones= new WsFacturacionSincroniza('https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl',2,'5D778EC73EF',196560027,'E9EB25AC',0,0);
	$resultop = $wsOperaciones->ParametricaTipoDocumentoIdentidad();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/*************
 * SINCRONIZACION TIPO DOC FISCAL
 * **************/		
	/*$wsOperaciones= new WsFacturacionSincroniza('https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl',2,'5D778EC73EF',196560027,'E9EB25AC',0,0);
	$resultop = $wsOperaciones->ParametricaTipoDocumentoFiscal();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/*************
 * SINCRONIZACION METODO PAGO
 * **************/		
	/*$wsOperaciones= new WsFacturacionSincroniza('https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl',2,'5D778EC73EF',196560027,'E9EB25AC',0,0);
	$resultop = $wsOperaciones->ParametricaMetodoPago();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
	
/*************
 * SINCRONIZACION FECHA Y HORA
 * **************/
 
	/*$wsOperaciones= new WsFacturacionSincroniza('https://presiatservicios.impuestos.gob.bo:39266/FacturacionSincronizacionFechaHora?wsdl',2,'5D778EC73EF',196560027,'E9EB25AC',0,0);
	$resultop = $wsOperaciones->SincronizaFechaHora();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/*************
 * SINCRONIZACION PRODUCTOS Y SERVICIOS
 * **************/
		
	/*$wsOperaciones= new WsFacturacionSincroniza('https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl',2,'5D778EC73EF',196560027,'E9EB25AC',0,0,'1000000');
	$resultop = $wsOperaciones->SincronizaProductosServicios();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/***************************************
 * ************************************
 * ************************************
 * *************************************
 * FACTURACION COMPUTARIZADA************
 * ************************************
 * ************************************
 * ************************************/
 
 /* PARAMETROS PARA TODAS LAS FACTURAS COMPUTARIZADAS*/
/*
	codigoAmbiente: 1 produccion 2 pruebas
	codigoDocumentoFiscal 1 factura 2 nota de credito debito 3 nota fiscal 4 boleta contingencia 5 documento equivalente
	codigoDocumentoSector 1 factura estandar 12 factura comercial de exportacion 18 nota de credito debito
	codigoEmision:1 online 2 offline
    codigoModalidad:1 electronica  2 computarizada 0 si es pedido en las pruebas
    codigoPuntoVenta: 0 si no existe 
    codigoSistema
    codigoSucursal: 0  si es solo una
    cufd
    cuis
 	nit
    fechaEnvio
    hashArchivo    
    archivo
    codigoRecepcion
 * cuf
*/

/**************************
 * RECEPCION FACTURA ESTANDAR COMPUTARIZADA
 **************************/
 	//creacion de carpeta donde se guarda los archivos xml y archivos encriptados.
 	
	
	//generar cuf
	/*$fecha = new DateTime();
	$fecha_formato1 = $fecha->format('Y-m-dH:i:s.000');
	$fecha_formato1 = substr($fecha_formato1, 0, 10) . 'T' . substr($fecha_formato1, 10);	
	$fecha_formato2 = $fecha->format('YmdHis000');
	
	$concatenacion = MODCuf::concatenar(
											"196560027",//nit
											$fecha_formato2,//fecha emision
											"0",//sucursal
											"2",//modalidad
											"1",//tipo emision 1 online 2offline
											"1",// codigo documento fiscal
											"1",// codigo documento serctor
											"4",//nro factura
											"0");  //punto venta
											
											
	$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
	
	
	$concatenacion = $concatenacion . $mod11; 
	$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
	
	$cabecera = array(		
						"nitEmisor" => 196560027,
						"numeroFactura" => 4,						
						"cuf" => $base16,
						"cufd" => "F2CEB1734D112C7C2C9A6E14AB1B84E0",
						"codigoSucursal" => 0,
						"direccion" => "Calle Ballivian Nro. 1333",
						"codigoPuntoVenta" => null,
						"fechaEmision" => $fecha_formato1,
						"nombreRazonSocial" => "Rivera",
						"codigoTipoDocumentoIdentidad" => 1,
						"numeroDocumento" => "4394565",						
						"complemento" => null,	
						"codigoCliente" => "C1",	
						"codigoMetodoPago" => 1,
						"numeroTarjeta" => null,
						"montoTotal" => "100.0",
						"montoDescuento" => null,
						"codigoMoneda" => 688,
						"tipoCambio" => "1.0",
						"montoTotalMoneda" => "100.0",
						"leyenda" => "El proveedor debera suministrar el servicio en las modalidades y terminos ofertados o convenidos",
						"usuario" => "JRIVERA",
						"codigoDocumentoSector" => 1,	
						"codigoExcepcionDocumento"=>null												
						);
	$detalle = [
				[		"actividadEconomica" => 620200,
						"codigoProductoSin" => 83132,
						"codigoProducto" => "P1",
						"descripcion" => "Aplicacion de facturacion",
						"cantidad" => 1,
						"unidadMedida" => 57,		
						"precioUnitario" => "100.0",
						"montoDescuento" => null,						
						"subTotal" => "100.0",
						"numeroSerie" => null,
						"numeroImei" => null,						
										
				]
			];	
	
	$factura = new FacturaEstandar('ELE_196560027_1',dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Computarizada");
	$factura->loadXml($cabecera,$detalle);	
	$factura->crearArchivoBase64();
	$factura->crearArchivoGZIP();
	$archivo_envio = $factura->convertirArchivoGZIPABase64();	
	$hash = hash ( "sha256" , $archivo_envio );
	
	
 	$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39112/FacturaComputarizadaEstandar?wsdl',
 							2,1,1,1,2,0,'5D778EC73EF',0, 'F2CEB1734D112C7C2C9A6E14AB1B84E0','E9EB25AC',196560027,$fecha_formato1,$hash,$archivo_envio);
	$resultop = $wsOperaciones->recepcionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * VALIDA RECEPCION FACTURA ESTANDAR COMPUTARIZADA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39112/FacturaComputarizadaEstandar?wsdl',
 							2,1,1,1,2,0,'5D778EC73EF',0, 'F2CEB1734D112C7C2C9A6E14AB1B84E0','E9EB25AC',196560027,NULL,NULL,NULL,215569);
	$resultop = $wsOperaciones->validarRecepcionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * VALIDA RECEPCION FACTURA ESTANDAR COMPUTARIZADA X CUF
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39112/FacturaComputarizadaEstandar?wsdl',
 							2,1,1,1,2,0,'5D778EC73EF',0, '256563CEC3DDCA487261ECB310F135BE','E9EB25AC',196560027,NULL,NULL,NULL,NULL,$base16);
	$resultop = $wsOperaciones->validaRecepcionFacturaEstandarxCuf();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/**************************
 * RECEPCION FACTURA ESTANDAR ELECTRONICA
 **************************/
 	//creacion de carpeta donde se guarda los archivos xml y archivos encriptados.
 	
	
	/*$fecha = new DateTime();
	$fecha_formato1 = $fecha->format('Y-m-dH:i:s.000');
	$fecha_formato1 = substr($fecha_formato1, 0, 10) . 'T' . substr($fecha_formato1, 10);	
	$fecha_formato2 = $fecha->format('YmdHis000');	
	//generar cuf
	$concatenacion = MODCuf::concatenar(
											"196560027",//nit
											$fecha_formato2,//fecha emision
											"0",//sucursal
											"1",//modalidad
											"1",//tipo emision 1 online 2offline
											"1",// codigo documento fiscal
											"1",// codigo documento serctor
											"2",//nro factura
											"0");  //punto venta
											
											
	$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
	
	
	$concatenacion = $concatenacion . $mod11; 
	$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
	
	$cabecera = array(		
						"nitEmisor" => 196560027,
						"numeroFactura" => 2,						
						"cuf" => $base16,
						"cufd" => "256563CEC3DDCA487261ECB310F135BE",
						"codigoSucursal" => 0,
						"direccion" => "Calle Ballivian Nro. 1333",
						"codigoPuntoVenta" => null,
						"fechaEmision" => $fecha_formato1,
						"nombreRazonSocial" => "Rivera",
						"codigoTipoDocumentoIdentidad" => 1,
						"numeroDocumento" => "4394565",						
						"complemento" => null,	
						"codigoCliente" => "C1",	
						"codigoMetodoPago" => 1,
						"numeroTarjeta" => null,
						"montoTotal" => "100.0",
						"montoDescuento" => null,
						"codigoMoneda" => 688,
						"tipoCambio" => "1.0",
						"montoTotalMoneda" => "100.0",
						"leyenda" => "El proveedor debera suministrar el servicio en las modalidades y terminos ofertados o convenidos",
						"usuario" => "JRIVERA",
						"codigoDocumentoSector" => 1,	
						"codigoExcepcionDocumento"=>null												
						);
	$detalle = [
				[		"actividadEconomica" => 620200,
						"codigoProductoSin" => 83132,
						"codigoProducto" => "P1",
						"descripcion" => "Aplicacion de facturacion",
						"cantidad" => 1,
						"unidadMedida" => 57,		
						"precioUnitario" => "100.0",
						"montoDescuento" => null,						
						"subTotal" => "100.0",
						"numeroSerie" => null,
						"numeroImei" => null,						
										
				]
			];	
	
	$factura = new FacturaEstandar('ELE_196560027_2',dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Electronica");
	$factura->loadXml($cabecera,$detalle);
	$factura->sign(dirname(__FILE__).'/../firma_digital/server.p12');	
	$factura->crearArchivoBase64();
	$factura->crearArchivoGZIP();
	$archivo_envio = $factura->convertirArchivoGZIPABase64();	
	$hash = hash ( "sha256" , $archivo_envio );
	
	
 	$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39113/FacturaElectronicaEstandar?wsdl',
 							2,1,1,1,1,0,'5D778EC73EF',0, 'F2329AD50359CAA7B9192E43B516A82F','9081F4D2',196560027,$fecha_formato1,$hash,$archivo_envio);
	$resultop = $wsOperaciones->recepcionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/**************************
 * VALIDA RECEPCION FACTURA ESTANDAR ELECTRONICA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39113/FacturaElectronicaEstandar?wsdl',
 							2,1,1,1,1,0,'5D778EC73EF',0, 'F2329AD50359CAA7B9192E43B516A82F','9081F4D2',196560027,NULL,NULL,NULL,179048);
	$resultop = $wsOperaciones->validarRecepcionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/**************************
 * VALIDA RECEPCION FACTURA ESTANDAR ELECTRONICA X CUF
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39113/FacturaElectronicaEstandar?wsdl',
 							2,1,1,1,1,0,'5D778EC73EF',0, 'F2329AD50359CAA7B9192E43B516A82F','9081F4D2',196560027,NULL,NULL,NULL,NULL,$base16);
	$resultop = $wsOperaciones->validaRecepcionFacturaEstandarxCuf();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
/**************************
 * RECEPCION FACTURA COMERCIAL EXPORTACION COMPUTARIZADA
 **************************/
 	//creacion de carpeta donde se guarda los archivos xml y archivos encriptados.
 	
	/*$fecha = new DateTime();
	$fecha_formato1 = $fecha->format('Y-m-dH:i:s.000');
	$fecha_formato1 = substr($fecha_formato1, 0, 10) . 'T' . substr($fecha_formato1, 10);	
	$fecha_formato2 = $fecha->format('YmdHis000');	
	
	//generar cuf
	$concatenacion = MODCuf::concatenar(
											"196560027",//nit
											$fecha_formato2,//fecha emision
											"0",//sucursal
											"2",//modalidad
											"1",//tipo emision 1 online 2offline
											"1",// codigo documento fiscal
											"12",// codigo documento serctor
											"3",//nro factura
											"0");  //punto venta
											
											
	$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
	
	
	$concatenacion = $concatenacion . $mod11; 
	$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
	
	$cabecera = array(		
						"nitEmisor" => 196560027,
						"numeroFactura" => 3,						
						"cuf" => $base16,
						"cufd" => "B62AFA029A43D9F59EFBCB1FE1BB8827",
						"codigoSucursal" => 0,
						"direccion" => "Calle Ballivian Nro. 1333",
						"codigoPuntoVenta" => null,
						"fechaEmision" => $fecha_formato1,
						"nombreRazonSocial" => "Rivera",
						"codigoTipoDocumentoIdentidad" => 1,
						"numeroDocumento" => "4394565",						
						"complemento" => null,	
	 					"direccionComprador"=>"Ave. Quebec, In 255",
						"codigoCliente" => "C1",
	 					"incoterm" => "CIF",
	 					"puertoDestino" => "Vancouver",
	 					"lugarDestino" => "Canada",
	 					"codigoPais" => "391",	
						"codigoMetodoPago" => 1,
						"numeroTarjeta" => null,
						"montoTotal" => "10000.0",
						"montoTotalPuerto" => "10000.0",
						"precioValorBruto" => "6975.0",
						"gastosTransporteFrontera" => "375.0",
						"gastosSeguroFrontera" => "150.0",
						"totalFobFrontera" => "7500.0",
						"montoTransporteFrontera" => "2000.0",
						"montoSeguroInternacional" => "500.0",
						"otrosMontos" => null,
						"montoDescuento" => null,
						"codigoMoneda" => 688,
						"tipoCambio" => "1",
						"montoTotalMoneda" => "10000.0",
						"leyenda" => "ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS. EL USO ILÍCITO DE ÉSTA SERÁ SANCIONADO DE ACUERDO A LEY",
						"usuario" => "JRIVERA",
						"codigoDocumentoSector" => 12												
						);
	$detalle = [
				[		"actividadEconomica" => "620200",
						"codigoProductoSin" => "83131",
						"codigoProducto" => "P1",
						"codigoNandina" => "0909610000",
						"descripcion" => "Semilla",
						"cantidad" => 100,
						"unidadMedida" => 1,		
						"precioUnitario" => "100.0",
						"montoDescuento" => null,						
						"subTotal" => "10000.0"					
										
				]
			];	
	
	$factura = new FacturaEstandar('COM_196560027_3',dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Computarizada","ComercialExportacion");
	$factura->loadXml($cabecera,$detalle);	
	$factura->crearArchivoBase64();
	$factura->crearArchivoGZIP();
	$archivo_envio = $factura->convertirArchivoGZIPABase64();	
	$hash = hash ( "sha256" , $archivo_envio );
	
	
 	$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39116/FacturaComputarizadaComercialExportacion?wsdl',
 							2,1,12,1,2,0,'5D778EC73EF',0, 'B62AFA029A43D9F59EFBCB1FE1BB8827','E9EB25AC',196560027,$fecha_formato1,$hash,$archivo_envio);
	$resultop = $wsOperaciones->recepcionFacturaComercialExportacion();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
/**************************
 * VALIDA RECEPCION FACTURA COMERCIAL DE EXPORTACION COMPUTARIZADA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39116/FacturaComputarizadaComercialExportacion?wsdl',
 							2,1,12,1,2,0,'5D778EC73EF',0, 'B62AFA029A43D9F59EFBCB1FE1BB8827','E9EB25AC',196560027,NULL,NULL,NULL,80);
	$resultop = $wsOperaciones->validarRecepcionFacturaComercialExportacion();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/**************************
 * RECEPCION FACTURA COMERCIAL EXPORTACION ELECTRONICA
 **************************/
 	//creacion de carpeta donde se guarda los archivos xml y archivos encriptados.
 	
	$fecha = new DateTime();
	$fecha_formato1 = $fecha->format('Y-m-dH:i:s.000');
	$fecha_formato1 = substr($fecha_formato1, 0, 10) . 'T' . substr($fecha_formato1, 10);	
	$fecha_formato2 = $fecha->format('YmdHis000');	
	
	//generar cuf
	$concatenacion = MODCuf::concatenar(
											"196560027",//nit
											$fecha_formato2,//fecha emision
											"0",//sucursal
											"1",//modalidad
											"1",//tipo emision 1 online 2offline
											"1",// codigo documento fiscal
											"12",// codigo documento serctor
											"4",//nro factura
											"0");  //punto venta
											
											
	$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
	
	
	$concatenacion = $concatenacion . $mod11; 
	$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
	
	$cabecera = array(		
						"nitEmisor" => 196560027,
						"numeroFactura" => 4,						
						"cuf" => $base16,
						"cufd" => "480E6F5C04D407496F834ADDD8381EDF",
						"codigoSucursal" => 0,
						"direccion" => "Calle Ballivian Nro. 1333",
						"codigoPuntoVenta" => null,
						"fechaEmision" => $fecha_formato1,
						"nombreRazonSocial" => "Rivera",
						"codigoTipoDocumentoIdentidad" => 1,
						"numeroDocumento" => "4394565",						
						"complemento" => null,	
	 					"direccionComprador"=>"Ave. Quebec, In 255",
						"codigoCliente" => "C1",
	 					"incoterm" => "CIF",
	 					"puertoDestino" => "Vancouver",
	 					"lugarDestino" => "Canada",
	 					"codigoPais" => "391",	
						"codigoMetodoPago" => 1,
						"numeroTarjeta" => null,
						"montoTotal" => "10000.0",
						"montoTotalPuerto" => "10000.0",
						"precioValorBruto" => "6975.0",
						"gastosTransporteFrontera" => "375.0",
						"gastosSeguroFrontera" => "150.0",
						"totalFobFrontera" => "7500.0",
						"montoTransporteFrontera" => "2000.0",
						"montoSeguroInternacional" => "500.0",
						"otrosMontos" => null,
						"montoDescuento" => null,
						"codigoMoneda" => 689,
						"tipoCambio" => "6.96",
						"montoTotalMoneda" => "10000.0",
						"leyenda" => "ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS. EL USO ILÍCITO DE ÉSTA SERÁ SANCIONADO DE ACUERDO A LEY",
						"usuario" => "JRIVERA",
						"codigoDocumentoSector" => 12												
						);
	$detalle = [
				[		"actividadEconomica" => "620200",
						"codigoProductoSin" => "83131",
						"codigoProducto" => "P1",
						"codigoNandina" => "0909610000",
						"descripcion" => "Semilla",
						"cantidad" => 100,
						"unidadMedida" => 1,		
						"precioUnitario" => "100.0",
						"montoDescuento" => null,						
						"subTotal" => "10000.0"					
										
				]
			];	
	
	$factura = new FacturaEstandar('ELE_196560027_4',dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Computarizada","ComercialExportacion");
	$factura->loadXml($cabecera,$detalle);	
	$factura->sign(dirname(__FILE__).'/../sis_siat/firma_digital/server.p12');
	$factura->crearArchivoBase64();
	$factura->crearArchivoGZIP();
	$archivo_envio = $factura->convertirArchivoGZIPABase64();	
	$hash = hash ( "sha256" , $archivo_envio );
	
	
 	$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39124/FacturaElectronicaComercialExportacion?wsdl',
 							2,1,12,1,1,0,'5D778EC73EF',0, '480E6F5C04D407496F834ADDD8381EDF','9081F4D2',196560027,$fecha_formato1,$hash,$archivo_envio);
	$resultop = $wsOperaciones->recepcionFacturaComercialExportacion();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);
/**************************
 * VALIDA RECEPCION FACTURA COMERCIAL DE EXPORTACION ELECTRONICA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39116/FacturaComputarizadaComercialExportacion?wsdl',
 							2,1,12,1,1,0,'5D778EC73EF',0, '480E6F5C04D407496F834ADDD8381EDF','9081F4D2',196560027,NULL,NULL,NULL,74);
	$resultop = $wsOperaciones->validarRecepcionFacturaComercialExportacion();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * RECEPCION NOTA CREDITO DEBITO COMPUTARIZADA
 **************************/
 	//creacion de carpeta donde se guarda los archivos xml y archivos encriptados.
 	
	/*$fecha = new DateTime();
	$fecha_formato1 = $fecha->format('Y-m-dH:i:s.000');
	$fecha_formato1 = substr($fecha_formato1, 0, 10) . 'T' . substr($fecha_formato1, 10);	
	$fecha_formato2 = $fecha->format('YmdHis000');	
	
	//generar cuf
	$concatenacion = MODCuf::concatenar(
											"196560027",//nit
											$fecha_formato2,//fecha emision
											"0",//sucursal
											"2",//modalidad
											"1",//tipo emision 1 online 2offline
											"1",// codigo documento fiscal
											"12",// codigo documento serctor
											"3",//nro factura
											"0");  //punto venta
											
											
	$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
	
	
	$concatenacion = $concatenacion . $mod11; 
	$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
	
	$cabecera = array(		
						"nitEmisor" => 196560027,
						"numeroNotaCreditoDebido" => 3,						
						"cuf" => $base16,
						"cufd" => "F2CEB1734D112C7C2C9A6E14AB1B84E0",
						"codigoSucursal" => 0,
						"direccion" => "Calle Ballivian Nro. 1333",
						"codigoPuntoVenta" => null,
						"fechaEmision" => $fecha_formato1,
						"nombreRazonSocial" => "Rivera",
						"codigoTipoDocumentoIdentidad" => 1,
						"numeroDocumento" => "4394565",						
						"complemento" => null,		 					
						"codigoCliente" => "C1",
	 					"incoterm" => "CIF",
	 					"numeroFactura" => "Vancouver",
	 					"numeroAutorizacionCuf" => "Canada",
	 					"fechaEmisionFactura" => "391",	
						"montoTotalOriginal" => 1,
						"montoTotalDevuelto" => null,
						"montoEfectivoCreditoDebito" => "69600.0",						
						"leyenda" => "ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS. EL USO ILÍCITO DE ÉSTA SERÁ SANCIONADO DE ACUERDO A LEY",
						"usuario" => "JRIVERA",
						"codigoDocumentoSector" => 18												
						);
	$detalle = [
				[		"actividadEconomica" => "1231",
						"codigoProductoSin" => "21312",
						"codigoProducto" => "P1",
						"codigoNandina" => "0909610000",
						"descripcion" => "Semilla",
						"cantidad" => 100,
						"unidadMedida" => 1,		
						"precioUnitario" => "100.0",
						"montoDescuento" => null,						
						"subTotal" => "10000.0"					
										
				]
			];	
	
	$factura = new FacturaEstandar('COM_196560027_3',dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Computarizada","ComercialExportacion");
	$factura->loadXml($cabecera,$detalle);	
	$factura->crearArchivoBase64();
	$factura->crearArchivoGZIP();
	$archivo_envio = $factura->convertirArchivoGZIPABase64();	
	$hash = hash ( "sha256" , $archivo_envio );
	
	
 	$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39116/FacturaComputarizadaComercialExportacion?wsdl',
 							2,1,12,1,2,0,'5D778EC73EF',0, 'F2CEB1734D112C7C2C9A6E14AB1B84E0','E9EB25AC',196560027,$fecha_formato1,$hash,$archivo_envio);
	$resultop = $wsOperaciones->recepcionFacturaComercialExportacion();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
/**************************
 * VALIDA RECEPCION NOTA CREDITO DEBITO COMPUTARIZADA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39116/FacturaComputarizadaComercialExportacion?wsdl',
 							2,1,12,1,2,0,'5D778EC73EF',0, 'F2CEB1734D112C7C2C9A6E14AB1B84E0','E9EB25AC',196560027,NULL,NULL,NULL,70);
	$resultop = $wsOperaciones->validarRecepcionFacturaComercialExportacion();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
?>
</pre>