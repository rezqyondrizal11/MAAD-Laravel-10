/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.28-MariaDB : Database - unp_asset
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admins` */

insert  into `admins`(`id`,`nama`,`email`,`role`,`password`,`token`,`created_at`,`updated_at`) values 
(1,'Ary Syahbana','arysyahbana3@gmail.com','Admin','$2y$10$2jFEJaoklKphTt/RR6rzAucXLJZoBuxpMBr1YWZ3N/iCf2t88QPcC',NULL,NULL,NULL),
(2,'awokawko','ziongi1710@gmail.com','Dosen Reviewer','$2y$10$MLkKMLA9LTC4gBB.IrCTFuzm1Xl8iG0OyIh3wZHGb3yKclfmB5kwG',NULL,'2024-04-17 09:25:51','2024-06-26 10:28:13');

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache` */

/*Table structure for table `cache_locks` */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache_locks` */

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `show_on_menu` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`name`,`show_on_menu`,`created_at`,`updated_at`) values 
(3,'Photo','Show',NULL,NULL),
(4,'Video','Show',NULL,NULL),
(5,'Audio','Show',NULL,NULL);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `likes` */

DROP TABLE IF EXISTS `likes`;

CREATE TABLE `likes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `likes` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2023_03_15_034735_create_posts_table',1),
(6,'2023_03_15_035208_create_categories_table',1),
(7,'2023_03_15_050116_create_admins_table',1),
(8,'2023_03_16_155238_create_sub_categories_table',1),
(9,'2023_04_30_094501_create_likes_table',1),
(10,'2023_12_27_131335_create_cache_table',1),
(11,'2024_01_31_152440_create_orders_table',1),
(12,'2024_02_01_004426_create_prices_table',1),
(13,'2024_05_12_133757_create_sub_category_posts_table',1);

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `price_id` bigint(20) unsigned NOT NULL,
  `snaptoken` varchar(255) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `status` enum('Unpaid','Paid') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_id_unique` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `orders` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `urlgd` varchar(255) DEFAULT NULL,
  `file_mentah` varchar(255) DEFAULT NULL,
  `fpgd` varchar(255) DEFAULT NULL,
  `resolution` varchar(255) DEFAULT NULL,
  `body` text NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `posts` */

insert  into `posts`(`id`,`category_id`,`user_id`,`name`,`slug`,`file`,`url`,`urlgd`,`file_mentah`,`fpgd`,`resolution`,`body`,`status`,`published_at`,`created_at`,`updated_at`) values 
(29,4,1,'link yt','link-yt-2',NULL,'https://www.youtube.com/watch?v=TnYFVP3c_bs',NULL,'rawvideo1713931732.prproj',NULL,NULL,'cxcfchvvbvnnnvb','Pending',NULL,'2024-04-23 16:27:34','2024-04-24 11:08:52'),
(30,4,1,'up gd','up-gd-2',NULL,NULL,'https://drive.google.com/file/d/1NDy4-lEen__NgcNPtEH_Aqxxd1kOlm29/preview?t=1','rawvideo1713932259.aep',NULL,NULL,'asdadsdasd','Pending',NULL,'2024-04-24 11:17:14','2024-04-24 11:17:39'),
(34,5,1,'audio gd','audio-gd',NULL,NULL,'https://drive.google.com/file/d/1tADlnLOuBa78HYYFMCwIkNxzhMv4I5tP/preview','rawaudio1713933936.zip',NULL,NULL,'asdasdasdasd','Pending',NULL,'2024-04-24 11:45:36','2024-04-24 11:45:36'),
(35,3,1,'foto gd','foto-gd',NULL,NULL,'https://drive.google.com/file/d/11fteINu3NV1009fUFUbELOGarzBryhEn/preview',NULL,'https://drive.google.com/file/d/13H_gauwB3uOkYYbUm2UF7YXTE-5xE883/preview',NULL,'asdladkadklas','Pending',NULL,'2024-04-24 11:47:06','2024-04-24 11:47:06'),
(45,4,1,'up yt','up-yt',NULL,'https://www.youtube.com/watch?v=tKG7hOBpR1k',NULL,NULL,NULL,NULL,'asdasdada','Selesai',NULL,'2024-06-21 18:18:44','2024-06-21 20:13:13'),
(51,4,4,'Wuwa','wuwa',NULL,'https://www.youtube.com/watch?v=mpgQI3k4QL0',NULL,'rawvideo1719375237.zip',NULL,NULL,'asdasasd','Selesai',NULL,'2024-06-26 11:13:57','2024-06-26 11:14:08'),
(52,3,4,'asdasd','asdasd-14',NULL,NULL,'https://drive.google.com/file/d/1L322Rj-oq8vH2XKHDY-vHXMrUBuMeLS4/preview?usp=drive_link',NULL,NULL,NULL,'asdasdad','Selesai',NULL,'2024-06-26 11:14:38','2024-06-26 11:17:56'),
(53,3,4,'asdasd','asdasd-16',NULL,NULL,'https://drive.google.com/file/d/1L322Rj-oq8vH2XKHDY-vHXMrUBuMeLS4/preview?usp=drive_link','rawphoto1719375471.zip',NULL,NULL,'asdsadasd','Pending',NULL,'2024-06-26 11:17:17','2024-06-26 11:17:51'),
(54,5,4,'asdasd','asdasd-17',NULL,NULL,'https://drive.google.com/file/d/1tADlnLOuBa78HYYFMCwIkNxzhMv4I5tP/preview?usp=drive_link','rawaudio1719375520.zip',NULL,NULL,'adasdadsads','Selesai',NULL,'2024-06-26 11:18:40','2024-06-26 11:18:52');

/*Table structure for table `prices` */

DROP TABLE IF EXISTS `prices`;

CREATE TABLE `prices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `prices` */

