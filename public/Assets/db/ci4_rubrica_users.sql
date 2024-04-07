-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-04-2024 a las 22:12:57
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ci4_rubrica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sw_usuario`
--

CREATE TABLE `sw_usuario` (
  `id_usuario` int(11) UNSIGNED NOT NULL,
  `us_titulo` varchar(8) NOT NULL,
  `us_titulo_descripcion` varchar(96) NOT NULL,
  `us_apellidos` varchar(32) NOT NULL,
  `us_nombres` varchar(32) NOT NULL,
  `us_shortname` varchar(45) NOT NULL,
  `us_fullname` varchar(64) NOT NULL,
  `us_login` varchar(24) NOT NULL,
  `us_password` varchar(535) NOT NULL,
  `us_foto` varchar(100) NOT NULL,
  `us_genero` varchar(1) NOT NULL,
  `us_activo` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `sw_usuario`
--

INSERT INTO `sw_usuario` (`id_usuario`, `us_titulo`, `us_titulo_descripcion`, `us_apellidos`, `us_nombres`, `us_shortname`, `us_fullname`, `us_login`, `us_password`, `us_foto`, `us_genero`, `us_activo`) VALUES
(1, 'Ing.', 'Ingeniero en Sistemas Informáticos y de Computación', 'Peñaherrera Escobar', 'Gonzalo Nicolás', 'Ing. Gonzalo Peñaherrera', 'Peñaherrera Escobar Gonzalo Nicolás', 'Administrador', '$2y$10$vJfyhM9xuH1Ygt9nDYaUiecqoyUK5OSeQWFo9pZOvKRqgzmwfgCrS', '1712262886_2caf80001eb5648c5a92.jpg', 'M', 1),
(2, 'Ing.', 'Master Universitario de II Nivel en Alta Dirección', 'Benavides Ortiz', 'German Gustavo', 'Ing. German Benavides', 'Benavides Ortiz German Gustavo', 'germanb', '$2y$10$ky1oT4vGODMo30jMJFGPr.FpH1YV.gGVSkqiqqJsHxnmGL5REwckS', '1712262803_09f992adcae70947750d.jpg', 'M', 1),
(3, 'Tlgo.', 'Tecnólogo en Informática', 'Cabascango Herrera', 'Milton Fabián', 'Tlgo. Milton Cabascango', 'Cabascango Herrera Milton Fabián', 'miltonc', '$2y$10$3r.p8lCUWhQAAf20uP48auIh.VfJkfX9mGbLNVRbFvY.X2zmfMUQi', '1712267037_68487314227439e4ab1e.jpg', 'M', 1),
(4, 'Lic.', 'Licenciado en ciencias de la educación', 'Calero Navarrete', 'Elmo Eduardo', 'Lic. Elmo Calero', 'Calero Navarrete Elmo Eduardo', 'elmoc', '$2y$10$F6u.gcW8Lk6hr67kHGSnle1.Efud8POM3ilX7nKrbbo8hoBKkv/xe', '1712331130_fd3020888d18e0816926.jpg', 'M', 1),
(5, 'Lic.', 'Licenciado en ciencias de la educación', 'Cedeño Zambrano', 'Edith Monserrate', 'Lic. Edith Cedeño', 'Cedeño Zambrano Edith Monserrate', 'edithc', '$2y$10$mGOsztPtX7e8cyYPbSAkOeoYEunfX/SqtXgHwzBzgY1FV3WYpU/CW', '1712331952_5328030183cf88e723b1.jpg', 'F', 1),
(6, 'Dr.', 'Doctor en Jurisprudencia y Abogado de los Tribunales de la Republica', 'Enríquez Martínez', 'Carlos Alberto', 'Dr. Carlos Enríquez', 'Enríquez Martínez Carlos Alberto', 'carlose', '$2y$10$J3ATDJL7dB4qYBNpq/6RTOgWLQjgpFuiu5HMPlg3MoBbx/.tIUqeG', '1712333150_d367e1e9067cf9cac946.png', 'M', 1),
(7, 'Lic.', 'Licenciada en Turismo Histórico Cultural', 'Jumbo Cumbicos', 'Diana Patricia ', 'Lic. Diana Jumbo', 'Jumbo Cumbicos Diana Patricia ', 'dianaj', '$2y$10$HFUhcJ5ABmDRTEInLIVvHeL6UNSdwYgOPy5KYjF8/LrVEV/EpDrcC', '1712337665_5dd65e03a261d63c0d6a.png', 'F', 1),
(8, 'Lic.', 'Licenciado en Ciencias de la Educación', 'Mejía Segarra', 'Rómulo Oswaldo', 'Lic. Rómulo Mejía', 'Mejía Segarra Rómulo Oswaldo', 'romulom', '$2y$10$NNfEYb.gSvOahf.deE6ds.462B44FgarDac482r906ADGMtPqFMXK', '1712338143_46e66019d811c94828bd.jpg', 'M', 1),
(9, 'Ing.', 'Ingeniero en Sistemas', 'Peñaherrera Escobar', 'Gonzalo Nicolás', 'Ing. Gonzalo Peñaherrera', 'Peñaherrera Escobar Gonzalo Nicolás', 'gonzalop', '$2y$10$uzaglefkULjdD9N.2GPEoubpTSzKQOK/aBS/qOkYRGm.wbhAXx.kO', '1712339907_6b190a223b940e0fe48f.png', 'M', 1),
(10, 'MSc.', 'Master en Enseñanza de la Matemática', 'Proaño Estrella', 'Wilson Eduardo', 'MSc. Wilson Proaño', 'Proaño Estrella Wilson Eduardo', 'wilsonp', '$2y$10$Ko22Asgkdz6TFeJ6BmE1ouJ5IQFVurRXbbuF0/0lnGDou8j1A1uGO', '1712340953_219e6c4181d9e11e1c50.jpg', 'M', 1),
(11, 'Lic.', 'Licenciado en ciencias de la educación', 'Quijia Pilapaña', 'Jenny Mariela', 'Lic. Jenny Quijia', 'Quijia Pilapaña Jenny Mariela', 'jennyq', '$2y$10$HNAi8VfvfRubqPpI9T4PJuYiBkpkNnHuDxN0x/pZFNnzb/EEpcxg6', '1712342478_ef2a3f822cd548053870.jpg', 'F', 1),
(12, 'MSc.', 'Magister en Docencia Universitaria y Administración Educativa', 'Rosero Medina', 'Roberto Hernán', 'MSc. Roberto Rosero', 'Rosero Medina Roberto Hernán', 'robertos', '$2y$10$iyaTYDjcCNptM4DoL5J54.eZeC3h6tSMkFsaQfKUjaQBOIUmsd0Xu', '1712342718_06377c7bb103898d7763.jpg', 'M', 1),
(13, 'Lic.', 'Licenciado en ciencias de la educación', 'Salazar Ordoñez', 'Carmen Alicia', 'Lic. Alicia Salazar', 'Salazar Ordoñez Carmen Alicia', 'alicias', '$2y$10$ONEpUDg0XxvcYYw8tx6O/eBMAa5BJEOS5ASGcSPdlyU6mmOAWbDPa', '1712347188_386d497f1198347d4ca6.jpg', 'F', 1),
(14, 'Lic.', 'Licenciado en ciencias de la educación', 'Salgado Araujo', 'María Del Rosario', 'Lic. María Salgado', 'Salgado Araujo María Del Rosario', 'rosarios', '$2y$10$K2754py9o1hRfqhM3FFFIe87p.0elKqWJwTDIfWVPJ3BnrPqx9BcW', '1712347436_41ef590ca65adbd200d2.jpg', 'F', 1),
(15, 'MSc.', 'Master Universitario en Educación Bilingüe', 'Sanmartín Vásquez', 'Sandra Verónica', 'MSc. Verónica Sanmartín', 'Sanmartín Vásquez Sandra Verónica', 'veronicas', '$2y$10$GWViQ04NmzpGTn/zIN0iledrHUpprIo8wDQmOswPCg6TusoMt3dr2', '1712347558_67f913b45b91bcdd7ade.jpg', 'F', 1),
(16, 'Lic.', 'Licenciado en ciencias de la educación', 'Trujillo Realpe', 'William Oswaldo', 'Lic. William Trujillo', 'Trujillo Realpe William Oswaldo', 'williamt', '$2y$10$7.AXTw1hrGMdBV/IVL.yTej2BJm/3OpMCZMkDl8U/jxIbH9JYmSAC', '1712347650_5aba9cc048c74084c372.jpg', 'M', 1),
(17, 'Lic.', 'Diploma Superior en Ciencias de la Educación', 'Zambrano Cedeño', 'Walter Adbón', 'Lic. Walter Zambrano', 'Zambrano Cedeño Walter Adbón', 'walterz', '$2y$10$9HfvFkMV9.K7bHpV4YLnC.vVRaO9bZ0hS.NsHUk85Rzxfm5lyMno.', '1712347722_f9882567f8d9d4296542.jpg', 'M', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sw_usuario_perfil`
--

