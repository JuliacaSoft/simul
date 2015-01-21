DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `estado_simulacion`(xtipo INT, cantidad INT ,xensayo_id INT,xusuario_id INT, t_dependencia INT) RETURNS INT(11)
BEGIN

DECLARE condicion INT DEFAULT (SELECT (CASE WHEN MAX(simulacion_id) IS NULL THEN 0 ELSE MAX(simulacion_id) END) condicion FROM (SELECT * FROM simulacion WHERE usuario_id=xusuario_id AND estado_sim=0) a);

      
	IF (condicion = 0) THEN
	
	INSERT  INTO simulacion( estado_sim, num_intento, puntaje, punt_porcentual, ensayo_id, usuario_id, restante, respondida ) VALUES( 0, 0, 0, 0, xensayo_id, xusuario_id, 0, 0);
	
	
	SET condicion = (SELECT (CASE WHEN MAX(simulacion_id) IS NULL THEN 0 ELSE MAX(simulacion_id) END) condicion FROM (SELECT * FROM simulacion WHERE usuario_id=xusuario_id AND estado_sim=0) a);
	
		IF (xtipo=2) THEN
		INSERT INTO sim_resultado(revision, respuesta, simulacion_id, pregunta_id, estado) SELECT '0' AS revision, 0 AS respuesta,condicion AS simulacion_id,  pregunta_id, 0 AS estado FROM pregunta WHERE  area_id=t_dependencia ORDER BY RAND() LIMIT cantidad;
		ELSEIF (xtipo=3) THEN
		INSERT INTO sim_resultado(revision, respuesta, simulacion_id, pregunta_id, estado) SELECT '0' AS revision, 0 AS respuesta,condicion AS simulacion_id,  pregunta_id, 0 AS estado FROM pregunta WHERE  grupo_id=t_dependencia ORDER BY RAND() LIMIT cantidad;
		ELSE	
		INSERT INTO sim_resultado(revision, respuesta, simulacion_id, pregunta_id, estado) SELECT '0' AS revision, 0 AS respuesta,condicion AS simulacion_id,  pregunta_id, 0 AS estado FROM pregunta  ORDER BY RAND() LIMIT cantidad;
		
		END IF;

	
	END IF;
	
	
	
RETURN condicion;
    END$$
    
DELIMITER $$