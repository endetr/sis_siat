CREATE OR REPLACE FUNCTION "siat"."ft_evento_significativo_sel"(	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$
/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_evento_significativo_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.tevento_significativo'
 AUTOR: 		 (admin)
 FECHA:	        21-01-2019 22:24:59
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				21-01-2019 22:24:59								Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.tevento_significativo'	
 #
 ***************************************************************************/

DECLARE

	v_consulta    		varchar;
	v_parametros  		record;
	v_nombre_funcion   	text;
	v_resp				varchar;
			    
BEGIN

	v_nombre_funcion = 'siat.ft_evento_significativo_sel';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_EVSI_SEL'
 	#DESCRIPCION:	Consulta de datos
 	#AUTOR:		admin	
 	#FECHA:		23-01-2019 19:31:54
	***********************************/

	if(p_transaccion='SIA_EVSI_SEL')then
     				
    	begin
    		--Sentencia de la consulta
			v_consulta:='select
						evsi.id_evento_significativo,						
                        evsi.codigo_sucursal,
						evsi.codigo_punto_venta,
						evsi.description,
						evsi.estado_reg,
						evsi.fecha_fin::date,
						evsi.id_evento,
						evsi.fecha_ini::date,
						evsi.usuario_ai,
						evsi.fecha_reg,
						evsi.id_usuario_reg,
						evsi.id_usuario_ai,
						evsi.fecha_mod,
						evsi.id_usuario_mod,
						usu1.cuenta as usr_reg,
						usu2.cuenta as usr_mod,
						to_char(evsi.fecha_ini,''HH24:MI:SS'')::varchar as hora_ini,
						to_char(evsi.fecha_fin,''HH24:MI:SS'')::varchar as hora_fin,	
						evesia.descripcion as desc_evento,
						evsi.codigo_evento
						from siat.tevento_significativo evsi
						inner join segu.tusuario usu1 on usu1.id_usuario = evsi.id_usuario_reg
						inner join siat.tevento evesia on evesia.id_evento = evsi.id_evento
						left join segu.tusuario usu2 on usu2.id_usuario = evsi.id_usuario_mod                        
				        where  ';
			
			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;
			v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

			--Devuelve la respuesta
			return v_consulta;
						
		end;


	/*********************************    
 	#TRANSACCION:  'SIA_EVSI_CONT'
 	#DESCRIPCION:	Conteo de registros
 	#AUTOR:		admin	
 	#FECHA:		21-01-2019 22:24:59
	***********************************/

	elsif(p_transaccion='SIA_EVSI_CONT')then

		begin
			--Sentencia de la consulta de conteo de registros
			v_consulta:='select count(id_evento_significativo)
					    from siat.tevento_significativo evsi
					    inner join segu.tusuario usu1 on usu1.id_usuario = evsi.id_usuario_reg
						inner join siat.tevento evesia on evesia.id_evento = evsi.id_evento
						left join segu.tusuario usu2 on usu2.id_usuario = evsi.id_usuario_mod						
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
ALTER FUNCTION "siat"."ft_evento_significativo_sel"(integer, integer, character varying, character varying) OWNER TO postgres;
