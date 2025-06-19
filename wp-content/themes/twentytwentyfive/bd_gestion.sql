-- Backup database: bd_gestion
-- Fecha: 2025-06-19 16:52:01

DROP TABLE IF EXISTS `profesores`;
CREATE TABLE `profesores` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nombre_usuario` varchar(150) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `rol` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_nombre_usuario` (`nombre_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `profesores` VALUES('11', 'asdjasldasjds@gmail.com', '$2y$10$77VlVbuomojwUZkfW7DnLOYcHxQ3qc62gu1M2r4DaKVJWZZqI66uW', 'david', 'holaholahoalhola', 'asdas1212312321312', 'admin');
INSERT INTO `profesores` VALUES('14', 'spensob0410@g.educaand.es', '$2y$10$/BwMWEgnR4tFiFLMj/Jy6.2vbYHEjJoYdkeuDC/mR/9afuORxN9oG', 'sergio', 'Sergio', 'Peña Sobrado', 'admin');
INSERT INTO `profesores` VALUES('15', 'jesushernandez@gmail.com', '$2y$10$q56mUJjCQQs93JS7cS58MuODZxrJiLGUCeKKPxu6QuznpU3Csby1a', 'alca20', 'Jesús', 'López Hernández', 'admin');
INSERT INTO `profesores` VALUES('16', 'juan.perez@example.com', '', 'juanperez', 'Juan', 'Pérez', 'estandar');
INSERT INTO `profesores` VALUES('18', 'jose.martin@example.com', '', 'josemartin', 'José', 'Martín', 'admin');
INSERT INTO `profesores` VALUES('19', 'luis.rodriguez@example.com', '', 'luisrodriguez', 'Luis', 'Rodríguez', 'estandar');
INSERT INTO `profesores` VALUES('39', 'juancarlos@gmail.com', '$2y$10$vZhKgFBxSyDfObINcTYsaunzSPIp0II/.fwhgvcruU3c0hyUuQtSi', 'juancarlos', 'Juan carlos I', 'Juan Carlos', 'admin');
INSERT INTO `profesores` VALUES('40', 'admin@gmail.com', '$2y$10$0ZLiUEqqMC3cDlR/MyuAlO3cqvH.22IlhsY03xOr/EB0i3B4Lumla', 'admin', 'admin', 'admin', 'admin');


DROP TABLE IF EXISTS `proyectos`;
CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(150) NOT NULL,
  `correo_electronico` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `etiquetas` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `archivo_zip` varchar(255) NOT NULL,
  `profesores` text DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `proyectos` VALUES('1', 'Cambiando titulo de nuasdasdvo', 'Ana sadasds', 'ana.lopeasdasdz@example.com', '2024-11-14', 'asdasd, gestión, escolar', 'Aplicación web asdgestionar estudiantes, profesores y notas.', 'gestion_escolar.zip', 'Luis García, asdasdFernández', '2025-06-13 12:34:27');
INSERT INTO `proyectos` VALUES('6', 'Proyecto de IA', 'Ana López', 'ana.lopez@example.com', '2024-12-01', 'IA, Machine Learning', 'Proyecto para detectar imágenes con IA.', 'ia_proyecto.zip', 'Carlos Pérez', '2025-06-13 13:13:52');
INSERT INTO `proyectos` VALUES('7', 'App Móvil', 'Juan Martínez', 'juan.martinez@example.com', '2025-01-15', 'App, Android, iOS', 'Aplicación móvil para gestión de tareas.', 'app_movil.zip', 'Laura Gómez', '2025-06-13 13:13:52');
INSERT INTO `proyectos` VALUES('8', 'Web E-commerce', 'María García', 'maria.garcia@example.com', '2024-11-20', 'Web, E-commerce, PHP', 'Tienda online con carrito de compra.', 'web_ecommerce.zip', 'David Ruiz', '2025-06-13 13:13:52');
INSERT INTO `proyectos` VALUES('9', 'Sistema Gestión', 'Luis Fernández', 'luis.fernandez@example.com', '2025-02-10', 'ERP, Gestión', 'Sistema de gestión empresarial.', 'sistema_gestion.zip', 'Marta Sánchez', '2025-06-13 13:13:52');
INSERT INTO `proyectos` VALUES('10', 'Juego 2D', 'Elena Torres', 'elena.torres@example.com', '2025-03-05', 'Juego, Unity, 2D', 'Videojuego 2D para PC.', 'juego_2d.zip', 'Pablo Martínez', '2025-06-13 13:13:52');
INSERT INTO `proyectos` VALUES('11', 'Prueba proyecto', 'Juan Luque', 'prueba@gmail.com', '2025-06-09', 'PHP, Javascript', 'Proyecto nuevo', 'proj_684c0940ef26b2.05748159.zip', 'David Hernández', '2025-06-13 13:19:28');
INSERT INTO `proyectos` VALUES('12', 'Proyecto final', 'Proyecto final', 'proyectofinal@gmail.com', '2025-06-20', 'PHP, JS, HTML', 'Proyecto final', 'proj_684c0acce6417.zip', 'Juan Pérez', '2025-06-13 13:22:41');
INSERT INTO `proyectos` VALUES('13', 'JASKLDJASLKDJ', 'KLJASKLDJASKLDJ', 'SLKdjaskld@gmail.com', '2025-06-20', 'PHP, MYSQL', 'Prueba', 'proj_684c0b15cbc61.zip', 'Prueba', '2025-06-13 13:26:56');
INSERT INTO `proyectos` VALUES('14', 'jkasldasjdklasj', 'asjdaskldjaskld', 'askldjaskld2@gmail.com', '2025-06-13', 'PHP', 'asdasdas', 'proj_684c0b2d4a46e2.44173110.zip', 'asdasd', '2025-06-13 13:27:41');
INSERT INTO `proyectos` VALUES('15', 'Prueba de proyecto', 'Juan Ramon', 'juanramon@gmail.com', '2025-06-20', 'PHP, Javascript', 'Juan Ramon', 'proj_68541f054045e3.50283580.zip', 'Juan Quintero', '2025-06-19 16:30:29');


