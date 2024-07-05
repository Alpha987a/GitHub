-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2024 a las 16:14:23
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
-- Base de datos: `lowcostever`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(11) NOT NULL,
  `productos_id` int(11) NOT NULL,
  `ruta` varchar(250) NOT NULL,
  `alt` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `productos_id`, `ruta`, `alt`) VALUES
(1, 2, 'uploads/camiseta-rayas-1.jpg', 'camiseta bonita de rayas'),
(2, 2, 'uploads/camiseta-rayas-2.jpg', 'camiseta más bonita de rayas'),
(3, 2, 'uploads/camiseta-rayas-3.jpg', 'camiseta mega chuli de rayas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `producto` varchar(250) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `precio` float NOT NULL,
  `unidades` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `producto`, `descripcion`, `precio`, `unidades`) VALUES
(2, 'Camiseta niño', 'Camiseta algodón muy fresquita 3/14 años', 29, 8),
(3, 'Bañador mujer UV', 'Bañador playero filtro UV', 57, 5),
(4, 'Bañador hombre', 'Bañador económico playa', 4.9, 22),
(5, 'Bikini estampado', 'Bikini estampado floral', 19, 7),
(6, 'Bañador niño piscina', 'Bañador de niño licra uso piscina', 19, 10),
(7, 'camiseta sin tirantes', 'barata, barata', 2, 234),
(8, 'camiseta con tirantes', 'barata, barata', 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productostickets`
--

CREATE TABLE `productostickets` (
  `id` int(11) NOT NULL,
  `tickets_id` int(11) NOT NULL,
  `productos_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productostickets`
--

INSERT INTO `productostickets` (`id`, `tickets_id`, `productos_id`, `cantidad`, `precio`) VALUES
(1, 2, 2, 2, 2.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `usuarios_id`, `fecha`, `total`) VALUES
(2, 5, '2024-06-11 16:48:37', 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nombreapellidos` varchar(250) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `ciudad` varchar(250) NOT NULL,
  `provincia` varchar(250) NOT NULL,
  `pais` varchar(250) NOT NULL,
  `tipousuario` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `nombreapellidos`, `direccion`, `ciudad`, `provincia`, `pais`, `tipousuario`) VALUES
(1, 'admin@lowcostever.com', '1234qwer', 'Antonio Fernández', 'C/Cuenca 6', 'Valencia', 'Valencia', 'España', 1),
(2, 'ernesto@lowcostever.com', '1234qwer', 'Ernesto Domenech', 'C/Esperanza 23', 'Castellón', 'Castellón', 'España', 2),
(3, 'maria@mail.com', '1234qwer', 'María Pérez', 'C/Concordia 12', 'Valencia', 'Valencia', 'España', 3),
(4, 'pepe@mail.com', '1234qwer', 'Pepe Gutierez', 'C/Constitución 23 2A', 'Malaga', 'Malaga', 'España', 3),
(5, 'manolo@mail.com', '1234qwer', 'Manolo Garcia', 'C/Solea 23 5ºC', 'Sevilla', 'Sevilla', 'España', 3),
(6, 'finamari@mail.com', '1234qwer', 'Fina Mari González', 'C/Aceituno 4', 'Valencia', 'Valencia', 'España', 3),
(8, 'pulgarcito@lowcosterver', '1234qwer', 'Pulgarcito Miguita Pan', 'Cabaña del bosque s/n', 'Sherwood', 'Nothingam', 'Reino Unido', 2),
(10, 'juan@mail.com', '1234qwer', 'Juan Garcia', 'Plaza del Norte', 'Madrid', 'Madrid', 'España', 3),
(15, 'perico@mail.com', '1234qwer', 'Perico Palotes', 'Plaza del Norte', 'Valencia', 'Valencia', 'España', 3),
(16, 'juanita@mail.com', '1234qwer', 'Juanita  García', 'C/Solea 23 5ºC', 'Castellón', 'Castellón', 'España', 3),
(19, 'sotanito@mail.com', '$2y$10$Gbs44JOnMXDeiieXl0yGve4ob5M2xIoXR1io7Rr.dDmvaBNUQI1va', 'sotanito sotano', 'C/Solea 23 5ºC', 'Sevilla', 'Sevilla', 'España', 1),
(20, 'pepita@mail.com', '$2y$10$I/qGfSHOiQhM62yn26P1/Omoa7hkLInl5sa9sY4.ztoke1iiz7txe', 'Pepita Pulgarcita', 'C/La esperanza 10', 'Sevilla', 'Sevilla', 'España', 2),
(21, 'braulio@mail.com', '$2y$10$FYpg8hbUq.xI18rkkcJqPeIEvueVjR9X7ZvV1XNBrGmT8DqYlWwiO', 'Braulio Perez', 'C/Aceituno 4', 'Malaga', 'Malaga', 'España', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_id` (`productos_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productostickets`
--
ALTER TABLE `productostickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_id` (`tickets_id`),
  ADD KEY `productos_id` (`productos_id`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_id` (`usuarios_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `productostickets`
--
ALTER TABLE `productostickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `imagenes_ibfk_1` FOREIGN KEY (`productos_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productostickets`
--
ALTER TABLE `productostickets`
  ADD CONSTRAINT `productostickets_ibfk_1` FOREIGN KEY (`tickets_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productostickets_ibfk_2` FOREIGN KEY (`productos_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
