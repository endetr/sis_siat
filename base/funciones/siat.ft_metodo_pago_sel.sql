CREATE OR REPLACE FUNCTION "siat"."ft_metodo_pago_sel"(	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$
/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_metodo_pago_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.tmetodo_pago'
 AUTOR: 		 (admin)
 FECHA:	        18-01-2019 14:57:57
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				18-01-2019 14:57:57								Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.tmetodo_pago'	
 #
 ***************************************************************************/

DECLARE

	v_consulta    		varchar;
	v_parametros  		record;
	v_nombre_funcion   	text;
	v_resp				varchar;
			    
BEGIN

	v_nombre_funcion = 'siat.ft_metodo_pago_sel';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_MEPSIA_SEL'
 	#DESCRIPCION:	Consulta de datos
 	#AUTOR:		admin	
 	#FECHA:		18-01-2019 14:57:57
	***********************************/

	if(p_transaccion='SIA_MEPSIA_SEL')then
     				
    	begin
    		--Sentencia de la consulta
			v_consulta:='select
						mepsia.id_metodo_pago,
						mepsia.codigo,
						mepsia.descripcion,
						mepsia.estado_reg,
						mepsia.fecha_reg,
						mepsia.id_usuario_ai,
						mepsia.id_usuario_reg,
						mepsia.usuario_ai,
						mepsia.fecha_mod,
						mepsia.id_usuario_mod,
						usu1.cuenta as usr_reg,
						usu2.cuenta as usr_mod,
						mepsia.codigo_pxp	
						from siat.tmetodo_pago mepsia
						inner join segu.tusuario usu1 on usu1.id_usuario = mepsia.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = mepsia.id_usuario_mod
				        where  ';
			
			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;
			v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

			--Devuelve la respuesta
			return v_consulta;
						
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_MEPSIA_CONT'
 	#DESCRIPCION:	Conteo de registros
 	#AUTOR:		admin	
 	#FECHA:		18-01-2019 14:57:57
	***********************************/

	elsif(p_transaccion='SIA_MEPSIA_CONT')then

		begin
			--Sentencia de la consulta de conteo de registros
			v_consulta:='select count(id_metodo_pago)
					    from siat.tmetodo_pago mepsia
					    inner join segu.tusuario usu1 on usu1.id_usuario = mepsia.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = mepsia.id_usuario_mod
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
ALTER FUNCTION "siat"."ft_metodo_pago_sel"(integer, integer, character varying, character varying) OWNER TO postgres;
