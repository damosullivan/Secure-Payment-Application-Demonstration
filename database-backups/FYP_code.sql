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
  PRIMARY KEY (`idcode`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `code`
--

LOCK TABLES `code` WRITE;
/*!40000 ALTER TABLE `code` DISABLE KEYS */;
INSERT INTO `code` VALUES (2,'addSlashes',0,'return $args;','return $mysqli->real_escape_string($args);'),(3,'preparedStatement',0,'$sql = $args[\'regularSql\'];\nif($result = $mysqli->query($sql)){\n\n	#$result->free();\n	debug($sql);\n	return $result;\n\n}else{\n	debug(\"Execution error - \" . $mysqli->error, true);\n}','$type = $args[\'prepareTypes\'];\n$param = $args[\'prepareParam\'];\n$sql = $args[\'prepareSql\'];\n\nif($statement = $mysqli->prepare($sql) ){\n	if(call_user_func_array(\'mysqli_stmt_bind_param\', array_merge (array($statement, $type), $param)) ){\n		if($statement->execute()){\n			debug( \"SUCCESSS!!!!!!!!!!!! :O\");\n			return $statement->get_result();#this is the result set\n		}else{\n			debug( \"Execute error - \".$mysqli->error , true);\n		}\n	}else{\n		debug(\"Bind error\", true);\n	}\n}else{\n	debug(\"Prepare error\", true);\n}'),(4,'debug',0,'',''),(5,'removeScript',0,'return $args;','return preg_replace(\'#<script(.*?)>(.*?)</script>#is\', \'\', $args);'),(6,'illegalChars',0,'return false;','$regex = $args[1];\n$string = $args[0];\n\nif(preg_match($regex, $string)){\n	return true;\n\n}else{\n	return false;\n}'),(7,'frameBlock',1,'return \"\";','return \'<meta http-equiv=\"X-FRAME-OPTIONS\" content=\"DENY\">\';#SAMEORIGIN'),(8,'frameBlockingLegacy',1,'return \"<!-- Legacy Frame Blocking is Off -->\";','\nreturn \n	\n	\"<script>\".\n	\"	var theBody = document.getElementsByTagName(\'body\')[0];\".\n	\'	theBody.style.display = \"none\";\'.\n	\"	if (self == top) {\".\n	\'		//theBody.style.display = \"block\";\'.\n	\"		//alert(\'self = top\');\".\n	\"	} else {\".\n	\"		top.location = self.location;\".\n	\"	}\".\n\"</script>\";'),(9,'realEscapeString',0,'return $args;','return $mysqli->real_escape_string($args);'),(10,'regenerateSessionId',1,'return false;','return session_regenerate_id(TRUE);'),(11,'checkReferAddress',0,'return true;#ok address','if(preg_match(\'#^\'.URL_ADDRESS.\'#\', $args )){\n	return true;#matched    \n}else{\n	return false;\n}');
/*!40000 ALTER TABLE `code` ENABLE KEYS */;
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
