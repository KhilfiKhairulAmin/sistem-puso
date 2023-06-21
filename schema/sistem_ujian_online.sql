-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 21, 2023 at 04:04 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_ujian_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nama_guru` varchar(60) DEFAULT NULL,
  `nokp_guru` varchar(12) NOT NULL,
  `katalaluan_guru` varchar(30) DEFAULT NULL,
  `tahap` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nama_guru`, `nokp_guru`, `katalaluan_guru`, `tahap`) VALUES
('Nor Fitrah Binti Othman', '000000000000', 'fitrah', 'GURU'),
('Haliah Binti Osman', '111111111111', 'haliah', 'ADMIN'),
('Rhuzaimah Binti Ramli', '222222222222', 'rhuzaimah', 'ADMIN'),
('Amirul Izham Bin Abu Seman', '333333333333', 'amirulizham', 'GURU'),
('Rodzil Bin Mat', '444444444444', 'rodzil', 'GURU');

-- --------------------------------------------------------

--
-- Table structure for table `jawapan_murid`
--

CREATE TABLE `jawapan_murid` (
  `id_jawapan` int(11) NOT NULL,
  `no_soalan` int(11) DEFAULT NULL,
  `jawapan` varchar(100) DEFAULT NULL,
  `catatan` varchar(100) DEFAULT NULL,
  `nokp_murid` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jawapan_murid`
--

INSERT INTO `jawapan_murid` (`id_jawapan`, `no_soalan`, `jawapan`, `catatan`, `nokp_murid`) VALUES
(1, 1, 'jawapan_a', 'BETUL', '000000000000');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(3) NOT NULL,
  `ting` varchar(2) DEFAULT NULL,
  `nama_kelas` varchar(30) DEFAULT NULL,
  `nokp_guru` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `ting`, `nama_kelas`, `nokp_guru`) VALUES
(1, '5', 'DEDIKASI', '000000000000'),
(2, '5', 'MULIA', '333333333333'),
(3, '5', 'RASIONAL', '444444444444');

-- --------------------------------------------------------

--
-- Table structure for table `murid`
--

CREATE TABLE `murid` (
  `nama_murid` varchar(60) DEFAULT NULL,
  `nokp_murid` varchar(12) NOT NULL,
  `katalaluan_murid` varchar(30) DEFAULT NULL,
  `id_kelas` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `murid`
--

INSERT INTO `murid` (`nama_murid`, `nokp_murid`, `katalaluan_murid`, `id_kelas`) VALUES
('Muhammad Nazrin Ariefshah Bin Kamal Shah', '000000000000', 'nazrin', 1),
('Husna Farzana Binti Ahmad Fuad', '051101222222', 'husna', 2),
('Khilfi Bin Khairul Amin', '111111111111', 'khilfi', 2),
('Amzar Aimran Bin Azreezul', '333333333333', 'amzar', 2);

-- --------------------------------------------------------

--
-- Table structure for table `set_soalan`
--

CREATE TABLE `set_soalan` (
  `no_set` int(9) NOT NULL,
  `topik` varchar(60) DEFAULT NULL,
  `arahan` varchar(250) DEFAULT NULL,
  `jenis` varchar(250) DEFAULT NULL,
  `tarikh` date DEFAULT NULL,
  `masa` varchar(50) DEFAULT NULL,
  `nokp_guru` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `set_soalan`
--

INSERT INTO `set_soalan` (`no_set`, `topik`, `arahan`, `jenis`, `tarikh`, `masa`, `nokp_guru`) VALUES
(1, 'BM KERTAS 1: BAHAGIAN A', 'Jawab semua soalan.', 'Latihan', '2023-06-21', 'Tiada', '000000000000');

-- --------------------------------------------------------

--
-- Table structure for table `soalan`
--

CREATE TABLE `soalan` (
  `no_soalan` int(11) NOT NULL,
  `no_set` int(9) DEFAULT NULL,
  `soalan` varchar(250) DEFAULT NULL,
  `gambar` varchar(60) DEFAULT NULL,
  `jawapan_a` varchar(60) DEFAULT NULL,
  `jawapan_b` varchar(60) DEFAULT NULL,
  `jawapan_c` varchar(60) DEFAULT NULL,
  `jawapan_d` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soalan`
--

INSERT INTO `soalan` (`no_soalan`, `no_set`, `soalan`, `gambar`, `jawapan_a`, `jawapan_b`, `jawapan_c`, `jawapan_d`) VALUES
(1, 1, 'Perkataan \"saya\" tergolong dalam golongan kata ganti nama diri ke berapa?', ' ', 'Pertama', 'Kedua', 'Ketiga', 'Tiada jawapan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nokp_guru`);

--
-- Indexes for table `jawapan_murid`
--
ALTER TABLE `jawapan_murid`
  ADD PRIMARY KEY (`id_jawapan`),
  ADD UNIQUE KEY `no_soalan` (`no_soalan`,`nokp_murid`),
  ADD KEY `nokp_murid` (`nokp_murid`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `nokp_guru` (`nokp_guru`);

--
-- Indexes for table `murid`
--
ALTER TABLE `murid`
  ADD PRIMARY KEY (`nokp_murid`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `set_soalan`
--
ALTER TABLE `set_soalan`
  ADD PRIMARY KEY (`no_set`),
  ADD KEY `nokp_guru` (`nokp_guru`);

--
-- Indexes for table `soalan`
--
ALTER TABLE `soalan`
  ADD PRIMARY KEY (`no_soalan`),
  ADD KEY `no_set` (`no_set`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jawapan_murid`
--
ALTER TABLE `jawapan_murid`
  MODIFY `id_jawapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `set_soalan`
--
ALTER TABLE `set_soalan`
  MODIFY `no_set` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `soalan`
--
ALTER TABLE `soalan`
  MODIFY `no_soalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jawapan_murid`
--
ALTER TABLE `jawapan_murid`
  ADD CONSTRAINT `jawapan_murid_ibfk_1` FOREIGN KEY (`no_soalan`) REFERENCES `soalan` (`no_soalan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawapan_murid_ibfk_2` FOREIGN KEY (`nokp_murid`) REFERENCES `murid` (`nokp_murid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`nokp_guru`) REFERENCES `guru` (`nokp_guru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `murid`
--
ALTER TABLE `murid`
  ADD CONSTRAINT `murid_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `set_soalan`
--
ALTER TABLE `set_soalan`
  ADD CONSTRAINT `set_soalan_ibfk_1` FOREIGN KEY (`nokp_guru`) REFERENCES `guru` (`nokp_guru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `soalan`
--
ALTER TABLE `soalan`
  ADD CONSTRAINT `soalan_ibfk_1` FOREIGN KEY (`no_set`) REFERENCES `set_soalan` (`no_set`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
