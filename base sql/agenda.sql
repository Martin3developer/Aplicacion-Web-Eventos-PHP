-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 24-01-2017 a las 18:02:54
-- Versión del servidor: 5.6.33
-- Versión de PHP: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(4) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono1` varchar(9) NOT NULL,
  `telefono2` varchar(9) DEFAULT NULL,
  `nick` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `direccion`, `telefono1`, `telefono2`, `nick`, `pass`) VALUES
(0, 'Administrador', ' ', '', '', '', 'admin', 'admin'),
(16, 'Martin', 'Carmona Lopez', 'C/Manuel Solano nº1', '111111111', '333334444', 'martin', '11111111'),
(17, 'Rosa', 'Morata Ferranz', 'Avd. La paz n28', '222222222', NULL, 'rosa', '222222222'),
(18, 'Jaime', 'Conde Rumian', 'C/Doctor Peset', '333333333', NULL, 'jaime', '333333333'),
(19, 'Sergio', 'Hernando Pérez', 'C/Torrente nº10', '444444444', '999999999', 'sergio', '444444444'),
(20, 'Lucía ', 'Marín Gomez', 'Avd. Las palmeras nº20', '555555555', NULL, 'lucia', '555555555'),
(21, 'Antonio', 'Montenegro Vela', 'C/Dia del sol', '22222233', NULL, 'antonio', '22222233'),
(22, 'Sara', 'Carmona Rey', 'C/Escuela De No Artes', '633222333', NULL, 'sara', '333222333'),
(23, 'Alberto ', 'Sanchez Roto', 'C/Estación de trenes', '223332223', '998855574', 'alberto', '65555555'),
(24, 'Estefanía', 'Lopez Gutierrez', 'c/Brasilia nº3', '332224445', NULL, 'estefania', '334443334'),
(25, 'Jose Rafael', 'Expósito Redondo', 'C/Priego de Cordoba nº2', '334449995', NULL, 'JoseR', '223333444'),
(26, 'Amaya', 'Sol de la Vega', 'C/Aula 19 nº4', '222333444', '222333322', 'amaya', '333222319');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id_servicio` int(4) NOT NULL,
  `id_cliente` int(4) NOT NULL,
  `lugar` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id_servicio`, `id_cliente`, `lugar`, `fecha`, `hora`) VALUES
(1, 16, 'asdfad', '2017-01-13', '22:02:00'),
(1, 16, 'asdfasd', '2017-01-21', '22:33:00'),
(1, 20, 'Sevilla', '2017-01-13', '02:20:00'),
(1, 22, 'Estocolmo', '2017-01-15', '03:22:00'),
(2, 18, 'Jaén', '2016-12-01', '12:00:00'),
(2, 19, 'Cádiz', '2016-12-16', '02:22:00'),
(3, 16, 'Granada', '2016-12-16', '10:00:00'),
(3, 16, 'Lugo', '2017-02-23', '22:03:00'),
(4, 19, 'SEvila', '2017-01-13', '03:03:00'),
(5, 19, 'Barcelona', '2017-02-17', '22:33:00'),
(9, 26, 'Cáceres', '2017-02-01', '11:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(4) NOT NULL,
  `titular` varchar(200) NOT NULL,
  `contenido` varchar(3000) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titular`, `contenido`, `imagen`, `fecha`) VALUES
