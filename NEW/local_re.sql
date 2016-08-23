/*
SQLyog Ultimate v8.5 
MySQL - 5.6.17 : Database - open_reach_expansion
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `bf_activities` */

CREATE TABLE `bf_activities` (
  `activity_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `activity` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `deleted` tinyint(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2452 DEFAULT CHARSET=utf8;

/*Data for the table `bf_activities` */

insert  into `bf_activities`(`activity_id`,`user_id`,`activity`,`module`,`created_on`,`deleted`) values (1,1,'logged in from: 127.0.0.1','users','2015-05-21 06:11:13',0),(2,1,'logged in from: 127.0.0.1','users','2015-05-25 04:53:26',0),(3,1,'logged in from: 127.0.0.1','users','2015-05-25 05:03:20',0),(4,1,'logged in from: 127.0.0.1','users','2015-05-25 06:59:37',0),(5,1,'logged in from: 127.0.0.1','users','2015-05-25 07:12:41',0),(6,1,'logged in from: 127.0.0.1','users','2015-05-26 04:16:20',0),(7,1,'logged in from: 127.0.0.1','users','2015-05-26 07:30:23',0),(8,1,'Created Module: assigned : 127.0.0.1','modulebuilder','2015-05-26 13:18:34',0),(9,1,'Deleted Module: assigned : 127.0.0.1','builder','2015-05-26 13:24:23',0),(10,1,'Created Module: userinfo : 127.0.0.1','modulebuilder','2015-05-26 13:29:14',0),(11,1,'logged in from: 127.0.0.1','users','2015-05-27 04:04:36',0),(12,1,'logged in from: 127.0.0.1','users','2015-05-27 04:05:52',0),(13,1,'Deleted Module: userinfo : 127.0.0.1','builder','2015-05-27 04:07:33',0),(14,1,'Created Module: userinfo : 127.0.0.1','modulebuilder','2015-05-27 04:14:29',0),(15,1,'Created Module: userinfo : 127.0.0.1','modulebuilder','2015-05-27 04:14:38',0),(16,1,'Deleted Module: userinfo : 127.0.0.1','builder','2015-05-27 04:42:46',0),(17,1,'Created Module: technology : 127.0.0.1','modulebuilder','2015-05-27 04:47:26',0),(18,1,'Created record with ID: 1 : 127.0.0.1','technology','2015-05-27 04:48:20',0),(19,1,'Deleted record with ID: 1 : 127.0.0.1','technology','2015-05-27 05:06:30',0),(20,1,'Created record with ID: 2 : 127.0.0.1','technology','2015-05-27 05:15:27',0),(21,1,'FIXME (\"us_log_status_change\"): admin : Activateed','users','2015-05-27 05:45:03',0),(22,1,'App settings saved from: 127.0.0.1','ui','2015-05-27 07:53:42',0),(23,1,'App settings saved from: 127.0.0.1','ui','2015-05-27 07:54:37',0),(24,1,'App settings saved from: 127.0.0.1','ui','2015-05-27 07:55:45',0),(25,1,'App settings saved from: 127.0.0.1','ui','2015-05-27 07:55:49',0),(26,1,'Created record with ID: 3 : 127.0.0.1','technology','2015-05-27 11:08:31',0),(27,1,'logged in from: 127.0.0.1','users','2015-05-27 12:40:26',0),(28,1,'Created record with ID: 1 : 127.0.0.1','category','2015-05-27 13:18:53',0),(29,1,'Created record with ID: 1 : 127.0.0.1','navigation','2015-05-27 13:19:27',0),(30,1,'Created record with ID: 4 : 127.0.0.1','technology','2015-05-27 13:22:16',0),(31,1,'logged in from: 127.0.0.1','users','2015-05-28 04:04:37',0),(32,1,'Created Module: dddd : 127.0.0.1','modulebuilder','2015-05-28 04:36:08',0),(33,1,'Deleted Module: dddd : 127.0.0.1','builder','2015-05-28 04:36:33',0),(34,1,'Deleted Module: technology : 127.0.0.1','builder','2015-05-28 04:36:38',0),(35,1,'Created Module: technology : 127.0.0.1','modulebuilder','2015-05-28 04:37:38',0),(36,1,'Created Module: technology : 127.0.0.1','modulebuilder','2015-05-28 04:37:42',0),(37,1,'Deleted Module: technology : 127.0.0.1','builder','2015-05-28 04:51:26',0),(38,1,'Created Module: technology : 127.0.0.1','modulebuilder','2015-05-28 04:51:56',0),(39,1,'Deleted Module: technology : 127.0.0.1','builder','2015-05-28 04:56:16',0),(40,1,'Created Module: technology : 127.0.0.1','modulebuilder','2015-05-28 04:57:01',0),(41,1,'Deleted Module: technology : 127.0.0.1','builder','2015-05-28 04:58:26',0),(42,1,'Created Module: test mod : 127.0.0.1','modulebuilder','2015-05-28 04:59:18',0),(43,1,'Created Module: frfrff : 127.0.0.1','modulebuilder','2015-05-28 05:04:06',0),(44,1,'Deleted Module: frfrff : 127.0.0.1','builder','2015-05-28 05:04:23',0),(45,1,'Deleted Module: test_mod : 127.0.0.1','builder','2015-05-28 05:04:27',0),(46,1,'Created Module: testing1 : 127.0.0.1','modulebuilder','2015-05-28 05:05:29',0),(47,1,'Created record with ID: 1 : 127.0.0.1','testing1','2015-05-28 05:05:41',0),(48,1,'Deleted record with ID: 1 : 127.0.0.1','testing1','2015-05-28 05:05:50',0),(49,1,'Migrate Type: refer_friend_ to Version: 1 from: 127.0.0.1','migrations','2015-05-28 05:10:30',0),(50,1,'Migration module: refer_friend Version: 1 from: 127.0.0.1','migrations','2015-05-28 05:10:30',0),(51,1,'Migrate Type: refer_friend_ to Version: 2 from: 127.0.0.1','migrations','2015-05-28 05:10:39',0),(52,1,'Migration module: refer_friend Version: 2 from: 127.0.0.1','migrations','2015-05-28 05:10:39',0),(53,1,'Created record with ID: 2 : 127.0.0.1','category','2015-05-28 05:26:37',0),(54,1,'logged in from: 127.0.0.1','users','2015-05-28 05:33:28',0),(55,1,'logged in from: 127.0.0.1','users','2015-05-28 05:49:59',0),(56,1,'logged in from: 127.0.0.1','users','2015-05-28 05:57:24',0),(57,1,'logged in from: 127.0.0.1','users','2015-05-28 05:57:49',0),(58,1,'logged in from: 127.0.0.1','users','2015-05-28 09:24:03',0),(59,1,'logged in from: 127.0.0.1','users','2015-05-29 04:37:47',0),(60,1,'logged in from: 127.0.0.1','users','2015-05-29 04:50:12',0),(61,1,'Created record with ID: 1 : 127.0.0.1','testing1','2015-05-29 04:58:58',0),(62,1,'FIXME (\"bf_common_act_create_record\"): 1 : 127.0.0.1','pages','2015-05-29 05:26:53',0),(63,1,'Deleted Module: testing1 : 127.0.0.1','builder','2015-05-29 05:29:52',0),(64,1,'Deleted Module: Refer_Friend : 127.0.0.1','builder','2015-05-29 05:29:57',0),(65,1,'Created record with ID: 1 : 127.0.0.1','menu','2015-05-29 05:36:12',0),(66,1,'Updated record with ID: 1 : 127.0.0.1','menu','2015-05-29 06:04:29',0),(67,1,'Updated record with ID: 1 : 127.0.0.1','menu','2015-05-29 06:04:39',0),(68,1,'logged in from: 127.0.0.1','users','2015-05-29 06:13:35',0),(69,1,'Created record with ID: 2 : 127.0.0.1','menu','2015-05-29 06:14:40',0),(70,1,'Created record with ID: 2 : 127.0.0.1','navigation','2015-05-29 06:32:10',0),(71,1,'logged in from: 127.0.0.1','users','2015-05-29 10:56:46',0),(72,1,'logged in from: 127.0.0.1','users','2015-05-29 11:21:40',0),(73,1,'logged in from: 127.0.0.1','users','2015-05-29 11:22:58',0),(74,1,'created a new %s User: d','users','2015-05-29 11:24:49',0),(75,1,'logged in from: 127.0.0.1','users','2015-05-29 12:52:57',0),(76,1,'logged in from: 127.0.0.1','users','2015-05-30 03:55:12',0),(77,1,'Created Module: 4wt : 127.0.0.1','modulebuilder','2015-05-30 03:57:35',0),(78,1,'Deleted Module: testing1 : 127.0.0.1','builder','2015-05-30 04:21:28',0),(79,1,'logged in from: 127.0.0.1','users','2015-05-30 04:26:03',0),(80,1,'logged in from: 127.0.0.1','users','2015-05-30 04:29:11',0),(81,1,'logged in from: 127.0.0.1','users','2015-05-30 04:46:56',0),(82,1,'logged in from: 127.0.0.1','users','2015-05-30 04:50:19',0),(83,1,'logged in from: 127.0.0.1','users','2015-05-30 06:35:39',0),(84,1,'logged in from: 127.0.0.1','users','2015-05-30 07:06:55',0),(85,1,'logged in from: 127.0.0.1','users','2015-05-30 07:44:00',0),(86,1,'logged in from: 127.0.0.1','users','2015-06-01 03:59:22',0),(87,1,'logged in from: 127.0.0.1','users','2015-06-01 04:05:39',0),(88,1,'Migrate Type: banner_ to Version: 2 from: 127.0.0.1','migrations','2015-06-01 06:05:23',0),(89,1,'Migration module: banner Version: 2 from: 127.0.0.1','migrations','2015-06-01 06:05:23',0),(90,1,'Migrate Type: banner_ to Version: 1 from: 127.0.0.1','migrations','2015-06-01 06:05:30',0),(91,1,'Migration module: banner Version: 1 from: 127.0.0.1','migrations','2015-06-01 06:05:30',0),(92,1,'logged in from: 127.0.0.1','users','2015-06-01 06:11:19',0),(93,1,'Migrate Type: banner_ Uninstalled Version: 0 from: 127.0.0.1','migrations','2015-06-01 06:14:48',0),(94,1,'Migration module: banner Version: 0 from: 127.0.0.1','migrations','2015-06-01 06:14:48',0),(95,1,'Migrate Type: banner_ to Version: 2 from: 127.0.0.1','migrations','2015-06-01 06:14:54',0),(96,1,'Migration module: banner Version: 2 from: 127.0.0.1','migrations','2015-06-01 06:14:55',0),(97,1,'Migrate Type: banner_ to Version: 1 from: 127.0.0.1','migrations','2015-06-01 06:15:16',0),(98,1,'Migration module: banner Version: 1 from: 127.0.0.1','migrations','2015-06-01 06:15:16',0),(99,1,'Migrate Type: banner_ Uninstalled Version: 0 from: 127.0.0.1','migrations','2015-06-01 06:15:49',0),(100,1,'Migration module: banner Version: 0 from: 127.0.0.1','migrations','2015-06-01 06:15:49',0),(101,1,'Migrate Type: banner_ to Version: 1 from: 127.0.0.1','migrations','2015-06-01 06:15:54',0),(102,1,'Migration module: banner Version: 1 from: 127.0.0.1','migrations','2015-06-01 06:15:54',0),(103,1,'Migrate Type: banner_ to Version: 2 from: 127.0.0.1','migrations','2015-06-01 06:15:58',0),(104,1,'Migration module: banner Version: 2 from: 127.0.0.1','migrations','2015-06-01 06:15:58',0),(105,1,'Migrate Type: social_media_ to Version: 1 from: 127.0.0.1','migrations','2015-06-01 06:44:21',0),(106,1,'Migration module: social_media Version: 1 from: 127.0.0.1','migrations','2015-06-01 06:44:21',0),(107,1,'Migrate Type: social_media_ to Version: 2 from: 127.0.0.1','migrations','2015-06-01 06:44:26',0),(108,1,'Migration module: social_media Version: 2 from: 127.0.0.1','migrations','2015-06-01 06:44:26',0),(109,1,'Migrate Type: social_media_ Uninstalled Version: 0 from: 127.0.0.1','migrations','2015-06-01 06:45:53',0),(110,1,'Migration module: social_media Version: 0 from: 127.0.0.1','migrations','2015-06-01 06:45:53',0),(111,1,'Migrate Type: social_media_ to Version: 1 from: 127.0.0.1','migrations','2015-06-01 06:46:18',0),(112,1,'Migration module: social_media Version: 1 from: 127.0.0.1','migrations','2015-06-01 06:46:18',0),(113,1,'Migrate Type: social_media_ to Version: 2 from: 127.0.0.1','migrations','2015-06-01 06:46:25',0),(114,1,'Migration module: social_media Version: 2 from: 127.0.0.1','migrations','2015-06-01 06:46:25',0),(115,1,'Migrate Type: social_media_ to Version: 2 from: 127.0.0.1','migrations','2015-06-01 07:09:00',0),(116,1,'Migration module: social_media Version: 2 from: 127.0.0.1','migrations','2015-06-01 07:09:00',0),(117,1,'Created record with ID: 2 : 127.0.0.1','banner','2015-06-01 07:19:05',0),(118,1,'Created record with ID: 3 : 127.0.0.1','banner','2015-06-01 07:19:16',0),(119,1,'Created record with ID: 4 : 127.0.0.1','banner','2015-06-01 07:19:23',0),(120,1,'Created record with ID: 1 : 127.0.0.1','social_media','2015-06-01 07:28:35',0),(121,1,'Updated record with ID: 1 : 127.0.0.1','menu','2015-06-01 07:46:15',0),(122,1,'Updated record with ID: 1 : 127.0.0.1','menu','2015-06-01 07:46:25',0),(123,1,'Migrate Type: newsletter_ to Version: 1 from: 127.0.0.1','migrations','2015-06-01 09:16:35',0),(124,1,'Migration module: newsletter Version: 1 from: 127.0.0.1','migrations','2015-06-01 09:16:35',0),(125,1,'Migrate Type: newsletter_ to Version: 2 from: 127.0.0.1','migrations','2015-06-01 09:16:42',0),(126,1,'Migration module: newsletter Version: 2 from: 127.0.0.1','migrations','2015-06-01 09:16:43',0),(127,1,'Migrate Type: newsletter_ Uninstalled Version: 0 from: 127.0.0.1','migrations','2015-06-01 09:25:47',0),(128,1,'Migration module: newsletter Version: 0 from: 127.0.0.1','migrations','2015-06-01 09:25:47',0),(129,1,'Migrate Type: newsletter_ to Version: 1 from: 127.0.0.1','migrations','2015-06-01 09:25:57',0),(130,1,'Migration module: newsletter Version: 1 from: 127.0.0.1','migrations','2015-06-01 09:25:57',0),(131,1,'Migrate Type: newsletter_ to Version: 2 from: 127.0.0.1','migrations','2015-06-01 09:26:03',0),(132,1,'Migration module: newsletter Version: 2 from: 127.0.0.1','migrations','2015-06-01 09:26:03',0),(133,1,'Created record with ID: 16 : 127.0.0.1','newsletter','2015-06-01 10:30:53',0),(134,2,'logged in from: 127.0.0.1','users','2015-06-01 12:46:12',0),(135,2,'logged in from: 127.0.0.1','users','2015-06-01 12:50:16',0),(136,2,'logged in from: 127.0.0.1','users','2015-06-01 12:50:17',0),(137,1,'logged in from: 127.0.0.1','users','2015-06-01 13:27:41',0),(138,1,'logged in from: 127.0.0.1','users','2015-06-02 04:03:58',0),(139,1,'logged in from: 127.0.0.1','users','2015-06-02 04:04:18',0),(140,1,'logged in from: 127.0.0.1','users','2015-06-02 04:14:26',0),(141,1,'logged in from: 127.0.0.1','users','2015-06-02 04:53:31',0),(142,1,'Created record with ID: 5 : 127.0.0.1','banner','2015-06-02 05:43:31',0),(143,1,'Updated record with ID: 1 : 127.0.0.1','banner','2015-06-02 05:56:27',0),(144,1,'Updated record with ID: 1 : 127.0.0.1','category','2015-06-02 06:15:47',0),(145,1,'Updated record with ID: 1 : 127.0.0.1','category','2015-06-02 06:18:09',0),(146,1,'Updated record with ID: 1 : 127.0.0.1','category','2015-06-02 06:24:36',0),(147,1,'Created record with ID: 3 : 127.0.0.1','category','2015-06-02 06:25:47',0),(148,1,'Updated record with ID: 1 : 127.0.0.1','category','2015-06-02 06:34:39',0),(149,1,'Created Module: sac : 127.0.0.1','modulebuilder','2015-06-02 08:42:24',0),(150,1,'Deleted Module: sac : 127.0.0.1','builder','2015-06-02 08:47:24',0),(151,1,'Created Module: sac : 127.0.0.1','modulebuilder','2015-06-02 08:48:27',0),(152,1,'Deleted Module: sac : 127.0.0.1','builder','2015-06-02 08:49:15',0),(153,1,'Created Module: uih : 127.0.0.1','modulebuilder','2015-06-02 08:50:23',0),(154,1,'Deleted Module: uih : 127.0.0.1','builder','2015-06-02 08:53:52',0),(155,1,'Created record with ID: 6 : 127.0.0.1','banner','2015-06-02 09:00:13',0),(156,1,'Created record with ID: 7 : 127.0.0.1','banner','2015-06-02 09:00:30',0),(157,1,'Created record with ID: 8 : 127.0.0.1','banner','2015-06-02 09:00:30',0),(158,1,'logged in from: 127.0.0.1','users','2015-06-02 09:39:06',0),(159,1,'Created Module: test : 127.0.0.1','modulebuilder','2015-06-02 09:40:57',0),(160,1,'Deleted Module: test : 127.0.0.1','builder','2015-06-02 09:48:40',0),(161,1,'logged in from: 127.0.0.1','users','2015-06-02 09:51:03',0),(162,1,'Updated record with ID: 3 : 127.0.0.1','category','2015-06-02 09:55:09',0),(163,1,'Created Module: test : 127.0.0.1','modulebuilder','2015-06-02 09:59:41',0),(164,1,'Deleted Module: test : 127.0.0.1','builder','2015-06-02 10:01:06',0),(165,1,'Created record with ID: 9 : 127.0.0.1','banner','2015-06-02 13:01:13',0),(166,1,'logged in from: 127.0.0.1','users','2015-06-03 03:57:10',0),(167,1,'logged in from: 127.0.0.1','users','2015-06-03 04:15:33',0),(168,1,'App settings saved from: 127.0.0.1','core','2015-06-03 04:50:06',0),(169,1,'Created Module: dsfy : 127.0.0.1','modulebuilder','2015-06-03 05:12:20',0),(170,1,'Created record with ID: 1 : 127.0.0.1','dsfy','2015-06-03 05:13:00',0),(171,1,'App settings saved from: 127.0.0.1','core','2015-06-03 05:31:14',0),(172,1,'App settings saved from: 127.0.0.1','core','2015-06-03 05:31:23',0),(173,1,'App settings saved from: 127.0.0.1','core','2015-06-03 05:31:34',0),(174,1,'App settings saved from: 127.0.0.1','core','2015-06-03 05:32:20',0),(175,1,'App settings saved from: 127.0.0.1','core','2015-06-03 05:43:56',0),(176,1,'App settings saved from: 127.0.0.1','core','2015-06-03 05:49:01',0),(177,1,'App settings saved from: 127.0.0.1','core','2015-06-03 05:53:36',0),(178,1,'logged in from: 127.0.0.1','users','2015-06-03 06:08:23',0),(179,1,'App settings saved from: 127.0.0.1','core','2015-06-03 06:11:02',0),(180,1,'App settings saved from: 127.0.0.1','core','2015-06-03 06:13:20',0),(181,1,'App settings saved from: 127.0.0.1','core','2015-06-03 06:23:37',0),(182,1,'App settings saved from: 127.0.0.1','core','2015-06-03 06:24:59',0),(183,1,'App settings saved from: 127.0.0.1','core','2015-06-03 06:28:22',0),(184,1,'App settings saved from: 127.0.0.1','core','2015-06-03 06:30:24',0),(185,1,'App settings saved from: 127.0.0.1','core','2015-06-03 06:30:28',0),(186,1,'App settings saved from: 127.0.0.1','core','2015-06-03 06:31:36',0),(187,1,'App settings saved from: 127.0.0.1','core','2015-06-03 06:35:26',0),(188,1,'App settings saved from: 127.0.0.1','core','2015-06-03 06:45:13',0),(189,1,'App settings saved from: 127.0.0.1','core','2015-06-03 06:45:19',0),(190,1,'App settings saved from: 127.0.0.1','core','2015-06-03 06:45:24',0),(191,1,'App settings saved from: 127.0.0.1','core','2015-06-03 06:45:27',0),(192,1,'App settings saved from: 127.0.0.1','core','2015-06-03 06:45:32',0),(193,1,'Created Module: test : 127.0.0.1','modulebuilder','2015-06-03 07:06:11',0),(194,1,'Created record with ID: 1 : 127.0.0.1','test','2015-06-03 07:06:27',0),(195,1,'Created record with ID: 2 : 127.0.0.1','test','2015-06-03 07:06:28',0),(196,1,'Created record with ID: 3 : 127.0.0.1','test','2015-06-03 07:06:34',0),(197,1,'Deleted Module: test : 127.0.0.1','builder','2015-06-03 07:14:32',0),(198,1,'Created Module: test : 127.0.0.1','modulebuilder','2015-06-03 07:24:33',0),(199,1,'Created record with ID: 1 : 127.0.0.1','test','2015-06-03 07:25:16',0),(200,1,'Created record with ID: 2 : 127.0.0.1','test','2015-06-03 07:26:05',0),(201,1,'Created record with ID: 3 : 127.0.0.1','test','2015-06-03 07:28:30',0),(202,1,'Created record with ID: 4 : 127.0.0.1','test','2015-06-03 07:28:30',0),(203,1,'Created record with ID: 5 : 127.0.0.1','test','2015-06-03 07:32:28',0),(204,1,'Created record with ID: 6 : 127.0.0.1','test','2015-06-03 07:32:42',0),(205,1,'logged in from: 127.0.0.1','users','2015-06-03 07:49:32',0),(206,1,'Deleted Module: test : 127.0.0.1','builder','2015-06-03 07:51:47',0),(207,1,'logged in from: 127.0.0.1','users','2015-06-03 07:51:50',0),(208,1,'logged in from: 127.0.0.1','users','2015-06-03 07:52:27',0),(209,1,'Deleted Module: Refer_Friend : 127.0.0.1','builder','2015-06-03 09:38:26',0),(210,1,'Created record with ID: 3 : 127.0.0.1','menu','2015-06-03 09:45:43',0),(211,1,'Created Module: test : 127.0.0.1','modulebuilder','2015-06-03 09:58:23',0),(212,1,'Created record with ID: 1 : 127.0.0.1','test','2015-06-03 09:58:36',0),(213,1,'Created Module: test : 127.0.0.1','modulebuilder','2015-06-03 09:59:51',0),(214,1,'Deleted Module: test : 127.0.0.1','builder','2015-06-03 10:00:07',0),(215,1,'Created Module: test : 127.0.0.1','modulebuilder','2015-06-03 10:01:07',0),(216,1,'Created record with ID: 1 : 127.0.0.1','test','2015-06-03 10:01:19',0),(217,1,'Deleted Module: test : 127.0.0.1','builder','2015-06-03 10:01:50',0),(218,1,'logged in from: 127.0.0.1','users','2015-06-03 10:01:48',0),(219,1,'logged in from: 127.0.0.1','users','2015-06-03 10:03:33',0),(220,1,'Deleted Module: dsfy : 127.0.0.1','builder','2015-06-03 10:03:40',0),(221,1,'logged in from: 127.0.0.1','users','2015-06-03 10:59:44',0),(222,1,'logged in from: 127.0.0.1','users','2015-06-03 12:02:20',0),(223,1,'logged in from: 127.0.0.1','users','2015-06-03 12:05:40',0),(224,1,'Created Module: test : 127.0.0.1','modulebuilder','2015-06-03 12:11:03',0),(225,1,'Created record with ID: 1 : 127.0.0.1','test','2015-06-03 12:11:24',0),(226,1,'Created record with ID: 2 : 127.0.0.1','test','2015-06-03 12:11:29',0),(227,1,'Deleted Module: test : 127.0.0.1','builder','2015-06-03 12:12:25',0),(228,1,'Created Module: test : 127.0.0.1','modulebuilder','2015-06-03 12:14:57',0),(229,1,'logged in from: 127.0.0.1','users','2015-06-03 12:15:50',0),(230,1,'Created record with ID: 1 : 127.0.0.1','test','2015-06-03 12:16:18',0),(231,1,'Created Module: testtestestsest : 127.0.0.1','modulebuilder','2015-06-03 12:16:40',0),(232,1,'Deleted Module: test : 127.0.0.1','builder','2015-06-03 12:18:43',0),(233,1,'logged in from: 127.0.0.1','users','2015-06-04 04:30:41',0),(234,1,'Created Module: product : 127.0.0.1','modulebuilder','2015-06-04 04:35:00',0),(235,1,'Deleted Module: product : 127.0.0.1','builder','2015-06-04 04:35:30',0),(236,1,'Created Module: Product : 127.0.0.1','modulebuilder','2015-06-04 04:40:39',0),(237,1,'Created record with ID: 1 : 127.0.0.1','product','2015-06-04 04:41:13',0),(238,1,'Created record with ID: 2 : 127.0.0.1','product','2015-06-04 04:41:26',0),(239,1,'Created record with ID: 3 : 127.0.0.1','product','2015-06-04 04:41:39',0),(240,1,'logged in from: 127.0.0.1','users','2015-06-05 03:52:48',0),(241,1,'Created Module: cloth type : 127.0.0.1','modulebuilder','2015-06-05 05:20:48',0),(242,1,'Created record with ID: 1 : 127.0.0.1','cloth_type','2015-06-05 05:21:07',0),(243,1,'Deleted Module: cloth_type : 127.0.0.1','builder','2015-06-05 05:22:16',0),(244,1,'Created Module: cloth : 127.0.0.1','modulebuilder','2015-06-05 05:32:45',0),(245,1,'Created record with ID: 1 : 127.0.0.1','cloth','2015-06-05 05:32:54',0),(246,1,'Created record with ID: 2 : 127.0.0.1','cloth','2015-06-05 05:32:57',0),(247,1,'Created record with ID: 3 : 127.0.0.1','cloth','2015-06-05 05:33:00',0),(248,1,'Deleted Module: cloth : 127.0.0.1','builder','2015-06-05 05:43:25',0),(249,1,'logged in from: 127.0.0.1','users','2015-06-05 12:04:22',0),(250,1,'logged in from: 127.0.0.1','users','2015-06-05 12:09:40',0),(251,1,'logged in from: 127.0.0.1','users','2015-06-06 05:29:34',0),(252,1,'logged in from: 127.0.0.1','users','2015-06-06 11:26:07',0),(253,1,'logged in from: 127.0.0.1','users','2015-06-06 11:28:45',0),(254,1,'logged in from: 127.0.0.1','users','2015-06-08 09:12:19',0),(255,1,'logged in from: 127.0.0.1','users','2015-06-09 04:48:29',0),(256,1,'logged in from: 127.0.0.1','users','2015-06-09 12:59:52',0),(257,1,'logged in from: 127.0.0.1','users','2015-06-12 05:38:09',0),(258,1,'logged in from: 127.0.0.1','users','2015-06-12 05:39:42',0),(259,1,'logged in from: 127.0.0.1','users','2015-06-12 05:52:30',0),(260,1,'Created Module: f : 127.0.0.1','modulebuilder','2015-06-12 05:59:06',0),(261,1,'Deleted Module: f : 127.0.0.1','builder','2015-06-12 05:59:29',0),(262,1,'logged in from: 127.0.0.1','users','2015-06-12 10:42:04',0),(263,1,'logged in from: 127.0.0.1','users','2015-06-19 04:06:39',0),(264,1,'logged in from: 127.0.0.1','users','2015-06-19 04:49:51',0),(265,1,'logged in from: 127.0.0.1','users','2015-06-19 07:48:01',0),(266,1,'Created Module: test : 127.0.0.1','modulebuilder','2015-06-19 07:50:48',0),(267,1,'Created record with ID: 1 : 127.0.0.1','test','2015-06-19 07:51:26',0),(268,1,'Created record with ID: 2 : 127.0.0.1','test','2015-06-19 07:51:58',0),(269,1,'Created record with ID: 3 : 127.0.0.1','test','2015-06-19 08:14:24',0),(270,1,'Created record with ID: 10 : 127.0.0.1','banner','2015-06-19 08:18:48',0),(271,1,'Updated record with ID: 10 : 127.0.0.1','banner','2015-06-19 08:19:20',0),(272,1,'Created record with ID: 4 : 127.0.0.1','test','2015-06-19 08:27:31',0),(273,1,'Created Module: facebook : 127.0.0.1','modulebuilder','2015-06-19 08:36:03',0),(274,1,'Created record with ID: 1 : 127.0.0.1','facebook','2015-06-19 08:53:47',0),(275,1,'Updated record with ID: 3 : 127.0.0.1','category','2015-06-19 09:11:39',0),(276,1,'Updated record with ID: 3 : 127.0.0.1','category','2015-06-19 09:12:34',0),(277,1,'Updated record with ID: 3 : 127.0.0.1','category','2015-06-19 09:21:54',0),(278,1,'Updated record with ID: 3 : 127.0.0.1','category','2015-06-19 09:29:38',0),(279,1,'Updated record with ID: 1 : 127.0.0.1','facebook','2015-06-19 09:33:53',0),(280,1,'Created record with ID: 2 : 127.0.0.1','facebook','2015-06-19 09:39:04',0),(281,1,'Created record with ID: 3 : 127.0.0.1','facebook','2015-06-19 09:39:39',0),(282,1,'Created record with ID: 5 : 127.0.0.1','test','2015-06-19 09:50:53',0),(283,1,'Created Module: sport : 127.0.0.1','modulebuilder','2015-06-19 11:20:27',0),(284,1,'Deleted Module: sport : 127.0.0.1','builder','2015-06-19 11:21:54',0),(285,1,'Created Module: sport : 127.0.0.1','modulebuilder','2015-06-19 11:23:07',0),(286,1,'Created Module: sport : 127.0.0.1','modulebuilder','2015-06-19 11:23:13',0),(287,1,'Created record with ID: 1 : 127.0.0.1','sport','2015-06-19 11:23:27',0),(288,1,'logged in from: 127.0.0.1','users','2015-06-23 08:19:18',0),(289,1,'logged in from: 127.0.0.1','users','2015-11-10 03:18:28',0),(290,1,'modified user: Super Admin','users','2015-11-10 03:49:29',0),(291,1,'logged in from: 127.0.0.1','users','2015-11-10 03:50:38',0),(292,1,'modified user: Admin','users','2015-11-10 03:53:21',0),(293,2,'logged in from: ::1','users','2015-12-02 04:42:26',0),(294,2,'logged in from: ::1','users','2015-12-02 06:05:20',0),(295,2,'Created record with ID: 11 : ::1','banner','2015-12-02 06:06:35',0),(296,2,'logged in from: ::1','users','2015-12-02 06:15:37',0),(297,2,'FIXME (\"bf_common_act_create_record\"): 2 : ::1','pages','2015-12-02 06:19:10',0),(298,2,'logged in from: ::1','users','2015-12-02 07:27:00',0),(299,2,'Created Module: test_bijal : ::1','modulebuilder','2015-12-02 07:29:24',0),(300,2,'Created record with ID: 1 : ::1','test_bijal','2015-12-02 07:29:53',0),(301,2,'Created record with ID: 2 : ::1','test_bijal','2015-12-02 07:29:57',0),(302,2,'Migrate Type: test_bijal_ Uninstalled Version: 0 from: ::1','migrations','2015-12-02 07:30:21',0),(303,2,'Migration module: test_bijal Version: 0 from: ::1','migrations','2015-12-02 07:30:21',0),(304,2,'Deleted Module: test_bijal : ::1','builder','2015-12-02 07:31:04',0),(305,2,'Migrate Type: user_master_ to Version: 1 from: ::1','migrations','2015-12-11 07:47:15',0),(306,2,'Migration module: user_master Version: 1 from: ::1','migrations','2015-12-11 07:47:15',0),(307,2,'logged in from: ::1','users','2015-12-11 07:53:48',0),(308,1,'logged in from: ::1','users','2015-12-11 08:03:42',0),(309,1,'logged in from: ::1','users','2015-12-11 08:57:10',0),(310,1,'logged in from: ::1','users','2016-01-22 10:53:14',0),(311,1,'logged in from: ::1','users','2016-01-22 11:02:27',0),(312,1,'logged in from: ::1','users','2016-01-22 11:03:03',0),(313,1,'logged in from: ::1','users','2016-01-22 11:11:10',0),(314,1,'logged in from: ::1','users','2016-01-22 11:11:22',0),(315,2,'logged in from: ::1','users','2016-03-16 12:35:05',0),(316,2,'logged in from: ::1','users','2016-04-28 12:08:51',0),(317,2,'Created Module: BRCategory : ::1','modulebuilder','2016-04-28 12:17:38',0),(318,2,'Deleted Module: BRCategory : ::1','builder','2016-04-28 12:18:16',0),(319,2,'Created Module: Category_BR : ::1','modulebuilder','2016-04-28 12:21:42',0),(320,2,'Created record with ID: 1 : ::1','category_br','2016-04-28 12:23:55',0),(321,2,'Deleted Module: Category_BR : ::1','builder','2016-04-28 12:31:53',0),(322,2,'Deleted Module: Category : ::1','builder','2016-04-28 12:33:32',0),(323,2,'Created Module: Category : ::1','modulebuilder','2016-04-28 12:34:54',0),(324,2,'Deleted Module: Category : ::1','builder','2016-04-28 12:35:10',0),(325,2,'Created Module: Category : ::1','modulebuilder','2016-04-28 12:36:12',0),(326,2,'Created record with ID: 1 : ::1','category','2016-04-28 12:37:12',0),(327,2,'Updated record with ID: 1 : ::1','category','2016-04-28 12:37:17',0),(328,2,'Created Module: Advertisement Banner : ::1','modulebuilder','2016-04-28 12:43:37',0),(329,2,'Deleted Module: Category : ::1','builder','2016-04-28 12:45:14',0),(330,2,'Deleted Module: Advertisement_Banner : ::1','builder','2016-04-28 12:45:17',0),(331,2,'logged in from: ::1','users','2016-05-05 09:33:30',0),(332,1,'logged in from: ::1','users','2016-05-05 10:39:09',0),(333,2,'logged in from: ::1','users','2016-05-05 10:46:13',0),(334,2,'logged in from: ::1','users','2016-05-05 11:04:56',0),(335,2,'Migrate Type: country_master_ to Version: 1 from: ::1','migrations','2016-05-05 11:05:12',0),(336,2,'Migration module: country_master Version: 1 from: ::1','migrations','2016-05-05 11:05:12',0),(337,2,'Migrate Type: country_master_ Uninstalled Version: 0 from: ::1','migrations','2016-05-05 11:06:05',0),(338,2,'Migration module: country_master Version: 0 from: ::1','migrations','2016-05-05 11:06:06',0),(339,2,'Migrate Type: country_master_ to Version: 1 from: ::1','migrations','2016-05-05 11:06:16',0),(340,2,'Migration module: country_master Version: 1 from: ::1','migrations','2016-05-05 11:06:16',0),(341,2,'logged in from: ::1','users','2016-05-05 11:08:38',0),(342,1,'logged in from: ::1','users','2016-05-05 11:09:08',0),(343,2,'logged in from: ::1','users','2016-05-05 11:10:09',0),(344,2,'Created Module: Category Applicable Master : ::1','modulebuilder','2016-05-05 11:19:44',0),(345,2,'Created Module: Category Regional Master : ::1','modulebuilder','2016-05-05 11:31:49',0),(346,2,'Created Module: Category National Master : ::1','modulebuilder','2016-05-05 12:00:20',0),(347,2,'Created Module: Customer Type Regional : ::1','modulebuilder','2016-05-05 12:15:31',0),(348,2,'logged in from: ::1','users','2016-05-09 07:13:03',0),(349,2,'logged in from: ::1','users','2016-05-11 10:34:36',0),(350,2,'logged in from: ::1','users','2016-05-12 04:50:34',0),(351,2,'logged in from: ::1','users','2016-05-14 05:51:26',0),(352,2,'logged in from: ::1','users','2016-05-15 06:18:31',0),(353,2,'created a new Head Officer: HO India','users','2016-05-15 08:52:58',0),(354,45,'logged in from: ::1','users','2016-05-15 09:20:06',0),(355,2,'logged in from: ::1','users','2016-05-15 12:13:46',0),(356,45,'logged in from: ::1','users','2016-05-16 05:21:12',0),(357,45,'logged in from: ::1','users','2016-05-16 13:23:36',0),(358,45,'logged in from: ::1','users','2016-05-16 16:03:10',0),(359,45,'logged in from: ::1','users','2016-05-17 05:33:57',0),(360,45,'logged in from: ::1','users','2016-05-17 12:55:29',0),(361,45,'logged in from: ::1','users','2016-05-18 05:51:15',0),(362,45,'logged in from: ::1','users','2016-05-18 06:21:13',0),(363,45,'logged in from: ::1','users','2016-05-18 06:38:18',0),(364,45,'logged in from: ::1','users','2016-05-18 10:34:07',0),(365,45,'logged in from: ::1','users','2016-05-18 16:02:43',0),(366,45,'logged in from: ::1','users','2016-05-18 14:30:29',0),(367,45,'logged in from: ::1','users','2016-05-19 05:31:03',0),(368,45,'logged in from: ::1','users','2016-05-19 08:25:49',0),(369,45,'logged in from: ::1','users','2016-05-19 12:05:57',0),(370,45,'logged in from: ::1','users','2016-05-20 06:51:31',0),(371,9,'logged in from: ::1','users','2016-05-20 07:18:32',0),(372,45,'logged in from: ::1','users','2016-05-20 05:25:28',0),(373,45,'logged in from: ::1','users','2016-05-20 07:42:06',0),(374,9,'logged in from: ::1','users','2016-05-20 07:43:01',0),(375,9,'logged in from: ::1','users','2016-05-20 06:32:16',0),(376,45,'logged in from: ::1','users','2016-05-20 08:44:04',0),(377,45,'logged in from: ::1','users','2016-05-20 08:57:42',0),(378,45,'logged in from: ::1','users','2016-05-20 08:58:03',0),(379,45,'logged in from: ::1','users','2016-05-20 11:11:07',0),(380,9,'logged in from: ::1','users','2016-05-20 11:18:04',0),(381,45,'logged in from: ::1','users','2016-05-20 12:05:04',0),(382,45,'logged in from: ::1','users','2016-05-20 12:06:23',0),(383,19,'logged in from: ::1','users','2016-05-20 12:06:47',0),(384,18,'logged in from: ::1','users','2016-05-20 12:13:30',0),(385,19,'logged in from: ::1','users','2016-05-20 12:13:58',0),(386,45,'logged in from: ::1','users','2016-05-20 13:59:12',0),(387,20,'logged in from: ::1','users','2016-05-20 16:05:27',0),(388,9,'logged in from: ::1','users','2016-05-20 14:48:11',0),(389,20,'logged in from: ::1','users','2016-05-21 07:28:32',0),(390,9,'logged in from: ::1','users','2016-05-23 05:28:42',0),(391,20,'logged in from: ::1','users','2016-05-23 07:58:55',0),(392,23,'logged in from: ::1','users','2016-05-23 07:49:14',0),(393,20,'logged in from: ::1','users','2016-05-23 09:45:51',0),(394,20,'logged in from: ::1','users','2016-05-23 14:58:08',0),(395,9,'logged in from: ::1','users','2016-05-23 17:16:47',0),(396,14,'logged in from: ::1','users','2016-05-23 17:17:51',0),(397,14,'logged in from: ::1','users','2016-05-23 17:19:38',0),(398,20,'logged in from: ::1','users','2016-05-24 05:17:31',0),(399,12,'logged in from: ::1','users','2016-05-24 06:08:51',0),(400,20,'logged in from: ::1','users','2016-05-24 06:45:43',0),(401,12,'logged in from: ::1','users','2016-05-24 06:45:55',0),(402,14,'logged in from: ::1','users','2016-05-24 07:00:11',0),(403,20,'logged in from: ::1','users','2016-05-24 07:04:06',0),(404,9,'logged in from: ::1','users','2016-05-24 07:06:41',0),(405,20,'logged in from: ::1','users','2016-05-24 09:14:12',0),(406,20,'logged in from: ::1','users','2016-05-24 07:29:34',0),(407,14,'logged in from: ::1','users','2016-05-24 07:39:58',0),(408,14,'logged in from: ::1','users','2016-05-24 07:46:43',0),(409,20,'logged in from: ::1','users','2016-05-24 07:46:51',0),(410,45,'logged in from: ::1','users','2016-05-24 09:16:09',0),(411,9,'logged in from: ::1','users','2016-05-24 09:16:25',0),(412,20,'logged in from: ::1','users','2016-05-24 10:14:36',0),(413,45,'logged in from: ::1','users','2016-05-24 10:30:51',0),(414,20,'logged in from: ::1','users','2016-05-24 10:31:29',0),(415,20,'logged in from: ::1','users','2016-05-24 15:25:27',0),(416,45,'logged in from: ::1','users','2016-05-24 16:45:07',0),(417,45,'logged in from: ::1','users','2016-05-25 07:10:12',0),(418,9,'logged in from: ::1','users','2016-05-25 10:00:08',0),(419,14,'logged in from: ::1','users','2016-05-25 11:08:03',0),(420,20,'logged in from: ::1','users','2016-05-25 11:11:50',0),(421,9,'logged in from: ::1','users','2016-05-25 16:30:24',0),(422,9,'logged in from: ::1','users','2016-05-25 16:56:27',0),(423,45,'logged in from: ::1','users','2016-05-26 07:17:28',0),(424,9,'logged in from: ::1','users','2016-05-26 07:30:39',0),(425,20,'logged in from: ::1','users','2016-05-26 11:25:23',0),(426,9,'logged in from: ::1','users','2016-05-26 11:35:21',0),(427,9,'logged in from: ::1','users','2016-05-26 11:38:59',0),(428,14,'logged in from: ::1','users','2016-05-26 12:16:43',0),(429,9,'logged in from: ::1','users','2016-05-26 12:51:33',0),(430,20,'logged in from: ::1','users','2016-05-26 13:12:38',0),(431,4,'logged in from: ::1','users','2016-05-26 13:16:40',0),(432,20,'logged in from: ::1','users','2016-05-26 13:17:36',0),(433,14,'logged in from: ::1','users','2016-05-26 13:19:01',0),(434,19,'logged in from: ::1','users','2016-05-26 13:19:43',0),(435,9,'logged in from: ::1','users','2016-05-26 13:24:54',0),(436,14,'logged in from: ::1','users','2016-05-26 13:52:25',0),(437,45,'logged in from: ::1','users','2016-05-26 14:06:07',0),(438,45,'logged in from: ::1','users','2016-05-27 07:06:55',0),(439,20,'logged in from: ::1','users','2016-05-27 08:30:34',0),(440,9,'logged in from: ::1','users','2016-05-27 13:47:46',0),(441,14,'logged in from: ::1','users','2016-05-27 14:57:24',0),(442,45,'logged in from: ::1','users','2016-05-27 15:52:20',0),(443,45,'logged in from: ::1','users','2016-05-28 07:33:30',0),(444,20,'logged in from: ::1','users','2016-05-28 12:30:05',0),(445,9,'logged in from: ::1','users','2016-05-28 12:34:50',0),(446,14,'logged in from: ::1','users','2016-05-28 12:41:36',0),(447,45,'logged in from: ::1','users','2016-05-28 12:42:23',0),(448,9,'logged in from: ::1','users','2016-05-28 12:55:17',0),(449,9,'logged in from: ::1','users','2016-05-28 13:40:37',0),(450,9,'logged in from: ::1','users','2016-05-28 16:51:01',0),(451,9,'logged in from: ::1','users','2016-05-30 07:28:29',0),(452,20,'logged in from: ::1','users','2016-05-30 05:32:02',0),(453,45,'logged in from: ::1','users','2016-05-30 05:33:52',0),(454,9,'logged in from: ::1','users','2016-05-30 05:42:32',0),(455,20,'logged in from: ::1','users','2016-05-30 05:45:58',0),(456,9,'logged in from: ::1','users','2016-05-30 05:49:58',0),(457,20,'logged in from: ::1','users','2016-05-30 06:04:17',0),(458,45,'logged in from: ::1','users','2016-05-30 09:56:24',0),(459,45,'logged in from: ::1','users','2016-05-30 09:43:46',0),(460,20,'logged in from: 127.0.0.1','users','2016-05-30 10:29:50',0),(461,45,'logged in from: ::1','users','2016-05-30 10:30:00',0),(462,45,'logged in from: ::1','users','2016-05-30 13:49:06',0),(463,45,'logged in from: ::1','users','2016-05-30 13:33:09',0),(464,9,'logged in from: ::1','users','2016-05-30 14:02:56',0),(465,45,'logged in from: ::1','users','2016-05-30 14:17:42',0),(466,20,'logged in from: ::1','users','2016-05-30 14:18:05',0),(467,45,'logged in from: ::1','users','2016-05-30 16:30:34',0),(468,45,'logged in from: ::1','users','2016-05-30 14:32:07',0),(469,20,'logged in from: ::1','users','2016-05-31 05:19:37',0),(470,45,'logged in from: ::1','users','2016-05-31 05:45:58',0),(471,45,'logged in from: ::1','users','2016-05-31 08:06:37',0),(472,20,'logged in from: ::1','users','2016-05-31 07:00:51',0),(473,20,'logged in from: ::1','users','2016-05-31 07:34:22',0),(474,45,'logged in from: ::1','users','2016-05-31 07:36:11',0),(475,20,'logged in from: ::1','users','2016-05-31 07:41:50',0),(476,9,'logged in from: ::1','users','2016-05-31 09:45:03',0),(477,20,'logged in from: ::1','users','2016-05-31 09:21:50',0),(478,45,'logged in from: ::1','users','2016-05-31 10:55:48',0),(479,20,'logged in from: ::1','users','2016-05-31 11:20:25',0),(480,45,'logged in from: ::1','users','2016-05-31 12:03:07',0),(481,9,'logged in from: ::1','users','2016-05-31 14:10:43',0),(482,14,'logged in from: ::1','users','2016-05-31 17:20:11',0),(483,45,'logged in from: ::1','users','2016-06-01 08:12:51',0),(484,45,'logged in from: ::1','users','2016-06-01 06:57:23',0),(485,45,'logged in from: ::1','users','2016-06-02 07:16:38',0),(486,45,'logged in from: ::1','users','2016-06-02 05:22:14',0),(487,9,'logged in from: ::1','users','2016-06-02 09:50:13',0),(488,45,'logged in from: ::1','users','2016-06-02 10:11:59',0),(489,9,'logged in from: ::1','users','2016-06-02 12:24:16',0),(490,45,'logged in from: ::1','users','2016-06-02 12:26:30',0),(491,45,'logged in from: ::1','users','2016-06-02 11:06:34',0),(492,45,'logged in from: ::1','users','2016-06-02 11:07:33',0),(493,20,'logged in from: ::1','users','2016-06-02 14:37:36',0),(494,45,'logged in from: ::1','users','2016-06-02 15:32:06',0),(495,20,'logged in from: ::1','users','2016-06-02 15:33:54',0),(496,45,'logged in from: ::1','users','2016-06-02 14:06:24',0),(497,45,'logged in from: ::1','users','2016-06-02 17:29:33',0),(498,20,'logged in from: ::1','users','2016-06-02 17:30:12',0),(499,45,'logged in from: ::1','users','2016-06-02 17:32:36',0),(500,20,'logged in from: ::1','users','2016-06-02 17:35:20',0),(501,45,'logged in from: ::1','users','2016-06-02 18:08:29',0),(502,20,'logged in from: ::1','users','2016-06-02 18:09:02',0),(503,45,'logged in from: ::1','users','2016-06-03 05:12:38',0),(504,45,'logged in from: ::1','users','2016-06-03 07:13:29',0),(505,20,'logged in from: ::1','users','2016-06-03 07:22:09',0),(506,45,'logged in from: ::1','users','2016-06-03 05:46:27',0),(507,45,'logged in from: ::1','users','2016-06-03 05:47:03',0),(508,9,'logged in from: ::1','users','2016-06-03 05:47:19',0),(509,9,'logged in from: ::1','users','2016-06-03 06:38:11',0),(510,14,'logged in from: ::1','users','2016-06-03 06:41:55',0),(511,9,'logged in from: ::1','users','2016-06-03 06:43:38',0),(512,14,'logged in from: ::1','users','2016-06-03 07:16:15',0),(513,20,'logged in from: ::1','users','2016-06-03 07:17:39',0),(514,45,'logged in from: ::1','users','2016-06-03 07:21:18',0),(515,9,'logged in from: ::1','users','2016-06-03 07:31:22',0),(516,45,'logged in from: ::1','users','2016-06-03 07:43:02',0),(517,9,'logged in from: ::1','users','2016-06-03 07:43:23',0),(518,14,'logged in from: ::1','users','2016-06-03 07:44:41',0),(519,9,'logged in from: ::1','users','2016-06-03 13:52:03',0),(520,45,'logged in from: ::1','users','2016-06-03 11:55:33',0),(521,45,'logged in from: ::1','users','2016-06-03 13:55:44',0),(522,20,'logged in from: ::1','users','2016-06-03 13:56:07',0),(523,9,'logged in from: ::1','users','2016-06-03 11:56:25',0),(524,14,'logged in from: ::1','users','2016-06-03 11:57:16',0),(525,20,'logged in from: ::1','users','2016-06-03 11:57:49',0),(526,20,'logged in from: ::1','users','2016-06-03 12:01:26',0),(527,45,'logged in from: ::1','users','2016-06-03 14:01:23',0),(528,20,'logged in from: ::1','users','2016-06-03 14:01:46',0),(529,9,'logged in from: ::1','users','2016-06-03 14:02:24',0),(530,20,'logged in from: ::1','users','2016-06-03 12:06:00',0),(531,45,'logged in from: ::1','users','2016-06-03 12:23:43',0),(532,9,'logged in from: ::1','users','2016-06-03 12:24:37',0),(533,20,'logged in from: ::1','users','2016-06-03 12:27:50',0),(534,20,'logged in from: ::1','users','2016-06-03 12:40:20',0),(535,45,'logged in from: ::1','users','2016-06-03 13:04:58',0),(536,20,'logged in from: ::1','users','2016-06-03 13:38:43',0),(537,45,'logged in from: ::1','users','2016-06-03 14:08:34',0),(538,20,'logged in from: ::1','users','2016-06-03 14:32:46',0),(539,14,'logged in from: ::1','users','2016-06-03 14:40:44',0),(540,15,'logged in from: ::1','users','2016-06-03 14:48:03',0),(541,17,'logged in from: ::1','users','2016-06-03 14:48:17',0),(542,16,'logged in from: ::1','users','2016-06-03 14:48:34',0),(543,20,'logged in from: ::1','users','2016-06-03 15:12:51',0),(544,9,'logged in from: ::1','users','2016-06-06 07:06:59',0),(545,20,'logged in from: ::1','users','2016-06-06 05:40:09',0),(546,9,'logged in from: ::1','users','2016-06-06 05:45:47',0),(547,20,'logged in from: ::1','users','2016-06-06 06:02:35',0),(548,9,'logged in from: ::1','users','2016-06-06 06:25:09',0),(549,45,'logged in from: ::1','users','2016-06-06 09:47:29',0),(550,20,'logged in from: ::1','users','2016-06-06 09:48:16',0),(551,45,'logged in from: ::1','users','2016-06-06 11:18:19',0),(552,20,'logged in from: ::1','users','2016-06-06 10:18:32',0),(553,45,'logged in from: ::1','users','2016-06-06 11:10:35',0),(554,20,'logged in from: ::1','users','2016-06-06 11:33:38',0),(555,45,'logged in from: ::1','users','2016-06-06 12:53:08',0),(556,9,'logged in from: ::1','users','2016-06-06 12:57:36',0),(557,9,'logged in from: ::1','users','2016-06-06 15:19:01',0),(558,14,'logged in from: ::1','users','2016-06-06 13:30:43',0),(559,45,'logged in from: ::1','users','2016-06-06 16:20:51',0),(560,9,'logged in from: ::1','users','2016-06-06 15:00:21',0),(561,45,'logged in from: ::1','users','2016-06-07 04:50:41',0),(562,9,'logged in from: ::1','users','2016-06-07 04:57:32',0),(563,14,'logged in from: ::1','users','2016-06-07 05:02:16',0),(564,9,'logged in from: ::1','users','2016-06-07 05:17:01',0),(565,2,'logged in from: ::1','users','2016-06-07 05:34:49',0),(566,20,'logged in from: ::1','users','2016-06-07 05:39:30',0),(567,45,'logged in from: ::1','users','2016-06-07 05:40:39',0),(568,45,'logged in from: ::1','users','2016-06-07 07:45:59',0),(569,9,'logged in from: ::1','users','2016-06-07 07:47:49',0),(570,45,'logged in from: ::1','users','2016-06-07 07:50:04',0),(571,20,'logged in from: ::1','users','2016-06-07 05:53:06',0),(572,9,'logged in from: ::1','users','2016-06-07 05:53:13',0),(573,20,'logged in from: ::1','users','2016-06-07 05:54:55',0),(574,45,'logged in from: ::1','users','2016-06-07 05:55:15',0),(575,20,'logged in from: ::1','users','2016-06-07 07:22:49',0),(576,45,'logged in from: ::1','users','2016-06-07 10:19:26',0),(577,9,'logged in from: ::1','users','2016-06-07 10:19:51',0),(578,9,'logged in from: ::1','users','2016-06-07 10:24:17',0),(579,14,'logged in from: ::1','users','2016-06-07 10:25:25',0),(580,20,'logged in from: ::1','users','2016-06-07 10:25:48',0),(581,20,'logged in from: ::1','users','2016-06-07 11:09:09',0),(582,45,'logged in from: ::1','users','2016-06-07 11:15:20',0),(583,20,'logged in from: ::1','users','2016-06-07 11:16:24',0),(584,9,'logged in from: ::1','users','2016-06-07 11:21:16',0),(585,20,'logged in from: ::1','users','2016-06-07 11:30:01',0),(586,45,'logged in from: ::1','users','2016-06-07 11:45:53',0),(587,45,'logged in from: ::1','users','2016-06-07 11:51:39',0),(588,9,'logged in from: ::1','users','2016-06-07 11:55:19',0),(589,14,'logged in from: ::1','users','2016-06-07 11:56:09',0),(590,20,'logged in from: ::1','users','2016-06-07 11:56:32',0),(591,9,'logged in from: ::1','users','2016-06-07 12:12:45',0),(592,45,'logged in from: ::1','users','2016-06-07 12:43:51',0),(593,9,'logged in from: ::1','users','2016-06-07 12:44:42',0),(594,14,'logged in from: ::1','users','2016-06-07 12:45:33',0),(595,20,'logged in from: ::1','users','2016-06-07 12:46:53',0),(596,45,'logged in from: ::1','users','2016-06-07 12:52:50',0),(597,9,'logged in from: ::1','users','2016-06-07 12:53:43',0),(598,10,'logged in from: ::1','users','2016-06-07 13:13:44',0),(599,45,'logged in from: ::1','users','2016-06-07 13:14:25',0),(600,9,'logged in from: ::1','users','2016-06-07 13:34:29',0),(601,20,'logged in from: ::1','users','2016-06-07 13:34:55',0),(602,14,'logged in from: ::1','users','2016-06-07 14:01:58',0),(603,45,'logged in from: ::1','users','2016-06-07 14:02:30',0),(604,20,'logged in from: ::1','users','2016-06-07 14:06:04',0),(605,9,'logged in from: ::1','users','2016-06-07 14:08:15',0),(606,20,'logged in from: ::1','users','2016-06-07 15:04:29',0),(607,9,'logged in from: ::1','users','2016-06-07 15:11:35',0),(608,20,'logged in from: ::1','users','2016-06-07 15:19:33',0),(609,14,'logged in from: ::1','users','2016-06-07 15:19:57',0),(610,20,'logged in from: ::1','users','2016-06-07 15:21:33',0),(611,45,'logged in from: ::1','users','2016-06-07 16:51:35',0),(612,20,'logged in from: ::1','users','2016-06-07 17:34:07',0),(613,14,'logged in from: ::1','users','2016-06-07 17:35:37',0),(614,9,'logged in from: ::1','users','2016-06-07 17:35:54',0),(615,14,'logged in from: ::1','users','2016-06-07 17:46:54',0),(616,20,'logged in from: ::1','users','2016-06-07 17:47:05',0),(617,45,'logged in from: ::1','users','2016-06-07 17:47:13',0),(618,14,'logged in from: ::1','users','2016-06-07 17:54:18',0),(619,9,'logged in from: ::1','users','2016-06-07 17:54:33',0),(620,45,'logged in from: ::1','users','2016-06-07 17:54:56',0),(621,14,'logged in from: ::1','users','2016-06-07 18:18:00',0),(622,9,'logged in from: ::1','users','2016-06-07 18:23:07',0),(623,45,'logged in from: ::1','users','2016-06-07 18:29:14',0),(624,20,'logged in from: ::1','users','2016-06-07 18:33:49',0),(625,14,'logged in from: ::1','users','2016-06-07 18:34:13',0),(626,9,'logged in from: ::1','users','2016-06-07 18:35:13',0),(627,20,'logged in from: ::1','users','2016-06-07 19:07:39',0),(628,45,'logged in from: ::1','users','2016-06-07 19:07:47',0),(629,20,'logged in from: ::1','users','2016-06-08 05:59:55',0),(630,45,'logged in from: ::1','users','2016-06-08 06:05:37',0),(631,45,'logged in from: ::1','users','2016-06-08 08:16:32',0),(632,9,'logged in from: ::1','users','2016-06-08 18:23:32',0),(633,14,'logged in from: ::1','users','2016-06-08 19:39:32',0),(634,9,'logged in from: ::1','users','2016-06-08 17:45:02',0),(635,45,'logged in from: ::1','users','2016-06-08 17:50:01',0),(636,9,'logged in from: ::1','users','2016-06-08 17:50:51',0),(637,45,'logged in from: ::1','users','2016-06-08 17:59:31',0),(638,9,'logged in from: ::1','users','2016-06-08 18:20:40',0),(639,45,'logged in from: ::1','users','2016-06-08 20:22:48',0),(640,20,'logged in from: ::1','users','2016-06-08 21:40:16',0),(641,45,'logged in from: ::1','users','2016-06-08 22:04:32',0),(642,9,'logged in from: ::1','users','2016-06-09 06:32:42',0),(643,45,'logged in from: ::1','users','2016-06-09 08:49:59',0),(644,20,'logged in from: ::1','users','2016-06-09 07:43:16',0),(645,9,'logged in from: ::1','users','2016-06-09 09:35:45',0),(646,20,'logged in from: ::1','users','2016-06-09 09:36:07',0),(647,2,'logged in from: ::1','users','2016-06-09 11:44:08',0),(648,2,'Migrate Type: web_service_ to Version: 1 from: ::1','migrations','2016-06-09 11:44:25',0),(649,2,'Migration module: web_service Version: 1 from: ::1','migrations','2016-06-09 11:44:25',0),(650,45,'logged in from: ::1','users','2016-06-09 10:12:03',0),(651,45,'logged in from: ::1','users','2016-06-09 10:12:53',0),(652,45,'logged in from: ::1','users','2016-06-09 10:38:59',0),(653,20,'logged in from: ::1','users','2016-06-09 10:41:13',0),(654,45,'logged in from: ::1','users','2016-06-09 12:31:03',0),(655,45,'logged in from: ::1','users','2016-06-09 15:22:43',0),(656,45,'logged in from: ::1','users','2016-06-09 13:25:58',0),(657,20,'logged in from: ::1','users','2016-06-09 13:30:49',0),(658,45,'logged in from: ::1','users','2016-06-09 14:33:11',0),(659,20,'logged in from: ::1','users','2016-06-09 16:03:09',0),(660,9,'logged in from: ::1','users','2016-06-09 17:27:19',0),(661,20,'logged in from: ::1','users','2016-06-09 17:38:12',0),(662,14,'logged in from: ::1','users','2016-06-09 17:41:39',0),(663,45,'logged in from: ::1','users','2016-06-09 18:07:35',0),(664,45,'logged in from: ::1','users','2016-06-09 20:20:52',0),(665,45,'logged in from: ::1','users','2016-06-10 06:55:35',0),(666,45,'logged in from: ::1','users','2016-06-10 05:00:43',0),(667,9,'logged in from: ::1','users','2016-06-10 07:21:50',0),(668,45,'logged in from: ::1','users','2016-06-10 07:45:14',0),(669,9,'logged in from: ::1','users','2016-06-10 08:08:10',0),(670,45,'logged in from: ::1','users','2016-06-10 06:19:10',0),(671,14,'logged in from: ::1','users','2016-06-10 08:19:33',0),(672,45,'logged in from: ::1','users','2016-06-10 09:51:57',0),(673,45,'logged in from: ::1','users','2016-06-10 10:04:52',0),(674,20,'logged in from: ::1','users','2016-06-10 15:05:07',0),(675,9,'logged in from: ::1','users','2016-06-10 14:26:21',0),(676,45,'logged in from: ::1','users','2016-06-10 14:27:10',0),(677,9,'logged in from: ::1','users','2016-06-10 14:51:16',0),(678,45,'logged in from: ::1','users','2016-06-10 14:58:37',0),(679,45,'logged in from: ::1','users','2016-06-11 04:47:50',0),(680,9,'logged in from: ::1','users','2016-06-11 06:36:16',0),(681,20,'logged in from: ::1','users','2016-06-11 06:58:59',0),(682,14,'logged in from: ::1','users','2016-06-11 07:30:41',0),(683,20,'logged in from: ::1','users','2016-06-11 07:32:06',0),(684,14,'logged in from: ::1','users','2016-06-11 07:34:50',0),(685,12,'logged in from: ::1','users','2016-06-11 07:35:31',0),(686,9,'logged in from: ::1','users','2016-06-11 07:36:25',0),(687,20,'logged in from: ::1','users','2016-06-11 07:36:35',0),(688,9,'logged in from: ::1','users','2016-06-11 07:48:39',0),(689,20,'logged in from: ::1','users','2016-06-11 07:49:28',0),(690,45,'logged in from: ::1','users','2016-06-11 10:12:19',0),(691,9,'logged in from: ::1','users','2016-06-11 10:25:46',0),(692,20,'logged in from: ::1','users','2016-06-11 11:57:09',0),(693,9,'logged in from: ::1','users','2016-06-11 12:02:07',0),(694,45,'logged in from: ::1','users','2016-06-11 13:43:17',0),(695,45,'logged in from: ::1','users','2016-06-11 13:54:53',0),(696,2,'logged in from: ::1','users','2016-06-11 14:25:42',0),(697,2,'App settings saved from: ::1','core','2016-06-11 14:28:47',0),(698,2,'logged in from: ::1','users','2016-06-11 14:32:44',0),(699,2,'Migrate Type: ishop_ to Version: 0 from: ::1','migrations','2016-06-11 14:43:35',0),(700,2,'Migration module: ishop Version: 0 from: ::1','migrations','2016-06-11 14:43:35',0),(701,2,'Migrate Type: ishop_ to Version: 1 from: ::1','migrations','2016-06-11 14:43:49',0),(702,2,'Migration module: ishop Version: 1 from: ::1','migrations','2016-06-11 14:43:49',0),(703,2,'Migrate Type: ishop_ Uninstalled Version: 0 from: ::1','migrations','2016-06-11 14:45:27',0),(704,2,'Migration module: ishop Version: 0 from: ::1','migrations','2016-06-11 14:45:28',0),(705,2,'Migrate Type: ishop_ to Version: 1 from: ::1','migrations','2016-06-11 14:45:37',0),(706,2,'Migration module: ishop Version: 1 from: ::1','migrations','2016-06-11 14:45:37',0),(707,1,'logged in from: ::1','users','2016-06-11 14:57:42',0),(708,20,'logged in from: ::1','users','2016-06-11 14:58:40',0),(709,9,'logged in from: ::1','users','2016-06-12 05:35:15',0),(710,2,'logged in from: ::1','users','2016-06-12 05:36:16',0),(711,9,'logged in from: ::1','users','2016-06-12 05:41:22',0),(712,45,'logged in from: ::1','users','2016-06-12 06:01:19',0),(713,9,'logged in from: ::1','users','2016-06-12 06:03:09',0),(714,45,'logged in from: 127.0.0.1','users','2016-06-12 06:09:32',0),(715,45,'logged in from: ::1','users','2016-06-12 06:37:07',0),(716,20,'logged in from: ::1','users','2016-06-12 06:42:11',0),(717,45,'logged in from: ::1','users','2016-06-12 06:50:08',0),(718,20,'logged in from: ::1','users','2016-06-12 07:00:13',0),(719,45,'logged in from: ::1','users','2016-06-12 07:01:38',0),(720,20,'logged in from: ::1','users','2016-06-12 07:02:50',0),(721,45,'logged in from: 127.0.0.1','users','2016-06-12 09:42:55',0),(722,20,'logged in from: ::1','users','2016-06-12 09:47:37',0),(723,14,'logged in from: ::1','users','2016-06-12 10:40:20',0),(724,9,'logged in from: ::1','users','2016-06-12 10:41:10',0),(725,20,'logged in from: ::1','users','2016-06-12 10:48:45',0),(726,45,'logged in from: ::1','users','2016-06-12 10:58:18',0),(727,45,'logged in from: ::1','users','2016-06-13 05:11:29',0),(728,45,'logged in from: ::1','users','2016-06-13 07:17:06',0),(729,45,'logged in from: ::1','users','2016-06-13 05:21:51',0),(730,20,'logged in from: ::1','users','2016-06-13 05:25:13',0),(731,45,'logged in from: ::1','users','2016-06-13 05:43:35',0),(732,20,'logged in from: ::1','users','2016-06-13 05:44:06',0),(733,45,'logged in from: ::1','users','2016-06-13 05:48:45',0),(734,45,'logged in from: ::1','users','2016-06-13 06:08:14',0),(735,9,'logged in from: ::1','users','2016-06-13 06:10:57',0),(736,45,'logged in from: ::1','users','2016-06-13 06:15:15',0),(737,14,'logged in from: ::1','users','2016-06-13 06:33:10',0),(738,45,'logged in from: ::1','users','2016-06-13 06:57:27',0),(739,45,'logged in from: ::1','users','2016-06-13 06:57:39',0),(740,45,'logged in from: ::1','users','2016-06-13 07:09:24',0),(741,45,'logged in from: ::1','users','2016-06-13 07:10:34',0),(742,9,'logged in from: ::1','users','2016-06-13 09:21:48',0),(743,14,'logged in from: ::1','users','2016-06-13 09:22:18',0),(744,20,'logged in from: ::1','users','2016-06-13 09:22:59',0),(745,9,'logged in from: ::1','users','2016-06-13 07:46:44',0),(746,45,'logged in from: ::1','users','2016-06-13 07:49:39',0),(747,45,'logged in from: ::1','users','2016-06-13 09:55:07',0),(748,14,'logged in from: ::1','users','2016-06-13 07:57:16',0),(749,14,'logged in from: ::1','users','2016-06-13 08:01:10',0),(750,20,'logged in from: ::1','users','2016-06-13 08:01:48',0),(751,9,'logged in from: ::1','users','2016-06-13 08:02:14',0),(752,45,'logged in from: ::1','users','2016-06-13 08:16:37',0),(753,9,'logged in from: ::1','users','2016-06-13 08:16:59',0),(754,14,'logged in from: ::1','users','2016-06-13 08:17:26',0),(755,9,'logged in from: ::1','users','2016-06-13 10:34:23',0),(756,14,'logged in from: ::1','users','2016-06-13 10:35:06',0),(757,45,'logged in from: ::1','users','2016-06-13 08:35:18',0),(758,20,'logged in from: ::1','users','2016-06-13 10:35:36',0),(759,9,'logged in from: ::1','users','2016-06-13 09:43:01',0),(760,9,'logged in from: ::1','users','2016-06-13 09:44:05',0),(761,45,'logged in from: ::1','users','2016-06-13 09:48:52',0),(762,9,'logged in from: ::1','users','2016-06-13 10:18:03',0),(763,45,'logged in from: ::1','users','2016-06-13 10:34:23',0),(764,9,'logged in from: ::1','users','2016-06-13 10:59:19',0),(765,45,'logged in from: ::1','users','2016-06-13 11:56:32',0),(766,9,'logged in from: ::1','users','2016-06-13 11:57:45',0),(767,14,'logged in from: ::1','users','2016-06-13 11:58:33',0),(768,9,'logged in from: ::1','users','2016-06-13 13:59:28',0),(769,9,'logged in from: ::1','users','2016-06-13 12:00:25',0),(770,9,'logged in from: ::1','users','2016-06-13 12:00:31',0),(771,20,'logged in from: ::1','users','2016-06-13 12:00:55',0),(772,45,'logged in from: ::1','users','2016-06-13 12:09:44',0),(773,45,'logged in from: ::1','users','2016-06-13 12:24:48',0),(774,45,'logged in from: ::1','users','2016-06-13 12:32:44',0),(775,45,'logged in from: ::1','users','2016-06-13 13:03:41',0),(776,9,'logged in from: ::1','users','2016-06-13 13:06:22',0),(777,14,'logged in from: ::1','users','2016-06-13 13:06:47',0),(778,45,'logged in from: ::1','users','2016-06-13 13:12:46',0),(779,45,'logged in from: ::1','users','2016-06-13 13:16:17',0),(780,9,'logged in from: ::1','users','2016-06-13 13:18:01',0),(781,14,'logged in from: ::1','users','2016-06-13 13:18:55',0),(782,20,'logged in from: ::1','users','2016-06-13 13:19:19',0),(783,45,'logged in from: ::1','users','2016-06-13 13:23:22',0),(784,45,'logged in from: ::1','users','2016-06-13 13:26:04',0),(785,45,'logged in from: ::1','users','2016-06-14 05:07:54',0),(786,45,'logged in from: ::1','users','2016-06-14 05:44:05',0),(787,45,'logged in from: ::1','users','2016-06-14 07:50:20',0),(788,9,'logged in from: ::1','users','2016-06-14 06:04:15',0),(789,45,'logged in from: ::1','users','2016-06-14 06:26:08',0),(790,9,'logged in from: ::1','users','2016-06-14 07:05:24',0),(791,14,'logged in from: ::1','users','2016-06-14 07:29:09',0),(792,20,'logged in from: ::1','users','2016-06-14 07:29:48',0),(793,45,'logged in from: ::1','users','2016-06-14 07:45:30',0),(794,45,'logged in from: ::1','users','2016-06-14 12:16:25',0),(795,45,'logged in from: ::1','users','2016-06-14 10:56:41',0),(796,9,'logged in from: ::1','users','2016-06-14 11:05:15',0),(797,45,'logged in from: ::1','users','2016-06-14 11:28:31',0),(798,9,'logged in from: ::1','users','2016-06-14 11:35:03',0),(799,9,'logged in from: ::1','users','2016-06-14 11:35:09',0),(800,14,'logged in from: ::1','users','2016-06-14 11:36:10',0),(801,20,'logged in from: ::1','users','2016-06-14 11:36:55',0),(802,45,'logged in from: ::1','users','2016-06-14 11:37:01',0),(803,45,'logged in from: ::1','users','2016-06-14 11:39:01',0),(804,9,'logged in from: ::1','users','2016-06-14 11:40:44',0),(805,9,'logged in from: ::1','users','2016-06-14 11:44:36',0),(806,45,'logged in from: ::1','users','2016-06-14 12:39:38',0),(807,9,'logged in from: ::1','users','2016-06-14 13:21:49',0),(808,45,'logged in from: ::1','users','2016-06-14 13:47:30',0),(809,45,'logged in from: ::1','users','2016-06-14 13:55:44',0),(810,14,'logged in from: ::1','users','2016-06-14 14:06:53',0),(811,45,'logged in from: ::1','users','2016-06-14 14:17:44',0),(812,14,'logged in from: ::1','users','2016-06-14 14:18:32',0),(813,20,'logged in from: ::1','users','2016-06-14 14:19:10',0),(814,20,'logged in from: ::1','users','2016-06-14 17:08:37',0),(815,9,'logged in from: ::1','users','2016-06-14 17:09:29',0),(816,45,'logged in from: ::1','users','2016-06-14 18:30:47',0),(817,9,'logged in from: ::1','users','2016-06-14 18:47:50',0),(818,45,'logged in from: ::1','users','2016-06-15 04:57:58',0),(819,45,'logged in from: ::1','users','2016-06-15 04:59:10',0),(820,9,'logged in from: ::1','users','2016-06-15 05:16:16',0),(821,20,'logged in from: ::1','users','2016-06-15 05:21:34',0),(822,9,'logged in from: ::1','users','2016-06-15 07:26:52',0),(823,9,'logged in from: ::1','users','2016-06-15 06:19:33',0),(824,20,'logged in from: ::1','users','2016-06-15 06:41:24',0),(825,45,'logged in from: ::1','users','2016-06-15 06:42:00',0),(826,20,'logged in from: 127.0.0.1','users','2016-06-15 07:06:45',0),(827,45,'logged in from: ::1','users','2016-06-15 07:46:46',0),(828,45,'logged in from: ::1','users','2016-06-15 10:25:00',0),(829,45,'logged in from: ::1','users','2016-06-15 10:25:36',0),(830,9,'logged in from: ::1','users','2016-06-15 12:24:53',0),(831,9,'logged in from: ::1','users','2016-06-15 12:25:08',0),(832,45,'logged in from: ::1','users','2016-06-15 12:25:33',0),(833,45,'logged in from: ::1','users','2016-06-15 12:26:23',0),(834,14,'logged in from: ::1','users','2016-06-15 12:26:58',0),(835,45,'logged in from: ::1','users','2016-06-15 12:33:26',0),(836,9,'logged in from: ::1','users','2016-06-15 12:38:18',0),(837,45,'logged in from: ::1','users','2016-06-15 12:39:02',0),(838,45,'logged in from: ::1','users','2016-06-15 12:46:08',0),(839,9,'logged in from: ::1','users','2016-06-15 13:19:53',0),(840,14,'logged in from: ::1','users','2016-06-15 13:22:35',0),(841,20,'logged in from: ::1','users','2016-06-15 13:24:01',0),(842,45,'logged in from: ::1','users','2016-06-15 13:36:21',0),(843,45,'logged in from: ::1','users','2016-06-15 13:36:50',0),(844,20,'logged in from: ::1','users','2016-06-15 13:37:02',0),(845,20,'logged in from: ::1','users','2016-06-15 13:37:33',0),(846,20,'logged in from: ::1','users','2016-06-15 13:37:41',0),(847,20,'logged in from: ::1','users','2016-06-15 13:45:20',0),(848,45,'logged in from: ::1','users','2016-06-15 13:56:13',0),(849,12,'logged in from: ::1','users','2016-06-15 15:38:01',0),(850,45,'logged in from: ::1','users','2016-06-15 15:39:33',0),(851,45,'logged in from: ::1','users','2016-06-16 04:56:52',0),(852,45,'logged in from: ::1','users','2016-06-16 05:28:56',0),(853,45,'logged in from: ::1','users','2016-06-16 07:31:28',0),(854,45,'logged in from: ::1','users','2016-06-16 05:33:31',0),(855,9,'logged in from: ::1','users','2016-06-16 05:34:29',0),(856,14,'logged in from: ::1','users','2016-06-16 05:34:51',0),(857,45,'logged in from: ::1','users','2016-06-16 05:35:05',0),(858,2,'logged in from: ::1','users','2016-06-16 06:15:11',0),(859,1,'logged in from: ::1','users','2016-06-16 06:16:04',0),(860,14,'logged in from: ::1','users','2016-06-16 06:33:27',0),(861,20,'logged in from: ::1','users','2016-06-16 06:33:36',0),(862,45,'logged in from: ::1','users','2016-06-16 07:11:57',0),(863,45,'logged in from: ::1','users','2016-06-16 12:50:18',0),(864,2,'logged in from: ::1','users','2016-06-16 12:01:44',0),(865,1,'logged in from: ::1','users','2016-06-16 12:02:21',0),(866,1,'Created Module: ESP : ::1','modulebuilder','2016-06-16 12:03:12',0),(867,45,'logged in from: ::1','users','2016-06-16 12:13:42',0),(868,9,'logged in from: ::1','users','2016-06-16 12:51:08',0),(869,45,'logged in from: ::1','users','2016-06-16 13:02:12',0),(870,45,'logged in from: ::1','users','2016-06-16 15:06:08',0),(871,45,'logged in from: ::1','users','2016-06-16 15:07:21',0),(872,2,'logged in from: ::1','users','2016-06-16 15:13:21',0),(873,1,'logged in from: ::1','users','2016-06-16 15:21:31',0),(874,2,'logged in from: ::1','users','2016-06-16 15:23:05',0),(875,45,'logged in from: ::1','users','2016-06-16 13:24:18',0),(876,45,'logged in from: ::1','users','2016-06-16 15:27:28',0),(877,2,'logged in from: ::1','users','2016-06-16 13:48:31',0),(878,1,'logged in from: ::1','users','2016-06-16 13:50:01',0),(879,2,'logged in from: ::1','users','2016-06-16 13:52:03',0),(880,45,'logged in from: ::1','users','2016-06-16 13:55:52',0),(881,45,'logged in from: ::1','users','2016-06-16 13:56:01',0),(882,45,'logged in from: ::1','users','2016-06-16 13:57:21',0),(883,2,'logged in from: 127.0.0.1','users','2016-06-16 16:37:05',0),(884,9,'logged in from: ::1','users','2016-06-16 15:39:42',0),(885,9,'logged in from: ::1','users','2016-06-17 05:02:30',0),(886,45,'logged in from: ::1','users','2016-06-17 05:05:56',0),(887,45,'logged in from: ::1','users','2016-06-17 05:32:58',0),(888,45,'logged in from: ::1','users','2016-06-17 07:33:17',0),(889,9,'logged in from: ::1','users','2016-06-17 05:37:33',0),(890,9,'logged in from: ::1','users','2016-06-17 06:34:23',0),(891,45,'logged in from: ::1','users','2016-06-17 06:36:14',0),(892,2,'logged in from: 127.0.0.1','users','2016-06-17 06:46:17',0),(893,9,'logged in from: ::1','users','2016-06-17 06:46:55',0),(894,20,'logged in from: ::1','users','2016-06-17 06:47:04',0),(895,20,'logged in from: ::1','users','2016-06-17 06:47:36',0),(896,14,'logged in from: ::1','users','2016-06-17 06:48:09',0),(897,45,'logged in from: ::1','users','2016-06-17 06:48:50',0),(898,45,'logged in from: ::1','users','2016-06-17 06:49:24',0),(899,45,'logged in from: ::1','users','2016-06-17 08:55:12',0),(900,45,'logged in from: ::1','users','2016-06-17 08:56:07',0),(901,45,'logged in from: ::1','users','2016-06-17 11:53:07',0),(902,45,'logged in from: ::1','users','2016-06-17 09:57:50',0),(903,9,'logged in from: ::1','users','2016-06-17 10:00:30',0),(904,45,'logged in from: ::1','users','2016-06-17 10:10:56',0),(905,9,'logged in from: ::1','users','2016-06-17 10:16:47',0),(906,45,'logged in from: ::1','users','2016-06-17 12:48:16',0),(907,9,'logged in from: ::1','users','2016-06-17 12:48:53',0),(908,14,'logged in from: ::1','users','2016-06-17 12:49:37',0),(909,20,'logged in from: ::1','users','2016-06-17 12:50:07',0),(910,45,'logged in from: ::1','users','2016-06-17 12:50:46',0),(911,45,'logged in from: ::1','users','2016-06-17 12:45:19',0),(912,45,'logged in from: ::1','users','2016-06-17 13:07:47',0),(913,20,'logged in from: ::1','users','2016-06-17 13:24:50',0),(914,45,'logged in from: ::1','users','2016-06-17 13:52:23',0),(915,9,'logged in from: ::1','users','2016-06-17 13:54:58',0),(916,45,'logged in from: ::1','users','2016-06-17 15:52:11',0),(917,45,'logged in from: ::1','users','2016-06-18 08:36:08',0),(918,45,'logged in from: ::1','users','2016-06-20 06:29:22',0),(919,45,'logged in from: ::1','users','2016-06-20 05:01:03',0),(920,45,'logged in from: ::1','users','2016-06-20 05:30:40',0),(921,48,'logged in from: ::1','users','2016-06-20 08:35:53',0),(922,9,'logged in from: ::1','users','2016-06-20 07:55:07',0),(923,45,'logged in from: ::1','users','2016-06-20 09:16:51',0),(924,45,'logged in from: 127.0.0.1','users','2016-06-20 11:36:41',0),(925,45,'logged in from: ::1','users','2016-06-20 09:36:56',0),(926,9,'logged in from: ::1','users','2016-06-20 10:24:24',0),(927,14,'logged in from: ::1','users','2016-06-20 10:24:30',0),(928,45,'logged in from: ::1','users','2016-06-20 10:27:12',0),(929,45,'logged in from: ::1','users','2016-06-20 13:02:07',0),(930,48,'logged in from: ::1','users','2016-06-20 13:16:16',0),(931,9,'logged in from: ::1','users','2016-06-20 12:23:40',0),(932,9,'logged in from: ::1','users','2016-06-20 13:40:05',0),(933,45,'logged in from: ::1','users','2016-06-20 14:37:37',0),(934,9,'logged in from: ::1','users','2016-06-20 15:02:16',0),(935,14,'logged in from: ::1','users','2016-06-20 15:14:12',0),(936,14,'logged in from: ::1','users','2016-06-20 15:15:34',0),(937,20,'logged in from: ::1','users','2016-06-20 15:15:53',0),(938,45,'logged in from: ::1','users','2016-06-21 07:21:57',0),(939,9,'logged in from: ::1','users','2016-06-21 05:26:00',0),(940,48,'logged in from: ::1','users','2016-06-21 07:30:03',0),(941,20,'logged in from: ::1','users','2016-06-21 05:49:08',0),(942,9,'logged in from: ::1','users','2016-06-21 05:55:29',0),(943,9,'logged in from: 127.0.0.1','users','2016-06-21 05:57:27',0),(944,45,'logged in from: 127.0.0.1','users','2016-06-21 05:57:39',0),(945,45,'logged in from: ::1','users','2016-06-21 08:29:24',0),(946,48,'logged in from: ::1','users','2016-06-21 08:40:54',0),(947,9,'logged in from: ::1','users','2016-06-21 06:57:39',0),(948,45,'logged in from: ::1','users','2016-06-21 07:10:06',0),(949,9,'logged in from: ::1','users','2016-06-21 07:10:43',0),(950,45,'logged in from: 127.0.0.1','users','2016-06-21 07:35:25',0),(951,45,'logged in from: ::1','users','2016-06-21 09:52:03',0),(952,9,'logged in from: ::1','users','2016-06-21 07:52:17',0),(953,20,'logged in from: 127.0.0.1','users','2016-06-21 07:55:40',0),(954,45,'logged in from: 127.0.0.1','users','2016-06-21 07:55:57',0),(955,45,'logged in from: ::1','users','2016-06-21 09:17:32',0),(956,48,'logged in from: ::1','users','2016-06-21 11:18:08',0),(957,11,'logged in from: ::1','users','2016-06-21 09:18:29',0),(958,45,'logged in from: ::1','users','2016-06-21 09:18:39',0),(959,11,'logged in from: ::1','users','2016-06-21 09:19:13',0),(960,45,'logged in from: ::1','users','2016-06-21 09:34:04',0),(961,14,'logged in from: ::1','users','2016-06-21 09:36:38',0),(962,11,'logged in from: ::1','users','2016-06-21 09:47:21',0),(963,45,'logged in from: ::1','users','2016-06-21 12:59:59',0),(964,48,'logged in from: ::1','users','2016-06-21 13:21:34',0),(965,14,'logged in from: ::1','users','2016-06-21 13:38:51',0),(966,9,'logged in from: ::1','users','2016-06-21 13:39:23',0),(967,14,'logged in from: ::1','users','2016-06-21 13:39:59',0),(968,20,'logged in from: ::1','users','2016-06-21 13:41:22',0),(969,45,'logged in from: ::1','users','2016-06-21 13:49:22',0),(970,14,'logged in from: ::1','users','2016-06-21 14:01:45',0),(971,20,'logged in from: ::1','users','2016-06-21 14:09:50',0),(972,45,'logged in from: ::1','users','2016-06-21 16:24:28',0),(973,45,'logged in from: ::1','users','2016-06-21 14:38:02',0),(974,14,'logged in from: ::1','users','2016-06-21 15:13:06',0),(975,9,'logged in from: ::1','users','2016-06-21 15:37:26',0),(976,14,'logged in from: ::1','users','2016-06-21 15:50:27',0),(977,20,'logged in from: ::1','users','2016-06-21 15:50:41',0),(978,48,'logged in from: ::1','users','2016-06-21 17:53:11',0),(979,14,'logged in from: ::1','users','2016-06-21 16:07:51',0),(980,9,'logged in from: ::1','users','2016-06-22 05:14:59',0),(981,45,'logged in from: ::1','users','2016-06-22 05:24:45',0),(982,48,'logged in from: ::1','users','2016-06-22 07:32:44',0),(983,45,'logged in from: ::1','users','2016-06-22 07:58:50',0),(984,9,'logged in from: ::1','users','2016-06-22 08:08:17',0),(985,45,'logged in from: ::1','users','2016-06-22 08:22:43',0),(986,9,'logged in from: ::1','users','2016-06-22 08:43:16',0),(987,45,'logged in from: ::1','users','2016-06-22 08:49:07',0),(988,45,'logged in from: ::1','users','2016-06-22 08:54:47',0),(989,45,'logged in from: ::1','users','2016-06-22 08:57:39',0),(990,45,'logged in from: ::1','users','2016-06-22 09:00:01',0),(991,45,'logged in from: ::1','users','2016-06-22 09:00:18',0),(992,14,'logged in from: ::1','users','2016-06-22 07:05:19',0),(993,48,'logged in from: ::1','users','2016-06-22 09:10:01',0),(994,9,'logged in from: ::1','users','2016-06-22 09:13:28',0),(995,14,'logged in from: ::1','users','2016-06-22 09:14:29',0),(996,20,'logged in from: ::1','users','2016-06-22 09:15:17',0),(997,45,'logged in from: ::1','users','2016-06-22 09:18:16',0),(998,45,'logged in from: ::1','users','2016-06-22 07:20:29',0),(999,45,'logged in from: ::1','users','2016-06-22 09:20:14',0),(1000,45,'logged in from: ::1','users','2016-06-22 09:20:47',0),(1001,45,'logged in from: ::1','users','2016-06-22 09:44:50',0),(1002,9,'logged in from: ::1','users','2016-06-22 09:54:39',0),(1003,48,'logged in from: ::1','users','2016-06-22 11:56:21',0),(1004,45,'logged in from: ::1','users','2016-06-22 12:34:27',0),(1005,45,'logged in from: ::1','users','2016-06-22 10:37:46',0),(1006,45,'logged in from: ::1','users','2016-06-22 12:38:48',0),(1007,47,'logged in from: ::1','users','2016-06-22 12:39:30',0),(1008,48,'logged in from: ::1','users','2016-06-22 13:07:03',0),(1009,45,'logged in from: ::1','users','2016-06-22 13:31:49',0),(1010,48,'logged in from: ::1','users','2016-06-22 13:40:28',0),(1011,47,'logged in from: ::1','users','2016-06-22 13:41:50',0),(1012,45,'logged in from: ::1','users','2016-06-22 13:42:26',0),(1013,47,'logged in from: ::1','users','2016-06-22 13:43:24',0),(1014,48,'logged in from: ::1','users','2016-06-22 13:44:55',0),(1015,47,'logged in from: ::1','users','2016-06-22 13:53:40',0),(1016,45,'logged in from: ::1','users','2016-06-22 13:54:44',0),(1017,47,'logged in from: ::1','users','2016-06-22 13:59:52',0),(1018,45,'logged in from: ::1','users','2016-06-22 14:00:55',0),(1019,48,'logged in from: ::1','users','2016-06-22 14:13:22',0),(1020,46,'logged in from: ::1','users','2016-06-22 14:15:43',0),(1021,45,'logged in from: ::1','users','2016-06-22 14:16:09',0),(1022,47,'logged in from: ::1','users','2016-06-22 14:19:46',0),(1023,45,'logged in from: ::1','users','2016-06-22 13:11:29',0),(1024,9,'logged in from: ::1','users','2016-06-22 13:45:02',0),(1025,45,'logged in from: ::1','users','2016-06-22 13:49:22',0),(1026,9,'logged in from: ::1','users','2016-06-22 14:41:04',0),(1027,45,'logged in from: ::1','users','2016-06-22 14:42:49',0),(1028,48,'logged in from: ::1','users','2016-06-22 16:46:23',0),(1029,47,'logged in from: ::1','users','2016-06-22 17:28:38',0),(1030,46,'logged in from: ::1','users','2016-06-22 17:45:22',0),(1031,47,'logged in from: ::1','users','2016-06-22 17:53:17',0),(1032,48,'logged in from: ::1','users','2016-06-22 18:08:48',0),(1033,47,'logged in from: ::1','users','2016-06-22 18:09:39',0),(1034,46,'logged in from: ::1','users','2016-06-22 18:10:19',0),(1035,47,'logged in from: ::1','users','2016-06-22 18:16:37',0),(1036,46,'logged in from: ::1','users','2016-06-22 18:24:48',0),(1037,47,'logged in from: ::1','users','2016-06-22 18:26:32',0),(1038,45,'logged in from: ::1','users','2016-06-22 18:27:13',0),(1039,46,'logged in from: ::1','users','2016-06-22 18:27:55',0),(1040,45,'logged in from: ::1','users','2016-06-22 18:28:54',0),(1041,46,'logged in from: ::1','users','2016-06-22 18:30:06',0),(1042,47,'logged in from: ::1','users','2016-06-22 18:30:43',0),(1043,46,'logged in from: ::1','users','2016-06-22 18:37:42',0),(1044,48,'logged in from: ::1','users','2016-06-22 18:38:15',0),(1045,47,'logged in from: ::1','users','2016-06-22 18:55:40',0),(1046,20,'logged in from: ::1','users','2016-06-22 17:09:51',0),(1047,45,'logged in from: ::1','users','2016-06-22 17:13:30',0),(1048,45,'logged in from: ::1','users','2016-06-22 19:14:45',0),(1049,48,'logged in from: ::1','users','2016-06-23 07:42:43',0),(1050,45,'logged in from: ::1','users','2016-06-23 08:06:27',0),(1051,20,'logged in from: ::1','users','2016-06-23 06:09:58',0),(1052,20,'logged in from: ::1','users','2016-06-23 06:17:12',0),(1053,14,'logged in from: ::1','users','2016-06-23 06:17:20',0),(1054,45,'logged in from: ::1','users','2016-06-23 06:21:25',0),(1055,14,'logged in from: ::1','users','2016-06-23 06:23:06',0),(1056,20,'logged in from: ::1','users','2016-06-23 06:47:19',0),(1057,20,'logged in from: ::1','users','2016-06-23 11:07:26',0),(1058,47,'logged in from: ::1','users','2016-06-23 15:22:04',0),(1059,45,'logged in from: ::1','users','2016-06-23 14:23:38',0),(1060,14,'logged in from: ::1','users','2016-06-23 14:32:00',0),(1061,47,'logged in from: ::1','users','2016-06-23 16:33:20',0),(1062,48,'logged in from: ::1','users','2016-06-23 16:34:02',0),(1063,46,'logged in from: ::1','users','2016-06-23 16:35:04',0),(1064,20,'logged in from: ::1','users','2016-06-23 14:38:37',0),(1065,48,'logged in from: ::1','users','2016-06-23 16:43:02',0),(1066,45,'logged in from: ::1','users','2016-06-23 14:43:23',0),(1067,48,'logged in from: ::1','users','2016-06-23 17:18:27',0),(1068,47,'logged in from: ::1','users','2016-06-23 17:23:15',0),(1069,48,'logged in from: ::1','users','2016-06-23 17:24:06',0),(1070,46,'logged in from: ::1','users','2016-06-23 17:26:41',0),(1071,47,'logged in from: ::1','users','2016-06-23 17:29:11',0),(1072,48,'logged in from: ::1','users','2016-06-23 17:30:24',0),(1073,20,'logged in from: ::1','users','2016-06-23 15:54:37',0),(1074,48,'logged in from: ::1','users','2016-06-24 08:18:12',0),(1075,20,'logged in from: ::1','users','2016-06-24 06:20:25',0),(1076,45,'logged in from: ::1','users','2016-06-24 09:24:51',0),(1077,9,'logged in from: ::1','users','2016-06-24 09:25:06',0),(1078,45,'logged in from: ::1','users','2016-06-24 09:28:00',0),(1079,45,'logged in from: ::1','users','2016-06-24 09:28:49',0),(1080,45,'logged in from: ::1','users','2016-06-24 09:36:03',0),(1081,9,'logged in from: ::1','users','2016-06-24 09:48:07',0),(1082,20,'logged in from: ::1','users','2016-06-24 09:48:25',0),(1083,9,'logged in from: ::1','users','2016-06-24 09:48:53',0),(1084,45,'logged in from: ::1','users','2016-06-24 09:57:34',0),(1085,9,'logged in from: ::1','users','2016-06-24 10:10:00',0),(1086,20,'logged in from: ::1','users','2016-06-24 10:10:15',0),(1087,20,'logged in from: ::1','users','2016-06-24 10:22:27',0),(1088,9,'logged in from: ::1','users','2016-06-24 10:56:57',0),(1089,14,'logged in from: ::1','users','2016-06-24 10:57:42',0),(1090,20,'logged in from: ::1','users','2016-06-24 10:57:59',0),(1091,20,'logged in from: ::1','users','2016-06-24 11:02:34',0),(1092,45,'logged in from: ::1','users','2016-06-24 11:13:00',0),(1093,9,'logged in from: ::1','users','2016-06-24 11:13:57',0),(1094,14,'logged in from: ::1','users','2016-06-24 11:15:02',0),(1095,9,'logged in from: ::1','users','2016-06-24 11:21:40',0),(1096,45,'logged in from: ::1','users','2016-06-24 11:24:15',0),(1097,45,'logged in from: ::1','users','2016-06-24 11:29:16',0),(1098,9,'logged in from: ::1','users','2016-06-24 11:29:54',0),(1099,9,'logged in from: ::1','users','2016-06-24 11:43:21',0),(1100,45,'logged in from: ::1','users','2016-06-24 11:44:00',0),(1101,14,'logged in from: ::1','users','2016-06-24 11:44:40',0),(1102,20,'logged in from: ::1','users','2016-06-24 11:45:15',0),(1103,45,'logged in from: ::1','users','2016-06-24 11:48:00',0),(1104,45,'logged in from: 127.0.0.1','users','2016-06-24 12:04:04',0),(1105,45,'logged in from: ::1','users','2016-06-24 12:13:05',0),(1106,45,'logged in from: ::1','users','2016-06-24 12:14:31',0),(1107,14,'logged in from: ::1','users','2016-06-24 13:42:35',0),(1108,48,'logged in from: ::1','users','2016-06-24 16:20:03',0),(1109,45,'logged in from: ::1','users','2016-06-24 14:25:14',0),(1110,9,'logged in from: ::1','users','2016-06-24 14:26:23',0),(1111,20,'logged in from: ::1','users','2016-06-24 14:26:49',0),(1112,14,'logged in from: ::1','users','2016-06-24 14:49:16',0),(1113,45,'logged in from: ::1','users','2016-06-24 14:53:15',0),(1114,14,'logged in from: ::1','users','2016-06-24 14:59:34',0),(1115,9,'logged in from: ::1','users','2016-06-24 15:16:04',0),(1116,20,'logged in from: ::1','users','2016-06-24 15:37:25',0),(1117,45,'logged in from: ::1','users','2016-06-24 15:46:48',0),(1118,48,'logged in from: ::1','users','2016-06-25 07:34:04',0),(1119,45,'logged in from: ::1','users','2016-06-25 05:47:39',0),(1120,20,'logged in from: ::1','users','2016-06-25 06:01:31',0),(1121,45,'logged in from: ::1','users','2016-06-25 06:38:32',0),(1122,48,'logged in from: ::1','users','2016-06-25 07:00:58',0),(1123,45,'logged in from: 127.0.0.1','users','2016-06-25 07:02:27',0),(1124,45,'logged in from: ::1','users','2016-06-25 07:07:23',0),(1125,9,'logged in from: ::1','users','2016-06-25 07:11:55',0),(1126,45,'logged in from: ::1','users','2016-06-25 07:18:38',0),(1127,20,'logged in from: ::1','users','2016-06-25 08:14:33',0),(1128,48,'logged in from: ::1','users','2016-06-25 11:32:32',0),(1129,45,'logged in from: ::1','users','2016-06-25 09:37:05',0),(1130,20,'logged in from: ::1','users','2016-06-25 10:16:50',0),(1131,9,'logged in from: ::1','users','2016-06-25 10:20:16',0),(1132,14,'logged in from: ::1','users','2016-06-25 10:20:31',0),(1133,20,'logged in from: ::1','users','2016-06-25 10:20:46',0),(1134,45,'logged in from: ::1','users','2016-06-25 10:26:58',0),(1135,45,'logged in from: ::1','users','2016-06-25 13:24:56',0),(1136,45,'logged in from: ::1','users','2016-06-25 13:24:57',0),(1137,48,'logged in from: ::1','users','2016-06-25 14:06:37',0),(1138,14,'logged in from: ::1','users','2016-06-25 13:01:09',0),(1139,45,'logged in from: ::1','users','2016-06-25 13:01:23',0),(1140,48,'logged in from: ::1','users','2016-06-25 13:02:57',0),(1141,45,'logged in from: ::1','users','2016-06-25 14:01:39',0),(1142,45,'logged in from: ::1','users','2016-06-25 14:02:39',0),(1143,9,'logged in from: ::1','users','2016-06-25 14:05:47',0),(1144,14,'logged in from: ::1','users','2016-06-25 14:06:58',0),(1145,20,'logged in from: ::1','users','2016-06-25 14:07:49',0),(1146,9,'logged in from: ::1','users','2016-06-25 15:01:03',0),(1147,20,'logged in from: ::1','users','2016-06-25 15:33:18',0),(1148,14,'logged in from: ::1','users','2016-06-25 15:34:09',0),(1149,20,'logged in from: ::1','users','2016-06-25 15:34:46',0),(1150,45,'logged in from: ::1','users','2016-06-25 15:36:56',0),(1151,45,'logged in from: ::1','users','2016-06-27 05:28:21',0),(1152,14,'logged in from: ::1','users','2016-06-27 05:29:09',0),(1153,45,'logged in from: ::1','users','2016-06-27 05:31:12',0),(1154,48,'logged in from: ::1','users','2016-06-27 07:41:16',0),(1155,45,'logged in from: ::1','users','2016-06-27 08:37:13',0),(1156,48,'logged in from: ::1','users','2016-06-27 09:01:07',0),(1157,45,'logged in from: ::1','users','2016-06-27 09:01:45',0),(1158,47,'logged in from: ::1','users','2016-06-27 09:02:13',0),(1159,48,'logged in from: ::1','users','2016-06-27 11:19:08',0),(1160,47,'logged in from: ::1','users','2016-06-27 11:19:39',0),(1161,48,'logged in from: ::1','users','2016-06-27 11:20:31',0),(1162,20,'logged in from: ::1','users','2016-06-27 10:18:53',0),(1163,9,'logged in from: ::1','users','2016-06-27 10:30:17',0),(1164,45,'logged in from: ::1','users','2016-06-27 10:31:58',0),(1165,9,'logged in from: ::1','users','2016-06-27 10:34:34',0),(1166,20,'logged in from: ::1','users','2016-06-27 11:05:44',0),(1167,47,'logged in from: ::1','users','2016-06-27 13:07:42',0),(1168,46,'logged in from: ::1','users','2016-06-27 13:08:47',0),(1169,45,'logged in from: ::1','users','2016-06-27 13:09:15',0),(1170,20,'logged in from: ::1','users','2016-06-27 11:12:01',0),(1171,9,'logged in from: ::1','users','2016-06-27 11:15:02',0),(1172,9,'logged in from: ::1','users','2016-06-27 11:16:23',0),(1173,20,'logged in from: ::1','users','2016-06-27 11:16:34',0),(1174,48,'logged in from: ::1','users','2016-06-27 11:17:13',0),(1175,45,'logged in from: ::1','users','2016-06-27 11:20:46',0),(1176,9,'logged in from: ::1','users','2016-06-27 11:21:37',0),(1177,45,'logged in from: ::1','users','2016-06-27 11:40:21',0),(1178,45,'logged in from: ::1','users','2016-06-27 13:07:43',0),(1179,45,'logged in from: ::1','users','2016-06-27 15:13:48',0),(1180,45,'logged in from: ::1','users','2016-06-27 13:37:49',0),(1181,45,'logged in from: ::1','users','2016-06-27 13:37:49',0),(1182,45,'logged in from: ::1','users','2016-06-27 13:46:49',0),(1183,45,'logged in from: ::1','users','2016-06-27 14:35:55',0),(1184,45,'logged in from: ::1','users','2016-07-01 06:57:39',0),(1185,45,'logged in from: ::1','users','2016-07-01 07:06:33',0),(1186,14,'logged in from: ::1','users','2016-07-01 07:44:48',0),(1187,16,'logged in from: ::1','users','2016-07-01 07:44:57',0),(1188,45,'logged in from: ::1','users','2016-07-01 07:45:41',0),(1189,16,'logged in from: ::1','users','2016-07-01 07:48:10',0),(1190,45,'logged in from: ::1','users','2016-07-01 09:29:37',0),(1191,16,'logged in from: ::1','users','2016-07-01 09:33:47',0),(1192,45,'logged in from: ::1','users','2016-07-01 09:51:00',0),(1193,16,'logged in from: ::1','users','2016-07-01 09:54:54',0),(1194,45,'logged in from: 127.0.0.1','users','2016-07-01 09:56:05',0),(1195,9,'logged in from: 127.0.0.1','users','2016-07-01 10:20:06',0),(1196,14,'logged in from: 127.0.0.1','users','2016-07-01 10:22:17',0),(1197,20,'logged in from: 127.0.0.1','users','2016-07-01 10:37:13',0),(1198,45,'logged in from: 127.0.0.1','users','2016-07-01 10:48:48',0),(1199,9,'logged in from: ::1','users','2016-07-01 11:38:12',0),(1200,9,'logged in from: ::1','users','2016-07-01 13:54:52',0),(1201,45,'logged in from: ::1','users','2016-07-01 14:47:04',0),(1202,14,'logged in from: ::1','users','2016-07-01 14:51:05',0),(1203,20,'logged in from: ::1','users','2016-07-01 14:54:27',0),(1204,45,'logged in from: ::1','users','2016-07-04 05:48:05',0),(1205,2,'logged in from: ::1','users','2016-07-04 05:48:40',0),(1206,45,'logged in from: ::1','users','2016-07-04 05:56:37',0),(1207,2,'logged in from: ::1','users','2016-07-04 05:59:30',0),(1208,1,'logged in from: ::1','users','2016-07-04 06:00:22',0),(1209,45,'logged in from: ::1','users','2016-07-04 06:07:28',0),(1210,45,'logged in from: 127.0.0.1','users','2016-07-04 07:20:38',0),(1211,20,'logged in from: ::1','users','2016-07-04 07:27:27',0),(1212,20,'logged in from: ::1','users','2016-07-04 10:06:05',0),(1213,45,'logged in from: 127.0.0.1','users','2016-07-04 13:51:18',0),(1214,9,'logged in from: 127.0.0.1','users','2016-07-04 13:51:33',0),(1215,45,'logged in from: ::1','users','2016-07-04 15:35:33',0),(1216,45,'logged in from: ::1','users','2016-07-05 05:41:16',0),(1217,20,'logged in from: ::1','users','2016-07-05 10:39:46',0),(1218,45,'logged in from: ::1','users','2016-07-05 10:45:19',0),(1219,20,'logged in from: ::1','users','2016-07-05 12:00:04',0),(1220,45,'logged in from: ::1','users','2016-07-05 12:03:22',0),(1221,20,'logged in from: ::1','users','2016-07-05 12:12:44',0),(1222,20,'logged in from: ::1','users','2016-07-06 05:19:10',0),(1223,20,'logged in from: ::1','users','2016-07-06 09:25:03',0),(1224,45,'logged in from: ::1','users','2016-07-06 09:25:09',0),(1225,20,'logged in from: ::1','users','2016-07-06 09:29:50',0),(1226,20,'logged in from: ::1','users','2016-07-06 10:29:15',0),(1227,14,'logged in from: ::1','users','2016-07-06 10:49:29',0),(1228,20,'logged in from: ::1','users','2016-07-06 10:58:05',0),(1229,9,'logged in from: ::1','users','2016-07-06 11:42:28',0),(1230,20,'logged in from: ::1','users','2016-07-06 11:51:42',0),(1231,45,'logged in from: ::1','users','2016-07-06 12:04:52',0),(1232,20,'logged in from: ::1','users','2016-07-06 12:11:24',0),(1233,20,'logged in from: ::1','users','2016-07-07 05:35:52',0),(1234,48,'logged in from: ::1','users','2016-07-07 09:58:39',0),(1235,45,'logged in from: ::1','users','2016-07-07 10:56:41',0),(1236,9,'logged in from: ::1','users','2016-07-07 10:58:01',0),(1237,14,'logged in from: ::1','users','2016-07-07 11:01:32',0),(1238,20,'logged in from: ::1','users','2016-07-07 11:02:04',0),(1239,48,'logged in from: ::1','users','2016-07-07 11:03:31',0),(1240,45,'logged in from: ::1','users','2016-07-07 11:05:56',0),(1241,9,'logged in from: ::1','users','2016-07-07 11:13:25',0),(1242,14,'logged in from: ::1','users','2016-07-07 11:19:40',0),(1243,45,'logged in from: ::1','users','2016-07-08 05:11:46',0),(1244,20,'logged in from: ::1','users','2016-07-08 05:22:40',0),(1245,48,'logged in from: ::1','users','2016-07-08 07:37:49',0),(1246,45,'logged in from: ::1','users','2016-07-08 07:40:30',0),(1247,20,'logged in from: ::1','users','2016-07-08 05:48:59',0),(1248,20,'logged in from: ::1','users','2016-07-08 05:49:15',0),(1249,48,'logged in from: ::1','users','2016-07-08 07:51:05',0),(1250,20,'logged in from: ::1','users','2016-07-08 05:51:15',0),(1251,45,'logged in from: ::1','users','2016-07-08 08:00:55',0),(1252,48,'logged in from: ::1','users','2016-07-08 08:18:23',0),(1253,47,'logged in from: ::1','users','2016-07-08 09:49:24',0),(1254,48,'logged in from: ::1','users','2016-07-08 09:50:48',0),(1255,46,'logged in from: ::1','users','2016-07-08 09:54:23',0),(1256,47,'logged in from: ::1','users','2016-07-08 09:55:02',0),(1257,46,'logged in from: ::1','users','2016-07-08 09:55:43',0),(1258,47,'logged in from: ::1','users','2016-07-08 09:57:26',0),(1259,45,'logged in from: ::1','users','2016-07-08 10:01:07',0),(1260,46,'logged in from: ::1','users','2016-07-08 10:01:43',0),(1261,45,'logged in from: ::1','users','2016-07-08 10:02:16',0),(1262,46,'logged in from: ::1','users','2016-07-08 10:03:33',0),(1263,47,'logged in from: ::1','users','2016-07-08 10:05:09',0),(1264,48,'logged in from: ::1','users','2016-07-08 10:06:17',0),(1265,47,'logged in from: ::1','users','2016-07-08 11:17:36',0),(1266,48,'logged in from: ::1','users','2016-07-08 11:31:47',0),(1267,47,'logged in from: ::1','users','2016-07-08 11:40:30',0),(1268,48,'logged in from: ::1','users','2016-07-08 11:42:44',0),(1269,47,'logged in from: ::1','users','2016-07-08 11:43:19',0),(1270,46,'logged in from: ::1','users','2016-07-08 11:45:54',0),(1271,48,'logged in from: ::1','users','2016-07-08 11:48:01',0),(1272,47,'logged in from: ::1','users','2016-07-08 11:49:04',0),(1273,46,'logged in from: ::1','users','2016-07-08 11:49:54',0),(1274,45,'logged in from: ::1','users','2016-07-08 11:50:52',0),(1275,48,'logged in from: ::1','users','2016-07-08 11:51:30',0),(1276,47,'logged in from: ::1','users','2016-07-08 11:52:15',0),(1277,46,'logged in from: ::1','users','2016-07-08 11:52:53',0),(1278,45,'logged in from: ::1','users','2016-07-08 11:53:28',0),(1279,48,'logged in from: ::1','users','2016-07-08 11:55:00',0),(1280,47,'logged in from: ::1','users','2016-07-08 11:55:49',0),(1281,45,'logged in from: ::1','users','2016-07-08 11:56:26',0),(1282,46,'logged in from: ::1','users','2016-07-08 12:11:51',0),(1283,47,'logged in from: ::1','users','2016-07-08 12:12:24',0),(1284,48,'logged in from: ::1','users','2016-07-08 12:13:01',0),(1285,45,'logged in from: ::1','users','2016-07-08 10:17:33',0),(1286,20,'logged in from: ::1','users','2016-07-08 10:40:32',0),(1287,47,'logged in from: ::1','users','2016-07-08 13:16:04',0),(1288,45,'logged in from: ::1','users','2016-07-08 12:06:12',0),(1289,9,'logged in from: ::1','users','2016-07-08 12:21:51',0),(1290,45,'logged in from: ::1','users','2016-07-08 12:24:51',0),(1291,46,'logged in from: ::1','users','2016-07-08 14:27:10',0),(1292,9,'logged in from: ::1','users','2016-07-08 12:27:37',0),(1293,45,'logged in from: ::1','users','2016-07-08 14:27:42',0),(1294,45,'logged in from: ::1','users','2016-07-08 12:30:15',0),(1295,9,'logged in from: ::1','users','2016-07-08 12:35:02',0),(1296,45,'logged in from: ::1','users','2016-07-08 12:36:45',0),(1297,9,'logged in from: ::1','users','2016-07-08 13:20:19',0),(1298,14,'logged in from: ::1','users','2016-07-08 13:24:21',0),(1299,20,'logged in from: ::1','users','2016-07-08 13:24:42',0),(1300,45,'logged in from: ::1','users','2016-07-08 13:28:13',0),(1301,9,'logged in from: ::1','users','2016-07-08 14:17:14',0),(1302,9,'logged in from: ::1','users','2016-07-08 16:18:35',0),(1303,20,'logged in from: ::1','users','2016-07-08 14:31:04',0),(1304,14,'logged in from: ::1','users','2016-07-08 14:32:23',0),(1305,9,'logged in from: ::1','users','2016-07-08 14:32:53',0),(1306,48,'logged in from: ::1','users','2016-07-08 16:38:30',0),(1307,20,'logged in from: ::1','users','2016-07-08 14:41:41',0),(1308,14,'logged in from: ::1','users','2016-07-08 14:45:48',0),(1309,45,'logged in from: ::1','users','2016-07-08 14:47:43',0),(1310,45,'logged in from: ::1','users','2016-07-08 16:55:41',0),(1311,16,'logged in from: ::1','users','2016-07-08 15:01:20',0),(1312,45,'logged in from: ::1','users','2016-07-08 15:02:29',0),(1313,45,'logged in from: ::1','users','2016-07-11 05:26:39',0),(1314,48,'logged in from: ::1','users','2016-07-11 07:27:09',0),(1315,20,'logged in from: ::1','users','2016-07-11 05:31:12',0),(1316,45,'logged in from: 127.0.0.1','users','2016-07-11 05:33:19',0),(1317,45,'logged in from: ::1','users','2016-07-11 05:48:57',0),(1318,14,'logged in from: ::1','users','2016-07-11 05:58:04',0),(1319,20,'logged in from: ::1','users','2016-07-11 06:42:24',0),(1320,14,'logged in from: 127.0.0.1','users','2016-07-11 07:23:53',0),(1321,14,'logged in from: ::1','users','2016-07-11 07:57:40',0),(1322,20,'logged in from: ::1','users','2016-07-11 09:11:37',0),(1323,9,'logged in from: ::1','users','2016-07-11 09:36:12',0),(1324,14,'logged in from: ::1','users','2016-07-11 09:38:07',0),(1325,20,'logged in from: ::1','users','2016-07-11 09:50:38',0),(1326,9,'logged in from: ::1','users','2016-07-11 09:51:37',0),(1327,45,'logged in from: ::1','users','2016-07-11 10:13:36',0),(1328,20,'logged in from: ::1','users','2016-07-11 10:16:30',0),(1329,14,'logged in from: ::1','users','2016-07-11 10:36:29',0),(1330,47,'logged in from: ::1','users','2016-07-11 12:40:44',0),(1331,46,'logged in from: ::1','users','2016-07-11 13:01:37',0),(1332,48,'logged in from: ::1','users','2016-07-11 13:03:43',0),(1333,47,'logged in from: ::1','users','2016-07-11 13:08:53',0),(1334,9,'logged in from: ::1','users','2016-07-11 11:17:33',0),(1335,14,'logged in from: ::1','users','2016-07-11 11:18:44',0),(1336,9,'logged in from: ::1','users','2016-07-11 11:29:52',0),(1337,14,'logged in from: ::1','users','2016-07-11 11:44:37',0),(1338,45,'logged in from: ::1','users','2016-07-11 12:01:31',0),(1339,48,'logged in from: ::1','users','2016-07-11 14:19:24',0),(1340,45,'logged in from: ::1','users','2016-07-11 12:28:07',0),(1341,47,'logged in from: ::1','users','2016-07-11 15:22:39',0),(1342,45,'logged in from: ::1','users','2016-07-11 13:32:11',0),(1343,48,'logged in from: ::1','users','2016-07-11 15:33:36',0),(1344,48,'logged in from: ::1','users','2016-07-11 15:34:30',0),(1345,47,'logged in from: ::1','users','2016-07-11 15:35:48',0),(1346,48,'logged in from: ::1','users','2016-07-11 15:51:54',0),(1347,47,'logged in from: ::1','users','2016-07-11 15:54:19',0),(1348,46,'logged in from: ::1','users','2016-07-11 15:55:00',0),(1349,45,'logged in from: ::1','users','2016-07-11 16:04:33',0),(1350,46,'logged in from: ::1','users','2016-07-11 16:14:24',0),(1351,47,'logged in from: ::1','users','2016-07-11 16:16:30',0),(1352,48,'logged in from: ::1','users','2016-07-11 16:29:59',0),(1353,45,'logged in from: ::1','users','2016-07-11 16:30:23',0),(1354,48,'logged in from: ::1','users','2016-07-11 16:37:14',0),(1355,45,'logged in from: ::1','users','2016-07-11 16:39:12',0),(1356,46,'logged in from: ::1','users','2016-07-11 16:47:34',0),(1357,45,'logged in from: ::1','users','2016-07-11 14:50:10',0),(1358,20,'logged in from: ::1','users','2016-07-11 14:51:03',0),(1359,48,'logged in from: ::1','users','2016-07-11 17:36:05',0),(1360,47,'logged in from: ::1','users','2016-07-11 18:00:12',0),(1361,48,'logged in from: ::1','users','2016-07-11 18:02:11',0),(1362,48,'logged in from: ::1','users','2016-07-11 18:06:37',0),(1363,46,'logged in from: ::1','users','2016-07-11 18:14:32',0),(1364,45,'logged in from: ::1','users','2016-07-11 18:52:55',0),(1365,45,'logged in from: ::1','users','2016-07-12 04:49:11',0),(1366,48,'logged in from: ::1','users','2016-07-12 07:38:24',0),(1367,47,'logged in from: ::1','users','2016-07-12 07:40:05',0),(1368,45,'logged in from: ::1','users','2016-07-12 07:41:42',0),(1369,20,'logged in from: ::1','users','2016-07-12 05:51:38',0),(1370,46,'logged in from: ::1','users','2016-07-12 07:55:57',0),(1371,47,'logged in from: ::1','users','2016-07-12 07:56:50',0),(1372,45,'logged in from: ::1','users','2016-07-12 06:24:55',0),(1373,45,'logged in from: ::1','users','2016-07-12 06:28:57',0),(1374,20,'logged in from: ::1','users','2016-07-12 07:18:55',0),(1375,14,'logged in from: ::1','users','2016-07-12 07:21:52',0),(1376,2,'logged in from: ::1','users','2016-07-12 07:23:40',0),(1377,45,'logged in from: ::1','users','2016-07-12 07:24:51',0),(1378,45,'logged in from: ::1','users','2016-07-12 07:34:39',0),(1379,45,'logged in from: ::1','users','2016-07-12 07:50:33',0),(1380,45,'logged in from: ::1','users','2016-07-12 07:52:51',0),(1381,20,'logged in from: ::1','users','2016-07-12 10:55:16',0),(1382,45,'logged in from: ::1','users','2016-07-12 10:57:20',0),(1383,45,'logged in from: ::1','users','2016-07-12 13:14:06',0),(1384,20,'logged in from: ::1','users','2016-07-12 11:32:07',0),(1385,45,'logged in from: ::1','users','2016-07-12 11:32:41',0),(1386,20,'logged in from: ::1','users','2016-07-12 12:00:01',0),(1387,45,'logged in from: ::1','users','2016-07-12 12:00:28',0),(1388,20,'logged in from: ::1','users','2016-07-12 13:31:57',0),(1389,45,'logged in from: ::1','users','2016-07-12 13:32:37',0),(1390,20,'logged in from: ::1','users','2016-07-12 14:18:56',0),(1391,45,'logged in from: ::1','users','2016-07-12 14:34:58',0),(1392,20,'logged in from: ::1','users','2016-07-12 14:40:58',0),(1393,9,'logged in from: ::1','users','2016-07-12 14:48:13',0),(1394,45,'logged in from: ::1','users','2016-07-12 15:00:37',0),(1395,48,'logged in from: ::1','users','2016-07-13 07:15:19',0),(1396,20,'logged in from: ::1','users','2016-07-13 05:23:53',0),(1397,9,'logged in from: ::1','users','2016-07-13 06:04:25',0),(1398,20,'logged in from: ::1','users','2016-07-13 06:10:57',0),(1399,45,'logged in from: ::1','users','2016-07-13 06:12:18',0),(1400,20,'logged in from: ::1','users','2016-07-13 06:13:00',0),(1401,48,'logged in from: ::1','users','2016-07-13 11:00:38',0),(1402,47,'logged in from: ::1','users','2016-07-13 11:08:18',0),(1403,46,'logged in from: ::1','users','2016-07-13 11:09:31',0),(1404,45,'logged in from: ::1','users','2016-07-13 11:19:46',0),(1405,47,'logged in from: ::1','users','2016-07-13 11:20:36',0),(1406,46,'logged in from: ::1','users','2016-07-13 11:22:24',0),(1407,48,'logged in from: ::1','users','2016-07-13 11:59:42',0),(1408,20,'logged in from: ::1','users','2016-07-13 10:10:57',0),(1409,20,'logged in from: ::1','users','2016-07-13 10:51:21',0),(1410,20,'logged in from: ::1','users','2016-07-13 10:57:51',0),(1411,47,'logged in from: ::1','users','2016-07-13 13:01:54',0),(1412,48,'logged in from: ::1','users','2016-07-13 13:04:46',0),(1413,46,'logged in from: ::1','users','2016-07-13 13:06:14',0),(1414,48,'logged in from: ::1','users','2016-07-13 13:29:26',0),(1415,47,'logged in from: ::1','users','2016-07-13 13:30:25',0),(1416,46,'logged in from: ::1','users','2016-07-13 13:31:40',0),(1417,48,'logged in from: ::1','users','2016-07-13 13:45:14',0),(1418,47,'logged in from: ::1','users','2016-07-13 13:46:28',0),(1419,46,'logged in from: ::1','users','2016-07-13 13:47:04',0),(1420,20,'logged in from: ::1','users','2016-07-13 11:47:32',0),(1421,45,'logged in from: ::1','users','2016-07-13 14:22:38',0),(1422,48,'logged in from: ::1','users','2016-07-13 15:13:43',0),(1423,47,'logged in from: ::1','users','2016-07-13 15:14:19',0),(1424,46,'logged in from: ::1','users','2016-07-13 15:14:50',0),(1425,45,'logged in from: ::1','users','2016-07-13 15:15:27',0),(1426,48,'logged in from: ::1','users','2016-07-13 15:34:55',0),(1427,47,'logged in from: ::1','users','2016-07-13 15:41:17',0),(1428,20,'logged in from: ::1','users','2016-07-13 13:41:58',0),(1429,48,'logged in from: ::1','users','2016-07-13 16:01:12',0),(1430,47,'logged in from: ::1','users','2016-07-13 16:09:10',0),(1431,48,'logged in from: ::1','users','2016-07-13 16:33:23',0),(1432,47,'logged in from: ::1','users','2016-07-13 16:42:58',0),(1433,46,'logged in from: ::1','users','2016-07-13 16:54:27',0),(1434,45,'logged in from: ::1','users','2016-07-13 15:13:34',0),(1435,45,'logged in from: ::1','users','2016-07-13 17:16:25',0),(1436,46,'logged in from: ::1','users','2016-07-13 17:17:11',0),(1437,45,'logged in from: ::1','users','2016-07-13 17:19:48',0),(1438,47,'logged in from: ::1','users','2016-07-13 17:21:27',0),(1439,20,'logged in from: ::1','users','2016-07-13 15:30:34',0),(1440,48,'logged in from: ::1','users','2016-07-13 18:59:57',0),(1441,47,'logged in from: ::1','users','2016-07-13 19:00:29',0),(1442,46,'logged in from: ::1','users','2016-07-13 19:01:00',0),(1443,45,'logged in from: ::1','users','2016-07-13 19:01:32',0),(1444,46,'logged in from: ::1','users','2016-07-13 19:02:28',0),(1445,45,'logged in from: ::1','users','2016-07-13 19:06:59',0),(1446,47,'logged in from: ::1','users','2016-07-13 19:16:27',0),(1447,48,'logged in from: ::1','users','2016-07-13 21:05:09',0),(1448,20,'logged in from: ::1','users','2016-07-14 06:03:31',0),(1449,9,'logged in from: ::1','users','2016-07-14 08:19:52',0),(1450,48,'logged in from: ::1','users','2016-07-14 08:25:20',0),(1451,47,'logged in from: ::1','users','2016-07-14 08:28:33',0),(1452,46,'logged in from: ::1','users','2016-07-14 08:51:26',0),(1453,48,'logged in from: ::1','users','2016-07-14 08:54:22',0),(1454,45,'logged in from: ::1','users','2016-07-14 08:55:17',0),(1455,45,'logged in from: ::1','users','2016-07-14 07:23:23',0),(1456,20,'logged in from: ::1','users','2016-07-14 07:26:12',0),(1457,48,'logged in from: ::1','users','2016-07-14 09:45:41',0),(1458,47,'logged in from: ::1','users','2016-07-14 11:39:14',0),(1459,46,'logged in from: ::1','users','2016-07-14 11:49:19',0),(1460,45,'logged in from: ::1','users','2016-07-14 11:50:32',0),(1461,48,'logged in from: ::1','users','2016-07-14 11:54:00',0),(1462,47,'logged in from: ::1','users','2016-07-14 12:02:59',0),(1463,46,'logged in from: ::1','users','2016-07-14 12:04:10',0),(1464,45,'logged in from: ::1','users','2016-07-14 12:05:49',0),(1465,46,'logged in from: ::1','users','2016-07-14 12:06:25',0),(1466,48,'logged in from: ::1','users','2016-07-14 14:50:29',0),(1467,47,'logged in from: ::1','users','2016-07-14 14:59:29',0),(1468,48,'logged in from: ::1','users','2016-07-14 15:16:28',0),(1469,47,'logged in from: ::1','users','2016-07-14 15:27:16',0),(1470,46,'logged in from: ::1','users','2016-07-14 15:43:56',0),(1471,45,'logged in from: ::1','users','2016-07-14 15:53:02',0),(1472,48,'logged in from: ::1','users','2016-07-14 16:32:54',0),(1473,46,'logged in from: ::1','users','2016-07-14 16:33:40',0),(1474,2,'logged in from: ::1','users','2016-07-14 14:42:41',0),(1475,2,'App settings saved from: ::1','core','2016-07-14 14:43:24',0),(1476,2,'App settings saved from: ::1','core','2016-07-14 14:43:45',0),(1477,2,'App settings saved from: ::1','core','2016-07-14 14:44:10',0),(1478,20,'logged in from: ::1','users','2016-07-14 14:49:03',0),(1479,48,'logged in from: ::1','users','2016-07-14 16:52:26',0),(1480,47,'logged in from: ::1','users','2016-07-14 16:53:24',0),(1481,48,'logged in from: ::1','users','2016-07-14 16:58:25',0),(1482,46,'logged in from: ::1','users','2016-07-14 16:58:54',0),(1483,48,'logged in from: ::1','users','2016-07-14 17:15:29',0),(1484,47,'logged in from: ::1','users','2016-07-14 17:17:14',0),(1485,20,'logged in from: ::1','users','2016-07-14 15:29:13',0),(1486,45,'logged in from: ::1','users','2016-07-14 15:30:26',0),(1487,20,'logged in from: ::1','users','2016-07-14 15:33:15',0),(1488,45,'logged in from: ::1','users','2016-07-15 04:54:30',0),(1489,48,'logged in from: ::1','users','2016-07-15 07:43:58',0),(1490,20,'logged in from: ::1','users','2016-07-15 05:45:05',0),(1491,14,'logged in from: ::1','users','2016-07-15 08:25:31',0),(1492,45,'logged in from: ::1','users','2016-07-15 08:52:32',0),(1493,14,'logged in from: ::1','users','2016-07-15 09:15:26',0),(1494,48,'logged in from: ::1','users','2016-07-15 09:32:12',0),(1495,47,'logged in from: ::1','users','2016-07-15 09:40:28',0),(1496,46,'logged in from: ::1','users','2016-07-15 09:41:18',0),(1497,9,'logged in from: ::1','users','2016-07-15 09:37:04',0),(1498,20,'logged in from: ::1','users','2016-07-15 09:39:22',0),(1499,45,'logged in from: ::1','users','2016-07-15 09:39:32',0),(1500,20,'logged in from: ::1','users','2016-07-15 09:48:45',0),(1501,48,'logged in from: ::1','users','2016-07-15 12:01:01',0),(1502,46,'logged in from: ::1','users','2016-07-15 12:34:17',0),(1503,47,'logged in from: ::1','users','2016-07-15 12:35:25',0),(1504,48,'logged in from: ::1','users','2016-07-15 12:56:52',0),(1505,46,'logged in from: ::1','users','2016-07-15 12:58:35',0),(1506,47,'logged in from: ::1','users','2016-07-15 12:59:32',0),(1507,45,'logged in from: ::1','users','2016-07-15 13:00:21',0),(1508,46,'logged in from: ::1','users','2016-07-15 13:00:58',0),(1509,48,'logged in from: ::1','users','2016-07-15 13:12:34',0),(1510,47,'logged in from: ::1','users','2016-07-15 13:13:21',0),(1511,48,'logged in from: ::1','users','2016-07-15 13:15:54',0),(1512,47,'logged in from: ::1','users','2016-07-15 13:18:05',0),(1513,45,'logged in from: ::1','users','2016-07-15 13:20:06',0),(1514,48,'logged in from: ::1','users','2016-07-15 13:21:46',0),(1515,46,'logged in from: ::1','users','2016-07-15 13:22:47',0),(1516,45,'logged in from: ::1','users','2016-07-15 13:23:53',0),(1517,48,'logged in from: ::1','users','2016-07-15 13:28:16',0),(1518,46,'logged in from: ::1','users','2016-07-15 13:29:26',0),(1519,47,'logged in from: ::1','users','2016-07-15 13:30:01',0),(1520,46,'logged in from: ::1','users','2016-07-15 13:31:46',0),(1521,48,'logged in from: ::1','users','2016-07-15 13:34:38',0),(1522,48,'logged in from: ::1','users','2016-07-15 13:47:42',0),(1523,47,'logged in from: ::1','users','2016-07-15 13:56:08',0),(1524,46,'logged in from: ::1','users','2016-07-15 13:56:43',0),(1525,47,'logged in from: ::1','users','2016-07-15 13:57:45',0),(1526,48,'logged in from: ::1','users','2016-07-15 13:58:24',0),(1527,47,'logged in from: ::1','users','2016-07-15 14:01:16',0),(1528,48,'logged in from: ::1','users','2016-07-15 14:02:03',0),(1529,9,'logged in from: ::1','users','2016-07-15 15:07:35',0),(1530,14,'logged in from: ::1','users','2016-07-15 16:13:18',0),(1531,45,'logged in from: ::1','users','2016-07-15 16:17:39',0),(1532,45,'logged in from: ::1','users','2016-07-15 14:29:58',0),(1533,9,'logged in from: ::1','users','2016-07-15 14:38:06',0),(1534,20,'logged in from: ::1','users','2016-07-15 14:39:27',0),(1535,45,'logged in from: ::1','users','2016-07-15 14:56:56',0),(1536,20,'logged in from: ::1','users','2016-07-15 14:58:14',0),(1537,45,'logged in from: ::1','users','2016-07-15 15:12:04',0),(1538,20,'logged in from: ::1','users','2016-07-15 15:13:44',0),(1539,9,'logged in from: ::1','users','2016-07-16 08:14:20',0),(1540,45,'logged in from: ::1','users','2016-07-16 08:15:26',0),(1541,48,'logged in from: ::1','users','2016-07-16 08:24:01',0),(1542,47,'logged in from: ::1','users','2016-07-16 08:42:02',0),(1543,48,'logged in from: ::1','users','2016-07-16 08:44:43',0),(1544,47,'logged in from: ::1','users','2016-07-16 08:47:18',0),(1545,48,'logged in from: 127.0.0.1','users','2016-07-16 08:55:27',0),(1546,46,'logged in from: ::1','users','2016-07-16 08:56:19',0),(1547,45,'logged in from: ::1','users','2016-07-16 09:01:56',0),(1548,47,'logged in from: ::1','users','2016-07-16 09:06:12',0),(1549,46,'logged in from: ::1','users','2016-07-16 09:09:22',0),(1550,47,'logged in from: ::1','users','2016-07-16 10:06:36',0),(1551,46,'logged in from: ::1','users','2016-07-16 10:08:13',0),(1552,47,'logged in from: 127.0.0.1','users','2016-07-16 11:52:43',0),(1553,14,'logged in from: ::1','users','2016-07-16 13:29:41',0),(1554,9,'logged in from: ::1','users','2016-07-16 14:20:44',0),(1555,45,'logged in from: 127.0.0.1','users','2016-07-16 14:22:01',0),(1556,14,'logged in from: ::1','users','2016-07-16 15:12:30',0),(1557,45,'logged in from: ::1','users','2016-07-18 05:00:23',0),(1558,48,'logged in from: ::1','users','2016-07-18 07:44:57',0),(1559,47,'logged in from: ::1','users','2016-07-18 07:58:18',0),(1560,46,'logged in from: 127.0.0.1','users','2016-07-18 07:59:11',0),(1561,45,'logged in from: 127.0.0.1','users','2016-07-18 08:00:17',0),(1562,14,'logged in from: ::1','users','2016-07-18 06:18:07',0),(1563,20,'logged in from: ::1','users','2016-07-18 06:23:44',0),(1564,45,'logged in from: 127.0.0.1','users','2016-07-18 06:37:06',0),(1565,45,'logged in from: ::1','users','2016-07-18 06:38:16',0),(1566,20,'logged in from: ::1','users','2016-07-18 06:48:01',0),(1567,46,'logged in from: 127.0.0.1','users','2016-07-18 11:07:58',0),(1568,45,'logged in from: 127.0.0.1','users','2016-07-18 11:08:35',0),(1569,45,'logged in from: ::1','users','2016-07-18 09:30:56',0),(1570,45,'logged in from: ::1','users','2016-07-18 09:39:25',0),(1571,45,'logged in from: ::1','users','2016-07-18 10:10:10',0),(1572,45,'logged in from: ::1','users','2016-07-18 10:13:04',0),(1573,9,'logged in from: ::1','users','2016-07-18 10:15:02',0),(1574,20,'logged in from: ::1','users','2016-07-18 10:15:29',0),(1575,9,'logged in from: ::1','users','2016-07-18 10:18:23',0),(1576,14,'logged in from: ::1','users','2016-07-18 10:21:39',0),(1577,20,'logged in from: ::1','users','2016-07-18 10:26:30',0),(1578,48,'logged in from: ::1','users','2016-07-18 10:28:47',0),(1579,45,'logged in from: ::1','users','2016-07-18 10:43:18',0),(1580,9,'logged in from: ::1','users','2016-07-18 10:48:28',0),(1581,14,'logged in from: ::1','users','2016-07-18 11:00:08',0),(1582,48,'logged in from: ::1','users','2016-07-18 11:13:26',0),(1583,45,'logged in from: ::1','users','2016-07-18 11:26:22',0),(1584,45,'logged in from: 127.0.0.1','users','2016-07-18 11:27:09',0),(1585,46,'logged in from: 127.0.0.1','users','2016-07-18 16:33:08',0),(1586,45,'logged in from: 127.0.0.1','users','2016-07-18 17:11:01',0),(1587,48,'logged in from: ::1','users','2016-07-18 17:36:05',0),(1588,45,'logged in from: ::1','users','2016-07-19 04:35:14',0),(1589,45,'logged in from: ::1','users','2016-07-19 04:37:49',0),(1590,45,'logged in from: ::1','users','2016-07-19 07:39:38',0),(1591,20,'logged in from: ::1','users','2016-07-19 05:54:24',0),(1592,14,'logged in from: ::1','users','2016-07-19 06:12:31',0),(1593,47,'logged in from: 127.0.0.1','users','2016-07-19 08:12:35',0),(1594,45,'logged in from: ::1','users','2016-07-19 06:45:04',0),(1595,45,'logged in from: ::1','users','2016-07-19 06:51:08',0),(1596,14,'logged in from: ::1','users','2016-07-19 06:52:35',0),(1597,9,'logged in from: ::1','users','2016-07-19 09:44:54',0),(1598,9,'logged in from: ::1','users','2016-07-19 09:08:00',0),(1599,45,'logged in from: ::1','users','2016-07-19 11:09:37',0),(1600,45,'logged in from: ::1','users','2016-07-19 09:16:46',0),(1601,45,'logged in from: ::1','users','2016-07-19 09:29:06',0),(1602,45,'logged in from: ::1','users','2016-07-19 09:47:43',0),(1603,9,'logged in from: ::1','users','2016-07-19 10:07:14',0),(1604,45,'logged in from: ::1','users','2016-07-19 10:07:31',0),(1605,20,'logged in from: ::1','users','2016-07-19 10:29:47',0),(1606,20,'logged in from: ::1','users','2016-07-19 10:44:50',0),(1607,45,'logged in from: ::1','users','2016-07-19 10:48:32',0),(1608,9,'logged in from: ::1','users','2016-07-19 13:03:31',0),(1609,9,'logged in from: ::1','users','2016-07-19 11:06:55',0),(1610,14,'logged in from: ::1','users','2016-07-19 11:07:15',0),(1611,45,'logged in from: ::1','users','2016-07-19 11:12:13',0),(1612,45,'logged in from: ::1','users','2016-07-19 11:19:16',0),(1613,47,'logged in from: ::1','users','2016-07-19 13:28:24',0),(1614,48,'logged in from: ::1','users','2016-07-19 13:36:07',0),(1615,47,'logged in from: ::1','users','2016-07-19 13:37:38',0),(1616,9,'logged in from: ::1','users','2016-07-19 11:38:09',0),(1617,14,'logged in from: ::1','users','2016-07-19 11:38:42',0),(1618,20,'logged in from: ::1','users','2016-07-19 11:38:58',0),(1619,46,'logged in from: 127.0.0.1','users','2016-07-19 13:39:12',0),(1620,45,'logged in from: ::1','users','2016-07-19 11:50:39',0),(1621,45,'logged in from: 127.0.0.1','users','2016-07-19 14:34:30',0),(1622,45,'logged in from: ::1','users','2016-07-19 16:17:03',0),(1623,9,'logged in from: ::1','users','2016-07-19 16:17:50',0),(1624,14,'logged in from: ::1','users','2016-07-19 16:32:56',0),(1625,14,'logged in from: ::1','users','2016-07-19 17:04:06',0),(1626,45,'logged in from: ::1','users','2016-07-19 17:54:50',0),(1627,20,'logged in from: 127.0.0.1','users','2016-07-19 18:11:41',0),(1628,9,'logged in from: 127.0.0.1','users','2016-07-19 18:13:10',0),(1629,9,'logged in from: ::1','users','2016-07-19 18:16:03',0),(1630,20,'logged in from: ::1','users','2016-07-19 18:31:38',0),(1631,9,'logged in from: ::1','users','2016-07-19 18:34:17',0),(1632,45,'logged in from: 127.0.0.1','users','2016-07-19 18:35:19',0),(1633,9,'logged in from: ::1','users','2016-07-20 05:33:54',0),(1634,45,'logged in from: ::1','users','2016-07-20 05:37:37',0),(1635,45,'logged in from: ::1','users','2016-07-20 05:53:50',0),(1636,20,'logged in from: ::1','users','2016-07-20 08:01:03',0),(1637,45,'logged in from: 127.0.0.1','users','2016-07-20 08:08:01',0),(1638,14,'logged in from: ::1','users','2016-07-20 08:36:43',0),(1639,45,'logged in from: ::1','users','2016-07-20 08:40:36',0),(1640,9,'logged in from: ::1','users','2016-07-20 06:54:05',0),(1641,45,'logged in from: ::1','users','2016-07-20 06:54:26',0),(1642,9,'logged in from: ::1','users','2016-07-20 09:04:32',0),(1643,14,'logged in from: ::1','users','2016-07-20 09:04:59',0),(1644,45,'logged in from: ::1','users','2016-07-20 09:07:47',0),(1645,48,'logged in from: ::1','users','2016-07-20 11:34:12',0),(1646,47,'logged in from: ::1','users','2016-07-20 11:35:52',0),(1647,9,'logged in from: ::1','users','2016-07-20 09:38:58',0),(1648,45,'logged in from: 127.0.0.1','users','2016-07-20 10:23:56',0),(1649,9,'logged in from: 127.0.0.1','users','2016-07-20 10:24:02',0),(1650,46,'logged in from: 127.0.0.1','users','2016-07-20 13:26:18',0),(1651,14,'logged in from: ::1','users','2016-07-20 11:27:01',0),(1652,20,'logged in from: ::1','users','2016-07-20 11:27:28',0),(1653,14,'logged in from: ::1','users','2016-07-20 11:28:33',0),(1654,14,'logged in from: 127.0.0.1','users','2016-07-20 11:31:02',0),(1655,20,'logged in from: ::1','users','2016-07-20 11:35:05',0),(1656,20,'logged in from: ::1','users','2016-07-20 11:35:13',0),(1657,45,'logged in from: 127.0.0.1','users','2016-07-20 13:37:35',0),(1658,9,'logged in from: ::1','users','2016-07-20 11:39:20',0),(1659,45,'logged in from: ::1','users','2016-07-20 12:09:33',0),(1660,20,'logged in from: ::1','users','2016-07-20 12:20:23',0),(1661,45,'logged in from: ::1','users','2016-07-20 13:57:14',0),(1662,20,'logged in from: ::1','users','2016-07-20 14:12:24',0),(1663,45,'logged in from: ::1','users','2016-07-20 14:44:33',0),(1664,14,'logged in from: ::1','users','2016-07-20 14:47:23',0),(1665,20,'logged in from: ::1','users','2016-07-20 14:50:53',0),(1666,16,'logged in from: ::1','users','2016-07-20 14:51:26',0),(1667,20,'logged in from: ::1','users','2016-07-20 14:53:08',0),(1668,16,'logged in from: ::1','users','2016-07-20 14:54:50',0),(1669,14,'logged in from: ::1','users','2016-07-21 05:53:08',0),(1670,45,'logged in from: ::1','users','2016-07-21 07:56:53',0),(1671,45,'logged in from: ::1','users','2016-07-21 06:58:23',0),(1672,47,'logged in from: ::1','users','2016-07-21 09:22:26',0),(1673,20,'logged in from: ::1','users','2016-07-21 07:26:35',0),(1674,48,'logged in from: 127.0.0.1','users','2016-07-21 09:34:43',0),(1675,20,'logged in from: ::1','users','2016-07-21 07:37:27',0),(1676,9,'logged in from: ::1','users','2016-07-21 07:37:49',0),(1677,14,'logged in from: ::1','users','2016-07-21 07:55:34',0),(1678,45,'logged in from: ::1','users','2016-07-21 09:57:36',0),(1679,20,'logged in from: ::1','users','2016-07-21 08:05:47',0),(1680,45,'logged in from: ::1','users','2016-07-21 08:06:35',0),(1681,20,'logged in from: ::1','users','2016-07-21 09:10:55',0),(1682,9,'logged in from: ::1','users','2016-07-21 09:28:28',0),(1683,48,'logged in from: 127.0.0.1','users','2016-07-21 11:36:04',0),(1684,47,'logged in from: ::1','users','2016-07-21 11:37:22',0),(1685,45,'logged in from: ::1','users','2016-07-21 10:02:35',0),(1686,20,'logged in from: ::1','users','2016-07-21 10:10:16',0),(1687,45,'logged in from: ::1','users','2016-07-21 10:11:31',0),(1688,20,'logged in from: ::1','users','2016-07-21 10:12:21',0),(1689,46,'logged in from: 127.0.0.1','users','2016-07-21 12:12:37',0),(1690,20,'logged in from: ::1','users','2016-07-21 10:13:22',0),(1691,45,'logged in from: ::1','users','2016-07-21 12:13:29',0),(1692,9,'logged in from: ::1','users','2016-07-21 10:33:29',0),(1693,14,'logged in from: ::1','users','2016-07-21 10:34:36',0),(1694,16,'logged in from: ::1','users','2016-07-21 10:35:53',0),(1695,45,'logged in from: ::1','users','2016-07-21 11:14:19',0),(1696,9,'logged in from: ::1','users','2016-07-21 13:13:03',0),(1697,47,'logged in from: ::1','users','2016-07-21 15:15:34',0),(1698,46,'logged in from: 127.0.0.1','users','2016-07-21 15:16:19',0),(1699,45,'logged in from: ::1','users','2016-07-21 15:17:23',0),(1700,9,'logged in from: ::1','users','2016-07-21 13:18:29',0),(1701,45,'logged in from: ::1','users','2016-07-21 13:24:30',0),(1702,20,'logged in from: ::1','users','2016-07-21 13:29:22',0),(1703,20,'logged in from: ::1','users','2016-07-21 13:41:42',0),(1704,45,'logged in from: ::1','users','2016-07-21 14:22:46',0),(1705,20,'logged in from: ::1','users','2016-07-21 14:30:32',0),(1706,14,'logged in from: ::1','users','2016-07-21 14:32:48',0),(1707,14,'logged in from: ::1','users','2016-07-21 14:33:01',0),(1708,20,'logged in from: ::1','users','2016-07-21 14:35:52',0),(1709,45,'logged in from: ::1','users','2016-07-21 14:36:10',0),(1710,20,'logged in from: ::1','users','2016-07-21 14:54:02',0),(1711,14,'logged in from: ::1','users','2016-07-21 14:54:26',0),(1712,9,'logged in from: ::1','users','2016-07-21 14:54:42',0),(1713,14,'logged in from: ::1','users','2016-07-21 14:56:07',0),(1714,9,'logged in from: ::1','users','2016-07-21 15:13:35',0),(1715,45,'logged in from: ::1','users','2016-07-22 05:06:45',0),(1716,20,'logged in from: ::1','users','2016-07-22 05:33:16',0),(1717,14,'logged in from: ::1','users','2016-07-22 05:49:19',0),(1718,20,'logged in from: ::1','users','2016-07-22 05:49:34',0),(1719,14,'logged in from: ::1','users','2016-07-22 06:13:55',0),(1720,45,'logged in from: ::1','users','2016-07-22 06:14:24',0),(1721,45,'logged in from: ::1','users','2016-07-22 08:27:05',0),(1722,20,'logged in from: ::1','users','2016-07-22 08:27:30',0),(1723,20,'logged in from: ::1','users','2016-07-22 06:28:04',0),(1724,45,'logged in from: ::1','users','2016-07-22 06:32:40',0),(1725,48,'logged in from: ::1','users','2016-07-22 09:27:15',0),(1726,20,'logged in from: ::1','users','2016-07-22 07:30:01',0),(1727,9,'logged in from: ::1','users','2016-07-22 07:42:43',0),(1728,14,'logged in from: 127.0.0.1','users','2016-07-22 09:07:05',0),(1729,9,'logged in from: ::1','users','2016-07-22 09:08:30',0),(1730,45,'logged in from: ::1','users','2016-07-22 09:10:33',0),(1731,47,'logged in from: ::1','users','2016-07-22 11:16:12',0),(1732,45,'logged in from: 127.0.0.1','users','2016-07-22 09:16:26',0),(1733,45,'logged in from: ::1','users','2016-07-22 10:10:19',0),(1734,20,'logged in from: ::1','users','2016-07-22 10:57:39',0),(1735,45,'logged in from: ::1','users','2016-07-22 11:00:40',0),(1736,14,'logged in from: 127.0.0.1','users','2016-07-22 11:10:13',0),(1737,20,'logged in from: ::1','users','2016-07-22 11:30:48',0),(1738,20,'logged in from: 127.0.0.1','users','2016-07-22 11:49:42',0),(1739,14,'logged in from: ::1','users','2016-07-22 12:06:06',0),(1740,45,'logged in from: ::1','users','2016-07-22 12:52:07',0),(1741,47,'logged in from: ::1','users','2016-07-22 15:02:24',0),(1742,9,'logged in from: ::1','users','2016-07-22 13:06:07',0),(1743,46,'logged in from: ::1','users','2016-07-22 15:16:26',0),(1744,45,'logged in from: ::1','users','2016-07-22 13:21:26',0),(1745,9,'logged in from: ::1','users','2016-07-22 13:38:26',0),(1746,20,'logged in from: ::1','users','2016-07-22 13:38:32',0),(1747,9,'logged in from: ::1','users','2016-07-22 13:52:09',0),(1748,14,'logged in from: ::1','users','2016-07-22 13:52:35',0),(1749,9,'logged in from: ::1','users','2016-07-22 13:53:43',0),(1750,20,'logged in from: ::1','users','2016-07-22 13:54:20',0),(1751,9,'logged in from: ::1','users','2016-07-22 13:56:27',0),(1752,14,'logged in from: ::1','users','2016-07-22 14:25:31',0),(1753,15,'logged in from: ::1','users','2016-07-22 14:26:00',0),(1754,16,'logged in from: ::1','users','2016-07-22 14:26:11',0),(1755,45,'logged in from: ::1','users','2016-07-22 14:31:22',0),(1756,45,'logged in from: 127.0.0.1','users','2016-07-22 14:48:23',0),(1757,45,'logged in from: ::1','users','2016-07-22 17:22:45',0),(1758,20,'logged in from: ::1','users','2016-07-22 15:25:01',0),(1759,45,'logged in from: ::1','users','2016-07-22 15:28:54',0),(1760,20,'logged in from: ::1','users','2016-07-22 15:30:37',0),(1761,45,'logged in from: ::1','users','2016-07-22 15:34:01',0),(1762,9,'logged in from: ::1','users','2016-07-22 15:39:21',0),(1763,48,'logged in from: ::1','users','2016-07-22 17:44:51',0),(1764,47,'logged in from: ::1','users','2016-07-22 18:00:20',0),(1765,45,'logged in from: ::1','users','2016-07-23 06:47:36',0),(1766,20,'logged in from: ::1','users','2016-07-23 04:48:12',0),(1767,45,'logged in from: ::1','users','2016-07-23 04:48:19',0),(1768,45,'logged in from: ::1','users','2016-07-23 04:49:16',0),(1769,14,'logged in from: ::1','users','2016-07-23 05:22:30',0),(1770,9,'logged in from: ::1','users','2016-07-23 06:07:07',0),(1771,45,'logged in from: ::1','users','2016-07-23 06:37:52',0),(1772,20,'logged in from: ::1','users','2016-07-23 08:42:19',0),(1773,9,'logged in from: ::1','users','2016-07-23 08:44:32',0),(1774,20,'logged in from: ::1','users','2016-07-23 08:54:44',0),(1775,45,'logged in from: ::1','users','2016-07-23 08:55:32',0),(1776,14,'logged in from: ::1','users','2016-07-23 08:58:23',0),(1777,20,'logged in from: ::1','users','2016-07-23 08:59:07',0),(1778,45,'logged in from: ::1','users','2016-07-23 09:06:42',0),(1779,20,'logged in from: ::1','users','2016-07-23 07:48:32',0),(1780,9,'logged in from: ::1','users','2016-07-23 07:56:34',0),(1781,9,'logged in from: ::1','users','2016-07-23 10:02:26',0),(1782,45,'logged in from: ::1','users','2016-07-23 08:50:06',0),(1783,2,'logged in from: ::1','users','2016-07-23 09:26:00',0),(1784,45,'logged in from: ::1','users','2016-07-23 09:43:00',0),(1785,45,'logged in from: ::1','users','2016-07-23 10:15:28',0),(1786,45,'logged in from: ::1','users','2016-07-23 10:15:47',0),(1787,14,'logged in from: 127.0.0.1','users','2016-07-23 12:23:02',0),(1788,45,'logged in from: ::1','users','2016-07-23 13:19:51',0),(1789,45,'logged in from: ::1','users','2016-07-23 12:02:42',0),(1790,9,'logged in from: ::1','users','2016-07-23 14:09:36',0),(1791,20,'logged in from: 127.0.0.1','users','2016-07-23 15:48:48',0),(1792,14,'logged in from: ::1','users','2016-07-23 17:18:15',0),(1793,45,'logged in from: ::1','users','2016-07-25 05:08:07',0),(1794,20,'logged in from: ::1','users','2016-07-25 05:36:01',0),(1795,45,'logged in from: ::1','users','2016-07-25 05:54:53',0),(1796,20,'logged in from: ::1','users','2016-07-25 06:02:50',0),(1797,14,'logged in from: ::1','users','2016-07-25 06:02:58',0),(1798,20,'logged in from: ::1','users','2016-07-25 06:03:31',0),(1799,48,'logged in from: ::1','users','2016-07-25 08:04:07',0),(1800,47,'logged in from: ::1','users','2016-07-25 08:04:38',0),(1801,46,'logged in from: 127.0.0.1','users','2016-07-25 08:04:54',0),(1802,45,'logged in from: 127.0.0.1','users','2016-07-25 08:05:09',0),(1803,45,'logged in from: ::1','users','2016-07-25 06:12:18',0),(1804,14,'logged in from: ::1','users','2016-07-25 06:12:55',0),(1805,9,'logged in from: ::1','users','2016-07-25 06:13:43',0),(1806,14,'logged in from: ::1','users','2016-07-25 06:13:58',0),(1807,20,'logged in from: ::1','users','2016-07-25 06:14:05',0),(1808,45,'logged in from: ::1','users','2016-07-25 06:16:49',0),(1809,20,'logged in from: ::1','users','2016-07-25 06:22:04',0),(1810,14,'logged in from: ::1','users','2016-07-25 06:23:06',0),(1811,20,'logged in from: ::1','users','2016-07-25 06:26:08',0),(1812,45,'logged in from: 127.0.0.1','users','2016-07-25 06:32:12',0),(1813,20,'logged in from: ::1','users','2016-07-25 06:35:36',0),(1814,20,'logged in from: 127.0.0.1','users','2016-07-25 08:42:41',0),(1815,45,'logged in from: 127.0.0.1','users','2016-07-25 08:45:04',0),(1816,45,'logged in from: ::1','users','2016-07-25 06:50:32',0),(1817,9,'logged in from: ::1','users','2016-07-25 07:32:15',0),(1818,14,'logged in from: ::1','users','2016-07-25 07:33:26',0),(1819,20,'logged in from: ::1','users','2016-07-25 07:37:07',0),(1820,48,'logged in from: ::1','users','2016-07-25 07:38:29',0),(1821,45,'logged in from: ::1','users','2016-07-25 07:42:03',0),(1822,45,'logged in from: ::1','users','2016-07-25 11:31:57',0),(1823,9,'logged in from: ::1','users','2016-07-25 09:36:42',0),(1824,14,'logged in from: ::1','users','2016-07-25 09:43:48',0),(1825,45,'logged in from: ::1','users','2016-07-25 09:48:53',0),(1826,48,'logged in from: ::1','users','2016-07-25 11:53:38',0),(1827,9,'logged in from: ::1','users','2016-07-25 10:07:22',0),(1828,45,'logged in from: ::1','users','2016-07-25 10:08:40',0),(1829,9,'logged in from: ::1','users','2016-07-25 10:20:31',0),(1830,14,'logged in from: ::1','users','2016-07-25 10:21:57',0),(1831,20,'logged in from: ::1','users','2016-07-25 10:24:19',0),(1832,45,'logged in from: ::1','users','2016-07-25 10:26:07',0),(1833,20,'logged in from: ::1','users','2016-07-25 10:32:26',0),(1834,14,'logged in from: ::1','users','2016-07-25 10:45:19',0),(1835,9,'logged in from: ::1','users','2016-07-25 11:28:34',0),(1836,45,'logged in from: ::1','users','2016-07-25 11:30:47',0),(1837,9,'logged in from: ::1','users','2016-07-25 11:33:20',0),(1838,14,'logged in from: ::1','users','2016-07-25 11:36:20',0),(1839,15,'logged in from: ::1','users','2016-07-25 11:59:58',0),(1840,45,'logged in from: ::1','users','2016-07-25 12:03:05',0),(1841,45,'logged in from: ::1','users','2016-07-25 12:07:33',0),(1842,15,'logged in from: ::1','users','2016-07-25 12:21:22',0),(1843,16,'logged in from: ::1','users','2016-07-25 12:21:36',0),(1844,45,'logged in from: ::1','users','2016-07-25 12:45:15',0),(1845,45,'logged in from: ::1','users','2016-07-25 15:03:30',0),(1846,45,'logged in from: ::1','users','2016-07-25 13:06:43',0),(1847,9,'logged in from: ::1','users','2016-07-25 13:13:54',0),(1848,20,'logged in from: ::1','users','2016-07-25 13:18:38',0),(1849,9,'logged in from: ::1','users','2016-07-25 13:25:44',0),(1850,9,'logged in from: ::1','users','2016-07-25 16:46:07',0),(1851,45,'logged in from: ::1','users','2016-07-25 17:22:11',0),(1852,9,'logged in from: ::1','users','2016-07-26 04:36:33',0),(1853,14,'logged in from: ::1','users','2016-07-26 05:20:28',0),(1854,20,'logged in from: ::1','users','2016-07-26 05:30:53',0),(1855,48,'logged in from: ::1','users','2016-07-26 07:33:46',0),(1856,47,'logged in from: ::1','users','2016-07-26 07:37:13',0),(1857,20,'logged in from: ::1','users','2016-07-26 05:47:15',0),(1858,48,'logged in from: ::1','users','2016-07-26 06:03:35',0),(1859,9,'logged in from: ::1','users','2016-07-26 06:04:40',0),(1860,45,'logged in from: ::1','users','2016-07-26 06:05:35',0),(1861,20,'logged in from: ::1','users','2016-07-26 06:19:19',0),(1862,20,'logged in from: ::1','users','2016-07-26 06:28:21',0),(1863,9,'logged in from: ::1','users','2016-07-26 06:30:15',0),(1864,45,'logged in from: ::1','users','2016-07-26 08:31:15',0),(1865,9,'logged in from: ::1','users','2016-07-26 08:31:45',0),(1866,14,'logged in from: ::1','users','2016-07-26 06:36:52',0),(1867,45,'logged in from: ::1','users','2016-07-26 06:38:33',0),(1868,14,'logged in from: ::1','users','2016-07-26 06:44:41',0),(1869,14,'logged in from: ::1','users','2016-07-26 07:29:43',0),(1870,14,'logged in from: ::1','users','2016-07-26 07:32:39',0),(1871,9,'logged in from: ::1','users','2016-07-26 07:36:21',0),(1872,20,'logged in from: ::1','users','2016-07-26 09:04:37',0),(1873,45,'logged in from: ::1','users','2016-07-26 09:23:43',0),(1874,45,'logged in from: ::1','users','2016-07-26 09:37:46',0),(1875,20,'logged in from: ::1','users','2016-07-26 09:41:28',0),(1876,9,'logged in from: ::1','users','2016-07-26 09:49:18',0),(1877,9,'logged in from: ::1','users','2016-07-26 09:50:17',0),(1878,45,'logged in from: ::1','users','2016-07-26 09:52:34',0),(1879,9,'logged in from: ::1','users','2016-07-26 09:55:28',0),(1880,48,'logged in from: ::1','users','2016-07-26 11:59:39',0),(1881,45,'logged in from: ::1','users','2016-07-26 12:12:16',0),(1882,9,'logged in from: ::1','users','2016-07-26 10:27:40',0),(1883,45,'logged in from: ::1','users','2016-07-26 10:30:51',0),(1884,9,'logged in from: ::1','users','2016-07-26 10:31:41',0),(1885,45,'logged in from: ::1','users','2016-07-26 10:36:06',0),(1886,48,'logged in from: ::1','users','2016-07-26 12:49:01',0),(1887,45,'logged in from: ::1','users','2016-07-26 11:25:21',0),(1888,45,'logged in from: ::1','users','2016-07-26 11:33:09',0),(1889,20,'logged in from: ::1','users','2016-07-26 11:36:15',0),(1890,45,'logged in from: ::1','users','2016-07-26 11:37:50',0),(1891,45,'logged in from: ::1','users','2016-07-26 11:44:54',0),(1892,20,'logged in from: ::1','users','2016-07-26 11:49:07',0),(1893,9,'logged in from: ::1','users','2016-07-26 11:49:31',0),(1894,14,'logged in from: ::1','users','2016-07-26 11:54:50',0),(1895,45,'logged in from: ::1','users','2016-07-26 12:12:22',0),(1896,20,'logged in from: ::1','users','2016-07-26 12:14:52',0),(1897,14,'logged in from: ::1','users','2016-07-26 12:16:41',0),(1898,45,'logged in from: ::1','users','2016-07-26 14:20:36',0),(1899,20,'logged in from: ::1','users','2016-07-26 12:22:36',0),(1900,14,'logged in from: ::1','users','2016-07-26 12:23:14',0),(1901,47,'logged in from: ::1','users','2016-07-26 12:48:12',0),(1902,45,'logged in from: ::1','users','2016-07-26 12:52:18',0),(1903,45,'logged in from: ::1','users','2016-07-27 04:40:52',0),(1904,9,'logged in from: ::1','users','2016-07-27 05:46:42',0),(1905,14,'logged in from: ::1','users','2016-07-27 05:47:03',0),(1906,20,'logged in from: ::1','users','2016-07-27 05:53:41',0),(1907,21,'logged in from: ::1','users','2016-07-27 05:56:31',0),(1908,20,'logged in from: ::1','users','2016-07-27 05:59:11',0),(1909,45,'logged in from: ::1','users','2016-07-27 08:40:29',0),(1910,45,'logged in from: ::1','users','2016-07-27 09:18:44',0),(1911,45,'logged in from: ::1','users','2016-07-27 11:15:10',0),(1912,20,'logged in from: ::1','users','2016-07-27 11:32:14',0),(1913,47,'logged in from: ::1','users','2016-07-27 09:47:27',0),(1914,45,'logged in from: ::1','users','2016-07-27 09:59:22',0),(1915,48,'logged in from: ::1','users','2016-07-27 12:55:55',0),(1916,48,'logged in from: ::1','users','2016-07-27 12:57:24',0),(1917,47,'logged in from: ::1','users','2016-07-27 13:34:19',0),(1918,46,'logged in from: ::1','users','2016-07-27 13:52:26',0),(1919,45,'logged in from: ::1','users','2016-07-27 13:53:04',0),(1920,46,'logged in from: ::1','users','2016-07-27 14:10:12',0),(1921,48,'logged in from: ::1','users','2016-07-27 14:10:40',0),(1922,46,'logged in from: ::1','users','2016-07-27 15:00:42',0),(1923,45,'logged in from: ::1','users','2016-07-27 15:12:03',0),(1924,46,'logged in from: ::1','users','2016-07-27 15:13:38',0),(1925,45,'logged in from: ::1','users','2016-07-27 15:19:16',0),(1926,20,'logged in from: ::1','users','2016-07-27 13:20:29',0),(1927,46,'logged in from: ::1','users','2016-07-27 15:20:54',0),(1928,45,'logged in from: ::1','users','2016-07-27 15:26:33',0),(1929,46,'logged in from: ::1','users','2016-07-27 15:27:17',0),(1930,45,'logged in from: ::1','users','2016-07-27 15:41:02',0),(1931,47,'logged in from: ::1','users','2016-07-27 13:41:21',0),(1932,20,'logged in from: ::1','users','2016-07-27 14:12:00',0),(1933,47,'logged in from: ::1','users','2016-07-27 14:19:33',0),(1934,15,'logged in from: ::1','users','2016-07-27 16:47:41',0),(1935,16,'logged in from: ::1','users','2016-07-27 16:48:22',0),(1936,20,'logged in from: ::1','users','2016-07-27 16:53:59',0),(1937,16,'logged in from: ::1','users','2016-07-27 17:15:05',0),(1938,14,'logged in from: ::1','users','2016-07-27 17:47:57',0),(1939,47,'logged in from: ::1','users','2016-07-28 05:43:42',0),(1940,14,'logged in from: ::1','users','2016-07-28 07:49:40',0),(1941,20,'logged in from: ::1','users','2016-07-28 07:50:36',0),(1942,9,'logged in from: ::1','users','2016-07-28 07:51:21',0),(1943,20,'logged in from: ::1','users','2016-07-28 06:19:38',0),(1944,45,'logged in from: ::1','users','2016-07-28 06:22:13',0),(1945,20,'logged in from: ::1','users','2016-07-28 08:25:17',0),(1946,10,'logged in from: ::1','users','2016-07-28 08:50:20',0),(1947,20,'logged in from: ::1','users','2016-07-28 07:03:52',0),(1948,9,'logged in from: ::1','users','2016-07-28 09:39:35',0),(1949,9,'logged in from: 127.0.0.1','users','2016-07-28 09:43:24',0),(1950,45,'logged in from: ::1','users','2016-07-28 09:13:17',0),(1951,14,'logged in from: ::1','users','2016-07-28 11:27:44',0),(1952,14,'logged in from: ::1','users','2016-07-28 12:06:24',0),(1953,45,'logged in from: ::1','users','2016-07-28 12:30:33',0),(1954,45,'logged in from: ::1','users','2016-07-28 13:19:47',0),(1955,20,'logged in from: ::1','users','2016-07-28 14:11:12',0),(1956,20,'logged in from: ::1','users','2016-07-28 17:44:21',0),(1957,45,'logged in from: ::1','users','2016-07-28 18:26:27',0),(1958,45,'logged in from: ::1','users','2016-07-29 05:06:08',0),(1959,20,'logged in from: ::1','users','2016-07-29 05:48:09',0),(1960,47,'logged in from: ::1','users','2016-07-29 06:14:38',0),(1961,20,'logged in from: ::1','users','2016-07-29 06:15:56',0),(1962,45,'logged in from: ::1','users','2016-07-29 08:40:01',0),(1963,9,'logged in from: ::1','users','2016-07-29 06:47:30',0),(1964,45,'logged in from: ::1','users','2016-07-29 08:54:53',0),(1965,20,'logged in from: ::1','users','2016-07-29 06:57:10',0),(1966,45,'logged in from: ::1','users','2016-07-29 07:12:26',0),(1967,20,'logged in from: ::1','users','2016-07-29 07:41:23',0),(1968,20,'logged in from: ::1','users','2016-07-29 09:56:13',0),(1969,45,'logged in from: ::1','users','2016-07-29 13:15:47',0),(1970,20,'logged in from: ::1','users','2016-07-29 13:47:45',0),(1971,45,'logged in from: ::1','users','2016-07-29 14:08:56',0),(1972,45,'logged in from: ::1','users','2016-07-29 12:10:48',0),(1973,47,'logged in from: ::1','users','2016-07-29 13:31:06',0),(1974,9,'logged in from: ::1','users','2016-07-29 15:59:11',0),(1975,20,'logged in from: ::1','users','2016-07-29 16:07:19',0),(1976,20,'logged in from: ::1','users','2016-07-29 14:19:46',0),(1977,47,'logged in from: ::1','users','2016-07-29 16:30:03',0),(1978,45,'logged in from: ::1','users','2016-07-29 16:30:16',0),(1979,45,'logged in from: ::1','users','2016-07-29 14:31:49',0),(1980,20,'logged in from: ::1','users','2016-07-29 15:26:22',0),(1981,45,'logged in from: ::1','users','2016-07-29 15:28:50',0),(1982,9,'logged in from: ::1','users','2016-07-29 16:28:04',0),(1983,14,'logged in from: ::1','users','2016-07-29 16:58:58',0),(1984,20,'logged in from: ::1','users','2016-07-29 16:59:29',0),(1985,45,'logged in from: ::1','users','2016-07-30 04:39:18',0),(1986,45,'logged in from: ::1','users','2016-07-30 05:28:39',0),(1987,20,'logged in from: ::1','users','2016-07-30 05:43:26',0),(1988,9,'logged in from: ::1','users','2016-07-30 05:44:57',0),(1989,45,'logged in from: ::1','users','2016-07-30 05:57:05',0),(1990,48,'logged in from: ::1','users','2016-07-30 08:25:35',0),(1991,14,'logged in from: ::1','users','2016-07-30 08:26:27',0),(1992,48,'logged in from: ::1','users','2016-07-30 08:30:56',0),(1993,14,'logged in from: ::1','users','2016-07-30 06:32:22',0),(1994,20,'logged in from: ::1','users','2016-07-30 06:40:23',0),(1995,9,'logged in from: ::1','users','2016-07-30 07:36:31',0),(1996,14,'logged in from: ::1','users','2016-07-30 07:55:06',0),(1997,14,'logged in from: ::1','users','2016-07-30 09:09:38',0),(1998,20,'logged in from: ::1','users','2016-07-30 09:13:33',0),(1999,48,'logged in from: ::1','users','2016-07-30 09:33:14',0),(2000,45,'logged in from: ::1','users','2016-07-30 09:35:00',0),(2001,45,'logged in from: ::1','users','2016-07-30 10:03:41',0),(2002,20,'logged in from: ::1','users','2016-07-30 10:09:05',0),(2003,9,'logged in from: ::1','users','2016-07-30 12:06:10',0),(2004,45,'logged in from: ::1','users','2016-07-30 12:29:04',0),(2005,14,'logged in from: ::1','users','2016-07-30 12:34:49',0),(2006,20,'logged in from: ::1','users','2016-07-30 12:37:08',0),(2007,45,'logged in from: ::1','users','2016-07-30 13:03:24',0),(2008,48,'logged in from: ::1','users','2016-07-30 15:16:31',0),(2009,2,'logged in from: ::1','users','2016-07-30 13:28:25',0),(2010,2,'Created Module: CCO : ::1','modulebuilder','2016-07-30 13:30:51',0),(2011,20,'logged in from: ::1','users','2016-07-30 13:34:54',0),(2012,45,'logged in from: ::1','users','2016-07-30 16:57:33',0),(2013,20,'logged in from: ::1','users','2016-07-31 06:01:06',0),(2014,48,'logged in from: ::1','users','2016-07-31 08:04:57',0),(2015,48,'logged in from: ::1','users','2016-07-31 09:11:04',0),(2016,20,'logged in from: ::1','users','2016-07-31 10:10:57',0),(2017,47,'logged in from: ::1','users','2016-07-31 08:47:19',0),(2018,14,'logged in from: ::1','users','2016-07-31 10:51:29',0),(2019,48,'logged in from: ::1','users','2016-07-31 10:57:10',0),(2020,14,'logged in from: ::1','users','2016-07-31 11:11:30',0),(2021,20,'logged in from: ::1','users','2016-07-31 10:21:02',0),(2022,48,'logged in from: ::1','users','2016-07-31 12:23:43',0),(2023,47,'logged in from: ::1','users','2016-07-31 10:32:36',0),(2024,47,'logged in from: ::1','users','2016-07-31 12:37:17',0),(2025,20,'logged in from: ::1','users','2016-07-31 13:35:01',0),(2026,45,'logged in from: ::1','users','2016-07-31 13:43:31',0),(2027,47,'logged in from: ::1','users','2016-07-31 13:44:07',0),(2028,45,'logged in from: ::1','users','2016-07-31 16:08:14',0),(2029,20,'logged in from: ::1','users','2016-07-31 14:10:59',0),(2030,45,'logged in from: ::1','users','2016-07-31 14:38:59',0),(2031,20,'logged in from: ::1','users','2016-07-31 14:41:42',0),(2032,47,'logged in from: ::1','users','2016-07-31 14:46:37',0),(2033,9,'logged in from: ::1','users','2016-07-31 17:12:10',0),(2034,20,'logged in from: ::1','users','2016-07-31 17:15:34',0),(2035,45,'logged in from: ::1','users','2016-08-01 04:41:07',0),(2036,45,'logged in from: ::1','users','2016-08-01 07:51:24',0),(2037,20,'logged in from: ::1','users','2016-08-01 07:53:13',0),(2038,47,'logged in from: ::1','users','2016-08-01 06:01:17',0),(2039,2,'logged in from: ::1','users','2016-08-01 08:09:17',0),(2040,45,'logged in from: ::1','users','2016-08-01 08:10:20',0),(2041,45,'logged in from: ::1','users','2016-08-01 08:11:19',0),(2042,20,'logged in from: ::1','users','2016-08-01 06:21:50',0),(2043,47,'logged in from: ::1','users','2016-08-01 06:24:10',0),(2044,20,'logged in from: ::1','users','2016-08-01 06:26:17',0),(2045,45,'logged in from: ::1','users','2016-08-01 08:30:06',0),(2046,45,'logged in from: ::1','users','2016-08-01 06:49:15',0),(2047,45,'logged in from: ::1','users','2016-08-01 07:03:42',0),(2048,20,'logged in from: ::1','users','2016-08-01 07:06:23',0),(2049,20,'logged in from: ::1','users','2016-08-01 07:07:42',0),(2050,45,'logged in from: ::1','users','2016-08-01 09:32:47',0),(2051,20,'logged in from: ::1','users','2016-08-01 07:48:55',0),(2052,47,'logged in from: ::1','users','2016-08-01 07:49:08',0),(2053,48,'logged in from: ::1','users','2016-08-01 09:56:17',0),(2054,20,'logged in from: ::1','users','2016-08-01 11:14:27',0),(2055,20,'logged in from: ::1','users','2016-08-01 09:27:32',0),(2056,45,'logged in from: ::1','users','2016-08-01 11:37:17',0),(2057,45,'logged in from: ::1','users','2016-08-01 09:42:48',0),(2058,14,'logged in from: ::1','users','2016-08-01 09:46:57',0),(2059,47,'logged in from: ::1','users','2016-08-01 10:06:57',0),(2060,48,'logged in from: ::1','users','2016-08-01 12:09:45',0),(2061,20,'logged in from: ::1','users','2016-08-01 10:15:57',0),(2062,45,'logged in from: ::1','users','2016-08-01 12:38:35',0),(2063,9,'logged in from: ::1','users','2016-08-01 13:15:04',0),(2064,45,'logged in from: ::1','users','2016-08-01 15:18:32',0),(2065,20,'logged in from: ::1','users','2016-08-01 13:18:52',0),(2066,14,'logged in from: ::1','users','2016-08-01 13:30:09',0),(2067,45,'logged in from: ::1','users','2016-08-01 15:33:09',0),(2068,45,'logged in from: ::1','users','2016-08-01 15:38:31',0),(2069,45,'logged in from: 127.0.0.1','users','2016-08-01 16:01:45',0),(2070,47,'logged in from: ::1','users','2016-08-01 14:45:21',0),(2071,14,'logged in from: ::1','users','2016-08-01 16:55:01',0),(2072,45,'logged in from: ::1','users','2016-08-01 17:43:23',0),(2073,20,'logged in from: ::1','users','2016-08-01 15:58:49',0),(2074,47,'logged in from: ::1','users','2016-08-01 16:00:35',0),(2075,20,'logged in from: ::1','users','2016-08-01 16:09:43',0),(2076,45,'logged in from: ::1','users','2016-08-02 04:35:37',0),(2077,48,'logged in from: ::1','users','2016-08-02 07:47:34',0),(2078,20,'logged in from: ::1','users','2016-08-02 05:48:01',0),(2079,47,'logged in from: ::1','users','2016-08-02 07:49:12',0),(2080,46,'logged in from: 127.0.0.1','users','2016-08-02 07:52:42',0),(2081,45,'logged in from: 127.0.0.1','users','2016-08-02 07:53:43',0),(2082,45,'logged in from: ::1','users','2016-08-02 06:04:35',0),(2083,45,'logged in from: ::1','users','2016-08-02 06:18:45',0),(2084,45,'logged in from: ::1','users','2016-08-02 06:19:38',0),(2085,47,'logged in from: ::1','users','2016-08-02 06:21:59',0),(2086,45,'logged in from: ::1','users','2016-08-02 06:26:26',0),(2087,36,'logged in from: ::1','users','2016-08-02 06:46:23',0),(2088,20,'logged in from: ::1','users','2016-08-02 06:47:02',0),(2089,9,'logged in from: ::1','users','2016-08-02 06:52:34',0),(2090,45,'logged in from: ::1','users','2016-08-02 07:18:08',0),(2091,45,'logged in from: ::1','users','2016-08-02 07:45:43',0),(2092,45,'logged in from: ::1','users','2016-08-02 09:16:38',0),(2093,45,'logged in from: ::1','users','2016-08-02 09:22:00',0),(2094,45,'logged in from: ::1','users','2016-08-02 09:26:34',0),(2095,45,'logged in from: ::1','users','2016-08-02 10:01:01',0),(2096,47,'logged in from: ::1','users','2016-08-02 12:11:45',0),(2097,45,'logged in from: ::1','users','2016-08-02 10:35:39',0),(2098,45,'logged in from: ::1','users','2016-08-02 12:39:56',0),(2099,9,'logged in from: ::1','users','2016-08-02 12:52:43',0),(2100,14,'logged in from: ::1','users','2016-08-02 13:01:25',0),(2101,20,'logged in from: ::1','users','2016-08-02 13:02:55',0),(2102,9,'logged in from: ::1','users','2016-08-02 11:05:17',0),(2103,20,'logged in from: ::1','users','2016-08-02 13:05:50',0),(2104,45,'logged in from: ::1','users','2016-08-02 13:07:08',0),(2105,45,'logged in from: ::1','users','2016-08-02 11:10:36',0),(2106,45,'logged in from: ::1','users','2016-08-02 11:19:47',0),(2107,9,'logged in from: ::1','users','2016-08-02 12:00:09',0),(2108,14,'logged in from: ::1','users','2016-08-02 12:08:47',0),(2109,9,'logged in from: ::1','users','2016-08-02 14:10:49',0),(2110,45,'logged in from: ::1','users','2016-08-02 12:17:31',0),(2111,14,'logged in from: ::1','users','2016-08-02 14:23:25',0),(2112,20,'logged in from: ::1','users','2016-08-02 14:26:33',0),(2113,20,'logged in from: ::1','users','2016-08-02 14:35:58',0),(2114,48,'logged in from: ::1','users','2016-08-02 14:39:44',0),(2115,47,'logged in from: ::1','users','2016-08-02 14:48:24',0),(2116,9,'logged in from: ::1','users','2016-08-02 14:48:40',0),(2117,45,'logged in from: ::1','users','2016-08-02 14:50:23',0),(2118,45,'logged in from: ::1','users','2016-08-02 15:07:08',0),(2119,9,'logged in from: ::1','users','2016-08-02 13:10:31',0),(2120,46,'logged in from: 127.0.0.1','users','2016-08-02 15:18:16',0),(2121,45,'logged in from: 127.0.0.1','users','2016-08-02 15:21:32',0),(2122,45,'logged in from: ::1','users','2016-08-02 15:36:34',0),(2123,9,'logged in from: ::1','users','2016-08-02 15:36:53',0),(2124,9,'logged in from: ::1','users','2016-08-02 16:06:45',0),(2125,20,'logged in from: ::1','users','2016-08-02 16:11:58',0),(2126,20,'logged in from: ::1','users','2016-08-02 16:20:08',0),(2127,47,'logged in from: ::1','users','2016-08-02 15:55:09',0),(2128,20,'logged in from: ::1','users','2016-08-02 15:55:48',0),(2129,45,'logged in from: ::1','users','2016-08-02 16:19:02',0),(2130,20,'logged in from: ::1','users','2016-08-02 16:25:12',0),(2131,45,'logged in from: ::1','users','2016-08-02 18:55:20',0),(2132,45,'logged in from: ::1','users','2016-08-02 19:19:27',0),(2133,45,'logged in from: ::1','users','2016-08-02 17:22:37',0),(2134,9,'logged in from: ::1','users','2016-08-02 19:45:29',0),(2135,45,'logged in from: ::1','users','2016-08-02 19:46:15',0),(2136,9,'logged in from: ::1','users','2016-08-02 19:48:15',0),(2137,14,'logged in from: ::1','users','2016-08-02 18:39:54',0),(2138,20,'logged in from: ::1','users','2016-08-02 20:57:01',0),(2139,45,'logged in from: ::1','users','2016-08-02 21:12:10',0),(2140,14,'logged in from: 127.0.0.1','users','2016-08-02 19:37:27',0),(2141,45,'logged in from: ::1','users','2016-08-02 20:04:20',0),(2142,45,'logged in from: ::1','users','2016-08-03 08:28:05',0),(2143,9,'logged in from: ::1','users','2016-08-03 08:29:57',0),(2144,20,'logged in from: ::1','users','2016-08-03 06:35:46',0),(2145,45,'logged in from: ::1','users','2016-08-03 06:55:07',0),(2146,45,'logged in from: ::1','users','2016-08-03 07:19:10',0),(2147,9,'logged in from: ::1','users','2016-08-03 09:24:56',0),(2148,45,'logged in from: ::1','users','2016-08-03 09:25:34',0),(2149,14,'logged in from: ::1','users','2016-08-03 09:27:01',0),(2150,19,'logged in from: ::1','users','2016-08-03 09:28:10',0),(2151,20,'logged in from: ::1','users','2016-08-03 09:28:38',0),(2152,45,'logged in from: ::1','users','2016-08-03 09:44:15',0),(2153,20,'logged in from: ::1','users','2016-08-03 07:48:32',0),(2154,45,'logged in from: ::1','users','2016-08-03 10:02:47',0),(2155,20,'logged in from: ::1','users','2016-08-03 11:12:19',0),(2156,20,'logged in from: ::1','users','2016-08-03 11:17:09',0),(2157,9,'logged in from: ::1','users','2016-08-03 11:18:49',0),(2158,45,'logged in from: ::1','users','2016-08-03 11:19:58',0),(2159,14,'logged in from: ::1','users','2016-08-03 11:22:14',0),(2160,45,'logged in from: ::1','users','2016-08-03 11:24:18',0),(2161,48,'logged in from: ::1','users','2016-08-03 12:25:25',0),(2162,9,'logged in from: ::1','users','2016-08-03 12:42:48',0),(2163,45,'logged in from: ::1','users','2016-08-03 10:48:43',0),(2164,14,'logged in from: ::1','users','2016-08-03 12:49:01',0),(2165,20,'logged in from: ::1','users','2016-08-03 12:50:07',0),(2166,14,'logged in from: ::1','users','2016-08-03 13:02:14',0),(2167,10,'logged in from: ::1','users','2016-08-03 13:02:52',0),(2168,45,'logged in from: ::1','users','2016-08-03 13:05:48',0),(2169,45,'logged in from: ::1','users','2016-08-03 13:07:38',0),(2170,20,'logged in from: ::1','users','2016-08-03 13:09:20',0),(2171,45,'logged in from: 127.0.0.1','users','2016-08-03 13:11:20',0),(2172,14,'logged in from: 127.0.0.1','users','2016-08-03 13:11:55',0),(2173,45,'logged in from: 127.0.0.1','users','2016-08-03 13:24:22',0),(2174,45,'logged in from: ::1','users','2016-08-03 13:36:03',0),(2175,20,'logged in from: ::1','users','2016-08-03 11:48:22',0),(2176,14,'logged in from: ::1','users','2016-08-03 11:56:49',0),(2177,20,'logged in from: ::1','users','2016-08-03 11:57:00',0),(2178,14,'logged in from: ::1','users','2016-08-03 11:58:17',0),(2179,20,'logged in from: ::1','users','2016-08-03 11:59:58',0),(2180,9,'logged in from: ::1','users','2016-08-03 14:02:37',0),(2181,20,'logged in from: ::1','users','2016-08-03 14:07:39',0),(2182,14,'logged in from: ::1','users','2016-08-03 12:08:51',0),(2183,20,'logged in from: ::1','users','2016-08-03 12:10:19',0),(2184,14,'logged in from: ::1','users','2016-08-03 12:10:44',0),(2185,20,'logged in from: ::1','users','2016-08-03 14:23:43',0),(2186,14,'logged in from: ::1','users','2016-08-03 14:24:35',0),(2187,20,'logged in from: ::1','users','2016-08-03 12:43:12',0),(2188,14,'logged in from: ::1','users','2016-08-03 12:43:56',0),(2189,20,'logged in from: ::1','users','2016-08-03 12:44:12',0),(2190,14,'logged in from: 127.0.0.1','users','2016-08-03 14:46:41',0),(2191,45,'logged in from: 127.0.0.1','users','2016-08-03 14:52:37',0),(2192,48,'logged in from: ::1','users','2016-08-03 13:40:25',0),(2193,45,'logged in from: ::1','users','2016-08-03 13:53:23',0),(2194,20,'logged in from: ::1','users','2016-08-03 14:10:07',0),(2195,20,'logged in from: ::1','users','2016-08-03 14:54:23',0),(2196,45,'logged in from: 127.0.0.1','users','2016-08-03 16:58:40',0),(2197,45,'logged in from: 127.0.0.1','users','2016-08-03 17:04:20',0),(2198,48,'logged in from: ::1','users','2016-08-03 17:15:02',0),(2199,47,'logged in from: ::1','users','2016-08-03 17:35:53',0),(2200,46,'logged in from: 127.0.0.1','users','2016-08-03 17:38:36',0),(2201,45,'logged in from: 127.0.0.1','users','2016-08-03 17:41:21',0),(2202,20,'logged in from: ::1','users','2016-08-03 17:55:12',0),(2203,2,'logged in from: ::1','users','2016-08-03 16:02:44',0),(2204,1,'logged in from: ::1','users','2016-08-03 16:07:13',0),(2205,45,'logged in from: ::1','users','2016-08-03 18:09:03',0),(2206,20,'logged in from: ::1','users','2016-08-03 16:09:17',0),(2207,9,'logged in from: ::1','users','2016-08-03 19:47:10',0),(2208,20,'logged in from: ::1','users','2016-08-03 23:52:19',0),(2209,45,'logged in from: ::1','users','2016-08-04 01:54:51',0),(2210,20,'logged in from: ::1','users','2016-08-04 02:00:51',0),(2211,45,'logged in from: ::1','users','2016-08-04 02:04:05',0),(2212,14,'logged in from: ::1','users','2016-08-04 02:22:04',0),(2213,45,'logged in from: ::1','users','2016-08-03 22:56:33',0),(2214,9,'logged in from: ::1','users','2016-08-04 02:37:16',0),(2215,20,'logged in from: ::1','users','2016-08-04 02:43:51',0),(2216,45,'logged in from: ::1','users','2016-08-04 06:00:23',0),(2217,45,'logged in from: ::1','users','2016-08-04 12:12:42',0),(2218,14,'logged in from: ::1','users','2016-08-04 06:51:41',0),(2219,45,'logged in from: ::1','users','2016-08-04 06:52:33',0),(2220,14,'logged in from: ::1','users','2016-08-04 06:53:01',0),(2221,45,'logged in from: ::1','users','2016-08-04 12:29:27',0),(2222,20,'logged in from: ::1','users','2016-08-04 14:30:44',0),(2223,45,'logged in from: ::1','users','2016-08-04 14:30:54',0),(2224,20,'logged in from: ::1','users','2016-08-04 14:32:29',0),(2225,45,'logged in from: ::1','users','2016-08-04 14:40:41',0),(2226,45,'logged in from: ::1','users','2016-08-04 14:40:56',0),(2227,20,'logged in from: ::1','users','2016-08-04 14:59:04',0),(2228,20,'logged in from: ::1','users','2016-08-04 15:08:11',0),(2229,45,'logged in from: ::1','users','2016-08-04 15:13:07',0),(2230,45,'logged in from: ::1','users','2016-08-04 16:25:07',0),(2231,9,'logged in from: ::1','users','2016-08-04 16:31:20',0),(2232,9,'logged in from: ::1','users','2016-08-04 16:40:19',0),(2233,45,'logged in from: ::1','users','2016-08-04 13:47:12',0),(2234,10,'logged in from: ::1','users','2016-08-04 17:23:51',0),(2235,20,'logged in from: ::1','users','2016-08-04 17:25:23',0),(2236,20,'logged in from: ::1','users','2016-08-04 17:29:39',0),(2237,45,'logged in from: ::1','users','2016-08-04 17:58:28',0),(2238,47,'logged in from: ::1','users','2016-08-04 18:58:10',0),(2239,48,'logged in from: ::1','users','2016-08-04 18:58:53',0),(2240,45,'logged in from: ::1','users','2016-08-04 19:26:27',0),(2241,10,'logged in from: ::1','users','2016-08-04 19:27:13',0),(2242,45,'logged in from: 127.0.0.1','users','2016-08-04 19:56:55',0),(2243,48,'logged in from: ::1','users','2016-08-04 20:22:50',0),(2244,45,'logged in from: ::1','users','2016-08-04 20:28:16',0),(2245,47,'logged in from: ::1','users','2016-08-04 20:45:21',0),(2246,45,'logged in from: ::1','users','2016-08-04 22:10:52',0),(2247,20,'logged in from: ::1','users','2016-08-04 22:39:27',0),(2248,9,'logged in from: ::1','users','2016-08-04 23:14:22',0),(2249,14,'logged in from: ::1','users','2016-08-04 23:14:54',0),(2250,45,'logged in from: ::1','users','2016-08-05 10:59:18',0),(2251,20,'logged in from: ::1','users','2016-08-05 11:01:33',0),(2252,16,'logged in from: ::1','users','2016-08-05 11:32:22',0),(2253,20,'logged in from: ::1','users','2016-08-05 11:55:53',0),(2254,47,'logged in from: ::1','users','2016-08-05 12:21:32',0),(2255,48,'logged in from: ::1','users','2016-08-05 12:24:06',0),(2256,20,'logged in from: ::1','users','2016-08-05 12:26:33',0),(2257,45,'logged in from: ::1','users','2016-08-05 13:02:00',0),(2258,9,'logged in from: ::1','users','2016-08-05 13:15:19',0),(2259,9,'logged in from: ::1','users','2016-08-05 15:28:55',0),(2260,20,'logged in from: ::1','users','2016-08-05 15:33:14',0),(2261,9,'logged in from: ::1','users','2016-08-05 15:50:08',0),(2262,47,'logged in from: ::1','users','2016-08-05 15:53:04',0),(2263,45,'logged in from: ::1','users','2016-08-05 16:13:14',0),(2264,45,'logged in from: ::1','users','2016-08-05 16:28:52',0),(2265,9,'logged in from: ::1','users','2016-08-05 16:31:14',0),(2266,45,'logged in from: ::1','users','2016-08-05 16:38:55',0),(2267,14,'logged in from: ::1','users','2016-08-05 16:52:00',0),(2268,9,'logged in from: ::1','users','2016-08-05 17:10:15',0),(2269,20,'logged in from: ::1','users','2016-08-05 19:38:04',0),(2270,45,'logged in from: ::1','users','2016-08-05 20:30:42',0),(2271,9,'logged in from: ::1','users','2016-08-05 20:38:38',0),(2272,9,'logged in from: ::1','users','2016-08-08 12:34:22',0),(2273,1,'logged in from: ::1','users','2016-08-08 14:47:26',0),(2274,1,'created a new CCO Admin: CCO Admin 1','users','2016-08-08 14:54:00',0),(2275,1,'created a new CCO: CCO','users','2016-08-08 14:55:08',0),(2276,55,'logged in from: ::1','users','2016-08-08 14:56:01',0),(2277,45,'logged in from: ::1','users','2016-08-08 21:05:20',0),(2278,45,'logged in from: ::1','users','2016-08-09 11:46:10',0),(2279,55,'logged in from: ::1','users','2016-08-09 11:59:36',0),(2280,20,'logged in from: ::1','users','2016-08-09 12:04:04',0),(2281,14,'logged in from: ::1','users','2016-08-09 12:14:57',0),(2282,14,'logged in from: ::1','users','2016-08-09 12:15:26',0),(2283,20,'logged in from: ::1','users','2016-08-09 12:17:06',0),(2284,45,'logged in from: ::1','users','2016-08-09 12:18:02',0),(2285,48,'logged in from: ::1','users','2016-08-09 12:56:21',0),(2286,45,'logged in from: ::1','users','2016-08-09 12:57:41',0),(2287,48,'logged in from: ::1','users','2016-08-09 12:58:34',0),(2288,20,'logged in from: ::1','users','2016-08-09 13:10:28',0),(2289,20,'logged in from: ::1','users','2016-08-09 18:52:44',0),(2290,45,'logged in from: ::1','users','2016-08-09 18:53:13',0),(2291,20,'logged in from: ::1','users','2016-08-09 19:15:47',0),(2292,20,'logged in from: ::1','users','2016-08-10 11:39:54',0),(2293,55,'logged in from: ::1','users','2016-08-10 11:40:08',0),(2294,45,'logged in from: ::1','users','2016-08-10 11:54:59',0),(2295,47,'logged in from: ::1','users','2016-08-10 13:11:03',0),(2296,9,'logged in from: ::1','users','2016-08-10 13:17:22',0),(2297,55,'logged in from: ::1','users','2016-08-10 14:48:15',0),(2298,45,'logged in from: ::1','users','2016-08-10 14:48:42',0),(2299,45,'logged in from: ::1','users','2016-08-10 14:49:50',0),(2300,20,'logged in from: ::1','users','2016-08-10 15:06:54',0),(2301,45,'logged in from: ::1','users','2016-08-10 16:20:30',0),(2302,20,'logged in from: ::1','users','2016-08-10 16:24:45',0),(2303,45,'logged in from: ::1','users','2016-08-10 17:00:47',0),(2304,45,'logged in from: ::1','users','2016-08-10 14:14:03',0),(2305,9,'logged in from: ::1','users','2016-08-10 18:40:19',0),(2306,20,'logged in from: ::1','users','2016-08-10 18:56:47',0),(2307,45,'logged in from: ::1','users','2016-08-11 06:53:27',0),(2308,20,'logged in from: ::1','users','2016-08-11 11:11:55',0),(2309,20,'logged in from: ::1','users','2016-08-11 11:15:18',0),(2310,55,'logged in from: ::1','users','2016-08-11 11:52:08',0),(2311,20,'logged in from: ::1','users','2016-08-11 11:53:19',0),(2312,45,'logged in from: ::1','users','2016-08-11 13:22:33',0),(2313,20,'logged in from: ::1','users','2016-08-11 14:49:29',0),(2314,20,'logged in from: ::1','users','2016-08-11 16:36:17',0),(2315,55,'logged in from: ::1','users','2016-08-11 17:07:06',0),(2316,20,'logged in from: ::1','users','2016-08-11 17:09:47',0),(2317,55,'logged in from: ::1','users','2016-08-11 17:10:31',0),(2318,20,'logged in from: ::1','users','2016-08-11 21:22:21',0),(2319,45,'logged in from: ::1','users','2016-08-12 10:36:02',0),(2320,9,'logged in from: ::1','users','2016-08-12 10:38:33',0),(2321,14,'logged in from: ::1','users','2016-08-12 10:40:17',0),(2322,20,'logged in from: ::1','users','2016-08-12 10:46:38',0),(2323,55,'logged in from: ::1','users','2016-08-12 11:19:44',0),(2324,55,'logged in from: ::1','users','2016-08-12 11:31:12',0),(2325,9,'logged in from: ::1','users','2016-08-12 15:45:29',0),(2326,45,'logged in from: ::1','users','2016-08-12 15:46:55',0),(2327,9,'logged in from: ::1','users','2016-08-12 15:54:02',0),(2328,14,'logged in from: ::1','users','2016-08-12 15:57:14',0),(2329,20,'logged in from: ::1','users','2016-08-12 15:58:23',0),(2330,55,'logged in from: ::1','users','2016-08-12 16:46:16',0),(2331,9,'logged in from: ::1','users','2016-08-12 18:10:32',0),(2332,45,'logged in from: ::1','users','2016-08-12 18:40:14',0),(2333,9,'logged in from: ::1','users','2016-08-12 19:01:45',0),(2334,55,'logged in from: ::1','users','2016-08-12 19:44:27',0),(2335,45,'logged in from: ::1','users','2016-08-13 11:00:22',0),(2336,20,'logged in from: ::1','users','2016-08-13 11:09:31',0),(2337,20,'logged in from: ::1','users','2016-08-13 11:11:24',0),(2338,55,'logged in from: ::1','users','2016-08-13 11:18:39',0),(2339,55,'logged in from: ::1','users','2016-08-13 11:21:02',0),(2340,45,'logged in from: ::1','users','2016-08-13 12:01:46',0),(2341,45,'logged in from: ::1','users','2016-08-13 12:23:58',0),(2342,20,'logged in from: ::1','users','2016-08-13 12:54:04',0),(2343,45,'logged in from: ::1','users','2016-08-13 14:37:14',0),(2344,20,'logged in from: ::1','users','2016-08-13 15:07:08',0),(2345,20,'logged in from: ::1','users','2016-08-13 15:20:11',0),(2346,20,'logged in from: ::1','users','2016-08-13 15:53:09',0),(2347,46,'logged in from: ::1','users','2016-08-13 17:11:33',0),(2348,20,'logged in from: ::1','users','2016-08-13 17:55:32',0),(2349,14,'logged in from: ::1','users','2016-08-13 21:06:24',0),(2350,9,'logged in from: ::1','users','2016-08-13 21:46:14',0),(2351,45,'logged in from: ::1','users','2016-08-13 22:18:05',0),(2352,45,'logged in from: ::1','users','2016-08-13 22:25:38',0),(2353,14,'logged in from: ::1','users','2016-08-13 22:42:02',0),(2354,45,'logged in from: ::1','users','2016-08-13 22:45:25',0),(2355,20,'logged in from: ::1','users','2016-08-13 22:45:45',0),(2356,45,'logged in from: ::1','users','2016-08-14 10:31:51',0),(2357,20,'logged in from: ::1','users','2016-08-14 10:53:11',0),(2358,55,'logged in from: ::1','users','2016-08-14 11:15:42',0),(2359,55,'logged in from: ::1','users','2016-08-14 11:36:09',0),(2360,55,'logged in from: ::1','users','2016-08-14 11:44:36',0),(2361,55,'logged in from: ::1','users','2016-08-14 12:04:49',0),(2362,55,'logged in from: ::1','users','2016-08-14 12:57:44',0),(2363,20,'logged in from: ::1','users','2016-08-14 19:45:31',0),(2364,55,'logged in from: ::1','users','2016-08-14 19:51:45',0),(2365,55,'logged in from: ::1','users','2016-08-14 20:49:04',0),(2366,45,'logged in from: ::1','users','2016-08-15 10:11:28',0),(2367,55,'logged in from: ::1','users','2016-08-15 10:52:59',0),(2368,55,'logged in from: ::1','users','2016-08-15 11:00:34',0),(2369,45,'logged in from: ::1','users','2016-08-15 11:11:26',0),(2370,55,'logged in from: ::1','users','2016-08-15 11:12:27',0),(2371,20,'logged in from: ::1','users','2016-08-15 11:13:27',0),(2372,55,'logged in from: ::1','users','2016-08-15 11:13:34',0),(2373,55,'logged in from: ::1','users','2016-08-15 11:22:48',0),(2374,45,'logged in from: ::1','users','2016-08-15 11:32:02',0),(2375,55,'logged in from: ::1','users','2016-08-15 11:32:31',0),(2376,55,'logged in from: ::1','users','2016-08-15 12:05:55',0),(2377,55,'logged in from: ::1','users','2016-08-15 12:14:42',0),(2378,20,'logged in from: ::1','users','2016-08-15 12:57:16',0),(2379,20,'logged in from: ::1','users','2016-08-15 16:13:44',0),(2380,55,'logged in from: ::1','users','2016-08-15 16:20:27',0),(2381,55,'logged in from: ::1','users','2016-08-15 17:16:18',0),(2382,45,'logged in from: ::1','users','2016-08-15 17:50:40',0),(2383,9,'logged in from: ::1','users','2016-08-15 17:58:00',0),(2384,47,'logged in from: ::1','users','2016-08-15 18:43:53',0),(2385,20,'logged in from: ::1','users','2016-08-15 18:47:18',0),(2386,47,'logged in from: ::1','users','2016-08-15 18:47:32',0),(2387,20,'logged in from: ::1','users','2016-08-15 18:48:37',0),(2388,55,'logged in from: ::1','users','2016-08-15 18:50:23',0),(2389,55,'logged in from: ::1','users','2016-08-15 19:01:50',0),(2390,20,'logged in from: ::1','users','2016-08-15 19:02:43',0),(2391,20,'logged in from: ::1','users','2016-08-15 20:16:00',0),(2392,47,'logged in from: ::1','users','2016-08-15 20:17:59',0),(2393,20,'logged in from: ::1','users','2016-08-15 20:28:48',0),(2394,55,'logged in from: ::1','users','2016-08-15 23:05:16',0),(2395,55,'logged in from: ::1','users','2016-08-16 01:00:22',0),(2396,55,'logged in from: ::1','users','2016-08-16 10:42:52',0),(2397,20,'logged in from: ::1','users','2016-08-16 11:50:16',0),(2398,55,'logged in from: ::1','users','2016-08-16 11:55:59',0),(2399,55,'logged in from: ::1','users','2016-08-16 12:16:53',0),(2400,20,'logged in from: ::1','users','2016-08-16 12:25:36',0),(2401,55,'logged in from: ::1','users','2016-08-16 13:30:52',0),(2402,55,'logged in from: ::1','users','2016-08-16 14:54:49',0),(2403,55,'logged in from: ::1','users','2016-08-16 15:05:31',0),(2404,20,'logged in from: ::1','users','2016-08-16 15:13:36',0),(2405,47,'logged in from: ::1','users','2016-08-16 15:25:57',0),(2406,20,'logged in from: ::1','users','2016-08-16 15:28:15',0),(2407,47,'logged in from: ::1','users','2016-08-16 15:34:29',0),(2408,45,'logged in from: ::1','users','2016-08-16 15:53:10',0),(2409,55,'logged in from: ::1','users','2016-08-16 16:21:25',0),(2410,20,'logged in from: ::1','users','2016-08-16 16:37:35',0),(2411,20,'logged in from: ::1','users','2016-08-16 16:40:37',0),(2412,55,'logged in from: ::1','users','2016-08-16 18:33:14',0),(2413,55,'logged in from: ::1','users','2016-08-16 20:11:24',0),(2414,55,'logged in from: ::1','users','2016-08-16 21:35:28',0),(2415,45,'logged in from: ::1','users','2016-08-17 08:25:29',0),(2416,9,'logged in from: ::1','users','2016-08-17 09:12:36',0),(2417,45,'logged in from: ::1','users','2016-08-17 09:12:42',0),(2418,55,'logged in from: ::1','users','2016-08-17 09:30:40',0),(2419,55,'logged in from: ::1','users','2016-08-17 09:46:26',0),(2420,20,'logged in from: ::1','users','2016-08-17 09:46:46',0),(2421,55,'logged in from: ::1','users','2016-08-17 10:00:25',0),(2422,55,'logged in from: ::1','users','2016-08-17 10:10:49',0),(2423,20,'logged in from: ::1','users','2016-08-17 10:15:09',0),(2424,55,'logged in from: ::1','users','2016-08-17 10:15:38',0),(2425,20,'logged in from: ::1','users','2016-08-17 10:39:43',0),(2426,45,'logged in from: ::1','users','2016-08-17 12:17:45',0),(2427,55,'logged in from: ::1','users','2016-08-17 12:44:34',0),(2428,55,'logged in from: ::1','users','2016-08-17 13:04:36',0),(2429,20,'logged in from: ::1','users','2016-08-17 13:52:23',0),(2430,55,'logged in from: ::1','users','2016-08-17 13:54:52',0),(2431,20,'logged in from: ::1','users','2016-08-17 14:01:01',0),(2432,55,'logged in from: ::1','users','2016-08-17 14:40:16',0),(2433,55,'logged in from: ::1','users','2016-08-17 14:55:05',0),(2434,20,'logged in from: ::1','users','2016-08-17 14:55:34',0),(2435,55,'logged in from: ::1','users','2016-08-17 16:08:15',0),(2436,55,'logged in from: ::1','users','2016-08-22 10:36:25',0),(2437,45,'logged in from: ::1','users','2016-08-22 10:42:13',0),(2438,55,'logged in from: ::1','users','2016-08-22 10:51:09',0),(2439,55,'logged in from: ::1','users','2016-08-22 12:05:08',0),(2440,9,'logged in from: ::1','users','2016-08-22 12:21:38',0),(2441,55,'logged in from: ::1','users','2016-08-22 13:03:06',0),(2442,55,'logged in from: ::1','users','2016-08-22 15:19:53',0),(2443,20,'logged in from: ::1','users','2016-08-22 15:31:54',0),(2444,55,'logged in from: ::1','users','2016-08-22 15:40:40',0),(2445,45,'logged in from: ::1','users','2016-08-22 17:01:18',0),(2446,20,'logged in from: ::1','users','2016-08-22 17:09:47',0),(2447,55,'logged in from: ::1','users','2016-08-23 11:11:31',0),(2448,45,'logged in from: ::1','users','2016-08-23 11:16:08',0),(2449,45,'logged in from: ::1','users','2016-08-23 11:42:38',0),(2450,20,'logged in from: ::1','users','2016-08-23 11:52:49',0),(2451,45,'logged in from: ::1','users','2016-08-23 11:56:46',0);

/*Table structure for table `bf_banner` */

CREATE TABLE `bf_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `bf_banner` */

insert  into `bf_banner`(`id`,`description`,`image`,`status`,`position`) values (3,'asdfasdfsd','beauty.jpg',1,3),(4,'sdafsdfsd','455779790-security-guard-vor-frue-plads-wedding-march-guarding.jpg',0,4),(6,'test','blogpost1.jpg',0,5),(7,'test2','blogpost2.jpg',1,6),(9,'test3','blogpost5.jpg',1,7);

/*Table structure for table `bf_budget_freeze_status_history` */

CREATE TABLE `bf_budget_freeze_status_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `budget_id` int(11) DEFAULT NULL,
  `freeze_status` tinyint(1) NOT NULL DEFAULT '0',
  `freeze_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `bf_budget_freeze_status_history` */

insert  into `bf_budget_freeze_status_history`(`id`,`budget_id`,`freeze_status`,`freeze_by_id`) values (1,1,1,48),(2,1,0,47),(3,1,0,46),(4,3,1,48),(5,3,1,47),(6,3,1,46),(7,4,1,48),(8,4,1,47),(9,116,1,48),(10,116,0,47),(11,116,0,46);

/*Table structure for table `bf_budget_lock_status_history` */

CREATE TABLE `bf_budget_lock_status_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `budget_id` int(11) DEFAULT NULL,
  `month_data` date DEFAULT NULL,
  `lock_status` tinyint(1) NOT NULL DEFAULT '0',
  `lock_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;

/*Data for the table `bf_budget_lock_status_history` */

insert  into `bf_budget_lock_status_history`(`id`,`budget_id`,`month_data`,`lock_status`,`lock_by_id`) values (1,1,'2016-01-01',0,47),(2,1,'2016-02-01',0,47),(3,1,'2016-03-01',0,47),(4,1,'2016-04-01',0,47),(5,1,'2016-05-01',0,47),(6,1,'2016-06-01',0,47),(7,1,'2016-07-01',0,47),(8,1,'2016-08-01',0,47),(9,1,'2016-09-01',0,47),(10,1,'2016-10-01',0,47),(11,1,'2016-11-01',0,47),(12,1,'2016-12-01',0,47),(13,1,'2016-01-01',0,46),(14,1,'2016-02-01',0,46),(15,1,'2016-03-01',0,46),(16,1,'2016-04-01',0,46),(17,1,'2016-05-01',0,46),(18,1,'2016-06-01',0,46),(19,1,'2016-07-01',0,46),(20,1,'2016-08-01',0,46),(21,1,'2016-09-01',0,46),(22,1,'2016-10-01',0,46),(23,1,'2016-11-01',0,46),(24,1,'2016-12-01',0,46),(25,3,'2016-01-01',1,47),(26,3,'2016-02-01',1,47),(27,3,'2016-03-01',1,47),(28,3,'2016-04-01',1,47),(29,3,'2016-05-01',1,47),(30,3,'2016-06-01',1,47),(31,3,'2016-07-01',1,47),(32,3,'2016-08-01',1,47),(33,3,'2016-09-01',1,47),(34,3,'2016-10-01',1,47),(35,3,'2016-11-01',1,47),(36,3,'2016-12-01',1,47),(37,3,'2016-01-01',1,46),(38,3,'2016-02-01',1,46),(39,3,'2016-03-01',1,46),(40,3,'2016-04-01',1,46),(41,3,'2016-05-01',1,46),(42,3,'2016-06-01',1,46),(43,3,'2016-07-01',1,46),(44,3,'2016-08-01',1,46),(45,3,'2016-09-01',1,46),(46,3,'2016-10-01',1,46),(47,3,'2016-11-01',1,46),(48,3,'2016-12-01',1,46),(49,3,'2016-01-01',0,45),(50,3,'2016-02-01',0,45),(51,3,'2016-03-01',0,45),(52,3,'2016-04-01',0,45),(53,3,'2016-05-01',0,45),(54,3,'2016-06-01',0,45),(55,3,'2016-07-01',0,45),(56,3,'2016-08-01',0,45),(57,3,'2016-09-01',0,45),(58,3,'2016-10-01',0,45),(59,3,'2016-11-01',0,45),(60,3,'2016-12-01',0,45),(61,4,'2016-01-01',0,47),(62,4,'2016-02-01',0,47),(63,4,'2016-03-01',0,47),(64,4,'2016-04-01',0,47),(65,4,'2016-05-01',0,47),(66,4,'2016-06-01',0,47),(67,4,'2016-07-01',0,47),(68,4,'2016-08-01',0,47),(69,4,'2016-09-01',0,47),(70,4,'2016-10-01',0,47),(71,4,'2016-11-01',0,47),(72,4,'2016-12-01',0,47),(73,116,'2016-01-01',1,47),(74,116,'2016-02-01',1,47),(75,116,'2016-03-01',1,47),(76,116,'2016-04-01',1,47),(77,116,'2016-05-01',1,47),(78,116,'2016-06-01',1,47),(79,116,'2016-07-01',1,47),(80,116,'2016-08-01',1,47),(81,116,'2016-09-01',1,47),(82,116,'2016-10-01',1,47),(83,116,'2016-11-01',1,47),(84,116,'2016-12-01',1,47),(85,116,'2016-01-01',0,46),(86,116,'2016-02-01',0,46),(87,116,'2016-03-01',0,46),(88,116,'2016-04-01',0,46),(89,116,'2016-05-01',0,46),(90,116,'2016-06-01',0,46),(91,116,'2016-07-01',0,46),(92,116,'2016-08-01',0,46),(93,116,'2016-09-01',0,46),(94,116,'2016-10-01',0,46),(95,116,'2016-11-01',0,46),(96,116,'2016-12-01',0,46),(97,116,'2016-01-01',0,45),(98,116,'2016-02-01',0,45),(99,116,'2016-03-01',0,45),(100,116,'2016-04-01',0,45),(101,116,'2016-05-01',0,45),(102,116,'2016-06-01',0,45),(103,116,'2016-07-01',0,45),(104,116,'2016-08-01',0,45),(105,116,'2016-09-01',0,45),(106,116,'2016-10-01',0,45),(107,116,'2016-11-01',0,45),(108,116,'2016-12-01',0,45);

/*Table structure for table `bf_cco_activity_allocation` */

CREATE TABLE `bf_cco_activity_allocation` (
  `activity_allocation_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `activity_type` varchar(255) DEFAULT NULL,
  `cco_id` int(11) NOT NULL,
  `activity_employee_id` int(11) DEFAULT NULL,
  `ec_count` int(11) DEFAULT '0' COMMENT 'Employee or Customer Count',
  `transfer_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0= No , 1=Yes',
  `called_status` tinyint(11) NOT NULL DEFAULT '0',
  `country_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0= No , 1=Yes',
  `created_by_user` int(11) NOT NULL,
  `modified_by_user` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0= Inactive , 1=Active',
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  PRIMARY KEY (`activity_allocation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_activity_allocation` */

insert  into `bf_cco_activity_allocation`(`activity_allocation_id`,`activity_id`,`activity_type`,`cco_id`,`activity_employee_id`,`ec_count`,`transfer_status`,`called_status`,`country_id`,`deleted`,`created_by_user`,`modified_by_user`,`status`,`created_on`,`modified_on`) values (1,33,'planned_activity',56,NULL,5,0,1,101,0,55,55,1,'2016-08-12 20:15:54','2016-08-12 20:15:54'),(8,91,'executed_activity',58,NULL,2,0,0,101,0,55,55,1,'2016-08-13 16:32:45','2016-08-13 16:32:45'),(9,86,'executed_activity',58,NULL,9,0,0,101,0,55,55,1,'2016-08-13 16:32:45','2016-08-13 16:32:45');

/*Table structure for table `bf_cco_blacklist_users` */

CREATE TABLE `bf_cco_blacklist_users` (
  `bl_id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_nimber` varchar(30) DEFAULT NULL,
  `created_by_user` int(11) NOT NULL,
  `modified_by_user` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  PRIMARY KEY (`bl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_blacklist_users` */

/*Table structure for table `bf_cco_call_details` */

CREATE TABLE `bf_cco_call_details` (
  `call_id` int(11) NOT NULL AUTO_INCREMENT,
  `cco_id` int(11) NOT NULL,
  `call_start_time` datetime NOT NULL,
  `call_end_time` datetime NOT NULL,
  `call_duration` varchar(255) NOT NULL,
  `ca_id` int(11) NOT NULL,
  `ca_type` enum('campaign','activity') NOT NULL DEFAULT 'campaign',
  `phase_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `feedback` text,
  `is_call_done` tinyint(11) DEFAULT '0',
  `comments` text,
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0= No, 1=Yes',
  `created_by_user` int(11) NOT NULL,
  `modified_by_user` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Inactive, 1=Active',
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  PRIMARY KEY (`call_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_call_details` */

insert  into `bf_cco_call_details`(`call_id`,`cco_id`,`call_start_time`,`call_end_time`,`call_duration`,`ca_id`,`ca_type`,`phase_id`,`customer_id`,`feedback`,`is_call_done`,`comments`,`deleted`,`created_by_user`,`modified_by_user`,`status`,`created_on`,`modified_on`) values (1,56,'2016-08-14 12:00:00','2016-08-14 12:15:00','15',1,'campaign',1,5,'good',1,'good',0,56,56,1,'2016-08-14 12:00:00','2016-08-14 12:15:00'),(2,56,'2016-08-14 12:20:00','2016-08-14 12:25:00','5',1,'campaign',1,6,'bad',1,'bad',0,56,56,1,'2016-08-14 12:15:00','2016-08-14 12:20:00'),(3,57,'2016-08-14 10:00:00','2016-08-14 10:30:00','30',2,'campaign',1,7,'ok',1,NULL,0,57,57,1,'2016-08-14 10:00:00','2016-08-14 10:30:00'),(4,56,'2016-08-14 12:00:00','2016-08-14 12:15:00','15',1,'campaign',2,5,'good',1,'good',0,56,56,1,'2016-08-14 12:00:00','2016-08-14 12:15:00'),(5,56,'2016-08-14 12:20:00','2016-08-14 12:25:00','5',1,'campaign',2,6,'bad',1,'bad',0,56,56,1,'2016-08-14 12:15:00','2016-08-14 12:20:00'),(6,56,'2016-08-14 12:00:00','2016-08-14 12:15:00','15',1,'campaign',3,5,'good',1,'good',0,56,56,1,'2016-08-14 12:00:00','2016-08-14 12:15:00'),(7,56,'2016-08-14 12:20:00','2016-08-14 12:25:00','5',1,'campaign',3,6,'bad',1,'bad',0,56,56,1,'2016-08-14 12:15:00','2016-08-14 12:20:00'),(10,56,'2016-08-14 18:00:00','2016-08-14 18:45:00','45',1,'activity',0,5,NULL,1,NULL,0,56,56,1,'2016-08-14 18:00:00','2016-08-14 18:45:00');

/*Table structure for table `bf_cco_calltransfer` */

CREATE TABLE `bf_cco_calltransfer` (
  `calltransfer_id` int(11) NOT NULL AUTO_INCREMENT,
  `cco_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `number` varchar(225) DEFAULT NULL,
  `cco_to_id` int(11) DEFAULT NULL,
  `call_date` datetime DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`calltransfer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_calltransfer` */

/*Table structure for table `bf_cco_campaign` */

CREATE TABLE `bf_cco_campaign` (
  `campaign_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_name` varchar(255) NOT NULL,
  `campaign_type` int(11) NOT NULL,
  `customer_type` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `recurrence_day` int(11) NOT NULL,
  `campaign_purpose` text NOT NULL,
  `no_phase` int(11) NOT NULL,
  `skipped_allowed` tinyint(1) NOT NULL,
  `desired_result` text NOT NULL,
  `country_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0= No , 1=Yes',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0= Inactive , 1=Active',
  `created_by_user` int(11) NOT NULL,
  `modified_by_user` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  PRIMARY KEY (`campaign_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_campaign` */

insert  into `bf_cco_campaign`(`campaign_id`,`campaign_name`,`campaign_type`,`customer_type`,`start_date`,`end_date`,`recurrence_day`,`campaign_purpose`,`no_phase`,`skipped_allowed`,`desired_result`,`country_id`,`deleted`,`status`,`created_by_user`,`modified_by_user`,`created_on`,`modified_on`) values (1,'Campaign-1',1,11,'2016-08-01','2016-12-31',30,'test',3,1,'test',101,0,1,1,1,'2016-08-01 00:00:00','2016-08-01 00:00:00'),(2,'Campaign-2',1,9,'2016-08-01','2016-12-31',30,'test 2',2,1,'test 2',101,0,1,1,1,'2016-08-01 00:00:00','2016-08-01 00:00:00'),(3,'Campaign-3',1,10,'2016-08-01','2016-12-31',30,'test 3',2,1,'test 3',101,0,1,1,1,'2016-08-01 00:00:00','2016-08-01 00:00:00');

/*Table structure for table `bf_cco_campaign_allocation` */

CREATE TABLE `bf_cco_campaign_allocation` (
  `allocation_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) DEFAULT NULL,
  `cco_id` int(11) DEFAULT NULL,
  `geo_level_1` int(11) DEFAULT NULL,
  `customer_count` int(11) DEFAULT NULL,
  `transfer_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0= No , 1=Yes',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0= No , 1=Yes',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0= Inactive, 1= Active',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`allocation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_campaign_allocation` */

insert  into `bf_cco_campaign_allocation`(`allocation_id`,`campaign_id`,`cco_id`,`geo_level_1`,`customer_count`,`transfer_status`,`deleted`,`created_by_user`,`modified_by_user`,`status`,`created_on`,`modified_on`) values (1,1,56,5,5,0,0,55,NULL,1,'2016-08-10 02:48:39',NULL),(3,3,56,49,2,0,0,55,NULL,1,'2016-08-10 10:05:19',NULL),(4,2,57,128,2,0,0,55,NULL,1,'2016-08-10 10:41:02',NULL);

/*Table structure for table `bf_cco_campaign_allocation_customers` */

CREATE TABLE `bf_cco_campaign_allocation_customers` (
  `ac_id` int(11) NOT NULL AUTO_INCREMENT,
  `allocation_id` int(11) DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `cco_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `transferred_cco_id` int(11) DEFAULT NULL,
  `transfered` tinyint(1) NOT NULL DEFAULT '0',
  `allocated_date` date DEFAULT NULL,
  `remarks` text,
  `comments` text,
  `called_status` tinyint(11) NOT NULL DEFAULT '0',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`ac_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_campaign_allocation_customers` */

insert  into `bf_cco_campaign_allocation_customers`(`ac_id`,`allocation_id`,`campaign_id`,`cco_id`,`customer_id`,`transferred_cco_id`,`transfered`,`allocated_date`,`remarks`,`comments`,`called_status`,`created_by_user`,`modified_by_user`,`status`,`created_on`,`modified_on`) values (1,1,1,56,4,NULL,0,'2016-08-10',NULL,NULL,0,55,NULL,1,'2016-08-10 02:48:39',NULL),(2,1,1,56,6,NULL,0,'2016-08-10',NULL,NULL,0,55,NULL,1,'2016-08-10 02:48:39',NULL),(3,1,1,56,7,NULL,0,'2016-08-10',NULL,NULL,0,55,NULL,1,'2016-08-10 02:48:39',NULL),(4,1,1,56,28,NULL,0,'2016-08-10',NULL,NULL,0,55,NULL,1,'2016-08-10 02:48:40',NULL),(5,1,1,56,29,NULL,0,'2016-08-10',NULL,NULL,0,55,NULL,1,'2016-08-10 02:48:40',NULL),(11,3,3,56,14,NULL,0,'2016-08-10',NULL,NULL,0,55,NULL,1,'2016-08-10 10:05:19',NULL),(12,3,3,56,19,NULL,0,'2016-08-10',NULL,NULL,0,55,NULL,1,'2016-08-10 10:05:20',NULL),(13,4,2,57,11,NULL,0,'2016-08-10',NULL,NULL,0,55,NULL,1,'2016-08-10 10:41:02',NULL),(14,4,2,57,37,NULL,0,'2016-08-10',NULL,NULL,0,55,NULL,1,'2016-08-10 10:41:02',NULL);

/*Table structure for table `bf_cco_campaign_categories` */

CREATE TABLE `bf_cco_campaign_categories` (
  `cc_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`cc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_campaign_categories` */

/*Table structure for table `bf_cco_campaign_location` */

CREATE TABLE `bf_cco_campaign_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) DEFAULT NULL,
  `campaign_location_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_campaign_location` */

insert  into `bf_cco_campaign_location`(`id`,`campaign_id`,`campaign_location_id`) values (1,1,5),(2,2,128),(3,3,49);

/*Table structure for table `bf_cco_campaign_phase` */

CREATE TABLE `bf_cco_campaign_phase` (
  `phase_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) DEFAULT NULL,
  `phase_no` int(11) DEFAULT NULL,
  `phase_name` varchar(255) DEFAULT NULL,
  `phase_compulsory_check` tinyint(1) DEFAULT '0' COMMENT '0= No , 1=Yes',
  `next_phase_eligibility` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0= No , 1=Yes',
  `no_executor` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `phase_purpose` text,
  `working_days` int(11) DEFAULT NULL,
  `avg_call_duration` varchar(11) DEFAULT NULL,
  `call_gap` int(11) DEFAULT NULL,
  `script` text,
  `phase_status` tinyint(1) DEFAULT '0' COMMENT '0= Pending, 1= completed, 2 = In progress',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0= No , 1=Yes',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0= Inactive , 1=Active',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`phase_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_campaign_phase` */

insert  into `bf_cco_campaign_phase`(`phase_id`,`campaign_id`,`phase_no`,`phase_name`,`phase_compulsory_check`,`next_phase_eligibility`,`no_executor`,`start_date`,`end_date`,`phase_purpose`,`working_days`,`avg_call_duration`,`call_gap`,`script`,`phase_status`,`deleted`,`created_by_user`,`modified_by_user`,`status`,`created_on`,`modified_on`) values (1,1,1,'P1',1,0,0,'2016-08-01','2016-08-10','Purpose 1',10,'7',0,'This is test script for phase 1 campaign 1.',1,0,55,0,1,'2016-08-08 00:00:00','2016-08-08 00:00:00'),(2,1,2,'P2',0,0,NULL,'2016-08-01','2016-08-17','Purpose 2',10,'5',NULL,'this is phase 2 camp 1.',2,0,NULL,NULL,1,'2016-08-08 00:00:00','2016-08-08 00:00:00'),(3,1,3,'P3',1,0,NULL,'2016-08-01','2016-08-17','Purpose 3',10,'1',NULL,'this is phase 3 camp 1.',2,0,NULL,NULL,1,'2016-08-08 00:00:00','2016-08-08 00:00:00'),(4,2,1,'P1',1,0,NULL,'2016-08-23','2016-08-31','Purpose 4',10,'',NULL,'this is phase 2 camp 1.',0,0,NULL,NULL,1,'2016-08-08 00:00:00','2016-08-08 00:00:00'),(5,2,2,'P2',1,0,NULL,'2016-08-23','2016-08-31','Purpose 5',10,'',NULL,'this is phase 2 camp 2.',0,0,NULL,NULL,1,'2016-08-08 00:00:00','2016-08-08 00:00:00');

/*Table structure for table `bf_cco_campaign_phase_promotional_material` */

CREATE TABLE `bf_cco_campaign_phase_promotional_material` (
  `pp_id` int(11) NOT NULL AUTO_INCREMENT,
  `phase_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`pp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_campaign_phase_promotional_material` */

/*Table structure for table `bf_cco_campaign_phase_questions` */

CREATE TABLE `bf_cco_campaign_phase_questions` (
  `pq_id` int(11) NOT NULL AUTO_INCREMENT,
  `phase_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `question_order` int(11) NOT NULL,
  PRIMARY KEY (`pq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_campaign_phase_questions` */

/*Table structure for table `bf_cco_campaign_proposed_budget` */

CREATE TABLE `bf_cco_campaign_proposed_budget` (
  `cpb_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) NOT NULL,
  `expence_head_id` int(11) NOT NULL,
  `expence_sub_head_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`cpb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_campaign_proposed_budget` */

/*Table structure for table `bf_cco_campaign_questions_user_answer` */

CREATE TABLE `bf_cco_campaign_questions_user_answer` (
  `qa_id` int(11) NOT NULL AUTO_INCREMENT,
  `cco_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `phase_question_id` int(11) NOT NULL,
  `customer_answer` text NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `created_by_user` int(11) NOT NULL,
  `modified_by_user` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Inactive, 1=Active',
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  PRIMARY KEY (`qa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_campaign_questions_user_answer` */

/*Table structure for table `bf_cco_campaign_responsible_employee` */

CREATE TABLE `bf_cco_campaign_responsible_employee` (
  `ce_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `employee_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = Primary,1 = Secondary',
  PRIMARY KEY (`ce_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_campaign_responsible_employee` */

/*Table structure for table `bf_cco_campaign_target_crop` */

CREATE TABLE `bf_cco_campaign_target_crop` (
  `ctc_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) NOT NULL,
  `crop_id` int(11) NOT NULL,
  PRIMARY KEY (`ctc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_campaign_target_crop` */

/*Table structure for table `bf_cco_campaign_target_product` */

CREATE TABLE `bf_cco_campaign_target_product` (
  `ctp_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`ctp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_campaign_target_product` */

/*Table structure for table `bf_cco_campaign_type` */

CREATE TABLE `bf_cco_campaign_type` (
  `campaign_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_type` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Inactive, 1=Active',
  `created_by_user` int(11) NOT NULL,
  `modified_by_user` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  PRIMARY KEY (`campaign_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_campaign_type` */

insert  into `bf_cco_campaign_type`(`campaign_type_id`,`campaign_type`,`deleted`,`status`,`created_by_user`,`modified_by_user`,`created_on`,`modified_on`) values (1,'Once',0,1,1,1,'2016-08-01 00:00:00','2016-08-01 00:00:00'),(2,'Recurrance',0,1,1,1,'2016-08-01 00:00:00','2016-08-01 00:00:00');

/*Table structure for table `bf_cco_complaint_details` */

CREATE TABLE `bf_cco_complaint_details` (
  `complaint_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `call_id` int(11) DEFAULT NULL,
  `complaint_number` varchar(255) DEFAULT NULL,
  `complaint_status` tinyint(1) DEFAULT '0' COMMENT '0 = pending, 1 = inprocess, 2 = completed,3= reopened',
  `complaint_type_id` int(11) DEFAULT NULL,
  `complaint_entry_date` date DEFAULT NULL,
  `complaint_due_date` date DEFAULT NULL,
  `complaint_subject` varchar(255) DEFAULT NULL,
  `remarks` text,
  `complaint_data` text,
  `assigned_to_id` int(11) DEFAULT NULL,
  `escalation_date_1` date DEFAULT NULL,
  `escalation_date_2` date DEFAULT NULL,
  `escalation_date_3` date DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0' COMMENT '0= No , 1=Yes',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '0= Inactive , 1=Active',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`complaint_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_complaint_details` */

insert  into `bf_cco_complaint_details`(`complaint_id`,`customer_id`,`call_id`,`complaint_number`,`complaint_status`,`complaint_type_id`,`complaint_entry_date`,`complaint_due_date`,`complaint_subject`,`remarks`,`complaint_data`,`assigned_to_id`,`escalation_date_1`,`escalation_date_2`,`escalation_date_3`,`deleted`,`created_by_user`,`modified_by_user`,`status`,`created_on`,`modified_on`) values (4,NULL,497582,'497582',0,1,'2016-08-16','2016-08-21','1','sdf','dsf',47,'2016-08-21','2016-08-26','2016-08-31',0,55,55,1,'2016-08-16 22:05:31','2016-08-16 22:05:31'),(5,NULL,257797,'257797',0,1,'2016-08-16','2016-08-21','1','dsfas','sdf',47,'2016-08-21','2016-08-26','2016-08-31',0,55,55,1,'2016-08-16 22:10:20','2016-08-16 22:10:20'),(6,NULL,599147,'599147',0,1,'2016-08-16','2016-08-21','1','dsfdf','sdfdsdfs',47,'2016-08-21','2016-08-26','2016-08-31',0,55,55,1,'2016-08-16 22:41:22','2016-08-16 22:41:22'),(7,NULL,355473,'355473',2,1,'2016-08-16','2016-08-21','1','sewfsd','dsfads',47,'2016-08-21','2016-08-26','2016-08-31',0,55,55,1,'2016-08-16 22:41:53','2016-08-16 22:41:53'),(8,4,NULL,'110608',2,1,'2016-08-17','2016-08-22','1','Remark Remark Remark','Complaint Body \r\n Complaint Body \r\n',47,'2016-08-22','2016-08-27','2016-09-01',0,55,55,1,'2016-08-17 09:31:31','2016-08-17 09:31:31'),(9,4,NULL,'150110',0,1,'2016-08-22','2016-08-27','1','sadsad adsadsads','fdsfs dfd sfdsfdsf dsfdsfdsfd',47,'2016-08-27','2016-09-01','2016-09-06',0,55,55,1,'2016-08-22 11:13:40','2016-08-22 11:13:40');

/*Table structure for table `bf_cco_feedback` */

CREATE TABLE `bf_cco_feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `cco_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `feedback_subject` varchar(255) NOT NULL,
  `feedback_description` text NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0= No, 1=Yes',
  `created_by_user` int(11) NOT NULL,
  `modified_by_user` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0= Inactive, 1=Active',
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_feedback` */

insert  into `bf_cco_feedback`(`feedback_id`,`cco_id`,`customer_id`,`feedback_subject`,`feedback_description`,`deleted`,`created_by_user`,`modified_by_user`,`status`,`created_on`,`modified_on`) values (4,55,4,'dfrgdfg','dfgddsf',0,55,55,1,'2016-08-15 15:10:45','2016-08-15 15:10:45'),(5,55,4,'dfgd','dfgd',0,55,55,1,'2016-08-14 15:25:56','2016-08-14 15:25:56'),(6,55,4,'dfg','dfsgds',0,55,55,1,'2016-08-14 15:27:05','2016-08-14 15:27:05'),(7,55,4,'fdy','dfsgg',0,55,55,1,'2016-08-14 15:41:06','2016-08-14 15:41:06'),(8,55,4,'dfg','sdfgs',0,55,55,1,'2016-08-14 15:59:55','2016-08-14 15:59:55'),(12,55,4,'dfg','dfgs',0,55,55,1,'2016-08-14 20:45:24','2016-08-14 20:45:24'),(13,55,4,'dfgdsa','dsfg',0,55,55,1,'2016-08-14 20:45:42','2016-08-14 20:45:42'),(16,55,4,'vvvv','yyy yyyy',0,55,55,1,'2016-08-15 12:51:25','2016-08-15 12:51:25'),(17,55,4,'ftghfdhdf','fghfghd',0,55,55,1,'2016-08-15 14:30:12','2016-08-15 14:30:12');

/*Table structure for table `bf_cco_missedcall` */

CREATE TABLE `bf_cco_missedcall` (
  `missedcall_id` int(11) NOT NULL AUTO_INCREMENT,
  `cco_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `number` varchar(225) DEFAULT NULL,
  `missedcall_date` datetime DEFAULT NULL,
  `callback_status` tinyint(1) DEFAULT '0',
  `callback_date` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`missedcall_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_missedcall` */

/*Table structure for table `bf_cco_transfer_work` */

CREATE TABLE `bf_cco_transfer_work` (
  `transfer_id` int(11) NOT NULL AUTO_INCREMENT,
  `allocation_id` int(11) NOT NULL,
  `alocation_type` enum('campaign','activity') NOT NULL DEFAULT 'campaign',
  `old_cco_id` int(11) NOT NULL,
  `new_cco_id` int(11) NOT NULL,
  `created_by_user` int(11) NOT NULL,
  `modified_by_user` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  PRIMARY KEY (`transfer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_cco_transfer_work` */

/*Table structure for table `bf_countries` */

CREATE TABLE `bf_countries` (
  `counrty_id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL DEFAULT 'US',
  `name` varchar(80) NOT NULL,
  `printable_name` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` varchar(10) DEFAULT NULL,
  `local_date_formet` varchar(255) DEFAULT NULL,
  `app_date_formet` varchar(255) DEFAULT NULL,
  `js_date_formet` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`counrty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=latin1;

/*Data for the table `bf_countries` */

insert  into `bf_countries`(`counrty_id`,`iso`,`name`,`printable_name`,`iso3`,`numcode`,`local_date_formet`,`app_date_formet`,`js_date_formet`,`status`,`deleted`) values (1,'AD','ANDORRA','Andorra','AND','20',NULL,NULL,NULL,0,0),(2,'AE','UNITED ARAB EMIRATES','United Arab Emirates','ARE','784',NULL,NULL,NULL,0,0),(3,'AF','AFGHANISTAN','Afghanistan','AFG','4',NULL,NULL,NULL,0,0),(4,'AG','ANTIGUA AND BARBUDA','Antigua and Barbuda','ATG','28',NULL,NULL,NULL,0,0),(5,'AI','ANGUILLA','Anguilla','AIA','660',NULL,NULL,NULL,0,0),(6,'AL','ALBANIA','Albania','ALB','8',NULL,NULL,NULL,0,0),(7,'AM','ARMENIA','Armenia','ARM','51',NULL,NULL,NULL,0,0),(8,'AN','NETHERLANDS ANTILLES','Netherlands Antilles','ANT','530',NULL,NULL,NULL,0,0),(9,'AO','ANGOLA','Angola','AGO','24',NULL,NULL,NULL,0,0),(10,'AQ','ANTARCTICA','Antarctica',NULL,NULL,NULL,NULL,NULL,0,0),(11,'AR','ARGENTINA','Argentina','ARG','32',NULL,NULL,NULL,0,0),(12,'AS','AMERICAN SAMOA','American Samoa','ASM','16',NULL,NULL,NULL,0,0),(13,'AT','AUSTRIA','Austria','AUT','40',NULL,NULL,NULL,0,0),(14,'AU','AUSTRALIA','Australia','AUS','36',NULL,NULL,NULL,0,0),(15,'AW','ARUBA','Aruba','ABW','533',NULL,NULL,NULL,0,0),(16,'AZ','AZERBAIJAN','Azerbaijan','AZE','31',NULL,NULL,NULL,0,0),(17,'BA','BOSNIA AND HERZEGOVINA','Bosnia and Herzegovina','BIH','70',NULL,NULL,NULL,0,0),(18,'BB','BARBADOS','Barbados','BRB','52',NULL,NULL,NULL,0,0),(19,'BD','BANGLADESH','Bangladesh','BGD','50',NULL,NULL,NULL,0,0),(20,'BE','BELGIUM','Belgium','BEL','56',NULL,NULL,NULL,0,0),(21,'BF','BURKINA FASO','Burkina Faso','BFA','854',NULL,NULL,NULL,0,0),(22,'BG','BULGARIA','Bulgaria','BGR','100',NULL,NULL,NULL,0,0),(23,'BH','BAHRAIN','Bahrain','BHR','48',NULL,NULL,NULL,0,0),(24,'BI','BURUNDI','Burundi','BDI','108',NULL,NULL,NULL,0,0),(25,'BJ','BENIN','Benin','BEN','204',NULL,NULL,NULL,0,0),(26,'BM','BERMUDA','Bermuda','BMU','60',NULL,NULL,NULL,0,0),(27,'BN','BRUNEI DARUSSALAM','Brunei Darussalam','BRN','96',NULL,NULL,NULL,0,0),(28,'BO','BOLIVIA','Bolivia','BOL','68',NULL,NULL,NULL,0,0),(29,'BR','BRAZIL','Brazil','BRA','76',NULL,NULL,NULL,0,0),(30,'BS','BAHAMAS','Bahamas','BHS','44',NULL,NULL,NULL,0,0),(31,'BT','BHUTAN','Bhutan','BTN','64',NULL,NULL,NULL,0,0),(32,'BV','BOUVET ISLAND','Bouvet Island',NULL,NULL,NULL,NULL,NULL,0,0),(33,'BW','BOTSWANA','Botswana','BWA','72',NULL,NULL,NULL,0,0),(34,'BY','BELARUS','Belarus','BLR','112',NULL,NULL,NULL,0,0),(35,'BZ','BELIZE','Belize','BLZ','84',NULL,NULL,NULL,0,0),(36,'CA','CANADA','Canada','CAN','124',NULL,NULL,NULL,0,0),(37,'CC','COCOS (KEELING) ISLANDS','Cocos (Keeling) Islands',NULL,NULL,NULL,NULL,NULL,0,0),(38,'CD','CONGO, THE DEMOCRATIC REPUBLIC OF THE','Congo, the Democratic Republic of the','COD','180',NULL,NULL,NULL,0,0),(39,'CF','CENTRAL AFRICAN REPUBLIC','Central African Republic','CAF','140',NULL,NULL,NULL,0,0),(40,'CG','CONGO','Congo','COG','178',NULL,NULL,NULL,0,0),(41,'CH','SWITZERLAND','Switzerland','CHE','756',NULL,NULL,NULL,0,0),(42,'CI','COTE D\'IVOIRE','Cote D\'Ivoire','CIV','384',NULL,NULL,NULL,0,0),(43,'CK','COOK ISLANDS','Cook Islands','COK','184',NULL,NULL,NULL,0,0),(44,'CL','CHILE','Chile','CHL','152',NULL,NULL,NULL,0,0),(45,'CM','CAMEROON','Cameroon','CMR','120',NULL,NULL,NULL,0,0),(46,'CN','CHINA','China','CHN','156',NULL,NULL,NULL,0,0),(47,'CO','COLOMBIA','Colombia','COL','170',NULL,NULL,NULL,0,0),(48,'CR','COSTA RICA','Costa Rica','CRI','188',NULL,NULL,NULL,0,0),(49,'CS','SERBIA AND MONTENEGRO','Serbia and Montenegro',NULL,NULL,NULL,NULL,NULL,0,0),(50,'CU','CUBA','Cuba','CUB','192',NULL,NULL,NULL,0,0),(51,'CV','CAPE VERDE','Cape Verde','CPV','132',NULL,NULL,NULL,0,0),(52,'CX','CHRISTMAS ISLAND','Christmas Island',NULL,NULL,NULL,NULL,NULL,0,0),(53,'CY','CYPRUS','Cyprus','CYP','196',NULL,NULL,NULL,0,0),(54,'CZ','CZECH REPUBLIC','Czech Republic','CZE','203',NULL,NULL,NULL,0,0),(55,'DE','GERMANY','Germany','DEU','276',NULL,NULL,NULL,0,0),(56,'DJ','DJIBOUTI','Djibouti','DJI','262',NULL,NULL,NULL,0,0),(57,'DK','DENMARK','Denmark','DNK','208',NULL,NULL,NULL,0,0),(58,'DM','DOMINICA','Dominica','DMA','212',NULL,NULL,NULL,0,0),(59,'DO','DOMINICAN REPUBLIC','Dominican Republic','DOM','214',NULL,NULL,NULL,0,0),(60,'DZ','ALGERIA','Algeria','DZA','12',NULL,NULL,NULL,0,0),(61,'EC','ECUADOR','Ecuador','ECU','218',NULL,NULL,NULL,0,0),(62,'EE','ESTONIA','Estonia','EST','233',NULL,NULL,NULL,0,0),(63,'EG','EGYPT','Egypt','EGY','818',NULL,NULL,NULL,0,0),(64,'EH','WESTERN SAHARA','Western Sahara','ESH','732',NULL,NULL,NULL,0,0),(65,'ER','ERITREA','Eritrea','ERI','232',NULL,NULL,NULL,0,0),(66,'ES','SPAIN','Spain','ESP','724',NULL,NULL,NULL,0,0),(67,'ET','ETHIOPIA','Ethiopia','ETH','231',NULL,NULL,NULL,0,0),(68,'FI','FINLAND','Finland','FIN','246',NULL,NULL,NULL,0,0),(69,'FJ','FIJI','Fiji','FJI','242',NULL,NULL,NULL,0,0),(70,'FK','FALKLAND ISLANDS (MALVINAS)','Falkland Islands (Malvinas)','FLK','238',NULL,NULL,NULL,0,0),(71,'FM','MICRONESIA, FEDERATED STATES OF','Micronesia, Federated States of','FSM','583',NULL,NULL,NULL,0,0),(72,'FO','FAROE ISLANDS','Faroe Islands','FRO','234',NULL,NULL,NULL,0,0),(73,'FR','FRANCE','France','FRA','250',NULL,NULL,NULL,0,0),(74,'GA','GABON','Gabon','GAB','266',NULL,NULL,NULL,0,0),(75,'GB','UNITED KINGDOM','United Kingdom','GBR','826',NULL,NULL,NULL,0,0),(76,'GD','GRENADA','Grenada','GRD','308',NULL,NULL,NULL,0,0),(77,'GE','GEORGIA','Georgia','GEO','268',NULL,NULL,NULL,0,0),(78,'GF','FRENCH GUIANA','French Guiana','GUF','254',NULL,NULL,NULL,0,0),(79,'GH','GHANA','Ghana','GHA','288',NULL,NULL,NULL,0,0),(80,'GI','GIBRALTAR','Gibraltar','GIB','292',NULL,NULL,NULL,0,0),(81,'GL','GREENLAND','Greenland','GRL','304',NULL,NULL,NULL,0,0),(82,'GM','GAMBIA','Gambia','GMB','270',NULL,NULL,NULL,0,0),(83,'GN','GUINEA','Guinea','GIN','324',NULL,NULL,NULL,0,0),(84,'GP','GUADELOUPE','Guadeloupe','GLP','312',NULL,NULL,NULL,0,0),(85,'GQ','EQUATORIAL GUINEA','Equatorial Guinea','GNQ','226',NULL,NULL,NULL,0,0),(86,'GR','GREECE','Greece','GRC','300',NULL,NULL,NULL,0,0),(87,'GS','SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS','South Georgia and the South Sandwich Islands',NULL,NULL,NULL,NULL,NULL,0,0),(88,'GT','GUATEMALA','Guatemala','GTM','320',NULL,NULL,NULL,0,0),(89,'GU','GUAM','Guam','GUM','316',NULL,NULL,NULL,0,0),(90,'GW','GUINEA-BISSAU','Guinea-Bissau','GNB','624',NULL,NULL,NULL,0,0),(91,'GY','GUYANA','Guyana','GUY','328',NULL,NULL,NULL,0,0),(92,'HK','HONG KONG','Hong Kong','HKG','344',NULL,NULL,NULL,0,0),(93,'HM','HEARD ISLAND AND MCDONALD ISLANDS','Heard Island and Mcdonald Islands',NULL,NULL,NULL,NULL,NULL,0,0),(94,'HN','HONDURAS','Honduras','HND','340',NULL,NULL,NULL,0,0),(95,'HR','CROATIA','Croatia','HRV','191',NULL,NULL,NULL,0,0),(96,'HT','HAITI','Haiti','HTI','332',NULL,NULL,NULL,0,0),(97,'HU','HUNGARY','Hungary','HUN','348',NULL,NULL,NULL,0,0),(98,'ID','INDONESIA','Indonesia','IDN','360',NULL,NULL,NULL,1,0),(99,'IE','IRELAND','Ireland','IRL','372',NULL,NULL,NULL,0,0),(100,'IL','ISRAEL','Israel','ISR','376',NULL,NULL,NULL,0,0),(101,'IN','INDIA','India','IND','356','d/m/Y','dd/MM/yyyy','dd/mm/yyyy',1,0),(102,'IO','BRITISH INDIAN OCEAN TERRITORY','British Indian Ocean Territory',NULL,NULL,NULL,NULL,NULL,0,0),(103,'IQ','IRAQ','Iraq','IRQ','368',NULL,NULL,NULL,0,0),(104,'IR','IRAN, ISLAMIC REPUBLIC OF','Iran, Islamic Republic of','IRN','364',NULL,NULL,NULL,0,0),(105,'IS','ICELAND','Iceland','ISL','352',NULL,NULL,NULL,0,0),(106,'IT','ITALY','Italy','ITA','380',NULL,NULL,NULL,0,0),(107,'JM','JAMAICA','Jamaica','JAM','388',NULL,NULL,NULL,0,0),(108,'JO','JORDAN','Jordan','JOR','400',NULL,NULL,NULL,0,0),(109,'JP','JAPAN','Japan','JPN','392',NULL,NULL,NULL,0,0),(110,'KE','KENYA','Kenya','KEN','404',NULL,NULL,NULL,0,0),(111,'KG','KYRGYZSTAN','Kyrgyzstan','KGZ','417',NULL,NULL,NULL,0,0),(112,'KH','CAMBODIA','Cambodia','KHM','116',NULL,NULL,NULL,0,0),(113,'KI','KIRIBATI','Kiribati','KIR','296',NULL,NULL,NULL,0,0),(114,'KM','COMOROS','Comoros','COM','174',NULL,NULL,NULL,0,0),(115,'KN','SAINT KITTS AND NEVIS','Saint Kitts and Nevis','KNA','659',NULL,NULL,NULL,0,0),(116,'KP','KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF','Korea, Democratic People\'s Republic of','PRK','408',NULL,NULL,NULL,0,0),(117,'KR','KOREA, REPUBLIC OF','Korea, Republic of','KOR','410',NULL,NULL,NULL,0,0),(118,'KW','KUWAIT','Kuwait','KWT','414',NULL,NULL,NULL,0,0),(119,'KY','CAYMAN ISLANDS','Cayman Islands','CYM','136',NULL,NULL,NULL,0,0),(120,'KZ','KAZAKHSTAN','Kazakhstan','KAZ','398',NULL,NULL,NULL,0,0),(121,'LA','LAO PEOPLE\'S DEMOCRATIC REPUBLIC','Lao People\'s Democratic Republic','LAO','418',NULL,NULL,NULL,0,0),(122,'LB','LEBANON','Lebanon','LBN','422',NULL,NULL,NULL,0,0),(123,'LC','SAINT LUCIA','Saint Lucia','LCA','662',NULL,NULL,NULL,0,0),(124,'LI','LIECHTENSTEIN','Liechtenstein','LIE','438',NULL,NULL,NULL,0,0),(125,'LK','SRI LANKA','Sri Lanka','LKA','144',NULL,NULL,NULL,0,0),(126,'LR','LIBERIA','Liberia','LBR','430',NULL,NULL,NULL,0,0),(127,'LS','LESOTHO','Lesotho','LSO','426',NULL,NULL,NULL,0,0),(128,'LT','LITHUANIA','Lithuania','LTU','440',NULL,NULL,NULL,0,0),(129,'LU','LUXEMBOURG','Luxembourg','LUX','442',NULL,NULL,NULL,0,0),(130,'LV','LATVIA','Latvia','LVA','428',NULL,NULL,NULL,0,0),(131,'LY','LIBYAN ARAB JAMAHIRIYA','Libyan Arab Jamahiriya','LBY','434',NULL,NULL,NULL,0,0),(132,'MA','MOROCCO','Morocco','MAR','504',NULL,NULL,NULL,0,0),(133,'MC','MONACO','Monaco','MCO','492',NULL,NULL,NULL,0,0),(134,'MD','MOLDOVA, REPUBLIC OF','Moldova, Republic of','MDA','498',NULL,NULL,NULL,0,0),(135,'MG','MADAGASCAR','Madagascar','MDG','450',NULL,NULL,NULL,0,0),(136,'MH','MARSHALL ISLANDS','Marshall Islands','MHL','584',NULL,NULL,NULL,0,0),(137,'MK','MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','Macedonia, the Former Yugoslav Republic of','MKD','807',NULL,NULL,NULL,0,0),(138,'ML','MALI','Mali','MLI','466',NULL,NULL,NULL,0,0),(139,'MM','MYANMAR','Myanmar','MMR','104',NULL,NULL,NULL,0,0),(140,'MN','MONGOLIA','Mongolia','MNG','496',NULL,NULL,NULL,0,0),(141,'MO','MACAO','Macao','MAC','446',NULL,NULL,NULL,0,0),(142,'MP','NORTHERN MARIANA ISLANDS','Northern Mariana Islands','MNP','580',NULL,NULL,NULL,0,0),(143,'MQ','MARTINIQUE','Martinique','MTQ','474',NULL,NULL,NULL,0,0),(144,'MR','MAURITANIA','Mauritania','MRT','478',NULL,NULL,NULL,0,0),(145,'MS','MONTSERRAT','Montserrat','MSR','500',NULL,NULL,NULL,0,0),(146,'MT','MALTA','Malta','MLT','470',NULL,NULL,NULL,0,0),(147,'MU','MAURITIUS','Mauritius','MUS','480',NULL,NULL,NULL,0,0),(148,'MV','MALDIVES','Maldives','MDV','462',NULL,NULL,NULL,0,0),(149,'MW','MALAWI','Malawi','MWI','454',NULL,NULL,NULL,0,0),(150,'MX','MEXICO','Mexico','MEX','484',NULL,NULL,NULL,0,0),(151,'MY','MALAYSIA','Malaysia','MYS','458',NULL,NULL,NULL,1,0),(152,'MZ','MOZAMBIQUE','Mozambique','MOZ','508',NULL,NULL,NULL,0,0),(153,'NA','NAMIBIA','Namibia','NAM','516',NULL,NULL,NULL,0,0),(154,'NC','NEW CALEDONIA','New Caledonia','NCL','540',NULL,NULL,NULL,0,0),(155,'NE','NIGER','Niger','NER','562',NULL,NULL,NULL,0,0),(156,'NF','NORFOLK ISLAND','Norfolk Island','NFK','574',NULL,NULL,NULL,0,0),(157,'NG','NIGERIA','Nigeria','NGA','566',NULL,NULL,NULL,0,0),(158,'NI','NICARAGUA','Nicaragua','NIC','558',NULL,NULL,NULL,0,0),(159,'NL','NETHERLANDS','Netherlands','NLD','528',NULL,NULL,NULL,0,0),(160,'NO','NORWAY','Norway','NOR','578',NULL,NULL,NULL,0,0),(161,'NP','NEPAL','Nepal','NPL','524',NULL,NULL,NULL,0,0),(162,'NR','NAURU','Nauru','NRU','520',NULL,NULL,NULL,0,0),(163,'NU','NIUE','Niue','NIU','570',NULL,NULL,NULL,0,0),(164,'NZ','NEW ZEALAND','New Zealand','NZL','554',NULL,NULL,NULL,0,0),(165,'OM','OMAN','Oman','OMN','512',NULL,NULL,NULL,0,0),(166,'PA','PANAMA','Panama','PAN','591',NULL,NULL,NULL,0,0),(167,'PE','PERU','Peru','PER','604',NULL,NULL,NULL,0,0),(168,'PF','FRENCH POLYNESIA','French Polynesia','PYF','258',NULL,NULL,NULL,0,0),(169,'PG','PAPUA NEW GUINEA','Papua New Guinea','PNG','598',NULL,NULL,NULL,0,0),(170,'PH','PHILIPPINES','Philippines','PHL','608',NULL,NULL,NULL,1,0),(171,'PK','PAKISTAN','Pakistan','PAK','586',NULL,NULL,NULL,0,0),(172,'PL','POLAND','Poland','POL','616',NULL,NULL,NULL,0,0),(173,'PM','SAINT PIERRE AND MIQUELON','Saint Pierre and Miquelon','SPM','666',NULL,NULL,NULL,0,0),(174,'PN','PITCAIRN','Pitcairn','PCN','612',NULL,NULL,NULL,0,0),(175,'PR','PUERTO RICO','Puerto Rico','PRI','630',NULL,NULL,NULL,0,0),(176,'PS','PALESTINIAN TERRITORY, OCCUPIED','Palestinian Territory, Occupied',NULL,NULL,NULL,NULL,NULL,0,0),(177,'PT','PORTUGAL','Portugal','PRT','620',NULL,NULL,NULL,0,0),(178,'PW','PALAU','Palau','PLW','585',NULL,NULL,NULL,0,0),(179,'PY','PARAGUAY','Paraguay','PRY','600',NULL,NULL,NULL,0,0),(180,'QA','QATAR','Qatar','QAT','634',NULL,NULL,NULL,0,0),(181,'RE','REUNION','Reunion','REU','638',NULL,NULL,NULL,0,0),(182,'RO','ROMANIA','Romania','ROM','642',NULL,NULL,NULL,0,0),(183,'RU','RUSSIAN FEDERATION','Russian Federation','RUS','643',NULL,NULL,NULL,0,0),(184,'RW','RWANDA','Rwanda','RWA','646',NULL,NULL,NULL,0,0),(185,'SA','SAUDI ARABIA','Saudi Arabia','SAU','682',NULL,NULL,NULL,0,0),(186,'SB','SOLOMON ISLANDS','Solomon Islands','SLB','90',NULL,NULL,NULL,0,0),(187,'SC','SEYCHELLES','Seychelles','SYC','690',NULL,NULL,NULL,0,0),(188,'SD','SUDAN','Sudan','SDN','736',NULL,NULL,NULL,0,0),(189,'SE','SWEDEN','Sweden','SWE','752',NULL,NULL,NULL,0,0),(190,'SG','SINGAPORE','Singapore','SGP','702',NULL,NULL,NULL,1,0),(191,'SH','SAINT HELENA','Saint Helena','SHN','654',NULL,NULL,NULL,0,0),(192,'SI','SLOVENIA','Slovenia','SVN','705',NULL,NULL,NULL,0,0),(193,'SJ','SVALBARD AND JAN MAYEN','Svalbard and Jan Mayen','SJM','744',NULL,NULL,NULL,0,0),(194,'SK','SLOVAKIA','Slovakia','SVK','703',NULL,NULL,NULL,0,0),(195,'SL','SIERRA LEONE','Sierra Leone','SLE','694',NULL,NULL,NULL,0,0),(196,'SM','SAN MARINO','San Marino','SMR','674',NULL,NULL,NULL,0,0),(197,'SN','SENEGAL','Senegal','SEN','686',NULL,NULL,NULL,0,0),(198,'SO','SOMALIA','Somalia','SOM','706',NULL,NULL,NULL,0,0),(199,'SR','SURINAME','Suriname','SUR','740',NULL,NULL,NULL,0,0),(200,'ST','SAO TOME AND PRINCIPE','Sao Tome and Principe','STP','678',NULL,NULL,NULL,0,0),(201,'SV','EL SALVADOR','El Salvador','SLV','222',NULL,NULL,NULL,0,0),(202,'SY','SYRIAN ARAB REPUBLIC','Syrian Arab Republic','SYR','760',NULL,NULL,NULL,0,0),(203,'SZ','SWAZILAND','Swaziland','SWZ','748',NULL,NULL,NULL,0,0),(204,'TC','TURKS AND CAICOS ISLANDS','Turks and Caicos Islands','TCA','796',NULL,NULL,NULL,0,0),(205,'TD','CHAD','Chad','TCD','148',NULL,NULL,NULL,0,0),(206,'TF','FRENCH SOUTHERN TERRITORIES','French Southern Territories',NULL,NULL,NULL,NULL,NULL,0,0),(207,'TG','TOGO','Togo','TGO','768',NULL,NULL,NULL,0,0),(208,'TH','THAILAND','Thailand','THA','764',NULL,NULL,NULL,1,0),(209,'TJ','TAJIKISTAN','Tajikistan','TJK','762',NULL,NULL,NULL,0,0),(210,'TK','TOKELAU','Tokelau','TKL','772',NULL,NULL,NULL,0,0),(211,'TL','TIMOR-LESTE','Timor-Leste',NULL,NULL,NULL,NULL,NULL,0,0),(212,'TM','TURKMENISTAN','Turkmenistan','TKM','795',NULL,NULL,NULL,0,0),(213,'TN','TUNISIA','Tunisia','TUN','788',NULL,NULL,NULL,0,0),(214,'TO','TONGA','Tonga','TON','776',NULL,NULL,NULL,0,0),(215,'TR','TURKEY','Turkey','TUR','792',NULL,NULL,NULL,0,0),(216,'TT','TRINIDAD AND TOBAGO','Trinidad and Tobago','TTO','780',NULL,NULL,NULL,0,0),(217,'TV','TUVALU','Tuvalu','TUV','798',NULL,NULL,NULL,0,0),(218,'TW','TAIWAN, PROVINCE OF CHINA','Taiwan, Province of China','TWN','158',NULL,NULL,NULL,0,0),(219,'TZ','TANZANIA, UNITED REPUBLIC OF','Tanzania, United Republic of','TZA','834',NULL,NULL,NULL,0,0),(220,'UA','UKRAINE','Ukraine','UKR','804',NULL,NULL,NULL,0,0),(221,'UG','UGANDA','Uganda','UGA','800',NULL,NULL,NULL,0,0),(222,'UM','UNITED STATES MINOR OUTLYING ISLANDS','United States Minor Outlying Islands',NULL,NULL,NULL,NULL,NULL,0,0),(223,'US','UNITED STATES','United States','USA','840',NULL,NULL,NULL,0,0),(224,'UY','URUGUAY','Uruguay','URY','858',NULL,NULL,NULL,0,0),(225,'UZ','UZBEKISTAN','Uzbekistan','UZB','860',NULL,NULL,NULL,0,0),(226,'VA','HOLY SEE (VATICAN CITY STATE)','Holy See (Vatican City State)','VAT','336',NULL,NULL,NULL,0,0),(227,'VC','SAINT VINCENT AND THE GRENADINES','Saint Vincent and the Grenadines','VCT','670',NULL,NULL,NULL,0,0),(228,'VE','VENEZUELA','Venezuela','VEN','862',NULL,NULL,NULL,0,0),(229,'VG','VIRGIN ISLANDS, BRITISH','Virgin Islands, British','VGB','92',NULL,NULL,NULL,0,0),(230,'VI','VIRGIN ISLANDS, U.S.','Virgin Islands, U.s.','VIR','850',NULL,NULL,NULL,0,0),(231,'VN','VIET NAM','Viet Nam','VNM','704',NULL,NULL,NULL,1,0),(232,'VU','VANUATU','Vanuatu','VUT','548',NULL,NULL,NULL,0,0),(233,'WF','WALLIS AND FUTUNA','Wallis and Futuna','WLF','876',NULL,NULL,NULL,0,0),(234,'WS','SAMOA','Samoa','WSM','882',NULL,NULL,NULL,0,0),(235,'YE','YEMEN','Yemen','YEM','887',NULL,NULL,NULL,0,0),(236,'YT','MAYOTTE','Mayotte','','568',NULL,NULL,NULL,0,0),(237,'ZA','SOUTH AFRICA','South Africa','ZAF','710',NULL,NULL,NULL,0,0),(238,'ZM','ZAMBIA','Zambia','ZMB','894',NULL,NULL,NULL,0,0),(239,'ZW','ZIMBABWE','Zimbabwe','ZWE','716',NULL,NULL,NULL,0,0),(240,'vc','vbc','vb',NULL,'11',NULL,NULL,NULL,1,1);

/*Table structure for table `bf_disease_symptoms_mapping` */

CREATE TABLE `bf_disease_symptoms_mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_disease_id` int(11) DEFAULT NULL,
  `country_symptom_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `bf_disease_symptoms_mapping` */

insert  into `bf_disease_symptoms_mapping`(`id`,`country_disease_id`,`country_symptom_id`) values (1,1,1),(2,1,2),(3,1,3),(4,2,1),(5,3,2);

/*Table structure for table `bf_ecp_activity_execution_joint_visit_details` */

CREATE TABLE `bf_ecp_activity_execution_joint_visit_details` (
  `joint_visit_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_planning_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`joint_visit_details_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_activity_execution_joint_visit_details` */

/*Table structure for table `bf_ecp_activity_master_country` */

CREATE TABLE `bf_ecp_activity_master_country` (
  `activity_type_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_type_id` int(11) DEFAULT NULL,
  `activity_type_code` varchar(255) DEFAULT NULL,
  `activity_type_country_name` varchar(255) DEFAULT NULL,
  `expence_type` enum('fixed','actual','max') DEFAULT NULL,
  `expence_amount` decimal(9,2) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`activity_type_country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_activity_master_country` */

insert  into `bf_ecp_activity_master_country`(`activity_type_country_id`,`activity_type_id`,`activity_type_code`,`activity_type_country_name`,`expence_type`,`expence_amount`,`country_id`,`deleted`,`created_by_user`,`modified_by_user`,`status`,`created_on`,`modified_on`) values (1,1,'FMP001','Farmer Meeting Planning','actual',NULL,101,0,NULL,NULL,1,NULL,NULL),(2,2,'FVP002','Farmer Visit Planning','fixed','1000.00',101,0,NULL,NULL,1,NULL,NULL),(3,3,'RMP003','Retailer Meeting','max','4000.00',101,0,NULL,NULL,1,NULL,NULL),(4,4,'RVP004','Retailer Visit Planning','actual',NULL,101,0,NULL,NULL,1,NULL,NULL),(5,5,'DP005','Demonstration Planning','fixed','2000.00',101,0,NULL,NULL,1,NULL,NULL),(6,6,'FDP006','Field Day Planning','max','3000.00',101,0,NULL,NULL,1,NULL,NULL);

/*Table structure for table `bf_ecp_activity_planning` */

CREATE TABLE `bf_ecp_activity_planning` (
  `activity_planning_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_planning_date` date DEFAULT NULL,
  `activity_planning_time` datetime DEFAULT NULL,
  `execution_date` date DEFAULT NULL,
  `execution_time` datetime DEFAULT NULL,
  `meeting_duration` time DEFAULT NULL,
  `activity_type_id` int(11) DEFAULT NULL,
  `demo_id` int(11) DEFAULT NULL,
  `geo_level_id_2` int(11) DEFAULT NULL,
  `geo_level_id_3` int(11) DEFAULT NULL,
  `geo_level_id_4` int(11) DEFAULT NULL,
  `geo_level_id` int(11) DEFAULT NULL,
  `location` text,
  `proposed_attandence_count` int(11) DEFAULT NULL,
  `point_discussion` varchar(255) DEFAULT NULL,
  `alert` text,
  `size_of_plot` decimal(9,2) DEFAULT NULL,
  `spray_volume` decimal(9,2) DEFAULT NULL,
  `amount` decimal(9,2) DEFAULT NULL,
  `rating` float(2,1) DEFAULT NULL,
  `activity_note` text,
  `employee_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `is_planned` tinyint(1) DEFAULT '0',
  `is_cco` tinyint(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `submit_status` tinyint(1) DEFAULT '0',
  `reference_type` tinyint(1) DEFAULT '0',
  `reference_id` int(11) DEFAULT NULL,
  `cancle_reson` text,
  `submit_date` date DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `approved_date` date DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`activity_planning_id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_activity_planning` */

insert  into `bf_ecp_activity_planning`(`activity_planning_id`,`activity_planning_date`,`activity_planning_time`,`execution_date`,`execution_time`,`meeting_duration`,`activity_type_id`,`demo_id`,`geo_level_id_2`,`geo_level_id_3`,`geo_level_id_4`,`geo_level_id`,`location`,`proposed_attandence_count`,`point_discussion`,`alert`,`size_of_plot`,`spray_volume`,`amount`,`rating`,`activity_note`,`employee_id`,`country_id`,`is_planned`,`is_cco`,`status`,`submit_status`,`reference_type`,`reference_id`,`cancle_reson`,`submit_date`,`approved_by`,`approved_date`,`created_by_user`,`modified_by_user`,`created_on`,`modified_on`) values (1,'2016-06-27','2016-06-27 00:00:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'test address',12,'test','test','0.00','0.00','0.00',NULL,NULL,20,101,0,0,0,0,0,0,NULL,NULL,NULL,NULL,20,NULL,'2016-07-25 14:05:33','2016-07-25 14:05:33'),(2,'2016-08-23','2016-08-23 00:00:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'test',12,'testqwe','qweq123','0.00','0.00','0.00',NULL,NULL,20,101,0,0,2,1,0,0,NULL,NULL,47,'2016-08-02',20,47,'2016-07-25 14:07:50','2016-08-02 15:55:40'),(3,'2016-07-30','2016-07-30 00:00:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'qweqwe123',12,'sdfs','1231dxfgskjd','0.00','0.00','0.00',NULL,NULL,20,101,0,0,0,0,0,0,NULL,NULL,NULL,NULL,20,NULL,'2016-07-25 14:32:09','2016-07-25 14:32:09'),(4,'2016-06-27','2016-06-27 00:00:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'asdaa',12,'qweqw','drgr','0.00','0.00','0.00',NULL,NULL,20,101,0,0,0,0,0,0,NULL,NULL,NULL,NULL,20,NULL,'2016-07-25 14:39:50','2016-07-25 14:39:50'),(5,'2016-07-29','2016-07-29 15:00:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'test',12,'test','test','0.00','0.00','0.00',NULL,NULL,20,101,0,0,0,0,0,0,NULL,NULL,NULL,NULL,20,20,'2016-07-25 15:00:03','2016-07-31 08:26:12'),(6,'2016-07-29','2016-07-29 00:00:00',NULL,NULL,NULL,1,NULL,3,4,8,8,'dfghdsf',234,'werw','dregtde','0.00','0.00','0.00',NULL,NULL,20,101,0,0,0,0,0,0,NULL,NULL,NULL,NULL,20,NULL,'2016-07-25 15:04:46','2016-07-25 15:04:46'),(7,'2016-07-03','2016-07-03 00:00:00',NULL,NULL,NULL,1,NULL,3,4,8,8,'rfghdfg',43,'qweq','werew','0.00','0.00','0.00',NULL,NULL,20,101,0,0,1,1,0,0,NULL,'2016-07-25',NULL,NULL,20,20,'2016-07-25 15:08:57','2016-07-25 15:21:11'),(8,'2016-08-12','2016-08-12 21:40:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'werw',12,'12sd','dregfd','0.00','0.00','12.00',NULL,NULL,20,101,1,0,5,0,1,0,NULL,'2016-07-25',47,'2016-07-31',20,20,'2016-07-25 15:22:17','2016-08-15 22:54:27'),(9,'2016-08-02','2016-08-02 12:30:00','2016-09-08','2016-09-08 12:12:00','00:00:12',1,NULL,3,4,5,5,'12weqweq',12,'','','0.00','0.00','1231.00',3.7,'1231231',20,101,1,0,4,0,0,0,NULL,'2016-08-02',47,'2016-08-02',20,20,'2016-07-26 06:59:53','2016-08-02 16:31:04'),(10,'2016-08-02','2016-08-02 12:30:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'fgklhdefrt',12,'jkdhfrg','jksrgfs','0.00','0.00','0.00',NULL,NULL,20,101,0,0,2,1,0,0,'fghdfghdfghdf',NULL,47,'2016-08-02',20,20,'2016-07-26 07:09:47','2016-08-10 21:17:45'),(11,'2016-07-28','2016-07-28 01:15:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'sdfsa',1231,'qweq`1','asda12','0.00','0.00','0.00',NULL,NULL,20,101,0,0,1,1,0,0,NULL,'2016-07-26',47,'2016-07-27',20,47,'2016-07-26 07:57:00','2016-07-27 10:56:36'),(12,'2016-07-01','2016-07-01 04:00:00',NULL,NULL,NULL,1,NULL,3,4,8,8,'werwe',21,'23','dfg','0.00','0.00','0.00',NULL,NULL,20,101,0,0,0,0,0,0,NULL,NULL,NULL,NULL,20,NULL,'2016-07-26 10:41:13','2016-07-26 10:41:13'),(13,'2016-07-01','2016-07-01 04:15:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'fghfghfgh',10,'','','0.00','0.00','0.00',NULL,NULL,20,101,0,0,0,0,0,0,NULL,NULL,NULL,NULL,20,NULL,'2016-07-26 10:57:27','2016-07-26 10:57:27'),(14,'2016-07-29','2016-07-29 04:30:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'tesdfs sda',12,'123','ewq12','0.00','0.00','0.00',NULL,NULL,20,101,0,0,0,0,0,0,NULL,NULL,NULL,NULL,20,NULL,'2016-07-26 11:05:20','2016-07-26 11:05:20'),(15,'2016-07-29','2016-07-29 04:30:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'tesdfs sda',12,'123','ewq12','0.00','0.00','0.00',NULL,NULL,20,101,0,0,0,0,0,0,NULL,NULL,NULL,NULL,20,NULL,'2016-07-26 11:05:28','2016-07-26 11:05:28'),(16,'2016-07-29','2016-07-29 03:00:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'test',12,'test','test','0.00','0.00','0.00',NULL,NULL,20,101,0,0,3,1,0,0,NULL,'2016-07-27',47,'2016-07-31',20,47,'2016-07-27 09:22:36','2016-07-31 10:20:03'),(17,NULL,NULL,'2016-08-03','2016-08-03 09:00:00',NULL,1,NULL,3,4,5,5,'dfkgs',1231,'dfsgkjdf','shdfgsdf','0.00','0.00','1231.00',2.3,'ldfgs;df123',20,101,1,0,4,1,0,0,NULL,NULL,NULL,NULL,20,NULL,'2016-07-28 15:50:57','2016-07-28 15:50:57'),(18,'2016-07-30','2016-07-30 03:00:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'reert32',121,'sdfgsd','wewqwe','0.00','0.00','0.00',NULL,NULL,20,101,0,0,0,0,0,0,NULL,NULL,NULL,NULL,20,NULL,'2016-07-29 09:33:14','2016-07-29 09:33:14'),(19,'2016-07-29','2016-07-29 15:00:00',NULL,NULL,NULL,1,NULL,0,4,5,5,'test',12,'test','test','0.00','0.00','0.00',NULL,NULL,20,101,0,0,0,0,0,0,NULL,NULL,NULL,NULL,20,NULL,'2016-07-29 10:55:07','2016-07-29 10:55:07'),(20,'2016-07-29','2016-07-29 15:00:00',NULL,NULL,NULL,1,NULL,0,4,5,5,'test',12,'test','test','0.00','0.00','0.00',NULL,NULL,20,101,0,0,0,0,0,0,NULL,NULL,NULL,NULL,20,NULL,'2016-07-29 10:55:23','2016-07-29 10:55:23'),(21,'2016-08-05','2016-08-05 18:30:00','2016-08-12','2016-08-12 12:12:00','12:12:12',1,NULL,3,4,5,5,'f\'ghdf',0,'987','987','0.00','0.00','300.00',3.4,'test',20,101,1,0,4,1,0,0,'test','2016-08-11',47,'2016-08-02',20,20,'2016-07-29 13:14:47','2016-08-11 22:08:12'),(22,NULL,NULL,'2016-06-27','2016-06-27 18:30:00',NULL,2,NULL,3,4,5,5,'f\'ghdf',0,'987','987','0.00','0.00','97.00',2.2,'987',20,101,1,0,4,1,0,0,NULL,'2016-07-29',NULL,NULL,20,NULL,'2016-07-29 13:17:47','2016-07-29 13:17:47'),(23,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','1231.00',2.1,'dsfgsdfg',20,101,1,0,4,1,0,0,NULL,'2016-07-29',NULL,NULL,20,NULL,'2016-07-29 13:54:24','2016-07-29 13:54:24'),(24,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','1231.00',2.1,'dsfgsdfg',20,101,1,0,4,1,0,0,NULL,'2016-07-29',NULL,NULL,20,NULL,'2016-07-29 13:56:11','2016-07-29 13:56:11'),(25,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','1231.00',2.1,'dsfgsdfg',20,101,1,0,4,1,0,0,NULL,'2016-07-29',NULL,NULL,20,NULL,'2016-07-29 13:56:52','2016-07-29 13:56:52'),(26,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','1231.00',2.1,'dsfgsdfg',20,101,1,0,4,1,0,0,NULL,'2016-07-29',NULL,NULL,20,NULL,'2016-07-29 13:57:18','2016-07-29 13:57:18'),(27,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','1231.00',2.1,'dsfgsdfg',20,101,1,0,4,1,0,0,NULL,'2016-07-29',NULL,NULL,20,NULL,'2016-07-29 14:01:04','2016-07-29 14:01:04'),(28,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','1231.00',2.1,'dsfgsdfg',20,101,1,0,4,1,0,0,NULL,'2016-07-29',NULL,NULL,20,NULL,'2016-07-29 14:01:07','2016-07-29 14:01:07'),(29,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','1231.00',2.1,'dsfgsdfg',20,101,1,0,4,1,0,0,NULL,'2016-07-29',NULL,NULL,20,NULL,'2016-07-29 14:02:43','2016-07-29 14:02:43'),(30,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','1231.00',2.1,'dsfgsdfg',20,101,1,0,4,1,0,0,NULL,'2016-07-29',NULL,NULL,20,NULL,'2016-07-29 14:03:39','2016-07-29 14:03:39'),(31,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','1231.00',2.1,'dsfgsdfg',20,101,1,0,4,1,0,0,NULL,'2016-07-29',NULL,NULL,20,NULL,'2016-07-29 14:04:45','2016-07-29 14:04:45'),(32,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','1231.00',2.1,'dsfgsdfg',20,101,1,0,4,1,0,0,NULL,'2016-07-29',NULL,NULL,20,NULL,'2016-07-29 14:10:00','2016-07-29 14:10:00'),(33,'2016-08-01','2016-08-01 15:00:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','0.00',NULL,NULL,20,101,0,1,2,1,0,0,NULL,NULL,47,'2016-08-02',20,47,'2016-07-30 06:08:23','2016-08-02 15:55:19'),(34,'2016-08-01','2016-08-01 15:00:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','0.00',NULL,NULL,20,101,0,0,3,1,1,0,NULL,NULL,47,'2016-08-01',20,47,'2016-07-30 06:12:49','2016-08-01 14:53:34'),(35,'2016-08-02','2016-08-02 17:30:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'utfyu',12,'edfgsdef','hjgsdfs','0.00','0.00','0.00',NULL,NULL,20,101,1,0,1,1,0,0,NULL,'2016-08-01',NULL,NULL,20,47,'2016-08-01 12:07:39','2016-08-05 12:26:15'),(36,'2016-08-02','2016-08-02 17:30:00','2016-09-08','2016-09-08 12:12:00','12:12:00',1,NULL,3,4,5,5,'wewre1231',121,'1231','qeq123231','0.00','0.00','121.00',0.0,'weqeq',20,101,1,0,4,1,0,0,NULL,'2016-08-02',47,'2016-08-01',20,20,'2016-08-01 12:14:00','2016-08-02 15:43:12'),(37,'2016-08-29','2016-08-29 19:30:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'ertrewter',1231,'1231231','sdfasd','0.00','0.00','0.00',NULL,NULL,20,101,1,0,0,1,1,0,NULL,NULL,NULL,NULL,20,NULL,'2016-08-01 14:02:50','2016-08-01 14:02:50'),(38,NULL,NULL,'2016-08-30','2016-08-30 19:30:00',NULL,1,NULL,3,4,5,5,'ertrewter',1231,'1231231','sdfasd','0.00','0.00','123.00',1.4,'12312e',20,101,0,0,4,1,0,0,NULL,'2016-08-01',NULL,NULL,20,NULL,'2016-08-01 14:02:54','2016-08-01 14:02:54'),(39,'2016-08-31','2016-08-31 19:30:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'erte',1231,'123','123123','0.00','0.00','0.00',NULL,NULL,20,101,1,0,0,0,1,0,NULL,NULL,NULL,NULL,20,NULL,'2016-08-01 14:09:39','2016-08-01 14:09:39'),(40,NULL,NULL,'2016-08-09','2016-08-09 20:15:00',NULL,1,NULL,3,4,5,5,'qweqwe',12,'sdfsdf','sdfsdf','0.00','0.00','12.00',1.7,'werqw',20,101,0,0,4,1,0,0,NULL,'2016-08-03',NULL,NULL,20,NULL,'2016-08-03 14:46:56','2016-08-03 14:46:56'),(41,'2016-08-08','2016-08-08 20:15:00',NULL,NULL,NULL,3,NULL,128,129,0,129,'sdlkfhsldfs',1231,'12312','12313','0.00','0.00','0.00',NULL,NULL,20,101,1,0,0,0,0,0,NULL,'2016-08-04',NULL,NULL,20,20,'2016-08-04 20:23:41','2016-08-04 20:34:14'),(42,NULL,NULL,'2016-08-16','2016-08-16 18:00:00',NULL,1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','3333.00',2.5,'gfd g dfg df gdfgdfgdgf',20,101,0,0,4,1,0,0,NULL,'2016-08-05',NULL,NULL,20,NULL,'2016-08-05 19:34:46','2016-08-05 19:34:46'),(43,NULL,NULL,'2016-08-16','2016-08-16 18:00:00',NULL,1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','3333.00',2.5,'gfd g dfg df gdfgdfgdgf',20,101,0,0,4,1,0,0,NULL,'2016-08-05',NULL,NULL,20,NULL,'2016-08-05 19:36:47','2016-08-05 19:36:47'),(44,NULL,NULL,'2016-08-16','2016-08-16 18:00:00',NULL,1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','3333.00',2.5,'gfd g dfg df gdfgdfgdgf',20,101,0,0,4,1,0,0,NULL,'2016-08-05',NULL,NULL,20,NULL,'2016-08-05 19:37:26','2016-08-05 19:37:26'),(45,NULL,NULL,'2016-08-16','2016-08-16 18:00:00',NULL,1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','3333.00',2.5,'gfd g dfg df gdfgdfgdgf',20,101,0,0,4,1,0,0,NULL,'2016-08-05',NULL,NULL,20,NULL,'2016-08-05 19:40:30','2016-08-05 19:40:30'),(46,NULL,NULL,'2016-08-16','2016-08-16 18:00:00',NULL,1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','3333.00',2.5,'gfd g dfg df gdfgdfgdgf',20,101,0,0,4,1,0,0,NULL,'2016-08-05',NULL,NULL,20,NULL,'2016-08-05 19:49:34','2016-08-05 19:49:34'),(47,NULL,NULL,'2016-08-16','2016-08-16 18:00:00',NULL,1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','3333.00',2.5,'gfd g dfg df gdfgdfgdgf',20,101,0,0,4,1,0,0,NULL,'2016-08-05',NULL,NULL,20,NULL,'2016-08-05 20:11:05','2016-08-05 20:11:05'),(48,NULL,NULL,'2016-08-16','2016-08-16 18:00:00',NULL,1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','3333.00',2.5,'gfd g dfg df gdfgdfgdgf',20,101,0,0,4,1,0,0,NULL,'2016-08-05',NULL,NULL,20,NULL,'2016-08-05 20:12:11','2016-08-05 20:12:11'),(49,NULL,NULL,'2016-08-16','2016-08-16 18:00:00',NULL,1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','3333.00',2.5,'gfd g dfg df gdfgdfgdgf',20,101,0,0,4,1,0,0,NULL,'2016-08-05',NULL,NULL,20,NULL,'2016-08-05 20:13:10','2016-08-05 20:13:10'),(50,NULL,NULL,'2016-08-16','2016-08-16 18:00:00',NULL,1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','3333.00',2.5,'gfd g dfg df gdfgdfgdgf',20,101,0,0,4,1,0,0,NULL,'2016-08-05',NULL,NULL,20,NULL,'2016-08-05 20:13:48','2016-08-05 20:13:48'),(51,NULL,NULL,'2016-08-16','2016-08-16 18:00:00',NULL,1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','3333.00',2.5,'gfd g dfg df gdfgdfgdgf',20,101,0,0,4,1,0,0,NULL,'2016-08-05',NULL,NULL,20,NULL,'2016-08-05 20:14:18','2016-08-05 20:14:18'),(52,NULL,NULL,'2016-08-23','2016-08-23 01:45:00','01:45:15',1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','11.00',2.1,'121sadasdsad',20,101,0,0,4,1,0,0,NULL,'2016-08-16',NULL,NULL,20,20,'2016-08-05 20:16:37','2016-08-16 01:51:18'),(53,NULL,NULL,'1970-01-01','1970-01-01 17:00:00','12:11:43',1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','12.00',2.5,'12313',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,20,'2016-08-05 20:17:04','2016-08-09 17:11:27'),(54,NULL,NULL,'2016-08-16','2016-08-16 01:45:00','01:45:30',1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','1212.00',1.4,'qweq',20,101,0,0,4,1,0,0,NULL,'2016-08-16',NULL,NULL,20,20,'2016-08-05 20:17:36','2016-08-16 01:54:30'),(55,NULL,NULL,'2016-08-16','2016-08-16 18:00:00',NULL,1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','3333.00',2.5,'gfd g dfg df gdfgdfgdgf',20,101,0,0,4,1,0,0,NULL,'2016-08-05',NULL,NULL,20,NULL,'2016-08-05 20:17:46','2016-08-05 20:17:46'),(56,NULL,NULL,'2016-08-16','2016-08-16 18:00:00',NULL,1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','3333.00',2.5,'gfd g dfg df gdfgdfgdgf',20,101,0,0,4,1,0,0,NULL,'2016-08-05',NULL,NULL,20,NULL,'2016-08-05 20:18:59','2016-08-05 20:18:59'),(57,NULL,NULL,'2016-08-16','2016-08-16 18:00:00',NULL,1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','3333.00',2.5,'gfd g dfg df gdfgdfgdgf',20,101,0,0,4,1,0,0,NULL,'2016-08-05',NULL,NULL,20,NULL,'2016-08-05 20:19:41','2016-08-05 20:19:41'),(58,NULL,NULL,'2016-08-16','2016-08-16 18:00:00',NULL,1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','3333.00',2.5,'gfd g dfg df gdfgdfgdgf',20,101,0,0,4,1,0,0,NULL,'2016-08-05',NULL,NULL,20,NULL,'2016-08-05 20:20:54','2016-08-05 20:20:54'),(59,NULL,NULL,'2016-08-16','2016-08-16 18:00:00',NULL,1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','3333.00',2.5,'gfd g dfg df gdfgdfgdgf',20,101,0,0,4,1,0,0,NULL,'2016-08-05',NULL,NULL,20,NULL,'2016-08-05 20:23:40','2016-08-05 20:23:40'),(60,NULL,NULL,'2016-08-16','2016-08-16 18:00:00',NULL,1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','3333.00',2.5,'gfd g dfg df gdfgdfgdgf',20,101,0,0,4,1,0,0,NULL,'2016-08-05',NULL,NULL,20,NULL,'2016-08-05 20:46:31','2016-08-05 20:46:31'),(61,NULL,NULL,'2016-08-16','2016-08-16 18:00:00',NULL,1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','3333.00',2.5,'gfd g dfg df gdfgdfgdgf',20,101,0,0,4,1,0,0,NULL,'2016-08-05',NULL,NULL,20,NULL,'2016-08-05 20:47:18','2016-08-05 20:47:18'),(62,NULL,NULL,'2016-08-31','2016-08-31 13:15:00',NULL,1,NULL,3,4,5,5,'ertert ewrw',11,'dfgsdfg dfgsd','dfgdfgf gsdfg','0.00','0.00','23.00',2.1,'sdfs',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 13:30:42','2016-08-09 13:30:42'),(63,NULL,NULL,'2016-08-31','2016-08-31 13:15:00',NULL,1,NULL,3,4,5,5,'ertert ewrw',11,'dfgsdfg dfgsd','dfgdfgf gsdfg','0.00','0.00','23.00',2.1,'sdfs',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 13:32:32','2016-08-09 13:32:32'),(64,NULL,NULL,'2016-08-31','2016-08-31 13:15:00',NULL,1,NULL,3,4,5,5,'ertert ewrw',11,'dfgsdfg dfgsd','dfgdfgf gsdfg','0.00','0.00','23.00',2.1,'sdfs',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 14:41:36','2016-08-09 14:41:36'),(65,NULL,NULL,'2016-08-31','2016-08-31 13:15:00',NULL,1,NULL,3,4,5,5,'ertert ewrw',11,'dfgsdfg dfgsd','dfgdfgf gsdfg','0.00','0.00','23.00',2.1,'sdfs',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 14:42:08','2016-08-09 14:42:08'),(66,NULL,NULL,'2016-08-31','2016-08-31 13:15:00',NULL,1,NULL,3,4,5,5,'ertert ewrw',11,'dfgsdfg dfgsd','dfgdfgf gsdfg','0.00','0.00','23.00',2.1,'sdfs',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 14:43:55','2016-08-09 14:43:55'),(67,NULL,NULL,'2016-08-31','2016-08-31 13:15:00',NULL,1,NULL,3,4,5,5,'ertert ewrw',11,'dfgsdfg dfgsd','dfgdfgf gsdfg','0.00','0.00','23.00',2.1,'sdfs',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 14:46:10','2016-08-09 14:46:10'),(68,NULL,NULL,'2016-08-31','2016-08-31 13:15:00',NULL,1,NULL,3,4,5,5,'ertert ewrw',11,'dfgsdfg dfgsd','dfgdfgf gsdfg','0.00','0.00','23.00',2.1,'sdfs',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 14:46:52','2016-08-09 14:46:52'),(69,NULL,NULL,'2016-08-31','2016-08-31 13:15:00',NULL,1,NULL,3,4,5,5,'ertert ewrw',11,'dfgsdfg dfgsd','dfgdfgf gsdfg','0.00','0.00','23.00',2.1,'sdfs',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 14:47:15','2016-08-09 14:47:15'),(70,NULL,NULL,'2016-08-31','2016-08-31 13:15:00',NULL,1,NULL,3,4,5,5,'ertert ewrw',11,'dfgsdfg dfgsd','dfgdfgf gsdfg','0.00','0.00','23.00',2.1,'sdfs',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 14:51:20','2016-08-09 14:51:20'),(71,NULL,NULL,'2016-08-31','2016-08-31 13:15:00',NULL,1,NULL,3,4,5,5,'ertert ewrw',11,'dfgsdfg dfgsd','dfgdfgf gsdfg','0.00','0.00','23.00',2.1,'sdfs',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 14:51:47','2016-08-09 14:51:47'),(72,NULL,NULL,'2016-10-08','2016-10-08 17:00:00','12:12:12',1,NULL,3,4,5,5,'yuuyuyuy',66,'','','0.00','0.00','11.00',1.7,'dfsf',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,20,'2016-08-09 14:53:48','2016-08-09 17:08:06'),(73,NULL,NULL,'2016-08-17','2016-08-17 14:45:00',NULL,1,NULL,3,4,5,5,'yuuyuyuy',66,'','','0.00','0.00','666.00',1.9,'',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 15:04:36','2016-08-09 15:04:36'),(74,NULL,NULL,'2016-08-17','2016-08-17 14:45:00',NULL,1,NULL,3,4,5,5,'yuuyuyuy',66,'','','0.00','0.00','666.00',1.9,'',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 15:05:22','2016-08-09 15:05:22'),(75,NULL,NULL,'2016-08-24','2016-08-24 15:30:00',NULL,1,NULL,3,4,5,5,'test',11,'','','0.00','0.00','11.00',2.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 15:36:33','2016-08-09 15:36:33'),(76,NULL,NULL,'2016-08-24','2016-08-24 15:30:00',NULL,1,NULL,3,4,5,5,'test',11,'','','0.00','0.00','11.00',2.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 15:36:53','2016-08-09 15:36:53'),(77,NULL,NULL,'2016-08-24','2016-08-24 15:30:00',NULL,1,NULL,3,4,5,5,'test',11,'','','0.00','0.00','11.00',2.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 16:00:06','2016-08-09 16:00:06'),(78,NULL,NULL,'2016-08-24','2016-08-24 15:30:00',NULL,1,NULL,3,4,5,5,'test',11,'','','0.00','0.00','11.00',2.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 16:02:13','2016-08-09 16:02:13'),(79,NULL,NULL,'2016-08-24','2016-08-24 15:30:00',NULL,1,NULL,3,4,5,5,'test',11,'','','0.00','0.00','11.00',2.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 16:05:58','2016-08-09 16:05:58'),(80,NULL,NULL,'2016-08-24','2016-08-24 15:30:00',NULL,1,NULL,3,4,5,5,'test',11,'','','0.00','0.00','11.00',2.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 16:06:46','2016-08-09 16:06:46'),(81,NULL,NULL,'2016-08-24','2016-08-24 15:30:00',NULL,1,NULL,3,4,5,5,'test',11,'','','0.00','0.00','11.00',2.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 16:07:36','2016-08-09 16:07:36'),(82,NULL,NULL,'2016-08-24','2016-08-24 15:30:00',NULL,1,NULL,3,4,5,5,'test',11,'','','0.00','0.00','11.00',2.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 16:08:49','2016-08-09 16:08:49'),(83,NULL,NULL,'2016-08-24','2016-08-24 15:30:00',NULL,1,NULL,3,4,5,5,'test',11,'','','0.00','0.00','11.00',2.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 16:11:29','2016-08-09 16:11:29'),(84,NULL,NULL,'2016-08-24','2016-08-24 15:30:00',NULL,1,NULL,3,4,5,5,'test',11,'','','0.00','0.00','11.00',2.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 16:12:49','2016-08-09 16:12:49'),(85,NULL,NULL,'2016-08-24','2016-08-24 15:30:00',NULL,1,NULL,3,4,5,5,'test',11,'','','0.00','0.00','11.00',2.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 16:13:49','2016-08-09 16:13:49'),(86,NULL,NULL,'2016-08-24','2016-08-24 15:30:00',NULL,1,NULL,3,4,5,5,'test',11,'','','0.00','0.00','11.00',2.0,'',20,101,0,1,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 16:14:11','2016-08-09 16:14:11'),(87,'2016-08-23','2016-08-23 19:15:00',NULL,NULL,NULL,5,NULL,3,4,5,5,'weriuw',1212,'daasdasd','sdfsdfs','11.00','11.00','0.00',NULL,NULL,20,101,1,0,1,1,0,0,NULL,'2016-08-09',NULL,NULL,20,20,'2016-08-09 19:30:11','2016-08-09 19:31:47'),(88,NULL,NULL,'2016-08-02','2016-08-02 20:15:00',NULL,5,NULL,3,4,5,5,'test',12,'sdfsfsfd','sdfsdf','11.00','11.00','12.00',2.4,'adasda',20,101,0,0,4,1,0,0,NULL,'2016-08-09',NULL,NULL,20,NULL,'2016-08-09 20:28:42','2016-08-09 20:28:42'),(89,'2016-08-26','2016-08-26 21:45:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'fgklhdefrt',12,'jkdhfrg','jksrgfs','0.00','0.00','0.00',NULL,NULL,20,101,1,0,2,1,2,10,NULL,NULL,47,'2016-08-16',20,47,'2016-08-10 22:27:23','2016-08-16 16:18:24'),(90,'2016-09-10','2016-09-10 22:15:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'f\'ghdf',0,'987','987','0.00','0.00','0.00',NULL,NULL,20,101,1,0,1,1,2,21,NULL,'2016-08-10',NULL,NULL,20,NULL,'2016-08-10 22:45:27','2016-08-10 22:45:27'),(91,NULL,NULL,'2016-08-17','2016-08-17 11:15:00',NULL,1,NULL,3,4,5,5,'qweq',12,'dfsfd','qweqe','0.00','0.00','1213.00',2.3,'1231331sdfs',20,101,0,1,4,1,0,0,NULL,'2016-08-11',NULL,NULL,20,NULL,'2016-08-11 11:17:37','2016-08-11 11:17:37'),(92,NULL,NULL,'2016-08-18','2016-08-18 11:15:00',NULL,2,NULL,3,4,5,5,'dfdgdfgd',0,'fdf','wqeq','0.00','0.00','11.00',1.2,'1sdadad',20,101,0,0,4,1,0,0,NULL,'2016-08-11',NULL,NULL,20,NULL,'2016-08-11 11:19:41','2016-08-11 11:19:41'),(93,'2016-08-31','2016-08-31 12:12:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'f\'ghdf',0,'987','987','0.00','0.00','0.00',NULL,NULL,20,101,1,0,2,1,2,21,NULL,'2016-08-11',47,'2016-08-16',20,47,'2016-08-11 21:57:15','2016-08-16 16:18:31'),(94,NULL,NULL,'2016-08-10','2016-08-10 20:45:00',NULL,2,NULL,3,4,5,5,'xfgxfs',0,'','','0.00','0.00','0.00',0.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-15',NULL,NULL,20,NULL,'2016-08-15 20:53:01','2016-08-15 20:53:01'),(95,'1970-01-01','1970-01-01 22:45:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'werw',12,'12sd','dregfd','0.00','0.00','0.00',NULL,NULL,20,101,1,0,1,1,2,8,NULL,'2016-08-15',NULL,NULL,20,NULL,'2016-08-15 22:54:27','2016-08-15 22:54:27'),(96,'2016-08-29','2016-08-29 15:45:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'hgjhhgjg hjghhjh',7687,'hkjljhkk','jhhjkjjj hkjhhjhj','0.00','0.00','0.00',NULL,NULL,20,101,1,0,0,1,1,52,NULL,'2016-08-15',NULL,NULL,20,NULL,'2016-08-15 23:43:30','2016-08-15 23:43:30'),(97,NULL,NULL,'2016-08-24','2016-08-24 23:45:00',NULL,2,NULL,3,4,5,5,'sde',0,'','','0.00','0.00','0.00',0.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-15',NULL,NULL,20,NULL,'2016-08-15 23:46:35','2016-08-15 23:46:35'),(98,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'',0,'','','0.00','0.00','0.00',0.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-15',NULL,NULL,20,NULL,'2016-08-15 23:48:57','2016-08-15 23:48:57'),(99,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'',0,'','','0.00','0.00','0.00',0.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-15',NULL,NULL,20,NULL,'2016-08-15 23:49:21','2016-08-15 23:49:21'),(100,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'',0,'','','0.00','0.00','0.00',0.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-15',NULL,NULL,20,NULL,'2016-08-15 23:52:45','2016-08-15 23:52:45'),(101,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'',0,'','','0.00','0.00','0.00',0.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-15',NULL,NULL,20,NULL,'2016-08-15 23:52:55','2016-08-15 23:52:55'),(102,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'',0,'','','0.00','0.00','0.00',0.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-15',NULL,NULL,20,NULL,'2016-08-15 23:53:52','2016-08-15 23:53:52'),(103,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'',0,'','','0.00','0.00','0.00',0.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-15',NULL,NULL,20,NULL,'2016-08-15 23:54:32','2016-08-15 23:54:32'),(104,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'',0,'','','0.00','0.00','0.00',0.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-15',NULL,NULL,20,NULL,'2016-08-15 23:54:46','2016-08-15 23:54:46'),(105,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'',0,'','','0.00','0.00','0.00',0.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-15',NULL,NULL,20,NULL,'2016-08-15 23:55:58','2016-08-15 23:55:58'),(106,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'',0,'','','0.00','0.00','0.00',0.0,'',20,101,0,0,4,1,0,0,NULL,'2016-08-16',NULL,NULL,20,NULL,'2016-08-16 00:36:23','2016-08-16 00:36:23'),(107,'2016-07-31','2016-07-31 20:00:00','2016-08-21','2016-08-21 12:30:35',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','0.00',NULL,NULL,20,101,1,0,0,0,1,0,NULL,NULL,NULL,NULL,20,NULL,'2016-08-16 12:33:44','2016-08-16 12:33:44'),(108,'2016-08-01','2016-08-01 15:00:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','0.00',NULL,NULL,20,101,1,0,0,0,1,0,NULL,NULL,NULL,NULL,20,NULL,'2016-08-16 12:34:12','2016-08-16 12:34:12'),(109,'2016-08-01','2016-08-01 15:00:00',NULL,NULL,NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','0.00',NULL,NULL,20,101,1,0,0,0,1,0,NULL,NULL,NULL,NULL,20,NULL,'2016-08-16 12:35:00','2016-08-16 12:35:00'),(110,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','1231.00',2.1,'dsfgsdfg',20,101,0,0,4,1,0,0,NULL,'2016-08-16',NULL,NULL,20,NULL,'2016-08-16 12:39:07','2016-08-16 12:39:07'),(111,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','1231.00',2.1,'dsfgsdfg',20,101,0,0,4,1,0,0,NULL,'2016-08-16',NULL,NULL,20,NULL,'2016-08-16 12:39:22','2016-08-16 12:39:22'),(112,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','1231.00',2.1,'dsfgsdfg',20,101,0,0,4,1,0,0,NULL,'2016-08-16',NULL,NULL,20,NULL,'2016-08-16 12:42:23','2016-08-16 12:42:23'),(113,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','1231.00',2.1,'dsfgsdfg',20,101,0,0,4,1,0,0,NULL,'2016-08-16',NULL,NULL,20,NULL,'2016-08-16 12:42:49','2016-08-16 12:42:49'),(114,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','1231.00',2.1,'dsfgsdfg',20,101,0,0,4,1,0,0,NULL,'2016-08-16',NULL,NULL,20,NULL,'2016-08-16 12:43:57','2016-08-16 12:43:57'),(115,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','1231.00',2.1,'dsfgsdfg',20,101,0,0,4,1,0,0,NULL,'2016-08-16',NULL,NULL,20,NULL,'2016-08-16 12:44:36','2016-08-16 12:44:36'),(116,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','1231.00',2.1,'dsfgsdfg',20,101,0,0,4,1,0,0,NULL,'2016-08-16',NULL,NULL,20,NULL,'2016-08-16 12:44:56','2016-08-16 12:44:56'),(117,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','1231.00',2.1,'dsfgsdfg',20,101,0,0,4,1,0,0,NULL,'2016-08-16',NULL,NULL,20,NULL,'2016-08-16 12:46:42','2016-08-16 12:46:42'),(118,NULL,NULL,'2016-07-29','2016-07-29 15:00:00',NULL,1,NULL,3,4,5,5,'kfgh',12,'kldfg','jhkj','0.00','0.00','1231.00',2.1,'dsfgsdfg',20,101,0,0,4,1,0,0,NULL,'2016-08-16',NULL,NULL,20,NULL,'2016-08-16 12:47:20','2016-08-16 12:47:20'),(119,'2016-08-26','2016-08-26 15:15:00',NULL,NULL,NULL,3,NULL,3,4,0,4,'123131',12,'','','0.00','0.00','0.00',NULL,NULL,20,101,1,0,0,0,0,0,NULL,NULL,NULL,NULL,20,NULL,'2016-08-16 15:32:35','2016-08-16 15:32:35'),(120,'2016-08-26','2016-08-26 15:30:00',NULL,NULL,NULL,3,NULL,3,44,0,44,'aedasda',11,'','','0.00','0.00','0.00',NULL,NULL,20,101,1,0,1,1,0,0,NULL,'2016-08-16',NULL,NULL,20,20,'2016-08-16 15:34:11','2016-08-16 15:34:14'),(121,NULL,NULL,'2016-08-28','2016-08-28 16:45:00','16:45:00',3,NULL,3,4,0,4,'ewrfsf',0,'sdfsfd','qweqwe','0.00','0.00','11.00',1.9,'ewwedewew',20,101,0,0,4,1,0,0,NULL,'2016-08-16',NULL,NULL,20,NULL,'2016-08-16 16:57:04','2016-08-16 16:57:04'),(122,'1970-01-01','1970-01-01 00:00:00',NULL,NULL,NULL,1,NULL,3,4,8,8,'werwe',21,'23','dfg','0.00','0.00','0.00',NULL,NULL,20,101,1,0,0,1,1,12,NULL,'2016-08-16',NULL,NULL,20,NULL,'2016-08-16 19:09:03','2016-08-16 19:09:03'),(123,'2016-08-20','2016-08-20 12:12:00',NULL,NULL,NULL,1,NULL,3,4,8,8,'werwe',21,'23','dfg','0.00','0.00','0.00',NULL,NULL,20,101,1,0,0,1,1,12,NULL,'2016-08-16',NULL,NULL,20,NULL,'2016-08-16 19:15:49','2016-08-16 19:15:49');

/*Table structure for table `bf_ecp_activity_planning_attendees_details` */

CREATE TABLE `bf_ecp_activity_planning_attendees_details` (
  `attendees_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_planning_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`attendees_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_activity_planning_attendees_details` */

insert  into `bf_ecp_activity_planning_attendees_details`(`attendees_details_id`,`activity_planning_id`,`customer_name`,`mobile_no`,`contact_no`) values (1,17,'sdasdkl','123132',NULL),(2,22,'dsfs','987',NULL),(3,30,'sdfdfsdfs','654654654654',NULL),(4,30,'sdfsdfsdf','65464654',NULL),(5,31,'sdfdfsdfs','654654654654',NULL),(6,31,'sdfsdfsdf','65464654',NULL),(7,32,'sdfdfsdfs','654654654654',NULL),(8,32,'sdfsdfsdf','65464654',NULL),(9,38,'werqw','1231',NULL),(10,36,'','',NULL),(11,36,'','',NULL),(12,40,'qweqe','123123',NULL),(13,42,'hjjhhj','787878',NULL),(14,43,'hjjhhj','787878',NULL),(15,44,'hjjhhj','787878',NULL),(16,45,'hjjhhj','787878',NULL),(17,46,'hjjhhj','787878',NULL),(18,47,'hjjhhj','787878',NULL),(19,48,'hjjhhj','787878',NULL),(20,49,'hjjhhj','787878',NULL),(21,50,'hjjhhj','787878',NULL),(22,51,'hjjhhj','787878',NULL),(23,52,'hjjhhj','787878',NULL),(24,53,'hjjhhj','787878',NULL),(25,54,'hjjhhj','787878',NULL),(26,55,'hjjhhj','787878',NULL),(27,56,'hjjhhj','787878',NULL),(28,57,'hjjhhj','787878',NULL),(29,58,'hjjhhj','787878',NULL),(30,59,'hjjhhj','787878',NULL),(31,60,'hjjhhj','787878',NULL),(32,61,'hjjhhj','787878',NULL),(33,62,'werwer','12312313123',NULL),(34,63,'werwer','12312313123',NULL),(35,64,'werwer','12312313123',NULL),(36,65,'werwer','12312313123',NULL),(37,66,'werwer','12312313123',NULL),(38,67,'werwer','12312313123',NULL),(39,68,'werwer','12312313123',NULL),(40,69,'werwer','12312313123',NULL),(41,70,'werwer','12312313123',NULL),(42,71,'werwer','12312313123',NULL),(43,72,'','',NULL),(44,72,'','',NULL),(45,53,'1231','1231',NULL),(46,88,'dfgdsfgdfg','1221212',NULL),(47,91,'123121','123123121',NULL),(48,92,'1231','1231',NULL),(49,21,'123123','asdad',NULL),(50,21,'1231','asda',NULL),(51,52,'qweq','1231',NULL),(52,54,'test','1233',NULL),(53,112,'sdfdfsdfs','654654654654',NULL),(54,112,'sdfsdfsdf','65464654',NULL),(55,113,'sdfdfsdfs','654654654654',NULL),(56,113,'sdfsdfsdf','65464654',NULL),(57,117,'sdfdfsdfs','654654654654',NULL),(58,117,'sdfsdfsdf','65464654',NULL),(59,118,'sdfdfsdfs','654654654654',NULL),(60,118,'sdfsdfsdf','65464654',NULL),(61,121,'sasdadas','12312313',NULL);

/*Table structure for table `bf_ecp_activity_planning_crop_details` */

CREATE TABLE `bf_ecp_activity_planning_crop_details` (
  `activity_planning_crop_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_planning_id` int(11) DEFAULT NULL,
  `crop_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`activity_planning_crop_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=225 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_activity_planning_crop_details` */

insert  into `bf_ecp_activity_planning_crop_details`(`activity_planning_crop_details_id`,`activity_planning_id`,`crop_id`) values (1,1,1),(2,1,3),(3,2,2),(4,2,3),(5,3,3),(6,4,3),(8,6,3),(9,7,3),(13,11,7),(14,12,6),(15,13,3),(16,14,5),(17,15,5),(18,16,1),(19,16,2),(20,17,5),(21,18,3),(22,19,1),(23,19,2),(24,20,1),(25,20,2),(27,22,5),(28,29,1),(29,29,2),(30,30,1),(31,30,2),(32,31,1),(33,31,2),(34,32,1),(35,32,2),(36,33,1),(37,33,2),(38,34,1),(39,34,2),(54,4,6),(55,5,1),(56,5,2),(81,10,3),(82,10,2),(83,10,13),(84,10,2),(85,10,13),(86,10,2),(87,10,13),(88,10,2),(89,10,13),(90,10,2),(91,10,13),(98,21,1),(99,21,5),(100,9,1),(101,9,3),(102,37,1),(103,38,1),(104,39,1),(105,36,1),(106,36,2),(107,40,1),(109,41,2),(112,35,1),(113,42,1),(114,43,1),(115,44,1),(116,45,1),(117,46,1),(118,47,1),(119,48,1),(120,49,1),(121,50,1),(122,51,1),(123,52,1),(124,53,1),(125,54,1),(126,55,1),(127,56,1),(128,57,1),(129,58,1),(130,59,1),(131,60,1),(132,61,1),(133,62,2),(134,63,2),(135,64,2),(136,65,2),(137,66,2),(138,67,2),(139,68,2),(140,69,2),(141,70,2),(142,71,2),(143,75,1),(144,76,1),(145,77,1),(146,78,1),(147,79,1),(148,80,1),(149,81,1),(150,82,1),(151,83,1),(152,84,1),(153,85,1),(154,86,1),(156,87,1),(157,88,2),(158,89,3),(159,89,2),(169,90,1),(170,90,5),(171,91,1),(172,92,3),(173,93,1),(174,93,5),(175,94,2),(176,8,0),(177,96,1),(178,97,2),(179,99,1),(180,99,2),(181,100,1),(182,100,2),(183,101,1),(184,101,2),(185,102,1),(186,102,2),(187,103,1),(188,103,2),(189,104,1),(190,104,2),(191,105,1),(192,105,2),(193,106,1),(194,106,2),(195,107,1),(196,107,2),(197,108,1),(198,108,2),(199,109,1),(200,109,2),(201,110,1),(202,110,2),(203,111,1),(204,111,2),(205,112,1),(206,112,2),(207,113,1),(208,113,2),(209,114,1),(210,114,2),(211,115,1),(212,115,2),(213,116,1),(214,116,2),(215,117,1),(216,117,2),(217,118,1),(218,118,2),(219,119,2),(220,120,2),(221,120,3),(222,121,1),(223,122,6),(224,123,6);

/*Table structure for table `bf_ecp_activity_planning_digital_library_details` */

CREATE TABLE `bf_ecp_activity_planning_digital_library_details` (
  `digital_library_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_planning_id` int(11) DEFAULT NULL,
  `digital_library_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`digital_library_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_activity_planning_digital_library_details` */

insert  into `bf_ecp_activity_planning_digital_library_details`(`digital_library_details_id`,`activity_planning_id`,`digital_library_id`) values (1,1,1),(2,1,7),(3,2,1),(4,2,7),(5,3,1),(6,3,7),(7,4,1),(8,4,7),(11,6,1),(12,6,7),(13,7,1),(14,7,7),(15,8,1),(16,11,1),(17,12,1),(18,13,1),(19,14,1),(20,15,1),(21,16,1),(22,17,1),(23,18,1),(24,18,7),(25,19,1),(26,20,1),(28,22,2),(29,29,1),(30,29,2),(31,30,1),(32,30,2),(33,31,1),(34,31,2),(35,32,1),(36,32,2),(39,34,1),(40,34,2),(46,5,1),(47,33,1),(51,35,1),(52,35,7),(53,36,1),(54,21,2),(55,37,1),(56,37,7),(57,38,1),(58,38,7),(59,39,1),(60,40,1),(62,41,9),(63,42,1),(64,42,7),(65,43,1),(66,43,7),(67,44,1),(68,44,7),(69,45,1),(70,45,7),(71,46,1),(72,46,7),(73,47,1),(74,47,7),(75,48,1),(76,48,7),(77,49,1),(78,49,7),(79,50,1),(80,50,7),(81,51,1),(82,51,7),(83,52,1),(84,52,7),(85,53,1),(86,53,7),(87,54,1),(88,54,7),(89,55,1),(90,55,7),(91,56,1),(92,56,7),(93,57,1),(94,57,7),(95,58,1),(96,58,7),(97,59,1),(98,59,7),(99,60,1),(100,60,7),(101,61,1),(102,61,7),(103,62,1),(104,63,1),(105,64,1),(106,65,1),(107,66,1),(108,67,1),(109,68,1),(110,69,1),(111,70,1),(112,71,1),(114,87,5),(115,88,11),(116,90,0),(117,91,1),(118,92,2),(119,93,0),(120,95,0),(121,96,0),(122,96,0),(123,107,1),(124,107,2),(125,108,1),(126,108,2),(127,109,1),(128,109,2),(129,112,1),(130,112,2),(131,113,1),(132,113,2),(133,117,1),(134,117,2),(135,118,1),(136,118,2),(137,121,3),(138,122,0),(139,123,0);

/*Table structure for table `bf_ecp_activity_planning_diseases_details` */

CREATE TABLE `bf_ecp_activity_planning_diseases_details` (
  `activity_planning_diseases_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_planning_id` int(11) DEFAULT NULL,
  `diseases_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`activity_planning_diseases_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_activity_planning_diseases_details` */

insert  into `bf_ecp_activity_planning_diseases_details`(`activity_planning_diseases_details_id`,`activity_planning_id`,`diseases_id`) values (1,1,2),(2,1,3),(3,2,5),(4,3,5),(5,3,11),(6,4,7),(8,6,14),(9,7,14),(10,8,14),(12,10,13),(13,11,14),(14,12,12),(15,13,17),(16,14,15),(17,15,15),(18,16,1),(19,16,2),(20,17,13),(21,18,11),(22,19,1),(23,19,2),(24,20,1),(25,20,2),(27,22,13),(28,29,1),(29,29,2),(30,30,1),(31,30,2),(32,31,1),(33,31,2),(34,32,1),(35,32,2),(36,33,1),(37,33,2),(38,34,1),(39,34,2),(50,5,1),(51,5,2),(59,21,13),(60,9,13),(61,37,1),(62,38,1),(63,39,1),(64,36,2),(65,36,3),(66,40,2),(68,41,2),(73,35,2),(74,35,3),(75,42,2),(76,43,2),(77,44,2),(78,45,2),(79,46,2),(80,47,2),(81,48,2),(82,49,2),(83,50,2),(84,51,2),(85,52,2),(86,53,2),(87,54,2),(88,55,2),(89,56,2),(90,57,2),(91,58,2),(92,59,2),(93,60,2),(94,61,2),(95,62,2),(96,63,2),(97,64,2),(98,65,2),(99,66,2),(100,67,2),(101,68,2),(102,69,2),(103,70,2),(104,71,2),(105,75,2),(106,76,2),(107,77,2),(108,78,2),(109,79,2),(110,80,2),(111,81,2),(112,82,2),(113,83,2),(114,84,2),(115,85,2),(116,86,2),(118,87,2),(119,88,3),(120,89,13),(121,90,13),(122,91,2),(123,92,2),(124,93,13),(125,94,3),(126,95,14),(127,96,2),(128,97,3),(129,99,1),(130,99,2),(131,100,1),(132,100,2),(133,101,1),(134,101,2),(135,102,1),(136,102,2),(137,103,1),(138,103,2),(139,104,1),(140,104,2),(141,105,1),(142,105,2),(143,106,1),(144,106,2),(145,107,1),(146,107,2),(147,108,1),(148,108,2),(149,109,1),(150,109,2),(151,110,1),(152,110,2),(153,111,1),(154,111,2),(155,112,1),(156,112,2),(157,113,1),(158,113,2),(159,114,1),(160,114,2),(161,115,1),(162,115,2),(163,116,1),(164,116,2),(165,117,1),(166,117,2),(167,118,1),(168,118,2),(169,119,3),(170,120,2),(171,121,2),(172,122,12),(173,123,12);

/*Table structure for table `bf_ecp_activity_planning_joint_visit_details` */

CREATE TABLE `bf_ecp_activity_planning_joint_visit_details` (
  `joint_visit_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_planning_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`joint_visit_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_activity_planning_joint_visit_details` */

insert  into `bf_ecp_activity_planning_joint_visit_details`(`joint_visit_details_id`,`activity_planning_id`,`employee_id`) values (1,1,47),(2,1,46),(3,2,47),(4,2,46),(5,3,47),(6,3,46),(7,4,47),(8,4,46),(11,6,47),(12,6,46),(13,7,47),(14,7,46),(15,8,47),(18,11,46),(19,12,47),(20,13,47),(21,14,47),(22,15,47),(23,16,47),(24,17,47),(25,18,47),(26,18,46),(27,19,47),(28,20,47),(30,22,46),(31,29,47),(32,30,47),(33,31,47),(34,32,47),(36,34,47),(42,5,47),(44,33,47),(46,10,46),(56,21,46),(57,9,47),(58,37,47),(59,37,46),(60,38,47),(61,38,46),(62,39,46),(63,36,46),(64,40,45),(66,41,46),(69,35,46),(70,42,46),(71,43,46),(72,44,46),(73,45,46),(74,46,46),(75,47,46),(76,48,46),(77,49,46),(78,50,46),(79,51,46),(80,52,46),(81,53,46),(82,54,46),(83,55,46),(84,56,46),(85,57,46),(86,58,46),(87,59,46),(88,60,46),(89,61,46),(90,62,47),(91,63,47),(92,64,47),(93,65,47),(94,66,47),(95,67,47),(96,68,47),(97,69,47),(98,70,47),(99,71,47),(101,87,46),(102,88,47),(103,89,46),(104,90,46),(105,91,46),(106,92,47),(107,93,46),(108,95,47),(109,96,46),(110,107,47),(111,108,47),(112,109,47),(113,112,47),(114,113,47),(115,117,47),(116,118,47),(117,121,47),(118,122,47),(119,123,47);

/*Table structure for table `bf_ecp_activity_planning_key_customer_details` */

CREATE TABLE `bf_ecp_activity_planning_key_customer_details` (
  `key_customer_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_planning_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`key_customer_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_activity_planning_key_customer_details` */

insert  into `bf_ecp_activity_planning_key_customer_details`(`key_customer_details_id`,`activity_planning_id`,`customer_id`,`mobile_no`) values (1,1,4,'123456789'),(2,2,4,'123456789'),(3,3,4,'123456789'),(4,4,4,'123456789'),(5,4,5,'32233'),(8,6,4,'123456789'),(9,6,5,'1231231'),(10,1,4,'123456789'),(11,1,5,'2342'),(12,2,4,'123456789'),(13,3,4,'123456789'),(14,4,4,'123456789'),(16,6,4,'123456789'),(17,7,4,'123456789'),(18,8,4,'123456789'),(21,11,4,'123456789'),(22,12,5,'qweq'),(23,13,4,'123456789'),(24,14,4,'123456789'),(25,15,4,'123456789'),(26,16,4,'123456789'),(27,16,5,'123456789'),(28,17,4,'123456789'),(29,18,4,'123456789'),(30,19,4,'123456789'),(31,19,5,'123456789'),(32,20,4,'123456789'),(33,20,5,'123456789'),(35,22,5,'79897'),(36,29,4,'123456789'),(37,29,5,'123456789'),(38,30,4,'123456789'),(39,30,5,'123456789'),(40,31,4,'123456789'),(41,31,5,'123456789'),(42,32,4,'123456789'),(43,32,5,'123456789'),(46,34,4,'123456789'),(47,34,5,'123456789'),(58,5,4,'123456789'),(59,5,5,'123456789'),(65,33,4,'123456789'),(66,33,5,'123456789'),(68,10,4,'123456789'),(74,21,5,'79897'),(75,9,4,'123456789'),(76,37,4,'123456789'),(77,38,4,'123456789'),(78,39,5,'123'),(79,36,4,'123456789'),(80,40,5,'123131'),(82,41,15,'1231231'),(85,35,4,'123456789'),(86,42,4,'123456789'),(87,43,4,'123456789'),(88,44,4,'123456789'),(89,45,4,'123456789'),(90,46,4,'123456789'),(91,47,4,'123456789'),(92,48,4,'123456789'),(93,49,4,'123456789'),(94,50,4,'123456789'),(95,51,4,'123456789'),(96,52,4,'123456789'),(97,53,4,'123456789'),(98,54,4,'123456789'),(99,55,4,'123456789'),(100,56,4,'123456789'),(101,57,4,'123456789'),(102,58,4,'123456789'),(103,59,4,'123456789'),(104,60,4,'123456789'),(105,61,4,'123456789'),(106,62,4,'123456789'),(107,63,4,'123456789'),(108,64,4,'123456789'),(109,65,4,'123456789'),(110,66,4,'123456789'),(111,67,4,'123456789'),(112,68,4,'123456789'),(113,69,4,'123456789'),(114,70,4,'123456789'),(115,71,4,'123456789'),(117,87,5,'12121212121'),(118,88,5,'12'),(119,89,4,'123456789'),(120,90,5,'79897'),(121,91,5,'12311231'),(122,92,4,'123456789'),(123,93,5,'79897'),(124,95,4,'123456789'),(125,96,4,'123456789'),(126,107,4,'123456789'),(127,107,5,'123456789'),(128,108,0,''),(129,109,0,''),(130,119,15,'111111111'),(131,120,15,'1231231'),(132,121,14,'12312312'),(133,122,5,'qweq'),(134,123,5,'qweq');

/*Table structure for table `bf_ecp_activity_planning_product_details` */

CREATE TABLE `bf_ecp_activity_planning_product_details` (
  `activity_planning_product_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_planning_id` int(11) DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`activity_planning_product_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_activity_planning_product_details` */

insert  into `bf_ecp_activity_planning_product_details`(`activity_planning_product_details_id`,`activity_planning_id`,`product_sku_id`) values (1,1,1),(2,1,2),(3,2,1),(4,3,2),(5,4,2),(7,6,3),(8,7,2),(11,10,2),(12,11,2),(13,12,3),(14,13,2),(15,14,1),(16,15,1),(17,16,1),(18,16,2),(19,17,1),(20,18,2),(21,19,1),(22,19,2),(23,20,1),(24,20,2),(26,22,2),(27,29,1),(28,29,2),(29,30,1),(30,30,2),(31,31,1),(32,31,2),(33,32,1),(34,32,2),(35,33,1),(36,33,2),(37,34,1),(38,34,2),(49,5,1),(50,5,2),(58,21,2),(59,9,2),(60,37,2),(61,38,2),(62,39,2),(63,36,1),(64,36,2),(65,40,2),(67,41,2),(72,35,1),(73,35,2),(74,42,1),(75,43,1),(76,44,1),(77,45,1),(78,46,1),(79,47,1),(80,48,1),(81,49,1),(82,50,1),(83,51,1),(84,52,1),(85,53,1),(86,54,1),(87,55,1),(88,56,1),(89,57,1),(90,58,1),(91,59,1),(92,60,1),(93,61,1),(94,62,2),(95,63,2),(96,64,2),(97,65,2),(98,66,2),(99,67,2),(100,68,2),(101,69,2),(102,70,2),(103,71,2),(104,75,1),(105,76,1),(106,77,1),(107,78,1),(108,79,1),(109,80,1),(110,81,1),(111,82,1),(112,83,1),(113,84,1),(114,85,1),(115,86,1),(117,87,1),(118,88,2),(119,89,2),(120,90,2),(121,91,1),(122,92,2),(123,93,2),(124,94,2),(125,96,1),(126,97,2),(127,99,1),(128,99,2),(129,100,1),(130,100,2),(131,101,1),(132,101,2),(133,102,1),(134,102,2),(135,103,1),(136,103,2),(137,104,1),(138,104,2),(139,105,1),(140,105,2),(141,106,1),(142,106,2),(143,107,1),(144,107,2),(145,108,1),(146,108,2),(147,109,1),(148,109,2),(149,110,1),(150,110,2),(151,111,1),(152,111,2),(153,112,1),(154,112,2),(155,113,1),(156,113,2),(157,114,1),(158,114,2),(159,115,1),(160,115,2),(161,116,1),(162,116,2),(163,117,1),(164,117,2),(165,118,1),(166,118,2),(167,119,2),(168,120,2),(169,121,2),(170,122,3),(171,123,3);

/*Table structure for table `bf_ecp_activity_planning_promo_sample_details` */

CREATE TABLE `bf_ecp_activity_planning_promo_sample_details` (
  `promo_sample_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_planning_id` int(11) DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `quantity` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`promo_sample_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_activity_planning_promo_sample_details` */

insert  into `bf_ecp_activity_planning_promo_sample_details`(`promo_sample_details_id`,`activity_planning_id`,`product_sku_id`,`quantity`) values (1,1,1,'123.00'),(2,1,2,'11.00'),(3,2,1,'1231.00'),(4,3,1,'1231.00'),(5,4,2,'123.00'),(7,6,1,'1231.00'),(8,7,1,'12.00'),(9,8,2,'12.00'),(10,11,1,'12.00'),(11,12,1,'12.00'),(12,14,2,'12.00'),(13,15,2,'12.00'),(14,16,1,'11.00'),(15,16,2,'22.00'),(16,17,2,'1231.00'),(17,18,1,'1231.00'),(18,19,1,'11.00'),(19,19,2,'22.00'),(20,20,1,'11.00'),(21,20,2,'22.00'),(22,22,2,'987.00'),(23,29,1,'77.00'),(24,29,2,'7.00'),(25,30,1,'77.00'),(26,30,2,'7.00'),(27,31,1,'77.00'),(28,31,2,'7.00'),(29,32,1,'77.00'),(30,32,2,'7.00'),(33,34,1,'77.00'),(34,34,2,'7.00'),(45,5,1,'11.00'),(46,5,2,'22.00'),(50,33,1,'77.00'),(51,33,2,'7.00'),(52,10,1,'12.00'),(57,37,2,'1231.00'),(58,38,2,'1231.00'),(59,39,1,'1231.00'),(60,36,1,'12321.00'),(61,40,1,'23.00'),(63,41,1,'1231.00'),(66,35,1,'123131.00'),(67,42,1,'76.00'),(68,43,1,'76.00'),(69,44,1,'76.00'),(70,45,1,'76.00'),(71,46,1,'76.00'),(72,47,1,'76.00'),(73,48,1,'76.00'),(74,49,1,'76.00'),(75,50,1,'76.00'),(76,51,1,'76.00'),(77,52,1,'76.00'),(78,53,1,'76.00'),(79,54,1,'76.00'),(80,55,1,'76.00'),(81,56,1,'76.00'),(82,57,1,'76.00'),(83,58,1,'76.00'),(84,59,1,'76.00'),(85,60,1,'76.00'),(86,61,1,'76.00'),(87,62,1,'12.00'),(88,63,1,'12.00'),(89,64,1,'12.00'),(90,65,1,'12.00'),(91,66,1,'12.00'),(92,67,1,'12.00'),(93,68,1,'12.00'),(94,69,1,'12.00'),(95,70,1,'12.00'),(96,71,1,'12.00'),(98,87,1,'1231.00'),(99,88,2,'12.00'),(100,89,1,'12.00'),(101,91,1,'12.00'),(102,92,1,'121.00'),(103,95,2,'12.00'),(104,96,1,'76.00'),(105,107,1,'77.00'),(106,107,2,'7.00'),(107,108,1,'77.00'),(108,108,2,'7.00'),(109,109,1,'77.00'),(110,109,2,'7.00'),(111,112,1,'77.00'),(112,112,2,'7.00'),(113,113,1,'77.00'),(114,113,2,'7.00'),(115,117,1,'77.00'),(116,117,2,'7.00'),(117,118,1,'77.00'),(118,118,2,'7.00'),(119,121,1,'1231.00'),(120,122,1,'12.00'),(121,123,1,'12.00');

/*Table structure for table `bf_ecp_activity_planning_required_material_details` */

CREATE TABLE `bf_ecp_activity_planning_required_material_details` (
  `required_material_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_planning_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `quantity` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`required_material_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_activity_planning_required_material_details` */

insert  into `bf_ecp_activity_planning_required_material_details`(`required_material_details_id`,`activity_planning_id`,`material_id`,`quantity`) values (1,1,1,'12.00'),(2,1,2,'32.00'),(3,2,2,'12.00'),(4,3,2,'122.00'),(5,4,1,'1231.00'),(7,6,2,'1231.00'),(8,7,1,'12.00'),(9,8,2,'12.00'),(10,11,1,'12.00'),(11,12,2,'123.00'),(12,14,1,'123.00'),(13,15,1,'123.00'),(14,16,1,'11.00'),(15,16,2,'22.00'),(16,17,2,'1231.00'),(17,18,1,'12.00'),(18,19,1,'11.00'),(19,19,2,'22.00'),(20,20,1,'11.00'),(21,20,2,'22.00'),(23,22,2,'97.00'),(24,29,1,'4.00'),(25,29,2,'4.00'),(26,30,1,'4.00'),(27,30,2,'4.00'),(28,31,1,'4.00'),(29,31,2,'4.00'),(30,32,1,'4.00'),(31,32,2,'4.00'),(34,34,1,'4.00'),(35,34,2,'4.00'),(46,5,1,'11.00'),(47,5,2,'22.00'),(51,33,1,'4.00'),(52,33,2,'4.00'),(53,10,1,'1231.00'),(59,21,2,'97.00'),(60,37,1,'123.00'),(61,38,1,'123.00'),(62,39,2,'11.00'),(63,36,1,'1231.00'),(65,41,1,'12313.00'),(68,35,1,'12312.00'),(69,42,1,'78.00'),(70,43,1,'78.00'),(71,44,1,'78.00'),(72,45,1,'78.00'),(73,46,1,'78.00'),(74,47,1,'78.00'),(75,48,1,'78.00'),(76,49,1,'78.00'),(77,50,1,'78.00'),(78,51,1,'78.00'),(79,52,1,'78.00'),(80,53,1,'78.00'),(81,54,1,'78.00'),(82,55,1,'78.00'),(83,56,1,'78.00'),(84,57,1,'78.00'),(85,58,1,'78.00'),(86,59,1,'78.00'),(87,60,1,'78.00'),(88,61,1,'78.00'),(89,62,1,'11.00'),(90,63,1,'11.00'),(91,64,1,'11.00'),(92,65,1,'11.00'),(93,66,1,'11.00'),(94,67,1,'11.00'),(95,68,1,'11.00'),(96,69,1,'11.00'),(97,70,1,'11.00'),(98,71,1,'11.00'),(100,87,2,'1231.00'),(101,88,1,'12.00'),(102,89,1,'1231.00'),(103,90,2,'97.00'),(104,91,2,'1231.00'),(105,92,2,'12.00'),(106,93,2,'97.00'),(107,95,2,'12.00'),(108,96,1,'78.00'),(109,107,1,'4.00'),(110,107,2,'4.00'),(111,108,1,'4.00'),(112,108,2,'4.00'),(113,109,1,'4.00'),(114,109,2,'4.00'),(115,112,1,'4.00'),(116,112,2,'4.00'),(117,113,1,'4.00'),(118,113,2,'4.00'),(119,117,1,'4.00'),(120,117,2,'4.00'),(121,118,1,'4.00'),(122,118,2,'4.00'),(123,121,1,'11.00'),(124,122,2,'123.00'),(125,123,2,'123.00');

/*Table structure for table `bf_ecp_activity_planning_required_product_details` */

CREATE TABLE `bf_ecp_activity_planning_required_product_details` (
  `required_product_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_planning_id` int(11) DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `quantity` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`required_product_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_activity_planning_required_product_details` */

insert  into `bf_ecp_activity_planning_required_product_details`(`required_product_details_id`,`activity_planning_id`,`product_sku_id`,`quantity`) values (1,1,1,'12.00'),(2,1,2,'23.00'),(3,2,1,'12.00'),(4,3,1,'11.00'),(5,4,1,'12.00'),(7,6,1,'1231.00'),(8,7,1,'12.00'),(9,8,1,'123.00'),(10,11,1,'12.00'),(11,12,1,'12.00'),(12,14,1,'123.00'),(13,15,1,'123.00'),(14,16,1,'11.00'),(15,16,2,'22.00'),(16,17,1,'1231.00'),(17,18,1,'1231.00'),(18,19,1,'11.00'),(19,19,2,'22.00'),(20,20,1,'11.00'),(21,20,2,'22.00'),(23,22,2,'978.00'),(24,29,1,'4.00'),(25,29,2,'4.00'),(26,30,1,'4.00'),(27,30,2,'4.00'),(28,31,1,'4.00'),(29,31,2,'4.00'),(30,32,1,'4.00'),(31,32,2,'4.00'),(34,34,1,'4.00'),(35,34,2,'4.00'),(46,5,1,'11.00'),(47,5,2,'22.00'),(51,33,1,'4.00'),(52,33,2,'4.00'),(53,10,1,'122.00'),(59,21,2,'978.00'),(60,37,1,'1231.00'),(61,38,1,'1231.00'),(62,39,1,'1231.00'),(63,36,1,'1231.00'),(65,41,1,'1231.00'),(68,35,1,'1231.00'),(69,42,1,'67.00'),(70,43,1,'67.00'),(71,44,1,'67.00'),(72,45,1,'67.00'),(73,46,1,'67.00'),(74,47,1,'67.00'),(75,48,1,'67.00'),(76,49,1,'67.00'),(77,50,1,'67.00'),(78,51,1,'67.00'),(79,52,1,'67.00'),(80,53,1,'67.00'),(81,54,1,'67.00'),(82,55,1,'67.00'),(83,56,1,'67.00'),(84,57,1,'67.00'),(85,58,1,'67.00'),(86,59,1,'67.00'),(87,60,1,'67.00'),(88,61,1,'67.00'),(89,62,1,'12.00'),(90,63,1,'12.00'),(91,64,1,'12.00'),(92,65,1,'12.00'),(93,66,1,'12.00'),(94,67,1,'12.00'),(95,68,1,'12.00'),(96,69,1,'12.00'),(97,70,1,'12.00'),(98,71,1,'12.00'),(100,87,2,'1231.00'),(101,88,1,'12.00'),(102,89,1,'122.00'),(103,90,2,'978.00'),(104,91,2,'121.00'),(105,93,2,'978.00'),(106,95,1,'123.00'),(107,96,1,'67.00'),(108,107,1,'4.00'),(109,107,2,'4.00'),(110,108,1,'4.00'),(111,108,2,'4.00'),(112,109,1,'4.00'),(113,109,2,'4.00'),(114,112,1,'4.00'),(115,112,2,'4.00'),(116,113,1,'4.00'),(117,113,2,'4.00'),(118,117,1,'4.00'),(119,117,2,'4.00'),(120,118,1,'4.00'),(121,118,2,'4.00'),(122,121,1,'1231.00'),(123,122,1,'12.00'),(124,123,1,'12.00');

/*Table structure for table `bf_ecp_activity_planning_upload_details` */

CREATE TABLE `bf_ecp_activity_planning_upload_details` (
  `upload_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_planning_id` int(11) NOT NULL,
  `files_name` varchar(255) NOT NULL,
  `upload_type` varchar(255) NOT NULL,
  PRIMARY KEY (`upload_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_activity_planning_upload_details` */

insert  into `bf_ecp_activity_planning_upload_details`(`upload_details_id`,`activity_planning_id`,`files_name`,`upload_type`) values (1,84,'C','i'),(2,84,'e','m'),(3,84,'d','a'),(4,86,'Chrysanthemum10.jpg','image'),(5,86,'Desert9.jpg','image'),(6,86,'Hydrangeas9.jpg','image'),(7,88,'Penguins.jpg','image'),(8,88,'Tulips.jpg','image'),(9,91,'',''),(10,92,'',''),(11,20,'Hydrangeas.jpg','image'),(12,20,'Jellyfish.jpg','image'),(13,20,'',''),(14,20,'test1.mp4','video'),(15,94,'',''),(16,97,'',''),(17,52,'Chrysanthemum.jpg','image'),(18,52,'Desert.jpg','image'),(19,54,'Desert1.jpg','image'),(20,54,'Hydrangeas1.jpg','image'),(21,54,'Jellyfish1.jpg','image'),(22,121,'Desert2.jpg','image');

/*Table structure for table `bf_ecp_activity_type_master_regional` */

CREATE TABLE `bf_ecp_activity_type_master_regional` (
  `activity_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_type_name` varchar(255) DEFAULT NULL,
  `activity_type_code` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`activity_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_activity_type_master_regional` */

insert  into `bf_ecp_activity_type_master_regional`(`activity_type_id`,`activity_type_name`,`activity_type_code`,`deleted`,`status`,`created_by_user`,`modified_by_user`,`created_on`,`modified_on`) values (1,'Farmer Meeting Planning','FMP001',0,1,NULL,NULL,NULL,NULL),(2,'Farmer Visit Planning','FVP002',0,1,NULL,NULL,NULL,NULL),(3,'Retailer Meeting','RMP003',0,1,NULL,NULL,NULL,NULL),(4,'Retailer Visit Planning','RVP004',0,1,NULL,NULL,NULL,NULL),(5,'Demonstration Planning','DP005',0,1,NULL,NULL,NULL,NULL),(6,'Field Day Planning','FDP006',0,1,NULL,NULL,NULL,NULL);

/*Table structure for table `bf_ecp_compititor_analysis_product` */

CREATE TABLE `bf_ecp_compititor_analysis_product` (
  `compititor_analysis_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `compititor_analysis_month` date DEFAULT NULL,
  `coustomer_id` int(11) DEFAULT NULL,
  `compititor_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`compititor_analysis_product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_compititor_analysis_product` */

insert  into `bf_ecp_compititor_analysis_product`(`compititor_analysis_product_id`,`compititor_analysis_month`,`coustomer_id`,`compititor_id`,`country_id`,`status`,`created_by_user`,`modified_by_user`,`created_on`,`modified_on`) values (1,'2016-07-01',17,1,101,1,20,NULL,'2016-07-06 07:51:47',NULL),(2,'2016-07-01',36,1,101,1,20,NULL,'2016-07-06 08:26:30',NULL),(3,'2016-07-01',16,1,101,1,20,NULL,'2016-07-06 15:01:32',NULL),(4,'2016-07-01',10,1,101,1,20,NULL,'2016-07-06 15:02:32',NULL),(5,'2016-07-01',17,1,101,1,20,NULL,'2016-07-11 05:37:38',NULL),(6,'2016-07-01',17,3,101,1,20,NULL,'2016-07-11 11:07:57',NULL),(7,'2016-07-01',10,4,101,1,20,NULL,'2016-07-11 11:38:22',NULL),(8,'2016-07-01',10,4,101,1,20,NULL,'2016-07-11 11:38:45',NULL),(9,'2016-08-01',18,2,101,1,20,NULL,'2016-08-02 14:44:02',NULL),(10,'2016-08-01',11,1,101,1,20,NULL,'2016-08-02 14:47:51',NULL);

/*Table structure for table `bf_ecp_compititor_analysis_total` */

CREATE TABLE `bf_ecp_compititor_analysis_total` (
  `compititor_analysis_total_id` int(11) NOT NULL AUTO_INCREMENT,
  `compititor_analysis_month` date DEFAULT NULL,
  `coustomer_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`compititor_analysis_total_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_compititor_analysis_total` */

insert  into `bf_ecp_compititor_analysis_total`(`compititor_analysis_total_id`,`compititor_analysis_month`,`coustomer_id`,`country_id`,`status`,`created_by_user`,`modified_by_user`,`created_on`,`modified_on`) values (1,'2016-07-01',17,101,1,20,NULL,'2016-07-06 06:51:17',NULL),(2,'2016-07-01',11,101,1,20,NULL,'2016-07-06 08:08:39',NULL),(3,'2016-07-01',17,101,1,20,NULL,'2016-07-06 15:00:58',NULL),(4,'2016-07-01',36,101,1,20,NULL,'2016-07-06 15:01:56',NULL),(6,'2016-07-01',17,101,1,20,NULL,'2016-07-11 10:48:00',NULL),(7,'2016-07-01',9,101,1,20,NULL,'2016-07-11 11:31:19',NULL),(8,'2016-07-01',9,101,1,20,NULL,'2016-07-11 11:32:00',NULL),(9,'2016-07-01',9,101,1,20,NULL,'2016-07-11 11:33:26',NULL),(10,'2016-08-01',17,101,1,20,NULL,'2016-08-02 14:43:29',NULL),(11,'2016-08-01',11,101,1,20,NULL,'2016-08-02 14:45:06',NULL),(12,'2016-08-01',11,101,1,20,NULL,'2016-08-02 14:45:06',NULL),(13,'2016-08-01',11,101,1,20,NULL,'2016-08-02 14:46:57',NULL);

/*Table structure for table `bf_ecp_compititor_master` */

CREATE TABLE `bf_ecp_compititor_master` (
  `compititor_id` int(11) NOT NULL AUTO_INCREMENT,
  `compititor_name` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`compititor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_compititor_master` */

insert  into `bf_ecp_compititor_master`(`compititor_id`,`compititor_name`,`country_id`,`deleted`,`created_by_user`,`modified_by_user`,`status`,`created_on`,`modified_on`) values (1,'test1',101,0,45,NULL,1,NULL,NULL),(2,'test2',101,0,45,NULL,1,NULL,NULL),(3,'test3',101,0,45,NULL,1,NULL,NULL),(4,'test4',101,0,45,NULL,1,NULL,NULL),(5,'test5',101,0,45,NULL,1,NULL,NULL);

/*Table structure for table `bf_ecp_compititor_product_details` */

CREATE TABLE `bf_ecp_compititor_product_details` (
  `compititor_product_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `compititor_analysis_product_id` int(11) DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `compititor_product_name` varchar(255) DEFAULT NULL,
  `quantity` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`compititor_product_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_compititor_product_details` */

insert  into `bf_ecp_compititor_product_details`(`compititor_product_details_id`,`compititor_analysis_product_id`,`product_sku_id`,`compititor_product_name`,`quantity`) values (1,1,2,'qew','123.00'),(2,2,2,'dss','123.00'),(3,3,1,'xvcxs','3131.00'),(4,3,2,'qweq','1231.00'),(5,4,1,'rewe','343.00'),(6,4,2,'sdfs','3242.00'),(7,5,2,'qweq','232.00'),(8,6,1,'test11','111.00'),(9,6,2,'test22','23.00'),(10,6,3,'test33','34.00'),(11,8,1,'aa','100.00'),(12,8,2,'ss','23.00'),(13,8,3,'dd','34.00'),(14,9,2,'4412','121.00'),(15,10,2,'1412','21.00');

/*Table structure for table `bf_ecp_compititor_total_details` */

CREATE TABLE `bf_ecp_compititor_total_details` (
  `compititor_total_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `compititor_analysis_total_id` int(11) NOT NULL,
  `compititor_id` int(11) NOT NULL,
  `amount` decimal(9,2) NOT NULL,
  PRIMARY KEY (`compititor_total_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_compititor_total_details` */

insert  into `bf_ecp_compititor_total_details`(`compititor_total_details_id`,`compititor_analysis_total_id`,`compititor_id`,`amount`) values (1,1,1,'200.00'),(2,1,2,'12131.00'),(3,2,3,'1231.00'),(4,3,1,'1231.00'),(5,3,3,'1231.00'),(6,4,1,'1231.00'),(7,4,3,'65464.00'),(9,6,3,'30000.00'),(10,6,2,'6000.00'),(11,6,1,'11.00'),(12,9,2,'1000.00'),(13,9,3,'111.00'),(14,10,1,'45.00'),(15,11,1,'12.00'),(16,12,1,'12.00'),(17,13,1,'211.00');

/*Table structure for table `bf_ecp_digital_library_master` */

CREATE TABLE `bf_ecp_digital_library_master` (
  `digital_library_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_type_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `library_name` varchar(255) DEFAULT NULL,
  `link` text,
  `status` tinyint(1) DEFAULT '1',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`digital_library_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_digital_library_master` */

insert  into `bf_ecp_digital_library_master`(`digital_library_id`,`activity_type_id`,`country_id`,`library_name`,`link`,`status`,`created_by_user`,`modified_by_user`,`created_on`,`modified_on`) values (1,1,101,'video1',NULL,1,NULL,NULL,NULL,NULL),(2,2,101,'video2',NULL,1,NULL,NULL,NULL,NULL),(3,3,101,'video3',NULL,1,NULL,NULL,NULL,NULL),(4,4,101,'video4',NULL,1,NULL,NULL,NULL,NULL),(5,5,101,'video5',NULL,1,NULL,NULL,NULL,NULL),(6,6,101,'video6',NULL,1,NULL,NULL,NULL,NULL),(7,1,101,'image1',NULL,1,NULL,NULL,NULL,NULL),(8,2,101,'image2',NULL,1,NULL,NULL,NULL,NULL),(9,3,101,'image3',NULL,1,NULL,NULL,NULL,NULL),(10,4,101,'image4',NULL,1,NULL,NULL,NULL,NULL),(11,5,101,'image5',NULL,1,NULL,NULL,NULL,NULL),(12,6,101,'image6',NULL,1,NULL,NULL,NULL,NULL);

/*Table structure for table `bf_ecp_leave` */

CREATE TABLE `bf_ecp_leave` (
  `leave_id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_date` date DEFAULT NULL,
  `leave_type_country_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`leave_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_leave` */

insert  into `bf_ecp_leave`(`leave_id`,`leave_date`,`leave_type_country_id`,`employee_id`,`country_id`,`status`,`created_by_user`,`modified_by_user`,`created_on`,`modified_on`) values (2,'2016-07-05',1,20,101,1,20,NULL,'2016-07-08 07:39:43',NULL),(3,'2016-07-11',2,20,101,1,20,NULL,'2016-07-08 11:34:49',NULL),(4,'2016-07-15',1,20,101,1,20,20,'2016-07-11 14:43:17','2016-07-11 14:44:43'),(11,'2016-07-29',2,20,101,1,20,NULL,'2016-07-29 17:11:45',NULL),(12,'2016-08-13',2,20,101,1,20,NULL,'2016-08-02 14:38:59',NULL),(13,'2016-08-09',2,20,101,1,20,20,'2016-08-02 14:39:17','2016-08-02 14:39:17'),(14,'2016-08-18',2,20,101,1,20,20,'2016-08-02 14:39:23','2016-08-02 14:39:23'),(15,'2016-08-29',3,20,101,1,20,20,'2016-08-02 14:39:55','2016-08-02 14:39:55'),(16,'2016-09-01',2,20,101,1,20,NULL,'2016-08-02 14:41:11',NULL),(17,'2016-08-17',1,9,101,1,9,NULL,'2016-08-02 14:49:32',NULL);

/*Table structure for table `bf_ecp_leave_type_master_country` */

CREATE TABLE `bf_ecp_leave_type_master_country` (
  `leave_type_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_type_id` int(11) DEFAULT NULL,
  `short_code` varchar(20) DEFAULT NULL,
  `leave_type_country_name` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`leave_type_country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_leave_type_master_country` */

insert  into `bf_ecp_leave_type_master_country`(`leave_type_country_id`,`leave_type_id`,`short_code`,`leave_type_country_name`,`country_id`,`deleted`,`created_by_user`,`modified_by_user`,`status`,`created_on`,`modified_on`) values (1,1,'CL','Casual Leave',101,0,NULL,NULL,1,NULL,NULL),(2,2,'PL','Planned Leave',101,0,NULL,NULL,1,NULL,NULL),(3,3,'SL','Sick Leave',101,0,NULL,NULL,1,NULL,NULL);

/*Table structure for table `bf_ecp_leave_type_master_regional` */

CREATE TABLE `bf_ecp_leave_type_master_regional` (
  `leave_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_type_name` varchar(255) DEFAULT NULL,
  `short_code` varchar(20) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`leave_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_leave_type_master_regional` */

insert  into `bf_ecp_leave_type_master_regional`(`leave_type_id`,`leave_type_name`,`short_code`,`deleted`,`status`,`created_by_user`,`modified_by_user`,`created_on`,`modified_on`) values (1,'Casual Leave','CL',0,1,NULL,NULL,NULL,NULL),(2,'Planned Leave','PL',0,1,NULL,NULL,NULL,NULL),(3,'Sick Leave','SL',0,1,NULL,NULL,NULL,NULL);

/*Table structure for table `bf_ecp_material_request` */

CREATE TABLE `bf_ecp_material_request` (
  `material_request_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_request_date` date DEFAULT NULL,
  `promotional_country_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `quantity` decimal(9,2) DEFAULT NULL,
  `remark` text,
  `disptched_date` date DEFAULT NULL,
  `disptched_qty` decimal(9,2) DEFAULT NULL,
  `executor_remark` text,
  `country_id` int(11) DEFAULT NULL,
  `material_request_status` tinyint(1) DEFAULT '0',
  `recived_status` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`material_request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_material_request` */

insert  into `bf_ecp_material_request`(`material_request_id`,`material_request_date`,`promotional_country_id`,`employee_id`,`quantity`,`remark`,`disptched_date`,`disptched_qty`,`executor_remark`,`country_id`,`material_request_status`,`recived_status`,`status`,`created_by_user`,`modified_by_user`,`created_on`,`modified_on`) values (1,'2016-07-04',1,20,'121.00','asdasd',NULL,NULL,NULL,101,1,1,1,20,20,'2016-07-04 11:55:57','2016-07-04 14:31:06'),(3,'2016-07-04',3,20,'2211.00','test','2016-07-05','211.00','test done',101,1,1,1,20,20,'2016-07-04 14:54:21','2016-07-05 12:00:26'),(4,'2016-07-12',6,20,'23.00','sdfaewr werfa erwaer','2016-07-12','100.00','dfgsdfgdfg',101,1,1,1,20,20,'2016-07-12 11:32:24','2016-07-12 13:32:21'),(5,'2016-07-12',1,20,'1231.00','xdfsas asdfa fds ','2016-07-12',NULL,'dsfgsdfgsdfgs',101,2,0,1,20,45,'2016-07-12 12:00:16','2016-07-12 13:00:34'),(6,'2016-07-12',2,20,'11.00','dfgsdfga','2016-07-12','1231.00','sdfsd',101,1,1,1,20,20,'2016-07-12 13:32:14','2016-07-13 06:11:43'),(7,'2016-07-13',1,20,'12.00','qweqweq','2016-07-13','12.00','adsfs',101,1,1,1,20,20,'2016-07-13 06:12:08','2016-07-13 06:13:18'),(8,'2016-08-02',2,20,'4522.00','hv',NULL,NULL,NULL,101,0,0,1,20,20,'2016-08-02 14:42:22','2016-08-02 14:42:22'),(9,'2016-08-02',1,9,'12021.00','njgvh',NULL,NULL,NULL,101,0,0,1,9,9,'2016-08-02 14:49:43','2016-08-02 14:49:43');

/*Table structure for table `bf_ecp_no_wokring` */

CREATE TABLE `bf_ecp_no_wokring` (
  `no_working_id` int(11) NOT NULL AUTO_INCREMENT,
  `no_working_date` date DEFAULT NULL,
  `reason_country_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `other_reason` text,
  `country_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`no_working_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_no_wokring` */

insert  into `bf_ecp_no_wokring`(`no_working_id`,`no_working_date`,`reason_country_id`,`employee_id`,`other_reason`,`country_id`,`status`,`created_by_user`,`modified_by_user`,`created_on`,`modified_on`) values (1,'2016-07-04',5,20,'test',101,1,20,20,'2016-07-07 14:06:35','2016-07-08 07:54:35'),(4,'2016-07-11',3,20,'',101,1,20,20,'2016-07-08 11:00:19','2016-07-11 14:23:20'),(5,'2016-07-12',5,20,'sdfsdf',101,1,20,NULL,'2016-07-08 11:33:16',NULL),(6,'2016-07-19',1,45,'',101,1,45,NULL,'2016-07-11 05:27:14',NULL),(7,'2016-07-24',3,45,'',101,1,45,NULL,'2016-07-11 05:27:24',NULL),(8,'2016-07-20',2,20,'',101,1,20,20,'2016-07-11 14:26:05','2016-07-11 14:26:20'),(11,'2016-07-31',1,20,'',101,1,20,20,'2016-07-29 17:16:48','2016-07-29 17:29:24'),(12,'2016-07-30',2,20,'',101,1,20,NULL,'2016-07-29 17:17:58',NULL),(13,'2016-07-30',2,20,'',101,1,20,NULL,'2016-07-29 17:17:58',NULL),(14,'2016-08-24',1,20,'',101,1,20,NULL,'2016-08-02 14:38:00',NULL),(15,'2016-08-25',1,20,'',101,1,20,20,'2016-08-02 14:38:06','2016-08-02 14:38:06'),(16,'2016-08-11',2,20,'',101,1,20,NULL,'2016-08-02 14:38:49',NULL),(17,'2016-08-16',2,9,'',101,1,9,NULL,'2016-08-02 14:49:24',NULL),(18,'2016-08-23',1,20,'',101,1,20,NULL,'2016-08-16 19:21:07',NULL);

/*Table structure for table `bf_ecp_noworking_reason_master_country` */

CREATE TABLE `bf_ecp_noworking_reason_master_country` (
  `reason_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `reason_id` int(11) DEFAULT NULL,
  `reason_country_name` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`reason_country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_noworking_reason_master_country` */

insert  into `bf_ecp_noworking_reason_master_country`(`reason_country_id`,`reason_id`,`reason_country_name`,`country_id`,`deleted`,`created_by_user`,`modified_by_user`,`status`,`created_on`,`modified_on`) values (1,1,'Training',101,0,NULL,NULL,1,NULL,NULL),(2,2,'Meeting',101,0,NULL,NULL,1,NULL,NULL),(3,3,'Intransit',101,0,NULL,NULL,1,NULL,NULL),(4,4,'Admin Day',101,0,NULL,NULL,1,NULL,NULL),(5,5,'Other',101,0,NULL,NULL,1,NULL,NULL);

/*Table structure for table `bf_ecp_noworking_reason_master_regional` */

CREATE TABLE `bf_ecp_noworking_reason_master_regional` (
  `reason_id` int(11) NOT NULL AUTO_INCREMENT,
  `reason_name` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`reason_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ecp_noworking_reason_master_regional` */

insert  into `bf_ecp_noworking_reason_master_regional`(`reason_id`,`reason_name`,`deleted`,`status`,`created_by_user`,`modified_by_user`,`created_on`,`modified_on`) values (1,'Training',0,1,NULL,NULL,NULL,NULL),(2,'Meeting',0,1,NULL,NULL,NULL,NULL),(3,'Intransit',0,1,NULL,NULL,NULL,NULL),(4,'Admin Day',0,1,NULL,NULL,NULL,NULL),(5,'Other',0,1,NULL,NULL,NULL,NULL);

/*Table structure for table `bf_email_queue` */

CREATE TABLE `bf_email_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_email` varchar(254) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `alt_message` text,
  `max_attempts` int(11) NOT NULL DEFAULT '3',
  `attempts` int(11) NOT NULL DEFAULT '0',
  `success` tinyint(1) NOT NULL DEFAULT '0',
  `date_published` datetime DEFAULT NULL,
  `last_attempt` datetime DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `csv_attachment` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_email_queue` */

/*Table structure for table `bf_email_template` */

CREATE TABLE `bf_email_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_email_template` */

/*Table structure for table `bf_esp_budget` */

CREATE TABLE `bf_esp_budget` (
  `budget_id` int(11) NOT NULL AUTO_INCREMENT,
  `pbg_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `business_code` varchar(100) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `freeze_status` tinyint(1) DEFAULT '0',
  `freeze_by_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`budget_id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;

/*Data for the table `bf_esp_budget` */

insert  into `bf_esp_budget`(`budget_id`,`pbg_id`,`created_by_user`,`business_code`,`modified_by_user`,`freeze_status`,`freeze_by_id`,`deleted`,`status`,`created_on`,`modified_on`) values (1,1,48,'QWERT333',48,1,48,0,1,'2016-07-30 03:49:56',NULL),(2,2,48,'QWERT333',48,0,NULL,0,1,'2016-07-30 03:49:57',NULL),(3,8,48,'QWERT333',48,1,46,0,1,'2016-08-02 08:23:03',NULL),(4,4,48,'QWERT333',48,1,47,0,1,'2016-08-02 12:10:50',NULL),(5,6,48,'0',48,0,NULL,0,1,'2016-08-03 11:43:04',NULL),(6,6,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 11:46:39',NULL),(7,6,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 11:50:02',NULL),(8,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:04',NULL),(9,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:04',NULL),(10,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:05',NULL),(11,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:05',NULL),(12,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:05',NULL),(13,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:05',NULL),(14,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:05',NULL),(15,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:05',NULL),(16,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:05',NULL),(17,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:05',NULL),(18,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:05',NULL),(19,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:05',NULL),(20,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:05',NULL),(21,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:05',NULL),(22,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:05',NULL),(23,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:06',NULL),(24,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:06',NULL),(25,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:06',NULL),(26,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:06',NULL),(27,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:06',NULL),(28,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:06',NULL),(29,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:06',NULL),(30,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:06',NULL),(31,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:06',NULL),(32,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:06',NULL),(33,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:06',NULL),(34,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:06',NULL),(35,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:07',NULL),(36,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:07',NULL),(37,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:07',NULL),(38,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:07',NULL),(39,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:07',NULL),(40,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:07',NULL),(41,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:07',NULL),(42,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:07',NULL),(43,48,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:07',NULL),(44,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:07',NULL),(45,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:07',NULL),(46,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:07',NULL),(47,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:08',NULL),(48,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:08',NULL),(49,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:08',NULL),(50,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:08',NULL),(51,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:08',NULL),(52,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:08',NULL),(53,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:08',NULL),(54,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:08',NULL),(55,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:08',NULL),(56,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:08',NULL),(57,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:08',NULL),(58,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:08',NULL),(59,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:09',NULL),(60,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:09',NULL),(61,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:09',NULL),(62,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:09',NULL),(63,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:09',NULL),(64,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:09',NULL),(65,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:09',NULL),(66,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:09',NULL),(67,51,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:09',NULL),(68,52,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:09',NULL),(69,52,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:09',NULL),(70,52,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:09',NULL),(71,52,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:10',NULL),(72,52,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:10',NULL),(73,52,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:10',NULL),(74,52,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:10',NULL),(75,52,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:10',NULL),(76,52,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:10',NULL),(77,52,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:10',NULL),(78,52,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:10',NULL),(79,52,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:10',NULL),(80,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:10',NULL),(81,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:11',NULL),(82,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:11',NULL),(83,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:11',NULL),(84,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:11',NULL),(85,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:11',NULL),(86,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:11',NULL),(87,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:11',NULL),(88,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:11',NULL),(89,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:11',NULL),(90,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:11',NULL),(91,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:11',NULL),(92,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:12',NULL),(93,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:12',NULL),(94,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:12',NULL),(95,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:12',NULL),(96,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:12',NULL),(97,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:12',NULL),(98,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:12',NULL),(99,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:12',NULL),(100,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:12',NULL),(101,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:12',NULL),(102,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:12',NULL),(103,57,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:12',NULL),(104,58,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:12',NULL),(105,58,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:13',NULL),(106,58,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:13',NULL),(107,58,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:13',NULL),(108,58,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:13',NULL),(109,58,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:13',NULL),(110,58,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:13',NULL),(111,58,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:13',NULL),(112,58,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:13',NULL),(113,58,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:13',NULL),(114,58,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:13',NULL),(115,58,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 03:12:13',NULL),(116,10,48,'QWERT333',47,0,47,0,1,'2016-08-03 05:26:20',NULL),(117,11,48,'QWERT333',48,0,NULL,0,1,'2016-08-03 06:09:16',NULL);

/*Table structure for table `bf_esp_budget_product_details` */

CREATE TABLE `bf_esp_budget_product_details` (
  `budget_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `budget_id` int(11) DEFAULT NULL,
  `business_code` varchar(100) DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `budget_month` date DEFAULT NULL,
  `budget_quantity` decimal(9,2) DEFAULT NULL,
  `budget_value` decimal(9,2) DEFAULT NULL,
  `lock_by_id` int(11) DEFAULT NULL,
  `lock_status` tinyint(1) NOT NULL DEFAULT '0',
  `lock_date` date DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `submit_status` tinyint(1) NOT NULL DEFAULT '0',
  `submit_date` datetime DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`budget_product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=latin1;

/*Data for the table `bf_esp_budget_product_details` */

insert  into `bf_esp_budget_product_details`(`budget_product_id`,`budget_id`,`business_code`,`product_sku_id`,`budget_month`,`budget_quantity`,`budget_value`,`lock_by_id`,`lock_status`,`lock_date`,`deleted`,`status`,`submit_status`,`submit_date`,`created_on`,`modified_on`) values (1,1,'QWERT333',1,'2016-01-01','177.00','0.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:56',NULL),(2,1,'QWERT333',1,'2016-02-01','5.00','0.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:56',NULL),(3,1,'QWERT333',1,'2016-03-01','3.00','0.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:56',NULL),(4,1,'QWERT333',1,'2016-04-01','6.00','20.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:56',NULL),(5,1,'QWERT333',1,'2016-05-01','0.00','20.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:56',NULL),(6,1,'QWERT333',1,'2016-06-01','8.00','20.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:56',NULL),(7,1,'QWERT333',1,'2016-07-01','0.00','20.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:56',NULL),(8,1,'QWERT333',1,'2016-08-01','0.00','20.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:56',NULL),(9,1,'QWERT333',1,'2016-09-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:56',NULL),(10,1,'QWERT333',1,'2016-10-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:56',NULL),(11,1,'QWERT333',1,'2016-11-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:57',NULL),(12,1,'QWERT333',1,'2016-12-01','2.00','0.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:57',NULL),(13,1,'QWERT333',2,'2016-01-01','2.00','0.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:57',NULL),(14,1,'QWERT333',2,'2016-02-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:57',NULL),(15,1,'QWERT333',2,'2016-03-01','88.00','0.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:57',NULL),(16,1,'QWERT333',2,'2016-04-01','0.00','10.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:57',NULL),(17,1,'QWERT333',2,'2016-05-01','0.00','10.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:57',NULL),(18,1,'QWERT333',2,'2016-06-01','0.00','10.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:57',NULL),(19,1,'QWERT333',2,'2016-07-01','0.00','10.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:57',NULL),(20,1,'QWERT333',2,'2016-08-01','0.00','10.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:57',NULL),(21,1,'QWERT333',2,'2016-09-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:57',NULL),(22,1,'QWERT333',2,'2016-10-01','5.00','0.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:57',NULL),(23,1,'QWERT333',2,'2016-11-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:57',NULL),(24,1,'QWERT333',2,'2016-12-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-07-30 03:49:57',NULL),(25,2,'QWERT333',3,'2016-01-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-07-30 03:49:57',NULL),(26,2,'QWERT333',3,'2016-02-01','7.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-07-30 03:49:57',NULL),(27,2,'QWERT333',3,'2016-03-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-07-30 03:49:57',NULL),(28,2,'QWERT333',3,'2016-04-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-07-30 03:49:57',NULL),(29,2,'QWERT333',3,'2016-05-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-07-30 03:49:57',NULL),(30,2,'QWERT333',3,'2016-06-01','6.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-07-30 03:49:58',NULL),(31,2,'QWERT333',3,'2016-07-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-07-30 03:49:58',NULL),(32,2,'QWERT333',3,'2016-08-01','888.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-07-30 03:49:58',NULL),(33,2,'QWERT333',3,'2016-09-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-07-30 03:49:58',NULL),(34,2,'QWERT333',3,'2016-10-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-07-30 03:49:58',NULL),(35,2,'QWERT333',3,'2016-11-01','6.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-07-30 03:49:58',NULL),(36,2,'QWERT333',3,'2016-12-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-07-30 03:49:58',NULL),(37,3,'QWERT333',20,'2016-01-01','5.00','0.00',45,0,NULL,0,1,0,NULL,'2016-08-02 08:23:03',NULL),(38,3,'QWERT333',20,'2016-02-01','5.00','0.00',45,0,NULL,0,1,0,NULL,'2016-08-02 08:23:03',NULL),(39,3,'QWERT333',20,'2016-03-01','5.00','0.00',45,0,NULL,0,1,0,NULL,'2016-08-02 08:23:03',NULL),(40,3,'QWERT333',20,'2016-04-01','0.00','0.00',45,0,NULL,0,1,0,NULL,'2016-08-02 08:23:03',NULL),(41,3,'QWERT333',20,'2016-05-01','0.00','0.00',45,0,NULL,0,1,0,NULL,'2016-08-02 08:23:03',NULL),(42,3,'QWERT333',20,'2016-06-01','0.00','0.00',45,0,NULL,0,1,0,NULL,'2016-08-02 08:23:03',NULL),(43,3,'QWERT333',20,'2016-07-01','0.00','0.00',45,0,NULL,0,1,0,NULL,'2016-08-02 08:23:03',NULL),(44,3,'QWERT333',20,'2016-08-01','0.00','0.00',45,0,NULL,0,1,0,NULL,'2016-08-02 08:23:03',NULL),(45,3,'QWERT333',20,'2016-09-01','0.00','0.00',45,0,NULL,0,1,0,NULL,'2016-08-02 08:23:03',NULL),(46,3,'QWERT333',20,'2016-10-01','0.00','0.00',45,0,NULL,0,1,0,NULL,'2016-08-02 08:23:03',NULL),(47,3,'QWERT333',20,'2016-11-01','0.00','0.00',45,0,NULL,0,1,0,NULL,'2016-08-02 08:23:04',NULL),(48,3,'QWERT333',20,'2016-12-01','0.00','0.00',45,0,NULL,0,1,0,NULL,'2016-08-02 08:23:04',NULL),(49,4,'QWERT333',10,'2016-01-01','5.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:50',NULL),(50,4,'QWERT333',11,'2016-01-01','6.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:50',NULL),(51,4,'QWERT333',10,'2016-02-01','7.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:50',NULL),(52,4,'QWERT333',11,'2016-02-01','7.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:50',NULL),(53,4,'QWERT333',10,'2016-03-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:50',NULL),(54,4,'QWERT333',11,'2016-03-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:50',NULL),(55,4,'QWERT333',10,'2016-04-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:50',NULL),(56,4,'QWERT333',11,'2016-04-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:50',NULL),(57,4,'QWERT333',10,'2016-05-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:51',NULL),(58,4,'QWERT333',11,'2016-05-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:51',NULL),(59,4,'QWERT333',10,'2016-06-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:51',NULL),(60,4,'QWERT333',11,'2016-06-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:51',NULL),(61,4,'QWERT333',10,'2016-07-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:51',NULL),(62,4,'QWERT333',11,'2016-07-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:51',NULL),(63,4,'QWERT333',10,'2016-08-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:51',NULL),(64,4,'QWERT333',11,'2016-08-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:51',NULL),(65,4,'QWERT333',10,'2016-09-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:51',NULL),(66,4,'QWERT333',11,'2016-09-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:51',NULL),(67,4,'QWERT333',10,'2016-10-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:51',NULL),(68,4,'QWERT333',11,'2016-10-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:51',NULL),(69,4,'QWERT333',10,'2016-11-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:51',NULL),(70,4,'QWERT333',11,'2016-11-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:51',NULL),(71,4,'QWERT333',10,'2016-12-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:51',NULL),(72,4,'QWERT333',11,'2016-12-01','0.00','0.00',47,0,NULL,0,1,0,NULL,'2016-08-02 12:10:51',NULL),(73,7,'QWERT333',15,'2016-01-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:02',NULL),(74,7,'QWERT333',16,'2016-01-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:02',NULL),(75,7,'QWERT333',15,'2016-02-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:02',NULL),(76,7,'QWERT333',16,'2016-02-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(77,7,'QWERT333',15,'2016-03-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(78,7,'QWERT333',16,'2016-03-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(79,7,'QWERT333',15,'2016-04-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(80,7,'QWERT333',16,'2016-04-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(81,7,'QWERT333',15,'2016-05-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(82,7,'QWERT333',16,'2016-05-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(83,7,'QWERT333',15,'2016-06-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(84,7,'QWERT333',16,'2016-06-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(85,7,'QWERT333',15,'2016-07-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(86,7,'QWERT333',16,'2016-07-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(87,7,'QWERT333',15,'2016-08-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(88,7,'QWERT333',16,'2016-08-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(89,7,'QWERT333',15,'2016-09-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(90,7,'QWERT333',16,'2016-09-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(91,7,'QWERT333',15,'2016-10-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(92,7,'QWERT333',16,'2016-10-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(93,7,'QWERT333',15,'2016-11-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(94,7,'QWERT333',16,'2016-11-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(95,7,'QWERT333',15,'2016-12-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(96,7,'QWERT333',16,'2016-12-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 11:50:03',NULL),(97,116,'QWERT333',25,'2016-01-01','20.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(98,116,'QWERT333',26,'2016-01-01','20.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(99,116,'QWERT333',25,'2016-02-01','8.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(100,116,'QWERT333',26,'2016-02-01','8.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(101,116,'QWERT333',25,'2016-03-01','9.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(102,116,'QWERT333',26,'2016-03-01','9.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(103,116,'QWERT333',25,'2016-04-01','0.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(104,116,'QWERT333',26,'2016-04-01','0.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(105,116,'QWERT333',25,'2016-05-01','0.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(106,116,'QWERT333',26,'2016-05-01','0.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(107,116,'QWERT333',25,'2016-06-01','0.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(108,116,'QWERT333',26,'2016-06-01','0.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(109,116,'QWERT333',25,'2016-07-01','0.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(110,116,'QWERT333',26,'2016-07-01','0.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(111,116,'QWERT333',25,'2016-08-01','0.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(112,116,'QWERT333',26,'2016-08-01','0.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(113,116,'QWERT333',25,'2016-09-01','0.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(114,116,'QWERT333',26,'2016-09-01','0.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(115,116,'QWERT333',25,'2016-10-01','0.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(116,116,'QWERT333',26,'2016-10-01','0.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(117,116,'QWERT333',25,'2016-11-01','0.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(118,116,'QWERT333',26,'2016-11-01','0.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(119,116,'QWERT333',25,'2016-12-01','0.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(120,116,'QWERT333',26,'2016-12-01','0.00','0.00',46,0,NULL,0,1,0,NULL,'2016-08-03 05:26:21',NULL),(121,117,'QWERT333',27,'2016-01-01','4.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(122,117,'QWERT333',28,'2016-01-01','4.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(123,117,'QWERT333',27,'2016-02-01','4.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(124,117,'QWERT333',28,'2016-02-01','4.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(125,117,'QWERT333',27,'2016-03-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(126,117,'QWERT333',28,'2016-03-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(127,117,'QWERT333',27,'2016-04-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(128,117,'QWERT333',28,'2016-04-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(129,117,'QWERT333',27,'2016-05-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(130,117,'QWERT333',28,'2016-05-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(131,117,'QWERT333',27,'2016-06-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(132,117,'QWERT333',28,'2016-06-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(133,117,'QWERT333',27,'2016-07-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(134,117,'QWERT333',28,'2016-07-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(135,117,'QWERT333',27,'2016-08-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(136,117,'QWERT333',28,'2016-08-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(137,117,'QWERT333',27,'2016-09-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(138,117,'QWERT333',28,'2016-09-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(139,117,'QWERT333',27,'2016-10-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(140,117,'QWERT333',28,'2016-10-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(141,117,'QWERT333',27,'2016-11-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:16',NULL),(142,117,'QWERT333',28,'2016-11-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:17',NULL),(143,117,'QWERT333',27,'2016-12-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:17',NULL),(144,117,'QWERT333',28,'2016-12-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,'2016-08-03 06:09:17',NULL);

/*Table structure for table `bf_esp_forecast` */

CREATE TABLE `bf_esp_forecast` (
  `forecast_id` int(11) NOT NULL AUTO_INCREMENT,
  `pbg_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `business_code` varchar(100) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`forecast_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `bf_esp_forecast` */

insert  into `bf_esp_forecast`(`forecast_id`,`pbg_id`,`created_by_user`,`business_code`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,1,48,'QWERT333',48,0,1,'2016-08-02 06:51:58',NULL),(2,2,48,'QWERT333',48,0,1,'2016-08-02 06:51:59',NULL),(3,48,48,'QWERT333',48,0,1,'2016-08-02 06:52:00',NULL),(4,51,48,'QWERT333',48,0,1,'2016-08-02 06:52:00',NULL),(5,52,48,'QWERT333',48,0,1,'2016-08-02 06:52:00',NULL),(6,57,48,'QWERT333',48,0,1,'2016-08-02 06:52:01',NULL),(7,58,48,'QWERT333',48,0,1,'2016-08-02 06:52:01',NULL);

/*Table structure for table `bf_esp_forecast_assumption` */

CREATE TABLE `bf_esp_forecast_assumption` (
  `forecast_assumption_id` int(11) NOT NULL AUTO_INCREMENT,
  `forecast_id` int(11) NOT NULL,
  `assumption1_id` int(11) DEFAULT NULL,
  `assumption2_id` int(11) DEFAULT NULL,
  `assumption3_id` int(11) DEFAULT NULL,
  `probability1` decimal(9,2) DEFAULT NULL,
  `probability2` decimal(9,2) DEFAULT NULL,
  `probability3` decimal(9,2) DEFAULT NULL,
  `impact1` decimal(9,2) DEFAULT NULL,
  `impact2` decimal(9,2) DEFAULT NULL,
  `impact3` decimal(9,2) DEFAULT NULL,
  `month_data` date DEFAULT NULL,
  PRIMARY KEY (`forecast_assumption_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

/*Data for the table `bf_esp_forecast_assumption` */

insert  into `bf_esp_forecast_assumption`(`forecast_assumption_id`,`forecast_id`,`assumption1_id`,`assumption2_id`,`assumption3_id`,`probability1`,`probability2`,`probability3`,`impact1`,`impact2`,`impact3`,`month_data`) values (1,1,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-01-01'),(2,2,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-01-01'),(3,3,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-01-01'),(4,4,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-01-01'),(5,5,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-01-01'),(6,6,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-01-01'),(7,7,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-01-01'),(8,1,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-02-01'),(9,2,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-02-01'),(10,3,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-02-01'),(11,4,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-02-01'),(12,5,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-02-01'),(13,6,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-02-01'),(14,7,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-02-01'),(15,1,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-03-01'),(16,2,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-03-01'),(17,3,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-03-01'),(18,4,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-03-01'),(19,5,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-03-01'),(20,6,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-03-01'),(21,7,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-03-01'),(22,1,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-04-01'),(23,2,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-04-01'),(24,3,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-04-01'),(25,4,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-04-01'),(26,5,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-04-01'),(27,6,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-04-01'),(28,7,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-04-01'),(29,1,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-05-01'),(30,2,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-05-01'),(31,3,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-05-01'),(32,4,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-05-01'),(33,5,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-05-01'),(34,6,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-05-01'),(35,7,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-05-01'),(36,1,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-06-01'),(37,2,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-06-01'),(38,3,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-06-01'),(39,4,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-06-01'),(40,5,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-06-01'),(41,6,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-06-01'),(42,7,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-06-01'),(43,1,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-07-01'),(44,2,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-07-01'),(45,3,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-07-01'),(46,4,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-07-01'),(47,5,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-07-01'),(48,6,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-07-01'),(49,7,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-07-01'),(50,1,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-08-01'),(51,2,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-08-01'),(52,3,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-08-01'),(53,4,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-08-01'),(54,5,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-08-01'),(55,6,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-08-01'),(56,7,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-08-01'),(57,1,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-09-01'),(58,2,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-09-01'),(59,3,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-09-01'),(60,4,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-09-01'),(61,5,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-09-01'),(62,6,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-09-01'),(63,7,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-09-01'),(64,1,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-10-01'),(65,2,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-10-01'),(66,3,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-10-01'),(67,4,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-10-01'),(68,5,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-10-01'),(69,6,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-10-01'),(70,7,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-10-01'),(71,1,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-11-01'),(72,2,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-11-01'),(73,3,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-11-01'),(74,4,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-11-01'),(75,5,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-11-01'),(76,6,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-11-01'),(77,7,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-11-01'),(78,1,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-12-01'),(79,2,6,13,18,'7.00','8.00','6.00',NULL,NULL,NULL,'2016-12-01'),(80,3,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-12-01'),(81,4,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-12-01'),(82,5,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-12-01'),(83,6,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-12-01'),(84,7,6,13,18,'0.00','0.00','0.00',NULL,NULL,NULL,'2016-12-01');

/*Table structure for table `bf_esp_forecast_product_details` */

CREATE TABLE `bf_esp_forecast_product_details` (
  `forecast_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `forecast_id` int(11) DEFAULT NULL,
  `business_code` varchar(100) DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `forecast_month` date DEFAULT NULL,
  `forecast_quantity` decimal(9,2) DEFAULT NULL,
  `forecast_value` decimal(9,2) DEFAULT NULL,
  `lock_by_id` int(11) DEFAULT NULL,
  `lock_status` tinyint(1) NOT NULL DEFAULT '0',
  `lock_date` date DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `submit_status` tinyint(1) NOT NULL DEFAULT '0',
  `submit_date` date DEFAULT NULL,
  `submit_by_id` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`forecast_product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

/*Data for the table `bf_esp_forecast_product_details` */

insert  into `bf_esp_forecast_product_details`(`forecast_product_id`,`forecast_id`,`business_code`,`product_sku_id`,`forecast_month`,`forecast_quantity`,`forecast_value`,`lock_by_id`,`lock_status`,`lock_date`,`deleted`,`status`,`submit_status`,`submit_date`,`submit_by_id`,`created_on`,`modified_on`) values (1,1,'QWERT333',1,'2016-01-01','9.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-02 06:51:59',NULL),(2,1,'QWERT333',2,'2016-01-01','9.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-02 06:51:59',NULL),(3,2,'QWERT333',3,'2016-01-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-02 06:51:59',NULL),(4,3,'QWERT333',1,'2016-01-01','9.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-02 06:52:00',NULL),(5,3,'QWERT333',2,'2016-01-01','9.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-02 06:52:00',NULL),(6,3,'QWERT333',3,'2016-01-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-02 06:52:00',NULL),(7,4,'QWERT333',1,'2016-01-01','9.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-02 06:52:00',NULL),(8,4,'QWERT333',2,'2016-01-01','9.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-02 06:52:00',NULL),(9,5,'QWERT333',3,'2016-01-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-02 06:52:00',NULL),(10,6,'QWERT333',1,'2016-01-01','9.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-02 06:52:01',NULL),(11,6,'QWERT333',2,'2016-01-01','9.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-02 06:52:01',NULL),(12,7,'QWERT333',3,'2016-01-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-02 06:52:01',NULL),(13,1,'QWERT333',1,'2016-02-01','9.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-02 06:52:01',NULL),(14,1,'QWERT333',2,'2016-02-01','9.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-02 06:52:01',NULL),(15,2,'QWERT333',3,'2016-02-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-02 06:52:01',NULL),(16,1,'QWERT333',1,'2016-03-01','9.00','0.00',NULL,0,NULL,0,1,1,'2016-08-05',48,'2016-08-03 04:25:56',NULL),(17,1,'QWERT333',2,'2016-03-01','9.00','0.00',NULL,0,NULL,0,1,1,'2016-08-05',48,'2016-08-03 04:25:56',NULL),(18,2,'QWERT333',3,'2016-03-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:25:57',NULL),(19,1,'QWERT333',1,'2016-04-01','9.00','180.00',NULL,0,NULL,0,1,0,'2016-08-05',48,'2016-08-03 04:25:59',NULL),(20,1,'QWERT333',2,'2016-04-01','9.00','90.00',NULL,0,NULL,0,1,0,'2016-08-05',48,'2016-08-03 04:25:59',NULL),(21,2,'QWERT333',3,'2016-04-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:25:59',NULL),(22,1,'QWERT333',1,'2016-05-01','9.00','180.00',47,1,NULL,0,1,1,'2016-08-04',48,'2016-08-03 04:26:01',NULL),(23,1,'QWERT333',2,'2016-05-01','9.00','90.00',47,1,NULL,0,1,1,'2016-08-04',48,'2016-08-03 04:26:01',NULL),(24,2,'QWERT333',3,'2016-05-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:01',NULL),(25,1,'QWERT333',1,'2016-06-01','9.00','180.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:03',NULL),(26,1,'QWERT333',2,'2016-06-01','9.00','90.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:04',NULL),(27,2,'QWERT333',3,'2016-06-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:04',NULL),(28,1,'QWERT333',1,'2016-07-01','9.00','180.00',NULL,0,NULL,0,1,1,'2016-08-04',48,'2016-08-03 04:26:06',NULL),(29,1,'QWERT333',2,'2016-07-01','9.00','90.00',NULL,0,NULL,0,1,1,'2016-08-04',48,'2016-08-03 04:26:06',NULL),(30,2,'QWERT333',3,'2016-07-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:06',NULL),(31,1,'QWERT333',1,'2016-08-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:08',NULL),(32,1,'QWERT333',2,'2016-08-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:08',NULL),(33,2,'QWERT333',3,'2016-08-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:08',NULL),(34,1,'QWERT333',1,'2016-09-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:10',NULL),(35,1,'QWERT333',2,'2016-09-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:10',NULL),(36,2,'QWERT333',3,'2016-09-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:11',NULL),(37,1,'QWERT333',1,'2016-10-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:13',NULL),(38,1,'QWERT333',2,'2016-10-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:13',NULL),(39,2,'QWERT333',3,'2016-10-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:13',NULL),(40,1,'QWERT333',1,'2016-11-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:15',NULL),(41,1,'QWERT333',2,'2016-11-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:16',NULL),(42,2,'QWERT333',3,'2016-11-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:16',NULL),(43,1,'QWERT333',1,'2016-12-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:18',NULL),(44,1,'QWERT333',2,'2016-12-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:18',NULL),(45,2,'QWERT333',3,'2016-12-01','0.00','0.00',NULL,0,NULL,0,1,0,NULL,NULL,'2016-08-03 04:26:18',NULL);

/*Table structure for table `bf_facebook` */

CREATE TABLE `bf_facebook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` varchar(255) NOT NULL,
  `superadmin` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `bf_facebook` */

insert  into `bf_facebook`(`id`,`admin`,`superadmin`) values (1,'1','1'),(2,'1','1'),(3,'1','1');

/*Table structure for table `bf_forecast_assumption_history` */

CREATE TABLE `bf_forecast_assumption_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forecast_id` int(11) DEFAULT NULL,
  `month_data` date DEFAULT NULL,
  `assumption1_id` int(11) DEFAULT NULL,
  `assumption2_id` int(11) DEFAULT NULL,
  `assumption3_id` int(11) DEFAULT NULL,
  `probablity1` decimal(9,2) DEFAULT NULL,
  `probablity2` decimal(9,2) DEFAULT NULL,
  `probablity3` decimal(9,2) DEFAULT NULL,
  `update_status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=281 DEFAULT CHARSET=latin1;

/*Data for the table `bf_forecast_assumption_history` */

insert  into `bf_forecast_assumption_history`(`id`,`forecast_id`,`month_data`,`assumption1_id`,`assumption2_id`,`assumption3_id`,`probablity1`,`probablity2`,`probablity3`,`update_status`) values (1,1,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(2,2,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(3,3,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(4,4,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(5,5,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(6,6,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(7,7,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(8,1,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(9,2,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(10,3,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(11,4,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(12,5,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(13,6,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(14,7,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(15,1,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(16,2,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(17,3,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(18,4,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(19,5,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(20,6,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(21,7,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(22,1,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(23,2,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(24,3,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(25,4,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(26,5,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(27,6,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(28,7,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(29,1,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(30,2,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(31,3,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(32,4,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(33,5,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(34,6,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(35,7,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(36,1,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(37,2,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(38,3,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(39,4,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(40,5,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(41,6,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(42,7,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(43,1,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(44,2,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(45,3,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(46,4,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(47,5,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(48,6,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(49,7,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(50,1,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(51,2,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(52,3,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(53,4,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(54,5,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(55,6,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(56,7,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(57,1,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(58,2,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(59,3,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(60,4,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(61,5,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(62,6,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(63,7,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(64,1,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(65,2,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(66,3,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(67,4,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(68,5,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(69,6,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(70,7,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(71,1,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(72,2,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(73,3,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(74,4,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(75,5,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(76,6,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(77,7,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(78,1,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(79,2,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(80,3,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(81,4,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(82,5,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(83,6,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(84,7,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(85,1,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(86,2,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(87,3,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(88,4,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(89,5,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(90,6,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(91,7,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(92,1,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(93,2,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(94,3,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(95,4,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(96,5,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(97,6,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(98,7,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(99,1,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(100,2,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(101,3,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(102,4,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(103,5,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(104,6,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(105,7,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(106,1,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(107,2,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(108,3,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(109,4,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(110,5,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(111,6,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(112,7,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(113,1,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(114,2,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(115,3,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(116,4,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(117,5,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(118,6,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(119,7,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(120,1,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(121,2,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(122,3,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(123,4,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(124,5,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(125,6,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(126,7,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(127,1,'2016-03-01',6,13,18,'0.00','0.00','0.00',1),(128,2,'2016-03-01',6,13,18,'0.00','0.00','0.00',1),(129,3,'2016-03-01',6,13,18,'0.00','0.00','0.00',1),(130,4,'2016-03-01',6,13,18,'0.00','0.00','0.00',1),(131,5,'2016-03-01',6,13,18,'0.00','0.00','0.00',1),(132,6,'2016-03-01',6,13,18,'0.00','0.00','0.00',1),(133,7,'2016-03-01',6,13,18,'0.00','0.00','0.00',1),(134,1,'2016-04-01',6,13,18,'0.00','0.00','0.00',1),(135,2,'2016-04-01',6,13,18,'0.00','0.00','0.00',1),(136,3,'2016-04-01',6,13,18,'0.00','0.00','0.00',1),(137,4,'2016-04-01',6,13,18,'0.00','0.00','0.00',1),(138,5,'2016-04-01',6,13,18,'0.00','0.00','0.00',1),(139,6,'2016-04-01',6,13,18,'0.00','0.00','0.00',1),(140,7,'2016-04-01',6,13,18,'0.00','0.00','0.00',1),(141,1,'2016-05-01',6,13,18,'0.00','0.00','0.00',1),(142,2,'2016-05-01',6,13,18,'0.00','0.00','0.00',1),(143,3,'2016-05-01',6,13,18,'0.00','0.00','0.00',1),(144,4,'2016-05-01',6,13,18,'0.00','0.00','0.00',1),(145,5,'2016-05-01',6,13,18,'0.00','0.00','0.00',1),(146,6,'2016-05-01',6,13,18,'0.00','0.00','0.00',1),(147,7,'2016-05-01',6,13,18,'0.00','0.00','0.00',1),(148,1,'2016-06-01',6,13,18,'0.00','0.00','0.00',1),(149,2,'2016-06-01',6,13,18,'0.00','0.00','0.00',1),(150,3,'2016-06-01',6,13,18,'0.00','0.00','0.00',1),(151,4,'2016-06-01',6,13,18,'0.00','0.00','0.00',1),(152,5,'2016-06-01',6,13,18,'0.00','0.00','0.00',1),(153,6,'2016-06-01',6,13,18,'0.00','0.00','0.00',1),(154,7,'2016-06-01',6,13,18,'0.00','0.00','0.00',1),(155,1,'2016-07-01',6,13,18,'0.00','0.00','0.00',1),(156,2,'2016-07-01',6,13,18,'0.00','0.00','0.00',1),(157,3,'2016-07-01',6,13,18,'0.00','0.00','0.00',1),(158,4,'2016-07-01',6,13,18,'0.00','0.00','0.00',1),(159,5,'2016-07-01',6,13,18,'0.00','0.00','0.00',1),(160,6,'2016-07-01',6,13,18,'0.00','0.00','0.00',1),(161,7,'2016-07-01',6,13,18,'0.00','0.00','0.00',1),(162,1,'2016-08-01',6,13,18,'0.00','0.00','0.00',1),(163,2,'2016-08-01',6,13,18,'0.00','0.00','0.00',1),(164,3,'2016-08-01',6,13,18,'0.00','0.00','0.00',1),(165,4,'2016-08-01',6,13,18,'0.00','0.00','0.00',1),(166,5,'2016-08-01',6,13,18,'0.00','0.00','0.00',1),(167,6,'2016-08-01',6,13,18,'0.00','0.00','0.00',1),(168,7,'2016-08-01',6,13,18,'0.00','0.00','0.00',1),(169,1,'2016-09-01',6,13,18,'0.00','0.00','0.00',1),(170,2,'2016-09-01',6,13,18,'0.00','0.00','0.00',1),(171,3,'2016-09-01',6,13,18,'0.00','0.00','0.00',1),(172,4,'2016-09-01',6,13,18,'0.00','0.00','0.00',1),(173,5,'2016-09-01',6,13,18,'0.00','0.00','0.00',1),(174,6,'2016-09-01',6,13,18,'0.00','0.00','0.00',1),(175,7,'2016-09-01',6,13,18,'0.00','0.00','0.00',1),(176,1,'2016-10-01',6,13,18,'0.00','0.00','0.00',1),(177,2,'2016-10-01',6,13,18,'0.00','0.00','0.00',1),(178,3,'2016-10-01',6,13,18,'0.00','0.00','0.00',1),(179,4,'2016-10-01',6,13,18,'0.00','0.00','0.00',1),(180,5,'2016-10-01',6,13,18,'0.00','0.00','0.00',1),(181,6,'2016-10-01',6,13,18,'0.00','0.00','0.00',1),(182,7,'2016-10-01',6,13,18,'0.00','0.00','0.00',1),(183,1,'2016-11-01',6,13,18,'0.00','0.00','0.00',1),(184,2,'2016-11-01',6,13,18,'0.00','0.00','0.00',1),(185,3,'2016-11-01',6,13,18,'0.00','0.00','0.00',1),(186,4,'2016-11-01',6,13,18,'0.00','0.00','0.00',1),(187,5,'2016-11-01',6,13,18,'0.00','0.00','0.00',1),(188,6,'2016-11-01',6,13,18,'0.00','0.00','0.00',1),(189,7,'2016-11-01',6,13,18,'0.00','0.00','0.00',1),(190,1,'2016-12-01',6,13,18,'0.00','0.00','0.00',1),(191,2,'2016-12-01',6,13,18,'7.00','8.00','6.00',1),(192,3,'2016-12-01',6,13,18,'0.00','0.00','0.00',1),(193,4,'2016-12-01',6,13,18,'0.00','0.00','0.00',1),(194,5,'2016-12-01',6,13,18,'0.00','0.00','0.00',1),(195,6,'2016-12-01',6,13,18,'0.00','0.00','0.00',1),(196,7,'2016-12-01',6,13,18,'0.00','0.00','0.00',1),(197,1,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(198,2,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(199,3,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(200,4,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(201,5,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(202,6,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(203,7,'2016-01-01',6,13,18,'0.00','0.00','0.00',1),(204,1,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(205,2,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(206,3,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(207,4,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(208,5,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(209,6,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(210,7,'2016-02-01',6,13,18,'0.00','0.00','0.00',1),(211,1,'2016-03-01',6,13,18,'0.00','0.00','0.00',1),(212,2,'2016-03-01',6,13,18,'0.00','0.00','0.00',1),(213,3,'2016-03-01',6,13,18,'0.00','0.00','0.00',1),(214,4,'2016-03-01',6,13,18,'0.00','0.00','0.00',1),(215,5,'2016-03-01',6,13,18,'0.00','0.00','0.00',1),(216,6,'2016-03-01',6,13,18,'0.00','0.00','0.00',1),(217,7,'2016-03-01',6,13,18,'0.00','0.00','0.00',1),(218,1,'2016-04-01',6,13,18,'0.00','0.00','0.00',1),(219,2,'2016-04-01',6,13,18,'0.00','0.00','0.00',1),(220,3,'2016-04-01',6,13,18,'0.00','0.00','0.00',1),(221,4,'2016-04-01',6,13,18,'0.00','0.00','0.00',1),(222,5,'2016-04-01',6,13,18,'0.00','0.00','0.00',1),(223,6,'2016-04-01',6,13,18,'0.00','0.00','0.00',1),(224,7,'2016-04-01',6,13,18,'0.00','0.00','0.00',1),(225,1,'2016-05-01',6,13,18,'0.00','0.00','0.00',1),(226,2,'2016-05-01',6,13,18,'0.00','0.00','0.00',1),(227,3,'2016-05-01',6,13,18,'0.00','0.00','0.00',1),(228,4,'2016-05-01',6,13,18,'0.00','0.00','0.00',1),(229,5,'2016-05-01',6,13,18,'0.00','0.00','0.00',1),(230,6,'2016-05-01',6,13,18,'0.00','0.00','0.00',1),(231,7,'2016-05-01',6,13,18,'0.00','0.00','0.00',1),(232,1,'2016-06-01',6,13,18,'0.00','0.00','0.00',1),(233,2,'2016-06-01',6,13,18,'0.00','0.00','0.00',1),(234,3,'2016-06-01',6,13,18,'0.00','0.00','0.00',1),(235,4,'2016-06-01',6,13,18,'0.00','0.00','0.00',1),(236,5,'2016-06-01',6,13,18,'0.00','0.00','0.00',1),(237,6,'2016-06-01',6,13,18,'0.00','0.00','0.00',1),(238,7,'2016-06-01',6,13,18,'0.00','0.00','0.00',1),(239,1,'2016-07-01',6,13,18,'0.00','0.00','0.00',1),(240,2,'2016-07-01',6,13,18,'0.00','0.00','0.00',1),(241,3,'2016-07-01',6,13,18,'0.00','0.00','0.00',1),(242,4,'2016-07-01',6,13,18,'0.00','0.00','0.00',1),(243,5,'2016-07-01',6,13,18,'0.00','0.00','0.00',1),(244,6,'2016-07-01',6,13,18,'0.00','0.00','0.00',1),(245,7,'2016-07-01',6,13,18,'0.00','0.00','0.00',1),(246,1,'2016-08-01',6,13,18,'0.00','0.00','0.00',1),(247,2,'2016-08-01',6,13,18,'0.00','0.00','0.00',1),(248,3,'2016-08-01',6,13,18,'0.00','0.00','0.00',1),(249,4,'2016-08-01',6,13,18,'0.00','0.00','0.00',1),(250,5,'2016-08-01',6,13,18,'0.00','0.00','0.00',1),(251,6,'2016-08-01',6,13,18,'0.00','0.00','0.00',1),(252,7,'2016-08-01',6,13,18,'0.00','0.00','0.00',1),(253,1,'2016-09-01',6,13,18,'0.00','0.00','0.00',1),(254,2,'2016-09-01',6,13,18,'0.00','0.00','0.00',1),(255,3,'2016-09-01',6,13,18,'0.00','0.00','0.00',1),(256,4,'2016-09-01',6,13,18,'0.00','0.00','0.00',1),(257,5,'2016-09-01',6,13,18,'0.00','0.00','0.00',1),(258,6,'2016-09-01',6,13,18,'0.00','0.00','0.00',1),(259,7,'2016-09-01',6,13,18,'0.00','0.00','0.00',1),(260,1,'2016-10-01',6,13,18,'0.00','0.00','0.00',1),(261,2,'2016-10-01',6,13,18,'0.00','0.00','0.00',1),(262,3,'2016-10-01',6,13,18,'0.00','0.00','0.00',1),(263,4,'2016-10-01',6,13,18,'0.00','0.00','0.00',1),(264,5,'2016-10-01',6,13,18,'0.00','0.00','0.00',1),(265,6,'2016-10-01',6,13,18,'0.00','0.00','0.00',1),(266,7,'2016-10-01',6,13,18,'0.00','0.00','0.00',1),(267,1,'2016-11-01',6,13,18,'0.00','0.00','0.00',1),(268,2,'2016-11-01',6,13,18,'0.00','0.00','0.00',1),(269,3,'2016-11-01',6,13,18,'0.00','0.00','0.00',1),(270,4,'2016-11-01',6,13,18,'0.00','0.00','0.00',1),(271,5,'2016-11-01',6,13,18,'0.00','0.00','0.00',1),(272,6,'2016-11-01',6,13,18,'0.00','0.00','0.00',1),(273,7,'2016-11-01',6,13,18,'0.00','0.00','0.00',1),(274,1,'2016-12-01',6,13,18,'0.00','0.00','0.00',1),(275,2,'2016-12-01',6,13,18,'7.00','8.00','6.00',1),(276,3,'2016-12-01',6,13,18,'0.00','0.00','0.00',1),(277,4,'2016-12-01',6,13,18,'0.00','0.00','0.00',1),(278,5,'2016-12-01',6,13,18,'0.00','0.00','0.00',1),(279,6,'2016-12-01',6,13,18,'0.00','0.00','0.00',1),(280,7,'2016-12-01',6,13,18,'0.00','0.00','0.00',1);

/*Table structure for table `bf_forecast_freeze_status_history` */

CREATE TABLE `bf_forecast_freeze_status_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forecast_id` int(11) DEFAULT NULL,
  `month_data` date DEFAULT NULL,
  `freeze_status` tinyint(1) NOT NULL DEFAULT '0',
  `freeze_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `bf_forecast_freeze_status_history` */

insert  into `bf_forecast_freeze_status_history`(`id`,`forecast_id`,`month_data`,`freeze_status`,`freeze_by_id`) values (1,1,'2016-05-01',1,48),(2,1,'2016-07-01',1,48),(3,1,'2016-04-01',0,48),(4,1,'2016-03-01',1,48);

/*Table structure for table `bf_forecast_lock_status_history` */

CREATE TABLE `bf_forecast_lock_status_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forecast_id` int(11) DEFAULT NULL,
  `month_data` date DEFAULT NULL,
  `lock_status` tinyint(1) NOT NULL DEFAULT '0',
  `lock_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `bf_forecast_lock_status_history` */

insert  into `bf_forecast_lock_status_history`(`id`,`forecast_id`,`month_data`,`lock_status`,`lock_by_id`) values (1,1,'2016-05-01',1,47);

/*Table structure for table `bf_forecast_product_detail_history` */

CREATE TABLE `bf_forecast_product_detail_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forecast_id` int(11) DEFAULT NULL,
  `business_code` varchar(100) DEFAULT NULL,
  `pbg_id` int(11) DEFAULT NULL,
  `sku_id` int(11) DEFAULT NULL,
  `month_data` date DEFAULT NULL,
  `forecast_qty` decimal(9,2) DEFAULT NULL,
  `forecast_value` decimal(9,2) DEFAULT NULL,
  `update_status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=481 DEFAULT CHARSET=latin1;

/*Data for the table `bf_forecast_product_detail_history` */

insert  into `bf_forecast_product_detail_history`(`id`,`forecast_id`,`business_code`,`pbg_id`,`sku_id`,`month_data`,`forecast_qty`,`forecast_value`,`update_status`) values (1,1,'QWERT333',1,1,'2016-01-01','9.00','0.00',1),(2,1,'QWERT333',1,2,'2016-01-01','9.00','0.00',1),(3,2,'QWERT333',2,3,'2016-01-01','0.00','0.00',1),(4,3,'QWERT333',48,1,'2016-01-01','9.00','0.00',1),(5,3,'QWERT333',48,2,'2016-01-01','9.00','0.00',1),(6,3,'QWERT333',48,3,'2016-01-01','0.00','0.00',1),(7,4,'QWERT333',51,1,'2016-01-01','9.00','0.00',1),(8,4,'QWERT333',51,2,'2016-01-01','9.00','0.00',1),(9,5,'QWERT333',52,3,'2016-01-01','0.00','0.00',1),(10,6,'QWERT333',57,1,'2016-01-01','9.00','0.00',1),(11,6,'QWERT333',57,2,'2016-01-01','9.00','0.00',1),(12,7,'QWERT333',58,3,'2016-01-01','0.00','0.00',1),(13,1,'QWERT333',1,1,'2016-02-01','9.00','0.00',1),(14,1,'QWERT333',1,2,'2016-02-01','9.00','0.00',1),(15,2,'QWERT333',2,3,'2016-02-01','0.00','0.00',1),(16,3,'QWERT333',48,1,'2016-02-01','9.00','0.00',1),(17,3,'QWERT333',48,2,'2016-02-01','9.00','0.00',1),(18,3,'QWERT333',48,3,'2016-02-01','0.00','0.00',1),(19,4,'QWERT333',51,1,'2016-02-01','9.00','0.00',1),(20,4,'QWERT333',51,2,'2016-02-01','9.00','0.00',1),(21,5,'QWERT333',52,3,'2016-02-01','0.00','0.00',1),(22,6,'QWERT333',57,1,'2016-02-01','9.00','0.00',1),(23,6,'QWERT333',57,2,'2016-02-01','9.00','0.00',1),(24,7,'QWERT333',58,3,'2016-02-01','0.00','0.00',1),(25,1,'QWERT333',1,1,'2016-01-01','9.00','0.00',1),(26,1,'QWERT333',1,2,'2016-01-01','9.00','0.00',1),(27,2,'QWERT333',2,3,'2016-01-01','0.00','0.00',1),(28,3,'QWERT333',48,1,'2016-01-01','9.00','0.00',1),(29,3,'QWERT333',48,2,'2016-01-01','9.00','0.00',1),(30,3,'QWERT333',48,3,'2016-01-01','0.00','0.00',1),(31,4,'QWERT333',51,1,'2016-01-01','9.00','0.00',1),(32,4,'QWERT333',51,2,'2016-01-01','9.00','0.00',1),(33,5,'QWERT333',52,3,'2016-01-01','0.00','0.00',1),(34,6,'QWERT333',57,1,'2016-01-01','9.00','0.00',1),(35,6,'QWERT333',57,2,'2016-01-01','9.00','0.00',1),(36,7,'QWERT333',58,3,'2016-01-01','0.00','0.00',1),(37,1,'QWERT333',1,1,'2016-02-01','9.00','0.00',1),(38,1,'QWERT333',1,2,'2016-02-01','9.00','0.00',1),(39,2,'QWERT333',2,3,'2016-02-01','0.00','0.00',1),(40,3,'QWERT333',48,1,'2016-02-01','9.00','0.00',1),(41,3,'QWERT333',48,2,'2016-02-01','9.00','0.00',1),(42,3,'QWERT333',48,3,'2016-02-01','0.00','0.00',1),(43,4,'QWERT333',51,1,'2016-02-01','9.00','0.00',1),(44,4,'QWERT333',51,2,'2016-02-01','9.00','0.00',1),(45,5,'QWERT333',52,3,'2016-02-01','0.00','0.00',1),(46,6,'QWERT333',57,1,'2016-02-01','9.00','0.00',1),(47,6,'QWERT333',57,2,'2016-02-01','9.00','0.00',1),(48,7,'QWERT333',58,3,'2016-02-01','0.00','0.00',1),(49,1,'QWERT333',1,1,'2016-01-01','9.00','0.00',1),(50,1,'QWERT333',1,2,'2016-01-01','9.00','0.00',1),(51,2,'QWERT333',2,3,'2016-01-01','0.00','0.00',1),(52,3,'QWERT333',48,1,'2016-01-01','9.00','0.00',1),(53,3,'QWERT333',48,2,'2016-01-01','9.00','0.00',1),(54,3,'QWERT333',48,3,'2016-01-01','0.00','0.00',1),(55,4,'QWERT333',51,1,'2016-01-01','9.00','0.00',1),(56,4,'QWERT333',51,2,'2016-01-01','9.00','0.00',1),(57,5,'QWERT333',52,3,'2016-01-01','0.00','0.00',1),(58,6,'QWERT333',57,1,'2016-01-01','9.00','0.00',1),(59,6,'QWERT333',57,2,'2016-01-01','9.00','0.00',1),(60,7,'QWERT333',58,3,'2016-01-01','0.00','0.00',1),(61,1,'QWERT333',1,1,'2016-02-01','9.00','0.00',1),(62,1,'QWERT333',1,2,'2016-02-01','9.00','0.00',1),(63,2,'QWERT333',2,3,'2016-02-01','0.00','0.00',1),(64,3,'QWERT333',48,1,'2016-02-01','9.00','0.00',1),(65,3,'QWERT333',48,2,'2016-02-01','9.00','0.00',1),(66,3,'QWERT333',48,3,'2016-02-01','0.00','0.00',1),(67,4,'QWERT333',51,1,'2016-02-01','9.00','0.00',1),(68,4,'QWERT333',51,2,'2016-02-01','9.00','0.00',1),(69,5,'QWERT333',52,3,'2016-02-01','0.00','0.00',1),(70,6,'QWERT333',57,1,'2016-02-01','9.00','0.00',1),(71,6,'QWERT333',57,2,'2016-02-01','9.00','0.00',1),(72,7,'QWERT333',58,3,'2016-02-01','0.00','0.00',1),(73,1,'QWERT333',1,1,'2016-01-01','9.00','0.00',1),(74,1,'QWERT333',1,2,'2016-01-01','9.00','0.00',1),(75,2,'QWERT333',2,3,'2016-01-01','0.00','0.00',1),(76,3,'QWERT333',48,1,'2016-01-01','9.00','0.00',1),(77,3,'QWERT333',48,2,'2016-01-01','9.00','0.00',1),(78,3,'QWERT333',48,3,'2016-01-01','0.00','0.00',1),(79,4,'QWERT333',51,1,'2016-01-01','9.00','0.00',1),(80,4,'QWERT333',51,2,'2016-01-01','9.00','0.00',1),(81,5,'QWERT333',52,3,'2016-01-01','0.00','0.00',1),(82,6,'QWERT333',57,1,'2016-01-01','9.00','0.00',1),(83,6,'QWERT333',57,2,'2016-01-01','9.00','0.00',1),(84,7,'QWERT333',58,3,'2016-01-01','0.00','0.00',1),(85,1,'QWERT333',1,1,'2016-02-01','9.00','0.00',1),(86,1,'QWERT333',1,2,'2016-02-01','9.00','0.00',1),(87,2,'QWERT333',2,3,'2016-02-01','0.00','0.00',1),(88,3,'QWERT333',48,1,'2016-02-01','9.00','0.00',1),(89,3,'QWERT333',48,2,'2016-02-01','9.00','0.00',1),(90,3,'QWERT333',48,3,'2016-02-01','0.00','0.00',1),(91,4,'QWERT333',51,1,'2016-02-01','9.00','0.00',1),(92,4,'QWERT333',51,2,'2016-02-01','9.00','0.00',1),(93,5,'QWERT333',52,3,'2016-02-01','0.00','0.00',1),(94,6,'QWERT333',57,1,'2016-02-01','9.00','0.00',1),(95,6,'QWERT333',57,2,'2016-02-01','9.00','0.00',1),(96,7,'QWERT333',58,3,'2016-02-01','0.00','0.00',1),(97,1,'QWERT333',1,1,'2016-01-01','9.00','0.00',1),(98,1,'QWERT333',1,2,'2016-01-01','9.00','0.00',1),(99,2,'QWERT333',2,3,'2016-01-01','0.00','0.00',1),(100,3,'QWERT333',48,1,'2016-01-01','9.00','0.00',1),(101,3,'QWERT333',48,2,'2016-01-01','9.00','0.00',1),(102,3,'QWERT333',48,3,'2016-01-01','0.00','0.00',1),(103,4,'QWERT333',51,1,'2016-01-01','9.00','0.00',1),(104,4,'QWERT333',51,2,'2016-01-01','9.00','0.00',1),(105,5,'QWERT333',52,3,'2016-01-01','0.00','0.00',1),(106,6,'QWERT333',57,1,'2016-01-01','9.00','0.00',1),(107,6,'QWERT333',57,2,'2016-01-01','9.00','0.00',1),(108,7,'QWERT333',58,3,'2016-01-01','0.00','0.00',1),(109,1,'QWERT333',1,1,'2016-02-01','9.00','0.00',1),(110,1,'QWERT333',1,2,'2016-02-01','9.00','0.00',1),(111,2,'QWERT333',2,3,'2016-02-01','0.00','0.00',1),(112,3,'QWERT333',48,1,'2016-02-01','9.00','0.00',1),(113,3,'QWERT333',48,2,'2016-02-01','9.00','0.00',1),(114,3,'QWERT333',48,3,'2016-02-01','0.00','0.00',1),(115,4,'QWERT333',51,1,'2016-02-01','9.00','0.00',1),(116,4,'QWERT333',51,2,'2016-02-01','9.00','0.00',1),(117,5,'QWERT333',52,3,'2016-02-01','0.00','0.00',1),(118,6,'QWERT333',57,1,'2016-02-01','9.00','0.00',1),(119,6,'QWERT333',57,2,'2016-02-01','9.00','0.00',1),(120,7,'QWERT333',58,3,'2016-02-01','0.00','0.00',1),(121,1,'QWERT333',1,1,'2016-01-01','9.00','0.00',1),(122,1,'QWERT333',1,2,'2016-01-01','9.00','0.00',1),(123,2,'QWERT333',2,3,'2016-01-01','0.00','0.00',1),(124,3,'QWERT333',48,1,'2016-01-01','9.00','0.00',1),(125,3,'QWERT333',48,2,'2016-01-01','9.00','0.00',1),(126,3,'QWERT333',48,3,'2016-01-01','0.00','0.00',1),(127,4,'QWERT333',51,1,'2016-01-01','9.00','0.00',1),(128,4,'QWERT333',51,2,'2016-01-01','9.00','0.00',1),(129,5,'QWERT333',52,3,'2016-01-01','0.00','0.00',1),(130,6,'QWERT333',57,1,'2016-01-01','9.00','0.00',1),(131,6,'QWERT333',57,2,'2016-01-01','9.00','0.00',1),(132,7,'QWERT333',58,3,'2016-01-01','0.00','0.00',1),(133,1,'QWERT333',1,1,'2016-02-01','9.00','0.00',1),(134,1,'QWERT333',1,2,'2016-02-01','9.00','0.00',1),(135,2,'QWERT333',2,3,'2016-02-01','0.00','0.00',1),(136,3,'QWERT333',48,1,'2016-02-01','9.00','0.00',1),(137,3,'QWERT333',48,2,'2016-02-01','9.00','0.00',1),(138,3,'QWERT333',48,3,'2016-02-01','0.00','0.00',1),(139,4,'QWERT333',51,1,'2016-02-01','9.00','0.00',1),(140,4,'QWERT333',51,2,'2016-02-01','9.00','0.00',1),(141,5,'QWERT333',52,3,'2016-02-01','0.00','0.00',1),(142,6,'QWERT333',57,1,'2016-02-01','9.00','0.00',1),(143,6,'QWERT333',57,2,'2016-02-01','9.00','0.00',1),(144,7,'QWERT333',58,3,'2016-02-01','0.00','0.00',1),(145,1,'QWERT333',1,1,'2016-01-01','9.00','0.00',1),(146,1,'QWERT333',1,2,'2016-01-01','9.00','0.00',1),(147,2,'QWERT333',2,3,'2016-01-01','0.00','0.00',1),(148,3,'QWERT333',48,1,'2016-01-01','9.00','0.00',1),(149,3,'QWERT333',48,2,'2016-01-01','9.00','0.00',1),(150,3,'QWERT333',48,3,'2016-01-01','0.00','0.00',1),(151,4,'QWERT333',51,1,'2016-01-01','9.00','0.00',1),(152,4,'QWERT333',51,2,'2016-01-01','9.00','0.00',1),(153,5,'QWERT333',52,3,'2016-01-01','0.00','0.00',1),(154,6,'QWERT333',57,1,'2016-01-01','9.00','0.00',1),(155,6,'QWERT333',57,2,'2016-01-01','9.00','0.00',1),(156,7,'QWERT333',58,3,'2016-01-01','0.00','0.00',1),(157,1,'QWERT333',1,1,'2016-02-01','9.00','0.00',1),(158,1,'QWERT333',1,2,'2016-02-01','9.00','0.00',1),(159,2,'QWERT333',2,3,'2016-02-01','0.00','0.00',1),(160,3,'QWERT333',48,1,'2016-02-01','9.00','0.00',1),(161,3,'QWERT333',48,2,'2016-02-01','9.00','0.00',1),(162,3,'QWERT333',48,3,'2016-02-01','0.00','0.00',1),(163,4,'QWERT333',51,1,'2016-02-01','9.00','0.00',1),(164,4,'QWERT333',51,2,'2016-02-01','9.00','0.00',1),(165,5,'QWERT333',52,3,'2016-02-01','0.00','0.00',1),(166,6,'QWERT333',57,1,'2016-02-01','9.00','0.00',1),(167,6,'QWERT333',57,2,'2016-02-01','9.00','0.00',1),(168,7,'QWERT333',58,3,'2016-02-01','0.00','0.00',1),(169,1,'QWERT333',1,1,'2016-01-01','9.00','0.00',1),(170,1,'QWERT333',1,2,'2016-01-01','9.00','0.00',1),(171,2,'QWERT333',2,3,'2016-01-01','0.00','0.00',1),(172,3,'QWERT333',48,1,'2016-01-01','9.00','0.00',1),(173,3,'QWERT333',48,2,'2016-01-01','9.00','0.00',1),(174,3,'QWERT333',48,3,'2016-01-01','0.00','0.00',1),(175,4,'QWERT333',51,1,'2016-01-01','9.00','0.00',1),(176,4,'QWERT333',51,2,'2016-01-01','9.00','0.00',1),(177,5,'QWERT333',52,3,'2016-01-01','0.00','0.00',1),(178,6,'QWERT333',57,1,'2016-01-01','9.00','0.00',1),(179,6,'QWERT333',57,2,'2016-01-01','9.00','0.00',1),(180,7,'QWERT333',58,3,'2016-01-01','0.00','0.00',1),(181,1,'QWERT333',1,1,'2016-02-01','9.00','0.00',1),(182,1,'QWERT333',1,2,'2016-02-01','9.00','0.00',1),(183,2,'QWERT333',2,3,'2016-02-01','0.00','0.00',1),(184,3,'QWERT333',48,1,'2016-02-01','9.00','0.00',1),(185,3,'QWERT333',48,2,'2016-02-01','9.00','0.00',1),(186,3,'QWERT333',48,3,'2016-02-01','0.00','0.00',1),(187,4,'QWERT333',51,1,'2016-02-01','9.00','0.00',1),(188,4,'QWERT333',51,2,'2016-02-01','9.00','0.00',1),(189,5,'QWERT333',52,3,'2016-02-01','0.00','0.00',1),(190,6,'QWERT333',57,1,'2016-02-01','9.00','0.00',1),(191,6,'QWERT333',57,2,'2016-02-01','9.00','0.00',1),(192,7,'QWERT333',58,3,'2016-02-01','0.00','0.00',1),(193,1,'QWERT333',1,1,'2016-01-01','9.00','0.00',1),(194,1,'QWERT333',1,2,'2016-01-01','9.00','0.00',1),(195,2,'QWERT333',2,3,'2016-01-01','0.00','0.00',1),(196,3,'QWERT333',48,1,'2016-01-01','9.00','0.00',1),(197,3,'QWERT333',48,2,'2016-01-01','9.00','0.00',1),(198,3,'QWERT333',48,3,'2016-01-01','0.00','0.00',1),(199,4,'QWERT333',51,1,'2016-01-01','9.00','0.00',1),(200,4,'QWERT333',51,2,'2016-01-01','9.00','0.00',1),(201,5,'QWERT333',52,3,'2016-01-01','0.00','0.00',1),(202,6,'QWERT333',57,1,'2016-01-01','9.00','0.00',1),(203,6,'QWERT333',57,2,'2016-01-01','9.00','0.00',1),(204,7,'QWERT333',58,3,'2016-01-01','0.00','0.00',1),(205,1,'QWERT333',1,1,'2016-02-01','9.00','0.00',1),(206,1,'QWERT333',1,2,'2016-02-01','9.00','0.00',1),(207,2,'QWERT333',2,3,'2016-02-01','0.00','0.00',1),(208,3,'QWERT333',48,1,'2016-02-01','9.00','0.00',1),(209,3,'QWERT333',48,2,'2016-02-01','9.00','0.00',1),(210,3,'QWERT333',48,3,'2016-02-01','0.00','0.00',1),(211,4,'QWERT333',51,1,'2016-02-01','9.00','0.00',1),(212,4,'QWERT333',51,2,'2016-02-01','9.00','0.00',1),(213,5,'QWERT333',52,3,'2016-02-01','0.00','0.00',1),(214,6,'QWERT333',57,1,'2016-02-01','9.00','0.00',1),(215,6,'QWERT333',57,2,'2016-02-01','9.00','0.00',1),(216,7,'QWERT333',58,3,'2016-02-01','0.00','0.00',1),(217,1,'QWERT333',1,1,'2016-03-01','9.00','0.00',1),(218,1,'QWERT333',1,2,'2016-03-01','9.00','0.00',1),(219,2,'QWERT333',2,3,'2016-03-01','0.00','0.00',1),(220,3,'QWERT333',48,1,'2016-03-01','9.00','0.00',1),(221,3,'QWERT333',48,2,'2016-03-01','9.00','0.00',1),(222,3,'QWERT333',48,3,'2016-03-01','0.00','0.00',1),(223,4,'QWERT333',51,1,'2016-03-01','9.00','0.00',1),(224,4,'QWERT333',51,2,'2016-03-01','9.00','0.00',1),(225,5,'QWERT333',52,3,'2016-03-01','0.00','0.00',1),(226,6,'QWERT333',57,1,'2016-03-01','9.00','0.00',1),(227,6,'QWERT333',57,2,'2016-03-01','9.00','0.00',1),(228,7,'QWERT333',58,3,'2016-03-01','0.00','0.00',1),(229,1,'QWERT333',1,1,'2016-04-01','9.00','180.00',1),(230,1,'QWERT333',1,2,'2016-04-01','9.00','90.00',1),(231,2,'QWERT333',2,3,'2016-04-01','0.00','0.00',1),(232,3,'QWERT333',48,1,'2016-04-01','9.00','180.00',1),(233,3,'QWERT333',48,2,'2016-04-01','9.00','90.00',1),(234,3,'QWERT333',48,3,'2016-04-01','0.00','0.00',1),(235,4,'QWERT333',51,1,'2016-04-01','9.00','180.00',1),(236,4,'QWERT333',51,2,'2016-04-01','9.00','90.00',1),(237,5,'QWERT333',52,3,'2016-04-01','0.00','0.00',1),(238,6,'QWERT333',57,1,'2016-04-01','9.00','180.00',1),(239,6,'QWERT333',57,2,'2016-04-01','9.00','90.00',1),(240,7,'QWERT333',58,3,'2016-04-01','0.00','0.00',1),(241,1,'QWERT333',1,1,'2016-05-01','9.00','180.00',1),(242,1,'QWERT333',1,2,'2016-05-01','9.00','90.00',1),(243,2,'QWERT333',2,3,'2016-05-01','0.00','0.00',1),(244,3,'QWERT333',48,1,'2016-05-01','9.00','180.00',1),(245,3,'QWERT333',48,2,'2016-05-01','9.00','90.00',1),(246,3,'QWERT333',48,3,'2016-05-01','0.00','0.00',1),(247,4,'QWERT333',51,1,'2016-05-01','9.00','180.00',1),(248,4,'QWERT333',51,2,'2016-05-01','9.00','90.00',1),(249,5,'QWERT333',52,3,'2016-05-01','0.00','0.00',1),(250,6,'QWERT333',57,1,'2016-05-01','9.00','180.00',1),(251,6,'QWERT333',57,2,'2016-05-01','9.00','90.00',1),(252,7,'QWERT333',58,3,'2016-05-01','0.00','0.00',1),(253,1,'QWERT333',1,1,'2016-06-01','9.00','180.00',1),(254,1,'QWERT333',1,2,'2016-06-01','9.00','90.00',1),(255,2,'QWERT333',2,3,'2016-06-01','0.00','0.00',1),(256,3,'QWERT333',48,1,'2016-06-01','9.00','180.00',1),(257,3,'QWERT333',48,2,'2016-06-01','9.00','90.00',1),(258,3,'QWERT333',48,3,'2016-06-01','0.00','0.00',1),(259,4,'QWERT333',51,1,'2016-06-01','9.00','180.00',1),(260,4,'QWERT333',51,2,'2016-06-01','9.00','90.00',1),(261,5,'QWERT333',52,3,'2016-06-01','0.00','0.00',1),(262,6,'QWERT333',57,1,'2016-06-01','9.00','180.00',1),(263,6,'QWERT333',57,2,'2016-06-01','9.00','90.00',1),(264,7,'QWERT333',58,3,'2016-06-01','0.00','0.00',1),(265,1,'QWERT333',1,1,'2016-07-01','9.00','180.00',1),(266,1,'QWERT333',1,2,'2016-07-01','9.00','90.00',1),(267,2,'QWERT333',2,3,'2016-07-01','0.00','0.00',1),(268,3,'QWERT333',48,1,'2016-07-01','9.00','180.00',1),(269,3,'QWERT333',48,2,'2016-07-01','9.00','90.00',1),(270,3,'QWERT333',48,3,'2016-07-01','0.00','0.00',1),(271,4,'QWERT333',51,1,'2016-07-01','9.00','180.00',1),(272,4,'QWERT333',51,2,'2016-07-01','9.00','90.00',1),(273,5,'QWERT333',52,3,'2016-07-01','0.00','0.00',1),(274,6,'QWERT333',57,1,'2016-07-01','9.00','180.00',1),(275,6,'QWERT333',57,2,'2016-07-01','9.00','90.00',1),(276,7,'QWERT333',58,3,'2016-07-01','0.00','0.00',1),(277,1,'QWERT333',1,1,'2016-08-01','0.00','0.00',1),(278,1,'QWERT333',1,2,'2016-08-01','0.00','0.00',1),(279,2,'QWERT333',2,3,'2016-08-01','0.00','0.00',1),(280,3,'QWERT333',48,1,'2016-08-01','0.00','0.00',1),(281,3,'QWERT333',48,2,'2016-08-01','0.00','0.00',1),(282,3,'QWERT333',48,3,'2016-08-01','0.00','0.00',1),(283,4,'QWERT333',51,1,'2016-08-01','0.00','0.00',1),(284,4,'QWERT333',51,2,'2016-08-01','0.00','0.00',1),(285,5,'QWERT333',52,3,'2016-08-01','0.00','0.00',1),(286,6,'QWERT333',57,1,'2016-08-01','0.00','0.00',1),(287,6,'QWERT333',57,2,'2016-08-01','0.00','0.00',1),(288,7,'QWERT333',58,3,'2016-08-01','0.00','0.00',1),(289,1,'QWERT333',1,1,'2016-09-01','0.00','0.00',1),(290,1,'QWERT333',1,2,'2016-09-01','0.00','0.00',1),(291,2,'QWERT333',2,3,'2016-09-01','0.00','0.00',1),(292,3,'QWERT333',48,1,'2016-09-01','0.00','0.00',1),(293,3,'QWERT333',48,2,'2016-09-01','0.00','0.00',1),(294,3,'QWERT333',48,3,'2016-09-01','0.00','0.00',1),(295,4,'QWERT333',51,1,'2016-09-01','0.00','0.00',1),(296,4,'QWERT333',51,2,'2016-09-01','0.00','0.00',1),(297,5,'QWERT333',52,3,'2016-09-01','0.00','0.00',1),(298,6,'QWERT333',57,1,'2016-09-01','0.00','0.00',1),(299,6,'QWERT333',57,2,'2016-09-01','0.00','0.00',1),(300,7,'QWERT333',58,3,'2016-09-01','0.00','0.00',1),(301,1,'QWERT333',1,1,'2016-10-01','0.00','0.00',1),(302,1,'QWERT333',1,2,'2016-10-01','0.00','0.00',1),(303,2,'QWERT333',2,3,'2016-10-01','0.00','0.00',1),(304,3,'QWERT333',48,1,'2016-10-01','0.00','0.00',1),(305,3,'QWERT333',48,2,'2016-10-01','0.00','0.00',1),(306,3,'QWERT333',48,3,'2016-10-01','0.00','0.00',1),(307,4,'QWERT333',51,1,'2016-10-01','0.00','0.00',1),(308,4,'QWERT333',51,2,'2016-10-01','0.00','0.00',1),(309,5,'QWERT333',52,3,'2016-10-01','0.00','0.00',1),(310,6,'QWERT333',57,1,'2016-10-01','0.00','0.00',1),(311,6,'QWERT333',57,2,'2016-10-01','0.00','0.00',1),(312,7,'QWERT333',58,3,'2016-10-01','0.00','0.00',1),(313,1,'QWERT333',1,1,'2016-11-01','0.00','0.00',1),(314,1,'QWERT333',1,2,'2016-11-01','0.00','0.00',1),(315,2,'QWERT333',2,3,'2016-11-01','0.00','0.00',1),(316,3,'QWERT333',48,1,'2016-11-01','0.00','0.00',1),(317,3,'QWERT333',48,2,'2016-11-01','0.00','0.00',1),(318,3,'QWERT333',48,3,'2016-11-01','0.00','0.00',1),(319,4,'QWERT333',51,1,'2016-11-01','0.00','0.00',1),(320,4,'QWERT333',51,2,'2016-11-01','0.00','0.00',1),(321,5,'QWERT333',52,3,'2016-11-01','0.00','0.00',1),(322,6,'QWERT333',57,1,'2016-11-01','0.00','0.00',1),(323,6,'QWERT333',57,2,'2016-11-01','0.00','0.00',1),(324,7,'QWERT333',58,3,'2016-11-01','0.00','0.00',1),(325,1,'QWERT333',1,1,'2016-12-01','0.00','0.00',1),(326,1,'QWERT333',1,2,'2016-12-01','0.00','0.00',1),(327,2,'QWERT333',2,3,'2016-12-01','0.00','0.00',1),(328,3,'QWERT333',48,1,'2016-12-01','0.00','0.00',1),(329,3,'QWERT333',48,2,'2016-12-01','0.00','0.00',1),(330,3,'QWERT333',48,3,'2016-12-01','0.00','0.00',1),(331,4,'QWERT333',51,1,'2016-12-01','0.00','0.00',1),(332,4,'QWERT333',51,2,'2016-12-01','0.00','0.00',1),(333,5,'QWERT333',52,3,'2016-12-01','0.00','0.00',1),(334,6,'QWERT333',57,1,'2016-12-01','0.00','0.00',1),(335,6,'QWERT333',57,2,'2016-12-01','0.00','0.00',1),(336,7,'QWERT333',58,3,'2016-12-01','0.00','0.00',1),(337,1,'QWERT333',1,1,'2016-01-01','9.00','0.00',1),(338,1,'QWERT333',1,2,'2016-01-01','9.00','0.00',1),(339,2,'QWERT333',2,3,'2016-01-01','0.00','0.00',1),(340,3,'QWERT333',48,1,'2016-01-01','9.00','0.00',1),(341,3,'QWERT333',48,2,'2016-01-01','9.00','0.00',1),(342,3,'QWERT333',48,3,'2016-01-01','0.00','0.00',1),(343,4,'QWERT333',51,1,'2016-01-01','9.00','0.00',1),(344,4,'QWERT333',51,2,'2016-01-01','9.00','0.00',1),(345,5,'QWERT333',52,3,'2016-01-01','0.00','0.00',1),(346,6,'QWERT333',57,1,'2016-01-01','9.00','0.00',1),(347,6,'QWERT333',57,2,'2016-01-01','9.00','0.00',1),(348,7,'QWERT333',58,3,'2016-01-01','0.00','0.00',1),(349,1,'QWERT333',1,1,'2016-02-01','9.00','0.00',1),(350,1,'QWERT333',1,2,'2016-02-01','9.00','0.00',1),(351,2,'QWERT333',2,3,'2016-02-01','0.00','0.00',1),(352,3,'QWERT333',48,1,'2016-02-01','9.00','0.00',1),(353,3,'QWERT333',48,2,'2016-02-01','9.00','0.00',1),(354,3,'QWERT333',48,3,'2016-02-01','0.00','0.00',1),(355,4,'QWERT333',51,1,'2016-02-01','9.00','0.00',1),(356,4,'QWERT333',51,2,'2016-02-01','9.00','0.00',1),(357,5,'QWERT333',52,3,'2016-02-01','0.00','0.00',1),(358,6,'QWERT333',57,1,'2016-02-01','9.00','0.00',1),(359,6,'QWERT333',57,2,'2016-02-01','9.00','0.00',1),(360,7,'QWERT333',58,3,'2016-02-01','0.00','0.00',1),(361,1,'QWERT333',1,1,'2016-03-01','9.00','0.00',1),(362,1,'QWERT333',1,2,'2016-03-01','9.00','0.00',1),(363,2,'QWERT333',2,3,'2016-03-01','0.00','0.00',1),(364,3,'QWERT333',48,1,'2016-03-01','9.00','0.00',1),(365,3,'QWERT333',48,2,'2016-03-01','9.00','0.00',1),(366,3,'QWERT333',48,3,'2016-03-01','0.00','0.00',1),(367,4,'QWERT333',51,1,'2016-03-01','9.00','0.00',1),(368,4,'QWERT333',51,2,'2016-03-01','9.00','0.00',1),(369,5,'QWERT333',52,3,'2016-03-01','0.00','0.00',1),(370,6,'QWERT333',57,1,'2016-03-01','9.00','0.00',1),(371,6,'QWERT333',57,2,'2016-03-01','9.00','0.00',1),(372,7,'QWERT333',58,3,'2016-03-01','0.00','0.00',1),(373,1,'QWERT333',1,1,'2016-04-01','9.00','180.00',1),(374,1,'QWERT333',1,2,'2016-04-01','9.00','90.00',1),(375,2,'QWERT333',2,3,'2016-04-01','0.00','0.00',1),(376,3,'QWERT333',48,1,'2016-04-01','9.00','180.00',1),(377,3,'QWERT333',48,2,'2016-04-01','9.00','90.00',1),(378,3,'QWERT333',48,3,'2016-04-01','0.00','0.00',1),(379,4,'QWERT333',51,1,'2016-04-01','9.00','180.00',1),(380,4,'QWERT333',51,2,'2016-04-01','9.00','90.00',1),(381,5,'QWERT333',52,3,'2016-04-01','0.00','0.00',1),(382,6,'QWERT333',57,1,'2016-04-01','9.00','180.00',1),(383,6,'QWERT333',57,2,'2016-04-01','9.00','90.00',1),(384,7,'QWERT333',58,3,'2016-04-01','0.00','0.00',1),(385,1,'QWERT333',1,1,'2016-05-01','9.00','180.00',1),(386,1,'QWERT333',1,2,'2016-05-01','9.00','90.00',1),(387,2,'QWERT333',2,3,'2016-05-01','0.00','0.00',1),(388,3,'QWERT333',48,1,'2016-05-01','9.00','180.00',1),(389,3,'QWERT333',48,2,'2016-05-01','9.00','90.00',1),(390,3,'QWERT333',48,3,'2016-05-01','0.00','0.00',1),(391,4,'QWERT333',51,1,'2016-05-01','9.00','180.00',1),(392,4,'QWERT333',51,2,'2016-05-01','9.00','90.00',1),(393,5,'QWERT333',52,3,'2016-05-01','0.00','0.00',1),(394,6,'QWERT333',57,1,'2016-05-01','9.00','180.00',1),(395,6,'QWERT333',57,2,'2016-05-01','9.00','90.00',1),(396,7,'QWERT333',58,3,'2016-05-01','0.00','0.00',1),(397,1,'QWERT333',1,1,'2016-06-01','9.00','180.00',1),(398,1,'QWERT333',1,2,'2016-06-01','9.00','90.00',1),(399,2,'QWERT333',2,3,'2016-06-01','0.00','0.00',1),(400,3,'QWERT333',48,1,'2016-06-01','9.00','180.00',1),(401,3,'QWERT333',48,2,'2016-06-01','9.00','90.00',1),(402,3,'QWERT333',48,3,'2016-06-01','0.00','0.00',1),(403,4,'QWERT333',51,1,'2016-06-01','9.00','180.00',1),(404,4,'QWERT333',51,2,'2016-06-01','9.00','90.00',1),(405,5,'QWERT333',52,3,'2016-06-01','0.00','0.00',1),(406,6,'QWERT333',57,1,'2016-06-01','9.00','180.00',1),(407,6,'QWERT333',57,2,'2016-06-01','9.00','90.00',1),(408,7,'QWERT333',58,3,'2016-06-01','0.00','0.00',1),(409,1,'QWERT333',1,1,'2016-07-01','9.00','180.00',1),(410,1,'QWERT333',1,2,'2016-07-01','9.00','90.00',1),(411,2,'QWERT333',2,3,'2016-07-01','0.00','0.00',1),(412,3,'QWERT333',48,1,'2016-07-01','9.00','180.00',1),(413,3,'QWERT333',48,2,'2016-07-01','9.00','90.00',1),(414,3,'QWERT333',48,3,'2016-07-01','0.00','0.00',1),(415,4,'QWERT333',51,1,'2016-07-01','9.00','180.00',1),(416,4,'QWERT333',51,2,'2016-07-01','9.00','90.00',1),(417,5,'QWERT333',52,3,'2016-07-01','0.00','0.00',1),(418,6,'QWERT333',57,1,'2016-07-01','9.00','180.00',1),(419,6,'QWERT333',57,2,'2016-07-01','9.00','90.00',1),(420,7,'QWERT333',58,3,'2016-07-01','0.00','0.00',1),(421,1,'QWERT333',1,1,'2016-08-01','0.00','0.00',1),(422,1,'QWERT333',1,2,'2016-08-01','0.00','0.00',1),(423,2,'QWERT333',2,3,'2016-08-01','0.00','0.00',1),(424,3,'QWERT333',48,1,'2016-08-01','0.00','0.00',1),(425,3,'QWERT333',48,2,'2016-08-01','0.00','0.00',1),(426,3,'QWERT333',48,3,'2016-08-01','0.00','0.00',1),(427,4,'QWERT333',51,1,'2016-08-01','0.00','0.00',1),(428,4,'QWERT333',51,2,'2016-08-01','0.00','0.00',1),(429,5,'QWERT333',52,3,'2016-08-01','0.00','0.00',1),(430,6,'QWERT333',57,1,'2016-08-01','0.00','0.00',1),(431,6,'QWERT333',57,2,'2016-08-01','0.00','0.00',1),(432,7,'QWERT333',58,3,'2016-08-01','0.00','0.00',1),(433,1,'QWERT333',1,1,'2016-09-01','0.00','0.00',1),(434,1,'QWERT333',1,2,'2016-09-01','0.00','0.00',1),(435,2,'QWERT333',2,3,'2016-09-01','0.00','0.00',1),(436,3,'QWERT333',48,1,'2016-09-01','0.00','0.00',1),(437,3,'QWERT333',48,2,'2016-09-01','0.00','0.00',1),(438,3,'QWERT333',48,3,'2016-09-01','0.00','0.00',1),(439,4,'QWERT333',51,1,'2016-09-01','0.00','0.00',1),(440,4,'QWERT333',51,2,'2016-09-01','0.00','0.00',1),(441,5,'QWERT333',52,3,'2016-09-01','0.00','0.00',1),(442,6,'QWERT333',57,1,'2016-09-01','0.00','0.00',1),(443,6,'QWERT333',57,2,'2016-09-01','0.00','0.00',1),(444,7,'QWERT333',58,3,'2016-09-01','0.00','0.00',1),(445,1,'QWERT333',1,1,'2016-10-01','0.00','0.00',1),(446,1,'QWERT333',1,2,'2016-10-01','0.00','0.00',1),(447,2,'QWERT333',2,3,'2016-10-01','0.00','0.00',1),(448,3,'QWERT333',48,1,'2016-10-01','0.00','0.00',1),(449,3,'QWERT333',48,2,'2016-10-01','0.00','0.00',1),(450,3,'QWERT333',48,3,'2016-10-01','0.00','0.00',1),(451,4,'QWERT333',51,1,'2016-10-01','0.00','0.00',1),(452,4,'QWERT333',51,2,'2016-10-01','0.00','0.00',1),(453,5,'QWERT333',52,3,'2016-10-01','0.00','0.00',1),(454,6,'QWERT333',57,1,'2016-10-01','0.00','0.00',1),(455,6,'QWERT333',57,2,'2016-10-01','0.00','0.00',1),(456,7,'QWERT333',58,3,'2016-10-01','0.00','0.00',1),(457,1,'QWERT333',1,1,'2016-11-01','0.00','0.00',1),(458,1,'QWERT333',1,2,'2016-11-01','0.00','0.00',1),(459,2,'QWERT333',2,3,'2016-11-01','0.00','0.00',1),(460,3,'QWERT333',48,1,'2016-11-01','0.00','0.00',1),(461,3,'QWERT333',48,2,'2016-11-01','0.00','0.00',1),(462,3,'QWERT333',48,3,'2016-11-01','0.00','0.00',1),(463,4,'QWERT333',51,1,'2016-11-01','0.00','0.00',1),(464,4,'QWERT333',51,2,'2016-11-01','0.00','0.00',1),(465,5,'QWERT333',52,3,'2016-11-01','0.00','0.00',1),(466,6,'QWERT333',57,1,'2016-11-01','0.00','0.00',1),(467,6,'QWERT333',57,2,'2016-11-01','0.00','0.00',1),(468,7,'QWERT333',58,3,'2016-11-01','0.00','0.00',1),(469,1,'QWERT333',1,1,'2016-12-01','0.00','0.00',1),(470,1,'QWERT333',1,2,'2016-12-01','0.00','0.00',1),(471,2,'QWERT333',2,3,'2016-12-01','0.00','0.00',1),(472,3,'QWERT333',48,1,'2016-12-01','0.00','0.00',1),(473,3,'QWERT333',48,2,'2016-12-01','0.00','0.00',1),(474,3,'QWERT333',48,3,'2016-12-01','0.00','0.00',1),(475,4,'QWERT333',51,1,'2016-12-01','0.00','0.00',1),(476,4,'QWERT333',51,2,'2016-12-01','0.00','0.00',1),(477,5,'QWERT333',52,3,'2016-12-01','0.00','0.00',1),(478,6,'QWERT333',57,1,'2016-12-01','0.00','0.00',1),(479,6,'QWERT333',57,2,'2016-12-01','0.00','0.00',1),(480,7,'QWERT333',58,3,'2016-12-01','0.00','0.00',1);

/*Table structure for table `bf_ishop_budget` */

CREATE TABLE `bf_ishop_budget` (
  `ishop_budget_id` int(11) NOT NULL AUTO_INCREMENT,
  `month_data` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `quantity` decimal(9,2) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`ishop_budget_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ishop_budget` */

insert  into `bf_ishop_budget`(`ishop_budget_id`,`month_data`,`customer_id`,`product_sku_id`,`quantity`,`country_id`,`created_by_user`,`modified_by_user`,`status`,`created_on`,`modified_on`) values (8,'2016-06-01',11,2,'123.00',NULL,45,NULL,1,'2016-06-06 12:11:51','2016-06-20 07:33:47'),(11,'2016-06-01',19,2,'8.00',101,45,NULL,1,'2016-06-06 12:17:16',NULL),(12,'2016-06-01',18,2,'9.00',101,45,NULL,1,'2016-06-06 12:18:19',NULL),(13,'2016-05-01',9,1,'15.00',101,45,45,1,'2016-06-14 12:38:06','2016-08-04 22:21:29'),(14,'2016-06-01',9,1,'12.00',101,45,45,1,'2016-06-14 12:38:06','2016-08-04 22:21:29'),(16,'2016-06-01',17,2,'1234.00',101,45,45,1,'2016-06-20 07:40:38','2016-06-20 07:50:28'),(17,'2016-05-01',36,1,'50.00',101,45,45,1,'2016-06-20 09:43:28','2016-06-20 10:18:34'),(18,'2016-01-01',10,2,'123.00',NULL,45,NULL,1,'2016-07-29 06:57:43',NULL),(19,'2016-01-01',10,1,'1234.00',NULL,45,NULL,1,'2016-07-29 06:57:43',NULL),(20,'2016-01-01',36,2,'123.00',NULL,45,NULL,1,'2016-07-29 06:57:43',NULL),(21,'2016-01-01',36,1,'1234.00',NULL,45,NULL,1,'2016-07-29 06:57:43',NULL),(22,'2016-02-01',10,2,'123.00',NULL,45,NULL,1,'2016-07-29 06:57:43',NULL),(23,'2016-02-01',10,1,'1234.00',NULL,45,NULL,1,'2016-07-29 06:57:43',NULL),(24,'2016-02-01',36,2,'123.00',NULL,45,NULL,1,'2016-07-29 06:57:43',NULL),(25,'2016-02-01',36,1,'1234.00',NULL,45,NULL,1,'2016-07-29 06:57:43',NULL),(26,'2016-06-01',10,1,'552.00',101,45,45,1,'2016-08-02 13:59:00','2016-08-02 13:59:49'),(27,'2016-05-01',11,1,'12123.00',101,45,NULL,1,'2016-08-03 13:32:08',NULL),(28,'2016-06-01',11,1,'12.00',101,45,NULL,1,'2016-08-03 13:54:15',NULL),(29,'2016-11-01',11,1,'12.00',101,45,45,1,'2016-08-03 14:01:11','2016-08-03 14:01:43'),(30,'2016-11-01',10,1,'121.00',101,45,NULL,1,'2016-08-03 14:01:57',NULL),(31,'2016-10-01',10,1,'12.00',101,45,NULL,1,'2016-08-03 14:05:33',NULL),(32,'2016-05-01',14,1,'10.00',NULL,45,NULL,1,'2016-08-04 10:22:48',NULL),(33,'2016-06-01',14,1,'200.00',NULL,45,NULL,1,'2016-08-04 10:22:48',NULL);

/*Table structure for table `bf_ishop_company_current_stock` */

CREATE TABLE `bf_ishop_company_current_stock` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `intrum_quantity` decimal(9,2) DEFAULT NULL,
  `unrestricted_quantity` decimal(9,2) DEFAULT NULL,
  `batch` varchar(255) DEFAULT NULL,
  `batch_exp_date` date DEFAULT NULL,
  `batch_mfg_date` date DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ishop_company_current_stock` */

insert  into `bf_ishop_company_current_stock`(`stock_id`,`date`,`product_sku_id`,`intrum_quantity`,`unrestricted_quantity`,`batch`,`batch_exp_date`,`batch_mfg_date`,`country_id`,`created_by_user`,`modified_by_user`,`status`,`created_on`,`modified_on`) values (1,'2016-08-01',1,'212.00','321.00','1234','2016-08-24','2016-08-17',101,45,45,1,'2016-07-23 09:55:39','2016-08-02 14:08:34'),(2,'2016-08-24',2,'5212.00','1221.00','221','2016-08-31','2016-08-31',101,45,45,1,'2016-07-23 10:01:20','2016-08-03 13:33:00');

/*Table structure for table `bf_ishop_company_current_stock_log` */

CREATE TABLE `bf_ishop_company_current_stock_log` (
  `current_stock_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `intransit_quantity` decimal(9,2) DEFAULT NULL,
  `unrestricted_quantity` decimal(9,2) DEFAULT NULL,
  `batch` varchar(255) DEFAULT NULL,
  `batch_exp_date` date DEFAULT NULL,
  `batch_mfg_date` date DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `log_date` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`current_stock_log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ishop_company_current_stock_log` */

insert  into `bf_ishop_company_current_stock_log`(`current_stock_log_id`,`stock_id`,`date`,`product_sku_id`,`intransit_quantity`,`unrestricted_quantity`,`batch`,`batch_exp_date`,`batch_mfg_date`,`country_id`,`created_by_user`,`modified_by_user`,`log_date`,`status`,`created_on`,`modified_on`) values (1,1,'2016-06-26',1,'12312.00','12312.00','1231ds','2016-08-01','2016-06-26',101,45,0,'2016-07-23 09:55:39',1,'2016-07-23 09:55:39',NULL),(2,1,'2016-07-03',1,'1231.00','123.00','1231','2016-08-04','2016-07-18',101,45,0,'2016-07-23 09:59:36',1,'2016-07-23 09:59:36',NULL),(3,1,NULL,1,'1231111.00','123111.00','123111','2016-08-04','2016-07-18',101,45,45,'2016-07-23 10:00:13',1,'2016-07-23 10:00:13','2016-07-23 10:00:13'),(4,2,'2016-07-04',2,'1231.00','1231.00','1231','2016-08-02','2016-07-03',101,45,0,'2016-07-23 10:01:20',1,'2016-07-23 10:01:20',NULL),(5,3,'2016-05-29',3,'1231.00','1231.00','1231ds','2016-08-03','2016-07-03',101,45,0,'2016-07-23 10:01:38',1,'2016-07-23 10:01:38',NULL),(6,3,NULL,3,'1231.00','1231.00','','1970-01-01','1970-01-01',101,45,45,'2016-07-25 10:26:26',1,'2016-07-25 10:26:26','2016-07-25 10:26:26'),(7,3,'2016-06-26',3,'12312.00','1231.00','wqer345','2016-10-31','2016-04-24',101,45,45,'2016-07-25 10:28:20',1,'2016-07-25 10:28:20',NULL),(8,1,'2016-07-27',1,'90.00','90.00','990','2016-07-27','2016-07-29',101,45,45,'2016-07-27 12:25:52',1,'2016-07-27 12:25:52',NULL),(9,1,'2016-06-27',1,'190.00','190.00','190','2016-06-27','2016-06-29',101,45,45,'2016-07-27 12:39:21',1,'2016-07-27 12:39:21',NULL),(10,3,NULL,3,'12312.00','1231.00','wqer345','1970-01-01','1970-01-01',101,45,45,'2016-07-28 12:32:57',1,'2016-07-28 12:32:57','2016-07-28 12:32:57'),(11,3,NULL,3,'12312.00','1231.00','wqer345','1970-01-01','1970-01-01',101,45,45,'2016-07-28 12:57:52',1,'2016-07-28 12:57:52','2016-07-28 12:57:52'),(12,3,NULL,3,'12312.00','1231.00','','1970-01-01','1970-01-01',101,45,45,'2016-07-28 12:58:35',1,'2016-07-28 12:58:35','2016-07-28 12:58:35'),(13,3,NULL,3,'12312.00','1231.00','123123','2016-07-20','1970-01-01',101,45,45,'2016-07-28 13:02:44',1,'2016-07-28 13:02:44','2016-07-28 13:02:44'),(14,1,'2016-07-27',1,'676776.00','767676.00','767667','2016-08-05','2016-07-27',101,45,45,'2016-07-28 18:26:54',1,'2016-07-28 18:26:54',NULL),(15,1,'2016-07-05',1,'234.00','65.00','65','2016-08-03','2016-07-25',101,45,45,'2016-07-29 15:23:06',1,'2016-07-29 15:23:06',NULL),(16,3,NULL,3,'12312.00','1231.00','123123','2016-08-31','2016-08-05',101,45,45,'2016-07-29 15:32:26',1,'2016-07-29 15:32:26','2016-07-29 15:32:26'),(17,3,NULL,3,'12312.00','1231.00','123123','1970-01-01','2016-08-10',101,45,45,'2016-07-29 15:33:34',1,'2016-07-29 15:33:34','2016-07-29 15:33:34'),(18,3,NULL,3,'12312.00','1231.00','123123','2016-09-21','2016-08-10',101,45,45,'2016-07-29 15:34:16',1,'2016-07-29 15:34:16','2016-07-29 15:34:16'),(19,3,NULL,3,'12312.00','1231.00','123123','1970-01-01','2016-08-25',101,45,45,'2016-07-29 15:35:08',1,'2016-07-29 15:35:08','2016-07-29 15:35:08'),(20,3,NULL,3,'12312.00','1231.00','123123','1970-01-01','2016-08-31',101,45,45,'2016-07-29 15:35:45',1,'2016-07-29 15:35:45','2016-07-29 15:35:45'),(21,3,NULL,3,'12312.00','1231.00','123123','2016-09-14','2016-09-01',101,45,45,'2016-07-29 15:36:42',1,'2016-07-29 15:36:42','2016-07-29 15:36:42'),(22,3,NULL,3,'12312.00','1231.00','123123','1970-01-01','1970-01-01',101,45,45,'2016-07-29 15:37:55',1,'2016-07-29 15:37:55','2016-07-29 15:37:55'),(23,3,NULL,3,'12312.00','1231.00','123123','1970-01-01','1970-01-01',101,45,45,'2016-07-29 15:42:42',1,'2016-07-29 15:42:42','2016-07-29 15:42:42'),(24,3,NULL,3,'12312.00','1231.00','123123','1970-01-01','1970-01-01',101,45,45,'2016-07-29 15:43:28',1,'2016-07-29 15:43:28','2016-07-29 15:43:28'),(25,3,NULL,3,'12312.00','1231.00','123123','2016-04-08','2016-07-26',101,45,45,'2016-07-29 15:44:03',1,'2016-07-29 15:44:03','2016-07-29 15:44:03'),(26,3,NULL,3,'12312.00','1231.00','123123','1970-01-01','2016-07-28',101,45,45,'2016-07-29 15:44:28',1,'2016-07-29 15:44:28','2016-07-29 15:44:28'),(27,1,'2016-04-24',1,'1212.00','5656.00','5','2016-07-29','2016-07-21',101,45,45,'2016-07-30 07:23:33',1,'2016-07-30 07:23:33',NULL),(28,1,'2016-04-24',1,'10.00','23.00','25','2016-06-29','2016-05-02',101,45,45,'2016-07-30 11:55:36',1,'2016-07-30 11:55:36',NULL),(29,2,NULL,2,'1231.00','1231.00','1231','2016-09-01','2016-08-23',101,45,45,'2016-08-01 17:44:47',1,'2016-08-01 17:44:47','2016-08-01 17:44:47'),(30,1,'2016-03-27',1,'100.00','25.00','14','2016-09-03','2016-04-24',101,45,45,'2016-08-02 10:38:19',1,'2016-08-02 10:38:19',NULL),(31,1,'2016-08-01',1,'212.00','321.00','1234','2016-08-24','2016-08-17',101,45,45,'2016-08-02 14:08:34',1,'2016-08-02 14:08:34',NULL),(32,2,NULL,2,'1231.00','1231.00','1231','2016-09-01','2016-08-23',101,45,45,'2016-08-02 14:08:42',1,'2016-08-02 14:08:42','2016-08-02 14:08:42'),(33,2,'2016-04-24',2,'25.00','35.00','15','2016-09-11','2016-09-03',101,45,45,'2016-08-02 13:08:01',1,'2016-08-02 13:08:01',NULL),(34,2,'2016-08-03',2,'212.00','121.00','312132','2016-08-31','2016-08-31',101,45,45,'2016-08-03 12:41:10',1,'2016-08-03 12:41:10',NULL),(35,2,'2016-08-24',2,'5212.00','1221.00','221','2016-08-31','2016-08-31',101,45,45,'2016-08-03 13:33:00',1,'2016-08-03 13:33:00',NULL);

/*Table structure for table `bf_ishop_credit_limit` */

CREATE TABLE `bf_ishop_credit_limit` (
  `credit_limit_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `credit_limit` decimal(9,2) DEFAULT NULL,
  `current_outstanding_limit` decimal(9,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`credit_limit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ishop_credit_limit` */

insert  into `bf_ishop_credit_limit`(`credit_limit_id`,`customer_id`,`credit_limit`,`current_outstanding_limit`,`date`,`country_id`,`created_by_user`,`modified_by_user`,`status`,`created_on`,`modified_on`) values (1,9,'46.00','456.00','2016-08-30',101,45,45,1,'2016-06-01 10:20:02','2016-08-03 12:41:42'),(2,11,'234.00','768.00','2016-06-26',101,45,0,1,'2016-06-01 12:03:40',NULL),(3,37,'456.00','1222222.00','2016-06-06',101,45,45,1,'2016-06-01 12:04:02','2016-06-07 19:39:58'),(4,10,'121.00','12.00','2016-08-31',101,45,45,1,'2016-06-09 17:58:41','2016-08-03 13:33:13'),(5,12,'50.00','50.00','2016-06-23',101,45,0,1,'2016-06-14 05:31:47',NULL);

/*Table structure for table `bf_ishop_credit_limit_log` */

CREATE TABLE `bf_ishop_credit_limit_log` (
  `credit_limit_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `credit_limit_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `credit_limit` decimal(9,2) DEFAULT NULL,
  `current_outstanding_limit` decimal(9,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `log_date` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`credit_limit_log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ishop_credit_limit_log` */

insert  into `bf_ishop_credit_limit_log`(`credit_limit_log_id`,`credit_limit_id`,`customer_id`,`credit_limit`,`current_outstanding_limit`,`date`,`country_id`,`created_by_user`,`modified_by_user`,`log_date`,`status`,`created_on`,`modified_on`) values (1,1,9,'123.00','123.00','2016-06-26',101,45,0,'2016-06-01 10:20:02',1,'2016-06-01 10:20:02',NULL),(2,1,9,'456.00','456.00','2016-06-27',101,45,0,'2016-06-01 10:31:58',1,'2016-06-01 10:31:58',NULL),(3,2,11,'234.00','768.00','2016-06-26',101,45,0,'2016-06-01 12:03:40',1,'2016-06-01 12:03:40',NULL),(4,3,37,'1546.00','89098.00','2016-06-27',101,45,0,'2016-06-01 12:04:02',1,'2016-06-01 12:04:02',NULL),(5,3,37,'12312.00','1231.00','2016-06-06',101,45,0,'2016-06-07 19:39:28',1,'2016-06-07 19:39:28',NULL),(6,3,37,'456.00','1222222.00','2016-06-06',101,45,0,'2016-06-07 19:39:58',1,'2016-06-07 19:39:58',NULL),(7,1,9,'1000.00','500.00','2016-06-08',101,45,0,'2016-06-09 17:58:41',1,'2016-06-09 17:58:41',NULL),(8,4,10,'2000.00','1000.00','2016-06-09',101,45,0,'2016-06-09 17:58:41',1,'2016-06-09 17:58:41',NULL),(9,1,9,'3000.00','1500.00','2016-06-10',101,45,0,'2016-06-09 17:58:41',1,'2016-06-09 17:58:41',NULL),(10,1,9,'4000.00','2000.00','2016-06-11',101,45,0,'2016-06-09 17:58:41',1,'2016-06-09 17:58:41',NULL),(11,4,10,'50.00','50.00','2016-06-23',101,45,0,'2016-06-14 05:30:58',1,'2016-06-14 05:30:58',NULL),(12,5,12,'50.00','50.00','2016-06-23',101,45,0,'2016-06-14 05:31:47',1,'2016-06-14 05:31:47',NULL),(13,1,9,'1.00','5.00','2016-06-08',101,45,0,'2016-06-14 16:39:12',1,'2016-06-14 16:39:12',NULL),(14,4,10,'2.00','6.00','2016-06-09',101,45,0,'2016-06-14 16:39:12',1,'2016-06-14 16:39:12',NULL),(15,1,9,'3.00','7.00','2016-06-10',101,45,0,'2016-06-14 16:39:12',1,'2016-06-14 16:39:12',NULL),(16,1,9,'4.00','8.00','2016-06-11',101,45,0,'2016-06-14 16:39:13',1,'2016-06-14 16:39:13',NULL),(17,1,9,'1231.00','12312.00','2016-06-20',101,45,0,'2016-06-22 11:10:26',1,'2016-06-22 11:10:26',NULL),(18,1,9,'76.00','876.00','2016-07-20',101,45,0,'2016-07-29 16:22:00',1,'2016-07-29 16:22:00',NULL),(19,4,10,'12.00','14.00','2016-04-24',101,45,0,'2016-07-30 11:16:38',1,'2016-07-30 11:16:38',NULL),(20,4,10,'10.00','25.00','2016-07-31',101,45,0,'2016-08-02 10:39:30',1,'2016-08-02 10:39:30',NULL),(21,4,10,'1212.00','212.00','2016-08-16',101,45,0,'2016-08-02 14:10:05',1,'2016-08-02 14:10:05',NULL),(22,4,10,'50.00','50.00','2016-08-02',101,45,0,'2016-08-02 13:08:56',1,'2016-08-02 13:08:56',NULL),(23,1,9,'46.00','456.00','2016-08-30',101,45,0,'2016-08-03 12:41:42',1,'2016-08-03 12:41:42',NULL),(24,4,10,'121.00','12.00','2016-08-31',101,45,0,'2016-08-03 13:33:13',1,'2016-08-03 13:33:13',NULL);

/*Table structure for table `bf_ishop_orders` */

CREATE TABLE `bf_ishop_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id_from` int(11) DEFAULT NULL,
  `customer_id_to` int(11) DEFAULT NULL,
  `order_taken_by_id` int(11) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `total_amount` decimal(9,2) DEFAULT NULL,
  `estimated_delivery_date` datetime DEFAULT NULL,
  `PO_no` varchar(255) DEFAULT NULL,
  `order_tracking_no` varchar(255) DEFAULT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `invoice_date` datetime DEFAULT NULL,
  `order_status` tinyint(1) DEFAULT NULL,
  `order_recived_status` tinyint(1) DEFAULT NULL,
  `read_status` tinyint(1) DEFAULT '0',
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ishop_orders` */

insert  into `bf_ishop_orders`(`order_id`,`customer_id_from`,`customer_id_to`,`order_taken_by_id`,`order_date`,`total_amount`,`estimated_delivery_date`,`PO_no`,`order_tracking_no`,`invoice_no`,`invoice_date`,`order_status`,`order_recived_status`,`read_status`,`country_id`,`created_by_user`,`modified_by_user`,`status`,`created_on`,`modified_on`) values (1,0,0,45,'2016-07-01','50.00',NULL,NULL,'O903865',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-07-01 10:17:35',NULL),(2,16,10,45,'2016-07-01','50.00',NULL,NULL,'O350360',NULL,NULL,3,NULL,0,101,45,NULL,1,'2016-07-01 10:18:24',NULL),(4,14,9,14,'2016-07-01','50.00',NULL,'123','O483490',NULL,NULL,4,NULL,0,101,14,NULL,1,'2016-07-01 10:30:39','2016-07-11 09:06:51'),(5,4,14,20,'2016-07-05','50.00',NULL,NULL,'O601192',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-01 10:39:44',NULL),(6,16,10,20,'2016-07-01','50.00',NULL,'1231','O723163',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-01 10:40:27',NULL),(7,4,14,20,'2016-07-04','50.00',NULL,NULL,'O134177',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-01 10:47:03',NULL),(8,9,0,20,'2016-07-01','50.00',NULL,'1231','O183423',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-01 10:48:07',NULL),(9,0,0,45,'2016-07-01','100.00',NULL,NULL,'O506217',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-07-01 11:34:50',NULL),(10,0,0,45,'2016-07-01','100.00',NULL,NULL,'O734943',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-07-01 11:36:14',NULL),(11,0,0,45,'2016-07-01','50.00',NULL,NULL,'O488087',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-07-01 11:37:04',NULL),(12,10,0,45,'2016-07-01','100.00',NULL,NULL,'O195618',NULL,NULL,3,NULL,0,101,45,NULL,1,'2016-07-01 11:45:58',NULL),(13,11,0,45,'2016-07-01','150.00',NULL,NULL,'O623312',NULL,NULL,3,NULL,0,101,45,NULL,1,'2016-07-01 11:46:32',NULL),(14,36,0,45,'2016-07-01','300.00',NULL,NULL,'O797756',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-07-01 12:00:52',NULL),(15,10,0,45,'2016-07-05','12300.00',NULL,NULL,'O956642',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-07-05 07:34:18',NULL),(16,17,11,45,'2016-07-05','556667.00',NULL,NULL,'O627071',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-07-05 07:36:31',NULL),(17,9,0,9,'2016-07-11','0.00',NULL,'98','O829426',NULL,NULL,0,NULL,0,101,9,NULL,1,'2016-07-11 10:02:41','2016-07-23 08:45:02'),(18,9,0,9,'2016-07-11','0.00',NULL,'345','O333611',NULL,NULL,0,NULL,0,101,9,NULL,1,'2016-07-11 10:03:45','2016-07-19 06:23:31'),(19,9,0,9,'2016-07-11','0.00',NULL,'89','O102740',NULL,NULL,0,NULL,0,101,9,NULL,1,'2016-07-11 10:07:34','2016-07-23 08:44:55'),(20,9,0,9,'2016-07-11','0.00',NULL,'4','O646762',NULL,NULL,1,NULL,0,101,9,NULL,1,'2016-07-11 10:16:44','2016-07-19 06:23:45'),(21,9,0,9,'2016-07-11','0.00',NULL,'99','O300986',NULL,NULL,0,NULL,0,101,9,NULL,1,'2016-07-11 10:17:45','2016-07-23 08:45:16'),(22,9,0,9,'2016-07-11','0.00',NULL,'34','O496159',NULL,NULL,1,NULL,0,101,9,NULL,1,'2016-07-11 11:17:56','2016-07-23 08:45:09'),(23,0,0,45,'2016-07-12','1550.00',NULL,NULL,'O221546',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-07-12 13:24:43',NULL),(24,0,0,45,'2016-07-12','900.00',NULL,NULL,'O452306',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-07-12 14:53:28',NULL),(25,9,0,45,'2016-07-12','80000.00',NULL,'67877','O364111',NULL,NULL,1,NULL,0,101,45,NULL,1,'2016-07-12 15:03:40',NULL),(26,10,0,45,'2016-07-15','0.00',NULL,NULL,'O757962',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-07-15 16:39:37',NULL),(27,11,0,45,'2016-07-15','0.00',NULL,NULL,'O250768',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-07-15 16:41:14',NULL),(28,10,0,45,'2016-07-15','0.00',NULL,NULL,'O182305',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-07-15 16:42:28',NULL),(29,0,0,45,'2016-07-15','0.00',NULL,NULL,'O634895',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-07-15 16:42:50',NULL),(30,11,0,45,'2016-07-15','0.00',NULL,NULL,'O641244',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-07-15 16:43:42',NULL),(31,14,9,45,'2016-07-15','0.00',NULL,'2342','O358690',NULL,NULL,0,NULL,0,101,45,NULL,1,'2016-07-15 16:45:12',NULL),(32,4,14,20,'2016-07-18','12300.00',NULL,NULL,'O983179',NULL,NULL,4,NULL,1,101,20,NULL,1,'2016-07-15 15:22:42',NULL),(33,14,9,14,'2016-07-16','937.50',NULL,'111','O905218',NULL,NULL,0,NULL,1,101,14,NULL,1,'2016-07-16 13:35:34','2016-07-16 01:36:15'),(34,9,0,45,'2016-07-16','900.00',NULL,'45678','O910251',NULL,NULL,0,NULL,0,101,45,NULL,1,'2016-07-16 14:22:41',NULL),(35,14,9,14,'2016-07-16','750.00',NULL,'333','O428985',NULL,NULL,0,NULL,1,101,14,NULL,1,'2016-07-16 15:38:03','2016-07-16 03:39:44'),(36,14,9,14,'2016-07-16','600.00',NULL,'876','O792925',NULL,NULL,0,NULL,1,101,14,NULL,1,'2016-07-16 15:38:35','2016-07-16 03:40:16'),(37,14,9,14,'2016-07-16','900.00',NULL,'444','O677952',NULL,NULL,0,NULL,1,101,14,NULL,1,'2016-07-16 15:38:52','2016-07-16 03:39:58'),(38,14,9,14,'2016-07-16','150.00',NULL,'0987','O602235',NULL,NULL,0,NULL,1,101,14,NULL,1,'2016-07-16 15:39:10','2016-07-16 03:40:24'),(39,14,9,14,'2016-07-16','900.00',NULL,'8888','O746367',NULL,NULL,0,NULL,1,101,14,NULL,1,'2016-07-16 15:39:25','2016-07-27 05:54:14'),(40,14,9,14,'2016-07-19','7537.50',NULL,'678','O351882',NULL,NULL,0,NULL,1,101,14,NULL,1,'2016-07-19 16:36:37','2016-07-19 06:20:38'),(41,0,0,20,'2016-07-19','519425.00',NULL,NULL,'O172348',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-19 18:12:53',NULL),(42,9,0,20,'2016-07-19','66666.00',NULL,'1232','O339693',NULL,NULL,0,NULL,0,101,20,NULL,1,'2016-07-19 18:33:42',NULL),(44,16,10,20,'2016-07-20','0.00',NULL,'12311','O656773',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-20 14:51:17',NULL),(45,9,0,9,'2016-07-23','12200.00',NULL,'456789','O941442',NULL,NULL,1,NULL,0,101,9,NULL,1,'2016-07-23 08:53:30',NULL),(46,14,9,14,'2016-07-23','34650.00',NULL,'8788','O439620',NULL,NULL,0,NULL,0,101,14,NULL,1,'2016-07-23 14:08:15','2016-07-27 05:50:53'),(47,9,0,9,'2016-07-23','35750.00',NULL,'1212121','O585681',NULL,NULL,1,NULL,0,101,9,NULL,1,'2016-07-23 14:11:30',NULL),(48,14,9,45,'2016-07-23','0.00',NULL,'45454','O644449',NULL,NULL,0,NULL,0,101,45,NULL,1,'2016-07-23 14:13:45','2016-07-27 05:56:02'),(49,14,9,20,'2016-07-26','10000.00',NULL,'4567','O481957',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-26 12:22:59','2016-07-27 05:50:43'),(50,9,0,20,'2016-07-28','149850.00',NULL,NULL,'O292571',NULL,NULL,1,NULL,0,101,20,NULL,1,'2016-07-28 08:26:11',NULL),(51,16,10,20,'2016-07-28','386325.00',NULL,NULL,'O348154',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 08:31:11',NULL),(52,16,10,20,'2016-07-28','99900.00',NULL,NULL,'O251548',NULL,NULL,0,NULL,0,101,20,NULL,1,'2016-07-28 08:48:18',NULL),(53,16,10,20,'2016-07-28','101400.00',NULL,NULL,'O978407',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:21:37',NULL),(54,14,9,20,'2016-07-28','0.00',NULL,NULL,'O749066',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:22:01',NULL),(55,16,10,20,'2016-07-28','114900.00',NULL,NULL,'O793044',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:22:28',NULL),(56,17,11,20,'2016-07-28','118200.00',NULL,NULL,'O619831',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:23:35',NULL),(57,16,11,20,'2016-07-28','78700.00',NULL,NULL,'O347337',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:24:07',NULL),(58,19,13,20,'2016-07-28','7800.00',NULL,NULL,'O219132',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:24:26',NULL),(59,17,12,20,'2016-07-28','88537.50',NULL,NULL,'O309946',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:24:52',NULL),(60,17,12,20,'2016-07-28',NULL,NULL,NULL,'O303742',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:25:22',NULL),(61,17,12,20,'2016-07-28',NULL,NULL,NULL,'O695803',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:25:36',NULL),(62,17,12,20,'2016-07-28',NULL,NULL,NULL,'O564283',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:25:42',NULL),(63,17,12,20,'2016-07-28','999900.00',NULL,NULL,'O710693',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:26:16',NULL),(64,17,12,20,'2016-07-28','83250.00',NULL,NULL,'O728074',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:26:53',NULL),(65,17,13,20,'2016-07-28','83325.00',NULL,NULL,'O239642',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:27:19',NULL),(66,16,10,20,'2016-07-28','19150.00',NULL,NULL,'O679185',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:28:28',NULL),(67,16,10,20,'2016-07-28','76600.00',NULL,NULL,'O802343',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:29:03',NULL),(68,16,10,20,'2016-07-28','1663900.00',NULL,NULL,'O488403',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:29:26',NULL),(69,16,10,20,'2016-07-28','143625.00',NULL,NULL,'O570012',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:30:18',NULL),(70,16,10,20,'2016-07-28','737550.00',NULL,NULL,'O494776',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:31:33',NULL),(71,16,10,20,'2016-07-28','169725.00',NULL,NULL,'O973513',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:32:19',NULL),(72,16,10,20,'2016-07-28','39350.00',NULL,NULL,'O547265',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 09:33:13',NULL),(73,9,0,20,'2016-07-28','1900.00',NULL,'11','O157705',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 11:19:55',NULL),(74,9,0,20,'2016-07-28','887287.50',NULL,'55','O454253',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 11:20:35',NULL),(75,9,0,20,'2016-07-28','0.00',NULL,'6','O223951',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 11:20:59',NULL),(76,9,0,20,'2016-07-28','90000.00',NULL,'55','O831813',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 11:21:23',NULL),(77,9,0,20,'2016-07-28','133350.00',NULL,'467','O284912',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 11:21:59',NULL),(78,9,0,20,'2016-07-28','134700.00',NULL,'3','O376724',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 11:22:40',NULL),(79,9,0,20,'2016-07-28','0.00',NULL,'77','O393630',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-28 11:23:13',NULL),(80,9,0,20,'2016-07-28',NULL,NULL,'1','O158663',NULL,NULL,0,NULL,0,101,20,NULL,1,'2016-07-28 11:23:44',NULL),(81,4,14,20,'2016-07-27','123100.00',NULL,NULL,'O799802',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-07-29 16:59:54',NULL),(82,10,0,45,'2016-08-02','381450.00',NULL,NULL,'O375292',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-08-02 13:30:46',NULL),(83,14,9,45,'2016-08-02','135375.00',NULL,'111','O718792',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-08-02 13:31:23',NULL),(84,10,0,45,'2016-08-02','56300.00',NULL,NULL,'O954186',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-08-02 13:35:35',NULL),(85,9,0,9,'2016-08-02','3300.00',NULL,'21','O780081',NULL,NULL,1,NULL,0,101,9,NULL,1,'2016-08-02 14:15:56',NULL),(86,14,9,14,'2016-08-02','13525.00',NULL,NULL,'O514583',NULL,NULL,0,NULL,0,101,14,NULL,1,'2016-08-02 14:23:47',NULL),(87,5,14,20,'2016-08-18','83250.00',NULL,NULL,'O353760',NULL,NULL,0,NULL,0,101,20,NULL,1,'2016-08-02 14:28:30',NULL),(88,10,0,45,'2016-08-03','454500.00',NULL,NULL,'O217771',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-08-03 13:31:08',NULL),(89,10,0,45,'2016-08-03','53025.00',NULL,NULL,'O179279',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-08-03 13:51:09',NULL),(90,4,14,20,'1970-01-01','1200.00',NULL,NULL,'O625058',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-08-03 11:56:34',NULL),(91,4,14,20,'1970-01-01','300.00',NULL,NULL,'O629240',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-08-03 11:57:22',NULL),(92,4,14,20,'1970-01-01','1200.00',NULL,NULL,'O267205',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-08-03 12:00:19',NULL),(93,4,14,20,'2016-08-23','1200.00',NULL,NULL,'O570561',NULL,NULL,4,NULL,0,101,20,NULL,1,'2016-08-03 12:08:40',NULL),(94,4,14,20,'2016-08-22','1200.00',NULL,NULL,'O706537',NULL,NULL,0,NULL,0,101,20,NULL,1,'2016-08-03 12:10:35',NULL),(95,14,9,20,'2016-08-03','0.00',NULL,'12','O567679',NULL,NULL,0,NULL,0,101,20,NULL,1,'2016-08-03 14:25:19',NULL),(96,16,10,45,'2016-08-04','5500.00',NULL,NULL,'O321996',NULL,NULL,4,NULL,0,101,45,NULL,1,'2016-08-04 12:13:15',NULL),(97,4,14,20,'2016-12-24','7500.00',NULL,NULL,'O555303',NULL,NULL,NULL,NULL,0,101,20,NULL,1,'2016-08-04 15:31:54',NULL),(98,4,14,20,'2016-12-24','7500.00',NULL,NULL,'O175235',NULL,NULL,0,NULL,0,101,20,NULL,1,'2016-08-04 15:32:50',NULL),(99,16,10,20,'2016-08-05','1200.00',NULL,'dfgdf','O558827',NULL,NULL,0,NULL,0,101,20,NULL,1,'2016-08-05 11:31:46',NULL),(100,4,18,55,'2016-08-17','15400.00',NULL,NULL,'O985586',NULL,NULL,0,NULL,0,101,55,NULL,1,'2016-08-17 14:24:39',NULL),(101,4,18,55,'2016-08-17','10075.00',NULL,NULL,'O151204',NULL,NULL,0,NULL,0,101,55,NULL,1,'2016-08-17 14:28:04',NULL);

/*Table structure for table `bf_ishop_physical_stock` */

CREATE TABLE `bf_ishop_physical_stock` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_month` date DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `quantity` decimal(9,2) DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `qty_kgl` decimal(9,2) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ishop_physical_stock` */

insert  into `bf_ishop_physical_stock`(`stock_id`,`stock_month`,`product_sku_id`,`quantity`,`unit`,`qty_kgl`,`customer_id`,`created_by_user`,`modified_by_user`,`country_id`,`status`,`created_on`,`modified_on`) values (3,'2016-05-01',1,'12.00',NULL,NULL,9,9,NULL,101,1,'2016-05-23 06:56:39',NULL),(4,'2016-05-01',1,'12.00',NULL,NULL,9,9,NULL,101,1,'2016-05-23 06:56:39',NULL),(5,'2016-05-01',1,'12.00',NULL,NULL,10,20,NULL,101,1,'2016-05-23 15:21:52',NULL),(6,'2016-05-01',1,'12.00',NULL,NULL,10,20,NULL,101,1,'2016-05-23 15:21:52',NULL),(7,'2016-05-01',2,'1234.00',NULL,NULL,10,20,NULL,101,1,'2016-05-23 15:21:52',NULL),(8,'2016-05-01',2,'1234.00',NULL,NULL,10,20,NULL,101,1,'2016-05-23 15:21:52',NULL),(9,'2016-05-01',1,'11.00',NULL,NULL,10,20,NULL,101,1,'2016-05-23 15:23:31',NULL),(10,'2016-05-01',1,'11.00',NULL,NULL,10,20,NULL,101,1,'2016-05-23 15:23:31',NULL),(11,'2016-05-01',2,'22.00',NULL,NULL,10,20,NULL,101,1,'2016-05-23 15:23:31',NULL),(12,'2016-05-01',2,'22.00',NULL,NULL,10,20,NULL,101,1,'2016-05-23 15:23:31',NULL),(13,'2016-05-01',1,'5.00',NULL,NULL,10,20,NULL,101,1,'2016-05-23 15:27:18',NULL),(14,'2016-05-01',1,'5.00',NULL,NULL,10,20,NULL,101,1,'2016-05-23 15:27:18',NULL),(15,'2016-05-01',1,'6.00',NULL,NULL,10,20,NULL,101,1,'2016-05-23 15:27:18',NULL),(16,'2016-05-01',1,'6.00',NULL,NULL,10,20,NULL,101,1,'2016-05-23 15:27:18',NULL),(17,'2016-05-01',1,'5.00',NULL,NULL,10,20,NULL,101,1,'2016-05-23 15:27:59',NULL),(18,'2016-05-01',1,'6.00',NULL,NULL,10,20,NULL,101,1,'2016-05-23 15:27:59',NULL),(20,'2016-05-01',1,'5.00',NULL,NULL,14,20,NULL,101,1,'2016-05-23 15:55:36',NULL),(21,'2016-05-01',1,'6.00',NULL,NULL,14,20,NULL,101,1,'2016-05-23 15:55:36',NULL),(22,'2016-05-01',1,'6.00',NULL,NULL,14,20,NULL,101,1,'2016-05-23 15:55:37',NULL),(26,'2016-05-01',1,'45.00',NULL,NULL,17,20,NULL,101,1,'2016-05-23 15:57:58',NULL),(27,'2016-05-01',1,'67.00',NULL,NULL,17,20,NULL,101,1,'2016-05-23 15:58:53',NULL),(28,'2016-05-01',1,'67.00',NULL,NULL,17,20,NULL,101,1,'2016-05-23 15:58:53',NULL),(29,'2016-05-01',1,'78.00',NULL,NULL,17,20,NULL,101,1,'2016-05-23 15:58:53',NULL),(30,'2016-05-01',1,'78.00',NULL,NULL,17,20,NULL,101,1,'2016-05-23 15:58:53',NULL),(31,'2016-05-01',1,'56.00',NULL,NULL,17,20,NULL,101,1,'2016-05-23 16:02:07',NULL),(32,'2016-05-01',1,'87.00',NULL,NULL,17,20,NULL,101,1,'2016-05-23 16:02:07',NULL),(33,'2016-05-01',1,'77.00',NULL,NULL,18,20,NULL,101,1,'2016-05-23 16:03:12',NULL),(34,'2016-05-01',1,'77.00',NULL,NULL,18,20,NULL,101,1,'2016-05-23 16:03:12',NULL),(35,'2016-05-01',1,'44.00',NULL,NULL,18,20,NULL,101,1,'2016-05-23 16:03:12',NULL),(36,'2016-05-01',1,'44.00',NULL,NULL,18,20,NULL,101,1,'2016-05-23 16:03:12',NULL),(43,'2016-05-01',1,'123.00',NULL,NULL,12,12,NULL,101,1,'2016-05-24 06:54:46',NULL),(44,'2016-05-01',1,'999.00',NULL,NULL,12,12,NULL,101,1,'2016-05-24 06:56:08',NULL),(45,'2016-05-01',2,'555.00',NULL,NULL,12,12,NULL,101,1,'2016-05-24 06:56:09',NULL),(46,'2016-05-01',1,'123.00',NULL,NULL,14,14,NULL,101,1,'2016-05-24 07:03:16',NULL),(47,'2016-05-01',2,'11.00','box','2.75',14,14,14,101,1,'2016-05-24 07:03:16','2016-08-02 14:25:13'),(48,'2016-05-01',1,'88.00',NULL,NULL,18,20,NULL,101,1,'2016-05-24 07:04:25',NULL),(49,'2016-05-01',2,'44.00',NULL,NULL,11,20,NULL,101,1,'2016-05-24 07:05:24',NULL),(50,'2016-05-01',1,'33.00',NULL,NULL,11,20,NULL,101,1,'2016-05-24 07:05:24',NULL),(51,'2016-05-01',1,'12.00',NULL,NULL,17,20,NULL,101,1,'2016-05-30 05:49:11',NULL),(52,'2016-05-01',1,'23.00',NULL,NULL,10,20,NULL,101,1,'2016-05-30 05:49:39',NULL),(53,'2016-05-01',1,'122.00','kg/ltr','122.00',9,9,9,101,1,'2016-05-30 05:50:26','2016-06-11 07:22:59'),(54,'2016-05-01',1,'123.00','box','246.00',16,20,20,101,1,'2016-05-30 09:36:15','2016-06-09 07:43:35'),(55,'2016-06-01',1,'21.00','packages','10.50',9,9,9,101,1,'2016-06-07 15:18:30','2016-06-07 19:05:16'),(56,'2016-06-01',2,'32.00','box','8.00',9,9,NULL,101,1,'2016-06-07 15:19:14',NULL),(57,'2016-06-01',3,'21.00','box','26.25',14,14,NULL,101,1,'2016-06-07 15:20:12',NULL),(58,'2016-06-01',1,'545.00','box','1090.00',9,9,9,101,1,'2016-06-11 07:29:16','2016-08-02 14:21:19'),(59,'2016-06-01',1,'99.00','kg/ltr','99.00',9,9,9,101,1,'2016-06-11 07:29:16','2016-08-02 14:21:26'),(60,'2016-06-01',3,'23.00','box','28.75',9,9,9,101,1,'2016-06-11 07:29:16','2016-06-11 07:29:16'),(61,'2016-06-01',1,'5454.00','box','10908.00',14,14,14,101,1,'2016-06-11 07:31:42','2016-08-03 13:13:44'),(62,'2016-06-01',1,'666.00','kg/ltr','666.00',14,14,14,101,1,'2016-06-11 07:31:42','2016-08-02 19:37:52'),(63,'2016-06-01',3,'88.00','kg/ltr','88.00',14,14,14,101,1,'2016-06-11 07:31:42','2016-08-02 19:37:52'),(64,'2016-06-01',1,'23.00','box','46.00',12,12,12,101,1,'2016-06-11 07:36:09','2016-06-11 07:36:09'),(65,'2016-06-01',1,'23.00','kg/ltr','23.00',12,12,12,101,1,'2016-06-11 07:36:09','2016-06-11 07:36:09'),(66,'2016-06-01',3,'23.00','kg/ltr','23.00',12,12,12,101,1,'2016-06-11 07:36:09','2016-06-11 07:36:09'),(67,'2016-06-01',3,'100.00','packages','1000.00',9,9,9,101,1,'2016-06-14 17:32:36','2016-06-17 12:21:31'),(68,'2016-05-01',1,'200.00','box','2000.00',9,9,9,101,1,'2016-06-17 10:40:15','2016-06-17 12:21:31'),(69,'2016-06-01',2,'554.00','packages','831.00',9,9,9,101,1,'2016-06-17 10:40:32','2016-06-17 10:40:32'),(70,'2016-04-01',1,'14514.00','packages','7257.00',9,9,9,101,1,'2016-06-24 11:14:37','2016-08-02 14:21:49'),(71,'2016-07-01',1,'120.00','box','240.00',9,9,9,101,1,'2016-07-01 11:39:37','2016-07-01 11:39:37'),(72,'2016-07-01',2,'12312.00','kg/ltr','12312.00',9,9,9,101,1,'2016-07-01 11:40:06','2016-07-19 11:38:27'),(73,'2016-01-01',1,'525145.00','packages','262572.50',14,14,14,101,1,'2016-07-07 11:23:36','2016-08-02 14:24:48'),(74,'2016-06-01',2,'12.00','kg/ltr','12.00',14,14,14,101,1,'2016-08-03 12:49:29','2016-08-03 12:49:29'),(75,'2016-07-01',1,'12.00','packages','6.00',14,14,14,101,1,'2016-08-03 13:12:33','2016-08-03 13:12:33'),(76,'2016-02-01',1,'555.00','packages','277.50',14,14,14,101,1,'2016-08-03 13:16:13','2016-08-03 13:16:13'),(77,'2016-02-01',2,'555.00','packages','832.50',14,14,14,101,1,'2016-08-03 13:20:50','2016-08-03 13:20:50'),(78,'2016-08-01',1,'589.00','box','1178.00',9,9,9,101,1,'2016-08-15 18:01:48','2016-08-15 18:01:48');

/*Table structure for table `bf_ishop_primary_sales` */

CREATE TABLE `bf_ishop_primary_sales` (
  `primary_sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `PO_no` varchar(255) DEFAULT NULL,
  `order_tracking_no` varchar(255) DEFAULT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `total_amount` decimal(9,2) DEFAULT NULL,
  `invoice_recived_status` tinyint(1) NOT NULL DEFAULT '0',
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`primary_sales_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ishop_primary_sales` */

insert  into `bf_ishop_primary_sales`(`primary_sales_id`,`customer_id`,`PO_no`,`order_tracking_no`,`invoice_no`,`invoice_date`,`total_amount`,`invoice_recived_status`,`country_id`,`created_by_user`,`modified_by_user`,`status`,`created_on`,`modified_on`) values (3,9,'123','123','123','2016-05-23','2534.00',0,101,1,45,1,'2016-05-16 12:07:54','2016-07-06 09:27:11'),(4,10,'23432','23432','123','2016-05-30','87.00',0,101,45,NULL,1,'2016-05-16 12:15:11',NULL),(6,10,'323','323','32','2016-05-23','332.00',0,101,45,NULL,1,'2016-05-20 09:07:39',NULL),(7,10,'323','323','32','2016-05-23','332.00',0,101,45,NULL,1,'2016-05-20 09:07:39',NULL),(8,10,'53','543','tre','2016-05-23','123.00',0,101,45,NULL,1,'2016-05-20 14:40:55',NULL),(9,10,'53','543','tre','2016-05-23','123.00',0,101,45,NULL,1,'2016-05-20 14:40:55',NULL),(10,9,'32','12','1111','2016-05-31','12.00',1,101,45,9,1,'2016-05-31 06:50:21','2016-06-20 14:17:49'),(11,11,'123','21','1212','2016-05-29','123.00',0,101,45,45,1,'2016-05-31 06:53:30','2016-06-08 12:15:38'),(17,10,'PO1','OTN1','INVOICE1','2016-06-16','6000.00',0,101,10,NULL,1,'2016-06-10 05:49:26',NULL),(18,10,'PO2','OTN2','INVOICE2','2016-06-16','6000.00',0,101,10,NULL,1,'2016-06-10 06:54:59',NULL),(19,10,'PO1','OTN1','INVOICE1','2016-06-16','6000.00',0,101,10,NULL,1,'2016-06-10 07:42:36',NULL),(20,10,'PO1','OTN1','INVOICE1','2016-06-16','6000.00',0,101,10,NULL,1,'2016-06-10 07:54:10',NULL),(21,10,'PO1','OTN1','INVOICE1','2016-06-16','6000.00',0,101,3,NULL,1,'2016-06-10 10:02:32',NULL),(22,9,'456er5','wer123123','123123','2016-06-08',NULL,0,101,45,NULL,1,'2016-06-10 11:18:08',NULL),(23,10,'fg45k','qw123','45645','2016-06-09',NULL,0,101,45,NULL,1,'2016-06-10 11:18:08',NULL),(24,9,'k0y66','rert34534','876678','2016-06-10',NULL,0,101,45,NULL,1,'2016-06-10 11:18:08',NULL),(25,9,'5nm5u','345cf435','978678','2016-06-11',NULL,0,101,45,NULL,1,'2016-06-10 11:18:08',NULL),(26,9,'15','15','15','2016-06-22','0.00',0,101,45,NULL,1,'2016-06-10 11:34:18',NULL),(35,10,'fg45k11','qw1239967','123456452','2016-06-09','1000.00',0,101,45,NULL,1,'2016-06-10 11:59:13',NULL),(36,9,'k0y6609','rert3453432','7876678','2016-06-10','1500.00',1,101,45,9,1,'2016-06-10 11:59:13','2016-06-17 12:23:31'),(37,9,'5nm5u99','345cf43523','77876678','2016-06-11','2000.00',1,101,45,45,1,'2016-06-10 11:59:14','2016-08-09 16:47:07'),(38,10,'54','44','22','2016-06-10','35.00',0,101,45,NULL,1,'2016-06-10 12:52:48',NULL),(39,10,'54','44','22','2016-06-10','35.00',0,101,45,NULL,1,'2016-06-10 12:52:50',NULL),(40,10,'54','44','22','2016-06-10','35.00',0,101,45,NULL,1,'2016-06-10 12:52:51',NULL),(41,9,'55','525','54','2016-06-02','1211.00',0,101,45,3,1,'2016-06-10 12:53:22','2016-06-16 14:04:25'),(43,10,'P2','OTN2','A2','2016-06-23','-179.00',0,101,45,3,1,'2016-06-10 13:09:15','2016-06-11 12:35:02'),(44,13,'32','123','56','2016-06-23','5.00',0,101,45,NULL,1,'2016-06-20 09:24:27',NULL),(45,13,'4333','234','12377899','2016-06-13','112334.00',0,101,45,NULL,1,'2016-06-20 11:29:20',NULL),(46,12,'12312211','123312111','123123888888','2016-08-30','544.00',0,101,45,NULL,1,'2016-06-20 12:19:13',NULL),(47,10,'','','12111','2016-06-20','1231.00',0,101,45,NULL,1,'2016-06-22 07:20:50',NULL),(48,11,'','','123erwe','2016-06-27','1231.00',0,101,45,45,1,'2016-06-22 07:21:52','2016-08-02 05:09:25'),(49,12,'','1231','1231','2016-06-22','121.00',0,101,45,45,1,'2016-06-22 07:22:49','2016-08-02 05:09:25'),(50,35,'','','12111222','2016-06-27','122.00',0,101,45,45,1,'2016-06-22 07:24:08','2016-08-02 05:09:24'),(51,10,'1231','1231','44332','2016-06-27','1231.00',0,101,45,45,1,'2016-06-22 07:54:23','2016-08-02 13:29:03'),(52,9,'1231111111','123123','111','2016-06-27','1231.00',0,101,45,45,1,'2016-06-22 09:38:00','2016-08-02 05:09:24'),(53,9,'22233','222',NULL,'2016-06-30','56.00',0,101,45,45,1,'2016-06-22 16:19:11','2016-08-02 05:09:24'),(54,9,'','','444','2016-06-26','1231.00',0,101,45,45,1,'2016-07-23 06:39:22','2016-08-02 05:09:24'),(55,9,'123','','123','2016-05-23','2534.00',0,101,45,45,1,'2016-07-25 11:41:59','2016-08-02 05:09:24'),(56,9,'df','df','fgfg','2016-07-29','3333.00',0,101,45,45,1,'2016-07-29 07:13:13','2016-08-02 05:09:24'),(57,9,'tryured','drftyw','rftgyertyw','2016-07-19','232.00',0,101,45,45,1,'2016-07-29 07:16:14','2016-08-02 06:38:29'),(61,39,'350','1254','589','2016-06-26','2547896.00',0,101,45,NULL,1,'2016-08-02 07:19:57',NULL),(62,9,'55','525','500','2016-08-24','500.00',0,101,45,NULL,1,'2016-08-02 12:42:27',NULL),(63,9,'','','as','2016-08-31','22.00',0,101,45,NULL,1,'2016-08-02 10:45:17',NULL),(64,9,'','','11','2016-05-29','22.00',0,101,45,NULL,1,'2016-08-02 11:00:08',NULL),(65,9,'','','sfhkj','2016-08-23','563214.00',0,101,45,45,1,'2016-08-02 13:08:28','2016-08-02 13:21:59'),(66,10,'54','452','54541','2016-08-04','6.00',0,101,45,45,1,'2016-08-02 13:17:23','2016-08-03 13:30:22'),(67,9,'fgh','fgdh','fhdfgh','2016-08-16','500.00',0,101,45,45,1,'2016-08-02 13:17:45','2016-08-02 13:17:45'),(68,9,'dfgsdfg','dfgdf','dgdsfg','2016-08-09','212.00',0,101,45,NULL,1,'2016-08-02 13:19:53',NULL),(69,10,'','cvb','22dfcg','2016-08-20','54.00',0,101,45,45,1,'2016-08-02 13:20:18','2016-08-02 13:29:03'),(70,9,'','545','545','2016-08-03','121.00',0,101,45,NULL,1,'2016-08-03 13:25:27',NULL),(71,9,'21','121','55','2016-08-26','44.00',0,101,45,NULL,1,'2016-08-03 13:30:04',NULL);

/*Table structure for table `bf_ishop_primary_sales_product` */

CREATE TABLE `bf_ishop_primary_sales_product` (
  `primary_sales_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `primary_sales_id` int(11) DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `quantity` decimal(9,2) DEFAULT NULL,
  `dispatched_quantity` decimal(9,2) DEFAULT NULL,
  `amount` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`primary_sales_product_id`),
  KEY `primary_sales_id` (`primary_sales_id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ishop_primary_sales_product` */

insert  into `bf_ishop_primary_sales_product`(`primary_sales_product_id`,`primary_sales_id`,`product_sku_id`,`quantity`,`dispatched_quantity`,`amount`) values (6,4,2,'123.00','123.00','54.00'),(7,4,2,'23.00','43.00','33.00'),(8,5,2,'11.00','67.00','76.00'),(9,6,2,'3.00','3.00','332.00'),(10,7,2,'3.00','3.00','332.00'),(11,8,2,'543.00','60.00','123.00'),(12,9,1,'543.00','100.00','123.00'),(13,10,1,'12.00',NULL,'12.00'),(14,11,2,'12.00','123.00','123.00'),(25,17,1,'10.00','100.00','1000.00'),(26,17,2,'20.00','200.00','2000.00'),(27,17,3,'30.00','300.00','3000.00'),(28,18,1,'10.00','100.00','1000.00'),(29,18,2,'20.00','200.00','2000.00'),(30,18,3,'30.00','300.00','3000.00'),(31,19,1,'10.00','100.00','1000.00'),(32,19,2,'20.00','200.00','2000.00'),(33,19,3,'30.00','300.00','3000.00'),(34,20,1,'10.00','100.00','1000.00'),(35,20,2,'20.00','200.00','2000.00'),(36,20,3,'30.00','300.00','3000.00'),(37,21,1,'10.00','100.00','1000.00'),(38,21,2,'20.00','200.00','2000.00'),(39,21,3,'30.00','300.00','3000.00'),(40,22,2,'123.00','123.00','500.00'),(41,23,2,'546.00','500.00','1000.00'),(42,24,1,'23.00','23.00','1500.00'),(43,25,3,'54.00','54.00','2000.00'),(55,35,2,'546.00','500.00','1000.00'),(56,36,1,'23.00','23.00','1500.00'),(57,37,3,'40.00','50.00','3000.00'),(58,37,2,'50.00','40.00','2000.00'),(59,37,1,'23.00','23.00','1500.00'),(60,38,2,'55.00','44.00','35.00'),(61,39,2,'55.00','44.00','35.00'),(62,40,2,'55.00','44.00','35.00'),(63,41,1,'12.00','12.00','1211.00'),(64,42,1,'12.00','12.00','1211.00'),(66,44,2,'1.00','10.00','100.00'),(67,44,3,'3.00','3.00','5.00'),(70,45,1,'1233.00','111221.00','112334.00'),(71,46,2,'1212.00','345.00','544.00'),(72,47,2,'12312.00','12312.00','1231.00'),(73,48,2,'1231.00','1231.00','1231.00'),(75,49,2,'2342.00','123332.00','121.00'),(76,50,2,'1231.00','122233.00','122.00'),(77,51,2,'1231.00','1231.00','1231.00'),(78,52,1,'1231.00','1231.00','1231.00'),(79,53,1,'1211.00','234.00','56.00'),(83,3,2,'1232.00','4356.00','2222.00'),(84,3,2,'123.00','321.00','312.00'),(85,54,1,'0.00','1231.00','1231.00'),(86,55,2,'1232.00','4356.00','2222.00'),(87,55,2,'123.00','321.00','312.00'),(88,56,1,'32.00','23.00','3333.00'),(89,57,2,'2342.00','2342.00','232.00'),(90,58,2,'6.00','6.00','6.00'),(91,59,2,'7.00','7.00','7.00'),(92,60,1,'123.00','345.00','5.00'),(93,61,1,'154.00','152.00','2547896.00'),(94,62,1,'121.00','12.00','500.00'),(95,63,2,'2.00','2.00','22.00'),(96,64,1,'22.00','22.00','22.00'),(98,65,1,'40.00','562.00','563214.00'),(99,66,1,'54.00','54.00','6.00'),(102,67,2,'121.00','12.00','500.00'),(103,68,1,'5614.00','121.00','212.00'),(104,69,2,'54.00','54.00','54.00'),(105,70,1,'454.00','152121.00','121.00'),(106,71,1,'52121.00','454.00','44.00');

/*Table structure for table `bf_ishop_product_order` */

CREATE TABLE `bf_ishop_product_order` (
  `product_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_sku_id` int(11) NOT NULL,
  `unit` varchar(30) DEFAULT NULL,
  `quantity` decimal(9,2) DEFAULT NULL,
  `quantity_kg_ltr` decimal(9,2) DEFAULT NULL,
  `dispatched_quantity` decimal(9,2) DEFAULT NULL,
  `amount` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`product_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ishop_product_order` */

insert  into `bf_ishop_product_order`(`product_order_id`,`order_id`,`product_sku_id`,`unit`,`quantity`,`quantity_kg_ltr`,`dispatched_quantity`,`amount`) values (1,1,1,'box','5.00','10.00',NULL,'50.00'),(2,2,1,'packages','5666.00','2833.00',NULL,'50.00'),(3,3,1,'box','5.00','10.00',NULL,'50.00'),(4,4,1,'box','8.00','16.00',NULL,'50.00'),(5,5,1,'box','7.00','14.00',NULL,'50.00'),(6,6,1,'box','7.00','14.00',NULL,'50.00'),(7,7,1,'packages','50.00','25.00',NULL,'50.00'),(8,8,1,'packages','50.00','25.00',NULL,'50.00'),(9,9,2,'packages','7.00','10.50',NULL,'100.00'),(10,10,2,'kg/ltr','77.00','77.00',NULL,'100.00'),(11,11,1,'packages','88.00','44.00',NULL,'50.00'),(12,12,2,'kg/ltr','78.00','117.00',NULL,'100.00'),(13,13,3,'packages','12.00','9.00',NULL,'150.00'),(14,14,3,'kg/ltr','45.00','45.00',NULL,'150.00'),(15,14,2,'box','55.00','13.75',NULL,'100.00'),(16,14,1,'packages','66.00','33.00',NULL,'50.00'),(17,15,1,'box','6666.00','13332.00','6666.00','12300.00'),(18,16,2,'box','67676.00','16919.00',NULL,'556667.00'),(19,23,1,'box','5.00','10.00',NULL,'500.00'),(20,23,2,'packages','7.00','10.50',NULL,'1050.00'),(21,24,1,'box','7.00','14.00',NULL,'700.00'),(22,24,1,'packages','8.00','4.00',NULL,'200.00'),(23,25,1,'box','800.00','1600.00','800.00','80000.00'),(24,32,1,'box','123.00','246.00',NULL,'12300.00'),(25,33,3,'box','5.00','6.25',NULL,'23.00'),(27,34,2,'packages','6.00','9.00',NULL,'900.00'),(28,35,2,'packages','5.00','7.50',NULL,'750.00'),(29,36,2,'kg/ltr','6.00','6.00',NULL,'600.00'),(30,37,3,'kg/ltr','6.00','6.00',NULL,'900.00'),(31,38,2,'box','6.00','1.50',NULL,'150.00'),(32,39,3,'kg/ltr','6.00','6.00',NULL,'900.00'),(33,40,3,'packages','67.00','50.25',NULL,'7537.50'),(34,41,2,'kg/ltr','5000.00','5000.00',NULL,'500000.00'),(35,41,1,'packages','777.00','388.50',NULL,'19425.00'),(36,42,1,'kg/ltr','77777.00','77777.00','666.00','66666.00'),(37,42,2,'packages','88888.00','133332.00','444.00','1166555.00'),(38,42,3,'kg/ltr','22222.00','22222.00','333.00','1498555.00'),(41,44,1,'box','8888.00','17776.00',NULL,'123100.00'),(42,45,1,'box','67.00','134.00','222.00','6700.00'),(43,45,2,'kg/ltr','55.00','55.00','2222.00','5500.00'),(44,46,1,'box','66.00','132.00',NULL,'6600.00'),(45,46,2,'packages','88.00','132.00',NULL,'13200.00'),(46,46,3,'kg/ltr','99.00','99.00',NULL,'14850.00'),(47,47,1,'box','77.00','154.00','121.00','7700.00'),(48,47,2,'packages','88.00','132.00','9.00','13200.00'),(49,47,3,'kg/ltr','99.00','99.00','2.00','14850.00'),(50,48,1,'packages','777777.00','388888.50',NULL,'1100.00'),(51,48,2,'kg/ltr','4511.00','4511.00',NULL,'5622.00'),(52,48,3,'box','999999.00','1249998.75',NULL,'11111.00'),(53,49,1,'box','100.00','200.00',NULL,'10000.00'),(54,50,3,'kg/ltr','999.00','999.00',NULL,'149850.00'),(55,51,3,'packages','3434.00','2575.50',NULL,'386325.00'),(56,52,2,'kg/ltr','987768.00','987768.00',NULL,'99900.00'),(57,53,2,'packages','676.00','1014.00',NULL,'101400.00'),(58,54,2,'kg/ltr','665.00','997.50',NULL,'99750.00'),(59,55,2,'packages','766.00','1149.00',NULL,'114900.00'),(60,56,2,'packages','788.00','1182.00',NULL,'118200.00'),(61,57,1,'box','787.00','1574.00',NULL,'78700.00'),(62,58,2,'kg/ltr','78.00','78.00',NULL,'7800.00'),(63,59,3,'packages','787.00','590.25',NULL,'88537.50'),(64,63,2,'packages','6666.00','9999.00',NULL,'999900.00'),(65,64,2,'packages','555.00','832.50',NULL,'83250.00'),(66,65,2,'box','3333.00','833.25',NULL,'83325.00'),(67,66,1,'packages','766.00','383.00',NULL,'19150.00'),(68,67,2,'kg/ltr','766.00','766.00',NULL,'76600.00'),(69,68,1,'packages','66556.00','33278.00',NULL,'1663900.00'),(70,69,3,'box','766.00','957.50',NULL,'143625.00'),(71,70,3,'packages','6556.00','4917.00',NULL,'737550.00'),(72,71,1,'packages','6789.00','3394.50',NULL,'169725.00'),(73,72,1,'kg/ltr','787.00','787.00',NULL,'39350.00'),(74,73,2,'box','76.00','19.00',NULL,'1900.00'),(75,74,3,'packages','7887.00','5915.25',NULL,'887287.50'),(76,75,1,'box','89.00','178.00',NULL,'8900.00'),(77,76,1,'box','900.00','1800.00',NULL,'90000.00'),(78,77,2,'packages','889.00','1333.50',NULL,'133350.00'),(79,78,2,'packages','898.00','1347.00',NULL,'134700.00'),(81,81,1,'box','1231.00','2462.00',NULL,'123100.00'),(82,82,2,'kg/ltr','2543.00','3814.50',NULL,'381450.00'),(83,83,2,'box','5415.00','1353.75',NULL,'135375.00'),(84,84,1,'box','563.00','1126.00',NULL,'56300.00'),(85,85,1,'packages','132.00','66.00',NULL,'3300.00'),(86,86,1,'packages','541.00','270.50',NULL,'13525.00'),(87,87,2,'packages','555.00','832.50',NULL,'83250.00'),(88,88,1,'box','4545.00','9090.00',NULL,'454500.00'),(89,89,2,'box','2121.00','530.25',NULL,'53025.00'),(90,90,1,'box','12.00','24.00',NULL,'1200.00'),(91,91,1,'packages','12.00','6.00',NULL,'300.00'),(92,92,1,'box','12.00','24.00',NULL,'1200.00'),(93,93,1,'box','12.00','24.00',NULL,'1200.00'),(94,94,1,'box','12.00','24.00',NULL,'1200.00'),(95,95,1,'box','3.00','6.00',NULL,'300.00'),(96,95,2,'box','7.00','1.75',NULL,'100.00'),(97,95,3,'box','5.00','6.25',NULL,'937.50'),(98,96,1,'box','55.00','110.00',NULL,'5500.00'),(99,97,1,'box','50.00','50.00',NULL,'2500.00'),(100,97,2,'packages','50.00','50.00',NULL,'5000.00'),(101,98,1,'box','50.00','50.00',NULL,'2500.00'),(102,98,2,'packages','50.00','50.00',NULL,'5000.00'),(103,99,1,'box','12.00','24.00',NULL,'1200.00'),(104,100,1,'box','55.00','110.00',NULL,'5500.00'),(105,100,2,'packages','66.00','99.00',NULL,'9900.00'),(106,101,1,'packages','67.00','33.50',NULL,'1675.00'),(107,101,2,'packages','56.00','84.00',NULL,'8400.00');

/*Table structure for table `bf_ishop_rol` */

CREATE TABLE `bf_ishop_rol` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `units` varchar(20) DEFAULT NULL,
  `rol_quantity` decimal(9,2) DEFAULT NULL,
  `rol_quantity_Kg_Ltr` decimal(9,2) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ishop_rol` */

insert  into `bf_ishop_rol`(`rol_id`,`customer_id`,`product_sku_id`,`units`,`rol_quantity`,`rol_quantity_Kg_Ltr`,`created_by_user`,`modified_by_user`,`country_id`,`status`,`created_on`,`modified_on`) values (1,9,1,'box','5411.00','10822.00',45,9,101,1,'2016-05-19 15:16:12','2016-08-02 14:20:13'),(2,9,1,'packages','120.00','60.00',45,9,101,1,'2016-05-19 15:16:12','2016-06-10 08:18:16'),(28,10,1,'packages','1000.00','500.00',45,45,101,1,'2016-05-30 12:24:17','2016-08-02 10:31:28'),(31,9,1,'packages','12.00','6.00',9,NULL,101,1,'2016-06-07 14:01:00',NULL),(33,14,2,'packages','50.00','75.00',14,14,101,1,'2016-06-07 14:02:10','2016-08-02 14:24:31'),(36,17,1,'kg/ltr','112.00','112.00',45,45,101,1,'2016-06-07 14:04:34','2016-06-22 09:03:02'),(37,11,1,'box','21.00','42.00',45,45,101,1,'2016-06-07 14:04:49','2016-06-08 15:53:27'),(39,10,2,'packages','32.00','48.00',45,NULL,101,1,'2016-06-07 17:53:48',NULL),(42,15,1,'box','1.00','2.00',45,45,101,1,'2016-06-09 20:32:19','2016-08-04 22:26:43'),(43,15,1,'packages','1.00','0.50',45,45,101,1,'2016-06-09 20:32:19','2016-08-04 22:26:43'),(44,15,1,'kg/ltr','1.00','1.00',45,45,101,1,'2016-06-09 20:32:19','2016-08-04 22:26:43'),(45,14,1,'box','242.00','484.00',14,14,101,1,'2016-06-10 08:20:54','2016-08-03 13:16:43'),(46,14,1,'packages','12.00','6.00',14,14,101,1,'2016-06-10 08:20:54','2016-08-03 13:12:09'),(47,14,1,'box','30.00','30.00',14,14,101,1,'2016-06-10 08:20:54','2016-08-02 14:24:36'),(48,36,2,'kg/ltr','500.00','500.00',45,45,101,1,'2016-06-10 14:25:41','2016-06-13 10:19:34'),(51,17,2,'box','50.00','12.50',45,45,101,1,'2016-06-13 07:38:01','2016-08-02 13:49:11'),(52,17,1,'kg/ltr','50.00','100.00',45,45,101,1,'2016-06-13 08:10:24','2016-06-13 10:42:11'),(53,17,3,'box','50.00','62.50',45,45,101,1,'2016-06-13 08:26:51','2016-06-14 12:26:54'),(55,16,1,'box','45.00','90.00',45,45,101,1,'2016-06-13 12:52:14','2016-08-02 13:55:43'),(56,17,3,'kg/ltr','888.00','888.00',45,45,101,1,'2016-06-13 13:22:20','2016-07-12 16:33:01'),(57,12,1,'packages','120.00','60.00',45,45,101,1,'2016-06-15 15:33:16','2016-06-17 12:33:47'),(58,11,2,'kg/ltr','6.00','6.00',45,45,101,1,'2016-06-22 17:15:05','2016-07-12 16:22:10'),(59,9,3,'packages','60.00','45.00',45,NULL,101,1,'2016-07-12 15:56:47',NULL),(60,12,3,'kg/ltr','7.00','7.00',45,45,101,1,'2016-07-12 16:09:30','2016-07-12 16:25:10'),(61,11,2,'packages','8.00','12.00',45,NULL,101,1,'2016-07-12 16:13:55',NULL),(62,12,2,'packages','77.00','115.50',45,NULL,101,1,'2016-07-12 16:26:45',NULL),(63,18,3,'kg/ltr','1234.00','1234.00',45,NULL,101,1,'2016-07-12 16:31:34',NULL),(64,17,2,'packages','6666.00','9999.00',45,NULL,101,1,'2016-07-12 16:32:19',NULL),(65,9,1,'box','122.00','244.00',9,45,101,1,'2016-07-15 16:12:30','2016-07-25 10:30:41'),(66,14,3,'kg/ltr','1234.00','1234.00',14,45,101,1,'2016-07-19 06:37:43','2016-07-21 13:10:04'),(67,16,3,'box','51.00','38.25',45,45,101,1,'2016-08-02 13:50:13','2016-08-02 13:55:53'),(68,9,1,'kg/ltr','1421.00','1421.00',9,NULL,101,1,'2016-08-02 14:18:07',NULL),(69,9,2,'box','2120.00','3180.00',9,9,101,1,'2016-08-02 14:18:46','2016-08-02 14:20:20'),(70,16,1,'packages','100.00','50.00',45,45,101,1,'2016-08-02 13:04:01','2016-08-10 16:26:20'),(71,17,2,'kg/ltr','125251.00','125251.00',45,NULL,101,1,'2016-08-03 13:31:26',NULL),(72,16,2,'box','32.00','8.00',45,NULL,101,1,'2016-08-13 12:38:55',NULL);

/*Table structure for table `bf_ishop_scheme_allocation` */

CREATE TABLE `bf_ishop_scheme_allocation` (
  `allocation_id` int(11) NOT NULL AUTO_INCREMENT,
  `scheme_id` int(11) DEFAULT NULL,
  `year` date DEFAULT NULL,
  `slab_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `geo_id2` int(11) DEFAULT NULL,
  `geo_id1` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`allocation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ishop_scheme_allocation` */

insert  into `bf_ishop_scheme_allocation`(`allocation_id`,`scheme_id`,`year`,`slab_id`,`customer_id`,`country_id`,`geo_id2`,`geo_id1`,`created_by_user`,`modified_by_user`,`status`,`created_on`,`modified_on`) values (11,1,'2016-01-01',3,17,101,20,28,45,NULL,1,'2016-06-06 11:31:17',NULL),(17,1,'2016-01-01',3,16,101,1,4,45,45,1,'2016-06-14 10:05:47','2016-08-02 17:59:01'),(18,2,'2016-01-01',6,16,101,1,4,45,45,1,'2016-07-01 07:04:20','2016-07-01 07:05:07'),(19,1,'2016-01-01',3,19,101,1,2,45,NULL,1,'2016-07-08 13:40:50',NULL),(20,1,'2016-01-01',3,14,101,1,2,45,NULL,1,'2016-07-08 13:42:37',NULL),(21,2,'2016-01-01',5,17,101,20,28,45,NULL,1,'2016-08-03 13:32:24',NULL);

/*Table structure for table `bf_ishop_secondary_sales` */

CREATE TABLE `bf_ishop_secondary_sales` (
  `secondary_sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `etn_no` varchar(255) DEFAULT NULL,
  `customer_id_from` int(11) DEFAULT NULL,
  `customer_id_to` int(11) DEFAULT NULL,
  `PO_no` varchar(255) DEFAULT NULL,
  `order_tracking_no` varchar(255) DEFAULT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `total_amount` decimal(9,2) DEFAULT NULL,
  `invoice_recived_status` tinyint(1) DEFAULT '0',
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`secondary_sales_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ishop_secondary_sales` */

insert  into `bf_ishop_secondary_sales`(`secondary_sales_id`,`etn_no`,`customer_id_from`,`customer_id_to`,`PO_no`,`order_tracking_no`,`invoice_no`,`invoice_date`,`total_amount`,`invoice_recived_status`,`country_id`,`created_by_user`,`modified_by_user`,`status`,`created_on`,`modified_on`) values (3,NULL,12,17,'12312','12121','12','2016-05-22','122.00',0,NULL,12,NULL,1,'2016-05-24 06:41:40',NULL),(4,NULL,12,17,'12312','12121','12','2016-05-22','122.00',0,NULL,12,NULL,1,'2016-05-24 06:41:40',NULL),(5,NULL,12,17,'345','123','123','2016-05-22','12333.00',0,NULL,12,NULL,1,'2016-05-24 06:44:24',NULL),(14,NULL,11,17,'EWQW3','1231E','123123','2016-06-27','100.00',0,101,20,20,1,'2016-06-07 07:37:28','2016-06-09 11:57:01'),(15,NULL,11,16,'1231231','12312','12312','2016-06-20','12336.00',0,101,20,NULL,1,'2016-06-09 12:26:51',NULL),(16,NULL,9,14,'545546','67767668','67676778','2016-07-09','20.00',0,101,20,20,1,'2016-06-11 09:54:57','2016-08-02 21:05:08'),(17,NULL,9,15,'34567','878787','123456','2016-07-07','40.00',0,101,20,20,1,'2016-06-11 09:54:57','2016-08-02 20:58:27'),(18,NULL,10,15,'15445','545','14514','2016-06-09','559.00',0,101,20,NULL,1,'2016-06-11 10:01:32',NULL),(19,NULL,10,15,'15445','545','14514','2016-06-09','559.00',0,101,20,20,1,'2016-06-11 10:01:36','2016-08-01 11:18:02'),(20,NULL,9,14,'145545','7667','6766','2016-07-11','10.00',0,101,9,NULL,1,'2016-06-11 13:16:18',NULL),(21,NULL,9,15,'34567','43887','1256','2016-07-12','20.00',0,101,9,NULL,1,'2016-06-11 13:16:18',NULL),(46,'E851479',3,10,'3453','3424','342','2016-06-16','60000.00',0,101,3,20,1,'2016-06-16 13:18:55','2016-07-07 09:18:48'),(47,'E556152',9,10,'233','23423','qwq1231','2016-06-16','60000.00',0,101,9,20,1,'2016-06-16 13:57:42','2016-08-01 09:54:34'),(48,'E205981',9,14,'545545','67767667','67676776','2016-07-09','20.00',0,101,9,NULL,1,'2016-06-17 06:39:25',NULL),(49,'E545092',9,14,'545545','67767667','67676776','2016-07-09','20.00',0,101,9,NULL,1,'2016-06-17 06:39:30',NULL),(50,'E177543',9,14,'12312','12312','1231','2016-06-28','12312.00',0,101,9,9,1,'2016-06-20 13:01:41','2016-07-19 10:25:35'),(51,'E960131',9,14,'12312','12312','1231','2016-06-28','12312.00',0,101,9,9,1,'2016-06-20 13:01:45','2016-07-08 12:27:58'),(52,'E190138',9,15,'12312','12312','1231222','2016-06-22','24624.00',0,101,9,NULL,1,'2016-06-20 13:08:08',NULL),(53,'E969027',9,15,'','OTN2','INVOICE2','2016-06-22','3000.00',0,101,9,9,1,'2016-06-20 13:08:11','2016-07-13 06:06:37'),(54,'E920873',9,14,'1231231','OTN1','INVOICE1','2016-06-21','1231.00',0,101,9,9,1,'2016-06-22 09:55:19','2016-07-22 15:41:21'),(55,NULL,6,14,'sdf123','o232123','qweqw123','2016-06-23','900.00',0,101,20,20,1,'2016-06-24 07:02:19','2016-06-24 07:22:16'),(56,'E127008',6,14,'sdf123','o232123wer','qweqw123123','2016-06-23','900.00',0,101,20,NULL,1,'2016-06-24 07:22:46',NULL),(57,'E790642',10,15,'','','121','2016-07-11','121.00',0,101,20,20,1,'2016-07-15 15:41:14','2016-08-01 11:18:02'),(58,'E407679',9,14,'drte','rtewt','','2016-07-20','123.00',0,101,9,NULL,1,'2016-07-19 10:26:47',NULL),(59,'E884870',9,14,'po','OT','Sachin','2016-07-29','5454.00',0,101,9,NULL,1,'2016-07-29 06:48:02',NULL),(60,'E835708',9,14,'po1','OT1','Sachin','2016-07-29','5454.00',0,101,9,NULL,1,'2016-07-29 06:48:37',NULL),(61,'E123725',9,14,'we2','ew2','sachu','2016-07-29','522.00',0,101,9,9,1,'2016-07-29 06:54:41','2016-07-29 06:55:20'),(62,'E387392',9,14,'75','765','kjh','2016-07-27','756.00',0,101,9,9,1,'2016-07-29 16:33:16','2016-08-02 14:15:16'),(63,'E452284',10,15,'322','1231','zdfa','1970-01-01','123.00',0,101,20,NULL,1,'2016-07-29 17:02:35',NULL),(64,'E282252',9,14,'gh','gf','fg','2016-08-25','54.00',0,101,9,9,1,'2016-08-02 14:13:28','2016-08-02 14:13:28'),(65,'E731977',9,14,'55','525','442','2016-08-10','121.00',0,101,9,NULL,1,'2016-08-02 14:14:15',NULL),(66,'E982721',9,14,'121','13212','4132121','2016-08-26','212.00',0,101,9,NULL,1,'2016-08-03 14:06:47',NULL);

/*Table structure for table `bf_ishop_secondary_sales_product` */

CREATE TABLE `bf_ishop_secondary_sales_product` (
  `secondary_sales_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `secondary_sales_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `quantity` decimal(9,2) DEFAULT NULL,
  `dispatched_quantity` decimal(9,2) DEFAULT NULL,
  `amount` decimal(9,2) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `qty_kgl` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`secondary_sales_product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ishop_secondary_sales_product` */

insert  into `bf_ishop_secondary_sales_product`(`secondary_sales_product_id`,`secondary_sales_id`,`customer_id`,`product_sku_id`,`quantity`,`dispatched_quantity`,`amount`,`unit`,`qty_kgl`) values (1,1,0,1,'12.00','123.00','2200.00','packages','6.78'),(2,1,0,1,'12.00','11.00','23123.00',NULL,NULL),(3,2,0,1,'13.00','10.00','500.00','kg/ltr','13.00'),(4,3,17,1,'12.00','12.00','122.00',NULL,NULL),(5,4,17,1,'11.00','11.00','122.00',NULL,NULL),(6,5,17,1,'100.00','100.00','12333.00',NULL,NULL),(7,6,14,1,'123.00',NULL,'12.00','box','246.00'),(9,12,15,3,'12.00',NULL,'8776.00','kg/ltr','12.00'),(10,13,15,2,'12.00','18.00','11.00','packages','18.00'),(11,13,15,3,'13.00','16.25','30.00','packages','16.25'),(13,14,17,3,'21.00',NULL,'100.00','kg/ltr','21.00'),(14,15,16,2,'123123.00',NULL,'12313.00','packages','184684.50'),(15,15,16,1,'123.00',NULL,'23.00','box','246.00'),(16,16,14,1,'11.00',NULL,'10.00','box','22.00'),(17,17,15,1,'12.00',NULL,'20.00','packages','6.00'),(18,18,15,1,'545.00',NULL,'14.00','box','1090.00'),(19,18,15,2,'55.00',NULL,'545.00','packages','82.50'),(20,19,15,1,'545.00',NULL,'14.00','box','1090.00'),(21,19,15,2,'55.00',NULL,'545.00','packages','82.50'),(22,16,14,1,'11.00',NULL,'10.00','box','22.00'),(23,17,15,1,'12.00',NULL,'20.00','packages','6.00'),(24,20,14,1,'11.00',NULL,'10.00','box','22.00'),(25,21,15,1,'12.00',NULL,'20.00','packages','6.00'),(26,22,14,1,'12.00',NULL,'21.00','packages','6.00'),(27,23,14,1,'12.00',NULL,'21.00','packages','6.00'),(28,24,14,1,'12.00',NULL,'21.00','packages','6.00'),(29,25,14,1,'12.00',NULL,'21.00','packages','6.00'),(30,26,14,1,'12.00',NULL,'21.00','packages','6.00'),(31,27,14,1,'12.00',NULL,'21.00','packages','6.00'),(32,28,14,1,'12.00',NULL,'21.00','packages','6.00'),(33,29,14,1,'12.00',NULL,'21.00','packages','6.00'),(34,30,14,1,'12.00',NULL,'21.00','packages','6.00'),(35,31,14,1,'12.00',NULL,'21.00','packages','6.00'),(36,32,14,1,'12.00',NULL,'21.00','packages','6.00'),(37,33,14,1,'12.00',NULL,'21.00','packages','6.00'),(38,34,14,1,'12.00',NULL,'21.00','packages','6.00'),(39,35,14,1,'12.00',NULL,'21.00','packages','6.00'),(40,36,14,1,'12.00',NULL,'21.00','packages','6.00'),(41,37,14,1,'12.00',NULL,'21.00','packages','6.00'),(42,38,14,1,'12.00',NULL,'21.00','packages','6.00'),(43,39,14,1,'12.00',NULL,'21.00','packages','6.00'),(44,40,14,1,'12.00',NULL,'21.00','packages','6.00'),(45,41,14,1,'12.00',NULL,'21.00','packages','6.00'),(46,42,14,1,'12.00',NULL,'21.00','packages','6.00'),(47,43,14,1,'12.00',NULL,'21.00','packages','6.00'),(48,44,14,1,'12.00',NULL,'21.00','packages','6.00'),(49,45,14,1,'12.00',NULL,'21.00','packages','6.00'),(50,46,10,1,'10.00','100.00','10000.00','box','1000.00'),(51,46,10,2,'20.00','200.00','20000.00','packages','2000.00'),(52,46,10,3,'30.00','300.00','30000.00','kg/ltr','3000.00'),(56,48,14,1,'11.00',NULL,'10.00','packages','5.50'),(57,48,14,1,'11.00',NULL,'10.00','box','22.00'),(58,49,14,1,'11.00',NULL,'10.00','packages','5.50'),(59,49,14,1,'11.00',NULL,'10.00','box','22.00'),(61,51,14,2,'1122.00',NULL,'12312.00','packages','1683.00'),(62,52,15,2,'1231.00',NULL,'12312.00','packages','1846.50'),(63,52,15,1,'1231.00',NULL,'12312.00','packages','615.50'),(64,53,15,2,'20.00',NULL,'2000.00','box','40.00'),(65,53,15,1,'10.00',NULL,'1000.00','box','20.00'),(67,54,14,1,'1231.00',NULL,'1231.00','packages','615.50'),(71,47,10,1,'10.00',NULL,'10000.00','box','1000.00'),(72,47,10,2,'20.00',NULL,'20000.00','packages','2000.00'),(73,47,10,3,'30.00',NULL,'30000.00','kg/ltr','3000.00'),(80,55,14,1,'12.00',NULL,'200.00','box','24.00'),(81,55,14,2,'23.00',NULL,'300.00','packages','11.50'),(82,55,14,3,'34.00',NULL,'400.00','kg/ltr','34.00'),(83,56,14,1,'12.00',NULL,'200.00','box','24.00'),(84,56,14,2,'23.00',NULL,'300.00','packages','11.50'),(85,56,14,3,'34.00',NULL,'400.00','kg/ltr','34.00'),(86,57,15,1,'22222.00',NULL,'121.00','box','44444.00'),(87,50,14,2,'1231.00',NULL,'12312.00','packages','1846.50'),(88,58,14,1,'1231.00',NULL,'123.00','kg/ltr','1231.00'),(89,59,14,1,'454.00',NULL,'5454.00','box','908.00'),(90,60,14,1,'454.00',NULL,'5454.00','box','908.00'),(93,61,14,1,'111.00',NULL,'211.00','packages','55.50'),(94,61,14,2,'111.00',NULL,'311.00','kg/ltr','111.00'),(95,62,14,1,'75.00',NULL,'756.00','box','150.00'),(96,63,15,1,'1231.00',NULL,'123.00','box','2462.00'),(98,64,14,1,'54.00',NULL,'54.00','packages','27.00'),(99,65,14,1,'1454.00',NULL,'121.00','packages','727.00'),(100,66,14,2,'312.00',NULL,'212.00','packages','468.00');

/*Table structure for table `bf_ishop_target` */

CREATE TABLE `bf_ishop_target` (
  `ishop_target_id` int(11) NOT NULL AUTO_INCREMENT,
  `month_data` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `quantity` decimal(9,2) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`ishop_target_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ishop_target` */

insert  into `bf_ishop_target`(`ishop_target_id`,`month_data`,`customer_id`,`product_sku_id`,`quantity`,`created_by_user`,`modified_by_user`,`country_id`,`status`,`created_on`,`modified_on`) values (1,'2016-07-01',9,1,'25.00',45,45,101,1,'2016-08-02 20:16:57','2016-08-02 08:31:35'),(2,'2016-01-01',9,1,'25.00',45,NULL,NULL,1,'2016-08-02 08:31:34',NULL),(3,'2016-02-01',9,1,'25.00',45,NULL,NULL,1,'2016-08-02 08:31:34',NULL),(4,'2016-03-01',9,1,'25.00',45,NULL,NULL,1,'2016-08-02 08:31:34',NULL),(5,'2016-04-01',9,1,'25.00',45,NULL,NULL,1,'2016-08-02 08:31:34',NULL),(6,'2016-05-01',9,1,'1000.00',45,45,101,1,'2016-08-02 08:31:34','2016-08-02 20:24:38'),(7,'2016-06-01',9,1,'25.00',45,NULL,NULL,1,'2016-08-02 08:31:35',NULL),(8,'2016-08-01',9,1,'25.00',45,NULL,NULL,1,'2016-08-02 08:31:35',NULL),(9,'2016-09-01',9,1,'25.00',45,NULL,NULL,1,'2016-08-02 08:31:35',NULL),(10,'2016-10-01',9,1,'25.00',45,NULL,NULL,1,'2016-08-02 08:31:35',NULL),(11,'2016-11-01',9,1,'25.00',45,45,NULL,1,'2016-08-02 08:31:35','2016-08-02 08:39:54'),(12,'2016-12-01',9,1,'3000.00',45,45,101,1,'2016-08-02 08:31:35','2016-08-02 20:22:40'),(13,'2016-10-01',9,2,'35.00',45,NULL,101,1,'2016-08-02 20:38:56',NULL),(14,'2016-11-01',9,2,'35.00',45,NULL,NULL,1,'2016-08-02 08:39:54',NULL),(15,'2016-12-01',9,2,'35.00',45,NULL,NULL,1,'2016-08-02 08:39:54',NULL),(16,'2016-05-01',9,1,'410.00',45,NULL,101,1,'2016-08-02 08:07:11',NULL),(17,'2016-12-01',9,1,'310.00',45,NULL,101,1,'2016-08-02 08:07:11',NULL),(18,'2016-05-01',9,1,'410.00',45,NULL,101,1,'2016-08-02 08:08:05',NULL),(19,'2016-12-01',9,1,'310.00',45,NULL,101,1,'2016-08-02 08:08:05',NULL),(20,'1970-01-01',9,1,'3000.00',45,NULL,101,1,'2016-08-02 08:24:38',NULL),(21,'2016-10-01',11,2,'121.00',45,NULL,101,1,'2016-08-03 13:31:53',NULL),(22,'2016-04-01',12,3,'7777.00',45,NULL,101,1,'2016-08-04 17:22:24',NULL),(23,'2016-10-01',10,3,'7777.00',45,NULL,NULL,1,'2016-08-04 05:23:18',NULL);

/*Table structure for table `bf_ishop_tertiary_sales` */

CREATE TABLE `bf_ishop_tertiary_sales` (
  `tertiary_sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `sales_month` date DEFAULT NULL,
  `total_amount` decimal(9,2) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`tertiary_sales_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ishop_tertiary_sales` */

insert  into `bf_ishop_tertiary_sales`(`tertiary_sales_id`,`customer_id`,`sales_month`,`total_amount`,`created_by_user`,`modified_by_user`,`country_id`,`status`,`created_on`,`modified_on`) values (1,16,'2016-01-01','3.00',20,20,101,1,'2016-08-04 01:36:36','2016-08-04 15:59:23');

/*Table structure for table `bf_ishop_tertiary_sales_products` */

CREATE TABLE `bf_ishop_tertiary_sales_products` (
  `tertiary_sales_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `tertiary_sales_id` int(11) DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `quantity` decimal(9,2) DEFAULT NULL,
  `amount` decimal(9,2) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `qty_kgl` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`tertiary_sales_product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `bf_ishop_tertiary_sales_products` */

insert  into `bf_ishop_tertiary_sales_products`(`tertiary_sales_product_id`,`tertiary_sales_id`,`product_sku_id`,`quantity`,`amount`,`unit`,`qty_kgl`) values (1,1,1,'66.00','66.00','box','132.00'),(2,1,2,'3.00','3.00','packages','4.50'),(3,1,3,'5.00','5.00','kg/ltr','5.00'),(4,1,1,'77.00','77.00','packages','38.50');

/*Table structure for table `bf_login_attempts` */

CREATE TABLE `bf_login_attempts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_login_attempts` */

/*Table structure for table `bf_master_assumptions` */

CREATE TABLE `bf_master_assumptions` (
  `assumption_id` int(11) NOT NULL AUTO_INCREMENT,
  `assumption_group_name_id` int(11) DEFAULT NULL,
  `assumption_name` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`assumption_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_assumptions` */

insert  into `bf_master_assumptions`(`assumption_id`,`assumption_group_name_id`,`assumption_name`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,1,'Aliran Udara/Angin',0,0,0,1,NULL,NULL),(2,2,'Areal tanaman- Berkurang',0,0,0,1,NULL,NULL),(3,2,'Areal tanaman- Bertambah',0,0,0,1,NULL,NULL),(4,1,'Banjir',0,0,0,1,NULL,NULL),(5,3,'Bekerjasama dengan perusahaan benih',0,0,0,1,NULL,NULL),(6,1,'Curah hujan',0,0,0,1,NULL,NULL),(7,3,'Distribusi sampel demo',0,0,0,1,NULL,NULL),(8,3,'Distribusi sampel gratis',0,0,0,1,NULL,NULL),(9,4,'DO/DA/FDO',0,0,0,1,NULL,NULL),(10,2,'Dosis penyemprotan',0,0,0,1,NULL,NULL),(11,5,'Harga Komoditas-Rendah',0,0,0,1,NULL,NULL),(12,5,'Harga Komoditas-Tinggi',0,0,0,1,NULL,NULL),(13,7,'Harga Naik',0,0,0,1,NULL,NULL),(14,7,'Harga turun',0,0,0,1,NULL,NULL),(15,3,'Hari kegiatan lapangan',0,0,0,1,NULL,NULL),(16,2,'Kejadian Penyakit-rendah',0,0,0,1,NULL,NULL),(17,2,'Kejadian penyakit-tinggi',0,0,0,1,NULL,NULL),(18,1,'Kelembaban',0,0,0,1,NULL,NULL),(19,3,'Ketersediaan bahan baku',0,0,0,1,NULL,NULL),(20,1,'Kondisi iklim-Menguntungkan',0,0,0,1,NULL,NULL),(21,1,'Kondisi iklim-Merugikan',0,0,0,1,NULL,NULL),(22,3,'Kontak Petani',0,0,0,1,NULL,NULL),(23,6,'Masalah penumpukan barang',0,0,0,1,NULL,NULL),(24,3,'MDA lainnya',0,0,0,1,NULL,NULL),(25,6,'Mitra kerja baru',0,0,0,1,NULL,NULL),(26,6,'Mitra Kerja lama',0,0,0,1,NULL,NULL),(27,1,'Musim',0,0,0,1,NULL,NULL),(28,3,'Pasar baru yang belum tersentuh',0,0,0,1,NULL,NULL),(29,3,'Peluncuran Produk',0,0,0,1,NULL,NULL),(30,6,'Pembayaran di muka/ DP',0,0,0,1,NULL,NULL),(31,3,'Peningkatan Efisiensi',0,0,0,1,NULL,NULL),(32,2,'Penjualan Crop',0,0,0,1,NULL,NULL),(33,6,'Penjualan produk pesaing',0,0,0,1,NULL,NULL),(34,2,'Penyemprotan mengurangi serangan hama/penyakit',0,0,0,1,NULL,NULL),(35,2,'Penyemprotan pencegahan',0,0,0,1,NULL,NULL),(36,7,'Persaingan harga',0,0,0,1,NULL,NULL),(37,6,'Persaingan pengembangan pasar',0,0,0,1,NULL,NULL),(38,6,'Persediaan tinggi',0,0,0,1,NULL,NULL),(39,2,'Persiapan masa tanam',0,0,0,1,NULL,NULL),(40,6,'Persiapan persiapan barang',0,0,0,1,NULL,NULL),(41,6,'Persiapan Skim',0,0,0,1,NULL,NULL),(42,3,'Pertemuan Petani',0,0,0,1,NULL,NULL),(43,8,'Pertumbuhan pasar normal (YOY)',0,0,0,1,NULL,NULL),(44,3,'Pod Days',0,0,0,1,NULL,NULL),(45,6,'Produk Baru Kompetitor',0,0,0,1,NULL,NULL),(46,3,'Program sukses',0,0,0,1,NULL,NULL),(47,3,'Rekomendasi lembaga penelitian/universitas',0,0,0,1,NULL,NULL),(48,2,'Rumput/gulma-rendah',0,0,0,1,NULL,NULL),(49,2,'Rumput/gulma-Tinggi',0,0,0,1,NULL,NULL),(50,2,'Serangan Hama',0,0,0,1,NULL,NULL),(51,2,'Serangan hama-rendah',0,0,0,1,NULL,NULL),(52,2,'Serangan hama-Tinggi',0,0,0,1,NULL,NULL),(53,5,'Situasi ekspor',0,0,0,1,NULL,NULL),(54,6,'Skim komersial',0,0,0,1,NULL,NULL),(55,6,'Skim Kompetitor',0,0,0,1,NULL,NULL),(56,1,'Suhu',0,0,0,1,NULL,NULL),(57,2,'Tanaman pengganti',0,0,0,1,NULL,NULL),(58,4,'Tenaga kerja tambahan',0,0,0,1,NULL,NULL),(59,3,'Tuber day',0,0,0,1,NULL,NULL);

/*Table structure for table `bf_master_assumptions_group_name` */

CREATE TABLE `bf_master_assumptions_group_name` (
  `assumption_group_name_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`assumption_group_name_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_assumptions_group_name` */

insert  into `bf_master_assumptions_group_name`(`assumption_group_name_id`,`group_name`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,'Weather\r\n',NULL,NULL,0,1,NULL,NULL),(2,'Crops\r\n',NULL,NULL,0,1,NULL,NULL),(3,'Market Dev.Activity\r\n',NULL,NULL,0,1,NULL,NULL),(4,'Manpower\r\n',NULL,NULL,0,1,NULL,NULL),(5,'Post Harvest\r\n',NULL,NULL,0,1,NULL,NULL),(6,'Commercial\r\n',NULL,NULL,0,1,NULL,NULL),(7,'Price\r\n',NULL,NULL,0,1,NULL,NULL),(8,'General\r\n',NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_business_geography_details` */

CREATE TABLE `bf_master_business_geography_details` (
  `business_geo_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` date DEFAULT NULL,
  `geo_level_id` int(11) DEFAULT NULL,
  `parent_geo_id` int(11) DEFAULT NULL,
  `business_georaphy_code` varchar(255) DEFAULT NULL,
  `business_georaphy_name` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`business_geo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_business_geography_details` */

insert  into `bf_master_business_geography_details`(`business_geo_id`,`year`,`geo_level_id`,`parent_geo_id`,`business_georaphy_code`,`business_georaphy_name`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,'2016-01-01',3,0,'1','Philippines',NULL,NULL,0,1,NULL,NULL),(2,'2016-01-01',2,1,'1','Region I',NULL,NULL,0,1,NULL,NULL),(3,'2016-01-01',1,2,'1','Territory 1',NULL,NULL,0,1,NULL,NULL),(4,'2016-01-01',2,1,'2','Luzon - Gentrade',NULL,NULL,0,1,NULL,NULL),(5,'2016-01-01',1,4,'2','Isabela',NULL,NULL,0,1,NULL,NULL),(6,'2016-01-01',1,4,'3','Cordillera Administrative Region',NULL,NULL,0,1,NULL,NULL),(7,'2016-01-01',1,4,'4','Nueva Ecija',NULL,NULL,0,1,NULL,NULL),(8,'2016-01-01',1,4,'5','Pangasinan',NULL,NULL,0,1,NULL,NULL),(9,'2016-01-01',1,4,'6','Pampanga, Bulacan, Tarlac',NULL,NULL,0,1,NULL,NULL),(10,'2016-01-01',1,4,'7','Calabarzon',NULL,NULL,0,1,NULL,NULL),(11,'2016-01-01',1,4,'8','Bicol',NULL,NULL,0,1,NULL,NULL),(12,'2016-01-01',1,4,'9','Luzon Mango Areas',NULL,NULL,0,1,NULL,NULL),(13,'2016-01-01',2,1,'3','Vismin - Gentrade',NULL,NULL,0,1,NULL,NULL),(14,'2016-01-01',1,13,'10','Visayas',NULL,NULL,0,1,NULL,NULL),(15,'2016-01-01',1,13,'11','Eastern Mindanao',NULL,NULL,0,1,NULL,NULL),(16,'2016-01-01',1,13,'12','SOCCSKARGEN',NULL,NULL,0,1,NULL,NULL),(17,'2016-01-01',1,13,'13','Nothern Mindanao',NULL,NULL,0,1,NULL,NULL),(18,'2016-01-01',1,13,'14','Western Mindanao',NULL,NULL,0,1,NULL,NULL),(19,'2016-01-01',1,13,'15','Visimin Mango Areas',NULL,NULL,0,1,NULL,NULL),(20,'2016-01-01',3,0,'','Indonesia',NULL,NULL,0,1,NULL,NULL),(21,'2016-01-01',2,20,'','R1 (Danau Toba)',NULL,NULL,0,1,NULL,NULL),(22,'2016-01-01',1,21,'','Simalungun',NULL,NULL,0,1,NULL,NULL),(23,'2016-01-01',1,21,'','Tanah Karo',NULL,NULL,0,1,NULL,NULL),(24,'2016-01-01',1,21,'','Deli Serdang',NULL,NULL,0,1,NULL,NULL),(25,'2016-01-01',1,21,'','Langkat',NULL,NULL,0,1,NULL,NULL),(26,'2016-01-01',1,21,'','Asahan',NULL,NULL,0,1,NULL,NULL),(27,'2016-01-01',1,21,'','Aceh Tenggara',NULL,NULL,0,1,NULL,NULL),(28,'2016-01-01',2,20,'','R3 (Gajah)',NULL,NULL,0,1,NULL,NULL),(29,'2016-01-01',1,27,'','Bukit Barisan',NULL,NULL,0,1,NULL,NULL),(30,'2016-01-01',1,27,'','Lamsel',NULL,NULL,0,1,NULL,NULL),(31,'2016-01-01',1,27,'','Sumsel',NULL,NULL,0,1,NULL,NULL),(32,'2016-01-01',1,27,'','Lamtim',NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_business_geography_level_country` */

CREATE TABLE `bf_master_business_geography_level_country` (
  `business_geography_countrylevel_id` int(11) NOT NULL AUTO_INCREMENT,
  `level_id` int(11) DEFAULT NULL,
  `level_name` varchar(255) DEFAULT NULL,
  `political_geo_lavel_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`business_geography_countrylevel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_business_geography_level_country` */

insert  into `bf_master_business_geography_level_country`(`business_geography_countrylevel_id`,`level_id`,`level_name`,`political_geo_lavel_id`,`country_id`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,1,'Territory\r\n',2,101,NULL,NULL,0,1,NULL,NULL),(2,2,'Area\r\n',NULL,101,NULL,NULL,0,1,NULL,NULL),(3,3,'Zone\r\n',NULL,101,NULL,NULL,0,1,NULL,NULL),(4,1,'Territory\r\n',3,98,NULL,NULL,0,1,NULL,NULL),(5,2,'Region\r\n',NULL,98,NULL,NULL,0,1,NULL,NULL),(6,3,'Country\r\n',NULL,98,NULL,NULL,0,1,NULL,NULL),(7,1,'Territory\r\n',3,151,NULL,NULL,0,1,NULL,NULL),(8,2,'Region\r\n',NULL,151,NULL,NULL,0,1,NULL,NULL),(9,3,'Country\r\n',NULL,151,NULL,NULL,0,1,NULL,NULL),(10,1,'Territory\r\n',3,231,NULL,NULL,0,1,NULL,NULL),(11,2,'Region\r\n',NULL,231,NULL,NULL,0,1,NULL,NULL),(12,3,'Country\r\n',NULL,231,NULL,NULL,0,1,NULL,NULL),(13,1,'Territory\r\n',3,170,NULL,NULL,0,1,NULL,NULL),(14,2,'Region\r\n',NULL,170,NULL,NULL,0,1,NULL,NULL),(15,3,'Country\r\n',NULL,170,NULL,NULL,0,1,NULL,NULL),(16,1,'Territory\r\n',3,190,NULL,NULL,0,1,NULL,NULL),(17,2,'Region\r\n',NULL,190,NULL,NULL,0,1,NULL,NULL),(18,3,'Country\r\n',NULL,190,NULL,NULL,0,1,NULL,NULL),(19,1,'Territory\r\n',3,208,NULL,NULL,0,1,NULL,NULL),(20,2,'Region\r\n',NULL,208,NULL,NULL,0,1,NULL,NULL),(21,3,'Country\r\n',NULL,208,NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_business_geography_level_regional` */

CREATE TABLE `bf_master_business_geography_level_regional` (
  `business_geography_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(255) DEFAULT NULL,
  `level_name` varchar(255) DEFAULT NULL,
  `year` date DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`business_geography_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_business_geography_level_regional` */

insert  into `bf_master_business_geography_level_regional`(`business_geography_level_id`,`level`,`level_name`,`year`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,'L1','Territory','0000-00-00',NULL,NULL,0,1,NULL,NULL),(2,'L2','Region','0000-00-00',NULL,NULL,0,1,NULL,NULL),(3,'L3','Country','0000-00-00',NULL,NULL,0,1,NULL,NULL),(4,'L4',NULL,NULL,NULL,NULL,0,1,NULL,NULL),(5,'L5',NULL,NULL,NULL,NULL,0,1,NULL,NULL),(6,'L6',NULL,NULL,NULL,NULL,0,1,NULL,NULL),(7,'L7',NULL,NULL,NULL,NULL,0,1,NULL,NULL),(8,'L8',NULL,NULL,NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_business_political_geo_mapping` */

CREATE TABLE `bf_master_business_political_geo_mapping` (
  `geo_mapping_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` date DEFAULT NULL,
  `business_geo_id` int(11) DEFAULT NULL,
  `polotical_geo_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`geo_mapping_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_business_political_geo_mapping` */

insert  into `bf_master_business_political_geo_mapping`(`geo_mapping_id`,`year`,`business_geo_id`,`polotical_geo_id`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,'2016-01-01',2,49,45,NULL,0,1,NULL,NULL),(2,'2016-01-01',13,61,45,NULL,0,1,NULL,NULL),(3,'2016-01-01',4,63,45,NULL,0,1,NULL,NULL),(4,'2016-01-01',28,129,45,NULL,0,1,NULL,NULL),(5,'2016-01-01',21,134,45,NULL,0,1,NULL,NULL),(6,'2016-01-01',2,49,45,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_category_applicable` */

CREATE TABLE `bf_master_category_applicable` (
  `category_applicable_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `applicable_name` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`category_applicable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `bf_master_category_applicable` */

insert  into `bf_master_category_applicable`(`category_applicable_id`,`status`,`applicable_name`,`deleted`,`created_on`,`modified_on`) values (1,1,'Employee Master\r\n',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,1,'Product Master\r\n',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,1,'Disease Master\r\n',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,1,'Crop Master\r\n',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,1,'Retailer\r\n',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,1,'Distributor\r\n',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,1,'Farmer\r\n',0,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `bf_master_category_country` */

CREATE TABLE `bf_master_category_country` (
  `category_national_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `category_id` int(11) DEFAULT NULL,
  `category_national_name` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`category_national_id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

/*Data for the table `bf_master_category_country` */

insert  into `bf_master_category_country`(`category_national_id`,`status`,`category_id`,`category_national_name`,`country_id`,`created_by_user`,`modified_by_user`,`deleted`,`created_on`,`modified_on`) values (1,1,1,'A',101,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,1,2,'B',101,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,1,3,'C',101,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,1,4,'A',101,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,1,5,'B',101,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,1,6,'C',101,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,1,7,'Core \r\n',101,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,1,8,'Non Core\r\n',101,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,1,9,'Core \r\n',101,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,1,10,'Non Core\r\n',101,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,1,11,'Imp\r\n',101,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,1,12,'Very Impt\r\n',101,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,1,13,'Imp\r\n',101,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,1,14,'Very Impt\r\n',101,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,1,15,'Imp\r\n',101,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,1,16,'Very Impt\r\n',101,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,1,1,'A',98,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,1,2,'B',98,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(19,1,3,'C',98,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,1,4,'A',98,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(21,1,5,'B',98,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(22,1,6,'C',98,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(23,1,7,'Core \r\n',98,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(24,1,8,'Non Core\r\n',98,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(25,1,9,'Core \r\n',98,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(26,1,10,'Non Core\r\n',98,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(27,1,11,'Imp\r\n',98,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(28,1,12,'Very Impt\r\n',98,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(29,1,13,'Imp\r\n',98,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(30,1,14,'Very Impt\r\n',98,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(31,1,15,'Imp\r\n',98,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(32,1,16,'Very Impt\r\n',98,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(33,1,1,'A',151,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(34,1,2,'B',151,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(35,1,3,'C',151,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(36,1,4,'A',151,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(37,1,5,'B',151,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(38,1,6,'C',151,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(39,1,7,'Core \r\n',151,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(40,1,8,'Non Core\r\n',151,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(41,1,9,'Core \r\n',151,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(42,1,10,'Non Core\r\n',151,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(43,1,11,'Imp\r\n',151,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(44,1,12,'Very Impt\r\n',151,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(45,1,13,'Imp\r\n',151,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(46,1,14,'Very Impt\r\n',151,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(47,1,15,'Imp\r\n',151,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(48,1,16,'Very Impt\r\n',151,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(49,1,1,'A',231,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(50,1,2,'B',231,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(51,1,3,'C',231,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(52,1,4,'A',231,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(53,1,5,'B',231,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(54,1,6,'C',231,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(55,1,7,'Core \r\n',231,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(56,1,8,'Non Core\r\n',231,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(57,1,9,'Core \r\n',231,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(58,1,10,'Non Core\r\n',231,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(59,1,11,'Imp\r\n',231,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(60,1,12,'Very Impt\r\n',231,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(61,1,13,'Imp\r\n',231,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(62,1,14,'Very Impt\r\n',231,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(63,1,15,'Impt\r\n',231,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(64,1,16,'Very Impt\r\n',231,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(65,1,1,'A',170,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(66,1,2,'B',170,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(67,1,3,'C',170,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(68,1,4,'A',170,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(69,1,5,'B',170,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(70,1,6,'C',170,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(71,1,7,'Core \r\n',170,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(72,1,8,'Non Core\r\n',170,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(73,1,9,'Core \r\n',170,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(74,1,10,'Non Core\r\n',170,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(75,1,11,'Imp\r\n',170,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(76,1,12,'Very Impt\r\n',170,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(77,1,13,'Imp\r\n',170,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(78,1,14,'Very Impt\r\n',170,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(79,1,15,'Imp\r\n',170,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(80,1,16,'Very Impt\r\n',170,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(81,1,1,'A',190,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(82,1,2,'B',190,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(83,1,3,'C',190,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(84,1,4,'A',190,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(85,1,5,'B',190,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(86,1,6,'C',190,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(87,1,7,'Core \r\n',190,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(88,1,8,'Non Core\r\n',190,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(89,1,9,'Core \r\n',190,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(90,1,10,'Non Core\r\n',190,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(91,1,11,'Imp\r\n',190,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(92,1,12,'Very Impt\r\n',190,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(93,1,13,'Imp\r\n',190,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(94,1,14,'Very Impt\r\n',190,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(95,1,15,'Imp\r\n',190,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(96,1,16,'Very Impt\r\n',190,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(97,1,1,'A',205,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(98,1,2,'B',205,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(99,1,3,'C',205,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(100,1,4,'A',205,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(101,1,5,'B',205,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(102,1,6,'C',205,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(103,1,7,'Core \r\n',205,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(104,1,8,'Non Core\r\n',205,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(105,1,9,'Core \r\n',205,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(106,1,10,'Non Core\r\n',205,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(107,1,11,'Imp\r\n',205,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(108,1,12,'Very Impt\r\n',205,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(109,1,13,'Imp\r\n',205,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(110,1,14,'Very Impt\r\n',205,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(111,1,15,'Imp\r\n',205,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(112,1,16,'Very Impt\r\n',205,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `bf_master_category_regional` */

CREATE TABLE `bf_master_category_regional` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `category_name` varchar(255) NOT NULL,
  `category_code` varchar(30) NOT NULL,
  `category_applicable_id` int(11) NOT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `bf_master_category_regional` */

insert  into `bf_master_category_regional`(`category_id`,`status`,`category_name`,`category_code`,`category_applicable_id`,`created_by_user`,`modified_by_user`,`deleted`,`created_on`,`modified_on`) values (1,1,'A','001',1,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,1,'B','002',1,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,1,'C','003',1,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,1,'A','004',2,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,1,'B','005',2,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,1,'C','006',2,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,1,'Core \r\n','007',3,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,1,'Non Core\r\n','008',3,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,1,'Core \r\n','009',4,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,1,'Non Core\r\n','010',4,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,1,'Imp\r\n','011',5,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,1,'Very Impt\r\n','012',5,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,1,'Imp\r\n','013',6,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,1,'Very Impt\r\n','014',6,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,1,'Imp\r\n','015',7,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,1,'Very Impt\r\n','016',7,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `bf_master_compititor` */

CREATE TABLE `bf_master_compititor` (
  `compititor_id` int(11) NOT NULL AUTO_INCREMENT,
  `compititor_name` varchar(255) DEFAULT NULL,
  `compititor_code` varchar(255) DEFAULT NULL,
  `location` text,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`compititor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_compititor` */

insert  into `bf_master_compititor`(`compititor_id`,`compititor_name`,`compititor_code`,`location`,`description`,`deleted`,`status`,`created_on`,`modified_on`,`country_id`) values (1,'Zee Company Ltd\r\n','1','Mumbai','Zee Company Ltd',0,1,NULL,NULL,NULL),(2,'Anand Fertilizers\r\n','2','Anand','Anand Fertilizers',0,1,NULL,NULL,NULL),(3,'Ahmedabad Corporation\r\n','3','Ahmedabad','Ahmedabad Corporation',0,1,NULL,NULL,NULL),(4,'Krishi Seva Kendra\r\n','4','Delhi','Krishi Seva Kendra',0,1,NULL,NULL,NULL);

/*Table structure for table `bf_master_complaint_detail` */

CREATE TABLE `bf_master_complaint_detail` (
  `complaint_id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_type_id` int(11) DEFAULT NULL,
  `complaint_subject` varchar(255) DEFAULT NULL,
  `reminder1_days` int(11) DEFAULT NULL,
  `reminder1_desigination_id` varchar(255) DEFAULT NULL,
  `reminder1_other_desigination_id` int(11) DEFAULT NULL,
  `other_desigination_person1_id` int(11) DEFAULT NULL,
  `reminder2_days` int(11) DEFAULT NULL,
  `reminder2_desigination_id` varchar(255) DEFAULT NULL,
  `reminder2_other_desigination_id` int(11) DEFAULT NULL,
  `other_desigination_person2_id` int(11) DEFAULT NULL,
  `reminder3_days` int(11) DEFAULT NULL,
  `reminder3_desigination_id` varchar(255) DEFAULT NULL,
  `reminder3_other_desigination_id` int(11) DEFAULT NULL,
  `other_desigination_person3_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`complaint_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_complaint_detail` */

insert  into `bf_master_complaint_detail`(`complaint_id`,`complaint_type_id`,`complaint_subject`,`reminder1_days`,`reminder1_desigination_id`,`reminder1_other_desigination_id`,`other_desigination_person1_id`,`reminder2_days`,`reminder2_desigination_id`,`reminder2_other_desigination_id`,`other_desigination_person2_id`,`reminder3_days`,`reminder3_desigination_id`,`reminder3_other_desigination_id`,`other_desigination_person3_id`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,1,'Account Statement\r\n',5,'1,2,3',NULL,5,10,NULL,NULL,NULL,15,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL),(2,1,'Credit Balance Refund\r\n',5,NULL,NULL,NULL,10,NULL,NULL,NULL,15,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL),(3,1,'Credit note copy\r\n',2,NULL,NULL,NULL,7,NULL,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL),(4,1,'Delay in PLI Discounts Credit Note\r\n',15,NULL,NULL,NULL,20,NULL,NULL,NULL,25,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL),(5,1,'Invoice Copy Required\r\n',2,NULL,NULL,NULL,7,NULL,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL),(6,2,'Leakage / Damage Material\r\n',45,NULL,NULL,NULL,50,NULL,NULL,NULL,55,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL),(7,2,'Late Delivery of Consignment\r\n',45,NULL,NULL,NULL,50,NULL,NULL,NULL,55,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL),(8,2,'Empty Pack/bottle\r\n',45,NULL,NULL,NULL,50,NULL,NULL,NULL,55,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL),(9,2,'Non Recipt of material\r\n',25,NULL,NULL,NULL,30,NULL,NULL,NULL,35,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_complaint_type` */

CREATE TABLE `bf_master_complaint_type` (
  `complaint_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_type_name` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`complaint_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_complaint_type` */

insert  into `bf_master_complaint_type`(`complaint_type_id`,`complaint_type_name`,`country_id`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,'Account\r\n',101,NULL,NULL,0,1,NULL,NULL),(2,'Non-Account\r\n',101,NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_conversation` */

CREATE TABLE `bf_master_conversation` (
  `conversation_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_sku_id` int(11) DEFAULT NULL,
  `sku_convesion_factor` decimal(9,2) DEFAULT NULL,
  `sku_result` varchar(255) DEFAULT NULL,
  `box_conversion_factor` decimal(9,2) DEFAULT NULL,
  `box_result` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`conversation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_conversation` */

insert  into `bf_master_conversation`(`conversation_id`,`product_sku_id`,`sku_convesion_factor`,`sku_result`,`box_conversion_factor`,`box_result`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,1,'0.50',NULL,'2.00',NULL,NULL,NULL,0,1,NULL,NULL),(2,91,'0.25',NULL,'1.00',NULL,NULL,NULL,0,1,NULL,NULL),(3,92,'1.00',NULL,'2.00',NULL,NULL,NULL,0,1,NULL,NULL),(4,109,'0.50',NULL,'2.00',NULL,NULL,NULL,0,1,NULL,NULL),(5,2,'1.50',NULL,'0.25',NULL,NULL,NULL,0,1,NULL,NULL),(6,3,'0.75',NULL,'1.25',NULL,NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_country_disease_symptoms` */

CREATE TABLE `bf_master_country_disease_symptoms` (
  `country_symptoms_id` int(11) NOT NULL AUTO_INCREMENT,
  `symptoms_regional_id` int(11) DEFAULT NULL,
  `symptoms_country_name` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`country_symptoms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_country_disease_symptoms` */

insert  into `bf_master_country_disease_symptoms`(`country_symptoms_id`,`symptoms_regional_id`,`symptoms_country_name`,`created_by_user`,`modified_by_user`,`country_id`,`deleted`,`status`,`created_on`,`modified_on`) values (1,1,'test1',NULL,NULL,101,0,1,NULL,NULL),(2,2,'test2',NULL,NULL,101,0,1,NULL,NULL),(3,3,'test3',NULL,NULL,101,0,1,NULL,NULL);

/*Table structure for table `bf_master_crop_country` */

CREATE TABLE `bf_master_crop_country` (
  `crop_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `crop_id` int(11) DEFAULT NULL,
  `crop_name` varchar(255) DEFAULT NULL,
  `crop_code` varchar(255) DEFAULT NULL,
  `Description` text,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`crop_country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_crop_country` */

insert  into `bf_master_crop_country`(`crop_country_id`,`crop_id`,`crop_name`,`crop_code`,`Description`,`country_id`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,1,'Grapes','1','',101,0,0,0,1,NULL,NULL),(2,2,'Banana','2','',101,0,0,0,1,NULL,NULL),(3,3,'Apple','3','',101,0,0,0,1,NULL,NULL),(4,4,'Potato','4','',101,0,0,0,1,NULL,NULL),(5,5,'Mango','5','',101,0,0,0,1,NULL,NULL),(6,6,'Ground Nut','6','',101,0,0,0,1,NULL,NULL),(7,7,'Cucurbits','7','',101,0,0,0,1,NULL,NULL),(8,8,'Chili','8','',101,0,0,0,1,NULL,NULL),(9,9,'Corn','9','',101,0,0,0,1,NULL,NULL),(10,10,'Cucumber','10','',101,0,0,0,1,NULL,NULL),(11,1,'Grapes','1','',98,0,0,0,1,NULL,NULL),(12,2,'Banana','2','',98,0,0,0,1,NULL,NULL),(13,3,'Apple','3','',98,0,0,0,1,NULL,NULL),(14,4,'Potato','4','',98,0,0,0,1,NULL,NULL),(15,5,'Mango','5','',98,0,0,0,1,NULL,NULL),(16,6,'Ground Nut','6','',98,0,0,0,1,NULL,NULL),(17,7,'Cucurbits','7','',98,0,0,0,1,NULL,NULL),(18,8,'Chili','8','',98,0,0,0,1,NULL,NULL),(19,9,'Corn','9','',98,0,0,0,1,NULL,NULL),(20,10,'Cucumber','10','',98,0,0,0,1,NULL,NULL),(21,1,'Grapes','1','',151,0,0,0,1,NULL,NULL),(22,2,'Banana','2','',151,0,0,0,1,NULL,NULL),(23,3,'Apple','3','',151,0,0,0,1,NULL,NULL),(24,4,'Potato','4','',151,0,0,0,1,NULL,NULL),(25,5,'Mango','5','',151,0,0,0,1,NULL,NULL),(26,6,'Ground Nut','6','',151,0,0,0,1,NULL,NULL),(27,7,'Cucurbits','7','',151,0,0,0,1,NULL,NULL),(28,8,'Chili','8','',151,0,0,0,1,NULL,NULL),(29,9,'Corn','9','',151,0,0,0,1,NULL,NULL),(30,10,'Cucumber','10','',151,0,0,0,1,NULL,NULL),(31,1,'Grapes','1','',231,0,0,0,1,NULL,NULL),(32,2,'Banana','2','',231,0,0,0,1,NULL,NULL),(33,3,'Apple','3','',231,0,0,0,1,NULL,NULL),(34,4,'Potato','4','',231,0,0,0,1,NULL,NULL),(35,5,'Mango','5','',231,0,0,0,1,NULL,NULL),(36,6,'Ground Nut','6','',231,0,0,0,1,NULL,NULL),(37,7,'Cucurbits','7','',231,0,0,0,1,NULL,NULL),(38,8,'Chili','8','',231,0,0,0,1,NULL,NULL),(39,9,'Corn','9','',231,0,0,0,1,NULL,NULL),(40,10,'Cucumber','10','',231,0,0,0,1,NULL,NULL),(41,1,'Grapes','1','',170,0,0,0,1,NULL,NULL),(42,2,'Banana','2','',170,0,0,0,1,NULL,NULL),(43,3,'Apple','3','',170,0,0,0,1,NULL,NULL),(44,4,'Potato','4','',170,0,0,0,1,NULL,NULL),(45,5,'Mango','5','',170,0,0,0,1,NULL,NULL),(46,6,'Ground Nut','6','',170,0,0,0,1,NULL,NULL),(47,7,'Cucurbits','7','',170,0,0,0,1,NULL,NULL),(48,8,'Chili','8','',170,0,0,0,1,NULL,NULL),(49,9,'Corn','9','',170,0,0,0,1,NULL,NULL),(50,10,'Cucumber','10','',170,0,0,0,1,NULL,NULL),(51,1,'Grapes','1','',190,0,0,0,1,NULL,NULL),(52,2,'Banana','2','',190,0,0,0,1,NULL,NULL),(53,3,'Apple','3','',190,0,0,0,1,NULL,NULL),(54,4,'Potato','4','',190,0,0,0,1,NULL,NULL),(55,5,'Mango','5','',190,0,0,0,1,NULL,NULL),(56,6,'Ground Nut','6','',190,0,0,0,1,NULL,NULL),(57,7,'Cucurbits','7','',190,0,0,0,1,NULL,NULL),(58,8,'Chili','8','',190,0,0,0,1,NULL,NULL),(59,9,'Corn','9','',190,0,0,0,1,NULL,NULL),(60,10,'Cucumber','10','',190,0,0,0,1,NULL,NULL),(61,1,'Grapes','1','',208,0,0,0,1,NULL,NULL),(62,2,'Banana','2','',208,0,0,0,1,NULL,NULL),(63,3,'Apple','3','',208,0,0,0,1,NULL,NULL),(64,4,'Potato','4','',208,0,0,0,1,NULL,NULL),(65,5,'Mango','5','',208,0,0,0,1,NULL,NULL),(66,6,'Ground Nut','6','',208,0,0,0,1,NULL,NULL),(67,7,'Cucurbits','7','',208,0,0,0,1,NULL,NULL),(68,8,'Chili','8','',208,0,0,0,1,NULL,NULL),(69,9,'Corn','9','',208,0,0,0,1,NULL,NULL),(70,10,'Cucumber','10','',208,0,0,0,1,NULL,NULL);

/*Table structure for table `bf_master_crop_regional` */

CREATE TABLE `bf_master_crop_regional` (
  `crop_id` int(11) NOT NULL AUTO_INCREMENT,
  `crop_name` varchar(255) DEFAULT NULL,
  `crop_code` varchar(255) DEFAULT NULL,
  `Description` text,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`crop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_crop_regional` */

insert  into `bf_master_crop_regional`(`crop_id`,`crop_name`,`crop_code`,`Description`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,'Grapes','1',NULL,NULL,NULL,0,1,NULL,NULL),(2,'Banana\r\n','2',NULL,NULL,NULL,0,1,NULL,NULL),(3,'Apple\r\n','3',NULL,NULL,NULL,0,1,NULL,NULL),(4,'Potato\r\n','4',NULL,NULL,NULL,0,1,NULL,NULL),(5,'Mango\r\n','5',NULL,NULL,NULL,0,1,NULL,NULL),(6,'Ground Nut\r\n','6',NULL,NULL,NULL,0,1,NULL,NULL),(7,'Cucurbits\r\n','7',NULL,NULL,NULL,0,1,NULL,NULL),(8,'Chili\r\n','8',NULL,NULL,NULL,0,1,NULL,NULL),(9,'Corn\r\n','9',NULL,NULL,NULL,0,1,NULL,NULL),(10,'Cucumber\r\n','10',NULL,NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_customer_business_details` */

CREATE TABLE `bf_master_customer_business_details` (
  `customer_business_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `avg_daily_counter` int(11) DEFAULT NULL,
  `avg_daily_footfalls` int(11) DEFAULT NULL,
  `contact_no` int(11) DEFAULT NULL,
  `house_no` varchar(255) DEFAULT NULL,
  `address` text,
  `landmark` varchar(255) DEFAULT NULL,
  `geo_level_id1` int(11) DEFAULT NULL,
  `geo_level_id2` int(11) DEFAULT NULL,
  `geo_level_id3` int(11) DEFAULT NULL,
  `pincode` varchar(30) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`customer_business_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_customer_business_details` */

/*Table structure for table `bf_master_customer_crop_details` */

CREATE TABLE `bf_master_customer_crop_details` (
  `customer_crop_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `crop_id` int(11) DEFAULT NULL,
  `yeild_HA` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`customer_crop_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_customer_crop_details` */

insert  into `bf_master_customer_crop_details`(`customer_crop_detail_id`,`user_id`,`crop_id`,`yeild_HA`) values (1,4,1,'10.00'),(2,4,2,'11.00'),(3,4,3,'12.00'),(4,5,5,'13.00'),(5,6,7,'14.00'),(6,6,8,'15.00'),(7,6,9,'16.00'),(8,6,10,'17.00'),(9,7,1,'18.00'),(10,7,8,'19.00'),(11,7,7,'20.00'),(12,7,4,'21.00'),(13,7,10,'22.00'),(14,8,8,'23.00'),(15,25,1,'24.00'),(16,25,10,'25.00'),(17,26,6,'26.00'),(18,26,4,'27.00'),(19,27,6,'28.00'),(20,27,6,'29.00'),(21,29,6,'30.00'),(22,4,2,'989.00'),(23,4,5,'787.00');

/*Table structure for table `bf_master_customer_farming_details` */

CREATE TABLE `bf_master_customer_farming_details` (
  `customer_framing_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `contact_no` int(20) DEFAULT NULL,
  `house_no` varchar(255) DEFAULT NULL,
  `address` text,
  `landmark` varchar(255) DEFAULT NULL,
  `geo_level_id1` int(11) DEFAULT NULL,
  `geo_level_id2` int(11) DEFAULT NULL,
  `geo_level_id3` int(11) DEFAULT NULL,
  `pincode` varchar(30) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`customer_framing_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_customer_farming_details` */

insert  into `bf_master_customer_farming_details`(`customer_framing_detail_id`,`user_id`,`contact_no`,`house_no`,`address`,`landmark`,`geo_level_id1`,`geo_level_id2`,`geo_level_id3`,`pincode`,`latitude`,`longitude`) values (1,4,NULL,'555','goverdhan vilas udaipur rajasthan india','dfsdf dsf dsf dsf ds',9,4,3,'6666','24.539069','73.6882723');

/*Table structure for table `bf_master_customer_to_customer_mapping` */

CREATE TABLE `bf_master_customer_to_customer_mapping` (
  `CtoC_mapping_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_customer_id` int(11) DEFAULT NULL,
  `to_customer_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`CtoC_mapping_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_customer_to_customer_mapping` */

insert  into `bf_master_customer_to_customer_mapping`(`CtoC_mapping_id`,`from_customer_id`,`to_customer_id`,`deleted`,`status`,`created_on`,`modified_on`) values (1,9,14,0,1,NULL,NULL),(2,9,15,0,1,NULL,NULL),(3,10,15,0,1,NULL,NULL),(4,10,16,0,1,NULL,NULL),(5,11,16,0,1,NULL,NULL),(6,11,17,0,1,NULL,NULL),(7,12,17,0,1,NULL,NULL),(8,12,18,0,1,NULL,NULL),(9,13,17,0,1,NULL,NULL),(10,13,18,0,1,NULL,NULL),(11,13,19,0,1,NULL,NULL),(12,14,4,0,1,NULL,NULL),(13,14,5,0,1,NULL,NULL),(14,15,5,0,1,NULL,NULL),(15,15,6,0,1,NULL,NULL),(16,16,6,0,1,NULL,NULL),(17,16,7,0,1,NULL,NULL),(18,16,8,0,1,NULL,NULL),(19,17,4,0,1,NULL,NULL),(20,17,6,0,1,NULL,NULL),(21,17,8,0,1,NULL,NULL),(22,18,3,0,1,NULL,NULL),(23,18,7,0,1,NULL,NULL),(24,19,4,0,1,NULL,NULL),(25,19,5,0,1,NULL,NULL),(26,19,6,0,1,NULL,NULL),(27,19,7,0,1,NULL,NULL),(28,19,8,0,1,NULL,NULL),(29,35,30,0,1,NULL,NULL),(30,35,31,0,1,NULL,NULL),(31,36,32,0,1,NULL,NULL),(32,36,33,0,1,NULL,NULL),(33,37,30,0,1,NULL,NULL),(34,37,34,0,1,NULL,NULL),(35,38,30,0,1,NULL,NULL),(36,38,32,0,1,NULL,NULL),(37,39,30,0,1,NULL,NULL),(38,39,31,0,1,NULL,NULL),(39,39,32,0,1,NULL,NULL),(40,39,33,0,1,NULL,NULL),(41,30,25,0,1,NULL,NULL),(42,30,26,0,1,NULL,NULL),(43,31,26,0,1,NULL,NULL),(44,31,27,0,1,NULL,NULL),(45,32,27,0,1,NULL,NULL),(46,32,27,0,1,NULL,NULL),(47,33,28,0,1,NULL,NULL),(48,33,29,0,1,NULL,NULL),(49,34,26,0,1,NULL,NULL),(50,34,27,0,1,NULL,NULL),(51,34,28,0,1,NULL,NULL),(52,19,10,0,1,NULL,NULL),(53,19,11,0,1,NULL,NULL),(54,19,12,0,1,NULL,NULL),(55,19,13,0,1,NULL,NULL),(61,4,18,0,1,NULL,NULL),(62,4,17,0,1,NULL,NULL);

/*Table structure for table `bf_master_customer_type_country` */

CREATE TABLE `bf_master_customer_type_country` (
  `customer_type_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_type_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `customer_type_code` varchar(30) DEFAULT NULL,
  `customer_type_name` varchar(255) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`customer_type_country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_customer_type_country` */

insert  into `bf_master_customer_type_country`(`customer_type_country_id`,`customer_type_id`,`country_id`,`customer_type_code`,`customer_type_name`,`description`,`deleted`,`status`,`created_by_user`,`modified_by_user`,`created_on`,`modified_on`) values (1,1,101,'001','Farmer','Farmer',0,1,3,3,'2016-05-09 00:00:00','0000-00-00 00:00:00'),(2,2,101,'002','Retailer',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,3,101,'003','Distributor',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,1,98,'004','Farmer',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,2,98,'005','Retailer',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,3,98,'006','Distributor',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,1,151,'007','Farmer',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,2,151,'008','Retailer',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,3,151,'009','Distributor',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,1,231,'010','Farmer',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,2,231,'011','Retailer',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,3,231,'012','Distributor',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,1,170,'013','Farmer',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,2,170,'014','Retailer',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,3,170,'015','Distributor',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,1,190,'016','Farmer',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,2,190,'017','Retailer',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,3,190,'018','Distributor',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(19,1,208,'019','Farmer',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,2,208,'020','Retailer',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(21,3,208,'021','Distributor',NULL,0,1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `bf_master_customer_type_regional` */

CREATE TABLE `bf_master_customer_type_regional` (
  `customer_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `customer_level` varchar(255) NOT NULL,
  `customer_type_name` varchar(255) NOT NULL,
  `customer_type_code` varchar(100) NOT NULL,
  `customer_type_description` text,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`customer_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `bf_master_customer_type_regional` */

insert  into `bf_master_customer_type_regional`(`customer_type_id`,`status`,`customer_level`,`customer_type_name`,`customer_type_code`,`customer_type_description`,`created_by_user`,`modified_by_user`,`deleted`,`created_on`,`modified_on`) values (1,1,'L1','Farmer','001','Farmer',3,3,0,'2016-05-09 00:00:00','0000-00-00 00:00:00'),(2,1,'L2','Retailer','002','Retailer',NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,1,'L3','Distributor','003','Distributor',NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `bf_master_customer_type_to_geo_mapping` */

CREATE TABLE `bf_master_customer_type_to_geo_mapping` (
  `ct_to_g_mapping_id` int(11) NOT NULL AUTO_INCREMENT,
  `cusomer_type_id` int(11) DEFAULT NULL,
  `geo_id` int(11) DEFAULT NULL COMMENT 'it stands for geo_level_id',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`ct_to_g_mapping_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_customer_type_to_geo_mapping` */

insert  into `bf_master_customer_type_to_geo_mapping`(`ct_to_g_mapping_id`,`cusomer_type_id`,`geo_id`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,3,4,NULL,NULL,0,1,NULL,NULL),(2,2,3,NULL,NULL,0,1,NULL,NULL),(3,1,2,NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_department_country` */

CREATE TABLE `bf_master_department_country` (
  `department_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_regional_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `department_country_name` varchar(255) DEFAULT NULL,
  `department_country_code` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`department_country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_department_country` */

/*Table structure for table `bf_master_department_regional` */

CREATE TABLE `bf_master_department_regional` (
  `department_regional_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_regional_name` varchar(255) DEFAULT NULL,
  `department_regional_code` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`department_regional_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_department_regional` */

/*Table structure for table `bf_master_designation_country` */

CREATE TABLE `bf_master_designation_country` (
  `desigination_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `desigination_regional_id` int(11) DEFAULT NULL,
  `desigination_country_name` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `business_geo_level_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`desigination_country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_designation_country` */

insert  into `bf_master_designation_country`(`desigination_country_id`,`desigination_regional_id`,`desigination_country_name`,`country_id`,`business_geo_level_id`,`deleted`,`status`,`created_by_user`,`modified_by_user`,`created_on`,`modified_on`) values (1,1,'SM',101,NULL,0,1,NULL,NULL,'2016-06-16 00:00:00','2016-06-16 00:00:00'),(2,2,'ASM',101,NULL,0,1,NULL,NULL,'2016-06-16 00:00:00','2016-06-16 00:00:00'),(3,3,'EE',101,NULL,0,1,NULL,NULL,'2016-06-16 00:00:00','2016-06-16 00:00:00'),(4,4,'HO',101,NULL,0,1,NULL,NULL,'2016-06-16 00:00:00','2016-06-16 00:00:00'),(5,5,'FO',101,NULL,0,1,NULL,NULL,'2016-06-16 00:00:00','2016-06-16 00:00:00');

/*Table structure for table `bf_master_designation_regional` */

CREATE TABLE `bf_master_designation_regional` (
  `desigination_regional_id` int(11) NOT NULL AUTO_INCREMENT,
  `regional_level` varchar(255) DEFAULT NULL,
  `desigination_regional_name` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`desigination_regional_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_designation_regional` */

insert  into `bf_master_designation_regional`(`desigination_regional_id`,`regional_level`,`desigination_regional_name`,`deleted`,`status`,`created_by_user`,`modified_by_user`,`created_on`,`modified_on`) values (1,'L3','sales manager',0,1,NULL,NULL,'2016-06-16 00:00:00','2016-06-16 00:00:00'),(2,'L2','Asst Sales Manager',0,1,NULL,NULL,'2016-06-16 00:00:00','2016-06-16 00:00:00'),(3,'L1','Executive',0,1,NULL,NULL,'2016-06-16 00:00:00','2016-06-16 00:00:00'),(4,'L5','Ho',0,1,NULL,NULL,'2016-06-16 00:00:00','2016-06-16 00:00:00'),(5,'L4','FO',0,1,NULL,NULL,'2016-06-16 00:00:00','2016-06-16 00:00:00');

/*Table structure for table `bf_master_designation_role` */

CREATE TABLE `bf_master_designation_role` (
  `desigination_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `desigination_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`desigination_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_designation_role` */

insert  into `bf_master_designation_role`(`desigination_role_id`,`desigination_id`,`role_id`,`user_id`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,1,8,47,NULL,NULL,0,1,NULL,NULL),(2,2,8,46,NULL,NULL,0,1,NULL,NULL),(3,3,8,48,NULL,NULL,0,1,NULL,NULL),(4,4,7,45,NULL,NULL,0,1,NULL,NULL),(5,5,8,20,NULL,NULL,0,1,NULL,NULL),(6,1,8,46,NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_disease_country` */

CREATE TABLE `bf_master_disease_country` (
  `disease_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `disease_id` int(11) DEFAULT NULL,
  `disease_name` varchar(255) DEFAULT NULL,
  `disease_code` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`disease_country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_disease_country` */

insert  into `bf_master_disease_country`(`disease_country_id`,`disease_id`,`disease_name`,`disease_code`,`country_id`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,1,'Botrytis(Grey or Noble Rot)','1',101,0,0,0,1,NULL,NULL),(2,2,'Blast','2',101,0,0,0,1,NULL,NULL),(3,3,'Apple scab','3',101,0,0,0,1,NULL,NULL),(4,4,'Fusarium Wilt','4',101,0,0,0,1,NULL,NULL),(5,5,'Powdery Mildew Tomato','5',101,0,0,0,1,NULL,NULL),(6,6,'Anthracnose Tomato','6',101,0,0,0,1,NULL,NULL),(7,7,'Early Blight Tomato','7',101,0,0,0,1,NULL,NULL),(8,8,'Late Blight Tomato','8',101,0,0,0,1,NULL,NULL),(9,9,'Sooty Mold','9',101,0,0,0,1,NULL,NULL),(10,10,'Diplodia Stem End Rot','10',101,0,0,0,1,NULL,NULL),(11,11,'Scab','11',101,0,0,0,1,NULL,NULL),(12,12,'Anthracnose Mango','12',101,0,0,0,1,NULL,NULL),(13,13,'Stem rot','13',101,0,0,0,1,NULL,NULL),(14,14,'Aspergellus Crown rot','14',101,0,0,0,1,NULL,NULL),(15,15,'Rust','15',101,0,0,0,1,NULL,NULL),(16,16,'Late Leaf Spot','16',101,0,0,0,1,NULL,NULL),(17,17,'Early Leaf Spot','17',101,0,0,0,1,NULL,NULL),(18,18,'Alternaria Blight','18',101,0,0,0,1,NULL,NULL),(19,19,'Anthracnose Cucurbits','19',101,0,0,0,1,NULL,NULL),(20,20,'Powdery Mildew Cucurbits','20',101,0,0,0,1,NULL,NULL),(21,21,'Downy Mildew Cucurbits','21',101,0,0,0,1,NULL,NULL),(22,22,'Damping Off Cucurbits','22',101,0,0,0,1,NULL,NULL),(23,23,'Choanephora Blight','23',101,0,0,0,1,NULL,NULL),(24,24,'Alternaria Leaf Spot','24',101,0,0,0,1,NULL,NULL),(25,25,'Cercospora Leaf Spot Chili','25',101,0,0,0,1,NULL,NULL),(26,26,'Powdery Mildew Chili','26',101,0,0,0,1,NULL,NULL),(27,27,'Damping Off','27',101,0,0,0,1,NULL,NULL),(28,28,'Anthracnose','28',101,0,0,0,1,NULL,NULL),(29,29,'Freckles','29',101,0,0,0,1,NULL,NULL),(30,1,'Botrytis(Grey or Noble Rot)','1',98,0,0,0,1,NULL,NULL),(31,2,'Blast','2',98,0,0,0,1,NULL,NULL),(32,3,'Apple scab','3',98,0,0,0,1,NULL,NULL),(33,4,'Fusarium Wilt','4',98,0,0,0,1,NULL,NULL),(34,5,'Powdery Mildew Tomato','5',98,0,0,0,1,NULL,NULL),(35,6,'Anthracnose Tomato','6',98,0,0,0,1,NULL,NULL),(36,7,'Early Blight Tomato','7',98,0,0,0,1,NULL,NULL),(37,8,'Late Blight Tomato','8',98,0,0,0,1,NULL,NULL),(38,9,'Sooty Mold','9',98,0,0,0,1,NULL,NULL),(39,10,'Diplodia Stem End Rot','10',98,0,0,0,1,NULL,NULL),(40,11,'Scab','11',98,0,0,0,1,NULL,NULL),(41,12,'Anthracnose Mango','12',98,0,0,0,1,NULL,NULL),(42,13,'Stem rot','13',98,0,0,0,1,NULL,NULL),(43,14,'Aspergellus Crown rot','14',98,0,0,0,1,NULL,NULL),(44,15,'Rust','15',98,0,0,0,1,NULL,NULL),(45,16,'Late Leaf Spot','16',98,0,0,0,1,NULL,NULL),(46,17,'Early Leaf Spot','17',98,0,0,0,1,NULL,NULL),(47,18,'Alternaria Blight','18',98,0,0,0,1,NULL,NULL),(48,19,'Anthracnose Cucurbits','19',98,0,0,0,1,NULL,NULL),(49,20,'Powdery Mildew Cucurbits','20',98,0,0,0,1,NULL,NULL),(50,21,'Downy Mildew Cucurbits','21',98,0,0,0,1,NULL,NULL),(51,22,'Damping Off Cucurbits','22',98,0,0,0,1,NULL,NULL),(52,23,'Choanephora Blight','23',98,0,0,0,1,NULL,NULL),(53,24,'Alternaria Leaf Spot','24',98,0,0,0,1,NULL,NULL),(54,25,'Cercospora Leaf Spot Chili','25',98,0,0,0,1,NULL,NULL),(55,26,'Powdery Mildew Chili','26',98,0,0,0,1,NULL,NULL),(56,27,'Damping Off','27',98,0,0,0,1,NULL,NULL),(57,28,'Anthracnose','28',98,0,0,0,1,NULL,NULL),(58,29,'Freckles','29',98,0,0,0,1,NULL,NULL),(59,1,'Botrytis(Grey or Noble Rot)','1',151,0,0,0,1,NULL,NULL),(60,2,'Blast','2',151,0,0,0,1,NULL,NULL),(61,3,'Apple scab','3',151,0,0,0,1,NULL,NULL),(62,4,'Fusarium Wilt','4',151,0,0,0,1,NULL,NULL),(63,5,'Powdery Mildew Tomato','5',151,0,0,0,1,NULL,NULL),(64,6,'Anthracnose Tomato','6',151,0,0,0,1,NULL,NULL),(65,7,'Early Blight Tomato','7',151,0,0,0,1,NULL,NULL),(66,8,'Late Blight Tomato','8',151,0,0,0,1,NULL,NULL),(67,9,'Sooty Mold','9',151,0,0,0,1,NULL,NULL),(68,10,'Diplodia Stem End Rot','10',151,0,0,0,1,NULL,NULL),(69,11,'Scab','11',151,0,0,0,1,NULL,NULL),(70,12,'Anthracnose Mango','12',151,0,0,0,1,NULL,NULL),(71,13,'Stem rot','13',151,0,0,0,1,NULL,NULL),(72,14,'Aspergellus Crown rot','14',151,0,0,0,1,NULL,NULL),(73,15,'Rust','15',151,0,0,0,1,NULL,NULL),(74,16,'Late Leaf Spot','16',151,0,0,0,1,NULL,NULL),(75,17,'Early Leaf Spot','17',151,0,0,0,1,NULL,NULL),(76,18,'Alternaria Blight','18',151,0,0,0,1,NULL,NULL),(77,19,'Anthracnose Cucurbits','19',151,0,0,0,1,NULL,NULL),(78,20,'Powdery Mildew Cucurbits','20',151,0,0,0,1,NULL,NULL),(79,21,'Downy Mildew Cucurbits','21',151,0,0,0,1,NULL,NULL),(80,22,'Damping Off Cucurbits','22',151,0,0,0,1,NULL,NULL),(81,23,'Choanephora Blight','23',151,0,0,0,1,NULL,NULL),(82,24,'Alternaria Leaf Spot','24',151,0,0,0,1,NULL,NULL),(83,25,'Cercospora Leaf Spot Chili','25',151,0,0,0,1,NULL,NULL),(84,26,'Powdery Mildew Chili','26',151,0,0,0,1,NULL,NULL),(85,27,'Damping Off','27',151,0,0,0,1,NULL,NULL),(86,28,'Anthracnose','28',151,0,0,0,1,NULL,NULL),(87,29,'Freckles','29',151,0,0,0,1,NULL,NULL),(88,1,'Botrytis(Grey or Noble Rot)','1',231,0,0,0,1,NULL,NULL),(89,2,'Blast','2',231,0,0,0,1,NULL,NULL),(90,3,'Apple scab','3',231,0,0,0,1,NULL,NULL),(91,4,'Fusarium Wilt','4',231,0,0,0,1,NULL,NULL),(92,5,'Powdery Mildew Tomato','5',231,0,0,0,1,NULL,NULL),(93,6,'Anthracnose Tomato','6',231,0,0,0,1,NULL,NULL),(94,7,'Early Blight Tomato','7',231,0,0,0,1,NULL,NULL),(95,8,'Late Blight Tomato','8',231,0,0,0,1,NULL,NULL),(96,9,'Sooty Mold','9',231,0,0,0,1,NULL,NULL),(97,10,'Diplodia Stem End Rot','10',231,0,0,0,1,NULL,NULL),(98,11,'Scab','11',231,0,0,0,1,NULL,NULL),(99,12,'Anthracnose Mango','12',231,0,0,0,1,NULL,NULL),(100,13,'Stem rot','13',231,0,0,0,1,NULL,NULL),(101,14,'Aspergellus Crown rot','14',231,0,0,0,1,NULL,NULL),(102,15,'Rust','15',231,0,0,0,1,NULL,NULL),(103,16,'Late Leaf Spot','16',231,0,0,0,1,NULL,NULL),(104,17,'Early Leaf Spot','17',231,0,0,0,1,NULL,NULL),(105,18,'Alternaria Blight','18',231,0,0,0,1,NULL,NULL),(106,19,'Anthracnose Cucurbits','19',231,0,0,0,1,NULL,NULL),(107,20,'Powdery Mildew Cucurbits','20',231,0,0,0,1,NULL,NULL),(108,21,'Downy Mildew Cucurbits','21',231,0,0,0,1,NULL,NULL),(109,22,'Damping Off Cucurbits','22',231,0,0,0,1,NULL,NULL),(110,23,'Choanephora Blight','23',231,0,0,0,1,NULL,NULL),(111,24,'Alternaria Leaf Spot','24',231,0,0,0,1,NULL,NULL),(112,25,'Cercospora Leaf Spot Chili','25',231,0,0,0,1,NULL,NULL),(113,26,'Powdery Mildew Chili','26',231,0,0,0,1,NULL,NULL),(114,27,'Damping Off','27',231,0,0,0,1,NULL,NULL),(115,28,'Anthracnose','28',231,0,0,0,1,NULL,NULL),(116,29,'Freckles','29',231,0,0,0,1,NULL,NULL),(117,1,'Botrytis(Grey or Noble Rot)','1',170,0,0,0,1,NULL,NULL),(118,2,'Blast','2',170,0,0,0,1,NULL,NULL),(119,3,'Apple scab','3',170,0,0,0,1,NULL,NULL),(120,4,'Fusarium Wilt','4',170,0,0,0,1,NULL,NULL),(121,5,'Powdery Mildew Tomato','5',170,0,0,0,1,NULL,NULL),(122,6,'Anthracnose Tomato','6',170,0,0,0,1,NULL,NULL),(123,7,'Early Blight Tomato','7',170,0,0,0,1,NULL,NULL),(124,8,'Late Blight Tomato','8',170,0,0,0,1,NULL,NULL),(125,9,'Sooty Mold','9',170,0,0,0,1,NULL,NULL),(126,10,'Diplodia Stem End Rot','10',170,0,0,0,1,NULL,NULL),(127,11,'Scab','11',170,0,0,0,1,NULL,NULL),(128,12,'Anthracnose Mango','12',170,0,0,0,1,NULL,NULL),(129,13,'Stem rot','13',170,0,0,0,1,NULL,NULL),(130,14,'Aspergellus Crown rot','14',170,0,0,0,1,NULL,NULL),(131,15,'Rust','15',170,0,0,0,1,NULL,NULL),(132,16,'Late Leaf Spot','16',170,0,0,0,1,NULL,NULL),(133,17,'Early Leaf Spot','17',170,0,0,0,1,NULL,NULL),(134,18,'Alternaria Blight','18',170,0,0,0,1,NULL,NULL),(135,19,'Anthracnose Cucurbits','19',170,0,0,0,1,NULL,NULL),(136,20,'Powdery Mildew Cucurbits','20',170,0,0,0,1,NULL,NULL),(137,21,'Downy Mildew Cucurbits','21',170,0,0,0,1,NULL,NULL),(138,22,'Damping Off Cucurbits','22',170,0,0,0,1,NULL,NULL),(139,23,'Choanephora Blight','23',170,0,0,0,1,NULL,NULL),(140,24,'Alternaria Leaf Spot','24',170,0,0,0,1,NULL,NULL),(141,25,'Cercospora Leaf Spot Chili','25',170,0,0,0,1,NULL,NULL),(142,26,'Powdery Mildew Chili','26',170,0,0,0,1,NULL,NULL),(143,27,'Damping Off','27',170,0,0,0,1,NULL,NULL),(144,28,'Anthracnose','28',170,0,0,0,1,NULL,NULL),(145,29,'Freckles','29',170,0,0,0,1,NULL,NULL),(146,1,'Botrytis(Grey or Noble Rot)','1',190,0,0,0,1,NULL,NULL),(147,2,'Blast','2',190,0,0,0,1,NULL,NULL),(148,3,'Apple scab','3',190,0,0,0,1,NULL,NULL),(149,4,'Fusarium Wilt','4',190,0,0,0,1,NULL,NULL),(150,5,'Powdery Mildew Tomato','5',190,0,0,0,1,NULL,NULL),(151,6,'Anthracnose Tomato','6',190,0,0,0,1,NULL,NULL),(152,7,'Early Blight Tomato','7',190,0,0,0,1,NULL,NULL),(153,8,'Late Blight Tomato','8',190,0,0,0,1,NULL,NULL),(154,9,'Sooty Mold','9',190,0,0,0,1,NULL,NULL),(155,10,'Diplodia Stem End Rot','10',190,0,0,0,1,NULL,NULL),(156,11,'Scab','11',190,0,0,0,1,NULL,NULL),(157,12,'Anthracnose Mango','12',190,0,0,0,1,NULL,NULL),(158,13,'Stem rot','13',190,0,0,0,1,NULL,NULL),(159,14,'Aspergellus Crown rot','14',190,0,0,0,1,NULL,NULL),(160,15,'Rust','15',190,0,0,0,1,NULL,NULL),(161,16,'Late Leaf Spot','16',190,0,0,0,1,NULL,NULL),(162,17,'Early Leaf Spot','17',190,0,0,0,1,NULL,NULL),(163,18,'Alternaria Blight','18',190,0,0,0,1,NULL,NULL),(164,19,'Anthracnose Cucurbits','19',190,0,0,0,1,NULL,NULL),(165,20,'Powdery Mildew Cucurbits','20',190,0,0,0,1,NULL,NULL),(166,21,'Downy Mildew Cucurbits','21',190,0,0,0,1,NULL,NULL),(167,22,'Damping Off Cucurbits','22',190,0,0,0,1,NULL,NULL),(168,23,'Choanephora Blight','23',190,0,0,0,1,NULL,NULL),(169,24,'Alternaria Leaf Spot','24',190,0,0,0,1,NULL,NULL),(170,25,'Cercospora Leaf Spot Chili','25',190,0,0,0,1,NULL,NULL),(171,26,'Powdery Mildew Chili','26',190,0,0,0,1,NULL,NULL),(172,27,'Damping Off','27',190,0,0,0,1,NULL,NULL),(173,28,'Anthracnose','28',190,0,0,0,1,NULL,NULL),(174,29,'Freckles','29',190,0,0,0,1,NULL,NULL),(175,1,'Botrytis(Grey or Noble Rot)','1',208,0,0,0,1,NULL,NULL),(176,2,'Blast','2',208,0,0,0,1,NULL,NULL),(177,3,'Apple scab','3',208,0,0,0,1,NULL,NULL),(178,4,'Fusarium Wilt','4',208,0,0,0,1,NULL,NULL),(179,5,'Powdery Mildew Tomato','5',208,0,0,0,1,NULL,NULL),(180,6,'Anthracnose Tomato','6',208,0,0,0,1,NULL,NULL),(181,7,'Early Blight Tomato','7',208,0,0,0,1,NULL,NULL),(182,8,'Late Blight Tomato','8',208,0,0,0,1,NULL,NULL),(183,9,'Sooty Mold','9',208,0,0,0,1,NULL,NULL),(184,10,'Diplodia Stem End Rot','10',208,0,0,0,1,NULL,NULL),(185,11,'Scab','11',208,0,0,0,1,NULL,NULL),(186,12,'Anthracnose Mango','12',208,0,0,0,1,NULL,NULL),(187,13,'Stem rot','13',208,0,0,0,1,NULL,NULL),(188,14,'Aspergellus Crown rot','14',208,0,0,0,1,NULL,NULL),(189,15,'Rust','15',208,0,0,0,1,NULL,NULL),(190,16,'Late Leaf Spot','16',208,0,0,0,1,NULL,NULL),(191,17,'Early Leaf Spot','17',208,0,0,0,1,NULL,NULL),(192,18,'Alternaria Blight','18',208,0,0,0,1,NULL,NULL),(193,19,'Anthracnose Cucurbits','19',208,0,0,0,1,NULL,NULL),(194,20,'Powdery Mildew Cucurbits','20',208,0,0,0,1,NULL,NULL),(195,21,'Downy Mildew Cucurbits','21',208,0,0,0,1,NULL,NULL),(196,22,'Damping Off Cucurbits','22',208,0,0,0,1,NULL,NULL),(197,23,'Choanephora Blight','23',208,0,0,0,1,NULL,NULL),(198,24,'Alternaria Leaf Spot','24',208,0,0,0,1,NULL,NULL),(199,25,'Cercospora Leaf Spot Chili','25',208,0,0,0,1,NULL,NULL),(200,26,'Powdery Mildew Chili','26',208,0,0,0,1,NULL,NULL),(201,27,'Damping Off','27',208,0,0,0,1,NULL,NULL),(202,28,'Anthracnose','28',208,0,0,0,1,NULL,NULL),(203,29,'Freckles','29',208,0,0,0,1,NULL,NULL);

/*Table structure for table `bf_master_disease_crop_product_mapping` */

CREATE TABLE `bf_master_disease_crop_product_mapping` (
  `product_crop_disease_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_sku_id` int(11) DEFAULT NULL,
  `crop_id` int(11) DEFAULT NULL,
  `disease_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`product_crop_disease_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_disease_crop_product_mapping` */

insert  into `bf_master_disease_crop_product_mapping`(`product_crop_disease_id`,`product_sku_id`,`crop_id`,`disease_id`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,1,1,1,0,0,0,1,NULL,NULL),(2,2,2,1,0,0,0,1,NULL,NULL),(3,1,3,3,0,0,0,1,NULL,NULL),(4,2,3,4,0,0,0,1,NULL,NULL),(5,2,3,5,0,0,0,1,NULL,NULL),(6,2,3,6,0,0,0,1,NULL,NULL),(7,3,4,7,0,0,0,1,NULL,NULL),(8,3,4,8,0,0,0,1,NULL,NULL),(9,3,5,9,0,0,0,1,NULL,NULL),(10,4,5,10,0,0,0,1,NULL,NULL),(11,4,5,11,0,0,0,1,NULL,NULL),(12,4,5,12,0,0,0,1,NULL,NULL),(13,5,6,13,0,0,0,1,NULL,NULL),(14,5,6,1,0,0,0,1,NULL,NULL),(15,5,6,2,0,0,0,1,NULL,NULL),(16,5,6,3,0,0,0,1,NULL,NULL),(17,6,6,4,0,0,0,1,NULL,NULL),(18,6,7,5,0,0,0,1,NULL,NULL),(19,6,7,6,0,0,0,1,NULL,NULL),(20,7,7,7,0,0,0,1,NULL,NULL),(21,7,7,8,0,0,0,1,NULL,NULL),(22,7,7,9,0,0,0,1,NULL,NULL),(23,8,8,10,0,0,0,1,NULL,NULL),(24,8,8,11,0,0,0,1,NULL,NULL),(25,8,8,12,0,0,0,1,NULL,NULL),(26,9,8,13,0,0,0,1,NULL,NULL),(27,9,8,15,0,0,0,1,NULL,NULL),(28,9,8,16,0,0,0,1,NULL,NULL),(29,10,9,17,0,0,0,1,NULL,NULL),(30,11,9,18,0,0,0,1,NULL,NULL),(31,11,9,19,0,0,0,1,NULL,NULL),(32,11,10,20,0,0,0,1,NULL,NULL),(33,12,10,21,0,0,0,1,NULL,NULL),(34,12,10,22,0,0,0,1,NULL,NULL),(35,12,11,23,0,0,0,1,NULL,NULL),(36,13,11,24,0,0,0,1,NULL,NULL),(37,13,11,25,0,0,0,1,NULL,NULL),(38,13,12,26,0,0,0,1,NULL,NULL),(39,14,12,27,0,0,0,1,NULL,NULL),(40,14,12,28,0,0,0,1,NULL,NULL),(41,14,13,29,0,0,0,1,NULL,NULL),(42,15,13,1,0,0,0,1,NULL,NULL),(43,15,13,2,0,0,0,1,NULL,NULL),(44,15,14,3,0,0,0,1,NULL,NULL),(45,16,14,4,0,0,0,1,NULL,NULL),(46,16,14,5,0,0,0,1,NULL,NULL),(47,16,15,6,0,0,0,1,NULL,NULL),(48,17,15,7,0,0,0,1,NULL,NULL),(49,17,15,8,0,0,0,1,NULL,NULL),(50,17,16,9,0,0,0,1,NULL,NULL),(51,18,16,10,0,0,0,1,NULL,NULL),(52,18,16,11,0,0,0,1,NULL,NULL),(53,18,17,12,0,0,0,1,NULL,NULL),(54,19,17,13,0,0,0,1,NULL,NULL),(55,19,17,14,0,0,0,1,NULL,NULL),(56,19,18,15,0,0,0,1,NULL,NULL),(57,20,18,16,0,0,0,1,NULL,NULL),(58,20,18,17,0,0,0,1,NULL,NULL),(59,20,19,18,0,0,0,1,NULL,NULL);

/*Table structure for table `bf_master_disease_regional` */

CREATE TABLE `bf_master_disease_regional` (
  `disease_id` int(11) NOT NULL AUTO_INCREMENT,
  `disease_name` varchar(255) DEFAULT NULL,
  `disease_code` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`disease_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_disease_regional` */

insert  into `bf_master_disease_regional`(`disease_id`,`disease_name`,`disease_code`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,'Botrytis(Grey or Noble Rot)','1',0,0,0,1,NULL,NULL),(2,'Blast','2',0,0,0,1,NULL,NULL),(3,'Apple scab','3',0,0,0,1,NULL,NULL),(4,'Fusarium Wilt','4',0,0,0,1,NULL,NULL),(5,'Powdery Mildew Tomato','5',0,0,0,1,NULL,NULL),(6,'Anthracnose Tomato','6',0,0,0,1,NULL,NULL),(7,'Early Blight Tomato','7',0,0,0,1,NULL,NULL),(8,'Late Blight Tomato','8',0,0,0,1,NULL,NULL),(9,'Sooty Mold','9',0,0,0,1,NULL,NULL),(10,'Diplodia Stem End Rot','10',0,0,0,1,NULL,NULL),(11,'Scab','11',0,0,0,1,NULL,NULL),(12,'Anthracnose Mango','12',0,0,0,1,NULL,NULL),(13,'Stem rot','13',0,0,0,1,NULL,NULL),(14,'Aspergellus Crown rot','14',0,0,0,1,NULL,NULL),(15,'Rust','15',0,0,0,1,NULL,NULL),(16,'Late Leaf Spot','16',0,0,0,1,NULL,NULL),(17,'Early Leaf Spot','17',0,0,0,1,NULL,NULL),(18,'Alternaria Blight','18',0,0,0,1,NULL,NULL),(19,'Anthracnose Cucurbits','19',0,0,0,1,NULL,NULL),(20,'Powdery Mildew Cucurbits','20',0,0,0,1,NULL,NULL),(21,'Downy Mildew Cucurbits','21',0,0,0,1,NULL,NULL),(22,'Damping Off Cucurbits','22',0,0,0,1,NULL,NULL),(23,'Choanephora Blight','23',0,0,0,1,NULL,NULL),(24,'Alternaria Leaf Spot','24',0,0,0,1,NULL,NULL),(25,'Cercospora Leaf Spot Chili','25',0,0,0,1,NULL,NULL),(26,'Powdery Mildew Chili','26',0,0,0,1,NULL,NULL),(27,'Damping Off','27',0,0,0,1,NULL,NULL),(28,'Anthracnose','28',0,0,0,1,NULL,NULL),(29,'Freckles','29',0,0,0,1,NULL,NULL);

/*Table structure for table `bf_master_education_specialization` */

CREATE TABLE `bf_master_education_specialization` (
  `edu_specialization_id` int(11) NOT NULL AUTO_INCREMENT,
  `qualification_id` int(11) DEFAULT NULL,
  `edu_specialization_name` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`edu_specialization_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_education_specialization` */

insert  into `bf_master_education_specialization`(`edu_specialization_id`,`qualification_id`,`edu_specialization_name`,`deleted`,`status`,`created_on`,`modified_on`) values (1,1,'CSE',0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,1,'CIVIL',0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,2,'B.SC',0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,2,'B.COM',0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,3,'PHYSICS',0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,3,'MATHS',0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,4,'CIVIL DIP',0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,4,'CSE DIP',0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `bf_master_electonic` */

CREATE TABLE `bf_master_electonic` (
  `electonic_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`electonic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_electonic` */

insert  into `bf_master_electonic`(`electonic_id`,`item_name`,`deleted`,`status`,`created_on`,`modified_on`) values (1,'tv',0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'fridge',0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'cooler',0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'ac',0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `bf_master_employe_to_customer` */

CREATE TABLE `bf_master_employe_to_customer` (
  `employe_customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `year` date DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`employe_customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_employe_to_customer` */

insert  into `bf_master_employe_to_customer`(`employe_customer_id`,`customer_id`,`year`,`employee_id`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,4,'2016-01-01',20,0,0,0,1,NULL,NULL),(2,5,'2016-01-01',20,0,0,0,1,NULL,NULL),(3,6,'2016-01-01',20,0,0,0,1,NULL,NULL),(4,7,'2016-01-01',21,0,0,0,1,NULL,NULL),(5,8,'2016-01-01',21,0,0,0,1,NULL,NULL),(6,9,'2016-01-01',21,0,0,0,1,NULL,NULL),(7,10,'2016-01-01',22,0,0,0,1,NULL,NULL),(8,11,'2016-01-01',22,0,0,0,1,NULL,NULL),(9,12,'2016-01-01',22,0,0,0,1,NULL,NULL),(10,13,'2016-01-01',22,0,0,0,1,NULL,NULL),(11,14,'2016-01-01',23,0,0,0,1,NULL,NULL),(12,15,'2016-01-01',23,0,0,0,1,NULL,NULL),(13,16,'2016-01-01',23,0,0,0,1,NULL,NULL),(14,17,'2016-01-01',24,0,0,0,1,NULL,NULL),(15,18,'2016-01-01',24,0,0,0,1,NULL,NULL),(16,19,'2016-01-01',24,0,0,0,1,NULL,NULL),(17,25,'2016-01-01',40,0,0,0,1,NULL,NULL),(18,26,'2016-01-01',40,0,0,0,1,NULL,NULL),(19,27,'2016-01-01',40,0,0,0,1,NULL,NULL),(20,28,'2016-01-01',41,0,0,0,1,NULL,NULL),(21,29,'2016-01-01',41,0,0,0,1,NULL,NULL),(22,30,'2016-01-01',41,0,0,0,1,NULL,NULL),(23,31,'2016-01-01',42,0,0,0,1,NULL,NULL),(24,32,'2016-01-01',42,0,0,0,1,NULL,NULL),(25,33,'2016-01-01',42,0,0,0,1,NULL,NULL),(26,34,'2016-01-01',43,0,0,0,1,NULL,NULL),(27,35,'2016-01-01',43,0,0,0,1,NULL,NULL),(28,36,'2016-01-01',43,0,0,0,1,NULL,NULL),(29,37,'2016-01-01',44,0,0,0,1,NULL,NULL),(30,38,'2016-01-01',44,0,0,0,1,NULL,NULL),(31,39,'2016-01-01',44,0,0,0,1,NULL,NULL),(32,14,'2016-01-01',20,0,0,0,1,NULL,NULL),(33,15,'2016-01-01',20,0,0,0,1,NULL,NULL),(34,16,'2016-01-01',20,0,0,0,1,NULL,NULL),(35,17,'2016-01-01',20,0,0,0,1,NULL,NULL),(36,18,'2016-01-01',20,0,0,0,1,NULL,NULL),(37,19,'2016-01-01',20,0,0,0,1,NULL,NULL),(38,9,'2016-01-01',20,NULL,NULL,0,1,NULL,NULL),(39,10,'2016-01-01',20,NULL,NULL,0,1,NULL,NULL),(40,11,'2016-01-01',20,NULL,NULL,0,1,NULL,NULL),(41,12,'2016-01-01',20,NULL,NULL,0,1,NULL,NULL),(42,13,'2016-01-01',20,NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_employe_type` */

CREATE TABLE `bf_master_employe_type` (
  `employee_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_type_name` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`employee_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_employe_type` */

insert  into `bf_master_employe_type`(`employee_type_id`,`employee_type_name`,`deleted`,`status`,`created_on`,`modified_on`) values (1,'Regional HO',0,1,NULL,NULL),(2,'Country HO',0,1,NULL,NULL),(3,'Country Employee',0,1,NULL,NULL);

/*Table structure for table `bf_master_employee_current_profile` */

CREATE TABLE `bf_master_employee_current_profile` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `date_joining` date DEFAULT NULL,
  `date_confirmation` date DEFAULT NULL,
  `date_regisnation` date DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `desigination_id` int(11) DEFAULT NULL,
  `onhold` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_employee_current_profile` */

/*Table structure for table `bf_master_employee_experience_details` */

CREATE TABLE `bf_master_employee_experience_details` (
  `experince_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `organization_name` varchar(255) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `desigination` varchar(255) DEFAULT NULL,
  `roles_responsibility` text,
  PRIMARY KEY (`experince_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_employee_experience_details` */

/*Table structure for table `bf_master_employee_reporting_person` */

CREATE TABLE `bf_master_employee_reporting_person` (
  `reporting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `desigination_id` int(11) NOT NULL,
  `reporting_user_id` int(11) NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  PRIMARY KEY (`reporting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_employee_reporting_person` */

insert  into `bf_master_employee_reporting_person`(`reporting_id`,`user_id`,`desigination_id`,`reporting_user_id`,`from_date`,`to_date`) values (1,46,4,45,'2016-06-01',NULL),(2,47,2,46,'2016-06-01',NULL),(3,48,1,47,'2016-06-01',NULL),(4,49,1,47,'2016-06-01',NULL),(5,50,1,47,'2016-06-01',NULL),(6,51,2,46,'2016-06-01',NULL),(7,52,2,46,'2016-06-01',NULL),(8,53,4,45,'2016-06-01',NULL),(9,54,4,45,'2016-06-01',NULL),(10,20,1,47,'2016-06-01',NULL);

/*Table structure for table `bf_master_employee_to_geo` */

CREATE TABLE `bf_master_employee_to_geo` (
  `employe_geo_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` date DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `geo_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`employe_geo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_employee_to_geo` */

/*Table structure for table `bf_master_political_geography_details` */

CREATE TABLE `bf_master_political_geography_details` (
  `political_geo_id` int(11) NOT NULL AUTO_INCREMENT,
  `geo_level_id` int(11) DEFAULT NULL,
  `parent_geo_id` int(11) DEFAULT NULL,
  `political_geography_code` varchar(255) DEFAULT NULL,
  `political_geography_name` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`political_geo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_political_geography_details` */

insert  into `bf_master_political_geography_details`(`political_geo_id`,`geo_level_id`,`parent_geo_id`,`political_geography_code`,`political_geography_name`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,6,0,'1','Philippines',NULL,NULL,0,1,NULL,NULL),(2,5,1,'1','Region P-I',NULL,NULL,0,1,NULL,NULL),(3,4,2,'1','Pangasinan',NULL,NULL,0,1,NULL,NULL),(4,3,3,'1','Malasiqui',NULL,NULL,0,1,NULL,NULL),(5,2,4,'1','Asin Este',NULL,NULL,0,1,NULL,NULL),(6,2,4,'2','Asin Weste',NULL,NULL,0,1,NULL,NULL),(7,2,4,'3','Bacundao Este',NULL,NULL,0,1,NULL,NULL),(8,2,4,'4','Bacundao Weste',NULL,NULL,0,1,NULL,NULL),(9,2,4,'5','Bakitiw',NULL,NULL,0,1,NULL,NULL),(10,2,4,'6','Canan Sur',NULL,NULL,0,1,NULL,NULL),(11,2,4,'7','Cawayan Bogtong',NULL,NULL,0,1,NULL,NULL),(12,2,4,'8','Don Pedro',NULL,NULL,0,1,NULL,NULL),(13,2,4,'9','Gatang',NULL,NULL,0,1,NULL,NULL),(14,2,4,'10','Manggan-Dampay',NULL,NULL,0,1,NULL,NULL),(15,2,4,'11','Nancapian',NULL,NULL,0,1,NULL,NULL),(16,2,4,'12','Nalsian Sur',NULL,NULL,0,1,NULL,NULL),(17,2,4,'13','Nansangaan',NULL,NULL,0,1,NULL,NULL),(18,2,4,'14','Talospatang',NULL,NULL,0,1,NULL,NULL),(19,2,4,'15','Taloy',NULL,NULL,0,1,NULL,NULL),(20,2,4,'16','Taloyan',NULL,NULL,0,1,NULL,NULL),(21,2,4,'17','Tambac',NULL,NULL,0,1,NULL,NULL),(22,2,4,'18','Ungib',NULL,NULL,0,1,NULL,NULL),(23,2,4,'19','Bolintaguen',NULL,NULL,0,1,NULL,NULL),(24,2,4,'20','Mantacdang',NULL,NULL,0,1,NULL,NULL),(25,2,4,'21','Canan Norte',NULL,NULL,0,1,NULL,NULL),(26,2,4,'22','Waig',NULL,NULL,0,1,NULL,NULL),(27,2,4,'23','Amacalan',NULL,NULL,0,1,NULL,NULL),(28,2,4,'24','Apaya',NULL,NULL,0,1,NULL,NULL),(29,2,4,'25','Banawang',NULL,NULL,0,1,NULL,NULL),(30,2,4,'26','Bawer',NULL,NULL,0,1,NULL,NULL),(31,2,4,'27','Butao',NULL,NULL,0,1,NULL,NULL),(32,2,4,'28','Cabueldatan',NULL,NULL,0,1,NULL,NULL),(33,2,4,'29','Gomez',NULL,NULL,0,1,NULL,NULL),(34,2,4,'30','Ican',NULL,NULL,0,1,NULL,NULL),(35,2,4,'31','Loqueb Sur',NULL,NULL,0,1,NULL,NULL),(36,2,4,'32','Malimpec',NULL,NULL,0,1,NULL,NULL),(37,2,4,'33','Olea',NULL,NULL,0,1,NULL,NULL),(38,2,4,'34','Palapar Norte',NULL,NULL,0,1,NULL,NULL),(39,2,4,'35','Polong Sur',NULL,NULL,0,1,NULL,NULL),(40,2,4,'36','Tabo-Sili',NULL,NULL,0,1,NULL,NULL),(41,2,4,'37','Umando',NULL,NULL,0,1,NULL,NULL),(42,2,4,'38','Palong',NULL,NULL,0,1,NULL,NULL),(43,2,4,'39','Lunec',NULL,NULL,0,1,NULL,NULL),(44,3,3,'2','San Carlos City',NULL,NULL,0,1,NULL,NULL),(45,2,44,'40','Antipangol',NULL,NULL,0,1,NULL,NULL),(46,2,44,'41','Bacnar',NULL,NULL,0,1,NULL,NULL),(47,2,44,'42','Balaya',NULL,NULL,0,1,NULL,NULL),(48,2,44,'43','Balayong',NULL,NULL,0,1,NULL,NULL),(49,3,3,'3','Rosales',NULL,NULL,0,1,NULL,NULL),(50,2,49,'44','Acop',NULL,NULL,0,1,NULL,NULL),(51,2,49,'45','Bakitbakit',NULL,NULL,0,1,NULL,NULL),(52,2,49,'46','Balingcanaway',NULL,NULL,0,1,NULL,NULL),(53,2,49,'47','Rabago',NULL,NULL,0,1,NULL,NULL),(54,2,49,'48','Rizal',NULL,NULL,0,1,NULL,NULL),(55,2,49,'49','Salvacion',NULL,NULL,0,1,NULL,NULL),(56,2,49,'50','San Antonio',NULL,NULL,0,1,NULL,NULL),(57,2,49,'51','Don Antonio Village',NULL,NULL,0,1,NULL,NULL),(58,2,49,'52','Zone II (Pob.)',NULL,NULL,0,1,NULL,NULL),(59,2,49,'53','Zone III (Pob.)',NULL,NULL,0,1,NULL,NULL),(60,2,49,'54','Zone V (Pob.)',NULL,NULL,0,1,NULL,NULL),(61,3,3,'4','Tayug',NULL,NULL,0,1,NULL,NULL),(62,2,61,'55','Guzon',NULL,NULL,0,1,NULL,NULL),(63,3,3,'5','Malasiqui-II',NULL,NULL,0,1,NULL,NULL),(64,2,63,'56','Casantamaria-an',NULL,NULL,0,1,NULL,NULL),(65,2,63,'57','Bacundao East',NULL,NULL,0,1,NULL,NULL),(66,5,1,'2','Region II',NULL,NULL,0,1,NULL,NULL),(67,4,66,'2','Isabela',NULL,NULL,0,1,NULL,NULL),(68,3,67,'6','San Isidro',NULL,NULL,0,1,NULL,NULL),(69,2,68,'58','Cabayogan',NULL,NULL,0,1,NULL,NULL),(70,2,68,'59','Dalimag',NULL,NULL,0,1,NULL,NULL),(71,2,68,'60','Langbaban',NULL,NULL,0,1,NULL,NULL),(72,2,68,'61','Manayday',NULL,NULL,0,1,NULL,NULL),(73,2,68,'62','Rizal West',NULL,NULL,0,1,NULL,NULL),(74,2,68,'63','Tambacan',NULL,NULL,0,1,NULL,NULL),(75,2,68,'64','Tigasao',NULL,NULL,0,1,NULL,NULL),(76,2,68,'65','Caimbang',NULL,NULL,0,1,NULL,NULL),(77,2,68,'66','Cambansag',NULL,NULL,0,1,NULL,NULL),(78,2,68,'67','Candungao',NULL,NULL,0,1,NULL,NULL),(79,2,68,'68','Cansague Norte',NULL,NULL,0,1,NULL,NULL),(80,2,68,'69','Cambaleon',NULL,NULL,0,1,NULL,NULL),(81,2,68,'70','Dugmanon',NULL,NULL,0,1,NULL,NULL),(82,2,68,'71','Iba',NULL,NULL,0,1,NULL,NULL),(83,2,68,'72','La Union',NULL,NULL,0,1,NULL,NULL),(84,2,68,'73','Lapu-lapu',NULL,NULL,0,1,NULL,NULL),(85,2,68,'74','Sawata',NULL,NULL,0,1,NULL,NULL),(86,2,68,'75','Salvacion',NULL,NULL,0,1,NULL,NULL),(87,2,68,'76','San Juan',NULL,NULL,0,1,NULL,NULL),(88,2,68,'77','Seven Hills',NULL,NULL,0,1,NULL,NULL),(89,2,68,'78','Veriato',NULL,NULL,0,1,NULL,NULL),(90,2,68,'79','Villaflor',NULL,NULL,0,1,NULL,NULL),(91,2,68,'80','Patanad',NULL,NULL,0,1,NULL,NULL),(92,2,68,'81','Pantoc',NULL,NULL,0,1,NULL,NULL),(93,2,68,'82','Sabtan-olo',NULL,NULL,0,1,NULL,NULL),(94,2,68,'83','Del Carmen (Pob.)',NULL,NULL,0,1,NULL,NULL),(95,2,68,'84','Roxas',NULL,NULL,0,1,NULL,NULL),(96,2,68,'85','Santa Paz',NULL,NULL,0,1,NULL,NULL),(97,2,68,'86','Abehilan',NULL,NULL,0,1,NULL,NULL),(98,2,68,'87','Cabanugan',NULL,NULL,0,1,NULL,NULL),(99,2,68,'88','Cansague Sur',NULL,NULL,0,1,NULL,NULL),(100,2,68,'89','Masonoy',NULL,NULL,0,1,NULL,NULL),(101,2,68,'90','Bitaogan',NULL,NULL,0,1,NULL,NULL),(102,2,68,'91','Manikling',NULL,NULL,0,1,NULL,NULL),(103,2,68,'92','Batobato (Pob.)',NULL,NULL,0,1,NULL,NULL),(104,2,68,'93','Talisay',NULL,NULL,0,1,NULL,NULL),(105,2,68,'94','Alegria',NULL,NULL,0,1,NULL,NULL),(106,2,68,'95','Mabuhay',NULL,NULL,0,1,NULL,NULL),(107,2,68,'96','Poblacion Norte',NULL,NULL,0,1,NULL,NULL),(108,2,68,'97','Dacudao',NULL,NULL,0,1,NULL,NULL),(109,2,68,'98','Igangon',NULL,NULL,0,1,NULL,NULL),(110,2,68,'99','Sabangan',NULL,NULL,0,1,NULL,NULL),(111,2,68,'100','Santo Niño',NULL,NULL,0,1,NULL,NULL),(112,2,68,'101','Gomez',NULL,NULL,0,1,NULL,NULL),(113,2,68,'102','Nagbukel',NULL,NULL,0,1,NULL,NULL),(114,2,68,'103','Rizal East (Pob.)',NULL,NULL,0,1,NULL,NULL),(115,2,68,'104','Victoria',NULL,NULL,0,1,NULL,NULL),(116,2,68,'105','Poblacion',NULL,NULL,0,1,NULL,NULL),(117,2,68,'106','Quezon',NULL,NULL,0,1,NULL,NULL),(118,2,68,'107','Ramos East',NULL,NULL,0,1,NULL,NULL),(119,2,68,'108','Ramos West',NULL,NULL,0,1,NULL,NULL),(120,2,68,'109','Alua',NULL,NULL,0,1,NULL,NULL),(121,2,68,'110','Calaba',NULL,NULL,0,1,NULL,NULL),(122,2,68,'111','San Roque',NULL,NULL,0,1,NULL,NULL),(123,2,68,'112','Biasong',NULL,NULL,0,1,NULL,NULL),(124,2,68,'113','Cabungaan',NULL,NULL,0,1,NULL,NULL),(125,2,68,'114','Matungao',NULL,NULL,0,1,NULL,NULL),(126,6,0,'1','Indonesia',NULL,NULL,0,1,NULL,NULL),(127,5,126,'1','Sulawesi Selatan',NULL,NULL,0,1,NULL,NULL),(128,4,127,'1','Jeneponto',NULL,NULL,0,1,NULL,NULL),(129,3,128,'1','Batang 1',NULL,NULL,0,1,NULL,NULL),(130,2,129,'1','Kaluku',NULL,NULL,0,1,NULL,NULL),(131,2,129,'2','Bontoraya',NULL,NULL,0,1,NULL,NULL),(132,5,126,'2','Lampung',NULL,NULL,0,1,NULL,NULL),(133,4,132,'2','Lampung Timur',NULL,NULL,0,1,NULL,NULL),(134,3,133,'2','Batanghari',NULL,NULL,0,1,NULL,NULL),(135,2,134,'3','Sri Basuki',NULL,NULL,0,1,NULL,NULL),(136,2,134,'4','Rejo Agung',NULL,NULL,0,1,NULL,NULL),(137,2,134,'5','Sumber Rejo',NULL,NULL,0,1,NULL,NULL),(138,2,134,'6','Banar Joyo',NULL,NULL,0,1,NULL,NULL),(139,2,134,'7','Bumi Mas',NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_political_geography_level_country` */

CREATE TABLE `bf_master_political_geography_level_country` (
  `political_geography_countrylevel_id` int(11) NOT NULL AUTO_INCREMENT,
  `level_id` int(11) DEFAULT NULL,
  `level_name` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`political_geography_countrylevel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_political_geography_level_country` */

insert  into `bf_master_political_geography_level_country`(`political_geography_countrylevel_id`,`level_id`,`level_name`,`country_id`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,1,'Market\r\n',101,NULL,NULL,0,1,NULL,NULL),(2,2,'Village',101,NULL,NULL,0,1,NULL,NULL),(3,3,'Territory\r\n',101,NULL,NULL,0,1,NULL,NULL),(4,4,'Area\r\n',101,NULL,NULL,0,1,NULL,NULL),(5,5,'Zone\r\n',101,NULL,NULL,0,1,NULL,NULL),(6,6,'Country\r\n',101,NULL,NULL,0,1,NULL,NULL),(7,1,'Dusun\r\n',98,NULL,NULL,0,1,NULL,NULL),(8,2,'Desa\r\n',98,NULL,NULL,0,1,NULL,NULL),(9,3,'Kechamaten\r\n',98,NULL,NULL,0,1,NULL,NULL),(10,4,'Kabupaten\r\n',98,NULL,NULL,0,1,NULL,NULL),(11,5,'Province\r\n',98,NULL,NULL,0,1,NULL,NULL),(12,6,'Country\r\n',98,NULL,NULL,0,1,NULL,NULL),(13,1,'Market\r\n',151,NULL,NULL,0,1,NULL,NULL),(14,2,'Village',151,NULL,NULL,0,1,NULL,NULL),(15,3,'Sub District\r\n',151,NULL,NULL,0,1,NULL,NULL),(16,4,'District\r\n',151,NULL,NULL,0,1,NULL,NULL),(17,5,'State\r\n',151,NULL,NULL,0,1,NULL,NULL),(18,6,'Country\r\n',151,NULL,NULL,0,1,NULL,NULL),(19,1,'Market\r\n',231,NULL,NULL,0,1,NULL,NULL),(20,2,'Sub District\r\n',231,NULL,NULL,0,1,NULL,NULL),(21,3,'District\r\n',231,NULL,NULL,0,1,NULL,NULL),(22,4,'Region\r\n',231,NULL,NULL,0,1,NULL,NULL),(23,5,'Province\r\n',231,NULL,NULL,0,1,NULL,NULL),(24,6,'Country\r\n',231,NULL,NULL,0,1,NULL,NULL),(25,1,'Market\r\n',170,NULL,NULL,0,1,NULL,NULL),(26,2,'Village',170,NULL,NULL,0,1,NULL,NULL),(27,3,'City\r\n',170,NULL,NULL,0,1,NULL,NULL),(28,4,'Province\r\n',170,NULL,NULL,0,1,NULL,NULL),(29,5,'Region\r\n',170,NULL,NULL,0,1,NULL,NULL),(30,6,'Country\r\n',170,NULL,NULL,0,1,NULL,NULL),(31,1,'Market\r\n',190,NULL,NULL,0,1,NULL,NULL),(32,2,'Village',190,NULL,NULL,0,1,NULL,NULL),(33,3,'Area\r\n',190,NULL,NULL,0,1,NULL,NULL),(34,4,'State\r\n',190,NULL,NULL,0,1,NULL,NULL),(35,5,'Province\r\n',190,NULL,NULL,0,1,NULL,NULL),(36,6,'Country\r\n',190,NULL,NULL,0,1,NULL,NULL),(37,1,'Market\r\n',208,NULL,NULL,0,1,NULL,NULL),(38,2,'Village',208,NULL,NULL,0,1,NULL,NULL),(39,3,'Area\r\n',208,NULL,NULL,0,1,NULL,NULL),(40,4,'State\r\n',208,NULL,NULL,0,1,NULL,NULL),(41,5,'Province\r\n',208,NULL,NULL,0,1,NULL,NULL),(42,6,'Country\r\n',208,NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_political_geography_level_regional` */

CREATE TABLE `bf_master_political_geography_level_regional` (
  `political_geography_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(255) DEFAULT NULL,
  `level_name` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`political_geography_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_political_geography_level_regional` */

insert  into `bf_master_political_geography_level_regional`(`political_geography_level_id`,`level`,`level_name`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,'L1','Market\r\n',NULL,NULL,0,1,NULL,NULL),(2,'L2','Village\r\n',NULL,NULL,0,1,NULL,NULL),(3,'L3','Area\r\n',NULL,NULL,0,1,NULL,NULL),(4,'L4','State\r\n',NULL,NULL,0,1,NULL,NULL),(5,'L5','Province\r\n',NULL,NULL,0,1,NULL,NULL),(6,'L6','Country\r\n',NULL,NULL,0,1,NULL,NULL),(7,'L7',NULL,NULL,NULL,0,1,NULL,NULL),(8,'L8',NULL,NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_price` */

CREATE TABLE `bf_master_price` (
  `price_id` int(11) NOT NULL AUTO_INCREMENT,
  `price_type` varchar(255) DEFAULT NULL,
  `PBG_id` int(11) DEFAULT NULL,
  `product_sku_country_id` int(11) DEFAULT NULL,
  `price` decimal(9,2) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`price_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_price` */

insert  into `bf_master_price`(`price_id`,`price_type`,`PBG_id`,`product_sku_country_id`,`price`,`country_id`,`from_date`,`to_date`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,'forecast',NULL,1,'20.00',101,'2016-04-01','2016-08-01',NULL,NULL,0,1,NULL,NULL),(2,'forecast',NULL,2,'10.00',101,'2016-04-01','2016-08-01',NULL,NULL,0,1,NULL,NULL),(3,'budget',NULL,1,'20.00',101,'2016-04-01','2016-08-01',NULL,NULL,0,1,NULL,NULL),(4,'budget',NULL,2,'10.00',101,'2016-04-01','2016-08-01',NULL,NULL,0,1,NULL,NULL),(5,'ishop',NULL,1,'50.00',101,'2016-04-01','2016-08-01',NULL,NULL,0,1,NULL,NULL),(6,'ishop',NULL,2,'100.00',101,'2016-04-01','2016-08-01',NULL,NULL,0,1,NULL,NULL),(7,'ishop',NULL,3,'150.00',101,'2016-04-01','2016-08-01',NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_product_sku_country` */

CREATE TABLE `bf_master_product_sku_country` (
  `product_sku_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_sku_id` int(11) DEFAULT NULL,
  `product_sku_name` varchar(255) DEFAULT NULL,
  `product_sort_name` varchar(255) DEFAULT NULL,
  `product_regional_id1` int(11) DEFAULT NULL,
  `product_regional_id2` int(11) DEFAULT NULL,
  `product_regional_id3` int(11) DEFAULT NULL,
  `product_regional_id4` int(11) DEFAULT NULL,
  `product_regional_id5` int(11) DEFAULT NULL,
  `product_regional_id6` int(11) DEFAULT NULL,
  `PBG` int(11) DEFAULT NULL,
  `no_of_units` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `ref_code1` varchar(255) DEFAULT NULL,
  `ref_code2` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`product_sku_country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_product_sku_country` */

insert  into `bf_master_product_sku_country`(`product_sku_country_id`,`product_sku_id`,`product_sku_name`,`product_sort_name`,`product_regional_id1`,`product_regional_id2`,`product_regional_id3`,`product_regional_id4`,`product_regional_id5`,`product_regional_id6`,`PBG`,`no_of_units`,`country_id`,`ref_code1`,`ref_code2`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,1,'A1','A1',1,48,51,57,0,0,1,1,101,'10000001','100000011',NULL,NULL,0,1,NULL,NULL),(2,2,'A2','A2',1,48,51,57,0,0,1,2,101,'10000002','100000021',NULL,NULL,0,1,NULL,NULL),(3,3,'B3','B3',2,48,52,58,0,0,1,3,101,'10000003','100000031',NULL,NULL,0,1,NULL,NULL),(4,0,'B4','B4',2,49,52,58,0,0,1,4,101,'10000004','100000041',NULL,NULL,0,1,NULL,NULL),(5,0,'C103','C103',3,50,53,59,0,0,1,5,101,'10000005','100000051',NULL,NULL,0,1,NULL,NULL),(6,0,'C5','C5',3,50,53,59,0,0,1,6,101,'10000006','100000061',NULL,NULL,0,1,NULL,NULL),(7,0,'C6','C6',3,50,53,59,0,0,1,7,101,'10000007','100000071',NULL,NULL,0,1,NULL,NULL),(8,0,'C7','C7',3,50,53,59,0,0,1,8,101,'10000008','100000081',NULL,NULL,0,1,NULL,NULL),(9,0,'C8','C8',3,50,53,59,0,0,1,9,101,'10000009','100000091',NULL,NULL,0,1,NULL,NULL),(10,0,'D10','D10',4,48,54,60,0,0,1,1,101,'10000010','100000101',NULL,NULL,0,1,NULL,NULL),(11,0,'D9','D9',4,48,54,60,0,0,1,2,101,'10000011','100000111',NULL,NULL,0,1,NULL,NULL),(12,0,'E105','E105',5,49,55,57,0,0,1,3,101,'10000012','100000121',NULL,NULL,0,1,NULL,NULL),(13,0,'E11','E11',5,49,0,57,0,0,1,4,101,'10000013','100000131',NULL,NULL,0,1,NULL,NULL),(14,0,'E12','E12',5,49,55,57,0,0,1,5,101,'10000014','100000141',NULL,NULL,0,1,NULL,NULL),(15,0,'F13','F13',6,50,56,58,0,0,1,6,101,'10000015','100000151',NULL,NULL,0,1,NULL,NULL),(16,0,'F14','F14',6,50,56,58,0,0,1,7,101,'10000016','100000161',NULL,NULL,0,1,NULL,NULL),(17,0,'G15','G15',7,48,51,59,0,0,1,8,101,'10000017','100000171',NULL,NULL,0,1,NULL,NULL),(18,0,'G16','G16',7,48,51,59,0,0,1,9,101,'10000018','100000181',NULL,NULL,0,1,NULL,NULL),(19,0,'G17','G17',7,48,51,59,0,0,1,1,101,'10000019','100000191',NULL,NULL,0,1,NULL,NULL),(20,0,'H18','H18',8,49,52,60,0,0,1,2,101,'10000020','100000201',NULL,NULL,0,1,NULL,NULL),(21,0,'I111','I111',9,50,53,57,0,0,1,3,101,'10000021','100000211',NULL,NULL,0,1,NULL,NULL),(22,0,'I19','I19',9,50,53,57,0,0,1,4,101,'10000022','100000221',NULL,NULL,0,1,NULL,NULL),(23,0,'I80','I80',9,50,53,57,0,0,1,5,101,'10000023','100000231',NULL,NULL,0,1,NULL,NULL),(24,0,'I81','I81',9,50,53,57,0,0,1,6,101,'10000024','100000241',NULL,NULL,0,1,NULL,NULL),(25,0,'J20','J20',10,48,54,58,0,0,1,7,101,'10000025','100000251',NULL,NULL,0,1,NULL,NULL),(26,0,'J84','J84',10,48,54,58,0,0,1,8,101,'10000026','100000261',NULL,NULL,0,1,NULL,NULL),(27,0,'K21','K21',11,49,55,59,0,0,1,9,101,'10000027','100000271',NULL,NULL,0,1,NULL,NULL),(28,0,'K22','K22',11,49,55,59,0,0,1,1,101,'10000028','100000281',NULL,NULL,0,1,NULL,NULL),(29,0,'L23','L23',12,50,56,60,0,0,1,2,101,'10000029','100000291',NULL,NULL,0,1,NULL,NULL),(30,0,'L24','L24',12,50,56,60,0,0,1,3,101,'10000030','100000301',NULL,NULL,0,1,NULL,NULL),(31,0,'L25','L25',12,50,56,60,0,0,1,4,101,'10000031','100000311',NULL,NULL,0,1,NULL,NULL),(32,0,'M118','M118',13,48,51,57,0,0,1,5,101,'10000032','100000321',NULL,NULL,0,1,NULL,NULL),(33,0,'M26','M26',13,48,51,57,0,0,1,6,101,'10000033','100000331',NULL,NULL,0,1,NULL,NULL),(34,0,'M27','M27',13,48,51,57,0,0,1,7,101,'10000034','100000341',NULL,NULL,0,1,NULL,NULL),(35,0,'N28','N28',14,49,52,58,0,0,1,8,101,'10000035','100000351',NULL,NULL,0,1,NULL,NULL),(36,0,'N29','N29',14,49,52,58,0,0,1,9,101,'10000036','100000361',NULL,NULL,0,1,NULL,NULL),(37,0,'N30','N30',14,49,52,58,0,0,1,1,101,'10000037','100000371',NULL,NULL,0,1,NULL,NULL),(38,0,'N31','N31',14,49,52,58,0,0,1,2,101,'10000038','100000381',NULL,NULL,0,1,NULL,NULL),(39,0,'N32','N32',14,49,52,58,0,0,1,3,101,'10000039','100000391',NULL,NULL,0,1,NULL,NULL),(40,0,'N88','N88',14,49,52,58,0,0,1,4,101,'10000040','100000401',NULL,NULL,0,1,NULL,NULL),(41,0,'O33','O33',15,50,53,59,0,0,1,5,101,'10000041','100000411',NULL,NULL,0,1,NULL,NULL),(42,0,'P34','P34',16,48,54,60,0,0,1,6,101,'10000042','100000421',NULL,NULL,0,1,NULL,NULL),(43,0,'P35','P35',16,48,54,60,0,0,1,7,101,'10000043','100000431',NULL,NULL,0,1,NULL,NULL),(44,0,'Q36','Q36',17,49,55,57,0,0,1,8,101,'10000044','100000441',NULL,NULL,0,1,NULL,NULL),(45,0,'R37','R37',18,50,56,58,0,0,1,9,101,'10000045','100000451',NULL,NULL,0,1,NULL,NULL),(46,0,'S38','S38',19,48,51,59,0,0,1,1,101,'10000046','100000461',NULL,NULL,0,1,NULL,NULL),(47,0,'T39','T39',20,49,52,60,0,0,1,2,101,'10000047','100000471',NULL,NULL,0,1,NULL,NULL),(48,0,'T40','T40',20,49,52,60,0,0,1,3,101,'10000048','100000481',NULL,NULL,0,1,NULL,NULL),(49,0,'T41','T41',20,49,52,60,0,0,1,4,101,'10000049','100000491',NULL,NULL,0,1,NULL,NULL),(50,0,'T94','T94',20,49,52,60,0,0,1,5,101,'10000050','100000501',NULL,NULL,0,1,NULL,NULL),(51,0,'U42','U42',21,50,53,57,0,0,1,6,101,'10000051','100000511',NULL,NULL,0,1,NULL,NULL),(52,0,'U43','U43',21,50,53,57,0,0,1,7,101,'10000052','100000521',NULL,NULL,0,1,NULL,NULL),(53,0,'U44','U44',21,50,53,57,0,0,1,8,101,'10000053','100000531',NULL,NULL,0,1,NULL,NULL),(54,0,'U45','U45',21,50,53,57,0,0,1,9,101,'10000054','100000541',NULL,NULL,0,1,NULL,NULL),(55,0,'U46','U46',21,50,53,57,0,0,1,1,101,'10000055','100000551',NULL,NULL,0,1,NULL,NULL),(56,0,'U47','U47',21,50,53,57,0,0,1,2,101,'10000056','100000561',NULL,NULL,0,1,NULL,NULL),(57,0,'U79','U79',21,50,53,57,0,0,1,3,101,'10000057','100000571',NULL,NULL,0,1,NULL,NULL),(58,0,'U91','U91',21,50,53,57,0,0,1,4,101,'10000058','100000581',NULL,NULL,0,1,NULL,NULL),(59,0,'V113','V113',22,48,54,58,0,0,1,5,101,'10000059','100000591',NULL,NULL,0,1,NULL,NULL),(60,0,'V114','V114',22,48,54,58,0,0,1,6,101,'10000060','100000601',NULL,NULL,0,1,NULL,NULL),(61,0,'V116','V116',22,48,54,58,0,0,1,7,101,'10000061','100000611',NULL,NULL,0,1,NULL,NULL),(62,0,'V117','V117',22,48,54,58,0,0,1,8,101,'10000062','100000621',NULL,NULL,0,1,NULL,NULL),(63,0,'V48','V48',22,48,54,58,0,0,1,9,101,'10000063','100000631',NULL,NULL,0,1,NULL,NULL),(64,0,'V49','V49',22,48,54,58,0,0,1,1,101,'10000064','100000641',NULL,NULL,0,1,NULL,NULL),(65,0,'V50','V50',22,48,54,58,0,0,1,2,101,'10000065','100000651',NULL,NULL,0,1,NULL,NULL),(66,0,'V51','V51',22,48,54,58,0,0,1,3,101,'10000066','100000661',NULL,NULL,0,1,NULL,NULL),(67,0,'W52','W52',23,49,55,59,0,0,1,4,101,'10000067','100000671',NULL,NULL,0,1,NULL,NULL),(68,0,'W53','W53',23,49,55,59,0,0,1,5,101,'10000068','100000681',NULL,NULL,0,1,NULL,NULL),(69,0,'W54','W54',23,49,55,59,0,0,1,6,101,'10000069','100000691',NULL,NULL,0,1,NULL,NULL),(70,0,'W92','W92',23,49,55,59,0,0,1,7,101,'10000070','100000701',NULL,NULL,0,1,NULL,NULL),(71,0,'W93','W93',23,49,55,59,0,0,1,8,101,'10000071','100000711',NULL,NULL,0,1,NULL,NULL),(72,0,'W95','W95',23,49,55,59,0,0,1,9,101,'10000072','100000721',NULL,NULL,0,1,NULL,NULL),(73,0,'X108','X108',24,50,56,60,0,0,1,1,101,'10000073','100000731',NULL,NULL,0,1,NULL,NULL),(74,0,'X55','X55',24,50,56,60,0,0,1,2,101,'10000074','100000741',NULL,NULL,0,1,NULL,NULL),(75,0,'X56','X56',24,50,56,60,0,0,1,3,101,'10000075','100000751',NULL,NULL,0,1,NULL,NULL),(76,0,'X57','X57',24,50,56,60,0,0,1,4,101,'10000076','100000761',NULL,NULL,0,1,NULL,NULL),(77,0,'X58','X58',24,50,56,60,0,0,1,5,101,'10000077','100000771',NULL,NULL,0,1,NULL,NULL),(78,0,'X59','X59',24,50,56,60,0,0,1,6,101,'10000078','100000781',NULL,NULL,0,1,NULL,NULL),(79,0,'Y60','Y60',25,48,51,57,0,0,1,7,101,'10000079','100000791',NULL,NULL,0,1,NULL,NULL),(80,0,'Y87','Y87',25,48,51,57,0,0,1,8,101,'10000080','100000801',NULL,NULL,0,1,NULL,NULL),(81,0,'Z61','Z61',26,49,52,58,0,0,1,9,101,'10000081','100000811',NULL,NULL,0,1,NULL,NULL),(82,0,'AA62','AA62',27,50,53,59,0,0,1,1,101,'10000082','100000821',NULL,NULL,0,1,NULL,NULL),(83,0,'AA89','AA89',27,50,53,59,0,0,1,2,101,'10000083','100000831',NULL,NULL,0,1,NULL,NULL),(84,0,'AB63','AB63',28,48,54,60,0,0,1,3,101,'10000084','100000841',NULL,NULL,0,1,NULL,NULL),(85,0,'AC64','AC64',29,49,55,57,0,0,1,4,101,'10000085','100000851',NULL,NULL,0,1,NULL,NULL),(86,0,'AD65','AD65',30,50,56,58,0,0,1,5,101,'10000086','100000861',NULL,NULL,0,1,NULL,NULL),(87,0,'AE66','AE66',31,48,51,59,0,0,1,6,101,'10000087','100000871',NULL,NULL,0,1,NULL,NULL),(88,0,'AE86','AE86',31,48,51,59,0,0,1,4,101,'10000088','100000881',NULL,NULL,0,1,NULL,NULL),(89,0,'AF67','AF67',32,49,52,60,0,0,1,8,101,'10000089','100000891',NULL,NULL,0,1,NULL,NULL),(90,0,'AG68','AG68',33,50,53,57,0,0,1,9,101,'10000090','100000901',NULL,NULL,0,1,NULL,NULL),(91,0,'AH110','AH110',34,48,54,58,0,0,1,4,101,'10000091','100000911',NULL,NULL,0,1,NULL,NULL),(92,0,'AH69','AH69',34,48,54,58,0,0,1,2,101,'10000092','100000921',NULL,NULL,0,1,NULL,NULL),(93,0,'AI70','AI70',35,49,55,59,0,0,1,3,101,'10000093','100000931',NULL,NULL,0,1,NULL,NULL),(94,0,'AJ71','AJ71',36,50,56,60,0,0,1,4,101,'10000094','100000941',NULL,NULL,0,1,NULL,NULL),(95,0,'AJ72','AJ72',36,50,56,60,0,0,1,5,101,'10000095','100000951',NULL,NULL,0,1,NULL,NULL),(96,0,'AK73','AK73',37,48,51,57,0,0,1,6,101,'10000096','100000961',NULL,NULL,0,1,NULL,NULL),(97,0,'AK74','AK74',37,48,51,57,0,0,1,7,101,'10000097','100000971',NULL,NULL,0,1,NULL,NULL),(98,0,'AK97','AK97',37,48,51,57,0,0,1,8,101,'10000098','100000981',NULL,NULL,0,1,NULL,NULL),(99,0,'AL75','AL75',38,49,52,58,0,0,1,9,101,'10000099','100000991',NULL,NULL,0,1,NULL,NULL),(100,0,'AL83','AL83',38,49,52,58,0,0,1,1,101,'10000100','100001001',NULL,NULL,0,1,NULL,NULL),(101,0,'AM76','AM76',39,50,53,59,0,0,1,2,101,'10000101','100001011',NULL,NULL,0,1,NULL,NULL),(102,0,'AM77','AM77',39,50,53,59,0,0,1,3,101,'10000102','100001021',NULL,NULL,0,1,NULL,NULL),(103,0,'AN101','AN101',40,48,54,60,0,0,1,4,101,'10000103','100001031',NULL,NULL,0,1,NULL,NULL),(104,0,'AN78','AN78',40,48,54,60,0,0,1,5,101,'10000104','100001041',NULL,NULL,0,1,NULL,NULL),(105,0,'AN96','AN96',40,48,54,60,0,0,1,6,101,'10000105','100001051',NULL,NULL,0,1,NULL,NULL),(106,0,'AO82','AO82',41,49,55,57,0,0,1,7,101,'10000106','100001061',NULL,NULL,0,1,NULL,NULL),(107,0,'AP112','AP112',42,50,56,58,0,0,1,8,101,'10000107','100001071',NULL,NULL,0,1,NULL,NULL),(108,0,'AP85','AP85',42,50,56,58,0,0,1,9,101,'10000108','100001081',NULL,NULL,0,1,NULL,NULL),(109,0,'AQ90','AQ90',43,48,51,59,0,0,1,4,101,'10000109','100001091',NULL,NULL,0,1,NULL,NULL),(110,0,'AR106','AR106',44,49,52,60,0,0,1,2,101,'10000110','100001101',NULL,NULL,0,1,NULL,NULL),(111,0,'AR107','AR107',44,49,52,60,0,0,1,3,101,'10000111','100001111',NULL,NULL,0,1,NULL,NULL),(112,0,'AR98','AR98',44,49,52,60,0,0,1,4,101,'10000112','100001121',NULL,NULL,0,1,NULL,NULL),(113,0,'AR99','AR99',44,49,52,60,0,0,1,5,101,'10000113','100001131',NULL,NULL,0,1,NULL,NULL),(114,0,'AS100','AS100',45,50,53,57,0,0,1,6,101,'10000114','100001141',NULL,NULL,0,1,NULL,NULL),(115,0,'AS109','AS109',45,50,53,57,0,0,1,7,101,'10000115','100001151',NULL,NULL,0,1,NULL,NULL),(116,0,'AS115','AS115',45,50,53,57,0,0,1,8,101,'10000116','100001161',NULL,NULL,0,1,NULL,NULL),(117,0,'AT102','AT102',46,48,54,58,0,0,1,9,101,'10000117','100001171',NULL,NULL,0,1,NULL,NULL),(118,0,'AU104','AU104',47,49,55,59,0,0,1,1,101,'10000118','100001181',NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_product_sku_regional` */

CREATE TABLE `bf_master_product_sku_regional` (
  `product_sku_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_regional_id1` int(11) DEFAULT NULL,
  `product_regional_id2` int(11) DEFAULT NULL,
  `product_regional_id3` int(11) DEFAULT NULL,
  `product_regional_id4` int(11) DEFAULT NULL,
  `product_regional_id5` int(11) DEFAULT NULL,
  `product_regional_id6` int(11) DEFAULT NULL,
  `product_sku_code` varchar(255) DEFAULT NULL,
  `product_sku_name` varchar(255) DEFAULT NULL,
  `product_sort_name` varchar(255) DEFAULT NULL,
  `product_technical_name` varchar(255) DEFAULT NULL,
  `uom_id` int(11) DEFAULT NULL,
  `product_sku_size` varchar(255) DEFAULT NULL,
  `PBG` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`product_sku_id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_product_sku_regional` */

insert  into `bf_master_product_sku_regional`(`product_sku_id`,`product_regional_id1`,`product_regional_id2`,`product_regional_id3`,`product_regional_id4`,`product_regional_id5`,`product_regional_id6`,`product_sku_code`,`product_sku_name`,`product_sort_name`,`product_technical_name`,`uom_id`,`product_sku_size`,`PBG`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,1,48,51,57,0,0,'58515696','A1','A1','A1',1,'3.2 KG',1,NULL,NULL,0,1,NULL,NULL),(2,1,48,51,57,0,0,'58515719','A2','A2','A2',1,'4.8 KG',1,NULL,NULL,0,1,NULL,NULL),(3,2,49,52,58,0,0,'58551281','B3','B3','B3',1,'10 KG',1,NULL,NULL,0,1,NULL,NULL),(4,2,49,52,58,0,0,'58555920','B4','B4','B4',1,'10 KG',1,NULL,NULL,0,1,NULL,NULL),(5,3,50,53,59,0,0,'58276573','C103','C103','C103',2,'200 Liter',1,NULL,NULL,0,1,NULL,NULL),(6,3,50,53,59,0,0,'58637497','C5','C5','C5',2,'6 Liter',1,NULL,NULL,0,1,NULL,NULL),(7,3,50,53,59,0,0,'58646826','C6','C6','C6',2,'4.8 Liter',1,NULL,NULL,0,1,NULL,NULL),(8,3,50,53,59,0,0,'58929356','C7','C7','C7',2,'4.8 Liter',1,NULL,NULL,0,1,NULL,NULL),(9,3,50,53,59,0,0,'58930987','C8','C8','C8',2,'20 Liter',1,NULL,NULL,0,1,NULL,NULL),(10,4,48,54,60,0,0,'58902014','D10','D10','D10',2,'4 Liter',1,NULL,NULL,0,1,NULL,NULL),(11,4,48,54,60,0,0,'58644853','D9','D9','D9',2,'20 Liter',1,NULL,NULL,0,1,NULL,NULL),(12,5,49,55,57,0,0,'58860031','E105','E105','E105',1,'25 KG',1,NULL,NULL,0,1,NULL,NULL),(13,5,49,55,57,0,0,'58559331','E11','E11','E11',1,'20 KG',1,NULL,NULL,0,1,NULL,NULL),(14,5,49,55,57,0,0,'58567787','E12','E12','E12',1,'20 KG',1,NULL,NULL,0,1,NULL,NULL),(15,6,50,56,58,0,0,'58469838','F13','F13','F13',2,'6 Liter',1,NULL,NULL,0,1,NULL,NULL),(16,6,50,56,58,0,0,'58668484','F14','F14','F14',2,'3.84 Liter',1,NULL,NULL,0,1,NULL,NULL),(17,7,48,51,59,0,0,'58346559','G15','G15','G15',1,'20 KG',1,NULL,NULL,0,1,NULL,NULL),(18,7,48,51,59,0,0,'58346597','G16','G16','G16',1,'20 KG',1,NULL,NULL,0,1,NULL,NULL),(19,7,48,51,59,0,0,'58346634','G17','G17','G17',1,'20 KG',1,NULL,NULL,0,1,NULL,NULL),(20,8,49,52,60,0,0,'58175111','H18','H18','H18',2,'20 Liter',1,NULL,NULL,0,1,NULL,NULL),(21,9,50,53,57,0,0,'58042538','I111','I111','I111',2,'0.4 Liter',1,NULL,NULL,0,1,NULL,NULL),(22,9,50,53,57,0,0,'58526753','I19','I19','I19',2,'1 Liter',1,NULL,NULL,0,1,NULL,NULL),(23,9,50,53,57,0,0,'58948463','I80','I80','I80',2,'0.4 Liter',1,NULL,NULL,0,1,NULL,NULL),(24,9,50,53,57,0,0,'58981651','I81','I81','I81',2,'0.4 Liter',1,NULL,NULL,0,1,NULL,NULL),(25,10,48,54,58,0,0,'58258036','J20','J20','J20',2,'5 Liter',1,NULL,NULL,0,1,NULL,NULL),(26,10,48,54,58,0,0,'58270151','J84','J84','J84',2,'10 Liter',1,NULL,NULL,0,1,NULL,NULL),(27,11,49,55,59,0,0,'58497893','K21','K21','K21',2,'10 Liter',1,NULL,NULL,0,1,NULL,NULL),(28,11,49,55,59,0,0,'58923163','K22','K22','K22',2,'5 Liter',1,NULL,NULL,0,1,NULL,NULL),(29,12,50,56,60,0,0,'58175333','L23','L23','L23',1,'5 KG',1,NULL,NULL,0,1,NULL,NULL),(30,12,50,56,60,0,0,'58249843','L24','L24','L24',1,'25 KG',1,NULL,NULL,0,1,NULL,NULL),(31,12,50,56,60,0,0,'58525183','L25','L25','L25',1,'5 KG',1,NULL,NULL,0,1,NULL,NULL),(32,13,48,51,57,0,0,'58041913','M118','M118','M118',2,'0.25 Liter',1,NULL,NULL,0,1,NULL,NULL),(33,13,48,51,57,0,0,'58532075','M26','M26','M26',2,'7.2 Liter',1,NULL,NULL,0,1,NULL,NULL),(34,13,48,51,57,0,0,'58532082','M27','M27','M27',2,'5 Liter',1,NULL,NULL,0,1,NULL,NULL),(35,14,49,52,58,0,0,'58175616','N28','N28','N28',2,'10 Liter',1,NULL,NULL,0,1,NULL,NULL),(36,14,49,52,58,0,0,'58175623','N29','N29','N29',2,'7.2 Liter',1,NULL,NULL,0,1,NULL,NULL),(37,14,49,52,58,0,0,'58175654','N30','N30','N30',2,'5 Liter',1,NULL,NULL,0,1,NULL,NULL),(38,14,49,52,58,0,0,'58175685','N31','N31','N31',2,'20 Liter',1,NULL,NULL,0,1,NULL,NULL),(39,14,49,52,58,0,0,'58567824','N32','N32','N32',2,'5 Liter',1,NULL,NULL,0,1,NULL,NULL),(40,14,49,52,58,0,0,'58932349','N88','N88','N88',2,'0.5 Liter',1,NULL,NULL,0,1,NULL,NULL),(41,15,50,53,59,0,0,'58257978','O33','O33','O33',2,'20 Liter',1,NULL,NULL,0,1,NULL,NULL),(42,16,48,54,60,0,0,'58259163','P34','P34','P34',2,'20 Liter',1,NULL,NULL,0,1,NULL,NULL),(43,16,48,54,60,0,0,'58635875','P35','P35','P35',2,'5 Liter',1,NULL,NULL,0,1,NULL,NULL),(44,17,49,55,57,0,0,'58270106','Q36','Q36','Q36',1,'16.96 KG',1,NULL,NULL,0,1,NULL,NULL),(45,18,50,56,58,0,0,'58697934','R37','R37','R37',2,'4.8 Liter',1,NULL,NULL,0,1,NULL,NULL),(46,19,48,51,59,0,0,'58361279','S38','S38','S38',1,'10 KG',1,NULL,NULL,0,1,NULL,NULL),(47,20,49,52,60,0,0,'58579162','T39','T39','T39',2,'4 Liter',1,NULL,NULL,0,1,NULL,NULL),(48,20,49,52,60,0,0,'58629041','T40','T40','T40',2,'4.8 Liter',1,NULL,NULL,0,1,NULL,NULL),(49,20,49,52,60,0,0,'58637503','T41','T41','T41',2,'6 Liter',1,NULL,NULL,0,1,NULL,NULL),(50,20,49,52,60,0,0,'58364096','T94','T94','T94',2,'0.1 Liter',1,NULL,NULL,0,1,NULL,NULL),(51,21,50,53,57,0,0,'58361408','U42','U42','U42',2,'5 Liter',1,NULL,NULL,0,1,NULL,NULL),(52,21,50,53,57,0,0,'58361422','U43','U43','U43',2,'20 Liter',1,NULL,NULL,0,1,NULL,NULL),(53,21,50,53,57,0,0,'58364201','U44','U44','U44',2,'4 Liter',1,NULL,NULL,0,1,NULL,NULL),(54,21,50,53,57,0,0,'58626583','U45','U45','U45',2,'6 Liter',1,NULL,NULL,0,1,NULL,NULL),(55,21,50,53,57,0,0,'58626637','U46','U46','U46',2,'4.8 Liter',1,NULL,NULL,0,1,NULL,NULL),(56,21,50,53,57,0,0,'58642682','U47','U47','U47',2,'200 Liter',1,NULL,NULL,0,1,NULL,NULL),(57,21,50,53,57,0,0,'58975094','U79','U79','U79',2,'20 Liter',1,NULL,NULL,0,1,NULL,NULL),(58,21,50,53,57,0,0,'58364164','U91','U91','U91',2,'0.1 Liter',1,NULL,NULL,0,1,NULL,NULL),(59,22,48,54,58,0,0,'58044242','V113','V113','V113',2,'0.3 Liter',1,NULL,NULL,0,1,NULL,NULL),(60,22,48,54,58,0,0,'58044235','V114','V114','V114',2,'0.5 Liter',1,NULL,NULL,0,1,NULL,NULL),(61,22,48,54,58,0,0,'58044259','V116','V116','V116',2,'0.1 Liter',1,NULL,NULL,0,1,NULL,NULL),(62,22,48,54,58,0,0,'58042798','V117','V117','V117',2,'0.1 Liter',1,NULL,NULL,0,1,NULL,NULL),(63,22,48,54,58,0,0,'58175470','V48','V48','V48',2,'10 Liter',1,NULL,NULL,0,1,NULL,NULL),(64,22,48,54,58,0,0,'58175487','V49','V49','V49',2,'7.2 Liter',1,NULL,NULL,0,1,NULL,NULL),(65,22,48,54,58,0,0,'58175517','V50','V50','V50',2,'5 Liter',1,NULL,NULL,0,1,NULL,NULL),(66,22,48,54,58,0,0,'58567817','V51','V51','V51',2,'5 Liter',1,NULL,NULL,0,1,NULL,NULL),(67,23,49,55,59,0,0,'58298254','W52','W52','W52',2,'6 Liter',1,NULL,NULL,0,1,NULL,NULL),(68,23,49,55,59,0,0,'58298322','W53','W53','W53',2,'5 Liter',1,NULL,NULL,0,1,NULL,NULL),(69,23,49,55,59,0,0,'58901987','W54','W54','W54',2,'200 Liter',1,NULL,NULL,0,1,NULL,NULL),(70,23,49,55,59,0,0,'58489003','W92','W92','W92',2,'0.1 Liter',1,NULL,NULL,0,1,NULL,NULL),(71,23,49,55,59,0,0,'58524865','W93','W93','W93',2,'0.25 Liter',1,NULL,NULL,0,1,NULL,NULL),(72,23,49,55,59,0,0,'58572118','W95','W95','W95',2,'10 Liter',1,NULL,NULL,0,1,NULL,NULL),(73,24,50,56,60,0,0,'58021625','X108','X108','X108',1,'10 KG',1,NULL,NULL,0,1,NULL,NULL),(74,24,50,56,60,0,0,'58640244','X55','X55','X55',1,'20 KG',1,NULL,NULL,0,1,NULL,NULL),(75,24,50,56,60,0,0,'58678605','X56','X56','X56',1,'10 KG',1,NULL,NULL,0,1,NULL,NULL),(76,24,50,56,60,0,0,'58680301','X57','X57','X57',1,'10 KG',1,NULL,NULL,0,1,NULL,NULL),(77,24,50,56,60,0,0,'58913942','X58','X58','X58',1,'10 KG',1,NULL,NULL,0,1,NULL,NULL),(78,24,50,56,60,0,0,'58923750','X59','X59','X59',1,'20 KG',1,NULL,NULL,0,1,NULL,NULL),(79,25,48,51,57,0,0,'58991001','Y60','Y60','Y60',2,'6 Liter',1,NULL,NULL,0,1,NULL,NULL),(80,25,48,51,57,0,0,'58646314','Y87','Y87','Y87',2,'0.5 Liter',1,NULL,NULL,0,1,NULL,NULL),(81,26,49,52,58,0,0,'58493666','Z61','Z61','Z61',3,'320 Gram',1,NULL,NULL,0,1,NULL,NULL),(82,27,50,53,59,0,0,'58599467','AA62','AA62','AA62',3,'0.3 Gram',1,NULL,NULL,0,1,NULL,NULL),(83,27,50,53,59,0,0,'58983815','AA89','AA89','AA89',3,'5 Gram',1,NULL,NULL,0,1,NULL,NULL),(84,28,48,54,60,0,0,'5AP10001','AB63','AB63','AB63',1,'1 KG',1,NULL,NULL,0,1,NULL,NULL),(85,29,49,55,57,0,0,'5AP10002','AC64','AC64','AC64',1,'1 KG',1,NULL,NULL,0,1,NULL,NULL),(86,30,50,56,58,0,0,'5AP10003','AD65','AD65','AD65',1,'1 KG',1,NULL,NULL,0,1,NULL,NULL),(87,31,48,51,59,0,0,'45112067','AE66','AE66','AE66',1,'4 KG',1,NULL,NULL,0,1,NULL,NULL),(88,31,48,51,59,0,0,'50104753','AE86','AE86','AE86',4,'0.5 Liter',1,NULL,NULL,0,1,NULL,NULL),(89,32,49,52,60,0,0,'45091614','AF67','AF67','AF67',1,'1 KG',1,NULL,NULL,0,1,NULL,NULL),(90,33,50,53,57,0,0,'45091613','AG68','AG68','AG68',1,'1 KG',1,NULL,NULL,0,1,NULL,NULL),(91,34,48,54,58,0,0,'58562300','AH110','AH110','AH110',4,'250 ml',1,NULL,NULL,0,1,NULL,NULL),(92,34,48,54,58,0,0,'58567411','AH69','AH69','AH69',4,'1 kg',1,NULL,NULL,0,1,NULL,NULL),(93,35,49,55,59,0,0,'59021551','AI70','AI70','AI70',1,'84 KG',1,NULL,NULL,0,1,NULL,NULL),(94,36,50,56,60,0,0,'58985079','AJ71','AJ71','AJ71',2,'4.8 Liter',1,NULL,NULL,0,1,NULL,NULL),(95,36,50,56,60,0,0,'58985086','AJ72','AJ72','AJ72',2,'6 Liter',1,NULL,NULL,0,1,NULL,NULL),(96,37,48,51,57,0,0,'58988902','AK73','AK73','AK73',2,'5 Liter',1,NULL,NULL,0,1,NULL,NULL),(97,37,48,51,57,0,0,'58970662','AK74','AK74','AK74',2,'6 Liter',1,NULL,NULL,0,1,NULL,NULL),(98,37,48,51,57,0,0,'58976480','AK97','AK97','AK97',2,'10 Liter',1,NULL,NULL,0,1,NULL,NULL),(99,38,49,52,58,0,0,'58971928','AL75','AL75','AL75',2,'4.8 Liter',1,NULL,NULL,0,1,NULL,NULL),(100,38,49,52,58,0,0,'58971461','AL83','AL83','AL83',2,'6 Liter',1,NULL,NULL,0,1,NULL,NULL),(101,39,50,53,59,0,0,'58972987','AM76','AM76','AM76',2,'4.8 Liter',1,NULL,NULL,0,0,NULL,NULL),(102,39,50,53,59,0,0,'58972956','AM77','AM77','AM77',2,'6 Liter',1,NULL,NULL,0,0,NULL,NULL),(103,40,48,54,60,0,0,'58001276','AN101','AN101','AN101',2,'200 Liter',1,NULL,NULL,0,0,NULL,NULL),(104,40,48,54,60,0,0,'58950602','AN78','AN78','AN78',2,'20 Liter',1,NULL,NULL,0,0,NULL,NULL),(105,40,48,54,60,0,0,'58005311','AN96','AN96','AN96',2,'2.5 Liter',1,NULL,NULL,0,0,NULL,NULL),(106,41,49,55,57,0,0,'58984829','AO82','AO82','AO82',1,'5 KG',1,NULL,NULL,0,0,NULL,NULL),(107,42,50,56,58,0,0,'58042347','AP112','AP112','AP112',2,'4.8 Liter',1,NULL,NULL,0,0,NULL,NULL),(108,42,50,56,58,0,0,'58940375','AP85','AP85','AP85',2,'0.5 Liter',1,NULL,NULL,0,0,NULL,NULL),(109,43,48,51,59,0,0,'5AP50002','AQ90','AQ90','AQ90',4,'0.5 Kg',1,NULL,NULL,0,0,NULL,NULL),(110,44,49,52,60,0,0,'58989114','AR106','AR106','AR106',2,'4.8 Liter',1,NULL,NULL,0,0,NULL,NULL),(111,44,49,52,60,0,0,'58989121','AR107','AR107','AR107',2,'1000 Liter',1,NULL,NULL,0,0,NULL,NULL),(112,44,49,52,60,0,0,'58011916','AR98','AR98','AR98',2,'10 Liter',1,NULL,NULL,0,0,NULL,NULL),(113,44,49,52,60,0,0,'58987882','AR99','AR99','AR99',2,'6 Liter',1,NULL,NULL,0,0,NULL,NULL),(114,45,50,53,57,0,0,'58005939','AS100','AS100','AS100',1,'100 KG',1,NULL,NULL,0,0,NULL,NULL),(115,45,50,53,57,0,0,'58024855','AS109','AS109','AS109',1,'3 KG',1,NULL,NULL,0,0,NULL,NULL),(116,45,50,53,57,0,0,'58044341','AS115','AS115','AS115',1,'0.25 KG',1,NULL,NULL,0,0,NULL,NULL),(117,46,48,54,58,0,0,'58238403','AT102','AT102','AT102',2,'200 Liter',1,NULL,NULL,0,0,NULL,NULL),(118,47,49,55,59,0,0,'58635738','AU104','AU104','AU104',1,'1.5 KG',1,NULL,NULL,0,0,NULL,NULL);

/*Table structure for table `bf_master_product_type_label_country` */

CREATE TABLE `bf_master_product_type_label_country` (
  `product_type_label_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type_label_regional_id` int(11) DEFAULT NULL,
  `product_type_label_name` varchar(255) DEFAULT NULL,
  `Description` text,
  `country_id` int(11) DEFAULT NULL,
  `PBG` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`product_type_label_country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_product_type_label_country` */

insert  into `bf_master_product_type_label_country`(`product_type_label_country_id`,`product_type_label_regional_id`,`product_type_label_name`,`Description`,`country_id`,`PBG`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,1,'Product Business Group\r\n','Product Business Group',101,1,3,0,0,1,'2016-05-09 00:00:00',NULL),(2,2,'Product Category','Product Category',101,0,3,3,0,1,'2016-05-09 00:00:00',NULL),(3,3,'Product Segment\r\n','Product Segment',101,0,NULL,NULL,0,1,NULL,NULL),(4,4,'Formulation\r\n','Formulation',101,0,NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_product_type_label_regional` */

CREATE TABLE `bf_master_product_type_label_regional` (
  `product_type_label_regional_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type_label_name` varchar(255) DEFAULT NULL,
  `product_type_label_code` varchar(255) DEFAULT NULL,
  `Description` text,
  `PBG` tinyint(1) DEFAULT '0',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`product_type_label_regional_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_product_type_label_regional` */

insert  into `bf_master_product_type_label_regional`(`product_type_label_regional_id`,`product_type_label_name`,`product_type_label_code`,`Description`,`PBG`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,'Product Business Group\r\n','101','Product Business Group',1,3,NULL,0,1,'2016-05-09 12:17:18',NULL),(2,'Product Category\r\n','102','Product Category',0,3,3,0,1,'2016-05-09 00:00:00',NULL),(3,'Product Segment\r\n','103','Product Segment',0,NULL,NULL,0,1,NULL,NULL),(4,'Formulation\r\n','104','Formulation',0,NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_product_type_name_country` */

CREATE TABLE `bf_master_product_type_name_country` (
  `product_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_regional_id` int(11) DEFAULT NULL,
  `product_country_name` varchar(255) DEFAULT NULL,
  `Description` text,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`product_country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_product_type_name_country` */

insert  into `bf_master_product_type_name_country`(`product_country_id`,`product_regional_id`,`product_country_name`,`Description`,`country_id`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,1,'A','A',101,NULL,NULL,0,1,NULL,NULL),(2,1,'B','B',101,NULL,NULL,0,1,NULL,NULL),(3,1,'C','C',101,NULL,NULL,0,1,NULL,NULL),(4,1,'D','D',101,NULL,NULL,0,1,NULL,NULL),(5,1,'E','E',101,NULL,NULL,0,1,NULL,NULL),(6,1,'F','F',101,NULL,NULL,0,1,NULL,NULL),(7,1,'G','G',101,NULL,NULL,0,1,NULL,NULL),(8,1,'H','H',101,NULL,NULL,0,1,NULL,NULL),(9,1,'I','I',101,NULL,NULL,0,1,NULL,NULL),(10,1,'J','J',101,NULL,NULL,0,1,NULL,NULL),(11,1,'K','K',101,NULL,NULL,0,1,NULL,NULL),(12,1,'L','L',101,NULL,NULL,0,1,NULL,NULL),(13,1,'M','M',101,NULL,NULL,0,1,NULL,NULL),(14,1,'N','N',101,NULL,NULL,0,1,NULL,NULL),(15,1,'O','O',101,NULL,NULL,0,1,NULL,NULL),(16,1,'P','P',101,NULL,NULL,0,1,NULL,NULL),(17,1,'Q','Q',101,NULL,NULL,0,1,NULL,NULL),(18,1,'R','R',101,NULL,NULL,0,1,NULL,NULL),(19,1,'S','S',101,NULL,NULL,0,1,NULL,NULL),(20,1,'T','T',101,NULL,NULL,0,1,NULL,NULL),(21,1,'U','U',101,NULL,NULL,0,1,NULL,NULL),(22,1,'V','V',101,NULL,NULL,0,1,NULL,NULL),(23,1,'W','W',101,NULL,NULL,0,1,NULL,NULL),(24,1,'X','X',101,NULL,NULL,0,1,NULL,NULL),(25,1,'Y','Y',101,NULL,NULL,0,1,NULL,NULL),(26,1,'Z','Z',101,NULL,NULL,0,1,NULL,NULL),(27,1,'AA','AA',101,NULL,NULL,0,1,NULL,NULL),(28,1,'AB','AB',101,NULL,NULL,0,1,NULL,NULL),(29,1,'AC','AC',101,NULL,NULL,0,1,NULL,NULL),(30,1,'AD','AD',101,NULL,NULL,0,1,NULL,NULL),(31,1,'AE','AE',101,NULL,NULL,0,1,NULL,NULL),(32,1,'AF','AF',101,NULL,NULL,0,1,NULL,NULL),(33,1,'AG','AG',101,NULL,NULL,0,1,NULL,NULL),(34,1,'AH','AH',101,NULL,NULL,0,1,NULL,NULL),(35,1,'AI','AI',101,NULL,NULL,0,1,NULL,NULL),(36,1,'AJ','AJ',101,NULL,NULL,0,1,NULL,NULL),(37,1,'AK','AK',101,NULL,NULL,0,1,NULL,NULL),(38,1,'AL','AL',101,NULL,NULL,0,1,NULL,NULL),(39,1,'AM','AM',101,NULL,NULL,0,1,NULL,NULL),(40,1,'AN','AN',101,NULL,NULL,0,1,NULL,NULL),(41,1,'AO','AO',101,NULL,NULL,0,1,NULL,NULL),(42,1,'AP','AP',101,NULL,NULL,0,1,NULL,NULL),(43,1,'AQ','AQ',101,NULL,NULL,0,1,NULL,NULL),(44,1,'AR','AR',101,NULL,NULL,0,1,NULL,NULL),(45,1,'AS','AS',101,NULL,NULL,0,1,NULL,NULL),(46,1,'AT','AT',101,NULL,NULL,0,1,NULL,NULL),(47,1,'AU','AU',101,NULL,NULL,0,1,NULL,NULL),(48,2,'Category A','Category A',101,NULL,NULL,0,1,NULL,NULL),(49,2,'Category B','Category B',101,NULL,NULL,0,1,NULL,NULL),(50,2,'Category C','Category C',101,NULL,NULL,0,1,NULL,NULL),(51,3,'Fungicide','Fungicide',101,NULL,NULL,0,1,NULL,NULL),(52,3,'Insectiside','Insectiside',101,NULL,NULL,0,1,NULL,NULL),(53,3,'Herbiside','Herbiside',101,NULL,NULL,0,1,NULL,NULL),(54,3,'Crop Speciality','Crop Speciality',101,NULL,NULL,0,1,NULL,NULL),(55,3,'Pesticide','Pesticide',101,NULL,NULL,0,1,NULL,NULL),(56,3,'BD','BD',101,NULL,NULL,0,1,NULL,NULL),(57,4,'WC 80','WC 80',101,NULL,NULL,0,1,NULL,NULL),(58,4,'SC 15','SC 15',101,NULL,NULL,0,1,NULL,NULL),(59,4,'SC 50','SC 50',101,NULL,NULL,0,1,NULL,NULL),(60,4,'HC 50','HC 50',101,NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_product_type_name_regional` */

CREATE TABLE `bf_master_product_type_name_regional` (
  `product_regional_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type_label_regional_id` int(11) DEFAULT NULL,
  `product_regional_name` varchar(255) DEFAULT NULL,
  `product_regional_code` varchar(255) DEFAULT NULL,
  `Description` text,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`product_regional_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_product_type_name_regional` */

insert  into `bf_master_product_type_name_regional`(`product_regional_id`,`product_type_label_regional_id`,`product_regional_name`,`product_regional_code`,`Description`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,1,'A','1001','A',NULL,NULL,0,1,NULL,NULL),(2,1,'B','1002','B',NULL,NULL,0,1,NULL,NULL),(3,1,'C','1003','C',NULL,NULL,0,1,NULL,NULL),(4,1,'D','1004','D',NULL,NULL,0,1,NULL,NULL),(5,1,'E','1005','E',NULL,NULL,0,1,NULL,NULL),(6,1,'F','1006','F',NULL,NULL,0,1,NULL,NULL),(7,1,'G','1007','G',NULL,NULL,0,1,NULL,NULL),(8,1,'H','1008','H',NULL,NULL,0,1,NULL,NULL),(9,1,'I','1009','I',NULL,NULL,0,1,NULL,NULL),(10,1,'J','1010','J',NULL,NULL,0,1,NULL,NULL),(11,1,'K','1011','K',NULL,NULL,0,1,NULL,NULL),(12,1,'L','1012','L',NULL,NULL,0,1,NULL,NULL),(13,1,'M','1013','M',NULL,NULL,0,1,NULL,NULL),(14,1,'N','1014','N',NULL,NULL,0,1,NULL,NULL),(15,1,'O','1015','O',NULL,NULL,0,1,NULL,NULL),(16,1,'P','1016','P',NULL,NULL,0,1,NULL,NULL),(17,1,'Q','1017','Q',NULL,NULL,0,1,NULL,NULL),(18,1,'R','1018','R',NULL,NULL,0,1,NULL,NULL),(19,1,'S','1019','S',NULL,NULL,0,1,NULL,NULL),(20,1,'T','1020','T',NULL,NULL,0,1,NULL,NULL),(21,1,'U','1021','U',NULL,NULL,0,1,NULL,NULL),(22,1,'V','1022','V',NULL,NULL,0,1,NULL,NULL),(23,1,'W','1023','W',NULL,NULL,0,1,NULL,NULL),(24,1,'X','1024','X',NULL,NULL,0,1,NULL,NULL),(25,1,'Y','1025','Y',NULL,NULL,0,1,NULL,NULL),(26,1,'Z','1026','Z',NULL,NULL,0,1,NULL,NULL),(27,1,'AA','1027','AA',NULL,NULL,0,1,NULL,NULL),(28,1,'AB','1028','AB',NULL,NULL,0,1,NULL,NULL),(29,1,'AC','1029','AC',NULL,NULL,0,1,NULL,NULL),(30,1,'AD','1030','AD',NULL,NULL,0,1,NULL,NULL),(31,1,'AE','1031','AE',NULL,NULL,0,1,NULL,NULL),(32,1,'AF','1032','AF',NULL,NULL,0,1,NULL,NULL),(33,1,'AG','1033','AG',NULL,NULL,0,1,NULL,NULL),(34,1,'AH','1034','AH',NULL,NULL,0,1,NULL,NULL),(35,1,'AI','1035','AI',NULL,NULL,0,1,NULL,NULL),(36,1,'AJ','1036','AJ',NULL,NULL,0,1,NULL,NULL),(37,1,'AK','1037','AK',NULL,NULL,0,1,NULL,NULL),(38,1,'AL','1038','AL',NULL,NULL,0,1,NULL,NULL),(39,1,'AM','1039','AM',NULL,NULL,0,1,NULL,NULL),(40,1,'AN','1040','AN',NULL,NULL,0,1,NULL,NULL),(41,1,'AO','1041','AO',NULL,NULL,0,1,NULL,NULL),(42,1,'AP','1042','AP',NULL,NULL,0,1,NULL,NULL),(43,1,'AQ','1043','AQ',NULL,NULL,0,1,NULL,NULL),(44,1,'AR','1044','AR',NULL,NULL,0,1,NULL,NULL),(45,1,'AS','1045','AS',NULL,NULL,0,1,NULL,NULL),(46,1,'AT','1046','AT',NULL,NULL,0,1,NULL,NULL),(47,1,'AU','1047','AU',NULL,NULL,0,1,NULL,NULL),(48,2,'Category A','1048','AV',NULL,NULL,0,1,NULL,NULL),(49,2,'Category B','1049','AW',NULL,NULL,0,1,NULL,NULL),(50,2,'Category C','1050','AX',NULL,NULL,0,1,NULL,NULL),(51,3,'Fungicide','1051','AY',NULL,NULL,0,1,NULL,NULL),(52,3,'Insectiside','1052','AZ',NULL,NULL,0,1,NULL,NULL),(53,3,'Herbiside','1053','BA',NULL,NULL,0,1,NULL,NULL),(54,3,'Crop Speciality','1054','BB',NULL,NULL,0,1,NULL,NULL),(55,3,'Pesticide','1055','BC',NULL,NULL,0,1,NULL,NULL),(56,3,'BD','1056','BD',NULL,NULL,0,1,NULL,NULL),(57,4,'WC 80','1057','BE',NULL,NULL,0,1,NULL,NULL),(58,4,'SC 15','1058','BF',NULL,NULL,0,1,NULL,NULL),(59,4,'SC 50','1059','BG',NULL,NULL,0,1,NULL,NULL),(60,4,'HC 50','1060','BH',NULL,NULL,0,1,NULL,NULL),(61,NULL,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_promotional_material_country` */

CREATE TABLE `bf_master_promotional_material_country` (
  `promotional_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `promotional_regional_id` int(11) DEFAULT NULL,
  `promotional_material_country_name` varchar(255) DEFAULT NULL,
  `promotional_material_country_code` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`promotional_country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_promotional_material_country` */

insert  into `bf_master_promotional_material_country`(`promotional_country_id`,`promotional_regional_id`,`promotional_material_country_name`,`promotional_material_country_code`,`created_by_user`,`modified_by_user`,`country_id`,`deleted`,`status`,`created_on`,`modified_on`) values (1,1,'Agclelance Card','1001',NULL,NULL,101,0,1,NULL,NULL),(2,2,'Calendar','1002',NULL,NULL,101,0,1,NULL,NULL),(3,3,'Leaflets','1003',NULL,NULL,101,0,1,NULL,NULL),(4,4,'Handouts','1004',NULL,NULL,101,0,1,NULL,NULL),(5,5,'Banners','1005',NULL,NULL,101,0,1,NULL,NULL),(6,6,'Flex Banners','1006',NULL,NULL,101,0,1,NULL,NULL);

/*Table structure for table `bf_master_promotional_material_regional` */

CREATE TABLE `bf_master_promotional_material_regional` (
  `promotional_regional_id` int(11) NOT NULL AUTO_INCREMENT,
  `promotional_material_regional_name` varchar(255) DEFAULT NULL,
  `promotional_material_regional_code` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`promotional_regional_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_promotional_material_regional` */

insert  into `bf_master_promotional_material_regional`(`promotional_regional_id`,`promotional_material_regional_name`,`promotional_material_regional_code`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,'Agclelance Card\r\n','1001',NULL,NULL,0,1,NULL,NULL),(2,'Calendar\r\n','1002',NULL,NULL,0,1,NULL,NULL),(3,'Leaflets\r\n','1003',NULL,NULL,0,1,NULL,NULL),(4,'Handouts\r\n','1004',NULL,NULL,0,1,NULL,NULL),(5,'Banners\r\n','1005',NULL,NULL,0,1,NULL,NULL),(6,'Flex Banners\r\n','1006',NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_qualification` */

CREATE TABLE `bf_master_qualification` (
  `qualification_id` int(11) NOT NULL AUTO_INCREMENT,
  `qualification_name` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`qualification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_qualification` */

insert  into `bf_master_qualification`(`qualification_id`,`qualification_name`,`country_id`,`deleted`,`status`,`created_on`,`modified_on`) values (1,'BTECH',101,0,1,'2016-08-13 00:00:00','0000-00-00 00:00:00'),(2,'GRADUATE',101,0,1,'2016-08-13 00:00:00','0000-00-00 00:00:00'),(3,'POST GRADUATE',101,0,1,'2016-08-13 00:00:00','0000-00-00 00:00:00'),(4,'DIPLOMA',101,0,1,'2016-08-13 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `bf_master_questions` */

CREATE TABLE `bf_master_questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `question_type` enum('text','radio','checkbox','image') NOT NULL DEFAULT 'text',
  `question_options` text NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=No , 1=Yes',
  `created_by_user` int(11) NOT NULL,
  `modified_by_user` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Inactive , 1=Active',
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_questions` */

/*Table structure for table `bf_master_regional_disease_symptoms` */

CREATE TABLE `bf_master_regional_disease_symptoms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `symptom_regional_name` varchar(150) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_regional_disease_symptoms` */

insert  into `bf_master_regional_disease_symptoms`(`id`,`symptom_regional_name`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,'black spot',NULL,NULL,0,1,NULL,NULL),(2,'red spot',NULL,NULL,0,1,NULL,NULL),(3,'insect',NULL,NULL,0,1,NULL,NULL);

/*Table structure for table `bf_master_role_to_customer_type_mapping` */

CREATE TABLE `bf_master_role_to_customer_type_mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `customer_type_regional_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_role_to_customer_type_mapping` */

insert  into `bf_master_role_to_customer_type_mapping`(`id`,`role_id`,`customer_type_regional_id`,`deleted`,`created_on`,`modified_on`) values (1,11,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,10,2,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,9,3,0,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `bf_master_scheme` */

CREATE TABLE `bf_master_scheme` (
  `scheme_id` int(11) NOT NULL AUTO_INCREMENT,
  `scheme_code` varchar(255) DEFAULT NULL,
  `scheme_name` varchar(255) DEFAULT NULL,
  `year` date DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`scheme_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_scheme` */

insert  into `bf_master_scheme`(`scheme_id`,`scheme_code`,`scheme_name`,`year`,`created_by_user`,`modified_by_user`,`country_id`,`status`,`created_on`,`modified_on`) values (1,'001','scheme1','2016-01-01',45,NULL,101,1,NULL,NULL),(2,'002','scheme2','2016-01-01',45,NULL,101,1,NULL,NULL),(3,'003','scheme3','2016-01-01',45,NULL,101,1,NULL,NULL),(4,'004','scheme4','2016-01-01',45,NULL,101,1,NULL,NULL),(5,'005','scheme5','2016-01-01',45,NULL,101,1,NULL,NULL);

/*Table structure for table `bf_master_scheme_slab` */

CREATE TABLE `bf_master_scheme_slab` (
  `slab_id` int(11) NOT NULL AUTO_INCREMENT,
  `scheme_id` int(11) DEFAULT NULL,
  `1point` varchar(255) DEFAULT NULL,
  `slab_no` varchar(255) DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `value_per_kg` varchar(255) DEFAULT NULL,
  `value_per_point` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `target_point` varchar(255) DEFAULT NULL,
  `target_value` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`slab_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_scheme_slab` */

insert  into `bf_master_scheme_slab`(`slab_id`,`scheme_id`,`1point`,`slab_no`,`product_sku_id`,`value_per_kg`,`value_per_point`,`target`,`target_point`,`target_value`,`created_by_user`,`modified_by_user`,`status`,`created_on`,`modified_on`) values (1,1,'123','slab1',1,'12','34','1','1','2',45,NULL,1,NULL,NULL),(2,1,'123','slab2',1,'11','1','12','23','1',45,NULL,1,NULL,NULL),(3,1,'32','slab3',1,'11','2','12','456','1',45,NULL,1,NULL,NULL),(4,2,'231','slab4',2,'10','6','21','456','1',45,NULL,1,NULL,NULL),(5,2,'2456','slab5',2,'12','3','21','456','2',45,NULL,1,NULL,NULL),(6,2,'23','slab6',2,'1','5','21','645','3',45,NULL,1,NULL,NULL),(7,3,'654','slab7',3,'21','1','2134','6456','435',45,NULL,1,NULL,NULL),(8,3,'34','slab8',3,'32','3','345','456','6',45,NULL,1,NULL,NULL),(9,3,'53','slab9',3,'12','1','234','456','764',45,NULL,1,NULL,NULL),(10,3,'232','slab10',3,'12','2','123','45','34',45,NULL,1,NULL,NULL),(11,3,'12','slab11',3,'12','3','12','646','34',45,NULL,1,NULL,NULL);

/*Table structure for table `bf_master_uom` */

CREATE TABLE `bf_master_uom` (
  `uom_id` int(11) NOT NULL AUTO_INCREMENT,
  `uom_code` varchar(255) DEFAULT NULL,
  `uom_name` varchar(255) DEFAULT NULL,
  `uom_Description` text,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`uom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_uom` */

insert  into `bf_master_uom`(`uom_id`,`uom_code`,`uom_name`,`uom_Description`,`created_by_user`,`modified_by_user`,`deleted`,`status`,`created_on`,`modified_on`) values (1,'101','KG','KG',3,3,0,1,'2016-05-11 00:00:00',NULL),(2,'102','Liter\r\n','Liter',3,3,0,1,'2016-05-11 00:00:00',NULL),(3,'103','Gram\r\n','Gram',3,3,0,1,'2016-05-11 00:00:00',NULL),(4,'104','PC\r\n','PC',3,3,0,1,'2016-05-11 00:00:00',NULL);

/*Table structure for table `bf_master_user_contact_details` */

CREATE TABLE `bf_master_user_contact_details` (
  `contact_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `primary_mobile_no` int(20) DEFAULT NULL,
  `secondary_mobile_no` int(20) DEFAULT NULL,
  `landline_no` int(20) DEFAULT NULL,
  `secondary_email_id` varchar(30) DEFAULT NULL,
  `website` varchar(30) DEFAULT NULL,
  `house_no` varchar(30) DEFAULT NULL,
  `address` text,
  `landmark` varchar(255) DEFAULT NULL,
  `geo_level_id3` int(11) DEFAULT NULL COMMENT 'Parent Level 2',
  `geo_level_id2` int(11) DEFAULT NULL COMMENT 'Parent Level 1',
  `geo_level_id1` int(11) DEFAULT NULL COMMENT 'Base Level',
  `pincode` varchar(30) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`contact_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_user_contact_details` */

insert  into `bf_master_user_contact_details`(`contact_detail_id`,`user_id`,`primary_mobile_no`,`secondary_mobile_no`,`landline_no`,`secondary_email_id`,`website`,`house_no`,`address`,`landmark`,`geo_level_id3`,`geo_level_id2`,`geo_level_id1`,`pincode`,`latitude`,`longitude`) values (1,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL),(2,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,67,NULL,NULL,NULL),(3,11,33345445,56577656,676547476,NULL,NULL,NULL,NULL,NULL,126,127,128,NULL,NULL,NULL),(4,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,133,NULL,NULL,NULL),(5,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL),(6,35,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,133,NULL,NULL,NULL),(7,36,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,67,NULL,NULL,NULL),(8,37,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,126,127,128,NULL,NULL,NULL),(9,38,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,133,NULL,NULL,NULL),(10,39,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL),(11,4,123456789,6666666,6666666,NULL,NULL,NULL,'sddsad dsa sad dsd dfgd gdf gdfg d',NULL,3,4,5,'9999',NULL,NULL),(12,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,4,8,NULL,NULL,NULL),(13,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,4,5,NULL,NULL,NULL),(14,14,88888888,444444444,444444444,NULL,NULL,NULL,'',NULL,2,3,49,'23232',NULL,NULL),(15,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,3,61,NULL,NULL,NULL),(16,16,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,3,63,NULL,NULL,NULL),(17,17,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,4,NULL,NULL,NULL),(18,18,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,4,NULL,NULL,NULL),(19,19,999999,33333333,65565656,NULL,NULL,NULL,NULL,NULL,2,3,49,NULL,NULL,NULL),(20,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,4,5,NULL,NULL,NULL),(21,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,4,8,NULL,NULL,NULL),(22,25,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,4,8,NULL,NULL,NULL),(23,26,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,4,8,NULL,NULL,NULL),(24,27,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,4,8,NULL,NULL,NULL),(25,28,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,4,5,NULL,NULL,NULL),(26,29,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,4,5,NULL,NULL,NULL),(27,20,1234567890,2147483647,NULL,NULL,NULL,'rtyerty','tye',NULL,3,4,5,NULL,NULL,NULL);

/*Table structure for table `bf_master_user_educational_details` */

CREATE TABLE `bf_master_user_educational_details` (
  `education_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `qualification_id` int(11) DEFAULT NULL,
  `edu_specialization_id` int(11) DEFAULT NULL,
  `instiute` varchar(255) DEFAULT NULL,
  `year` date DEFAULT '0000-00-00',
  PRIMARY KEY (`education_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_user_educational_details` */

insert  into `bf_master_user_educational_details`(`education_detail_id`,`user_id`,`qualification_id`,`edu_specialization_id`,`instiute`,`year`) values (1,4,1,NULL,'S.P. University','1985-01-01'),(2,5,2,2,'Harward University','1985-01-01'),(3,6,3,0,'K.S Institute','1985-01-01'),(4,7,4,0,'A.B Instityte','1985-01-01'),(5,8,5,0,'ARIBAS','1985-01-01'),(6,9,6,0,'Oxford University','1985-01-01'),(7,10,7,0,'S.P. University','1985-01-01'),(8,11,8,0,'Harward University','1985-01-01'),(9,12,9,0,'Oxford University','1985-01-01'),(10,13,10,0,'S.P. University','1985-01-01'),(11,14,1,1,'Harward University','1987-01-01'),(12,15,2,2,'Oxford University','1985-01-01'),(13,16,3,0,'K.S Institute','1985-01-01'),(14,17,4,0,'A.B Instityte','1985-01-01'),(15,18,5,0,'ARIBAS','1985-01-01'),(16,19,6,0,'S.P. University','1985-01-01'),(17,20,7,0,'Harward University','1985-01-01'),(18,21,8,0,'Oxford University','1985-01-01'),(19,22,9,0,'S.P. University','1985-01-01'),(20,23,10,0,'Harward University','1985-01-01'),(21,24,1,1,'Oxford University','1985-01-01'),(22,25,2,2,'S.P. University','1985-01-01'),(23,26,3,0,'A.B Instityte','1985-01-01'),(24,27,4,0,'A.B Instityte','1985-01-01'),(25,28,5,0,'ARIBAS','1985-01-01'),(26,29,6,0,'S.P. University','1985-01-01'),(27,30,7,0,'Harward University','1985-01-01'),(28,31,8,0,'Oxford University','1985-01-01'),(29,32,9,0,'S.P. University','1985-01-01'),(30,33,10,0,'Harward University','1985-01-01'),(31,34,1,1,'Oxford University','1985-01-01'),(32,35,2,2,'S.P. University','1985-01-01'),(33,36,3,0,'A.B Instityte','1985-01-01'),(34,37,4,0,'A.B Instityte','1985-01-01'),(35,38,5,0,'ARIBAS','1985-01-01'),(36,39,6,0,'S.P. University','1985-01-01'),(37,40,7,0,'Harward University','1985-01-01'),(38,41,8,0,'Oxford University','1985-01-01'),(39,42,9,0,'S.P. University','1985-01-01'),(40,43,10,0,'Harward University','1985-01-01'),(41,44,1,1,'Oxford University','1985-01-01'),(42,4,2,NULL,'S.P','1986-01-01'),(43,4,3,NULL,'yyyy','2015-01-01'),(44,14,2,4,'uiuiui','2013-01-01');

/*Table structure for table `bf_master_user_family_details` */

CREATE TABLE `bf_master_user_family_details` (
  `family_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `relative_name` varchar(255) DEFAULT NULL,
  `relative_relation` varchar(255) DEFAULT NULL,
  `relative_dob` date DEFAULT NULL,
  `gender` varchar(30) DEFAULT NULL,
  `dependent` tinyint(1) DEFAULT NULL,
  `mobile_no` int(20) DEFAULT NULL,
  `email_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`family_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_user_family_details` */

insert  into `bf_master_user_family_details`(`family_detail_id`,`user_id`,`relative_name`,`relative_relation`,`relative_dob`,`gender`,`dependent`,`mobile_no`,`email_id`) values (1,4,'test1','brother','2016-06-08','Male',0,78787878,'test1@gmail.com'),(3,4,'test2','sister','2016-06-08','Female',1,3443438,'test2@gmail.com'),(5,4,'test3','mother','2016-06-08','Female',1,3443438,'test3@gmail.com'),(6,4,'yyyy','father','2016-08-23','Male',0,555555,'yyyy@gmail.com'),(7,14,'tytyt','yttyy','2016-08-24','Male',0,767667767,'tyt@gmail.com');

/*Table structure for table `bf_master_user_financial_electronic_details` */

CREATE TABLE `bf_master_user_financial_electronic_details` (
  `financial_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `electronic_owned_id` int(11) NOT NULL,
  PRIMARY KEY (`financial_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_user_financial_electronic_details` */

insert  into `bf_master_user_financial_electronic_details`(`financial_detail_id`,`user_id`,`electronic_owned_id`) values (12,4,1),(13,4,2),(16,14,2),(17,14,3),(18,11,1);

/*Table structure for table `bf_master_user_financial_vehicles_details` */

CREATE TABLE `bf_master_user_financial_vehicles_details` (
  `financial_vehicles_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `vehicles_owned_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`financial_vehicles_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_user_financial_vehicles_details` */

insert  into `bf_master_user_financial_vehicles_details`(`financial_vehicles_id`,`user_id`,`vehicles_owned_id`) values (11,4,2),(14,14,1),(15,11,1);

/*Table structure for table `bf_master_user_group_member` */

CREATE TABLE `bf_master_user_group_member` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_user_group_member` */

/*Table structure for table `bf_master_user_organization` */

CREATE TABLE `bf_master_user_organization` (
  `organization_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `org_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`organization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_user_organization` */

/*Table structure for table `bf_master_user_personal_details` */

CREATE TABLE `bf_master_user_personal_details` (
  `personal_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `salutation` varchar(50) DEFAULT NULL,
  `firm_name` varchar(30) DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `middle_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `call_name` varchar(30) DEFAULT NULL,
  `gender` varchar(30) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `martial_status` varchar(30) DEFAULT NULL,
  `introduction_year` int(11) DEFAULT NULL,
  `influencer` tinyint(1) DEFAULT NULL,
  `doa` date DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `blood_group` varchar(30) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `no_of_child` int(11) DEFAULT NULL,
  `average_pa_income` decimal(9,2) DEFAULT NULL,
  `land_size` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`personal_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_user_personal_details` */

insert  into `bf_master_user_personal_details`(`personal_detail_id`,`user_id`,`salutation`,`firm_name`,`first_name`,`middle_name`,`last_name`,`call_name`,`gender`,`dob`,`religion`,`martial_status`,`introduction_year`,`influencer`,`doa`,`category_id`,`blood_group`,`profile_image`,`no_of_child`,`average_pa_income`,`land_size`) values (1,4,'Mr','test1','abc1','abc1','abc1','UD','Male','1991-02-12','Hindu','Unmarried',2015,1,NULL,NULL,'B',NULL,0,'1100.00','12000.00'),(2,5,'Mr','test2','Raj','Singh','Test','RAW','Male','1991-02-12','Hindu','Unmarried',2015,1,NULL,NULL,'B',NULL,0,'1000.00','12000.00'),(3,6,'Mr','test3','Rahul','Rathore','','Rahul','Male','1991-02-12','Hindu','Unmarried',2015,1,NULL,NULL,'B',NULL,0,'1000.00','12000.00'),(4,10,'Mr','test3','Rahul98','Rathore78','','Rahul87','Male','1991-02-12','Hindu','Unmarried',2015,1,NULL,NULL,'B',NULL,0,'1000.00','12000.00'),(5,14,'Mr','test356','Rahul9658','Rathore7865','','vvv','Male','1991-02-12','Hindu','Unmarried',2015,1,NULL,NULL,'B',NULL,0,'3000.00','12000.00'),(6,18,'Mr','test356as','Rahul96df58','sdRadthore7865','','Rahul876','Male','1991-02-12','Hindu','Unmarried',2015,1,NULL,NULL,'B',NULL,0,'1000.00','12000.00'),(7,19,'Mr','test35i6as','Rahul96','sdRadth','','uuu','Male','1991-02-12','Hindu','Unmarried',2015,1,NULL,NULL,'B',NULL,0,'1000.00','12000.00'),(8,15,'Mr','test35i6as','yuyu','yu','yuy','yt','Male','1991-02-12','Hindu','Unmarried',2015,1,NULL,NULL,'B',NULL,0,'1000.00','12000.00'),(9,17,'Mr','gghjhj','yuyu','yu','yuy','yt','Male','1991-02-12','Hindu','Unmarried',2015,1,NULL,NULL,'B',NULL,0,'1000.00','12000.00'),(10,16,'Mr','sasasa','yuyu','yu','yuy','yt','Male','1991-02-12','Hindu','Unmarried',2015,1,NULL,NULL,'B',NULL,0,'1000.00','12000.00'),(11,9,'Mr','dest1','dest1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,11,'Mr','dest3','dest3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'455544.00',NULL),(14,12,'Mr','dest4','dest4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,13,'Mr','dest5','dest5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,36,'Mr','','tes111','a','b',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,20,'Mr','','zzzz','x','c',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `bf_master_user_social_account_details` */

CREATE TABLE `bf_master_user_social_account_details` (
  `social_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `facebook_account` varchar(255) DEFAULT NULL,
  `gmail_plus_account` varchar(255) DEFAULT NULL,
  `linkedin_account` varchar(255) DEFAULT NULL,
  `twt_account` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`social_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_user_social_account_details` */

insert  into `bf_master_user_social_account_details`(`social_id`,`user_id`,`facebook_account`,`gmail_plus_account`,`linkedin_account`,`twt_account`) values (1,4,'facbook data','test.com','linkedin data','twitter data'),(2,14,'asasa','','hjjhh',''),(3,11,'kjjj','','hkkjhj','');

/*Table structure for table `bf_master_user_statutory_details` */

CREATE TABLE `bf_master_user_statutory_details` (
  `statutory_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `passport_no` varchar(50) DEFAULT NULL,
  `ktp_no` varchar(50) DEFAULT NULL,
  `statutory_detail` varchar(50) DEFAULT NULL,
  `aadhaar_card_no` varchar(50) DEFAULT NULL,
  `UID1` varchar(50) DEFAULT NULL,
  `UID2` varchar(50) DEFAULT NULL,
  `UID3` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`statutory_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_user_statutory_details` */

insert  into `bf_master_user_statutory_details`(`statutory_detail_id`,`passport_no`,`ktp_no`,`statutory_detail`,`aadhaar_card_no`,`UID1`,`UID2`,`UID3`,`user_id`) values (1,'4444','8888',NULL,'33333',NULL,NULL,NULL,4),(2,'','',NULL,'',NULL,NULL,NULL,14);

/*Table structure for table `bf_master_vehicles` */

CREATE TABLE `bf_master_vehicles` (
  `vehicle_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `bf_master_vehicles` */

insert  into `bf_master_vehicles`(`vehicle_id`,`item_name`,`deleted`,`status`,`created_on`,`modified_on`) values (1,'bike',0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'car',0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'tractor',0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'bus',0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,'jeep',0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `bf_menu` */

CREATE TABLE `bf_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `link_type` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `navigation_id` int(11) NOT NULL,
  `window` tinyint(1) NOT NULL,
  `image_name` varchar(255) NOT NULL DEFAULT '',
  `access_role_id` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `meta_description` longtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `bf_menu` */

insert  into `bf_menu`(`id`,`title`,`alias`,`link`,`link_type`,`parent_id`,`navigation_id`,`window`,`image_name`,`access_role_id`,`meta_title`,`meta_keyword`,`meta_description`,`status`,`position`) values (1,'ndfg','hjv','hjvjhv','other',0,1,0,'likeapp.png','a:1:{i:0;s:1:\"1\";}','','','',1,1),(2,'okfsgs','opj','pojj','other',0,1,0,'','a:1:{i:0;s:1:\"0\";}','','','',1,2),(3,'aa','aa','http://newbonfire.com/pages/ddf','page',0,1,0,'','a:1:{i:0;s:1:\"0\";}','','','',1,3);

/*Table structure for table `bf_navigation` */

CREATE TABLE `bf_navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `bf_navigation` */

insert  into `bf_navigation`(`id`,`title`,`position`,`description`,`created_on`,`modified_on`,`status`) values (1,'fsf','fdsf','fdsfsdff','2015-05-27 13:19:27','0000-00-00 00:00:00',1),(2,'ipj','uyohl','hlo','2015-05-29 06:32:10','0000-00-00 00:00:00',1);

/*Table structure for table `bf_newsletter` */

CREATE TABLE `bf_newsletter` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `emailID` varchar(50) NOT NULL,
  `subscribeDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `bf_newsletter` */

insert  into `bf_newsletter`(`ID`,`firstName`,`lastName`,`emailID`,`subscribeDate`) values (1,'saj','las','sajlas@gmail.com','2015-06-01 00:00:00');

/*Table structure for table `bf_newsletter_mail` */

CREATE TABLE `bf_newsletter_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `send_subscriber` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `bf_newsletter_mail` */

insert  into `bf_newsletter_mail`(`id`,`title`,`content`,`created_on`,`modified_on`,`send_subscriber`) values (10,'Save Up To $1,000 - 10% Off Promotion At Dimend SCAASI','<p><a href=\"www.dscaasi.com\"><img alt=\"Bride Wearing Dimend SCAASI Jeweler Rings\" src=\"/assets/upload/editor/images/ds_banner.jpg\" style=\"border-style:solid; border-width:1px; height:270px; width:500px\" /></a></p>\n\n<p><span style=\"color:#003399\">It&#39;s that time of year again, the days are getting shorter, the leaves are falling and Fall is upon us.<br />\nWe love this time of year, it marks the beginning of engagement and wedding season and we are thrilled to let our registered subscribers know of an exclusive promotion we are offering.</span></p>\n\n<p><span style=\"color:#003399\">For a limited time take 10% off, up to $1,000*, when you purchase any engagement ring, wedding or anniversary ring. Simply mention this e-mail and FALL14 code.</span></p>\n\n<p><span style=\"color:#003399\">You can use code FALL14 on our <a href=\"http://www.dimendscaasi.com\">site</a>&nbsp;when you checkout, or <a href=\"http://www.dimendscaasi.com/schedule-appointment\">in-store</a>.<br />\nIt is our way to entice and give back but hurry, offer ends soon.</span></p>\n\n<p><span style=\"color:#003399\">As always, we are here to help, feel free to <a href=\"mailto:sales@dscaasi.com?subject=FALL14%2010%25%20Off%20Promotion%20Inquiry\">e-mail</a> or call us at 312-857-1700.</span></p>\n\n<p><span style=\"color:#003399\">The dimend SCAASI team<br />\n<a href=\"http://www.dimendscaasi.com/\">www.dscaasi.com</a></span><br />\n312-857-1700</p>\n\n<p><span style=\"font-size:11px\">*Offer cannot be combined with any other offers or discount codes, cannot be applied retroactively.</span></p>\n\n<p>&nbsp;</p>\n','2014-09-22 13:38:49','0000-00-00 00:00:00','a:115:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"6\";i:3;s:2:\"13\";i:4;s:2:\"14\";i:5;s:2:\"21\";i:6;s:2:\"22\";i:7;s:2:\"23\";i:8;s:2:\"24\";i:9;s:2:\"25\";i:10;s:2:\"26\";i:11;s:2:\"27\";i:12;s:2:\"28\";i:13;s:2:\"29\";i:14;s:2:\"30\";i:15;s:2:\"31\";i:16;s:2:\"32\";i:17;s:2:\"33\";i:18;s:2:\"35\";i:19;s:2:\"36\";i:20;s:2:\"37\";i:21;s:2:\"38\";i:22;s:2:\"39\";i:23;s:2:\"40\";i:24;s:2:\"42\";i:25;s:2:\"43\";i:26;s:2:\"44\";i:27;s:2:\"45\";i:28;s:2:\"46\";i:29;s:2:\"47\";i:30;s:2:\"48\";i:31;s:2:\"49\";i:32;s:2:\"51\";i:33;s:2:\"52\";i:34;s:2:\"53\";i:35;s:2:\"54\";i:36;s:2:\"57\";i:37;s:2:\"58\";i:38;s:2:\"59\";i:39;s:2:\"60\";i:40;s:2:\"61\";i:41;s:2:\"62\";i:42;s:2:\"65\";i:43;s:2:\"66\";i:44;s:2:\"67\";i:45;s:2:\"68\";i:46;s:2:\"69\";i:47;s:2:\"70\";i:48;s:2:\"71\";i:49;s:2:\"72\";i:50;s:2:\"73\";i:51;s:2:\"74\";i:52;s:2:\"75\";i:53;s:2:\"76\";i:54;s:2:\"77\";i:55;s:2:\"80\";i:56;s:2:\"81\";i:57;s:2:\"82\";i:58;s:2:\"88\";i:59;s:2:\"89\";i:60;s:2:\"91\";i:61;s:2:\"94\";i:62;s:2:\"96\";i:63;s:3:\"101\";i:64;s:3:\"102\";i:65;s:3:\"108\";i:66;s:3:\"111\";i:67;s:3:\"113\";i:68;s:3:\"114\";i:69;s:3:\"115\";i:70;s:3:\"116\";i:71;s:3:\"117\";i:72;s:3:\"118\";i:73;s:3:\"119\";i:74;s:3:\"120\";i:75;s:3:\"122\";i:76;s:3:\"123\";i:77;s:3:\"124\";i:78;s:3:\"127\";i:79;s:3:\"128\";i:80;s:3:\"129\";i:81;s:3:\"131\";i:82;s:3:\"132\";i:83;s:3:\"134\";i:84;s:3:\"135\";i:85;s:3:\"137\";i:86;s:3:\"139\";i:87;s:3:\"140\";i:88;s:3:\"141\";i:89;s:3:\"142\";i:90;s:3:\"143\";i:91;s:3:\"144\";i:92;s:3:\"145\";i:93;s:3:\"146\";i:94;s:3:\"147\";i:95;s:3:\"148\";i:96;s:3:\"149\";i:97;s:3:\"150\";i:98;s:3:\"151\";i:99;s:3:\"152\";i:100;s:3:\"153\";i:101;s:3:\"154\";i:102;s:3:\"155\";i:103;s:3:\"156\";i:104;s:3:\"157\";i:105;s:3:\"158\";i:106;s:3:\"159\";i:107;s:3:\"160\";i:108;s:3:\"161\";i:109;s:3:\"163\";i:110;s:3:\"164\";i:111;s:3:\"165\";i:112;s:3:\"166\";i:113;s:3:\"168\";i:114;s:3:\"169\";}'),(11,'test','<p>test</p>\r\n','2014-12-30 05:50:14','0000-00-00 00:00:00',NULL),(12,'dsfdsafdsaf','<p>adsfasfdsafasdf</p>\r\n','2014-12-30 05:52:13','0000-00-00 00:00:00',NULL),(13,'adsfdsf','<p>adsfasdfsadf</p>\r\n','2014-12-30 05:52:45','0000-00-00 00:00:00',NULL),(14,'afadsfadsf','<p>fasdfasfasf</p>\r\n','2014-12-30 05:54:16','0000-00-00 00:00:00','a:1:{i:0;s:3:\"325\";}'),(15,'','','2015-06-01 10:18:29','0000-00-00 00:00:00','a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}'),(16,'fdfdfd','<p>dffdf</p>\r\n','2015-06-01 10:30:53','0000-00-00 00:00:00',NULL);

/*Table structure for table `bf_pages` */

CREATE TABLE `bf_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(100) NOT NULL,
  `page_slug` varchar(100) NOT NULL,
  `page_content` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `bf_pages` */

insert  into `bf_pages`(`id`,`page_title`,`page_slug`,`page_content`,`created_on`,`modified_on`,`status`) values (1,'vf','ddf','ddfdf','2015-05-29 05:26:53','0000-00-00 00:00:00',1);

/*Table structure for table `bf_permissions` */

CREATE TABLE `bf_permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=349 DEFAULT CHARSET=utf8;

/*Data for the table `bf_permissions` */

insert  into `bf_permissions`(`permission_id`,`name`,`description`,`status`) values (2,'Site.Content.View','Allow users to view the Content Context','active'),(3,'Site.Reports.View','Allow users to view the Reports Context','active'),(4,'Site.Settings.View','Allow users to view the Settings Context','active'),(5,'Site.Developer.View','Allow users to view the Developer Context','active'),(6,'Bonfire.Roles.Manage','Allow users to manage the user Roles','active'),(7,'Bonfire.Users.Manage','Allow users to manage the site Users','active'),(8,'Bonfire.Users.View','Allow users access to the User Settings','active'),(9,'Bonfire.Users.Add','Allow users to add new Users','active'),(10,'Bonfire.Database.Manage','Allow users to manage the Database settings','active'),(11,'Bonfire.Emailer.Manage','Allow users to manage the Emailer settings','active'),(12,'Bonfire.Logs.View','Allow users access to the Log details','active'),(13,'Bonfire.Logs.Manage','Allow users to manage the Log files','active'),(14,'Bonfire.Emailer.View','Allow users access to the Emailer settings','active'),(15,'Site.Signin.Offline','Allow users to login to the site when the site is offline','active'),(16,'Bonfire.Permissions.View','Allow access to view the Permissions menu unders Settings Context','active'),(17,'Bonfire.Permissions.Manage','Allow access to manage the Permissions in the system','active'),(18,'Bonfire.Roles.Delete','Allow users to delete user Roles','active'),(19,'Bonfire.Modules.Add','Allow creation of modules with the builder.','active'),(20,'Bonfire.Modules.Delete','Allow deletion of modules.','active'),(21,'Permissions.Administrator.Manage','To manage the access control permissions for the Administrator role.','active'),(22,'Permissions.Editor.Manage','To manage the access control permissions for the Editor role.','active'),(24,'Permissions.User.Manage','To manage the access control permissions for the User role.','active'),(25,'Permissions.Developer.Manage','To manage the access control permissions for the Developer role.','active'),(27,'Activities.Own.View','To view the users own activity logs','active'),(28,'Activities.Own.Delete','To delete the users own activity logs','active'),(29,'Activities.User.View','To view the user activity logs','active'),(30,'Activities.User.Delete','To delete the user activity logs, except own','active'),(31,'Activities.Module.View','To view the module activity logs','active'),(32,'Activities.Module.Delete','To delete the module activity logs','active'),(33,'Activities.Date.View','To view the users own activity logs','active'),(34,'Activities.Date.Delete','To delete the dated activity logs','active'),(35,'Bonfire.UI.Manage','Manage the Bonfire UI settings','active'),(36,'Bonfire.Settings.View','To view the site settings page.','active'),(37,'Bonfire.Settings.Manage','To manage the site settings.','active'),(38,'Bonfire.Activities.View','To view the Activities menu.','active'),(39,'Bonfire.Database.View','To view the Database menu.','active'),(40,'Bonfire.Migrations.View','To view the Migrations menu.','active'),(41,'Bonfire.Builder.View','To view the Modulebuilder menu.','active'),(42,'Bonfire.Roles.View','To view the Roles menu.','active'),(43,'Bonfire.Sysinfo.View','To view the System Information page.','active'),(44,'Bonfire.Translate.Manage','To manage the Language Translation.','active'),(45,'Bonfire.Translate.View','To view the Language Translate menu.','active'),(46,'Bonfire.UI.View','To view the UI/Keyboard Shortcut menu.','active'),(49,'Bonfire.Profiler.View','To view the Console Profiler Bar.','active'),(50,'Bonfire.Roles.Add','To add New Roles','active'),(55,'Email_Template.Settings.View','','active'),(56,'Email_Template.Settings.Create','','active'),(57,'Email_Template.Settings.Edit','','active'),(58,'Email_Template.Settings.Delete','','active'),(59,'Menu.Content.View','','active'),(60,'Menu.Content.Create','','active'),(61,'Menu.Content.Edit','','active'),(62,'Menu.Content.Delete','','active'),(63,'Navigation.Content.View','','active'),(64,'Navigation.Content.Create','','active'),(65,'Navigation.Content.Edit','','active'),(66,'Navigation.Content.Delete','','active'),(67,'Pages.Content.View','','active'),(68,'Pages.Content.Create','','active'),(69,'Pages.Content.Edit','','active'),(70,'Pages.Content.Delete','','active'),(71,'User_Management.Settings.View','','active'),(72,'User_Management.Settings.Create','','active'),(73,'User_Management.Settings.Edit','','active'),(74,'User_Management.Settings.Delete','','active'),(91,'Site.Dashboard.View','Allow user to view the Dashboard Context.','active'),(102,'Banner.Content.View','','active'),(103,'Banner.Content.Create','','active'),(104,'Banner.Content.Edit','','active'),(105,'Banner.Content.Delete','','active'),(110,'Social_Media.Content.View','','active'),(111,'Social_Media.Content.Create','','active'),(112,'Social_Media.Content.Edit','','active'),(113,'Social_Media.Content.Delete','','active'),(118,'Newsletter.Content.View','','active'),(119,'Newsletter.Content.Create','','active'),(120,'Newsletter.Content.Edit','','active'),(121,'Newsletter.Content.Delete','','active'),(190,'Site.Dashboard.View','Dashboard','active'),(279,'Site.Name.View','Allow user to view the Name Context.','active'),(280,'Site.Master.View','Allow user to view the Master Context.','active'),(282,'Site.SiteUsers.View','Allow user to view the SiteUsers Context.','active'),(287,'User_Master.Siteusers.View','','active'),(288,'User_Master.Siteusers.Create','','active'),(289,'User_Master.Siteusers.Edit','','active'),(290,'User_Master.Siteusers.Delete','','active'),(295,'Country_master.Master.View','View Country_master Master','active'),(296,'Country_master.Master.Create','Create Country_master Master','active'),(297,'Country_master.Master.Edit','Edit Country_master Master','active'),(298,'Country_master.Master.Delete','Delete Country_master Master','active'),(299,'Category_applicable_master.Master.View','View Category_applicable_master Master','active'),(300,'Category_applicable_master.Master.Create','Create Category_applicable_master Master','active'),(301,'Category_applicable_master.Master.Edit','Edit Category_applicable_master Master','active'),(302,'Category_applicable_master.Master.Delete','Delete Category_applicable_master Master','active'),(303,'Category_regional_master.Master.View','View Category_regional_master Master','active'),(304,'Category_regional_master.Master.Create','Create Category_regional_master Master','active'),(305,'Category_regional_master.Master.Edit','Edit Category_regional_master Master','active'),(306,'Category_regional_master.Master.Delete','Delete Category_regional_master Master','active'),(307,'Category_national_master.Master.View','View Category_national_master Master','active'),(308,'Category_country_master.Master.Create','Create Category_national_master Master','active'),(309,'Category_country_master.Master.Edit','Edit Category_national_master Master','active'),(310,'Category_country_master.Master.Delete','Delete Category_national_master Master','active'),(311,'Customer_type_regional.Master.View','View Customer_type_regional Master','active'),(312,'Customer_type_regional.Master.Create','Create Customer_type_regional Master','active'),(313,'Customer_type_regional.Master.Edit','Edit Customer_type_regional Master','active'),(314,'Customer_type_regional.Master.Delete','Delete Customer_type_regional Master','active'),(315,'Permissions.Head Officer.Manage','To manage the access control permissions for the Head Officer role.','active'),(316,'Permissions.Field Officer.Manage','To manage the access control permissions for the Field Officer role.','active'),(317,'Permissions.Distributor.Manage','To manage the access control permissions for the Distributor role.','active'),(318,'Permissions.Retailer.Manage','To manage the access control permissions for the Retailer role.','active'),(319,'Permissions.Farmer.Manage','To manage the access control permissions for the Farmer role.','active'),(321,'Web_service.Reports.View','View Web_service Reports','active'),(329,'Ishop.Ishop.View','','active'),(330,'Ishop.Ishop.Create','','active'),(331,'Ishop.Ishop.Edit','','active'),(332,'Ishop.Ishop.Delete','','active'),(333,'Esp.Content.View','View Esp Content','active'),(334,'Esp.Content.Create','Create Esp Content','active'),(335,'Esp.Content.Edit','Edit Esp Content','active'),(336,'Esp.Content.Delete','Delete Esp Content','active'),(337,'Permissions.Sales Manager.Manage','To manage the access control permissions for the Sales Manager role.','inactive'),(338,'Permissions.ASM.Manage','To manage the access control permissions for the ASM role.','inactive'),(339,'Permissions.Field Technical.Manage','To manage the access control permissions for the Field Technical role.','active'),(340,'Permissions.ASM.Manage','To manage the access control permissions for the ASM role.','active'),(341,'Permissions.Sales Manager.Manage','To manage the access control permissions for the Sales Manager role.','active'),(342,'Permissions.Field Technical.Manage','To manage the access control permissions for the Field Technical role.','active'),(343,'Cco.Content.View','View Cco Content','active'),(344,'Cco.Content.Create','Create Cco Content','active'),(345,'Cco.Content.Edit','Edit Cco Content','active'),(346,'Cco.Content.Delete','Delete Cco Content','active'),(347,'Permissions.CCO Admin.Manage','To manage the access control permissions for the CCO Admin role.','active'),(348,'Permissions.CCO.Manage','To manage the access control permissions for the CCO role.','active');

/*Table structure for table `bf_questions_master` */

CREATE TABLE `bf_questions_master` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text,
  `answer` varchar(255) DEFAULT NULL,
  `question_type` enum('text','radio','checkbox','image') DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `imagelocation` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_questions_master` */

/*Table structure for table `bf_questions_options` */

CREATE TABLE `bf_questions_options` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) DEFAULT NULL,
  `optionorder` int(11) DEFAULT NULL,
  `option_data` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bf_questions_options` */

/*Table structure for table `bf_role_permissions` */

CREATE TABLE `bf_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_role_permissions` */

insert  into `bf_role_permissions`(`role_id`,`permission_id`) values (1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,22),(1,24),(1,25),(1,27),(1,28),(1,29),(1,30),(1,31),(1,32),(1,33),(1,34),(1,35),(1,36),(1,37),(1,38),(1,39),(1,40),(1,41),(1,42),(1,43),(1,44),(1,45),(1,46),(1,49),(1,50),(1,55),(1,56),(1,57),(1,58),(1,59),(1,60),(1,61),(1,62),(1,63),(1,64),(1,65),(1,66),(1,67),(1,68),(1,69),(1,70),(1,71),(1,72),(1,73),(1,74),(1,102),(1,103),(1,104),(1,105),(1,110),(1,111),(1,112),(1,113),(1,118),(1,119),(1,120),(1,121),(1,190),(1,279),(1,280),(1,282),(1,287),(1,288),(1,289),(1,290),(1,295),(1,296),(1,297),(1,298),(1,299),(1,300),(1,301),(1,302),(1,303),(1,304),(1,305),(1,306),(1,307),(1,308),(1,309),(1,310),(1,311),(1,312),(1,313),(1,314),(1,321),(1,329),(1,330),(1,331),(1,332),(1,333),(1,334),(1,335),(1,336),(1,337),(1,338),(1,339),(1,343),(1,344),(1,345),(1,346),(1,347),(1,348),(2,2),(2,3),(2,4),(2,5),(2,6),(2,7),(2,8),(2,9),(2,10),(2,11),(2,12),(2,13),(2,14),(2,15),(2,16),(2,17),(2,18),(2,19),(2,20),(2,21),(2,22),(2,24),(2,25),(2,27),(2,28),(2,29),(2,30),(2,31),(2,32),(2,33),(2,34),(2,35),(2,36),(2,37),(2,38),(2,39),(2,40),(2,41),(2,42),(2,43),(2,44),(2,45),(2,46),(2,49),(2,50),(2,55),(2,56),(2,57),(2,58),(2,59),(2,60),(2,61),(2,62),(2,63),(2,64),(2,65),(2,66),(2,67),(2,68),(2,69),(2,70),(2,71),(2,72),(2,73),(2,74),(2,102),(2,103),(2,104),(2,105),(2,110),(2,111),(2,112),(2,113),(2,118),(2,119),(2,120),(2,121),(2,190),(2,279),(2,280),(2,282),(2,287),(2,288),(2,289),(2,290),(2,295),(2,296),(2,297),(2,298),(2,299),(2,300),(2,301),(2,302),(2,303),(2,304),(2,305),(2,306),(2,307),(2,308),(2,309),(2,310),(2,311),(2,312),(2,313),(2,314),(2,315),(2,316),(2,317),(2,318),(2,319),(2,321),(2,329),(2,330),(2,331),(2,332),(2,333),(2,334),(2,335),(2,336),(2,340),(2,341),(2,342),(2,343),(2,344),(2,345),(2,346),(4,321),(4,329),(4,330),(4,331),(4,332),(6,2),(6,3),(6,4),(6,5),(6,6),(6,7),(6,8),(6,9),(6,10),(6,11),(6,12),(6,13),(6,49),(6,91),(6,280),(6,321),(6,329),(6,330),(6,331),(6,332),(6,333),(6,334),(6,335),(6,336),(7,321),(7,329),(7,330),(7,331),(7,332),(7,333),(7,334),(7,335),(7,336),(8,321),(8,329),(8,330),(8,331),(8,332),(9,321),(9,329),(9,330),(9,331),(9,332),(10,321),(10,329),(10,330),(10,331),(10,332),(11,321),(14,333),(14,334),(14,335),(14,336),(15,333),(15,334),(15,335),(15,336),(16,333),(16,334),(16,335),(16,336),(17,333),(17,334),(17,335),(17,336);

/*Table structure for table `bf_roles` */

CREATE TABLE `bf_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(60) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) NOT NULL DEFAULT '1',
  `login_destination` varchar(255) NOT NULL DEFAULT '/',
  `deleted` int(1) NOT NULL DEFAULT '0',
  `default_context` varchar(255) NOT NULL DEFAULT 'content',
  `access` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `bf_roles` */

insert  into `bf_roles`(`role_id`,`role_name`,`description`,`default`,`can_delete`,`login_destination`,`deleted`,`default_context`,`access`) values (1,'Administrator','Has full control over every aspect of the site.',0,0,'admin/dashboard',0,'dashboard',1),(2,'Editor','Can handle day-to-day management, but does not have full power.',0,1,'admin/dashboard',0,'dashboard',1),(4,'User','This is the default user with access to login.',1,0,'',0,'content',1),(6,'Developer','Developers typically are the only ones that can access the developer tools. Otherwise identical to Administrators, at least until the site is handed off.',0,1,'',0,'dashboard',1),(7,'Head Officer','Head Officer',0,1,'ishop',0,'dashboard',1),(8,'Field Officer','Field Officer',0,1,'ishop/order_place',0,'dashboard',1),(9,'Distributor','Distributor',0,1,'ishop/secondary_sales_details',0,'dashboard',1),(10,'Retailer','Retailer',0,1,'ishop/order_place',0,'dashboard',1),(11,'Farmer','Farmer',0,1,'',0,'dashboard',1),(15,'ASM','ASM',0,1,'',0,'dashboard',1),(16,'Sales Manager','Sales Manager',0,1,'',0,'dashboard',1),(17,'Field Technical','Field Technical',0,1,'',0,'dashboard',1),(18,'CCO Admin','',0,1,'',0,'dashboard',1),(19,'CCO','',0,1,'',0,'dashboard',1);

/*Table structure for table `bf_schema_version` */

CREATE TABLE `bf_schema_version` (
  `type` varchar(40) NOT NULL,
  `version` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_schema_version` */

insert  into `bf_schema_version`(`type`,`version`) values ('banner_',2),('category_applicable_master_',2),('category_national_master_',2),('category_regional_master_',2),('cco_',1),('core',41),('country_master_',1),('customer_type_regional_',2),('email_template_',2),('esp_',1),('facebook_',2),('ishop_',1),('menu_',2),('navigation_',2),('newsletter_',2),('pages_',2),('product_',2),('social_media_',2),('sport_',2),('testtestestsest_',2),('test_',2),('user_management_',1),('user_master_',1),('web_service_',1);

/*Table structure for table `bf_sessions` */

CREATE TABLE `bf_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_sessions` */

/*Table structure for table `bf_settings` */

CREATE TABLE `bf_settings` (
  `name` varchar(30) NOT NULL,
  `module` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_settings` */

insert  into `bf_settings`(`name`,`module`,`value`) values ('auth.allow_name_change','core','1'),('auth.allow_register','core','1'),('auth.allow_remember','core','1'),('auth.do_login_redirect','core','1'),('auth.login_type','core','email'),('auth.name_change_frequency','core','1'),('auth.name_change_limit','core','1'),('auth.password_force_mixed_case','core','0'),('auth.password_force_numbers','core','0'),('auth.password_force_symbols','core','0'),('auth.password_min_length','core','8'),('auth.password_show_labels','core','0'),('auth.remember_length','core','1209600'),('auth.user_activation_method','core','0'),('auth.use_extended_profile','core','0'),('auth.use_usernames','core','1'),('ext.country','core','US'),('ext.state','core','CA'),('ext.street_name','core','hello'),('form_save','core.ui','ctrl+s/⌘+s'),('goto_content','core.ui','alt+c'),('mailpath','email','/usr/sbin/sendmail'),('mailtype','email','text'),('meta.description','core',''),('meta.keyword','core',''),('password_iterations','users','8'),('protocol','email','smtp'),('sender_email','email','zohaan.malinga@gmail.com'),('site.languages','core','a:3:{i:0;s:7:\"english\";i:1;s:7:\"persian\";i:2;s:10:\"portuguese\";}'),('site.list_limit','core','25'),('site.show_front_profiler','core','0'),('site.show_profiler','core','0'),('site.status','core','1'),('site.system_email','core','admin@mybonfire.com'),('site.title','core','Reach Expansion'),('site_footerscript','core','rrrrrrrr'),('site_headerscript','core',''),('smtp_host','email','ssl://smtp.gmail.com'),('smtp_pass','email','zohan&*901'),('smtp_port','email','465'),('smtp_timeout','email','3000'),('smtp_user','email','zohaan.malinga@gmail.com'),('updates.bleeding_edge','core','0'),('updates.do_check','core','0');

/*Table structure for table `bf_social_media` */

CREATE TABLE `bf_social_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `bf_social_media` */

insert  into `bf_social_media`(`id`,`label`,`link`,`image`,`status`,`position`) values (1,'ff','ff','bg.gif',1,1);

/*Table structure for table `bf_states` */

CREATE TABLE `bf_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `abbrev` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

/*Data for the table `bf_states` */

insert  into `bf_states`(`id`,`name`,`abbrev`) values (1,'Alaska','AK'),(2,'Alabama','AL'),(3,'American Samoa','AS'),(4,'Arizona','AZ'),(5,'Arkansas','AR'),(6,'California','CA'),(7,'Colorado','CO'),(8,'Connecticut','CT'),(9,'Delaware','DE'),(10,'District of Columbia','DC'),(11,'Florida','FL'),(12,'Georgia','GA'),(13,'Guam','GU'),(14,'Hawaii','HI'),(15,'Idaho','ID'),(16,'Illinois','IL'),(17,'Indiana','IN'),(18,'Iowa','IA'),(19,'Kansas','KS'),(20,'Kentucky','KY'),(21,'Louisiana','LA'),(22,'Maine','ME'),(23,'Marshall Islands','MH'),(24,'Maryland','MD'),(25,'Massachusetts','MA'),(26,'Michigan','MI'),(27,'Minnesota','MN'),(28,'Mississippi','MS'),(29,'Missouri','MO'),(30,'Montana','MT'),(31,'Nebraska','NE'),(32,'Nevada','NV'),(33,'New Hampshire','NH'),(34,'New Jersey','NJ'),(35,'New Mexico','NM'),(36,'New York','NY'),(37,'North Carolina','NC'),(38,'North Dakota','ND'),(39,'Northern Mariana Islands','MP'),(40,'Ohio','OH'),(41,'Oklahoma','OK'),(42,'Oregon','OR'),(43,'Palau','PW'),(44,'Pennsylvania','PA'),(45,'Puerto Rico','PR'),(46,'Rhode Island','RI'),(47,'South Carolina','SC'),(48,'South Dakota','SD'),(49,'Tennessee','TN'),(50,'Texas','TX'),(51,'Utah','UT'),(52,'Vermont','VT'),(53,'Virgin Islands','VI'),(54,'Virginia','VA'),(55,'Washington','WA'),(56,'West Virginia','WV'),(57,'Wisconsin','WI'),(58,'Wyoming','WY'),(59,'Armed Forces Africa','AE'),(60,'Armed Forces Canada','AE'),(61,'Armed Forces Europe','AE'),(62,'Armed Forces Middle East','AE'),(63,'Armed Forces Pacific','AP');

/*Table structure for table `bf_user_cookies` */

CREATE TABLE `bf_user_cookies` (
  `user_id` bigint(20) unsigned NOT NULL,
  `token` varchar(128) NOT NULL,
  `created_on` datetime NOT NULL,
  KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_user_cookies` */

insert  into `bf_user_cookies`(`user_id`,`token`,`created_on`) values (45,'1lR5lGTseZufz3xqF4nZPThBKbBCOk62iFGMPH4LOyZG0UG6Ip0WZfCBl7J6wkCveDJX2l1Sk61mi3ZK0PE8kJhc34vnuO7jTfHH2mIJ9EPlvZewIMaO4k97MOrkSxX0','2016-07-16 09:01:56');

/*Table structure for table `bf_user_meta` */

CREATE TABLE `bf_user_meta` (
  `meta_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) NOT NULL DEFAULT '',
  `meta_value` text,
  PRIMARY KEY (`meta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `bf_user_meta` */

insert  into `bf_user_meta`(`meta_id`,`user_id`,`meta_key`,`meta_value`) values (1,2,'state',''),(2,2,'country','US'),(3,1,'state',''),(4,1,'country','US'),(5,45,'country','US');

/*Table structure for table `bf_users` */

CREATE TABLE `bf_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '4',
  `email` varchar(254) NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `password_hash` char(60) NOT NULL,
  `reset_hash` varchar(40) DEFAULT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_ip` varchar(45) NOT NULL DEFAULT '',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `reset_by` int(10) DEFAULT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_message` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT '',
  `display_name_changed` date DEFAULT NULL,
  `timezone` varchar(40) NOT NULL DEFAULT 'UM6',
  `language` varchar(20) NOT NULL DEFAULT 'english',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `activate_hash` varchar(40) NOT NULL DEFAULT '',
  `force_password_reset` tinyint(1) NOT NULL DEFAULT '0',
  `type` varchar(30) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `user_code` varchar(30) DEFAULT NULL,
  `bussiness_code` varchar(100) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

/*Data for the table `bf_users` */

insert  into `bf_users`(`id`,`role_id`,`email`,`username`,`password_hash`,`reset_hash`,`last_login`,`last_ip`,`created_on`,`deleted`,`reset_by`,`banned`,`ban_message`,`display_name`,`display_name_changed`,`timezone`,`language`,`active`,`activate_hash`,`force_password_reset`,`type`,`user_type_id`,`user_code`,`bussiness_code`,`country_id`,`color`) values (1,1,'webclues.superadmn@gmail.com','super admin','$2a$08$PeRoU8Q4RyX807hJobuGUeew2n0zaF1WF45mkB./ftbRlLPrnonKG',NULL,'2016-08-08 14:47:26','::1','2015-05-21 06:10:48',0,1449907049,0,NULL,'Super Admin',NULL,'UM6','english',1,'',0,NULL,NULL,NULL,NULL,NULL,NULL),(2,2,'webclues.admn@gmail.com','Admin','$2a$08$PeRoU8Q4RyX807hJobuGUeew2n0zaF1WF45mkB./ftbRlLPrnonKG',NULL,'2016-08-03 16:02:44','::1','2015-05-29 11:24:49',0,NULL,0,NULL,'Admin',NULL,'UM6','english',1,'',0,NULL,NULL,NULL,NULL,101,NULL),(3,4,'sachin.dholu@webcluesglobal.com','sachin','$2a$08$PeRoU8Q4RyX807hJobuGUeew2n0zaF1WF45mkB./ftbRlLPrnonKG',NULL,'0000-00-00 00:00:00','','2016-05-09 00:00:00',0,NULL,0,NULL,'sachin',NULL,'UM6','english',1,'',0,NULL,NULL,NULL,NULL,101,NULL),(4,11,'abc1@gmail.com','abc1','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','2016-05-26 13:16:40','::1','0000-00-00 00:00:00',0,0,0,'','abc1','0000-00-00','','',1,'',0,'Customer',1,'000001',NULL,101,NULL),(5,11,'abc2@gmail.com','abc2','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc2','0000-00-00','','',1,'',0,'Customer',1,'000002',NULL,101,NULL),(6,11,'abc3@gmail.com','abc3','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc3','0000-00-00','','',1,'',0,'Customer',1,'000003',NULL,101,NULL),(7,11,'abc4@gmail.com','abc4','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc4','0000-00-00','','',1,'',0,'Customer',1,'000004',NULL,101,NULL),(8,11,'abc5@gmail.com','abc5','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc5','0000-00-00','','',1,'',0,'Customer',1,'000005',NULL,101,NULL),(9,9,'abc6@gmail.com','abc6','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','2016-08-22 12:21:38','::1','0000-00-00 00:00:00',0,0,0,'','abc6','0000-00-00','','',1,'',0,'Customer',3,'0000014',NULL,101,NULL),(10,9,'abc7@gmail.com','abc7','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','2016-08-04 19:27:13','::1','0000-00-00 00:00:00',0,0,0,'','abc7','0000-00-00','','',1,'',0,'Customer',3,'0000024',NULL,101,NULL),(11,9,'abc8@gmail.com','abc8','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','2016-06-21 09:47:21','::1','0000-00-00 00:00:00',0,0,0,'','abc8','0000-00-00','','',1,'',0,'Customer',3,'0000034',NULL,101,NULL),(12,9,'abc9@gmail.com','abc9','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','2016-06-15 15:38:00','::1','0000-00-00 00:00:00',0,0,0,'','abc9','0000-00-00','','',1,'',0,'Customer',3,'0000044',NULL,101,NULL),(13,9,'abc10@gmail.com','abc10','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc10','0000-00-00','','',1,'',0,'Customer',3,'0000055',NULL,101,NULL),(14,10,'abc11@gmail.com','abc11','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','2016-08-13 22:42:02','::1','0000-00-00 00:00:00',0,0,0,'','abc11','0000-00-00','','',1,'',0,'Customer',2,'0000064',NULL,101,NULL),(15,10,'abc12@gmail.com','abc12','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','2016-07-27 16:47:40','::1','0000-00-00 00:00:00',0,0,0,'','abc12','0000-00-00','','',1,'',0,'Customer',2,'0000074',NULL,101,NULL),(16,10,'abc13@gmail.com','abc13','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','2016-08-05 11:32:22','::1','0000-00-00 00:00:00',0,0,0,'','abc13','0000-00-00','','',1,'',0,'Customer',2,'0000076',NULL,101,NULL),(17,10,'abc14@gmail.com','abc14','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','2016-06-03 14:48:17','::1','0000-00-00 00:00:00',0,0,0,'','abc14','0000-00-00','','',1,'',0,'Customer',2,'0000036',NULL,101,NULL),(18,10,'abc15@gmail.com','abc15','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','2016-05-20 12:13:30','::1','0000-00-00 00:00:00',0,0,0,'','abc15','0000-00-00','','',1,'',0,'Customer',2,'000004',NULL,101,NULL),(19,10,'abc16@gmail.com','abc16','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','2016-08-03 09:28:10','::1','0000-00-00 00:00:00',0,0,0,'','abc16','0000-00-00','','',1,'',0,'Customer',2,'000005',NULL,101,NULL),(20,8,'abc17@gmail.com','abc17','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','2016-08-23 11:52:49','::1','0000-00-00 00:00:00',0,0,0,'','abc17','0000-00-00','','',1,'',0,'Employee',3,'000001',NULL,101,NULL),(21,8,'abc18@gmail.com','abc18','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','2016-07-27 05:56:31','::1','0000-00-00 00:00:00',0,0,0,'','abc18','0000-00-00','','',1,'',0,'Employee',3,'000002',NULL,101,NULL),(22,8,'abc19@gmail.com','abc19','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc19','0000-00-00','','',1,'',0,'Employee',3,'000003',NULL,101,NULL),(23,8,'abc20@gmail.com','abc20','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','2016-05-23 07:49:14','::1','0000-00-00 00:00:00',0,0,0,'','abc20','0000-00-00','','',1,'',0,'Employee',3,'000004',NULL,101,NULL),(24,8,'abc21@gmail.com','abc21','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc21','0000-00-00','','',1,'',0,'Employee',3,'000005',NULL,101,NULL),(25,11,'abc22@gmail.com','abc22','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc22','0000-00-00','','',1,'',0,'Customer',1,'000001',NULL,101,NULL),(26,11,'abc23@gmail.com','abc23','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc23','0000-00-00','','',1,'',0,'Customer',1,'000002',NULL,101,NULL),(27,11,'abc24@gmail.com','abc24','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc24','0000-00-00','','',1,'',0,'Customer',1,'000003',NULL,101,NULL),(28,11,'abc25@gmail.com','abc25','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc25','0000-00-00','','',1,'',0,'Customer',1,'000004',NULL,101,NULL),(29,11,'abc26@gmail.com','abc26','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc26','0000-00-00','','',1,'',0,'Customer',1,'000005',NULL,101,NULL),(30,10,'abc27@gmail.com','abc27','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc27','0000-00-00','','',1,'',0,'Customer',2,'000001',NULL,101,NULL),(31,10,'abc28@gmail.com','abc28','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc28','0000-00-00','','',1,'',0,'Customer',2,'000002',NULL,101,NULL),(32,10,'abc29@gmail.com','abc29','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc29','0000-00-00','','',1,'',0,'Customer',2,'000003',NULL,101,NULL),(33,10,'abc30@gmail.com','abc30','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc30','0000-00-00','','',1,'',0,'Customer',2,'000004',NULL,101,NULL),(34,10,'abc31@gmail.com','abc31','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc31','0000-00-00','','',1,'',0,'Customer',2,'000005',NULL,101,NULL),(35,9,'abc32@gmail.com','abc32','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc32','0000-00-00','','',1,'',0,'Customer',3,'000001',NULL,101,NULL),(36,9,'abc33@gmail.com','abc33','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','2016-08-02 06:46:23','::1','0000-00-00 00:00:00',0,0,0,'','abc33','0000-00-00','','',1,'',0,'Customer',3,'000002',NULL,101,NULL),(37,9,'abc34@gmail.com','abc34','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc34','0000-00-00','','',1,'',0,'Customer',3,'000003',NULL,101,NULL),(38,9,'abc35@gmail.com','abc35','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc35','0000-00-00','','',1,'',0,'Customer',3,'000004',NULL,101,NULL),(39,9,'abc36@gmail.com','abc36','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc36','0000-00-00','','',1,'',0,'Customer',3,'000005',NULL,101,NULL),(40,8,'abc37@gmail.com','abc37','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc37','0000-00-00','','',1,'',0,'Employee',3,'000001',NULL,101,NULL),(41,8,'abc38@gmail.com','abc38','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc38','0000-00-00','','',1,'',0,'Employee',3,'000002',NULL,101,NULL),(42,8,'abc39@gmail.com','abc39','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc39','0000-00-00','','',1,'',0,'Employee',3,'000003',NULL,101,NULL),(43,8,'abc40@gmail.com','abc40','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc40','0000-00-00','','',1,'',0,'Employee',3,'000004',NULL,101,NULL),(44,8,'abc41@gmail.com','abc41','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','abc41','0000-00-00','','',1,'',0,'Employee',3,'000005',NULL,101,NULL),(45,7,'ho@gmail.com','hoindia','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm',NULL,'2016-08-23 11:56:46','::1','2016-05-15 08:52:57',0,NULL,0,NULL,'HO India',NULL,'UM6','english',1,'',0,'Employee',2,'000006',NULL,101,NULL),(46,8,'sandeep@gmail.com','sanddeepASM','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','2016-08-13 17:11:33','::1','0000-00-00 00:00:00',0,0,0,'','sanddeepASM','0000-00-00','','',1,'',0,'Employee',3,'00420','QWERT111',101,NULL),(47,8,'bharat@gmail.com','BharatSM','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','2016-08-16 15:34:29','::1','0000-00-00 00:00:00',0,0,0,'','BharatSM','0000-00-00','','',1,'',0,'Employee',3,'004245','QWERT222',101,NULL),(48,8,'vishal@gmail.com','VishalFT','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','2016-08-09 12:58:34','::1','0000-00-00 00:00:00',0,0,0,'','VishalFT','0000-00-00','','',1,'',0,'Employee',3,'004278','QWERT333',101,NULL),(49,17,'aaa@gmail.com','aaaFT','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','aaaFT','0000-00-00','','',1,'',0,'Employee',3,'004278','QWERT555',101,NULL),(50,17,'bbb@gmail.com','bbbFT','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','bbbFT','0000-00-00','','',1,'',0,'Employee',3,'004278','QWERT777',101,NULL),(51,17,'ccc@gmail.com','cccFT','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','cccFT','0000-00-00','','',1,'',0,'Employee',3,'004278','QWERT7767',101,NULL),(52,17,'ddd@gmail.com','dddFT','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','dddFT','0000-00-00','','',1,'',0,'Employee',3,'004278','tyyt767',101,NULL),(53,17,'eee@gmail.com','eeeFT','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','eeeFT','0000-00-00','','',1,'',0,'Employee',3,'78788','tycyh67',101,NULL),(54,17,'opop@gmail.com','opopoFT','$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,0,0,'','opopFT','0000-00-00','','',1,'',0,'Employee',3,'78778988','uiuib7898',101,NULL),(55,18,'ccoadmin@gmail.com','ccoadmin','$2a$08$SgWgwjmnFV1HwJieIUNFjOYeRBw4QRDYGrmNHtWc1azgQ.keCEN9y',NULL,'2016-08-23 11:11:30','::1','2016-08-08 14:54:00',0,NULL,0,NULL,'CCO Admin 1',NULL,'UM6','english',1,'',0,NULL,NULL,NULL,NULL,101,NULL),(56,19,'cco1@gmail.com','cco 1','$2a$08$VaYtXRjtu6bZ8Sz30mrmAunNXqCoVvXTcVWqyFEoU0lMAESnrQznC',NULL,'0000-00-00 00:00:00','','2016-08-08 14:55:08',0,NULL,0,NULL,'CCO 1',NULL,'UM6','english',1,'',0,NULL,NULL,NULL,NULL,101,NULL),(57,19,'cco2@gmail.com','cco 2','$2a$08$VaYtXRjtu6bZ8Sz30mrmAunNXqCoVvXTcVWqyFEoU0lMAESnrQznC',NULL,'0000-00-00 00:00:00','','2016-08-08 14:55:08',0,NULL,0,NULL,'CCO 2',NULL,'UM6','english',1,'',0,NULL,NULL,NULL,NULL,101,NULL),(58,19,'cco3@gmail.com','cco 3','$2a$08$VaYtXRjtu6bZ8Sz30mrmAunNXqCoVvXTcVWqyFEoU0lMAESnrQznC',NULL,'0000-00-00 00:00:00','','2016-08-08 14:55:08',0,NULL,0,NULL,'CCO 3',NULL,'UM6','english',1,'',0,NULL,NULL,NULL,NULL,101,NULL),(59,19,'cco4@gmail.com','cco 4','$2a$08$VaYtXRjtu6bZ8Sz30mrmAunNXqCoVvXTcVWqyFEoU0lMAESnrQznC',NULL,'0000-00-00 00:00:00','','2016-08-08 14:55:08',0,NULL,0,NULL,'CCO 4',NULL,'UM6','english',1,'',0,NULL,NULL,NULL,NULL,101,NULL),(60,19,'cco5@gmail.com','cco 5','$2a$08$VaYtXRjtu6bZ8Sz30mrmAunNXqCoVvXTcVWqyFEoU0lMAESnrQznC',NULL,'0000-00-00 00:00:00','','2016-08-08 14:55:08',0,NULL,0,NULL,'CCO 5',NULL,'UM6','english',1,'',0,NULL,NULL,NULL,NULL,101,NULL),(61,19,'cco6@gmail.com','cco 6','$2a$08$VaYtXRjtu6bZ8Sz30mrmAunNXqCoVvXTcVWqyFEoU0lMAESnrQznC',NULL,'0000-00-00 00:00:00','','2016-08-08 14:55:08',0,NULL,0,NULL,'CCO 6',NULL,'UM6','english',1,'',0,NULL,NULL,NULL,NULL,102,NULL);

/* Function  structure for function  `getLocalDate` */

DELIMITER $$

/*!50003 CREATE DEFINER=`sqlyog`@`%` FUNCTION `getLocalDate`(dbDate date, dateformat varchar(255), datedelem VARCHAR(5)) RETURNS varchar(255) CHARSET latin1
    DETERMINISTIC
BEGIN
    DECLARE convDate varchar(255);
    
    DECLARE splitYear VARCHAR(255);
    DECLARE splitMonth VARCHAR(255);
    DECLARE splitDate VARCHAR(255);
    
    DECLARE conv_one VARCHAR(255);
    DECLARE conv_two VARCHAR(255);
    DECLARE conv_three VARCHAR(255);    
    
    SET splitYear = SPLIT_STR(dbDate,'-',1);
    SET splitMonth = SPLIT_STR(dbDate,'-',2);
    SET splitDate = SPLIT_STR(dbDate,'-',3);
    
    SET conv_one = SPLIT_STR(dateformat,datedelem,1);
    SET conv_two = SPLIT_STR(dateformat,datedelem,2);
    SET conv_three = SPLIT_STR(dateformat,datedelem,3);
    
    if conv_one='d' AND conv_two='m' AND conv_three='y'  THEN
	SET convDate = CONCAT_WS(datedelem,splitDate,splitMonth,splitYear);
    ELSEIF conv_one='d' AND conv_two='y' AND conv_three='m'  THEN
	SET convDate = CONCAT_WS(datedelem,splitDate,splitYear,splitMonth);
    ELSEIF conv_one='m' AND conv_two='d' AND conv_three='y'  THEN
	SET convDate = CONCAT_WS(datedelem,splitMonth,splitDate,splitYear);
    ELSEIF conv_one='m' AND conv_two='y' AND conv_three='d'  THEN
	SET convDate = CONCAT_WS(datedelem,splitMonth,splitYear,splitDate);
    ELSEIF conv_one='y' AND conv_two='d' AND conv_three='m'  THEN
	SET convDate = CONCAT_WS(datedelem,splitYear,splitDate,splitMonth);    
    ELSE
	SET convDate = CONCAT_WS(datedelem,splitYear,splitMonth,splitDate);
    END IF;
     
 RETURN convDate;
END */$$
DELIMITER ;

/* Function  structure for function  `SPLIT_STR` */

DELIMITER $$

/*!50003 CREATE DEFINER=`sqlyog`@`%` FUNCTION `SPLIT_STR`( dbDate VARCHAR(255), delim VARCHAR(12), pos INT) RETURNS varchar(255) CHARSET latin1
RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(dbDate, delim, pos),
       LENGTH(SUBSTRING_INDEX(dbDate, delim, pos -1)) + 1),
       delim, '') */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
