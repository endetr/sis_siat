CREATE OR REPLACE FUNCTION siat.ft_cuis_ime (
  p_administrador integer,
  p_id_usuario integer,
  p_tabla varchar,
  p_transaccion varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA:		Sistema de Ventas
 FUNCION: 		siat.ft_cuis_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tcuis'
 AUTOR: 		 (admin)
 FECHA:	        21-01-2019 15:18:39
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				21-01-2019 15:18:39								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tcuis'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_cuis	integer;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_cuis_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_CUIS_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		admin	
 	#FECHA:		21-01-2019 15:18:39
	***********************************/

	if(p_transaccion='SIA_CUIS_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into siat.tcuis(
			codigo,
			fecha_fin,
			estado_reg,
			fecha_inicio,
			id_usuario_ai,
			id_usuario_reg,
			fecha_reg,
			usuario_ai,
			id_usuario_mod,
			fecha_mod,
            horas_anulacion
          	) values(
			v_parametros.codigo,
			v_parametros.fecha_fin,
			'activo',
			v_parametros.fecha_inicio,
			v_parametros._id_usuario_ai,
			p_id_usuario,
			now(),
			v_parametros._nombre_usuario_ai,
			null,
			null,
            v_parametros.horas_anulacion
							
			
			
			)RETURNING id_cuis into v_id_cuis;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','CUIS almacenado(a) con exito (id_cuis'||v_id_cuis||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_cuis',v_id_cuis::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_CUIS_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		admin	
 	#FECHA:		21-01-2019 15:18:39
	***********************************/

	elsif(p_transaccion='SIA_CUIS_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.tcuis set
			codigo = v_parametros.codigo,
			fecha_fin = v_parametros.fecha_fin,
			fecha_inicio = v_parametros.fecha_inicio,
			id_usuario_mod = p_id_usuario,
			fecha_mod = now(),
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai,
            horas_anulacion = v_parametros.horas_anulacion
			where id_cuis=v_parametros.id_cuis;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','CUIS modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_cuis',v_parametros.id_cuis::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_CUIS_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		admin	
 	#FECHA:		21-01-2019 15:18:39
	***********************************/

	elsif(p_transaccion='SIA_CUIS_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.tcuis
            where id_cuis=v_parametros.id_cuis;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','CUIS eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_cuis',v_parametros.id_cuis::varchar);
              
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