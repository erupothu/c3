-- MySQL dump 10.13  Distrib 5.5.19, for Linux (i686)
--
-- Host: localhost    Database: highclare
-- ------------------------------------------------------
-- Server version	5.5.19

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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `address_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `address_user_id` mediumint(8) unsigned NOT NULL,
  `address_label` varchar(64) DEFAULT NULL,
  `address_name` varchar(64) NOT NULL,
  `address_line1` varchar(64) NOT NULL,
  `address_line2` varchar(64) DEFAULT NULL,
  `address_city` varchar(64) NOT NULL,
  `address_state` varchar(64) NOT NULL,
  `address_postcode` varchar(12) NOT NULL,
  `address_country` char(2) NOT NULL,
  `address_date_created` datetime NOT NULL,
  `address_date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`address_id`),
  KEY `address_user_id` (`address_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calendar`
--

DROP TABLE IF EXISTS `calendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendar` (
  `calendar_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `calendar_name` varchar(32) NOT NULL,
  `calendar_date_created` datetime NOT NULL,
  PRIMARY KEY (`calendar_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendar`
--

LOCK TABLES `calendar` WRITE;
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
INSERT INTO `calendar` VALUES (1,'School Events','2012-03-06 14:25:40');
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calendar_event`
--

DROP TABLE IF EXISTS `calendar_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendar_event` (
  `event_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `event_calendar_id` mediumint(8) unsigned NOT NULL,
  `event_name` varchar(32) NOT NULL,
  `event_description` text,
  `event_date` date NOT NULL,
  `event_date_created` datetime NOT NULL,
  `event_date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`event_id`),
  KEY `event_calendar_id` (`event_calendar_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendar_event`
--

LOCK TABLES `calendar_event` WRITE;
/*!40000 ALTER TABLE `calendar_event` DISABLE KEYS */;
INSERT INTO `calendar_event` VALUES (1,1,'Sixth Form Scholarship Exam','Test','2012-01-20','2012-03-06 15:11:46','2012-03-21 13:10:11'),(2,1,'Senior School Taster Day',NULL,'2012-01-13','2012-03-06 15:13:46',NULL),(3,1,'Seniors 11+ Assessment',NULL,'2012-01-23','2012-03-06 15:13:46',NULL),(4,1,'School Open Day','','2012-03-03','2012-03-06 15:13:46','2012-03-21 13:12:27'),(5,1,'School Open Day',NULL,'2012-03-10','2012-03-06 15:13:46',NULL),(9,1,'Whatever event','Today!','2012-03-22','2012-03-21 14:11:04','2012-03-21 14:19:16'),(12,1,'Another Open\'s Day!','<strong>31st March</strong> is awesome.','2012-03-31','2012-03-21 14:47:59',NULL);
/*!40000 ALTER TABLE `calendar_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `group_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(64) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image` (
  `image_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `image_parent_id` mediumint(8) unsigned DEFAULT NULL,
  `image_name` varchar(128) NOT NULL,
  `image_path` varchar(128) NOT NULL,
  `image_alt` varchar(128) DEFAULT NULL,
  `image_width` smallint(5) unsigned NOT NULL,
  `image_height` smallint(5) unsigned NOT NULL,
  `image_size` double(8,2) DEFAULT NULL,
  `image_type` enum('ORIGINAL','THUMBNAIL') NOT NULL DEFAULT 'ORIGINAL',
  `image_date_created` datetime NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES (1,NULL,'abbey.jpg','/uploads/abbey.jpg',NULL,1022,684,218.05,'ORIGINAL','2012-03-20 14:39:30'),(2,1,'abbey.thumbnail.jpg','/uploads/abbey.thumbnail.jpg','The Abbey',300,201,20.77,'THUMBNAIL','2012-03-20 14:39:33'),(3,NULL,'cookery+08+best.jpg','/uploads/cookery+08+best.jpg',NULL,912,684,1853.26,'ORIGINAL','2012-03-20 16:09:11'),(4,3,'cookery+08+best.thumbnail.jpg','/uploads/cookery+08+best.thumbnail.jpg',NULL,300,225,161.79,'THUMBNAIL','2012-03-20 16:09:26'),(5,NULL,'100_3291_rt8.jpg','/uploads/100_3291_rt8.jpg',NULL,1024,681,702.66,'ORIGINAL','2012-03-20 17:16:47'),(6,5,'100_3291_rt8.thumbnail.jpg','/uploads/100_3291_rt8.thumbnail.jpg',NULL,300,200,83.99,'THUMBNAIL','2012-03-20 17:16:50'),(7,NULL,'boys.jpg','/uploads/boys.jpg',NULL,912,684,2151.73,'ORIGINAL','2012-03-20 17:16:59'),(8,7,'boys.thumbnail.jpg','/uploads/boys.thumbnail.jpg',NULL,300,225,189.33,'THUMBNAIL','2012-03-20 17:17:02'),(18,17,'abbey.thumbnail.jpg','/uploads/abbey.thumbnail.jpg',NULL,300,201,20.77,'THUMBNAIL','2012-03-21 13:11:04'),(10,9,'100_0158_rt8.thumbnail.jpg','/uploads/100_0158_rt8.thumbnail.jpg',NULL,300,225,100.71,'THUMBNAIL','2012-03-20 17:21:41'),(17,NULL,'abbey.jpg','/uploads/abbey.jpg',NULL,1022,684,218.05,'ORIGINAL','2012-03-21 13:11:01'),(12,11,'poss+junior+photo+2.thumbnail.jpg','/uploads/poss+junior+photo+2.thumbnail.jpg',NULL,300,225,19.37,'THUMBNAIL','2012-03-20 17:22:20'),(13,NULL,'abbey.jpg','/uploads/abbey.jpg',NULL,1022,684,218.05,'ORIGINAL','2012-03-20 17:23:08'),(14,13,'abbey.thumbnail.jpg','/uploads/abbey.thumbnail.jpg',NULL,300,201,20.77,'THUMBNAIL','2012-03-20 17:23:11'),(15,NULL,'cathedral-ghosts-roof-dark.jpg','/uploads/cathedral-ghosts-roof-dark.jpg',NULL,800,600,229.88,'ORIGINAL','2012-03-20 17:23:26'),(16,15,'cathedral-ghosts-roof-dark.thumbnail.jpg','/uploads/cathedral-ghosts-roof-dark.thumbnail.jpg',NULL,300,225,29.27,'THUMBNAIL','2012-03-20 17:23:28');
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image_gallery`
--

DROP TABLE IF EXISTS `image_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image_gallery` (
  `gallery_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `gallery_name` varchar(128) NOT NULL,
  `gallery_slug` varchar(128) NOT NULL,
  `gallery_date_created` datetime NOT NULL,
  PRIMARY KEY (`gallery_id`),
  UNIQUE KEY `gallery_slug` (`gallery_slug`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image_gallery`
--

LOCK TABLES `image_gallery` WRITE;
/*!40000 ALTER TABLE `image_gallery` DISABLE KEYS */;
INSERT INTO `image_gallery` VALUES (1,'General','general','2012-03-20 14:37:01'),(2,'Testerosa','testerosa','2012-03-21 17:27:42');
/*!40000 ALTER TABLE `image_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image_link`
--

DROP TABLE IF EXISTS `image_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image_link` (
  `link_image_id` mediumint(8) unsigned NOT NULL,
  `link_resource_id` mediumint(8) unsigned NOT NULL,
  `link_resource_type` varchar(16) NOT NULL,
  `link_position` smallint(5) unsigned NOT NULL,
  UNIQUE KEY `link_image_id` (`link_image_id`,`link_resource_id`,`link_resource_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image_link`
--

LOCK TABLES `image_link` WRITE;
/*!40000 ALTER TABLE `image_link` DISABLE KEYS */;
INSERT INTO `image_link` VALUES (1,1,'gallery',1),(3,1,'gallery',2),(9,1,'page',1),(11,1,'page',2),(0,59,'page',1),(0,60,'page',1),(0,61,'page',1),(0,62,'page',1),(0,63,'page',1),(0,64,'page',1),(0,65,'page',1),(0,66,'page',1),(0,67,'page',1),(0,68,'page',1),(0,69,'page',1),(0,70,'page',1),(0,71,'page',1);
/*!40000 ALTER TABLE `image_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `menu_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `menu_key` varchar(32) NOT NULL,
  `menu_name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  UNIQUE KEY `menu_key` (`menu_key`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'header','Header'),(2,'footer','Footer');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `news_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `news_author_id` smallint(5) unsigned NOT NULL,
  `news_title` varchar(256) NOT NULL,
  `news_slug` varchar(256) DEFAULT NULL,
  `news_data_excerpt` text,
  `news_data_full` text NOT NULL,
  `news_date_created` datetime NOT NULL,
  `news_date_updated` datetime DEFAULT NULL,
  `news_date_published` datetime NOT NULL,
  PRIMARY KEY (`news_id`),
  KEY `news_author_id` (`news_author_id`),
  FULLTEXT KEY `news_title` (`news_title`,`news_data_full`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,1,'Children in Need','children-in-need',NULL,'<p>\n	<strong>Abbey Seniors raise money for Children in Need</strong>\n</p>\n<p>\n	A fabulous fun day was had by all in the Senior School on Friday and we raised well over &pound;700 for Children in Need in the process.\n</p>\n<p>\n	Staff and pupils dressed up and there were many fun competitions based around the &lsquo;spotty&rsquo; theme. The winners of the spotty cake competition were:\n</p>\nSenior Section: Arali in U5S<br />\nMiddle Section: Hannah in U3R','2012-03-05 10:38:55','2012-03-22 16:00:08','2012-03-05 13:15:00'),(2,1,'Carol Singing in the Gracechurch Centre','carol-singing-in-the-gracechurch-centre',NULL,'We were very proud of our Senior School Choir and Chamber Choir who sung a selection of Christmas carols&nbsp; and entertained the public and some parents who came along to support us, at the Gracechurch Centre last Friday.\n<p>\n	We received some wonderful comments from passers-by, not only about their wonderful singing but about their smart appearance and impeccable behaviour.\n</p>\nWe are also proud to report they raised &pound;168.00 on behalf of our chosen charity, the Birmingham Children&rsquo;s Hospital.','2012-03-05 10:39:13','2012-03-21 16:12:40','2012-03-01 12:00:00');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news_category`
--

DROP TABLE IF EXISTS `news_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news_category` (
  `category_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(128) NOT NULL,
  `category_slug` varchar(128) NOT NULL,
  `category_date_created` datetime NOT NULL,
  `category_date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_slug` (`category_slug`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news_category`
--

LOCK TABLES `news_category` WRITE;
/*!40000 ALTER TABLE `news_category` DISABLE KEYS */;
INSERT INTO `news_category` VALUES (1,'General News','general','2012-03-22 10:39:48',NULL),(2,'Infants','infants','2012-03-22 10:39:48',NULL),(3,'Juniors','juniors','2012-03-22 16:03:58',NULL),(4,'Seniors','seniors','2012-03-22 16:03:58',NULL),(5,'Sixth Form','sixth-form','2012-03-22 16:04:16',NULL),(6,'PTA','pta','2012-03-22 16:04:16',NULL),(7,'TOPS','tops','2012-03-22 16:04:23',NULL);
/*!40000 ALTER TABLE `news_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news_link`
--

DROP TABLE IF EXISTS `news_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news_link` (
  `link_news_id` mediumint(8) unsigned NOT NULL,
  `link_category_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `link_news_id` (`link_news_id`,`link_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news_link`
--

LOCK TABLES `news_link` WRITE;
/*!40000 ALTER TABLE `news_link` DISABLE KEYS */;
INSERT INTO `news_link` VALUES (1,1);
/*!40000 ALTER TABLE `news_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `order_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `order_user_id` mediumint(8) unsigned NOT NULL,
  `order_delivery_name` varchar(128) DEFAULT NULL,
  `order_delivery_address1` varchar(128) DEFAULT NULL,
  `order_delivery_address2` varchar(128) DEFAULT NULL,
  `order_delivery_city` varchar(128) DEFAULT NULL,
  `order_delivery_state` varchar(64) DEFAULT NULL,
  `order_delivery_postcode` varchar(11) DEFAULT NULL,
  `order_delivery_country` char(2) DEFAULT NULL,
  `order_net` decimal(7,2) unsigned NOT NULL,
  `order_tax` decimal(7,2) unsigned NOT NULL,
  `order_total` decimal(7,2) unsigned NOT NULL,
  `order_shipping_code` varchar(18) DEFAULT NULL,
  `order_hash` char(32) NOT NULL,
  `order_status` enum('pending','processing') NOT NULL,
  `order_date_created` datetime NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `order_status` (`order_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_purchase`
--

DROP TABLE IF EXISTS `order_purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_purchase` (
  `purchase_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_order_id` mediumint(8) unsigned NOT NULL,
  `purchase_module` varchar(32) NOT NULL,
  `purchase_module_id` mediumint(8) unsigned NOT NULL,
  `purchase_name` varchar(128) NOT NULL,
  `purchase_quantity` mediumint(8) unsigned NOT NULL DEFAULT '1',
  `purchase_price` decimal(7,2) unsigned NOT NULL,
  `purchase_tax` decimal(7,2) unsigned NOT NULL,
  `purchase_total` decimal(7,2) unsigned NOT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `purchase_module_id` (`purchase_module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_purchase`
--

LOCK TABLES `order_purchase` WRITE;
/*!40000 ALTER TABLE `order_purchase` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_purchase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page` (
  `page_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `page_author_id` mediumint(8) unsigned NOT NULL,
  `page_name` varchar(128) NOT NULL,
  `page_slug` varchar(128) NOT NULL,
  `page_content` text,
  `page_status` enum('draft','published','deleted') NOT NULL,
  `page_left` mediumint(8) unsigned NOT NULL,
  `page_right` mediumint(8) unsigned NOT NULL,
  `page_date_created` datetime NOT NULL,
  `page_date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`page_id`),
  KEY `page_slug` (`page_slug`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (1,1,'Home','/','<h1>\n	Welcome to <strong>Highclare School</strong></h1>\n<p>\n	At Highclare School we are proud of our enviable reputation for academic and sports results. We have had a fantastic 100% pass rate at GCSE and A level again this year, please go to our results page for more details. Additionally the school has recently received a new <strong>Inspection Report</strong> from the Independent Schools Inspectorate and fully recommend this to you. Click <a href=\"#\">here</a> to view a copy.\n</p>\n<hr />\n<p>\n	For further information on Admissions &amp; Open Days click <a href=\"#\">here</a><br />\n	To check our most up to date Job Vacancies click <a href=\"#\">here</a>\n</p>\n<h2>\n	Meeting Individual Needs</h2>\n<p>\n	Highclare&#39;s standards and expectations are high, as demonstrated by our excellent and consistently achieved results. Click <a href=\"#\">here</a> to view our excellent results!\n</p>\nSmall teaching groups with supportive and experienced staff work closely with individual pupils providing extra help where necessary, ensuring that each child achieves the best of which he or she is capable.\n<p>\n	Our learning methods are varied to suit individual needs and we encourage participation in a wide range of extra curricular activity that will help to enrich our pupils lives and develop self-confidence.\n</p>\nDuring their time at Highclare School, pupils will realise their strengths and achieve high standards in their chosen fields.\n<p>\n	<strong>Highclare School<br />\n	Achieving individual excellence.</strong>\n</p>\n','published',1,2,'2012-02-29 17:15:58','2012-03-21 10:46:53'),(2,1,'Introduction','/introduction','<h1>\n	Welcome To Highclare School</h1>\n<p>\n	We appreciate the opportunity to help you take one of the most important decisions you have to make as a parent &ndash; choosing the right school for your son or daughter.\n</p>\n<p>\n	Highclare was founded in 1932 and has over the intervening years developed a reputation as a caring community, committed to individual excellence.\n</p>\nThe school is situated on three sites that all offer small class sizes, and share the basic Highclare ethos which emphasises personal self-discipline, responsibility and&nbsp;morality, combined with the highest possible standards of behaviour. Pupils learn to show consideration for others, and take a pride in themselves and their school.\n<p>\n	Highclare&#39;s expectations and standards are high, and this is demonstrated by the excellent results we consistently achieve at each Keystage, particularly 11+ entrance examinations, GCSE and A-level grades.\n</p>\nWe provide a stable and supportive learning environment, which allows each pupil to discover his or her talents, and then work on them. Teaching staff are highly qualified specialists, committed to developing every child.\n<p>\n	Highclare offers a wide range of extra curricular activities through which boys and girls can develop social, sporting, and cultural interests, that provide life long enjoyment.\n</p>\nDuring their time with us, your child will realise his or her strengths and achieve high standards in their chosen fields.\n<p>\n	We would be delighted to show you around the school. If you would like to arrange a visit or require further assistance please contact the school on 0121 373 7400.\n</p>\n','published',3,12,'2012-03-05 16:05:11','2012-03-20 14:34:10'),(3,1,'Meeting Individual Needs','/individual-needs','<p>\n	Highclare&#39;s standards and expectations are high, as demonstrated by our excellent and consistently achieved results. <a href=\"#\">Click here</a> to view our excellent results!\n</p>\n<p>\n	Small teaching groups with supportive and experienced staff work closely with individual pupils providing extra help where necessary, ensuring that each child achieves the best of which he or she is capable.\n</p>\n<p>\n	Our learning methods are varied to suit individual needs and we encourage participation in a wide range of extra curricular activity that will help to enrich our pupils lives and develop self-confidence.\n</p>\n<p>\n	During their time at Highclare School, pupils will realise their strengths and achieve high standards in their chosen fields.\n</p>\n<strong>Highclare School<br />\nAchieving individual excellence.</strong>','published',4,7,'2012-03-09 12:51:02',NULL),(4,1,'In Detail','/in-detail','<h3>\n	Academic</h3>\n<p>\n	Highclare offers small teaching groups with supportive, experienced staff who work closely with individual pupils and provide extra help where necessary. Class work is structured to enable each child to achieve at his or her own level within a well-balanced curriculum, which is available to every pupil.\n</p>\n<h3>\n	Welfare</h3>\n<p>\n	Highclare provides a continuous education for girls from 18 months to 18 years and boys from 18 months to 11 years. (From September 2011 we will welcome boys to Year 7 annually, giving continued education to boys and girls from 18 months to 18 years from 2015).&nbsp; We currently welcome boys into our Sixth Form. The Highclare service includes caring for your child, with extended day and holiday facilities (TOPS Scheme) from 7.30 am to 6.00 pm for 47 weeks per year.\n</p>\n<p>\n	The School Council listens to the needs and views of pupils, valuing the contribution of individuals.\n</p>\n<p>\n	Health care is carried out by the School Nurse who caters for the health needs of all pupils, carrying out regular reviews and immunization programmes.\n</p>\n<h3>\n	Pastoral</h3>\n<p>\n	Highclare operates a unique system in the Senior School with each pupil having their own personal tutor, who remains with them throughout their life at the school, arranging regular individual meetings and overseeing pastoral care.\n</p>\n<p>\n	Personal, Health and Social Education is included in the curriculum and gives pupils opportunities to explore ideas, or express views on a wide range of topics. Staff work with individual pupils to build self-confidence that then reflects in other areas of school life.\n</p>\n<h3>\n	Ethnic And Religious</h3>\n<p>\n	Highclare celebrates a range of religious festivals throughout the school and holds regular assemblies, which also provide opportunities to recognise individual achievements in sport, music, and other extra-curricular activities.<br />\n	There is a balanced Religious Education syllabus, including visits for pupils of all ages, giving them the opportunity to experience different religions and beliefs.\n</p>\n<h3>\n	Teaching</h3>\n<p>\n	Highclare provides high quality teaching and encourages independent learning. This is evident in the excellent exam results achieved by individuals at 11+, GCSE, and A-level.\n</p>\n<p>\n	To view latest external exam results <a href=\"#\">click here</a>.\n</p>\n<p>\n	Our dedicated, committed staff are all qualified in their subject specialities and support every pupil to achieve his or her own level of excellence.\n</p>\n<p>\n	At Junior and Senior levels, our style of education enables both boys and girls to thrive and develop into confident individuals. In this way, Highclare pupils are equipped for life-long learning from an early age. Highclare follows the latest OFSTED guidelines relating to birth to 5 years in the Early Years Foundation Stage.\n</p>\n<p>\n	Highclare is regularly inspected by the ISI (Independent Schools Inspectorate) which is the body approved by the Secretary of State for Education and Skills for the purpose of inspecting independent schools.\n</p>\n<p>\n	To view the latest report <a href=\"#\">click here</a>.\n</p>\n<h3>\n	Pupil Participation</h3>\n<p>\n	With its Personalised Learning Strategies Highclare ensures that learning methods are varied to suit the needs of individual pupils.\n</p>\n<p>\n	Pupils are encouraged to participate in a wide range of Enrichment activities outside the classroom, including:\n</p>\n<ul>\n	<li>Music</li>\n	<li>Drama</li>\n	<li>Sport</li>\n	<li>Clubs: Spanish, Reading, ICT, Ignite (RE), Debating</li>\n	<li>Activity Weekends</li>\n	<li>Foreign Language Exchanges</li>\n	<li>Foreign Holidays</li>\n	<li>Wide Variety of Trips and Visits</li>\n	<li>Visitors are regularly invited to run activities, such as drama workshops, career guidance, and music workshops.</li>\n</ul>\n<h3>\n	Individual Development</h3>\n<p>\n	All pupils are seen as individuals and are valued as such.\n</p>\n<p>\n	It is a key school aim to motivate each pupil to achieve his or her potential. This is true not only in the classroom, but beyond, and reinforced by the Highclare pastoral system.\n</p>\n<p>\n	Pupils in Year 8 are able to attend PGL weekends which include a variety of outdoor activities that build self-confidence and encourage teamwork. Younger pupils are given the opportunity in Year 6 to attend a similar residential weekend.\n</p>\n<p>\n	Sixth Form pupils are able to take part in Business Enterprise and Leadership skills based trips, which are often held at various outdoor centres and provide a range of activities and new experiences that develop the individual.\n</p>\n<p>\n	Leadership opportunities are given at all levels with Junior, Senior &amp; Sixth form pupils being given responsibilities as Prefects, Junior Prefects, House Captains, Form Captains and School Council representatives.\n</p>\n<p>\n	All pupils in Year 11 are required to undertake Work Experience for two weeks which is often their first taste of the working environment.\n</p>\n<p>\n	Within the Junior and Senior School, pupils provide a volunteer resource to a number of institutions in the local area, such as helping with reading in a special school and visiting residential homes and nursing homes. Charitable fund raising is also carried out on a regular basis and pupils are encouraged to be proactive in their organisation of these events.\n</p>\n<p>\n	We encourage pupils to take part in as wide a variety of extra-curricular activities as possible, knowing that such activities enrich their lives and develop self-confidence.\n</p>\n<h3>\n	Life Skills</h3>\n<p>\n	Highclare pupils are well equipped for life beyond school. The personal attention and encouragement they receive, in combination with the personal skills they acquire, produce confident and articulate individuals. They are good team players and well prepared for the challenges of adult life.\n</p>\n<p>\n	The school provides well-developed career guidance, including aptitude assessments, so that Senior pupils have a clear idea of their forward plan.\n</p>\n<h3>\n	School Standards And Expectations</h3>\n<p>\n	Highclare has high standards with respect to dress and personal grooming. Each child is expected to wear his or her uniform with pride and be a worthy ambassador for the school. Regular uniform checks are carried out to ensure that standards are maintained. The aim of the School is to show tolerance and consideration for others and this underpins the whole school philosophy and is clearly evident among the whole school community. Each individual is expected to show self-discipline and good behaviour is rewarded. Highclare pupils learn to respect others, work in teams, and celebrate the success of all individuals when they achieve their own excellence and this lays the roots for life long friendships.\n</p>\n','published',5,6,'2012-03-09 13:51:56',NULL),(5,1,'Governors & Staff','/governors-and-staff','<h2>\n	Governing Body</h2>\n<p>\n	body here\n</p>\n<h2>\n	School Leadership Team</h2>\n<p>\n	body here\n</p>\n<h3>\n	Senior Management Responsibilities</h3>\n<p>\n	body here\n</p>\n<h4>\n	Posts of Additional Responsibility</h4>\n<p>\n	body here\n</p>\n','published',8,9,'2012-03-09 14:14:40',NULL),(6,1,'Policies & Downloads','/policies','policies.','published',10,11,'2012-03-09 14:27:01','2012-03-16 16:26:21'),(7,1,'Administration','/administration','<h1>\n	Administration</h1>\n<p>\n	Highclare School is based on 3 separate sites. Whole school administration is carried out at Highclare The Abbey. Each site carries out day to day administration in its own location.\n</p>\n<p>\n	If you require further information, then please contact the relevant school office. Staff will do everything they can to deal with your enquiry as quickly as possible. Thank you for your patience.\n</p>\n<p>\n	All enquiries can be made to the main school site at:\n</p>\n<p>\n	<strong>Highclare The Abbey</strong><br />\n	10 Sutton Road<br />\n	Erdington<br />\n	Birmingham, B23 6QL.<br />\n	Tel: 0121 373 7400<br />\n	Fax: 0121 373 7445<br />\n	E mail: abbey@highclareschool.co.uk\n</p>\n<p>\n	If your enquiry is about admission to the school you should contact:\n</p>\n<p>\n	<strong>The Registrar</strong>, Admissions Office.<br />\n	Tel: 0121 386 8218<br />\n	E mail: admissions@highclareschool.co.uk\n</p>\n','published',13,30,'2012-03-09 14:34:52',NULL),(8,1,'School Offices','/school-offices','<h1>\n	School Offices</h1>\n<p>\n	If your enquiry is about admission to the school you should contact:\n</p>\n<p>\n	<strong>The Registrar, Admissions Office</strong><br />\n	<strong>Tel:</strong> 0121 386 8218<br />\n	<strong>Email:</strong> admissions@highclareschool.co.uk\n</p>\n<p>\n	Or the main school site at:\n</p>\n<p>\n	<strong>Highclare The Abbey</strong><br />\n	10 Sutton Road<br />\n	Erdington<br />\n	Birmingham, B23 6QL.<br />\n	<strong>Tel:</strong> 0121 373 7400<br />\n	<strong>Fax:</strong> 0121 373 7445<br />\n	<strong>Email:</strong> abbey@highclareschool.co.uk\n</p>\n<p>\n	General enquiries of a day to day nature can be directed to the relevant site:\n</p>\n<p>\n	<strong>Highclare Woodfield</strong><br />\n	241 Birmingham Road<br />\n	Wylde Green<br />\n	Sutton Coldfield, B72 1EA.<br />\n	<strong>Tel:</strong> 0121 355 0194<br />\n	<strong>Email:</strong> woodfield@highclareschool.co.uk\n</p>\n<p>\n	<strong>Highclare St Paul&#39;s</strong><br />\n	88 Lichfield Road<br />\n	Four Oaks, Sutton Coldfield. B74 2SY<br />\n	<strong>Tel:</strong> 0121 355 8205<br />\n	<strong>Email:</strong> stpauls@highclareschool.co.uk\n</p>\n<p>\n	<strong>Highclare Nursery</strong><br />\n	241 Birmingham Road<br />\n	Wylde Green<br />\n	Sutton Coldfield. B72 1EA.<br />\n	<strong>Tel:</strong> 0121 321 2456<br />\n	<strong>Email:</strong> nursery@highclareschool.co.uk\n</p>\n<p>\n	If your enquiry is regarding routine invoicing or accounting matters you should contact the Accounts Office directly:\n</p>\n<p>\n	<strong>Accounts Office</strong><br />\n	<strong>Tel:</strong> 0121 386 8212<br />\n	<strong>Email:</strong> accounts1@highclareschool.co.uk\n</p>\n<p>\n	Other departments, direct contact details:\n</p>\n<p>\n	<strong>Maintenance Department:</strong> 0121 386 8210<br />\n	<strong>School Kitchen:</strong> 0121 386 8211\n</p>\n','published',14,15,'2012-03-09 14:44:05',NULL),(9,1,'Transport','/transport','<h1>\n	Transport</h1>\n<p>\n	The School operates a fleet of mini buses covering the following areas.\n</p>\n<h2>\n	Aldridge</h2>\n<ul>\n	<li>The Green</li>\n	<li>The Irish Harp Pub</li>\n	<li>Streetly (Jervis Crescent)</li>\n	<li>Highclare School, St Paul&#39;s</li>\n	<li>Highclare School, Woodfield</li>\n	<li>Highclare School, The Abbey</li>\n</ul>\n<p>\n	If parents would like to discuss other routes or stops, they are welcome to contact the school Transport Manager at Highclare The Abbey.\n</p>\n<h2>\n	Lichfield</h2>\n<ul>\n	<li>Lichfield, Bowling Green Island</li>\n	<li>Lichfield City Station</li>\n	<li>Shenstone Railway Station</li>\n	<li>Hammerwich Lane</li>\n	<li>Stonnall</li>\n	<li>Hardwick Arms</li>\n	<li>Chester Road (Audi Garage)</li>\n	<li>Banners Gate</li>\n	<li>Jevons Road Halton Road Stonehouse Road</li>\n	<li>Highclare School (The Abbey site)</li>\n</ul>\n<h2>\n	Tamworth</h2>\n<ul>\n	<li>Dosthill</li>\n	<li>Fazeley</li>\n	<li>Drayton Bassett</li>\n	<li>Roughley</li>\n	<li>Mere Green</li>\n	<li>Four Oaks Station</li>\n	<li>Highclare School (St Paul&rsquo;s)</li>\n	<li>Sutton Town (The Litten Tree)</li>\n	<li>Highclare School (Woodfield)</li>\n	<li>Highclare School (The Abbey site)</li>\n</ul>\n<h2>\n	Coleshill</h2>\n<ul>\n	<li>Coleshill</li>\n	<li>Curdworth</li>\n	<li>Walmley</li>\n	<li>Highclare School (Woodfield)</li>\n	<li>Highclare School (The Abbey Site)</li>\n</ul>\n','published',16,17,'2012-03-09 14:46:03',NULL),(10,1,'Uniforms','/uniforms','<h1>\n	School Uniform</h1>\n<p>\n	Highclare has high standards with respect to dress and personal appearance. Each pupil is expected to wear his or her uniform with pride and be a worthy ambassador for the school. Regular uniform checks are carried out to ensure that standards are maintained.\n</p>\n<h2>\n	School Uniform List</h2>\n<p>\n	Please click below to download each list\n</p>\n<ul>\n	<li>Kindergarten ~ Transition (Pre School)</li>\n	<li>Reception ~ J2 Boys</li>\n	<li>Reception ~ J2 Girls</li>\n	<li>Junior Boys</li>\n	<li>Junior Girls</li>\n	<li>Senior Boys</li>\n	<li>Senior Girls</li>\n	<li>Sixth Form Dress Code</li>\n</ul>\n<h2>\n	Highclare School Uniform Is Supplied Jointly By:</h2>\n<p>\n	Schoolwear Solutions (On-site School Shop)<br />\n	Clive Mark Schoolwear\n</p>\n<h3>\n	News From Our Suppliers</h3>\n<p>\n</p>\n<p>\n	On line shopping for Highclare is now available from both Clive Mark Ltd and Schoolwear Solutions and their respective links are above.\n</p>\n<p>\n	Full uniform lists for each age group are available from the school offices or from the parents&rsquo; information folder.\n</p>\n<p>\n</p>\n<h3>\n	Second Hand Uniform</h3>\nHighclare School PTA organise monthly sales of good quality second hand uniform. These are held at Highclare The Abbey, Junior Dept at 10 Sutton Road, Erdington, and aim to assist all parents whilst at the same time helping the fund raising activities of the PTA.\n<p>\n	Dates for these openings are displayed on the &#39; Messages and PTA&#39; page within the parents&#39; section of this web site.\n</p>\n<p>\n</p>\n','published',18,19,'2012-03-09 15:14:43',NULL),(11,1,'School Calendar','/school-calendar','<h1>\n	School Term Dates</h1>\n<h3>\n	Autumn Term 2011</h3>\n<p>\n	Monday 5th September&nbsp; -&nbsp;&nbsp; Autumn Term commences<br />\n	Monday 24th October - Friday 28th October&nbsp;&nbsp; -&nbsp; Half Term<br />\n	Friday 16th December at 12 noon&nbsp; -&nbsp; Break up\n</p>\n<h3>\n	Spring Term 2012</h3>\n<p>\n	Monday 9th January&nbsp; -&nbsp; Spring Term commences<br />\n	Monday 13th February to Friday 17th February&nbsp; -&nbsp; Half term<br />\n	Friday 30th March at 12 noon&nbsp; -&nbsp; Break up\n</p>\n<h3>\n	Summer Term 2012</h3>\n<p>\n	Wednesday 18th April&nbsp; -&nbsp; Summer Term commences<br />\n	(May Day Bank Holiday - Monday 7th May - school closed)<br />\n	Monday 4th June - Friday 8th June&nbsp; -&nbsp; Half Term<br />\n	Friday 6th July at 12 noon - Break up\n</p>\n<p>\n	***********************************************\n</p>\n<h3>\n	Autumn Term 2012</h3>\n<p>\n	Wednesday 5th September - Autumn Term begins<br />\n	Monday 22nd October to Friday 26th October - Half Term<br />\n	Wednesday 19th December at 12 noon - Break up\n</p>\n<h3>\n	Spring Term 2013</h3>\n<p>\n	Tuesday 8th January - Spring Term begins<br />\n	Monday 18th February to Friday 22nd February - Half Term<br />\n	Wednesday 27th March at 12 noon - Break up\n</p>\n<h3>\n	Summer Term 2013</h3>\n<p>\n	Wednesday 17th April - Summer Term begins<br />\n	(May Day - Monday 6 =th May - school closed)<br />\n	Monday 27th May to Friday 31 May - Half Term<br />\n	Wednesday 10th July at 12 noon - Break up\n</p>\n<h2>\n	Holidays in Term Time</h2>\n<p>\n	This is a matter of some concern for the School. The school holidays are extensive and published well in advance and it is, therefore expected that pupils are not withdrawn from the School at short notice during term time.\n</p>\n','published',20,21,'2012-03-09 15:17:57',NULL),(12,1,'Catering','/catering','<h1>\n	School Lunches</h1>\n<p>\n	The School lunches and catering services are provided by Wilson Vale.\n</p>\n<p>\n	Pupils on all three sites enjoy freshly cooked school lunches. Sample menus for school lunches are printed in the school newsletter regularly or can be viewed on this web site. An emphasis on healthy eating is of paramount importance to the school and all pupils are supervised in their choices to ensure they have a balanced meal. If you wish to sample a school lunch, please do not hesitate to contact the appropriate school office to arrange to do so.\n</p>\n<h2>\n	Sample Menus</h2>\n<p>\n	.\n</p>\n','published',22,23,'2012-03-09 15:20:12',NULL),(13,1,'Vacancies','/vacancies','<h1>\n	Vacancies</h1>\n<p>\n	Highclare School is committed to safeguarding and promoting the welfare of children and young people and expects all staff and volunteers to share this commitment. Applicants must be willing to undergo child protection screening appropriate to the post, including checks with past employers and the Criminal Records Bureau. Highclare School is an equal opportunities employer.\n</p>\n<p>\n	From time to time employment opportunities arise at the school. Application forms for all positions are available by contacting the HR Manager directly on 0121 373 7400 or e mailing hr@highclareschool.co.uk or downloading them from the panel opposite.\n</p>\n<p>\n	Successful applicants for all teaching posts are expected to be ICT literate and be prepared to contribute towards the school&#39;s enrichment programme.\n</p>\n<p>\n	We list below our current employment opportunities.\n</p>\n<p>\n	<iframe border=\"0\" frameborder=\"0\" height=\"700\" src=\"http://www.eteach.com/Hosted/IFrame/Jobs.aspx?EmpNo=29099\" title=\"Highclare\" width=\"100%\"></iframe>\n</p>\n','published',24,27,'2012-03-09 15:22:13',NULL),(14,1,'Downloads','/downloads','<h1>\n	Downloads</h1>\n','published',25,26,'2012-03-09 15:44:15',NULL),(15,1,'Snow & Bad Weather','/snow-and-bad-weather','<h1>\n	Snow / Bad Weather</h1>\n<p>\n	We would advise all parents and visitors&nbsp; that the school will always open, even in the event of snow.&nbsp; We have key holders and nominated staff on all sites who are able to get to the school in the event of bad weather.&nbsp;&nbsp; Naturally, we accept that parents will wish to make their own decision about whether to send their child into school on such days.&nbsp; However, please be assured that school will be open and work and supervision will be provided for your child.&nbsp;&nbsp;&nbsp; In the unlikely event that a decision is made to send pupils home early, the school will contact parents directly.&nbsp;\n</p>\n<p>\n	Therefore, in the interests of the safety of all concerned, we would ask that parents:\n</p>\n<ul>\n	<li>Please <strong>do not ring</strong> school to enquire if it is open on any day when the weather is bad.&nbsp; Latest information will be available on the website.</li>\n	<li>Please <strong>do contact school (email or telephone)</strong> to advise if your child will not be attending school</li>\n	<li>Please ask your daughter / son not to ring or text home without permission &ndash; school will always contact parents if there is a need.</li>\n</ul>\n','published',28,29,'2012-03-09 15:27:41',NULL),(16,1,'Admissions','/admissions','<h1>\n	Admissions</h1>\n','published',31,42,'2012-03-09 15:47:06',NULL),(17,1,'Fees','/fees','Fees','published',32,33,'2012-03-09 16:05:37',NULL),(18,1,'Scholarships','/scholarships','<h1>\n	Scholarships</h1>\n<p>\n	Scholarships are generally awarded to pupils when they enter the Senior Department at 11+ and further opportunities are given to pupils entering the Sixth Form.\n</p>\n<p>\n	Have a look at our latest GCSE and A Level results on the Results page.&nbsp; 100% pass at GCSE in 2011.\n</p>\n<h2>\n	Senior School ENTRY AND SCHOLARSHIPS</h2>\n<h3>\n	11+ Entry</h3>\n<p>\n	<strong>NOW ENROLLING SENIOR BOYS AND GIRLS FOR SEPTEMBER 2012</strong>\n</p>\n<p>\n	Scholarships will be awarded based on the entry 11+ Entry asessment day for all pupils applying for Year 7 for September 2012. &nbsp;Candidates should complete the 11+ Assessment Application form, downloadable on this page, or available by contacting the admissions office at admissions@highclareschool.co.uk&nbsp;&nbsp; or&nbsp; tel:&nbsp; 0121 386 8218.\n</p>\n<p>\n	Academic scholarships are awarded to pupils who perform particularly well in the 11+ Entrance Assessment and who demonstrate a considerable degree of all round commitment to the School.\n</p>\n<p>\n	Additional Scholarships will also be awarded to those pupils showing a particular talent in either Music, Sport or Art.&nbsp; Those applying for consideration in one of the specialist areas will also be expected to attend a short audition test on 23rd January 2012.\n</p>\n<p>\n	All Scholarships offered will be part fees and will be awarded at the discretion of the Head. The Scholarship will be awarded for the duration of a pupil&#39;s education within the senior school and will be reviewed annually.\n</p>\n<p>\n	Those awarded a specialist scholarship will be expected to play a full part in the life of that department within the school.\n</p>\n<h3>\n	Specialist Scholarships Criteria</h3>\n<ol>\n	<li><strong>Music</strong>\n		<ul>\n			<li>A competence to Examination Grade 3 is desirable, although all examination results will be considered.</li>\n			<li>An audition on at least one Instrument will be required and will take place in school after the academic assessment.</li>\n			<li>At the audition, candidates must bring with them one suitable performance piece and will be expected to do sight reading and aural tests.</li>\n			<li>Any orchestral instrument, keyboard or voice may be offered.</li>\n		</ul>\n	</li>\n	<li><strong>Art</strong>\n		<ul>\n			<li>​Candidates will be asked to complete a timed observational drawing exercise following the academic assessment and asked to take part in a group discussion, critically analysing a painting supplied by the art department on the day.</li>\n			<li>Candidates will not need to bring any equipment with them as all materials for the observational exercise will be supplied by the school.</li>\n			<li>Candidates are asked to bring with them one further piece of work completed outside school.</li>\n		</ul>\n	</li>\n	<li><strong>Sport</strong>\n		<ul>\n			<li><strong>​</strong>Candidates will be asked to take part in a short practical session in the Gymnasium under the guidance of the Head of P.E.&nbsp; Assessment will be made relating to agility, hand to eye co-ordination and general fitness. Consideration will also be given to specialist skills.</li>\n			<li>Candidates taking part will need to come suitably dressed.</li>\n		</ul>\n	</li>\n</ol>\n<h2>\n	Sixth Form Scholarships</h2>\n<p>\n	The Scholarship exam for Sixth Form entry in September 2012 will take place on Monday 9th January 2012. Please contact the school for more details.\n</p>\n<p>\n	Scholarships may be awarded to students entering the Sixth Form in a number of categories, including Academic, Music &amp; Art.\n</p>\n<p>\n	Candidates may apply in one of the following areas:\n</p>\n<p>\n	<strong>Academic Scholarship</strong> - to those generally showing high academic potential\n</p>\n<p>\n	<strong>Service to the School (Awarded to existing pupils only)</strong> - an award made based on the pupils commitment to the school in any other area other than academic.\n</p>\n<p>\n	Candidates may also be considered for a Scholarship in one of the following specialist categories\n</p>\n<p>\n	<strong>Music and Art</strong>. They will be expected to be taking this subject into the A level studies and show a high degree of competence and commitment already.\n</p>\n<p>\n	Please ask the admissions office (0121 386 8218) for further details or download a Sixth Form Scholarship Application form here.\n</p>\n','published',34,35,'2012-03-09 16:05:52','2012-03-09 16:16:55'),(19,1,'Prospectus Download','/prospectus','<h1>\n	Prospectus</h1>\n<p>\n	<a href=\"/uploads/prospectus/senior\">Senior Prospectus</a>\n</p>\n','published',36,37,'2012-03-09 16:43:35','2012-03-15 15:13:30'),(20,1,'Open Days','/open-days','<h1>\n	Open Days</h1>\n<p>\n	The school holds regular Open Days throughout the year and on each of the 3 sites in order to give all prospective parents the opportunity to view the school and discuss their child&rsquo;s educational requirements.&nbsp; However, if you have missed our Open Days for the Autumn Term, please contact the school for an individual appointment to view the facilities during any school day.\n</p>\n<p>\n	Dates for Spring and Summer Terms 2012 are:\n</p>\n<p>\n</p>\n<ul>\n	<li><strong>10th March 2012</strong>&nbsp;- Highclare School, St Paul&#39;s, Pre-School, Infants &amp; Juniors</li>\n	<li><strong>12th May 2012</strong> - Highclare School, Woodfield, Nursery, Pre-School, Infants &amp; Juniors.</li>\n</ul>\n<h2>\n	Sixth Form Entry For September 2012</h2>\n<p>\n	All applications and enquiries for the Sixth Form beginning in September 2012 are now welcome. Please download a Sixth Form Application Form here Sixth Form Application Form, or contact the Admissions office.&nbsp;\n</p>\n<h2>\n	11+ Admission For Girls And Boys To Senior School</h2>\n<p>\n	September 2012 - Our assessment day for entry to Year 7 in September 2012 will take place on : Friday 9th March.&nbsp;\n</p>\n<p>\n	To register for this please complete our Registration form, downloadable here, and return to school by the closing date.&nbsp;&nbsp; Please see details on this site about Scholarships and Bursaries.&nbsp;&nbsp;\n</p>\n<p>\n	We welcome interest from boys and girls.\n</p>\n<h2>\n	Reception Class Applications</h2>\n<p>\n	The application process for Reception Class 2012 will begin in October 2011, please contact the admissions office for further information and application forms.\n</p>\n','published',38,39,'2012-03-09 17:12:19',NULL),(21,1,'Admission Policy','/policy','<h1>\n	Admission Policy</h1>\n','published',40,41,'2012-03-09 17:21:27','2012-03-09 17:22:01'),(22,1,'Nursery & Pre-School','/nursery-and-preschool','<h1>\n	Nursery &amp; Pre-School</h1>\n<p>\n	Highclare Nursery is a self-contained unit which is integrated into the Preparatory Department at Highclare Woodfield. It is fully equipped to provide for the needs of children from 18 months to 3 years, but it has the great advantage of access to the educational resources and facilities of the school, e.g. regular sessions in the gymnasium, visits to the school library and gardens, and joining school assemblies.\n</p>\n<p>\n</p>\n<p>\n	The experienced and qualified staff care for the children in a warm, welcoming and safe environment, in which there are separate areas for rest and play.\n</p>\n<p>\n	Daily records are kept to provide parents with information about their child&#39;s progress and parents are welcome to visit the Nursery at any time. The Nursery is registered and inspected by Ofsted.\n</p>\n<p>\n</p>\n<ul>\n	<li>Staff Child ratios: 1: 3 under 2 years, 1 : 4 over 2 years</li>\n	<li>Open Monday to Friday 7.30 am to 6.00 pm</li>\n	<li>Open 50 weeks a year, or term time only places available if preferred</li>\n	<li>Full and part time sessions available</li>\n	<li>A natural and easy transition from Nursery into Kindergarten at the beginning of term in which the 3rd birthday falls</li>\n	<li>Fees paid monthly and fully inclusive of food, drinks and nappies</li>\n	<li>Freshly cooked lunches and teas, including vegetarian meals.</li>\n</ul>\n','published',43,46,'2012-03-09 17:24:40','2012-03-20 14:13:26'),(23,1,'Admissions','/admissions','<h1>\n	Admissions</h1>\n<p>\n	The Nursery hours are 7.30 am to 6.00 pm Monday to Friday. The Nursery opens 50 weeks per year.\n</p>\n<p>\n	The day is split into two sessions:\n</p>\n<ul>\n	<li>Morning: 7.30 am to 1.00 pm</li>\n	<li>Afternoon: 1.00 pm to 6.00 pm</li>\n</ul>\n<p>\n	There is a minimum requirement that children attend at least 5 sessions per week and this can be morning or afternoon or a combination of both.\n</p>\n<p>\n	All prospective parents are encouraged to make an appointment to visit the nursery to view the facilities for themselves and to meet with staff.\n</p>\nPrior to starting in the Nursery all children will be invited for a &lsquo;familiarisation&rsquo; session and often this may be two or three times to ensure the child is quite happy with its new surroundings.\n<p>\n	All Nursery fees are calculated for the year ahead and paid monthly in advance by Direct Debit. A month&rsquo;s notice in writing will be required to terminate a nursery contract.\n</p>\n','published',44,45,'2012-03-09 17:24:56','2012-03-20 14:14:18'),(24,1,'Infants','/infants','<h1>\n	Infants</h1>\n<p>\n	The Nursery, Pre-School &amp; Infant Departments at Highclare School have a strong reputation for achieving Individual Excellence for each pupil.\n</p>\n<p>\n	The Nursery caters for children from the age of 18 months through to 3 years old and runs from 7.30 am to 6.00 pm on a full year basis. During the term in which they become 3 years old children move to the Kindergarten and Pre-School Departments, either at Highclare Woodfield, or Highclare St Paul&#39;s, where a warm welcome awaits them from the experienced teaching staff.\n</p>\n<p>\n	Both sites provide a safe and secure environment, with perimeter fences and gated entrances. A full wrap-around care service, (TOPS, is offered for busy parents from 7.30 am to 6.00 pm, including breakfast and tea. A structured holiday scheme (TOPS), operates during all school holidays and it has received a Quality Assurance Award for care from Birmingham PlayCare Network.\n</p>\n<p>\n	A healthy eating food policy is delivered on site by our catering staff and supported by caring lunchtime supervisors.\n</p>\n<p>\n	Pupils are encouraged from an early age to look after one another. A structure is in place in the Infant Department, using &#39;Friendship Benches&#39; to recognise others&#39; pastoral needs, and awards are made for good playground behaviour.\n</p>\n<p>\n	Merit systems are used in the Pre-School and Infant Departments to acknowledge pupil attainment for both curricular and extra-curricular activities, and these awards, together with accompanying certificates are presented at weekly Merit Assemblies. Talents in extra-curricular activities such as French, Ballet and sport are nurtured using Award stickers.\n</p>\n<p>\n	The learning needs of individual children are recognised through regular staff meetings where information is shared, notably on transfer between classes, and particularly in the case of children moving from Transition class (Pre-School) to Reception, and from Year 2 to Year 3 (Juniors)\n</p>\n<p>\n	Your child is assured of a confident start to their education in the caring environment at Highclare&#39;s Nursery, Pre-School &amp; Infant Departments.\n</p>\n','published',47,60,'2012-03-12 11:24:56','2012-03-12 11:25:12'),(25,1,'School Life','/school-life','<h1>\n	School Life</h1>\n','published',48,49,'2012-03-12 11:31:19',NULL),(26,1,'Curriculum','/curriculum','<h1>\n	Curriculum</h1>\n<h2>\n	The Foundation Stage (Pre-School) (Kindergarten &amp; Transition)</h2>\n<p>\n</p>\n<p>\n	The qualified teaching staff aim to lay the foundations for each child to become confident, independent and self-motivated. It is important to make one of their first experiences away from home a happy, friendly time with new discoveries within a warm, welcoming environment.\n</p>\nStructured play: Time is always made for the girls and boys to be involved in structured play. Play activities are an essential part of a pre-school child&rsquo;s development. Through organised play children learn to develop as individuals.\n<p>\n	The curriculum is well structured and sequenced in order to ensure progression and development of children&rsquo;s intellectual growth, encompassing all aspects of the Early Learning Goals as set down in the National Curriculum.\n</p>\n<h2>\n	Infant Department (Key Stage 1)</h2>\n<p>\n</p>\n<p>\n	The broad curriculum embraces all aspects of numeracy, literacy and science, together with history, geography, ICT, art, design and technology. Specialist teaching in PE and Music, including recorders all forms part of a standard week&rsquo;s activities.\n</p>\nStaff encourage the children to extend language through reading and writing using the comprehensive libraries to instil a love of books at this early age.\n<p>\n	Pupils benefit from the use of interactive white boards, their own on-site computer rooms, and fully equipped gymnasium. All the children are encouraged to develop self confidence, self esteem and consideration for others in a structured, caring environment.\n</p>\n','published',50,51,'2012-03-12 11:32:50',NULL),(27,1,'Extra Curricular','/extra-curricular','<h1>\n	Extra Curricular</h1>\n','published',52,53,'2012-03-12 11:34:04',NULL),(28,1,'Diary Dates','/diary-dates','<h1>\n	Diary Dates</h1>\n','published',54,55,'2012-03-12 11:34:24',NULL),(29,1,'The School Day','/school-day','<h1>\n	The School Day</h1>\n<p>\n</p>\n','published',56,57,'2012-03-12 11:35:01',NULL),(30,1,'Sports','/sports','<h1>\n	Sports</h1>\n','published',58,59,'2012-03-12 11:35:22',NULL),(31,1,'Juniors','/juniors','<h1>\n	Highclare Junior Departments</h1>\n<h2>\n	Meeting Individual Needs In Our Junior Departments</h2>\n<p>\n	Highclare encourages children to participate in a diverse range of activities. An extensive extra curricular programme enables everyone to develop through a balance of work and play.\n</p>\n<p>\n</p>\n<ul>\n	<li>Pupils are actively encouraged to enjoy a wide variety of lunchtime and after-school Clubs encompassing academic, creative, sporting and social needs.</li>\n	<li>Children enjoy taking part in many team sports with competition for all through inter-School and inter-House programmes.</li>\n	<li>Children relish many opportunities for musical performance and drama as part of Recorder Groups, Choir, individual instrument lessons school assemblies and productions.</li>\n	<li>Pupils benefit from a wide ranging programme of Educational trips and Outdoor Education in year 6.</li>\n	<li>After School Tuition in verbal and non-verbal reasoning for 11+ Grammar School Exams</li>\n</ul>\n<p>\n	Importance is placed upon the teaching and learning of English and Mathematics and Science within a broad and balanced curriculum which meets and exceeds national guidelines aimed at establishing a solid structure and a basis for every child&#39;s future intellectual growth.\n</p>\n<p>\n</p>\n<ul>\n	<li>Academic excellence is valued and celebrated.</li>\n	<li>There are specialist facilities for Art, Design and Technology, Music, Science, Dance, Drama and Physical Education including use of Bishop Vesey Grammar School Sports Hall and Wyndley Leisure Centre and Swimming Pool.</li>\n	<li>Computer network and PC workstations in every classroom.</li>\n	<li>The latest ICT developments regularly updated computer suite and networked pc&#39;s in every classroom keep pupils up to date with new technology.</li>\n	<li>Use of ICT to communicate and support problem solving.</li>\n	<li>The pupil&#39;s cognitive development is supported by use of Interactive Whiteboard Technology throughout the school.</li>\n	<li>Timetabled lessons in verbal and non-verbal reasoning for grammar school exams</li>\n	<li>Specialist help is available for children with dyslexia.</li>\n</ul>\n<h4>\n	Welfare Needs - Achieving Individual Excellence</h4>\n<p>\n</p>\n<ul>\n	<li>An excellent pastoral system and a caring ethos welcomes each child into the warmth of the schools family atmosphere</li>\n	<li>A close home school partnership strengthens the bond of trust between parents pupils and staff</li>\n	<li>A nurturing environment ensures stable secure surroundings in which each child can thrive</li>\n</ul>\n<h2>\n	Developing The Whole Child</h2>\n<p>\n</p>\n<p>\n	Great emphasis is placed upon pastoral care seeking to nurture the potential of the whole child as an individual\n</p>\n<p>\n</p>\n<ul>\n	<li>Clear moral values fostered by assemblies, circle time, and PSHE</li>\n	<li>High behavioural expectations</li>\n	<li>Partnership between teachers and parents</li>\n	<li>House system in junior department</li>\n	<li>Breadth and challenge beyond the classroom to complement the academic</li>\n	<li>Leadership opportunities and positions of responsibility including prefects and form captains</li>\n	<li>New pupils provided with mentors</li>\n	<li>Establishment of firm relationships based on trust</li>\n</ul>\n<h4>\n	Ethnic and religious needs - Achieving Individual Excellence</h4>\n<p>\n</p>\n<p>\n	The spiritual awareness of each individual is fostered through\n</p>\n<p>\n</p>\n<ul>\n	<li>Regular assemblies</li>\n	<li>Celebrating Religious Festivals</li>\n	<li>Visiting Speakers</li>\n	<li>Circle time</li>\n	<li>All ethnic minorities catered for</li>\n</ul>\n<h4>\n	School Standards and Expectations - Achieving Individual Excellence</h4>\n<p>\n</p>\n<p>\n	Pupils are carefully guided towards a fulfilment of their personal goals through:\n</p>\n<p>\n</p>\n<ul>\n	<li>High expectations meeting and exceeding national guidelines</li>\n	<li>Opportunities for each child to meet individual targets through broad curriculum fulfilling their potential</li>\n	<li>Monitoring of teaching and learning through classroom observations</li>\n	<li>Monitoring of standards through subject specific curriculum monitoring</li>\n</ul>\n<h4>\n	Dress standards - Achieving Individual Excellence</h4>\n<p>\n</p>\n<p>\n	Pupils are encouraged to take pride in attending Highclare and in their appearance through high expectations of dress. They are supported by:\n</p>\n<p>\n</p>\n<ul>\n	<li>Regular uniform checks with positive rewards</li>\n	<li>Consistency, checking and monitoring of pupil dress by all staff</li>\n	<li>Partnership and support from parents ensuring smart appearance at all times</li>\n	<li>Staff as a role model</li>\n</ul>\n<h4>\n	Standards of behaviour - Achieving Individual Excellence</h4>\n<p>\n</p>\n<p>\n	To fulfil their academic and personal potential high standards of behaviour are expected and rewarded within a house system.\n</p>\n<p>\n</p>\n<ul>\n	<li>A positive and calm atmosphere is encouraged throughout the school</li>\n	<li>Children adhere to Golden Rules and Code of Conduct</li>\n	<li>Classroom rules are agreed by staff and pupils</li>\n	<li>The promotion of reasoned discussion to think through and solve problems</li>\n</ul>\n<h4>\n	Interpersonal skills - Achieving Individual Excellence</h4>\n<p>\n</p>\n<p>\n	Pupils are encouraged to interact and develop a wide range of social and communication skills through:\n</p>\n<p>\n</p>\n<ul>\n	<li>Assemblies regular whole school, department and class assemblies</li>\n	<li>School trips</li>\n	<li>Staff as role models</li>\n	<li>Speaking and listening curriculum</li>\n	<li>Drama</li>\n	<li>Circle time</li>\n	<li>Dealing with conflict</li>\n	<li>School performances</li>\n</ul>\n<h4>\n	Teaching - Achieving Individual Excellence</h4>\n<p>\n</p>\n<ul>\n	<li>Teaching is class based for core subjects</li>\n	<li>Specialised teaching in many areas</li>\n	<li>The promotion of an effective learning environment to promote personalised learning</li>\n	<li>Encouraging, positive and purposeful atmosphere</li>\n	<li>High expectations through praise rewards and friendliness</li>\n	<li>Small classes provide more time and greater opportunity for individual attention</li>\n	<li>Differentiated work to cater for the needs of each individual child</li>\n	<li>Regular monitoring and assessment to inform future learning</li>\n	<li>French taught from year 3</li>\n	<li>Providing challenges and extension for gifted and able</li>\n</ul>\n<h4>\n	Pupil participation - Achieving Individual Excellence</h4>\n<p>\n</p>\n<p>\n	Pupils are encouraged to actively discuss and offer opinions about issues affecting themselves, their school and community and the world at large.\n</p>\n<p>\n</p>\n<ul>\n	<li>Integral part of school community</li>\n	<li>School Council enabling decision making</li>\n</ul>\n','published',61,80,'2012-03-13 09:09:52',NULL),(32,1,'School Life','/school-life','<h1>\n	School Life</h1>\n','published',62,63,'2012-03-13 09:14:29',NULL),(33,1,'Curriculum','/curriculum','<h1>\n	Curriculum</h1>\n<p>\n	The Junior Departments for both boys and girls offer the same broad and balanced curriculum.\n</p>\n<p>\n</p>\n<p>\n	<span class=\"mceItemHidden\">The subjects of English, Mathematics and Science <span class=\"hiddenGrammarError\" pre=\"Science \">are considered</span> of paramount importance. There is strong emphasis on class teaching and together with small class sizes this enables progress <span class=\"hiddenGrammarError\" pre=\"progress \">to be</span> monitored closely.</span>\n</p>\n<p>\n	<span class=\"mceItemHidden\">Pupils <span class=\"hiddenGrammarError\" pre=\"Pupils \">are taught</span> by subject specialists for French, Music, Science (Years 5 &amp; 6) and PE.</span>\n</p>\n<p>\n</p>\n<p>\n	<span class=\"mceItemHidden\">Interactive whiteboards, Junior Science Laboratories and ICT suites <span class=\"hiddenSuggestion\" pre=\"suites \">ensure</span> that all pupils have access to up to date learning resources.</span>\n</p>\n','published',64,65,'2012-03-13 09:19:37',NULL),(34,1,'Extra Curricular','/extra-curricular','<h1>\n	Extra Curricular</h1>\n<p>\n	Extra Curricular activities in both Junior Departments of Highclare School take place throughout the school week, both during the school day and at the end of school time.\n</p>\n<h2>\n	Music And Drama</h2>\n<ul>\n	<li>Opportunities to participate in a wide range of Junior ensembles, choirs, orchestras and wind band.</li>\n	<li>Concerts in and out of school are a regular feature of the Junior Department school year.</li>\n	<li>Individual tuition is available for singing and a wide variety of&nbsp; instruments.</li>\n	<li>All Junior pupils learn the recorder up to Year 6.</li>\n	<li>Help with Associated Board Examinations.</li>\n	<li>Staging of Drama productions within the Junior Departments takes place regularly</li>\n	<li>Pupils take a wide range of LAMDA examinations.</li>\n	<li>Drama activities build confidence and encourage spontaneity of expression.</li>\n	<li>Communication skills are fostered, helping pupils to express themselves clearly, naturally and confidently.</li>\n</ul>\n<h2>\n	Sport</h2>\n<ul>\n	<li>The school takes part in local Sutton Schools competitions and also Independent Schools competitions.</li>\n	<li>House teams in many sports gives further opportunities.</li>\n	<li>Over 30 teams including hockey, netball, tennis, rounders, athletics, cross country, football, cricket, swimming and gymnastics.</li>\n	<li>Many club activities e.g. trampolining and badminton, judo, golf</li>\n	<li>Year 6 pupils take part in PGL residential trips.</li>\n</ul>\n<h2>\n	Citizenship</h2>\n<ul>\n	<li>Junior pupils take part in activities to raise money for local and national charities.</li>\n	<li>Highclare Juniors regularly visit local Residential and Care homes, singing and entertaining residents.</li>\n	<li>Boys and Girls from Highclare&#39;s Junior Schools take part in the Rotary Club Community Award Scheme</li>\n</ul>\n','published',66,67,'2012-03-13 09:21:09',NULL),(35,1,'Diary Dates','/diary-dates','<h1>\n	Diary Dates</h1>\n','published',68,69,'2012-03-13 09:26:27',NULL),(36,1,'The School Day','/school-day','<h1>\n	The School Day</h1>\n<p>\n	The boys and girls in the Junior Department at Highclare School, follow a timetable split into 5 x 1 hour lessons, with specialist staff taking Junior classes for lessons in Music, ICT, French, and Science.\n</p>\n<p>\n	At The Abbey site school starts at 8.35 am and finishes at 3.15 pm\n</p>\n<p>\n</p>\n<p>\n	Lunch period is 12.15 pm to 1.15 pm\n</p>\n<p>\n	At St Paul&#39;s site school starts at 8.50 am and finishes at 3.25 pm\n</p>\n<p>\n</p>\n<p>\n	Outside speakers are regularly invited in to school to speak to the classes. Interactive whiteboards, a Junior Science Laboratory and an ICT suite ensure that the pupils have access to up to date learning resources.\n</p>\n<p>\n	Homework in the Junior Department is set at the discretion of the Form Teacher and a timetable is kept in the Homework diary.\n</p>\n<p>\n</p>\n<p>\n	As a guide line the following amount of homework is expected:\n</p>\n<ul>\n	<li>Year 3 &amp; Year 4 ~ half an hour per night, plus reading</li>\n	<li>Year 5 ~ 45 minutes per night, plus reading</li>\n	<li>Year 6 ~ 1 hour per night, generally spanning 2 subjects, plus reading</li>\n</ul>\n<p>\n	At the end of the school day and during lunch time, we do recognise that education must be much wider than the study of academic subjects and to this end we offer a wide variety of extra curricular activities.&nbsp; These are reviewed termly to reflect the interests of pupils and the seasons and currently, we offer:\n</p>\n<p>\n</p>\n<ul>\n	<li>Computers&nbsp;</li>\n	<li>Golf</li>\n	<li>Choir</li>\n	<li>Board Games</li>\n	<li>Jewellery making/Metalwork</li>\n	<li>Recorder Group</li>\n	<li>Orchestra</li>\n	<li>Ballet</li>\n	<li>Knitting</li>\n	<li>Maths Challenge</li>\n	<li>Football</li>\n	<li>Netball</li>\n	<li>Times Table</li>\n	<li>Gardening Club</li>\n	<li>Tennis</li>\n	<li>Cross Country</li>\n	<li>Music club</li>\n	<li>Chess club</li>\n	<li>Art &amp; Design</li>\n	<li>Cricket</li>\n	<li>Design Technology</li>\n	<li>Reading Club</li>\n	<li>Food &amp; Technology</li>\n	<li>Hockey</li>\n	<li>Arts &amp; Craft</li>\n	<li>Gymnastics</li>\n</ul>\n<p>\n	Games play an important part in the life of the school, with a wide range of different sports, including football, rugby, cricket and athletics to choose from, all coached to the highest standards. The school participates very successfully in numerous regional and national tournaments in all areas of sport.\n</p>\n<p>\n	We are committed to providing high quality music education and individual lessons are available for many instruments.&nbsp; We encourage the children to perform for their friends in assemblies and at other events.&nbsp; We perform an annual play and all of the children are involved in this performance.&nbsp; Our pupils also have the opportunity to perform in our annual dance gymnastics display and each year we present a Junior Concert.\n</p>\n','published',70,71,'2012-03-13 09:28:53',NULL),(37,1,'Clubs','/clubs','<h1>\n	Clubs</h1>\n<h3>\n	Club Report Of The Month</h3>\n<p>\n	<strong>Body Combat Club</strong>\n</p>\n<p>\n</p>\n<p>\n	Pupils at the Abbey Juniors have been enjoying the opportunity to go to Body Combat on Thursdays after school.\n</p>\n<p>\n	It is a really good club. It is a bit like karate where we get fit by doing circuits and moves to keep us safe. We have learnt different kicks and hand movements such as jabs, guards and blocks.\n</p>\n<p>\n	It is brilliant; come and join us if you want to get fit.\n</p>\n<p>\n	Daisy and Arjun (Year 4)\n</p>\n','published',72,73,'2012-03-13 09:30:19',NULL),(38,1,'Sports','/sports','<h1>\n	Sports</h1>\n<h2>\n	District Honours</h2>\n<p>\n	A number of Highclare footballers were selected to represent Sutton Coldfield District at Under 11 level this term after trials at Braemar Road last summer.&nbsp; Kurtis, Daniel and Nathan were in the team that made the Semi-Finals of the West Midlands County Tournament at Wolverhampton in November and won 9-1 against East Birmingham. The team was also only narrowly defeated by Kings Norton 2-1, the District League leaders.\n</p>\n<p>\n	On the girls&rsquo; front, Gabrielle and Mayuri were in the U11 District team that won the Birmingham District Shield in October.\n</p>\n<p>\n	<strong>Going into the festive period of matches, the team sits on top of the Birmingham and District League.</strong>\n</p>\n<h2>\n	ISA Under 11 Mixed Hockey Tournament</h2>\n<h4>\n	Overall Results</h4>\n<strong>Team:</strong>&nbsp;Isobel, Abigail, Cecilia, Gabrielle, Mayuri, Kurtis, Daniel, Allistair and Joshua.\n<p>\n	1st Crackley Hall<br />\n	2nd Salterford House<br />\n	3rd Stafford<br />\n	4th Chase Academy<br />\n	<strong>5th Highclare</strong><br />\n	6th St Wystans<br />\n	7th The Knoll<br />\n	8th Moffats<br />\n	9th St Joseph&rsquo;s\n</p>\n<p>\n	We played 4 games in our pool, winning 2 and losing 2. We missed out on a semi final place on goal difference and went on to win our final match. This is an excellent result in our first ever entry in this competition. We look forward to climbing the league table in future years.\n</p>\n<p>\n	<em>Well done, to all our players who thoroughly enjoyed the day at Cannock and<br />\n	were a real credit to Highclare School.</em>\n</p>\n<h2>\n	Swimming</h2>\n<h4>\n	INDEPENDENT SCHOOLS</h4>\n<ul>\n	<li>Junior team 1st out of 18 schools</li>\n	<li>Junior team winners of the Open Trophy</li>\n	<li>4 girls selected to represent the Midlands at the ISA Nationals, where they collected 5 gold and 2 silver medals between them and helped Midlands claim overall victory</li>\n</ul>\n<h4>\n	SUTTON SCHOOLS</h4>\n<ul>\n	<li>Junior team winners of Large Schools Championship Trophy</li>\n	<li>Combined Girls and Boys Junior Team winners of relay trophy</li>\n</ul>\n<h2>\n	Football</h2>\n<ul>\n	<li>Year 6 ISA Midland Regional 5-a-side winners</li>\n	<li>Year 4 ISA Mildand Regional Finalists</li>\n	<li>Year 6 Aston Villa Regional 5-a-side winners</li>\n	<li><strong>Year 6 Sutton Schools 4-A-Side Winners</strong></li>\n	<li><em>Year 5 &amp; 6 Sutton Medium Schools League Bronze Medal</em></li>\n	<li><em>Year 6 ISA National 5-a-side plate winners</em></li>\n	<li><em>Year 5 &amp; 6 Sutton schools Knock Out Cup winners</em></li>\n	<li><em>Year 5 Sutton Schools 6-a-side winners</em></li>\n	<li><em>Year 6 Aston Villa Cup 5-a-side finalists</em></li>\n	<li><em>Year 4 &amp; 5 All Birmingham Schools 7-a-side winners</em></li>\n	<li><em>Year 6 All Birmingham Schools 4-a-side finalists</em></li>\n</ul>\n<p>\n	<em>Years 3, 4, 5 &amp; 6 were unbeaten by an independent school in the Midlands<br />\n	2 of our Junior Girls selected to play in the Sutton Coldfield primary Schools Girls&#39; District Football Team. Click here to learn more.</em>\n</p>\n<h2>\n	Netball</h2>\n<h4>\n	SUTTON SCHOOLS</h4>\n<ul>\n	<li>Year 5 Team 3rd In Tournament</li>\n	<li>Year 6 team 1st in Tournament</li>\n	<li>Year 6 League &ndash; currently 2nd with one match to play</li>\n</ul>\n<h2>\n	Cross Country</h2>\n<h4>\n	SUTTON SCHOOLS</h4>\n<ul>\n	<li>Junior team placed 1st in the Sutton Schools league</li>\n	<li>Combined Junior Girls &amp; Boys team placed 2nd in the Sutton Schools League</li>\n	<li>Junior team placed 1st at Sutton Schools Championships</li>\n</ul>\n<h2>\n	Athletics</h2>\n<h4>\n	INDEPENDENT SCHOOLS</h4>\n<ul>\n	<li>Year 4 &ndash; Team 7th</li>\n	<li>Year 5 &ndash; Team 2nd</li>\n	<li>Year 6 &ndash; Team 3rd</li>\n</ul>\n','published',74,75,'2012-03-13 09:41:13',NULL),(39,1,'Assessment','/assessment','<h1>\n	Assessment</h1>\n<p>\n	Assesment is an important part of Highclare&rsquo;s ethos of education. Pupils are tracked from when they enter the school through testing using the Curriculum, Evaluation and Management (CEM) system from Durham University.\n</p>\n<p>\n</p>\n<p>\n	During Nursery and Key Stage One pupils&rsquo; are tested and analysed annually while during Key Stage Two testing is biennial. Monitoring of the results is continuous.\n</p>\n<p>\n	From Yr 6 our tracking information is transferred to the senior school.\n</p>\n<p>\n</p>\n<p>\n	The CEM system of assesment also provides Value Added data both for each individual and the cohort as a whole.\n</p>\n','published',76,77,'2012-03-13 09:42:38',NULL),(40,1,'Key Stage 2','/key-stage-2','<h1>\n	Key Stage 2</h1>\n<p>\n	The National Curriculum guidelines are followed in Key stage 2, with particular emphasis on core subjects:\n</p>\n<p>\n</p>\n<ul>\n	<li>English (at least 5hrs per week).</li>\n	<li>Maths (5 hrs per week).</li>\n	<li>Science (3 hrs per week).</li>\n	<li>Preparation for 11+ examinations commences in Year 3 with after school tuition for J5.</li>\n	<li>Computers are used regularly by all pupils and extensive software is available.</li>\n	<li>Pupils have their own Junior Library.</li>\n	<li>Mid year tests are carried out in core subjects and end of year examinations take place in the summer term.</li>\n	<li>Regular monthly achievement awards are given.</li>\n	<li>Junior Prize Giving takes place at the end of Summer Term and celebrates achievements of all pupils throughout the year.</li>\n</ul>\n','published',78,79,'2012-03-13 09:43:38',NULL),(41,1,'Seniors','/seniors','<h1>\n	Seniors</h1>\n<p>\n	The Senior School is open to girls and boys from 11 to 16 years.\n</p>\n<p>\n	<em>(We are pleased to announce we are now enrolling Boys to Year 7 in the Senior School and the school will be fully co-educational by 2015)</em>\n</p>\nThe school provides a safe, secure and friendly environment with excellent staff to pupil ratios. Our high standards, good manners and respectful conduct create a harmonious atmosphere in which teachers can devote all their time and energies towards pupils, getting to know each pupil as a unique individual, enabling us to provide greater attention to their needs and education.\n<p>\n	Teaching staff are highly motivated, well-qualified, caring professionals who have a wealth of experience and build good relationships with pupils who consequently respond positively to assistance and advice with their subjects. Creativity is encouraged and we provide the flexibility within the curriculum to build on individual strengths so increasing a pupil&#39;s potential.\n</p>\nWe aim to stretch pupils own development through extra-curricular activities, providing many opportunities for this within school life and fostering team-building and leadership skills. Pupils are rewarded for pursuing interests outside of school life and trying new experiences through an innovative house point system.\n<p>\n	On arrival, each pupil is assigned to a member of staff who, as their personal tutor, will have regular meetings and support that student throughout his or her education in the Senior School.<br />\n	Our academic results speak for themselves with overall pass rates of 100% at GCSE, giving us a top 6 ranking for results in Birmingham.\n</p>\nAbove all, pupils of Highclare Senior School graduate as articulate and confident young people, assured of their personal strengths, and possessing the ability to present themselves well, when securing places in higher education, or employment.\n<p>\n	<strong>Highclare School is a member of the prestigious Independent Schools Assosiation.</strong>\n</p>\n<h2>\n	Chanel-Lee Easy</h2>\n<blockquote>\n	<p>\n		It is with the deepest regret that we convey to you the sad news of the death of Chanel-Lee Easy.&nbsp; Chanel was a valued member of the Highclare family who we had the pleasure to teach until she left us this year to join the sixth form at The Arthur Terry School. Chanel will be remembered by all who knew and loved her for her wonderful smile and infectious laughter.&nbsp; She brought the blessings of kindness and happiness to all who had the privilege of knowing her and she will be sorely missed.&nbsp; Our thoughts and prayers are with her family and friends.\n	</p>\n</blockquote>\n','published',81,100,'2012-03-13 09:52:41',NULL),(42,1,'School Life','/school-life','<h1>\n	School Life</h1>\n<h2>\n	1. House Point System</h2>\n<p>\n</p>\n<p>\n	Each pupil, Yr 7 to Yr 11 (U3 to U5), is provided with a card on which to collect house points. These are awarded for good work, good behaviour, effort, co-operation, appearance, etc. When sufficient red points have been collected the following awards are given\n</p>\n<ul>\n	<li>5 cards - Blue Award</li>\n	<li>10 cards - Silver Award</li>\n	<li>15 cards - Gold Award</li>\n	<li>20 cards - Ash Pendant</li>\n	<li>The Gold awards and Ash Pendant are presented at Senior Speech Day.</li>\n</ul>\n<p>\n</p>\n<h2>\n	2. House System</h2>\nTo foster co-operation and competition, pupils in the senior school are divided into Houses - York, Tudor and Lancaster. House competitions are run in sporting and various other school activities with a House Festival once every 3 years. This gives students the opportunity to develop leadership skills and display their talents, pupils work together and through co-operation gain skills and hopefully successes which will increase their confidence and self-esteem.\n<h2>\n	3. Tutor System</h2>\nIn Senior School, each child has his/her own tutor, a member of staff appointed to be on hand to encourage and monitor&nbsp; development throughout their time at Highclare.&nbsp;&nbsp; Any weaknesses or problems are discussed and corrective action taken. It is hoped that this system will encourage all pupils to make the most of the opportunities available to them.&nbsp; Each Tutor organises regular meetings with their Tutees and may liaise with parents where a need arises.&nbsp; A child will&nbsp; hopefully retain the same member of staff as a Tutor throughout their time at the school.','published',82,83,'2012-03-13 09:54:33',NULL),(43,1,'Curriculum','/curriculum','<h1>\n	Curriculum</h1>\n<p>\n	At Highclare School the academic curriculum is designed to prepare students for life as independent learners and to achieve individual excellence.<br />\n	All pupils follow a broad, balanced curriculum, which is delivered by well-qualified specialist teachers. Subjects studied during Key Stage 3 (Years 7, 8 &amp; 9) are:\n</p>\n<p>\n</p>\n<ul>\n	<li>English Language</li>\n	<li>English Literature</li>\n	<li>Drama</li>\n	<li>Mathematics</li>\n	<li>Physics, Chemistry &amp; Biology</li>\n	<li>History</li>\n	<li>Geography</li>\n	<li>French</li>\n	<li>German (from Yr 8)</li>\n	<li>Music</li>\n	<li>Religious Education</li>\n	<li>ICT</li>\n	<li>Personal Health and Social Education (PHSE)</li>\n	<li>Physical Education</li>\n	<li>Art</li>\n	<li>Home Economics</li>\n	<li>Design Technology</li>\n	<li>Enrichment</li>\n</ul>\n<p>\n	At Key Stage 4, Years 10 &amp; 11, all pupils study the core curriculum at GCSE of English Language, English Literature, Mathematics, Science &amp; Additional Science, a Modern Foreign Language, ICT and PSHCE. 3 option subjects are chosen from:\n</p>\n<p>\n</p>\n<ul>\n	<li>French</li>\n	<li>German</li>\n	<li>History</li>\n	<li>Geography</li>\n	<li>Music</li>\n	<li>Home Economics</li>\n	<li>Physical Education</li>\n	<li>Religious Education</li>\n	<li>Art</li>\n	<li>Textiles Technology</li>\n</ul>\n<p>\n	At Highclare School the academic curriculum is designed to prepare students for life as independent learners and to achieve individual excellence.\n</p>\n<p>\n	In order to qualify for the English Baccalaureate all pupils will be required to include History or Geography in their 3 option choices.\n</p>\n','published',84,85,'2012-03-13 09:55:58',NULL),(44,1,'Extra Curricular','/extra-curricular','<h1>\n	Extra Curricular</h1>\n<p>\n	Whilst academic achievement remains at the heart of Highclare&#39;s educational philosophy, great importance is accorded to the developments of other talents. Every individual is therefore encouraged to take part in one or more of the many extra curricular activities available.\n</p>\n<p>\n</p>\n<h2>\n	Music, Speech And Drama</h2>\n<ul>\n	<li>Opportunities to participate in a wide range of ensembles, choirs, orchestras and wind band.</li>\n	<li>Concerts in and out of school are a regular feature of the school year.</li>\n	<li>Individual tuition for most instruments and voice training and acting.</li>\n	<li>External instrumental examinations are encouraged.</li>\n	<li>A music and drama department regularly stages productions.</li>\n	<li>Pupils take a wide range of LAMDA examinations.</li>\n	<li>Drama activities build confidence and encourage spontaneity of expression.</li>\n	<li>Communication skills are fostered, helping students to express themselves clearly, naturally and confidently.</li>\n	<li>Public speaking club develops useful life skills and pupils regularly enter Rotary competitions.</li>\n	<li>Book club encourages an interest in literature.</li>\n</ul>\n<h2>\n	Sport</h2>\n<p>\n</p>\n<ul>\n	<li>County representation in 5 sports.</li>\n	<li>House teams in 8 sports giving further opportunities.</li>\n	<li>Over 30 teams including hockey, netball, tennis, rounders, athletics, cross country, football, cricket, swimming and gymnastics.</li>\n	<li>Many club activities e.g. fencing and badminton</li>\n	<li>A great deal of match practice in local and independent school leagues and tournaments.</li>\n	<li>Dance clubs for all ages.</li>\n</ul>\n<h2>\n	Citizenship</h2>\n<ul>\n	<li>A wide range of projects undertaken for local and national charities</li>\n	<li>As part of the General Studies programme, the Sixth formers welcome a variety of visiting speakers to address them on current affairs and issues of concern.</li>\n</ul>\n<h2>\n	Out And About</h2>\n<p>\n</p>\n<ul>\n	<li>Regular trips expand experience and the development of subject areas.</li>\n	<li>Theatre and museum visits throughout the age range.</li>\n	<li>Adventure holidays and hockey tours occur frequently.</li>\n	<li>Visits abroad encompass language study and cultural aspects.</li>\n	<li>Music tours abroad.</li>\n</ul>\n','published',86,87,'2012-03-13 09:57:25',NULL),(45,1,'Maths, Science & English','/maths-science-and-english','<h1>\n	Maths, Science &amp; English</h1>\n<h2>\n	Maths</h2>\n<p>\n</p>\n<p>\n	In order to help all pupils to achieve &lsquo;individual excellence&rsquo; Mathematics is taught in sets from the middle of Year 7.&nbsp; From year 9 upwards each year group is divided into 3 sets. The aim of the subject specialists who teach all the mathematics in the school is to help pupils to enjoy the subject and to gain confidence in their own ability at problem solving. The results of this approach are shown in our success at GCSE. This summer 100% of our pupils gained A* to B grades in mathematics.\n</p>\n<p>\n	Mathematics is offered in the Sixth Form at both AS and A2 levels.\n</p>\n<p>\n</p>\n<h2>\n	English</h2>\n<p>\n</p>\n<h4>\n	Aims of the English department</h4>\n<ul>\n	<li>To enable each pupil to develop to the full his or her skills and abilities in speaking and listening, reading and writing.</li>\n	<li>To enable each pupil to achieve his or her potential in Yr 11 (U5th) in both GCSE English Language and English Literature.</li>\n	<li>To encourage an interest and delight in the written and spoken word which may lead to further study and success in the Sixth Form but which will remain with pupils throughout their lives.</li>\n	<li>To develop through literature and discussion an awareness of, and sensitivity to, others&rsquo; opinions, different lifestyles, cultures and age groups.</li>\n	<li>To develop in each pupil self-confidence and a determination to achieve his or her potential</li>\n</ul>\n<p>\n</p>\n<h2>\n	Science</h2>\n<p>\n	Science at Highclare is studied in five well equipped and purpose built laboratories. The emphasis is &lsquo;achieving individual excellence&rsquo; through varied and motivating approaches to the curriculum. Our department&rsquo;s external examination results are testament to the success of this approach&nbsp; - in 2011 our Year 10 students gained 100% pass rate at GCSE with 100% getting A* to C grades, and 66% getting A* to B grades (a year earlier than would normally be expected,) in their January Science GCSE unit paper.\n</p>\n<p>\n</p>\n<p>\n	General science is taught in year 7 but from year 8 upwards the pupils study separate Biology, Chemistry and Physics. Taught by subject specialists, through GCSE and on to Sixth Form pupils are engaged with interesting, exciting and relevant practical lessons. In the Sixth Form, Psychology is also an option.\n</p>\n','published',88,89,'2012-03-13 09:58:47',NULL),(46,1,'Diary Dates','/diary-dates','<h1>\n	Diary Dates</h1>\n<h2>\n	SKI TRIP 2012</h2>\n<p>\n</p>\n<p>\n	This year&#39;s ski trip to Wagrain in Austria was a great success.\n</p>\nThe students and teachers returned to school safely, having spent half term on the slopes in fabulously snowy conditions. For many of the group it was their first experience of skiing.\n<h2>\n	ANNUAL SPEECH DAY 2011</h2>\n<p>\n	Senior Speech Night was a huge success. Our guest speaker, Mrs Kym Jones, a former pupil of Highclare spoke with real passion and enthusiasm about her role as a Landscape Architect.\n</p>\n<p>\n	The Senior School Choirs gave an excellent rendition of &ldquo;Adiemus&rdquo; by Karl Jenkins which raised the roof at the end of the evening.&nbsp; The pupils were a credit to the school and to their parents and we were very proud of them all.\n</p>\nAs this academic year leads us towards the Olympic Games being held in London it seems fitting that, in the true spirit of the Olympic movement, our pupils will be &lsquo;Going for Gold&rsquo;.','published',90,91,'2012-03-13 09:59:52',NULL),(47,1,'The School Day','/school-day','<h1>\n	The School Day</h1>\n<p>\n	School Day begins at 8.35 am - registration closes at 8.40 am\n</p>\n<p>\n	Lunch period: 12.30 pm to 1.30 pm\n</p>\nSchool Day finishes at 3.30 pm\n<p>\n	Session 7 is a 30 minute session which on Tuesdays and Thursdays includes a variety of Enrichment activities for Years 7 and 8 and curriculum lessons for Years 9, 10 and 11.\n</p>\nAssemblies and form time take place on Monday, Wednesday and Friday and include House Assemblies, Music Assemblies, Sixth Form led Assembly, Full School Assembly, House Challenges and Merit Achievement Assemblies.\n<p>\n	The School is multi faith and recognises all cultural celebrations.\n</p>\n','published',92,93,'2012-03-13 10:00:59',NULL),(48,1,'Clubs','/clubs','<h1>\n	Clubs</h1>\n<p>\n	For the Senior pupils a variety of Clubs take place outside lesson time - availability varies during each academic year.\n</p>\n<p>\n	Some of the clubs available are:\n</p>\n<ul>\n	<li>Fencing Club</li>\n	<li>Athletics Club</li>\n	<li>Drama Club</li>\n	<li>Public Speaking</li>\n	<li>Senior Choir</li>\n	<li>Concert Band</li>\n	<li>Clarinet Group</li>\n	<li>Flute Choir</li>\n	<li>Chamber Choir</li>\n	<li>Film Club</li>\n	<li>I.T. Club</li>\n	<li>Trampolining</li>\n	<li>Gymnastics</li>\n	<li>Badminton</li>\n	<li>Tennis</li>\n</ul>\n<p>\n	The choice will vary and students can make their views known via the School Council which meets regularly and is overseen by the Head Girl and Head Boy.\n</p>\n','published',94,95,'2012-03-13 10:01:48',NULL),(49,1,'Sports','/sports','<h1>\n	Sports</h1>\n<p>\n	Highclare Senior School Brings Unparalleled Levels Of Performance From Its Pupils In A Wide Range Of Sports Including, Netball, Hockey, Swimming, Athletics, Cross Country, Gymnastics, And Has Recently Added Golf And Tennis To The List.\n</p>\n','published',96,97,'2012-03-13 10:02:44',NULL),(50,1,'Music & Drama','/music-and-drama','<h1>\n	Music &amp; Drama</h1>\n<p>\n	Not everyone is an enthusiastic athlete and Highclare offers numerous opportunities for the arts in Music &amp; Drama. Success is regularly achieved in the highly acclaimed LAMDA examinations in Performing arts and pupils regularly receive Distinctions and Gold Medals. Examinations are held twice a year.&nbsp; In music enthusiastic staff encourage even the most retiring musicians to take part in regular Choirs, Orchestras and Windbands\n</p>\n<p>\n	The Music &amp; Drama Departments join together on a regular basis to give performances in the Senior school Concerts, Carol Service and Dramatic Productions. The highlight of the Summer term is the Senior School performance. In 2010 a musical performance of &#39;The Wiz&#39;, an adaptation of the Wizard of Oz, was performed on two nights for parents and friends and was a huge success.\n</p>\n<p>\n	In 2011 the pupils performed in an equally successful performance of &#39;The Tempest&#39; by William Shakespeare.\n</p>\n<p>\n	The school employs a large number of Peripatetic Music Teachers who teach pupils on a variety of instruments on a one to one basis within school. The range of instruments offered is extensive, from the very popular, piano and keyboard lessons, a large range of brass and wind instuments and string instruments, including guitar and ukelele. Drum lessons are given using the schools own drum kit.\n</p>\n<p>\n</p>\n<h3>\n	Music Examination Results</h3>\n<p>\n	There were excellent results from many pupils taking ABRSM and LCM music examinations, including pupils reaching the demanding levels of grades 7 and 8.\n</p>\n<p>\n</p>\n<h4>\n	Lamda Examination Results</h4>\n<p>\n	Excellent results were achieved from all pupils in the senior school taking examinations in verse and prose, speaking, acting etc. with most students receiving grades of merit or distinction.\n</p>\n','published',98,99,'2012-03-13 10:10:55',NULL),(51,1,'Sixth Form','/sixth-form','<h1>\n	Sixth Form</h1>\n<p>\n	Highclare School provides an open access Sixth Form for Girls and Boys aged 16 - 19 years. They are offered an academically demanding but supportive environment catering for the needs of each student in order to Achieve Individual Excellence. This, combined with personal development, guarantees progression to Higher Education for the majority of Highclare&#39;s students.\n</p>\n<p>\n</p>\n<p>\n	Students have the choice of over 20 subjects for AS and A2 study with the majority of students taking 4 &#39;AS&#39; subjects in Lower 6th followed by 3 &#39;A2&#39; subjects in Upper 6th with the additional option of either AS or A2 General Studies.\n</p>\n<p>\n	Students may also choose vocational courses in Business or in Health and Social Care as one or two of their subjects, other options such as GCSE Spanish can also be linked with these to create a more dynamic course.\n</p>\n<p>\n	Highclare maintains small tutoring groups giving each student the maximum amount of individual attention which when combined with private ICT suites, study rooms and their own personal tutors, students can manage both their time and work effectively.\n</p>\n<p>\n	Excellent transport links mean that the School is just 15 minutes from the heart of Birmingham city centre and 10 minutes from Sutton Coldfield by train. Secure on site parking is also available for students travelling in from further afield.\n</p>\n<p>\n	All students are encouraged to participate in wider local community projects and can allocate up to 2 hours of weekly study time to this, gaining not just academic experience but life experience too.\n</p>\n<p>\n	Scholarships are available for entry into the 6th form at Highclare School.\n</p>\n<p>\n	Please ask the admissions office for details. The Sixth Form Scholarship Exam takes place in January, for entry to the school in September the same year.\n</p>\n','published',101,108,'2012-03-13 10:12:46',NULL),(52,1,'School Life','/school-life','<h1>\n	School Life</h1>\n<p>\n	All students joining Highclare School Sixth Form enjoy the privilege of having their own suite of rooms in The Abbey building and Study rooms are available to enable students to manage their time effectively.\n</p>\n<p>\n	Students are encouraged to get involved with fund raising events and appropriate community service.\n</p>\n<p>\n	All members of the Sixth Form will be expected to undertake the responsibilities of being Prefects and to behave maturely and to set a good example to pupils lower down the school.\n</p>\n<p>\n	Opportunities exist for leadership as Head Girl and Head Boy, Deputies and House Captains. These roles provide training and experience for students and enhance their application for Higher Education.\n</p>\n<p>\n	Highclare Sixth Formers adhere to a smart Sixth Form Dress Code. They may drive their own cars to school and they have other privileges within the school.\n</p>\n<h2>\n	Sixth Form Visit To Wolverhampton University</h2>\nLower and Upper Sixth pupils studying Biology will be visiting specialist research laboratories at Wolverhampton University during the Autumn term.\n<p>\n	A lot of the A Level Biology curriculum is based on modern technology that is beyond the reach of any school or college laboratory and some equipment required for experiments can cost a five or six-figure sum, and indeed the experiments themselves can last for weeks. &nbsp;As a result, many Sixth Formers never have the opportunity to engage with these experiments and enhance their field of study.&nbsp; At Highclare Sixth Form students will have this opportunity during their visit to Wolverhampton University.\n</p>\nThe trip will coincide with a University Open Day, so university lecturers and students will be available to answer questions about related degree courses.&nbsp; As part of this, various medical and scientific activities will be available for pupils.\n<p>\n	This event has been organised for the last few years, and pupils have found it to be very successful, enjoyable and informative.\n</p>\n','published',102,103,'2012-03-13 10:16:25',NULL),(53,1,'Subjects','/subjects','<h1>\n	Subjects</h1>\n<ul>\n	<li>Art&nbsp;&nbsp;&nbsp;</li>\n	<li>Biology&nbsp;&nbsp;&nbsp;</li>\n	<li>Chemistry&nbsp;&nbsp;&nbsp;</li>\n	<li>English Literature&nbsp;&nbsp;&nbsp;</li>\n	<li>French&nbsp;&nbsp;&nbsp;</li>\n	<li>German&nbsp;&nbsp;&nbsp;</li>\n	<li>General Studies&nbsp;&nbsp;&nbsp;</li>\n	<li>Geography&nbsp;&nbsp;&nbsp;</li>\n	<li>History&nbsp;&nbsp;&nbsp;</li>\n	<li>Home Economics&nbsp;&nbsp;&nbsp;</li>\n	<li>ICT&nbsp;&nbsp;&nbsp;</li>\n	<li>Law&nbsp;&nbsp;&nbsp;</li>\n	<li>Mathematics&nbsp;&nbsp;&nbsp;</li>\n	<li>Music&nbsp;&nbsp;&nbsp;</li>\n	<li>Physics&nbsp;&nbsp;&nbsp;</li>\n	<li>Psychology&nbsp;&nbsp;&nbsp;</li>\n	<li>Sociology&nbsp;&nbsp;&nbsp;</li>\n	<li>Religous Studies&nbsp;&nbsp;&nbsp;</li>\n	<li>Applied Business (single or double)&nbsp;&nbsp;&nbsp;</li>\n	<li>Applied Health &amp; Social Care (single or double)</li>\n	<li>Spanish (GCSE)</li>\n</ul>\n','published',104,105,'2012-03-13 10:17:36',NULL),(54,1,'Results','/results','<h1>\n	Results</h1>\n<h2>\n	EXCELLENT RESULTS FOR 2011</h2>\n<p>\n	Overall 100% Pass Rate Again, With <strong>20% at A*and A</strong>\n</p>\n<strong>78%</strong> At A* - C And <strong>54%</strong> At A* - B\n<p>\n	One Pupil Gained 4A* Or A Grades - See Our News Story On The News Pages\n</p>\n<p>\n</p>\n<h2>\n	External Examination Results - Summer 2010</h2>\n<h4>\n	&lsquo;A&rsquo; Level</h4>\nOverall 100% pass rate at A2: 76% at A*, A &amp; B grades&nbsp; and 90% at A* - C grades.\n<p>\n	One pupil gained 4 A* grades and another 5 A* &amp; A grades.\n</p>\n<h4>\n	&lsquo;AS&rsquo; Level</h4>\n<p>\n	92% pass rate<br />\n	52% at A &ndash; C grades\n</p>\n<h2>\n	External Examination Results - Summer 2009</h2>\n<h4>\n	&lsquo;A&rsquo; Level</h4>\n<p>\n	Overall 100% Pass Rate, 75% At A &amp; B Grades<br />\n	87.5% A - C Grades\n</p>\n<h4>\n	&lsquo;AS&rsquo; Level</h4>\n<p>\n	Overall 97% pass rate<br />\n	77% being at A - C grades\n</p>\n','published',106,107,'2012-03-13 10:19:37',NULL),(55,1,'Results','/results','Latest Examination Results 2011\n<p>\n	A Level\n</p>\nOverall 100% Pass At A2\n<p>\n	78% A* To C Grades And 54% A* To B Grades\n</p>\n************\n<p>\n	AS Level\n</p>\n87% Pass Rate\n<p>\n	45% At A- C Grades\n</p>\nGCSE\n<p>\n	Overall 100% Pass - 97% A* To C Grades\n</p>\nA* To B 83% And A* &amp; A Grades 52%\n<p>\n	Congratulations To All Our Pupils\n</p>\n***********************************\n<p>\n	External Examination Results - Summer 2010\n</p>\n&lsquo;A&rsquo; Level<br />\nOverall 100% Pass Rate, 76% At A*, A &amp; B Grades<br />\n90% A - C Grades\n<p>\n	<br />\n	&lsquo;AS&rsquo; Level<br />\n	Overall 92% Pass Rate<br />\n	52% Being At A - C Grades\n</p>\n<br />\nG.C.S.E.<br />\nOverall 100% Pass Rate With 95% Of Passes At A* To C Grades&nbsp;&nbsp;&nbsp;\n<p>\n	78% Of Passes At A*, A And B Grades &amp; 46% A* And A Grades&nbsp;\n</p>\n100% Of Pupils Gained 5 Or More Passes At Grades A* - C<br />\n&nbsp;&nbsp;&nbsp;\n<p>\n	IN YEAR 10 , Girls Gained 100% Pass Rate In Science, 97% A* To C Grades And 78% A* To B Grades&nbsp;&nbsp;\n</p>\nPupils At Highclare Do Not Take A GCSE In IT And These Results, Therefore, Do Not Include This Subject. Pupils Take The CLAIT Examination In IT, And Then Follow This, By The End Of Year 11, With The Full 8 Modules Of The Business Qualification Known As ECDL(European Computer Driving Licence), Giving Them An Excellent Background In All Aspects Of IT. Both These Qualifications Are Well Respected By All Employers. This Year All Girls Took The European Computer Driving License, With 91% Achieving The Level 2 Qualification (Equivalent To A Full Course GCSE).&nbsp;<br />\n<p>\n	***************************************\n</p>\n&nbsp;\n<p>\n	External Examination Results - Summer 2009<br />\n	&lsquo;A&rsquo; Level<br />\n	Overall 100% Pass Rate, 75% At A &amp; B Grades<br />\n	87.5% A - C Grades\n</p>\n<br />\n&lsquo;AS&rsquo; Level<br />\nOverall 97% Pass Rate<br />\n77% Being At A - C Grades&nbsp;\n<p>\n	<br />\n	G.C.S.E.<br />\n	Overall 100% Pass Rate With 98% Of Passes At A* To C Grades:- 82% Of Passes At A*, A And B Grades &amp; 56% A* And A Grades\n</p>\n<p>\n	100% Of Pupils Gained 5 Or More Passes At Grades A* - C<br />\n	IN YEAR 10 , Girls Gained 100% Pass Rate In Science, 100% A* To C Grades And 81% A* To B Grades\n</p>\n<p>\n	<br />\n	***************************************\n</p>\nJUNIOR BOYS AND GIRLS&nbsp;\n<p>\n	11+ PLACES AWARDED FOR SEPTEMBER 2011\n</p>\nWe Are Awaiting Final Confirmation Of Places Gained For September 2011','published',109,112,'2012-03-13 10:20:06',NULL),(56,1,'Ofsted Reports','/ofsted-reports','<h1>\n	Ofsted Reports</h1>\n','published',110,111,'2012-03-13 10:21:10',NULL),(57,1,'PTA','/pta','<h1>\n	PTA</h1>\n<p>\n	The main purpose of our Parent Teacher Association is to promote fundraising and social interaction across the school&#39;s three sites. For those parents new to the school, Highclare has an active PTA, which prides itself in the support it gives to the school. We have a committee that meets once a month to organise the various events and a number of parents who offer their help at the functions such as the Christmas Fayre. The PTA is also well supported by members of the staff who help in the running of the regular discos and functions that we hold.\n</p>\n<p>\n	The PTA has aimed to raise money to help with new video equipment and playground resources, for all three Highclare School sites and this has been achieved by holding many varied activities, including children&#39;s discos, dinners and dances, a family quiz night, school fayres and a theatre trip.\n</p>\n<p>\n	Details of the current PTA programme and booking forms are to be found in the parents section of this web-site on the &quot;messages and PTA&quot; page. Should you require any details about the PTA or how you could become a Friend of the PTA and help at the major functions, please email Tracie Bedwood, via the pta email: <a href=\"mailto:pta@highclareschool.co.uk\">pta@highclareschool.co.uk</a>\n</p>\n<h2>\n	Second Hand Uniform Sales</h2>\nThe PTA runs a very successful second hand uniform shop. Lots of items arrive in excellent condition and represent a superb value for money purchase. Sales are generally held once a month. Please ask at the school office for the forthcoming dates. They are now held at the Senior School site at Highclare The Abbey, 10 Sutton Road, Erdington, usually from 2.30 pm to 4.30 pm.\n<p>\n	Forthcoming sale dates are:\n</p>\n<ul>\n	<li><strong>Tuesday 20th March</strong> ~ 2.30pm to 4.30pm</li>\n	<li><strong>Tuesday 24th April</strong> ~ 2.30pm to 4.30pm</li>\n	<li><strong>Tuesday 22nd May</strong> ~ 2.30pm to 4.30pm</li>\n	<li><strong>Tuesday 26th June</strong> ~ 2.30pm to 4.30pm</li>\n</ul>\n<p>\n	If you have uniform to donate to the PTA for sale, please bring it into the school office.\n</p>\n<h2>\n	Quiz Night - February</h2>\n<p>\n	The Quiz night at St Paul&rsquo;s was a huge success.&nbsp; We all got very competitive and the Fish &lsquo;N&rsquo; Chip Supper went down a treat. Jon, The Quiz Master, put together some very challenging questions. The Quiz was won by the&nbsp; &lsquo;Slightly Foxed&rsquo; team.&nbsp; They were on a winning streak that night, as they also won 2 of the raffle prizes!\n</p>\nThank you to everyone who came along and supported the evening.\n<h2>\n	Christmas Discos</h2>\nThe Christmas Discos were a huge success and the Senior Boys and Girls really enjoyed their first ever Senior Disco.\n<p>\n	Thank you to everyone that volunteered to help out on the night at each site and helped towards making the event successful.\n</p>\n<h2>\n	Summer Carnival</h2>\n<p>\n	This year the Highclare PTA Summer Fete was held at Highclare Woodfield, with a Carnival theme. The children enjoyed lots of activities and Mums and Dads, Grandparents and friends all joined in the fun.\n</p>\n<h2>\n	PTA Quiz Evening</h2>\n<p>\n	Strong competition and a keen sense of fun prevailed at our recent Quiz Night, held in the Gym at Sutton Road site. A great evening of fun and fellowship ended with a handsome profit for PTA funds and a very excited winning team.\n</p>\n<h2>\n	Fundraising</h2>\n<p>\n</p>\n<p>\n	<strong>This Year The PTA Are Going To Be Raising Money To Buy A New 17 Seater Minibus That Will Be Used By All 3 Sites To Take Children On School Trips And School Events.</strong>\n</p>\nThe Target Is &pound;20,000 Which We Aim To Achieve By The End Of 2012.\n<p>\n	We have already raised a substantial amount towards this from The Summer Ball, Bonfire Night, The Christmas Fayre, Christmas Discos and the PTA Quiz Night. With all the other events that we have planned between now and December 2012 we feel that this target is achievable, with the continued support of all the pupils and parents.\n</p>\nThe PTA team is growing and we have lots of ideas buzzing around at the moment for exciting events that we are planning. We would welcome any new parents on board so if you have some ideas for fundraising events please get in touch. We are a very friendly, welcoming committee and we do have fun planning and attending the events.\n<p>\n	So far we have booked in The Summer Fair, Gig Night for the Seniors, School Ball and many more. We will be publishing Events and Dates on the Website and in the Newsletter after half term.\n</p>\nWe will be placing Target Boards in Woodfield, St Paul&rsquo;s and the Abbey and on the website, so you can keep an eye on how much we are raising towards our &pound;20,000 Target.','published',113,116,'2012-03-13 12:38:08','2012-03-21 11:24:56'),(58,1,'Diary Dates','/diary-dates','dates','published',114,115,'2012-03-13 12:41:06',NULL),(59,1,'TOPS','/tops','<h1>\n	TOPS</h1>\n<p>\n	TOPS covers term time and most holidays and is our Extended Day and Holiday Scheme\n</p>\n<h2>\n	TOPS Term Time</h2>\nTOPS has been set up to support busy parents / guardians by providing a stimulating and creative environment. The children enjoy the after school activities and many pupils use this facility from Kindergarten upwards.\n<p>\n	TOPS provides cover from 7.30 am to 6.00 pm in term time.\n</p>\nAt the end of the school day the children relax and play outdoors whenever possible. During the sessions older children have the opportunity to do their homework, while younger children are encouraged to take part in activities and crafts. These activities are based on a theme which is regularly changed and designed to encourage creative skills to provide new learning opportunities. Quiet resting time is available for those who need it\n<p>\n	TOPS is offered on all sites. If children have brothers or sisters on other sites, arrangements can be made to transport the older children to the site of their younger sibling.\n</p>\n<strong>Morning Session</strong><br />\n7.30 - 8.30 am - available at Woodfield and St Paul&#39;s<br />\nChildren from The Abbey who need this provision attend Woodfield<br />\nand travel to The Abbey on the school bus.\n<p>\n	<strong>Afternoon Session 1</strong><br />\n	End of school - 4.45 pm - available on all sites\n</p>\n<strong>Afternoon Session 2</strong><br />\n4.45 - 6.00 pm - available on all sites\n<p>\n	School tea can be ordered which consists of sandwiches, fruit or desert, or &#39;hot&#39; tea, e.g. baked beans on toast. Pupils may bring their own tea if preferred. Children not requiring tea will be given a drink and a biscuit.\n</p>\n<h2>\n	TOPS Holiday Scheme</h2>\n<p>\n	TOPS operates during all school holidays with the exception of Bank Holidays. It is usually based at Woodfield and is available for pupils from all three sites.\n</p>\nThis is a care scheme suitable for children from Kindergarten to J6. A whole range of activities is organised including some visits off site. Details are circulated regularly.\n<p>\n	TOPS Holiday sessions can be booked prior to each school holiday and a timetable of activities for each holiday scheme is available through the school.\n</p>\n','published',117,120,'2012-03-21 11:26:42','2012-03-21 11:43:35'),(60,1,'Diary Dates','/diary-dates','<h1>\n	Diary Dates</h1>\n','published',118,119,'2012-03-22 16:18:42',NULL),(61,1,'Downloads','/downloads','<h1>\n	Downloads</h1>\n<ul>\n	<li>1</li>\n	<li>2</li>\n	<li>3</li>\n</ul>\n','published',121,130,'2012-03-22 16:19:19',NULL),(62,1,'General','/general','1','published',122,123,'2012-03-22 16:26:54',NULL),(63,1,'Policies','/policies','2','published',124,125,'2012-03-22 16:27:07',NULL),(64,1,'Forms','/forms','3','published',126,127,'2012-03-22 16:27:22',NULL),(65,1,'eSafety','/esafety','4','published',128,129,'2012-03-22 16:27:44',NULL),(66,1,'Contact Us','/contact-us','<widget contenteditable=\"false\" method=\"form\" module=\"contact\">[C3 Contact Form]</widget>\n','published',131,134,'2012-03-22 16:28:02',NULL),(67,1,'Maps & Locations','/maps-and-locations','Maps','published',132,133,'2012-03-22 16:28:21',NULL),(68,1,'Legal','/legal','Legal','published',135,142,'2012-03-22 16:28:35',NULL),(69,1,'Copyright','/copyright','Copyright','published',136,137,'2012-03-22 16:28:51',NULL),(70,1,'Terms of Use','/terms-of-use','Terms of Use','published',138,139,'2012-03-22 16:29:05',NULL),(71,1,'Privacy Policy','/privacy-policy','Privacy Policy','published',140,141,'2012-03-22 16:29:23',NULL);
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission` (
  `permission_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `permission_key` varchar(32) NOT NULL,
  `permission_module` varchar(16) DEFAULT NULL,
  `permission_description` text,
  PRIMARY KEY (`permission_id`),
  UNIQUE KEY `permission_key` (`permission_key`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES (1,'PAGE_VIEW','page','Can view standard pages.'),(2,'PAGE_VIEW_PROTECTED','page','Can view protected pages.');
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `product_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `product_user_id` mediumint(8) unsigned NOT NULL,
  `product_category_id` mediumint(8) unsigned NOT NULL,
  `product_code` varchar(32) DEFAULT NULL,
  `product_name` varchar(128) NOT NULL,
  `product_slug` varchar(128) NOT NULL,
  `product_description` text,
  `product_specification` text,
  `product_price` decimal(7,2) unsigned NOT NULL DEFAULT '0.00',
  `product_enabled` tinyint(1) unsigned NOT NULL,
  `product_date_created` datetime NOT NULL,
  `product_date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_category` (
  `category_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(128) NOT NULL,
  `category_slug` varchar(128) NOT NULL,
  `category_left` mediumint(8) unsigned NOT NULL,
  `category_right` mediumint(8) unsigned NOT NULL,
  `category_date_created` datetime NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `category_slug` (`category_slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_category`
--

LOCK TABLES `product_category` WRITE;
/*!40000 ALTER TABLE `product_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_related`
--

DROP TABLE IF EXISTS `product_related`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_related` (
  `related_parent_id` mediumint(8) unsigned NOT NULL,
  `related_child_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`related_parent_id`,`related_child_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_related`
--

LOCK TABLES `product_related` WRITE;
/*!40000 ALTER TABLE `product_related` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_related` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting` (
  `setting_key` varchar(32) NOT NULL,
  `setting_module` varchar(16) DEFAULT NULL,
  `setting_value` varchar(255) NOT NULL,
  PRIMARY KEY (`setting_key`),
  KEY `setting_module` (`setting_module`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` VALUES ('seo_block_robots',NULL,'1'),('gateway_class','gateway','Sagepay'),('gateway_sagepay_vendor','gateway','technical9'),('gateway_encryption_key','gateway','g9hVBEtzkPa2wHp0'),('gateway_sagepay_endpoint','gateway','SIMULATOR'),('gateway_sagepay_transaction_type','gateway','PAYMENT'),('gateway_order_format','gateway','%-.3s-%06d'),('gateway_order_stub','gateway','zANUBIS'),('cart_guest_checkout','cart','1'),('news_categories_enabled','news','SINGLE');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `transaction_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_order_id` mediumint(8) unsigned NOT NULL,
  `transaction_code` varchar(10) NOT NULL,
  `transaction_user_id` mediumint(8) unsigned NOT NULL,
  `transaction_status` enum('pending','success','failure') NOT NULL,
  `transaction_amount` decimal(7,2) unsigned NOT NULL,
  `transaction_match_cv2` enum('UNKNOWN','NOTPROVIDED','NOTCHECKED','MATCHED','NOTMATCHED') NOT NULL,
  `transaction_match_address` enum('UNKNOWN','NOTPROVIDED','NOTCHECKED','MATCHED','NOTMATCHED') NOT NULL,
  `transaction_match_postcode` enum('UNKNOWN','NOTPROVIDED','NOTCHECKED','MATCHED','NOTMATCHED') NOT NULL,
  `transaction_3dsecure_status` varchar(50) DEFAULT NULL,
  `transaction_3dsecure_cavv` varchar(32) DEFAULT NULL,
  `transaction_card_type` varchar(15) DEFAULT NULL,
  `transaction_card_ending` char(4) DEFAULT NULL,
  `transaction_gateway_status` varchar(20) DEFAULT NULL,
  `transaction_gateway_details` text,
  PRIMARY KEY (`transaction_id`),
  KEY `transaction_order_id` (`transaction_order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_email` varchar(80) NOT NULL,
  `user_password` char(64) NOT NULL,
  `user_firstname` varchar(32) NOT NULL,
  `user_lastname` varchar(32) DEFAULT NULL,
  `user_company` varchar(80) DEFAULT NULL,
  `user_telephone` varchar(12) DEFAULT NULL,
  `user_marketing` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_administrator` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_date_created` datetime NOT NULL,
  `user_date_lastseen` datetime DEFAULT NULL,
  `user_recovery` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'technical@creativeinsight.co.uk','b004e9b6d82ad6d51a8832cd33c776164ea4874d4504e0405be051c9098f7ca0','Creative','Insight',NULL,NULL,1,1,'2011-10-25 17:21:09','2012-01-19 17:12:21',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_group` (
  `link_user_id` mediumint(8) unsigned NOT NULL,
  `link_group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`link_user_id`,`link_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group`
--

LOCK TABLES `user_group` WRITE;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-03-22 16:40:17
