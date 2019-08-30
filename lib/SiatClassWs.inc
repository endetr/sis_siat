<?php

// clase base con propiedades y métodos miembro
//autor: Ariel Lopez Gutierrez
//fecha: 23/01/2019 17:00

class SiatClassWs {

   var $wsurl;
   var $parametros=array();
   var $client;
   //parametros
   var $codigoAmbiente;
   var $codigoSistema;
   var $codigoModalidad;
   var $nit;
   var $cuis;
   var $sucursal;


   function SiatClassWs($wsurl,$codigoAmbiente,$codigoSistema,$codigoModalidad,$nit,$cuis,$codigoSucursal,$codigoPuntoVenta,$nombrePuntoVenta,$codigoTipoPuntoVenta,$descripcion,$codigoEvento,$fechaHoraEvento,$cufd,$fechaHoraFinEvento,$codigoRecepcionEvento)
   {
       $this->wsurl = $wsurl;
       $this->parametros = compact("codigoAmbiente","codigoSistema","codigoModalidad","nit","cuis","codigoSucursal","codigoPuntoVenta",
       									"nombrePuntoVenta","codigoTipoPuntoVenta","descripcion","codigoEvento","fechaHoraEvento","cufd","fechaHoraFinEvento","codigoRecepcionEvento");
     
	   
   }
	//establece la conexion con el ws
   function Conexion()
   {
   	
	$parametros=$this->parametros; //parametros de la llamada
	$client = new SoapClient($this->wsurl, $parametros);
    return $client;
   }
   
   //convierte el objeto devuelto por el ws en array
   function ConvertObjectToArray($data) {
         if (is_object($data)) {
        $data = get_object_vars($data);
    }

    if (is_array($data)) {
        return array_map(__METHOD__, $data);
    }
    else {
        return $data;
    }
    }

} // fin de la clase Madre

// ampliar la clase De web services para operaciones
class WsFacturacionOperaciones extends SiatClassWs {

   var $clientFO;
   var $result;
   var $wsurlFO;
   var $parametrosFO;
   function WsFacturacionOperaciones($wsurlFO,$codigoAmbiente,$codigoSistema,$codigoModalidad,$nit,$cuis,$sucursal,$pos = 0,$nombrePos = '',$codigoTipoPos=1,$descripcion="",$codigoEvento="",$fechaHoraEvento="",$cufd="",$fechaHoraFinEvento=NULL,$codigoRecepcionEvento = NULL)
   {	
        $this->SiatClassWs($wsurlFO,$codigoAmbiente,$codigoSistema,$codigoModalidad,$nit,$cuis,$sucursal,$pos,$nombrePos,$codigoTipoPos,$descripcion,$codigoEvento,$fechaHoraEvento,$cufd,$fechaHoraFinEvento,$codigoRecepcionEvento);
		$this->clientFO = $this->Conexion();
   }

   function estableceConexion($wsurlFO,$parametrosFO)
   {
       $result = $client->Conexion();
   }


   function verificarConexionwsOp()
   {
       $result = $this->clientFO->verificarConexion();
	   return $result;
   }
  
