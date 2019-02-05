CREATE OR REPLACE FUNCTION siat.ft_tipo_documento_siat_ime (
  p_administrador integer,
  p_id_usuario integer,
  p_tabla varchar,
  p_transaccion varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_tipo_documento_siat_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.ttipo_documento_siat'
 AUTOR: 		 (admin)
 FECHA:	        18-01-2019 14:58:05
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				18-01-2019 14:58:05								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.ttipo_documento_siat'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_tipo_documento	integer;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_tipo_documento_siat_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_DOCSIA_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		admin	
 	#FECHA:		18-01-2019 14:58:05
	***********************************/

	if(p_transaccion='SIA_DOCSIA_INS')then
					
        begin
        	--Sentencia de la insercion
            IF (EXISTS ( SELECT 1 FROM siat.ttipo_documento_siat
                       WHERE codigo=v_parametros.codigo and tipo=v_parametros.tipo))THEN
                       
                      update siat.ttipo_documento_siat set
                          codigo = v_parametros.codigo,
                          descripcion = v_parametros.descripcion,
                          tipo = v_parametros.tipo,
                          fecha_mod = now(),
                          id_usuario_mod = p_id_usuario,
                          id_usuario_ai = v_parametros._id_usuario_ai,
                          usuario_ai = v_parametros._nombre_usuario_ai
                       where codigo=v_parametros.codigo and tipo=v_parametros.tipo;
                             
                          --Definicion de la respuesta
                          v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Tipo Documento SIAT modificado(a)'); 
                          v_resp = pxp.f_agrega_clave(v_resp,'codigo_tipo_documento',v_parametros.codigo::varchar);
             
            ELSE
            
                    	insert into siat.ttipo_documento_siat(
                                  codigo,
                                  descripcion,
                                  estado_reg,
                                  tipo,
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
                                  v_parametros.tipo,
                                  now(),
                                  v_parametros._id_usuario_ai,
                                  p_id_usuario,
                                  v_parametros._nombre_usuario_ai,
                                  null,
                                  null
                      							
                      			
                      			
                                  )RETURNING id_tipo_documento into v_id_tipo_documento;

            --Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Tipo Documento SIAT almacenado(a) con exito (id_tipo_documento'||v_id_tipo_documento||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_tipo_documento',v_id_tipo_documento::varchar);

            END IF;
			
            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_DOCSIA_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		admin	
 	#FECHA:		18-01-2019 14:58:05
	***********************************/

	elsif(p_transaccion='SIA_DOCSIA_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.ttipo_documento_siat set
			codigo = v_parametros.codigo,
			descripcion = v_parametros.descripcion,
			tipo = v_parametros.tipo,
			fecha_mod = now(),
			id_usuario_mod = p_id_usuario,
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai,
               estado_reg=v_parametros.estado_reg
			where id_tipo_documento=v_parametros.id_tipo_documento;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Tipo Documento SIAT modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_tipo_documento',v_parametros.id_tipo_documento::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_DOCSIA_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		admin	
 	#FECHA:		18-01-2019 14:58:05
	***********************************/

	elsif(p_transaccion='SIA_DOCSIA_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.ttipo_documento_siat
            where id_tipo_documento=v_parametros.id_tipo_documento;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Tipo Documento SIAT eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_tipo_documento',v_parametros.id_tipo_documento::varchar);
              
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

ALTER FUNCTION siat.ft_tipo_documento_siat_ime (p_administrador integer, p_id_usuario integer, p_tabla varchar, p_transaccion varchar)
  OWNER TO postgres;