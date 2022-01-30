-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2020 a las 02:15:55
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sis_inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `fecha`) VALUES
(16, 'Accesorios de oficina', '2020-10-12 18:18:50'),
(17, 'Artículos de papelería', '2020-10-11 21:29:18'),
(18, 'Biblias', '2020-10-11 21:29:29'),
(19, 'Consumibles de computo', '2020-10-11 21:29:44'),
(20, 'Instrumentos musicales ', '2020-10-11 21:29:59'),
(21, 'Libros de enseñanza', '2020-10-11 21:30:18'),
(22, 'Pizarras y borradores', '2020-10-11 23:30:13'),
(23, 'Sillas y mesas plasticas', '2020-10-11 21:30:58'),
(24, 'Tintas y toner', '2020-10-11 21:31:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `iglesias`
--

CREATE TABLE `iglesias` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `compras` int(11) NOT NULL,
  `ultima_compra` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `iglesias`
--

INSERT INTO `iglesias` (`id`, `nombre`, `email`, `telefono`, `direccion`, `compras`, `ultima_compra`, `fecha`) VALUES
(19, 'Iglesia Cuadrangular la Alborada', 'cuadrangularalborada@gmail.com', '(098) 589-2365', 'Av Isidro Ayora', 13, '2020-10-25 16:34:28', '2020-10-25 21:34:28'),
(22, 'Iglesia del Evangelio Cuadrangular', 'cuadrangular@gmail.com', '(099) 845-6321', 'Jose Mascote y Cuenca', 40, '2020-10-12 13:29:04', '2020-10-12 18:29:04'),
(23, 'Iglesia Craf del Evangelio Cuadrangular', 'crafcuadrangular@gmail.com', '(098) 308-0155', 'Rafael Guerrero Valenzuela ', 1, '2020-10-15 18:41:40', '2020-10-15 23:41:40'),
(24, 'Iglesia Cuadrangular Nazaret', 'Nazaretcuadragular@gmail.com', '(098) 206-7136', 'Vicente Rocafuerte', 23, '2020-10-11 19:28:58', '2020-10-12 03:53:12'),
(25, 'Iglesia Cuadrangular Maldonado', 'cuadrangular_maldonado@gmail.com', '(099) 027-6589', 'Floresta 2', 5, '2020-10-11 22:51:33', '2020-10-12 03:51:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_iglesia` int(11) NOT NULL,
  `id_secretaria` int(11) NOT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `impuesto` float NOT NULL,
  `neto` float NOT NULL,
  `total` float NOT NULL,
  `metodo_pago` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `codigo`, `id_iglesia`, `id_secretaria`, `productos`, `impuesto`, `neto`, `total`, `metodo_pago`, `fecha`) VALUES
(42, 10001, 19, 1, '[{\"id\":\"112\",\"descripcion\":\"Mesas plásticas para niños\",\"cantidad\":\"1\",\"stock\":\"55\",\"precio\":\"8.4\",\"total\":\"8.4\"},{\"id\":\"110\",\"descripcion\":\"Sillas plásticas de niños\",\"cantidad\":\"1\",\"stock\":\"599\",\"precio\":\"7\",\"total\":\"7\"},{\"id\":\"105\",\"descripcion\":\"Pianos\",\"cantidad\":\"1\",\"stock\":\"149\",\"precio\":\"98\",\"total\":\"98\"},{\"id\":\"93\",\"descripcion\":\"Borrador Q Connect\",\"cantidad\":\"1\",\"stock\":\"149\",\"precio\":\"11.9\",\"total\":\"11.9\"},{\"id\":\"90\",\"descripcion\":\"Pizarra volteable doble lado con pedestal rodante\",\"cantidad\":\"1\",\"stock\":\"99\",\"precio\":\"133\",\"total\":\"133\"}]', 12.915, 258.3, 271.215, 'Efectivo', '2020-10-12 18:26:24'),
(43, 10002, 22, 1, '[{\"id\":\"108\",\"descripcion\":\"Creciendo con Dios\",\"cantidad\":\"6\",\"stock\":\"9\",\"precio\":\"9.8\",\"total\":\"58.8\"},{\"id\":\"107\",\"descripcion\":\"Lecturas de la biblia\",\"cantidad\":\"10\",\"stock\":\"140\",\"precio\":\"11.2\",\"total\":\"112\"},{\"id\":\"106\",\"descripcion\":\"Historias de la biblia\",\"cantidad\":\"16\",\"stock\":\"184\",\"precio\":\"7\",\"total\":\"112\"},{\"id\":\"103\",\"descripcion\":\"Guitarra acústica\",\"cantidad\":\"6\",\"stock\":\"144\",\"precio\":\"84\",\"total\":\"504\"},{\"id\":\"104\",\"descripcion\":\"Baterias\",\"cantidad\":\"1\",\"stock\":\"14\",\"precio\":\"560\",\"total\":\"560\"}]', 67.34, 1346.8, 1414.14, 'Efectivo', '2020-10-12 00:28:01'),
(44, 10003, 24, 1, '[{\"id\":\"111\",\"descripcion\":\"Mesas plásticas \",\"cantidad\":\"4\",\"stock\":\"56\",\"precio\":\"12.6\",\"total\":\"50.4\"},{\"id\":\"67\",\"descripcion\":\"Cinta adhes embalaje cafe\",\"cantidad\":\"3\",\"stock\":\"12\",\"precio\":\"0.672\",\"total\":\"2.02\"},{\"id\":\"68\",\"descripcion\":\"Cinta adhes embalaje transparente\",\"cantidad\":\"4\",\"stock\":\"11\",\"precio\":\"0.672\",\"total\":\"2.69\"},{\"id\":\"70\",\"descripcion\":\"Crayon yiran Jumbo\",\"cantidad\":\"8\",\"stock\":\"27\",\"precio\":\"1.414\",\"total\":\"11.31\"},{\"id\":\"71\",\"descripcion\":\"Esferos de colores\",\"cantidad\":\"4\",\"stock\":\"16\",\"precio\":\"0.602\",\"total\":\"2.41\"}]', 3.4415, 68.83, 72.2715, 'Efectivo', '2020-10-12 00:28:58'),
(45, 10004, 25, 1, '[{\"id\":\"110\",\"descripcion\":\"Sillas plásticas de niños\",\"cantidad\":\"1\",\"stock\":\"585\",\"precio\":\"7\",\"total\":\"7\"},{\"id\":\"111\",\"descripcion\":\"Mesas plásticas \",\"cantidad\":\"1\",\"stock\":\"55\",\"precio\":\"12.6\",\"total\":\"12.6\"},{\"id\":\"106\",\"descripcion\":\"Historias de la biblia\",\"cantidad\":\"1\",\"stock\":\"183\",\"precio\":\"7\",\"total\":\"7\"}]', 1.33, 26.6, 27.93, 'Efectivo', '2020-10-12 00:30:25'),
(47, 10005, 22, 1, '[{\"id\":\"113\",\"descripcion\":\"Resma\",\"cantidad\":\"1\",\"stock\":\"55\",\"precio\":\"4.9\",\"total\":\"4.9\"}]', 0.245, 4.9, 5.145, 'Efectivo', '2020-10-12 18:29:04'),
(48, 10006, 23, 1, '[{\"id\":\"112\",\"descripcion\":\"Mesas plásticas para niños\",\"cantidad\":\"1\",\"stock\":\"54\",\"precio\":\"8.4\",\"total\":\"8.4\"}]', 0.504, 8.4, 8.904, 'Efectivo', '2020-10-15 23:41:40'),
(49, 10007, 19, 1, '[{\"id\":\"112\",\"descripcion\":\"Mesas plásticas para niños\",\"cantidad\":\"4\",\"stock\":\"50\",\"precio\":\"8.4\",\"total\":\"33.6\"}]', 0.336, 33.6, 33.936, 'Efectivo', '2020-10-18 03:49:34'),
(50, 10008, 19, 62, '[{\"id\":\"113\",\"descripcion\":\"Resma\",\"cantidad\":\"1\",\"stock\":\"54\",\"precio\":\"4.9\",\"total\":\"4.9\"}]', 0.049, 4.9, 4.949, 'Efectivo', '2020-10-25 21:34:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_pedido` float NOT NULL,
  `pedidos` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `codigo`, `descripcion`, `imagen`, `stock`, `precio_compra`, `precio_pedido`, `pedidos`, `fecha`) VALUES
(61, 17, '001', 'Calculadora Joinus ', 'vistas/img/productos/001/623.jpg', 25, 4.65, 6.51, 0, '2020-10-11 22:16:42'),
(62, 17, '002', 'Tape baijia amarillo', 'vistas/img/productos/002/139.jpg', 30, 1, 1.4, 0, '2020-10-11 22:28:23'),
(63, 17, '003', 'Tape baijia verde', 'vistas/img/productos/003/553.jpg', 30, 1, 1.4, 0, '2020-10-11 22:28:13'),
(64, 17, '004', 'Tape baijia negro', 'vistas/img/productos/004/508.jpg', 30, 1, 1.4, 0, '2020-10-11 22:28:02'),
(65, 17, '005', 'Borrador ', 'vistas/img/productos/005/561.jpg', 25, 2.49, 3.486, 0, '2020-10-11 22:27:37'),
(66, 17, '006', 'Acuarela Zhenfa ', 'vistas/img/productos/006/340.jpg', 25, 1, 1.4, 0, '2020-10-11 22:29:13'),
(67, 17, '007', 'Cinta adhes embalaje cafe', 'vistas/img/productos/007/147.jpg', 12, 0.48, 0.672, 3, '2020-10-12 00:28:57'),
(68, 17, '008', 'Cinta adhes embalaje transparente', 'vistas/img/productos/008/404.jpg', 11, 0.48, 0.672, 4, '2020-10-12 00:28:57'),
(69, 17, '009', 'Crayon yiran delgados', 'vistas/img/productos/009/499.jpg', 35, 0.35, 0.49, 0, '2020-10-11 22:33:13'),
(70, 17, '010', 'Crayon yiran Jumbo', 'vistas/img/productos/010/316.jpg', 27, 1.01, 1.414, 8, '2020-10-12 00:28:58'),
(71, 17, '011', 'Esferos de colores', 'vistas/img/productos/011/819.jpg', 16, 0.43, 0.602, 4, '2020-10-12 00:28:58'),
(72, 17, '012', 'Foami Normal de colores', 'vistas/img/productos/012/397.jpg', 20, 0.65, 0.91, 0, '2020-10-11 22:38:28'),
(73, 17, '013', 'Foami escarchado de colores', 'vistas/img/productos/013/856.jpg', 15, 1.12, 1.568, 0, '2020-10-11 22:41:44'),
(74, 17, '014', 'Goma en barra', 'vistas/img/productos/014/245.jpg', 50, 25, 35, 0, '2020-10-11 22:42:44'),
(75, 17, '015', 'Caja de lapiz unice rojo y negro', 'vistas/img/productos/015/771.jpg', 25, 15, 21, 0, '2020-10-11 22:44:46'),
(76, 17, '016', 'Caja de lapiz unice amarillo', 'vistas/img/productos/016/484.jpg', 25, 8.3, 11.62, 0, '2020-10-11 22:45:36'),
(77, 17, '017', 'Sacapunta metalico', 'vistas/img/productos/017/538.jpg', 150, 0.25, 0.35, 0, '2020-10-11 22:46:37'),
(78, 18, '018', 'Biblia Reina Valera color cafe', 'vistas/img/productos/018/489.jpg', 200, 22.49, 31.486, 0, '2020-10-11 22:59:10'),
(79, 18, '019', 'Biblia Reina Valera color rosa', 'vistas/img/productos/019/574.jpg', 200, 22.49, 31.486, 0, '2020-10-11 23:00:11'),
(80, 18, '020', 'Biblia Reina Valera color aqua', 'vistas/img/productos/020/660.jpg', 200, 22.49, 31.486, 0, '2020-10-11 23:00:50'),
(81, 18, '021', 'Biblia del ministro color caoba', 'vistas/img/productos/021/218.jpg', 200, 31.49, 44.086, 0, '2020-10-11 23:01:43'),
(82, 18, '022', 'Biblia del ministro color negra', 'vistas/img/productos/022/414.jpg', 150, 31.49, 44.086, 0, '2020-10-11 23:02:27'),
(83, 18, '023', 'Biblia de estudio spurgeon color negra', 'vistas/img/productos/023/439.jpg', 250, 67.99, 95.186, 0, '2020-10-11 23:03:33'),
(84, 18, '024', 'Biblia vida plena color piel', 'vistas/img/productos/024/470.jpg', 150, 53.99, 75.586, 0, '2020-10-11 23:05:01'),
(85, 18, '025', 'Biblia de estudio de la profecia', 'vistas/img/productos/025/788.jpg', 250, 35.99, 50.386, 0, '2020-10-11 23:05:50'),
(86, 18, '026', 'Biblia mi gran viaje ', 'vistas/img/productos/026/832.jpg', 50, 17.99, 25.186, 0, '2020-10-11 23:06:55'),
(87, 18, '027', 'Biblia Precious Moments Reina Valera', 'vistas/img/productos/027/474.jpg', 600, 17.99, 25.186, 0, '2020-10-11 23:07:59'),
(88, 18, '028', 'Biblia nuevo testamento', 'vistas/img/productos/028/137.jpg', 600, 8, 11.2, 0, '2020-10-11 23:19:49'),
(89, 22, '029', 'Pizarra doble lado magnetica con pedestal rodante', 'vistas/img/productos/029/262.jpg', 500, 75, 105, 0, '2020-10-11 23:26:50'),
(90, 22, '030', 'Pizarra volteable doble lado con pedestal rodante', 'vistas/img/productos/030/507.png', 99, 95, 133, 1, '2020-10-12 18:26:23'),
(91, 22, '031', 'Pizarra de vidrio', 'vistas/img/productos/031/266.jpg', 200, 100, 140, 0, '2020-10-11 23:28:29'),
(92, 22, '032', 'Pizarra de tiza liquida', 'vistas/img/productos/032/953.jpg', 150, 15, 21, 0, '2020-10-11 23:29:10'),
(93, 22, '033', 'Borrador Q Connect', 'vistas/img/productos/033/611.jpg', 149, 8.5, 11.9, 1, '2020-10-12 18:26:23'),
(94, 24, '034', 'Tintas', 'vistas/img/productos/034/158.jpg', 500, 45, 63, 0, '2020-10-11 23:38:04'),
(95, 24, '035', 'Cartuchos de impresora', 'vistas/img/productos/035/705.jpg', 100, 56, 78.4, 0, '2020-10-11 23:38:37'),
(96, 24, '036', 'Cabezales', 'vistas/img/productos/036/378.jpg', 150, 90, 126, 0, '2020-10-11 23:39:16'),
(97, 19, '037', 'Fotocopiadora', 'vistas/img/productos/037/987.jpg', 50, 250, 350, 0, '2020-10-11 23:43:26'),
(98, 19, '038', 'Pantallas de proyeccion', 'vistas/img/productos/038/152.jpg', 15, 120, 168, 0, '2020-10-11 23:44:11'),
(99, 19, '039', 'Mini proyector ', 'vistas/img/productos/039/274.jpg', 60, 150, 210, 0, '2020-10-12 03:53:11'),
(100, 16, '040', 'Sujeta pinzas', 'vistas/img/productos/040/899.jpg', 800, 0.25, 0.35, 0, '2020-10-11 23:48:30'),
(101, 16, '041', 'Caja de clips', 'vistas/img/productos/041/959.jpg', 150, 3.5, 4.9, 0, '2020-10-11 23:50:01'),
(102, 20, '042', 'Guitarra electroacustica', 'vistas/img/productos/042/724.jpg', 50, 250, 350, 0, '2020-10-12 03:53:11'),
(103, 20, '043', 'Guitarra acústica', 'vistas/img/productos/043/186.jpg', 144, 60, 84, 6, '2020-10-12 03:53:11'),
(104, 20, '044', 'Baterias', 'vistas/img/productos/044/655.jpg', 14, 400, 560, 1, '2020-10-12 03:53:11'),
(105, 20, '045', 'Pianos', 'vistas/img/productos/045/508.jpg', 149, 70, 98, 1, '2020-10-12 18:26:23'),
(106, 21, '046', 'Historias de la biblia', 'vistas/img/productos/046/365.jpg', 183, 5, 7, 17, '2020-10-12 03:51:33'),
(107, 21, '047', 'Lecturas de la biblia', 'vistas/img/productos/047/925.png', 140, 8, 11.2, 10, '2020-10-12 00:28:00'),
(108, 21, '048', 'Creciendo con Dios', 'vistas/img/productos/048/928.jpg', 9, 7, 9.8, 6, '2020-10-12 00:28:00'),
(109, 23, '049', 'Sillas plásticas', 'vistas/img/productos/049/617.jpg', 800, 8, 11.2, 0, '2020-10-12 00:07:52'),
(110, 23, '050', 'Sillas plásticas de niños', 'vistas/img/productos/050/772.jpg', 599, 5, 7, 5, '2020-10-12 18:26:23'),
(111, 23, '051', 'Mesas plásticas ', 'vistas/img/productos/051/740.jpg', 53, 9, 12.6, 7, '2020-10-12 04:29:59'),
(112, 23, '052', 'Mesas plásticas para niños', 'vistas/img/productos/052/160.jpg', 50, 6, 8.4, 6, '2020-10-18 03:49:33'),
(113, 17, '053', 'Resma', 'vistas/img/productos/053/756.jpg', 54, 3.5, 4.9, 2, '2020-10-25 21:34:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(1, 'Azucena', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Administrador', 'vistas/img/usuarios/admin/361.jpg', 1, '2020-10-25 20:14:46', '2020-10-26 01:14:46'),
(62, 'Julissa', 'Secretaria', '$2a$07$asxx54ahjppf45sd87a5auJ3fAl0zpLuVIVCeutY/yjCdWZSwsMYq', 'Secretaria', 'vistas/img/usuarios/Secretaria/743.jpg', 1, '2020-10-25 20:15:19', '2020-10-26 01:15:19'),
(64, 'Yarib', 'Bodega', '$2a$07$asxx54ahjppf45sd87a5auxqfvXWIhOlAbfntvSCOcuqpMOpq4t5O', 'Jefe de bodega', 'vistas/img/usuarios/Bodega/827.jpg', 1, '2020-10-25 20:15:02', '2020-10-26 01:15:02');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `iglesias`
--
ALTER TABLE `iglesias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `iglesias`
--
ALTER TABLE `iglesias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
