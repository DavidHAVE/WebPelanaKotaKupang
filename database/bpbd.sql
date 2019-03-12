-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 20, 2019 at 05:25 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bpbd`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `nama`, `username`, `password`) VALUES
(1, 'David', 'admin', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `laporan_id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `alamat` text,
  `jenis_kejadian` varchar(50) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `informasi` text,
  `pengguna_id` int(11) DEFAULT NULL,
  `clear` varchar(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`laporan_id`, `tanggal`, `latitude`, `longitude`, `alamat`, `jenis_kejadian`, `foto`, `informasi`, `pengguna_id`, `clear`) VALUES
(31, '2019-02-13 10:02:35', '-7.7773526', '110.4409183', 'Gg Purwosari 1, Sorogenan II, Purwomartani, Kalasan, Sleman Regency, Special Region of Yogyakarta 55571, Indonesia', 'Angin Kencang', '13022019032135Screenshot_20190208-225301.jpg', 'informasi', 1, '1'),
(32, '2019-02-13 10:02:30', '-7.7773526', '110.4409183', 'Gg Purwosari 1, Sorogenan II, Purwomartani, Kalasan, Sleman Regency, Special Region of Yogyakarta 55571, Indonesia', 'Kebakaran', '13022019033030FB_IMG_1500539674188.jpg', 'informasi', 1, '1'),
(35, '2019-02-13 03:02:57', '-7.7773526', '110.4409183', 'Gg Purwosari 1, Sorogenan II, Purwomartani, Kalasan, Sleman Regency, Special Region of Yogyakarta 55571, Indonesia', 'Angin Kencang', '130220190829581550046593160.jpg', 'informasi', 1, '1'),
(36, '2019-02-13 03:02:56', '-7.7773526', '110.4409183', 'Gg Purwosari 1, Sorogenan II, Purwomartani, Kalasan, Sleman Regency, Special Region of Yogyakarta 55571, Indonesia', 'Banjir', '130220190830561550046650295.jpg', 'informasi', 1, '0'),
(37, '2019-02-13 05:02:17', '-7.7773526', '110.4409183', 'Gg Purwosari 1, Sorogenan II, Purwomartani, Kalasan, Sleman Regency, Special Region of Yogyakarta 55571, Indonesia', 'Angin Kencang', '13022019101018fingerprint-sensor-module-f.jpg', 'informasi', 1, '0'),
(38, '2019-02-13 05:02:12', '-7.7773526', '110.4409183', 'Gg Purwosari 1, Sorogenan II, Purwomartani, Kalasan, Sleman Regency, Special Region of Yogyakarta 55571, Indonesia', 'Angin Kencang', '13022019101312images.jpeg', 'informasi', 1, '0'),
(39, '2019-02-13 05:02:29', '-7.7773526', '110.4409183', 'Gg Purwosari 1, Sorogenan II, Purwomartani, Kalasan, Sleman Regency, Special Region of Yogyakarta 55571, Indonesia', 'Tanah Longsor', '13022019103729P_20190202_131108_BF.jpg', 'informasi', 1, '0'),
(40, '2019-02-13 08:56:11', '-7.7773526', '110.4409183', 'Gg Purwosari 1, Sorogenan II, Purwomartani, Kalasan, Sleman Regency, Special Region of Yogyakarta 55571, Indonesia', 'Tanah Longsor', '13022019205611ic_launcher.png', 'kkk', 1, '0'),
(41, '2019-02-13 09:04:57', '-7.7773526', '110.4409183', 'Gg Purwosari 1, Sorogenan II, Purwomartani, Kalasan, Sleman Regency, Special Region of Yogyakarta 55571, Indonesia', 'Angin Kencang', '13022019210456ic_action_settings.png', 'gg', 1, '0'),
(42, '2019-02-13 21:08:12', '-7.7773526', '110.4409183', 'Gg Purwosari 1, Sorogenan II, Purwomartani, Kalasan, Sleman Regency, Special Region of Yogyakarta 55571, Indonesia', 'Angin Kencang', '13022019210812P_20181101_124029_vHDR_On.jpg', 'iii', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `pengguna_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor_telepon` varchar(15) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `blok` varchar(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`pengguna_id`, `nama`, `nomor_telepon`, `email`, `blok`) VALUES
(1, 'David2', '1234', 'david2@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `peringatan_dini`
--

CREATE TABLE `peringatan_dini` (
  `peringatan_dini_id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `judul` varchar(100) NOT NULL,
  `informasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prakiraan_cuaca`
--

CREATE TABLE `prakiraan_cuaca` (
  `prakiraan_cuaca_id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `informasi` text NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prakiraan_cuaca`
--

INSERT INTO `prakiraan_cuaca` (`prakiraan_cuaca_id`, `tanggal`, `informasi`, `foto`) VALUES
(13, '2019-02-06 07:02:37', 'informasi', '06022019071137bpbd.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`laporan_id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`pengguna_id`);

--
-- Indexes for table `peringatan_dini`
--
ALTER TABLE `peringatan_dini`
  ADD PRIMARY KEY (`peringatan_dini_id`);

--
-- Indexes for table `prakiraan_cuaca`
--
ALTER TABLE `prakiraan_cuaca`
  ADD PRIMARY KEY (`prakiraan_cuaca_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `laporan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `pengguna_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `peringatan_dini`
--
ALTER TABLE `peringatan_dini`
  MODIFY `peringatan_dini_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `prakiraan_cuaca`
--
ALTER TABLE `prakiraan_cuaca`
  MODIFY `prakiraan_cuaca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
