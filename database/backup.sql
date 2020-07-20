/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.4.11-MariaDB : Database - retodev
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`retodev` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `retodev`;

/*Table structure for table `asig_cursos` */

DROP TABLE IF EXISTS `asig_cursos`;

CREATE TABLE `asig_cursos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `asig_cursos` */

/*Table structure for table `curso_estudiante` */

DROP TABLE IF EXISTS `curso_estudiante`;

CREATE TABLE `curso_estudiante` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `curso_id` bigint(20) unsigned NOT NULL,
  `estudiante_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `curso_estudiante_curso_id_estudiante_id_unique` (`curso_id`,`estudiante_id`),
  KEY `curso_estudiante_estudiante_id_foreign` (`estudiante_id`),
  CONSTRAINT `curso_estudiante_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`),
  CONSTRAINT `curso_estudiante_estudiante_id_foreign` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiantes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `curso_estudiante` */

insert  into `curso_estudiante`(`id`,`curso_id`,`estudiante_id`,`created_at`,`updated_at`) values (1,1,11,'2020-07-19 00:00:00','2020-07-19 00:00:00'),(2,1,8,'2020-07-19 00:00:00','2020-07-19 00:00:00'),(3,1,5,'2020-07-19 00:00:00','2020-07-19 00:00:00'),(4,1,17,'2020-07-19 00:00:00','2020-07-19 00:00:00'),(5,1,16,'2020-07-19 00:00:00','2020-07-19 00:00:00'),(6,5,6,'2020-07-19 00:00:00','2020-07-19 00:00:00'),(7,5,8,'2020-07-19 00:00:00','2020-07-19 00:00:00'),(8,5,3,'2020-07-19 00:00:00','2020-07-19 00:00:00'),(9,5,10,'2020-07-19 00:00:00','2020-07-19 00:00:00'),(11,10,14,'2020-07-19 00:00:00','2020-07-19 00:00:00'),(12,10,17,'2020-07-19 00:00:00','2020-07-19 00:00:00'),(13,10,12,'2020-07-19 00:00:00','2020-07-19 00:00:00'),(14,13,8,'2020-07-19 00:00:00','2020-07-19 00:00:00'),(15,13,5,'2020-07-19 00:00:00','2020-07-19 00:00:00'),(16,7,6,'2020-07-19 20:56:43',NULL);

/*Table structure for table `curso_horario` */

DROP TABLE IF EXISTS `curso_horario`;

CREATE TABLE `curso_horario` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `curso_id` bigint(20) unsigned NOT NULL,
  `horario_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `curso_horario_curso_id_horario_id_unique` (`curso_id`,`horario_id`),
  KEY `curso_horario_horario_id_foreign` (`horario_id`),
  CONSTRAINT `curso_horario_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`),
  CONSTRAINT `curso_horario_horario_id_foreign` FOREIGN KEY (`horario_id`) REFERENCES `horarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `curso_horario` */

insert  into `curso_horario`(`id`,`curso_id`,`horario_id`,`created_at`,`updated_at`) values (1,1,1,NULL,NULL),(2,2,2,NULL,NULL),(3,3,5,NULL,NULL),(4,4,3,NULL,NULL),(5,5,4,NULL,NULL),(6,6,2,NULL,NULL),(7,7,2,NULL,NULL),(8,8,6,NULL,NULL),(9,9,8,NULL,NULL),(10,10,2,NULL,NULL),(11,11,3,NULL,NULL),(12,12,7,NULL,NULL),(13,13,6,NULL,NULL);

/*Table structure for table `cursos` */

DROP TABLE IF EXISTS `cursos`;

CREATE TABLE `cursos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cursos` */

insert  into `cursos`(`id`,`nombre`,`fecha_inicio`,`fecha_fin`,`created_at`,`updated_at`) values (1,'Matemáticas Discretas','2020-07-01','2020-07-18','2020-07-19 20:12:32','2020-07-19 20:12:32'),(2,'Informática 1','2020-07-10','2020-07-23','2020-07-19 20:12:54','2020-07-19 20:12:54'),(3,'Metodología de la Investigación','2020-07-09','2020-07-16','2020-07-19 20:13:22','2020-07-19 20:13:22'),(4,'Compiladores','2020-07-04','2020-07-10','2020-07-19 20:13:40','2020-07-19 20:13:40'),(5,'Estadística 1','2020-07-03','2020-07-03','2020-07-19 20:13:57','2020-07-19 20:13:57'),(6,'Estadistica 2','2020-07-01','2020-07-02','2020-07-19 20:14:15','2020-07-19 20:14:15'),(7,'Ecuaciones Diferenciales','2020-07-03','2020-07-16','2020-07-19 20:14:35','2020-07-19 20:14:35'),(8,'Cáclulo Vectorial','2020-07-03','2020-07-04','2020-07-19 20:14:52','2020-07-19 20:14:52'),(9,'Investigación de Operaciones','2020-07-02','2020-07-31','2020-07-19 20:15:13','2020-07-19 20:15:13'),(10,'Base de datos','2020-07-03','2020-07-04','2020-07-19 20:15:30','2020-07-19 20:15:30'),(11,'Base de datos Distribuídas','2020-07-03','2020-07-24','2020-07-19 20:15:49','2020-07-19 20:15:49'),(12,'Networking con Linux','2020-07-16','2020-07-09','2020-07-19 20:16:07','2020-07-19 20:16:07'),(13,'Inteligencia Artificial','2020-07-01','2020-07-31','2020-07-19 20:16:27','2020-07-19 20:16:27');

