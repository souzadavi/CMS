/*
SQLyog Enterprise - MySQL GUI v7.12 
MySQL - 5.0.92-community-log : Database - altacomu_database
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`altacomu_database` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci */;

USE `altacomu_database`;

/*Table structure for table `conteudo_youtube` */

DROP TABLE IF EXISTS `conteudo_youtube`;

CREATE TABLE `conteudo_youtube` (
  `id` int(11) NOT NULL auto_increment COMMENT '						',
  `users_id` int(11) NOT NULL,
  `titulo` varchar(45) collate latin1_general_ci NOT NULL,
  `youtubeID` varchar(100) collate latin1_general_ci NOT NULL,
  `url` varchar(150) collate latin1_general_ci default NULL,
  `views` int(11) default NULL,
  `data` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `fk_conteudo_youtube_users1` (`users_id`),
  CONSTRAINT `fk_conteudo_youtube_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `conteudo_youtube` */

insert  into `conteudo_youtube`(`id`,`users_id`,`titulo`,`youtubeID`,`url`,`views`,`data`) values (2,20,'Alta Comunicazione - Trabalhos 3D 2010','i65BnVFDEV4','http://www.youtube.com/watch?v=i65BnVFDEV4',NULL,'2011-01-13 11:20:22');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
