CREATE OR REPLACE FUNCTION "siat"."ft_envio_documento_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_envio_documento_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tenvio_documento'
 AUTOR: 		 (admin)
 FECHA:	        31-01-2019 13:06:14
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				31-01-2019 13:06:14								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tenvio_documento'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_envio_documento	integer;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_envio_documento_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_ENDOCF_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		admin	
 	#FECHA:		31-01-2019 13:06:14
	***********************************/

	if(p_transaccion='SIA_ENDOCF_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into siat.tenvio_documento(
			nro_documento,
			fecha_emision,
			cuf,
			estado_reg,
			monto,
			estado,
			modo_envio,
			id_usuario_ai,
			fecha_reg,
			usuario_ai,
			id_usuario_reg,
			id_usuario_mod,
			fecha_mod
          	) values(
			v_parametros.nro_documento,
			v_parametros.fecha_emision,
			v_parametros.cuf,
			'activo',
			v_parametros.monto,
			v_parametros.estado,
			v_parametros.modo_envio,
			v_parametros._id_usuario_ai,
			now(),
			v_parametros._nombre_usuario_ai,
			p_id_usuario,
			null,
			null
							
			
			
			)RETURNING id_envio_documento into v_id_envio_documento;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Envio de Documentos Fiscales almacenado(a) con exito (id_envio_documento'||v_id_envio_documento||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_envio_documento',v_id_envio_documento::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_ENDOCF_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		admin	
 	#FECHA:		31-01-2019 13:06:14
	***********************************/

	elsif(p_transaccion='SIA_ENDOCF_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.tenvio_documento set
			nro_documento = v_parametros.nro_documento,
			fecha_emision = v_parametros.fecha_emision,
			cuf = v_parametros.cuf,
			monto = v_parametros.monto,
			estado = v_parametros.estado,
			modo_envio = v_parametros.modo_envio,
			id_usuario_mod = p_id_usuario,
			fecha_mod = now(),
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_envio_documento=v_parametros.id_envio_documento;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Envio de Documentos Fiscales modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_envio_documento',v_parametros.id_envio_documento::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_ENDOCF_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		admin	
 	#FECHA:		31-01-2019 13:06:14
	***********************************/

	elsif(p_transaccion='SIA_ENDOCF_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.tenvio_documento
            where id_envio_documento=v_parametros.id_envio_documento;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Envio de Documentos Fiscales eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_envio_documento',v_parametros.id_envio_documento::varchar);
              
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
ALTER FUNCTION "siat"."ft_envio_documento_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
