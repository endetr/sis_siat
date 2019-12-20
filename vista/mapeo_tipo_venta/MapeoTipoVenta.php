<?php
/**
*@package pXP
*@file gen-MapeoTipoVenta.php
*@author  (jrivera)
*@date 17-12-2019 02:51:47
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				17-12-2019				 (jrivera)				CREACION	

*/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.MapeoTipoVenta=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.MapeoTipoVenta.superclass.constructor.call(this,config);
		this.init();
		this.load({params:{start:0, limit:this.tam_pag}})
	},
			
	Atributos:[
		{
			//configuracion del componente
			config:{
					labelSeparator:'',
					inputType:'hidden',
					name: 'id_mapeo_tipo_venta'
			},
			type:'Field',
			form:true 
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
            config:{
                name:'id_tipo_venta',
                fieldLabel:'Tipo Venta',
                allowBlank:true,
                emptyText:'Tipo...',
                store: new Ext.data.JsonStore({
                    url: '../../sis_ventas_facturacion/control/TipoVenta/listarTipoVenta',
                    id: 'id_tipo_venta',
                    root: 'datos',
                    sortInfo:{
                        field: 'codigo',
                        direction: 'ASC'
                    },
                    totalProperty: 'total',
                    fields: ['id_tipo_venta','codigo','nombre'],
                    // turn on remote sorting
                    remoteSort: true,
                    baseParams:{par_filtro:'codigo#nombre'}

                }),
                valueField: 'id_tipo_venta',
				hiddenName: 'id_tipo_venta',
                displayField: 'nombre',
                gdisplayField: 'desc_tipo_venta',
                forceSelection:true,
                typeAhead: false,
                triggerAction: 'all',
                lazyRender:true,
                mode:'remote',
                pageSize:10,
                queryDelay:1000,
                width:250,
                minChars:2,
                renderer:function(value, p, record){return String.format('{0}', record.data['desc_tipo_venta']);}

            },
            type:'ComboBox',
            id_grupo:0,
			filters: {pfiltro: 'tipve.nombre',type: 'string'},
            grid:true,
            form:true
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
				filters:{pfiltro:'matv.estado_reg',type:'string'},
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
				name: 'fecha_reg',
				fieldLabel: 'Fecha creación',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'matv.fecha_reg',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'id_usuario_ai',
				fieldLabel: 'Fecha creación',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'matv.id_usuario_ai',type:'numeric'},
				id_grupo:1,
				grid:false,
				form:false
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
				filters:{pfiltro:'matv.usuario_ai',type:'string'},
				id_grupo:1,
				grid:true,
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
				filters:{pfiltro:'matv.fecha_mod',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		}
	],
	tam_pag:50,	
	title:'Mapeo Tipo Venta',
	ActSave:'../../sis_siat/control/MapeoTipoVenta/insertarMapeoTipoVenta',
	ActDel:'../../sis_siat/control/MapeoTipoVenta/eliminarMapeoTipoVenta',
	ActList:'../../sis_siat/control/MapeoTipoVenta/listarMapeoTipoVenta',
	id_store:'id_mapeo_tipo_venta',
	fields: [
		{name:'id_mapeo_tipo_venta', type: 'numeric'},
		{name:'estado_reg', type: 'string'},
		{name:'id_documento_fiscal', type: 'numeric'},
		{name:'id_documento_sector', type: 'numeric'},
		{name:'id_tipo_venta', type: 'numeric'},
		{name:'id_usuario_reg', type: 'numeric'},
		{name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'id_usuario_ai', type: 'numeric'},
		{name:'usuario_ai', type: 'string'},
		{name:'id_usuario_mod', type: 'numeric'},
		{name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'usr_reg', type: 'string'},
		{name:'usr_mod', type: 'string'},
		{name:'desc_documento_fiscal', type: 'string'},
		{name:'desc_documento_sector', type: 'string'},
		{name:'desc_tipo_venta', type: 'string'},
		
	],
	sortInfo:{
		field: 'id_mapeo_tipo_venta',
		direction: 'ASC'
	},
	bdel:true,
	bsave:true
	}
)
</script>
		
		