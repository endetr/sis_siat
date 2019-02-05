<?php
/**
*@package pXP
*@file    SolModPresupuesto.php
*@author  FPT
*@date    30-01-2014
*@description permites subir archivos a la tabla de documento_sol
 * ISSUE				FECHA			AUTHOR		  DESCRIPCION
 *  1A					24/08/2018			EGS  		se aumento campo para comprobante  y se hizo mejoras en los combos visualmente
*/
header("content-type: text/javascript; charset=UTF-8");
?>

<script>
Phx.vista.FormEstadoEnvioDocFiscales=Ext.extend(Phx.frmInterfaz,{
    constructor:function(config)
    {   
    	
    	//console.log('configuracion.... ',config)
    	this.panelResumen = new Ext.Panel({html:''});
    	this.Grupos = [{

	                    xtype: 'fieldset',
	                    border: false,
	                    autoScroll: true,
	                    layout: 'form',
	                    items: [],
	                    id_grupo: 0
				               
				    },
				     this.panelResumen
				    ];
				    
				    
	  
				    
       Phx.vista.FormEstadoEnvioDocFiscales.superclass.constructor.call(this,config);
       this.init(); 
       this.iniciarEventos(); 
    
       
        
        if(config.detalle){
        	
			//cargar los valores para el filtro
			this.loadForm({data: config.detalle});
			var me = this;
			setTimeout(function(){
				me.onSubmit()
			}, 1000);
			
		}  
       
        
        
    },
    
  
    
    Atributos:[
    
 
           
	   	  {
				config:{
					name: 'desde',
					fieldLabel: 'Desde',
					allowBlank: true,
					format: 'd/m/Y',
					anchor: '40%',
					width: 150
				},
				type: 'DateField',
				id_grupo: 0,
				form: true
		  },
		 
		/* {
			config:{
				name: 'desde',
				fieldLabel: 'Fecha Inicio',
				allowBlank: true,
				anchor: '40%',
				gwidth: 150,
							format: 'd/m/Y', 
							//renderer:function (value,p,record){return value?value.dateFormat('d/m/Y'):''}
			},
				type:'DateField',
				//filters:{pfiltro:'evsi.fecha_ini',type:'date'},
				id_grupo:0,
				//grid:true,
				form:true
		},*/
		  {
				config:{
					name: 'hasta',
					fieldLabel: 'Hasta',
					allowBlank: true,
					format: 'd/m/Y',
					anchor: '40%',
					width: 150
				},
				type: 'DateField',
				id_grupo: 0,
				form: true
		  },
		 
  			
     
       {
			config:{
				name: 'nro_documento',
				fieldLabel: 'Nro Documento',
				allowBlank: true,
				anchor: '40%',
				//anchor: '100%'
			},
			type:'TextField'
							
		},
   
		
		     
              
               
               
           
  	

	],

	labelSubmit: '<i class="fa fa-check"></i> Aplicar Filtro',
	south: {
		url: '../../../sis_siat/vista/envio_documento/EnvioDocumento.php',
		title: 'Estado de Envio de Documentos Fiscales',
		
		height: '60%',
		cls: 'EnvioDocumento'
	},
	title: 'Filtro',
	
	// Funcion guardar del formulario
	onSubmit: function(o) {  
			
		var me = this;
		if (me.form.getForm().isValid()) {	
				
			var parametros = me.getValForm();
			
			if (this.Cmp.desde.getValue()> this.Cmp.hasta.getValue()){
				
				alert("La fecha 'Desde' debe ser menor a la fecha 'Hasta'")
			} else {
				
				//alert("pasooo")
			this.onEnablePanel(this.idContenedor + '-south', parametros);
			
			}
       }
    },
	//
    iniciarEventos:function(){
    	
    },
    

    
    loadValoresIniciales: function(){
    	Phx.vista.FormEstadoEnvioDocFiscales.superclass.loadValoresIniciales.call(this);
    	
    	
    	
    	
    }
    
})    
</script>