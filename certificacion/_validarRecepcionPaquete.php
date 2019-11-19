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
$codigo_recepcion = 127254;
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


$wsOperaciones= new WsFacturacion(
	$url,
	$ambiente,
	1,//codigo documento fiscal
	1,
	2, //codigo emision 1 inline 2 offline
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

$resultop = $wsOperaciones->validarRecepcionFacturaEstandarPaquete();	
$rop = $wsOperaciones->ConvertObjectToArray($resultop);
print_r($rop);


