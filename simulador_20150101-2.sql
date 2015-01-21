-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 02-01-2015 a las 03:16:00
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
  `nombre` varchar(60) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `peso` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

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
(10, 'GestiÃ³n de los Interesados del Proyecto', 'GestiÃ³n de los Interesados del Proyecto', 20, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `curso_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `estado` varchar(1) NOT NULL,
  PRIMARY KEY (`curso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
  `nombre` varchar(100) NOT NULL,
  `tipo` int(1) NOT NULL,
  `t_dependencia` varchar(1) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `tiempo` int(11) DEFAULT NULL COMMENT '--minutos',
  `intento` int(11) NOT NULL,
  `cant_preg` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  PRIMARY KEY (`ensayo_id`),
  KEY `cursos_ensayo_fk` (`curso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `ensayo`
--

INSERT INTO `ensayo` (`ensayo_id`, `nombre`, `tipo`, `t_dependencia`, `descripcion`, `tiempo`, `intento`, `cant_preg`, `estado`, `curso_id`) VALUES
(2, 'tes3', 3, '2', 'tes3', 2, 2, 2, 1, 1),
(3, 'Tessst', 1, 'A', 'Testtt', 3, 3, 3, 1, 1),
(4, 'Test4', 2, '2', 'xxx', 3, 1, 4, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `grupo_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `peso` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`grupo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

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
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE IF NOT EXISTS `pregunta` (
  `pregunta_id` int(11) NOT NULL AUTO_INCREMENT,
  `excel_id` varchar(3) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`pregunta_id`, `excel_id`, `pregunta_es`, `pregunta_us`, `imagen_es`, `imagen_us`, `respuesta`, `opcion_aes`, `opcion_bes`, `opcion_ces`, `opcion_des`, `opcion_aus`, `opcion_bus`, `opcion_cus`, `opcion_dus`, `comentario_aes`, `comentario_bes`, `comentario_ces`, `comentario_des`, `comentario_aus`, `comentario_bus`, `comentario_cus`, `comentario_dus`, `nivel_dificultad`, `estado`, `area_id`, `grupo_id`) VALUES
(58, '101', '¿Cuantas áreas de conocimiento Existen?', 'How many areas of knowledge exist?', 'image.jpg', 'imge.jpg', 'a', 'Son 7', 'Son 4', 'Son 10', 'Son 9', '7', '4', '10', '9', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver yyy', 'ver yyy', 'ver yyy', 'ver yyy', '1', 1, 2, 3),
(59, '102', '¿Cuantas áreas de conocimiento Existen?', 'How many areas of knowledge exist?', 'image.jpg', 'imge.jpg', 'a', 'Son 7', 'Son 4', 'Son 10', 'Son 9', '7', '4', '10', '9', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver yyy', 'ver yyy', 'ver yyy', 'ver yyy', '1', 1, 2, 3),
(60, '103', '¿Cuantas áreas de conocimiento Existen?', 'How many areas of knowledge exist?', 'image.jpg', 'imge.jpg', 'a', 'Son 7', 'Son 4', 'Son 10', 'Son 9', '7', '4', '10', '9', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver yyy', 'ver yyy', 'ver yyy', 'ver yyy', '1', 1, 2, 3),
(61, '104', '¿Cuantas áreas de conocimiento Existen?', 'How many areas of knowledge exist?', 'image.jpg', 'imge.jpg', 'a', 'Son 7', 'Son 4', 'Son 10', 'Son 9', '7', '4', '10', '9', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver yyy', 'ver yyy', 'ver yyy', 'ver yyy', '1', 1, 2, 3),
(62, '105', '¿Cuantas áreas de conocimiento Existen?', 'How many areas of knowledge exist?', 'image.jpg', 'imge.jpg', 'a', 'Son 7', 'Son 4', 'Son 10', 'Son 9', '7', '4', '10', '9', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver yyy', 'ver yyy', 'ver yyy', 'ver yyy', '1', 1, 2, 3),
(63, '106', '¿Cuantas áreas de conocimiento Existen?', 'How many areas of knowledge exist?', 'image.jpg', 'imge.jpg', 'a', 'Son 7', 'Son 4', 'Son 10', 'Son 9', '7', '4', '10', '9', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver yyy', 'ver yyy', 'ver yyy', 'ver yyy', '1', 1, 2, 3),
(64, '107', '¿Cuantas áreas de conocimiento Existen?', 'How many areas of knowledge exist?', 'image.jpg', 'imge.jpg', 'a', 'Son 7', 'Son 4', 'Son 10', 'Son 9', '7', '4', '10', '9', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver yyy', 'ver yyy', 'ver yyy', 'ver yyy', '1', 1, 2, 3),
(65, '108', '¿Cuantas áreas de conocimiento Existen?', 'How many areas of knowledge exist?', 'image.jpg', 'imge.jpg', 'a', 'Son 7', 'Son 4', 'Son 10', 'Son 9', '7', '4', '10', '9', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver yyy', 'ver yyy', 'ver yyy', 'ver yyy', '1', 1, 2, 3),
(66, '109', '¿Cuantas áreas de conocimiento Existen?', 'How many areas of knowledge exist?', 'image.jpg', 'imge.jpg', 'a', 'Son 7', 'Son 4', 'Son 10', 'Son 9', '7', '4', '10', '9', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver yyy', 'ver yyy', 'ver yyy', 'ver yyy', '1', 1, 2, 3),
(72, '001', 'Â¿QuÃ© es...', 'What is...', 'b', 'imge.jpg', '', 'Son 2', 'Son 2', 'Son 2', 'Son 2', 'Son 2', 'Son 2', 'Son 2', 'Son 2', 'Comentario 1', 'Comentario 1', 'Comentario 1', 'Comentario 1', 'Coment 1', 'Coment 1', 'Coment 1', 'Coment 1', '1', 1, 2, 5),
(73, '002', 'Â¿QuÃ© es...', 'What is...', 'image.jpg', 'imge.jpg', 'c', 'Son 2', 'Son 2', 'Son 2', 'Son 2', 'Son 3', 'Son 3', 'Son 3', 'Son 3', 'Comentario 1', 'Comentario 1', 'Comentario 1', 'Comentario 1', 'Coment 1', 'Coment 1', 'Coment 1', 'Coment 1', '2', 1, 2, 5),
(74, '600', 'es', 'es', 'ss', 'ss', 'ss', 'sss', 'ss', 'ComunicacÃ³n', 'ComunicacÃ³n', 'aa', 'aa', 'sdd', 'sasd', 'sds', 'asdsad', 'asds', 'asd', 'asd', 'sad', 'asd', 'asd', '1', 1, 1, 2),
(75, '600', 'es', 'es', 'ss', 'ss', 'ss', 'sss', 'ss', 'ComunicacÃ³n', 'ComunicacÃ³n', 'aa', 'ssee', 'sdd', 'sasd', 'sds', 'asdsad', 'asds', 'asd', 'asd', 'sad', 'asd', 'asd', '1', 1, 3, 2),
(76, '600', 'es', 'es', 'es', 'es', 'es', 'es', 'es', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', '3', 1, 5, 2),
(77, '66', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'Co', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', '3', 1, 7, 3),
(78, '66', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'Co', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', 'ComunicacÃ³n', '3', 1, 10, 2),
(79, '90', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 8, 2),
(80, '222', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 2, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`role_id`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Administrador', 'xxxx', 1),
(2, 'Docente', 'yyyy', 1);

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
  PRIMARY KEY (`simulacion_id`),
  KEY `ensayo_simulacion_fk` (`ensayo_id`),
  KEY `usuario_simulacion_fk` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `simulacion`
--

INSERT INTO `simulacion` (`simulacion_id`, `estado_sim`, `num_intento`, `puntaje`, `punt_porcentual`, `ensayo_id`, `usuario_id`, `restante`, `respondida`) VALUES
(1, 1, 0, 0, 0, 2, 1, 0, 0),
(6, 1, 0, 0, 0, 2, 4, 0, 0),
(7, 0, 0, 0, 0, 2, 4, 0, 0),
(8, 1, 0, 0, 0, 2, 1, 0, 0),
(9, 0, 0, 0, 0, 2, 1, 0, 0);

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
  `revision` varchar(1) NOT NULL,
  `respuesta` varchar(1) NOT NULL,
  `simulacion_id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`sim_resultado_id`),
  KEY `pregunta_sim_resultado_fk` (`pregunta_id`),
  KEY `simulacion_sim_resultado_fk` (`simulacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `sim_resultado`
--

INSERT INTO `sim_resultado` (`sim_resultado_id`, `revision`, `respuesta`, `simulacion_id`, `pregunta_id`, `estado`) VALUES
(1, '0', '0', 1, 75, 0),
(2, '0', '0', 1, 79, 0),
(3, '0', '0', 1, 74, 0),
(4, '0', '0', 1, 76, 0),
(5, '0', '0', 1, 78, 0),
(8, '0', '0', 6, 62, 0),
(9, '0', '0', 6, 63, 0),
(10, '0', '0', 6, 60, 0),
(11, '0', '0', 6, 61, 0),
(12, '0', '0', 6, 66, 0),
(15, '0', '0', 7, 64, 0),
(16, '0', '0', 7, 59, 0),
(17, '0', '0', 7, 66, 0),
(18, '0', '0', 7, 80, 0),
(19, '0', '0', 7, 72, 0),
(22, '0', 'c', 8, 74, 2),
(23, '0', 'b', 8, 76, 2),
(25, '0', '0', 9, 79, 1),
(26, '0', 'c', 9, 78, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`usuario_id`),
  KEY `perfil_usuario_fk` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `nombre`, `apellidos`, `username`, `password`, `estado`, `role_id`) VALUES
(1, 'David', 'Mamani Pari', 'davidmp', '123456', 1, 1),
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
