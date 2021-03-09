-- --------------------------------------------------------
-- Host:                         b8rkwqqp7tbpt89flosy-mysql.services.clever-cloud.com
-- Server version:               8.0.15-5 - Exherbo
-- Server OS:                    Linux
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for b8rkwqqp7tbpt89flosy
CREATE DATABASE IF NOT EXISTS `b8rkwqqp7tbpt89flosy` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `b8rkwqqp7tbpt89flosy`;

-- Dumping structure for table b8rkwqqp7tbpt89flosy.afk_user_data
CREATE TABLE IF NOT EXISTS `afk_user_data` (
  `userid` varchar(50) DEFAULT NULL,
  `time_afk` longtext,
  `alasan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `username` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table b8rkwqqp7tbpt89flosy.afk_user_data: ~0 rows (approximately)
/*!40000 ALTER TABLE `afk_user_data` DISABLE KEYS */;
INSERT INTO `afk_user_data` (`userid`, `time_afk`, `alasan`, `username`) VALUES
	('1393342467', '07:04:24', 'ulangan susulan pas klas 9', 'fadhil_riyanto');
/*!40000 ALTER TABLE `afk_user_data` ENABLE KEYS */;

-- Dumping structure for table b8rkwqqp7tbpt89flosy.data_ai
CREATE TABLE IF NOT EXISTS `data_ai` (
  `data_key_ai` longtext NOT NULL,
  `data_res_ai` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table b8rkwqqp7tbpt89flosy.data_ai: ~5.357 rows (approximately)
/*!40000 ALTER TABLE `data_ai` DISABLE KEYS */;
