-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2024 a las 04:39:11
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cocina`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `micro` varchar(250) NOT NULL,
  `categorias` varchar(255) DEFAULT NULL,
  `preparacion` text NOT NULL,
  `ingredientes` text NOT NULL,
  `calificacion_promedio` float DEFAULT 0,
  `numero_votos` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`id`, `img`, `nombre`, `micro`, `categorias`, `preparacion`, `ingredientes`, `calificacion_promedio`, `numero_votos`) VALUES
(6, 'uploads/omelet.jpg', 'Omelette de Espinaca y Queso', 'Un omelette ligero y esponjoso, con un toque de espinaca y queso derretido. Perfecto para un desayuno nutritivo y fácil de preparar.', 'Desayunos', 'En un tazón bate los huevos con una pizca de sal y pimienta., Calienta el aceite en una sartén antiadherente y añade las espinacas; cocina por 2 minutos o hasta que estén suaves., Vierte los huevos batidos en la sartén y cocina a fuego medio., Agrega el queso sobre la mitad del omelette y dobla para cubrirlo., Cocina hasta que el queso se derrita y sirve caliente.', '3 huevos., 1 taza de espinacas frescas, picadas., ¼ taza de queso mozzarella rallado., 1 cucharada de aceite de oliva., Sal y pimienta al gusto', 5, 1),
(7, 'uploads/tossta.jpg', 'Tostadas Francesas con Frutas y Miel', 'Tostadas francesas suaves y esponjosas, servidas con frutas frescas y un toque de miel, perfectas para un desayuno dulce y energizante.', 'Desayunos', 'En un tazón tiene que batir los huevos con la leche/vainilla/ azúcar y canela. ,Sumerge cada rebanada de pan en la mezcla cubriendolas bien. ,Calienta la mantequilla en una sartén a fuego medio y cocina cada rebanada de pan hasta que esté dorada por ambos lados., Sirve las tostadas con frutas frescas por encima y un toque de miel o jarabe de maple.', '4 rebanadas de pan (preferiblemente del día anterior)., 2 huevos.,  ½ taza de leche., 1 cucharadita de esencia de vainilla., 1 cucharada de azúcar., 1 cucharadita de canela en polvo. ,1 cucharada de mantequilla., Frutas frescas (fresas/ plátano/ arándanos).,Miel o jarabe de maple al gusto', 3, 1),
(9, 'uploads/bruschettas.jpg', 'Bruschettas de Tomate y Albahaca', 'Pan tostado con una mezcla fresca de tomate, albahaca y ajo, sazonada con un toque de aceite de oliva.', 'Entradas', 'Tostar las rodajas de baguette en el horno o una sartén. ,En un tazón tienes que mezclar el tomate/ ajo/ albahaca/ aceite de oliva/ sal y pimienta., Coloca la mezcla sobre cada rodaja de pan y sirve.', '1 baguette cortada en rodajas. ,2 tomates maduros y que esten picados en cubos., 1 diente de ajo picado., ¼ taza de albahaca fresca y picada., 2 cucharadas de aceite de oliva., Sal y pimienta al gusto.', 0, 0),
(10, 'uploads/pollo.jpg', 'Pollo a la Parrilla con Limón y Hierbas', 'Jugoso pollo a la parrilla, marinado con limón y hierbas frescas, ideal para un almuerzo ligero y sabroso.', 'Platos Principales', 'En un tazón tienes que mezclar el jugo de limón/ ajo/ aceite/ romero/ sal y pimienta., Marina las pechugas de pollo en esta mezcla por al menos 30 minutos., Cocina el pollo en una parrilla precalentada hasta que esté dorado y cocido por dentro.', '4 pechugas de pollo., Jugo de 2 limones., 2 dientes de ajo picados., 2 cucharadas de aceite de oliva., 1 cucharadita de romero fresco y picado., Sal y pimienta al gusto.', 3, 1),
(11, 'uploads/papas.jpg', 'Papas al Horno con Romero', 'Papas doradas al horno con un toque de romero y ajo, ideales como acompañamiento para cualquier platillo principal.', 'Guarnicion', 'Precalienta el horno a 200°C., En un tazón, mezcla las papas con aceite, romero, ajo, sal y pimienta., Coloca las papas en una bandeja y hornea por 30-40 minutos o hasta que estén doradas.', '4 papas medianas cortadas en cubos. ,2 cucharadas de aceite de oliva. ,1 cucharadita de romero fresco y picado. ,2 dientes de ajo picados. ,Sal y pimienta al gusto', 0, 0),
(12, 'uploads/tarta.jpg', 'Tarta de Manzana', 'Deliciosa tarta con una base crujiente y relleno de manzanas aromatizadas con canela.', 'Postres', 'Precalienta el horno a 180°C.,Coloca la masa en un molde para tarta y distribuye las rodajas de manzana encima., Espolvorea el azúcar y la canela sobre las manzanas y coloca pequeños trozos de mantequilla encima., Hornea por 30-35 minutos o hasta que las manzanas estén tiernas y doradas.', '1 lámina de masa para tarta, 4 manzanas peladas o en rodajas, 2 cucharadas de azúcar,1 cucharadita de canela,1 cucharada de mantequilla', 4, 1),
(21, 'uploads/casa6.jpg', '', '', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `email` varchar(255) NOT NULL,
  `contraseña` varchar(200) NOT NULL,
  `usuario` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`email`, `contraseña`, `usuario`) VALUES
('diegodiego@gmail.com', '$2y$10$42hPVdXy7DSLFlixbWvlJeBAjoI.1V63gTpJco6dyTQJSBQDBSr16', 'diegoc'),
('diegogmail.ar', '$2y$10$VdzsEwDKyYsBPCPFP7CjC.y68SZGjwloANCKmejJCUE1AI1TLs6sG', 'dieog'),
('email@gmail.com', '$2y$10$Ko.ZTldfoLBJgwBDLtGpY.PuzRAtxTTG3mTygdDSBlYJ.b.umzj8q', 'mati'),
('emails@gmail.com', '$2y$10$A28Im/79rBH03e0HyE4lAehCVjym9GyS7iuK8TE78h65FeFjy9liK', 'holas'),
('juan@gmail.com', '$2y$10$tKPpV16U0xH..vUCsPKFEuHz7T4b.e7Xxq9aLs1g3I/.Z1akBnXTC', 'juan'),
('qwerty@gmail.com', '$2y$10$d/BKsSGRmJ5pNKSMSyibceSRYBs97PDxmYbpMshPqsaGEzUekPMeK', 'diegos'),
('sosamarceloandres@gmail.com', '$2y$10$HXJ/dc4waipG/LYs.8J0X.BUPsar3XT.vLwdDAAdMMlGJUgSVax5W', 'elsosi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votos`
--

CREATE TABLE `votos` (
  `id` int(11) NOT NULL,
  `id_usuario` varchar(255) NOT NULL,
  `id_receta` int(11) NOT NULL,
  `calificacion` int(1) NOT NULL CHECK (`calificacion` between 1 and 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `votos`
--

INSERT INTO `votos` (`id`, `id_usuario`, `id_receta`, `calificacion`) VALUES
(44, 'qwerty@gmail.com', 6, 5),
(50, 'email@gmail.com', 10, 3),
(54, 'email@gmail.com', 7, 3),
(57, 'email@gmail.com', 12, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `votos`
--
ALTER TABLE `votos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_receta` (`id_usuario`,`id_receta`),
  ADD KEY `id_receta` (`id_receta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `votos`
--
ALTER TABLE `votos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `votos`
--
ALTER TABLE `votos`
  ADD CONSTRAINT `votos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`email`) ON DELETE CASCADE,
  ADD CONSTRAINT `votos_ibfk_2` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
