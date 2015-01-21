-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-01-2015 a las 15:46:39
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
CREATE DEFINER=`root`@`localhost` FUNCTION `estado_simulacion`(xtipo INT, cantidad INT ,xensayo_id INT,xusuario_id INT, t_dependencia int) RETURNS int(11)
BEGIN
DECLARE condicion INT DEFAULT (SELECT (CASE WHEN MAX(simulacion_id) IS NULL THEN 0 ELSE MAX(simulacion_id) END) condicion FROM (SELECT * FROM simulacion WHERE usuario_id=xusuario_id AND estado_sim=0) a);
      
	IF (condicion = 0) THEN
	
	INSERT  INTO simulacion( estado_sim, num_intento, puntaje, punt_porcentual, ensayo_id, usuario_id, restante, respondida ) VALUES( 0, 0, 0, 0, xensayo_id, xusuario_id, 0, 0);
	
	
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

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
(8, 'GestiÃ³n de los Riesgos del Proyecto', 'GestiÃ³n de los Riesgos del Proyecto', 5, 1),
(9, 'GestiÃ³n de las Adquisiciones del Proyecto', 'GestiÃ³n de las Adquisiciones del Proyecto', 10, 1),
(10, 'GestiÃ³n de los Interesados del Proyecto', 'GestiÃ³n de los Interesados del Proyecto', 10, 1),
(14, 'Nuevo', 'Holas', 3, 0);

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
  `estado` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  PRIMARY KEY (`ensayo_id`),
  KEY `cursos_ensayo_fk` (`curso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `ensayo`
--

INSERT INTO `ensayo` (`ensayo_id`, `nombre`, `tipo`, `t_dependencia`, `descripcion`, `tiempo`, `intento`, `cant_preg`, `estado`, `curso_id`) VALUES
(2, 'tes3', 3, '2', 'tes3', 2, 2, 10, 1, 1),
(3, 'Tessst', 1, 'A', 'Testtt', 3, 3, 20, 1, 1),
(4, 'Test4', 2, '2', 'xxx', 3, 2, 15, 1, 1),
(5, 'Ensayo Inicial', 3, '3', 'Ensayo Inicial', 20, 2, 5, 1, 2);

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
(5, 'Grupo de Procesos de Cierre', 'Grupo de Procesos de Cierre', 25, 1),
(6, 'sdfsd', 'dsf', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gasto` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `gasto`) VALUES
(1, 'juan', '30'),
(2, 'pedro', '12'),
(3, 'juan', '30'),
(4, 'pedro', '12'),
(5, 'maria', '15'),
(6, 'Felipe', '34'),
(7, 'maria', '15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE IF NOT EXISTS `pregunta` (
  `pregunta_id` int(11) NOT NULL AUTO_INCREMENT,
  `excel_id` varchar(4) NOT NULL,
  `pregunta_es` varchar(200) NOT NULL,
  `pregunta_us` varchar(200) NOT NULL,
  `imagen_es` varchar(100) NOT NULL,
  `imagen_us` varchar(100) NOT NULL,
  `respuesta` varchar(2) NOT NULL,
  `opcion_aes` varchar(300) NOT NULL,
  `opcion_bes` varchar(300) NOT NULL,
  `opcion_ces` varchar(300) NOT NULL,
  `opcion_des` varchar(300) NOT NULL,
  `opcion_aus` varchar(300) NOT NULL,
  `opcion_bus` varchar(300) NOT NULL,
  `opcion_cus` varchar(300) NOT NULL,
  `opcion_dus` varchar(300) NOT NULL,
  `comentario_aes` varchar(300) NOT NULL,
  `comentario_bes` varchar(300) NOT NULL,
  `comentario_ces` varchar(300) NOT NULL,
  `comentario_des` varchar(300) NOT NULL,
  `comentario_aus` varchar(300) NOT NULL,
  `comentario_bus` varchar(300) NOT NULL,
  `comentario_cus` varchar(300) NOT NULL,
  `comentario_dus` varchar(300) NOT NULL,
  `nivel_dificultad` varchar(2) NOT NULL,
  `estado` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  PRIMARY KEY (`pregunta_id`),
  KEY `grupo_pregunta_fk` (`grupo_id`),
  KEY `area_pregunta_fk` (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1004 ;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`pregunta_id`, `excel_id`, `pregunta_es`, `pregunta_us`, `imagen_es`, `imagen_us`, `respuesta`, `opcion_aes`, `opcion_bes`, `opcion_ces`, `opcion_des`, `opcion_aus`, `opcion_bus`, `opcion_cus`, `opcion_dus`, `comentario_aes`, `comentario_bes`, `comentario_ces`, `comentario_des`, `comentario_aus`, `comentario_bus`, `comentario_cus`, `comentario_dus`, `nivel_dificultad`, `estado`, `area_id`, `grupo_id`) VALUES
(1002, '1', '¿En  ñandú  qué momento del ciclo de vida de un proyecto genérico  el costo y la dotación de personal son más altos? ', 'EE ñandú  ¿En qué momento del ciclo de vida de un proyecto genérico  el costo y la dotación de personal son más altos? ', 'image.jpg', 'imge.jpg', 'B', 'En el inicio', 'Cuando el proyecto se está realizando', 'Al cierre del proyecto', 'Los niveles se mantienen durante el proyecto', '', '', '', '9', 'Comentario A', 'Comentario B', 'Comentario C', 'Comentario D', 'Coment A', 'Coment B', 'Coment C', 'Coment D', '1', 1, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `simulacion`
--

INSERT INTO `simulacion` (`simulacion_id`, `estado_sim`, `num_intento`, `puntaje`, `punt_porcentual`, `ensayo_id`, `usuario_id`, `restante`, `respondida`, `inicio_fecha`, `fin_fecha`) VALUES
(1, 1, 0, 0, 0, 2, 1, 0, 0, '2015-01-09 03:49:07', '0000-00-00 00:00:00'),
(6, 1, 0, 0, 0, 2, 4, 0, 0, '2015-01-09 03:49:07', '0000-00-00 00:00:00'),
(7, 0, 0, 0, 0, 2, 4, 0, 0, '2015-01-09 03:49:07', '0000-00-00 00:00:00'),
(8, 1, 0, 0, 0, 2, 1, 0, 0, '2015-01-09 03:49:07', '0000-00-00 00:00:00'),
(11, 1, 0, 0, 0, 2, 1, 0, 0, '2015-01-09 03:49:07', '0000-00-00 00:00:00'),
(12, 1, 0, 0, 0, 5, 1, 0, 0, '2015-01-09 03:49:07', '0000-00-00 00:00:00'),
(13, 1, 0, 40, 0, 5, 1, 3, 2, '2015-01-09 03:49:07', '0000-00-00 00:00:00'),
(16, 1, 0, 20, 0, 5, 1, 1, 4, '2015-01-09 03:50:33', '0000-00-00 00:00:00'),
(17, 1, 0, 0, 0, 5, 1, 0, 0, '2015-01-12 23:40:45', '0000-00-00 00:00:00'),
(18, 0, 0, 40, 0, 5, 1, 0, 5, '2015-01-13 15:10:29', '0000-00-00 00:00:00');

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
  PRIMARY KEY (`sim_resultado_id`),
  KEY `pregunta_sim_resultado_fk` (`pregunta_id`),
  KEY `simulacion_sim_resultado_fk` (`simulacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `nombre`, `apellidos`, `username`, `password`, `estado`, `role_id`) VALUES
(1, 'David', 'Mamani Pari', 'davidmp', '123', 1, 3),
(4, 'Wilson', 'Cruz', 'wil', '12', 1, 1);

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
