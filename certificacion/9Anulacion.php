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
$tipo_emision = array(1,1,1,1,1,1);
$documento_fiscal = array(1,1,1,1,2,2);
$documento_sector = array(1,1,3,3,18,18);//18 nota de debito credito 3 factura de alquiler 1 factura
$punto_venta = array(1,0,1,0,1,0);


for ($i=0;$i<count($tipo_emision);$i++){
	//cufd punto de venta i
	$wsOperaciones= new WsFacturacionOperaciones(
		'https://presiatservicios.impuestos.gob.bo:39268/FacturacionSolicitudCufd?wsdl',
		$ambiente,
		$codigo_sistema,
		$modalidad,
		$nit,
		$cuis_electronica,
		$sucursal,//sucursal
		$punto_venta[$i]);//punto de venta
		
	$resultop = $wsOperaciones->solicitudCufdOp();
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	$cufd = $rop['RespuestaCufd']['codigo'];

	if ($documento_sector[$i] == 18) {
		$url = 'https://presiatservicios.impuestos.gob.bo:39125/NotaFiscalElectronicaCreditoDebito?wsdl';
	} else if ($documento_sector[$i] == 3) {
		$url = 'https://presiatservicios.impuestos.gob.bo:39166/FacturaElectronicaAlquilerBienInmueble?wsdl';
	} else {
		$url = 'https://presiatservicios.impuestos.gob.bo:39113/FacturaElectronicaEstandar?wsdl';
	}
	//generar factura
	$fecha = new DateTime();
	$fecha_formato1 = $fecha->format('Y-m-dH:i:s.000');
	$fecha_formato1 = substr($fecha_formato1, 0, 10) . 'T' . substr($fecha_formato1, 10);	
	$fecha_formato2 = $fecha->format('YmdHis000');
	$concatenacion = MODCuf::concatenar(
											$nit,//nit
											$fecha_formato2,//fecha emision
											$sucursal,//sucursal
											$modalidad,//modalidad
											$tipo_emision[$i],//tipo emision 1 online 2offline
											$documento_fiscal[$i],// codigo documento fiscal
											$documento_sector[$i],// codigo documento serctor
											$documento_sector[$i] == 18?$numero_nc:$numero_fac,//nro factura
											$punto_venta[$i]);  //punto venta
											
											
	$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
	
	
	$concatenacion = $concatenacion . $mod11; 
	$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
	$cabecera = generarCabecera($nit,$documento_sector[$i] == 18?$numero_fac-1:$numero_fac,$numero_nc,$base16,$cufd,$sucursal,$punto_venta[$i],$fecha_formato1,$documento_sector[$i]);
	$detalle = generarDetalle($documento_sector[$i],$codigo_producto,$actividad);
	
	if ($documento_sector[$i] == 18) {
	 	$factura = new Factura('ELE_196560027_'.$numero_fac,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Electronica","CreditoDebito");
	} else if ($documento_sector[$i] == 3) {
		$factura = new Factura('ELE_196560027_'.$numero_fac,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Electronica","AlquilerBienInmueble");
	} else {
		$factura = new Factura('ELE_196560027_'.$numero_fac,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Electronica");	
	}	
	
	$factura->loadXml($cabecera,$detalle);
	$factura->sign(dirname(__FILE__).'/../firma_digital/server.p12');	
	$factura->crearArchivoBase64();
	$factura->crearArchivoGZIP();
	$archivo_envio = $factura->convertirArchivoGZIPABase64();	
	if ($tipo_emision[$i] == 2) {
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
 		$documento_fiscal[$i],
 		$documento_sector[$i],
 		$tipo_emision[$i],
 		$modalidad,
 		$punto_venta[$i],//punto de venta
 		$codigo_sistema,
 		$sucursal, 
 		$cufd,
 		$cuis_electronica,
 		$nit,
 		$fecha_formato1,
 		$hash,
 		$archivo_envio);
	
	if ($documento_sector[$i] == 18) {	 	
		$resultop = $tipo_emision[$i] == 1?$wsOperaciones->recepcionNotaCreditoDebito():$wsOperaciones->recepcionNotaCreditoDebitoPaquete();		
	} else if ($documento_sector[$i] == 3) {		
		$resultop = $tipo_emision[$i] == 1?$wsOperaciones->recepcionFacturaAlquiler():$wsOperaciones->recepcionFacturaAlquilerPaquete();	
	} else {
		$resultop = $tipo_emision[$i] == 1?$wsOperaciones->recepcionFacturaEstandar():$wsOperaciones->recepcionFacturaEstandarPaquete();	
	}
	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	$codigo_recepcion = $rop['RespuestaServicioFacturacion']['codigoRecepcion'];
	//print_r($rop);
	$wsOperaciones= new WsFacturacion(
		$url,
 		$ambiente,
 		$documento_fiscal[$i],
 		$documento_sector[$i],
 		$tipo_emision[$i],
 		$modalidad,
 		$punto_venta[$i],
 		$codigo_sistema,
 		$sucursal, 
 		$cufd,
 		$cuis_electronica,
 		$nit,
 		NULL,
 		NULL,
 		NULL,
 		$codigo_recepcion);
		
	if ($documento_sector[$i] == 18) {	 	
		$resultop = $tipo_emision[$i] == 1?$wsOperaciones->validarRecepcionNotaCreditoDebito():$wsOperaciones->validarRecepcionNotaCreditoDebitoPaquete();		
	} else if ($documento_sector[$i] == 3) {		
		$resultop = $tipo_emision[$i] == 1?$wsOperaciones->validarRecepcionFacturaAlquiler():$wsOperaciones->validarRecepcionFacturaAlquilerPaquete();	
	} else {
		$resultop = $tipo_emision[$i] == 1?$wsOperaciones->validarRecepcionFacturaEstandar():$wsOperaciones->validarRecepcionFacturaEstandarPaquete();	
	}	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	//print_r($rop);
	
	/*************ANULACION****************/
	$wsOperaciones= new WsFacturacion(
		$url,
 		$ambiente,
 		$documento_fiscal[$i],
 		$documento_sector[$i],
 		$tipo_emision[$i],
 		$modalidad,
 		$punto_venta[$i],
 		$codigo_sistema,
 		$sucursal, 
 		$cufd,
 		$cuis_electronica,
 		$nit,
 		NULL,
 		NULL,
 		NULL,
 		NULL,
 		$base16,
 		912,
 		$documento_sector[$i] == 18?$numero_nc:$numero_fac);
	
	if ($documento_sector[$i] == 18) {	 	
		$resultop = $wsOperaciones->anulacionNotaCreditoDebito();	
	} else if ($documento_sector[$i] == 3) {		
		$resultop = $wsOperaciones->anulacionFacturaAlquiler();	
	} else {
		$resultop = $wsOperaciones->anulacionFacturaEstandar();	
	}	
	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	//print_r($rop);	
	
 	$codigo_recepcion = $rop['RespuestaServicioFacturacion']['codigoRecepcion']; 	
	
	/****************VALIDAR ANULCAION***************/
	$wsOperaciones= new WsFacturacion(
		$url,
 		$ambiente,
 		$documento_fiscal[$i],
 		$documento_sector[$i],
 		$tipo_emision[$i],
 		$modalidad,
 		$punto_venta[$i],
 		$codigo_sistema,
 		$sucursal, 
 		$cufd,
 		$cuis_electronica,
 		$nit,
 		NULL,
 		NULL,
 		NULL,
 		$codigo_recepcion,
 		$base16,
 		912,
 		$documento_sector[$i] == 18?$numero_nc:$numero_fac);
		
	if ($documento_sector[$i] == 18) {	 	
		$resultop = $wsOperaciones->validaAnulacionNotaCreditoDebito();	
	} else if ($documento_sector[$i] == 3) {		
		$resultop = $wsOperaciones->validaAnulacionFacturaAlquiler();	
	} else {
		$resultop = $wsOperaciones->validaAnulacionFacturaEstandar();	
	}	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);
	
	if ($documento_sector[$i] != 18) {
		$numero_fac++;
	} else {
		$numero_nc++;
	}
}


