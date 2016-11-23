-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2016 at 08:02 AM
-- Server version: 5.5.24
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile_id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `first_name` varchar(1024) DEFAULT NULL,
  `last_name` varchar(1024) DEFAULT NULL,
  `birth` varchar(1024) DEFAULT NULL,
  `message` varchar(1024) DEFAULT NULL,
  `address` varchar(1024) DEFAULT NULL,
  `hobby` varchar(1024) DEFAULT NULL,
  `education` varchar(1024) DEFAULT NULL,
  `email` varchar(1024) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `image` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `user_id`, `first_name`, `last_name`, `birth`, `message`, `address`, `hobby`, `education`, `email`, `telp`, `image`) VALUES
(1, 1, 'Mario', 'Yaputra', '1997-12-26', 'Hi ! Nice to meet you guys !', 'jln.surga', 'play games', 's3', 'mario34105@gmail.com', '081265266955', 'Mario.png'),
(2, 2, 'Stanley', 'Leo', '1997-05-03', 'Hi ! Nice to meet you guys !', 'jln.surga', 'play games', 's3', 'stanzleoloveyou@gmail.com', '0813459827', 'Stanley.png'),
(3, 3, 'Sentosa', 'Huang', '0012-12-12', 'Kimochi !', 'jln.kimochi no 20a', 'fap fap', 's3', 'sentosakimochi@gmail.com', '08123456789', NULL),
(6, 6, 'Mahes', NULL, '1997-11-18', 'Hi ! Nice to meet you guys !', 'jln.neraka', 'play games', 'sma', 'mahesbodo@gmail.com', '0813459827', 'Mahes.png'),
(7, 7, 'Marco', 'Yaputra', '1997-12-26', 'Hi ! Nice to meet you guys !', 'jln.surga', 'play games', 's3', 'marcoyaputra@yahoo.com', '081265266955', 'Marco.png');

-- --------------------------------------------------------

--
-- Table structure for table `talent`
--

CREATE TABLE `talent` (
  `talent_id` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `talent_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `talent`
--

INSERT INTO `talent` (`talent_id`, `user_id`, `talent_name`) VALUES
(1, 1, 'sports'),
(2, 2, 'sports'),
(3, 3, 'no'),
(6, 6, 'no'),
(7, 7, 'sports');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(1024) NOT NULL,
  `gender` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `first_name`, `last_name`, `gender`) VALUES
(1, 'mario34105', '67daa30f2f749a23f244ab2f2330d229', 'Mario', 'Yaputra', 'male'),
(2, 'stanleyleo', 'c7656ce3fbb462c82bad4e11fc7f4165', 'Stanley', 'Leo', 'male'),
(3, 'sentosa', 'bb620da4ab487ecd4c7691d36756d7d6', 'Sentosa', 'Huang', 'male'),
(6, 'mahes', '244a7664d335451cb200d7a788cef176', 'Mahes', 'Yaputra', 'male'),
(7, 'marco', 'f5888d0bb58d611107e11f7cbc41c97a', 'Marco', 'Yaputra', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `talent`
--
ALTER TABLE `talent`
  ADD PRIMARY KEY (`talent_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `talent`
--
ALTER TABLE `talent`
  MODIFY `talent_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
