-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-08-2023 a las 15:33:54
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `portfoliomagazine`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `nombreCategoria` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nombreCategoria`) VALUES
(1, 'frontend'),
(2, 'html'),
(3, 'css'),
(4, 'javascript'),
(5, 'buenas practicas frontend'),
(6, 'php'),
(7, 'sql'),
(8, 'base de datos'),
(9, 'buenas practicas backend'),
(10, 'grafico'),
(11, 'illustrator'),
(12, 'indesign'),
(13, 'photoshop'),
(14, 'buenas practicas diseno'),
(21, 'programas'),
(22, 'figma'),
(23, 'visual studio code'),
(24, 'xampp'),
(25, 'buenas practicas programas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_recetas`
--

CREATE TABLE `categorias_recetas` (
  `idCategoriaReceta` int(11) NOT NULL,
  `categoriaReceta` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias_recetas`
--

INSERT INTO `categorias_recetas` (`idCategoriaReceta`, `categoriaReceta`) VALUES
(1, 'Comidas'),
(2, 'Postres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_imagen`
--

CREATE TABLE `categoria_imagen` (
  `idCategoria` int(11) NOT NULL,
  `anio` date NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `imagen_principal` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_videos`
--

CREATE TABLE `categoria_videos` (
  `idCategoriaVideo` int(11) NOT NULL,
  `nombre` varchar(250) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria_videos`
--

INSERT INTO `categoria_videos` (`idCategoriaVideo`, `nombre`) VALUES
(1, 'Walt Disney World 2008'),
(2, 'Enero 2011'),
(3, 'Playa Del Carmen 2011'),
(4, 'Nueva York 2018');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigo_ejemplo`
--

CREATE TABLE `codigo_ejemplo` (
  `idCodigoEjemplo` int(11) NOT NULL,
  `categoria` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `codigo_ejemplo`
--

INSERT INTO `codigo_ejemplo` (`idCodigoEjemplo`, `categoria`, `codigo`) VALUES
(3, 'HTML', '&lt;p&gt; Esto es un párrafo, código ejemplo &lt;/p&gt;'),
(4, 'HTML', '&lt;a href=\"link\"&gt;Enlace HTML&lt;/a&gt;'),
(5, 'HTML', '&lt;img src=\"asdasd.jpg\" alt=\"ejemplo imagen\"&gt;'),
(6, 'HTML', '&lt;ul&gt;\r\n&lt;li&gt;List Item 1&lt;/li&gt;\r\n&lt;/ul&gt;'),
(7, 'CSS', '*{\r\ncolor:red;\r\n}'),
(8, 'CSS', 'flex {\r\ndisplay:flex;\r\njustify-content:center;\r\n}'),
(9, 'CSS', '@media screen and (max-width:990px){}'),
(10, 'CSS', '.container{\r\nmax-width:90%;\r\nmargin:auto;\r\n}'),
(11, 'JavaScript', 'let variable = \"valor\";'),
(12, 'JavaScript', 'const varConstante = \"valor constante\";'),
(13, 'JavaScript', 'document.querySelector(\"#elementoHTML\");'),
(14, 'JavaScript', 'document.createElement(\"p\");');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `idContacto` int(11) NOT NULL,
  `avatar` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(250) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_categoria_leccion`
--

CREATE TABLE `detalle_categoria_leccion` (
  `idDetalle` int(11) NOT NULL,
  `idLeccion` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_categoria_leccion`
--

INSERT INTO `detalle_categoria_leccion` (`idDetalle`, `idLeccion`, `idCategoria`) VALUES
(7, 4, 1),
(8, 4, 3),
(9, 5, 1),
(10, 5, 3),
(29, 7, 1),
(30, 7, 3),
(31, 8, 1),
(32, 8, 3),
(33, 9, 1),
(34, 9, 3),
(56, 1, 1),
(57, 1, 2),
(60, 15, 1),
(61, 15, 2),
(67, 17, 5),
(68, 17, 7),
(81, 19, 1),
(82, 19, 2),
(83, 19, 3),
(92, 18, 1),
(93, 18, 4),
(94, 18, 5),
(95, 18, 6),
(101, 2, 1),
(102, 2, 3),
(105, 21, 21),
(106, 21, 22),
(107, 16, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero_musica`
--

CREATE TABLE `genero_musica` (
  `idGenero` int(11) NOT NULL,
  `genero` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `genero_musica`
--

INSERT INTO `genero_musica` (`idGenero`, `genero`) VALUES
(1, 'Rock'),
(2, 'Pop 80s'),
(3, 'Reggaeton'),
(5, 'Reggae');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `idImagen` int(11) NOT NULL,
  `mes` varchar(250) NOT NULL,
  `anio` int(11) NOT NULL,
  `url_img` varchar(250) NOT NULL,
  `idLugar` int(11) NOT NULL,
  `idViaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`idImagen`, `mes`, `anio`, `url_img`, `idLugar`, `idViaje`) VALUES
(194, 'junio', 2003, '01.JPG', 4, 3),
(195, 'junio', 2003, '02.JPG', 4, 3),
(196, 'junio', 2003, '03.JPG', 4, 3),
(197, 'junio', 2003, '04.JPG', 4, 3),
(199, 'junio', 2003, '05.JPG', 4, 3),
(200, 'junio', 2003, '06.JPG', 4, 3),
(201, 'junio', 2003, '07.JPG', 4, 3),
(202, 'junio', 2003, '08.JPG', 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lecciones`
--

CREATE TABLE `lecciones` (
  `idLeccion` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `contenido` text NOT NULL,
  `urlVideo` varchar(300) NOT NULL,
  `portadaLeccion` varchar(300) DEFAULT NULL,
  `baja_leccion` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lecciones`
--

INSERT INTO `lecciones` (`idLeccion`, `titulo`, `descripcion`, `contenido`, `urlVideo`, `portadaLeccion`, `baja_leccion`) VALUES
(1, 'Meta Información', 'Etiquetas básicas de la cabecera de cualquier sitio web.', '<p>Las etiquetas meta o la <strong>meta informaci&oacute;n</strong> son etiquetas que se utilizan para que el buscador encuentre las p&aacute;ginas con mayor facilidad. Cuanto m&aacute;s descriptivas y especificas sean el uso de estas etiquetas el buscador tendr&aacute; una mayor facilidad para buscarlas. Estas etiquetas se encuentran dentro de la etiqueta <strong>head&nbsp;</strong>del documento html.</p>\r\n\r\n<p>Define el juego de caracteres seg&uacute;n el idioma especificado utilizado:</p>\r\n\r\n<p class=\"codigo codigo-html\">Meta Charset=&quot;UTF-8&quot;</p>\r\n\r\n<p>Definir palabras clave para los motores de b&uacute;squeda:</p>\r\n\r\n<p class=\"codigo codigo-html\">&lt;meta name=&quot;keywords&quot; content=&quot;HTML, CSS, JavaScript&quot;&gt;</p>\r\n\r\n<p>Describe la p&aacute;gina web:</p>\r\n\r\n<p class=\"codigo codigo-html\">&lt;meta name=&quot;description&quot; content=&quot;Free Web tutorials&quot;&gt;</p>\r\n\r\n<p>Define el autor de una p&aacute;gina:</p>\r\n\r\n<p class=\"codigo codigo-html\">&lt;meta name=&quot;author&quot; content=&quot;John Doe&quot;&gt;</p>\r\n\r\n<p>Configuraci&oacute;n de la ventana gr&aacute;fica para que su sitio web se vea bien en todos los dispositivos:</p>\r\n\r\n<p class=\"codigo codigo-html\">&lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1.0&quot;&gt;</p>\r\n\r\n<p>Icono</p>\r\n\r\n<p class=\"codigo codigo-html\">&lt;link rel=&quot;icon&quot; type=&quot;image/x-icon&quot; href=&quot;/imgs/favicon.ico&quot;&gt;</p>\r\n', 'https://www.youtube.com/embed/h5FebjAMCMk', 'HTML', 0),
(2, 'Animaciones', 'Animaciones CSS2', '<p>Css permite la animaci&oacute;n de elementos HTML sin usar JavaScriptas</p>\r\n', 'https://www.youtube.com/embed/p4HCZYJdzZo', 'CSS', 0),
(4, 'Degradado', 'CSS Degradado', '<p>CSS Degradado</p>\r\n\r\n<p>En esta secci&oacute;n vamos de las formas de degrado</p>\r\n', 'www.youtube.com', 'CSS', 1),
(5, 'Flex-Box', 'Nueva forma de Maquetar La Web', '<p>&lt;div class=&quot;flex-container&gt;</p>\r\n\r\n<p>&lt;div&gt;1&lt;/div&gt;</p>\r\n\r\n<p>&lt;div&gt;2&lt;/div&gt;</p>\r\n\r\n<p>&lt;div&gt;3&lt;/div&gt;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p>&lt;/div&gt;</p>\r\n', 'www.youtube.com', 'CSS', 0),
(7, 'Grid', 'Display grid', '<p>Display grid</p>\r\n', 'www.youtube.com', 'CSS', 0),
(8, 'Posicionamiento', 'Posicionamiento relativos', '<p>Posicionamiento relativos</p>\r\n', 'www.youtube.com', 'CSS', 0),
(9, 'Margin', 'Aplicacion de margenes', '<p>Aplicacion de margenes</p>\r\n', 'www.youtube.com', 'CSS', 0),
(15, 'Listas', 'Listas', '<p>Les permite a los desarrolladores web agrupar un conjunto de elementos relacionados en lista. Cada elemento de la lista comienza con la etiqueta <strong>&lt;li</strong><strong>&gt;</strong></p>\r\n\r\n<p>Lista Desordenada</p>\r\n\r\n<p>Una lista desordenada comienza con la etiqueta <strong>&lt;ul</strong><strong>&gt;</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</p>\r\n\r\n<p>Los elementos de las listas se marcar&aacute;n con vi&ntilde;etas, peque&ntilde;os c&iacute;rculos negros, de forma predeterminada.</p>\r\n\r\n<ul>\r\n	<li>Item 1</li>\r\n	<li>Item 2</li>\r\n	<li>Item 3</li>\r\n	<li>Item 4</li>\r\n</ul>\r\n\r\n<p>Lista Ordenada</p>\r\n\r\n<p>Los elementos de la lista se marcar&aacute;n con n&uacute;meros de forma predeterminada.</p>\r\n\r\n<ol>\r\n	<li>Item&nbsp;</li>\r\n	<li>Item</li>\r\n	<li>Item</li>\r\n	<li>Item</li>\r\n</ol>\r\n\r\n<p>Lista Descriptiva</p>\r\n\r\n<p>La etiqueta <strong>&lt;dl&gt;</strong> define la lista de descripciones, la etiqueta define el t&eacute;rmino (nombre) y la etiqueta describe cada t&eacute;rmino: <strong>&lt;dt&gt; &lt;dd&gt;</strong></p>\r\n\r\n<p>Juan</p>\r\n\r\n<p>Programador Web</p>\r\n\r\n<p>Federico</p>\r\n\r\n<p>Comunicaci&oacute;n</p>\r\n\r\n<p>&nbsp;</p>\r\n', '', 'HTML', 1),
(16, 'Request_Method', 'PHP', '<p>dcasccsadsnodcojociajadjsiojc</p>\r\n\r\n<p>dscadscoidjcoidcsajoijdiocj</p>\r\n\r\n<p>dsciajcdidjoijoidsj</p>\r\n\r\n<p>dscodscjiajadsc</p>\r\n', '', 'PHP', 1),
(17, 'Select', 'SQL', '<p>dkcaopciocicdiccidovaa dscsuhcahudhc</p>\r\n\r\n<p>cpaudschpiuchdudacipuhhudp adsc</p>\r\n\r\n<p>adcsichpdcpchuchpuhdcp u</p>\r\n', '', 'SQL', 0),
(18, 'Condicionales If', 'Condicionales If', '<p>diushaiuodhudscdhsuhc iuhuidasc</p>\r\n\r\n<p>dsuihcdp auichpudsh uhcpasuic&nbsp;</p>\r\n\r\n<p>acid pioc aohcsdds</p>\r\n', '', 'JS', 0),
(19, 'asdada', NULL, '<p>asddadadad</p>\r\n', 'dasdasdasda', 'dsadasd', 0),
(21, 'Introducción', 'Introducción a Figma', '<p>casc dascadc ca coic acim dsocma icmaomjc omai cm cdm cmaios cmas cdoimcd mac mc omicdomicdasoim cdasmi cdasm imcd moic mcdsami dmscmcdosa mcds mcds oimjcdsmi cdoasm cmcdm m cdmas mcdas oim cdm cdmais oicds</p>\r\n', '7BufKLx9LGs', 'Figma', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares`
--

CREATE TABLE `lugares` (
  `idLugar` int(11) NOT NULL,
  `lugar` varchar(250) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `lugares`
--

INSERT INTO `lugares` (`idLugar`, `lugar`) VALUES
(2, 'Atlantida'),
(3, 'Punta del este'),
(4, 'San Fransisco'),
(5, 'Sin Definir');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `musica`
--

CREATE TABLE `musica` (
  `idMusica` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `portada` varchar(300) DEFAULT NULL,
  `urlLista` varchar(300) NOT NULL,
  `idGenero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `musica`
--

INSERT INTO `musica` (`idMusica`, `titulo`, `descripcion`, `portada`, `urlLista`, `idGenero`) VALUES
(2, 'Reggaeton 2010-2020', 'Lo mejor del reggaeton', '', 'https://open.spotify.com/embed/playlist/6ruFRFEiZ4XFr5FL0qfYbw?utm_source=generator&theme=0', 3),
(3, 'Lista nº 2 70s  ', 'sdfsdfsdfsfs', '', 'https://open.spotify.com/embed/playlist/5kxlS9r8Wy05Z9V8SQShll?utm_source=generator', 2),
(4, 'Lo mejor de los 80s', 'asdasdasd', '', 'https://open.spotify.com/embed/playlist/5bkX7o9ridTZm4gDXOHnci?utm_source=generator', 2),
(5, 'Lo mejor de los 90s', 'asdasd', '', 'https://open.spotify.com/embed/playlist/7fvyxo3E5tqLaDA5n3c9PR?utm_source=generator', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `idReceta` int(11) NOT NULL,
  `titulo` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `ingredientes` text COLLATE utf8_spanish2_ci NOT NULL,
  `preparacion` text COLLATE utf8_spanish2_ci NOT NULL,
  `portada` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `urlVideo` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `fechaPublicacion` date NOT NULL,
  `idCategoriaReceta` int(11) NOT NULL,
  `idAutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`idReceta`, `titulo`, `descripcion`, `ingredientes`, `preparacion`, `portada`, `urlVideo`, `fechaPublicacion`, `idCategoriaReceta`, `idAutor`) VALUES
(1, 'Alfajor de Maisena', 'Alfajor Casero de Maisena', '', '', 'alfajor.webp', '', '2023-07-21', 2, 1),
(2, 'Alfajor de Maisena', 'Alfajores de maisena', '<p>200 g de harina</p>\r\n\r\n<p>4 huevos</p>\r\n\r\n<p>100 g de manteca</p>\r\n\r\n<p>1 cucharadita de polvo de hornear</p>\r\n\r\n<p>1/2 cucharadita de sal</p>\r\n', '<p>1 Precalentar el horno a 180&ordm;</p>\r\n\r\n<p>2 En un bol grande, batir 3 huevos</p>\r\n\r\n<p>3 Precalentar el horno a 180&ordm;</p>\r\n\r\n<p>4 En un bol grande, batir 3 huevos</p>\r\n\r\n<p>5 Precalentar el horno a 180&ordm;</p>\r\n\r\n<p>6 En un bol grande, batir 3 huevos</p>\r\n', 'alfajor.webp', '', '2023-07-21', 2, 1),
(3, 'Alfajor de Maisena', 'asdadasdad', '<p>asdasdasdasd</p>\r\n', '<p>asdasdasdasdasd</p>\r\n', 'alfajor.webp', '', '2023-07-21', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas_carrousel`
--

CREATE TABLE `recetas_carrousel` (
  `idImagenReceta` int(11) NOT NULL,
  `img_receta` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `idReceta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `recetas_carrousel`
--

INSERT INTO `recetas_carrousel` (`idImagenReceta`, `img_receta`, `idReceta`) VALUES
(1, 'alfajor.webp', 3),
(2, 'css3-alt.svg', 3),
(3, 'square-js.svg', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `correo` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `lostPassword` varchar(300) NOT NULL,
  `rol` varchar(100) NOT NULL,
  `notificacion` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `apellido`, `correo`, `password`, `avatar`, `telefono`, `lostPassword`, `rol`, `notificacion`) VALUES
(1, 'Juan Matías', 'Besio', 'matiasbesio@hotmail.com', '12345678', 'cv23_3.jpg', '094799908', '', 'admin', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `idViaje` int(11) NOT NULL,
  `viaje` varchar(250) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`idViaje`, `viaje`) VALUES
(1, 'Disney World'),
(2, 'Playa del carmen'),
(3, 'Sin definir');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE `videos` (
  `idVideo` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `portada` varchar(300) NOT NULL,
  `url` varchar(300) NOT NULL,
  `idCategoriaVideo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `videos`
--

INSERT INTO `videos` (`idVideo`, `titulo`, `descripcion`, `portada`, `url`, `idCategoriaVideo`) VALUES
(2, 'Oscar 2023', 'Oscar 2023', '', 'cTgWOazu41c', 1),
(4, 'Nueva York 4', 'Nueva York 4', '', 'rvIA8dVAwCo', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `categorias_recetas`
--
ALTER TABLE `categorias_recetas`
  ADD PRIMARY KEY (`idCategoriaReceta`);

--
-- Indices de la tabla `categoria_imagen`
--
ALTER TABLE `categoria_imagen`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `categoria_videos`
--
ALTER TABLE `categoria_videos`
  ADD PRIMARY KEY (`idCategoriaVideo`);

--
-- Indices de la tabla `codigo_ejemplo`
--
ALTER TABLE `codigo_ejemplo`
  ADD PRIMARY KEY (`idCodigoEjemplo`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`idContacto`);

--
-- Indices de la tabla `detalle_categoria_leccion`
--
ALTER TABLE `detalle_categoria_leccion`
  ADD PRIMARY KEY (`idDetalle`),
  ADD KEY `fk_leccion` (`idLeccion`),
  ADD KEY `fk_categoria` (`idCategoria`);

--
-- Indices de la tabla `genero_musica`
--
ALTER TABLE `genero_musica`
  ADD PRIMARY KEY (`idGenero`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`idImagen`),
  ADD KEY `FK_lugar` (`idLugar`),
  ADD KEY `FK_viaje` (`idViaje`);

--
-- Indices de la tabla `lecciones`
--
ALTER TABLE `lecciones`
  ADD PRIMARY KEY (`idLeccion`);

--
-- Indices de la tabla `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`idLugar`);

--
-- Indices de la tabla `musica`
--
ALTER TABLE `musica`
  ADD PRIMARY KEY (`idMusica`),
  ADD KEY `fk_genero` (`idGenero`);

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`idReceta`),
  ADD KEY `fk_categoria_receta` (`idCategoriaReceta`),
  ADD KEY `fk_autor_receta` (`idAutor`);

--
-- Indices de la tabla `recetas_carrousel`
--
ALTER TABLE `recetas_carrousel`
  ADD PRIMARY KEY (`idImagenReceta`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`idViaje`);

--
-- Indices de la tabla `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`idVideo`),
  ADD KEY `fk_categoriaVideos` (`idCategoriaVideo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `categorias_recetas`
--
ALTER TABLE `categorias_recetas`
  MODIFY `idCategoriaReceta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoria_imagen`
--
ALTER TABLE `categoria_imagen`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria_videos`
--
ALTER TABLE `categoria_videos`
  MODIFY `idCategoriaVideo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `codigo_ejemplo`
--
ALTER TABLE `codigo_ejemplo`
  MODIFY `idCodigoEjemplo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `idContacto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_categoria_leccion`
--
ALTER TABLE `detalle_categoria_leccion`
  MODIFY `idDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de la tabla `genero_musica`
--
ALTER TABLE `genero_musica`
  MODIFY `idGenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `idImagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT de la tabla `lecciones`
--
ALTER TABLE `lecciones`
  MODIFY `idLeccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `lugares`
--
ALTER TABLE `lugares`
  MODIFY `idLugar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `musica`
--
ALTER TABLE `musica`
  MODIFY `idMusica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `idReceta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `recetas_carrousel`
--
ALTER TABLE `recetas_carrousel`
  MODIFY `idImagenReceta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `idViaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `videos`
--
ALTER TABLE `videos`
  MODIFY `idVideo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_categoria_leccion`
--
ALTER TABLE `detalle_categoria_leccion`
  ADD CONSTRAINT `relacion_detalleC_leccion` FOREIGN KEY (`idLeccion`) REFERENCES `lecciones` (`idLeccion`),
  ADD CONSTRAINT `relacon_detalleC_categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`);

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `relacion_imagen_lugar` FOREIGN KEY (`idLugar`) REFERENCES `lugares` (`idLugar`),
  ADD CONSTRAINT `relacion_imagen_viaje` FOREIGN KEY (`idViaje`) REFERENCES `viajes` (`idViaje`);

--
-- Filtros para la tabla `musica`
--
ALTER TABLE `musica`
  ADD CONSTRAINT `relacion_musica_genero` FOREIGN KEY (`idGenero`) REFERENCES `genero_musica` (`idGenero`);

--
-- Filtros para la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD CONSTRAINT `relacion_autor_receta` FOREIGN KEY (`idAutor`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `relacion_categoria_receta` FOREIGN KEY (`idCategoriaReceta`) REFERENCES `categorias_recetas` (`idCategoriaReceta`);

--
-- Filtros para la tabla `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `relacion_video_categoria` FOREIGN KEY (`idCategoriaVideo`) REFERENCES `categoria_videos` (`idCategoriaVideo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
