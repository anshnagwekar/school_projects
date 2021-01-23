-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2020 at 11:11 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university_of_ansh`
--

-- --------------------------------------------------------

--
-- Table structure for table `accepted_applications`
--

CREATE TABLE `accepted_applications` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` int(4) NOT NULL,
  `major` varchar(255) NOT NULL,
  `fin_aid_offer` int(100) NOT NULL DEFAULT 0,
  `class` int(4) NOT NULL,
  `enrolled` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accepted_applications`
--

INSERT INTO `accepted_applications` (`id`, `app_id`, `major`, `fin_aid_offer`, `class`, `enrolled`) VALUES
(4, 202530, 'Mechanical Engineering', 65000, 2025, 0),
(5, 202732, 'Computer Engineering', 0, 2027, 1);

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `school` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `gradYear` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(20) NOT NULL,
  `account_enabled` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `account_reg_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `username`, `password`, `first_name`, `last_name`, `school`, `city`, `state`, `gradYear`, `email`, `phone`, `account_enabled`, `account_reg_time`) VALUES
(2, 'anshnagwekar', '$2y$10$65RnccqGfrFAJwzoUb8VkON0BDPnH7NyOZ6ljKYs5s.8H/N5lVK2O', 'Ansh', 'Nagwekar', 'Bellarmine College Preparatory', 'San Jose', 'CA', 2021, 'ansh.nagwekar@gmail.com', 2147483647, 1, '2020-11-01 19:23:39'),
(4, 'admin', '$2y$10$oI1FEVWdWfffGjAo5Yluieqgy7W0vFPDa2akWkV.8ds4XBYt7HEpy', 'Ansh', 'Nagwekar', 'University of Ansh', 'San Jose', 'CA', 2000, 'ansh.nagwekar@gmail.com', 2147483647, 1, '2020-11-06 23:58:17'),
(5, 'bobbyjenkins', '$2y$10$XSODmhMQ0s.QbpTn/QP6jeTXJCjPULTbMCKlNyz8I2SsM1OTPrMoa', 'Bob', 'Jenkins', 'AMHS', 'San Jose', 'California', 2021, 'bobj@yahoo.com', 2147483647, 1, '2020-11-11 06:15:43'),
(6, 'guydawg', '$2y$10$1g6JfjhBbTbJScASTXE5rOtIApUx9RWIMUoqc5gCJCxflVQHnee5S', 'Guy', 'Dawg', 'SFHS', 'San Jose', 'California', 2022, 'guydawg@gmail.com', 2147483647, 1, '2020-11-11 06:33:33'),
(7, 'jimmybottle', '$2y$10$GiAYgAZV8bhGrz7YTTQc2O7vNmWoarngOA/XUjMV3TF21fzk3YpIa', 'Jimmy', 'Bottle', 'BCP', 'San Jose', 'California', 2021, 'ansh.nagwekar@gmail.com', 2147483647, 1, '2020-11-11 06:36:06'),
(8, 'salazarslytherin', '$2y$10$nTPzjvW.DgnMgVi6FDylpO6PI9.MqKfq1Pw2PPdzmvIkXpRe0t6pa', 'Salazar', 'Slytherin', 'SFHS', 'San Jose', 'CA', 2022, 'ansh.nagwekar@gmail.com', 2147483647, 1, '2020-11-11 06:40:03'),
(10, 'roopamjain', '$2y$10$.2vHdGG3ibC.och/ngNKt.vQeLsiBstpR8k0NWq8ZzP4SLVjP6Fke', 'Roopam', 'Jain', 'School for Cool People', 'San Francisco', 'California', 2023, 'rjain@gmail.com', 1234567890, 1, '2020-11-11 06:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `account_sessions`
--

CREATE TABLE `account_sessions` (
  `session_id` varchar(255) NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account_sessions`
--

INSERT INTO `account_sessions` (`session_id`, `account_id`, `login_time`) VALUES
('e4maiemjlh2rr1146tbkaqk5l8', 4, '2020-11-26 21:01:13');

-- --------------------------------------------------------

--
-- Table structure for table `application_responses`
--

CREATE TABLE `application_responses` (
  `id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `expectedGradYear` int(10) NOT NULL,
  `parent_first_name` varchar(255) NOT NULL,
  `parent_last_name` varchar(255) NOT NULL,
  `parent_email` varchar(255) NOT NULL,
  `parent_job` varchar(255) NOT NULL,
  `parent_income` int(100) NOT NULL,
  `financial_aid` int(1) DEFAULT NULL,
  `major_interest1` varchar(255) NOT NULL,
  `major_interest2` varchar(255) DEFAULT NULL,
  `major_interest3` varchar(255) DEFAULT NULL,
  `gpa` float NOT NULL,
  `SAT` int(100) DEFAULT NULL,
  `ACT` int(100) DEFAULT NULL,
  `AP_classes` int(10) NOT NULL,
  `Honors_classes` int(10) NOT NULL,
  `why_major` longtext NOT NULL,
  `why_uoa` longtext NOT NULL,
  `additional_info` longtext DEFAULT NULL,
  `recommendation` int(1) NOT NULL DEFAULT 0,
  `transcript` int(1) DEFAULT 0,
  `offer` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `application_responses`
--

INSERT INTO `application_responses` (`id`, `app_id`, `username`, `expectedGradYear`, `parent_first_name`, `parent_last_name`, `parent_email`, `parent_job`, `parent_income`, `financial_aid`, `major_interest1`, `major_interest2`, `major_interest3`, `gpa`, `SAT`, `ACT`, `AP_classes`, `Honors_classes`, `why_major`, `why_uoa`, `additional_info`, `recommendation`, `transcript`, `offer`) VALUES
(28, 202628, 'bobbyjenkins', 2026, 'John', 'Doe', 'johndoe@doe.org', 'CEO at Doe LLC', 20009009, 0, 'Computer Science', 'Industrial Engineering', 'Biomedical Engineering', 3.6, NULL, 35, 9, 3, 'I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. ', 'I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. ', 'Go AMHS!', 1, 1, 'waitlisted'),
(29, 202529, 'guydawg', 2025, 'John', 'Doe', 'jd@bcp.org', 'Engineer at Google', 1000000, 0, 'Data and Information Sciences', 'Electrical Engineering', 'Computer Science', 4, 1570, NULL, 10, 10, 'I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. ', 'I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. I like the University of Ansh because I like the University of Ansh. ', 'I like the University of Ansh because I like the University of Ansh. ', 0, 0, 'under review'),
(30, 202530, 'jimmybottle', 2025, 'Jimmy', 'Jug', 'jug@bcp.org', 'Unemployed at Nowhere', 100000, 1, 'Environmental Engineering', 'Mechanical Engineering', 'Industrial Engineering', 3.4, NULL, 33, 5, 2, 'I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. ', 'I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. ', 'Yipeee!', 1, 1, 'accepted'),
(31, 202631, 'salazarslytherin', 2026, 'Bro', 'Slytherin', 'sl@gmail.com', 'Wizard at Hogwarts', 1000, 1, 'Biomedical Engineering', 'undecided', 'undecided', 2.8, 1370, NULL, 0, 0, 'I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. ', 'I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. ', 'I can turn into a snake!', 0, 0, 'under review'),
(32, 202732, 'roopamjain', 2027, 'Ansh', 'Nagwekar', 'ansh.nagwekar@gmail.com', 'Engineer at AWS', 2147483647, 0, 'Computer Science', 'Computer Engineering', 'Mechanical Engineering', 4, 1590, 36, 10, 11, 'I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. ', 'I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. ', '', 1, 1, 'enrolled'),
(35, 202635, 'anshnagwekar', 2026, 'Parag', 'Nagwekar', 'nag@gmail.com', 'Engineer at AWS', 100000, 0, 'Computer Engineering', 'Electrical Engineering', 'Data and Information Sciences', 4, NULL, 36, 12, 6, 'I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. \r\n', 'I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. I like this major because I like this major. \r\n', '', 1, 1, 'under review');

-- --------------------------------------------------------

--
-- Table structure for table `recommendations`
--

CREATE TABLE `recommendations` (
  `rec_id` int(10) UNSIGNED NOT NULL,
  `app_id` int(10) NOT NULL,
  `title` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `perform_text` longtext NOT NULL,
  `perform_percentile` int(10) NOT NULL,
  `collab_text` longtext NOT NULL,
  `collab_percentile` int(10) NOT NULL,
  `potential_text` longtext NOT NULL,
  `potential_percentile` int(10) NOT NULL,
  `final_words` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recommendations`
--

INSERT INTO `recommendations` (`rec_id`, `app_id`, `title`, `name`, `email`, `position`, `perform_text`, `perform_percentile`, `collab_text`, `collab_percentile`, `potential_text`, `potential_percentile`, `final_words`) VALUES
(5, 202628, 'Mrs.', 'Mary Jane', 'mjane@jane.org', 'Science Teacher at AMHS', 'This kid is a great student. He is really awesome. I would accept him because I said so.This kid is a great student. He is really awesome. I would accept him because I said so.This kid is a great student. He is really awesome. I would accept him because I said so.This kid is a great student. He is really awesome. I would accept him because I said so.This kid is a great student. He is really awesome. I would accept him because I said so.This kid is a great student. He is really awesome. I would accept him because I said so.This kid is a great student. He is really awesome. I would accept him because I said so.This kid is a great student. He is really awesome. I would accept him because I said so.This kid is a great student. He is really awesome. I would accept him because I said so.This kid is a great student. He is really awesome. I would accept him because I said so.', 5, 'This kid is a great student. He is really awesome. I would accept him because I said so.This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so.', 25, 'This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so.This kid is a great student. He is really awesome. I would accept him because I said so.This kid is a great student. He is really awesome. I would accept him because I said so.This kid is a great student. He is really awesome. I would accept him because I said so.This kid is a great student. He is really awesome. I would accept him because I said so.This kid is a great student. He is really awesome. I would accept him because I said so.This kid is a great student. He is really awesome. I would accept him because I said so.This kid is a great student. He is really awesome. I would accept him because I said so.This kid is a great student. He is really awesome. I would accept him because I said so.This kid is a great student. He is really awesome. I would accept him because I said so.', 5, 'This kid is a great student. He is really awesome. I would accept him because I said so.'),
(6, 202530, 'Mr.', 'Call of Duty', 'cod@cod.org', 'Professional Gamer at Faze Clan', 'This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. He hits cool shots. This kid is a great student. He is really awesome. I would accept him because I said so.\r\nThis kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so.', 1, 'This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. He hits cool shots. This kid is a great student. He is really awesome. I would accept him because I said so.\r\nThis kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so.', 1, 'This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. He hits cool shots. This kid is a great student. He is really awesome. I would accept him because I said so.\r\nThis kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so.', 1, ''),
(7, 202732, 'Mr.', 'Call of Duty', 'cod@cod.org', 'Professional Gamer at Faze Clan', 'This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. He hits cool shots. This kid is a great student. He is really awesome. I would accept him because I said so.\r\nThis kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so.', 25, 'This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. He hits cool shots. This kid is a great student. He is really awesome. I would accept him because I said so.\r\nThis kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so.', 50, 'This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. He hits cool shots. This kid is a great student. He is really awesome. I would accept him because I said so.\r\nThis kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so.', 5, 'Take him bc he is really nice with it!'),
(8, 202534, 'Mrs.', 'Frank Sherman', 'sherman@gmail.com', 'Professional Gamer at Faze Clan', 'He is super cool man. He is super cool, man. He is super cool man. He is super cool, man. He is super cool man. He is super cool, man. He is super cool man. He is super cool, man. He is super cool man. He is super cool, man.He is super cool man. He is super cool, man. He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.  He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man. ', 1, 'He is super cool man. He is super cool, man. He is super cool man. He is super cool, man. He is super cool man. He is super cool, man. He is super cool man. He is super cool, man. He is super cool man. He is super cool, man.He is super cool man. He is super cool, man. He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man. He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.  He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man. ', 1, 'He is super cool man. He is super cool, man. He is super cool man. He is super cool, man. He is super cool man. He is super cool, man. He is super cool man. He is super cool, man. He is super cool man. He is super cool, man.He is super cool man. He is super cool, man. He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man. He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.  He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.He is super cool man. He is super cool, man.  ', 1, ''),
(9, 202635, 'Mrs.', 'Cool Mom', 'coolmom@bcp.org', 'English teacher at Bellarmine', 'This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. He hits cool shots. This kid is a great student. He is really awesome. I would accept him because I said so.\r\nThis kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so.', 1, 'This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. He hits cool shots. This kid is a great student. He is really awesome. I would accept him because I said so.\r\nThis kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so.', 1, 'This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. He hits cool shots. This kid is a great student. He is really awesome. I would accept him because I said so.\r\nThis kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so. This kid is a great student. He is really awesome. I would accept him because I said so.', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accepted_applications`
--
ALTER TABLE `accepted_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `account_sessions`
--
ALTER TABLE `account_sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `application_responses`
--
ALTER TABLE `application_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD PRIMARY KEY (`rec_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accepted_applications`
--
ALTER TABLE `accepted_applications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `application_responses`
--
ALTER TABLE `application_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `recommendations`
--
ALTER TABLE `recommendations`
  MODIFY `rec_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
