CREATE OR REPLACE FUNCTION "siat"."ft_unidad_medida_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_unidad_medida_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tunidad_medida'
 AUTOR: 		 (jrivera)
 FECHA:	        20-12-2019 22:12:50
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				20-12-2019 22:12:50								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tunidad_medida'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_unidad_medida	integer;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_unidad_medida_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_UNIMED_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		20-12-2019 22:12:50
	***********************************/

	if(p_transaccion='SIA_UNIMED_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into siat.tunidad_medida(
			estado_reg,
			codigo,
			descripcion,
			id_usuario_reg,
			fecha_reg,
			id_usuario_ai,
			usuario_ai,
			id_usuario_mod,
			fecha_mod
          	) values(
			'activo',
			v_parametros.codigo,
			v_parametros.descripcion,
			p_id_usuario,
			now(),
			v_parametros._id_usuario_ai,
			v_parametros._nombre_usuario_ai,
			null,
			null
							
			
			
			)RETURNING id_unidad_medida into v_id_unidad_medida;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Unidad de Medida almacenado(a) con exito (id_unidad_medida'||v_id_unidad_medida||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_unidad_medida',v_id_unidad_medida::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_UNIMED_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		20-12-2019 22:12:50
	***********************************/

	elsif(p_transaccion='SIA_UNIMED_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.tunidad_medida set
			codigo_pxp = v_parametros.codigo_pxp,
			id_usuario_mod = p_id_usuario,
			fecha_mod = now()
			where id_unidad_medida=v_parametros.id_unidad_medida;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Unidad de Medida modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_unidad_medida',v_parametros.id_unidad_medida::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_UNIMED_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		20-12-2019 22:12:50
	***********************************/

	elsif(p_transaccion='SIA_UNIMED_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.tunidad_medida
            where id_unidad_medida=v_parametros.id_unidad_medida;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Unidad de Medida eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_unidad_medida',v_parametros.id_unidad_medida::varchar);
              
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
ALTER FUNCTION "siat"."ft_unidad_medida_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
