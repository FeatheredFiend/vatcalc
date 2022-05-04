-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 04, 2022 at 01:51 PM
-- Server version: 10.5.15-MariaDB-cll-lve
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `propriet_vatcalc`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220504092140', '2022-05-04 11:21:45', 42);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vatcalc`
--

CREATE TABLE `vatcalc` (
  `id` int(11) NOT NULL,
  `value` double NOT NULL,
  `vat` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vatcalc`
--

INSERT INTO `vatcalc` (`id`, `value`, `vat`) VALUES
(1, 830, 33),
(2, 2688, 71),
(3, 3713, 27),
(4, 2492, 59),
(5, 1376, 33),
(6, 1524, 66),
(7, 151, 52),
(8, 4984, 28),
(9, 4211, 1),
(10, 2809, 45),
(11, 2382, 47),
(12, 1430, 66),
(13, 4856, 41),
(14, 2964, 17),
(15, 4999, 6),
(16, 577, 47),
(17, 434, 70),
(18, 4744, 59),
(19, 3397, 7),
(20, 4560, 40),
(21, 3072, 32),
(22, 3382, 26),
(23, 3217, 29),
(24, 4383, 75),
(25, 4646, 40),
(26, 1258, 58),
(27, 1003, 7),
(28, 1660, 20),
(29, 718, 32),
(30, 2614, 18),
(31, 2232, 50),
(32, 4851, 39),
(33, 2402, 2),
(34, 870, 38),
(35, 4950, 60),
(36, 1236, 6),
(37, 3165, 74),
(38, 2988, 57),
(39, 4901, 2),
(40, 778, 46),
(41, 3420, 8),
(42, 2896, 73),
(43, 1147, 33),
(44, 1415, 30),
(45, 2724, 41),
(46, 1019, 59),
(47, 2529, 27),
(48, 864, 21),
(49, 4661, 59),
(50, 3704, 33),
(51, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `vatcalc`
--
ALTER TABLE `vatcalc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vatcalc`
--
ALTER TABLE `vatcalc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
