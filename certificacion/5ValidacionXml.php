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
require(dirname(__FILE__).'/generarArrays.php');

$codigo_sistema= "88E2935BFD6";
$cuis_computarizada = "B1506967";
$cuis_electronica = "4CB33E78";
$ambiente = 2;//1 produccion 2 pruebas
$modalidad = 1;//1 electronica 2 computarizada
$sucursal = 0;
$nit = 1023097024;
$codigo_producto = '86311';
$actividad = '351020';

session_start();

$numero_fac = 1;
$numero_nc = 1;

//cufd punto de venta i
$wsOperaciones= new WsFacturacionOperaciones(
	'https://presiatservicios.impuestos.gob.bo:39268/FacturacionSolicitudCufd?wsdl',
	$ambiente,
	$codigo_sistema,
	$modalidad,
	$nit,
	$cuis_electronica,
	0,//sucursal
	0);//punto de venta
	
$resultop = $wsOperaciones->solicitudCufdOp();
$rop = $wsOperaciones->ConvertObjectToArray($resultop);
$cufd = $rop['RespuestaCufd']['codigo'];

$fn = fopen("5validacionxml.csv","r");
  
while(! feof($fn))  {
	$i=0;
	$result = fgets($fn);
	$result = explode(',', $result);
	if ($result[3] == '18') {
		$url = 'https://presiatservicios.impuestos.gob.bo:39125/NotaFiscalElectronicaCreditoDebito?wsdl';
	} else if ($result[3] == '3') {
		$url = 'https://presiatservicios.impuestos.gob.bo:39166/FacturaElectronicaAlquilerBienInmueble?wsdl';
	} else {
		$url = 'https://presiatservicios.impuestos.gob.bo:39113/FacturaElectronicaEstandar?wsdl';
	}
	
	//generar factura
	$fecha = new DateTime();
	if (strpos($result[2], 'fecha') && strpos($result[2], '+')) {
		$fecha->modify('+1 day');
	}
	if (strpos($result[2], 'fecha') && strpos($result[2], '-')) {
		$fecha->modify('-1 day');
	}
	
	$fecha_formato1 = $fecha->format('Y-m-dH:i:s.000');
	$fecha_formato1 = substr($fecha_formato1, 0, 10) . 'T' . substr($fecha_formato1, 10);	
	$fecha_formato2 = $fecha->format('YmdHis000');
	$concatenacion = MODCuf::concatenar(
											$nit,//nit
											$fecha_formato2,//fecha emision
											$sucursal,//sucursal
											$modalidad,//modalidad
											$result[0],//tipo emision 1 online 2offline
											$result[3]=='18'?2:1,// codigo documento fiscal
											$result[3],// codigo documento serctor
											$result[3] == '18'?$numero_nc:$numero_fac,//nro factura
											0);  //punto venta
											
											
	$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
	
	
	$concatenacion = $concatenacion . $mod11; 
	$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
	$cabecera = generarCabecera($nit,$result[3]=='18'?$numero_fac-1:$numero_fac,$numero_nc,$base16,$cufd,$sucursal,0,$fecha_formato1,$result[3]);
	$detalle = generarDetalle($result[3],$codigo_producto,$actividad);
	
	if ($result[3] == '18') {
	 	$factura = new Factura('ELE_196560027_'.$numero_fac,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Electronica","CreditoDebito");
	} else if ($result[3] == '3') {
		$factura = new Factura('ELE_196560027_'.$numero_fac,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Electronica","AlquilerBienInmueble");
	} else {
		$factura = new Factura('ELE_196560027_'.$numero_fac,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Electronica");	
	}	

	/*AUQI MODIFICAR CON DATOS DE ARCHIVO*/
	
	if ($result[1] == '' || $result[1] == '') {
		$detalle[$result[1]] = $result[2];
	} else if (!strpos($result[2],'su NIT') &&  !strpos($result[2],'fecha actual')) {
		$cabecera[$result[1]] = $result[2];
	}
	
	$factura->loadXml($cabecera,$detalle);
	$factura->sign(dirname(__FILE__).'/../firma_digital/server.p12');	
	$factura->crearArchivoBase64();
	$factura->crearArchivoGZIP();
	$archivo_envio = $factura->convertirArchivoGZIPABase64();	
	if ($result[0] == 2) {
		$name = 'paquete'.$i.'.tar';
		unlink(dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/' . $name);
		$a = new PharData(dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/' .$name);
		$a->addFile(realpath(dirname(__FILE__)."/../../uploaded_files/archivos_facturacion_xml/ELE_196560027_" . $numero_fac . "_FirmadoB64.txt"),"ELE_196560027_" . $numero_fac . "_FirmadoB64.txt");
		Factura::crearArchivoGZIPMasivo(dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/'. $name,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/paqueteGzip.tar.gz');
		$archivo_envio = Factura::convertirArchivoGZIPABase64Masivo(dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/paqueteGzip.tar.gz',dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/paqueteGzipB64.txt');
	} 
	$hash = hash ( "sha256" , $archivo_envio );
	
	$wsOperaciones= new WsFacturacion(
 		$url,
 		$ambiente,
 		$result[3]=='18'?2:1,
 		$result[3],
 		$result[0],
 		$modalidad,
 		0,//punto de venta
 		$codigo_sistema,
 		$sucursal, 
 		$cufd,
 		$cuis_electronica,
 		$nit,
 		$fecha_formato1,
 		$hash,
 		$archivo_envio);
	
	if ($result[3] == '18') {	 	
		$resultop = $result[0] == 1?$wsOperaciones->recepcionNotaCreditoDebito():$wsOperaciones->recepcionNotaCreditoDebitoPaquete();		
	} else if ($result[3] == '3') {		
		$resultop = $result[0] == 1?$wsOperaciones->recepcionFacturaAlquiler():$wsOperaciones->recepcionFacturaAlquilerPaquete();	
	} else {
		$resultop = $result[0] == 1?$wsOperaciones->recepcionFacturaEstandar():$wsOperaciones->recepcionFacturaEstandarPaquete();	
	}
	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	$codigo_recepcion = $rop['RespuestaServicioFacturacion']['codigoRecepcion'];
	//print_r($rop);
	$wsOperaciones= new WsFacturacion(
		$url,
 		$ambiente,
 		$result[3]=='18'?2:1,
 		$result[3],
 		$result[0],
 		$modalidad,
 		0,
 		$codigo_sistema,
 		$sucursal, 
 		$cufd,
 		$cuis_electronica,
 		$nit,
 		NULL,
 		NULL,
 		NULL,
 		$codigo_recepcion);
		
	if ($result[3] == '18') {	 	
		$resultop = $result[0] == 1?$wsOperaciones->validarRecepcionNotaCreditoDebito():$wsOperaciones->validarRecepcionNotaCreditoDebitoPaquete();		
	} else if ($result[3] == '3') {		
		$resultop = $result[0] == 1?$wsOperaciones->validarRecepcionFacturaAlquiler():$wsOperaciones->validarRecepcionFacturaAlquilerPaquete();	
	} else { 
		$resultop = $result[0] == 1?$wsOperaciones->validarRecepcionFacturaEstandar():$wsOperaciones->validarRecepcionFacturaEstandarPaquete();	
	}	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);
	
	if ($result[3] != 18) {
		$numero_fac++;
	} else {
		$numero_nc++;
	} 
	$i++
	
}

fclose($fn);
