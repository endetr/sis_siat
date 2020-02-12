/********************************************I-DAT-JRR-SIAT-0-16/01/2019********************************************/



INSERT INTO segu.tsubsistema ( codigo, nombre, fecha_reg, prefijo, estado_reg, nombre_carpeta, id_subsis_orig)
VALUES ('SIAT', 'Sistema SIAT', '2009-11-02', 'SIA', 'activo', 'siat', NULL);


select pxp.f_insert_tgui ('SISTEMA SIAT', '', 'SIAT', 'si', 1, '', 1, '', '', 'SIAT');
select pxp.f_insert_tgui ('Sincronizacion', 'Sincronizacion', 'SIASINC', 'si', 1, '', 2, '', '', 'SIAT');
select pxp.f_insert_tgui ('Productos', 'Productos', 'SIAPROD', 'si', 1, 'sis_siat/vista/producto/Producto.php', 3, '', 'Producto', 'SIAT');


/********************************************F-DAT-JRR-SIAT-0-16/01/2019********************************************/

/********************************************I-DAT-RAC-SIAT-0-12/02/2019********************************************/
----------------------------------
--COPY LINES TO data.sql FILE  
---------------------------------

select pxp.f_insert_tgui ('SISTEMA SIAT', '', 'SIAT', 'si', 1, '', 1, '', '', 'SIAT');
select pxp.f_insert_tgui ('Sincronizacion', 'Sincronizacion', 'SIASINC', 'si', 3, '', 2, '', '', 'SIAT');
select pxp.f_insert_tgui ('Productos', 'Productos', 'SIAPROD', 'si', 1, 'sis_siat/vista/producto/Producto.php', 3, '', 'Producto', 'SIAT');
select pxp.f_insert_tgui ('Evento Significativo', 'Evento Significativo', 'EVESIA', 'si', 3, 'sis_siat/vista/evento/Evento.php', 3, '', 'Evento', 'SIAT');
select pxp.f_insert_tgui ('Pais', 'Pais', 'PAISIA', 'si', 4, 'sis_siat/vista/pais/Pais.php', 3, '', 'Pais', 'SIAT');
select pxp.f_insert_tgui ('Tipo Moneda', 'Tipo Moneda', 'MONSIA', 'si', 4, 'sis_siat/vista/tipo_moneda/TipoMoneda.php', 3, '', 'TipoMoneda', 'SIAT');
select pxp.f_insert_tgui ('Modalidad', 'Modalidad', 'MODSIA', 'si', 8, 'sis_siat/vista/modalidad/Modalidad.php', 3, '', 'Modalidad', 'SIAT');
select pxp.f_insert_tgui ('Metodo Pago', 'Metodo Pago', 'MEPSIA', 'si', 9, 'sis_siat/vista/metodo_pago/MetodoPago.php', 3, '', 'MetodoPago', 'SIAT');
select pxp.f_insert_tgui ('Tipo Documento', 'Tipo Documento', 'TIDSIA', 'si', 10, 'sis_siat/vista/tipo_documento_siat/TipoDocumentoSiat.php', 3, '', 'TipoDocumentoSiat', 'SIAT');
select pxp.f_insert_tgui ('Mensaje SOAP', 'Mensaje SOAP', 'MESSIA', 'si', 11, 'sis_siat/vista/mensaje_soap/MensajeSoap.php', 3, '', 'MensajeSoap', 'SIAT');
select pxp.f_insert_tgui ('Ambiente', 'Ambiente', 'AMBSIA', 'si', 12, 'sis_siat/vista/ambiente/Ambiente.php', 4, '', 'Ambiente', 'SIAT');
select pxp.f_insert_tgui ('Tipo Emision', 'Tipo Emision', 'TIPEMSIA', 'si', 12, 'sis_siat/vista/tipo_emision/TipoEmision.php', 3, '', 'TipoEmision', 'SIAT');
select pxp.f_insert_tgui ('CUIS', 'CUIS', 'CUIS', 'si', 6, 'sis_siat/vista/cuis/Cuis.php', 2, '', 'Cuis', 'SIAT');
select pxp.f_insert_tgui ('Motivo Anulacion', 'Motivos de Anulación', 'MOTANU', 'si', 11, 'sis_siat/vista/motivo_anulacion/MotivoAnulacion.php', 3, '', 'MotivoAnulacion', 'SIAT');
select pxp.f_insert_tgui ('Gestor de Documentos Fiscales', 'Gestor de Documentos Fiscales', 'GESDOCFI', 'si', 1, '', 2, '', '', 'SIAT');
select pxp.f_insert_tgui ('Envio y Recepcion de Documentos Fiscales', 'Envio y Recepcion de Documentos Fiscales', 'ENREDF', 'si', 1, 'sis_siat/vista/gestor_documento/GestorDocumento.php', 3, '', 'GestorDocumento', 'SIAT');
select pxp.f_insert_tgui ('Envio y Recepcion de Anulaciones', 'Envio y Recepcion de Anulaciones', 'ENREANU', 'si', 2, 'sis_siat/vista/gestor_documento/GestorAnulacion.php', 3, '', 'GestorAnulacion', 'SIAT');
select pxp.f_insert_tgui ('Registros de Documentos Manuales', 'Registros de Documentos Manuales', 'REDOCMAN', 'si', 2, '', 3, '', '', 'SIAT');
select pxp.f_insert_tgui ('Leyendas', 'Leyendas', 'SILEYE', 'si', 9, 'sis_siat/vista/leyenda/Leyenda.php', 3, '', 'Leyenda', 'SIAT');
select pxp.f_insert_tgui ('Tipo Departamento', 'Tipo Departamento', 'SITIDEP', 'si', 11, 'sis_siat/vista/departamento/Departamento.php', 3, '', 'Departamento', 'SIAT');
select pxp.f_insert_tgui ('Documento Sector', 'Documento Sector', 'TIDOCSE', 'si', 13, 'sis_siat/vista/documento_sector/DocumentoSector.php', 3, '', 'DocumentoSector', 'SIAT');
select pxp.f_insert_tgui ('Unidad de Medida', 'Unidad de Medida', 'SICUNIME', 'si', 12, 'sis_siat/vista/unidad_medida/UnidadMedida.php', 3, '', 'UnidadMedida', 'SIAT');
select pxp.f_insert_tgui ('Fecha y Hora', 'Fecha y Hora', 'SINFEHO', 'si', 15, 'sis_siat/vista/fecha_hora/FechaHora.php', 3, '', 'FechaHora', 'SIAT');
select pxp.f_insert_tgui ('Registro de Eventos Significativos', 'Registro de Eventos Significativos', 'REEVESI', 'si', 9, 'sis_siat/vista/evento_significativo/EventoSignificativo.php', 2, '', 'EventoSignificativo', 'SIAT');
select pxp.f_insert_tgui ('CUFD', 'CUFD', 'CUFD', 'si', 7, 'sis_siat/vista/cufd/Cufd.php', 2, '', 'Cufd', 'SIAT');
select pxp.f_insert_tgui ('Direccion Servicio', 'Direccion Servicio', 'SIDISER', 'si', 12, 'sis_siat/vista/direccion_servicio/DireccionServicio.php', 2, '', 'DireccionServicio', 'SIAT');
select pxp.f_insert_tgui ('Mapeo Tipo Venta', 'Mapeo Tipo Venta', 'SIMAPTV', 'si', 3, 'sis_siat/vista/mapeo_tipo_venta/MapeoTipoVenta.php', 3, '', 'MapeoTipoVenta', 'SIAT');
select pxp.f_insert_tgui ('Documento Fiscal', 'Documento Fiscal', 'TIPDOCFIS', 'si', 13, 'sis_siat/vista/documento_fiscal/DocumentoFiscal.php', 3, '', 'DocumentoFiscal', 'SIAT');
select pxp.f_insert_tgui ('Tipo Componente', 'Tipo Componente', 'SITICPM', 'si', 15, 'sis_siat/vista/tipo_componente/TipoComponente.php', 3, '', 'TipoComponente', 'SIAT');
select pxp.f_insert_tgui ('Envio Paquetes', 'Envio Paquetes', 'SIENVPAQ', 'si', 1, 'sis_siat/vista/gestor_documento/GestorPaquete.php', 4, '', 'GestorPaquete', 'SIAT');
select pxp.f_insert_tgui ('Envio Masivo', 'Envio MAsivo', 'SIENVMAS', 'si', 2, 'sis_siat/vista/gestor_documento/GestorMasivo.php', 4, '', 'GestorMasivo', 'SIAT');
select pxp.f_insert_tgui ('Reportes', 'Reportes', 'SIAREP', 'si', 4, '', 2, '', '', 'SIAT');



