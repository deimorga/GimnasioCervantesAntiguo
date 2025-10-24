/*
SQLyog Community v8.71 
MySQL - 5.1.33-community : Database - artmsoft_db_gimnasio_cervantes
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tbl_actividad_aula` */

CREATE TABLE `tbl_actividad_aula` (
  `id_actividad_aula` int(10) NOT NULL AUTO_INCREMENT,
  `tema_actividad_aula` varchar(500) DEFAULT NULL,
  `objetivos_actividad_aula` varchar(10000) DEFAULT NULL,
  `indicaciones_actividad_aula` varchar(10000) DEFAULT NULL,
  `id_profesor` decimal(10,0) DEFAULT NULL,
  `fecha_actividad_aula` date DEFAULT NULL,
  PRIMARY KEY (`id_actividad_aula`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_actividad_aula_grupo_asignatura` */

CREATE TABLE `tbl_actividad_aula_grupo_asignatura` (
  `id_actividad_aula_grupo_asignatura` int(10) NOT NULL AUTO_INCREMENT,
  `id_actividad_aula` int(10) DEFAULT NULL,
  `id_grupo_asignatura` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_actividad_aula_grupo_asignatura`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_elemento` */

CREATE TABLE `tbl_elemento` (
  `id_elemento` int(10) NOT NULL AUTO_INCREMENT,
  `id_tipo_elemento` int(10) DEFAULT NULL,
  `id_actividad_aula` int(10) DEFAULT NULL,
  `titulo_elemento` varchar(3000) DEFAULT NULL,
  `descripcion_elemento` varchar(10000) DEFAULT NULL,
  PRIMARY KEY (`id_elemento`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_pregunta` */

CREATE TABLE `tbl_pregunta` (
  `id_pregunta` int(10) NOT NULL AUTO_INCREMENT,
  `id_tipo_pregunta` int(10) DEFAULT NULL,
  `enunciado_pregunta` varchar(3000) DEFAULT NULL,
  `id_respuesta` int(10) DEFAULT NULL,
  `id_actividad_aula` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_pregunta`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_respuesta` */

CREATE TABLE `tbl_respuesta` (
  `id_respuesta` int(10) NOT NULL AUTO_INCREMENT,
  `id_pregunta` int(10) DEFAULT NULL,
  `respuesta_1` varchar(3000) DEFAULT NULL,
  `respuesta_2` varchar(3000) DEFAULT NULL,
  PRIMARY KEY (`id_respuesta`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_tipo_elemento` */

CREATE TABLE `tbl_tipo_elemento` (
  `id_tipo_elemento` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_elemento` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_elemento`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_tipo_pregunta` */

CREATE TABLE `tbl_tipo_pregunta` (
  `id_tipo_pregunta` int(2) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_pregunta` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_pregunta`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
