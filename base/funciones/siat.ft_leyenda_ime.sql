CREATE OR REPLACE FUNCTION "siat"."ft_leyenda_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_leyenda_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tleyenda'
 AUTOR: 		 (jrivera)
 FECHA:	        20-12-2019 22:15:53
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				20-12-2019 22:15:53								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tleyenda'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_leyenda	integer;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_leyenda_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_LEYE_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		20-12-2019 22:15:53
	***********************************/

	if(p_transaccion='SIA_LEYE_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into siat.tleyenda(
			codigo,
			estado_reg,
			descripcion,
			usuario_ai,
			fecha_reg,
			id_usuario_reg,
			id_usuario_ai,
			fecha_mod,
			id_usuario_mod
          	) values(
			v_parametros.codigo,
			'activo',
			v_parametros.descripcion,
			v_parametros._nombre_usuario_ai,
			now(),
			p_id_usuario,
			v_parametros._id_usuario_ai,
			null,
			null
							
			
			
			)RETURNING id_leyenda into v_id_leyenda;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Leyendas almacenado(a) con exito (id_leyenda'||v_id_leyenda||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_leyenda',v_id_leyenda::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_LEYE_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		20-12-2019 22:15:53
	***********************************/

	elsif(p_transaccion='SIA_LEYE_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.tleyenda set
			codigo = v_parametros.codigo,
			descripcion = v_parametros.descripcion,
			fecha_mod = now(),
			id_usuario_mod = p_id_usuario,
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_leyenda=v_parametros.id_leyenda;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Leyendas modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_leyenda',v_parametros.id_leyenda::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_LEYE_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		20-12-2019 22:15:53
	***********************************/

	elsif(p_transaccion='SIA_LEYE_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.tleyenda
            where id_leyenda=v_parametros.id_leyenda;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Leyendas eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_leyenda',v_parametros.id_leyenda::varchar);
              
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
ALTER FUNCTION "siat"."ft_leyenda_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
