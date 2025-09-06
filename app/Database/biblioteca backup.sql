-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 06, 2025 at 08:12 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteca`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `idcategoria` int NOT NULL,
  `categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`idcategoria`, `categoria`) VALUES
(1, 'Matemáticas'),
(2, 'Comunicación'),
(3, 'Computación');

-- --------------------------------------------------------

--
-- Table structure for table `departamentos`
--

CREATE TABLE `departamentos` (
  `iddepartamento` int NOT NULL,
  `departamento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `distritos`
--

CREATE TABLE `distritos` (
  `iddistrito` int NOT NULL,
  `distrito` varchar(100) NOT NULL,
  `idprovincia` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `editoriales`
--

CREATE TABLE `editoriales` (
  `ideditorial` int NOT NULL,
  `editorial` varchar(150) NOT NULL,
  `nacionalidad` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `editoriales`
--

INSERT INTO `editoriales` (`ideditorial`, `editorial`, `nacionalidad`) VALUES
(1, 'Editorial Santillana', 'España'),
(2, 'McGraw-Hill', 'Estados Unidos'),
(3, 'Pearson Educación', 'Reino Unido'),
(4, 'Editorial Norma', 'Colombia');

-- --------------------------------------------------------

--
-- Table structure for table `libros`
--

CREATE TABLE `libros` (
  `id` int NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `libros`
--

INSERT INTO `libros` (`id`, `nombre`, `imagen`) VALUES
(1, 'matematica', '1757134596_e7670b2d4a338e007fb5.png');

-- --------------------------------------------------------

--
-- Stand-in structure for view `mostrar_recursos`
-- (See below for the actual view)
--
CREATE TABLE `mostrar_recursos` (
`idrecurso` int
,`tipo` enum('FÍsico','Digital')
,`titulo` varchar(255)
,`apublicacion` char(4)
,`isbn` varchar(20)
,`numpaginas` int
,`rutaportada` varchar(255)
,`rutarecurso` varchar(255)
,`estado` enum('Bueno','Regular','Malo')
,`creado` datetime
,`idcategoria` int
,`categoria` varchar(100)
,`idsubcategoria` int
,`subcategoria` varchar(100)
,`ideditorial` int
,`editorial` varchar(150)
,`nacionalidad` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `personas`
--

CREATE TABLE `personas` (
  `idpersona` int NOT NULL,
  `dni` char(8) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `iddistrito` int NOT NULL,
  `direccion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provincias`
--

CREATE TABLE `provincias` (
  `idprovincia` int NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `iddepartamento` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recursos`
--

CREATE TABLE `recursos` (
  `idrecurso` int NOT NULL,
  `idsubcategoria` int NOT NULL,
  `ideditorial` int NOT NULL,
  `tipo` enum('FÍsico','Digital') NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `apublicacion` char(4) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `numpaginas` int NOT NULL,
  `rutaportada` varchar(255) DEFAULT NULL,
  `rutarecurso` varchar(255) DEFAULT NULL,
  `estado` enum('Bueno','Regular','Malo') NOT NULL,
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
  `modificado` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `recursos`
--

INSERT INTO `recursos` (`idrecurso`, `idsubcategoria`, `ideditorial`, `tipo`, `titulo`, `apublicacion`, `isbn`, `numpaginas`, `rutaportada`, `rutarecurso`, `estado`, `creado`, `modificado`) VALUES
(1, 1, 1, 'FÍsico', 'Razonamiento Matemático I', '2015', '9786071509817', 320, 'img/portadas/razonamiento_matematico.jpg', NULL, 'Bueno', '2025-09-06 00:48:52', '2025-09-05'),
(2, 2, 2, 'FÍsico', 'Álgebra Universitaria', '2018', '9781455775669', 540, 'img/portadas/algebra.jpg', NULL, 'Regular', '2025-09-06 00:48:52', '2025-09-05'),
(3, 3, 3, 'Digital', 'Trigonometría Moderna', '2020', '9780321982384', 410, 'img/portadas/trigonometria.jpg', 'recursos/trigonometria.pdf', 'Bueno', '2025-09-06 00:48:52', '2025-09-05'),
(4, 4, 4, 'FÍsico', 'Razonamiento Verbal Básico', '2016', '9788429403459', 280, 'img/portadas/razonamiento_verbal.jpg', NULL, 'Bueno', '2025-09-06 00:48:52', '2025-09-05'),
(5, 5, 1, 'Digital', 'Manual de Composición', '2019', '9789580000012', 350, 'img/portadas/composicion.jpg', 'recursos/composicion.pdf', 'Bueno', '2025-09-06 00:48:52', '2025-09-05'),
(6, 6, 2, 'FÍsico', 'Guía de Redacción Efectiva', '2021', '9786073243214', 220, 'img/portadas/redaccion.jpg', NULL, 'Malo', '2025-09-06 00:48:52', '2025-09-05'),
(7, 7, 3, 'Digital', 'Fundamentos de Bases de Datos', '2017', '9780133970777', 600, 'img/portadas/basedatos.jpg', 'recursos/bd_fundamentos.pdf', 'Bueno', '2025-09-06 00:48:52', '2025-09-05'),
(8, 8, 2, 'FÍsico', 'Introducción a Sistemas Operativos', '2014', '9780201633467', 480, 'img/portadas/sistemas_operativos.jpg', NULL, 'Regular', '2025-09-06 00:48:52', '2025-09-05'),
(9, 9, 1, 'Digital', 'Lenguajes de Programación Modernos', '2022', '9781492056812', 700, 'img/portadas/programacion.jpg', 'recursos/programacion.pdf', 'Bueno', '2025-09-06 00:48:52', '2025-09-05');

-- --------------------------------------------------------

--
-- Table structure for table `subcategorias`
--

CREATE TABLE `subcategorias` (
  `idsubcategoria` int NOT NULL,
  `subcategoria` varchar(100) NOT NULL,
  `idcategoria` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subcategorias`
--

INSERT INTO `subcategorias` (`idsubcategoria`, `subcategoria`, `idcategoria`) VALUES
(1, 'Razonamiento Lógico Matemático', 1),
(2, 'Álgebra', 1),
(3, 'Trigonometría', 1),
(4, 'Razonamiento verbal', 2),
(5, 'Composición', 2),
(6, 'Redacción', 2),
(7, 'Base de datos', 3),
(8, 'sistemas operativos', 3),
(9, 'lenguajes de programación', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indexes for table `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`iddepartamento`),
  ADD UNIQUE KEY `departamento` (`departamento`);

--
-- Indexes for table `distritos`
--
ALTER TABLE `distritos`
  ADD PRIMARY KEY (`iddistrito`),
  ADD KEY `fk_distrito_provincia` (`idprovincia`);

--
-- Indexes for table `editoriales`
--
ALTER TABLE `editoriales`
  ADD PRIMARY KEY (`ideditorial`);

--
-- Indexes for table `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`idpersona`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD KEY `fk_persona_distrito` (`iddistrito`);

--
-- Indexes for table `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`idprovincia`),
  ADD KEY `fk_provincia_departamento` (`iddepartamento`);

--
-- Indexes for table `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`idrecurso`),
  ADD KEY `fk_recurso_subcategoria` (`idsubcategoria`),
  ADD KEY `fk_recurso_editorial` (`ideditorial`);

--
-- Indexes for table `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`idsubcategoria`),
  ADD KEY `fk_subcategoria_categoria` (`idcategoria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idcategoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `iddepartamento` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `distritos`
--
ALTER TABLE `distritos`
  MODIFY `iddistrito` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `editoriales`
--
ALTER TABLE `editoriales`
  MODIFY `ideditorial` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personas`
--
ALTER TABLE `personas`
  MODIFY `idpersona` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provincias`
--
ALTER TABLE `provincias`
  MODIFY `idprovincia` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recursos`
--
ALTER TABLE `recursos`
  MODIFY `idrecurso` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `idsubcategoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

-- --------------------------------------------------------

--
-- Structure for view `mostrar_recursos`
--
DROP TABLE IF EXISTS `mostrar_recursos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mostrar_recursos`  AS SELECT `re`.`idrecurso` AS `idrecurso`, `re`.`tipo` AS `tipo`, `re`.`titulo` AS `titulo`, `re`.`apublicacion` AS `apublicacion`, `re`.`isbn` AS `isbn`, `re`.`numpaginas` AS `numpaginas`, `re`.`rutaportada` AS `rutaportada`, `re`.`rutarecurso` AS `rutarecurso`, `re`.`estado` AS `estado`, `re`.`creado` AS `creado`, `ca`.`idcategoria` AS `idcategoria`, `ca`.`categoria` AS `categoria`, `sc`.`idsubcategoria` AS `idsubcategoria`, `sc`.`subcategoria` AS `subcategoria`, `ed`.`ideditorial` AS `ideditorial`, `ed`.`editorial` AS `editorial`, `ed`.`nacionalidad` AS `nacionalidad` FROM (((`recursos` `re` join `subcategorias` `sc` on((`sc`.`idsubcategoria` = `re`.`idsubcategoria`))) join `categorias` `ca` on((`ca`.`idcategoria` = `sc`.`idcategoria`))) join `editoriales` `ed` on((`ed`.`ideditorial` = `re`.`ideditorial`))) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `distritos`
--
ALTER TABLE `distritos`
  ADD CONSTRAINT `fk_distrito_provincia` FOREIGN KEY (`idprovincia`) REFERENCES `provincias` (`idprovincia`);

--
-- Constraints for table `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `fk_persona_distrito` FOREIGN KEY (`iddistrito`) REFERENCES `distritos` (`iddistrito`);

--
-- Constraints for table `provincias`
--
ALTER TABLE `provincias`
  ADD CONSTRAINT `fk_provincia_departamento` FOREIGN KEY (`iddepartamento`) REFERENCES `departamentos` (`iddepartamento`);

--
-- Constraints for table `recursos`
--
ALTER TABLE `recursos`
  ADD CONSTRAINT `fk_recurso_editorial` FOREIGN KEY (`ideditorial`) REFERENCES `editoriales` (`ideditorial`),
  ADD CONSTRAINT `fk_recurso_subcategoria` FOREIGN KEY (`idsubcategoria`) REFERENCES `subcategorias` (`idsubcategoria`);

--
-- Constraints for table `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `fk_subcategoria_categoria` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`idcategoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
