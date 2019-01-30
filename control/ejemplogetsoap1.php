<pre>
<?php
//referencia a clase ws
//------------------------
include "SiatClassWs.inc";

session_start();

$wsSincroniza= new WsFacturacionSincroniza($_SESSION["_URLWS_SINCRONIZA"],2,'2E07180BA7E','',1009393025,'713E32B4',0);
$wsOperaciones= new WsFacturacionOperaciones($_SESSION["_URLWS_OPERACIONES"],2,'2E07180BA7E',1,1009393025,'713E32B4',0);

//ejemplo de solicitud de CUFD desde operaciones
$resultop = $wsOperaciones->solicitudCufdOp();

//ejemplo de solicitud de tipos de moneda
//$resultsinc = $wsSincroniza->ParametricaTipoMoneda();
$resultsinc = $wsSincroniza->ParametricaEventosSignificativos();


//convierte resultado en array
$r = $wsSincroniza->ConvertObjectToArray($resultsinc);
$rop = $wsOperaciones->ConvertObjectToArray($resultop);

print_r($r);


?>
</pre>