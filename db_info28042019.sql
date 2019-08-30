-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Apr 2019 pada 19.48
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.0

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
-- Struktur dari tabel `doctor_of_duty`
--

CREATE TABLE `doctor_of_duty` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `doctor_of_duty`
--

INSERT INTO `doctor_of_duty` (`id`, `name`, `plasma_id`) VALUES
(1, '', 1),
(2, 'RICKY SUWANDI, dr. MM, MARS', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `image_slide`
--

CREATE TABLE `image_slide` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `image_slide`
--

INSERT INTO `image_slide` (`id`, `name`, `plasma_id`) VALUES
(1, '758c8763165df39d9193037a1b04e363.jpg', 2),
(2, '705df156c9aee78fb6f4dd9d8f72d65c.jpg', 1),
(3, '3f9bbbedbef54b4d198b392b60998e1c.jpg', 3);

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
(1, 'Sr. Sri Nova Sinaga', 2),
(2, 'Sr. Yulia Fitri', 1),
(3, 'Sr. Noviyanti', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pic_nurse`
--

CREATE TABLE `pic_nurse` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `plasma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pic_nurse`
--

INSERT INTO `pic_nurse` (`id`, `name`, `plasma_id`) VALUES
(1, 'Sr. Risna', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `plasma`
--

CREATE TABLE `plasma` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `title` varchar(225) NOT NULL,
  `url` varchar(50) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `plasma`
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
-- Struktur dari tabel `plasma_detail`
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
-- Dumping data untuk tabel `plasma_detail`
--

INSERT INTO `plasma_detail` (`id`, `plasma_id`, `dokter_jaga`, `karu`, `pj_shift`, `perawat`, `specialist_doctor`, `image_slide`) VALUES
(1, 2, '\"RUDY, dr\";\"RICKY SUWANDI, dr. MM, MARS\"', 'Sr Wiwin Winarsih', 'Sr Anggraini Titias. A', 'Sr Anggraini Titias. A', 0, ''),
(2, 1, '\"RUDY, dr\";\"RICKY SUWANDI, dr. MM, MARS\"', 'Sr. Yani', 'Sr. Evi', 'Sr. Evi', 0, '');

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
(1, 'Specialist Obgyn', 'dr.Ariani', 'dr.Syarif', 1),
(20, 'Spesialis Mata', 'test', 'test', 1),
(21, 'Spesialis Penyakit Dalam', 'test', 'test', 1),
(22, 'Spesialis Radiologi', 'test', 'test', 1),
(23, 'Spesialis Urologi', 'test', 'test', 1),
(24, 'Spesialis Saraf', 'test', 'test', 1),
(25, 'Spesialis Patologi Anatomi', 'test', 'test', 1);

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
(1, 'ugd'),
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
(4, 0, 'ugd', 'e10adc3949ba59abbe56e057f20f883e', 2),
(5, 0, 'obgyn', 'e10adc3949ba59abbe56e057f20f883e', 2),
(6, 0, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

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
(1, 'admin'),
(2, 'member');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `doctor_of_duty`
--
ALTER TABLE `doctor_of_duty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plasma_id` (`plasma_id`);

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
-- Indeks untuk tabel `plasma_detail`
--
ALTER TABLE `plasma_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plasma_id` (`plasma_id`);

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
-- AUTO_INCREMENT untuk tabel `doctor_of_duty`
--
ALTER TABLE `doctor_of_duty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `image_slide`
--
ALTER TABLE `image_slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `nurse`
--
ALTER TABLE `nurse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pic_nurse`
--
ALTER TABLE `pic_nurse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `plasma`
--
ALTER TABLE `plasma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `plasma_detail`
--
ALTER TABLE `plasma_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `specialist_doctor`
--
ALTER TABLE `specialist_doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `doctor_of_duty`
--
ALTER TABLE `doctor_of_duty`
  ADD CONSTRAINT `doctor_of_duty_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`);

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
-- Ketidakleluasaan untuk tabel `plasma`
--
ALTER TABLE `plasma`
  ADD CONSTRAINT `plasma_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type_plasma` (`id`);

--
-- Ketidakleluasaan untuk tabel `plasma_detail`
--
ALTER TABLE `plasma_detail`
  ADD CONSTRAINT `plasma_detail_ibfk_1` FOREIGN KEY (`plasma_id`) REFERENCES `plasma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
