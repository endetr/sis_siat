CREATE OR REPLACE FUNCTION "siat"."ft_evento_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_evento_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tevento'
 AUTOR: 		 (admin)
 FECHA:	        17-01-2019 22:19:07
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				17-01-2019 22:19:07								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tevento'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_evento	integer;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_evento_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_EVESIA_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		admin	
 	#FECHA:		17-01-2019 22:19:07
	***********************************/

	if(p_transaccion='SIA_EVESIA_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into siat.tevento(
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
							
			
			
			)RETURNING id_evento into v_id_evento;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Evento almacenado(a) con exito (id_evento'||v_id_evento||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_evento',v_id_evento::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_EVESIA_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		admin	
 	#FECHA:		17-01-2019 22:19:07
	***********************************/

	elsif(p_transaccion='SIA_EVESIA_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.tevento set
			codigo = v_parametros.codigo,
			descripcion = v_parametros.descripcion,
			fecha_mod = now(),
			id_usuario_mod = p_id_usuario,
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_evento=v_parametros.id_evento;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Evento modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_evento',v_parametros.id_evento::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_EVESIA_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		admin	
 	#FECHA:		17-01-2019 22:19:07
	***********************************/

	elsif(p_transaccion='SIA_EVESIA_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.tevento
            where id_evento=v_parametros.id_evento;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Evento eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_evento',v_parametros.id_evento::varchar);
              
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
ALTER FUNCTION "siat"."ft_evento_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
