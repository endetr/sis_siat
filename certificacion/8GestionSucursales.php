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
	1,//sucursal
	0);//punto de venta
	
$resultop = $wsOperaciones->solicitudCufdOp();
$rop = $wsOperaciones->ConvertObjectToArray($resultop);
$cufd = $rop['RespuestaCufd']['codigo'];
for ($j=0;$j<=10;$j++) {
	$fn = fopen("8GestionSucursales.csv","r");
	$i=0;  
	while(! feof($fn))  {
		
		$result = fgets($fn);
		$result = preg_replace( "/\r|\n/", "", $result);
		$result = explode(',', $result);		
		
		$url = 'https://presiatservicios.impuestos.gob.bo:39113/FacturaElectronicaEstandar?wsdl';
		
		
		//generar factura
		$fecha = new DateTime();
		if ($result[2] == 'casa matriz') {
			$sucursal = 0;
		} else if ($result[2] == 'sucursal válida') {
			$sucursal = 1;
		} else {
			$sucursal = $result[2];
		}
		
		if ($result[1] != 'su NIT') {
			$nit = $result[1];
		}
		
		if ($result[0] != 'su código de sistema') {
			$codigo_sistema = $result[0];
		}		
		 
		
		echo "====================" . $i. "========================";
		$fecha_formato1 = $fecha->format('Y-m-dH:i:s.000');
		$fecha_formato1 = substr($fecha_formato1, 0, 10) . 'T' . substr($fecha_formato1, 10);	
		$fecha_formato2 = $fecha->format('YmdHis000');
		$concatenacion = MODCuf::concatenar(
												$nit,//nit
												$fecha_formato2,//fecha emision
												$sucursal,//sucursal
												$modalidad,//modalidad																					
												1,//tipo emision 1 online 2offline
												1,// codigo documento fiscal
												1,// codigo documento serctor
												$numero_fac,//nro factura
												0);  //punto venta											
										
		$mod11 = MODCuf::mod11((string)$concatenacion,1,9,false); 
		
		
		$concatenacion = $concatenacion . $mod11; 
		$base16 = strtoupper(MODCuf::bcdechex($concatenacion));
		$cabecera = generarCabecera($nit,$numero_fac,$numero_nc,$base16,$cufd,$sucursal,0,$fecha_formato1,1);
		$detalle = generarDetalle(1,$codigo_producto,$actividad);
		
		$factura = new Factura('ELE_196560027_'.$numero_fac,dirname(__FILE__).'/../../uploaded_files/archivos_facturacion_xml/',"Electronica");	
		
			
		$factura->loadXml($cabecera,$detalle);
		$factura->sign(dirname(__FILE__).'/../firma_digital/server.p12');	
		$factura->crearArchivoBase64();
		$factura->crearArchivoGZIP();
		$archivo_envio = $factura->convertirArchivoGZIPABase64();
		$hash = hash ( "sha256" , $archivo_envio );
		
		$wsOperaciones= new WsFacturacion(
	 		$url,
	 		$ambiente,
	 		1,//codigo doc fiscal
	 		1,//codigo doc sector
	 		1,//codigo emision 1 online 2 offline
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
		
		$resultop = $wsOperaciones->recepcionFacturaEstandar();
		
		$rop = $wsOperaciones->ConvertObjectToArray($resultop);
		$codigo_recepcion = $rop['RespuestaServicioFacturacion']['codigoRecepcion'];		
		if ($codigo_recepcion == "0") {
			print_r($rop);
		} else {
			//var_dump($rop);
			$wsOperaciones= new WsFacturacion(
				$url,
		 		$ambiente,
		 		1,//codigo doc fiscal
		 		1,//codigo doc sector
		 		1,//codigo emision 1 online 2 offline
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
				
			
			$resultop = $wsOperaciones->validarRecepcionFacturaEstandar();
			
			$rop = $wsOperaciones->ConvertObjectToArray($resultop);
			print_r($rop);
		}	
		
		$numero_fac++;		
		$i++;	
	}	
	fclose($fn);
}