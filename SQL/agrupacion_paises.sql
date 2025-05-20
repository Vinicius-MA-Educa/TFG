-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2025 a las 15:38:33
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tfg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agrupacion_paises`
--

CREATE TABLE `agrupacion_paises` (
  `id` int(11) NOT NULL,
  `razon` varchar(100) NOT NULL,
  `pais1` varchar(10) DEFAULT NULL,
  `pais2` varchar(10) DEFAULT NULL,
  `pais3` varchar(10) DEFAULT NULL,
  `pais4` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `agrupacion_paises`
--

INSERT INTO `agrupacion_paises` (`id`, `razon`, `pais1`, `pais2`, `pais3`, `pais4`) VALUES
(1, 'Países de Europa Occidental', '250', '276', '724', '380'),
(2, 'Países Nórdicos', '752', '578', '246', '208'),
(3, 'Principales economías asiáticas', '156', '392', '410', '356'),
(4, 'Países del Sudeste Asiático', '704', '360', '458', '702'),
(5, 'Países de Sudamérica', '076', '032', '152', '170'),
(6, 'Países de Oriente Medio', '682', '784', '792', '818');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agrupacion_paises`
--
ALTER TABLE `agrupacion_paises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pais1` (`pais1`),
  ADD KEY `pais2` (`pais2`),
  ADD KEY `pais3` (`pais3`),
  ADD KEY `pais4` (`pais4`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agrupacion_paises`
--
ALTER TABLE `agrupacion_paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agrupacion_paises`
--
ALTER TABLE `agrupacion_paises`
  ADD CONSTRAINT `agrupacion_paises_ibfk_1` FOREIGN KEY (`pais1`) REFERENCES `pais` (`cnn3m`),
  ADD CONSTRAINT `agrupacion_paises_ibfk_2` FOREIGN KEY (`pais2`) REFERENCES `pais` (`cnn3m`),
  ADD CONSTRAINT `agrupacion_paises_ibfk_3` FOREIGN KEY (`pais3`) REFERENCES `pais` (`cnn3m`),
  ADD CONSTRAINT `agrupacion_paises_ibfk_4` FOREIGN KEY (`pais4`) REFERENCES `pais` (`cnn3m`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
