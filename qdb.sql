-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: qdb
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.18.04.1

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
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrator` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrator`
--

LOCK TABLES `administrator` WRITE;
/*!40000 ALTER TABLE `administrator` DISABLE KEYS */;
INSERT INTO `administrator` VALUES (1,'Hacker Vai','hacker.mp4@gmail.com','1234','admin'),(3,'XionKhan','xionkhan0@gmail.com','454545','admin');
/*!40000 ALTER TABLE `administrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `choices`
--

DROP TABLE IF EXISTS `choices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `choices` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `question_id` int(10) DEFAULT NULL,
  `choice_1` mediumtext,
  `choice_2` mediumtext,
  `choice_3` mediumtext,
  `choice_4` mediumtext,
  `choice_5` mediumtext,
  `choice_6` mediumtext,
  `answer` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `choices_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `choices`
--

LOCK TABLES `choices` WRITE;
/*!40000 ALTER TABLE `choices` DISABLE KEYS */;
INSERT INTO `choices` VALUES (7,9,'nothing','anything','something','everything','','','something'),(8,10,'sdfsdf','fafsd','fsdfsd','sdfsdfsf','','','fsdfsd');
/*!40000 ALTER TABLE `choices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examinee`
--

DROP TABLE IF EXISTS `examinee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examinee` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `initial_training_date` date DEFAULT NULL,
  `refresher_training_date` date DEFAULT NULL,
  `fibroscan_device_serial_no` varchar(150) DEFAULT NULL,
  `scan_done` int(10) DEFAULT NULL,
  `is_verified` tinyint(4) DEFAULT NULL,
  `inst_addr` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examinee`
--

LOCK TABLES `examinee` WRITE;
/*!40000 ALTER TABLE `examinee` DISABLE KEYS */;
INSERT INTO `examinee` VALUES (1,'Jonathon','halim','jonathon@gmail.com',NULL,NULL,NULL,NULL,NULL,1,NULL),(2,'Abdur','Jabbar','jabbar@gmail.com',NULL,NULL,NULL,NULL,NULL,1,NULL),(3,'Barkat','Ali','barkat@gmail.com','Barkat Elmi Institution','2021-07-20',NULL,'ERD15412154XX55',NULL,1,NULL),(4,'Asadullah','Galib','asadullah@gmail.com',NULL,NULL,'2021-06-22','EP669TWARPHEXAL',100,1,NULL),(5,'Intishar',NULL,'ishmam@gmail.com',NULL,'2020-06-09',NULL,NULL,1000,1,NULL),(6,'dsfs ','fsfsfsf','fsdfs@fsedf.sfsdf','fsdfsf',NULL,NULL,NULL,NULL,0,NULL),(7,'ishmam','fsdfjsfjskdf j','ishmam@gmail.com',NULL,NULL,NULL,NULL,NULL,1,NULL),(8,'Hakmaola',NULL,'hakmaola@gmail.com',NULL,NULL,NULL,NULL,NULL,1,NULL),(9,'Samurain','Axe','samurain@gmail.com','Samurain road, Samurain.','2020-07-07',NULL,'565656d56as5d6asdasd',454,1,'NULL'),(10,'Harkiulis','Harkalas','harkalas@gmail.com','Harkala institution','2020-07-15','2020-07-22','dfsdfsdf545f',454,1,'Harkala road');
/*!40000 ALTER TABLE `examinee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructions`
--

DROP TABLE IF EXISTS `instructions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructions`
--

LOCK TABLES `instructions` WRITE;
/*!40000 ALTER TABLE `instructions` DISABLE KEYS */;
INSERT INTO `instructions` VALUES (1,'<div class=\"sectionheading section\">\r\n<h2>Yoo policy for electronic devices, mobile technology and watches</h2>\r\n</div>\r\n<div class=\"text section\">\r\n<p>You are not permitted to have in your possession in the exam room any electronic device and/or mobile technology, or watches of any kind, unless specified by the examiner. Medically prescribed devices are permitted.</p>\r\n<p>Unless specified by the examiner, any electronic device and/or mobile technology/watches of any kind which are brought into the exam room must have all functions switched off and need to be placed in the designated part of the room, as directed by the Supervisor. Medically prescribed devices are permitted.</p>\r\n<p>Any item not permitted in an exam room under Regulation 8d that is found in your possession during an exam will be removed for the duration of the exam and a fine of $100 will apply.</p>\r\n</div>');
/*!40000 ALTER TABLE `instructions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `question` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (9,'<p>What the hell are you waitin for?</p>'),(10,'<p>fj;sdjflksdjflkjdsfjds</p>');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `results`
--

DROP TABLE IF EXISTS `results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `results` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `examinee_id` int(10) DEFAULT NULL,
  `marks` int(10) DEFAULT NULL,
  `passed` tinyint(4) DEFAULT NULL,
  `submit_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `examinee_id` (`examinee_id`),
  CONSTRAINT `results_ibfk_1` FOREIGN KEY (`examinee_id`) REFERENCES `examinee` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results`
--

LOCK TABLES `results` WRITE;
/*!40000 ALTER TABLE `results` DISABLE KEYS */;
INSERT INTO `results` VALUES (1,2,2,0,'2020-06-23'),(2,2,0,0,'2020-06-23'),(3,2,2,1,'2020-06-23'),(4,2,0,0,'2020-06-23'),(5,5,0,0,'2020-06-23'),(6,5,0,0,'2020-06-23'),(7,8,0,0,'2020-07-03'),(8,7,0,0,'2020-07-10');
/*!40000 ALTER TABLE `results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studied`
--

DROP TABLE IF EXISTS `studied`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studied` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `examinee_id` int(10) DEFAULT NULL,
  `topics_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `examinee_id` (`examinee_id`),
  KEY `topics_id` (`topics_id`),
  CONSTRAINT `studied_ibfk_1` FOREIGN KEY (`examinee_id`) REFERENCES `examinee` (`id`) ON DELETE CASCADE,
  CONSTRAINT `studied_ibfk_2` FOREIGN KEY (`topics_id`) REFERENCES `topics` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studied`
--

LOCK TABLES `studied` WRITE;
/*!40000 ALTER TABLE `studied` DISABLE KEYS */;
/*!40000 ALTER TABLE `studied` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topics`
--

LOCK TABLES `topics` WRITE;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` VALUES (5,'By the end of the lesson we all come to know that','<p>Is a word that means a sporitual things.</p>\r\n<p><img src=\"http://localhost/tproject/admin/uploads/100521718_3724171264261072_3130566597941395456_o.jpg\" alt=\"\" width=\"196\" height=\"196\" /></p>'),(6,'dfsdfsdfsdf','<p>fs</p>\r\n<p>fs</p>\r\n<p>f</p>\r\n<p>sf</p>\r\n<p><img src=\"http://localhost/tproject/admin/uploads/83189048_381562509375837_3347907409296228352_n.jpg\" alt=\"\" width=\"960\" height=\"638\" /></p>'),(7,'dfsdf','<p>sfsfsf</p>\r\n<p>sf</p>\r\n<p>sdf</p>\r\n<p>sdf</p>\r\n<p><img src=\"http://localhost/tproject/admin/uploads/83189048_381562509375837_3347907409296228352_n.jpg\" alt=\"\" width=\"295\" height=\"196\" /></p>');
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-11  2:45:13
