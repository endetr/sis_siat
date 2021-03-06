<?php
/**
*@package pXP
*@file gen-TipoDocumentoSiat.php
*@author  (admin)
*@date 18-01-2019 14:58:05
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
*/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.TipoDocumentoSiat=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.TipoDocumentoSiat.superclass.constructor.call(this,config);
		 this.addButton('obtener_ws', {
            text: 'Obtener Datos WS',
            iconCls: 'bupload',
            disabled: false,
            handler: this.BObtenerWS,
            tooltip: '<b>Obtener Datos</b><br/>Obtener Datos desde el WS del SIN'
        });
	
		this.init();
		this.load({params:{start:0, limit:this.tam_pag}})
	},
			
	Atributos:[
		{
			//configuracion del componente
			config:{
					labelSeparator:'',
					inputType:'hidden',
					name: 'id_tipo_documento'
			},
			type:'Field',
			form:true 
		},
		{
			config:{
				name: 'codigo',
				fieldLabel: 'Código',
				allowBlank: false,
				anchor: '25%',
				gwidth: 100,
				maxLength:10
			},
				type:'NumberField',
				filters:{pfiltro:'docsia.codigo',type:'numeric'},
				id_grupo:1,
				grid:true,
				form:true,
				bottom_filter : true
		},
		{
			config:{
				name: 'descripcion',
				fieldLabel: 'Descripción',
				allowBlank: false,
				anchor: '80%',
				gwidth: 200,
				maxLength:200
			},
				type:'TextArea',
				filters:{pfiltro:'docsia.descripcion',type:'string'},
				id_grupo:1,
				grid:true,
				form:true,
				bottom_filter : true
		},
		 {
			config : {
				name : 'estado_reg',
				fieldLabel : 'Estado Registro',
				typeAhead : true,
				allowBlank : false,
				triggerAction : 'all',
				emptyText : 'Seleccione Opcion...',
				selectOnFocus : true,
				forceSelection: true,
				width : 250,
				mode : 'local',

				store : new Ext.data.ArrayStore({
					fields : ['ID', 'valor'],
					data : [['activo', 'Activo'],['inactivo', 'Inactivo']],

				}),
				renderer : function(value, p, record) {
					var estado_reg = record.data.estado_reg;
					return  record.data.estado_reg;
					if (estado_reg=='activo'){
						return 'Activo';
					}else if (estado_reg=='inactivo'){
						return 'Inactivo';
						
					}
					
				},
				valueField : 'ID',
				displayField : 'valor'

			},
			type : 'ComboBox',
			valorInicial : 'activo',
			filters:{pfiltro:'docsia.estado_reg',type:'string'},
			id_grupo : 0,
			grid : true,
			form : true
		},
		{
			config:{
				name: 'desc_tipo',
				fieldLabel: 'Tipo',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:100
			},
				type:'TextField',
				filters:{pfiltro:'docsia.tipo',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		}
		,
		{
			config : {
				name : 'tipo',
				fieldLabel : 'Tipo',  
				typeAhead : true,
				allowBlank : false,
				triggerAction : 'all',
				selectOnFocus : true,
				forceSelection: true,
				mode : 'local',
				minChars: 2,
				store : new Ext.data.ArrayStore({
					fields : ['ID', 'valor'],
					data : [['1', 'Documentos Fiscales'], ['2', 'Documentos Identidad'], ['3', 'Documentos Sector']]
				}),
				renderer : function(value, p, record) {
					var tipo = record.data.tipo;
					return  record.data.tipo;
					if (tipo=='1'){
						return 'Documentos Fiscales';
					}else if (tipo=='2'){
						return 'Documentos Identidad';
					}else{
				        return 'Documentos Sector';
						
					}
					
					//return String.format('{0}', record.data['desc_clasificador']);
				},
				valueField : 'ID',
				displayField : 'valor',
				width : 200

			},
			type : 'ComboBox',
			valorInicial : 'Documentos Fiscales',
			filters : {
				pfiltro : 'docsia.tipo',
				type : 'string'	
			},
			default:'Documentos Fiscales',
			grid : false,
			form : true
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
				filters:{pfiltro:'docsia.fecha_reg',type:'date'},
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
				filters:{pfiltro:'docsia.id_usuario_ai',type:'numeric'},
				id_grupo:1,
				grid:false,
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
				name: 'usuario_ai',
				fieldLabel: 'Funcionaro AI',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:300
			},
				type:'TextField',
				filters:{pfiltro:'docsia.usuario_ai',type:'string'},
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
				filters:{pfiltro:'docsia.fecha_mod',type:'date'},
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
		}
	],
	tam_pag:50,	
	title:'Tipo Documento SIAT',
	ActSave:'../../sis_siat/control/TipoDocumentoSiat/insertarTipoDocumentoSiat',
	ActDel:'../../sis_siat/control/TipoDocumentoSiat/eliminarTipoDocumentoSiat',
	ActList:'../../sis_siat/control/TipoDocumentoSiat/listarTipoDocumentoSiat',
	id_store:'id_tipo_documento',
	fields: [
		{name:'id_tipo_documento', type: 'numeric'},
		{name:'codigo', type: 'numeric'},
		{name:'descripcion', type: 'string'},
		{name:'estado_reg', type: 'string'},
		{name:'tipo', type: 'string'},
		{name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'id_usuario_ai', type: 'numeric'},
		{name:'id_usuario_reg', type: 'numeric'},
		{name:'usuario_ai', type: 'string'},
		{name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'id_usuario_mod', type: 'numeric'},
		{name:'usr_reg', type: 'string'},
		{name:'usr_mod', type: 'string'},
		{name:'desc_tipo', type: 'string'}
		
	],
	sortInfo:{
		field: 'id_tipo_documento',
		direction: 'ASC'
	},
	bdel:false,
	bsave:false,
	bnew:false,
	onButtonNew: function () {
            
             this.ocultarComponente(this.Cmp.estado_reg);
             Phx.vista.TipoDocumentoSiat.superclass.onButtonNew.call(this);
            },
    onButtonEdit: function () {
            
             this.mostrarComponente(this.Cmp.estado_reg);
             Phx.vista.TipoDocumentoSiat.superclass.onButtonEdit.call(this);
            }
	,
    BObtenerWS:function () {
			var rec = this.sm.getSelected();
			Phx.CP.loadingShow();
			Ext.Ajax.request({
				url: '../../sis_siat/control/TipoDocumentoSiat/insertarTipoDocumentoSiatWS',
				params: {
					estado: 'recibido'
				},
				success: this.successDerivar,
				failure: this.conexionFailure,
				timeout: this.timeout,
				scope: this
			});
	
		},
		

		successDerivar : function(resp) {

			Phx.CP.loadingHide();
			var reg = Ext.util.JSON.decode(Ext.util.Format.trim(resp.responseText));
			if (!reg.ROOT.error) {
				alert(reg.ROOT.detalle.mensaje)

			}
			this.reload();

		}
		
	}
)
</script>
		
		