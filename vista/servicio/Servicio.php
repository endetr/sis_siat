<?php
/**
*@package pXP
*@file gen-Servicio.php
*@author  (admin)
*@date 17-01-2019 21:55:55
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
*/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.Servicio=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.Servicio.superclass.constructor.call(this,config);
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
					name: 'id_servicio'
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
				filters:{pfiltro:'sersia.codigo',type:'numeric'},
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
				gwidth: 300,
				maxLength:200
			},
				type:'TextArea',
				filters:{pfiltro:'sersia.descripcion',type:'string'},
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
			filters:{pfiltro:'sersia.estado_reg',type:'string'},
			id_grupo : 0,
			grid : true,
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
				filters:{pfiltro:'sersia.fecha_reg',type:'date'},
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
				filters:{pfiltro:'sersia.usuario_ai',type:'string'},
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
				filters:{pfiltro:'sersia.id_usuario_ai',type:'numeric'},
				id_grupo:1,
				grid:false,
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
				filters:{pfiltro:'sersia.fecha_mod',type:'date'},
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
	title:'Servicio SIAT',
	ActSave:'../../sis_siat/control/Servicio/insertarServicio',
	ActDel:'../../sis_siat/control/Servicio/eliminarServicio',
	ActList:'../../sis_siat/control/Servicio/listarServicio',
	id_store:'id_servicio',
	fields: [
		{name:'id_servicio', type: 'numeric'},
		{name:'codigo', type: 'numeric'},
		{name:'descripcion', type: 'string'},
		{name:'estado_reg', type: 'string'},
		{name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'usuario_ai', type: 'string'},
		{name:'id_usuario_reg', type: 'numeric'},
		{name:'id_usuario_ai', type: 'numeric'},
		{name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'id_usuario_mod', type: 'numeric'},
		{name:'usr_reg', type: 'string'},
		{name:'usr_mod', type: 'string'},
		
	],
	sortInfo:{
		field: 'id_servicio',
		direction: 'ASC'
	},
	bdel:false,
	bsave:false,
	bnew:false,
    onButtonNew: function () {
            
             this.ocultarComponente(this.Cmp.estado_reg);
             Phx.vista.Servicio.superclass.onButtonNew.call(this);
            },
    onButtonEdit: function () {
            
             this.mostrarComponente(this.Cmp.estado_reg);
             Phx.vista.Servicio.superclass.onButtonEdit.call(this);
            }
	,
    BObtenerWS:function () {
			var rec = this.sm.getSelected();
			Phx.CP.loadingShow();
			Ext.Ajax.request({
				url: '../../sis_siat/control/Servicio/insertarServicioWS',
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
		
		