-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 03:50 PM
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
-- Database: `pkj_kehadiran_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `hari`
--

CREATE TABLE `hari` (
  `id_hari` int(11) NOT NULL,
  `tarikh` date NOT NULL DEFAULT curdate(),
  `adalah_hari_bekerja` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hari`
--

INSERT INTO `hari` (`id_hari`, `tarikh`, `adalah_hari_bekerja`) VALUES
(1, '2024-04-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran`
--

CREATE TABLE `kehadiran` (
  `id_hari` int(11) NOT NULL,
  `id_pekerja` int(11) NOT NULL,
  `ada_hadir` tinyint(1) NOT NULL,
  `masa_mula` datetime NOT NULL DEFAULT curtime(),
  `masa_tamat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `majikan`
--

CREATE TABLE `majikan` (
  `id_majikan` int(11) NOT NULL,
  `nama_majikan` varchar(60) NOT NULL,
  `katalaluan_majikan` varchar(255) NOT NULL,
  `no_kp_majikan` varchar(12) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `majikan`
--

INSERT INTO `majikan` (`id_majikan`, `nama_majikan`, `katalaluan_majikan`, `no_kp_majikan`, `created_at`) VALUES
(1, 'Majikan 1', '$2y$12$uZM5Yn1mYfEM6yaCDOv1q.UkxvL8Ha20ibKrhcgm8QBAWaXNLlksG', '11', '2024-04-25 21:49:18'),
(2, 'Majikan 2', '$2y$12$cF31sUfx/v5UHxLRDvb1bOUxaUB9N4XORQv53/1f.1ed2nHbzyUE2', '22', '2024-04-25 21:49:24');

-- --------------------------------------------------------

--
-- Table structure for table `pekerja`
--

CREATE TABLE `pekerja` (
  `id_pekerja` int(11) NOT NULL,
  `nama_pekerja` varchar(60) NOT NULL,
  `katalaluan_pekerja` varchar(255) NOT NULL,
  `no_kp_pekerja` varchar(12) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pekerja`
--

INSERT INTO `pekerja` (`id_pekerja`, `nama_pekerja`, `katalaluan_pekerja`, `no_kp_pekerja`, `created_at`) VALUES
(1, 'Pekerja 1', '$2y$12$PgzbueoB6950QZE0V5NP8OGijoSzd8ZuC43JE6992wCK5TiFBiNsK', '1', '2024-04-25 21:48:52'),
(2, 'Pekerja 2', '$2y$12$LFqfvsmh3KezVBAv6NQ5oeux5PuN9KzwvNN9NX3S3SB8QZf9ZllfG', '2', '2024-04-25 21:49:01'),
(3, 'Pekerja 3', '$2y$12$3/IrH2Bt09gqH0M3eQX7b.BC3G7I8kr8pVvMqxQkGiKLCsdQafLMK', '3', '2024-04-25 21:49:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id_hari`);

--
-- Indexes for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`id_hari`,`id_pekerja`),
  ADD KEY `id_pekerja` (`id_pekerja`);

--
-- Indexes for table `majikan`
--
ALTER TABLE `majikan`
  ADD PRIMARY KEY (`id_majikan`);

--
-- Indexes for table `pekerja`
--
ALTER TABLE `pekerja`
  ADD PRIMARY KEY (`id_pekerja`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hari`
--
ALTER TABLE `hari`
  MODIFY `id_hari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `majikan`
--
ALTER TABLE `majikan`
  MODIFY `id_majikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pekerja`
--
ALTER TABLE `pekerja`
  MODIFY `id_pekerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD CONSTRAINT `kehadiran_ibfk_1` FOREIGN KEY (`id_hari`) REFERENCES `hari` (`id_hari`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kehadiran_ibfk_2` FOREIGN KEY (`id_pekerja`) REFERENCES `pekerja` (`id_pekerja`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