CREATE TABLE `sw_usuario_perfil` (
  `id_usuario` int(11) UNSIGNED NOT NULL,
  `id_perfil` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `sw_usuario_perfil`
--

INSERT INTO `sw_usuario_perfil` (`id_usuario`, `id_perfil`) VALUES
(1, 1),
(2, 4),
(2, 8),
(3, 4),
(3, 8),
(4, 4),
(4, 5),
(5, 4),
(5, 8),
(6, 4),
(6, 8),
(7, 4),
(7, 8),
(8, 4),
(8, 8),
(9, 4),
(9, 8),
(10, 2),
(10, 4),
(11, 4),
(11, 8),
(12, 4),
(12, 8),
(13, 4),
(13, 8),
(14, 4),
(14, 8),
(15, 4),
(15, 8),
(16, 4),
(16, 8),
(17, 4),
(17, 8);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sw_usuario`
--
ALTER TABLE `sw_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `sw_usuario_perfil`
--
ALTER TABLE `sw_usuario_perfil`
  ADD KEY `sw_usuario_perfil_id_usuario_foreign` (`id_usuario`),
  ADD KEY `sw_usuario_perfil_id_perfil_foreign` (`id_perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sw_usuario`
--
ALTER TABLE `sw_usuario`
  MODIFY `id_usuario` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sw_usuario_perfil`
--
ALTER TABLE `sw_usuario_perfil`
  ADD CONSTRAINT `sw_usuario_perfil_id_perfil_foreign` FOREIGN KEY (`id_perfil`) REFERENCES `sw_perfil` (`id_perfil`),
  ADD CONSTRAINT `sw_usuario_perfil_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `sw_usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
