-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2024 a las 18:27:08
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
-- Base de datos: `pescaderia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `preparacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `id_usuario`, `id_producto`, `cantidad`, `preparacion`) VALUES
(106, 22, 50, 1.5, 'Fileteado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carritos_finalizados`
--

CREATE TABLE `carritos_finalizados` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `preparacion` text DEFAULT NULL,
  `id_orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `carritos_finalizados`
--

INSERT INTO `carritos_finalizados` (`id`, `id_usuario`, `id_producto`, `cantidad`, `preparacion`, `id_orden`) VALUES
(1, 22, 53, 1, 'Limpio y entero', 17),
(2, 22, 50, 1, 'Limpio y entero', 17),
(3, 22, 51, 2, 'Limpio y entero', 17),
(4, 22, 50, 1, 'Fileteado', 18),
(5, 22, 51, 2, 'Limpio y entero', 18),
(6, 4, 50, 2, 'Fileteado', 19),
(7, 4, 50, 1, 'Fileteado', 27),
(8, 4, 50, 1, 'Fileteado', 27),
(9, 4, 50, 1, 'Fileteado', 29),
(10, 4, 50, 1, 'Fileteado', 37),
(11, 4, 50, 1, 'Fileteado', 37),
(12, 4, 51, 1, 'Limpio y entero', 39),
(13, 4, 51, 1, '', 40),
(14, 4, 51, 1, '', 40),
(15, 4, 53, 1, '', 40),
(16, 4, 50, 2, 'Abierto sin espina', 41),
(17, 4, 50, 2, 'Limpio y entero', 42),
(18, 4, 50, 2, 'Rodajas', 43),
(19, 4, 51, 1, 'Limpio y entero', 44),
(20, 4, 50, 1, 'Fileteado', 45),
(21, 4, 50, 1, 'Fileteado', 46),
(22, 4, 51, 1, 'Limpio y entero', 47),
(23, 4, 50, 2, 'Fileteado', 48),
(24, 4, 50, 1, 'Fileteado', 49),
(25, 22, 51, 2, '', 50),
(26, 22, 51, 2, 'Limpio y entero', 51),
(27, 4, 53, 1, 'Limpio y entero', 52),
(28, 4, 51, 2, 'Limpio y entero', 53),
(29, 4, 50, 1, 'Fileteado', 54),
(30, 22, 51, 2, 'Limpio y entero', 56),
(31, 4, 51, 2, 'Limpio y entero', 57),
(32, 4, 50, 1, 'Fileteado', 58),
(33, 4, 50, 1, 'Abierto con espina', 59),
(34, 4, 50, 1, 'Fileteado', 60),
(35, 4, 50, 1, 'Limpio y entero', 61),
(36, 4, 51, 1, 'Limpio y entero', 62),
(37, 4, 51, 1, 'Limpio y entero', 63),
(38, 4, 50, 1, 'Fileteado', 64),
(39, 4, 50, 1, 'Fileteado', 65),
(40, 4, 50, 1, 'Fileteado', 66),
(41, 4, 50, 1, '', 67),
(42, 4, 50, 1, 'Limpio y entero', 68),
(43, 4, 51, 2, 'Limpio y entero', 69),
(44, 4, 50, 1, 'Abierto sin espina', 70),
(45, 4, 53, 2, '', 71);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Pescado Blanco'),
(2, 'Pescado Azul'),
(3, 'Cefalópodos'),
(4, 'Marisco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `precio_total` decimal(10,2) NOT NULL,
  `hora_recogida` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`id`, `usuario_id`, `fecha_compra`, `precio_total`, `hora_recogida`) VALUES
(10, 4, '2024-11-25', 11.99, '13:47:00'),
(11, 4, '2024-11-25', 32.83, '16:47:00'),
(12, 4, '2024-11-27', 4.00, '20:54:00'),
(13, 22, '2024-11-27', 4.00, '20:00:00'),
(14, 22, '2024-11-27', 4.00, '19:19:00'),
(15, 22, '2024-11-27', 1.50, '16:23:00'),
(16, 22, '2024-11-27', 14.45, '16:44:00'),
(17, 22, '2024-11-27', 14.45, '16:44:00'),
(18, 22, '2024-11-27', 8.48, '17:53:00'),
(19, 4, '2024-11-27', 11.99, '16:56:00'),
(20, 4, '2024-11-27', 11.99, '16:56:00'),
(21, 4, '2024-11-27', 1.50, '11:02:00'),
(22, 4, '2024-11-27', 1.50, '11:03:00'),
(23, 4, '2024-11-27', 5.49, '11:04:00'),
(24, 4, '2024-11-27', 1.50, '11:04:00'),
(25, 4, '2024-11-27', 1.50, '11:05:00'),
(26, 4, '2024-11-27', 4.00, '11:05:00'),
(27, 4, '2024-11-27', 7.99, '11:06:00'),
(28, 4, '2024-11-27', 7.99, '11:06:00'),
(29, 4, '2024-11-27', 4.00, '12:08:00'),
(30, 4, '2024-11-27', 1.50, '17:10:00'),
(31, 4, '2024-11-27', 1.50, '17:10:00'),
(32, 4, '2024-11-27', 1.50, '17:10:00'),
(33, 4, '2024-11-27', 1.50, '17:10:00'),
(34, 4, '2024-11-27', 1.50, '17:10:00'),
(35, 4, '2024-11-27', 1.50, '17:10:00'),
(36, 4, '2024-11-27', 4.00, '17:13:00'),
(37, 4, '2024-11-27', 7.99, '16:16:00'),
(38, 4, '2024-11-27', 7.99, '16:16:00'),
(39, 4, '2024-11-28', 2.99, '19:40:00'),
(40, 4, '2024-11-28', 8.96, '18:43:00'),
(41, 4, '2024-11-28', 11.99, '18:50:00'),
(42, 4, '2024-11-28', 11.99, '19:52:00'),
(43, 4, '2024-11-28', 11.99, '18:53:00'),
(44, 4, '2024-11-28', 1.50, '18:57:00'),
(45, 4, '2024-11-28', 4.00, '18:59:00'),
(46, 4, '2024-11-28', 7.99, '19:01:00'),
(47, 4, '2024-11-28', 1.50, '19:04:00'),
(48, 4, '2024-11-28', 15.98, '14:17:00'),
(49, 4, '2024-11-28', 7.99, '16:10:00'),
(50, 22, '2024-12-04', 4.49, '18:40:00'),
(51, 22, '2024-12-04', 4.49, '18:43:00'),
(52, 4, '2024-12-04', 4.48, '18:48:00'),
(53, 4, '2024-12-04', 4.49, '18:54:00'),
(54, 4, '2024-12-04', 4.00, '18:55:00'),
(55, 4, '2024-12-04', 4.48, '20:00:00'),
(56, 22, '2024-12-04', 4.49, '19:09:00'),
(57, 4, '2024-12-03', 4.49, '15:18:00'),
(58, 4, '2024-12-05', 4.00, '20:04:00'),
(59, 4, '2024-12-05', 4.00, '20:10:00'),
(60, 4, '2024-12-05', 4.00, '19:42:00'),
(61, 4, '2024-12-05', 4.00, '19:43:00'),
(62, 4, '2024-12-05', 2.50, '20:44:00'),
(63, 4, '2024-12-05', 2.50, '19:44:00'),
(64, 4, '2024-12-04', 4.00, '19:46:00'),
(65, 4, '2024-12-05', 4.00, '20:49:00'),
(66, 4, '2024-12-05', 4.00, '19:49:00'),
(67, 4, '2024-12-05', 4.00, '19:28:00'),
(68, 4, '2024-12-06', 4.00, '19:29:00'),
(69, 4, '2024-12-08', 7.49, '14:03:00'),
(70, 4, '2024-12-08', 4.00, '18:06:00'),
(71, 4, '2024-12-08', 13.43, '19:14:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preparacion`
--

CREATE TABLE `preparacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `preparacion`
--

INSERT INTO `preparacion` (`id`, `nombre`) VALUES
(1, 'Fileteado'),
(2, 'Limpio y entero'),
(3, 'Abierto con espina'),
(4, 'Abierto sin espina'),
(5, 'Rodajas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio_kg` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `imagen` varchar(255) DEFAULT 'imagen_default.png',
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio_kg`, `stock`, `imagen`, `id_categoria`) VALUES
(50, 'Pescadilla', 'Pescadilla 1-2kg aprox. Producto de peso variable, la cantidad y precio puede variar ligeramente.', 4.99, 12, '673b0a25d7167pescadilla.webp', 1),
(51, 'Bacaladilla', 'Bacaladilla fresca. Producto de peso variable, la cantidad y precio puede variar ligeramente.', 4.99, 10, '673b0b02bfd7dbacaladilla.webp', 2),
(53, 'Langostino', 'Langostino fresco 30-40 piezas por kilogramo.', 8.95, 20, '673ceeaeab171langostino.webp', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_preparacion`
--

CREATE TABLE `productos_preparacion` (
  `id_producto` int(11) NOT NULL,
  `id_preparacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos_preparacion`
--

INSERT INTO `productos_preparacion` (`id_producto`, `id_preparacion`) VALUES
(50, 1),
(50, 2),
(50, 3),
(50, 4),
(50, 5),
(51, 2),
(53, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `phone` int(9) NOT NULL,
  `password` text NOT NULL,
  `validation_code` text DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `rol` enum('admin','customer','','') NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `user_name`, `email`, `phone`, `password`, `validation_code`, `active`, `rol`) VALUES
(4, 'juan', 'juan', 'juan', 'juan@juan.com', 777777777, 'a94652aa97c7211ba8954dd15a3cf838', '0', 1, 'customer'),
(22, 'sergio', 'cordero', 'sergio', 'sergio-cordero@hotmail.es', 690365580, '30aa11d00f675da5379173694f4d4a75', '0', 1, 'admin'),
(45, 'pepa', 'pepa', 'pepa', 'desarrollotest843@gmail.com', 111111111, '30aa11d00f675da5379173694f4d4a75', 'eb8c1cff317666020895d94b0476b0ab', 0, 'customer'),
(46, 'sara', 'sara', 'sara', 'sara@sara.com', 111111111, 'f3329818d419a34fcb14f7a20fbe82b3', 'acb057bc971bc2cb05871fc6d16eb897', 0, 'customer');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `carritos_finalizados`
--
ALTER TABLE `carritos_finalizados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_orden` (`id_orden`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `preparacion`
--
ALTER TABLE `preparacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `productos_preparacion`
--
ALTER TABLE `productos_preparacion`
  ADD PRIMARY KEY (`id_producto`,`id_preparacion`),
  ADD KEY `id_preparacion` (`id_preparacion`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT de la tabla `carritos_finalizados`
--
ALTER TABLE `carritos_finalizados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `preparacion`
--
ALTER TABLE `preparacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `carritos_finalizados`
--
ALTER TABLE `carritos_finalizados`
  ADD CONSTRAINT `carritos_finalizados_ibfk_1` FOREIGN KEY (`id_orden`) REFERENCES `ordenes` (`id`);

--
-- Filtros para la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD CONSTRAINT `ordenes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `productos_preparacion`
--
ALTER TABLE `productos_preparacion`
  ADD CONSTRAINT `productos_preparacion_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productos_preparacion_ibfk_2` FOREIGN KEY (`id_preparacion`) REFERENCES `preparacion` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
