-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 11:54 AM
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
-- Database: `hl_kehadiran`
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
(4, '2024-04-27', 1);

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

--
-- Dumping data for table `kehadiran`
--

INSERT INTO `kehadiran` (`id_hari`, `id_pekerja`, `ada_hadir`, `masa_mula`, `masa_tamat`) VALUES
(4, 17, 1, '2024-04-27 17:54:01', NULL);

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
(15, 'Elon Musk', '$2y$12$r8RaBWdPmlfiGxusqK/Oau8tWkR5UUNgDWAYnSWQnVQ9e3J8Wc9gi', '11', '2024-04-27 17:53:35'),
(16, 'Jeff Bezos', '$2y$12$/FAefv8NOA3U2KmKMz3l3enW.DuauCd9JEs0OCMScCJEepCiwjv.O', '22', '2024-04-27 17:53:44');

-- --------------------------------------------------------

--
-- Table structure for table `other`
--

CREATE TABLE `other` (
  `longitude` float DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `secret_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `other`
--

INSERT INTO `other` (`longitude`, `latitude`, `secret_key`) VALUES
(101.541, 2.98437, 'boss is good');

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
(13, 'John Doe', '$2y$12$AAYodJyu2W9wDDFWBci9bekEzxICBmKuYv2o6anmKYo5dlnZt1iRK', '1', '2024-04-27 17:47:00'),
(14, 'Jake Smith', '$2y$12$noTSajuRrBH71V2a8OaCiOUH8A6nxThr27ucaxeg0bIJz9YCFxm76', '2', '2024-04-27 17:47:13'),
(15, 'Lapis Lazuli', '$2y$12$hbamGP6GylrShssxD243m.3J/RxuYNWiSiJ8amzvL3suKrlotvbZK', '3', '2024-04-27 17:47:43'),
(17, 'D\'squarius Green, Jr. III', '$2y$12$DPpAEC6ECH2FHew16n1JzueNXzAQ4SqoD5nWoYNm6RbzvqjF6Dd76', '4', '2024-04-27 17:53:13');

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
  MODIFY `id_hari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `majikan`
--
ALTER TABLE `majikan`
  MODIFY `id_majikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pekerja`
--
ALTER TABLE `pekerja`
  MODIFY `id_pekerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
