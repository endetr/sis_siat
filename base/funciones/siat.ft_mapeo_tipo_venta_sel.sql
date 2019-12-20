CREATE OR REPLACE FUNCTION "siat"."ft_mapeo_tipo_venta_sel"(	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$
/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_mapeo_tipo_venta_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.tmapeo_tipo_venta'
 AUTOR: 		 (jrivera)
 FECHA:	        17-12-2019 02:51:47
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				17-12-2019 02:51:47								Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.tmapeo_tipo_venta'	
 #
 ***************************************************************************/

DECLARE

	v_consulta    		varchar;
	v_parametros  		record;
	v_nombre_funcion   	text;
	v_resp				varchar;
			    
BEGIN

	v_nombre_funcion = 'siat.ft_mapeo_tipo_venta_sel';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_MATV_SEL'
 	#DESCRIPCION:	Consulta de datos
 	#AUTOR:		jrivera	
 	#FECHA:		17-12-2019 02:51:47
	***********************************/

	if(p_transaccion='SIA_MATV_SEL')then
     				
    	begin
    		--Sentencia de la consulta
			v_consulta:='select
						matv.id_mapeo_tipo_venta,
						matv.estado_reg,
						matv.id_documento_fiscal,
						matv.id_documento_sector,
						matv.id_tipo_venta,
						matv.id_usuario_reg,
						matv.fecha_reg,
						matv.id_usuario_ai,
						matv.usuario_ai,
						matv.id_usuario_mod,
						matv.fecha_mod,
						usu1.cuenta as usr_reg,
						usu2.cuenta as usr_mod,
						docfis.descripcion::text as desc_documento_fiscal,	
						docsec.descripcion::text as desc_documento_sector,	
						tipve.nombre::text as desc_tipo_venta	
						from siat.tmapeo_tipo_venta matv
						inner join segu.tusuario usu1 on usu1.id_usuario = matv.id_usuario_reg
						inner join siat.tdocumento_fiscal docfis on docfis.id_documento_fiscal = matv.id_documento_fiscal
						inner join siat.tdocumento_sector docsec on docsec.id_documento_sector = matv.id_documento_sector
						inner join vef.ttipo_venta tipve on tipve.id_tipo_venta = matv.id_tipo_venta
						left join segu.tusuario usu2 on usu2.id_usuario = matv.id_usuario_mod
				        where  ';
			
			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;
			v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

			--Devuelve la respuesta
			return v_consulta;
						
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_MATV_CONT'
 	#DESCRIPCION:	Conteo de registros
 	#AUTOR:		jrivera	
 	#FECHA:		17-12-2019 02:51:47
	***********************************/

	elsif(p_transaccion='SIA_MATV_CONT')then

		begin
			--Sentencia de la consulta de conteo de registros
			v_consulta:='select count(id_mapeo_tipo_venta)
					    from siat.tmapeo_tipo_venta matv
					    inner join segu.tusuario usu1 on usu1.id_usuario = matv.id_usuario_reg
						inner join siat.tdocumento_fiscal docfis on docfis.id_documento_fiscal = matv.id_documento_fiscal
						inner join siat.tdocumento_sector docsec on docsec.id_documento_sector = matv.id_documento_sector
						inner join vef.ttipo_venta tipve on tipve.id_tipo_venta = matv.id_tipo_venta
						left join segu.tusuario usu2 on usu2.id_usuario = matv.id_usuario_mod
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
ALTER FUNCTION "siat"."ft_mapeo_tipo_venta_sel"(integer, integer, character varying, character varying) OWNER TO postgres;
