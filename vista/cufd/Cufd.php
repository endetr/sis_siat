<?php
/**
*@package pXP
*@file gen-Cufd.php
*@author  (admin)
*@date 22-01-2019 02:23:54
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
*/

header("content-type: text/javascript; charset=UTF-8");

$fechaActual = date(DATE_RFC2822);

?>
<script>
Phx.vista.Cufd=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.Cufd.superclass.constructor.call(this,config);
		this.init();
		
		this.addButton('Generar', {
				grupo : [0,1],
				text : 'Pedir Cufd',
				iconCls : 'bundo',
				disabled : false,
				handler : this.BGenerar,
				tooltip : '<b>Genera CUFD</b><br/>Se comunica con el SIN para solicitar el Código diario'
			});  
		
		this.load({params:{start:0, limit:this.tam_pag}})
			
		
		
	},
			
	Atributos:[
		{
			//configuracion del componente
			config:{
					labelSeparator:'',
					inputType:'hidden',
					name: 'id_cufd'
			},
			type:'Field',
			form:true 
		},
		{
			config: {
				labelSeparator:'',
				inputType:'hidden',
				name: 'id_cuis',
					
			},
			type:'Field',
			form:true 
		},
		{
			config:{
				name: 'codigo',
				fieldLabel: 'Código',
				allowBlank: true,
				anchor: '80%',
				gwidth: 500,
				maxLength:500
			},
				type:'TextField',
				filters:{pfiltro:'cufd.codigo',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'fecha_inicio',
				fieldLabel: 'Fecha Inicio',
				allowBlank: true,
				anchor: '80%',
				gwidth: 150,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'cufd.fecha_inicio',type:'date'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'fecha_fin',
				fieldLabel: 'Fecha Fin',
				allowBlank: true,
				anchor: '80%',
				gwidth: 150,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'cufd.fecha_fin',type:'date'},
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
				filters:{pfiltro:'cufd.estado_reg',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
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
				filters:{pfiltro:'cufd.id_usuario_ai',type:'numeric'},
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
				filters:{pfiltro:'cufd.usuario_ai',type:'string'},
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
				filters:{pfiltro:'cufd.fecha_reg',type:'date'},
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
				filters:{pfiltro:'cufd.fecha_mod',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		}
	],
	tam_pag:50,	
	title:'CUFD',
	ActSave:'../../sis_siat/control/Cufd/insertarCufd',
	ActDel:'../../sis_siat/control/Cufd/eliminarCufd',
	ActList:'../../sis_siat/control/Cufd/listarCufd',
	id_store:'id_cufd',
	fields: [
		{name:'id_cufd', type: 'numeric'},
		{name:'codigo', type: 'string'},
		{name:'fecha_inicio', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'fecha_fin', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'estado_reg', type: 'string'},
		{name:'id_cuis', type: 'numeric'},
		{name:'id_usuario_ai', type: 'numeric'},
		{name:'id_usuario_reg', type: 'numeric'},
		{name:'usuario_ai', type: 'string'},
		{name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'id_usuario_mod', type: 'numeric'},
		{name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'usr_reg', type: 'string'},
		{name:'usr_mod', type: 'string'},
		
	],
	sortInfo:{
		field: 'id_cufd',
		direction: 'DESC'
	},
	bdel:false,
	bsave:false,
	bnew:false,
	bedit:false,
	onReloadPage:function(m)
    {
        this.maestro=m;         
		this.store.baseParams.id_cuis = this.maestro.id_cuis; 
        this.load({params:{start:0, limit:50}});            
    },
    loadValoresIniciales:function()
    {
        Phx.vista.Cufd.superclass.loadValoresIniciales.call(this);        
		this.getComponente('id_cuis').setValue(this.maestro.id_cuis);
		 
    },
    
      BGenerar : function() {
		Phx.CP.loadingShow();
 			Ext.Ajax.request({
				url : '../../sis_siat/control/Cufd/registrarCufd',
				params : {
					estado:'registrar'
					
				},
				success : this.successSave,
				failure : this.conexionFailure,
				timeout : this.timeout,
				scope : this
			    });     	
      	
      	
			
	},
		
		
    	
    
	}
)
</script>
		
		