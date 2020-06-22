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
-- テーブルの構造 `gl_kakendb_anbunzumi`
--

CREATE TABLE IF NOT EXISTS `gl_kakendb_anbunzumi` (
  `kensuukingaku_id` int(11) NOT NULL,
  `awardNumber` varchar(255) NOT NULL,
  `kei` varchar(255) NOT NULL,
  `bunya` varchar(255) NOT NULL,
  `bunka` varchar(255) NOT NULL,
  `saimoku` varchar(255) NOT NULL,
  `kensuu` float NOT NULL,
  `directcost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gl_kakendb_anbunzumi`
--
ALTER TABLE `gl_kakendb_anbunzumi`
  ADD PRIMARY KEY (`kensuukingaku_id`),
  ADD KEY `awardNumber` (`awardNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gl_kakendb_anbunzumi`
--
ALTER TABLE `gl_kakendb_anbunzumi`
  MODIFY `kensuukingaku_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
