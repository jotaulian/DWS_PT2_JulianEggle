-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2021 a las 11:05:21
-- Versión del servidor: 8.0.22
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `studium_dws_p2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ninos`
--

CREATE TABLE `ninos` (
  `id` int NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `buen_comportamiento` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ninos`
--

INSERT INTO `ninos` (`id`, `nombre`, `apellido`, `fecha_nacimiento`, `buen_comportamiento`) VALUES
(1, 'Alberto', 'Alcántara', '1994-10-13', 'No'),
(2, 'Beatriz', 'Bueno', '1982-04-18', 'Si'),
(3, 'Carlos', 'Crepo', '1998-12-01', 'Si'),
(4, 'Diana', 'Domínguez', '1987-09-02', 'No'),
(5, 'Emilio', 'Enamorado', '1996-08-12', 'Si'),
(6, 'Francisca	', 'Fernández', '1990-07-28', 'Si'),
(13, 'Pablo', 'Problematico', '1987-07-12', 'No');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int NOT NULL,
  `nino_id` int NOT NULL,
  `regalo_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `nino_id`, `regalo_id`) VALUES
(1, 1, 3),
(2, 1, 4),
(3, 1, 11),
(4, 2, 1),
(5, 2, 6),
(6, 2, 12),
(7, 3, 4),
(8, 3, 7),
(9, 3, 13),
(10, 4, 8),
(11, 4, 5),
(12, 4, 6),
(13, 5, 11),
(14, 5, 13),
(15, 5, 3),
(16, 6, 9),
(17, 6, 8),
(18, 6, 1),
(27, 2, 10),
(28, 5, 12),
(29, 6, 10),
(30, 1, 13),
(31, 3, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regalos`
--

CREATE TABLE `regalos` (
  `id` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `reymago_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `regalos`
--

INSERT INTO `regalos` (`id`, `nombre`, `precio`, `reymago_id`) VALUES
(1, 'Aula de ciencia: Robot Mini ERP', '159.95', 1),
(2, 'Carbón', '0.00', 2),
(3, 'Cochecito Classic', '99.95', 1),
(4, 'Consola PS4 1 TB', '394.90', 3),
(5, 'Lego Villa familiar modular', '64.99', 2),
(6, 'Magia Borrás Clásica 150 trucos con luz', '32.95', 1),
(7, 'Meccano Excavadora construcción', '30.99', 3),
(8, 'Nenuco Hace pompas', '29.95', 3),
(9, 'Peluche delfín rosa', '34.00', 2),
(10, 'Pequeordenador', '22.95', 2),
(11, 'Robot Coji', '69.95', 3),
(12, 'Telescopio astronómico terrestre', '72.00', 2),
(13, 'Twister', '17.95', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reyesmagos`
--

CREATE TABLE `reyesmagos` (
  `id` int NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reyesmagos`
--

INSERT INTO `reyesmagos` (`id`, `nombre`) VALUES
(1, 'Melchor'),
(2, 'Gaspar'),
(3, 'Baltasar');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ninos`
--
ALTER TABLE `ninos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nino_id` (`nino_id`),
  ADD KEY `regalo_id` (`regalo_id`);

--
-- Indices de la tabla `regalos`
--
ALTER TABLE `regalos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reymago_id` (`reymago_id`);

--
-- Indices de la tabla `reyesmagos`
--
ALTER TABLE `reyesmagos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ninos`
--
ALTER TABLE `ninos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `regalos`
--
ALTER TABLE `regalos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `reyesmagos`
--
ALTER TABLE `reyesmagos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`nino_id`) REFERENCES `ninos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`regalo_id`) REFERENCES `regalos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `regalos`
--
ALTER TABLE `regalos`
  ADD CONSTRAINT `regalos_ibfk_1` FOREIGN KEY (`reymago_id`) REFERENCES `reyesmagos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