INSERT INTO pxp.variable_global ("variable", "valor", "descripcion")
VALUES 
  (E'siat_ambiente', E'2', E'ambiente 1 produccion 2 pruebas'),
  (E'siat_codigo_sistema', E'88E2935BFD6', E'Codigo dado al dar de alta el sistema'),
  (E'siat_nit', E'1023097024', E'Nit usado para servicios'),
  (E'siat_correos_alertas', E'jriverarojas@gmail.com', E'Correos a los que se enviara las alteras en el sistema siat. Deben estar separados por comas en caso de ser mas de uno'),
  (E'siat_modalidad', E'1', E'modalidades 1 para electronica y 2 para computarizada'),
  (E'siat_tipos_masivos', E' ', E'Una lista separada por coma de codigos de tipo de venta que permitiran envio masivo');
  
  
  
INSERT INTO pxp.variable_global ("variable", "valor", "descripcion")
VALUES 
  (E'vef_facturacion_electronica', E'no', E'Bandera que permite identificar si el nuevo sistema de facturacion ha sido habilitado, posibles valores: si, no'),
  (E'vef_integracion_siat', E'si', E'Define si el sistema de ventas se integrara con el sistema siat, posibles valores si y no');
  

INSERT INTO siat.tdireccion_servicio ("id_usuario_reg", "fecha_reg", "estado_reg", "id_usuario_ai", "usuario_ai", "tipo", "subtipo", "url", "id_documento_fiscal", "id_documento_sector", "recepcion", "validacion", "recepcion_anulacion", "validacion_anulacion")
VALUES 
  (1, E'2019-12-17 23:41:05.899', E'activo', NULL, E'NULL', E'sincronizacion', E'tipo_documento_fiscal', E'https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl', NULL, NULL, E'ParametricaTipoDocumentoFiscal', E'', E'', E''),
  (1, E'2019-12-18 14:56:37.279', E'activo', NULL, E'NULL', E'sincronizacion', E'mensajes_servicios', E'https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl', NULL, NULL, E'ParametricaMensajesServicios', E'', E'', E''),
  (1, E'2019-12-18 15:03:59.351', E'activo', NULL, E'NULL', E'sincronizacion', E'tipo_documento_sector', E'https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl', NULL, NULL, E'ParametricaTipoDocumentoSector', E'', E'', E''),
  (1, E'2019-12-18 15:04:53.520', E'activo', NULL, E'NULL', E'sincronizacion', E'leyenda', E'https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl', NULL, NULL, E'ParametricaLeyendas', E'', E'', E''),
  (1, E'2019-12-18 15:05:17.839', E'activo', NULL, E'NULL', E'sincronizacion', E'eventos_significativos', E'https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl', NULL, NULL, E'ParametricaEventosSignificativos', E'', E'', E''),
  (1, E'2019-12-18 15:08:40.347', E'activo', NULL, E'NULL', E'sincronizacion', E'motivos_anulacion', E'https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl', NULL, NULL, E'ParametricaMotivoAnulacion', E'', E'', E''),
  (1, E'2019-12-18 15:08:53.333', E'activo', NULL, E'NULL', E'sincronizacion', E'pais', E'https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl', NULL, NULL, E'ParametricaPaisOrigen', E'', E'', E''),
  (1, E'2019-12-18 15:09:07.019', E'activo', NULL, E'NULL', E'sincronizacion', E'tipo_ambiente', E'https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl', NULL, NULL, E'ParametricaTipoAmbiente', E'', E'', E''),
  (1, E'2019-12-18 15:09:24.501', E'activo', NULL, E'NULL', E'sincronizacion', E'tipo_componente', E'https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl', NULL, NULL, E'ParametricaTipoComponente', E'', E'', E''),
  (1, E'2019-12-18 15:09:37.237', E'activo', NULL, E'NULL', E'sincronizacion', E'tipo_departamento', E'https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl', NULL, NULL, E'ParametricaTipoDepartamento', E'', E'', E''),
  (1, E'2019-12-18 15:10:00.074', E'activo', NULL, E'NULL', E'sincronizacion', E'tipo_emision', E'https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl', NULL, NULL, E'ParametricaTipoEmision', E'', E'', E''),
  (1, E'2019-12-18 15:14:32.486', E'activo', NULL, E'NULL', E'sincronizacion', E'tipo_metodo_pago', E'https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl', NULL, NULL, E'ParametricaMetodoPago', E'', E'', E''),
  (1, E'2019-12-18 15:15:16.656', E'activo', NULL, E'NULL', E'sincronizacion', E'tipo_modalidad', E'https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl', NULL, NULL, E'ParametricaTipoModalidad', E'', E'', E''),
  (1, E'2019-12-18 15:18:26.737', E'activo', NULL, E'NULL', E'sincronizacion', E'tipo_moneda', E'https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl', NULL, NULL, E'ParametricaTipoMoneda', E'', E'', E''),
  (1, E'2019-12-18 15:18:52.561', E'activo', NULL, E'NULL', E'sincronizacion', E'unidad_medida', E'https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl', NULL, NULL, E'ParametricaUnidadMedida', E'', E'', E''),
  (1, E'2019-12-18 17:10:01.392', E'activo', NULL, E'NULL', E'documento', E'', E'https://presiatservicios.impuestos.gob.bo:39113/FacturaElectronicaEstandar?wsdl', 8, 9, E'recepcionFacturaEstandar', E'validarRecepcionFacturaEstandar', E'anulacionFacturaEstandar', E'validaAnulacionFacturaEstandar'),
  (1, E'2019-12-21 10:34:50.350', E'activo', NULL, E'NULL', E'sincronizacion', E'fecha_hora', E'https://presiatservicios.impuestos.gob.bo:39266/FacturacionSincronizacionFechaHora?wsdl', NULL, NULL, E'SincronizaFechaHora', E'', E'', E''),
  (1, E'2019-12-21 15:41:36.705', E'activo', NULL, E'NULL', E'sincronizacion', E'tipo_documento_identidad', E'https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl', NULL, NULL, E'ParametricaTipoDocumentoIdentidad', E'', E'', E''),
  (1, E'2019-12-21 21:12:16.627', E'activo', NULL, E'NULL', E'sincronizacion', E'producto', E'https://presiatservicios.impuestos.gob.bo:39118/FacturacionSincronizacion?wsdl', NULL, NULL, E'SincronizaProductosServicios', E'', E'', E''),
  (1, E'2019-12-22 00:31:20.475', E'activo', NULL, E'NULL', E'cufd', E'cufd', E'https://presiatservicios.impuestos.gob.bo:39268/FacturacionSolicitudCufd?wsdl', NULL, NULL, E'solicitudCufdOp', E'', E'', E''),
  (1, E'2019-12-22 15:43:46.994', E'activo', NULL, E'NULL', E'eventos', E'evento_significativo_inicio', E'https://presiatservicios.impuestos.gob.bo:39127/FacturacionEventosSignificativos?wsdl', NULL, NULL, E'inicioEventoSignificativoOP', E'', E'', E''),
  (1, E'2019-12-22 15:44:11.970', E'activo', NULL, E'NULL', E'eventos', E'evento_significativo_fin', E'https://presiatservicios.impuestos.gob.bo:39127/FacturacionEventosSignificativos?wsdl', NULL, NULL, E'finEventoSignificativoOP', E'', E'', E'');
  


INSERT INTO siat.tcuis ("id_usuario_reg", "fecha_reg", "estado_reg", "id_usuario_ai", "usuario_ai", "fecha_inicio", "fecha_fin", "codigo", "horas_anulacion")
VALUES 
  (1, E'2019-12-17 23:45:57.049', E'activo', NULL, E'NULL', E'2019-12-01 00:00:00', E'2020-06-30 23:45:00', E'4CB33E78', E'48');
  
  

/********************************************F-DAT-RAC-SIAT-0-12/02/2019********************************************/

