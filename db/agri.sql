-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2016 at 03:12 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `agri`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author` varchar(150) NOT NULL DEFAULT 'anonymous',
  `comment` text NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT '1',
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author`, `comment`, `visibility`, `date_posted`, `author_id`) VALUES
(1, 1, '', '', 1, '2015-12-21 13:38:04', 0),
(2, 1, 'anonymous', '', 1, '2016-01-25 14:11:27', 18),
(3, 1, 'anonymous', '', 1, '2016-02-11 10:09:21', 0),
(4, 6, 'anonymous', '', 1, '2016-03-03 11:57:33', 18),
(5, 6, 'anonymous', 'hehehe', 1, '2016-03-03 12:19:54', 18),
(6, 6, 'anonymous', 'vipy', 1, '2016-03-03 12:20:05', 18),
(7, 1, 'anonymous', 'oya oya, we ndio deree', 1, '2016-03-03 12:21:12', 18),
(8, 1, 'anonymous', 'hey low', 1, '2016-03-03 12:33:50', 18),
(9, 1, 'anonymous', 'niaje ninja', 1, '2016-03-03 12:48:08', 18),
(10, 3, 'anonymous', 'sql'' DELETE FROM users  '' injection my foot', 1, '2016-03-05 09:27:24', 18),
(11, 7, 'anonymous', 'what the hell', 1, '2016-03-09 14:44:34', 18),
(12, 6, 'anonymous', 'someguy here is talking to himself', 1, '2016-03-09 14:45:02', 18),
(13, 6, 'anonymous', 'and he wont stop :D :D :D', 1, '2016-03-09 14:45:19', 18),
(14, 6, 'anonymous', 'Kevin yoooh', 1, '2016-03-09 14:45:31', 18),
(15, 7, 'anonymous', 'i dont know', 1, '2016-03-10 12:30:59', 18),
(16, 6, 'anonymous', 'lap\r\n', 1, '2016-03-10 12:36:42', 18),
(17, 8, 'anonymous', 'niaje', 1, '2016-03-19 09:21:49', 0),
(18, 7, 'anonymous', 'look at you', 1, '2016-03-21 08:14:01', 18),
(19, 4, 'anonymous', 'wacha zako', 1, '2016-04-04 11:08:36', 0),
(20, 4, 'anonymous', 'hi ', 1, '2016-04-04 11:09:12', 0),
(21, 9, 'anonymous', 'hello', 1, '2016-04-12 07:24:19', 25);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `recepient` int(11) NOT NULL,
  `text` text NOT NULL,
  `read_status` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender`, `recepient`, `text`, `read_status`, `created`) VALUES
(6, 18, 20, 'hello mwangi', 0, '2016-03-01 15:23:58'),
(7, 18, 20, 'im good', 0, '2016-03-01 15:24:14'),
(8, 18, 22, 'Aje aje dan', 0, '2016-03-05 07:45:02'),
(9, 18, 22, 'heloo', 0, '2016-03-05 08:06:08'),
(10, 22, 18, 'gui', 0, '2016-03-05 08:06:25'),
(13, 19, 22, 'dan', 0, '2016-03-05 09:18:00'),
(14, 19, 18, 'hi kevin', 0, '2016-03-05 09:18:08'),
(15, 18, 19, 'sema', 0, '2016-03-07 15:25:49'),
(18, 23, 21, 'hi', 0, '2016-03-10 11:18:00'),
(19, 18, 23, 'hi', 0, '2016-03-10 12:30:16'),
(20, 18, 23, 'hi', 0, '2016-03-10 12:30:25'),
(21, 18, 23, 'hi sir', 0, '2016-03-10 12:48:59'),
(22, 18, 22, 'oya', 0, '2016-03-14 05:13:52'),
(23, 18, 22, 'daddf', 0, '2016-03-14 05:14:18'),
(24, 18, 22, 'dfsfd', 0, '2016-03-14 05:14:28'),
(25, 18, 22, 'hello', 0, '2016-03-14 05:16:07'),
(26, 18, 22, 'wassup', 0, '2016-03-14 05:16:14'),
(27, 18, 22, 'niaje ninja', 0, '2016-03-14 05:17:35'),
(28, 22, 18, 'ninja', 0, '2016-03-14 05:18:27'),
(29, 18, 22, 'unasemaje sasa', 0, '2016-03-14 05:19:10'),
(30, 19, 18, 'poa sana', 0, '2016-03-21 08:13:07'),
(32, 19, 18, 'heloo', 0, '2016-03-22 10:54:19'),
(33, 19, 18, 'buuda', 0, '2016-04-09 10:34:29'),
(34, 18, 19, 'niaje\n', 0, '2016-04-22 13:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(11) NOT NULL,
  `post` text NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT '1',
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post`, `visibility`, `date_posted`, `author_id`) VALUES
(1, 'hi fellas', 1, '2015-12-21 13:37:55', 0),
(2, 'new', 1, '2016-01-25 14:11:46', 18),
(3, '&lt;script&gt;alert(&quot;hey&quot;)&lt;/script&gt;', 1, '2016-02-16 06:17:29', 18),
(4, 'i wonder how guys did?', 1, '2016-03-01 08:44:08', 18),
(5, 'woridu men', 1, '2016-03-03 05:59:31', 18),
(6, 'yo guys', 1, '2016-03-03 06:02:50', 18),
(7, 'sdfsdf', 1, '2016-03-08 08:29:40', 19),
(8, 'hey guys', 1, '2016-03-19 09:21:40', 0),
(9, 'Hey guys', 1, '2016-03-22 10:58:06', 19);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `category` int(11) NOT NULL,
  `description` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `uploader` int(11) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `img_url` varchar(150) NOT NULL,
  `thumb_url` varchar(150) NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT '1',
  `status` enum('AVAILABLE','SOLD') NOT NULL DEFAULT 'AVAILABLE',
  `buyer` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `description`, `email`, `phone`, `uploader`, `date_posted`, `price`, `views`, `img_url`, `thumb_url`, `visibility`, `status`, `buyer`) VALUES
