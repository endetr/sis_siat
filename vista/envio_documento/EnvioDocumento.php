<?php
/**
*@package pXP
*@file gen-EnvioDocumento.php
*@author  (admin)
*@date 31-01-2019 13:06:14
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
*/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.EnvioDocumento=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.EnvioDocumento.superclass.constructor.call(this,config);
		this.init();
		//this.load({params:{start:0, limit:this.tam_pag}})
	},
	onReloadPage:function(p){
		this.store.baseParams=p;
		//cargar datos pasando como parametros
		this.load({params:{start:0, limit:this.tam_pag}})
	},
			
			
	Atributos:[
		{
			//configuracion del componente
			config:{
					labelSeparator:'',
					inputType:'hidden',
					name: 'id_envio_documento'
			},
			type:'Field',
			form:true 
		},
		
		
		{
			config:{
				name: 'fecha_emision',
				fieldLabel: 'Fecha Emisión',
				allowBlank: false,
				anchor: '80%',
				gwidth: 150,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'endocf.fecha_emision',type:'date'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'nro_documento',
				fieldLabel: 'Nro. Documento',
				allowBlank: false,
				anchor: '80%',
				gwidth: 150,
				maxLength:4
			},
				type:'NumberField',
				filters:{pfiltro:'endocf.nro_documento',type:'numeric'},
				id_grupo:1,
				grid:true,
				form:true
		},
		
		{
			config:{
				name: 'cuf',
				fieldLabel: 'Cuf',
				allowBlank: false,
				inputType:'hidden',
				anchor: '80%',
				gwidth: 150,
				maxLength:50
			},
				type:'TextField',
				filters:{pfiltro:'endocf.cuf',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'modo_envio',
				fieldLabel: 'Modo de Envio',
				allowBlank: false,
				anchor: '80%',
				gwidth: 150,
				maxLength:75
			},
				type:'TextField',
				filters:{pfiltro:'endocf.modo_envio',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		
		{
			config:{
				name: 'monto',
				fieldLabel: 'Monto',
				allowBlank: false,
				anchor: '80%',
				gwidth: 150,
				maxLength:-5
			},
				type:'NumberField',
				filters:{pfiltro:'endocf.monto',type:'numeric'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'estado',
				fieldLabel: 'Estado',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:20
			},
				type:'TextField',
				filters:{pfiltro:'endocf.estado',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
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
				filters:{pfiltro:'endocf.id_usuario_ai',type:'numeric'},
				id_grupo:1,
				grid:false,
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
				filters:{pfiltro:'endocf.fecha_reg',type:'date'},
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
				filters:{pfiltro:'endocf.usuario_ai',type:'string'},
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
				filters:{pfiltro:'endocf.fecha_mod',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		}
	],
	tam_pag:50,	
	title:'Envio de Documentos Fiscales',
	ActSave:'../../sis_siat/control/EnvioDocumento/insertarEnvioDocumento',
	ActDel:'../../sis_siat/control/EnvioDocumento/eliminarEnvioDocumento',
	ActList:'../../sis_siat/control/EnvioDocumento/listarEnvioDocumento',
	id_store:'id_envio_documento',
	fields: [
		{name:'id_envio_documento', type: 'numeric'},
		{name:'nro_documento', type: 'numeric'},
		{name:'fecha_emision', type: 'date',dateFormat:'Y-m-d H:i:s'},
		{name:'cuf', type: 'string'},
		{name:'estado_reg', type: 'string'},
		{name:'monto', type: 'numeric'},
		{name:'estado', type: 'string'},
		{name:'modo_envio', type: 'string'},
		{name:'id_usuario_ai', type: 'numeric'},
		{name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s'},
		{name:'usuario_ai', type: 'string'},
		{name:'id_usuario_reg', type: 'numeric'},
		{name:'id_usuario_mod', type: 'numeric'},
		{name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'usr_reg', type: 'string'},
		{name:'usr_mod', type: 'string'},
		
	],
	sortInfo:{
		field: 'id_envio_documento',
		direction: 'ASC'
	},
	bdel:false,
	bsave:false,
	bedit:false,
	bnew:false,
	}
)
</script>
		
		