-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : ven. 11 avr. 2025 à 06:24
-- Version du serveur : 9.0.1
-- Version de PHP : 8.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `celestial_bodies`
--

CREATE TABLE `celestial_bodies` (
  `id` int NOT NULL,
  `type_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mass` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `radius` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `distance_from_earth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temperature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `added_by_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `celestial_bodies`
--

INSERT INTO `celestial_bodies` (`id`, `type_id`, `name`, `mass`, `radius`, `distance_from_earth`, `temperature`, `description`, `image_url`, `created_at`, `updated_at`, `added_by_id`) VALUES
(1, 2, 'Soleil', '1,9 × 10^30', '1392684', '149597870', '5772', 'Etoile du Système solaire', NULL, '2025-04-03 09:09:05', NULL, 1),
(2, 1, 'Terre', '5,973 6 × 10^24', '12756', '0', '288', 'La planète bleue, berceau de notre existence', NULL, '2025-04-04 06:21:36', NULL, 1),
(3, 1, 'Mars', '6,418 5 × 10^23', '6 779', '62 × 10^6', '210', 'Quatrième planète du Système solaire, Mars alimente l\'imaginaire collectif depuis des siècles.', NULL, '2025-04-04 06:36:12', NULL, 1),
(6, 6, 'test', '80', '12756', '7890', '288', 'Planète test', 'fcd2ad190c3b.jpg', '2025-04-04 08:54:26', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `celestial_body_type`
--

CREATE TABLE `celestial_body_type` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `celestial_body_type`
--

INSERT INTO `celestial_body_type` (`id`, `name`, `created_at`) VALUES
(1, 'Planète', '2025-04-03 10:38:00'),
(2, 'Etoile', '2025-04-03 10:38:00'),
(3, 'Astéroïde', '2025-04-03 10:39:00'),
(4, 'Comète', '2025-04-03 10:39:00'),
(5, 'Exoplanète', '2025-04-03 10:39:00'),
(6, 'Galaxie', '2025-04-03 10:39:00'),
(7, 'Satellite', '2025-04-03 10:39:00'),
(8, 'Constellation', '2025-04-03 10:39:00');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250318092502', '2025-03-18 09:25:13', 636),
('DoctrineMigrations\\Version20250318094141', '2025-03-18 09:41:49', 42),
('DoctrineMigrations\\Version20250320072642', '2025-03-20 07:26:48', 89),
('DoctrineMigrations\\Version20250325092416', '2025-03-25 09:24:21', 342),
('DoctrineMigrations\\Version20250325092539', '2025-03-25 09:25:42', 144),
('DoctrineMigrations\\Version20250403090857', '2025-04-03 09:09:01', 115),
('DoctrineMigrations\\Version20250404063605', '2025-04-04 06:36:09', 105);

-- --------------------------------------------------------

--
-- Structure de la table `favorites`
--

CREATE TABLE `favorites` (
  `id` int NOT NULL,
  `celestial_bodies_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `related_ressources`
--

CREATE TABLE `related_ressources` (
  `id` int NOT NULL,
  `celestial_body_id_id` int DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `username`, `created_at`) VALUES
(1, 'valentin.emilie78@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$JHU4Kfddi4gKxlkk26hs7eKNYyGAg0GYj.n/icFreDu6DZeQ3BGli', 'Acynia', '2025-03-20 08:25:00'),
(2, 'test@gmail.com', '[]', '$2y$13$kKEbt4UCBK2TfFLyA01QsOGtZueIHy6tYZUtqquuTCgMumr5vYQbm', 'Test1', '2025-04-03 09:49:08');

-- --------------------------------------------------------

--
-- Structure de la table `user_search_history`
--

CREATE TABLE `user_search_history` (
  `id` int NOT NULL,
  `query` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `celestial_bodies`
--
ALTER TABLE `celestial_bodies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6DF97BD1C54C8C93` (`type_id`),
  ADD KEY `IDX_6DF97BD155B127A4` (`added_by_id`);

--
-- Index pour la table `celestial_body_type`
--
ALTER TABLE `celestial_body_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E46960F5E2A070DF` (`celestial_bodies_id`),
  ADD KEY `IDX_E46960F5A76ED395` (`user_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `related_ressources`
--
ALTER TABLE `related_ressources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E0E1DD77D45E8A10` (`celestial_body_id_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- Index pour la table `user_search_history`
--
ALTER TABLE `user_search_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C1EE4088A76ED395` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `celestial_bodies`
--
ALTER TABLE `celestial_bodies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `celestial_body_type`
--
ALTER TABLE `celestial_body_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `related_ressources`
--
ALTER TABLE `related_ressources`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user_search_history`
--
ALTER TABLE `user_search_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `celestial_bodies`
--
ALTER TABLE `celestial_bodies`
  ADD CONSTRAINT `FK_6DF97BD155B127A4` FOREIGN KEY (`added_by_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_6DF97BD1C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `celestial_body_type` (`id`);

--
-- Contraintes pour la table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `FK_E46960F5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_E46960F5E2A070DF` FOREIGN KEY (`celestial_bodies_id`) REFERENCES `celestial_bodies` (`id`);

--
-- Contraintes pour la table `related_ressources`
--
ALTER TABLE `related_ressources`
  ADD CONSTRAINT `FK_E0E1DD77D45E8A10` FOREIGN KEY (`celestial_body_id_id`) REFERENCES `celestial_bodies` (`id`);

--
-- Contraintes pour la table `user_search_history`
--
ALTER TABLE `user_search_history`
  ADD CONSTRAINT `FK_C1EE4088A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
