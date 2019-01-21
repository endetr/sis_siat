CREATE OR REPLACE FUNCTION "siat"."ft_tipo_emision_sel"(	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$
/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_tipo_emision_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.ttipo_emision'
 AUTOR: 		 (admin)
 FECHA:	        18-01-2019 14:57:49
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				18-01-2019 14:57:49								Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.ttipo_emision'	
 #
 ***************************************************************************/

DECLARE

	v_consulta    		varchar;
	v_parametros  		record;
	v_nombre_funcion   	text;
	v_resp				varchar;
			    
BEGIN

	v_nombre_funcion = 'siat.ft_tipo_emision_sel';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_TIESIA_SEL'
 	#DESCRIPCION:	Consulta de datos
 	#AUTOR:		admin	
 	#FECHA:		18-01-2019 14:57:49
	***********************************/

	if(p_transaccion='SIA_TIESIA_SEL')then
     				
    	begin
    		--Sentencia de la consulta
			v_consulta:='select
						tiesia.id_tipo_emision,
						tiesia.codigo,
						tiesia.descripcion,
						tiesia.estado_reg,
						tiesia.fecha_reg,
						tiesia.id_usuario_ai,
						tiesia.id_usuario_reg,
						tiesia.usuario_ai,
						tiesia.fecha_mod,
						tiesia.id_usuario_mod,
						usu1.cuenta as usr_reg,
						usu2.cuenta as usr_mod	
						from siat.ttipo_emision tiesia
						inner join segu.tusuario usu1 on usu1.id_usuario = tiesia.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = tiesia.id_usuario_mod
				        where  ';
			
			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;
			v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

			--Devuelve la respuesta
			return v_consulta;
						
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_TIESIA_CONT'
 	#DESCRIPCION:	Conteo de registros
 	#AUTOR:		admin	
 	#FECHA:		18-01-2019 14:57:49
	***********************************/

	elsif(p_transaccion='SIA_TIESIA_CONT')then

		begin
			--Sentencia de la consulta de conteo de registros
			v_consulta:='select count(id_tipo_emision)
					    from siat.ttipo_emision tiesia
					    inner join segu.tusuario usu1 on usu1.id_usuario = tiesia.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = tiesia.id_usuario_mod
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
ALTER FUNCTION "siat"."ft_tipo_emision_sel"(integer, integer, character varying, character varying) OWNER TO postgres;
