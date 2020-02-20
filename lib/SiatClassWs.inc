<?php
/*
// clase base con propiedades y métodos miembro
//autor: Ariel Lopez Gutierrez
//fecha: 23/01/2019 17:00

HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION

#3	ETR				20/02/2020			RAC KPLIAN			Renombrar constructores para compatibilidad PHP7
*/
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


   function __construct($wsurl,$codigoAmbiente,$codigoSistema,$codigoModalidad,$nit,$cuis,$codigoSucursal,$codigoPuntoVenta,$nombrePuntoVenta,$codigoTipoPuntoVenta,$descripcion,$codigoEvento,$fechaHoraEvento,$cufd,$fechaHoraFinEvento,$codigoRecepcionEvento)
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
   function __construct($wsurlFO,$codigoAmbiente,$codigoSistema,$codigoModalidad,$nit,$cuis,$codigoSucursal,$codigoPuntoVenta = 0,$nombrePuntoVenta = '',$codigoTipoPuntoVenta=1,$descripcion="",$codigoEvento="",$fechaHoraEvento="",$cufd="",$fechaHoraFinEvento=NULL,$codigoRecepcionEvento = NULL,$codigoSistemaProveedor=NULL, $fechaEvento = NULL)
   {	$this->wsurl = $wsurlFO;
       	$this->parametros = compact("codigoAmbiente","codigoSistema","codigoSistemaProveedor","codigoModalidad","nit","cuis","codigoSucursal",
       								"codigoPuntoVenta","nombrePuntoVenta","codigoTipoPuntoVenta","descripcion","codigoEvento",
       								"fechaHoraEvento","cufd","fechaHoraFinEvento","codigoRecepcionEvento","fechaEvento");
     
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

   function consultaEvento()
   {
   		try {
	       	$result = $this->clientFO->consultaEventoSignificativo(array('SolicitudConsultaEvento'=>$this->parametros));
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
   function __construct($wsurlSINC,$codigoAmbiente,$codigoSistema,$nit,$cuis,$codigoSucursal,$codigoPuntoVenta = 0,$codigoAutorizacion=null)
   {
        $this->wsurl = $wsurlSINC;
       	$this->parametros = compact("codigoAmbiente","codigoSistema","nit","cuis","codigoSucursal",
       								"codigoPuntoVenta","codigoAutorizacion");
     
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
   //nuevos
   function ParametricaLeyendas()
   {
   		try {   			
	       	$result = $this->clientSINC->sincronizarListaLeyendasFactura(array('SolicitudSincronizacion' => $this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}       
	  
   }
   function ParametricaTipoComponente()
   {
   		try {   			
	       	$result = $this->clientSINC->sincronizarParametricaTipoComponente(array('SolicitudSincronizacion' => $this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}       
	  
   }
   function ParametricaTipoDocumentoSector()
   {
   		try {   			
	       	$result = $this->clientSINC->sincronizarParametricaTipoDocumentoSector(array('SolicitudSincronizacion' => $this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}       
	  
   }
   function ParametricaTipoPuntoVenta()
   {
   		try {   			
	       	$result = $this->clientSINC->sincronizarParametricaTipoPuntoVenta(array('SolicitudSincronizacion' => $this->parametros));
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}       
	  
   }
   function ParametricaUnidadMedida()
   {
   		try {   			
	       	$result = $this->clientSINC->sincronizarParametricaUnidadMedida(array('SolicitudSincronizacion' => $this->parametros));
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
   
   function __construct($wsurlFac,$codigoAmbiente,$codigoDocumentoFiscal,$codigoDocumentoSector,$codigoEmision,
   										$codigoModalidad,$codigoPuntoVenta,$codigoSistema,$codigoSucursal,$cufd,$cuis,$nit,
   										$fechaEnvio=NULL,$hashArchivo=NULL,$archivo=NULL,$codigoRecepcion=NULL,$cuf=NULL,
   										$codigoMotivo = NULL,$numeroDocumentoFiscal=NULL)
   {
        $this->wsurl = $wsurlFac;
       	$this->parametros = compact("codigoAmbiente","codigoDocumentoFiscal","codigoDocumentoSector","codigoEmision",
       								"codigoModalidad","codigoPuntoVenta","codigoSistema","codigoSucursal","cufd","cuis","nit",
       								"fechaEnvio","hashArchivo","archivo","codigoRecepcion","cuf","codigoMotivo","numeroDocumentoFiscal");
     
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
   
   /********************************************
    * FACTURA ESTANDAR
    ********************************************/
   function recepcionFacturaEstandar()
   {       
	   try {
	   		 if ($this->parametros['codigoModalidad'] == 1) {
	   		 	$result = $this->clientFac->recepcionFacturaElectronicaEstandar(array('SolicitudServicioRecepcion' => $this->parametros));	
	   		 } else {  			
	       		$result = $this->clientFac->recepcionFacturaComputarizadaEstandar(array('SolicitudServicioRecepcion' => $this->parametros));
			 }
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   
   function recepcionFacturaEstandarPaquete()
   {       
	   try {
	   		 if ($this->parametros['codigoModalidad'] == 1) {
	   		 	$result = $this->clientFac->recepcionPaqueteFacturaElectronicaEstandar(array('SolicitudServicioRecepcion' => $this->parametros));	
	   		 } else {  			
	       		$result = $this->clientFac->recepcionPaqueteFacturaComputarizadaEstandar(array('SolicitudServicioRecepcion' => $this->parametros));
			 }
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   
   
   function validaRecepcionFacturaEstandarxCuf()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] == 1) {     			
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
	   		if ($this->parametros['codigoModalidad'] == 1) {   			
	       		$result = $this->clientFac->validacionRecepcionFacturaElectronicaEstandar(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			} else {  			
	       		$result = $this->clientFac->validacionRecepcionFacturaComputarizadaEstandar(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   
   function validarRecepcionFacturaEstandarPaquete()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] == 1) {   			
	       		$result = $this->clientFac->validacionRecepcionPaqueteFacturaElectronicaEstandar(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			} else {  			
	       		$result = $this->clientFac->validacionRecepcionPaqueteFacturaComputarizadaEstandar(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   
   function anulacionFacturaEstandar()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] == 1) {   			
	       		$result = $this->clientFac->anulacionFacturaElectronicaEstandar(array('SolicitudServicioAnulacion' => $this->parametros));
			} else {  			
	       		$result = $this->clientFac->anulacionFacturaComputarizadaEstandar(array('SolicitudServicioAnulacion' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }

	function validaAnulacionFacturaEstandar()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] == 1) {   			
	       		$result = $this->clientFac->validacionAnulacionFacturaElectronicaEstandar(array('SolicitudServicioValidacionAnulacion' => $this->parametros));
			} else {  			
	       		$result = $this->clientFac->validacionAnulacionFacturaComputarizadaEstandar(array('SolicitudServicioValidacionAnulacion' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }

   function recepcionFacturaEstandarMasiva()
   {       
	   try {
	   		 if ($this->parametros['codigoModalidad'] == 1) {
	   		 	$result = $this->clientFac->recepcionMasivaFacturaElectronicaEstandar(array('SolicitudServicioRecepcion' => $this->parametros));	
	   		 } else {  			
	       		$result = $this->clientFac->recepcionMasivaFacturaComputarizadaEstandar(array('SolicitudServicioRecepcion' => $this->parametros));
			 }
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }

   function validarRecepcionFacturaEstandarMasiva()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] == 1) {   			
	       		$result = $this->clientFac->validacionRecepcionMasivaFacturaElectronicaEstandar(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			} else {  			
	       		$result = $this->clientFac->validacionRecepcionMasivaFacturaComputarizadaEstandar(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   
   /********************************************
    * FACTURA COMERCIAL DE EXPORTACION
    ********************************************/
   function recepcionFacturaComercialExportacion()
   {       
	   try {
	   		 if ($this->parametros['codigoModalidad'] == 1) {
	   		 	$result = $this->clientFac->recepcionFacturaElectronicaComercialExportacion(array('SolicitudServicioRecepcion' => $this->parametros));	
	   		 } else {  			
	       		$result = $this->clientFac->recepcionFacturaComputarizadaComercialExportacion(array('SolicitudServicioRecepcion' => $this->parametros));
			 }
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   
   function validaRecepcionFacturaComercialExportacionxCuf()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] == 1) {     			
	       		$result = $this->clientFac->validacionRecepcionPorCufFacturaElectronicaComercialExportacion(array('SolicitudServicioValidacionRecepcionPorCuf' => $this->parametros));
			} else {
				$result = $this->clientFac->validacionRecepcionPorCufFacturaComputarizadaComercialExportacion(array('SolicitudServicioValidacionRecepcionPorCuf' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   
   function validarRecepcionFacturaComercialExportacion()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] == 1) {   			
	       		$result = $this->clientFac->validacionRecepcionFacturaElectronicaComercialExportacion(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			} else {  			
	       		$result = $this->clientFac->validacionRecepcionFacturaComputarizadaComercialExportacion(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   
   /********************************************
    * NOTA DE CREDITO DEBITO
    ********************************************/
   function recepcionNotaCreditoDebito()
   {       
	   try {
	   		 if ($this->parametros['codigoModalidad'] == 1) {
	   		 	$result = $this->clientFac->recepcionNotaFiscalElectronicaCreditoDebito(array('SolicitudServicioRecepcion' => $this->parametros));	
	   		 } else {  			
	       		$result = $this->clientFac->recepcionNotaFiscalComputarizadaCreditoDebito(array('SolicitudServicioRecepcion' => $this->parametros));
			 }
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }

	function recepcionNotaCreditoDebitoPaquete()
   {       
	   try {
	   		 if ($this->parametros['codigoModalidad'] == 1) {
	   		 	$result = $this->clientFac->recepcionPaqueteNotaFiscalElectronicaCreditoDebito(array('SolicitudServicioRecepcion' => $this->parametros));	
	   		 } else {  			
	       		$result = $this->clientFac->recepcionPaqueteNotaFiscalComputarizadaCreditoDebito(array('SolicitudServicioRecepcion' => $this->parametros));
			 }
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   
   function validaRecepcionNotaCreditoDebitoxCuf()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] == 1) {     			
	       		$result = $this->clientFac->validacionRecepcionPorCufNotaFiscalElectronicaCreditoDebito(array('SolicitudServicioValidacionRecepcionPorCuf' => $this->parametros));
			} else {
				$result = $this->clientFac->validacionRecepcionPorCufNotaFiscalComputarizadaCreditoDebito(array('SolicitudServicioValidacionRecepcionPorCuf' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   
   function validarRecepcionNotaCreditoDebito()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] == 1) {   			
	       		$result = $this->clientFac->validacionRecepcionNotaFiscalElectronicaCreditoDebito(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			} else {  			
	       		$result = $this->clientFac->validacionRecepcionNotaFiscalComputarizadaCreditoDebito(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}  
   }
   
   function validarRecepcionNotaCreditoDebitoPaquete()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] == 1) {   			
	       		$result = $this->clientFac->validacionRecepcionPaqueteNotaFiscalElectronicaCreditoDebito(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			} else {  			
	       		$result = $this->clientFac->validacionRecepcionPaqueteNotaFiscalComputarizadaCreditoDebito(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   
   function anulacionNotaCreditoDebito()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] == 1) {   			
	       		$result = $this->clientFac->anulacionNotaFiscalElectronicaCreditoDebito(array('SolicitudServicioAnulacion' => $this->parametros));
			} else {  			
	       		$result = $this->clientFac->anulacionNotaFiscalComputarizadaCreditoDebito(array('SolicitudServicioAnulacion' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }

	function validaAnulacionNotaCreditoDebito()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] == 1) {   			
	       		$result = $this->clientFac->validacionAnulacionNotaFiscalElectronicaCreditoDebito(array('SolicitudServicioValidacionAnulacion' => $this->parametros));
			} else {  			
	       		$result = $this->clientFac->validacionAnulacionNotaFiscalComputarizadaCreditoDebito(array('SolicitudServicioValidacionAnulacion' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   
   
   /******************************************
    * FACTURA ALQUILER
    *************************************/
    
    function recepcionFacturaAlquiler()
   {       
	   try {
	   		 if ($this->parametros['codigoModalidad'] == 1) {
	   		 	$result = $this->clientFac->recepcionFacturaElectronicaAlquilerBienInmueble(array('SolicitudServicioRecepcion' => $this->parametros));	
	   		 } else {  			
	       		$result = $this->clientFac->recepcionFacturaComputarizadaAlquilerBienInmueble(array('SolicitudServicioRecepcion' => $this->parametros));
			 }
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }   

	function recepcionFacturaAlquilerPaquete()
   {       
	   try {
	   		 if ($this->parametros['codigoModalidad'] == 1) {
	   		 	$result = $this->clientFac->recepcionPaqueteFacturaElectronicaAlquilerBienInmueble(array('SolicitudServicioRecepcion' => $this->parametros));	
	   		 } else {  			
	       		$result = $this->clientFac->recepcionPaqueteFacturaComputarizadaAlquilerBienInmueble(array('SolicitudServicioRecepcion' => $this->parametros));
			 }
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }   
   function validarRecepcionFacturaAlquiler()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] == 1) {   			
	       		$result = $this->clientFac->validacionRecepcionFacturaElectronicaAlquilerBienInmueble(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			} else {  			
	       		$result = $this->clientFac->validacionRecepcionFacturaComputarizadaAlquilerBienInmueble(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   function validarRecepcionFacturaAlquilerPaquete()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] == 1) {   			
	       		$result = $this->clientFac->validacionRecepcionPaqueteFacturaElectronicaAlquilerBienInmueble(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			} else {  			
	       		$result = $this->clientFac->validacionRecepcionPaqueteFacturaComputarizadaAlquilerBienInmueble(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   
   function anulacionFacturaAlquiler()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] == 1) {   			
	       		$result = $this->clientFac->anulacionFacturaElectronicaAlquilerBienInmueble(array('SolicitudServicioAnulacion' => $this->parametros));
			} else {  			
	       		$result = $this->clientFac->anulacionFacturaComputarizadaAlquilerBienInmueble(array('SolicitudServicioAnulacion' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }

	function validaAnulacionFacturaAlquiler()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] == 1) {   			
	       		$result = $this->clientFac->validacionAnulacionFacturaElectronicaAlquilerBienInmueble(array('SolicitudServicioValidacionAnulacion' => $this->parametros));
			} else {  			
	       		$result = $this->clientFac->validacionAnulacionFacturaComputarizadaAlquilerBienInmueble(array('SolicitudServicioValidacionAnulacion' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   function recepcionFacturaAlquilerMasiva()
   {       
	   try {
	   		 if ($this->parametros['codigoModalidad'] == 1) {
	   		 	$result = $this->clientFac->recepcionMasivaFacturaElectronicaAlquilerBienInmueble(array('SolicitudServicioRecepcion' => $this->parametros));	
	   		 } else {  			
	       		$result = $this->clientFac->recepcionMasivaFacturaComputarizadaAlquilerBienInmueble(array('SolicitudServicioRecepcion' => $this->parametros));
			 }
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }   
   
   function validarRecepcionFacturaAlquilerMasiva()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] == 1) {   			
	       		$result = $this->clientFac->validacionRecepcionMasivaFacturaElectronicaAlquilerBienInmueble(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			} else {  			
	       		$result = $this->clientFac->validacionRecepcionMasivaFacturaComputarizadaAlquilerBienInmueble(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   
   /******************
    CONTINGENCIA*****
    * ******************/
   function recepcionFacturaContingenciaPaquete()
   {       
	   try {
	   		 if ($this->parametros['codigoModalidad'] == 1) {
	   		 	$result = $this->clientFac->recepcionPaqueteFacturaElectronicaContingencia(array('SolicitudServicioRecepcion' => $this->parametros));	
	   		 } else {  			
	       		$result = $this->clientFac->recepcionPaqueteFacturaComputarizadaContingencia(array('SolicitudServicioRecepcion' => $this->parametros));
			 }
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   }
   function validarRecepcionFacturaContingenciaPaquete()
   {       
	   try {
	   		if ($this->parametros['codigoModalidad'] == 1) {   			
	       		$result = $this->clientFac->validacionRecepcionFacturaElectronicaContingencia(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			} else {  			
	       		$result = $this->clientFac->validacionRecepcionFacturaComputarizadaContingencia(array('SolicitudServicioValidacionRecepcion' => $this->parametros));
			}
		   	return $result;
		} catch (SoapFault $fault) {
			return  'ERROR: '.$fault;
		}    
	  
   } 
   
} // fin de la clase de web services para facturacion


?> 