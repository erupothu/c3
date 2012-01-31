-- MySQL dump 10.13  Distrib 5.5.19, for Linux (i686)
--
-- Host: localhost    Database: anubis
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
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `group_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(64) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` VALUES (1,'Users'),(2,'Authorised Users'),(3,'Moderator (Training & Ops)'),(4,'Moderator (Special Products)'),(5,'Administrator');
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
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
  KEY `news_author_id` (`news_author_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,2,'50 Certified Security Consultants (CSCs)','50-certified-security-consultants-cscs',NULL,'<p>\n	Anubis is very pleased to announce that following the recent graduation of another five students who have successfully completed the Certified Security Consultant (CSC) programme, the half century mark of individuals holding this Level 5 certification has now been reached. The CSC qualification was recently re-accredited and now attracts 80 Higher Education Credits at Level 5, thereby offering students an increasingly worthwhile stand-alone qualification, or one which allows them to proceed onto further studies including the Bucks New University BA (Hons) in Security Consultancy due for launch in early 2012.</p>\n','2012-01-24 13:35:10',NULL,'2012-01-24 13:35:10'),(2,1,'Changes to the Certified Security Consultant’s Programme','news-article-1',NULL,'<p>\n	Anubis is very pleased to announce that following a series of changes to the content and delivery of the Certified Security Consultant&rsquo;s programme, the certification has recently been revalidated by Buck&rsquo;s New University and successful students will now receive a Level 5 Award worth 80 Higher Education Credits. We believe that this is an accurate assessment of the worth of the certification and reflects the nature and amount of work involved in successfully completing the CSC programme. The changes to the value of the certification are not retrospective and will only apply to students from the current intake and all subsequent courses.</p>\n','2012-01-24 13:36:03','2012-01-31 11:47:57','2011-07-01 13:36:03'),(3,1,'Anubis approved as City & Guilds centre','news-article-2',NULL,'<p>\n	Anubis Associates Ltd are very pleased to announce that we have recently been approved as a City &amp; Guilds Centre. We will shortly publish dates for the delivery of City &amp; Guilds professional qualifications for individuals working in the security sector.</p>\n','2012-01-24 13:36:16','2012-01-31 11:47:32','2011-07-01 13:36:16'),(4,2,'New Appointment - Alex Sinclair','new-appointment-alex-sinclair',NULL,'<h2>\n	Training and Operations Manager - Alex Sinclair</h2>\n<p>\n	Alex Sinclair joined Anubis in May 2011 as Training and Operations Manager. Prior to joining Anubis Alex amassed considerable commercial security experience - much of this focused on enabling business to take place under challenging conditions in high-threat areas. As an independent security contractor he has used his highly developed security management skills to assist his clients to mitigate risk for over 16 years. This has included the organisation, supervision and training of close protection/PSD teams in Algeria, Singapore, Iraq and Pakistan.</p>\n<p>\n	&nbsp;</p>\n<p>\n	Before entering the commercial security sector Alex completed 22 years military service, 15 of which were with 22 Special Air Service Regiment. during his military career Alex was responsible for researching, preparing and delivering training activities on all aspects of VIP protection. This included advising on the training and deployment of specialist groups to enhance the protective effort - such as counter-surveillance, counter-attack and counter-sniper support. He was responsible for the raising, training and deployment of several such groups in South America and the Far East for government and diplomtic protection groups.</p>\n<p>\n	Alex has presented briefings at levels up to and including Cabinet level in the UK and to head-of-state level elsewhere. On behalf of UK government agencies he has carried out staff audits, threat assessments, close protection and other training at various locations worldwide, including British embassies in a number of high risk locations.</p>\n<p>\n	&nbsp;</p>\n<p>\n	In addition to training and protecting at the highest levels, Alex has a strong personal interest in the safety and security of the individual. He has carried out tasks involved in the safety and training of undercover software-piracy investigators, journalists, expatriate executives and their familes and others at risk of conflict in the workplace and associated violence.</p>\n','2012-01-24 13:39:12','2012-01-24 14:00:17','2012-01-24 13:39:12'),(5,1,'New Accreditations','news-article-3',NULL,'<p>\n	We are pleased to announce that Anubis Associates Ltd has sucessfully gained certification in ISO 9001:2008, Quality Management Standard and ISO 14001:2004, Environmental Management Standard (EMS). Achieving this accreditation shows our commitment to quality, customer and a willingness to work towards improving efficiency.</p>\n','2012-01-24 13:59:23','2012-01-31 11:48:26','2011-06-01 13:59:23'),(6,1,'Anubis to Offer High Level Insurance','news-article-4',NULL,'<p>\n	Anubis are pleased to announce that in conjunction with Ellis Clowes we are able to offer high level insurance to individuals who have attended and passed an Anubis certificated training course. AAL believe that the correct insurances and indemnities (from rated insurers) are vital to protect clients and their consultants.</p>\n','2012-01-24 14:00:00','2012-01-31 11:48:55','2010-11-01 14:00:00'),(7,2,'New Appointment - Trevor Brealy','new-appointment-trevor-brealy',NULL,'<h2>\n	Business Development Executive - Trevor Brealy</h2>\n<p>\n	Anubis is pleased to welcome Trevor Brealy to Anubis Associates Limited as Business Development Executive. Trevor will concentrate on developing and implementing the business strategy for the company&#39;s expansion in the Middle East.</p>\n<p>\n	Trevor joins Anubis from VT/Babcock where he held the position of Regional Business Development Executive based in Kuwait for 7 years. Prior to this Trevor worked as a Bid Manager for VT Group working as part of a large bid team working on Government contracts in the UK and Kuwait. During his career Trevor has also worked in Dubai, Indonesia, Chile and Bosnia as an overseas engineer.</p>\n<p>\n	Stuart Anderson, Anubis&#39;s Managing Director said he was delighted with Trevor&#39;s appointment as it will enable Anubis to expand in the Middle East which will significantly strengthen our position in the Security Industry.</p>\n','2012-01-24 14:01:15',NULL,'2012-01-24 14:01:15'),(8,1,'More Anubis Courses due to Demand','news-article-5',NULL,'<p>\n	Due to an increasing demand for our advertised training programmes, we have decided to increase the number of Anubis courses available throughout 2011. The new training dates have now been released and can be viewed on the &#39;Training - Courses&#39; section of our company website.</p>\n','2012-01-24 14:01:33','2012-01-31 11:49:25','2010-07-01 14:01:33'),(9,1,'Bespoke Course for Central London HE','news-article-6',NULL,'<p>\n	Anubis are currently delivering a bespoke security training course including ground-breaking criminal detection techniques to all the security staff employed at a Central London higher education institution. Feedback from the first two courses has been outstanding and their crime detection and arrest rates are increasing.</p>\n','2012-01-24 14:01:43','2012-01-31 11:49:52','2010-04-01 14:01:43'),(10,1,'CTP Extends Partnership','news-article-7',NULL,'<p>\n	The Career Transition Partnership (CTP) extend their partnering agreement with Anubis for the continuation of their in-house security training for the benefit of Service Leavers from the Armed Forces throughout 2010.</p>\n','2012-01-24 14:01:53','2012-01-31 11:50:10','2009-09-01 14:01:53'),(11,1,'David Seaton Appointed as Chairman','news-article-8',NULL,'<p>\n	Anubis are pleased to announce the appointment of David Seaton as Chairman of the Executive Board. For the last fifteen months Dave has worked closely with Anubis in his capacity as Board Advisor, and this arrangement has now been formalised to support the company moving forward. Stuart Anderson, Managing Director said &lsquo;I am delighted to welcome Dave to the Board. Over the last year or so he has been a valuable asset to the company advising on our growth strategy and further establishing Anubis in a strong market position. We feel that Dave will be integral to the continuing growth and strategic development of the company over the coming years, whilst maintaining the high quality services that Anubis has built its reputation on.</p>\n','2012-01-24 14:02:05','2012-01-31 11:50:51','2009-07-01 14:02:05'),(12,1,'Anubis to Sponsor Security Networking Events Exhibition','news-article-9',NULL,'<p>\n	Anubis Associates Ltd are pleased to announce that we will be&nbsp; sponsoring&nbsp; the Security Networking Events Exhibition and our Risk Management Director Richard (Ginge) Johnson will be attending as a Specialist Guest Speaker. The event will be held at&nbsp; the Victory Services Club, London on the 2nd September 2009 (8.30am &ndash; 6.00 pm) <a href=\"http://www.securitynetworkingevents.co.uk/\" target=\"_blank\">http://www.securitynetworkingevents.co.uk/</a>.</p>\n','2012-01-24 14:02:33','2012-01-31 11:50:33','2009-07-01 14:02:33'),(13,1,'New Guide for Armed Service Leavers','news-article-10',NULL,'<p>\n	The British Security Industry Association (BSIA) and the Career Transition Partnership (CTP) have just published a new guide for armed service leavers to careers in the private security industry. The Anubis Close Protection (CP) and Certified Security Consultant (CSC) Security Courses feature prominently, and as the only private security company in the UK to be endorsed and recommended by the CTP as their &#39;in-house&#39; training provider we are pleased to be associated with this publication. The guide can be viewed at : <a href=\"http://www.bsia.co.uk/web_images/publications/ctp_careers_booklet_pdf_27JAN09.pdf\">http://www.bsia.co.uk/web_images/publications/ctp_careers_booklet_pdf_27JAN09.pdf</a></p>\n','2012-01-24 14:02:55','2012-01-31 11:51:11','2009-04-01 14:02:55'),(14,1,'Anubis supply Guardforce Security Ltd','news-article-11',NULL,'<p>\n	Anubis have just provided nine Security Industry Authority (SIA) licensed Close Protection Operatives (CPO&rsquo;s) to the operational Close Protection company <a href=\"http://www.guardforcesecurity.co.uk/\">Guardforce Security Ltd</a> who deliver high quality security services throughout the UK and Europe. Richard &lsquo;Ginge&rsquo; Johnson explained that this has allowed Anubis Close Protection graduates to enter the private security industry with a SIA approved contractor that is working at the forefront of the Close Protection industry. Warren Jones Director of Guardforce Security Ltd was delighted with the outcome of this recruitment day stating &lsquo;the aim is to recruit SIA Licensed staff that are trained to the highest standard by experts in the field of Close Protection with operational experience from diverse backgrounds, it is also paramount to recruit from Anubis as they have many accreditations on the courses they run that rival no other in the industry to date. It allows us to set a standard within our organization to know that we are supplying highly trained and motivated staff to our clients&quot;.</p>\n','2012-01-24 14:03:24','2012-01-31 11:51:43','2009-03-01 14:03:24'),(15,1,'VAT is now 15%','news-article-12',NULL,'<p>\n	Anubis has lowered all the training course prices to reflect the new VAT regulation of 15%.</p>\n','2012-01-24 14:03:40','2012-01-31 11:52:06','2008-12-01 14:03:40');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (1,2,'Home','/','<h1>\n	Welcome to Anubis</h1>\n<p>\n	Anubis is a modern, high-quality, professional risk management company with a mix of executive directors who possess diverse but complementary backgrounds. The depth of experience, current operational and training expertise is unrivalled in any one company in the private security industry.</p>\n','published',1,2,'2012-01-18 14:10:31','2012-01-20 17:26:38'),(2,2,'About Us','/about-us','<h1>\n	About Anubis</h1>\n<p>\n	Anubis is a modern, high-quality, professional risk management company with a mix of executive directors who possess diverse but complementary backgrounds. The depth of experience, current operational and training expertise is unrivalled in any one company in the private security industry. Anubis personnel work internationally as consultants providing a wide range of security services in many unusual and challenging climates. In addition to our established executive customers, Anubis clients include UK and International Government&rsquo;s armed forces and security services.</p>\n<p>\n	With an experienced team of consultants who are all world experts in their respective fields, Anubis offers training and risk management advice and operational assistance to international corporate, governmental and non-governmental clients.</p>\n<p>\n	Anubis leads the way in the provision of discreet personal protection and security consultancy for business clients. Our knowledge and operational expertise in this area is unrivalled at providing bespoke services to customers in the UK and around the world.</p>\n','published',3,10,'2012-01-18 14:28:40',NULL),(3,2,'Training & Operations','/training-and-operations','<h1>\n	Training &amp; Operations</h1>\n<p>\n	The text for the training and operations page goes in here.</p>\n','published',11,28,'2012-01-20 16:40:07','2012-01-24 14:45:38'),(4,2,'Special Projects','/special-projects','<h1>\n	Special Projects</h1>\n<p>\n	text goes here (this will be a protected page).</p>\n','published',29,42,'2012-01-20 16:40:35',NULL),(5,2,'Management Team','/management-team','<h1>\n	Management Team</h1>\n<h2>\n	David Seaton - Chairman</h2>\n<p>\n</p>\n<p>\n	Prior to Mr.Seaton&rsquo;s appointment as Chairman of Anubis Associates Limited he has held a number of senior executive positions including CEO and CFO in private and public companies within the UK and Internationally. His industry experience has almost exclusively been with international companies notably spending 12 years with Schlumberger Oilfield Services and 10 years with ArmorGroup, a publicly owned protective security group. His career highlights are:\n</p>\n<ul>\n	<li>Chief Financial Officer of Resource Group Ltd, a Venture Capital backed UK and Ireland based Facility Management and Integrated Service business</li>\n	<li>Chief Financial Officer of Armor Designs Inc, a leader in the design, development and production of lightweight composite armor for commercial, government and military applications</li>\n	<li>Chief Executive Officer of ArmorGroup International plc, a London based protective security company with offices in 38 countries, 9,000 employees and revenues in the region of $ 300m</li>\n	<li>Chief Financial Officer of ArmorGroup International plc, responsible for all financial aspects of the business including taking the lead on number of acquisitions, a management buy-out and a public offering</li>\n	<li>Director of The Stuffed Shirt company, a small start up business specializing in the design, manufacture and marketing of novel luggage items designed to reduce the space required to pack items relatively crease free</li>\n	<li>Various management positions including Region Financial Controller, Schlumberger Dowell Europe, a $250m revenue business operating in sixteen countries throughout Europe and North Africa including Russia and the CIS as well as Libya. Responsibilities covered all financial aspects of the Region through the management of fifty direct staff</li>\n</ul>\n<p>\n	Mr. Seaton has served on a number of Management Boards of UK based businesses both private and public company alike controlled by both UK and US parent organisations. He currently sits on the Board of a small private business, Scansol Ltd, a private skin cancer screening business based in London.\n</p>\n<h2>\n	Stuart Anderson MSc - Managing Director</h2>\nStuart is one of the founding directors and has been the Managing Director since the formation of the company in 2005. After leaving the military in 2001 Stuart has gained valuable experience within the private security industry specifically in the executive protection environment at an international level. He has trained individual security personnel and teams at corporate and diplomatic level around the world, as well as providing an operational commitment. This experience has been valuable in ensuring that Stuart is able to fully understand the clients security requirements in the current environment.\n<p>\n	Stuart is a graduate from Leicester University with a &lsquo;MSc in Security and Risk Management&rsquo;. He also is the lead external examiner at Buckinghamshire New University Foundation Degree in &lsquo;Protective Security Management&rsquo; and is the vice-chair of the Skills for Security sector consultation group for Close Protection.\n</p>\n<h2>\n	Richard Johnson CSC - Risk Management Director</h2>\n<p>\n</p>\n<p>\n	Richard is from a military background, 13 years of which were spent within the UK Special Forces (22 SAS). Since leaving the forces he has gained a wealth of experience of the security arena, running operations worldwide at Government and corporate levels. Richard is currently recognised as one of the UK&#39;s leading experts in the field of executive protection and high-level business security. Having extensively travelled throughout his operational risk management career, Richard has been able to obtain first hand experience of personal security awareness at a very high level. He has been able to utilse this knowledge to design a specialised training package for corporate clients to answer their question of: &quot;what is personal security and how is it relevant to our organisation.&quot;\n</p>\nHis expertise is in high demand at Government, Corporate, Industrial and Celebrity levels, he also contributes his wealth of knowledge and expertise to ensure his up to date operational skills are implemented into the Anubis Close Protection Training Courses. Richard has been instrumental in developing the risk management capability that promotes the quality standard that Anubis demand.\n<h2>\n	David Scott MSc, Fysl - Training Director</h2>\nDavid joined Anubis in April 2009 as Training and Operations Manager. He was appointed Training Director in October 2010 on the retirement of Geoffrey Padgham, one of the company&#39;s founding directors. Following more than 24 years service in the British Army, David has gained extensive experience in security risk consulting. Working in a freelance capacity and as a Senior Consultant for a leading Risk Management Consultancy, David has worked with numerous corporate clients across Europe, the Middle East and Africa. These projects have encompassed personal, physical and procedural security reviews, audits and planning across a diverse variety of sectors including Finance, Hotels, Retail, Oil and Gas, Power Generation, Construction, Transportation and High-Technology Industries.\n<p>\n	David gained his MSc in Security and Risk Management from the University of Leicester in 2003, and having recently completed a Post Graduate Diploma in Terrorism Studies is now at the dissertation phase of his MLitt with the University of St. Andrews. A member of ASIS International, he holds certifications as both a Certified Protection Professional (CCP) and a Physical Security Professional (PSP). David is a Fellow of the Security Institute and a Member of both the Business Continuity Institute and the International Institute of Risk and Safety Management.\n</p>\n<h2>\n	Benjamin Parker - Special Projects Director</h2>\n<p>\n</p>\n<p>\n	Ben has been with Anubis since 2007 from leaving the British Military where the majority of his service was spent within the United Kingdom Special Forces. In his time with the company Ben has worked on Government projects and technical based security projects, delivering training in specialist areas of security along with consultation and development of technical products.\n</p>\nBen was appointed to the board of Directors in October 2010 and now co-ordinates our well established teams that work within the Special Projects Department.\n<h2>\n	Geoffrey Padgham MVO FDa CSC - Director</h2>\nGeoffrey is a former Metropolitan Police Inspector from New Scotland Yard with over 30 years national and international policing experience. For most of his police service he specialised in close protection for the British Royal family, and from 1982 to 1999 he was appointed as the Personal Protection Officer to HRH The Duke of York (Prince Andrew). In 1991 he was created a Member of the Royal Victorian Order (MVO) for personal service to Her Majesty The Queen. In 2001 he completed his police career as a senior manager at Buckingham Palace and head of Royalty Protection training.\n<p>\n	In the private security industry Geoffrey&#39;s unique protection skills prompted his membership of the Security Industry Authority (SIA) Close Protection Consultation Group for Licensing and Qualifications, and is currently a member of the SIA&#39;s Strategic Steering Group for the SIA competency for licensing review and renewal due in 2010. He holds a Foundation Degree in Protective Security Management with an NVQ Level 5 qualification in work based learning in Higher Education. More recently he has been appointed to the Board of Directors of Skills for Security, and membership of Buckinghamshire New University&#39;s Policy Board for the International Centre for Crowd Management and Security Studies.\n</p>\n','published',4,5,'2012-01-20 16:44:32','2012-01-27 16:44:51'),(6,2,'Mission Statement','/mission-statement','<h1>\n	Mission Statement</h1>\n<p>\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum odio nibh, vehicula et lacinia sit amet, tincidunt nec orci. Integer ornare rhoncus risus in dapibus. Praesent nec turpis vel orci ultrices tincidunt id ac mi. Fusce quis felis ligula. Curabitur ornare purus eget arcu euismod volutpat. Etiam ultrices imperdiet nisl id fringilla. Morbi at turpis a tortor ullamcorper mollis congue id massa. Donec velit sem, porta nec volutpat interdum, fringilla eget lorem. Suspendisse massa nibh, accumsan eget pellentesque a, vestibulum a nisl. Quisque in iaculis enim. Vestibulum gravida nunc a massa pellentesque at scelerisque odio malesuada. Praesent commodo ultricies tellus at vestibulum.</p>\n<p>\n	Nullam eget sem est. Suspendisse vestibulum sem sodales augue sodales in suscipit ligula vehicula. In venenatis, erat sed sodales fermentum, tellus augue dignissim purus, ac sollicitudin felis quam a justo. Quisque sed posuere lorem. Aliquam pharetra iaculis eros, a viverra massa ultricies id. Aenean vehicula lacinia varius. Vivamus molestie condimentum lorem vitae suscipit. Praesent nisi arcu, bibendum ut aliquet ut, auctor nec erat. Donec blandit aliquet tellus, id dapibus massa dictum tristique. Pellentesque nulla felis, mattis et tristique in, tincidunt in nunc.</p>\n','published',6,7,'2012-01-20 16:44:49','2012-01-24 14:36:00'),(7,2,'Employment Opportunities','/employment','<h1>\n	Employment Opportunities</h1>\n<h2>\n	Close Protection - CP</h2>\n<p>\n	The opportunities for a Close Protection Security Industry Authority (SIA) licence holder to secure employment in the private security industry are reasonably good. It is predominantly a self-employed security sector so reputation and recommendation is everything. There are very few full-time jobs in Close Protection where you are a career employee by either an individual principal client or company. Provided a licence holder remains flexible and diverse in the security roles he or she is willing to offer employers, career opportunities are plentiful.</p>\n<p>\n	Wages vary considerably depending on the assignment (length and location) and a licence holder&#39;s experience. As a general guide to pay a Close Protection team member in the UK could earn anything between about &pound;120 to &pound;200 per day with a team leader earning up to &pound;350. In hostile or remote environments abroad, wages have dropped significantly to approximately &pound;150 to &pound;300 per day subject to experience and the individual assignment. Some large security companies now offer a fixed short-term annual salary of about &pound;50000. Close Protection Team leaders would earn a little more up to about &pound;65,000.</p>\n<p>\n	Anubis only employ SIA licensed Close Protection Operatives (CPO&#39;s) and naturally favour those individuals that they have personally trained. This is because even if an individual holds an SIA Close Protection licence the variation in a company&#39;s training standards and the ultimate quality of successful graduates is huge. Increasingly the quality of the training provider and the individuals who actually trained the SIA licence holder is becoming a key factor in current Close Protection employment. Best-practice has yet to filter down to be delivered by all Close Protection training providers and until it does employers will continue to ask two questions namely:</p>\n<p>\n	&quot;Do you hold an SIA Close Protection licence?&quot; &amp; &quot;Who trained you?&quot;</p>\n<p>\n	The answer to the second question can often be more important than the first! An SIA licence is the current legal requirement to work on a contract in England, Wales &amp; Scotland, but it does not yet guarantee that the holder is a high-quality operator.</p>\n<p>\n	Before accepting any Close Protection employment you must always read the small print and clarify the position regarding travelling expenses, accommodation, food, leave payment, illness, insurance, repatriation, home visits, phone allowance, etc.</p>\n<p>\n	&nbsp;</p>\n<h2>\n	Security Consultants</h2>\n<p>\n	Currently the role of a Security Consultant is not a sector licensed by the SIA although a further announcement on this issue is expected by 2010. Employment therefore still relies on competency mainly judged by an individual&#39;s background and experience. As regulation draws closer and private security companies focus more on their legal &#39;duty of care&#39;, much more emphasis is being placed on formal qualifications like a security-related University Degree or the Anubis Certified Security Consultant (CSC) level 5 qualification.</p>\n<p>\n	Employment opportunities for Security Consultants varies widely and is difficult to quantify. They range from those that are in full-time employment with a risk management company like Anubis, to those that rely on contractual work from a range of organisations as a self-employed person. The organisations that employ Security Consultants are diverse and include such industry sectors as oil and gas, governments, defence, maritime, nuclear, construction and aviation. The Anubis CSC Course is accredited by the Institute of Risk Management and it may be worth undertaking broader research into qualifications and employment at:</p>\n<p>\n	<a href=\"http://www.theirm.org\">www.theirm.org</a></p>\n<p>\n	Provided a license holder remains flexible and diverse in the security roles he or she is willing to offer employers, career opportunities are plentiful. You can search online for <a href=\"http://www.jobisjob.co.uk/security/jobs\">security jobs</a> to get an idea of what&#39;s available in your area.</p>\n','published',8,9,'2012-01-20 16:46:02','2012-01-24 14:15:29'),(8,2,'Training','/training','<h1>\n	Training</h1>\n<p>\n	Anubis was formed in 2005 by the current Executive Directors who all possess credible training backgrounds and have proven track-records in the police, armed services and civilian environments. Although the company was created to provide a wide range of security services far beyond just training, it was undoubtedly a key foundation stone driven by a passionate desire to raise standards and skills in the private security industry. That founding desire and drive continues even today, and is best illustrated by the fact that all the company directors are members of various important SIA, University and Skills for Security Boards and Expert Groups.</p>\n<p>\n	Additionally all Anubis teaching staff possess current operational experience and benefit from civilian training qualifications. The combination of instructor competency gained over many decades in different training environments has helped shape our high-quality training courses with great currency, breadth and depth.</p>\n<p>\n	Anubis now offers a range of training courses accredited by some of the best organisations in the United Kingdom. A visit to the &#39;COURSES&#39; page of this website will provide further information on our accreditations and the courses currently available.</p>\n','published',12,21,'2012-01-20 16:46:36','2012-01-24 14:12:45'),(9,2,'Operations','/operations','<h1>\n	Operations</h1>\n','published',22,27,'2012-01-20 16:46:49',NULL),(10,2,'Security Management','/security-management','<h1>\n	Security Management</h1>\n','published',23,24,'2012-01-20 16:47:28',NULL),(11,2,'Personal Security','/personal-security','<h1>\n	Personal Security</h1>\n','published',25,26,'2012-01-20 16:48:01',NULL),(12,1,'Technical Equipment','/technical-equipment','<h1>\n	Technical Equipment</h1>\n<p>\n	overview text will go in here.\n</p>\n<ul>\n	<li><a href=\"/product\">Example Product Listing</a></li>\n	<li><a href=\"/product/test\">Example Product Item</a></li>\n</ul>\n','published',30,31,'2012-01-20 16:56:33','2012-01-31 11:39:04'),(13,1,'Training','/training','<h1>\n	Training</h1>\n<p>\n	information about the training section here. &nbsp;child pages to the left.\n</p>\n','published',32,41,'2012-01-20 16:56:51','2012-01-31 11:37:30'),(14,2,'Contact Us','/contact-us','<h1>\n	Contact Us</h1>\n<p>\n	Please use the form below to get in touch with us, ask us any particular questions, or just to register your interest in Anubis.\n</p>\n<p>\n	<widget contenteditable=\"false\" method=\"form\" module=\"contact\">[C3 Contact Form]</widget>\n</p>\n','published',43,48,'2012-01-20 16:57:31','2012-01-26 09:54:17'),(15,2,'Map & Directions','/map-and-directions','<h1>\n	Map and Directions</h1>\n<p>\n	Anubis House<br />\n	Whitestone Business Park<br />\n	Hereford<br />\n	HR1 3SE\n</p>\n<p>\n	Tel: 01432 851656\n</p>\n<p>\n	~~googlemap? will go in here~~\n</p>\n','published',44,45,'2012-01-25 16:13:17',NULL),(16,2,'Company Regulatory Information','/information','<h1>\n	Company Regulatory Information</h1>\n<p>\n	<strong>Full Company Name</strong>:&nbsp; Anubis Associates Limited<br />\n	<strong>Company Registration Number</strong>:&nbsp; 05629438<br />\n	<strong>Registered Address</strong>:&nbsp; Anubis House, Whitestone Business Park, Hereford, HR1 3SE<br />\n	<strong>Main Email Address</strong>: admin@anubisltd.com<br />\n	<strong>VAT Registration Number</strong>:&nbsp; 869 8261 63<br />\n	<strong>Data Protection Registration Number</strong>:&nbsp; Z1178771\n</p>\n','published',46,47,'2012-01-25 16:15:00',NULL),(17,2,'CP Course','/cp-course','<h1>\n	CP Course</h1>\n<p>\n	Information here.\n</p>\n','published',13,14,'2012-01-26 11:22:19',NULL),(18,2,'CSC Course','/csc-course','<h1>\n	CSC Course</h1>\n<p>\n	Information here.\n</p>\n','published',15,16,'2012-01-26 11:22:54',NULL),(19,2,'FAQs','/faqs','<h1>\n	FAQs</h1>\n<p>\n	FAQ page.\n</p>\n','published',17,18,'2012-01-26 11:23:14',NULL),(20,2,'Case Studies','/case-studies','<h1>\n	Case Studies</h1>\n<p>\n	Case studies.\n</p>\n','published',19,20,'2012-01-26 11:23:46',NULL),(21,2,'Privacy Policy','/legal/privacy','<h1>\n	Privacy Policy</h1>\n<p>\n	Your privacy is important to us. To better protect your privacy we provide this notice explaining our online information practices and the choices you can make about the way your information is collected and used. To make this notice easy to find, we make it available throughout the website and at every point where personally identifiable information may be requested.\n</p>\n<h4>\n	The Information We Collect:</h4>\n<p>\n	This notice applies to all information collected or submitted on this website. On some pages, you can make requests and register to receive materials. The types of personal information collected at these pages are:\n</p>\n<ul>\n	<li>Name</li>\n	<li>Address</li>\n	<li>Email address</li>\n	<li>Phone number</li>\n</ul>\n<p>\n	The Information We DO NOT Collect:\n</p>\n<ul>\n	<li>Credit/Debit Card Information</li>\n</ul>\n<h4>\n	How We Use Information:</h4>\n<p>\n	We use the information you provide about yourself solely to fulfil your request. We do not share this information with outside parties.\n</p>\n<p>\n	We use return email addresses to answer the email we receive. Such addresses are not used for any other purpose and are not shared with outside parties other than to keep you updated with new products and services from Anubis Ltd.\n</p>\n<p>\n	You can unsubscribe or decline to receive this information at the time of making a request or at any time thereafter. Your details will then be immediately removed from our database.\n</p>\n<p>\n	Finally, we never use or share the personally identifiable information provided to us online in ways unrelated to the ones described above without also providing you an opportunity to opt-out or otherwise prohibit such unrelated uses.\n</p>\n<h4>\n	Our Commitment To Data Security</h4>\n<p>\n	To prevent unauthorised access, maintain data accuracy, and ensure the correct use of information, we have put in place appropriate physical, electronic, and managerial procedures to safeguard and secure the information we collect online.\n</p>\n<h4>\n	How To Access Or Correct Your Information</h4>\n<p>\n	You can access all your personally identifiable information that we collect online and maintain by calling us or sending us an email. We use this procedure to better safeguard your information.\n</p>\n<p>\n	You can correct factual errors in your personally identifiable information by sending us a request that credibly shows error.\n</p>\n<p>\n	To protect your privacy and security, we will also take reasonable steps to verify your identity before granting access or making corrections.\n</p>\n<h4>\n	How To Contact Us</h4>\n<p>\n	Should you have other questions or concerns about these privacy policies, please <a href=\"/contact-us\" title=\"Contact\">contact us</a>.\n</p>\n','published',49,50,'2012-01-31 11:27:31',NULL),(22,2,'Terms & Conditions','/legal/terms','<h1>\n	Terms &amp; Conditions</h1>\n<h2>\n	Table of Contents</h2>\n<ol>\n	<li><a href=\"#c1\">Introduction</a></li>\n	<li><a href=\"#c2\">Information on the Website</a></li>\n	<li><a href=\"#c3\">Trade Marks</a></li>\n	<li><a href=\"#c4\">External Links</a></li>\n	<li><a href=\"#c5\">Public forums and User Submissions</a></li>\n	<li><a href=\"#c6\">Specific Use</a></li>\n	<li><a href=\"#c7\">Warranties</a></li>\n	<li><a href=\"#c8\">Disclaimer of Liability</a></li>\n	<li><a href=\"#c9\">Use of the Website</a></li>\n	<li><a href=\"#c10\">General</a></li>\n</ol>\n<h3>\n	<a name=\"c1\"></a>1. Introduction</h3>\n<p lang=\"en-GB\">\n	The Website Owner, including subsidiaries and affiliates (&ldquo;Website&rdquo; or &ldquo;Website Owner&rdquo; or &ldquo;we&rdquo; or &ldquo;us&rdquo; or &ldquo;our&rdquo;) provides the information contained on this website or any of the pages comprising the website (&ldquo;website&rdquo;) to visitors (&ldquo;visitors&rdquo;) (cumulatively referred to as &ldquo;you&rdquo; or &ldquo;your&rdquo; hereinafter) subject to the terms and conditions set out in these website terms and conditions, the privacy policy and any other relevant terms and conditions, policies and notices which may be applicable to a specific section or module of this website.\n</p>\n<h3>\n	<a name=\"c2\"></a>2. Information on the Website</h3>\n<p lang=\"en-GB\">\n	Whilst every effort is made to update the information contained on this website, neither the Website Owner nor any third party or data or content provider make any representations or warranties, whether express, implied in law or residual, as to the sequence, accuracy, completeness or reliability of information, opinions, any share price information, research information, data and/or content contained on the website (including but not limited to any information which may be provided by any third party or data or content providers) (&ldquo;information&rdquo;) and shall not be bound in any manner by any information contained on the website. the Website Owner reserves the right at any time to change or discontinue without notice, any aspect or feature of this website. No information shall be construed as advice and information is offered for information purposes only and is not intended for trading purposes. You and your company rely on the information contained on this website at your own risk. If you find an error or omission at this site, please let us know.\n</p>\n<h3>\n	<a name=\"c3\"></a>3. Trade Marks</h3>\n<p lang=\"en-GB\">\n	The trademarks, names, logos and service marks (collectively &ldquo;trademarks&rdquo;) displayed on this website are registered and unregistered trademarks of the Website Owner. Nothing contained on this website should be construed as granting any licence or right to use any trademark without the prior written permission of the Website Owner.\n</p>\n<h3>\n	<a name=\"c4\"></a>4. External Links</h3>\n<p lang=\"en-GB\">\n	External links may be provided for your convenience, but they are beyond the control of the Website Owner and no representation is made as to their content. Use or reliance on any external links and the content thereon provided is at your own risk. When visiting external links you must refer to that external websites terms and conditions of use. No hypertext links shall be created from any website controlled by you or otherwise to this website without the express prior written permission of the Website Owner. Please contact us if you would like to link to this website or would like to request a link to your website.\n</p>\n<h3>\n	<a name=\"c5\"></a>5. Public Forums and User Submissions</h3>\n<p lang=\"en-GB\">\n	The Website Owner is not responsible for any material submitted to the public areas by you (which include bulletin boards, hosted pages, chat rooms, or any other public area found on the website. Any material (whether submitted by you or any other user) is not endorsed, reviewed or approved by the Website Owner. The Website Owner reserves the right to remove any material submitted or posted by you in the public areas, without notice to you, if it becomes aware and determines, in its sole and absolute discretion that you are or there is the likelihood that you may, including but not limited to -\n</p>\n<ol>\n	<li>defame, abuse, harass, stalk, threaten or otherwise violate the rights of other users or any third parties;</li>\n	<li>publish, post, distribute or disseminate any defamatory, obscene, indecent or unlawful material or information;</li>\n	<li>post or upload files that contain viruses, corrupted files or any other similar software or programmes that may damage the operation of the Website Owner&rsquo;s and/or a third party&rsquo;s computer system and/or network;</li>\n	<li>violate any copyright, trademark, other applicable Great Britain or international laws or intellectual property rights of the Website Owner or any other third party;</li>\n	<li>submit contents containing marketing or promotional material which is intended to solicit business.</li>\n</ol>\n<h3>\n	<a name=\"c6\"></a>6. Specific Use</h3>\n<p lang=\"en-GB\">\n	You further agree not to use the website to send or post any message or material that is unlawful, harassing, defamatory, abusive, indecent, threatening, harmful, vulgar, obscene, sexually orientated, racially offensive, profane, pornographic or violates any applicable law and you hereby indemnify the Website Owner against any loss, liability, damage or expense of whatever nature which the Website Owner or any third party may suffer which is caused by or attributable to, whether directly or indirectly, your use of the website to send or post any such message or material.\n</p>\n<h3>\n	<a name=\"c7\"></a>7. Warranties</h3>\n<p lang=\"en-GB\">\n	The Website Owner makes no warranties, representations, statements or guarantees (whether express, implied in law or residual) regarding the website, the information contained on the website, your or your company&rsquo;s personal information or material and information transmitted over our system.\n</p>\n<h3>\n	<a name=\"c8\"></a>8. Disclaimer of Liability</h3>\n<p lang=\"en-GB\">\n	The Website Owner shall not be responsible for and disclaims all liability for any loss, liability, damage (whether direct, indirect or consequential), personal injury or expense of any nature whatsoever which may be suffered by you or any third party (including your company), as a result of or which may be attributable, directly or indirectly, to your access and use of the website, any information contained on the website, your or your company&rsquo;s personal information or material and information transmitted over our system. In particular, neither the Website Owner nor any third party or data or content provider shall be liable in any way to you or to any other person, firm or corporation whatsoever for any loss, liability, damage (whether direct or consequential), personal injury or expense of any nature whatsoever arising from any delays, inaccuracies, errors in, or omission of any share price information or the transmission thereof, or for any actions taken in reliance thereon or occasioned thereby or by reason of non-performance or interruption, or termination thereof.\n</p>\n<h3>\n	<a name=\"c9\"></a>9. Use of the Website.</h3>\n<p lang=\"en-GB\">\n	The Website Owner does not make any warranty or representation that information on the website is appropriate for use in any jurisdiction (other than Great Britain). By accessing the website, you warrant and represent to the Website Owner that you are legally entitled to do so and to make use of information made available via the website.\n</p>\n<h3>\n	<a name=\"c10\"></a>10. General</h3>\n<ol>\n	<li><em>Entire Agreement.</em><br />\n		These website terms and conditions constitute the sole record of the agreement between you and the Website Owner in relation to your use of the website. Neither you nor the Website Owner shall be bound by any express tacit or implied representation, warranty, promise or the like not recorded herein. Unless otherwise specifically stated these website terms and conditions supersede and replace all prior commitments, undertakings or representations, whether written or oral, between you and the Website Owner in respect of your use of the website.</li>\n	<li><em>Alteration</em><br />\n		The Website Owner may at any time modify any relevant terms and conditions, policies or notices. You acknowledge that by visiting the website from time to time, you shall become bound to the current version of the relevant terms and conditions (the &ldquo;current version&rdquo;) and, unless stated in the current version, all previous versions shall be superseded by the current version. You shall be responsible for reviewing the then current version each time you visit the website.</li>\n	<li><em>Conflict</em><br />\n		Where any conflict or contradiction appears between the provisions of these website terms and conditions and any other relevant terms and conditions, policies or notices, the other relevant terms and conditions, policies or notices which relate specifically to a particular section or module of the website shall prevail in respect of your use of the relevant section or module of the website.</li>\n	<li><em>Waiver</em><br />\n		No indulgence or extension of time which either you or the Website Owner may grant to the other will constitute a waiver of or, whether by estoppel or otherwise, limit any of the existing or future rights of the grantor in terms hereof, save in the event or to the extent that the grantor has signed a written document expressly waiving or limiting such rights.</li>\n	<li><em>Cession</em><br />\n		The Website Owner shall be entitled to cede, assign and delegate all or any of its rights and obligations in terms of any relevant terms and conditions, policies and notices to any third party.</li>\n	<li><em>Severability.</em><br />\n		All provisions of any relevant terms and conditions, policies and notices are, notwithstanding the manner in which they have been grouped together or linked grammatically, severable from each other. Any provision of any relevant terms and conditions, policies and notices, which is or becomes unenforceable in any jurisdiction, whether due to voidness, invalidity, illegality, unlawfulness or for any reason whatever, shall, in such jurisdiction only and only to the extent that it is so unenforceable, be treated as pro non scripto and the remaining provisions of any relevant terms and conditions, policies and notices shall remain in full force and effect.</li>\n	<li><em>Applicable laws</em><br />\n		Any relevant terms and conditions, policies and notices shall be governed by and construed in accordance with the laws of Great Britain without giving effect to any principles of conflict of law. You hereby consent to the exclusive jurisdiction of the High Court of Great Britain in respect of any disputes arising in connection with the website, or any relevant terms and conditions, policies and notices or any matter related to or in connection therewith.</li>\n	<li><em>Comments or Questions</em><br />\n		If you have any questions, comments or concerns arising from the website, the privacy policy or any other relevant terms and conditions, policies and notices or the way in which we are handling your personal information please contact us.</li>\n</ol>\n','published',51,52,'2012-01-31 11:29:50',NULL),(23,1,'Copyright','/legal/copyright','<h1>\n	Copyright</h1>\n<h2>\n	Copyright Anubis Associates Limited 2012</h2>\n<p>\n	All aspects of this web site &ndash; design, text, graphics, applications, software, underlying source code and all other aspects &ndash; are copyright Reepol and its affiliates or content and technology providers.\n</p>\nIn accessing these web pages, you agree that any downloading of content is for personal, non-commercial reference only. No part of this web site may be reproduced or transmitted in any form or by any means, electronic, mechanical, photocopying, recording or otherwise, without prior permission of the Website Owner.\n<p>\n	For rights clearance please <a href=\"/contact-us\">contact us here</a>.\n</p>\n<h2>\n	TradeMarks</h2>\n<p>\n	TradeMarks are covered in the <a href=\"/legal/terms\">Terms and Conditions</a> section. Please see also our <a href=\"/legal/privacy\">Privacy Policy</a>.\n</p>\n','published',53,54,'2012-01-31 11:32:49','2012-01-31 11:33:30'),(24,2,'COTS Course','/cots-course','<h1>\n	COTS Course</h1>\n<p>\n	text here.\n</p>\n','published',33,34,'2012-01-31 11:35:20',NULL),(25,2,'Surveillance','/surveillance','<h1>\n	Surveillance</h1>\n<p>\n	text here.\n</p>\n','published',35,36,'2012-01-31 11:35:50',NULL),(26,2,'Technical Surveillance','/technical-surveillance','<h1>\n	Technical Surveillance</h1>\n<p>\n	text goes here.\n</p>\n','published',37,38,'2012-01-31 11:36:20',NULL),(27,2,'CTR Course','/ctr-course','<h1>\n	CTR Course</h1>\n<p>\n	ctr data.\n</p>\n','published',39,40,'2012-01-31 11:36:42',NULL);
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,1,1,'02345','Title','title','Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis Phasellus pulvinar, nulla non aliquam eleifend, tortor wisi sceler. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis Phasellus pulvinar, nulla non aliquam eleifend erat, tortor wisi sceler. Pellentesque habitant morbi tristique.','<ul>\n	<li>Pellentesque habitant morbi tristique senectus et netus.</li>\n	<li>Phasellus pulvinar, nulla non aliquam eleifend.</li>\n	<li>Pellentesque habitant morbi tristique senectus et netus.</li>\n	<li>Phasellus pulvinar, nulla non aliquam eleifend.</li>\n	<li>Pellentesque habitant morbi tristique senectus et netus.</li>\n	<li>Phasellus pulvinar, nulla non aliquam eleifend.</li>\n</ul>\n',139.95,1,'2012-01-27 10:59:40','2012-01-30 10:03:39'),(2,1,1,'JON001','Jons Product','jons-product','Lorizzle we gonna chung dolor crunk amizzle, consectetuer adipiscing stuff. Nullam the bizzle velizzle, fo shizzle volutpizzle, bling bling quis, fo shizzle my nizzle vizzle, arcu. Pellentesque break yo neck, yall tortor. Sizzle erizzle. My shizz own yo&#39; dolizzle dapibizzle doggy tempizzle cool. Maurizzle pellentesque nibh izzle we gonna chung. You son of a bizzle izzle tortor. Mammasay mammasa mamma oo sa eleifend rhoncus nisi. Boofron hizzle habitasse platea dictumst. Gangster dapibus. Curabitizzle for sure gizzle, nizzle dope, shiz ac, eleifend vitae, nunc. Boofron suscipizzle. Integer stuff velizzle sizzle purus.','<ul>\n	<li>Pellentesque habitant morbi tristique senectus et netus.</li>\n	<li>Phasellus pulvinar, nulla non aliquam eleifend.</li>\n	<li>Pellentesque habitant morbi tristique senectus et netus.</li>\n	<li>Phasellus pulvinar, nulla non aliquam eleifend.</li>\n	<li>Pellentesque habitant morbi tristique senectus et netus.</li>\n	<li>Phasellus pulvinar, nulla non aliquam eleifend.</li>\n</ul>\n',99.99,1,'2012-01-27 17:15:07',NULL);
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
  PRIMARY KEY (`category_id`),
  KEY `category_slug` (`category_slug`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_category`
--

LOCK TABLES `product_category` WRITE;
/*!40000 ALTER TABLE `product_category` DISABLE KEYS */;
INSERT INTO `product_category` VALUES (1,'Example Category','example-category',1,2);
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
INSERT INTO `setting` VALUES ('seo_block_robots',NULL,'1');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'technical@creativeinsight.co.uk','53e89fc7f6132101d6c5068bb0e7073fca2968a80e5f04d79e35dea2f003e936','Creative','Insight',NULL,NULL,1,1,'2011-10-25 17:21:09','2012-01-19 17:12:21',NULL),(2,'admin@anubisltd.com','53e89fc7f6132101d6c5068bb0e7073fca2968a80e5f04d79e35dea2f003e936','Anubis','Admin','Anubis Ltd','01432 851656',1,1,'2012-01-31 10:59:27',NULL,NULL),(3,'jontce@gmail.com','53e89fc7f6132101d6c5068bb0e7073fca2968a80e5f04d79e35dea2f003e936','Jonny',NULL,'Whatevs','',1,0,'2012-01-25 10:40:16',NULL,NULL);
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

-- Dump completed on 2012-01-31 12:01:36
