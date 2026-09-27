-- MySQL Dump
-- Base de datos: `abm_usuarios`
-- ------------------------------------------------------

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `usuarios`;
DROP TABLE IF EXISTS `roles`;
SET FOREIGN_KEY_CHECKS=1;

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_roles_nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Administrador', 'Acceso total y gestión global del sistema'),
(2, 'Usuario', 'Acceso estándar de lectura y edición de perfil');

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `rol_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_usuarios_nickname` (`nickname`),
  UNIQUE KEY `uq_usuarios_email` (`email`),
  KEY `fk_usuarios_roles_idx` (`rol_id`),
  CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `nickname`, `email`, `rol_id`) VALUES
(1, 'Carlos', 'Gómez', 'cgomez', 'carlos.gomez@example.com', 1),
(2, 'Ana', 'Martínez', 'anam', 'ana.martinez@example.com', 2);