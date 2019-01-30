<?php

namespace dte\firma\Sii;
include dirname(__FILE__).'/XML.php';
include dirname(__FILE__).'/Estado.php';
include '/Log.php';
include dirname(__FILE__).'/Arreglo.php';


class EnvioDte{

    private $dtes = []; ///< Objetos con los DTE que se enviarán
    private $config = [ // 0: DTE, 1: boleta
        'SubTotDTE_max' => [20, 2], ///< máxima cantidad de tipos de documentos en el envío
        'DTE_max' => [2000, 1000], ///< máxima cantidad de DTE en un envío
        'tipos' => ['EnvioDTE', 'EnvioBOLETA'], ///< Tag para el envío, según si son Boletas o no
        'schemas' => ['EnvioDTE_v10', 'EnvioBOLETA_v11'], ///< Schema (XSD) que se deberá usar para validar según si son boletas o no
    ]; ///< Configuración/reglas para el documento XML
    private $tipo = null; ///< =0 DTE, =1 boleta

    /**
     * Método que agrega un DTE al listado que se enviará
     * @param DTE Objeto del DTE
     * @return =true si se pudo agregar el DTE o =false si no se agregó por exceder el límite de un envío
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2015-12-11
     */
    public function agregar(Dte $DTE)
    {
        // determinar el tipo del envío (DTE o boleta)
        if ($this->tipo === null) {
            $this->tipo = (int)$DTE->esBoleta();
        }
        // validar que el tipo de documento sea del tipo que se espera
        else if ((int)$DTE->esBoleta() != $this->tipo) {
            return false;
        }
        //
        if (isset($this->dtes[$this->config['DTE_max'][$this->tipo]-1])) {
            \sasco\LibreDTE\Log::write(
                \sasco\LibreDTE\Estado::ENVIODTE_DTE_MAX,
                \sasco\LibreDTE\Estado::get(\sasco\LibreDTE\Estado::ENVIODTE_DTE_MAX, $this->config['DTE_max'][$this->tipo])
            );
            return false;
        }
        $this->dtes[] = $DTE;
        return true;
    }

    /**
     * Método para asignar la caratula
     * @param caratula Arreglo con datos del envío: RutEnvia, FchResol y NroResol
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2015-12-11
     */
    public function setCaratula(array $caratula)
    {
        // si no hay DTEs para generar entregar falso
        if (!isset($this->dtes[0])) {
            \sasco\LibreDTE\Log::write(
                \sasco\LibreDTE\Estado::ENVIODTE_FALTA_DTE,
                \sasco\LibreDTE\Estado::get(\sasco\LibreDTE\Estado::ENVIODTE_FALTA_DTE)
            );
            return false;
        }
        // si se agregaron demasiados DTE error
        $SubTotDTE = $this->getSubTotDTE();
        if (isset($SubTotDTE[$this->config['SubTotDTE_max'][$this->tipo]])) {
            \sasco\LibreDTE\Log::write(
                \sasco\LibreDTE\Estado::ENVIODTE_TIPO_DTE_MAX,
                \sasco\LibreDTE\Estado::get(\sasco\LibreDTE\Estado::ENVIODTE_TIPO_DTE_MAX, $this->config['SubTotDTE_max'][$this->tipo])
            );
            return false;
        }
        // generar caratula
        $this->caratula = array_merge([
            '@attributes' => [
                'version' => '1.0'
            ],
            'RutEmisor' => $this->dtes[0]->getEmisor(),
            'RutEnvia' => isset($this->Firma) ? $this->Firma->getID() : false,
            'RutReceptor' => $this->dtes[0]->getReceptor(),
            'FchResol' => '',
            'NroResol' => '',
            'TmstFirmaEnv' => date('Y-m-d\TH:i:s'),
            'SubTotDTE' => $SubTotDTE,
        ], $caratula);
        return true;
    }

