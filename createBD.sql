-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte :  localhost
-- Généré le : lun. 11 juil. 2022 à 10:47
-- Version du serveur :  5.7.33-0ubuntu0.18.04.1-log
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `geocaching`
--

-- --------------------------------------------------------

--
-- Structure de la table `geo_cache`
--

CREATE TABLE `geo_cache` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `team_assignment` enum('A','B','AB') NOT NULL,
  `theme` enum('optim','climat','naturals_areas') NOT NULL,
  `resp1` varchar(255) NOT NULL,
  `resp2` varchar(255) NOT NULL,
  `resp3` varchar(255) NOT NULL,
  `good_resp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Index pour la table `geo_cache`
--
ALTER TABLE `geo_cache`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `geo_cache`
--
ALTER TABLE `geo_cache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `teamName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `team_assignment` varchar(1) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `points` int(3) NOT NULL DEFAULT '0',
  `answered_questions` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
