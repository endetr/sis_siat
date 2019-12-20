CREATE OR REPLACE FUNCTION "siat"."ft_gestor_documento_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_gestor_documento_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tgestor_documento'
 AUTOR: 		 (jrivera)
 FECHA:	        16-12-2019 11:32:11
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				16-12-2019 11:32:11								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tgestor_documento'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_gestor_documento	integer;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_gestor_documento_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_GESDOC_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		16-12-2019 11:32:11
	***********************************/

	if(p_transaccion='SIA_GESDOC_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into siat.tgestor_documento(
			tipo,
			contenido_base64_corrida1,
			hash,
			metodo_servicio,
			id_venta,
			url_servicio,
			estado_reg,
			estado,
			contenido_base64_corrida2,
			id_usuario_ai,
			usuario_ai,
			fecha_reg,
			id_usuario_reg,
			fecha_mod,
			id_usuario_mod
          	) values(
			v_parametros.tipo,
			v_parametros.contenido_base64_corrida1,
			v_parametros.hash,
			v_parametros.metodo_servicio,
			v_parametros.id_venta,
			v_parametros.url_servicio,
			'activo',
			v_parametros.estado,
			v_parametros.contenido_base64_corrida2,
			v_parametros._id_usuario_ai,
			v_parametros._nombre_usuario_ai,
			now(),
			p_id_usuario,
			null,
			null
							
			
			
			)RETURNING id_gestor_documento into v_id_gestor_documento;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Gestor Documento almacenado(a) con exito (id_gestor_documento'||v_id_gestor_documento||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_gestor_documento',v_id_gestor_documento::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_GESDOC_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		16-12-2019 11:32:11
	***********************************/

	elsif(p_transaccion='SIA_GESDOC_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.tgestor_documento set
			tipo = v_parametros.tipo,
			contenido_base64_corrida1 = v_parametros.contenido_base64_corrida1,
			hash = v_parametros.hash,
			metodo_servicio = v_parametros.metodo_servicio,
			id_venta = v_parametros.id_venta,
			url_servicio = v_parametros.url_servicio,
			estado = v_parametros.estado,
			contenido_base64_corrida2 = v_parametros.contenido_base64_corrida2,
			fecha_mod = now(),
			id_usuario_mod = p_id_usuario,
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_gestor_documento=v_parametros.id_gestor_documento;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Gestor Documento modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_gestor_documento',v_parametros.id_gestor_documento::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_GESDOC_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		16-12-2019 11:32:11
	***********************************/

	elsif(p_transaccion='SIA_GESDOC_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.tgestor_documento
            where id_gestor_documento=v_parametros.id_gestor_documento;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Gestor Documento eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_gestor_documento',v_parametros.id_gestor_documento::varchar);
              
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
ALTER FUNCTION "siat"."ft_gestor_documento_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
