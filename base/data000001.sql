/********************************************I-DAT-JRR-SIAT-0-16/01/2019********************************************/



INSERT INTO segu.tsubsistema ( codigo, nombre, fecha_reg, prefijo, estado_reg, nombre_carpeta, id_subsis_orig)
VALUES ('SIAT', 'Sistema SIAT', '2009-11-02', 'SIA', 'activo', 'siat', NULL);


select pxp.f_insert_tgui ('SISTEMA SIAT', '', 'SIAT', 'si', 1, '', 1, '', '', 'SIAT');
select pxp.f_insert_tgui ('Sincronizacion', 'Sincronizacion', 'SIASINC', 'si', 1, '', 2, '', '', 'SIAT');
select pxp.f_insert_tgui ('Productos', 'Productos', 'SIAPROD', 'si', 1, 'sis_siat/vista/producto/Producto.php', 3, '', 'Producto', 'SIAT');


/********************************************F-DAT-JRR-SIAT-0-16/01/2019********************************************/
