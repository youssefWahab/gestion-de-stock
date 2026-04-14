-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 21 oct. 2025 à 09:13
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_magasin`
--

-- --------------------------------------------------------

--
-- Structure de la table `achat_articles`
--

CREATE TABLE `achat_articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `demande_achat_id` bigint(20) UNSIGNED NOT NULL,
  `stock_id` bigint(20) UNSIGNED DEFAULT NULL,
  `articleDemande` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  `unite` varchar(10) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `charge_personnels`
--

CREATE TABLE `charge_personnels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numProduction` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `role` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `consommations`
--

CREATE TABLE `consommations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chantier` varchar(255) NOT NULL,
  `article` varchar(255) NOT NULL,
  `quantiteDemande` int(11) NOT NULL,
  `quantiteConsomme` int(11) NOT NULL,
  `unite` varchar(10) NOT NULL,
  `coutUnitaire` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `demande_achat_id` bigint(20) UNSIGNED NOT NULL,
  `numProduction` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `demande_achats`
--

CREATE TABLE `demande_achats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numBonCommande` varchar(255) NOT NULL,
  `numFiche` bigint(20) UNSIGNED NOT NULL,
  `atelier` varchar(255) NOT NULL,
  `natureTravaux` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fiche_articles`
--

CREATE TABLE `fiche_articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fiche_numFiche` bigint(20) UNSIGNED NOT NULL,
  `articleDemande` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  `unite` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fiche_commandes`
--

