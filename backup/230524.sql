-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: tennis
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

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
-- Current Database: `tennis`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `tennis` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `tennis`;

--
-- Table structure for table `bbs`
--

DROP TABLE IF EXISTS `bbs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bbs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `pass` char(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bbs`
--

LOCK TABLES `bbs` WRITE;
/*!40000 ALTER TABLE `bbs` DISABLE KEYS */;
INSERT INTO `bbs` VALUES (1,'やまうち','てすと','これはテストです\r\n試しに書き込んでいます','2022-05-24 10:10:12','0000'),(2,'やまうち','てすと','これは２件目','2022-05-24 14:10:59','1111'),(3,'やまうち','てすと３','これは３件目です','2022-05-24 14:13:38','1111'),(4,'testtest','test4','testtesttest','2022-05-24 14:33:55','1111'),(5,'test5','test5','test5test5','2022-05-24 14:34:10','1111'),(6,'test6','test6','testtesttest','2022-05-24 14:34:31','1111'),(7,'test7','','testtesttest','2022-05-24 14:34:45','1111'),(8,'test8','test8','testtesttest','2022-05-24 14:34:59','1111'),(9,'test9','test9','testtesttest','2022-05-24 14:35:23','1111'),(10,'test10','test10','testtesttesttest','2022-05-24 14:35:38','1111'),(11,'test11','test11','testtesttest','2022-05-24 14:35:57','1111'),(13,'やまうち公之','test13','これはtest13の投稿です','2022-05-26 14:24:25','1111'),(15,'yamauchi','test','これはテストの書き込みです','2022-05-31 11:06:11','1111'),(19,'やまうちきみゆき','test14','これはtest14の書き込みです','2022-06-13 15:06:10','1111'),(20,'やまうちきみゆき','test15','これはtest15の書き込みです ','2022-06-13 15:06:58','1111'),(21,'やまうちきみゆき','test16','これはtest16の書き込みです ','2022-06-13 15:09:32','1111'),(22,'やまうちきみゆき','test17','これはtest17の書き込みです ','2022-06-13 15:13:17','1111'),(23,'やまうちきみゆき','test18','これはtest18の書き込みです ','2022-06-13 15:20:55','1111'),(24,'やまうちきみゆき','test19','これはtest19の書き込みです ','2022-06-13 15:31:37','1111'),(25,'やまうちきみゆき','test20','これはtest21の書き込みです ','2022-06-14 09:33:04','1111'),(26,'やまうちきみゆき','test21','これはtest21の書き込みです ','2022-06-14 09:41:13','1111'),(27,'やまうちきみゆき','test21','これはtest21の書き込みです','2022-06-14 09:49:10','1111'),(28,'やまうちきみゆき','test22','これはtest22の書き込みです','2022-06-14 09:50:29','1111'),(29,'やまうちきみゆき','test23','これはtest23の書き込みです','2022-06-14 09:51:49','1111'),(30,'やまうちきみゆき','test24','これはtest24の書き込みです ','2022-06-14 09:57:44','1111'),(31,'やまうちきみゆき','test30','これはtest30の書き込みです','2022-06-14 10:03:58','1111'),(32,'やまうちきみゆき','test31','これはtest31の書き込みです','2022-06-14 10:05:50','1111'),(33,'やまうちきみゆき','test32','これはtest32の書き込みです','2022-06-14 10:09:28','1111'),(34,'やまうちきみゆき','test32','これはtest32の書き込みです','2022-06-14 10:09:55','1111'),(35,'やまうちきみゆき','test32','これはtest32の書き込みです','2022-06-14 10:10:10','1111'),(36,'やまうちきみゆき','test33','これはtest33の書き込みです','2022-06-14 10:10:38','1111'),(37,'やまうちきみゆき','test34','これはtest34の書き込みです','2022-06-14 10:10:58','1111');
/*!40000 ALTER TABLE `bbs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `body` text DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,'山田太郎',NULL,NULL),(2,'田中次郎',NULL,NULL),(3,'菊池三郎',NULL,NULL);
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'yamada','ae70abc5a365b918447bc7548963fbd5802ac8b78544126a5107fb87ba96e81b'),(2,'tanaka','5faeffd0e4ed67b317be7def06689af7d3a3cb759539dbbb1c9fb4b8699170dc'),(3,'kikuchi','65fbd8c8fe689b50d6e2cb270e26abd01daa449c9f9bb1ba8d072da9befafaaf');
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

-- Dump completed on 2023-05-24 16:33:43
