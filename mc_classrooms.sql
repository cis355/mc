-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u3
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 15, 2018 at 09:41 AM
-- Server version: 5.5.60-0+deb8u1
-- PHP Version: 5.6.36-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gpcorser`
--

-- --------------------------------------------------------

--
-- Table structure for table `mc_classrooms`
--

CREATE TABLE IF NOT EXISTS `mc_classrooms` (
`id` int(11) NOT NULL,
  `classroom_name` varchar(255) NOT NULL,
  `occupied` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mc_classrooms`
--

INSERT INTO `mc_classrooms` (`id`, `classroom_name`, `occupied`) VALUES
(1, 'SE-145', 0),
(2, 'SE-135', 0),
(3, 'SE-119', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mc_classrooms`
--
ALTER TABLE `mc_classrooms`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mc_classrooms`
--
ALTER TABLE `mc_classrooms`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
