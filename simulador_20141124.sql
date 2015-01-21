-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-11-2014 a las 20:52:17
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`area_id`, `nombre`, `descripcion`, `peso`, `estado`) VALUES
(1, 'Inicio', 'Etapa del Inicio', 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE IF NOT EXISTS `cursos` (
  `cursos_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `estado` varchar(1) NOT NULL,
  PRIMARY KEY (`cursos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ensayo`
--

CREATE TABLE IF NOT EXISTS `ensayo` (
  `ensayo_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `tiempo` int(11) DEFAULT NULL COMMENT '--minutos',
  `intento` int(11) NOT NULL,
  `cant_preg` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `cursos_id` int(11) NOT NULL,
  PRIMARY KEY (`ensayo_id`),
  KEY `cursos_ensayo_fk` (`cursos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`grupo_id`, `nombre`, `descripcion`, `peso`, `estado`) VALUES
(1, 'Logistica', 'X', 20, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE IF NOT EXISTS `pregunta` (
  `pregunta_id` int(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`pregunta_id`, `pregunta_es`, `pregunta_us`, `imagen_es`, `imagen_us`, `respuesta`, `opcion_aes`, `opcion_bes`, `opcion_ces`, `opcion_des`, `opcion_aus`, `opcion_bus`, `opcion_cus`, `opcion_dus`, `comentario_aes`, `comentario_bes`, `comentario_ces`, `comentario_des`, `comentario_aus`, `comentario_bus`, `comentario_cus`, `comentario_dus`, `nivel_dificultad`, `estado`, `area_id`, `grupo_id`) VALUES
(1, 'Cuantas áreas de conocimiento Existen', 'In Cuantas áreas de conocimiento Existen', 'image.jpg', 'imge.jpg', '13', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(2, 'Cuantas Ã¡reas de conocimiento Existen', 'In Cuantas Ã¡reas de conocimiento Existen', 'image.jpg', 'imge.jpg', '13', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(3, 'Cuantas Ã¡reas de conocimiento Existen', 'In Cuantas Ã¡reas de conocimiento Existen', 'image.jpg', 'imge.jpg', '13', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(4, 'Cuantas Ã¡reas de conocimiento Existen', 'In Cuantas Ã¡reas de conocimiento Existen', 'image.jpg', 'imge.jpg', '13', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(5, 'Cuantas Ã¡reas de conocimiento Existen', 'In Cuantas Ã¡reas de conocimiento Existen', 'image.jpg', 'imge.jpg', '13', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(6, 'Cuantas Ã¡reas de conocimiento Existen', 'In Cuantas Ã¡reas de conocimiento Existen', 'image.jpg', 'imge.jpg', '13', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(7, 'Cuantas Ã¡reas de conocimiento Existen', 'In Cuantas Ã¡reas de conocimiento Existen', 'image.jpg', 'imge.jpg', '13', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(8, 'Cuantas Ã¡reas de conocimiento Existen', 'In Cuantas Ã¡reas de conocimiento Existen', 'image.jpg', 'imge.jpg', '13', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(9, 'Cuantas Ã¡reas de conocimiento Existen', 'In Cuantas Ã¡reas de conocimiento Existen', 'image.jpg', 'imge.jpg', '13', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(10, 'Cuantas Ã¡reas de conocimiento Existen', 'In Cuantas Ã¡reas de conocimiento Existen', 'image.jpg', 'imge.jpg', '13', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(11, 'Cuantas Ã¡reas de conocimiento Existen', 'In Cuantas Ã¡reas de conocimiento Existen', 'image.jpg', 'imge.jpg', '13', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(12, 'Cuantas Ã¡reas de conocimiento Existen', 'In Cuantas Ã¡reas de conocimiento Existen', 'image.jpg', 'imge.jpg', '13', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(13, 'Cuantas Ã¡reas de conocimiento Existen', 'In Cuantas Ã¡reas de conocimiento Existen', 'image.jpg', 'imge.jpg', '13', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(14, 'Cuantas Ã¡reas de conocimiento Existen', 'In Cuantas Ã¡reas de conocimiento Existen', 'image.jpg', 'imge.jpg', '13', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(15, 'Cuantas Ã¡reas de conocimiento Existen', 'In Cuantas Ã¡reas de conocimiento Existen', 'image.jpg', 'imge.jpg', '13', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(16, 'Cuantas Ã¡reas de conocimiento Existen', 'X', 'image.jpg', 'imge.jpg', '12', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(17, 'Cuantas Ã¡reas de conocimiento Existen', 'X', 'image.jpg', 'imge.jpg', '12', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(18, 'Cuantas Ã¡reas de conocimiento Existen', 'X', 'image.jpg', 'imge.jpg', '12', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(19, 'Cuantas Ã¡reas de conocimiento Existen', 'X', 'image.jpg', 'imge.jpg', '12', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(20, 'Cuantas Ã¡reas de conocimiento Existen', 'X', 'image.jpg', 'imge.jpg', '12', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(21, 'Cuantas Ã¡reas de conocimiento Existen', 'X', 'image.jpg', 'imge.jpg', '12', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(22, 'Cuantas Ã¡reas de conocimiento Existen', 'X', 'image.jpg', 'imge.jpg', '12', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(23, 'Cuantas Ã¡reas de conocimiento Existen', 'X', 'image.jpg', 'imge.jpg', '12', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(24, 'Cuantas Ã¡reas de conocimiento Existen', 'X', 'image.jpg', 'imge.jpg', '12', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(25, 'Cuantas Ã¡reas de conocimiento Existen', 'X', 'image.jpg', 'imge.jpg', '12', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(26, 'Cuantas Ã¡reas de conocimiento Existen', 'X', 'image.jpg', 'imge.jpg', '12', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(27, 'Cuantas Ã¡reas de conocimiento Existen', 'X', 'image.jpg', 'imge.jpg', '12', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(28, 'Cuantas Ã¡reas de conocimiento Existen', 'X', 'image.jpg', 'imge.jpg', '12', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1),
(29, 'Cuantas Ã¡reas de conocimiento Existen', 'X', 'image.jpg', 'imge.jpg', '12', '6', '3', '7', '9', '9', '1', '3', '6', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', 'ver xxx', '1', 1, 1, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `respuesta` int(11) NOT NULL,
  `simulacion_id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  PRIMARY KEY (`sim_resultado_id`),
  KEY `pregunta_sim_resultado_fk` (`pregunta_id`),
  KEY `simulacion_sim_resultado_fk` (`simulacion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `nombre`, `apellidos`, `username`, `password`, `estado`, `role_id`) VALUES
(1, 'David', 'Mamani Pari', 'davidmp', '123456', 1, 1),
(2, 'Wilson Dario', 'Cruz Mamani', 'wilson', '123456', 1, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ensayo`
--
ALTER TABLE `ensayo`
  ADD CONSTRAINT `cursos_ensayo_fk` FOREIGN KEY (`cursos_id`) REFERENCES `cursos` (`cursos_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
