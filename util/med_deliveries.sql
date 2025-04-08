-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: med_deliveries
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `account` (
  `accountId` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `user_type` enum('admin','barangay_inc','city_health','deliveries') COLLATE utf8mb4_general_ci NOT NULL,
  `recovery_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `verify_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isVerify` tinyint NOT NULL DEFAULT '0',
  `isLogin` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`accountId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES ('102f4343-7843-4b85-bb49-05841e4811b3','hahah_roap@mailinator.com','hahah_roap','$2y$12$azxWhzyXV8It.3f6Zz9kHO5p71DFMQCgF6WWJzWZsDWYJzY8NOQKq','city_health',NULL,'',1,0,'2025-04-08 03:01:18'),('2f0444ac-230a-480e-9c4e-d5f68ccfe069','arizonamaine@mailinator.com','arizonamaine','$2y$12$CgDPRB1aiVkujYnzrcSZyeaVZ0IDXpcU4QSU8WH7vTH9wrfN9VUEW','barangay_inc',NULL,'',1,0,'2025-04-08 09:19:57'),('343e3676-6281-45d4-ab39-25eb15909b8b','janesmith@mailinator.com','janesmith','$2y$12$UEDCn08E9aDLAeJSFUdI4.BUo16ZMf6DJUBtuKdrJobP.BvxZdWYi','barangay_inc',NULL,'',1,0,'2025-04-08 01:45:49'),('3aeb96d7-b7f5-44d4-8bad-6a04cdd75477','junocarpenter@mailinator.com','junocarpenter','$2y$12$auIK3QA6E/exPVZuhcjgt.U6FzOWZ/grwH5BUs9zifVyfNE8cU00W','barangay_inc',NULL,'',1,0,'2025-04-07 15:52:05'),('66dcf1bd-51e1-45e3-8727-0c343577bdd5','ericsonmariebautista@mailinator.com','ericsonmariebautista','$2y$12$MPChjNnPM3fTn2bGJB9W/OzmK3knK4LDRFx5f3C2N7ojr4N4jTh16','admin',NULL,NULL,1,0,'2025-04-03 22:06:46'),('6c0b0a91-03a3-4614-a6a9-1a46133e8a60','ladyglittersmackles@gmail.com','anuada_1990','$2y$12$pzTQcKHz2TtTYxSt9km72u9sloyJtK4hbfA2n2ZTJsNFHaTlzMcfS','barangay_inc','','',1,0,'2025-04-03 17:40:37'),('74158fcb-d946-4787-b7c5-8ccaa3b30660','heroshigonzales@gmail.com','heroshi_paro','$2y$12$siu6lpmvdADUMoO9EH.K3u31kbwFXet8P8ia3vNbcsOotWagX.Ob2','admin','',NULL,1,0,'2025-04-03 17:40:35'),('7594b921-87ea-437e-bd63-03e2809c3fc2','mariah_carey@mailinator.com','therealmariah_carey','$2y$12$qvCWyerLwX34QrtnG6SwIebSrazN.KDGsQrbLagqe6CzJWLKtVvrS','deliveries','','',1,0,'2025-04-03 17:40:38'),('8c3acd7e-264b-4f64-a954-a425f09b97a0','laquantisha_johnson@mailinator.com','laquantisha_johnson','$2y$12$9UaUeUoxMAfjHkYF1Ew6eOgJheGr3BxLeVbGiSQDa1UXkYzYqbkKm','barangay_inc',NULL,'',1,0,'2025-04-08 03:04:03'),('b5b54cf0-da93-401e-a353-2d2917210971','mharbenreypude.854@gmail.com','mharbenreypude','$2y$10$MRJGneSncga1iXrV18RFdu/GsLnp2CC944obFOVF38/FgS0v6cnEq','admin',NULL,NULL,1,0,'2025-04-03 21:50:07'),('d1b0d961-4460-444a-a7f2-0117347d28d2','jerryegamp21@gmail.com','jerryegamp21','$2y$10$GS6uoCetYreZQnAUhyFefefEjK1HgV.TO4pM0.041LDIc7ggnDePC','admin',NULL,NULL,1,0,'2025-04-03 21:59:17'),('eb48b13c-9094-4de4-afc2-786b9dc93f96','christopher_pareyac@mailinator.com','christopher_pareyac','$2y$12$7W/t1R9Yj5c0EW4IHzVTmOrJCB/8pBfxhrbmAnDM3y6UTy7jz3skW','city_health',NULL,'',1,0,'2025-04-03 17:40:39'),('eb5452e2-2e5a-4510-9e0e-abac5714e03f','duncan_pello@mailinator.com','duncan_pello','$2y$12$nNIUEJOhe6y94BvBguJnsu0bU2lvkPvA.G0a36nz7JrPtzOFey.HK','barangay_inc',NULL,'',1,0,'2025-04-08 03:43:06'),('f3e92e97-dcb4-4e41-bfa0-a1b896ee2766','dualipa@mailinator.com','dualipa','$2y$12$1s/VeHUvlf.9hF7N9Kh7COkgwB9ZRa8QSsfqQkMMUnhqmtuQVJp92','deliveries',NULL,'',1,0,'2025-04-07 05:58:42');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `accountId` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `fname` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `DOB` date NOT NULL,
  `contactNo` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `id_verification` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_admin_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('66dcf1bd-51e1-45e3-8727-0c343577bdd5','Ericson Mar','Bautista','Floptropica, Cebu City','1990-01-31','09189389183','../assets/img/profile/admin/66dcf1bd-51e1-45e3-8727-0c343577bdd5.png'),('74158fcb-d946-4787-b7c5-8ccaa3b30660','Heroshi','Paro','Curvada, Juan Climaco Sr., Toledo City, Cebu','2002-01-31','09293820193','../assets/img/profile/admin/74158fcb-d946-4787-b7c5-8ccaa3b30660.png'),('b5b54cf0-da93-401e-a353-2d2917210971','Mharben Rey','Pude','Tres de Abril St., Cebu City, Cebu 6000','1998-10-16','09282719482','../assets/img/profile/admin/b5b54cf0-da93-401e-a353-2d2917210971.png'),('d1b0d961-4460-444a-a7f2-0117347d28d2','Jeremy','Gamboa','Tinabangay 2 Alaska Mambaling Cebu city, 6000','2000-12-21','09193828493','../assets/img/profile/admin/d1b0d961-4460-444a-a7f2-0117347d28d2.png');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_auth_tokens`
--

DROP TABLE IF EXISTS `admin_auth_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_auth_tokens` (
  `admin_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `auth_token` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_authenticated` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`admin_id`),
  CONSTRAINT `FK_admin_auth_tokens_admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_auth_tokens`
--

LOCK TABLES `admin_auth_tokens` WRITE;
/*!40000 ALTER TABLE `admin_auth_tokens` DISABLE KEYS */;
INSERT INTO `admin_auth_tokens` VALUES ('66dcf1bd-51e1-45e3-8727-0c343577bdd5','',0),('74158fcb-d946-4787-b7c5-8ccaa3b30660','',0),('b5b54cf0-da93-401e-a353-2d2917210971',NULL,0),('d1b0d961-4460-444a-a7f2-0117347d28d2','',0);
/*!40000 ALTER TABLE `admin_auth_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barangay_inc`
--

DROP TABLE IF EXISTS `barangay_inc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `barangay_inc` (
  `accountId` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `fname` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `barangay` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `contactNo` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `id_verification` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_barangay_inc_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barangay_inc`
--

LOCK TABLES `barangay_inc` WRITE;
/*!40000 ALTER TABLE `barangay_inc` DISABLE KEYS */;
INSERT INTO `barangay_inc` VALUES ('2f0444ac-230a-480e-9c4e-d5f68ccfe069','Arizona','Maine','Floptropica City, Floptropica, USF','Adlaon','09193829483','../assets/img/profile/barangay_incharge/2f0444ac-230a-480e-9c4e-d5f68ccfe069.png'),('343e3676-6281-45d4-ab39-25eb15909b8b','Jane','Smith','Floptropica City, USF','Bonbon','09682918392','../assets/img/profile/barangay_incharge/343e3676-6281-45d4-ab39-25eb15909b8b.png'),('3aeb96d7-b7f5-44d4-8bad-6a04cdd75477','Juno','Carpenter','City','Buhisan','09293029403','../assets/img/profile/barangay_incharge/3aeb96d7-b7f5-44d4-8bad-6a04cdd75477.png'),('6c0b0a91-03a3-4614-a6a9-1a46133e8a60','Mike','Lazardos','Floptropica St. Mountain Cebu','Busay','09293929301','../assets/img/profile/barangay_incharge/6c0b0a91-03a3-4614-a6a9-1a46133e8a60.png'),('8c3acd7e-264b-4f64-a954-a425f09b97a0','Laquantisha','Johnson','Floptropica','Sirao','09301903920','../assets/img/profile/barangay_incharge/8c3acd7e-264b-4f64-a954-a425f09b97a0.png'),('eb5452e2-2e5a-4510-9e0e-abac5714e03f','Duncan','Pello','Floptropica','Pung-ol Sibugay','09840189402','../assets/img/profile/barangay_incharge/eb5452e2-2e5a-4510-9e0e-abac5714e03f.png');
/*!40000 ALTER TABLE `barangay_inc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city_health`
--

DROP TABLE IF EXISTS `city_health`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `city_health` (
  `accountId` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `fname` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `contactNo` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `id_verification` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_city_health_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city_health`
--

LOCK TABLES `city_health` WRITE;
/*!40000 ALTER TABLE `city_health` DISABLE KEYS */;
INSERT INTO `city_health` VALUES ('102f4343-7843-4b85-bb49-05841e4811b3','Hahah','Roap','Floptropica City, USF','09183928484','../assets/img/profile/city_health/102f4343-7843-4b85-bb49-05841e4811b3.png'),('eb48b13c-9094-4de4-afc2-786b9dc93f96','Christopher','Pareyac','Floptropica','09284928392','../assets/img/profile/city_health/eb48b13c-9094-4de4-afc2-786b9dc93f96.png');
/*!40000 ALTER TABLE `city_health` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deliveries`
--

DROP TABLE IF EXISTS `deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deliveries` (
  `accountId` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `fname` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `contactNo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_verification` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_deliveries_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deliveries`
--

LOCK TABLES `deliveries` WRITE;
/*!40000 ALTER TABLE `deliveries` DISABLE KEYS */;
INSERT INTO `deliveries` VALUES ('7594b921-87ea-437e-bd63-03e2809c3fc2','Mariah','Carey','Floptropica','09284738274','../assets/img/profile/deleviries/7594b921-87ea-437e-bd63-03e2809c3fc2.png'),('f3e92e97-dcb4-4e41-bfa0-a1b896ee2766','Dua','Lipa','London, Pardo Cebu City','09939294859','../assets/img/profile/deleviries/f3e92e97-dcb4-4e41-bfa0-a1b896ee2766.png');
/*!40000 ALTER TABLE `deliveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `med_availabilty`
--

DROP TABLE IF EXISTS `med_availabilty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `med_availabilty` (
  `id` int NOT NULL AUTO_INCREMENT,
  `med_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `med_description` text COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiry_date` datetime NOT NULL,
  `med_image` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `DosageForm` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `DosageStrength` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `city_health_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_health_id` (`city_health_id`),
  CONSTRAINT `FK_med_availabilty_city_health` FOREIGN KEY (`city_health_id`) REFERENCES `city_health` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `med_availabilty`
--

LOCK TABLES `med_availabilty` WRITE;
/*!40000 ALTER TABLE `med_availabilty` DISABLE KEYS */;
INSERT INTO `med_availabilty` VALUES (19,'Paracetamol','It is a common over-the-counter medication used to relieve pain and reduce fever. It is often used for headaches, muscle aches, arthritis, backaches, toothaches, colds, and fevers. Paracetamol is generally considered safe when used as directed, but it can be harmful in excessive doses, leading to liver damage. Always follow dosing instructions and consult a healthcare professional if you have any concerns.','1000','2025-03-21 06:43:10','2026-01-01 00:00:00','../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_paracetamol_03202025224310.png','Tablet','500 mg','analgesics and antipyretics','eb48b13c-9094-4de4-afc2-786b9dc93f96'),(21,'Grethers Pastilles','Used to soothe throat discomfort and alleviate dry mouth symptoms.','1000','2025-03-21 06:52:56','2026-03-21 00:00:00','../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_gretherspastilles_03202025225256.png','Pastille','110000 mg','throat lozenges or cough drops','eb48b13c-9094-4de4-afc2-786b9dc93f96'),(22,'Generic (BIOGESIC)','A trusted brand of paracetamol, Paracetamol (Biogesic) is a medication that is typically used to relieve mild to moderate pain such as headache, backache, menstrual cramps, muscular strain, minor arthritis pain, toothache, and reduce fevers caused by illnesses such as the common cold and flu','10000','2025-03-21 10:05:31','2025-03-22 00:00:00','../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_generic(biogesic)_03212025030531.png','table','500mg','Biogesic 50mg Tablet belongs to a class of medicines known as nonsteroidal anti-inflammatory drugs (','eb48b13c-9094-4de4-afc2-786b9dc93f96'),(24,'para sa opaw','sa buhok','23','2025-03-21 11:29:37','9999-09-09 00:00:00','../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_parasaopaw_03212025042937.png','Tablet, Capsule, Syrup','ml','Construction','eb48b13c-9094-4de4-afc2-786b9dc93f96');
/*!40000 ALTER TABLE `med_availabilty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `med_deliveries`
--

DROP TABLE IF EXISTS `med_deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `med_deliveries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_med_id` int NOT NULL,
  `deliveries_accountId` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date_of_supply` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `deliveries_accountId` (`deliveries_accountId`),
  KEY `request_med_id` (`request_med_id`),
  CONSTRAINT `FK_med_deliveries_deliveries` FOREIGN KEY (`deliveries_accountId`) REFERENCES `deliveries` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_med_deliveries_request_med` FOREIGN KEY (`request_med_id`) REFERENCES `request_med` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `med_deliveries`
--

LOCK TABLES `med_deliveries` WRITE;
/*!40000 ALTER TABLE `med_deliveries` DISABLE KEYS */;
INSERT INTO `med_deliveries` VALUES (11,9,'7594b921-87ea-437e-bd63-03e2809c3fc2','2025-03-20 00:00:00'),(12,10,'7594b921-87ea-437e-bd63-03e2809c3fc2','2025-05-01 00:00:00'),(13,11,'7594b921-87ea-437e-bd63-03e2809c3fc2','2025-04-16 00:00:00');
/*!40000 ALTER TABLE `med_deliveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rate_and_feedback`
--

DROP TABLE IF EXISTS `rate_and_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rate_and_feedback` (
  `accountId` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `rating` int NOT NULL,
  `feedback` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_rate_and_feedback_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rate_and_feedback`
--

LOCK TABLES `rate_and_feedback` WRITE;
/*!40000 ALTER TABLE `rate_and_feedback` DISABLE KEYS */;
INSERT INTO `rate_and_feedback` VALUES ('6c0b0a91-03a3-4614-a6a9-1a46133e8a60',3,'ok na to','2025-04-05 17:03:56','2025-04-06 12:18:18'),('7594b921-87ea-437e-bd63-03e2809c3fc2',5,'yehey, the service is so much better now, good thing you listen to the feedbacks from the users. keep it up po!!!','2025-04-05 15:19:45','2025-04-06 03:24:17'),('8c3acd7e-264b-4f64-a954-a425f09b97a0',4,'So far, it&#039;s nice','2025-04-08 09:03:47','2025-04-08 09:03:47'),('eb48b13c-9094-4de4-afc2-786b9dc93f96',1,'ako ay isang (reyna)4x','2025-04-05 16:24:03','2025-04-06 03:26:21'),('f3e92e97-dcb4-4e41-bfa0-a1b896ee2766',5,'Gimme chi, gimme purr, gimme meow, gimme her, gimme funds\r\nGimme rights, gimme fight, gimme nerve, gimme cunt, let me','2025-04-05 19:15:17','2025-04-05 19:15:17');
/*!40000 ALTER TABLE `rate_and_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_med`
--

DROP TABLE IF EXISTS `request_med`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `request_med` (
  `id` int NOT NULL AUTO_INCREMENT,
  `city_health_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `barangay_inc_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `med_avail_Id` int NOT NULL,
  `request_quantity` varchar(100) NOT NULL,
  `request_DosageForm` varchar(100) NOT NULL,
  `request_DosageStrength` varchar(100) NOT NULL,
  `requestStatus` enum('Pending','Accepted','Cancelled') NOT NULL DEFAULT 'Pending',
  `prescription` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_health_id` (`city_health_id`),
  KEY `barangay_inc_id` (`barangay_inc_id`),
  KEY `med_avail_Id` (`med_avail_Id`),
  CONSTRAINT `FK_request_med_barangay_inc` FOREIGN KEY (`barangay_inc_id`) REFERENCES `barangay_inc` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_request_med_city_health` FOREIGN KEY (`city_health_id`) REFERENCES `city_health` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_request_med_med_availabilty` FOREIGN KEY (`med_avail_Id`) REFERENCES `med_availabilty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_med`
--

LOCK TABLES `request_med` WRITE;
/*!40000 ALTER TABLE `request_med` DISABLE KEYS */;
INSERT INTO `request_med` VALUES (9,'eb48b13c-9094-4de4-afc2-786b9dc93f96','6c0b0a91-03a3-4614-a6a9-1a46133e8a60',19,'100','Syrup','ml','Accepted',''),(10,'eb48b13c-9094-4de4-afc2-786b9dc93f96','6c0b0a91-03a3-4614-a6a9-1a46133e8a60',21,'500','Syrup','2500','Accepted',''),(11,'eb48b13c-9094-4de4-afc2-786b9dc93f96','6c0b0a91-03a3-4614-a6a9-1a46133e8a60',19,'1000','Tablet','2500','Accepted',''),(14,'eb48b13c-9094-4de4-afc2-786b9dc93f96','6c0b0a91-03a3-4614-a6a9-1a46133e8a60',19,'21','','250','Pending',''),(15,'eb48b13c-9094-4de4-afc2-786b9dc93f96','6c0b0a91-03a3-4614-a6a9-1a46133e8a60',19,'8','','500','Pending','../assets/img/upload_prescription/9b796a75-1fbd-4aff-b495-a4a2bf7373bb.png');
/*!40000 ALTER TABLE `request_med` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscription` (
  `id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `barangay_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `receipt` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `plan` enum('Annual','Monthly') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `amount` int NOT NULL,
  `approve_status` enum('Approved','Cancelled','Pending') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `barangay_id` (`barangay_id`),
  CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`barangay_id`) REFERENCES `barangay_inc` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription`
--

LOCK TABLES `subscription` WRITE;
/*!40000 ALTER TABLE `subscription` DISABLE KEYS */;
INSERT INTO `subscription` VALUES ('10fb6dbf-3e9d-4b08-8485-eb173b24acbe','6c0b0a91-03a3-4614-a6a9-1a46133e8a60','../assets/img/upload_receipt/10fb6dbf-3e9d-4b08-8485-eb173b24acbe.png','Annual',2999,'Approved','2025-04-08','2026-04-08','2025-04-08 15:59:01'),('955afd1c-d8bc-479a-a168-92687178e568','2f0444ac-230a-480e-9c4e-d5f68ccfe069','../assets/img/upload_receipt/955afd1c-d8bc-479a-a168-92687178e568.png','Annual',2999,'Approved','2025-04-08','2026-04-08','2025-04-08 13:50:24'),('c4549a95-6eb7-4b3b-9257-568df429ec2c','8c3acd7e-264b-4f64-a954-a425f09b97a0','../assets/img/upload_receipt/c4549a95-6eb7-4b3b-9257-568df429ec2c.png','Annual',2999,'Pending',NULL,NULL,'2025-04-08 16:01:04'),('eae353ef-abd0-4101-a161-d7ef844b488a','eb5452e2-2e5a-4510-9e0e-abac5714e03f','../assets/img/upload_receipt/eae353ef-abd0-4101-a161-d7ef844b488a.png','Monthly',299,'Cancelled',NULL,NULL,'2025-04-08 15:44:10'),('f94bd7d9-06cc-4e47-9ecf-7f64157cd46d','343e3676-6281-45d4-ab39-25eb15909b8b','../assets/img/upload_receipt/f94bd7d9-06cc-4e47-9ecf-7f64157cd46d.png','Annual',2999,'Approved','2025-04-08','2026-04-08','2025-04-08 13:56:17');
/*!40000 ALTER TABLE `subscription` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-09  0:01:35
