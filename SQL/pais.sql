-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2025 a las 15:38:22
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
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `cnn3m` varchar(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `url_imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`cnn3m`, `nombre`, `url_imagen`) VALUES
('032', 'Argentina', 'https://flagcdn.com/w320/ar.png'),
('036', 'Australia', 'https://flagcdn.com/w320/au.png'),
('040', 'Austria', 'https://flagcdn.com/w320/at.png'),
('056', 'Bélgica', 'https://flagcdn.com/w320/be.png'),
('076', 'Brasil', 'https://flagcdn.com/w320/br.png'),
('124', 'Canadá', 'https://flagcdn.com/w320/ca.png'),
('152', 'Chile', 'https://flagcdn.com/w320/cl.png'),
('156', 'China', 'https://flagcdn.com/w320/cn.png'),
('170', 'Colombia', 'https://flagcdn.com/w320/co.png'),
('188', 'Costa Rica', 'https://flagcdn.com/w320/cr.png'),
('192', 'Cuba', 'https://flagcdn.com/w320/cu.png'),
('203', 'República Checa', 'https://flagcdn.com/w320/cz.png'),
('208', 'Dinamarca', 'https://flagcdn.com/w320/dk.png'),
('214', 'República Dominicana', 'https://flagcdn.com/w320/do.png'),
('246', 'Finlandia', 'https://flagcdn.com/w320/fi.png'),
('250', 'Francia', 'https://flagcdn.com/w320/fr.png'),
('276', 'Alemania', 'https://flagcdn.com/w320/de.png'),
('300', 'Grecia', 'https://flagcdn.com/w320/gr.png'),
('320', 'Guatemala', 'https://flagcdn.com/w320/gt.png'),
('348', 'Hungría', 'https://flagcdn.com/w320/hu.png'),
('356', 'India', 'https://flagcdn.com/w320/in.png'),
('360', 'Indonesia', 'https://flagcdn.com/w320/id.png'),
('380', 'Italia', 'https://flagcdn.com/w320/it.png'),
('392', 'Japón', 'https://flagcdn.com/w320/jp.png'),
('410', 'Corea del Sur', 'https://flagcdn.com/w320/kr.png'),
('458', 'Malasia', 'https://flagcdn.com/w320/my.png'),
('484', 'México', 'https://flagcdn.com/w320/mx.png'),
('504', 'Marruecos', 'https://flagcdn.com/w320/ma.png'),
('528', 'Países Bajos', 'https://flagcdn.com/w320/nl.png'),
('554', 'Nueva Zelanda', 'https://flagcdn.com/w320/nz.png'),
('566', 'Nigeria', 'https://flagcdn.com/w320/ng.png'),
('578', 'Noruega', 'https://flagcdn.com/w320/no.png'),
('591', 'Panamá', 'https://flagcdn.com/w320/pa.png'),
('604', 'Perú', 'https://flagcdn.com/w320/pe.png'),
('616', 'Polonia', 'https://flagcdn.com/w320/pl.png'),
('620', 'Portugal', 'https://flagcdn.com/w320/pt.png'),
('643', 'Rusia', 'https://flagcdn.com/w320/ru.png'),
('682', 'Arabia Saudita', 'https://flagcdn.com/w320/sa.png'),
('702', 'Singapur', 'https://flagcdn.com/w320/sg.png'),
('704', 'Vietnam', 'https://flagcdn.com/w320/vn.png'),
('710', 'Sudáfrica', 'https://flagcdn.com/w320/za.png'),
('724', 'España', 'https://flagcdn.com/w320/es.png'),
('752', 'Suecia', 'https://flagcdn.com/w320/se.png'),
('756', 'Suiza', 'https://flagcdn.com/w320/ch.png'),
('764', 'Tailandia', 'https://flagcdn.com/w320/th.png'),
('784', 'Emiratos Árabes Unidos', 'https://flagcdn.com/w320/ae.png'),
('792', 'Turquía', 'https://flagcdn.com/w320/tr.png'),
('818', 'Egipto', 'https://flagcdn.com/w320/eg.png'),
('826', 'Reino Unido', 'https://flagcdn.com/w320/gb.png'),
('840', 'Estados Unidos', 'https://flagcdn.com/w320/us.png'),
('862', 'Venezuela', 'https://flagcdn.com/w320/ve.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`cnn3m`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
