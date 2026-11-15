-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2026-11-15 03:41:33
-- 服务器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `project2_db`
--

-- --------------------------------------------------------

--
-- 表的结构 `about`
--

CREATE TABLE `about` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(100) NOT NULL,
  `project1_contribution` text DEFAULT NULL,
  `project2_contribution` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `about`
--

INSERT INTO `about` (`member_id`, `member_name`, `project1_contribution`, `project2_contribution`) VALUES
(1, 'Yau Chee Xuen', 'apply.html and all-rounder', 'apply form modification and php validation,SQL database of EOI,process_eoi.php'),
(2, 'Teh Xuan Bin', 'index.html and all-rounder', 'Built the HR Manager login form , added a session check to protect manage.php,added database error handling'),
(3, 'Lim Ye An ', 'job.html and all-rounder', 'Database (mainly),built inc files'),
(4, 'Lim Shien Nee', 'github,jira,about.html,css(mainly)', 'database for about,settings.php,presenation slides(mainly)');

-- --------------------------------------------------------

--
-- 表的结构 `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `job_ref` varchar(10) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `salary` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `responsibilities` text NOT NULL,
  `essential_req` text NOT NULL,
  `preferable_req` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_ref`, `job_title`, `salary`, `description`, `responsibilities`, `essential_req`, `preferable_req`) VALUES
(1, '1GRPH', 'Graphic Designer', 'RM4000/m', 'Create digital ads, visual concepts and design that can attract attention.', '1. Create engaging digital ads and visual brand concepts.\n2. Design layout assets aligned with client marketing strategies.', 'Proficiency in graphic design software and visual communication.', 'Experience in web UI/UX design.'),
(2, '2WDEV', 'Web Developer', 'RM3200/m + bonuses', 'Build and maintain websites that fulfill the clients request.', '1. Develop and maintain responsive web pages using modern web standards.\n2. Ensure cross-browser compatibility and website functionality.', 'REQ-able to work in a team, communicate.', 'Basic understanding of backend integration.'),
(3, '3CONM', 'Content Manager', 'RM3500/m', 'To research and gain deep insight into trends and content to create strategy and finale execution.', '1. Analyze market trends and target audience behaviors.\n2. Develop content strategies and oversee final execution.', 'Strong analytical, research, and copywriting skills.', 'Experience managing digital marketing campaigns.');

--
-- 转储表的索引
--

--
-- 表的索引 `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`member_id`);

--
-- 表的索引 `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD UNIQUE KEY `job_ref` (`job_ref`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `about`
--
ALTER TABLE `about`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
