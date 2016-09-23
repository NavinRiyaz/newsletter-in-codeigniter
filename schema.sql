-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2016 at 04:08 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hemant_newsletter`
--

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_employee`
--

CREATE TABLE IF NOT EXISTS `newsletter_employee` (
  `designation_id` int(11) NOT NULL,
  `designation_name` varchar(256) NOT NULL,
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(100) NOT NULL,
  `employee_role` enum('admin','operator') NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `marital_status` enum('single','married','divorced') NOT NULL,
  `email` varchar(30) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `address_permnt` text NOT NULL,
  `address_current` text NOT NULL,
  `department_id` int(5) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `doaniversary` date NOT NULL,
  `dojoin` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`employee_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `newsletter_employee`
--

INSERT INTO `newsletter_employee` (`designation_id`, `designation_name`, `employee_id`, `employee_name`, `employee_role`, `username`, `password`, `gender`, `marital_status`, `email`, `qualification`, `address_permnt`, `address_current`, `department_id`, `department_name`, `dob`, `doaniversary`, `dojoin`, `is_active`) VALUES
(1, 'Admin', 101, 'Demo Admin', 'admin', 'admin', 'b55388d69a73989d3f39b350fa79d2df', 'female', 'single', 'demo@gmail.com', '', '', '', 0, '', '1985-07-02', '0000-00-00', '0000-00-00', 1),
(0, '', 102, 'HEMANT LAXMANRAO HINGAVE', 'operator', 'a', '0cc175b9c0f1b6a831c399e269772661', 'male', 'single', 'hemant.hingave@gmail.com', 'a', '', '', 0, '', '2016-09-19', '0000-00-00', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_group`
--

CREATE TABLE IF NOT EXISTS `newsletter_group` (
  `group_id` int(5) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(6) NOT NULL,
  `last_modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modify_by` int(5) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `newsletter_group`
--

INSERT INTO `newsletter_group` (`group_id`, `group_name`, `created_on`, `created_by`, `last_modify`, `last_modify_by`) VALUES
(1, 'All Member', '0000-00-00 00:00:00', 0, '2016-03-04 11:44:40', 0),
(2, 'Group 1', '0000-00-00 00:00:00', 0, '2016-03-04 11:52:59', 0),
(3, 'Group 2', '0000-00-00 00:00:00', 0, '2016-09-13 10:16:12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_group_member_rel`
--

CREATE TABLE IF NOT EXISTS `newsletter_group_member_rel` (
  `alloc_id` int(20) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`alloc_id`),
  UNIQUE KEY `group_id` (`group_id`,`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `newsletter_group_member_rel`
--

INSERT INTO `newsletter_group_member_rel` (`alloc_id`, `group_id`, `member_id`) VALUES
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_mail_draft`
--

CREATE TABLE IF NOT EXISTS `newsletter_mail_draft` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `to_group` int(5) NOT NULL,
  `to_individual` longtext NOT NULL,
  `subject` varchar(256) NOT NULL,
  `from_email` varchar(50) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `alink` varchar(256) NOT NULL,
  `attachment_link` text NOT NULL,
  `attachment_link2` varchar(256) NOT NULL,
  `attachment_link3` varchar(256) NOT NULL,
  `attachment_link4` varchar(256) NOT NULL,
  `attachment_link5` varchar(256) NOT NULL,
  `message` longtext NOT NULL,
  `AdvimageLink` text NOT NULL,
  `created_on` datetime NOT NULL,
  `sent_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `newsletter_mail_draft`
--

INSERT INTO `newsletter_mail_draft` (`id`, `to_group`, `to_individual`, `subject`, `from_email`, `title`, `description`, `alink`, `attachment_link`, `attachment_link2`, `attachment_link3`, `attachment_link4`, `attachment_link5`, `message`, `AdvimageLink`, `created_on`, `sent_on`) VALUES
(1, 1, 'demo@demo.com,demo2@demo.com,', 'Demo Subject', '', 'Demo title', '<p>\r\n	Demo Description</p>\r\n', 'http://localhost:8088', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_master`
--

CREATE TABLE IF NOT EXISTS `newsletter_master` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(256) NOT NULL,
  `checkpoint_sentmail` tinyint(1) NOT NULL,
  `noOfMailSent` int(11) NOT NULL,
  `TotalnoOfemails` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `newsletter_master`
--

INSERT INTO `newsletter_master` (`id`, `company_name`, `checkpoint_sentmail`, `noOfMailSent`, `TotalnoOfemails`) VALUES
(1, 'Demo Company', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_member`
--

CREATE TABLE IF NOT EXISTS `newsletter_member` (
  `member_id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `member_email` varchar(50) NOT NULL,
  `contact1` varchar(15) NOT NULL,
  `contact2` varchar(15) NOT NULL,
  `last_modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_available` enum('YES','NO') NOT NULL,
  `is_valid` enum('YES','NO') NOT NULL,
  PRIMARY KEY (`member_id`),
  UNIQUE KEY `member_email` (`member_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `newsletter_member`
--

INSERT INTO `newsletter_member` (`member_id`, `name`, `member_email`, `contact1`, `contact2`, `last_modify`, `is_available`, `is_valid`) VALUES
(1, 'Demo Member', 'demo.member@gmail.com', '9999999999', '0000000000', '2016-09-13 09:55:07', 'YES', 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_sent_mail`
--

CREATE TABLE IF NOT EXISTS `newsletter_sent_mail` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `to_group` int(5) NOT NULL,
  `to_individual` longtext NOT NULL,
  `subject` varchar(256) NOT NULL,
  `from_email` varchar(50) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `alink` varchar(256) NOT NULL,
  `attachment_link` text NOT NULL,
  `attachment_link2` varchar(256) NOT NULL,
  `attachment_link3` varchar(256) NOT NULL,
  `attachment_link4` varchar(256) NOT NULL,
  `attachment_link5` varchar(256) NOT NULL,
  `message` longtext NOT NULL,
  `AdvimageLink` text NOT NULL,
  `created_on` datetime NOT NULL,
  `sent_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `newsletter_sent_mail`
--

INSERT INTO `newsletter_sent_mail` (`id`, `to_group`, `to_individual`, `subject`, `from_email`, `title`, `description`, `alink`, `attachment_link`, `attachment_link2`, `attachment_link3`, `attachment_link4`, `attachment_link5`, `message`, `AdvimageLink`, `created_on`, `sent_on`) VALUES
(1, 1, 'demo@demo.com,demo2@demo.com,', 'Demo Subject', '', 'Demo title', '<p>\r\n	Demo Description</p>\r\n', 'http://localhost:8088', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2016-09-13 23:51:21');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
