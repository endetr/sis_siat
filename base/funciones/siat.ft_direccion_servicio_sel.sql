CREATE OR REPLACE FUNCTION "siat"."ft_direccion_servicio_sel"(	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$
/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_direccion_servicio_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.tdireccion_servicio'
 AUTOR: 		 (jrivera)
 FECHA:	        16-12-2019 11:32:48
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				16-12-2019 11:32:48								Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.tdireccion_servicio'	
 #
 ***************************************************************************/

DECLARE

	v_consulta    		varchar;
	v_parametros  		record;
	v_nombre_funcion   	text;
	v_resp				varchar;
			    
BEGIN

	v_nombre_funcion = 'siat.ft_direccion_servicio_sel';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_DIRSER_SEL'
 	#DESCRIPCION:	Consulta de datos
 	#AUTOR:		jrivera	
 	#FECHA:		16-12-2019 11:32:48
	***********************************/

	if(p_transaccion='SIA_DIRSER_SEL')then
     				
    	begin
    		--Sentencia de la consulta
			v_consulta:='select
						dirser.id_direccion_servicio,
						dirser.estado_reg,
						dirser.id_documento_sector,
						dirser.validacion,
						dirser.id_documento_fiscal,
						dirser.subtipo,
						dirser.validacion_anulacion,
						dirser.url,
						dirser.tipo,
						dirser.recepcion,
						dirser.recepcion_anulacion,
						dirser.usuario_ai,
						dirser.fecha_reg,
						dirser.id_usuario_reg,
						dirser.id_usuario_ai,
						dirser.id_usuario_mod,
						dirser.fecha_mod,
						usu1.cuenta as usr_reg,
						usu2.cuenta as usr_mod,
                        docfis.descripcion as desc_documento_fiscal,
                        docsec.descripcion as desc_documento_sector
						from siat.tdireccion_servicio dirser
						inner join segu.tusuario usu1 on usu1.id_usuario = dirser.id_usuario_reg
						left join siat.tdocumento_fiscal docfis on docfis.id_documento_fiscal = dirser.id_documento_fiscal
						left join siat.tdocumento_sector docsec on docsec.id_documento_sector = dirser.id_documento_sector
						left join segu.tusuario usu2 on usu2.id_usuario = dirser.id_usuario_mod
				        where  ';
			
			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;
			v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

			--Devuelve la respuesta
			return v_consulta;
						
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_DIRSER_CONT'
 	#DESCRIPCION:	Conteo de registros
 	#AUTOR:		jrivera	
 	#FECHA:		16-12-2019 11:32:48
	***********************************/

	elsif(p_transaccion='SIA_DIRSER_CONT')then

		begin
			--Sentencia de la consulta de conteo de registros
			v_consulta:='select count(id_direccion_servicio)
					    from siat.tdireccion_servicio dirser
					    inner join segu.tusuario usu1 on usu1.id_usuario = dirser.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = dirser.id_usuario_mod
						left join siat.tdocumento_fiscal docfis on docfis.id_documento_fiscal = dirser.id_documento_fiscal
						left join siat.tdocumento_sector docsec on docsec.id_documento_sector = dirser.id_documento_sector
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
ALTER FUNCTION "siat"."ft_direccion_servicio_sel"(integer, integer, character varying, character varying) OWNER TO postgres;
