-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2025 at 07:12 AM
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
-- Database: `kelompok3`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(18) NOT NULL,
  `nama_dosen` varchar(100) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `nama_dosen`, `prodi_id`, `foto`) VALUES
('1781945', 'Burhan', 24, 'person.png'),
('1781946', 'toni', 23, 'person.png'),
('1781947', 'Agus', 24, 'person.png');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `gender` enum('L','P') NOT NULL,
  `hobi` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `email`, `nim`, `prodi_id`, `gender`, `hobi`, `alamat`) VALUES
(26, 'burhan', 'burhan@gmail.com', '2311082017', 22, 'L', 'Berenang, Sepak Bola', 'pagaruyung'),
(35, 'norman', 'norman@gmail.com', '2311081011', 22, 'L', 'Sepak Bola, Voli', 'bandung'),
(37, 'ahmad', 'ahmad@gmail.com', '2311081012', 22, 'L', 'Sepak Bola, Voli', 'jakarta'),
(39, 'bubun', 'bubun@gmail.com', '2311081013', 24, 'L', 'Berenang', 'papue newginie'),
(41, 'raju', 'raju@gmail.com', '2311081014', 25, 'L', 'Sepak Bola, Voli', 'Aceh');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_p` int(11) NOT NULL,
  `nama_prodi` varchar(50) NOT NULL,
  `jenjang` enum('D2','D3','D4','S1','S2') NOT NULL,
  `keterangan` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_p`, `nama_prodi`, `jenjang`, `keterangan`) VALUES
(22, 'Animasi', 'D4', 'D4 animasi'),
(23, 'software enginering', 'D4', 'D4 rekayasa perangkat lunak'),
(24, 'Sistem Informasi', 'D3', 'D3 sistem informasi'),
(25, 'Akuntansi', 'D3', 'D3 Akuntansi'),
(27, 'Alat Berat', 'D3', 'D3 Teknik Mesin'),
(34, 'Sistem Informasi', 'D4', 'D3 sistem informasi'),
(35, 'Akuntansi', 'D4', 'D3 Akuntansi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`nim`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_p`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id_p`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
