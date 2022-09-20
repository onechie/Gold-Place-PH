-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2022 at 11:13 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newgoldplaceph`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verified` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `phone`, `password`, `verified`) VALUES
(45, 'angelo', 'parole', 'admin@test.com', '09812382838', '$2y$10$DMYxS2iuadDOXghnyZo7ouPHulDWeKmp0wWpwYUxA/zblW/WRokqy', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `verify`
--

CREATE TABLE `verify` (
  `code` varchar(255) NOT NULL,
  `user_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verify`
--

INSERT INTO `verify` (`code`, `user_id`) VALUES
('$2y$10$su1u264qW0UTM1LhBK5dY.PzxhdSWOMNW24aIifMorOkPjEuBrNba', 36),
('$2y$10$q.WeVv/Bgs5CQqJbIu9X2.Ux9y.muQE5nFuEmNBlw6DUjrZdR3FCa', 37),
('$2y$10$qIfaua5cxPRCgSvSuV/Ot.XBmqvdD7o3PgeIg23KB1XWGys7x7iDe', 38),
('$2y$10$thtoALxMf5tq6eyrz7DyPOsXVtMd9nDdAxaT/TBU0nnkLYdWdcVtK', 39),
('$2y$10$wKThQn1XXEhhF719f7b98u6f3MbtgqauRiz.76WvG8z6iV.T/JvIu', 40),
('$2y$10$QvJgQFyOiYHwiYSHih1Pj.Zuva1qI4NUS8f5W6WDFiC1JfP1UA5sG', 41),
('$2y$10$QRCXz8ynDQaYg1iXMkmZDecKmZjMQqZA9tbwSPqI/EZ0cghACYka6', 42),
('$2y$10$TYwiGciXV0yGhP1dxqwNsOWKQOYesZKKNLcsra8GVsg2RWkykIw2G', 43),
('$2y$10$a6sAJfd.9bcX126kih6cnOgaWK9LWmC/BeCyuqcuKACpThAsiuyo6', 44),
('$2y$10$0KFmOzBdyV/i3E8TY256ZeJfptUbdpPrS5we2usMzurNov4eSvVE6', 45);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
