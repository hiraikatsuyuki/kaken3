-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2020 年 6 月 22 日 10:25
-- サーバのバージョン： 5.5.65-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbadmin`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gl_kakendb`
--

CREATE TABLE IF NOT EXISTS `gl_kakendb` (
  `awardNumber` varchar(255) NOT NULL,
  `start_fy` int(11) NOT NULL,
  `end_fy` int(11) NOT NULL,
  `kenkyuusha_id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `section` varchar(255) DEFAULT NULL,
  `institutioncode` int(11) NOT NULL,
  `institution` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gl_kakendb`
--
ALTER TABLE `gl_kakendb`
  ADD PRIMARY KEY (`awardNumber`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
