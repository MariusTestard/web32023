-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 19 Septembre 2023 à 21:46
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
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`idEvent`, `nom`, `departement`, `lieu`, `date`) VALUES
(1, 'sfdg', 'sfg', 'sfdg', '2023-08-30 16:39:00');

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
(1, 0, 0, 0, 0, 0, 0);

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
(2232140, 'qwerty1234', 'Marius', 'Testard', 'marius.testard.01@edu.cegeptr.qc.ca'),
(2232141, 'c6c4940b323ff81c66e02a02e0281c370c535008', 'Gabriel', 'Poisson', 'tehtar4857@gmail.com');

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
  MODIFY `idEvent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `satisfaction`
--
ALTER TABLE `satisfaction`
  MODIFY `idSatisfaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
