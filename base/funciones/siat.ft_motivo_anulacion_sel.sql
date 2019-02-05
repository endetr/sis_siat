CREATE OR REPLACE FUNCTION siat.ft_motivo_anulacion_sel (
  p_administrador integer,
  p_id_usuario integer,
  p_tabla varchar,
  p_transaccion varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_motivo_anulacion_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.tmotivo_anulacion'
 AUTOR: 		 (ana.villegas)
 FECHA:	        31-01-2019 16:28:10
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				31-01-2019 16:28:10								Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.tmotivo_anulacion'	
 #
 ***************************************************************************/

DECLARE

	v_consulta    		varchar;
	v_parametros  		record;
	v_nombre_funcion   	text;
	v_resp				varchar;
			    
BEGIN

	v_nombre_funcion = 'siat.ft_motivo_anulacion_sel';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_MOTANU_SEL'
 	#DESCRIPCION:	Consulta de datos
 	#AUTOR:		ana.villegas	
 	#FECHA:		31-01-2019 16:28:10
	***********************************/

	if(p_transaccion='SIA_MOTANU_SEL')then
     				
    	begin
    		--Sentencia de la consulta
			v_consulta:='select
						motanu.id_motivo_anulacion,
						motanu.codigo,
						motanu.estado_reg,
						motanu.descripcion,
						motanu.id_usuario_reg,
						motanu.usuario_ai,
						motanu.fecha_reg,
						motanu.id_usuario_ai,
						motanu.id_usuario_mod,
						motanu.fecha_mod,
						usu1.cuenta as usr_reg,
						usu2.cuenta as usr_mod	
						from siat.tmotivo_anulacion motanu
						inner join segu.tusuario usu1 on usu1.id_usuario = motanu.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = motanu.id_usuario_mod
				        where  ';
			
			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;
			v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

			--Devuelve la respuesta
			return v_consulta;
						
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_MOTANU_CONT'
 	#DESCRIPCION:	Conteo de registros
 	#AUTOR:		ana.villegas	
 	#FECHA:		31-01-2019 16:28:10
	***********************************/

	elsif(p_transaccion='SIA_MOTANU_CONT')then

		begin
			--Sentencia de la consulta de conteo de registros
			v_consulta:='select count(id_motivo_anulacion)
					    from siat.tmotivo_anulacion motanu
					    inner join segu.tusuario usu1 on usu1.id_usuario = motanu.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = motanu.id_usuario_mod
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

ALTER FUNCTION siat.ft_motivo_anulacion_sel (p_administrador integer, p_id_usuario integer, p_tabla varchar, p_transaccion varchar)
  OWNER TO postgres;