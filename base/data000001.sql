/********************************************I-DAT-JRR-SIAT-0-16/01/2019********************************************/



INSERT INTO segu.tsubsistema ( codigo, nombre, fecha_reg, prefijo, estado_reg, nombre_carpeta, id_subsis_orig)
VALUES ('SIAT', 'Sistema SIAT', '2009-11-02', 'SIA', 'activo', 'siat', NULL);


select pxp.f_insert_tgui ('SISTEMA SIAT', '', 'SIAT', 'si', 1, '', 1, '', '', 'SIAT');
select pxp.f_insert_tgui ('Sincronizacion', 'Sincronizacion', 'SIASINC', 'si', 1, '', 2, '', '', 'SIAT');
select pxp.f_insert_tgui ('Productos', 'Productos', 'SIAPROD', 'si', 1, 'sis_siat/vista/producto/Producto.php', 3, '', 'Producto', 'SIAT');


/********************************************F-DAT-JRR-SIAT-0-16/01/2019********************************************/























/********************************************I-DAT-JMH-SIAT-0-05/02/2019********************************************/
select pxp.f_insert_tgui ('CUF', 'CUF', 'CUF', 'si', 5, 'sis_siat/vista/cuf/Cuf.php', 2, '', 'Cuf', 'SIAT');
select pxp.f_insert_tgui ('CUIS', 'CUIS', 'CUIS', 'si', 6, 'sis_siat/vista/cuis/Cuis.php', 2, '', 'Cuis', 'SIAT');
select pxp.f_insert_tgui ('SISTEMA SIAT', '', 'SIAT', 'si', 1, '', 1, '', '', 'SIAT');
select pxp.f_insert_tgui ('Sincronizacion', 'Sincronizacion', 'SIASINC', 'si', 1, '', 2, '', '', 'SIAT');
select pxp.f_insert_tgui ('Productos', 'Productos', 'SIAPROD', 'si', 1, 'sis_siat/vista/producto/Producto.php', 3, '', 'Producto', 'SIAT');
/********************************************F-DAT-JMH-SIAT-0-05/02/2019********************************************/
