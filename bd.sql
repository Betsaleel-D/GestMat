-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 03 mai 2020 à 17:24
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestionmateriels`
--

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `id_demande` int(11) NOT NULL AUTO_INCREMENT,
  `id_employe_d` int(11) NOT NULL,
  `id_materiel_d` int(11) NOT NULL,
  `quantite_cmd` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `date_cmd` date NOT NULL,
  `niveau` varchar(255) NOT NULL,
  PRIMARY KEY (`id_demande`),
  KEY `id_employe_d` (`id_employe_d`),
  KEY `id_materiel_d` (`id_materiel_d`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`id_demande`, `id_employe_d`, `id_materiel_d`, `quantite_cmd`, `commentaire`, `date_cmd`, `niveau`) VALUES
(1, 2, 1, 5, 'FFF', '2020-04-12', 'Commande validée'),
(2, 2, 1, 45, 'Je veux un clé', '2020-04-12', 'Commande validée'),
(3, 2, 1, 45, 'Je veux un clé', '2020-04-12', 'Commande validée'),
(4, 2, 2, 4, 'qqqqqqqqqqqqqqqqqqqqq', '2020-04-12', 'Commande validée'),
(5, 2, 2, 17, 'Cle', '2020-04-12', 'Commande validée'),
(6, 2, 4, 6, 'dddddd', '2020-04-13', 'Commande validée'),
(7, 2, 1, 122, 'deo', '2020-04-13', 'Commande validée'),
(8, 2, 1, 50, 'autrrrrrrrrrrrrrr', '2020-04-13', 'Commande validée'),
(9, 3, 2, 50, 'gdgdgd', '2020-04-13', 'En cours');

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

DROP TABLE IF EXISTS `employe`;
CREATE TABLE IF NOT EXISTS `employe` (
  `id_employe` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_service_empl` int(11) NOT NULL,
  `accreditation` int(11) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`id_employe`),
  KEY `employe_ibfk_1` (`id_service_empl`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`id_employe`, `nom`, `prenom`, `email`, `id_service_empl`, `accreditation`, `pass`) VALUES
(1, 'DOUDOU', 'Doun', 'doudou@gmail.com', 1, 2, 'deo'),
(2, 'YEKPON', 'Deo-Gracias', 'deogchrist@gmail.com', 1, 2, '$2y$10$hpab..pZZ/WMm6w0cMCuF.u1GK0c9tsfxyR/xta6f5DJeP6ydVLcW'),
(3, 'YEKPON', 'Rock', 'rock@gmail.com', 1, 1, '$2y$10$FQBa6Gg2aP8AjGyyt5beVOC2uyxk1AQ/ZMaN5KNyIWB/KmPvEpkbK'),
(4, 'ROUGO', 'Bouna', 'bngd@hhd.gfhg', 1, 1, '$2y$10$Z5Y0jqJE9hdqS.dpCjhOQuyAADHsOMcdYC/VYR1WvoRy8LMCsGspG');

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

DROP TABLE IF EXISTS `materiel`;
CREATE TABLE IF NOT EXISTS `materiel` (
  `id_materiel` int(11) NOT NULL AUTO_INCREMENT,
  `lib_materiel` varchar(255) NOT NULL,
  `quantite_stocks` int(11) NOT NULL,
  PRIMARY KEY (`id_materiel`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`id_materiel`, `lib_materiel`, `quantite_stocks`) VALUES
(1, 'Disque dur', 50),
(2, 'Clé USB', 35),
(4, 'Sourie sans Fil', 96),
(5, 'Sourie  ', 54);

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

DROP TABLE IF EXISTS `messagerie`;
CREATE TABLE IF NOT EXISTS `messagerie` (
  `id_messagerie` int(11) NOT NULL AUTO_INCREMENT,
  `id_chef_service` int(11) NOT NULL,
  `id_employe_se` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_message` date NOT NULL,
  PRIMARY KEY (`id_messagerie`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id_service` int(11) NOT NULL AUTO_INCREMENT,
  `lib_service` varchar(255) NOT NULL,
  `sigle` varchar(10) NOT NULL,
  PRIMARY KEY (`id_service`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id_service`, `lib_service`, `sigle`) VALUES
(1, 'Service d\'Approvisionnement', 'SA'),
(2, 'Service d’exécution', 'SE');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`id_employe_d`) REFERENCES `employe` (`id_employe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `demande_ibfk_2` FOREIGN KEY (`id_materiel_d`) REFERENCES `materiel` (`id_materiel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `employe_ibfk_1` FOREIGN KEY (`id_service_empl`) REFERENCES `services` (`id_service`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
