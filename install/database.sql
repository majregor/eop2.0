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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_calendar`
--

LOCK TABLES `eop_calendar` WRITE;
/*!40000 ALTER TABLE `eop_calendar` DISABLE KEYS */;
INSERT INTO `eop_calendar` VALUES (6,'asasa','','2015-07-15T00:00:00-04:00','2015-07-15T00:00:00-04:00','',17,'2015-07-15 09:26:48',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(7,'','','2015-07-09T00:00:00-04:00','2015-07-09T00:00:00-04:00','',17,'2015-07-15 09:39:19',0,NULL,NULL,0,0,0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_district`
--

LOCK TABLES `eop_district` WRITE;
/*!40000 ALTER TABLE `eop_district` DISABLE KEYS */;
INSERT INTO `eop_district` VALUES (4,'Frst Districts3','First Districts',NULL,'MD','2015-05-21 15:12:47',NULL,'deny'),(5,'uiyuioyiuy','jfjhgfj',NULL,'MD','2015-05-21 20:09:16',NULL,'deny');
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
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(128) DEFAULT NULL COMMENT 'live\noffline',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_entity`
--

LOCK TABLES `eop_entity` WRITE;
/*!40000 ALTER TABLE `eop_entity` DISABLE KEYS */;
INSERT INTO `eop_entity` VALUES (8,2,NULL,'Communications and Warning',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(9,2,NULL,'Evacuation',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(10,2,NULL,'Shelter-in-Place',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(11,2,NULL,'Lockdown',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(12,2,NULL,'Accounting for All Persons',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(13,2,NULL,'Family Reunification',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(14,2,NULL,'Continuity of Operations (COOP)',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(15,2,NULL,'Security',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(17,2,NULL,'Public Health, Medical, and Mental Health',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(18,2,NULL,'None',NULL,17,NULL,NULL,'2015-06-17 11:48:55','2015-06-17 19:48:55',NULL),(20,2,NULL,'Recovery',NULL,17,NULL,NULL,'2015-06-17 12:04:35','2015-06-17 20:04:35',NULL),(21,3,NULL,'TH1','TH1',17,NULL,NULL,'2015-07-06 10:32:27','2015-07-06 14:32:27','live'),(22,4,NULL,'Goal 1','Goal 1 (Before)',17,21,1,'2015-07-06 10:32:27','2015-07-06 14:32:27',NULL),(23,7,NULL,'Goal 1 Objective','Objective',17,22,0,'2015-07-06 10:32:27','2015-07-06 14:32:27',NULL),(24,8,NULL,'Goal 1 Course of Action','Course of Action',17,22,0,'2015-07-06 10:32:27','2015-07-06 14:32:27',NULL),(25,5,NULL,'Goal 2','Goal 2 (During)',17,21,2,'2015-07-06 10:32:27','2015-07-06 14:32:27',NULL),(26,7,NULL,'Goal 2 Objective','Objective',17,25,1,'2015-07-06 10:32:27','2015-07-06 14:32:27',NULL),(27,8,NULL,'Goal 2 Course of Action','Course of Action',17,25,1,'2015-07-06 10:32:27','2015-07-06 14:32:27',NULL),(28,6,NULL,'Goal 3','Goal 3 (After)',17,21,3,'2015-07-06 10:32:27','2015-07-06 14:32:27',NULL),(29,7,NULL,'Goal 3 Objective','Objective',17,28,2,'2015-07-06 10:32:27','2015-07-06 14:32:27',NULL),(30,8,NULL,'Goal 3 Course of Action','Course of Action',17,28,2,'2015-07-06 10:32:27','2015-07-06 14:32:27',NULL),(31,2,NULL,'Communications and Warning','Communications and Warning',17,22,NULL,'2015-07-06 10:33:18','2015-07-06 14:33:18',NULL),(32,2,NULL,'Public Health, Medical, and Mental Health','Public Health, Medical, and Mental Health',17,25,NULL,'2015-07-06 10:33:18','2015-07-06 14:33:18',NULL),(33,2,NULL,'Family Reunification','Family Reunification',17,28,NULL,'2015-07-06 10:33:18','2015-07-06 14:33:18',NULL),(34,2,NULL,'Family Reunification','Family Reunification',17,23,NULL,'2015-07-06 10:33:18','2015-07-06 14:33:18',NULL),(35,2,NULL,'Public Health, Medical, and Mental Health','Public Health, Medical, and Mental Health',17,26,NULL,'2015-07-06 10:33:18','2015-07-06 14:33:18',NULL),(36,2,NULL,'Recovery','Recovery',17,29,NULL,'2015-07-06 10:33:18','2015-07-06 14:33:18',NULL),(37,7,NULL,'Goal 3 Objective','Objective',17,22,2,'2015-07-06 10:33:48','2015-07-06 14:33:48',NULL),(38,2,NULL,'Evacuation','Evacuation',17,37,NULL,'2015-07-06 10:33:48','2015-07-06 14:33:48',NULL),(39,7,NULL,'Goal 3 Objective','Objective',17,22,2,'2015-07-06 10:36:20','2015-07-06 14:36:20',NULL),(40,2,NULL,'Family Reunification','Family Reunification',17,39,NULL,'2015-07-06 10:36:20','2015-07-06 14:36:20',NULL),(41,7,NULL,'Goal 3 Objective','Objective',17,28,2,'2015-07-06 10:38:33','2015-07-06 14:38:33',NULL),(42,2,NULL,'Security','Security',17,41,NULL,'2015-07-06 10:38:33','2015-07-06 14:38:33',NULL),(43,4,NULL,'Goal 1','Goal 1 (Before)',17,8,1,'2015-07-06 10:55:11','2015-07-06 14:55:11',NULL),(44,7,NULL,'Goal 1 Objective','Objective',17,43,1,'2015-07-06 10:55:11','2015-07-06 14:55:11',NULL),(45,7,NULL,'Goal 1 Objective','Objective',17,43,2,'2015-07-06 10:55:11','2015-07-06 14:55:11',NULL),(46,5,NULL,'Goal 2','Goal 2 (Before)',17,8,1,'2015-07-06 10:55:11','2015-07-06 14:55:11',NULL),(47,7,NULL,'Goal 2 Objective','Objective',17,46,1,'2015-07-06 10:55:11','2015-07-06 14:55:11',NULL),(48,6,NULL,'Goal 3','Goal 3 (Before)',17,8,1,'2015-07-06 10:55:11','2015-07-06 14:55:11',NULL),(49,7,NULL,'Goal 3 Objective','Objective',17,48,1,'2015-07-06 10:55:11','2015-07-06 14:55:11',NULL),(50,4,NULL,'Goal 1','Goal 1 (Before)',17,9,1,'2015-07-06 11:00:09','2015-07-06 15:00:09',NULL),(51,7,NULL,'Goal 1 Objective','Objective',17,50,1,'2015-07-06 11:00:09','2015-07-06 15:00:09',NULL),(52,5,NULL,'Goal 2','Goal 2 (Before)',17,9,1,'2015-07-06 11:00:09','2015-07-06 15:00:09',NULL),(53,7,NULL,'Goal 2 Objective','Objective',17,52,1,'2015-07-06 11:00:09','2015-07-06 15:00:09',NULL),(54,6,NULL,'Goal 3','Goal 3 (Before)',17,9,1,'2015-07-06 11:00:09','2015-07-06 15:00:09',NULL),(55,7,NULL,'Goal 3 Objective','Objective',17,54,1,'2015-07-06 11:00:09','2015-07-06 15:00:09',NULL),(56,8,NULL,'Goal 1 Course of Action','Course of Action',17,43,0,'2015-07-06 11:11:31','2015-07-06 15:11:31',NULL),(57,8,NULL,'Goal 2 Course of Action','Course of Action',17,46,1,'2015-07-06 11:11:31','2015-07-06 15:11:31',NULL),(58,8,NULL,'Goal 3 Course of Action','Course of Action',17,48,2,'2015-07-06 11:11:31','2015-07-06 15:11:31',NULL),(59,1,NULL,'form1','Introductory Material',17,NULL,1,'2015-07-06 11:19:20','2015-07-06 15:19:20',NULL),(60,1,NULL,'1.0','Cover Page',17,59,1,'2015-07-06 11:19:20','2015-07-06 15:19:20',NULL),(61,1,NULL,'1.1','Promulgation Document and Signatures',17,59,2,'2015-07-06 11:19:20','2015-07-06 15:19:20',NULL),(62,1,9,'1.2','Approval and Implementation',17,59,3,'2015-07-06 11:19:20','2015-07-06 15:19:20',NULL),(63,1,9,'1.3','Record of Changes',17,59,3,'2015-07-06 11:19:20','2015-07-06 15:19:20',NULL),(64,1,9,'1.4','Record of Distribution',17,59,4,'2015-07-06 11:19:20','2015-07-06 15:19:20',NULL),(65,3,8,'TH2','TH2',29,NULL,NULL,'2015-07-06 15:28:23','2015-07-06 19:28:23','live'),(66,4,8,'Goal 1','Goal 1 (Before)',29,65,1,'2015-07-06 15:28:23','2015-07-06 19:28:23',NULL),(67,7,8,'Goal 1 Objective','Objective',29,66,0,'2015-07-06 15:28:23','2015-07-06 19:28:23',NULL),(68,8,8,'Goal 1 Course of Action','Course of Action',29,66,0,'2015-07-06 15:28:23','2015-07-06 19:28:23',NULL),(69,5,8,'Goal 2','Goal 2 (During)',29,65,2,'2015-07-06 15:28:23','2015-07-06 19:28:23',NULL),(70,7,8,'Goal 2 Objective','Objective',29,69,1,'2015-07-06 15:28:23','2015-07-06 19:28:23',NULL),(71,8,8,'Goal 2 Course of Action','Course of Action',29,69,1,'2015-07-06 15:28:23','2015-07-06 19:28:23',NULL),(72,6,8,'Goal 3','Goal 3 (After)',29,65,3,'2015-07-06 15:28:23','2015-07-06 19:28:23',NULL),(73,7,8,'Goal 3 Objective','Objective',29,72,2,'2015-07-06 15:28:23','2015-07-06 19:28:23',NULL),(74,8,8,'Goal 3 Course of Action','Course of Action',29,72,2,'2015-07-06 15:28:23','2015-07-06 19:28:23',NULL),(75,2,8,'Evacuation','Evacuation',29,66,NULL,'2015-07-06 15:31:08','2015-07-06 19:31:08',NULL),(76,2,8,'Recovery','Recovery',29,69,NULL,'2015-07-06 15:31:08','2015-07-06 19:31:08',NULL),(77,2,8,'Family Reunification','Family Reunification',29,72,NULL,'2015-07-06 15:31:08','2015-07-06 19:31:08',NULL),(78,2,8,'Evacuation','Evacuation',29,67,NULL,'2015-07-06 15:31:08','2015-07-06 19:31:08',NULL),(79,2,8,'Communications and Warning','Communications and Warning',29,70,NULL,'2015-07-06 15:31:08','2015-07-06 19:31:08',NULL),(80,2,8,'Accounting for All Persons','Accounting for All Persons',29,73,NULL,'2015-07-06 15:31:08','2015-07-06 19:31:08',NULL),(81,7,8,'Goal 3 Objective','Objective',29,72,2,'2015-07-06 15:31:08','2015-07-06 19:31:08',NULL),(82,2,8,'Continuity of Operations (COOP)','Continuity of Operations (COOP)',29,81,NULL,'2015-07-06 15:31:08','2015-07-06 19:31:08',NULL),(83,7,8,'Goal 3 Objective','Objective',29,72,3,'2015-07-06 15:31:08','2015-07-06 19:31:08',NULL),(84,2,8,'Recovery','Recovery',29,83,NULL,'2015-07-06 15:31:08','2015-07-06 19:31:08',NULL),(85,7,8,'Goal 3 Objective','Objective',29,72,4,'2015-07-06 15:31:08','2015-07-06 19:31:08',NULL),(86,2,8,'Shelter-in-Place','Shelter-in-Place',29,85,NULL,'2015-07-06 15:31:08','2015-07-06 19:31:08',NULL),(87,4,8,'Goal 1','Goal 1 (Before)',29,80,1,'2015-07-06 15:35:22','2015-07-06 19:35:22',NULL),(88,7,8,'Goal 1 Objective','Objective',29,87,1,'2015-07-06 15:35:22','2015-07-06 19:35:22',NULL),(89,5,8,'Goal 2','Goal 2 (Before)',29,80,1,'2015-07-06 15:35:22','2015-07-06 19:35:22',NULL),(90,7,8,'Goal 2 Objective','Objective',29,89,1,'2015-07-06 15:35:22','2015-07-06 19:35:22',NULL),(91,6,8,'Goal 3','Goal 3 (Before)',29,80,1,'2015-07-06 15:35:22','2015-07-06 19:35:22',NULL),(92,7,8,'Goal 3 Objective','Objective',29,91,1,'2015-07-06 15:35:22','2015-07-06 19:35:22',NULL),(93,2,NULL,'newfn','newfn',17,NULL,NULL,'2015-07-09 10:01:02','2015-07-09 14:01:02',NULL),(94,2,NULL,'newfnl','newfnl',17,NULL,NULL,'2015-07-09 10:07:49','2015-07-09 14:07:49',NULL),(95,1,NULL,'form2','Purpose, Scope, Situation Overview, and Assumptions',17,NULL,1,'2015-07-09 10:24:30','2015-07-09 14:24:30',NULL),(96,1,NULL,'2.1','Purpose',17,95,1,'2015-07-09 10:24:30','2015-07-09 14:24:30',NULL),(97,1,NULL,'2.2','Scope',17,95,2,'2015-07-09 10:24:30','2015-07-09 14:24:30',NULL),(98,1,NULL,'2.3','Situation Overview',17,95,3,'2015-07-09 10:24:30','2015-07-09 14:24:30',NULL),(99,1,NULL,'2.4','Planning Assumptions',17,95,3,'2015-07-09 10:24:30','2015-07-09 14:24:30',NULL),(100,1,NULL,'form8','Administration, Finance, and Logistics',17,NULL,1,'2015-07-13 11:16:26','2015-07-13 15:16:26',NULL),(101,1,NULL,'8.1','Administration, Finance, and Logistics',17,100,1,'2015-07-13 11:16:27','2015-07-13 15:16:27',NULL),(102,7,NULL,'Goal 1 Objective','Objective',17,22,4,'2015-07-13 12:25:25','2015-07-13 16:25:25',NULL),(103,2,NULL,'Lockdown','Lockdown',17,102,NULL,'2015-07-13 12:25:25','2015-07-13 16:25:25',NULL),(104,7,NULL,'Goal 1 Objective','Objective',17,22,5,'2015-07-13 12:25:25','2015-07-13 16:25:25',NULL),(105,2,NULL,'Continuity of Operations (COOP)','Continuity of Operations (COOP)',17,104,NULL,'2015-07-13 12:25:25','2015-07-13 16:25:25',NULL),(106,7,NULL,'Goal 1 Objective','Objective',17,22,6,'2015-07-13 12:25:25','2015-07-13 16:25:25',NULL),(107,2,NULL,'Public Health, Medical, and Mental Health','Public Health, Medical, and Mental Health',17,106,NULL,'2015-07-13 12:25:25','2015-07-13 16:25:25',NULL),(108,2,NULL,'jooj','jooj',17,NULL,NULL,'2015-07-13 17:13:41','2015-07-13 21:13:41',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_entity_types`
--

