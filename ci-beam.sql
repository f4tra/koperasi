-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `acl_resources`;
CREATE TABLE `acl_resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` enum('module','controller','action','other') NOT NULL DEFAULT 'other',
  `parent` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `acl_resources` (`id`, `name`, `type`, `parent`, `created`, `modified`) VALUES
(1, 'welcome',  'module',   NULL,   '2012-11-12 12:07:26',  NULL),
(2, 'authorize',    'module',   NULL,   '2012-11-12 04:00:23',  NULL),
(3, 'authorize/login',  'controller',   2,  '2012-11-12 12:43:42',  '2012-11-12 12:44:06'),
(4, 'authorize/logout', 'controller',   2,  '2012-11-12 12:43:56',  NULL),
(5, 'authorize/user',   'controller',   2,  '2012-11-12 04:07:59',  '2012-11-12 08:29:29'),
(6, 'acl',  'module',   NULL,   '2012-02-02 13:47:43',  NULL),
(7, 'acl/resource', 'controller',   6,  '2012-02-02 13:47:57',  NULL),
(8, 'acl/resource/index',   'action',   7,  '2012-02-02 13:48:21',  NULL),
(9, 'acl/resource/add', 'action',   7,  '2012-02-02 13:48:35',  '2012-10-16 17:26:12'),
(10,    'acl/resource/edit',    'action',   7,  '2012-02-02 13:48:50',  '2012-07-09 18:44:38'),
(11,    'acl/resource/delete',  'action',   7,  '2012-02-02 13:49:06',  NULL),
(12,    'acl/role', 'controller',   6,  '2012-07-12 17:54:16',  NULL),
(13,    'acl/role/index',   'action',   12, '2012-07-12 17:55:29',  NULL),
(14,    'acl/role/add', 'action',   12, '2012-07-12 17:56:00',  NULL),
(15,    'acl/role/edit',    'action',   12, '2012-07-12 17:56:19',  NULL),
(16,    'acl/role/delete',  'action',   12, '2012-07-12 17:56:55',  NULL),
(17,    'acl/rule', 'controller',   6,  '2012-07-12 17:53:04',  NULL),
(18,    'acl/rule/edit',    'action',   17, '2012-07-12 17:53:25',  NULL),
(19,    'blog', 'module',   NULL,   '2015-06-15 11:11:28',  NULL),
(22,    'cms',  'module',   NULL,   '2015-06-16 15:01:55',  '2015-06-16 15:01:55'),
(23,    'cms/post', 'controller',   22, '2015-06-16 15:32:53',  '2015-06-21 09:09:44'),
(24,    'setup',    'module',   NULL,   '2015-06-20 14:07:00',  NULL),
(25,    'setup/menu',   'controller',   24, '2015-06-20 14:07:47',  NULL),
(26,    'setup/menu/index', 'action',   25, '2015-06-20 14:08:14',  NULL),
(27,    'setup/menu/add',   'action',   25, '2015-06-20 14:08:30',  '2015-06-20 14:08:50'),
(28,    'setup/menu/edit',  'action',   25, '2015-06-20 14:09:39',  NULL),
(29,    'setup/menu/delete',    'action',   25, '2015-06-20 14:10:33',  NULL),
(30,    'cms/post/index',   'action',   23, '2015-06-21 09:10:55',  NULL),
(31,    'cms/post/add', 'action',   23, '2015-06-21 09:11:17',  NULL),
(32,    'cms/post/edit',    'action',   23, '2015-06-21 09:11:32',  NULL),
(33,    'transaksi',    'module',   NULL,   '2015-06-21 10:12:22',  NULL),
(34,    'setup/koperasi',   'controller',   24, '2015-06-21 10:26:03',  NULL);

