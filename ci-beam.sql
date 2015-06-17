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
(23,    'cms/news', 'controller',   22, '2015-06-16 15:32:53',  '2015-06-16 15:32:53');

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
(3, 'Staf', '2012-11-12 04:30:02',  '2012-11-12 04:30:39'),
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
(3, 2,  0),
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
(4, 23, 'allow',    NULL);

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
(1002,  'Diane',    'Murphy',   'dmurphy',  'dmurphy@classicmodelcars.com', '', NULL,   '2012-03-01 05:54:30',  NULL),
(1056,  'Mary', 'Patterson',    'mpatterso',    'mpatterso@classicmodelcars.com',   '', NULL,   '2012-03-01 05:54:30',  NULL),
(1076,  'Jeff', 'Firrelli', 'jeff.firrelli',    'jeff.firrelli@classicmodelcars.com',   '', NULL,   '2012-03-01 05:54:30',  NULL),
(1088,  'William',  'Patterson',    'wpatterson',   'wpatterson@classicmodelcars.com',  '', NULL,   '2012-03-01 05:54:30',  NULL),
(1102,  'Gerard',   'Bondur',   'gbondur',  'gbondur@classicmodelcars.com', '$2a$08$/9GPAwtVkFug2y5yBIhmPOZWSev.Myt.ruNENXo9DT4VrqTwNBE2K', 'en',   '2012-03-01 05:54:30',  NULL),
(1143,  'Anthony',  'Bow',  'abow', 'abow@classicmodelcars.com',    '$2a$08$w6grERmP9T3r7FOBAuxLjO0l9H05ZgFTgGUY26hA89/g/Wq.QLqye', NULL,   '2012-03-01 05:54:30',  NULL),
(1165,  'Leslie',   'Jennings', 'ljennings',    'ljennings@classicmodelcars.com',   '', NULL,   '2012-03-01 05:54:30',  NULL),
(1166,  'Leslie',   'Thompson', 'lthompson',    'lthompson@classicmodelcars.com',   '', NULL,   '2012-03-01 05:54:30',  NULL),
(1188,  'Julie',    'Firrelli', 'julie.firrelli',   'julie.firrelli@classicmodelcars.com',  '', NULL,   '2012-03-01 05:54:30',  NULL),
(1216,  'Steve',    'Patterson',    'spatterson',   'spatterson@classicmodelcars.com',  '', NULL,   '2012-03-01 05:54:30',  NULL),
(1337,  'Loui', 'Bondur',   'lbondur',  'lbondur@classicmodelcars.com', '$2a$08$tGx5NElKJIm2hkX3OwRYSOp/VZ/r.oaB2YHdK.HBCDM921rfUVAta', NULL,   '2012-03-01 05:54:30',  NULL),
(1370,  'Gerard',   'Hernandez',    'ghernande',    'ghernande@classicmodelcars.com',   '', NULL,   '2012-03-01 05:54:30',  NULL),
(1401,  'Pamela',   'Castillo', 'pcastillo',    'pcastillo@classicmodelcars.com',   '', NULL,   '2012-03-01 05:54:30',  NULL),
(1501,  'Larry',    'Bott', 'lbott',    'lbott@classicmodelcars.com',   '$2a$08$Njus3nhJ9bX5YYGra6xRu.ldrTylOMebKHXW/Wfl0o2wMvtppY476', NULL,   '2012-03-01 05:54:30',  NULL),
(1504,  'Barry',    'Jones',    'bjones',   'bjones@classicmodelcars.com',  '', NULL,   '2012-03-01 05:54:30',  NULL),
(1611,  'Andy', 'Fixter',   'afixter',  'afixter@classicmodelcars.com', '', NULL,   '2012-03-01 05:54:30',  NULL),
(1612,  'Peter',    'Marsh',    'pmarsh',   'pmarsh@classicmodelcars.com',  '', NULL,   '2012-03-01 05:54:30',  NULL),
(1619,  'Tom',  'King', 'tking',    'tking@classicmodelcars.com',   '', NULL,   '2012-03-01 05:54:30',  NULL),
(1621,  'Mami', 'Nishi',    'mnishi',   'mnishi@classicmodelcars.com',  '', NULL,   '2012-03-01 05:54:30',  NULL),
(1625,  'Yoshimi',  'Kato', 'ykato',    'ykato@classicmodelcars.com',   '', NULL,   '2012-03-01 05:54:30',  NULL),
(1702,  'Martin',   'Gerard',   'mgerard',  'mgerard@classicmodelcars.com', '', NULL,   '2012-03-01 05:54:30',  NULL),
(1703,  'Ardi', 'Soebrata', 'ardissoebrata',    'ardissoebrata@gmail.com',  '$2a$08$KZRME/RCMM.ikhJvS9IQtOD/qQcM/922akreUjQ7fgL6BanTAwsIm', 'en',   '2012-03-09 12:57:48',  4),
(1704,  'Administrator',    'Tea',  'admin',    'admin@vmt.co.id',  '$2a$08$dxSn4NG3GUxu3XGLr4niIuemUHBohdWdBobNsRi6WpBE.h8zHNmXO', 'en',   '2012-03-15 19:23:59',  1),
(1706,  'Test', 'TestLast', 'test', 'test@test.com',    'test', 'en',   '2012-11-09 10:58:34',  2);

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
('26d69a66b743c191078c8daafa0142b6',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434473482, 'a:2:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:5:\"Guest\";}'),
('2f95b5a1370749b9afcf66b1825780ff',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434470192, 'a:2:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:5:\"Guest\";}'),
('4d3e7a54e754e57df315cbf73048b480',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434470117, 'a:2:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:5:\"Guest\";}'),
('56b8310b8891a93919c89249eaf032b5',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434475111, 'a:6:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:13:\"Administrator\";s:9:\"auth_user\";s:4:\"1704\";s:13:\"auth_loggedin\";b:1;s:4:\"lang\";s:2:\"en\";s:7:\"role_id\";s:1:\"1\";}'),
('5ae66f03c56675432135824793080909',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434470116, 'a:3:{s:9:\"user_data\";s:0:\"\";s:9:\"auth_user\";s:4:\"1704\";s:13:\"auth_loggedin\";b:1;}'),
('5b3a362a05fb47f6b0e7686aa8278df7',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434473443, 'a:6:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:5:\"Guest\";s:9:\"auth_user\";b:0;s:13:\"auth_loggedin\";b:0;s:4:\"lang\";s:2:\"en\";s:7:\"role_id\";s:1:\"1\";}'),
('61150d5a24e69960f0242948f0cd2c1b',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434475111, 'a:2:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:5:\"Guest\";}'),
('6a61fee565c317bf6bc72d0198cb2721',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434470197, 'a:2:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:5:\"Guest\";}'),
('6db9eae1185c312dbfb634f0e6c60394',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434469851, 'a:7:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:13:\"Administrator\";s:9:\"auth_user\";s:4:\"1704\";s:13:\"auth_loggedin\";b:1;s:4:\"lang\";s:2:\"en\";s:7:\"role_id\";s:1:\"1\";s:15:\"flash:old:error\";b:0;}'),
('83639616bae99cc177d8187b9545f20f',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434470196, 'a:2:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:5:\"Guest\";}'),
('89ab77bf25e97bdc775a3410bd965dbb',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434473497, 'a:2:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:5:\"Guest\";}'),
('9aa488b38f52d1cefcc0d43151dccc06',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434473482, 'a:2:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:5:\"Guest\";}'),
('b3e856b7a4a5cbeccacde13649bc60de',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434473498, 'a:6:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:13:\"Administrator\";s:9:\"auth_user\";s:4:\"1704\";s:13:\"auth_loggedin\";b:1;s:4:\"lang\";s:2:\"en\";s:7:\"role_id\";s:1:\"1\";}'),
('b538202e4b3ab3ce58db5ac50c05395e',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434470174, 'a:2:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:5:\"Guest\";}'),
('b79b4194027ed4d8a747da453e1f4708',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434469489, 'a:6:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:13:\"Administrator\";s:9:\"auth_user\";s:4:\"1704\";s:13:\"auth_loggedin\";b:1;s:4:\"lang\";s:2:\"en\";s:7:\"role_id\";s:1:\"1\";}'),
('cb98cb623741e9fe5298b490899a398a',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434470159, 'a:4:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:5:\"Guest\";s:9:\"auth_user\";b:0;s:13:\"auth_loggedin\";b:0;}'),
('d630345dc1004ee14f10942023b773c3',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434473784, 'a:2:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:5:\"Guest\";}'),
('d70e909d5f5aa2f43981fc647b458819',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434470191, 'a:2:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:5:\"Guest\";}'),
('f4a93905a89d99bbc7845337203c40cb',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434474799, 'a:6:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:5:\"Guest\";s:9:\"auth_user\";b:0;s:13:\"auth_loggedin\";b:0;s:4:\"lang\";s:2:\"en\";s:7:\"role_id\";s:1:\"1\";}'),
('fe39ea76ac41df4935f40668d05de040',    '::1',  'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',    1434472814, 'a:6:{s:9:\"user_data\";s:0:\"\";s:9:\"role_name\";s:13:\"Administrator\";s:9:\"auth_user\";s:4:\"1704\";s:13:\"auth_loggedin\";b:1;s:4:\"lang\";s:2:\"en\";s:7:\"role_id\";s:1:\"1\";}');

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
  PRIMARY KEY (`id`),
  KEY `resource_id` (`resource_id`),
  CONSTRAINT `tr_menu_ibfk_1` FOREIGN KEY (`resource_id`) REFERENCES `acl_resources` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tr_menu` (`id`, `code`, `icon`, `label`, `name`, `descr`, `parent_id`, `resource_id`, `active`) VALUES
(1, 'CMS',  'fa-book',  'CMS',  'CMS',  'Content Mangagement System',   0,  22, 0),
(2, 'News', '', 'News', 'News', NULL,   1,  23, 0);

-- 2015-06-17 03:32:02