(1, 'Boda Fantástica en Granada', 'Inmortalizar el momento, dejar constancia, revivir el pasado, transmitir, emocionar… Este es mi trabajo. Realizar videos de bodas es una de las pasiones que tengo en mi vida. Soy afortunado por tener este trabajo tan bonito y poder filmar videos de boda que llegan al alma. Desde muy temprana edad, aún recuerdo aquel vestido blanco, el traje del novio, la alegría que se respiraba de todos los que aquel día allí se encontraban, me emocionaba ver todo lo que ocurría desde una perspectiva diferente. Puedo decir que fue una experiencia inolvidable y en la que hoy sigo reviviendo como si de la primera vez se tratase. Cuento historias llenas de pasión y sentimiento, lo hago a mi manera, con sencillez, con un estilo propio, hecho a medida, obteniendo lo mejor de ese día tan especial. Es increíble el poder que tiene sobre la gente combinar la música, los sonidos, el movimiento y la luz, filmar películas de boda es algo que me llena interiormente. Quiero que recuerdes el día de tu boda mejor de ', 'images/noticias/1.jpg', '2016-12-10'),
(2, 'Magico Festival lleno de Música y Danza', 'El Festival de Málaga nació en 1998 y en cada una de sus ediciones ha pretendido alcanzar una serie de objetivos, entre ellos, favorecer la difusión y promoción de la cinematografía española, convertirnos en un referente a nivel nacional e internacional en el ámbito de las manifestaciones cinematográficas y contribuir al desarrollo de Málaga como una ciudad abierta y cultural.<br>\r\n\r\nEl Festival de Málaga, que este año cumple su Decimonovena Edición, contribuye poderosamente al desarrollo del cine en español presentando sus mejores Documentales, Cortometrajes, etc., además de rendir homenaje a diferentes personalidades de la industria cinematográfica y organizar numerosos ciclos, exposiciones y actividades paralelas. El Festival de Málaga quiere llegar a todos los públicos y en su deseo de presentar y potenciar un amplio panorama de la cultura cinematográfica pretende estar siempre atento a la formación, a la creatividad y a la innovación, enmarcadas dentro de una actividad que destaca', 'images/noticias/2.jpg', '2016-11-17'),
(3, 'Un Cumpleaños de Ensueño', 'El cumpleaños es el aniversario de nacimiento de un ser vivo. En muchas culturas es costumbre celebrar el cumpleaños, por ejemplo mediante una fiesta con amigos, en las que se dan regalos al homenajeado. Las fiestas de cumpleaños son muy populares sobre todo entre los niños. Son una oportunidad más para la socialización con los amigos y la familia. En ella, es costumbre entregar regalos al anfitrión y comer una Tarta o pastel al cual se le colocan velas, para que el cumpleañero sople y las apague mientras los invitados cantan alguna canción de cumpleaños, siendo entre las más populares Ay, qué noche tan preciosa en Venezuela, Cumpleaños feliz en varios países y Las mañanitas en México y otros países de habla hispana.', 'images/noticias/3.png', '2016-11-24'),
(4, 'Ferial de deporte y educación física', 'Somos una empresa dedicada al alquiler de casetas, que siendo conscientes de la situación del mercado en la actualidad, ofrecemos para cualquier evento, ferias, o mercados, casetas de madera al mejor precio del mercado, y lo más importante, las adaptamos a sus necesidades de negocio, teniendo a su disposición la posibilidad de montar casetas dobles y cuádruples.<br>\r\n \r\nNuestras casetas son desmontables y están fabricadas en madera natural, y adaptadas a todas la normativas vigentes, así como preparadas para su exposición en el exterior, con certificado de resistibilidad al viento.\r\n ', 'images/noticias/4.jpg', '2016-11-30'),
(5, 'Concierto en el Restaurante Premium', 'MIRAMIVIDEO.TV estuvo grabando la INAUGURACION de la TERRAZA en GALERIA THEREDOOM.<br><br>\r\n\r\nEl día 5 de mayo la Galería THEREDOOM inauguro "La Terraza", un espacio de vanguardia anexo a la galería diseñado como punto de reunión y lugar para el acercamiento al arte contemporáneo.<br>\r\nBoyer Tresaco el comisario de la exposicion ANDY WARHOL "Todo empezó así..." y presentador del programa de Television POSTCONTEMPORANEA conto con multitud de invitados, amigos y criticos de arte.', 'images/noticias/5.jpg', '2016-11-20'),
(6, '25 Cumpleaños de nuestro director', 'En una nutrida reunión en el Club Xilón en Pasto,  las empresas Diario del Sur, Diario Extra, HSB Radio, Almacenes Luber, Gaseosas La Cigarra, Hotel y Club Xilón, le brindaron muestras de cariño y admiración a su jefe y amigo, Hernando Suárez Burgos en la celebración de su cumpleaños. Como todos los días\r\n<br>\r\n<img src=\'http://www.lto.de/fileadmin/user_upload/Happy_Birthday_Allgemeingut_620x347.jpg\' style=\'width:100%\'></br>\r\nHamon, que obtuvo cerca del 35% de los apoyos, se ganó a los electores, especialmente a los jóvenes de los grandes centros urbanos, con un discurso aperturista y de calado social que le ha valido el respaldo de Montebourg, que puede ser crucial para la segunda vuelta.<br>\r\n<br>\r\nMuy lejos, más allá de las montañas de palabras, alejados de los países de las vocales y las consonantes, viven los textos simulados. Viven aislados en casas de letras, en la costa de la semántica, un gran océano de lenguas. Un riachuelo llamado Pons fluye por su pueblo y los abastece con las normas necesarias.\r\n\r\nHablamos de un país paraisomático en el que a uno le caen pedazos de frases asadas en la boca. Ni siquiera los todopoderosos signos de puntuación dominan a los textos simulados; una vida, se puede decir, poco ortográfica. Pero un buen día, una pequeña línea de texto simulado, llamada Lorem Ipsum, decidió aventurarse y salir al vasto mundo de la gramática.<br>\r\n\r\nEl gran Oxmox le desanconsejó hacerlo, ya que esas tierras estaban llenas de comas malvadas, signos de interrogación salvajes y puntos y coma traicioneros, pero el texto simulado no se dejó atemorizar. Empacó sus siete versales, enfundó su inicial en el cinturón y se puso en camino. \r\n<br>Cuando ya había escalado las primeras colinas de las montañas cursivas, se dio media vuelta para dirigir su mirada por última vez, hacia su ciudad natal Letralandia, el encabezamiento del pueblo Alfabeto y el subtítulo de su\r\n\r\n', 'images/noticias/6.jpg', '2016-12-15'),
(7, 'Fiesta en la piscina', 'La primera noticia del veranito. \r\nComo no podía ser de otra manera en la piscina', '../images/noticias/1.png', '2016-07-11'),
(8, 'Cumpleaños de Sara!!!', 'La vida es corta y sara sabe como disfrutarla junto a sus amigos', '../images/noticias/2.png', '2016-11-15'),
(9, 'Cata de Vinos de Alicante', 'Una gran convencion de vinos en el lujoso pabellon de alicante con las mejores marcas y los mejores catadores, ¿Quien se hará con el premio?', '../images/noticias/4.png', '2016-06-14'),
(10, 'Primera Concentración', 'Es la primera vez que reunimos a un millon de personas para ver una de las actuaciones mas épicas de la historia', '../images/noticias/6.png', '2016-03-15'),
(11, 'El pelo de este señor no me deja ver', 'Un indignado en la exposición del nuevo samsung galaxy S3 ha dado que hablar ya que denunció a la empresa que lo organizaba', '../images/noticias/7.png', '2015-08-11'),
(12, 'La mejor pista de baile', 'Una boda de ensueño acaba con el baile de todos los participantes a nivel profesional, los videos captados en aquel lugar se han hecho virales', '../images/noticias/8.png', '2016-01-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(4) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `precio` int(6) NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `descripcion`, `precio`, `imagen`) VALUES
(1, 'Boda para 100 Personas', 'Decoración de local, banquete, fotógrafo y animado', 4000, '../images/servicios/5.jpg'),
(2, 'Cumpleaños para 50 personas', 'Decoración de interiores, banquete, música y paste', 600, '../images/servicios/2.jpg'),
(3, 'Festival para 1000 personas', 'Escenario, iluminación, sonido y presentador de ev', 3000, '../images/servicios/3.jpg'),
(4, 'El evento mas espectacular', 'Lo mejor que hay de este evento es su incertidumbr', 333333, '../images/servicios/4.jpg'),
(5, 'Fiesta de la Piscina para 40 p', 'Un servicio de animacion, cocteles y demás...', 500, '../images/servicios/5.jpg'),
(6, 'Concierto a lo Grande', 'Un despliegue para 1000 personas', 10000, '../images/servicios/6.jpg'),
(7, 'Charla Motivacional', 'Espacio adaptado a las charlas con microfonía', 200, '../images/servicios/7.jpg'),
(8, 'Pista de baile con amigos', 'Local con pista de baile para cursos', 5000, '../images/servicios/8.jpg'),
(9, 'Fiesta con farolillos', 'Despliegue de farolillos y fuegos', 800, '../images/servicios/9.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nick` (`nick`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_servicio`,`id_cliente`,`fecha`),
  ADD KEY `cf_cli` (`id_cliente`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `cf_cli` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `cf_ser` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
