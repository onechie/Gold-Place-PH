-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2022 at 10:00 AM
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
-- Table structure for table `barangay_list`
--

CREATE TABLE `barangay_list` (
  `id` int(11) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `shipping_fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barangay_list`
--

INSERT INTO `barangay_list` (`id`, `barangay`, `city`, `shipping_fee`) VALUES
(31, 'longos', 'malolos', 50),
(32, 'san vicente', 'malolos', 55),
(33, 'tikay', 'malolos', 60),
(34, 'talisay', 'balanga', 50),
(35, 'san jose', 'balanga', 55),
(36, 'munting batangas', 'balanga', 60),
(37, 'Alasas', 'san fernando', 50),
(38, 'dolores', 'san fernando', 55),
(39, 'panipuan', 'san fernando', 60);

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

-- --------------------------------------------------------

--
-- Table structure for table `city_list`
--

CREATE TABLE `city_list` (
  `id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `shipping_fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city_list`
--

INSERT INTO `city_list` (`id`, `city`, `province`, `shipping_fee`) VALUES
(39, 'balanga', 'bataan', 0),
(40, 'malolos', 'bulacan', 0),
(41, 'san fernando', 'pampanga', 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `stocks` int(11) NOT NULL,
  `description` text NOT NULL,
  `sold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `date_created`, `category`, `price`, `stocks`, `description`, `sold`) VALUES
(45, 'Ring of Critical ', '2022-11-16 17:21:18', 'Ring', 3999, 93, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Cursus in hac habitasse platea dictumst quisque. Volutpat maecenas volutpat blandit aliquam etiam erat velit. Est pellentesque elit ullamcorper dignissim cras tincidunt lobortis feugiat. Consectetur purus ut faucibus pulvinar elementum integer enim neque volutpat. Turpis egestas pretium aenean pharetra magna ac placerat. Libero volutpat sed cras ornare arcu dui. Neque volutpat ac tincidunt vitae semper quis lectus nulla. Amet nulla facilisi morbi tempus. Accumsan sit amet nulla facilisi morbi tempus. Tempus egestas sed sed risus pretium quam vulputate dignissim.\r\n\r\nPulvinar neque laoreet suspendisse interdum. Sem fringilla ut morbi tincidunt augue. Purus in massa tempor nec feugiat nisl pretium. Enim diam vulputate ut pharetra sit amet. Enim tortor at auctor urna nunc. Mauris augue neque gravida in fermentum et sollicitudin ac. Ipsum suspendisse ultrices gravida dictum fusce ut placerat. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae purus. Eu consequat ac felis donec et odio. Urna cursus eget nunc scelerisque viverra mauris. Cras pulvinar mattis nunc sed blandit libero volutpat. Scelerisque viverra mauris in aliquam sem fringilla ut morbi tincidunt. Eu nisl nunc mi ipsum faucibus. Mauris ultrices eros in cursus turpis massa tincidunt dui. In egestas erat imperdiet sed euismod nisi porta lorem. Quis varius quam quisque id diam vel quam. Bibendum neque egestas congue quisque egestas diam. Sed adipiscing diam donec adipiscing tristique risus.', 5),
(46, 'Ring of Luck', '2022-11-16 17:21:19', 'Ring', 5000, 94, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Cursus in hac habitasse platea dictumst quisque. Volutpat maecenas volutpat blandit aliquam etiam erat velit. Est pellentesque elit ullamcorper dignissim cras tincidunt lobortis feugiat. Consectetur purus ut faucibus pulvinar elementum integer enim neque volutpat. Turpis egestas pretium aenean pharetra magna ac placerat. Libero volutpat sed cras ornare arcu dui. Neque volutpat ac tincidunt vitae semper quis lectus nulla. Amet nulla facilisi morbi tempus. Accumsan sit amet nulla facilisi morbi tempus. Tempus egestas sed sed risus pretium quam vulputate dignissim.\r\n\r\nPulvinar neque laoreet suspendisse interdum. Sem fringilla ut morbi tincidunt augue. Purus in massa tempor nec feugiat nisl pretium. Enim diam vulputate ut pharetra sit amet. Enim tortor at auctor urna nunc. Mauris augue neque gravida in fermentum et sollicitudin ac. Ipsum suspendisse ultrices gravida dictum fusce ut placerat. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae purus. Eu consequat ac felis donec et odio. Urna cursus eget nunc scelerisque viverra mauris. Cras pulvinar mattis nunc sed blandit libero volutpat. Scelerisque viverra mauris in aliquam sem fringilla ut morbi tincidunt. Eu nisl nunc mi ipsum faucibus. Mauris ultrices eros in cursus turpis massa tincidunt dui. In egestas erat imperdiet sed euismod nisi porta lorem. Quis varius quam quisque id diam vel quam. Bibendum neque egestas congue quisque egestas diam. Sed adipiscing diam donec adipiscing tristique risus.', 5),
(47, 'Ring of Protection', '2022-11-16 17:21:20', 'Ring', 3500, 97, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Cursus in hac habitasse platea dictumst quisque. Volutpat maecenas volutpat blandit aliquam etiam erat velit. Est pellentesque elit ullamcorper dignissim cras tincidunt lobortis feugiat. Consectetur purus ut faucibus pulvinar elementum integer enim neque volutpat. Turpis egestas pretium aenean pharetra magna ac placerat. Libero volutpat sed cras ornare arcu dui. Neque volutpat ac tincidunt vitae semper quis lectus nulla. Amet nulla facilisi morbi tempus. Accumsan sit amet nulla facilisi morbi tempus. Tempus egestas sed sed risus pretium quam vulputate dignissim.\r\n\r\nPulvinar neque laoreet suspendisse interdum. Sem fringilla ut morbi tincidunt augue. Purus in massa tempor nec feugiat nisl pretium. Enim diam vulputate ut pharetra sit amet. Enim tortor at auctor urna nunc. Mauris augue neque gravida in fermentum et sollicitudin ac. Ipsum suspendisse ultrices gravida dictum fusce ut placerat. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae purus. Eu consequat ac felis donec et odio. Urna cursus eget nunc scelerisque viverra mauris. Cras pulvinar mattis nunc sed blandit libero volutpat. Scelerisque viverra mauris in aliquam sem fringilla ut morbi tincidunt. Eu nisl nunc mi ipsum faucibus. Mauris ultrices eros in cursus turpis massa tincidunt dui. In egestas erat imperdiet sed euismod nisi porta lorem. Quis varius quam quisque id diam vel quam. Bibendum neque egestas congue quisque egestas diam. Sed adipiscing diam donec adipiscing tristique risus.', 0),
(48, 'Necklace of Crypt', '2022-11-16 17:21:21', 'Necklace', 4000, 96, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Cursus in hac habitasse platea dictumst quisque. Volutpat maecenas volutpat blandit aliquam etiam erat velit. Est pellentesque elit ullamcorper dignissim cras tincidunt lobortis feugiat. Consectetur purus ut faucibus pulvinar elementum integer enim neque volutpat. Turpis egestas pretium aenean pharetra magna ac placerat. Libero volutpat sed cras ornare arcu dui. Neque volutpat ac tincidunt vitae semper quis lectus nulla. Amet nulla facilisi morbi tempus. Accumsan sit amet nulla facilisi morbi tempus. Tempus egestas sed sed risus pretium quam vulputate dignissim.\r\n\r\nPulvinar neque laoreet suspendisse interdum. Sem fringilla ut morbi tincidunt augue. Purus in massa tempor nec feugiat nisl pretium. Enim diam vulputate ut pharetra sit amet. Enim tortor at auctor urna nunc. Mauris augue neque gravida in fermentum et sollicitudin ac. Ipsum suspendisse ultrices gravida dictum fusce ut placerat. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae purus. Eu consequat ac felis donec et odio. Urna cursus eget nunc scelerisque viverra mauris. Cras pulvinar mattis nunc sed blandit libero volutpat. Scelerisque viverra mauris in aliquam sem fringilla ut morbi tincidunt. Eu nisl nunc mi ipsum faucibus. Mauris ultrices eros in cursus turpis massa tincidunt dui. In egestas erat imperdiet sed euismod nisi porta lorem. Quis varius quam quisque id diam vel quam. Bibendum neque egestas congue quisque egestas diam. Sed adipiscing diam donec adipiscing tristique risus.', 0),
(49, 'Necklace of Cross', '2022-11-16 17:21:22', 'Necklace', 5000, 100, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Cursus in hac habitasse platea dictumst quisque. Volutpat maecenas volutpat blandit aliquam etiam erat velit. Est pellentesque elit ullamcorper dignissim cras tincidunt lobortis feugiat. Consectetur purus ut faucibus pulvinar elementum integer enim neque volutpat. Turpis egestas pretium aenean pharetra magna ac placerat. Libero volutpat sed cras ornare arcu dui. Neque volutpat ac tincidunt vitae semper quis lectus nulla. Amet nulla facilisi morbi tempus. Accumsan sit amet nulla facilisi morbi tempus. Tempus egestas sed sed risus pretium quam vulputate dignissim.\r\n\r\nPulvinar neque laoreet suspendisse interdum. Sem fringilla ut morbi tincidunt augue. Purus in massa tempor nec feugiat nisl pretium. Enim diam vulputate ut pharetra sit amet. Enim tortor at auctor urna nunc. Mauris augue neque gravida in fermentum et sollicitudin ac. Ipsum suspendisse ultrices gravida dictum fusce ut placerat. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae purus. Eu consequat ac felis donec et odio. Urna cursus eget nunc scelerisque viverra mauris. Cras pulvinar mattis nunc sed blandit libero volutpat. Scelerisque viverra mauris in aliquam sem fringilla ut morbi tincidunt. Eu nisl nunc mi ipsum faucibus. Mauris ultrices eros in cursus turpis massa tincidunt dui. In egestas erat imperdiet sed euismod nisi porta lorem. Quis varius quam quisque id diam vel quam. Bibendum neque egestas congue quisque egestas diam. Sed adipiscing diam donec adipiscing tristique risus.', 0),
(50, 'Necklace of Plain Cross', '2022-11-16 17:21:23', 'Necklace', 3500, 98, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Cursus in hac habitasse platea dictumst quisque. Volutpat maecenas volutpat blandit aliquam etiam erat velit. Est pellentesque elit ullamcorper dignissim cras tincidunt lobortis feugiat. Consectetur purus ut faucibus pulvinar elementum integer enim neque volutpat. Turpis egestas pretium aenean pharetra magna ac placerat. Libero volutpat sed cras ornare arcu dui. Neque volutpat ac tincidunt vitae semper quis lectus nulla. Amet nulla facilisi morbi tempus. Accumsan sit amet nulla facilisi morbi tempus. Tempus egestas sed sed risus pretium quam vulputate dignissim.\r\n\r\nPulvinar neque laoreet suspendisse interdum. Sem fringilla ut morbi tincidunt augue. Purus in massa tempor nec feugiat nisl pretium. Enim diam vulputate ut pharetra sit amet. Enim tortor at auctor urna nunc. Mauris augue neque gravida in fermentum et sollicitudin ac. Ipsum suspendisse ultrices gravida dictum fusce ut placerat. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae purus. Eu consequat ac felis donec et odio. Urna cursus eget nunc scelerisque viverra mauris. Cras pulvinar mattis nunc sed blandit libero volutpat. Scelerisque viverra mauris in aliquam sem fringilla ut morbi tincidunt. Eu nisl nunc mi ipsum faucibus. Mauris ultrices eros in cursus turpis massa tincidunt dui. In egestas erat imperdiet sed euismod nisi porta lorem. Quis varius quam quisque id diam vel quam. Bibendum neque egestas congue quisque egestas diam. Sed adipiscing diam donec adipiscing tristique risus.', 0),
(51, 'Pendant of Strength', '2022-11-16 17:21:24', 'Pendant', 3999, 100, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Cursus in hac habitasse platea dictumst quisque. Volutpat maecenas volutpat blandit aliquam etiam erat velit. Est pellentesque elit ullamcorper dignissim cras tincidunt lobortis feugiat. Consectetur purus ut faucibus pulvinar elementum integer enim neque volutpat. Turpis egestas pretium aenean pharetra magna ac placerat. Libero volutpat sed cras ornare arcu dui. Neque volutpat ac tincidunt vitae semper quis lectus nulla. Amet nulla facilisi morbi tempus. Accumsan sit amet nulla facilisi morbi tempus. Tempus egestas sed sed risus pretium quam vulputate dignissim.\r\n\r\nPulvinar neque laoreet suspendisse interdum. Sem fringilla ut morbi tincidunt augue. Purus in massa tempor nec feugiat nisl pretium. Enim diam vulputate ut pharetra sit amet. Enim tortor at auctor urna nunc. Mauris augue neque gravida in fermentum et sollicitudin ac. Ipsum suspendisse ultrices gravida dictum fusce ut placerat. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae purus. Eu consequat ac felis donec et odio. Urna cursus eget nunc scelerisque viverra mauris. Cras pulvinar mattis nunc sed blandit libero volutpat. Scelerisque viverra mauris in aliquam sem fringilla ut morbi tincidunt. Eu nisl nunc mi ipsum faucibus. Mauris ultrices eros in cursus turpis massa tincidunt dui. In egestas erat imperdiet sed euismod nisi porta lorem. Quis varius quam quisque id diam vel quam. Bibendum neque egestas congue quisque egestas diam. Sed adipiscing diam donec adipiscing tristique risus.', 0),
(52, 'Blessed Pendant', '2022-11-16 17:21:25', 'Pendant', 3500, 100, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Cursus in hac habitasse platea dictumst quisque. Volutpat maecenas volutpat blandit aliquam etiam erat velit. Est pellentesque elit ullamcorper dignissim cras tincidunt lobortis feugiat. Consectetur purus ut faucibus pulvinar elementum integer enim neque volutpat. Turpis egestas pretium aenean pharetra magna ac placerat. Libero volutpat sed cras ornare arcu dui. Neque volutpat ac tincidunt vitae semper quis lectus nulla. Amet nulla facilisi morbi tempus. Accumsan sit amet nulla facilisi morbi tempus. Tempus egestas sed sed risus pretium quam vulputate dignissim.\r\n\r\nPulvinar neque laoreet suspendisse interdum. Sem fringilla ut morbi tincidunt augue. Purus in massa tempor nec feugiat nisl pretium. Enim diam vulputate ut pharetra sit amet. Enim tortor at auctor urna nunc. Mauris augue neque gravida in fermentum et sollicitudin ac. Ipsum suspendisse ultrices gravida dictum fusce ut placerat. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae purus. Eu consequat ac felis donec et odio. Urna cursus eget nunc scelerisque viverra mauris. Cras pulvinar mattis nunc sed blandit libero volutpat. Scelerisque viverra mauris in aliquam sem fringilla ut morbi tincidunt. Eu nisl nunc mi ipsum faucibus. Mauris ultrices eros in cursus turpis massa tincidunt dui. In egestas erat imperdiet sed euismod nisi porta lorem. Quis varius quam quisque id diam vel quam. Bibendum neque egestas congue quisque egestas diam. Sed adipiscing diam donec adipiscing tristique risus.', 0),
(53, 'Earring of Guard', '2022-11-16 17:21:26', 'Earring', 2500, 100, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Cursus in hac habitasse platea dictumst quisque. Volutpat maecenas volutpat blandit aliquam etiam erat velit. Est pellentesque elit ullamcorper dignissim cras tincidunt lobortis feugiat. Consectetur purus ut faucibus pulvinar elementum integer enim neque volutpat. Turpis egestas pretium aenean pharetra magna ac placerat. Libero volutpat sed cras ornare arcu dui. Neque volutpat ac tincidunt vitae semper quis lectus nulla. Amet nulla facilisi morbi tempus. Accumsan sit amet nulla facilisi morbi tempus. Tempus egestas sed sed risus pretium quam vulputate dignissim.\r\n\r\nPulvinar neque laoreet suspendisse interdum. Sem fringilla ut morbi tincidunt augue. Purus in massa tempor nec feugiat nisl pretium. Enim diam vulputate ut pharetra sit amet. Enim tortor at auctor urna nunc. Mauris augue neque gravida in fermentum et sollicitudin ac. Ipsum suspendisse ultrices gravida dictum fusce ut placerat. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae purus. Eu consequat ac felis donec et odio. Urna cursus eget nunc scelerisque viverra mauris. Cras pulvinar mattis nunc sed blandit libero volutpat. Scelerisque viverra mauris in aliquam sem fringilla ut morbi tincidunt. Eu nisl nunc mi ipsum faucibus. Mauris ultrices eros in cursus turpis massa tincidunt dui. In egestas erat imperdiet sed euismod nisi porta lorem. Quis varius quam quisque id diam vel quam. Bibendum neque egestas congue quisque egestas diam. Sed adipiscing diam donec adipiscing tristique risus.', 0),
(54, 'Sienna\'s Bracelet', '2022-11-16 17:21:27', 'Earring', 2500, 100, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Cursus in hac habitasse platea dictumst quisque. Volutpat maecenas volutpat blandit aliquam etiam erat velit. Est pellentesque elit ullamcorper dignissim cras tincidunt lobortis feugiat. Consectetur purus ut faucibus pulvinar elementum integer enim neque volutpat. Turpis egestas pretium aenean pharetra magna ac placerat. Libero volutpat sed cras ornare arcu dui. Neque volutpat ac tincidunt vitae semper quis lectus nulla. Amet nulla facilisi morbi tempus. Accumsan sit amet nulla facilisi morbi tempus. Tempus egestas sed sed risus pretium quam vulputate dignissim.\r\n\r\nPulvinar neque laoreet suspendisse interdum. Sem fringilla ut morbi tincidunt augue. Purus in massa tempor nec feugiat nisl pretium. Enim diam vulputate ut pharetra sit amet. Enim tortor at auctor urna nunc. Mauris augue neque gravida in fermentum et sollicitudin ac. Ipsum suspendisse ultrices gravida dictum fusce ut placerat. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae purus. Eu consequat ac felis donec et odio. Urna cursus eget nunc scelerisque viverra mauris. Cras pulvinar mattis nunc sed blandit libero volutpat. Scelerisque viverra mauris in aliquam sem fringilla ut morbi tincidunt. Eu nisl nunc mi ipsum faucibus. Mauris ultrices eros in cursus turpis massa tincidunt dui. In egestas erat imperdiet sed euismod nisi porta lorem. Quis varius quam quisque id diam vel quam. Bibendum neque egestas congue quisque egestas diam. Sed adipiscing diam donec adipiscing tristique risus.', 0),
(55, 'Necklace of Moon', '2022-11-16 17:21:28', 'Necklace', 3500, 100, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Cursus in hac habitasse platea dictumst quisque. Volutpat maecenas volutpat blandit aliquam etiam erat velit. Est pellentesque elit ullamcorper dignissim cras tincidunt lobortis feugiat. Consectetur purus ut faucibus pulvinar elementum integer enim neque volutpat. Turpis egestas pretium aenean pharetra magna ac placerat. Libero volutpat sed cras ornare arcu dui. Neque volutpat ac tincidunt vitae semper quis lectus nulla. Amet nulla facilisi morbi tempus. Accumsan sit amet nulla facilisi morbi tempus. Tempus egestas sed sed risus pretium quam vulputate dignissim.\r\n\r\nPulvinar neque laoreet suspendisse interdum. Sem fringilla ut morbi tincidunt augue. Purus in massa tempor nec feugiat nisl pretium. Enim diam vulputate ut pharetra sit amet. Enim tortor at auctor urna nunc. Mauris augue neque gravida in fermentum et sollicitudin ac. Ipsum suspendisse ultrices gravida dictum fusce ut placerat. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae purus. Eu consequat ac felis donec et odio. Urna cursus eget nunc scelerisque viverra mauris. Cras pulvinar mattis nunc sed blandit libero volutpat. Scelerisque viverra mauris in aliquam sem fringilla ut morbi tincidunt. Eu nisl nunc mi ipsum faucibus. Mauris ultrices eros in cursus turpis massa tincidunt dui. In egestas erat imperdiet sed euismod nisi porta lorem. Quis varius quam quisque id diam vel quam. Bibendum neque egestas congue quisque egestas diam. Sed adipiscing diam donec adipiscing tristique risus.', 0),
(56, 'Flower Necklace ', '2022-11-16 17:21:29', 'Necklace', 5000, 100, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Cursus in hac habitasse platea dictumst quisque. Volutpat maecenas volutpat blandit aliquam etiam erat velit. Est pellentesque elit ullamcorper dignissim cras tincidunt lobortis feugiat. Consectetur purus ut faucibus pulvinar elementum integer enim neque volutpat. Turpis egestas pretium aenean pharetra magna ac placerat. Libero volutpat sed cras ornare arcu dui. Neque volutpat ac tincidunt vitae semper quis lectus nulla. Amet nulla facilisi morbi tempus. Accumsan sit amet nulla facilisi morbi tempus. Tempus egestas sed sed risus pretium quam vulputate dignissim.\r\n\r\nPulvinar neque laoreet suspendisse interdum. Sem fringilla ut morbi tincidunt augue. Purus in massa tempor nec feugiat nisl pretium. Enim diam vulputate ut pharetra sit amet. Enim tortor at auctor urna nunc. Mauris augue neque gravida in fermentum et sollicitudin ac. Ipsum suspendisse ultrices gravida dictum fusce ut placerat. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae purus. Eu consequat ac felis donec et odio. Urna cursus eget nunc scelerisque viverra mauris. Cras pulvinar mattis nunc sed blandit libero volutpat. Scelerisque viverra mauris in aliquam sem fringilla ut morbi tincidunt. Eu nisl nunc mi ipsum faucibus. Mauris ultrices eros in cursus turpis massa tincidunt dui. In egestas erat imperdiet sed euismod nisi porta lorem. Quis varius quam quisque id diam vel quam. Bibendum neque egestas congue quisque egestas diam. Sed adipiscing diam donec adipiscing tristique risus.', 0),
(62, '1', '2022-11-16 17:21:30', 'Ring', 1, 1, '1', 0),
(63, '1', '2022-11-16 17:21:31', 'Ring', 1, 1, '1', 0),
(64, '1', '2022-11-16 17:21:32', 'Ring', 1, 1, '1', 0),
(66, '1', '2022-11-16 17:21:33', 'Ring', 1, 1, '1', 0),
(71, '1', '2022-11-16 17:27:26', 'Ring', 1, 1, '1', 0),
(72, '1', '2022-11-16 17:27:42', 'Ring', 1, 1, '1', 0),
(73, '1', '2022-11-16 17:27:54', 'Necklace', 1, 1, '1', 0),
(74, '1', '2022-11-16 17:28:08', 'Ring', 1, 1, '1', 0),
(75, '1', '2022-11-16 17:28:18', 'Ring', 1, 1, '1', 0),
(76, '1', '2022-11-16 17:28:29', 'Pendant', 1, 1, '1', 0),
(77, '1', '2022-11-16 17:28:38', 'Ring', 1, 1, '1', 0),
(78, '1', '2022-11-16 17:28:45', 'Necklace', 1, 1, '1', 0);

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
  `date_updated` datetime NOT NULL,
  `status_message` varchar(255) NOT NULL,
  `available` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `shipping_fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_handler`
--

CREATE TABLE `order_handler` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `available` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(27, 'bulacan'),
(28, 'pampanga'),
(29, 'bataan');

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
(82, 'Super', 'Admin', 'superadmin@test.com', '09999999999', '$2y$10$hO98dr9z60gjoIry2bOHQO.O1Ez4yj0aC.Mt92ktnbzpOrX1mLEIK', 'yes', 'super_admin', 0, ''),
(93, 'Customer', 'User', 'customer@test.com', '09999999997', '$2y$10$gUrYv0Wcdr0GgpS.ciAMy.1D8P3NSS4/6AKhB61AJYAEK1dF9iuAC', 'yes', 'customer', 0, '$2y$10$h1yZQx0ASEnsjNi/euct9.t8Dx96jxGbvqVn3748q81ra1qcc/RGu'),
(94, 'Driver', 'User', 'driver@test.com', '09999999996', '$2y$10$3R6ojsB10k2RcN4Idg8Aiepvk0exYNX5877l3JLkxa77mU2jAem7m', 'yes', 'driver', 0, '$2y$10$96YUo9.BmVIcw3mgRF9DNOX8UFoKZhAi0kjr1t8MXnDFSV1F3qt06'),
(96, 'Admin', 'User', 'admin@test.com', '09999999998', '$2y$10$wsI78OfOTIguJu4EF7r8UeBgXoKk2W.REh/XjVg8KyYpxvTgjQ1ZS', 'yes', 'admin', 0, '$2y$10$65LXvlXFbre6WAhuJBR6guWHMRcv6HjH58nInokMNX.lU2leDCeiK');

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
  `id` int(11) NOT NULL,
  `shipping_fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`user_id`, `house_number`, `barangay`, `city`, `province`, `id`, `shipping_fee`) VALUES
(93, '', '', '', '', 8, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangay_list`
--
ALTER TABLE `barangay_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cart_item` (`item_id`),
  ADD KEY `fk_cart_user` (`user_id`);

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
-- Indexes for table `order_handler`
--
ALTER TABLE `order_handler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_oitem_order` (`order_id`),
  ADD KEY `fk_oitem_item` (`item_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangay_list`
--
ALTER TABLE `barangay_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;

--
-- AUTO_INCREMENT for table `city_list`
--
ALTER TABLE `city_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `order_handler`
--
ALTER TABLE `order_handler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `province_list`
--
ALTER TABLE `province_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `fk_oitem_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_oitem_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `fk_address_uid` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
