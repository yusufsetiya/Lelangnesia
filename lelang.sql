/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100137
Source Host           : localhost:3306
Source Database       : lelang

Target Server Type    : MYSQL
Target Server Version : 100137
File Encoding         : 65001

Date: 2021-11-19 14:41:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for history_lelang
-- ----------------------------
DROP TABLE IF EXISTS `history_lelang`;
CREATE TABLE `history_lelang` (
  `id_history` int(11) NOT NULL AUTO_INCREMENT,
  `id_lelang` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `penawaran_harga` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_history`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of history_lelang
-- ----------------------------
INSERT INTO `history_lelang` VALUES ('99', '68', '89', '1', '400000000');
INSERT INTO `history_lelang` VALUES ('100', '67', '88', '1', '91000000');
INSERT INTO `history_lelang` VALUES ('103', '67', '88', '3', '95000000');
INSERT INTO `history_lelang` VALUES ('105', '78', '98', '3', '11500000');
INSERT INTO `history_lelang` VALUES ('107', '80', '100', '3', '52000000');
INSERT INTO `history_lelang` VALUES ('111', '80', '100', '1', '53000000');
INSERT INTO `history_lelang` VALUES ('112', '81', '101', '1', '89000000');
INSERT INTO `history_lelang` VALUES ('124', '67', '88', '3', '100000000');
INSERT INTO `history_lelang` VALUES ('127', '77', '97', '4', '11000000000');
INSERT INTO `history_lelang` VALUES ('129', '78', '98', '5', '12000000');
INSERT INTO `history_lelang` VALUES ('142', '83', '103', '6', '23000000');
INSERT INTO `history_lelang` VALUES ('143', '67', '88', '5', '200000000');
INSERT INTO `history_lelang` VALUES ('144', '67', '88', '5', '300000000');
INSERT INTO `history_lelang` VALUES ('145', '68', '89', '5', '500000000');

-- ----------------------------
-- Table structure for m_banking
-- ----------------------------
DROP TABLE IF EXISTS `m_banking`;
CREATE TABLE `m_banking` (
  `id_banking` int(11) NOT NULL AUTO_INCREMENT,
  `rekening` varchar(255) DEFAULT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `pin` varchar(255) DEFAULT NULL,
  `saldo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_banking`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_banking
-- ----------------------------
INSERT INTO `m_banking` VALUES ('1', '332004300', '88900', '9268', '9965000000');

-- ----------------------------
-- Table structure for p_pembayaran
-- ----------------------------
DROP TABLE IF EXISTS `p_pembayaran`;
CREATE TABLE `p_pembayaran` (
  `id_tampung` int(11) NOT NULL AUTO_INCREMENT,
  `jumlah` varchar(255) DEFAULT NULL,
  `id_bayar` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_banking` int(11) DEFAULT NULL,
  `va` varchar(255) DEFAULT NULL,
  `rekening_p` varchar(255) DEFAULT NULL,
  `id_lelang` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tampung`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of p_pembayaran
-- ----------------------------
INSERT INTO `p_pembayaran` VALUES ('23', null, null, null, '1', 'sasasw', '332004300', null);
INSERT INTO `p_pembayaran` VALUES ('24', '91000000', '37', '93', '1', '112089772536283', '332004300', null);
INSERT INTO `p_pembayaran` VALUES ('25', '100000000', '4', '1', '1', '6495087762836545', '332004300', null);
INSERT INTO `p_pembayaran` VALUES ('26', '400000000', '5', '1', '1', '5993087762836545', '332004300', null);
INSERT INTO `p_pembayaran` VALUES ('27', '111000000', '6', '1', '1', '2464087762836545', '332004300', null);
INSERT INTO `p_pembayaran` VALUES ('28', '111000000', '6', '1', '1', '2464087762836545', '332004300', null);
INSERT INTO `p_pembayaran` VALUES ('29', '12000000', '9', '5', '1', '5166089388477364', '332004300', null);
INSERT INTO `p_pembayaran` VALUES ('30', '23000000', '21', '6', '1', '7695089872536476', '332004300', null);

-- ----------------------------
-- Table structure for tb_barang
-- ----------------------------
DROP TABLE IF EXISTS `tb_barang`;
CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) DEFAULT NULL,
  `foto` blob,
  `tgl` date DEFAULT NULL,
  `harga_awal` varchar(255) DEFAULT NULL,
  `deskripsi_barang` varchar(255) DEFAULT NULL,
  `status_lelang` enum('dibuka','ditutup','terjual') DEFAULT NULL,
  `status_barang` int(3) DEFAULT NULL,
  `petugas` int(30) DEFAULT NULL,
  `batas` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_barang
-- ----------------------------
INSERT INTO `tb_barang` VALUES ('88', 'Kawasaki ZX25', 0x31623531386361366330663262663365353835616365303931616562616335642E6A7067, '2021-05-02', '90000000', 'Spesifikasi Keseluruhan :\r\n- Mesin Dengan 250 CC 4 Silinder\r\n- Tahun Pembuatan 2019\r\n- Fitur Unggulan :\r\n   * Slipper Clutch\r\n   * QuickShifter\r\n   * Launch Control', 'ditutup', '1', '23', '2021-05-18 09:57:36');
INSERT INTO `tb_barang` VALUES ('89', 'Ducati Penigale V4', 0x65633765663363626465656539356464346536643563393434383165303164622E6A7067, '2021-05-02', '500000000', 'Spesifikasi Keseluruhan :\r\n- Mesin 1000 CC 4 Silinder\r\n- Tahun Pembuatan 2018\r\n- Fitur Unggulan :\r\n   * Launch Control\r\n   * Slipper Clutch\r\n   * QuickShifter\r\n   * Rem Cakram\r\n   * Kopling Kering', 'ditutup', '1', '23', '2021-05-18 09:57:36');
INSERT INTO `tb_barang` VALUES ('98', 'Lukisan Diponegoro', 0x64313566616365333134316639623035623163623439366139303165313932322E6A7067, '2021-05-03', '10000000', 'Lukisan langka karya Sudjono dirjosisworo, dibuat pada tahun 1985 dengan lama pembuatan 2 bulan.', 'ditutup', '1', '23', '2021-05-18 09:57:36');
INSERT INTO `tb_barang` VALUES ('100', 'Toyota Inova', 0x65306131373631616338323731383230653835353066666261353536313239642E6A7067, '2021-05-03', '50000000', 'Spesifikasi :\r\n- Tahun Pembuatan 2010\r\n- Mesin Normal\r\n- Pajak Panjang\r\n- Surat Surat Lengkap', 'ditutup', '1', '37', '2021-05-06 10:54:30');
INSERT INTO `tb_barang` VALUES ('101', 'Toyota Rush', 0x30643336376163393730306631313134623363303732646336326233646464652E6A7067, '2021-05-03', '87000000', 'Spesifikasi : \r\n- Tahun Pembuatan 2017\r\n- Mesin Normal\r\n- Pajak Panjang\r\n- Surat Surat Lengkap\r\n- Plat Blitar Kota', 'ditutup', '1', '37', '2021-06-06 20:21:04');
INSERT INTO `tb_barang` VALUES ('102', 'Lukisan Van Gogh', 0x61643962656133613230626436323539636465653239663133336231316439332E6A7067, '2021-05-03', '50000000', 'Lukisan bersejarah di dunia yang dibuat oleh salah satu pelukis ternama dinia yaitu Alexander Van gogh.', 'ditutup', '1', '37', '2021-05-06 10:06:53');
INSERT INTO `tb_barang` VALUES ('103', 'Yamaha Aerox', 0x63313139333066313761346430396339323836356538366563613830373865622E6A7067, '2021-05-03', '20000000', 'Spesifikasi :\r\n- Tahun Pembuatan 2020\r\n- Tenaga mesin 155 CC\r\n- Plat Jakarta Kota\r\n- Pajak panjang\r\n- Surat surat lengkap', 'terjual', '2', '37', '2021-05-06 11:04:33');
INSERT INTO `tb_barang` VALUES ('104', 'Revo fit 2008', 0x65353462316237306662306564363834393932646430653234316232336134652E6A7067, '2021-05-03', '5000000', 'Spesifikasi :\r\n- Tahun Pembuatan 2008\r\n- Pajak panjang\r\n- Surat surat lengkap\r\n- mesin 110 CC', 'ditutup', '1', '37', '2021-05-10 20:12:20');

-- ----------------------------
-- Table structure for tb_kode
-- ----------------------------
DROP TABLE IF EXISTS `tb_kode`;
CREATE TABLE `tb_kode` (
  `id_kode` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `kode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_kode
-- ----------------------------

-- ----------------------------
-- Table structure for tb_lelang
-- ----------------------------
DROP TABLE IF EXISTS `tb_lelang`;
CREATE TABLE `tb_lelang` (
  `id_lelang` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tgl_lelang` date DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `batas` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('dibuka','ditutup') DEFAULT NULL,
  `harga_akhir` varchar(255) DEFAULT NULL,
  `waktu_menang` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_lelang`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_lelang
-- ----------------------------
INSERT INTO `tb_lelang` VALUES ('67', '88', '1', '2021-05-02', '33', '2021-05-18 09:57:36', 'ditutup', '111000000', '2021-05-18 09:57:36');
INSERT INTO `tb_lelang` VALUES ('68', '89', '1', '2021-05-02', '33', '2021-05-18 09:57:36', 'ditutup', '400000000', '2021-05-18 09:57:36');
INSERT INTO `tb_lelang` VALUES ('69', '90', null, '2021-05-03', '23', null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('70', '90', null, '2021-05-03', null, null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('71', '91', null, '2021-05-03', null, null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('72', '92', null, '2021-05-03', '23', null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('73', '93', null, '2021-05-03', '23', null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('74', '94', null, '2021-05-03', null, null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('75', '95', null, '2021-05-03', null, null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('76', '96', null, '2021-05-03', null, null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('77', '97', '0', '2021-05-03', '33', '2021-05-06 06:59:00', 'dibuka', '', '2021-05-04 06:59:29');
INSERT INTO `tb_lelang` VALUES ('78', '98', '5', '2021-05-03', '33', '2021-05-18 09:57:36', 'ditutup', '12000000', '2021-05-18 09:57:36');
INSERT INTO `tb_lelang` VALUES ('79', '99', '23', '2021-05-03', '33', '2021-05-22 09:50:00', 'dibuka', '10000', '2021-05-06 09:50:31');
INSERT INTO `tb_lelang` VALUES ('80', '100', null, '2021-05-03', '33', '2021-05-06 10:54:30', 'ditutup', null, '2021-05-06 10:54:30');
INSERT INTO `tb_lelang` VALUES ('81', '101', '0', '2021-05-03', '37', '2021-06-06 20:21:02', 'ditutup', '', '2021-06-06 20:21:02');
INSERT INTO `tb_lelang` VALUES ('82', '102', '0', '2021-05-03', '33', '2021-05-06 10:07:16', 'ditutup', '', '2021-05-06 10:07:16');
INSERT INTO `tb_lelang` VALUES ('83', '103', '6', '2021-05-03', '33', '2021-05-06 11:02:44', 'ditutup', '23000000', '2021-05-06 11:02:39');
INSERT INTO `tb_lelang` VALUES ('84', '104', '0', '2021-05-03', '33', '2021-05-10 20:12:28', 'ditutup', '', '2021-05-10 20:12:28');
INSERT INTO `tb_lelang` VALUES ('85', '105', '0', '2021-05-03', '33', '2021-05-08 10:27:00', 'dibuka', '', '2021-05-06 10:27:41');
INSERT INTO `tb_lelang` VALUES ('86', '106', null, '2021-05-03', '33', '2021-05-08 10:18:00', 'dibuka', '', '2021-05-06 10:19:01');
INSERT INTO `tb_lelang` VALUES ('87', '107', null, '2021-05-03', '23', null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('88', '108', null, '2021-05-03', '23', null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('89', '107', null, '2021-05-04', '23', null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('90', '108', null, '2021-05-04', '23', null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('91', '109', null, '2021-05-04', '23', null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('92', '110', null, '2021-05-04', '23', null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('93', '107', null, '2021-05-06', null, null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('94', '107', null, '2021-05-06', null, null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('100', '111', null, '2021-05-06', null, null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('101', '111', null, '2021-05-06', null, null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('102', '112', null, '2021-05-06', null, null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('103', '113', null, '2021-05-06', null, null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('104', '114', null, '2021-05-06', null, null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('105', '115', null, '2021-05-06', null, null, 'ditutup', null, null);
INSERT INTO `tb_lelang` VALUES ('106', '116', null, '2021-05-06', '33', '2021-05-08 10:35:00', 'dibuka', null, '2021-05-06 10:35:49');

-- ----------------------------
-- Table structure for tb_level
-- ----------------------------
DROP TABLE IF EXISTS `tb_level`;
CREATE TABLE `tb_level` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `level` enum('administrator','petugas') DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_level
-- ----------------------------
INSERT INTO `tb_level` VALUES ('4', 'administrator');
INSERT INTO `tb_level` VALUES ('5', 'petugas');

-- ----------------------------
-- Table structure for tb_masyarakat
-- ----------------------------
DROP TABLE IF EXISTS `tb_masyarakat`;
CREATE TABLE `tb_masyarakat` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `v_password` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` text,
  `tpt_lahir` varchar(255) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `wajah` blob,
  `ktp` blob,
  `nik` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `verif` int(3) DEFAULT NULL,
  `alasan` text,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_masyarakat
-- ----------------------------
INSERT INTO `tb_masyarakat` VALUES ('1', 'Wicaksana Yosia Putra Sejati', 'yosia', 'bebceff7cb66cf7232478306cba94d8e', 'yosi', '087762836545', 'okelah@gmail.com', 'Perumahan Graha Tlogowaru Permai Blok C', 'Malang', '2003-07-09', 0x34656536383064333565626661306434393239373637333238636362333530312E6A7067, 0x30363433336537306562633461336562633538653331363232303035303431302E6A706567, '345556231898777', 'Laki-Laki', '2', 'Anda 3 kali melakukan pelanggaran', '2');
INSERT INTO `tb_masyarakat` VALUES ('3', 'Ilham Soejud', 'soejud', 'bebceff7cb66cf7232478306cba94d8e', 'yosi', '0899928829917', 'yusufsetiy22@gmail.com', null, null, null, null, null, null, null, '2', null, '2');
INSERT INTO `tb_masyarakat` VALUES ('5', 'Mochamad yusuf', 'yusuf', 'add3deb05fc6625aae939041e4131624', 'yusuf123', '089388477364', 'yusufsetiya6@gmail.com', 'Jl. semanggi', 'Malang', '2001-04-04', 0x39623931346563313230613733303336653430633561323564623365326239372E6A7067, 0x32326664323239343566393033663939333632366666633363626433373665342E6A7067, '43535253434', 'Laki-Laki', '2', null, '2');
INSERT INTO `tb_masyarakat` VALUES ('6', 'Rizki Perdana Affandy', 'rizki', '9592638716b04b52fe6e041429822a79', 'rizki123', '089872536476', 'yusufuyaimub87@gmail.com', 'Jl. Semanggi No.11', 'Malang', '2002-04-04', 0x62346563346562303337636661363731646438613064653530373732626565312E6A7067, 0x65663432333236666466383930366238343533373935346166373330383731372E6A7067, '356772882917', 'Laki-Laki', '2', null, '2');

-- ----------------------------
-- Table structure for tb_pembayaran
-- ----------------------------
DROP TABLE IF EXISTS `tb_pembayaran`;
CREATE TABLE `tb_pembayaran` (
  `id_bayar` int(11) NOT NULL AUTO_INCREMENT,
  `id_lelang` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `status_bayar` enum('belum','sudah') DEFAULT NULL,
  `va` varchar(255) DEFAULT NULL,
  `rekening` varchar(255) DEFAULT NULL,
  `waktu_bayar` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) DEFAULT NULL,
  `jumlah_bayar` varchar(255) DEFAULT NULL,
  `batas_bayar` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_bayar`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_pembayaran
-- ----------------------------
INSERT INTO `tb_pembayaran` VALUES ('5', '68', '89', 'sudah', '5993087762836545', '332004300', '2021-05-03 14:04:03', '1', '400000000', '2024-01-28 14:04:03');
INSERT INTO `tb_pembayaran` VALUES ('6', '67', '88', 'sudah', '2464087762836545', '332004300', '2021-05-04 06:53:56', '1', '111000000', '2024-01-29 06:53:56');
INSERT INTO `tb_pembayaran` VALUES ('9', '78', '98', 'sudah', '5166089388477364', '332004300', '2021-05-04 12:43:15', '5', '12000000', '2024-01-29 12:43:15');
INSERT INTO `tb_pembayaran` VALUES ('21', '83', '103', 'sudah', '7695089872536476', '332004300', '2021-05-06 11:04:33', '6', '23000000', '2024-01-31 11:04:33');

-- ----------------------------
-- Table structure for tb_petugas
-- ----------------------------
DROP TABLE IF EXISTS `tb_petugas`;
CREATE TABLE `tb_petugas` (
  `id_petugas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_petugas` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `V_password` varchar(255) DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `is_delete` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_petugas`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_petugas
-- ----------------------------
INSERT INTO `tb_petugas` VALUES ('23', 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '4', null, '1');
INSERT INTO `tb_petugas` VALUES ('33', 'Ilham Soejud Alkahfiardy', 'ilhamsoejud', '57cf5ad49695e3adc1a29cf47a43bc06', 'ilham123', '5', '89077678256', '1');
INSERT INTO `tb_petugas` VALUES ('34', 'Mosa Elsada', 'mosaelsada', 'f3fd091774c2247c6c261285a204a346', 'mosa123', '5', null, '1');
INSERT INTO `tb_petugas` VALUES ('35', 'Farhan Nafis Darmawan', 'farhan', '1ac5012170b65fb99f171ad799d045ac', 'farhan123', '5', null, '1');
INSERT INTO `tb_petugas` VALUES ('36', 'Rizki Perdana Affandi', 'rizkiperdana', '9592638716b04b52fe6e041429822a79', 'rizki123', '5', null, '1');
INSERT INTO `tb_petugas` VALUES ('37', 'Kevin Rizal Putra Rohmansyah', 'kevinrizal', 'd2e7a2105d0fb461fe6f2858cc33942f', 'kevin123', '5', '877889988781', '2');
INSERT INTO `tb_petugas` VALUES ('39', 'Kevin Rizal', 'kevinrizal', 'd2e7a2105d0fb461fe6f2858cc33942f', 'kevin123', '5', null, '1');
DROP TRIGGER IF EXISTS `berhasil_pilih_pemenang`;
DELIMITER ;;
CREATE TRIGGER `berhasil_pilih_pemenang` AFTER INSERT ON `tb_pembayaran` FOR EACH ROW UPDATE tb_barang SET status_barang='3', status_lelang='ditutup'
WHERE id_barang= NEW.id_barang
;;
DELIMITER ;
