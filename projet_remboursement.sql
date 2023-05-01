-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 01 mai 2023 à 20:28
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_remboursement`
--

-- --------------------------------------------------------

--
-- Structure de la table `frais_forfait`
--

CREATE TABLE `frais_forfait` (
  `id_frais` int(11) NOT NULL,
  `repas_midi` int(11) NOT NULL DEFAULT 0,
  `nuitee` int(11) NOT NULL DEFAULT 0,
  `km` int(11) NOT NULL DEFAULT 0,
  `date` date DEFAULT NULL,
  `fk_user` int(11) NOT NULL,
  `verification` varchar(11) NOT NULL DEFAULT 'non'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `frais_forfait`
--

INSERT INTO `frais_forfait` (`id_frais`, `repas_midi`, `nuitee`, `km`, `date`, `fk_user`, `verification`) VALUES
(2, 11, 12, 300, '2023-04-12', 1, 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `frais_hors_forfait`
--

CREATE TABLE `frais_hors_forfait` (
  `id_frais2` int(11) NOT NULL,
  `libelle` varchar(45) NOT NULL,
  `montant` int(11) NOT NULL,
  `date_hors_forfait` date NOT NULL,
  `fk_utilisateur` int(11) NOT NULL,
  `verif` varchar(45) NOT NULL DEFAULT 'non'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `frais_hors_forfait`
--

INSERT INTO `frais_hors_forfait` (`id_frais2`, `libelle`, `montant`, `date_hors_forfait`, `fk_utilisateur`, `verif`) VALUES
(1, 'Karting', 12, '2023-04-12', 1, 'oui'),
(2, 'Musée', 9, '2023-04-13', 1, 'non'),
(7, 'Shopping', 70, '2023-04-30', 1, 'non');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `mdp` varchar(256) NOT NULL,
  `rang` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `mail`, `mdp`, `rang`) VALUES
(1, 'Drozdz', 'Maxence', 'maxence.drozdz@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 2),
(2, 'Drozdz', 'Lauréanne', 'laureanne.drozdz@gmail.com', 'fe2592b42a727e977f055947385b709cc82b16b9a87f88c6abf3900d65d0cdc3', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `frais_forfait`
--
ALTER TABLE `frais_forfait`
  ADD PRIMARY KEY (`id_frais`),
  ADD KEY `frais_forfait` (`fk_user`);

--
-- Index pour la table `frais_hors_forfait`
--
ALTER TABLE `frais_hors_forfait`
  ADD PRIMARY KEY (`id_frais2`),
  ADD KEY `frais_hors_forfait` (`fk_utilisateur`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `frais_forfait`
--
ALTER TABLE `frais_forfait`
  MODIFY `id_frais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `frais_hors_forfait`
--
ALTER TABLE `frais_hors_forfait`
  MODIFY `id_frais2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `frais_forfait`
--
ALTER TABLE `frais_forfait`
  ADD CONSTRAINT `frais_forfait` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `frais_hors_forfait`
--
ALTER TABLE `frais_hors_forfait`
  ADD CONSTRAINT `frais_hors_forfait` FOREIGN KEY (`fk_utilisateur`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
