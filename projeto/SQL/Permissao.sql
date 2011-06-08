/*
SQLyog Enterprise - MySQL GUI v7.12 
MySQL - 5.0.92-community-log : Database - alertaaz_bdTendencia
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`alertaaz_bdTendencia` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci */;

USE `alertaaz_bdTendencia`;

/*Table structure for table `users_has_rules` */

DROP TABLE IF EXISTS `users_has_rules`;

CREATE TABLE `users_has_rules` (
  `id` int(11) NOT NULL auto_increment,
  `users_id` int(11) NOT NULL,
  `users_rules_id` int(11) NOT NULL,
  `ip` varchar(150) NOT NULL,
  `data` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `fk_roles_to_users_users1` (`users_id`),
  KEY `fk_users_has_rules_users_rules1` (`users_rules_id`),
  CONSTRAINT `fk_roles_to_users_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_rules_users_rules1` FOREIGN KEY (`users_rules_id`) REFERENCES `users_rules` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `users_has_rules` */

insert  into `users_has_rules`(`id`,`users_id`,`users_rules_id`,`ip`,`data`) values (1,20,4,'192','2010-12-16 16:01:50'),(2,20,5,'192','2010-12-16 16:01:54'),(3,20,6,'192','2010-12-16 16:01:58'),(4,20,7,'192','2010-12-16 16:02:02'),(5,20,8,'192','2010-12-16 16:02:06'),(6,20,9,'192','2010-12-16 16:02:10'),(7,20,12,'192','2010-12-16 16:02:20');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
