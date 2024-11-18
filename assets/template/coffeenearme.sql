-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2024 at 08:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffeenearme`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expenses_id` int(11) NOT NULL,
  `expenses` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `payment` double NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expenses_id`, `expenses`, `category`, `payment`, `date`) VALUES
(7, 'new', 'utility', 200, '2024-11-12 00:18:49'),
(8, 'qwe', 'utility', 23123, '2024-11-13 00:57:31'),
(9, 'qqw', 'utility', 2, '2024-11-14 19:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredients_id` int(100) NOT NULL,
  `raw_name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `quantity` double NOT NULL,
  `unit` varchar(100) NOT NULL,
  `ideal_quantity` int(100) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ingredients_id`, `raw_name`, `category`, `quantity`, `unit`, `ideal_quantity`, `picture`) VALUES
(64, '1', 'Food', 58939, 'kg', 4, '64.png'),
(66, '2', 'Food', 0, 'kg', 2, ''),
(67, '3', 'Food', 1, 'kg', 6, ''),
(69, '5', 'Food', 385, 'pcs', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients_category`
--

CREATE TABLE `ingredients_category` (
  `category_id` int(100) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients_category`
--

INSERT INTO `ingredients_category` (`category_id`, `category`) VALUES
(7, 'Food'),
(8, 'Coffee'),
(9, 'try');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_action`
--

CREATE TABLE `inventory_action` (
  `action_id` int(100) NOT NULL,
  `action_type` varchar(100) NOT NULL,
  `item` varchar(100) NOT NULL,
  `quantity` int(100) DEFAULT NULL,
  `unit` varchar(100) NOT NULL,
  `action_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `performed_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_action`
--

INSERT INTO `inventory_action` (`action_id`, `action_type`, `item`, `quantity`, `unit`, `action_date`, `performed_by`) VALUES
(2, 'Add Ingredients', 'try', 200, '', '2024-09-27 16:48:09', 'q'),
(3, 'Delete Ingredient', 'try', 0, '', '2024-09-27 17:05:37', 'q'),
(4, 'Delete Ingredient', 'qwe', NULL, '', '2024-09-27 17:07:27', 'q'),
(5, 'Delete Ingredient', 'Robusta', NULL, '', '2024-09-27 17:08:48', 'q'),
(6, 'Add Ingredients', 'Robusta', 300, '', '2024-09-27 17:14:15', 'q'),
(7, 'Add Ingredient', 'ss', 2, '', '2024-09-27 17:51:49', 'q'),
(8, 'Delete Ingredient', 'ss', NULL, '', '2024-09-27 17:52:22', 'q'),
(9, 'Stock In', 'Arabica', 20, '', '2024-09-28 16:16:46', 'q'),
(10, 'Stock In', 'Arabica', 20, '', '2024-09-28 16:20:28', 'q'),
(11, 'Stock In', 'Arabica', 0, '', '2024-09-28 16:24:34', 'q'),
(12, 'Stock In', 'Arabica', 0, '', '2024-09-28 16:25:38', 'q'),
(13, 'Stock In', 'Arabica', 0, '', '2024-09-28 16:26:58', 'q'),
(14, 'Stock In', 'Arabica', 0, '', '2024-09-28 16:29:53', 'q'),
(15, 'Stock Out', 'Robusta', 20, '', '2024-09-28 16:33:00', 'q'),
(16, 'Stock Out', 'Arabica', 20, '', '2024-09-28 16:33:08', 'q'),
(17, 'Stock Out', 'Arabica', 20, '', '2024-09-28 16:33:17', 'q'),
(18, 'Stock Out', 'Arabica', 20, '', '2024-09-28 16:33:24', 'q'),
(19, 'Stock In', 'Arabica', 20, '', '2024-09-28 16:33:34', 'q'),
(20, 'Stock Out', 'Arabica', 0, '', '2024-09-28 16:36:28', 'q'),
(21, 'Stock In', 'Arabica', 20, '', '2024-09-28 16:37:05', 'q'),
(22, 'Stock Out', 'Arabica', 0, '', '2024-09-28 16:37:48', 'q'),
(23, 'Stock Out', 'Arabica', 0, '', '2024-09-28 16:37:57', 'q'),
(24, 'Stock Out', 'Arabica', 0, '', '2024-09-28 16:38:14', 'q'),
(28, 'Stock Out', 'Arabica', 70, '', '2024-09-28 16:41:15', 'q'),
(29, 'Stock In', 'Arabica', 50, '', '2024-09-28 16:42:44', 'q'),
(30, 'Stock In', 'Robusta', 350, '', '2024-09-28 16:45:24', 'q'),
(31, 'Stock In', 'Arabica', 50, '', '2024-10-01 08:52:43', 'q'),
(32, 'Stock In', 'Arabica', 100, '', '2024-10-06 15:17:24', 'qwe'),
(33, 'Stock In', 'Arabica', 300, '', '2024-10-06 15:24:55', 'qwe'),
(34, 'Stock Out', 'Arabica', 400, '', '2024-10-06 15:25:09', 'qwe'),
(35, 'Add Ingredient', '1', 0, '', '2024-10-09 04:25:02', 'qwe'),
(36, 'Add Ingredient', '2', 0, '', '2024-10-09 04:25:05', 'qwe'),
(37, 'Add Ingredient', '3', 0, '', '2024-10-09 04:25:08', 'qwe'),
(38, 'Add Ingredient', '4', 0, '', '2024-10-09 04:25:11', 'qwe'),
(39, 'Add Ingredient', 'water', 2, '', '2024-10-10 07:49:57', 'qwe'),
(40, 'Add Ingredient', 'water b', 2, 'pcs', '2024-10-10 07:52:08', 'qwe'),
(41, 'Add Ingredient', 'beans', 5, 'kg', '2024-10-10 07:55:04', 'qwe'),
(42, 'Stock In', 'water b', 3, '', '2024-10-10 08:14:18', 'qwe'),
(43, 'Stock In', 'water b', 5, '', '2024-10-10 08:15:27', 'qwe'),
(44, 'Stock In', 'water b', 5, 'pcs', '2024-10-10 08:17:29', 'qwe'),
(45, 'Stock Out', 'water b', 5, 'pcs', '2024-10-10 08:30:19', 'qwe'),
(46, 'Stock Out', 'Arabica', 51, '51', '2024-10-10 17:59:04', 'qwe'),
(47, 'Add Ingredient', 'w', 25, 'gal', '2024-10-13 06:04:49', 'qwe'),
(48, 'Stock In', 'beans', 5, 'kg', '2024-10-22 07:11:16', 'qwe'),
(49, 'Stock In', 'w', 25, 'gal', '2024-10-22 07:11:22', 'qwe'),
(50, 'Stock Out', 'Robusta', 500, 'kg', '2024-10-29 07:44:04', 'qwe'),
(51, 'Stock In', 'Robusta', 50, 'kg', '2024-11-02 15:42:16', 'qwe'),
(52, 'Add Ingredient', '', 0, 'kg', '2024-11-02 15:47:38', 'qwe'),
(53, 'Delete Ingredient', '4', NULL, '', '2024-11-02 15:48:26', 'qwe'),
(54, 'Delete Ingredient', '', NULL, '', '2024-11-02 15:48:32', 'qwe'),
(55, 'Add Ingredient', '1', 1, 'kg', '2024-11-07 05:52:16', 'qwe'),
(56, 'Delete Ingredient', '1', NULL, '', '2024-11-07 05:52:34', 'qwe'),
(57, 'Delete Ingredient', 'beans', NULL, '', '2024-11-08 02:16:17', 'qwe'),
(58, 'Delete Ingredient', 'w', NULL, '', '2024-11-08 02:16:39', 'qwe'),
(59, 'Stock In', 'Arabica', 1, 'kg', '2024-11-08 02:22:26', 'qwe'),
(60, 'Delete Ingredient', 'Arabica', NULL, '', '2024-11-08 02:30:26', 'qwe'),
(61, 'Delete Ingredient', 'Robusta', NULL, '', '2024-11-08 02:37:27', 'qwe'),
(62, 'Delete Ingredient', 'qwe', NULL, '', '2024-11-08 02:37:56', 'qwe'),
(63, 'Delete Ingredient', '2', NULL, '', '2024-11-08 02:38:05', 'qwe'),
(64, 'Delete Ingredient', 'water', NULL, '', '2024-11-08 02:44:12', 'qwe'),
(65, 'Delete Ingredient', '3', NULL, '', '2024-11-08 02:46:16', 'qwe'),
(66, 'Delete Ingredient', 'water b', NULL, '', '2024-11-08 02:51:15', 'qwe'),
(67, 'Add Ingredient', '123', 2, 'kg', '2024-11-08 02:51:25', 'qwe'),
(68, 'Delete Ingredient', '123', NULL, '', '2024-11-08 02:52:01', 'qwe'),
(69, 'Add Ingredient', '1', 1, 'kg', '2024-11-08 02:52:22', 'qwe'),
(70, 'Delete Ingredient', '1', NULL, '', '2024-11-08 02:52:30', 'qwe'),
(71, 'Add Ingredient', '1', 1, 'kg', '2024-11-08 02:52:45', 'qwe'),
(72, 'Delete Ingredient', '1', NULL, '', '2024-11-08 02:52:48', 'qwe'),
(73, 'Add Ingredient', '1', 1, 'kg', '2024-11-08 02:53:07', 'qwe'),
(74, 'Delete Ingredient', '1', NULL, '', '2024-11-08 02:54:03', 'qwe'),
(75, 'Add Ingredient', '1', 1, 'kg', '2024-11-08 02:54:11', 'qwe'),
(76, 'Delete Ingredient', '1', NULL, '', '2024-11-08 02:54:25', 'qwe'),
(77, 'Add Ingredient', '1', 1, 'kg', '2024-11-08 02:54:57', 'qwe'),
(78, 'Delete Ingredient', '1', NULL, '', '2024-11-08 02:55:29', 'qwe'),
(79, 'Add Ingredient', '2', 2, 'kg', '2024-11-08 02:58:32', 'qwe'),
(80, 'Delete Ingredient', '2', NULL, '', '2024-11-08 02:58:39', 'qwe'),
(81, 'Add Ingredient', '1', 1, 'kg', '2024-11-08 02:59:01', 'qwe'),
(82, 'Delete Ingredient', '1', NULL, '', '2024-11-08 04:52:43', 'qwe'),
(83, 'Add Ingredient', '1', 2, 'kg', '2024-11-09 23:12:19', 'asd'),
(84, 'Add Ingredient', '2', 1, 'kg', '2024-11-12 11:49:58', 'qwe'),
(85, 'Stock In', '1', 1, 'kg', '2024-11-12 12:33:19', 'qwe'),
(86, 'Stock In', '1', 1, 'kg', '2024-11-12 12:40:00', 'qwe'),
(87, 'Stock In', '1', 1, 'kg', '2024-11-12 13:41:54', 'qwe'),
(88, 'Stock In', '1', 1, 'kg', '2024-11-12 13:52:43', 'qwe'),
(89, 'Add Ingredient', '3', 1, 'kg', '2024-11-12 13:57:37', 'qwe'),
(90, 'Stock In', '1', 1, 'kg', '2024-11-12 14:05:30', 'qwe'),
(91, 'Stock In', '2', 1, 'kg', '2024-11-12 14:05:36', 'qwe'),
(92, 'Stock In', '1', 1000, 'kg', '2024-11-12 14:06:26', 'qwe'),
(93, 'Add Ingredient', '5', 1, 'pcs', '2024-11-12 14:11:33', 'qwe'),
(94, 'Stock In', '5', 500, 'pcs', '2024-11-12 14:12:12', 'qwe'),
(95, 'Stock In', '2', 1, 'kg', '2024-11-13 21:09:51', 'qwe'),
(96, 'Stock In', '2', 1, 'kg', '2024-11-13 23:16:47', 'qwe');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(100) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `cost` double NOT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_category`, `price`, `cost`, `picture`) VALUES
(89, '1', 'Water Based', 100, 50, '89.png'),
(90, '2', 'Water Based', 222, 50, NULL),
(91, '4', 'Water Based', 20, 0, NULL),
(93, '5', 'Water Based', 222, 30, NULL),
(94, 'qweqwe', 'Water Based', 22.22, 0, NULL),
(95, '3333', 'Water Based', 333, 333, NULL),
(96, '333331', 'Water Based', 100, 50, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `category_id` int(100) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category_id`, `category`) VALUES
(11, 'Water Based'),
(14, 'Hot');

