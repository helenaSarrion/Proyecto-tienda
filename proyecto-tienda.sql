-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-06-2023 a las 06:36:52
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto-tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `Categoria` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`Categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`Categoria`, `Nombre`, `Descripcion`) VALUES
(1, 'Tazas', 'tazas'),
(2, 'Poster', 'poster'),
(3, 'Camisetas', 'camisetas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230315144630', '2023-03-15 15:46:53', 148);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `CodPed` int NOT NULL AUTO_INCREMENT,
  `CodUsu` int NOT NULL,
  `Enviado` int NOT NULL,
  `Fecha` datetime NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Telefono` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `metodo_pago` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Total` decimal(10,2) DEFAULT NULL,
  `cod_Prod` int DEFAULT NULL COMMENT 'Código único del producto comprado',
  `nombre_Prod` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'Nombre del producto comprado',
  `cantidad` int DEFAULT NULL,
  `tamano` varchar(20) DEFAULT NULL,
  `talla` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`CodPed`),
  KEY `CodUsu` (`CodUsu`)
) ENGINE=MyISAM AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`CodPed`, `CodUsu`, `Enviado`, `Fecha`, `Nombre`, `Direccion`, `Telefono`, `Email`, `metodo_pago`, `Total`, `cod_Prod`, `nombre_Prod`, `cantidad`, `tamano`, `talla`) VALUES
(138, 8, 0, '2023-06-11 16:10:28', 'helena', 'avd pablo picasso', '635087841', 'helena@gmail.com', 'paypal', '19.00', 20, 'Vini Jr', 1, NULL, 'M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `CodProd` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` varchar(90) NOT NULL,
  `Stock` int NOT NULL,
  `Categoria` int NOT NULL,
  `Precio` float NOT NULL,
  `image_link` text COMMENT 'ENLACE DE LA IMAGEN DEL PRODUCTO',
  `fecha_creacion` date DEFAULT NULL COMMENT 'fecha de creacion del producto',
  `additional_images` text,
  `id_talla` int DEFAULT NULL,
  `id_tamano` int DEFAULT NULL,
  PRIMARY KEY (`CodProd`),
  KEY `Categoria` (`Categoria`),
  KEY `id_talla` (`id_talla`),
  KEY `id_tamano` (`id_tamano`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`CodProd`, `Nombre`, `Descripcion`, `Stock`, `Categoria`, `Precio`, `image_link`, `fecha_creacion`, `additional_images`, `id_talla`, `id_tamano`) VALUES
