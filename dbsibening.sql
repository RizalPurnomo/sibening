/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.13-MariaDB : Database - dbpkmelearning
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbpkmelearning` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `dbpkmelearning`;

/*Table structure for table `answer` */

DROP TABLE IF EXISTS `answer`;

CREATE TABLE `answer` (
  `idanswer` int(11) NOT NULL AUTO_INCREMENT,
  `idgetcourse` int(11) DEFAULT NULL,
  `idquestion` int(11) DEFAULT NULL,
  `answer` varchar(10) DEFAULT NULL,
  `key` varchar(10) DEFAULT NULL,
  `test` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`idanswer`),
  KEY `idgetcourse` (`idgetcourse`),
  CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`idgetcourse`) REFERENCES `getcourse` (`idgetcourse`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `answer` */

insert  into `answer`(`idanswer`,`idgetcourse`,`idquestion`,`answer`,`key`,`test`) values 
(1,1,1,'A','B',NULL),
(2,1,2,'B','A',NULL),
(3,1,3,'D','D',NULL);

/*Table structure for table `getcourse` */

DROP TABLE IF EXISTS `getcourse`;

CREATE TABLE `getcourse` (
  `idgetcourse` int(11) NOT NULL AUTO_INCREMENT,
  `datecourse` datetime DEFAULT NULL,
  `idpeserta` int(11) DEFAULT NULL,
  `idcourse` int(11) DEFAULT NULL,
  `flag` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idgetcourse`),
  KEY `idpeserta` (`idpeserta`),
  KEY `idcourse` (`idcourse`),
  CONSTRAINT `getcourse_ibfk_1` FOREIGN KEY (`idpeserta`) REFERENCES `mpeserta` (`idpeserta`) ON UPDATE CASCADE,
  CONSTRAINT `getcourse_ibfk_2` FOREIGN KEY (`idcourse`) REFERENCES `mcourse` (`idcourse`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `getcourse` */

insert  into `getcourse`(`idgetcourse`,`datecourse`,`idpeserta`,`idcourse`,`flag`) values 
(1,'2021-06-14 10:56:17',1,2,'Finish'),
(2,'2021-06-29 13:19:59',1,1,'pre');

/*Table structure for table `mcourse` */

DROP TABLE IF EXISTS `mcourse`;

CREATE TABLE `mcourse` (
  `idcourse` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(20) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `jpl` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcourse`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `mcourse` */

insert  into `mcourse`(`idcourse`,`kategori`,`title`,`jpl`) values 
(1,'Kepegawaian','Course Kepegawaian',1),
(2,'IT','Course IT',1);

/*Table structure for table `mpeserta` */

DROP TABLE IF EXISTS `mpeserta`;

CREATE TABLE `mpeserta` (
  `idpeserta` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `namapeserta` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  PRIMARY KEY (`idpeserta`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `mpeserta` */

insert  into `mpeserta`(`idpeserta`,`email`,`namapeserta`,`password`,`lastlogin`) values 
(1,'1','Rizal Purnomo','c6318323cc5693ce1f8d220cc9a5030e','2021-06-29 10:26:12');

/*Table structure for table `mprofile` */

DROP TABLE IF EXISTS `mprofile`;

CREATE TABLE `mprofile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `mprofile` */

insert  into `mprofile`(`id`,`appname`) values 
(1,'PKM E-Learning');

/*Table structure for table `mquestion` */

DROP TABLE IF EXISTS `mquestion`;

CREATE TABLE `mquestion` (
  `idquestion` int(11) NOT NULL AUTO_INCREMENT,
  `idcourse` int(11) DEFAULT NULL,
  `nomor` int(11) DEFAULT NULL,
  `question` longtext DEFAULT NULL,
  `pila` longtext DEFAULT NULL,
  `pilb` longtext DEFAULT NULL,
  `pilc` longtext DEFAULT NULL,
  `pild` longtext DEFAULT NULL,
  `pile` longtext DEFAULT NULL,
  `key` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`idquestion`),
  KEY `idcourse` (`idcourse`),
  CONSTRAINT `mquestion_ibfk_1` FOREIGN KEY (`idcourse`) REFERENCES `mcourse` (`idcourse`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `mquestion` */

insert  into `mquestion`(`idquestion`,`idcourse`,`nomor`,`question`,`pila`,`pilb`,`pilc`,`pild`,`pile`,`key`) values 
(1,2,1,'Hitung 1+1','1','2','3','4','5','B'),
(2,2,2,'Hitung 14-3','11','12','13','14','15','A'),
(3,2,3,'Hitung 2+5','4','5','6','7','8','D');

/*Table structure for table `muser` */

DROP TABLE IF EXISTS `muser`;

CREATE TABLE `muser` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `realname` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `muser` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
