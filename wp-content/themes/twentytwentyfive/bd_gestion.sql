-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2025 a las 14:19:11
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
-- Base de datos: `bd_gestion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id` int(10) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nombre_usuario` varchar(150) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id`, `email`, `password`, `nombre_usuario`, `nombre`, `apellidos`, `rol`) VALUES
(11, 'asdjasldasjds@gmail.com', '$2y$10$77VlVbuomojwUZkfW7DnLOYcHxQ3qc62gu1M2r4DaKVJWZZqI66uW', 'david', 'holaholahoalhola', 'asdas1212312321312', 'admin'),
(14, 'spensob0410@g.educaand.es', '$2y$10$/BwMWEgnR4tFiFLMj/Jy6.2vbYHEjJoYdkeuDC/mR/9afuORxN9oG', 'sergio', 'Sergio', 'Peña Sobrado', 'admin'),
(15, 'jesushernandez@gmail.com', '$2y$10$q56mUJjCQQs93JS7cS58MuODZxrJiLGUCeKKPxu6QuznpU3Csby1a', 'alca20', 'Jesús', 'López Hernández', 'admin'),
(16, 'juan.perez@example.com', '', 'juanperez', 'Juan', 'Pérez', 'estandar'),
(18, 'jose.martin@example.com', '', 'josemartin', 'José', 'Martín', 'admin'),
(19, 'luis.rodriguez@example.com', '', 'luisrodriguez', 'Luis', 'Rodríguez', 'estandar'),
(39, 'juancarlos@gmail.com', '$2y$10$vZhKgFBxSyDfObINcTYsaunzSPIp0II/.fwhgvcruU3c0hyUuQtSi', 'juancarlos', 'Juan carlos I', 'Juan Carlos', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(150) NOT NULL,
  `correo_electronico` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `etiquetas` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `archivo_zip` varchar(255) NOT NULL,
  `profesores` text DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `titulo`, `autor`, `correo_electronico`, `fecha`, `etiquetas`, `descripcion`, `archivo_zip`, `profesores`, `creado_en`) VALUES
(1, 'Cambiando titulo de nuasdasdvo', 'Ana sadasds', 'ana.lopeasdasdz@example.com', '2024-11-14', 'asdasd, gestión, escolar', 'Aplicación web asdgestionar estudiantes, profesores y notas.', 'gestion_escolar.zip', 'Luis García, asdasdFernández', '2025-06-13 10:34:27'),
(6, 'Proyecto de IA', 'Ana López', 'ana.lopez@example.com', '2024-12-01', 'IA, Machine Learning', 'Proyecto para detectar imágenes con IA.', 'ia_proyecto.zip', 'Carlos Pérez', '2025-06-13 11:13:52'),
(7, 'App Móvil', 'Juan Martínez', 'juan.martinez@example.com', '2025-01-15', 'App, Android, iOS', 'Aplicación móvil para gestión de tareas.', 'app_movil.zip', 'Laura Gómez', '2025-06-13 11:13:52'),
(8, 'Web E-commerce', 'María García', 'maria.garcia@example.com', '2024-11-20', 'Web, E-commerce, PHP', 'Tienda online con carrito de compra.', 'web_ecommerce.zip', 'David Ruiz', '2025-06-13 11:13:52'),
(9, 'Sistema Gestión', 'Luis Fernández', 'luis.fernandez@example.com', '2025-02-10', 'ERP, Gestión', 'Sistema de gestión empresarial.', 'sistema_gestion.zip', 'Marta Sánchez', '2025-06-13 11:13:52'),
(10, 'Juego 2D', 'Elena Torres', 'elena.torres@example.com', '2025-03-05', 'Juego, Unity, 2D', 'Videojuego 2D para PC.', 'juego_2d.zip', 'Pablo Martínez', '2025-06-13 11:13:52'),
(11, 'Prueba proyecto', 'Juan Luque', 'prueba@gmail.com', '2025-06-09', 'PHP, Javascript', 'Proyecto nuevo', 'proj_684c0940ef26b2.05748159.zip', 'David Hernández', '2025-06-13 11:19:28'),
(12, 'Proyecto final', 'Proyecto final', 'proyectofinal@gmail.com', '2025-06-20', 'PHP, JS, HTML', 'Proyecto final', 'proj_684c0acce6417.zip', 'Juan Pérez', '2025-06-13 11:22:41'),
(13, 'JASKLDJASLKDJ', 'KLJASKLDJASKLDJ', 'SLKdjaskld@gmail.com', '2025-06-20', 'PHP, MYSQL', 'Prueba', 'proj_684c0b15cbc61.zip', 'Prueba', '2025-06-13 11:26:56'),
(14, 'jkasldasjdklasj', 'asjdaskldjaskld', 'askldjaskld2@gmail.com', '2025-06-13', 'PHP', 'asdasdas', 'proj_684c0b2d4a46e2.44173110.zip', 'asdasd', '2025-06-13 11:27:41');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_nombre_usuario` (`nombre_usuario`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
