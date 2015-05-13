CREATE DATABASE  IF NOT EXISTS `asadmin_analogstudios_new_test` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `asadmin_analogstudios_new_test`;
-- MySQL dump 10.13  Distrib 5.6.13, for osx10.6 (i386)
--
-- Host: localhost    Database: asadmin_analogstudios_new_test
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `artists`
--

DROP TABLE IF EXISTS `artists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artists` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `picture` varchar(255) NOT NULL DEFAULT '',
  `genre` varchar(255) NOT NULL DEFAULT '',
  `city` varchar(255) NOT NULL DEFAULT '',
  `state` tinytext NOT NULL,
  `label` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `bio` longtext NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artists`
--

LOCK TABLES `artists` WRITE;
/*!40000 ALTER TABLE `artists` DISABLE KEYS */;
INSERT INTO `artists` VALUES (2,'Electro Calrissian','pictures/electro_calrissian/ec.jpg','Punk Rock','North Conway','NH','Analog Studios','electrocalrissian@gmail.com','<span class=\\\"bigger\\\">A</span> hard rock band from Conway, NH, Electro Calrissian knows how to crank out the tunes. Once a solid three piece, these days the lineup features songwriter Zack Smith on guitars, bass, and vocals and Nat MacDonald also playing guitar, bass, and singing.  Aside from their usual gigs, Zack can often be found playing down at Open Mic on Mondays at the Red Parka Pub or Matty Bs Pizza. Check out their MySpace page for more up to date info, music, and news, maintained by their good friend and manager, Aldon Miller.',1),(1,'Analog','pictures/analog/analog.jpg','Rock and Roll','Block Island','RI','Analog Studios','dflamand@yahoo.com','<span class=\\\"bigger\\\">F</span>rom the smallest town in the smallest state, Analog Studios presents Block Islands very own, Analog! Analog is a local Block Island, Rhode Island band.  Currently the lineup consists of singer\\/songwriter\\/guitarist Dave Flamand, and bassist Morgan Macia. Daves demo CD, \\\"Lost Time\\\" (available for free download at our music page) provided the framework by which he could start a band to help him bring his songs out to the public in the way that only a band can. We encourage you to go to our MySpace page and check out their debut E.P. \\\"When the Media Talks About the Media.\\\"',1),(3,'Rory Boyan','pictures/rory_boyan/rory.jpg','Jam/Instrumental','Lowell','MA','Analog Studios','roryboyan@yahoo.com','<span class=\\\"bigger\\\">O</span>ne of my best friends, Rory plays instrumental music in a genre all to his own. Combining elements of blues, reggae, and percussion into his guitar playing, Rory manages to create something unique to him, and him alone. If you like chilled out and inspiring music, then you found your man.',1),(4,'Laurent Bonetto','pictures/laurent_bonetto/laurent.jpg','Classical','Providence','RI','Analog Studios','lbonetto-at-yahoo.com','While pursuing a scientific career, Laurent has always kept playing the piano as one of the main occupations of his life; a passion he has had since the age of 5.  Since the age of 15, he has practiced with concert pianist Nathalie Bera-Tagrine, with whom he studies when he returns to France.  Laurent has taken numerous masters classes in Europe and the US, participated in many concerts, and competitions, and has recorded two piano CD\'s.',1),(5,'The Silks','Silks Picture Here','Blues/Rock','Providence','RI','N/A','T.J.@email.com','The Silks are cool jazz rock band originating out of the Providence area.',0),(6,'Dave Flamand','pictures/dave_flamand/dave.jpg','Acoustic/Rock','Block Island','RI','Analog Studios','d.flamand@yahoo.com','Dave Flamand is a talented singer-songwriter from the Block Island area.  Dave is well known on the island for his fun and energetic open mics, where he plays originals as well as covering great acts like Neil Young, the Beatles, Oasis, Blur, and Radiohead.  Dave is also the front man for the rock band Analog and records for both himself and his band.  Check him out live on Block Island or around Providence, RI.  You can keep up with his schedule by following our events page and following Analog Studios social networking sites.',1),(9,'Audio Kickstand','pictures/audio_kickstand/audio_kickstand.jpg','Jam/Rock','Glen','NH','N/A','N/A','A great rock and jam band from Glen, NH, Audio Kickstand really knows how to get you out of your seat and dancing! This band is a prominent fixture down at the Red Parka Pub and you can almost always hear them playing Monday nights there for Open Mic. You can visit their myspace page for more news and info.',1),(10,'Jay St','pictures/jay_st/jay_st.jpg','Rock and Roll','Fitchburg','MA','Analog Studios','N/A','Hailing from the basement of the coolest house on the craziest cobblestone hill,  in Fitchburg, MA, Jay St. was the party band of the Fitchburg scene during the years of 2003-2005.  While actively playing out at Hoolingans bar, they were also well known for throwing some of the best parties.  (Even during the winter!)  Even though they are no more, their infamy lives on thanks to their recordings being unearthed and posted for all to enjoy.  So, if the dude abides, then so do we.  Oh yeah, mind if I do a J?',1);
/*!40000 ALTER TABLE `artists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `downloads`
--