(1, 'Goat', 2, 'very very fat and juicy', 'dizkip@gmail.com', 70088, 18, '2015-10-31 15:14:47', 30000, 40, 'main_b0e8a526eca63fe2c31df13715b7b331642aa3eb1443021285.jpg', 'thumb_b0e8a526eca63fe2c31df13715b7b331642aa3eb1443021285.jpg', 1, 'SOLD', 18),
(2, 'Flowers', 1, 'Good stuff', '', 5433222, 18, '2016-02-11 18:11:15', 2000, 20, 'main_881181bf27ea8828c6d3e03dd73ad06841a5be961455214274.jpg', 'thumb_881181bf27ea8828c6d3e03dd73ad06841a5be961455214274.jpg', 1, 'SOLD', 18),
(3, 'Raspberry', 3, 'As juicy as it looks', 'dizkip@gmail.com', 40321, 18, '2016-02-11 18:14:27', 500, 8, 'main_c7e3ffb028e18b250d3a6700327cdbf2b4a3377c1455214466.jpg', 'thumb_c7e3ffb028e18b250d3a6700327cdbf2b4a3377c1455214466.jpg', 0, 'AVAILABLE', 0),
(4, 'Cow', 7, 'naaah', 'dis1@gmail.com', 72000, 18, '2016-03-01 15:41:38', 2000, 1, '', '', 0, 'AVAILABLE', 0),
(5, 'Sanjay and craig', 5, 'funny guys', 'dis1@gmail.com', 720052568, 18, '2016-03-02 06:28:59', 10000, 48, 'main_96e6d54ea333171ab3d7d18fd4c04d76275aa12c1456900139.png', 'thumb_96e6d54ea333171ab3d7d18fd4c04d76275aa12c1456900139.png', 1, 'SOLD', 18),
(6, 'Sanjay', 9, 'very cool', 'dismuskiplimo@gmail.com', 234242433, 18, '2016-04-22 12:47:43', 10000, 6, 'main_9115bb87febcc247d46ffec83b83782c931a2d901461329263.png', 'thumb_9115bb87febcc247d46ffec83b83782c931a2d901461329263.png', 1, 'AVAILABLE', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
`id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `category`) VALUES
(1, 'Electronics'),
(2, 'Animals');

-- --------------------------------------------------------

--
-- Table structure for table `product_sub_category`
--

CREATE TABLE IF NOT EXISTS `product_sub_category` (
`id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `sub_category` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_sub_category`
--

INSERT INTO `product_sub_category` (`id`, `category`, `sub_category`) VALUES
(4, 'Animals', 'Cows'),
(6, 'Animals', 'Dogs'),
(7, 'Animals', 'Cats'),
(8, 'Electronics', 'TV'),
(9, 'Electronics', 'Radio'),
(10, 'Electronics', 'Fridge');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `user_type` enum('STANDARD','ADMIN','','') NOT NULL DEFAULT 'STANDARD',
  `password` varchar(40) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gender` enum('M','F') NOT NULL DEFAULT 'M',
  `DOB` date NOT NULL,
  `about` text NOT NULL,
  `interests` text NOT NULL,
  `hometown` varchar(200) NOT NULL,
  `address` varchar(500) NOT NULL,
  `img_url` varchar(150) NOT NULL,
  `thumb_url` varchar(150) NOT NULL,
  `lastActiveTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `username`, `user_type`, `password`, `date_registered`, `gender`, `DOB`, `about`, `interests`, `hometown`, `address`, `img_url`, `thumb_url`, `lastActiveTime`) VALUES
(17, 'ADMIN KEVIN', 'MWANGI', 'dizkip@yahoo.com', 'admin', 'ADMIN', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2015-08-26 07:29:20', 'M', '0000-00-00', '', '', '', '', 'main_8f541ae0fd6c7f4e40614e6edf64c4baf722c3241443859241.png', 'thumb_8f541ae0fd6c7f4e40614e6edf64c4baf722c3241443859241.png', '2016-04-22 15:44:22'),
(18, 'Kevin', 'Migwe', 'dizkip@gmail.com', 'kevo', 'STANDARD', '31f650426844d11010c7b72dde7ad702b697a038', '2015-08-26 09:39:32', 'M', '1992-12-30', 'mi ni ngori babaa', 'everything', 'nairobi', 'Sunbeam House', 'main_96e6d54ea333171ab3d7d18fd4c04d76275aa12c1456983841.png', 'thumb_96e6d54ea333171ab3d7d18fd4c04d76275aa12c1456983841.png', '2016-04-22 16:12:51'),
(19, 'Judith', 'Koech', 'judy@gmail.com', 'judith', 'STANDARD', 'fcd1eee40b824e08506b5ff82781f775154ad51d', '2015-10-04 10:01:59', 'F', '0000-00-00', '', '', '', '', '', '', '2016-04-22 16:07:51'),
(20, 'mwangi', 'muthike', 'kevinmuthike@gmail.com', 'kevoh', 'STANDARD', 'e3184678fa4a9e76742ac5e2fc6a2a4ab619f79e', '2015-10-12 11:46:44', 'M', '0000-00-00', '', '', '', '', '', '', '2015-10-13 11:28:58'),
(21, 'dismus', 'kiplimo', 'disss@gmail.com', 'dddd', 'STANDARD', '01464e1616e3fdd5c60c0cc5516c1d1454cc4185', '2016-02-19 06:31:35', 'M', '0000-00-00', '', '', '', '', '', '', '2016-02-19 09:31:35'),
(22, 'Duncan', 'Muthami', 'dan@gmail.co', 'danny', 'STANDARD', 'df4bf92e16bbb7396c50d637f6b7ad9a4c8c274c', '2016-03-04 13:52:00', 'M', '0000-00-00', '', '', '', '', '', '', '2016-03-14 09:19:35'),
(23, 'Duncan', 'Muthami', 'celestineemer@gmail.com', 'Celestine', 'STANDARD', '88389deb80697f7f92ad89c12e20f787b10889ed', '2016-03-10 11:17:05', 'M', '0000-00-00', '', '', '', '', '', '', '2016-03-11 11:54:41'),
(24, 'Archie', 'Cruz', 'archiecruz@gmail.com', 'Black Archie', 'STANDARD', 'f23b3f70f3dd8408b1158d49d61bf96baf938532', '2016-04-10 14:22:22', 'M', '0000-00-00', '', '', '', '', '', '', '2016-04-10 17:22:59'),
(25, 'Geoffrey', 'Mariga', 'geoffrey@gmail.com', 'geoffrey', 'STANDARD', '4555c767d2a1136b6d405382a6ca850f4142117d', '2016-04-12 07:22:08', 'M', '0000-00-00', '', '', '', '', '', '', '2016-04-12 10:41:23'),
(26, 'kev', 'mwas', 'kevinmuthike.km@gmail.com', 'jose', 'STANDARD', '95b03ab28153972bdfd9e1b6b77692a200f9d2dd', '2016-04-22 12:59:03', 'M', '0000-00-00', '', '', '', '', '', '', '2016-04-22 16:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sub_category`
--
ALTER TABLE `product_sub_category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product_sub_category`
--
ALTER TABLE `product_sub_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
