
/********************************************I-DEP-RAC-SIAT-1-12/02/2020********************************************/

----------------------------------
--COPY LINES TO dependencies.sql FILE  
---------------------------------

select pxp.f_insert_testructura_gui ('SIAT', 'SISTEMA');
select pxp.f_insert_testructura_gui ('SIASINC', 'SIAT');
select pxp.f_insert_testructura_gui ('SIAPROD', 'SIASINC');
select pxp.f_insert_testructura_gui ('EVESIA', 'SIASINC');
select pxp.f_insert_testructura_gui ('PAISIA', 'SIASINC');
select pxp.f_insert_testructura_gui ('MONSIA', 'SIASINC');
select pxp.f_insert_testructura_gui ('MODSIA', 'SIASINC');
select pxp.f_insert_testructura_gui ('MEPSIA', 'SIASINC');
select pxp.f_insert_testructura_gui ('TIDSIA', 'SIASINC');
select pxp.f_insert_testructura_gui ('MESSIA', 'SIASINC');
select pxp.f_insert_testructura_gui ('AMBSIA', 'SIASINC');
select pxp.f_insert_testructura_gui ('TIPEMSIA', 'SIASINC');
select pxp.f_insert_testructura_gui ('CUIS', 'SIAT');
select pxp.f_insert_testructura_gui ('MOTANU', 'SIASINC');
select pxp.f_insert_testructura_gui ('GESDOCFI', 'SIAT');
select pxp.f_insert_testructura_gui ('ENREDF', 'GESDOCFI');
select pxp.f_insert_testructura_gui ('ENREANU', 'GESDOCFI');
select pxp.f_insert_testructura_gui ('REDOCMAN', 'SIAT');
select pxp.f_insert_testructura_gui ('SILEYE', 'SIASINC');
select pxp.f_insert_testructura_gui ('SITIDEP', 'SIASINC');
select pxp.f_insert_testructura_gui ('TIDOCSE', 'SIASINC');
select pxp.f_insert_testructura_gui ('SICUNIME', 'SIASINC');
select pxp.f_insert_testructura_gui ('SINFEHO', 'SIASINC');
select pxp.f_insert_testructura_gui ('REEVESI', 'SIAT');
select pxp.f_insert_testructura_gui ('CUFD', 'SIAT');
select pxp.f_insert_testructura_gui ('SIDISER', 'SIAT');
select pxp.f_insert_testructura_gui ('SIMAPTV', 'GESDOCFI');
select pxp.f_insert_testructura_gui ('TIPDOCFIS', 'SIASINC');
select pxp.f_insert_testructura_gui ('SITICPM', 'SIASINC');
select pxp.f_insert_testructura_gui ('SIENVPAQ', 'REDOCMAN');
select pxp.f_insert_testructura_gui ('SIENVMAS', 'REDOCMAN');
select pxp.f_insert_testructura_gui ('SIAREP', 'SIAT');


/********************************************F-DEP-RAC-SIAT-1-12/02/2020********************************************/
/********************************************I-DEP-VAN-SIAT-1-09/03/2020********************************************/
select pxp.f_insert_testructura_gui ('TDISIA', 'SIASINC');
/********************************************F-DEP-VAN-SIAT-1-09/03/2020********************************************/