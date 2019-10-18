-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2019 at 09:06 AM
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
-- Table structure for table `administration`
--

CREATE TABLE `administration` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administration`
--

INSERT INTO `administration` (`id`, `name`, `plasma_id`) VALUES
(1, 'Neneng Khoiriah', 2);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `is_doctor_specialist` int(11) NOT NULL DEFAULT 0,
  `is_doctor_of_duty` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `is_doctor_specialist`, `is_doctor_of_duty`) VALUES
(1, 'SUWOTO, dr ', 0, 1),
(2, 'RICKY SUWANDI, dr. MM, MARS', 0, 1),
(3, 'Suwitno, dr', 0, 1),
(4, 'dr.Ariani', 1, 1),
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
(30, 'JOHAN WIDJAJA, dr', 1, 0),
(31, 'ADAM BERLIAN TRISNADI. dr', 0, 1),
(32, 'HUTOMO. Dr', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_of_dutty`
--

CREATE TABLE `doctor_of_dutty` (
  `id` int(11) NOT NULL,
  `doctor_id` int(1) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_of_dutty`
--

INSERT INTO `doctor_of_dutty` (`id`, `doctor_id`, `plasma_id`) VALUES
(4, 2, 1),
(5, 3, 1),
(6, 9, 1),
(7, 10, 1),
(8, 31, 2),
(9, 32, 2);

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
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(8) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `description` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'superadmin', 'Administrator'),
(2, 'admin', 'General admin'),
(3, 'member', 'member area\r\n'),
(4, 'admin-acs', ''),
(5, 'member-acs', '');

-- --------------------------------------------------------

--
-- Table structure for table `group_access_permission`
--

CREATE TABLE `group_access_permission` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_access_permission`
--

INSERT INTO `group_access_permission` (`id`, `group_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(4, 2, 1),
(5, 2, 2),
(16, 2, 15),
(19, 1, 14),
(20, 1, 15),
(21, 1, 16),
(22, 1, 17),
(23, 1, 18),
(24, 1, 19),
(25, 1, 20),
(26, 1, 21),
(27, 1, 22),
(28, 1, 23),
(29, 1, 24),
(30, 1, 25),
(32, 3, 2),
(33, 3, 17),
(34, 3, 18),
(35, 3, 19),
(36, 3, 20),
(37, 3, 21),
(38, 3, 22),
(39, 3, 23),
(40, 3, 24),
(41, 3, 25),
(42, 2, 14),
(43, 2, 16),
(44, 2, 17),
(45, 2, 18),
(46, 2, 19),
(47, 2, 20),
(48, 2, 21),
(49, 2, 22),
(50, 2, 23),
(51, 2, 24),
(52, 2, 25),
(56, 1, 3),
(57, 1, 26),
(58, 1, 27),
(59, 1, 28),
(60, 1, 29),
(61, 1, 30),
(62, 1, 31),
(65, 4, 30),
(66, 4, 31),
(67, 4, 32),
(68, 4, 33),
(72, 5, 33),
(80, 5, 31),
(81, 1, 32),
(82, 1, 33),
(83, 1, 34),
(84, 1, 35),
(85, 1, 36),
(86, 1, 37),
(87, 5, 37),
(88, 1, 38),
(89, 1, 39);

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
(1, '0f1acbf20c016de5c377446c29a8efeb.png', '6a-vip', 2),
(2, '705df156c9aee78fb6f4dd9d8f72d65c.jpg', '', 1),
(3, '05dedafc932566aa892095116c773d65.png', '6a 1', 2),
(4, '04cb57a0eb6e6f83725ab7507661b667.jpg', '', 1),
(6, '037934b0a629db9a790e2064641abc48.png', '', 7),
(7, '7dfafd4dc42bdba6ab2e3dced299d13a.PNG', 'teste', 1),
(8, '32c2cfdeb7dafe251892400770a6cd3d.PNG', 'teste', 1),
(9, '6e2adf83fbdc38f21304717820bc8b41.PNG', 'teste', 1),
(10, '', 'tester', 4),
(11, '72e3797102d7a1e24018e06f1d961e73.png', '6a', 2);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `link`, `icon`, `parent_id`, `sort`, `is_active`) VALUES
(1, 'master data', 'master_data', 'list', 0, 10, 1),
(2, 'display', 'display', 'monitor', 0, 14, 1),
(3, 'management', 'management', 'grid', 0, 25, 1),
(14, 'users', 'main/user', '', 1, 11, 1),
(15, 'dokter', 'main/doctor', '', 1, 12, 1),
(16, 'perawat', 'main/nurse', '', 1, 13, 1),
(17, 'dokter jaga', 'main/doctor-of-duty', '', 2, 15, 1),
(18, 'dokter spesialis', 'main/specialist-doctor', '', 2, 17, 1),
(19, 'kepala ruang', 'main/nurse-spv', '', 2, 18, 1),
(20, 'perawat jaga', 'main/nurse-of-dutty', '', 2, 19, 1),
(21, 'perawat PJ shift', 'main/pic-nurse', '', 2, 20, 1),
(22, 'jadwal dokter', 'main/doctor-schedule', '', 2, 21, 1),
(23, 'jam besuk', 'main/jam-besuk', '', 2, 22, 1),
(24, 'ruang dokter', 'main/doctor-room', '', 2, 23, 1),
(25, 'Image slide', 'main/image-slide', '', 2, 24, 1),
(26, 'management display', 'main/display-management', '', 3, 26, 1),
(27, 'setting display', 'main/setting', '', 3, 27, 1),
(28, 'menu management', 'main/menus', '', 3, 29, 1),
(29, 'access permission', 'main/access-permission', '', 3, 28, 1),
(30, 'acs', 'acs', 'list', 0, 3, 1),
(31, 'menu', 'acs/menu', '', 30, 6, 1),
(32, 'patient', 'acs/patients', '', 30, 7, 1),
(33, 'order', 'acs/orders', '', 30, 8, 1),
(34, 'administrasi', 'main/administration', '', 2, 16, 1),
(35, 'helpdesk', 'helpdesk', 'list', 0, 1, 1),
(36, 'klaim-user', 'helpdesk/claim-users', '', 35, 2, 1),
(37, 'rotations', 'acs/rotations', '', 30, 9, 1),
(38, 'group menu', 'acs/group-menu', '', 30, 5, 1),
(39, 'Ketegori Menu', 'acs/menu-category', '', 30, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE `nurse` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nurse`
--

INSERT INTO `nurse` (`id`, `name`) VALUES
(1, 'Sr. Sri Nova Sinaga'),
(2, 'Sr. Yulia Fitri'),
(3, 'Sr. Noviyanti'),
(5, 'Sr. Risna'),
(11, 'Sr. Sherly D. Masengi'),
(12, 'Sr. Denita B.P'),
(13, 'Sr. Henny Widyanti'),
(14, 'Sr. Rosalia Fg'),
(15, 'Sr. Esterlyna O');

-- --------------------------------------------------------

--
-- Table structure for table `nurse_of_dutty`
--

CREATE TABLE `nurse_of_dutty` (
  `id` int(11) NOT NULL,
  `plasma_id` int(11) NOT NULL,
  `nurse_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nurse_of_dutty`
--

INSERT INTO `nurse_of_dutty` (`id`, `plasma_id`, `nurse_id`) VALUES
(1, 2, 12),
(2, 1, 1),
(3, 2, 13),
(4, 2, 14);

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
(1, 11, 2);

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
(2, 5, 1),
(3, 15, 2);

-- --------------------------------------------------------

--
-- Table structure for table `plasma`
--

CREATE TABLE `plasma` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `title` varchar(225) NOT NULL,
  `url` varchar(50) NOT NULL,
  `is_doctor_of_dutty` int(11) NOT NULL,
  `is_specialist_doctor` int(11) NOT NULL,
  `is_nurse` int(11) NOT NULL,
  `is_pic_nurse` int(11) NOT NULL,
  `is_administration` int(1) NOT NULL DEFAULT 1,
  `is_image_slide` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plasma`
--

INSERT INTO `plasma` (`id`, `name`, `title`, `url`, `is_doctor_of_dutty`, `is_specialist_doctor`, `is_nurse`, `is_pic_nurse`, `is_administration`, `is_image_slide`, `is_active`, `type_id`) VALUES
(1, 'IGD', 'INSTALASI GAWAT DARURAT (IGD) 24 JAM', 'igd', 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'Lantai 6-A', 'Informasi Rawat Inap LT. 6 Wing A', 'enama', 1, 0, 0, 0, 1, 0, 1, 3),
(3, 'Lantai 6-B', 'Informasi Rawat Inap LT. 6 Wing B', 'enamb', 1, 0, 0, 0, 1, 0, 1, 3),
(4, 'Lantai 7-A', 'Informasi Rawat Inap LT. 7 Wing A	', 'tujuha', 1, 0, 0, 0, 0, 0, 1, 3),
(5, 'Lantai 7-B', 'Informasi Rawat Inap LT. 7 Wing B	', 'tujuhb', 0, 0, 0, 0, 0, 0, 1, 3),
(6, 'Lantai 8-A', 'Informasi Rawat Inap LT. 8 Wing A', 'delapana', 0, 0, 0, 0, 0, 0, 1, 3),
(7, 'Obgyn', 'Poliklinik Obgyn', 'obgyn', 1, 0, 0, 0, 0, 1, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `image_icon` varchar(50) NOT NULL,
  `image_display` varchar(50) NOT NULL,
  `is_active` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `name`, `image_icon`, `image_display`, `is_active`) VALUES
(1, 'RS Peduli', 'ddfac0f009de50a1ca09f64bd08b33f8.ico', '09d39fa9ad39ba4a5bbfbcde5ea3f360.png', 0),
(2, 'RS Sejahtera', '60112a7414326491737d68b63a6815e1.jpg', '07e16f1a30913b0ed690cb8e5ce62c65.png', 0),
(3, 'RS Grha Kedoya', '2e4b62939583f9c038ee97a36fa8319c.jpg', '7ebd3250292ed168b0f94248f6e94735.jpg', 1);

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
-- Table structure for table `tblagama`
--

CREATE TABLE `tblagama` (
  `idagama` int(11) NOT NULL,
  `agama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblagama`
--

INSERT INTO `tblagama` (`idagama`, `agama`) VALUES
(1, 'Islam'),
(2, 'Kristen');

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

-- --------------------------------------------------------

--
-- Table structure for table `tbldetailrotations`
--

CREATE TABLE `tbldetailrotations` (
  `id` int(11) NOT NULL,
  `rotation_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT 1,
  `header` varchar(50) NOT NULL,
  `menu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldetailrotations`
--

INSERT INTO `tbldetailrotations` (`id`, `rotation_id`, `class_id`, `cat_id`, `header`, `menu`) VALUES
(2, 1, 1, 1, 'test', '2,4'),
(3, 1, 2, 1, 'test', '2,4'),
(4, 1, 3, 1, 'test', '2,4'),
(5, 1, 6, 1, 'test', '2,4'),
(6, 1, 6, 1, 'ades', '3,5,6'),
(7, 1, 6, 1, 'awfwevves', '2,3,5'),
(8, 1, 3, 1, 'test', '3,4,5'),
(9, 2, 2, 1, '', '2,3,4,5,6,7,8,9');

-- --------------------------------------------------------

--
-- Table structure for table `tblgroupmenus`
--

CREATE TABLE `tblgroupmenus` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `category_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblgroupmenus`
--

INSERT INTO `tblgroupmenus` (`id`, `name`, `description`, `category_id`, `is_active`) VALUES
(1, 'Choice of Main Course', 'makanan pokok\r\n', 1, 1),
(2, 'American Breakfast', 'makanan amerika kali', 1, 1),
(3, 'Breakfast Bread', 'Sarapan Roti ', 1, 1),
(4, 'Assorted Cereal', 'Served with Fresh Milk', 1, 1),
(5, 'Choice of Egg', 'Makanan yang mengandung telur', 2, 1),
(6, 'Choice of Friut or Juice', 'Jus dan buah', 3, 1),
(7, 'Asian set Menu', 'Makanan asia', 3, 1),
(8, 'Oriental of Set Menu', '-', 4, 1),
(9, 'Western of Set Menu', ' -\r\n\r\n', 4, 1),
(10, 'Desert', '-', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblkategorimenus`
--

CREATE TABLE `tblkategorimenus` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblkategorimenus`
--

INSERT INTO `tblkategorimenus` (`id`, `name`, `description`, `is_active`) VALUES
(1, 'Breakfast', 'Sarapan', 1),
(2, 'Lunch', 'Makan Siang', 1),
(3, 'Dinner', 'Makan malam', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblmenus`
--

CREATE TABLE `tblmenus` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `groupmenu_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmenus`
--

INSERT INTO `tblmenus` (`id`, `name`, `description`, `image`, `groupmenu_id`, `is_active`) VALUES
(1, 'Lontong Cap Gomeh', 'nasinya di goreng pake sapi', '41ca816c02176bd2f13e7032770d2f98.jpg', 1, 1),
(2, 'Nasi tim ayam bakso', 'nasinya di goreng', '2422045e4ce8f378658d06e3bced7ad1.jpg', 1, 1),
(3, 'Bubur ayam', 'Ayamnya di penyet penyet', 'db30fc4551468e9715b5c80d8bab2748.jpg', 1, 1),
(4, 'Plain / Toast Bread', 'test', '19b0cca70b24b0295f3b2668c9a26a75.jpg', 3, 1),
(5, 'White / Wheat bread', 'testes', '3f68af74c559b583bfc14a27264d83fb.jpg', 3, 1),
(6, 'Hot Outmeal', 'aw4tfwawd', '9d34b24168a65dc90c4ec5299ad87272.jpg', 4, 1),
(7, 'Hard Bolled Egg', 'testest', 'be651550e37a2d4a92d4d19c2e5c158b.jpg', 5, 1),
(8, 'Semangka', 'testeste', 'a7bef3299d7e9932bd8dade22686653a.jpg', 6, 1),
(9, 'Pepaya', '', '25e1833a1599739e9bfe4fb6d13f2507.jpg', 2, 1),
(10, 'Ayam Geprek', '', '6df325b35b5bb78a2f7bc805d9741405.png', 0, 1),
(11, 'testset', '', 'f1d960aef4bdd7bd3095706faf7f181f.png', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblorders`
--

CREATE TABLE `tblorders` (
  `id` int(11) NOT NULL,
  `id_patient` int(5) NOT NULL,
  `menu_1` int(5) NOT NULL,
  `menu_2` int(5) NOT NULL,
  `menu_3` int(5) NOT NULL,
  `description` text NOT NULL,
  `date_create` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblorders`
--

INSERT INTO `tblorders` (`id`, `id_patient`, `menu_1`, `menu_2`, `menu_3`, `description`, `date_create`) VALUES
(1, 1, 3, 1, 7, '', '0000-00-00'),
(2, 10, 6, 5, 4, '', '2019-09-23'),
(3, 8, 5, 5, 6, 'uahfhashdfawrfecw', '2019-09-23');

-- --------------------------------------------------------

--
-- Table structure for table `tblpasien`
--

CREATE TABLE `tblpasien` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `no_rm` mediumint(9) DEFAULT NULL,
  `no_reg` varchar(13) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `id_class` int(11) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `tgl_lahir` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `idsuku` mediumint(9) DEFAULT NULL,
  `idagama` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpasien`
--

INSERT INTO `tblpasien` (`id`, `no_rm`, `no_reg`, `nama`, `id_class`, `alamat`, `tgl_lahir`, `sex`, `idsuku`, `idagama`) VALUES
(1201, 5126, '633600564-000', 'Drake', 4, 'amet, faucibus ut, nulla. Cras eu tellus eu augue porttitor', '1929-07-12', 'L', 1, 2),
(1202, 2506, '171899651-000', 'Carter', 6, 'Duis sit amet diam eu dolor egestas rhoncus. Proin nisl', '1877-05-19', 'L', 1, 1),
(1203, 1981, '547397596-000', 'Leroy', 6, 'parturient montes, nascetur ridiculus mus. Donec dignissim magna a tortor.', '1878-01-21', 'P', 1, 1),
(1204, 7083, '620348029-000', 'Dorothy', 3, 'risus. Duis a mi fringilla mi lacinia mattis. Integer eu', '1980-11-21', 'L', 1, 1),
(1205, 4634, '814577649-000', 'Alan', 3, 'sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus', '1920-01-23', 'L', 1, 1),
(1206, 5434, '082740309-000', 'Mariam', 3, 'magna. Suspendisse tristique neque venenatis lacus. Etiam bibendum fermentum metus.', '1966-03-17', 'P', 1, 2),
(1207, 4941, '828801258-000', 'Iola', 7, 'metus. In nec orci. Donec nibh. Quisque nonummy ipsum non', '1988-09-11', 'L', 1, 2),
(1208, 2504, '735575094-000', 'Cain', 1, 'metus sit amet ante. Vivamus non lorem vitae odio sagittis', '1924-10-08', 'P', 1, 2),
(1209, 6403, '012467494-000', 'Ethan', 5, 'auctor quis, tristique ac, eleifend vitae, erat. Vivamus nisi. Mauris', '1895-11-26', 'P', 1, 1),
(1210, 4623, '126843119-000', 'Daniel', 7, 'mi eleifend egestas. Sed pharetra, felis eget varius ultrices, mauris', '1871-05-07', 'L', 2, 1),
(1211, 3200, '295623524-000', 'Ignatius', 6, 'mollis non, cursus non, egestas a, dui. Cras pellentesque. Sed', '1968-04-07', 'L', 1, 2),
(1212, 6226, '552913345-000', 'Keegan', 6, 'libero et tristique pellentesque, tellus sem mollis dui, in sodales', '1990-10-27', 'L', 1, 1),
(1213, 3979, '993167535-000', 'Fallon', 3, 'dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero et', '1958-09-16', 'P', 1, 2),
(1214, 4266, '891174385-000', 'Kirby', 3, 'quam. Curabitur vel lectus. Cum sociis natoque penatibus et magnis', '1949-03-14', 'P', 1, 1),
(1215, 6174, '879108900-000', 'Timon', 7, 'elit, dictum eu, eleifend nec, malesuada ut, sem. Nulla interdum.', '1927-10-20', 'P', 2, 1),
(1216, 4305, '141434449-000', 'Brenda', 1, 'mauris sagittis placerat. Cras dictum ultricies ligula. Nullam enim. Sed', '1971-07-01', 'L', 1, 2),
(1217, 4492, '261421887-000', 'Chancellor', 4, 'at, iaculis quis, pede. Praesent eu dui. Cum sociis natoque', '1882-11-28', 'P', 2, 1),
(1218, 5641, '985059823-000', 'Sasha', 1, 'leo elementum sem, vitae aliquam eros turpis non enim. Mauris', '1964-11-29', 'P', 2, 1),
(1219, 4359, '772765590-000', 'Luke', 4, 'hendrerit a, arcu. Sed et libero. Proin mi. Aliquam gravida', '1868-06-03', 'L', 1, 2),
(1220, 5340, '696833581-000', 'Fitzgerald', 4, 'eu, odio. Phasellus at augue id ante dictum cursus. Nunc', '1974-01-21', 'P', 2, 2),
(1221, 7215, '904270626-000', 'Xavier', 1, 'urna convallis erat, eget tincidunt dui augue eu tellus. Phasellus', '1943-10-02', 'P', 1, 1),
(1222, 6073, '521644187-000', 'Kitra', 4, 'gravida. Praesent eu nulla at sem molestie sodales. Mauris blandit', '1887-09-25', 'P', 1, 2),
(1223, 3471, '618386973-000', 'Holly', 2, 'Proin sed turpis nec mauris blandit mattis. Cras eget nisi', '1926-11-06', 'P', 2, 1),
(1224, 7505, '848129375-000', 'Britanney', 6, 'cursus in, hendrerit consectetuer, cursus et, magna. Praesent interdum ligula', '1951-06-11', 'L', 1, 2),
(1225, 7442, '337190847-000', 'Emerald', 1, 'elit. Etiam laoreet, libero et tristique pellentesque, tellus sem mollis', '1888-01-12', 'P', 2, 1),
(1226, 6058, '140057217-000', 'Camilla', 6, 'quis arcu vel quam dignissim pharetra. Nam ac nulla. In', '1949-04-13', 'P', 2, 2),
(1227, 7090, '951432541-000', 'Zoe', 4, 'vulputate ullamcorper magna. Sed eu eros. Nam consequat dolor vitae', '1908-03-24', 'L', 1, 1),
(1228, 4124, '013983093-000', 'Remedios', 6, 'vel pede blandit congue. In scelerisque scelerisque dui. Suspendisse ac', '1972-02-27', 'P', 1, 2),
(1229, 3519, '445472061-000', 'Arsenio', 3, 'eu turpis. Nulla aliquet. Proin velit. Sed malesuada augue ut', '1977-01-31', 'P', 2, 1),
(1230, 6995, '705029379-000', 'Hilda', 4, 'in consectetuer ipsum nunc id enim. Curabitur massa. Vestibulum accumsan', '1937-10-12', 'P', 1, 2),
(1231, 2428, '284532264-000', 'Patience', 2, 'mollis. Phasellus libero mauris, aliquam eu, accumsan sed, facilisis vitae,', '1868-10-29', 'P', 1, 2),
(1232, 3714, '568474894-000', 'Camille', 7, 'parturient montes, nascetur ridiculus mus. Proin vel nisl. Quisque fringilla', '1966-06-13', 'L', 1, 1),
(1233, 3113, '688427152-000', 'Imogene', 3, 'sed sem egestas blandit. Nam nulla magna, malesuada vel, convallis', '1928-07-28', 'L', 2, 1),
(1234, 5892, '205376718-000', 'Amela', 5, 'facilisis vitae, orci. Phasellus dapibus quam quis diam. Pellentesque habitant', '1871-12-20', 'P', 2, 1),
(1235, 3540, '230120438-000', 'Flavia', 3, 'dolor, tempus non, lacinia at, iaculis quis, pede. Praesent eu', '1980-07-12', 'L', 2, 2),
(1236, 5690, '143469799-000', 'Sawyer', 2, 'Pellentesque ultricies dignissim lacus. Aliquam rutrum lorem ac risus. Morbi', '1870-09-15', 'P', 1, 1),
(1237, 7319, '998900534-000', 'Quintessa', 7, 'parturient montes, nascetur ridiculus mus. Aenean eget magna. Suspendisse tristique', '1951-11-10', 'L', 1, 2),
(1238, 4421, '901606392-000', 'Igor', 5, 'ante blandit viverra. Donec tempus, lorem fringilla ornare placerat, orci', '1883-04-12', 'L', 2, 2),
(1239, 4333, '916721780-000', 'Keely', 4, 'Curabitur massa. Vestibulum accumsan neque et nunc. Quisque ornare tortor', '1918-07-17', 'L', 1, 1),
(1240, 3519, '740605191-000', 'Wylie', 5, 'Proin nisl sem, consequat nec, mollis vitae, posuere at, velit.', '1913-03-09', 'L', 1, 2),
(1241, 6081, '634919393-000', 'Paki', 5, 'non, egestas a, dui. Cras pellentesque. Sed dictum. Proin eget', '1960-08-12', 'P', 2, 1),
(1242, 2778, '643511272-000', 'Stewart', 4, 'malesuada malesuada. Integer id magna et ipsum cursus vestibulum. Mauris', '1869-02-05', 'P', 2, 1),
(1243, 2727, '777323270-000', 'Blake', 5, 'sapien imperdiet ornare. In faucibus. Morbi vehicula. Pellentesque tincidunt tempus', '1985-03-07', 'L', 1, 2),
(1244, 3440, '837104330-000', 'Eliana', 3, 'iaculis nec, eleifend non, dapibus rutrum, justo. Praesent luctus. Curabitur', '1886-06-05', 'L', 1, 1),
(1245, 3080, '577887060-000', 'TaShya', 4, 'lorem, sit amet ultricies sem magna nec quam. Curabitur vel', '1920-11-29', 'P', 1, 2),
(1246, 5536, '710758988-000', 'Montana', 2, 'ante. Vivamus non lorem vitae odio sagittis semper. Nam tempor', '1886-08-19', 'L', 1, 1),
(1247, 3193, '027025105-000', 'Willow', 5, 'dui augue eu tellus. Phasellus elit pede, malesuada vel, venenatis', '1868-12-22', 'L', 1, 1),
(1248, 2125, '413107301-000', 'Vladimir', 1, 'amet ante. Vivamus non lorem vitae odio sagittis semper. Nam', '1919-01-30', 'P', 1, 2),
(1249, 3972, '007164478-000', 'Nissim', 2, 'ut, nulla. Cras eu tellus eu augue porttitor interdum. Sed', '1941-08-31', 'L', 2, 1),
(1250, 2193, '605224856-000', 'Reed', 5, 'dapibus rutrum, justo. Praesent luctus. Curabitur egestas nunc sed libero.', '1933-05-10', 'L', 1, 1),
(1251, 3029, '843772195-000', 'Lilah', 5, 'accumsan sed, facilisis vitae, orci. Phasellus dapibus quam quis diam.', '1872-10-03', 'L', 1, 1),
(1252, 5595, '016713737-000', 'Nero', 5, 'Vivamus molestie dapibus ligula. Aliquam erat volutpat. Nulla dignissim. Maecenas', '1988-08-07', 'L', 2, 1),
(1253, 4940, '231346107-000', 'Mason', 3, 'ultrices sit amet, risus. Donec nibh enim, gravida sit amet,', '1894-10-28', 'L', 1, 2),
(1254, 6283, '852118918-000', 'Orson', 1, 'imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravida non,', '1875-09-04', 'L', 1, 2),
(1255, 4565, '805064417-000', 'Liberty', 3, 'eget nisi dictum augue malesuada malesuada. Integer id magna et', '1893-04-04', 'L', 1, 2),
(1256, 2604, '116507054-000', 'Dora', 1, 'luctus sit amet, faucibus ut, nulla. Cras eu tellus eu', '1956-09-04', 'P', 1, 1),
(1257, 3821, '387765761-000', 'Dale', 3, 'mi lorem, vehicula et, rutrum eu, ultrices sit amet, risus.', '1941-03-28', 'L', 1, 2),
(1258, 5827, '809653876-000', 'Blaze', 3, 'ante dictum mi, ac mattis velit justo nec ante. Maecenas', '1930-01-26', 'L', 1, 1),
(1259, 3237, '345264527-000', 'Armando', 3, 'primis in faucibus orci luctus et ultrices posuere cubilia Curae;', '1952-05-23', 'P', 2, 2),
(1260, 2999, '964082754-000', 'Leah', 1, 'Cras dictum ultricies ligula. Nullam enim. Sed nulla ante, iaculis', '1892-01-19', 'P', 1, 1),
(1261, 5991, '994200335-000', 'Barry', 5, 'risus, at fringilla purus mauris a nunc. In at pede.', '1976-10-10', 'L', 1, 2),
(1262, 6437, '896944592-000', 'Caldwell', 7, 'Nulla dignissim. Maecenas ornare egestas ligula. Nullam feugiat placerat velit.', '1990-10-08', 'P', 2, 2),
(1263, 5531, '987286036-000', 'Kenneth', 4, 'malesuada. Integer id magna et ipsum cursus vestibulum. Mauris magna.', '1934-09-17', 'P', 2, 2),
(1264, 5677, '650377484-000', 'Macey', 3, 'Donec tempor, est ac mattis semper, dui lectus rutrum urna,', '1987-12-02', 'L', 1, 2),
(1265, 6391, '452256092-000', 'Neville', 1, 'Suspendisse sed dolor. Fusce mi lorem, vehicula et, rutrum eu,', '1982-09-02', 'L', 1, 1),
(1266, 2663, '882707730-000', 'Adrian', 7, 'blandit mattis. Cras eget nisi dictum augue malesuada malesuada. Integer', '1921-07-15', 'L', 2, 2),
(1267, 6065, '620213421-000', 'Aurelia', 4, 'fringilla mi lacinia mattis. Integer eu lacus. Quisque imperdiet, erat', '1903-07-01', 'P', 1, 2),
(1268, 3446, '293894234-000', 'Nayda', 4, 'Sed diam lorem, auctor quis, tristique ac, eleifend vitae, erat.', '1890-08-24', 'P', 2, 1),
(1269, 6169, '740130885-000', 'Boris', 5, 'nisl sem, consequat nec, mollis vitae, posuere at, velit. Cras', '1915-05-15', 'L', 1, 1),
(1270, 2302, '095122792-000', 'Dara', 1, 'mi felis, adipiscing fringilla, porttitor vulputate, posuere vulputate, lacus. Cras', '1961-01-17', 'L', 2, 2),
(1271, 2480, '754359321-000', 'Reese', 3, 'fermentum fermentum arcu. Vestibulum ante ipsum primis in faucibus orci', '1989-08-12', 'P', 2, 1),
(1272, 5312, '458208774-000', 'Venus', 4, 'Donec elementum, lorem ut aliquam iaculis, lacus pede sagittis augue,', '1894-06-10', 'P', 1, 1),
(1273, 3406, '486253586-000', 'Troy', 1, 'ante blandit viverra. Donec tempus, lorem fringilla ornare placerat, orci', '1958-07-22', 'L', 1, 2),
(1274, 6776, '787070838-000', 'Daphne', 6, 'fermentum convallis ligula. Donec luctus aliquet odio. Etiam ligula tortor,', '1901-08-02', 'P', 2, 2),
(1275, 6905, '460441686-000', 'Riley', 1, 'consequat, lectus sit amet luctus vulputate, nisi sem semper erat,', '1964-12-08', 'P', 2, 2),
(1276, 4900, '610152910-000', 'Amery', 2, 'Nunc ullamcorper, velit in aliquet lobortis, nisi nibh lacinia orci,', '1904-10-21', 'P', 2, 2),
(1277, 2788, '743072423-000', 'Claire', 4, 'lobortis quam a felis ullamcorper viverra. Maecenas iaculis aliquet diam.', '1986-09-24', 'P', 2, 2),
(1278, 4504, '841514078-000', 'Kermit', 2, 'venenatis lacus. Etiam bibendum fermentum metus. Aenean sed pede nec', '1883-02-12', 'L', 2, 1),
(1279, 7496, '844081133-000', 'Chadwick', 6, 'mus. Aenean eget magna. Suspendisse tristique neque venenatis lacus. Etiam', '1950-04-12', 'L', 2, 1),
(1280, 2919, '242664001-000', 'Emi', 6, 'luctus et ultrices posuere cubilia Curae; Phasellus ornare. Fusce mollis.', '1930-08-09', 'L', 2, 2),
(1281, 6881, '323335018-000', 'Melyssa', 1, 'non ante bibendum ullamcorper. Duis cursus, diam at pretium aliquet,', '1882-04-12', 'L', 2, 1),
(1282, 4873, '432518751-000', 'Ezekiel', 1, 'ut, nulla. Cras eu tellus eu augue porttitor interdum. Sed', '1911-03-01', 'L', 2, 1),
(1283, 2715, '329103071-000', 'Rogan', 5, 'cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum ut', '1930-09-16', 'L', 2, 1),
(1284, 6087, '384828513-000', 'Cairo', 6, 'luctus sit amet, faucibus ut, nulla. Cras eu tellus eu', '1928-10-25', 'P', 2, 1),
(1285, 3080, '270771207-000', 'Kiara', 3, 'bibendum sed, est. Nunc laoreet lectus quis massa. Mauris vestibulum,', '1898-10-02', 'P', 1, 2),
(1286, 6253, '726299647-000', 'Macaulay', 7, 'erat vitae risus. Duis a mi fringilla mi lacinia mattis.', '1935-06-05', 'L', 2, 2),
(1287, 4360, '312671050-000', 'Fitzgerald', 2, 'quis diam. Pellentesque habitant morbi tristique senectus et netus et', '1985-07-18', 'P', 1, 1),
(1288, 6285, '780800967-000', 'Quincy', 5, 'ut cursus luctus, ipsum leo elementum sem, vitae aliquam eros', '1887-11-09', 'P', 2, 1),
(1289, 7602, '725308365-000', 'Ella', 7, 'erat, eget tincidunt dui augue eu tellus. Phasellus elit pede,', '1928-08-29', 'P', 1, 1),
(1290, 2911, '690484548-000', 'Jarrod', 5, 'congue a, aliquet vel, vulputate eu, odio. Phasellus at augue', '1916-03-31', 'P', 1, 2),
(1291, 5732, '871501599-000', 'Amelia', 1, 'litora torquent per conubia nostra, per inceptos hymenaeos. Mauris ut', '1956-10-10', 'L', 1, 2),
(1292, 2045, '306868373-000', 'Elliott', 5, 'sit amet luctus vulputate, nisi sem semper erat, in consectetuer', '1941-11-01', 'P', 1, 2),
(1293, 5788, '375952587-000', 'Steven', 5, 'dui nec urna suscipit nonummy. Fusce fermentum fermentum arcu. Vestibulum', '1966-10-31', 'L', 2, 1),
(1294, 5567, '958804072-000', 'Dahlia', 5, 'lorem, eget mollis lectus pede et risus. Quisque libero lacus,', '1895-10-08', 'P', 1, 2),
(1295, 4672, '559855135-000', 'Arthur', 5, 'Donec tempor, est ac mattis semper, dui lectus rutrum urna,', '1936-10-03', 'L', 1, 1),
(1296, 7380, '917009342-000', 'Roanna', 6, 'ante. Vivamus non lorem vitae odio sagittis semper. Nam tempor', '1974-05-08', 'L', 1, 2),
(1297, 6316, '247613821-000', 'Urielle', 5, 'semper egestas, urna justo faucibus lectus, a sollicitudin orci sem', '1904-09-25', 'P', 1, 1),
(1298, 6952, '851715250-000', 'Giacomo', 7, 'lobortis quis, pede. Suspendisse dui. Fusce diam nunc, ullamcorper eu,', '1906-01-02', 'L', 2, 1),
(1299, 3872, '726286701-000', 'Libby', 6, 'faucibus. Morbi vehicula. Pellentesque tincidunt tempus risus. Donec egestas. Duis', '1979-05-20', 'P', 2, 1),
(1300, 5540, '490001757-000', 'Hammett', 6, 'vestibulum massa rutrum magna. Cras convallis convallis dolor. Quisque tincidunt', '1919-04-07', 'L', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblrotations`
--

CREATE TABLE `tblrotations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblrotations`
--

INSERT INTO `tblrotations` (`id`, `name`, `description`, `is_active`) VALUES
(1, 'R1', 'Rotasi 1', 1),
(2, 'Rotasi 2', 'Urutan ke 2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblrotation_menu`
--

CREATE TABLE `tblrotation_menu` (
  `id` int(11) NOT NULL,
  `id_rotation` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `parent_rotation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblrotation_menu`
--

INSERT INTO `tblrotation_menu` (`id`, `id_rotation`, `id_category`, `id_menu`, `parent_rotation_id`) VALUES
(1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblsuku`
--

CREATE TABLE `tblsuku` (
  `idsuku` int(11) NOT NULL,
  `suku` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsuku`
--

INSERT INTO `tblsuku` (`idsuku`, `suku`) VALUES
(1, 'Suku Jawa'),
(2, 'Suku Sunda');

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
  `group_id` int(1) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nik`, `username`, `password`, `group_id`, `is_active`) VALUES
(1, 1529, 'agus.firman', '21232f297a57a5a743894a0e4a801fc3', 1, 1),
(4, 0, 'ugd', 'e10adc3949ba59abbe56e057f20f883e', 3, 1),
(5, 0, 'obgyn', 'e10adc3949ba59abbe56e057f20f883e', 3, 1),
(6, 0, 'admin', '21232f297a57a5a743894a0e4a801fc3', 2, 1),
(18, 1233, 'dokter', '21232f297a57a5a743894a0e4a801fc3', 5, 1),
(19, 84312, 'yani', '202cb962ac59075b964b07152d234b70', 4, 1),
(20, 2342, 'user_acs', '202cb962ac59075b964b07152d234b70', 5, 1);

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
-- Indexes for table `administration`
--
ALTER TABLE `administration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_of_dutty`
--
ALTER TABLE `doctor_of_dutty`
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
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_access_permission`
--
ALTER TABLE `group_access_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `image_slide`
--
ALTER TABLE `image_slide`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plasma_id` (`plasma_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nurse`
--
ALTER TABLE `nurse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nurse_of_dutty`
--
ALTER TABLE `nurse_of_dutty`
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
-- Indexes for table `tblagama`
--
ALTER TABLE `tblagama`
  ADD PRIMARY KEY (`idagama`);

--
-- Indexes for table `tblclassroom`
--
ALTER TABLE `tblclassroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldetailrotations`
--
ALTER TABLE `tbldetailrotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblgroupmenus`
--
ALTER TABLE `tblgroupmenus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblkategorimenus`
--
ALTER TABLE `tblkategorimenus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmenus`
--
ALTER TABLE `tblmenus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblorders`
--
ALTER TABLE `tblorders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpasien`
--
ALTER TABLE `tblpasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblrotations`
--
ALTER TABLE `tblrotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblrotation_menu`
--
ALTER TABLE `tblrotation_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsuku`
--
ALTER TABLE `tblsuku`
  ADD PRIMARY KEY (`idsuku`);

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
  ADD KEY `group_id` (`group_id`);

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
-- AUTO_INCREMENT for table `administration`
--
ALTER TABLE `administration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `doctor_of_dutty`
--
ALTER TABLE `doctor_of_dutty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `group_access_permission`
--
ALTER TABLE `group_access_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `image_slide`
--
ALTER TABLE `image_slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `nurse`
--
ALTER TABLE `nurse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `nurse_of_dutty`
--
ALTER TABLE `nurse_of_dutty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nurse_spv`
--
ALTER TABLE `nurse_spv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pic_nurse`
--
ALTER TABLE `pic_nurse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `plasma`
--
ALTER TABLE `plasma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `specialist_doctor`
--
ALTER TABLE `specialist_doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tblagama`
--
ALTER TABLE `tblagama`
  MODIFY `idagama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblclassroom`
--
ALTER TABLE `tblclassroom`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbldetailrotations`
--
ALTER TABLE `tbldetailrotations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblgroupmenus`
--
ALTER TABLE `tblgroupmenus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblkategorimenus`
--
ALTER TABLE `tblkategorimenus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblmenus`
--
ALTER TABLE `tblmenus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblorders`
--
ALTER TABLE `tblorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblpasien`
--
ALTER TABLE `tblpasien`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1301;

--
-- AUTO_INCREMENT for table `tblrotations`
--
ALTER TABLE `tblrotations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblrotation_menu`
--
ALTER TABLE `tblrotation_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblsuku`
--
ALTER TABLE `tblsuku`
  MODIFY `idsuku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type_plasma`
--
ALTER TABLE `type_plasma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `visit_time`
--
ALTER TABLE `visit_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctor_of_dutty`
--
ALTER TABLE `doctor_of_dutty`
  ADD CONSTRAINT `doctor_of_dutty_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`),
  ADD CONSTRAINT `doctor_of_dutty_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`);

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
-- Constraints for table `group_access_permission`
--
ALTER TABLE `group_access_permission`
  ADD CONSTRAINT `group_access_permission_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  ADD CONSTRAINT `group_access_permission_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image_slide`
--
ALTER TABLE `image_slide`
  ADD CONSTRAINT `image_slide_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`);

--
-- Constraints for table `nurse_of_dutty`
--
ALTER TABLE `nurse_of_dutty`
  ADD CONSTRAINT `nurse_of_dutty_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
