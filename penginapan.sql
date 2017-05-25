-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 25, 2017 at 12:07 
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penginapan`
--

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE `channel` (
  `id_channel` varchar(10) NOT NULL,
  `nama_channel` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detil_fasilitas`
--

CREATE TABLE `detil_fasilitas` (
  `id_detail_fasilitas` varchar(10) NOT NULL,
  `kamar_id` varchar(10) DEFAULT NULL,
  `fasilitas_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detil_inventori`
--

CREATE TABLE `detil_inventori` (
  `id_detil_inventori` varchar(10) NOT NULL,
  `kamar_id` varchar(10) DEFAULT NULL,
  `inventori_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detil_layanan`
--

CREATE TABLE `detil_layanan` (
  `id_detil_layanan` varchar(10) NOT NULL,
  `kamar_id` varchar(10) DEFAULT NULL,
  `layanan_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` varchar(10) NOT NULL,
  `nama_fasilitas` varchar(20) DEFAULT NULL,
  `status_fasilitas` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventori`
--

CREATE TABLE `inventori` (
  `id_inventori` varchar(10) NOT NULL,
  `nama_inventori` varchar(20) DEFAULT NULL,
  `harga_inventori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` varchar(10) NOT NULL,
  `nama_jabatan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` varchar(10) NOT NULL,
  `nama_kamar` varchar(20) DEFAULT NULL,
  `no_kamar` varchar(5) DEFAULT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `status_kamar` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` varchar(10) NOT NULL,
  `nama_layanan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_active` int(1) NOT NULL,
  `is_parent` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `link`, `icon`, `is_active`, `is_parent`) VALUES
(15, 'menu management', 'menu', 'fa fa-list-alt', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(10) NOT NULL,
  `nama_pegawai` varchar(20) DEFAULT NULL,
  `alamat_pegawai` varchar(20) DEFAULT NULL,
  `telp_pegawai` varchar(20) DEFAULT NULL,
  `jabatan_id` varchar(10) DEFAULT NULL,
  `status_pegawai` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id_profil` varchar(10) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id_promo` varchar(10) NOT NULL,
  `promo_awal` date DEFAULT NULL,
  `promo_akhir` date DEFAULT NULL,
  `harga_promo` int(11) DEFAULT NULL,
  `keterangan_promo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`id_channel`);

--
-- Indexes for table `detil_fasilitas`
--
ALTER TABLE `detil_fasilitas`
  ADD PRIMARY KEY (`id_detail_fasilitas`),
  ADD KEY `fk_reference_6` (`fasilitas_id`),
  ADD KEY `fk_reference_7` (`kamar_id`);

--
-- Indexes for table `detil_inventori`
--
ALTER TABLE `detil_inventori`
  ADD PRIMARY KEY (`id_detil_inventori`),
  ADD KEY `fk_reference_3` (`inventori_id`),
  ADD KEY `fk_reference_4` (`kamar_id`);

--
-- Indexes for table `detil_layanan`
--
ALTER TABLE `detil_layanan`
  ADD PRIMARY KEY (`id_detil_layanan`),
  ADD KEY `fk_reference_1` (`layanan_id`),
  ADD KEY `fk_reference_2` (`kamar_id`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indexes for table `inventori`
--
ALTER TABLE `inventori`
  ADD PRIMARY KEY (`id_inventori`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `fk_reference_5` (`jabatan_id`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id_promo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `detil_fasilitas`
--
ALTER TABLE `detil_fasilitas`
  ADD CONSTRAINT `fk_reference_6` FOREIGN KEY (`fasilitas_id`) REFERENCES `fasilitas` (`id_fasilitas`),
  ADD CONSTRAINT `fk_reference_7` FOREIGN KEY (`kamar_id`) REFERENCES `kamar` (`id_kamar`);

--
-- Constraints for table `detil_inventori`
--
ALTER TABLE `detil_inventori`
  ADD CONSTRAINT `fk_reference_3` FOREIGN KEY (`inventori_id`) REFERENCES `inventori` (`id_inventori`),
  ADD CONSTRAINT `fk_reference_4` FOREIGN KEY (`kamar_id`) REFERENCES `kamar` (`id_kamar`);

--
-- Constraints for table `detil_layanan`
--
ALTER TABLE `detil_layanan`
  ADD CONSTRAINT `fk_reference_1` FOREIGN KEY (`layanan_id`) REFERENCES `layanan` (`id_layanan`),
  ADD CONSTRAINT `fk_reference_2` FOREIGN KEY (`kamar_id`) REFERENCES `kamar` (`id_kamar`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `fk_reference_5` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id_jabatan`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
