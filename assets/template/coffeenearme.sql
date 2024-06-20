-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 06:08 PM
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
-- Database: `coffeenearme`
--

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredients_id` int(100) NOT NULL,
  `raw_name` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL,
  `ideal_quantity` int(100) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ingredients_id`, `raw_name`, `quantity`, `ideal_quantity`, `picture`) VALUES
(1, 'tae', 1, 2, 'qwe'),
(3, 'pupu', 1, 1, 'qwe');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(100) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(100) NOT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_ingredients`
--

CREATE TABLE `product_ingredients` (
  `product_raw_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `ingredients_id` int(100) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `contact_number` int(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `account_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `account_type`, `full_name`, `user_name`, `password`, `contact_number`, `address`, `picture`, `account_date`) VALUES
(2, '', 'qwe', 'qwe', 'qwe', 123, '269 Sta Rosa 1', NULL, '2024-06-18'),
(5, 'Admin', 'asd', 'asd', '$2y$10$/G82I/phUqaW0ww3LbA5KO4m4KODsq.xQtSVMzHj.lbEV9EwqAL1a', 123, '269 Sta Rosa 1', NULL, '2024-06-18'),
(6, '', 'zxc', 'zxc', '$2y$10$mOS0/Ccu3cS7cHiktP19ieRWZipCnlM0NcQYEM2PatIshPyqTvraa', 2147483647, '269 Sta Rosa 1', NULL, '2024-06-18'),
(7, '', 'qaz', 'qaz', '$2y$10$cZGpmV8L.K/FO3wgju16ueCWSyZA68.GZCE1.kpc2Etm8ZfVTlpXG', 2147483647, '269 Sta Rosa 1', NULL, '2024-06-18'),
(8, '', 'iop', 'iop', '$2y$10$7scYktxMmTgZhzGepkJAi.IGpslQ/IiNctoLI.F2mPB4EdpSaUDl6', 2147483647, '269 Sta Rosa 1', NULL, '2024-06-18'),
(9, '', 'asdasd', 'asdasd', '$2y$10$NH02nC2YEDBvetMAFpaOo.WxKQfoFzZrgX6OiUBL4KH1cjP9tI1Z6', 2147483647, '269 Sta Rosa 1', NULL, '2024-06-19'),
(10, '', 'qweqwe', 'qweqwe', '$2y$10$4Zal1IUHJCyUljSItHEA0.23s1WFuurueWLzCjjSdu8p.mY3DdPqu', 2147483647, '269 Sta Rosa 1', NULL, '2024-06-19'),
(16, '', 'asdasdasd', 'asdasdasd', '$2y$10$EHmkGqmCq6zyEkE5AfkJpOR0HIxTIvwrpz1lxjeuKiuiW.nsqlj1K', 123, '123', NULL, '2024-06-19'),
(17, '', 'qwe', '123', '$2y$10$au/AvfKoftA6ypEU6pDjFeRfFusCjdfGICGvkY0NTyhGQ2l6Iuute', 123, '123', NULL, '2024-06-19'),
(18, '', '', '', '$2y$10$LTLsz/pO6xLK.b6ko1hbCe9ezgLeke3WIJTOZYMopSgHRVkPsngUm', 0, '', NULL, '2024-06-21'),
(19, '', 'admin', 'admin', '$2y$10$RQjZG7JdCiF4MU9kFGlwnONn2MRl2mv.Ca8yDh/nbRrI3RhfjvJTq', 2147483647, '269 Sta Rosa 1', NULL, '2024-06-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredients_id`),
  ADD UNIQUE KEY `raw_name` (`raw_name`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_name` (`product_name`);

--
-- Indexes for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD PRIMARY KEY (`product_raw_id`),
  ADD KEY `FK_Ingredients` (`ingredients_id`),
  ADD KEY `FK_Product` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredients_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  MODIFY `product_raw_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD CONSTRAINT `FK_Ingredients` FOREIGN KEY (`ingredients_id`) REFERENCES `ingredients` (`ingredients_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
