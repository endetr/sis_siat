CREATE OR REPLACE FUNCTION "siat"."ft_modalidad_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_modalidad_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tmodalidad'
 AUTOR: 		 (admin)
 FECHA:	        18-01-2019 14:57:53
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				18-01-2019 14:57:53								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tmodalidad'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_modalidad	integer;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_modalidad_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_MODSIA_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		admin	
 	#FECHA:		18-01-2019 14:57:53
	***********************************/

	if(p_transaccion='SIA_MODSIA_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into siat.tmodalidad(
			codigo,
			descripcion,
			estado_reg,
			fecha_reg,
			id_usuario_ai,
			id_usuario_reg,
			usuario_ai,
			fecha_mod,
			id_usuario_mod
          	) values(
			v_parametros.codigo,
			v_parametros.descripcion,
			'activo',
			now(),
			v_parametros._id_usuario_ai,
			p_id_usuario,
			v_parametros._nombre_usuario_ai,
			null,
			null
							
			
			
			)RETURNING id_modalidad into v_id_modalidad;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Modelo SIAT almacenado(a) con exito (id_modalidad'||v_id_modalidad||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_modalidad',v_id_modalidad::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_MODSIA_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		admin	
 	#FECHA:		18-01-2019 14:57:53
	***********************************/

	elsif(p_transaccion='SIA_MODSIA_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.tmodalidad set
			codigo = v_parametros.codigo,
			descripcion = v_parametros.descripcion,
			fecha_mod = now(),
			id_usuario_mod = p_id_usuario,
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_modalidad=v_parametros.id_modalidad;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Modelo SIAT modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_modalidad',v_parametros.id_modalidad::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_MODSIA_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		admin	
 	#FECHA:		18-01-2019 14:57:53
	***********************************/

	elsif(p_transaccion='SIA_MODSIA_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.tmodalidad
            where id_modalidad=v_parametros.id_modalidad;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Modelo SIAT eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_modalidad',v_parametros.id_modalidad::varchar);
              
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
$BODY$
LANGUAGE 'plpgsql' VOLATILE
COST 100;
ALTER FUNCTION "siat"."ft_modalidad_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
