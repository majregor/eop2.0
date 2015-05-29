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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_district`
--

LOCK TABLES `eop_district` WRITE;
/*!40000 ALTER TABLE `eop_district` DISABLE KEYS */;
INSERT INTO `eop_district` VALUES (2,'First District','My First District',NULL,'MD','2015-05-20 04:33:20',NULL,'deny'),(3,'Second Districts','My Second Districts',NULL,'MD','2015-05-20 04:36:17',NULL,'deny');
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
  `name` varchar(128) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `owner` int(32) DEFAULT NULL,
  `parent` int(32) DEFAULT NULL,
  `weight` int(8) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_entity`
--

LOCK TABLES `eop_entity` WRITE;
/*!40000 ALTER TABLE `eop_entity` DISABLE KEYS */;
/*!40000 ALTER TABLE `eop_entity` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_field`
--

LOCK TABLES `eop_field` WRITE;
/*!40000 ALTER TABLE `eop_field` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_registry`
--

LOCK TABLES `eop_registry` WRITE;
/*!40000 ALTER TABLE `eop_registry` DISABLE KEYS */;
INSERT INTO `eop_registry` VALUES (19,'install_status','completed','2015-05-20 04:21:11'),(20,'dbtype','mysqli','2015-05-20 04:21:11'),(21,'host_level','state','2015-05-20 04:21:11'),(22,'state_permission','deny','2015-05-20 15:37:30'),(23,'host_state','MD','2015-05-20 13:22:34');
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
  `district_id` int(32) DEFAULT NULL,
  `state_val` varchar(8) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `screen_name` varchar(256) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `owner` int(32) DEFAULT NULL,
  `state_permission` varchar(45) DEFAULT 'deny',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_school`
--

LOCK TABLES `eop_school` WRITE;
/*!40000 ALTER TABLE `eop_school` DISABLE KEYS */;
INSERT INTO `eop_school` VALUES (2,2,'MD','School 1','First School',NULL,'2015-05-20 08:42:07','2015-05-20 12:42:07',NULL,'deny'),(3,3,'MD','School 2','ssss',NULL,'2015-05-20 11:40:07','2015-05-20 15:40:07',NULL,'deny'),(4,NULL,NULL,NULL,NULL,NULL,'2015-05-20 17:24:24','2015-05-20 21:24:24',NULL,'deny');
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_user`
--

LOCK TABLES `eop_user` WRITE;
/*!40000 ALTER TABLE `eop_user` DISABLE KEYS */;
INSERT INTO `eop_user` VALUES (17,1,'Super','Administrator','majregor@glydenet.com','admin','7ce8bcd42b1efa29518674ec4a99fa60','','active','2015-05-20 00:21:11',NULL,'n'),(19,2,'state','administrator','majregor2@glydenet.com','sadmin','7ce8bcd42b1efa29518674ec4a99fa60','2407056739','active','2015-05-20 00:30:15',NULL,'n'),(21,3,'District','Administrator','monaly15@yahoo.com','dadmin','7ce8bcd42b1efa29518674ec4a99fa60','2407056739','active','2015-05-20 00:38:23',NULL,'n'),(22,3,'District','Administrator2','majregor22@gmail.com','dadmin2','0b4e7a0e5fe84ad35fb5f95b9ceeac79','2407056739','active','2015-05-20 01:10:37',NULL,'n'),(24,3,'District','Administrator by State Admin','dd@sd.com','dadmin3','96e79218965eb72c92a549dd5a330112','2407056739','active','2015-05-20 08:33:34',NULL,'n'),(25,4,'School','Administrator by State Admin','dslkdsk@dc.com','schooladmin1','96e79218965eb72c92a549dd5a330112','2407056739','active','2015-05-20 09:41:57',NULL,'n');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_user2district`
--

LOCK TABLES `eop_user2district` WRITE;
/*!40000 ALTER TABLE `eop_user2district` DISABLE KEYS */;
INSERT INTO `eop_user2district` VALUES (1,22,2,'2015-05-20 05:10:37'),(2,21,3,'2015-05-20 05:34:25'),(3,0,2,'2015-05-20 12:32:46'),(4,24,2,'2015-05-20 12:33:34');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_user2school`
--

LOCK TABLES `eop_user2school` WRITE;
/*!40000 ALTER TABLE `eop_user2school` DISABLE KEYS */;
INSERT INTO `eop_user2school` VALUES (1,22,0,'2015-05-20 05:10:37'),(2,25,2,'2015-05-20 13:41:57');
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
/*!50001 VIEW `eop_view_school` AS select `A`.`id` AS `id`,`A`.`district_id` AS `district_id`,`A`.`state_val` AS `state_val`,`A`.`name` AS `name`,`A`.`screen_name` AS `screen_name`,`A`.`description` AS `description`,`A`.`created_date` AS `created_date`,`A`.`modified_date` AS `modified_date`,`A`.`owner` AS `owner`,`A`.`state_permission` AS `state_permission`,`B`.`name` AS `district`,`C`.`name` AS `state` from ((`eop_school` `A` left join `eop_district` `B` on((`A`.`district_id` = `B`.`id`))) left join `eop_state` `C` on((`A`.`state_val` = `C`.`val`))) */;
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

-- Dump completed on 2015-05-20 17:39:51
