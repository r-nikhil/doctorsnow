-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2015 at 12:33 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `doctornow`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE IF NOT EXISTS `appointment` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `patient_id` int(12) NOT NULL,
  `doctor_id` int(12) NOT NULL,
  `time` int(12) NOT NULL,
  `date` date NOT NULL,
  `details` text NOT NULL,
  `previous_med` text NOT NULL,
  `confirm` int(2) NOT NULL,
  `chat_url` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `docname_docid`
--

CREATE TABLE IF NOT EXISTS `docname_docid` (
  `id` varchar(20) NOT NULL,
  `patient_id` int(12) NOT NULL,
  `doctor_id` int(12) NOT NULL,
  `confirm` int(12) NOT NULL,
  `busy` int(12) NOT NULL,
  `appointment_id` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_details`
--

CREATE TABLE IF NOT EXISTS `doctor_details` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(12) NOT NULL,
  `city` varchar(255) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `experience` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login_doctor`
--

CREATE TABLE IF NOT EXISTS `login_doctor` (
  `id` int(12) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_doctor`
--

INSERT INTO `login_doctor` (`id`, `username`, `password`) VALUES
(1, 'a@a.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `login_patient`
--

CREATE TABLE IF NOT EXISTS `login_patient` (
  `id` int(12) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_details`
--

CREATE TABLE IF NOT EXISTS `patient_details` (
  `id` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(12) NOT NULL,
  `allergies` varchar(255) NOT NULL,
  `blood` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
