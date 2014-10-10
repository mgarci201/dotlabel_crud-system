-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2014 at 02:39 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dotlabeldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `hostmachine`
--

CREATE TABLE IF NOT EXISTS `hostmachine` (
`hostId` int(11) NOT NULL,
  `ipaddress` varchar(16) NOT NULL,
  `subnet` smallint(2) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `hostmachine`
--

INSERT INTO `hostmachine` (`hostId`, `ipaddress`, `subnet`, `description`, `created_at`, `updated_at`, `enabled`) VALUES
(13, '192.256.1.0', 15, 'Department of Business', '2014-10-06 12:23:45', '2014-10-06 12:23:45', 0),
(19, '192.186.1.6', 29, 'Department of Transport', '2014-10-06 11:38:34', '2014-10-06 11:38:34', 0),
(24, '190.166.5.6', 11, 'Department of Work and Pension', '2014-10-06 12:22:43', '2014-10-06 12:22:43', 1),
(26, '192.186.8.4', 12, 'Department of Health', '2014-10-06 12:22:36', '2014-10-06 12:22:36', 1),
(28, '192.188.2.3', 3, 'department of Energy', '2014-10-06 12:22:31', '2014-10-06 12:22:31', 1),
(29, '192.186.9.9', 10, 'Department of Education', '2014-10-06 12:05:18', '2014-10-06 12:05:18', 0),
(30, '192.186.1.1', 5, 'test', '2014-10-06 12:22:25', '2014-10-06 12:22:25', 1),
(31, '192.186.4.5', 15, 'test2', '2014-10-06 11:41:04', '2014-10-06 11:41:04', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hostmachine`
--
ALTER TABLE `hostmachine`
 ADD PRIMARY KEY (`hostId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hostmachine`
--
ALTER TABLE `hostmachine`
MODIFY `hostId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
