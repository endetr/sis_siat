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
$url = 'https://presiatservicios.impuestos.gob.bo:39113/FacturaElectronicaEstandar?wsdl';

session_start();

$name = 'paquete'.'.tar';

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
/*
//registro evento sgnificativo
$wsOperaciones= new WsFacturacionOperaciones(
	'https://presiatservicios.impuestos.gob.bo:39127/FacturacionEventosSignificativos?wsdl',
	$ambiente,
	$codigo_sistema,
	$modalidad,
	$nit,
	$cuis_electronica,
	$sucursal,
	0,//punto de venta
	'PUNTO1',//nombre punto de venta no es util para este servicio
	1,//codigo punto de venta no es util para este servicio
	"Descripcion inicio evento",//descripcion evento
	973,//codigo evento significativo
	"2019-11-21T08:53:16.987",
	$cufd
	);
$resultop = $wsOperaciones->inicioEventoSignificativoOP();	
$rop = $wsOperaciones->ConvertObjectToArray($resultop);		
$codigo_evento = $rop['RespuestaListaEventos']['codigoRecepcionEventoSignificativo'];
var_dump($rop);

$wsOperaciones= new WsFacturacionOperaciones(
	'https://presiatservicios.impuestos.gob.bo:39127/FacturacionEventosSignificativos?wsdl',
	$ambiente,
	$codigo_sistema,
	$modalidad,
	$nit,
	$cuis_electronica,
	$sucursal,
	0,//punto de venta
	'PUNTO1',//nombre punto de venta no es util para este servicio
	1,//codigo punto de venta no es util para este servicio
	"Descripcion inicio evento",//descripcion evento
	973,//codigo evento significativo
	"2019-11-21T08:53:16.987",
	$cufd,
	"2019-11-21T20:53:16.987",
	$codigo_evento
	);
$resultop = $wsOperaciones->finEventoSignificativoOP();	
$rop = $wsOperaciones->ConvertObjectToArray($resultop);	
var_dump($rop);
*/


for ($i = 0;$i<10;$i++){
	unlink(dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/' . $name);
	$a = new PharData(dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/' .$name);
	generarFacturas($nit, $sucursal, $modalidad,$cufd,$a,500,0);//aqui cambiar la cantidad de validos e invalidos que se queire generar
	Factura::crearArchivoGZIPMasivo(dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/'. $name,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/paqueteGzip.tar.gz');
	$archivo_envio = Factura::convertirArchivoGZIPABase64Masivo(dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/paqueteGzip.tar.gz',dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/paqueteGzipB64.txt');

	$hash = hash ( "sha256" , $archivo_envio ); 		
	$fecha = new DateTime();
	//$fecha->modify('-1 day');	
	$fecha_formato1 = $fecha->format('Y-m-dH:i:s.000');
	$fecha_formato1 = substr($fecha_formato1, 0, 10) . 'T' . substr($fecha_formato1, 10);	
	echo "<br>===============================<br>";
	echo $archivo_envio;
	echo "<br>=================================<br>";
	echo "<br>===============================<br>";
	echo $hash;
	echo "<br>=================================<br>";
	echo "<br>===============================<br>";
	echo $fecha_formato1;
	echo "<br>=================================<br>";
	echo $cufd;
	echo "<br>=================================<br>";
	$wsOperaciones= new WsFacturacion(
		$url,
		$ambiente,
		1,//codigo documento fiscal
		1,//codigo documento sector
		2, //codigo emision 1 inline 2 offline
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
	
	$resultop = $wsOperaciones->recepcionFacturaEstandarPaquete();		
	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	$codigo_recepcion = $rop['RespuestaServicioFacturacion']['codigoRecepcion'];
	//echo $codigo_recepcion;
	print_r($rop);	
}

function generarFacturas($nit,$sucursal,$modalidad,$cufd,$a,$cantidad_validas,$cantidad_invalidas) {
	$numero_fac = 1;	
	$numero_nc = 1;	
	$codigo_producto = '86311';
	$actividad = '351020';	
	for ($i=0;$i<$cantidad_validas + $cantidad_invalidas;$i++) {
		//generar factura
		$fecha = new DateTime();
		$fecha->modify('-1 day');
		$fecha_formato1 = $fecha->format('Y-m-dH:i:s.000');
		$fecha_formato1 = substr($fecha_formato1, 0, 10) . 'T' . substr($fecha_formato1, 10);	
		$fecha_formato2 = $fecha->format('YmdHis000');	
		$concatenacion = MODCuf::concatenar(
												$nit,//nit
												$fecha_formato2,//fecha emision
												$sucursal,//sucursal
												$modalidad,//modalidad																					
												2,//tipo emision 1 online 2offline
												1,// codigo documento fiscal
												1,// codigo documento serctor
												$numero_fac,//nro factura
												0);  //punto venta											
										
		$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
		
		
		$concatenacion = $concatenacion . $mod11; 
		$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
		if ($i>=$cantidad_validas) {
			$base16 = 'XXX';
		}
		$cabecera = generarCabecera($nit,$numero_fac,$numero_nc,$base16,$cufd,$sucursal,0,$fecha_formato1,1);
		$detalle = generarDetalle(1,$codigo_producto,$actividad);
			
		$factura = new Factura('ELE_196560027_'.$numero_fac,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Electronica");	
		
			
		$factura->loadXml($cabecera,$detalle);
		$factura->sign(dirname(__FILE__).'/../firma_digital/server.p12');	
		$factura->crearArchivoBase64();
		$factura->crearArchivoGZIP();
		$archivo_envio = $factura->convertirArchivoGZIPABase64();		
		$a->addFile(realpath(dirname(__FILE__)."/../../uploaded_files/archivos_facturacion_xml/ELE_196560027_" . $numero_fac . "_FirmadoB64.txt"),"ELE_196560027_" . $numero_fac . "_FirmadoB64.txt");
		$numero_fac++;
	}
}

