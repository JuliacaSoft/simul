BEGIN

DECLARE condicion INT DEFAULT (SELECT (CASE WHEN MAX(simulacion_id) IS NULL THEN 0 ELSE MAX(simulacion_id) END) condicion FROM (SELECT * FROM simulacion WHERE usuario_id=xusuario_id AND estado_sim=0) a);
DECLARE xtiempo INTEGER;
DECLARE xsegundos INTEGER;
      
	IF (condicion = 0) THEN
	
	SET xtiempo = (SELECT tiempo FROM ensayo WHERE ensayo_id=xensayo_id);

	SET xsegundos = xtiempo * 60;

	INSERT INTO simulacion( estado_sim, num_intento, puntaje, punt_porcentual, ensayo_id, usuario_id, restante, respondida, fin_fecha) VALUES( 0, 0, 0, 0, xensayo_id, xusuario_id, 0, 0,FROM_UNIXTIME(UNIX_TIMESTAMP(now())+xsegundos));
	
	
	SET condicion = (SELECT (CASE WHEN MAX(simulacion_id) IS NULL THEN 0 ELSE MAX(simulacion_id) END) condicion FROM (SELECT * FROM simulacion WHERE usuario_id=xusuario_id AND estado_sim=0) a);
	
		if (xtipo=2) then
		INSERT INTO sim_resultado(revision, respuesta, simulacion_id, pregunta_id, estado) SELECT '0' AS revision, 0 AS respuesta,condicion AS simulacion_id,  pregunta_id, 0 AS estado FROM pregunta WHERE  area_id=t_dependencia ORDER BY RAND() LIMIT cantidad;
		elseif (xtipo=3) then
		INSERT INTO sim_resultado(revision, respuesta, simulacion_id, pregunta_id, estado) SELECT '0' AS revision, 0 AS respuesta,condicion AS simulacion_id,  pregunta_id, 0 AS estado FROM pregunta WHERE  grupo_id=t_dependencia ORDER BY RAND() LIMIT cantidad;
		else	
		INSERT INTO sim_resultado(revision, respuesta, simulacion_id, pregunta_id, estado) SELECT '0' AS revision, 0 AS respuesta,condicion AS simulacion_id,  pregunta_id, 0 AS estado FROM pregunta  ORDER BY RAND() LIMIT cantidad;
		
		end if;
	
	END IF;

RETURN condicion;
END