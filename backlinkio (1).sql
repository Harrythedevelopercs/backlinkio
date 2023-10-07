-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2023 at 02:47 AM
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
-- Database: `backlinkio`
--

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE `cartitem` (
  `id` int(11) NOT NULL,
  `orderId` varchar(100) NOT NULL,
  `da` varchar(100) NOT NULL,
  `anchor` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `category_price` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `status` varchar(255) NOT NULL,
  `responseURL` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cartitem`
--

INSERT INTO `cartitem` (`id`, `orderId`, `da`, `anchor`, `url`, `category`, `category_price`, `user_id`, `order_date`, `status`, `responseURL`) VALUES
(38, 'SUVQ5I:23:09', '30', 'Data Table', 'https://datatables.net/examples/styling/bootstrap5.html', 'Animal Control', 50, 8, '19-09-2023', 'orderPlaced', ''),
(39, 'SUVQ5I:23:09', '30', 'test 2', 'https://datatables.net/examples/styling/bootstrap5.html', 'Law Firm', 29, 8, '19-09-2023', 'orderPlaced', ''),
(40, 'F3CGJC:23:09', '30', 'test 2', 'https://laravel.com/docs/10.x/queries#latest-oldest', 'Law Firm', 29, 8, '20-09-2023', 'orderPlaced', '');

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
(8, '45', 'Active'),
(9, '100', 'Active'),
(10, '55', 'Active'),
(11, '90', 'Active');

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
(2, 1, 'Law Firm', 29, 'Active'),
(3, 8, 'Animal Control', 55, 'Active'),
(4, 3, 'Animal Control', 52, 'Active'),
(5, 9, 'app', 10, 'Active'),
(6, 1, 'Real Estate', 120, 'Active'),
(7, 10, 'abc', 55, 'Active'),
(8, 11, 'Animal Control', 12, 'Active'),
(9, 11, 'Animal Control USA', 500, 'orderPending');

-- --------------------------------------------------------

--
-- Table structure for table `funds`
--

CREATE TABLE `funds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `topup_date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `last_update` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `funds`
--

INSERT INTO `funds` (`id`, `user_id`, `amount`, `topup_date`, `status`, `last_update`) VALUES
(2, 8, 7000, '10-05-23', 'paid', '10-05-23  22:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `fundshistory`
--

CREATE TABLE `fundshistory` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `stripe_ref` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fundshistory`
--

INSERT INTO `fundshistory` (`id`, `user_id`, `amount`, `stripe_ref`, `date`, `status`) VALUES
(1, 8, 2000, 'cs_test_a1qpG9nnJZJAVAIBTGPMzDp6TyGiOEQ4YhuB9WBAKjhYIJRrujktBvJASi', '10-05-23  19:10:14', 'Funds Added'),
(3, 8, 2000, 'cs_test_a1qpG9nnJZJAVAIBTGPMzDp6TyGiOEQ4YhuB9WBAKjhYIJRrujktBvJASi', '10-05-23  19:10:14', 'Funds Debit'),
(4, 8, 5000, 'cs_test_a1AmJPqEiBeRHpusNWfc3iovmnCMDh2vutwWae4ZnS7WmHHZnooT6jEHCz', '10-05-23  22:35:14', 'Funds Added');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `paymentLink` longtext NOT NULL,
  `payment_ID` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `payment_created` varchar(255) NOT NULL,
  `payment_paid_date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_id`, `amount`, `paymentLink`, `payment_ID`, `payment_status`, `payment_created`, `payment_paid_date`, `status`) VALUES
(7, 8, 'SUVQ5I:23:09', '79', 'https://checkout.stripe.com/c/pay/cs_test_a1ADZp9PGXjpaHmzehGIncB4gX3XiJetspd66ygZ2c6biaR0HrLfHOzorI#fidkdWxOYHwnPyd1blpxYHZxWjA0TW4zbnBBbGJpXVJOSDxjQ0k2PF8zRkppMTBsQz12UW1sTnZoPURWf05AczVfb3BXPWs0c0t3NUpGTTdxMERgdjFpTGFPQmZANnJpM1xdfXx0VGlwcGpLNTVnTnJMf1BgQScpJ2N3amhWYHdzYHcnP3F3cGApJ2lkfGpwcVF8dWAnPyd2bGtiaWBabHFgaCcpJ2BrZGdpYFVpZGZgbWppYWB3dic%2FcXdwYHgl', 'cs_test_a1ADZp9PGXjpaHmzehGIncB4gX3XiJetspd66ygZ2c6biaR0HrLfHOzorI', 'complete', '09-19-2023', '09-19-2023', 'paid'),
(8, 8, 'F3CGJC:23:09', '29', 'https://checkout.stripe.com/c/pay/cs_test_a1Lq6gjMksOBuSOGqqpeqzmZbf7dpm03Er5FGPPRvp20flITldJSg9cpLR#fidkdWxOYHwnPyd1blpxYHZxWjA0TW4zbnBBbGJpXVJOSDxjQ0k2PF8zRkppMTBsQz12UW1sTnZoPURWf05AczVfb3BXPWs0c0t3NUpGTTdxMERgdjFpTGFPQmZANnJpM1xdfXx0VGlwcGpLNTVnTnJMf1BgQScpJ2N3amhWYHdzYHcnP3F3cGApJ2lkfGpwcVF8dWAnPyd2bGtiaWBabHFgaCcpJ2BrZGdpYFVpZGZgbWppYWB3dic%2FcXdwYHgl', 'cs_test_a1Lq6gjMksOBuSOGqqpeqzmZbf7dpm03Er5FGPPRvp20flITldJSg9cpLR', 'complete', '09-20-2023', '09-20-2023', 'paid');

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
(8, '$2y$10$mhAruf0JHh5mq2gPWmLpN.PvxfegAoOueq3TxyP88fi.62hB6iUvi', 'Hamza Khan', 'harrykennedy.cs@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 0, 10, 'Active'),
(9, '$2y$10$.HnJ.zgT7gmhyG8yY5LC5.8u4A1h9Gf6utlL0y1/fAAZxTBnC557W', 'Umair', 'marlene_autry_developer@outlook.com', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 'Active'),
(10, '$2y$10$V2AjGbFMRmzM5noEiwgTWuQ7bR9OST46IWFwYPFbfUyWbg5T1w5sS', '22', 'harrddykennedy.cs@gmail.comd', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `funds`
--
ALTER TABLE `funds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fundshistory`
--
ALTER TABLE `fundshistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
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
-- AUTO_INCREMENT for table `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `da`
--
ALTER TABLE `da`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dacategory`
--
ALTER TABLE `dacategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `funds`
--
ALTER TABLE `funds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fundshistory`
--
ALTER TABLE `fundshistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
