-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Dec 29, 2018 at 07:52 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pembayaran6`
--

-- --------------------------------------------------------

--
-- Table structure for table `t01_tahunajaran`
--

CREATE TABLE `t01_tahunajaran` (
  `id` int(11) NOT NULL,
  `AwalBulan` tinyint(4) NOT NULL,
  `AwalTahun` smallint(6) NOT NULL,
  `AkhirBulan` tinyint(4) NOT NULL,
  `AkhirTahun` smallint(6) NOT NULL,
  `TahunAjaran` varchar(11) NOT NULL,
  `Aktif` enum('Y','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t01_tahunajaran`
--

INSERT INTO `t01_tahunajaran` (`id`, `AwalBulan`, `AwalTahun`, `AkhirBulan`, `AkhirTahun`, `TahunAjaran`, `Aktif`) VALUES
(1, 7, 2018, 6, 2019, '2018 / 2019', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `t02_sekolah`
--

CREATE TABLE `t02_sekolah` (
  `id` int(11) NOT NULL,
  `Sekolah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t02_sekolah`
--

INSERT INTO `t02_sekolah` (`id`, `Sekolah`) VALUES
(1, 'MINU UNGGULAN'),
(2, 'MINU KARAKTER');

-- --------------------------------------------------------

--
-- Table structure for table `t03_kelas`
--

CREATE TABLE `t03_kelas` (
  `id` int(11) NOT NULL,
  `Kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t03_kelas`
--

INSERT INTO `t03_kelas` (`id`, `Kelas`) VALUES
(1, 'KELAS I NICOLAS OTTO'),
(2, 'KELAS I JAMES WATT'),
(3, 'KELAS II ALEXANDER GRAHAM BELL'),
(4, 'KELAS II MICHAEL FARADAY'),
(5, 'KELAS III ALBERT EINSTEIN'),
(6, 'KELAS III ALFRED NOBEL'),
(7, 'KELAS IV ISAAC NEWTON'),
(8, 'KELAS IV ALESSANDRO VOLTA'),
(9, 'KELAS V THOMAS ALFA EDISON'),
(10, 'KELAS VI GALILEO GALILEI'),
(11, 'KELAS I KH. BISRI SYANSURI'),
(12, 'KELAS I KH. WACHID HASYIM');

-- --------------------------------------------------------

--
-- Table structure for table `t04_siswa`
--

CREATE TABLE `t04_siswa` (
  `id` int(11) NOT NULL,
  `NIS` varchar(100) NOT NULL,
  `Nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t04_siswa`
--

INSERT INTO `t04_siswa` (`id`, `NIS`, `Nama`) VALUES
(2, '180001', 'Abdul'),
(3, '180002', 'Budi'),
(4, '180003', 'Abdi');

-- --------------------------------------------------------

--
-- Table structure for table `t05_daftarsiswamaster`
--

CREATE TABLE `t05_daftarsiswamaster` (
  `id` int(11) NOT NULL,
  `tahunajaran_id` int(11) NOT NULL,
  `sekolah_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t05_daftarsiswamaster`
--

INSERT INTO `t05_daftarsiswamaster` (`id`, `tahunajaran_id`, `sekolah_id`, `kelas_id`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 2),
(3, 1, 1, 3),
(4, 1, 1, 4),
(5, 1, 2, 11),
(6, 1, 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `t06_daftarsiswadetail`
--

CREATE TABLE `t06_daftarsiswadetail` (
  `id` int(11) NOT NULL,
  `daftarsiswamaster_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t06_daftarsiswadetail`
--

INSERT INTO `t06_daftarsiswadetail` (`id`, `daftarsiswamaster_id`, `siswa_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `t07_spp`
--

CREATE TABLE `t07_spp` (
  `id` int(11) NOT NULL,
  `SPP` varchar(100) NOT NULL,
  `Jenis` enum('Rutin','Non-Rutin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t07_spp`
--

INSERT INTO `t07_spp` (`id`, `SPP`, `Jenis`) VALUES
(1, 'Infaq', 'Rutin'),
(2, 'Catering', 'Rutin'),
(3, 'Worksheet', 'Rutin'),
(4, 'Beasiswa Infaq', 'Rutin'),
(5, 'Dana SPM BP3MNU', 'Non-Rutin'),
(6, 'Daftar Ulang', 'Non-Rutin');

-- --------------------------------------------------------

--
-- Table structure for table `t08_siswaspp`
--

CREATE TABLE `t08_siswaspp` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `tahunajaran_id` int(11) NOT NULL,
  `spp_id` int(11) NOT NULL,
  `Nilai` float(14,2) NOT NULL DEFAULT '0.00',
  `Terbayar` float(14,2) NOT NULL DEFAULT '0.00',
  `Potensi` float(14,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t08_siswaspp`
--

INSERT INTO `t08_siswaspp` (`id`, `siswa_id`, `tahunajaran_id`, `spp_id`, `Nilai`, `Terbayar`, `Potensi`) VALUES
(1, 2, 1, 1, 150000.00, 0.00, 0.00),
(2, 2, 1, 2, 200000.00, 0.00, 0.00),
(3, 2, 1, 5, 1000000.00, 0.00, 0.00),
(4, 4, 1, 1, 750000.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `t09_bayarmaster`
--

CREATE TABLE `t09_bayarmaster` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `tahunajaran_id` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `NomorBayar` varchar(25) NOT NULL,
  `Jumlah` float(14,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t09_bayarmaster`
--

INSERT INTO `t09_bayarmaster` (`id`, `siswa_id`, `tahunajaran_id`, `Tanggal`, `NomorBayar`, `Jumlah`) VALUES
(1, 2, 1, '2018-12-27', 'BYR0001', 0.00),
(2, 4, 1, '2018-12-27', 'BYR0002', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `t10_bayardetail`
--

CREATE TABLE `t10_bayardetail` (
  `id` int(11) NOT NULL,
  `bayarmaster_id` int(11) NOT NULL,
  `siswaspp_id` int(11) NOT NULL,
  `Keterangan` varchar(100) DEFAULT NULL,
  `Keterangan2` varchar(100) DEFAULT NULL,
  `Keterangan3` varchar(100) DEFAULT NULL,
  `Jumlah` float(14,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t10_bayardetail`
--

INSERT INTO `t10_bayardetail` (`id`, `bayarmaster_id`, `siswaspp_id`, `Keterangan`, `Keterangan2`, `Keterangan3`, `Jumlah`) VALUES
(1, 1, 1, 'Juli 2018', NULL, NULL, 150000.00),
(2, 1, 1, 'Agustus 2018', NULL, NULL, 150000.00),
(3, 1, 3, 'Angsuran Ke-1', NULL, NULL, 250000.00),
(4, 2, 4, 'Juli 2018', NULL, NULL, 750000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t95_periode`
--

CREATE TABLE `t95_periode` (
  `id` int(11) NOT NULL,
  `BulanAngka` tinyint(4) NOT NULL,
  `BulanNama` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t95_periode`
--

INSERT INTO `t95_periode` (`id`, `BulanAngka`, `BulanNama`) VALUES
(1, 7, 'Juli'),
(2, 8, 'Agustus'),
(3, 9, 'September'),
(4, 10, 'Oktober'),
(5, 11, 'November'),
(6, 12, 'Desember'),
(7, 1, 'Januari'),
(8, 2, 'Februari'),
(9, 3, 'Maret'),
(10, 4, 'April'),
(11, 5, 'Mei'),
(12, 6, 'Juni');

-- --------------------------------------------------------

--
-- Table structure for table `t96_employees`
--

CREATE TABLE `t96_employees` (
  `EmployeeID` int(11) NOT NULL,
  `LastName` varchar(20) DEFAULT NULL,
  `FirstName` varchar(10) DEFAULT NULL,
  `Title` varchar(30) DEFAULT NULL,
  `TitleOfCourtesy` varchar(25) DEFAULT NULL,
  `BirthDate` datetime DEFAULT NULL,
  `HireDate` datetime DEFAULT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `City` varchar(15) DEFAULT NULL,
  `Region` varchar(15) DEFAULT NULL,
  `PostalCode` varchar(10) DEFAULT NULL,
  `Country` varchar(15) DEFAULT NULL,
  `HomePhone` varchar(24) DEFAULT NULL,
  `Extension` varchar(4) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Notes` longtext,
  `ReportsTo` int(11) DEFAULT NULL,
  `Password` varchar(50) NOT NULL DEFAULT '',
  `UserLevel` int(11) DEFAULT NULL,
  `Username` varchar(20) NOT NULL DEFAULT '',
  `Activated` enum('Y','N') NOT NULL DEFAULT 'N',
  `Profile` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t96_employees`
--

INSERT INTO `t96_employees` (`EmployeeID`, `LastName`, `FirstName`, `Title`, `TitleOfCourtesy`, `BirthDate`, `HireDate`, `Address`, `City`, `Region`, `PostalCode`, `Country`, `HomePhone`, `Extension`, `Email`, `Photo`, `Notes`, `ReportsTo`, `Password`, `UserLevel`, `Username`, `Activated`, `Profile`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21232f297a57a5a743894a0e4a801fc3', -1, 'admin', 'Y', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t97_userlevels`
--

CREATE TABLE `t97_userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t97_userlevels`
--

INSERT INTO `t97_userlevels` (`userlevelid`, `userlevelname`) VALUES
(-2, 'Anonymous'),
(-1, 'Administrator'),
(0, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `t98_userlevelpermissions`
--

CREATE TABLE `t98_userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t98_userlevelpermissions`
--

INSERT INTO `t98_userlevelpermissions` (`userlevelid`, `tablename`, `permission`) VALUES
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}cf01_home.php', 8),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t01_tahunajaran', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t96_employees', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t97_userlevels', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t98_userlevelpermissions', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t99_audittrail', 0),
(-2, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}cf01_home.php', 8),
(-2, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t96_employees', 0),
(-2, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t97_userlevels', 0),
(-2, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t98_userlevelpermissions', 0),
(-2, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t99_audittrail', 0),
(-2, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t01_tahunajaran', 0),
(-2, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t96_employees', 0),
(-2, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t97_userlevels', 0),
(-2, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t98_userlevelpermissions', 0),
(-2, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t99_audittrail', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}cf01_home.php', 8),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t01_tahunajaran', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t96_employees', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t97_userlevels', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t98_userlevelpermissions', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t99_audittrail', 0),
(0, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}cf01_home.php', 8),
(0, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t96_employees', 0),
(0, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t97_userlevels', 0),
(0, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t98_userlevelpermissions', 0),
(0, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t99_audittrail', 0),
(0, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t01_tahunajaran', 0),
(0, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t96_employees', 0),
(0, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t97_userlevels', 0),
(0, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t98_userlevelpermissions', 0),
(0, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t99_audittrail', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t99_audittrail`
--

CREATE TABLE `t99_audittrail` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `script` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `table` varchar(255) DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `keyvalue` longtext,
  `oldvalue` longtext,
  `newvalue` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t99_audittrail`
--

INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(1, '2018-12-27 02:35:39', '/pembayaran6/login.php', 'admin', 'login', '::1', '', '', '', ''),
(2, '2018-12-27 02:36:33', '/pembayaran6/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(3, '2018-12-27 02:36:49', '/pembayaran6/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4, '2018-12-27 03:03:42', '/pembayaran6/t02_sekolahadd.php', '1', 'A', 't02_sekolah', 'Sekolah', '1', '', 'MINU UNGGULAN'),
(5, '2018-12-27 03:03:42', '/pembayaran6/t02_sekolahadd.php', '1', 'A', 't02_sekolah', 'id', '1', '', '1'),
(6, '2018-12-27 03:03:56', '/pembayaran6/t02_sekolahadd.php', '1', 'A', 't02_sekolah', 'Sekolah', '2', '', 'MINU KARAKTER'),
(7, '2018-12-27 03:03:56', '/pembayaran6/t02_sekolahadd.php', '1', 'A', 't02_sekolah', 'id', '2', '', '2'),
(8, '2018-12-27 03:17:40', '/pembayaran6/t04_siswaadd.php', '1', 'A', 't04_siswa', 'NIS', '2', '', '180001'),
(9, '2018-12-27 03:17:40', '/pembayaran6/t04_siswaadd.php', '1', 'A', 't04_siswa', 'Nama', '2', '', 'Abdul'),
(10, '2018-12-27 03:17:40', '/pembayaran6/t04_siswaadd.php', '1', 'A', 't04_siswa', 'id', '2', '', '2'),
(11, '2018-12-27 03:17:54', '/pembayaran6/t04_siswaadd.php', '1', 'A', 't04_siswa', 'NIS', '3', '', '180002'),
(12, '2018-12-27 03:17:54', '/pembayaran6/t04_siswaadd.php', '1', 'A', 't04_siswa', 'Nama', '3', '', 'Budi'),
(13, '2018-12-27 03:17:54', '/pembayaran6/t04_siswaadd.php', '1', 'A', 't04_siswa', 'id', '3', '', '3'),
(14, '2018-12-27 03:24:41', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'tahunajaran_id', '1', '', '1'),
(15, '2018-12-27 03:24:41', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'sekolah_id', '1', '', '1'),
(16, '2018-12-27 03:24:41', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'kelas_id', '1', '', '1'),
(17, '2018-12-27 03:24:41', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'id', '1', '', '1'),
(18, '2018-12-27 03:28:41', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'tahunajaran_id', '2', '', '1'),
(19, '2018-12-27 03:28:41', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'sekolah_id', '2', '', '1'),
(20, '2018-12-27 03:28:41', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'kelas_id', '2', '', '2'),
(21, '2018-12-27 03:28:41', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'id', '2', '', '2'),
(22, '2018-12-27 03:28:54', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'tahunajaran_id', '3', '', '1'),
(23, '2018-12-27 03:28:54', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'sekolah_id', '3', '', '1'),
(24, '2018-12-27 03:28:54', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'kelas_id', '3', '', '3'),
(25, '2018-12-27 03:28:54', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'id', '3', '', '3'),
(26, '2018-12-27 03:29:09', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'tahunajaran_id', '4', '', '1'),
(27, '2018-12-27 03:29:09', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'sekolah_id', '4', '', '1'),
(28, '2018-12-27 03:29:09', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'kelas_id', '4', '', '4'),
(29, '2018-12-27 03:29:09', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'id', '4', '', '4'),
(30, '2018-12-27 03:31:15', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'tahunajaran_id', '5', '', '1'),
(31, '2018-12-27 03:31:15', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'sekolah_id', '5', '', '2'),
(32, '2018-12-27 03:31:15', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'kelas_id', '5', '', '11'),
(33, '2018-12-27 03:31:15', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'id', '5', '', '5'),
(34, '2018-12-27 03:31:32', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'tahunajaran_id', '6', '', '1'),
(35, '2018-12-27 03:31:32', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'sekolah_id', '6', '', '2'),
(36, '2018-12-27 03:31:32', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'kelas_id', '6', '', '12'),
(37, '2018-12-27 03:31:32', '/pembayaran6/t05_daftarsiswamasteradd.php', '1', 'A', 't05_daftarsiswamaster', 'id', '6', '', '6'),
(38, '2018-12-27 03:40:56', '/pembayaran6/t05_daftarsiswamasteredit.php', '1', '*** Batch update begin ***', 't06_daftarsiswadetail', '', '', '', ''),
(39, '2018-12-27 03:40:56', '/pembayaran6/t05_daftarsiswamasteredit.php', '1', 'A', 't06_daftarsiswadetail', 'daftarsiswamaster_id', '1', '', '1'),
(40, '2018-12-27 03:40:56', '/pembayaran6/t05_daftarsiswamasteredit.php', '1', 'A', 't06_daftarsiswadetail', 'siswa_id', '1', '', '2'),
(41, '2018-12-27 03:40:56', '/pembayaran6/t05_daftarsiswamasteredit.php', '1', 'A', 't06_daftarsiswadetail', 'id', '1', '', '1'),
(42, '2018-12-27 03:40:56', '/pembayaran6/t05_daftarsiswamasteredit.php', '1', 'A', 't06_daftarsiswadetail', 'daftarsiswamaster_id', '2', '', '1'),
(43, '2018-12-27 03:40:56', '/pembayaran6/t05_daftarsiswamasteredit.php', '1', 'A', 't06_daftarsiswadetail', 'siswa_id', '2', '', '3'),
(44, '2018-12-27 03:40:56', '/pembayaran6/t05_daftarsiswamasteredit.php', '1', 'A', 't06_daftarsiswadetail', 'id', '2', '', '2'),
(45, '2018-12-27 03:40:56', '/pembayaran6/t05_daftarsiswamasteredit.php', '1', '*** Batch update successful ***', 't06_daftarsiswadetail', '', '', '', ''),
(46, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', '*** Batch insert begin ***', 't09_siswarutin', '', '', '', ''),
(47, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'rutin_id', '1', '', '1'),
(48, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'tahunajaran_id', '1', '', '1'),
(49, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'nilai', '1', '', '150000'),
(50, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b01', '1', '', NULL),
(51, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't01', '1', '', '2018-12-27'),
(52, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b02', '1', '', NULL),
(53, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't02', '1', '', NULL),
(54, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b03', '1', '', NULL),
(55, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't03', '1', '', NULL),
(56, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b04', '1', '', NULL),
(57, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't04', '1', '', NULL),
(58, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b05', '1', '', NULL),
(59, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't05', '1', '', NULL),
(60, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b06', '1', '', NULL),
(61, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't06', '1', '', NULL),
(62, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b07', '1', '', NULL),
(63, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't07', '1', '', NULL),
(64, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b08', '1', '', NULL),
(65, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't08', '1', '', NULL),
(66, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b09', '1', '', NULL),
(67, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't09', '1', '', NULL),
(68, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b10', '1', '', NULL),
(69, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't10', '1', '', NULL),
(70, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b11', '1', '', NULL),
(71, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't11', '1', '', NULL),
(72, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b12', '1', '', NULL),
(73, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't12', '1', '', NULL),
(74, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'total', '1', '', '0'),
(75, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'siswa_id', '1', '', '2'),
(76, '2018-12-27 05:59:34', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'id', '1', '', '1'),
(77, '2018-12-27 05:59:35', '/pembayaran6/t09_siswarutinlist.php', '1', '*** Batch insert successful ***', 't09_siswarutin', '', '', '', ''),
(78, '2018-12-27 05:59:53', '/pembayaran6/t09_siswarutinedit.php', '1', 'U', 't09_siswarutin', 't01', '1', '2018-12-27', NULL),
(79, '2018-12-27 06:00:59', '/pembayaran6/t09_siswarutinedit.php', '1', 'U', 't09_siswarutin', 'b01', '1', NULL, 'S'),
(80, '2018-12-27 06:00:59', '/pembayaran6/t09_siswarutinedit.php', '1', 'U', 't09_siswarutin', 't01', '1', NULL, '2018-12-27'),
(81, '2018-12-27 06:12:00', '/pembayaran6/t09_siswarutinlist.php', '1', '*** Batch update begin ***', 't09_siswarutin', '', '', '', ''),
(82, '2018-12-27 06:12:00', '/pembayaran6/t09_siswarutinlist.php', '1', 'U', 't09_siswarutin', 'b01', '1', 'S', 'S,B'),
(83, '2018-12-27 06:12:00', '/pembayaran6/t09_siswarutinlist.php', '1', '*** Batch update successful ***', 't09_siswarutin', '', '', '', ''),
(84, '2018-12-27 06:12:36', '/pembayaran6/t09_siswarutinlist.php', '1', 'U', 't09_siswarutin', 'b01', '1', '', 'S'),
(85, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'rutin_id', '2', '', '2'),
(86, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'tahunajaran_id', '2', '', '1'),
(87, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'nilai', '2', '', '200000'),
(88, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b01', '2', '', NULL),
(89, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't01', '2', '', NULL),
(90, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b02', '2', '', NULL),
(91, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't02', '2', '', NULL),
(92, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b03', '2', '', NULL),
(93, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't03', '2', '', NULL),
(94, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b04', '2', '', NULL),
(95, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't04', '2', '', NULL),
(96, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b05', '2', '', NULL),
(97, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't05', '2', '', NULL),
(98, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b06', '2', '', NULL),
(99, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't06', '2', '', NULL),
(100, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b07', '2', '', NULL),
(101, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't07', '2', '', NULL),
(102, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b08', '2', '', NULL),
(103, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't08', '2', '', NULL),
(104, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b09', '2', '', NULL),
(105, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't09', '2', '', NULL),
(106, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b10', '2', '', NULL),
(107, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't10', '2', '', NULL),
(108, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b11', '2', '', NULL),
(109, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't11', '2', '', NULL),
(110, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'b12', '2', '', NULL),
(111, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 't12', '2', '', NULL),
(112, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'total', '2', '', '0'),
(113, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'siswa_id', '2', '', '2'),
(114, '2018-12-27 06:51:28', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'id', '2', '', '2'),
(115, '2018-12-27 12:33:43', '/pembayaran6/t09_siswarutinlist.php', '1', '*** Batch insert begin ***', 't09_siswarutin', '', '', '', ''),
(116, '2018-12-27 12:33:44', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'rutin_id', '3', '', '3'),
(117, '2018-12-27 12:33:44', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'tahunajaran_id', '3', '', '1'),
(118, '2018-12-27 12:33:44', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'nilai', '3', '', '300000'),
(119, '2018-12-27 12:33:44', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'Total', '3', '', '0'),
(120, '2018-12-27 12:33:44', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'siswa_id', '3', '', '3'),
(121, '2018-12-27 12:33:44', '/pembayaran6/t09_siswarutinlist.php', '1', 'A', 't09_siswarutin', 'id', '3', '', '3'),
(122, '2018-12-27 12:33:44', '/pembayaran6/t09_siswarutinlist.php', '1', '*** Batch insert successful ***', 't09_siswarutin', '', '', '', ''),
(123, '2018-12-27 14:03:25', '/pembayaran6/t07_sppadd.php', '1', 'A', 't07_spp', 'SPP', '1', '', 'Infaq'),
(124, '2018-12-27 14:03:25', '/pembayaran6/t07_sppadd.php', '1', 'A', 't07_spp', 'Jenis', '1', '', 'Rutin'),
(125, '2018-12-27 14:03:25', '/pembayaran6/t07_sppadd.php', '1', 'A', 't07_spp', 'id', '1', '', '1'),
(126, '2018-12-27 14:04:03', '/pembayaran6/t07_sppadd.php', '1', 'A', 't07_spp', 'SPP', '2', '', 'Catering'),
(127, '2018-12-27 14:04:03', '/pembayaran6/t07_sppadd.php', '1', 'A', 't07_spp', 'Jenis', '2', '', 'Rutin'),
(128, '2018-12-27 14:04:03', '/pembayaran6/t07_sppadd.php', '1', 'A', 't07_spp', 'id', '2', '', '2'),
(129, '2018-12-27 14:04:15', '/pembayaran6/t07_sppadd.php', '1', 'A', 't07_spp', 'SPP', '3', '', 'Worksheet'),
(130, '2018-12-27 14:04:15', '/pembayaran6/t07_sppadd.php', '1', 'A', 't07_spp', 'Jenis', '3', '', 'Rutin'),
(131, '2018-12-27 14:04:15', '/pembayaran6/t07_sppadd.php', '1', 'A', 't07_spp', 'id', '3', '', '3'),
(132, '2018-12-27 14:04:29', '/pembayaran6/t07_sppadd.php', '1', 'A', 't07_spp', 'SPP', '4', '', 'Beasiswa Infaq'),
(133, '2018-12-27 14:04:29', '/pembayaran6/t07_sppadd.php', '1', 'A', 't07_spp', 'Jenis', '4', '', 'Rutin'),
(134, '2018-12-27 14:04:29', '/pembayaran6/t07_sppadd.php', '1', 'A', 't07_spp', 'id', '4', '', '4'),
(135, '2018-12-27 14:04:56', '/pembayaran6/t07_sppadd.php', '1', 'A', 't07_spp', 'SPP', '5', '', 'Dana SPM BP3MNU'),
(136, '2018-12-27 14:04:56', '/pembayaran6/t07_sppadd.php', '1', 'A', 't07_spp', 'Jenis', '5', '', 'Non-Rutin'),
(137, '2018-12-27 14:04:56', '/pembayaran6/t07_sppadd.php', '1', 'A', 't07_spp', 'id', '5', '', '5'),
(138, '2018-12-27 14:05:08', '/pembayaran6/t07_sppadd.php', '1', 'A', 't07_spp', 'SPP', '6', '', 'Daftar Ulang'),
(139, '2018-12-27 14:05:08', '/pembayaran6/t07_sppadd.php', '1', 'A', 't07_spp', 'Jenis', '6', '', 'Non-Rutin'),
(140, '2018-12-27 14:05:08', '/pembayaran6/t07_sppadd.php', '1', 'A', 't07_spp', 'id', '6', '', '6'),
(141, '2018-12-27 14:08:28', '/pembayaran6/t08_siswaspplist.php', '1', '*** Batch insert begin ***', 't08_siswaspp', '', '', '', ''),
(142, '2018-12-27 14:08:28', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'tahunajaran_id', '1', '', '1'),
(143, '2018-12-27 14:08:28', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'spp_id', '1', '', '1'),
(144, '2018-12-27 14:08:28', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'Nilai', '1', '', '150000'),
(145, '2018-12-27 14:08:28', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'Terbayar', '1', '', '0'),
(146, '2018-12-27 14:08:28', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'Potensi', '1', '', '0'),
(147, '2018-12-27 14:08:28', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'siswa_id', '1', '', '2'),
(148, '2018-12-27 14:08:28', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'id', '1', '', '1'),
(149, '2018-12-27 14:08:29', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'tahunajaran_id', '2', '', '1'),
(150, '2018-12-27 14:08:29', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'spp_id', '2', '', '2'),
(151, '2018-12-27 14:08:29', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'Nilai', '2', '', '200000'),
(152, '2018-12-27 14:08:29', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'Terbayar', '2', '', '0'),
(153, '2018-12-27 14:08:29', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'Potensi', '2', '', '0'),
(154, '2018-12-27 14:08:29', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'siswa_id', '2', '', '2'),
(155, '2018-12-27 14:08:29', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'id', '2', '', '2'),
(156, '2018-12-27 14:08:29', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'tahunajaran_id', '3', '', '1'),
(157, '2018-12-27 14:08:29', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'spp_id', '3', '', '5'),
(158, '2018-12-27 14:08:29', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'Nilai', '3', '', '1000000'),
(159, '2018-12-27 14:08:29', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'Terbayar', '3', '', '0'),
(160, '2018-12-27 14:08:29', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'Potensi', '3', '', '0'),
(161, '2018-12-27 14:08:29', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'siswa_id', '3', '', '2'),
(162, '2018-12-27 14:08:29', '/pembayaran6/t08_siswaspplist.php', '1', 'A', 't08_siswaspp', 'id', '3', '', '3'),
(163, '2018-12-27 14:08:29', '/pembayaran6/t08_siswaspplist.php', '1', '*** Batch insert successful ***', 't08_siswaspp', '', '', '', ''),
(164, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't09_bayarmaster', 'siswa_id', '1', '', '2'),
(165, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't09_bayarmaster', 'tahunajaran_id', '1', '', '1'),
(166, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't09_bayarmaster', 'Tanggal', '1', '', '2018-12-27'),
(167, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't09_bayarmaster', 'NomorBayar', '1', '', 'BYR0001'),
(168, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't09_bayarmaster', 'Jumlah', '1', '', '0'),
(169, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't09_bayarmaster', 'id', '1', '', '1'),
(170, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', '*** Batch insert begin ***', 't10_bayardetail', '', '', '', ''),
(171, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'siswaspp_id', '1', '', '1'),
(172, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'Keterangan', '1', '', 'Juli 2018'),
(173, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'Jumlah', '1', '', '150000.00'),
(174, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'bayarmaster_id', '1', '', '1'),
(175, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'id', '1', '', '1'),
(176, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'siswaspp_id', '2', '', '1'),
(177, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'Keterangan', '2', '', 'Agustus 2018'),
(178, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'Jumlah', '2', '', '150000.00'),
(179, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'bayarmaster_id', '2', '', '1'),
(180, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'id', '2', '', '2'),
(181, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'siswaspp_id', '3', '', '3'),
(182, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'Keterangan', '3', '', 'Angsuran Ke-1'),
(183, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'Jumlah', '3', '', '250000'),
(184, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'bayarmaster_id', '3', '', '1'),
(185, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'id', '3', '', '3'),
(186, '2018-12-27 14:50:47', '/pembayaran6/t09_bayarmasteradd.php', '1', '*** Batch insert successful ***', 't10_bayardetail', '', '', '', ''),
(187, '2018-12-27 21:06:49', '/pembayaran6/t04_siswaadd.php', '1', 'A', 't04_siswa', 'NIS', '4', '', '180003'),
(188, '2018-12-27 21:06:49', '/pembayaran6/t04_siswaadd.php', '1', 'A', 't04_siswa', 'Nama', '4', '', 'Abdi'),
(189, '2018-12-27 21:06:49', '/pembayaran6/t04_siswaadd.php', '1', 'A', 't04_siswa', 'id', '4', '', '4'),
(190, '2018-12-27 21:06:49', '/pembayaran6/t04_siswaadd.php', '1', '*** Batch insert begin ***', 't08_siswaspp', '', '', '', ''),
(191, '2018-12-27 21:06:49', '/pembayaran6/t04_siswaadd.php', '1', 'A', 't08_siswaspp', 'tahunajaran_id', '4', '', '1'),
(192, '2018-12-27 21:06:49', '/pembayaran6/t04_siswaadd.php', '1', 'A', 't08_siswaspp', 'spp_id', '4', '', '1'),
(193, '2018-12-27 21:06:49', '/pembayaran6/t04_siswaadd.php', '1', 'A', 't08_siswaspp', 'Nilai', '4', '', '750000'),
(194, '2018-12-27 21:06:49', '/pembayaran6/t04_siswaadd.php', '1', 'A', 't08_siswaspp', 'Terbayar', '4', '', '0'),
(195, '2018-12-27 21:06:49', '/pembayaran6/t04_siswaadd.php', '1', 'A', 't08_siswaspp', 'Potensi', '4', '', '0'),
(196, '2018-12-27 21:06:49', '/pembayaran6/t04_siswaadd.php', '1', 'A', 't08_siswaspp', 'siswa_id', '4', '', '4'),
(197, '2018-12-27 21:06:49', '/pembayaran6/t04_siswaadd.php', '1', 'A', 't08_siswaspp', 'id', '4', '', '4'),
(198, '2018-12-27 21:06:49', '/pembayaran6/t04_siswaadd.php', '1', '*** Batch insert successful ***', 't08_siswaspp', '', '', '', ''),
(199, '2018-12-27 21:07:58', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't09_bayarmaster', 'siswa_id', '2', '', '4'),
(200, '2018-12-27 21:07:58', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't09_bayarmaster', 'tahunajaran_id', '2', '', '1'),
(201, '2018-12-27 21:07:58', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't09_bayarmaster', 'Tanggal', '2', '', '2018-12-27'),
(202, '2018-12-27 21:07:58', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't09_bayarmaster', 'NomorBayar', '2', '', 'BYR0002'),
(203, '2018-12-27 21:07:58', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't09_bayarmaster', 'Jumlah', '2', '', '0'),
(204, '2018-12-27 21:07:58', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't09_bayarmaster', 'id', '2', '', '2'),
(205, '2018-12-27 21:07:59', '/pembayaran6/t09_bayarmasteradd.php', '1', '*** Batch insert begin ***', 't10_bayardetail', '', '', '', ''),
(206, '2018-12-27 21:07:59', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'siswaspp_id', '4', '', '4'),
(207, '2018-12-27 21:07:59', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'Keterangan', '4', '', 'Juli 2018'),
(208, '2018-12-27 21:07:59', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'Jumlah', '4', '', '750000.00'),
(209, '2018-12-27 21:07:59', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'bayarmaster_id', '4', '', '2'),
(210, '2018-12-27 21:07:59', '/pembayaran6/t09_bayarmasteradd.php', '1', 'A', 't10_bayardetail', 'id', '4', '', '4'),
(211, '2018-12-27 21:07:59', '/pembayaran6/t09_bayarmasteradd.php', '1', '*** Batch insert successful ***', 't10_bayardetail', '', '', '', ''),
(212, '2018-12-29 13:11:33', '/pembayaran6/t06_daftarsiswadetailadd.php', '1', 'A', 't06_daftarsiswadetail', 'siswa_id', '3', '', '4'),
(213, '2018-12-29 13:11:33', '/pembayaran6/t06_daftarsiswadetailadd.php', '1', 'A', 't06_daftarsiswadetail', 'daftarsiswamaster_id', '3', '', '1'),
(214, '2018-12-29 13:11:33', '/pembayaran6/t06_daftarsiswadetailadd.php', '1', 'A', 't06_daftarsiswadetail', 'id', '3', '', '3');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v01_siswaspp`
-- (See below for the actual view)
--
CREATE TABLE `v01_siswaspp` (
`id` int(11)
,`siswa_id` int(11)
,`tahunajaran_id` int(11)
,`spp_id` int(11)
,`Nilai` float(14,2)
,`Terbayar` float(14,2)
,`Potensi` float(14,2)
,`SPP` varchar(100)
,`Jenis` enum('Rutin','Non-Rutin')
);

-- --------------------------------------------------------

--
-- Structure for view `v01_siswaspp`
--
DROP TABLE IF EXISTS `v01_siswaspp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v01_siswaspp`  AS  select `t08_siswaspp`.`id` AS `id`,`t08_siswaspp`.`siswa_id` AS `siswa_id`,`t08_siswaspp`.`tahunajaran_id` AS `tahunajaran_id`,`t08_siswaspp`.`spp_id` AS `spp_id`,`t08_siswaspp`.`Nilai` AS `Nilai`,`t08_siswaspp`.`Terbayar` AS `Terbayar`,`t08_siswaspp`.`Potensi` AS `Potensi`,`b`.`SPP` AS `SPP`,`b`.`Jenis` AS `Jenis` from (`t08_siswaspp` left join `t07_spp` `b` on((`t08_siswaspp`.`spp_id` = `b`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t01_tahunajaran`
--
ALTER TABLE `t01_tahunajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t02_sekolah`
--
ALTER TABLE `t02_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t03_kelas`
--
ALTER TABLE `t03_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t04_siswa`
--
ALTER TABLE `t04_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t05_daftarsiswamaster`
--
ALTER TABLE `t05_daftarsiswamaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t06_daftarsiswadetail`
--
ALTER TABLE `t06_daftarsiswadetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t07_spp`
--
ALTER TABLE `t07_spp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t08_siswaspp`
--
ALTER TABLE `t08_siswaspp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t09_bayarmaster`
--
ALTER TABLE `t09_bayarmaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t10_bayardetail`
--
ALTER TABLE `t10_bayardetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t95_periode`
--
ALTER TABLE `t95_periode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t96_employees`
--
ALTER TABLE `t96_employees`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `t97_userlevels`
--
ALTER TABLE `t97_userlevels`
  ADD PRIMARY KEY (`userlevelid`);

--
-- Indexes for table `t98_userlevelpermissions`
--
ALTER TABLE `t98_userlevelpermissions`
  ADD PRIMARY KEY (`userlevelid`,`tablename`);

--
-- Indexes for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t01_tahunajaran`
--
ALTER TABLE `t01_tahunajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t02_sekolah`
--
ALTER TABLE `t02_sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t03_kelas`
--
ALTER TABLE `t03_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t04_siswa`
--
ALTER TABLE `t04_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t05_daftarsiswamaster`
--
ALTER TABLE `t05_daftarsiswamaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t06_daftarsiswadetail`
--
ALTER TABLE `t06_daftarsiswadetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t07_spp`
--
ALTER TABLE `t07_spp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t08_siswaspp`
--
ALTER TABLE `t08_siswaspp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t09_bayarmaster`
--
ALTER TABLE `t09_bayarmaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t10_bayardetail`
--
ALTER TABLE `t10_bayardetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t95_periode`
--
ALTER TABLE `t95_periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t96_employees`
--
ALTER TABLE `t96_employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