/*Table structure for table `sub_categories` */

DROP TABLE IF EXISTS `sub_categories`;

CREATE TABLE `sub_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sub_category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sub_categories` */

insert  into `sub_categories`(`id`,`sub_category_name`,`created_at`,`updated_at`) values 
(9,'Cartoon','2024-05-12 14:05:51','2024-05-12 14:05:51'),
(11,'Background','2024-05-12 14:58:55','2024-05-12 14:58:55'),
(12,'Games','2024-05-12 18:01:14','2024-05-12 18:01:14'),
(13,'Anime','2024-06-26 10:32:40','2024-06-26 10:32:40');

/*Table structure for table `sub_category_posts` */

DROP TABLE IF EXISTS `sub_category_posts`;

CREATE TABLE `sub_category_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `sub_category_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_category_posts_category_id_foreign` (`category_id`),
  KEY `sub_category_posts_sub_category_id_foreign` (`sub_category_id`),
  KEY `sub_category_posts_post_id_foreign` (`post_id`),
  CONSTRAINT `sub_category_posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sub_category_posts_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sub_category_posts_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sub_category_posts` */

insert  into `sub_category_posts`(`id`,`category_id`,`sub_category_id`,`post_id`,`created_at`,`updated_at`) values 
(39,4,13,45,'2024-07-05 11:35:39','2024-07-05 11:35:39');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `skill` varchar(255) DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `about` longtext DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `contract` date DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `hp` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `premium_expiry` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_nim_unique` (`nim`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`nim`,`skill`,`gender`,`foto_profil`,`about`,`status`,`place`,`contract`,`email`,`hp`,`instagram`,`twitter`,`password`,`token`,`role`,`premium_expiry`,`created_at`,`updated_at`) values 
(1,'Ary','20076034',NULL,'Pria',NULL,NULL,'Tidak Bekerja',NULL,NULL,'arysyahbana1@gmail.com','083184062148',NULL,NULL,'$2y$10$s9wDgOxuFCTOqJiNC9mWteAyxbJ1vrFdNwPzJOEJ2fcRwLvQFFBm6',NULL,'umum',NULL,'2024-04-11 20:28:51','2024-04-24 11:53:08'),
(2,'asd','25098976',NULL,'Pria',NULL,NULL,NULL,NULL,NULL,'asd@gmail.com','086789871625',NULL,NULL,'$2y$10$s9wDgOxuFCTOqJiNC9mWteAyxbJ1vrFdNwPzJOEJ2fcRwLvQFFBm6','ef1039790d787bb658ca1807184788fd2c4760e9ec8b070269d33d86319dd654','umum',NULL,'2024-05-11 11:54:55','2024-05-11 11:54:55'),
(3,'mihoyobgsd','25098979',NULL,'Pria',NULL,NULL,NULL,NULL,NULL,'mihoyobgsd@gmail.com','087262768872',NULL,NULL,'$2y$10$5SRU3aaZ2Ptr8SFjJXqXl./IY9/r7QDDWVJztK9udANWKA54ZmoYW',NULL,'umum',NULL,'2024-06-21 23:47:57','2024-06-21 23:49:13'),
(4,'Adi','25998767',NULL,'Pria',NULL,NULL,NULL,NULL,NULL,'equanimity554@gmail.com','0812345678',NULL,NULL,'$2y$10$r67QVffFBYvCxcxXEPOpWO9Y5nkN9SRqgS9KtZbMA.KQUpQPjbE4.',NULL,'umum',NULL,'2024-06-26 10:12:42','2024-06-26 10:12:42');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
