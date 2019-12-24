<?php
/**
*@package pXP
*@file gen-DireccionServicio.php
*@author  (jrivera)
*@date 16-12-2019 11:32:48
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				16-12-2019				 (jrivera)				CREACION	

*/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.DireccionServicio=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.DireccionServicio.superclass.constructor.call(this,config);
		this.init();
		this.load({params:{start:0, limit:this.tam_pag}})
	},
			
	Atributos:[
		{
			//configuracion del componente
			config:{
					labelSeparator:'',
					inputType:'hidden',
					name: 'id_direccion_servicio'
			},
			type:'Field',
			form:true 
		},

		{
            config:{
                name: 'tipo',
                fieldLabel: 'Tipo',
                allowBlank: false,
                anchor: '80%',
                gwidth: 130,
                maxLength:100,
                emptyText:'tipo...',                   
                typeAhead: true,
                triggerAction: 'all',
                lazyRender:true,
                mode: 'local',                                  
               // displayField: 'descestilo',
                store:['documento','paquete','masivo','sincronizacion','cufd','eventos','operaciones']
            },
            type:'ComboBox', 
            grid:true,
            form:true
        },	
		{
            config:{
                name: 'subtipo',
                fieldLabel: 'Subtipo',
                allowBlank: true,
                anchor: '80%',
                gwidth: 130,
                maxLength:100,
                emptyText:'subtipo...',                   
                typeAhead: true,
                triggerAction: 'all',
                lazyRender:true,
                mode: 'local',                                  
               // displayField: 'descestilo',
                store:['leyenda','mensajes_servicios','eventos_significativos','motivos_anulacion','pais','tipo_ambiente','tipo_componente','tipo_departamento','tipo_documento_fiscal',
						'tipo_documento_sector','tipo_emision','tipo_metodo_pago','tipo_modalidad','tipo_moneda','unidad_medida','fecha_hora','cuis','cufd','punto_venta','tipo_documento_identidad','producto','evento_significativo_inicio','evento_significativo_fin']
            },
            type:'ComboBox', 
            grid:true,
            form:true
        },
		
		{
			config: {
				name: 'id_documento_sector',
				fieldLabel: 'Documento Sector',
				allowBlank: true,
				emptyText: 'Elija una opción...',
				store: new Ext.data.JsonStore({
					url: '../../sis_siat/control/DocumentoSector/listarDocumentoSector',
					id: 'id_documento_sector',
					root: 'datos',
					sortInfo: {
						field: 'descripcion',
						direction: 'ASC'
					},
					totalProperty: 'total',
					fields: ['id_documento_sector', 'codigo', 'descripcion'],
					remoteSort: true,
					baseParams: {par_filtro: 'DOCSEC.codigo#DOCSEC.descripcion'}
				}),
				valueField: 'id_documento_sector',
				displayField: 'descripcion',
				gdisplayField: 'desc_documento_sector',
				hiddenName: 'id_documento_sector',
				forceSelection: true,
				typeAhead: false,
				triggerAction: 'all',
				lazyRender: true,
				mode: 'remote',
				pageSize: 15,
				queryDelay: 1000,
				anchor: '100%',
				gwidth: 150,
				minChars: 2,
				renderer : function(value, p, record) {
					return String.format('{0}', record.data['desc_documento_sector']);
				}
			},
			type: 'ComboBox',
			id_grupo: 0,
			filters: {pfiltro: 'DOCSEC.descripcion',type: 'string'},
			grid: true,
			form: true
		},
		{
			config: {
				name: 'id_documento_fiscal',
				fieldLabel: 'Documento Fiscal',
				allowBlank: true,
				emptyText: 'Elija una opción...',
				store: new Ext.data.JsonStore({
					url: '../../sis_siat/control/DocumentoFiscal/listarDocumentoFiscal',
					id: 'id_documento_fiscal',
					root: 'datos',
					sortInfo: {
						field: 'descripcion',
						direction: 'ASC'
					},
					totalProperty: 'total',
					fields: ['id_documento_fiscal', 'codigo', 'descripcion'],
					remoteSort: true,
					baseParams: {par_filtro: 'DOCFIS.codigo#DOCFIS.descripcion'}
				}),
				valueField: 'id_documento_fiscal',
				displayField: 'descripcion',
				gdisplayField: 'desc_documento_fiscal',
				hiddenName: 'id_documento_fiscal',
				forceSelection: true,
				typeAhead: false,
				triggerAction: 'all',
				lazyRender: true,
				mode: 'remote',
				pageSize: 15,
				queryDelay: 1000,
				anchor: '100%',
				gwidth: 150,
				minChars: 2,
				renderer : function(value, p, record) {
					return String.format('{0}', record.data['desc_documento_fiscal']);
				}
			},
			type: 'ComboBox',
			id_grupo: 0,
			filters: {pfiltro: 'DOCFIS.descripcion',type: 'string'},
			grid: true,
			form: true
		},

		{
			config:{
				name: 'url',
				fieldLabel: 'url',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:200
			},
				type:'TextField',
				filters:{pfiltro:'dirser.url',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},

		{
			config:{
				name: 'recepcion',
				fieldLabel: 'Recepcion',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:50
			},
				type:'TextField',
				filters:{pfiltro:'dirser.recepcion',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'validacion',
				fieldLabel: 'Validacion',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:50
			},
				type:'TextField',
				filters:{pfiltro:'dirser.validacion',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},	
		{
			config:{
				name: 'recepcion_anulacion',
				fieldLabel: 'Recepcion Anulacion',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:50
			},
				type:'TextField',
				filters:{pfiltro:'dirser.recepcion_anulacion',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},	
		
		{
			config:{
				name: 'validacion_anulacion',
				fieldLabel: 'Validacion Anulacion',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:50
			},
				type:'TextField',
				filters:{pfiltro:'dirser.validacion_anulacion',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		
		
		
		
		{
			config:{
				name: 'usuario_ai',
				fieldLabel: 'Funcionaro AI',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:300
			},
				type:'TextField',
				filters:{pfiltro:'dirser.usuario_ai',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'estado_reg',
				fieldLabel: 'Estado Reg.',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:10
			},
				type:'TextField',
				filters:{pfiltro:'dirser.estado_reg',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'fecha_reg',
				fieldLabel: 'Fecha creación',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'dirser.fecha_reg',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'usr_reg',
				fieldLabel: 'Creado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'usu1.cuenta',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'id_usuario_ai',
				fieldLabel: 'Creado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'dirser.id_usuario_ai',type:'numeric'},
				id_grupo:1,
				grid:false,
				form:false
		},
		{
			config:{
				name: 'usr_mod',
				fieldLabel: 'Modificado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'usu2.cuenta',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'fecha_mod',
				fieldLabel: 'Fecha Modif.',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'dirser.fecha_mod',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		}
	],
	tam_pag:50,	
	title:'Direccion Servicio',
	ActSave:'../../sis_siat/control/DireccionServicio/insertarDireccionServicio',
	ActDel:'../../sis_siat/control/DireccionServicio/eliminarDireccionServicio',
	ActList:'../../sis_siat/control/DireccionServicio/listarDireccionServicio',
	id_store:'id_direccion_servicio',
	fields: [
		{name:'id_direccion_servicio', type: 'numeric'},
		{name:'estado_reg', type: 'string'},
		{name:'id_documento_sector', type: 'numeric'},
		{name:'validacion', type: 'string'},
		{name:'id_documento_fiscal', type: 'numeric'},
		{name:'subtipo', type: 'string'},
		{name:'validacion_anulacion', type: 'string'},
		{name:'url', type: 'string'},
		{name:'tipo', type: 'string'},
		{name:'recepcion', type: 'string'},
		{name:'recepcion_anulacion', type: 'string'},
		{name:'usuario_ai', type: 'string'},
		{name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'id_usuario_reg', type: 'numeric'},
		{name:'id_usuario_ai', type: 'numeric'},
		{name:'id_usuario_mod', type: 'numeric'},
		{name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'usr_reg', type: 'string'},
		{name:'usr_mod', type: 'string'},
		{name:'desc_documento_fiscal', type: 'string'},
		{name:'desc_documento_sector', type: 'string'},
		
	],
	sortInfo:{
		field: 'id_direccion_servicio',
		direction: 'ASC'
	},
	bdel:true,
	bsave:true
	}
)
</script>
		
		