LOCK TABLES `eop_entity_types` WRITE;
/*!40000 ALTER TABLE `eop_entity_types` DISABLE KEYS */;
INSERT INTO `eop_entity_types` VALUES (1,'bp','Basic Plan'),(2,'fn','Functional Annex'),(3,'th','Threat- and Hazard-Specific Annex'),(4,'g1','Goal1 (Before)'),(5,'g2','Goal2 (During)'),(6,'g3','Goal3 (After)'),(7,'obj','Objective'),(8,'ca','Course of Action');
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
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(45) DEFAULT NULL,
  `body` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_field`
--

LOCK TABLES `eop_field` WRITE;
/*!40000 ALTER TABLE `eop_field` DISABLE KEYS */;
INSERT INTO `eop_field` VALUES (1,22,'Goal 1 Field','Goal 1 Field',1,'2015-07-06 10:32:27','2015-07-06 14:32:27','text','<p>afsdaf</p>\n'),(2,23,'Goal 1 Objective Field','Goal 1 Objective Field',1,'2015-07-06 10:32:27','2015-07-06 14:32:27','text','<p>asdfsaf</p>\n'),(3,24,'Goal 1 TH Course of Action Field','Goal 1 TH Course of Action Field',1,'2015-07-06 10:32:27','2015-07-06 14:32:27','text','<p>aafasfafd</p>\n'),(4,25,'Goal 2 Field','Goal 2 Field',1,'2015-07-06 10:32:27','2015-07-06 14:32:27','text','<p>asdfasdfa</p>\n'),(5,26,'Goal 2 Objective Field','Goal 2 Objective Field',1,'2015-07-06 10:32:27','2015-07-06 14:32:27','text','<p>asdfaf</p>\n'),(6,27,'Goal 2 TH Course of Action Field','Goal 2 TH Course of Action Field',1,'2015-07-06 10:32:27','2015-07-06 14:32:27','text','<p>asfsafda</p>\n'),(7,28,'Goal 3 Field','Goal 3 Field',1,'2015-07-06 10:32:27','2015-07-06 14:32:27','text','<p>sadfsafa</p>\n'),(8,29,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-07-06 10:32:27','2015-07-06 14:32:27','text','<p>safasdfadf</p>\n'),(9,30,'Goal 3 TH Course of Action Field','Goal 3 TH Course of Action Field',1,'2015-07-06 10:32:27','2015-07-06 14:32:27','text','<p>safasdf sdsd</p>\n'),(10,21,'TH Field','Threats and Hazards Default Field',1,'2015-07-06 10:33:18','2015-07-06 14:33:18','text',''),(11,37,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-07-06 10:33:48','2015-07-06 14:33:48','text','<p>sddfasdfdsfdfasdasf</p>\n'),(12,39,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-07-06 10:36:20','2015-07-06 14:36:20','text','<p>fdgsdgsd gs Majwega</p>\n'),(13,41,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-07-06 10:38:33','2015-07-06 14:38:33','text','<p>asfasdf as fas a f</p>\n'),(14,43,'Goal 1 Function Field','Goal 1 Function Field',1,'2015-07-06 10:55:11','2015-07-06 14:55:11','text','<p>afasdfa</p>\n'),(15,44,'Goal 1 Objective Field','Goal 1 Objective Field',1,'2015-07-06 10:55:11','2015-07-06 14:55:11','text','<p>sfasfad</p>\n'),(16,45,'Goal 1 Objective Field','Goal 1 Objective Field',1,'2015-07-06 10:55:11','2015-07-06 14:55:11','text','<p>safasfdaf polo polo</p>\n'),(17,46,'Goal 2 Function Field','Goal 2 Function Field',1,'2015-07-06 10:55:11','2015-07-06 14:55:11','text','<p>safsadf</p>\n'),(18,47,'Goal 2 Objective Field','Goal 2 Objective Field',1,'2015-07-06 10:55:11','2015-07-06 14:55:11','text','<p>asfa</p>\n'),(19,48,'Goal 3 Function Field','Goal 3 Function Field',1,'2015-07-06 10:55:11','2015-07-06 14:55:11','text','<p>asfasf</p>\n'),(20,49,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-07-06 10:55:11','2015-07-06 14:55:11','text','<p>sfasfa</p>\n'),(21,50,'Goal 1 Function Field','Goal 1 Function Field',1,'2015-07-06 11:00:09','2015-07-06 15:00:09','text','<p>sdfas</p>\n'),(22,51,'Goal 1 Objective Field','Goal 1 Objective Field',1,'2015-07-06 11:00:09','2015-07-06 15:00:09','text','<p>sdfas</p>\n'),(23,52,'Goal 2 Function Field','Goal 2 Function Field',1,'2015-07-06 11:00:09','2015-07-06 15:00:09','text','<p>safd</p>\n'),(24,53,'Goal 2 Objective Field','Goal 2 Objective Field',1,'2015-07-06 11:00:09','2015-07-06 15:00:09','text','<p>asf</p>\n'),(25,54,'Goal 3 Function Field','Goal 3 Function Field',1,'2015-07-06 11:00:09','2015-07-06 15:00:09','text','<p>asfd</p>\n'),(26,55,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-07-06 11:00:09','2015-07-06 15:00:09','text','<p>asfda</p>\n'),(27,56,'Goal 1FN Course of Action Field','Goal 1FN Course of Action Field',1,'2015-07-06 11:11:31','2015-07-06 15:11:31','text','<p>dasdgd fgd s</p>\n'),(28,57,'Goal 2FN Course of Action Field','Goal 2FN Course of Action Field',1,'2015-07-06 11:11:31','2015-07-06 15:11:31','text','<p>sdg sg</p>\n'),(29,58,'Goal 3FN Course of Action Field','Goal 3FN Course of Action Field',1,'2015-07-06 11:11:31','2015-07-06 15:11:31','text','<p>sdfg sdg s Polo</p>\n'),(30,60,'Title Field','Title of the plan',1,'2015-07-06 11:19:20','2015-07-06 15:19:20','text','ssdf'),(31,60,'Date Field','Date',2,'2015-07-06 11:19:20','2015-07-06 15:19:20','text','2015-07-06'),(32,60,'School Field','The school(s) covered by the plan',3,'2015-07-06 11:19:20','2015-07-06 15:19:20','text','<p>sfsdf s</p>\n'),(33,61,'Promulgation Field','Promulgation Field',1,'2015-07-06 11:19:20','2015-07-06 15:19:20','text','<p>sdfs fd</p>\n'),(34,62,'Approval Field','Approval Field',1,'2015-07-06 11:19:20','2015-07-06 15:19:20','text','<p>sdf sdfs</p>\n'),(67,66,'Goal 1 Field','Goal 1 Field',1,'2015-07-06 15:28:23','2015-07-06 19:28:23','text','<p>asdf</p>\n'),(68,67,'Goal 1 Objective Field','Goal 1 Objective Field',1,'2015-07-06 15:28:23','2015-07-06 19:28:23','text','<p>sdfadf</p>\n'),(69,68,'Goal 1 TH Course of Action Field','Goal 1 TH Course of Action Field',1,'2015-07-06 15:28:23','2015-07-06 19:28:23','text',''),(70,69,'Goal 2 Field','Goal 2 Field',1,'2015-07-06 15:28:23','2015-07-06 19:28:23','text','<p>sf</p>\n'),(71,70,'Goal 2 Objective Field','Goal 2 Objective Field',1,'2015-07-06 15:28:23','2015-07-06 19:28:23','text','<p>sdgsdgs</p>\n'),(72,71,'Goal 2 TH Course of Action Field','Goal 2 TH Course of Action Field',1,'2015-07-06 15:28:23','2015-07-06 19:28:23','text',''),(73,72,'Goal 3 Field','Goal 3 Field',1,'2015-07-06 15:28:23','2015-07-06 19:28:23','text','<p>ersefgsdgsd</p>\n'),(74,73,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-07-06 15:28:23','2015-07-06 19:28:23','text','<p>dfgsdgsd g</p>\n'),(75,74,'Goal 3 TH Course of Action Field','Goal 3 TH Course of Action Field',1,'2015-07-06 15:28:23','2015-07-06 19:28:23','text',''),(76,65,'TH Field','Threats and Hazards Default Field',1,'2015-07-06 15:31:08','2015-07-06 19:31:08','text',''),(77,81,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-07-06 15:31:08','2015-07-06 19:31:08','text','<p>wadfas dafsd</p>\n'),(78,83,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-07-06 15:31:08','2015-07-06 19:31:08','text','<p>asdf as dfaf</p>\n'),(79,85,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-07-06 15:31:08','2015-07-06 19:31:08','text','<p>sdf asf as fa pokio</p>\n'),(80,87,'Goal 1 Function Field','Goal 1 Function Field',1,'2015-07-06 15:35:22','2015-07-06 19:35:22','text','<p>asfasf asf a</p>\n'),(81,88,'Goal 1 Objective Field','Goal 1 Objective Field',1,'2015-07-06 15:35:22','2015-07-06 19:35:22','text','<p>asdf asfa fd</p>\n'),(82,89,'Goal 2 Function Field','Goal 2 Function Field',1,'2015-07-06 15:35:22','2015-07-06 19:35:22','text','<p>sdf asf da</p>\n'),(83,90,'Goal 2 Objective Field','Goal 2 Objective Field',1,'2015-07-06 15:35:22','2015-07-06 19:35:22','text','<p>asf asfd a</p>\n'),(84,91,'Goal 3 Function Field','Goal 3 Function Field',1,'2015-07-06 15:35:22','2015-07-06 19:35:22','text','<p>asfd asfd as</p>\n'),(85,92,'Goal 3 Objective Field','Goal 3 Objective Field',1,'2015-07-06 15:35:22','2015-07-06 19:35:22','text','<p>asfd asfd asf</p>\n'),(86,96,'Purpose Field','Purpose',1,'2015-07-09 10:24:30','2015-07-09 14:24:30','text','<p>ssdsdzsvz</p>\n'),(87,97,'Scope','Scope',1,'2015-07-09 10:24:30','2015-07-09 14:24:30','text','<p>zvzxvz</p>\n'),(88,98,'Situation Overview','Situation Overview',1,'2015-07-09 10:24:30','2015-07-09 14:24:30','text','<p>zcvzxvc</p>\n'),(89,99,'Planning Assumptions','Planning Assumptions',1,'2015-07-09 10:24:30','2015-07-09 14:24:30','text','<p>zvczxcvz</p>\n'),(90,101,'Administration, Finance, and Logistics Field','Administration, Finance, and Logistics',1,'2015-07-13 11:16:27','2015-07-13 15:16:27','text','<p>ll;l</p>\n'),(91,63,'Change Number','Change Number',1,'2015-07-13 12:14:15','2015-07-13 16:14:15','text','sfd s'),(92,63,'Date of Change','Date of Change',1,'2015-07-13 12:14:15','2015-07-13 16:14:15','text','2015-07-06'),(93,63,'Name','Name',1,'2015-07-13 12:14:15','2015-07-13 16:14:15','text','sfd s'),(94,63,'Summary of Change','Summary of Change',1,'2015-07-13 12:14:15','2015-07-13 16:14:15','text','sfsfd'),(95,64,'Title and name of person receiving the plan','Title and name of person receiving the plan',1,'2015-07-13 12:14:15','2015-07-13 16:14:15','text','sfs'),(96,64,'Agency (school office, government agency, or private-sector entity','Agency (school office, government agency, or private-sector entity',1,'2015-07-13 12:14:15','2015-07-13 16:14:15','text','sfsdf'),(97,64,'Date of delivery','Date of delivery',1,'2015-07-13 12:14:15','2015-07-13 16:14:15','text','2015-07-06'),(98,64,'Number of copies delivered','Number of copies delivered',1,'2015-07-13 12:14:15','2015-07-13 16:14:15','text','sfsdf'),(99,102,'Objective Field','Objective',1,'2015-07-13 12:25:25','2015-07-13 16:25:25','text','<p>csdfgsdfsdgd</p>\n\n<p>dfgdsfgs</p>\n'),(100,104,'Objective Field','Objective',1,'2015-07-13 12:25:25','2015-07-13 16:25:25','text','<p>sadlfkjasfdasdf</p>\n'),(101,106,'Objective Field','Objective',1,'2015-07-13 12:25:25','2015-07-13 16:25:25','text','<p>asdfasf asfd</p>\n');
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
  `key` varchar(32) NOT NULL,
  `value` varchar(128) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_registry`
