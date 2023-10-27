-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2023 at 03:31 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
  `shipping_fee` int(11) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangay_list`
--

INSERT INTO `barangay_list` (`id`, `barangay`, `city`, `shipping_fee`, `city_id`) VALUES
(125, 'PALAPAT', 'HAGONOY', 50, 139),
(126, 'SAN MIGUEL', 'HAGONOY', 55, 139),
(127, 'SAN ISIDRO', 'HAGONOY', 60, 139),
(128, 'SAN JUAN', 'HAGONOY', 55, 139),
(129, 'TEST', 'BULACAN', 50, 131);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `city_list`
--

CREATE TABLE `city_list` (
  `id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `shipping_fee` int(11) NOT NULL,
  `province_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city_list`
--

INSERT INTO `city_list` (`id`, `city`, `province`, `shipping_fee`, `province_id`) VALUES
(127, 'ANGAT', 'BULACAN', 0, 38),
(128, 'BALAGTAS (BIGAA)', 'BULACAN', 0, 38),
(129, 'BALIUAG', 'BULACAN', 0, 38),
(130, 'BOCAUE', 'BULACAN', 0, 38),
(131, 'BULACAN', 'BULACAN', 0, 38),
(132, 'BUSTOS', 'BULACAN', 0, 38),
(133, 'CALUMPIT', 'BULACAN', 0, 38),
(134, 'CITY OF MALOLOS (Capital)', 'BULACAN', 0, 38),
(135, 'CITY OF MEYCAUAYAN', 'BULACAN', 0, 38),
(136, 'CITY OF SAN JOSE DEL MONTE', 'BULACAN', 0, 38),
(137, 'DOÃ‘A REMEDIOS TRINIDAD', 'BULACAN', 0, 38),
(138, 'GUIGUINTO', 'BULACAN', 0, 38),
(139, 'HAGONOY', 'BULACAN', 0, 38),
(140, 'MARILAO', 'BULACAN', 0, 38),
(141, 'NORZAGARAY', 'BULACAN', 0, 38),
(142, 'OBANDO', 'BULACAN', 0, 38),
(143, 'PANDI', 'BULACAN', 0, 38),
(144, 'PAOMBONG', 'BULACAN', 0, 38),
(145, 'PLARIDEL', 'BULACAN', 0, 38),
(146, 'PULILAN', 'BULACAN', 0, 38),
(147, 'SAN ILDEFONSO', 'BULACAN', 0, 38),
(148, 'SAN MIGUEL', 'BULACAN', 0, 38),
(149, 'SAN RAFAEL', 'BULACAN', 0, 38),
(150, 'SANTA MARIA', 'BULACAN', 0, 38);

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password`
--

CREATE TABLE `forgot_password` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `date_created`, `category`, `price`, `stocks`, `description`, `sold`) VALUES
(82, 'Ring of protection Guard', '2022-11-26 19:03:06', 'Ring', 4000, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempus iaculis urna id volutpat. Etiam non quam lacus suspendisse faucibus interdum. Sem nulla pharetra diam sit amet. Enim ut sem viverra aliquet eget sit amet tellus. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Diam sit amet nisl suscipit adipiscing bibendum est ultricies. Aliquam sem fringilla ut morbi tincidunt. Morbi tristique senectus et netus et malesuada fames ac turpis. Sit amet venenatis urna cursus. Varius quam quisque id diam vel quam elementum pulvinar etiam. Fusce id velit ut tortor pretium viverra suspendisse potenti nullam. Non quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor. Integer feugiat scelerisque varius morbi enim. Mattis molestie a iaculis at erat pellentesque adipiscing commodo elit. Ac orci phasellus egestas tellus rutrum tellus pellentesque.\r\n\r\nLeo integer malesuada nunc vel risus commodo viverra. Vel quam elementum pulvinar etiam non quam. Integer quis auctor elit sed vulputate mi. Habitasse platea dictumst quisque sagittis purus sit. Odio pellentesque diam volutpat commodo sed egestas egestas fringilla. Risus ultricies tristique nulla aliquet enim tortor at. Nunc sed augue lacus viverra. Orci phasellus egestas tellus rutrum tellus pellentesque eu tincidunt. Faucibus in ornare quam viverra orci sagittis. Risus sed vulputate odio ut. Purus in massa tempor nec feugiat nisl pretium fusce. Accumsan lacus vel facilisis volutpat est velit. In hac habitasse platea dictumst.', 101),
(83, 'Pendant of luck', '2022-11-26 19:03:30', 'Pendant', 5000, 77, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempus iaculis urna id volutpat. Etiam non quam lacus suspendisse faucibus interdum. Sem nulla pharetra diam sit amet. Enim ut sem viverra aliquet eget sit amet tellus. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Diam sit amet nisl suscipit adipiscing bibendum est ultricies. Aliquam sem fringilla ut morbi tincidunt. Morbi tristique senectus et netus et malesuada fames ac turpis. Sit amet venenatis urna cursus. Varius quam quisque id diam vel quam elementum pulvinar etiam. Fusce id velit ut tortor pretium viverra suspendisse potenti nullam. Non quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor. Integer feugiat scelerisque varius morbi enim. Mattis molestie a iaculis at erat pellentesque adipiscing commodo elit. Ac orci phasellus egestas tellus rutrum tellus pellentesque.\r\n\r\nLeo integer malesuada nunc vel risus commodo viverra. Vel quam elementum pulvinar etiam non quam. Integer quis auctor elit sed vulputate mi. Habitasse platea dictumst quisque sagittis purus sit. Odio pellentesque diam volutpat commodo sed egestas egestas fringilla. Risus ultricies tristique nulla aliquet enim tortor at. Nunc sed augue lacus viverra. Orci phasellus egestas tellus rutrum tellus pellentesque eu tincidunt. Faucibus in ornare quam viverra orci sagittis. Risus sed vulputate odio ut. Purus in massa tempor nec feugiat nisl pretium fusce. Accumsan lacus vel facilisis volutpat est velit. In hac habitasse platea dictumst.', 9),
(84, 'Necklace of durance', '2022-11-26 19:04:10', 'Necklace', 2500, 92, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempus iaculis urna id volutpat. Etiam non quam lacus suspendisse faucibus interdum. Sem nulla pharetra diam sit amet. Enim ut sem viverra aliquet eget sit amet tellus. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Diam sit amet nisl suscipit adipiscing bibendum est ultricies. Aliquam sem fringilla ut morbi tincidunt. Morbi tristique senectus et netus et malesuada fames ac turpis. Sit amet venenatis urna cursus. Varius quam quisque id diam vel quam elementum pulvinar etiam. Fusce id velit ut tortor pretium viverra suspendisse potenti nullam. Non quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor. Integer feugiat scelerisque varius morbi enim. Mattis molestie a iaculis at erat pellentesque adipiscing commodo elit. Ac orci phasellus egestas tellus rutrum tellus pellentesque.\r\n\r\nLeo integer malesuada nunc vel risus commodo viverra. Vel quam elementum pulvinar etiam non quam. Integer quis auctor elit sed vulputate mi. Habitasse platea dictumst quisque sagittis purus sit. Odio pellentesque diam volutpat commodo sed egestas egestas fringilla. Risus ultricies tristique nulla aliquet enim tortor at. Nunc sed augue lacus viverra. Orci phasellus egestas tellus rutrum tellus pellentesque eu tincidunt. Faucibus in ornare quam viverra orci sagittis. Risus sed vulputate odio ut. Purus in massa tempor nec feugiat nisl pretium fusce. Accumsan lacus vel facilisis volutpat est velit. In hac habitasse platea dictumst.', 5),
(85, 'Vampiric Necklace', '2022-11-26 19:04:55', 'Necklace', 2500, 94, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempus iaculis urna id volutpat. Etiam non quam lacus suspendisse faucibus interdum. Sem nulla pharetra diam sit amet. Enim ut sem viverra aliquet eget sit amet tellus. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Diam sit amet nisl suscipit adipiscing bibendum est ultricies. Aliquam sem fringilla ut morbi tincidunt. Morbi tristique senectus et netus et malesuada fames ac turpis. Sit amet venenatis urna cursus. Varius quam quisque id diam vel quam elementum pulvinar etiam. Fusce id velit ut tortor pretium viverra suspendisse potenti nullam. Non quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor. Integer feugiat scelerisque varius morbi enim. Mattis molestie a iaculis at erat pellentesque adipiscing commodo elit. Ac orci phasellus egestas tellus rutrum tellus pellentesque.\r\n\r\nLeo integer malesuada nunc vel risus commodo viverra. Vel quam elementum pulvinar etiam non quam. Integer quis auctor elit sed vulputate mi. Habitasse platea dictumst quisque sagittis purus sit. Odio pellentesque diam volutpat commodo sed egestas egestas fringilla. Risus ultricies tristique nulla aliquet enim tortor at. Nunc sed augue lacus viverra. Orci phasellus egestas tellus rutrum tellus pellentesque eu tincidunt. Faucibus in ornare quam viverra orci sagittis. Risus sed vulputate odio ut. Purus in massa tempor nec feugiat nisl pretium fusce. Accumsan lacus vel facilisis volutpat est velit. In hac habitasse platea dictumst.', 2),
(86, 'Refresher Necklace', '2022-11-26 19:05:45', 'Necklace', 3500, 97, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempus iaculis urna id volutpat. Etiam non quam lacus suspendisse faucibus interdum. Sem nulla pharetra diam sit amet. Enim ut sem viverra aliquet eget sit amet tellus. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Diam sit amet nisl suscipit adipiscing bibendum est ultricies. Aliquam sem fringilla ut morbi tincidunt. Morbi tristique senectus et netus et malesuada fames ac turpis. Sit amet venenatis urna cursus. Varius quam quisque id diam vel quam elementum pulvinar etiam. Fusce id velit ut tortor pretium viverra suspendisse potenti nullam. Non quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor. Integer feugiat scelerisque varius morbi enim. Mattis molestie a iaculis at erat pellentesque adipiscing commodo elit. Ac orci phasellus egestas tellus rutrum tellus pellentesque.\r\n\r\nLeo integer malesuada nunc vel risus commodo viverra. Vel quam elementum pulvinar etiam non quam. Integer quis auctor elit sed vulputate mi. Habitasse platea dictumst quisque sagittis purus sit. Odio pellentesque diam volutpat commodo sed egestas egestas fringilla. Risus ultricies tristique nulla aliquet enim tortor at. Nunc sed augue lacus viverra. Orci phasellus egestas tellus rutrum tellus pellentesque eu tincidunt. Faucibus in ornare quam viverra orci sagittis. Risus sed vulputate odio ut. Purus in massa tempor nec feugiat nisl pretium fusce. Accumsan lacus vel facilisis volutpat est velit. In hac habitasse platea dictumst.', 2),
(87, 'Lucky pendant', '2022-11-26 19:06:41', 'Pendant', 2000, 93, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempus iaculis urna id volutpat. Etiam non quam lacus suspendisse faucibus interdum. Sem nulla pharetra diam sit amet. Enim ut sem viverra aliquet eget sit amet tellus. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Diam sit amet nisl suscipit adipiscing bibendum est ultricies. Aliquam sem fringilla ut morbi tincidunt. Morbi tristique senectus et netus et malesuada fames ac turpis. Sit amet venenatis urna cursus. Varius quam quisque id diam vel quam elementum pulvinar etiam. Fusce id velit ut tortor pretium viverra suspendisse potenti nullam. Non quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor. Integer feugiat scelerisque varius morbi enim. Mattis molestie a iaculis at erat pellentesque adipiscing commodo elit. Ac orci phasellus egestas tellus rutrum tellus pellentesque.\r\n\r\nLeo integer malesuada nunc vel risus commodo viverra. Vel quam elementum pulvinar etiam non quam. Integer quis auctor elit sed vulputate mi. Habitasse platea dictumst quisque sagittis purus sit. Odio pellentesque diam volutpat commodo sed egestas egestas fringilla. Risus ultricies tristique nulla aliquet enim tortor at. Nunc sed augue lacus viverra. Orci phasellus egestas tellus rutrum tellus pellentesque eu tincidunt. Faucibus in ornare quam viverra orci sagittis. Risus sed vulputate odio ut. Purus in massa tempor nec feugiat nisl pretium fusce. Accumsan lacus vel facilisis volutpat est velit. In hac habitasse platea dictumst.', 6),
(88, 'Cross Pendant', '2022-11-26 19:08:26', 'Pendant', 1500, 99, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempus iaculis urna id volutpat. Etiam non quam lacus suspendisse faucibus interdum. Sem nulla pharetra diam sit amet. Enim ut sem viverra aliquet eget sit amet tellus. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Diam sit amet nisl suscipit adipiscing bibendum est ultricies. Aliquam sem fringilla ut morbi tincidunt. Morbi tristique senectus et netus et malesuada fames ac turpis. Sit amet venenatis urna cursus. Varius quam quisque id diam vel quam elementum pulvinar etiam. Fusce id velit ut tortor pretium viverra suspendisse potenti nullam. Non quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor. Integer feugiat scelerisque varius morbi enim. Mattis molestie a iaculis at erat pellentesque adipiscing commodo elit. Ac orci phasellus egestas tellus rutrum tellus pellentesque.\r\n\r\nLeo integer malesuada nunc vel risus commodo viverra. Vel quam elementum pulvinar etiam non quam. Integer quis auctor elit sed vulputate mi. Habitasse platea dictumst quisque sagittis purus sit. Odio pellentesque diam volutpat commodo sed egestas egestas fringilla. Risus ultricies tristique nulla aliquet enim tortor at. Nunc sed augue lacus viverra. Orci phasellus egestas tellus rutrum tellus pellentesque eu tincidunt. Faucibus in ornare quam viverra orci sagittis. Risus sed vulputate odio ut. Purus in massa tempor nec feugiat nisl pretium fusce. Accumsan lacus vel facilisis volutpat est velit. In hac habitasse platea dictumst.', 0),
(89, 'Durance Pendant', '2022-11-26 19:10:32', 'Pendant', 2500, 99, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempus iaculis urna id volutpat. Etiam non quam lacus suspendisse faucibus interdum. Sem nulla pharetra diam sit amet. Enim ut sem viverra aliquet eget sit amet tellus. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Diam sit amet nisl suscipit adipiscing bibendum est ultricies. Aliquam sem fringilla ut morbi tincidunt. Morbi tristique senectus et netus et malesuada fames ac turpis. Sit amet venenatis urna cursus. Varius quam quisque id diam vel quam elementum pulvinar etiam. Fusce id velit ut tortor pretium viverra suspendisse potenti nullam. Non quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor. Integer feugiat scelerisque varius morbi enim. Mattis molestie a iaculis at erat pellentesque adipiscing commodo elit. Ac orci phasellus egestas tellus rutrum tellus pellentesque.\r\n\r\nLeo integer malesuada nunc vel risus commodo viverra. Vel quam elementum pulvinar etiam non quam. Integer quis auctor elit sed vulputate mi. Habitasse platea dictumst quisque sagittis purus sit. Odio pellentesque diam volutpat commodo sed egestas egestas fringilla. Risus ultricies tristique nulla aliquet enim tortor at. Nunc sed augue lacus viverra. Orci phasellus egestas tellus rutrum tellus pellentesque eu tincidunt. Faucibus in ornare quam viverra orci sagittis. Risus sed vulputate odio ut. Purus in massa tempor nec feugiat nisl pretium fusce. Accumsan lacus vel facilisis volutpat est velit. In hac habitasse platea dictumst.', 0),
(90, 'Vampiric Earring', '2022-11-26 19:12:40', 'Earring', 3500, 99, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempus iaculis urna id volutpat. Etiam non quam lacus suspendisse faucibus interdum. Sem nulla pharetra diam sit amet. Enim ut sem viverra aliquet eget sit amet tellus. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Diam sit amet nisl suscipit adipiscing bibendum est ultricies. Aliquam sem fringilla ut morbi tincidunt. Morbi tristique senectus et netus et malesuada fames ac turpis. Sit amet venenatis urna cursus. Varius quam quisque id diam vel quam elementum pulvinar etiam. Fusce id velit ut tortor pretium viverra suspendisse potenti nullam. Non quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor. Integer feugiat scelerisque varius morbi enim. Mattis molestie a iaculis at erat pellentesque adipiscing commodo elit. Ac orci phasellus egestas tellus rutrum tellus pellentesque.\r\n\r\nLeo integer malesuada nunc vel risus commodo viverra. Vel quam elementum pulvinar etiam non quam. Integer quis auctor elit sed vulputate mi. Habitasse platea dictumst quisque sagittis purus sit. Odio pellentesque diam volutpat commodo sed egestas egestas fringilla. Risus ultricies tristique nulla aliquet enim tortor at. Nunc sed augue lacus viverra. Orci phasellus egestas tellus rutrum tellus pellentesque eu tincidunt. Faucibus in ornare quam viverra orci sagittis. Risus sed vulputate odio ut. Purus in massa tempor nec feugiat nisl pretium fusce. Accumsan lacus vel facilisis volutpat est velit. In hac habitasse platea dictumst.', 0),
(91, 'Earring of Guard', '2022-11-26 19:14:47', 'Earring', 4000, 98, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempus iaculis urna id volutpat. Etiam non quam lacus suspendisse faucibus interdum. Sem nulla pharetra diam sit amet. Enim ut sem viverra aliquet eget sit amet tellus. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Diam sit amet nisl suscipit adipiscing bibendum est ultricies. Aliquam sem fringilla ut morbi tincidunt. Morbi tristique senectus et netus et malesuada fames ac turpis. Sit amet venenatis urna cursus. Varius quam quisque id diam vel quam elementum pulvinar etiam. Fusce id velit ut tortor pretium viverra suspendisse potenti nullam. Non quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor. Integer feugiat scelerisque varius morbi enim. Mattis molestie a iaculis at erat pellentesque adipiscing commodo elit. Ac orci phasellus egestas tellus rutrum tellus pellentesque.\r\n\r\nLeo integer malesuada nunc vel risus commodo viverra. Vel quam elementum pulvinar etiam non quam. Integer quis auctor elit sed vulputate mi. Habitasse platea dictumst quisque sagittis purus sit. Odio pellentesque diam volutpat commodo sed egestas egestas fringilla. Risus ultricies tristique nulla aliquet enim tortor at. Nunc sed augue lacus viverra. Orci phasellus egestas tellus rutrum tellus pellentesque eu tincidunt. Faucibus in ornare quam viverra orci sagittis. Risus sed vulputate odio ut. Purus in massa tempor nec feugiat nisl pretium fusce. Accumsan lacus vel facilisis volutpat est velit. In hac habitasse platea dictumst.', 1),
(92, 'Bracelet of Braid', '2022-11-26 19:15:38', 'Bracelet', 2500, 99, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempus iaculis urna id volutpat. Etiam non quam lacus suspendisse faucibus interdum. Sem nulla pharetra diam sit amet. Enim ut sem viverra aliquet eget sit amet tellus. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Diam sit amet nisl suscipit adipiscing bibendum est ultricies. Aliquam sem fringilla ut morbi tincidunt. Morbi tristique senectus et netus et malesuada fames ac turpis. Sit amet venenatis urna cursus. Varius quam quisque id diam vel quam elementum pulvinar etiam. Fusce id velit ut tortor pretium viverra suspendisse potenti nullam. Non quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor. Integer feugiat scelerisque varius morbi enim. Mattis molestie a iaculis at erat pellentesque adipiscing commodo elit. Ac orci phasellus egestas tellus rutrum tellus pellentesque.\r\n\r\nLeo integer malesuada nunc vel risus commodo viverra. Vel quam elementum pulvinar etiam non quam. Integer quis auctor elit sed vulputate mi. Habitasse platea dictumst quisque sagittis purus sit. Odio pellentesque diam volutpat commodo sed egestas egestas fringilla. Risus ultricies tristique nulla aliquet enim tortor at. Nunc sed augue lacus viverra. Orci phasellus egestas tellus rutrum tellus pellentesque eu tincidunt. Faucibus in ornare quam viverra orci sagittis. Risus sed vulputate odio ut. Purus in massa tempor nec feugiat nisl pretium fusce. Accumsan lacus vel facilisis volutpat est velit. In hac habitasse platea dictumst.', 0),
(93, 'Sienna\'s Bracelet', '2022-11-26 19:16:08', 'Bracelet', 3500, 100, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempus iaculis urna id volutpat. Etiam non quam lacus suspendisse faucibus interdum. Sem nulla pharetra diam sit amet. Enim ut sem viverra aliquet eget sit amet tellus. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Diam sit amet nisl suscipit adipiscing bibendum est ultricies. Aliquam sem fringilla ut morbi tincidunt. Morbi tristique senectus et netus et malesuada fames ac turpis. Sit amet venenatis urna cursus. Varius quam quisque id diam vel quam elementum pulvinar etiam. Fusce id velit ut tortor pretium viverra suspendisse potenti nullam. Non quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor. Integer feugiat scelerisque varius morbi enim. Mattis molestie a iaculis at erat pellentesque adipiscing commodo elit. Ac orci phasellus egestas tellus rutrum tellus pellentesque.\r\n\r\nLeo integer malesuada nunc vel risus commodo viverra. Vel quam elementum pulvinar etiam non quam. Integer quis auctor elit sed vulputate mi. Habitasse platea dictumst quisque sagittis purus sit. Odio pellentesque diam volutpat commodo sed egestas egestas fringilla. Risus ultricies tristique nulla aliquet enim tortor at. Nunc sed augue lacus viverra. Orci phasellus egestas tellus rutrum tellus pellentesque eu tincidunt. Faucibus in ornare quam viverra orci sagittis. Risus sed vulputate odio ut. Purus in massa tempor nec feugiat nisl pretium fusce. Accumsan lacus vel facilisis volutpat est velit. In hac habitasse platea dictumst.', 0),
(94, 'Bracelet of fighter', '2022-11-26 19:16:45', 'Bracelet', 3500, 100, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempus iaculis urna id volutpat. Etiam non quam lacus suspendisse faucibus interdum. Sem nulla pharetra diam sit amet. Enim ut sem viverra aliquet eget sit amet tellus. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Diam sit amet nisl suscipit adipiscing bibendum est ultricies. Aliquam sem fringilla ut morbi tincidunt. Morbi tristique senectus et netus et malesuada fames ac turpis. Sit amet venenatis urna cursus. Varius quam quisque id diam vel quam elementum pulvinar etiam. Fusce id velit ut tortor pretium viverra suspendisse potenti nullam. Non quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor. Integer feugiat scelerisque varius morbi enim. Mattis molestie a iaculis at erat pellentesque adipiscing commodo elit. Ac orci phasellus egestas tellus rutrum tellus pellentesque.\r\n\r\nLeo integer malesuada nunc vel risus commodo viverra. Vel quam elementum pulvinar etiam non quam. Integer quis auctor elit sed vulputate mi. Habitasse platea dictumst quisque sagittis purus sit. Odio pellentesque diam volutpat commodo sed egestas egestas fringilla. Risus ultricies tristique nulla aliquet enim tortor at. Nunc sed augue lacus viverra. Orci phasellus egestas tellus rutrum tellus pellentesque eu tincidunt. Faucibus in ornare quam viverra orci sagittis. Risus sed vulputate odio ut. Purus in massa tempor nec feugiat nisl pretium fusce. Accumsan lacus vel facilisis volutpat est velit. In hac habitasse platea dictumst.', 0);

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
  `shipping_fee` int(11) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `ref_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_handler`
--

CREATE TABLE `order_handler` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `available` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `province_list`
--

CREATE TABLE `province_list` (
  `id` int(11) NOT NULL,
  `province` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `province_list`
--

INSERT INTO `province_list` (`id`, `province`) VALUES
(38, 'BULACAN');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `verification_code` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `phone`, `password`, `verified`, `type`, `purchased`, `verification_code`, `status`) VALUES
(82, 'Super', 'Admin', 'systemadmin@goldplaceph.com', '09999999999', '$2y$10$hO98dr9z60gjoIry2bOHQO.O1Ez4yj0aC.Mt92ktnbzpOrX1mLEIK', 'yes', 'super_admin', 0, '', 'active'),
(97, 'driver', 'test', 'driver@goldplaceph.com', '09999999998', '$2y$10$ZeOB0DG0bzjHNsE85/IVC.ZscJYVHCy0ztuE6iEh8CgkuqtYLw4ya', 'yes', 'driver', 0, '$2y$10$nXzh85o.O34W07m.crx5yOBb53/7OMqdkcrgPdAhwSzpMfGlMhz0G', 'active'),
(108, 'admin', 'Test', 'employee@goldplaceph.com', '09999999912', '$2y$10$mT0Smi5yO8D4FRQoW7UjAeIMdtzTdwUU7sOFMEBvdbaACtDKhE9ei', 'yes', 'admin', 0, '$2y$10$uVS4EBmLniJVXcKvoxEJo.B0498R1Vz.nKNG51sD6Tzp7.jy51nly', 'active'),
(112, 'Customer', 'test', 'customer@goldplaceph.com', '09999999996', '$2y$10$ObwDExQwjsvKCuVqkBzv1OuaYs24f1yQOoKyV408KZPPawNGFLuaa', 'yes', 'customer', 12, '$2y$10$TbE11UG0rNfTVfZXdOvc2Oohso0FnjzK/R6m5zro0.tidYvOGarL2', 'active');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangay_list`
--
ALTER TABLE `barangay_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_brgy_city` (`city_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_city_province` (`province_id`);

--
-- Indexes for table `forgot_password`
--
ALTER TABLE `forgot_password`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_user` (`user_id`);

--
-- Indexes for table `order_handler`
--
ALTER TABLE `order_handler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_handler_order` (`order_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rating_item` (`item_id`),
  ADD KEY `fk_rating_user` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=438;

--
-- AUTO_INCREMENT for table `city_list`
--
ALTER TABLE `city_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `forgot_password`
--
ALTER TABLE `forgot_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT for table `order_handler`
--
ALTER TABLE `order_handler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `province_list`
--
ALTER TABLE `province_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangay_list`
--
ALTER TABLE `barangay_list`
  ADD CONSTRAINT `fk_brgy_city` FOREIGN KEY (`city_id`) REFERENCES `city_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `city_list`
--
ALTER TABLE `city_list`
  ADD CONSTRAINT `fk_city_province` FOREIGN KEY (`province_id`) REFERENCES `province_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_handler`
--
ALTER TABLE `order_handler`
  ADD CONSTRAINT `fk_handler_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `fk_oitem_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_oitem_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_rating_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_rating_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `fk_address_uid` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
