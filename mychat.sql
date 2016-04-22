-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2016 at 01:52 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mychat`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sent_time` datetime NOT NULL,
  `recvd_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `sent_time`, `recvd_time`) VALUES
(1, 1, 2, 'hey!', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 2, 'what are u doing?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 1, 'i am fine!', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2, 1, 'u?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 2, 'me too :)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 2, 'then...', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 2, 'ooo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 2, 'hey', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 2, 'hi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 2, 'yo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 1, 2, 'testing', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 2, 1, 'i am back!', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 1, 3, 'i am himanshu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 3, 1, 'r u sure?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 1, 3, 'oops ;)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 3, 1, 'i am abhijeet', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 1, 3, 'ikr', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 1, 3, 'i am akshat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 1, 3, 'a', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 1, 2, 'o', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 1, 2, 'new one', '2016-04-22 00:28:44', '0000-00-00 00:00:00'),
(23, 1, 2, 'n', '2016-04-22 00:30:07', '0000-00-00 00:00:00'),
(24, 1, 2, 'a very long message a very long message a very long message a very long message a very long message', '2016-04-22 01:22:58', '0000-00-00 00:00:00'),
(25, 2, 1, 'hey', '2016-04-22 10:32:56', '0000-00-00 00:00:00'),
(26, 1, 2, 'hi', '2016-04-22 10:56:24', '0000-00-00 00:00:00'),
(27, 2, 1, 'hi', '2016-04-22 10:56:34', '0000-00-00 00:00:00'),
(28, 2, 1, 'hi', '2016-04-22 10:57:40', '0000-00-00 00:00:00'),
(29, 2, 1, 'ad', '2016-04-22 10:57:50', '0000-00-00 00:00:00'),
(30, 1, 2, 'hi', '2016-04-22 11:11:03', '0000-00-00 00:00:00'),
(31, 1, 2, 'hasdbf', '2016-04-22 11:16:43', '0000-00-00 00:00:00'),
(32, 2, 1, 'ugvbj', '2016-04-22 12:03:02', '0000-00-00 00:00:00'),
(33, 1, 2, 'hi', '2016-04-22 12:03:09', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `display_picture` varchar(128) DEFAULT 'default_dp.jpeg',
  `last_seen` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `display_picture`, `last_seen`) VALUES
(1, 'Akshat', '1.jpeg', '2016-04-22 06:39:49'),
(2, 'Himanshu', '2.jpeg', '2016-04-22 06:39:33'),
(3, 'Abhijeet', 'default_dp.jpeg', '2016-04-21 16:31:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