    /**
     * Método que realiza el envío del sobre con el o los DTEs al SII
     * @return Track ID del envío o =false si hubo algún problema al enviar el documento
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2015-12-15
     */
    public function enviar()
    {
        // si es boleta no se envía al SII
        if ($this->tipo) {
            return false;
        }
        // enviar al SII
        return parent::enviar();
    }

    /**
     * Método que genera el XML para el envío del DTE al SII
     * @return XML con el envio del DTE firmado o =false si no se pudo generar o firmar el envío
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-08-06
     */
    public function generar()
    {
        // si ya se había generado se entrega directamente
        if ($this->xml_data)
            return $this->xml_data;
        // si no hay DTEs para generar entregar falso
        if (!isset($this->dtes[0])) {
            \sasco\LibreDTE\Log::write(
                \sasco\LibreDTE\Estado::ENVIODTE_FALTA_DTE,
                \sasco\LibreDTE\Estado::get(\sasco\LibreDTE\Estado::ENVIODTE_FALTA_DTE)
            );
            return false;
        }
        // genear XML del envío
        $xmlEnvio = (new \sasco\LibreDTE\XML())->generate([
            $this->config['tipos'][$this->tipo] => [
                '@attributes' => [
                    'xmlns' => 'http://www.sii.cl/SiiDte',
                    'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                    'xsi:schemaLocation' => 'http://www.sii.cl/SiiDte '.$this->config['schemas'][$this->tipo].'.xsd',
                    'version' => '1.0'
                ],
                'SetDTE' => [
                    '@attributes' => [
                        'ID' => 'LibreDTE_SetDoc'
                    ],
                    'Caratula' => $this->caratula,
                    'DTE' => null,
                ]
            ]
        ])->saveXML();
        // generar XML de los DTE que se deberán incorporar
        $DTEs = [];
        foreach ($this->dtes as &$DTE) {
            $DTEs[] = trim(str_replace(['<?xml version="1.0" encoding="ISO-8859-1"?>', '<?xml version="1.0"?>'], '', $DTE->saveXML()));
        }
        // firmar XML del envío y entregar
        $xml = str_replace('<DTE/>', implode("\n", $DTEs), $xmlEnvio);
        $this->xml_data = $this->Firma ? $this->Firma->signXML($xml, '#LibreDTE_SetDoc', 'SetDTE', true) : $xml;
        return $this->xml_data;
    }

    /**
     * Método que obtiene los datos para generar los tags SubTotDTE
     * @return Arreglo con los datos para generar los tags SubTotDTE
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2015-09-02
     */
    private function getSubTotDTE()
    {
        $SubTotDTE = [];
        $subtotales = [];
        foreach ($this->dtes as &$DTE) {
            if (!isset($subtotales[$DTE->getTipo()]))
                $subtotales[$DTE->getTipo()] = 0;
            $subtotales[$DTE->getTipo()]++;
        }
        foreach ($subtotales as $tipo => $subtotal) {
            $SubTotDTE[] = [
                'TpoDTE' => $tipo,
                'NroDTE' => $subtotal,
            ];
        }
        return $SubTotDTE;
    }

    /**
     * Método que carga un XML de EnvioDte y asigna el objeto XML correspondiente
     * para poder obtener los datos del envío
     * @return Objeto XML
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-11-21
     */
    public function loadXML($xml_data)
    {
        if (!parent::loadXML($xml_data)) {
            return false;
        }
        $tagName = $this->xml->documentElement->tagName;
        if ($tagName=='DTE') {
            $this->xml = null;
            $this->xml_data = null;
            $this->arreglo = null;
            $Dte = new Dte($xml_data, false);
            $this->agregar($Dte);
            $this->setCaratula([
                'RutEnvia' => $Dte->getEmisor(),
                'RutReceptor' => $Dte->getReceptor(),
                'FchResol' => date('Y-m-d'),
                'NroResol' => ($Dte->getCertificacion()?'0':'').'9999',
            ]);
            if (!parent::loadXML($this->generar())) {
                return false;
            }
            $tagName = $this->xml->documentElement->tagName;
        }
        if ($tagName=='EnvioDTE') {
            $this->tipo = 0;
            return $this->xml;
        }
        if ($tagName=='EnvioBOLETA') {
            $this->tipo = 1;
            return $this->xml;
        }
        return false;
    }

