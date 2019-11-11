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
$url = 'https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl';

session_start();
$fn = fopen("10SincronizacionCatalogos.csv","r");
$i=0;  
while(! feof($fn))  {	
	$result = fgets($fn);
	$result = preg_replace( "/\r|\n/", "", $result);
	$result = explode(',', $result);
	$tipo = $result[2];
	$punto_venta = $result[0];
	$autorizacion = $result[1];	
	if ($i>0) {
		$wsOperaciones= new WsFacturacionSincroniza(
			$url,
			$ambiente,
			$codigo_sistema,
			$nit,
			$cuis_electronica,
			$sucursal,
			$punto_venta,
			$autorizacion);
			
		if ($tipo == 'EVENTOS SIGNIFICATIVOS') {
			$resultop = $wsOperaciones->ParametricaEventosSignificativos();
		} else if ($tipo == 'LEYENDAS') {
			$resultop = $wsOperaciones->ParametricaLeyendas();//falta
		} else if ($tipo == 'MENSAJES SERVICIOS') {
			$resultop = $wsOperaciones->ParametricaMensajesServicios();
		} else if ($tipo == 'METODO PAGO') {
			$resultop = $wsOperaciones->ParametricaMetodoPago();
		} else if ($tipo == 'MOTIVO ANULACION') {
			$resultop = $wsOperaciones->ParametricaMotivoAnulacion();
		} else if ($tipo == 'PAIS ORIGEN') {
			$resultop = $wsOperaciones->ParametricaPaisOrigen();
		} else if ($tipo == 'TIPO AMBIENTE') {
			$resultop = $wsOperaciones->ParametricaTipoAmbiente();
		} else if ($tipo == 'TIPO COMPONENTE') {
			$resultop = $wsOperaciones->ParametricaTipoComponente();//falta
		} else if ($tipo == 'TIPO DEPARTAMENTO') {
			$resultop = $wsOperaciones->ParametricaTipoDepartamento();
		} else if ($tipo == 'TIPO DOCUMENTO FISCAL') {
			$resultop = $wsOperaciones->ParametricaTipoDocumentoFiscal();
		} else if ($tipo == 'TIPO DOCUMENTO IDENTIDAD') {
			$resultop = $wsOperaciones->ParametricaTipoDocumentoIdentidad();
		} else if ($tipo == 'TIPO DOCUMENTO SECTOR') {
			$resultop = $wsOperaciones->ParametricaTipoDocumentoSector();//falta
		} else if ($tipo == 'TIPO EMISION') {
			$resultop = $wsOperaciones->ParametricaTipoEmision();
		} else if ($tipo == 'TIPO MODALIDAD') {
			$resultop = $wsOperaciones->ParametricaTipoModalidad();
		} else if ($tipo == 'TIPO MONEDA') {
			$resultop = $wsOperaciones->ParametricaTipoMoneda();		
		} else if ($tipo == 'TIPO PUNTO VENTA') {
			$resultop = $wsOperaciones->ParametricaTipoPuntoVenta();//falta
		} else if ($tipo == 'UNIDAD MEDIDA') {
			$resultop = $wsOperaciones->ParametricaUnidadMedida();//falta
		}
			
		$rop = $wsOperaciones->ConvertObjectToArray($resultop);
		echo "=======================".$i."========================";
		print_r($rop);
	}
	$i++;
}