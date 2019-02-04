CREATE OR REPLACE FUNCTION siat.ft_ambiente_ime (
  p_administrador integer,
  p_id_usuario integer,
  p_tabla varchar,
  p_transaccion varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_ambiente_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tambiente'
 AUTOR: 		 (admin)
 FECHA:	        18-01-2019 14:57:46
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				18-01-2019 14:57:46								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tambiente'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_ambiente	integer;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_ambiente_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_AMBSIA_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		admin	
 	#FECHA:		18-01-2019 14:57:46
	***********************************/

	if(p_transaccion='SIA_AMBSIA_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into siat.tambiente(
			codigo,
			descripcion,
			estado_reg,
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
			now(),
			v_parametros._id_usuario_ai,
			p_id_usuario,
			v_parametros._nombre_usuario_ai,
			null,
			null
							
			
			
			) ON CONFLICT ON CONSTRAINT tambiente_codigo_key 
			DO UPDATE SET codigo = v_parametros.codigo,
			descripcion = v_parametros.descripcion,
			fecha_mod = now(),
			id_usuario_mod = p_id_usuario,
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			RETURNING id_ambiente into v_id_ambiente;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Ambiente SIAT almacenado(a) con exito (id_ambiente'||v_id_ambiente||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_ambiente',v_id_ambiente::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_AMBSIA_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		admin	
 	#FECHA:		18-01-2019 14:57:46
	***********************************/

	elsif(p_transaccion='SIA_AMBSIA_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.tambiente set
			codigo = v_parametros.codigo,
			descripcion = v_parametros.descripcion,
            estado_reg=v_parametros.estado_reg,
			fecha_mod = now(),
			id_usuario_mod = p_id_usuario,
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_ambiente=v_parametros.id_ambiente;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Ambiente SIAT modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_ambiente',v_parametros.id_ambiente::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_AMBSIA_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		admin	
 	#FECHA:		18-01-2019 14:57:46
	***********************************/

	elsif(p_transaccion='SIA_AMBSIA_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.tambiente
            where id_ambiente=v_parametros.id_ambiente;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Ambiente SIAT eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_ambiente',v_parametros.id_ambiente::varchar);
              
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

ALTER FUNCTION siat.ft_ambiente_ime (p_administrador integer, p_id_usuario integer, p_tabla varchar, p_transaccion varchar)
  OWNER TO postgres;