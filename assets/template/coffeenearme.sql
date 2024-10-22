-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2024 at 08:58 AM
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

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `product_name`, `product_price`, `quantity`) VALUES
(212, 45, 74, 'Coffee', 150.00, 3);

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
(30, 'Arabica', 'Coffee', 79.996, 'kg', 1, '30.jpg'),
(42, 'Robusta', 'Coffee', 630, 'kg', 400, '42.png'),
(44, 'qwe', 'Food', 0, 'kg', 0, '44.png'),
(45, '2', 'Food', 0, 'kg', 0, ''),
(46, '3', 'Food', 0, 'kg', 0, ''),
(47, '4', 'Food', 0, 'kg', 0, ''),
(48, 'water', 'Food', 2, 'kg', 3, ''),
(50, 'water b', 'Food', 10, 'pcs', 5, ''),
(51, 'beans', 'Coffee', 0.992, 'kg', 5, ''),
(52, 'w', 'Food', 0.9852063580000001, 'gal', 30, '');

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
(47, 'Add Ingredient', 'w', 25, 'gal', '2024-10-13 06:04:49', 'qwe');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(100) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_category`, `price`, `picture`) VALUES
(74, 'Coffee', 'Hot', 150, '74.jpg'),
(75, 'Spanish Latte', 'Water Based', 120, '75.jpg'),
(78, 'asdasdasdasd', 'Water Based', 0, NULL),
(80, 'qq', 'Water Based', 0, NULL),
(81, 'qqq', 'Water Based', 0, NULL),
(82, 'qqqq', 'Water Based', 0, NULL),
(83, 'qqqqq', 'Water Based', 222, NULL);

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
(31, 75, 30, 1, 'g'),
(34, 78, 30, 2, 'g'),
(43, 83, 51, 1, 'g'),
(44, 83, 52, 25, 'mL'),
(45, 80, 51, 1, 'g'),
(55, 74, 52, 1, 'g');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `total_amount` int(100) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `user`, `total_amount`, `timestamp`) VALUES
(45, 'qwe', 120, '2024-09-26 00:41:40'),
(46, '', 0, '2024-09-26 00:57:10'),
(47, '', 0, '2024-09-26 00:58:34'),
(48, '', 492, '2024-10-07 00:44:23'),
(49, '', 120, '2024-10-07 00:44:28'),
(50, '', 0, '2024-10-07 00:44:32'),
(51, '', 0, '2024-10-07 00:44:38'),
(52, '', 750, '2024-10-07 00:45:12'),
(53, 'qwe', 960, '2024-10-07 00:46:03'),
(54, 'qwe', 750, '2024-10-07 00:46:22'),
(55, 'qwe', 150, '2024-10-07 00:46:25'),
(56, '', 222, '2024-10-11 02:45:12'),
(57, '', 222, '2024-10-17 17:04:59'),
(58, '', 372, '2024-10-19 17:58:03'),
(59, '', 540, '2024-10-20 21:59:55');

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
(77, 59, 'Coffee', 2, 150);

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
(45, 'admin', 'qwe', '', '$2y$10$.arNxG6DGb.7DqE.1WjmduDt60CIJdu1BMqvfwPUnbDr/uwYsHGey', '0', 'a', '45.png', '2024-08-31 00:00:00'),
(49, '', '', 'qweqwe', '$2y$10$NBw7hSs2vOnjLBZUhPSLteb6mATAaIYABHxIPISBYESdPkIRDovBO', '9', '', '49.jpg', '2024-09-02 00:00:00'),
(52, 'a', 'q', 'asdasd', '$2y$10$zPWjNeyHjBqE6D8poxOIgOvGiKsEf3TYn5WDJzgirWq4dAkk.SU26', '0911', 'wwww', NULL, '2024-09-03 00:00:00'),
(57, '', '', 'qwe', '$2y$10$ddqcOI.tYkeBKSlRLQNDaOkNS2/f3xCEnDwBjVeSbVt1U3qRCgKHK', '0', '', NULL, '2024-09-03 00:00:00'),
(64, '', 'qwe', 'qweq', '$2y$10$ZNDzL0Njah3Tkpt6flPEK.qK7axzxUeFy/3yuk66VIJYo9kCPIJPy', '0', 'w', NULL, '2024-09-04 00:00:00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredients_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `ingredients_category`
--
ALTER TABLE `ingredients_category`
  MODIFY `category_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `inventory_action`
--
ALTER TABLE `inventory_action`
  MODIFY `action_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `category_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  MODIFY `product_raw_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `transaction_item`
--
ALTER TABLE `transaction_item`
  MODIFY `item_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

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
