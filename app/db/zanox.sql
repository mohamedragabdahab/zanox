-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 08, 2015 at 01:50 AM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zanox`
--

-- --------------------------------------------------------

--
-- Table structure for table `lexik_currency`
--

CREATE TABLE IF NOT EXISTS `lexik_currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `rate` decimal(10,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lexik_currency`
--

INSERT INTO `lexik_currency` (`id`, `code`, `symbol`, `rate`) VALUES
(1, 'EUR', '€', 1.4124),
(2, 'USD', '$', 1.5548),
(3, 'GBP', '£', 1.0000);

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE IF NOT EXISTS `merchants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `merchants`
--

INSERT INTO `merchants` (`id`, `name`) VALUES
(1, 'Merchant #1'),
(2, 'Merchant #2');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `date` date NOT NULL,
  `currency_id` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `merchant_id` (`merchant_id`),
  KEY `currency_id` (`currency_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `amount`, `date`, `currency_id`, `merchant_id`) VALUES
(10, 50, '2015-05-01', 3, 1),
(11, 66.1, '2015-05-01', 2, 2),
(12, 12, '2015-05-02', 1, 2),
(13, 6.5, '2015-05-02', 3, 2),
(14, 11.04, '2015-05-02', 3, 1),
(15, 1, '2015-05-02', 1, 1),
(16, 23.05, '2015-05-03', 2, 1),
(17, 6.5, '2015-05-04', 1, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`currency_id`) REFERENCES `lexik_currency` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
