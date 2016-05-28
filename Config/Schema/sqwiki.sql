-- phpMyAdmin SQL Dump
-- version 3.4.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 30, 2012 at 03:23 AM
-- Server version: 5.5.24
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sqwiki`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `article_revision_count` int(11) DEFAULT NULL,
  `comment_count` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `user_id`, `ip_address`, `article_revision_count`, `comment_count`, `created`, `updated`) VALUES
(1, 'Main', 'Main', 1, '127.0.0.1', 1, NULL, '2012-09-30 00:00:00', '2012-09-30 00:00:00'),
(2, 'Portal', 'Portal', 1, '127.0.0.1', 1, NULL, '2012-09-30 00:00:00', '2012-09-30 00:00:00'),
(3, 'Support', 'Support', 1, '127.0.0.1', 1, NULL, '2012-09-30 00:00:00', '2012-09-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `article_revisions`
--

DROP TABLE IF EXISTS `article_revisions`;
CREATE TABLE IF NOT EXISTS `article_revisions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `reviewed_by_user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `article_revisions`
--

INSERT INTO `article_revisions` (`id`, `article_id`, `user_id`, `ip_address`, `summary`, `content`, `is_active`, `reviewed_by_user_id`, `created`, `updated`) VALUES
(1, 1, 1, '127.0.0.1', 'Welcome to Sqwiki, the squeaky clean wiki!', 'Sqwiki''s goal is to be the easiest wiki software in the world to use.', 1, 1, '2012-09-30 00:00:00', '2012-09-30 00:00:00'),
(2, 2, 1, '127.0.0.1', 'This is the community portal.', 'Put resources here relevant to your wiki community.', 1, 1, '2012-09-30 00:00:00', '2012-09-30 00:00:00'),
(3, 3, 1, '127.0.0.1', 'This is the support page.', 'Put information on this page that assists your users in using your wiki.', 1, 1, '2012-09-30 00:00:00', '2012-09-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `article_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `record_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Editor'),
(3, 'Member'),
(4, 'Banned');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `token` char(36) DEFAULT NULL,
  `article_count` int(11) NOT NULL DEFAULT '0',
  `article_revision_count` int(11) NOT NULL DEFAULT '0',
  `comment_count` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`, `token`, `article_count`, `article_revision_count`, `comment_count`, `created`, `updated`) VALUES
(1, 'Anonymous', 'support@dynamictivity.com', NULL, 4, NULL, 3, 3, 0, '2012-09-30 00:00:00', '2012-09-30 00:00:00');
