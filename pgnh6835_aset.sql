-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 05, 2021 at 08:44 AM
-- Server version: 10.2.37-MariaDB-cll-lve
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pgnh6835_aset`
--

-- --------------------------------------------------------

--
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `id_aset` int(11) NOT NULL,
  `no_register_aset` varchar(64) NOT NULL,
  `nama_barang_aset` varchar(64) NOT NULL,
  `merk_aset` varchar(64) NOT NULL,
  `tahun_awal_aset` varchar(6) NOT NULL,
  `nilai_awal_aset` varchar(32) NOT NULL,
  `fisik_aset` varchar(16) NOT NULL,
  `kondisi_aset` varchar(16) NOT NULL,
  `jumlah_aset` int(11) NOT NULL,
  `foto_aset` text NOT NULL,
  `tempat_aset` varchar(32) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `ruangan_aset` text NOT NULL,
  `model_aset` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(16) NOT NULL,
  `nama_kategori` varchar(64) NOT NULL,
  `keterangan_kategori` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `keterangan_kategori`) VALUES
(1, 'Meja', ''),
(2, 'Printer', ''),
(3, 'Lemari', ''),
(4, 'Kursi', ''),
(5, 'Komputer', ''),
(6, 'ELektronik Lainnya', ''),
(7, 'Keamanan', ''),
(8, 'Kompor', ''),
(9, 'Lain - Lain', ''),
(10, 'Alat dapur', ''),
(11, 'Galon', ''),
(12, 'Elpiji', ''),
(13, 'Alat TUlis', ''),
(14, 'Tempat Penyimpanan', ''),
(15, 'Rak', ''),
(16, 'Mesin Olahan Pangan', ''),
(17, 'Timbangan', ''),
(18, 'Alat Kebersihan', ''),
(19, 'Instalasi Air', ''),
(20, 'Mesin Pengemas', ''),
(21, 'Genset', '');

-- --------------------------------------------------------

--
-- Table structure for table `tempat`
--

CREATE TABLE `tempat` (
  `id_tempat` int(11) NOT NULL,
  `nama_tempat` varchar(32) NOT NULL,
  `alamat_tempat` text NOT NULL,
  `keterangan_kategoritempat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tempat`
--

INSERT INTO `tempat` (`id_tempat`, `nama_tempat`, `alamat_tempat`, `keterangan_kategoritempat`) VALUES
(1, 'Ds Point', 'putat jaya gg lebar', 'sadasdasda'),
(2, 'UPP Dolly', 'Putat jaya 2a ', 'asda'),
(3, 'UPP Bulak', 'Jl  Cumpat', 'xzczxc'),
(4, 'DKPP ', 'Jl. Pagesangan', 'asdasd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id_aset`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tempat`
--
ALTER TABLE `tempat`
  ADD PRIMARY KEY (`id_tempat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aset`
--
ALTER TABLE `aset`
  MODIFY `id_aset` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tempat`
--
ALTER TABLE `tempat`
  MODIFY `id_tempat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
