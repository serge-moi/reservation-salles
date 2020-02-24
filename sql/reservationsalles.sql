-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 23 fév. 2020 à 23:47
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `reservationsalles`
--

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `debut` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Tronquer la table avant d'insérer `reservations`
--

TRUNCATE TABLE `reservations`;
--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `titre`, `description`, `debut`, `fin`, `id_utilisateur`) VALUES
(26, 'JO', 'JIJ', '2020-02-24 09:00:00', '2020-02-24 10:00:00', 2),
(27, 'coucou', '', '2020-02-24 10:00:00', '2020-02-24 11:00:00', 2),
(17, 'Mario Bros', 'pour 3 personnes', '2020-02-26 17:00:00', '2020-02-26 18:00:00', 3),
(28, 'test', 'reservation', '2020-02-24 14:00:00', '2020-02-24 15:00:00', 2),
(7, 'coucou', 'nico', '2020-02-27 08:00:00', '2020-02-27 09:00:00', 2),
(20, 'je reserve', 'oh oui oui', '2020-02-25 12:00:00', '2020-02-25 13:00:00', 2),
(23, 'test', 'test', '2020-02-24 08:00:00', '2020-02-24 09:00:00', 2),
(11, 'Diner', 'diner pour trois personnes', '2020-02-20 08:00:00', '2020-02-20 09:00:00', 2),
(22, 'on s&#39;en fou', 'ok', '2020-02-21 15:00:00', '2020-02-21 16:00:00', 2),
(13, 'Bonjour', 'bonjour', '2020-02-23 10:00:00', '2020-02-23 11:00:00', 2),
(19, 'Je veux jouer jouer', 'viens jouer jouer', '2020-02-21 13:00:00', '2020-02-21 14:00:00', 4),
(18, 'Je veux jouer jouer', 'viens jouer jouer', '2020-02-22 11:00:00', '2020-02-22 12:00:00', 4);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Tronquer la table avant d'insérer `utilisateurs`
--

TRUNCATE TABLE `utilisateurs`;
--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(1, 'paul13', '$2y$10$1l.sXxZLpMTaRG00uQ7YsOajzN2ig4AugKd3tzwt0R7aYQGjus1aC'),
(2, 'sozar', '$2y$10$1FmJs2kH0XekT3piUYmAiuhbZdCDq/UT9CDFPOhzDaufelEY.nuAK'),
(3, 'justine', '$2y$10$3G.kIbIny6xyqfoBjRg7BeY6KjB0uer4lP3bf/pB3EUQpZq.QOI/m'),
(4, 'alexis', '$2y$10$ZdALDSCwnzuBJ3urhiQJGOWwAbbf7br6fgsC7H8AFneTV2H1V208q'),
(5, 'jojo', '$2y$10$lL0LahtiNcspQLPGIVHLOuH5DoZ0/q2tszifwAqoRJOC.1/E2ZTIq'),
(6, 'gilbert', '$2y$10$fkzrWiHkew4aZasA.T1MZuBkMNGMJiHD8UwuJYEZ5oN.ekF7gAVse');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
