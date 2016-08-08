-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 02, 2016 at 11:34 AM
-- Server version: 5.5.45-37.4-log
-- PHP Version: 5.6.24

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `colandbe_ummahstars`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `age_group`
--

CREATE TABLE IF NOT EXISTS `age_group` (
  `age_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `age_group_name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`age_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_type` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `background_image` varchar(255) NOT NULL,
  `need_payment` enum('true','false') NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `content_type` enum('video','book') NOT NULL,
  `content` text NOT NULL,
  `age_group_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `custom_deeds`
--

CREATE TABLE IF NOT EXISTS `custom_deeds` (
  `custom_deed_id` int(11) NOT NULL AUTO_INCREMENT,
  `deed_title` varchar(255) NOT NULL,
  `deed_description` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `deed` int(11) NOT NULL,
  `deed_status` enum('completed','progress','inactive','active') NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`custom_deed_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `deed_goals`
--

CREATE TABLE IF NOT EXISTS `deed_goals` (
  `goal_id` int(11) NOT NULL AUTO_INCREMENT,
  `goal_title` varchar(255) NOT NULL,
  `goal_deed` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `goal_status` enum('completed','progress','inactive','active') NOT NULL,
  `created_date` datetime NOT NULL,
  `prize_id` int(11) NOT NULL,
  PRIMARY KEY (`goal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
  `quiz_id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_title` varchar(255) NOT NULL,
  `quiz_type` varchar(255) NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `age_group_id` int(11) NOT NULL,
  `deed` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `background_image` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE IF NOT EXISTS `subscriptions` (
  `subscription_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `subscription_start` datetime NOT NULL,
  `subscription_end` datetime NOT NULL,
  `subscribed_date` datetime NOT NULL,
  PRIMARY KEY (`subscription_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE IF NOT EXISTS `subscription_plans` (
  `plan_id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `try_me_videos`
--

CREATE TABLE IF NOT EXISTS `try_me_videos` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `age_group` int(11) NOT NULL,
  `video` varchar(255) NOT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `user_role` tinyint(4) NOT NULL,
  `age_group` tinyint(4) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `logged_in` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `child_mode` enum('true','false') NOT NULL,
  `parent_type` enum('active','passive') NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `password`, `email_id`, `gender`, `profile_image`, `user_role`, `age_group`, `parent_id`, `logged_in`, `status`, `created_on`, `updated_on`, `last_login`, `child_mode`, `parent_type`) VALUES
(1, 'abdur', 'khan', '004b89df7fced7d62cff63620502cbf5', 'abdur.khan@ggmail.com', 'male', '', 2, 0, 0, 0, 1, '2016-08-01 00:00:00', '2016-08-01 00:00:00', '2016-08-01 00:00:00', '', ''),
(2, 'vivek', 'kt', '8a09052c9601178c546f1ee513920cf2', 'vivek.kt@ggmail.com', 'male', '', 2, 0, 0, 0, 1, '2016-08-01 00:00:00', '2016-08-01 00:00:00', '2016-08-01 00:00:00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_deeds`
--

CREATE TABLE IF NOT EXISTS `user_deeds` (
  `deed_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `deed_type` enum('quiz','custom','random') NOT NULL,
  `activity` varchar(255) NOT NULL,
  `activity_reference` int(11) NOT NULL,
  `earned_deed` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`deed_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
