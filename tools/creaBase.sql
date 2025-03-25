SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `basededades` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

CREATE USER 'usuari'@'localhost' IDENTIFIED by 'password';
GRANT USAGE ON *.* TO 'usuari'@'localhost';

GRANT ALL PRIVILEGES ON `basededades`.* TO 'usuari'@'localhost' WITH GRANT OPTION;

USE `basededades`;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2024 a las 18:39:43
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

ALTER TABLE Artista ADD COLUMN imatge_url VARCHAR(255) NULL;
UPDATE Artista SET imatge_url = 'images/imatgeArtistes/artista_1.jpg' WHERE id_artista = 1;
UPDATE Artista SET imatge_url = 'images/imatgeArtistes/artista_2.jpg' WHERE id_artista = 2;
UPDATE Artista SET imatge_url = 'images/imatgeArtistes/artista_3.jpg' WHERE id_artista = 3;
UPDATE Artista SET imatge_url = 'images/imatgeArtistes/artista_4.jpg' WHERE id_artista = 4;

UPDATE Artista
SET imatge_url = CONCAT('images/imatgeArtistes/artista_', id_artista, '.jpg')
WHERE imatge_url IS NULL;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `basededades`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artista`
--

CREATE TABLE `artista` (
  `id_artista` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `hora_inici` time NOT NULL,
  `hora_fi` time NOT NULL,
  `id_tipus` int(11) DEFAULT NULL,
  `nom_espai` varchar(100) NOT NULL,
  `imatge_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `artista`
--

