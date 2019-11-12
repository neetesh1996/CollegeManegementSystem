-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2019 at 02:35 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `collegemanagementsystem1`
--

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `ids` int(11) NOT NULL,
  `collegename` varchar(240) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `phoneno` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`ids`, `collegename`, `city`, `state`, `phoneno`) VALUES
(74, 'delhi University', 'delhi', 'delhi', '9009000009'),
(78, 'dalbagh', 'agra', 'up', '7886798098'),
(79, 'RMD', 'delhi', 'delhi', '9090909909'),
(80, 'BBDNM', 'Mumbai', 'maharashtra', '0980808000'),
(83, 'dayalbagh', 'agra', 'up', '0980808100');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_temp`
--

CREATE TABLE `password_reset_temp` (
  `email` varchar(100) NOT NULL,
  `key` varchar(240) NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_reset_temp`
--

INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) VALUES
('wamujonelo@rmailgroup.in', '768e78024aa8fdb9b8fe87be86f6474563a5045186', '2019-09-20 16:00:06'),
('zaft7w@mepost.pw', '768e78024aa8fdb9b8fe87be86f647458000955b7c', '2019-09-20 08:07:27'),
('11dkeh@airmailbox.website', '768e78024aa8fdb9b8fe87be86f647458a2f0ce993', '2019-09-18 16:05:25'),
('foti@coin-host.net', '768e78024aa8fdb9b8fe87be86f647458f149500a7', '2019-09-20 15:58:54'),
('1ogje0@mepost.pw', '768e78024aa8fdb9b8fe87be86f647459ba44bac7a', '2019-09-19 16:32:08'),
('h40t58@givememail.club', '768e78024aa8fdb9b8fe87be86f64745b2ba30ea88', '2019-09-19 16:07:56'),
('kumar1@gmail.com', '768e78024aa8fdb9b8fe87be86f64745cbfd750a60', '2019-09-21 08:59:25'),
('1ogje0@mepost.pw', '768e78024aa8fdb9b8fe87be86f64745dbe3aa9203', '2019-09-19 16:24:58'),
('1uoc4d@givememail.club', '768e78024aa8fdb9b8fe87be86f64745e0707b9d47', '2019-09-20 07:44:20');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `ids` int(255) NOT NULL,
  `sname` varchar(240) NOT NULL,
  `mobileno` varchar(240) NOT NULL,
  `email` varchar(240) NOT NULL,
  `department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `ids`, `sname`, `mobileno`, `email`, `department`) VALUES
(25, 78, 'Tejpratap', '7823674844', 's@gmail.com', 'CIVIL'),
(27, 79, 'college rmd staff', '0960709000', 'kumar1@gmail.com', 'CIVIL'),
(28, 74, 'shivtesh', '7823674836', 'ramesh@gmail.com', 'CSE'),
(29, 74, 'Arfan', '1960709000', 'arfan@gmail.com', 'CIVIL'),
(30, 80, 'narem', '9853400560', 'ram2@gmail.com', 'Electrical');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `trn_date`) VALUES
(62, 'Naresh', 'Naresh@gmail.com', '25d55ad283aa400af464c76d713c07ad', '2019-09-23 13:00:27'),
(63, 'veeram', 'sipijawan@web-inc.net', '5e8667a439c68f5145dd2fcbecf02209', '2019-09-23 14:22:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`ids`),
  ADD UNIQUE KEY `phoneno` (`phoneno`),
  ADD UNIQUE KEY `collegename` (`collegename`);

--
-- Indexes for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  ADD PRIMARY KEY (`key`),
  ADD KEY `email` (`email`),
  ADD KEY `email_2` (`email`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobileno` (`mobileno`),
  ADD KEY `staff_ibfk_1` (`ids`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `ids` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`ids`) REFERENCES `colleges` (`ids`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