DROP TABLE IF EXISTS `downloads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `downloads` (
  `downloadID` bigint(20) NOT NULL AUTO_INCREMENT,
  `songName` varchar(255) NOT NULL DEFAULT '',
  `artistName` varchar(255) NOT NULL DEFAULT '',
  `songPath` varchar(255) NOT NULL DEFAULT '',
  `num_downloads` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`downloadID`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `downloads`
--

LOCK TABLES `downloads` WRITE;
/*!40000 ALTER TABLE `downloads` DISABLE KEYS */;
INSERT INTO `downloads` VALUES (1,' Days Go Bye','Dave Flamand','music/dave_flamand/lost_time/05_Days_Go_Bye.mp3',1198),(2,' Intro','Analog','music/analog/analogdebut/01_Intro.mp3',6),(3,' Plant A Seed','Dave Flamand','music/dave_flamand/lost_time/10_Plant_A_Seed.mp3',160),(4,' Ravel Pavane','Laurent Bonetto','music/laurent_bonetto/musicMansion/05_Ravel_Pavane.mp3',5),(5,' Tiersen Sur le Fil','Laurent Bonetto','music/laurent_bonetto/musicMansion/10_Tiersen_Sur_le_Fil.mp3',1),(6,' High Octane Fuzzbox','Electro Calrissian','music/electro_calrissian/garage_demo/02_High_Octane_Fuzzbox.mp3',2),(7,' Instrumental Song4','Rory Boyan','music/rory_boyan/RPM_Recordings/04_Instrumental_Song4.mp3',1156),(8,' Faure Improvistation','Laurent Bonetto','music/laurent_bonetto/musicMansion/02_Faure_Improvistation.mp3',2),(9,' Patchwork','Dave Flamand','music/dave_flamand/spare_time/04_Patchwork.mp3',1111),(10,' Satie Gnossienne no1','Laurent Bonetto','music/laurent_bonetto/musicMansion/08_Satie_Gnossienne_no1.mp3',1080),(11,' Debussy Doctor Gradus','Laurent Bonetto','music/laurent_bonetto/musicMansion/04_Debussy_Doctor_Gradus.mp3',129),(12,' Foolish Jam','Jay St','music/jay_st/live_from_the_basement_set2/01_Foolish_Jam.mp3',2),(13,' Character Zero','Jay St','music/jay_st/live_from_the_basement_set2/04_Character_Zero.mp3',1145),(14,' Change Her Mind','Dave Flamand','music/dave_flamand/spare_time/01_Change_Her_Mind.mp3',4),(15,' Fake Plastic Trees','Jay St','music/jay_st/live_from_the_basement_set1/01_Fake_Plastic_Trees.mp3',6),(16,' Happiness is a Warm Gun','Jay St','music/jay_st/live_from_the_basement_set1/02_Happiness_is_a_Warm_Gun.mp3',2),(17,' Karma Police','Jay St','music/jay_st/live_from_the_basement_set1/04_Karma_Police.mp3',3),(18,' Instrumental Song1','Rory Boyan','music/rory_boyan/RPM_Recordings/01_Instrumental_Song1.mp3',3),(19,' October Rain','Dave Flamand','music/dave_flamand/lost_time/01_October_Rain.mp3',23),(20,' Faure Nocturne no8','Laurent Bonetto','music/laurent_bonetto/musicMansion/01_Faure_Nocturne_no8.mp3',14),(21,' Closed Doors','Dave Flamand','music/dave_flamand/lost_time/02_Closed_Doors.mp3',12),(22,' Unvieled','Dave Flamand','music/dave_flamand/lost_time/03_Unvieled.mp3',1),(23,' Ping Pong Game','Dave Flamand','music/dave_flamand/lost_time/04_Ping_Pong_Game.mp3',5),(24,' My Lap She Puts Her Feet On','Dave Flamand','music/dave_flamand/lost_time/06_My_Lap_She_Puts_Her_Feet_On.mp3',7),(25,' What Its Worth','Dave Flamand','music/dave_flamand/lost_time/07_What_Its_Worth.mp3',3),(26,' What That Matters','Dave Flamand','music/dave_flamand/lost_time/08_What_That_Matters.mp3',1),(27,' Fake Heroes','Dave Flamand','music/dave_flamand/lost_time/09_Fake_Heroes.mp3',5),(28,' Winds of Change','Dave Flamand','music/dave_flamand/lost_time/11_Winds_of_Change.mp3',2),(29,' Closed Hospital','Dave Flamand','music/dave_flamand/lost_time/12_Closed_Hospital.mp3',1),(30,' Hard Sponge','Dave Flamand','music/dave_flamand/lost_time/13_Hard_Sponge.mp3',2),(31,' Headache','Dave Flamand','music/dave_flamand/lost_time/14_Headache.mp3',1),(32,' Give You Flowers','Dave Flamand','music/dave_flamand/spare_time/02_Give_You_Flowers.mp3',1),(33,' Lonely Days','Dave Flamand','music/dave_flamand/spare_time/03_Lonely_Days.mp3',1),(34,' Wall Of Shame','Dave Flamand','music/dave_flamand/spare_time/05_Wall_Of_Shame.mp3',1),(35,' Why Not To Bother','Dave Flamand','music/dave_flamand/spare_time/06_Why_Not_To_Bother.mp3',5),(36,' With You Around','Dave Flamand','music/dave_flamand/spare_time/07_With_You_Around.mp3',2),(37,' Did I Wait','Analog','music/analog/analogdebut/02_Did_I_Wait.mp3',2),(38,' Multitasking','Analog','music/analog/analogdebut/05_Multitasking.mp3',2),(39,' Unveiled','Analog','music/analog/analogdebut/06_Unveiled.mp3',3),(40,' Winds Of Change','Analog','music/analog/analogdebut/08_Winds_Of_Change.mp3',2),(41,' Instrumental Song3','Rory Boyan','music/rory_boyan/RPM_Recordings/03_Instrumental_Song3.mp3',1),(42,' Instrumental Song7','Rory Boyan','music/rory_boyan/RPM_Recordings/07_Instrumental_Song7.mp3',2),(43,' Instrumental Song8','Rory Boyan','music/rory_boyan/RPM_Recordings/08_Instrumental_Song8.mp3',2),(44,' Instrumental Song9','Rory Boyan','music/rory_boyan/RPM_Recordings/09_Instrumental_Song9.mp3',4),(45,' Instrumental Song11','Rory Boyan','music/rory_boyan/RPM_Recordings/11_Instrumental_Song11.mp3',2),(46,' Instrumental Song12','Rory Boyan','music/rory_boyan/RPM_Recordings/12_Instrumental_Song12.mp3',2),(47,' Instrumental Song13','Rory Boyan','music/rory_boyan/RPM_Recordings/13_Instrumental_Song13.mp3',1),(48,' Say it Aint So','Jay St','music/jay_st/live_from_the_basement_set2/02_Say_it Aint_So.mp3',1),(49,' Loser','Jay St','music/jay_st/live_from_the_basement_set2/05_Loser.mp3',1),(50,' Cold In Bed','Jay St','music/jay_st/easy/03_Cold_In_Bed.mp3',2),(51,' What I Got','Jay St','music/jay_st/live_from_the_basement_set1/06_What_I_Got.mp3',1),(52,' National Anthem','Jay St','music/jay_st/live_from_the_basement_set1/07_National_Anthem.mp3',1),(53,' My Iron Lung','Jay St','music/jay_st/live_from_the_basement_set1/05_My_Iron_Lung.mp3',1),(54,' In My Place','Jay St','music/jay_st/live_from_the_basement_set1/03_In_My_Place.mp3',1),(55,' Mountain','Analog','music/analog/analogdebut/03_Mountain.mp3',2),(56,' Analog - With You Around','Various Artists','music/various/bi_musicfest2010/07_Analog_-_With_You_Around.mp3',2),(57,' Opening Jam','Audio Kickstand','music/audio_kickstand/brian_lessard_benefit/01_Opening_Jam.mp3',2),(58,' That Girl','Audio Kickstand','music/audio_kickstand/brian_lessard_benefit/04_That_Girl.mp3',2),(59,' Intro Jam','Electro Calrissian','music/electro_calrissian/garage_demo/01_Intro_Jam.mp3',1),(60,' Whole Again','Audio Kickstand','music/audio_kickstand/brian_lessard_benefit/02_Whole_Again.mp3',1),(61,' Debussy Arabesque no1','Laurent Bonetto','music/laurent_bonetto/musicMansion/03_Debussy_Arabesque_no1.mp3',5),(62,'ex.php','','index.php',4),(63,'tact.php','','contact.php',1),(64,'nts.php','','events.php',1),(65,'ents.php','','scripts/events.php',1),(66,'dio.php','','studio.php',1),(67,'w artist.php','','view_artist.php',1),(68,'tures.php','','pictures.php',1),(69,'ex.php.bak','','index.php.bak',1),(70,' Colby Lasororsa - Realm of Whimsicle','Various Artists','music/various/bi_musicfest2010/01_Colby_Lasororsa_-_Realm_of_Whimsicle.mp3',2),(71,' Posthume Nocturne no20','Laurent Bonetto','music/laurent_bonetto/music-mansion-series/vol3/31 Posthume Nocturne no20.mp3',1),(72,' Ballade no1','Laurent Bonetto','music/laurent_bonetto/music-mansion-series/vol3/08 Ballade no1.mp3',1);
/*!40000 ALTER TABLE `downloads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `startTime` int(11) NOT NULL,
  `endTime` int(11) NOT NULL,
  `createdTime` int(11) NOT NULL,
  `link` varchar(50) DEFAULT NULL,
  `linkFacebook` varchar(50) DEFAULT NULL,
  `artistid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `e_id_UNIQUE` (`id`),
  UNIQUE KEY `created_time_UNIQUE` (`createdTime`),
  KEY `id_idx` (`artistid`)
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Event Title 1419293704','Event Description 1419293704',1419293704,1430093704,1417309894,'analogstudios.thegreenhouse.io',NULL,NULL),(8,'some new title1419297300','some new description1419297300',1419297300,1430097300,1417311385,NULL,NULL,NULL),(9,'some new title1419298704','some new description1419298704',1419298704,1430098704,1417311710,NULL,NULL,NULL),(11,'some new title1419298288','some new description1419298288',1419298288,1430098288,1417311858,NULL,NULL,NULL),(15,'some new title1419299348','some new description1419299348',1419299348,1430099348,1417312644,NULL,NULL,NULL),(16,'Event Title 1419293704','Event Description 1419293704',1419293704,1430093704,1417312712,NULL,NULL,NULL),(18,'Event Title 1419293704','Event Description 1419293704',1419293704,1430093704,1417312745,NULL,NULL,NULL),(19,'Event Title 1419293704','Event Description 1419293704',1419293704,1430093704,1417312926,NULL,NULL,NULL),(20,'Event Title 1419293704','Event Description 1419293704',1419293704,1430093704,1417312958,NULL,NULL,NULL),(22,'some new title1419298750','some new description1419298750',1419298750,1430098750,1417474323,NULL,NULL,NULL),(23,'some new title1419299465','some new description1419299465',1419299465,1430099465,1417474354,NULL,NULL,NULL),(27,'some new title1419375787','some new description1419375787',1419375787,1430175787,1417474522,NULL,NULL,NULL),(33,'Event Title 1419293704','Event Description 1419293704',1419293704,1430093704,1417475007,NULL,NULL,NULL),(34,'Event Title 1419293704','Event Description 1419293704',1419293704,1430093704,1417475044,NULL,NULL,NULL),(39,'Event Title 1419293704','Event Description 1419293704',1419293704,1430093704,1417475334,NULL,NULL,NULL),(44,'Event Title 1419293704','Event Description 1419293704',1419293704,1430093704,1417476511,NULL,NULL,NULL),(45,'Event Title 1419293704','Event Description 1419293704',1419293704,1430093704,1417484230,NULL,NULL,NULL),(47,'Event Title 1419293704','Event Description 1419293704',1419293704,1430093704,1417484844,NULL,NULL,NULL),(48,'some new title1419299306','some new description1419299306',1419299306,1430099306,1417485468,NULL,NULL,NULL),(49,'Event Title 1419293704','Event Description 1419293704',1419293704,1430093704,1417485483,NULL,NULL,NULL),(50,'some new title1419354645','some new description1419354645',1419354645,1430154645,1417485485,NULL,NULL,NULL),(52,'some new title1419298766','some new description1419298766',1419298766,1430098766,1417485707,NULL,NULL,NULL),(53,'some new title1419358782','some new description1419358782',1419358782,1430158782,1417485796,NULL,NULL,NULL),(54,'some new title1419385264','some new description1419385264',1419385264,1430185264,1418128962,NULL,NULL,NULL),(55,'some new title1419376225','some new description1419376225',1419376225,1430176225,1418262961,NULL,NULL,NULL),(56,'some new title1419299191','some new description1419299191',1419299191,1430099191,1419294422,NULL,NULL,NULL),(57,'some new title1419299243','some new description1419299243',1419299243,1430099243,1419294451,NULL,NULL,NULL),(58,'Event Title 1419294470','Event Description 1419294470',1419294470,1430094470,1419294470,NULL,NULL,NULL),(59,'Event Title 1419294487','Event Description 1419294487',1419294487,1430094487,1419294487,NULL,NULL,NULL),(61,'some new title1419298694','some new description1419298694',1419298694,1430098694,1419294507,NULL,NULL,NULL),(62,'some new title1419299166','some new description1419299166',1419299166,1430099166,1419294602,NULL,NULL,NULL),(63,'some new title1419376349','some new description1419376349',1419376349,1430176349,1419294642,NULL,NULL,NULL),(64,'some new title1419308616','some new description1419308616',1419308616,1430108616,1419294681,NULL,NULL,NULL),(65,'Event Title 1419294778','Event Description 1419294778',1419294778,1430094778,1419294778,NULL,NULL,NULL),(66,'Event Title 1419294795','Event Description 1419294795',1419294795,1430094795,1419294795,NULL,NULL,NULL),(67,'Event Title 1419294807','Event Description 1419294807',1419294807,1430094807,1419294807,NULL,NULL,NULL),(68,'some new title1419297703','some new description1419297703',1419297703,1430097703,1419294823,NULL,NULL,NULL),(69,'Event Title 1419294835','Event Description 1419294835',1419294835,1430094835,1419294835,NULL,NULL,NULL),(70,'Event Title 1419294934','Event Description 1419294934',1419294934,1430094934,1419294934,NULL,NULL,NULL),(71,'Event Title 1419295036','Event Description 1419295036',1419295036,1430095036,1419295036,NULL,NULL,NULL),(72,'some new title1419298078','some new description1419298078',1419298078,1430098078,1419295094,NULL,NULL,NULL),(73,'some new title1419385357','some new description1419385357',1419385357,1430185357,1419295126,NULL,NULL,NULL),(74,'Event Title 1419295183','Event Description 1419295183',1419295183,1430095183,1419295183,NULL,NULL,NULL),(75,'Event Title 1419295197','Event Description 1419295197',1419295197,1430095197,1419295197,NULL,NULL,NULL),(77,'Event Title 1419295291','Event Description 1419295291',1419295291,1430095291,1419295291,NULL,NULL,NULL),(78,'some new title1419298535','some new description1419298535',1419298535,1430098535,1419295332,NULL,NULL,NULL),(82,'some new title1419379023','some new description1419379023',1419379023,1430179023,1419295386,NULL,NULL,NULL),(83,'Event Title 1419295392','Event Description 1419295392',1419295392,1430095392,1419295392,NULL,NULL,NULL),(85,'Event Title 1419295452','Event Description 1419295452',1419295452,1430095452,1419295452,NULL,NULL,NULL),(86,'some new title1419297843','some new description1419297843',1419297843,1430097843,1419295475,NULL,NULL,NULL),(87,'some new title1419385374','some new description1419385374',1419385374,1430185374,1419295490,NULL,NULL,NULL),(88,'Event Title 1419295498','Event Description 1419295498',1419295498,1430095498,1419295498,NULL,NULL,NULL),(90,'some new title1419299428','some new description1419299428',1419299428,1430099428,1419295510,NULL,NULL,NULL),(92,'Event Title 1419295573','Event Description 1419295573',1419295573,1430095573,1419295573,NULL,NULL,NULL),(93,'Event Title 1419295591','Event Description 1419295591',1419295591,1430095591,1419295591,NULL,NULL,NULL),(94,'some new title1419358473','some new description1419358473',1419358473,1430158473,1419296738,NULL,NULL,NULL),(95,'Event Title 1419296752','Event Description 1419296752',1419296752,1430096752,1419296752,NULL,NULL,NULL),(96,'Event Title 1419296765','Event Description 1419296765',1419296765,1430096765,1419296765,NULL,NULL,NULL),(97,'some new title1419299267','some new description1419299267',1419299267,1430099267,1419296786,NULL,NULL,NULL),(98,'some new title1419299137','some new description1419299137',1419299137,1430099137,1419296907,NULL,NULL,NULL),(99,'some new title1419298686','some new description1419298686',1419298686,1430098686,1419296985,NULL,NULL,NULL),(100,'Event Title 1419297076','Event Description 1419297076',1419297076,1430097076,1419297076,NULL,NULL,NULL),(101,'Event Title 1419297141','Event Description 1419297141',1419297141,1430097141,1419297141,NULL,NULL,NULL),(102,'some new title1419308642','some new description1419308642',1419308642,1430108642,1419297157,NULL,NULL,NULL),(103,'some new title1419376971','some new description1419376971',1419376971,1430176971,1419297177,NULL,NULL,NULL),(104,'some new title1419299066','some new description1419299066',1419299066,1430099066,1419297236,NULL,NULL,NULL),(105,'Event Title 1419297247','Event Description 1419297247',1419297247,1430097247,1419297247,NULL,NULL,NULL),(106,'some new title1419354562','some new description1419354562',1419354562,1430154562,1419297300,NULL,NULL,NULL),(108,'Event Title 1419297641','Event Description 1419297641',1419297641,1430097641,1419297641,NULL,NULL,NULL),(109,'some new title1419354541','some new description1419354541',1419354541,1430154541,1419297703,NULL,NULL,NULL),(110,'some new title1419298095','some new description1419298095',1419298095,1430098095,1419297725,NULL,NULL,NULL),(111,'Event Title 1419297791','Event Description 1419297791',1419297791,1430097791,1419297791,NULL,NULL,NULL),(112,'Event Title 1419297803','Event Description 1419297803',1419297803,1430097803,1419297803,NULL,NULL,NULL),(113,'Event Title 1419297843','Event Description 1419297843',1419297843,1430097843,1419297843,NULL,NULL,NULL),(114,'Event Title 1419297867','Event Description 1419297867',1419297867,1430097867,1419297867,NULL,NULL,NULL),(115,'Event Title 1419297890','Event Description 1419297890',1419297890,1430097890,1419297890,NULL,NULL,NULL),(117,'Event Title 1419298013','Event Description 1419298013',1419298013,1430098013,1419298013,NULL,NULL,NULL),(120,'Event Title 1419298118','Event Description 1419298118',1419298118,1430098118,1419298118,NULL,NULL,NULL),(122,'Event Title 1419298487','Event Description 1419298487',1419298487,1430098487,1419298487,NULL,NULL,NULL),(124,'Event Title 1419298535','Event Description 1419298535',1419298535,1430098535,1419298535,NULL,NULL,NULL),(125,'Event Title 1419298588','Event Description 1419298588',1419298588,1430098588,1419298588,NULL,NULL,NULL),(126,'Event Title 1419298618','Event Description 1419298618',1419298618,1430098618,1419298618,NULL,NULL,NULL),(130,'Event Title 1419298694','Event Description 1419298694',1419298694,1430098694,1419298694,NULL,NULL,NULL),(132,'some new title1425772707','some new description1425772707',1425772707,1436572707,1419298735,NULL,NULL,NULL),(133,'some new title1419299404','some new description1419299404',1419299404,1430099404,1419298750,NULL,NULL,NULL),(134,'some new title1419376277','some new description1419376277',1419376277,1430176277,1419298766,NULL,NULL,NULL),(135,'Event Title 1419299066','Event Description 1419299066',1419299066,1430099066,1419299066,NULL,NULL,NULL),(137,'Event Title 1419299137','Event Description 1419299137',1419299137,1430099137,1419299137,NULL,NULL,NULL),(139,'some new title1419308961','some new description1419308961',1419308961,1430108961,1419299191,NULL,NULL,NULL),(140,'some new title1419299431','some new description1419299431',1419299431,1430099431,1419299204,NULL,NULL,NULL),(142,'Event Title 1419299243','Event Description 1419299243',1419299243,1430099243,1419299243,NULL,NULL,NULL),(143,'Event Title 1419299267','Event Description 1419299267',1419299267,1430099267,1419299267,NULL,NULL,NULL),(144,'Event Title 1419299306','Event Description 1419299306',1419299306,1430099306,1419299306,NULL,NULL,NULL),(145,'Event Title 1419299341','Event Description 1419299341',1419299341,1430099341,1419299341,NULL,NULL,NULL),(146,'Event Title 1419299348','Event Description 1419299348',1419299348,1430099348,1419299348,NULL,NULL,NULL),(147,'Event Title 1419299404','Event Description 1419299404',1419299404,1430099404,1419299404,NULL,NULL,NULL),(148,'Event Title 1419299427','Event Description 1419299427',1419299427,1430099427,1419299427,NULL,NULL,NULL),(149,'Event Title 1419299431','Event Description 1419299431',1419299431,1430099431,1419299431,NULL,NULL,NULL),(150,'some new title1419385697','some new description1419385697',1419385697,1430185697,1419299436,NULL,NULL,NULL),(153,'some new title1419354550','some new description1419354550',1419354550,1430154550,1419308615,NULL,NULL,NULL),(154,'Event Title 1419308642','Event Description 1419308642',1419308642,1430108642,1419308642,NULL,NULL,NULL),(156,'Event Title 1419354530','Event Description 1419354530',1419354530,1430154530,1419354530,NULL,NULL,NULL),(157,'Event Title 1419354541','Event Description 1419354541',1419354541,1430154541,1419354541,NULL,NULL,NULL),(158,'some new title1419360417','some new description1419360417',1419360417,1430160417,1419354550,NULL,NULL,NULL),(159,'Event Title 1419354562','Event Description 1419354562',1419354562,1430154562,1419354562,NULL,NULL,NULL),(160,'Event Title 1419354645','Event Description 1419354645',1419354645,1430154645,1419354645,NULL,NULL,NULL),(161,'Event Title 1419358473','Event Description 1419358473',1419358473,1430158473,1419358473,NULL,NULL,NULL),(162,'Event Title 1419358782','Event Description 1419358782',1419358782,1430158782,1419358782,NULL,NULL,NULL),(163,'Event Title 1419358916','Event Description 1419358916',1419358916,1430158916,1419358916,NULL,NULL,NULL),(164,'some new title1419379009','some new description1419379009',1419379009,1430179009,1419360417,NULL,NULL,NULL),(165,'Event Title 1419375787','Event Description 1419375787',1419375787,1430175787,1419375787,NULL,NULL,NULL),(166,'some new title1419376259','some new description1419376259',1419376259,1430176259,1419376225,NULL,NULL,NULL),(168,'Event Title 1419376276','Event Description 1419376276',1419376276,1430176276,1419376276,NULL,NULL,NULL),(169,'Event Title 1419376349','Event Description 1419376349',1419376349,1430176349,1419376349,NULL,NULL,NULL),(170,'Event Title 1419376474','Event Description 1419376474',1419376474,1430176474,1419376474,NULL,NULL,NULL),(171,'Event Title 1419376971','Event Description 1419376971',1419376971,1430176971,1419376971,NULL,NULL,NULL),(172,'Event Title 1419379009','Event Description 1419379009',1419379009,1430179009,1419379009,NULL,NULL,NULL),(173,'Event Title 1419379023','Event Description 1419379023',1419379023,1430179023,1419379023,NULL,NULL,NULL),(174,'Event Title 1419379046','Event Description 1419379046',1419379046,1430179046,1419379046,NULL,NULL,NULL),(175,'Event Title 1419379050','Event Description 1419379050',1419379050,1430179050,1419379050,NULL,NULL,NULL),(176,'Event Title 1419379882','Event Description 1419379882',1419379882,1430179882,1419379882,NULL,NULL,NULL),(177,'Event Title 1419385264','Event Description 1419385264',1419385264,1430185264,1419385264,NULL,NULL,NULL),(178,'Event Title 1419385357','Event Description 1419385357',1419385357,1430185357,1419385357,NULL,NULL,NULL),(179,'Event Title 1419385374','Event Description 1419385374',1419385374,1430185374,1419385374,NULL,NULL,NULL),(180,'Event Title 1419385697','Event Description 1419385697',1419385697,1430185697,1419385697,NULL,NULL,NULL),(181,'Event Title 1425772707','Event Description 1425772707',1425772707,1436572707,1425772707,NULL,NULL,NULL);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `music`
--

DROP TABLE IF EXISTS `music`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `music` (
  `albumID` int(11) NOT NULL AUTO_INCREMENT,
  `albumName` varchar(255) NOT NULL DEFAULT '',
  `artistName` varchar(255) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `year` tinytext NOT NULL,
  `songsDirectory` varchar(255) NOT NULL DEFAULT '',
  `coverArtwork` varchar(255) NOT NULL DEFAULT '',
  `fullDownload` longtext,
  PRIMARY KEY (`albumID`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `music`
--

LOCK TABLES `music` WRITE;
/*!40000 ALTER TABLE `music` DISABLE KEYS */;
INSERT INTO `music` VALUES (1,'Debut CD Release Party (live)','Analog','The songs were played live at the CD Release party for Analog\'s debut album, \\\"When the Media Talk About The Media\\\" at Captain Nick\\\'s on Block Island.  These are songs from both the debut album and Dave Flamand\\\'s previous release, \\\"Lost Time.\\\"  \r\n','2008','music/analog/analogdebut','music/analog/analogdebut/debut_release.jpg',NULL),(2,'Lost Time','Dave Flamand','The lead singer of Analog, Dave Flamand is from Rhode Island and we are pleased to offer you exclusive downloads of his demo from this site. These songs provided the framework leading up to the creation of Analog, and as such you may recognize most of the songs from \\\"When The Media Talks About The Media\\\" from these demos. \\\"Lost Time\\\" was released early 2008 and \\\"Spare Time\\\" followed shortly thereafter.  \\\"Lost Time\\\" is Dave\'s acoustic debut, showcasing his talent as songwriter and versatile musician.  The are all of his own original recordings made on Block Island and recorded by himself.  Dave not only wrote all the songs, but also played all the instruments himself.  ','2008','music/dave_flamand/lost_time','music/dave_flamand/lost_time/lost_time.jpg',NULL),(3,'Spare Time','Dave Flamand','The seven songs that make up \\\"Spare Time\\\" are sort of like the companion to \\\"Lost Time\\\" A nice selection of acoustic \\\"b-sides\\\", two of these songs make up the remaing tracks off the debut album by Analog, \\\"When The Media Talks About The Media.\\\" This an exclusive download available from this website, you can\'t get these songs anywhere else. ','2008','music/dave_flamand/spare_time','music/dave_flamand/spare_time/spare_time.jpg',NULL),(4,'Garage Demo','Electro Calrissian','These recordings were done over two sessions form 2008 to 2009 in the Smith\'s garage up in New Hampshire.  They are all live takes from the Garage and feature the original lineup of Zack Smith, Nat MacDonald, and Matt Madison.  I recorded the sessions with different equipment so the quality may vary at times.   ','2008','music/electro_calrissian/garage_demo','music/electro_calrissian/garage_demo/garage_demo.jpg',NULL),(5,'RPM Recordings','Rory Boyan','This recording was done in my apartment up in New Hsmpshire over a two day period (check out the pictures).  Rory and I intended this for the 2009 RPM Challenge but in the end is just became a cool, live, impromptu reocrding of Rory at his creative and spontaneous self.  I apologize for the lack of title, for the next one I\'ll make sure Rory titles his songs, heh.  Anyway, we recorded all these songs live, maybe with a couple of takes, and cut the results.  Hope you enjoy them.','2009','music/rory_boyan/RPM_Recordings','music/rory_boyan/RPM_Recordings/rpm_challenge.jpg',NULL),(6,'Music Mansion Series vol2','Laurent Bonetto','This recording came from a charity performance Laurent performed in March of 2010.  The performance consisted of 10 classical selections and was accompanied with a brief discussion of each group of pieces as the evening went on.  (although they are not included here).  It was a very nice evening that I was fortunate to be a part of.','2010','music/laurent_bonetto/music-mansion-series/vol2','music/laurent_bonetto/music-mansion-series/vol2/album-art.jpg','music/laurent_bonetto/music-mansion-series/vol2/Laurent Bonetto - Music Mansion Series vol2.zip'),(7,'BI Music Fest : Porch Gigs','Various Artists','This is a compilation album of all the various artists who performed on the porch of Captain Nick\'s on June 11th, 2010 as part of Block Island Music Fest.  The recorded artists were Colby Lasorsa, Glenn Roth, Troubaduo, and Analog.  Hope ya dig.','2010','music/various/bi_musicfest2010','music/various/bi_musicfest2010/musicfest2010.jpg',NULL),(8,'Brian Lessard Benefit','Audio Kickstand','A night dedicated to Brian Lessard, Audio Kickstand brought out the good vibes to help a great member of the community during a time of need.  One of my first recordings, this was done using all the original gear I hadl pre-digital.  Not too shabby if I do say so myself.  Enjoy some of Audio Kickstands originals, one of the first bands I ever recorded back when I was starting out.','2008','music/audio_kickstand/brian_lessard_benefit','music/audio_kickstand/brian_lessard_benefit/benefit.jpg',NULL),(9,'Easy','Jay St','Recorded in the spring of 2005, this basement demo captures a great performance from Jay St.; raw and loose.  With Dave starting to show great command over his song writing chops, he is backed up by his roommates Owen and Neal for a five song demo of things to come.','2005','music/jay_st/easy','music/jay_st/easy/easy.jpg',NULL),(10,'Live - From The Basement (set 1)','Jay St','Check out a group of live recordings of Jay St. and Friends jamming in the basement playing some of the crowd favorites.  If you ever came by the house, maybe you\'ll hear your name in the background.  (sorry about the beginning of In My Place, but Neals drumming more than makes up for it)','2005','music/jay_st/live_from_the_basement_set1','music/jay_st/live_from_the_basement_set1/set1.jpg',NULL),(11,'Live - From The Basement (set 2)','Jay St','Check out a group of live recordings of Jay St. and Friends jamming in the basement playing some of the crowd favorites.  If you ever came by the house, maybe you\'ll hear your name in the background.','2005','music/jay_st/live_from_the_basement_set2','music/jay_st/live_from_the_basement_set2/set2.jpg',NULL),(12,'Music Mansion Series vol3','Laurent Bonetto','In June of 2013, Laurant Bonetto performed his final show at the Music Mansion.  The performance consisted of a number of classical selections from the works of Chopin and was accompanied with a brief discussion of each group of pieces as the show went on.','2013','music/laurent_bonetto/music-mansion-series/vol3','music/laurent_bonetto/music-mansion-series/vol3/album-art.jpg','music/laurent_bonetto/music-mansion-series/vol3/Laurent Bonetto - Music Mansion Series vol3.zip'),(13,'Music Mansion Series vol1','Laurent Bonetto','The first in a great series of compelling concerts to come from the partnership of Laurent Bonetto and the Alliance Francaise, we are proud to present Vol. 1 in the Laurent Bonetto Music Mansion Series - Concert \"Suite Francaise\" -- Scaramouche and Company.  Tracks 4 - 9 are 4-hand pieces performed by Laurent Bonetto and Jacqueline Devillers.','2008','music/laurent_bonetto/music-mansion-series/vol1','music/laurent_bonetto/music-mansion-series/vol1/album-art.jpg','music/laurent_bonetto/music-mansion-series/vol1/Laurent Bonetto - Music Mansion Series vol1.zip');
/*!40000 ALTER TABLE `music` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pictures` (
  `albumID` int(11) NOT NULL AUTO_INCREMENT,
  `pAlbumName` varchar(255) NOT NULL DEFAULT '',
  `pArtistName` varchar(255) NOT NULL DEFAULT '',
  `pDescription` longtext NOT NULL,
  `pYear` varchar(4) NOT NULL DEFAULT '',
  `picturesDirectory` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`albumID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pictures`
--

LOCK TABLES `pictures` WRITE;
/*!40000 ALTER TABLE `pictures` DISABLE KEYS */;
INSERT INTO `pictures` VALUES (1,'Music Fest 2008','Analog','These are pictures of Analog playing at Music Fest on Block Island.  Unfortunately I wasn\\\'t there but it sure looked like a good time.','2008','pictures/analog/musicfest08_web'),(2,'Garage Demo','Electro Calrissian','These are shots from the Garage Demo recording done in the Smith\\\'s garage from up in New Hampshire.','2008','pictures/electro_calrissian/ec_garagedemo'),(3,'Block Island Demo Recording','Dave Flamand','I went down in the winter of 2009 to record some demo tracks with Dave in his apartment.  It was a fun time, converting the bedroom into an isolation room and was also the same time we recorded the video\\\'s of Dave\\\'s Youtube music videos.  Haven\\\'t seen them yet?  Well head over to our Youtube page and check them out.','2009','pictures/dave_flamand/bi_demo'),(5,'Old Studio Pics 2008','Analog Studios','These are pictures of my modest home studio from when I lived up in NH, when I was just starting out.  Sure made the best of it, haha.','2008','pictures/analog_studios/old_studio'),(4,'RPM Recordings','Rory Boyan','While I was in NH, Rory came up to record some songs for the RPM Challenge.  He spent the night and we spent two days recording and came out with 14 songs!  Check out the pictures and check out the songs, I\\\'m sure you\'ll like them all.','2009','pictures/rory_boyan/rory_RPM'),(6,'New Studios Pics','Analog Studios','These pictures have been taken of our home studio down here in Rhode Island.  These pictures were taken on the weekend of the Block Island Music Fest, so some of the great is not shown as Dave was using it at the time.  This album will be updated as needed to reflect new gear and additions to the studio, as they happen.','2010','pictures/analog_studios/new_studio'),(7,'BI Music Fest','Various Artists','These pictures were taken while I was on Block Island recording the June 11th performances.  The artists are playing the porch gig hours and kept it rocking all day.  Pictured are Colby Lyn Lasorsa, Troubadou, and Analog.  Glenn Roth was also there.  Check out all the artists originals from this day over in the music section.','2010','pictures/various/BI_MusicFest2010');
/*!40000 ALTER TABLE `pictures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `updates`
--

DROP TABLE IF EXISTS `updates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `updates` (
  `updateID` bigint(20) NOT NULL AUTO_INCREMENT,
  `updateDate` varchar(10) NOT NULL DEFAULT '',
  `updateAuthor` varchar(25) NOT NULL DEFAULT '',
  `updateTitle` varchar(255) NOT NULL DEFAULT '',
  `updateMessage` longtext NOT NULL,
  PRIMARY KEY (`updateID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `updates`
--

LOCK TABLES `updates` WRITE;
/*!40000 ALTER TABLE `updates` DISABLE KEYS */;
INSERT INTO `updates` VALUES (1,'06/08/2010','Owen','Top Downloads','Top Downloads have been added to the left.  They still need to be turned into links and styled.'),(2,'06/08/2010','Owen','Latest Updates','Latest updates still need to be styled and descendingly ordered.'),(3,'06/09/2010','Owen','Left Sidebar','The left sidebar has no been updated to have styled top downloads and a working featured artist section.'),(4,'06/11/2010','Owen','Studio Page Update','I have updated the studio page with some pictures of the studio.'),(5,'06/19/2010','Owen','BI Music Fest Content is Up!','New songs and pictures from the BI Music Fest are now up under Various Artists in either the music or pictures section.'),(6,'06/21/2010','Owen','New Music','I found some old recordings over the weekend of a band I recorded up in New Hampshire back in 2008.  Audio Kickstand music now available in the music section.  Get \'em!'),(7,'06/23/2010','Owen','Internet Radio','Hey folks, Analog Studios Internet Radio is now streaming!  Click the Shoutcast icon above to get a link to hear Analog Studio\'s recordings delivered to you through the power of the internet.'),(8,'8/26/2010','Owen','Jay St in the Artist\'s section!','Hey folks, talk about a blast from the past!  We have old recordings of Jay St. over in the Artist\'s section, both covers and originals!  Good times from the basement are sure to come flooding back!');
/*!40000 ALTER TABLE `updates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'astester','$1$fDUPbgtB$Q3RER8dNV4aBbcw/dys8a/','AS','Tester');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-08 17:07:22
