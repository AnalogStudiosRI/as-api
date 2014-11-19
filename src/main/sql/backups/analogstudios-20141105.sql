CREATE DATABASE  IF NOT EXISTS `asadmin_analogstudios` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `asadmin_analogstudios`;
-- MySQL dump 10.13  Distrib 5.6.13, for osx10.6 (i386)
--
-- Host: localhost    Database: asadmin_analogstudios
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
  `artistID` int(255) NOT NULL AUTO_INCREMENT,
  `artistName` varchar(255) NOT NULL DEFAULT '',
  `artistPicture` varchar(255) NOT NULL DEFAULT '',
  `artistGenre` varchar(255) NOT NULL DEFAULT '',
  `artistCity` varchar(255) NOT NULL DEFAULT '',
  `artistState` tinytext NOT NULL,
  `artistLabel` varchar(255) NOT NULL DEFAULT '',
  `artistContact` varchar(255) NOT NULL DEFAULT '',
  `artistBio` longtext NOT NULL,
  `isActive` tinytext NOT NULL,
  PRIMARY KEY (`artistID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artists`
--

LOCK TABLES `artists` WRITE;
/*!40000 ALTER TABLE `artists` DISABLE KEYS */;
INSERT INTO `artists` VALUES (2,'Electro Calrissian','pictures/electro_calrissian/ec.jpg','Punk Rock','North Conway','NH','Analog Studios','electrocalrissian@gmail.com','<span class=\\\"bigger\\\">A</span> hard rock band from Conway, NH, Electro Calrissian knows how to crank out the tunes. Once a solid three piece, these days the lineup features songwriter Zack Smith on guitars, bass, and vocals and Nat MacDonald also playing guitar, bass, and singing.  Aside from their usual gigs, Zack can often be found playing down at Open Mic on Mondays at the Red Parka Pub or Matty Bs Pizza. Check out their MySpace page for more up to date info, music, and news, maintained by their good friend and manager, Aldon Miller.','true'),(1,'Analog','pictures/analog/analog.jpg','Rock and Roll','Block Island','RI','Analog Studios','dflamand@yahoo.com','<span class=\\\"bigger\\\">F</span>rom the smallest town in the smallest state, Analog Studios presents Block Islands very own, Analog! Analog is a local Block Island, Rhode Island band.  Currently the lineup consists of singer\\/songwriter\\/guitarist Dave Flamand, and bassist Morgan Macia. Daves demo CD, \\\"Lost Time\\\" (available for free download at our music page) provided the framework by which he could start a band to help him bring his songs out to the public in the way that only a band can. We encourage you to go to our MySpace page and check out their debut E.P. \\\"When the Media Talks About the Media.\\\"','yes'),(3,'Rory Boyan','pictures/rory_boyan/rory.jpg','Jam/Instrumental','Lowell','MA','Analog Studios','roryboyan@yahoo.com','<span class=\\\"bigger\\\">O</span>ne of my best friends, Rory plays instrumental music in a genre all to his own. Combining elements of blues, reggae, and percussion into his guitar playing, Rory manages to create something unique to him, and him alone. If you like chilled out and inspiring music, then you found your man.','true'),(4,'Laurent Bonetto','pictures/laurent_bonetto/laurent.jpg','Classical','Providence','RI','Analog Studios','lbonetto-at-yahoo.com','While pursuing a scientific career, Laurent has always kept playing the piano as one of the main occupations of his life; a passion he has had since the age of 5.  Since the age of 15, he has practiced with concert pianist Nathalie Bera-Tagrine, with whom he studies when he returns to France.  Laurent has taken numerous masters classes in Europe and the US, participated in many concerts, and competitions, and has recorded two piano CD\'s.','true'),(5,'The Silks','Silks Picture Here','Blues/Rock','Providence','RI','N/A','T.J.@email.com','The Silks are cool jazz rock band originating out of the Providence area.','false'),(6,'Dave Flamand','pictures/dave_flamand/dave.jpg','Acoustic/Rock','Block Island','RI','Analog Studios','d.flamand@yahoo.com','Dave Flamand is a talented singer-songwriter from the Block Island area.  Dave is well known on the island for his fun and energetic open mics, where he plays originals as well as covering great acts like Neil Young, the Beatles, Oasis, Blur, and Radiohead.  Dave is also the front man for the rock band Analog and records for both himself and his band.  Check him out live on Block Island or around Providence, RI.  You can keep up with his schedule by following our events page and following Analog Studios social networking sites.','true'),(7,'Analog Studios','pictures/analog_studios/analog_studios.jpg','N/A','South County','RI','','owen@analogstudios.net','<p><span class=\"bigger\">A</span>nalog Studios was created by me, Owen Buckley back in the winter of 2007 when I came into possession of a Fostex 812 Mixer and Fostex R8 reel-to-reel analog tape recorder. Up until the beginning of 2009, I was able to take my computer and install an Echo Gina 20-bit PCI soundcard which connected to an audio breakout box which featured two inputs and eight outputs and recorded through the mixer with master stereo outputs.</p>\r\n\r\n<p>Now the computer has been upgraded to a MacBook Intel Core 2 Duo 2.4GHz (running OSX 10.5.6 - Leopard), with 4G RAM, and a 160G HD running Reaper v3.52 for live performance. In the studio Im running an i7 920 running Windows 64-but with 6G of RAM.  The audio interface is a MOTU 828 mk3. This setup makes for a very powerful and flexible rig for recording live or with the reel-to-reel, digitally or analog, with the option to run through hardware or software based processors. You can go all digital, or bask in the warmth of analog. (analog only applies to tracked sessions, I will not bring the R8 to live shows\\/bars, etc, for obvious reasons.)</p>\r\n\r\n<p>Some of the other hardware I have includes an Apex 460 tube condensor microphone (great for almost any situation, and was used extensively for just about everything on \"When The Media Talks About The Media\"), an Alesis Midiverb 4, an Alesis M EQ-230, an Alesis 3630 Compressor, a BBE Sonic Maximizer, and a Behringer Ultrapatch Pro. I have Ampex 457 tape for the reel-to-reel. For audio editing I have Sony Soundforge and for basic mastering, I have Har-Bal.</p>','true'),(8,'Various Artists','pictures/various/various.jpg','N/A','N/A','N/A','N/A','N/A','This is a compilation profile for various recordings and musical compilations.','true'),(9,'Audio Kickstand','pictures/audio_kickstand/audio_kickstand.jpg','Jam/Rock','Glen','NH','N/A','N/A','A great rock and jam band from Glen, NH, Audio Kickstand really knows how to get you out of your seat and dancing! This band is a prominent fixture down at the Red Parka Pub and you can almost always hear them playing Monday nights there for Open Mic. You can visit their myspace page for more news and info.','true'),(10,'Jay St','pictures/jay_st/jay_st.jpg','Rock and Roll','Fitchburg','MA','Analog Studios','N/A','Hailing from the basement of the coolest house on the craziest cobblestone hill,  in Fitchburg, MA, Jay St. was the party band of the Fitchburg scene during the years of 2003-2005.  While actively playing out at Hoolingans bar, they were also well known for throwing some of the best parties.  (Even during the winter!)  Even though they are no more, their infamy lives on thanks to their recordings being unearthed and posted for all to enjoy.  So, if the dude abides, then so do we.  Oh yeah, mind if I do a J?','true');
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-11-05 18:06:25
