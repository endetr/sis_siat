<?php
/**
*@package pXP
*@file gen-SistemaDist.php
*@author  (rarteaga)
*@date 20-09-2011 10:22:05
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
*/
header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.GestorPaquete = {    
    bsave:false,    
    require:'../../../sis_siat/vista/gestor_documento/Gestor.php',
    requireclase:'Phx.vista.Gestor',
    title:'Gestor Paquetes',
    nombreVista: 'GestorPaquete',
    
    constructor: function(config) {
        this.maestro=config.maestro;  
        Phx.vista.GestorPaquete.superclass.constructor.call(this,config);  
        this.store.baseParams.tipo = 'paquete';
		this.load({params:{start:0, limit:this.tam_pag}})      
    }  
    
    
};
</script>
