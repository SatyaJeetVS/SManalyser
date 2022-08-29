-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2022 at 05:10 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `camp`
--

CREATE TABLE `camp` (
  `url` longtext NOT NULL,
  `caption` longtext NOT NULL,
  `id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `camp`
--

INSERT INTO `camp` (`url`, `caption`, `id`) VALUES
('http://justinstolpe.com/sandbox/ig_publish_content_img.png', '#Programming, #programmer, #programmerlife, #coding, #coder, #webdevelopment, #developer, #100daysofcode, #python, #javascript, #programmingmemes, #softwaredeveloper, #Softwaredevelopment, #backenddeveloper', 11),
('http://justinstolpe.com/sandbox/ig_publish_content_img.png', 'demo caption', 12),
('http://justinstolpe.com/sandbox/ig_publish_content_img.png', 'demo caption', 13);

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `user_id` varchar(200) NOT NULL,
  `followers` int(20) NOT NULL,
  `date` date DEFAULT NULL,
  `impressions` int(50) NOT NULL,
  `reach` int(50) NOT NULL,
  `profile_views` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`user_id`, `followers`, `date`, `impressions`, `reach`, `profile_views`) VALUES
('17841450822510905', 2, '2021-01-31', 12, 15, 3),
('17841450822510905', 10, '2021-02-28', 20, 30, 50),
('17841450822510905', 20, '2021-03-31', 30, 40, 125);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `instaid` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `accesstoken` longtext NOT NULL,
  `pageid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`instaid`, `username`, `accesstoken`, `pageid`) VALUES
(17841450822510905, 'majorproject2022', 'EAAIk1s76jfIBANpGGFrAlqcv6xbWjhe01CNLmGYYYSdRxCoDNlwlZBTCd6LeLsYTIewaMfYnmk16tgo85FeZCE5y2k5GKNORMBScC3YFYZArk6PNYTg2ltVPCWMoPh3otqlyIHZBkdX2KlUyd2Q5rr7YAv6BnjEZCQSVVjb8HBTAybdxMxW81', 107281098493437);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `camp`
--
ALTER TABLE `camp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`instaid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `pageid` (`pageid`),
  ADD UNIQUE KEY `accesstoken` (`accesstoken`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `camp`
--
ALTER TABLE `camp`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
