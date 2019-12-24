CREATE OR REPLACE FUNCTION "siat"."ft_fecha_hora_sel"(	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$
/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_fecha_hora_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.tfecha_hora'
 AUTOR: 		 (jrivera)
 FECHA:	        20-12-2019 22:16:04
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				20-12-2019 22:16:04								Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.tfecha_hora'	
 #
 ***************************************************************************/

DECLARE

	v_consulta    		varchar;
	v_parametros  		record;
	v_nombre_funcion   	text;
	v_resp				varchar;
			    
BEGIN

	v_nombre_funcion = 'siat.ft_fecha_hora_sel';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_FEHO_SEL'
 	#DESCRIPCION:	Consulta de datos
 	#AUTOR:		jrivera	
 	#FECHA:		20-12-2019 22:16:04
	***********************************/

	if(p_transaccion='SIA_FEHO_SEL')then
     				
    	begin
    		--Sentencia de la consulta
			v_consulta:='select
						feho.id_fecha_hora,
						feho.fecha_hora,
						feho.estado_reg,
						feho.fecha_reg,
						feho.usuario_ai,
						feho.id_usuario_reg,
						feho.id_usuario_ai,
						feho.fecha_mod,
						feho.id_usuario_mod,
						usu1.cuenta as usr_reg,
						usu2.cuenta as usr_mod	
						from siat.tfecha_hora feho
						inner join segu.tusuario usu1 on usu1.id_usuario = feho.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = feho.id_usuario_mod
				        where  ';
			
			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;
			v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

			--Devuelve la respuesta
			return v_consulta;
						
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_FEHO_CONT'
 	#DESCRIPCION:	Conteo de registros
 	#AUTOR:		jrivera	
 	#FECHA:		20-12-2019 22:16:04
	***********************************/

	elsif(p_transaccion='SIA_FEHO_CONT')then

		begin
			--Sentencia de la consulta de conteo de registros
			v_consulta:='select count(id_fecha_hora)
					    from siat.tfecha_hora feho
					    inner join segu.tusuario usu1 on usu1.id_usuario = feho.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = feho.id_usuario_mod
					    where ';
			
			--Definicion de la respuesta		    
			v_consulta:=v_consulta||v_parametros.filtro;

			--Devuelve la respuesta
			return v_consulta;

		end;
					
	else
					     
		raise exception 'Transaccion inexistente';
					         
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
ALTER FUNCTION "siat"."ft_fecha_hora_sel"(integer, integer, character varying, character varying) OWNER TO postgres;
