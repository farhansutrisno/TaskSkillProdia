-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07 Sep 2022 pada 17.28
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prodia`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cuaca`
--

CREATE TABLE `cuaca` (
  `kdCuaca` int(11) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lon` varchar(100) NOT NULL,
  `timezone` int(20) NOT NULL,
  `pressure` int(20) NOT NULL,
  `humidity` int(20) NOT NULL,
  `wind_speed` varchar(30) NOT NULL,
  `weather_id` int(20) NOT NULL,
  `weather_main` varchar(30) NOT NULL,
  `weather_description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cuaca`
--

INSERT INTO `cuaca` (`kdCuaca`, `lat`, `lon`, `timezone`, `pressure`, `humidity`, `wind_speed`, `weather_id`, `weather_main`, `weather_description`) VALUES
(1, '-6.2146', '106.8451', 25200, 1010, 100, '3.6', 803, 'Clouds', 'broken clouds'),
(2, '-6.2146', '106.8451', 25200, 1010, 100, '3.6', 803, 'Clouds', 'broken clouds'),
(3, '-6.2146', '106.8451', 25200, 1010, 100, '3.6', 803, 'Clouds', 'broken clouds'),
(4, '-6.2146', '106.8451', 25200, 1009, 100, '2.57', 802, 'Clouds', 'scattered clouds'),
(5, '-6.2146', '106.8451', 25200, 1009, 100, '2.57', 802, 'Clouds', 'scattered clouds');

-- --------------------------------------------------------

--
-- Struktur dari tabel `operator`
--

CREATE TABLE `operator` (
  `idOperator` int(11) NOT NULL,
  `namaLengkap` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `noTelepon` varchar(13) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `tanggalLahir` varchar(15) DEFAULT NULL,
  `jenisKelamin` varchar(15) DEFAULT NULL,
  `foto` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `operator`
--

INSERT INTO `operator` (`idOperator`, `namaLengkap`, `username`, `password`, `noTelepon`, `email`, `tanggalLahir`, `jenisKelamin`, `foto`) VALUES
(2, 'farhan sutrisno', 'farhan', '1234', '081298374183', 'farhansutrisno98@gmail.com', '2019-01-17', 'Laki-Laki', 'avatar31.png'),
(5, 'farhan sutrisno', 'farhansutrisno', 'jujuluk48', '081298374183', '', '', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cuaca`
--
ALTER TABLE `cuaca`
  ADD PRIMARY KEY (`kdCuaca`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`idOperator`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cuaca`
--
ALTER TABLE `cuaca`
  MODIFY `kdCuaca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `idOperator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
