CREATE OR REPLACE FUNCTION "siat"."ft_fecha_hora_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_fecha_hora_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tfecha_hora'
 AUTOR: 		 (jrivera)
 FECHA:	        20-12-2019 22:16:04
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				20-12-2019 22:16:04								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tfecha_hora'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_fecha_hora			integer;
	v_fecha_hora_siat		timestamp;
	v_res_alarma			integer;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_fecha_hora_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_FEHO_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		20-12-2019 22:16:04
	***********************************/

	if(p_transaccion='SIA_FEHO_INS')then
					
        begin			
			v_fecha_hora_siat = to_timestamp(REPLACE(v_parametros.fecha_hora, 'T', ' ' ),'YYYY-MM-DD HH24:MI:SS.MS');

			--si hay una diferencia mayor a 3 segundos entre la hora del servidor y la hora de impuestos insertamos una alerta 
			if (EXTRACT(EPOCH FROM (now() - v_fecha_hora_siat)) > 3 ) then
				v_res_alarma = param.f_inserta_alarma_dblink (
					p_id_usuario,
					'ALERTA SINCRONIZACION FECHA HORA IMPUESTOS!!!',
					'Existe una diferencia mayor a 3 segundos entre la hora del servidor y la hora de los servicios de impuestos SIAT (Revise la hora del servidor)',
					pxp.f_get_variable_global('siat_correos_alertas')
				);
				raise exception 'Existe una diferencia mayor a 3 segundos entre la hora del servidor y la hora de los servicios de impuestos SIAT (Revise la hora del servidor) %',v_fecha_hora_siat;
			end if;

        	--Sentencia de la insercion
        	insert into siat.tfecha_hora(
			fecha_hora,
			estado_reg,
			fecha_reg,
			usuario_ai,
			id_usuario_reg,
			id_usuario_ai,
			fecha_mod,
			id_usuario_mod
          	) values(
			v_parametros.fecha_hora,
			'activo',
			now(),
			v_parametros._nombre_usuario_ai,
			p_id_usuario,
			v_parametros._id_usuario_ai,
			null,
			null
							
			
			
			)RETURNING id_fecha_hora into v_id_fecha_hora;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Fecha y Hora almacenado(a) con exito (id_fecha_hora'||v_id_fecha_hora||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_fecha_hora',v_id_fecha_hora::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_FEHO_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		20-12-2019 22:16:04
	***********************************/

	elsif(p_transaccion='SIA_FEHO_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.tfecha_hora set
			fecha_hora = v_parametros.fecha_hora,
			fecha_mod = now(),
			id_usuario_mod = p_id_usuario,
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_fecha_hora=v_parametros.id_fecha_hora;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Fecha y Hora modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_fecha_hora',v_parametros.id_fecha_hora::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_FEHO_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		20-12-2019 22:16:04
	***********************************/

	elsif(p_transaccion='SIA_FEHO_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.tfecha_hora
            where id_fecha_hora=v_parametros.id_fecha_hora;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Fecha y Hora eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_fecha_hora',v_parametros.id_fecha_hora::varchar);
              
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
ALTER FUNCTION "siat"."ft_fecha_hora_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
