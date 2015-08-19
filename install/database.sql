-- MySQL dump 10.13  Distrib 5.6.19, for osx10.7 (i386)
--
-- Host: localhost    Database: eop2_db1
-- ------------------------------------------------------
-- Server version	5.6.22

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
-- Table structure for table `eop_access_log`
--

DROP TABLE IF EXISTS `eop_access_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_access_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(32) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `body` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_access_log`
--

LOCK TABLES `eop_access_log` WRITE;
/*!40000 ALTER TABLE `eop_access_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `eop_access_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_activity_log`
--

DROP TABLE IF EXISTS `eop_activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_activity_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `uid` int(32) DEFAULT NULL,
  `entity_id` int(32) DEFAULT NULL,
  `field_id` int(32) DEFAULT NULL,
  `activity` varchar(45) DEFAULT NULL COMMENT 'create\nedit\ndelete\nother',
  `body` text,
  `description` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_activity_log`
--

LOCK TABLES `eop_activity_log` WRITE;
/*!40000 ALTER TABLE `eop_activity_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `eop_activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_calendar`
--

DROP TABLE IF EXISTS `eop_calendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_calendar` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `start_time` varchar(100) NOT NULL,
  `end_time` varchar(100) NOT NULL,
  `location` text NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modification_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `allDay` tinyint(2) DEFAULT '0',
  `url` varchar(255) DEFAULT NULL,
  `className` varchar(32) DEFAULT NULL,
  `editable` tinyint(2) DEFAULT '0',
  `startEditable` tinyint(2) DEFAULT '0',
  `durationEditable` tinyint(2) DEFAULT '0',
  `rendering` varchar(255) DEFAULT NULL,
  `overlap` tinyint(2) DEFAULT '0',
  `source` varchar(64) DEFAULT NULL,
  `color` varchar(32) DEFAULT NULL,
  `backgroundColor` varchar(32) DEFAULT NULL,
  `borderColor` varchar(32) DEFAULT NULL,
  `textColor` varchar(32) DEFAULT NULL,
  `sid` int(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_calendar`
--

LOCK TABLES `eop_calendar` WRITE;
/*!40000 ALTER TABLE `eop_calendar` DISABLE KEYS */;
INSERT INTO `eop_calendar` VALUES (6,'asasa','','2015-07-15T00:00:00-04:00','2015-07-15T00:00:00-04:00','',17,'2015-07-15 09:26:48',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(7,'ssss','','2015-07-09T00:00:00-04:00','2015-07-09T00:00:00-04:00','',17,'2015-07-15 09:39:19',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(8,'','','2015-07-08T00:00:00-04:00','2015-07-08T00:00:00-04:00','',17,'2015-07-15 09:44:52',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(10,'','','2015-07-15T00:00:00-04:00','2015-07-15T00:00:00-04:00','',29,'2015-07-15 10:09:38',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(11,'goddt','','2015-07-14T00:00:00-04:00','2015-07-14T00:00:00-04:00','',29,'2015-07-15 10:09:58',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(12,'','','2015-07-08T00:00:00-04:00','2015-07-08T00:00:00-04:00','',29,'2015-07-15 10:12:14',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,5),(13,'poo','','2015-07-08T00:00:00-04:00','2015-07-08T01:45:00-04:00','',29,'2015-07-15 10:12:17',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,5),(15,'','','2015-07-15T00:00:00-04:00','2015-07-15T00:00:00-04:00','',29,'2015-07-15 10:17:05',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(16,'asas','asdad\nasdadsad','2015-07-15T00:00:00-04:00','2015-07-15T01:45:00-04:00','asa',29,'2015-07-15 10:17:13',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,12),(17,'ddd','','2015-07-02T00:00:00-04:00','2015-07-02T00:00:00-04:00','',17,'2015-07-17 08:54:03',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(18,'plp','','2015-07-17T14:00:00-04:00','2015-07-17T17:15:00-04:00','',17,'2015-07-17 08:54:52',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(19,'polo','','2015-07-02T01:00:00-04:00','','',17,'2015-07-27 09:18:48',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,12),(20,'ghgh','','2015-07-03T00:00:00-04:00','2015-07-03T00:00:00-04:00','',29,'2015-07-27 12:36:53',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,5),(21,'','','2015-07-01T00:00:00-04:00','2015-07-01T00:00:00-04:00','',29,'2015-07-27 12:37:03',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,12),(22,'','','2015-07-02T00:00:00-04:00','2015-07-02T00:00:00-04:00','',33,'2015-07-27 14:45:23',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(23,'','','2015-07-10T00:00:00-04:00','2015-07-10T00:00:00-04:00','',17,'2015-07-30 16:57:23',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,5),(24,'','','2015-07-04T00:00:00-04:00','2015-07-04T00:00:00-04:00','',17,'2015-07-30 17:00:28',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(25,'','','2015-07-11T00:00:00-04:00','2015-07-11T00:00:00-04:00','',17,'2015-07-30 17:00:31',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(26,'','','2015-06-29T00:00:00-04:00','2015-06-29T00:00:00-04:00','',17,'2015-07-30 17:00:41',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(27,'','','2015-07-04T00:00:00-04:00','2015-07-04T00:00:00-04:00','',17,'2015-07-30 17:04:11',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,5),(28,'lll','','2015-07-04T00:00:00-04:00','2015-07-04T00:00:00-04:00','',17,'2015-07-30 17:04:27',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(29,'','','2015-07-04T00:00:00-04:00','2015-07-04T00:00:00-04:00','',17,'2015-07-30 17:08:13',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(30,'','','2015-07-04T00:00:00-04:00','2015-07-04T00:00:00-04:00','',17,'2015-07-30 17:09:24',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(31,'','','2015-07-03T00:00:00-04:00','2015-07-03T00:00:00-04:00','',33,'2015-07-30 17:12:00',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(32,'','','2015-07-11T00:00:00-04:00','2015-07-11T00:00:00-04:00','',17,'2015-07-30 17:22:00',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(33,'','','2015-07-11T00:00:00-04:00','2015-07-11T00:00:00-04:00','',17,'2015-07-30 17:25:11',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(34,'pop\';','','2015-07-01T00:00:00-04:00','2015-07-01T00:00:00-04:00','',33,'2015-07-30 17:25:36',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(35,'','','2015-08-07T01:00:00-04:00','2015-08-07T08:30:00-04:00','',17,'2015-08-05 11:07:56',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,5),(36,'','','2015-07-30T00:00:00-04:00','2015-07-30T00:00:00-04:00','',17,'2015-08-05 11:11:41',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,5),(37,'','','2015-07-30T00:00:00-04:00','2015-07-30T00:00:00-04:00','',17,'2015-08-05 11:12:05',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,5),(38,'','','2015-07-31T00:00:00-04:00','2015-07-31T00:00:00-04:00','',17,'2015-08-06 11:37:18',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,5),(39,'','','2015-07-29T00:00:00-04:00','2015-07-29T00:00:00-04:00','',17,'2015-08-06 11:37:22',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,5),(40,'','','2015-07-29T00:00:00-04:00','2015-07-29T00:00:00-04:00','',17,'2015-08-06 12:04:52',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,5),(41,'','','2015-08-06T01:30:00-04:00','2015-08-06T21:30:00-04:00','',17,'2015-08-06 12:05:21',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,5),(42,'','','2015-07-31T00:00:00-04:00','2015-07-31T00:00:00-04:00','',17,'2015-08-06 12:40:22',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,5),(43,'','','2015-08-01T00:00:00-04:00','2015-08-01T00:00:00-04:00','',17,'2015-08-07 15:08:26',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(44,'','','2015-08-01T00:00:00-04:00','2015-08-01T00:00:00-04:00','',17,'2015-08-07 15:08:32',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,5),(45,'','','2015-07-28T00:00:00-04:00','2015-07-28T00:00:00-04:00','',17,'2015-08-07 15:08:34',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,5),(46,'','','2015-08-12T02:00:00-04:00','2015-08-12T15:00:00-04:00','',26,'2015-08-12 12:30:32',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,5),(47,'','','2015-08-08T00:00:00-04:00','2015-08-08T04:15:00-04:00','',26,'2015-08-12 13:20:01',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,5);
/*!40000 ALTER TABLE `eop_calendar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_district`
--

DROP TABLE IF EXISTS `eop_district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `screen_name` varchar(128) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `state_val` varchar(8) DEFAULT NULL,
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `owner` int(32) DEFAULT NULL,
  `state_permission` varchar(45) DEFAULT 'deny',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_district`
--

LOCK TABLES `eop_district` WRITE;
/*!40000 ALTER TABLE `eop_district` DISABLE KEYS */;
INSERT INTO `eop_district` VALUES (4,'Frst Districts3','First Districts',NULL,'MD','2015-05-21 15:12:47',NULL,'deny'),(5,'uiyuioyiuy','jfjhgfj',NULL,'MD','2015-05-21 20:09:16',NULL,'deny'),(6,'egdfsfdfdsdfsfsdfsd','sssdsfd',NULL,'MD','2015-08-12 14:40:55',NULL,'deny');
/*!40000 ALTER TABLE `eop_district` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_entity`
--

DROP TABLE IF EXISTS `eop_entity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_entity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(32) DEFAULT NULL,
  `sid` int(32) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `owner` int(32) DEFAULT NULL,
  `parent` int(32) DEFAULT NULL,
  `weight` int(8) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` longtext COMMENT 'live\noffline',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=289 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_entity`
--

LOCK TABLES `eop_entity` WRITE;
/*!40000 ALTER TABLE `eop_entity` DISABLE KEYS */;
INSERT INTO `eop_entity` VALUES (8,2,NULL,'Communications and Warning',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(9,2,NULL,'Evacuation',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(10,2,NULL,'Shelter-in-Place',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(11,2,NULL,'Lockdown',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(12,2,NULL,'Accounting for All Persons',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(13,2,NULL,'Family Reunification',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(14,2,NULL,'Continuity of Operations (COOP)',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(15,2,NULL,'Security',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(17,2,NULL,'Public Health, Medical, and Mental Health',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(18,2,NULL,'None',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(20,2,NULL,'Recovery',NULL,17,NULL,NULL,'2015-06-17 12:04:35','2015-06-17 20:04:35',NULL),(109,3,5,'TH1','TH1',32,NULL,NULL,'2015-07-15 14:22:51','2015-07-15 18:22:51','live'),(110,4,5,'Goal 1','Goal 1 (Before)',32,109,1,'2015-07-15 14:22:51','2015-07-15 18:22:51',NULL),(111,7,5,'Goal 1 Objective','Objective',32,110,0,'2015-07-15 14:22:51','2015-07-15 18:22:51',NULL),(112,8,5,'Goal 1 Course of Action','Course of Action',32,110,0,'2015-07-15 14:22:51','2015-07-15 18:22:51',NULL),(113,5,5,'Goal 2','Goal 2 (During)',32,109,2,'2015-07-15 14:22:51','2015-07-15 18:22:51',NULL),(114,7,5,'Goal 2 Objective','Objective',32,113,1,'2015-07-15 14:22:51','2015-07-15 18:22:51',NULL),(115,8,5,'Goal 2 Course of Action','Course of Action',32,113,1,'2015-07-15 14:22:51','2015-07-15 18:22:51',NULL),(116,6,5,'Goal 3','Goal 3 (After)',32,109,3,'2015-07-15 14:22:51','2015-07-15 18:22:51',NULL),(117,7,5,'Goal 3 Objective','Objective',32,116,2,'2015-07-15 14:22:51','2015-07-15 18:22:51',NULL),(118,8,5,'Goal 3 Course of Action','Course of Action',32,116,2,'2015-07-15 14:22:51','2015-07-15 18:22:51',NULL),(119,2,5,'Lockdown','Lockdown',32,110,NULL,'2015-07-15 14:25:15','2015-07-23 20:42:14',NULL),(120,2,5,'Continuity of Operations (COOP)','Continuity of Operations (COOP)',32,113,NULL,'2015-07-15 14:25:15','2015-07-15 18:25:15',NULL),(121,2,5,'Evacuation','Evacuation',32,116,NULL,'2015-07-15 14:25:15','2015-07-15 18:25:15',NULL),(122,2,5,'Communications and Warning','Communications and Warning',32,111,NULL,'2015-07-15 14:25:15','2015-07-15 18:25:15',NULL),(123,2,5,'Family Reunification','Family Reunification',32,114,NULL,'2015-07-15 14:25:15','2015-07-15 18:25:15',NULL),(124,2,5,'Continuity of Operations (COOP)','Continuity of Operations (COOP)',32,117,NULL,'2015-07-15 14:25:15','2015-07-15 18:25:15',NULL),(125,7,5,'Goal 1 Objective','Objective',32,110,2,'2015-07-15 14:27:40','2015-07-15 18:27:40',NULL),(126,2,5,'Public Health, Medical, and Mental Health','Public Health, Medical, and Mental Health',32,125,NULL,'2015-07-15 14:27:40','2015-07-15 18:27:40',NULL),(127,4,5,'Goal 1','Goal 1 (Before)',32,119,1,'2015-07-15 14:36:05','2015-07-15 18:36:05',NULL),(128,7,5,'Goal 1 Objective','Objective',32,127,1,'2015-07-15 14:36:05','2015-07-15 18:36:05',NULL),(129,5,5,'Goal 2','Goal 2 (Before)',32,119,1,'2015-07-15 14:36:05','2015-07-15 18:36:05',NULL),(130,7,5,'Goal 2 Objective','Objective',32,129,1,'2015-07-15 14:36:05','2015-07-15 18:36:05',NULL),(131,6,5,'Goal 3','Goal 3 (Before)',32,119,1,'2015-07-15 14:36:05','2015-07-15 18:36:05',NULL),(132,7,5,'Goal 3 Objective','Objective',32,131,1,'2015-07-15 14:36:05','2015-07-15 18:36:05',NULL),(133,7,5,'Goal 1 Objective','Objective',32,127,2,'2015-07-15 14:36:21','2015-07-15 18:36:21',NULL),(134,7,5,'Goal 1 Objective','Objective',32,127,3,'2015-07-15 14:38:53','2015-07-15 18:38:53',NULL),(135,7,5,'Goal 3 Objective','Objective',32,116,2,'2015-07-15 16:05:10','2015-07-15 20:05:10',NULL),(136,3,NULL,'loop','loop',17,NULL,NULL,'2015-07-16 09:50:29','2015-07-31 13:21:14','live'),(137,4,NULL,'Goal 1','Goal 1 (Before)',17,136,1,'2015-07-16 09:50:30','2015-07-16 13:50:30',NULL),(138,7,NULL,'Goal 1 Objective','Objective',17,137,0,'2015-07-16 09:50:30','2015-07-16 13:50:30',NULL),(139,8,NULL,'Goal 1 Course of Action','Course of Action',17,137,0,'2015-07-16 09:50:30','2015-07-16 13:50:30',NULL),(140,5,NULL,'Goal 2','Goal 2 (During)',17,136,2,'2015-07-16 09:50:31','2015-07-16 13:50:31',NULL),(141,7,NULL,'Goal 2 Objective','Objective',17,140,1,'2015-07-16 09:50:32','2015-07-16 13:50:32',NULL),(142,8,NULL,'Goal 2 Course of Action','Course of Action',17,140,1,'2015-07-16 09:50:32','2015-07-16 13:50:32',NULL),(143,6,NULL,'Goal 3','Goal 3 (After)',17,136,3,'2015-07-16 09:50:32','2015-07-16 13:50:32',NULL),(144,7,NULL,'Goal 3 Objective','Objective',17,143,2,'2015-07-16 09:50:32','2015-07-16 13:50:32',NULL),(145,8,NULL,'Goal 3 Course of Action','Course of Action',17,143,2,'2015-07-16 09:50:33','2015-07-16 13:50:33',NULL),(146,8,5,'Goal 1 Course of Action','Course of Action',29,127,0,'2015-07-16 12:45:18','2015-07-16 16:45:18',NULL),(147,8,5,'Goal 2 Course of Action','Course of Action',29,129,1,'2015-07-16 12:45:18','2015-07-16 16:45:18',NULL),(148,8,5,'Goal 3 Course of Action','Course of Action',29,131,2,'2015-07-16 12:45:18','2015-07-16 16:45:18',NULL),(156,9,NULL,'Basic Plan','Uploaded Basic Plan',17,NULL,NULL,'2015-07-20 17:12:17','2015-07-20 21:12:17','{\"file_name\":\"uploaded_EOP_.docx\",\"file_type\":\"application\\/vnd.openxmlformats-officedocument.wordprocessingml.document\",\"file_path\":\"\\/Users\\/GMajwega\\/Sites\\/eop2.0\\/uploads\\/\",\"full_path\":\"\\/Users\\/GMajwega\\/Sites\\/eop2.0\\/uploads\\/uploaded_EOP_.docx\",\"raw_name\":\"uploaded_EOP_\",\"orig_name\":\"uploaded_EOP_.docx\",\"client_name\":\"Weekly Status Report Godfrey Majwega 2015-01-23.docx\",\"file_ext\":\".docx\",\"file_size\":27.35,\"is_image\":false,\"image_width\":\"\",\"image_height\":\"\",\"image_type\":\"\",\"image_size_str\":\"\"}'),(157,9,12,'Basic Plan','Uploaded Basic Plan',17,NULL,NULL,'2015-07-22 13:05:50','2015-07-22 17:05:50','{\"file_name\":\"uploaded_EOP_12.docx\",\"file_type\":\"application\\/vnd.openxmlformats-officedocument.wordprocessingml.document\",\"file_path\":\"\\/Users\\/GMajwega\\/Sites\\/eop2.0\\/uploads\\/\",\"full_path\":\"\\/Users\\/GMajwega\\/Sites\\/eop2.0\\/uploads\\/uploaded_EOP_12.docx\",\"raw_name\":\"uploaded_EOP_12\",\"orig_name\":\"uploaded_EOP_12.docx\",\"client_name\":\"Weekly Status Report Godfrey Majwega 2015-01-23.docx\",\"file_ext\":\".docx\",\"file_size\":27.35,\"is_image\":false,\"image_width\":\"\",\"image_height\":\"\",\"image_type\":\"\",\"image_size_str\":\"\"}'),(158,3,5,'aaaas','aaaa',29,NULL,NULL,'2015-07-22 14:09:44','2015-08-07 16:36:08','live'),(159,4,5,'Goal 1','Goal 1 (Before)',29,158,1,'2015-07-22 14:09:44','2015-07-22 18:09:44',NULL),(160,7,5,'Goal 1 Objective','Objective',29,159,0,'2015-07-22 14:09:44','2015-07-22 18:09:44',NULL),(161,8,5,'Goal 1 Course of Action','Course of Action',29,159,0,'2015-07-22 14:09:44','2015-07-22 18:09:44',NULL),(162,5,5,'Goal 2','Goal 2 (During)',29,158,2,'2015-07-22 14:09:44','2015-07-22 18:09:44',NULL),(163,7,5,'Goal 2 Objective','Objective',29,162,1,'2015-07-22 14:09:44','2015-07-22 18:09:44',NULL),(164,8,5,'Goal 2 Course of Action','Course of Action',29,162,1,'2015-07-22 14:09:44','2015-07-22 18:09:44',NULL),(165,6,5,'Goal 3','Goal 3 (After)',29,158,3,'2015-07-22 14:09:44','2015-07-22 18:09:44',NULL),(166,7,5,'Goal 3 Objective','Objective',29,165,2,'2015-07-22 14:09:44','2015-07-22 18:09:44',NULL),(167,8,5,'Goal 3 Course of Action','Course of Action',29,165,2,'2015-07-22 14:09:44','2015-07-22 18:09:44',NULL),(168,2,NULL,'Communications and Warning','Communications and Warning',33,137,NULL,'2015-07-24 08:42:40','2015-07-24 12:42:40',NULL),(169,2,NULL,'Evacuation','Evacuation',33,140,NULL,'2015-07-24 08:42:40','2015-07-24 12:42:40',NULL),(170,2,NULL,'Family Reunification','Family Reunification',33,143,NULL,'2015-07-24 08:42:40','2015-07-24 12:42:40',NULL),(171,2,NULL,'Continuity of Operations (COOP)','Continuity of Operations (COOP)',33,138,NULL,'2015-07-24 08:42:40','2015-07-24 12:42:40',NULL),(172,2,NULL,'Family Reunification','Family Reunification',33,141,NULL,'2015-07-24 08:42:40','2015-07-24 12:42:40',NULL),(173,2,NULL,'Communications and Warning','Communications and Warning',33,144,NULL,'2015-07-24 08:42:40','2015-07-24 12:42:40',NULL),(174,4,NULL,'Goal 1','Goal 1 (Before)',33,168,1,'2015-07-24 08:43:05','2015-07-24 12:43:05',NULL),(175,7,NULL,'Goal 1 Objective','Objective',33,174,1,'2015-07-24 08:43:05','2015-07-24 12:43:05',NULL),(176,5,NULL,'Goal 2','Goal 2 (Before)',33,168,1,'2015-07-24 08:43:05','2015-07-24 12:43:05',NULL),(177,7,NULL,'Goal 2 Objective','Objective',33,176,1,'2015-07-24 08:43:05','2015-07-24 12:43:05',NULL),(178,6,NULL,'Goal 3','Goal 3 (Before)',33,168,1,'2015-07-24 08:43:06','2015-07-24 12:43:06',NULL),(179,7,NULL,'Goal 3 Objective','Objective',33,178,1,'2015-07-24 08:43:06','2015-07-24 12:43:06',NULL),(180,1,NULL,'form1','Introductory Material',33,NULL,1,'2015-07-24 08:43:47','2015-07-24 12:43:47',NULL),(181,1,NULL,'1.0','Cover Page',33,180,1,'2015-07-24 08:43:47','2015-07-24 12:43:47',NULL),(182,1,NULL,'1.1','Promulgation Document and Signatures',33,180,2,'2015-07-24 08:43:47','2015-07-24 12:43:47',NULL),(183,1,NULL,'1.2','Approval and Implementation',33,180,3,'2015-07-24 08:43:47','2015-07-24 12:43:47',NULL),(184,1,NULL,'1.3','Record of Changes',33,180,3,'2015-07-24 08:43:47','2015-07-24 12:43:47',NULL),(185,1,NULL,'1.4','Record of Distribution',33,180,4,'2015-07-24 08:43:47','2015-07-24 12:43:47',NULL),(187,1,5,'form1','Introductory Material',17,NULL,1,'2015-07-29 12:34:55','2015-07-29 16:34:55',NULL),(188,1,5,'1.0','Cover Page',17,187,1,'2015-07-29 12:34:55','2015-07-29 16:34:55',NULL),(189,1,5,'1.1','Promulgation Document and Signatures',17,187,2,'2015-07-29 12:34:55','2015-07-29 16:34:55',NULL),(190,1,5,'1.2','Approval and Implementation',17,187,3,'2015-07-29 12:34:55','2015-07-29 16:34:55',NULL),(191,1,5,'1.3','Record of Changes',17,187,3,'2015-07-29 12:34:55','2015-07-29 16:34:55',NULL),(192,1,5,'1.4','Record of Distribution',17,187,4,'2015-07-29 12:34:55','2015-07-29 16:34:55',NULL),(219,2,5,'Evacuation','Evacuation',17,159,NULL,'2015-08-05 12:12:23','2015-08-05 16:12:23',NULL),(220,2,5,'Public Health, Medical, and Mental Health','Public Health, Medical, and Mental Health',17,162,NULL,'2015-08-05 12:12:23','2015-08-05 16:12:23',NULL),(221,2,5,'Evacuation','Evacuation',17,165,NULL,'2015-08-05 12:12:23','2015-08-05 16:12:23',NULL),(222,2,5,'Public Health, Medical, and Mental Health','Public Health, Medical, and Mental Health',17,160,NULL,'2015-08-05 12:12:23','2015-08-05 16:12:23',NULL),(223,2,5,'Continuity of Operations (COOP)','Continuity of Operations (COOP)',17,163,NULL,'2015-08-05 12:12:23','2015-08-05 16:12:23',NULL),(224,2,5,'Communications and Warning','Communications and Warning',17,166,NULL,'2015-08-05 12:12:23','2015-08-05 16:12:23',NULL),(229,3,5,'gsssssp','sssss',29,NULL,NULL,'2015-08-07 12:19:58','2015-08-07 16:37:00','offline'),(230,4,5,'Goal 1','Goal 1 (Before)',29,229,1,'2015-08-07 12:19:58','2015-08-07 16:19:58',NULL),(231,7,5,'Goal 1 Objective','Objective',29,230,0,'2015-08-07 12:19:58','2015-08-07 16:19:58',NULL),(232,8,5,'Goal 1 Course of Action','Course of Action',29,230,0,'2015-08-07 12:19:58','2015-08-07 16:19:58',NULL),(233,5,5,'Goal 2','Goal 2 (During)',29,229,2,'2015-08-07 12:19:58','2015-08-07 16:19:58',NULL),(234,7,5,'Goal 2 Objective','Objective',29,233,1,'2015-08-07 12:19:58','2015-08-07 16:19:58',NULL),(235,8,5,'Goal 2 Course of Action','Course of Action',29,233,1,'2015-08-07 12:19:58','2015-08-07 16:19:58',NULL),(236,6,5,'Goal 3','Goal 3 (After)',29,229,3,'2015-08-07 12:19:58','2015-08-07 16:19:58',NULL),(237,7,5,'Goal 3 Objective','Objective',29,236,2,'2015-08-07 12:19:58','2015-08-07 16:19:58',NULL),(238,8,5,'Goal 3 Course of Action','Course of Action',29,236,2,'2015-08-07 12:19:58','2015-08-07 16:19:58',NULL),(239,3,5,'aaa','aaa',29,NULL,NULL,'2015-08-07 12:28:18','2015-08-07 16:37:00','offline'),(240,4,5,'Goal 1','Goal 1 (Before)',29,239,1,'2015-08-07 12:28:18','2015-08-07 16:28:18',NULL),(241,7,5,'Goal 1 Objective','Objective',29,240,0,'2015-08-07 12:28:18','2015-08-07 16:28:18',NULL),(242,8,5,'Goal 1 Course of Action','Course of Action',29,240,0,'2015-08-07 12:28:18','2015-08-07 16:28:18',NULL),(243,5,5,'Goal 2','Goal 2 (During)',29,239,2,'2015-08-07 12:28:18','2015-08-07 16:28:18',NULL),(244,7,5,'Goal 2 Objective','Objective',29,243,1,'2015-08-07 12:28:18','2015-08-07 16:28:18',NULL),(245,8,5,'Goal 2 Course of Action','Course of Action',29,243,1,'2015-08-07 12:28:18','2015-08-07 16:28:18',NULL),(246,6,5,'Goal 3','Goal 3 (After)',29,239,3,'2015-08-07 12:28:18','2015-08-07 16:28:18',NULL),(247,7,5,'Goal 3 Objective','Objective',29,246,2,'2015-08-07 12:28:18','2015-08-07 16:28:18',NULL),(248,8,5,'Goal 3 Course of Action','Course of Action',29,246,2,'2015-08-07 12:28:18','2015-08-07 16:28:18',NULL),(249,3,5,'ddddd','ddddd',29,NULL,NULL,'2015-08-07 12:28:28','2015-08-07 16:37:00','offline'),(250,4,5,'Goal 1','Goal 1 (Before)',29,249,1,'2015-08-07 12:28:28','2015-08-07 16:28:28',NULL),(251,7,5,'Goal 1 Objective','Objective',29,250,0,'2015-08-07 12:28:28','2015-08-07 16:28:28',NULL),(252,8,5,'Goal 1 Course of Action','Course of Action',29,250,0,'2015-08-07 12:28:28','2015-08-07 16:28:28',NULL),(253,5,5,'Goal 2','Goal 2 (During)',29,249,2,'2015-08-07 12:28:28','2015-08-07 16:28:28',NULL),(254,7,5,'Goal 2 Objective','Objective',29,253,1,'2015-08-07 12:28:28','2015-08-07 16:28:28',NULL),(255,8,5,'Goal 2 Course of Action','Course of Action',29,253,1,'2015-08-07 12:28:28','2015-08-07 16:28:28',NULL),(256,6,5,'Goal 3','Goal 3 (After)',29,249,3,'2015-08-07 12:28:28','2015-08-07 16:28:28',NULL),(257,7,5,'Goal 3 Objective','Objective',29,256,2,'2015-08-07 12:28:28','2015-08-07 16:28:28',NULL),(258,8,5,'Goal 3 Course of Action','Course of Action',29,256,2,'2015-08-07 12:28:28','2015-08-07 16:28:28',NULL),(259,3,5,'aaaaaaa','aaaaaaa',29,NULL,NULL,'2015-08-07 12:35:55','2015-08-07 16:37:00','offline'),(260,4,5,'Goal 1','Goal 1 (Before)',29,259,1,'2015-08-07 12:35:55','2015-08-07 16:35:55',NULL),(261,7,5,'Goal 1 Objective','Objective',29,260,0,'2015-08-07 12:35:55','2015-08-07 16:35:55',NULL),(262,8,5,'Goal 1 Course of Action','Course of Action',29,260,0,'2015-08-07 12:35:55','2015-08-07 16:35:55',NULL),(263,5,5,'Goal 2','Goal 2 (During)',29,259,2,'2015-08-07 12:35:55','2015-08-07 16:35:55',NULL),(264,7,5,'Goal 2 Objective','Objective',29,263,1,'2015-08-07 12:35:55','2015-08-07 16:35:55',NULL),(265,8,5,'Goal 2 Course of Action','Course of Action',29,263,1,'2015-08-07 12:35:55','2015-08-07 16:35:55',NULL),(266,6,5,'Goal 3','Goal 3 (After)',29,259,3,'2015-08-07 12:35:55','2015-08-07 16:35:55',NULL),(267,7,5,'Goal 3 Objective','Objective',29,266,2,'2015-08-07 12:35:55','2015-08-07 16:35:55',NULL),(268,8,5,'Goal 3 Course of Action','Course of Action',29,266,2,'2015-08-07 12:35:55','2015-08-07 16:35:55',NULL),(281,7,5,'Goal 3 Objective','Objective',17,165,2,'2015-08-11 17:46:33','2015-08-11 21:46:33',NULL),(282,2,5,'Communications and Warning','Communications and Warning',17,281,NULL,'2015-08-11 17:46:33','2015-08-11 21:46:33',NULL),(283,1,5,'form10','Authorities and References',17,NULL,1,'2015-08-12 10:18:35','2015-08-12 14:18:35',NULL),(284,1,5,'10.1','Authorities and References',17,283,1,'2015-08-12 10:18:35','2015-08-12 14:18:35',NULL),(288,9,5,'Basic Plan','Uploaded Basic Plan',17,NULL,NULL,'2015-08-12 17:34:06','2015-08-12 21:34:06','{\"cover\":{\"file_name\":\"uploaded_EOP_cover_5.docx\",\"file_type\":\"application\\/vnd.openxmlformats-officedocument.wordprocessingml.document\",\"file_path\":\"\\/Users\\/GMajwega\\/Sites\\/eop2.0\\/uploads\\/\",\"full_path\":\"\\/Users\\/GMajwega\\/Sites\\/eop2.0\\/uploads\\/uploaded_EOP_cover_5.docx\",\"raw_name\":\"uploaded_EOP_cover_5\",\"orig_name\":\"uploaded_EOP_cover_5.docx\",\"client_name\":\"sample.docx\",\"file_ext\":\".docx\",\"file_size\":11.4,\"is_image\":false,\"image_width\":\"\",\"image_height\":\"\",\"image_type\":\"\",\"image_size_str\":\"\"},\"main\":{\"file_name\":\"uploaded_EOP_main_5.docx\",\"file_type\":\"application\\/vnd.openxmlformats-officedocument.wordprocessingml.document\",\"file_path\":\"\\/Users\\/GMajwega\\/Sites\\/eop2.0\\/uploads\\/\",\"full_path\":\"\\/Users\\/GMajwega\\/Sites\\/eop2.0\\/uploads\\/uploaded_EOP_main_5.docx\",\"raw_name\":\"uploaded_EOP_main_5\",\"orig_name\":\"uploaded_EOP_main_5.docx\",\"client_name\":\"Cover page.docx\",\"file_ext\":\".docx\",\"file_size\":33.08,\"is_image\":false,\"image_width\":\"\",\"image_height\":\"\",\"image_type\":\"\",\"image_size_str\":\"\"}}');
/*!40000 ALTER TABLE `eop_entity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_entity_types`
--

DROP TABLE IF EXISTS `eop_entity_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_entity_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_entity_types`
--

LOCK TABLES `eop_entity_types` WRITE;
/*!40000 ALTER TABLE `eop_entity_types` DISABLE KEYS */;
INSERT INTO `eop_entity_types` VALUES (1,'bp','Basic Plan'),(2,'fn','Functional Annex'),(3,'th','Threat- and Hazard-Specific Annex'),(4,'g1','Goal 1 (Before)'),(5,'g2','Goal 2 (During)'),(6,'g3','Goal 3 (After)'),(7,'obj','Objective'),(8,'ca','Course of Action'),(9,'file','Uploaded File');
/*!40000 ALTER TABLE `eop_entity_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_field`
--

DROP TABLE IF EXISTS `eop_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(32) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `weight` int(8) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(45) DEFAULT NULL,
  `body` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_field`
--

LOCK TABLES `eop_field` WRITE;
/*!40000 ALTER TABLE `eop_field` DISABLE KEYS */;
INSERT INTO `eop_field` VALUES (1,110,'Goal 1 Field','Goal 1 Field',1,'2015-07-15 14:22:51','2015-07-23 20:35:05','text','<p>me22</p>\n'),(2,111,'Goal 1 Objective Field','Goal 1 Objective Field',1,'2015-07-15 14:22:51','2015-07-15 18:22:51','text','<p>asdfa</p>\n'),(3,112,'Goal 1 TH Course of Action Field','Goal 1 TH Course of Action Field',1,'2015-07-15 14:22:51','2015-07-29 15:26:30','text','<p>dsfsadf</p>\n'),(4,113,'Goal 2 Field','Goal 2 Field',1,'2015-07-15 14:22:51','2015-07-15 18:22:51','text','<p>asdfasdf</p>\n'),(5,114,'Goal 2 Objective Field','Goal 2 Objective Field',1,'2015-07-15 14:22:51','2015-07-15 18:22:51','text','<p>sfasf</p>\n'),(6,115,'Goal 2 TH Course of Action Field','Goal 2 TH Course of Action Field',1,'2015-07-15 14:22:51','2015-07-29 15:26:30','text','<p>asfdsa</p>\n'),(7,116,'Goal 3 Field','Goal 3 Field',1,'2015-07-15 14:22:51','2015-07-15 18:22:51','text','<p>sdfas</p>\n'),(8,117,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-07-15 14:22:51','2015-07-15 18:22:51','text','<p>safa</p>\n'),(9,118,'Goal 3 TH Course of Action Field','Goal 3 TH Course of Action Field',1,'2015-07-15 14:22:51','2015-07-29 15:26:30','text','<p>sfasfd</p>\n'),(10,109,'TH Field','Threats and Hazards Default Field',1,'2015-07-15 14:25:15','2015-07-15 18:25:15','text',''),(11,125,'Objective Field','Objective',1,'2015-07-15 14:27:40','2015-07-15 18:27:40','text','<p>asdasfasdf</p>\n'),(12,127,'Goal 1 Function Field','Goal 1 Function Field',1,'2015-07-15 14:36:05','2015-07-15 18:36:05','text','<p>sadAD</p>\n'),(13,128,'Goal 1 Objective Field','Goal 1 Objective Field',1,'2015-07-15 14:36:05','2015-07-15 18:36:05','text','<p>ASD asd</p>\n'),(14,129,'Goal 2 Function Field','Goal 2 Function Field',1,'2015-07-15 14:36:05','2015-07-15 18:36:05','text','<p>dADS</p>\n'),(15,130,'Goal 2 Objective Field','Goal 2 Objective Field',1,'2015-07-15 14:36:05','2015-07-15 18:36:05','text','<p>asd a</p>\n'),(16,131,'Goal 3 Function Field','Goal 3 Function Field',1,'2015-07-15 14:36:05','2015-07-15 18:36:05','text','<p>Ad AD S</p>\n'),(17,132,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-07-15 14:36:05','2015-07-15 18:36:05','text','<p>ASD a ds</p>\n'),(18,133,'Goal 1 Objective Field','Goal 1 Objective Field',1,'2015-07-15 14:36:21','2015-07-15 18:36:21','text',''),(19,134,'Goal 1 Objective Field','Goal 1 Objective Field',1,'2015-07-15 14:38:53','2015-07-15 18:38:53','text',''),(20,135,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-07-15 16:05:10','2015-07-28 19:34:54','text','<p>loop saio hfas jfaslkd fjaslk fsaf</p>\n\n<ul>\n	<li>s ashdlfk sahfk aflkajf asd fhlaskd hlkasdfh laksjhf slkajfh laskdhfalskhfdlkashdflakjhflkasjhd fslkadjh flkasjdhflaksjdhflaskjhdf lkashflkasflakhdflakjhfd</li>\n	<li>asd fklahsdf lksdahf lakd hflkaj hflkasjh flskajh fdalksjfh laksdhf laks fhlak j fhlaksjd hflaks hdflsakjdfh laksj hdfsladkjhfslakjdfhlask hlaksdhflkasfhalskdfhlaskjfhlaskdjfhlaksjd hlaskdfj haslkdfhalskdfhalksdfhalskdfhaskdfhalskjdhflaksdf haf a</li>\n</ul>\n'),(21,137,'Goal 1 Field','Goal 1 Field',1,'2015-07-16 09:50:30','2015-07-24 12:42:40','text','<p>ewfqa</p>\n'),(22,138,'Goal 1 Objective Field','Goal 1 Objective Field',1,'2015-07-16 09:50:30','2015-07-24 12:42:40','text','<p>asdfsa</p>\n'),(23,139,'Goal 1 TH Course of Action Field','Goal 1 TH Course of Action Field',1,'2015-07-16 09:50:31','2015-07-16 13:50:31','text',''),(24,140,'Goal 2 Field','Goal 2 Field',1,'2015-07-16 09:50:32','2015-07-24 12:42:40','text','<p>sdfasf</p>\n'),(25,141,'Goal 2 Objective Field','Goal 2 Objective Field',1,'2015-07-16 09:50:32','2015-07-24 12:42:40','text','<p>asdfsaf</p>\n'),(26,142,'Goal 2 TH Course of Action Field','Goal 2 TH Course of Action Field',1,'2015-07-16 09:50:32','2015-07-16 13:50:32','text',''),(27,143,'Goal 3 Field','Goal 3 Field',1,'2015-07-16 09:50:32','2015-07-24 12:42:40','text','<p>sadfaf</p>\n'),(28,144,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-07-16 09:50:33','2015-07-24 12:42:40','text','<p>asdfasf</p>\n'),(29,145,'Goal 3 TH Course of Action Field','Goal 3 TH Course of Action Field',1,'2015-07-16 09:50:34','2015-07-16 13:50:34','text',''),(30,146,'Goal 1FN Course of Action Field','Goal 1FN Course of Action Field',1,'2015-07-16 12:45:18','2015-07-16 16:45:18','text','<p>Default.rdp</p>\n'),(31,147,'Goal 2FN Course of Action Field','Goal 2FN Course of Action Field',1,'2015-07-16 12:45:18','2015-07-28 21:32:04','text','<p><!-- Generated by PHPWord -->PHPWord</p>\n\n<p>Weekly Status Report</p>\n\n<p>&nbsp;</p>\n\n<p>Name:</p>\n\n<p>Godfrey Majwega</p>\n\n<p>Week Ending:</p>\n\n<p>01/23</p>\n\n<p>/2015</p>\n\n<p>Submitted to:</p>\n\n<p>Sippy Joseph, Todd Makino</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p><strong>Accomplishments for</strong></p>\n\n<p><strong>This Week:</strong></p>\n\n<p><strong>Project</strong></p>\n\n<p><strong>Activity</strong></p>\n\n<p>EOP-Assist</p>\n\n<p>Finalized debugging for special characters; resolved by updating all data manipulation sql scripts to encode textual data to and from the database.</p>\n\n<ul>\n	<li><strong>Developed </strong>session management for the tool with 5minutes timeout and session id regeneration to prevent session fixation and session tracking.</li>\n	<li>Debugged file upload functionality. <strong>Database </strong>table needed altering to include school district field.</li>\n	<li>Corrected special character issues (extra backslashes) in the auto generated My-EOP report. Solved by updating scripts to decoding data from database before writing to word document.\n	<ul>\n		<li>sadfasdfa</li>\n		<li>asfdadfaf</li>\n		<li>asdfafda</li>\n	</ul>\n	</li>\n	<li>asfdasfasfdadfafda</li>\n</ul>\n\n<p>&nbsp;</p>\n\n<p>Corrected My-EOP report formatting issues raised after testing.</p>\n\n<p>Packaged debugged EOP-Assist tool to be deployed as second version.</p>\n\n<p>NCELA</p>\n\n<p>Briefed about the project from Sippy</p>\n\n<p>Deployed copy of website on my local machine for easy problem diagnosis.</p>\n\n<p>Familiarized myself with the Drupal website&rsquo;s templates, database and cross examined different tables.</p>\n\n<p>Written script to update resource library descriptors from the old Comma Separated Value list to a new multi select list.</p>\n\n<p>Started work on developing featured topics mock ups into drupal site, by creating special templates for the intended section.</p>\n\n<p>Was briefed about resource library search tool current state and requirements.</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p><strong>Accomplishments Planned for</strong></p>\n\n<p><strong>Next Week:</strong></p>\n\n<p><strong>Project</strong></p>\n\n<p><strong>Activity</strong></p>\n\n<p>NCELA</p>\n\n<p>Research library search refinement</p>\n\n<p>Execute descriptor script on dev server</p>\n\n<p>New page for search results</p>\n\n<p>Work on search results logic, to be sorted chronologically according to creation date in Descending order.</p>\n\n<p>Complete templates for feature topics section</p>\n\n<p>Work with Caspar to ensure properly styled content.</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p><strong>Current </strong></p>\n\n<p><strong>Issues:</strong></p>\n\n<p>&nbsp;</p>\n\n<p><em>(items in dispute or negative risks that are realized)</em></p>\n\n<p>&nbsp;</p>\n\n<p><strong>Affected </strong></p>\n\n<p><strong>Project</strong></p>\n\n<p><strong>Description of Issue</strong></p>\n\n<p><strong>Resolution Plan</strong></p>\n\n<p>NCELA</p>\n\n<p>Search results not arranged meaningfully.</p>\n\n<p>&nbsp;</p>\n\n<p>Descriptor updates</p>\n\n<p>&nbsp;</p>\n\n<p>Feature topics templates development</p>\n\n<p>To create separate view page to show search results.</p>\n\n<p>Test and run the script on the database.</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p><strong>Potential Risks:</strong></p>\n\n<p>&nbsp;</p>\n\n<p><em>(could happen, but have not)</em></p>\n\n<p><strong>Affected Project</strong></p>\n\n<p><strong>Description of Risk</strong></p>\n\n<p>EOP-ASSIST</p>\n\n<p>None</p>\n\n<p>NCELA</p>\n\n<p>None</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p><strong>Observation of </strong></p>\n\n<p><strong>Excellence</strong></p>\n\n<p><strong>:</strong></p>\n\n<p><strong>Name of Colleague</strong></p>\n\n<p>&nbsp;</p>\n\n<p><strong>Description of </strong></p>\n\n<p><strong>Above &amp; Beyond Activity</strong></p>\n\n<p>&nbsp;</p>\n\n<p>Ninpin Sayal</p>\n\n<p>&nbsp;</p>\n\n<p>Owned the test process, extra attention to detail and thoroughly retested the tool while timely communicating the bugs for fixes.</p>\n\n<p>&nbsp;</p>\n\n<p><strong>Other:</strong></p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n'),(32,148,'Goal 3FN Course of Action Field','Goal 3FN Course of Action Field',1,'2015-07-16 12:45:18','2015-07-16 16:45:18','text','<p>Weekly Status Report TEMPLATE yourname 2015-mm-dd.docx</p>\n'),(33,159,'Goal 1 Field','Goal 1 Field',1,'2015-07-22 14:09:44','2015-08-05 16:12:23','text','<p>AD</p>\n'),(34,160,'Goal 1 Objective Field','Goal 1 Objective Field',1,'2015-07-22 14:09:44','2015-08-05 16:12:23','text','<p>ADa</p>\n'),(35,161,'Goal 1 TH Course of Action Field','Goal 1 TH Course of Action Field',1,'2015-07-22 14:09:44','2015-07-22 18:09:44','text',''),(36,162,'Goal 2 Field','Goal 2 Field',1,'2015-07-22 14:09:44','2015-08-05 16:12:23','text','<p>ADA</p>\n'),(37,163,'Goal 2 Objective Field','Goal 2 Objective Field',1,'2015-07-22 14:09:44','2015-08-05 16:12:23','text','<p>adA</p>\n'),(38,164,'Goal 2 TH Course of Action Field','Goal 2 TH Course of Action Field',1,'2015-07-22 14:09:44','2015-07-22 18:09:44','text',''),(39,165,'Goal 3 Field','Goal 3 Field',1,'2015-07-22 14:09:44','2015-08-05 16:12:23','text','<p>Ads</p>\n'),(40,166,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-07-22 14:09:44','2015-08-05 16:12:23','text','<p>adAD</p>\n'),(41,167,'Goal 3 TH Course of Action Field','Goal 3 TH Course of Action Field',1,'2015-07-22 14:09:44','2015-07-22 18:09:44','text',''),(42,136,'TH Field','Threats and Hazards Default Field',1,'2015-07-24 08:42:40','2015-07-24 12:42:40','text',''),(43,174,'Goal 1 Function Field','Goal 1 Function Field',1,'2015-07-24 08:43:05','2015-07-24 12:43:05','text','<p>asdfaf</p>\n'),(44,175,'Goal 1 Objective Field','Goal 1 Objective Field',1,'2015-07-24 08:43:05','2015-07-24 12:43:05','text','<p>asda</p>\n'),(45,176,'Goal 2 Function Field','Goal 2 Function Field',1,'2015-07-24 08:43:05','2015-07-24 12:43:05','text','<p>asdfa</p>\n'),(46,177,'Goal 2 Objective Field','Goal 2 Objective Field',1,'2015-07-24 08:43:06','2015-07-24 12:43:06','text','<p>asdfa</p>\n'),(47,178,'Goal 3 Function Field','Goal 3 Function Field',1,'2015-07-24 08:43:06','2015-07-24 12:43:06','text','<p>asdfa</p>\n'),(48,179,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-07-24 08:43:06','2015-07-24 12:43:06','text','<p>asdfsaf</p>\n'),(49,181,'Title Field','Title of the plan',1,'2015-07-24 08:43:47','2015-07-24 12:43:47','text','asdfa'),(50,181,'Date Field','Date',2,'2015-07-24 08:43:47','2015-07-24 12:43:47','text','2015-07-24'),(51,181,'School Field','The school(s) covered by the plan',3,'2015-07-24 08:43:47','2015-07-24 12:43:47','text','<p>asdfasf</p>\n'),(52,182,'Promulgation Field','Promulgation Field',1,'2015-07-24 08:43:47','2015-07-24 12:43:47','text','<p>asdfa</p>\n'),(53,183,'Approval Field','Approval Field',1,'2015-07-24 08:43:47','2015-07-24 12:43:47','text','<p>asdfasf</p>\n'),(54,184,'Change Number','Change Number',1,'2015-07-24 08:43:47','2015-07-24 12:43:47','text','asdf'),(55,184,'Date of Change','Date of Change',1,'2015-07-24 08:43:47','2015-07-24 12:43:47','text','2015-07-24'),(56,184,'Name','Name',1,'2015-07-24 08:43:47','2015-07-24 12:43:47','text','asdf'),(57,184,'Summary of Change','Summary of Change',1,'2015-07-24 08:43:47','2015-07-24 12:43:47','text','asdfa'),(58,185,'Title and name of person receiving the plan','Title and name of person receiving the plan',1,'2015-07-24 08:43:47','2015-07-24 12:43:47','text','asfd'),(59,185,'Agency (school office, government agency, or private-sector entity','Agency (school office, government agency, or private-sector entity',1,'2015-07-24 08:43:47','2015-07-24 12:43:47','text','asdf'),(60,185,'Date of delivery','Date of delivery',1,'2015-07-24 08:43:47','2015-07-24 12:43:47','text','2015-07-24'),(61,185,'Number of copies delivered','Number of copies delivered',1,'2015-07-24 08:43:47','2015-07-24 12:43:47','text','asdfa'),(62,188,'Title Field','Title of the plan',1,'2015-07-29 12:34:55','2015-07-29 16:34:55','text','asdds'),(63,188,'Date Field','Date',2,'2015-07-29 12:34:55','2015-07-29 16:34:55','text','2015-07-29'),(64,188,'School Field','The school(s) covered by the plan',3,'2015-07-29 12:34:55','2015-07-29 16:34:55','text','<p>ads dasd</p>\n'),(65,189,'Promulgation Field','Promulgation Field',1,'2015-07-29 12:34:55','2015-08-12 14:13:22','text','<p>0</p>\n'),(66,190,'Approval Field','Approval Field',1,'2015-07-29 12:34:55','2015-08-12 14:13:22','text','<p>0</p>\n'),(67,158,'TH Field','Threats and Hazards Default Field',1,'2015-08-05 12:12:23','2015-08-05 16:12:23','text',''),(69,230,'Goal 1 Field','Goal 1 Field',1,'2015-08-07 12:19:58','2015-08-07 16:19:58','text',''),(70,231,'Goal 1 Objective Field','Goal 1 Objective Field',1,'2015-08-07 12:19:58','2015-08-07 16:19:58','text',''),(71,232,'Goal 1 TH Course of Action Field','Goal 1 TH Course of Action Field',1,'2015-08-07 12:19:58','2015-08-07 16:19:58','text',''),(72,233,'Goal 2 Field','Goal 2 Field',1,'2015-08-07 12:19:58','2015-08-07 16:19:58','text',''),(73,234,'Goal 2 Objective Field','Goal 2 Objective Field',1,'2015-08-07 12:19:58','2015-08-07 16:19:58','text',''),(74,235,'Goal 2 TH Course of Action Field','Goal 2 TH Course of Action Field',1,'2015-08-07 12:19:58','2015-08-07 16:19:58','text',''),(75,236,'Goal 3 Field','Goal 3 Field',1,'2015-08-07 12:19:58','2015-08-07 16:19:58','text',''),(76,237,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-08-07 12:19:58','2015-08-07 16:19:58','text',''),(77,238,'Goal 3 TH Course of Action Field','Goal 3 TH Course of Action Field',1,'2015-08-07 12:19:58','2015-08-07 16:19:58','text',''),(78,240,'Goal 1 Field','Goal 1 Field',1,'2015-08-07 12:28:18','2015-08-07 16:28:18','text',''),(79,241,'Goal 1 Objective Field','Goal 1 Objective Field',1,'2015-08-07 12:28:18','2015-08-07 16:28:18','text',''),(80,242,'Goal 1 TH Course of Action Field','Goal 1 TH Course of Action Field',1,'2015-08-07 12:28:18','2015-08-07 16:28:18','text',''),(81,243,'Goal 2 Field','Goal 2 Field',1,'2015-08-07 12:28:18','2015-08-07 16:28:18','text',''),(82,244,'Goal 2 Objective Field','Goal 2 Objective Field',1,'2015-08-07 12:28:18','2015-08-07 16:28:18','text',''),(83,245,'Goal 2 TH Course of Action Field','Goal 2 TH Course of Action Field',1,'2015-08-07 12:28:18','2015-08-07 16:28:18','text',''),(84,246,'Goal 3 Field','Goal 3 Field',1,'2015-08-07 12:28:18','2015-08-07 16:28:18','text',''),(85,247,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-08-07 12:28:18','2015-08-07 16:28:18','text',''),(86,248,'Goal 3 TH Course of Action Field','Goal 3 TH Course of Action Field',1,'2015-08-07 12:28:18','2015-08-07 16:28:18','text',''),(87,250,'Goal 1 Field','Goal 1 Field',1,'2015-08-07 12:28:28','2015-08-07 16:28:28','text',''),(88,251,'Goal 1 Objective Field','Goal 1 Objective Field',1,'2015-08-07 12:28:28','2015-08-07 16:28:28','text',''),(89,252,'Goal 1 TH Course of Action Field','Goal 1 TH Course of Action Field',1,'2015-08-07 12:28:28','2015-08-07 16:28:28','text',''),(90,253,'Goal 2 Field','Goal 2 Field',1,'2015-08-07 12:28:28','2015-08-07 16:28:28','text',''),(91,254,'Goal 2 Objective Field','Goal 2 Objective Field',1,'2015-08-07 12:28:28','2015-08-07 16:28:28','text',''),(92,255,'Goal 2 TH Course of Action Field','Goal 2 TH Course of Action Field',1,'2015-08-07 12:28:28','2015-08-07 16:28:28','text',''),(93,256,'Goal 3 Field','Goal 3 Field',1,'2015-08-07 12:28:28','2015-08-07 16:28:28','text',''),(94,257,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-08-07 12:28:28','2015-08-07 16:28:28','text',''),(95,258,'Goal 3 TH Course of Action Field','Goal 3 TH Course of Action Field',1,'2015-08-07 12:28:28','2015-08-07 16:28:28','text',''),(96,260,'Goal 1 Field','Goal 1 Field',1,'2015-08-07 12:35:55','2015-08-07 16:35:55','text',''),(97,261,'Goal 1 Objective Field','Goal 1 Objective Field',1,'2015-08-07 12:35:55','2015-08-07 16:35:55','text',''),(98,262,'Goal 1 TH Course of Action Field','Goal 1 TH Course of Action Field',1,'2015-08-07 12:35:55','2015-08-07 16:35:55','text',''),(99,263,'Goal 2 Field','Goal 2 Field',1,'2015-08-07 12:35:55','2015-08-07 16:35:55','text',''),(100,264,'Goal 2 Objective Field','Goal 2 Objective Field',1,'2015-08-07 12:35:55','2015-08-07 16:35:55','text',''),(101,265,'Goal 2 TH Course of Action Field','Goal 2 TH Course of Action Field',1,'2015-08-07 12:35:55','2015-08-07 16:35:55','text',''),(102,266,'Goal 3 Field','Goal 3 Field',1,'2015-08-07 12:35:55','2015-08-07 16:35:55','text',''),(103,267,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-08-07 12:35:55','2015-08-07 16:35:55','text',''),(104,268,'Goal 3 TH Course of Action Field','Goal 3 TH Course of Action Field',1,'2015-08-07 12:35:55','2015-08-07 16:35:55','text',''),(110,281,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-08-11 17:46:33','2015-08-11 21:46:33','text','<p>ergss</p>\n'),(111,284,'Authorities and References Field','Authorities and References',1,'2015-08-12 10:18:35','2015-08-12 14:18:35','text','<p>kk</p>\n');
/*!40000 ALTER TABLE `eop_field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_registry`
--

DROP TABLE IF EXISTS `eop_registry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_registry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rkey` varchar(32) NOT NULL,
  `value` longtext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_registry`
--

LOCK TABLES `eop_registry` WRITE;
/*!40000 ALTER TABLE `eop_registry` DISABLE KEYS */;
INSERT INTO `eop_registry` VALUES (39,'install_status','completed','2015-05-26 16:31:31'),(40,'dbtype','mysqli','2015-05-26 16:31:31'),(41,'host_level','state','2015-05-26 16:31:31'),(42,'host_state','MD','2015-05-26 16:31:31'),(43,'state_permission','write','2015-08-12 15:09:05'),(44,'EOP_type','internal','2015-07-21 14:01:13'),(46,'sys_preferences','{\"main\":{\"file_name\":\"uploaded_EOP_main_.docx\",\"file_type\":\"application\\/vnd.openxmlformats-officedocument.wordprocessingml.document\",\"file_path\":\"\\/Users\\/GMajwega\\/Sites\\/eop2.0\\/uploads\\/\",\"full_path\":\"\\/Users\\/GMajwega\\/Sites\\/eop2.0\\/uploads\\/uploaded_EOP_main_.docx\",\"raw_name\":\"uploaded_EOP_main_\",\"orig_name\":\"uploaded_EOP_main_.docx\",\"client_name\":\"EOP2.0 Timeline_.docx\",\"file_ext\":\".docx\",\"file_size\":12.89,\"is_image\":false,\"image_width\":\"\",\"image_height\":\"\",\"image_type\":\"\",\"image_size_str\":\"\",\"basic_plan_source\":\"external\"},\"cover\":{\"file_name\":\"uploaded_EOP_cover_.docx\",\"file_type\":\"application\\/vnd.openxmlformats-officedocument.wordprocessingml.document\",\"file_path\":\"\\/Users\\/GMajwega\\/Sites\\/eop2.0\\/uploads\\/\",\"full_path\":\"\\/Users\\/GMajwega\\/Sites\\/eop2.0\\/uploads\\/uploaded_EOP_cover_.docx\",\"raw_name\":\"uploaded_EOP_cover_\",\"orig_name\":\"uploaded_EOP_cover_.docx\",\"client_name\":\"Proposal for EOP ASSIST OY2 Updates.docx\",\"file_ext\":\".docx\",\"file_size\":83.49,\"is_image\":false,\"image_width\":\"\",\"image_height\":\"\",\"image_type\":\"\",\"image_size_str\":\"\",\"basic_plan_source\":\"external\"}}','2015-07-31 16:07:00');
/*!40000 ALTER TABLE `eop_registry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_role_permission`
--

DROP TABLE IF EXISTS `eop_role_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_role_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(32) DEFAULT NULL,
  `uid` int(32) DEFAULT NULL,
  `entity_id` int(32) DEFAULT NULL,
  `field_id` int(32) DEFAULT NULL,
  `permissions` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_role_permission`
--

LOCK TABLES `eop_role_permission` WRITE;
/*!40000 ALTER TABLE `eop_role_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `eop_role_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_school`
--

DROP TABLE IF EXISTS `eop_school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_id` int(32) NOT NULL DEFAULT '0',
  `state_val` varchar(8) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `screen_name` varchar(256) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `owner` int(32) DEFAULT NULL,
  `state_permission` varchar(45) DEFAULT 'deny',
  `sys_preferences` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2324328 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_school`
--

LOCK TABLES `eop_school` WRITE;
/*!40000 ALTER TABLE `eop_school` DISABLE KEYS */;
INSERT INTO `eop_school` VALUES (5,4,'MD','First School','School 1',NULL,'2015-05-21 11:13:09','2015-05-21 15:13:09',NULL,'write','{\"main\":{\"basic_plan_source\":\"external\"},\"cover\":{\"basic_plan_source\":\"external\"}}'),(6,0,'MD','ggg','gggggg',NULL,'2015-05-21 12:06:17','2015-05-21 16:06:17',NULL,'deny',NULL),(7,0,'MD','ssds','sdsdsds',NULL,'2015-05-21 12:50:14','2015-05-21 16:50:14',NULL,'deny',NULL),(8,4,'MD','dadadad','adasdad',NULL,'2015-05-21 14:25:44','2015-05-21 18:25:44',NULL,'deny',NULL),(9,0,'MD','cccccc223','ccccccc',NULL,'2015-05-21 14:58:01','2015-05-21 18:58:01',NULL,'deny',NULL),(10,4,'MD','kol','fffffff',NULL,'2015-05-21 15:09:06','2015-05-21 19:09:06',NULL,'deny',NULL),(11,5,'MD','hpoijpopo','hjhhjjhjh',NULL,'2015-05-21 16:09:47','2015-05-21 20:09:47',NULL,'deny',NULL),(12,4,'MD','goddie','gogino',NULL,'2015-05-22 10:14:08','2015-05-22 14:14:08',NULL,'deny','{\"basic_plan_source\":\"external\"}'),(13,0,'MD','Independent School','',NULL,'2015-05-22 15:15:28','2015-05-22 19:15:28',NULL,'deny',NULL),(14,0,'MD','My School','Me School',NULL,'2015-05-28 12:15:50','2015-05-28 16:15:50',17,'deny',NULL),(15,5,'MD','My School2','',NULL,'2015-05-28 12:16:09','2015-05-28 16:16:09',17,'deny','{\"basic_plan_source\":\"external\"}'),(16,0,'MD','independent School101','independent School101',NULL,'2015-07-24 15:08:14','2015-07-24 19:08:14',17,'deny',NULL),(17,4,'MD','sas','asasa',NULL,'2015-07-24 15:12:02','2015-07-24 19:12:02',17,'deny',NULL),(2324324,0,'MD','aasdfas','asdfasfa','afasf','2015-07-24 15:14:21','2015-07-24 19:14:21',26,NULL,NULL),(2324325,0,'MD','dsdfsafadfadf','sdfadfafasf',NULL,'2015-07-24 15:16:58','2015-07-24 19:16:58',17,'deny',NULL),(2324326,0,'MD','independent School104','independent School104',NULL,'2015-07-24 15:17:13','2015-07-24 19:17:13',17,'deny',NULL),(2324327,0,'MD','sdafasfd','afasfda',NULL,'2015-08-12 10:38:26','2015-08-12 14:38:26',17,'deny',NULL);
/*!40000 ALTER TABLE `eop_school` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_state`
--

DROP TABLE IF EXISTS `eop_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `val` varchar(8) NOT NULL,
  `name` varchar(64) NOT NULL,
  `screen_name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `val_UNIQUE` (`val`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_state`
--

LOCK TABLES `eop_state` WRITE;
/*!40000 ALTER TABLE `eop_state` DISABLE KEYS */;
INSERT INTO `eop_state` VALUES (2,'MD','Maryland','Maryland'),(3,'AL','Alabama','Alabama'),(4,'AK','Alaska','Alaska'),(5,'AZ','Arizona','Arizona'),(6,'AR','Arkansas','Arkansas'),(7,'CA','California','California'),(8,'CO','Colorado','Colorado'),(9,'CT','Connecticut','Connecticut'),(10,'DE','Delaware','Delaware'),(11,'DC','District Of Columbia','DC'),(12,'FL','Florida','Florida'),(13,'GA','Georgia','Georgia'),(14,'HI','Hawaii','Hawaii'),(15,'ID','Idaho','Idaho'),(16,'IL','Illinois','Illinois'),(17,'IN','Indiana','Indiana'),(18,'IA','Iowa','Iowa'),(19,'KS','Kansas','Kansas'),(20,'KY','Kentucky','Kentucky'),(21,'LA','Louisiana','Louisiana'),(22,'ME','Maine','Maine'),(24,'MA','Massachusetts','Massachusetts'),(25,'MI','Michigan','Michigan'),(26,'MN','Minnesota','Minnesota'),(27,'MS','Mississippi','Mississippi'),(28,'MO','Missouri','Missouri'),(29,'MT','Montana','Montana'),(30,'NE','Nebraska','Nebraska'),(31,'NV','Nevada','Nevada'),(32,'NH','New Hampshire','New Hampshire'),(33,'NJ','New Jersey','New Jersey'),(34,'NM','New Mexico','New Mexico'),(35,'NY','New York','New York'),(36,'NC','North Carolina','North Carolina'),(37,'ND','North Dakota','North Dakota'),(38,'OH','Ohio','Ohio'),(39,'OK','Oklahoma','Oklahoma'),(40,'OR','Oregon','Oregon'),(41,'PA','Pennsylvania','Pennsylvania'),(42,'RI','Rhode Island','Rhode Island'),(43,'SC','South Carolina','South Carolina'),(44,'SD','South Dakota','South Dakota'),(45,'TN','Tennessee','Tennessee'),(46,'TX','Texas','Texas'),(47,'UT','Utah','Utah'),(48,'VT','Vermont','Vermont'),(49,'VA','Virginia','Virginia'),(50,'WA','Washington','Washington'),(51,'WV','West Virginia','West Virginia'),(52,'WI','Wisconsin','Wisconsin'),(53,'WY','Wyoming','Wyoming');
/*!40000 ALTER TABLE `eop_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_team`
--

DROP TABLE IF EXISTS `eop_team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `interest` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `owner` int(32) NOT NULL,
  `sid` int(32) DEFAULT NULL,
  `did` int(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_team`
--

LOCK TABLES `eop_team` WRITE;
/*!40000 ALTER TABLE `eop_team` DISABLE KEYS */;
INSERT INTO `eop_team` VALUES (6,'Godfrey Majwega2','ada55','afasfa55','adsfaf@dss','240-705-6739','School District/LEA, School Community, Local Community Partner, State Department of Education/SEA','2015-06-02 20:41:28','2015-06-02 16:41:28',29,5,4),(8,'asdfadfdd','asdfsaf','asdfa','asdfkjla@ada.com','240-705-6739','School District/LEA, State Department of Education/SEA, Additional Partner','2015-06-19 17:52:52','2015-06-19 13:52:52',17,NULL,NULL),(9,'twet','etw','wetw','wewer@rer','240-705-6739','School District/LEA, Local Community Partner, State Community Partner','2015-07-06 20:34:53','2015-07-06 16:34:53',29,8,4),(12,'aaasD','aaa','aaa','aaaaa@sa','','School Community, Diverse Interests of Whole School Community','2015-07-30 15:59:41','2015-07-30 11:59:41',17,5,4),(13,'52aaa','aaa','aaaa','adsfaf@dss','','Diverse Interests of Whole School Community','2015-07-30 16:00:06','2015-07-30 12:00:06',17,5,4);
/*!40000 ALTER TABLE `eop_team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_user`
--

DROP TABLE IF EXISTS `eop_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `first_name` varchar(96) DEFAULT NULL,
  `last_name` varchar(96) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `status` varchar(24) DEFAULT NULL COMMENT 'active\nblocked',
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `read_only` char(1) DEFAULT 'n',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_user`
--

LOCK TABLES `eop_user` WRITE;
/*!40000 ALTER TABLE `eop_user` DISABLE KEYS */;
INSERT INTO `eop_user` VALUES (17,1,'Supers','Administrator','majregor@glydenet.comp','admin','7ce8bcd42b1efa29518674ec4a99fa60','2407056732','active','2015-05-20 00:21:11','2015-08-12 19:12:22','n'),(26,4,'School','Administrator','darius.f.yaghoubi@nasa.gov','schooladmin','980ac217c6b51e7dc41040bec1edfec8','2407056739','active','2015-05-21 11:21:50',NULL,'n'),(27,5,'School','User','qqq@ss.comm','schooluser','7ce8bcd42b1efa29518674ec4a99fa60','2407056739','active','2015-05-21 12:17:49','2015-08-06 17:22:08','n'),(28,4,'School','User2','dsdsd@aa.com','schooluser2','0b4e7a0e5fe84ad35fb5f95b9ceeac79','2407056739','active','2015-05-21 12:38:58',NULL,'n'),(29,3,'District22','Administrators','sasasas@sss.comopop','distadmin','128e61891b7bf0cfafbbc589a65ce5f6','2407056739','active','2015-05-21 12:42:35',NULL,'n'),(31,4,'adafaf','asasf','asasasas@sss.com','majregor','343b1c4a3ea721b2d640fc8700db0f36','2342342','active','2015-05-21 15:26:55','2015-08-06 16:52:26','y'),(32,5,'Schoolnn','User','fhfgh@ddd.c','schooluser1','128e61891b7bf0cfafbbc589a65ce5f6','2407056739','active','2015-05-21 15:33:18',NULL,'n'),(33,2,'State','Administrator','bgds@dd.com','sadmin','128e61891b7bf0cfafbbc589a65ce5f6','2407056739','active','2015-05-21 15:37:27',NULL,'n'),(34,3,'bvvb','vbvb','svb@ss.c','vbb','128e61891b7bf0cfafbbc589a65ce5f6','2407056739','active','2015-05-21 15:52:23',NULL,'y'),(35,1,'Super','Administrator','adminss@ss.com','admin3','0192023a7bbd73250516f069df18b500','','active','2015-05-22 10:31:19',NULL,'n'),(36,1,'Super','Administrator','drerer@dd.com','admin4','7ce8bcd42b1efa29518674ec4a99fa60','','active','2015-05-22 10:41:19',NULL,'n'),(37,3,'sdfafs','afafafa','asfdsaf@dsd','admins','0b4e7a0e5fe84ad35fb5f95b9ceeac79','2407056739','active','2015-05-22 12:40:49',NULL,'n'),(38,1,'Super','Administrator','asaklk@sdsd.com','superadmin','128e61891b7bf0cfafbbc589a65ce5f6','','active','2015-05-26 10:18:48',NULL,'n'),(39,1,'Super','Administrator','asDSA@sa.com','adminsss','128e61891b7bf0cfafbbc589a65ce5f6','','active','2015-05-26 12:31:31',NULL,'n'),(40,3,'Godd','Freyy','adasf@dd.com','goddfree','7ce8bcd42b1efa29518674ec4a99fa60','2407056733','active','2015-05-28 10:06:23',NULL,'n'),(41,3,'Goddino222','Number 2','asdfa@erer.com','goddino2','0b4e7a0e5fe84ad35fb5f95b9ceeac79','','active','2015-05-28 10:34:31',NULL,'n'),(42,3,'june','user1','asfa@sds.com','juneuser','af15d5fdacd5fdfea300e88a8e253e82','12312312233','active','2015-06-01 17:09:08',NULL,'n'),(43,3,'user','June1','adfas@ere.com','juneuser2','0b4e7a0e5fe84ad35fb5f95b9ceeac79','12356709873','active','2015-06-01 17:15:38',NULL,'n'),(44,3,'June','User3','user2@macomen.com','juneuserpp','af15d5fdacd5fdfea300e88a8e253e82','2407056739','active','2015-06-01 17:22:10',NULL,'n'),(45,3,'june','user4','asdf@gr.com','juneuser5','af15d5fdacd5fdfea300e88a8e253e82','2407056739','active','2015-06-01 17:23:22',NULL,'n'),(46,3,'junedd','user6','user6@hotmail.com','juneuser6','0b4e7a0e5fe84ad35fb5f95b9ceeac79','12323489673','active','2015-06-01 17:31:22',NULL,'n'),(47,5,'junes','user7','user7@hotmail.com','user7','7ce8bcd42b1efa29518674ec4a99fa60','2407056739','active','2015-06-01 17:32:39',NULL,'y'),(48,2,'wfasfa','afafa','adf@esds','sadmin234','128e61891b7bf0cfafbbc589a65ce5f6','2407056739','active','2015-07-08 12:31:17',NULL,'n'),(49,4,'afasfa','asfasfd','asdfa@erer.comss','scasasad','128e61891b7bf0cfafbbc589a65ce5f6','','active','2015-07-14 15:19:59','2015-08-11 18:35:35','n'),(50,4,'klsdfsalkfdsa;ld;l','la;skjf;lasjdfa;l','lksfdlakjf@al.com','alkjhfaskjfa','e10adc3949ba59abbe56e057f20f883e','','active','2015-07-14 15:46:23',NULL,'n'),(51,5,'School User341','2121','schooluser342@glydenet.com','schooluser234','e10adc3949ba59abbe56e057f20f883e','2407056739','active','2015-07-14 15:48:13',NULL,'n'),(52,5,'kreated','School User','asdfa@erer.comsss','kreated','e10adc3949ba59abbe56e057f20f883e','','active','2015-07-24 11:53:18',NULL,'n');
/*!40000 ALTER TABLE `eop_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_user2district`
--

DROP TABLE IF EXISTS `eop_user2district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_user2district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(32) DEFAULT NULL,
  `did` int(32) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_user2district`
--

LOCK TABLES `eop_user2district` WRITE;
/*!40000 ALTER TABLE `eop_user2district` DISABLE KEYS */;
INSERT INTO `eop_user2district` VALUES (7,31,4,'2015-05-21 19:26:55'),(8,32,4,'2015-05-21 19:33:18'),(9,37,4,'2015-05-22 16:40:50'),(10,41,5,'2015-05-28 14:34:31'),(11,42,4,'2015-06-01 21:09:09'),(12,43,4,'2015-06-01 21:15:38'),(13,44,4,'2015-06-01 21:22:10'),(14,45,5,'2015-06-01 21:23:22'),(15,46,4,'2015-06-01 21:31:22'),(16,47,4,'2015-06-01 21:32:39'),(17,49,4,'2015-07-14 19:19:59'),(18,40,5,'2015-07-22 17:12:04'),(19,34,5,'2015-07-22 17:12:21'),(20,29,4,'2015-07-22 17:33:22');
/*!40000 ALTER TABLE `eop_user2district` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_user2school`
--

DROP TABLE IF EXISTS `eop_user2school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_user2school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(32) DEFAULT NULL,
  `sid` int(32) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_user2school`
--

LOCK TABLES `eop_user2school` WRITE;
/*!40000 ALTER TABLE `eop_user2school` DISABLE KEYS */;
INSERT INTO `eop_user2school` VALUES (4,26,5,'2015-05-21 15:21:50'),(5,27,5,'2015-05-21 16:17:49'),(6,28,5,'2015-05-21 16:38:58'),(10,31,5,'2015-05-21 19:26:55'),(11,32,5,'2015-05-21 19:33:18'),(16,42,5,'2015-06-01 21:09:09'),(17,43,5,'2015-06-01 21:15:38'),(18,44,5,'2015-06-01 21:22:10'),(19,47,8,'2015-06-01 21:32:39'),(20,49,5,'2015-07-14 19:19:59'),(21,50,5,'2015-07-14 19:46:23'),(22,51,5,'2015-07-14 19:48:13'),(24,52,5,'2015-07-24 15:53:19');
/*!40000 ALTER TABLE `eop_user2school` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_user_access`
--

DROP TABLE IF EXISTS `eop_user_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_user_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(32) DEFAULT NULL,
  `entity_id` int(32) DEFAULT NULL,
  `field_id` int(32) DEFAULT NULL,
  `permissions` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_user_access`
--

LOCK TABLES `eop_user_access` WRITE;
/*!40000 ALTER TABLE `eop_user_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `eop_user_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_user_roles`
--

DROP TABLE IF EXISTS `eop_user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_user_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT 'Super Admin\nState Administrator\nDistrict Administrator\nSchool Administrator\nSchool User\nUser\nAnonymous',
  `screen_name` varchar(32) DEFAULT NULL,
  `description` text,
  `is_locked` char(1) NOT NULL DEFAULT 'n',
  `can_view` char(1) NOT NULL DEFAULT 'y',
  `can_edit` char(1) NOT NULL DEFAULT 'y',
  `create_district` char(1) DEFAULT 'n',
  `edit_district` char(1) DEFAULT 'n',
  `create_school` char(1) DEFAULT 'n',
  `edit_school` char(1) DEFAULT 'n',
  `create_user` char(1) DEFAULT 'y',
  `edit_user` char(1) DEFAULT 'y',
  `alter_state_access` char(1) DEFAULT 'n',
  `edit_entity` char(1) DEFAULT 'y',
  `level` int(8) DEFAULT NULL COMMENT '1 - super admin\n2 - state admin\n3 - district admin\n4 - school admin\n5 - school user',
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_user_roles`
--

LOCK TABLES `eop_user_roles` WRITE;
/*!40000 ALTER TABLE `eop_user_roles` DISABLE KEYS */;
INSERT INTO `eop_user_roles` VALUES (1,'Super Admin',NULL,'Super Administrator','n','y','y','y','y','n','n','y','y','y','y',1),(2,'State Administrator',NULL,'State Administrator','n','y','y','y','y','n','n','y','y','y','y',2),(3,'District Administrator',NULL,'District Administrator','n','y','y','n','n','n','n','y','y','y','y',3),(4,'School Administrator',NULL,'School Administrator','n','y','y','n','n','n','n','y','y','y','y',4),(5,'School User',NULL,'School User','n','y','y','n','n','n','n','y','y','n','y',5);
/*!40000 ALTER TABLE `eop_user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `eop_view_entities`
--

DROP TABLE IF EXISTS `eop_view_entities`;
/*!50001 DROP VIEW IF EXISTS `eop_view_entities`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `eop_view_entities` AS SELECT 
 1 AS `id`,
 1 AS `type_id`,
 1 AS `sid`,
 1 AS `name`,
 1 AS `title`,
 1 AS `owner`,
 1 AS `parent`,
 1 AS `weight`,
 1 AS `created`,
 1 AS `timestamp`,
 1 AS `description`,
 1 AS `type`,
 1 AS `type_title`,
 1 AS `school`,
 1 AS `school screen name`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `eop_view_school`
--

DROP TABLE IF EXISTS `eop_view_school`;
/*!50001 DROP VIEW IF EXISTS `eop_view_school`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `eop_view_school` AS SELECT 
 1 AS `id`,
 1 AS `district_id`,
 1 AS `state_val`,
 1 AS `name`,
 1 AS `screen_name`,
 1 AS `description`,
 1 AS `created_date`,
 1 AS `modified_date`,
 1 AS `preferences`,
 1 AS `owner`,
 1 AS `state_permission`,
 1 AS `district`,
 1 AS `district_screen_name`,
 1 AS `state`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `eop_view_school_user`
--

DROP TABLE IF EXISTS `eop_view_school_user`;
/*!50001 DROP VIEW IF EXISTS `eop_view_school_user`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `eop_view_school_user` AS SELECT 
 1 AS `user_id`,
 1 AS `school`,
 1 AS `school_id`,
 1 AS `district_id`,
 1 AS `district`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `eop_view_user`
--

DROP TABLE IF EXISTS `eop_view_user`;
/*!50001 DROP VIEW IF EXISTS `eop_view_user`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `eop_view_user` AS SELECT 
 1 AS `user_id`,
 1 AS `role_id`,
 1 AS `first_name`,
 1 AS `last_name`,
 1 AS `email`,
 1 AS `username`,
 1 AS `password`,
 1 AS `phone`,
 1 AS `status`,
 1 AS `join_date`,
 1 AS `modified`,
 1 AS `read_only`,
 1 AS `role`,
 1 AS `school`,
 1 AS `school_id`,
 1 AS `district_id`,
 1 AS `district`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `column1` varchar(64) DEFAULT NULL,
  `column2` varchar(96) DEFAULT NULL,
  `column3` varchar(96) DEFAULT NULL,
  `column4` varchar(96) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `eop_view_entities`
--

/*!50001 DROP VIEW IF EXISTS `eop_view_entities`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `eop_view_entities` AS select `A`.`id` AS `id`,`A`.`type_id` AS `type_id`,`A`.`sid` AS `sid`,`A`.`name` AS `name`,`A`.`title` AS `title`,`A`.`owner` AS `owner`,`A`.`parent` AS `parent`,`A`.`weight` AS `weight`,`A`.`created` AS `created`,`A`.`timestamp` AS `timestamp`,`A`.`description` AS `description`,`B`.`name` AS `type`,`B`.`title` AS `type_title`,`C`.`name` AS `school`,`C`.`screen_name` AS `school screen name` from ((`eop_entity` `A` left join `eop_entity_types` `B` on((`A`.`type_id` = `B`.`id`))) left join `eop_school` `C` on((`A`.`sid` = `C`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `eop_view_school`
--

/*!50001 DROP VIEW IF EXISTS `eop_view_school`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `eop_view_school` AS select `A`.`id` AS `id`,`A`.`district_id` AS `district_id`,`A`.`state_val` AS `state_val`,`A`.`name` AS `name`,`A`.`screen_name` AS `screen_name`,`A`.`description` AS `description`,`A`.`created_date` AS `created_date`,`A`.`modified_date` AS `modified_date`,`A`.`sys_preferences` AS `preferences`,`A`.`owner` AS `owner`,`A`.`state_permission` AS `state_permission`,`B`.`name` AS `district`,`B`.`screen_name` AS `district_screen_name`,`C`.`name` AS `state` from ((`eop_school` `A` left join `eop_district` `B` on((`A`.`district_id` = `B`.`id`))) left join `eop_state` `C` on((`A`.`state_val` = `C`.`val`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `eop_view_school_user`
--

/*!50001 DROP VIEW IF EXISTS `eop_view_school_user`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `eop_view_school_user` AS select `A`.`user_id` AS `user_id`,`D`.`name` AS `school`,`D`.`id` AS `school_id`,`F`.`id` AS `district_id`,`F`.`name` AS `district` from ((((`eop_user` `A` join `eop_user_roles` `B` on((`A`.`role_id` = `B`.`role_id`))) left join `eop_user2school` `C` on((`A`.`user_id` = `C`.`uid`))) left join `eop_school` `D` on((`C`.`sid` = `D`.`id`))) left join `eop_district` `F` on((`D`.`district_id` = `F`.`id`))) where (`A`.`role_id` >= 4) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `eop_view_user`
--

/*!50001 DROP VIEW IF EXISTS `eop_view_user`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `eop_view_user` AS select `A`.`user_id` AS `user_id`,`A`.`role_id` AS `role_id`,`A`.`first_name` AS `first_name`,`A`.`last_name` AS `last_name`,`A`.`email` AS `email`,`A`.`username` AS `username`,`A`.`password` AS `password`,`A`.`phone` AS `phone`,`A`.`status` AS `status`,`A`.`join_date` AS `join_date`,`A`.`modified` AS `modified`,`A`.`read_only` AS `read_only`,`B`.`title` AS `role`,`D`.`name` AS `school`,`D`.`id` AS `school_id`,`F`.`id` AS `district_id`,`F`.`name` AS `district` from (((((`eop_user` `A` join `eop_user_roles` `B` on((`A`.`role_id` = `B`.`role_id`))) left join `eop_user2school` `C` on((`A`.`user_id` = `C`.`uid`))) left join `eop_school` `D` on((`C`.`sid` = `D`.`id`))) left join `eop_user2district` `E` on((`A`.`user_id` = `E`.`uid`))) left join `eop_district` `F` on((`E`.`did` = `F`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-12 17:46:07
