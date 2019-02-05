/***********************************I-DEP-JRR-SIAT-0-16/01/2019******************************************/

select pxp.f_insert_testructura_gui ('SIAT', 'SISTEMA');
select pxp.f_insert_testructura_gui ('SIASINC', 'SIAT');
select pxp.f_insert_testructura_gui ('SIAPROD', 'SIASINC');

/***********************************F-DEP-JRR-SIAT-0-16/01/2019******************************************/

/***********************************I-DEP-AVQ-SIAT-0-21/01/2019******************************************/

select pxp.f_insert_testructura_gui ('SERSIA', 'SIASINC');
select pxp.f_insert_testructura_gui ('EVESIA', 'SIASINC');
select pxp.f_insert_testructura_gui ('PAISIA', 'SIASINC');
select pxp.f_insert_testructura_gui ('MONSIA', 'SIASINC');
select pxp.f_insert_testructura_gui ('MODSIA', 'SIASINC');
select pxp.f_insert_testructura_gui ('MEPSIA', 'SIASINC');
select pxp.f_insert_testructura_gui ('TIDSIA', 'SIASINC');
select pxp.f_insert_testructura_gui ('MESSIA', 'SIASINC');
select pxp.f_insert_testructura_gui ('AMBSIA', 'SIASINC');
select pxp.f_insert_testructura_gui ('TIPEMSIA', 'SIASINC');

/***********************************F-DEP-AVQ-SIAT-0-21/01/2019******************************************/

/***********************************I-DEP-JMH-SIAT-0-05/02/2019******************************************/
select pxp.f_insert_testructura_gui ('CUF', 'SIAT');
select pxp.f_insert_testructura_gui ('CUIS', 'SIAT');
select pxp.f_insert_testructura_gui ('SIAT', 'SISTEMA');
select pxp.f_insert_testructura_gui ('SIASINC', 'SIAT');
select pxp.f_insert_testructura_gui ('SIAPROD', 'SIASINC');
/***********************************F-DEP-JMH-SIAT-0-05/02/2019******************************************/