--

LOCK TABLES `eop_registry` WRITE;
/*!40000 ALTER TABLE `eop_registry` DISABLE KEYS */;
INSERT INTO `eop_registry` VALUES (39,'install_status','completed','2015-05-26 16:31:31'),(40,'dbtype','mysqli','2015-05-26 16:31:31'),(41,'host_level','state','2015-05-26 16:31:31'),(42,'host_state','MD','2015-05-26 16:31:31'),(43,'state_permission','write','2015-07-13 21:00:19');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_school`
--

LOCK TABLES `eop_school` WRITE;
/*!40000 ALTER TABLE `eop_school` DISABLE KEYS */;
INSERT INTO `eop_school` VALUES (5,4,'MD','First School','School 1',NULL,'2015-05-21 11:13:09','2015-05-21 15:13:09',NULL,'deny'),(6,0,'MD','ggg','gggggg',NULL,'2015-05-21 12:06:17','2015-05-21 16:06:17',NULL,'deny'),(7,0,'MD','ssds','sdsdsds',NULL,'2015-05-21 12:50:14','2015-05-21 16:50:14',NULL,'deny'),(8,4,'MD','dadadad','adasdad',NULL,'2015-05-21 14:25:44','2015-05-21 18:25:44',NULL,'deny'),(9,0,'MD','cccccc223','ccccccc',NULL,'2015-05-21 14:58:01','2015-05-21 18:58:01',NULL,'deny'),(10,4,'MD','kol','fffffff',NULL,'2015-05-21 15:09:06','2015-05-21 19:09:06',NULL,'deny'),(11,5,'MD','hpoijpopo','hjhhjjhjh',NULL,'2015-05-21 16:09:47','2015-05-21 20:09:47',NULL,'deny'),(12,4,'MD','goddie','gogino',NULL,'2015-05-22 10:14:08','2015-05-22 14:14:08',NULL,'deny'),(13,0,'MD','Independent School','',NULL,'2015-05-22 15:15:28','2015-05-22 19:15:28',NULL,'deny'),(14,0,'MD','My School','Me School',NULL,'2015-05-28 12:15:50','2015-05-28 16:15:50',17,'deny'),(15,5,'MD','My School2','',NULL,'2015-05-28 12:16:09','2015-05-28 16:16:09',17,'deny');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_team`
--

