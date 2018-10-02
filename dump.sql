-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: poker
-- ------------------------------------------------------
-- Server version	5.7.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bids`
--

DROP TABLE IF EXISTS `bids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bids` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `sale_id` int(10) unsigned DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `markup` double(8,2) NOT NULL,
  `share` double(8,2) NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bids_user_id_foreign` (`user_id`),
  KEY `bids_sale_id_foreign` (`sale_id`),
  CONSTRAINT `bids_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE SET NULL,
  CONSTRAINT `bids_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bids`
--

LOCK TABLES `bids` WRITE;
/*!40000 ALTER TABLE `bids` DISABLE KEYS */;
INSERT INTO `bids` VALUES (1,1,1,1,1.30,200.00,500,NULL,NULL),(2,1,1,1,1.40,300.00,600,NULL,NULL),(3,1,1,3,1.20,222.00,550,NULL,NULL),(4,1,1,4,1.00,333.00,430,NULL,NULL),(5,1,1,2,1.30,1234.00,513,NULL,NULL);
/*!40000 ALTER TABLE `bids` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Bahamas','BH','bh',NULL,NULL),(2,'USA','USA','usa',NULL,NULL),(3,'UK','UK','uk',NULL,NULL),(4,'Kazakhstan','KA','ka',NULL,NULL);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_id` int(10) unsigned DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fund` double NOT NULL,
  `buy_in` double NOT NULL,
  `reg_fee` double NOT NULL,
  `date_start` timestamp NULL DEFAULT NULL,
  `date_end` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_image_id_foreign` (`image_id`),
  CONSTRAINT `events_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `image_attachments` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Caribbean Poker Party Event',NULL,'\n<p>That’s right, the Caribbean Poker Party is back for 2017, and this time the main schedule—the partypoker MILLIONS\nCaribbean—boasts an unbelievable <strong>$5 million guarantee</strong>! We’ve got an action-packed event lined up\nwith combined guarantees of a jaw-dropping <strong>$10,000,000</strong> with all kinds of buy-in levels and events.</p>\n',1000000,10000,1000,'2018-10-21 10:01:40','2018-10-31 10:01:40','2018-10-01 10:01:40','2018-10-01 10:01:40'),(2,'Las Vegas Poker Party',NULL,'<p>We’re giving players the chance to <strong>win one of 100 prize packages worth $12,000</strong> each for the\n<strong>Las Vegas Poker Party</strong>strong>, a week-long extravaganza loaded with poolside fun, exciting nightlife,\naward-winning golf, and a variety of live poker events that will show you the best Sin City has to offer!</p>',1000000,1000,100,'2018-11-10 10:01:40','2018-11-15 10:01:40','2018-10-01 10:01:40','2018-10-01 10:01:40'),(3,'partypoker MILLIONS',NULL,'<p>Play your role in the biggest tournament in partypoker history and you could walk away with £1 million cash! We’re\ngoing back to our roots to revive our first ever tourney, the partypoker MILLIONS, but this time it boasts an\nunbelievable £6 million prizepool including at least £1 million for the winner!</p>',1000000000,5000,300,'2018-10-11 10:01:40','2018-10-16 10:01:40','2018-10-01 10:01:40','2018-10-01 10:01:40'),(4,'EAPT Kazakhstan',NULL,'<p>There’s no limit to where partypoker LIVE events are held—wherever the players need us, we’ll be there! From 5th –\n14th October we’re heading to the CashVille Casino in Borovoe for the Eurasian Poker Tour (EAPT) Kazakhstan event\nincluding the main schedule from 10th – 14th October with a massive $500,000 gtd. The luxurious casino is located on the\nbrink of Shchuchie Lake in the awe-inspiring Burabay National Park, an 85,000 hectare area known for its exotic rocks\nand gorgeous mountains. Take in the remarkable scenery, let loose at the nearby theme park then hit the tables for a\nseriously big prizepool!</p>',1000000000,2500,250,'2018-10-31 10:01:40','2018-11-05 10:01:40','2018-10-01 10:01:40','2018-10-01 10:01:40');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flights`
--

DROP TABLE IF EXISTS `flights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flights` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_event_id` int(10) unsigned DEFAULT NULL,
  `event_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `flights_sub_event_id_foreign` (`sub_event_id`),
  KEY `flights_event_id_foreign` (`event_id`),
  CONSTRAINT `flights_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE SET NULL,
  CONSTRAINT `flights_sub_event_id_foreign` FOREIGN KEY (`sub_event_id`) REFERENCES `sub_events` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flights`
--

