<pre>
<?php
//referencia a clase ws
include "SiatClassWs.inc";

/*
$wsOperaciones= new WsFacturacionOperaciones("https://presiatservicios.impuestos.gob.bo:39117/FacturacionOperaciones?WSDL",2,'2E07180BA7E',1,1009393025,'713E32B4',0);
$wsSincroniza= new WsFacturacionSincroniza("https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?WSDL",2,'2E07180BA7E','',1009393025,'713E32B4',0);
*/
//$wsOperaciones= new WsFacturacionOperaciones($_SESSION["_URLWS_OPERACIONES"],2,'2E07180BA7E',1,1009393025,'713E32B4',0);
session_start();

$wsSincroniza= new WsFacturacionSincroniza($_SESSION["_URLWS_SINCRONIZA"],2,'2E07180BA7E','',1009393025,'713E32B4',0);
$wsOperaciones= new WsFacturacionOperaciones($_SESSION["_URLWS_OPERACIONES"],2,'2E07180BA7E',1,1009393025,'713E32B4',0);

//ejemplo de solicitud de CUFD
$resultop = $wsOperaciones->solicitudCufdOp();

//ejemplo de solicitud de tipos de moneda
$resultsinc = $wsSincroniza->ParametricaTipoMoneda();


//convierte resultado en array
$r = $wsSincroniza->ConvertObjectToArray($resultsinc);
$rop = $wsOperaciones->ConvertObjectToArray($resultop);

print_r($rop);


?>
</pre>