CREATE TABLE `fiche_commandes` (
  `numFiche` bigint(20) UNSIGNED NOT NULL,
  `nomDemandeur` varchar(100) NOT NULL,
  `chantier` varchar(150) NOT NULL,
  `chefAtelier` varchar(100) NOT NULL,
  `atelier` varchar(100) NOT NULL,
  `dateCommande` date NOT NULL,
  `schemaPlan` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(27, '0001_01_01_000000_create_users_table', 1),
(28, '0001_01_01_000001_create_cache_table', 1),
(29, '0001_01_01_000002_create_jobs_table', 1),
(30, '2025_09_08_144002_create_fiche_commandes_table', 1),
(31, '2025_09_08_144134_create_demande_achats_table', 1),
(32, '2025_09_08_144157_create_productions_table', 1),
(33, '2025_09_08_144217_create_consommations_table', 1),
(34, '2025_09_08_144228_create_stocks_table', 1),
(35, '2025_09_08_144256_create_production_articles_table', 1),
(36, '2025_09_09_061210_create_charge_personnels_table', 1),
(37, '2025_09_10_135148_create_fiche_articles_table', 1),
(38, '2025_09_12_080739_create_achat_articles_table', 1),
(39, '2025_09_17_144958_create_stock_movements_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `productions`
--

CREATE TABLE `productions` (
  `numProduction` bigint(20) UNSIGNED NOT NULL,
  `chantier` varchar(255) NOT NULL,
  `produitFinale` varchar(255) NOT NULL,
  `numBonTransfert` varchar(255) DEFAULT NULL,
  `quantite` int(11) NOT NULL DEFAULT 0,
  `unite` varchar(10) DEFAULT NULL,
  `coutReviens` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `production_articles`
--

CREATE TABLE `production_articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numProduction` bigint(20) UNSIGNED NOT NULL,
  `articleDemande` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT 0,
  `unite` varchar(10) DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3EoT7Y2LGlrKIqQCjQAwdHSi0t1fa8MgHFRkuOos', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicXcxMkI1WDA1SG9TMzltTUY5UWFHQkJ5VDBJTFhxbWZRaVlEZkNaRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdG9ja3Mvc29ydGllcy9jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1761030653);

-- --------------------------------------------------------

--
-- Structure de la table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article` varchar(255) NOT NULL,
  `atelier` varchar(255) NOT NULL,
  `unite` varchar(255) DEFAULT NULL,
  `entree` int(11) NOT NULL DEFAULT 0,
  `sortie` int(11) NOT NULL DEFAULT 0,
  `stockInitial` int(11) NOT NULL DEFAULT 0,
  `stockActuel` int(11) NOT NULL,
  `minimum` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stocks`
--

INSERT INTO `stocks` (`id`, `article`, `atelier`, `unite`, `entree`, `sortie`, `stockInitial`, `stockActuel`, `minimum`, `created_at`, `updated_at`) VALUES
(1, 'PEINTURE ROUGE (LOGICOLOR) 5KG', 'soudor', 'KG', 0, 3, 46, 43, 5, '2025-09-28 22:32:52', '2025-10-09 08:55:38'),
(2, 'PEINTURE ROUGE (FACOP) 5KG', 'soudor', 'KG', 0, 0, 4, 4, 2, '2025-09-28 23:20:01', '2025-09-28 23:20:01'),
(4, 'PEINTURE BLUE (ATLAS) 5KG', 'soudor', 'KG', 0, 1, 13, 12, 5, '2025-09-29 02:07:55', '2025-10-13 11:08:27'),
(5, 'PEINTURE GRIS (ENDES) 5KG', 'soudor', 'KG', 0, 1, 38, 37, 5, '2025-09-29 02:10:00', '2025-09-30 08:15:02'),
(6, 'PEINTURE NOIRE (ATLAS) 5KG', 'soudor', 'KG', 0, 19, 32, 13, 5, '2025-09-29 02:15:10', '2025-10-20 08:37:17'),
(7, 'DISQUE 180x6,4x22,23 ROUGE (TIGOR) 25P', 'soudor', 'U', 0, 50, 75, 25, 50, '2025-09-29 02:29:51', '2025-10-20 06:47:58'),
(8, 'DISQUE 230x1,9x22 BLEU (TIGOR) 50P', 'soudor', 'U', 0, 510, 1950, 1440, 200, '2025-09-29 02:33:33', '2025-10-16 12:06:56'),
(9, 'DISQUE 230x1,9x22,23 (BOSCH) 25P', 'soudor', 'U', 0, 100, 175, 75, 75, '2025-09-29 02:39:13', '2025-10-20 08:27:58'),
(11, 'DISQUE 305x3,6x25,4 ROUGE (TIGOR) 20P', 'soudor', 'U', 0, 0, 60, 60, 40, '2025-09-29 02:55:38', '2025-09-29 02:55:38'),
(13, 'DISQUE 115x22,23 MM 60 (BOSCH) 20P', 'soudor', 'U', 0, 0, 19, 19, 15, '2025-09-29 03:02:35', '2025-09-29 03:02:35'),
(14, 'DISQUE 115x22,23 MM 80 (BOSCH) 20P', 'soudor', 'U', 0, 0, 18, 18, 15, '2025-09-29 04:09:58', '2025-09-29 04:09:58'),
(15, 'DISQUE 115x22,23 MM 120 (BOSCH) 20P', 'soudor', 'U', 0, 0, 19, 19, 15, '2025-09-29 04:10:16', '2025-09-29 04:10:16'),
(16, 'DILUANT (ENDES) 5L', 'soudor', 'U', 100, 44, 39, 95, 5, '2025-09-29 04:13:43', '2025-10-20 08:36:38'),
(17, 'PEINTURE GRIS SEAU (ENDES) 30KG', 'soudor', 'U', 0, 0, 2, 2, 1, '2025-09-29 04:15:56', '2025-09-29 02:16:56'),
(18, 'PAUMELLE 100', 'soudor', 'U', 0, 56, 112, 56, 40, '2025-09-29 04:36:53', '2025-10-20 06:30:27'),
(19, 'TIGE CALVA DIAM 8', 'soudor', 'U', 165, 50, 0, 115, 50, '2025-09-29 04:38:57', '2025-10-06 10:04:58'),
(20, 'CHEVILLES METALIQUE (WEDGE ANCHOR) M12 10x35P', 'soudor', 'U', 0, 0, 350, 350, 60, '2025-09-29 05:00:07', '2025-09-29 05:00:07'),
(21, 'CHEVILLES METALIQUE (WEDGE ANCHOR BZP) M12 8x40P', 'soudor', 'U', 0, 0, 480, 480, 60, '2025-09-29 05:04:31', '2025-09-29 05:04:31'),
(22, 'CHEVILLES METALIQUE (WEDGE ANCHOR) M10 10x35P', 'soudor', 'U', 0, 0, 350, 350, 60, '2025-09-29 05:09:12', '2025-09-29 05:09:12'),
(23, 'CHEVILLES METALIQUE (WEDGE ANCHOR 4,8 GRADE) M10 35P', 'soudor', 'U', 0, 10, 779, 769, 70, '2025-09-29 05:23:10', '2025-10-01 06:59:32'),
(25, 'RULI GUIDA', 'soudor', 'U', 0, 18, 35, 17, 10, '2025-09-29 05:35:10', '2025-10-01 07:00:26'),
(26, 'ROUNDELE (ENVIRON)', 'soudor', 'U', 0, 0, 200, 200, 50, '2025-09-29 05:35:42', '2025-09-29 05:35:42'),
(27, 'TIRFOUR 6x60 (ENVIRON)', 'soudor', 'U', 0, 50, 500, 450, 50, '2025-09-29 05:37:58', '2025-10-17 07:04:17'),
(28, 'CHEVILLES METALIQUE M12 (INDEX)', 'soudor', 'U', 0, 50, 150, 100, 50, '2025-09-29 05:40:53', '2025-10-17 07:08:02'),
(29, 'CROUX 8 (ENVIRON)', 'soudor', 'U', 0, 400, 600, 200, 50, '2025-09-29 05:52:25', '2025-10-08 12:01:40'),
(30, 'BOULOUN ECROUX 8 (ENVIRON)', 'soudor', 'U', 0, 350, 350, 0, 50, '2025-09-29 05:53:02', '2025-10-08 11:59:54'),
(31, 'SBAT 41', 'soudor', 'U', 0, 4, 4, 0, 1, '2025-09-29 05:54:31', '2025-10-13 04:21:20'),
(32, 'SBAT 42', 'soudor', 'U', 0, 3, 4, 1, 1, '2025-09-29 05:54:46', '2025-10-16 12:13:40'),
(33, 'DISQUE 300x3,5x25,4 MM NOIRE (ATLAS) 25P', 'soudor', 'U', 440, 50, 150, 540, 50, '2025-09-29 05:58:07', '2025-10-20 08:18:12'),
(34, 'PEINTURE GRIS (ATLAS) 5KG', 'soudor', 'KG', 0, 1, 1, 0, 5, '2025-09-29 06:57:52', '2025-09-30 08:16:17'),
(35, 'DIAMAND CUTTING DISC 230 MMx 22.23 MM', 'soudor', 'U', 0, 0, 11, 11, 5, '2025-09-29 07:00:36', '2025-09-29 07:00:36'),
(36, 'crima', 'marbre', 'U', 0, 11, 48, 37, 10, '2025-09-30 03:15:49', '2025-10-15 04:08:12'),
(37, 'santofire', 'marbre', 'U', 0, 15, 73, 58, 10, '2025-09-30 03:16:08', '2025-10-07 07:37:01'),
(38, 'disque 400', 'marbre', 'U', 400, 36, 8, 372, 5, '2025-09-30 03:16:28', '2025-10-21 04:10:25'),
(39, 'disque 320', 'marbre', 'U', 0, 3, 3, 0, 5, '2025-09-30 03:16:43', '2025-10-06 07:37:07'),
(40, 'disque 120', 'marbre', 'U', 400, 0, 32, 432, 5, '2025-09-30 03:17:36', '2025-10-06 12:57:27'),
(41, 'disque 80', 'marbre', 'U', 0, 0, 7, 7, 5, '2025-09-30 03:17:52', '2025-09-30 03:17:52'),
(42, 'metre 5m ord', 'marbre', 'U', 36, 19, 2, 17, 1, '2025-09-30 03:18:22', '2025-10-21 04:46:13'),
(43, 'passta noire', 'marbre', 'U', 0, 0, 12, 12, 5, '2025-09-30 03:18:34', '2025-09-30 03:18:34'),
(44, 'passta blanche', 'marbre', 'U', 0, 2, 26, 24, 5, '2025-09-30 03:18:49', '2025-10-15 04:33:32'),
(45, 'cochita', 'marbre', 'U', 0, 2, 3, 1, 3, '2025-09-30 03:19:03', '2025-10-04 12:13:42'),
(46, 'disque 60', 'marbre', 'U', 0, 4, 50, 46, 3, '2025-09-30 03:20:09', '2025-10-11 07:51:36'),
(47, 'disque 220', 'marbre', 'U', 400, 26, 4, 378, 1, '2025-09-30 03:22:44', '2025-10-21 04:11:25'),
(48, 'larizine', 'marbre', 'U', 0, 0, 3, 3, 1, '2025-09-30 03:23:26', '2025-09-30 03:23:26'),
(49, 'pavite', 'marbre', 'U', 0, 9, 21, 12, 1, '2025-09-30 03:26:11', '2025-10-18 11:59:19'),
(50, 'les lunettes', 'marbre', 'U', 0, 12, 12, 0, 1, '2025-09-30 03:26:52', '2025-10-21 04:20:14'),
(51, 'colla', 'ba 13', 'U', 20, 7, 2, 15, 1, '2025-09-30 03:27:24', '2025-10-18 06:28:06'),
(52, 'scotche', 'ba 13', 'U', 300, 78, 0, 222, 1, '2025-09-30 03:28:14', '2025-10-20 10:43:35'),
(53, 'ligatte', 'ba 13', 'U', 0, 0, 0, 0, 1, '2025-09-30 03:30:03', '2025-09-30 03:30:03'),
(54, 'chita', 'ba 13', 'U', 0, 2, 12, 10, 1, '2025-09-30 03:30:12', '2025-10-11 07:45:23'),
(55, 'les lunettes', 'ba 13', 'U', 0, 1, 12, 11, 1, '2025-09-30 03:51:34', '2025-10-15 08:00:44'),
(56, 'pavite', 'ba 13', 'U', 0, 2, 20, 18, 1, '2025-09-30 03:51:43', '2025-10-18 12:19:42'),
(57, 'tipe', 'marbre', 'U', 0, 21, 59, 38, 6, '2025-09-30 07:27:39', '2025-10-18 04:30:13'),
(58, 'PEINTURE vert (ENDES) 5KG', 'soudor', 'U', 100, 37, 0, 63, 5, '2025-09-30 08:00:58', '2025-10-17 10:43:01'),
(60, 'selecone akfix 12P', 'aluminium', 'U', 0, 31, 353, 322, 66, '2025-09-30 11:36:12', '2025-10-20 12:45:07'),
(61, 'scotche blanche', 'aluminium', 'U', 0, 18, 1039, 1021, 145, '2025-09-30 11:42:19', '2025-10-18 05:58:36'),
(62, 'scotche embalage', 'aluminium', 'U', 92, 81, 267, 278, 30, '2025-09-30 11:44:28', '2025-10-18 10:26:28'),
(63, 'bis 6 300p', 'aluminium', 'U', 0, 0, 27, 27, 5, '2025-09-30 12:04:19', '2025-09-30 12:04:19'),
(64, 'soulofan grand', 'aluminium', 'U', 28, 20, 58, 66, 10, '2025-09-30 12:11:40', '2025-10-15 10:48:17'),
(65, 'soulofan  petite', 'aluminium', 'U', 0, 467, 1533, 1066, 260, '2025-09-30 12:13:07', '2025-10-20 12:32:52'),
(66, 'bis 4x40 200P', 'aluminium', 'U', 0, 11, 2080, 2069, 240, '2025-09-30 12:17:44', '2025-10-18 07:01:04'),
(67, 'bis 6x100 mm 100p', 'aluminium', 'U', 0, 0, 8, 8, 5, '2025-09-30 12:27:26', '2025-09-30 12:27:26'),
(68, 'bis 4,8x38 250p', 'aluminium', 'U', 0, 0, 5, 5, 5, '2025-09-30 12:28:28', '2025-10-20 12:45:27'),
(69, 'bis 4,8x60 200p', 'aluminium', 'U', 0, 3, 10, 7, 5, '2025-09-30 12:29:15', '2025-10-14 10:41:51'),
(70, 'bis 4x50 200P', 'aluminium', 'U', 0, 3, 0, 15, 5, '2025-09-30 12:29:46', '2025-10-18 07:02:17'),
(71, 'lamone grande (MEULEUSE GWS 2700W BOSCH)', 'soudor', 'U', 5, 5, 0, 0, 2, '2025-10-01 05:59:30', '2025-10-11 08:00:18'),
(72, 'lamone  petite (MEULEUSE GWS 270W BOSCH)', 'soudor', 'U', 5, 3, 0, 2, 2, '2025-10-01 06:01:35', '2025-10-13 10:07:18'),
(73, 'bagitt', 'soudor', 'U', 42, 23, 0, 19, 5, '2025-10-01 06:03:10', '2025-10-07 05:25:06'),
(74, 'meche a fer 20 inox bosch', 'soudor', 'U', 5, 5, 0, 0, 2, '2025-10-01 06:10:32', '2025-10-01 06:19:21'),
(75, 'meche a fer 16 inox bosch', 'soudor', 'U', 5, 5, 0, 0, 2, '2025-10-01 06:10:55', '2025-10-01 06:19:54'),
(76, 'meche a fer 18 inox bosch', 'soudor', 'U', 5, 5, 0, 0, 2, '2025-10-01 06:11:12', '2025-10-01 06:21:01'),
(77, 'POLY BOX', 'amv', 'U', 5, 6, 1, 0, 1, '2025-10-01 07:31:21', '2025-10-09 05:29:22'),
(78, 'vantuz', 'aluminium', 'U', 0, 0, 2, 2, 1, '2025-10-01 07:39:29', '2025-10-01 07:39:29'),
(79, 'pistolet', 'aluminium', 'U', 0, 0, 2, 2, 1, '2025-10-01 07:41:55', '2025-10-01 07:41:55'),
(80, 'pavite', 'aluminium', 'U', 0, 5, 8, 3, 3, '2025-10-01 07:43:54', '2025-10-17 07:57:49'),
(81, 'PIED A COULISSE (nobel)', 'aluminium', 'U', 0, 2, 3, 1, 1, '2025-10-01 08:06:01', '2025-10-18 05:52:27'),
(82, 'disque 355mm 2,6/2,2x30mm (bosch)', 'aluminium', 'U', 0, 1, 4, 3, 2, '2025-10-01 08:10:16', '2025-10-17 08:45:50'),
(83, 'disque 230x1,9x22,23 mm (metal)', 'aluminium', 'U', 0, 0, 1, 1, 1, '2025-10-01 08:11:22', '2025-10-01 08:11:22'),
(84, 'mizan', 'aluminium', 'U', 0, 0, 2, 2, 1, '2025-10-01 10:21:46', '2025-10-04 16:46:58'),
(85, 'ligat', 'aluminium', 'U', 100, 75, 0, 25, 30, '2025-10-02 05:00:21', '2025-10-18 10:49:18'),
(86, 'les lunettes de protection', 'soudor', 'U', 48, 14, 0, 34, 20, '2025-10-02 05:01:48', '2025-10-16 12:07:51'),
(87, 'masque de soudor couton', 'soudor', 'U', 5, 5, 0, 0, 2, '2025-10-02 05:02:30', '2025-10-02 05:16:08'),
(88, 'masque resperatoire', 'soudor', 'U', 8, 8, 0, 0, 3, '2025-10-02 05:03:54', '2025-10-02 05:16:31'),
(89, 'harnais de sécurité complet', 'soudor', 'U', 5, 4, 0, 1, 2, '2025-10-02 05:05:41', '2025-10-08 04:57:16'),
(90, 'stop chute nom', 'soudor', 'U', 4, 2, 0, 2, 2, '2025-10-02 05:06:22', '2025-10-07 12:48:43'),
(91, 'PAUMELLE 80', 'soudor', 'U', 204, 204, 0, 0, 10, '2025-10-02 06:01:55', '2025-10-02 10:55:29'),
(92, 'les lunettes', 'aluminium', 'U', 0, 9, 9, 0, 3, '2025-10-02 08:06:17', '2025-10-16 13:11:12'),
(93, 'DISQUE 115x1,6x22,2 MM (atlas) 25P', 'aluminium', 'U', 0, 10, 356, 346, 75, '2025-10-02 08:43:30', '2025-10-17 05:19:15'),
(94, 'boite rouge', 'amv', 'U', 0, 63, 418, 355, 25, '2025-10-02 10:27:56', '2025-10-20 04:51:08'),
(95, 'SAROTE', 'amv', 'U', 0, 49, 105, 56, 20, '2025-10-02 10:28:49', '2025-10-20 04:49:05'),
(96, 'DOUILLES', 'amv', 'U', 0, 42, 106, 64, 30, '2025-10-02 10:29:26', '2025-10-20 04:56:16'),
(97, 'PRISE SIMPLE', 'amv', 'U', 0, 57, 119, 62, 20, '2025-10-02 10:30:13', '2025-10-20 04:49:27'),
(98, 'DIJONCTEUR C63', 'amv', 'U', 0, 1, 1, 0, 1, '2025-10-02 10:30:52', '2025-10-06 10:17:04'),
(99, 'DIJONCTEUR C25', 'amv', 'U', 0, 1, 68, 67, 1, '2025-10-02 10:31:20', '2025-10-14 12:31:32'),
(100, 'CABLE 3G 2,5 MM 100m', 'amv', 'U', 500, 700, 300, 100, 200, '2025-10-02 10:32:19', '2025-10-18 10:31:26'),
(101, 'CABLE 5G 2,5 MM 100 m', 'amv', 'U', 400, 512, 500, 388, 1, '2025-10-02 10:32:34', '2025-10-16 13:29:23'),
(102, 'CHEVILLES  EN PLASTIQUE 8MM (INGELEC)', 'amv', 'U', 0, 0, 22, 22, 3, '2025-10-02 10:33:31', '2025-10-14 12:43:05'),
(103, 'CHEVILLES  EN PLASTIQUE 8MM', 'aluminium', 'U', 0, 20, 36, 16, 5, '2025-10-02 10:33:48', '2025-10-11 12:51:47'),
(104, 'BOULA (LIGHT ONE )', 'amv', 'U', 0, 0, 3, 3, 1, '2025-10-02 10:35:05', '2025-10-02 10:35:05'),
(105, 'KHATM (ENVIRON)', 'aluminium', 'U', 0, 0, 900, 900, 100, '2025-10-02 10:42:10', '2025-10-02 10:42:10'),
(106, 'FICHE 2P + T FEMELLE 16 A 220 V', 'amv', 'U', 0, 3, 3, 0, 1, '2025-10-02 10:47:53', '2025-10-09 07:31:56'),
(107, 'LAMBO', 'amv', 'U', 0, 0, 40, 40, 10, '2025-10-02 10:48:11', '2025-10-02 10:48:11'),
(108, 'CHEVILLES EN PLASTIC 8 (BLUE)', 'aluminium', 'U', 0, 0, 76, 76, 10, '2025-10-02 10:59:38', '2025-10-02 10:59:38'),
(109, 'TRKABE', 'amv', 'U', 0, 0, 0, 0, 1, '2025-10-02 11:05:42', '2025-10-02 11:05:42'),
(110, 'CLAME', 'amv', 'U', 180, 20, 0, 160, 40, '2025-10-02 11:25:12', '2025-10-03 08:17:44'),
(111, 'paumelle noir 2P', 'aluminium', 'U', 0, 0, 85, 85, 20, '2025-10-02 12:18:13', '2025-10-02 12:18:13'),
(112, 'CABLE 3G 1,5 MM 100m', 'amv', 'U', 300, 400, 100, 0, 100, '2025-10-03 04:25:22', '2025-10-08 04:54:42'),
(113, 'pontalon (L)', 'soudor', 'U', 24, 24, 0, 0, 5, '2025-10-03 06:25:37', '2025-10-03 11:29:20'),
(114, 'pontalon (xL)', 'soudor', 'U', 15, 15, 0, 0, 5, '2025-10-03 06:25:51', '2025-10-03 11:29:45'),
(115, 'pontalon (xxL)', 'soudor', 'U', 11, 11, 0, 0, 5, '2025-10-03 06:26:09', '2025-10-03 11:30:03'),
(116, 'veste (L)', 'soudor', 'U', 10, 10, 0, 0, 5, '2025-10-03 06:26:43', '2025-10-03 11:44:05'),
(117, 'veste (XL)', 'soudor', 'U', 16, 16, 0, 0, 5, '2025-10-03 06:26:59', '2025-10-03 11:45:55'),
(118, 'comblison alum', 'aluminium', 'U', 13, 13, 0, 0, 5, '2025-10-03 06:27:58', '2025-10-16 13:10:22'),
(119, 'FICHE T male', 'amv', 'U', 0, 2, 2, 0, 1, '2025-10-03 07:18:43', '2025-10-03 07:22:04'),
(120, 'cable 10 souple noir 50 m', 'amv', 'U', 50, 0, 0, 50, 25, '2025-10-03 12:43:10', '2025-10-03 12:45:14'),
(121, 'poignee strugale', 'aluminium', 'U', 0, 0, 39, 39, 15, '2025-10-04 06:42:51', '2025-10-04 06:42:51'),
(122, 'roullette plastique (rwayde)', 'aluminium', 'U', 72, 8, 10, 74, 4, '2025-10-04 06:44:54', '2025-10-18 05:58:13'),
(123, 'CLAME 90', 'aluminium', 'U', 0, 0, 5, 5, 1, '2025-10-04 06:47:54', '2025-10-04 06:47:54'),
(124, 'paumelle noir', 'aluminium', 'U', 12, 22, 257, 247, 2, '2025-10-04 06:49:55', '2025-10-18 07:31:05'),
(125, 'cache guid + guid rollette (rwayde)', 'aluminium', 'U', 0, 0, 3, 3, 1, '2025-10-04 06:50:37', '2025-10-04 06:50:37'),
(126, 'lombo crouchena', 'aluminium', 'U', 0, 0, 6, 6, 2, '2025-10-04 06:51:39', '2025-10-04 06:51:39'),
(127, 'roullette fer (rwayde)', 'aluminium', 'U', 0, 0, 7, 7, 2, '2025-10-04 06:51:59', '2025-10-14 12:21:11'),
(128, 'veron police (qfl)', 'aluminium', 'U', 0, 0, 6, 6, 1, '2025-10-04 06:52:37', '2025-10-04 06:52:37'),
(129, 'guid', 'aluminium', 'U', 0, 0, 3, 3, 1, '2025-10-04 06:53:37', '2025-10-04 06:53:37'),
(130, 'gachat', 'aluminium', 'U', 0, 1, 8, 7, 2, '2025-10-04 06:53:51', '2025-10-10 10:50:00'),
(131, 'poignee bequille', 'aluminium', 'U', 4, 10, 19, 13, 0, '2025-10-04 06:54:15', '2025-10-16 12:47:26'),
(132, 'les inyo (environ)', 'aluminium', 'U', 0, 0, 30, 30, 5, '2025-10-04 07:08:14', '2025-10-04 07:08:14'),
(133, 'buzet (environ)', 'aluminium', 'U', 0, 0, 30, 30, 5, '2025-10-04 07:09:01', '2025-10-04 07:09:01'),
(134, 'kit loquethod', 'aluminium', 'U', 0, 0, 4, 4, 1, '2025-10-04 07:09:32', '2025-10-04 07:09:32'),
(135, 'join surcadre (environ)', 'aluminium', 'U', 0, 0, 200, 200, 50, '2025-10-04 07:10:49', '2025-10-04 07:10:49'),
(136, 'bouchon', 'aluminium', 'U', 0, 0, 1, 1, 0, '2025-10-04 07:21:37', '2025-10-04 07:21:37'),
(137, 'CLAME 70', 'aluminium', 'U', 582, 524, 2, 60, 1, '2025-10-04 08:43:33', '2025-10-20 05:40:20'),
(138, 'CLAME x', 'aluminium', 'U', 0, 0, 1, 1, 1, '2025-10-04 08:43:51', '2025-10-04 08:43:51'),
(139, 'CLAME Domino fix', 'aluminium', 'U', 0, 1, 1, 0, 1, '2025-10-04 08:44:15', '2025-10-13 06:05:09'),
(140, 'roullo Blanche', 'aluminium', 'U', 0, 12, 12, 0, 2, '2025-10-04 10:59:53', '2025-10-09 11:53:31'),
(141, 'serrure 30 mm', 'aluminium', 'U', 4, 4, 0, 0, 1, '2025-10-04 11:00:29', '2025-10-06 07:28:01'),
(142, 'tasseau petite', 'aluminium', 'U', 30, 30, 0, 0, 1, '2025-10-04 11:01:37', '2025-10-06 07:29:42'),
(143, 'equerre ouvrant dormant fenetre s46', 'aluminium', 'U', 16, 16, 0, 0, 6, '2025-10-04 11:18:47', '2025-10-06 07:30:30'),
(144, 'equerre ouvrant porte s46', 'aluminium', 'U', 16, 16, 0, 0, 6, '2025-10-04 11:19:09', '2025-10-06 07:30:00'),
(145, 'ligat', 'marbre', 'U', 30, 12, 0, 18, 5, '2025-10-06 04:34:14', '2025-10-16 11:52:34'),
(146, 'projecteur led IP65 plat 150w noir lum.blanche (ingelec)', 'amv', 'U', 10, 13, 3, 0, 1, '2025-10-06 07:43:02', '2025-10-07 12:01:55'),
(147, 'projecteur led 100W 3000K H100W(brabus)', 'amv', 'U', 15, 9, 12, 18, 2, '2025-10-06 07:56:10', '2025-10-16 13:16:52'),
(148, 'ECROU CALVA DIAM 8', 'aluminium', 'U', 165, 0, 0, 165, 20, '2025-10-06 10:17:33', '2025-10-06 10:20:06'),
(151, 'colliers 7,6x265 noir 100p', 'amv', 'U', 600, 700, 100, 0, 200, '2025-10-07 05:40:26', '2025-10-18 07:45:27'),
(152, 'tube flex.isog.q16 / isogris Q25 50 m (aiscan)', 'amv', 'U', 400, 250, 150, 300, 150, '2025-10-07 05:56:42', '2025-10-07 10:40:11'),
(153, 'barrette de connexion 1001 6mm', 'amv', 'U', 200, 142, 0, 26, 50, '2025-10-07 06:04:52', '2025-10-09 11:14:35'),
(154, 'spot led 24w panel carre app 6500k blacklight', 'amv', 'U', 12, 4, 0, 8, 4, '2025-10-07 06:15:05', '2025-10-08 06:53:54'),
(155, 'horloge avec reserve 24H 15mm/200h', 'amv', 'U', 3, 3, 0, 0, 1, '2025-10-07 06:23:55', '2025-10-09 05:29:46'),
(156, 'rail omega perfore 7mm sym.dim l.35mm2 - 2m', 'amv', 'U', 10, 18, 8, 0, 5, '2025-10-07 06:31:28', '2025-10-09 05:43:22'),
(157, 'cable ths Alu.4*16 60m', 'amv', 'U', 60, 0, 0, 60, 20, '2025-10-07 06:39:44', '2025-10-07 06:40:44'),
(158, 'pince d\'ancrage pa 1500 max 70mm2', 'amv', 'U', 8, 8, 0, 0, 2, '2025-10-07 06:43:44', '2025-10-17 05:08:26'),
(159, 'boite de jonction m13 4*25/35/50 cm2/90A2F 90A3', 'amv', 'U', 2, 2, 0, 0, 1, '2025-10-07 06:46:44', '2025-10-09 05:31:39'),
(160, 'cosse a sertir 70mm t10', 'amv', 'U', 10, 10, 0, 0, 3, '2025-10-07 06:49:47', '2025-10-17 05:07:58'),
(161, 'cosse a sertir 50mm t8 JM (JGK) 50-8', 'amv', 'U', 8, 8, 0, 0, 2, '2025-10-07 06:51:13', '2025-10-17 05:09:38'),
(162, 'fusible a couteaux to 160A AM', 'amv', 'U', 3, 3, 0, 0, 1, '2025-10-07 06:53:49', '2025-10-17 05:09:20'),
(163, 'contacteur AF26-30-00-13V110-250V 11KW AC/DC ABB 237001r1300', 'amv', 'U', 3, 3, 7, 7, 1, '2025-10-07 07:07:41', '2025-10-14 12:04:32'),
(164, 'disque 230x3,2x22,23 mm', 'marbre', 'U', 0, 0, 1, 1, 2, '2025-10-07 07:59:20', '2025-10-07 07:59:20'),
(165, 'scotche noir', 'amv', 'U', 0, 24, 50, 26, 5, '2025-10-07 10:36:03', '2025-10-09 05:31:23'),
(166, 'viv etanche app gris fonce', 'amv', 'U', 10, 9, 0, 1, 1, '2025-10-07 12:21:04', '2025-10-08 11:06:04'),
(167, 'poussoir a bascule lumineux etanche app gris (ingelic)', 'amv', 'U', 1, 1, 0, 0, 1, '2025-10-07 12:24:24', '2025-10-08 11:04:21'),
(168, 'appariel niveau lizer', 'soudor', 'U', 2, 2, 0, 0, 1, '2025-10-08 05:25:09', '2025-10-08 05:26:51'),
(169, 'DISQUE 180x20x22,22 Blanche (disque finition)', 'marbre', 'U', 0, 2, 6, 4, 2, '2025-10-08 05:34:01', '2025-10-09 04:57:29'),
(170, 'disque 36', 'amv', 'U', 0, 0, 17, 17, 5, '2025-10-08 05:35:35', '2025-10-08 05:35:35'),
(171, 'casque anti bruit', 'marbre', 'U', 10, 7, 0, 3, 3, '2025-10-08 07:35:52', '2025-10-17 10:32:59'),
(172, 'prise 2p + T encastré gris réf 4866', 'amv', 'U', 40, 4, 27, 63, 5, '2025-10-08 07:44:16', '2025-10-14 12:28:40'),
(173, 'cable ths alu.3*70+54,6 +16mm2', 'amv', 'U', 200, 200, 0, 0, 50, '2025-10-08 07:47:59', '2025-10-17 05:10:21'),
(174, 'masque resperatoire', 'marbre', 'U', 0, 1, 2, 1, 1, '2025-10-08 08:14:21', '2025-10-09 05:20:26'),
(175, 'les lunettes grand', 'amv', 'U', 0, 0, 4, 4, 1, '2025-10-08 08:23:24', '2025-10-08 08:23:24'),
(176, 'CHEVILLES EN PLASTIC 10 MM', 'aluminium', 'U', 9, 1, 40, 48, 5, '2025-10-08 10:48:02', '2025-10-16 07:39:06'),
(177, 'bis 4x32 300p', 'amv', 'U', 0, 0, 11, 11, 5, '2025-10-08 11:23:02', '2025-10-08 11:23:02'),
(178, 'bis 4,8x32 300p', 'aluminium', 'U', 0, 2, 12, 10, 5, '2025-10-08 11:30:27', '2025-10-15 11:47:11'),
(179, 'led strip light  200w (brabus)', 'amv', 'U', 0, 2, 2, 0, 1, '2025-10-09 05:34:46', '2025-10-09 05:36:49'),
(180, 'gullote', 'amv', 'U', 0, 8, 8, 0, 2, '2025-10-09 06:45:57', '2025-10-09 06:47:26'),
(181, 'kit fenetre s70R', 'aluminium', 'U', 300, 0, 0, 300, 50, '2025-10-09 08:28:09', '2025-10-09 08:38:38'),
(182, 'kit fermeture S70R renf', 'aluminium', 'U', 556, 400, 0, 156, 50, '2025-10-09 08:32:53', '2025-10-20 11:58:29'),
(183, 'cosse a sertir 240mm t16', 'amv', 'U', 12, 12, 0, 0, 4, '2025-10-09 10:09:47', '2025-10-17 07:16:26'),
(184, 'bis 4,8x16 400p', 'amv', 'U', 0, 1, 1, 0, 5, '2025-10-09 11:51:58', '2025-10-09 11:52:59'),
(185, 'tournevis dove plat', 'aluminium', 'U', 6, 5, 0, 1, 2, '2025-10-10 11:59:39', '2025-10-20 04:42:35'),
(186, 'tournevis dove american', 'aluminium', 'U', 6, 6, 0, 0, 2, '2025-10-10 12:00:02', '2025-10-20 04:32:35'),
(187, 'jeu cle sipo 308-2012 xcort', 'aluminium', 'U', 5, 5, 0, 0, 1, '2025-10-10 12:00:47', '2025-10-16 13:12:09'),
(188, 'balais en plastique filtrage', 'aluminium', 'U', 10, 4, 0, 6, 3, '2025-10-10 12:01:33', '2025-10-11 12:07:34'),
(189, 'manche filtage', 'aluminium', 'U', 10, 4, 0, 6, 3, '2025-10-10 12:02:02', '2025-10-11 12:08:37'),
(190, 'pistolet silicone', 'aluminium', 'U', 10, 2, 0, 8, 3, '2025-10-10 12:02:32', '2025-10-20 12:44:45'),
(191, 'metre 10m betta', 'aluminium', 'U', 10, 10, 0, 0, 3, '2025-10-10 12:02:51', '2025-10-20 12:19:24'),
(192, 'meche a fer 4 inox bosch', 'aluminium', 'U', 10, 1, 0, 9, 3, '2025-10-10 12:03:40', '2025-10-15 05:45:25'),
(193, 'meche a fer 10 inox bosch', 'aluminium', 'U', 5, 2, 0, 3, 3, '2025-10-10 12:04:14', '2025-10-20 09:01:08'),
(194, 'meche a fer 6 inox bosch', 'aluminium', 'U', 10, 7, 0, 3, 2, '2025-10-10 12:04:28', '2025-10-20 12:28:20'),
(195, 'meche a fer 8 inox bosch', 'aluminium', 'U', 5, 4, 0, 1, 3, '2025-10-10 12:04:52', '2025-10-20 09:00:54'),
(196, 'sauteuse gst 650 450w bosh', 'aluminium', 'U', 2, 1, 0, 1, 1, '2025-10-10 12:05:30', '2025-10-20 10:28:31'),
(197, 'sipo tps-4c jetech', 'aluminium', 'U', 3, 3, 0, 0, 1, '2025-10-10 12:05:58', '2025-10-17 05:29:20'),
(198, 'kiteur vello 18', 'aluminium', 'U', 12, 11, 0, 1, 4, '2025-10-10 12:06:25', '2025-10-20 11:35:21'),
(199, 'perforateur hikoki', 'aluminium', 'U', 2, 1, 0, 1, 1, '2025-10-11 08:29:15', '2025-10-17 07:37:19'),
(200, 'perceuse 750w 13mm Ronix', 'aluminium', 'U', 5, 1, 0, 4, 1, '2025-10-11 08:37:12', '2025-10-18 08:48:50'),
(201, 'colle flambo 5L', 'soudor', 'L', 2, 1, 0, 1, 0, '2025-10-11 10:15:00', '2025-10-11 10:24:32'),
(202, 'led 18g132', 'amv', 'U', 0, 1, 3, 2, 1, '2025-10-11 10:33:48', '2025-10-11 11:36:56'),
(203, 'visseuse perceuse 20v ronix', 'aluminium', 'U', 5, 2, 0, 3, 1, '2025-10-11 10:37:35', '2025-10-16 12:34:16'),
(204, 'meuleuse hikoki', 'aluminium', 'U', 3, 2, 0, 1, 1, '2025-10-11 10:38:20', '2025-10-17 05:18:25'),
(205, 'marteau  en caoutchonc', 'aluminium', 'U', 4, 4, 0, 0, 1, '2025-10-11 10:39:36', '2025-10-14 10:42:45'),
(206, 'pistolet wokin', 'aluminium', 'U', 8, 0, 0, 8, 1, '2025-10-11 10:40:31', '2025-10-11 11:14:03'),
(207, 'massette 1kg', 'aluminium', 'U', 3, 2, 0, 1, 1, '2025-10-11 10:41:07', '2025-10-15 05:45:58'),
(208, 'massette 2kg', 'aluminium', 'U', 10, 0, 0, 10, 1, '2025-10-11 10:41:20', '2025-10-18 12:04:53'),
(209, 'jeu cle utrar', 'aluminium', 'U', 3, 1, 0, 2, 1, '2025-10-11 10:44:26', '2025-10-13 07:26:46'),
(210, 'jeu cle male torx', 'aluminium', 'U', 7, 0, 0, 7, 1, '2025-10-11 10:45:18', '2025-10-11 11:20:43'),
(211, 'pince etaux toptal', 'aluminium', 'U', 4, 2, 0, 2, 1, '2025-10-11 10:47:51', '2025-10-15 05:48:58'),
(212, 'pince Etaux wokin', 'aluminium', 'U', 4, 0, 0, 4, 1, '2025-10-11 10:49:40', '2025-10-17 11:05:56'),
(213, 'caisse outils', 'aluminium', 'U', 7, 2, 0, 5, 1, '2025-10-11 10:50:40', '2025-10-18 05:51:41'),
(214, 'scie', 'aluminium', 'U', 9, 1, 0, 8, 1, '2025-10-11 10:51:00', '2025-10-17 07:39:58'),
(215, 'agraffes JBM (boite)', 'aluminium', 'U', 7, 0, 0, 7, 1, '2025-10-11 10:55:41', '2025-10-11 11:23:00'),
(216, 'masking tape', 'aluminium', 'U', 657, 0, 0, 657, 1, '2025-10-11 10:56:08', '2025-10-11 11:25:34'),
(217, 'bis spax 6x80 (meridyen) 200p', 'aluminium', 'U', 10, 1, 0, 9, 1, '2025-10-11 10:59:18', '2025-10-13 07:44:11'),
(218, 'bis blind rivets 4x20 500p', 'aluminium', 'U', 5, 1, 0, 4, 1, '2025-10-11 11:00:19', '2025-10-13 07:45:17'),
(219, 'bis 3,5x25 index 500p', 'aluminium', 'U', 8, 1, 0, 7, 1, '2025-10-11 11:01:05', '2025-10-13 07:45:07'),
(220, 'venteuse triple wokin', 'aluminium', 'U', 6, 4, 0, 2, 1, '2025-10-11 11:24:08', '2025-10-17 07:36:06'),
(221, 'bis 4,8x38 500p (panel', 'amv', 'U', 0, 1, 8, 7, 3, '2025-10-13 07:41:59', '2025-10-13 07:42:36'),
(222, 'contacteur push button switch', 'amv', 'U', 0, 0, 3, 3, 1, '2025-10-14 12:07:02', '2025-10-14 12:07:02'),
(223, 'mini motor siren', 'amv', 'U', 0, 0, 1, 1, 1, '2025-10-14 12:09:22', '2025-10-14 12:09:22'),
(224, 'prise 2p + T encastré gris réf 4876', 'amv', 'U', 0, 0, 37, 37, 5, '2025-10-14 12:30:24', '2025-10-14 12:30:24'),
(225, 'DIJONCTEUR 4 FIL', 'amv', 'U', 0, 0, 1, 1, 1, '2025-10-14 12:33:19', '2025-10-14 12:33:19'),
(226, 'PRISE DAPPARET 3FIL BLEU 200-250v', 'amv', 'U', 0, 0, 30, 30, 5, '2025-10-14 12:44:30', '2025-10-14 12:44:30'),
(227, 'PRISE 5FIL ROUGE 220/380V', 'amv', 'U', 0, 0, 16, 16, 5, '2025-10-14 12:45:58', '2025-10-14 12:45:58'),
(228, 'led spot light petit 180-240V 7w 3000k', 'amv', 'U', 0, 0, 100, 100, 20, '2025-10-14 12:48:24', '2025-10-14 12:48:24'),
(229, 'projecteur plat led petit 50w (ingelec)', 'amv', 'U', 0, 6, 20, 14, 5, '2025-10-14 12:50:45', '2025-10-18 10:30:18'),
(230, 'pince rivet', 'amv', 'U', 0, 0, 7, 7, 2, '2025-10-14 12:51:31', '2025-10-14 12:51:31'),
(231, 'Niveau d\'eAU', 'amv', 'U', 0, 0, 2, 2, 1, '2025-10-14 12:51:51', '2025-10-14 12:51:51'),
(232, 'Rkap', 'amv', 'U', 0, 0, 1, 1, 1, '2025-10-14 12:54:29', '2025-10-14 12:54:29'),
(233, 'collecteur', 'amv', 'U', 0, 0, 2, 2, 1, '2025-10-14 12:54:59', '2025-10-14 12:54:59'),
(234, 'lombo - helvia A2-c 20mm bleu', 'amv', 'U', 0, 0, 1, 1, 0, '2025-10-14 12:56:08', '2025-10-14 12:56:08'),
(235, 'lombo - helvia A2 25mm Jaune', 'amv', 'U', 0, 0, 1, 1, 0, '2025-10-14 12:56:52', '2025-10-14 12:56:52'),
(236, 'lombo - helvia A1 20mm Rouge', 'amv', 'U', 0, 0, 1, 1, 0, '2025-10-14 12:57:26', '2025-10-14 12:57:26'),
(237, 'lombo - helvia A3-c 20mm Rouge', 'amv', 'U', 0, 0, 1, 1, 0, '2025-10-14 12:58:05', '2025-10-14 12:58:05'),
(238, 'lombo - helvia A2 25mm vert', 'amv', 'U', 0, 0, 1, 1, 0, '2025-10-14 12:58:51', '2025-10-14 12:58:51'),
(239, 'lombo - helvia A3 25mm jaune', 'amv', 'U', 0, 0, 1, 1, 0, '2025-10-14 12:59:46', '2025-10-14 12:59:46'),
(240, 'lombo - helvia A3 25mm vert', 'amv', 'U', 0, 0, 1, 1, 0, '2025-10-14 13:00:25', '2025-10-14 13:00:25'),
(241, 'scotche', 'amv', 'U', 0, 0, 46, 46, 5, '2025-10-14 13:01:47', '2025-10-14 13:01:47'),
(242, 'SBAT 43', 'aluminium', 'U', 1, 1, 0, 0, 1, '2025-10-16 12:57:50', '2025-10-16 13:08:52'),
(243, 'SBAT 42', 'aluminium', 'U', 1, 1, 0, 0, 1, '2025-10-16 12:58:06', '2025-10-16 13:08:22'),
(244, 'SBAT 40', 'aluminium', 'U', 1, 1, 0, 0, 1, '2025-10-16 12:58:23', '2025-10-16 13:10:39'),
(245, 'CHEVILLES  EN PLASTIQUE 10MM', 'soudor', 'U', 0, 1, 13, 12, 5, '2025-10-17 07:02:25', '2025-10-17 07:03:55'),
(246, 'disque quartz', 'amv', 'U', 0, 1, 1, 0, 0, '2025-10-17 07:25:05', '2025-10-17 07:32:07'),
(247, 'cofri dist. 3A240+3D35 NP ODISS TYPE 31 FC NP', 'amv', 'U', 1, 1, 0, 0, 1, '2025-10-17 08:05:13', '2025-10-17 08:15:42'),
(248, 'santofire', 'soudor', 'U', 50, 0, 0, 50, 10, '2025-10-17 08:05:38', '2025-10-17 08:09:50'),
(249, 'chaine galva 6mm', 'soudor', 'U', 40, 0, 0, 40, 10, '2025-10-17 08:06:30', '2025-10-17 08:10:12'),
(250, 'perceuse GSB 18-2 Re bosh', 'soudor', 'U', 5, 0, 0, 5, 1, '2025-10-17 08:08:19', '2025-10-17 08:12:33'),
(251, 'meche a fer 5 inox bosch', 'amv', 'U', 0, 0, 2, 2, 0, '2025-10-18 12:39:36', '2025-10-18 12:40:12'),
(252, 'visseuse simple', 'amv', 'U', 0, 2, 5, 3, 1, '2025-10-20 05:03:55', '2025-10-20 12:47:29'),
(253, 'joint 6mm S70R 4646', 'amv', 'U', 50, 50, 0, 0, 0, '2025-10-20 06:52:37', '2025-10-20 06:55:43'),
(254, 'electrodes matica  3,15', 'soudor', 'U', 416, 16, 0, 400, 50, '2025-10-20 07:11:21', '2025-10-20 08:40:00'),
(255, 'cable the', 'amv', 'U', 0, 5, 200, 195, 50, '2025-10-21 05:09:55', '2025-10-21 05:10:53');

-- --------------------------------------------------------

--
-- Structure de la table `stock_movements`
--

CREATE TABLE `stock_movements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('entrée','sortie','retour','emprunt') NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  `date_movement` timestamp NOT NULL DEFAULT current_timestamp(),
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stock_movements`
--

INSERT INTO `stock_movements` (`id`, `stock_id`, `type`, `reference`, `quantite`, `date_movement`, `note`, `created_at`, `updated_at`) VALUES
(1, 34, 'sortie', '3808538', 1, '2025-09-29 13:25:00', 'Ajoutée manuellement pour l\'article \'PEINTURE GRIS (ATLAS) 5KG\' (modifié)', '2025-09-29 02:42:25', '2025-09-30 08:16:17'),
(2, 5, 'sortie', '3808538', 1, '2025-09-29 13:25:00', 'Ajoutée manuellement pour l\'article \'PEINTURE GRIS (ENDES) 5KG\' (modifié)', '2025-09-29 02:44:42', '2025-09-30 08:15:02'),
(3, 8, 'sortie', NULL, 100, '2025-09-30 04:49:00', 'Ajoutée manuellement pour l\'article \'DISQUE 230x1,9x22 BLEU (TIGOR) 50P\'', '2025-09-30 02:49:38', '2025-09-30 02:49:38'),
(4, 37, 'sortie', NULL, 2, '2025-09-29 10:28:00', 'Ajoutée manuellement pour l\'article \'santofire\'', '2025-09-30 04:29:45', '2025-09-30 04:29:45'),
(5, 49, 'sortie', NULL, 1, '2025-09-29 10:29:00', 'Ajoutée manuellement pour l\'article \'pavite\'', '2025-09-30 04:32:39', '2025-09-30 04:32:39'),
(6, 51, 'sortie', NULL, 1, '2025-09-29 09:29:00', 'Ajoutée manuellement pour l\'article \'colla\' (modifié)', '2025-09-30 07:31:54', '2025-09-30 07:35:46'),
(9, 18, 'sortie', '3808537', 12, '2025-09-30 08:47:00', 'Ajoutée manuellement pour l\'article \'POMULE\'', '2025-09-30 07:51:42', '2025-09-30 07:51:42'),
(10, 36, 'sortie', NULL, 2, '2025-09-30 07:51:00', 'Ajoutée manuellement pour l\'article \'crima\'', '2025-09-30 07:52:11', '2025-09-30 07:52:11'),
(11, 18, 'sortie', 'assaka mohmed', 30, '2025-09-30 09:53:00', 'Ajoutée manuellement pour l\'article \'POMULE\' (modifié)', '2025-09-30 07:52:56', '2025-10-11 12:25:06'),
(13, 58, 'entrée', 'BLC-2509-03039', 100, '2025-09-29 09:02:00', 'Ajoutée manuellement pour l\'article \'PEINTURE vert (ENDES) 5KG\'', '2025-09-30 08:04:51', '2025-09-30 08:04:51'),
(14, 58, 'sortie', '3808536', 2, '2025-09-30 08:05:00', 'Ajoutée manuellement pour l\'article \'PEINTURE vert (ENDES) 5KG\'', '2025-09-30 08:06:12', '2025-09-30 08:06:12'),
(17, 16, 'sortie', '38085335', 2, '2025-09-30 10:00:00', 'Ajoutée manuellement pour l\'article \'DILUANT 5L\'', '2025-09-30 08:23:43', '2025-09-30 08:23:43'),
(20, 19, 'entrée', 'BL-251187', 165, '2025-09-27 09:05:00', 'Ajoutée manuellement pour l\'article \'ECROU TIGE CALVA DIAM 8\'', '2025-09-30 10:08:02', '2025-09-30 10:08:02'),
(21, 19, 'sortie', 'mohamed asaka', 50, '2025-09-30 10:51:00', 'Ajoutée manuellement pour l\'article \'ECROU TIGE CALVA DIAM 8\'', '2025-09-30 10:10:15', '2025-09-30 10:10:15'),
(22, 58, 'sortie', '3808583', 4, '2025-09-30 12:23:00', 'Ajoutée manuellement pour l\'article \'PEINTURE vert (ENDES) 5KG\'', '2025-09-30 10:23:35', '2025-09-30 10:23:35'),
(23, 64, 'sortie', NULL, 1, '2025-09-29 13:02:00', 'Ajoutée manuellement pour l\'article \'selofane grand\'', '2025-09-30 13:03:03', '2025-09-30 13:03:03'),
(24, 61, 'sortie', NULL, 1, '2025-09-29 08:30:00', 'Ajoutée manuellement pour l\'article \'scotche blanche 72P\'', '2025-10-01 04:25:43', '2025-10-01 04:25:43'),
(25, 61, 'sortie', NULL, 1, '2025-09-29 08:25:00', 'Ajoutée manuellement pour l\'article \'scotche blanche 72P\'', '2025-10-01 04:27:38', '2025-10-01 04:27:38'),
(26, 62, 'sortie', '0099175 (empruntée en aluminium pour BA 13)', 6, '2025-09-28 06:57:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-01 08:30:55', '2025-10-01 08:30:55'),
(27, 62, 'sortie', '0099178 (empruntée en aluminium pour BA 13)', 6, '2025-09-30 08:50:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-01 04:58:53', '2025-10-01 04:58:53'),
(28, 62, 'sortie', '0099175 (empruntée en aluminium pour Marbre)', 1, '2025-09-29 08:23:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-01 05:11:04', '2025-10-01 05:11:04'),
(29, 62, 'sortie', '0099178 (empruntée en aluminium pour Marbre)', 1, '2025-09-29 12:30:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-01 05:11:59', '2025-10-01 05:11:59'),
(30, 64, 'sortie', NULL, 1, '2025-09-29 09:12:00', 'Ajoutée manuellement pour l\'article \'selofane grand\'', '2025-10-01 05:13:45', '2025-10-01 05:13:45'),
(31, 49, 'sortie', NULL, 1, '2025-09-30 10:13:00', 'Ajoutée manuellement pour l\'article \'pavite\'', '2025-10-01 05:18:09', '2025-10-01 05:18:09'),
(32, 62, 'sortie', NULL, 1, '2025-09-30 09:18:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-01 05:19:39', '2025-10-01 05:19:39'),
(33, 61, 'sortie', NULL, 1, '2025-09-30 13:30:00', 'Ajoutée manuellement pour l\'article \'scotche blanche 72P\'', '2025-10-01 05:20:37', '2025-10-01 05:20:37'),
(36, 65, 'sortie', NULL, 2, '2025-09-30 14:33:00', 'Ajoutée manuellement pour l\'article \'selofane petite\'', '2025-10-01 05:30:46', '2025-10-01 05:30:46'),
(37, 36, 'sortie', '0099172', 2, '2025-10-01 06:50:00', 'Ajoutée manuellement pour l\'article \'crima\'', '2025-10-01 05:47:46', '2025-10-01 05:47:46'),
(39, 38, 'sortie', '0099173', 2, '2025-10-01 06:50:00', 'Ajoutée manuellement pour l\'article \'disque 400\'', '2025-10-01 05:51:20', '2025-10-01 05:51:20'),
(40, 65, 'sortie', NULL, 1, '2025-10-01 07:23:00', 'Ajoutée manuellement pour l\'article \'selofane petite\'', '2025-10-01 05:54:07', '2025-10-01 05:54:07'),
(41, 61, 'sortie', NULL, 1, '2025-10-01 07:54:00', 'Ajoutée manuellement pour l\'article \'scotche blanche 72P\'', '2025-10-01 05:54:47', '2025-10-01 05:54:47'),
(42, 73, 'entrée', 'mohamed asaka', 42, '2025-09-29 12:30:00', 'It returns the bagit, but he left 42.', '2025-10-01 06:08:07', '2025-10-01 06:08:07'),
(43, 73, 'sortie', NULL, 12, '2025-10-01 08:08:00', 'Ajoutée manuellement pour l\'article \'bagitt\'', '2025-10-01 06:08:29', '2025-10-01 06:08:29'),
(44, 71, 'entrée', 'L2025018638', 5, '2025-10-01 07:30:00', 'Ajoutée manuellement pour l\'article \'lamone grande (MEULEUSE GWS 2700W BOSCH)\'', '2025-10-01 06:13:49', '2025-10-01 06:13:49'),
(45, 72, 'entrée', 'L2025018638', 3, '2025-10-01 07:30:00', 'Ajoutée manuellement pour l\'article \'lamone  petite (MEULEUSE GWS 270W BOSCH)\'', '2025-10-01 06:16:45', '2025-10-01 06:16:45'),
(46, 74, 'entrée', 'L2025018638', 5, '2025-10-01 07:30:00', 'Ajoutée manuellement pour l\'article \'meche a fer 20 inox bosch\'', '2025-10-01 06:17:14', '2025-10-01 06:17:14'),
(47, 76, 'entrée', 'L2025018638', 5, '2025-10-01 07:30:00', 'Ajoutée manuellement pour l\'article \'meche a fer 18 inox bosch\'', '2025-10-01 06:17:43', '2025-10-01 06:17:43'),
(48, 75, 'entrée', 'L2025018638', 5, '2025-10-01 07:30:00', 'Ajoutée manuellement pour l\'article \'meche a fer 16 inox bosch\'', '2025-10-01 06:18:08', '2025-10-01 06:18:08'),
(49, 74, 'sortie', 'youssef', 5, '2025-10-01 07:45:00', 'Ajoutée manuellement pour l\'article \'meche a fer 20 inox bosch\'', '2025-10-01 06:19:21', '2025-10-01 06:19:21'),
(50, 75, 'sortie', 'youssef', 5, '2025-10-01 07:45:00', 'Ajoutée manuellement pour l\'article \'meche a fer 16 inox bosch\'', '2025-10-01 06:19:54', '2025-10-01 06:19:54'),
(51, 76, 'sortie', 'youssef', 5, '2025-10-01 07:45:00', 'Ajoutée manuellement pour l\'article \'meche a fer 18 inox bosch\'', '2025-10-01 06:21:01', '2025-10-01 06:21:01'),
(52, 60, 'sortie', 'abdeljalil dinar', 1, '2025-10-01 17:28:00', 'Ajoutée manuellement pour l\'article \'selecone akfix 12P\'', '2025-10-01 06:28:27', '2025-10-01 06:28:27'),
(53, 60, 'sortie', 'Anas Bousebni', 12, '2025-10-01 08:38:00', 'Ajoutée manuellement pour l\'article \'selecone akfix 12P\'', '2025-10-01 06:38:13', '2025-10-01 06:38:13'),
(54, 23, 'sortie', 'bon transfert N 280', 10, '2025-10-01 07:55:00', 'Ajoutée manuellement pour l\'article \'CHEVILLES METALIQUE (WEDGE ANCHOR 4,8 GRADE) M10 35P\'', '2025-10-01 06:59:32', '2025-10-01 06:59:32'),
(55, 25, 'sortie', 'bon transfert N 280', 18, '2025-10-01 07:55:00', 'Ajoutée manuellement pour l\'article \'RULI GUIDA\'', '2025-10-01 07:00:26', '2025-10-01 07:00:26'),
(56, 73, 'sortie', 'bon transfert N 280', 1, '2025-10-01 07:55:00', 'quantite 120 (about half of box)', '2025-10-01 07:03:57', '2025-10-01 07:03:57'),
(57, 62, 'sortie', 'zakariya basir', 1, '2025-10-01 09:55:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-01 07:55:21', '2025-10-01 07:55:21'),
(58, 62, 'sortie', 'Nabile Marbre', 2, '2025-10-01 10:12:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-01 08:12:34', '2025-10-01 08:12:34'),
(59, 16, 'sortie', '3808531', 2, '2025-10-01 12:53:00', 'Ajoutée manuellement pour l\'article \'DILUANT 5L\'', '2025-10-01 10:53:25', '2025-10-01 10:53:25'),
(60, 62, 'sortie', '0099179 (empruntée en aluminium pour BA 13)', 6, '2025-10-01 13:38:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-01 11:38:54', '2025-10-01 11:38:54'),
(61, 60, 'sortie', 'arabi ali', 1, '2025-10-01 14:21:00', 'Ajoutée manuellement pour l\'article \'selecone akfix 12P\'', '2025-10-01 12:21:25', '2025-10-01 12:21:25'),
(62, 80, 'sortie', 'najah mohmed', 1, '2025-10-02 06:44:00', 'Ajoutée manuellement pour l\'article \'pavite\'', '2025-10-02 04:44:58', '2025-10-02 04:44:58'),
(63, 16, 'sortie', '3808527', 4, '2025-10-02 06:44:00', 'Ajoutée manuellement pour l\'article \'DILUANT 5L\'', '2025-10-02 04:45:31', '2025-10-02 04:45:31'),
(64, 58, 'sortie', '3808530', 4, '2025-10-02 06:45:00', 'Ajoutée manuellement pour l\'article \'PEINTURE vert (ENDES) 5KG\'', '2025-10-02 04:46:05', '2025-10-02 04:46:05'),
(65, 38, 'sortie', '0099174', 4, '2025-10-02 06:46:00', 'Ajoutée manuellement pour l\'article \'disque 400\'', '2025-10-02 04:47:35', '2025-10-02 04:47:35'),
(66, 47, 'sortie', '0099174', 4, '2025-10-02 06:56:00', 'Ajoutée manuellement pour l\'article \'disque 220\'', '2025-10-02 04:57:09', '2025-10-02 04:57:09'),
(67, 85, 'entrée', '2281', 100, '2025-10-02 07:07:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-02 05:08:15', '2025-10-02 05:08:15'),
(68, 86, 'entrée', '2281', 48, '2025-10-02 07:08:00', 'Ajoutée manuellement pour l\'article \'les lunettes de protection\'', '2025-10-02 05:12:07', '2025-10-02 05:12:07'),
(69, 87, 'entrée', '2287', 5, '2025-10-02 07:12:00', 'Ajoutée manuellement pour l\'article \'masque de soudor couton\'', '2025-10-02 05:12:25', '2025-10-02 05:12:25'),
(70, 88, 'entrée', '2287', 8, '2025-10-02 07:12:00', 'Ajoutée manuellement pour l\'article \'masque resperatoire\'', '2025-10-02 05:13:12', '2025-10-02 05:13:12'),
(71, 89, 'entrée', '2285', 5, '2025-10-02 07:13:00', 'Ajoutée manuellement pour l\'article \'horrous complet\'', '2025-10-02 05:15:08', '2025-10-02 05:15:08'),
(72, 90, 'entrée', '2285', 4, '2025-10-02 07:15:00', 'Ajoutée manuellement pour l\'article \'stop chute nom\'', '2025-10-02 05:15:36', '2025-10-02 05:15:36'),
(73, 87, 'sortie', 'mohamed asaka', 5, '2025-10-02 07:15:00', 'Ajoutée manuellement pour l\'article \'masque de soudor couton\'', '2025-10-02 05:16:08', '2025-10-02 05:16:08'),
(74, 88, 'sortie', 'mohamed asaka', 8, '2025-10-02 07:16:00', 'Ajoutée manuellement pour l\'article \'masque resperatoire\'', '2025-10-02 05:16:31', '2025-10-02 05:16:31'),
(75, 62, 'sortie', 'zakariya chmi', 1, '2025-10-02 06:30:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-02 05:22:06', '2025-10-02 05:22:06'),
(76, 91, 'entrée', 'BL251202', 200, '2025-10-02 06:04:00', 'Ajoutée manuellement pour l\'article \'PAUMELLE 80\'', '2025-10-02 06:05:44', '2025-10-02 06:05:44'),
(77, 16, 'entrée', 'BL251203', 100, '2025-01-02 09:07:00', 'Ajoutée manuellement pour l\'article \'DULIANT 5L\'', '2025-10-02 06:08:19', '2025-10-02 06:08:19'),
(78, 91, 'entrée', 'BL251205', 4, '2025-10-02 08:10:00', 'Ajoutée manuellement pour l\'article \'PAUMELLE 80\'', '2025-10-02 06:11:00', '2025-10-02 06:11:00'),
(80, 92, 'sortie', 'youssef azwi', 1, '2025-10-02 08:06:00', 'Ajoutée manuellement pour l\'article \'les lunettes\'', '2025-10-02 08:06:45', '2025-10-02 08:06:45'),
(81, 61, 'sortie', 'Nafi3 lmhdawi', 1, '2025-10-02 10:06:00', 'Ajoutée manuellement pour l\'article \'scotche blanche 72P\'', '2025-10-02 08:09:18', '2025-10-02 08:09:18'),
(82, 91, 'sortie', 'mohamed asaka', 204, '2025-10-02 12:55:00', 'Ajoutée manuellement pour l\'article \'PAUMELLE 80\'', '2025-10-02 10:55:29', '2025-10-02 10:55:29'),
(83, 60, 'sortie', 'ABDERAZAK ZEKDIR', 1, '2025-10-02 13:01:00', 'Ajoutée manuellement pour l\'article \'selecone akfix 12P\'', '2025-10-02 11:01:47', '2025-10-02 11:01:47'),
(84, 94, 'sortie', NULL, 8, '2025-10-02 11:01:00', 'Ajoutée manuellement pour l\'article \'boite rouge\'', '2025-10-02 11:02:07', '2025-10-02 11:02:07'),
(85, 81, 'sortie', NULL, 1, '2025-10-02 13:04:00', 'Ajoutée manuellement pour l\'article \'PIED A COULISSE (nobel)\'', '2025-10-02 11:04:38', '2025-10-02 11:04:38'),
(86, 60, 'sortie', 'ANAS BOUSBINI', 1, '2025-10-02 13:07:00', 'Ajoutée manuellement pour l\'article \'selecone akfix 12P\' (modifié)', '2025-10-02 11:07:31', '2025-10-17 06:28:42'),
(87, 70, 'sortie', NULL, 1, '2025-10-02 13:08:00', 'Ajoutée manuellement pour l\'article \'bis 4x50 200p\'', '2025-10-02 11:09:03', '2025-10-02 11:09:03'),
(88, 69, 'sortie', NULL, 1, '2025-10-02 13:10:00', 'Ajoutée manuellement pour l\'article \'bis 4,8x60 300p\'', '2025-10-02 11:10:22', '2025-10-02 11:10:22'),
(89, 110, 'entrée', 'SANS BON FACTAIRE 34', 180, '2025-10-02 13:28:00', 'Ajoutée manuellement pour l\'article \'CLAME\'', '2025-10-02 11:29:17', '2025-10-02 11:29:17'),
(90, 80, 'sortie', 'abderahim louali', 1, '2025-10-02 13:40:00', 'Ajoutée manuellement pour l\'article \'pavite\'', '2025-10-02 11:40:55', '2025-10-02 11:40:55'),
(91, 80, 'sortie', 'mohsin aablou', 1, '2025-10-02 11:40:00', 'Ajoutée manuellement pour l\'article \'pavite\'', '2025-10-02 11:41:34', '2025-10-02 11:41:34'),
(92, 51, 'sortie', '0099180', 1, '2025-10-02 13:50:00', 'Ajoutée manuellement pour l\'article \'colla\'', '2025-10-02 11:50:37', '2025-10-02 11:50:37'),
(93, 72, 'sortie', 'mohamed asaka', 1, '2025-10-02 14:00:00', 'Ajoutée manuellement pour l\'article \'lamone  petite (MEULEUSE GWS 270W BOSCH)\'', '2025-10-02 12:00:40', '2025-10-02 12:00:40'),
(94, 36, 'sortie', '0099176', 3, '2025-10-02 12:00:00', 'Ajoutée manuellement pour l\'article \'crima\'', '2025-10-02 12:14:48', '2025-10-02 12:14:48'),
(95, 100, 'sortie', 'jamal lali', 100, '2025-10-03 06:19:00', 'Ajoutée manuellement pour l\'article \'CABLE 3G 2,5 MM\'', '2025-10-03 04:19:53', '2025-10-03 04:19:53'),
(96, 94, 'sortie', 'jamal lali', 12, '2025-10-03 06:22:00', 'Ajoutée manuellement pour l\'article \'boite rouge\'', '2025-10-03 04:22:07', '2025-10-03 04:22:07'),
(97, 62, 'sortie', 'ali arabi', 1, '2025-10-03 07:05:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-03 05:05:50', '2025-10-03 05:05:50'),
(98, 94, 'sortie', NULL, 10, '2025-09-29 05:21:00', 'Ajoutée manuellement pour l\'article \'boite rouge\'', '2025-10-03 05:21:30', '2025-10-03 05:21:30'),
(99, 94, 'sortie', NULL, 6, '2025-09-27 05:21:00', 'Ajoutée manuellement pour l\'article \'boite rouge\'', '2025-10-03 05:21:45', '2025-10-03 05:21:45'),
(100, 96, 'sortie', NULL, 4, '2025-09-29 05:21:00', 'Ajoutée manuellement pour l\'article \'DOUILLES\'', '2025-10-03 05:22:37', '2025-10-03 05:22:37'),
(101, 96, 'sortie', NULL, 6, '2025-10-02 05:22:00', 'Ajoutée manuellement pour l\'article \'DOUILLES\'', '2025-10-03 05:22:51', '2025-10-03 05:22:51'),
(102, 97, 'sortie', NULL, 4, '2025-09-29 05:22:00', 'Ajoutée manuellement pour l\'article \'PRISE\'', '2025-10-03 05:23:08', '2025-10-03 05:23:08'),
(103, 97, 'sortie', NULL, 6, '2025-10-02 05:23:00', 'Ajoutée manuellement pour l\'article \'PRISE\'', '2025-10-03 05:24:11', '2025-10-03 05:24:11'),
(104, 97, 'sortie', NULL, 10, '2025-09-29 05:24:00', 'Ajoutée manuellement pour l\'article \'PRISE\'', '2025-10-03 05:24:37', '2025-10-03 05:24:37'),
(105, 97, 'sortie', NULL, 14, '2025-10-01 05:24:00', 'Ajoutée manuellement pour l\'article \'PRISE\'', '2025-10-03 05:25:00', '2025-10-03 05:25:00'),
(106, 95, 'sortie', NULL, 4, '2025-09-29 05:25:00', 'Ajoutée manuellement pour l\'article \'SAROTE\'', '2025-10-03 05:25:39', '2025-10-03 05:25:39'),
(107, 95, 'sortie', NULL, 10, '2025-09-29 05:25:00', 'Ajoutée manuellement pour l\'article \'SAROTE\'', '2025-10-03 05:26:02', '2025-10-03 05:26:02'),
(108, 95, 'sortie', NULL, 20, '2025-10-01 05:26:00', 'Ajoutée manuellement pour l\'article \'SAROTE\'', '2025-10-03 05:26:43', '2025-10-03 05:26:43'),
(109, 92, 'sortie', 'Nafi elmhdawi', 1, '2025-10-03 05:28:00', 'Ajoutée manuellement pour l\'article \'les lunettes\'', '2025-10-03 05:28:58', '2025-10-03 05:28:58'),
(110, 62, 'sortie', '0099181 (empruntée en aluminium pour BA 13)', 6, '2025-10-03 05:37:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-03 05:38:44', '2025-10-03 05:38:44'),
(111, 85, 'sortie', 'ANAS BOUSBINi', 1, '2025-10-03 08:20:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-03 06:21:24', '2025-10-03 06:21:24'),
(112, 85, 'sortie', 'Amine boutasa', 1, '2025-10-03 08:22:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-03 06:22:16', '2025-10-03 06:22:16'),
(113, 85, 'sortie', 'Nafi elmhdawi', 1, '2025-10-03 08:22:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-03 06:22:40', '2025-10-03 06:22:40'),
(114, 85, 'sortie', 'abdelkrim khaoui', 1, '2025-10-03 08:24:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-03 06:25:04', '2025-10-03 06:25:04'),
(115, 85, 'sortie', 'mohsin aablou', 1, '2025-10-03 08:29:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-03 06:29:12', '2025-10-03 06:29:12'),
(116, 85, 'sortie', 'mohemed amine waferdo', 1, '2025-10-03 06:29:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-03 06:29:55', '2025-10-03 06:29:55'),
(117, 85, 'sortie', 'adberahim elouali', 1, '2025-10-03 08:29:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-03 06:31:27', '2025-10-03 06:31:27'),
(118, 118, 'entrée', '2292', 10, '2025-10-03 06:32:00', 'Ajoutée manuellement pour l\'article \'combinaison alum\'', '2025-10-03 06:32:59', '2025-10-03 06:32:59'),
(119, 113, 'entrée', '2293', 24, '2025-10-03 06:32:00', 'Ajoutée manuellement pour l\'article \'pontalon (L)\'', '2025-10-03 06:33:24', '2025-10-03 06:33:24'),
(120, 114, 'entrée', '2293', 15, '2025-10-03 06:33:00', 'Ajoutée manuellement pour l\'article \'pontalon (xL)\'', '2025-10-03 06:33:48', '2025-10-03 06:33:48'),
(121, 115, 'entrée', '2293', 11, '2025-10-03 06:33:00', 'Ajoutée manuellement pour l\'article \'pontalon (xxL)\'', '2025-10-03 06:34:02', '2025-10-03 06:34:02'),
(122, 116, 'entrée', '2293', 10, '2025-10-03 06:34:00', 'Ajoutée manuellement pour l\'article \'veste (L)\'', '2025-10-03 06:34:14', '2025-10-03 06:34:14'),
(123, 117, 'entrée', '2293', 16, '2025-10-03 06:34:00', 'Ajoutée manuellement pour l\'article \'veste (XL)\'', '2025-10-03 06:35:19', '2025-10-03 06:35:19'),
(124, 100, 'sortie', NULL, 100, '2025-10-03 06:42:00', 'Ajoutée manuellement pour l\'article \'CABLE 3G 2,5 MM\'', '2025-10-03 06:43:12', '2025-10-03 06:43:12'),
(125, 96, 'sortie', NULL, 10, '2025-10-03 06:43:00', 'Ajoutée manuellement pour l\'article \'DOUILLES\'', '2025-10-03 06:43:24', '2025-10-03 06:43:24'),
(126, 85, 'sortie', 'Azdin kamio', 1, '2025-10-02 06:43:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-03 07:04:24', '2025-10-03 07:04:24'),
(127, 106, 'sortie', NULL, 2, '2025-09-27 07:21:00', 'Ajoutée manuellement pour l\'article \'FICHE 2P + T FEMELLE 16 A 220 V\'', '2025-10-03 07:21:39', '2025-10-03 07:21:39'),
(128, 119, 'sortie', NULL, 2, '2025-09-27 07:21:00', 'Ajoutée manuellement pour l\'article \'FICHE T male\'', '2025-10-03 07:22:04', '2025-10-03 07:22:04'),
(129, 118, 'sortie', 'ANAS BOUSSEBNi', 1, '2025-10-03 07:22:00', 'Ajoutée manuellement pour l\'article \'combinaison alum\'', '2025-10-03 07:25:23', '2025-10-03 07:25:23'),
(130, 38, 'sortie', '0099178', 1, '2025-10-03 07:30:00', 'Ajoutée manuellement pour l\'article \'disque 400\'', '2025-10-03 07:33:16', '2025-10-03 07:33:16'),
(131, 85, 'sortie', 'abdeljalil dinar', 1, '2025-10-03 07:33:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-03 07:33:44', '2025-10-03 07:33:44'),
(132, 85, 'sortie', 'adberazak zegdi', 1, '2025-10-03 07:33:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-03 07:38:51', '2025-10-03 07:38:51'),
(133, 85, 'sortie', 'Abderhmen Akleli', 1, '2025-10-03 07:38:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-03 07:42:30', '2025-10-03 07:42:30'),
(134, 85, 'sortie', 'abdelah bouraja', 1, '2025-10-03 07:42:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-03 07:47:16', '2025-10-03 07:47:16'),
(135, 85, 'sortie', 'Ilyas Elchababe', 1, '2025-10-03 07:53:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-03 07:54:43', '2025-10-03 07:54:43'),
(136, 118, 'sortie', 'Abdellah el haoukali', 1, '2025-10-03 07:54:00', 'Ajoutée manuellement pour l\'article \'combinaison alum\'', '2025-10-03 07:59:37', '2025-10-03 07:59:37'),
(137, 62, 'sortie', 'Ilyas Elchababe', 2, '2025-10-03 07:59:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-03 08:00:50', '2025-10-03 08:00:50'),
(138, 85, 'sortie', 'ali arabi', 1, '2025-10-03 08:00:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-03 08:08:46', '2025-10-03 08:08:46'),
(139, 85, 'sortie', 'youssef azwi', 1, '2025-10-03 08:08:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-03 08:09:08', '2025-10-03 08:09:08'),
(140, 85, 'sortie', 'amine idbla', 1, '2025-10-03 08:09:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-03 08:10:18', '2025-10-03 08:10:18'),
(141, 92, 'sortie', 'amine idbla', 1, '2025-10-03 08:10:00', 'Ajoutée manuellement pour l\'article \'les lunettes\'', '2025-10-03 08:13:46', '2025-10-03 08:13:46'),
(142, 110, 'sortie', 'abderahim louali', 20, '2025-10-03 08:13:00', 'Ajoutée manuellement pour l\'article \'CLAME\'', '2025-10-03 08:17:44', '2025-10-03 08:17:44'),
(143, 118, 'sortie', 'oussama  lkhrouni', 1, '2025-10-03 08:18:00', 'Ajoutée manuellement pour l\'article \'combinaison alum\'', '2025-10-03 08:38:58', '2025-10-03 08:38:58'),
(144, 85, 'sortie', 'oussama  lkhrouni', 1, '2025-10-03 08:38:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-03 08:43:42', '2025-10-03 08:43:42'),
(145, 85, 'sortie', 'anas Bousselem', 1, '2025-10-03 08:43:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-03 08:44:30', '2025-10-03 08:44:30'),
(146, 85, 'sortie', 'ahmed Bellbiyad', 1, '2025-10-03 08:44:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-03 08:50:52', '2025-10-03 08:50:52'),
(147, 97, 'sortie', '4471', 5, '2025-10-03 11:25:00', 'Ajoutée manuellement pour l\'article \'PRISE\'', '2025-10-03 11:25:43', '2025-10-03 11:25:43'),
(148, 118, 'sortie', 'Abderhmen Akleli', 1, '2025-10-03 11:25:00', 'Ajoutée manuellement pour l\'article \'combinaison alum\'', '2025-10-03 11:27:15', '2025-10-03 11:27:15'),
(149, 118, 'sortie', 'ahmed Bellbiyad', 1, '2025-10-03 11:27:00', 'Ajoutée manuellement pour l\'article \'combinaison alum\'', '2025-10-03 11:27:49', '2025-10-03 11:27:49'),
(150, 118, 'sortie', 'abdeljalil dinar', 1, '2025-10-03 11:27:00', 'Ajoutée manuellement pour l\'article \'combinaison alum\'', '2025-10-03 11:28:21', '2025-10-03 11:28:21'),
(151, 113, 'sortie', 'hamed soudor', 24, '2025-10-03 11:28:00', 'Ajoutée manuellement pour l\'article \'pontalon (L)\'', '2025-10-03 11:29:20', '2025-10-03 11:29:20'),
(152, 114, 'sortie', 'hamed soudor', 15, '2025-10-03 11:29:00', 'Ajoutée manuellement pour l\'article \'pontalon (xL)\'', '2025-10-03 11:29:45', '2025-10-03 11:29:45'),
(153, 115, 'sortie', 'hamed soudor', 11, '2025-10-03 11:29:00', 'Ajoutée manuellement pour l\'article \'pontalon (xxL)\'', '2025-10-03 11:30:03', '2025-10-03 11:30:03'),
(154, 116, 'sortie', 'hamed soudor (à retour)', 10, '2025-10-03 11:30:00', 'Ajoutée manuellement pour l\'article \'veste (L)\'', '2025-10-03 11:44:05', '2025-10-03 11:44:05'),
(155, 117, 'sortie', 'hamed soudor (à retour)', 16, '2025-10-03 11:44:00', 'Ajoutée manuellement pour l\'article \'veste (XL)\'', '2025-10-03 11:45:55', '2025-10-03 11:45:55'),
(156, 118, 'sortie', '5519', 1, '2025-10-03 11:45:00', 'Ajoutée manuellement pour l\'article \'combinaison alum\'', '2025-10-03 11:48:21', '2025-10-03 11:48:21'),
(157, 118, 'sortie', '5477', 1, '2025-10-03 11:48:00', 'Ajoutée manuellement pour l\'article \'combinaison alum\'', '2025-10-03 11:49:28', '2025-10-03 11:49:28'),
(158, 58, 'sortie', '3808528', 2, '2025-10-03 11:54:00', 'Ajoutée manuellement pour l\'article \'PEINTURE vert (ENDES) 5KG\'', '2025-10-03 11:55:32', '2025-10-03 11:55:32'),
(159, 62, 'sortie', '5340', 1, '2025-10-03 14:40:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-03 12:23:17', '2025-10-03 12:23:17'),
(160, 60, 'sortie', '5428', 1, '2025-10-03 12:27:00', 'Ajoutée manuellement pour l\'article \'selecone akfix 12P\'', '2025-10-03 12:28:29', '2025-10-03 12:28:29'),
(161, 120, 'entrée', 'B250114685', 1, '2025-10-03 12:43:00', 'Ajoutée manuellement pour l\'article \'cable 10 souple noir 50 m\'', '2025-10-03 12:45:14', '2025-10-03 12:45:14'),
(162, 57, 'sortie', 'azize Marbre', 3, '2025-10-04 07:27:00', 'Ajoutée manuellement pour l\'article \'tipe\'', '2025-10-04 07:27:58', '2025-10-04 07:27:58'),
(163, 37, 'sortie', 'azize Marbre', 1, '2025-10-04 07:27:00', 'Ajoutée manuellement pour l\'article \'santofire\'', '2025-10-04 07:28:12', '2025-10-04 07:28:12'),
(164, 37, 'sortie', 'mohamed asaka', 6, '2025-10-04 07:28:00', 'Ajoutée manuellement pour l\'article \'santofire\'', '2025-10-04 07:28:35', '2025-10-04 07:28:35'),
(165, 57, 'sortie', 'mohamed asaka', 6, '2025-10-04 07:28:00', 'Ajoutée manuellement pour l\'article \'tipe\'', '2025-10-04 07:28:55', '2025-10-04 07:28:55'),
(166, 60, 'sortie', NULL, 1, '2025-10-04 07:29:00', 'Ajoutée manuellement pour l\'article \'selecone akfix 12P\'', '2025-10-04 07:30:14', '2025-10-04 07:30:14'),
(167, 85, 'sortie', 'anasa Enouni', 1, '2025-10-04 07:30:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-04 07:30:51', '2025-10-04 07:30:51'),
(168, 62, 'sortie', '5428', 1, '2025-10-04 07:30:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-04 07:38:48', '2025-10-04 07:38:48'),
(169, 62, 'sortie', '5181', 1, '2025-10-04 08:31:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-04 08:32:19', '2025-10-04 08:32:19'),
(170, 85, 'sortie', 'oussama  fatihi', 1, '2025-10-04 08:32:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-04 08:33:12', '2025-10-04 08:33:12'),
(171, 66, 'sortie', '5181', 1, '2025-10-04 08:33:00', 'Ajoutée manuellement pour l\'article \'bis 4x40 80x200P\'', '2025-10-04 08:34:05', '2025-10-04 08:34:05'),
(172, 122, 'sortie', '5181', 1, '2025-10-04 08:34:00', 'Ajoutée manuellement pour l\'article \'roullette plastique (rwayde)\'', '2025-10-04 08:35:28', '2025-10-04 08:35:28'),
(173, 137, 'sortie', '5181', 1, '2025-10-04 08:46:00', 'Ajoutée manuellement pour l\'article \'CLAME 70\'', '2025-10-04 08:46:46', '2025-10-04 08:46:46'),
(174, 51, 'entrée', '2530', 20, '2025-10-04 11:13:00', 'Ajoutée manuellement pour l\'article \'colla\'', '2025-10-04 10:16:36', '2025-10-04 10:16:36'),
(175, 52, 'entrée', '2529', 300, '2025-10-04 10:22:00', 'Ajoutée manuellement pour l\'article \'scotche\'', '2025-10-04 10:22:58', '2025-10-04 10:22:58'),
(176, 124, 'entrée', '25100208', 12, '2025-10-04 10:57:00', 'Ajoutée manuellement pour l\'article \'paumelle noir\'', '2025-10-04 10:58:53', '2025-10-04 10:58:53'),
(177, 141, 'entrée', '25100208', 4, '2025-10-04 11:19:00', 'Ajoutée manuellement pour l\'article \'serrure 30 mm\'', '2025-10-04 11:20:00', '2025-10-04 11:20:00'),
(178, 142, 'entrée', '25100208', 30, '2025-10-04 11:20:00', 'Ajoutée manuellement pour l\'article \'tasseau petite\'', '2025-10-04 11:20:21', '2025-10-04 11:20:21'),
(179, 131, 'entrée', '25100208', 4, '2025-10-04 11:22:00', 'Ajoutée manuellement pour l\'article \'poignee bequille\'', '2025-10-04 11:22:51', '2025-10-04 11:22:51'),
(180, 143, 'entrée', '25100208', 16, '2025-10-04 11:22:00', 'Ajoutée manuellement pour l\'article \'equerre ouvrant dormant fenetre s46\'', '2025-10-04 11:23:20', '2025-10-04 11:23:20'),
(181, 144, 'entrée', '25100208', 16, '2025-10-04 11:23:00', 'Ajoutée manuellement pour l\'article \'equerre ouvrant porte s46\'', '2025-10-04 11:23:35', '2025-10-04 11:23:35'),
(184, 62, 'sortie', 'empruntée en aluminium pour BA 13', 1, '2025-09-29 11:40:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-04 11:40:30', '2025-10-04 11:40:30'),
(185, 52, 'sortie', '0099182', 6, '2025-10-04 13:40:00', 'Ajoutée manuellement pour l\'article \'scotche\'', '2025-10-04 11:43:24', '2025-10-04 11:43:24'),
(186, 50, 'sortie', '4990', 1, '2025-10-02 09:10:00', 'Ajoutée manuellement pour l\'article \'les lunettes\'', '2025-10-04 11:57:42', '2025-10-04 11:57:42'),
(187, 45, 'sortie', '0099175', 2, '2025-09-29 12:10:00', 'Ajoutée manuellement pour l\'article \'cochita\'', '2025-10-04 12:13:42', '2025-10-04 12:13:42'),
(188, 39, 'sortie', '0099178', 2, '2025-10-03 12:29:00', 'Ajoutée manuellement pour l\'article \'disque 320\'', '2025-10-04 12:30:26', '2025-10-04 12:30:26'),
(189, 61, 'sortie', NULL, 2, '2025-10-01 12:33:00', 'Ajoutée manuellement pour l\'article \'scotche blanche 72P\'', '2025-10-04 12:34:09', '2025-10-04 12:34:09'),
(190, 64, 'sortie', 'empruntée en aluminium pour Marbre', 1, '2025-10-01 12:36:00', 'Ajoutée manuellement pour l\'article \'soulofan grand\'', '2025-10-04 12:38:10', '2025-10-04 12:38:10'),
(191, 62, 'sortie', 'empruntée en aluminium pour Marbre', 4, '2025-10-01 12:38:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-04 12:39:05', '2025-10-04 12:39:05'),
(193, 8, 'sortie', '4028', 50, '2025-10-04 09:25:00', 'Ajoutée manuellement pour l\'article \'DISQUE 230x1,9x22 BLEU (TIGOR) 50P\'', '2025-10-04 13:12:08', '2025-10-04 13:12:08'),
(194, 31, 'sortie', '5426', 1, '2025-10-04 13:12:00', 'Ajoutée manuellement pour l\'article \'SBAT 41  (ENVIRON)\'', '2025-10-04 13:15:19', '2025-10-04 13:15:19'),
(199, 85, 'sortie', 'Transfert de l’aluminium à Marber (déjà emprunté en aluminium)', 30, '2025-10-06 06:30:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-06 04:33:37', '2025-10-06 04:33:37'),
(200, 145, 'entrée', 'Transfert de l’aluminium à Marber', 30, '2025-10-06 06:35:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-06 04:36:46', '2025-10-06 04:36:46'),
(201, 145, 'sortie', 'mourad choukaira', 1, '2025-10-06 06:38:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-06 04:39:59', '2025-10-06 04:39:59'),
(202, 145, 'sortie', 'Mohmed El Motaouakil', 1, '2025-10-06 06:39:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-06 04:41:13', '2025-10-06 04:41:13'),
(203, 145, 'sortie', 'Abdelfatah Belgout', 1, '2025-10-06 06:52:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-06 04:52:51', '2025-10-06 04:52:51'),
(204, 8, 'sortie', '4717', 10, '2025-10-05 10:15:00', 'Ajoutée manuellement pour l\'article \'DISQUE 230x1,9x22 BLEU (TIGOR) 50P\'', '2025-10-06 05:42:02', '2025-10-06 05:42:02'),
(206, 60, 'sortie', NULL, 1, '2025-09-30 05:47:00', 'Ajoutée manuellement pour l\'article \'selecone akfix 12P\'', '2025-10-06 06:00:17', '2025-10-06 06:00:17'),
(207, 33, 'sortie', '3808511', 25, '2025-10-06 08:08:00', 'Ajoutée manuellement pour l\'article \'DISQUE 300x3,5x25,4 MM NOIRE (ATLAS) 25P\'', '2025-10-06 06:08:13', '2025-10-06 06:08:13'),
(208, 140, 'sortie', 'Rachid aluminium', 1, '2025-10-04 06:12:00', 'Ajoutée manuellement pour l\'article \'roullo Blanche\'', '2025-10-06 06:17:51', '2025-10-06 06:17:51'),
(209, 60, 'sortie', '3997', 1, '2025-10-04 06:17:00', 'Ajoutée manuellement pour l\'article \'selecone akfix 12P\'', '2025-10-06 06:23:12', '2025-10-06 06:23:12'),
(210, 85, 'sortie', 'Ennady Abdessamia', 1, '2025-10-04 06:23:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-06 06:25:12', '2025-10-06 06:25:12'),
(211, 65, 'sortie', '5342', 5, '2025-10-04 06:25:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-06 06:25:59', '2025-10-06 06:25:59'),
(212, 51, 'sortie', '0099183', 1, '2025-10-06 06:26:00', 'Ajoutée manuellement pour l\'article \'colla\'', '2025-10-06 06:41:31', '2025-10-06 06:41:31'),
(213, 62, 'sortie', '4434', 1, '2025-10-04 06:56:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-06 06:56:50', '2025-10-06 06:56:50'),
(214, 85, 'sortie', 'Mahdaoui Nafia', 1, '2025-10-04 06:56:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-06 06:58:31', '2025-10-06 06:58:31'),
(215, 85, 'sortie', 'Basghir Zakaria', 1, '2025-10-04 06:58:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-06 06:59:37', '2025-10-06 06:59:37'),
(216, 118, 'sortie', 'El Fatihi Oussama', 1, '2025-10-04 06:59:00', 'Ajoutée manuellement pour l\'article \'comblison alum\'', '2025-10-06 07:00:59', '2025-10-06 07:00:59'),
(217, 62, 'sortie', 'hicham embalage', 1, '2025-10-04 07:01:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-06 07:09:08', '2025-10-06 07:09:08'),
(218, 85, 'sortie', 'EL BALGHITI ABDELKHALEK', 1, '2025-10-06 07:18:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-06 07:19:33', '2025-10-06 07:19:33'),
(219, 85, 'sortie', 'SOUFIANE ENNOUNI', 1, '2025-10-06 07:19:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-06 07:20:23', '2025-10-06 07:20:23'),
(220, 85, 'sortie', 'amzil ayoub', 1, '2025-10-06 07:23:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-06 07:23:42', '2025-10-06 07:23:42'),
(221, 118, 'sortie', 'amzil ayoub', 1, '2025-10-06 07:23:00', 'Ajoutée manuellement pour l\'article \'comblison alum\'', '2025-10-06 07:24:18', '2025-10-06 07:24:18'),
(222, 141, 'sortie', '5123', 4, '2025-10-06 07:24:00', 'Ajoutée manuellement pour l\'article \'serrure 30 mm\'', '2025-10-06 07:28:01', '2025-10-06 07:28:01'),
(223, 124, 'sortie', '5123', 12, '2025-10-06 07:28:00', 'Ajoutée manuellement pour l\'article \'paumelle noir\'', '2025-10-06 07:28:39', '2025-10-06 07:28:39'),
(224, 131, 'sortie', '5123', 4, '2025-10-06 07:28:00', 'Ajoutée manuellement pour l\'article \'poignee bequille\'', '2025-10-06 07:29:14', '2025-10-06 07:29:14'),
(225, 142, 'sortie', '5123', 30, '2025-10-06 07:29:00', 'Ajoutée manuellement pour l\'article \'tasseau petite\'', '2025-10-06 07:29:42', '2025-10-06 07:29:42'),
(226, 144, 'sortie', '5123', 16, '2025-10-06 07:29:00', 'Ajoutée manuellement pour l\'article \'equerre ouvrant porte s46\'', '2025-10-06 07:30:00', '2025-10-06 07:30:00'),
(227, 143, 'sortie', '5123', 16, '2025-10-06 07:30:00', 'Ajoutée manuellement pour l\'article \'equerre ouvrant dormant fenetre s46\'', '2025-10-06 07:30:30', '2025-10-06 07:30:30'),
(228, 60, 'sortie', '4388', 1, '2025-10-06 07:32:00', 'Ajoutée manuellement pour l\'article \'selecone akfix 12P\'', '2025-10-06 07:32:43', '2025-10-06 07:32:43'),
(229, 65, 'sortie', '5342', 3, '2025-10-06 07:32:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-06 07:33:37', '2025-10-06 07:33:37'),
(230, 39, 'sortie', '4535', 1, '2025-10-06 07:33:00', 'Ajoutée manuellement pour l\'article \'disque 320\'', '2025-10-06 07:37:07', '2025-10-06 07:37:07'),
(231, 112, 'sortie', NULL, 1, '2025-09-27 07:37:00', 'Ajoutée manuellement pour l\'article \'CABLE  1,5 MM\'', '2025-10-06 07:40:04', '2025-10-06 07:40:04'),
(232, 146, 'sortie', NULL, 1, '2025-09-27 07:43:00', 'Ajoutée manuellement pour l\'article \'projecteur\'', '2025-10-06 07:43:53', '2025-10-06 07:43:53'),
(233, 96, 'sortie', NULL, 7, '2025-10-01 07:49:00', 'Ajoutée manuellement pour l\'article \'DOUILLES\'', '2025-10-06 07:53:13', '2025-10-06 07:53:13'),
(234, 101, 'sortie', '4471', 18, '2025-10-04 08:01:00', 'Ajoutée manuellement pour l\'article \'CABLE 5G 2,5 MM 100 m\'', '2025-10-06 08:02:00', '2025-10-06 08:02:00'),
(235, 94, 'sortie', '4692', 12, '2025-10-04 08:02:00', 'Ajoutée manuellement pour l\'article \'boite rouge\'', '2025-10-06 08:02:34', '2025-10-06 08:02:34'),
(236, 95, 'sortie', '4471', 5, '2025-10-04 08:02:00', 'Ajoutée manuellement pour l\'article \'SAROTE\' (modifié)', '2025-10-06 08:03:00', '2025-10-06 08:04:11'),
(237, 97, 'sortie', '4471', 5, '2025-10-04 08:03:00', 'Ajoutée manuellement pour l\'article \'PRISE\' (modifié)', '2025-10-06 08:03:18', '2025-10-06 08:03:53'),
(238, 96, 'sortie', '4471', 5, '2025-10-04 08:04:00', 'Ajoutée manuellement pour l\'article \'DOUILLES\' (modifié)', '2025-10-06 08:04:56', '2025-10-06 08:05:14'),
(239, 58, 'sortie', '4256101', 4, '2025-10-06 08:45:00', 'Ajoutée manuellement pour l\'article \'PEINTURE vert (ENDES) 5KG\'', '2025-10-06 08:46:18', '2025-10-06 08:46:18'),
(240, 16, 'sortie', '4256101', 4, '2025-10-06 08:46:00', 'Ajoutée manuellement pour l\'article \'DILUANT (ENDES) 5L\'', '2025-10-06 08:46:48', '2025-10-06 08:46:48'),
(242, 86, 'sortie', '4675', 13, '2025-10-06 10:15:00', 'Ajoutée manuellement pour l\'article \'les lunettes de protection\' (modifié)', '2025-10-06 10:16:24', '2025-10-06 11:47:48'),
(243, 98, 'sortie', '4692', 1, '2025-10-06 10:16:00', 'Ajoutée manuellement pour l\'article \'DIJONCTEUR C63\'', '2025-10-06 10:17:04', '2025-10-06 10:17:04'),
(244, 148, 'entrée', 'BL251187', 165, '2025-09-27 10:10:00', 'Ajoutée manuellement pour l\'article \'ECROU CALVA DIAM 8\'', '2025-10-06 10:20:06', '2025-10-06 10:20:06'),
(245, 1, 'sortie', '3808510', 1, '2025-10-06 11:28:00', 'Ajoutée manuellement pour l\'article \'PEINTURE ROUGE (LOGICOLOR) 5KG\'', '2025-10-06 11:29:20', '2025-10-06 11:29:20'),
(246, 18, 'sortie', 'adil', 4, '2025-10-06 11:29:00', 'Ajoutée manuellement pour l\'article \'PAUMELLE 100\'', '2025-10-06 11:31:50', '2025-10-06 11:31:50'),
(247, 65, 'sortie', '5342', 3, '2025-10-06 11:32:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-06 11:32:56', '2025-10-06 11:32:56'),
(248, 62, 'sortie', '5519', 1, '2025-10-06 11:32:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-06 11:37:40', '2025-10-06 11:37:40'),
(249, 94, 'sortie', '4077', 2, '2025-10-06 08:50:00', 'Ajoutée manuellement pour l\'article \'boite rouge\'', '2025-10-06 11:42:52', '2025-10-11 04:25:51'),
(250, 97, 'sortie', '4077', 4, '2025-10-06 11:42:00', 'Ajoutée manuellement pour l\'article \'PRISE\'', '2025-10-06 11:43:12', '2025-10-11 04:23:01'),
(251, 95, 'sortie', '4077', 2, '2025-10-06 11:43:00', 'Ajoutée manuellement pour l\'article \'SAROTE\'', '2025-10-06 11:43:26', '2025-10-11 04:24:06'),
(252, 96, 'sortie', '4077', 2, '2025-10-06 11:43:00', 'Ajoutée manuellement pour l\'article \'DOUILLES\'', '2025-10-06 11:43:42', '2025-10-11 04:24:58'),
(253, 100, 'sortie', '4077', 100, '2025-10-06 11:43:00', 'Ajoutée manuellement pour l\'article \'CABLE 3G 2,5 MM\'', '2025-10-06 11:44:00', '2025-10-06 11:44:00'),
(254, 61, 'sortie', '5340', 1, '2025-10-06 11:44:00', 'Ajoutée manuellement pour l\'article \'scotche blanche 72P\'', '2025-10-06 11:53:58', '2025-10-06 11:53:58'),
(255, 40, 'entrée', 'L2025019114', 400, '2025-10-06 12:55:00', 'Ajoutée manuellement pour l\'article \'disque 120\'', '2025-10-06 12:57:27', '2025-10-06 12:57:27'),
(256, 47, 'entrée', 'L2025019114', 400, '2025-10-06 12:57:00', 'Ajoutée manuellement pour l\'article \'disque 220\'', '2025-10-06 12:58:39', '2025-10-06 12:58:39'),
(257, 38, 'sortie', NULL, 1, '2025-10-01 13:01:00', 'Ajoutée manuellement pour l\'article \'disque 400\'', '2025-10-06 13:01:27', '2025-10-06 13:01:27'),
(258, 38, 'entrée', 'L2025019114', 400, '2025-10-06 13:01:00', 'Ajoutée manuellement pour l\'article \'disque 400\'', '2025-10-06 13:01:55', '2025-10-06 13:01:55'),
(259, 147, 'entrée', '24645', 15, '2025-10-06 13:01:00', 'Ajoutée manuellement pour l\'article \'projecteur petite (brobus)\'', '2025-10-06 13:03:51', '2025-10-06 13:03:51'),
(260, 47, 'sortie', '0099180', 6, '2025-10-07 04:24:00', 'Ajoutée manuellement pour l\'article \'disque 220\'', '2025-10-07 04:25:02', '2025-10-07 04:25:02'),
(261, 38, 'sortie', '0099180', 4, '2025-10-07 04:25:00', 'Ajoutée manuellement pour l\'article \'disque 400\'', '2025-10-07 04:25:28', '2025-10-07 04:25:28'),
(262, 137, 'sortie', '5319', 1, '2025-10-07 04:52:00', 'Ajoutée manuellement pour l\'article \'CLAME 70\'', '2025-10-07 04:53:30', '2025-10-07 04:53:30'),
(264, 101, 'entrée', '24645', 400, '2025-10-06 13:00:00', 'Ajoutée manuellement pour l\'article \'CABLE 5G 2,5 MM 100 m\'', '2025-10-07 05:02:51', '2025-10-07 05:02:51'),
(265, 100, 'entrée', '24645', 500, '2025-10-06 13:06:00', 'Ajoutée manuellement pour l\'article \'CABLE 3G 2,5 MM 100m\'', '2025-10-07 05:07:35', '2025-10-07 05:07:35'),
(266, 112, 'entrée', '24645', 300, '2025-10-06 13:07:00', 'Ajoutée manuellement pour l\'article \'CABLE 3G 1,5 MM 100m\'', '2025-10-07 05:08:55', '2025-10-07 05:08:55'),
(267, 62, 'sortie', '5428', 1, '2025-10-07 05:11:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-07 05:18:16', '2025-10-07 05:18:16'),
(268, 62, 'sortie', '3997', 1, '2025-10-07 05:18:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-07 05:18:29', '2025-10-07 05:18:29'),
(269, 8, 'sortie', '7157269', 100, '2025-10-07 05:23:00', 'Ajoutée manuellement pour l\'article \'DISQUE 230x1,9x22 BLEU (TIGOR) 50P\'', '2025-10-07 05:24:29', '2025-10-07 05:24:29'),
(270, 73, 'sortie', '7157269', 10, '2025-10-07 05:24:00', 'Ajoutée manuellement pour l\'article \'bagitt\'', '2025-10-07 05:25:06', '2025-10-07 05:25:06'),
(271, 151, 'entrée', '24645', 600, '2025-10-06 05:40:00', 'Ajoutée manuellement pour l\'article \'colliers 7,6x265 noir 100p\'', '2025-10-07 05:41:19', '2025-10-07 05:41:19'),
(272, 152, 'entrée', '24645', 400, '2025-10-06 05:56:00', 'Ajoutée manuellement pour l\'article \'tube flex.isog.q16 / isogris Q25 50 m (aiscan)\'', '2025-10-07 05:57:21', '2025-10-07 05:57:21'),
(273, 153, 'entrée', '24645', 200, '2025-10-06 06:05:00', 'Ajoutée manuellement pour l\'article \'barrette de connexion 1001 6mm\'', '2025-10-07 06:06:11', '2025-10-07 06:06:11'),
(274, 154, 'entrée', '24645', 12, '2025-10-06 06:19:00', 'Ajoutée manuellement pour l\'article \'spot led 24w panel carre app 6500k blacklight\'', '2025-10-07 06:19:53', '2025-10-07 06:19:53'),
(275, 155, 'entrée', '24645', 3, '2025-10-06 06:24:00', 'Ajoutée manuellement pour l\'article \'horloge avec reserve 24H 15mm/200h\'', '2025-10-07 06:24:31', '2025-10-07 06:24:31'),
(276, 52, 'sortie', '0099184', 6, '2025-10-07 05:25:00', 'Ajoutée manuellement pour l\'article \'scotche\'', '2025-10-07 06:36:35', '2025-10-07 06:36:35'),
(277, 65, 'sortie', '5342', 3, '2025-10-07 06:36:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-07 06:36:58', '2025-10-07 06:36:58'),
(278, 156, 'entrée', '24645', 10, '2025-10-06 06:31:00', 'Ajoutée manuellement pour l\'article \'rail omega perfore 7mm sym.dim l.35mm2 - 2m\'', '2025-10-07 06:40:03', '2025-10-07 06:40:03'),
(279, 157, 'entrée', '24645', 60, '2025-10-06 06:40:00', 'Ajoutée manuellement pour l\'article \'cable ths Alu.4*16 60m\'', '2025-10-07 06:40:44', '2025-10-07 06:40:44'),
(280, 158, 'entrée', '24645', 8, '2025-10-06 06:43:00', 'Ajoutée manuellement pour l\'article \'pince d\'ancrage pa 1500 max 70mm2\'', '2025-10-07 06:44:08', '2025-10-07 06:44:08'),
(281, 159, 'entrée', '24645', 2, '2025-10-06 06:46:00', 'Ajoutée manuellement pour l\'article \'boite de jonc.m13 4*25/35/50 cm2/90A2F 90A3\'', '2025-10-07 06:47:13', '2025-10-07 06:47:13'),
(282, 160, 'entrée', '24645', 10, '2025-10-06 06:51:00', 'Ajoutée manuellement pour l\'article \'cosse a sertir 70mm t10\'', '2025-10-07 06:51:54', '2025-10-07 06:51:54'),
(283, 161, 'entrée', '24645', 8, '2025-10-06 06:51:00', 'Ajoutée manuellement pour l\'article \'cosse a sertir 50mm t8 JM (JGK) 50-8\'', '2025-10-07 06:52:27', '2025-10-07 06:52:27'),
(284, 162, 'entrée', '24645', 3, '2025-10-06 06:53:00', 'Ajoutée manuellement pour l\'article \'fusible a couteaux to 160A AM\'', '2025-10-07 06:54:12', '2025-10-07 06:54:12'),
(285, 163, 'entrée', '24645', 3, '2025-10-06 07:07:00', 'Ajoutée manuellement pour l\'article \'CONTACT .AF26-30-00-13V110-250V 11KW AC/DC ABB 237001r1300\'', '2025-10-07 07:07:56', '2025-10-07 07:07:56'),
(287, 37, 'sortie', 'Nabil razak', 6, '2025-10-07 09:36:00', 'Ajoutée manuellement pour l\'article \'santofire\'', '2025-10-07 07:37:01', '2025-10-07 07:37:01'),
(288, 57, 'sortie', 'Nabil razak', 6, '2025-10-07 07:37:00', 'Ajoutée manuellement pour l\'article \'tipe\'', '2025-10-07 07:37:24', '2025-10-07 07:37:24'),
(289, 60, 'sortie', '5428', 1, '2025-10-07 07:37:00', 'Ajoutée manuellement pour l\'article \'selecone akfix 12P\'', '2025-10-07 07:39:05', '2025-10-07 07:39:05'),
(290, 70, 'sortie', '5519', 1, '2025-10-07 08:04:00', 'Ajoutée manuellement pour l\'article \'bis 4x50 200p\'', '2025-10-07 08:04:29', '2025-10-07 08:04:29'),
(291, 62, 'sortie', 'youssef Najdaoui (empruntée en aluminium)', 1, '2025-10-07 08:04:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-07 08:07:35', '2025-10-07 08:07:35'),
(292, 62, 'sortie', '5519', 1, '2025-10-07 08:07:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-07 08:08:17', '2025-10-07 08:08:17'),
(293, 101, 'sortie', '4692', 100, '2025-10-07 08:09:00', 'Ajoutée manuellement pour l\'article \'CABLE 5G 2,5 MM 100 m\'', '2025-10-07 08:15:44', '2025-10-07 08:15:44'),
(294, 112, 'sortie', '4692', 200, '2025-10-07 08:15:00', 'Ajoutée manuellement pour l\'article \'CABLE 3G 1,5 MM 100m\'', '2025-10-07 08:32:37', '2025-10-07 08:32:37'),
(295, 152, 'sortie', '4692', 150, '2025-10-07 08:32:00', 'Ajoutée manuellement pour l\'article \'tube flex.isog.q16 / isogris Q25 50 m (aiscan)\'', '2025-10-07 08:36:53', '2025-10-07 08:36:53'),
(297, 146, 'entrée', '24645', 10, '2025-10-06 06:26:00', 'Ajoutée manuellement pour l\'article \'projecteur led IP65 plat 150w noir lum.blanche (ingelec)\'', '2025-10-07 08:47:54', '2025-10-07 08:47:54'),
(298, 146, 'sortie', '4692', 4, '2025-10-07 08:49:00', 'Ajoutée manuellement pour l\'article \'projecteur led IP65 plat 150w noir lum.blanche (ingelec)\'', '2025-10-07 08:51:40', '2025-10-07 08:51:40'),
(299, 147, 'sortie', '4692', 4, '2025-10-07 08:51:00', 'Ajoutée manuellement pour l\'article \'projecteur led 100W 3000K H100W(brabus)\'', '2025-10-07 08:52:21', '2025-10-07 08:52:21'),
(300, 152, 'sortie', '4077', 50, '2025-10-07 08:52:00', 'Ajoutée manuellement pour l\'article \'tube flex.isog.q16 / isogris Q25 50 m (aiscan)\'', '2025-10-07 08:53:40', '2025-10-07 08:53:40'),
(301, 151, 'sortie', '4077', 100, '2025-10-07 08:53:00', 'Ajoutée manuellement pour l\'article \'colliers 7,6x265 noir 100p\'', '2025-10-07 08:54:29', '2025-10-07 08:54:29'),
(302, 153, 'sortie', '4692', 10, '2025-10-07 08:54:00', 'Ajoutée manuellement pour l\'article \'barrette de connexion 1001 6mm\' (modifié)', '2025-10-07 08:57:02', '2025-10-09 11:08:45'),
(303, 153, 'sortie', '4692', 4, '2025-10-07 10:26:00', 'Ajoutée manuellement pour l\'article \'barrette de connexion 1001 6mm\'', '2025-10-07 10:27:00', '2025-10-09 11:14:35'),
(304, 146, 'sortie', '4692', 1, '2025-10-07 10:29:00', 'Ajoutée manuellement pour l\'article \'projecteur led IP65 plat 150w noir lum.blanche (ingelec)\'', '2025-10-07 10:34:07', '2025-10-07 10:34:07'),
(305, 62, 'sortie', '4683', 1, '2025-10-07 10:34:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-07 10:34:35', '2025-10-07 10:34:35'),
(306, 165, 'sortie', '4692', 2, '2025-10-07 10:37:00', 'Ajoutée manuellement pour l\'article \'scotche noir\'', '2025-10-07 10:39:29', '2025-10-07 10:39:29'),
(307, 152, 'sortie', '4692', 50, '2025-10-07 10:39:00', 'Ajoutée manuellement pour l\'article \'tube flex.isog.q16 / isogris Q25 50 m (aiscan)\'', '2025-10-07 10:40:11', '2025-10-07 10:40:11'),
(309, 151, 'sortie', '4692', 200, '2025-10-07 10:43:00', 'Ajoutée manuellement pour l\'article \'colliers 7,6x265 noir 100p\'', '2025-10-07 10:43:25', '2025-10-07 10:43:25'),
(310, 64, 'sortie', '5123', 2, '2025-10-07 11:08:00', 'Ajoutée manuellement pour l\'article \'soulofan grand\'', '2025-10-07 11:12:51', '2025-10-07 11:12:51'),
(311, 60, 'sortie', '5428', 1, '2025-10-07 11:57:00', 'Ajoutée manuellement pour l\'article \'selecone akfix 12P\'', '2025-10-07 11:57:36', '2025-10-07 11:57:36'),
(312, 61, 'sortie', '5319', 1, '2025-10-07 11:57:00', 'Ajoutée manuellement pour l\'article \'scotche blanche 72P\'', '2025-10-07 11:59:57', '2025-10-07 11:59:57'),
(313, 146, 'sortie', '4692', 7, '2025-10-07 11:59:00', 'Ajoutée manuellement pour l\'article \'projecteur led IP65 plat 150w noir lum.blanche (ingelec)\'', '2025-10-07 12:01:55', '2025-10-07 12:01:55'),
(314, 77, 'entrée', '24716', 5, '2025-10-07 08:45:00', 'Ajoutée manuellement pour l\'article \'POLY BOX\'', '2025-10-07 12:19:30', '2025-10-07 12:19:30'),
(315, 89, 'sortie', '1943', 4, '2025-10-07 12:47:00', 'Ajoutée manuellement pour l\'article \'harnais de sécurité complet\'', '2025-10-07 12:47:56', '2025-10-07 12:47:56'),
(316, 90, 'sortie', 'hamid soudor', 2, '2025-10-07 12:47:00', 'Ajoutée manuellement pour l\'article \'stop chute nom\'', '2025-10-07 12:48:43', '2025-10-07 12:48:43'),
(317, 166, 'entrée', '24716', 1, '2025-10-07 13:01:00', 'Ajoutée manuellement pour l\'article \'viv etanche app gris fonce\'', '2025-10-07 13:01:45', '2025-10-07 13:01:45'),
(318, 167, 'entrée', '24716', 1, '2025-10-07 13:01:00', 'Ajoutée manuellement pour l\'article \'poussoir a bascule lumineux etanche app gris (ingelic)\'', '2025-10-07 13:02:14', '2025-10-07 13:02:14'),
(324, 145, 'sortie', 'abderhmen aleesri', 1, '2025-10-08 06:36:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-08 04:37:12', '2025-10-08 04:37:12'),
(325, 145, 'sortie', 'anas bouri', 1, '2025-10-08 06:37:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-08 04:37:42', '2025-10-08 04:37:42'),
(326, 145, 'sortie', 'ahmed khadraoui', 1, '2025-10-08 06:37:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-08 04:38:22', '2025-10-08 04:38:22'),
(327, 85, 'sortie', 'ahmed agma', 1, '2025-10-08 06:38:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-08 04:39:25', '2025-10-08 04:39:25'),
(328, 77, 'sortie', 'adbeltif tricien', 2, '2025-10-08 06:50:00', 'Ajoutée manuellement pour l\'article \'POLY BOX\'', '2025-10-08 04:51:19', '2025-10-08 04:51:19'),
(329, 155, 'sortie', 'abdeltif tricien', 1, '2025-10-08 06:51:00', 'Ajoutée manuellement pour l\'article \'horloge avec reserve 24H 15mm/200h\'', '2025-10-08 04:51:45', '2025-10-08 04:51:45');
INSERT INTO `stock_movements` (`id`, `stock_id`, `type`, `reference`, `quantite`, `date_movement`, `note`, `created_at`, `updated_at`) VALUES
(330, 99, 'sortie', 'abdeltif tricien', 1, '2025-10-08 06:51:00', 'Ajoutée manuellement pour l\'article \'DIJONCTEUR C25\'', '2025-10-08 04:52:12', '2025-10-08 04:52:12'),
(331, 95, 'sortie', 'abdeltif tricien', 1, '2025-10-08 06:52:00', 'Ajoutée manuellement pour l\'article \'SAROTE\'', '2025-10-08 04:52:35', '2025-10-08 04:52:35'),
(332, 112, 'sortie', 'abdeltif tricien', 100, '2025-10-08 06:53:00', 'Ajoutée manuellement pour l\'article \'CABLE 3G 1,5 MM 100m\' (modifié)', '2025-10-08 04:53:49', '2025-10-08 04:54:42'),
(333, 151, 'sortie', 'abdeltif tricien', 100, '2025-10-08 06:54:00', 'Ajoutée manuellement pour l\'article \'colliers 7,6x265 noir 100p\'', '2025-10-08 04:55:33', '2025-10-08 04:55:33'),
(334, 89, 'retour', '4471', 1, '2025-10-08 06:56:00', 'Retour enregistré pour l\'article harnais de sécurité complet', '2025-10-08 04:57:16', '2025-10-08 04:57:16'),
(336, 58, 'sortie', '4256100', 2, '2025-10-08 07:10:00', 'Ajoutée manuellement pour l\'article \'PEINTURE vert (ENDES) 5KG\'', '2025-10-08 05:11:29', '2025-10-08 05:11:29'),
(337, 145, 'sortie', 'zakaria azkour', 1, '2025-10-08 07:12:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-08 05:13:11', '2025-10-08 05:13:11'),
(338, 145, 'sortie', 'aymen marzok', 1, '2025-10-08 07:13:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-08 05:13:58', '2025-10-08 05:13:58'),
(339, 168, 'entrée', 'sans bon', 2, '2025-10-08 07:25:00', 'Ajoutée manuellement pour l\'article \'appariel niveau lizer\'', '2025-10-08 05:25:59', '2025-10-08 05:25:59'),
(340, 168, 'sortie', 'hamid soudor', 2, '2025-10-08 07:26:00', 'Ajoutée manuellement pour l\'article \'appariel niveau lizer\'', '2025-10-08 05:26:51', '2025-10-08 05:26:51'),
(341, 49, 'sortie', 'Abdelhak', 1, '2025-10-07 14:48:00', 'Ajoutée manuellement pour l\'article \'pavite\' (modifié) (modifié)', '2025-10-08 05:49:19', '2025-10-18 06:24:22'),
(342, 52, 'sortie', '0099185', 6, '2025-10-08 08:41:00', 'Ajoutée manuellement pour l\'article \'scotche\'', '2025-10-08 06:42:42', '2025-10-08 06:42:42'),
(343, 95, 'sortie', 'abdeltif tricien', 1, '2025-10-08 08:47:00', 'Ajoutée manuellement pour l\'article \'SAROTE\'', '2025-10-08 06:47:27', '2025-10-08 06:47:27'),
(344, 151, 'sortie', 'abdeltif tricien', 100, '2025-10-08 08:47:00', 'Ajoutée manuellement pour l\'article \'colliers 7,6x265 noir 100p\'', '2025-10-08 06:50:20', '2025-10-08 06:50:20'),
(345, 165, 'sortie', 'abdeltif tricien', 1, '2025-10-08 08:50:00', 'Ajoutée manuellement pour l\'article \'scotche noir\'', '2025-10-08 06:52:12', '2025-10-08 06:52:12'),
(347, 154, 'sortie', '4692', 4, '2025-10-08 08:52:00', 'Ajoutée manuellement pour l\'article \'spot led 24w panel carre app 6500k blacklight\'', '2025-10-08 06:53:54', '2025-10-08 06:53:54'),
(348, 42, 'entrée', 'L2025019263', 36, '2025-10-08 09:35:00', 'Ajoutée manuellement pour l\'article \'metre 5m ord\' (modifié)', '2025-10-08 07:36:55', '2025-10-08 07:37:44'),
(349, 171, 'entrée', 'L2025019263', 10, '2025-10-08 09:36:00', 'Ajoutée manuellement pour l\'article \'casque anti bruit\'', '2025-10-08 07:37:21', '2025-10-08 07:37:21'),
(350, 172, 'entrée', '24688', 40, '2025-10-08 09:46:00', 'Ajoutée manuellement pour l\'article \'prise 2p + T etranche app gris fonce\'', '2025-10-08 07:46:22', '2025-10-08 07:46:22'),
(351, 166, 'entrée', '24781', 9, '2025-10-08 09:46:00', 'Ajoutée manuellement pour l\'article \'viv etanche app gris fonce\'', '2025-10-08 07:46:55', '2025-10-08 07:46:55'),
(352, 173, 'entrée', '24739', 200, '2025-10-08 09:48:00', 'Ajoutée manuellement pour l\'article \'cable ths alu.3*70+54,6 +16mm2\'', '2025-10-08 07:48:30', '2025-10-08 07:48:30'),
(353, 151, 'sortie', 'abdeltif tricien', 10, '2025-10-08 09:50:00', 'Ajoutée manuellement pour l\'article \'colliers 7,6x265 noir 100p\'', '2025-10-08 07:50:43', '2025-10-08 07:50:43'),
(354, 85, 'sortie', 'hssayn ayyach', 1, '2025-10-08 09:54:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-08 07:57:39', '2025-10-08 07:57:39'),
(355, 85, 'sortie', 'najah mohmed', 1, '2025-10-08 09:57:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-08 07:58:49', '2025-10-08 07:58:49'),
(356, 65, 'sortie', '5342', 3, '2025-10-08 09:59:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-08 07:59:33', '2025-10-08 07:59:33'),
(357, 72, 'sortie', '4675', 2, '2025-10-08 10:02:00', 'Ajoutée manuellement pour l\'article \'lamone  petite (MEULEUSE GWS 270W BOSCH)\'', '2025-10-08 08:02:57', '2025-10-08 08:02:57'),
(358, 145, 'sortie', 'kamal enmissi', 1, '2025-10-08 10:07:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-08 08:07:47', '2025-10-08 08:07:47'),
(359, 61, 'sortie', '4557 (empruntée en aluminium pour marbre)', 3, '2025-10-08 10:38:00', 'Ajoutée manuellement pour l\'article \'scotche blanche 72P\'', '2025-10-08 08:39:13', '2025-10-08 08:39:13'),
(360, 31, 'sortie', '3808504', 1, '2025-10-08 11:02:00', 'Ajoutée manuellement pour l\'article \'SBAT 41\'', '2025-10-08 09:02:51', '2025-10-08 09:02:51'),
(361, 6, 'sortie', '7157268', 1, '2025-10-08 12:22:00', 'Ajoutée manuellement pour l\'article \'PEINTURE NOIRE (ATLAS) 5KG\'', '2025-10-08 10:24:02', '2025-10-08 10:24:02'),
(362, 58, 'sortie', '7157268', 1, '2025-10-08 12:24:00', 'Ajoutée manuellement pour l\'article \'PEINTURE vert (ENDES) 5KG\'', '2025-10-08 10:24:34', '2025-10-08 10:24:34'),
(363, 147, 'sortie', '4692', 3, '2025-10-08 12:25:00', 'Ajoutée manuellement pour l\'article \'projecteur led 100W 3000K H100W(brabus)\'', '2025-10-08 10:25:49', '2025-10-08 10:25:49'),
(364, 165, 'sortie', '4692', 1, '2025-10-08 12:25:00', 'Ajoutée manuellement pour l\'article \'scotche noir\'', '2025-10-08 10:26:17', '2025-10-08 10:26:17'),
(365, 7, 'sortie', '4675', 25, '2025-10-08 12:26:00', 'Ajoutée manuellement pour l\'article \'DISQUE 180x6,4x22,23 ROUGE (TIGOR) 25P\'', '2025-10-08 10:28:54', '2025-10-08 10:28:54'),
(366, 62, 'sortie', '4388', 1, '2025-10-08 12:28:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-08 10:30:03', '2025-10-08 10:30:03'),
(367, 167, 'sortie', 'abdeltif tricien', 1, '2025-10-08 12:53:00', 'Ajoutée manuellement pour l\'article \'poussoir a bascule lumineux etanche app gris (ingelic)\'', '2025-10-08 11:04:21', '2025-10-08 11:04:21'),
(368, 166, 'sortie', '4692', 9, '2025-10-08 13:04:00', 'Ajoutée manuellement pour l\'article \'viv etanche app gris fonce\'', '2025-10-08 11:06:04', '2025-10-08 11:06:04'),
(369, 172, 'sortie', '4692', 4, '2025-10-08 13:06:00', 'Ajoutée manuellement pour l\'article \'prise 2p + T etranche app gris fonce\'', '2025-10-08 11:06:50', '2025-10-11 13:02:35'),
(370, 58, 'sortie', '7157201', 4, '2025-10-08 13:37:00', 'Ajoutée manuellement pour l\'article \'PEINTURE vert (ENDES) 5KG\'', '2025-10-08 11:38:09', '2025-10-08 11:38:09'),
(371, 16, 'sortie', '7157201', 4, '2025-10-08 13:38:00', 'Ajoutée manuellement pour l\'article \'DILUANT (ENDES) 5L\'', '2025-10-08 11:38:37', '2025-10-08 11:38:37'),
(376, 94, 'retour', '4471', 2, '2025-10-08 13:48:00', 'Retour enregistré pour l\'article boite rouge', '2025-10-08 11:50:21', '2025-10-08 11:50:21'),
(377, 96, 'retour', '4471', 1, '2025-10-08 13:50:00', 'Retour enregistré pour l\'article DOUILLES', '2025-10-08 11:51:08', '2025-10-08 11:51:08'),
(378, 95, 'retour', '4471', 1, '2025-10-08 13:51:00', 'Retour enregistré pour l\'article SAROTE', '2025-10-08 11:51:26', '2025-10-08 11:51:26'),
(379, 103, 'sortie', 'Adil khayat (bon de transfert 000336)', 10, '2025-10-08 13:52:00', 'Ajoutée manuellement pour l\'article \'CHEVILLES  EN PLASTIC 8MM\'', '2025-10-08 11:56:53', '2025-10-08 11:56:53'),
(380, 66, 'sortie', 'Adil khayat (bon de transfert 000336)', 10, '2025-10-08 13:56:00', 'Ajoutée manuellement pour l\'article \'bis 4x40 80x200P\'', '2025-10-08 11:57:18', '2025-10-08 11:57:18'),
(381, 30, 'sortie', 'Adil khayat (bon de transfert 000336)', 350, '2025-10-08 13:59:00', 'Ajoutée manuellement pour l\'article \'BOULOUN ECROUX 8 (ENVIRON)\'', '2025-10-08 11:59:54', '2025-10-08 11:59:54'),
(382, 29, 'sortie', 'Adil khayat (bon de transfert 000336)', 400, '2025-10-08 14:01:00', 'Ajoutée manuellement pour l\'article \'CROUX 8 (ENVIRON)\'', '2025-10-08 12:01:40', '2025-10-08 12:01:40'),
(383, 140, 'sortie', 'Adil khayat (bon de transfert 000336)', 6, '2025-10-08 14:01:00', 'Ajoutée manuellement pour l\'article \'roullo Blanche\'', '2025-10-08 12:02:17', '2025-10-08 12:02:17'),
(384, 94, 'sortie', '4692', 2, '2025-10-08 14:06:00', 'Ajoutée manuellement pour l\'article \'boite rouge\'', '2025-10-08 12:08:55', '2025-10-08 12:08:55'),
(385, 96, 'sortie', '4692', 1, '2025-10-08 14:08:00', 'Ajoutée manuellement pour l\'article \'DOUILLES\'', '2025-10-08 12:09:08', '2025-10-08 12:09:08'),
(386, 95, 'sortie', '4692', 1, '2025-10-08 14:09:00', 'Ajoutée manuellement pour l\'article \'SAROTE\'', '2025-10-08 12:09:28', '2025-10-08 12:09:28'),
(387, 97, 'sortie', '4692', 1, '2025-10-08 14:09:00', 'Ajoutée manuellement pour l\'article \'PRISE\'', '2025-10-08 12:09:49', '2025-10-08 12:09:49'),
(388, 100, 'sortie', '4692', 11, '2025-10-08 14:09:00', 'Ajoutée manuellement pour l\'article \'CABLE 3G 2,5 MM 100m\'', '2025-10-08 12:10:38', '2025-10-08 12:27:19'),
(390, 100, 'retour', '4692', 100, '2025-10-08 14:26:00', 'Retour enregistré pour l\'article CABLE 3G 2,5 MM 100m', '2025-10-08 12:27:09', '2025-10-08 12:27:09'),
(391, 100, 'retour', '4692', 99, '2025-10-08 14:29:00', 'Retour enregistré pour l\'article CABLE 3G 2,5 MM 100m', '2025-10-08 12:29:52', '2025-10-08 12:29:52'),
(392, 42, 'sortie', '0099181', 2, '2025-10-08 15:03:00', 'Ajoutée manuellement pour l\'article \'metre 5m ord\'', '2025-10-08 13:03:27', '2025-10-08 13:03:27'),
(393, 80, 'sortie', 'Adil khayat (bon de transfert 000336)', 1, '2025-10-08 14:02:00', 'Ajoutée manuellement pour l\'article \'pavite\'', '2025-10-09 04:36:15', '2025-10-09 04:36:15'),
(394, 171, 'sortie', 'soufiane ait ouzmil', 1, '2025-10-08 10:28:00', 'Ajoutée manuellement pour l\'article \'casque anti bruit\'', '2025-10-09 04:41:36', '2025-10-09 04:41:36'),
(395, 171, 'sortie', 'zakaria izakour', 1, '2025-10-08 10:28:00', 'Ajoutée manuellement pour l\'article \'casque anti bruit\'', '2025-10-09 04:42:10', '2025-10-09 04:42:10'),
(396, 171, 'sortie', 'Elkhadraoui ahmed', 1, '2025-10-08 10:29:00', 'Ajoutée manuellement pour l\'article \'casque anti bruit\'', '2025-10-09 04:42:46', '2025-10-09 04:42:46'),
(397, 171, 'sortie', 'el moutaoukil mohameed', 1, '2025-10-08 10:29:00', 'Ajoutée manuellement pour l\'article \'casque anti bruit\'', '2025-10-09 04:43:45', '2025-10-09 04:43:45'),
(398, 171, 'sortie', 'Belgout Abdelfattah', 1, '2025-10-08 10:29:00', 'Ajoutée manuellement pour l\'article \'casque anti bruit\'', '2025-10-09 04:44:10', '2025-10-09 04:44:10'),
(399, 169, 'sortie', '0099183', 2, '2025-10-09 06:56:00', 'Ajoutée manuellement pour l\'article \'DISQUE 180x20x22,22 Blanche (disque finition)\'', '2025-10-09 04:57:29', '2025-10-09 04:57:29'),
(400, 145, 'sortie', 'soufiane ait ouzmil', 1, '2025-10-09 07:04:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-09 05:04:56', '2025-10-09 05:04:56'),
(401, 145, 'sortie', 'ismail jaafar', 1, '2025-10-09 07:19:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-09 05:20:00', '2025-10-09 05:20:00'),
(402, 174, 'sortie', 'ismail jaafar', 1, '2025-10-09 07:20:00', 'Ajoutée manuellement pour l\'article \'masque resperatoire\'', '2025-10-09 05:20:26', '2025-10-09 05:20:26'),
(403, 77, 'sortie', 'bon de transfert 000345', 4, '2025-10-09 07:25:00', 'Ajoutée manuellement pour l\'article \'POLY BOX\'', '2025-10-09 05:29:22', '2025-10-09 05:29:22'),
(404, 155, 'sortie', 'bon de transfert 000345', 2, '2025-10-09 07:29:00', 'Ajoutée manuellement pour l\'article \'horloge avec reserve 24H 15mm/200h\'', '2025-10-09 05:29:46', '2025-10-09 05:29:46'),
(405, 163, 'sortie', 'bon de transfert 000345', 3, '2025-10-09 07:29:00', 'Ajoutée manuellement pour l\'article \'CONTACT .AF26-30-00-13V110-250V 11KW AC/DC ABB 237001r1300\'', '2025-10-09 05:30:13', '2025-10-09 05:30:13'),
(406, 165, 'sortie', 'bon de transfert 000345', 20, '2025-10-09 07:30:00', 'Ajoutée manuellement pour l\'article \'scotche noir\'', '2025-10-09 05:31:23', '2025-10-09 05:31:23'),
(407, 159, 'sortie', 'bon de transfert 000345', 2, '2025-10-09 07:31:00', 'Ajoutée manuellement pour l\'article \'boite de jonction m13 4*25/35/50 cm2/90A2F 90A3\'', '2025-10-09 05:31:39', '2025-10-09 05:31:39'),
(408, 179, 'sortie', 'bon de transfert 000345', 2, '2025-10-09 07:34:00', 'Ajoutée manuellement pour l\'article \'led strip light  200w (brabus)\'', '2025-10-09 05:36:49', '2025-10-09 05:36:49'),
(409, 156, 'retour', '4692', 1, '2025-10-09 07:40:00', 'Retour enregistré pour l\'article rail omega perfore 7mm sym.dim l.35mm2 - 2m', '2025-10-09 05:40:58', '2025-10-09 05:40:58'),
(410, 156, 'sortie', 'bon de transfert 000345', 18, '2025-10-09 07:42:00', 'Ajoutée manuellement pour l\'article \'rail omega perfore 7mm sym.dim l.35mm2 - 2m\'', '2025-10-09 05:43:22', '2025-10-09 05:43:22'),
(411, 42, 'sortie', 'Nabil razak', 1, '2025-10-09 07:43:00', 'Ajoutée manuellement pour l\'article \'metre 5m ord\'', '2025-10-09 05:48:31', '2025-10-09 05:48:31'),
(412, 60, 'sortie', '4388', 1, '2025-10-09 07:50:00', 'Ajoutée manuellement pour l\'article \'selecone akfix 12P\'', '2025-10-09 05:50:47', '2025-10-09 05:50:47'),
(413, 64, 'sortie', '5154', 1, '2025-10-09 07:50:00', 'Ajoutée manuellement pour l\'article \'soulofan grand\'', '2025-10-09 05:51:11', '2025-10-09 05:51:11'),
(414, 62, 'sortie', '4387', 1, '2025-10-08 12:30:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-09 06:18:33', '2025-10-09 06:18:33'),
(415, 62, 'sortie', '4212', 1, '2025-10-08 12:30:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-09 06:25:09', '2025-10-09 06:25:09'),
(416, 64, 'sortie', 'ahmed agma', 1, '2025-10-08 12:30:00', 'Ajoutée manuellement pour l\'article \'soulofan grand\'', '2025-10-09 06:25:56', '2025-10-09 06:25:56'),
(417, 65, 'sortie', '5319', 2, '2025-10-08 12:30:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-09 06:27:11', '2025-10-09 06:27:11'),
(418, 65, 'sortie', '5260', 1, '2025-10-08 12:30:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-09 06:27:33', '2025-10-09 06:27:33'),
(420, 180, 'sortie', 'bon de transfert 000345', 8, '2025-10-09 08:46:00', 'Ajoutée manuellement pour l\'article \'gullote\'', '2025-10-09 06:47:26', '2025-10-09 06:47:26'),
(421, 153, 'sortie', 'bon de transfert 000346', 160, '2025-10-09 08:47:00', 'Ajoutée manuellement pour l\'article \'barrette de connexion 1001 6mm\' (modifié)', '2025-10-09 06:49:13', '2025-10-09 10:29:49'),
(422, 100, 'sortie', 'bon de transfert 000346', 200, '2025-10-09 08:49:00', 'Ajoutée manuellement pour l\'article \'CABLE 3G 2,5 MM 100m\' (modifié)', '2025-10-09 06:52:37', '2025-10-09 08:44:34'),
(423, 101, 'sortie', 'bon de transfert 000346', 300, '2025-10-09 08:52:00', 'Ajoutée manuellement pour l\'article \'CABLE 5G 2,5 MM 100 m\' (modifié) (modifié)', '2025-10-09 06:55:20', '2025-10-11 13:08:52'),
(424, 137, 'entrée', '25100716', 472, '2025-10-08 14:27:00', 'Ajoutée manuellement pour l\'article \'CLAME 70\' (modifié) (modifié) (modifié)', '2025-10-09 07:22:17', '2025-10-09 07:50:50'),
(425, 65, 'sortie', '5342', 3, '2025-10-09 09:24:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-09 07:25:09', '2025-10-09 07:25:09'),
(426, 137, 'sortie', '5154', 20, '2025-10-09 09:25:00', 'Ajoutée manuellement pour l\'article \'CLAME 70\'', '2025-10-09 07:25:32', '2025-10-09 07:25:32'),
(427, 92, 'sortie', 'mohssin akalabo', 1, '2025-10-09 09:25:00', 'Ajoutée manuellement pour l\'article \'les lunettes\'', '2025-10-09 07:27:20', '2025-10-09 07:27:20'),
(428, 62, 'sortie', '5259', 1, '2025-10-09 09:27:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-09 07:27:45', '2025-10-09 07:27:45'),
(429, 64, 'sortie', '4868', 2, '2025-10-09 09:27:00', 'Ajoutée manuellement pour l\'article \'soulofan grand\'', '2025-10-09 07:28:31', '2025-10-09 07:28:31'),
(430, 100, 'sortie', '4557 (empruntée en aluminium pour marbre)', 15, '2025-10-09 09:30:00', 'Ajoutée manuellement pour l\'article \'CABLE 3G 2,5 MM 100m\' (modifié)', '2025-10-09 07:31:39', '2025-10-09 10:17:25'),
(431, 106, 'sortie', '4557 (empruntée en aluminium pour marbre)', 1, '2025-10-09 09:31:00', 'Ajoutée manuellement pour l\'article \'FICHE 2P + T FEMELLE 16 A 220 V\'', '2025-10-09 07:31:56', '2025-10-09 07:31:56'),
(432, 6, 'sortie', '7157267', 1, '2025-10-09 09:31:00', 'Ajoutée manuellement pour l\'article \'PEINTURE NOIRE (ATLAS) 5KG\'', '2025-10-09 07:34:25', '2025-10-09 07:34:25'),
(433, 60, 'sortie', '5428', 1, '2025-10-09 09:38:00', 'Ajoutée manuellement pour l\'article \'selecone akfix 12P\'', '2025-10-09 07:38:45', '2025-10-09 07:38:45'),
(434, 122, 'entrée', '25100716', 72, '2025-10-08 14:27:00', 'Ajoutée manuellement pour l\'article \'roullette plastique (rwayde)\' (modifié)', '2025-10-09 07:49:27', '2025-10-09 07:50:59'),
(435, 8, 'sortie', '4675', 50, '2025-10-09 09:38:00', 'Ajoutée manuellement pour l\'article \'DISQUE 230x1,9x22 BLEU (TIGOR) 50P\'', '2025-10-09 08:13:41', '2025-10-09 08:13:41'),
(436, 52, 'sortie', '0099186', 6, '2025-10-09 10:13:00', 'Ajoutée manuellement pour l\'article \'scotche\'', '2025-10-09 08:14:45', '2025-10-09 08:14:45'),
(437, 51, 'sortie', '0099186', 1, '2025-10-09 10:14:00', 'Ajoutée manuellement pour l\'article \'colla\'', '2025-10-09 08:15:20', '2025-10-09 08:15:20'),
(438, 65, 'sortie', '4672', 1, '2025-10-09 10:17:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-09 08:17:40', '2025-10-09 08:17:40'),
(439, 181, 'entrée', '25100716', 218, '2025-10-08 14:28:00', 'Ajoutée manuellement pour l\'article \'kit fenetre s70R\' (modifié)', '2025-10-09 08:29:32', '2025-10-09 08:30:37'),
(440, 182, 'entrée', '25100716', 406, '2025-10-08 14:28:00', 'Ajoutée manuellement pour l\'article \'kit fermeture S70R renf\' (modifié)', '2025-10-09 08:37:12', '2025-10-09 08:37:39'),
(441, 181, 'entrée', '25100715', 82, '2025-10-08 14:28:00', 'Ajoutée manuellement pour l\'article \'kit fenetre s70R\'', '2025-10-09 08:38:38', '2025-10-09 08:38:38'),
(442, 182, 'entrée', '25100715', 150, '2025-10-09 10:38:00', 'Ajoutée manuellement pour l\'article \'kit fermeture S70R renf\'', '2025-10-09 08:39:10', '2025-10-09 08:39:10'),
(443, 1, 'sortie', '7157266', 2, '2025-10-09 10:54:00', 'Ajoutée manuellement pour l\'article \'PEINTURE ROUGE (LOGICOLOR) 5KG\'', '2025-10-09 08:55:38', '2025-10-09 08:55:38'),
(444, 183, 'entrée', '24747', 12, '2025-10-09 12:11:00', 'Ajoutée manuellement pour l\'article \'cosse a sertir 240mm t16\'', '2025-10-09 10:12:22', '2025-10-09 10:12:22'),
(445, 69, 'sortie', '4388', 1, '2025-10-09 12:33:00', 'Ajoutée manuellement pour l\'article \'bis 4,8x60 200p\'', '2025-10-09 10:34:44', '2025-10-09 10:34:44'),
(446, 64, 'sortie', '4388', 1, '2025-10-09 12:34:00', 'Ajoutée manuellement pour l\'article \'soulofan grand\'', '2025-10-09 10:35:24', '2025-10-09 10:35:24'),
(447, 65, 'sortie', '4388', 1, '2025-10-09 12:35:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-09 10:35:50', '2025-10-09 10:35:50'),
(448, 153, 'retour', '4077', 20, '2025-10-07 13:50:00', 'Retour enregistré pour l\'article barrette de connexion 1001 6mm', '2025-10-09 11:02:57', '2025-10-09 11:02:57'),
(449, 153, 'retour', '4077', 10, '2025-10-09 13:02:00', 'Retour enregistré pour l\'article barrette de connexion 1001 6mm', '2025-10-09 11:08:45', '2025-10-09 11:08:45'),
(450, 153, 'retour', '4692', 6, '2025-10-07 14:27:00', 'il reste aussi 4 petite piece.', '2025-10-09 11:14:35', '2025-10-09 11:14:35'),
(451, 182, 'sortie', '5319', 100, '2025-10-09 13:45:00', 'Ajoutée manuellement pour l\'article \'kit fermeture S70R renf\'', '2025-10-09 11:47:32', '2025-10-09 11:47:32'),
(452, 103, 'sortie', 'bon transfert 000358', 10, '2025-10-09 13:47:00', 'Ajoutée manuellement pour l\'article \'CHEVILLES  EN PLASTIC 8MM\'', '2025-10-09 11:49:55', '2025-10-09 11:49:55'),
(453, 184, 'sortie', 'bon transfert 000358', 1, '2025-10-09 13:52:00', 'Ajoutée manuellement pour l\'article \'bis 4,8x16\'', '2025-10-09 11:52:31', '2025-10-09 11:52:31'),
(454, 140, 'sortie', 'bon transfert 000358', 5, '2025-10-09 13:52:00', 'Ajoutée manuellement pour l\'article \'roullo Blanche\'', '2025-10-09 11:53:31', '2025-10-09 11:53:31'),
(455, 65, 'sortie', '3997', 1, '2025-10-09 13:56:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-09 11:57:06', '2025-10-09 11:57:06'),
(456, 62, 'sortie', 'ahmed agma', 1, '2025-10-09 13:57:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-09 11:58:32', '2025-10-09 11:58:32'),
(457, 65, 'sortie', '5259', 2, '2025-10-09 13:58:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-09 11:59:22', '2025-10-09 11:59:22'),
(458, 65, 'sortie', '4388', 10, '2025-10-09 13:59:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-09 12:00:04', '2025-10-09 12:00:04'),
(459, 65, 'sortie', '4388', 10, '2025-10-09 13:59:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-09 12:00:05', '2025-10-09 12:00:05'),
(460, 64, 'sortie', '5154', 1, '2025-10-09 14:00:00', 'Ajoutée manuellement pour l\'article \'soulofan grand\'', '2025-10-09 12:00:45', '2025-10-09 12:00:45'),
(461, 64, 'sortie', '5319', 1, '2025-10-09 14:01:00', 'Ajoutée manuellement pour l\'article \'soulofan grand\'', '2025-10-09 12:02:33', '2025-10-09 12:02:33'),
(462, 65, 'sortie', '5179', 5, '2025-10-09 14:02:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-09 12:03:26', '2025-10-09 12:03:26'),
(463, 38, 'sortie', '5775', 4, '2025-10-09 14:45:00', 'Ajoutée manuellement pour l\'article \'disque 400\'', '2025-10-09 12:48:27', '2025-10-09 12:48:27'),
(464, 6, 'sortie', '4256199', 1, '2025-10-10 12:42:00', 'Ajoutée manuellement pour l\'article \'PEINTURE NOIRE (ATLAS) 5KG\'', '2025-10-10 10:43:04', '2025-10-10 10:43:04'),
(465, 65, 'sortie', '4434', 85, '2025-10-10 12:43:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-10 10:44:21', '2025-10-10 10:44:21'),
(466, 130, 'sortie', 'lhssn', 1, '2025-10-10 12:44:00', 'Ajoutée manuellement pour l\'article \'gachat\'', '2025-10-10 10:50:00', '2025-10-10 10:50:00'),
(467, 58, 'sortie', '4256198', 2, '2025-10-10 13:24:00', 'Ajoutée manuellement pour l\'article \'PEINTURE vert (ENDES) 5KG\'', '2025-10-10 11:28:27', '2025-10-10 11:28:27'),
(468, 52, 'sortie', '0099187', 6, '2025-10-10 13:28:00', 'Ajoutée manuellement pour l\'article \'scotche\'', '2025-10-10 11:29:42', '2025-10-10 11:29:42'),
(469, 16, 'sortie', '4256198', 2, '2025-10-10 13:33:00', 'Ajoutée manuellement pour l\'article \'DILUANT (ENDES) 5L\'', '2025-10-10 11:34:12', '2025-10-10 11:34:12'),
(470, 42, 'sortie', '0099184', 2, '2025-10-10 13:34:00', 'Ajoutée manuellement pour l\'article \'metre 5m ord\'', '2025-10-10 11:35:13', '2025-10-10 11:35:13'),
(471, 38, 'sortie', '0099185', 4, '2025-10-10 13:35:00', 'Ajoutée manuellement pour l\'article \'disque 400\'', '2025-10-10 11:35:57', '2025-10-10 11:35:57'),
(472, 47, 'sortie', '0099185', 4, '2025-10-10 13:35:00', 'Ajoutée manuellement pour l\'article \'disque 220\'', '2025-10-10 11:36:17', '2025-10-10 11:36:17'),
(473, 185, 'entrée', 'L2025019376', 6, '2025-10-10 14:06:00', 'Ajoutée manuellement pour l\'article \'tournevis dove plat\'', '2025-10-10 12:08:06', '2025-10-10 12:08:06'),
(474, 186, 'entrée', 'L2025019376', 6, '2025-10-10 14:08:00', 'Ajoutée manuellement pour l\'article \'tournevis dove american\'', '2025-10-10 12:08:20', '2025-10-10 12:08:20'),
(475, 187, 'entrée', 'L2025019376', 4, '2025-10-10 14:08:00', 'Ajoutée manuellement pour l\'article \'jeu cle sipo 308-2012 xcort\'', '2025-10-10 12:08:39', '2025-10-10 12:08:39'),
(476, 188, 'entrée', 'L2025019376', 10, '2025-10-10 14:08:00', 'Ajoutée manuellement pour l\'article \'balais en plastique filtrage\'', '2025-10-10 12:09:11', '2025-10-10 12:09:11'),
(477, 189, 'entrée', 'L2025019376', 10, '2025-10-10 14:09:00', 'Ajoutée manuellement pour l\'article \'manche filtage\'', '2025-10-10 12:09:23', '2025-10-10 12:09:23'),
(478, 190, 'entrée', 'L2025019376', 10, '2025-10-10 14:09:00', 'Ajoutée manuellement pour l\'article \'pistolet silicone\'', '2025-10-10 12:09:41', '2025-10-10 12:09:41'),
(479, 192, 'entrée', 'L2025019376', 10, '2025-10-10 14:09:00', 'Ajoutée manuellement pour l\'article \'meche a fer 4 inox bosch\'', '2025-10-10 12:10:09', '2025-10-10 12:10:09'),
(480, 193, 'entrée', 'L2025019376', 5, '2025-10-10 14:10:00', 'Ajoutée manuellement pour l\'article \'meche a fer 10 inox bosch\' (modifié) (modifié) (modifié)', '2025-10-10 12:10:24', '2025-10-20 09:00:02'),
(481, 194, 'entrée', 'L2025019376', 10, '2025-10-10 14:10:00', 'Ajoutée manuellement pour l\'article \'meche a fer 6 inox bosch\' (modifié)', '2025-10-10 12:10:39', '2025-10-10 12:12:15'),
(482, 195, 'entrée', 'L2025019376', 5, '2025-10-10 14:10:00', 'Ajoutée manuellement pour l\'article \'meche a fer 8 inox bosch\' (modifié)', '2025-10-10 12:11:06', '2025-10-10 12:11:44'),
(483, 196, 'entrée', 'L2025019376', 2, '2025-10-10 14:14:00', 'Ajoutée manuellement pour l\'article \'sauteuse gst 650 450w bosh\'', '2025-10-10 12:14:18', '2025-10-10 12:14:18'),
(484, 198, 'entrée', 'L2025019376', 12, '2025-10-10 14:14:00', 'Ajoutée manuellement pour l\'article \'kiteur vello 18\'', '2025-10-10 12:14:45', '2025-10-10 12:14:45'),
(485, 191, 'entrée', 'L2025019376', 10, '2025-10-10 14:20:00', 'Ajoutée manuellement pour l\'article \'metre 10m betta\'', '2025-10-10 12:20:40', '2025-10-10 12:20:40'),
(487, 191, 'sortie', '4672', 1, '2025-10-10 14:21:00', 'Ajoutée manuellement pour l\'article \'metre 10m betta\'', '2025-10-10 12:21:44', '2025-10-10 12:21:44'),
(489, 65, 'sortie', '5179', 6, '2025-10-10 14:22:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-10 12:22:23', '2025-10-10 12:22:23'),
(490, 191, 'sortie', '3997', 1, '2025-10-10 14:22:00', 'Ajoutée manuellement pour l\'article \'metre 10m betta\'', '2025-10-10 12:22:39', '2025-10-10 12:22:39'),
(491, 191, 'sortie', '5319', 1, '2025-10-10 14:22:00', 'Ajoutée manuellement pour l\'article \'metre 10m betta\'', '2025-10-10 12:22:59', '2025-10-10 12:22:59'),
(492, 198, 'sortie', '4434', 1, '2025-10-10 14:22:00', 'Ajoutée manuellement pour l\'article \'kiteur vello 18\'', '2025-10-10 12:23:26', '2025-10-10 12:23:26'),
(493, 191, 'sortie', '4434', 1, '2025-10-10 14:23:00', 'Ajoutée manuellement pour l\'article \'metre 10m betta\'', '2025-10-10 12:23:45', '2025-10-10 12:23:45'),
(494, 197, 'entrée', 'L2025019376', 3, '2025-10-10 14:27:00', 'Ajoutée manuellement pour l\'article \'sipo tps-4c jetech\'', '2025-10-10 12:28:12', '2025-10-10 12:28:12'),
(496, 185, 'sortie', '4388', 2, '2025-10-10 14:52:00', 'Ajoutée manuellement pour l\'article \'tournevis dove plat\'', '2025-10-10 12:53:07', '2025-10-10 12:53:07'),
(497, 198, 'sortie', '4388', 2, '2025-10-10 14:53:00', 'Ajoutée manuellement pour l\'article \'kiteur vello 18\'', '2025-10-10 12:53:35', '2025-10-10 12:53:35'),
(498, 191, 'sortie', '4388', 1, '2025-10-10 14:53:00', 'Ajoutée manuellement pour l\'article \'metre 10m betta\'', '2025-10-10 12:54:08', '2025-10-10 12:54:08'),
(499, 198, 'sortie', '4672', 1, '2025-10-10 14:54:00', 'Ajoutée manuellement pour l\'article \'kiteur vello 18\'', '2025-10-10 12:54:26', '2025-10-10 12:54:26'),
(500, 97, 'sortie', '4052', 3, '2025-10-10 14:08:00', 'Ajoutée manuellement pour l\'article \'PRISE\'', '2025-10-10 13:08:56', '2025-10-10 13:08:56'),
(501, 95, 'sortie', '4052', 3, '2025-10-10 14:08:00', 'Ajoutée manuellement pour l\'article \'SAROTE\'', '2025-10-10 13:09:28', '2025-10-10 13:09:28'),
(502, 96, 'sortie', '4052', 3, '2025-10-10 15:09:00', 'Ajoutée manuellement pour l\'article \'DOUILLES\'', '2025-10-10 13:09:49', '2025-10-10 13:09:49'),
(503, 94, 'sortie', '4052', 6, '2025-10-10 15:09:00', 'Ajoutée manuellement pour l\'article \'boite rouge\'', '2025-10-10 13:10:24', '2025-10-10 13:10:24'),
(504, 100, 'sortie', '4052', 40, '2025-10-10 15:10:00', 'Ajoutée manuellement pour l\'article \'CABLE 3G 2,5 MM 100m\'', '2025-10-10 13:10:51', '2025-10-10 13:12:30'),
(505, 100, 'retour', '4052', 60, '2025-10-10 15:10:00', 'Retour enregistré pour l\'article CABLE 3G 2,5 MM 100m', '2025-10-10 13:12:30', '2025-10-10 13:12:30'),
(506, 92, 'sortie', 'abdeljalil dinar', 1, '2025-10-11 06:12:00', 'Ajoutée manuellement pour l\'article \'les lunettes\'', '2025-10-11 04:14:18', '2025-10-11 04:14:18'),
(507, 97, 'retour', '4077', 1, '2025-10-11 06:20:00', 'Retour enregistré pour l\'article PRISE', '2025-10-11 04:23:01', '2025-10-11 04:23:01'),
(508, 95, 'retour', '4077', 3, '2025-10-11 06:23:00', 'Retour enregistré pour l\'article SAROTE', '2025-10-11 04:24:06', '2025-10-11 04:24:06'),
(509, 96, 'retour', '4077', 3, '2025-10-11 06:24:00', 'Retour enregistré pour l\'article DOUILLES', '2025-10-11 04:24:58', '2025-10-11 04:24:58'),
(510, 94, 'retour', '4077', 2, '2025-10-11 06:24:00', 'Retour enregistré pour l\'article boite rouge', '2025-10-11 04:25:51', '2025-10-11 04:25:51'),
(511, 178, 'retour', '4692', 1, '2025-10-11 06:25:00', 'Retour enregistré pour l\'article bis 4,8x32 300p', '2025-10-11 04:26:48', '2025-10-11 04:26:48'),
(512, 58, 'sortie', '7157265', 2, '2025-10-11 06:14:00', 'Ajoutée manuellement pour l\'article \'PEINTURE vert (ENDES) 5KG\'', '2025-10-11 04:36:56', '2025-10-11 04:36:56'),
(513, 16, 'sortie', '7157265', 2, '2025-10-11 06:36:00', 'Ajoutée manuellement pour l\'article \'DILUANT (ENDES) 5L\'', '2025-10-11 04:37:12', '2025-10-11 04:37:12'),
(514, 191, 'sortie', '4868', 1, '2025-10-11 06:37:00', 'Ajoutée manuellement pour l\'article \'metre 10m betta\'', '2025-10-11 04:37:52', '2025-10-11 04:37:52'),
(515, 85, 'sortie', 'Abdellah El haoukali', 1, '2025-10-11 06:37:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-11 04:39:00', '2025-10-11 04:39:00'),
(516, 18, 'sortie', '7157263', 8, '2025-10-11 06:55:00', 'Ajoutée manuellement pour l\'article \'PAUMELLE 100\'', '2025-10-11 04:55:56', '2025-10-11 04:55:56'),
(517, 191, 'sortie', 'el Moum Abdelazize (empruntée en aluminium pour Marbre)', 1, '2025-10-11 06:55:00', 'Ajoutée manuellement pour l\'article \'metre 10m betta\'', '2025-10-11 05:07:03', '2025-10-11 05:07:03'),
(518, 198, 'sortie', '5428', 1, '2025-10-11 07:07:00', 'Ajoutée manuellement pour l\'article \'kiteur vello 18\'', '2025-10-11 05:10:31', '2025-10-11 05:10:31'),
(519, 185, 'sortie', '5319', 1, '2025-10-11 07:10:00', 'Ajoutée manuellement pour l\'article \'tournevis dove plat\'', '2025-10-11 05:43:03', '2025-10-11 05:43:03'),
(520, 186, 'sortie', '5319', 1, '2025-10-11 07:43:00', 'Ajoutée manuellement pour l\'article \'tournevis dove american\'', '2025-10-11 05:43:20', '2025-10-11 05:43:20'),
(521, 197, 'sortie', '5154', 1, '2025-10-11 07:43:00', 'Ajoutée manuellement pour l\'article \'sipo tps-4c jetech\'', '2025-10-11 05:44:13', '2025-10-11 05:44:13'),
(522, 187, 'sortie', '5154', 1, '2025-10-11 07:44:00', 'Ajoutée manuellement pour l\'article \'jeu cle sipo 308-2012 xcort\'', '2025-10-11 05:44:30', '2025-10-11 05:44:30'),
(523, 198, 'sortie', '4387', 1, '2025-10-11 07:44:00', 'Ajoutée manuellement pour l\'article \'kiteur vello 18\'', '2025-10-11 05:47:34', '2025-10-11 05:47:34'),
(524, 191, 'sortie', 'naji alum', 1, '2025-10-11 07:44:00', 'Ajoutée manuellement pour l\'article \'metre 10m betta\'', '2025-10-11 05:47:59', '2025-10-11 05:47:59'),
(525, 8, 'sortie', '4675', 50, '2025-10-11 08:13:00', 'Ajoutée manuellement pour l\'article \'DISQUE 230x1,9x22 BLEU (TIGOR) 50P\'', '2025-10-11 06:14:27', '2025-10-11 06:14:27'),
(526, 52, 'sortie', '0099188', 6, '2025-10-11 09:42:00', 'Ajoutée manuellement pour l\'article \'scotche\'', '2025-10-11 07:43:03', '2025-10-11 07:43:03'),
(527, 51, 'sortie', '0099188', 1, '2025-10-11 09:43:00', 'Ajoutée manuellement pour l\'article \'colla\'', '2025-10-11 07:43:58', '2025-10-11 07:43:58'),
(528, 54, 'sortie', '0099189', 2, '2025-10-11 09:43:00', 'Ajoutée manuellement pour l\'article \'chita\'', '2025-10-11 07:45:23', '2025-10-11 07:45:23'),
(529, 46, 'sortie', 'ismail jaafar', 4, '2025-10-11 09:46:00', 'Ajoutée manuellement pour l\'article \'disque 60\'', '2025-10-11 07:51:36', '2025-10-11 07:51:36'),
(530, 71, 'retour', 'hamid soudor', 1, '2025-10-08 09:58:00', 'Retour enregistré pour l\'article lamone grande (MEULEUSE GWS 2700W BOSCH)', '2025-10-11 07:59:39', '2025-10-11 07:59:39'),
(531, 71, 'sortie', 'hamid soudor (a retour)', 5, '2025-10-11 09:59:00', 'Ajoutée manuellement pour l\'article \'lamone grande (MEULEUSE GWS 2700W BOSCH)\'', '2025-10-11 08:00:18', '2025-10-11 08:00:18'),
(532, 188, 'sortie', '3889', 1, '2025-10-11 06:44:00', 'Ajoutée manuellement pour l\'article \'balais en plastique filtrage\' (modifié) (modifié)', '2025-10-11 08:08:02', '2025-10-11 08:13:01'),
(533, 189, 'sortie', '3889', 1, '2025-10-11 06:44:00', 'Ajoutée manuellement pour l\'article \'manche filtage\' (modifié)', '2025-10-11 08:08:28', '2025-10-11 08:13:26'),
(534, 188, 'sortie', '4388', 1, '2025-10-11 06:47:00', 'Ajoutée manuellement pour l\'article \'balais en plastique filtrage\' (modifié)', '2025-10-11 08:09:07', '2025-10-11 08:13:42'),
(535, 189, 'sortie', '4388', 1, '2025-10-11 06:47:00', 'Ajoutée manuellement pour l\'article \'manche filtage\' (modifié)', '2025-10-11 08:09:23', '2025-10-11 08:14:03'),
(536, 198, 'sortie', '4683', 1, '2025-10-11 10:16:00', 'Ajoutée manuellement pour l\'article \'kiteur vello 18\'', '2025-10-11 08:16:58', '2025-10-11 08:16:58'),
(537, 62, 'sortie', 'Abdellah El haoukali', 1, '2025-10-11 10:16:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-11 08:19:14', '2025-10-11 08:19:14'),
(538, 182, 'sortie', '5154', 50, '2025-10-11 10:19:00', 'Ajoutée manuellement pour l\'article \'kit fermeture S70R renf\'', '2025-10-11 08:21:37', '2025-10-11 08:21:37'),
(539, 65, 'sortie', '5428', 10, '2025-10-11 10:21:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-11 08:21:58', '2025-10-11 08:21:58'),
(540, 36, 'sortie', 'Mohmed El Moutaoukil', 2, '2025-10-11 10:21:00', 'Ajoutée manuellement pour l\'article \'crima\'', '2025-10-11 08:22:55', '2025-10-11 08:22:55'),
(541, 92, 'sortie', 'ahmed agma', 1, '2025-10-11 10:22:00', 'Ajoutée manuellement pour l\'article \'les lunettes\'', '2025-10-11 08:25:57', '2025-10-11 08:25:57'),
(542, 201, 'entrée', '02533', 2, '2025-10-11 12:15:00', 'Ajoutée manuellement pour l\'article \'colle flambo 5L\'', '2025-10-11 10:16:33', '2025-10-11 10:16:33'),
(543, 58, 'sortie', '4256197', 2, '2025-10-11 10:25:00', 'Ajoutée manuellement pour l\'article \'PEINTURE vert (ENDES) 5KG\'', '2025-10-11 10:20:28', '2025-10-11 10:20:28'),
(544, 16, 'sortie', '4256197', 1, '2025-10-11 12:20:00', 'Ajoutée manuellement pour l\'article \'DILUANT (ENDES) 5L\'', '2025-10-11 10:20:59', '2025-10-11 10:20:59'),
(545, 188, 'sortie', '5454 (empruntée en aluminium pour atelier BA 13)', 1, '2025-10-11 12:20:00', 'Ajoutée manuellement pour l\'article \'balais en plastique filtrage\' (modifié)', '2025-10-11 10:22:47', '2025-10-11 12:07:34'),
(546, 189, 'sortie', '5454 (empruntée en aluminium pour atelier BA 13)', 1, '2025-10-11 12:22:00', 'Ajoutée manuellement pour l\'article \'manche filtage\' (modifié)', '2025-10-11 10:22:57', '2025-10-11 12:08:37'),
(547, 201, 'sortie', '4675', 1, '2025-10-11 12:22:00', 'Ajoutée manuellement pour l\'article \'colle flambo 5L\'', '2025-10-11 10:24:32', '2025-10-11 10:24:32'),
(548, 64, 'sortie', '5154', 1, '2025-10-11 12:26:00', 'Ajoutée manuellement pour l\'article \'soulofan grand\'', '2025-10-11 10:26:40', '2025-10-11 10:26:40'),
(549, 198, 'sortie', '4320', 1, '2025-10-11 12:26:00', 'Ajoutée manuellement pour l\'article \'kiteur vello 18\'', '2025-10-11 10:27:34', '2025-10-11 10:27:34'),
(550, 65, 'sortie', '4320', 5, '2025-10-11 12:27:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-11 10:27:54', '2025-10-11 10:27:54'),
(551, 202, 'sortie', '4692', 1, '2025-10-11 12:33:00', 'Ajoutée manuellement pour l\'article \'led 18g132\'', '2025-10-11 10:34:12', '2025-10-11 11:36:56'),
(552, 100, 'sortie', '4692', 15, '2025-10-11 12:34:00', 'Ajoutée manuellement pour l\'article \'CABLE 3G 2,5 MM 100m\'', '2025-10-11 10:34:44', '2025-10-11 11:37:48'),
(553, 65, 'sortie', '5179', 2, '2025-10-11 12:34:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-11 11:02:57', '2025-10-11 11:02:57'),
(554, 199, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 2, '2025-10-11 13:07:00', 'Ajoutée manuellement pour l\'article \'perforateur hikoki\'', '2025-10-11 11:10:52', '2025-10-11 11:10:52'),
(555, 200, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 5, '2025-10-11 13:10:00', 'Ajoutée manuellement pour l\'article \'perceuse 750w 13mm Ronix\'', '2025-10-11 11:11:20', '2025-10-11 11:11:20'),
(556, 203, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 5, '2025-10-11 13:11:00', 'Ajoutée manuellement pour l\'article \'visseuse perceuse 20v ronix\'', '2025-10-11 11:12:15', '2025-10-11 11:12:15'),
(557, 204, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 3, '2025-10-11 13:12:00', 'Ajoutée manuellement pour l\'article \'meuleuse hikoki\'', '2025-10-11 11:12:34', '2025-10-11 11:12:34'),
(558, 205, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 4, '2025-10-11 13:12:00', 'Ajoutée manuellement pour l\'article \'marteau  en caoutchonc\'', '2025-10-11 11:13:38', '2025-10-11 11:13:38'),
(559, 206, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 8, '2025-10-11 13:13:00', 'Ajoutée manuellement pour l\'article \'pistolet wokin\'', '2025-10-11 11:14:03', '2025-10-11 11:14:03'),
(560, 207, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 3, '2025-10-11 13:14:00', 'Ajoutée manuellement pour l\'article \'massette 1kg\'', '2025-10-11 11:14:24', '2025-10-11 11:14:24'),
(561, 208, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 10, '2025-10-11 13:14:00', 'Ajoutée manuellement pour l\'article \'massette 2kg\'', '2025-10-11 11:17:34', '2025-10-11 11:17:34'),
(562, 209, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 3, '2025-10-11 13:17:00', 'Ajoutée manuellement pour l\'article \'jeu cle utrar\'', '2025-10-11 11:20:28', '2025-10-11 11:20:28'),
(563, 210, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 7, '2025-10-11 13:20:00', 'Ajoutée manuellement pour l\'article \'jeu cle male torx\'', '2025-10-11 11:20:43', '2025-10-11 11:20:43'),
(564, 211, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 4, '2025-10-11 13:20:00', 'Ajoutée manuellement pour l\'article \'pince etaux toptal\'', '2025-10-11 11:21:32', '2025-10-11 11:21:32'),
(565, 212, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 4, '2025-10-11 13:21:00', 'Ajoutée manuellement pour l\'article \'pince Etaux wokin\'', '2025-10-11 11:21:52', '2025-10-11 11:21:52'),
(566, 213, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 7, '2025-10-11 13:21:00', 'Ajoutée manuellement pour l\'article \'caisse outils\'', '2025-10-11 11:22:20', '2025-10-11 11:22:20'),
(567, 214, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 9, '2025-10-11 13:22:00', 'Ajoutée manuellement pour l\'article \'scie\'', '2025-10-11 11:22:38', '2025-10-11 11:22:38'),
(568, 215, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 7, '2025-10-11 13:22:00', 'Ajoutée manuellement pour l\'article \'agraffes JBM (boite)\'', '2025-10-11 11:23:00', '2025-10-11 11:23:00'),
(569, 220, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 6, '2025-10-11 13:24:00', 'Ajoutée manuellement pour l\'article \'venteuse triple wokin\'', '2025-10-11 11:24:27', '2025-10-11 11:24:27'),
(570, 216, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 657, '2025-10-11 13:24:00', 'Ajoutée manuellement pour l\'article \'masking tape\'', '2025-10-11 11:25:34', '2025-10-11 11:25:34'),
(571, 202, 'retour', '4692', 1, '2025-10-11 13:36:00', 'Retour enregistré pour l\'article led 18g132', '2025-10-11 11:36:56', '2025-10-11 11:36:56'),
(572, 100, 'retour', '4692', 30, '2025-10-11 13:36:00', 'Retour enregistré pour l\'article CABLE 3G 2,5 MM 100m', '2025-10-11 11:37:48', '2025-10-11 11:37:48'),
(573, 62, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 92, '2025-10-11 13:25:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-11 11:43:43', '2025-10-11 11:43:43'),
(574, 64, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 28, '2025-10-11 13:43:00', 'Ajoutée manuellement pour l\'article \'soulofan grand\'', '2025-10-11 11:45:19', '2025-10-11 11:45:19'),
(575, 176, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 9, '2025-10-11 13:45:00', 'Ajoutée manuellement pour l\'article \'CHEVILLES EN PLASTIC 10 MM\' (modifié)', '2025-10-11 11:46:28', '2025-10-16 07:39:06'),
(576, 188, 'sortie', '0099186 (empruntée en aluminium pour atelier Marbre)', 1, '2025-10-11 13:48:00', 'Ajoutée manuellement pour l\'article \'balais en plastique filtrage\' (modifié)', '2025-10-11 11:50:35', '2025-10-11 12:06:19'),
(577, 189, 'sortie', '0099186 (empruntée en aluminium pour atelier marbre)', 1, '2025-10-11 13:50:00', 'Ajoutée manuellement pour l\'article \'manche filtage\'', '2025-10-11 11:51:11', '2025-10-11 11:51:11'),
(578, 217, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 10, '2025-10-11 14:09:00', 'Ajoutée manuellement pour l\'article \'bis spax 6x80 (meridyen) 200p\'', '2025-10-11 12:10:19', '2025-10-11 12:10:19'),
(579, 218, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 5, '2025-10-11 14:10:00', 'Ajoutée manuellement pour l\'article \'bis blind rivets 4x20 500p\'', '2025-10-11 12:11:10', '2025-10-11 12:11:10'),
(580, 219, 'entrée', 'bon de transfert provisoire de Ghaya à AMV 11-10-25', 8, '2025-10-11 14:11:00', 'Ajoutée manuellement pour l\'article \'bis 3,5x25 index 500p\'', '2025-10-11 12:11:54', '2025-10-11 12:11:54'),
(581, 102, 'retour', '4692', 1, '2025-10-09 14:53:00', 'Retour enregistré pour l\'article CHEVILLES  EN PLASTIQUE 10MM (INGELEC)', '2025-10-11 12:55:14', '2025-10-11 12:55:14'),
(582, 172, 'retour', '4692', 2, '2025-10-09 14:22:00', 'Retour enregistré pour l\'article prise 2p + T etranche apparent gris fonce', '2025-10-11 13:02:35', '2025-10-11 13:02:35'),
(583, 52, 'sortie', '0099190', 6, '2025-10-12 08:14:00', 'Ajoutée manuellement pour l\'article \'scotche\'', '2025-10-13 04:16:19', '2025-10-13 04:16:19'),
(584, 65, 'sortie', 'oussama  lhroumi', 85, '2025-10-12 09:16:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\' (modifié)', '2025-10-13 04:19:02', '2025-10-13 04:28:42'),
(585, 31, 'sortie', '7157262', 1, '2025-10-13 06:19:00', 'Ajoutée manuellement pour l\'article \'SBAT 41\'', '2025-10-13 04:20:54', '2025-10-13 04:20:54'),
(586, 31, 'sortie', '4256196', 1, '2025-10-13 06:20:00', 'Ajoutée manuellement pour l\'article \'SBAT 41\'', '2025-10-13 04:21:20', '2025-10-13 04:21:20'),
(587, 137, 'sortie', '5154', 40, '2025-10-12 06:29:00', 'Ajoutée manuellement pour l\'article \'CLAME 70\'', '2025-10-13 04:30:06', '2025-10-13 04:30:06'),
(588, 65, 'sortie', '5123', 8, '2025-10-12 09:30:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-13 04:33:23', '2025-10-13 04:33:23'),
(589, 137, 'sortie', '4243', 50, '2025-10-13 06:34:00', 'Ajoutée manuellement pour l\'article \'CLAME 70\'', '2025-10-13 04:51:15', '2025-10-13 04:51:15'),
(590, 197, 'sortie', '4672', 1, '2025-10-13 07:26:00', 'Ajoutée manuellement pour l\'article \'sipo tps-4c jetech\'', '2025-10-13 05:26:40', '2025-10-13 05:26:40'),
(591, 186, 'sortie', 'naji alum', 1, '2025-10-13 07:26:00', 'Ajoutée manuellement pour l\'article \'tournevis dove american\'', '2025-10-13 05:28:38', '2025-10-13 05:28:38'),
(592, 198, 'sortie', '5259', 1, '2025-10-13 07:48:00', 'Ajoutée manuellement pour l\'article \'kiteur vello 18\'', '2025-10-13 05:49:21', '2025-10-13 05:49:21'),
(593, 85, 'sortie', 'abdeljalil riad', 1, '2025-10-13 07:49:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-13 05:50:19', '2025-10-13 05:50:19'),
(594, 85, 'sortie', 'Ismail Houra', 1, '2025-10-13 07:50:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-13 05:50:58', '2025-10-13 05:50:58'),
(595, 187, 'sortie', '5259', 1, '2025-10-13 07:50:00', 'Ajoutée manuellement pour l\'article \'jeu cle sipo 308-2012 xcort\'', '2025-10-13 05:51:23', '2025-10-13 05:51:23'),
(596, 185, 'sortie', '5259', 1, '2025-10-13 07:51:00', 'Ajoutée manuellement pour l\'article \'tournevis dove plat\'', '2025-10-13 05:51:44', '2025-10-13 05:51:44'),
(597, 137, 'sortie', '4672', 50, '2025-10-13 07:57:00', 'Ajoutée manuellement pour l\'article \'CLAME 70\'', '2025-10-13 05:58:15', '2025-10-13 05:58:15'),
(598, 139, 'sortie', 'naji alum', 1, '2025-10-13 07:58:00', 'Ajoutée manuellement pour l\'article \'CLAME Domino fix\'', '2025-10-13 06:05:09', '2025-10-13 06:05:09'),
(599, 182, 'sortie', '5181', 50, '2025-10-13 08:05:00', 'Ajoutée manuellement pour l\'article \'kit fermeture S70R renf\'', '2025-10-13 06:18:28', '2025-10-13 06:18:28'),
(600, 62, 'sortie', '4868', 1, '2025-10-13 09:10:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-13 07:11:33', '2025-10-13 07:11:33'),
(601, 62, 'sortie', 'abdejlil riad', 1, '2025-10-13 09:11:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-13 07:13:11', '2025-10-13 07:13:11'),
(602, 32, 'sortie', '4675', 1, '2025-10-13 09:13:00', 'Ajoutée manuellement pour l\'article \'SBAT 42\'', '2025-10-13 07:19:27', '2025-10-13 07:19:27'),
(603, 176, 'sortie', '000383', 1, '2025-10-13 09:19:00', 'Ajoutée manuellement pour l\'article \'CHEVILLES EN PLASTIC 10 MM\'', '2025-10-13 07:20:01', '2025-10-13 07:20:01'),
(604, 93, 'sortie', '000383', 5, '2025-10-13 09:20:00', 'Ajoutée manuellement pour l\'article \'DISQUE 115x1,6x22,2 MM (atlas) 25P\'', '2025-10-13 07:21:03', '2025-10-13 07:21:03'),
(605, 185, 'sortie', '000383', 1, '2025-10-13 09:21:00', 'Ajoutée manuellement pour l\'article \'tournevis dove plat\'', '2025-10-13 07:21:38', '2025-10-13 07:21:38'),
(606, 186, 'sortie', '000383', 1, '2025-10-13 09:21:00', 'Ajoutée manuellement pour l\'article \'tournevis dove american\'', '2025-10-13 07:21:49', '2025-10-13 07:21:49'),
(607, 194, 'sortie', '000383', 1, '2025-10-13 09:21:00', 'Ajoutée manuellement pour l\'article \'meche a fer 6 inox bosch\' (modifié) (modifié)', '2025-10-13 07:22:15', '2025-10-20 09:00:39'),
(608, 195, 'sortie', '000383', 1, '2025-10-13 09:22:00', 'Ajoutée manuellement pour l\'article \'meche a fer 8 inox bosch\' (modifié) (modifié)', '2025-10-13 07:22:27', '2025-10-20 09:00:54'),
(609, 193, 'sortie', '000383', 1, '2025-10-13 09:22:00', 'Ajoutée manuellement pour l\'article \'meche a fer 10 inox bosch\' (modifié) (modifié)', '2025-10-13 07:22:49', '2025-10-20 09:01:08'),
(610, 220, 'sortie', '000383', 1, '2025-10-13 09:22:00', 'Ajoutée manuellement pour l\'article \'venteuse triple wokin\'', '2025-10-13 07:24:56', '2025-10-13 07:24:56'),
(611, 207, 'sortie', '000383', 1, '2025-10-13 09:24:00', 'Ajoutée manuellement pour l\'article \'massette 1kg\'', '2025-10-13 07:25:24', '2025-10-13 07:25:24'),
(612, 205, 'sortie', '000383', 1, '2025-10-13 09:25:00', 'Ajoutée manuellement pour l\'article \'marteau  en caoutchonc\'', '2025-10-13 07:26:22', '2025-10-13 07:26:22'),
(613, 209, 'sortie', '000383', 1, '2025-10-13 09:26:00', 'Ajoutée manuellement pour l\'article \'jeu cle utrar\'', '2025-10-13 07:26:46', '2025-10-13 07:26:46'),
(614, 190, 'sortie', '000383', 1, '2025-10-13 09:26:00', 'Ajoutée manuellement pour l\'article \'pistolet silicone\'', '2025-10-13 07:27:09', '2025-10-13 07:27:09'),
(615, 204, 'sortie', '000384', 1, '2025-10-13 09:27:00', 'Ajoutée manuellement pour l\'article \'meuleuse hikoki\'', '2025-10-13 07:27:47', '2025-10-13 07:27:47'),
(616, 203, 'sortie', '000384', 1, '2025-10-13 09:27:00', 'Ajoutée manuellement pour l\'article \'visseuse perceuse 20v ronix\'', '2025-10-13 07:28:04', '2025-10-13 07:28:04'),
(617, 44, 'sortie', 'mourad choukaira', 1, '2025-10-13 09:37:00', 'Ajoutée manuellement pour l\'article \'passta blanche\'', '2025-10-13 07:38:20', '2025-10-13 07:38:20'),
(618, 205, 'sortie', '5122', 1, '2025-10-13 09:38:00', 'Ajoutée manuellement pour l\'article \'marteau  en caoutchonc\'', '2025-10-13 07:40:57', '2025-10-13 07:40:57'),
(619, 182, 'sortie', 'ahmed agma', 50, '2025-10-13 09:40:00', 'Ajoutée manuellement pour l\'article \'kit fermeture S70R renf\'', '2025-10-13 07:41:20', '2025-10-13 07:41:20'),
(620, 221, 'sortie', '000384', 1, '2025-10-13 09:42:00', 'Ajoutée manuellement pour l\'article \'bis 4,8x38 500p (panel\'', '2025-10-13 07:42:36', '2025-10-13 07:42:36'),
(621, 191, 'sortie', '000384', 1, '2025-10-13 09:42:00', 'Ajoutée manuellement pour l\'article \'metre 10m betta\'', '2025-10-13 07:43:10', '2025-10-13 07:43:10'),
(622, 60, 'sortie', '000385', 2, '2025-10-13 09:43:00', 'Ajoutée manuellement pour l\'article \'selecone akfix 12P\'', '2025-10-13 07:43:54', '2025-10-13 07:43:54'),
(623, 217, 'sortie', '000385', 1, '2025-10-13 09:43:00', 'Ajoutée manuellement pour l\'article \'bis spax 6x80 (meridyen) 200p\'', '2025-10-13 07:44:11', '2025-10-13 07:44:11'),
(624, 211, 'sortie', '000385', 1, '2025-10-13 09:44:00', 'Ajoutée manuellement pour l\'article \'pince etaux toptal\'', '2025-10-13 07:44:31', '2025-10-13 07:44:31'),
(625, 219, 'sortie', '000385', 1, '2025-10-13 09:44:00', 'Ajoutée manuellement pour l\'article \'bis 3,5x25 index 500p\'', '2025-10-13 07:45:07', '2025-10-13 07:45:07'),
(626, 218, 'sortie', '000385', 1, '2025-10-13 09:45:00', 'Ajoutée manuellement pour l\'article \'bis blind rivets 4x20 500p\'', '2025-10-13 07:45:17', '2025-10-13 07:45:17'),
(627, 137, 'sortie', '4672', 50, '2025-10-13 10:29:00', 'Ajoutée manuellement pour l\'article \'CLAME 70\'', '2025-10-13 08:29:21', '2025-10-13 08:29:21'),
(628, 137, 'sortie', '5319', 36, '2025-10-13 10:32:00', 'Ajoutée manuellement pour l\'article \'CLAME 70\'', '2025-10-13 08:33:20', '2025-10-13 08:33:20');
INSERT INTO `stock_movements` (`id`, `stock_id`, `type`, `reference`, `quantite`, `date_movement`, `note`, `created_at`, `updated_at`) VALUES
(629, 62, 'sortie', '4387', 1, '2025-10-13 10:33:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-13 08:37:09', '2025-10-13 08:37:09'),
(630, 42, 'sortie', '0099187', 1, '2025-10-13 10:37:00', 'Ajoutée manuellement pour l\'article \'metre 5m ord\'', '2025-10-13 08:37:30', '2025-10-13 08:37:30'),
(631, 65, 'sortie', '5342', 4, '2025-10-13 10:37:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-13 08:43:04', '2025-10-13 08:43:04'),
(633, 72, 'entrée', 'L2025019603', 2, '2025-10-13 12:00:00', 'Ajoutée manuellement pour l\'article \'lamone  petite (MEULEUSE GWS 270W BOSCH)\'', '2025-10-13 10:07:18', '2025-10-13 10:07:18'),
(634, 187, 'sortie', 'abdelah bouraja', 1, '2025-10-13 10:43:00', 'Ajoutée manuellement pour l\'article \'jeu cle sipo 308-2012 xcort\'', '2025-10-13 10:20:09', '2025-10-13 10:20:09'),
(635, 85, 'sortie', 'Rida wadouni', 1, '2025-10-13 12:20:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-13 10:22:24', '2025-10-13 10:22:24'),
(636, 64, 'sortie', 'Ali khouya-omar (empruntée en aluminium pour BA 13)', 2, '2025-10-13 12:22:00', 'Ajoutée manuellement pour l\'article \'soulofan grand\' (modifié)', '2025-10-13 10:26:41', '2025-10-13 10:40:57'),
(637, 58, 'sortie', '4256195', 2, '2025-10-13 12:26:00', 'Ajoutée manuellement pour l\'article \'PEINTURE vert (ENDES) 5KG\'', '2025-10-13 10:27:05', '2025-10-13 10:27:05'),
(638, 62, 'sortie', '3997', 1, '2025-10-13 08:08:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-13 10:31:33', '2025-10-13 10:31:33'),
(640, 4, 'sortie', '4256194', 1, '2025-10-13 13:07:00', 'Ajoutée manuellement pour l\'article \'PEINTURE BLUE (ATLAS) 5KG\'', '2025-10-13 11:08:27', '2025-10-13 11:08:27'),
(641, 205, 'sortie', '5181', 1, '2025-10-13 14:06:00', 'Ajoutée manuellement pour l\'article \'marteau  en caoutchonc\'', '2025-10-13 12:07:11', '2025-10-13 12:07:11'),
(642, 58, 'sortie', '4256193', 2, '2025-10-13 14:07:00', 'Ajoutée manuellement pour l\'article \'PEINTURE vert (ENDES) 5KG\'', '2025-10-13 12:24:30', '2025-10-13 12:24:30'),
(643, 61, 'sortie', '5122', 1, '2025-10-13 14:26:00', 'Ajoutée manuellement pour l\'article \'scotche blanche 72P\'', '2025-10-13 12:26:38', '2025-10-13 12:26:38'),
(644, 65, 'sortie', 'abdellah el houkali', 3, '2025-10-13 14:34:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-13 12:35:06', '2025-10-13 12:35:06'),
(647, 52, 'sortie', '0099192', 6, '2025-10-14 12:34:00', 'Ajoutée manuellement pour l\'article \'scotche\'', '2025-10-14 10:34:43', '2025-10-14 10:34:43'),
(648, 51, 'sortie', '0099192', 1, '2025-10-14 12:34:00', 'Ajoutée manuellement pour l\'article \'colla\'', '2025-10-14 10:35:07', '2025-10-14 10:35:07'),
(649, 52, 'sortie', '0099191', 6, '2025-10-14 12:35:00', 'Ajoutée manuellement pour l\'article \'scotche\'', '2025-10-14 10:35:37', '2025-10-14 10:35:37'),
(650, 42, 'sortie', '0099188', 1, '2025-10-14 12:35:00', 'Ajoutée manuellement pour l\'article \'metre 5m ord\'', '2025-10-14 10:36:15', '2025-10-14 10:36:15'),
(651, 44, 'sortie', '0099189', 1, '2025-10-14 12:36:00', 'Ajoutée manuellement pour l\'article \'passta blanche\' (modifié)', '2025-10-14 10:36:45', '2025-10-15 04:33:32'),
(652, 33, 'sortie', '4256192', 25, '2025-10-14 12:36:00', 'Ajoutée manuellement pour l\'article \'DISQUE 300x3,5x25,4 MM NOIRE (ATLAS) 25P\'', '2025-10-14 10:37:35', '2025-10-14 10:37:35'),
(653, 137, 'sortie', '4672', 50, '2025-10-14 12:37:00', 'Ajoutée manuellement pour l\'article \'CLAME 70\'', '2025-10-14 10:38:22', '2025-10-14 10:38:22'),
(654, 182, 'sortie', '4672', 50, '2025-10-14 12:38:00', 'Ajoutée manuellement pour l\'article \'kit fermeture S70R renf\'', '2025-10-14 10:38:46', '2025-10-14 10:38:46'),
(655, 137, 'sortie', '4868', 50, '2025-10-14 12:38:00', 'Ajoutée manuellement pour l\'article \'CLAME 70\'', '2025-10-14 10:39:28', '2025-10-14 10:39:28'),
(656, 182, 'sortie', '4868', 50, '2025-10-14 12:39:00', 'Ajoutée manuellement pour l\'article \'kit fermeture S70R renf\'', '2025-10-14 10:40:28', '2025-10-14 10:40:28'),
(658, 65, 'sortie', '4387', 85, '2025-10-14 12:40:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-14 10:41:04', '2025-10-14 10:41:04'),
(659, 69, 'sortie', '4387', 1, '2025-10-14 12:41:00', 'Ajoutée manuellement pour l\'article \'bis 4,8x60 200p\'', '2025-10-14 10:41:51', '2025-10-14 10:41:51'),
(660, 205, 'sortie', 'Abdeljalil Dinar', 1, '2025-10-14 12:41:00', 'Ajoutée manuellement pour l\'article \'marteau  en caoutchonc\' (modifié)', '2025-10-14 10:42:13', '2025-10-14 10:42:45'),
(661, 62, 'sortie', 'Gestion magasin', 1, '2025-10-14 12:42:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-14 10:43:14', '2025-10-14 10:43:14'),
(662, 85, 'sortie', 'mohmed bakhecho', 1, '2025-10-14 12:43:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-14 10:43:49', '2025-10-14 10:43:49'),
(663, 85, 'sortie', 'nabil Bouziad', 1, '2025-10-14 12:43:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-14 10:44:25', '2025-10-14 10:44:25'),
(664, 64, 'sortie', 'said Najah (empruntée en aluminium pour BA 13)', 1, '2025-10-14 12:47:00', 'Ajoutée manuellement pour l\'article \'soulofan grand\'', '2025-10-14 10:48:01', '2025-10-14 10:48:01'),
(665, 187, 'sortie', 'naji alum', 1, '2025-10-14 12:48:00', 'Ajoutée manuellement pour l\'article \'jeu cle sipo 308-2012 xcort\'', '2025-10-14 10:50:36', '2025-10-14 10:50:36'),
(666, 62, 'sortie', '4256191 (empruntée en aluminium pour Soudor)', 2, '2025-10-14 13:41:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-14 11:43:12', '2025-10-14 11:43:12'),
(667, 16, 'sortie', '4256190', 2, '2025-10-14 13:55:00', 'Ajoutée manuellement pour l\'article \'DILUANT (ENDES) 5L\'', '2025-10-14 11:55:30', '2025-10-14 11:55:30'),
(669, 127, 'retour', '4672', 1, '2025-10-14 14:19:00', 'Retour enregistré pour l\'article roullette fer (rwayde)', '2025-10-14 12:21:11', '2025-10-14 12:21:11'),
(670, 122, 'sortie', '4672', 1, '2025-10-14 14:21:00', 'Ajoutée manuellement pour l\'article \'roullette plastique (rwayde)\'', '2025-10-14 12:22:22', '2025-10-14 12:22:22'),
(671, 36, 'sortie', '0099191', 2, '2025-10-15 06:07:00', 'Ajoutée manuellement pour l\'article \'crima\'', '2025-10-15 04:08:12', '2025-10-15 04:08:12'),
(672, 47, 'sortie', '0099191', 6, '2025-10-15 06:08:00', 'Ajoutée manuellement pour l\'article \'disque 220\'', '2025-10-15 04:08:42', '2025-10-15 04:08:42'),
(673, 38, 'sortie', '0099191', 6, '2025-10-15 06:08:00', 'Ajoutée manuellement pour l\'article \'disque 400\'', '2025-10-15 04:09:10', '2025-10-15 04:09:10'),
(674, 32, 'sortie', '5862', 1, '2025-10-15 06:24:00', 'Ajoutée manuellement pour l\'article \'SBAT 42\'', '2025-10-15 04:24:23', '2025-10-15 04:24:23'),
(676, 171, 'sortie', 'naji alum (empruntée en  marbre pour aluminium)', 1, '2025-10-14 12:40:00', 'Ajoutée manuellement pour l\'article \'casque anti bruit\' (modifié)', '2025-10-15 04:44:47', '2025-10-15 04:48:08'),
(677, 8, 'sortie', '4256189', 50, '2025-10-15 06:44:00', 'Ajoutée manuellement pour l\'article \'DISQUE 230x1,9x22 BLEU (TIGOR) 50P\'', '2025-10-15 04:45:34', '2025-10-15 04:45:34'),
(678, 6, 'sortie', '4256188', 2, '2025-10-15 07:05:00', 'Ajoutée manuellement pour l\'article \'PEINTURE NOIRE (ATLAS) 5KG\'', '2025-10-15 05:06:28', '2025-10-15 05:06:28'),
(679, 16, 'sortie', '4256188', 2, '2025-10-15 07:06:00', 'Ajoutée manuellement pour l\'article \'DILUANT (ENDES) 5L\'', '2025-10-15 05:07:11', '2025-10-15 05:07:11'),
(680, 137, 'sortie', '5766', 50, '2025-10-15 07:37:00', 'Ajoutée manuellement pour l\'article \'CLAME 70\'', '2025-10-15 05:39:10', '2025-10-15 05:39:10'),
(681, 194, 'sortie', '5154', 2, '2025-10-15 07:41:00', 'Ajoutée manuellement pour l\'article \'meche a fer 6 inox bosch\'', '2025-10-15 05:42:01', '2025-10-15 05:42:01'),
(682, 60, 'sortie', '5154', 2, '2025-10-15 07:42:00', 'Ajoutée manuellement pour l\'article \'selecone akfix 12P\'', '2025-10-15 05:42:28', '2025-10-15 05:42:28'),
(683, 178, 'sortie', '5154', 1, '2025-10-15 07:42:00', 'Ajoutée manuellement pour l\'article \'bis 4,8x32 300p\'', '2025-10-15 05:42:53', '2025-10-15 05:42:53'),
(684, 190, 'sortie', '5154', 1, '2025-10-15 07:42:00', 'Ajoutée manuellement pour l\'article \'pistolet silicone\'', '2025-10-15 05:44:39', '2025-10-15 05:44:39'),
(685, 193, 'sortie', '5154', 1, '2025-10-15 07:44:00', 'Ajoutée manuellement pour l\'article \'meche a fer 10 inox bosch\'', '2025-10-15 05:45:05', '2025-10-15 05:45:05'),
(686, 192, 'sortie', '5154', 1, '2025-10-15 07:45:00', 'Ajoutée manuellement pour l\'article \'meche a fer 4 inox bosch\'', '2025-10-15 05:45:25', '2025-10-15 05:45:25'),
(687, 204, 'sortie', '5154', 1, '2025-10-15 07:45:00', 'Ajoutée manuellement pour l\'article \'meuleuse hikoki\'', '2025-10-15 05:45:46', '2025-10-15 05:45:46'),
(688, 207, 'sortie', '5154', 1, '2025-10-15 07:45:00', 'Ajoutée manuellement pour l\'article \'massette 1kg\'', '2025-10-15 05:45:58', '2025-10-15 05:45:58'),
(689, 93, 'sortie', '5154', 1, '2025-10-15 07:45:00', 'Ajoutée manuellement pour l\'article \'DISQUE 115x1,6x22,2 MM (atlas) 25P\'', '2025-10-15 05:48:34', '2025-10-15 05:48:34'),
(690, 211, 'sortie', '5154', 1, '2025-10-15 07:48:00', 'Ajoutée manuellement pour l\'article \'pince etaux toptal\'', '2025-10-15 05:48:58', '2025-10-15 05:48:58'),
(691, 64, 'sortie', '5260', 1, '2025-10-15 07:48:00', 'Ajoutée manuellement pour l\'article \'soulofan grand\'', '2025-10-15 05:49:12', '2025-10-15 05:49:12'),
(692, 64, 'sortie', '5260', 1, '2025-10-15 08:39:00', 'Ajoutée manuellement pour l\'article \'soulofan grand\'', '2025-10-15 06:55:27', '2025-10-15 06:55:27'),
(693, 122, 'sortie', '5882', 1, '2025-10-15 09:10:00', 'Ajoutée manuellement pour l\'article \'roullette plastique (rwayde)\'', '2025-10-15 07:11:51', '2025-10-15 07:11:51'),
(694, 92, 'sortie', '5825', 1, '2025-10-15 09:13:00', 'Ajoutée manuellement pour l\'article \'les lunettes\'', '2025-10-15 07:14:11', '2025-10-15 07:14:11'),
(695, 122, 'sortie', '5123', 1, '2025-10-15 09:32:00', 'Ajoutée manuellement pour l\'article \'roullette plastique (rwayde)\'', '2025-10-15 07:33:12', '2025-10-15 07:33:12'),
(696, 55, 'sortie', 'oussama arabi', 1, '2025-10-15 09:33:00', 'Ajoutée manuellement pour l\'article \'les lunettes\'', '2025-10-15 08:00:44', '2025-10-15 08:00:44'),
(697, 56, 'sortie', 'oussama arabi', 1, '2025-10-15 10:00:00', 'Ajoutée manuellement pour l\'article \'pavite\'', '2025-10-15 08:01:33', '2025-10-15 08:01:33'),
(698, 64, 'sortie', '5260', 1, '2025-10-15 10:01:00', 'Ajoutée manuellement pour l\'article \'soulofan grand\'', '2025-10-15 08:07:56', '2025-10-15 08:07:56'),
(701, 61, 'emprunt', 'naji alum', 1, '2025-10-15 10:36:00', 'Empruntée manuellement pour l\'article \'scotche blanche 72P\'', '2025-10-15 08:38:10', '2025-10-15 08:38:10'),
(702, 62, 'emprunt', 'naji alum', 1, '2025-10-15 10:38:00', 'Empruntée manuellement pour l\'article \'scotche embalage\'', '2025-10-15 08:38:31', '2025-10-15 08:38:31'),
(703, 220, 'sortie', '5342', 2, '2025-10-15 12:07:00', 'Ajoutée manuellement pour l\'article \'venteuse triple wokin\'', '2025-10-15 10:07:57', '2025-10-15 10:07:57'),
(704, 42, 'sortie', '0099192', 2, '2025-10-15 12:07:00', 'Ajoutée manuellement pour l\'article \'metre 5m ord\'', '2025-10-15 10:47:56', '2025-10-15 10:47:56'),
(705, 64, 'sortie', '5260', 1, '2025-10-15 12:47:00', 'Ajoutée manuellement pour l\'article \'soulofan grand\'', '2025-10-15 10:48:17', '2025-10-15 10:48:17'),
(706, 8, 'sortie', '5418', 50, '2025-10-15 13:23:00', 'Ajoutée manuellement pour l\'article \'DISQUE 230x1,9x22 BLEU (TIGOR) 50P\'', '2025-10-15 11:24:09', '2025-10-15 11:24:09'),
(707, 16, 'sortie', '4979', 2, '2025-10-15 13:24:00', 'Ajoutée manuellement pour l\'article \'DILUANT (ENDES) 5L\'', '2025-10-15 11:25:13', '2025-10-15 11:25:13'),
(708, 61, 'sortie', 'naji alum', 1, '2025-10-15 10:05:00', 'Ajoutée manuellement pour l\'article \'scotche blanche 72P\'', '2025-10-15 11:42:12', '2025-10-15 11:42:12'),
(709, 62, 'sortie', 'naji alum', 1, '2025-10-15 10:05:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-15 11:43:18', '2025-10-15 11:43:18'),
(710, 65, 'sortie', '5260', 1, '2025-10-15 13:43:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-15 11:44:25', '2025-10-15 11:44:25'),
(711, 65, 'sortie', '4868', 1, '2025-10-15 13:44:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-15 11:44:49', '2025-10-15 11:44:49'),
(712, 122, 'sortie', '5123', 1, '2025-10-15 13:44:00', 'Ajoutée manuellement pour l\'article \'roullette plastique (rwayde)\'', '2025-10-15 11:45:42', '2025-10-15 11:45:42'),
(713, 178, 'sortie', '4387', 1, '2025-10-15 13:45:00', 'Ajoutée manuellement pour l\'article \'bis 4,8x32 300p\'', '2025-10-15 11:47:11', '2025-10-15 11:47:11'),
(714, 62, 'sortie', 'Rida wadouni', 1, '2025-10-15 13:47:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-15 11:48:45', '2025-10-15 11:48:45'),
(715, 186, 'sortie', '5428', 1, '2025-10-15 14:30:00', 'Ajoutée manuellement pour l\'article \'tournevis dove american\'', '2025-10-15 12:30:58', '2025-10-15 12:30:58'),
(717, 56, 'sortie', 'oussama arabi', 1, '2025-10-15 14:10:00', 'Ajoutée manuellement pour l\'article \'pavite\'', '2025-10-16 11:18:24', '2025-10-16 11:18:24'),
(718, 62, 'sortie', 'empruntée en aluminium pour marbre', 2, '2025-10-15 12:00:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\' (modifié)', '2025-10-16 11:48:27', '2025-10-16 11:49:59'),
(719, 145, 'sortie', 'Abderahman Aleesri', 1, '2025-10-16 13:50:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-16 11:52:34', '2025-10-16 11:52:34'),
(720, 49, 'sortie', 'youssef concasseur (empruntée en marbre)', 6, '2025-10-16 13:52:00', 'Ajoutée manuellement pour l\'article \'pavite\'', '2025-10-16 11:57:58', '2025-10-16 11:57:58'),
(721, 6, 'sortie', '4256186', 2, '2025-10-15 14:10:00', 'Ajoutée manuellement pour l\'article \'PEINTURE NOIRE (ATLAS) 5KG\'', '2025-10-16 12:05:54', '2025-10-16 12:05:54'),
(722, 8, 'sortie', '4675', 50, '2025-10-16 14:05:00', 'Ajoutée manuellement pour l\'article \'DISQUE 230x1,9x22 BLEU (TIGOR) 50P\'', '2025-10-16 12:06:56', '2025-10-16 12:06:56'),
(723, 86, 'sortie', '2860', 1, '2025-10-16 14:06:00', 'Ajoutée manuellement pour l\'article \'les lunettes de protection\'', '2025-10-16 12:07:51', '2025-10-16 12:07:51'),
(724, 62, 'sortie', '4087 (empruntée en aluminium pour Soudor)', 6, '2025-10-16 14:07:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-16 12:11:36', '2025-10-16 12:11:36'),
(725, 16, 'sortie', '4256102', 4, '2025-10-16 14:11:00', 'Ajoutée manuellement pour l\'article \'DILUANT (ENDES) 5L\'', '2025-10-16 12:12:56', '2025-10-16 12:12:56'),
(726, 32, 'sortie', '4256103', 1, '2025-10-16 14:12:00', 'Ajoutée manuellement pour l\'article \'SBAT 42\'', '2025-10-16 12:13:40', '2025-10-16 12:13:40'),
(727, 6, 'sortie', '4256104', 4, '2025-10-16 14:13:00', 'Ajoutée manuellement pour l\'article \'PEINTURE NOIRE (ATLAS) 5KG\'', '2025-10-16 12:15:45', '2025-10-16 12:15:45'),
(728, 60, 'sortie', '5319', 1, '2025-10-16 14:30:00', 'Ajoutée manuellement pour l\'article \'selecone akfix 12P\'', '2025-10-16 12:31:59', '2025-10-16 12:31:59'),
(729, 213, 'sortie', '5319', 1, '2025-10-16 14:32:00', 'Ajoutée manuellement pour l\'article \'caisse outils\'', '2025-10-16 12:32:31', '2025-10-16 12:32:31'),
(730, 85, 'sortie', 'mohmed ait alla', 1, '2025-10-16 14:32:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-16 12:33:17', '2025-10-16 12:33:17'),
(731, 203, 'sortie', '5319', 1, '2025-10-16 14:33:00', 'Ajoutée manuellement pour l\'article \'visseuse perceuse 20v ronix\'', '2025-10-16 12:34:16', '2025-10-16 12:34:16'),
(732, 65, 'sortie', '5122', 3, '2025-10-16 14:34:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-16 12:34:52', '2025-10-16 12:34:52'),
(733, 92, 'sortie', '5181', 1, '2025-10-16 14:37:00', 'Ajoutée manuellement pour l\'article \'les lunettes\'', '2025-10-16 12:38:19', '2025-10-16 12:38:19'),
(734, 62, 'sortie', 'naji alum', 1, '2025-10-16 14:38:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-16 12:38:44', '2025-10-16 12:38:44'),
(735, 60, 'sortie', '4868', 1, '2025-10-16 14:38:00', 'Ajoutée manuellement pour l\'article \'selecone akfix 12P\'', '2025-10-16 12:39:06', '2025-10-16 12:39:06'),
(736, 137, 'sortie', 'mohssin akalabo', 50, '2025-10-16 14:39:00', 'Ajoutée manuellement pour l\'article \'CLAME 70\'', '2025-10-16 12:43:09', '2025-10-16 12:43:09'),
(737, 85, 'sortie', '5825', 1, '2025-10-16 14:43:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-16 12:43:33', '2025-10-16 12:43:33'),
(738, 93, 'sortie', '5181', 1, '2025-10-16 14:43:00', 'Ajoutée manuellement pour l\'article \'DISQUE 115x1,6x22,2 MM (atlas) 25P\'', '2025-10-16 12:44:02', '2025-10-16 12:44:02'),
(739, 61, 'sortie', '5260', 1, '2025-10-16 14:44:00', 'Ajoutée manuellement pour l\'article \'scotche blanche\'', '2025-10-16 12:44:46', '2025-10-16 12:44:46'),
(740, 131, 'sortie', '5319', 6, '2025-10-16 14:44:00', 'Ajoutée manuellement pour l\'article \'poignee bequille\'', '2025-10-16 12:47:26', '2025-10-16 12:47:26'),
(741, 93, 'sortie', '5181', 1, '2025-10-16 14:47:00', 'Ajoutée manuellement pour l\'article \'DISQUE 115x1,6x22,2 MM (atlas) 25P\'', '2025-10-16 12:48:02', '2025-10-16 12:48:02'),
(742, 122, 'sortie', 'najah mohmed', 1, '2025-10-16 14:48:00', 'Ajoutée manuellement pour l\'article \'roullette plastique (rwayde)\'', '2025-10-16 12:48:58', '2025-10-16 12:48:58'),
(743, 62, 'sortie', '5260', 1, '2025-10-16 14:48:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-16 12:50:04', '2025-10-16 12:50:04'),
(744, 93, 'sortie', '5181', 1, '2025-10-16 14:50:00', 'Ajoutée manuellement pour l\'article \'DISQUE 115x1,6x22,2 MM (atlas) 25P\'', '2025-10-16 12:51:25', '2025-10-16 12:51:25'),
(745, 118, 'entrée', 'Retour d’Abdelkhalek  El Belghiti car il a démissionné.', 1, '2025-10-16 14:53:00', 'Ajoutée manuellement pour l\'article \'comblison alum\'', '2025-10-16 12:55:15', '2025-10-16 12:55:15'),
(746, 118, 'sortie', 'mohmed bakhecho', 1, '2025-10-16 14:55:00', 'Ajoutée manuellement pour l\'article \'comblison alum\'', '2025-10-16 12:56:43', '2025-10-16 12:56:43'),
(747, 242, 'entrée', 'Retour d’Abdelkhalek  El Belghiti car il a démissionné.', 1, '2025-10-16 14:59:00', 'Ajoutée manuellement pour l\'article \'SBAT 43\'', '2025-10-16 12:59:34', '2025-10-16 12:59:34'),
(748, 118, 'entrée', 'Retour d\'Ilyas chababe car il a démissionné.', 1, '2025-10-16 14:59:00', 'Ajoutée manuellement pour l\'article \'comblison alum\'', '2025-10-16 13:02:11', '2025-10-16 13:02:11'),
(749, 243, 'entrée', 'Retour d’Ilyas  El Chbabe car il a démissionné.', 1, '2025-10-16 15:04:00', 'Ajoutée manuellement pour l\'article \'SBAT 42\'', '2025-10-16 13:05:48', '2025-10-16 13:05:48'),
(750, 187, 'entrée', 'Retour d’Abdellah Bouraja car il a démissionné.', 1, '2025-10-16 15:05:00', 'Ajoutée manuellement pour l\'article \'jeu cle sipo 308-2012 xcort\'', '2025-10-16 13:06:33', '2025-10-16 13:06:33'),
(751, 118, 'entrée', 'Retour d’Abdellah Bouraja car il a démissionné.', 1, '2025-10-16 15:06:00', 'Ajoutée manuellement pour l\'article \'comblison alum\'', '2025-10-16 13:07:07', '2025-10-16 13:07:07'),
(752, 244, 'entrée', 'Retour d’Abdellah Bouraja car il a démissionné.', 1, '2025-10-16 15:07:00', 'Ajoutée manuellement pour l\'article \'SBAT 40\'', '2025-10-16 13:07:19', '2025-10-16 13:07:19'),
(753, 243, 'sortie', 'mohmed bakhecho', 1, '2025-10-16 15:07:00', 'Ajoutée manuellement pour l\'article \'SBAT 42\'', '2025-10-16 13:08:22', '2025-10-16 13:08:22'),
(754, 242, 'sortie', 'abdeljelil riad', 1, '2025-10-16 15:08:00', 'Ajoutée manuellement pour l\'article \'SBAT 43\'', '2025-10-16 13:08:52', '2025-10-16 13:08:52'),
(755, 118, 'sortie', 'abdeljelil riad', 1, '2025-10-16 15:08:00', 'Ajoutée manuellement pour l\'article \'comblison alum\'', '2025-10-16 13:09:44', '2025-10-16 13:09:44'),
(756, 118, 'sortie', 'Ismail Houra', 1, '2025-10-16 15:09:00', 'Ajoutée manuellement pour l\'article \'comblison alum\'', '2025-10-16 13:10:22', '2025-10-16 13:10:22'),
(757, 244, 'sortie', 'Ismail Houra', 1, '2025-10-16 15:10:00', 'Ajoutée manuellement pour l\'article \'SBAT 40\'', '2025-10-16 13:10:39', '2025-10-16 13:10:39'),
(758, 92, 'sortie', 'Adil khayat', 1, '2025-10-16 15:10:00', 'Ajoutée manuellement pour l\'article \'les lunettes\'', '2025-10-16 13:11:12', '2025-10-16 13:11:12'),
(759, 187, 'sortie', 'Zegdi Abderrazzak', 1, '2025-10-16 15:11:00', 'Ajoutée manuellement pour l\'article \'jeu cle sipo 308-2012 xcort\'', '2025-10-16 13:12:09', '2025-10-16 13:12:09'),
(760, 100, 'sortie', '4692', 30, '2025-10-16 15:12:00', 'Ajoutée manuellement pour l\'article \'CABLE 3G 2,5 MM 100m\'', '2025-10-16 13:15:22', '2025-10-16 13:15:22'),
(761, 101, 'sortie', '4692', 89, '2025-10-16 15:15:00', 'Ajoutée manuellement pour l\'article \'CABLE 5G 2,5 MM 100 m\'', '2025-10-16 13:16:03', '2025-10-16 13:20:10'),
(762, 97, 'sortie', '4692', 3, '2025-10-16 15:16:00', 'Ajoutée manuellement pour l\'article \'PRISE SIMPLE\'', '2025-10-16 13:16:29', '2025-10-16 13:24:03'),
(763, 147, 'sortie', '4692', 2, '2025-10-16 15:16:00', 'Ajoutée manuellement pour l\'article \'projecteur led 100W 3000K H100W(brabus)\'', '2025-10-16 13:16:52', '2025-10-16 13:16:52'),
(764, 101, 'sortie', '4936', 5, '2025-10-16 15:16:00', 'Ajoutée manuellement pour l\'article \'CABLE 5G 2,5 MM 100 m\'', '2025-10-16 13:17:41', '2025-10-16 13:29:23'),
(765, 101, 'retour', '4936', 11, '2025-10-16 15:17:00', 'Retour enregistré pour l\'article CABLE 5G 2,5 MM 100 m', '2025-10-16 13:20:10', '2025-10-16 13:20:10'),
(766, 97, 'retour', '4692', 5, '2025-10-16 15:20:00', 'Retour enregistré pour l\'article PRISE SIMPLE', '2025-10-16 13:24:03', '2025-10-16 13:24:03'),
(767, 101, 'retour', '4692', 95, '2025-10-16 15:24:00', 'Retour enregistré pour l\'article CABLE 5G 2,5 MM 100 m', '2025-10-16 13:29:23', '2025-10-16 13:29:23'),
(768, 42, 'sortie', '0099193', 1, '2025-10-15 14:30:00', 'Ajoutée manuellement pour l\'article \'metre 5m ord\' (modifié)', '2025-10-17 04:05:13', '2025-10-17 06:43:09'),
(769, 50, 'sortie', 'abdeltif triicien (empruntée en marbre)', 1, '2025-10-17 06:26:00', 'Ajoutée manuellement pour l\'article \'les lunettes\'', '2025-10-17 04:28:56', '2025-10-17 04:28:56'),
(770, 93, 'sortie', '5123', 1, '2025-10-17 06:29:00', 'Ajoutée manuellement pour l\'article \'DISQUE 115x1,6x22,2 MM (atlas) 25P\'', '2025-10-17 04:41:22', '2025-10-17 04:41:22'),
(771, 85, 'sortie', 'damoh', 1, '2025-10-17 06:58:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-17 04:59:28', '2025-10-17 04:59:28'),
(772, 85, 'sortie', 'mohmed', 1, '2025-10-17 06:59:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-17 05:03:20', '2025-10-17 05:03:20'),
(775, 160, 'sortie', 'abdeltif tricien', 10, '2025-10-17 07:06:00', 'Ajoutée manuellement pour l\'article \'cosse a sertir 70mm t10\'', '2025-10-17 05:07:58', '2025-10-17 05:07:58'),
(776, 158, 'sortie', 'abdeltif tricien', 8, '2025-10-17 07:07:00', 'Ajoutée manuellement pour l\'article \'pince d\'ancrage pa 1500 max 70mm2\'', '2025-10-17 05:08:26', '2025-10-17 05:08:26'),
(777, 151, 'sortie', 'abdeltif tricien', 100, '2025-10-17 07:08:00', 'Ajoutée manuellement pour l\'article \'colliers 7,6x265 noir 100p\'', '2025-10-17 05:08:53', '2025-10-17 05:08:53'),
(778, 162, 'sortie', 'abdeltif tricien', 3, '2025-10-17 07:08:00', 'Ajoutée manuellement pour l\'article \'fusible a couteaux to 160A AM\'', '2025-10-17 05:09:20', '2025-10-17 05:09:20'),
(779, 161, 'sortie', 'abdeltif tricien', 8, '2025-10-17 07:09:00', 'Ajoutée manuellement pour l\'article \'cosse a sertir 50mm t8 JM (JGK) 50-8\'', '2025-10-17 05:09:38', '2025-10-17 05:09:38'),
(780, 183, 'sortie', 'abdeltif tricien', 12, '2025-10-17 07:09:00', 'Ajoutée manuellement pour l\'article \'cosse a sertir 240mm t16\'', '2025-10-17 05:09:51', '2025-10-17 05:09:51'),
(781, 173, 'sortie', 'abdeltif tricien', 200, '2025-10-17 07:09:00', 'Ajoutée manuellement pour l\'article \'cable ths alu.3*70+54,6 +16mm2\'', '2025-10-17 05:10:21', '2025-10-17 05:10:21'),
(782, 204, 'retour', '5260', 1, '2025-10-17 07:16:00', 'Retour enregistré pour l\'article meuleuse hikoki', '2025-10-17 05:18:25', '2025-10-17 05:18:25'),
(783, 93, 'retour', '5260', 1, '2025-10-17 07:18:00', 'Retour enregistré pour l\'article DISQUE 115x1,6x22,2 MM (atlas) 25P', '2025-10-17 05:19:15', '2025-10-17 05:19:15'),
(784, 197, 'sortie', '4434', 1, '2025-10-10 14:22:00', 'Ajoutée manuellement pour l\'article \'sipo tps-4c jetech\' (modifié)', '2025-10-17 05:27:19', '2025-10-17 05:29:20'),
(785, 52, 'sortie', '0099304', 6, '2025-10-17 08:36:00', 'Ajoutée manuellement pour l\'article \'scotche\'', '2025-10-17 06:37:18', '2025-10-17 06:37:18'),
(787, 245, 'sortie', 'Mustafa', 1, '2025-10-17 09:02:00', 'Ajoutée manuellement pour l\'article \'CHEVILLES  EN PLASTIQUE 10MM\'', '2025-10-17 07:03:55', '2025-10-17 07:03:55'),
(788, 27, 'sortie', 'Mustafa', 50, '2025-10-17 09:03:00', 'Ajoutée manuellement pour l\'article \'TIRFOUR 6x60 (ENVIRON)\'', '2025-10-17 07:04:17', '2025-10-17 07:04:17'),
(789, 6, 'sortie', '4256185', 4, '2025-10-17 09:04:00', 'Ajoutée manuellement pour l\'article \'PEINTURE NOIRE (ATLAS) 5KG\'', '2025-10-17 07:04:59', '2025-10-17 07:04:59'),
(790, 16, 'sortie', '4256185', 5, '2025-10-17 09:04:00', 'Ajoutée manuellement pour l\'article \'DILUANT (ENDES) 5L\'', '2025-10-17 07:05:12', '2025-10-17 07:05:12'),
(791, 28, 'sortie', 'Mustafa', 50, '2025-10-17 09:03:00', 'Ajoutée manuellement pour l\'article \'CHEVILLES METALIQUE M12 (INDEX)\'', '2025-10-17 07:08:02', '2025-10-17 07:08:02'),
(793, 246, 'sortie', 'bon de transfert 000426', 1, '2025-10-17 09:31:00', 'Ajoutée manuellement pour l\'article \'disque quartz\'', '2025-10-17 07:32:07', '2025-10-17 07:32:07'),
(794, 220, 'sortie', 'bon de transfert 000426', 1, '2025-10-17 09:32:00', 'Ajoutée manuellement pour l\'article \'venteuse triple wokin\'', '2025-10-17 07:36:06', '2025-10-17 07:36:06'),
(795, 199, 'sortie', 'bon de transfert 000425', 1, '2025-10-17 09:36:00', 'Ajoutée manuellement pour l\'article \'perforateur hikoki\'', '2025-10-17 07:37:19', '2025-10-17 07:37:19'),
(796, 214, 'sortie', 'bon de transfert 000425', 1, '2025-10-17 09:37:00', 'Ajoutée manuellement pour l\'article \'scie\'', '2025-10-17 07:39:58', '2025-10-17 07:39:58'),
(797, 100, 'sortie', 'bon de transfert 000426', 30, '2025-10-17 09:39:00', 'Ajoutée manuellement pour l\'article \'CABLE 3G 2,5 MM 100m\'', '2025-10-17 07:40:37', '2025-10-17 07:40:37'),
(798, 85, 'sortie', 'bon de transfert 000425', 4, '2025-10-17 09:40:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-17 07:41:41', '2025-10-17 07:41:41'),
(799, 50, 'sortie', 'bon de transfert 000425 (empruntée en marbre)', 2, '2025-10-17 09:41:00', 'Ajoutée manuellement pour l\'article \'les lunettes\'', '2025-10-17 07:43:06', '2025-10-17 07:43:06'),
(800, 195, 'sortie', 'bon de transfert 000426', 3, '2025-10-17 09:43:00', 'Ajoutée manuellement pour l\'article \'meche a fer 8 inox bosch\'', '2025-10-17 07:56:49', '2025-10-17 07:56:49'),
(801, 194, 'sortie', 'bon de transfert 000426', 3, '2025-10-17 09:56:00', 'Ajoutée manuellement pour l\'article \'meche a fer 6 inox bosch\' (modifié)', '2025-10-17 07:57:21', '2025-10-18 07:09:43'),
(802, 80, 'sortie', '5123', 1, '2025-10-17 09:57:00', 'Ajoutée manuellement pour l\'article \'pavite\'', '2025-10-17 07:57:49', '2025-10-17 07:57:49'),
(803, 61, 'sortie', '5477', 1, '2025-10-17 09:57:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\' (modifié)', '2025-10-17 07:58:12', '2025-10-17 07:59:57'),
(804, 62, 'sortie', '4868', 1, '2025-10-17 09:58:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-17 07:58:35', '2025-10-17 07:58:35'),
(805, 247, 'entrée', '25424', 1, '2025-10-17 10:08:00', 'Ajoutée manuellement pour l\'article \'cofri dist. 3A240+3D35 NP ODISS TYPE 31 FC NP\'', '2025-10-17 08:08:56', '2025-10-17 08:08:56'),
(806, 248, 'entrée', 'L2025020045', 50, '2025-10-17 10:08:00', 'Ajoutée manuellement pour l\'article \'santofire\'', '2025-10-17 08:09:50', '2025-10-17 08:09:50'),
(807, 249, 'entrée', 'L2025020046', 40, '2025-10-17 10:09:00', 'Ajoutée manuellement pour l\'article \'chaine galva 6mm\'', '2025-10-17 08:10:12', '2025-10-17 08:10:12'),
(808, 250, 'entrée', 'L2025019980', 5, '2025-10-17 10:10:00', 'Ajoutée manuellement pour l\'article \'perceuse GSB 18-2 Re bosh\'', '2025-10-17 08:12:33', '2025-10-17 08:12:33'),
(809, 65, 'sortie', '5179', 85, '2025-10-17 10:12:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-17 08:12:52', '2025-10-17 08:12:52'),
(810, 247, 'sortie', 'abdeltif tricien', 1, '2025-10-17 10:12:00', 'Ajoutée manuellement pour l\'article \'cofri dist. 3A240+3D35 NP ODISS TYPE 31 FC NP\'', '2025-10-17 08:15:42', '2025-10-17 08:15:42'),
(811, 82, 'sortie', '5076', 1, '2025-10-17 10:45:00', 'Ajoutée manuellement pour l\'article \'disque 355mm 2,6/2,2x30mm (bosch)\'', '2025-10-17 08:45:50', '2025-10-17 08:45:50'),
(812, 171, 'sortie', 'abdeljalil dinar', 1, '2025-10-17 10:45:00', 'Ajoutée manuellement pour l\'article \'casque anti bruit\'', '2025-10-17 10:33:00', '2025-10-17 10:33:00'),
(813, 58, 'sortie', '4256184', 4, '2025-10-17 12:33:00', 'Ajoutée manuellement pour l\'article \'PEINTURE NOIRE (ATLAS) 5KG\' (modifié)', '2025-10-17 10:40:19', '2025-10-17 10:43:01'),
(814, 60, 'retour', 'le meme personne', 15, '2025-10-17 12:43:00', 'Retour enregistré pour l\'article selecone akfix 12P', '2025-10-17 10:44:33', '2025-10-17 10:44:33'),
(816, 212, 'retour', '5154', 1, '2025-10-17 13:05:00', 'Retour enregistré pour l\'article pince Etaux wokin', '2025-10-17 11:05:56', '2025-10-17 11:05:56'),
(818, 65, 'sortie', 'ahmed agma', 2, '2025-10-17 13:39:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-17 11:39:36', '2025-10-17 11:39:36'),
(821, 65, 'sortie', '5477', 2, '2025-10-17 14:17:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-17 12:17:52', '2025-10-17 12:17:52'),
(822, 65, 'sortie', '5154', 2, '2025-10-17 14:17:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-17 12:18:09', '2025-10-17 12:18:09'),
(823, 65, 'sortie', '5766', 1, '2025-10-17 14:18:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-17 12:18:25', '2025-10-17 12:18:25'),
(824, 50, 'sortie', 'ouadia basir grwa', 1, '2025-10-17 14:18:00', 'Ajoutée manuellement pour l\'article \'les lunettes\'', '2025-10-17 13:01:26', '2025-10-17 13:01:26'),
(825, 57, 'sortie', 'abdelfatah', 6, '2025-10-17 15:00:00', 'Ajoutée manuellement pour l\'article \'tipe\'', '2025-10-18 04:30:13', '2025-10-18 04:30:13'),
(826, 62, 'sortie', 'said', 1, '2025-10-17 15:00:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\' (modifié) (modifié)', '2025-10-18 04:31:02', '2025-10-18 10:26:28'),
(827, 137, 'sortie', '5477', 26, '2025-10-18 06:34:00', 'Ajoutée manuellement pour l\'article \'CLAME 70\'', '2025-10-18 04:35:12', '2025-10-18 04:35:12'),
(828, 182, 'sortie', '5477', 50, '2025-10-18 06:35:00', 'Ajoutée manuellement pour l\'article \'kit fermeture S70R renf\' (modifié) (modifié)', '2025-10-18 04:35:30', '2025-10-20 11:58:29'),
(829, 85, 'sortie', 'sabiri mohmed', 1, '2025-10-18 06:35:00', 'Ajoutée manuellement pour l\'article \'ligat\' (modifié) (modifié)', '2025-10-18 04:51:26', '2025-10-18 05:57:23'),
(830, 122, 'sortie', '3889', 1, '2025-10-17 06:51:00', 'Ajoutée manuellement pour l\'article \'roullette plastique (rwayde)\' (modifié)', '2025-10-18 04:57:50', '2025-10-18 05:52:45'),
(831, 213, 'sortie', 'Rachid aluminium', 1, '2025-10-17 14:57:00', 'Ajoutée manuellement pour l\'article \'caisse outils\'', '2025-10-18 05:51:41', '2025-10-18 05:51:41'),
(832, 81, 'sortie', 'Rachid aluminium', 1, '2025-10-17 14:51:00', 'Ajoutée manuellement pour l\'article \'PIED A COULISSE (nobel)\' (modifié)', '2025-10-18 05:52:06', '2025-10-18 05:52:27'),
(833, 122, 'sortie', '3889', 1, '2025-10-18 07:57:00', 'Ajoutée manuellement pour l\'article \'roullette plastique (rwayde)\'', '2025-10-18 05:58:13', '2025-10-18 05:58:13'),
(834, 61, 'sortie', '5123', 1, '2025-10-18 07:58:00', 'Ajoutée manuellement pour l\'article \'scotche blanche\'', '2025-10-18 05:58:36', '2025-10-18 05:58:36'),
(835, 62, 'sortie', '3889', 1, '2025-10-18 07:58:00', 'Ajoutée manuellement pour l\'article \'scotche embalage\'', '2025-10-18 05:58:51', '2025-10-18 05:58:51'),
(836, 70, 'sortie', '5319', 1, '2025-10-18 08:02:00', 'Ajoutée manuellement pour l\'article \'bis 4x40 200P\'', '2025-10-18 06:02:28', '2025-10-18 06:02:28'),
(838, 42, 'emprunt', 'aymen', 1, '2025-10-18 08:02:00', 'Empruntée manuellement pour l\'article \'metre 5m ord\'', '2025-10-18 06:03:03', '2025-10-18 06:03:03'),
(839, 42, 'sortie', '0099194', 1, '2025-10-18 08:03:00', 'Ajoutée manuellement pour l\'article \'metre 5m ord\'', '2025-10-18 06:04:57', '2025-10-18 06:04:57'),
(840, 52, 'sortie', 'said najah', 6, '2025-10-16 09:18:00', 'Ajoutée manuellement pour l\'article \'scotche\'', '2025-10-18 06:18:41', '2025-10-18 06:18:41'),
(841, 51, 'sortie', '0099193', 1, '2025-10-18 08:27:00', 'Ajoutée manuellement pour l\'article \'colla\'', '2025-10-18 06:28:06', '2025-10-18 06:28:06'),
(842, 52, 'sortie', '0099193', 6, '2025-10-18 08:28:00', 'Ajoutée manuellement pour l\'article \'scotche\'', '2025-10-18 06:28:28', '2025-10-18 06:28:28'),
(843, 42, 'emprunt', 'adil el khayat', 1, '2025-10-18 08:56:00', 'Empruntée manuellement pour l\'article \'metre 5m ord\'', '2025-10-18 06:57:15', '2025-10-18 06:57:15'),
(844, 42, 'emprunt', 'adil', 1, '2025-10-18 09:11:00', 'Empruntée manuellement pour l\'article \'metre 5m ord\'', '2025-10-18 07:11:58', '2025-10-18 07:11:58'),
(845, 65, 'sortie', '5477', 2, '2025-10-18 09:17:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-18 07:18:05', '2025-10-18 07:18:05'),
(846, 124, 'sortie', 'Mouad Molil', 10, '2025-10-18 09:22:00', 'Ajoutée manuellement pour l\'article \'paumelle noir\'', '2025-10-18 07:31:05', '2025-10-18 07:31:05'),
(847, 229, 'sortie', '4692', 2, '2025-10-18 09:44:00', 'Ajoutée manuellement pour l\'article \'projecteur plat led petit 50w (ingelec)\'', '2025-10-18 07:45:11', '2025-10-18 07:45:11'),
(848, 151, 'sortie', '4692', 90, '2025-10-18 09:45:00', 'Ajoutée manuellement pour l\'article \'colliers 7,6x265 noir 100p\'', '2025-10-18 07:45:27', '2025-10-18 07:45:27'),
(849, 229, 'sortie', '4692', 2, '2025-10-18 09:45:00', 'Ajoutée manuellement pour l\'article \'projecteur plat led petit 50w (ingelec)\'', '2025-10-18 07:50:48', '2025-10-18 07:50:48'),
(852, 186, 'sortie', 'abdessadak', 2, '2025-10-17 09:46:00', 'Ajoutée manuellement pour l\'article \'tournevis dove american\' (modifié)', '2025-10-18 08:47:50', '2025-10-20 04:32:35'),
(853, 200, 'sortie', 'abdessadak', 1, '2025-10-18 10:47:00', 'Ajoutée manuellement pour l\'article \'perceuse 750w 13mm Ronix\'', '2025-10-18 08:48:50', '2025-10-18 08:48:50'),
(854, 16, 'sortie', '4256181', 2, '2025-10-18 12:23:00', 'Ajoutée manuellement pour l\'article \'DILUANT (ENDES) 5L\'', '2025-10-18 10:24:05', '2025-10-18 10:24:05'),
(855, 62, 'retour', 'inconnu', 3, '2025-10-18 12:26:00', 'Retour enregistré pour l\'article scotche embalage', '2025-10-18 10:26:28', '2025-10-18 10:26:28'),
(856, 137, 'entrée', '25101808', 110, '2025-10-18 12:26:00', 'Ajoutée manuellement pour l\'article \'CLAME 70\'', '2025-10-18 10:28:43', '2025-10-18 10:28:43'),
(858, 137, 'sortie', '5477', 24, '2025-10-18 12:24:00', 'Ajoutée manuellement pour l\'article \'CLAME 70\'', '2025-10-18 10:29:26', '2025-10-18 10:29:26'),
(859, 229, 'sortie', '4692', 2, '2025-10-18 12:29:00', 'Ajoutée manuellement pour l\'article \'projecteur plat led petit 50w (ingelec)\'', '2025-10-18 10:30:18', '2025-10-18 10:30:18'),
(860, 100, 'sortie', '4692', 70, '2025-10-18 12:30:00', 'Ajoutée manuellement pour l\'article \'CABLE 3G 2,5 MM 100m\'', '2025-10-18 10:31:26', '2025-10-18 10:31:26'),
(861, 65, 'sortie', '5154', 2, '2025-10-18 12:31:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-18 10:38:44', '2025-10-18 10:38:44'),
(862, 85, 'sortie', 'abdeljamil akbli', 1, '2025-10-18 12:38:00', 'Ajoutée manuellement pour l\'article \'ligat\'', '2025-10-18 10:49:18', '2025-10-18 10:49:18'),
(863, 65, 'sortie', '5154', 1, '2025-10-18 13:49:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-18 11:50:16', '2025-10-18 11:50:16'),
(865, 96, 'sortie', '4692', 4, '2025-10-20 06:37:00', 'Ajoutée manuellement pour l\'article \'DOUILLES\' (modifié)', '2025-10-20 04:48:47', '2025-10-20 04:56:16'),
(866, 95, 'sortie', '4692', 2, '2025-10-20 06:48:00', 'Ajoutée manuellement pour l\'article \'SAROTE\'', '2025-10-20 04:49:05', '2025-10-20 04:49:05'),
(867, 97, 'sortie', '4692', 2, '2025-10-20 06:49:00', 'Ajoutée manuellement pour l\'article \'PRISE SIMPLE\'', '2025-10-20 04:49:27', '2025-10-20 04:49:27'),
(868, 94, 'sortie', '4692', 4, '2025-10-20 06:49:00', 'Ajoutée manuellement pour l\'article \'boite rouge\'', '2025-10-20 04:51:08', '2025-10-20 04:51:08'),
(869, 52, 'sortie', '0099195', 6, '2025-10-20 06:57:00', 'Ajoutée manuellement pour l\'article \'scotche\' (modifié)', '2025-10-20 04:57:47', '2025-10-20 10:43:35'),
(871, 252, 'emprunt', 'Zegdi Abderrazzak', 1, '2025-10-20 07:11:00', 'Empruntée manuellement pour l\'article \'visseuse simple\'', '2025-10-20 05:12:08', '2025-10-20 05:12:08'),
(872, 42, 'emprunt', 'lhya', 1, '2025-10-20 07:15:00', 'Empruntée manuellement pour l\'article \'metre 5m ord\'', '2025-10-20 05:16:32', '2025-10-20 05:16:32'),
(873, 137, 'sortie', '5477', 26, '2025-10-20 07:39:00', 'Ajoutée manuellement pour l\'article \'CLAME 70\'', '2025-10-20 05:40:20', '2025-10-20 05:40:20'),
(874, 50, 'sortie', 'kamal enmissi', 6, '2025-10-20 07:40:00', 'Ajoutée manuellement pour l\'article \'les lunettes\'', '2025-10-20 05:59:42', '2025-10-20 05:59:42'),
(875, 18, 'sortie', '4256180', 2, '2025-10-20 07:59:00', 'Ajoutée manuellement pour l\'article \'PAUMELLE 100\'', '2025-10-20 06:30:27', '2025-10-20 06:30:27'),
(876, 7, 'sortie', 'lahcem amlal', 25, '2025-10-20 08:30:00', 'Ajoutée manuellement pour l\'article \'DISQUE 180x6,4x22,23 ROUGE (TIGOR) 25P\'', '2025-10-20 06:47:58', '2025-10-20 06:47:58'),
(877, 253, 'entrée', '25101808', 50, '2025-10-18 09:52:00', 'Ajoutée manuellement pour l\'article \'joint 6mm S70R 4646\' (modifié)', '2025-10-20 06:53:26', '2025-10-20 06:55:14'),
(878, 253, 'sortie', 'naji alum', 50, '2025-10-20 08:55:00', 'Ajoutée manuellement pour l\'article \'joint 6mm S70R 4646\'', '2025-10-20 06:55:43', '2025-10-20 06:55:43'),
(879, 38, 'sortie', 'Abdelfatah Belgout', 4, '2025-10-20 08:55:00', 'Ajoutée manuellement pour l\'article \'disque 400\'', '2025-10-20 07:05:35', '2025-10-20 07:05:35'),
(880, 254, 'entrée', 'BL251302', 196, '2025-10-18 14:00:00', 'Ajoutée manuellement pour l\'article \'electrodes matica  3,15\'', '2025-10-20 07:13:00', '2025-10-20 07:13:00'),
(881, 42, 'emprunt', 'adil', 1, '2025-10-20 09:34:00', 'Empruntée manuellement pour l\'article \'metre 5m ord\'', '2025-10-20 07:34:47', '2025-10-20 07:34:47'),
(882, 254, 'entrée', 'BL251286', 220, '2025-10-20 09:41:00', 'Ajoutée manuellement pour l\'article \'electrodes matica  3,15\'', '2025-10-20 07:42:24', '2025-10-20 07:42:24'),
(883, 33, 'entrée', 'BL2511286', 440, '2025-10-20 10:17:00', 'Ajoutée manuellement pour l\'article \'DISQUE 300x3,5x25,4 MM NOIRE (ATLAS) 25P\'', '2025-10-20 08:18:12', '2025-10-20 08:18:12'),
(884, 9, 'sortie', '4675', 100, '2025-10-20 10:24:00', 'Ajoutée manuellement pour l\'article \'DISQUE 230x1,9x22,23 (BOSCH) 25P\'', '2025-10-20 08:27:58', '2025-10-20 08:27:58'),
(885, 6, 'sortie', '4256179', 4, '2025-10-20 10:30:00', 'Ajoutée manuellement pour l\'article \'PEINTURE NOIRE (ATLAS) 5KG\' (modifié)', '2025-10-20 08:36:13', '2025-10-20 08:37:17'),
(886, 16, 'sortie', '4256179', 4, '2025-10-20 10:36:00', 'Ajoutée manuellement pour l\'article \'DILUANT (ENDES) 5L\'', '2025-10-20 08:36:38', '2025-10-20 08:36:38'),
(887, 254, 'sortie', '4256182', 16, '2025-10-18 10:24:00', 'Ajoutée manuellement pour l\'article \'electrodes matica  3,15\' (modifié)', '2025-10-20 08:39:30', '2025-10-20 08:40:00'),
(888, 42, 'sortie', '0099197', 2, '2025-10-20 12:19:00', 'Ajoutée manuellement pour l\'article \'metre 5m ord\'', '2025-10-20 10:20:12', '2025-10-20 10:20:12'),
(889, 196, 'sortie', 'bon de transfert 000439', 1, '2025-10-18 12:27:00', 'Ajoutée manuellement pour l\'article \'sauteuse gst 650 450w bosh\'', '2025-10-20 10:28:31', '2025-10-20 10:28:31'),
(890, 198, 'retour', '5519', 1, '2025-10-16 09:00:00', 'Retour enregistré pour l\'article kiteur vello 18', '2025-10-20 11:24:59', '2025-10-20 11:24:59'),
(891, 191, 'retour', '5519', 1, '2025-10-16 09:00:00', 'Retour enregistré pour l\'article metre 10m betta', '2025-10-20 11:25:29', '2025-10-20 11:25:29'),
(892, 198, 'sortie', 'adil', 1, '2025-10-16 09:00:00', 'Ajoutée manuellement pour l\'article \'kiteur vello 18\'', '2025-10-20 11:30:33', '2025-10-20 11:30:33'),
(893, 191, 'sortie', 'adil', 1, '2025-10-16 09:00:00', 'Ajoutée manuellement pour l\'article \'metre 10m betta\' (modifié)', '2025-10-20 11:32:31', '2025-10-20 12:19:24'),
(894, 198, 'sortie', 'adil', 1, '2025-10-13 09:32:00', 'Ajoutée manuellement pour l\'article \'kiteur vello 18\'', '2025-10-20 11:35:21', '2025-10-20 11:35:21'),
(899, 194, 'sortie', 'Rachid alum', 1, '2025-10-20 14:27:00', 'Ajoutée manuellement pour l\'article \'meche a fer 6 inox bosch\'', '2025-10-20 12:28:20', '2025-10-20 12:28:20'),
(900, 65, 'sortie', '5154', 2, '2025-10-20 14:28:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-20 12:29:05', '2025-10-20 12:29:05'),
(901, 252, 'emprunt', 'amine idbella', 1, '2025-10-20 14:30:00', 'Empruntée manuellement pour l\'article \'visseuse simple\'', '2025-10-20 12:30:24', '2025-10-20 12:30:24'),
(902, 65, 'sortie', 'ahmed agma', 2, '2025-10-20 08:00:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-20 12:31:29', '2025-10-20 12:31:29'),
(903, 65, 'sortie', 'louali', 2, '2025-10-20 08:31:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-20 12:31:50', '2025-10-20 12:31:50'),
(904, 65, 'sortie', '4387', 10, '2025-10-20 10:32:00', 'Ajoutée manuellement pour l\'article \'soulofan  petite\'', '2025-10-20 12:32:52', '2025-10-20 12:32:52'),
(905, 190, 'retour', 'Rachid alum', 1, '2025-10-20 14:44:00', 'Retour enregistré pour l\'article pistolet silicone', '2025-10-20 12:44:45', '2025-10-20 12:44:45'),
(906, 60, 'retour', 'Rachid alum', 1, '2025-10-20 14:44:00', 'Retour enregistré pour l\'article selecone akfix 12P', '2025-10-20 12:45:07', '2025-10-20 12:45:07'),
(907, 68, 'retour', 'Rachid alum', 1, '2025-10-20 14:45:00', 'Retour enregistré pour l\'article bis 4,8x38 250p', '2025-10-20 12:45:27', '2025-10-20 12:45:27'),
(908, 38, 'sortie', '0099196', 6, '2025-10-19 09:07:00', 'Ajoutée manuellement pour l\'article \'disque 400\'', '2025-10-21 04:10:25', '2025-10-21 04:10:25'),
(909, 47, 'sortie', '0099196', 6, '2025-10-19 09:10:00', 'Ajoutée manuellement pour l\'article \'disque 220\'', '2025-10-21 04:11:25', '2025-10-21 04:11:25'),
(910, 50, 'sortie', 'abdelfatah', 1, '2025-10-19 09:19:00', 'Ajoutée manuellement pour l\'article \'les lunettes\'', '2025-10-21 04:20:14', '2025-10-21 04:20:14'),
(911, 42, 'emprunt', 'Atleir Marbre Zakariya (waiting for bon ,by aymen )', 1, '2025-10-21 06:44:00', 'Empruntée manuellement pour l\'article \'metre 5m ord\'', '2025-10-21 04:46:13', '2025-10-21 04:46:13'),
(912, 255, 'sortie', '4692', 5, '2025-10-21 07:10:00', 'Ajoutée manuellement pour l\'article \'cable the\'', '2025-10-21 05:10:53', '2025-10-21 05:10:53');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `achat_articles`
--
ALTER TABLE `achat_articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `achat_articles_demande_achat_id_foreign` (`demande_achat_id`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `charge_personnels`
--
ALTER TABLE `charge_personnels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `charge_personnels_numproduction_foreign` (`numProduction`);

--
-- Index pour la table `consommations`
--
ALTER TABLE `consommations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consommations_demande_achat_id_foreign` (`demande_achat_id`),
  ADD KEY `consommations_numproduction_foreign` (`numProduction`);

--
-- Index pour la table `demande_achats`
--
ALTER TABLE `demande_achats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `demande_achats_numboncommande_unique` (`numBonCommande`),
  ADD KEY `demande_achats_numfiche_foreign` (`numFiche`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `fiche_articles`
--
ALTER TABLE `fiche_articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fiche_articles_fiche_numfiche_foreign` (`fiche_numFiche`);

--
-- Index pour la table `fiche_commandes`
--
ALTER TABLE `fiche_commandes`
  ADD PRIMARY KEY (`numFiche`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `productions`
--
ALTER TABLE `productions`
  ADD PRIMARY KEY (`numProduction`);

--
-- Index pour la table `production_articles`
--
ALTER TABLE `production_articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `production_articles_numproduction_foreign` (`numProduction`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_movements_stock_id_foreign` (`stock_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `achat_articles`
--
ALTER TABLE `achat_articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `charge_personnels`
--
ALTER TABLE `charge_personnels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `consommations`
--
ALTER TABLE `consommations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `demande_achats`
--
ALTER TABLE `demande_achats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fiche_articles`
--
ALTER TABLE `fiche_articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fiche_commandes`
--
ALTER TABLE `fiche_commandes`
  MODIFY `numFiche` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `productions`
--
ALTER TABLE `productions`
  MODIFY `numProduction` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `production_articles`
--
ALTER TABLE `production_articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT pour la table `stock_movements`
--
ALTER TABLE `stock_movements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=913;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achat_articles`
--
ALTER TABLE `achat_articles`
  ADD CONSTRAINT `achat_articles_demande_achat_id_foreign` FOREIGN KEY (`demande_achat_id`) REFERENCES `demande_achats` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `charge_personnels`
--
ALTER TABLE `charge_personnels`
  ADD CONSTRAINT `charge_personnels_numproduction_foreign` FOREIGN KEY (`numProduction`) REFERENCES `productions` (`numProduction`) ON DELETE CASCADE;

--
-- Contraintes pour la table `consommations`
--
ALTER TABLE `consommations`
  ADD CONSTRAINT `consommations_demande_achat_id_foreign` FOREIGN KEY (`demande_achat_id`) REFERENCES `demande_achats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `consommations_numproduction_foreign` FOREIGN KEY (`numProduction`) REFERENCES `productions` (`numProduction`) ON DELETE CASCADE;

--
-- Contraintes pour la table `demande_achats`
--
ALTER TABLE `demande_achats`
  ADD CONSTRAINT `demande_achats_numfiche_foreign` FOREIGN KEY (`numFiche`) REFERENCES `fiche_commandes` (`numFiche`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fiche_articles`
--
ALTER TABLE `fiche_articles`
  ADD CONSTRAINT `fiche_articles_fiche_numfiche_foreign` FOREIGN KEY (`fiche_numFiche`) REFERENCES `fiche_commandes` (`numFiche`) ON DELETE CASCADE;

--
-- Contraintes pour la table `production_articles`
--
ALTER TABLE `production_articles`
  ADD CONSTRAINT `production_articles_numproduction_foreign` FOREIGN KEY (`numProduction`) REFERENCES `productions` (`numProduction`) ON DELETE CASCADE;

--
-- Contraintes pour la table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD CONSTRAINT `stock_movements_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
