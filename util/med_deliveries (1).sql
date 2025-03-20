-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table med_deliveries.account
CREATE TABLE IF NOT EXISTS `account` (
  `accountId` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `recovery_token` varchar(100) DEFAULT NULL,
  `verify_token` varchar(100) DEFAULT NULL,
  `isVerify` tinyint NOT NULL DEFAULT '0',
  `isLogin` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`accountId`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table med_deliveries.account: ~12 rows (approximately)
INSERT INTO `account` (`accountId`, `email`, `username`, `password`, `user_type`, `recovery_token`, `verify_token`, `isVerify`, `isLogin`) VALUES
	(18, 'Nat@gmail.com', 'nat123', '$2y$10$AgzkzuGuQAd68rYE2tELjO4ICWWKlJ4tOONQqiMbxce/adG6nKQKW', 'deliveries', NULL, NULL, 1, 1),
	(19, 'jeremy@gmail.com', 'Jeremy', '$2y$10$AgzkzuGuQAd68rYE2tELjO4ICWWKlJ4tOONQqiMbxce/adG6nKQKW', 'Admin', NULL, NULL, 1, 1),
	(20, 'dfs@gmail.com', 'wer', '$2y$10$KJq223QQR3MqQn/ZqV/piO.VtC4/Hk.w37cenr7AJyZNIlGuSYvG2', 'deliveries', NULL, NULL, 1, 0),
	(21, 'bohol@gmail.com', 'Bohol123', '$2y$10$BPfJ5shL4vEXkyQ8GBXprOU7oRWpwPWOxVRAJu/MDRgUp9Qovpw/G', 'barangay_inc', NULL, NULL, 1, 1),
	(22, 'Shanesy@gmail.com', 'Shane12', '$2y$10$kHrpTJoZSE/njTm2cGa4JOPA74JK18UrSxKHEGAOBcRPVYtk4b7f.', 'city_health', NULL, NULL, 1, 0),
	(23, 'ex@gmail.com', 'ex123', '$2y$10$3wPURXiLXynaLwY0wLd.oOkwk/5kgGS93mf94PtvH7yj1c7gyOahW', 'deliveries', NULL, NULL, 1, 1),
	(24, 'dsdf@gmail.com', 'ex3', '$2y$10$h163WYAfbYQHSOHWhLljPOpGFJY1zzZ.9ZwlJedhUNCwqRFOo8EFW', 'deliveries', NULL, NULL, 1, 0),
	(25, 'jhane@gmail.com', 'jhane45', '$2y$10$7ktE3L4DhjUOuyEzNU9wSueeRkl.8h0R6fXbRoXN8D66CpceYJQgC', 'city_health', NULL, NULL, 1, 0),
	(31, 'erscds@gmail.com', 'lok123', '$2y$10$leD496WGIaeJISiDpZaEz.442XMHWP/81sgBRjxi8OOBQ2Xc33zbi', 'barangay_inc', NULL, NULL, 1, 1),
	(32, 'lo@gmail.com', 'lop123', '$2y$10$leD496WGIaeJISiDpZaEz.442XMHWP/81sgBRjxi8OOBQ2Xc33zbi', 'barangay_inc', NULL, NULL, 1, 0),
	(33, 'hala@gmail.com', 'del12', '$2y$10$nyUFjpcAT76udPPSyCXhceotUMbCIvvJHUqjP0T8WQBraPauRC2vS', 'deliveries', NULL, NULL, 1, 1),
	(37, 'ladyglittersmackles@gmail.com', 'anuada_1990', '$2y$12$LHO7P5.qZud12jDHLJJBO.9oXz0XzjO7jYSN2MeJIYqZId80oFX1W', 'barangay_inc', '', '', 1, 0);

-- Dumping structure for table med_deliveries.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `accountId` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `DOB` date NOT NULL,
  `contactNo` varchar(11) NOT NULL,
  `id_verification` varchar(100) NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table med_deliveries.admin: ~0 rows (approximately)
INSERT INTO `admin` (`accountId`, `fname`, `lname`, `address`, `DOB`, `contactNo`, `id_verification`) VALUES
	(19, 'Jeremy', 'Gamboa', 'Emall St. Cebu city', '2024-12-03', '09695327153', '18.png');

-- Dumping structure for table med_deliveries.barangay_inc
CREATE TABLE IF NOT EXISTS `barangay_inc` (
  `accountId` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contactNo` varchar(11) NOT NULL,
  `id_verification` varchar(100) NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `barangay_inc_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table med_deliveries.barangay_inc: ~2 rows (approximately)
INSERT INTO `barangay_inc` (`accountId`, `fname`, `lname`, `address`, `contactNo`, `id_verification`) VALUES
	(31, 'dsfsf', 'sdfsf', 'sdfsf', '564', ''),
	(32, 'dsfs', 'sf', 'ldsld', '4353', '32.png'),
	(37, 'Ericson', 'Anuada', 'Floptropica', '09192939282', '../assets/img/profile/barangay_incharge/37.png');

-- Dumping structure for table med_deliveries.city_health
CREATE TABLE IF NOT EXISTS `city_health` (
  `accountId` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contactNo` varchar(11) NOT NULL,
  `id_verification` varchar(100) NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `city_health_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table med_deliveries.city_health: ~3 rows (approximately)
INSERT INTO `city_health` (`accountId`, `fname`, `lname`, `address`, `contactNo`, `id_verification`) VALUES
	(22, 'Shanesy', 'Gabato', 'Mountain St. Cebu City', '093453243', '22.png'),
	(25, 'Jhane', 'Heralis', 'Availia St. Cebu City', '90884', '');

-- Dumping structure for table med_deliveries.deliveries
CREATE TABLE IF NOT EXISTS `deliveries` (
  `accountId` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contactNo` varchar(100) NOT NULL,
  `id_verification` varchar(100) NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `deliveries_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- Dumping data for table med_deliveries.deliveries: ~4 rows (approximately)
INSERT INTO `deliveries` (`accountId`, `fname`, `lname`, `address`, `contactNo`, `id_verification`) VALUES
	(18, 'Nathaniel', 'Quezon', 'Lorega', '0987888', '18.png'),
	(20, 'Daniel', 'Anuada', 'zapatera', '4564', '20.png'),
	(23, 'Exmple', 'sss', 'dkjkad', '44444', ''),
	(33, 'sdsd', 'sadad', 'dssf', '4353', '33.png');

-- Dumping structure for table med_deliveries.med_availabilty
CREATE TABLE IF NOT EXISTS `med_availabilty` (
  `id` int NOT NULL AUTO_INCREMENT,
  `med_name` varchar(100) NOT NULL,
  `med_description` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiry_date` datetime NOT NULL,
  `med_image` varchar(250) NOT NULL,
  `DosageForm` varchar(100) NOT NULL,
  `DosageStrength` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `city_health_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_health_id` (`city_health_id`),
  CONSTRAINT `med_availabilty_ibfk_1` FOREIGN KEY (`city_health_id`) REFERENCES `city_health` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table med_deliveries.med_availabilty: ~2 rows (approximately)
INSERT INTO `med_availabilty` (`id`, `med_name`, `med_description`, `quantity`, `date`, `expiry_date`, `med_image`, `DosageForm`, `DosageStrength`, `category`, `city_health_id`) VALUES
	(12, 'Paricetamol', 'Used to reduce fever and relieve mild pain', '10 tablets per blister pack, 100ml bottle', '2025-03-14 10:29:08', '2025-03-29 00:00:00', '../assets/img/med_image/22.png', 'Tablet, Capsule, Syrup, Injection', '500mg, 10mg, 250mg/5ml syrup', 'Antibiotic, Pain Reliever, Antihypertensive', 22),
	(13, 'Biogesic', 'Used to reduce fever and relieve mild pain, etc', '11', '2025-03-14 10:33:47', '2025-03-11 00:00:00', '../assets/img/med_image/22.png', 'Tablet, Capsule, Syrup, Injection, etc.', '500mg, 10mg, 250mg/5ml syrup,syrup', 'Antibiotic, Pain Reliever, Antihypertensive,  etc', 22);

-- Dumping structure for table med_deliveries.request_med
CREATE TABLE IF NOT EXISTS `request_med` (
  `id` int NOT NULL AUTO_INCREMENT,
  `city_health_id` int NOT NULL,
  `barangay_inc_id` int NOT NULL,
  `med_avail_Id` int NOT NULL,
  `request_quantity` varchar(100) NOT NULL,
  `request_category` varchar(100) NOT NULL,
  `request_DosageForm` varchar(100) NOT NULL,
  `request_DosageStrength` varchar(100) NOT NULL,
  `requestStatus` enum('Pending','Accepted','Cancelled','') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_health_id` (`city_health_id`),
  KEY `barangay_inc_id` (`barangay_inc_id`),
  KEY `med_avail_Id` (`med_avail_Id`),
  CONSTRAINT `request_med_ibfk_1` FOREIGN KEY (`city_health_id`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `request_med_ibfk_2` FOREIGN KEY (`barangay_inc_id`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `request_med_ibfk_3` FOREIGN KEY (`med_avail_Id`) REFERENCES `med_availabilty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table med_deliveries.request_med: ~5 rows (approximately)
INSERT INTO `request_med` (`id`, `city_health_id`, `barangay_inc_id`, `med_avail_Id`, `request_quantity`, `request_category`, `request_DosageForm`, `request_DosageStrength`, `requestStatus`) VALUES
	(11, 22, 31, 13, '09', 'Biogesic', 'tablet', 'mg', 'Pending'),
	(12, 22, 31, 13, '90', 'Flu', 'Tablet', 'ml', 'Pending'),
	(13, 22, 32, 12, '45666', 'Flu', 'Syrup', 'ml', 'Pending'),
	(14, 22, 31, 13, '90', 'Flu', 'Tablet', 'mg', 'Pending'),
	(15, 22, 31, 13, '7878', 'jkkl', 'sz', 'pj', 'Pending');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
