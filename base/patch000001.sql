/************************************I-SCP-JRR-SIAT-0-16/01/2019*************************************************/
CREATE TABLE siat.tproducto (
    id_producto serial NOT NULL,
    codigo VARCHAR(20) NOT NULL,
    description VARCHAR(200) NOT NULL,
    PRIMARY KEY (id_producto))
INHERITS (pxp.tbase) WITHOUT OIDS; 
/************************************F-SCP-JRR-SIAT-0-16/01/2019*************************************************/

/************************************I-SCP-AVQ-SIAT-0-17/01/2019*************************************************/
ALTER TABLE siat.tproducto
  RENAME COLUMN description TO descripcion;
  
ALTER TABLE siat.tproducto
  ALTER COLUMN codigo TYPE NUMERIC
  USING codigo::NUMERIC;                   
  
CREATE TABLE siat.tservicio (
    id_servicio serial NOT NULL,
    codigo NUMERIC NOT NULL,
    descripcion VARCHAR(200) NOT NULL,
    PRIMARY KEY (id_servicio))
INHERITS (pxp.tbase) WITHOUT OIDS;   

CREATE TABLE siat.tpais (
    id_pais serial NOT NULL,
    codigo NUMERIC NOT NULL,
    descripcion VARCHAR(200) NOT NULL,
    PRIMARY KEY (id_pais))
INHERITS (pxp.tbase) WITHOUT OIDS;
 
CREATE TABLE siat.ttipo_moneda (
    id_tipo_moneda serial NOT NULL,
    codigo NUMERIC NOT NULL,
    descripcion VARCHAR(200) NOT NULL,
    PRIMARY KEY (id_tipo_moneda))
INHERITS (pxp.tbase) WITHOUT OIDS;
 

CREATE TABLE siat.tevento (
    id_evento serial NOT NULL,
    codigo NUMERIC NOT NULL,
    descripcion VARCHAR(200) NOT NULL,
    PRIMARY KEY (id_evento))
INHERITS (pxp.tbase) WITHOUT OIDS; 

/************************************F-SCP-AVQ-SIAT-0-17/01/2019*************************************************/
/************************************I-SCP-AVQ-SIAT-1-17/01/2019*************************************************/

CREATE TABLE siat.tambiente (
    id_ambiente serial NOT NULL,
    codigo NUMERIC NOT NULL,
    descripcion VARCHAR(200) NOT NULL,
    PRIMARY KEY (id_ambiente))
INHERITS (pxp.tbase) WITHOUT OIDS;

CREATE TABLE siat.ttipo_emision (
    id_tipo_emision serial NOT NULL,
    codigo NUMERIC NOT NULL,
    descripcion VARCHAR(200) NOT NULL,
    PRIMARY KEY (id_tipo_emision))
INHERITS (pxp.tbase) WITHOUT OIDS;

CREATE TABLE siat.tmodalidad (
    id_modalidad serial NOT NULL,
    codigo NUMERIC NOT NULL,
    descripcion VARCHAR(200) NOT NULL,
    PRIMARY KEY (id_modalidad))
INHERITS (pxp.tbase) WITHOUT OIDS;

CREATE TABLE siat.tmetodo_pago (
    id_metodo_pago serial NOT NULL,
    codigo NUMERIC NOT NULL,
    descripcion VARCHAR(200) NOT NULL,
    PRIMARY KEY (id_metodo_pago))
INHERITS (pxp.tbase) WITHOUT OIDS;
 
 CREATE TABLE siat.ttipo_documento_siat (
    id_tipo_documento serial NOT NULL,
    codigo NUMERIC NOT NULL,
    descripcion VARCHAR(200) NOT NULL,
    tipo     varchar(100) 	NOT NULL,
    PRIMARY KEY (id_tipo_documento))
    
INHERITS (pxp.tbase) WITHOUT OIDS;

CREATE TABLE siat.tmensaje_soap (
    id_mensaje_soap serial NOT NULL,
    codigo NUMERIC NOT NULL,
    descripcion VARCHAR(200) NOT NULL,
    PRIMARY KEY (id_mensaje_soap))
INHERITS (pxp.tbase) WITHOUT OIDS;


/************************************F-SCP-AVQ-SIAT-1-17/01/2019*************************************************/
 