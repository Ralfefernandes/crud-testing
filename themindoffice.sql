-- MariaDB dump 10.19  Distrib 10.6.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: themindoffice
-- ------------------------------------------------------
-- Server version	10.6.12-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adressen`
--

DROP TABLE IF EXISTS `adressen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adressen` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `beschrijving` varchar(255) NOT NULL,
  `straatnaam` varchar(255) NOT NULL,
  `huisnummer` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `plaatsnaam` varchar(255) NOT NULL,
  `land` varchar(255) NOT NULL,
  `kvk` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `adressen_kvk_foreign` (`kvk`),
  CONSTRAINT `adressen_kvk_foreign` FOREIGN KEY (`kvk`) REFERENCES `bedrijven` (`kvk`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adressen`
--

LOCK TABLES `adressen` WRITE;
/*!40000 ALTER TABLE `adressen` DISABLE KEYS */;
INSERT INTO `adressen` VALUES (1,'Beschrijving 1','First Street','14','7153 DN','City D','Country Y','13054526',NULL,NULL),(2,'Beschrijving 2','Third Street','50','3748 BH','City B','Country Y','84250938',NULL,NULL),(3,'Beschrijving 3','Fifth Street','45','2145 FF','City C','Country Y','69445090',NULL,NULL),(4,'Beschrijving 4','First Street','65','5025 SK','City E','Country X','29617912',NULL,NULL),(5,'Arroz doce','The Mind Office','5588 PB','3585 BV','Amsterdam','Angola','7359434',NULL,'2023-05-14 19:20:52');
/*!40000 ALTER TABLE `adressen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bedrijven`
--

DROP TABLE IF EXISTS `bedrijven`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bedrijven` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bedrijfsnaam` varchar(255) NOT NULL,
  `kvk` varchar(255) NOT NULL,
  `btw` varchar(255) NOT NULL,
  `land_van_vestiging` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bedrijven_kvk_unique` (`kvk`),
  UNIQUE KEY `bedrijven_btw_unique` (`btw`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bedrijven`
--

LOCK TABLES `bedrijven` WRITE;
/*!40000 ALTER TABLE `bedrijven` DISABLE KEYS */;
INSERT INTO `bedrijven` VALUES (1,'Harvey Group','13054526','tm6ov782','Dominica',NULL,NULL),(2,'Watsica-Abbott','84250938','rc6fg182','Cote d\'Ivoire',NULL,NULL),(3,'Lang and Sons','69445090','dp7dw893','San Marino',NULL,NULL),(4,'Jacobs-Krajcik','29617912','hn5cp789','Central African Republic',NULL,NULL),(5,'Walsh, Willms and The','7359434','jd9yw911','Christmas Island',NULL,'2023-05-15 04:19:02');
/*!40000 ALTER TABLE `bedrijven` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contactpersonen`
--

DROP TABLE IF EXISTS `contactpersonen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactpersonen` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `geslacht` varchar(255) NOT NULL,
  `voornaam` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefoonnummer_vast` varchar(255) NOT NULL,
  `telefoonnummer_mobiel` varchar(255) NOT NULL,
  `notities` text DEFAULT NULL,
  `kvk` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `contactpersonen_email_unique` (`email`),
  UNIQUE KEY `contactpersonen_telefoonnummer_vast_unique` (`telefoonnummer_vast`),
  UNIQUE KEY `contactpersonen_telefoonnummer_mobiel_unique` (`telefoonnummer_mobiel`),
  KEY `contactpersonen_kvk_foreign` (`kvk`),
  CONSTRAINT `contactpersonen_kvk_foreign` FOREIGN KEY (`kvk`) REFERENCES `bedrijven` (`kvk`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactpersonen`
--

LOCK TABLES `contactpersonen` WRITE;
/*!40000 ALTER TABLE `contactpersonen` DISABLE KEYS */;
INSERT INTO `contactpersonen` VALUES (1,'Men','Updated 2023-05-15 06:02:17','Kerluke','wehner.judy@example.org','403511700','0650575995','Test Update 2023-05-15 05:50:42','13054526',NULL,'2023-05-15 04:02:17'),(2,'Women','Katelyn','Metz','felix14@example.org','902222431','0642727136','Notities 2','84250938',NULL,NULL),(3,'Men','Constance','Simonis','losinski@example.com','179607632','0612609388','Notities 3','69445090',NULL,NULL),(4,'Women','Herta','Cummerata','forest.corkery@example.com','510003613','0680057102','Notities 4','29617912',NULL,NULL),(5,'Men','The mind','Fernando','fernando.christiansen@example.org','00316555','010899985858','Notities 5','7359434',NULL,'2023-05-15 04:18:16');
/*!40000 ALTER TABLE `contactpersonen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (137,'2014_10_12_000000_create_users_table',1),(138,'2014_10_12_100000_create_password_reset_tokens_table',1),(139,'2019_08_19_000000_create_failed_jobs_table',1),(140,'2019_12_14_000001_create_personal_access_tokens_table',1),(141,'2023_05_12_125737_create_bedrijven_table',1),(142,'2023_05_12_125742_create_adressen_table',1),(143,'2023_05_12_125747_create_contactpersonen_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-15 11:08:28
