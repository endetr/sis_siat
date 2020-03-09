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

/************************************F-SCP-JMH-SIAT-0-18/01/2019*************************************************/

/************************************I-SCP-JMH-SIAT-0-23/01/2019*************************************************/
  ALTER TABLE siat.tcuifd
  RENAME COLUMN id_cuifd TO id_cufd; 

ALTER TABLE siat.tcuifd
  RENAME TO tcufd;
  

/************************************F-SCP-JMH-SIAT-0-23/01/2019*************************************************/

/************************************I-SCP-AVQ-SIAT-0-26/03/2019*************************************************/
  ALTER TABLE siat.tcuis
  ADD COLUMN horas_anulacion INTERVAL;
  
  COMMENT ON COLUMN siat.tcuis.horas_anulacion
  IS 'Horas Limite para anulación esto dependiendo de la entidad de impuestos';

/************************************F-SCP-AVQ-SIAT-0-26/03/2019*************************************************/


/************************************I-SCP-JRR-SIAT-0-24/07/2019*************************************************/
ALTER TABLE siat.tcuf
  DROP COLUMN fecha_emision; 

ALTER TABLE siat.tcuf
  ADD COLUMN fecha_emision VARCHAR(100);
  
ALTER TABLE siat.tcuf
  DROP COLUMN concatenacion; 

ALTER TABLE siat.tcuf
  ADD COLUMN concatenacion VARCHAR(100);
  

/************************************F-SCP-JMH-SIAT-0-24/07/2019*************************************************/
/************************************I-SCP-JRR-SIAT-0-10/12/2019*************************************************/
CREATE TABLE siat.tgestor_documento (
    id_gestor_documento serial NOT NULL,
    tipo VARCHAR(20) NOT NULL,
    id_venta INTEGER  NOT NULL,
    fecha_hora_factura TIMESTAMP  NOT NULL,
    url_servicio VARCHAR(200),
    metodo_servicio VARCHAR(100),
    estado VARCHAR(20) NOT NULL,
    contenido_base64_corrida1 TEXT,
    contenido_base64_corrida2 TEXT,
    hash VARCHAR(100),
    PRIMARY KEY (id_gestor_documento))
INHERITS (pxp.tbase) WITHOUT OIDS;

CREATE TABLE siat.tdireccion_servicio (
    id_direccion_servicio serial NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    subtipo VARCHAR(50) ,
    url VARCHAR(200) NOT NULL,
    id_documento_fiscal INTEGER,
    id_documento_sector INTEGER,
    recepcion VARCHAR(50) NOT NULL,
    validacion VARCHAR(50),
    recepcion_anulacion VARCHAR(50),
    validacion_anulacion VARCHAR(50),    
    PRIMARY KEY (id_direccion_servicio))
INHERITS (pxp.tbase) WITHOUT OIDS;

CREATE TABLE siat.tmapeo_tipo_venta (
    id_mapeo_tipo_venta serial NOT NULL,
    id_documento_fiscal INTEGER,
    id_documento_sector INTEGER,    
    id_tipo_venta INTEGER,       
    PRIMARY KEY (id_mapeo_tipo_venta))
INHERITS (pxp.tbase) WITHOUT OIDS;

CREATE TABLE siat.tdocumento_sector (
    id_documento_sector serial NOT NULL,
    codigo VARCHAR(50) UNIQUE,
    descripcion TEXT,      
    PRIMARY KEY (id_documento_sector))
INHERITS (pxp.tbase) WITHOUT OIDS;

CREATE TABLE siat.tdocumento_fiscal (
    id_documento_fiscal serial NOT NULL,
    codigo VARCHAR(50) UNIQUE,
    descripcion TEXT,      
    PRIMARY KEY (id_documento_fiscal))
INHERITS (pxp.tbase) WITHOUT OIDS;

ALTER TABLE siat.tcuis
  ALTER COLUMN horas_anulacion TYPE VARCHAR(4);

--generar desde aqui
CREATE TABLE siat.tunidad_medida (
    id_unidad_medida serial NOT NULL,
    codigo VARCHAR(50) UNIQUE,
    descripcion TEXT,      
    PRIMARY KEY (id_unidad_medida))
INHERITS (pxp.tbase) WITHOUT OIDS;

CREATE TABLE siat.tleyenda (
    id_leyenda serial NOT NULL,
    codigo VARCHAR(50) UNIQUE,
    descripcion TEXT,      
    PRIMARY KEY (id_leyenda))
INHERITS (pxp.tbase) WITHOUT OIDS;

CREATE TABLE siat.tcomponente (
    id_componente serial NOT NULL,
    codigo VARCHAR(50) UNIQUE,
    descripcion TEXT,      
    PRIMARY KEY (id_componente))
INHERITS (pxp.tbase) WITHOUT OIDS;

CREATE TABLE siat.tdepartamento (
    id_departamento serial NOT NULL,
    codigo VARCHAR(50) UNIQUE,
    descripcion TEXT,      
    PRIMARY KEY (id_departamento))
INHERITS (pxp.tbase) WITHOUT OIDS;

CREATE TABLE siat.tfecha_hora (
    id_fecha_hora serial NOT NULL,
    fecha_hora VARCHAR(50),
    PRIMARY KEY (id_fecha_hora))
INHERITS (pxp.tbase) WITHOUT OIDS;

ALTER TABLE siat.tproducto
ADD COLUMN actividad VARCHAR(20) NOT NULL;

ALTER TABLE siat.tproducto
ADD COLUMN codigo_concepto_ingas VARCHAR(50);

ALTER TABLE siat.tunidad_medida
ADD COLUMN codigo_pxp VARCHAR(50);

ALTER TABLE siat.ttipo_moneda
ADD COLUMN codigo_pxp VARCHAR(50);

ALTER TABLE siat.tmetodo_pago
ADD COLUMN codigo_pxp VARCHAR(50);

ALTER TABLE siat.tcufd
ALTER COLUMN id_cuis DROP NOT NULL;

ALTER TABLE siat.tevento_significativo
ADD COLUMN id_evento INTEGER NOT NULL;

ALTER TABLE siat.tevento_significativo
ADD COLUMN codigo_sucursal VARCHAR(20) NOT NULL;

ALTER TABLE siat.tevento_significativo
ADD COLUMN codigo_punto_venta VARCHAR(20) NOT NULL;

ALTER TABLE siat.tevento_significativo
DROP COLUMN fk_sucursal;

ALTER TABLE siat.tcufd
ADD COLUMN codigo_sucursal VARCHAR(20) NOT NULL;

ALTER TABLE siat.tcufd
ADD COLUMN codigo_punto_venta VARCHAR(20) NOT NULL;


/************************************F-SCP-JRR-SIAT-0-10/12/2019*************************************************/
/************************************I-SCP-VAN-SIAT-0-09/03/2020*************************************************/
create table siat.ttipo_documento_identidad
(
    id_tipo_documento_identidad serial       not null
        constraint ttipo_documento_identidad_pkey
            primary key,
    codigo                      numeric      not null
        constraint ttipo_documento_identidad_codigo_key
            unique,
    descripcion                 varchar(200) not null
)
    inherits (pxp.tbase);
/************************************F-SCP-VAN-SIAT-0-09/03/2020*************************************************/