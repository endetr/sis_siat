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


