-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2016 at 04:19 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ismartpa_suntrustph`
--

-- --------------------------------------------------------

--
-- Table structure for table `autoemail`
--

CREATE TABLE IF NOT EXISTS `autoemail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `day` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `autoemail`
--

INSERT INTO `autoemail` (`id`, `test`, `day`, `email`) VALUES
(1, '2016-02-25 16:41:00', 0, 'jayjaypalmero@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `properties_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `arrangement` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `properties_id`, `title`, `img_name`, `arrangement`) VALUES
(6, 20, 'qq', 'img_2015-05-09-10-25-53_554dc49106d99.jpg', 4),
(8, 20, 'title', 'img_2015-05-09-10-52-45_554dcadd43730.jpg', 5),
(9, 20, '1212', 'img_2015-05-09-10-53-21_554dcb01112b0.jpg', 3),
(10, 26, '', 'img_2015-08-07-00-57-54_55c392128745f.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `properties_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `building` varchar(255) NOT NULL,
  `floor` varchar(255) NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `type_of_payment` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ticket_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `properties_id`, `user_id`, `price`, `building`, `floor`, `room_number`, `type_of_payment`, `created_at`, `ticket_id`) VALUES
(28, 20, 22, 3560000, '', '', '', '4', '2015-11-24 01:40:59', 43),
(29, 21, 21, 4500000, '', '', '', '4', '2015-11-24 01:45:02', 51),
(30, 21, 28, 4500000, '', '', '', '2', '2015-11-24 22:17:45', 53),
(32, 19, 28, 100000, '', '', '', '4', '2015-11-25 17:14:01', 54),
(39, 8, 22, 4500000, '', '', '', '1', '2016-02-16 13:25:32', 70);

-- --------------------------------------------------------

--
-- Table structure for table `pbfr`
--

CREATE TABLE IF NOT EXISTS `pbfr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `properties_id` int(11) NOT NULL,
  `building` varchar(255) NOT NULL,
  `floor` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `pbfr`
--

INSERT INTO `pbfr` (`id`, `properties_id`, `building`, `floor`, `room`, `status`) VALUES
(7, 20, '1', '1', '1', '0'),
(8, 20, '1', '1', '2', '0'),
(9, 20, '1', '2', '1', '1'),
(10, 20, '2', '1', '1', '0'),
(11, 23, '1', '1', '1', '1'),
(13, 20, '1', '2', '2', '0'),
(16, 8, '1', '2', '1', '1'),
(17, 8, '2', '1', '1', '0'),
(18, 8, '2', '3', '1', '0'),
(19, 8, '1', '2', '2', '0'),
(20, 8, '1', '1', '3', '1'),
(21, 8, '1', '3', '1', '0'),
(22, 8, '1', '4', '1', '0'),
(23, 8, '2', '3', '2', '0'),
(24, 19, '1', '1', '2', '1'),
(25, 19, '1', '1', '1', '1'),
(27, 8, '1', '1', '4', '1'),
(28, 21, '1', '1', '1', '1'),
(29, 21, '1', '1', '2', '1'),
(30, 21, '1', '1', '3', '1'),
(31, 21, '1', '1', '4', '1'),
(32, 24, '2', 'asdfasd', '2', '0'),
(33, 8, '1', '1', '1', '0'),
(34, 8, '1', '1', '2', '1'),
(35, 8, '1', '1', '5', '0');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE IF NOT EXISTS `properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `panotour` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `unit_type` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `panotour`, `title`, `img_name`, `unit_type`, `location`, `price`, `status`, `created_at`) VALUES
(8, '2BR1', 'Suntrust Parkview ( 2BR )', 'img_2015-05-06-09-06-08_5549bd607df78.jpg', '2 Bedroom', 'Ermita, Manila 2', '4500000', 'Available', '2015-08-09 23:15:07'),
(16, '2BR4', 'Suntrust Kirana ( 2BR )', 'img_2015-05-07-07-44-50_554afbd2d5593.jpg', '2 Bedroom', 'Urbank Velasco Ave, Pasig', '2500000', 'Reserved', '2016-02-18 00:46:32'),
(17, '1BR2', 'Suntrust Ascentia ( 1BR )', 'img_2015-05-07-07-34-10_554af952ec653.jpg', '1 Bedroom', 'Sta.Ana, Manila', '500000', 'Sold', '2015-08-13 18:47:14'),
(18, '2BR2', 'Suntrust Kirana( 2BR )', 'img_2015-05-07-07-45-46_554afc0a2e657.jpg', '2 Bedroom', 'Urbank Velasco Ave, Pasig', '2500000', 'Sold', '2015-08-09 23:21:16'),
(19, 'StudioType', 'Suntrust Ascentia ( Studio )', 'img_2015-05-07-07-47-20_554afc68bcd49.jpg', 'Studio', 'Sta.Ana, Manila', '100000', 'Available', '2015-08-09 23:41:21'),
(20, '2BR2', 'Suntrust Ascentia ( Studio )', 'img_2015-05-07-07-48-10_554afc9ac74b7.jpg', 'Studio', 'Sta.Ana, Manila', '3560000', 'Available', '2016-02-18 14:22:06'),
(21, '1BR3', 'Suntrust Parkview ( 1BR )', 'img_2015-10-07-07-56-01_56145f9161739.jpg', '1 Bedroom', 'Ermita, Manila 1', '4500000', 'Available', '2015-10-28 17:35:07'),
(22, 'Studio2', 'Suntrust Kirana ( Studio )', 'img_2015-05-07-07-49-43_554afcf748e69.jpg', 'Studio', 'Urbank Velasco Ave, Pasig', '1000000', 'Available', '2015-08-09 23:43:05'),
(23, 'StudioType', 'Suntrust Ascentia ( Studio )', 'img_2015-05-07-07-50-06_554afd0ee7ec2.jpg', 'Studio', 'Sta.Ana, Manila', '800000', 'Available', '2015-08-09 23:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `p_building`
--

CREATE TABLE IF NOT EXISTS `p_building` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `properties_id` int(11) NOT NULL,
  `building_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `p_building`
--

INSERT INTO `p_building` (`id`, `properties_id`, `building_name`) VALUES
(2, 12, '2');

-- --------------------------------------------------------

--
-- Table structure for table `p_floor`
--

CREATE TABLE IF NOT EXISTS `p_floor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `building_id` int(11) NOT NULL,
  `floor_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `p_room`
--

CREATE TABLE IF NOT EXISTS `p_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `floor_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `properties_id` int(11) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `agent` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `pbfr_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `properties_id`, `customer`, `agent`, `created_at`, `status`, `pbfr_id`) VALUES
(40, 8, 'jbuhian', 'umc_division2@outlook.com', '2015-07-13 19:33:07', '1', 21),
(41, 23, 'Mkbhd22', 'Gerard Miranda', '2015-07-13 19:38:41', '2', 11),
(42, 8, 'samsoriano', 'ucanreachcecil@yahoo.com', '2015-07-13 19:31:14', '2', 16),
(43, 20, 'juan', 'Gerard Miranda', '2015-11-25 20:51:23', '1', 9),
(50, 19, 'juan', 'jebautista2002@yahoo.com', '2015-11-24 01:08:07', '2', 25),
(51, 21, 'client', 'Gerard Miranda', '2015-11-25 20:52:53', '1', 28),
(53, 21, 'jayjaay', 'Gerard Miranda', '2016-02-14 06:17:45', '3', 29),
(54, 19, 'jayjaay', 'Gerard Miranda', '2016-02-14 00:19:48', '3', 24),
(70, 8, 'juan', 'Gerard Miranda', '2016-02-16 21:26:53', '1', 34);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `created_at`, `role_id`, `name`, `age`, `address`, `civil_status`, `nationality`, `contact_name`, `contact_email`) VALUES
(1, 'admin', 'admin', 'Manila_Sun_trust@outlook.com', '2015-04-29 00:00:00', 6, 'Yashi', '', 'Ground floor One world Square, Mckinley Hills Fort Bonifacio, Taguig, Metro Manila', 'single', 'local', 'Yashi Calugonan', 'Manila_Sun_trust@outlook.com'),
(21, 'client', 'client', 'bjpcapstone@gmail.com', '2015-05-10 18:13:07', 1, 'Client', '23', '', 'single', 'local', '', ''),
(22, 'juan', 'juan', 'aljon254@yahoo.com', '2015-05-11 03:29:27', 1, 'juan', '24', 'a', 'married', 'foreign', 'aa', 'aa'),
(23, 'maistroke', 'fatalbonds21', 'jayonline214@gmail.com', '2015-05-11 21:06:08', 1, 'james', '20', 'Manila', 'single', 'local', '', ''),
(27, 'Binsi721', 'binsi721', 'vinzie_03@yahoo.com', '2015-06-26 00:26:16', 1, 'Vinzie Angelo', '35', 'Sta. Ana Manila', 'married', 'local', '', ''),
(28, 'jayjaay', 'jayjaay', 'jayjaypalmero@gmail.com', '2015-06-26 00:29:27', 1, 'Jayjay Palmero', '20', 'Makati', 'single', 'local', '', ''),
(29, 'jm.bustria', 'johannjames', 'jessamarie_renz@yahoo.com', '2015-07-06 21:43:49', 1, 'jessa marie bustria', '18', '2730 P.Villanueva st.pasay city', 'single', 'local', '', ''),
(30, 'Gerard Miranda', 'tams123456', 'mirandagerard@yahoo.com', '2015-07-07 23:00:53', 5, 'Gerard Miranda', '20', '153 vcruz st. malibay pasay city', 'single', 'local', '', ''),
(31, 'Mkbhd', 'mkbhd23', 'nikkoreyes.23@gmail.com', '2015-07-12 19:43:58', 0, 'Nikko', '21', 'N/a', 'single', 'local', '', ''),
(32, 'jbuhian', '112345', 'johnbuhian@gmail.com', '2015-07-12 19:46:28', 1, 'John Buhian', '20', '2611 Tower 3, Madison Street, Barangka Ilaya, Mandaluyong City', 'single', 'local', '', ''),
(33, 'Mkbhd22', 'mkbhd22', 'nikkoreyes_23@yahoo.com', '2015-07-12 19:51:04', 1, 'Niks', '21', 'N/a', 'single', 'local', '', ''),
(34, 'christinefernandez', 'wildturtleforlife099', 'ami_matsuki023@yahoo.com', '2015-07-12 19:51:22', 2, 'Christine M. Fernandez', '15', '2711 P. Villanueva ', 'single', 'local', '', ''),
(35, 'leanardj', '09212408133', 'shean.afi@gmail.com', '2015-07-12 20:20:49', 1, 'Leanard', '19', '19 Hossana St. Cubao, Quezon City', 'single', 'local', '', ''),
(36, 'samsoriano', 'Babyblue203018', 'scq_soriano@yahoo.com', '2015-07-12 21:53:09', 1, 'Samantha Camille Q. Soriano', '19', '1740 A. Rivera St. Tondo, Manila', 'single', 'local', '', ''),
(37, 'drizconnie@yahoo.com.ph', 'CONNIE050268', 'drizconnie@yahoo.com.ph', '2015-07-13 05:12:04', 1, 'Connie Driz', '47', 'Makati', 'single', 'local', '', ''),
(38, 'ucanreachcecil@yahoo.com', 'Meimei123#', 'ucanreachcecil@yahoo.com', '2015-07-13 05:13:20', 5, 'Cecil', '46', 'Pasay ', 'married', 'local', '', ''),
(39, 'umc_division2@outlook.com', 'division2', 'umc_division2@outlook.com', '2015-07-13 05:16:00', 5, 'United Millionaires Club', '48', 'Taguig City', 'married', 'local', '', ''),
(40, 'jebautista2002@yahoo.com', 'twoj5252', 'jebautista2002@yahoo.com', '2015-07-13 05:21:15', 5, 'je bautista', '46', 'metro manila', 'married', 'local', '', ''),
(41, 'asf_suntrust@yahoo.com', 'Family28', 'asf_suntrust@yahoo.com', '2015-07-13 05:28:17', 5, 'Arlene Famularcano-Medina', '48', 'Cavite', 'married', 'local', '', ''),
(42, 'kaito', '950712405455', 'geneolivercasala@yahoo.com', '2015-07-20 18:14:48', 1, 'Gene Oliver L. Casala', '27', 'H. Domingo St. Pasay City', 'single', 'local', '', ''),
(43, 'mcrmbautista@outlook.com', 'twoj5252', 'mcrmbautista@outlook.com', '2015-09-16 08:18:35', 0, 'Ma. Cecilia Rowena Majarais Bautista', '46', 'pasay city', 'married', 'local', '', ''),
(44, 'asdasd', 'asd', 'asdasdasd@yahoo.com', '2015-12-16 16:54:04', 1, 'asd', '12', '', 'single', 'local', '', ''),
(48, 'Capstone', 'capstone', 'capstone@gmail.com', '2016-01-12 14:58:45', 0, 'Capstone', '19', 'Makati City', 'single', 'local', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `name`) VALUES
(0, 'inactive'),
(1, 'customer'),
(2, 'mis agent'),
(3, 'assistant'),
(4, 'manager'),
(5, 'sales agent'),
(6, 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
