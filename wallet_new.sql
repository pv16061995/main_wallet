-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 23, 2018 at 10:28 AM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 5.6.32-1+ubuntu16.04.1+deb.sury.org+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wallet_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin_login`
--

CREATE TABLE `Admin_login` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `sending_mail` varchar(100) NOT NULL,
  `sending_pass` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Admin_login`
--

INSERT INTO `Admin_login` (`id`, `name`, `email`, `username`, `password`, `sending_mail`, `sending_pass`, `status`, `created_on`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', '23d42f5f3f66498b2c8ff4c20b8c5ac826e47146', 'admin@gmail.com', '@prateek123', 1, '2018-01-19 15:05:56');

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `curr_id` int(11) NOT NULL,
  `curr_address` varchar(255) NOT NULL,
  `curr_bal` double(25,10) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`id`, `user_id`, `curr_id`, `curr_address`, `curr_bal`, `created_date`, `updated_date`) VALUES
(3, 1, 1, 'my3SXS6vnxKpPfjhGJWupPsZa4Lzao4xzo', 0.0000000000, '2018-01-13 15:03:05', '0000-00-00 00:00:00'),
(4, 1, 1, 'mj7J56jffGjqEfj7tiyKGnXD9nRj9FJVuC', 0.0000000000, '2018-01-13 15:03:32', '0000-00-00 00:00:00'),
(5, 1, 2, 'mpsdBLeYutuJ6cF2vUUTeFPM54t9SoYyae', 0.0000000000, '2018-01-13 16:02:57', '0000-00-00 00:00:00'),
(6, 1, 2, 'mtonCh9RDMEiby8FY8UVovCfGfowTHceST', 0.0000000000, '2018-01-13 16:04:11', '0000-00-00 00:00:00'),
(7, 1, 2, 'mgGJLT2SY7zErr7CXmwQ9MrxrcuVAYkBgu', 0.0000000000, '2018-01-13 16:04:55', '0000-00-00 00:00:00'),
(8, 1, 2, 'myFVV8WwJ6bQq8a8i8ynoyJB3wgUUnwsNz', 0.0000000000, '2018-01-13 16:05:59', '0000-00-00 00:00:00'),
(9, 1, 5, 'muv9EqtaBxeghRqbBM6MD6b1GEaKfHhRkQ', 0.0000000000, '2018-01-15 18:16:12', '0000-00-00 00:00:00'),
(10, 1, 1, 'mpaBLpjHVaUqJEWoUtQueRGTWHNV7gwYGF', 0.0000000000, '2018-01-17 15:57:10', '0000-00-00 00:00:00'),
(11, 2, 1, 'mn5ESYT5ytsHtexgXU75hD4AQQs31keRP7', 0.0000000000, '2018-01-17 16:20:20', '0000-00-00 00:00:00'),
(12, 15, 1, 'muXdcSD5cQbWBdz5JVwokNiRPKFYWQXiPV', 0.0000000000, '2018-01-17 16:21:13', '0000-00-00 00:00:00'),
(13, 15, 1, 'mtWYjEeakZCJ2giE1bBdfCWYyY9bnziCoc', 0.0000000000, '2018-01-17 16:21:48', '0000-00-00 00:00:00'),
(14, 15, 1, 'mjScdraRifdetHSXz6ePtXgfRSrFDfSfxT', 0.0000000000, '2018-01-17 16:25:20', '0000-00-00 00:00:00'),
(15, 15, 1, 'mv4AzGLD71JBbW2fZZScZrq33JJ82M8E9U', 0.0000000000, '2018-01-17 16:27:18', '0000-00-00 00:00:00'),
(16, 15, 1, 'mhf7mip1eBmtJ8sZFVRJyLkrkqwb8nNLrb', 0.0000000000, '2018-01-17 16:31:14', '0000-00-00 00:00:00'),
(17, 2, 1, 'miZhCqfLQFpZQ7pxfHtczKj3ArGaETHHnF', 0.0000000000, '2018-01-18 11:36:51', '0000-00-00 00:00:00'),
(18, 2, 1, 'mfetUnDVfQz5THYFH9b3KCo6M8PU5YhAvV', 0.0000000000, '2018-01-18 11:39:56', '0000-00-00 00:00:00'),
(19, 25, 1, 'mkqonbLqSmsdRufrj8Gt3sWQi3XAg9wijk', 0.0000000000, '2018-01-18 13:20:46', '0000-00-00 00:00:00'),
(20, 25, 1, 'min4v6MDGN1TL9U3rDRVGbdgxUKgo4kJuS', 0.0000000000, '2018-01-18 13:20:57', '0000-00-00 00:00:00'),
(21, 25, 1, 'mqknFvEtafF5yFLNTcb4L8aFCeCAshajwk', 0.0000000000, '2018-01-18 13:21:01', '0000-00-00 00:00:00'),
(22, 29, 5, 'mySohLS2jr7SSjTBhYnCPeyxamG37gSaGf', 0.0000000000, '2018-01-18 15:50:49', '0000-00-00 00:00:00'),
(23, 29, 5, 'n4dbf2WPRFBuhPMb9YtxPmpMr2aA3D2zxs', 0.0000000000, '2018-01-18 15:50:52', '0000-00-00 00:00:00'),
(24, 29, 5, 'n2zj8fexWiEPLyC5ZAnZ9JPgtnJ4wE2pNv', 0.0000000000, '2018-01-18 15:50:54', '0000-00-00 00:00:00'),
(25, 29, 5, 'n1FgwDtiYJYADfxdVN4J32hg3UsMBQLEaR', 0.0000000000, '2018-01-18 15:50:56', '0000-00-00 00:00:00'),
(26, 25, 1, 'mqmewkGjMPqTUXcgr43LfZVXnFqqsTtr6J', 0.0000000000, '2018-01-18 16:17:01', '0000-00-00 00:00:00'),
(27, 2, 5, 'miZ8vkbrEtb9NLQEcahtjtxfP41Nbt5Wzi', 0.0000000000, '2018-01-18 17:05:55', '0000-00-00 00:00:00'),
(28, 25, 5, 'mzavMb3mB7BPGZ4J5ky4qmdg9ttDRqPT3c', 0.0000000000, '2018-01-18 18:04:09', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `currency_list`
--

CREATE TABLE `currency_list` (
  `id` int(11) NOT NULL,
  `short_name` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `host` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `port` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency_list`
--

INSERT INTO `currency_list` (`id`, `short_name`, `name`, `host`, `user`, `pass`, `port`, `status`) VALUES
(1, 'BTC', 'Bitcoin', '198.187.28.202', 'bitcoin123', 'bitcoin@123', '8332', 0),
(2, 'LTC', 'LiteCoin', '162.213.252.66', 'test', 'test123', '18332', 1),
(3, 'INR', 'Indian Rupee', '162.213.252.66', 'test', 'test123', '18332', 1),
(4, 'Aux', 'American', '162.213.252.66', 'test', 'test123', '18332', 0),
(5, 'VCN', 'V-Coin', '198.187.28.202', 'VisionCoinrpc', '8yWJ4dpYprAoKz', '7034', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fee_charges`
--

CREATE TABLE `fee_charges` (
  `id` int(11) NOT NULL,
  `min_amt` int(11) NOT NULL,
  `max_amt` int(11) NOT NULL,
  `charge` double(25,10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_charges`
--

INSERT INTO `fee_charges` (`id`, `min_amt`, `max_amt`, `charge`) VALUES
(1, 0, 100, 0.0010000000),
(2, 101, 1000, 0.0500000000),
(3, 1001, 100000, 0.1000000000);

-- --------------------------------------------------------

--
-- Table structure for table `login_detail`
--

CREATE TABLE `login_detail` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_detail`
--

INSERT INTO `login_detail` (`id`, `user_id`, `ip_address`, `created_date`) VALUES
(1, 1, '::1', '2018-01-15 15:48:15'),
(2, 1, '::1', '2018-01-15 16:00:14'),
(3, 1, '::1', '2018-01-15 16:06:37'),
(4, 1, '::1', '2018-01-15 16:07:16'),
(5, 1, '::1', '2018-01-15 16:37:05'),
(6, 1, '::1', '2018-01-15 18:04:01'),
(7, 1, '::1', '2018-01-15 21:25:42'),
(8, 1, '::1', '2018-01-15 22:59:18'),
(9, 1, '::1', '2018-01-16 10:23:39'),
(10, 1, '::1', '2018-01-16 10:51:52'),
(11, 1, '::1', '2018-01-16 11:33:57'),
(12, 1, '::1', '2018-01-16 12:43:52'),
(13, 1, '::1', '2018-01-16 22:21:05'),
(14, 1, '::1', '2018-01-17 10:47:54'),
(15, 1, '192.168.1.18', '2018-01-17 11:07:36'),
(16, 2, '192.168.1.12', '2018-01-17 11:42:59'),
(17, 2, '192.168.1.12', '2018-01-17 11:44:14'),
(18, 2, '192.168.1.12', '2018-01-17 11:55:17'),
(19, 1, '192.168.1.18', '2018-01-17 11:56:11'),
(20, 1, '192.168.1.18', '2018-01-17 12:27:57'),
(21, 1, '192.168.1.18', '2018-01-17 12:28:14'),
(22, 1, '192.168.1.18', '2018-01-17 12:30:16'),
(23, 1, '192.168.1.18', '2018-01-17 12:30:43'),
(24, 1, '192.168.1.18', '2018-01-17 12:33:24'),
(25, 14, '192.168.1.13', '2018-01-17 12:38:07'),
(26, 14, '192.168.1.13', '2018-01-17 12:38:39'),
(27, 1, '192.168.1.18', '2018-01-17 12:48:39'),
(28, 14, '192.168.1.13', '2018-01-17 12:50:49'),
(29, 14, '192.168.1.13', '2018-01-17 12:52:33'),
(30, 14, '192.168.1.13', '2018-01-17 12:58:08'),
(31, 2, '192.168.1.12', '2018-01-17 12:59:20'),
(32, 2, '192.168.1.12', '2018-01-17 13:02:31'),
(33, 14, '192.168.1.13', '2018-01-17 13:03:19'),
(34, 2, '192.168.1.12', '2018-01-17 13:05:05'),
(35, 1, '192.168.1.18', '2018-01-17 13:08:10'),
(36, 1, '192.168.1.18', '2018-01-17 13:30:07'),
(37, 14, '192.168.1.13', '2018-01-17 13:33:57'),
(38, 2, '192.168.1.12', '2018-01-17 13:34:57'),
(39, 14, '192.168.1.13', '2018-01-17 13:35:55'),
(40, 14, '192.168.1.13', '2018-01-17 13:36:09'),
(41, 14, '192.168.1.13', '2018-01-17 13:36:35'),
(42, 14, '192.168.1.13', '2018-01-17 13:37:55'),
(43, 2, '192.168.1.12', '2018-01-17 13:39:13'),
(44, 14, '192.168.1.13', '2018-01-17 13:41:12'),
(45, 2, '192.168.1.12', '2018-01-17 13:46:35'),
(46, 2, '192.168.1.12', '2018-01-17 13:47:11'),
(47, 2, '192.168.1.12', '2018-01-17 13:48:13'),
(48, 14, '192.168.1.13', '2018-01-17 13:52:06'),
(49, 14, '192.168.1.13', '2018-01-17 13:53:40'),
(50, 14, '192.168.1.13', '2018-01-17 13:58:13'),
(51, 1, '192.168.1.18', '2018-01-17 14:00:04'),
(52, 14, '192.168.1.13', '2018-01-17 15:20:56'),
(53, 14, '192.168.1.13', '2018-01-17 15:21:13'),
(54, 15, '192.168.1.13', '2018-01-17 15:42:59'),
(55, 1, '192.168.1.18', '2018-01-17 15:56:42'),
(56, 15, '192.168.1.13', '2018-01-17 16:07:31'),
(57, 15, '192.168.1.13', '2018-01-17 16:13:09'),
(58, 2, '192.168.1.12', '2018-01-17 16:13:28'),
(59, 15, '192.168.1.13', '2018-01-17 16:18:08'),
(60, 1, '192.168.1.12', '2018-01-17 16:28:46'),
(61, 15, '192.168.1.13', '2018-01-17 17:25:52'),
(62, 1, '192.168.1.13', '2018-01-17 17:38:30'),
(63, 2, '192.168.1.12', '2018-01-17 17:39:30'),
(64, 15, '192.168.1.13', '2018-01-17 18:10:52'),
(65, 1, '192.168.1.12', '2018-01-17 18:18:46'),
(66, 2, '192.168.1.12', '2018-01-17 18:26:00'),
(67, 1, '192.168.1.25', '2018-01-17 18:32:09'),
(68, 1, '192.168.1.18', '2018-01-17 18:32:47'),
(69, 1, '::1', '2018-01-17 20:47:31'),
(70, 1, '::1', '2018-01-17 21:20:48'),
(71, 1, '::1', '2018-01-17 21:28:08'),
(72, 1, '::1', '2018-01-17 22:54:59'),
(73, 1, '::1', '2018-01-18 10:38:59'),
(74, 2, '192.168.1.12', '2018-01-18 10:51:27'),
(75, 1, '192.168.1.18', '2018-01-18 11:03:53'),
(76, 2, '192.168.1.12', '2018-01-18 11:12:43'),
(77, 2, '192.168.1.12', '2018-01-18 11:32:31'),
(78, 25, '192.168.1.27', '2018-01-18 13:10:51'),
(79, 25, '192.168.1.27', '2018-01-18 13:53:18'),
(80, 1, '192.168.1.18', '2018-01-18 15:27:11'),
(81, 25, '192.168.1.27', '2018-01-18 15:41:41'),
(82, 29, '192.168.1.25', '2018-01-18 15:49:39'),
(83, 1, '192.168.1.18', '2018-01-18 15:50:41'),
(84, 25, '192.168.1.27', '2018-01-18 15:52:24'),
(85, 25, '192.168.1.27', '2018-01-18 15:52:58'),
(86, 25, '192.168.1.27', '2018-01-18 15:53:54'),
(87, 1, '192.168.1.25', '2018-01-18 15:53:56'),
(88, 1, '192.168.1.25', '2018-01-18 15:54:10'),
(89, 25, '192.168.1.27', '2018-01-18 16:08:37'),
(90, 2, '192.168.1.27', '2018-01-18 16:10:43'),
(91, 2, '192.168.1.27', '2018-01-18 17:02:44'),
(92, 1, '192.168.1.18', '2018-01-18 17:23:09'),
(93, 25, '192.168.1.27', '2018-01-18 17:31:36'),
(94, 25, '192.168.1.27', '2018-01-18 17:57:30'),
(95, 1, '::1', '2018-01-18 22:24:35'),
(96, 1, '::1', '2018-01-18 23:36:48'),
(97, 1, '::1', '2018-01-18 23:48:21'),
(98, 1, '::1', '2018-01-19 08:06:05'),
(99, 1, '::1', '2018-01-19 10:42:36'),
(100, 1, '::1', '2018-01-19 10:45:21'),
(101, 1, '::1', '2018-01-19 10:49:58'),
(102, 1, '::1', '2018-01-19 10:51:05'),
(103, 1, '::1', '2018-01-19 10:51:39'),
(104, 1, '::1', '2018-01-19 11:10:14'),
(105, 2, '192.168.1.9', '2018-01-19 13:13:09'),
(106, 2, '192.168.1.9', '2018-01-19 13:18:15'),
(107, 1, '192.168.1.18', '2018-01-19 18:13:20'),
(108, 1, '192.168.1.18', '2018-01-19 18:38:11'),
(109, 1, '::1', '2018-01-19 21:15:46'),
(110, 1, '::1', '2018-01-20 00:40:35'),
(111, 1, '::1', '2018-01-20 12:00:49'),
(112, 1, '::1', '2018-01-20 17:19:51'),
(113, 1, '::1', '2018-01-20 20:31:05'),
(114, 1, '::1', '2018-01-22 12:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `refer_user`
--

CREATE TABLE `refer_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `refer_id` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `refer_user`
--

INSERT INTO `refer_user` (`id`, `user_id`, `refer_id`, `email`, `status`, `created_date`) VALUES
(1, 1, '29664687040c7f2b74c02223395a8ffe', 'prateek@bloque.in', 0, '2018-01-22 14:17:47');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `txnid` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trans_address` varchar(100) NOT NULL,
  `amount` double(25,10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `txnid`, `user_id`, `trans_address`, `amount`, `status`, `created_date`, `updated_date`) VALUES
(1, '5d93ccaaedadcb30a922fbb9b5cbc497', 1, 'wertyuytre34567865432', 2.2000000000, 0, '2018-01-20 13:39:33', '0000-00-00 00:00:00'),
(2, '0c70a60cd42d9fc07a504b2fd885b7b3', 1, 'wertyjrew34567543', 1.2000000000, 0, '2018-01-20 13:39:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `pin` varchar(100) NOT NULL,
  `tfa_status` tinyint(4) NOT NULL DEFAULT '0',
  `otp` varchar(100) NOT NULL,
  `tfa_key` varchar(100) NOT NULL,
  `email_verify_status` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `kyc_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `ip_address`, `pin`, `tfa_status`, `otp`, `tfa_key`, `email_verify_status`, `status`, `kyc_status`, `created_date`, `updated_date`, `last_login`) VALUES
(1, 'Prateek Verma', 'pv16061995@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '::1', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, '729cf9137f21ea3de9f4866b632f1fd580051402', 'EKDLKGLR2UPCJOZG', 1, 1, 0, '2018-01-15 17:15:06', '0000-00-00 00:00:00', '2018-01-22 12:45:19'),
(2, 'Pooja', 'pooja591bagh@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '192.168.1.', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 'daac18cb967af899293366957ed2828273f10655', 'J4NALQFCBNJIQ4DY', 1, 1, 0, '2018-01-17 11:07:34', '0000-00-00 00:00:00', '2018-01-19 13:18:15'),
(3, '12245245325', 'nitupanjiyar@gmail.com', 'f43c785e3167800756a61418eff85fe3fe6a9b10', '192.168.1.', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, '', 'ESFI5W4IHO327TZM', 1, 1, 0, '2018-01-17 11:22:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Pooja', 'poojabagh591@gmail.cox', '8cb2237d0679ca88db6464eac60da96345513964', '192.168.1.', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, '', 'YIWWEPFND47VYGBF', 0, 0, 0, '2018-01-17 11:24:37', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'pooja', 'poojabagh591@gmail.hax', '8cb2237d0679ca88db6464eac60da96345513964', '192.168.1.', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, '', '7ND6WOLBXGWKZVB7', 0, 0, 0, '2018-01-17 11:28:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, '@#$%', 'nitupanjiyar12@gmail.com', 'cb39ff61051b165eed81e936524fb85dfbb12346', '192.168.1.', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, '', 'VOG42PQ2LOBAWKJB', 0, 0, 0, '2018-01-17 11:29:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'nits', 'nitupanjiyar295@gmail.com', 'cbc62ed3363ddc4dd7a34a06f583ebdd6e8daeec', '192.168.1.', '2c4b9ca4eaa1219ccb4c0e1c80d4cdeb73efdf23', 0, '', '3CB77WHAPLYUBQH7', 0, 0, 0, '2018-01-17 11:37:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'k3124', 'nitu&panjiyar23@gmail.com', 'cb39ff61051b165eed81e936524fb85dfbb12346', '192.168.1.', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, '', 'L6JHLE32XHVYQOY3', 0, 0, 0, '2018-01-17 12:21:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'hj7', '#nitu.pan@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '192.168.1.', '7ab515d12bd2cf431745511ac4ee13fed15ab578', 0, '', 'DEYRG7VMVZ37XR2I', 0, 0, 0, '2018-01-17 12:22:43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'n chdcb', '%$nitu@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '192.168.1.', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, '', 'E5TLYE7JQFF2FPET', 0, 0, 0, '2018-01-17 12:24:56', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'iofrhje', '$%nitu@gmail.com', '416f8f6e105370e7b9d0fd983141f00b613477f8', '192.168.1.', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, '', 'BN76OVANBHQBO2XQ', 0, 0, 0, '2018-01-17 12:25:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'iofrhje', 'NITUpqn@gmail.com', 'cb39ff61051b165eed81e936524fb85dfbb12346', '192.168.1.', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, '', '55KM2SV4U7OXMFLU', 0, 0, 0, '2018-01-17 12:30:31', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'nitu', 'nitu.pan23@gmail.com', 'd3cbe1c1010fc8128ef105ffcf9ffa7577ed2fa8', '192.168.1.', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, '', 'R3IP4WGPPBPQ2DCB', 0, 0, 0, '2018-01-17 12:34:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, '123456', 'nitu.panjiyar23@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '192.168.1.13', '5dd4ebdac62609c834f7768f02286b798bd82a38', 0, '', '57ERWA3SXK6N7Q4K', 1, 1, 0, '2018-01-17 15:41:10', '0000-00-00 00:00:00', '2018-01-17 18:10:52'),
(16, '1234', 'nhhgvtgc@gmail.com', 'a19549e4bed474b8091839e4bcccae0efa73320a', '192.168.1.13', '9f537aeb751ec72605f57f94a2f6dc3e3958e1dd', 0, '', 'RWBQDGYAFZJXWGCU', 0, 0, 0, '2018-01-17 16:14:02', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'dxwqwa', 'vffredbtf@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '192.168.1.13', '7bf19a9019601fb268f31085e8c839567afb144e', 0, '', 'PASU7PSW4FDRPY3H', 0, 0, 0, '2018-01-17 16:15:41', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, '23456', '#$nitu@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '192.168.1.13', '5dd4ebdac62609c834f7768f02286b798bd82a38', 0, '', 'PTHU5JSMNGQKCQC5', 0, 0, 0, '2018-01-17 17:20:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'shikha bahal', '#$shikhabahal25@gmail.com', '4bbeb13c94796f9cdcf88c4a80468e424705ff07', '192.168.1.13', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, '', 'GPGCIIH4QHEJLUQI', 0, 0, 0, '2018-01-17 17:33:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'shikha', 'shikhabahal25@gmail.com', 'd8aa87b3a72eba79fe66a5e7f91391efe3b0395e', '192.168.1.25', 'd8aa87b3a72eba79fe66a5e7f91391efe3b0395e', 0, '69cc37b5c01653757b205c09dfe79073e106de7d', '5S6434TZ46DP3AM7', 0, 0, 0, '2018-01-17 18:28:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'weqe', 'dwd', '044326afbdb2d6bebd65920b82498c0f8554474c', '::1', '4b1de6c9d2103afa780d8aabc2ee1be4d0debe99', 0, '', '4VLPBTRAULIRF2ET', 0, 0, 0, '2018-01-17 23:08:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Pooja', 'poojabagh591@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '192.168.1.12', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, '', 'AH3INVQIPPBOHOUL', 0, 0, 0, '2018-01-18 11:19:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'sakshi', 'sakshi@gmail.comfjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '192.168.1.27', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 0, '', 'FK3THCTBKTMADHUM', 0, 0, 0, '2018-01-18 12:48:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'sakshi', 'sakshidubey5945@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '192.168.1.27', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 0, '6cb527cf513c9a39149d470a9be38bcaf1374dc6', 'BE7RLMANXMMJ5LVX', 1, 1, 0, '2018-01-18 12:59:17', '0000-00-00 00:00:00', '2018-01-18 17:57:30'),
(26, 'ahsdgashsgh', 'sakshi@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '192.168.1.27', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 0, '', 'M4PPUIEETD46CHJS', 0, 0, 0, '2018-01-18 13:05:31', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'priyanka', 'priyankagarg1112@gmail.com', '7b52009b64fd0a2a49e6d8a939753077792b0554', '192.168.1.25', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, 'a32a40dc88d22fd31700d83c5af747cf1b565039', 'DR7MSOVYZ7JB35UT', 0, 0, 0, '2018-01-18 13:30:29', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Shikha bahal', 'b.shikha@gmail.com', 'd8aa87b3a72eba79fe66a5e7f91391efe3b0395e', '192.168.1.21', 'd8aa87b3a72eba79fe66a5e7f91391efe3b0395e', 0, '', 'VHIE7OGKCK35TZQE', 0, 0, 0, '2018-01-18 13:42:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'shikha', 'b.shikha@blockon.tech', 'd8aa87b3a72eba79fe66a5e7f91391efe3b0395e', '192.168.1.25', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, '', '5RJ5VMTVBEE2IBEY', 1, 1, 0, '2018-01-18 15:48:55', '0000-00-00 00:00:00', '2018-01-18 15:49:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin_login`
--
ALTER TABLE `Admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_list`
--
ALTER TABLE `currency_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_charges`
--
ALTER TABLE `fee_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_detail`
--
ALTER TABLE `login_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refer_user`
--
ALTER TABLE `refer_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
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
-- AUTO_INCREMENT for table `Admin_login`
--
ALTER TABLE `Admin_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `balance`
--
ALTER TABLE `balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `currency_list`
--
ALTER TABLE `currency_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `fee_charges`
--
ALTER TABLE `fee_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `login_detail`
--
ALTER TABLE `login_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `refer_user`
--
ALTER TABLE `refer_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
