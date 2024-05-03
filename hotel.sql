-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 09:51 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id` int(11) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `tipe`, `deskripsi`, `harga`, `foto`, `video`) VALUES
(1, 'Standard', 'Our generous Superior Rooms boast an average 32 sqm / 344 sqf of space.\r\nClassic style blends beautifully with contemporary elegance and amenities. Sleep soundly in a sumptuous queen size bed with crisp linens and refresh in the white Italian marble bathroom with its deep bath and White Company toiletries. This luxurious room is well beyond what one might consider standard.', 500000, 'standard.jpg', 'standard.mp4'),
(2, 'Deluxe', 'Spacious Deluxe Rooms boast an average 36 sqm / 387sq ft. Contemporary luxury and amenities combine with elegant classic style. The large King size bed with crisp linens ensure a peaceful night’s sleep. Elegantly designed bathrooms feature sleek white Italian marble, a convenient walk-in shower and separate bath. Simply relax in pure comfort, and pamper yourself with a cosy bathrobe and White Company toiletries.', 900000, 'deluxe.jpg', 'deluxe.mp4'),
(3, 'Family', 'These wonderfully spacious and elegant rooms of an average 52 sqm/560sqft, are perfectly suited to families. A comfortable sofa, armchairs and coffee table furnish a generous open plan seating area. Two large Double size beds with crisp linens ensure a good night’s sleep for all, whilst the beautifully designed Italian white marble bathroom includes both a walk-in shower and separate bath.', 1500000, 'family.jpg', 'family.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `nomor_identitas` varchar(25) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `durasi` int(11) NOT NULL,
  `breakfast` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
