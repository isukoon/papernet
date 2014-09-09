-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 09, 2013 at 07:56 AM
-- Server version: 5.1.33
-- PHP Version: 5.2.9-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `papernet`
--

-- --------------------------------------------------------

--
-- Table structure for table `ref_sequence`
--
-- Creation: Oct 05, 2013 at 07:04 PM
--

DROP TABLE IF EXISTS `ref_sequence`;
CREATE TABLE IF NOT EXISTS `ref_sequence` (
  `type` varchar(10) NOT NULL,
  `number` int(10) unsigned NOT NULL,
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_sequence`
--

INSERT INTO `ref_sequence` (`type`, `number`) VALUES
('CATEGORY', 100),
('CLASSIFIED', 200),
('IMAGE', 300),
('TENDER', 400);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ad_category`
--
-- Creation: Oct 05, 2013 at 07:04 PM
--

DROP TABLE IF EXISTS `tbl_ad_category`;
CREATE TABLE IF NOT EXISTS `tbl_ad_category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_ad_category`
--

INSERT INTO `tbl_ad_category` (`category_id`, `category_name`) VALUES
(1, 'MATTRIMONY'),
(2, 'VACANCIES');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ad_payment`
--
-- Creation: Oct 05, 2013 at 07:04 PM
--

DROP TABLE IF EXISTS `tbl_ad_payment`;
CREATE TABLE IF NOT EXISTS `tbl_ad_payment` (
  `ad_id` varchar(10) NOT NULL,
  `amount` double DEFAULT NULL,
  `tran_id` varchar(45) DEFAULT NULL,
  `cc_type` varchar(45) DEFAULT NULL,
  `cc_number` varchar(45) DEFAULT NULL,
  `exp_date` varchar(45) DEFAULT NULL,
  `cvv_no` varchar(45) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `payment_date` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ad_payment`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_ad_prices`
--
-- Creation: Oct 05, 2013 at 07:04 PM
--

DROP TABLE IF EXISTS `tbl_ad_prices`;
CREATE TABLE IF NOT EXISTS `tbl_ad_prices` (
  `newspaper_id` int(10) unsigned NOT NULL,
  `no_of_words` int(10) unsigned NOT NULL,
  `amount` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ad_prices`
--

INSERT INTO `tbl_ad_prices` (`newspaper_id`, `no_of_words`, `amount`) VALUES
(1, 15, 550),
(1, 20, 750),
(1, 25, 1000),
(1, 30, 1300),
(1, 35, 1650),
(1, 40, 2050),
(1, 45, 2450),
(2, 15, 825),
(2, 20, 1125),
(2, 25, 1500),
(2, 30, 1950),
(2, 35, 2475),
(2, 40, 3075),
(2, 45, 3675);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ad_sub_category`
--
-- Creation: Oct 05, 2013 at 07:04 PM
--

DROP TABLE IF EXISTS `tbl_ad_sub_category`;
CREATE TABLE IF NOT EXISTS `tbl_ad_sub_category` (
  `category_id` int(10) unsigned NOT NULL,
  `sub_category_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ad_sub_category`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_image_ad`
--
-- Creation: Oct 05, 2013 at 07:04 PM
--

DROP TABLE IF EXISTS `tbl_image_ad`;
CREATE TABLE IF NOT EXISTS `tbl_image_ad` (
  `ad_id` varchar(10) NOT NULL,
  `size` varchar(45) NOT NULL,
  `page` varchar(45) NOT NULL,
  `newspapers` varchar(45) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `publish_date` date NOT NULL,
  `added_by` varchar(45) NOT NULL,
  `added_date` datetime NOT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_image_ad`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_image_ad_prices`
--
-- Creation: Oct 05, 2013 at 07:04 PM
--

DROP TABLE IF EXISTS `tbl_image_ad_prices`;
CREATE TABLE IF NOT EXISTS `tbl_image_ad_prices` (
  `size` varchar(10) NOT NULL,
  `page` varchar(10) NOT NULL,
  `amount` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_image_ad_prices`
--

INSERT INTO `tbl_image_ad_prices` (`size`, `page`, `amount`) VALUES
('FULL', 'FRONT', 5000.00),
('FULL', 'BACK', 3000.00),
('FULL', 'INNER', 2000.00),
('HALF', 'FRONT', 2500.00),
('HALF', 'BACK', 1500.00),
('HALF', 'INNER', 1000.00),
('QUARTER', 'INNER', 500.00),
('QUARTER', 'FRONT', 1500.00),
('QUARTER', 'BACK', 1000.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newspapers`
--
-- Creation: Oct 05, 2013 at 07:04 PM
--

DROP TABLE IF EXISTS `tbl_newspapers`;
CREATE TABLE IF NOT EXISTS `tbl_newspapers` (
  `newspaper_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `newspaper_name` varchar(45) NOT NULL,
  `display_name` varchar(45) NOT NULL,
  PRIMARY KEY (`newspaper_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_newspapers`
--

INSERT INTO `tbl_newspapers` (`newspaper_id`, `newspaper_name`, `display_name`) VALUES
(1, 'DAILY_NEWS', 'Daily News'),
(2, 'SUNDAY_OBSERVER', 'Sunday Observer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tender_notices`
--
-- Creation: Oct 05, 2013 at 07:04 PM
--

DROP TABLE IF EXISTS `tbl_tender_notices`;
CREATE TABLE IF NOT EXISTS `tbl_tender_notices` (
  `ad_id` varchar(10) NOT NULL,
  `category` varchar(45) NOT NULL,
  `added_by` varchar(45) NOT NULL,
  `added_date` datetime NOT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tender_notices`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_text_ads`
--
-- Creation: Oct 05, 2013 at 07:04 PM
--

DROP TABLE IF EXISTS `tbl_text_ads`;
CREATE TABLE IF NOT EXISTS `tbl_text_ads` (
  `ad_id` varchar(10) NOT NULL,
  `ad_category` varchar(100) NOT NULL,
  `ad_sub_category` varchar(100) NOT NULL,
  `newspapers` varchar(100) DEFAULT NULL,
  `ad_body` varchar(1000) NOT NULL,
  `publish_date` date DEFAULT NULL,
  `ad_amount` float(10,2) NOT NULL,
  `ent_date` datetime DEFAULT NULL,
  `ent_by` varchar(50) DEFAULT NULL,
  `ad_status` varchar(10) DEFAULT NULL,
  `ad_layout` varchar(500) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_text_ads`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--
-- Creation: Oct 05, 2013 at 07:04 PM
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `user_password` varchar(10) NOT NULL,
  `salutation` varchar(10) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `id_no` varchar(20) NOT NULL,
  `maritial_status` varchar(10) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `home_address` varchar(200) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `officephone_no` varchar(20) DEFAULT NULL,
  `office_address` varchar(200) DEFAULT NULL,
  `promotion_status` tinyint(1) DEFAULT NULL,
  `condition_status` tinyint(1) DEFAULT NULL,
  `date_of_birth` varchar(20) DEFAULT NULL,
  `user_level` varchar(45) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_users`
--