DROP TABLE IF EXISTS `acl_roles`;
CREATE TABLE `acl_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=26;

INSERT INTO `acl_roles` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Administrator',    '2011-12-27 12:00:00',  NULL),
(2, 'Guest',    '2011-12-27 12:00:00',  NULL),
(3, 'Staf', '2012-11-12 04:30:02',  '2015-06-20 18:37:02'),
(4, 'Manager',  '2012-11-12 04:30:24',  NULL);

DROP TABLE IF EXISTS `acl_role_parents`;
CREATE TABLE `acl_role_parents` (
  `role_id` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`,`parent`),
  KEY `parent` (`parent`),
  CONSTRAINT `acl_role_parents_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `acl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `acl_role_parents_ibfk_2` FOREIGN KEY (`parent`) REFERENCES `acl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `acl_role_parents` (`role_id`, `parent`, `order`) VALUES
(4, 3,  0);

DROP TABLE IF EXISTS `acl_rules`;
CREATE TABLE `acl_rules` (
  `role_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `access` enum('allow','deny') NOT NULL DEFAULT 'deny',
  `priviledge` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`,`resource_id`),
  KEY `resource_id` (`resource_id`),
  CONSTRAINT `acl_rules_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `acl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `acl_rules_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `acl_resources` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `acl_rules` (`role_id`, `resource_id`, `access`, `priviledge`) VALUES
(2, 1,  'allow',    NULL),
(2, 2,  'allow',    NULL),
(2, 3,  'allow',    NULL),
(2, 4,  'allow',    NULL),
(4, 2,  'allow',    NULL),
(4, 5,  'allow',    NULL),
(4, 34, 'allow',    NULL);

