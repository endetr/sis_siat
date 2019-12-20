CREATE OR REPLACE FUNCTION "siat"."ft_mapeo_tipo_venta_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_mapeo_tipo_venta_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tmapeo_tipo_venta'
 AUTOR: 		 (jrivera)
 FECHA:	        17-12-2019 02:51:47
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				17-12-2019 02:51:47								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tmapeo_tipo_venta'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_mapeo_tipo_venta	integer;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_mapeo_tipo_venta_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_MATV_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		17-12-2019 02:51:47
	***********************************/

	if(p_transaccion='SIA_MATV_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into siat.tmapeo_tipo_venta(
			estado_reg,
			id_documento_fiscal,
			id_documento_sector,
			id_tipo_venta,
			id_usuario_reg,
			fecha_reg,
			id_usuario_ai,
			usuario_ai,
			id_usuario_mod,
			fecha_mod
          	) values(
			'activo',
			v_parametros.id_documento_fiscal,
			v_parametros.id_documento_sector,
			v_parametros.id_tipo_venta,
			p_id_usuario,
			now(),
			v_parametros._id_usuario_ai,
			v_parametros._nombre_usuario_ai,
			null,
			null
							
			
			
			)RETURNING id_mapeo_tipo_venta into v_id_mapeo_tipo_venta;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Mapeo Tipo Venta almacenado(a) con exito (id_mapeo_tipo_venta'||v_id_mapeo_tipo_venta||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_mapeo_tipo_venta',v_id_mapeo_tipo_venta::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_MATV_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		17-12-2019 02:51:47
	***********************************/

	elsif(p_transaccion='SIA_MATV_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.tmapeo_tipo_venta set
			id_documento_fiscal = v_parametros.id_documento_fiscal,
			id_documento_sector = v_parametros.id_documento_sector,
			id_tipo_venta = v_parametros.id_tipo_venta,
			id_usuario_mod = p_id_usuario,
			fecha_mod = now(),
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_mapeo_tipo_venta=v_parametros.id_mapeo_tipo_venta;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Mapeo Tipo Venta modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_mapeo_tipo_venta',v_parametros.id_mapeo_tipo_venta::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_MATV_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		17-12-2019 02:51:47
	***********************************/

	elsif(p_transaccion='SIA_MATV_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.tmapeo_tipo_venta
            where id_mapeo_tipo_venta=v_parametros.id_mapeo_tipo_venta;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Mapeo Tipo Venta eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_mapeo_tipo_venta',v_parametros.id_mapeo_tipo_venta::varchar);
              
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
ALTER FUNCTION "siat"."ft_mapeo_tipo_venta_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
