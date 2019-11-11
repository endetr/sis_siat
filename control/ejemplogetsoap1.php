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
$cufd = "QUFvQ8OBZUNCRTI5MzVCRkQ2QjF1RVFLVFVBQQ==MDAwMDg4";


$codigo_sistema= "88E2935BFD6";
$cuis_computarizada = "B1506967";
$cuis_electronica = "4CB33E78";
$numero_fac=11;
$numero_nc = 1;
$fecha = new DateTime();
$fecha_formato1 = $fecha->format('Y-m-dH:i:s.000');
$fecha_formato1 = substr($fecha_formato1, 0, 10) . 'T' . substr($fecha_formato1, 10);	
$fecha_formato2 = $fecha->format('YmdHis000');
$nit = 1023097024;


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
	/*$wsOperaciones= new WsFacturacionOperaciones('https://presiatservicios.impuestos.gob.bo:39268/FacturacionSolicitudCufd?wsdl',2,$codigo_sistema,1,$nit,$cuis_electronica,0,0);
	$resultop = $wsOperaciones->solicitudCufdOp();
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	

/*************
 * GENERAR CUIS
 * **************/	
	
	/*$wsOperaciones= new WsFacturacionOperaciones('https://presiatservicios.impuestos.gob.bo:39117/FacturacionOperaciones?wsdl',2,'5D778EC73EF',1,196560027,NULL,0,0);
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
 * ConsultaEventoSignificativo
 * **************/	
 
	/*$wsOperaciones= new WsFacturacionOperaciones('https://presiatservicios.impuestos.gob.bo:39127/FacturacionEventosSignificativos?wsdl',2,$codigo_sistema,1,$nit,$cuis_electronica,0,0,'PUNTO1',1,
								"Descripcion inicio evento","972","2019-07-31T23:53:16.987-04:00","B528C2CCE3EC3BA3FBE44C565FD092CE");
	$resultop = $wsOperaciones->inicioEventoSignificativoOP();	
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
		
	/*$wsOperaciones= new WsFacturacionSincroniza('https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl',2,$codigo_sistema,$nit,$cuis_electronica,0,0,'1000000');
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
	/*		
	$concatenacion = MODCuf::concatenar(
											"196560027",//nit
											$fecha_formato2,//fecha emision
											"0",//sucursal
											"2",//modalidad
											"1",//tipo emision 1 online 2offline
											"1",// codigo documento fiscal
											"1",// codigo documento serctor
											$numero_fac,//nro factura
											"0");  //punto venta
											
											
	$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
	
	
	$concatenacion = $concatenacion . $mod11; 
	$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
	
	$cabecera = array(		
						"nitEmisor" => 196560027,
						"numeroFactura" => $numero_fac,						
						"cuf" => $base16,
						"cufd" => $cufd,
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
	
	$factura = new Factura('COMP_196560027_'.$numero_fac,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Computarizada");
	$factura->loadXml($cabecera,$detalle);	
	$factura->crearArchivoBase64();
	$factura->crearArchivoGZIP();
	$archivo_envio = $factura->convertirArchivoGZIPABase64();	
	$hash = hash ( "sha256" , $archivo_envio );
	
	
 	$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39112/FacturaComputarizadaEstandar?wsdl',
 							2,1,1,1,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,$fecha_formato1,$hash,$archivo_envio);
	$resultop = $wsOperaciones->recepcionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * VALIDA RECEPCION FACTURA ESTANDAR COMPUTARIZADA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39112/FacturaComputarizadaEstandar?wsdl',
 							2,1,1,1,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,NULL,NULL,NULL,3236323);
	$resultop = $wsOperaciones->validarRecepcionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * VALIDA RECEPCION FACTURA ESTANDAR COMPUTARIZADA X CUF
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39112/FacturaComputarizadaEstandar?wsdl',
 							2,1,1,1,2,0,'$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,NULL,NULL,NULL,NULL,$cuf);
	$resultop = $wsOperaciones->validaRecepcionFacturaEstandarxCuf();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * ANULACION FACTURA ESTANDAR COMPUTARIZADA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39112/FacturaComputarizadaEstandar?wsdl',
 							2,1,1,1,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,NULL,NULL,NULL,NULL,'226E0E73EEECA655D4B1AB5B4F12F6FE1C12B3E5',912,3);
	$resultop = $wsOperaciones->anulacionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * VALIDA ANULACION FACTURA ESTANDAR COMPUTARIZADA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39112/FacturaComputarizadaEstandar?wsdl',
 							2,1,1,1,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,NULL,NULL,NULL,150682,'226E0E73EEECA655D4B1AB5B4F12F6FE1C12B3E5',912,3);
	$resultop = $wsOperaciones->validaAnulacionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/**************************
 * RECEPCION FACTURA ESTANDAR ELECTRONICA
 **************************/
 	//creacion de carpeta donde se guarda los archivos xml y archivos encriptados.
 	
	
	/*$concatenacion = MODCuf::concatenar(
											$nit,//nit
											$fecha_formato2,//fecha emision
											"0",//sucursal
											"1",//modalidad
											"1",//tipo emision 1 online 2offline
											"1",// codigo documento fiscal
											"1",// codigo documento serctor
											$numero_fac,//nro factura
											"0");  //punto venta
											
											
	$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
	
	
	$concatenacion = $concatenacion . $mod11; 
	$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
	
	$cabecera = array(		
						"nitEmisor" => $nit,
						"numeroFactura" => $numero_fac,						
						"cuf" => $base16,
						"cufd" => $cufd,
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
	
	$factura = new Factura('ELE_196560027_'.$numero_fac,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Electronica");
	$factura->loadXml($cabecera,$detalle);
	$factura->sign(dirname(__FILE__).'/../firma_digital/server.p12');	
	$factura->crearArchivoBase64();
	$factura->crearArchivoGZIP();
	$archivo_envio = $factura->convertirArchivoGZIPABase64();	
	$hash = hash ( "sha256" , $archivo_envio );
	
	
 	$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39113/FacturaElectronicaEstandar?wsdl',
 							2,1,1,1,1,0,$codigo_sistema,0, $cufd,$cuis_electronica,$nit,$fecha_formato1,$hash,$archivo_envio);
	$resultop = $wsOperaciones->recepcionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/**************************
 * VALIDA RECEPCION FACTURA ESTANDAR ELECTRONICA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39113/FacturaElectronicaEstandar?wsdl',
 							2,1,1,1,1,0,$codigo_sistema,0, $cufd,$cuis_electronica,196560027,NULL,NULL,NULL,3236791);
	$resultop = $wsOperaciones->validarRecepcionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/**************************
 * VALIDA RECEPCION FACTURA ESTANDAR ELECTRONICA X CUF
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39113/FacturaElectronicaEstandar?wsdl',
 							2,1,1,1,1,0,$codigo_sistema,0, $cufd,$cuis_electronica,196560027,NULL,NULL,NULL,NULL,$cuf);
	$resultop = $wsOperaciones->validaRecepcionFacturaEstandarxCuf();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * ANULACION FACTURA ESTANDAR ELECTRONICA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39113/FacturaElectronicaEstandar?wsdl',
 							2,1,1,1,1,0,$codigo_sistema,0, $cufd,$cuis_electronica,196560027,NULL,NULL,NULL,NULL,'226E0E73EEECA656CA7506D9440DCB4C5A8A3A81',912,4);
	$resultop = $wsOperaciones->anulacionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * VALIDA ANULACION FACTURA ESTANDAR ELECTRONICA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39113/FacturaElectronicaEstandar?wsdl',
 							2,1,1,1,1,0,$codigo_sistema,0, $cufd,$cuis_electronica,196560027,NULL,NULL,NULL,150683,'226E0E73EEECA656CA7506D9440DCB4C5A8A3A81',912,4);
	$resultop = $wsOperaciones->validaAnulacionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
/**************************
 * RECEPCION FACTURA COMERCIAL EXPORTACION COMPUTARIZADA
 **************************/
 	//creacion de carpeta donde se guarda los archivos xml y archivos encriptados.
 	
	/*
	$concatenacion = MODCuf::concatenar(
											"196560027",//nit
											$fecha_formato2,//fecha emision
											"0",//sucursal
											"2",//modalidad
											"1",//tipo emision 1 online 2offline
											"1",// codigo documento fiscal
											"12",// codigo documento serctor
											$numero_fac,//nro factura
											"0");  //punto venta
											
											
	$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
	
	
	$concatenacion = $concatenacion . $mod11; 
	$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
	
	$cabecera = array(		
						"nitEmisor" => 196560027,
						"numeroFactura" => $numero_fac,						
						"cuf" => $base16,
						"cufd" => $cufd,
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
						"montoTotal" => "69600",
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
	
	$factura = new Factura('COM_196560027_'.$numero_fac,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Computarizada","ComercialExportacion");
	$factura->loadXml($cabecera,$detalle);	
	$factura->crearArchivoBase64();
	$factura->crearArchivoGZIP();
	$archivo_envio = $factura->convertirArchivoGZIPABase64();	
	$hash = hash ( "sha256" , $archivo_envio );
	
	
 	$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39116/FacturaComputarizadaComercialExportacion?wsdl',
 							2,1,12,1,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,$fecha_formato1,$hash,$archivo_envio);
	$resultop = $wsOperaciones->recepcionFacturaComercialExportacion();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
/**************************
 * VALIDA RECEPCION FACTURA COMERCIAL DE EXPORTACION COMPUTARIZADA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39116/FacturaComputarizadaComercialExportacion?wsdl',
 							2,1,12,1,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,NULL,NULL,NULL,108);
	$resultop = $wsOperaciones->validarRecepcionFacturaComercialExportacion();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/**************************
 * RECEPCION FACTURA COMERCIAL EXPORTACION ELECTRONICA
 **************************/
 	//creacion de carpeta donde se guarda los archivos xml y archivos encriptados.
 	
	/*
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
						"cufd" => "41081144AED93D6CB2714DE5050168B6",
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
	
	$factura = new Factura('ELE_196560027_4',dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Electronica","ComercialExportacion");
	$factura->loadXml($cabecera,$detalle);	
	$factura->sign(dirname(__FILE__).'/../firma_digital/server.p12');
	$factura->crearArchivoBase64();
	$factura->crearArchivoGZIP();
	$archivo_envio = $factura->convertirArchivoGZIPABase64();	
	$hash = hash ( "sha256" , $archivo_envio );
	
	
 	$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39124/FacturaElectronicaComercialExportacion?wsdl',
 							2,1,12,1,1,0,'5D778EC73EF',0, '41081144AED93D6CB2714DE5050168B6','9081F4D2',196560027,$fecha_formato1,$hash,$archivo_envio);
	$resultop = $wsOperaciones->recepcionFacturaComercialExportacion();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
/**************************
 * VALIDA RECEPCION FACTURA COMERCIAL DE EXPORTACION ELECTRONICA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39124/FacturaElectronicaComercialExportacion?wsdl',
 							2,1,12,1,1,0,'5D778EC73EF',0, '41081144AED93D6CB2714DE5050168B6','9081F4D2',196560027,NULL,NULL,NULL,89);
	$resultop = $wsOperaciones->validarRecepcionFacturaComercialExportacion();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * RECEPCION NOTA CREDITO DEBITO COMPUTARIZADA
 **************************/
 	//creacion de carpeta donde se guarda los archivos xml y archivos encriptados.
 	
	/*
	$concatenacion = MODCuf::concatenar(
											"196560027",//nit
											$fecha_formato2,//fecha emision
											"0",//sucursal
											"2",//modalidad
											"1",//tipo emision 1 online 2offline
											"2",// codigo documento fiscal
											"18",// codigo documento serctor
											$numero_nc,//nro factura
											"0");  //punto venta
											
											
	$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
	
	
	$concatenacion = $concatenacion . $mod11; 
	$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
	
	$cabecera = array(		 
						"nitEmisor" => 196560027,
						"numeroNotaCreditoDebito" => $numero_nc,						
						"cuf" => $base16,
						"cufd" => $cufd,
						"codigoSucursal" => 0,
						"direccion" => "Calle Ballivian Nro. 1333",
						"codigoPuntoVenta" => null,
						"fechaEmision" => $fecha_formato1,
						"nombreRazonSocial" => "Rivera",
						"codigoTipoDocumentoIdentidad" => 1,
						"numeroDocumento" => "4394565",						
						"complemento" => null,		 					
						"codigoCliente" => "C1",	 					
	 					"numeroFactura" => "5",
	 					"numeroAutorizacionCuf" => "226E0E73EEECA657176C780CB3956370A302A122",
	 					"fechaEmisionFactura" => "2019-08-30T01:15:12.215",	
						"montoTotalOriginal" => 100,
						"montoTotalDevuelto" => 100,
						"montoEfectivoCreditoDebito" => 13,						
						"leyenda" => "ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS. EL USO ILÍCITO DE ÉSTA SERÁ SANCIONADO DE ACUERDO A LEY",
						"usuario" => "JRIVERA",
						"codigoDocumentoSector" => 18												
						);
	$detalle = [
				[		"actividadEconomica" => 620200,
						"codigoProductoSin" => 83132,
						"codigoProducto" => "P1",
						"descripcion" => "Aplicacion de facturacion",
						"cantidad" => 1,
						"unidadMedida" => 57,		
						"precioUnitario" => "100.0",												
						"subTotal" => "100.0",
						"codigoDetalleTransaccion" => 1			
										
				],
				[		"actividadEconomica" => 620200,
						"codigoProductoSin" => 83132,
						"codigoProducto" => "P1",						
						"descripcion" => "Aplicacion de facturacion",
						"cantidad" => 1,
						"unidadMedida" => 57,		
						"precioUnitario" => "100.0",												
						"subTotal" => "100.0",
	 					"codigoDetalleTransaccion" => 2			
										
				]
			];	
	
	$factura = new Factura('COM_196560027_NC_'.$numero_nc,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Computarizada","CreditoDebito");
	$factura->loadXml($cabecera,$detalle);	
	$factura->crearArchivoBase64();
	$factura->crearArchivoGZIP();
	$archivo_envio = $factura->convertirArchivoGZIPABase64();	
	$hash = hash ( "sha256" , $archivo_envio );
	
	
 	$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39115/NotaFiscalComputarizadaCreditoDebito?wsdl',
 							2,2,18,1,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,$fecha_formato1,$hash,$archivo_envio);
	$resultop = $wsOperaciones->recepcionNotaCreditoDebito();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
/**************************
 * VALIDA RECEPCION NOTA CREDITO DEBITO COMPUTARIZADA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39115/NotaFiscalComputarizadaCreditoDebito?wsdl',
 							2,2,18,1,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,NULL,NULL,NULL,19806);
	$resultop = $wsOperaciones->validarRecepcionNotaCreditoDebito();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * ANULA NOTA CREDITO DEBITO COMPUTARIZADA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39115/NotaFiscalComputarizadaCreditoDebito?wsdl',
 							2,2,18,1,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,NULL,NULL,NULL,NULL,'226E0E73EEECA6D27086CF76A3788E7B7E72C6A5',912,5);
	$resultop = $wsOperaciones->anulacionNotaCreditoDebito();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/**************************
 * VALIDA ANULACION NOTA CREDITO DEBITO COMPUTARIZADA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39115/NotaFiscalComputarizadaCreditoDebito?wsdl',
 							2,2,18,1,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,NULL,NULL,NULL,153850,'226E0E73EEECA6D27086CF76A3788E7B7E72C6A5',912,5);
	$resultop = $wsOperaciones->validaAnulacionNotaCreditoDebito();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * RECEPCION NOTA CREDITO DEBITO ELECTRONICA
 **************************/
 	//creacion de carpeta donde se guarda los archivos xml y archivos encriptados.
 	
	/*
	$concatenacion = MODCuf::concatenar(
											"196560027",//nit
											$fecha_formato2,//fecha emision
											"0",//sucursal
											"1",//modalidad
											"1",//tipo emision 1 online 2offline
											"2",// codigo documento fiscal
											"18",// codigo documento serctor
											$numero_nc,//nro factura
											"0");  //punto venta
											
											
	$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
	
	
	$concatenacion = $concatenacion . $mod11; 
	$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
	
	$cabecera = array(		 
						"nitEmisor" => 196560027,
						"numeroNotaCreditoDebito" => $numero_nc,						
						"cuf" => $base16,
						"cufd" => $cufd,
						"codigoSucursal" => 0,
						"direccion" => "Calle Ballivian Nro. 1333",
						"codigoPuntoVenta" => null,
						"fechaEmision" => $fecha_formato1,
						"nombreRazonSocial" => "Rivera",
						"codigoTipoDocumentoIdentidad" => 1,
						"numeroDocumento" => "4394565",						
						"complemento" => null,		 					
						"codigoCliente" => "C1",	 					
	 					"numeroFactura" => "6",
	 					"numeroAutorizacionCuf" => "226E0E73EEECA6D28DD556ABDAF1AC05748D47C7",
	 					"fechaEmisionFactura" => "2019-09-04T18:18:32.000",	
						"montoTotalOriginal" => 100,
						"montoTotalDevuelto" => 100,
						"montoEfectivoCreditoDebito" => 13,						
						"leyenda" => "ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS. EL USO ILÍCITO DE ÉSTA SERÁ SANCIONADO DE ACUERDO A LEY",
						"usuario" => "JRIVERA",
						"codigoDocumentoSector" => 18												
						);
	$detalle = [
				[		"actividadEconomica" => 620200,
						"codigoProductoSin" => 83132,
						"codigoProducto" => "P1",
						"descripcion" => "Aplicacion de facturacion",
						"cantidad" => 1,
						"unidadMedida" => 57,		
						"precioUnitario" => "100.0",												
						"subTotal" => "100.0",
						"codigoDetalleTransaccion" => 1			
										
				],
				[		"actividadEconomica" => 620200,
						"codigoProductoSin" => 83132,
						"codigoProducto" => "P1",						
						"descripcion" => "Aplicacion de facturacion",
						"cantidad" => 1,
						"unidadMedida" => 57,		
						"precioUnitario" => "100.0",												
						"subTotal" => "100.0",
	 					"codigoDetalleTransaccion" => 2			
										
				]
			];	
	
	$factura = new Factura('ELE_196560027_NC_2',dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Electronica","CreditoDebito");
	$factura->loadXml($cabecera,$detalle);	
	$factura->sign(dirname(__FILE__).'/../firma_digital/server.p12');
	$factura->crearArchivoBase64();
	$factura->crearArchivoGZIP();
	$archivo_envio = $factura->convertirArchivoGZIPABase64();	
	$hash = hash ( "sha256" , $archivo_envio );
	
	
 	$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39125/NotaFiscalElectronicaCreditoDebito?wsdl',
 							2,2,18,1,1,0,$codigo_sistema,0, $cufd,$cuis_electronica,196560027,$fecha_formato1,$hash,$archivo_envio);
	$resultop = $wsOperaciones->recepcionNotaCreditoDebito();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
/**************************
 * VALIDA RECEPCION NOTA CREDITO DEBITO ELECTRONICA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39125/NotaFiscalElectronicaCreditoDebito?wsdl',
 							2,2,18,1,1,0,$codigo_sistema,0, $cufd,$cuis_electronica,196560027,NULL,NULL,NULL,19807);
	$resultop = $wsOperaciones->validarRecepcionNotaCreditoDebito();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/**************************
 * ANULA NOTA CREDITO DEBITO ELECTRONICA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39125/NotaFiscalElectronicaCreditoDebito?wsdl',
 							2,2,18,1,1,0,$codigo_sistema,0, $cufd,$cuis_electronica,196560027,NULL,NULL,NULL,NULL,'226E0E73EEECA6D2ABC107F1B752779CFAEA4D44',912,6);
	$resultop = $wsOperaciones->anulacionNotaCreditoDebito();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/**************************
 * VALIDA ANULACION NOTA CREDITO DEBITO ELECTRONICA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39125/NotaFiscalElectronicaCreditoDebito?wsdl',
 							2,2,18,1,1,0,$codigo_sistema,0, $cufd,$cuis_electronica,196560027,NULL,NULL,NULL,153851,'226E0E73EEECA6D2ABC107F1B752779CFAEA4D44',912,6);
	$resultop = $wsOperaciones->validaAnulacionNotaCreditoDebito();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/**************************
 * RECEPCION FACTURA ALQUILER COMPUTARIZADA
 **************************/
 	//creacion de carpeta donde se guarda los archivos xml y archivos encriptados.
 	
	
	//generar cuf
	/*
	$concatenacion = MODCuf::concatenar(
											"196560027",//nit
											$fecha_formato2,//fecha emision
											"0",//sucursal
											"2",//modalidad
											"1",//tipo emision 1 online 2offline
											"1",// codigo documento fiscal
											"3",// codigo documento serctor
											$numero_fac,//nro factura
											"0");  //punto venta
											
											
	$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
	
	
	$concatenacion = $concatenacion . $mod11; 
	$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
	
	$cabecera = array(		
						"nitEmisor" => 196560027,
						"numeroFactura" => $numero_fac,						
						"cuf" => $base16,
						"cufd" => $cufd,
						"codigoSucursal" => 0,
						"direccion" => "Calle Ballivian Nro. 1333",
						"codigoPuntoVenta" => null,
						"fechaEmision" => $fecha_formato1,
						"nombreRazonSocial" => "Rivera",
						"codigoTipoDocumentoIdentidad" => 1,
						"numeroDocumento" => "4394565",						
						"complemento" => null,	
						"codigoCliente" => "C1",
						"periodoFacturado" => "AGOSTO 2019",	
						"codigoMetodoPago" => 1,
						"numeroTarjeta" => null,
						"montoTotal" => "100.0",
						"montoDescuento" => null,
						"codigoMoneda" => 688,
						"tipoCambio" => "1.0",
						"montoTotalMoneda" => "100.0",
						"leyenda" => "El proveedor debera suministrar el servicio en las modalidades y terminos ofertados o convenidos",
						"usuario" => "JRIVERA",
						"codigoDocumentoSector" => 3,	
						"codigoExcepcionDocumento"=>null												
						);
	$detalle = [
				[		"actividadEconomica" => 620200,
						"codigoProductoSin" => 83132,
						"codigoProducto" => "P1",
						"descripcion" => "Aplicacion de facturacion",
						"cantidad" => 1,
						"unidadMedida" => 58,		
						"precioUnitario" => "100.0",
						"montoDescuento" => null,						
						"subTotal" => "100.0"					
										
				]
			];	
	
	$factura = new Factura('COMP_196560027_ALQ_'.$numero_fac,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Computarizada","AlquilerBienInmueble");
	$factura->loadXml($cabecera,$detalle);	
	$factura->crearArchivoBase64();
	$factura->crearArchivoGZIP();
	$archivo_envio = $factura->convertirArchivoGZIPABase64();	
	$hash = hash ( "sha256" , $archivo_envio );
	
	
 	$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39165/FacturaComputarizadaAlquilerBienInmueble?wsdl',
 							2,1,3,1,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,$fecha_formato1,$hash,$archivo_envio);
	$resultop = $wsOperaciones->recepcionFacturaAlquiler();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * VALIDA RECEPCION FACTURA ALQUILER COMPUTARIZADA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39165/FacturaComputarizadaAlquilerBienInmueble?wsdl',
 							2,1,3,1,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,NULL,NULL,NULL,24578);
	$resultop = $wsOperaciones->validarRecepcionFacturaAlquiler();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
	
/**************************
 * ANULACION FACTURA ALQUILER COMPUTARIZADA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39165/FacturaComputarizadaAlquilerBienInmueble?wsdl',
 							2,1,3,1,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,NULL,NULL,NULL,NULL,'226E0E73EEECA7CC98C8F5FD7614A3EBACFF9500',912,8);
	$resultop = $wsOperaciones->anulacionFacturaAlquiler();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * VALIDA ANULACION FACTURA ALQUILER COMPUTARIZADA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39165/FacturaComputarizadaAlquilerBienInmueble?wsdl',
 							2,1,3,1,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,NULL,NULL,NULL,158191,'226E0E73EEECA7CC98C8F5FD7614A3EBACFF9500',912,8);
	$resultop = $wsOperaciones->validaAnulacionFacturaAlquiler();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/**************************
 * RECEPCION FACTURA ALQUILER ELECTRONICA
 **************************/
 	//creacion de carpeta donde se guarda los archivos xml y archivos encriptados.
 	
	
	/*
	$concatenacion = MODCuf::concatenar(
											"196560027",//nit
											$fecha_formato2,//fecha emision
											"0",//sucursal
											"1",//modalidad
											"1",//tipo emision 1 online 2offline
											"1",// codigo documento fiscal
											"3",// codigo documento serctor
											$numero_fac,//nro factura
											"0");  //punto venta
											
											
	$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
	
	
	$concatenacion = $concatenacion . $mod11; 
	$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
	
	$cabecera = array(		
						"nitEmisor" => 196560027,
						"numeroFactura" => $numero_fac,						
						"cuf" => $base16,
						"cufd" => $cufd,
						"codigoSucursal" => 0,
						"direccion" => "Calle Ballivian Nro. 1333",
						"codigoPuntoVenta" => null,
						"fechaEmision" => $fecha_formato1,
						"nombreRazonSocial" => "Rivera",
						"codigoTipoDocumentoIdentidad" => 1,
						"numeroDocumento" => "4394565",						
						"complemento" => null,	
						"codigoCliente" => "C1",
						"periodoFacturado" => "AGOSTO 2019",	
						"codigoMetodoPago" => 1,
						"numeroTarjeta" => null,
						"montoTotal" => "100.0",
						"montoDescuento" => null,
						"codigoMoneda" => 688,
						"tipoCambio" => "1.0",
						"montoTotalMoneda" => "100.0",
						"leyenda" => "El proveedor debera suministrar el servicio en las modalidades y terminos ofertados o convenidos",
						"usuario" => "JRIVERA",
						"codigoDocumentoSector" => 3,	
						"codigoExcepcionDocumento"=>null												
						);
	$detalle = [
				[		"actividadEconomica" => 620200,
						"codigoProductoSin" => 83132,
						"codigoProducto" => "P1",
						"descripcion" => "Aplicacion de facturacion",
						"cantidad" => 1,
						"unidadMedida" => 58,		
						"precioUnitario" => "100.0",
						"montoDescuento" => null,						
						"subTotal" => "100.0"					
										
				]
			];	
	
	$factura = new Factura('ELE_196560027_ALQ_'.$numero_fac,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Electronica","AlquilerBienInmueble");
	$factura->loadXml($cabecera,$detalle);
	$factura->sign(dirname(__FILE__).'/../firma_digital/server.p12');	
	$factura->crearArchivoBase64();
	$factura->crearArchivoGZIP();
	$archivo_envio = $factura->convertirArchivoGZIPABase64();	
	$hash = hash ( "sha256" , $archivo_envio );
	
	
 	$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39166/FacturaElectronicaAlquilerBienInmueble?wsdl',
 							2,1,3,1,1,0,$codigo_sistema,0, $cufd,$cuis_electronica,196560027,$fecha_formato1,$hash,$archivo_envio);
	$resultop = $wsOperaciones->recepcionFacturaAlquiler();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/**************************
 * VALIDA RECEPCION FACTURA ALQUILER ELECTRONICA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39166/FacturaElectronicaAlquilerBienInmueble?wsdl',
 							2,1,3,1,1,0,$codigo_sistema,0, $cufd,$cuis_electronica,196560027,NULL,NULL,NULL,24579);
	$resultop = $wsOperaciones->validarRecepcionFacturaAlquiler();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

	
/**************************
 * ANULACION FACTURA ALQUILER ELECTRONICA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39166/FacturaElectronicaAlquilerBienInmueble?wsdl',
 							2,1,3,1,1,0,$codigo_sistema,0, $cufd,$cuis_electronica,196560027,NULL,NULL,NULL,NULL,'226E0E73EEECA7CD500EA52E9FEDC81ADF771BA6',912,9);
	$resultop = $wsOperaciones->anulacionFacturaAlquiler();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop); */
	
