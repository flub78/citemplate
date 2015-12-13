#
# TABLE STRUCTURE FOR: ciauth_user_token
#

DROP TABLE IF EXISTS `ciauth_user_token`;

CREATE TABLE `ciauth_user_token` (
  `token` varchar(90) NOT NULL,
  `email` varchar(45) NOT NULL,
  `tstamp` int(11) NOT NULL,
  PRIMARY KEY (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: ciauth_user_profiles
#

DROP TABLE IF EXISTS `ciauth_user_profiles`;

CREATE TABLE `ciauth_user_profiles` (
  `uprof_id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_user_id_fk` int(11) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `address_1` varchar(60) NOT NULL,
  `address_2` varchar(60) DEFAULT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(40) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `company_name` varchar(40) DEFAULT NULL,
  `home_phone` varchar(15) DEFAULT NULL,
  `company_phone` varchar(15) DEFAULT NULL,
  `mobile_phone` varchar(15) DEFAULT NULL,
  `face_book_url` varchar(90) DEFAULT NULL,
  `twitter_url` varchar(90) DEFAULT NULL,
  `linkedin_url` varchar(90) DEFAULT NULL,
  `newsletter` char(1) DEFAULT NULL,
  PRIMARY KEY (`uprof_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: ciauth_user_privileges_users
#

DROP TABLE IF EXISTS `ciauth_user_privileges_users`;

CREATE TABLE `ciauth_user_privileges_users` (
  `upriv_id` int(11) NOT NULL AUTO_INCREMENT,
  `upriv_privilege_id_fk` int(11) NOT NULL,
  `upriv_user_id_fk` int(11) NOT NULL,
  PRIMARY KEY (`upriv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: ciauth_user_privileges_groups
#

DROP TABLE IF EXISTS `ciauth_user_privileges_groups`;

CREATE TABLE `ciauth_user_privileges_groups` (
  `upriv_id` int(11) NOT NULL AUTO_INCREMENT,
  `upriv_privilege_id_fk` int(11) NOT NULL,
  `upriv_group_id_fk` int(11) NOT NULL,
  PRIMARY KEY (`upriv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: ciauth_user_privileges
#

DROP TABLE IF EXISTS `ciauth_user_privileges`;

CREATE TABLE `ciauth_user_privileges` (
  `privilege_id` int(11) NOT NULL AUTO_INCREMENT,
  `privilege_name` varchar(40) NOT NULL,
  `privilege_description` varchar(200) NOT NULL,
  PRIMARY KEY (`privilege_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `ciauth_user_privileges` (`privilege_id`, `privilege_name`, `privilege_description`) VALUES ('1', 'user', 'Default user rights');
INSERT INTO `ciauth_user_privileges` (`privilege_id`, `privilege_name`, `privilege_description`) VALUES ('2', 'admin', 'Administrative privileges');
INSERT INTO `ciauth_user_privileges` (`privilege_id`, `privilege_name`, `privilege_description`) VALUES ('3', 'accounting', 'Privileges for tresorers');


#
# TABLE STRUCTURE FOR: ciauth_user_groups
#

DROP TABLE IF EXISTS `ciauth_user_groups`;

CREATE TABLE `ciauth_user_groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(40) NOT NULL,
  `group_description` varchar(200) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: ciauth_user_accounts
#

DROP TABLE IF EXISTS `ciauth_user_accounts`;

CREATE TABLE `ciauth_user_accounts` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL,
  `admin` varchar(1) NOT NULL,
  `remember_me` int(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO `ciauth_user_accounts` (`user_id`, `email`, `username`, `password`, `creation_date`, `last_login`, `admin`, `remember_me`) VALUES ('1', 'frederic.peignot@free.fr', 'flub78', '$2y$10$TazguczdotOZyuHNJqOKX.eiRW4JlTdqH3Gb2l0bzCA5GYTBNSc1G', '2015-08-15 08:48:12', '2015-12-12 21:35:35', '1', '0');
INSERT INTO `ciauth_user_accounts` (`user_id`, `email`, `username`, `password`, `creation_date`, `last_login`, `admin`, `remember_me`) VALUES ('2', 'frederic.peignot@gmail.com', 'taz2', '$2y$10$8Bc633mpP8rTL2EkI5Aal.I8tf.AG.nkPddByA/aezA0AYC2ZUHjW', '2015-08-16 19:05:57', '2015-12-12 21:35:35', '0', '0');
INSERT INTO `ciauth_user_accounts` (`user_id`, `email`, `username`, `password`, `creation_date`, `last_login`, `admin`, `remember_me`) VALUES ('3', 'testadmin@free.fr', 'testadmin', '$2y$10$AAvPuXimYxIdjEhFoN71AeNIIEVgiiUX2./WZh0tgaQXOHuWguV9K', '2015-08-20 22:19:19', '2015-12-12 21:35:35', 'Y', '0');
INSERT INTO `ciauth_user_accounts` (`user_id`, `email`, `username`, `password`, `creation_date`, `last_login`, `admin`, `remember_me`) VALUES ('5', 'testgroup@free.fr', 'testgroup', '$2y$10$iWIe/IyFByPbHtigyvGk8u.UsOuO/TizfiKjp9hhH/WKOStvERdF6', '2015-08-14 10:22:00', '2015-12-12 21:35:35', '1', '0');
INSERT INTO `ciauth_user_accounts` (`user_id`, `email`, `username`, `password`, `creation_date`, `last_login`, `admin`, `remember_me`) VALUES ('6', 'testuser@free.fr', 'testuser', '$2y$10$wbwpqYmR2nLVFJmUgku09O/DZJ8BE2H5dtaADNdnoX3fSR8nmPKSK', '2015-08-20 22:30:25', '2015-12-12 21:35:35', '', '0');
INSERT INTO `ciauth_user_accounts` (`user_id`, `email`, `username`, `password`, `creation_date`, `last_login`, `admin`, `remember_me`) VALUES ('12', 'titi@free.fr', 'titi', '$2y$10$9GvX34ErEFMeNhJDG/qnC.W8sKqnP8ajaRLh2ZK1P3sQpZQJjJe1G', '2015-11-07 12:46:28', '2015-12-12 21:35:35', '', '0');


#
# TABLE STRUCTURE FOR: ciauth_sessions
#

DROP TABLE IF EXISTS `ciauth_sessions`;

CREATE TABLE `ciauth_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data` longtext,
  `rnd_key` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2420 DEFAULT CHARSET=utf8;

INSERT INTO `ciauth_sessions` (`id`, `user_id`, `ip_address`, `timestamp`, `data`, `rnd_key`) VALUES ('7', '2', '127.0.0.1', '2015-08-16 19:06:15', 'anpnOXVBRGpDa2thM3hjZW4xTEhIZz09', '71ae56b571892cb5e35c7cf838e5841e46d6f9945d3e4f0366edbea6338dfec2');
INSERT INTO `ciauth_sessions` (`id`, `user_id`, `ip_address`, `timestamp`, `data`, `rnd_key`) VALUES ('16', '1', '0.0.0.0', '2015-08-19 21:45:33', 'SjJESkN6b285cFVPdmh0NDl6YmdOUT09', '567c8ddcb352700eea826f64a4eb15dc011fa01ca5bacc0a3faf806ad8f595ff');
INSERT INTO `ciauth_sessions` (`id`, `user_id`, `ip_address`, `timestamp`, `data`, `rnd_key`) VALUES ('20', '5', '127.0.0.1', '2015-08-20 22:26:00', 'UWNWZkpOM0NuVlUxU3V0UXVyaHVVZz09', '7c1fc84493df570507387ec74f212b868a144fdd6195fc2b6822c034a3fd481e');
INSERT INTO `ciauth_sessions` (`id`, `user_id`, `ip_address`, `timestamp`, `data`, `rnd_key`) VALUES ('2417', '6', '0.0.0.0', '2015-12-12 21:09:29', 'cDdvLy8zcmdvdkRaa1NPZ25WNXl3Zz09', '5ac6d56f007e82a97f074a4e73343a37d471e1d3453a8b4c97c3e2c5f4b1914b');
INSERT INTO `ciauth_sessions` (`id`, `user_id`, `ip_address`, `timestamp`, `data`, `rnd_key`) VALUES ('2419', '3', '127.0.0.1', '2015-12-12 21:35:35', 'ZzFxUnBteWpnQnVOL3ZvcU1pM0FFZz09', '52138218b5b57101ea92065eb2c93c9f734f1f725175818d3160cac1ac2f4b22');


#
# TABLE STRUCTURE FOR: ciauth_navigation
#

DROP TABLE IF EXISTS `ciauth_navigation`;

CREATE TABLE `ciauth_navigation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order` bigint(20) NOT NULL,
  `name` varchar(60) NOT NULL,
  `anchor` varchar(60) NOT NULL,
  `parent` bigint(20) DEFAULT NULL,
  `permissions` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES ('1', '1', '', '', NULL, NULL);
INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES ('2', '2', 'Development', '', NULL, NULL);
INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES ('3', '1', 'phpinfo', '/dev/phpinfo', '2', NULL);
INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES ('4', '3', 'Admin', '', NULL, NULL);
INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES ('5', '1', 'Configuration', '/admin/config', '4', NULL);
INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES ('6', '2', 'Database', '', '4', NULL);
INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES ('7', '1', 'Backup', '/database/backup', '6', NULL);
INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES ('8', '1', 'Restore', '/database/restore', '6', NULL);
INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES ('9', '2', 'Migration', '/database/migration', '6', NULL);
INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES ('10', '3', 'Schema', '/database/schema', '6', NULL);
INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES ('11', '4', 'Default tables', '/database/shema', '6', NULL);
INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES ('12', '5', 'Lock site', '/admin/lock', '4', NULL);
INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES ('13', '6', 'Users Management', '/users', '4', NULL);
INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES ('14', '7', 'Menus', '/citemplate/C_ciauth_admin/nav_admin', '4', NULL);
INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES ('15', '4', 'CRUD', '', NULL, NULL);
INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES ('16', '1', 'List', '/crud/list', '15', NULL);
INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES ('17', '2', 'Create', '/crud/create', '15', NULL);
INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES ('18', '5', 'Help', '', NULL, NULL);
INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES ('19', '1', 'About', '/citemplate//about', '18', NULL);


