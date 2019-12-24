CREATE OR REPLACE FUNCTION siat.ft_tipo_moneda_ime (
  p_administrador integer,
  p_id_usuario integer,
  p_tabla varchar,
  p_transaccion varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_tipo_moneda_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.ttipo_moneda'
 AUTOR: 		 (admin)
 FECHA:	        18-01-2019 13:59:47
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				18-01-2019 13:59:47								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.ttipo_moneda'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_tipo_moneda	integer;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_tipo_moneda_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_MONSIA_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		admin	
 	#FECHA:		18-01-2019 13:59:47
	***********************************/

	if(p_transaccion='SIA_MONSIA_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into siat.ttipo_moneda(
			codigo,
			descripcion,
			estado_reg,
			id_usuario_ai,
			id_usuario_reg,
			usuario_ai,
			fecha_reg,
			fecha_mod,
			id_usuario_mod
          	) values(
			v_parametros.codigo,
			v_parametros.descripcion,
			'activo',
			v_parametros._id_usuario_ai,
			p_id_usuario,
			v_parametros._nombre_usuario_ai,
			now(),
			null,
			null
							
			
			
			)
            ON CONFLICT ON CONSTRAINT ttipo_moneda_codigo_key 
			DO UPDATE SET codigo = v_parametros.codigo,
			descripcion = v_parametros.descripcion,
			fecha_mod = now(),
			id_usuario_mod = p_id_usuario,
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			RETURNING id_tipo_moneda into v_id_tipo_moneda;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Tipo Moneda SIAT almacenado(a) con exito (id_tipo_moneda'||v_id_tipo_moneda||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_tipo_moneda',v_id_tipo_moneda::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_MONSIA_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		admin	
 	#FECHA:		18-01-2019 13:59:47
	***********************************/

	elsif(p_transaccion='SIA_MONSIA_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.ttipo_moneda set
			codigo_pxp = v_parametros.codigo_pxp,			
			fecha_mod = now(),
			id_usuario_mod = p_id_usuario
			
			where id_tipo_moneda=v_parametros.id_tipo_moneda;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Tipo Moneda SIAT modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_tipo_moneda',v_parametros.id_tipo_moneda::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_MONSIA_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		admin	
 	#FECHA:		18-01-2019 13:59:47
	***********************************/

	elsif(p_transaccion='SIA_MONSIA_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.ttipo_moneda
            where id_tipo_moneda=v_parametros.id_tipo_moneda;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Tipo Moneda SIAT eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_tipo_moneda',v_parametros.id_tipo_moneda::varchar);
              
            --Devuelve la respuesta
            return v_resp;

		end;
         
	else
     
    	raise exception 'Transaccion inexistente: %',p_transaccion;

	end if;

EXCEPTION
				
	WHEN OTHERS THEN
		v_resp='';
		v_resp = pxp.f_agrega_clave(v_resp,'mensaje',SQLERRM);
		v_resp = pxp.f_agrega_clave(v_resp,'codigo_error',SQLSTATE);
		v_resp = pxp.f_agrega_clave(v_resp,'procedimientos',v_nombre_funcion);
		raise exception '%',v_resp;
				        
END;
$body$
LANGUAGE 'plpgsql'
VOLATILE
CALLED ON NULL INPUT
SECURITY INVOKER
COST 100;

ALTER FUNCTION siat.ft_tipo_moneda_ime (p_administrador integer, p_id_usuario integer, p_tabla varchar, p_transaccion varchar)
  OWNER TO postgres;