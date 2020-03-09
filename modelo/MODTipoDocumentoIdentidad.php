<?php
/**
 * @package pXP
 * @file gen-MODDocumentoIdentidad.php
 * @author  (admin)
 * @date 17-01-2019 22:29:35
 * @description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 */
include dirname(__FILE__) . '/MODBaseSiat.php';

class MODTipoDocumentoIdentidad extends MODBaseSiat
{

    function __construct(CTParametro $pParam)
    {
        parent::__construct($pParam);
    }

    function listarTipoDocumentoIdentidad()
    {
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento = 'siat.ft_tipo_documento_identidad_sel';
        $this->transaccion = 'SIA_TDISIA_SEL';
        $this->tipo_procedimiento = 'SEL';//tipo de transaccion

        //Definicion de la lista del resultado del query
        $this->captura('id_documento_identidad', 'int4');
        $this->captura('codigo', 'numeric');
        $this->captura('descripcion', 'varchar');
        $this->captura('estado_reg', 'varchar');
        $this->captura('fecha_reg', 'timestamp');
        $this->captura('id_usuario_ai', 'int4');
        $this->captura('id_usuario_reg', 'int4');
        $this->captura('usuario_ai', 'varchar');
        $this->captura('fecha_mod', 'timestamp');
        $this->captura('id_usuario_mod', 'int4');
        $this->captura('usr_reg', 'varchar');
        $this->captura('usr_mod', 'varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function insertarTipoDocumentoIdentidad()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'siat.ft_tipo_documento_identidad_ime';
        $this->transaccion = 'SIA_TDISIA_INS';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('codigo', 'codigo', 'numeric');
        $this->setParametro('descripcion', 'descripcion', 'varchar');
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function modificarTipoDocumentoIdentidad()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'siat.ft_tipo_documento_identidad_ime';
        $this->transaccion = 'SIA_TDISIA_MOD';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_tipo_documento_identidad', 'id_tipo_documento_identidad', 'int4');
        $this->setParametro('codigo', 'codigo', 'numeric');
        $this->setParametro('descripcion', 'descripcion', 'varchar');
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function eliminarTipoDocumentoIdentidad()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'siat.ft_tipo_documento_identidad_ime';
        $this->transaccion = 'SIA_TDISIA_ELI';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_tipo_documento_identidad', 'id_tipo_documento_identidad', 'int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function sincronizarTipoDocumentoIdentidad()
    {
        $this->respuesta = $this->sincronizar('sincronizacion', 'tipo_documento_identidad', 'ttipo_documento_identidad');
        return $this->respuesta;
    }

}

?>