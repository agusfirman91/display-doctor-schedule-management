-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2019 at 10:26 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblclassroom`
--

CREATE TABLE `tblclassroom` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclassroom`
--

INSERT INTO `tblclassroom` (`id`, `name`, `description`) VALUES
(1, 'Kelas 1', 'Mauris quis turpis'),
(2, 'Kelas 2', 'et,'),
(3, 'VIP', 'nec urna suscipit nonummy. Fusce fermentum fermentum arcu.'),
(4, 'VIP', 'Quisque ornare tortor at risus. Nunc ac sem ut dolor'),
(5, 'Kelas 1', 'neque. In ornare sagittis felis. Donec'),
(6, 'SVIP', 'Cras pellentesque. Sed dictum. Proin eget odio. Aliquam vulputate'),
(7, 'PRESIDENTIAL SUITES', 'metus facilisis lorem tristique aliquet. Phasellus');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblclassroom`
--
ALTER TABLE `tblclassroom`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblclassroom`
--
ALTER TABLE `tblclassroom`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
