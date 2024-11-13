
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

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

INSERT INTO `recetas` (`id`, `img`, `nombre`, `micro`, `categorias`, `preparacion`, `ingredientes`, `calificacion_promedio`, `numero_votos`) VALUES
(2, 'uploads/hambur.jpg', 'Hamburguesa', 'Una jugosa carne, cubierta con queso cheddar derretido, entre dos suaves panes tostados. Sencilla pero deliciosa.', 'comida rapida', 'adhuashdka', '500 g de carne molida de res (puedes usar carne mixta con cerdo si prefieres), 1 huevo (para ligar la carne), 1/4 taza de pan rallado (para darle consistencia a la mezcla), 1 cebolla pequeña (finamente picada), 2 dientes de ajo (picados o prensados), Sal y pimienta (al gusto), 1 cucharadita de mostaza (opcional), 1 cucharadita de salsa Worcestershire (opcional), 4 panes de hamburguesa (puedes usar pan integral o el de tu preferencia), 4 hojas de lechuga (lavadas y secas), 1 tomate grande (cortado en rodajas), 4 rebanadas de queso (cheddar, suizo o el que prefieras), Pepinillos (opcional, al gusto), Ketchup, mayonesa y mostaza (al gusto), Aceite de oliva (para cocinar las hamburguesas)\r\n', 5, 1),
(3, 'uploads/omelet.jpg', 'Omelet', 'Un omelet es un plato sencillo y versátil, hecho con huevos batidos y cocinados en una sartén. Se puede personalizar con diversos ingredientes como queso, jamón, vegetales (pimientos, cebolla, espinacas) y hierbas.', '', 'Bate los huevos con una pizca de sal y pimienta,Calienta una sartén antiadherente con un poco de aceite o mantequilla,Vierte los huevos batidos en la sartén caliente,Cocina a fuego medio-bajo hasta que los bordes se despeguen. Agrega el relleno deseado en el centro,Dobla el omelet a la mitad y cocina unos segundos más hasta que el relleno esté caliente, luego servir caliente y disfrute.', 'Huevos (normalmente 2 o 3),sal y pimienta a gusto, Rellenos opcionales: queso rallado/ jamón/ cebolla/ espinaca/ tomate/entre otros', 4, 1);

CREATE TABLE `usuario` (
  `email` varchar(255) NOT NULL,
  `contraseña` varchar(200) NOT NULL,
  `usuario` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


INSERT INTO `usuario` (`email`, `contraseña`, `usuario`) VALUES
('diegodiego@gmail.com', '$2y$10$42hPVdXy7DSLFlixbWvlJeBAjoI.1V63gTpJco6dyTQJSBQDBSr16', 'diegoc'),
('diegogmail.ar', '$2y$10$VdzsEwDKyYsBPCPFP7CjC.y68SZGjwloANCKmejJCUE1AI1TLs6sG', 'dieog'),
('email@gmail.com', '$2y$10$Ko.ZTldfoLBJgwBDLtGpY.PuzRAtxTTG3mTygdDSBlYJ.b.umzj8q', 'mati'),
('emails@gmail.com', '$2y$10$A28Im/79rBH03e0HyE4lAehCVjym9GyS7iuK8TE78h65FeFjy9liK', 'holas'),
('juan@gmail.com', '$2y$10$tKPpV16U0xH..vUCsPKFEuHz7T4b.e7Xxq9aLs1g3I/.Z1akBnXTC', 'juan');

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
(1, 'email@gmail.com', 3, 4),
(13, 'email@gmail.com', 2, 5);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `votos`
--
ALTER TABLE `votos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
