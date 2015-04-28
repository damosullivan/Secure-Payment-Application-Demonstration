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
-- Table structure for table `card_PAN`
--

DROP TABLE IF EXISTS `card_PAN`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `card_PAN` (
  `cardId` varchar(40) COLLATE utf8_bin NOT NULL,
  `encryptedPAN` varchar(45) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`cardId`),
  UNIQUE KEY `cardId_UNIQUE` (`cardId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card_PAN`
--

LOCK TABLES `card_PAN` WRITE;
/*!40000 ALTER TABLE `card_PAN` DISABLE KEYS */;
INSERT INTO `card_PAN` VALUES ('3e267e84-5b55-11e3-b353-0025644e5873','o94g8gYRzpXRqNlI6lIQh64nU6qyO9aK80T+I6HH6PU='),('48c0a7c0-50a4-11e3-b28a-0025644e5873','sD7+ZaCzTX/E3QqnKJxy94FjEUkX7/kG6Eh+OJMqsAM='),('64fe80e6-50a6-11e3-b28a-0025644e5873','o2rNt0hRm/PMcdgyOuM7kxsVRC9Wwe2pxi0wkwbxNV8='),('99fd6cb7-50a2-11e3-b28a-0025644e5873','/CrQD9o+qRGAPy4p2LKlkLzQDhZgowDTespOXD2RktU='),('ce1251ab-509f-11e3-b28a-0025644e5873','zl1qMjwM5I1NExNDvwUnV30ttTeAEnOjSrsP/KJm2PA=');
/*!40000 ALTER TABLE `card_PAN` ENABLE KEYS */;
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
