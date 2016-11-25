-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 21-11-2016 a las 11:33:28
-- Versión del servidor: 5.6.28
-- Versión de PHP: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(4) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono1` varchar(9) NOT NULL,
  `telefono2` varchar(9) DEFAULT NULL,
  `nick` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `direccion`, `telefono1`, `telefono2`, `nick`, `pass`) VALUES
(1, 'Martín ', 'Carmona', 'c/Manuel solano nº11', '665899874', NULL, 'martinowen3', 'm33333333'),
(2, 'Juan ', 'Aquí Alao', 'C/ asdlsdifjeEedd', '558887485', '', 'Juanillo', 'El mas chulo'),
(3, 'Juan Carlos', 'Montilla Casado', 'c/Esperanza de la reina ', '666999658', '', 'Nombre largisimo', 'supercontraseña'),
(4, 'josenantonio', 'esaquedicementiras', 'C/estiasodnsdiekse', '669874584', NULL, 'Unade las largas', 'Suèrteconlascontr'),
(5, 'Martin', 'Carmon', 'C/adfñalsdkfjañdslfkajsdf', '665887558', '', 'Martinwoe3', 'asdlñkfjasdñ'),
(7, 'Hatim', 'Atras derecha', 'C/asdfadfasdfadsfa', '669568789', '', 'hatim22', 'EADFadfad'),
(8, 'Holas', 'ESdfde', 'adsfadfadfasdf', '669665668', '', 'afdsfad', 'adsfadsfadsfa'),
(11, 'Martín', 'afgasdf', 'asdfasdfa', '999666555', '', 'asdfadfa', 'fadsfadfadfa'),
(15, 'Martín', 'Carmona López', 'c/Manuel Solano nº11', '665215805', '', 'Martín Carmona López', 'asdfadf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id_servicio` int(4) NOT NULL,
  `id_cliente` int(4) NOT NULL,
  `lugar` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `hora` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(4) NOT NULL,
  `titular` varchar(200) NOT NULL,
  `subtitulo` varchar(200) NOT NULL,
  `contenido` varchar(1000) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titular`, `subtitulo`, `contenido`, `imagen`, `fecha`) VALUES
(31, 'Martín', 'Carmon', 'Escribe aquí la noticia ', 'images/noticias/Martín.jpg', '2016-11-09'),
(32, 'Juan', 'Estas asdis', 'Escribe aquí la noticia ', 'images/noticias/Juan.jpg', '2016-11-28'),
(33, 'Esta es una prueba', 'La prueba de la imagen', 'Escribe aquí la noticia ', 'images/noticias/Esta es una prueba.jpg', '2016-12-10'),
(34, 'Villena', '', 'Esas cosas que ponen en el cuerpo', 'images/noticias/no', '2016-11-23'),
(35, 'Villena 2', '', 'Escribe la noticia aquí', 'images/noticias/Villena 2.jpg', '2016-11-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(4) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `precio` int(6) NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_servicio`,`id_cliente`),
  ADD KEY `cf_cli` (`id_cliente`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `cf_cli` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `cf_ser` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
