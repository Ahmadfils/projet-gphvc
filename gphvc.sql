-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2024 at 10:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gphvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `alerte`
--

CREATE TABLE `alerte` (
  `id` int(100) NOT NULL,
  `alerte_desc` int(100) NOT NULL,
  `code` int(10) NOT NULL,
  `notification` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificat_ssl`
--

CREATE TABLE `certificat_ssl` (
  `id` int(100) NOT NULL,
  `type_ssl` varchar(100) NOT NULL,
  `duree_mois` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificat_ssl`
--

INSERT INTO `certificat_ssl` (`id`, `type_ssl`, `duree_mois`) VALUES
(1, 'Rapid SSL', '24');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `institution` varchar(100) DEFAULT NULL,
  `whatsapp_number` varchar(30) DEFAULT NULL,
  `fix_number` varchar(30) DEFAULT NULL,
  `mobile_number` varchar(30) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `fullname`, `email`, `password`, `institution`, `whatsapp_number`, `fix_number`, `mobile_number`, `adresse`, `timestamp`) VALUES
(1, 'Setic', '', '', NULL, '69460410', '71766462', '69460410', 'Asiatique', '2024-07-02 09:34:05'),
(2, 'BCB', 'bcb@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, '61476854', '22221221', '69460410', 'Bujumbura', '2024-07-16 19:20:48'),
(3, 'BRB Account', 'adminbrb@brb.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Societe', '7653557', '22665277', '69478782', 'Rohero', '2024-07-05 10:29:09'),
(5, 'CRDB bank', 'crd@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, '69864246', '22745853', '69460410', 'Roehero 7/30', '2024-07-10 07:07:47');

-- --------------------------------------------------------

--
-- Table structure for table `corbeille`
--

CREATE TABLE `corbeille` (
  `id` int(100) NOT NULL,
  `site_id` int(100) NOT NULL,
  `validite_mois` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `code`, `nom`) VALUES
(1, 'en', 'English'),
(2, 'fr', 'Français ');

-- --------------------------------------------------------

--
-- Table structure for table `license`
--

CREATE TABLE `license` (
  `id` int(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prix` varchar(100) NOT NULL,
  `duree_mois` varchar(255) NOT NULL,
  `compatibilite_bd` varchar(100) NOT NULL,
  `nbr_bd` varchar(255) NOT NULL,
  `stockage` varchar(255) NOT NULL,
  `nbr_email` varchar(255) NOT NULL,
  `traffic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `license`
--

INSERT INTO `license` (`id`, `nom`, `prix`, `duree_mois`, `compatibilite_bd`, `nbr_bd`, `stockage`, `nbr_email`, `traffic`) VALUES
(1, 'basique', '500000 FBU', '6', 'Mysql, PostgreSQL', '3', '500GB', '2', '150bit/sec');

-- --------------------------------------------------------

--
-- Table structure for table `ligne_ssl`
--

CREATE TABLE `ligne_ssl` (
  `id` int(255) NOT NULL,
  `site_id` int(100) NOT NULL,
  `ssl_id` int(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ligne_ssl`
--

INSERT INTO `ligne_ssl` (`id`, `site_id`, `ssl_id`, `timestamp`) VALUES
(1, 2, 1, '2024-07-04 10:54:50'),
(2, 5, 1, '2024-07-10 07:31:29'),
(5, 8, 1, '2024-06-15 07:40:47'),
(6, 9, 0, '2024-07-10 07:42:04'),
(7, 10, 1, '2024-07-25 13:22:04'),
(8, 11, 1, '2024-07-25 13:23:15'),
(9, 12, 1, '2024-07-25 13:25:02'),
(10, 13, 1, '2024-07-25 13:30:19'),
(11, 14, 1, '2024-07-25 13:31:55'),
(12, 15, 1, '2024-07-25 13:34:45'),
(13, 16, 1, '2024-07-25 14:12:11'),
(14, 17, 1, '2024-08-22 07:39:23');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `id` int(255) NOT NULL,
  `client_id` int(255) NOT NULL,
  `license_id` int(100) NOT NULL,
  `certificat_id` int(100) NOT NULL,
  `domaine` varchar(30) NOT NULL,
  `webmail` varchar(100) NOT NULL,
  `date_license` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `client_id`, `license_id`, `certificat_id`, `domaine`, `webmail`, `date_license`, `timestamp`) VALUES
(1, 1, 1, 0, 'setic.gov.bi', 'admin123@setic.gov.bi', '2024-07-04 16:19:36', '2024-07-24 13:06:23'),
(2, 2, 1, 0, 'bcb.bi', 'admin12345@bcb.bi', '2024-07-04 16:22:44\r\n', '2024-07-10 07:06:38'),
(5, 5, 1, 1, 'crdbbank.com', 'admin@crdbbank.com', '2024-06-27 09:24:15', '2024-08-22 00:50:29'),
(8, 5, 1, 1, 'admin-crdbbank', 'admin1@admin-crdbbank.com', '2024-06-09 09:40:47', '2024-08-22 00:49:45'),
(9, 5, 1, 0, 'client-crdbbank.com', 'client1@client-crdbbank.com', '2024-07-10 09:42:04', '2024-07-10 07:42:04'),
(16, 1, 1, 1, 'setic.edu.bi', 'directeur@setic.edu.bi', '2024-07-25 16:12:11', '2024-07-25 14:12:11'),
(17, 1, 1, 1, 'gbc.gov.bi', 'gh@gmail.com', '2024-08-22 09:39:22', '2024-08-22 07:39:22');

-- --------------------------------------------------------

--
-- Table structure for table `traductions`
--

CREATE TABLE `traductions` (
  `id` int(100) NOT NULL,
  `lang_id` int(100) NOT NULL,
  `lang_key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `traductions`
--

INSERT INTO `traductions` (`id`, `lang_id`, `lang_key`, `value`) VALUES
(1, 1, 'welcome', 'Welcome'),
(2, 1, 'add', 'Add');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `pswd` varchar(100) NOT NULL,
  `token_pswd` varchar(100) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `ip_adress` varchar(30) NOT NULL,
  `browser` varchar(100) NOT NULL,
  `last_login` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `image`, `pswd`, `token_pswd`, `telephone`, `ip_adress`, `browser`, `last_login`, `timestamp`) VALUES
(1, 'Abasi', 'Ahmad', 'admin257@mail.com', 'setic.png', '81dc9bdb52d04dc20036dbd8313ed055', '81dc9bdb52d04dc20036dbd8313ed055', '69460410', '127.0.0.1', 'Chrome v2', '2024/06/29 15:12:00', '2024-07-05 07:02:17'),
(2, 'INGABIRE', 'Eddy Emmanuel', 'ingabire01ed@gmail.com', 'setic.png', '1867ae28bd4ae7b6d3a554b03cb81de4', 'f0de3e93cf0baaf22f3bb56edabc8950', '62877379', '127.0.0.1', 'Chrome', '2024/06/26 12:18:00', '2024-07-05 07:02:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerte`
--
ALTER TABLE `alerte`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificat_ssl`
--
ALTER TABLE `certificat_ssl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corbeille`
--
ALTER TABLE `corbeille`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_id` (`site_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `license`
--
ALTER TABLE `license`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ligne_ssl`
--
ALTER TABLE `ligne_ssl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_id` (`site_id`),
  ADD KEY `ssl_id` (`ssl_id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`),
  ADD KEY `institution_id` (`client_id`),
  ADD KEY `certificat_id` (`certificat_id`),
  ADD KEY `licence_id` (`license_id`);

--
-- Indexes for table `traductions`
--
ALTER TABLE `traductions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alerte`
--
ALTER TABLE `alerte`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificat_ssl`
--
ALTER TABLE `certificat_ssl`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `corbeille`
--
ALTER TABLE `corbeille`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `license`
--
ALTER TABLE `license`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ligne_ssl`
--
ALTER TABLE `ligne_ssl`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `traductions`
--
ALTER TABLE `traductions`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
