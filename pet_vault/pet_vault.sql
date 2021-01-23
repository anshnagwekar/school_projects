-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2020 at 12:45 AM
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
-- Database: `pet_vault`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dog_layer` varchar(255) DEFAULT NULL,
  `cat_layer` varchar(255) DEFAULT NULL,
  `fish_layer` varchar(255) DEFAULT NULL,
  `name` varchar(40) NOT NULL,
  `account_enabled` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `account_reg_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `username`, `password`, `dog_layer`, `cat_layer`, `fish_layer`, `name`, `account_enabled`, `account_reg_time`) VALUES
(2, 'anshnagwekar', '$2y$10$HF7p3JqOGgmzfoSIeT8GwOqPQYA2ViOrnxwIoeo.Ax68Hj2Q.CX5W', '101100000', '1000101000', '110000010000', 'Ansh Nagwekar', 1, '2020-12-10 03:29:14'),
(3, 'bobbyjenkins', '$2y$10$0OI4w.yyy1Ry3PzTv4yCae7gG.0S4Jx2S8uarTdjSRz53IJa2THJS', '1001000000001', '100000110000', '10100100000000', 'Bobby Jenkins', 1, '2020-12-15 01:02:14'),
(4, 'georgeforeman', '$2y$10$zMvUlKhlvgtuaYZSpL.wNeg31nH9txCS6WxCL8rFY5oZuwj8cCv.a', '1000010010', '1000110000', '100001100000', 'George Foreman', 1, '2020-12-15 01:11:21'),
(5, 'full53nd', '$2y$10$ZN9cIp6KPhXmPhXmWLOmwu117zqGxm2SvFycnx1tf0BdUcdIG86Nu', '100000110000000', '100000101000', '100000001001', 'Full Send', 1, '2020-12-15 01:12:32'),
(6, 'richardsherman', '$2y$10$tCD07w9cRS.GATblc/hNW.L0.4GkjnEY2Ywe9Ib9D8U9ZqfBg/oxO', '100001001000000', '100010000010', '10100001', 'Richard Sherman', 1, '2020-12-15 01:13:34'),
(7, 'deebosamuel', '$2y$10$e1ZUP69AY/TOv.zIGpuMZuLQcgfpm93U3v8RKctxjHnbHSFBOuAZy', '10100000000010', '100010100', '1000110000', 'Deebo Samuel', 1, '2020-12-15 01:14:08'),
(8, 'rhiggins', '$2y$10$lfkF3RIQ/WDcfUB.P8XmOOrb4ICDZDOabohRYXN89tX3S/41IMbwu', '1100100000000', '1000001000100', '1000001000010', 'Rashard Higgins', 1, '2020-12-15 02:19:57'),
(9, 'jimmybottle', '$2y$10$XdDNZ86NsUXFjo623.F9BeUCrgDEg6qVDTlrVg4ZLWR4EfEooFw6W', '100001010000000', '100000100000010', '100010000010000', 'Jimmy Bottle', 1, '2020-12-15 02:20:56'),
(10, 'jlandry', '$2y$10$jAMe4.rW82hGvXmjGZk9XOJL2TMX9.w.wIiWEVbyC3uZOB1zs.pIq', '1010000001', '1000100000100', '11000100000', 'Jarvis Landry', 1, '2020-12-15 02:22:45'),
(11, 'georgekittle', '$2y$10$xOQ5LY0.tD5HksSqlQi5LOE4jUev1GHw1HxmeH5autvwnlDlvutLK', '1000000010001', '10000000100010', '110000100000000', 'George Kittle', 1, '2020-12-15 02:28:28'),
(12, 'bobbytaro', '$2y$10$N/eUxMhCgezQT2aFnTvsAuMccgMOUs47qa0esyQQHq8.iW.p4g61m', '10110', '1000101000', '10100000001', 'Bobby Taro', 1, '2020-12-15 02:30:13'),
(13, 'bigtruss', '$2y$10$UHk6nzZM886qvBYUw7OR/.ELb3abdh2PgTryDk27zInyEfg5RTBRy', '100100001000', '100000100100000', '10000011000', 'Lamar Jackson', 1, '2020-12-15 02:31:24'),
(14, 'raheemm', '$2y$10$YFQDB5R3ZtAoSYQnbCQubONdn5cVWCYjWdQ8s1DiR9w6eIQpsIddC', '1000000001010', '10000011000000', '1000000000011', 'Raheem Mostert', 1, '2020-12-15 02:33:28'),
(15, 'roopamjain', '$2y$10$DxfQjYva0s0BVR8xWauREerzh.ykHR4Xz8r7IzdsUQepLXCQXWHh.', '100000001000001', '1000010000010', '100000001001000', 'Roopam Jain', 1, '2020-12-16 23:49:46'),
(16, 'adsfmanylol', '$2y$10$zLpvMdpRo7CNlfgxeSguBOzOaFLDCDc9.mdXC.yZkPyG90MUM0K/2', '1010000100', '1100001000000', '101010000000000', 'ASDF Man', 1, '2020-12-17 05:02:39'),
(17, 'pnagwekar', '$2y$10$UctHPX7HCeZ77WstGIp0oe8QDJCNmzA13I5vSef0Q5q2gCA6d.mJW', '100000000101000', '100000010100', '10000001001000', 'Parag Nagwekar', 1, '2020-12-17 23:07:31');

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
-- Table structure for table `passwords`
--

CREATE TABLE `passwords` (
  `id` int(11) UNSIGNED NOT NULL,
  `account` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `host` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passwords`
--

INSERT INTO `passwords` (`id`, `account`, `link`, `host`, `username`, `password`) VALUES
(4, 'anshnagwekar', 'https://mail.google.com/mail/u/0/#', 'Gmail', 'ansh.nagwekar', 'Goalz(C!)PkBw'),
(5, 'anshnagwekar', 'https://powerschool.bcp.org/guardian/home.html', 'Powerschool', 'anshnagwekar', 'KNuGjzd3It@HU'),
(6, 'anshnagwekar', 'https://www.apple.com/', 'Apple', 'anshnagwekar123', 'ir!fzOFZ$OLGw'),
(7, 'pnagwekar', 'https://mail.google.com/mail/u/0/', 'Gmail', 'pnagwekar', 'th6BE7Wk40$la');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `passwords`
--
ALTER TABLE `passwords`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `passwords`
--
ALTER TABLE `passwords`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
