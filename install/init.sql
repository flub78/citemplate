-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 01 Décembre 2015 à 20:46
-- Version du serveur: 5.5.44-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ci3`
--

-- --------------------------------------------------------

--
-- Structure de la table `ciauth_navigation`
--

CREATE TABLE IF NOT EXISTS `ciauth_navigation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order` bigint(20) NOT NULL,
  `name` varchar(60) NOT NULL,
  `anchor` varchar(60) NOT NULL,
  `parent` bigint(20) DEFAULT NULL,
  `permissions` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `ciauth_navigation`
--

INSERT INTO `ciauth_navigation` (`id`, `order`, `name`, `anchor`, `parent`, `permissions`) VALUES
(1, 1, '', '', NULL, NULL),
(2, 2, 'Development', '', NULL, NULL),
(3, 1, 'phpinfo', '/dev/phpinfo', 2, NULL),
(4, 3, 'Admin', '', NULL, NULL),
(5, 1, 'Configuration', '/admin/config', 4, NULL),
(6, 2, 'Database', '', 4, NULL),
(7, 1, 'Backup', '/database/backup', 6, NULL),
(8, 1, 'Restore', '/database/restore', 6, NULL),
(9, 2, 'Migration', '/database/migration', 6, NULL),
(10, 3, 'Schema', '/database/schema', 6, NULL),
(11, 4, 'Default tables', '/database/shema', 6, NULL),
(12, 5, 'Lock site', '/admin/lock', 4, NULL),
(13, 6, 'Users Management', '/users', 4, NULL),
(14, 7, 'Menus', '/citemplate/C_ciauth_admin/nav_admin', 4, NULL),
(15, 4, 'CRUD', '', NULL, NULL),
(16, 1, 'List', '/crud/list', 15, NULL),
(17, 2, 'Create', '/crud/create', 15, NULL),
(18, 5, 'Help', '', NULL, NULL),
(19, 1, 'About', '/citemplate//about', 18, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ciauth_sessions`
--

CREATE TABLE IF NOT EXISTS `ciauth_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data` longtext,
  `rnd_key` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2355 ;



-- --------------------------------------------------------

--
-- Structure de la table `ciauth_user_accounts`
--

CREATE TABLE IF NOT EXISTS `ciauth_user_accounts` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL,
  `admin` varchar(1) NOT NULL,
  `remember_me` int(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;


-- --------------------------------------------------------

--
-- Structure de la table `ciauth_user_groups`
--

CREATE TABLE IF NOT EXISTS `ciauth_user_groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(40) NOT NULL,
  `group_description` varchar(200) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ciauth_user_privileges`
--

CREATE TABLE IF NOT EXISTS `ciauth_user_privileges` (
  `privilege_id` int(11) NOT NULL AUTO_INCREMENT,
  `privilege_name` varchar(40) NOT NULL,
  `privilege_description` varchar(200) NOT NULL,
  PRIMARY KEY (`privilege_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `ciauth_user_privileges`
--

INSERT INTO `ciauth_user_privileges` (`privilege_id`, `privilege_name`, `privilege_description`) VALUES
(1, 'user', 'Default user rights'),
(2, 'admin', 'Administrative privileges');


-- --------------------------------------------------------

--
-- Structure de la table `ciauth_user_privileges_groups`
--

CREATE TABLE IF NOT EXISTS `ciauth_user_privileges_groups` (
  `upriv_id` int(11) NOT NULL AUTO_INCREMENT,
  `upriv_privilege_id_fk` int(11) NOT NULL,
  `upriv_group_id_fk` int(11) NOT NULL,
  PRIMARY KEY (`upriv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ciauth_user_privileges_users`
--

CREATE TABLE IF NOT EXISTS `ciauth_user_privileges_users` (
  `upriv_id` int(11) NOT NULL AUTO_INCREMENT,
  `upriv_privilege_id_fk` int(11) NOT NULL,
  `upriv_user_id_fk` int(11) NOT NULL,
  PRIMARY KEY (`upriv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ciauth_user_profiles`
--

CREATE TABLE IF NOT EXISTS `ciauth_user_profiles` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ciauth_user_token`
--

CREATE TABLE IF NOT EXISTS `ciauth_user_token` (
  `token` varchar(90) NOT NULL,
  `email` varchar(45) NOT NULL,
  `tstamp` int(11) NOT NULL,
  PRIMARY KEY (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
