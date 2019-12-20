CREATE OR REPLACE FUNCTION "siat"."ft_direccion_servicio_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_direccion_servicio_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tdireccion_servicio'
 AUTOR: 		 (jrivera)
 FECHA:	        16-12-2019 11:32:48
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				16-12-2019 11:32:48								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tdireccion_servicio'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_direccion_servicio	integer;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_direccion_servicio_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_DIRSER_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		16-12-2019 11:32:48
	***********************************/

	if(p_transaccion='SIA_DIRSER_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into siat.tdireccion_servicio(
			estado_reg,
			id_documento_sector,
			validacion,
			id_documento_fiscal,
			subtipo,
			validacion_anulacion,
			url,
			tipo,
			recepcion,
			recepcion_anulacion,
			usuario_ai,
			fecha_reg,
			id_usuario_reg,
			id_usuario_ai,
			id_usuario_mod,
			fecha_mod
          	) values(
			'activo',
			v_parametros.id_documento_sector,
			v_parametros.validacion,
			v_parametros.id_documento_fiscal,
			v_parametros.subtipo,
			v_parametros.validacion_anulacion,
			v_parametros.url,
			v_parametros.tipo,
			v_parametros.recepcion,
			v_parametros.recepcion_anulacion,
			v_parametros._nombre_usuario_ai,
			now(),
			p_id_usuario,
			v_parametros._id_usuario_ai,
			null,
			null
							
			
			
			)RETURNING id_direccion_servicio into v_id_direccion_servicio;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Direccion Servicio almacenado(a) con exito (id_direccion_servicio'||v_id_direccion_servicio||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_direccion_servicio',v_id_direccion_servicio::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_DIRSER_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		16-12-2019 11:32:48
	***********************************/

	elsif(p_transaccion='SIA_DIRSER_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.tdireccion_servicio set
			id_documento_sector = v_parametros.id_documento_sector,
			validacion = v_parametros.validacion,
			id_documento_fiscal = v_parametros.id_documento_fiscal,
			subtipo = v_parametros.subtipo,
			validacion_anulacion = v_parametros.validacion_anulacion,
			url = v_parametros.url,
			tipo = v_parametros.tipo,
			recepcion = v_parametros.recepcion,
			recepcion_anulacion = v_parametros.recepcion_anulacion,
			id_usuario_mod = p_id_usuario,
			fecha_mod = now(),
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_direccion_servicio=v_parametros.id_direccion_servicio;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Direccion Servicio modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_direccion_servicio',v_parametros.id_direccion_servicio::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_DIRSER_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		16-12-2019 11:32:48
	***********************************/

	elsif(p_transaccion='SIA_DIRSER_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.tdireccion_servicio
            where id_direccion_servicio=v_parametros.id_direccion_servicio;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Direccion Servicio eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_direccion_servicio',v_parametros.id_direccion_servicio::varchar);
              
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
ALTER FUNCTION "siat"."ft_direccion_servicio_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
