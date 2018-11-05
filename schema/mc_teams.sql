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
-- Table structure for table `mc_teams`
--

CREATE TABLE IF NOT EXISTS `mc_teams` (
`id` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `team_school` int(11) NOT NULL,
  `classroom1` int(11) NOT NULL,
  `side1` int(11) NOT NULL,
  `competitor1` int(11) NOT NULL,
  `classroom2` int(11) NOT NULL,
  `side2` int(11) NOT NULL,
  `competitor2` int(11) NOT NULL,
  `classroom3` int(11) NOT NULL,
  `side3` int(11) NOT NULL,
  `competitor3` int(11) NOT NULL,
  `team_number` int(11) NOT NULL,
  `team_number1` int(11) NOT NULL,
  `team_number2` int(11) NOT NULL,
  `team_number3` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=281 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mc_teams`
--

INSERT INTO `mc_teams` (`id`, `team_name`, `team_school`, `classroom1`, `side1`, `competitor1`, `classroom2`, `side2`, `competitor2`, `classroom3`, `side3`, `competitor3`, `team_number`, `team_number1`, `team_number2`, `team_number3`) VALUES
(265, 'Able Attorneys', 128, 1, 1, 266, 7, 2, 268, 8, 2, 270, 1, 2, 4, 6),
(266, 'Brilliant Barristers', 129, 1, 2, 265, 8, 1, 267, 7, 2, 272, 2, 1, 3, 8),
(267, 'Creative Counselors', 130, 2, 1, 268, 8, 2, 266, 6, 1, 269, 3, 4, 2, 5),
(268, 'Determined Defenders', 131, 2, 2, 267, 7, 1, 265, 5, 1, 271, 4, 3, 1, 7),
(269, 'Effective Esquires', 132, 3, 1, 270, 5, 2, 272, 6, 2, 267, 5, 6, 8, 3),
(270, 'Feud Fixers', 133, 3, 2, 269, 6, 1, 271, 8, 1, 265, 6, 5, 7, 1),
(271, 'Gifted Gabbers', 134, 4, 1, 272, 6, 2, 270, 5, 2, 268, 7, 8, 6, 4),
(272, 'Honorable Haranguers', 135, 4, 2, 271, 5, 1, 269, 7, 1, 266, 8, 7, 5, 2),
(273, 'Inventive Impresarios', 128, 5, 1, 274, 3, 2, 276, 4, 2, 278, 9, 10, 12, 14),
(274, 'Jubilant Jurists', 129, 5, 2, 273, 4, 1, 275, 3, 2, 280, 10, 9, 11, 16),
(275, 'Knowledgeable Kibitzers', 130, 6, 1, 276, 4, 2, 274, 2, 1, 277, 11, 12, 10, 13),
(276, 'Lucky Lawyers', 131, 6, 2, 275, 3, 1, 273, 1, 1, 279, 12, 11, 9, 15),
(277, 'Moderate Musers', 132, 7, 1, 278, 1, 2, 280, 2, 2, 275, 13, 14, 16, 11),
(278, 'Nonchalant Negotiators', 133, 7, 2, 277, 2, 1, 279, 4, 1, 273, 14, 13, 15, 9),
(279, 'Onerous Orators', 134, 8, 1, 280, 2, 2, 278, 1, 2, 276, 15, 16, 14, 12),
(280, 'Professional Practitioners', 135, 8, 2, 279, 1, 1, 277, 3, 1, 274, 16, 15, 13, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mc_teams`
--
ALTER TABLE `mc_teams`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mc_teams`
--
ALTER TABLE `mc_teams`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=281;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