/*Table structure for table `estudiantes` */

DROP TABLE IF EXISTS `estudiantes`;

CREATE TABLE `estudiantes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edad` int(11) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `estudiantes_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `estudiantes` */

insert  into `estudiantes`(`id`,`nombre`,`apellido`,`edad`,`email`,`created_at`,`updated_at`) values (1,'Jailton','Yanes',39,'jailtonyanesromero@gmail.com','2020-07-19 20:05:21','2020-07-19 20:05:21'),(2,'Osiris','Yanes',41,'oyanes@gmail.com','2020-07-19 20:05:42','2020-07-19 20:05:42'),(3,'Lisbeth','Romero',38,'lromero@gmail.com','2020-07-19 20:06:03','2020-07-19 20:06:03'),(4,'Walter','Gomez',42,'walgom@gmail.com','2020-07-19 20:06:22','2020-07-19 20:06:22'),(5,'Daynis','Caro',41,'dcaro@gmail.com','2020-07-19 20:06:43','2020-07-19 20:06:43'),(6,'Johan','Ramos',41,'jramos@gmail.com','2020-07-19 20:07:04','2020-07-19 20:07:04'),(7,'Wilson','Yanes',45,'wyanes@gmail.com','2020-07-19 20:07:25','2020-07-19 20:07:25'),(8,'Sabrina','Bastos',36,'sbastos@gmail.com','2020-07-19 20:07:45','2020-07-19 20:07:45'),(9,'Rubén','Ezenarro',40,'rezenarro@gmail.com','2020-07-19 20:08:09','2020-07-19 20:08:09'),(10,'Hector','Ulloque',35,'hulloque@gmail.com','2020-07-19 20:08:28','2020-07-19 20:08:28'),(11,'Carmen','Angulo',36,'cangulo@gmail.com','2020-07-19 20:08:45','2020-07-19 20:08:45'),(12,'Sheryl','Yanes',13,'syanes@gmail.com','2020-07-19 20:09:15','2020-07-19 20:09:15'),(13,'Narciza','Romero',65,'nromero@gmail.com','2020-07-19 20:09:29','2020-07-19 20:09:29'),(14,'Mateo','Gamarra',43,'mgamarra@gmail.com','2020-07-19 20:09:43','2020-07-19 20:09:43'),(15,'Kiara','Yanes',4,'kyanes@gmail.com','2020-07-19 20:10:07','2020-07-19 20:10:07'),(16,'Nairobys','De la Torre',40,'ndelatorre@gmail.com','2020-07-19 20:10:42','2020-07-19 20:10:42'),(17,'Noely','Da Silva',21,'ndasilva@gmail.com','2020-07-19 20:11:00','2020-07-19 20:11:00');

/*Table structure for table `horarios` */

DROP TABLE IF EXISTS `horarios`;

CREATE TABLE `horarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `horarios_description_unique` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `horarios` */

insert  into `horarios`(`id`,`description`,`created_at`,`updated_at`) values (1,'06:00-06:59','2020-07-19 20:04:21','2020-07-19 20:04:21'),(2,'07:00-07:59','2020-07-19 20:04:21','2020-07-19 20:04:21'),(3,'08:00-08:59','2020-07-19 20:04:21','2020-07-19 20:04:21'),(4,'09:00-09:59','2020-07-19 20:04:21','2020-07-19 20:04:21'),(5,'10:00-10:59','2020-07-19 20:04:21','2020-07-19 20:04:21'),(6,'11:00-11:59','2020-07-19 20:04:21','2020-07-19 20:04:21'),(7,'12:00-12:59','2020-07-19 20:04:21','2020-07-19 20:04:21'),(8,'13:00-13:59','2020-07-19 20:04:21','2020-07-19 20:04:21'),(9,'14:00-14:59','2020-07-19 20:04:21','2020-07-19 20:04:21'),(10,'15:00-15:59','2020-07-19 20:04:21','2020-07-19 20:04:21'),(11,'16:00-16:59','2020-07-19 20:04:21','2020-07-19 20:04:21'),(12,'17:00-17:59','2020-07-19 20:04:21','2020-07-19 20:04:21'),(13,'18:00-18:59','2020-07-19 20:04:21','2020-07-19 20:04:21');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2020_07_17_125347_create_estudiantes_table',1),(4,'2020_07_17_125414_create_horarios_table',1),(5,'2020_07_17_125415_create_cursos_table',1),(6,'2020_07_17_181356_create_curso_estudiante_table',1),(7,'2020_07_18_174015_create_curso_horario_table',1),(8,'2020_07_18_193931_create_asig_cursos_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values (1,'jailtonyanesromero@gmail.com',NULL,'$2y$10$/VhmflFOmkMMFblMZY.JkOR.tidby77a6UCTyopY8TpPqVLMJARmm',NULL,'2020-07-19 20:05:04','2020-07-19 20:05:04');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
