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
Phx.vista.FormResumenVenta=Ext.extend(Phx.frmInterfaz,{
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
				    
				    
	  
				    
       Phx.vista.FormResumenVenta.superclass.constructor.call(this,config);
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
				name: 'codigo_evento',
				fieldLabel: 'Cod Evento',
				allowBlank: true,
				anchor: '40%',
				//anchor: '100%'
			},
			type:'TextField'
							
		},
   
		
		     
              
               
               
           
  	

	],

	/*labelSubmit: '<i class="fa fa-check"></i> Aplicar Filtro',
	south: {
		url: '../../../sis_siat/vista/salud_sistema/SaludSistema.php',
		title: 'Eventos de Salud del Sistema',
		
		height: '60%',
		cls: 'SaludSistema'
	},
	title: 'Filtro',*/
	
	// Funcion guardar del formulario
	onSubmit: function(o) {  
			
		var me = this;
		if (me.form.getForm().isValid()) {		
			var parametros = me.getValForm();
			
			//var fecha_desde=this.Cmp.desde.getValue();
			//var fecha_hasta=this.Cmp.hasta.getValue();
			//var nombre_sucursal = this.id_sucursal.getValue(2);
			//var id_sucursal=this.Cmp.fk_sucursal.lastSelectionText;
		//	var codigo_evento=this.Cmp.codigo_evento.getValue();
				
			this.onEnablePanel(this.idContenedor + '-south', parametros);
			
			/*this.onEnablePanel(this.idContenedor + '-south', 
				Ext.apply(parametros,{	'fecha_ini': fecha_desde,
										'fecha_fin': fecha_hasta
									//	'nombre_sucursal': nombre_sucursal,
										//'codigo_evento' : codigo_evento
										 /// 'desc_proveedor':desc_pro,
										// 'nombre_auxiliar' : nom_aux,
										 //'razon_social':razon_social
									 }));*/
       }
    },
	//
    iniciarEventos:function(){
    	
    },
    

    
    loadValoresIniciales: function(){
    	Phx.vista.FormResumenVenta.superclass.loadValoresIniciales.call(this);
    	
    	
    	
    	
    }
    
})    
</script>