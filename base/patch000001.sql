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


