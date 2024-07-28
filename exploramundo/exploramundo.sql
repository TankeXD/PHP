-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-12-2023 a las 23:05:48
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `exploramundo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nombre_com` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `rut` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha_nac` date NOT NULL,
  `celular` int NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_com`, `rut`, `fecha_nac`, `celular`, `email`, `direccion`) VALUES
(1, 'nicolas', '20.042.621-5', '2023-12-05', 89787645, 'nicolas@gmail.com', 'Av jorge medina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes`
--

DROP TABLE IF EXISTS `paquetes`;
CREATE TABLE IF NOT EXISTS `paquetes` (
  `id_pack` int NOT NULL AUTO_INCREMENT,
  `nom_pack` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `destino` varchar(30) COLLATE utf8mb3_spanish_ci NOT NULL,
  `fecha_salida` date NOT NULL,
  `fecha_llegada` date NOT NULL,
  `info` varchar(255) COLLATE utf8mb3_spanish_ci NOT NULL,
  `precio` int NOT NULL,
  `inclusion` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `fecha_public` date NOT NULL,
  `fecha_expi` date NOT NULL,
  `img` longblob NOT NULL,
  PRIMARY KEY (`id_pack`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `paquetes`
--

INSERT INTO `paquetes` (`id_pack`, `nom_pack`, `destino`, `fecha_salida`, `fecha_llegada`, `info`, `precio`, `inclusion`, `fecha_public`, `fecha_expi`, `img`) VALUES
(2, 'Veraniego', 'Cancún', '2023-11-09', '2023-11-16', 'este paquete te lo comes', 500, '1', '2023-11-16', '2023-11-18', 0x522e6a666966),
(3, 'veraniego', 'Cancún', '2023-12-15', '2023-12-16', 'este paquete te lo comes', 800000, 'Tour en Ciudad', '2023-12-11', '2023-12-15', 0x6368696e612e6a666966);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE IF NOT EXISTS `reservas` (
  `id_reser` int NOT NULL AUTO_INCREMENT,
  `nom_cli` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `rut` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `fecha_nac` date NOT NULL,
  `telefono` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `correo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `fecha_salida` date NOT NULL,
  `numero_per` int NOT NULL,
  `paquete` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`id_reser`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reser`, `nom_cli`, `rut`, `fecha_nac`, `telefono`, `correo`, `fecha_salida`, `numero_per`, `paquete`) VALUES
(4, 'daniel gonzalez contreras', '9.596.814-7', '2023-12-12', '23334343', 'Daniel.gonzalez@gmail.com', '2023-12-13', 4, 'Veraniego');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha_nac` date NOT NULL,
  `rol` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `email`, `fecha_nac`, `rol`) VALUES
(27, 'nicolas', '$2y$10$hTTUnihqRYjXFgIy.Q8.puII8JjEIWtbuaJDG5Q5SC/qim.PRXTbS', 'nicolas@gmail.com', '2023-12-04', 'Administrador');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
