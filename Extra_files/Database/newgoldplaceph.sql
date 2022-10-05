-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2022 at 09:26 AM
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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `item_id`, `user_id`, `quantity`) VALUES
(96, 17, 45, 1),
(97, 24, 45, 1),
(98, 37, 45, 1),
(99, 38, 45, 1),
(100, 39, 45, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `stocks` int(11) NOT NULL,
  `description` text NOT NULL,
  `sold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `category`, `price`, `stocks`, `description`, `sold`) VALUES
(17, 'Test Item Number 0', 'Ring', 1, 1, '1', 1),
(24, 'Test Item 0', 'Ring', 1, 1, '1', 2),
(25, 'a', 'Ring', 1, 1, '1', 3),
(27, 'c', 'Necklace', 1, 1, '1', 0),
(28, '2', 'Necklace', 2, 2, '2', 0),
(29, '3', 'Ring', 3, 3, '3', 0),
(30, '4', 'Necklace', 4, 4, '4', 0),
(31, 'a', 'Pendant', 5, 5, '5', 0),
(32, 'd', 'Earring', 6, 6, '6', 0),
(33, 'e', 'Pendant', 7, 7, '7', 0),
(34, '100', 'Necklace', 3999, 100, '100', 0),
(35, '200', 'Pendant', 3500, 99, 'test', 0),
(36, 'f', 'Necklace', 3500, 50, 'f', 0),
(37, 'Test Item Number 1', 'Ring', 3999, 100, 'This is item', 0),
(38, 'Test Item Number 2', 'Pendant', 3500, 99, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quam lacus suspendisse faucibus interdum posuere lorem ipsum. Tincidunt id aliquet risus feugiat in ante metus dictum at. In vitae turpis massa sed elementum. Amet venenatis urna cursus eget. Vitae congue eu consequat ac. Integer enim neque volutpat ac tincidunt vitae semper quis. Tempus iaculis urna id volutpat lacus laoreet. Vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Rhoncus mattis rhoncus urna neque viverra justo. Semper feugiat nibh sed pulvinar proin gravida hendrerit. Donec enim diam vulputate ut pharetra sit amet aliquam id. Tincidunt augue interdum velit euismod in.\r\n\r\nTurpis massa sed elementum tempus. Vestibulum lorem sed risus ultricies tristique nulla aliquet enim. Dignissim enim sit amet venenatis urna cursus eget. Sit amet dictum sit amet justo donec enim diam. Tempor id eu nisl nunc. Aliquet sagittis id consectetur purus ut faucibus. Facilisis mauris sit amet massa vitae. Congue eu consequat ac felis donec et. Fermentum posuere urna nec tincidunt. Sit amet porttitor eget dolor. Libero id faucibus nisl tincidunt eget nullam non nisi. Tortor consequat id porta nibh. Nascetur ridiculus mus mauris vitae ultricies leo integer malesuada. Non curabitur gravida arcu ac tortor dignissim convallis. Nibh sit amet commodo nulla facilisi. Eu mi bibendum neque egestas congue quisque egestas. Vel pharetra vel turpis nunc eget lorem dolor.', 0),
(39, 'Item test number 3', 'Necklace', 3500, 99, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Posuere morbi leo urna molestie at elementum eu facilisis sed. Vel eros donec ac odio. Sit amet nisl suscipit adipiscing bibendum. Et egestas quis ipsum suspendisse ultrices gravida dictum fusce ut. Mattis pellentesque id nibh tortor id aliquet lectus proin nibh. Sed sed risus pretium quam. Natoque penatibus et magnis dis parturient montes nascetur. Donec massa sapien faucibus et molestie ac. Ornare arcu odio ut sem. Amet consectetur adipiscing elit ut aliquam purus sit amet luctus. Viverra aliquet eget sit amet tellus. Vulputate ut pharetra sit amet aliquam id diam maecenas ultricies. Tempor commodo ullamcorper a lacus vestibulum sed arcu. Nibh praesent tristique magna sit amet purus. Sit amet tellus cras adipiscing enim. Orci porta non pulvinar neque laoreet suspendisse interdum consectetur libero. Maecenas pharetra convallis posuere morbi leo urna molestie at. Pretium viverra suspendisse potenti nullam ac.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `item_id`, `quantity`, `status`) VALUES
(68, 45, 38, 1, 'checking'),
(69, 45, 39, 1, 'checking'),
(70, 45, 25, 1, 'checking'),
(71, 45, 27, 1, 'checking');

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
  `verified` varchar(10) NOT NULL,
  `type` varchar(255) NOT NULL,
  `purchased` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `phone`, `password`, `verified`, `type`, `purchased`) VALUES
(45, 'Admin', 'Tester', 'admin@test.com', '09812382838', '$2y$10$DMYxS2iuadDOXghnyZo7ouPHulDWeKmp0wWpwYUxA/zblW/WRokqy', 'yes', 'customer', 3),
(48, 'User00', 'Tester', 'tester@test.com', '09260295144', '$2y$10$hO98dr9z60gjoIry2bOHQO.O1Ez4yj0aC.Mt92ktnbzpOrX1mLEIK', 'yes', '', 0),
(49, 'User', 'Tester', 'user@test.com', '+639260295143', '$2y$10$iFgyGBx1vHd8Y7VGjHLh0u6u0miB.MSeJjJb.Fws3pLbWyQW7B6om', 'yes', 'customer', 0);

-- --------------------------------------------------------

--
-- Table structure for table `verify`
--

CREATE TABLE `verify` (
  `code` varchar(255) NOT NULL,
  `user_id` int(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verify`
--

INSERT INTO `verify` (`code`, `user_id`, `id`) VALUES
('$2y$10$2X.csUoUIHbqs0UyPdtAquQh94mS9pu6oEkEJlU6g/XwfUV0rN73S', 48, 13),
('$2y$10$uUAOICBZADiUKXz5VBQtSedxxyMhAqAnBjipN/WXitjC5lZZyn0Lu', 49, 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cart_user` (`user_id`),
  ADD KEY `fk_cart_item` (`item_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_item` (`item_id`),
  ADD KEY `fk_order_user` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verify`
--
ALTER TABLE `verify`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_verify_user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `verify`
--
ALTER TABLE `verify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `verify`
--
ALTER TABLE `verify`
  ADD CONSTRAINT `fk_verify_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
