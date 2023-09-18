-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 19 juil. 2023 à 11:15
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
-- Base de données : `hopital`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` enum('admin','medecin','patient') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id`, `email`, `mot_de_passe`, `role`) VALUES
(1, 'admin@gmail.com', '12345', 'admin'),
(25, 'lahcen@gmail.com', '123456idir', 'patient'),
(26, 'lahcenidir700@yahoo.com', '123456', 'medecin'),
(28, 'salimhdawi@gmail.com', '123456', 'patient'),
(32, 'rahim@yahoo.com', '123456', 'medecin'),
(38, 'sdhui@yahoo.com', '123456', 'patient'),
(39, 'saad700@yahoo.com', '1234567', 'patient');

-- --------------------------------------------------------

--
-- Structure de la table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `cin` varchar(20) NOT NULL,
  `nom_d` varchar(50) NOT NULL,
  `prenom_d` varchar(50) NOT NULL,
  `specialite` varchar(50) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `date_creation` datetime DEFAULT current_timestamp(),
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `doctor`
--

INSERT INTO `doctor` (`id`, `photo`, `cin`, `nom_d`, `prenom_d`, `specialite`, `telephone`, `date_creation`, `id_user`) VALUES
(8, 'a10.jpg', 'MJ14232', 'fahd', 'samir', 'anesthesie', '0681736149', '2023-05-11 12:49:17', 26),
(9, 'r4.jpg', 'GJ4512', 'rahim', 'saad', 'biologie', '+21268345678', '2023-05-11 21:04:20', 32);

-- --------------------------------------------------------

--
-- Structure de la table `dossiers_medicaux`
--

CREATE TABLE `dossiers_medicaux` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `diagnostic` text NOT NULL,
  `traitement` text NOT NULL,
  `id_patient` int(11) NOT NULL,
  `id_doctor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `dossiers_medicaux`
--

INSERT INTO `dossiers_medicaux` (`id`, `date`, `diagnostic`, `traitement`, `id_patient`, `id_doctor`) VALUES
(11, '2023-01-01', 'bjvgh', 'gvgc', 17, 8);

-- --------------------------------------------------------

--
-- Structure de la table `equipements_medicaux`
--

CREATE TABLE `equipements_medicaux` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `emplacement` varchar(255) DEFAULT NULL,
  `etat` varchar(255) DEFAULT 'en stock',
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `equipements_medicaux`
--

INSERT INTO `equipements_medicaux` (`id`, `nom`, `description`, `emplacement`, `etat`, `photo`) VALUES
(1, 'Lit médicalisé', 'Lit à hauteur variable avec commande électrique', 'Chambre 1', 'En cours de maintenance', 'p.jpg'),
(2, 'Défibrillateur', 'Appareil permettant la défibrillation et la stimulation cardiaque externe', 'Salle de soins intensifs', 'Hors service', 'p2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

CREATE TABLE `factures` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `date_facture` date NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `statut` enum('payé','en attente','annulé') NOT NULL,
  `assurance` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `factures` (`id`, `patient_id`, `date_facture`, `montant`, `statut`, `assurance`) VALUES
(7, 25, '2024-01-01', '234.00', '', 'oui'),
(8, 26, '2023-02-02', '235.00', '', 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `cin` varchar(8) NOT NULL,
  `nom_p` varchar(255) NOT NULL,
  `prenom_p` varchar(255) NOT NULL,
  `sexe` enum('Homme','Femme') NOT NULL,
  `date_de_naissance` date NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id`, `cin`, `nom_p`, `prenom_p`, `sexe`, `date_de_naissance`, `photo`, `id_user`) VALUES
(17, 'MH27232', 'salimR', 'snbhb', 'Homme', '2000-07-29', 'r1.jpg', 25),
(19, 'CF5643', 'adil', 'farid', 'Homme', '0000-00-00', 'r3.jpg', 28),
(25, 'MJ14552', 'SAAD', 'RADG', 'Homme', '1980-01-02', 'k.jpg', 38),
(26, 'MJ14552', 'saad', 'fahil', 'Homme', '2000-01-01', 'k3.jpg', 39);

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

CREATE TABLE `rendez_vous` (
  `id_rv` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `status_rv` varchar(255) NOT NULL,
  `id_patient` int(11) NOT NULL,
  `id_doctor` int(11) NOT NULL,
  `motif` varchar(255) NOT NULL,
  `commentaire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rendez_vous`
--

INSERT INTO `rendez_vous` (`id_rv`, `date`, `heure`, `status_rv`, `id_patient`, `id_doctor`, `motif`, `commentaire`) VALUES
(1, '2024-02-01', '01:01:00', 'Accepté', 17, 8, 'tete mal', ''),
(13, '2023-01-01', '12:01:00', 'inacceptable', 25, 9, 'je suis très malade', 'hhds'),
(15, '2024-02-02', '01:01:00', 'En Cours', 26, 9, 'bhdchdsg', '');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id` int(11) NOT NULL,
  `nom_salle` varchar(255) NOT NULL,
  `capacite` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id`, `nom_salle`, `capacite`, `description`, `status`) VALUES
(2, 'salle 78', 38, 'salle Grand\r\n', 'disponible'),
(3, '23', 7, 'grand salle', 'disponible');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contrainte_admin` (`id_user`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contrainte_doctor` (`id_user`);

--
-- Index pour la table `dossiers_medicaux`
--
ALTER TABLE `dossiers_medicaux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patient` (`id_patient`),
  ADD KEY `fk_doctor` (`id_doctor`);

--
-- Index pour la table `equipements_medicaux`
--
ALTER TABLE `equipements_medicaux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_facture_patient` (`patient_id`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contrainte_patient` (`id_user`);

--
-- Index pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD PRIMARY KEY (`id_rv`),
  ADD KEY `fk_rv_patient` (`id_patient`),
  ADD KEY `fk_rv_doctor` (`id_doctor`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `dossiers_medicaux`
--
ALTER TABLE `dossiers_medicaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `equipements_medicaux`
--
ALTER TABLE `equipements_medicaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `factures`
--
ALTER TABLE `factures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  MODIFY `id_rv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `contrainte_admin` FOREIGN KEY (`id_user`) REFERENCES `compte` (`id`);

--
-- Contraintes pour la table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `contrainte_doctor` FOREIGN KEY (`id_user`) REFERENCES `compte` (`id`);

--
-- Contraintes pour la table `dossiers_medicaux`
--
ALTER TABLE `dossiers_medicaux`
  ADD CONSTRAINT `fk_doctor` FOREIGN KEY (`id_doctor`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient` FOREIGN KEY (`id_patient`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `factures`
--
ALTER TABLE `factures`
  ADD CONSTRAINT `fk_facture_patient` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `contrainte_patient` FOREIGN KEY (`id_user`) REFERENCES `compte` (`id`);

--
-- Contraintes pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD CONSTRAINT `fk_rv_doctor` FOREIGN KEY (`id_doctor`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rv_patient` FOREIGN KEY (`id_patient`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
