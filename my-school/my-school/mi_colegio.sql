-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 17-07-2024 a las 05:36:14
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mi_colegio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
CREATE TABLE IF NOT EXISTS `alumnos` (
  `id_alumno` int NOT NULL AUTO_INCREMENT,
  `nombre_alumno` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `apellido_alumno` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rut_alumno` varchar(13) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_curso` int DEFAULT NULL,
  `id_cliente` int DEFAULT NULL,
  PRIMARY KEY (`id_alumno`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_curso` (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `nombre_alumno`, `apellido_alumno`, `rut_alumno`, `id_curso`, `id_cliente`) VALUES
(52, 'CHRISTIAN', 'ROJAS', '19.159.730-3', 29, 2),
(53, 'ANTONIA', 'CORTES111', '20.974.051-6', 27, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boleta`
--

DROP TABLE IF EXISTS `boleta`;
CREATE TABLE IF NOT EXISTS `boleta` (
  `id_boleta` int NOT NULL AUTO_INCREMENT,
  `nombre_boleta` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `apellido_boleta` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_boleta` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tel_boleta` int DEFAULT NULL,
  `direccion_boleta` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion_direc` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cod_pedido` int NOT NULL,
  `fecha_boleta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total` int NOT NULL,
  `estado` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_boleta`),
  KEY `cod_pedido` (`cod_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `boleta`
--

INSERT INTO `boleta` (`id_boleta`, `nombre_boleta`, `apellido_boleta`, `email_boleta`, `tel_boleta`, `direccion_boleta`, `descripcion_direc`, `cod_pedido`, `fecha_boleta`, `total`, `estado`) VALUES
(16, 'NICOLAS', 'PEREZ', 'Daniel.gonzalez@gmail.com', 122131232, 'dasdasdasd', '', 8934, '2024-07-17 05:34:14', 115301, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nombre_cat` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_cat`) VALUES
(12, 'ESCRITURA'),
(14, 'ARTE'),
(15, 'CUADERNOS'),
(16, 'LAPICERÍA'),
(17, 'PAPELERÍA'),
(18, 'ARCHIVAR'),
(19, 'TECNOLOGÍA'),
(20, 'HERRAMIENTAS DE MEDICIÓN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `rut` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido`, `rut`, `email`, `password`) VALUES
(2, 'Antonia', 'Cortes Sarria', '209740516', 'acortessarria@gmail.com', '$2y$10$Zo.kYO4cS1GEQ/00PIqxM..YrCjv8ml8PMNNHjKZtNTenHgn9WO7.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colegio`
--

DROP TABLE IF EXISTS `colegio`;
CREATE TABLE IF NOT EXISTS `colegio` (
  `id_colegio` int NOT NULL AUTO_INCREMENT,
  `nombre_colegio` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `direc_colegio` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `fono` int NOT NULL,
  `id_comuna` int NOT NULL,
  PRIMARY KEY (`id_colegio`),
  KEY `id_comuna` (`id_comuna`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colegio`
--

INSERT INTO `colegio` (`id_colegio`, `nombre_colegio`, `direc_colegio`, `fono`, `id_comuna`) VALUES
(1, 'ESCUELA AMERICA', 'Calle Las Violetas #1234', 947483647, 1),
(2, 'LICEO VALLE DE CODPA', 'Calle El Roble #5678', 948523641, 2),
(3, 'ESCUELA COLPITAS', 'Calle Los Álamos #9101', 934569865, 3),
(4, 'ESCUELA THILDA PORTILLO OLIVARES', 'Calle La Florida #1121', 945678901, 4),
(5, 'ESCUELA BÁSICA LA TIRANA', 'Calle Los Nogales #3141', 956789012, 5),
(6, 'LICEO CAMIÑA', 'Calle El Bosque #5161', 967890123, 6),
(7, 'COLEGIO SAN LUIS', 'Calle Los Cipreses #7181', 978901234, 7),
(8, 'COLEGIO PADRE ALBERTO HURTADO', 'Calle La Cumbre #9202', 978901234, 8),
(9, 'ESCUELA JULIA HERRERA VARAZ', 'Calle Las Palmeras #1323', 990123456, 9),
(10, 'ESCUELA MIREYA ZULETA ASTUDILLO', 'Calle Los Castaños #3343', 990123456, 10),
(11, 'COLEGIO AMBROSIO O´HIGGINS', 'Calle El Parque #5363', 912346789, 11),
(12, 'COLEGIO SAN PATRICIO ATACAMA', 'Calle Los Olmos #7383', 923457890, 12),
(13, 'COLEGIO CRISTOBAL COLÓN', 'Calle La Estrella #9404', 934568901, 13),
(14, 'LICEO GABRIELA MISTRAL', 'Calle Las Brisas #1425', 945679012, 14),
(15, 'COLEGIO SANTA MARIA EUFRESIA', 'Calle El Mirador #3445', 956780123, 15),
(16, 'ESCUELA CANAL BEAGLE', 'Calle Los Laureles #5465', 967891234, 16),
(17, 'COLEGIO EL FARO', 'Calle La Reina #7485', 978902345, 17),
(18, 'COLEGIO MARIA GORETTI', 'Calle Las Araucarias #9506', 989013456, 18),
(19, 'COLEGIO LOS OLIVOS', 'Calle El Sol #1527', 990124567, 19),
(20, 'COLEGIO LOS NOGALES', 'Calle Los Maitenes #3547', 901235678, 20),
(21, 'ESCUELA JULIETA BECERRA ÁLVAREZ', 'Calle La Paz #5567', 912347890, 21),
(22, 'AURORA DE CHILE', 'Calle Las Flores #7587', 923458901, 22),
(23, 'COLEGIO CENTRO EDUCACIONAL LA FLORIDA', 'Calle El Retiro #9608', 934569012, 23),
(24, 'ESCUELA MUNICIPAL VALLE HERMOSO', 'Calle Los Álamos #1629', 945670123, 24),
(25, 'ESCUELA DOCKSTA', 'Calle La Campana #3649', 956781234, 25),
(26, 'COLEGIO ANGLICANO WILLIAM WILSON', 'Calle Las Dalias #5669', 967892345, 26),
(27, 'LICEO POLITECNICO SANTA CRUZ', 'Calle El Refugio #7689', 978903456, 27),
(28, 'COLEGIO LOS HEROES', 'Calle Los Naranjos #9709', 989014567, 28),
(29, 'COLEGIO DEPORTIVO LUIS CRUZ MARTÍNEZ', 'Calle La Torre #1720', 990125678, 29),
(30, 'COLEGIO MARIA AUXILIADORA', 'Calle Las Amapolas #3740', 901236789, 30),
(31, 'COLEGIO HISPANO AMERICANO', 'Calle El Llano #5760', 912348901, 31),
(32, 'COLEGIO HALCONES DEL CARMEN', 'Calle Los Pinos #7780', 923459012, 32),
(33, 'COLEGIO DAFNE ZAPATA', 'Calle La Loma #9801', 934560123, 33),
(34, 'COLEGIO A-LAFKEN', 'Calle Las Rosas #1821', 945671234, 34),
(35, 'COLEGIO DOCTOR GUILLERMO VELASCO BARROS', 'Calle El Sauce #3841', 956782345, 35),
(36, 'COLEGIO AMANECER', 'Calle Los Paltos #5861', 967893456, 36),
(37, 'ESCUELA PARTICULAR HUMBERTO HERNANDEZ', 'Calle La Violeta #7881', 978904567, 37),
(38, 'COLEGIO MARIA DEOGRACIA', 'Calle Las Azucenas #9902', 989015678, 38),
(39, 'LICEO ANTONIO VARAZ', 'Calle El Peumo #1923', 990126789, 39),
(40, 'COLEGIO CARPE DIEM', 'Calle Los Peumos #3943', 901237890, 40),
(41, 'COLEGIO SAN PABLO DE ANCUD', 'Calle La Laguna #5963', 912349012, 41),
(42, 'ESCUELA SAN CARLOS DE CHONCHI', 'Calle Las Acacias #7983', 923450123, 42),
(43, 'ESCUELA EUSEBIO IBAR SCHEPELLER', 'Calle El Molino #1004', 934561234, 43),
(44, 'ESCUELA RURAL CON INTERNADO LA TAPERA', 'Calle Los Lingues #2024', 945672345, 44),
(45, 'ESCUELA PEDRO QUINTANA MANSILLA', 'Calle La Sombra #4044', 956783456, 45),
(46, 'LICEO DONALD MC-INTYRE GRIFFTHS', 'Calle Las Claras #6064', 967894567, 46),
(47, 'ESCUELA DIEGO PORTALES', 'Calle Las Claras #6064', 978905678, 47),
(48, 'COLEGIO CRUZ DEL SUR', 'Calle Los Geranios #9105', 989016789, 48);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunas`
--

DROP TABLE IF EXISTS `comunas`;
CREATE TABLE IF NOT EXISTS `comunas` (
  `id_comuna` int NOT NULL AUTO_INCREMENT,
  `nombre_comuna` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_region` int NOT NULL,
  PRIMARY KEY (`id_comuna`),
  KEY `id_region` (`id_region`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comunas`
--

INSERT INTO `comunas` (`id_comuna`, `nombre_comuna`, `id_region`) VALUES
(1, 'COMUNA DE ARICA', 1),
(2, 'COMUNA DE CAMARONES', 1),
(3, 'COMUNA DE GENERAL LAGOS', 1),
(4, 'COMUNA DE IQUIQUE', 2),
(5, 'COMUNA DE POZO ALMONTE', 2),
(6, 'COMUNA DE CAMIÑA', 2),
(7, 'COMUNA DE ANTOFAGASTA', 3),
(8, 'COMUNA DE CALAMA', 3),
(9, 'COMUNA DE MELIPILLA', 3),
(10, 'COMUNA DE HUASCO', 4),
(11, 'COMUNA DE VALLENAR', 4),
(12, 'COMUNA DE COPIAPO', 4),
(13, 'COMUNA DE COQUIMBO', 5),
(14, 'COMUNA DE LA SERENA', 5),
(15, 'COMUNA DE OVALLE', 5),
(16, 'COMUNA DE VIÑA DEL MAR', 6),
(17, 'COMUNA DE QUINTERO', 6),
(18, 'COMUNA DE CONCÓN', 6),
(19, 'COMUNA DE PIRQUÉ', 7),
(20, 'COMUNA DE PUENTE ALTO', 7),
(21, 'COMUNA DE SAN JOSE DE MAIPO', 7),
(22, 'COMUNA DE LAS CABRAS', 8),
(23, 'COMUNA DE LA ESTRELLA', 8),
(24, 'COMUNA DE PALMILLA', 8),
(25, 'COMUNA DE CHANCO', 9),
(26, 'COMUNA DE CURICÓ', 9),
(27, 'COMUNA DE MOLINA', 9),
(28, 'COMUNA DE CHILLAN', 10),
(29, 'COMUNA DE EL CARMEN', 10),
(30, 'COMUNA DE PEMUCO', 10),
(31, 'COMUNA DE PENCO', 11),
(32, 'COMUNA DE TOMÉ', 11),
(33, 'COMUNA DE TALCAHUANO', 11),
(34, 'COMUNA DE CARAHUE', 12),
(35, 'COMUNA DE CHOLCHOL', 12),
(36, 'COMUNA DE CUNCO', 12),
(37, 'COMUNA DE CORRAL', 13),
(38, 'COMUNA DE FUTRONO', 13),
(39, 'COMUNA DE LAGO RANCO', 13),
(40, 'COMUNA DE CASTRO', 14),
(41, 'COMUNA DE ANCUD', 14),
(42, 'COMUNA DE CHONCHI', 14),
(43, 'COMUNA DE CISNES', 15),
(44, 'COMUNA DE LAGO VERDE', 15),
(45, 'COMUNA DE COYHAIQUE', 15),
(46, 'COMUNA DE CABO DE HORNOS', 16),
(47, 'COMUNA DE LAGUNA BLANCA', 16),
(48, 'COMUNA DE PUNTA ARENAS', 16),
(56, 'COMUNA DE ELQUI', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE IF NOT EXISTS `cursos` (
  `id_curso` int NOT NULL AUTO_INCREMENT,
  `curso` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_colegio` int DEFAULT NULL,
  PRIMARY KEY (`id_curso`),
  KEY `id_colegio` (`id_colegio`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `curso`, `id_colegio`) VALUES
(16, 'PRIMERO BASICO B', 1),
(17, 'SEGUNDO BASICO B', 2),
(18, 'TERCERO BASICO C', 4),
(19, 'SEGUNDO MEDIO H', 8),
(20, 'SEGUNDO BASICO C', 11),
(21, 'SEPTIMO BASICO H', 7),
(22, 'SEXTO BASICO Z', 5),
(23, 'SEPTIMO BASICO A', 51),
(25, 'SEXTO BASICO H', 4),
(26, 'SEGUNDO MEDIO H', 10),
(27, 'OCTAVO BASICO A', 2),
(28, 'TERCERO BASICO A', 5),
(29, 'SEGUNDO BASICO A', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `list_1`
--

DROP TABLE IF EXISTS `list_1`;
CREATE TABLE IF NOT EXISTS `list_1` (
  `id_list` int NOT NULL AUTO_INCREMENT,
  `id_producto` int NOT NULL,
  `cant_prod` int NOT NULL,
  `id_curso` int DEFAULT NULL,
  PRIMARY KEY (`id_list`),
  KEY `id_curso` (`id_curso`),
  KEY `id_producto` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `list_1`
--

INSERT INTO `list_1` (`id_list`, `id_producto`, `cant_prod`, `id_curso`) VALUES
(54, 54, 2, 27),
(55, 26, 1, 27),
(56, 27, 4, 27),
(57, 49, 4, 27),
(58, 29, 4, 27),
(59, 33, 2, 27),
(60, 38, 3, 27),
(61, 52, 5, 27),
(74, 54, 1, 29),
(75, 45, 1, 29),
(76, 26, 1, 29),
(77, 49, 6, 29),
(78, 42, 1, 29),
(79, 28, 2, 29),
(80, 33, 1, 29),
(81, 37, 1, 29),
(82, 36, 3, 29),
(83, 38, 3, 29),
(84, 39, 3, 29),
(85, 30, 1, 29),
(86, 52, 1, 29),
(87, 55, 1, 29),
(88, 40, 1, 29),
(89, 44, 1, 29),
(90, 41, 1, 29),
(91, 43, 1, 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `list_2`
--

DROP TABLE IF EXISTS `list_2`;
CREATE TABLE IF NOT EXISTS `list_2` (
  `id_list` int NOT NULL AUTO_INCREMENT,
  `id_producto` int DEFAULT NULL,
  `cant_prod` int DEFAULT NULL,
  `id_alumno` int NOT NULL,
  `id_curso` int DEFAULT NULL,
  PRIMARY KEY (`id_list`),
  KEY `id_producto` (`id_producto`),
  KEY `id_alumno` (`id_alumno`),
  KEY `id_curso` (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `list_2`
--

INSERT INTO `list_2` (`id_list`, `id_producto`, `cant_prod`, `id_alumno`, `id_curso`) VALUES
(112, 54, 1, 52, NULL),
(113, 45, 1, 52, NULL),
(114, 26, 1, 52, NULL),
(115, 49, 6, 52, NULL),
(116, 42, 1, 52, NULL),
(117, 28, 2, 52, NULL),
(118, 33, 1, 52, NULL),
(119, 37, 1, 52, NULL),
(120, 36, 3, 52, NULL),
(121, 38, 3, 52, NULL),
(122, 39, 3, 52, NULL),
(123, 30, 1, 52, NULL),
(124, 52, 1, 52, NULL),
(125, 55, 1, 52, NULL),
(126, 40, 1, 52, NULL),
(127, 44, 1, 52, NULL),
(128, 41, 1, 52, NULL),
(129, 43, 1, 52, NULL),
(130, 54, 2, 53, NULL),
(131, 26, 1, 53, NULL),
(132, 27, 4, 53, NULL),
(133, 49, 4, 53, NULL),
(134, 29, 4, 53, NULL),
(135, 33, 2, 53, NULL),
(136, 38, 3, 53, NULL),
(137, 52, 5, 53, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

DROP TABLE IF EXISTS `marcas`;
CREATE TABLE IF NOT EXISTS `marcas` (
  `id_marca` int NOT NULL AUTO_INCREMENT,
  `nombre_marca` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `nombre_marca`) VALUES
(2, 'BIC'),
(3, 'STABILO'),
(4, 'KADIO'),
(5, 'MAPED'),
(6, 'FABER-CASTELL'),
(9, 'PROARTE'),
(10, 'PAPER-MATE'),
(11, 'SHARPIE'),
(12, 'TORRE'),
(13, 'ALOCOLOR'),
(14, 'STAEDTLER'),
(15, 'ALOTEN'),
(17, 'COLON');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id_pedido` int NOT NULL AUTO_INCREMENT,
  `id_prod` int DEFAULT NULL,
  `cant_prod` int DEFAULT NULL,
  `id_alumno` int DEFAULT NULL,
  `id_cliente` int DEFAULT NULL,
  `cod_pedido` int DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `id_alumno` (`id_alumno`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_prod` (`id_prod`),
  KEY `cod_pedido` (`cod_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_prod`, `cant_prod`, `id_alumno`, `id_cliente`, `cod_pedido`) VALUES
(140, 54, 2, 53, 2, 3299),
(141, 26, 1, 53, 2, 3299),
(142, 27, 4, 53, 2, 3299),
(143, 49, 4, 53, 2, 3299),
(144, 29, 4, 53, 2, 3299),
(145, 33, 2, 53, 2, 3299),
(146, 38, 3, 53, 2, 3299),
(147, 52, 5, 53, 2, 3299),
(148, 54, 1, 52, 2, 8934),
(149, 45, 1, 52, 2, 8934),
(150, 26, 1, 52, 2, 8934),
(151, 49, 6, 52, 2, 8934),
(152, 42, 1, 52, 2, 8934),
(153, 28, 2, 52, 2, 8934),
(154, 33, 1, 52, 2, 8934),
(155, 37, 1, 52, 2, 8934),
(156, 36, 3, 52, 2, 8934),
(157, 38, 3, 52, 2, 8934),
(158, 39, 3, 52, 2, 8934),
(159, 30, 1, 52, 2, 8934),
(160, 52, 1, 52, 2, 8934),
(161, 55, 1, 52, 2, 8934),
(162, 40, 1, 52, 2, 8934),
(163, 44, 1, 52, 2, 8934),
(164, 41, 1, 52, 2, 8934),
(165, 43, 1, 52, 2, 8934);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id_producto` int NOT NULL AUTO_INCREMENT,
  `nombre_prod` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ruta_img` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `stock_prod` int NOT NULL,
  `precio_prod` int NOT NULL,
  `descripcion_prod` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `id_categoria` int NOT NULL,
  `id_marca` int NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_marca` (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre_prod`, `ruta_img`, `stock_prod`, `precio_prod`, `descripcion_prod`, `id_categoria`, `id_marca`) VALUES
(26, 'CROQUERA', '/my-school/assets/images/products/croquera.jpg', 10, 1000, 'CROQUERA 26 X 37 100 HOJAS ', 14, 12),
(27, 'DESTACADOR TURQUESA', '/my-school/assets/images/products/destacador-turquesa-pastel-stabilo-boss.jpg', 20, 1500, 'DESTACADOR/ES TURQUESA MARCA STABILO', 12, 3),
(28, 'GOMA DE BORRAR', '/my-school/assets/images/products/GOMA-DE-BORRAR-ALO-COLOR.jpg', 50, 500, 'GOMA PARA BORRAR PARA CORREGIR ESCRITURAS DE LAPICES GRAFITO Y DE COLORES DE USO ESCOLAR', 12, 13),
(29, 'GOMA DE BORRAR STAEDTLER', '/my-school/assets/images/products/GOMA-DE-BORRAR-STAEDTLER.jpg', 60, 600, 'GOMA PARA BORRAR PARA CORREGIR ESCRITURAS DE LAPICES GRAFITO Y DE COLORES DE USO ESCOLAR', 12, 14),
(30, 'PACK DE 15 DESTACADORES', '/my-school/assets/images/products/Destacador-Boss-NeonPastel-15-Colores-Stabilo.png', 15, 10000, 'DESTACADOR/ES STABILO DE DIFRENTES COLORES 8 FLUO + 6 PASTEL', 12, 3),
(31, 'LAPICES COLOR STAEDTLER X12', '/my-school/assets/images/products/LAPICES-COLOR-12-STAEDTLER.jpg', 20, 2000, 'LAPICES DE COLOR IDEAL PARA PINTAR O COLOREAR, COLORES MAS BRILLANTES Y SUAVES, HECHO EN ALEMANIA', 16, 14),
(32, 'LAPICES COLOR STAEDTLER X24', '/my-school/assets/images/products/LAPICES-COLOR-24-STAEDTLER.jpg', 40, 3000, 'LAPICES DE COLOR IDEALES PARA PINTAR O COLOREAR, COLORES MAS BRILLANTES Y SUAVES, HECHO EN ALEMANIA', 16, 14),
(33, 'LAPICES COLOR ALOCOLOR X12', '/my-school/assets/images/products/LAPICES-COLOR-12-ALOCOLOR.jpg', 10, 2000, 'LAPICES DE COLOR IDEAL PARA PINTAR Y COLOREAR FACIL DE SOSTENER', 16, 13),
(34, 'LAPICES COLOR ALOCOLOR X24', '/my-school/assets/images/products/LAPICES-COLOR-24-ALOCOLOR.jpg', 33, 2500, 'LAPICES DE COLOR IDEAL PARA PINTAR Y COLOREAR FACIL DE SOSTENER', 16, 13),
(36, 'LAPIZ PASTA AZUL BIC', '/my-school/assets/images/products/lapiz-bic-azul.jpg', 33, 1000, 'LAPIZ PASTA AZUL MARCA BIC', 12, 2),
(37, 'LAPIZ BICOLOR', '/my-school/assets/images/products/LAPIZ-BICOLOR-ALOCOLOR.jpg', 27, 3500, 'LAPIZ BICOLOR IDEAL PARA PINTAR POR LOS DOS EXTREMOS + UN SACAPUNTAS', 16, 13),
(38, 'LAPIZ PASTA NEGRO BIC', '/my-school/assets/images/products/LAPIZ-PASTA-BIC-PT.GRUESA-NEGRO.png', 10, 1000, 'LAPIZ PASTA NEGRO BIC', 12, 2),
(39, 'LAPIZ PASTA ROJO BIC', '/my-school/assets/images/products/LAPIZ-PASTA-BIC-ROJO.jpg', 17, 1000, 'LAPIZ PASTA ROJO BIC', 12, 2),
(40, 'REDMA DE HOJAS ', '/my-school/assets/images/products/redma-papel.jpg', 19, 5000, 'PAPEL MULTIPROPOSITO PARA IMPRIMIR SUS TRABAJOS DE LA MEJOR MANERA', 17, 10),
(41, 'TÉMPERA PROARTE X12', '/my-school/assets/images/products/tempera.jpg', 20, 6500, 'TEMPERA AL AGUA FACIL DE LIMPIAR Y CON UNA GAMA DE COLORES PARA SUS COMBINACIONES', 14, 9),
(42, 'ESCUADRA MAPED ', '/my-school/assets/images/products/escuadra-maped.jpg', 30, 7000, 'ESCUADRA MAPED DE 45°-26CM', 20, 5),
(43, 'TRANSPORTADOR MAPED', '/my-school/assets/images/products/transportador-maped-360°.jpg', 24, 7000, 'TRANSPORTADOR 360°-12CM', 20, 5),
(44, 'REGLA MAPED', '/my-school/assets/images/products/regla-30-maped.jpg', 22, 4000, 'REGLA MAPED DE 30 CM', 20, 5),
(45, 'COMPÁS TORRE', '/my-school/assets/images/products/compas_torre.jpg', 18, 3000, 'COMPÁS TORRE EFICIENTE PARA HACER SUS TRABAJOS DE MATEMÁTICAS', 20, 12),
(46, 'CUADERNO COLON ', '/my-school/assets/images/products/Cuaderno-dragonball-colon.jpg', 10, 5000, 'CUADERNO/S UNIVERSITARIO DE 100 HOJAS DE DRAGON BALL', 15, 17),
(47, 'CUADERNO COLON ', '/my-school/assets/images/products/cuaderno-onepiece-colon.png', 10, 5000, 'CUADERNO/S UNIVERSITARIO DE 100 HOJAS DE ONE PIECE', 15, 17),
(48, 'PACK 4 CUADERNOS COLON', '/my-school/assets/images/products/cuadernos-juegos-colon.png', 8, 16990, 'CUADERNO/S DE 150 HOJAS DE DIFERENTES JUEGOS ACTUALES UNCHARTED 4, THE LAST OF US PART 2, GHOST OF THUSHIMA, HORIZON', 15, 17),
(49, 'CUADERNO COLON', '/my-school/assets/images/products/cuaderno-verde-colon.jpg', 10, 4000, 'CUADERNO/S UNIVERSITARIO DE 100 HOJAS DE COLOR VERDE', 15, 17),
(50, 'CUADERNO COLON ', '/my-school/assets/images/products/cuaderno-azul-colon.jpg', 20, 4000, 'CUADERNO/S UNIVERSITARIO DE 100 HOJAS DE COLOR AZUL', 15, 17),
(51, 'PAPELITOS POST IT TORRE', '/my-school/assets/images/products/pack-5-post-it-torre.jpg', 15, 1500, 'PAPELITOS TIPO POST IT DE 5 COLORES DISTINTOS MARCA TORRE', 17, 12),
(52, 'PAPELITOS POST IT TORRE', '/my-school/assets/images/products/post it-transparente-torre.jpg', 15, 2500, 'PAPELITOS TIPO POST TRANSPARENTES MARCA TORRE', 17, 12),
(53, 'CALCULADORA KADIO', '/my-school/assets/images/products/calculadora-normal-kadio.jpg', 20, 5000, 'CALCULADORA KADIO PARA MATEMATICAS SUMA, RESTA, DIVISIÓN Y MULTIPLICACIÓN', 19, 4),
(54, 'CALCULADORA CIENTÍFICA KADIO', '/my-school/assets/images/products/calculadora-cientifica-kadio.png', 25, 10000, 'CALCULADORA CIENTÍFICA KADIO PARA MATEMATICAS MAS AVANZADAS', 19, 4),
(55, 'PENDRIVE KADIO', '/my-school/assets/images/products/pendrive-kadio.jpg', 15, 6990, 'PENDRIVE DE 8GB IDEAL PARA GUARDAR TRABAJOS', 19, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regiones`
--

DROP TABLE IF EXISTS `regiones`;
CREATE TABLE IF NOT EXISTS `regiones` (
  `id_region` int NOT NULL AUTO_INCREMENT,
  `nombre_region` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_region`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `regiones`
--

INSERT INTO `regiones` (`id_region`, `nombre_region`) VALUES
(1, 'REGION DE ARICA Y PARINACOTA'),
(2, 'REGION DE TARAPACÁ'),
(3, 'REGION DE ANTOFAGASTA'),
(4, 'REGION DE ATACAMA'),
(5, 'REGION DE COQUIMBO'),
(6, 'REGION DE VALPARAISO'),
(7, 'REGION METROPOLITANA'),
(8, 'REGION DE O´HIGGINS'),
(9, 'REGION DEL MAULE'),
(10, 'REGION DE ÑUBLE'),
(11, 'REGION DEL BIOBÍO'),
(12, 'REGION DE LA ARAUCANÍA'),
(13, 'REGION DE LOS RÍOS'),
(14, 'REGION DE LOS LAGOS'),
(15, 'REGION DE AYSÉN'),
(16, 'REGION DE MAGALLANES Y ANTARTICA CHILENA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeta`
--

DROP TABLE IF EXISTS `tarjeta`;
CREATE TABLE IF NOT EXISTS `tarjeta` (
  `id_tarjeta` int NOT NULL AUTO_INCREMENT,
  `titular_tarjeta` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numero_tarjeta` int DEFAULT NULL,
  `fecha_tarjeta` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `cvv` int DEFAULT NULL,
  `id_cliente` int DEFAULT NULL,
  PRIMARY KEY (`id_tarjeta`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tarjeta`
--

INSERT INTO `tarjeta` (`id_tarjeta`, `titular_tarjeta`, `numero_tarjeta`, `fecha_tarjeta`, `cvv`, `id_cliente`) VALUES
(3, 'Christian Rojas', 2147483647, '1', 123, 2),
(4, 'Christian Rojas', 2147483647, '12345', 123, 2),
(5, 'Christian Rojas', 2147483647, '0', 123, 2),
(6, 'NICOLAS PEREZ', 2147483647, '0.500000000', 123, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_nac` date NOT NULL,
  `rol` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `email`, `fecha_nac`, `rol`) VALUES
(31, 'DANIEL GONZALEZ CONTRERAS', '$2y$10$bFnzQtawb.6CHKl0PrjK1u/58n0SUMWeeYPXwZN31jfMrfdKWx7.S', 'Daniel.gonzalez@gmail.com', '2024-04-24', 'Super Admin'),
(38, 'CHRISTIAN ROJAS', '$2y$10$uUMSSHjXVV3yKdSzmsVIzuvJpDuyjYw2jLJdgGsHwHl1d6vfF9m1m', 'christian.rojas59730@gmail.com', '2000-12-11', 'Admin General');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `alumnos_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`);

--
-- Filtros para la tabla `boleta`
--
ALTER TABLE `boleta`
  ADD CONSTRAINT `fk_cod_pedido` FOREIGN KEY (`cod_pedido`) REFERENCES `pedidos` (`cod_pedido`);

--
-- Filtros para la tabla `colegio`
--
ALTER TABLE `colegio`
  ADD CONSTRAINT `colegio_ibfk_1` FOREIGN KEY (`id_comuna`) REFERENCES `comunas` (`id_comuna`);

--
-- Filtros para la tabla `comunas`
--
ALTER TABLE `comunas`
  ADD CONSTRAINT `comunas_ibfk_1` FOREIGN KEY (`id_region`) REFERENCES `regiones` (`id_region`);

--
-- Filtros para la tabla `list_1`
--
ALTER TABLE `list_1`
  ADD CONSTRAINT `list_1_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`),
  ADD CONSTRAINT `list_1_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `list_2`
--
ALTER TABLE `list_2`
  ADD CONSTRAINT `list_2_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `list_2_ibfk_2` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`),
  ADD CONSTRAINT `list_2_ibfk_3` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`id_prod`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`);

--
-- Filtros para la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  ADD CONSTRAINT `tarjeta_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
