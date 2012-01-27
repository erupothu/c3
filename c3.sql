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
INSERT INTO `news` VALUES (1,1,'50 Certified Security Consultants (CSCs)','50-certified-security-consultants-cscs',NULL,'<p>\n	Anubis is very pleased to announce that following the recent graduation of another five students who have successfully completed the Certified Security Consultant (CSC) programme, the half century mark of individuals holding this Level 5 certification has now been reached. The CSC qualification was recently re-accredited and now attracts 80 Higher Education Credits at Level 5, thereby offering students an increasingly worthwhile stand-alone qualification, or one which allows them to proceed onto further studies including the Bucks New University BA (Hons) in Security Consultancy due for launch in early 2012.</p>\n','2012-01-24 13:35:10',NULL,'2012-01-24 13:35:10'),(2,1,'News Article 1','news-article-1',NULL,'<p>\n	Anubis is very pleased to announce that following a series of changes to the content and delivery of the Certified Security Consultant&rsquo;s programme, the certification has recently been revalidated by Buck&rsquo;s New University and successful students will now receive a Level 5 Award worth 80 Higher Education Credits. We believe that this is an accurate assessment of the worth of the certification and reflects the nature and amount of work involved in successfully completing the CSC programme. The changes to the value of the certification are not retrospective and will only apply to students from the current intake and all subsequent courses.</p>\n','2012-01-24 13:36:03',NULL,'2011-07-01 13:36:03'),(3,1,'News Article 2','news-article-2',NULL,'<p>\n	Anubis Associates Ltd are very pleased to announce that we have recently been approved as a City &amp; Guilds Centre. We will shortly publish dates for the delivery of City &amp; Guilds professional qualifications for individuals working in the security sector.</p>\n','2012-01-24 13:36:16',NULL,'2011-07-01 13:36:16'),(4,1,'New Appointment - Alex Sinclair','new-appointment-alex-sinclair',NULL,'<h2>\n	Training and Operations Manager - Alex Sinclair</h2>\n<p>\n	Alex Sinclair joined Anubis in May 2011 as Training and Operations Manager. Prior to joining Anubis Alex amassed considerable commercial security experience - much of this focused on enabling business to take place under challenging conditions in high-threat areas. As an independent security contractor he has used his highly developed security management skills to assist his clients to mitigate risk for over 16 years. This has included the organisation, supervision and training of close protection/PSD teams in Algeria, Singapore, Iraq and Pakistan.</p>\n<p>\n	&nbsp;</p>\n<p>\n	Before entering the commercial security sector Alex completed 22 years military service, 15 of which were with 22 Special Air Service Regiment. during his military career Alex was responsible for researching, preparing and delivering training activities on all aspects of VIP protection. This included advising on the training and deployment of specialist groups to enhance the protective effort - such as counter-surveillance, counter-attack and counter-sniper support. He was responsible for the raising, training and deployment of several such groups in South America and the Far East for government and diplomtic protection groups.</p>\n<p>\n	Alex has presented briefings at levels up to and including Cabinet level in the UK and to head-of-state level elsewhere. On behalf of UK government agencies he has carried out staff audits, threat assessments, close protection and other training at various locations worldwide, including British embassies in a number of high risk locations.</p>\n<p>\n	&nbsp;</p>\n<p>\n	In addition to training and protecting at the highest levels, Alex has a strong personal interest in the safety and security of the individual. He has carried out tasks involved in the safety and training of undercover software-piracy investigators, journalists, expatriate executives and their familes and others at risk of conflict in the workplace and associated violence.</p>\n','2012-01-24 13:39:12','2012-01-24 14:00:17','2012-01-24 13:39:12'),(5,1,'News Article 3','news-article-3',NULL,'<p>\n	We are pleased to announce that Anubis Associates Ltd has sucessfully gained certification in ISO 9001:2008, Quality Management Standard and ISO 14001:2004, Environmental Management Standard (EMS). Achieving this accreditation shows our commitment to quality, customer and a willingness to work towards improving efficiency.</p>\n','2012-01-24 13:59:23',NULL,'2011-06-01 13:59:23'),(6,1,'News Article 4','news-article-4',NULL,'<p>\n	Anubis are pleased to announce that in conjunction with Ellis Clowes we are able to offer high level insurance to individuals who have attended and passed an Anubis certificated training course. AAL believe that the correct insurances and indemnities (from rated insurers) are vital to protect clients and their consultants.</p>\n','2012-01-24 14:00:00',NULL,'2010-11-01 14:00:00'),(7,1,'New Appointment - Trevor Brealy','new-appointment-trevor-brealy',NULL,'<h2>\n	Business Development Executive - Trevor Brealy</h2>\n<p>\n	Anubis is pleased to welcome Trevor Brealy to Anubis Associates Limited as Business Development Executive. Trevor will concentrate on developing and implementing the business strategy for the company&#39;s expansion in the Middle East.</p>\n<p>\n	Trevor joins Anubis from VT/Babcock where he held the position of Regional Business Development Executive based in Kuwait for 7 years. Prior to this Trevor worked as a Bid Manager for VT Group working as part of a large bid team working on Government contracts in the UK and Kuwait. During his career Trevor has also worked in Dubai, Indonesia, Chile and Bosnia as an overseas engineer.</p>\n<p>\n	Stuart Anderson, Anubis&#39;s Managing Director said he was delighted with Trevor&#39;s appointment as it will enable Anubis to expand in the Middle East which will significantly strengthen our position in the Security Industry.</p>\n','2012-01-24 14:01:15',NULL,'2012-01-24 14:01:15'),(8,1,'News Article 5','news-article-5',NULL,'<p>\n	Due to an increasing demand for our advertised training programmes, we have decided to increase the number of Anubis courses available throughout 2011. The new training dates have now been released and can be viewed on the &#39;Training - Courses&#39; section of our company website.</p>\n','2012-01-24 14:01:33',NULL,'2010-07-01 14:01:33'),(9,1,'News Article 6','news-article-6',NULL,'<p>\n	Anubis are currently delivering a bespoke security training course including ground-breaking criminal detection techniques to all the security staff employed at a Central London higher education institution. Feedback from the first two courses has been outstanding and their crime detection and arrest rates are increasing.</p>\n','2012-01-24 14:01:43',NULL,'2010-04-01 14:01:43'),(10,1,'News Article 7','news-article-7',NULL,'<p>\n	The Career Transition Partnership (CTP) extend their partnering agreement with Anubis for the continuation of their in-house security training for the benefit of Service Leavers from the Armed Forces throughout 2010.</p>\n','2012-01-24 14:01:53',NULL,'2009-09-01 14:01:53'),(11,1,'News Article 8','news-article-8',NULL,'<p>\n	Anubis are pleased to announce the appointment of David Seaton as Chairman of the Executive Board. For the last fifteen months Dave has worked closely with Anubis in his capacity as Board Advisor, and this arrangement has now been formalised to support the company moving forward. Stuart Anderson, Managing Director said &lsquo;I am delighted to welcome Dave to the Board. Over the last year or so he has been a valuable asset to the company advising on our growth strategy and further establishing Anubis in a strong market position. We feel that Dave will be integral to the continuing growth and strategic development of the company over the coming years, whilst maintaining the high quality services that Anubis has built its reputation on.</p>\n','2012-01-24 14:02:05',NULL,'2009-07-01 14:02:05'),(12,1,'News Article 9','news-article-9',NULL,'<p>\n	Anubis Associates Ltd are pleased to announce that we will be&nbsp; sponsoring&nbsp; the Security Networking Events Exhibition and our Risk Management Director Richard (Ginge) Johnson will be attending as a Specialist Guest Speaker. The event will be held at&nbsp; the Victory Services Club, London on the 2nd September 2009 (8.30am &ndash; 6.00 pm) <a href=\"http://www.securitynetworkingevents.co.uk/\" target=\"_blank\">http://www.securitynetworkingevents.co.uk/</a>.</p>\n','2012-01-24 14:02:33',NULL,'2009-07-01 14:02:33'),(13,1,'News Article 10','news-article-10',NULL,'<p>\n	The British Security Industry Association (BSIA) and the Career Transition Partnership (CTP) have just published a new guide for armed service leavers to careers in the private security industry. The Anubis Close Protection (CP) and Certified Security Consultant (CSC) Security Courses feature prominently, and as the only private security company in the UK to be endorsed and recommended by the CTP as their &#39;in-house&#39; training provider we are pleased to be associated with this publication. The guide can be viewed at : <a href=\"http://www.bsia.co.uk/web_images/publications/ctp_careers_booklet_pdf_27JAN09.pdf\">http://www.bsia.co.uk/web_images/publications/ctp_careers_booklet_pdf_27JAN09.pdf</a></p>\n','2012-01-24 14:02:55',NULL,'2009-04-01 14:02:55'),(14,1,'News Article 11','news-article-11',NULL,'<p>\n	Anubis have just provided nine Security Industry Authority (SIA) licensed Close Protection Operatives (CPO&rsquo;s) to the operational Close Protection company <a href=\"http://www.guardforcesecurity.co.uk/\">Guardforce Security Ltd</a> who deliver high quality security services throughout the UK and Europe. Richard &lsquo;Ginge&rsquo; Johnson explained that this has allowed Anubis Close Protection graduates to enter the private security industry with a SIA approved contractor that is working at the forefront of the Close Protection industry. Warren Jones Director of Guardforce Security Ltd was delighted with the outcome of this recruitment day stating &lsquo;the aim is to recruit SIA Licensed staff that are trained to the highest standard by experts in the field of Close Protection with operational experience from diverse backgrounds, it is also paramount to recruit from Anubis as they have many accreditations on the courses they run that rival no other in the industry to date. It allows us to set a standard within our organization to know that we are supplying highly trained and motivated staff to our clients&quot;.</p>\n','2012-01-24 14:03:24',NULL,'2009-03-01 14:03:24'),(15,1,'News Article 12','news-article-12',NULL,'<p>\n	Anubis has lowered all the training course prices to reflect the new VAT regulation of 15%.</p>\n','2012-01-24 14:03:40',NULL,'2008-12-01 14:03:40');
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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (1,1,'Home','/','<h1>\n	Welcome to Anubis</h1>\n<p>\n	Anubis is a modern, high-quality, professional risk management company with a mix of executive directors who possess diverse but complementary backgrounds. The depth of experience, current operational and training expertise is unrivalled in any one company in the private security industry.</p>\n','published',1,2,'2012-01-18 14:10:31','2012-01-20 17:26:38'),(2,1,'About Us','/about-us','<h1>\n	About Anubis</h1>\n<p>\n	Anubis is a modern, high-quality, professional risk management company with a mix of executive directors who possess diverse but complementary backgrounds. The depth of experience, current operational and training expertise is unrivalled in any one company in the private security industry. Anubis personnel work internationally as consultants providing a wide range of security services in many unusual and challenging climates. In addition to our established executive customers, Anubis clients include UK and International Government&rsquo;s armed forces and security services.</p>\n<p>\n	With an experienced team of consultants who are all world experts in their respective fields, Anubis offers training and risk management advice and operational assistance to international corporate, governmental and non-governmental clients.</p>\n<p>\n	Anubis leads the way in the provision of discreet personal protection and security consultancy for business clients. Our knowledge and operational expertise in this area is unrivalled at providing bespoke services to customers in the UK and around the world.</p>\n','published',3,10,'2012-01-18 14:28:40',NULL),(3,1,'Training & Operations','/training-and-operations','<h1>\n	Training &amp; Operations</h1>\n<p>\n	The text for the training and operations page goes in here.</p>\n','published',11,28,'2012-01-20 16:40:07','2012-01-24 14:45:38'),(4,1,'Special Projects','/special-projects','<h1>\n	Special Projects</h1>\n<p>\n	text goes here (this will be a protected page).</p>\n','published',29,34,'2012-01-20 16:40:35',NULL),(5,1,'Management Team','/management-team','<h1>\n	Management Team</h1>\n<h2>\n	David Seaton - Chairman</h2>\n<p>\n</p>\n<p>\n	Prior to Mr.Seaton&rsquo;s appointment as Chairman of Anubis Associates Limited he has held a number of senior executive positions including CEO and CFO in private and public companies within the UK and Internationally. His industry experience has almost exclusively been with international companies notably spending 12 years with Schlumberger Oilfield Services and 10 years with ArmorGroup, a publicly owned protective security group. His career highlights are:\n</p>\n<ul>\n	<li>Chief Financial Officer of Resource Group Ltd, a Venture Capital backed UK and Ireland based Facility Management and Integrated Service business</li>\n	<li>Chief Financial Officer of Armor Designs Inc, a leader in the design, development and production of lightweight composite armor for commercial, government and military applications</li>\n	<li>Chief Executive Officer of ArmorGroup International plc, a London based protective security company with offices in 38 countries, 9,000 employees and revenues in the region of $ 300m</li>\n	<li>Chief Financial Officer of ArmorGroup International plc, responsible for all financial aspects of the business including taking the lead on number of acquisitions, a management buy-out and a public offering</li>\n	<li>Director of The Stuffed Shirt company, a small start up business specializing in the design, manufacture and marketing of novel luggage items designed to reduce the space required to pack items relatively crease free</li>\n	<li>Various management positions including Region Financial Controller, Schlumberger Dowell Europe, a $250m revenue business operating in sixteen countries throughout Europe and North Africa including Russia and the CIS as well as Libya. Responsibilities covered all financial aspects of the Region through the management of fifty direct staff</li>\n</ul>\n<p>\n	Mr. Seaton has served on a number of Management Boards of UK based businesses both private and public company alike controlled by both UK and US parent organisations. He currently sits on the Board of a small private business, Scansol Ltd, a private skin cancer screening business based in London.\n</p>\n<h2>\n	Stuart Anderson MSc - Managing Director</h2>\nStuart is one of the founding directors and has been the Managing Director since the formation of the company in 2005. After leaving the military in 2001 Stuart has gained valuable experience within the private security industry specifically in the executive protection environment at an international level. He has trained individual security personnel and teams at corporate and diplomatic level around the world, as well as providing an operational commitment. This experience has been valuable in ensuring that Stuart is able to fully understand the clients security requirements in the current environment.\n<p>\n	Stuart is a graduate from Leicester University with a &lsquo;MSc in Security and Risk Management&rsquo;. He also is the lead external examiner at Buckinghamshire New University Foundation Degree in &lsquo;Protective Security Management&rsquo; and is the vice-chair of the Skills for Security sector consultation group for Close Protection.\n</p>\n<h2>\n	Richard Johnson CSC - Risk Management Director</h2>\n<p>\n</p>\n<p>\n	Richard is from a military background, 13 years of which were spent within the UK Special Forces (22 SAS). Since leaving the forces he has gained a wealth of experience of the security arena, running operations worldwide at Government and corporate levels. Richard is currently recognised as one of the UK&#39;s leading experts in the field of executive protection and high-level business security. Having extensively travelled throughout his operational risk management career, Richard has been able to obtain first hand experience of personal security awareness at a very high level. He has been able to utilse this knowledge to design a specialised training package for corporate clients to answer their question of: &quot;what is personal security and how is it relevant to our organisation.&quot;\n</p>\nHis expertise is in high demand at Government, Corporate, Industrial and Celebrity levels, he also contributes his wealth of knowledge and expertise to ensure his up to date operational skills are implemented into the Anubis Close Protection Training Courses. Richard has been instrumental in developing the risk management capability that promotes the quality standard that Anubis demand.\n<h2>\n	David Scott MSc, Fysl - Training Director</h2>\nDavid joined Anubis in April 2009 as Training and Operations Manager. He was appointed Training Director in October 2010 on the retirement of Geoffrey Padgham, one of the company&#39;s founding directors. Following more than 24 years service in the British Army, David has gained extensive experience in security risk consulting. Working in a freelance capacity and as a Senior Consultant for a leading Risk Management Consultancy, David has worked with numerous corporate clients across Europe, the Middle East and Africa. These projects have encompassed personal, physical and procedural security reviews, audits and planning across a diverse variety of sectors including Finance, Hotels, Retail, Oil and Gas, Power Generation, Construction, Transportation and High-Technology Industries.\n<p>\n	David gained his MSc in Security and Risk Management from the University of Leicester in 2003, and having recently completed a Post Graduate Diploma in Terrorism Studies is now at the dissertation phase of his MLitt with the University of St. Andrews. A member of ASIS International, he holds certifications as both a Certified Protection Professional (CCP) and a Physical Security Professional (PSP). David is a Fellow of the Security Institute and a Member of both the Business Continuity Institute and the International Institute of Risk and Safety Management.\n</p>\n<h2>\n	Benjamin Parker - Special Projects Director</h2>\n<p>\n</p>\n<p>\n	Ben has been with Anubis since 2007 from leaving the British Military where the majority of his service was spent within the United Kingdom Special Forces. In his time with the company Ben has worked on Government projects and technical based security projects, delivering training in specialist areas of security along with consultation and development of technical products.\n</p>\nBen was appointed to the board of Directors in October 2010 and now co-ordinates our well established teams that work within the Special Projects Department.\n<h2>\n	Geoffrey Padgham MVO FDa CSC - Director</h2>\nGeoffrey is a former Metropolitan Police Inspector from New Scotland Yard with over 30 years national and international policing experience. For most of his police service he specialised in close protection for the British Royal family, and from 1982 to 1999 he was appointed as the Personal Protection Officer to HRH The Duke of York (Prince Andrew). In 1991 he was created a Member of the Royal Victorian Order (MVO) for personal service to Her Majesty The Queen. In 2001 he completed his police career as a senior manager at Buckingham Palace and head of Royalty Protection training.\n<p>\n	In the private security industry Geoffrey&#39;s unique protection skills prompted his membership of the Security Industry Authority (SIA) Close Protection Consultation Group for Licensing and Qualifications, and is currently a member of the SIA&#39;s Strategic Steering Group for the SIA competency for licensing review and renewal due in 2010. He holds a Foundation Degree in Protective Security Management with an NVQ Level 5 qualification in work based learning in Higher Education. More recently he has been appointed to the Board of Directors of Skills for Security, and membership of Buckinghamshire New University&#39;s Policy Board for the International Centre for Crowd Management and Security Studies.\n</p>\n','published',4,5,'2012-01-20 16:44:32','2012-01-27 16:44:51'),(6,1,'Mission Statement','/mission-statement','<h1>\n	Mission Statement</h1>\n<p>\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum odio nibh, vehicula et lacinia sit amet, tincidunt nec orci. Integer ornare rhoncus risus in dapibus. Praesent nec turpis vel orci ultrices tincidunt id ac mi. Fusce quis felis ligula. Curabitur ornare purus eget arcu euismod volutpat. Etiam ultrices imperdiet nisl id fringilla. Morbi at turpis a tortor ullamcorper mollis congue id massa. Donec velit sem, porta nec volutpat interdum, fringilla eget lorem. Suspendisse massa nibh, accumsan eget pellentesque a, vestibulum a nisl. Quisque in iaculis enim. Vestibulum gravida nunc a massa pellentesque at scelerisque odio malesuada. Praesent commodo ultricies tellus at vestibulum.</p>\n<p>\n	Nullam eget sem est. Suspendisse vestibulum sem sodales augue sodales in suscipit ligula vehicula. In venenatis, erat sed sodales fermentum, tellus augue dignissim purus, ac sollicitudin felis quam a justo. Quisque sed posuere lorem. Aliquam pharetra iaculis eros, a viverra massa ultricies id. Aenean vehicula lacinia varius. Vivamus molestie condimentum lorem vitae suscipit. Praesent nisi arcu, bibendum ut aliquet ut, auctor nec erat. Donec blandit aliquet tellus, id dapibus massa dictum tristique. Pellentesque nulla felis, mattis et tristique in, tincidunt in nunc.</p>\n','published',6,7,'2012-01-20 16:44:49','2012-01-24 14:36:00'),(7,1,'Employment Opportunities','/employment','<h1>\n	Employment Opportunities</h1>\n<h2>\n	Close Protection - CP</h2>\n<p>\n	The opportunities for a Close Protection Security Industry Authority (SIA) licence holder to secure employment in the private security industry are reasonably good. It is predominantly a self-employed security sector so reputation and recommendation is everything. There are very few full-time jobs in Close Protection where you are a career employee by either an individual principal client or company. Provided a licence holder remains flexible and diverse in the security roles he or she is willing to offer employers, career opportunities are plentiful.</p>\n<p>\n	Wages vary considerably depending on the assignment (length and location) and a licence holder&#39;s experience. As a general guide to pay a Close Protection team member in the UK could earn anything between about &pound;120 to &pound;200 per day with a team leader earning up to &pound;350. In hostile or remote environments abroad, wages have dropped significantly to approximately &pound;150 to &pound;300 per day subject to experience and the individual assignment. Some large security companies now offer a fixed short-term annual salary of about &pound;50000. Close Protection Team leaders would earn a little more up to about &pound;65,000.</p>\n<p>\n	Anubis only employ SIA licensed Close Protection Operatives (CPO&#39;s) and naturally favour those individuals that they have personally trained. This is because even if an individual holds an SIA Close Protection licence the variation in a company&#39;s training standards and the ultimate quality of successful graduates is huge. Increasingly the quality of the training provider and the individuals who actually trained the SIA licence holder is becoming a key factor in current Close Protection employment. Best-practice has yet to filter down to be delivered by all Close Protection training providers and until it does employers will continue to ask two questions namely:</p>\n<p>\n	&quot;Do you hold an SIA Close Protection licence?&quot; &amp; &quot;Who trained you?&quot;</p>\n<p>\n	The answer to the second question can often be more important than the first! An SIA licence is the current legal requirement to work on a contract in England, Wales &amp; Scotland, but it does not yet guarantee that the holder is a high-quality operator.</p>\n<p>\n	Before accepting any Close Protection employment you must always read the small print and clarify the position regarding travelling expenses, accommodation, food, leave payment, illness, insurance, repatriation, home visits, phone allowance, etc.</p>\n<p>\n	&nbsp;</p>\n<h2>\n	Security Consultants</h2>\n<p>\n	Currently the role of a Security Consultant is not a sector licensed by the SIA although a further announcement on this issue is expected by 2010. Employment therefore still relies on competency mainly judged by an individual&#39;s background and experience. As regulation draws closer and private security companies focus more on their legal &#39;duty of care&#39;, much more emphasis is being placed on formal qualifications like a security-related University Degree or the Anubis Certified Security Consultant (CSC) level 5 qualification.</p>\n<p>\n	Employment opportunities for Security Consultants varies widely and is difficult to quantify. They range from those that are in full-time employment with a risk management company like Anubis, to those that rely on contractual work from a range of organisations as a self-employed person. The organisations that employ Security Consultants are diverse and include such industry sectors as oil and gas, governments, defence, maritime, nuclear, construction and aviation. The Anubis CSC Course is accredited by the Institute of Risk Management and it may be worth undertaking broader research into qualifications and employment at:</p>\n<p>\n	<a href=\"http://www.theirm.org\">www.theirm.org</a></p>\n<p>\n	Provided a license holder remains flexible and diverse in the security roles he or she is willing to offer employers, career opportunities are plentiful. You can search online for <a href=\"http://www.jobisjob.co.uk/security/jobs\">security jobs</a> to get an idea of what&#39;s available in your area.</p>\n','published',8,9,'2012-01-20 16:46:02','2012-01-24 14:15:29'),(8,1,'Training','/training','<h1>\n	Training</h1>\n<p>\n	Anubis was formed in 2005 by the current Executive Directors who all possess credible training backgrounds and have proven track-records in the police, armed services and civilian environments. Although the company was created to provide a wide range of security services far beyond just training, it was undoubtedly a key foundation stone driven by a passionate desire to raise standards and skills in the private security industry. That founding desire and drive continues even today, and is best illustrated by the fact that all the company directors are members of various important SIA, University and Skills for Security Boards and Expert Groups.</p>\n<p>\n	Additionally all Anubis teaching staff possess current operational experience and benefit from civilian training qualifications. The combination of instructor competency gained over many decades in different training environments has helped shape our high-quality training courses with great currency, breadth and depth.</p>\n<p>\n	Anubis now offers a range of training courses accredited by some of the best organisations in the United Kingdom. A visit to the &#39;COURSES&#39; page of this website will provide further information on our accreditations and the courses currently available.</p>\n','published',12,21,'2012-01-20 16:46:36','2012-01-24 14:12:45'),(9,1,'Operations','/operations','<h1>\n	Operations</h1>\n','published',22,27,'2012-01-20 16:46:49',NULL),(10,1,'Security Management','/security-management','<h1>\n	Security Management</h1>\n','published',23,24,'2012-01-20 16:47:28',NULL),(11,1,'Personal Security','/personal-security','<h1>\n	Personal Security</h1>\n','published',25,26,'2012-01-20 16:48:01',NULL),(12,1,'Technical Equipment','/technical-equipment','<h1>\n	Technical Equipment</h1>\n<ul>\n	<li>\n		<a href=\"/product\">Example Product Listing</a></li>\n	<li>\n		<a href=\"/product/test\">Example Product Item</a></li>\n</ul>\n','published',30,31,'2012-01-20 16:56:33','2012-01-26 13:36:59'),(13,1,'Training','/training','<h1>\n	Training</h1>\n','published',32,33,'2012-01-20 16:56:51',NULL),(14,1,'Contact Us','/contact-us','<h1>\n	Contact Us</h1>\n<p>\n	Please use the form below to get in touch with us, ask us any particular questions, or just to register your interest in Anubis.\n</p>\n<p>\n	<widget contenteditable=\"false\" method=\"form\" module=\"contact\">[C3 Contact Form]</widget>\n</p>\n','published',35,40,'2012-01-20 16:57:31','2012-01-26 09:54:17'),(15,1,'Map & Directions','/map-and-directions','<h1>\n	Map and Directions</h1>\n<p>\n	Anubis House<br />\n	Whitestone Business Park<br />\n	Hereford<br />\n	HR1 3SE\n</p>\n<p>\n	Tel: 01432 851656\n</p>\n<p>\n	~~googlemap? will go in here~~\n</p>\n','published',36,37,'2012-01-25 16:13:17',NULL),(16,1,'Company Regulatory Information','/information','<h1>\n	Company Regulatory Information</h1>\n<p>\n	<strong>Full Company Name</strong>:&nbsp; Anubis Associates Limited<br />\n	<strong>Company Registration Number</strong>:&nbsp; 05629438<br />\n	<strong>Registered Address</strong>:&nbsp; Anubis House, Whitestone Business Park, Hereford, HR1 3SE<br />\n	<strong>Main Email Address</strong>: admin@anubisltd.com<br />\n	<strong>VAT Registration Number</strong>:&nbsp; 869 8261 63<br />\n	<strong>Data Protection Registration Number</strong>:&nbsp; Z1178771\n</p>\n','published',38,39,'2012-01-25 16:15:00',NULL),(17,1,'CP Course','/cp-course','<h1>\n	CP Course</h1>\n<p>\n	Information here.\n</p>\n','published',13,14,'2012-01-26 11:22:19',NULL),(18,1,'CSC Course','/csc-course','<h1>\n	CSC Course</h1>\n<p>\n	Information here.\n</p>\n','published',15,16,'2012-01-26 11:22:54',NULL),(19,1,'FAQs','/faqs','<h1>\n	FAQs</h1>\n<p>\n	FAQ page.\n</p>\n','published',17,18,'2012-01-26 11:23:14',NULL),(20,1,'Case Studies','/case-studies','<h1>\n	Case Studies</h1>\n<p>\n	Case studies.\n</p>\n','published',19,20,'2012-01-26 11:23:46',NULL);
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
INSERT INTO `product` VALUES (1,1,1,'02345','Title','title','Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis Phasellus pulvinar, nulla non aliquam eleifend, tortor wisi sceler. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis Phasellus pulvinar, nulla non aliquam eleifend erat, tortor wisi sceler. Pellentesque habitant morbi tristique.','<ul>\n	<li>Pellentesque habitant morbi tristique senectus et netus.</li>\n	<li>Phasellus pulvinar, nulla non aliquam eleifend.</li>\n	<li>Pellentesque habitant morbi tristique senectus et netus.</li>\n	<li>Phasellus pulvinar, nulla non aliquam eleifend.</li>\n	<li>Pellentesque habitant morbi tristique senectus et netus.</li>\n	<li>Phasellus pulvinar, nulla non aliquam eleifend.</li>\n</ul>\n',139.90,1,'2012-01-27 10:59:40',NULL),(2,1,1,'JON001','Jons Product','jons-product','Lorizzle we gonna chung dolor crunk amizzle, consectetuer adipiscing stuff. Nullam the bizzle velizzle, fo shizzle volutpizzle, bling bling quis, fo shizzle my nizzle vizzle, arcu. Pellentesque break yo neck, yall tortor. Sizzle erizzle. My shizz own yo&#39; dolizzle dapibizzle doggy tempizzle cool. Maurizzle pellentesque nibh izzle we gonna chung. You son of a bizzle izzle tortor. Mammasay mammasa mamma oo sa eleifend rhoncus nisi. Boofron hizzle habitasse platea dictumst. Gangster dapibus. Curabitizzle for sure gizzle, nizzle dope, shiz ac, eleifend vitae, nunc. Boofron suscipizzle. Integer stuff velizzle sizzle purus.','<ul>\n	<li>Pellentesque habitant morbi tristique senectus et netus.</li>\n	<li>Phasellus pulvinar, nulla non aliquam eleifend.</li>\n	<li>Pellentesque habitant morbi tristique senectus et netus.</li>\n	<li>Phasellus pulvinar, nulla non aliquam eleifend.</li>\n	<li>Pellentesque habitant morbi tristique senectus et netus.</li>\n	<li>Phasellus pulvinar, nulla non aliquam eleifend.</li>\n</ul>\n',99.99,1,'2012-01-27 17:15:07',NULL);
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
INSERT INTO `user` VALUES (1,'technical@creativeinsight.co.uk','53e89fc7f6132101d6c5068bb0e7073fca2968a80e5f04d79e35dea2f003e936','Creative','Insight',NULL,NULL,1,1,'2011-10-25 17:21:09','2012-01-19 17:12:21',NULL),(4,'jontce@gmail.com','53e89fc7f6132101d6c5068bb0e7073fca2968a80e5f04d79e35dea2f003e936','Jonny',NULL,'Whatevs','',1,0,'2012-01-25 10:40:16',NULL,NULL);
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

-- Dump completed on 2012-01-27 17:27:44
