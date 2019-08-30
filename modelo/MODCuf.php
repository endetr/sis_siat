<?php
/**
*@package pXP
*@file gen-MODCuf.php
*@author  (admin)
*@date 21-01-2019 15:18:42
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/

class MODCuf extends MODbase{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarCuf(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='siat.ft_cuf_sel';
		$this->transaccion='SIA_CUF_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_cuf','int4');
		$this->captura('nro_factura','int4');
		$this->captura('codigo_documento_fiscla','int4');
		$this->captura('nit','int4');
		$this->captura('base11','int4');
		$this->captura('sucursal','numeric');
		$this->captura('punto_venta','int4');
		$this->captura('fecha_emision','varchar');
		$this->captura('modalidad','int4');
		$this->captura('codigo_autoverificador','int4');
		$this->captura('tipo_documento_sector','int4');
		$this->captura('tipo_emision','int4');
		$this->captura('base16','varchar');
		$this->captura('estado_reg','varchar');
		$this->captura('concatenacion','varchar');
		$this->captura('id_usuario_ai','int4');
		$this->captura('id_usuario_reg','int4');
		$this->captura('fecha_reg','timestamp');
		$this->captura('usuario_ai','varchar');
		$this->captura('fecha_mod','timestamp');
		$this->captura('id_usuario_mod','int4');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');
		
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();
		
		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function insertarCuf(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_cuf_ime';
		$this->transaccion='SIA_CUF_INS';
		$this->tipo_procedimiento='IME';
		
		/*$this->arreglo['concatenacion'] = self::concatenar(
												$this->arreglo['nit'],
												$this->arreglo['fecha_emision'],
												$this->arreglo['sucursal'],
												$this->arreglo['modalidad'],
												$this->arreglo['tipo_emision'],
												$this->arreglo['codigo_documento_fiscal'],
												$this->arreglo['tipo_documento_sector'],
												$this->arreglo['nro_factura'],
												$this->arreglo['punto_venta']);  
												
		$this->arreglo['mod11'] = self::mod11($this->arreglo['concatenacion']); 
		$this->arreglo['concatenacion'] = $this->arreglo['concatenacion'] . $this->arreglo['mod11']; 
		$this->arreglo['base16'] = self::bcdechex($this->arreglo['concatenacion']);*/
		 
				
		//Define los parametros para la funcion
		$this->setParametro('nro_factura','nro_factura','int4');		
		$this->setParametro('nit','nit','int4');		
		$this->setParametro('sucursal','sucursal','numeric');
		$this->setParametro('punto_venta','punto_venta','int4');
		$this->setParametro('codigo_documento_fiscal','codigo_documento_fiscal','int4');
		$this->setParametro('fecha_emision','fecha_emision','varchar');
		$this->setParametro('modalidad','modalidad','int4');		
		$this->setParametro('tipo_documento_sector','tipo_documento_sector','int4');
		$this->setParametro('tipo_emision','tipo_emision','int4');	
		$this->setParametro('base11','mod11','int4');
		$this->setParametro('concatenacion','concatenacion','varchar');
		$this->setParametro('base16','base16','varchar');			

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarCuf(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_cuf_ime';
		$this->transaccion='SIA_CUF_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_cuf','id_cuf','int4');
		$this->setParametro('nro_factura','nro_factura','int4');
		$this->setParametro('codigo_documento_fiscla','codigo_documento_fiscla','int4');
		$this->setParametro('nit','nit','int4');
		$this->setParametro('base11','base11','int4');
		$this->setParametro('sucursal','sucursal','numeric');
		$this->setParametro('punto_venta','punto_venta','int4');
		$this->setParametro('fecha_emision','fecha_emision','timestamp');
		$this->setParametro('modalidad','modalidad','int4');
		$this->setParametro('codigo_autoverificador','codigo_autoverificador','int4');
		$this->setParametro('tipo_documento_sector','tipo_documento_sector','int4');
		$this->setParametro('tipo_emision','tipo_emision','int4');
		$this->setParametro('base16','base16','varchar');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('concatenacion','concatenacion','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarCuf(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_cuf_ime';
		$this->transaccion='SIA_CUF_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_cuf','id_cuf','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
	static function concatenar($nit,$fecha_emision,$sucursal,$modalidad,$tipo_emision,$codigo_documento_fiscal,
	  					$tipo_documento_sector,$nro_factura,$punto_venta){
	  	$res = '';
		
	    $nit = str_pad($nit, 13, '0', STR_PAD_LEFT);     
	    $sucursal = str_pad($sucursal,4,'0',STR_PAD_LEFT);
	    $tipo_documento_sector = str_pad($tipo_documento_sector,2,'0',STR_PAD_LEFT);
	    $nro_factura = str_pad($nro_factura,8,'0',STR_PAD_LEFT);
	    $punto_venta = str_pad($punto_venta,4,'0',STR_PAD_LEFT);
		
		$res = $nit . $fecha_emision . $sucursal . $modalidad 
	    					. $tipo_emision . $codigo_documento_fiscal
	                        . $tipo_documento_sector . $nro_factura . $punto_venta;
		return $res;
	  						
	}

	
    static function mod11( $dado, $numDig, $limMult, $x10)
	{
		
		if (!$x10) 
			$numDig = 1;
		for($n = 1; $n <= $numDig; $n++) {
			$soma = 0;
			$mult = 2;
			for($i = strlen($dado) - 1; $i >= 0; $i--) {
				$soma += ($mult * (int)substr($dado, $i, 1));
				
				if(++$mult > $limMult) 
					$mult = 2;
			}
			
			if ($x10) {
				$dig = (($soma * 10) % 11) % 10;
			}
			else {
				$dig = $soma % 11;
			}
			if ($x10) {
				$dig = (($soma * 10) % 11) % 10;
			}
			else {
				$dig = $soma % 11;
			}
			
			if ($dig == 10) {
			 	$dado .= "1";
			}
			
			if ($dig == 11) {
			 	$dado .= "0";
			}
			 
			if ($dig < 10) {
				$dado .= $dig;
			}
			
		}
		return substr($dado, strlen($dado) - $numDig, 1);
	}    

    
	
	static function bcdechex($dec) {
	    $hex = '';
	    do {    
	        $last = bcmod($dec, 16);
	        $hex = dechex($last).$hex;
	        $dec = bcdiv(bcsub($dec, $last), 16);
	    } while($dec>0);
	    return $hex;
	}
			
}
?>