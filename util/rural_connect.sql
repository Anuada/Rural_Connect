-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: rural_connect
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
  `accountId` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_type` enum('admin','barangay_inc','city_health','deliveries') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `recovery_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `verify_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isVerify` tinyint NOT NULL DEFAULT '0',
  `isLogin` tinyint NOT NULL DEFAULT '0',
  `account_status` enum('Approved','Cancelled','Pending') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`accountId`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES ('18d236b6-3892-498f-8612-767f777a4f34','bernard_wilson@mailinator.com','bernard_wilson','$2y$12$Z0OI3idGKBl0HVIYbz8yzua.zTz6Qx8.3ziIDXXkzUXKGnkv5pX76','barangay_inc',NULL,'',1,0,'Approved','2025-03-09 01:25:09'),('1bb43733-7b54-4068-b40c-ae921611a37e','finneas_heath@mailinator.com','finneas_heath','$2y$12$eaK.Y3mRtBKJsDuH1Px9nuDW5iFgkk9QuIns8ARkmRbfAVaIkCZdq','deliveries',NULL,'',1,0,'Approved','2025-04-15 01:02:38'),('21bf6022-4553-44af-b5d1-2075179428f9','rari_fox@mailinator.com','rari_fox','$2y$12$PI/rYZAev3.L1GlYaCeSheDLI1.dp/Z.VNQVF7zeRSmRQNfujeOIG','barangay_inc',NULL,'',1,0,'Approved','2025-04-28 09:01:10'),('2f0444ac-230a-480e-9c4e-d5f68ccfe069','arizonamaine@mailinator.com','arizonamaine','$2y$12$CgDPRB1aiVkujYnzrcSZyeaVZ0IDXpcU4QSU8WH7vTH9wrfN9VUEW','barangay_inc',NULL,'',1,0,'Approved','2025-03-08 09:19:57'),('343e3676-6281-45d4-ab39-25eb15909b8b','janesmith@mailinator.com','janesmith','$2y$12$UEDCn08E9aDLAeJSFUdI4.BUo16ZMf6DJUBtuKdrJobP.BvxZdWYi','barangay_inc',NULL,'',1,0,'Approved','2025-03-08 01:45:49'),('360c0be8-bf56-4d1f-b52b-7fe06e0936b1','anthony_wang@mailinator.com','anthony_wang','$2y$12$CXrCOEawyq4N1F29m8Ig1eP.yD3iz31e1/7zSy1PYC6qcAPT8XWoK','deliveries',NULL,'',1,1,'Approved','2025-04-17 04:26:42'),('37e0429a-e9d2-4355-bb9a-8b0cb3c9a40f','rigor_tangor@mailinator.com','rigor_tangor','$2y$12$WxTQAxBC.GdyEdkqlweAeeclXsf/U.hCCj9LUV9rsaY8zmcPmuLOi','deliveries',NULL,'',1,0,'Approved','2025-04-27 15:18:23'),('3aeb96d7-b7f5-44d4-8bad-6a04cdd75477','junocarpenter@mailinator.com','junocarpenter','$2y$12$auIK3QA6E/exPVZuhcjgt.U6FzOWZ/grwH5BUs9zifVyfNE8cU00W','barangay_inc',NULL,'',1,0,'Approved','2025-04-07 15:52:05'),('55359fe8-e86a-4670-b0bf-4277c3c5d07f','virginia_montgomery@mailinator.com','virginia_montgomery','$2y$12$.dDjw9o2T2FUsqNixmoaXOPYN60syXbZbtUfxjuutYwjqrDWpKVwq','barangay_inc',NULL,'',1,0,'Approved','2025-04-09 11:24:45'),('66dcf1bd-51e1-45e3-8727-0c343577bdd5','ariana_elle_go@mailinator.com','ariana_elle_go','$2y$12$YmCH90LAvl5jQ5CL3VqCGuM8RncYfDQPawrym2tkuDT8QFETpJSvq','admin',NULL,NULL,1,0,'Approved','2025-04-03 22:06:46'),('6c0b0a91-03a3-4614-a6a9-1a46133e8a60','ladyglittersmackles@gmail.com','anuada_1990','$2y$12$EdnfZqOmV.zsuo/oqWEzi.TcnlOSoXdVMABsfPhSbmznsvNN9NceC','barangay_inc','','',1,0,'Approved','2025-03-03 17:40:37'),('74158fcb-d946-4787-b7c5-8ccaa3b30660','heroshigonzales@gmail.com','heroshi_paro','$2y$12$siu6lpmvdADUMoO9EH.K3u31kbwFXet8P8ia3vNbcsOotWagX.Ob2','admin','',NULL,1,0,'Approved','2025-04-03 17:40:35'),('7594b921-87ea-437e-bd63-03e2809c3fc2','mariah_carey@mailinator.com','therealmariah_carey','$2y$12$IgCsOGlwdMcN5OjVls3LS..2qxwvT2weN9H3rNLZyoFVaAqEecauy','deliveries','','',1,0,'Approved','2025-03-03 17:40:38'),('8c3acd7e-264b-4f64-a954-a425f09b97a0','laquantisha_johnson@mailinator.com','laquantisha_johnson','$2y$12$9UaUeUoxMAfjHkYF1Ew6eOgJheGr3BxLeVbGiSQDa1UXkYzYqbkKm','barangay_inc',NULL,'',1,1,'Approved','2025-04-08 03:04:03'),('a96ea61e-db52-4a28-a77b-efe8492ec2d4','olivia_rodrigo@mailinator.com','olivia_rodrigo','$2y$12$StCEnZ/CdF/R2kbv1iu9Z.AucFajV.1AyuubgPzfEZ3qgu966tnjW','deliveries',NULL,'',1,0,'Approved','2025-03-09 15:32:58'),('b23ea846-a9fc-473a-9296-f12957e0e67c','jean_delatorre@mailinator.com','jean_delatorre','$2y$12$tOrl/gM3GujHBhMFTTb9O.CY8BPaYz2yZRGq7U.TfJF3rDxchVU9y','barangay_inc',NULL,'',1,0,'Approved','2025-04-27 14:16:00'),('b5b54cf0-da93-401e-a353-2d2917210971','mharbenreypude.854@gmail.com','mharbenreypude','$2y$10$MRJGneSncga1iXrV18RFdu/GsLnp2CC944obFOVF38/FgS0v6cnEq','admin',NULL,NULL,1,0,'Approved','2025-04-03 21:50:07'),('c1cb89f6-159f-4a70-a65f-c9c823a66f81','isabella_cruz@mailinator.com','isabella_cruz','$2y$12$.oyHB8TcOW3sYPao4QuzWO36LywgXAyZfIbBPkbKEDQxoyWkSkoxK','barangay_inc',NULL,'',1,0,'Approved','2025-04-14 13:56:35'),('d1b0d961-4460-444a-a7f2-0117347d28d2','jerryegamp21@gmail.com','jerryegamp21','$2y$10$GS6uoCetYreZQnAUhyFefefEjK1HgV.TO4pM0.041LDIc7ggnDePC','admin',NULL,NULL,1,0,'Approved','2025-04-03 21:59:17'),('d3da9bb6-b666-48c7-8310-ce227a2a9461','rana_guzman@mailinator.com','rana_guzman','$2y$12$ig4ASdaVOTf/v0K0gxVI1uiwybQUUEqi.NXi5dR69I4gE58NBLZci','barangay_inc',NULL,'',1,0,'Approved','2025-04-09 00:15:46'),('eb48b13c-9094-4de4-afc2-786b9dc93f96','christopher_pareyac@mailinator.com','christopher_pareyac','$2y$12$SYJ2EzTPsN7HYue9LU9PaOt6CXInIJjeJ9.7jwzJSSNnfVeJLpZHa','city_health','','',1,1,'Approved','2025-02-28 17:40:39'),('eb5452e2-2e5a-4510-9e0e-abac5714e03f','duncan_pello@mailinator.com','duncan_pello','$2y$12$nNIUEJOhe6y94BvBguJnsu0bU2lvkPvA.G0a36nz7JrPtzOFey.HK','barangay_inc',NULL,'',1,0,'Approved','2025-04-08 03:43:06'),('f3e92e97-dcb4-4e41-bfa0-a1b896ee2766','dualipa@mailinator.com','dualipa','$2y$12$1s/VeHUvlf.9hF7N9Kh7COkgwB9ZRa8QSsfqQkMMUnhqmtuQVJp92','deliveries',NULL,'',1,0,'Approved','2025-04-07 05:58:42');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `accountId` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `DOB` date NOT NULL,
  `contactNo` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_verification` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_admin_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('66dcf1bd-51e1-45e3-8727-0c343577bdd5','Ariana Elle','Go','Floptropica City, Floptropica','1990-01-31','09189389183','../assets/img/profile/admin/66dcf1bd-51e1-45e3-8727-0c343577bdd5.png'),('74158fcb-d946-4787-b7c5-8ccaa3b30660','Heroshi','Paro','Curvada, Juan Climaco Sr., Toledo City, Cebu','2002-01-31','09293820193','../assets/img/profile/admin/74158fcb-d946-4787-b7c5-8ccaa3b30660.png'),('b5b54cf0-da93-401e-a353-2d2917210971','Mharben Rey','Pude','Tres de Abril St., Cebu City, Cebu 6000','1998-10-16','09282719482','../assets/img/profile/admin/b5b54cf0-da93-401e-a353-2d2917210971.png'),('d1b0d961-4460-444a-a7f2-0117347d28d2','Jeremy','Gamboa','Tinabangay 2 Alaska Mambaling Cebu city, 6000','2000-12-21','09193828493','../assets/img/profile/admin/d1b0d961-4460-444a-a7f2-0117347d28d2.png');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_auth_tokens`
