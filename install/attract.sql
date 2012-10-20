-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2012 at 12:55 AM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `attract`
--

-- --------------------------------------------------------

--
-- Table structure for table `scenes`
--

CREATE TABLE `scenes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(6) NOT NULL DEFAULT '',
  `description` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Table structure for table `shots`
--

CREATE TABLE `shots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scene_id` int(11) unsigned NOT NULL,
  `number` varchar(6) NOT NULL DEFAULT '',
  `description` varchar(128) DEFAULT '',
  `duration` int(4) NOT NULL,
  `status` varchar(70) NOT NULL DEFAULT '',
  `stage` varchar(70) NOT NULL,
  `owner` varchar(50) DEFAULT '',
  `notes` varchar(128) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `scene_id` (`scene_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=136 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shots`
--
ALTER TABLE `shots`
  ADD CONSTRAINT `shots_ibfk_1` FOREIGN KEY (`scene_id`) REFERENCES `scenes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
