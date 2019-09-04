<?php

include_once(dirname(__FILE__).'/XML.php');

class Factura
{
	/**
	* Funcion que crea un archivo XML (/tmp/facturaEstandar.xml)validado a partir de 2 arreglos, cabecera y detalle
	* @param cabecera Arreglo con los datos que se usarán para generar la cabecera de la factura
	* @param detalle Arreglo con los datos que se usarán para generar el detalle de la factura
	*  asignacion de spacio de nombres para el XML (URI y prefijo), estatico.en el nodo cabecera
	* Cargar el archivo XSD (/tmp/facturaEstandar.xsd)para la validacion
	*/

	public $xmlString;
	public $xmlFisico;
	public $xmlFirFisico;
	public $base64Fisico;
	public $gzipFisico;
	public $gzipB64Fisico;
	public $nombre;
	public $dirArchivoXSD;
	public $doc;
	public $tipo;
	public $documentoTipo;
	public $modalidad;

	public function __construct($name, $dirTemp,$modalidad = "Computarizada",$tipo = "Estandar")
	{
		$this->documentoTipo= $tipo == "CreditoDebito"?"notaFiscal":"factura";
		$this->dirArchivoXSD   = dirname(__FILE__).'/../archivos_xsd/' . $this->documentoTipo . $modalidad . $tipo . '.xsd';
		$this->nombre       = $name; 
		$this->xmlString    = "";
		$this->modalidad	= $modalidad;
		$this->tipo			= $tipo;		
		$this->xmlFisico    = $dirTemp.$this->nombre.".xml";
		$this->xmlFirFisico = $dirTemp.$this->nombre."_Firmado.xml";		
		$this->base64Fisico = $dirTemp.$this->nombre."_FirmadoB64.txt";		
		$this->gzipFisico   = $dirTemp.$this->nombre."_FirmadoB64Gzip.txt.gz";	
		$this->gzipB64Fisico= $dirTemp.$this->nombre."_FirmadoB64GzipB64.txt";		
	}

	public function loadXml($cabecera,$detalles) {
		$facturaTipo = $this->documentoTipo . $this->modalidad . $this->tipo;
		libxml_use_internal_errors(false); 
		$this->doc = new XML('1.0','UTF-8');
		$arregloLoad = [
            $facturaTipo => [
                '@attributes' => [     
                	'xmlns:ds'						=>"http://www.w3.org/2000/09/xmldsig#",           	
                    'xmlns:xsi' 					=> 'http://www.w3.org/2001/XMLSchema-instance',
                    'xsi:noNamespaceSchemaLocation'	=> $facturaTipo.".xsd"                    
                	],
                 'cabecera'	=> []]];
		
		foreach ($cabecera as $key => $value) {
			if (is_null($value)) {
				$arregloLoad[$facturaTipo]['cabecera'][$key] = [
                																	'@attributes'=>['xsi:nil'=>'true'],
																					'@value' => '' 
                																 ];				
			} else {
				$arregloLoad[$facturaTipo]['cabecera'][$key] = ['@value' => $value];
			}
		}		
		
		$this->doc->generate($arregloLoad);
		$nodes = $this->doc->getElementsByTagName($facturaTipo);
		$node = $nodes->item(0);
		foreach ($detalles as $detalle) {
			$arregloLoad = ['detalle' => []];
			foreach ($detalle as $key => $value) {
				if (is_null($value)) {
					$arregloLoad['detalle'][$key] = [
														'@attributes'=>['xsi:nil'=>'true'] ,
														'@value' => '' 
													 ];					
				} else {
					$arregloLoad['detalle'][$key] = ['@value' => $value];
				}
			}
			
			$this->doc->generate($arregloLoad, null, $node);
		}
		$this->doc->save($this->xmlFisico);
		copy ( $this->xmlFisico , $this->xmlFirFisico);
	}

	public function addEmptySignature() 
	{
		$facturaTipo = $this->documentoTipo . $this->modalidad . $this->tipo;
		$xml = file_get_contents($this->xmlFirFisico);
		$xml = rtrim(preg_replace('/^ +/m', '', $xml));
		$replace_string = 
<<<EOT
<Signature xmlns="http://www.w3.org/2000/09/xmldsig#">
<SignedInfo>
<CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"></CanonicalizationMethod>
<SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256"></SignatureMethod>
<Reference URI="">
<Transforms>
<Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"></Transform>
<Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315#WithComments"></Transform>
</Transforms>
<DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"></DigestMethod>
<DigestValue></DigestValue>
</Reference>
</SignedInfo>
<SignatureValue/>
<KeyInfo>
<X509Data>
<X509Certificate/>
</X509Data>
</KeyInfo>
</Signature></$facturaTipo>
EOT;
		$replace_string = str_replace("\r\n","\n", $replace_string);
		$xml = str_replace('</' . $facturaTipo . '>',$replace_string, $xml);
		file_put_contents($this->xmlFirFisico, $xml);
		
	}