INSERT INTO `artista` (`id_artista`, `nom`, `hora_inici`, `hora_fi`, `id_tipus`, `nom_espai`, `imatge_url`) VALUES
(1, 'Amygdala', '18:00:00', '19:00:00', 1, 'Vibra Stage', 'images/imatgeArtistes/artista_1.jpg'),
(2, 'Dj Pastis', '19:30:00', '20:30:00', 2, 'No es Ruido', 'images/imatgeArtistes/artista_2.jpg'),
(3, 'Drakukeo', '21:00:00', '22:00:00', 3, 'Ravers Stage', 'images/imatgeArtistes/artista_3.jpg'),
(4, 'FueraDS', '22:30:00', '24:00:00', 4, 'Makina Stage', 'images/imatgeArtistes/artista_4.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concert`
--

CREATE TABLE `concert` (
  `id_Concert` int(11) NOT NULL,
  `data` date NOT NULL,
  `id_artista` int(11) DEFAULT NULL,
  `id_espai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `espai`
--

CREATE TABLE `espai` (
  `id_espai` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `espai`
--

INSERT INTO `espai` (`id_espai`, `nom`) VALUES
(1, 'Vibra Stage'),
(2, 'No es Ruido'),
(3, 'Ravers Stage'),
(4, 'Makina Stage');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipus`
--

CREATE TABLE `tipus` (
  `id_tipus` int(11) NOT NULL,
  `nom_tipus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipus`
--

INSERT INTO `tipus` (`id_tipus`, `nom_tipus`) VALUES
(1, 'Techno'),
(2, 'Hard Techno'),
(3, 'Trap'),
(4, 'Rap');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuari`
--

CREATE TABLE `usuari` (
  `id` int(11) NOT NULL,
  `usuari` varchar(50) NOT NULL,
  `contrasenya` varchar(200) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuari`
--

INSERT INTO `usuari` (`id`, `usuari`, `contrasenya`, `Nom`, `admin`) VALUES
(1, 'admin', 'gritofestival', 'ADMIN', 1),
(2, 'nil', '1234', 'NIL', 1),
(3, 'alex', '1234', 'ALEX', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `artista`
--
ALTER TABLE `artista`
  ADD PRIMARY KEY (`id_artista`),
  ADD KEY `id_tipus` (`id_tipus`);

--
-- Indices de la tabla `concert`
--
ALTER TABLE `concert`
  ADD PRIMARY KEY (`id_Concert`),
  ADD KEY `id_artista` (`id_artista`),
  ADD KEY `id_espai` (`id_espai`);

--
-- Indices de la tabla `espai`
--
ALTER TABLE `espai`
  ADD PRIMARY KEY (`id_espai`);

--
-- Indices de la tabla `tipus`
--
ALTER TABLE `tipus`
  ADD PRIMARY KEY (`id_tipus`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `artista`
--
ALTER TABLE `artista`
  MODIFY `id_artista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `concert`
--
ALTER TABLE `concert`
  MODIFY `id_Concert` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `espai`
--
ALTER TABLE `espai`
  MODIFY `id_espai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipus`
--
ALTER TABLE `tipus`
  MODIFY `id_tipus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `artista`
--
ALTER TABLE `artista`
  ADD CONSTRAINT `artista_ibfk_1` FOREIGN KEY (`id_tipus`) REFERENCES `tipus` (`id_tipus`);

--
-- Filtros para la tabla `concert`
--
ALTER TABLE `concert`
  ADD CONSTRAINT `concert_ibfk_1` FOREIGN KEY (`id_artista`) REFERENCES `artista` (`id_artista`),
  ADD CONSTRAINT `concert_ibfk_2` FOREIGN KEY (`id_espai`) REFERENCES `espai` (`id_espai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- CREATE TABLE Tipus (
--   id_tipus INT PRIMARY KEY AUTO_INCREMENT,
--   nom_tipus VARCHAR(50) NOT NULL
-- );

-- ALTER TABLE Artista ADD COLUMN imatge_url VARCHAR(255) NULL;
-- UPDATE Artista SET imatge_url = 'images/imatgeArtistes/artista_8.jpg' WHERE id_artista = 8;
-- UPDATE Artista SET imatge_url = 'images/imatgeArtistes/artista_9.jpg' WHERE id_artista = 9;
-- UPDATE Artista SET imatge_url = 'images/imatgeArtistes/artista_10.jpg' WHERE id_artista = 10;
-- UPDATE Artista SET imatge_url = 'images/imatgeArtistes/artista_11.jpg' WHERE id_artista = 11;

-- UPDATE Artista
-- SET imatge_url = CONCAT('images/imatgeArtistes/artista_', id_artista, '.jpg')
-- WHERE imatge_url IS NULL;



-- INSERT INTO Tipus (id_tipus, nom_tipus) VALUES (1, 'Techno');
-- INSERT INTO Tipus (id_tipus, nom_tipus) VALUES (2, 'Hard Techno');
-- INSERT INTO Tipus (id_tipus, nom_tipus) VALUES (3, 'Trap');
-- INSERT INTO Tipus (id_tipus, nom_tipus) VALUES (4, 'Rap');
-- CREATE TABLE Artista (
--   id_artista INT PRIMARY KEY AUTO_INCREMENT,
--   nom VARCHAR(100) NOT NULL,
--   hora_inici TIME NOT NULL,
--   hora_fi TIME NOT NULL,
--   id_tipus INT,
--   FOREIGN KEY (id_tipus) REFERENCES Tipus(id_tipus),
--   nom_espai VARCHAR(100) NOT NULL
-- );

-- INSERT INTO Artista (nom, hora_inici, hora_fi, id_tipus) 
-- VALUES ('Amygdala', '18:00:00', '19:00:00', 1);

-- INSERT INTO Artista (nom, hora_inici, hora_fi, id_tipus) 
-- VALUES ('Dj Pastis', '19:30:00', '20:30:00', 2);

-- INSERT INTO Artista (nom, hora_inici, hora_fi, id_tipus) 
-- VALUES ('Drakukeo', '21:00:00', '22:00:00', 3, )

-- ALTER TABLE Artista ADD COLUMN nom_espai VARCHAR(100);
-- INSERT INTO Artista (nom, hora_inici, hora_fi, id_tipus, nom_espai) VALUES
-- ('Amygdala', '18:00:00', '19:00:00', 1, 'Vibra Stage'),
-- ('Dj Pastis', '19:30:00', '20:30:00', 2, 'No es Ruido'),
-- ('Drakukeo', '21:00:00', '22:00:00', 3, 'Ravers Stage'),
-- ('FueraDS', '22:30:00', '24:00:00', 4, 'Makina Stage');


-- CREATE TABLE Espai (
--   id_espai INT PRIMARY KEY AUTO_INCREMENT,
--   nom VARCHAR(100) NOT NULL,
-- );
-- INSERT INTO Espai (id_espai, nom) VALUES
-- (1, 'Vibra Stage'),
-- (2, 'No es Ruido'),
-- (3, 'Ravers Stage'),
-- (4, 'Makina Stage');
-- CREATE TABLE Concert (
--   id_Concert INT PRIMARY KEY AUTO_INCREMENT,
--   data DATE NOT NULL,
--   id_artista INT,
--   id_espai INT,
--   FOREIGN KEY (id_artista) REFERENCES Artista(id_artista),
--   FOREIGN KEY (id_espai) REFERENCES Espai(id_espai)
-- );


-- -- fem un join perque es mostri id_tipus amb el nom

-- SELECT 
--     Artista.*, 
--     Tipus.nom_tipus
-- FROM 
--     Artista
-- JOIN 
--     Tipus ON Artista.id_tipus = Tipus.id_tipus;
