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
  `ingredientes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


INSERT INTO `recetas` (`id`, `img`, `nombre`, `micro`, `categorias`, `preparacion`, `ingredientes`) VALUES
(2, 'uploads/hambur.jpg', 'Hamburguesa', 'Una jugosa carne, cubierta con queso cheddar derretido, entre dos suaves panes tostados. Sencilla pero deliciosa.', 'comida rapida', 'adhuashdka', '500 g de carne molida de res (puedes usar carne mixta con cerdo si prefieres), 1 huevo (para ligar la carne), 1/4 taza de pan rallado (para darle consistencia a la mezcla), 1 cebolla pequeña (finamente picada), 2 dientes de ajo (picados o prensados), Sal y pimienta (al gusto), 1 cucharadita de mostaza (opcional), 1 cucharadita de salsa Worcestershire (opcional), 4 panes de hamburguesa (puedes usar pan integral o el de tu preferencia), 4 hojas de lechuga (lavadas y secas), 1 tomate grande (cortado en rodajas), 4 rebanadas de queso (cheddar, suizo o el que prefieras), Pepinillos (opcional, al gusto), Ketchup, mayonesa y mostaza (al gusto), Aceite de oliva (para cocinar las hamburguesas)\r\n');


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

ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`email`);

ALTER TABLE `recetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;