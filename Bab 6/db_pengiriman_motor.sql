-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 12, 2024 at 05:08 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pengiriman_motor`
--

-- --------------------------------------------------------

--
-- Table structure for table `dealer`
--

CREATE TABLE `dealer` (
  `dealer_id` int NOT NULL,
  `nama_dealer` varchar(255) NOT NULL,
  `alamat_dealer` varchar(255) NOT NULL,
  `detail_kontak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `motor`
--

CREATE TABLE `motor` (
  `motor_id` int NOT NULL,
  `model` varchar(255) NOT NULL,
  `spesifikasi` varchar(255) NOT NULL,
  `status_ketersediaan` enum('Tersedia','Sedang Dikirim','Terjual') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelanggan_id` int NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `alamat_pelanggan` varchar(255) NOT NULL,
  `detail_kontak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan_logistik`
--

CREATE TABLE `perusahaan_logistik` (
  `perusahaan_logistik_id` int NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `detail_kontak` varchar(255) NOT NULL,
  `informasi_armada` varchar(255) NOT NULL,
  `riwayat_pengiriman` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `pesanan_id` int NOT NULL,
  `motor_id` int NOT NULL,
  `dealer_id` int NOT NULL,
  `pelanggan_id` int NOT NULL,
  `tanggal_pesan` date NOT NULL,
  `alamat_pengiriman` varchar(255) NOT NULL,
  `status_pengiriman` enum('Menunggu Pencocokan','Sedang Dikirim','Terkirim') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_perusahaan_logistik`
--

CREATE TABLE `pesanan_perusahaan_logistik` (
  `pesanan_id` int NOT NULL,
  `perusahaan_logistik_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dealer`
--
ALTER TABLE `dealer`
  ADD PRIMARY KEY (`dealer_id`);

--
-- Indexes for table `motor`
--
ALTER TABLE `motor`
  ADD PRIMARY KEY (`motor_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indexes for table `perusahaan_logistik`
--
ALTER TABLE `perusahaan_logistik`
  ADD PRIMARY KEY (`perusahaan_logistik_id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`pesanan_id`),
  ADD KEY `motor_id` (`motor_id`),
  ADD KEY `dealer_id` (`dealer_id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `pesanan_perusahaan_logistik`
--
ALTER TABLE `pesanan_perusahaan_logistik`
  ADD PRIMARY KEY (`pesanan_id`,`perusahaan_logistik_id`),
  ADD KEY `perusahaan_logistik_id` (`perusahaan_logistik_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dealer`
--
ALTER TABLE `dealer`
  MODIFY `dealer_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `motor`
--
ALTER TABLE `motor`
  MODIFY `motor_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `pelanggan_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perusahaan_logistik`
--
ALTER TABLE `perusahaan_logistik`
  MODIFY `perusahaan_logistik_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `pesanan_id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`motor_id`) REFERENCES `motor` (`motor_id`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`dealer_id`) REFERENCES `dealer` (`dealer_id`),
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`pelanggan_id`),
  ADD CONSTRAINT `pesanan_ibfk_4` FOREIGN KEY (`motor_id`) REFERENCES `motor` (`motor_id`),
  ADD CONSTRAINT `pesanan_ibfk_5` FOREIGN KEY (`dealer_id`) REFERENCES `dealer` (`dealer_id`),
  ADD CONSTRAINT `pesanan_ibfk_6` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`pelanggan_id`),
  ADD CONSTRAINT `pesanan_ibfk_7` FOREIGN KEY (`motor_id`) REFERENCES `motor` (`motor_id`),
  ADD CONSTRAINT `pesanan_ibfk_8` FOREIGN KEY (`dealer_id`) REFERENCES `dealer` (`dealer_id`),
  ADD CONSTRAINT `pesanan_ibfk_9` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`pelanggan_id`);

--
-- Constraints for table `pesanan_perusahaan_logistik`
--
ALTER TABLE `pesanan_perusahaan_logistik`
  ADD CONSTRAINT `pesanan_perusahaan_logistik_ibfk_1` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`pesanan_id`),
  ADD CONSTRAINT `pesanan_perusahaan_logistik_ibfk_2` FOREIGN KEY (`perusahaan_logistik_id`) REFERENCES `perusahaan_logistik` (`perusahaan_logistik_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
