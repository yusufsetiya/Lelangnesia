-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2021 at 01:33 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lelang`
--

-- --------------------------------------------------------

--
-- Table structure for table `history_lelang`
--

CREATE TABLE `history_lelang` (
  `id_history` int(11) NOT NULL,
  `id_lelang` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `penawaran_harga` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_lelang`
--

INSERT INTO `history_lelang` (`id_history`, `id_lelang`, `id_barang`, `id_user`, `penawaran_harga`) VALUES
(26, 22, 44, 53, '100000'),
(27, 24, 46, 53, '300000000'),
(28, 22, 44, 54, '35000000000'),
(29, 23, 45, 54, '300000000'),
(33, 33, 54, 53, '40000000000'),
(37, 33, 54, 54, '50000000000'),
(38, 34, 55, 54, '100000'),
(40, 34, 55, 54, '500000'),
(41, 34, 55, 56, '600000'),
(42, 33, 54, 54, '60000000000');

-- --------------------------------------------------------

--
-- Table structure for table `m_banking`
--

CREATE TABLE `m_banking` (
  `id_banking` int(11) NOT NULL,
  `rekening` varchar(255) DEFAULT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `pin` varchar(255) DEFAULT NULL,
  `saldo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_banking`
--

INSERT INTO `m_banking` (`id_banking`, `rekening`, `kode`, `pin`, `saldo`) VALUES
(1, '332004300', '88900', '9268', '2699999999');

-- --------------------------------------------------------

--
-- Table structure for table `p_pembayaran`
--

CREATE TABLE `p_pembayaran` (
  `id_tampung` int(11) NOT NULL,
  `jumlah` varchar(255) DEFAULT NULL,
  `id_bayar` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_banking` int(11) DEFAULT NULL,
  `va` varchar(255) DEFAULT NULL,
  `rekening_p` varchar(255) DEFAULT NULL,
  `id_lelang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p_pembayaran`
--

INSERT INTO `p_pembayaran` (`id_tampung`, `jumlah`, `id_bayar`, `id_user`, `id_banking`, `va`, `rekening_p`, `id_lelang`) VALUES
(1, '35000000000', 1, 54, 1, '8939483486', '33906767', NULL),
(2, '300000000', 3, 54, 1, '11208939483374', '33906767', NULL),
(3, '300000000', 3, 54, 1, '11208939483374', '33906767', NULL),
(4, '300000000', 2, 53, 1, '8947385847', '332004300', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `foto` blob,
  `tgl` date DEFAULT NULL,
  `harga_awal` varchar(255) DEFAULT NULL,
  `deskripsi_barang` varchar(255) DEFAULT NULL,
  `status_lelang` enum('dibuka','ditutup','terjual') DEFAULT NULL,
  `status_barang` int(3) DEFAULT NULL,
  `petugas` int(30) DEFAULT NULL,
  `batas` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `nama_barang`, `foto`, `tgl`, `harga_awal`, `deskripsi_barang`, `status_lelang`, `status_barang`, `petugas`, `batas`) VALUES
(44, 'Roll Royce Ghost 2021', 0x63336562633932316364623639623435353433306237663933383239363233652e6a7067, '2021-04-17', '30000000000', 'Barang Super Mewah Limited edition, Hanya diproduksi 1 di dunia', 'terjual', 2, 23, '2021-04-18 05:39:36'),
(45, 'Ducati Penigale V4', 0x38393931393234303638343633356161613464316335376362363338323635342e6a7067, '2021-04-17', '200000000', 'Motor kelas atas dengan 1000 CC yang dipadukan dengan mesin DOHC dan sudah dilengkapi fitur Slipper Clutch', 'terjual', 2, 23, '2021-04-18 06:05:48'),
(46, 'Kawasaki ZX 25R ', 0x63396435636331303764333638366539386639653864663035653763306534312e6a7067, '2021-04-17', '110000000', 'Motor 4 silinder yang sedang naik daun, dengan desain gahar yang membuat ingin memiliki', 'terjual', 2, 30, '2021-04-19 05:03:57'),
(50, 'Daihatsu Hino 600', 0x65306535363962636262633438643765326239316562626435353835346432622e6a7067, '2021-04-18', '120000000', 'Truk Semen 6 WD dengan akselerasi yang mantap', 'dibuka', 1, 23, '2021-04-18 08:06:53'),
(53, 'coba', 0x62366434333932353431613033653535323639303336383965396663353434332e6a7067, '2021-04-18', '100000', 'coba', 'ditutup', 1, 31, '2021-04-18 09:53:21'),
(54, 'Mobil', 0x36393964643238663933376234363337613536623465613134636332313532352e6a7067, '2021-04-18', '100000000', 'Bagus', 'dibuka', 1, 30, '2021-04-18 19:14:34'),
(55, 'aaa', 0x39323739303337316533386136396339316138306235343765623034383262342e6a7067, '2021-04-18', '12000', '1212', 'ditutup', 3, 31, '2021-04-19 04:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lelang`
--

CREATE TABLE `tb_lelang` (
  `id_lelang` int(11) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tgl_lelang` date DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `batas` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('dibuka','ditutup') DEFAULT NULL,
  `harga_akhir` varchar(255) DEFAULT NULL,
  `waktu_menang` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_lelang`
--

INSERT INTO `tb_lelang` (`id_lelang`, `id_barang`, `id_user`, `tgl_lelang`, `id_petugas`, `batas`, `status`, `harga_akhir`, `waktu_menang`) VALUES
(22, 44, 54, '2021-04-17', 23, '2021-04-18 05:37:23', 'ditutup', '35000000000', '2021-04-18 05:37:23'),
(23, 45, 54, '2021-04-17', 23, '2021-04-18 05:56:18', 'ditutup', '300000000', '2021-04-18 05:56:18'),
(24, 46, 53, '2021-04-17', 30, '2021-04-18 05:37:38', 'ditutup', '300000000', '2021-04-18 05:37:38'),
(25, 47, NULL, '2021-04-18', 23, NULL, 'ditutup', NULL, NULL),
(26, 48, NULL, '2021-04-18', 23, NULL, 'ditutup', NULL, NULL),
(27, 49, NULL, '2021-04-18', 23, NULL, 'ditutup', NULL, NULL),
(28, 50, NULL, '2021-04-18', 23, '2021-04-20 08:05:00', 'dibuka', NULL, '2021-04-18 08:05:57'),
(29, 51, NULL, '2021-04-18', 31, '2021-04-19 10:53:00', 'dibuka', '', '2021-04-18 10:53:34'),
(30, 52, NULL, '2021-04-18', 30, '2021-04-18 08:05:48', 'ditutup', NULL, '2021-04-18 08:05:48'),
(31, 52, NULL, '2021-04-18', 31, NULL, 'ditutup', NULL, NULL),
(32, 53, NULL, '2021-04-18', 31, '2021-04-18 09:53:21', 'ditutup', NULL, '2021-04-18 09:53:21'),
(33, 54, NULL, '2021-04-18', 30, '2021-04-20 19:14:00', 'dibuka', '', '2021-04-18 19:14:34'),
(34, 55, 56, '2021-04-18', 31, '2021-04-19 04:59:16', 'ditutup', '600000', '2021-04-19 04:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `tb_level`
--

CREATE TABLE `tb_level` (
  `id_level` int(11) NOT NULL,
  `level` enum('administrator','petugas') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_level`
--

INSERT INTO `tb_level` (`id_level`, `level`) VALUES
(4, 'administrator'),
(5, 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `tb_masyarakat`
--

CREATE TABLE `tb_masyarakat` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `v_password` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `alamat` text,
  `tpt_lahir` varchar(255) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `wajah` blob,
  `ktp` blob,
  `nik` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `verif` int(3) DEFAULT NULL,
  `alasan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_masyarakat`
--

INSERT INTO `tb_masyarakat` (`id_user`, `nama_lengkap`, `username`, `password`, `v_password`, `telp`, `alamat`, `tpt_lahir`, `tgl`, `wajah`, `ktp`, `nik`, `gender`, `verif`, `alasan`) VALUES
(53, 'Wicaksana Yosia Putra Sejati', 'yosi', '30c13e77095e723a305013c4204637ae', 'yosi123', '08947385735', 'Tlogowaru Permai', 'Malang', '2004-04-08', 0x35633463313266356331303563396465356262626161643965393830313836632e6a7067, 0x30613166646566613036396462623033373137666432613163363330316662332e6a7067, '35625362736', 'Laki-Laki', 2, 'gakpopo'),
(54, 'Farhan', 'farhan', '1ac5012170b65fb99f171ad799d045ac', 'farhan123', '08939483374', 'Polehan', 'Malang', '2021-03-17', 0x61336334313965373634633465613536313731613734316539326337353364642e6a7067, 0x39306435393535336466306664346161306637353266636530343332636537342e6a706567, '42536236', 'Laki-Laki', 2, 'Curang'),
(56, 'Maulana Ziddan', 'Maulanaziddan', 'd0041971a8a8e1d704371af4059d3255', 'ziddan123', '087721015398', 'Jl. Brantas No.11 Malang', 'Malang', '2003-06-02', 0x31336462343661356633383932323030386165366331326133633564666134612e6a7067, 0x36393437353639656561313739626434613534353337306531653433396137372e6a7067, '3345626773624', 'Laki-Laki', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_bayar` int(11) NOT NULL,
  `id_lelang` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `status_bayar` enum('belum','sudah') DEFAULT NULL,
  `va` varchar(255) DEFAULT NULL,
  `rekening` varchar(255) DEFAULT NULL,
  `waktu_bayar` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) DEFAULT NULL,
  `jumlah_bayar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_bayar`, `id_lelang`, `id_barang`, `status_bayar`, `va`, `rekening`, `waktu_bayar`, `id_user`, `jumlah_bayar`) VALUES
(1, 22, 44, 'sudah', '8939483486', '33906767', '2021-04-18 05:39:36', 54, '35000000000'),
(2, 24, 46, 'sudah', '8947385847', '332004300', '2021-04-19 05:03:57', 53, '300000000'),
(3, 23, 45, 'sudah', '11208939483374', '33906767', '2021-04-18 06:05:48', 54, '300000000'),
(4, 34, 55, 'belum', '112087721015398', NULL, NULL, 56, '600000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `V_password` varchar(255) DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_petugas`
--

INSERT INTO `tb_petugas` (`id_petugas`, `nama_petugas`, `username`, `password`, `V_password`, `id_level`) VALUES
(23, 'admisisrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 4),
(30, 'Mochamad Yusuf', 'MochamadYusuf', 'add3deb05fc6625aae939041e4131624', 'yusuf123', 5),
(31, 'Ilham Soejud Alkhafiardy', 'ilhamsoejud', '57cf5ad49695e3adc1a29cf47a43bc06', 'ilham123', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history_lelang`
--
ALTER TABLE `history_lelang`
  ADD PRIMARY KEY (`id_history`);

--
-- Indexes for table `m_banking`
--
ALTER TABLE `m_banking`
  ADD PRIMARY KEY (`id_banking`);

--
-- Indexes for table `p_pembayaran`
--
ALTER TABLE `p_pembayaran`
  ADD PRIMARY KEY (`id_tampung`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tb_lelang`
--
ALTER TABLE `tb_lelang`
  ADD PRIMARY KEY (`id_lelang`);

--
-- Indexes for table `tb_level`
--
ALTER TABLE `tb_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indexes for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history_lelang`
--
ALTER TABLE `history_lelang`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `m_banking`
--
ALTER TABLE `m_banking`
  MODIFY `id_banking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `p_pembayaran`
--
ALTER TABLE `p_pembayaran`
  MODIFY `id_tampung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tb_lelang`
--
ALTER TABLE `tb_lelang`
  MODIFY `id_lelang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tb_level`
--
ALTER TABLE `tb_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