LOCK TABLES `eop_team` WRITE;
/*!40000 ALTER TABLE `eop_team` DISABLE KEYS */;
INSERT INTO `eop_team` VALUES (5,'sdafa','asdfa','asdfa','adsfaf@dss','240-705-6739','School District/LEA, School Community, Local Community Partner, State Department of Education/SEA','2015-06-02 20:40:09','2015-06-02 16:40:09',29,5,4),(6,'Godfrey Majwega2','ada','afasfa','adsfaf@dss','240-705-6739','School District/LEA, School Community, Diverse Interests of Whole School Community, Local Community Partner, State Department of Education/SEA','2015-06-02 20:41:28','2015-06-02 16:41:28',29,5,4),(8,'asdfadfdd','asdfsaf','asdfa','asdfkjla@ada.com','240-705-6739','School District/LEA, State Department of Education/SEA, Additional Partner','2015-06-19 17:52:52','2015-06-19 13:52:52',17,NULL,NULL),(9,'twet','etw','wetw','wewer@rer','240-705-6739','School District/LEA, Local Community Partner, State Community Partner','2015-07-06 20:34:53','2015-07-06 16:34:53',29,8,4);
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
  `modified` timestamp NULL DEFAULT NULL,
  `read_only` char(1) DEFAULT 'n',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_user`
--

LOCK TABLES `eop_user` WRITE;
/*!40000 ALTER TABLE `eop_user` DISABLE KEYS */;
INSERT INTO `eop_user` VALUES (17,1,'Supers','Administrator','majregor@glydenet.com','admin','7ce8bcd42b1efa29518674ec4a99fa60','2407056739','active','2015-05-20 00:21:11',NULL,'y'),(26,4,'School','Administrator','darius.f.yaghoubi@nasa.gov','schooladmin','980ac217c6b51e7dc41040bec1edfec8','2407056739','active','2015-05-21 11:21:50',NULL,'n'),(27,5,'School','User','qqq@ss.com','schooluser','7ce8bcd42b1efa29518674ec4a99fa60','2407056739','active','2015-05-21 12:17:49',NULL,'n'),(28,4,'School','User2','dsdsd@aa.com','schooluser2','0b4e7a0e5fe84ad35fb5f95b9ceeac79','2407056739','active','2015-05-21 12:38:58',NULL,'n'),(29,3,'District','Administrators','sasasas@sss.comopop','distadmin','128e61891b7bf0cfafbbc589a65ce5f6','2407056739','active','2015-05-21 12:42:35',NULL,'n'),(31,4,'wasasasa','asasas','asasasas@sss.com','sddddd','343b1c4a3ea721b2d640fc8700db0f36','2407056739','active','2015-05-21 15:26:55',NULL,'y'),(32,5,'Schoolnn','User','fhfgh@ddd.c','schooluser1','128e61891b7bf0cfafbbc589a65ce5f6','2407056739','active','2015-05-21 15:33:18',NULL,'n'),(33,2,'State','Administrator','bgds@dd.com','sadmin','128e61891b7bf0cfafbbc589a65ce5f6','2407056739','active','2015-05-21 15:37:27',NULL,'n'),(34,4,'bvvb','vbvb','svb@ss.c','vbb','128e61891b7bf0cfafbbc589a65ce5f6','2407056739','active','2015-05-21 15:52:23',NULL,'y'),(35,1,'Super','Administrator','adminss@ss.com','admin3','0192023a7bbd73250516f069df18b500','','active','2015-05-22 10:31:19',NULL,'n'),(36,1,'Super','Administrator','drerer@dd.com','admin4','7ce8bcd42b1efa29518674ec4a99fa60','','active','2015-05-22 10:41:19',NULL,'n'),(37,4,'sdfafs','afafafa','asfdsaf@dsd','admins','0b4e7a0e5fe84ad35fb5f95b9ceeac79','2407056739','active','2015-05-22 12:40:49',NULL,'n'),(38,1,'Super','Administrator','asaklk@sdsd.com','superadmin','128e61891b7bf0cfafbbc589a65ce5f6','','active','2015-05-26 10:18:48',NULL,'n'),(39,1,'Super','Administrator','asDSA@sa.com','adminsss','128e61891b7bf0cfafbbc589a65ce5f6','','active','2015-05-26 12:31:31',NULL,'n'),(40,5,'Godd','Freyy','adasf@dd.com','goddfree','7ce8bcd42b1efa29518674ec4a99fa60','2407056733','active','2015-05-28 10:06:23',NULL,'n'),(41,5,'Goddino222','Number 2','asdfa@erer.com','goddino2','0b4e7a0e5fe84ad35fb5f95b9ceeac79','','active','2015-05-28 10:34:31',NULL,'n'),(42,3,'june','user1','asfa@sds.com','juneuser','af15d5fdacd5fdfea300e88a8e253e82','12312312233','active','2015-06-01 17:09:08',NULL,'n'),(43,3,'user','June1','adfas@ere.com','juneuser2','0b4e7a0e5fe84ad35fb5f95b9ceeac79','12356709873','active','2015-06-01 17:15:38',NULL,'n'),(44,3,'June','User3','user2@macomen.com','juneuserpp','af15d5fdacd5fdfea300e88a8e253e82','2407056739','active','2015-06-01 17:22:10',NULL,'n'),(45,3,'june','user4','asdf@gr.com','juneuser5','af15d5fdacd5fdfea300e88a8e253e82','2407056739','active','2015-06-01 17:23:22',NULL,'n'),(46,3,'junedd','user6','user6@hotmail.com','juneuser6','0b4e7a0e5fe84ad35fb5f95b9ceeac79','12323489673','active','2015-06-01 17:31:22',NULL,'n'),(47,5,'junes','user7','user7@hotmail.com','user7','7ce8bcd42b1efa29518674ec4a99fa60','2407056739','active','2015-06-01 17:32:39',NULL,'y'),(48,2,'wfasfa','afafa','adf@esds','sadmin234','128e61891b7bf0cfafbbc589a65ce5f6','2407056739','active','2015-07-08 12:31:17',NULL,'n'),(49,4,'afasfa','asfasfd','asdfa@erer.comss','scasasad','fcea920f7412b5da7be0cf42b8c93759','','active','2015-07-14 15:19:59',NULL,'n'),(50,4,'klsdfsalkfdsa;ld;l','la;skjf;lasjdfa;l','lksfdlakjf@al.com','alkjhfaskjfa','e10adc3949ba59abbe56e057f20f883e','','active','2015-07-14 15:46:23',NULL,'n'),(51,5,'School User341','2121','schooluser342@glydenet.com','schooluser234','e10adc3949ba59abbe56e057f20f883e','2407056739','active','2015-07-14 15:48:13',NULL,'n');
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_user2district`
--

