-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 29 Septembre 2023 à 14:40
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `smileyface`
--

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `idEvent` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `departement` varchar(100) NOT NULL,
  `lieu` varchar(1024) NOT NULL,
  `date` datetime NOT NULL,
  `Etat` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`idEvent`, `nom`, `departement`, `lieu`, `date`, `Etat`) VALUES
(1, 'Aucun', 'Aucun', 'Aucun', '0001-01-01 00:00:00', 0),
(2, 'Test10', 'Test100', 'Test10', '2023-12-16 00:00:00', 0),
(3, 'Test11', 'Test11', 'Test11', '2023-09-27 00:00:00', 1),
(4, 'Test12', 'Test12', 'Test12', '2023-09-20 00:00:00', 0),
(5, 'Test13', 'Test13', 'Test13', '2023-08-30 00:00:00', 0),
(6, 'Test14', 'Test14', 'Test14', '2023-09-19 00:00:00', 0),
(7, 'Test15', 'Test15', 'Test15', '2023-09-20 00:00:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `satisfaction`
--

CREATE TABLE `satisfaction` (
  `idSatisfaction` int(11) NOT NULL,
  `highEtu` int(11) NOT NULL,
  `midEtu` int(11) NOT NULL,
  `lowEtu` int(11) NOT NULL,
  `highEmplo` int(11) NOT NULL,
  `midEmplo` int(11) NOT NULL,
  `lowEmplo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Contenu de la table `satisfaction`
--

INSERT INTO `satisfaction` (`idSatisfaction`, `highEtu`, `midEtu`, `lowEtu`, `highEmplo`, `midEmplo`, `lowEmplo`) VALUES
(1, 99, 99, 99, 99, 99, 99),
(2, 0, 0, 0, 0, 0, 0),
(3, 5, 1, 1, 2, 2, 3),
(4, 0, 0, 0, 0, 0, 0),
(5, 0, 0, 0, 0, 0, 0),
(6, 0, 0, 0, 0, 0, 0),
(7, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `numEmploye` int(11) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `recoverEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`numEmploye`, `password`, `prenom`, `nom`, `recoverEmail`) VALUES
(1, '356a192b7913b04c54574d18c28d46e6395428ab', 'Test', 'Test', 'test@testemail.com'),
(2, '2', '', '', 'asdf'),
(1865294, 'c23d9df5e16d53fd23a0c6fd694b350aac09f8cf', 'Gabryel', 'Poisson', 'gabryel.poisson.01@edu.cegeptr.qc.ca');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`idEvent`);

--
-- Index pour la table `satisfaction`
--
ALTER TABLE `satisfaction`
  ADD PRIMARY KEY (`idSatisfaction`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`numEmploye`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `idEvent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `satisfaction`
--
ALTER TABLE `satisfaction`
  MODIFY `idSatisfaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `satisfaction`
--
ALTER TABLE `satisfaction`
  ADD CONSTRAINT `satisfaction_ibfk_1` FOREIGN KEY (`idSatisfaction`) REFERENCES `event` (`idEvent`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
