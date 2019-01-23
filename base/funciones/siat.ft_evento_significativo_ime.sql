CREATE OR REPLACE FUNCTION "siat"."ft_evento_significativo_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_evento_significativo_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tevento_significativo'
 AUTOR: 		 (admin)
 FECHA:	        21-01-2019 22:24:59
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				21-01-2019 22:24:59								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tevento_significativo'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_evento_significativo	integer;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_evento_significativo_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_EVSI_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		admin	
 	#FECHA:		21-01-2019 22:24:59
	***********************************/

	if(p_transaccion='SIA_EVSI_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into siat.tevento_significativo(
			fk_sucursal,
			description,
			estado_reg,
			fecha_fin,
			codigo_evento,
			fecha_ini,
			usuario_ai,
			fecha_reg,
			id_usuario_reg,
			id_usuario_ai,
			fecha_mod,
			id_usuario_mod
          	) values(
			v_parametros.fk_sucursal,
			v_parametros.description,
			'activo',
			v_parametros.fecha_fin,
			v_parametros.codigo_evento,
			v_parametros.fecha_ini,
			v_parametros._nombre_usuario_ai,
			now(),
			p_id_usuario,
			v_parametros._id_usuario_ai,
			null,
			null
							
			
			
			)RETURNING id_evento_significativo into v_id_evento_significativo;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Evento Significativo almacenado(a) con exito (id_evento_significativo'||v_id_evento_significativo||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_evento_significativo',v_id_evento_significativo::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_EVSI_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		admin	
 	#FECHA:		21-01-2019 22:24:59
	***********************************/

	elsif(p_transaccion='SIA_EVSI_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.tevento_significativo set
			fk_sucursal = v_parametros.fk_sucursal,
			description = v_parametros.description,
			fecha_fin = v_parametros.fecha_fin,
			codigo_evento = v_parametros.codigo_evento,
			fecha_ini = v_parametros.fecha_ini,
			fecha_mod = now(),
			id_usuario_mod = p_id_usuario,
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_evento_significativo=v_parametros.id_evento_significativo;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Evento Significativo modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_evento_significativo',v_parametros.id_evento_significativo::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_EVSI_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		admin	
 	#FECHA:		21-01-2019 22:24:59
	***********************************/

	elsif(p_transaccion='SIA_EVSI_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.tevento_significativo
            where id_evento_significativo=v_parametros.id_evento_significativo;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Evento Significativo eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_evento_significativo',v_parametros.id_evento_significativo::varchar);
              
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
ALTER FUNCTION "siat"."ft_evento_significativo_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
