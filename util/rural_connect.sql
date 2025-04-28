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
  PRIMARY KEY (`accountId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES ('18d236b6-3892-498f-8612-767f777a4f34','bernard_wilson@mailinator.com','bernard_wilson','$2y$12$Z0OI3idGKBl0HVIYbz8yzua.zTz6Qx8.3ziIDXXkzUXKGnkv5pX76','barangay_inc',NULL,'',1,0,'Approved','2025-03-09 01:25:09'),('1bb43733-7b54-4068-b40c-ae921611a37e','finneas_heath@mailinator.com','finneas_heath','$2y$12$eaK.Y3mRtBKJsDuH1Px9nuDW5iFgkk9QuIns8ARkmRbfAVaIkCZdq','deliveries',NULL,'',1,0,'Approved','2025-04-15 01:02:38'),('21bf6022-4553-44af-b5d1-2075179428f9','rari_fox@mailinator.com','rari_fox','$2y$12$PI/rYZAev3.L1GlYaCeSheDLI1.dp/Z.VNQVF7zeRSmRQNfujeOIG','barangay_inc',NULL,'',1,0,'Approved','2025-04-28 09:01:10'),('2f0444ac-230a-480e-9c4e-d5f68ccfe069','arizonamaine@mailinator.com','arizonamaine','$2y$12$CgDPRB1aiVkujYnzrcSZyeaVZ0IDXpcU4QSU8WH7vTH9wrfN9VUEW','barangay_inc',NULL,'',1,0,'Approved','2025-03-08 09:19:57'),('343e3676-6281-45d4-ab39-25eb15909b8b','janesmith@mailinator.com','janesmith','$2y$12$UEDCn08E9aDLAeJSFUdI4.BUo16ZMf6DJUBtuKdrJobP.BvxZdWYi','barangay_inc',NULL,'',1,0,'Approved','2025-03-08 01:45:49'),('360c0be8-bf56-4d1f-b52b-7fe06e0936b1','anthony_wang@mailinator.com','anthony_wang','$2y$12$CXrCOEawyq4N1F29m8Ig1eP.yD3iz31e1/7zSy1PYC6qcAPT8XWoK','deliveries',NULL,'',1,0,'Approved','2025-04-17 04:26:42'),('37e0429a-e9d2-4355-bb9a-8b0cb3c9a40f','rigor_tangor@mailinator.com','rigor_tangor','$2y$12$WxTQAxBC.GdyEdkqlweAeeclXsf/U.hCCj9LUV9rsaY8zmcPmuLOi','deliveries',NULL,'',1,0,'Approved','2025-04-27 15:18:23'),('3aeb96d7-b7f5-44d4-8bad-6a04cdd75477','junocarpenter@mailinator.com','junocarpenter','$2y$12$auIK3QA6E/exPVZuhcjgt.U6FzOWZ/grwH5BUs9zifVyfNE8cU00W','barangay_inc',NULL,'',1,0,'Approved','2025-04-07 15:52:05'),('55359fe8-e86a-4670-b0bf-4277c3c5d07f','virginia_montgomery@mailinator.com','virginia_montgomery','$2y$12$.dDjw9o2T2FUsqNixmoaXOPYN60syXbZbtUfxjuutYwjqrDWpKVwq','barangay_inc',NULL,'',1,0,'Approved','2025-04-09 11:24:45'),('66dcf1bd-51e1-45e3-8727-0c343577bdd5','ericsonmariebautista@mailinator.com','ericsonmariebautista','$2y$12$YmCH90LAvl5jQ5CL3VqCGuM8RncYfDQPawrym2tkuDT8QFETpJSvq','admin',NULL,NULL,1,0,'Approved','2025-04-03 22:06:46'),('6c0b0a91-03a3-4614-a6a9-1a46133e8a60','ladyglittersmackles@gmail.com','anuada_1990','$2y$12$EdnfZqOmV.zsuo/oqWEzi.TcnlOSoXdVMABsfPhSbmznsvNN9NceC','barangay_inc','','',1,0,'Approved','2025-03-03 17:40:37'),('74158fcb-d946-4787-b7c5-8ccaa3b30660','heroshigonzales@gmail.com','heroshi_paro','$2y$12$siu6lpmvdADUMoO9EH.K3u31kbwFXet8P8ia3vNbcsOotWagX.Ob2','admin','',NULL,1,0,'Approved','2025-04-03 17:40:35'),('7594b921-87ea-437e-bd63-03e2809c3fc2','mariah_carey@mailinator.com','therealmariah_carey','$2y$12$IgCsOGlwdMcN5OjVls3LS..2qxwvT2weN9H3rNLZyoFVaAqEecauy','deliveries','','',1,0,'Approved','2025-03-03 17:40:38'),('8c3acd7e-264b-4f64-a954-a425f09b97a0','laquantisha_johnson@mailinator.com','laquantisha_johnson','$2y$12$9UaUeUoxMAfjHkYF1Ew6eOgJheGr3BxLeVbGiSQDa1UXkYzYqbkKm','barangay_inc',NULL,'',1,0,'Approved','2025-04-08 03:04:03'),('a96ea61e-db52-4a28-a77b-efe8492ec2d4','olivia_rodrigo@mailinator.com','olivia_rodrigo','$2y$12$StCEnZ/CdF/R2kbv1iu9Z.AucFajV.1AyuubgPzfEZ3qgu966tnjW','deliveries',NULL,'',1,0,'Approved','2025-03-09 15:32:58'),('b23ea846-a9fc-473a-9296-f12957e0e67c','jean_delatorre@mailinator.com','jean_delatorre','$2y$12$tOrl/gM3GujHBhMFTTb9O.CY8BPaYz2yZRGq7U.TfJF3rDxchVU9y','barangay_inc',NULL,'',1,0,'Approved','2025-04-27 14:16:00'),('b5b54cf0-da93-401e-a353-2d2917210971','mharbenreypude.854@gmail.com','mharbenreypude','$2y$10$MRJGneSncga1iXrV18RFdu/GsLnp2CC944obFOVF38/FgS0v6cnEq','admin',NULL,NULL,1,0,'Approved','2025-04-03 21:50:07'),('c1cb89f6-159f-4a70-a65f-c9c823a66f81','isabella_cruz@mailinator.com','isabella_cruz','$2y$12$.oyHB8TcOW3sYPao4QuzWO36LywgXAyZfIbBPkbKEDQxoyWkSkoxK','barangay_inc',NULL,'',1,0,'Approved','2025-04-14 13:56:35'),('d1b0d961-4460-444a-a7f2-0117347d28d2','jerryegamp21@gmail.com','jerryegamp21','$2y$10$GS6uoCetYreZQnAUhyFefefEjK1HgV.TO4pM0.041LDIc7ggnDePC','admin',NULL,NULL,1,0,'Approved','2025-04-03 21:59:17'),('d3da9bb6-b666-48c7-8310-ce227a2a9461','rana_guzman@mailinator.com','rana_guzman','$2y$12$ig4ASdaVOTf/v0K0gxVI1uiwybQUUEqi.NXi5dR69I4gE58NBLZci','barangay_inc',NULL,'',1,0,'Approved','2025-04-09 00:15:46'),('eb48b13c-9094-4de4-afc2-786b9dc93f96','christopher_pareyac@mailinator.com','christopher_pareyac','$2y$12$SYJ2EzTPsN7HYue9LU9PaOt6CXInIJjeJ9.7jwzJSSNnfVeJLpZHa','city_health','','',1,0,'Approved','2025-02-28 17:40:39'),('eb5452e2-2e5a-4510-9e0e-abac5714e03f','duncan_pello@mailinator.com','duncan_pello','$2y$12$nNIUEJOhe6y94BvBguJnsu0bU2lvkPvA.G0a36nz7JrPtzOFey.HK','barangay_inc',NULL,'',1,0,'Approved','2025-04-08 03:43:06'),('f3e92e97-dcb4-4e41-bfa0-a1b896ee2766','dualipa@mailinator.com','dualipa','$2y$12$1s/VeHUvlf.9hF7N9Kh7COkgwB9ZRa8QSsfqQkMMUnhqmtuQVJp92','deliveries',NULL,'',1,0,'Approved','2025-04-07 05:58:42');
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
INSERT INTO `admin` VALUES ('66dcf1bd-51e1-45e3-8727-0c343577bdd5','Ericson Marie','Bautista','Floptropica City, Floptropica','1990-01-31','09189389183','../assets/img/profile/admin/66dcf1bd-51e1-45e3-8727-0c343577bdd5.png'),('74158fcb-d946-4787-b7c5-8ccaa3b30660','Heroshi','Paro','Curvada, Juan Climaco Sr., Toledo City, Cebu','2002-01-31','09293820193','../assets/img/profile/admin/74158fcb-d946-4787-b7c5-8ccaa3b30660.png'),('b5b54cf0-da93-401e-a353-2d2917210971','Mharben Rey','Pude','Tres de Abril St., Cebu City, Cebu 6000','1998-10-16','09282719482','../assets/img/profile/admin/b5b54cf0-da93-401e-a353-2d2917210971.png'),('d1b0d961-4460-444a-a7f2-0117347d28d2','Jeremy','Gamboa','Tinabangay 2 Alaska Mambaling Cebu city, 6000','2000-12-21','09193828493','../assets/img/profile/admin/d1b0d961-4460-444a-a7f2-0117347d28d2.png');
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
  `id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `custom_med_request_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `delivery_account_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `delivery_status` enum('To Deliver','In Transit','Failed Delivery','Returned','Delivered','Claimed') COLLATE utf8mb4_general_ci DEFAULT 'To Deliver',
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
INSERT INTO `custom_med_deliveries` VALUES ('4736e67d-002a-4086-903c-0aa031d4b376','8d01d3f2-7698-4641-901b-58eda1788760','360c0be8-bf56-4d1f-b52b-7fe06e0936b1','Claimed','2025-04-23 00:00:00');
/*!40000 ALTER TABLE `custom_med_deliveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_med_delivery_status_history`
--

DROP TABLE IF EXISTS `custom_med_delivery_status_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `custom_med_delivery_status_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `delivery_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('To Deliver','In Transit','Failed Delivery','Returned','Delivered','Claimed') COLLATE utf8mb4_general_ci DEFAULT 'To Deliver',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_custom_med_delivery_status_history_custom_med_deliveries` (`delivery_id`),
  CONSTRAINT `FK_custom_med_delivery_status_history_custom_med_deliveries` FOREIGN KEY (`delivery_id`) REFERENCES `custom_med_deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_med_delivery_status_history`
--

LOCK TABLES `custom_med_delivery_status_history` WRITE;
/*!40000 ALTER TABLE `custom_med_delivery_status_history` DISABLE KEYS */;
INSERT INTO `custom_med_delivery_status_history` VALUES (5,'4736e67d-002a-4086-903c-0aa031d4b376','To Deliver','2025-04-22 09:37:51'),(6,'4736e67d-002a-4086-903c-0aa031d4b376','In Transit','2025-04-24 09:14:07'),(7,'4736e67d-002a-4086-903c-0aa031d4b376','Delivered','2025-04-24 09:14:32'),(8,'4736e67d-002a-4086-903c-0aa031d4b376','Returned','2025-04-24 09:14:44'),(9,'4736e67d-002a-4086-903c-0aa031d4b376','In Transit','2025-04-24 09:14:52'),(10,'4736e67d-002a-4086-903c-0aa031d4b376','Delivered','2025-04-24 09:15:03'),(11,'4736e67d-002a-4086-903c-0aa031d4b376','Claimed','2025-04-24 09:15:09');
/*!40000 ALTER TABLE `custom_med_delivery_status_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_med_request`
--

DROP TABLE IF EXISTS `custom_med_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `custom_med_request` (
  `id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `barangay_inc_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `requested_medicine` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `requested_quantity` int NOT NULL DEFAULT '0',
  `category` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `unit` enum('Piece','Box','Bottle') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dosage_strength` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `document` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
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
INSERT INTO `custom_med_request` VALUES ('8d01d3f2-7698-4641-901b-58eda1788760','eb5452e2-2e5a-4510-9e0e-abac5714e03f','Loratadine',50,'Antihistamine (Allergy Relief)','Box','10 mg','../assets/img/upload_document/c3e7923e-36a7-4034-b8a6-2a81671b3c9a.png','Accepted','2025-04-22 06:31:12'),('d4f96cc7-c571-4aca-af20-507d828828a4','6c0b0a91-03a3-4614-a6a9-1a46133e8a60','Carbocisteine',100,'mucolytics','Box','500ml','../assets/img/upload_document/73d5c472-ef48-4887-b8f8-31fa2059d5f2.png','Pending','2025-04-19 07:27:41');
/*!40000 ALTER TABLE `custom_med_request` ENABLE KEYS */;
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
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_deliveries_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deliveries`
--

LOCK TABLES `deliveries` WRITE;
/*!40000 ALTER TABLE `deliveries` DISABLE KEYS */;
INSERT INTO `deliveries` VALUES ('1bb43733-7b54-4068-b40c-ae921611a37e','Finneas','Heath','Floptropica, Cebu City','09739647867','../assets/img/profile/deleviries/1bb43733-7b54-4068-b40c-ae921611a37e.png'),('360c0be8-bf56-4d1f-b52b-7fe06e0936b1','Anthony','Wang','Floptropica City, Floptropica','09182738291','../assets/img/profile/deleviries/360c0be8-bf56-4d1f-b52b-7fe06e0936b1.png'),('37e0429a-e9d2-4355-bb9a-8b0cb3c9a40f','Rigor','Tangor','Floptropica St. Guba, Cebu City','09591967282','../assets/img/profile/deleviries/37e0429a-e9d2-4355-bb9a-8b0cb3c9a40f.png'),('7594b921-87ea-437e-bd63-03e2809c3fc2','Mariah','Carey','Floptropica','09284738274','../assets/img/profile/deleviries/7594b921-87ea-437e-bd63-03e2809c3fc2.png'),('a96ea61e-db52-4a28-a77b-efe8492ec2d4','Olivia','Rodrigo','London, Pardo Cebu City','09592930132','../assets/img/profile/deleviries/a96ea61e-db52-4a28-a77b-efe8492ec2d4.png'),('f3e92e97-dcb4-4e41-bfa0-a1b896ee2766','Dua','Lipa','London, Pardo Cebu City','09939294859','../assets/img/profile/deleviries/f3e92e97-dcb4-4e41-bfa0-a1b896ee2766.png');
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
  `delivery_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('To Deliver','In Transit','Failed Delivery','Returned','Delivered','Claimed') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'To Deliver',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_delivery_status_history_med_deliveries` (`delivery_id`),
  CONSTRAINT `FK_delivery_status_history_med_deliveries` FOREIGN KEY (`delivery_id`) REFERENCES `med_deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_status_history`
--

LOCK TABLES `delivery_status_history` WRITE;
/*!40000 ALTER TABLE `delivery_status_history` DISABLE KEYS */;
INSERT INTO `delivery_status_history` VALUES (29,'ec388ee0-a747-4a09-8d2b-d0a31acdd414','To Deliver','2025-04-25 04:14:20'),(30,'ec388ee0-a747-4a09-8d2b-d0a31acdd414','In Transit','2025-04-25 04:16:57'),(31,'ec388ee0-a747-4a09-8d2b-d0a31acdd414','Failed Delivery','2025-04-25 04:17:18'),(32,'ec388ee0-a747-4a09-8d2b-d0a31acdd414','In Transit','2025-04-25 04:18:10'),(33,'ec388ee0-a747-4a09-8d2b-d0a31acdd414','Delivered','2025-04-25 04:19:09'),(34,'ec388ee0-a747-4a09-8d2b-d0a31acdd414','Claimed','2025-04-25 04:19:21');
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
  `med_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `brand_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `med_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `med_image` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `unit` enum('Piece','Box','Bottle') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dosage_strength` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_health_id` (`city_health_id`),
  CONSTRAINT `FK_med_availabilty_city_health` FOREIGN KEY (`city_health_id`) REFERENCES `city_health` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `med_availability`
--

LOCK TABLES `med_availability` WRITE;
/*!40000 ALTER TABLE `med_availability` DISABLE KEYS */;
INSERT INTO `med_availability` VALUES (30,'eb48b13c-9094-4de4-afc2-786b9dc93f96','Paracetamol','Biogesic','analgesic and antipyretic','Paracetamol, or acetaminophen, is a non-opioid analgesic and antipyretic agent used to treat fever and mild to moderate pain. It is a widely available over-the-counter drug sold under various brand names, including Tylenol and Panadol.','1200','2025-04-25 09:54:33','../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_paracetamol_04252025015433.png','Box','500mg'),(31,'eb48b13c-9094-4de4-afc2-786b9dc93f96','Ibuprofen','RiteMed','nonsteroidal anti-inflammatory drug (NSAID)','Ibuprofen is a nonsteroidal anti-inflammatory drug (NSAID) that is used to relieve pain, fever, and inflammation. This includes painful menstrual periods, migraines, and rheumatoid arthritis. It may also be used to close a patent ductus arteriosus in a premature baby. It can be taken orally or intravenously. It typically begins working within an hour.','1000','2025-04-25 11:48:27','../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_ibuprofen_04252025034827.png','Box','200mg'),(35,'eb48b13c-9094-4de4-afc2-786b9dc93f96','Ibuprofen/Paracetamol','Alaxan FR','non-steroidal anti-inflammatory drug (NSAID)/analgesic and antipyretic','Ibuprofen/paracetamol, sold under the brand name Combogesic among others, is a fixed-dose combination of two medications, ibuprofen, a non-steroidal anti-inflammatory drug (NSAID); and paracetamol (acetaminophen), an analgesic and antipyretic. It is available as a generic medication.','1000','2025-04-25 12:03:35','../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_ibuprofen_paracetamol_04252025040335.png','Box','200mg/325mg'),(36,'eb48b13c-9094-4de4-afc2-786b9dc93f96','Amoxicillin','Ambimox','antibiotic','Amoxicillin is an antibiotic medication belonging to the aminopenicillin class of the penicillin family. The drug is used to treat bacterial infections such as middle ear infection, strep throat, pneumonia, skin infections, odontogenic infections, and urinary tract infections. It is taken orally, or less commonly by either intramuscular injection or by an IV bolus injection, which is a relatively quick intravenous injection lasting from a couple of seconds to a few minutes.','1000','2025-04-25 15:29:55','../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_amoxicillin_04252025072955.png','Box','500mg'),(37,'eb48b13c-9094-4de4-afc2-786b9dc93f96','Salbutamol','Bronchosar','Bronchodilator','Salbutamol, also known as albuterol and sold under the brand name Ventolin among others, is a medication that opens up the medium and large airways in the lungs. It is a short-acting β2 adrenergic receptor agonist that causes relaxation of airway smooth muscle. It is used to treat asthma, including asthma attacks and exercise-induced bronchoconstriction, as well as chronic obstructive pulmonary disease (COPD). It may also be used to treat high blood potassium levels. Salbutamol is usually used with an inhaler or nebulizer, but it is also available in a pill, liquid, and intravenous solution. Onset of action of the inhaled version is typically within 15 minutes and lasts for two to six hours.','500','2025-04-26 05:33:08','../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_salbutamol_04252025213308.png','Box','100mcg/puff'),(38,'eb48b13c-9094-4de4-afc2-786b9dc93f96','Omeprazole','Unilab','Proton Pump Inhibitor (PPI)','Omeprazole, sold under the brand names Prilosec and Losec, among others, is a medication used in the treatment of gastroesophageal reflux disease (GERD), peptic ulcer disease, and Zollinger–Ellison syndrome. It is also used to prevent upper gastrointestinal bleeding in people who are at high risk. Omeprazole is a proton-pump inhibitor (PPI) and its effectiveness is similar to that of other PPIs. It can be taken by mouth or by injection into a vein. It is also available in the fixed-dose combination medication omeprazole/sodium bicarbonate as Zegerid and as Konvomep.','1000','2025-04-26 13:48:21','../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_omeprazole_04262025054821.png','Box','20mg');
/*!40000 ALTER TABLE `med_availability` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `med_deliveries`
--

DROP TABLE IF EXISTS `med_deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `med_deliveries` (
  `id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `request_med_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `deliveries_accountId` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `delivery_status` enum('To Deliver','In Transit','Failed Delivery','Returned','Delivered','Claimed') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'To Deliver',
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
INSERT INTO `med_deliveries` VALUES ('ec388ee0-a747-4a09-8d2b-d0a31acdd414','0eb50151-db29-43d5-bc39-fc34b038de88','7594b921-87ea-437e-bd63-03e2809c3fc2','Claimed','2025-04-26 00:00:00');
/*!40000 ALTER TABLE `med_deliveries` ENABLE KEYS */;
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
INSERT INTO `rate_and_feedback` VALUES ('18d236b6-3892-498f-8612-767f777a4f34',4,'nice siya','2025-04-09 08:11:12','2025-04-09 08:11:12'),('6c0b0a91-03a3-4614-a6a9-1a46133e8a60',3,'ok na to','2025-04-05 17:03:56','2025-04-06 12:18:18'),('7594b921-87ea-437e-bd63-03e2809c3fc2',5,'the service is very good','2025-04-05 15:19:45','2025-04-17 12:18:26'),('8c3acd7e-264b-4f64-a954-a425f09b97a0',4,'So far, it&#039;s nice','2025-04-08 09:03:47','2025-04-08 09:03:47'),('eb48b13c-9094-4de4-afc2-786b9dc93f96',4,'it&#039;s ok now, i guess','2025-04-05 16:24:03','2025-04-17 02:57:54'),('f3e92e97-dcb4-4e41-bfa0-a1b896ee2766',5,'this is great!','2025-04-05 19:15:17','2025-04-21 12:05:19');
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
INSERT INTO `request_med` VALUES ('0eb50151-db29-43d5-bc39-fc34b038de88','6c0b0a91-03a3-4614-a6a9-1a46133e8a60',31,'200','Accepted','../assets/img/upload_document/895782a2-7587-4ceb-baa5-e13b69a2d652.png');
/*!40000 ALTER TABLE `request_med` ENABLE KEYS */;
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
INSERT INTO `subscription` VALUES ('1553331e-68f3-40dd-8a54-c5269dd85662','21bf6022-4553-44af-b5d1-2075179428f9','../assets/img/upload_receipt/1553331e-68f3-40dd-8a54-c5269dd85662.png','Annual',2999,'Pending',NULL,NULL,NULL,'2025-04-28 09:05:26'),('4b0c6fab-477c-4894-a00c-bf8bd7f34eca','d3da9bb6-b666-48c7-8310-ce227a2a9461','../assets/img/upload_receipt/4b0c6fab-477c-4894-a00c-bf8bd7f34eca.png','Annual',2999,'Approved','2025-04-09','2026-04-09',NULL,'2025-04-09 13:38:36'),('4b4f63b2-fcc8-413b-bdab-ca41271f60d4','3aeb96d7-b7f5-44d4-8bad-6a04cdd75477','../assets/img/upload_receipt/4b4f63b2-fcc8-413b-bdab-ca41271f60d4.png','Annual',2999,'Approved','2025-04-09','2026-04-09',NULL,'2025-04-09 22:40:42'),('5065e9bd-1c2e-4d74-8113-1b0046af435e','d3da9bb6-b666-48c7-8310-ce227a2a9461','../assets/img/upload_receipt/5065e9bd-1c2e-4d74-8113-1b0046af435e.png','Annual',2999,'Cancelled',NULL,NULL,'The photo you uploaded was not a receipt, please try to resubscribe again and upload the real receipt, a much clearer photo would be much appreciated!','2025-04-09 00:36:45'),('60151199-3307-4984-bd79-e82f0fbddc7c','18d236b6-3892-498f-8612-767f777a4f34','../assets/img/upload_receipt/60151199-3307-4984-bd79-e82f0fbddc7c.png','Monthly',299,'Cancelled',NULL,NULL,'The photo you uploaded was not a receipt, please try to resubscribe again and upload the real receipt, a much clearer one would be highly appreciated','2025-04-09 01:27:24'),('8629a7dc-a6d8-4067-bc8c-6b045712592f','6c0b0a91-03a3-4614-a6a9-1a46133e8a60','../assets/img/upload_receipt/8629a7dc-a6d8-4067-bc8c-6b045712592f.png','Monthly',299,'Cancelled',NULL,NULL,'The receipt you uploaded was blurry, I can&#039;t read the reference no. Please try to resubscribe and upload a much clearer photo of receipt. Thank You!','2025-04-09 03:05:43'),('955afd1c-d8bc-479a-a168-92687178e568','2f0444ac-230a-480e-9c4e-d5f68ccfe069','../assets/img/upload_receipt/955afd1c-d8bc-479a-a168-92687178e568.png','Annual',2999,'Approved','2025-04-08','2026-04-08',NULL,'2025-04-08 13:50:24'),('bb78de00-43ba-4617-b04d-9132c779c46f','55359fe8-e86a-4670-b0bf-4277c3c5d07f','../assets/img/upload_receipt/bb78de00-43ba-4617-b04d-9132c779c46f.png','Monthly',299,'Approved','2025-04-14','2025-05-14',NULL,'2025-04-14 13:01:03'),('be1a1571-ba79-42c8-b06e-27f562c91e6f','18d236b6-3892-498f-8612-767f777a4f34','../assets/img/upload_receipt/be1a1571-ba79-42c8-b06e-27f562c91e6f.png','Monthly',299,'Approved','2025-04-09','2025-05-09',NULL,'2025-04-09 13:41:09'),('c1273f93-0f40-4cb8-8c47-531bc4856ed3','6c0b0a91-03a3-4614-a6a9-1a46133e8a60','../assets/img/upload_receipt/c1273f93-0f40-4cb8-8c47-531bc4856ed3.png','Monthly',299,'Approved','2025-04-09','2025-05-09',NULL,'2025-04-09 03:13:10'),('c4549a95-6eb7-4b3b-9257-568df429ec2c','8c3acd7e-264b-4f64-a954-a425f09b97a0','../assets/img/upload_receipt/c4549a95-6eb7-4b3b-9257-568df429ec2c.png','Annual',2999,'Approved','2025-04-09','2026-04-09',NULL,'2025-04-09 01:13:49'),('cee3e00d-09c5-47aa-a874-b2f412f7d342','eb5452e2-2e5a-4510-9e0e-abac5714e03f','../assets/img/upload_receipt/cee3e00d-09c5-47aa-a874-b2f412f7d342.png','Monthly',299,'Approved','2025-04-11','2025-05-11',NULL,'2025-04-11 21:44:50'),('f94bd7d9-06cc-4e47-9ecf-7f64157cd46d','343e3676-6281-45d4-ab39-25eb15909b8b','../assets/img/upload_receipt/f94bd7d9-06cc-4e47-9ecf-7f64157cd46d.png','Annual',2999,'Approved','2025-04-08','2026-04-08',NULL,'2025-04-08 13:56:17'),('fc2e2a2b-3b54-42d9-a27c-f40618937eb7','c1cb89f6-159f-4a70-a65f-c9c823a66f81','../assets/img/upload_receipt/fc2e2a2b-3b54-42d9-a27c-f40618937eb7.png','Annual',2999,'Approved','2025-04-14','2026-04-14',NULL,'2025-04-14 09:47:43');
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

-- Dump completed on 2025-04-28 17:51:19
