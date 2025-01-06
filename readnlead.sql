-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 06 jan. 2025 à 20:52
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `readnlead`
--

-- --------------------------------------------------------

--
-- Structure de la table `gusers`
--

CREATE TABLE `gusers` (
  `google_Id` varchar(255) NOT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `userEmail` varchar(255) NOT NULL,
  `verified_email` tinyint(1) DEFAULT NULL,
  `userPicture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `gusers`
--

INSERT INTO `gusers` (`google_Id`, `userName`, `userEmail`, `verified_email`, `userPicture`) VALUES
('117248936678629591081', 'Mouhamadou lamine', 'kanemouhamadoulamine50@gmail.com', 1, 'https://lh3.googleusercontent.com/a/ACg8ocLpOsfbS3JXTpN1ftxOzjdnVLU_Nvqx-fsxkpRiJsGfWdqIrqwK=s96-c'),
('101498473119858643914', 'Isaac', 'issakha62@gmail.com', 1, 'https://lh3.googleusercontent.com/a/ACg8ocLSj04AByzlCwMK1yCsQwIrT5EXGuZhRLbcAaqcjdibr0BNZjIt=s96-c');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