LOCK TABLES `eop_user2district` WRITE;
/*!40000 ALTER TABLE `eop_user2district` DISABLE KEYS */;
INSERT INTO `eop_user2district` VALUES (5,29,4,'2015-05-21 16:42:35'),(7,31,4,'2015-05-21 19:26:55'),(8,32,4,'2015-05-21 19:33:18'),(9,37,4,'2015-05-22 16:40:50'),(10,41,4,'2015-05-28 14:34:31'),(11,42,4,'2015-06-01 21:09:09'),(12,43,4,'2015-06-01 21:15:38'),(13,44,4,'2015-06-01 21:22:10'),(14,45,5,'2015-06-01 21:23:22'),(15,46,4,'2015-06-01 21:31:22'),(16,47,4,'2015-06-01 21:32:39'),(17,49,4,'2015-07-14 19:19:59');
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_user2school`
--

LOCK TABLES `eop_user2school` WRITE;
/*!40000 ALTER TABLE `eop_user2school` DISABLE KEYS */;
INSERT INTO `eop_user2school` VALUES (4,26,5,'2015-05-21 15:21:50'),(5,27,5,'2015-05-21 16:17:49'),(6,28,5,'2015-05-21 16:38:58'),(10,31,5,'2015-05-21 19:26:55'),(11,32,5,'2015-05-21 19:33:18'),(12,34,5,'2015-05-21 19:52:24'),(13,37,5,'2015-05-22 16:40:50'),(14,40,5,'2015-05-28 14:06:23'),(15,41,5,'2015-05-28 14:34:31'),(16,42,5,'2015-06-01 21:09:09'),(17,43,5,'2015-06-01 21:15:38'),(18,44,5,'2015-06-01 21:22:10'),(19,47,8,'2015-06-01 21:32:39'),(20,49,5,'2015-07-14 19:19:59'),(21,50,5,'2015-07-14 19:46:23'),(22,51,5,'2015-07-14 19:48:13');
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
 1 AS `owner`,
 1 AS `state_permission`,
 1 AS `district`,
 1 AS `district_screen_name`,
 1 AS `state`*/;
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
/*!50001 VIEW `eop_view_school` AS select `A`.`id` AS `id`,`A`.`district_id` AS `district_id`,`A`.`state_val` AS `state_val`,`A`.`name` AS `name`,`A`.`screen_name` AS `screen_name`,`A`.`description` AS `description`,`A`.`created_date` AS `created_date`,`A`.`modified_date` AS `modified_date`,`A`.`owner` AS `owner`,`A`.`state_permission` AS `state_permission`,`B`.`name` AS `district`,`B`.`screen_name` AS `district_screen_name`,`C`.`name` AS `state` from ((`eop_school` `A` left join `eop_district` `B` on((`A`.`district_id` = `B`.`id`))) left join `eop_state` `C` on((`A`.`state_val` = `C`.`val`))) */;
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

-- Dump completed on 2015-07-15  9:44:07
