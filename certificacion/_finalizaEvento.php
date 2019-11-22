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
$url = 'https://presiatservicios.impuestos.gob.bo:39127/FacturacionEventosSignificativos?wsdl';
$fecha_evento = "2019-11-19";
session_start();
$codigo_evento = '973';

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
	"2019-11-19T16:53:16.987",
	$cufd,
	"2019-11-20T20:00:16.987",
	$codigo_evento
	);
$resultop = $wsOperaciones->finEventoSignificativoOP();	
$rop = $wsOperaciones->ConvertObjectToArray($resultop);	
print_r($rop);


