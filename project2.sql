-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2026 at 10:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project2`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(100) NOT NULL,
  `project1_contribution` text DEFAULT NULL,
  `project2_contribution` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`member_id`, `member_name`, `project1_contribution`, `project2_contribution`) VALUES
(1, 'Lim Shien Nee', 'Github,jira,about us,CSS', 'about.php database and include files'),
(2, 'Yau Chee Xuen', 'apply.html and all-rounder', 'apply form modification and php validation,SQL database of EOI,process_eoi.php'),
(3, 'Teh Xuan Bin', 'index.html and all-rounder', 'Built the HR Manager login form , added a session check to protect manage.php,added database error handling'),
(4, 'Lim Ye An', 'job.html and all-rounder', 'Database (mainly),built inc files');

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `JRNum` varchar(5) NOT NULL,
  `fstname` varchar(25) NOT NULL,
  `lstname` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `gender_other` varchar(50) DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `suburbtown` varchar(50) NOT NULL,
  `state` varchar(3) NOT NULL,
  `postcode` char(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `slist` text NOT NULL,
  `oskills` text DEFAULT NULL,
  `status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`EOInumber`, `JRNum`, `fstname`, `lstname`, `dob`, `gender`, `gender_other`, `address`, `suburbtown`, `state`, `postcode`, `email`, `phone`, `slist`, `oskills`, `status`) VALUES
(7, '1GRPH', 'Lim', 'Nee', '2026-11-12', 'female', '', 'asfasfasf', 'fasfasfasf', 'vic', '2345', 'j25044262@student.newinti.edu.my', '01234455677', 'skill1, skill3', 'ssss', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `job_ref` varchar(10) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `salary` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `responsibilities` text NOT NULL,
  `essential_req` text NOT NULL,
  `preferable_req` text DEFAULT NULL,
  `reports_to` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_ref`, `job_title`, `salary`, `description`, `responsibilities`, `essential_req`, `preferable_req`, `reports_to`) VALUES
(1, '1GRPH', 'Graphic Designer', 'RM3800/m', 'Create digital ads, visual concepts and design that can attract attention.', '1. Create engaging digital ads and visual brand concepts.\r\n\r\n2. Design layout assets aligned with client marketing strategies.', 'Proficiency in graphic design software and visual communication.', 'Experience in web UI/UX design.', 'Creative Director'),
(2, '2WDEV', 'Web Developer', 'RM3200/m + bonuses', 'Build and maintain websites that fulfill the clients request.', '1. Develop and maintain responsive web pages using modern web standards.\n2. Ensure cross-browser compatibility and website functionality.', 'REQ-able to work in a team, communicate.', 'Basic understanding of backend integration.', 'Lead Software Engineer'),
(3, '3CONM', 'Content Manager', 'RM3500/m', 'To research and gain deep insight into trends and content to create strategy and finale execution.', '1. Analyze market trends and target audience behaviors.\n2. Develop content strategies and oversee final execution.', 'Strong analytical, research, and copywriting skills.', 'Experience managing digital marketing campaigns.', 'Marketing Director');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password_hash`) VALUES
(1, 'admin', '$2y$10$ENU/LShaJtpOfFNH6SsxAOYuTpkQnTSY6cFONkOvV4yJkD7mX1kP6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