	/**
	 * Firmal el archivo XML y lo guarda
	 * @return integer Devuelve 1 si es correcto y 0 si no pasa la validacion
	 */	 	
	public function sign($key_file)
	{   //anadir firma vacia
		$this->addEmptySignature();	
		//firmar en archivo temporal
		//echo 'xmlsec1 --sign --output ' . $this->xmlFirFisico . '.temp --pkcs12 ' . $key_file . ' --pwd mundolibre ' . $this->xmlFirFisico;
		$salida = shell_exec('xmlsec1 --sign --output ' . $this->xmlFirFisico . '.temp --pkcs12 ' . $key_file . ' --pwd mundolibre ' . $this->xmlFirFisico);
		//var_dump($salida);
		//obtener digestvalue signature value y certificate de xml firmado
		$dom = new DOMDocument; 
		$dom->load($this->xmlFirFisico . '.temp');
		//digest
		$nodes = $dom->getElementsByTagName('DigestValue');
		$digest = $nodes->item(0)->nodeValue;
		//signaturevalue
		$nodes = $dom->getElementsByTagName('SignatureValue');
		$signature = $nodes->item(0)->nodeValue;
		$signature = preg_replace( "/\r|\n/", "", $signature );
		$signature = chunk_split($signature, 76,"\n");
		$signature = rtrim($signature);
		//x509certificate
		$nodes = $dom->getElementsByTagName('X509Certificate');
		$certificate = $nodes->item(0)->nodeValue;
		$certificate = preg_replace( "/\r|\n/", "", $certificate );
		$certificate = chunk_split($certificate, 76,"\n");
		$certificate = rtrim($certificate);
		//reemplazar valores encontrados
		$xml = file_get_contents($this->xmlFirFisico);
		$xml = str_replace('<DigestValue></DigestValue>',"<DigestValue>$digest</DigestValue>",$xml);
		$xml = str_replace('<SignatureValue/>',"<SignatureValue>\n$signature\n</SignatureValue>",$xml);
		$xml = str_replace('<X509Certificate/>',"<X509Certificate>\n$certificate\n</X509Certificate>",$xml);
		
		file_put_contents($this->xmlFirFisico, $xml);
		//eliminar arhivo temporal
		unlink ( $this->xmlFirFisico . '.temp' );
		
		//eliminar la primera fila
		$file = file($this->xmlFirFisico);	    
	    unset($file[0]);
	    file_put_contents($this->xmlFirFisico, $file);	  
		
	}

		
	 /**
	 * Compara el archivo XML con el XSD para validar
	 * @return integer Devuelve 1 si es correcto y 0 si no pasa la validacion
	 */	 
	public function validarXmlConXSD()
	{    
		  
		$res = false;
		if (!$this->doc->schemaValidate($this->dirArchivoXSD)) 
		{
            print '<b>DOMDocument::schemaValidate() Generated Errors!</b>';
             //$this->libxml_display_errors();
        }else{
            $res = true;     
        }		
		return $res;
		
	}

	/**
	 * Crea el archivo base64.txt
	 * @return void
	 */
	public function crearArchivoBase64()
	{
		$base64 = $this->convertirArchivoABase64();
		if (file_exists($this->base64Fisico))
		{
			unlink($this->base64Fisico);
			$archivo = fopen($this->base64Fisico, "a");
			fwrite($archivo, $base64);
			fclose($archivo);
		}
		else{
			$archivo = fopen($this->base64Fisico, "w");
			fwrite($archivo, $base64);
			fclose($archivo);
		}
	}

	/**
	 * Crea el archivo gzip.txt.gz
	 * @return void
	 */
	public function crearArchivoGZIP()
	{
		$data = implode("", file($this->base64Fisico));
		$gzdata = gzencode($data, 9);
		$fp = fopen($this->gzipFisico, "w");
		fwrite($fp, $gzdata);
		fclose($fp);
	}

	/**
	 * Agarra el archivo GZIP y lo convierte en base64
	 * @return string Devuelve la cadena del base del archivo GZIP
	 */
	public function convertirArchivoGZIPABase64()
	{
		$base64 = '';
		$path   = $this->gzipFisico;
		$type   = pathinfo($path, PATHINFO_EXTENSION);
		$data   = file_get_contents($path);
		$base64 = base64_encode($data);
		file_put_contents($this->gzipB64Fisico, $base64);
		return $base64;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	private function convertirArchivoABase64()
	{			
		$data   = file_get_contents($this->xmlFirFisico);
		$base64 = base64_encode($data);		
		return $base64;
	}
}



?>