    /**
     * Método que entrega un arreglo con los datos de la carátula del envío
     * @return Arreglo con datos de carátula
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2015-12-11
     */
    public function getCaratula()
    {
        return isset($this->arreglo[$this->config['tipos'][$this->tipo]]['SetDTE']['Caratula']) ? $this->arreglo[$this->config['tipos'][$this->tipo]]['SetDTE']['Caratula'] : false;
    }

    /**
     * Método que entrega el ID de SetDTE
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2015-12-11
     */
    public function getID()
    {
        return isset($this->arreglo[$this->config['tipos'][$this->tipo]]['SetDTE']['@attributes']['ID']) ? $this->arreglo[$this->config['tipos'][$this->tipo]]['SetDTE']['@attributes']['ID'] : false;
    }

    /**
     * Método que entrega el DigestValue de la firma del envío
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2015-12-11
     */
    public function getDigest()
    {
        return isset($this->arreglo[$this->config['tipos'][$this->tipo]]['Signature']['SignedInfo']['Reference']['DigestValue']) ? $this->arreglo[$this->config['tipos'][$this->tipo]]['Signature']['SignedInfo']['Reference']['DigestValue'] : false;
    }

    /**
     * Método que entrega el rut del emisor del envío
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2015-09-07
     */
    public function getEmisor()
    {
        $Caratula = $this->getCaratula();
        return $Caratula ? $Caratula['RutEmisor'] : false;
    }

    /**
     * Método que entrega el rut del receptor del envío
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2015-09-07
     */
    public function getReceptor()
    {
        $Caratula = $this->getCaratula();
        return $Caratula ? $Caratula['RutReceptor'] : false;
    }

    /**
     * Método que entrega la fecha del DTE más antiguo del envio
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2015-12-12
     */
    public function getFechaEmisionInicial()
    {
        $fecha = '9999-12-31';
        foreach ($this->getDocumentos() as $Dte) {
            if ($Dte->getFechaEmision() < $fecha)
                $fecha = $Dte->getFechaEmision();
        }
        return $fecha;
    }

    /**
     * Método que entrega la fecha del DTE más nuevo del envio
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2015-12-12
     */
    public function getFechaEmisionFinal()
    {
        $fecha = '0000-01-01';
        foreach ($this->getDocumentos() as $Dte) {
            if ($Dte->getFechaEmision() > $fecha)
                $fecha = $Dte->getFechaEmision();
        }
        return $fecha;
    }

    /**
     * Método que entrega el arreglo con los objetos DTE del envío
     * @return Arreglo de objetos DTE
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-11-21
     */
    public function getDocumentos($c14n = true)
    {
        // si no hay documentos se deben crear
        if (!$this->dtes) {
            // si no hay XML no se pueden crear los documentos
            if (!$this->xml) {
                \sasco\LibreDTE\Log::write(
                    \sasco\LibreDTE\Estado::ENVIODTE_GETDOCUMENTOS_FALTA_XML,
                    \sasco\LibreDTE\Estado::get(\sasco\LibreDTE\Estado::ENVIODTE_GETDOCUMENTOS_FALTA_XML)
                );
                return false;
            }
            // crear documentos a partir del XML
            $DTEs = $this->xml->getElementsByTagName('DTE');
            foreach ($DTEs as $nodo_dte) {
                $xml = $c14n ? $nodo_dte->C14N() : $this->xml->saveXML($nodo_dte);
                $this->dtes[] = new Dte($xml, false); // cargar DTE sin normalizar
            }
        }
        return $this->dtes;
    }

