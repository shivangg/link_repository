-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2015 at 11:26 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `links`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_table`
--

CREATE TABLE IF NOT EXISTS `category_table` (
  `category_id` int(2) NOT NULL,
  `category_name` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_table`
--

INSERT INTO `category_table` (`category_id`, `category_name`) VALUES
(1, 'Entertainment'),
(2, 'Knowledge'),
(3, 'Fun'),
(4, 'Extras');

-- --------------------------------------------------------

--
-- Table structure for table `follow_table`
--

CREATE TABLE IF NOT EXISTS `follow_table` (
  `follower_id` int(3) NOT NULL,
  `followed_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follow_table`
--

INSERT INTO `follow_table` (`follower_id`, `followed_id`) VALUES
(4, 3),
(4, 5),
(4, 7),
(5, 3),
(5, 4),
(7, 3),
(7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `links_table`
--

CREATE TABLE IF NOT EXISTS `links_table` (
  `link_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(2) DEFAULT NULL,
  `title` varchar(75) NOT NULL,
  `user_desc` varchar(100) DEFAULT NULL,
  `crawl_desc` varchar(250) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `photo_location` varchar(200) DEFAULT NULL COMMENT 'to store the url of crawled photo',
  `mode` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 for private, 1 for public',
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `links_table`
--

INSERT INTO `links_table` (`link_id`, `user_id`, `category_id`, `title`, `user_desc`, `crawl_desc`, `url`, `photo_location`, `mode`, `time_added`) VALUES
(17, 3, 2, 'Home | Software Incubator', 'hello', 'Software Incubator is R&D centre of Ajay Kumar Garg Engineering College Ghaziabadand does software development, web-based enterprise solutions, web application and website development.', 'http://silive.in/', 'http://silive.in///Content/Images/logo.png', '1', '2015-10-17 13:41:45'),
(18, 3, 2, 'Prem Ratan Dhan Payo Official Trailer | Salman Khan & Sonam Kapoor | Sooraj', 'Prem Ratan Dhan payo ........', 'Watch the official trailer of Prem Ratan Dhan Payo, the most awaited film of 2015 only on YouTube.com/Rajshri. Salman Khan & Sooraj Barjatya come together af...', 'https://www.youtube.com/watch?v=Vd4iNPuRlx4', 'https://www.youtube.com/embed/Vd4iNPuRlx4', '1', '2015-10-17 14:02:39'),
(20, 4, 2, 'W3Schools Online Web Tutorials', 'learn as much as you can', 'The language for building web pages', 'http://www.w3schools.com/', 'http://www.w3schools.com///images/colorpicker.png', '1', '2015-10-17 18:47:48'),
(21, 4, 2, 'Welcome', 'HELLO dUMBO', 'Ajay Kumar Garg Engineering College, Ghaziabad also known as AKGEC.', 'http://akgec.in/', 'http://akgec.in///images/RobReilly.jpg', '1', '2015-10-23 13:32:55'),
(22, 4, 2, 'CSS Button Generator', 'Very good site to get new and useful buttons ..', 'Chicago Ruby on Rails developer', 'http://css3buttongenerator.com/', 'http://css3buttongenerator.com///images/icon_star1.png', '0', '2015-10-23 16:36:25'),
(23, 5, 2, 'PHP mysqli_num_rows() Function', '', 'Well organized and easy to understand Web bulding tutorials with lots of examples of how to use HTML, CSS, JavaScript, SQL, PHP, and XML.', 'http://www.w3schools.com/php/func_mysqli_num_rows.asp', '', '1', '2015-10-23 16:44:24'),
(24, 7, 3, 'Geeta Zaildar Plot Full Video | Prabh Near | Latest Punjabi Song 2015 | T-S', '', 'We bring to you Geeta Zaildar Brand New Song "Plot" which is composed by Prabh Near and written by Geeta Zaildar. Enjoy and share this video with your friend...', 'https://www.youtube.com/watch?v=3qHriMFxzY4', 'https://www.youtube.com/embed/3qHriMFxzY4', '1', '2015-10-23 20:19:25'),
(25, 7, 3, 'Ali Zafar & Sara Haider, Ae Dil, Coke Studio, Season 8, Episode 4', '', 'Ali Zafar & Sara Haider, Ae Dil, Coke Studio, Season 8, Episode 4 #Ã¢Â€ÂŽCokeStudio8Ã¢Â€Â¬Ã¢Â€Â¬ Produced By Strings', 'https://www.youtube.com/watch?v=1vPfLURfkBc', 'https://www.youtube.com/embed/1vPfLURfkBc', '0', '2015-10-24 06:29:21'),
(26, 4, 2, 'W3Schools Online Web Tutorials', '', 'The language for building web pages', 'http://www.w3schools.com/', 'http://www.w3schools.com///images/colorpicker.png', '0', '2015-10-24 08:36:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE IF NOT EXISTS `user_table` (
  `user_id` int(11) NOT NULL COMMENT 'primary key unique for user',
  `username` varchar(40) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `password1` varchar(40) DEFAULT NULL,
  `tagline` varchar(50) DEFAULT NULL COMMENT 'small subtitle for every user',
  `name` varchar(30) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `sex` enum('m','f','o') DEFAULT NULL,
  `dob` date NOT NULL,
  `work` varchar(30) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `username`, `email`, `mobile`, `password1`, `tagline`, `name`, `age`, `sex`, `dob`, `work`) VALUES
(1, '', NULL, NULL, NULL, NULL, 'rajat', NULL, NULL, '0000-00-00', NULL),
(2, '1', NULL, NULL, NULL, NULL, 'rajat', NULL, 'm', '2015-10-22', NULL),
(3, 'rajat', 'rajasalok1996@gmail.com', '2147483647', 'ddedc71d154a21a4a6c459501b003b5cba3c5c45', 'The CODER!!', 'Rajat-OLD', 18, 'm', '1996-12-30', 'Nothing'),
(4, 'rajat123', 'rajasalok199645@gmail.com', '7845123612', 'a872ed9b535839af54138a7118f4bf239b8b27e8', 'The CODER!!', 'Rajat', 18, 'm', '1996-11-30', 'Nothing'),
(5, 'proneet', 'proneet@gmail.com', '9877456542', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'SPEEEEDDDD !!!', 'Proneet', 18, 'm', '1996-12-12', 'Research'),
(6, 'shaishav', 'sh@gmail.com', '9845632217', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'CIVIL', 'Shaishav', 20, 'm', '1996-12-12', 'Nothing'),
(7, 'manoj123', 'manoj@gmail.com', '9874562130', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'Designing', 'Manoj', 20, 'm', '1996-12-14', 'Designing');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_table`
--
ALTER TABLE `category_table`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `follow_table`
--
ALTER TABLE `follow_table`
  ADD PRIMARY KEY (`follower_id`,`followed_id`);

--
-- Indexes for table `links_table`
--
ALTER TABLE `links_table`
  ADD PRIMARY KEY (`link_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `mobile` (`mobile`), ADD UNIQUE KEY `email_2` (`email`,`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_table`
--
ALTER TABLE `category_table`
  MODIFY `category_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `links_table`
--
ALTER TABLE `links_table`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key unique for user',AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
