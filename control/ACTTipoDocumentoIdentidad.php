<?php
/**
 * @package pXP
 * @file gen-ACTTipoDocumentoIdentidad.php
 * @author  (admin)
 * @date 17-01-2019 22:29:35
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 */

class ACTTipoDocumentoIdentidad extends ACTbase
{

    function listarTipoDocumentoIdentidad()
    {
        $this->objParam->defecto('ordenacion', 'id_tipo_documento_identidad');

        $this->objParam->defecto('dir_ordenacion', 'asc');
        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODTipoDocumentoIdentidad', 'listarTipoDocumentoIdentidad');
        } else {
            $this->objFunc = $this->create('MODTipoDocumentoIdentidad');

            $this->res = $this->objFunc->listarTipoDocumentoIdentidad($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertarTipoDocumentoIdentidad()
    {
        $this->objFunc = $this->create('MODTipoDocumentoIdentidad');
        if ($this->objParam->insertar('id_tipo_documento_identidad')) {
            $this->res = $this->objFunc->insertarTipoDocumentoIdentidad($this->objParam);
        } else {
            $this->res = $this->objFunc->modificarTipoDocumentoIdentidad($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminarTipoDocumentoIdentidad()
    {
        $this->objFunc = $this->create('MODTipoDocumentoIdentidad');
        $this->res = $this->objFunc->eliminarTipoDocumentoIdentidad($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function sincronizarTipoDocumentoIdentidad()
    {
        $this->objFunc = $this->create('MODTipoDocumentoIdentidad');
        $this->res = $this->objFunc->sincronizarTipoDocumentoIdentidad($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

}

?>