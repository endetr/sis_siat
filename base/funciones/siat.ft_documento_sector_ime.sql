CREATE OR REPLACE FUNCTION "siat"."ft_documento_sector_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_documento_sector_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tdocumento_sector'
 AUTOR: 		 (jrivera)
 FECHA:	        17-12-2019 10:41:56
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				17-12-2019 10:41:56								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tdocumento_sector'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_documento_sector	integer;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_documento_sector_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_DCOSEC_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		17-12-2019 10:41:56
	***********************************/

	if(p_transaccion='SIA_DCOSEC_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into siat.tdocumento_sector(
			codigo,
			estado_reg,
			descripcion,
			id_usuario_reg,
			fecha_reg,
			usuario_ai,
			id_usuario_ai,
			id_usuario_mod,
			fecha_mod
          	) values(
			v_parametros.codigo,
			'activo',
			v_parametros.descripcion,
			p_id_usuario,
			now(),
			v_parametros._nombre_usuario_ai,
			v_parametros._id_usuario_ai,
			null,
			null
							
			
			
			)RETURNING id_documento_sector into v_id_documento_sector;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Documento Sector almacenado(a) con exito (id_documento_sector'||v_id_documento_sector||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_documento_sector',v_id_documento_sector::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_DCOSEC_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		17-12-2019 10:41:56
	***********************************/

	elsif(p_transaccion='SIA_DCOSEC_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.tdocumento_sector set
			codigo = v_parametros.codigo,
			descripcion = v_parametros.descripcion,
			id_usuario_mod = p_id_usuario,
			fecha_mod = now(),
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_documento_sector=v_parametros.id_documento_sector;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Documento Sector modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_documento_sector',v_parametros.id_documento_sector::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_DCOSEC_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		17-12-2019 10:41:56
	***********************************/

	elsif(p_transaccion='SIA_DCOSEC_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.tdocumento_sector
            where id_documento_sector=v_parametros.id_documento_sector;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Documento Sector eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_documento_sector',v_parametros.id_documento_sector::varchar);
              
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
ALTER FUNCTION "siat"."ft_documento_sector_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
