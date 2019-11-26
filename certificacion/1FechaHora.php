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
$cufd = "QUHCoUM5JVRBQUVGREUyN0E3Q3ZhTWNKVFVBQQ==MDAwMDg1";


$codigo_sistema= "88E2935BFD6";
$cuis_computarizada = "B1506967";
$cuis_electronica = "4CB33E78";
$ambiente = 2;//1 produccion 2 pruebas
$modalidad = 1;//1 electronica 2 computarizada
$sucursal = 0;
$nit = 1023097024;

session_start();

for ($i = 0; $i < 10;$i++) {
	$wsOperaciones= new WsFacturacionSincroniza(
			'https://presiatservicios.impuestos.gob.bo:39266/FacturacionSincronizacionFechaHora?wsdl',
			$ambiente,
			$codigo_sistema,//codigo sistema
			$nit,//nit
			$cuis_electronica,//cuis
			$sucursal,//sucursal
			0);//punto de venta
	$resultop = $wsOperaciones->SincronizaFechaHora();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);
}
//crear punto de venta 1 SOLOCREAR PUNTO DCE VENTAS SI ES NECESARIO
/*$wsOperaciones= new WsFacturacionOperaciones(
	'https://presiatservicios.impuestos.gob.bo:39117/FacturacionOperaciones?wsdl',
	$ambiente,
	$codigo_sistema,
	$modalidad,
	$nit,
	$cuis_electronica,
	0,//sucursal
	1,//punto de venta
	'PUNTO1',//nombre punto de venta
	1,//codigoTipoPuntoVenta: 1 fijo 2 movil 3 conjunto
	"Descripcion punto venta");//descripcion punto de venta
$resultop = $wsOperaciones->registroPuntoVentaOp();	
$rop = $wsOperaciones->ConvertObjectToArray($resultop);
print_r($rop);*/

for ($i = 0; $i < 10;$i++) {
	$wsOperaciones= new WsFacturacionSincroniza(
			'https://presiatservicios.impuestos.gob.bo:39266/FacturacionSincronizacionFechaHora?wsdl',
			2,//ambiente 1 produccion 2 pruebas
			$codigo_sistema,//codigo sistema
			$nit,//nit
			$cuis_electronica,//cuis
			$sucursal,//sucursal
			1);//punto de venta
	$resultop = $wsOperaciones->SincronizaFechaHora();	
	$rop = $wsOperaciones->ConvertObjectToArray($resultop);
	print_r($rop);
}