/**************************
 * VALIDA ANULACION ALQUILER ESTANDAR ELECTRONICA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39166/FacturaElectronicaAlquilerBienInmueble?wsdl',
 							2,1,3,1,1,0,$codigo_sistema,0, $cufd,$cuis_electronica,196560027,NULL,NULL,NULL,158235,'226E0E73EEECA7CD500EA52E9FEDC81ADF771BA6',912,9);
	$resultop = $wsOperaciones->validaAnulacionFacturaAlquiler();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/**************************
 * RECEPCION FACTURA VENTA MINERAL COMPUTARIZADA
 **************************/
 	//creacion de carpeta donde se guarda los archivos xml y archivos encriptados.
 	
	
	//generar cuf
	
	/*$concatenacion = MODCuf::concatenar(
											"196560027",//nit
											$fecha_formato2,//fecha emision
											"0",//sucursal
											"2",//modalidad
											"1",//tipo emision 1 online 2offline
											"1",// codigo documento fiscal
											"1",// codigo documento serctor
											$numero_fac,//nro factura
											"27");  //punto venta
											
											
	$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
	
	
	$concatenacion = $concatenacion . $mod11; 
	$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
	
	$cabecera = array(		
						"nitEmisor" => 196560027,
						"numeroFactura" => $numero_fac,						
						"cuf" => $base16,
						"cufd" => $cufd,
						"codigoSucursal" => 0,
						"direccion" => "Calle Ballivian Nro. 1333",
						"codigoPuntoVenta" => null,
						"fechaEmision" => $fecha_formato1,
						"nombreRazonSocial" => "Rivera",
						"codigoTipoDocumentoIdentidad" => 1,
						"numeroDocumento" => "4394565",						
						"complemento" => null,	
						"concentradoGranel" => "Zinc-Plata",	
						"origen" => "Potosi-Bolivia",	
						"codigoCliente" => "C1",	
						"codigoMoneda" => 689,
						"tipoCambioOficial" => 6.96,
						"tipoCambioANB" => 6.96,
						"numeroLote" => "18-ZN-QMA-009 FINAL",	
						"toneladasMetricasHumedas" => 346.81,	
						"merma" => 3,	
						"kilosNetosSecos" => 323.72,		
						"codigoMetodoPago" => 1,
						"numeroTarjeta" => null,						
						"montoTotal" => 223246.94,
						"montoTotalMoneda" => 32075.71,
						"subTotal" => 520118.53,
						"gastosRealizacion" => 74030.63,
						"impuestoValorAgregado" => 66656.81,
						"liquidacionPreliminar" => 480669.00,
						"leyenda" => "El proveedor debera suministrar el servicio en las modalidades y terminos ofertados o convenidos",
						"usuario" => "JRIVERA",
						"codigoDocumentoSector" => 27												
						);
	$detalle = [
				[		"actividadEconomica" => 620200,
						"codigoProductoSin" => 83132,
						"codigoProducto" => "P1",
						"codigoNandina" => "2616.10.00.00",
						"descripcion" => "Plata",
						"leyes" => 592,
						"finos" => 3800.73,						
						"unidadMedida" => 1,		
						"precioUnitario" => 16.86,										
						"subTotal" => 64061.30					
										
				]
			];	
	
	$factura = new Factura('COMP_196560027_MIN_'.$numero_fac,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Computarizada","VentaMineral");
	$factura->loadXml($cabecera,$detalle);	
	$factura->crearArchivoBase64();
	$factura->crearArchivoGZIP();
	$archivo_envio = $factura->convertirArchivoGZIPABase64();	
	$hash = hash ( "sha256" , $archivo_envio );
	
	
 	$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39112/FacturaComputarizadaEstandar?wsdl',
 							2,1,27,1,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,$fecha_formato1,$hash,$archivo_envio);
	$resultop = $wsOperaciones->recepcionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * VALIDA RECEPCION FACTURA VENTA MINERAL COMPUTARIZADA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39112/FacturaComputarizadaEstandar?wsdl',
 							2,1,27,1,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,NULL,NULL,NULL,3236323);
	$resultop = $wsOperaciones->validarRecepcionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
	
/**************************
 * ANULACION FACTURA VENTA MINERAL COMPUTARIZADA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39112/FacturaComputarizadaEstandar?wsdl',
 							2,1,27,1,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,NULL,NULL,NULL,NULL,'226E0E73EEECA655D4B1AB5B4F12F6FE1C12B3E5',912,3);
	$resultop = $wsOperaciones->anulacionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * VALIDA ANULACION FACTURA VENTA MINERAL COMPUTARIZADA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39112/FacturaComputarizadaEstandar?wsdl',
 							2,1,27,1,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,NULL,NULL,NULL,150682,'226E0E73EEECA655D4B1AB5B4F12F6FE1C12B3E5',912,3);
	$resultop = $wsOperaciones->validaAnulacionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/**************************
 * RECEPCION FACTURA VENTA MINERAL ELECTRONICA
 **************************/
 	//creacion de carpeta donde se guarda los archivos xml y archivos encriptados.
 	
	/*
	$concatenacion = MODCuf::concatenar(
											"196560027",//nit
											$fecha_formato2,//fecha emision
											"0",//sucursal
											"1",//modalidad
											"1",//tipo emision 1 online 2offline
											"1",// codigo documento fiscal
											"27",// codigo documento serctor
											$numero_fac,//nro factura
											"0");  //punto venta
											
											
	$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
	
	
	$concatenacion = $concatenacion . $mod11; 
	$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
	
	$cabecera = array(		
						"nitEmisor" => 196560027,
						"numeroFactura" => $numero_fac,						
						"cuf" => $base16,
						"cufd" => $cufd,
						"codigoSucursal" => 0,
						"direccion" => "Calle Ballivian Nro. 1333",
						"codigoPuntoVenta" => null,
						"fechaEmision" => $fecha_formato1,
						"nombreRazonSocial" => "Rivera",
						"codigoTipoDocumentoIdentidad" => 1,
						"numeroDocumento" => "4394565",						
						"complemento" => null,	
						"concentradoGranel" => "Zinc-Plata",	
						"origen" => "Potosi-Bolivia",	
						"codigoCliente" => "C1",	
						"codigoMoneda" => 689,
						"tipoCambioOficial" => 6.96,
						"tipoCambioANB" => 6.96,
						"numeroLote" => "18-ZN-QMA-009 FINAL",	
						"toneladasMetricasHumedas" => 346.81,	
						"merma" => 3,	
						"kilosNetosSecos" => 323.72,		
						"codigoMetodoPago" => 1,
						"numeroTarjeta" => null,						
						"montoTotal" => 223246.94,
						"montoTotalMoneda" => 32075.71,
						"subTotal" => 520118.53,
						"gastosRealizacion" => 74030.63,
						"impuestoValorAgregado" => 66656.81,
						"liquidacionPreliminar" => 480669.00,
						"leyenda" => "El proveedor debera suministrar el servicio en las modalidades y terminos ofertados o convenidos",
						"usuario" => "JRIVERA",
						"codigoDocumentoSector" => 27												
						);
	$detalle = [
				[		"actividadEconomica" => 620200,
						"codigoProductoSin" => 83132,
						"codigoProducto" => "P1",
						"codigoNandina" => "2616.10.00.00",
						"descripcion" => "Plata",
						"leyes" => 592,
						"finos" => 3800.73,						
						"unidadMedida" => 1,		
						"precioUnitario" => 16.86,										
						"subTotal" => 64061.30					
										
				]
			];	
	
	$factura = new Factura('ELE_196560027_MIN_'.$numero_fac,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Electronica");
	$factura->loadXml($cabecera,$detalle);
	$factura->sign(dirname(__FILE__).'/../firma_digital/server.p12');	
	$factura->crearArchivoBase64();
	$factura->crearArchivoGZIP();
	$archivo_envio = $factura->convertirArchivoGZIPABase64();	
	$hash = hash ( "sha256" , $archivo_envio );
	
	
 	$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39113/FacturaElectronicaEstandar?wsdl',
 							2,1,27,1,1,0,$codigo_sistema,0, $cufd,$cuis_electronica,196560027,$fecha_formato1,$hash,$archivo_envio);
	$resultop = $wsOperaciones->recepcionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

/**************************
 * VALIDA RECEPCION FACTURA VENTA MINERAL ELECTRONICA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39113/FacturaElectronicaEstandar?wsdl',
 							2,1,27,1,1,0,$codigo_sistema,0, $cufd,$cuis_electronica,196560027,NULL,NULL,NULL,3236791);
	$resultop = $wsOperaciones->validarRecepcionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/

	
/**************************
 * ANULACION FACTURA VENTA MINERAL ELECTRONICA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39113/FacturaElectronicaEstandar?wsdl',
 							2,1,27,1,1,0,$codigo_sistema,0, $cufd,$cuis_electronica,196560027,NULL,NULL,NULL,NULL,'226E0E73EEECA656CA7506D9440DCB4C5A8A3A81',912,4);
	$resultop = $wsOperaciones->anulacionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * VALIDA ANULACION FACTURA VENTA MINERAL ELECTRONICA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39113/FacturaElectronicaEstandar?wsdl',
 							2,1,27,1,1,0,$codigo_sistema,0, $cufd,$cuis_electronica,196560027,NULL,NULL,NULL,150683,'226E0E73EEECA656CA7506D9440DCB4C5A8A3A81',912,4);
	$resultop = $wsOperaciones->validaAnulacionFacturaEstandar();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * RECEPCION FACTURA COMPUTARIZADA ESTANDAR MASIVAAAAA
 **************************/
 	/*$a = new PharData(dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/paquete.tar');
	for ($i = 1; $i <= 10; $i++) {		
		$fecha = new DateTime();
		$fecha_formato1 = $fecha->format('Y-m-dH:i:s.000');
		$fecha_formato1 = substr($fecha_formato1, 0, 10) . 'T' . substr($fecha_formato1, 10);	
		$fecha_formato2 = $fecha->format('YmdHis000');
		$concatenacion = MODCuf::concatenar(
												"196560027",//nit
												$fecha_formato2,//fecha emision
												"0",//sucursal
												"2",//modalidad
												"2",//tipo emision 1 online 2offline
												"1",// codigo documento fiscal
												"1",// codigo documento serctor
												$numero_fac,//nro factura
												"0");  //punto venta
												
												
		$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
		
		
		$concatenacion = $concatenacion . $mod11; 
		$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
		
		$cabecera = array(		
							"nitEmisor" => 196560027,
							"numeroFactura" => $numero_fac,						
							"cuf" => $base16,
							"cufd" => $cufd,
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
		
		$factura = new Factura('COMP_196560027_'.$numero_fac,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Computarizada");
		$factura->loadXml($cabecera,$detalle);	
		$factura->crearArchivoBase64();
		$factura->crearArchivoGZIP();
		$archivo_envio = $factura->convertirArchivoGZIPABase64();
	    $a->addFile(realpath(dirname(__FILE__)."/../../uploaded_files/archivos_facturacion_xml/COMP_196560027_" . $numero_fac . "_FirmadoB64.txt"),"COMP_196560027_" . $numero_fac . "_FirmadoB64.txt");
		$numero_fac++;
	}
	
	Factura::crearArchivoGZIPMasivo(dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/paquete.tar',dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/paqueteGzip.tar.gz');
	$archivo_envio = Factura::convertirArchivoGZIPABase64Masivo(dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/paqueteGzip.tar.gz',dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/paqueteGzipB64.txt');
	$hash = hash ( "sha256" , $archivo_envio );
	
	$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39112/FacturaComputarizadaEstandar?wsdl',
 							2,1,1,2,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,$fecha_formato1,$hash,$archivo_envio);
	$resultop = $wsOperaciones->recepcionFacturaEstandarPaquete();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * VALIDA RECEPCION FACTURA ESTANDAR COMPUTARIZADA MASIVA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39112/FacturaComputarizadaEstandar?wsdl',
 							2,1,1,2,2,0,$codigo_sistema,0, $cufd,$cuis_computarizada,196560027,NULL,NULL,NULL,69384);
	$resultop = $wsOperaciones->validarRecepcionFacturaEstandarPaquete();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * RECEPCION FACTURA ELECTRONICA ESTANDAR MASIVAAAAA
 **************************/
 	/*$a = new PharData(dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/paquete_ele.tar');
	for ($i = 1; $i <= 10; $i++) {		
		$fecha = new DateTime();
		$fecha_formato1 = $fecha->format('Y-m-dH:i:s.000');
		$fecha_formato1 = substr($fecha_formato1, 0, 10) . 'T' . substr($fecha_formato1, 10);	
		$fecha_formato2 = $fecha->format('YmdHis000');
		$concatenacion = MODCuf::concatenar(
												$nit,//nit
												$fecha_formato2,//fecha emision
												"0",//sucursal
												"1",//modalidad
												"2",//tipo emision 1 online 2offline
												"1",// codigo documento fiscal
												"1",// codigo documento serctor
												$numero_fac,//nro factura
												"0");  //punto venta
												
												
		$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
		
		
		$concatenacion = $concatenacion . $mod11; 
		$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
		
		$cabecera = array(		
							"nitEmisor" => $nit,
							"numeroFactura" => $numero_fac,						
							"cuf" => $base16,
							"cufd" => $cufd,
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
		
		$factura = new Factura('ELE_196560027_'.$numero_fac,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Electronica");
		$factura->loadXml($cabecera,$detalle);	
		$factura->sign(dirname(__FILE__).'/../firma_digital/server.p12');
		$factura->crearArchivoBase64();
		$factura->crearArchivoGZIP();
		$archivo_envio = $factura->convertirArchivoGZIPABase64();
	    $a->addFile(realpath(dirname(__FILE__)."/../../uploaded_files/archivos_facturacion_xml/ELE_196560027_" . $numero_fac . "_FirmadoB64.txt"),"ELE_196560027_" . $numero_fac . "_FirmadoB64.txt");
		$numero_fac++;
	}
	
	Factura::crearArchivoGZIPMasivo(dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/paquete_ele.tar',dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/paqueteGzip_ele.tar.gz');
	$archivo_envio = Factura::convertirArchivoGZIPABase64Masivo(dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/paqueteGzip_ele.tar.gz',dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/paqueteGzipB64_ele.txt');
	$hash = hash ( "sha256" , $archivo_envio );
	
	$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39113/FacturaElectronicaEstandar?wsdl',
 							2,1,1,2,1,0,$codigo_sistema,0, $cufd,$cuis_electronica,$nit,$fecha_formato1,$hash,$archivo_envio);
	$resultop = $wsOperaciones->recepcionFacturaEstandarPaquete();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
/**************************
 * VALIDA RECEPCION FACTURA ESTANDAR ELECTRONICA MASIVA
 **************************/
 
 	/*$wsOperaciones= new WsFacturacion('https://presiatservicios.impuestos.gob.bo:39113/FacturaElectronicaEstandar?wsdl',
 							2,1,1,2,1,0,$codigo_sistema,0, $cufd,$cuis_electronica,$nit,NULL,NULL,NULL,93782);
	$resultop = $wsOperaciones->validarRecepcionFacturaEstandarPaquete();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);*/
	
?>
</pre>