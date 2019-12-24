CREATE OR REPLACE FUNCTION siat.ft_producto_sel (
  p_administrador integer,
  p_id_usuario integer,
  p_tabla varchar,
  p_transaccion varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_producto_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.tproducto'
 AUTOR: 		 (admin)
 FECHA:	        16-01-2019 19:47:00
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				16-01-2019 19:47:00								Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.tproducto'	
 #
 ***************************************************************************/

DECLARE

	v_consulta    		varchar;
	v_parametros  		record;
	v_nombre_funcion   	text;
	v_resp				varchar;
			    
BEGIN

	v_nombre_funcion = 'siat.ft_producto_sel';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_PRD_SEL'
 	#DESCRIPCION:	Consulta de datos
 	#AUTOR:		admin	
 	#FECHA:		16-01-2019 19:47:00
	***********************************/

	if(p_transaccion='SIA_PRD_SEL')then
     				
    	begin
    		--Sentencia de la consulta
			v_consulta:='select
						prd.id_producto,
						prd.codigo,
						prd.estado_reg,
						prd.descripcion,
						prd.id_usuario_reg,
						prd.usuario_ai,
						prd.fecha_reg,
						prd.id_usuario_ai,
						prd.fecha_mod,
						prd.id_usuario_mod,
						usu1.cuenta as usr_reg,
						usu2.cuenta as usr_mod,
						prd.actividad,
						prd.codigo_concepto_ingas	
						from siat.tproducto prd
						inner join segu.tusuario usu1 on usu1.id_usuario = prd.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = prd.id_usuario_mod
				        where  ';
			
			--Definicion de la respuesta
            v_consulta:=v_consulta||v_parametros.filtro;
			v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;
              -- raise exception '%',''||v_consulta;
			
			--Devuelve la respuesta
			return v_consulta;
						
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_PRD_CONT'
 	#DESCRIPCION:	Conteo de registros
 	#AUTOR:		admin	
 	#FECHA:		16-01-2019 19:47:00
	***********************************/

	elsif(p_transaccion='SIA_PRD_CONT')then

		begin
			--Sentencia de la consulta de conteo de registros
			v_consulta:='select count(id_producto)
					    from siat.tproducto prd
					    inner join segu.tusuario usu1 on usu1.id_usuario = prd.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = prd.id_usuario_mod
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
$body$
LANGUAGE 'plpgsql'
VOLATILE
CALLED ON NULL INPUT
SECURITY INVOKER
COST 100;

ALTER FUNCTION siat.ft_producto_sel (p_administrador integer, p_id_usuario integer, p_tabla varchar, p_transaccion varchar)
  OWNER TO postgres;