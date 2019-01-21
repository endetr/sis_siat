CREATE OR REPLACE FUNCTION "siat"."ft_mensaje_soap_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_mensaje_soap_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tmensaje_soap'
 AUTOR: 		 (admin)
 FECHA:	        18-01-2019 14:58:00
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				18-01-2019 14:58:00								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tmensaje_soap'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_mensaje_soap	integer;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_mensaje_soap_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_MESSIA_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		admin	
 	#FECHA:		18-01-2019 14:58:00
	***********************************/

	if(p_transaccion='SIA_MESSIA_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into siat.tmensaje_soap(
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
							
			
			
			)RETURNING id_mensaje_soap into v_id_mensaje_soap;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Mensaje SOAP SIAT almacenado(a) con exito (id_mensaje_soap'||v_id_mensaje_soap||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_mensaje_soap',v_id_mensaje_soap::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_MESSIA_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		admin	
 	#FECHA:		18-01-2019 14:58:00
	***********************************/

	elsif(p_transaccion='SIA_MESSIA_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.tmensaje_soap set
			codigo = v_parametros.codigo,
			descripcion = v_parametros.descripcion,
			fecha_mod = now(),
			id_usuario_mod = p_id_usuario,
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_mensaje_soap=v_parametros.id_mensaje_soap;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Mensaje SOAP SIAT modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_mensaje_soap',v_parametros.id_mensaje_soap::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_MESSIA_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		admin	
 	#FECHA:		18-01-2019 14:58:00
	***********************************/

	elsif(p_transaccion='SIA_MESSIA_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.tmensaje_soap
            where id_mensaje_soap=v_parametros.id_mensaje_soap;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Mensaje SOAP SIAT eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_mensaje_soap',v_parametros.id_mensaje_soap::varchar);
              
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
ALTER FUNCTION "siat"."ft_mensaje_soap_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
