<?php
/**
*@package pXP
*@file gen-SaludSistema.php
*@author  (admin)
*@date 24-01-2019 19:34:45
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
*/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.SaludSistema=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
						
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
    	Phx.vista.SaludSistema.superclass.constructor.call(this,config);
		//Phx.vista.SaludSistema.superclass.constructor.call(this,config);
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
					name: 'id_salud_sistema'
			},
			type:'Field',
			form:true 
		},
		{
			config:{
				name: 'estado_reg',
				fieldLabel: 'Estado Reg.',
				allowBlank: true,
				anchor: '80%',
				gwidth: 150,
				maxLength:10
			},
				type:'TextField',
				filters:{pfiltro:'evsa.estado_reg',type:'string'},
				id_grupo:1,
				grid:false,
				form:false
		},
		
		{
            config:{
                name: 'nombre_sucursal',
                fieldLabel: 'Sucursal',              
                gwidth: 150
            },
                type:'TextField',
                filters: { pfiltro: 'suc.nombre', type: 'string'},      
                grid: true,
                form: true,
                bottom_filter: false
        },
        
		
		{
			config:{
				name: 'codigo_evento',
				fieldLabel: 'Código Evento',
				allowBlank: false,
				anchor: '80%',
				gwidth: 150,
				maxLength:55
			},
				type:'TextField',
				filters:{pfiltro:'evsa.codigo_evento',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'description_salud',
				fieldLabel: 'Descripción',
				allowBlank: false,
				anchor: '80%',
				gwidth: 150,
				maxLength:200
			},
				type:'TextField',
				filters:{pfiltro:'evsa.description_salud',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'fecha_salud',
				fieldLabel: 'Fecha',
				allowBlank: false,
				anchor: '80%',
				gwidth: 150,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'evsa.fecha_salud',type:'date'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'fk_sucursal',
				fieldLabel: 'fk_sucursal',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'NumberField',
				filters:{pfiltro:'evsa.fk_sucursal',type:'numeric'},
				id_grupo:1,
				grid:false,
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
				filters:{pfiltro:'evsa.usuario_ai',type:'string'},
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
				gwidth: 150,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'evsa.fecha_reg',type:'date'},
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
				gwidth: 150,
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
				filters:{pfiltro:'evsa.id_usuario_ai',type:'numeric'},
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
				gwidth: 150,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'evsa.fecha_mod',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		}
	],
	tam_pag:50,	
	title:'Salud del Sistema',
	ActSave:'../../sis_siat/control/SaludSistema/insertarSaludSistema',
	ActDel:'../../sis_siat/control/SaludSistema/eliminarSaludSistema',
	ActList:'../../sis_siat/control/SaludSistema/listarSaludSistema',
	id_store:'id_salud_sistema',
	fields: [
		{name:'id_salud_sistema', type: 'numeric'},
		{name:'estado_reg', type: 'string'},
		{name:'codigo_evento', type: 'string'},
		{name:'description_salud', type: 'string'},
		{name:'fecha_salud', type: 'date',dateFormat:'Y-m-d H:i:s'},
		{name:'fk_sucursal', type: 'numeric'},
		{name:'nombre_sucursal', type: 'string'},
		{name:'usuario_ai', type: 'string'},
		{name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s'},
		{name:'id_usuario_reg', type: 'numeric'},
		{name:'id_usuario_ai', type: 'numeric'},
		{name:'id_usuario_mod', type: 'numeric'},
		{name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s'},
		{name:'usr_reg', type: 'string'},
		{name:'usr_mod', type: 'string'},
		
	],
	sortInfo:{
		field: 'id_salud_sistema',
		direction: 'ASC'
	},
	//bdel:true,
	//bsave:true
	
	bdel:false,
	bsave:false,
	bedit:false,
	bnew:false,
	}
)
</script>
		
		