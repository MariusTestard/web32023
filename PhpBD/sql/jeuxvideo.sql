-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 29 Août 2023 à 21:28
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `phpbd`
--

-- --------------------------------------------------------

--
-- Structure de la table `jeuxvideo`
--

CREATE TABLE `jeuxvideo` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `type` varchar(100) NOT NULL,
  `dateSortie` date NOT NULL,
  `url` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Contenu de la table `jeuxvideo`
--

INSERT INTO `jeuxvideo` (`id`, `nom`, `type`, `dateSortie`, `url`) VALUES
(1, 'Minecraft', 'Bac à sable/Survie', '2011-04-22', 'https://imgx.toplitic.com/itemu/sykz0a6i.webp?w=900&h=900&x=450&y=0&res=150'),
(2, 'Grand Theft Auto V', 'Action-aventure en monde ouvert', '2013-08-09', 'https://imgx.toplitic.com/itemu/i7qlo96g.webp?w=1280&h=1280&x=320&y=0&res=150'),
(3, 'Rocket League', 'Compétitif/Multijoueur', '2015-04-05', 'https://imgx.toplitic.com/itemu/iw5ugoz9.webp?w=1080&h=1080&x=420&y=0&res=150'),
(4, 'Super Smash Bros. Ultimate', 'Compétitif/Multijoueur', '2018-11-15', 'https://imgx.toplitic.com/itemu/q62zxk8j.webp?w=2894&h=2894&x=0&y=896&res=150');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `jeuxvideo`
--
ALTER TABLE `jeuxvideo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `jeuxvideo`
--
ALTER TABLE `jeuxvideo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
