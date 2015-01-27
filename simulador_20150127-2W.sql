-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-01-2015 a las 21:06:43
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `simulador`
--

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `estado_simulacion`(`xtipo` INT, `cantidad` INT, `xensayo_id` INT, `xusuario_id` INT, `t_dependencia` INT) RETURNS int(11)
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
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `area_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(300) CHARACTER SET latin1 NOT NULL,
  `peso` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`area_id`, `nombre`, `descripcion`, `peso`, `estado`) VALUES
(1, 'GestiÃ³n de la IntegraciÃ³n del Proyecto', 'GestiÃ³n de la IntegraciÃ³n del Proyecto', 10, 1),
(2, 'GestiÃ³n del Alcance del Proyecto', 'GestiÃ³n del Alcance del Proyecto', 10, 1),
(3, 'GestiÃ³n del Tiempo del Proyecto', 'GestiÃ³n del Tiempo del Proyecto', 10, 1),
(4, 'GestiÃ³n de los Costes del Proyecto', 'GestiÃ³n de los Costes del Proyecto', 10, 1),
(5, 'GestiÃ³n de la Calidad del Proyecto', 'GestiÃ³n de la Calidad del Proyecto', 10, 1),
(6, 'GestiÃ³n de los Recursos Humanos del Proyecto', 'GestiÃ³n de los Recursos Humanos del Proyecto', 10, 1),
(7, 'GestiÃ³n de las ComunicaciÃ³nes del Proyecto', 'GestiÃ³n de las ComunicaciÃ³nes del Proyecto', 10, 1),
(8, 'GestiÃ³n de los Riesgos del Proyecto', 'GestiÃ³n de los Riesgos del Proyecto', 10, 1),
(9, 'GestiÃ³n de las Adquisiciones del Proyecto', 'GestiÃ³n de las Adquisiciones del Proyecto', 10, 1),
(10, 'GestiÃ³n de los Interesados del Proyecto', 'GestiÃ³n de los Interesados del Proyecto', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `curso_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET latin1 NOT NULL,
  `estado` varchar(1) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`curso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`curso_id`, `nombre`, `estado`) VALUES
(1, 'TPMP', '1'),
(2, 'CAPM', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ensayo`
--

