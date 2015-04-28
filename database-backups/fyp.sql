CREATE DATABASE  IF NOT EXISTS `FYP` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `FYP`;
-- MySQL dump 10.13  Distrib 5.5.35, for debian-linux-gnu (i686)
--
-- Host: 127.0.0.1    Database: FYP
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
INSERT INTO `card_PAN` VALUES ('05621a74-815a-11e3-83aa-0025644e5873','nQIu8bCCnVpAvyiEY0jteQfJgkh1vOShOLv6NiZJdUI='),('2340832a-815a-11e3-83aa-0025644e5873','nQIu8bCCnVpAvyiEY0jteQfJgkh1vOShOLv6NiZJdUI='),('2dd88c7a-815a-11e3-83aa-0025644e5873','nQIu8bCCnVpAvyiEY0jteQfJgkh1vOShOLv6NiZJdUI='),('3e267e84-5b55-11e3-b353-0025644e5873','o94g8gYRzpXRqNlI6lIQh64nU6qyO9aK80T+I6HH6PU='),('400c9c6a-8159-11e3-83aa-0025644e5873','ppOyiN99rlsXV2QCdkOSMNt3xM16hx4k1hYuVK9DSJE='),('40539b65-815a-11e3-83aa-0025644e5873','nQIu8bCCnVpAvyiEY0jteQfJgkh1vOShOLv6NiZJdUI='),('479a5e2e-8159-11e3-83aa-0025644e5873','nQIu8bCCnVpAvyiEY0jteQfJgkh1vOShOLv6NiZJdUI='),('48c0a7c0-50a4-11e3-b28a-0025644e5873','sD7+ZaCzTX/E3QqnKJxy94FjEUkX7/kG6Eh+OJMqsAM='),('4ebb47a0-815a-11e3-83aa-0025644e5873','nQIu8bCCnVpAvyiEY0jteQfJgkh1vOShOLv6NiZJdUI='),('588e05a5-8159-11e3-83aa-0025644e5873','nQIu8bCCnVpAvyiEY0jteQfJgkh1vOShOLv6NiZJdUI='),('5fe620b0-815a-11e3-83aa-0025644e5873','nQIu8bCCnVpAvyiEY0jteQfJgkh1vOShOLv6NiZJdUI='),('64fe80e6-50a6-11e3-b28a-0025644e5873','o2rNt0hRm/PMcdgyOuM7kxsVRC9Wwe2pxi0wkwbxNV8='),('729131e6-815a-11e3-83aa-0025644e5873','adNSudg4+rzvsRqb5NGwlxxTjAmpChDoVaaZhVWvm38='),('99fd6cb7-50a2-11e3-b28a-0025644e5873','/CrQD9o+qRGAPy4p2LKlkLzQDhZgowDTespOXD2RktU='),('9aa5e3ac-815a-11e3-83aa-0025644e5873','lUnnTHqmRFY/Bj2ibL1T02hAuWaCSqpGi54AtGCPR4A='),('a1691b7e-a646-11e3-9ac9-0025644e5873','vndhKF8GIU77rCeZ595NSdxoGzVlm6r3H1hCebo6BLo='),('b37a06c2-81d7-11e3-b63e-0025644e5873','PXYCyte1ldQ6cZ0MmwjlZ0QrfuDny8kUKUXlbuwoWYs='),('ce1251ab-509f-11e3-b28a-0025644e5873','zl1qMjwM5I1NExNDvwUnV30ttTeAEnOjSrsP/KJm2PA='),('ded43e8b-8159-11e3-83aa-0025644e5873','nQIu8bCCnVpAvyiEY0jteQfJgkh1vOShOLv6NiZJdUI=');
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
INSERT INTO `card_info` VALUES ('2ddda98a-815a-11e3-83aa-0025644e5873','6','05621a74-815a-11e3-83aa-0025644e5873','0000-00-00 00:00:00',NULL,''),('3e34c0c6-5b55-11e3-b353-0025644e5873','6','3e267e84-5b55-11e3-b353-0025644e5873','2012-05-01 00:00:00',NULL,'****5678'),('40645e5b-815a-11e3-83aa-0025644e5873','6','05621a74-815a-11e3-83aa-0025644e5873','0000-00-00 00:00:00',NULL,''),('48cc39f9-50a4-11e3-b28a-0025644e5873','7','48c0a7c0-50a4-11e3-b28a-0025644e5873','2012-09-01 00:00:00',NULL,'************1234'),('4ec162f0-815a-11e3-83aa-0025644e5873','6','05621a74-815a-11e3-83aa-0025644e5873','0000-00-00 00:00:00',NULL,''),('5feff89a-815a-11e3-83aa-0025644e5873','6','05621a74-815a-11e3-83aa-0025644e5873','0000-00-00 00:00:00',NULL,''),('65089100-50a6-11e3-b28a-0025644e5873','8','64fe80e6-50a6-11e3-b28a-0025644e5873','2014-05-01 00:00:00',NULL,'*********9234'),('729e7eb9-815a-11e3-83aa-0025644e5873','6','729131e6-815a-11e3-83aa-0025644e5873','0000-00-00 00:00:00',NULL,'*****6789'),('9a12957e-50a2-11e3-b28a-0025644e5873','6','99fd6cb7-50a2-11e3-b28a-0025644e5873','2016-10-01 00:00:00',NULL,'**** **** **** 4512'),('9ab0b4f3-815a-11e3-83aa-0025644e5873','6','9aa5e3ac-815a-11e3-83aa-0025644e5873','1998-09-01 00:00:00',NULL,'******4321'),('a1771992-a646-11e3-9ac9-0025644e5873','27','a1691b7e-a646-11e3-9ac9-0025644e5873','2017-11-01 00:00:00',NULL,'******6789'),('b3832ab7-81d7-11e3-b63e-0025644e5873','27','b37a06c2-81d7-11e3-b63e-0025644e5873','2056-12-01 00:00:00',NULL,'**7654'),('ce200a4a-509f-11e3-b28a-0025644e5873','6','ce1251ab-509f-11e3-b28a-0025644e5873','2016-12-01 00:00:00',NULL,'**** **** **** 4321');
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
INSERT INTO `code` VALUES (2,'addSlashes',0,'return $args;','return $mysqli->real_escape_string($args);',0.03,0.6),(3,'preparedStatement',0,'$sql = $args[\'regularSql\'];\nif($result = $mysqli->query($sql)){\n\n	#$result->free();\n	debug($sql);\n	return $result;\n\n}else{\n	debug(\"Execution error - \" . $mysqli->error, true);\n}','$type = $args[\'prepareTypes\'];\n$param = $args[\'prepareParam\'];\n$sql = $args[\'prepareSql\'];\n\nif($statement = $mysqli->prepare($sql) ){\n	if(call_user_func_array(\'mysqli_stmt_bind_param\', array_merge (array($statement, $type), $param)) ){\n		if($statement->execute()){\n			debug( \"SUCCESSS!!!!!!!!!!!! :O\");\n			return $statement->get_result();#this is the result set\n		}else{\n			debug( \"Execute error - \".$mysqli->error , true);\n		}\n	}else{\n		debug(\"Bind error\", true);\n	}\n}else{\n	debug(\"Prepare error\", true);\n}',0.03,0.75),(4,'debug',0,'','',0.03,1),(5,'removeScript',0,'return $args;','return preg_replace(\'#<script(.*?)>(.*?)</script>#is\', \'\', $args);',0.03,0.69),(6,'illegalChars',0,'return false;','$regex = $args[1];\n$string = $args[0];\n\nif(preg_match($regex, $string)){\n	return true;\n\n}else{\n	return false;\n}',0.03,0.45),(7,'frameBlock',0,'return \"\";','return \'<meta http-equiv=\"X-FRAME-OPTIONS\" content=\"DENY\">\';#SAMEORIGIN',0.03,0.55),(8,'frameBlockingLegacy',0,'return \"<!-- Legacy Frame Blocking is Off -->\";','$result =  <<<HTML\n\n<style id=\"antiClickjack\">body{display:none !important;}</style>\n    <script type=\"text/javascript\">\n      if (self === top) {\n	  var antiClickjack = document.getElementById(\"antiClickjack\");\n	  antiClickjack.parentNode.removeChild(antiClickjack);\n      } else {\n	  //top.location = self.location;\n      }\n    </script>\nHTML;\n\nreturn $result;',0.03,0.55),(9,'realEscapeString',0,'return $args;','return $mysqli->real_escape_string($args);',0.03,0.7),(10,'regenerateSessionId',1,'return false;','return session_regenerate_id(TRUE);',0.03,0.678),(11,'checkReferAddress',0,'return true;#ok address','if(preg_match(\'#^\'.URL_ADDRESS.\'#\', $args )){\n	return true;#matched    \n}else{\n	return false;\n}',0.03,0.4),(12,'CSRFToken',0,'','',0.03,0.67),(13,'sessionSecurityCheck',0,'','',0.001,0.7),(14,'https',1,'','',0.03,0.5),(15,'dashboard',0,'','',0,1);
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
  `comment` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`idtransactions`),
  UNIQUE KEY `idtransactions_UNIQUE` (`idtransactions`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (4,'2014-03-05 22:49:50','6','27',122,'This is so safe'),(5,'2014-03-05 22:55:10','7','27',8.95,'For the Chinese food yesterday. My mouth is still on fire');
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_info`
--

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
INSERT INTO `user_info` VALUES (6,'Damien','O\'Sulllivan','damosullivan@gmail.com','BOXrs6N24h:68:9b82f4e6110ebac0f33b5ba92c6008afe4c084c5ba00f2eaf9ec383cde97d536','default.jpg','0'),(7,'Eamonn','O\'Brien','eob1@student.cs.ucc.ie','ODab3wl5Xr:59:2a72f1c1ea7c2383b95059a0aaef4760aa1b73fd888e4defe4b069d060ea2461','default.jpg','0'),(8,'james','murphy','jamesmurphy5791@gmail.com','T48SXAOtrp:95:dcf7e1fe2d5ddcab5239f152251a9e4410776b00f35bec74d0ff57aa9dbec352','default.jpg','0'),(23,'Sam','Sam','sam@sam.sam','nXu59rowS1:49:12cdbd68ee9b66fe914bd2a0146fd62d0174d78f20c809408eb70cda63be5bf3','default.jpg','0'),(24,'asde','srfwr','','DVcuwB1XzZ:43:c526ba33cb76f27522d4048078b395781150ead79db6c5a232980b9f78c8f7ce','default.jpg','0'),(27,'damo','damo','damo@damo.com','BOXrs6N24h:68:9b82f4e6110ebac0f33b5ba92c6008afe4c084c5ba00f2eaf9ec383cde97d536','default.jpg','0'),(28,'john','john','john@john.com','QUY9X7yiO8:13:6b823aa7de4259bd017ca784119cb74338d8b0c6d3abf6c0bf33bfc67e63546d','default.jpg','0');
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

-- Dump completed on 2014-03-08 15:22:56
