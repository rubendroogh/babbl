-- --------------------------------------------------------
-- Host:                         localhost
-- Server versie:                5.7.18 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Versie:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Structuur van  tabel api.groups wordt geschreven
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(63) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel api.groups: ~4 rows (ongeveer)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `updated_at`, `created_at`) VALUES
	(1, 'Groepje', '2018-09-14 12:06:36', '2018-09-14 12:06:36'),
	(2, 'Plebs', '2018-09-14 13:06:54', '2018-09-14 13:06:54'),
	(3, 'Nieuwe plebs', '2018-09-14 13:10:52', '2018-09-14 13:10:52'),
	(4, 'Nieuwe plebs', '2018-09-14 13:11:05', '2018-09-14 13:11:05');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Structuur van  tabel api.group_users wordt geschreven
CREATE TABLE IF NOT EXISTS `group_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `group_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_users_user_id` (`user_id`),
  KEY `group_users_group_id` (`group_id`),
  CONSTRAINT `group_users_group_id` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  CONSTRAINT `group_users_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel api.group_users: ~2 rows (ongeveer)
/*!40000 ALTER TABLE `group_users` DISABLE KEYS */;
INSERT INTO `group_users` (`id`, `user_id`, `group_id`) VALUES
	(2, 2, 1),
	(3, 2, 4);
/*!40000 ALTER TABLE `group_users` ENABLE KEYS */;

-- Structuur van  tabel api.messages wordt geschreven
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `read` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `messages_group_id` (`group_id`),
  KEY `messages_user_id` (`user_id`),
  CONSTRAINT `messages_group_id` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  CONSTRAINT `messages_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel api.messages: ~14 rows (ongeveer)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `content`, `read`, `user_id`, `group_id`, `updated_at`, `created_at`) VALUES
	(5, 'Test', 0, 2, 1, '2018-09-14 10:34:15', '2018-09-14 10:34:15'),
	(6, 'Halloo', 0, 2, 1, '2018-09-14 10:34:34', '2018-09-14 10:34:34'),
	(7, '<h2>hoi</h2>', 0, 2, 1, '2018-09-14 10:34:49', '2018-09-14 10:34:49'),
	(8, 'sdds', 0, 2, 1, '2018-09-14 10:52:27', '2018-09-14 10:52:27'),
	(9, 'Tessst', 0, 2, 1, '2018-09-14 10:53:28', '2018-09-14 10:53:28'),
	(10, 'Blamo', 0, 2, 2, '2018-09-14 13:07:03', '2018-09-14 13:07:03'),
	(11, 'Halloo', 0, 2, 4, '2018-09-14 13:13:41', '2018-09-14 13:13:41'),
	(12, '<script>alert(\'pleb\');</script>', 0, 2, 1, '2018-09-14 13:22:40', '2018-09-14 13:22:40'),
	(13, '+"<script>alert(\'pleb\');</script>"+', 0, 2, 1, '2018-09-14 13:23:26', '2018-09-14 13:23:26'),
	(14, '+\'<script>alert(\'pleb\');</script>\'+', 0, 2, 1, '2018-09-14 13:23:41', '2018-09-14 13:23:41'),
	(15, '+\'<script>alert("pleb");</script>\'+', 0, 2, 1, '2018-09-14 13:23:54', '2018-09-14 13:23:54'),
	(16, '+\'alert(\'pleb\');\'+', 0, 2, 1, '2018-09-14 13:24:06', '2018-09-14 13:24:06'),
	(17, '+\'alert(\'pleb\');+\'', 0, 2, 1, '2018-09-14 13:24:21', '2018-09-14 13:24:21'),
	(18, '\'+alert(\'pleb\');+\'', 0, 2, 1, '2018-09-14 13:24:32', '2018-09-14 13:24:32');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Structuur van  tabel api.users wordt geschreven
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumpen data van tabel api.users: ~2 rows (ongeveer)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(2, 'Ruben', 'rubendroogh@hotmail.nl', '$2y$10$mrTtmZQJjuCr4uD51yPP2uuKCfNSSVS.Fu9RyJQ93vq5aVZcuv9R6', 'pqC0ZYHXdlKIMrtLV2AEIm70rEYrr0pN51XndPMngokDsBciGq0750fcV7yh', '2018-09-07 10:10:48', '2018-09-07 10:10:48'),
	(3, 'Andere Ruben', 'rr@rr.nl', '$2y$10$J7DUniSJ/YIRwjAG0TM5We8G9ee1MYXa93SJ./PyIL.lbCxIyFExe', NULL, '2018-09-07 11:48:28', '2018-09-07 11:48:28');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
