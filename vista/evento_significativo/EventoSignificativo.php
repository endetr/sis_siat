<?php
/**
*@package pXP
*@file gen-EventoSignificativo.php
*@author  (admin)
*@date 23-01-2019 19:31:54
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
*/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.EventoSignificativo=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.EventoSignificativo.superclass.constructor.call(this,config);
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
					name: 'id_evento_significativo'
			},
			type:'Field',
			form:true 
		},
		
		/**/
		
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
        
		
		/**/
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
				filters:{pfiltro:'evsi.fk_sucursal',type:'numeric'},
				id_grupo:1,
				grid:false,
				form:true
		},
		
		{
			config:{
				name: 'codigo_evento',
				fieldLabel: 'Código Evento',
				allowBlank: false,
				anchor: '80%',
				gwidth: 120,
				maxLength:55
			},
				type:'TextField',
				filters:{pfiltro:'evsi.codigo_evento',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		
		
		
		{
			config:{
				name: 'fecha_ini',
				fieldLabel: 'Fecha Inicio',
				allowBlank: false,
				anchor: '80%',
				gwidth: 150,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'evsi.fecha_ini',type:'date'},
				id_grupo:1,
				grid:true,
				form:true
		},
		
		{
			config:{
				name: 'fecha_fin',
				fieldLabel: 'Fecha Fin',
				allowBlank: false,
				anchor: '80%',
				gwidth: 150,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'evsi.fecha_fin',type:'date'},
				id_grupo:1,
				grid:true,
				form:true
		},
		
		{
			config:{
				name: 'description',
				fieldLabel: 'Descriptión',
				allowBlank: false,
				anchor: '80%',
				gwidth: 180,
				maxLength:200
			},
				type:'TextField',
				filters:{pfiltro:'evsi.description',type:'string'},
				id_grupo:1,
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
				filters:{pfiltro:'evsi.estado_reg',type:'string'},
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
				filters:{pfiltro:'evsi.usuario_ai',type:'string'},
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
				gwidth: 120,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'evsi.fecha_reg',type:'date'},
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
				filters:{pfiltro:'evsi.id_usuario_ai',type:'numeric'},
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
				filters:{pfiltro:'evsi.fecha_mod',type:'date'},
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
	title:'Evento Significativo',
	ActSave:'../../sis_siat/control/EventoSignificativo/insertarEventoSignificativo',
	ActDel:'../../sis_siat/control/EventoSignificativo/eliminarEventoSignificativo',
	ActList:'../../sis_siat/control/EventoSignificativo/listarEventoSignificativo',
	id_store:'id_evento_significativo',
	fields: [
		{name:'id_evento_significativo', type: 'numeric'},
		{name:'fk_sucursal', type: 'numeric'},
		{name:'nombre_sucursal', type: 'string'},
		{name:'description', type: 'string'},
		{name:'estado_reg', type: 'string'},
		{name:'fecha_fin', type: 'date',dateFormat:'Y-m-d H:i:s'},
		{name:'codigo_evento', type: 'string'},
		{name:'fecha_ini', type: 'date',dateFormat:'Y-m-d H:i:s'},
		{name:'usuario_ai', type: 'string'},
		{name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'id_usuario_reg', type: 'numeric'},
		{name:'id_usuario_ai', type: 'numeric'},
		{name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'id_usuario_mod', type: 'numeric'},
		{name:'usr_reg', type: 'string'},
		{name:'usr_mod', type: 'string'},
		
	],
	sortInfo:{
		field: 'id_evento_significativo',
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
		
		