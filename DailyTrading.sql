-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-01-2025 a las 12:27:27
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `DailyTrading`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trades`
--

CREATE TABLE `trades` (
  `trade_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `trade_date` date NOT NULL,
  `instrument` varchar(11) NOT NULL,
  `contracts` int(11) NOT NULL,
  `commissions` float NOT NULL,
  `trade_pl` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_role` varchar(20) NOT NULL,
  `initial_balance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `trades`
--
ALTER TABLE `trades`
  ADD PRIMARY KEY (`trade_id`) USING BTREE;

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `trades`
--
ALTER TABLE `trades`
  MODIFY `trade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
