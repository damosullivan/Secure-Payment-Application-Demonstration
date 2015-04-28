CREATE DATABASE  IF NOT EXISTS `FYP` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `FYP`;
-- MySQL dump 10.13  Distrib 5.5.34, for debian-linux-gnu (i686)
--
-- Host: 127.0.0.1    Database: FYP
-- ------------------------------------------------------
-- Server version	5.5.34-0ubuntu0.12.04.1

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
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_info` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `fName` varchar(20) COLLATE utf8_bin NOT NULL,
  `sName` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(45) COLLATE utf8_bin NOT NULL,
  `passwordHash` char(78) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userId_UNIQUE` (`userId`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_info`
--

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
INSERT INTO `user_info` VALUES (6,'Damien','O\'Sulllivan','damosullivan@gmail.com','BxUHcslCY6:43:dedc2f48401ea4245fca6c116341239febbb1b25ecb2d463da78f1afb5501e02'),(7,'Eamonn','O\'Brien','eob1@student.cs.ucc.ie','ODab3wl5Xr:59:2a72f1c1ea7c2383b95059a0aaef4760aa1b73fd888e4defe4b069d060ea2461'),(8,'james','murphy','jamesmurphy5791@gmail.com','T48SXAOtrp:95:dcf7e1fe2d5ddcab5239f152251a9e4410776b00f35bec74d0ff57aa9dbec352'),(23,'Sam','Sam','sam@sam.sam','nXu59rowS1:49:12cdbd68ee9b66fe914bd2a0146fd62d0174d78f20c809408eb70cda63be5bf3'),(24,'asde','srfwr','','DVcuwB1XzZ:43:c526ba33cb76f27522d4048078b395781150ead79db6c5a232980b9f78c8f7ce'),(27,'damo','damo','damo@damo.com','BOXrs6N24h:68:9b82f4e6110ebac0f33b5ba92c6008afe4c084c5ba00f2eaf9ec383cde97d536'),(28,'john','john','john@john.com','QUY9X7yiO8:13:6b823aa7de4259bd017ca784119cb74338d8b0c6d3abf6c0bf33bfc67e63546d');
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-01-19 15:10:25
