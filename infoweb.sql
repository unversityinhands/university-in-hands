-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 08:54 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infoweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `instructor_info`
--

CREATE TABLE `instructor_info` (
  `instructor_id` int(10) NOT NULL,
  `instructor_name` varchar(70) NOT NULL,
  `instructor_expr` varchar(255) NOT NULL,
  `unversity_id` int(10) NOT NULL,
  `manager_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `majors_info`
--

CREATE TABLE `majors_info` (
  `major_id` int(10) NOT NULL,
  `major_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `majors_info`
--

INSERT INTO `majors_info` (`major_id`, `major_name`) VALUES
(1, 'AI'),
(2, 'Cyber Security'),
(3, 'Computer Science'),
(4, 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `remember_me_tokens`
--

CREATE TABLE `remember_me_tokens` (
  `user_id` int(10) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiration` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `remember_me_tokens`
--

INSERT INTO `remember_me_tokens` (`user_id`, `token`, `expiration`) VALUES
(53, '537b270ba6e79f2bee9cfda16cb9a6c107de14d186c7fbc8f6ac994a15a1ac66', '2024-03-19');

-- --------------------------------------------------------

--
-- Table structure for table `unversity_info`
--

CREATE TABLE `unversity_info` (
  `unversity_id` int(10) NOT NULL,
  `unversity_name` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `logo` varchar(60) NOT NULL,
  `manager_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `unversity_info`
--

INSERT INTO `unversity_info` (`unversity_id`, `unversity_name`, `description`, `logo`, `manager_id`) VALUES
(31, 'qw', 'qw', '65d1df13c8785.jpg', 53),
(32, 'no', 'no', '65d307ff874c3.png', 58);

-- --------------------------------------------------------

--
-- Table structure for table `unversity_majors`
--

CREATE TABLE `unversity_majors` (
  `unversity_id` int(10) NOT NULL,
  `major_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `unversity_majors`
--

INSERT INTO `unversity_majors` (`unversity_id`, `major_id`) VALUES
(31, 1),
(31, 2),
(32, 1),
(32, 3);

-- --------------------------------------------------------

--
-- Table structure for table `usersinfo`
--

CREATE TABLE `usersinfo` (
  `user_id` int(10) NOT NULL,
  `user_first_name` varchar(30) NOT NULL,
  `user_last_name` varchar(30) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `usersinfo`
--

INSERT INTO `usersinfo` (`user_id`, `user_first_name`, `user_last_name`, `user_email`, `user_password`) VALUES
(53, 'adfa', 'ad', 'o@o.com', '$2y$10$yfcIppQi86JXW6qlCWd59.VBwvtGO4WnKzXL4NVEYgvoqERR5rbpm'),
(54, 'adfa', 'ad', 'os@gmail.com', '$2y$10$zem0DlG3FnaEgBt6AV.SoeN0ihuD8XFanOud9MbjnxKj7H8K0ii0m'),
(55, 'omar', 'al-afif', 'Sayed@gmail.com', '$2y$10$Z0rShroOE0UgNIuczBCtaOnkGkjznWrdMbMbShMDTbsABHNpk6.6a'),
(56, 'sdsd', 'ad', 'omaralafif82@gmail.com', '$2y$10$ch5Xbh0hIFdYSeRERfoil.UpzVpqV/M3qFHNUVypirJuMXPLZNouW'),
(57, 'adfa', 'ad', 'o1@o.com', '$2y$10$0ajQUbIAcmMad78uF02d5ej2g6iZdrrURX07eFF4CRZWsxUjeTACC'),
(58, 'no', 'no', 'no@gmail.com', '$2y$10$3XAU2Lew5MCedw0Kk3c5T.O2kcK8FYCsauRmPCAPhYq.LY6DcRoPC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instructor_info`
--
ALTER TABLE `instructor_info`
  ADD PRIMARY KEY (`instructor_id`),
  ADD KEY `unversity_id` (`unversity_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `majors_info`
--
ALTER TABLE `majors_info`
  ADD PRIMARY KEY (`major_id`);

--
-- Indexes for table `remember_me_tokens`
--
ALTER TABLE `remember_me_tokens`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `unversity_info`
--
ALTER TABLE `unversity_info`
  ADD PRIMARY KEY (`unversity_id`),
  ADD KEY `manager_id` (`manager_id`);

--
-- Indexes for table `unversity_majors`
--
ALTER TABLE `unversity_majors`
  ADD PRIMARY KEY (`unversity_id`,`major_id`),
  ADD KEY `major_id` (`major_id`);

--
-- Indexes for table `usersinfo`
--
ALTER TABLE `usersinfo`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instructor_info`
--
ALTER TABLE `instructor_info`
  MODIFY `instructor_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `unversity_info`
--
ALTER TABLE `unversity_info`
  MODIFY `unversity_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `usersinfo`
--
ALTER TABLE `usersinfo`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `instructor_info`
--
ALTER TABLE `instructor_info`
  ADD CONSTRAINT `instructor_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usersinfo` (`user_id`);

--
-- Constraints for table `unversity_info`
--
ALTER TABLE `unversity_info`
  ADD CONSTRAINT `unversity_info_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `usersinfo` (`user_id`);

--
-- Constraints for table `unversity_majors`
--
ALTER TABLE `unversity_majors`
  ADD CONSTRAINT `unversity_majors_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `majors_info` (`major_id`),
  ADD CONSTRAINT `unversity_majors_ibfk_2` FOREIGN KEY (`unversity_id`) REFERENCES `unversity_info` (`unversity_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
