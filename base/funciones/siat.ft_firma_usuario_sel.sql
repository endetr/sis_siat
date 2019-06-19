CREATE OR REPLACE FUNCTION "siat"."ft_firma_usuario_sel"(
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$
/**************************************************************************
 SISTEMA:		Gestionar Firmas Digital
 FUNCION: 		siat.ft_firma_usuario_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'gfd.tfirma_usuario'
 AUTOR: 		 (miguel.mamani)
 FECHA:	        23-01-2019 13:35:04
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				23-01-2019 13:35:04								Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'gfd.tfirma_usuario'	
 #
 ***************************************************************************/

DECLARE

	v_consulta    		varchar;
	v_parametros  		record;
	v_nombre_funcion   	text;
	v_resp				varchar;
			    
BEGIN

	v_nombre_funcion = 'siat.ft_firma_usuario_sel';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'GFD_FDU_SEL'
 	#DESCRIPCION:	Consulta de datos
 	#AUTOR:		miguel.mamani	
 	#FECHA:		23-01-2019 13:35:04
	***********************************/

	if(p_transaccion='GFD_FDU_SEL')then
     				
    	begin
    		--Sentencia de la consulta
			v_consulta:='select
						fdu.id_firma_usuario,
						fdu.id_usuario,
						fdu.estado_reg,
						fdu.password,
						fdu.url_firma,
						fdu.extencion,
						fdu.id_usuario_reg,
						fdu.usuario_ai,
						fdu.fecha_reg,
						fdu.id_usuario_ai,
						fdu.fecha_mod,
						fdu.id_usuario_mod,
						usu1.cuenta as usr_reg,
						usu2.cuenta as usr_mod	
						from siat.tfirma_usuario fdu
						inner join segu.tusuario usu1 on usu1.id_usuario = fdu.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = fdu.id_usuario_mod
				        where  ';
			
			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;
			v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

			--Devuelve la respuesta
			return v_consulta;
						
		end;

	/*********************************    
 	#TRANSACCION:  'GFD_FDU_CONT'
 	#DESCRIPCION:	Conteo de registros
 	#AUTOR:		miguel.mamani	
 	#FECHA:		23-01-2019 13:35:04
	***********************************/

	elsif(p_transaccion='GFD_FDU_CONT')then

		begin
			--Sentencia de la consulta de conteo de registros
			v_consulta:='select count(id_firma_usuario)
					    from siat.tfirma_usuario fdu
					    inner join segu.tusuario usu1 on usu1.id_usuario = fdu.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = fdu.id_usuario_mod
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
ALTER FUNCTION "siat"."ft_firma_usuario_sel"(integer, integer, character varying, character varying) OWNER TO postgres;
