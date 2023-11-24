-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 20-11-2023 a las 18:44:02
-- Versión del servidor: 8.0.35-0ubuntu0.20.04.1
-- Versión de PHP: 7.4.3-4ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `beerfinder`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locales`
--

CREATE TABLE `locales` (
  `id_local` int NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` text,
  `latitud` decimal(10,6) DEFAULT NULL,
  `longitud` decimal(10,6) DEFAULT NULL,
  `tipo_local` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `locales`
--

INSERT INTO `locales` (`nombre`, `direccion`, `latitud`, `longitud`, `tipo_local`) VALUES
('Dower''s', 'https://maps.app.goo.gl/3RAkPGM2kQW9cWsR7', '37.606043', '-0.981566', 'bar'),
('CID Cafetería', 'https://maps.app.goo.gl/MK39qfCeBTHtSkPz9', '37.606218', '-0.982990', 'bar/cafeteria'),
('Radio Bar', 'https://maps.app.goo.gl/mWyKsQ1Am5HvrU6r5', '37.599912', '-0.986942', 'pub');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas_cerveza`
--

CREATE TABLE `marcas_cerveza` (
  `id_marca` int NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `marcas_cerveza`
--

INSERT INTO `marcas_cerveza` (`id_marca`, `nombre`) VALUES
(92, '1906 black coupage'),
(93, '1906 galician irish red ale'),
(91, '1906 red vingate'),
(90, '1906 reserva especial'),
(55, 'a.k. damm'),
(139, 'affligem blond'),
(140, 'affligem dubbel'),
(141, 'affligem tripel'),
(145, 'aguila'),
(29, 'aguila dorada'),
(28, 'aguila sin filtrar'),
(138, 'alcazar'),
(22, 'alhambra baltic porter'),
(18, 'alhambra barrica de ron granadino'),
(20, 'alhambra especial'),
(19, 'alhambra numerada'),
(24, 'alhambra radler lager singular'),
(16, 'alhambra reserva 1925'),
(21, 'alhambra reserva esencia citra ipa'),
(17, 'alhambra reserva roja'),
(23, 'alhambra sin lager singular'),
(123, 'ambar 1900'),
(122, 'ambar avena'),
(120, 'ambar centeno'),
(100, 'ambar especial'),
(104, 'ambar especial sin gluten'),
(105, 'ambar export'),
(124, 'ambar ipa'),
(119, 'ambar picante'),
(113, 'ambar radler'),
(101, 'ambar triple zero'),
(103, 'ambar triple zero sin gluten'),
(102, 'ambar triple zero tostada'),
(106, 'ambar veltins pilsener'),
(114, 'ambiciosas ambar 10'),
(112, 'ambiciosas ambar azahar'),
(118, 'ambiciosas ambar imperial citrus'),
(117, 'ambiciosas ambar terrae'),
(115, 'ambiciosas ambar trigal'),
(116, 'ambiciosas ambar trufada'),
(121, 'ambrar roja'),
(30, 'amstel'),
(32, 'amstel 0,0'),
(31, 'amstel clasica'),
(38, 'amstel clasica tostada'),
(36, 'amstel oro'),
(37, 'amstel oro 0,0'),
(33, 'amstel radler'),
(34, 'amstel radler 0,0'),
(35, 'amstel radler tostada 0,0'),
(61, 'bock damm'),
(62, 'cervesa de nadal'),
(57, 'cerveza de navidad'),
(49, 'complot'),
(43, 'cruzcampo aniversario'),
(39, 'cruzcampo especial'),
(40, 'cruzcampo gran reserva'),
(42, 'cruzcampo ipa'),
(44, 'cruzcampo shandy'),
(41, 'cruzcampo sin'),
(48, 'damm lemon'),
(53, 'daura'),
(54, 'daura märzen'),
(134, 'desperados'),
(136, 'desperados lime'),
(137, 'desperados mojito'),
(135, 'desperados virgin 0,0'),
(46, 'duet'),
(52, 'equilater'),
(45, 'estrella damm'),
(89, 'estrella de navidad'),
(83, 'estrella del camino'),
(81, 'estrella galicia'),
(84, 'estrella galicia 0,0'),
(87, 'estrella galicia 0,0 negra'),
(86, 'estrella galicia 0,0 tostada'),
(85, 'estrella galicia sin gruten'),
(77, 'estrella levante'),
(78, 'estrella levante 0,0'),
(82, 'estrella levante 0,0 tostada'),
(59, 'free damm'),
(60, 'free damm limon'),
(58, 'free damm tostada'),
(107, 'grevensteiner'),
(108, 'grevensteiner helle'),
(127, 'guinnes 0,0'),
(132, 'guinness clear'),
(130, 'guinness cold brew coffee beer'),
(126, 'guinness draught'),
(131, 'guinness original'),
(129, 'guinness smooth'),
(25, 'heineken'),
(26, 'heineken 0,0'),
(27, 'heineken silver'),
(128, 'hop house 13'),
(50, 'inedit'),
(88, 'la estrella de galicia'),
(144, 'lagunitas hoppy refresher'),
(142, 'lagunitas ipa'),
(143, 'lagunitas maximus'),
(67, 'magna de san miguel'),
(68, 'magna tostada 0,0 de san miguel'),
(6, 'mahou 0,0 tostada'),
(10, 'mahou barrica'),
(12, 'mahou barrica 12 meses'),
(11, 'mahou barrica bourbon'),
(1, 'mahou cinco estrellas'),
(3, 'mahou cinco estrellas ipa'),
(5, 'mahou cinco estrellas readler'),
(2, 'mahou cinco estrellas sin filtrar'),
(4, 'mahou cinco estrellas sin gluten'),
(9, 'mahou clasica'),
(8, 'mahou maestra doble lupulo'),
(7, 'mahou maestra dunkel'),
(15, 'mahou rose'),
(13, 'mahou sin'),
(51, 'malquerida'),
(73, 'manila de san miguel'),
(133, 'paulaner'),
(109, 'pilsner urquell'),
(79, 'punta este'),
(63, 'san miguel'),
(69, 'san miguel 0,0'),
(70, 'san miguel 0,0 radler'),
(71, 'san miguel 0,0 tostada'),
(76, 'san miguel 1516'),
(75, 'san miguel eco'),
(64, 'san miguel especial'),
(66, 'san miguel gluten free'),
(65, 'san miguel radler'),
(72, 'selecta de san miguel'),
(110, 'sierra nevada california ipa'),
(111, 'sierra nevada pale ale'),
(125, 'turia marzen'),
(80, 'verna'),
(98, 'victoria malacati'),
(94, 'victoria malaga'),
(97, 'victoria marengo'),
(96, 'victoria pasos largos'),
(95, 'victoria sin'),
(99, 'victoria vendeja'),
(47, 'voll-damm'),
(56, 'xibeca'),
(74, 'yakima valley de san miguel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas_locales`
--