    /**
     * Método que entrega el objeto DTE solicitado del envío
     * @return Objeto DTE
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-11-21
     */
    public function getDocumento($emisor, $dte, $folio)
    {
        $emisor = str_replace('.', '', $emisor);
        // si no hay XML no se pueden crear los documentos
        if (!$this->xml) {
            \sasco\LibreDTE\Log::write(
                \sasco\LibreDTE\Estado::ENVIODTE_GETDOCUMENTOS_FALTA_XML,
                \sasco\LibreDTE\Estado::get(\sasco\LibreDTE\Estado::ENVIODTE_GETDOCUMENTOS_FALTA_XML)
            );
            return false;
        }
        // buscar documento
        $DTEs = $this->xml->getElementsByTagName('DTE');
        foreach ($DTEs as $nodo_dte) {
            $e = $nodo_dte->getElementsByTagName('RUTEmisor')->item(0)->nodeValue;
            if (is_numeric($emisor))
                $e = substr($e, 0, -2);
            $d = (int)$nodo_dte->getElementsByTagName('TipoDTE')->item(0)->nodeValue;
            $f = (int)$nodo_dte->getElementsByTagName('Folio')->item(0)->nodeValue;
            if ($folio == $f and $dte == $d and $emisor == $e) {
                return new Dte($nodo_dte->C14N(), false); // cargar DTE sin normalizar
            }
        }
        return false;
    }

    /**
     * Método que indica si es EnvioDTE o EnvioBOLETA
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-08-27
     */
    public function esBoleta()
    {
        return $this->tipo!==null ? (bool)$this->tipo : null;
    }

    /**
     * Método que determina el estado de validación sobre el envío
     * @param datos Arreglo con datos para hacer las validaciones
     * @return Código del estado de la validación
     * @warning No se está validando la firma del EnvioDTE
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2015-09-07
     */
    public function getEstadoValidacion(array $datos = null)
    {
        if (!$this->schemaValidate())
            return 1;
        /*if (!$this->checkFirma())
            return 2;*/
        if ($datos and $this->getReceptor()!=$datos['RutReceptor'])
            return 3;
        return 0;
    }

    /**
     * Método que indica si la firma del documento es o no válida
     * @return =true si la firma del documento del envío es válida, =null si no se pudo determinar
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-04-07
     */
    public function checkFirma()
    {
        if (!$this->xml)
            return null;
        // listado de firmas del XML
        $Signatures = $this->xml->documentElement->getElementsByTagName('Signature');
        // verificar firma de SetDTE
        $SetDTE = $this->xml->documentElement->getElementsByTagName('SetDTE')->item(0)->C14N();
        $SignedInfo = $Signatures->item($Signatures->length-1)->getElementsByTagName('SignedInfo')->item(0);
        $DigestValue = $Signatures->item($Signatures->length-1)->getElementsByTagName('DigestValue')->item(0)->nodeValue;
        $SignatureValue = $Signatures->item($Signatures->length-1)->getElementsByTagName('SignatureValue')->item(0)->nodeValue;
        $X509Certificate = $Signatures->item($Signatures->length-1)->getElementsByTagName('X509Certificate')->item(0)->nodeValue;
        if ($X509Certificate[1]==' ' or $X509Certificate[1]=="\t") {
            $lineas = explode("\n", $X509Certificate);
            $X509Certificate = '';
            foreach($lineas as $l) {
                $X509Certificate .= trim($l);
            }
        }
        $X509Certificate = '-----BEGIN CERTIFICATE-----'."\n".wordwrap(trim($X509Certificate), 64, "\n", true)."\n".'-----END CERTIFICATE-----';
        $valid = openssl_verify($SignedInfo->C14N(), base64_decode($SignatureValue), $X509Certificate) === 1 ? true : false;
        return $valid and $DigestValue===base64_encode(sha1($SetDTE, true));
    }

}
