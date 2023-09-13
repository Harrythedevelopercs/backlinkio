-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2023 at 01:57 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `backlinkio`
--

-- --------------------------------------------------------

--
-- Table structure for table `da`
--

CREATE TABLE `da` (
  `id` int(11) NOT NULL,
  `DA` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da`
--

INSERT INTO `da` (`id`, `DA`, `status`) VALUES
(1, '30', 'Active'),
(2, '50', 'Active'),
(3, '40', 'Active'),
(4, '60', 'Active'),
(5, '80', 'Active'),
(6, '70', 'Active'),
(8, '45', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `dacategory`
--

CREATE TABLE `dacategory` (
  `id` int(11) NOT NULL,
  `da_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dacategory`
--

INSERT INTO `dacategory` (`id`, `da_id`, `title`, `price`, `status`) VALUES
(1, 1, 'Animal Control', 50, 'Active'),
(2, 1, 'Law Firm', 29, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `credits` int(11) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `password`, `full_name`, `email`, `phone`, `address`, `country`, `state`, `city`, `postcode`, `credits`, `is_verified`, `status`) VALUES
(8, '$2y$12$6an0MyWVQ/.19WZMBANZy.8UymejkEfYSkQQW3Q0TPTsh91YblCQe', 'Hamza Khan', 'harrykennedy.cs@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 'Active'),
(9, '$2y$10$.HnJ.zgT7gmhyG8yY5LC5.8u4A1h9Gf6utlL0y1/fAAZxTBnC557W', 'Umair', 'marlene_autry_developer@outlook.com', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 'Active'),
(10, '$2y$10$V2AjGbFMRmzM5noEiwgTWuQ7bR9OST46IWFwYPFbfUyWbg5T1w5sS', '22', 'harrddykennedy.cs@gmail.comd', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `da`
--
ALTER TABLE `da`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dacategory`
--
ALTER TABLE `dacategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `da`
--
ALTER TABLE `da`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dacategory`
--
ALTER TABLE `dacategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