LOCK TABLES `flights` WRITE;
/*!40000 ALTER TABLE `flights` DISABLE KEYS */;
INSERT INTO `flights` VALUES (1,'qarter',1,1,'2018-10-01 10:01:40','2018-10-01 10:01:40'),(2,'second loop',1,1,'2018-10-01 10:01:40','2018-10-01 10:01:40'),(3,'first loop',2,1,'2018-10-01 10:01:40','2018-10-01 10:01:40'),(4,'delve',2,1,'2018-10-01 10:01:40','2018-10-01 10:01:40'),(5,'mile',3,2,'2018-10-01 10:01:40','2018-10-01 10:01:40'),(6,'mega turbo',3,2,'2018-10-01 10:01:40','2018-10-01 10:01:40'),(7,'mega',4,2,'2018-10-01 10:01:40','2018-10-01 10:01:40'),(8,'turbo',4,2,'2018-10-01 10:01:40','2018-10-01 10:01:40'),(9,'heads up',5,3,'2018-10-01 10:01:40','2018-10-01 10:01:40'),(10,'short stack',5,3,'2018-10-01 10:01:40','2018-10-01 10:01:40'),(11,'exile',6,3,'2018-10-01 10:01:40','2018-10-01 10:01:40'),(12,'arena',6,3,'2018-10-01 10:01:40','2018-10-01 10:01:40');
/*!40000 ALTER TABLE `flights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image_attachments`
--

DROP TABLE IF EXISTS `image_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image_attachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_type_index` (`type`),
  KEY `images_code_index` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image_attachments`
--

LOCK TABLES `image_attachments` WRITE;
/*!40000 ALTER TABLE `image_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `image_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (137,'2014_10_12_000000_create_users_table',1),(138,'2014_10_12_100000_create_password_resets_table',1),(139,'2018_09_28_120951_create_image_attachments_table',1),(140,'2018_09_28_121951_create_events_table',1),(141,'2018_09_28_122605_create_sub_events_table',1),(142,'2018_09_28_123502_create_flights_table',1),(143,'2018_09_28_123628_create_sales_table',1),(144,'2018_09_28_124200_create_bids_table',1),(145,'2018_09_28_125455_create_countries_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `event_id` int(10) unsigned DEFAULT NULL,
  `sub_event_id` int(10) unsigned DEFAULT NULL,
  `flight_id` int(10) unsigned DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `markup` double(8,2) NOT NULL,
  `share` double NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_user_id_foreign` (`user_id`),
  KEY `sales_event_id_foreign` (`event_id`),
  KEY `sales_sub_event_id_foreign` (`sub_event_id`),
  KEY `sales_flight_id_foreign` (`flight_id`),
  CONSTRAINT `sales_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `sub_events` (`id`) ON DELETE SET NULL,
  CONSTRAINT `sales_flight_id_foreign` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`) ON DELETE SET NULL,
  CONSTRAINT `sales_sub_event_id_foreign` FOREIGN KEY (`sub_event_id`) REFERENCES `sub_events` (`id`) ON DELETE SET NULL,
  CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (1,1,2,4,1,1,0.30,123,123,'2018-10-01 10:15:53','2018-10-01 10:15:53'),(2,1,2,3,1,1,1.20,0.3,2000,'2018-10-01 12:05:50','2018-10-01 12:05:50'),(3,1,1,2,1,2,1.30,1,200,'2018-10-01 12:13:29','2018-10-01 12:13:29'),(4,1,1,1,1,2,0.90,123,123,'2018-10-01 12:36:47','2018-10-01 12:36:47'),(5,1,1,1,1,3,0.90,123,123,'2018-10-01 12:37:06','2018-10-01 12:37:06'),(6,1,1,1,1,1,1.30,12,231,'2018-10-02 12:34:46','2018-10-02 12:34:46');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_events`
--

DROP TABLE IF EXISTS `sub_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_id` int(10) unsigned DEFAULT NULL,
  `fund` double NOT NULL,
  `buy_in` double NOT NULL,
  `date_start` timestamp NULL DEFAULT NULL,
  `date_end` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_events_event_id_foreign` (`event_id`),
  KEY `sub_events_image_id_foreign` (`image_id`),
  CONSTRAINT `sub_events_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE SET NULL,
  CONSTRAINT `sub_events_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `image_attachments` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_events`
--

LOCK TABLES `sub_events` WRITE;
/*!40000 ALTER TABLE `sub_events` DISABLE KEYS */;
INSERT INTO `sub_events` VALUES (1,1,'saturday',NULL,500000,10000,'2018-10-31 10:01:40','2018-11-05 10:01:40','2018-10-01 10:01:40','2018-10-01 10:01:40'),(2,1,'sunday',NULL,500000,10000,'2018-10-31 10:01:40','2018-11-05 10:01:40','2018-10-01 10:01:40','2018-10-01 10:01:40'),(3,2,'monday',NULL,500000,10000,'2018-10-31 10:01:40','2018-11-05 10:01:40','2018-10-01 10:01:40','2018-10-01 10:01:40'),(4,2,'tuesday',NULL,500000,10000,'2018-10-31 10:01:40','2018-11-05 10:01:40','2018-10-01 10:01:40','2018-10-01 10:01:40'),(5,3,'wednesday',NULL,500000,10000,'2018-10-31 10:01:40','2018-11-05 10:01:40','2018-10-01 10:01:40','2018-10-01 10:01:40'),(6,3,'mega turbo',NULL,500000,10000,'2018-10-31 10:01:40','2018-11-05 10:01:40','2018-10-01 10:01:40','2018-10-01 10:01:40');
/*!40000 ALTER TABLE `sub_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'jane',24,'j30att@gmail.com',NULL,'$2y$10$PrBs05BrVc7x2E7u17wyX.gMxtlgHQLg9YjYLSSFnsPJiNOQazLBe','FjaADntklbwqguiyurGaKxzBrlNk9pZVlGz1Vt991MAhtJoYFCIpxlLyStup','2018-10-01 10:02:11','2018-10-01 10:02:11');
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

-- Dump completed on 2018-10-02 22:27:02
