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


$codigo_sistema= "88E2935BFD6";
$cuis_computarizada = "B1506967";
$cuis_electronica = "4CB33E78";
$ambiente = 2;//1 produccion 2 pruebas
$modalidad = 1;//1 electronica 2 computarizada
$sucursal = 0;
$nit = 1023097024;
$codigos_informativos = [968,969,971,978,979,3054,3055,3056,3057];
$codigos_contingencia = [970,972,973,974,975,976,977];

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
//registros de informativos
for ($i = 0; $i < count($codigos_informativos);$i++) {
	for ($j = 0; $j < 10;$j++) {
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
			$codigos_informativos[$i],//codigo evento significativo
			"2019-10-22T23:53:16.987",
			$cufd
			);
		$resultop = $wsOperaciones->inicioEventoSignificativoOP();	
		$rop = $wsOperaciones->ConvertObjectToArray($resultop);
		print_r($rop);
	}
}
//registros de contingencia
for ($i = 0; $i < count($codigos_contingencia);$i++) {
	for ($j = 0; $j < 3;$j++) {
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
			$codigos_contingencia[$i],//codigo evento significativo
			"2019-10-22T23:53:16.987",
			$cufd
			);
		$resultop = $wsOperaciones->inicioEventoSignificativoOP();	
		$rop = $wsOperaciones->ConvertObjectToArray($resultop);		
		$codigo_evento = $rop['RespuestaListaEventos']['codigoRecepcionEventoSignificativo'];
		
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
			$codigos_contingencia[$i],//codigo evento significativo
			"2019-10-22T23:53:16.987",
			$cufd,
			"2019-10-23T14:53:16.987",
			$codigo_evento
			);
		$resultop = $wsOperaciones->finEventoSignificativoOP();	
		$rop = $wsOperaciones->ConvertObjectToArray($resultop);
		print_r($rop);
	}
}
//registro de contingencia