-- --------------------------------------------------------

--
-- Table structure for table `product_ingredients`
--

CREATE TABLE `product_ingredients` (
  `product_raw_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `ingredients_id` int(100) NOT NULL,
  `quantity` float NOT NULL,
  `unit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_ingredients`
--

INSERT INTO `product_ingredients` (`product_raw_id`, `product_id`, `ingredients_id`, `quantity`, `unit`) VALUES
(58, 90, 66, 2, 'g'),
(59, 93, 69, 2, 'pcs'),
(61, 94, 69, 1, 'pcs');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `total_amount` int(100) NOT NULL,
  `transaction_type` varchar(100) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `user`, `total_amount`, `transaction_type`, `timestamp`) VALUES
(45, 'qwe', 120, '', '2024-09-26 00:41:40'),
(46, '', 0, '', '2024-09-26 00:57:10'),
(47, '', 0, '', '2024-09-26 00:58:34'),
(48, '', 492, '', '2024-10-07 00:44:23'),
(49, '', 120, '', '2024-10-07 00:44:28'),
(50, '', 0, '', '2024-10-07 00:44:32'),
(51, '', 0, '', '2024-10-07 00:44:38'),
(52, '', 750, '', '2024-10-07 00:45:12'),
(53, 'qwe', 960, '', '2024-10-07 00:46:03'),
(54, 'qwe', 750, '', '2024-10-07 00:46:22'),
(55, 'qwe', 150, '', '2024-10-07 00:46:25'),
(56, '', 222, '', '2024-10-11 02:45:12'),
(57, '', 222, '', '2024-10-17 17:04:59'),
(58, '', 372, '', '2024-10-19 17:58:03'),
(59, '', 540, '', '2024-10-20 21:59:55'),
(60, '', 1110, '', '2024-10-25 17:28:10'),
(61, '', 222, '', '2024-10-25 17:28:55'),
(62, '', 120, '', '2024-10-28 22:01:06'),
(63, '', 150, '', '2024-10-28 22:58:28'),
(64, '', 222, '', '2024-10-29 15:31:54'),
(65, '', 1332, '', '2024-10-30 20:49:02'),
(66, '', 3, '', '2024-10-30 21:27:28'),
(67, '', 1, '', '2024-10-30 21:27:55'),
(68, '', 1, '', '2024-10-30 21:29:03'),
(69, '', 1200, '', '2024-10-30 21:29:53'),
(70, '', 120, '', '2024-11-02 16:22:08'),
(71, '', 240, '', '2024-11-02 23:31:49'),
(72, '', 120, '', '2024-11-02 23:31:52'),
(73, '', 120, '', '2024-11-02 23:31:55'),
(74, '', 0, '', '2024-11-04 09:38:55'),
(75, 'qwe', 0, '', '2024-11-05 05:16:00'),
(76, 'qwe', 120, '', '2024-11-06 18:45:55'),
(77, 'qwe', 120, '', '2024-11-06 18:58:33'),
(78, 'qwe', 240, '', '2024-11-06 18:58:42'),
(79, 'qwe', 120, '', '2024-11-07 09:43:41'),
(80, 'qwe', 120, '', '2024-11-08 10:19:43'),
(81, 'asd', 100, '', '2024-11-10 07:34:22'),
(82, 'qwe', 100, '', '2024-11-12 19:28:33'),
(83, 'qwe', 100, '', '2024-11-12 20:32:22'),
(84, 'qwe', 100, '', '2024-11-12 20:33:26'),
(85, 'qwe', 100, '', '2024-11-12 20:40:11'),
(86, 'qwe', 500, '', '2024-11-12 20:40:27'),
(87, 'qwe', 222, '', '2024-11-12 20:41:32'),
(88, 'qwe', 322, '', '2024-11-12 20:41:37'),
(89, 'qwe', 222, '', '2024-11-12 20:43:06'),
(90, 'qwe', 222, '', '2024-11-12 20:45:35'),
(91, 'qwe', 100, '', '2024-11-12 21:44:25'),
(92, 'qwe', 100, '', '2024-11-12 22:05:00'),
(93, 'qwe', 100, '', '2024-11-12 22:05:10'),
(94, 'qwe', 322, '', '2024-11-12 22:05:45'),
(95, 'qwe', 100, '', '2024-11-12 22:06:33'),
(96, 'qwe', 300, '', '2024-11-12 22:06:44'),
(97, 'qwe', 100, '', '2024-11-12 22:07:12'),
(98, 'qwe', 100, '', '2024-11-12 22:10:01'),
(99, 'qwe', 100, '', '2024-11-12 22:10:31'),
(100, 'qwe', 222, '', '2024-11-12 22:12:24'),
(101, 'qwe', 888, '', '2024-11-12 22:12:31'),
(102, 'qwe', 322, '', '2024-11-12 22:12:40'),
(103, 'qwe', 100, '', '2024-11-12 22:14:59'),
(104, 'qwe', 222, '', '2024-11-12 22:15:33'),
(105, 'qwe', 100, '', '2024-11-12 22:15:40'),
(106, 'qwe', 100, '', '2024-11-12 22:17:28'),
(107, 'qwe', 100, '', '2024-11-12 22:20:26'),
(108, 'qwe', 100, '', '2024-11-12 22:20:29'),
(109, 'qwe', 100, '', '2024-11-12 22:23:01'),
(110, 'qwe', 100, '', '2024-11-12 22:23:13'),
(111, 'qwe', 100, '', '2024-11-12 22:23:47'),
(112, 'qwe', 100, '', '2024-11-12 22:24:28'),
(113, 'qwe', 100, '', '2024-11-12 22:24:42'),
(114, 'qwe', 100, '', '2024-11-12 22:25:15'),
(115, 'qwe', 100, '', '2024-11-12 22:29:21'),
(116, 'qwe', 100, '', '2024-11-12 22:30:05'),
(117, 'qwe', 100, '', '2024-11-12 22:30:42'),
(118, 'qwe', 100, '', '2024-11-12 22:30:51'),
(119, 'qwe', 100, '', '2024-11-12 22:32:15'),
(120, 'qwe', 100, '', '2024-11-12 22:33:28'),
(121, 'qwe', 100, '', '2024-11-12 22:33:42'),
(122, 'qwe', 100, '', '2024-11-12 22:34:58'),
(123, 'qwe', 100, '', '2024-11-12 22:35:05'),
(124, 'qwe', 89, '', '2024-11-12 22:47:39'),
(125, 'qwe', 657, '', '2024-11-14 06:00:22'),
(126, 'qwe', 18, '', '2024-11-14 06:05:16'),
(127, 'qwe', 195, '', '2024-11-14 06:06:15'),
(128, 'qwe', 178, '', '2024-11-14 06:07:00'),
(129, 'qwe', 178, '', '2024-11-14 06:12:22'),
(130, 'qwe', 710, '', '2024-11-14 06:43:19'),
(131, 'qwe', 178, '', '2024-11-14 06:46:08'),
(132, 'qwe', 178, '', '2024-11-14 06:46:26'),
(133, 'qwe', 178, '', '2024-11-14 06:47:58'),
(134, 'qwe', 178, '', '2024-11-14 06:48:25'),
(135, 'qwe', 178, '', '2024-11-14 06:48:36'),
(136, 'qwe', 178, '', '2024-11-14 06:48:58'),
(137, 'qwe', 178, '', '2024-11-14 06:49:28'),
(138, 'qwe', 178, '', '2024-11-14 06:51:23'),
(139, 'qwe', 373, '', '2024-11-14 06:51:58'),
(140, 'qwe', 577, '', '2024-11-14 06:56:26'),
(141, 'qwe', 577, '', '2024-11-14 06:56:47'),
(142, 'qwe', 577, '', '2024-11-14 06:58:17'),
(143, 'qwe', 355, '', '2024-11-14 07:01:21'),
(144, 'qwe', 444, '', '2024-11-14 07:02:02'),
(145, 'qwe', 444, '', '2024-11-14 07:02:14'),
(146, 'qwe', 444, '', '2024-11-14 07:04:11'),
(147, 'qwe', 444, '', '2024-11-14 07:04:30'),
(148, 'qwe', 444, '', '2024-11-14 07:04:35'),
(149, 'qwe', 444, '', '2024-11-14 07:06:26'),
(150, 'qwe', 444, '', '2024-11-14 07:07:58'),
(151, 'qwe', 444, '', '2024-11-14 07:08:01'),
(152, 'qwe', 444, '', '2024-11-14 07:08:29'),
(153, 'qwe', 444, '', '2024-11-14 07:09:18'),
(154, 'qwe', 444, '', '2024-11-14 07:09:24'),
(155, 'qwe', 444, '', '2024-11-14 07:09:35'),
(156, 'qwe', 444, '', '2024-11-14 07:09:45'),
(157, 'qwe', 444, '', '2024-11-14 07:09:54'),
(158, 'qwe', 444, '', '2024-11-14 07:10:37'),
(159, 'qwe', 444, '', '2024-11-14 07:10:59'),
(160, 'qwe', 666, '', '2024-11-14 07:11:30'),
(161, 'qwe', 666, '', '2024-11-14 07:12:21'),
(162, 'qwe', 577, '', '2024-11-14 07:12:39'),
(163, 'qwe', 195, '', '2024-11-14 07:13:32'),
(164, 'qwe', 355, '', '2024-11-14 07:15:04'),
(165, 'qwe', 178, '', '2024-11-14 07:16:14'),
(166, 'qwe', 178, '', '2024-11-14 07:16:59'),
(167, 'qwe', 178, 'true', '2024-11-14 07:21:34'),
(168, 'qwe', 222, 'false', '2024-11-14 07:21:58'),
(169, 'qwe', 222, 'discount', '2024-11-14 07:24:18'),
(170, 'qwe', 222, 'regular', '2024-11-14 07:25:37'),
(171, 'qwe', 178, 'discount', '2024-11-14 07:26:15'),
(172, 'qwe', 178, 'discount', '2024-11-14 07:44:30');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_item`
--

CREATE TABLE `transaction_item` (
  `item_id` int(100) NOT NULL,
  `transaction_id` int(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `price` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_item`
--

INSERT INTO `transaction_item` (`item_id`, `transaction_id`, `product_name`, `quantity`, `price`) VALUES
(55, 45, 'Spanish Latte', 1, 120),
(56, 45, 'qq', 1, 0),
(57, 46, 'qqqq', 1, 0),
(58, 47, 'qq', 1, 0),
(59, 48, 'Coffee', 1, 150),
(60, 48, 'Spanish Latte', 1, 120),
(61, 48, 'qqqqq', 1, 222),
(62, 49, 'Spanish Latte', 1, 120),
(63, 50, 'qqq', 1, 0),
(64, 51, 'qqqq', 1, 0),
(65, 52, 'Spanish Latte', 5, 120),
(66, 52, 'Coffee', 1, 150),
(67, 53, 'Spanish Latte', 8, 120),
(68, 54, 'Coffee', 5, 150),
(69, 55, 'Coffee', 1, 150),
(70, 56, 'qqqqq', 1, 222),
(71, 57, 'qqqqq', 1, 222),
(72, 58, 'qq', 6, 0),
(73, 58, 'asdasdasdasd', 1, 0),
(74, 58, 'qqqqq', 1, 222),
(75, 58, 'Coffee', 1, 150),
(76, 59, 'Spanish Latte', 2, 120),
(77, 59, 'Coffee', 2, 150),
(78, 60, 'qqqqq', 5, 222),
(79, 61, 'qqqqq', 1, 222),
(80, 62, 'Spanish Latte', 1, 120),
(81, 63, 'Coffee', 1, 150),
(82, 64, 'qqqqq', 1, 222),
(83, 65, 'qqqqq', 6, 222),
(84, 66, 'qqqqq', 14, 222),
(85, 67, 'qqqqq', 5, 222),
(86, 68, 'Coffee', 7, 150),
(87, 69, 'Coffee', 8, 150),
(88, 70, 'Spanish Latte', 1, 120),
(89, 71, 'Coffee', 1, 120),
(90, 71, 'Spanish Latte', 1, 120),
(91, 72, 'Spanish Latte', 1, 120),
(92, 73, 'Coffee', 1, 120),
(93, 74, 'qq', 1, 0),
(94, 75, 'asdasdasdasd', 1, 0),
(95, 76, 'Spanish Latte', 1, 120),
(96, 77, 'Coffee', 1, 120),
(97, 78, 'Coffee', 2, 120),
(98, 79, 'Spanish Latte', 1, 120),
(99, 80, 'Spanish Latte', 1, 120),
(100, 81, '1', 1, 100),
(101, 82, '1', 1, 100),
(102, 83, '1', 1, 100),
(103, 84, '1', 1, 100),
(104, 85, '1', 1, 100),
(105, 86, '1', 5, 100),
(106, 87, '2', 1, 222),
(107, 88, '1', 1, 100),
(108, 88, '2', 1, 222),
(109, 89, '2', 1, 222),
(110, 90, '2', 1, 222),
(111, 91, '1', 1, 100),
(112, 92, '1', 1, 100),
(113, 93, '1', 1, 100),
(114, 94, '1', 1, 100),
(115, 94, '2', 1, 222),
(116, 95, '1', 1, 100),
(117, 96, '1', 3, 100),
(118, 97, '1', 1, 100),
(119, 98, '1', 1, 100),
(120, 99, '1', 1, 100),
(121, 100, '5', 1, 222),
(122, 101, '5', 4, 222),
(123, 102, '1', 1, 100),
(124, 102, '5', 1, 222),
(125, 103, '1', 1, 100),
(126, 104, '5', 1, 222),
(127, 105, '1', 1, 100),
(128, 106, '1', 1, 100),
(129, 107, '1', 1, 100),
(130, 108, '1', 1, 100),
(131, 109, '1', 1, 100),
(132, 110, '1', 1, 100),
(133, 111, '1', 1, 100),
(134, 112, '1', 1, 100),
(135, 113, '1', 1, 100),
(136, 114, '1', 1, 100),
(137, 115, '1', 1, 100),
(138, 116, '1', 1, 100),
(139, 117, '1', 1, 100),
(140, 118, '1', 1, 100),
(141, 119, '1', 1, 100),
(142, 120, '1', 1, 100),
(143, 121, '1', 1, 100),
(144, 122, '1', 1, 100),
(145, 123, '1', 1, 100),
(146, 124, 'qweqwe', 4, 22),
(147, 125, '5', 3, 222),
(148, 125, 'qweqwe', 4, 22),
(149, 126, 'qweqwe', 1, 22),
(150, 127, '5', 1, 222),
(151, 127, 'qweqwe', 1, 22),
(152, 128, '5', 1, 222),
(153, 129, '5', 1, 222),
(154, 130, '5', 2, 222),
(155, 130, '2', 2, 222),
(156, 131, '5', 1, 222),
(157, 132, '5', 1, 222),
(158, 133, '5', 1, 222),
(159, 134, '5', 1, 222),
(160, 135, '5', 1, 222),
(161, 136, '5', 1, 222),
(162, 137, '5', 1, 222),
(163, 138, '5', 1, 222),
(164, 139, '5', 1, 222),
(165, 139, 'qweqwe', 1, 22),
(166, 139, '2', 1, 222),
(167, 142, '5', 2, 200),
(168, 143, '5', 2, 200),
(169, 144, '5', 2, 200),
(170, 145, '5', 2, 200),
(171, 147, '5', 2, 200),
(172, 148, '5', 2, 200),
(173, 152, '5', 2, 200),
(174, 155, '5', 2, 200),
(175, 157, '5', 2, 200),
(176, 158, '5', 2, 222),
(177, 159, '2', 2, 222),
(178, 160, '2', 3, 222),
(179, 161, '5', 3, 222),
(180, 162, '5', 3, 222),
(181, 163, '5', 1, 222),
(182, 163, 'qweqwe', 1, 22),
(183, 164, '5', 2, 222),
(184, 165, '2', 1, 222),
(185, 166, '2', 1, 222),
(186, 167, '5', 1, 222),
(187, 168, '5', 1, 222),
(188, 169, '5', 1, 222),
(189, 170, '5', 1, 222),
(190, 171, '5', 1, 222),
(191, 172, '5', 1, 222);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(100) NOT NULL,
  `account_type` varchar(100) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact_number` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `account_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `account_type`, `full_name`, `user_name`, `password`, `contact_number`, `address`, `picture`, `account_date`) VALUES
(45, 'admin', 'qwe', 'qwe', '$2y$10$LGV24wxGxueW2SwuIWqFjeXN8OBBTnqcd03BfT0IuG7F7Spkmx7u.', '0', 'a', '45.png', '2024-08-31 00:00:00'),
(87, 'staff', 'asd', 'asd', '$2y$10$F/gPmOxZnOL01kxOqw8IlOsD0HLPzGV5PDru5mj7ATQU8WqoDfsj2', '12322222222', '123', NULL, '2024-11-10 07:03:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expenses_id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredients_id`),
  ADD UNIQUE KEY `raw_name` (`raw_name`);

--
-- Indexes for table `ingredients_category`
--
ALTER TABLE `ingredients_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `inventory_action`
--
ALTER TABLE `inventory_action`
  ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_name` (`product_name`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD PRIMARY KEY (`product_raw_id`),
  ADD KEY `FK_Ingredients` (`ingredients_id`),
  ADD KEY `FK_Product` (`product_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `FK_TUser` (`user`);

--
-- Indexes for table `transaction_item`
--
ALTER TABLE `transaction_item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `FK_TProduct` (`product_name`),
  ADD KEY `FK_Transaction` (`transaction_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_name_2` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=589;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expenses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredients_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `ingredients_category`
--
ALTER TABLE `ingredients_category`
  MODIFY `category_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `inventory_action`
--
ALTER TABLE `inventory_action`
  MODIFY `action_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `category_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  MODIFY `product_raw_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `transaction_item`
--
ALTER TABLE `transaction_item`
  MODIFY `item_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD CONSTRAINT `FK_Ingredients` FOREIGN KEY (`ingredients_id`) REFERENCES `ingredients` (`ingredients_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_item`
--
ALTER TABLE `transaction_item`
  ADD CONSTRAINT `FK_Transaction` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
