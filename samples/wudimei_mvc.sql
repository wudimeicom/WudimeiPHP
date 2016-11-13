-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-09-09 09:22:52
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
(1, 'ha ha 2', 'abc2', '2016-08-30 02:00:13'),
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
(0, 'ha ha ', 'abc', '2016-08-12 06:16:15'),
(0, 'ha ha ', 'abc', '2016-08-30 01:59:49');

-- --------------------------------------------------------

--
-- 表的结构 `w_settings`
--

CREATE TABLE `w_settings` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT ' ',
  `value` text NOT NULL,
  `label` varchar(50) NOT NULL DEFAULT ' ',
  `tip` varchar(255) NOT NULL DEFAULT ' ',
  `type` varchar(50) NOT NULL DEFAULT 'text',
  `properties` text,
  `setting_group_id` int(5) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `w_settings`
--

INSERT INTO `w_settings` (`id`, `name`, `value`, `label`, `tip`, `type`, `properties`, `setting_group_id`) VALUES
(1, 'SITE.NAME', '深圳市无敌美电子商务商行2', '公司名称', ' ', 'text', '{"default":"","size":50}', 1),
(2, 'SITE.ADDRESS', '广东省深圳市222', '地址', ' ', 'textarea', '{}', 1),
(4, 'SITE.ZIPCODE', '518100', '邮政编码', ' ', 'text', '{"default":""}', 1),
(8, 'SEO.KEYWORDS', '关键字1,关键字222', '关键字:', '用半角逗号隔开', 'textarea', '{"default":""}', 2),
(5, 'SITE.CELLPHONE', '13714715608', '手机', ' ', 'text', '{"default":""}', 1),
(6, 'SITE.FAX', '075500000000', '传真', ' ', 'text', '{"default":""}', 1),
(7, 'SITE.CONTACTMAN', '杨庆荣', '联系人', ' ', 'text', '{"default":""}', 1),
(9, 'SEO.DESCRIPTION', '描述，220个字符以内。22', '描述:', ' ', 'textarea', '{"default":""}', 2),
(10, 'SITE.URL_PREFIX', 'http://wudimeishop.anli.wudimei.com', '网址前缀', ' ', 'text', '{"default":""}', 1),
(11, 'LINKS.IMAGE_SIZE', '80,404', '首页友情链接图片的尺寸', '格式“宽,高”', 'text', '{"default":""}', 3),
(12, 'SITE.QQ', '290359552,杨庆荣\r\n214341,张', '网站首页QQ面板', '格式：“QQ号,昵称”，一行一个。', 'textarea', '{"default":""}', 1),
(13, 'MAIL.TYPE', 'mail', '邮件发送方式', ' ', 'radios', '{"default":""}', 4),
(14, 'MAIL.SMTP_SSL', 'no', '是否使用ssl', ' ', 'radios', '{\r\n  "default":"no", \r\n  "options": \r\n   [ \r\n     {"value": "yes" ,"text":"setting.Yes"},\r\n     {"value": "no" ,"text":"setting.No"} \r\n   ] \r\n}', 4),
(15, 'MAIL.SMTP_HOST', 'smtp.gmail.com', 'SMTP主机名或IP', ' ', 'text', '{"default":""}', 4),
(16, 'MAIL.SMTP_PORT', '465', 'SMTP主机端口', '一般是25,ssl的是465...', 'text', '{"default":""}', 4),
(17, 'MAIL.SMTP_USERNAME', 'fsdaf', 'SMTP用户名', '有的要求要加上@***.com的后缀', 'text', '{"default":""}', 4),
(18, 'MAIL.SMTP_PASSWORD', 'f', 'SMTP密码', ' ', 'password', '{"default":""}', 4),
(19, 'MAIL.SMTP_FROM', '', 'SMTP发件人邮箱', '一般要和用户名相同', 'text', '{"default":""}', 4),
(20, 'MAIL.SMTP_DEBUG', 'no', 'SMTP调试', '开发环境时可开启，部署后建议关闭', 'radios', '{"default":""}', 4),
(23, 'GUESTBOOK.REJECT_BAD_WORDS', 'yes', '拒绝接受包含敏感词的留言', '关闭则什么都可以提交', 'radios', '{"default":""}', 5),
(21, 'GUESTBOOK.ENABLE_EMAIL_NOTIFICATION', 'yes', '收到留言自动邮件通知', ' ', 'radios', '{"default":""}', 5),
(22, 'FILTER.BAD_WORDS', '法轮功,法轮大法,色情,赌博,六合彩', '敏感词关键字', '用半角逗号“,”隔开', 'textarea', '{"default":""}', 6),
(24, 'GUESTBOOK.RECEIVER_EMAIL', 'yaqy@qq.com', '留言提醒的接收邮箱', ' ', 'text', '{"default":""}', 5),
(25, 'ORDER.ENABLE_NOTIFYING_ADMIN', 'no', '有订单通知员工', ' ', 'radios', '{"default":""}', 7),
(26, 'ORDER.EMAILS_FOR_NOTIFICATION', 'yaqy@qq.com,290359552@qq.com', '管理员的电子邮件', '多个请用半角逗号“,”隔开', 'textarea', '{"default":""}', 7),
(30, 'admin.email', '****@wudimei.com', 'Administrator\'s email', 'please enter an email address', 'text', '{"default":"","size":50}', 3),
(27, 'hobbies3', 'ridding', '爱好', '爱好', 'select', '{\r\n  "default": ["eat","drink"],\r\n  "options" :[\r\n   {"value" : "eat", "text":"eat Food"},\r\n   {"value": "drink", "text": "drunk"},\r\n   {"value": "ridding", "text": "setting.ridding"}\r\n  ]\r\n}', 0),
(28, 'hobbies', 'eat,drink,ridding', '爱好', '爱好', 'checkboxes', '{\r\n  "default": ["eat","drink"],\r\n  "options" :[\r\n   {"value" : "eat", "text":"eat Food"},\r\n   {"value": "drink", "text": "drunk"},\r\n   {"value": "ridding", "text": "setting.ridding"}\r\n  ]\r\n}', 0),
(29, 'hobbies4', 'drink,ridding', '爱好', '爱好', 'select', '{\r\n  "default": ["eat","drink"],\r\n  "multiple":"multiple",\r\n  "options" :[\r\n   {"value" : "eat", "text":"eat Food"},\r\n   {"value": "drink", "text": "drunk"},\r\n   {"value": "ridding", "text": "setting.ridding"}\r\n  ]\r\n}', 0),
(31, 'admin.email', '****@wudimei.com', 'Administrator\'s email', 'please enter an email address', 'text', '{"default":"","size":50}', 3),
(32, 'admin.email', '****@wudimei.com', 'Administrator\'s email', 'please enter an email address', 'text', '{"default":"","size":50}', 3);

-- --------------------------------------------------------

--
-- 表的结构 `w_setting_groups`
--

CREATE TABLE `w_setting_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `w_users`
--

CREATE TABLE `w_users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT ' ',
  `email` varchar(50) DEFAULT ' ',
  `password` varchar(60) DEFAULT ' ',
  `role_id` int(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `remember_token` varchar(62) NOT NULL DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `w_users`
--

INSERT INTO `w_users` (`id`, `username`, `email`, `password`, `role_id`, `created_at`, `remember_token`) VALUES
(2, 'yqr', 'admin@wudimei.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2016-08-10 00:00:00', '3f1f54a1295324ac4bc13d0c904acb68'),
(4, 'yqr2', 'yqr2@wudimei.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '0000-00-00 00:00:00', '651ac2b5d71fbd95cc12df8aa9738068');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `w_settings`
--
ALTER TABLE `w_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `w_setting_groups`
--
ALTER TABLE `w_setting_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `w_users`
--
ALTER TABLE `w_users`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `w_settings`
--
ALTER TABLE `w_settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- 使用表AUTO_INCREMENT `w_setting_groups`
--
ALTER TABLE `w_setting_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `w_users`
--
ALTER TABLE `w_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
