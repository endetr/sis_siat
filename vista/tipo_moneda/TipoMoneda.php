<?php
/**
*@package pXP
*@file gen-TipoMoneda.php
*@author  (admin)
*@date 18-01-2019 13:59:47
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
*/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.TipoMoneda=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.TipoMoneda.superclass.constructor.call(this,config);
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
					name: 'id_tipo_moneda'
			},
			type:'Field',
			form:true 
		},
		{
			config:{
				name: 'codigo',
				fieldLabel: 'codigo',
				allowBlank: false,
				anchor: '25%',
				gwidth: 100,
				maxLength:10
			},
				type:'NumberField',
				filters:{pfiltro:'monsia.codigo',type:'numeric'},
				id_grupo:1,
				grid:true,
				form:true,
				bottom_filter : true
		},
		{
			config:{
				name: 'descripcion',
				fieldLabel: 'descripcion',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:200
			},
				type:'TextArea',
				filters:{pfiltro:'monsia.descripcion',type:'string'},
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
			filters:{pfiltro:'monsia.estado_reg',type:'string'},
			id_grupo : 0,
			grid : true,
			form : true
		},
	    {
			config:{
				name: 'id_usuario_ai',
				fieldLabel: '',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'monsia.id_usuario_ai',type:'numeric'},
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
				filters:{pfiltro:'monsia.usuario_ai',type:'string'},
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
				filters:{pfiltro:'monsia.fecha_reg',type:'date'},
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
				filters:{pfiltro:'monsia.fecha_mod',type:'date'},
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
	title:'Tipo Moneda SIAT',
	ActSave:'../../sis_siat/control/TipoMoneda/insertarTipoMoneda',
	ActDel:'../../sis_siat/control/TipoMoneda/eliminarTipoMoneda',
	ActList:'../../sis_siat/control/TipoMoneda/listarTipoMoneda',
	id_store:'id_tipo_moneda',
	fields: [
		{name:'id_tipo_moneda', type: 'numeric'},
		{name:'codigo', type: 'numeric'},
		{name:'descripcion', type: 'string'},
		{name:'estado_reg', type: 'string'},
		{name:'id_usuario_ai', type: 'numeric'},
		{name:'id_usuario_reg', type: 'numeric'},
		{name:'usuario_ai', type: 'string'},
		{name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'id_usuario_mod', type: 'numeric'},
		{name:'usr_reg', type: 'string'},
		{name:'usr_mod', type: 'string'},
		
	],
	sortInfo:{
		field: 'id_tipo_moneda',
		direction: 'ASC'
	},
	bdel:false,
	bsave:false,
	bnew:false,
	onButtonNew: function () {
            
             this.ocultarComponente(this.Cmp.estado_reg);
             Phx.vista.TipoMoneda.superclass.onButtonNew.call(this);
            },
    onButtonEdit: function () {
            
             this.mostrarComponente(this.Cmp.estado_reg);
             Phx.vista.TipoMoneda.superclass.onButtonEdit.call(this);
            }
	,//1
    BObtenerWS:function () {
			var rec = this.sm.getSelected();
			Phx.CP.loadingShow();
			Ext.Ajax.request({
				url: '../../sis_siat/control/TipoMoneda/insertarTipoMonedaWS',
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
		
})
</script>
		
		