CREATE TABLE `marcas_locales` (
  `id_marcas_locales` int NOT NULL,
  `id_local` int DEFAULT NULL,
  `nombre_marca` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `marcas_locales`
--

INSERT INTO `marcas_locales` (`id_marcas_locales`, `id_local`, `nombre_marca`) VALUES
(5, 1, 'aguila'),
(6, 1, 'heineken'),
(7, 1, 'amstel'),
(8, 1, 'aguila'),
(9, 1, 'heineken'),
(10, 1, 'amstel'),
(11, 1, 'aguila'),
(12, 1, 'heineken'),
(13, 1, 'amstel'),
(14, 1, 'aguila'),
(15, 1, 'heineken'),
(16, 1, 'amstel');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `locales`
--
ALTER TABLE `locales`
  ADD PRIMARY KEY (`id_local`);

--
-- Indices de la tabla `marcas_cerveza`
--
ALTER TABLE `marcas_cerveza`
  ADD PRIMARY KEY (`id_marca`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `marcas_locales`
--
ALTER TABLE `marcas_locales`
  ADD PRIMARY KEY (`id_marcas_locales`),
  ADD KEY `id_local` (`id_local`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `locales`
--
ALTER TABLE `locales`
  MODIFY `id_local` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `marcas_cerveza`
--
ALTER TABLE `marcas_cerveza`
  MODIFY `id_marca` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT de la tabla `marcas_locales`
--
ALTER TABLE `marcas_locales`
  MODIFY `id_marcas_locales` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `marcas_locales`
--
ALTER TABLE `marcas_locales`
  ADD CONSTRAINT `marcas_locales_ibfk_1` FOREIGN KEY (`id_local`) REFERENCES `locales` (`id_local`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
