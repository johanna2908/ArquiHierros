-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-05-2018 a las 03:12:27
-- Versión del servidor: 5.6.35
-- Versión de PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `users`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicador`
--

CREATE TABLE `indicador` (
  `id_indicador` int(10) UNSIGNED NOT NULL,
  `pregunta` varchar(45) NOT NULL,
  `id_tipo_pregunta` int(10) UNSIGNED NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `indicador`
--

INSERT INTO `indicador` (`id_indicador`, `pregunta`, `id_tipo_pregunta`, `estado`) VALUES
(37, 'ahora si guarda fijo', 2, 1),
(38, 'Pregunta Cualitativa', 1, 1),
(39, 'Pregunta Cuantitativa Variable', 3, 1),
(40, 'Pregunta Cuantitativa Fija', 2, 1),
(41, 'jerso gome urreo asf', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones`
--

CREATE TABLE `opciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `valor` int(11) NOT NULL,
  `id_indicador` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `opciones`
--

INSERT INTO `opciones` (`id`, `nombre`, `valor`, `id_indicador`) VALUES
(23, 'Fijo', 1, 37),
(24, 'Alto', 14, 38),
(25, 'Medio', 1, 38),
(26, 'Bajo', 0, 38),
(27, '1', 0, 39),
(28, '2', 0, 39),
(29, '3', 2, 39),
(30, '4', 0, 39),
(31, '5', 0, 39),
(32, '6', 1, 39),
(33, '7', 0, 39),
(34, '8', 0, 39),
(35, '9', 0, 39),
(36, '10', 1, 39),
(37, 'Fijo', 7, 40),
(38, 'Fijo', 0, 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id_respuesta` int(10) UNSIGNED NOT NULL,
  `respuesta` varchar(100) NOT NULL,
  `id_usuario_rta` varchar(20) NOT NULL,
  `id_indicador_rta` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id_respuesta`, `respuesta`, `id_usuario_rta`, `id_indicador_rta`) VALUES
(11, 'Alto', '1070979976', 38),
(12, '3', '1070979976', 40),
(13, '1', '1070979976', 40),
(14, '7', '1070979976', 40),
(15, '5', '1070979976', 40),
(16, '4.8', '1070979976', 40),
(17, '5', '1070979976', 40),
(19, '6', '1070981983', 39),
(20, '2.47', '1073520247', 40),
(21, '7.7', '1073520247', 37);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id_tipo` int(10) UNSIGNED NOT NULL,
  `tipo_pregunta` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id_tipo`, `tipo_pregunta`) VALUES
(1, 'Cualitativo'),
(2, 'Cuantitativo Fijo'),
(3, 'Cuantitativo Variable');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `documento` varchar(45) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `password` varchar(15) NOT NULL,
  `rol` varchar(20) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `documento`, `nombres`, `apellidos`, `correo`, `password`, `rol`, `estado`) VALUES
(2, '1070979976', 'Yonathan', 'Bohorquez Rincon', 'yonathancam@hotmail.com', 'Yonny1070', 'Gerente', 1),
(3, '1070981983', 'Myriam Johanna', 'Salcedo', 'johanna@mail.com', '1234Johanna', 'Cliente', 1),
(4, '1073520247', 'tatiana', 'gomez', 'tatiana@gmail.com', 'tatiana', 'Cliente', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `indicador`
--
ALTER TABLE `indicador`
  ADD PRIMARY KEY (`id_indicador`),
  ADD KEY `fk_id_tipo_pregunta` (`id_tipo_pregunta`);

--
-- Indices de la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_indicador_opciones` (`id_indicador`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id_respuesta`),
  ADD KEY `fk_id_usuario_respuesta` (`id_usuario_rta`) USING BTREE,
  ADD KEY `fk_id_indicador_respuesta` (`id_indicador_rta`) USING BTREE;

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `indicador`
--
ALTER TABLE `indicador`
  MODIFY `id_indicador` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT de la tabla `opciones`
--
ALTER TABLE `opciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id_respuesta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id_tipo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `indicador`
--
ALTER TABLE `indicador`
  ADD CONSTRAINT `fk_id_tipo_pregunta` FOREIGN KEY (`id_tipo_pregunta`) REFERENCES `tipo` (`id_tipo`);

--
-- Filtros para la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD CONSTRAINT `fk_id_indicador_opciones` FOREIGN KEY (`id_indicador`) REFERENCES `indicador` (`id_indicador`);

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `fk_id_indicador_respuesta` FOREIGN KEY (`id_indicador_rta`) REFERENCES `indicador` (`id_indicador`);