--

DROP TABLE IF EXISTS `admin_auth_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_auth_tokens` (
  `admin_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `auth_token` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `accountId` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `fname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `barangay` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contactNo` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_verification` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_barangay_inc_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barangay_inc`
--

LOCK TABLES `barangay_inc` WRITE;
/*!40000 ALTER TABLE `barangay_inc` DISABLE KEYS */;
INSERT INTO `barangay_inc` VALUES ('18d236b6-3892-498f-8612-767f777a4f34','Bernard','Wilson','London, Pardo Cebu City','Agsungot','09952584656','../assets/img/profile/barangay_incharge/18d236b6-3892-498f-8612-767f777a4f34.png'),('21bf6022-4553-44af-b5d1-2075179428f9','Rari','Fox','Floptropica City, Floptropica','Binaliw','09742049392','../assets/img/profile/barangay_incharge/21bf6022-4553-44af-b5d1-2075179428f9.png'),('2f0444ac-230a-480e-9c4e-d5f68ccfe069','Arizona','Maine','Floptropica City, Floptropica, USF','Adlaon','09193829483','../assets/img/profile/barangay_incharge/2f0444ac-230a-480e-9c4e-d5f68ccfe069.png'),('343e3676-6281-45d4-ab39-25eb15909b8b','Jane','Smith','Floptropica City, USF','Bonbon','09682918392','../assets/img/profile/barangay_incharge/343e3676-6281-45d4-ab39-25eb15909b8b.png'),('3aeb96d7-b7f5-44d4-8bad-6a04cdd75477','Juno','Carpenter','City','Buhisan','09293029403','../assets/img/profile/barangay_incharge/3aeb96d7-b7f5-44d4-8bad-6a04cdd75477.png'),('55359fe8-e86a-4670-b0bf-4277c3c5d07f','Virginia','Montgomery','London, Pardo Cebu City','Babag','09205930391','../assets/img/profile/barangay_incharge/55359fe8-e86a-4670-b0bf-4277c3c5d07f.png'),('6c0b0a91-03a3-4614-a6a9-1a46133e8a60','Mike','Lazardos','Floptropica St. Mountain Cebu','Busay','09293929301','../assets/img/profile/barangay_incharge/6c0b0a91-03a3-4614-a6a9-1a46133e8a60.png'),('8c3acd7e-264b-4f64-a954-a425f09b97a0','Laquantisha','Johnson','Floptropica','Sirao','09301903920','../assets/img/profile/barangay_incharge/8c3acd7e-264b-4f64-a954-a425f09b97a0.png'),('b23ea846-a9fc-473a-9296-f12957e0e67c','Jean','Dela Torre','Floptropica St. Guba, Cebu City','Guba','09190391903','../assets/img/profile/barangay_incharge/b23ea846-a9fc-473a-9296-f12957e0e67c.png'),('c1cb89f6-159f-4a70-a65f-c9c823a66f81','Isabella','Cruz','Floptropica City, Floptropica, USF','Cambinocot','09183927654','../assets/img/profile/barangay_incharge/c1cb89f6-159f-4a70-a65f-c9c823a66f81.png'),('d3da9bb6-b666-48c7-8310-ce227a2a9461','Rana','Guzman','Floptropica, Cebu City','Sapangdaku','09740293849','../assets/img/profile/barangay_incharge/d3da9bb6-b666-48c7-8310-ce227a2a9461.png'),('eb5452e2-2e5a-4510-9e0e-abac5714e03f','Duncan','Pello','Floptropica','Pung-ol Sibugay','09840189402','../assets/img/profile/barangay_incharge/eb5452e2-2e5a-4510-9e0e-abac5714e03f.png');
/*!40000 ALTER TABLE `barangay_inc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city_health`
--

DROP TABLE IF EXISTS `city_health`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `city_health` (
  `accountId` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contactNo` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_verification` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_city_health_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city_health`
--

LOCK TABLES `city_health` WRITE;
/*!40000 ALTER TABLE `city_health` DISABLE KEYS */;
INSERT INTO `city_health` VALUES ('eb48b13c-9094-4de4-afc2-786b9dc93f96','Christopher','Pareyac','Floptropica City, Floptropica','09284928392','../assets/img/profile/city_health/eb48b13c-9094-4de4-afc2-786b9dc93f96.png');
/*!40000 ALTER TABLE `city_health` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_med_deliveries`
--

DROP TABLE IF EXISTS `custom_med_deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `custom_med_deliveries` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `custom_med_request_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `delivery_account_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `delivery_status` enum('To Deliver','In Transit','Failed Delivery','Returned','Delivered','Partially Claimed','Claimed') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'To Deliver',
  `date_of_supply` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_custom_med_deliveries_deliveries` (`delivery_account_id`),
  KEY `FK_custom_med_deliveries_custom_med_request` (`custom_med_request_id`),
  CONSTRAINT `FK_custom_med_deliveries_custom_med_request` FOREIGN KEY (`custom_med_request_id`) REFERENCES `custom_med_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_custom_med_deliveries_deliveries` FOREIGN KEY (`delivery_account_id`) REFERENCES `deliveries` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_med_deliveries`
--

LOCK TABLES `custom_med_deliveries` WRITE;
/*!40000 ALTER TABLE `custom_med_deliveries` DISABLE KEYS */;
INSERT INTO `custom_med_deliveries` VALUES ('6ffc9a9c-2a9d-4055-b1be-81d4521631a2','7272da41-eadd-40c5-9654-774c4d318878','360c0be8-bf56-4d1f-b52b-7fe06e0936b1','Claimed','2025-05-08 00:00:00');
/*!40000 ALTER TABLE `custom_med_deliveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_med_deliveries_feedback`
--

DROP TABLE IF EXISTS `custom_med_deliveries_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `custom_med_deliveries_feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `med_delivery_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `delivery_condition` enum('good','damaged','missing items') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_custom_med_deliveries_feedback_custom_med_deliveries` (`med_delivery_id`),
  CONSTRAINT `FK_custom_med_deliveries_feedback_custom_med_deliveries` FOREIGN KEY (`med_delivery_id`) REFERENCES `custom_med_deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_med_deliveries_feedback`
--

LOCK TABLES `custom_med_deliveries_feedback` WRITE;
/*!40000 ALTER TABLE `custom_med_deliveries_feedback` DISABLE KEYS */;
INSERT INTO `custom_med_deliveries_feedback` VALUES (3,'6ffc9a9c-2a9d-4055-b1be-81d4521631a2','good','kokorokoko','2025-05-07 07:22:02');
/*!40000 ALTER TABLE `custom_med_deliveries_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_med_delivery_status_history`
--

DROP TABLE IF EXISTS `custom_med_delivery_status_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `custom_med_delivery_status_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `delivery_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('To Deliver','In Transit','Failed Delivery','Returned','Delivered','Partially Claimed','Claimed') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'To Deliver',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_custom_med_delivery_status_history_custom_med_deliveries` (`delivery_id`),
  CONSTRAINT `FK_custom_med_delivery_status_history_custom_med_deliveries` FOREIGN KEY (`delivery_id`) REFERENCES `custom_med_deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_med_delivery_status_history`
--

LOCK TABLES `custom_med_delivery_status_history` WRITE;
/*!40000 ALTER TABLE `custom_med_delivery_status_history` DISABLE KEYS */;
INSERT INTO `custom_med_delivery_status_history` VALUES (34,'6ffc9a9c-2a9d-4055-b1be-81d4521631a2','To Deliver','2025-05-07 03:00:46'),(35,'6ffc9a9c-2a9d-4055-b1be-81d4521631a2','In Transit','2025-05-07 05:19:12'),(36,'6ffc9a9c-2a9d-4055-b1be-81d4521631a2','Delivered','2025-05-07 05:19:17'),(37,'6ffc9a9c-2a9d-4055-b1be-81d4521631a2','Partially Claimed','2025-05-07 05:28:41'),(38,'6ffc9a9c-2a9d-4055-b1be-81d4521631a2','To Deliver','2025-05-07 06:26:12'),(39,'6ffc9a9c-2a9d-4055-b1be-81d4521631a2','In Transit','2025-05-07 07:21:10'),(40,'6ffc9a9c-2a9d-4055-b1be-81d4521631a2','Delivered','2025-05-07 07:21:15'),(41,'6ffc9a9c-2a9d-4055-b1be-81d4521631a2','Claimed','2025-05-07 07:22:02');
/*!40000 ALTER TABLE `custom_med_delivery_status_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_med_request`
--

DROP TABLE IF EXISTS `custom_med_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `custom_med_request` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `barangay_inc_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `requested_medicine` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `brand_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `requested_quantity` int NOT NULL DEFAULT '0',
  `category` enum('medicinal product','medical supply') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `unit` enum('Piece','Box','Bottle') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dosage_strength` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `document` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `request_status` enum('Pending','Accepted','Cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_custom_med_request_barangay_inc` (`barangay_inc_id`),
  CONSTRAINT `FK_custom_med_request_barangay_inc` FOREIGN KEY (`barangay_inc_id`) REFERENCES `barangay_inc` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_med_request`
--

LOCK TABLES `custom_med_request` WRITE;
/*!40000 ALTER TABLE `custom_med_request` DISABLE KEYS */;
INSERT INTO `custom_med_request` VALUES ('7272da41-eadd-40c5-9654-774c4d318878','55359fe8-e86a-4670-b0bf-4277c3c5d07f','Syringe','Terumo Syringe',200,'medical supply','Box',NULL,'../assets/img/upload_document/cf48a3ca-b1b6-46d4-aedc-8d3ce7171d0e.png','Accepted','2025-05-07 01:57:07');
/*!40000 ALTER TABLE `custom_med_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_total_partially_claimed`
--

DROP TABLE IF EXISTS `custom_total_partially_claimed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `custom_total_partially_claimed` (
  `id` int NOT NULL AUTO_INCREMENT,
  `delivery_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `total_partially_claimed` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_custom_total_partially_claimed_custom_med_deliveries` (`delivery_id`),
  CONSTRAINT `FK_custom_total_partially_claimed_custom_med_deliveries` FOREIGN KEY (`delivery_id`) REFERENCES `custom_med_deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_total_partially_claimed`
--

LOCK TABLES `custom_total_partially_claimed` WRITE;
/*!40000 ALTER TABLE `custom_total_partially_claimed` DISABLE KEYS */;
INSERT INTO `custom_total_partially_claimed` VALUES (1,'6ffc9a9c-2a9d-4055-b1be-81d4521631a2',300,'2025-05-07 05:28:41');
/*!40000 ALTER TABLE `custom_total_partially_claimed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deliveries`
--

DROP TABLE IF EXISTS `deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deliveries` (
  `accountId` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contactNo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_verification` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `availability_status` enum('Available','Unavailable') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Available',
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_deliveries_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deliveries`
--

LOCK TABLES `deliveries` WRITE;
/*!40000 ALTER TABLE `deliveries` DISABLE KEYS */;
INSERT INTO `deliveries` VALUES ('1bb43733-7b54-4068-b40c-ae921611a37e','Finneas','Heath','Floptropica, Cebu City','09739647867','../assets/img/profile/deleviries/1bb43733-7b54-4068-b40c-ae921611a37e.png','Available'),('360c0be8-bf56-4d1f-b52b-7fe06e0936b1','Anthony','Wang','Floptropica City, Floptropica','09182738291','../assets/img/profile/deleviries/360c0be8-bf56-4d1f-b52b-7fe06e0936b1.png','Available'),('37e0429a-e9d2-4355-bb9a-8b0cb3c9a40f','Rigor','Tangor','Floptropica St. Guba, Cebu City','09591967282','../assets/img/profile/deleviries/37e0429a-e9d2-4355-bb9a-8b0cb3c9a40f.png','Available'),('7594b921-87ea-437e-bd63-03e2809c3fc2','Mariah','Carey','Floptropica','09284738274','../assets/img/profile/deleviries/7594b921-87ea-437e-bd63-03e2809c3fc2.png','Available'),('a96ea61e-db52-4a28-a77b-efe8492ec2d4','Olivia','Rodrigo','London, Pardo Cebu City','09592930132','../assets/img/profile/deleviries/a96ea61e-db52-4a28-a77b-efe8492ec2d4.png','Available'),('f3e92e97-dcb4-4e41-bfa0-a1b896ee2766','Dua','Lipa','London, Pardo Cebu City','09939294859','../assets/img/profile/deleviries/f3e92e97-dcb4-4e41-bfa0-a1b896ee2766.png','Available');
/*!40000 ALTER TABLE `deliveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_status_history`
--

DROP TABLE IF EXISTS `delivery_status_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `delivery_status_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `delivery_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('To Deliver','In Transit','Failed Delivery','Returned','Delivered','Partially Claimed','Claimed') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'To Deliver',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_delivery_status_history_med_deliveries` (`delivery_id`),
  CONSTRAINT `FK_delivery_status_history_med_deliveries` FOREIGN KEY (`delivery_id`) REFERENCES `med_deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_status_history`
--

LOCK TABLES `delivery_status_history` WRITE;
/*!40000 ALTER TABLE `delivery_status_history` DISABLE KEYS */;
INSERT INTO `delivery_status_history` VALUES (93,'c1ec6430-bc20-435b-9ef5-a4fea80f2df4','To Deliver','2025-05-07 03:01:18'),(94,'c1ec6430-bc20-435b-9ef5-a4fea80f2df4','In Transit','2025-05-07 03:11:44'),(95,'c1ec6430-bc20-435b-9ef5-a4fea80f2df4','Delivered','2025-05-07 03:11:49'),(96,'b7dfb787-b739-41b7-b5f2-6943cec3c772','To Deliver','2025-05-07 04:19:31'),(97,'b7dfb787-b739-41b7-b5f2-6943cec3c772','In Transit','2025-05-07 04:19:51'),(98,'b7dfb787-b739-41b7-b5f2-6943cec3c772','Delivered','2025-05-07 04:19:56'),(99,'b7dfb787-b739-41b7-b5f2-6943cec3c772','Claimed','2025-05-07 04:20:28'),(100,'c1ec6430-bc20-435b-9ef5-a4fea80f2df4','Partially Claimed','2025-05-07 05:28:08'),(103,'c1ec6430-bc20-435b-9ef5-a4fea80f2df4','To Deliver','2025-05-07 06:25:12'),(110,'c1ec6430-bc20-435b-9ef5-a4fea80f2df4','In Transit','2025-05-07 07:05:59'),(111,'c1ec6430-bc20-435b-9ef5-a4fea80f2df4','Delivered','2025-05-07 07:06:04'),(112,'c1ec6430-bc20-435b-9ef5-a4fea80f2df4','Partially Claimed','2025-05-07 07:06:36'),(113,'c1ec6430-bc20-435b-9ef5-a4fea80f2df4','To Deliver','2025-05-07 07:19:30'),(114,'c1ec6430-bc20-435b-9ef5-a4fea80f2df4','In Transit','2025-05-07 07:19:42'),(115,'c1ec6430-bc20-435b-9ef5-a4fea80f2df4','Delivered','2025-05-07 07:19:47'),(116,'c1ec6430-bc20-435b-9ef5-a4fea80f2df4','Claimed','2025-05-07 07:20:03'),(117,'b081e945-6ec6-46f4-8047-1bc32982ae61','To Deliver','2025-05-07 13:50:19'),(118,'b081e945-6ec6-46f4-8047-1bc32982ae61','In Transit','2025-05-07 13:50:54'),(119,'b081e945-6ec6-46f4-8047-1bc32982ae61','Delivered','2025-05-07 13:50:59'),(120,'b081e945-6ec6-46f4-8047-1bc32982ae61','Partially Claimed','2025-05-07 13:52:03'),(121,'b081e945-6ec6-46f4-8047-1bc32982ae61','To Deliver','2025-05-07 14:02:15'),(122,'b081e945-6ec6-46f4-8047-1bc32982ae61','In Transit','2025-05-07 14:02:25'),(123,'b081e945-6ec6-46f4-8047-1bc32982ae61','Delivered','2025-05-07 14:02:30'),(124,'b081e945-6ec6-46f4-8047-1bc32982ae61','Claimed','2025-05-07 14:02:57'),(125,'3c6aadd3-8797-452b-8762-aa60420697b7','To Deliver','2025-05-07 14:08:04'),(126,'3c6aadd3-8797-452b-8762-aa60420697b7','In Transit','2025-05-07 14:09:10'),(127,'3c6aadd3-8797-452b-8762-aa60420697b7','Delivered','2025-05-07 14:09:14'),(128,'3c6aadd3-8797-452b-8762-aa60420697b7','Partially Claimed','2025-05-07 14:09:53'),(129,'3c6aadd3-8797-452b-8762-aa60420697b7','To Deliver','2025-05-07 14:12:25'),(130,'3c6aadd3-8797-452b-8762-aa60420697b7','In Transit','2025-05-07 14:12:37'),(131,'3c6aadd3-8797-452b-8762-aa60420697b7','Delivered','2025-05-07 14:12:42'),(132,'3c6aadd3-8797-452b-8762-aa60420697b7','Partially Claimed','2025-05-07 14:13:11'),(133,'3c6aadd3-8797-452b-8762-aa60420697b7','To Deliver','2025-05-07 14:13:42'),(134,'3c6aadd3-8797-452b-8762-aa60420697b7','In Transit','2025-05-07 14:13:51'),(135,'3c6aadd3-8797-452b-8762-aa60420697b7','Delivered','2025-05-07 14:13:56'),(136,'3c6aadd3-8797-452b-8762-aa60420697b7','Claimed','2025-05-07 14:14:13'),(137,'0f6ee6f2-4ca5-408c-9371-293cb590f78f','To Deliver','2025-05-07 14:15:32'),(138,'0f6ee6f2-4ca5-408c-9371-293cb590f78f','In Transit','2025-05-07 14:19:27'),(139,'0f6ee6f2-4ca5-408c-9371-293cb590f78f','Delivered','2025-05-07 14:19:31'),(140,'0f6ee6f2-4ca5-408c-9371-293cb590f78f','Partially Claimed','2025-05-07 14:19:53');
/*!40000 ALTER TABLE `delivery_status_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `med_availability`
--

DROP TABLE IF EXISTS `med_availability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `med_availability` (
  `id` int NOT NULL AUTO_INCREMENT,
  `city_health_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `generic_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `brand_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category` enum('medicinal product','medical supply') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `med_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `item_image` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `unit` enum('Piece','Box','Bottle') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dosage_strength` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `city_health_id` (`city_health_id`),
  CONSTRAINT `FK_med_availabilty_city_health` FOREIGN KEY (`city_health_id`) REFERENCES `city_health` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `med_availability`
--

LOCK TABLES `med_availability` WRITE;
/*!40000 ALTER TABLE `med_availability` DISABLE KEYS */;
INSERT INTO `med_availability` VALUES (47,'eb48b13c-9094-4de4-afc2-786b9dc93f96','Paracetamol','Biogesic','medicinal product','Paracetamol, or acetaminophen, is a non-opioid analgesic and antipyretic agent used to treat fever and mild to moderate pain. It is a widely available over-the-counter drug sold under various brand names, including Tylenol and Panadol.','1400','../assets/img/item_image/eb48b13c90944de4afc2786b9dc93f96_paracetamol_05062025144217.png','Box','500 mg','2025-09-01','2025-05-06 22:42:17'),(48,'eb48b13c-9094-4de4-afc2-786b9dc93f96','Face Mask','Hannah Linen','medical supply','Face mask may refer to:an item of protective equipment that primarily guards the airways:\r\nRespirator, including the N95 and FFP2, which are designed for the prevention of airborne viruses like COVID-19, tuberculosis and flu\r\nSurgical mask\r\nCloth face mask\r\nDust mask\r\nDiving mask, for use underwater\r\nFacemask (orthodontics), used for correcting teeth misalignments\r\nFacial mask, used for cosmetic skin treatment\r\nFace mask, in sports\r\nA mask for the face, typically used in rituals, performance art and as a disguise mostly during the Halloween holiday.\r\nFace mask, a West African wooden mask at the Indianapolis Museum of Art, Indiana, US','1500','../assets/img/item_image/eb48b13c90944de4afc2786b9dc93f96_face_mask_05062025144419.png','Box',NULL,NULL,'2025-05-06 22:44:19'),(49,'eb48b13c-9094-4de4-afc2-786b9dc93f96','Syringe','Terumo Syringe','medical supply','A syringe is a simple reciprocating pump consisting of a plunger that fits tightly within a cylindrical tube called a barrel. The plunger can be linearly pulled and pushed along the inside of the tube, allowing the syringe to take in and expel liquid or gas through a discharge orifice at the front (open) end of the tube. The open end of the syringe may be fitted with a hypodermic needle, a nozzle or tubing to direct the flow into and out of the barrel. Syringes are frequently used in clinical medicine to administer injections, infuse intravenous therapy into the bloodstream, apply compounds such as glue or lubricant, and draw/measure liquids. There are also prefilled syringes.','400','../assets/img/item_image/eb48b13c90944de4afc2786b9dc93f96_syringe_05072025140702.png','Box',NULL,NULL,'2025-05-07 22:07:02');
/*!40000 ALTER TABLE `med_availability` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `med_deliveries`
--

DROP TABLE IF EXISTS `med_deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `med_deliveries` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `request_med_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deliveries_accountId` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `delivery_status` enum('To Deliver','In Transit','Failed Delivery','Returned','Delivered','Partially Claimed','Claimed') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'To Deliver',
  `date_of_supply` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `deliveries_accountId` (`deliveries_accountId`),
  KEY `request_med_id` (`request_med_id`),
  CONSTRAINT `FK_med_deliveries_deliveries` FOREIGN KEY (`deliveries_accountId`) REFERENCES `deliveries` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_med_deliveries_request_med` FOREIGN KEY (`request_med_id`) REFERENCES `request_med` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `med_deliveries`
--

LOCK TABLES `med_deliveries` WRITE;
/*!40000 ALTER TABLE `med_deliveries` DISABLE KEYS */;
INSERT INTO `med_deliveries` VALUES ('0f6ee6f2-4ca5-408c-9371-293cb590f78f','ed7fc580-cfca-45a0-86b6-b771734579ba','360c0be8-bf56-4d1f-b52b-7fe06e0936b1','Partially Claimed','2025-05-08 00:00:00'),('3c6aadd3-8797-452b-8762-aa60420697b7','d8298afe-6e1e-4d9f-93e9-81e9975c9238','360c0be8-bf56-4d1f-b52b-7fe06e0936b1','Claimed','2025-05-09 00:00:00'),('b081e945-6ec6-46f4-8047-1bc32982ae61','e4a82539-3d3a-4487-858c-ed9cd97287ae','360c0be8-bf56-4d1f-b52b-7fe06e0936b1','Claimed','2025-05-09 00:00:00'),('b7dfb787-b739-41b7-b5f2-6943cec3c772','5ad156ff-79a0-4530-88ee-592f5ac1ae86','360c0be8-bf56-4d1f-b52b-7fe06e0936b1','Claimed','2025-05-08 00:00:00'),('c1ec6430-bc20-435b-9ef5-a4fea80f2df4','f4b7048d-c14f-4356-8c38-2f7115580261','360c0be8-bf56-4d1f-b52b-7fe06e0936b1','Claimed','2025-05-10 00:00:00');
/*!40000 ALTER TABLE `med_deliveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `med_deliveries_feedback`
--

DROP TABLE IF EXISTS `med_deliveries_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `med_deliveries_feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `med_delivery_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `delivery_condition` enum('good','damaged','missing items') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_med_deliveries_feedback_med_deliveries` (`med_delivery_id`),
  CONSTRAINT `FK_med_deliveries_feedback_med_deliveries` FOREIGN KEY (`med_delivery_id`) REFERENCES `med_deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `med_deliveries_feedback`
--

LOCK TABLES `med_deliveries_feedback` WRITE;
/*!40000 ALTER TABLE `med_deliveries_feedback` DISABLE KEYS */;
INSERT INTO `med_deliveries_feedback` VALUES (5,'b7dfb787-b739-41b7-b5f2-6943cec3c772','good','nice','2025-05-07 04:20:28'),(6,'c1ec6430-bc20-435b-9ef5-a4fea80f2df4','good','thank you','2025-05-07 07:20:03'),(7,'b081e945-6ec6-46f4-8047-1bc32982ae61','good','dfhfxnxcc','2025-05-07 14:02:57'),(8,'3c6aadd3-8797-452b-8762-aa60420697b7','good','sdyrg','2025-05-07 14:14:13');
/*!40000 ALTER TABLE `med_deliveries_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rate_and_feedback`
--

DROP TABLE IF EXISTS `rate_and_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rate_and_feedback` (
  `accountId` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rating` int NOT NULL,
  `feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
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
INSERT INTO `rate_and_feedback` VALUES ('18d236b6-3892-498f-8612-767f777a4f34',4,'nice siya','2025-04-09 08:11:12','2025-04-09 08:11:12'),('360c0be8-bf56-4d1f-b52b-7fe06e0936b1',3,'so far it&#039;s nice, i&#039;m a little bit concern about empty dashboard, I need to know my stats. Could you fix it please','2025-04-29 12:28:19','2025-04-29 12:28:19'),('6c0b0a91-03a3-4614-a6a9-1a46133e8a60',3,'ok na to','2025-04-05 17:03:56','2025-04-06 12:18:18'),('7594b921-87ea-437e-bd63-03e2809c3fc2',5,'the service is very good','2025-04-05 15:19:45','2025-04-17 12:18:26'),('8c3acd7e-264b-4f64-a954-a425f09b97a0',4,'So far, it&#039;s nice','2025-04-08 09:03:47','2025-04-08 09:03:47'),('eb48b13c-9094-4de4-afc2-786b9dc93f96',4,'it&#039;s ok now, i guess','2025-04-05 16:24:03','2025-04-17 02:57:54'),('f3e92e97-dcb4-4e41-bfa0-a1b896ee2766',5,'this is great!','2025-04-05 19:15:17','2025-04-21 12:05:19');
/*!40000 ALTER TABLE `rate_and_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_med`
--

DROP TABLE IF EXISTS `request_med`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `request_med` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `barangay_inc_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `med_avail_Id` int NOT NULL,
  `request_quantity` varchar(100) NOT NULL,
  `requestStatus` enum('Pending','Accepted','Cancelled') NOT NULL DEFAULT 'Pending',
  `document` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `barangay_inc_id` (`barangay_inc_id`),
  KEY `med_avail_Id` (`med_avail_Id`),
  CONSTRAINT `FK_request_med_barangay_inc` FOREIGN KEY (`barangay_inc_id`) REFERENCES `barangay_inc` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_request_med_med_availabilty` FOREIGN KEY (`med_avail_Id`) REFERENCES `med_availability` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_med`
--

LOCK TABLES `request_med` WRITE;
/*!40000 ALTER TABLE `request_med` DISABLE KEYS */;
INSERT INTO `request_med` VALUES ('5ad156ff-79a0-4530-88ee-592f5ac1ae86','55359fe8-e86a-4670-b0bf-4277c3c5d07f',47,'200','Accepted','../assets/img/upload_document/ddaeaaf1-dc47-4d96-9063-f4215de7ed34.png'),('d8298afe-6e1e-4d9f-93e9-81e9975c9238','eb5452e2-2e5a-4510-9e0e-abac5714e03f',49,'25','Accepted','../assets/img/upload_document/febbd1a0-0339-4164-88e2-c5b263d44f57.png'),('e4a82539-3d3a-4487-858c-ed9cd97287ae','eb5452e2-2e5a-4510-9e0e-abac5714e03f',48,'100','Accepted','../assets/img/upload_document/bbd3fd4d-6245-4d34-8a8a-e5f00716c065.png'),('ed7fc580-cfca-45a0-86b6-b771734579ba','8c3acd7e-264b-4f64-a954-a425f09b97a0',47,'100','Accepted','../assets/img/upload_document/2b50692d-fd66-4424-aac4-f745dc803282.png'),('f4b7048d-c14f-4356-8c38-2f7115580261','55359fe8-e86a-4670-b0bf-4277c3c5d07f',48,'50','Accepted','../assets/img/upload_document/e94e22a9-5974-48d9-b3c2-03a3ab5edbe0.png');
/*!40000 ALTER TABLE `request_med` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `standard_total_partially_claimed`
--

DROP TABLE IF EXISTS `standard_total_partially_claimed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `standard_total_partially_claimed` (
  `id` int NOT NULL AUTO_INCREMENT,
  `delivery_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_partially_claimed` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_standard_total_partially_claimed_med_deliveries` (`delivery_id`),
  CONSTRAINT `FK_standard_total_partially_claimed_med_deliveries` FOREIGN KEY (`delivery_id`) REFERENCES `med_deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `standard_total_partially_claimed`
--

LOCK TABLES `standard_total_partially_claimed` WRITE;
/*!40000 ALTER TABLE `standard_total_partially_claimed` DISABLE KEYS */;
INSERT INTO `standard_total_partially_claimed` VALUES (1,'c1ec6430-bc20-435b-9ef5-a4fea80f2df4',200,'2025-05-07 05:28:08'),(4,'c1ec6430-bc20-435b-9ef5-a4fea80f2df4',50,'2025-05-07 07:06:36'),(5,'b081e945-6ec6-46f4-8047-1bc32982ae61',100,'2025-05-07 13:52:03'),(6,'3c6aadd3-8797-452b-8762-aa60420697b7',50,'2025-05-07 14:09:53'),(7,'3c6aadd3-8797-452b-8762-aa60420697b7',25,'2025-05-07 14:13:11'),(8,'0f6ee6f2-4ca5-408c-9371-293cb590f78f',100,'2025-05-07 14:19:53');
/*!40000 ALTER TABLE `standard_total_partially_claimed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscription` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `barangay_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `receipt` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `plan` enum('Annual','Monthly') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `amount` int NOT NULL,
  `approve_status` enum('Approved','Cancelled','Pending') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `cancel_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
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
INSERT INTO `subscription` VALUES ('1553331e-68f3-40dd-8a54-c5269dd85662','21bf6022-4553-44af-b5d1-2075179428f9','../assets/img/upload_receipt/1553331e-68f3-40dd-8a54-c5269dd85662.png','Annual',2999,'Approved','2025-04-29','2026-04-29',NULL,'2025-04-29 01:08:47'),('4b0c6fab-477c-4894-a00c-bf8bd7f34eca','d3da9bb6-b666-48c7-8310-ce227a2a9461','../assets/img/upload_receipt/4b0c6fab-477c-4894-a00c-bf8bd7f34eca.png','Annual',2999,'Approved','2025-04-09','2026-04-09',NULL,'2025-04-09 13:38:36'),('4b4f63b2-fcc8-413b-bdab-ca41271f60d4','3aeb96d7-b7f5-44d4-8bad-6a04cdd75477','../assets/img/upload_receipt/4b4f63b2-fcc8-413b-bdab-ca41271f60d4.png','Annual',2999,'Approved','2025-04-09','2026-04-09',NULL,'2025-04-09 22:40:42'),('5065e9bd-1c2e-4d74-8113-1b0046af435e','d3da9bb6-b666-48c7-8310-ce227a2a9461','../assets/img/upload_receipt/5065e9bd-1c2e-4d74-8113-1b0046af435e.png','Annual',2999,'Cancelled',NULL,NULL,'The photo you uploaded was not a receipt, please try to resubscribe again and upload the real receipt, a much clearer photo would be much appreciated!','2025-04-09 00:36:45'),('60151199-3307-4984-bd79-e82f0fbddc7c','18d236b6-3892-498f-8612-767f777a4f34','../assets/img/upload_receipt/60151199-3307-4984-bd79-e82f0fbddc7c.png','Monthly',299,'Cancelled',NULL,NULL,'The photo you uploaded was not a receipt, please try to resubscribe again and upload the real receipt, a much clearer one would be highly appreciated','2025-04-09 01:27:24'),('8629a7dc-a6d8-4067-bc8c-6b045712592f','6c0b0a91-03a3-4614-a6a9-1a46133e8a60','../assets/img/upload_receipt/8629a7dc-a6d8-4067-bc8c-6b045712592f.png','Monthly',299,'Cancelled',NULL,NULL,'The receipt you uploaded was blurry, I can&#039;t read the reference no. Please try to resubscribe and upload a much clearer photo of receipt. Thank You!','2025-04-09 03:05:43'),('955afd1c-d8bc-479a-a168-92687178e568','2f0444ac-230a-480e-9c4e-d5f68ccfe069','../assets/img/upload_receipt/955afd1c-d8bc-479a-a168-92687178e568.png','Annual',2999,'Approved','2025-04-08','2026-04-08',NULL,'2025-04-08 13:50:24'),('bb78de00-43ba-4617-b04d-9132c779c46f','55359fe8-e86a-4670-b0bf-4277c3c5d07f','../assets/img/upload_receipt/bb78de00-43ba-4617-b04d-9132c779c46f.png','Monthly',299,'Approved','2025-04-14','2025-05-14',NULL,'2025-04-14 13:01:03'),('be1a1571-ba79-42c8-b06e-27f562c91e6f','18d236b6-3892-498f-8612-767f777a4f34','../assets/img/upload_receipt/be1a1571-ba79-42c8-b06e-27f562c91e6f.png','Monthly',299,'Approved','2025-04-09','2025-05-09',NULL,'2025-04-09 13:41:09'),('c1273f93-0f40-4cb8-8c47-531bc4856ed3','6c0b0a91-03a3-4614-a6a9-1a46133e8a60','../assets/img/upload_receipt/c1273f93-0f40-4cb8-8c47-531bc4856ed3.png','Monthly',299,'Approved','2025-04-09','2025-05-09',NULL,'2025-04-09 03:13:10'),('c4549a95-6eb7-4b3b-9257-568df429ec2c','8c3acd7e-264b-4f64-a954-a425f09b97a0','../assets/img/upload_receipt/c4549a95-6eb7-4b3b-9257-568df429ec2c.png','Annual',2999,'Approved','2025-04-09','2026-04-09',NULL,'2025-04-09 01:13:49'),('cee3e00d-09c5-47aa-a874-b2f412f7d342','eb5452e2-2e5a-4510-9e0e-abac5714e03f','../assets/img/upload_receipt/cee3e00d-09c5-47aa-a874-b2f412f7d342.png','Monthly',299,'Approved','2025-04-11','2025-05-11',NULL,'2025-04-11 21:44:50'),('f94bd7d9-06cc-4e47-9ecf-7f64157cd46d','343e3676-6281-45d4-ab39-25eb15909b8b','../assets/img/upload_receipt/f94bd7d9-06cc-4e47-9ecf-7f64157cd46d.png','Annual',2999,'Approved','2025-04-08','2026-04-08',NULL,'2025-04-08 13:56:17'),('fc2e2a2b-3b54-42d9-a27c-f40618937eb7','c1cb89f6-159f-4a70-a65f-c9c823a66f81','../assets/img/upload_receipt/fc2e2a2b-3b54-42d9-a27c-f40618937eb7.png','Annual',2999,'Approved','2025-04-14','2026-04-14',NULL,'2025-04-14 09:47:43');
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

-- Dump completed on 2025-05-07 22:23:39