DROP TABLE IF EXISTS `auth_autologin`;
CREATE TABLE `auth_autologin` (
  `user` int(11) NOT NULL,
  `series` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`user`,`series`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `auth_users`;
CREATE TABLE `auth_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lang` varchar(2) DEFAULT NULL,
  `registered` datetime NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `auth_users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `acl_roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `auth_users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `lang`, `registered`, `role_id`) VALUES
(1, 'Administrator ',   'Tea Change',   'admin',    'admin@vmt.co.id',  '$2a$08$k8ExsWAe1qAyk2A/0tbvoeg/ahOb6DpQBnohcZvG79TNr28K5vNHe', 'en',   '2012-03-15 19:23:59',  1),
(2, 'Ardi', 'Soebrata', 'ardissoebrata',    'ardissoebrata@gmail.com',  '$2a$08$KZRME/RCMM.ikhJvS9IQtOD/qQcM/922akreUjQ7fgL6BanTAwsIm', 'en',   '2012-03-09 12:57:48',  4),
(3, 'Test', 'TestLast', 'test', 'test@test.com',    'test', 'en',   '2012-11-09 10:58:34',  2),
(4, 'Jafar',    'Jafar',    'Jafar',    'sidik@gmail.com',  '$2a$08$2bxOAffgRUPksG4Ay4j/Sew9dDsb6eU4iWZHIGJj54eoY6f8xobJe', 'en',   '2015-06-21 09:34:52',  4);

DROP TABLE IF EXISTS `auth_users_master`;
CREATE TABLE `auth_users_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registered` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `auth_users_master` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `registered`) VALUES
(1002,  'Diane',    'Murphy',   'dmurphy',  'dmurphy@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1056,  'Mary', 'Patterson',    'mpatterso',    'mpatterso@classicmodelcars.com',   '', '2012-03-01 05:54:30'),
(1076,  'Jeff', 'Firrelli', 'jeff.firrelli',    'jeff.firrelli@classicmodelcars.com',   '', '2012-03-01 05:54:30'),
(1088,  'William',  'Patterson',    'wpatterson',   'wpatterson@classicmodelcars.com',  '', '2012-03-01 05:54:30'),
(1102,  'Gerard',   'Bondur',   'gbondur',  'gbondur@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1143,  'Anthony',  'Bow',  'abow', 'abow@classicmodelcars.com',    '', '2012-03-01 05:54:30'),
(1165,  'Leslie',   'Jennings', 'ljennings',    'ljennings@classicmodelcars.com',   '', '2012-03-01 05:54:30'),
(1166,  'Leslie',   'Thompson', 'lthompson',    'lthompson@classicmodelcars.com',   '', '2012-03-01 05:54:30'),
(1188,  'Julie',    'Firrelli', 'julie.firrelli',   'julie.firrelli@classicmodelcars.com',  '', '2012-03-01 05:54:30'),
(1216,  'Steve',    'Patterson',    'spatterson',   'spatterson@classicmodelcars.com',  '', '2012-03-01 05:54:30'),
(1286,  'Foon Yue', 'Tseng',    'ftseng',   'ftseng@classicmodelcars.com',  '', '2012-03-01 05:54:30'),
(1323,  'George',   'Vanauf',   'gvanauf',  'gvanauf@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1337,  'Loui', 'Bondur',   'lbondur',  'lbondur@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1370,  'Gerard',   'Hernandez',    'ghernande',    'ghernande@classicmodelcars.com',   '', '2012-03-01 05:54:30'),
(1401,  'Pamela',   'Castillo', 'pcastillo',    'pcastillo@classicmodelcars.com',   '', '2012-03-01 05:54:30'),
(1501,  'Larry',    'Bott', 'lbott',    'lbott@classicmodelcars.com',   '', '2012-03-01 05:54:30'),
(1504,  'Barry',    'Jones',    'bjones',   'bjones@classicmodelcars.com',  '', '2012-03-01 05:54:30'),
(1611,  'Andy', 'Fixter',   'afixter',  'afixter@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1612,  'Peter',    'Marsh',    'pmarsh',   'pmarsh@classicmodelcars.com',  '', '2012-03-01 05:54:30'),
(1619,  'Tom',  'King', 'tking',    'tking@classicmodelcars.com',   '', '2012-03-01 05:54:30'),
(1621,  'Mami', 'Nishi',    'mnishi',   'mnishi@classicmodelcars.com',  '', '2012-03-01 05:54:30'),
(1625,  'Yoshimi',  'Kato', 'ykato',    'ykato@classicmodelcars.com',   '', '2012-03-01 05:54:30'),
(1702,  'Martin',   'Gerard',   'mgerard',  'mgerard@classicmodelcars.com', '', '2012-03-01 05:54:30');

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('0c0b2cfd4012b34ecd06c53d3f3ad4fb',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434873657, 'a:2:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:5:\"Guest\";}'),
('2b805e42631f314d26f434524b30eb83',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434875327, 'a:6:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:5:\"Guest\";s:9:\"auth_user\";b:0;s:13:\"auth_loggedin\";b:0;s:4:\"lang\";s:2:\"en\";s:7:\"role_id\";s:1:\"4\";}'),
('590ede14ff57aff2d4ce996dfe2f204d',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434874960, 'a:6:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:7:\"Manager\";s:9:\"auth_user\";s:1:\"4\";s:13:\"auth_loggedin\";b:1;s:4:\"lang\";s:2:\"en\";s:7:\"role_id\";s:1:\"4\";}'),
('8545e9638879277a5f34de56a1d9981e',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434874052, 'a:2:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:5:\"Guest\";}'),
('ac32846ba291ef886e5b61a4db151a1d',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434873657, 'a:2:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:5:\"Guest\";}');

DROP TABLE IF EXISTS `tr_menu`;
CREATE TABLE `tr_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(40) DEFAULT NULL,
  `icon` varchar(40) DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `descr` text,
  `parent_id` int(11) DEFAULT '0',
  `resource_id` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT '0',
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `resource_id` (`resource_id`),
  CONSTRAINT `tr_menu_ibfk_1` FOREIGN KEY (`resource_id`) REFERENCES `acl_resources` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tr_menu` (`id`, `code`, `icon`, `label`, `name`, `descr`, `parent_id`, `resource_id`, `active`, `role_id`) VALUES
(1, 'CMS',  'fa-book',  'CMS',  'CMS',  'Content Mangagement System',   0,  22, 0,  NULL),
(2, 'Post', '', 'Post', 'Post', '', 1,  23, 0,  NULL),
(6, 'SP',   'fa-book',  'Simpan Pinjam',    'Simpan Pinjam',    '', 0,  33, 0,  NULL);

DROP TABLE IF EXISTS `tt_comments`;
CREATE TABLE `tt_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tt_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1,  'Mr WordPress', '', 'https://wordpress.org/',   '', '2015-05-13 01:53:38',  '2015-05-13 01:53:38',  'Hi, this is a comment.\nTo delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them.',   0,  '1',    '', '', 0,  0);

DROP TABLE IF EXISTS `tt_posts`;
CREATE TABLE `tt_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tt_posts` (`ID`, `post_author`, `post_date`, `post_content`, `post_title`, `post_status`, `comment_status`, `post_modified`, `post_type`, `comment_count`) VALUES
(24,    1,  '2015-06-21 07:13:24',  'First Blog Change',    'First Blog Change',    '1',    '1',    '2015-06-21 07:21:56',  'post', 0);

DROP TABLE IF EXISTS `unit_koperasi`;
CREATE TABLE `unit_koperasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `address` text,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `logo` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2015-06-22 04:11:31