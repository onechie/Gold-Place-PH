-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2022 at 05:45 AM
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
  `quantity` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `item_id`, `user_id`, `quantity`, `date_created`, `date_updated`) VALUES
(247, 27, 90, 1, '2022-10-22 00:51:44', '0000-00-00 00:00:00'),
(248, 31, 90, 1, '2022-10-22 00:51:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `city_list`
--

CREATE TABLE `city_list` (
  `id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city_list`
--

INSERT INTO `city_list` (`id`, `city`) VALUES
(1, 'hagonoy'),
(2, 'malolos'),
(5, 'calumpit');

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
(17, 'Sienna\'s Bracelett', 'Necklace', 4000, 99, 'test\r\ntest\r\ntest new test', 1),
(24, 'Golden Ring of Luck', 'Ring', 3500, 99, 'test', 2),
(25, 'Necklace of Durance', 'Ring', 4500, 99, 'test', 3),
(27, 'Vampiric Earring', 'Earring', 3000, 99, 'test', 0),
(28, 'Blessed Cross Pendant', 'Pendant', 2000, 99, 'test', 0),
(29, 'Chain of Olympus Bracelet', 'Earring', 3500, 99, 'test', 0),
(30, 'Heart Ring of Critical', 'Ring', 3500, 99, 'test', 0),
(31, 'Dragon Necklace & Pendant ', 'Pendant', 5000, 99, 'test', 0),
(32, 'd', 'Earring', 6, 99, '6', 0),
(33, 'e', 'Pendant', 7, 99, '7', 0),
(34, '100', 'Necklace', 3999, 100, '100', 0),
(35, '200', 'Pendant', 3500, 99, 'test', 0),
(36, 'Test Item', 'Necklace', 3500, 50, 'f', 0),
(37, 'Test Item Number 1', 'Ring', 3999, 100, 'This is item', 0),
(38, 'Test Item Number 2', 'Pendant', 3500, 99, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quam lacus suspendisse faucibus interdum posuere lorem ipsum. Tincidunt id aliquet risus feugiat in ante metus dictum at. In vitae turpis massa sed elementum. Amet venenatis urna cursus eget. Vitae congue eu consequat ac. Integer enim neque volutpat ac tincidunt vitae semper quis. \n\nTempus iaculis urna id volutpat lacus laoreet. Vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Rhoncus mattis rhoncus urna neque viverra justo. Semper feugiat nibh sed pulvinar proin gravida hendrerit. Donec enim diam vulputate ut pharetra sit amet aliquam id. Tincidunt augue interdum velit euismod in.\n\nTurpis massa sed elementum tempus. Vestibulum lorem sed risus ultricies tristique nulla aliquet enim. Dignissim enim sit amet venenatis urna cursus eget. Sit amet dictum sit amet justo donec enim diam. Tempor id eu nisl nunc. Aliquet sagittis id consectetur purus ut faucibus. Facilisis mauris sit amet massa vitae. Congue eu consequat ac felis donec et. Fermentum posuere urna nec tincidunt. \n\nSit amet porttitor eget dolor. Libero id faucibus nisl tincidunt eget nullam non nisi. Tortor consequat id porta nibh. Nascetur ridiculus mus mauris vitae ultricies leo integer malesuada. Non curabitur gravida arcu ac tortor dignissim convallis. Nibh sit amet commodo nulla facilisi. Eu mi bibendum neque egestas congue quisque egestas. Vel pharetra vel turpis nunc eget lorem dolor.', 0),
(39, 'Item test number 3', 'Necklace', 3500, 99, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Posuere morbi leo urna molestie at elementum eu facilisis sed. Vel eros donec ac odio. Sit amet nisl suscipit adipiscing bibendum. Et egestas quis ipsum suspendisse ultrices gravida dictum fusce ut. \r\n\r\nMattis pellentesque id nibh tortor id aliquet lectus proin nibh. Sed sed risus pretium quam. Natoque penatibus et magnis dis parturient montes nascetur. Donec massa sapien faucibus et molestie ac. Ornare arcu odio ut sem. Amet consectetur adipiscing elit ut aliquam purus sit amet luctus. Viverra aliquet eget sit amet tellus. Vulputate ut pharetra sit amet aliquam id diam maecenas ultricies. Tempor commodo ullamcorper a lacus vestibulum sed arcu. Nibh praesent tristique magna sit amet purus. Sit amet tellus cras adipiscing enim. \r\n\r\nOrci porta non pulvinar neque laoreet suspendisse interdum consectetur libero. Maecenas pharetra convallis posuere morbi leo urna molestie at. Pretium viverra suspendisse potenti nullam ac.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `items` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `items`, `quantity`, `status`, `date_created`, `date_updated`) VALUES
(138, 45, 2, 0, 'checking', '2022-10-11 19:00:47', '0000-00-00 00:00:00'),
(139, 45, 4, 0, 'checking', '2022-10-11 19:00:57', '0000-00-00 00:00:00'),
(198, 48, 1, 0, 'checking', '2022-10-19 16:25:08', '0000-00-00 00:00:00'),
(199, 48, 1, 0, 'checking', '2022-10-19 16:25:15', '0000-00-00 00:00:00'),
(200, 48, 1, 0, 'delivered', '2022-10-19 16:29:11', '2022-10-19 16:33:10'),
(201, 48, 5, 0, 'delivered', '2022-10-19 16:34:14', '2022-10-19 20:01:20'),
(202, 90, 1, 0, 'checking', '2022-10-21 18:33:15', '0000-00-00 00:00:00'),
(203, 90, 1, 0, 'checking', '2022-10-22 00:33:15', '0000-00-00 00:00:00'),
(204, 90, 3, 0, 'checking', '2022-10-21 18:43:24', '0000-00-00 00:00:00'),
(205, 90, 3, 0, 'checking', '2022-10-22 00:43:24', '0000-00-00 00:00:00'),
(206, 90, 4, 0, 'checking', '2022-10-22 00:45:29', '0000-00-00 00:00:00'),
(207, 90, 4, 0, 'checking', '2022-10-22 00:45:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `can_rate` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `item_id`, `quantity`, `can_rate`) VALUES
(19, 138, 38, 5, ''),
(20, 138, 39, 5, ''),
(21, 139, 37, 10, ''),
(22, 139, 36, 5, ''),
(23, 139, 35, 10, ''),
(24, 139, 34, 5, ''),
(63, 198, 25, 5, 'no'),
(64, 199, 24, 5, 'no'),
(65, 200, 17, 99, 'no'),
(66, 201, 25, 1, 'yes'),
(67, 201, 24, 1, 'yes'),
(68, 201, 17, 1, 'yes'),
(69, 201, 27, 1, 'yes'),
(70, 201, 28, 1, 'yes'),
(71, 202, 24, 15, 'no'),
(72, 204, 25, 1, 'no'),
(73, 204, 24, 1, 'no'),
(74, 204, 17, 1, 'no'),
(75, 206, 25, 1, 'no'),
(76, 206, 24, 1, 'no'),
(77, 206, 17, 1, 'no'),
(78, 206, 27, 1, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `province_list`
--

CREATE TABLE `province_list` (
  `id` int(11) NOT NULL,
  `province` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `province_list`
--

INSERT INTO `province_list` (`id`, `province`) VALUES
(1, 'bulacan'),
(2, 'jupiter'),
(3, 'mars'),
(4, 'uranus');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `score` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `item_id`, `message`, `score`, `status`, `user_id`) VALUES
(9, 31, 'Test Comment', 4, '', 48),
(10, 31, 'Test Comment', 1, '', 48),
(11, 30, 'Test', 4, '', 48),
(12, 29, 'Test ratings comment . . . < > \" \' / ; :', 5, '', 48),
(13, 30, 'Test Comment 3 star', 3, '', 48),
(14, 28, 'Test Rating responsive', 5, '', 48),
(15, 24, 'Test rate', 4, '', 48),
(16, 17, 'Test Rating  1 star', 1, '', 48),
(17, 17, 'Test Rating  4 star', 4, '', 48),
(18, 27, 'Comment Test 3 star', 3, '', 73),
(19, 25, 'Test Comment 5 star', 5, '', 73),
(20, 25, 'Test Comment 5 star', 5, '', 73),
(22, 17, 'Test space\nnew line', 5, '', 48);

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
  `purchased` int(11) NOT NULL,
  `verification_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `phone`, `password`, `verified`, `type`, `purchased`, `verification_code`) VALUES
(45, 'Angelo', 'Tester', 'admin@test.com', '09260295144', '$2y$10$hO98dr9z60gjoIry2bOHQO.O1Ez4yj0aC.Mt92ktnbzpOrX1mLEIK', 'yes', 'admin', 5, ''),
(48, 'Test', 'Tester', 'tester@test.com', '09260295143', '$2y$10$hO98dr9z60gjoIry2bOHQO.O1Ez4yj0aC.Mt92ktnbzpOrX1mLEIK', 'yes', 'customer', 0, ''),
(49, 'Test', 'Tester', 'tester1@test.com', '09260295142', '$2y$10$hO98dr9z60gjoIry2bOHQO.O1Ez4yj0aC.Mt92ktnbzpOrX1mLEIK', 'yes', 'customer', 0, ''),
(73, 'angelo', 'parole', 'angelo.parole.c@bulsu.edu.ph', '09124742844', '$2y$10$I31ezs6hpy.AoZS5fbCHuuWyxyzSXsYoCnSLgMODPVvJQW4bVs6Eu', 'yes', 'customer', 0, ''),
(82, 'Angelo', 'Tester', 'superadmin@test.com', '09260295144', '$2y$10$hO98dr9z60gjoIry2bOHQO.O1Ez4yj0aC.Mt92ktnbzpOrX1mLEIK', 'yes', 'super_admin', 5, ''),
(90, 'angelo', 'parole', 'angeloparole23@gmail.com', '09124724747', '$2y$10$FlXpgE0CqyG9FxPYhEMkxe/1OWwyCT14FDF7fZ2EBPDXstcFx5RGi', 'yes', 'customer', 0, '$2y$10$KdTTZ//r.SHzP4h2lQA.J.Eu6KRTsVS0adUlyvaufHz7kyxA/UCwC');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `user_id` int(11) NOT NULL,
  `house_number` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`user_id`, `house_number`, `barangay`, `city`, `province`, `id`) VALUES
(45, '1234', 'palapa', 'malolos', 'jupiter', 1),
(49, '1234', 'palapa', 'malolos', 'jupiter', 2),
(48, '1234', 'palapa', 'malolos', 'jupiter', 3),
(73, '1234', 'palapa', 'malolos', 'jupiter', 4),
(90, '1234', 'palapat', 'malolos', 'jupiter', 5);

-- --------------------------------------------------------

--
-- Table structure for table `verify`
--

CREATE TABLE `verify` (
  `code` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_id` int(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verify`
--

INSERT INTO `verify` (`code`, `user_email`, `user_id`, `id`) VALUES
('$2y$10$2X.csUoUIHbqs0UyPdtAquQh94mS9pu6oEkEJlU6g/XwfUV0rN73S', '', 48, 13),
('$2y$10$uUAOICBZADiUKXz5VBQtSedxxyMhAqAnBjipN/WXitjC5lZZyn0Lu', '', 49, 14),
('$2y$10$UcWMN7VPwpjdC9gplrHk3OBe/I05i/.ABMGtnCHRUeaG10mUa4Fk.', 'angelo.parole.c@bulsu.edu.ph', 73, 26);

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
-- Indexes for table `city_list`
--
ALTER TABLE `city_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_oitem_item` (`item_id`),
  ADD KEY `fk_oitem_order` (`order_id`);

--
-- Indexes for table `province_list`
--
ALTER TABLE `province_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_address_uid` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT for table `city_list`
--
ALTER TABLE `city_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `province_list`
--
ALTER TABLE `province_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `verify`
--
ALTER TABLE `verify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `fk_oitem_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `fk_oitem_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `fk_address_uid` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
