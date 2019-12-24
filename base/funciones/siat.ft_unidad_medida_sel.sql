CREATE OR REPLACE FUNCTION "siat"."ft_unidad_medida_sel"(	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$
/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_unidad_medida_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.tunidad_medida'
 AUTOR: 		 (jrivera)
 FECHA:	        20-12-2019 22:12:50
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				20-12-2019 22:12:50								Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.tunidad_medida'	
 #
 ***************************************************************************/

DECLARE

	v_consulta    		varchar;
	v_parametros  		record;
	v_nombre_funcion   	text;
	v_resp				varchar;
			    
BEGIN

	v_nombre_funcion = 'siat.ft_unidad_medida_sel';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_UNIMED_SEL'
 	#DESCRIPCION:	Consulta de datos
 	#AUTOR:		jrivera	
 	#FECHA:		20-12-2019 22:12:50
	***********************************/

	if(p_transaccion='SIA_UNIMED_SEL')then
     				
    	begin
    		--Sentencia de la consulta
			v_consulta:='select
						unimed.id_unidad_medida,
						unimed.estado_reg,
						unimed.codigo,
						unimed.descripcion,
						unimed.id_usuario_reg,
						unimed.fecha_reg,
						unimed.id_usuario_ai,
						unimed.usuario_ai,
						unimed.id_usuario_mod,
						unimed.fecha_mod,
						usu1.cuenta as usr_reg,
						usu2.cuenta as usr_mod,
						unimed.codigo_pxp	
						from siat.tunidad_medida unimed
						inner join segu.tusuario usu1 on usu1.id_usuario = unimed.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = unimed.id_usuario_mod
				        where  ';
			
			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;
			v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

			--Devuelve la respuesta
			return v_consulta;
						
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_UNIMED_CONT'
 	#DESCRIPCION:	Conteo de registros
 	#AUTOR:		jrivera	
 	#FECHA:		20-12-2019 22:12:50
	***********************************/

	elsif(p_transaccion='SIA_UNIMED_CONT')then

		begin
			--Sentencia de la consulta de conteo de registros
			v_consulta:='select count(id_unidad_medida)
					    from siat.tunidad_medida unimed
					    inner join segu.tusuario usu1 on usu1.id_usuario = unimed.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = unimed.id_usuario_mod
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
ALTER FUNCTION "siat"."ft_unidad_medida_sel"(integer, integer, character varying, character varying) OWNER TO postgres;
