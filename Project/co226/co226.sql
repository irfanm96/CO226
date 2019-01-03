-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 01, 2019 at 03:38 PM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `co226`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

use co226;

CREATE TABLE `attendance` (
  `classId` int(6) NOT NULL,
  `studId` int(6) NOT NULL,
  `attendance` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(6) NOT NULL,
  `courseId` int(6) NOT NULL,
  `classType` enum('lab','lecture','tutorial') DEFAULT NULL,
  `classDate` date NOT NULL,
  `classTime` time NOT NULL,
  `duration` int(3) NOT NULL,
  `conductedBy` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classlist`
--

CREATE TABLE `classlist` (
  `courseId` int(6) NOT NULL,
  `studId` int(6) NOT NULL,
  `grade` varchar(2) DEFAULT NULL,
  `attendance` double DEFAULT NULL,
  `midResult` varchar(2) DEFAULT NULL,
  `endResult` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseId` int(6) NOT NULL,
  `courseTitle` text NOT NULL,
  `year` year(4) NOT NULL,
  `semester` int(1) NOT NULL,
  `lecId` int(6) NOT NULL,
  `instId` int(6) DEFAULT NULL,
  `contactHours` int(2) NOT NULL,
  `labHours` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(4) NOT NULL,
  `dKey` text,
  `dValue` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `salutation` int(1) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(1) NOT NULL,
  `lastAccess` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `salutation`, `email`, `password`, `role`, `lastAccess`) VALUES
(100000, 'A.J.N.M.', 'Jaliyagoda', 0, 'nuwanjaliyagoda@eng.pdn.ac.lk', 'e19d5cd5af0378da05f63f891c7467af', 0, '2019-01-01 08:04:17'),
(100001, 'Wishma', 'Herath', 0, 'wisheslakshan@gmail.com', 'e99a18c428cb38d5f260853678922e03', 0, '2018-12-25 06:54:35'),
(100003, 'M.M.M.', 'Irfan', 0, 'irfanmm96@gmail.com', 'f98746b7e160091120e7d27ab1dee7f2', 0, '2019-01-01 19:42:02'),
(100004, 'S. D. D. D. ', 'Karunarathna', 2, 'dinelkadilshani95@gmail.com', '157b7b2430a387b6520ea6a59f10cc03', 1, '2018-12-20 21:08:23'),
(100005, 'M. P. U.', 'Premathilaka', 0, 'pubuduudara7@gmail.com', 'd7bd7140578c2fa4184d83478117e6f7', 1, '2018-12-20 06:12:00'),
(100006, 'L.', 'Rishikeshan', 0, 'uni@ris.fi', '8aa7b25038a9f40115f7c2c611c705ea', 0, '2018-12-20 06:12:36'),
(100007, 'U. G. S. B. ', 'Samarasinghe', 0, 'imsuneth@gmail.com', '0eee302c310eb9c82b9394bc64e4d94d', 1, '2018-12-20 06:12:02'),
(100011, 'T.M.P.B', 'Tennakoon', 0, 'pasan96tennakoon@gmail.com', 'd7406b2cd944950fb261ebed970e93ad', 1, '2018-12-20 07:12:48'),
(100012, 'I.U.', 'Ekanayake', 0, 'imeshuek059@gmail.com', 'ac2d1363bc8e158cf21d67d94bc62480', 1, '2018-12-20 07:12:45');

-- --------------------------------------------------------

--
-- Table structure for table `userstudent`
--

CREATE TABLE `userstudent` (
  `eNum` varchar(8) NOT NULL,
  `id` int(6) NOT NULL,
  `dept` enum('COM','CIVIL','PROD','CHEM','MECH','ELEC') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userstudent`
--

INSERT INTO `userstudent` (`eNum`, `id`, `dept`) VALUES
('E/15/140', 100000, 'COM'),
('E/15/123', 100001, 'COM'),
('E/15/138', 100003, 'COM'),
('E/15/173', 100004, 'COM'),
('E/15/280', 100005, 'COM'),
('E/15/307', 100006, 'COM'),
('E/15/316', 100007, 'COM'),
('E/15/140', 100011, 'COM'),
('E/15/092', 100012, 'COM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`classId`,`studId`),
  ADD KEY `studId` (`studId`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courseId` (`courseId`),
  ADD KEY `conductedBy` (`conductedBy`);

--
-- Indexes for table `classlist`
--
ALTER TABLE `classlist`
  ADD PRIMARY KEY (`courseId`,`studId`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseId`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userstudent`
--
ALTER TABLE `userstudent`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `courseId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;
--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100013;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
