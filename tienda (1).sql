-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-08-2025 a las 22:43:47
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

-- La tabla ya existe, solo aseguramos estructura y claves
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  MODIFY `usuario_id` int(11) DEFAULT NULL,
  MODIFY `producto_id` int(11) DEFAULT NULL,
  MODIFY `cantidad` int(11) DEFAULT 1,
  MODIFY `fecha_agregado` datetime DEFAULT current_timestamp();
ALTER TABLE `carrito`
  DROP FOREIGN KEY IF EXISTS `carrito_ibfk_1`,
  DROP FOREIGN KEY IF EXISTS `carrito_ibfk_2`;
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `producto_id` (`producto_id`);
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

-- --------------------------------------------------------

--

-- Tabla detalles_pedido eliminada por no usarse

-- --------------------------------------------------------

--

-- La tabla ya existe, solo aseguramos estructura y claves
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  MODIFY `fecha` datetime DEFAULT current_timestamp(),
  MODIFY `total` decimal(10,2) DEFAULT NULL,
  MODIFY `cliente_nombre` varchar(100) DEFAULT NULL,
  MODIFY `cliente_email` varchar(100) DEFAULT NULL,
  MODIFY `usuario_id` int(11) DEFAULT NULL,
  MODIFY `direccion_calle` varchar(100) DEFAULT NULL,
  MODIFY `direccion_numero` varchar(20) DEFAULT NULL,
  MODIFY `direccion_colonia` varchar(100) DEFAULT NULL,
  MODIFY `direccion_ciudad` varchar(100) DEFAULT NULL,
  MODIFY `direccion_estado` varchar(100) DEFAULT NULL,
  MODIFY `direccion_cp` varchar(10) DEFAULT NULL,
  MODIFY `stripe_session_id` varchar(255) DEFAULT NULL,
  MODIFY `stripe_payment_intent_id` varchar(255) DEFAULT NULL,
  MODIFY `estado_pedido` varchar(20) DEFAULT 'pendiente',
  MODIFY `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp();
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `fecha`, `total`, `cliente_nombre`, `cliente_email`, `usuario_id`, `direccion_calle`, `direccion_numero`, `direccion_colonia`, `direccion_ciudad`, `direccion_estado`, `direccion_cp`, `stripe_session_id`, `stripe_payment_intent_id`, `estado_pedido`, `fecha_actualizacion`) VALUES
(1, '2025-08-06 00:58:14', 3297.80, NULL, NULL, NULL, 'Orozco y berra', '2229', 'Consitucion', 'Mexicali', 'Baja California', '21250', NULL, NULL, 'pendiente', '2025-08-06 07:58:14'),
(2, '2025-08-06 00:58:14', 3297.80, NULL, NULL, NULL, 'Orozco y berra', '2229', 'Consitucion', 'Mexicali', 'Baja California', '21250', NULL, NULL, 'pendiente', '2025-08-06 07:58:14'),
(3, '2025-08-06 01:39:07', 44435.60, NULL, NULL, NULL, 'Orozco y berra', '2229', 'Consitucion', 'Mexicali', 'Baja California', '21250', NULL, NULL, 'pendiente', '2025-08-06 08:39:07'),
(4, '2025-08-06 01:41:34', 4946.70, NULL, NULL, NULL, 'Orozco y berra', '2229', 'Consitucion', 'Mexicali', 'Baja California', '21250', NULL, NULL, 'pendiente', '2025-08-06 08:41:34');

-- --------------------------------------------------------

--

-- La tabla ya existe, solo aseguramos estructura y claves
ALTER TABLE `pedido_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  MODIFY `pedido_id` int(11) NOT NULL,
  MODIFY `producto_id` int(11) NOT NULL,
  MODIFY `cantidad` int(11) DEFAULT 1,
  MODIFY `precio_unitario` decimal(10,2) DEFAULT NULL,
  MODIFY `talla` varchar(50) DEFAULT NULL,
  MODIFY `color` varchar(50) DEFAULT NULL;
ALTER TABLE `pedido_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `producto_id` (`producto_id`);
ALTER TABLE `pedido_productos`
  ADD CONSTRAINT `pedido_productos_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pedido_productos_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

-- --------------------------------------------------------

--

-- La tabla ya existe, solo aseguramos estructura y claves
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  MODIFY `nombre` varchar(100) NOT NULL,
  MODIFY `precio` decimal(10,2) NOT NULL,
  MODIFY `descripcion` text DEFAULT NULL,
  MODIFY `imagen` varchar(255) DEFAULT NULL,
  MODIFY `tipo` varchar(50) DEFAULT NULL;
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------

--

-- La tabla ya existe, solo aseguramos estructura y claves
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  MODIFY `nombre` varchar(100) NOT NULL,
  MODIFY `correo` varchar(100) NOT NULL,
  MODIFY `contrasena` varchar(255) NOT NULL,
  MODIFY `rol` enum('user','admin') DEFAULT 'user';
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

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
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `producto_id` (`producto_id`);

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
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pedido_productos`
--
ALTER TABLE `pedido_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

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
