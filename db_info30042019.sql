-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2019 at 12:08 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.13

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
-- Table structure for table `doctor_of_duty`
--

CREATE TABLE `doctor_of_duty` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_of_duty`
--

INSERT INTO `doctor_of_duty` (`id`, `name`, `plasma_id`) VALUES
(1, 'SUWOTO, dr ', 1),
(2, 'RICKY SUWANDI, dr. MM, MARS', 2),
(3, 'Suwitno, dr', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_room`
--

CREATE TABLE `doctor_room` (
  `id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedule`
--

CREATE TABLE `doctor_schedule` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `image_slide`
--

CREATE TABLE `image_slide` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image_slide`
--

INSERT INTO `image_slide` (`id`, `name`, `plasma_id`) VALUES
(1, '758c8763165df39d9193037a1b04e363.jpg', 2),
(2, '705df156c9aee78fb6f4dd9d8f72d65c.jpg', 1),
(3, '3f9bbbedbef54b4d198b392b60998e1c.jpg', 3),
(4, 'c8517443b7cca66528fae9c901d3ac0b.jpg', 1),
(5, '0f7bacecfdc5425cec366112bd12ac89.jpg', 1),
(6, '037934b0a629db9a790e2064641abc48.png', 7);

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE `nurse` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nurse`
--

INSERT INTO `nurse` (`id`, `name`, `plasma_id`) VALUES
(1, 'Sr. Sri Nova Sinaga', 1),
(2, 'Sr. Yulia Fitri', 1),
(3, 'Sr. Noviyanti', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pic_nurse`
--

CREATE TABLE `pic_nurse` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pic_nurse`
--

INSERT INTO `pic_nurse` (`id`, `name`, `plasma_id`) VALUES
(1, 'Sr. Risna', 1);

-- --------------------------------------------------------

--
-- Table structure for table `plasma`
--

CREATE TABLE `plasma` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `title` varchar(225) NOT NULL,
  `url` varchar(50) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plasma`
--

INSERT INTO `plasma` (`id`, `name`, `title`, `url`, `type_id`) VALUES
(1, 'UGD\r\n', 'INSTALASI GAWAT DARURAT (IGD) 24 JAM', 'ugd', 1),
(2, 'Lantai 6-A', '', 'enama', 3),
(3, 'Lantai 6-B', '', '', 3),
(4, 'Lantai 7-A', '', '', 3),
(5, 'Lantai 7-B', '', '', 3),
(6, 'Lantai 8-A', '', '', 3),
(7, 'Obgyn', '', 'obgyn', 2);

-- --------------------------------------------------------

--
-- Table structure for table `plasma_detail`
--

CREATE TABLE `plasma_detail` (
  `id` int(11) NOT NULL,
  `plasma_id` int(11) NOT NULL,
  `dokter_jaga` varchar(225) NOT NULL,
  `karu` varchar(225) NOT NULL,
  `pj_shift` varchar(225) NOT NULL,
  `perawat` varchar(225) NOT NULL,
  `specialist_doctor` int(11) NOT NULL DEFAULT '0',
  `image_slide` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plasma_detail`
--

INSERT INTO `plasma_detail` (`id`, `plasma_id`, `dokter_jaga`, `karu`, `pj_shift`, `perawat`, `specialist_doctor`, `image_slide`) VALUES
(1, 2, '\"RUDY, dr\";\"RICKY SUWANDI, dr. MM, MARS\"', 'Sr Wiwin Winarsih', 'Sr Anggraini Titias. A', 'Sr Anggraini Titias. A', 0, ''),
(2, 1, '\"RUDY, dr\";\"RICKY SUWANDI, dr. MM, MARS\"', 'Sr. Yani', 'Sr. Evi', 'Sr. Evi', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `specialist_doctor`
--

CREATE TABLE `specialist_doctor` (
  `id` int(11) NOT NULL,
  `specialist_name` varchar(225) NOT NULL,
  `doctor_oc_1` varchar(225) NOT NULL,
  `doctor_oc_2` varchar(225) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialist_doctor`
--

INSERT INTO `specialist_doctor` (`id`, `specialist_name`, `doctor_oc_1`, `doctor_oc_2`, `plasma_id`) VALUES
(1, 'Specialist Obgyn', 'dr.Ariani', 'dr.Syarif', 2),
(20, 'Spesialis Mata', ' ', 'dr.melisa', 1),
(21, 'Spesialis Penyakit Dalam', 'test', 'test', 2),
(22, 'Spesialis Radiologi', 'test', 'test', 2),
(23, 'Spesialis Urologi', 'dr.Johanes Sp.U', 'Dr.Johanes Sp.U', 1),
(24, 'Spesialis Saraf', 'dr.Priscilla(08-14)', 'dr.Imam', 1),
(26, 'Spesialis Jantung', 'dr. Roy Cristian SpJP', 'dr. Roy Cristian SpJP', 1),
(27, 'Specialist USG', 'dr.sidharta', 'dr.Fany', 1),
(28, 'Specialist Ortopedi', 'dr.febi', 'dr febi', 1),
(29, 'Specialist Bedah Saraf', 'dr.Yudi,sp BS', 'dr. Yudi,SpBS', 1),
(30, 'Specialist Anak', ' ', 'dr.cynthia utami , Sp.A', 1),
(31, 'Specialist Internis', ' ', 'dr.Wahyu Sp.PD', 1),
(32, 'Specialist Bedah', 'dr.Shiera', 'dr.Shiera', 1),
(33, 'Specialist THT', ' ', 'dr.rully', 1),
(34, 'Specialist Kulit Kelamin', 'dr.dwi Ro', 'dr.Hans', 1),
(35, 'Specialist Paru', ' ', 'dr.Bambang Heru', 1);

-- --------------------------------------------------------

--
-- Table structure for table `type_plasma`
--

CREATE TABLE `type_plasma` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_plasma`
--

INSERT INTO `type_plasma` (`id`, `name`) VALUES
(1, 'ugd'),
(2, 'rajal'),
(3, 'ranap');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nik` int(5) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `role_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nik`, `username`, `password`, `role_id`) VALUES
(1, 1529, 'agus.firman', '21232f297a57a5a743894a0e4a801fc3', 1),
(4, 0, 'ugd', 'e10adc3949ba59abbe56e057f20f883e', 2),
(5, 0, 'obgyn', 'e10adc3949ba59abbe56e057f20f883e', 2),
(6, 0, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctor_of_duty`
--
ALTER TABLE `doctor_of_duty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plasma_id` (`plasma_id`);

--
-- Indexes for table `doctor_room`
--
ALTER TABLE `doctor_room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plasma_id` (`plasma_id`);

--
-- Indexes for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `image_slide`
--
ALTER TABLE `image_slide`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plasma_id` (`plasma_id`);

--
-- Indexes for table `nurse`
--
ALTER TABLE `nurse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plasma_id` (`plasma_id`);

--
-- Indexes for table `pic_nurse`
--
ALTER TABLE `pic_nurse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plasma_id` (`plasma_id`);

--
-- Indexes for table `plasma`
--
ALTER TABLE `plasma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `plasma_detail`
--
ALTER TABLE `plasma_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plasma_id` (`plasma_id`);

--
-- Indexes for table `specialist_doctor`
--
ALTER TABLE `specialist_doctor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `specialist_name` (`specialist_name`),
  ADD KEY `plasma_id` (`plasma_id`);

--
-- Indexes for table `type_plasma`
--
ALTER TABLE `type_plasma`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role` (`role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctor_of_duty`
--
ALTER TABLE `doctor_of_duty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctor_room`
--
ALTER TABLE `doctor_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image_slide`
--
ALTER TABLE `image_slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nurse`
--
ALTER TABLE `nurse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pic_nurse`
--
ALTER TABLE `pic_nurse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plasma`
--
ALTER TABLE `plasma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `plasma_detail`
--
ALTER TABLE `plasma_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `specialist_doctor`
--
ALTER TABLE `specialist_doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `type_plasma`
--
ALTER TABLE `type_plasma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctor_of_duty`
--
ALTER TABLE `doctor_of_duty`
  ADD CONSTRAINT `doctor_of_duty_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`);

--
-- Constraints for table `doctor_room`
--
ALTER TABLE `doctor_room`
  ADD CONSTRAINT `doctor_room_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`);

--
-- Constraints for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  ADD CONSTRAINT `doctor_schedule_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `doctor_room` (`id`);

--
-- Constraints for table `image_slide`
--
ALTER TABLE `image_slide`
  ADD CONSTRAINT `image_slide_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`);

--
-- Constraints for table `nurse`
--
ALTER TABLE `nurse`
  ADD CONSTRAINT `nurse_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`);

--
-- Constraints for table `pic_nurse`
--
ALTER TABLE `pic_nurse`
  ADD CONSTRAINT `pic_nurse_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`);

--
-- Constraints for table `plasma`
--
ALTER TABLE `plasma`
  ADD CONSTRAINT `plasma_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type_plasma` (`id`);

--
-- Constraints for table `plasma_detail`
--
ALTER TABLE `plasma_detail`
  ADD CONSTRAINT `plasma_detail_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `specialist_doctor`
--
ALTER TABLE `specialist_doctor`
  ADD CONSTRAINT `specialist_doctor_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
