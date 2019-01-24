CREATE OR REPLACE FUNCTION "siat"."ft_salud_sistema_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_salud_sistema_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tsalud_sistema'
 AUTOR: 		 (admin)
 FECHA:	        24-01-2019 19:34:45
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				24-01-2019 19:34:45								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tsalud_sistema'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_salud_sistema	integer;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_salud_sistema_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_EVSA_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		admin	
 	#FECHA:		24-01-2019 19:34:45
	***********************************/

	if(p_transaccion='SIA_EVSA_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into siat.tsalud_sistema(
			estado_reg,
			codigo_evento,
			description_salud,
			fecha_salud,
			fk_sucursal,
			usuario_ai,
			fecha_reg,
			id_usuario_reg,
			id_usuario_ai,
			id_usuario_mod,
			fecha_mod
          	) values(
			'activo',
			v_parametros.codigo_evento,
			v_parametros.description_salud,
			v_parametros.fecha_salud,
			v_parametros.fk_sucursal,
			v_parametros._nombre_usuario_ai,
			now(),
			p_id_usuario,
			v_parametros._id_usuario_ai,
			null,
			null
							
			
			
			)RETURNING id_salud_sistema into v_id_salud_sistema;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Salud del Sistema almacenado(a) con exito (id_salud_sistema'||v_id_salud_sistema||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_salud_sistema',v_id_salud_sistema::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_EVSA_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		admin	
 	#FECHA:		24-01-2019 19:34:45
	***********************************/

	elsif(p_transaccion='SIA_EVSA_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.tsalud_sistema set
			codigo_evento = v_parametros.codigo_evento,
			description_salud = v_parametros.description_salud,
			fecha_salud = v_parametros.fecha_salud,
			fk_sucursal = v_parametros.fk_sucursal,
			id_usuario_mod = p_id_usuario,
			fecha_mod = now(),
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_salud_sistema=v_parametros.id_salud_sistema;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Salud del Sistema modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_salud_sistema',v_parametros.id_salud_sistema::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_EVSA_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		admin	
 	#FECHA:		24-01-2019 19:34:45
	***********************************/

	elsif(p_transaccion='SIA_EVSA_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.tsalud_sistema
            where id_salud_sistema=v_parametros.id_salud_sistema;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Salud del Sistema eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_salud_sistema',v_parametros.id_salud_sistema::varchar);
              
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
ALTER FUNCTION "siat"."ft_salud_sistema_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
