-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2019 at 10:15 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblpasien`
--
ALTER TABLE `tblpasien`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblpasien`
--
ALTER TABLE `tblpasien`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1301;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