(1, 'Taza DC Comics - Wonder Woman ', 'Taza', 12, 1, 9.5, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/imagen1.jpg', '2023-03-21', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/imagen1.jpg', NULL, NULL),
(2, 'Ellie The last of us', 'Dibujo Ellie The last of us', 11, 2, 200, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/faew.jpg', '2023-03-15', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/poster/poster10.jpg', NULL, 1),
(3, 'Taylor Swift Era', 'Taylor Swift camiseta', 16, 3, 12.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/camiseta.png', '2023-03-21', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/camiseta.png', 2, NULL),
(4, 'Lexa Los 100', 'Poster de Lexa, serie los 100', 9, 2, 15.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/nwajfer.jpg', '2023-03-22', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/poster/poster6.jpg', NULL, 2),
(5, 'Champagne problems', 'Taylor swift taza - Evermore', 13, 1, 12.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/taza1.png', '2023-04-05', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/taza1.png', NULL, NULL),
(6, 'Eras Tour ', 'Taylor Swift  taza - Tour', 16, 1, 14.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/taza2.png', '2023-04-05', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/taza2.png', NULL, NULL),
(7, 'Enchanted ', 'Poster TS ', 36, 2, 14.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/poster2.jpg', '2023-04-05', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/poster/poster11.jpg', NULL, 3),
(8, 'Evermore ', 'Poster TS', 30, 2, 9.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/poster3.jpg', '2023-04-05', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/poster/poster12.jpg', NULL, 2),
(9, 'Wonder Woman', 'Poster WW', 38, 2, 8.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/poster7.png', '2023-04-05', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/poster7.png', NULL, 3),
(19, 'Fernando Alonso (El Plan)', 'Camiseta del nano', 26, 3, 25.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/alonso.png', '2023-04-20', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/alonso.png', 3, NULL),
(20, 'Vini Jr', 'Camiseta de vini', 16, 3, 19.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/vini.png', '2023-04-20', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/vini.png', 2, NULL),
(21, 'El nano', 'Camiseta de alonso', 32, 3, 25.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/nano.png', '2023-04-20', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/nano.png', 3, NULL),
(22, 'The Mummy', 'Poster de la pelicula de La Momia', 9, 2, 16.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/poster11.jpg', '2023-05-10', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/poster/poster13.jpg', NULL, 2),
(23, 'Killing Eve - God, I´m Tired', 'Poster de la serie Killing eve', 9, 2, 8.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/hdaiwu.jpg', '2023-06-01', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/poster/poster1.jpg', NULL, 1),
(24, 'Black Widow - MARVEL', 'Poster de Black Widow, pelicula de marvel', 15, 2, 9.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/fwqe.jpg', '2023-06-01', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/poster/poster8.jpg', NULL, 3),
(25, 'Lost - Perdidos', 'Poster de la serie de Lost', 25, 2, 16.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/fwqa.jpg', '2023-06-01', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/poster/poster2.jpg', NULL, 3),
(26, 'Tomb Raider - Lara', 'Lara Croft - poster', 7, 2, 8.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/fawe.jpg', '2023-06-01', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/poster/poster3.jpg', NULL, 2),
(27, 'The Mummy - Adventure Is Reborn', 'La momia poster', 12, 2, 6.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/avassd.jpg', '2023-06-01', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/poster/poster5.jpg', NULL, 1),
(28, 'The Lord of the Rings ', 'Poster de la famosa saga del señor de los anillos', 14, 2, 14.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/afwe.jpg', '2023-06-01', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/poster/poster4.jpg', NULL, 3),
(29, 'Villanelle - Killing Eve', 'Villanelle poster', 21, 2, 12.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/vqwerg.jpg', '2023-06-01', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/poster/poster9.jpg', NULL, 1),
(30, 'The Last Of Us - Ellie', 'Camiseta de Ellie', 14, 3, 12.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/camiseta2.jpg', '2023-06-02', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/faew.jpg', 2, NULL),
(31, 'Lexa - Heda', 'Camiseta de Lexa, serie los 100', 21, 3, 9.99, 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/camiseta1.jpg', '2023-06-02', 'https://banco-imagenes-helen.s3.eu-north-1.amazonaws.com/nwajfer.jpg', 3, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallas`
--

DROP TABLE IF EXISTS `tallas`;
CREATE TABLE IF NOT EXISTS `tallas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tallas`
--

INSERT INTO `tallas` (`id`, `nombre`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL'),
(5, 'XXL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamanos`
--

DROP TABLE IF EXISTS `tamanos`;
CREATE TABLE IF NOT EXISTS `tamanos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tamanos`
--

INSERT INTO `tamanos` (`id`, `nombre`) VALUES
(1, 'A1'),
(2, 'A2'),
(3, 'A3'),
(4, 'A4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nombre`) VALUES
(8, 'helena@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$eTJGR1B2VkNiaGRrUFdoUQ$IYiAKWvl4KQCk5NTG415LN/RBjhV9lhjW5oJEhwYksc', 'helena'),
(9, 'juan@juan.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$QW5kUHpqaVF6ekxIR08wVg$77uDqZmt9x0DVyGNS6PsHIbcAETgq0D8N8cFh76Ix78', 'juan'),
(10, 'josecarlos@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$anZwdndpbWJJSzZqSXFxWg$0XgmOdghSJbPKeGOP5xB5IC+qsBAeZGgYJcDTJic0i0', 'jose carlos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `CodUsu` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(20) NOT NULL,
  `Clave` int NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`CodUsu`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`CodUsu`, `Nombre`, `Clave`, `Email`) VALUES
(1, 'helena', 1234, 'helena@gmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
