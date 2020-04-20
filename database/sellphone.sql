-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-08-2019 a las 15:27:30
-- Versión del servidor: 5.7.21
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sellphone`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacidades`
--

DROP TABLE IF EXISTS `capacidades`;
CREATE TABLE IF NOT EXISTS `capacidades` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `capacidades_desc_unique` (`desc`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `capacidades`
--

INSERT INTO `capacidades` (`id`, `desc`, `created_at`, `updated_at`) VALUES
(2, '32 GB', '2019-07-29 22:02:58', '2019-08-07 00:51:44'),
(3, '64 GB', '2019-08-02 03:14:33', '2019-08-02 03:14:33'),
(4, '16 GB', '2019-08-07 00:51:53', '2019-08-07 00:51:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `celulares`
--

DROP TABLE IF EXISTS `celulares`;
CREATE TABLE IF NOT EXISTS `celulares` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `capacidad_id` bigint(20) UNSIGNED NOT NULL,
  `marca_id` bigint(20) UNSIGNED NOT NULL,
  `modelo_id` bigint(20) UNSIGNED NOT NULL,
  `vendedor` text COLLATE utf8mb4_unicode_ci,
  `comprador` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `imei` text COLLATE utf8mb4_unicode_ci,
  `fecha_compra` date NOT NULL,
  `fecha_venta` date DEFAULT NULL,
  `precio_compra` double(8,2) NOT NULL,
  `precio_venta` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `celulares_color_id_foreign` (`color_id`),
  KEY `celulares_capacidad_id_foreign` (`capacidad_id`),
  KEY `celulares_marca_id_foreign` (`marca_id`),
  KEY `celulares_modelo_id_foreign` (`modelo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `celulares`
--

INSERT INTO `celulares` (`id`, `color_id`, `capacidad_id`, `marca_id`, `modelo_id`, `vendedor`, `comprador`, `imei`, `fecha_compra`, `fecha_venta`, `precio_compra`, `precio_venta`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 4, 2, NULL, 'Felo', '1254', '2019-08-06', '0000-00-00', 20.50, NULL, '2019-08-02 00:28:16', '2019-08-07 17:09:19'),
(2, 3, 3, 4, 2, NULL, 'José Fernandez', '123456789', '2019-08-01', '0000-00-00', 100.00, NULL, '2019-08-02 03:16:16', '2019-08-07 17:09:29'),
(3, 1, 2, 4, 2, NULL, 'Gas', NULL, '2019-08-05', '0000-00-00', 33.00, NULL, '2019-08-06 00:43:58', '2019-08-07 17:09:38'),
(4, 2, 4, 5, 3, NULL, 'Bill Gates', '848484846468468', '2019-08-04', '0000-00-00', 240.00, NULL, '2019-08-07 00:53:37', '2019-08-07 00:54:03'),
(5, 2, 4, 5, 3, NULL, 'Bill Gates', NULL, '2019-08-03', '0000-00-00', 230.00, NULL, '2019-08-07 00:56:22', '2019-08-07 17:09:50'),
(6, 1, 4, 5, 3, 'RAMIRO', 'Bill Gates', NULL, '2019-07-29', '2019-08-06', 230.00, 300.00, '2019-08-07 00:57:26', '2019-08-07 01:01:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

DROP TABLE IF EXISTS `colores`;
CREATE TABLE IF NOT EXISTS `colores` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `colores_desc_unique` (`desc`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`id`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'Negro', NULL, NULL),
(2, 'blanco', '2019-07-29 04:36:21', '2019-07-29 04:36:21'),
(3, 'Verde', '2019-08-02 03:14:19', '2019-08-02 03:14:19'),
(4, 'Azul Oscuro', '2019-08-07 00:51:28', '2019-08-07 00:51:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

DROP TABLE IF EXISTS `marcas`;
CREATE TABLE IF NOT EXISTS `marcas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `marcas_desc_unique` (`desc`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `desc`, `created_at`, `updated_at`) VALUES
(2, 'Sansung', '2019-07-30 00:44:58', '2019-07-30 00:44:58'),
(3, 'Xiaomi', '2019-07-30 01:34:02', '2019-07-30 01:34:02'),
(4, 'Huawei', '2019-08-02 03:14:54', '2019-08-02 03:14:54'),
(5, 'Iphone', '2019-08-07 00:52:12', '2019-08-07 00:52:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_07_27_191639_create_colores_table', 1),
(5, '2019_07_27_191640_create_capacidades_table', 1),
(6, '2019_07_27_191641_create_modelos_table', 1),
(7, '2019_07_27_193850_create_marcas_table', 2),
(8, '2019_07_27_194518_create_celulares_table', 3),
(9, '2019_07_29_193155_marca_remove_modelo_id', 4),
(10, '2019_07_29_202352_modelo_add_marca_id', 5),
(11, '2014_10_12_000000_create_users_table', 6),
(12, '2019_05_09_180151_create_roles_table', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

DROP TABLE IF EXISTS `modelos`;
CREATE TABLE IF NOT EXISTS `modelos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `marca_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `modelos_desc_unique` (`desc`),
  KEY `modelos_marca_id_foreign` (`marca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`id`, `desc`, `created_at`, `updated_at`, `marca_id`) VALUES
(1, 'J329L', '2019-07-30 01:39:27', '2019-07-30 06:24:20', 2),
(2, 'ADFG202', '2019-08-02 03:15:19', '2019-08-02 03:15:19', 4),
(3, '8 Plus', '2019-08-07 00:52:34', '2019-08-07 00:52:34', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 1, '2019-08-20 12:30:00', '123456789', NULL, NULL, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `celulares`
--
ALTER TABLE `celulares`
  ADD CONSTRAINT `celulares_capacidad_id_foreign` FOREIGN KEY (`capacidad_id`) REFERENCES `capacidades` (`id`),
  ADD CONSTRAINT `celulares_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colores` (`id`),
  ADD CONSTRAINT `celulares_marca_id_foreign` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`),
  ADD CONSTRAINT `celulares_modelo_id_foreign` FOREIGN KEY (`modelo_id`) REFERENCES `modelos` (`id`);

--
-- Filtros para la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD CONSTRAINT `modelos_marca_id_foreign` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
