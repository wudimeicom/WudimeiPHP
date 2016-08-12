-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-08-12 06:34:00
-- 服务器版本： 10.0.16-MariaDB-log
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wudimei_mvc`
--

-- --------------------------------------------------------

--
-- 表的结构 `w_blog`
--

CREATE TABLE `w_blog` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `w_blog`
--

INSERT INTO `w_blog` (`id`, `title`, `content`, `created_at`) VALUES
(1, 'ha ha 2', 'abc2', '2016-08-12 06:16:37'),
(2, 'test', 'test', '2016-04-22 13:27:00'),
(3, 'test2', 'test2', '2016-04-22 13:27:00'),
(4, 'test3', 'test3', '2016-04-22 13:27:00'),
(5, 'test4', 'test4', '2016-04-22 13:27:00'),
(6, 'test5', 'test5', '2016-04-22 13:27:00'),
(7, 'ha ha ', 'abc', '2016-04-30 16:02:02'),
(8, 'happy new year2', 'abc', '2016-04-30 16:02:04'),
(9, 'ha ha ', 'abc', '2016-04-30 16:02:14'),
(14, 'yang qing-rong', 'yang', '2016-05-09 03:06:22'),
(15, 'ha ha ', 'abc', '2016-05-14 13:44:43'),
(16, 'ha ha ', 'abc', '2016-05-24 17:11:18'),
(17, 'ha ha ', 'abc', '2016-08-06 08:39:18'),
(18, 'ha ha ', 'abc', '2016-08-06 09:54:47'),
(19, 'ha ha ', 'abc', '2016-08-08 03:25:35'),
(20, 'ha ha ', 'abc', '2016-08-08 03:31:24'),
(0, 'ha ha ', 'abc', '2016-08-12 06:16:15');

-- --------------------------------------------------------

--
-- 表的结构 `w_users`
--

CREATE TABLE `w_users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT ' ',
  `email` varchar(50) DEFAULT ' ',
  `password` varchar(60) DEFAULT ' ',
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `remember_token` varchar(62) NOT NULL DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `w_users`
--

INSERT INTO `w_users` (`id`, `username`, `email`, `password`, `type`, `created_at`, `remember_token`) VALUES
(2, 'yqr', 'admin@wudimei.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2016-08-10 00:00:00', '676e7323553fc8a9bb372c18f8ab221e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `w_users`
--
ALTER TABLE `w_users`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `w_users`
--
ALTER TABLE `w_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