   function solicitudCufdOp()
   {
   		try {
	       	$result = $this->clientFO->solicitudCufd(array('SolicitudOperaciones'=>$this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}
   }
   
   function solicitudCuisOp()
   {
   		try {
	       	$result = $this->clientFO->solicitudCuis(array('SolicitudCuis'=>$this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}
   }
   
   function registroPuntoVentaOp()
   {
   		try {
	       	$result = $this->clientFO->registroPuntoVenta(array('SolicitudRegistroPuntoVenta'=>$this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}
   }
   
   function inicioEventoSignificativoOP()
   {
   		try {
	       	$result = $this->clientFO->registroInicioEventoSignificativo(array('SolicitudInicioEvento'=>$this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}
   }
   
   function finEventoSignificativoOP()
   {
   		try {
	       	$result = $this->clientFO->registroFinEventoSignificativo(array('SolicitudFinEvento'=>$this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}
   }
   

  
} // fin de la clase de web services para operaciones

class WsFacturacionSincroniza extends SiatClassWs {

   var $clientSINC;
   var $result;
   var $wsurlSINC;
   var $parametrosSINC;
   function WsFacturacionSincroniza($wsurlSINC,$codigoAmbiente,$codigoSistema,$nit,$cuis,$sucursal,$pos = 0,$nombrePos = '',$codigoTipoPos=1,$descripcion="",$codigoEvento="",$fechaHoraEvento="",$cufd="",$fechaHoraFinEvento=NULL,$codigoRecepcionEvento = NULL)
   {
        $this->SiatClassWs($wsurlSINC,$codigoAmbiente,$codigoSistema,0,$nit,$cuis,$sucursal,$pos,$nombrePos,$codigoTipoPos,$descripcion,$codigoEvento,$fechaHoraEvento,$cufd,$fechaHoraFinEvento,$codigoRecepcionEvento);
		$this->clientSINC = $this->Conexion();
   }

   function estableceConexion($wsurlSINC,$parametrosSINC)
   {
       $result = $client->Conexion();
   }


   function verificarConexionwsSINC()
   {
 	   $result = $this->clientSINC->verificarConexion();
      
   }
   function ParametricaTipoMoneda()
   {
   		try {   			
	       	$result = $this->clientSINC->sincronizarParametricaTipoMoneda(array('SolicitudSincronizacion' => $this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}         
   }

  function ParametricaEventosSignificativos()
   {
   		try {   			
	       	$result = $this->clientSINC->sincronizarParametricaEventosSignificativos(array('SolicitudSincronizacion' => $this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}  
   }
   function ParametricaMotivoAnulacion()
   {	try {   			
	       	$result = $this->clientSINC->sincronizarParametricaMotivoAnulacion(array('SolicitudSincronizacion' => $this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}   
   }
   
   function ParametricaActividades()
   {	try {   			
	       	$result = $this->clientSINC->sincronizarActividades(array('SolicitudSincronizacion' => $this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}   
   }
   
   function ParametricaPaisOrigen()
   {
   		try {   			
	       	$result = $this->clientSINC->sincronizarParametricaPaisOrigen(array('SolicitudSincronizacion' => $this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}  
	  
   }
   function ParametricaTipoDepartamento()
   {
   		try {   			
	       	$result = $this->clientSINC->sincronizarParametricaTipoDepartamento(array('SolicitudSincronizacion' => $this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}  
       
   }
   function ParametricaMensajesServicios()
   {
   		try {   			
	       	$result = $this->clientSINC->sincronizarListaMensajesServicios(array('SolicitudSincronizacion' => $this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}  
       
   }
   function ParametricaTipoAmbiente()
   {
   		try {   			
	       	$result = $this->clientSINC->sincronizarParametricaTipoAmbiente(array('SolicitudSincronizacion' => $this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}          
	  
   }
   function ParametricaTipoEmision()
   {
   		try {   			
	       	$result = $this->clientSINC->sincronizarParametricaTipoEmision(array('SolicitudSincronizacion' => $this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}   
       
   }
   function ParametricaTipoModalidad()
   {
   		try {   			
	       	$result = $this->clientSINC->sincronizarParametricaTipoModalidad(array('SolicitudSincronizacion' => $this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}   
	  
   }
   function ParametricaTipoDocumentoIdentidad()
   {
   		try {   			
	       	$result = $this->clientSINC->sincronizarParametricaTipoDocumentoIdentidad(array('SolicitudSincronizacion' => $this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}   	  
   }
   
   function ParametricaTipoDocumentoFiscal()
   {
   		try {   			
	       	$result = $this->clientSINC->sincronizarParametricaTipoDocumentoFiscal(array('SolicitudSincronizacion' => $this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}  
   }
   function ParametricaMetodoPago()
   {       
	   try {   			
	       	$result = $this->clientSINC->sincronizarParametricaTipoMetodoPago(array('SolicitudSincronizacion' => $this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   function SincronizaFechaHora()
   {
   		try {   			
	       	$result = $this->clientSINC->sincronizarFechaHora(array('SolicitudSincronizacion' => $this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}       
	  
   }
   
   function SincronizaProductosServicios()
   {
   		try {   			
	       	$result = $this->clientSINC->sincronizarListaProductosServicios(array('SolicitudSincronizacion' => $this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}       
	  
   }
   
   
} // fin de la clase de web services para operaciones

//Clase para facturacion computarizada estandar, exportacion y notas de debito credito
class WsFacturacion extends SiatClassWs {

   var $clientFac;
   var $result;
   var $wsurlFac;
   var $parametrosFac;
   
   function WsFacturacion($wsurlFac,$codigoAmbiente,$codigoDocumentoFiscal,$codigoDocumentoSector,$codigoEmision,
   										$codigoModalidad,$codigoPuntoVenta,$codigoSistema,$codigoSucursal,$cufd,$cuis,$nit,
   										$fechaEnvio=NULL,$hashArchivo=NULL,$archivo=NULL,$codigoRecepcion=NULL,$cuf=NULL)
   {
        $this->wsurl = $wsurlFac;
       	$this->parametros = compact("codigoAmbiente","codigoDocumentoFiscal","codigoDocumentoSector","codigoEmision",
       								"codigoModalidad","codigoPuntoVenta","codigoSistema","codigoSucursal","cufd","cuis","nit",
       								"fechaEnvio","hashArchivo","archivo","codigoRecepcion","cuf");
     
	   $this->clientFac = $this->Conexion();
   }

   function estableceConexion($wsurlFac,$parametrosFO)
   {
       $result = $client->Conexion();
   }


   function verificarConexionwsFac()
   {
       $result = $this->clientFac->verificarComunicacion();
	   return $result;
   }
   function recepcionFacturaEstandar()
   {       
	   try {
	   		 if ($this->parametros['codigoModalidad'] = 1) {
	   		 	$result = $this->clientFac->recepcionFacturaElectronicaEstandar(array('SolicitudServicioRecepcion' => $this->parametros));	
	   		 } else {  			
	       		$result = $this->clientFac->recepcionFacturaComputarizadaEstandar(array('SolicitudServicioRecepcion' => $this->parametros));
			 }
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   function validaRecepcionFacturaEstandarxCuf()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] = 1) {     			
	       		$result = $this->clientFac->validacionRecepcionPorCufFacturaComputarizadaEstandar(array('SolicitudServicioValidacionRecepcionPorCuf' => $this->parametros));
			} else {
				$result = $this->clientFac->validacionRecepcionPorCufFacturaElectronicaEstandar(array('SolicitudServicioValidacionRecepcionPorCuf' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   
   function validarRecepcionFacturaEstandar()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] = 1) {   			
	       		$result = $this->clientFac->validacionRecepcionFacturaElectronicaEstandar(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			} else {  			
	       		$result = $this->clientFac->validacionRecepcionFacturaComputarizadaEstandar(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   
   
} // fin de la clase de web services para facturacion estandar


?> 