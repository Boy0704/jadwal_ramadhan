/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MariaDB
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : db_jadwal_ramadhan

 Target Server Type    : MariaDB
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 21/03/2020 07:40:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for a_user
-- ----------------------------
DROP TABLE IF EXISTS `a_user`;
CREATE TABLE `a_user`  (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `level` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'default.png',
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of a_user
-- ----------------------------
INSERT INTO `a_user` VALUES (2, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'default.png');

-- ----------------------------
-- Table structure for jadwal
-- ----------------------------
DROP TABLE IF EXISTS `jadwal`;
CREATE TABLE `jadwal`  (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `kegiatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_mubaligh` int(11) NULL DEFAULT NULL,
  `id_masjid` int(11) NULL DEFAULT NULL,
  `date` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for kecamatan
-- ----------------------------
DROP TABLE IF EXISTS `kecamatan`;
CREATE TABLE `kecamatan`  (
  `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kecamatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_kecamatan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kecamatan
-- ----------------------------
INSERT INTO `kecamatan` VALUES (1, 'Bukit Bestari');
INSERT INTO `kecamatan` VALUES (2, 'Tanjung Pinang Timur');
INSERT INTO `kecamatan` VALUES (3, 'Tanjung Pinang Kota');
INSERT INTO `kecamatan` VALUES (4, 'Tanjung Pinang Barat');

-- ----------------------------
-- Table structure for kelurahan
-- ----------------------------
DROP TABLE IF EXISTS `kelurahan`;
CREATE TABLE `kelurahan`  (
  `id_kelurahan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelurahan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_kecamatan` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_kelurahan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kelurahan
-- ----------------------------
INSERT INTO `kelurahan` VALUES (1, 'Kel. Sei Jang', 1);
INSERT INTO `kelurahan` VALUES (2, 'Kel.  Tpi Timur', 1);
INSERT INTO `kelurahan` VALUES (3, 'Kel.  Tanjung Unggat', 1);
INSERT INTO `kelurahan` VALUES (5, 'Kel. Tanjung Ayun Sakti', 1);
INSERT INTO `kelurahan` VALUES (6, 'Kel. Dompak', 1);
INSERT INTO `kelurahan` VALUES (7, 'Batu 9', 2);
INSERT INTO `kelurahan` VALUES (9, 'Pinang Kencana', 2);
INSERT INTO `kelurahan` VALUES (10, 'Melayu Kota Piring', 2);
INSERT INTO `kelurahan` VALUES (11, 'Kampung bulang', 2);
INSERT INTO `kelurahan` VALUES (12, 'Tanjungpinang Kota', 3);
INSERT INTO `kelurahan` VALUES (13, 'Kampung Bugis', 3);
INSERT INTO `kelurahan` VALUES (14, 'Senggarang', 3);
INSERT INTO `kelurahan` VALUES (15, 'Penyengat', 3);

-- ----------------------------
-- Table structure for masjid
-- ----------------------------
DROP TABLE IF EXISTS `masjid`;
CREATE TABLE `masjid`  (
  `id_masjid` int(11) NOT NULL AUTO_INCREMENT,
  `nama_masjid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pengurus` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `telp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_kelurahan` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_masjid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mubaligh
-- ----------------------------
DROP TABLE IF EXISTS `mubaligh`;
CREATE TABLE `mubaligh`  (
  `id_mubaligh` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jenis_kelamin` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pekerjaan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kantor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat_rumah` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `telp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_mubaligh`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for setting_jadwal
-- ----------------------------
DROP TABLE IF EXISTS `setting_jadwal`;
CREATE TABLE `setting_jadwal`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `awal_ramadhan` date NULL DEFAULT NULL,
  `akhir_ramadhan` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
