-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2024 at 01:24 PM
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
-- Database: `maxcourier`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `p_id` varchar(20) NOT NULL,
  `t_id` varchar(20) NOT NULL,
  `r_name` varchar(225) NOT NULL,
  `r_email` varchar(225) NOT NULL,
  `r_phone` varchar(225) NOT NULL,
  `r_postcode` int(11) NOT NULL,
  `r_address` varchar(225) NOT NULL,
  `s_name` varchar(225) NOT NULL,
  `s_email` varchar(225) NOT NULL,
  `s_phone` varchar(225) NOT NULL,
  `s_postcode` int(11) NOT NULL,
  `s_address` varchar(225) NOT NULL,
  `p_name` varchar(225) NOT NULL,
  `p_weight` int(11) NOT NULL,
  `p_status` varchar(225) NOT NULL,
  `ship_cost` int(11) NOT NULL,
  `h_charges` int(11) NOT NULL,
  `pay_status` varchar(225) NOT NULL,
  `p_type` varchar(225) NOT NULL,
  `p_pieces` varchar(225) NOT NULL,
  `image` varchar(500) NOT NULL,
  `transit` varchar(225) NOT NULL,
  `r_status` varchar(225) NOT NULL,
  `auto_track` varchar(225) NOT NULL,
  `o_location` varchar(225) NOT NULL,
  `d_location` varchar(225) NOT NULL,
  `order_date` date NOT NULL,
  `arival_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `p_id`, `t_id`, `r_name`, `r_email`, `r_phone`, `r_postcode`, `r_address`, `s_name`, `s_email`, `s_phone`, `s_postcode`, `s_address`, `p_name`, `p_weight`, `p_status`, `ship_cost`, `h_charges`, `pay_status`, `p_type`, `p_pieces`, `image`, `transit`, `r_status`, `auto_track`, `o_location`, `d_location`, `order_date`, `arival_date`) VALUES
(15, 'ID789847', 'TR75242779', 'Garry Jenkins', 'garry@gmail.com', '6565776754', 86755, 'Main street', 'John Jenkins', 'jdoe@gmail.com', '5678655678', 44252, 'Main street', 'Shoe pairs', 2, 'On Process', 500, 50, 'Paid In Full', 'Basic', '1 Truck Box', '2107399.png', 'Not set yet', 'Not set yet', 'No', 'Croatia', 'Germany', '2024-02-07', '2024-02-09'),
(17, 'ID419529', 'TR97310293', 'Perez Maria', 'maria@gmail.com', '6565776754', 86755, 'Main street', 'Perez Ivan', 'ivan@gmail.com', '5678655678', 44252, 'Main street', 'Shoe pairs', 2, 'On Process', 1002, 50, 'No', 'Pro', '1 Truck Box', '2729867.jpg', 'Not set yet', 'Not set yet', 'No', 'Turkey', 'Cyprus', '2024-02-10', '2024-02-12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(225) NOT NULL,
  `user_email` varchar(225) NOT NULL,
  `user_pass` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_email`, `user_pass`) VALUES
(1, 'Jetklin', 'jetklin123@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759'),
(2, 'Admin', 'admin12345@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'Admin', 'admin12345@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'Admin', 'admin12345@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'Admin', 'admin12345@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(6, 'Admin', 'admin12345@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(7, 'Admin', 'admin12345@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
