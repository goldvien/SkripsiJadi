-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 14, 2013 at 12:40 
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_indekos`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(3) NOT NULL AUTO_INCREMENT,
  `admin_email` varchar(35) NOT NULL,
  `admin_password` varchar(45) NOT NULL,
  `admin_status` varchar(10) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_email` (`admin_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`, `admin_status`) VALUES
(1, 'mfuadadib@yahoo.com', '0cc175b9c0f1b6a831c399e269772661', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_eks`
--

CREATE TABLE IF NOT EXISTS `fasilitas_eks` (
  `fasilitas_eks_id` int(5) NOT NULL AUTO_INCREMENT,
  `fasilitas_master_id` int(5) NOT NULL,
  `kab_kota_id` int(5) NOT NULL,
  `fasilitas_eks_nama` varchar(50) NOT NULL,
  `fasilitas_eks_long` varchar(50) NOT NULL DEFAULT '0',
  `fasilitas_eks_lat` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fasilitas_eks_id`),
  KEY `fasilitas_id` (`fasilitas_master_id`),
  KEY `kab_kota_id` (`kab_kota_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `fasilitas_eks`
--

INSERT INTO `fasilitas_eks` (`fasilitas_eks_id`, `fasilitas_master_id`, `kab_kota_id`, `fasilitas_eks_nama`, `fasilitas_eks_long`, `fasilitas_eks_lat`) VALUES
(3, 2, 203, 'SD Sapen', '878798798', '86767567'),
(4, 3, 203, 'Amplaz Carefour', '867876', '7868768'),
(5, 2, 203, 'SMK Negeri 7 Yogyakarta', '0', '0'),
(7, 3, 203, 'Taman siswa (Tamsis)', '0', '0'),
(8, 2, 203, 'Taman siswa (Tamsis)', '0', '0'),
(9, 1, 203, 'UIN Sunan Kalijaga Yogyakarta', '110.3941547870636', '-7.784589326268566'),
(10, 1, 203, 'Universitas Negeri Yogyakarta', '110.38425207138062', '-7.775925817397966'),
(11, 1, 203, 'Universitas Sanata Darma', '110.3901743888855', '-7.774777756169111'),
(12, 1, 203, 'Universitas Kristen Duta Wacana', '110.37925243377686', '-7.786088148287727');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_int`
--

CREATE TABLE IF NOT EXISTS `fasilitas_int` (
  `fasilitas_int_id` int(5) NOT NULL AUTO_INCREMENT,
  `pemilik_id` int(5) NOT NULL,
  `fasilitas_int_nama` varchar(50) NOT NULL,
  PRIMARY KEY (`fasilitas_int_id`),
  KEY `pemilik_id` (`pemilik_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `fasilitas_int`
--

INSERT INTO `fasilitas_int` (`fasilitas_int_id`, `pemilik_id`, `fasilitas_int_nama`) VALUES
(1, 8, 'Kamar Mandi Dalam'),
(2, 8, 'Lemari Baju'),
(3, 8, 'Biaya Listrik');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_master`
--

CREATE TABLE IF NOT EXISTS `fasilitas_master` (
  `fasilitas_master_id` int(5) NOT NULL AUTO_INCREMENT,
  `fasilitas_master_nama` varchar(20) NOT NULL,
  `fasilitas_master_icon` varchar(30) NOT NULL,
  PRIMARY KEY (`fasilitas_master_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `fasilitas_master`
--

INSERT INTO `fasilitas_master` (`fasilitas_master_id`, `fasilitas_master_nama`, `fasilitas_master_icon`) VALUES
(1, 'KAMPUS', 'KAMPUS.jpg'),
(2, 'SEKOLAH', 'SEKOLAH.jpg'),
(3, 'SPBU', 'SPBU.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `indekos`
--

CREATE TABLE IF NOT EXISTS `indekos` (
  `indekos_id` int(5) NOT NULL AUTO_INCREMENT,
  `pemilik_id` int(5) NOT NULL,
  `kab_kota_id` int(3) NOT NULL,
  `indekos_nama` varchar(30) NOT NULL,
  `indekos_untuk` varchar(10) NOT NULL,
  `indekos_keterangan` text NOT NULL,
  `indekos_long` varchar(50) NOT NULL,
  `indekos_lat` varchar(50) NOT NULL,
  PRIMARY KEY (`indekos_id`),
  KEY `pemilik_id` (`pemilik_id`),
  KEY `kab_kota_id` (`kab_kota_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `indekos`
--

INSERT INTO `indekos` (`indekos_id`, `pemilik_id`, `kab_kota_id`, `indekos_nama`, `indekos_untuk`, `indekos_keterangan`, `indekos_long`, `indekos_lat`) VALUES
(1, 1, 246, 'MOBILE INDEKOS', 'LAKI', 'KET', '106.34147644042969', '-6.18083290197768'),
(2, 1, 246, 'MAWAR PUTRI', 'PEREMPUAN', 'KET', '2.34545656', '4.45656768'),
(29, 1, 246, 'KOST PUTRI', 'PEREMPUAN', 'JAM TAMU 08-21', '106.63189', '-6.17831'),
(31, 4, 135, 'INDEKOS', 'LAKI', 'KETERANGAN', '0.000000000', '0.000000000'),
(33, 1, 246, 'RUMAH INDAH TANGERAN', 'PEREMPUAN', 'PERATURAN : asdfkajsfd \r\nasdfaslfdj\r\nsadfljasdf\r\nasdfgs ;klsd', '106.63189', '-6.17831'),
(34, 3, 244, 'PUTRA INDEKOS', 'PEREMPUAN', 'KETERANGAN', '0.000000000', '0.000000000'),
(35, 8, 203, 'Wong Lanang', 'LAKI', 'A', '-7.78278', '+110.36083'),
(36, 7, 3, 'PUTRA INDEKOS', 'LAKI', 'asdfsf', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `indekos_fasilitas_eks`
--

CREATE TABLE IF NOT EXISTS `indekos_fasilitas_eks` (
  `indekos_fasilitas_eks_id` int(5) NOT NULL AUTO_INCREMENT,
  `indekos_id` int(5) NOT NULL,
  `fasilitas_eks_id` int(5) NOT NULL,
  PRIMARY KEY (`indekos_fasilitas_eks_id`),
  UNIQUE KEY `indekos_id_2` (`indekos_id`,`fasilitas_eks_id`),
  KEY `indekos_id` (`indekos_id`),
  KEY `fasilitas_eks_id` (`fasilitas_eks_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `indekos_fasilitas_eks`
--

INSERT INTO `indekos_fasilitas_eks` (`indekos_fasilitas_eks_id`, `indekos_id`, `fasilitas_eks_id`) VALUES
(1, 35, 3),
(6, 35, 9);

-- --------------------------------------------------------

--
-- Table structure for table `kab_kota`
--

CREATE TABLE IF NOT EXISTS `kab_kota` (
  `kab_kota_id` int(3) NOT NULL AUTO_INCREMENT,
  `provinsi_id` int(3) NOT NULL,
  `kab_kota_kode` int(11) NOT NULL,
  `kab_kota_nama` varchar(50) NOT NULL,
  `kab_kota_long` varchar(30) NOT NULL DEFAULT '0',
  `kab_kota_lat` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kab_kota_id`),
  KEY `id_provinsi` (`provinsi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=441 ;

--
-- Dumping data for table `kab_kota`
--

INSERT INTO `kab_kota` (`kab_kota_id`, `provinsi_id`, `kab_kota_kode`, `kab_kota_nama`, `kab_kota_long`, `kab_kota_lat`) VALUES
(3, 1, 1103, 'KAB. ACEH TIMUR\n', '0', '0'),
(4, 1, 1104, 'KAB. TENGAH', '0', '0'),
(5, 1, 1105, 'KAB. ACEH BARAT\n', '0', '0'),
(6, 1, 1106, 'KAB. ACEH BESAR\n', '0', '0'),
(7, 1, 1107, 'KAB. PIDIE\n', '0', '0'),
(8, 1, 1108, 'KAB. ACEH UTARA\n', '0', '0'),
(9, 1, 1109, 'KAB. SIMEULUE\n', '0', '0'),
(10, 1, 1110, 'KAB. ACEH SINGKIL\n', '0', '0'),
(11, 1, 1111, 'KAB. BIREUN\n', '0', '0'),
(12, 1, 1112, 'KAB. ACEH BARAT DAYA\n', '0', '0'),
(13, 1, 1113, 'KAB. GAYO LUES\n', '0', '0'),
(14, 1, 1114, 'KAB. ACEH JAYA\n', '0', '0'),
(15, 1, 1115, 'KAB. NAGAN JAYA\n', '0', '0'),
(16, 1, 1116, 'KAB. ACEH TAMIANG\n', '0', '0'),
(17, 1, 1117, 'KAB. BENER MERIAH', '0', '0'),
(18, 1, 1171, 'KOTA BANDA ACEH\n', '0', '0'),
(19, 1, 1172, 'KOTA SABANG\n', '0', '0'),
(20, 1, 1173, 'KOTA LHOKSEUMAWE\n', '0', '0'),
(21, 1, 1174, 'KOTA LANGSA\n', '0', '0'),
(22, 2, 1201, 'KAB. TAPANULI TENGAH\n', '0', '0'),
(23, 2, 1202, 'KAB. TAPANULI UTARA\n', '0', '0'),
(24, 2, 1203, 'KAB. TAPANULI SELATAN\n', '0', '0'),
(25, 2, 1204, 'KAB. NIAS\n', '0', '0'),
(26, 2, 1205, 'KAB. LANGKAT\n', '0', '0'),
(27, 2, 1206, 'KAB. KARO\n', '0', '0'),
(28, 2, 1207, 'KAB. DELI SERDANG\n', '0', '0'),
(29, 2, 1208, 'KAB. SIMALUNGUN\n', '0', '0'),
(30, 2, 1209, 'KAB. ASAHAN\n', '0', '0'),
(31, 2, 1210, 'KAB. LABUHAN BATU\n', '0', '0'),
(32, 2, 1211, 'KAB. DAIRI\n', '0', '0'),
(33, 2, 1212, 'KAB. TOBA SAMOSIR\n', '0', '0'),
(34, 2, 1213, 'KAB. MANDAILING NATAL\n', '0', '0'),
(35, 2, 1214, 'KAB. NIAS SELATAN\n', '0', '0'),
(36, 2, 1215, 'KAB. PAKPAK BARAT\n', '0', '0'),
(37, 2, 1216, 'KAB. HUMBANG HASUNDUTAN\n', '0', '0'),
(38, 2, 1217, 'KAB. SAMOSIR', '0', '0'),
(39, 2, 1218, 'KAB. SERDANG BEDAGAI', '0', '0'),
(40, 2, 1271, 'KOTA MEDAN\n', '0', '0'),
(41, 2, 1272, 'KOTA PEMATANG SIANTAR\n', '0', '0'),
(42, 2, 1273, 'KOTA SIBOLGA\n', '0', '0'),
(43, 2, 1274, 'KOTA TANJUNG BALAI\n', '0', '0'),
(44, 2, 1275, 'KOTA BINJAI\n', '0', '0'),
(45, 2, 1276, 'KOTA TEBING TINGGI\n', '0', '0'),
(46, 2, 1277, 'KOTA PADANG SIDEMPUAN\n', '0', '0'),
(47, 3, 1301, 'KAB.PESISIR SELATAN\n', '0', '0'),
(48, 3, 1302, 'KAB. SOLOK', '0', '0'),
(49, 3, 1303, 'KAB. SW.LUNTO\n', '0', '0'),
(50, 3, 1304, 'KAB. TANAH DATAR\n', '0', '0'),
(51, 3, 1305, 'KAB. PADANG PARIAMAN\n', '0', '0'),
(52, 3, 1306, 'KAB. AGAM\n', '0', '0'),
(53, 3, 1307, 'KAB. LIMA PULUH KOTA\n', '0', '0'),
(54, 3, 1308, 'KAB. PASAMAN', '0', '0'),
(55, 3, 1309, 'KAB. KEPULAUAN MENTAWAI\n', '0', '0'),
(56, 3, 1310, 'KAB. DHARMASRAYA', '0', '0'),
(57, 3, 1311, 'KAB. SOLOK SELATAN', '0', '0'),
(58, 3, 1312, 'KAB. PASAMAN BARAT', '0', '0'),
(59, 3, 1371, 'KOTA PADANG\n', '0', '0'),
(60, 3, 1372, 'KOTA SOLOK\n', '0', '0'),
(61, 3, 1373, 'KOTA SAWHLUNTO\n', '0', '0'),
(62, 3, 1374, 'KOTA PADANG PANJANG\n', '0', '0'),
(63, 3, 1375, 'KOTA BUKITTINGGI\n', '0', '0'),
(64, 3, 1376, 'KOTA PAYAKUMBUH\n', '0', '0'),
(65, 3, 1377, 'KOTA PARIAMAN\n', '0', '0'),
(66, 4, 1401, 'KAB. KAMPAR\n', '0', '0'),
(67, 4, 1402, 'KAB. INDRAGIRI HULU\n', '0', '0'),
(68, 4, 1403, 'KAB. BENGKALIS\n', '0', '0'),
(69, 4, 1404, 'KAB. INDRAGIRI HILIR\n', '0', '0'),
(70, 4, 1405, 'KAB. PELALAWAN\n', '0', '0'),
(71, 4, 1406, 'KAB. ROKAN HULU\n', '0', '0'),
(72, 4, 1407, 'KAB. ROKAN HILIR\n', '0', '0'),
(73, 4, 1408, 'KAB. SIAK\n', '0', '0'),
(74, 4, 1409, 'KAB. KUANTAN SINGINGI\n', '0', '0'),
(75, 4, 1471, 'KOTA PEKAN BARU\n', '0', '0'),
(76, 4, 1472, 'KOTA DUMAI\n', '0', '0'),
(77, 5, 1501, 'KAB. KERINCI\n', '0', '0'),
(78, 5, 1502, 'KAB. MEANGIN\n', '0', '0'),
(79, 5, 1503, 'KAB. SAROLANGUN\n', '0', '0'),
(80, 5, 1504, 'KAB. BATANGHARI\n', '0', '0'),
(81, 5, 1505, 'KAB. MUARO JAMBI\n', '0', '0'),
(82, 5, 1506, 'KAB. TANJUNG JABUNG BARAT\n', '0', '0'),
(83, 5, 1507, 'KAB. TANJUNG JABUNG TIMUR\n', '0', '0'),
(84, 5, 1508, 'KAB. BUNGO\n', '0', '0'),
(85, 5, 1509, 'KAB. TEBO\n', '0', '0'),
(86, 5, 1571, 'KOTA JAMBI\n', '0', '0'),
(87, 6, 1601, 'KAB. OGAN KOMERING ULU', '0', '0'),
(88, 6, 1602, 'KAB. OGAN KOMERING ILIR', '0', '0'),
(89, 6, 1603, 'KAB. MUARA ENIM\n', '0', '0'),
(90, 6, 1604, 'KAB. LAHAT\n', '0', '0'),
(91, 6, 1605, 'KAB. MUSI RAWAS\n', '0', '0'),
(92, 6, 1606, 'KAB. MUSI BANYUASIN\n', '0', '0'),
(93, 6, 1607, 'KAB. BANYUASIN\n', '0', '0'),
(94, 6, 1608, 'KAB. OKU TIMUR', '0', '0'),
(95, 6, 1609, 'KAB. OKU SELATAN', '0', '0'),
(96, 6, 1610, 'KAB. OGAN ILIR', '0', '0'),
(97, 6, 1671, 'KOTA PALEMBANG\n', '0', '0'),
(98, 6, 1672, 'KOTA PAGAR ALAM\n', '0', '0'),
(99, 6, 1673, 'KOTA LUBUK LINGGAU\n', '0', '0'),
(100, 6, 1674, 'KOTA PRABUMULIH\n', '0', '0'),
(101, 7, 1701, 'KAB. BENGKULU SELATAN\n', '0', '0'),
(102, 7, 1702, 'KAB. REJANG LEBONG', '0', '0'),
(103, 7, 1703, 'KAB. BENGKULU UTARA\n', '0', '0'),
(104, 7, 1704, 'KAB. KAUR\n', '0', '0'),
(105, 7, 1705, 'KAB. SELUMA\n', '0', '0'),
(106, 7, 1706, 'KAB. MUKO MUKO\n', '0', '0'),
(107, 7, 1707, 'KAB. LEBONG', '0', '0'),
(108, 7, 1708, 'KAB. KEPAHIANG', '0', '0'),
(109, 7, 1771, 'KOTA BENGKULU\n', '0', '0'),
(110, 8, 1801, 'KAB. LAMPUNG SELATAN\n', '0', '0'),
(111, 8, 1802, 'KAB. LAMPUNG TENGAH\n', '0', '0'),
(112, 8, 1803, 'KAB. LAMPUNG UTARA\n', '0', '0'),
(113, 8, 1804, 'KAB. LAMPUNG BARAT\n', '0', '0'),
(114, 8, 1805, 'KAB. TULANG BAWANG\n', '0', '0'),
(115, 8, 1806, 'KAB. TANGGAMUS\n', '0', '0'),
(116, 8, 1807, 'KAB. LAMPUNG TIMUR\n', '0', '0'),
(117, 8, 1808, 'KAB. WAY KANAN\n', '0', '0'),
(118, 8, 1871, 'KOTA BANDAR LAMPUNG\n', '0', '0'),
(119, 8, 1872, 'KOTA METRO\n', '0', '0'),
(120, 9, 1901, 'KAB. BANGKA\n', '0', '0'),
(121, 9, 1902, 'KAB. BELITUNG\n', '0', '0'),
(122, 9, 1903, 'KAB. BANGKA SELATAN\n', '0', '0'),
(123, 9, 1904, 'KAB. BANGKA TENGAH\n', '0', '0'),
(124, 9, 1905, 'KAB. BANGKA BARAT\n', '0', '0'),
(125, 9, 1906, 'KAB. BANGKA TIMUR\n', '0', '0'),
(126, 9, 1971, 'KOTA PANGKAL PINANG\n', '0', '0'),
(127, 10, 2101, 'KAB. KEPULAUAN RIAU', '0', '0'),
(128, 10, 2102, 'KAB. KARIMUN\n', '0', '0'),
(129, 10, 2103, 'KAB. NATUNA\n', '0', '0'),
(130, 10, 2104, 'KAB. LINGGA', '0', '0'),
(131, 10, 2105, 'KOTA BATAM\n', '0', '0'),
(132, 10, 2106, 'KOTA TANJUNG PINANG\n', '0', '0'),
(133, 11, 3101, 'KAB.ADM.KEP.SERIBU\r\n', '0', '0'),
(134, 11, 3171, 'KODYA JAKARTA PUSAT\r\n', '0', '0'),
(135, 11, 3172, 'KODYA JAKARTA UTARA', '0', '0'),
(136, 11, 3173, 'KODYA JAKARTA BARAT', '0', '0'),
(137, 11, 3174, 'KODYA JAKARTA SELATAN', '0', '0'),
(138, 11, 3175, 'KODYA JAKARTA TIMUR', '0', '0'),
(139, 12, 3201, 'KAB. BOGOR\n', '0', '0'),
(140, 12, 3202, 'KAB. SUKABUMI\n', '0', '0'),
(141, 12, 3203, 'KAB. CIANJUR\n', '0', '0'),
(142, 12, 3204, 'KAB. BANDUNG\n', '0', '0'),
(143, 12, 3205, 'KAB. GARUT\n', '0', '0'),
(144, 12, 3206, 'KAB. TASIKMALAYA\n', '0', '0'),
(145, 12, 3207, 'KAB. CIAMIS\n', '0', '0'),
(146, 12, 3208, 'KAB. KUNINGAN\n', '0', '0'),
(147, 12, 3209, 'KAB. CIREBON\n', '0', '0'),
(148, 12, 3210, 'KAB. MAJALENGKA\n', '0', '0'),
(149, 12, 3211, 'KAB. SUMEDANG\n', '0', '0'),
(150, 12, 3212, 'KAB. INDRAMAYU\n', '0', '0'),
(151, 12, 3213, 'KAB. SUBANG\n', '0', '0'),
(152, 12, 3214, 'KAB. PURWAKARTA\n', '0', '0'),
(153, 12, 3215, 'KAB. KARAWANG\n', '0', '0'),
(154, 12, 3216, 'KAB. BEKASI\n', '0', '0'),
(155, 12, 3271, 'KOTA BOGOR\n', '0', '0'),
(156, 12, 3272, 'KOTA SUKABUMI\n', '0', '0'),
(157, 12, 3273, 'KOTA BANDUNG\n', '0', '0'),
(158, 12, 3274, 'KOTA CIREBON\n', '0', '0'),
(159, 12, 3275, 'KOTA BEKASI\n', '0', '0'),
(160, 12, 3276, 'KOTA DEPOK\n', '0', '0'),
(161, 12, 3277, 'KOTA CIMAHI\n', '0', '0'),
(162, 12, 3278, 'KOTA TASIKMALAYA\n', '0', '0'),
(163, 12, 3279, 'KOTA BANJAR\n', '0', '0'),
(164, 13, 3301, 'KAB. CILACAP\n', '0', '0'),
(165, 13, 3302, 'KAB. BANYUMAS\n', '0', '0'),
(166, 13, 3303, 'KAB. PURBALINGGA\n', '0', '0'),
(167, 13, 3304, 'KAB. BANJARNEGARA\n', '0', '0'),
(168, 13, 3305, 'KAB. KEBUMEN\n', '0', '0'),
(169, 13, 3306, 'KAB. PURWOREJO\n', '0', '0'),
(170, 13, 3307, 'KAB. WONOSOBO\n', '0', '0'),
(171, 13, 3308, 'KAB. MAGELANG\n', '0', '0'),
(172, 13, 3309, 'KAB. BOYOLALI\n', '0', '0'),
(173, 13, 3310, 'KAB. KLATEN\n', '0', '0'),
(174, 13, 3311, 'KAB. SUKOHARJO\n', '0', '0'),
(175, 13, 3312, 'KAB. WONOGIRI\n', '0', '0'),
(176, 13, 3313, 'KAB. KARANGANYAR\n', '0', '0'),
(177, 13, 3314, 'KAB. SRAGEN\n', '0', '0'),
(178, 13, 3315, 'KAB. GROBOGAN\n', '0', '0'),
(179, 13, 3316, 'KAB. BLORA\n', '0', '0'),
(180, 13, 3317, 'KAB. REMBANG\n', '0', '0'),
(181, 13, 3318, 'KAB. PATI\n', '0', '0'),
(182, 13, 3321, 'KAB. KUDUS\n', '0', '0'),
(183, 13, 3320, 'KAB. JEPARA\n', '0', '0'),
(184, 13, 3321, 'KAB. DEMAK\n', '0', '0'),
(185, 13, 3322, 'KAB. SEMARANG\n', '0', '0'),
(186, 13, 3323, 'KAB. TEMANGGUNG\n', '0', '0'),
(187, 13, 3324, 'KAB. KENDAL\n', '0', '0'),
(188, 13, 3325, 'KAB. BATANG\n', '0', '0'),
(189, 13, 3326, 'KAB. PEKALONGAN\n', '0', '0'),
(190, 13, 3327, 'KAB. PEMALANG\n', '0', '0'),
(191, 13, 3328, 'KAB. TEGAL\n', '0', '0'),
(192, 13, 3329, 'KAB. BREBES\n', '0', '0'),
(193, 13, 3371, 'KOTA MAGELANG\n', '0', '0'),
(194, 13, 3372, 'KOTA SURAKARTA\n', '0', '0'),
(195, 13, 3373, 'KOTA SALATIGA\n', '0', '0'),
(196, 13, 3374, 'KOTA SEMARANG\n', '0', '0'),
(197, 13, 3375, 'KOTA PEKALONGAN\n', '0', '0'),
(198, 13, 3376, 'KOTA TEGAL\n', '0', '0'),
(199, 14, 3401, 'KAB. KULON PROGO', '-136.40625', '-89.99961952262892'),
(200, 14, 3402, 'KAB. BANTUL\n', '0', '0'),
(201, 14, 3403, 'KAB. GUNUNG KIDUL\n', '0', '0'),
(202, 14, 3404, 'KAB. SLEMAN\n', '0', '0'),
(203, 14, 3471, 'KOTA YOGYAKARTA\n', '-7.78278', '+110.36083'),
(204, 15, 3501, 'KAB. PACITAN\n', '0', '0'),
(205, 15, 3502, 'KAB. PONOROGO\n', '0', '0'),
(206, 15, 3503, 'KAB. TRENGGALEK\n', '0', '0'),
(207, 15, 3504, 'KAB. TULUNGAGUNG\n', '0', '0'),
(208, 15, 3505, 'KAB. BLITAR\n', '0', '0'),
(209, 15, 3506, 'KAB. KEDIRI\n', '0', '0'),
(210, 15, 3507, 'KAB. MALANG\n', '0', '0'),
(211, 15, 3508, 'KAB. LUMAJANG\n', '0', '0'),
(212, 15, 3509, 'KAB. JEMBER\n', '0', '0'),
(213, 15, 3510, 'KAB. BANYUWANGI\n', '0', '0'),
(214, 15, 3511, 'KAB. BONDOWOSO\n', '0', '0'),
(215, 15, 3512, 'KAB. SITUBONDO\n', '0', '0'),
(216, 15, 3513, 'KAB. PROBOLINGGO\n', '0', '0'),
(217, 15, 3514, 'KAB. PASURUAN\n', '0', '0'),
(218, 15, 3515, 'KAB. SIDOARJO\n', '0', '0'),
(219, 15, 3516, 'KAB. MOJOKERTO\n', '0', '0'),
(220, 15, 3517, 'KAB. JOMBANG\n', '0', '0'),
(221, 15, 3518, 'KAB. NGANJUK\n', '0', '0'),
(222, 15, 3521, 'KAB. MADIUN\n', '0', '0'),
(223, 15, 3520, 'KAB. MAGETAN\n', '0', '0'),
(224, 15, 3521, 'KAB. NGAWI\n', '0', '0'),
(225, 15, 3522, 'KAB. BOJONEGORO\n', '0', '0'),
(226, 15, 3523, 'KAB. TUBAN\n', '0', '0'),
(227, 15, 3524, 'KAB. LAMONGAN\n', '0', '0'),
(228, 15, 3525, 'KAB. GRESIK\n', '0', '0'),
(229, 15, 3526, 'KAB. BANGKALAN\n', '0', '0'),
(230, 15, 3527, 'KAB. SAMPANG\n', '0', '0'),
(231, 15, 3528, 'KAB. PAMEKASAN\n', '0', '0'),
(232, 15, 3529, 'KAB. SUMENEP\n', '0', '0'),
(233, 15, 3571, 'KOTA KEDIRI\n', '0', '0'),
(234, 15, 3572, 'KOTA BLITAR\n', '0', '0'),
(235, 15, 3573, 'KOTA MALANG\n', '0', '0'),
(236, 15, 3574, 'KOTA PROBOLINGGO\n', '0', '0'),
(237, 15, 3575, 'KOTA PASURUAN\n', '0', '0'),
(238, 15, 3576, 'KOTA MOJOKERTO\n', '0', '0'),
(239, 15, 3577, 'KOTA MADIUN\n', '0', '0'),
(240, 15, 3578, 'KOTA SURABAYA\n', '0', '0'),
(241, 15, 3579, 'BATU\n', '0', '0'),
(242, 16, 3601, 'KAB. PANDEGLANG\n', '0', '0'),
(243, 16, 3602, 'KAB. LEBAK\n', '0', '0'),
(244, 16, 3603, 'KAB. TANGERANG\n', '0', '0'),
(245, 16, 3604, 'KAB. SERANG\n', '0', '0'),
(246, 16, 3671, 'KOTA TANGERANG\n', '106.63189', '-6.17831'),
(247, 16, 3672, 'KOTA CILEGON\n', '0', '0'),
(248, 17, 5101, 'KAB. JEMBARANA\n', '0', '0'),
(249, 17, 5102, 'KAB. TABANAN\n', '0', '0'),
(250, 17, 5103, 'KAB. BADUNG\n', '0', '0'),
(251, 17, 5104, 'KAB. GIANYAR\n', '0', '0'),
(252, 17, 5105, 'KAB. KLUNGKUNG\n', '0', '0'),
(253, 17, 5106, 'KAB. BANGLI\n', '0', '0'),
(254, 17, 5107, 'KAB. KARANGASEM\n', '0', '0'),
(255, 17, 5108, 'KAB. BULELENG\n', '0', '0'),
(256, 17, 5171, 'KOTA DENPASAR\n', '0', '0'),
(257, 18, 5201, 'KAB. LOMBOK BARAT\n', '0', '0'),
(258, 18, 5202, 'KAB. LOMBOK TENGAH\n', '0', '0'),
(259, 18, 5203, 'KAB. LOMBOK TIMUR\n', '0', '0'),
(260, 18, 5204, 'KAB. SUMBAWA', '0', '0'),
(261, 18, 5205, 'KAB. DOMPU\n', '0', '0'),
(262, 18, 5206, 'KAB. BIMA\n', '0', '0'),
(263, 18, 5207, 'KAB. SUMBAWA BARAT', '0', '0'),
(264, 18, 5271, 'KOTA MATARAM\n', '0', '0'),
(265, 18, 5272, 'KOTA BIMA\n', '0', '0'),
(266, 19, 5301, 'KAB. KUPANG\n', '0', '0'),
(267, 19, 5302, 'KAB. TIMOR TENGAH SELATAN\n', '0', '0'),
(268, 19, 5303, 'KAB. TIMOR TENGAH UTARA\n', '0', '0'),
(269, 19, 5304, 'KAB. BELU\n', '0', '0'),
(270, 19, 5305, 'KAB. ALOR\n', '0', '0'),
(271, 19, 5306, 'KAB. FLORES TIMUR\n', '0', '0'),
(272, 19, 5307, 'KAB. SIKKA\n', '0', '0'),
(273, 19, 5308, 'KAB. ENDE\n', '0', '0'),
(274, 19, 5309, 'KAB. NGADA\n', '0', '0'),
(275, 19, 5310, 'KAB. MANGGARAI\n', '0', '0'),
(276, 19, 5311, 'KAB. SUMBA TIMUR\n', '0', '0'),
(277, 19, 5312, 'KAB. SUMBA BARAT\n', '0', '0'),
(278, 19, 5313, 'KAB. LEMBATA\n', '0', '0'),
(279, 19, 5314, 'KAB. ROTE NDAO\n', '0', '0'),
(280, 19, 5315, 'KAB. MANGGARAI BARAT\n', '0', '0'),
(281, 19, 5371, 'KOTA KUPANG\n', '0', '0'),
(282, 20, 6101, 'KAB. SAMBAS\n', '0', '0'),
(283, 20, 6102, 'KAB. PONTIANAK\n', '0', '0'),
(284, 20, 6103, 'KAB. SANGGAU', '0', '0'),
(285, 20, 6104, 'KAB. KETAPANG\n', '0', '0'),
(286, 20, 6105, 'KAB. SINTANG', '0', '0'),
(287, 20, 6106, 'KAB. KAPUAS HULU\n', '0', '0'),
(288, 20, 6107, 'KAB. BENGKAYANG\n', '0', '0'),
(289, 20, 6108, 'KAB. LANDAK\n', '0', '0'),
(290, 20, 6109, 'KAB. MELAWI', '0', '0'),
(291, 20, 6110, 'KAB. SEKADAU', '0', '0'),
(292, 20, 6171, 'KOTA PONTIANAK\n', '0', '0'),
(293, 20, 6172, 'KOTA SINGKAWANG\n', '0', '0'),
(294, 21, 6201, 'KAB. KOTAWARINGIN BARAT\n', '0', '0'),
(295, 21, 6202, 'KAB. KOTAWARINGIN TIMUR\n', '0', '0'),
(296, 21, 6203, 'KAB. KAPUAS\n', '0', '0'),
(297, 21, 6204, 'KAB. BARITO SELATAN\n', '0', '0'),
(298, 21, 6205, 'KAB. BARITO UTARA\n', '0', '0'),
(299, 21, 6206, 'KAB. KATINGIN\n', '0', '0'),
(300, 21, 6207, 'KAB. SERUYAN\n', '0', '0'),
(301, 21, 6208, 'KAB. SUKAMARA\n', '0', '0'),
(302, 21, 6209, 'KAB. LAMANDAU\n', '0', '0'),
(303, 21, 6210, 'KAB. GUNUNG MAS\n', '0', '0'),
(304, 21, 6211, 'KAB. PULANG PISAU\n', '0', '0'),
(305, 21, 6212, 'KAB. MURUNG RAYA\n', '0', '0'),
(306, 21, 6213, 'KAB. BARITO TIMUR\n', '0', '0'),
(307, 21, 6271, 'KOTA PALANGKARAYA\n', '0', '0'),
(308, 22, 6301, 'KAB. TANAH LAUT\n', '0', '0'),
(309, 22, 6302, 'KAB. KOTABARU\n', '0', '0'),
(310, 22, 6303, 'KAB. BANJAR\n', '0', '0'),
(311, 22, 6304, 'KAB. BARITO KUALA\n', '0', '0'),
(312, 22, 6305, 'KAB. TAPIN\n', '0', '0'),
(313, 22, 6306, 'KAB. HULU SUNGAI SELATAN\n', '0', '0'),
(314, 22, 6307, 'KAB. HULU SUNGAI TENGAH\n', '0', '0'),
(315, 22, 6308, 'KAB. HULU SUNGAI UTARA\n', '0', '0'),
(316, 22, 6309, 'KAB. TABALONG\n', '0', '0'),
(317, 22, 6310, 'KAB. TANAH BAMBU\n', '0', '0'),
(318, 22, 6311, 'KAB. BALANGAN\n', '0', '0'),
(319, 22, 6371, 'KOTA BANJARMASIN\n', '0', '0'),
(320, 22, 6372, 'KOTA BANJARBARU\n', '0', '0'),
(321, 23, 6401, 'KAB. PASIR\n', '0', '0'),
(322, 23, 6402, 'KAB. KUTAI KERTANEGARA\n', '0', '0'),
(323, 23, 6403, 'KAB. BERAU\n', '0', '0'),
(324, 23, 6404, 'KAB. BULUNGAN\n', '0', '0'),
(325, 23, 6405, 'KAB. NUNUKAN\n', '0', '0'),
(326, 23, 6406, 'KAB. MALINAU\n', '0', '0'),
(327, 23, 6407, 'KAB. KUTAI BARAT\n', '0', '0'),
(328, 23, 6408, 'KAB. KUTAI TIMUR\n', '0', '0'),
(329, 23, 6409, 'KAB. PENAJAM PASER UTARA\n', '0', '0'),
(330, 23, 6471, 'KOTA BALIKPAPAN\n', '0', '0'),
(331, 23, 6472, 'KOTA SAMARINDA\n', '0', '0'),
(332, 23, 6473, 'KOTA TARAKAN\n', '0', '0'),
(333, 23, 6474, 'KOTA BONTANG\n', '0', '0'),
(334, 24, 7101, 'KAB. BOLAANG MANGONDOW\n', '0', '0'),
(335, 24, 7102, 'KAB. MINAHASA', '0', '0'),
(336, 24, 7103, 'KAB. KEPULAUAN SANGIHE\n', '0', '0'),
(337, 24, 7104, 'KAB. KEPULAUAN TALAUD\n', '0', '0'),
(338, 24, 7105, 'KAB. MINAHASA SELATAN\n', '0', '0'),
(339, 24, 7106, 'KAB. MINAHASA UTARA', '0', '0'),
(340, 24, 7171, 'KOTA MANADO\n', '0', '0'),
(341, 24, 7172, 'KOTA BITUNG\n', '0', '0'),
(342, 24, 7173, 'KOTA TOMOHON\n', '0', '0'),
(343, 25, 7201, 'KAB. BANGGAI\n', '0', '0'),
(344, 25, 7202, 'KAB. POSO', '0', '0'),
(345, 25, 7203, 'KAB. DONGGALA\n', '0', '0'),
(346, 25, 7204, 'KAB. TOLOI TOLI\n', '0', '0'),
(347, 25, 7205, 'KAB. BUOL\n', '0', '0'),
(348, 25, 7206, 'KAB. MOROWALI\n', '0', '0'),
(349, 25, 7207, 'KAB. BANGGAI KEPULAUAN\n', '0', '0'),
(350, 25, 7208, 'KAB. PARIGI MOUTONG\n', '0', '0'),
(351, 25, 7209, 'KAB. TOJO UNA UNA', '0', '0'),
(352, 25, 7271, 'KOTA PALU\n', '0', '0'),
(353, 26, 7301, 'KAB. SELAYAR\n', '0', '0'),
(354, 26, 7302, 'KAB. BULUKUMBA\n', '0', '0'),
(355, 26, 7303, 'KAB. BANTAENG\n', '0', '0'),
(356, 26, 7304, 'KAB. JENEPONTO.\n', '0', '0'),
(357, 26, 7305, 'KAB. TAKALAR\n', '0', '0'),
(358, 26, 7306, 'KAB. GOWA\n', '0', '0'),
(359, 26, 7307, 'KAB. SINJAI\n', '0', '0'),
(360, 26, 7308, 'KAB. BONE\n', '0', '0'),
(361, 26, 7309, 'KAB. MAROS\n', '0', '0'),
(362, 26, 7310, 'KAB. PANGKAJENE KEP.\n', '0', '0'),
(363, 26, 7311, 'KAB. BARRU\n', '0', '0'),
(364, 26, 7312, 'KAB. SOPPENG\n', '0', '0'),
(365, 26, 7313, 'KAB. WAJO\n', '0', '0'),
(366, 26, 7314, 'KAB. SIDENRENG RAPANG\n', '0', '0'),
(367, 26, 7315, 'KAB. PINRANG\n', '0', '0'),
(368, 26, 7316, 'KAB. ENREKANG\n', '0', '0'),
(369, 26, 7317, 'KAB. LUWU\n', '0', '0'),
(370, 26, 7318, 'KAB. TANA TORAJA\n', '0', '0'),
(371, 26, 7322, 'KAB. LUWU UTARA\n', '0', '0'),
(372, 26, 7324, 'KAB. LUWU TIMUR\n', '0', '0'),
(373, 26, 7371, 'KOTA MAKASAR\n', '0', '0'),
(374, 26, 7372, 'KOTA PARE PARE\n', '0', '0'),
(375, 26, 7373, 'KOTA PALOPO\n', '0', '0'),
(376, 27, 7401, 'KAB. KOLAKA', '0', '0'),
(377, 27, 7402, 'KAB. KONAWE\n', '0', '0'),
(378, 27, 7403, 'KAB. MUNA\n', '0', '0'),
(379, 27, 7404, 'KAB. BUTON*)\n', '0', '0'),
(380, 27, 7405, 'KAB. KONAWE SELATAN\n', '0', '0'),
(381, 27, 7406, 'KAB. BOMBANA*)\n', '0', '0'),
(382, 27, 7407, 'KAB. WAKATOBI*)\n', '0', '0'),
(383, 27, 7408, 'KAB. KOLAKA UTARA*)\n', '0', '0'),
(384, 27, 7471, 'KOTA KENDARI\n', '0', '0'),
(385, 27, 7472, 'KOTA BAU BAU\n', '0', '0'),
(386, 28, 7501, 'KAB. GORONTALO\n', '0', '0'),
(387, 28, 7502, 'KAB. BOALEMO\n', '0', '0'),
(388, 28, 7503, 'KAB. BONE BOLANGO\n', '0', '0'),
(389, 28, 7504, 'KAB. PAHUWATO\n', '0', '0'),
(390, 28, 7571, 'KOTA GORONTALO\n', '0', '0'),
(391, 29, 7601, 'KAB. MAMUJU UTARA\n', '0', '0'),
(392, 29, 7602, 'KAB. MAMUJU\n', '0', '0'),
(393, 29, 7603, 'KAB. MAMASA\n', '0', '0'),
(394, 29, 7604, 'KAB. POLOWALI MAMASA\n', '0', '0'),
(395, 29, 7605, 'KAB. MAJENE\n', '0', '0'),
(396, 30, 8101, 'KAB. MALUKU TENGAH *)\n', '0', '0'),
(397, 30, 8102, 'KAB. MALUKU TENGGARA *)\n', '0', '0'),
(398, 30, 8103, 'KAB. MALUKU TENGGARA BRT\n', '0', '0'),
(399, 30, 8104, 'KAB. BURU\n', '0', '0'),
(400, 30, 8105, 'KAB. SERAM BAGIAN TIMUR*)\n', '0', '0'),
(401, 30, 8106, 'KAB. SERAM BAGIAN BARAT *)\n', '0', '0'),
(402, 30, 8107, 'KAB. KEPULAUAN ARU*)\n', '0', '0'),
(403, 30, 8171, 'KOTA AMBON\n', '0', '0'),
(404, 31, 8201, 'KAB. HALMAHERA BARAT\n', '0', '0'),
(405, 31, 8202, 'KAB. HALMAHERA TENGAH\n', '0', '0'),
(406, 31, 8203, 'KAB. HALMAHERA UTARA\n', '0', '0'),
(407, 31, 8204, 'KAB. HALMAHERA SELATAN\n', '0', '0'),
(408, 31, 8205, 'KAB. KEPULAUAN SULA\n', '0', '0'),
(409, 31, 8206, 'KAB. HALMAHERA TIMUR\n', '0', '0'),
(410, 31, 8271, 'KOTA TERNATE\n', '0', '0'),
(411, 31, 8272, 'KOTA TIDORE KEPULAUAN\n', '0', '0'),
(412, 32, 9101, 'KAB. MERAUKE\n', '0', '0'),
(413, 32, 9102, 'KAB. JAYAWIJAYA\n', '0', '0'),
(414, 32, 9103, 'KAB. JAYAPURA\n', '0', '0'),
(415, 32, 9104, 'KAB. NABIRE\n', '0', '0'),
(416, 32, 9105, 'KAB. YAPEN WAROPEN\n', '0', '0'),
(417, 32, 9106, 'KAB. BIAK NUMFOR*)\n', '0', '0'),
(418, 32, 9107, 'KAB. PUNCAK JAYA\n', '0', '0'),
(419, 32, 9108, 'KAB. PANIAI\n', '0', '0'),
(420, 32, 9109, 'KAB. MIMIKA\n', '0', '0'),
(421, 32, 9110, 'KAB. SARMI\n', '0', '0'),
(422, 32, 9111, 'KAB. KEEROM\n', '0', '0'),
(423, 32, 9112, 'KAB. PEGUNUNGAN BINTANG\n', '0', '0'),
(424, 32, 9113, 'KAB. YAHUKIMO\n', '0', '0'),
(425, 32, 9114, 'KAB. TOLIKARA\n', '0', '0'),
(426, 32, 9115, 'KAB. WAROPEN\n', '0', '0'),
(427, 32, 9116, 'KAB. BOVEN DIGOEL\n', '0', '0'),
(428, 32, 9117, 'KABUPATEN. MAPPI\n', '0', '0'),
(429, 32, 9118, 'KAB. ASMAT\n', '0', '0'),
(430, 32, 9121, 'KAB. SUPIORI*)\n', '0', '0'),
(431, 32, 9171, 'KOTA JAYAPURA\n', '0', '0'),
(432, 33, 9201, 'KAB. SORONG\n', '0', '0'),
(433, 33, 9202, 'KAB. MANOKWARI\n', '0', '0'),
(434, 33, 9203, 'KAB. FAK FAK\n', '0', '0'),
(435, 33, 9204, 'KAB. SORONG SELATAN\n', '0', '0'),
(436, 33, 9205, 'KAB. RAJA AMPAT\n', '0', '0'),
(437, 33, 9206, 'KAB. TELUK BENTUNI\n', '0', '0'),
(438, 33, 9207, 'KAB. TELUK WONDAMA\n', '0', '0'),
(439, 33, 9208, 'KAB. KAIMA\n', '0', '0'),
(440, 33, 9209, 'KOTA SORONG\n', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE IF NOT EXISTS `kamar` (
  `kamar_id` int(5) NOT NULL AUTO_INCREMENT,
  `indekos_id` int(5) NOT NULL,
  `kamar_nama` varchar(30) NOT NULL,
  `kamar_harga` int(8) NOT NULL,
  `kamar_isi` int(2) NOT NULL,
  `kamar_ukuran_panjang` int(3) NOT NULL,
  `kamar_ukuran_lebar` int(3) NOT NULL,
  `kamar_ukuran_jenis` varchar(5) NOT NULL,
  `kamar_foto` varchar(40) NOT NULL DEFAULT 'not_found.png',
  `kamar_minimal_kontrak` int(3) NOT NULL,
  `kamar_minimal_kontrak_jenis` varchar(5) NOT NULL,
  `kamar_kontrak_status` varchar(10) NOT NULL DEFAULT 'kosong',
  `kamar_kontrak_dari_tanggal` date NOT NULL,
  `kamar_kontrak_sampai_tanggal` date NOT NULL,
  PRIMARY KEY (`kamar_id`),
  KEY `indekos_id` (`indekos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`kamar_id`, `indekos_id`, `kamar_nama`, `kamar_harga`, `kamar_isi`, `kamar_ukuran_panjang`, `kamar_ukuran_lebar`, `kamar_ukuran_jenis`, `kamar_foto`, `kamar_minimal_kontrak`, `kamar_minimal_kontrak_jenis`, `kamar_kontrak_status`, `kamar_kontrak_dari_tanggal`, `kamar_kontrak_sampai_tanggal`) VALUES
(1, 1, 'KAMAR NO 1', 50000, 2, 4, 5, 'M', 'kamar_1.png', 1, 'BULAN', 'kosong', '0000-00-00', '0000-00-00'),
(2, 34, 'KAMAR UJUNG KANAN', 50000, 1, 2, 2, 'M', 'not_found.png', 1, 'BULAN', 'kosong', '0000-00-00', '0000-00-00'),
(6, 34, 'KAMAR NO 1A', 500000, 2, 5, 5, 'M', 'not_found.png', 1, 'TAHUN', 'kosong', '0000-00-00', '0000-00-00'),
(10, 34, 'KAMAR NO 2A', 45000, 1, 2, 2, 'CM', 'not_found.png', 1, 'BULAN', 'kosong', '0000-00-00', '0000-00-00'),
(61, 1, 'NO 202', 50000, 1, 34, 34, 'CM', 'kamar_11385518536.jpg', 1, 'BULAN', 'kontrak', '2013-11-20', '2014-11-20'),
(63, 1, 'NO 201', 57000, 1, 34, 34, 'CM', 'not_found.png', 1, 'BULAN', 'kosong', '0000-00-00', '0000-00-00'),
(68, 2, 'KAM', 50, 1, 6, 6, 'M', 'not_found.png', 1, 'BULAN', 'kontrak', '2013-11-13', '2013-11-29'),
(69, 33, 'WEK', 45, 1, 5, 4, 'M', 'not_found.png', 2, 'BULAN', 'kontrak', '2013-11-20', '2014-01-20'),
(70, 29, 'KAMAR', 500000, 1, 5, 5, 'M', 'not_found.png', 1, 'BULAN', 'kosong', '0000-00-00', '0000-00-00'),
(71, 29, 'KAMAR AJA', 500000, 1, 5, 5, 'CM', 'not_found.png', 1, 'BULAN', 'kosong', '0000-00-00', '0000-00-00'),
(72, 29, 'asdf', 345, 1, 43, 4, 'CM', 'not_found.png', 1, 'HARI', 'kontrak', '2013-11-20', '2014-06-20'),
(73, 29, 'asdf', 345, 1, 3, 4, 'M', 'not_found.png', 1, 'HARI', 'kosong', '0000-00-00', '0000-00-00'),
(74, 1, 'asdf', 45, 1, 4, 5, 'CM', 'kamar_11384947973.jpg', 1, 'HARI', 'kosong', '0000-00-00', '0000-00-00'),
(75, 35, 'No 1 Lantai 1', 50000, 1, 5, 6, 'M', 'kamar_351385639881.jpg', 1, 'BULAN', 'kontrak', '2013-12-01', '2013-12-31'),
(76, 36, 'no1', 30000, 2, 5, 6, 'M', 'kamar_361386930318.jpg', 1, 'BULAN', 'kontrak', '2013-12-13', '2013-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `kamar_fasilitas_int`
--

CREATE TABLE IF NOT EXISTS `kamar_fasilitas_int` (
  `kamar_fasilitas_int_id` int(5) NOT NULL AUTO_INCREMENT,
  `kamar_id` int(5) NOT NULL,
  `fasilitas_int_id` int(5) NOT NULL,
  PRIMARY KEY (`kamar_fasilitas_int_id`),
  KEY `kamar_id` (`kamar_id`),
  KEY `fasilitas_int_id` (`fasilitas_int_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `kamar_fasilitas_int`
--

INSERT INTO `kamar_fasilitas_int` (`kamar_fasilitas_int_id`, `kamar_id`, `fasilitas_int_id`) VALUES
(3, 75, 1),
(4, 75, 3),
(6, 75, 2);

-- --------------------------------------------------------

--
-- Table structure for table `lupa_password`
--

CREATE TABLE IF NOT EXISTS `lupa_password` (
  `lupa_password_id` int(5) NOT NULL AUTO_INCREMENT,
  `pemilik_id` int(5) NOT NULL,
  `lupa_password_key` varchar(50) NOT NULL,
  PRIMARY KEY (`lupa_password_id`),
  UNIQUE KEY `pemilik_id_2` (`pemilik_id`),
  KEY `pemilik_id` (`pemilik_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `lupa_password`
--

INSERT INTO `lupa_password` (`lupa_password_id`, `pemilik_id`, `lupa_password_key`) VALUES
(1, 1, '434cbf9d75fb1ccc3b8d1ec5844b223d'),
(5, 3, '516f43bb47d5adf8263bf6aab164dd54');

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE IF NOT EXISTS `pemilik` (
  `pemilik_id` int(5) NOT NULL AUTO_INCREMENT,
  `provinsi_id` int(5) NOT NULL,
  `kab_kota_id` int(3) NOT NULL,
  `pemilik_nama` varchar(30) NOT NULL,
  `pemilik_email` varchar(30) NOT NULL,
  `pemilik_password` varchar(45) NOT NULL,
  `pemilik_alamat` varchar(100) NOT NULL,
  `pemilik_no_hp` varchar(12) NOT NULL,
  `pemilik_rumah_long` varchar(50) NOT NULL,
  `pemilik_rumah_lat` varchar(50) NOT NULL,
  `pemilik_status` varchar(10) NOT NULL,
  `pemilik_kode_aktif` varchar(20) NOT NULL,
  PRIMARY KEY (`pemilik_id`),
  UNIQUE KEY `pemilik_email` (`pemilik_email`),
  KEY `kota_kab_id` (`kab_kota_id`),
  KEY `provinsi_id` (`provinsi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `pemilik`
--

INSERT INTO `pemilik` (`pemilik_id`, `provinsi_id`, `kab_kota_id`, `pemilik_nama`, `pemilik_email`, `pemilik_password`, `pemilik_alamat`, `pemilik_no_hp`, `pemilik_rumah_long`, `pemilik_rumah_lat`, `pemilik_status`, `pemilik_kode_aktif`) VALUES
(1, 16, 246, 'M Fuad Adib', 'mfuadadib@yahoo.com', '0cc175b9c0f1b6a831c399e269772661', 'renged kresek', '085725888', '2.6783411', '5.4567547', 'aktif', '92eb5ffee6ae2fec3ad7'),
(3, 16, 244, 'M Fuad Adib', 'mfuad@yahoo.com', '0cc175b9c0f1b6a831c399e269772661', 'Renged', '08765433567', '2.6783411', '5.4567547', 'aktif', '5286dbf8b5305'),
(4, 11, 135, 'PEMILIK INDEKOS', 'fuadadib@gmail.com', '0cc175b9c0f1b6a831c399e269772661', 'KODYA JAKARTA', '08978688', '2.6783411', '5.4567547', 'aktif', '5286e725e7069'),
(7, 1, 3, 'ADIB', 'mfa_16@yahoo.com', '0cc175b9c0f1b6a831c399e269772661', 'ACEH TIMURAN :D', '87665454564', '96.4434814453125', '4.735200991337153', 'aktif', ''),
(8, 14, 203, 'M', 'm@yahoo.com', '0cc175b9c0f1b6a831c399e269772661', 'Papringan', '0897888', '2.6783411', '5.4567547', 'aktif', '529729d1e7f83');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE IF NOT EXISTS `provinsi` (
  `provinsi_id` int(3) NOT NULL AUTO_INCREMENT,
  `provinsi_kode` int(2) NOT NULL,
  `provinsi_nama` varchar(50) NOT NULL,
  PRIMARY KEY (`provinsi_id`),
  UNIQUE KEY `KodePropinsi` (`provinsi_kode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`provinsi_id`, `provinsi_kode`, `provinsi_nama`) VALUES
(1, 11, 'NANGGROE ACEH DARUSSALAM'),
(2, 12, 'SUMATERA UTARA'),
(3, 13, 'SUMATERA BARAT'),
(4, 14, 'RIAU'),
(5, 15, 'JAMBI'),
(6, 16, 'SUMATERA SELATAN'),
(7, 17, 'BENGKULU'),
(8, 18, 'LAMPUNG'),
(9, 19, 'KEP BANGKA BELITUNG'),
(10, 21, 'KEP RIAU'),
(11, 31, 'DKI JAKARTA'),
(12, 32, 'JAWA BARAT'),
(13, 33, 'JAWA TENGAH'),
(14, 34, 'DI JOGJAKARTA'),
(15, 35, 'JAWA TIMUR'),
(16, 36, 'BANTEN'),
(17, 51, 'BALI'),
(18, 52, 'NUSA TENGGARA BARAT'),
(19, 53, 'NUSA TENGGARA TIMUR'),
(20, 61, 'KALIMANTAN BARAT'),
(21, 62, 'KALIMANTAN TENGAH'),
(22, 63, 'KALIMANTA SELATAN'),
(23, 64, 'KALIMANTAN TIMUR'),
(24, 71, 'SULAWESI UTARA'),
(25, 72, 'SULAWESI TENGAH'),
(26, 73, 'SULAWESI SELATAN'),
(27, 74, 'SULAWESI TENGGARA'),
(28, 75, 'GORONTALO     '),
(29, 76, 'SULAWESI BARAT'),
(30, 81, 'MALUKU'),
(31, 82, 'MALUKU UTARA'),
(32, 91, 'PAPUA'),
(33, 92, 'PAPUA BARAT (PP No 24/2007)');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fasilitas_eks`
--
ALTER TABLE `fasilitas_eks`
  ADD CONSTRAINT `fasilitas_eks_ibfk_2` FOREIGN KEY (`kab_kota_id`) REFERENCES `kab_kota` (`kab_kota_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fasilitas_eks_ibfk_3` FOREIGN KEY (`fasilitas_master_id`) REFERENCES `fasilitas_master` (`fasilitas_master_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fasilitas_int`
--
ALTER TABLE `fasilitas_int`
  ADD CONSTRAINT `fasilitas_int_ibfk_1` FOREIGN KEY (`pemilik_id`) REFERENCES `pemilik` (`pemilik_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `indekos`
--
ALTER TABLE `indekos`
  ADD CONSTRAINT `indekos_ibfk_1` FOREIGN KEY (`pemilik_id`) REFERENCES `pemilik` (`pemilik_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `indekos_ibfk_2` FOREIGN KEY (`kab_kota_id`) REFERENCES `kab_kota` (`kab_kota_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `indekos_fasilitas_eks`
--
ALTER TABLE `indekos_fasilitas_eks`
  ADD CONSTRAINT `indekos_fasilitas_eks_ibfk_1` FOREIGN KEY (`indekos_id`) REFERENCES `indekos` (`indekos_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `indekos_fasilitas_eks_ibfk_2` FOREIGN KEY (`fasilitas_eks_id`) REFERENCES `fasilitas_eks` (`fasilitas_eks_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kab_kota`
--
ALTER TABLE `kab_kota`
  ADD CONSTRAINT `kab_kota_ibfk_1` FOREIGN KEY (`provinsi_id`) REFERENCES `provinsi` (`provinsi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_ibfk_1` FOREIGN KEY (`indekos_id`) REFERENCES `indekos` (`indekos_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kamar_fasilitas_int`
--
ALTER TABLE `kamar_fasilitas_int`
  ADD CONSTRAINT `kamar_fasilitas_int_ibfk_1` FOREIGN KEY (`kamar_id`) REFERENCES `kamar` (`kamar_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kamar_fasilitas_int_ibfk_2` FOREIGN KEY (`fasilitas_int_id`) REFERENCES `fasilitas_int` (`fasilitas_int_id`) ON DELETE CASCADE ON UPDATE CASCADE;
