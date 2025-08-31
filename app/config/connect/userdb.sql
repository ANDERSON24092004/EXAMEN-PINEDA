SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `userdb` DEFAULT CHARACTER SET utf8mb4;
USE `userdb`;

CREATE TABLE `user` (
  `id` varchar(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `correo` text NOT NULL,
  `telefono` varchar(11) NOT NULL DEFAULT '04124569780',
  `ciudad` text NOT NULL DEFAULT 'Barquisimeto',
  `clave` varchar(8) NOT NULL DEFAULT '12345678',
  `rol` tinyint(4) NOT NULL DEFAULT 1,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`id`, `nombre`, `apellido`, `correo`, `telefono`, `ciudad`, `clave`, `rol`, `estado`) VALUES
('12345678', 'Maria', 'Mendoza', 'maria@gmail.com', '04124569780', 'Barquisimeto', '12345678', 1, 0),
('12345678912', 'Jose', 'Perez', 'jose@gmail.com', '04141269780', 'Barquisimeto', '12345678', 1, 1),
('23456876', 'Elisa', 'Colmenarez', 'sabri@gmail.com', '04124569780', 'Barquisimeto', '12345678', 1, 0),
('2365478', 'Samuel', 'Espinoza', 'samuel@gmail.com', '04124569780', 'Barquisimeto', '12345678', 1, 0),
('29517943210', 'Sabrina', 'Colmenarez', 'sabrina@gmail.com', '04124569780', 'Barquisimeto', '12345678', 2, 1),
('87654321', 'Mariana', 'Alvarez', 'mariana@gmail.com', '04124569780', 'Barquisimeto', '12345678', 1, 0),
('87654321098', 'Mario', 'Gonzalez', 'mario@gmail.com', '04124569780', 'Barquisimeto', '12345678', 1, 1);


ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;
