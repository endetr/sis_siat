<?php
function generarCabecera($nit,$numero_fac,$numero_nc,$base16,$cufd,$sucursal,$punto_venta,$fecha,$documento_sector) {
	if ($documento_sector == 1)	{
		$cabecera = array(		
							"nitEmisor" => $nit,
							"numeroFactura" => $numero_fac,						
							"cuf" => $base16,
							"cufd" => $cufd,
							"codigoSucursal" => $sucursal,
							"direccion" => "Calle Ballivian Nro. 1333",
							"codigoPuntoVenta" => $punto_venta==0?null:$punto_venta,
							"fechaEmision" => $fecha,
							"nombreRazonSocial" => "Rivera",
							"codigoTipoDocumentoIdentidad" => 1,
							"numeroDocumento" => "4394565",						
							"complemento" => null,	
							"codigoCliente" => "C1",	
							"codigoMetodoPago" => 1,
							"numeroTarjeta" => null,
							"montoTotal" => "100.0",
							"montoDescuento" => null,
							"codigoMoneda" => 688,
							"tipoCambio" => "1.0",
							"montoTotalMoneda" => "100.0",
							"leyenda" => "El proveedor debera suministrar el servicio en las modalidades y terminos ofertados o convenidos",
							"usuario" => "JRIVERA",
							"codigoDocumentoSector" => $documento_sector,	
							"codigoExcepcionDocumento"=>null												
							);
	} else if ($documento_sector == 3) {
		$cabecera = array(		
						"nitEmisor" => $nit,
						"numeroFactura" => $numero_fac,						
						"cuf" => $base16,
						"cufd" => $cufd,
						"codigoSucursal" => $sucursal,
						"direccion" => "Calle Ballivian Nro. 1333",
						"codigoPuntoVenta" => $punto_venta==0?null:$punto_venta,
						"fechaEmision" => $fecha,
						"nombreRazonSocial" => "Rivera",
						"codigoTipoDocumentoIdentidad" => 1,
						"numeroDocumento" => "4394565",						
						"complemento" => null,	
						"codigoCliente" => "C1",
						"periodoFacturado" => "AGOSTO 2019",	
						"codigoMetodoPago" => 1,
						"numeroTarjeta" => null,
						"montoTotal" => "100.0",
						"montoDescuento" => null,
						"codigoMoneda" => 688,
						"tipoCambio" => "1.0",
						"montoTotalMoneda" => "100.0",
						"leyenda" => "El proveedor debera suministrar el servicio en las modalidades y terminos ofertados o convenidos",
						"usuario" => "JRIVERA",
						"codigoDocumentoSector" => $documento_sector,	
						"codigoExcepcionDocumento"=>null												
						);
		
	} else if ($documento_sector == 18) {
		$cabecera = array(		 
						"nitEmisor" => $nit,
						"numeroNotaCreditoDebito" => $numero_nc,						
						"cuf" => $base16,
						"cufd" => $cufd,
						"codigoSucursal" => $sucursal,
						"direccion" => "Calle Ballivian Nro. 1333",
						"codigoPuntoVenta" => $punto_venta==0?null:$punto_venta,
						"fechaEmision" => $fecha,
						"nombreRazonSocial" => "Rivera",
						"codigoTipoDocumentoIdentidad" => 1,
						"numeroDocumento" => "4394565",						
						"complemento" => null,		 					
						"codigoCliente" => "C1",	 					
	 					"numeroFactura" => $numero_fac,
	 					"numeroAutorizacionCuf" => "226E0E73EEECA6D28DD556ABDAF1AC05748D47C7",
	 					"fechaEmisionFactura" => "2019-09-04T18:18:32.000",	
						"montoTotalOriginal" => 100,
						"montoTotalDevuelto" => 100,
						"montoEfectivoCreditoDebito" => 13,						
						"leyenda" => "ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS. EL USO ILÍCITO DE ÉSTA SERÁ SANCIONADO DE ACUERDO A LEY",
						"usuario" => "JRIVERA",
						"codigoDocumentoSector" => $documento_sector												
						);
	}
	return $cabecera;
}

function generarDetalle ($documento_sector,$codigo_producto,$actividad) {
	if ($documento_sector == 1)	{
		$detalle = [
				[		"actividadEconomica" => $actividad,
						"codigoProductoSin" => $codigo_producto,
						"codigoProducto" => "P1",
						"descripcion" => "Aplicacion de facturacion",
						"cantidad" => 1,
						"unidadMedida" => 57,		
						"precioUnitario" => "100.0",
						"montoDescuento" => null,						
						"subTotal" => "100.0",
						"numeroSerie" => null,
						"numeroImei" => null,						
										
				]
			];	
	} else if ($documento_sector == 3) {
		$detalle = [
				[		"actividadEconomica" => $actividad,
						"codigoProductoSin" => $codigo_producto,
						"codigoProducto" => "P1",
						"descripcion" => "Aplicacion de facturacion",
						"cantidad" => 1,
						"unidadMedida" => 58,		
						"precioUnitario" => "100.0",
						"montoDescuento" => null,						
						"subTotal" => "100.0"					
										
				]
			];	
		
	} else if ($documento_sector == 18) {	
		$detalle = [
				[		"actividadEconomica" => $actividad,
						"codigoProductoSin" => $codigo_producto,
						"codigoProducto" => "P1",
						"descripcion" => "Aplicacion de facturacion",
						"cantidad" => 1,
						"unidadMedida" => 57,		
						"precioUnitario" => "100.0",												
						"subTotal" => "100.0",
						"codigoDetalleTransaccion" => 1			
										
				],
				[		"actividadEconomica" => $actividad,
						"codigoProductoSin" => $codigo_producto,
						"codigoProducto" => "P1",						
						"descripcion" => "Aplicacion de facturacion",
						"cantidad" => 1,
						"unidadMedida" => 57,		
						"precioUnitario" => "100.0",												
						"subTotal" => "100.0",
	 					"codigoDetalleTransaccion" => 2			
										
				]
			];					
	}	
	return $detalle;	
		
	
	
}
