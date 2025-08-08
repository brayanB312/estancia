-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-08-2025 a las 03:17:48
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
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pedido`
--

CREATE TABLE `detalles_pedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `total` decimal(10,2) DEFAULT NULL,
  `cliente_nombre` varchar(100) DEFAULT NULL,
  `cliente_email` varchar(100) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `direccion_calle` varchar(100) DEFAULT NULL,
  `direccion_numero` varchar(20) DEFAULT NULL,
  `direccion_colonia` varchar(100) DEFAULT NULL,
  `direccion_ciudad` varchar(100) DEFAULT NULL,
  `direccion_estado` varchar(100) DEFAULT NULL,
  `direccion_cp` varchar(10) DEFAULT NULL,
  `stripe_session_id` varchar(255) DEFAULT NULL,
  `stripe_payment_intent_id` varchar(255) DEFAULT NULL,
  `estado_pedido` varchar(20) DEFAULT 'pendiente',
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `fecha`, `total`, `cliente_nombre`, `cliente_email`, `usuario_id`, `direccion_calle`, `direccion_numero`, `direccion_colonia`, `direccion_ciudad`, `direccion_estado`, `direccion_cp`, `stripe_session_id`, `stripe_payment_intent_id`, `estado_pedido`, `fecha_actualizacion`) VALUES
(1, '2025-08-06 00:58:14', 3297.80, NULL, NULL, NULL, 'Orozco y berra', '2229', 'Consitucion', 'Mexicali', 'Baja California', '21250', NULL, NULL, 'pendiente', '2025-08-06 07:58:14'),
(2, '2025-08-06 00:58:14', 3297.80, NULL, NULL, NULL, 'Orozco y berra', '2229', 'Consitucion', 'Mexicali', 'Baja California', '21250', NULL, NULL, 'pendiente', '2025-08-06 07:58:14'),
(3, '2025-08-06 01:39:07', 44435.60, NULL, NULL, NULL, 'Orozco y berra', '2229', 'Consitucion', 'Mexicali', 'Baja California', '21250', NULL, NULL, 'pendiente', '2025-08-06 08:39:07'),
(4, '2025-08-06 01:41:34', 4946.70, NULL, NULL, NULL, 'Orozco y berra', '2229', 'Consitucion', 'Mexicali', 'Baja California', '21250', NULL, NULL, 'pendiente', '2025-08-06 08:41:34'),
(5, '2025-08-07 14:24:48', 36.63, NULL, NULL, NULL, 'calle loca', '1214', 'pedregal', 'Mexicali', 'Baja California', '21250', NULL, NULL, 'pendiente', '2025-08-07 21:24:48'),
(6, '2025-08-07 14:24:52', 36.63, NULL, NULL, NULL, 'calle loca', '1214', 'pedregal', 'Mexicali', 'Baja California', '21250', NULL, NULL, 'pendiente', '2025-08-07 21:24:52'),
(7, '2025-08-07 14:27:30', 0.11, NULL, NULL, NULL, 's', '1', 's', 'Mexicali', 'Baja California', '21250', NULL, NULL, 'pendiente', '2025-08-07 21:27:30'),
(8, '2025-08-07 14:28:01', 16.17, NULL, NULL, NULL, 'calle loca', '4', 'Consitucion', 'Mexicali', 'Baja California', '21250', NULL, NULL, 'pendiente', '2025-08-07 21:28:01'),
(9, '2025-08-07 14:28:57', 16.17, NULL, NULL, NULL, 'dasdas', '2229', 'Consitucion', 'Mexicali', 'da', '214', NULL, NULL, 'pendiente', '2025-08-07 21:28:57'),
(10, '2025-08-07 14:31:33', 14.30, NULL, NULL, NULL, 'Orozco y berra', '212', 'Consitucion', 'ahi', 'da', '2154', NULL, NULL, 'pendiente', '2025-08-07 21:31:33'),
(11, '2025-08-07 14:59:37', 16.50, NULL, NULL, NULL, 'Orozco y berra', '2229', 'Consitucion', 'Mexicali', 'Baja California', '21250', NULL, NULL, 'pendiente', '2025-08-07 21:59:37'),
(12, '2025-08-07 15:04:33', 17.60, NULL, NULL, NULL, 'calle loca', '1214', 'colonia', 'Mexicali', 'mexicali estado', '21250', NULL, NULL, 'pendiente', '2025-08-07 22:04:33'),
(13, '2025-08-07 15:11:19', 17.60, NULL, NULL, NULL, 'calle trece', '2152', 'colonia aca', 'mazamitla', 'baja california', '21250', NULL, NULL, 'pendiente', '2025-08-07 22:11:19'),
(14, '2025-08-07 15:16:18', 22.22, NULL, NULL, NULL, 'linazas', '1160', 'pedregal', 'mexicali', 'baja california', '8765', NULL, NULL, 'pendiente', '2025-08-07 22:16:18'),
(15, '2025-08-07 15:48:11', 16.50, NULL, NULL, NULL, 'Orozco y berra', '2229', 'Consitucion', 'Mexicali', 'Baja California', '3123', NULL, NULL, 'pendiente', '2025-08-07 22:48:11'),
(16, '2025-08-07 15:52:14', 5.61, NULL, NULL, NULL, 'mexicali', 'das', 'dasd', 'dsada', 'sda', '21312', NULL, NULL, 'pendiente', '2025-08-07 22:52:14'),
(17, '2025-08-07 15:52:22', 39.49, NULL, NULL, NULL, 'mexicali', 'das', 'dasd', 'dsada', 'sda', '21312', NULL, NULL, 'pendiente', '2025-08-07 22:52:22'),
(18, '2025-08-07 15:52:22', 39.49, NULL, NULL, NULL, 'mexicali', 'das', 'dasd', 'dsada', 'sda', '21312', NULL, NULL, 'pendiente', '2025-08-07 22:52:22'),
(19, '2025-08-07 17:19:12', 15.40, NULL, NULL, NULL, 'calle', '2123', 'pollo', 'mexicali', 'baja california', '21252', NULL, NULL, 'pendiente', '2025-08-08 00:19:12'),
(20, '2025-08-07 17:40:46', 29.70, 'noche no te vayas', 'pielcanela@gmail.com', NULL, 'venistiano', '21312', 'carranza', 'Mexicali', 'Baja California', '212341', NULL, NULL, 'pendiente', '2025-08-08 00:40:46'),
(21, '2025-08-07 17:40:46', 29.70, '', '', NULL, 'venistiano', '21312', 'carranza', 'Mexicali', 'Baja California', '212341', NULL, NULL, 'pendiente', '2025-08-08 00:40:46'),
(22, '2025-08-07 17:43:55', 0.00, 'noche no te vayas', 'pielcanela@gmail.com', NULL, 'venistiano', '21312', 'carranza', 'Mexicali', 'Baja California', '212341', NULL, NULL, 'pendiente', '2025-08-08 00:43:55'),
(23, '2025-08-07 17:44:14', 16.50, '', '', NULL, 'Orozco y berra', '2229', 'Consitucion', 'Mexicali', 'Baja California', '21250', NULL, NULL, 'pendiente', '2025-08-08 00:44:14'),
(24, '2025-08-07 17:44:14', 16.50, 'noche no te vayas', 'pielcanela@gmail.com', NULL, 'Orozco y berra', '2229', 'Consitucion', 'Mexicali', 'Baja California', '21250', NULL, NULL, 'pendiente', '2025-08-08 00:44:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_productos`
--

CREATE TABLE `pedido_productos` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT 1,
  `precio_unitario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido_productos`
--

INSERT INTO `pedido_productos` (`id`, `pedido_id`, `producto_id`, `cantidad`, `precio_unitario`) VALUES
(9, 5, 32, 1, 2.00),
(10, 5, 33, 1, 5.00),
(11, 5, 34, 1, 5.00),
(12, 5, 35, 1, 5.00),
(13, 5, 36, 1, 8.00),
(14, 5, 37, 1, 8.00),
(15, 5, 41, 1, 0.10),
(16, 5, 43, 1, 0.10),
(17, 5, 42, 1, 0.10),
(18, 6, 32, 1, 2.00),
(19, 6, 33, 1, 5.00),
(20, 6, 34, 1, 5.00),
(21, 6, 35, 1, 5.00),
(22, 6, 36, 1, 8.00),
(23, 6, 37, 1, 8.00),
(24, 6, 41, 1, 0.10),
(25, 6, 43, 1, 0.10),
(26, 6, 42, 1, 0.10),
(27, 7, 42, 1, 0.10),
(28, 8, 42, 17, 0.10),
(29, 8, 37, 1, 8.00),
(30, 8, 33, 1, 5.00),
(31, 9, 42, 17, 0.10),
(32, 9, 37, 1, 8.00),
(33, 9, 33, 1, 5.00),
(34, 10, 35, 1, 5.00),
(35, 10, 36, 1, 8.00),
(36, 11, 35, 1, 5.00),
(37, 11, 36, 1, 8.00),
(38, 11, 32, 1, 2.00),
(39, 12, 36, 1, 8.00),
(40, 12, 37, 1, 8.00),
(41, 13, 37, 1, 8.00),
(42, 13, 36, 1, 8.00),
(43, 14, 33, 1, 5.00),
(44, 14, 34, 1, 5.00),
(45, 14, 42, 1, 0.10),
(46, 14, 43, 1, 0.10),
(47, 14, 35, 2, 5.00),
(48, 15, 32, 1, 2.00),
(49, 15, 36, 1, 8.00),
(50, 15, 35, 1, 5.00),
(51, 16, 33, 1, 5.00),
(52, 16, 43, 1, 0.10),
(53, 17, 33, 7, 5.00),
(54, 17, 43, 9, 0.10),
(55, 18, 33, 7, 5.00),
(56, 18, 43, 9, 0.10),
(57, 19, 32, 2, 2.00),
(58, 19, 33, 2, 5.00),
(59, 20, 32, 2, 2.00),
(60, 21, 32, 2, 2.00),
(61, 20, 36, 1, 8.00),
(62, 21, 36, 1, 8.00),
(63, 20, 35, 2, 5.00),
(64, 21, 35, 2, 5.00),
(65, 20, 34, 1, 5.00),
(66, 21, 34, 1, 5.00),
(67, 23, 35, 3, 5.00),
(68, 24, 35, 3, 5.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `descripcion`, `imagen`, `tipo`) VALUES
(32, 'Joker', 2.00, '+4 Mult', 'https://balatrowiki.org/images/Joker.png?7edba', 'Common'),
(33, 'Greedy Joker', 5.00, 'Played cards with  Diamond suit give +3 Mult when scored', 'https://balatrowiki.org/images/thumb/Greedy_Joker.png/80px-Greedy_Joker.png?68b5e', 'Common'),
(34, 'Lusty Joker', 5.00, 'Played cards with  Heart suit give +3 Mult when scored', 'https://balatrowiki.org/images/thumb/Lusty_Joker.png/80px-Lusty_Joker.png?76952', 'Common'),
(35, 'Wrathful Joker', 5.00, 'Played cards with  Spade suit give +3 Mult when scored', 'https://balatrowiki.org/images/thumb/Wrathful_Joker.png/80px-Wrathful_Joker.png?76952', 'Common'),
(36, 'Joker Stencil', 8.00, 'X1 Mult for each empty Joker slot. Joker Stencil included', 'https://balatrowiki.org/images/thumb/Joker_Stencil.png/80px-Joker_Stencil.png?e908e', 'Uncommon'),
(37, 'Four Fingers', 8.00, 'All Flushes and Straights can be made with 4 cards', 'https://balatrowiki.org/images/thumb/Four_Fingers.png/80px-Four_Fingers.png?58466', 'Uncommon'),
(38, 'DNA', 8.00, 'If first hand of round has only 1 card, add a permanent copy to deck and draw it to hand', 'https://balatrowiki.org/images/thumb/DNA.png/80px-DNA.png?20c90', 'Rare'),
(39, 'Baron', 8.00, 'Each King held in hand gives X1.5 Mult', 'https://balatrowiki.org/images/thumb/Baron.png/80px-Baron.png?300d5', 'Rare'),
(40, 'Brainstorm', 10.00, 'Copies the ability of leftmost Joker', 'https://balatrowiki.org/images/thumb/Brainstorm.png/80px-Brainstorm.png?82de6', 'Rare'),
(41, 'Triboulet', 0.10, 'Played Kings and Queens each give X2 Mult when scored', 'https://balatrowiki.org/images/thumb/Triboulet.png/80px-Triboulet.png?0f424', 'Legendary'),
(42, 'Yorick', 0.10, 'This Joker gains X1 Mult every 23 [23] cards discarded', 'https://balatrowiki.org/images/thumb/Yorick.png/80px-Yorick.png?7e474', 'Legendary'),
(43, 'Perkeo', 0.10, 'Creates a Negative copy of 1 random consumable card in your possession at the end of the shop', 'https://balatrowiki.org/images/thumb/Perkeo.png/80px-Perkeo.png?1c007', 'Legendary');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contrasena`, `rol`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$W8hYZSyV2pN1A4ZvDKQY.uWUO2EvCfsHj7H.XxY7W6Iy6zq6XZJXe', 'admin'),
(2, 'Admin Principal', '1@gmail.com', '1', 'admin'),
(3, 'Administrador Principal', 'admin@tudominio.com', '$2y$10$W8hYZSyV2pN1A4ZvDKQY.uWUO2EvCfsHj7H.XxY7W6Iy6zq6XZJXe', 'admin'),
(4, 'Admin Principal', 'admin@tutienda.com', '$2y$10$ikXtHbH8l66VgbA4TpLFAOqwzZU5txotroyhHcFoBjHHIyJEUv2nK', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `pedido_productos`
--
ALTER TABLE `pedido_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `pedido_productos`
--
ALTER TABLE `pedido_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD CONSTRAINT `detalles_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `detalles_pedido_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pedido_productos`
--
ALTER TABLE `pedido_productos`
  ADD CONSTRAINT `pedido_productos_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pedido_productos_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
