-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Bulan Mei 2019 pada 12.43
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.2.7

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
-- Struktur dari tabel `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `is_doctor_specialist` int(11) NOT NULL DEFAULT '0',
  `is_doctor_of_duty` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `doctor`
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
-- Struktur dari tabel `doctor_of_duty`
--

CREATE TABLE `doctor_of_duty` (
  `id` int(11) NOT NULL,
  `doctor_id` int(1) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `doctor_of_duty`
--

INSERT INTO `doctor_of_duty` (`id`, `doctor_id`, `plasma_id`) VALUES
(4, 2, 1),
(5, 3, 1),
(6, 9, 1),
(7, 10, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `doctor_room`
--

CREATE TABLE `doctor_room` (
  `id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `description` varchar(225) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `doctor_room`
--

INSERT INTO `doctor_room` (`id`, `room_number`, `description`, `plasma_id`) VALUES
(1, 159, 'test aja', 7),
(4, 153, '', 7),
(5, 155, '', 7),
(6, 156, '', 7),
(7, 158, '', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `doctor_schedule`
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
-- Dumping data untuk tabel `doctor_schedule`
--

INSERT INTO `doctor_schedule` (`id`, `doctor_id`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `room_id`) VALUES
(3, 23, '08.00 - 13.00', '-', '-', '-', '-', '-', '-', 4),
(4, 24, '10.00 - 13.00', '-', '-', '-', '10.00 - 13.00', '-', '-', 5),
(5, 25, '10.00 - 16.00', '-', '-', '-', '-', '-', '-', 6),
(6, 26, '09.00 - 14.00', '-', '-', '-', '-', '-', '-', 7),
(7, 27, '14.00 - 16.00', '-', '-', '-', '-', '-', '-', 7),
(8, 28, '09.00 - 14.00', '-', '-', '-', '-', '-', '-', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `image_slide`
--

CREATE TABLE `image_slide` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `description` varchar(255) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `image_slide`
--

INSERT INTO `image_slide` (`id`, `name`, `description`, `plasma_id`) VALUES
(1, '758c8763165df39d9193037a1b04e363.jpg', '', 2),
(2, '705df156c9aee78fb6f4dd9d8f72d65c.jpg', '', 1),
(3, '3f9bbbedbef54b4d198b392b60998e1c.jpg', '', 3),
(4, '04cb57a0eb6e6f83725ab7507661b667.jpg', '', 1),
(5, '0f7bacecfdc5425cec366112bd12ac89.jpg', '', 1),
(6, '037934b0a629db9a790e2064641abc48.png', '', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nurse`
--

CREATE TABLE `nurse` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nurse`
--

INSERT INTO `nurse` (`id`, `name`, `plasma_id`) VALUES
(1, 'Sr. Sri Nova Sinaga', 1),
(2, 'Sr. Yulia Fitri', 1),
(3, 'Sr. Noviyanti', 1),
(5, 'Sr. Risna', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nurse_of_duty`
--

CREATE TABLE `nurse_of_duty` (
  `id` int(11) NOT NULL,
  `plasma_id` int(11) NOT NULL,
  `nurse_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nurse_of_duty`
--

INSERT INTO `nurse_of_duty` (`id`, `plasma_id`, `nurse_id`) VALUES
(1, 2, 2),
(2, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pic_nurse`
--

CREATE TABLE `pic_nurse` (
  `id` int(11) NOT NULL,
  `nurse_id` int(11) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pic_nurse`
--

INSERT INTO `pic_nurse` (`id`, `nurse_id`, `plasma_id`) VALUES
(1, 1, 1),
(2, 5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `plasma`
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
-- Dumping data untuk tabel `plasma`
--

INSERT INTO `plasma` (`id`, `name`, `title`, `url`, `is_doctor_of_duty`, `is_specialist_doctor`, `is_nurse`, `is_pic_nurse`, `is_image_slide`, `is_active`, `type_id`) VALUES
(1, 'IGD', 'INSTALASI GAWAT DARURAT (IGD) 24 JAM', 'igd', 1, 0, 0, 0, 1, 1, 1),
(2, 'Lantai 6-A', 'Informasi Rawat Inap LT. 6 Wing A', 'enama', 1, 0, 0, 0, 0, 1, 3),
(3, 'Lantai 6-B', 'Informasi Rawat Inap LT. 6 Wing B', 'enamb', 1, 0, 0, 0, 0, 1, 3),
(4, 'Lantai 7-A', '', '', 1, 0, 0, 0, 0, 1, 3),
(5, 'Lantai 7-B', '', '', 0, 0, 0, 0, 0, 1, 3),
(6, 'Lantai 8-A', 'Informasi Rawat Inap LT. 8 Wing A', 'delapana', 0, 0, 0, 0, 0, 1, 3),
(7, 'Obgyn', 'Poliklinik Obgyn', 'obgyn', 1, 0, 0, 0, 1, 1, 2),
(8, 'Klinik Anak', 'Informasi Dokter Praktek Klinik Anak', 'anak', 0, 0, 0, 0, 0, 0, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `specialist_doctor`
--

CREATE TABLE `specialist_doctor` (
  `id` int(11) NOT NULL,
  `specialist_name` varchar(225) NOT NULL,
  `doctor_oc_1` varchar(225) NOT NULL,
  `doctor_oc_2` varchar(225) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `specialist_doctor`
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
-- Struktur dari tabel `type_plasma`
--

CREATE TABLE `type_plasma` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `type_plasma`
--

INSERT INTO `type_plasma` (`id`, `name`) VALUES
(1, 'igd'),
(2, 'rajal'),
(3, 'ranap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nik` int(5) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `role_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nik`, `username`, `password`, `role_id`) VALUES
(1, 1529, 'agus.firman', '21232f297a57a5a743894a0e4a801fc3', 1),
(4, 0, 'ugd', 'e10adc3949ba59abbe56e057f20f883e', 3),
(5, 0, 'obgyn', 'e10adc3949ba59abbe56e057f20f883e', 3),
(6, 0, 'admin', '21232f297a57a5a743894a0e4a801fc3', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `name`) VALUES
(1, 'superadmin'),
(2, 'admin'),
(3, 'member');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `doctor_of_duty`
--
ALTER TABLE `doctor_of_duty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plasma_id` (`plasma_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indeks untuk tabel `doctor_room`
--
ALTER TABLE `doctor_room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plasma_id` (`plasma_id`);

--
-- Indeks untuk tabel `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indeks untuk tabel `image_slide`
--
ALTER TABLE `image_slide`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plasma_id` (`plasma_id`);

--
-- Indeks untuk tabel `nurse`
--
ALTER TABLE `nurse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plasma_id` (`plasma_id`);

--
-- Indeks untuk tabel `nurse_of_duty`
--
ALTER TABLE `nurse_of_duty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plasma_id` (`plasma_id`);

--
-- Indeks untuk tabel `pic_nurse`
--
ALTER TABLE `pic_nurse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plasma_id` (`plasma_id`);

--
-- Indeks untuk tabel `plasma`
--
ALTER TABLE `plasma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indeks untuk tabel `specialist_doctor`
--
ALTER TABLE `specialist_doctor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `specialist_name` (`specialist_name`),
  ADD KEY `plasma_id` (`plasma_id`);

--
-- Indeks untuk tabel `type_plasma`
--
ALTER TABLE `type_plasma`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role` (`role_id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `doctor_of_duty`
--
ALTER TABLE `doctor_of_duty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `doctor_room`
--
ALTER TABLE `doctor_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `image_slide`
--
ALTER TABLE `image_slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `nurse`
--
ALTER TABLE `nurse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `nurse_of_duty`
--
ALTER TABLE `nurse_of_duty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pic_nurse`
--
ALTER TABLE `pic_nurse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `plasma`
--
ALTER TABLE `plasma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `specialist_doctor`
--
ALTER TABLE `specialist_doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `type_plasma`
--
ALTER TABLE `type_plasma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `doctor_of_duty`
--
ALTER TABLE `doctor_of_duty`
  ADD CONSTRAINT `doctor_of_duty_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`),
  ADD CONSTRAINT `doctor_of_duty_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`);

--
-- Ketidakleluasaan untuk tabel `doctor_room`
--
ALTER TABLE `doctor_room`
  ADD CONSTRAINT `doctor_room_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`);

--
-- Ketidakleluasaan untuk tabel `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  ADD CONSTRAINT `doctor_schedule_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `doctor_room` (`id`),
  ADD CONSTRAINT `doctor_schedule_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`);

--
-- Ketidakleluasaan untuk tabel `image_slide`
--
ALTER TABLE `image_slide`
  ADD CONSTRAINT `image_slide_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`);

--
-- Ketidakleluasaan untuk tabel `nurse`
--
ALTER TABLE `nurse`
  ADD CONSTRAINT `nurse_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`);

--
-- Ketidakleluasaan untuk tabel `nurse_of_duty`
--
ALTER TABLE `nurse_of_duty`
  ADD CONSTRAINT `nurse_of_duty_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pic_nurse`
--
ALTER TABLE `pic_nurse`
  ADD CONSTRAINT `pic_nurse_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`);

--
-- Ketidakleluasaan untuk tabel `plasma`
--
ALTER TABLE `plasma`
  ADD CONSTRAINT `plasma_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type_plasma` (`id`);

--
-- Ketidakleluasaan untuk tabel `specialist_doctor`
--
ALTER TABLE `specialist_doctor`
  ADD CONSTRAINT `specialist_doctor_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
