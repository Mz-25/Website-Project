-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 01, 2014 at 01:03 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db1`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `a_id` int(11) NOT NULL,
  `bio` text,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`a_id`, `bio`) VALUES
(1, 'Πτύχιο στη λογιστική. Μιλάει 3 γλώσσες. Δουλεύει ως λογίστρια στην εταιρεία Logist'),
(2, 'Πτυχίο στα οικονομικά. Μιλάει 2 γλώσσες. Δουλεύει σε εταιρεία ηλεκτρονικών');

-- --------------------------------------------------------

--
-- Table structure for table `ad_cat`
--

CREATE TABLE IF NOT EXISTS `ad_cat` (
  `adm_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`adm_id`,`cat_id`),
  KEY `katig` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(50) NOT NULL,
  `c_description` mediumtext NOT NULL,
  PRIMARY KEY (`c_id`),
  UNIQUE KEY `c_name` (`c_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `c_name`, `c_description`) VALUES
(1, 'Υδραυλικό', 'Οποιαδήποτε προβλήματα αφορούν υδραυλικές ζημιές.'),
(2, 'Ηλεκτρολογικό', 'Οποιαδήποτε προβλήματα αφορούν ηλεκτρολογικές ζημιές στο Δήμο μας.'),
(3, 'Οδικό', 'Οποιαδήποτε προβλήματα αφορούν προβλήματα στις κτιριακές εγκαταστάσεις ή στο οδόστρωμα.'),
(4, 'Άλλο', 'Οποιοδήποτε άλλο πρόβλημα χωρίς κατηγορία.');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `rep_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`rep_id`,`photo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`rep_id`, `photo`) VALUES
(1, 'photos/Bear_59.jpg'),
(8, 'photos/Me_2_U_4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` bigint(20) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `authorization` enum('a','b') NOT NULL DEFAULT 'a',
  `gender` enum('m','f') NOT NULL,
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`p_id`, `name`, `surname`, `username`, `password`, `email`, `phone_number`, `birthdate`, `authorization`, `gender`) VALUES
(1, 'Μαρίνα', 'Ζαρνομήτρου', 'mz25', 'mouton90', 'marinaz@hotmail.com', 6993768989, '1990-02-25', 'b', 'f'),
(2, 'Γεωργία', 'Ζαρνομήτρου', 'geo02', 'bbdk92', 'gzarnomitrou@hotmail.com', 6942098765, '1992-11-02', 'b', 'f'),
(3, 'Ποσειδώνας', 'Ολύμπου', 'seagod', 'irock', 'poseid@hotmail.com', 2634098745, '1967-07-23', 'a', 'm'),
(4, 'Δίας ', 'Ολύμπιου', 'thundergod', '0909', 'thunder@gmail.com', 69785432, '0000-00-00', 'a', 'm'),
(5, 'Αφροδίτη', 'Ολύμπου', 'koxuli', 'love29', 'afrod@gmail.com', 6980547123, '1979-06-08', 'a', 'f'),
(6, 'Ήρα', 'Παρνασσού', 'peacock', 'hera20', 'pea@gmail.com', 6905862361, '1976-12-05', 'a', 'f');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `state` enum('s','u') NOT NULL DEFAULT 'u',
  `gps` varchar(100) NOT NULL,
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_description` mediumtext NOT NULL,
  `reg_date` datetime NOT NULL,
  `solv_date` datetime DEFAULT NULL,
  `solved_time` float DEFAULT NULL,
  `a_comments` text,
  `us_id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `categ_id` int(11) NOT NULL,
  PRIMARY KEY (`r_id`),
  KEY `rep_us` (`us_id`),
  KEY `rep_adm` (`ad_id`),
  KEY `cat` (`categ_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`state`, `gps`, `r_id`, `r_description`, `reg_date`, `solv_date`, `solved_time`, `a_comments`, `us_id`, `ad_id`, `categ_id`) VALUES
('u', '38.38211046268669, 21.81734704936389', 1, '		Έγινε κατολίσθηση και έπεσε ένας βράχος.', '2014-10-01 03:36:19', NULL, NULL, NULL, 3, 1, 3),
('u', '38.38991470629269, 21.82009363139514', 2, '		Σπάσανε οι σωλήνες', '2014-10-01 03:38:26', NULL, NULL, NULL, 4, 1, 1),
('s', '38.39256526599698, 21.82284021342639', 3, '	Κάτι γλάστρες είναι σπασμένεσ στη μέση του δρομου	', '2014-10-01 03:39:43', '2014-10-01 03:52:20', 0, 'Έχουμε τακτοποιήσει το θέμα.', 4, 2, 4),
('u', '38.405655186531995, 21.843868732103147', 4, '	Χαλασμένος ποδηλατόδρομος!	', '2014-10-01 03:41:41', NULL, NULL, NULL, 5, 1, 3),
('s', '38.3981889757319, 21.831852435716428', 5, '	Χαλασμένα φώτα κατά μήκος του δρόμου	', '2014-10-01 03:42:19', '2014-10-01 03:54:58', 0, 'live with it', 5, 1, 2),
('u', '38.39852530812013, 21.82781839335803', 6, '	Ραγισμένο οδόστρωμα	', '2014-10-01 03:45:37', NULL, NULL, NULL, 6, 1, 3),
('u', '38.39126018042149, 21.839663028367795', 7, '	Τρέχει πολύ νερό	', '2014-10-01 03:46:26', NULL, NULL, NULL, 6, 1, 1),
('u', '38.38910740979916, 21.84155130351428', 8, '		', '2014-10-01 03:48:47', NULL, NULL, NULL, 3, 1, 4),
('u', '38.399493936245186, 21.849705218919553', 9, '	Φθαρμένα καλώδια της ΔΕΗ	', '2014-10-01 03:49:24', NULL, NULL, NULL, 3, 1, 2),
('u', '38.39576733634642, 21.81906366313342', 10, '	Σπασμένοι σωλήνες στο δημόσιο αυτό κτίριο!	', '2014-10-01 03:50:07', NULL, NULL, NULL, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int(11) NOT NULL,
  `sign_up_date` datetime NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `sign_up_date`) VALUES
(3, '2014-10-01 03:23:51'),
(4, '2014-10-01 03:26:39'),
(5, '2014-10-01 03:29:52'),
(6, '2014-10-01 03:34:36');

-- --------------------------------------------------------

--
-- Table structure for table `us_ad`
--

CREATE TABLE IF NOT EXISTS `us_ad` (
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`admin_id`),
  KEY `diax` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `per_adm` FOREIGN KEY (`a_id`) REFERENCES `person` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ad_cat`
--
ALTER TABLE `ad_cat`
  ADD CONSTRAINT `diaxiris` FOREIGN KEY (`adm_id`) REFERENCES `administrator` (`a_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `katig` FOREIGN KEY (`cat_id`) REFERENCES `category` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `rep_img` FOREIGN KEY (`rep_id`) REFERENCES `report` (`r_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `rep_us` FOREIGN KEY (`us_id`) REFERENCES `user` (`u_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rep_adm` FOREIGN KEY (`ad_id`) REFERENCES `administrator` (`a_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cat` FOREIGN KEY (`categ_id`) REFERENCES `category` (`c_id`) ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `per_us` FOREIGN KEY (`u_id`) REFERENCES `person` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `us_ad`
--
ALTER TABLE `us_ad`
  ADD CONSTRAINT `xri` FOREIGN KEY (`user_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diax` FOREIGN KEY (`admin_id`) REFERENCES `administrator` (`a_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
