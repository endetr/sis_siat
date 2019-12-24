CREATE OR REPLACE FUNCTION "siat"."ft_departamento_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_departamento_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tdepartamento'
 AUTOR: 		 (jrivera)
 FECHA:	        20-12-2019 22:16:01
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				20-12-2019 22:16:01								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tdepartamento'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_departamento	integer;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_departamento_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_DEPA_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		20-12-2019 22:16:01
	***********************************/

	if(p_transaccion='SIA_DEPA_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into siat.tdepartamento(
			codigo,
			descripcion,
			estado_reg,
			id_usuario_ai,
			id_usuario_reg,
			fecha_reg,
			usuario_ai,
			fecha_mod,
			id_usuario_mod
          	) values(
			v_parametros.codigo,
			v_parametros.descripcion,
			'activo',
			v_parametros._id_usuario_ai,
			p_id_usuario,
			now(),
			v_parametros._nombre_usuario_ai,
			null,
			null
							
			
			
			)RETURNING id_departamento into v_id_departamento;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Departamento almacenado(a) con exito (id_departamento'||v_id_departamento||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_departamento',v_id_departamento::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_DEPA_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		20-12-2019 22:16:01
	***********************************/

	elsif(p_transaccion='SIA_DEPA_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.tdepartamento set
			codigo = v_parametros.codigo,
			descripcion = v_parametros.descripcion,
			fecha_mod = now(),
			id_usuario_mod = p_id_usuario,
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_departamento=v_parametros.id_departamento;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Departamento modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_departamento',v_parametros.id_departamento::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_DEPA_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		jrivera	
 	#FECHA:		20-12-2019 22:16:01
	***********************************/

	elsif(p_transaccion='SIA_DEPA_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.tdepartamento
            where id_departamento=v_parametros.id_departamento;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Departamento eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_departamento',v_parametros.id_departamento::varchar);
              
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
ALTER FUNCTION "siat"."ft_departamento_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
