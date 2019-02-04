/************************************I-SCP-JRR-SIAT-0-16/01/2019*************************************************/
CREATE TABLE siat.tproducto (
    id_producto serial NOT NULL,
    codigo VARCHAR(20) NOT NULL,
    description VARCHAR(200) NOT NULL,
    PRIMARY KEY (id_producto))
INHERITS (pxp.tbase) WITHOUT OIDS; 
/************************************F-SCP-JRR-SIAT-0-16/01/2019*************************************************/
/************************************I-SCP-FPT-SIAT-0-18/01/2019*************************************************/
CREATE TABLE siat.tevento_significativo (
    id_evento_significativo serial NOT NULL,
    fk_sucursal integer NOT NULL,
    codigo_evento VARCHAR(55) NOT NULL,
    fecha_ini Timestamp NOT NULL,
    fecha_fin Timestamp NOT NULL,
    description VARCHAR(200) NOT NULL,
    PRIMARY KEY (id_evento_significativo))
INHERITS (pxp.tbase) WITHOUT OIDS; 
/************************************F-SCP-FPT-SIAT-0-18/01/2019*************************************************/
/************************************I-SCP-FPT-SIAT-0-21/01/2019*************************************************/
CREATE TABLE siat.tsalud_sistema (
    id_salud_sistema serial NOT NULL,
    fk_sucursal integer NOT NULL,
    codigo_evento VARCHAR(55) NOT NULL,
    fecha_salud Timestamp NOT NULL,    
    description_salud VARCHAR(200) NOT NULL,
    PRIMARY KEY (id_salud_sistema))
INHERITS (pxp.tbase) WITHOUT OIDS; 
/************************************F-SCP-FPT-SIAT-0-21/01/2019*************************************************/
/************************************I-SCP-FPT-SIAT-0-28/01/2019*************************************************/
CREATE TABLE siat.tenvio_documento (
    id_envio_documento serial NOT NULL,    
    modo_envio VARCHAR(75) NOT NULL,
    fecha_emision Timestamp NOT NULL,    
    nro_documento integer NOT NULL,
    cuf varchar(50) NOT NULL,
    monto numeric NOT NULL,  
    estado VARCHAR(20) NOT NULL,
    PRIMARY KEY (id_envio_documento))
INHERITS (pxp.tbase) WITHOUT OIDS; 
/************************************F-SCP-FPT-SIAT-0-28/01/2019*************************************************/


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
/************************************I-SCP-AVQ-SIAT-0-30/01/2019*************************************************/
ALTER TABLE siat.ttipo_moneda
  ADD UNIQUE (codigo);
  
ALTER TABLE siat.tambiente
  ADD UNIQUE (codigo);
  
  ALTER TABLE siat.tevento
  ADD UNIQUE (codigo);

ALTER TABLE siat.tmensaje_soap
  ADD UNIQUE (codigo);
  
  ALTER TABLE siat.tmetodo_pago
  ADD UNIQUE (codigo);
  
  ALTER TABLE siat.tmodalidad
  ADD UNIQUE (codigo);
  
  ALTER TABLE siat.tpais
  ADD UNIQUE (codigo);
  
  ALTER TABLE siat.tproducto
  ADD UNIQUE (codigo);
  
  ALTER TABLE siat.tservicio
  ADD UNIQUE (codigo);
  
  ALTER TABLE siat.ttipo_emision
  ADD UNIQUE (codigo);
  
   
/************************************F-SCP-AVQ-SIAT-0-30/01/2019*************************************************/
 
/************************************I-SCP-AVQ-SIAT-0-31/01/2019*************************************************/
CREATE TABLE siat.tmotivo_anulacion (
    id_motivo_anulacion serial NOT NULL,
    codigo NUMERIC NOT NULL,
    descripcion VARCHAR(200) NOT NULL,
    PRIMARY KEY (id_motivo_anulacion))
INHERITS (pxp.tbase) WITHOUT OIDS;

ALTER TABLE siat.tmotivo_anulacion
  ADD UNIQUE (codigo);
  /************************************F-SCP-AVQ-SIAT-0-31/01/2019*************************************************/
 