CREATE TABLE IF NOT EXISTS `ensayo` (
  `ensayo_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET latin1 NOT NULL,
  `tipo` int(1) NOT NULL,
  `t_dependencia` varchar(1) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(200) CHARACTER SET latin1 NOT NULL,
  `tiempo` int(11) DEFAULT NULL COMMENT '--minutos',
  `intento` int(11) NOT NULL,
  `cant_preg` int(11) NOT NULL,
  `porc_aprobacion` int(3) NOT NULL,
  `estado` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  PRIMARY KEY (`ensayo_id`),
  KEY `cursos_ensayo_fk` (`curso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ensayo`
--

INSERT INTO `ensayo` (`ensayo_id`, `nombre`, `tipo`, `t_dependencia`, `descripcion`, `tiempo`, `intento`, `cant_preg`, `porc_aprobacion`, `estado`, `curso_id`) VALUES
(1, 'EnsA - Calidad', 2, '5', 'Ensayo Ãrea de conocimiento Calidad', 30, 2, 5, 80, 1, 1),
(2, 'EnsG - PlanificaciÃ³n', 3, '2', 'Ensayo Grupo de Proceso PlanificaciÃ³n', 30, 2, 5, 90, 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `grupo_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(300) CHARACTER SET latin1 NOT NULL,
  `peso` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`grupo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`grupo_id`, `nombre`, `descripcion`, `peso`, `estado`) VALUES
(1, 'Grupo de Procesos de Inicio', 'Grupo de Procesos de Inicio', 20, 1),
(2, 'Grupo de Procesos de PlanificaciÃ³n', 'Grupo de Procesos de PlanificaciÃ³n', 20, 1),
(3, 'Grupo de Procesos de EjecuciÃ³n', 'Grupo de Procesos de EjecuciÃ³n', 20, 1),
(4, 'Grupo de Procesos de Monitoreo y Control', 'Grupo de Procesos de Monitoreo y Control', 10, 1),
(5, 'Grupo de Procesos de Cierre', 'Grupo de Procesos de Cierre', 30, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gasto` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `gasto`) VALUES
(1, 'Pedro', '13'),
(2, 'Juan', '20'),
(3, 'Pedro', '13'),
(4, 'Juan', '20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE IF NOT EXISTS `pregunta` (
  `pregunta_id` int(11) NOT NULL AUTO_INCREMENT,
  `excel_id` varchar(10) NOT NULL,
  `pregunta_es` varchar(1000) NOT NULL,
  `pregunta_us` varchar(1000) NOT NULL,
  `imagen_es` varchar(100) NOT NULL,
  `imagen_us` varchar(100) NOT NULL,
  `respuesta` varchar(1) NOT NULL,
  `opcion_aes` varchar(1000) NOT NULL,
  `opcion_bes` varchar(1000) NOT NULL,
  `opcion_ces` varchar(1000) NOT NULL,
  `opcion_des` varchar(1000) NOT NULL,
  `opcion_aus` varchar(1000) NOT NULL,
  `opcion_bus` varchar(1000) NOT NULL,
  `opcion_cus` varchar(1000) NOT NULL,
  `opcion_dus` varchar(1000) NOT NULL,
  `comentario_aes` varchar(1000) NOT NULL,
  `comentario_bes` varchar(1000) NOT NULL,
  `comentario_ces` varchar(1000) NOT NULL,
  `comentario_des` varchar(1000) NOT NULL,
  `comentario_aus` varchar(1000) NOT NULL,
  `comentario_bus` varchar(1000) NOT NULL,
  `comentario_cus` varchar(1000) NOT NULL,
  `comentario_dus` varchar(1000) NOT NULL,
  `nivel_dificultad` varchar(2) NOT NULL,
  `estado` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  PRIMARY KEY (`pregunta_id`),
  KEY `grupo_pregunta_fk` (`grupo_id`),
  KEY `area_pregunta_fk` (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127 ;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`pregunta_id`, `excel_id`, `pregunta_es`, `pregunta_us`, `imagen_es`, `imagen_us`, `respuesta`, `opcion_aes`, `opcion_bes`, `opcion_ces`, `opcion_des`, `opcion_aus`, `opcion_bus`, `opcion_cus`, `opcion_dus`, `comentario_aes`, `comentario_bes`, `comentario_ces`, `comentario_des`, `comentario_aus`, `comentario_bus`, `comentario_cus`, `comentario_dus`, `nivel_dificultad`, `estado`, `area_id`, `grupo_id`) VALUES
(1, 'CA-1', 'Â¿CuÃ¡l de las siguientes opciones NO es un ejemplo de las restricciones que pueden limitar la flexibilidad en el proceso de adquisiciÃ³n del Equipo del Proyecto ?', 'Â¿CuÃ¡l de las siguientes opciones NO es un ejemplo de las restricciones que pueden limitar la flexibilidad en el proceso de adquisiciÃ³n del Equipo del Proyecto ?', '0', '0', 'C', 'Estructura organizativa', 'Disponibilidad de recursos', 'Lugar', 'Los requerimientos de recursos de la actividad', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'A y B son ejemplos claros. D tambiÃ©n es una restricciÃ³n porque el no disponer de las capacidades suficientes podrÃ­a disminuir la probabilidad de Ã©xito del proyecto. Si bien C podrÃ­a considerarse una restricciÃ³n, estÃ¡ incluida en C que es mÃ¡s general.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 6, 3),
(2, 'CA-2', 'Usted estÃ¡ manejando un proyecto de telecomunicaciones. Tres equipos de proyecto estÃ¡n trabajando para usted. Cada equipo consta de cuatro ingenieros y un jefe de equipo. La naturaleza del trabajo es tal que no hay ningÃºn requisito para las comunicaciones entre equipos, cada persona sÃ³lo se comunica dentro de su equipo. SÃ³lo los jefes de equipo informan a usted, y en situaciones en que se requiera transmitir informaciÃ³n de un equipo a otro, esta informaciÃ³n pasa a travÃ©s de usted. Â¿CuÃ¡ntos canales de comunicaciÃ³n tiene usted en este escenario?', 'Usted estÃ¡ manejando un proyecto de telecomunicaciones. Tres equipos de proyecto estÃ¡n trabajando para usted. Cada equipo consta de cuatro ingenieros y un jefe de equipo. La naturaleza del trabajo es tal que no hay ningÃºn requisito para las comunicaciones entre equipos, cada persona sÃ³lo se comunica dentro de su equipo. SÃ³lo los jefes de equipo informan a usted, y en situaciones en que se requiera transmitir informaciÃ³n de un equipo a otro, esta informaciÃ³n pasa a travÃ©s de usted. Â¿CuÃ¡ntos canales de comunicaciÃ³n tiene usted en este escenario?', '0', '0', 'C', '36', '30', '33', '120', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'El nÃºmero total de canales de comunicaciÃ³n potenciales es igual a n(n-1)/2, donde n representa el nÃºmero de interesados. Cada equipo tiene 5 integrantes, es decir, 10 canales de comunicaciÃ³n; 3 equipos suman 30 canales. Si cada equipo se comunica con el JP pero no con los otros equipos, se suman 3 canales mÃ¡s, 33 en total.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 7, 2),
(3, 'CA-3', 'Â¿Cual de las siguientes herramientas y tÃ©cnicas son utilizadas para crear el Plan de GestiÃ³n de las Comunicaciones?', 'Â¿Cual de las siguientes herramientas y tÃ©cnicas son utilizadas para crear el Plan de GestiÃ³n de las Comunicaciones?', '0', '0', 'A', 'AnÃ¡lisis de los requisitos de comunicaciÃ³n y TecnologÃ­a de Comunicaciones', 'Habilidades de comunicaciÃ³n y Proceso de lecciones aprendidas', 'AnÃ¡lisis de interesados y enunciado del alcance del proyecto', 'Canales de comunicaciÃ³n e informaciÃ³n de desempeÃ±o del trabajo', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'SegÃºn las guÃ­as del PMBOK, B, C ni D son H&T vÃ¡lidas.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 7, 2),
(4, 'CA-4', 'CuÃ¡l de las siguientes estrategias son sugeridas para abordar riesgos o amenazas que tienen impacto negativo en los proyectos?', 'CuÃ¡l de las siguientes estrategias son sugeridas para abordar riesgos o amenazas que tienen impacto negativo en los proyectos?', '0', '0', 'C', 'Evitar, transferir o mejorar', 'Explotar, compartir o mejorar', 'Evitar, transferir o mitigar', 'Evitar, explotar o mitigar', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Mejorar, explotar y compartir son estrategias para abordar riesgos positivos, lo que descarta las alternativas A, B y D.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 8, 2),
(5, 'CA-5', 'Â¿QuÃ© es la Estructura de Desglose delTrabajo (EDT)?', 'Â¿QuÃ© es la Estructura de Desglose delTrabajo (EDT)?', '0', '0', 'A', 'Es una descomposiciÃ³n jerÃ¡rquica de los entregables, orientada al trabajo que serÃ¡ ejecutado por el equipo de proyecto para llevar a cabo los objetivos de proyecto y crear los entregables requeridos.', 'Es una representaciÃ³n organizada jerÃ¡rquicamente de la organizaciÃ³n del proyecto dispuestos de manera que los paquetes de trabajo se pueden relacionar con la unidad  organizativa que lo realizarÃ¡.', 'Es una representaciÃ³n jerÃ¡rquicamente organizada de los recursos por tipo que serÃ¡n utilizados el proyecto.', 'Es una tabulaciÃ³n jerÃ¡rquica de las piezas  y componentes necesarias para fabricar un producto.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'B, C y D no son correctas.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 2, 2),
(6, 'CA-6', 'Una acciÃ³n correctiva es:', 'Una acciÃ³n correctiva es:', '0', '0', 'B', 'Reparar defectos anteriores', 'Una actividad intencionada para llevar el rendimiento futuro del proyecto de acuerdo con el plan de direcciÃ³n del proyecto', 'La responsabilidad de la junta de control de cambios', 'Una salida de la ejecuciÃ³n del Plan de Proyecto', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'B es la definiciÃ³n que entrega el PMBOK para AcciÃ³ Correctiva.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 1, 3),
(7, 'CA-7', 'El AnÃ¡lisis de interesados es parte de:', 'El AnÃ¡lisis de interesados es parte de:', '0', '0', 'C', 'Parte de la estrategia de gestiÃ³n de interesados', 'Una salida del Plan de Comunicaciones', 'Parte de Identificar a los interesados', 'Parte de los informes de rendimiento', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'El anÃ¡lisis de interesados es una H&T del proceso de Identificar a los interesados.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 10, 1),
(8, 'CA-8', 'Â¿QuÃ© modelo de relaciÃ³n es mÃ¡s comÃºnmente utilizado en los diagramas de precedencia?', 'Â¿QuÃ© modelo de relaciÃ³n es mÃ¡s comÃºnmente utilizado en los diagramas de precedencia?', '0', '0', 'C', 'Comienzo a comienzo', 'Comienzo a final', 'Fin a comienzo', 'Fin a fin', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'AsÃ­ lo indican las guÃ­as del PMBOK.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 3, 2),
(9, 'CA-9', 'Â¿CuÃ¡l de las siguientes alternativas es cierta sobre la tÃ©cnica Delphi?', 'Â¿CuÃ¡l de las siguientes alternativas es cierta sobre la tÃ©cnica Delphi?', '0', '0', 'D', 'Cada participante no debe conocer a los demÃ¡s participantes para que la aplicaciÃ³n de la tÃ©cnica Delphi sea exitosa', 'La tÃ©cnica Delphi es mÃ¡s comÃºnmente utilizado para obtener la opiniÃ³n de expertos', 'En la tÃ©cnica Delphi los participantes son generalmente anÃ³nimos', 'Todas las anteriores', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'A, B y C son correctas.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 8, 2),
(10, 'CA-1', 'Normalmente la firma de constituciÃ³n del proyecto es responsabilidad de:', 'Normalmente la firma de constituciÃ³n del proyecto es responsabilidad de:', '0', '0', 'A', 'Patrocinador del Proyecto', 'Altos Ejecutivos', 'Gerente de Proyectos', 'Interesados', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Un sposor vÃ¡lido le da el poder al JP para la direcciÃ³n del proyecto.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 1, 1),
(11, 'CA-1', 'Usted es el director del proyecto de ABC. A medio camino del proyecto se encuentra un componente clave defectuoso . Esto no estaba previsto. El equipo se reuniÃ³ despuÃ©s del evento y se las arreglÃ³ para trabajar con el producto sin el componente defectuoso. Este es un ejemplo de:', 'Usted es el director del proyecto de ABC. A medio camino del proyecto se encuentra un componente clave defectuoso . Esto no estaba previsto. El equipo se reuniÃ³ despuÃ©s del evento y se las arreglÃ³ para trabajar con el producto sin el componente defectuoso. Este es un ejemplo de:', '0', '0', 'D', 'MitigaciÃ³n del riesgo', 'Transferencia de riesgo', 'Trabajar en torno a', 'La aceptaciÃ³n del riesgo de forma pasiva', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'A implica hacer algo para disminuir la probabilidad o el impacto del riesgo. B implica trasladar el impacto a un tercero. C no es una alternativa vÃ¡lida.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 8, 2),
(12, 'CA-1', 'Usted es el director del proyecto de ABC. El proyecto estÃ¡ siendo ejecutado en un Ã¡rea propensa a los terremotos. Para hacerse cargo de esto usted compra un seguro para los terremotos. Este es un ejemplo de;', 'Usted es el director del proyecto de ABC. El proyecto estÃ¡ siendo ejecutado en un Ã¡rea propensa a los terremotos. Para hacerse cargo de esto usted compra un seguro para los terremotos. Este es un ejemplo de;', '0', '0', 'B', 'MitigaciÃ³n del riesgo', 'Transferencia de riesgo', 'Planes de contingencia de riesgos', 'AceptaciÃ³n de las consecuencias de forma pasiva', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Transferir implica trasladar el impacto a un tercero. Un ejemplo de esto es contratar un seguro.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 8, 2),
(15, 'CA-1', 'Â¿CuÃ¡l de las siguientes es una herramienta para el proceso de Control de Calidad?', 'Â¿CuÃ¡l de las siguientes es una herramienta para el proceso de Control de Calidad?', '0', '0', 'A', 'InspecciÃ³n', 'Benchmarking', 'Diagrama de flujo', 'Histograma', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'De las alternativas, A es la Ãºnica H&T indicada en el PMBOK para el Control de la Calidad', '0', '0', '0', '0', '0', '0', '0', '1', 1, 5, 4),
(16, 'CA-1', 'Usted es el director del proyecto ABC. Necesita saber quÃ© tema tiene el mÃ¡ximo impacto en el proyecto. Â¿QuÃ© herramienta se debe utilizar?', 'Usted es el director del proyecto ABC. Necesita saber quÃ© tema tiene el mÃ¡ximo impacto en el proyecto. Â¿QuÃ© herramienta se debe utilizar?', '0', '0', 'A', 'Diagrama de Pareto', 'GrÃ¡fico de control', 'Muestreo estadÃ­stico', 'Diagrama de Ishikawa', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Los diagramas de Pareto se utilizan para identificar las pocas fuentes clave que son responsables de la mayor parte de los problemas.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 5, 2),
(17, 'CA-1', 'Un director de proyecto al planificar la calidad de un proyecto decide utilizar una herramienta. Esta herramienta proporciona una forma creativa para analizar las causas o posibles causas de un problema. Â¿QuÃ© herramienta estÃ¡ planeando usar el Gerente de Proyecto?', 'Un director de proyecto al planificar la calidad de un proyecto decide utilizar una herramienta. Esta herramienta proporciona una forma creativa para analizar las causas o posibles causas de un problema. Â¿QuÃ© herramienta estÃ¡ planeando usar el Gerente de Proyecto?', '0', '0', 'D', 'Diagrama de Pareto', 'GrÃ¡fico de control', 'Muestreo estadÃ­stico', 'Diagrama de Ishikawa', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'El diagrama de Ishikawa, o diagrama de causa-efecto, o diagrama espina de pescado es Ãºtil para relacionar los efectos no deseados sobre la que los que el equipo deberÃ¡ implementar acciones correctivas.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 5, 2),
(19, 'CA-1', 'Usted acaba de ser nombrado Director del proyecto ABC. Usted estÃ¡ tratando de leer la EDT y no puede entender algunos de sus componentes. Â¿CuÃ¡l debe ser su primer paso para entender esto?', 'Usted acaba de ser nombrado Director del proyecto ABC. Usted estÃ¡ tratando de leer la EDT y no puede entender algunos de sus componentes. Â¿CuÃ¡l debe ser su primer paso para entender esto?', '0', '0', 'A', 'Consultar el diccionario de la EDT', 'Consular el enunciado del Alcance', ' Revisar el Acta de ConstituciÃ³n ', 'Ponerse en contacto con el director de proyecto anterior', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'El diccionario de la EDT debiese ser lo primero que se consulta al leer la EDT porque proporciona informaciÃ³n detallada sobre los entregables, actividades y programaciÃ³n de los componentes de la EDT.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 2, 2),
(20, 'CA-2', 'Â¿QuiÃ©n de los siguientes es el responsable de llevar a cabo la validaciÃ³n de alcance?', 'Â¿QuiÃ©n de los siguientes es el responsable de llevar a cabo la validaciÃ³n de alcance?', '0', '0', 'D', 'Director de Proyecto', 'Alta DirecciÃ³n', 'El equipo de calidad', 'El cliente', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Validar el alcance es formalizar la aceptaciÃ³n de los entregables, por lo tanto es una validaciÃ³n que debe hacer el cliente beneficiario del resultado del proyecto.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 2, 4),
(21, 'CA-2', 'Usted estÃ¡ planeando utilizar PERT para la planificaciÃ³n de su proyecto. Una tarea tiene estimaciÃ³n pesimista de 24 dÃ­as, la estimaciÃ³n mÃ¡s probable de 15 dÃ­as y estimaciÃ³n optimista de 12 dÃ­as. Â¿CuÃ¡l es la media utilizando la tÃ©cnica PERT?', 'Usted estÃ¡ planeando utilizar PERT para la planificaciÃ³n de su proyecto. Una tarea tiene estimaciÃ³n pesimista de 24 dÃ­as, la estimaciÃ³n mÃ¡s probable de 15 dÃ­as y estimaciÃ³n optimista de 12 dÃ­as. Â¿CuÃ¡l es la media utilizando la tÃ©cnica PERT?', '0', '0', 'D', ' 18 dÃ­as', '25,5 dÃ­as', '15 dÃ­as', '16 dÃ­as', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'La distribuciÃ³n Beta de PERT se calcula con tE = (tO + 4tM + tP) / 6.\nSi tO=12, tM=15 y tP=24, entonces el tiempo esperado tE es 16, alternativa D.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 3, 2),
(23, 'CA-2', 'Â¿CuÃ¡l de las siguientes alternativas no es cierta acerca de la estimaciÃ³n anÃ¡loga?', 'Â¿CuÃ¡l de las siguientes alternativas no es cierta acerca de la estimaciÃ³n anÃ¡loga?', '0', '0', 'C', 'La estimaciÃ³n se basa en proyectos anteriores', 'No es muy precisa', 'Utiliza el enfoque de abajo hacia arriba', 'Se trata de una forma de juicios de expertos', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'TambiÃ©n se le conoce como EstimaciÃ³n descendente (de arriba hacia abajo), por lo que C es falsa.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 3, 2),
(25, 'CA-2', 'Â¿CuÃ¡l de las siguientes alternativas no es cierta acerca del desaroollo de la  EDT? ', 'Â¿CuÃ¡l de las siguientes alternativas no es cierta acerca del desaroollo de la  EDT? ', '0', '0', 'A', 'La EDT deberÃ­a centrarse en las actividades que se  realizan en el proyecto y no en los entregables', 'El equipo del proyecto debe participar en el desarrollo de la EDT.', 'Como regla general, cada actividad de la EDT debe tener menos de 80 horas. ', 'La EDT se suele representar en una forma jerÃ¡rquica.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'La principal caracterÃ­stica de la EDT es su orientaciÃ³n a los entregables, lo que descarta inmediatamente la alternativa A. C podrÃ­a ser discutible, pero A es categÃ³rica. By C son ciertas.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 2, 2),
(26, 'CA-2', 'Â¿CuÃ¡l de los siguientes procesos produce una EDT como una salida?\n', 'Â¿CuÃ¡l de los siguientes procesos produce una EDT como una salida?\n', '0', '0', 'D', 'Plan de GestiÃ³n del Alcance', 'Iniciar proyecto', 'Definir las Actividades', 'Crear la EDT', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'La EDT es la principal salida del proceso Crear la EDT. A y C no producen una EDT. B no existe.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 2, 2),
(27, 'CA-2', 'Â¿QuÃ© proceso identifica al director del proyecto? ', 'Â¿QuÃ© proceso identifica al director del proyecto? ', '0', '0', 'B', ' Desarrollar el Plan de GestiÃ³n de Proyectos', 'Desarrollar el Acta de ConstituciÃ³n del Proyecto', 'Definir el Alcance', 'Proceso de SelecciÃ³n de Proyectos', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Uno de los objetivos principales del Acta de ConstituciÃ³n del proyecto es nombrar formalmente al Director del Proyecto.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 1, 1),
(28, 'CA-2', 'Usted es el director de proyecto asignado para construir un vehÃ­culo de Ãºltima generaciÃ³n. Usted identifica una dependencia, las ruedas deben ser diseÃ±adas y construidas antes de que se realice el ensamblaje del vehÃ­culo. Este es un ejemplo de quÃ© tipo de dependencia?', 'Usted es el director de proyecto asignado para construir un vehÃ­culo de Ãºltima generaciÃ³n. Usted identifica una dependencia, las ruedas deben ser diseÃ±adas y construidas antes de que se realice el ensamblaje del vehÃ­culo. Este es un ejemplo de quÃ© tipo de dependencia?', '0', '0', 'D', 'Externa', 'Discrecional ', 'Indirecta', 'Obligatoria', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'No se puede hacer el ensamblaje sin que estÃ©n construidas las ruedas; es una dependencia obligatoria interna. No es A porque la restricciÃ³n no viene de afuera de la organizaciÃ³n. No es B porque no se tiene elecciÃ³n. C no existe.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 3, 2),
(29, 'CA-2', 'Usted debe estimar el tiempo para pintar una pared. Usted sabe que toma dos horas para pintar un metro cuadrado de pared. La pared tiene una superficie de 30 metros cuadrados. AsÃ­ que usted estima que se necesitarÃ¡n 60 horas para pintar la pared. Â¿QuÃ© modelo de estimaciÃ³n estÃ¡ usando? ', 'Usted debe estimar el tiempo para pintar una pared. Usted sabe que toma dos horas para pintar un metro cuadrado de pared. La pared tiene una superficie de 30 metros cuadrados. AsÃ­ que usted estima que se necesitarÃ¡n 60 horas para pintar la pared. Â¿QuÃ© modelo de estimaciÃ³n estÃ¡ usando? ', '0', '0', 'B', 'De abajo hacia arriba ', 'EstimaciÃ³n paramÃ©trica', 'AnÃ¡logo ', 'Juicio de expertos', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'La estimaciÃ³n paramÃ©trica utiliza parÃ¡metros en base a informaciÃ³n histÃ³rica para poder estimar la duraciÃ³n de una actividad futura, lo cual corresponde al caso planteado. A, C y D no son correctas.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 3, 2),
(30, 'CA-3', 'Usted es el jefe de proyecto responsable de la construcciÃ³n de un nuevo sitio web. El proyecto se estÃ¡ atrasando. Para llevar el proyecto a tiempo, decide aÃ±adir recursos adicionales a la ruta crÃ­tica. Este es un ejemplo de:', 'Usted es el jefe de proyecto responsable de la construcciÃ³n de un nuevo sitio web. El proyecto se estÃ¡ atrasando. Para llevar el proyecto a tiempo, decide aÃ±adir recursos adicionales a la ruta crÃ­tica. Este es un ejemplo de:', '0', '0', 'C', 'EjecuciÃ³n rÃ¡pida', 'La planificaciÃ³n de recursos ', 'IntensificaciÃ³n', 'GestiÃ³n del Cronograma', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'IntensificaciÃ³n es la tÃ©cnica de compresiÃ³n del cronograma que aporta recursos adicionales a las actividades de la ruta crÃ­tica; opciÃ³n C. A, B y D no son correctas.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 3, 4),
(31, 'CA-3', 'Usted es el director del proyecto ABC. Uno de los riesgos que se han identificado es la deserciÃ³n de los miembros del equipo. A medio camino del proyecto se observa que la moral y la motivaciÃ³n de los miembros del equipo estÃ¡ bajando. Usted piensa que esto es una seÃ±al de que los miembros dejarÃ¡n el equipo. Para este riesgo, la baja motivaciÃ³n es:', 'Usted es el director del proyecto ABC. Uno de los riesgos que se han identificado es la deserciÃ³n de los miembros del equipo. A medio camino del proyecto se observa que la moral y la motivaciÃ³n de los miembros del equipo estÃ¡ bajando. Usted piensa que esto es una seÃ±al de que los miembros dejarÃ¡n el equipo. Para este riesgo, la baja motivaciÃ³n es:', '0', '0', 'B', 'Trabajo torno a', 'Disparador', 'Monitoreo de riesgos', 'PlanificaciÃ³n de riesgos', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Una condiciÃ³n disparadora (o trigger condition) es un evento o situaciÃ³n que indica que un riesgo estÃ¡ por ocurrir.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 8, 4),
(32, 'CA-3', 'Usted estÃ¡ trabajando en el proyecto de la pintura de su casa. Usted identifica una dependencia: la pintura del techo debe comenzar sÃ³lo despuÃ©s de dos dÃ­as de la finalizaciÃ³n de la pintura de las paredes. Este es un ejemplo de:', 'Usted estÃ¡ trabajando en el proyecto de la pintura de su casa. Usted identifica una dependencia: la pintura del techo debe comenzar sÃ³lo despuÃ©s de dos dÃ­as de la finalizaciÃ³n de la pintura de las paredes. Este es un ejemplo de:', '0', '0', 'B', 'Holgura total', 'Dependencia', 'Holgura libre', 'ColchÃ³n', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'No se puede comenzar la pintura del techo sin que estÃ© terminada la pintura de las paredes; es una dependencia obligatoria interna. ', '0', '0', '0', '0', '0', '0', '0', '1', 1, 3, 2),
(33, 'CA-3', 'El Proceso de Realizar el Aseguramiento de Calidad es parte de quÃ© grupo de proceso?', 'El Proceso de Realizar el Aseguramiento de Calidad es parte de quÃ© grupo de proceso?', '0', '0', 'B', 'PlanificaciÃ³n ', 'EjecuciÃ³n ', 'Control ', 'Cierre', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'B es correcta segÃºn las guÃ­as del PMBOK.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 5, 3),
(34, 'CA-3', 'Usted estÃ¡ manejando el proyecto de planificaciÃ³n de una fiesta para los empleados de la compaÃ±Ã­a. Existe el riesgo de que los empleados no asistan a la fiesta. Usted decide no tomar ninguna acciÃ³n en contra dado que la probabilidad de que suceda esto es baja. Â¿QuÃ© estrategia de respuesta al riesgo estÃ¡ siguiendo?', 'Usted estÃ¡ manejando el proyecto de planificaciÃ³n de una fiesta para los empleados de la compaÃ±Ã­a. Existe el riesgo de que los empleados no asistan a la fiesta. Usted decide no tomar ninguna acciÃ³n en contra dado que la probabilidad de que suceda esto es baja. Â¿QuÃ© estrategia de respuesta al riesgo estÃ¡ siguiendo?', '0', '0', 'A', 'AceptaciÃ³n ', 'EvitaciÃ³n ', 'MitigaciÃ³n ', 'Transferencia', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'B implicarÃ­a no hacer la fiesta. C implicarÃ­a hacer algo para reducir la probabilidad o el impacto del riesgo. D serÃ­a entregar el impacto a un tercero. A es correcta.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 8, 4),
(35, 'CA-3', 'El proceso de Efectuar las Adquisiciones es parte de quÃ© grupo de proceso? ', 'El proceso de Efectuar las Adquisiciones es parte de quÃ© grupo de proceso? ', '0', '0', 'B', 'PlanificaciÃ³n ', 'EjecuciÃ³n ', 'Control ', 'Cierre', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'B es correcta segÃºn las guÃ­as del PMBOK.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 9, 3),
(36, 'CA-3', 'Usted es el director del proyecto ABC. Hubo un conflicto entre dos miembros clave del proyecto. Los tres se reunieron y deciden utilizar la colaboraciÃ³n como tÃ©cnica de resoluciÃ³n de conflictos. La colaboraciÃ³n en general conduce a:', 'Usted es el director del proyecto ABC. Hubo un conflicto entre dos miembros clave del proyecto. Los tres se reunieron y deciden utilizar la colaboraciÃ³n como tÃ©cnica de resoluciÃ³n de conflictos. La colaboraciÃ³n en general conduce a:', '0', '0', 'A', 'SituaciÃ³n ganar - ganar', 'SituciÃ³n ganar - perder', 'SituaciÃ³n perder - perder', 'Ninguno de estos', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'B corresponde a la tÃ©cnica Forzar. C no resuelve ningÃºn conflicto. A es correcta.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 6, 3),
(37, 'CA-3', 'Â¿CuÃ¡l de las alternativas siguientes es una herramienta para el proceso Desarrollar el Acta de ConstituciÃ³n?', 'Â¿CuÃ¡l de las alternativas siguientes es una herramienta para el proceso Desarrollar el Acta de ConstituciÃ³n?', '0', '0', 'C', 'MÃ©todo de selecciÃ³n de proyectos', 'MetodologÃ­a de gestiÃ³n de proyectos', 'Juicio de Expertos', ' TÃ©cnica del Valor Ganado', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Las H&T del proceso Desarrollar el Acta de constituciÃ³n del proyecto son el juico experto y las tÃ©cnicas de facilitaciÃ³n.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 1, 1),
(38, 'CA-3', 'Â¿CuÃ¡l de las siguientes opciones indican que el proyecto va bien? Seleccione la mejor opciÃ³n.', 'Â¿CuÃ¡l de las siguientes opciones indican que el proyecto va bien? Seleccione la mejor opciÃ³n.', '0', '0', 'D', 'Una variaciÃ³n de los gastos negativos', 'Un SPI de menos de uno', 'Una variaciÃ³n del cronograma negativo', 'Un CPI mayor que uno.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Si el CPI es menor que 1 muestra ineficiencia porque se gasta mÃ¡s de lo que se trabaja. Cuando el CPI es mayor que 1 indica eficiencia en la utilizaciÃ³n de los recursos.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 4, 4),
(39, 'CA-3', 'Â¿CuÃ¡l de los siguientes no es una entrada para el proceso Efectuar las Adquisiciones?', 'Â¿CuÃ¡l de los siguientes no es una entrada para el proceso Efectuar las Adquisiciones?', '0', '0', 'D', 'Criterios de selecciÃ³n proveedores', 'Decisiones de hacer o comprar', 'Activos de los procesos de la organizaciÃ³n', 'EDT', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'D no es una entrada para el proceso de Efectuar las Adquisiciones. Las entradas para este proceso son: Plan de GestiÃ³n de las Adquisiciones, Documentos de la AdquisiciÃ³n, Criterios de SelecciÃ³n de Proveedores, Propuestas de los Vendedores, Documentos del Proyecto, Decisiones de Hacer o Comprar, Enunciados del Trabajo Relativo a Adquisiciones y Activos de los Procesos de la OrganizaciÃ³n.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 9, 3),
(40, 'CA-4', 'Â¿CuÃ¡l de las siguientes opciones es verdadera acerca de los riesgos?', 'Â¿CuÃ¡l de las siguientes opciones es verdadera acerca de los riesgos?', '0', '0', 'D', 'Si se identifica un riesgo en un plan de respuesta al riesgo, entonces eso significa que el riesgo ya ha ocurrido.', 'Una vez que el riesgo ha pasado, usted se refiere al plan de gestiÃ³n de riesgos para determinar quÃ© acciÃ³n debe tomarse', 'Un riesgo que no estaba planeado, pero ha sucedido se llama un disparador', 'La identificaciÃ³n de los riesgos ocurre en todas las fases del proyecto', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'D es correcto porque la identificaciÃ³n de nuevos riesgos corresponde al proceso Controlar los Riesgos, el cual al corresponder al grupo de proceso de Monitoreo y Control, estÃ¡ vigente durante toda la vida del proyecto.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 8, 4),
(41, 'CA-4', 'Â¿CuÃ¡l de las siguientes alternativas no es cierta acerca del Proceso de Cierre del Proyecto o de Fase?', 'Â¿CuÃ¡l de las siguientes alternativas no es cierta acerca del Proceso de Cierre del Proyecto o de Fase?', '0', '0', 'A', 'Cierre de contratos debe realizarse despuÃ©s del cierre administrativo', 'El riesgo es mÃ¡s bajo en esta etapa del proyecto', 'La probabilidad de finalizaciÃ³n es la mÃ¡s alta en esta etapa del proyecto', 'Los  interesados tienen menor influencia en esta etapa', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'El cierre administrativo es lo Ãºltimo que se hace en el proyecto. Por otro lado, B, C y D son correctas.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 1, 5),
(42, 'CA-4', 'Â¿CuÃ¡l de las siguientes alternativas es una salida del Proceso Identificar los Riesgos?', 'Â¿CuÃ¡l de las siguientes alternativas es una salida del Proceso Identificar los Riesgos?', '0', '0', 'C', 'Lecciones aprendidas', 'Listas de verificaciÃ³n', 'Registro de Riesgos', 'AnÃ¡lisis FODA', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'C es la Ãºnica salida que tiene el proceso de Identificar los riesgos. A, B y D son falsas.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 8, 2),
(43, 'CA-4', 'Â¿En quÃ© proceso del Ã¡rea de conocimiento GestiÃ³n de Riesgos se utilizan valores numÃ©ricos para asignar a la probabilidad y el impacto de los riesgos?', 'Â¿En quÃ© proceso del Ã¡rea de conocimiento GestiÃ³n de Riesgos se utilizan valores numÃ©ricos para asignar a la probabilidad y el impacto de los riesgos?', '0', '0', 'A', 'Realizar el anÃ¡lisis cuantitativo de riesgos', 'Realizar el anÃ¡lisis numÃ©rico de los riesgos', 'Planificar la respuesta a los Riesgos', 'Ninguna de las anteriores', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'En el anÃ¡lisis cuantitativo de los riesgos se analiza numÃ©ricamente el efecto de los riesgos identificados sobre los objetivos del proyecto. B no existe en el PMBOK. C y D no son correctas.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 8, 2),
(46, 'CA-4', 'Describiendo a los interesados en base a su poder (capacidad de imponer la voluntad), urgencia (necesidad de atenciÃ³n inmediata), y legitimidad (su participaciÃ³n ), indique quÃ© a tipo de modelo se refiere?', 'Describiendo a los interesados en base a su poder (capacidad de imponer la voluntad), urgencia (necesidad de atenciÃ³n inmediata), y legitimidad (su participaciÃ³n ), indique quÃ© a tipo de modelo se refiere?', '0', '0', 'D', 'Matriz de Poder / Influencia', 'Modelo de Prominencia', 'Matriz Influencia / Impacto', 'Modelo de alimentaciÃ³n', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'A y C usan 2 variables. B usa las 3 variables descritas. D no aplica.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 10, 1),
(47, 'CA-4', 'Â¿CuÃ¡l de las siguientes opciones describe mejor el proceso del Plan de GestiÃ³n de los interesados?', 'Â¿CuÃ¡l de las siguientes opciones describe mejor el proceso del Plan de GestiÃ³n de los interesados?', '0', '0', 'D', 'CreaciÃ³n y mantenimiento de las relaciones entre el equipo del proyecto y los interesados', 'La prevenciÃ³n de que los interesados â€‹â€‹negativos descarrilen el proyecto', 'Lograr un equilibrio entre las necesidades de las partes interesadas y las necesidades del proyecto', 'Se centra en la creaciÃ³n de la estrategia de gestiÃ³n de los interesados', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Por definiciÃ³n, planificar la gestiÃ³n de interesados es el proceso de desarrollar estrategias de gestiÃ³n adecuadas para lograr la participaciÃ³n eficaz de los interesados.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 10, 2),
(48, 'CA-4', 'El proceso de producciÃ³n se ha definido como parte de un proyecto de fabricaciÃ³n de equipos industriales. El proceso estÃ¡ destinado a producir los pernos de acero con una longitud de 20 cm. Los lÃ­mites de control son 19.955cm y 20.045cm. \nLas mediciones realizadas en el final del proceso obtuvieron los siguientes resultados: \n20.033cm, 19.982cm, 19,995cm, 20.006cm, 19.970cm, 19.968cm,Â 19.963cm, 19.958cm, 19.962cm, 19.979cm, 19.959cm. Â¿QuÃ© debe hacerse?', 'El proceso de producciÃ³n se ha definido como parte de un proyecto de fabricaciÃ³n de equipos industriales. El proceso estÃ¡ destinado a producir los pernos de acero con una longitud de 20 cm. Los lÃ­mites de control son 19.955cm y 20.045cm. \nLas mediciones realizadas en el final del proceso obtuvieron los siguientes resultados: \n20.033cm, 19.982cm, 19,995cm, 20.006cm, 19.970cm, 19.968cm,Â 19.963cm, 19.958cm, 19.962cm, 19.979cm, 19.959cm. Â¿QuÃ© debe hacerse?', '0', '0', 'A', 'El proceso estÃ¡ bajo control. No se debe ajustar', 'El proceso debe ser ajustado', 'Los lÃ­mites de control se deben ajustar', 'El equipo de mediciÃ³n debe ser recalibrado', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Para ajustar el proceso debiesen existir al menos 3 mediciones fuera de los lÃ­mites de control, y este no es el caso.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 5, 2),
(49, 'CA-4', 'Un director de proyecto pasÃ³ algunos dÃ­as creando un documento de varias pÃ¡ginas, al que llamÃ³ constituciÃ³n del proyecto. El patrocinador encontrÃ³ el documento descomunal y pidiÃ³ un documento condensado. Â¿CuÃ¡l de las siguientes alternativas generalmente no es un elemento del Acta de constituciÃ³n del proyecto?', 'Un director de proyecto pasÃ³ algunos dÃ­as creando un documento de varias pÃ¡ginas, al que llamÃ³ constituciÃ³n del proyecto. El patrocinador encontrÃ³ el documento descomunal y pidiÃ³ un documento condensado. Â¿CuÃ¡l de las siguientes alternativas generalmente no es un elemento del Acta de constituciÃ³n del proyecto?', '0', '0', 'B', 'El nivel de autoridad del director del proyecto', 'Cuenta de control detallados y descripciones de los paquetes de trabajo', 'La necesidad de la empresa de que el proyecto se lleve a cabo ', 'Riesgos de alto nivel', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'A, C y D son elementos que se incluyen en el Acta de constituciÃ³n del proyecto. B no corresponde a la fase inicial.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 1, 1),
(50, 'CA-5', 'Un documento llamado ____________ es creado por la descomposiciÃ³n del alcance del proyecto en elementos mÃ¡s pequeÃ±os, mÃ¡s manejables.', 'Un documento llamado ____________ es creado por la descomposiciÃ³n del alcance del proyecto en elementos mÃ¡s pequeÃ±os, mÃ¡s manejables.', '0', '0', 'C', 'Enunciado del Alcance', 'Diagrama de red lÃ³gica', 'Estructura de Desglose del Trabajo', 'Cambio solicitado', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Por definiciÃ³n, EDT es una representaciÃ³n jerÃ¡rquica de los riesgos.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 2, 2),
(51, 'CA-5', 'Â¿CuÃ¡l de las siguientes herramientas se utiliza para crear un plan de gestiÃ³n de riesgos?', 'Â¿CuÃ¡l de las siguientes herramientas se utiliza para crear un plan de gestiÃ³n de riesgos?', '0', '0', 'A', 'Reuniones de planificaciÃ³n de riesgos', 'RevisiÃ³n de documentaciÃ³n', 'ClasificaciÃ³n de la precisiÃ³n de datos', 'TÃ©cnicas de DiagramaciÃ³n', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Las H&T del proceso Planificar le GestiÃ³n de Riesgos son: TÃ©cnicas analÃ­ticas, Juicio de expertos y Reuniones. SÃ³lo A cumple.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 8, 2),
(52, 'CA-5', 'Has encontrado la siguiente informaciÃ³n de anÃ¡lisis de valor ganado para un proyecto que fue recientemente cerrado: SPI = 0,7, el CPI = 1,0', 'Has encontrado la siguiente informaciÃ³n de anÃ¡lisis de valor ganado para un proyecto que fue recientemente cerrado: SPI = 0,7, el CPI = 1,0', '0', '0', 'A', 'El proyecto ha sido cancelado mientras se ejecutaba. En ese momento el proyecto estaba atrasado y dentro del presupuesto.', 'Los entregables del proyecto han sido terminados. El proyecto estaba  atrasado, pero dentro del presupuesto.', 'Los entregables del proyecto han sido terminados. El proyecto  terminÃ³ antes de lo previsto, pero dentro del presupuesto.', 'Los entregables del proyecto han sido terminados. El proyecto terminÃ³ en la fecha prevista, pero por encima del presupuesto.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Cuando el SPI es menor que 1 implica retraso, lo cual automÃ¡ticamente descarta las opciones B, C y D. Por otro lado, CPI = 1 implica estar dentro del prosupuesto.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 4, 4),
(53, 'CA-5', 'EstÃ¡ realizando una auditorÃ­a de la gestiÃ³n de proyectos en su empresa y encuentra que la mayorÃ­a de los planes del proyecto no son consistentes hasta la fecha. Â¿CuÃ¡l de las siguientes alternativas no es cierta?', 'EstÃ¡ realizando una auditorÃ­a de la gestiÃ³n de proyectos en su empresa y encuentra que la mayorÃ­a de los planes del proyecto no son consistentes hasta la fecha. Â¿CuÃ¡l de las siguientes alternativas no es cierta?', '0', '0', 'B', 'Los proyectos no deben ser ejecutados sin un plan de gestiÃ³n del proyecto actualizado y validado.', 'La coherencia del plan de gestiÃ³n de proyectos es secundario, ya que sÃ³lo son los resultados los que importan.', 'Se necesita un gran esfuerzo para desarrollar y actualizar un plan de proyecto, pero los beneficios incluyen menos presiÃ³n sobre todas las partes interesadas y un producto resultante que satisfaga los requisitos.', 'La mala planificaciÃ³n y la insuficiente actualizaciÃ³n de los planes de gestiÃ³n de proyectos son las razones mÃ¡s comunes para el coste y el tiempo de excesos.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'B es tan importante que la actualizaciÃ³n de los planes de gestiÃ³n es una salida recurrente y comÃºn entre muchos procesos del PMBOK.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 1, 4),
(54, 'CA-5', 'Desea realizar la aceptaciÃ³n activa de los riesgos. Â¿QuÃ© debe hacer?', 'Desea realizar la aceptaciÃ³n activa de los riesgos. Â¿QuÃ© debe hacer?', '0', '0', 'A', 'Crear reservas para contingencias en recursos, tiempo y dinero.', 'Desarrollar un plan para minimizar el impacto en caso de que se produzca un riesgo identificado.', 'Desarrollar un plan para minimizar la probabilidad de ocurrencia de los riesgos identificados.', 'Aportar recursos adicionales para acelerar el proyecto.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'A es correcta. B y C corresponden a mitigaciÃ³n. D no corresponde a GestiÃ³n de Riesgos.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 8, 4),
(55, 'CA-5', 'Â¿CuÃ¡ndo normalmente se llevan a cabo las conferencias de licitaciones?', 'Â¿CuÃ¡ndo normalmente se llevan a cabo las conferencias de licitaciones?', '0', '0', 'C', 'DespuÃ©s de que el contrato ha sido adjudicado con alternativas abiertas.', 'DespuÃ©s de la presentaciÃ³n de la oferta o propuesta, pero antes de la adjudicaciÃ³n del contrato.', 'Antes de la presentaciÃ³n de una oferta o propuesta por el oferente.', 'DespuÃ©s de las reuniones tÃ©cnicas con los ofertantes para discutir los requisitos del contrato.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Por definiciÃ³n, las conferencias de oferetes son reuniones entre el comprador y todos los posibles vendedores que se celebran antes de la presentaciÃ³n de ofertas o propuestas.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 9, 3),
(56, 'CA-5', 'Lo que se define por lÃ­mites de control es:', 'Lo que se define por lÃ­mites de control es:', '0', '0', 'C', 'Un instrumento de medida Ãºnicamente para describir la capacidad del proceso. El proceso se encuentra capaz si el rango de Â± 3 sigma es superado por no mÃ¡s de 0,3% de un lote de muestra analizada.', 'Los lÃ­mites de la zona seis sigma a cada lado de un grÃ¡fico de control para representar los valores medidos; datos que se encuentran fuera de la zona estÃ¡n fuera de especificaciÃ³n y pueden conducir a un rechazo de un lote completo.', 'El Ã¡rea que consiste en tÃ­picamente tres desviaciones estÃ¡ndar a cada lado de un valor medio de un grÃ¡fico de control para representar los valores medidos que se encuentran en el control de calidad estadÃ­stico', 'El Ã¡rea que consiste en tÃ­picamente tres desviaciones estÃ¡ndar a cada lado de un valor medio de un grÃ¡fico de control para representar los valores medidos que se encuentran en la garantÃ­a de calidad', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Los lÃ­mites de control estÃ¡n dentro del contexto de la GestiÃ³n de calidad. La definiciÃ³n C es la correcta.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 5, 2),
(57, 'CA-5', 'La lÃ­nea base del alcance consiste enâ€¦', 'La lÃ­nea base del alcance consiste enâ€¦', '0', '0', 'A', 'Enunciado del Alcance, la EDT y el diccionario de la EDT', 'LÃ­nea base de costo, lÃ­nea de base de calidad y lÃ­nea base del cronograma', 'Plan de gestiÃ³n de la configuraciÃ³n y el documento de identificaciÃ³n de la configuraciÃ³n', 'DeclaraciÃ³n de ContrataciÃ³n de la obra y la declaraciÃ³n del alcance del proyecto', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'SÃ³lo A es correcta segÃºn las guÃ­as del PMBOK.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 2, 2),
(58, 'CA-5', 'Â¿QuÃ© no se considera normalmente como un elemento de Costo de conformidad?', 'Â¿QuÃ© no se considera normalmente como un elemento de Costo de conformidad?', '0', '0', 'D', 'Los costos de prevenciÃ³n', 'El costo de mantenimiento', 'Los costos de evaluaciÃ³n', 'Los costos de fallos', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'D es un costo en el que se incurre cuando ya ha ocurrido una falla. Los costos de conformidad son aquellos en los que se incurre para evitar los fallos, como por ejemplo A, B y C.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 5, 2),
(60, 'CA-6', 'Â¿QuÃ© significa la sigla RACI comÃºnmente usado en la gestiÃ³n de proyectos?', 'Â¿QuÃ© significa la sigla RACI comÃºnmente usado en la gestiÃ³n de proyectos?', '0', '0', 'A', 'Responsable, aprobador, a ser consultados, a ser informado', 'Remoto, unido, conectado, integrado', 'AnÃ¡lisis de Riesgos y la Iniciativa de AtenciÃ³n', 'Aleatoriamente Accesible InformaciÃ³n Flujo de caja', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'RACI viene del inglÃ©s Responsable Accountable Consulted Informed. En espaÃ±ol, alternativa A.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 6, 2),
(61, 'CA-6', 'Â¿CuÃ¡l de las siguientes no se incluye en un plan de gestiÃ³n de riesgos?', 'Â¿CuÃ¡l de las siguientes no se incluye en un plan de gestiÃ³n de riesgos?', '0', '0', 'B', 'Roles y responsabilidades para el manejo de los riesgos del proyecto', 'Calendario de actividades de gestiÃ³n de riesgos del proyecto', 'El enfoque metodolÃ³gico utilizado para la gestiÃ³n del riesgo', 'Riesgos individuales y posibles respuestas a ellos', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'A, C y D deben incluirse en el plan de gestiÃ³n de riesgos.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 8, 2),
(62, 'CA-6', 'Se ha hecho la estimaciÃ³n de que la construcciÃ³n de una casa residencial costarÃ¡ una cierta cantidad por metro cuadrado de superficie habitable. Este es un ejemplo de quÃ© tipo de estimaciÃ³n?', 'Se ha hecho la estimaciÃ³n de que la construcciÃ³n de una casa residencial costarÃ¡ una cierta cantidad por metro cuadrado de superficie habitable. Este es un ejemplo de quÃ© tipo de estimaciÃ³n?', '0', '0', 'D', 'EstimaciÃ³n anÃ¡loga', 'EstimaciÃ³n de abajo hacia arriba', 'EstimaciÃ³n de arriba hacia abajo', 'EstimaciÃ³n paramÃ©trica', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'En D se calcula el costo sobre la base de datos histÃ³ricos y/o parÃ¡metros del proyecto.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 3, 2),
(63, 'CA-6', 'Â¿QuÃ© es cierto para los prototipos?', 'Â¿QuÃ© es cierto para los prototipos?', '0', '0', 'B', 'Prototipos provoca costos significativos y debe evitarse siempre que sea posible.', 'Son tangibles y permiten una retroalimentaciÃ³n temprana de las necesidades de los interesados.', 'Los prototipos se desarrollan generalmente hacia el final de una fase de diseÃ±o o construcciÃ³n .', 'Los prototipos aumentan el riesgo de malentendidos entre los desarrolladores y los usuarios.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Por definiciÃ³n, el desarrollo de prototipos es un mÃ©todo para obtener una retroalimentaciÃ³n rÃ¡pida en relaciÃ³n con los requisitos, mientras proporciona un modelo operativo del producto esperado antes de construirlo.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 2, 2),
(64, 'CA-6', 'Â¿QuÃ© es un cambio constructivo?', 'Â¿QuÃ© es un cambio constructivo?', '0', '0', 'A', 'Una solicitud de cambio que ayuda a mejorar el proyecto y su producto, servicio o resultado y se analiza generalmente en un estilo amigable.', 'Una orden del comprador o una acciÃ³n tomada por el vendedor que la otra parte considera  un cambio no documentado en el contrato.', 'Una modificaciÃ³n de un campo o un cambio ad-hoc ordenado por el cliente en un proyecto de construcciÃ³n pÃºblica.', 'Una solicitud de cambio que conducirÃ¡ a la re-construcciÃ³n de una versiÃ³n anterior  de lÃ­nea base de rendimiento del proyecto por parte del contratista.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'SÃ³lo A es correcta en el contexto del control de las adquisiciones.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 9, 4),
(65, 'CA-6', 'Una revisiÃ³n para determinar si las actividades del proyecto cumplen con las polÃ­ticas, procesos y procedimientos de la organizaciÃ³n y el proyecto se denomina comÃºnmenteâ€¦', 'Una revisiÃ³n para determinar si las actividades del proyecto cumplen con las polÃ­ticas, procesos y procedimientos de la organizaciÃ³n y el proyecto se denomina comÃºnmenteâ€¦', '0', '0', 'A', 'AuditorÃ­as de calidad', 'InspecciÃ³n', 'Pruebas de calidad', 'Rechazar la detecciÃ³n', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'A es la Ãºnica de las alternativas que cumple con la definiciÃ³n.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 5, 3),
(66, 'CA-6', 'Durante un evento de la empresa, tuvo la oportunidad de hablar con un gerente de proyecto colega. Ã‰l le dijo que en su proyecto actual los costos reales son un 15% menos de los gastos acumulados presupuestados para hoy.\nÂ¿QuÃ© piensa usted?', 'Durante un evento de la empresa, tuvo la oportunidad de hablar con un gerente de proyecto colega. Ã‰l le dijo que en su proyecto actual los costos reales son un 15% menos de los gastos acumulados presupuestados para hoy.\nÂ¿QuÃ© piensa usted?', '0', '0', 'A', 'La informaciÃ³n dada por el colega no es suficiente para evaluar el desempeÃ±o del proyecto.', 'El proyecto probablemente se completarÃ¡ con los costos totales que quedan por debajo del presupuesto hasta el final.', 'Un aumento de costos significativo durante el curso ulterior del proyecto probablemente traerÃ¡ los costes de nuevo a nivel de la lÃ­nea base.', 'La original previsiÃ³n de costes y presupuestos para el proyecto deben haber sido pobres para  permitir esta variaciÃ³n.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Que exista un ahorro en el presupuesto del proyecto no es un dato positivo por sÃ­ sÃ³lo. Debe conocerse el avance del cronograma para tener una opiniÃ³n completa del estado del proyecto.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 4, 4);
INSERT INTO `pregunta` (`pregunta_id`, `excel_id`, `pregunta_es`, `pregunta_us`, `imagen_es`, `imagen_us`, `respuesta`, `opcion_aes`, `opcion_bes`, `opcion_ces`, `opcion_des`, `opcion_aus`, `opcion_bus`, `opcion_cus`, `opcion_dus`, `comentario_aes`, `comentario_bes`, `comentario_ces`, `comentario_des`, `comentario_aus`, `comentario_bus`, `comentario_cus`, `comentario_dus`, `nivel_dificultad`, `estado`, `area_id`, `grupo_id`) VALUES
(67, 'CA-6', 'Â¿CuÃ¡l es la curva S en gestiÃ³n de proyectos?', 'Â¿CuÃ¡l es la curva S en gestiÃ³n de proyectos?', '0', '0', 'D', 'Un grÃ¡fico que se genera si una curva normal estÃ¡ integrado.', 'Un grÃ¡fico que se va a integrar para generar una curva normal.', 'Una descripciÃ³n metafÃ³rica de las incertidumbres a corto plazo que estÃ¡n presentes en todos los proyectos.', 'El grÃ¡fico que describe el crecimiento del valor ganado durante el curso del proyecto.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'La Curva S es la representaciÃ³n grÃ¡fica mÃ¡s utilizada para visualizar los datos de Valor Ganado.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 4, 4),
(68, 'CA-6', 'Una salida del proceso Planificar la GestiÃ³n de RRHH es un documento llamado "Plan de GestiÃ³n de los RRHH". En Ã©l se identifican los tipos y cantidades de recursos...', 'Una salida del proceso Planificar la GestiÃ³n de RRHH es un documento llamado "Plan de GestiÃ³n de los RRHH". En Ã©l se identifican los tipos y cantidades de recursos...', '0', '0', 'B', '... mientras que los recursos plazo se limita a equipos y materiales.', '... necesarios para cada actividad en un paquete de trabajo.', '... mientras que los recursos plazo se limita a los recursos humanos.', '... ser procedente Ãºnicamente de la organizaciÃ³n ejecutante.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'SÃ³lo B es correcta segÃºn las guÃ­as del PMBOK', '0', '0', '0', '0', '0', '0', '0', '1', 1, 6, 2),
(69, 'CA-6', 'Â¿CuÃ¡l enunciado describe mejor el significado de la expresiÃ³n lÃ­nea base costo?', 'Â¿CuÃ¡l enunciado describe mejor el significado de la expresiÃ³n lÃ­nea base costo?', '0', '0', 'B', 'Una lÃ­nea base de costo siempre se crea mediante la traducciÃ³n de la informaciÃ³n de costos de fase temporal en los datos de costes de la actividad o paquete de trabajo de nivel.', 'Es una referencia del presupuesto aprobado, que se utiliza para medir y monitorear el desempeÃ±o del costo del proyecto.', 'Los datos para elaborar una lÃ­nea base de coste se pueden generar con facilidad y actualizan en la medida necesaria de informaciÃ³n relacionada con el coste real del proyecto.', 'Una lÃ­nea base de costo por lo general aparece en la forma de una S-curva inversa trazada desde el inicio del proyecto hasta la fecha de los datos.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'SÃ³lo B es correcta segÃºn las guÃ­as del PMBOK', '0', '0', '0', '0', '0', '0', '0', '1', 1, 4, 2),
(73, 'CA-7', 'Andrea acaba de escuchar a alguien hacer referencia al RAM con otro tÃ©rmino  Â¿CuÃ¡l era el tÃ©rmino?', 'Andrea acaba de escuchar a alguien hacer referencia al RAM con otro tÃ©rmino  Â¿CuÃ¡l era el tÃ©rmino?', '0', '0', 'A', 'Matriz de responsabilidades', 'Carta Gantt', 'Organigrama', 'Estructura de desglose organizacional', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'RAM en inglÃ©s es Responsibility Assignment Matrix, que significa Matriz de AsignaciÃ³n de Responsabilidades. Un tipo de RAM es la matriz RACI.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 6, 2),
(75, 'CA-7', 'Marlene se estÃ¡ preparando para exponer el informe del rendimiento de ingresos. Â¿CuÃ¡l de los siguientes temas no estarÃ¡ en su plan de enseÃ±anza  para la clase?', 'Marlene se estÃ¡ preparando para exponer el informe del rendimiento de ingresos. Â¿CuÃ¡l de los siguientes temas no estarÃ¡ en su plan de enseÃ±anza  para la clase?', '0', '0', 'B', 'Finalizacion proyectada', 'Requerimiento de cambio aprobado', 'Medicion del control de calidad', 'Informe de rendimiento', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'B es la Ãºnica alternativa que no se relaciona con el tema que es control del rendimiento.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 4, 4),
(78, 'CA-7', 'Gregorio Harding, Director de proyecto,  ha llegado al final de su proyecto con TKP Producciones; quÃ© debe utilizar Gregory para englobar los aspectos positivos y negativos del proyecto en su totalidad?', 'Gregorio Harding, Director de proyecto,  ha llegado al final de su proyecto con TKP Producciones; quÃ© debe utilizar Gregory para englobar los aspectos positivos y negativos del proyecto en su totalidad?', '0', '0', 'B', 'SituaciÃ³n de informe de alcance', 'DocumentaciÃ³n sobre lecciones aprendidas', 'Un informe de cierre administrativo', 'Un  grÃ¡fico de Milestone', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'La descripciÃ³n corresponde a B. A, C y D no son correctas.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 1, 5),
(80, 'CA-8', 'En una reuniÃ³n de proyecto, Keith Harlow,  Director del Proyecto, se enterÃ³ de que no todas las partes interesadas estaban recibiendo los datos y actualizaciones de manera oportuna. Â¿CuÃ¡l de las siguientes aternativas no se verÃ­an afectadas necesariamente en sus esfuerzos para resolver el problema?', 'En una reuniÃ³n de proyecto, Keith Harlow,  Director del Proyecto, se enterÃ³ de que no todas las partes interesadas estaban recibiendo los datos y actualizaciones de manera oportuna. Â¿CuÃ¡l de las siguientes aternativas no se verÃ­an afectadas necesariamente en sus esfuerzos para resolver el problema?', '0', '0', 'D', 'Proceso de distribuciÃ³n de la informaciÃ³n', 'Plan de gestiÃ³n de proyectos', 'Plan de GestiÃ³n de las Comunicaciones', 'RecopilaciÃ³n de informaciÃ³n y actualizaciÃ³n del proceso', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'A es lo que fallÃ³, por lo tanto se verÃ¡ afectado con la correcciÃ³n. C se debe actualizar, y C es parte de B, por lo tanto tambiÃ©n se ven afectados. D es corregir el incidente y actualizar la documentaciÃ³n necesaria para que no vuelva a ocurrir.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 7, 4),
(81, 'CA-8', 'Al haber sido asignado como Director de un Proyecto usted nota durante la ejecuciÃ³n del proyecto que existen conflictos en el equipo, de Ã­ndole tÃ©cnico e interpersonal. Â¿CuÃ¡l de las siguientes es una  apropiada manera para manejar conflictos?', 'Al haber sido asignado como Director de un Proyecto usted nota durante la ejecuciÃ³n del proyecto que existen conflictos en el equipo, de Ã­ndole tÃ©cnico e interpersonal. Â¿CuÃ¡l de las siguientes es una  apropiada manera para manejar conflictos?', '0', '0', 'C', 'Conflictos distraen al equipo e interrumpen el ritmo de trabajo. Usted siempre debe  suavizarlos cuando salen a la superficie', 'Un conflicto debe ser manejado en una reuniÃ³n a fin de que todo el equipo puede participar en la bÃºsqueda de una soluciÃ³n. ', 'Los conflictos deben abordarse temprano y por lo general en privado, mediante un enfoque directo y participativo', 'Usted debe utilizar su poder coercitivo para resolver rÃ¡pidamente los conflictos y luego centrarse en el cumpiemiento de los objetivos', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'El enfoque de C genera compromiso en los involucrados en el conflicto, por lo que es menos probable que se repita en el futuro.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 6, 3),
(82, 'CA-8', 'Â¿CuÃ¡l es el propÃ³sito del Acta de ConstituciÃ³n?', 'Â¿CuÃ¡l es el propÃ³sito del Acta de ConstituciÃ³n?', '0', '0', 'A', 'Autorizar formalmente un proyecto o una fase y documentar los requisitos iniciales \nque satisfagan las necesidades y expectativas de las partes interesadas.', 'Para documentar cÃ³mo se planificarÃ¡ el proyecto, ejecutado, supervisado / controlado y cerrado.', 'Para vincular el proyecto, que va a ser planificado, ejecutado y monitoreado / controlado a la labor que realiza la organizaciÃ³n. ', 'Para describir el proceso de realizaciÃ³n de los trabajos definidos en el proyecto plan de gestiÃ³n a fin de lograr los objetivos del proyecto.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'El acta de constituciÃ³n busca: formalizar el inicio del proyecto/fase, nombrar al director del proyecto, alinear objetivos de alto nivel con los interesados.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 1, 1),
(85, 'CA-8', 'El Plan de GestiÃ³n de las Comunicaciones es un documento que incluye las descripciones deâ€¦', 'El Plan de GestiÃ³n de las Comunicaciones es un documento que incluye las descripciones deâ€¦', '0', '0', 'C', 'Informes de rendimiento a nivel de proyecto ', 'Informes de estado Nivel de actividad ', 'Requisitos de comunicaciÃ³n de las partes interesadas ', 'AsignaciÃ³n de responsabilidades', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'C es una de los principales contenidos del Plan de GestiÃ³n de Comunicaciones.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 7, 2),
(88, 'CA-8', 'Como el director del proyecto que decidiÃ³ organizar una reuniÃ³n de equipo para identificar y analizar las lecciones aprendidas a partir del control de calidad con las partes interesadas. Â¿QuÃ© debe hacer con ellos? ', 'Como el director del proyecto que decidiÃ³ organizar una reuniÃ³n de equipo para identificar y analizar las lecciones aprendidas a partir del control de calidad con las partes interesadas. Â¿QuÃ© debe hacer con ellos? ', '0', '0', 'A', 'Documentar y hacerlos parte de la base de datos histÃ³rica para el proyecto y la organizaciÃ³n ejecutante', 'Publicarlas en el boletÃ­n de la empresa. ', 'Hablar abiertamente con la administraciÃ³n y asegurarse de que se mantienen lo contrario confidencial ', 'Siga sus decisiones estratÃ©gicas, independiente de las lecciones aprendidas. Estas decisiones se han hecho y deben ser implementados lo son los resultados.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Las lecciones aprendidas deben documentarse para en proyectos futuros: no repetir los errores y repetir los aciertos.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 1, 5),
(89, 'CA-8', 'Â¿CuÃ¡l de los siguientes documentos no se utiliza como entrada para el proceso de Validar el alcance? ', 'Â¿CuÃ¡l de los siguientes documentos no se utiliza como entrada para el proceso de Validar el alcance? ', '0', '0', 'D', 'El plan de gestiÃ³n del proyecto, que contiene la lÃ­nea base del alcance que consiste en el enunciado del alcance del proyecto y su EDT y el diccionario de la EDT. ', 'Los entregables validados, completado y verificados.', 'La matriz de trazabilidad de requisitos, que une los requisitos desde su origen y la localizaciÃ³n a lo largo del ciclo de vida del proyecto. ', 'La matriz RACI, que describe las responsabilidades en caso de rechazo del producto', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'De las alternativas, D es la Ãºnica que no se incluye en las salidas del proceso Validar el alcance', '0', '0', '0', '0', '0', '0', '0', '1', 1, 2, 4),
(90, 'CA-9', 'SegÃºn Bruce Tuckman, Â¿cuÃ¡les son  las etapas de desarrollo del equipo? ', 'SegÃºn Bruce Tuckman, Â¿cuÃ¡les son  las etapas de desarrollo del equipo? ', '0', '0', 'B', 'Luna de miel, el rechazo, la regresiÃ³n, la aceptaciÃ³n, el reingreso ', 'FormaciÃ³n, turbulencia, normalizaciÃ³n, desempeÃ±o, disoluciÃ³n', 'Decir, vender, consultar, unirse ', 'Directa, el apoyo, el entrenador, delegado', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'A, C y D no son correctos. SÃ³lo B menciona las etapas correctas de Tuckman.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 6, 3),
(91, 'CA-9', 'CuÃ¡l de las siguientes no es una razÃ³n para que las empresas organicen lecciones aprendidas? ', 'CuÃ¡l de las siguientes no es una razÃ³n para que las empresas organicen lecciones aprendidas? ', '0', '0', 'B', 'Las bases de datos de Lecciones aprendidas son un elemento esencial de los activos de los procesos de la organizaciÃ³n. ', 'Las lecciones aprendidas deben centrarse en la identificaciÃ³n de las personas responsables de los errores y fracasos. ', 'Las Sesiones de Lecciones aprendidas deben extraer las recomendaciones para mejorar el desempeÃ±o de los futuro  proyectos. ', 'Lecciones aprendidas proporcionan un buen ejercicio de desarrollo de equipo para el personal del proyecto.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Las lecciones aprendidas no buscan identificar personas responsables, sino que documentar lo que se ha hecho bien para replicarlo en el futuro, y tambiÃ©n lo que se ha hecho mal para no volver a hacerlo.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 1, 5),
(92, 'CA-9', 'Â¿QuÃ© documento se desarrolla a lo largo de los procesos desde identificar los riesgos hasta realizar el anÃ¡lisis cualitativo del riesgo para controlarlos? ', 'Â¿QuÃ© documento se desarrolla a lo largo de los procesos desde identificar los riesgos hasta realizar el anÃ¡lisis cualitativo del riesgo para controlarlos? ', '0', '0', 'B', 'Lista de los factores desencadenantes de riesgo ', 'Registro de riesgos', 'La mitigaciÃ³n del riesgo', 'Ãrbol de decisiÃ³n', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'B es el documento en el que se registran los resultados del anÃ¡lisis de riesgos y de la planificaciÃ³n de la respuesta a los riesgos. A, C y D podrÃ­an estar contenidos en B.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 8, 2),
(93, 'CA-9', 'Un cliente estÃ¡ exigiendo un cambio de Ã¡mbito menor y espera que usted haga esto sin retrasos y costes adicionales. Usted cree que tiene la autorizaciÃ³n adecuada para tomar la decisiÃ³n por sÃ­ mismo, pero no estÃ¡n muy seguros. Â¿CuÃ¡les deben ser sus prÃ³ximos pasos? ', 'Un cliente estÃ¡ exigiendo un cambio de Ã¡mbito menor y espera que usted haga esto sin retrasos y costes adicionales. Usted cree que tiene la autorizaciÃ³n adecuada para tomar la decisiÃ³n por sÃ­ mismo, pero no estÃ¡n muy seguros. Â¿CuÃ¡les deben ser sus prÃ³ximos pasos? ', '0', '0', 'D', 'Un cambio solicitado es siempre una oportunidad para conseguir mÃ¡s dinero pagado por el cliente y resolver en secreto horario y los problemas de calidad. Usted debe hacer algunas estimaciones razonables sobre el tiempo, los costos, los riesgos, etc y luego aÃ±adir un buen margen por encima de eso para calcular el nuevo precio. ', 'La satisfacciÃ³n del cliente es su mÃ¡xima prioridad. El cliente le da una oportunidad de aumentar su satisfacciÃ³n, que se debe utilizar para el mÃ¡ximo beneficio. La mayorÃ­a de los gerentes de proyecto tienen contingencias para cubrir los riesgos; estos pueden ser utilizados para pagar los costes adicionales. ', 'Antes de tomar una decisiÃ³n que usted debe tener una mirada en el estacionamiento del cliente. ', 'Maneje la solicitud de cambio con los procesos de control de cambios integrados descritos en sus planes de gestiÃ³n. Luego tome una decisiÃ³n junto con el equipo de control de cambio considerando: si habrÃ¡ aumento de la satisfacciÃ³n del cliente, el valor de los costos adicionales, el trabajo, los riesgos, etc.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Todo lo que pueda afectar a la Ã©tica del jefe de proyecto se descarta como buena prÃ¡ctica (A y C). Las reservas de contingencia son para pagar costos adicionales, pero no producto de cambios al alcance sino que producto de errores o fallas en el proyecto.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 1, 4),
(94, 'CA-9', 'Como director de un proyecto de software que se inicia en la actualidad, desea evaluar los riesgos de alto nivel. Â¿QuÃ© debe hacer? ', 'Como director de un proyecto de software que se inicia en la actualidad, desea evaluar los riesgos de alto nivel. Â¿QuÃ© debe hacer? ', '0', '0', 'A', 'Desarrollar el acta de constituciÃ³n del proyecto.', 'Identificar y analizar los eventos de riesgo utilizando tÃ©cnicas cualitativas y cuantitativas. ', 'Desarrollar planes de contingencia y planes de repliegue en caso de que el plan original demuestra que estÃ¡n equivocados. ', 'Hable de los riesgos documentados en el registro de riesgos con los principales interesados â€‹â€‹en el proyecto.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'A es lo indicado para un proyecto que se estÃ¡ iniciando y que en general tiene un contenido de alto nivel.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 1, 1),
(95, 'CA-9', 'Un diccionario de la EDT es un documento en el que... ', 'Un diccionario de la EDT es un documento en el que... ', '0', '0', 'B', '... Describe los tÃ©rminos tÃ©cnicos utilizados para la gestiÃ³n del alcance. ', '... Describe los detalles de cada componente de la EDT. ', '... Se traducen tÃ©rminos EDT esenciales para los equipos de proyectos globales. ', '... Ayuda a traducir funcional en los requisitos tÃ©cnicos.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'El diccionario de la EDT es un documento que proporciona informaciÃ³n detallada sobre los entregables, actividades y programaciÃ³n de los componentes de la EDT.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 2, 2),
(96, 'CA-9', 'Como jefe de proyecto, cuando se debe tomar en cuenta sobre todo las diferencias culturales? ', 'Como jefe de proyecto, cuando se debe tomar en cuenta sobre todo las diferencias culturales? ', '0', '0', 'D', 'Cuando usted analiza posibilidades de crear una estructura de desglose del trabajo (WBS). ', 'Cuando se asigna un recurso humano para hacer el trabajo en una actividad del cronograma. ', 'Al desarrollar los criterios de aceptaciÃ³n de los resultados del trabajo que deben alcanzarse en los miembros del equipo. ', 'Cuando usted decide sobre el reconocimiento y premios durante el desarrollo del equipo.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'La manera en que una percibe un premio o reconocimiento puede variar de una cultura a otra. A, B y C son mÃ¡s actividades objetivas.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 6, 3),
(97, 'CA-9', 'Al comienzo de la ejecuciÃ³n del proyecto, se da cuenta de diferencias de opiniones entre los miembros del equipo relacionados con el trabajo del proyecto y de los resultados y el nivel de complejidad general. Â¿QuÃ© debe hacer en este momento? ', 'Al comienzo de la ejecuciÃ³n del proyecto, se da cuenta de diferencias de opiniones entre los miembros del equipo relacionados con el trabajo del proyecto y de los resultados y el nivel de complejidad general. Â¿QuÃ© debe hacer en este momento? ', '0', '0', 'D', 'Dar a sus miembros del equipo algÃºn tiempo para desarrollar un entendimiento comÃºn del alcance del proyecto y el alcance del producto. Problemas de interfaz PrÃ³ximos pueden resolverse mÃ¡s tarde. ', 'Utilice los procesos de gestiÃ³n de riesgos para identificar y evaluar los riesgos causados â€‹â€‹por malentendidos y desarrollar un plan con medidas con el fin de responder a ellas. ', 'Organizar reuniones para identificar y resolver los malentendidos entre los miembros del equipo con el fin de evitar problemas de interfaz, la desintegraciÃ³n y la reanudaciÃ³n costosa al principio del proyecto. ', 'Utilice entrevistas en privado con cada miembro del equipo para informarles de sus expectativas y sus necesidades en un ambiente de confianza.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'A toma actitud pasiva, y siempre se recomienda la proactividad. B no aplica. C menciona el principio del proyecto, pero ya se estÃ¡ en la ejecuciÃ³n. D es lo mÃ¡s apropiado.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 6, 3),
(98, 'CA-9', 'Usted acaba de tomar el control como encargado de un proyecto que va a crear muchos beneficios para la organizaciÃ³n ejecutante, pero usted detecta un alto nivel de resistencia en varias partes interesadas desde el principio. Â¿CuÃ¡l es la acciÃ³n mÃ¡s apropiada para resolver el problema? ', 'Usted acaba de tomar el control como encargado de un proyecto que va a crear muchos beneficios para la organizaciÃ³n ejecutante, pero usted detecta un alto nivel de resistencia en varias partes interesadas desde el principio. Â¿CuÃ¡l es la acciÃ³n mÃ¡s apropiada para resolver el problema? ', '0', '0', 'C', 'Desarrollar una matriz de asignaciÃ³n de responsabilidades (RAM) que muestra claramente la responsabilidad de cada actor de las diversas actividades del proyecto y que debe ser consultado e informado. ', 'Desarrollar un diagrama de organizaciÃ³n, lo que coloca a cada una de las partes interesadas en una posiciÃ³n apropiada dentro del proyecto y permite ciertas lÃ­neas de comunicaciÃ³n, mientras rechazando otros. ', 'Programar una reuniÃ³n con estos actores para presentar el proyecto y establecer criterios bÃ¡sicos, asegurar su participaciÃ³n e identificar las cuestiones personales y organizativas iniciales. ', 'No hablar con estos grupos de interÃ©s demasiado en este momento, en lugar crear hechos consumados, que mÃ¡s tarde se le obligarÃ¡ a las partes interesadas a apoyar el proyecto debido a la falta de alternativas para ellos.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'A y B no aplican. Nunca se recomienda evadir como en D. La recomendaciÃ³n es enfrentar (gestionar) los problemas o riesgos.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 10, 4),
(100, 'CA-1', 'Usted es el director del proyecto para el desarrollo de un nuevo tipo de central elÃ©ctrica. \nSu proyecto estÃ¡ avanzando rÃ¡pidamente, y es cada vez mÃ¡s cerca del dÃ­a de la aceptaciÃ³n del producto. Â¿QuÃ© tÃ©cnica serÃ¡ mÃ¡s importante para la aceptaciÃ³n del producto? ', 'Usted es el director del proyecto para el desarrollo de un nuevo tipo de central elÃ©ctrica. \nSu proyecto estÃ¡ avanzando rÃ¡pidamente, y es cada vez mÃ¡s cerca del dÃ­a de la aceptaciÃ³n del producto. Â¿QuÃ© tÃ©cnica serÃ¡ mÃ¡s importante para la aceptaciÃ³n del producto? ', '0', '0', 'B', 'InspecciÃ³n', 'AuditorÃ­a de calidad ', 'AnÃ¡lisis del impacto ', 'Equipo de revisiÃ³n', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Uno de los objetivos de las auditorÃ­as de calidad es identificar las no conformidades, las brechas y los defectos, lo que resulta en una mayor aceptaciÃ³n del producto por parte del cliente.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 5, 3),
(103, 'CA-1', 'Â¿los criterios de aceptaciÃ³n del producto deben establecerse en quÃ© documento? ', 'Â¿los criterios de aceptaciÃ³n del producto deben establecerse en quÃ© documento? ', '0', '0', 'D', 'Enunciado del alcance del proyecto ', 'Estructura de desglose del trabajo ', 'Asignaciones de recursos ', 'Plan de gestiÃ³n del alcance del proyecto ', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'En general, los planes de gestiÃ³n para las distintas Ã¡reas de conocimiento son las que documentan las "reglas del juego" (en este caso los criterios) que se van a aplicar durante la ejecuciÃ³n y cierre.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 2, 2),
(104, 'CA-1', 'Â¿La lÃ­nea base de costo se desarrolla durante cual de los siguientes procesos? ', 'Â¿La lÃ­nea base de costo se desarrolla durante cual de los siguientes procesos? ', '0', '0', 'D', 'Realizar el control integrado de cambios ', 'Estimar costos ', 'Desarrollar el cronograma', 'Determinar el presupuesto', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'A y C no apuntan a los costos. B estima los costos de las actividades, no del proyecto completo. D se refiere al costo del proyecto total, lo que se pasa a ser la lÃ­nea base de costos cuando es aprobada.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 4, 2),
(105, 'CA-1', 'La lÃ­nea base del alcance incluye ____ ', 'La lÃ­nea base del alcance incluye ____ ', '0', '0', 'D', 'Los diversos planes de gestiÃ³n del proyecto ', 'Horario previsto y el costo de lÃ­nea de base ', 'ID de configuraciÃ³n del producto y la declaraciÃ³n de trabajo ', 'EDT, Diccionario de la EDT y enunciado del alcance', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'D es la Ãºnica que incluye el contenido de la lÃ­nea base del alcance segÃºn el PMBOK.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 2, 2),
(106, 'CA-1', 'Durante la planificaciÃ³n de los recursos humanos se ha identificado que los miembros del equipo no estÃ¡n suficientemente cualificados para sus tareas. Â¿QuÃ© puede ser una soluciÃ³n adecuada a este problema?', 'Durante la planificaciÃ³n de los recursos humanos se ha identificado que los miembros del equipo no estÃ¡n suficientemente cualificados para sus tareas. Â¿QuÃ© puede ser una soluciÃ³n adecuada a este problema?', '0', '0', 'B', 'Reducir el nivel de esfuerzo ', 'Desarrollar un plan de capacitaciÃ³n ', 'AuditorÃ­as de calidad del Plan ', 'Inspecciones de calidad del Plan', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'A no aplica. C y D no corresponden a planificaciÃ³n. B es una alternativa para bordar la falta de capacidades.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 6, 2),
(107, 'CA-1', 'El ________ es un documento que describe cÃ³mo el equipo de gestiÃ³n de proyectos pondrÃ¡ en prÃ¡ctica la polÃ­tica de calidad de la organizaciÃ³n ejecutante.  ', 'El ________ es un documento que describe cÃ³mo el equipo de gestiÃ³n de proyectos pondrÃ¡ en prÃ¡ctica la polÃ­tica de calidad de la organizaciÃ³n ejecutante.  ', '0', '0', 'B', 'Plan de aseguramiento de la calidad ', 'Plan de gestiÃ³n de la calidad ', 'Compromiso con la calidad ', 'AuditorÃ­a de calidad', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Por definiciÃ³n, el plan de gestiÃ³n de la calidad describe cÃ³mo se implementarÃ¡n la polÃ­ticas de calidad de una organizaciÃ³n.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 5, 2),
(109, 'CA-1', 'Los interesados del proyecto le han propuesto a Juan, que es el director del proyecto, algunos cambios de poca importancia. Al ver Juan la magnitud de los cambios ha decidido que no requiere ninguna aprobaciÃ³n para implementarlos. Â¿Cree ud. que Juan estarÃ¡ actuando correctamente?', 'Los interesados del proyecto le han propuesto a Juan, que es el director del proyecto, algunos cambios de poca importancia. Al ver Juan la magnitud de los cambios ha decidido que no requiere ninguna aprobaciÃ³n para implementarlos. Â¿Cree ud. que Juan estarÃ¡ actuando correctamente?', '0', '0', 'A', 'No, todos los cambios que se producen en el proyecto tienen que estar aprobados.', 'No, todos los cambios que se producen en el proyecto tienen que ser aprobados por el director de proyecto.', 'SÃ­, los cambios que se producen en el proyecto y que son de menor importancia los puede aprobar el director de proyecto.', 'SÃ­, los cambios que vienen por parte de los interesados del proyecto no necesita ningÃºn aprobaciÃ³n.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Cuando ya existe una planificaciÃ³n aprobada, los cambios se deben aprobar mediante el proceso Realizar el control integrado de cambios', '0', '0', '0', '0', '0', '0', '0', '1', 1, 1, 4),
(110, 'CA-1', 'Â¿CuÃ¡l de las siguientes NO son activos de los procesos de la organizaciÃ³n, que tienen que ponerse a disposiciÃ³n del equipo en el proceso Dirigir el equipo del proyecto?.', 'Â¿CuÃ¡l de las siguientes NO son activos de los procesos de la organizaciÃ³n, que tienen que ponerse a disposiciÃ³n del equipo en el proceso Dirigir el equipo del proyecto?.', '0', '0', 'B', 'Las estructuras de bonificaciones.', 'Lista de los miembros del equipo del proyecto.', 'Certificados de reconocimiento.', 'Boletines informativos.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'AdemÃ¡s de A, C y D, otros activos de este proceso son: sitios web, cÃ³digo corporativo de vestimenta, otros beneficios adicionales de la organizaciÃ³n.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 6, 3),
(111, 'CA-1', 'Â¿CuÃ¡l de todas ES una parte importante del control del cronograma, respecto a la variaciÃ³n del cronograma?', 'Â¿CuÃ¡l de todas ES una parte importante del control del cronograma, respecto a la variaciÃ³n del cronograma?', '0', '0', 'C', 'Requerir acciones preventivas.', 'Requerir cambios correctivos.', 'Requerir acciones correctivas.', 'Requerir acciones implementadas.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Cuando se detecta una desviaciÃ³n en el cronograma se requieren acciones correctivas que permitan encausar la ejecuciÃ³n de acuerdo a la planificaciÃ³n.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 3, 4),
(113, 'CA-1', 'El rol es la denominaciÃ³n que describe la parte de un proyecto en la cual una ______________ es _______________ .', 'El rol es la denominaciÃ³n que describe la parte de un proyecto en la cual una ______________ es _______________ .', '0', '0', 'B', 'DecisiÃ³n, encargada.', 'Persona, responsable.', 'Habilidad, requerida.', 'DirecciÃ³n, compartida.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'SÃ³lo B es correcta en el contexto de la planificaciÃ³n de RRHH.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 6, 2),
(114, 'CA-1', 'Â¿Cual de todas NO son actividades de gestiÃ³n de cambios?', 'Â¿Cual de todas NO son actividades de gestiÃ³n de cambios?', '0', '0', 'B', 'Documentar el impacto total de los cambios solicitados.', 'Documentar el cierre administrativo.', 'Revisar, aprobar o rechazar todas las acciones preventivas y correctivas recomendadas.', 'Coordinar los cambios a travÃ©s de todo el proyecto.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'B corresponde al grupo de Cierre. A, C y D se incluyen en la gestiÃ³n de cambios durante la ejecuciÃ³n.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 1, 4),
(116, 'CA-1', 'Â¿Cual de todas NO es una revisiÃ³n realizada por una auditorÃ­a de calidad?', 'Â¿Cual de todas NO es una revisiÃ³n realizada por una auditorÃ­a de calidad?', '0', '0', 'D', 'Determina si se cumplen los procedimientos del proyecto', 'Determina si cumplen los procesos del proyecto.', 'Determina si cumplen las polÃ­ticas del proyecto.', 'Determina si cumplen el control del proyecto.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'Una auditorÃ­a de calidad determina si las actividades cumplen con las polÃ­ticas, procesos y procedimientos de la organizaciÃ³n y del proyecto.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 5, 3),
(117, 'CA-1', 'Â¿Cual de todos NO son factores y evaluaciones en el anÃ¡lisis cualitativo de riesgos?', 'Â¿Cual de todos NO son factores y evaluaciones en el anÃ¡lisis cualitativo de riesgos?', '0', '0', 'A', 'Un plazo de respuesta.', 'Las categorÃ­as de riesgos.', 'Tolerancia al riesgo por parte de la organizaciÃ³n asociados con las restricciones del proyecto en cuanto a costos.', 'Tolerancia al riesgo por parte de la organizaciÃ³n asociados con las restricciones del proyecto en cuanto al cronograma.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'B, C y D son factores que pueden influir en la evaluaciÃ³n que se hace de un riesgo. A serÃ¡ mÃ¡s bien una consecuencia.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 8, 2),
(118, 'CA-1', 'El proceso control integrado de cambios, Â¿A quÃ© grupo de procesos de direcciÃ³n de proyectos pertenece?', 'El proceso control integrado de cambios, Â¿A quÃ© grupo de procesos de direcciÃ³n de proyectos pertenece?', '0', '0', 'B', 'Grupo de procesos de ejecuciÃ³n.', 'Grupo de procesos de monitoreo y control.', 'Grupo de procesos de planificaciÃ³n.', 'Grupo de procesos de iniciaciÃ³n.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'AsÃ­ lo indican las guÃ­as del PMBOK.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 1, 4),
(119, 'CA-1', 'Â¿CuÃ¡l de las siguientes opciones NO es una entrada del proceso Determinar el presupuesto?', 'Â¿CuÃ¡l de las siguientes opciones NO es una entrada del proceso Determinar el presupuesto?', '0', '0', 'D', 'EstimaciÃ³n de costes de la actividad.', 'Activos de los proceso de la organizaciÃ³n.', 'Base de las Estimaciones.', 'Factores ambientales de la empresa.', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'SegÃºn las guÃ­as del PMBOK, A, B y C son entradas para el proceso Determinar el presupuesto.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 4, 2),
(120, 'CA-1', 'Â¿CuÃ¡l de las siguientes opciones es una entrada del proceso Realizar el aseguramiento de calidad?', 'Â¿CuÃ¡l de las siguientes opciones es una entrada del proceso Realizar el aseguramiento de calidad?', '0', '0', 'A', 'Plan para la direcciÃ³n del proyecto.', 'Acciones preventivas recomendadas.', 'Acciones correctivas recomendadas.', 'Entregables', 'Option A in English', 'Option B in English', 'Option C in English', 'Option D in English', 'SegÃºn las guÃ­as del PMBOK, sÃ³lo A es una entrada del proceso Realizar el aseguramiento de calidad.', '0', '0', '0', '0', '0', '0', '0', '1', 1, 5, 3),
(125, 'W5', 'Es', 'En', 'Error de Seguridad (7).png', 'ATENOS (6).jpg', 'B', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', '', '', '', '', '', '', '', '', '1', 1, 1, 5),
(126, 'W6', 'es una pregunta', 'en one question', 'Error de Seguridad.png', 'ATENOS.jpg', 'C', 'aa', 'aa', 'aa', 'aa', 'bb', 'bb', 'bb', 'b', 'caa', 'caa', 'caa', 'caa', 'cbb', 'cbb', 'cbb', 'cbb', '1', 0, 6, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_requests`
--

CREATE TABLE IF NOT EXISTS `project_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `wordpress` int(11) DEFAULT NULL,
  `codeigniter` int(11) DEFAULT NULL,
  `highcharts` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `project_requests`
--

INSERT INTO `project_requests` (`id`, `month`, `wordpress`, `codeigniter`, `highcharts`) VALUES
(1, 'Jan', 4, 5, 7),
(2, 'Feb', 5, 6, 3),
(3, 'Mar', 4, 5, 7),
(4, 'Apr', 5, 6, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regla`
--

CREATE TABLE IF NOT EXISTS `regla` (
  `regla_id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `ensayo_id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  PRIMARY KEY (`regla_id`),
  KEY `grupo_regla_fk` (`grupo_id`),
  KEY `area_regla_fk` (`area_id`),
  KEY `ensayo_regla_fk` (`ensayo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(150) CHARACTER SET latin1 NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`role_id`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Administrador', 'xxxx', 1),
(2, 'Docente', 'yyyy', 1),
(3, 'Alumno', 'alumno', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `simulacion`
--

CREATE TABLE IF NOT EXISTS `simulacion` (
  `simulacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_sim` int(11) NOT NULL,
  `num_intento` int(11) NOT NULL,
  `puntaje` double NOT NULL,
  `punt_porcentual` double NOT NULL,
  `ensayo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `restante` int(11) NOT NULL,
  `respondida` int(11) NOT NULL,
  `inicio_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fin_fecha` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`simulacion_id`),
  KEY `ensayo_simulacion_fk` (`ensayo_id`),
  KEY `usuario_simulacion_fk` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Volcado de datos para la tabla `simulacion`
--

INSERT INTO `simulacion` (`simulacion_id`, `estado_sim`, `num_intento`, `puntaje`, `punt_porcentual`, `ensayo_id`, `usuario_id`, `restante`, `respondida`, `inicio_fecha`, `fin_fecha`) VALUES
(48, 1, 0, 1, 20, 1, 5, 0, 5, '2015-01-27 18:35:46', '2015-01-27 19:05:46'),
(49, 1, 0, 0, 0, 1, 4, 0, 0, '2015-01-27 18:49:02', '2015-01-27 19:19:02'),
(50, 1, 0, 0, 0, 1, 4, 5, 0, '2015-01-27 19:25:34', '2015-01-27 19:55:34'),
(51, 0, 0, 0, 0, 2, 4, 0, 0, '2015-01-27 20:05:35', '2015-01-27 20:35:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `simulacion_detalle`
--

CREATE TABLE IF NOT EXISTS `simulacion_detalle` (
  `simulacion_detalle_id` int(11) NOT NULL AUTO_INCREMENT,
  `simulacion_id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  PRIMARY KEY (`simulacion_detalle_id`),
  KEY `pregunta_ensayo_detalle_fk` (`pregunta_id`),
  KEY `simulacion_ensayo_detalle_fk` (`simulacion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sim_resultado`
--

CREATE TABLE IF NOT EXISTS `sim_resultado` (
  `sim_resultado_id` int(11) NOT NULL AUTO_INCREMENT,
  `revision` varchar(1) CHARACTER SET latin1 NOT NULL,
  `respuesta` varchar(1) CHARACTER SET latin1 NOT NULL,
  `simulacion_id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `estado` int(1) NOT NULL,
  `ordalt` varchar(4) NOT NULL,
  PRIMARY KEY (`sim_resultado_id`),
  KEY `pregunta_sim_resultado_fk` (`pregunta_id`),
  KEY `simulacion_sim_resultado_fk` (`simulacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=340 ;

--
-- Volcado de datos para la tabla `sim_resultado`
--

INSERT INTO `sim_resultado` (`sim_resultado_id`, `revision`, `respuesta`, `simulacion_id`, `pregunta_id`, `estado`, `ordalt`) VALUES
(312, '0', 'C', 48, 15, 2, 'ADCB'),
(313, '0', 'B', 48, 48, 2, 'BDCA'),
(314, '0', 'B', 48, 65, 2, 'BACD'),
(315, '0', 'B', 48, 16, 2, 'ADCB'),
(316, '0', 'A', 48, 33, 2, 'ADBC'),
(319, '0', '0', 49, 48, 0, ''),
(320, '0', '0', 49, 56, 0, ''),
(321, '0', '0', 49, 116, 0, ''),
(322, '0', '0', 49, 16, 0, ''),
(323, '0', '0', 49, 17, 0, ''),
(326, '0', '0', 50, 107, 0, ''),
(327, '0', '0', 50, 65, 0, ''),
(328, '0', '0', 50, 16, 0, ''),
(329, '0', '0', 50, 48, 0, ''),
(330, '0', '0', 50, 56, 0, ''),
(333, '0', '0', 51, 25, 0, ''),
(334, '0', '0', 51, 29, 0, ''),
(335, '0', '0', 51, 21, 0, ''),
(336, '0', '0', 51, 69, 0, ''),
(337, '0', '0', 51, 28, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET latin1 NOT NULL,
  `apellidos` varchar(50) CHARACTER SET latin1 NOT NULL,
  `username` varchar(15) CHARACTER SET latin1 NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 NOT NULL,
  `estado` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`usuario_id`),
  KEY `perfil_usuario_fk` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `nombre`, `apellidos`, `username`, `password`, `estado`, `role_id`) VALUES
(4, 'Wilson', 'Cruz', 'wil', '12', 1, 1),
(5, 'David', 'Mamani', 'davidmp', '123', 1, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ensayo`
--
ALTER TABLE `ensayo`
  ADD CONSTRAINT `cursos_ensayo_fk` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `area_pregunta_fk` FOREIGN KEY (`area_id`) REFERENCES `area` (`area_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `grupo_pregunta_fk` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`grupo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `regla`
--
ALTER TABLE `regla`
  ADD CONSTRAINT `area_regla_fk` FOREIGN KEY (`area_id`) REFERENCES `area` (`area_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ensayo_regla_fk` FOREIGN KEY (`ensayo_id`) REFERENCES `ensayo` (`ensayo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `grupo_regla_fk` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`grupo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `simulacion`
--
ALTER TABLE `simulacion`
  ADD CONSTRAINT `ensayo_simulacion_fk` FOREIGN KEY (`ensayo_id`) REFERENCES `ensayo` (`ensayo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_simulacion_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `simulacion_detalle`
--
ALTER TABLE `simulacion_detalle`
  ADD CONSTRAINT `pregunta_ensayo_detalle_fk` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`pregunta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `simulacion_ensayo_detalle_fk` FOREIGN KEY (`simulacion_id`) REFERENCES `simulacion` (`simulacion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sim_resultado`
--
ALTER TABLE `sim_resultado`
  ADD CONSTRAINT `pregunta_sim_resultado_fk` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`pregunta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `simulacion_sim_resultado_fk` FOREIGN KEY (`simulacion_id`) REFERENCES `simulacion` (`simulacion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `perfil_usuario_fk` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
