-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2019 at 12:05 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

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
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `is_doctor_specialist` int(11) NOT NULL DEFAULT '0',
  `is_doctor_of_duty` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `is_doctor_specialist`, `is_doctor_of_duty`) VALUES
(1, 'SUWOTO, dr ', 0, 1),
(2, 'RICKY SUWANDI, dr. MM, MARS', 0, 1),
(3, 'Suwitno, dr', 0, 1),
(4, 'dr.Ariani', 1, 0),
(5, 'dr.Syarif', 1, 0),
(6, 'dr.melisa', 1, 0),
(7, 'dr.Johanes Sp.U', 1, 0),
(9, 'dr.Fany', 1, 1),
(10, 'dr.Imam', 1, 1),
(11, 'dr.Priscilla', 1, 0),
(12, 'dr. Roy Cristian SpJP', 1, 0),
(13, 'dr.Sidharta', 1, 0),
(14, 'dr.Yudi,sp BS', 1, 0),
(15, 'dr.Wahyu Sp.PD', 1, 0),
(16, 'dr.cynthia utami , Sp.A', 1, 0),
(17, 'dr.Shiera', 1, 0),
(18, 'dr.rully', 1, 0),
(19, 'dr.Hans', 1, 0),
(20, 'dr.Bambang Heru', 1, 0),
(21, 'dr.dwi Ro', 1, 0),
(22, 'dr. Febi', 1, 0),
(23, 'FORRY FORTUNA, dr. Sp.OG', 1, 0),
(24, 'HOTMA PARULIAN SIMATUPANG, dr. Sp.OG', 1, 0),
(25, 'IVAN R. SENTOSA, dr Sp.OG, M.Med', 1, 0),
(26, 'JERIO WIJAYA, Dr.,Sp.OG', 1, 0),
(27, 'ADI M. RAHARDJA, dr. Sp.OG', 1, 0),
(28, 'LUKMAN B. HUDONO, dr. Sp.OG', 1, 0),
(29, 'ASRIL MOEIS, dr. Sp.OG', 1, 0),
(30, 'JOHAN WIDJAJA, dr', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_of_duty`
--

CREATE TABLE `doctor_of_duty` (
  `id` int(11) NOT NULL,
  `doctor_id` int(1) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_of_duty`
--

INSERT INTO `doctor_of_duty` (`id`, `doctor_id`, `plasma_id`) VALUES
(4, 2, 1),
(5, 3, 1),
(6, 9, 1),
(7, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_room`
--

CREATE TABLE `doctor_room` (
  `id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `description` varchar(225) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_room`
--

INSERT INTO `doctor_room` (`id`, `room_number`, `description`, `plasma_id`) VALUES
(1, 159, 'test aja', 7),
(4, 153, '', 7),
(5, 155, '', 7),
(6, 156, '', 7),
(7, 158, '', 7);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedule`
--

CREATE TABLE `doctor_schedule` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `monday` varchar(20) NOT NULL,
  `tuesday` varchar(20) NOT NULL DEFAULT '-',
  `wednesday` varchar(20) NOT NULL DEFAULT '-',
  `thursday` varchar(20) NOT NULL DEFAULT '-',
  `friday` varchar(20) NOT NULL DEFAULT '-',
  `saturday` varchar(20) NOT NULL DEFAULT '-',
  `sunday` varchar(25) NOT NULL DEFAULT '-',
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_schedule`
--

INSERT INTO `doctor_schedule` (`id`, `doctor_id`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `room_id`) VALUES
(3, 23, '08.00 - 13.00', '-', '-', '-', '08.00 - 13.00', '08.00 - 10.00', '-', 4),
(4, 24, '10.00 - 13.00', '-', '-', '-', '10.00 - 13.00', '-', '-', 5),
(5, 25, '10.00 - 16.00', '-', '-', '-', '08.00 - 13.00', '-', '-', 6),
(6, 26, '09.00 - 14.00', '-', '-', '-', '08.00 - 13.00', '-', '-', 7),
(7, 27, '14.00 - 16.00', '-', '-', '-', '08.00 - 13.00', '-', '-', 7),
(8, 28, '09.00 - 14.00', '-', '-', '-', '08.00 - 13.00', '-', '-', 1);

-- --------------------------------------------------------

--
-- Table structure for table `image_slide`
--

CREATE TABLE `image_slide` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `description` varchar(255) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image_slide`
--

INSERT INTO `image_slide` (`id`, `name`, `description`, `plasma_id`) VALUES
(1, '758c8763165df39d9193037a1b04e363.jpg', '', 2),
(2, '705df156c9aee78fb6f4dd9d8f72d65c.jpg', '', 1),
(3, '3f9bbbedbef54b4d198b392b60998e1c.jpg', '', 3),
(4, '04cb57a0eb6e6f83725ab7507661b667.jpg', '', 1),
(5, '17567b64d041322e84543f8917cf586b.jpg', 'test aja', 7),
(6, '037934b0a629db9a790e2064641abc48.png', '', 7);

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
(3, 'Sr. Noviyanti', 1),
(5, 'Sr. Risna', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nurse_of_duty`
--

CREATE TABLE `nurse_of_duty` (
  `id` int(11) NOT NULL,
  `plasma_id` int(11) NOT NULL,
  `nurse_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nurse_of_duty`
--

INSERT INTO `nurse_of_duty` (`id`, `plasma_id`, `nurse_id`) VALUES
(1, 2, 2),
(2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nurse_spv`
--

CREATE TABLE `nurse_spv` (
  `id` int(11) NOT NULL,
  `nurse_id` int(11) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nurse_spv`
--

INSERT INTO `nurse_spv` (`id`, `nurse_id`, `plasma_id`) VALUES
(1, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pic_nurse`
--

CREATE TABLE `pic_nurse` (
  `id` int(11) NOT NULL,
  `nurse_id` int(11) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pic_nurse`
--

INSERT INTO `pic_nurse` (`id`, `nurse_id`, `plasma_id`) VALUES
(1, 1, 1),
(2, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `plasma`
--

CREATE TABLE `plasma` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `title` varchar(225) NOT NULL,
  `url` varchar(50) NOT NULL,
  `is_doctor_of_duty` int(11) NOT NULL,
  `is_specialist_doctor` int(11) NOT NULL,
  `is_nurse` int(11) NOT NULL,
  `is_pic_nurse` int(11) NOT NULL,
  `is_image_slide` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plasma`
--

INSERT INTO `plasma` (`id`, `name`, `title`, `url`, `is_doctor_of_duty`, `is_specialist_doctor`, `is_nurse`, `is_pic_nurse`, `is_image_slide`, `is_active`, `type_id`) VALUES
(1, 'IGD', 'INSTALASI GAWAT DARURAT (IGD) 24 JAM', 'igd', 1, 1, 1, 1, 1, 1, 1),
(2, 'Lantai 6-A', 'Informasi Rawat Inap LT. 6 Wing A', 'enama', 1, 0, 0, 0, 0, 1, 3),
(3, 'Lantai 6-B', 'Informasi Rawat Inap LT. 6 Wing B', 'enamb', 1, 0, 0, 0, 0, 1, 3),
(4, 'Lantai 7-A', 'Informasi Rawat Inap LT. 7 Wing A	', 'tujuha', 1, 0, 0, 0, 0, 1, 3),
(5, 'Lantai 7-B', 'Informasi Rawat Inap LT. 7 Wing B	', 'tujuhb', 0, 0, 0, 0, 0, 1, 3),
(6, 'Lantai 8-A', 'Informasi Rawat Inap LT. 8 Wing A', 'delapana', 0, 0, 0, 0, 0, 1, 3),
(7, 'Obgyn', 'Poliklinik Obgyn', 'obgyn', 1, 0, 0, 0, 1, 1, 2),
(8, 'Klinik Anak', 'Informasi Dokter Praktek Klinik Anak', 'anak', 0, 0, 0, 0, 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `image_icon` varchar(50) NOT NULL,
  `image_display` varchar(50) NOT NULL,
  `is_active` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `name`, `image_icon`, `image_display`, `is_active`) VALUES
(1, 'RS Peduli', 'ddfac0f009de50a1ca09f64bd08b33f8.ico', '09d39fa9ad39ba4a5bbfbcde5ea3f360.png', 1),
(2, 'RS Grha Kedoya', 'dd475887438056703c8b9ee9534f871d.ico', 'f9689cbb13e4012a778557c32665daef.jpg', 0);

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
(1, 'Specialist Obgyn', '4', '5', 2),
(20, 'Spesialis Mata', '', '6', 1),
(21, 'Spesialis Penyakit Dalam', 'test', 'test', 2),
(22, 'Spesialis Radiologi', 'test', 'test', 2),
(23, 'Spesialis Urologi', '7', '7', 1),
(24, 'Spesialis Saraf', '11', '10', 1),
(26, 'Spesialis Jantung', '12', '12', 1),
(27, 'Specialist USG', '13', '9', 1),
(28, 'Specialist Ortopedi', '22', '22', 1),
(29, 'Specialist Bedah Saraf', '14', '14', 1),
(30, 'Specialist Anak', '', '16', 1),
(31, 'Specialist Internis', '', '15', 1),
(32, 'Specialist Bedah', '17', '17', 1),
(33, 'Specialist THT', '', '18', 1),
(34, 'Specialist Kulit Kelamin', '21', '19', 1),
(35, 'Specialist Paru', '', '20', 1),
(36, 'Specialist test', '4', '5', 1);

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
(1, 'igd'),
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
  `role_id` int(1) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nik`, `username`, `password`, `role_id`, `is_active`) VALUES
(1, 1529, 'agus.firman', '21232f297a57a5a743894a0e4a801fc3', 1, 1),
(4, 0, 'ugd', 'e10adc3949ba59abbe56e057f20f883e', 3, 1),
(5, 0, 'obgyn', 'e10adc3949ba59abbe56e057f20f883e', 3, 1),
(6, 0, 'admin', '21232f297a57a5a743894a0e4a801fc3', 2, 1);

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
(1, 'superadmin'),
(2, 'admin'),
(3, 'member');

-- --------------------------------------------------------

--
-- Table structure for table `visit_time`
--

CREATE TABLE `visit_time` (
  `id` int(11) NOT NULL,
  `noon` varchar(25) NOT NULL,
  `afternoon` varchar(25) NOT NULL DEFAULT '00.00',
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visit_time`
--

INSERT INTO `visit_time` (`id`, `noon`, `afternoon`, `plasma_id`) VALUES
(1, '10.00 - 12.00', '15.00 - 16.30', 2),
(18, '10.00 - 12.00', '15.00 - 16.30', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_of_duty`
--
ALTER TABLE `doctor_of_duty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plasma_id` (`plasma_id`),
  ADD KEY `doctor_id` (`doctor_id`);

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
  ADD KEY `room_id` (`room_id`),
  ADD KEY `doctor_id` (`doctor_id`);

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
-- Indexes for table `nurse_of_duty`
--
ALTER TABLE `nurse_of_duty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plasma_id` (`plasma_id`);

--
-- Indexes for table `nurse_spv`
--
ALTER TABLE `nurse_spv`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `visit_time`
--
ALTER TABLE `visit_time`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plasma_id` (`plasma_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `doctor_of_duty`
--
ALTER TABLE `doctor_of_duty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctor_room`
--
ALTER TABLE `doctor_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `image_slide`
--
ALTER TABLE `image_slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nurse`
--
ALTER TABLE `nurse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nurse_of_duty`
--
ALTER TABLE `nurse_of_duty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nurse_spv`
--
ALTER TABLE `nurse_spv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pic_nurse`
--
ALTER TABLE `pic_nurse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plasma`
--
ALTER TABLE `plasma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `specialist_doctor`
--
ALTER TABLE `specialist_doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `visit_time`
--
ALTER TABLE `visit_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctor_of_duty`
--
ALTER TABLE `doctor_of_duty`
  ADD CONSTRAINT `doctor_of_duty_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`),
  ADD CONSTRAINT `doctor_of_duty_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`);

--
-- Constraints for table `doctor_room`
--
ALTER TABLE `doctor_room`
  ADD CONSTRAINT `doctor_room_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`);

--
-- Constraints for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  ADD CONSTRAINT `doctor_schedule_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `doctor_room` (`id`),
  ADD CONSTRAINT `doctor_schedule_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`);

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
-- Constraints for table `nurse_of_duty`
--
ALTER TABLE `nurse_of_duty`
  ADD CONSTRAINT `nurse_of_duty_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
