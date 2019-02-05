/************************************I-SCP-JRR-SIAT-0-16/01/2019*************************************************/
CREATE TABLE siat.tproducto (
    id_producto serial NOT NULL,
    codigo VARCHAR(20) NOT NULL,
    description VARCHAR(200) NOT NULL,
    PRIMARY KEY (id_producto))
INHERITS (pxp.tbase) WITHOUT OIDS; 
/************************************F-SCP-JRR-SIAT-0-16/01/2019*************************************************/

/************************************I-SCP-JMH-SIAT-0-18/01/2019*************************************************/
CREATE TABLE siat.tcuis (
  id_cuis SERIAL NOT NULL,
  fecha_inicio TIMESTAMP(0) WITHOUT TIME ZONE,
  fecha_fin TIMESTAMP(0) WITHOUT TIME ZONE,
  codigo VARCHAR(200) UNIQUE,
  PRIMARY KEY(id_cuis)
) INHERITS (pxp.tbase)
WITH (oids = false);

CREATE TABLE siat.tcuifd (
  id_cuifd SERIAL NOT NULL,
  id_cuis INTEGER NOT NULL,
  fecha_inicio TIMESTAMP WITHOUT TIME ZONE,
  fecha_fin TIMESTAMP WITHOUT TIME ZONE,
  codigo VARCHAR(200),
  PRIMARY KEY(id_cuifd)
) INHERITS (pxp.tbase)
WITH (oids = false);

CREATE TABLE siat.tcuf (
  id_cuf SERIAL NOT NULL,
  nit INTEGER NOT NULL,
  fecha_emision TIMESTAMP(17) WITHOUT TIME ZONE,
  sucursal NUMERIC(4,0),
  modalidad INTEGER,
  tipo_emision INTEGER,
  codigo_documento_fiscal INTEGER,
  tipo_documento_sector INTEGER,
  nro_factura INTEGER,
  punto_venta INTEGER,
  codigo_autoverificador INTEGER,
  concatenacion INTEGER,
  base11 INTEGER,
  base16 VARCHAR(100),
  PRIMARY KEY(id_cuf)
) INHERITS (pxp.tbase)
WITH (oids = false);

/************************************F-SCP-SIAT-VEF-0-18/01/2019*************************************************/

/************************************I-SCP-SIAT-VEF-0-23/01/2019*************************************************/
  ALTER TABLE siat.tcuifd
  RENAME COLUMN id_cuifd TO id_cufd; 

ALTER TABLE siat.tcuifd
  RENAME TO tcufd;
  

/************************************F-SCP-SIAT-VEF-0-23/01/2019*************************************************/


