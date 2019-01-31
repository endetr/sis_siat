CREATE OR REPLACE FUNCTION siat.ft_motivo_anulacion_ime (
  p_administrador integer,
  p_id_usuario integer,
  p_tabla varchar,
  p_transaccion varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_motivo_anulacion_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tmotivo_anulacion'
 AUTOR: 		 (ana.villegas)
 FECHA:	        31-01-2019 16:28:10
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				31-01-2019 16:28:10								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tmotivo_anulacion'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_motivo_anulacion	integer;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_motivo_anulacion_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_MOTANU_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		ana.villegas	
 	#FECHA:		31-01-2019 16:28:10
	***********************************/

	if(p_transaccion='SIA_MOTANU_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into siat.tmotivo_anulacion(
			codigo,
			estado_reg,
			descripcion,
			id_usuario_reg,
			usuario_ai,
			fecha_reg,
			id_usuario_ai,
			id_usuario_mod,
			fecha_mod
          	) values(
			v_parametros.codigo,
			'activo',
			v_parametros.descripcion,
			p_id_usuario,
			v_parametros._nombre_usuario_ai,
			now(),
			v_parametros._id_usuario_ai,
			null,
			null
							
			
			
			)ON CONFLICT ON CONSTRAINT tmotivo_anulacion_codigo_key 
			DO UPDATE SET codigo = v_parametros.codigo,
			descripcion = v_parametros.descripcion,
			fecha_mod = now(),
			id_usuario_mod = p_id_usuario,
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
            RETURNING id_motivo_anulacion into v_id_motivo_anulacion;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Motivo Anulacion almacenado(a) con exito (id_motivo_anulacion'||v_id_motivo_anulacion||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_motivo_anulacion',v_id_motivo_anulacion::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_MOTANU_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		ana.villegas	
 	#FECHA:		31-01-2019 16:28:10
	***********************************/

	elsif(p_transaccion='SIA_MOTANU_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.tmotivo_anulacion set
			codigo = v_parametros.codigo,
			descripcion = v_parametros.descripcion,
			id_usuario_mod = p_id_usuario,
			fecha_mod = now(),
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai,
            estado_reg=v_parametros.estado_reg
			where id_motivo_anulacion=v_parametros.id_motivo_anulacion;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Motivo Anulacion modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_motivo_anulacion',v_parametros.id_motivo_anulacion::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_MOTANU_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		ana.villegas	
 	#FECHA:		31-01-2019 16:28:10
	***********************************/

	elsif(p_transaccion='SIA_MOTANU_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.tmotivo_anulacion
            where id_motivo_anulacion=v_parametros.id_motivo_anulacion;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Motivo Anulacion eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_motivo_anulacion',v_parametros.id_motivo_anulacion::varchar);
              
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

ALTER FUNCTION siat.ft_motivo_anulacion_ime (p_administrador integer, p_id_usuario integer, p_tabla varchar, p_transaccion varchar)
  OWNER TO postgres;