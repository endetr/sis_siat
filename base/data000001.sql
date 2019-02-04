/********************************************I-DAT-JRR-SIAT-0-16/01/2019********************************************/



INSERT INTO segu.tsubsistema ( codigo, nombre, fecha_reg, prefijo, estado_reg, nombre_carpeta, id_subsis_orig)
VALUES ('SIAT', 'Sistema SIAT', '2009-11-02', 'SIA', 'activo', 'siat', NULL);


select pxp.f_insert_tgui ('SISTEMA SIAT', '', 'SIAT', 'si', 1, '', 1, '', '', 'SIAT');
select pxp.f_insert_tgui ('Sincronizacion', 'Sincronizacion', 'SIASINC', 'si', 1, '', 2, '', '', 'SIAT');
select pxp.f_insert_tgui ('Productos', 'Productos', 'SIAPROD', 'si', 1, 'sis_siat/vista/producto/Producto.php', 3, '', 'Producto', 'SIAT');


/********************************************F-DAT-JRR-SIAT-0-16/01/2019********************************************/

/********************************************I-DAT-AVQ-SIAT-0-21/01/2019********************************************/
select pxp.f_insert_tgui ('Servicio', 'Servicios', 'SERSIA', 'si', 2, 'sis_siat/vista/servicio/Servicio.php', 3, '', 'Servicio', 'SIAT');
select pxp.f_insert_tgui ('Evento', 'Evento', 'EVESIA', 'si', 3, 'sis_siat/vista/evento/Evento.php', 3, '', 'Evento', 'SIAT');
select pxp.f_insert_tgui ('Pais', 'Pais', 'PAISIA', 'si', 4, 'sis_siat/vista/pais/Pais.php', 3, '', 'Pais', 'SIAT');
select pxp.f_insert_tgui ('Tipo Moneda', 'Tipo Moneda', 'MONSIA', 'si', 4, 'sis_siat/vista/tipo_moneda/TipoMoneda.php', 3, '', 'TipoMoneda', 'SIAT');
select pxp.f_insert_tgui ('Modalidad', 'Modalidad', 'MODSIA', 'si', 8, 'sis_siat/vista/modalidad/Modalidad.php', 3, '', 'Modalidad', 'SIAT');
select pxp.f_insert_tgui ('Metodo Pago', 'Metodo Pago', 'MEPSIA', 'si', 9, 'sis_siat/vista/metodo_pago/MetodoPago.php', 3, '', 'MetodoPago', 'SIAT');
select pxp.f_insert_tgui ('Tipo Documento', 'Tipo Documento', 'TIDSIA', 'si', 10, 'sis_siat/vista/tipo_documento_siat/TipoDocumentoSiat.php', 3, '', 'TipoDocumentoSiat', 'SIAT');
select pxp.f_insert_tgui ('Mensaje SOAP', 'Mensaje SOAP', 'MESSIA', 'si', 11, 'sis_siat/vista/mensaje_soap/MensajeSoap.php', 3, '', 'MensajeSoap', 'SIAT');
select pxp.f_insert_tgui ('Ambiente', 'Ambiente', 'AMBSIA', 'si', 12, 'sis_siat/vista/ambiente/Ambiente.php', 4, '', 'Ambiente', 'SIAT');
select pxp.f_insert_tgui ('Tipo Emision', 'Tipo Emision', 'TIPEMSIA', 'si', 12, 'sis_siat/vista/tipo_emision/TipoEmision.php', 3, '', 'TipoEmision', 'SIAT');

/********************************************F-DAT-AVQ-SIAT-0-21/01/2019********************************************/

