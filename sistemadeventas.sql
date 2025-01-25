-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2025 a las 23:33:34
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `sistemadeventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_almacen`
--

CREATE TABLE `tb_almacen` (
  `id_producto` int(11) NOT NULL,
  `codigo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `stock_minimo` int(11) DEFAULT NULL,
  `stock_maximo` int(11) DEFAULT NULL,
  `precio_compra` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `precio_venta` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_almacen`
--

INSERT INTO `tb_almacen` (`id_producto`, `codigo`, `nombre`, `descripcion`, `stock`, `stock_minimo`, `stock_maximo`, `precio_compra`, `precio_venta`, `fecha_ingreso`, `imagen`, `id_usuario`, `id_categoria`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'P-00001', 'COCA QUINA', 'de 2 litros', 15, 20, 500, '9000', '12000', '2023-02-12', '2023-02-12-06-26-25__6020052-1000x1000.jpg', 1, 1, '2023-02-12 18:26:25', '2025-01-21 21:41:01'),
(2, 'P-00002', 'AUDIFONOS', 'Con cargado incorporado', 96, 10, 200, '80000', '120000', '2023-02-13', '2023-02-13-02-29-53__8810fb37cb2f03d30c7c467ec772b5ed6811e7e6.jpeg', 1, 11, '2023-02-13 14:29:53', '2025-01-21 21:41:11'),
(3, 'P-00003', 'VINO TINTO', 'VINO TINTO BLANCO DE 300 ml', 120, 10, 200, '50000', '80000', '2023-02-13', '2023-02-13-02-35-15__vino.JPG', 1, 1, '2023-02-13 14:35:15', '2025-01-21 21:41:18'),
(4, 'P-00004', 'Telefono', 'samgung no se que', 46, 10, 20, '1500000', '2000000', '2024-01-10', '2025-01-15-12-03-37__600__600__a15120-3.jpg', 2, 1, '2025-01-10 21:33:10', '2025-01-15 00:03:37'),
(5, '5555555', 'asdggggf', 'sdf asdfasdf', 15, 10, 50, '1500', '5000', '2025-01-10', '2025-01-15-12-03-45__imagen-principal20320-1-1656006478.jpg', 2, 11, '2025-01-10 21:40:45', '2025-01-15 00:03:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_almacen_servicios`
--

CREATE TABLE `tb_almacen_servicios` (
  `id_servicio` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio_venta` varchar(50) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_almacen_servicios`
--

INSERT INTO `tb_almacen_servicios` (`id_servicio`, `codigo`, `id_categoria`, `nombre`, `precio_venta`, `id_usuario`, `fyh_creacion`, `fyh_update`) VALUES
(1, '1', 8, 'Polarizado Americano', '150000', 1, '2025-01-22 23:12:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_carrito`
--

CREATE TABLE `tb_carrito` (
  `id_carrito` int(11) NOT NULL,
  `nro_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_carrito`
--

INSERT INTO `tb_carrito` (`id_carrito`, `nro_venta`, `id_producto`, `cantidad`, `fyh_creacion`, `fyh_update`) VALUES
(7, 1, 1, 2, '2025-01-17 23:19:57', '0000-00-00 00:00:00'),
(11, 1, 3, 1, '2025-01-20 22:25:32', '0000-00-00 00:00:00'),
(12, 2, 5, 1, '2025-01-21 20:44:57', '0000-00-00 00:00:00'),
(13, 3, 1, 1, '2025-01-21 20:48:19', '0000-00-00 00:00:00'),
(14, 4, 2, 2, '2025-01-21 21:05:35', '0000-00-00 00:00:00'),
(15, 4, 4, 2, '2025-01-21 21:06:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_carrito_servicios`
--

CREATE TABLE `tb_carrito_servicios` (
  `id_carrito` int(11) NOT NULL,
  `nro_servicio` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_carrito_servicios`
--

INSERT INTO `tb_carrito_servicios` (`id_carrito`, `nro_servicio`, `id_servicio`, `cantidad`, `fyh_creacion`, `fyh_update`) VALUES
(5, 1, 1, 2, '2025-01-22 20:46:25', '0000-00-00 00:00:00'),
(6, 2, 1, 2, '2025-01-22 21:44:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_categorias`
--

CREATE TABLE `tb_categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_categorias`
--

INSERT INTO `tb_categorias` (`id_categoria`, `nombre_categoria`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'LIQUIDOS', '2023-01-24 22:25:10', '2023-01-24 22:25:10'),
(2, 'FRUTAS', '2023-01-25 14:39:50', '2023-01-25 15:09:07'),
(3, 'COMIDAS', '2023-01-25 14:40:27', '0000-00-00 00:00:00'),
(4, 'ELECTRODOMESTICOS', '2023-01-25 14:41:14', '0000-00-00 00:00:00'),
(5, 'VERDURAS', '2023-01-25 14:43:06', '0000-00-00 00:00:00'),
(6, 'MEDICAMENTOS Y COMIDAS', '2023-01-25 14:44:51', '2023-01-25 15:09:22'),
(8, 'SERVICIOS', '2023-01-25 17:49:21', '2023-01-25 17:54:25'),
(9, 'algo3', '2023-01-25 17:54:06', '2023-01-25 17:57:31'),
(11, 'ELECTRONICOS', '2023-01-29 23:01:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `id_cliente` int(11) NOT NULL,
  `ruc` varchar(10) NOT NULL,
  `dv` varchar(5) NOT NULL,
  `nombre_cliente` varchar(50) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `direccion` varchar(80) NOT NULL,
  `descripcion_vehiculo` varchar(150) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `id_usuario` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_clientes`
--

INSERT INTO `tb_clientes` (`id_cliente`, `ruc`, `dv`, `nombre_cliente`, `celular`, `email`, `direccion`, `descripcion_vehiculo`, `estado`, `id_usuario`, `fyh_creacion`, `fyh_update`) VALUES
(2, '2216503', '7', 'Claro Villar', '0972728742', '', 'Ayolas', '', 1, 1, '2025-01-18 14:55:22', '0000-00-00 00:00:00'),
(3, '165151', '', 'ddqw', '551561', '', 'dqwdqw', '', 1, 1, '2025-01-18 16:07:36', '0000-00-00 00:00:00'),
(4, '4163797', '5', 'Lis Medina', '0972162163', '', 'Ayolas', '', 1, 1, '2025-01-20 23:51:43', '0000-00-00 00:00:00'),
(6, '55555', '4', 'fqefw', '40808', 'wefd', 'deffefe', 'fewefe', 1, 2, '2025-01-21 20:14:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_compras`
--

CREATE TABLE `tb_compras` (
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nro_compra` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `comprobante` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `precio_compra` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_compras`
--

INSERT INTO `tb_compras` (`id_compra`, `id_producto`, `nro_compra`, `fecha_compra`, `id_proveedor`, `comprobante`, `id_usuario`, `precio_compra`, `cantidad`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 5, 1, '2023-02-12', 11, 'FACTURA', 1, '200', 50, '2023-02-12 23:37:24', '2025-01-11 21:02:42'),
(2, 5, 2, '2023-02-17', 11, 'FACTURA NRO 120', 1, '5000', 50, '2023-02-17 22:35:24', '2025-01-11 21:03:06'),
(3, 1, 3, '2023-02-17', 10, 'NOTA DE VENTA NRO 523', 1, '250', 100, '2023-02-17 22:37:33', '0000-00-00 00:00:00'),
(4, 3, 4, '2023-02-21', 10, 'FACTURA NRO 300', 1, '5000', 50, '2023-02-21 17:08:58', '0000-00-00 00:00:00'),
(5, 3, 5, '2023-02-21', 10, 'NOTA DE VENTA 0001', 1, '1000', 20, '2023-02-21 17:10:16', '2023-03-05 22:17:59'),
(6, 5, 6, '2023-02-21', 11, 'FACTURA NRO 320', 1, '2350', 150, '2023-02-21 17:11:12', '2025-01-12 16:39:50'),
(8, 5, 7, '2025-01-10', 11, '1050505', 1, '35000000', 50, '2025-01-10 21:33:56', '2025-01-11 21:03:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_configuracion`
--

CREATE TABLE `tb_configuracion` (
  `id` int(11) NOT NULL,
  `ruc` varchar(15) NOT NULL,
  `dv` varchar(5) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `razon_social` varchar(60) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_proveedores`
--

CREATE TABLE `tb_proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `celular` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_proveedores`
--

INSERT INTO `tb_proveedores` (`id_proveedor`, `nombre_proveedor`, `celular`, `telefono`, `empresa`, `email`, `direccion`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(10, 'Jose Villar', '0972406538', '27736632', 'CASCADA', 'hilariweb@gmail.com', 'Av. del Maestro S/N', '2023-02-12 18:27:10', '2025-01-10 18:29:57'),
(11, 'Maria Quispe Montes', '74664754', '28837773', 'COPELMEX', 'maria@gmail.com', 'av. panamerica nro 540', '2023-02-14 16:23:39', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_roles`
--

CREATE TABLE `tb_roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_roles`
--

INSERT INTO `tb_roles` (`id_rol`, `rol`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'ADMINISTRADOR', '2023-01-23 23:15:19', '2023-01-23 23:15:19'),
(3, 'GERENTE', '2023-01-23 19:11:28', '2023-01-23 20:13:35'),
(4, 'VENDEDOR1', '2023-01-23 21:09:54', '0000-00-00 00:00:00'),
(5, 'VENDEDOR2', '2023-01-24 08:28:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `user` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `password_user` text COLLATE utf8_spanish_ci NOT NULL,
  `token` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_rol` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id_usuario`, `nombres`, `user`, `email`, `password_user`, `token`, `id_rol`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'Administrador', 'admin', 'admin@gmail.com', '$2y$10$VIDXuo4wKCt/x5BHkwHZAOw9lJNirjyLbBHPa9AA4/xgOW.91y/DG', '', 1, '2023-01-24 15:16:01', '2025-01-14 22:39:21'),
(2, 'Micaela Bustamante', 'mica16', 'mica123@gmail.com', '$2y$10$YGHwKYeaClTn2q4evt0kZ.62EjyrNCTt39nr3iDckTd8Z5qk5RA2i', '', 3, '2025-01-10 20:07:45', '2025-01-22 22:42:34'),
(3, 'Carlos Duarte', 'carlitos19', '', '$2y$10$fzfGRUkRTwd1lj4338VYtOrDip4LReTMg7mOfa7syeDIixU4VjO5W', '', 4, '2025-01-22 22:30:11', '0000-00-00 00:00:00'),
(4, 'Edgar Gonzalez', 'edgarcito12', '', '$2y$10$d.9sKPSkZTIxwKqVVTtleOFABqiCe9fq5RO9uAMVg6uBAzWC7SCW.', '', 5, '2025-01-22 22:50:40', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ventas`
--

CREATE TABLE `tb_ventas` (
  `id_venta` int(11) NOT NULL,
  `nro_venta` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `total_pagado` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_ventas`
--

INSERT INTO `tb_ventas` (`id_venta`, `nro_venta`, `id_cliente`, `total_pagado`, `fyh_creacion`, `fyh_update`) VALUES
(1, 1, 2, 104, '2025-01-21 20:41:39', '0000-00-00 00:00:00'),
(2, 2, 4, 5, '2025-01-21 20:45:10', '0000-00-00 00:00:00'),
(3, 3, 6, 12000, '2025-01-21 20:52:39', '0000-00-00 00:00:00'),
(5, 4, 2, 4240000, '2025-01-22 18:33:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ventas_servicios`
--

CREATE TABLE `tb_ventas_servicios` (
  `id_vs` int(11) NOT NULL,
  `nro_servicio` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `total_pagado` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_ventas_servicios`
--

INSERT INTO `tb_ventas_servicios` (`id_vs`, `nro_servicio`, `id_cliente`, `total_pagado`, `fyh_creacion`, `fyh_update`) VALUES
(1, 1, 2, 300000, '2025-01-22 21:31:38', '0000-00-00 00:00:00'),
(2, 2, 6, 300000, '2025-01-22 21:46:14', '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_almacen`
--
ALTER TABLE `tb_almacen`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `tb_almacen_servicios`
--
ALTER TABLE `tb_almacen_servicios`
  ADD PRIMARY KEY (`id_servicio`),
  ADD KEY `id_categoria` (`id_categoria`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tb_carrito`
--
ALTER TABLE `tb_carrito`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `nro_venta` (`nro_venta`);

--
-- Indices de la tabla `tb_carrito_servicios`
--
ALTER TABLE `tb_carrito_servicios`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `id_producto` (`id_servicio`),
  ADD KEY `nro_venta` (`nro_servicio`),
  ADD KEY `nro_servicio` (`nro_servicio`,`id_servicio`);

--
-- Indices de la tabla `tb_categorias`
--
ALTER TABLE `tb_categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `iduser` (`id_usuario`);

--
-- Indices de la tabla `tb_compras`
--
ALTER TABLE `tb_compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tb_configuracion`
--
ALTER TABLE `tb_configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_proveedores`
--
ALTER TABLE `tb_proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `tb_roles`
--
ALTER TABLE `tb_roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `tb_ventas`
--
ALTER TABLE `tb_ventas`
  ADD PRIMARY KEY (`id_venta`) USING BTREE,
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `nro_venta` (`nro_venta`);

--
-- Indices de la tabla `tb_ventas_servicios`
--
ALTER TABLE `tb_ventas_servicios`
  ADD PRIMARY KEY (`id_vs`),
  ADD KEY `nro_servicio` (`nro_servicio`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_almacen`
--
ALTER TABLE `tb_almacen`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tb_almacen_servicios`
--
ALTER TABLE `tb_almacen_servicios`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tb_carrito`
--
ALTER TABLE `tb_carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tb_carrito_servicios`
--
ALTER TABLE `tb_carrito_servicios`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tb_categorias`
--
ALTER TABLE `tb_categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tb_compras`
--
ALTER TABLE `tb_compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tb_configuracion`
--
ALTER TABLE `tb_configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_proveedores`
--
ALTER TABLE `tb_proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tb_roles`
--
ALTER TABLE `tb_roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tb_ventas`
--
ALTER TABLE `tb_ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tb_ventas_servicios`
--
ALTER TABLE `tb_ventas_servicios`
  MODIFY `id_vs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_almacen`
--
ALTER TABLE `tb_almacen`
  ADD CONSTRAINT `tb_almacen_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categorias` (`id_categoria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_almacen_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_almacen_servicios`
--
ALTER TABLE `tb_almacen_servicios`
  ADD CONSTRAINT `tb_almacen_servicios_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categorias` (`id_categoria`),
  ADD CONSTRAINT `tb_almacen_servicios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tb_carrito`
--
ALTER TABLE `tb_carrito`
  ADD CONSTRAINT `tb_carrito_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `tb_almacen` (`id_producto`);

--
-- Filtros para la tabla `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD CONSTRAINT `tb_clientes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tb_compras`
--
ALTER TABLE `tb_compras`
  ADD CONSTRAINT `tb_compras_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `tb_almacen` (`id_producto`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_compras_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_compras_ibfk_4` FOREIGN KEY (`id_proveedor`) REFERENCES `tb_proveedores` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD CONSTRAINT `tb_usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `tb_roles` (`id_rol`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_ventas`
--
ALTER TABLE `tb_ventas`
  ADD CONSTRAINT `tb_ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `tb_clientes` (`id_cliente`),
  ADD CONSTRAINT `tb_ventas_ibfk_2` FOREIGN KEY (`nro_venta`) REFERENCES `tb_carrito` (`nro_venta`);
COMMIT;
