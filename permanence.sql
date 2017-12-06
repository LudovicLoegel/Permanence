-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 06 Décembre 2017 à 11:03
-- Version du serveur :  5.7.20-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `permanence`
--

-- --------------------------------------------------------

--
-- Structure de la table `activities`
--

CREATE TABLE `activities` (
  `date` date NOT NULL,
  `id_user1` int(11) NOT NULL,
  `id_user2` int(11) NOT NULL,
  `id_project` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `activities`
--

INSERT INTO `activities` (`date`, `id_user1`, `id_user2`, `id_project`) VALUES
('2017-12-06', 14, 12, 1),
('2017-12-06', 11, 1, 2),
('2017-12-06', 16, 8, 3),
('2017-12-06', 10, 6, 4),
('2017-12-06', 3, 5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `attendances`
--

CREATE TABLE `attendances` (
  `id_project` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `attendances`
--

INSERT INTO `attendances` (`id_project`, `id_user`, `count`) VALUES
(1, 1, 0),
(1, 2, 0),
(1, 3, 0),
(1, 4, 0),
(1, 5, 0),
(1, 6, 0),
(1, 7, 0),
(1, 8, 0),
(1, 9, 0),
(1, 10, 0),
(1, 11, 0),
(1, 12, 1),
(1, 13, 0),
(1, 14, 1),
(1, 15, 0),
(1, 16, 0),
(1, 17, 0),
(2, 1, 1),
(2, 2, 0),
(2, 3, 0),
(2, 4, 0),
(2, 5, 0),
(2, 6, 0),
(2, 7, 0),
(2, 8, 0),
(2, 9, 0),
(2, 10, 0),
(2, 11, 1),
(2, 12, 0),
(2, 13, 0),
(2, 14, 0),
(2, 15, 0),
(2, 16, 0),
(2, 17, 0),
(3, 1, 0),
(3, 2, 0),
(3, 3, 0),
(3, 4, 0),
(3, 5, 0),
(3, 6, 0),
(3, 7, 0),
(3, 8, 1),
(3, 9, 0),
(3, 10, 0),
(3, 11, 0),
(3, 12, 0),
(3, 13, 0),
(3, 14, 0),
(3, 15, 0),
(3, 16, 1),
(3, 17, 0),
(4, 1, 0),
(4, 2, 0),
(4, 3, 0),
(4, 4, 0),
(4, 5, 0),
(4, 6, 1),
(4, 7, 0),
(4, 8, 0),
(4, 9, 0),
(4, 10, 1),
(4, 11, 0),
(4, 12, 0),
(4, 13, 0),
(4, 14, 0),
(4, 15, 0),
(4, 16, 0),
(4, 17, 0),
(5, 1, 0),
(5, 2, 0),
(5, 3, 1),
(5, 4, 0),
(5, 5, 1),
(5, 6, 0),
(5, 7, 0),
(5, 8, 0),
(5, 9, 0),
(5, 10, 0),
(5, 11, 0),
(5, 12, 0),
(5, 13, 0),
(5, 14, 0),
(5, 15, 0),
(5, 16, 0),
(5, 17, 0);

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `projects`
--

INSERT INTO `projects` (`id`, `name`) VALUES
(1, 'Monyck'),
(2, 'Immo'),
(3, 'Paturon'),
(4, 'Li-mithra'),
(5, 'Ménage');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`) VALUES
(1, 'Samir'),
(2, 'Ludovic'),
(3, 'Christopher'),
(4, 'Aymeric'),
(5, 'Charline'),
(6, 'Justine'),
(7, 'Laurence'),
(8, 'Théo'),
(9, 'Salima'),
(10, 'Céline'),
(11, 'Michael'),
(12, 'Romain'),
(13, 'Fares'),
(14, 'Alexandre'),
(15, 'Yann'),
(16, 'Corentin'),
(17, 'Eric');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`date`,`id_project`);

--
-- Index pour la table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id_project`,`id_user`);

--
-- Index pour la table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
